<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User.php
 * 
 * Description: This controller file is used to access usr data
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
            $data['loginUrl'] = $this->fb_connect->loginUrl();
            $data['title'] = 'Login';
            $data['fb_uid'] = $this->fb_connect->user_id();
            $data['loggedIn'] = $this->session->userdata('loggedIn');
            if($data['fb_uid'] != FALSE) {
                $this->session->set_userdata('loggedIn',TRUE);
                $data['loggedIn'] = $this->session->userdata('loggedIn');
                $data['title'] = 'Welcome';
                $param['next'] = base_url('index.php/user/logout');
                $data['logoutUrl'] = $this->fb_connect->logoutUrl($param);
                $data['userAccessToken'] = $this->fb_connect->userAccessToken();
                $data['user'] = $this->fb_connect->user();
                $friendsArray = $this->fb_connect->friends();
                $data['friends'] = $friendsArray['data'];
            }
            $this->load->view('userview',$data);
	}
        
        public function logout()
        {
            $this->session->unset_userdata('loggedIn');
            $this->session->sess_destroy();
            $this->fb_connect->clearAllPersistentData();
            redirect(base_url('index.php/user'));
        }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
?>