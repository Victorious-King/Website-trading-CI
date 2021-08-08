<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cars extends CI_Controller {

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
		
		$this->config->load('site_settings');

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=20;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Cars_model->listCars($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_cars']=$result['search_result'];
		}else {
            $data['no_result'] = 'No Results Found.' ;
    }

		//echo"<pre>";print_r($data['list_cars']);echo"</pre>";
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,$dealer='');

		$data['total_cars']=$result['totalRows'];	

		$make_id=$this->input->get('car_make');
		$data['make'] = $this->common_model->getMakeList();
		$data['model']=$this->common_model->getRows('SELECT id,model,model_ar,model_cn FROM model WHERE make_id="'.$make_id.'" AND state=1 ORDER BY model ');
		$data['year'] = range(date("Y")+1, date("Y") - 70);

		$data['color']=$this->common_model->getRows('SELECT id,color,color_ar,color_cn from car_color where state=1 order by id ASC');

		$data['specs']=$this->common_model->getRows('SELECT id,specs,specs_ar,specs_cn from car_specs where state=1 order by id ASC');

		

		$result_make=$this->common_model->getMakeListCar();

		$data['list_make']=$result_make['all_make'];

		//echo"<pre>";print_r($data['list_make']);echo"</pre>";

		$makeid=$data['list_cars'][0]['make_id'];
		$modelid=$data['list_cars'][0]['model_id'];
		
		//$user_id=$data['list_cars'][0]['user_id'];
		//$data['assets_logo'] = $this->asset_model->getAssetsLogo('Logo', $user_id);
		//print_r($data['tag']);

		$data['city']=$this->config->item('city');

		if ($this->uri->segment(1) == 'ar') {
				$car_make_url= $this->uri->segment(3);
				$car_model_url= $this->uri->segment(4);
		}else if ($this->uri->segment(1) == 'cn') {
			$car_make_url= $this->uri->segment(3);
			$car_model_url= $this->uri->segment(4);
	
		}else{
				$car_make_url= $this->uri->segment(2);
				$car_model_url= $this->uri->segment(3);
		}

		//echo $car_model_url;

		if($car_make_url == 'mercedes-benz'){
			$make_name = $car_make_url;
		}else{
			$make_name = str_replace("-", " ", $car_make_url);
		}

		$get_model_id = $this->common_model->getMakeID($make_name);
		

		$makeid_getmodel=$get_model_id['id'];

		if($car_make_url){
			$result_model=$this->common_model->getModelListCar($makeid_getmodel);
			$data['list_model']=$result_model['all_model'];
		}
				
		//echo"<pre>";print_r($data['list_model']);echo"</pre>";
		

		$data['car_make_url'] = $car_make_url;
		$data['car_model_url'] = $car_model_url;

	
		if($car_model_url && $car_make_url){			

			$data['tag_contents_model'] = $this->Cars_model->getTagDescModel($modelid);				

		}else if ($car_make_url){

			$data['tag_contents_make'] = $this->Cars_model->getTagDescMake($makeid);		

		} else{

			$data['contents'] = $this->Cars_model->get_contents_default();

		}


		if ($this->uri->segment(1) == 'ar') {
			$data['c_make']= $this->uri->segment(3);
			$data['c_model']= $this->uri->segment(4);
		}else if($this->uri->segment(1) == 'cn'){
			$data['c_make']= $this->uri->segment(3);
			$data['c_model']= $this->uri->segment(4);
		}else{
			$data['c_make']= $this->uri->segment(2);
			$data['c_model']= $this->uri->segment(3);
		}
		
	

		$this->load->view('cars', $data);

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
