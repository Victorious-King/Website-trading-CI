<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Cars_model');		

		$this->perPage = 4;
		
     }

	function _remap($method, $args) {

        if (method_exists($this, $method)) {
            $this->$method($args);
        } else {
            $this->index($method, $args);
        }
    }


	function loadMoreData(){
		//$conditions = array();
		
		// Get last post ID
		$lastID = $this->input->post('id');

		//echo $lastID;

		//$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		//$limit=20;
		//$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Cars_model->listCars($this->perPage,$lastID);
		
		
		if ($result['totalRows']){
			$data['list_cars']=$result['search_result'];
		}else {
      $data['no_result'] = 'No Results Found.' ;
		}
		
		
		// Get post rows num
		// $conditions['where'] = array('id <'=>$lastID);
		// $conditions['returnType'] = 'count';
		$data['postNum'] = $result['totalRows'];
		
		// Get posts data from the database
		// $conditions['returnType'] = '';
		// $conditions['order_by'] = "id DESC";
		// $conditions['limit'] = $this->perPage;
		// $data['posts'] = $this->post->getRows($conditions);
		
		$data['postLimit'] = $this->perPage;
		
		// Pass data to view
		$this->load->view('load-more-cars', $data, false);
}

	function cardetails(){

		
		$last_seg = $this->uri->total_segments();
		$car_id = $this->uri->segment($last_seg);
		        
        $car_id = $this->uri->segment($last_seg);

        $data['car'] = $this->Cars_model->getCarDetails($car_id);    

        //echo"<pre>";print_r($data['car']);echo"</pre>";    

        if(!empty($data['car'])){  						
						$this->load->view('car_details', $data);
        }else{
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".base_url()."cars-for-sale/");
        }
    }



	


}
