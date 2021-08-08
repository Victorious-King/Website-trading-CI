<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dealers extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct(){
      parent::__construct(); 
      $this->load->model('Dealer_model');      		
	 }

	public function index()
	{		 
		
		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=20;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Dealer_model->getdealerlists($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_dealers']=$result['search_result'];
		}else {
      $data['no_result'] = 'No Results Found.' ;
    }

		//echo"<pre>";print_r($data['list_dealers']);echo"</pre>";
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,$dealer='');

		$data['total_dealers']=$result['totalRows'];
			

		$this->load->view('dealers', $data);

	}
}
