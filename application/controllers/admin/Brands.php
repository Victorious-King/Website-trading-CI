<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Admin_brands_model');
		$this->common_model->checkForValidUser();
		//$this->load->model('asset_model');
     }

    //Make
	public function listMakes()
	{	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=15;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_brands_model->listMakes($limit,$page);
		
		
		if ($result['totalRows']){
			$data['makes']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_products']=$result['totalRows'];			
		//echo"<pre>";print_r($data['brands']);echo"</pre>";die;
		$this->load->view('admin/list_makes', $data);	
	}

	public function addMake()
	{	
		$data['actionType']='add';
		$this->load->view('admin/edit_make',$data);
	}

	
	public function insertMake($flag="")
	{
		$data['actionType']='add';

		$make=$this->input->post('make');

		$this->form_validation->set_rules('make', 'Make', 'required');
        $this->form_validation->set_rules('make_ar', 'Make arabic', 'required');
        
        $make_exist=$this->common_model->rowsCount('make','make="'.$make.'" and state=1');

        

        if (($this->form_validation->run() == FALSE)) {            
            $last_link = $this->input->post('last_link') . '?err=1';
            $_SESSION['sess_alert'] = validation_errors();
            redirect($last_link);
        } else { 
        	if ($make_exist == 0) {
	        	$last_link = $this->input->post('last_link');           
	                $data=array(
	                'make' => $this->input->post('make'),				
					'make_ar' => $this->input->post('make_ar'),				
	                'state' => 1
					);			
				$insert_id = $this->Admin_brands_model->insertMake($data);

				$this->asset_model->addAssetLogo($insert_id, 'Brand');

				// if($_FILES['userfile']['name']){
				//  $imgname=$insert_id.'.jpg';
				// 	$this->do_upload($insert_id);
				// 	$img_data=$this->upload->data();
				// 	$this->db->update('make', array('logo'=>$imgname), array('id' => $insert_id));
				// }				
				
	            $_SESSION['sess_alert'] = '<strong>Make</strong> added successfully!';
	            redirect($last_link . '?err=1');
	        }else{
	        	$last_link = $this->input->post('last_link');     
        		$_SESSION['sess_alert'] = '<strong>Make</strong> already exists.';
	            redirect($last_link . '?err=1');
        	}
               
        }        
        

		
	}

	public function editMake($id="")
	{	
		$data['actionType']='update';
		$data['make'] = $this->Admin_brands_model->editMake($id);

		$data['assets_brand'] = $this->asset_model->getAssetsBrand('Brand', $id);

		//print_r($data['assets_brand']);
				
		$this->load->view('admin/edit_make',$data);
	}

	public function updateMake()
    {	
    	$make_id=$this->input->post('make_id');    	
    	$data['product'] = $this->Admin_brands_model->updateMake($make_id);	  

    	// if($_FILES['userfile']['name']){
      //       $imgname=$make_id.'.jpg';
      //       $this->do_upload($make_id);
      //       $img_data=$this->upload->data();
      //       $this->db->update('make', array('logo'=>$imgname), array('id' => $make_id));
      //   }   	
		
			$this->asset_model->addAssetLogo($make_id, 'Brand');

		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Make </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deleteMake($id)
	{
    	$delete = $this->Admin_brands_model->deleteMake($id);
    			

		$_SESSION['sess_alert'] = '<strong>Make </strong> has been deleted successfully!';            	
		redirect('admin/brands/listMakes/?err=1');
	}
	
    function do_upload($lastid)
	{
	
		$config['upload_path'] = './uploaded/brands/';
		$config['allowed_types'] = 'jpg';
		$config['file_name'] = $lastid.'.jpg';
		$config['overwrite']	= TRUE;
		//print_r($config);
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			return  "Upload error";
		}
		else
		{
			return "Upload successfull";
		}
	}

	//Models
	public function listModels($id='')
	{	

		

		$data['make'] = $this->common_model->getMakeList();
		//$data['models'] = $this->Admin_brands_model->listModelsSel($sql);

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=15;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_brands_model->listModels($limit,$page);
		
		
		if ($result['totalRows']){
			$data['models']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_products']=$result['totalRows'];			
		//echo"<pre>";print_r($data['brands']);echo"</pre>";die;
		$this->load->view('admin/list_models', $data);	
	}

	public function addModel()
	{	
		$data['actionType']='add';
		$data['make'] = $this->common_model->getMakeList();
		$this->load->view('admin/edit_model',$data);
	}

	public function insertModel($flag="")
	{
		$data['actionType']='add';

		$model=$this->input->post('model');
		$make_id=$this->input->post('make_id');

		$this->form_validation->set_rules('model', 'Model', 'required');
        $this->form_validation->set_rules('model_ar', 'Model arabic', 'required');
        
        $model_exist=$this->common_model->rowsCount('model','state=1 AND model="'.$model.'" AND make_id="'.$make_id.'"');

        

        if (($this->form_validation->run() == FALSE)) {            
            $last_link = $this->input->post('last_link') . '?err=1';
            $_SESSION['sess_alert'] = validation_errors();
            redirect($last_link);
        } else { 
        	if ($model_exist == 0) {
	        	$last_link = $this->input->post('last_link');           
	                $data=array(
	                'make_id' => $this->input->post('make_id'),	
	                'model' => $this->input->post('model'),				
					'model_ar' => $this->input->post('model_ar'),				
	                'state' => 1
					);			
				$insert_id = $this->Admin_brands_model->insertModel($data);							
				
	            $_SESSION['sess_alert'] = '<strong>Model</strong> added successfully!';
	            redirect($last_link . '?err=1');
	        }else{
	        	$last_link = $this->input->post('last_link');     
        		$_SESSION['sess_alert'] = '<strong>Model</strong> already exists.';
	            redirect($last_link . '?err=1');
        	}
               
        }        
        

		
	}


	public function editModel($id="")
	{	
		$data['actionType']='update';
		$data['make'] = $this->common_model->getMakeList();
		$data['model'] = $this->Admin_brands_model->editModel($id);
				
		$this->load->view('admin/edit_model',$data);
	}

	public function updateModel()
    {	
    	$model_id=$this->input->post('model_id');    	
    	$data['product'] = $this->Admin_brands_model->updateModel($model_id);	  

    	

		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Model </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deleteModel($id)
	{
    	$delete = $this->Admin_brands_model->deleteModel($id);
    			

		$_SESSION['sess_alert'] = '<strong>Model </strong> has been deleted successfully!';            	
		redirect('admin/brands/listModels/?err=1');
	}

	public function removeAsset($id, $section_id) {

		$this->asset_model->removeAsset($id);

		redirect('admin/brands/editMake/' . $section_id . '/suc');
}


	



}
