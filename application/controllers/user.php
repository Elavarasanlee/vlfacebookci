<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User.php
 * 
 * Description: This controller file is used to access usr data
 * 
 * @package user
 * @author Lee
 * @version 0.0.0
 */

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
            $this->load->library('fb_connect');
            $data['loginUrl'] = $this->fb_connect->loginUrl();
            $data['title'] = 'Login';
            $this->load->view('userview',$data);
	}
        
        public function home()
        {
            $this->load->library('fb_connect');
        }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
?>