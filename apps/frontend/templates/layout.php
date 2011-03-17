<?php use_helper('sfFacebookConnect')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript" src="/sfFacebookConnectPlugin/js/animation/animation.js"></script>
  </head>
  <body>
    <?php include_component( 'sfGoogleLogin', 'link' ); ?>
    <?php echo include_facebook_connect_script() ?>
      <a href="">
          <?php //echo sfFacebook::requireLogin();?>
        <img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
      </a>
      <?php $Twitter = Twitter::getConnection(); ?>
<?php
$connection = new TwitterOAuth(sfConfig::get('app_sf_twitter_auth_consumer_key'), sfConfig::get('app_sf_twitter_auth_consumer_secret'));
/* Get temporary credentials. */
$request_token = $connection->getRequestToken(sfConfig::get('app_sf_twitter_auth_success_signin_url'));
/* Save temporary credentials to session. */
$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
$url = $connection->getAuthorizeURL($token);
?>
      <a href="<?php echo $url; ?>">twitter</a>
<!--    <?php $sfGuardUser = sfFacebook::getSfGuardUserByFacebookSession(); ?>
    Hello <fb:name uid="<?php echo $sfGuardUser?$sfGuardUser->getProfile()->getFacebookUid():'' ?>"></fb:name>-->
    <?php echo $sf_content ?>
  </body>
</html>
