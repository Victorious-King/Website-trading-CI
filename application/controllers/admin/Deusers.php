<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deusers extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Admin_deusers_model');
		$this->common_model->checkForValidUser();
		//$this->load->model('asset_model');
     }


    //Dealer
	public function listDeusers()
	{	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=25;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_deusers_model->listDeusers($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_deusers']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_products']=$result['totalRows'];			
		//echo"<pre>";print_r($data['brands']);echo"</pre>";die;
		$this->load->view('admin/list_deusers', $data);	
	}

	public function addDeuser()
	{	
		$data['actionType']='add';
		$data['countries']=$this->common_model->getRows('SELECT country from countries where state=1 limit 6');
		$this->load->view('admin/edit_deuser',$data);
	}

	
	public function insertDeuser($flag="")
	{
		$data['actionType']='add';

		$email=$this->session->userdata('email');
		$date = date('Y-m-d H:i:s');

		$password = sha1($this->config->item('salt').$this->input->post('password'));

		$this->form_validation->set_rules('pname', 'Name', 'required');
        
        
        $pname=$this->input->post('pname');    

				$pname_slug = $this->common_model->create_slug($pname);
				
				$user_type_lists_arr=$this->input->post('user_type_lists');

        
				if(is_array($user_type_lists_arr) && !empty($user_type_lists_arr)){
						$user_type_lists   = implode(',',$user_type_lists_arr);
				}      

        if (($this->form_validation->run() == FALSE)) {            
            $last_link = $this->input->post('last_link') . '?err=1';
            $_SESSION['sess_alert'] = validation_errors();
            redirect($last_link);
        } else { 
        	if ($dealer_exist == 0) {
	        	$last_link = $this->input->post('last_link');           
	                $data=array(
							'user_type' => $this->input->post('user_type'),
							'user_type_lists' => $user_type_lists,	
			        'pname'   => $this->input->post('pname'),
			        'pname_slug'   => $pname_slug,			        
			        'address'   => $this->input->post('address'),
			        'city'   => $this->input->post('city'),
			        'country'   => $this->input->post('country'),
			        'postal'   => $this->input->post('postal'),
			        'tel'   => $this->input->post('tel'),
			        'mobile'   => $this->input->post('mobile'),
			        'fax'   => $this->input->post('fax'),
			        'des'   => $this->input->post('des'),			        
			        'email'   => $this->input->post('email'),
			        'password'   => $password,
			        'limit_car'   => $this->input->post('limit_car'),
			        'loc' => $this->input->post('loc'),
							'lat'   => $this->input->post('lat'),							        
							'lng'   => $this->input->post('lng'),		
							'website'   => $this->input->post('website'),			        
							'fb_handle'   => $this->input->post('fb_handle'),	
							'fb_link'   => $this->input->post('fb_link'),		
							'insta_handle'   => $this->input->post('insta_handle'),		
							'insta_link'   => $this->input->post('insta_link'),		
							'twt_handle'   => $this->input->post('twt_handle'),		
							'twt_link'   => $this->input->post('twt_link'),	
							
							'limit_featured'   => $this->input->post('limit_featured'),		

			        'state'   => 1,			        
			        'ip'   => $_SERVER["REMOTE_ADDR"],
			        'activation'   => '1',
			        'created_dt'   => $this->common_model->dt,
			        'created_by'   => $email,
			        'edited_dt'   => $this->common_model->dt,	
			        'edited_by'   => $email
					);	
					
					

				$insert_id = $this->Admin_deusers_model->insertDeuser($data);

				$this->asset_model->addAssetLogo($insert_id, 'Logo');

				//$this->asset_model->addAsset($insert_id, 'Cover');

				//$this->asset_model->addAssetMarker($insert_id, 'Marker');

		
				

				$_SESSION['sess_alert'] = '<strong>User</strong> added successfully!';
	            redirect($last_link . '?err=1');
	      }
               
        }        
        

		
	}

	public function editDeuser($id="")
	{	
		$data['actionType']='update';

		$data['user'] = $this->Admin_deusers_model->editDeuser($id);

		$data['countries']=$this->common_model->getRows('SELECT country from countries where state=1 limit 6');
		$data['city_list'] = $this->common_model->getRows('SELECT city FROM country_city WHERE state=1 and country="' . $data['user']['country'] . '" order by city');
		
		$data['assets'] = $this->asset_model->getAssetsCover('Cover', $id);

		$data['assets_logo'] = $this->asset_model->getAssetsLogo('Logo', $id);

		$data['assets_marker'] = $this->asset_model->getAssetsMarker('Marker', $id);
		

		//echo"<pre>";print_r($data['assets']);echo"</pre>";

		$this->load->view('admin/edit_deuser',$data);
	}

	public function updateDeuser()
    {	
    	$user_id=$this->input->post('user_id');    	
			$data['user'] = $this->Admin_deusers_model->updateDeuser($user_id);
			
			$this->asset_model->addAssetLogo($user_id, 'Logo');

			//$this->asset_model->addAsset($user_id, 'Cover');

			//$this->asset_model->addAssetMarker($user_id, 'Marker');
		
		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>User </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deleteDeuser($id)
	{
    	$delete = $this->Admin_deusers_model->deleteDeuser($id);
    			

		$_SESSION['sess_alert'] = '<strong>User </strong> has been deleted successfully!';            	
		redirect('admin/deusers/listDeusers/?err=1');
	}
	
    function do_upload($lastid)
	{
	 
		$config['upload_path'] = './uploaded/user_logo/';
		$config['allowed_types'] = 'jpg|png|gif|jpeg';
		$config['file_name'] = $lastid.'.jpg';
		$config['overwrite']	= TRUE;
		//print_r($config);die;
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

	public function checkPname()
	{	
		$pname = $this->input->post('pname');		

		$pname_exist=$this->Admin_deusers_model->checkPname($pname);

		if($pname_exist==0) {			
			echo '<span style="color:#009933;">Lucky your profile is available!!!</span>';		
		}else{			
			echo '<span style="color:#ff0000;">Sorry (: Profile name already taken. Try another.</span>';
			echo '<input type="hidden" value="1" id="userexist">';
		}

	}

	public function removeAsset($id, $section_id) {

	

		$this->asset_model->removeAssetLogo($id);

		redirect('admin/deusers/editdeuser/' . $section_id . '/suc');
}


	



}
