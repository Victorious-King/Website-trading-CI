<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cars extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Admin_cars_model');
		$this->common_model->checkForValidUser();
		$this->load->model('asset_model');
     }

	
	public function index()
	{
		
		// $data['list_cars'] = $this->Admin_cars_model->listProducts();		
		// $this->load->view('admin/list_cars',$data);
	}

	public function listCars()
	{	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=25;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_cars_model->listCars($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_cars']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_cars']=$result['totalRows'];			
		
		$this->load->view('admin/list_cars', $data);	
	}

	public function addCar()
	{	
		$data['actionType']='add';
		$this->config->load('site_settings');

		$data['countries']=$this->common_model->getRows('SELECT country from countries where state=1 limit 6');

		$data['dealers'] = $this->Admin_cars_model->getDealers();

		

		// $data['car_body_type']=$this->config->item('car_body_type');
		// $data['fuel_type']=$this->config->item('fuel_type');
		// $data['color']=$this->config->item('color');
		// $data['specs']=$this->config->item('specs');

		$data['car_body_type']=$this->common_model->getRows('SELECT id,body_type,body_type_ar,body_type_cn from car_body_type where state=1 order by id ASC');

		$data['fuel_type']=$this->common_model->getRows('SELECT id,fuel_type,fuel_type_ar,fuel_type_cn from car_fuel_type where state=1 order by id ASC');

		$data['color']=$this->common_model->getRows('SELECT id,color,color_ar,color_cn from car_color where state=1 order by id ASC');

		$data['specs']=$this->common_model->getRows('SELECT id,specs,specs_ar,specs_cn from car_specs where state=1 order by id ASC');

		$data['trans']=$this->common_model->getRows('SELECT id,trans,trans_ar,trans_cn from car_trans where state=1 order by id ASC');

		$data['city']=$this->config->item('city');
		$data['make'] = $this->common_model->getMakeList();
		$this->load->view('admin/edit_car',$data);
	}

	
	public function insertCar($flag="")
	{	

		$user= $this->input->post('user');

		$data['actionType']='add';
		$email=$this->session->userdata('email');
		$date = date('Y-m-d H:i:s');

		$title=$this->input->post('title');
		$title_slug = $this->common_model->create_slug($title);	

		$expiry=date('Y-m-d', strtotime("+180 days"));

		if ($this->input->post('featured')){
			$featured = 1;
			
		}else{
			$featured = 0;
			
		}

		if ($this->input->post('user')==0) {
            $code = "P";            
        } else{
            $code = "D";            
        }

		// $this->form_validation->set_rules('year', 'Year', 'required');
		// $this->form_validation->set_rules('make_id', 'Make', 'required|callback_select_validate');		
  		// $this->form_validation->set_rules('model_id', 'Model', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile', 'required');
				
				$badges_arr=$this->input->post('badges');
        
				if(is_array($badges_arr) && !empty($badges_arr)){
						$badges   = implode(',',$badges_arr);
				}   
        

        if (($this->form_validation->run() == FALSE)) {            
            $last_link = $this->input->post('last_link') . '?err=1';
            $_SESSION['sess_alert'] = validation_errors();
            redirect($last_link);
        } else { 
        $last_link = $this->input->post('last_link');           
                $data=array(
                'title' => $title,
                'title_slug' => $title_slug,
                'year' => $this->input->post('year'),				
								'make_id' => $this->input->post('make_id'),
								'model_id' => $this->input->post('model_id'),
                'price' => $this->input->post('price'),
                'mileage' => $this->input->post('mileage'),
                'mil' => $this->input->post('mil'),

                'body_type' => $this->input->post('body_type'),                
                'fuel_type' => $this->input->post('fuel_type'),
				'ex_color' => $this->input->post('ex_color'),
				'in_color' => $this->input->post('in_color'),
				'specs' => $this->input->post('specs'),
				'trans' => $this->input->post('trans'), 

				'body_type_id' => $this->input->post('body_type_id'),                
				'fuel_type_id' => $this->input->post('fuel_type_id'),
				'ex_color_id' => $this->input->post('ex_color_id'),
				'in_color_id' => $this->input->post('in_color_id'),
				'specs_id' => $this->input->post('specs_id'),
				'trans_id' => $this->input->post('trans_id'),


				'des' => $this->input->post('des'),
				'condition' => $this->input->post('condition'), 
								
								

                'user_id' => $this->input->post('user'),
                'code' => $code,
                'ip'   => $_SERVER["REMOTE_ADDR"],
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'location' => $this->input->post('location'),
                'mobile' => $this->input->post('mobile'),
                'expiry' => $expiry,
                'lat' => $this->input->post('lat'),
                'lng' => $this->input->post('lng'),
								'video' => $this->input->post('video'),
								'featured' => $featured,
								'badges' => $badges,


                'created_dt' => $date,              
                'edited_dt' => $date,
                'created_by' => $email,
                'edited_by' => $email,
                'state' => 1
				);			
			$insert_id = $this->Admin_cars_model->insertCar($data);	

			$this->asset_model->addAsset($insert_id, 'Car');

			
            $_SESSION['sess_alert'] = '<strong>Car</strong> added successfully!';
            redirect($last_link . '?err=1');
               
        }        
        

		
	}

	public function editCar($id="")
	{	
		$data['actionType']='update';
		$this->config->load('site_settings');

		$data['car'] = $this->Admin_cars_model->editCar($id);
		//print_r($data['car']);die;
		$data['dealers'] = $this->Admin_cars_model->getDealers();

		$data['countries']=$this->common_model->getRows('SELECT country from countries where state=1 limit 6');
		$data['city_list'] = $this->common_model->getRows('SELECT city FROM country_city WHERE state=1 and country="' . $data['car']['country'] . '" order by city');

		// $data['car_body_type']=$this->config->item('car_body_type');
		// $data['fuel_type']=$this->config->item('fuel_type');
		// $data['color']=$this->config->item('color');
		// $data['specs']=$this->config->item('specs');

		$data['car_body_type']=$this->common_model->getRows('SELECT id,body_type,body_type_ar,body_type_cn from car_body_type where state=1 order by id ASC');

		$data['fuel_type']=$this->common_model->getRows('SELECT id,fuel_type,fuel_type_ar,fuel_type_cn from car_fuel_type where state=1 order by id ASC');

		$data['color']=$this->common_model->getRows('SELECT id,color,color_ar,color_cn from car_color where state=1 order by id ASC');

		$data['specs']=$this->common_model->getRows('SELECT id,specs,specs_ar,specs_cn from car_specs where state=1 order by id ASC');

		$data['trans']=$this->common_model->getRows('SELECT id,trans,trans_ar,trans_cn from car_trans where state=1 order by id ASC');

		$data['city']=$this->config->item('city');
		

		
		$data['make'] = $this->common_model->getMakeList();
		$data['model']=$this->common_model->getRows('SELECT id,model FROM model WHERE make_id="'.$data['car']['make_id'].'" AND state=1 ORDER BY model ');
		
		$data['assets'] = $this->asset_model->getAssets('Car', $id);
				
		$this->load->view('admin/edit_car',$data);
	}

	public function updateCar()
    {	
    	$car_id=$this->input->post('car_id');    	
    	$data['car'] = $this->Admin_cars_model->updateCar($car_id);	

    	$this->asset_model->addAsset($car_id, 'Car');

		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Car </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deleteCar($id)
	{
    	$delete = $this->Admin_cars_model->deleteCar($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Car </strong> has been deleted successfully!';            	
		redirect('admin/cars/listcars/?err=1');
	}

	public function getSubcat($id="")
	{	
		$dt=$this->common_model->getRows('SELECT * FROM subcategory WHERE catid='.$id.' AND state=1 ORDER BY subcat ');	
		//echo 'SELECT * FROM subcategory WHERE catid="'.$id.'" AND state=1 ORDER BY subcat ';	
		$body=' <option value="">-- Select --</option>';
		foreach ($dt as $row)
			{
				$body.='<option value="'.$row['id'].'">'.$row['subcat'].'</option>';;
			}
			
			echo $body;
			exit;
	}

	public function removeAsset($id, $section_id) {

        $this->asset_model->removeAsset($id);

        redirect('admin/cars/editCar/' . $section_id . '/suc');
    }


    public function approveCars()
	{	

		$imd_ids = $this->input->post('checked');
        if ($imd_ids) {
            $this->asset_model->approveCkImages($imd_ids, "Car");
        }

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=25;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_cars_model->listCarsApprove($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_cars']=$result['search_result'];
		}

		//echo"<pre>";print_r($data['list_cars']);echo"</pre>";die;
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_cars']=$result['totalRows'];			
		
		$this->load->view('admin/list_cars_approve', $data);	
	}

	public function approveImage($id,$section,$section_id) {
        $this->asset_model->approveAsset($id, "Car",$section_id);
        redirect('admin/cars/approveCars/');
    }

    public function deleteImage($id) {
        $this->asset_model->removeAsset($id, "Car");
        redirect('admin/cars/approveCars/');
	}
	
	public function deletecar_com()
	{	

		$ids = $this->input->post('chk');		

		if ($ids) {
            $this->Admin_cars_model->delchecked("cars", $ids);
        }

		//print_r($ids);

		

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=200;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_cars_model->listCars_del($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_cars']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_cars']=$result['totalRows'];			
		
		$this->load->view('admin/list_cars_del', $data);	
	}


	

	








}
