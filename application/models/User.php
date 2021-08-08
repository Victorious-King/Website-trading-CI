<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
	
	function __construct() {
		$this->tableName = 'de_users';
	}
	
	public function checkUser($data = array()){
		$this->db->select('id');
		$this->db->from($this->tableName);
		
		$con = array(
			'oauth_provider' => $data['oauth_provider'],
			'oauth_uid' => $data['oauth_uid']
		);
		$this->db->where($con);
		$query = $this->db->get();
		
		$check = $query->num_rows();
		if($check > 0){
			// Get prev user data
            $result = $query->row_array();
			
			// Update user data
			$data['created_dt'] = date("Y-m-d H:i:s");
			$update = $this->db->update($this->tableName, $data, array('id' => $result['id']));
			
			// Get user ID
			$userID = $result['id'];
		}else{
    
			//check if email already exist
			$this->db->select('id');
			$this->db->from($this->tableName);
			
			$con = array(
					'email' => $data['email']
			);
			$this->db->where($con);
			$query = $this->db->get();
			
			$check = $query->num_rows();
			
			if($check > 0){
					// Get prev user data
					$result = $query->row_array();
					
					// Update user data
					
					//here update whatever data you want to update for that record
					$data['edited_dt'] = date("Y-m-d H:i:s");
					$update = $this->db->update($this->tableName, $data, array('id' => $result['id']));
					
					// Get user ID
					$userID = $result['id'];
	
			}else{
					//Insert new record            
					
					// Insert user data
					$data['created_dt'] = date("Y-m-d H:i:s");
					$data['edited_dt'] = date("Y-m-d H:i:s");
					$insert = $this->db->insert($this->tableName, $data);
					
					// Get user ID
					$userID = $this->db->insert_id();
			}
	}
		
		// Return user ID
		return $userID?$userID:false;
    }


		

}
