<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tagsdesc extends CI_Controller {

	function __construct(){
		  
        parent::__construct();		
		$this->load->model('Admin_tagsdesc_model');
		$this->common_model->checkForValidUser();
		
     }

	
	public function index()
	{
		
		// $data['list_cars'] = $this->Admin_tagsdesc_model->listProducts();		
		// $this->load->view('admin/list_cars',$data);
	}

	public function listTagsdesc()
	{	

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=25;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Admin_tagsdesc_model->listTagsdesc($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_tagsdesc']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype, '');

		$data['total_tagsdesc']=$result['totalRows'];			
		
		$this->load->view('admin/list_tagsdesc', $data);	
	}

	function check_default($post_string)
    {
      return $post_string == '0' ? FALSE : TRUE;

    }

	public function addTagsdesc()
	{	
		$data['actionType']='add';

		$data['make'] = $this->common_model->getMakeList();
		$this->load->view('admin/edittag_desc',$data);
	}

	
	public function insertTagsdesc($flag="")
	{	

		
		$data['actionType']='add';
		$email=$this->session->userdata('email');
		$date = date('Y-m-d H:i:s');

        $this->form_validation->set_rules('make_id','Make','required|callback_check_default');
        

        if (($this->form_validation->run() == FALSE)) {            
            $last_link = $this->input->post('last_link') . '?err=1';
            $_SESSION['sess_alert'] = validation_errors();
            redirect($last_link);
        } else { 
        	$last_link = $this->input->post('last_link');           
                $data=array(                
                'type' => $this->input->post('type'),				
                'make_id' => $this->input->post('make_id'),
                'model_id' => $this->input->post('model_id'),                
                'desc' => $this->input->post('desc'),
								'desc_ar' => $this->input->post('desc_ar'),
								
								'h1_tag' => $this->input->post('h1_tag'),
								'h1_tag_ar' => $this->input->post('h1_tag_ar'),

                'created_dt' => $date,              
                'edited_dt' => $date,
                'created_by' => $email,
                'edited_by' => $email,
                'state' => 1
				);			
			$insert_id = $this->Admin_tagsdesc_model->insertTagsdesc($data);	

						
            $_SESSION['sess_alert'] = '<strong>Description</strong> added successfully!';
            redirect($last_link . '?err=1');
               
        }        
        

		
	}

	public function editTagsdesc($id="")
	{	
		$data['actionType']='update';
		

		$data['tagdesc'] = $this->Admin_tagsdesc_model->editTagsdesc($id);
				
		$data['make'] = $this->common_model->getMakeList();
		$data['model']=$this->common_model->getRows('SELECT id,model FROM model WHERE make_id="'.$data['tagdesc']['make_id'].'" AND state=1 ORDER BY model ');
		
						
		$this->load->view('admin/edittag_desc',$data);
	}

	public function updateTagsdesc()
    {	
    	$tagdesc_id=$this->input->post('tagdesc_id');    	
    	$data['car'] = $this->Admin_tagsdesc_model->updateTagsdesc($tagdesc_id);	    	

		$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Description </strong> has been updated successfully!';
        redirect($last_link . '?err=1');

	}

	public function deleteTagsdesc($id)
	{
    	$delete = $this->Admin_tagsdesc_model->deleteTagsdesc($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Description </strong> has been deleted successfully!';            	
		redirect('admin/tagsdesc/listTagsdesc/?err=1');
	}

	
	

	








}
