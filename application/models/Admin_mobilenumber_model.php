<?php 

class Admin_mobilenumber_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    

    public function insertmobilenumber($data)
    {
        $this->db->insert('mobile_numbers', $data);
        return $this->db->insert_id();
    }
    

    public function listmobilenumbers($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='p.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM mobile_numbers p where '.$where.''); 
        $qr='select p.id,p.`title`,p.title_slug,p.`number`,p.price,p.operator,p.operator_code,p.created_dt,p.created_by
        from mobile_numbers p                        
                where '.$where.'
                group by p.id
                order by id desc
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }

    public function editmobilenumber($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('mobile_numbers', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updatemobilenumber($id)
    {   
        $user= $this->input->post('user');

        $email=$this->session->userdata('email');
        $date = date('Y-m-d H:i:s');

        $title=$this->input->post('title');
        $title_slug = $this->common_model->create_slug($title);         
      
        if ($this->input->post('user')==0) {
          $code = "P";            
        } else{
            $code = "D";            
        }

        $update_data=array(
                'title' => $title,
                'title_slug' => $title_slug,                			
                'operator' => $this->input->post('operator'),
                'operator_code' => $this->input->post('operator_code'),
                'number' => $this->input->post('number'),                  
                'price' => $this->input->post('price'),                  
                'des' => $this->input->post('des'),                  
                'featured' => $this->input->post('featured'),
                

                'user_id' => $this->input->post('user'),
                'code' => $code,
                'ip'   => $_SERVER["REMOTE_ADDR"],
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'location' => $this->input->post('location'),
                'mobile' => $this->input->post('mobile'),
                'expiry' => $expiry,
                'lat' => $this->input->post('lat'),
                'lng' => $this->input->post('lng'),								
                
                

                'edited_dt' => $email,
                'edited_by' => $email,
                'state' => 1
                                
                );
    
        if($id>0){
            $this->db->where('id', $id);
            $this->db->update('mobile_numbers', $update_data);
        }
        return $id;
    }

    public function deletemobilenumber($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('mobile_numbers', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }




    public function getDealers($type="Dealer") {

    $query='SELECT * from de_users where user_type="'.$type.'" and state=1 order by pname';     
    $result = $this->db->query($query);
    return $result->result();
    }


    

}  







