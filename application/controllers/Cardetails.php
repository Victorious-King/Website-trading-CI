<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cardetails extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Cars_model');		
		
     }

	function _remap($method, $args) {

        if (method_exists($this, $method)) {
            $this->$method($args);
        } else {
            $this->index($method, $args);
        }
    }
    
	public function index()
	{
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
