<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bikes extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Bikes_model');		
		
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

		$ptype=$this->uri->segment(1);
		//echo $ptype;die;
		$limit=20;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Bikes_model->listbikes($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_bikes']=$result['search_result'];
		}else {
      $data['no_result'] = 'No Results Found.' ;
    }

		//echo"<pre>";print_r($data['list_bikes']);echo"</pre>";
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,$dealer='');

		$data['total_bikes']=$result['totalRows'];	

		$make_id=$this->input->get('bike_make');
		$data['bike_make'] = $this->common_model->getBikeMakeList();
		
		$data['year'] = range(date("Y")+1, date("Y") - 70);

    $makeid=$data['list_bikes'][0]['make_id'];
    
    
		$data['bike_make'] = $this->common_model->getBikeMakeList();

		// $user_id=$data['list_bikes'][0]['user_id'];

		// $data['assets_logo'] = $this->asset_model->getAssetsLogo('Logo', $user_id);
		

		//echo"<pre>";print_r($data['bike_make']);echo"</pre>";

		$result_make=$this->common_model->getBikeMakes();

		$data['list_makes']=$result_make['all_make'];

		//echo"<pre>";print_r($data['list_makes']);echo"</pre>";

		$data['tag_contents'] = $this->Bikes_model->get_contents_default();


		$this->load->view('bikes', $data);

	}

	function bikedetails(){

		
		$last_seg = $this->uri->total_segments();
		$bike_id = $this->uri->segment($last_seg);
		        
        $bike_id = $this->uri->segment($last_seg);

        $data['bike'] = $this->Bikes_model->getBikeDetails($bike_id);    

				//echo"<pre>";print_r($data['bike']);echo"</pre>";  
				$user_id=$data['bike']['user_id'];
				$data['assets_logo'] = $this->asset_model->getAssetsLogo('Logo', $user_id);

				// echo $user_id;
				// echo"<pre>";print_r($data['assets_logo']);echo"</pre>"; 

				

        if(!empty($data['bike'])){  						
						$this->load->view('bike_details', $data);
        }else{
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".base_url()."bikes/");
        }
    }



	


}
