<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rents extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Admin_rents_model');
		$this->common_model->checkForValidUser();
		$this->load->model('asset_model');
     }

	
	public function index()
	{
		
		// $data['list_cars'] = $this->Admin_rents_model->listProducts();		
		// $this->load->view('admin/list_cars',$data);
	}

	public function listCars()
	{	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=25;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_rents_model->listCars($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_cars']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_cars']=$result['totalRows'];			
		
		$this->load->view('admin/list_rents', $data);	
	}

	public function addCar()
	{	
		$data['actionType']='add';
		$this->config->load('site_settings');

		$data['countries']=$this->common_model->getRows('SELECT country from countries where state=1 limit 6');

		$data['dealers'] = $this->Admin_rents_model->getDealers();

		

		$data['car_body_type']=$this->config->item('car_body_type');
		$data['fuel_type']=$this->config->item('fuel_type');
		$data['color']=$this->config->item('color');
		$data['specs']=$this->config->item('specs');
		$data['city']=$this->config->item('city');
		$data['make'] = $this->common_model->getMakeList();
		$this->load->view('admin/edit_rent',$data);
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

		// if ($this->input->post('featured')){
		// 	$featured = 1;
			
		// }else{
		// 	$featured = 0;
			
		// }

		if ($this->input->post('user')==0) {
            $code = "P";            
        } else{
            $code = "D";            
        }

		// $this->form_validation->set_rules('year', 'Year', 'required');
		// $this->form_validation->set_rules('make_id', 'Make', 'required|callback_select_validate');		
  		// $this->form_validation->set_rules('model_id', 'Model', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile', 'required');
				
			

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
                'price_per_day' => $this->input->post('price_per_day'),
                'price_per_week' => $this->input->post('price_per_week'),
                'price_per_month' => $this->input->post('price_per_month'),
                'body_type' => $this->input->post('body_type'),  
								'des' => $this->input->post('des'),
								'booked_date' => $this->input->post('booked_date'), 
							
								

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
								//'video' => $this->input->post('video'),
								//'featured' => $featured,
								'badges' => $badges,


                'created_dt' => $date,              
                'edited_dt' => $date,
                'created_by' => $email,
                'edited_by' => $email,
                'state' => 1
				);			
			$insert_id = $this->Admin_rents_model->insertCar($data);	

			$this->asset_model->addAsset($insert_id, 'Rent');

			
            $_SESSION['sess_alert'] = '<strong>Car</strong> added successfully!';
            redirect($last_link . '?err=1');
               
        }        
        

		
	}

	public function editCar($id="")
	{	
		$data['actionType']='update';
		$this->config->load('site_settings');

		$data['car'] = $this->Admin_rents_model->editCar($id);
		//print_r($data['car']);die;
		$data['dealers'] = $this->Admin_rents_model->getDealers();

		$data['countries']=$this->common_model->getRows('SELECT country from countries where state=1 limit 6');
		$data['city_list'] = $this->common_model->getRows('SELECT city FROM country_city WHERE state=1 and country="' . $data['car']['country'] . '" order by city');

		$data['car_body_type']=$this->config->item('car_body_type');
		$data['fuel_type']=$this->config->item('fuel_type');
		$data['color']=$this->config->item('color');

		$data['specs']=$this->config->item('specs');
		$data['city']=$this->config->item('city');
		

		
		$data['make'] = $this->common_model->getMakeList();
		$data['model']=$this->common_model->getRows('SELECT id,model FROM model WHERE make_id="'.$data['car']['make_id'].'" AND state=1 ORDER BY model ');
		
		$data['assets'] = $this->asset_model->getAssets('Rent', $id);
				
		$this->load->view('admin/edit_rent',$data);
	}

	public function updateCar()
    {	
    	$car_id=$this->input->post('car_id');    	
    	$data['car'] = $this->Admin_rents_model->updateCar($car_id);	

    	$this->asset_model->addAsset($car_id, 'Rent');

		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Car </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deleteCar($id)
	{
    	$delete = $this->Admin_rents_model->deleteCar($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Car </strong> has been deleted successfully!';            	
		redirect('admin/rents/listcars/?err=1');
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

        redirect('admin/rents/editCar/' . $section_id . '/suc');
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

		$result=$this->Admin_rents_model->listCarsApprove($limit,$page);
		
		
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
        redirect('admin/rents/approveCars/');
    }

    public function deleteImage($id) {
        $this->asset_model->removeAsset($id, "Car");
        redirect('admin/rents/approveCars/');
    }


	

	








}
