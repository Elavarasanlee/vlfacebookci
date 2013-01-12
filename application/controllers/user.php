<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User.php
 * 
 * Description: This controller file is used to access user's facebook details
 * 
 * @package user
 * @author Elavarasan Lee
 * @version 1.0.0
 */

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
                $this->load->library('fb_connect');
	}
	
	public function index()
	{
            $data['base_url'] = base_url();
            //$param['next'] = ''; If you want to be redireted to different controller use this variable. If not set user'll be redirected to current url.
            //$param['scope'] = ''; If you want to access extended permissions and/or any specific basic permissins use this variable. If not set only basic permissions'll be requested.
            $data['loginUrl'] = $this->fb_connect->loginUrl();
            $data['title'] = 'Login';
            $data['fb_uid'] = $this->fb_connect->user_id();
            $data['loggedIn'] = $this->session->userdata('loggedIn'); 
            if($data['fb_uid'] != FALSE) {
                $this->session->set_userdata('loggedIn',TRUE); //For maintaining your own session. Its a good practice to maintain seperate session rather than sharing fb's session.
                $data['loggedIn'] = $this->session->userdata('loggedIn');
                $data['title'] = 'Welcome';
                $param['next'] = base_url('user/logout');
                $data['logoutUrl'] = $this->fb_connect->logoutUrl($param);
                $data['userAccessToken'] = $this->fb_connect->userAccessToken();
                $data['user'] = $this->fb_connect->user();
                $friendsArray = $this->fb_connect->friends();
                $data['friends'] = $friendsArray['data'];
            }
            $this->load->view('userview',$data);
	}
        
        public function friendsList()
        {
            $data['fb_uid'] = $this->fb_connect->user_id();
            $data['loggedIn'] = $this->session->userdata('loggedIn');
            $data['loginUrl'] = $this->fb_connect->loginUrl();
            if($data['fb_uid']!=FALSE && $data['loggedIn']!=FALSE) {
                $param['next'] = base_url('user/logout');
                $data['logoutUrl'] = $this->fb_connect->logoutUrl($param);
                $friendsArray = $this->fb_connect->friends();
                $data['friends'] = $friendsArray['data'];
                $this->load->view('friendslist',$data);
            }
            else {
                echo '<div style="color: red;">Pls! Login to see ur friends list!<div>';
                $this->index();
            }
                
        }

        public function logout()
        {
            $this->session->unset_userdata('loggedIn');
            $this->session->sess_destroy();
            $this->fb_connect->clearAllPersistentData();
            redirect(base_url('user'));
        }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
?>