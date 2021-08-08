<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

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
			$this->load->model('payment_model');   
			$this->load->library('TwoCheckoutApi');  		
	 }

	 function _remap($method, $args) {

		if (method_exists($this, $method)) {
				$this->$method($args);
		} else {
				$this->index($method, $args);
		}
}

	public function index()
	{		   
		$data['product_info'] =  $this->payment_model->getProduct($id=$this->uri->segment(2)); 
		if ($this->uri->segment(3)) {
			$this->session->set_userdata('ad_featured',$this->uri->segment(3)); 
		}
		$this->load->view('checkout', $data);
	}

	// callback
	public function callback() {
		$data = array();
		$statusMsg = "";
		if(!empty($this->input->post('token'))) {
				$product_id = $this->input->post('product_id');
				$product_name = $this->input->post('product_name');
				$addlineArr = array(
						'name' => $this->input->post('2checkout_name'),
						'email' => $this->input->post('2checkout_email'),
						'phoneNumber' => '900-000-0001',
						'addrLine' => '123 Main Street',
						'city' => 'Townsville',
						'state' => 'Ohio',
						'zipCode' => '43206',
						'country' => 'USA',
				);
				if ($this->session->userdata('ad_featured')) {
						$ad_featured = $this->session->userdata('ad_featured');
				}else{
						$ad_featured = "No";
				}
				
				$merchantOrderID = strtolower(str_replace('.','',uniqid('', true))); 
				$product = $this->payment_model->select_single('product',['id'=>$product_id]);
        $amount = $product['price'];  
				//$amount = $this->input->post('amount');            
				$token = $this->input->post('token');            
				try {            
						// Charge params
						$charge = $this->twocheckoutapi->createCharge($merchantOrderID, $token, $amount,$addlineArr);

						// Check whether the charge is successful
						if ($charge['response']['responseCode'] == 'APPROVED') {                
								// Order details
								$orderNumber = $charge['response']['orderNumber'];
								$total = $charge['response']['total'];
								$transactionID = $charge['response']['transactionId'];
								$currency = $charge['response']['currencyCode'];
								$status = $charge['response']['responseCode'];  

								// Insert order info to database  
								$data=array(
									'transaction_id' => $transactionID,
									'product_id' => $product_id,
									'product_name' => $product_name,  

									'name' => $addlineArr['name'],								
									'email' => $addlineArr['email'],   
									'address' => $addlineArr['addrLine'],              
									'ad_featured' => $ad_featured,	
									'product_price' => $amount,
									'total' => $amount,
									'created_date'   => time(),
									'modified_date' => time(),
									'status' => $status,
									
					);			
				$orderID = $this->payment_model->insertOrder($data);

								$statusMsg = '<h2>Thanks for your Order!</h2>';
								$statusMsg .= '<h4>The transaction was successful. Order details are given below:</h4>';
								$statusMsg .= "<p>Order ID: {$merchantOrderID}</p>";
								$statusMsg .= "<p>Order Number: {$orderNumber}</p>";
								$statusMsg .= "<p>Transaction ID: {$transactionID}</p>";
								$statusMsg .= "<p>Order Total: {$total} AED</p>";
						}
						if($statusMsg==""){
							$statusMsg = '<h4>Transaction Failed!<br><br></h4>';
							$statusMsg .= "<p><a href=".base_url('/postad')."> Click here </a>to Pay again</p>";
						}
				} catch (Twocheckout_Error $e) {
						$statusMsg = '<h2>Transaction failed!</h2>';
						$statusMsg .= '<p>'.$e->getMessage().'</p>';
				}
						
		 } else { 
				$statusMsg = "Error on form submission."; 
		}
		//echo $statusMsg;    die;
		$this->session->set_flashdata('paymentInfo', $statusMsg);
		redirect('checkout/success');
} 
// success
public function success() {
	
		$data['msg'] = $this->session->flashdata('paymentInfo');
		
		if ($this->session->userdata('ad_featured')) {
				$this->session->unset_userdata('ad_featured');
				$this->load->view('succ', $data);  
		}else{
				$this->load->view('succ', $data);  
		}  
}

}
