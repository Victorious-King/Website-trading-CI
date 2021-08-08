<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
      $this->load->model('Home_model');	 		
	 }

	public function index()
	{		
    $data['make'] = $this->common_model->getMakeList();

		$ptype=$this->uri->segment(2);
		//echo $ptype;die;
		$limit=12;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->Home_model->getCarsHome($limit,$page);
		
		
		if ($result['totalRows']){
			$data['list_cars']=$result['search_result'];
		}

		//$data['list_numberplates']=$this->Home_model->getCarsNumberplates();

		//$data['top_brands']=$this->Home_model->getTopBrands();

		$result_make=$this->Home_model->getTopBrands();

		$data['list_make']=$result_make['all_make'];

		//echo"<pre>";print_r($data['list_make']);echo"</pre>";

		$this->load->view('home', $data);
	}
}
