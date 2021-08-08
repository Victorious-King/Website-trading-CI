<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boats extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Admin_boats_model');
		$this->common_model->checkForValidUser();
		$this->load->model('asset_model');
     }

	
	public function index()
	{
		
		// $data['list_boats'] = $this->Admin_boats_model->listProducts();		
		// $this->load->view('admin/list_boats',$data);
	}

	public function listBoats()
	{	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=25;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_boats_model->listBoats($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_boats']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_boats']=$result['totalRows'];			
		
		$this->load->view('admin/list_boats', $data);	
	}

	public function addBoat()
	{	
    $data['actionType']='add';
    $this->config->load('site_settings');
    
		$data['dealers'] = $this->Admin_boats_model->getDealers();

    $data['city']=$this->config->item('city');
    $data['boat_type'] = $this->common_model->getBoatType();
		$data['boat_make'] = $this->common_model->getBoatMakeList();
		$this->load->view('admin/edit_boat',$data);
	}

	
	public function insertBoat($flag="")
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
                'boat_typeid' => $this->input->post('boat_typeid'),				
								'make_id' => $this->input->post('make_id'),								
                'price' => $this->input->post('price'),
                'length' => $this->input->post('length'),
                'capacity' => $this->input->post('capacity'),
                'power' => $this->input->post('power'),
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
								'featured' => $this->input->post('featured'),
								
                'created_dt' => $date,              
                'edited_dt' => $date,
                'created_by' => $email,
                'edited_by' => $email,
                'state' => 1
				);			
			$insert_id = $this->Admin_boats_model->insertBoat($data);	

			$this->asset_model->addAssetBoat($insert_id, 'Boat');

			
            $_SESSION['sess_alert'] = '<strong>Boat</strong> added successfully!';
            redirect($last_link . '?err=1');
               
        }        
        

		
	}

	public function editBoat($id="")
	{	
		$data['actionType']='update';
    $this->config->load('site_settings');
    
    $data['boat_type'] = $this->common_model->getBoatType();
		$data['boat_make'] = $this->common_model->getBoatMakeList();

		$data['boat'] = $this->Admin_boats_model->editBoat($id);
		//print_r($data['car']);die;
		$data['dealers'] = $this->Admin_boats_model->getDealers();

	
		$data['city']=$this->config->item('city');
		

		
		$data['make'] = $this->common_model->getMakeList();
		$data['model']=$this->common_model->getRows('SELECT id,model FROM model WHERE make_id="'.$data['car']['make_id'].'" AND state=1 ORDER BY model ');
		
		$data['assets'] = $this->asset_model->getAssetsBoat('Boat', $id);
				
		$this->load->view('admin/edit_boat',$data);
	}

	public function updateBoat()
    {	
    	$boat_id=$this->input->post('boat_id');    	
    	$data['boat'] = $this->Admin_boats_model->updateBoat($boat_id);	

    	$this->asset_model->addAssetBoat($boat_id, 'Boat');

		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Boat </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deleteBoat($id)
	{
    	$delete = $this->Admin_boats_model->deleteBoat($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Boat </strong> has been deleted successfully!';            	
		redirect('admin/boats/listboats/?err=1');
	}



	public function removeAsset($id, $section_id) {

        $this->asset_model->removeAssetBoat($id);

        redirect('admin/boats/editBoat/' . $section_id . '/suc');
    }


  public function approveBoats()
	{	

		$imd_ids = $this->input->post('checked');
        if ($imd_ids) {
            $this->asset_model->approveCkImages($imd_ids, "Boat");
        }

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=25;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_boats_model->listBoatsApprove($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_boats']=$result['search_result'];
		}

		//echo"<pre>";print_r($data['list_boats']);echo"</pre>";die;
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_boats']=$result['totalRows'];			
		
		$this->load->view('admin/list_boats_approve', $data);	
	}

	public function approveImage($id,$section,$section_id) {
        $this->asset_model->approveAsset($id, "Boat",$section_id);
        redirect('admin/boats/approveBoats/');
    }

    public function deleteImage($id) {
        $this->asset_model->removeAsset($id, "Boat");
        redirect('admin/boats/approveBoats/');
    }


	

	








}
