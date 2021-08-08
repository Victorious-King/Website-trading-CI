<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plate extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Admin_plate_model');
		$this->common_model->checkForValidUser();
		$this->load->model('asset_model');
     }

	
	public function index()
	{
		
		// $data['list_cars'] = $this->Admin_plate_model->listProducts();		
		// $this->load->view('admin/list_cars',$data);
	}

	public function listplates()
	{	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=50;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_plate_model->listPlates($limit,$page);
		
		
		if ($result['totalRows']){
      $data['list_plates']=$result['search_result'];
      
    }
    
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_plates']=$result['totalRows'];			
		
		$this->load->view('admin/list_plates', $data);	
	}

	public function addplate()
	{	
		$data['actionType']='add';
		$this->config->load('site_settings');

		$data['dealers'] = $this->Admin_plate_model->getDealers();

		
		
		$data['city']=$this->config->item('city');
		$data['plate_city'] = $this->common_model->getplatecity();
		$this->load->view('admin/edit_plate',$data);
	}

	
	public function insertPlate($flag="")
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
        // $this->form_validation->set_rules('user', 'User', 'required|callback_select_validate');	
        // $this->form_validation->set_rules('city_id', 'Plate city', 'required|callback_select_validate');
        // $this->form_validation->set_rules('citycode_id', 'Plate city code', 'required|callback_select_validate');
        $this->form_validation->set_rules('number', 'Number', 'required');
  		  
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
								'city_id' => $this->input->post('city_id'),
                'citycode_id' => $this->input->post('citycode_id'),
                'number' => $this->input->post('number'),
                'hide_code' => $this->input->post('hide_code'),
                'price' => $this->input->post('price'),
                
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
								//'badges' => $badges,


                'created_dt' => $date,              
                'edited_dt' => $date,
                'created_by' => $email,
                'edited_by' => $email,
                'state' => 1
				);			
			$insert_id = $this->Admin_plate_model->insertPlate($data);	

			//$this->asset_model->addAsset($insert_id, 'Car');

			
            $_SESSION['sess_alert'] = '<strong>Number plate</strong> added successfully!';
            redirect($last_link . '?err=1');
               
        }        
        

		
	}

	public function editPlate($id="")
	{	
		$data['actionType']='update';
		$this->config->load('site_settings');

		$data['plate'] = $this->Admin_plate_model->editPlate($id);
	
    $data['dealers'] = $this->Admin_plate_model->getDealers();	
    
    $data['city']=$this->config->item('city');
    $data['plate_city'] = $this->common_model->getplatecity();

 	
		$data['citycode']=$this->common_model->getRows('SELECT id,code FROM plate_citycode WHERE city_id="'.$data['plate']['city_id'].'" AND state=1 ORDER BY code ');
		
	
				
		$this->load->view('admin/edit_plate',$data);
	}

	public function updatePlate()
    {	
    	$plate_id=$this->input->post('plate_id');    	
    	$data['plate'] = $this->Admin_plate_model->updatePlate($plate_id);	    

		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Plate </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deletePlate($id)
	{
    	$delete = $this->Admin_plate_model->deletePlate($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Plate </strong> has been deleted successfully!';            	
		redirect('admin/plate/listplates/?err=1');
	}





	

	








}
