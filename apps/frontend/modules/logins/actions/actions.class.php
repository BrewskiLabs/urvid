<?php

/**
 * logins actions.
 *
 * @package    wines
 * @subpackage logins
 * @author     alex
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class loginsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeLoginForm(sfWebRequest $request)
  {
      if ( $this->getUser()->isAuthenticated() ) {
        $this->redirect('homepage');
      }
      $user = $this->getUser();
      
      if($request->getParameter('type_login')) {
         if($request->getParameter('type_login') == 'google') {
            $googleOpenID = new GoogleOpenID(sfContext::getInstance()->getRequest()->getUriPrefix());
            $user->setAttribute('sfGoogleLogin_returnTo', $request->getUri());
            //$returnTo = $this->generateUrl('sfGoogleLogin_verify', array(), true);
            $returnTo = sfConfig::get('app_sf_google_success_signin_url');

            $this->redirect($googleOpenID->getLoginUrl( $returnTo ));

         }
         if($request->getParameter('type_login') == 'twitter') {
            $consumer_key = sfConfig::get('app_sf_twitter_auth_consumer_key');
            $consumer_secret = sfConfig::get('app_sf_twitter_auth_consumer_secret');

            $connection = new TwitterOAuth($consumer_key, $consumer_secret);
            /* Request tokens from twitter */
            $tok = $connection->getRequestToken($this->getController()->genUrl(array('sf_route' => 'twitter_response'), true));

            /* Save tokens for later */
            $user->setAttribute('oauth_request_token', $tok['oauth_token'], 'sfTwitterAuth');
            $user->setAttribute('oauth_request_token_secret', $tok['oauth_token_secret'], 'sfTwitterAuth');
            $user->setAttribute('oauth_state', 'start', 'sfTwitterAuth');

            /* Build the authorization URL */
            $request_link = $connection->getAuthorizeURL($tok['oauth_token']);
            $this->redirect($request_link);
         }
         if($request->getParameter('type_login') == 'facebook') {
             sfFacebook::requireLogin();
         }
      }
  }

  public function executeGoogleResponse(sfWebRequest $request)
  {
      $googleOpenID = new GoogleOpenID($this->getRequest()->getHost());
      if($googleOpenID->verifyLogin() && $googleUserToken = $googleOpenID->getUser())
      {
          $lastname = $request->getParameter('openid_ext1_value_lastname');
          $firstname = $request->getParameter('openid_ext1_value_firstname');
          $type_login = sfConfig::get('app_type_google');
          $openid_identity = parse_url($request->getParameter('openid_identity'));
          $id = str_replace('id=', '', $openid_identity["query"]);
          $this->process($firstname, $lastname, $id, $type_login);
      }
      return $this->redirect("@homepage");
  }

  public function executeTwitterResponse(sfWebRequest $request)
  {
    $consumer_key = sfConfig::get('app_sf_twitter_auth_consumer_key');
    $consumer_secret = sfConfig::get('app_sf_twitter_auth_consumer_secret');
    $user = $this->getUser(); /* @var $user myUser */

    if ((!$user->getAttribute('oauth_access_token', null, 'sfTwitterAuth')) &&   (!$user->getAttribute('oauth_access_token_secret', null, 'sfTwitterAuth'))) {
      /* Create TwitterOAuth object with app key/secret and token key/secret from default phase */
      $connection = new TwitterOAuth($consumer_key, $consumer_secret, $user->getAttribute('oauth_request_token', null, 'sfTwitterAuth'), $user->getAttribute('oauth_request_token_secret', null, 'sfTwitterAuth'));
      /* Request access tokens from twitter */
      $tok = $connection->getAccessToken($request->getParameter('oauth_verifier'));
      /* Save the access tokens. These could be saved in a database as they don't
        currently expire. But our goal here is just to authenticate the session. */
      $user->setAttribute('oauth_access_token', $tok['oauth_token'], 'sfTwitterAuth');
      $user->setAttribute('oauth_access_token_secret', $tok['oauth_token_secret'], 'sfTwitterAuth');
    }
    /* Create TwitterOAuth with app key/secret and user access key/secret */
    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $user->getAttribute('oauth_access_token', null, 'sfTwitterAuth'), $user->getAttribute('oauth_access_token_secret', null, 'sfTwitterAuth'));
    /* Run request on twitter API as user. */
    $result = $connection->get('account/verify_credentials');
    $type_login = sfConfig::get('app_type_twitter');
    if($result->id) {
        $this->process($result->screen_name, $result->name, $result->id_str, $type_login);
    }
    return $this->redirect("@homepage");
  }

  public function executeFacebookResponse(sfWebRequest $request)
  {
    $user = $this->getUser();

    // first check if user is already logged and not yet Facebook connected
    if (!sfFacebook::getGuardAdapter()->getUserFacebookUid($user->getGuardUser()) && sfFacebook::getFacebookClient()->get_loggedin_user())
    {   
        $facebook = sfFacebook::getFacebookClient();
        $facebook_profile = json_decode(file_get_contents(sfConfig::get('app_facebook_profile').'/'.$facebook->user));
        $type_login = sfConfig::get('app_type_facebook');
        $this->Process($facebook_profile->first_name, $facebook_profile->last_name, $facebook_profile->id, $type_login);
    }
    return $this->redirect("@homepage");
  }

  public function Process($firstname, $lastname, $id, $type_login)
  {
      $user = sfGuardUserPeer::retrieveByUsername($id);
      $user_profile = null;
      if(is_null($user)) {
        $user = new sfGuardUser();
        $user_profile = new SfGuardUserProfile();
      }
      $user->setUsername($id);
      $user->setIsActive(1);
      $user->save();
      if(!empty($user_profile)) {
        $user_profile->setFirstName($firstname);
        $user_profile->setLastName($lastname);
        $user_profile->setTypeLogin($type_login);
        $user_profile->setUserId($user->getId());
        $user_profile->save();
      }
      $this->getUser()->signin($user);
  }
  
}
