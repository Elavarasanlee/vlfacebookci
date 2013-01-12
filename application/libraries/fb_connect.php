<?php
        if (!defined('BASEPATH')) exit('No direct script access allowed');
        
	include(APPPATH.'libraries/facebook/facebook.php');

	class Fb_connect extends Facebook {

		//declare protected variables
		protected $user 	= NULL;
		protected $user_id 	= FALSE;
                protected $friends      = NULL;
                protected $access_token = FALSE;

                //constructor method.
		public function __construct()
		{
                    $CI = & get_instance();
                    $CI->config->load("facebook",TRUE);
                    $config = $CI->config->item('facebook');
                    parent::__construct($config);
                    $this->user_id = $this->getUser();
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
                //Use this function to fetch the fb_uid. Function call: $this->fb_connect->user_id();
                public function user_id()
                {
                    if(!empty($this->user_id))
                        return $this->user_id;
                    else
                        return FALSE;
                }
                //Use this function to fetch the user access token. Function call: $this->fb_connect->userAccessToken();
                public function userAccessToken()
                {
                    if(!empty($this->access_token))
                        return $this->access_token;
                    else
                        return FALSE;
                }
                //Use this function to fetch the user details from fb. Function call: $this->fb_connect->user();
                public function user()
                {
                    if(!empty($this->user))
                        return $this->user;
                    else
                        return NULL;
                }
                //Use this function to fetch the user's complete friends list. Function call: $this->fb_connect->friends();
                public function friends()
                {
                    if(!empty($this->friends))
                        return $this->friends;
                    else
                        return NULL;
                }
                //Use this function to fetch the graph-loginurl. Function call: $this->fb_connect->loginUrl();
                public function loginUrl($params=array())
                {
                    $loginUrl = $this->getLoginUrl($params);
                    if(!empty($loginUrl))
                        return $loginUrl;
                    else
                        return NULL;
                }
                //Use this function to fetch the graph-logouturl. Function call: $this->fb_connect->logoutUrl();
                public function logoutUrl($params=array())
                {
                    $logoutUrl = $this->getLogoutUrl($params);
                    if(!empty($logoutUrl))
                        return $logoutUrl;
                    else
                        return NULL;
                }
                //Use this function to clear all persistent cookies. Function call: $this->fb_connect->clearAllPersistentData();
                public function clearAllPersistentData() {
                    parent::clearAllPersistentData();
                    log_message('Info',"Successfully cleared all the persistent cookies");
                }

	} // end class
?>