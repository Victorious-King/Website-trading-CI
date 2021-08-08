<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Numberplates extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Numberplates_model');		
		
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
	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=30;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Numberplates_model->listNumberplates($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_numberplates']=$result['search_result'];
		}else {
            $data['no_result'] = 'No Results Found.' ;
    }

		//echo"<pre>";print_r($data['list_numberplates']);echo"</pre>";
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,$dealer='');

		$data['total_numberplates']=$result['totalRows'];	

    $data['plate_city'] = $this->common_model->getplatecity();
    
		$data['citycode']=$this->common_model->getRows('SELECT id,code FROM plate_citycode WHERE city_id="'.$this->input->get('city_id').'" AND state=1 ORDER BY code ');
		
		$data['dubai_ct'] = $this->Numberplates_model->get_ct($city_id=3);
		$data['abudhabi_ct'] = $this->Numberplates_model->get_ct($city_id=1);
		$data['ajman_ct'] = $this->Numberplates_model->get_ct($city_id=2);
		$data['fujairah_ct'] = $this->Numberplates_model->get_ct($city_id=4);
		$data['uaq_ct'] = $this->Numberplates_model->get_ct($city_id=5);
		$data['rak_ct'] = $this->Numberplates_model->get_ct($city_id=6);
		$data['sharjah_ct'] = $this->Numberplates_model->get_ct($city_id=7);

		//print_r($data['dubai_ct']);

		$data['tag_contents'] = $this->Numberplates_model->get_contents_default();
	

		$this->load->view('numberplates', $data);

	}

	function platedetails(){

		
		$last_seg = $this->uri->total_segments();
		$plate_id = $this->uri->segment($last_seg);
		        
        //$plate_id = $this->uri->segment($last_seg);

        $data['plate'] = $this->Numberplates_model->getPlateDetails($plate_id);    

				//echo"<pre>";print_r($data['plate']);echo"</pre>";  
				
				$user_id=$data['plate']['user_id'];
				
				$data['assets_logo'] = $this->asset_model->getAssetsLogo('CoLogover', $user_id);

				//echo"<pre>";print_r($data['assets_logo']);echo"</pre>";    

        if(!empty($data['plate'])){  						
						$this->load->view('plate_details', $data);
        }else{
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".base_url()."numberplates/");
        }
    }



	


}
