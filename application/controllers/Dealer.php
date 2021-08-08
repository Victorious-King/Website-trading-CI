<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dealer extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct(){
      parent::__construct();	
      $this->load->model('Dealer_model');	 		
	 }


	 function _remap($method, $args) {

			if (method_exists($this, $method)) {
					$this->$method($args);
			} else {
					$this->index($method, $args);
			}
	}
	
	public function cars()
	{			
		$get_dealer_name=$this->uri->segment(1);

		
		$dealer_name = str_replace("-", " ", $get_dealer_name); 

		$data['dealer'] = $this->Dealer_model->getDealerDetails($dealer_name);  
		//echo"<pre>";print_r($data['dealer']);echo"</pre>";  
		//print_r($data['dealer']['id']);
		$dealer_id=$data['dealer']['id'];

		$limit=12;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Dealer_model->getCars($limit,$page,$dealer_id);
		
		
		if ($result['totalRows']){
			$data['list_cars']=$result['search_result'];
		}
		
		//echo $get_dealer_name;

		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,$get_dealer_name);

		$data['total_cars']=$result['totalRows'];	

		//echo"<pre>";print_r($data['list_cars']);echo"</pre>";

    $this->load->view('dealer', $data);
	}

	public function plates()
	{	    
		$get_dealer_name=$this->uri->segment(2);

		//echo $get_dealer_name;

		
		$dealer_name = str_replace("-", " ", $get_dealer_name); 

		$data['dealer'] = $this->Dealer_model->getDealerDetails($dealer_name);  
		//echo"<pre>";print_r($data['dealer']);echo"</pre>";  
		//print_r($data['dealer']['id']);
		$dealer_id=$data['dealer']['id'];

		$limit=16;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Dealer_model->getPlates($limit,$page,$dealer_id);
		
		
		if ($result['totalRows']){
			$data['list_numberplates']=$result['search_result'];
		}
		
		//echo $get_dealer_name;

		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,$get_dealer_name);

		$data['total_plates']=$result['totalRows'];	

		//echo"<pre>";print_r($data['list_plates']);echo"</pre>";


    $this->load->view('dealer_plates', $data);
	}

	public function boat()
	{	    
		$get_dealer_name=$this->uri->segment(2);

		//echo $get_dealer_name;

		
		$dealer_name = str_replace("-", " ", $get_dealer_name); 

		$data['dealer'] = $this->Dealer_model->getDealerDetails($dealer_name);  
		//echo"<pre>";print_r($data['dealer']);echo"</pre>";  
		//print_r($data['dealer']['id']);
		$dealer_id=$data['dealer']['id'];

		$limit=16;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Dealer_model->getBoats($limit,$page,$dealer_id);
		
		
		if ($result['totalRows']){
			$data['list_boats']=$result['search_result'];
		}
		
		//echo $get_dealer_name;

		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,$get_dealer_name);

		$data['total_boats']=$result['totalRows'];	

		//echo"<pre>";print_r($data['list_boats']);echo"</pre>";


    $this->load->view('dealer_boats', $data);
	}

}
