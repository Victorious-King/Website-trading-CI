<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('main_model');			
	}


	public function index()
	{				
		if ($this->session->userdata('user_id')) {
			redirect(''. base_url() .'my-account/dashboard/');
		}else{
			$this->load->view('register', $data);
		}		
		
	}



	



	


}
