<?php 

class Admin_plate_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    

    public function insertPlate($data)
    {
        $this->db->insert('plates', $data);
        return $this->db->insert_id();
    }
    

    public function listPlates($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='p.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM plates p where '.$where.''); 
        $qr='select p.id,p.`title`,p.title_slug,p.`number`,p.hide_code,p.price,p.city_id,p.citycode_id,p.created_dt,p.created_by,pc.city,pcc.code
                from plates p 
                left join plate_city pc on (p.city_id=pc.id)
                left join plate_citycode pcc on (p.citycode_id=pcc.id)                        
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

    public function editPlate($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('plates', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updatePlate($id)
    {   
        $user= $this->input->post('user');

        $email=$this->session->userdata('email');
        $date = date('Y-m-d H:i:s');

        $title=$this->input->post('title');
        $title_slug = $this->common_model->create_slug($title); 

            $badges_arr=$this->input->post('badges');
        
			if(is_array($badges_arr) && !empty($badges_arr)){
						$badges   = implode(',',$badges_arr);
      }   
      
        if ($this->input->post('user')==0) {
          $code = "P";            
        } else{
            $code = "D";            
        }

        $update_data=array(
                'title' => $title,
                'title_slug' => $title_slug,                			
                'city_id' => $this->input->post('city_id'),
                'citycode_id' => $this->input->post('citycode_id'),
                'number' => $this->input->post('number'),
                'hide_code' => $this->input->post('hide_code'),
                'price' => $this->input->post('price'),
                
                'des' => $this->input->post('des'),
                

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
                'featured' => $this->input->post('featured'),
                //'badges' => $badges,

                'edited_dt' => $email,
                'edited_by' => $email,
                'state' => 1
                                
                );
    
        if($id>0){
            $this->db->where('id', $id);
            $this->db->update('plates', $update_data);
        }
        return $id;
    }

    public function deletePlate($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('plates', array('state' => 0));
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







