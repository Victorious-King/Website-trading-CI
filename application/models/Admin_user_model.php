<?php 

class Admin_user_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    public function validate()
    {
        // grab user input
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        // Prep the query
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        
        // Run the query
        $query = $this->db->get('admin_users');

        //echo $this->db->last_query();echo "ssss";die;
        // Let's check if there are any results
        if($query->num_rows() == 1)
        {            
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'userid' => $row->id,
                    'fname' => $row->fname,
                    'lname' => $row->lname,
                    'email' => $row->email,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }

    
}  



