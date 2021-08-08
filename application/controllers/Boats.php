<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boats extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Boats_model');		
		
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

		$result=$this->Boats_model->listboats($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_boats']=$result['search_result'];
		}else {
      $data['no_result'] = 'No Results Found.' ;
    }

		//echo"<pre>";print_r($data['list_boats']);echo"</pre>";
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,$dealer='');

		$data['total_boats']=$result['totalRows'];	

		$make_id=$this->input->get('boat_make');
		$data['boat_make'] = $this->common_model->getBoatMakeList();
		
		$data['year'] = range(date("Y")+1, date("Y") - 70);

    $makeid=$data['list_boats'][0]['make_id'];
    
    $data['boat_type'] = $this->common_model->getBoatType();
		$data['boat_make'] = $this->common_model->getBoatMakeList();

		//$user_id=$data['list_boats'][0]['user_id'];

		//$data['assets_logo'] = $this->asset_model->getAssetsLogo('Logo', $user_id);
		

		//print_r($data['boat_type']);

		// $data['boat_types']=$this->common_model->getBoatTypes();

		// echo"<pre>";print_r($data['boat_types']);echo"</pre>";

		$result_type=$this->common_model->getBoatTypes();

		$data['list_types']=$result_type['all_type'];

		$data['tag_contents'] = $this->Boats_model->get_contents_default();

		$this->load->view('boats', $data);

	}

	function boatdetails(){

		
		$last_seg = $this->uri->total_segments();
		$boat_id = $this->uri->segment($last_seg);
		        
        $boat_id = $this->uri->segment($last_seg);

        $data['boat'] = $this->Boats_model->getBoatDetails($boat_id);    

				//echo"<pre>";print_r($data['boat']);echo"</pre>";  
				$user_id=$data['boat']['user_id'];
				$data['assets_logo'] = $this->asset_model->getAssetsLogo('Logo', $user_id);

				// echo $user_id;
				// echo"<pre>";print_r($data['assets_logo']);echo"</pre>"; 

				

        if(!empty($data['boat'])){  						
						$this->load->view('boat_details', $data);
        }else{
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".base_url()."boats-for-sale/");
        }
    }



	


}
