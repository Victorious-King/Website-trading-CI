<?php

class Main_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
        $this->dt = date('Y-m-d H:i:s');
        $this->c_date = date('Y-m-d'); 
              
    }

    public function validate() {

        //$this->load->library('session');
        // grab user input
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = sha1($this->config->item('salt').$this->input->post('password'));;

        // Prep the query
        $qr = 'SELECT id,pname,email,user_type FROM de_users WHERE email="' . $email . '" AND password="' . $password . '" LIMIT 1'; 
        $rs = $this->db->query($qr);
        
        // Let's check if there are any results
        if ($rs->num_rows() == 1) {
            // If there is a user, then create session data
            $row = $rs->row();
            $data = array(
                'user_id' => $row->id,
                'pname' => $row->pname,
                'email' => $row->email ,
                'user_type' => $row->user_type                              
            );
            $this->session->set_userdata($data);

            //print_r($data);

            //echo '<pre>'; print_r($this->session->all_userdata());exit;
           
            return true;
        }
        
        return false;
    }

    

    

    public function createAccount($activation, $user_type='Private') {
        
        $password = sha1($this->config->item('salt').$this->input->post('password'));
        //echo $password;die;
        $post_data = array(
            'user_type' => $user_type,                      
            'email' => $this->input->post('email'),
            'password' => $password,
            'ip' => $_SERVER["REMOTE_ADDR"],
            'activation' => $activation,            
            'created_by' => 'site_user',
            'state' => 1,
            'created_dt' => $this->common_model->dt
        );
        $this->db->insert('de_users', $post_data);
        return $this->db->insert_id();
    }

    public function updateResetkey($id,$reset_key) 
    {
        $data = array(
            'reset_password_key'   => $reset_key,            
            'edited_dt'   => $this->common_model->dt
        );            
            
        $this->db->where('id', $id);
        $this->db->update('de_users', $data);  
        //echo $this->db->last_query();die;          
        return $id;
    }

    

    public function updateNewPassword() {
        
        $reset_key = $this->input->post('reset_key');
        $password = sha1($this->config->item('salt').$this->input->post('password'));
        $reset_password_key = sha1(uniqid());
        //echo $reset_password_key;die;
        //echo $password;die;
        $post_data = array(            
            'password' => $password, 
            'reset_password_key' => $reset_password_key,                     
            'edited_dt' => $this->common_model->dt
        );
        $this->db->where('reset_password_key', $reset_key);
        $this->db->update('de_users', $post_data);
        //echo $this->db->last_query();die;   
        return $this->db->insert_id();
    }


    public function updateSettings($id) 
    {       
            $password = sha1($this->config->item('salt').$this->input->post('password'));

            $data = array(
            'password'   => $password,            
            'edited_dt'   => $this->common_model->dt
            );            
            
            $this->db->where('id', $id);
            $this->db->update('de_users', $data);            
            return $id;
    }

    public function updatePersonalDetails($id) 
    {       
        $pname_slug = $this->common_model->create_slug($pname);

            
            $data=array(                                        
                        'pname'   => $this->input->post('pname'),
                        'pname_slug'   => $pname_slug,                        
                        'address'   => $this->input->post('address'),
                        'city'   => $this->input->post('city'),
                        'country'   => $this->input->post('country'),
                        'postal'   => $this->input->post('postal'),
                        'tel'   => $this->input->post('tel'),
                        'mobile'   => $this->input->post('mobile'),
                        'fax'   => $this->input->post('fax'), 
                        'lat'   => $this->input->post('lat'),
                        'lng'   => $this->input->post('lng'),
                        'edited_dt'   => $this->common_model->dt,   
                        'edited_by'   => $email
            );            
            
            $this->db->where('id', $id);
            $this->db->update('de_users', $data); 
            
            //echo $this->db->last_query(); die;
            return $id;
    }

    public function getPersonalDetails($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('de_users', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function activeEmail($activation) 
    {       
            
            $data = array(
            'activation'   => 1
            );            
            
            $this->db->where('activation', $activation);
            $this->db->update('de_users', $data);    
            
            //echo $this->db->last_query(); die;
            return $id;
    }


    

    
}
?>