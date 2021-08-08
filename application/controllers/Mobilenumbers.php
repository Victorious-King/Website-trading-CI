<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobilenumbers extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Mobilenumbers_model');		
		
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

		$result=$this->Mobilenumbers_model->listMobilenumbers($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_mobilenumbers']=$result['search_result'];
		}else {
            $data['no_result'] = 'No Results Found.' ;
    }

		//echo"<pre>";print_r($data['list_mobilenumbers']);echo"</pre>";
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,$dealer='');

		$data['total_mobilenumbers']=$result['totalRows'];	

    $data['plate_city'] = $this->common_model->getplatecity();
    
    $data['citycode']=$this->common_model->getRows('SELECT id,code FROM plate_citycode WHERE city_id="'.$this->input->get('city_id').'" AND state=1 ORDER BY code ');
    
    $this->config->load('site_settings');
		$data['operator']=$this->config->item('mobile_operator');
		
		$data['du_ct'] = $this->Mobilenumbers_model->get_ct($operator="Du");
		$data['etisalat_ct'] = $this->Mobilenumbers_model->get_ct($operator="Etisalat");
		$data['virgin_ct'] = $this->Mobilenumbers_model->get_ct($operator="Virgin-Mobile");

		$data['tag_contents'] = $this->Mobilenumbers_model->get_contents_default();

		$this->load->view('mobilenumbers', $data);

	}

	function mobilenumberdetails(){

		
		$last_seg = $this->uri->total_segments();
		$mobile_id = $this->uri->segment($last_seg);
		        
        //$plate_id = $this->uri->segment($last_seg);

        $data['mobile'] = $this->Mobilenumbers_model->getMobilenumberDetails($mobile_id);    

				//echo"<pre>";print_r($data['mobile']);echo"</pre>";  
				
				$user_id=$data['mobile']['user_id'];
				
				$data['assets_logo'] = $this->asset_model->getAssetsLogo('CoLogover', $user_id);

				//echo"<pre>";print_r($data['assets_logo']);echo"</pre>";    

        if(!empty($data['mobile'])){  						
						$this->load->view('mobile_details', $data);
        }else{
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".base_url()."mobilenumbers/");
        }
    }



	


}
