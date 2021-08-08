<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Postad extends CI_Controller {

	var $user_id;

	function __construct() {

        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');

        if (!$this->session->userdata('user_id')) {
           
            redirect(base_url().'login');
           
        }

        
        $this->user_id = $this->session->userdata('user_id');
        
        
        $this->load->model('asset_model');
    }

	
	public function index()
	{	
		$this->load->view('postad',$data);
	}

	public function car()
	{	
    $data['actionType']='add';
    $this->config->load('site_settings');
    
    if ($this->user_id) {
      //get phone number
      $user_exdet=$this->common_model->getRow('SELECT mobile,city,user_type,limit_featured FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
	//   echo 'SELECT mobile,city,user_type FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1';
			$data['phone_number'] = $user_exdet->mobile; 			    
      		$data['user_city'] = $user_exdet->city;
			$data['user_type'] = $user_exdet->user_type;
			$data['limit_featured'] = $user_exdet->limit_featured;
			//print_r($data['limit_featured']);   

			$data['featured_ct'] = $this->common_model->rowsCount('cars', 'user_id='.$this->user_id.' and featured=1');

			// print_r($data['featured_ct']);   echo "------";
			// print_r($data['limit_featured']);  echo "------";
			// print_r($data['user_type']);
			
  	}

	 


		//$data['car'] = $this->Admin_cars_model->editCar($id);
		//$data['dealers'] = $this->Admin_cars_model->getDealers();

		$data['countries']=$this->common_model->getRows('SELECT country from countries where state=1 limit 6');
		$data['city_list'] = $this->common_model->getRows('SELECT city FROM country_city WHERE state=1 and country="' . $data['car']['country'] . '" order by city');

		$data['car_body_type']=$this->config->item('car_body_type');

		// if ($this->uri->segment(1) == 'ar') {
		// 	$data['car_body_type']=$this->config->item('car_body_type_ar');
		// }else if($this->uri->segment(1) == 'cn'){
		// 	$data['car_body_type']=$this->config->item('car_body_type_cn');
		// }else{
		// 	$data['car_body_type']=$this->config->item('car_body_type');
		// }

		$data['car_body_type']=$this->common_model->getRows('SELECT id,body_type,body_type_ar,body_type_cn from car_body_type where state=1 order by id ASC');

		$data['fuel_type']=$this->common_model->getRows('SELECT id,fuel_type,fuel_type_ar,fuel_type_cn from car_fuel_type where state=1 order by id ASC');

		$data['color']=$this->common_model->getRows('SELECT id,color,color_ar,color_cn from car_color where state=1 order by id ASC');

		$data['specs']=$this->common_model->getRows('SELECT id,specs,specs_ar,specs_cn from car_specs where state=1 order by id ASC');

		$data['trans']=$this->common_model->getRows('SELECT id,trans,trans_ar,trans_cn from car_trans where state=1 order by id ASC');

		//$data['fuel_type']=$this->config->item('fuel_type');
		//$data['color']=$this->config->item('color');

		//$data['specs']=$this->config->item('specs');
		$data['city']=$this->config->item('city');
		

		
		$data['make'] = $this->common_model->getMakeList();
		$data['model']=$this->common_model->getRows('SELECT id,model FROM model WHERE make_id="'.$data['car']['make_id'].'" AND state=1 ORDER BY model ');
		
		$data['assets'] = $this->asset_model->getAssets('Car', $id);
				
		$this->load->view('edit_car',$data);
	
	

       

	}

	public function numberplate()
	{	
    $data['actionType']='add';
    $this->config->load('site_settings');
    
    if ($this->user_id) {
      //get phone number
      $user_exdet=$this->common_model->getRow('SELECT mobile,city FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
			$data['phone_number'] = $user_exdet->mobile; 			    
      $data['user_city'] = $user_exdet->city;
			$data['user_type'] = $user_exdet->type;
			//print_r($data['user_city']);   
  	}


		$data['city']=$this->config->item('city');
		$data['plate_city'] = $this->common_model->getplatecity();
				
		$this->load->view('edit_plate',$data);
	
	

       

	}

	public function boat()
	{	
    $data['actionType']='add';
    $this->config->load('site_settings');
    
    if ($this->user_id) {
      //get phone number
      $user_exdet=$this->common_model->getRow('SELECT mobile,city FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
			$data['phone_number'] = $user_exdet->mobile; 			    
      $data['user_city'] = $user_exdet->city;
			$data['user_type'] = $user_exdet->type;
			//print_r($data['user_city']);   
  	}

		$data['boat_type'] = $this->common_model->getBoatType();
		$data['boat_make'] = $this->common_model->getBoatMakeList();
		
		$data['city']=$this->config->item('city');	
		
		$data['assets'] = $this->asset_model->getAssets('Boat', $id);
				
		$this->load->view('edit_boat',$data);
	
	

       

	}

	public function bike()
	{	
    $data['actionType']='add';
    $this->config->load('site_settings');
    
    if ($this->user_id) {
      //get phone number
      $user_exdet=$this->common_model->getRow('SELECT mobile,city FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
			$data['phone_number'] = $user_exdet->mobile; 			    
      $data['user_city'] = $user_exdet->city;
			$data['user_type'] = $user_exdet->type;
			//print_r($data['user_city']);   
  	}
		
		$data['bike_make'] = $this->common_model->getBikeMakeList();
		
		$data['city']=$this->config->item('city');	
		
		$data['assets'] = $this->asset_model->getAssets('Bike', $id);
				
		$this->load->view('edit_bike',$data);
	
	

       

	}


	public function mobilenumber()
	{	
    $data['actionType']='add';
    $this->config->load('site_settings');
    
    if ($this->user_id) {
      //get phone number
      $user_exdet=$this->common_model->getRow('SELECT mobile,city FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
			$data['phone_number'] = $user_exdet->mobile; 			    
      $data['user_city'] = $user_exdet->city;
			$data['user_type'] = $user_exdet->type;
			//print_r($data['user_city']);   
  	}


		$data['city']=$this->config->item('city');
		$data['operator']=$this->config->item('mobile_operator');
		
				
		$this->load->view('edit_mobilenumber',$data);
	
	

       

	}



	

    


	



	


}
