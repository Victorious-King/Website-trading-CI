<?php 

class Admin_deusers_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    
    //Dealer
    public function insertDeuser($data)
    {
        $this->db->insert('de_users', $data);
        return $this->db->insert_id();
    }

   

    public function listDeusers($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $pname=$this->input->get('keywords');

        $user_type=$this->input->get('user_type');

        $where ='state=1';

        $where.=($pname <> '' ? ' and pname like "%' . $pname . '%" or email like "%' . $pname . '%" ' : '');

        $where.=($user_type <> '' ? ' and user_type=' . $this->db->escape($user_type) . '' : '');

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM de_users where '.$where.''); 
        $qr='select id,pname,pname_ar,user_type,logo,country,city,email from de_users where '.$where.' ORDER BY id limit '.$offset.' ,'.$limit.'';      
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }

    public function editDeuser($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('de_users', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updateDeuser($id)
    {   

        $user_type_lists_arr=$this->input->post('user_type_lists');

        
        if(is_array($user_type_lists_arr) && !empty($user_type_lists_arr)){
            $user_type_lists   = implode(',',$user_type_lists_arr);
        }

        $pname=$this->input->post('pname');    

        $pname_slug = $this->common_model->create_slug($pname);

        $password = sha1($this->config->item('salt').$this->input->post('password'));


        $update_data=array(                    
                    'user_type'   => $this->input->post('user_type'),
                    'user_type_lists' => $user_type_lists,                   
                    'pname'   => $this->input->post('pname'),
                    'pname_slug'   => $pname_slug,
                    'pname_ar'   => $this->input->post('pname_ar'),
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
                    'edited_dt'   => $this->common_model->dt,   
                    'edited_by'   => $email
                );
    
        if($id>0){
            $this->db->where('id', $id);
            $this->db->update('de_users', $update_data);
        }
        return $id;
    }



    public function deleteDeuser($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('de_users', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }

    public function checkPname($pname){
        $rs = $this->db->query('SELECT count(id) ct FROM de_users WHERE pname="'.$pname.'" ');
        
        $ttl=$rs->row();
        return $ttl->ct;
    }

    

    



}  



