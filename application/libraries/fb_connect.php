<?php
	include(APPPATH.'libraries/facebook/facebook.php');

	class Fb_connect extends Facebook {

		//declare public variables
		private $user 		= NULL;
		private $user_id 	= FALSE;
                private $friends        = NULL;
                private $access_token   = FALSE;

                //constructor method.
		public function __construct()
		{
                    $CI = & get_instance();
                    $CI->config->load("facebook",TRUE);
                    $config = $CI->config->item('facebook');
                    parent::__construct($config);
                    $this->user_id = $this->getUser(); // New code
                    log_message('Info','Constructor initialized!');
                    $me = "";
                    $friends = "";
                    $accessTokens = "";
                    if ($this->user_id) {
                        log_message('Info','Userid is fetched!');
                        try {
                            log_message('Info','Entering Try method!');
                            $accessTokens = $this->getAccessToken();
                            $me = $this->api('/me');
                            $friends = $this->api('/me/friends');
                            $this->access_token = $accessTokens;
                            $this->user = $me;
                            $this->friends = $friends;
                        } catch (FacebookApiException $e) {
                            log_message('Info','Entering Catch method! Following Error occured: '.$e);
                            error_log($e);
                        }
                    }
		}
                
                public function user_id()
                {
                    if(!empty($this->user_id))
                        return $this->user_id;
                    else
                        return FALSE;
                }
                
                public function userAccessToken()
                {
                    if(!empty($this->access_token))
                        return $this->access_token;
                    else
                        return FALSE;
                }

                public function user()
                {
                    if(!empty($this->user))
                        return $this->user;
                    else
                        return NULL;
                }
                
                public function friends()
                {
                    if(!empty($this->friends))
                        return $this->friends;
                    else
                        return NULL;
                }
                
                public function loginUrl($params=array())
                {
                    $loginUrl = $this->getLoginUrl($params);
                    if(!empty($loginUrl))
                        return $loginUrl;
                    else
                        return NULL;
                }
                
                public function logoutUrl($params=array())
                {
                    $logoutUrl = $this->getLogoutUrl($params);
                    if(!empty($logoutUrl))
                        return $logoutUrl;
                    else
                        return NULL;
                }

	} // end class
?>