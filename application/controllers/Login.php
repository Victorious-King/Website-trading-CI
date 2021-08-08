<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('main_model');	
		
		// Load google oauth library
		$this->load->library('google');
	}


	public function index()
	{		
		if ($this->session->userdata('user_id')) {
			redirect(''. base_url() .'myaccount/dashboard/');
		}else{   
			
			// Google authentication url
			$data['loginURL'] = $this->google->loginURL();
			
      $this->load->view('login', $data);
		}	
		
	}

	public function forgotPassword()
	{	
    
    $this->load->view('reset_password_email', $data);
		
	}

	



	


}
