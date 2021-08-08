<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobilenumber extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Admin_mobilenumber_model');
		$this->common_model->checkForValidUser();
		$this->load->model('asset_model');
     }

	

	public function listmobilenumbers()
	{	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=50;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_mobilenumber_model->listmobilenumbers($limit,$page);
		
		
		if ($result['totalRows']){
      $data['list_mobilenumbers']=$result['search_result'];
      
    }
    
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_mobilenumbers']=$result['totalRows'];			
		
		$this->load->view('admin/list_mobilenumbers', $data);	
	}

	public function addmobilenumber()
	{	
		$data['actionType']='add';
		$this->config->load('site_settings');

		$data['dealers'] = $this->Admin_mobilenumber_model->getDealers();

		
		
    $data['city']=$this->config->item('city');    
		$data['operator']=$this->config->item('mobile_operator');
		
		$this->load->view('admin/edit_mobilenumber',$data);
	}

	
	public function insertmobilenumber($flag="")
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
        // $this->form_validation->set_rules('city_id', 'mobilenumber city', 'required|callback_select_validate');
        // $this->form_validation->set_rules('citycode_id', 'mobilenumber city code', 'required|callback_select_validate');
        $this->form_validation->set_rules('number', 'Number', 'required');
  		  
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
                'operator' => $this->input->post('operator'),
                'operator_code' => $this->input->post('operator_code'),
                'number' => $this->input->post('number'),                  
                'price' => $this->input->post('price'),                  
                'des' => $this->input->post('des'),                  
                'featured' => $this->input->post('featured'),								

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
								
                'created_dt' => $date,              
                'edited_dt' => $date,
                'created_by' => $email,
                'edited_by' => $email,
                'state' => 1
				);			
			$insert_id = $this->Admin_mobilenumber_model->insertmobilenumber($data);	

			//$this->asset_model->addAsset($insert_id, 'Car');

			
            $_SESSION['sess_alert'] = '<strong>Mobile number</strong> added successfully!';
            redirect($last_link . '?err=1');
               
        }        
        

		
	}

	public function editmobilenumber($id="")
	{	
		$data['actionType']='update';
		$this->config->load('site_settings');

		$data['mobile'] = $this->Admin_mobilenumber_model->editmobilenumber($id);
	
    $data['dealers'] = $this->Admin_mobilenumber_model->getDealers();	
    
    $data['city']=$this->config->item('city');

    $data['operator']=$this->config->item('mobile_operator'); 
				
		$this->load->view('admin/edit_mobilenumber',$data);
	}

	public function updatemobilenumber()
    {	
    	$mobile_id=$this->input->post('mobile_id');    	
    	$data['mobilenumber'] = $this->Admin_mobilenumber_model->updatemobilenumber($mobile_id);	    

		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Mobilenumber </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deletemobilenumber($id)
	{
    	$delete = $this->Admin_mobilenumber_model->deletemobilenumber($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>mobilenumber </strong> has been deleted successfully!';            	
		redirect('admin/mobilenumber/listmobilenumbers/?err=1');
	}





	

	








}
