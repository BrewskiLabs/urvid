<?php

/**
 * sfGoogleLogin components.
 *
 * @package    sfGoogleLoginPlugin
 * @subpackage actions
 * @author     Sebastian Herbermann <sebastian.herbermann@googlemail.com>
 */
class sfGoogleLoginComponents extends sfComponents {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeLink() {        
        $user = $this->getUser();
        
        if ( $user->isAuthenticated() ) {
        	$this->logoutUrl = $this->generateUrl('sfGoogleLogin_logout');
        } else {
	        $request = $this->getContext()->getRequest();
	        $googleOpenID = new GoogleOpenID( sfContext::getInstance()->getRequest()->getUriPrefix() );
                $googleOpenID->getLoginUrl('http://wines.sitedevel.com/frontend_dev.php/logins');
	        $user->setAttribute('sfGoogleLogin_returnTo', $request->getUri() );
	        $returnTo = $this->generateUrl('sfGoogleLogin_verify', array(), true);
                $returnTo = 'http://wines.sitedevel.com/frontend_dev.php/logins';
	        $this->loginUrl = $googleOpenID->getLoginUrl( $returnTo );
        }        
    }
}
