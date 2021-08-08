<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	function __construct()
		{

			parent::__construct();						
			$this->common_model->checkForValidUser();

		}


	function index(){
		
		$this->load->view('admin/dashboard');
	}

	
}
