<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bikes extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Admin_bikes_model');
		$this->common_model->checkForValidUser();
		$this->load->model('asset_model');
     }

	
	public function index()
	{
		
		// $data['list_bikes'] = $this->Admin_bikes_model->listProducts();		
		// $this->load->view('admin/list_bikes',$data);
	}

	public function listBikes()
	{	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=25;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_bikes_model->listBikes($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_bikes']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_bikes']=$result['totalRows'];			
		
		$this->load->view('admin/list_bikes', $data);	
	}

	public function addBike()
	{	
    $data['actionType']='add';
    $this->config->load('site_settings');
    
		$data['dealers'] = $this->Admin_bikes_model->getDealers();

    $data['city']=$this->config->item('city');    
		$data['bike_make'] = $this->common_model->getBikeMakeList();
		$this->load->view('admin/edit_bike',$data);
	}

	
	public function insertBike($flag="")
	{	

		$user= $this->input->post('user');

		$data['actionType']='add';
		$email=$this->session->userdata('email');
		$date = date('Y-m-d H:i:s');

		$title=$this->input->post('title');
		$title_slug = $this->common_model->create_slug($title);	

		$expiry=date('Y-m-d', strtotime("+180 days"));

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
								'price' => $this->input->post('price'),   
								'condition' => $this->input->post('condition'),              
								'des' => $this->input->post('des'),

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
								'featured' => $this->input->post('featured'),
								
                'created_dt' => $date,              
                'edited_dt' => $date,
                'created_by' => $email,
                'edited_by' => $email,
                'state' => 1
				);			
			$insert_id = $this->Admin_bikes_model->insertBike($data);	

			$this->asset_model->addAssetBike($insert_id, 'Bike');

			
            $_SESSION['sess_alert'] = '<strong>Bike</strong> added successfully!';
            redirect($last_link . '?err=1');
               
        }        
        

		
	}

	public function editBike($id="")
	{	
		$data['actionType']='update';
    $this->config->load('site_settings');    
    
		$data['bike_make'] = $this->common_model->getBikeMakeList();

		$data['bike'] = $this->Admin_bikes_model->editBike($id);
		//print_r($data['car']);die;
		$data['dealers'] = $this->Admin_bikes_model->getDealers();

	
		$data['city']=$this->config->item('city');
		
		$data['assets'] = $this->asset_model->getAssetsBike('Bike', $id);
				
		$this->load->view('admin/edit_bike',$data);
	}

	public function updateBike()
    {	
    	$bike_id=$this->input->post('bike_id');    	
    	$data['bike'] = $this->Admin_bikes_model->updateBike($bike_id);	

    	$this->asset_model->addAssetBike($bike_id, 'Bike');

		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Bike </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deleteBike($id)
	{
    	$delete = $this->Admin_bikes_model->deleteBike($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Bike </strong> has been deleted successfully!';            	
		redirect('admin/bikes/listbikes/?err=1');
	}



	public function removeAsset($id, $section_id) {

        $this->asset_model->removeAssetBike($id);

        redirect('admin/bikes/editBike/' . $section_id . '/suc');
    }


  public function approveBikes()
	{	

		$imd_ids = $this->input->post('checked');
        if ($imd_ids) {
            $this->asset_model->approveCkImages($imd_ids, "Bike");
        }

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=25;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_bikes_model->listBikesApprove($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_bikes']=$result['search_result'];
		}

		//echo"<pre>";print_r($data['list_bikes']);echo"</pre>";die;
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_bikes']=$result['totalRows'];			
		
		$this->load->view('admin/list_bikes_approve', $data);	
	}

	public function approveImage($id,$section,$section_id) {
        $this->asset_model->approveAsset($id, "Bike",$section_id);
        redirect('admin/bikes/approveBikes/');
    }

    public function deleteImage($id) {
        $this->asset_model->removeAsset($id, "Bike");
        redirect('admin/bikes/approveBikes/');
    }


	

	








}
