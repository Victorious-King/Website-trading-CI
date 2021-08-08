<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Success extends CI_Controller {

	function __construct() {
        parent::__construct();        
    }


	public function index()
	{	
    $this->load->view('success', $data);
	}


	public function payment()
	{	
    $this->load->view('succ', $data);
	}

	public function adsuccess()
	{	
    $this->load->view('succ_ad', $data);
	}

	

    


	



	


}
