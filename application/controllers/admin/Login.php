<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('admin_user_model');
		
     }

	
	public function index($flag='')
	{
		if($this->session->userdata('userid'))
		{
				redirect('admin/dashboard');
		}
		
		$data['flag']=$flag;
		$this->load->view("admin/login.php",$data);
	}

	function validateUser(){
	  	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view("admin/login.php");
		}else{	

			$result = $this->admin_user_model->validate();
				 
			if(!$result){
            	// If user did not validate, then show them login page again
           		redirect('admin/login/index/1', 'location');					 
      		}else{
	            // If user did validate, 
	            // Send them to members area	           	
				redirect('admin/dashboard', 'location');
      		  }        
		
		    }
	   }
	  
	public function logOut()
	{
		$this->load->helper('cookie');
		$userData = array(
                    'userid' => '',
                    'fname' => '',
                    'lname' => '',
                    'email' => '',
                    'validated' => false
	    );
		$this->session->set_userdata($userData);
		$this->session->sess_destroy();
		delete_cookie('ci_session');
		redirect('admin/login/','location');
	} 



}
