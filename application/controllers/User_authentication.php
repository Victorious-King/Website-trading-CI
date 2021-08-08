<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Authentication extends CI_Controller {
	
    function __construct(){
		parent::__construct();
		
		// Load google oauth library
        $this->load->library('google');
		
		// Load user model
		$this->load->model('user');
    }
    
    public function index(){
		// Redirect to profile page if the user already logged in
		if($this->session->userdata('user_id') > 0){
			redirect('myaccount/dashboard');
		}
		
		if(isset($_GET['code'])){
			
			// Authenticate user with google
			if($this->google->getAuthenticate()){
			
				// Get user info from google
				$gpInfo = $this->google->getUserInfo();
				
				// Preparing data for database insertion
				$u_data['oauth_provider'] = 'google';
				$u_data['oauth_uid'] 		= $gpInfo['id'];
				$u_data['pname'] 	= $gpInfo['name'];
				//$userData['last_name'] 		= $gpInfo['family_name'];
				$u_data['email'] 			= $gpInfo['email'];
				$u_data['gender'] 		= !empty($gpInfo['gender'])?$gpInfo['gender']:'';
				//$userData['locale'] 		= !empty($gpInfo['locale'])?$gpInfo['locale']:'';
				//$userData['picture'] 		= !empty($gpInfo['picture'])?$gpInfo['picture']:'';
				
				// Insert or update user data to the database
				$user_id = $this->user->checkUser($u_data);

        $u_data['user_id'] 		= $user_id;

				$gdata=array(
					'oauth_provider' => 'google',
					'oauth_uid' =>$gpInfo['id'],
					'pname' =>$gpInfo['name'],
					'email' =>$email,
					'user_id' => $user_id
				);

				$this->session->set_userdata($gdata);
        

				
				// Redirect to profile page
				redirect('myaccount/dashboard');
			}
		} 
		
		// Google authentication url
		$data['loginURL'] = $this->google->loginURL();
		
		// Load google login view
		$this->load->view('user_authentication',$data);
    }
	

	

}