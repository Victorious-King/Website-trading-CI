<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myaccount extends CI_Controller {

	var $user_id;

	function __construct() {

        parent::__construct();

        if (!$this->session->userdata('user_id')) {
           
            redirect(base_url());
           
        }

        
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('main_model');   
        //$this->load->model('dashboard_model');   
        
    }


	public function index()
	{			
		
	}


	public function dashboard()
	{	
		$data['myads_cars'] =  $this->common_model->getNumberOfRows('SELECT id from cars where user_id="' . $this->user_id . '" AND (state=1 or state=2) AND (expiry >="' . $this->common_model->dt . '")');	
		//print_r($data['myads_cars']);die;    
		$this->load->view('dashboard', $data);
		
	}

	public function settings()
	{	
		
		$data['settings'] = $this->main_model->getPersonalDetails($this->user_id);   
        //print_r($data['settings']);  
        $this->load->view('settings', $data);
	}

	public function updateAccount() { 
		
		
    
    $this->form_validation->set_rules('mobile', 'Mobile', 'required');  
        
        if ($this->form_validation->run() == FALSE)
        {             
            $_SESSION['sess_alert']=validation_errors();
            redirect(''. base_url() .'myaccount/settings/?st=2');
        }else{       
            $result = $this->main_model->updatePersonalDetails($this->user_id);
            $_SESSION['sess_alert']='Personal details has been updated successfully!';                         
            redirect(''. base_url() .'myaccount/settings/?st=1');
        }
}
	



	


}
