<?php 

class Admin_bikes_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    

    public function insertBike($data)
    {
        $this->db->insert('bikes', $data);
        return $this->db->insert_id();
    }
    

    public function listBikes($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='b.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM bikes b where '.$where.''); 
        $qr='select b.id,b.`title`,b.`title_slug`,b.year,b.make_id,b.price,ast.image,b.created_dt,b.created_by,mk.make
                from bikes b 
                left join bike_makes mk on (b.make_id=mk.id)                
                left join assets ast on (b.id=ast.section_id)                
                where '.$where.'
                group by b.id
                order by id desc
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }

    public function editBike($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('bikes', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updateBike($id)
    {
        $email=$this->session->userdata('email');
        $date = date('Y-m-d H:i:s');

        $title=$this->input->post('title');
        $title_slug = $this->common_model->create_slug($title); 


        $update_data=array(
                'title' => $title,
                'title_slug' => $title_slug,
                'year' => $this->input->post('year'),                		
                'make_id' => $this->input->post('make_id'),								
                'price' => $this->input->post('price'),  
                'condition' => $this->input->post('condition'),              
                'des' => $this->input->post('des'),            
                'ip'   => $_SERVER["REMOTE_ADDR"],
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'location' => $this->input->post('location'),
                'mobile' => $this->input->post('mobile'),                
                'lat' => $this->input->post('lat'),
                'lng' => $this->input->post('lng'),                
                'featured' => $this->input->post('featured'),                

                'edited_dt' => $email,
                'edited_by' => $email,
                'state' => 1
                                
                );
    
        if($id>0){
            $this->db->where('id', $id);
            $this->db->update('bikes', $update_data);
        }
        return $id;
    }

    public function deleteBike($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('bikes', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }



    public function listBikesApprove($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='b.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM bikes b where '.$where.''); 
        $qr='select b.id,b.`title`,b.`title_slug`,b.year,b.make_id,b.price,ast.image,b.created_dt,b.created_by,mk.make,b.mobile
        from bikes b 
        left join bike_makes mk on (b.make_id=mk.id)        
        right join assets ast on (b.id=ast.section_id AND ast.state=2)                
        where '.$where.'
                group by b.id
                order by id desc
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs=$this->db->query($qr);

        foreach ($rs->result_array() as $value) {
        
        $img= $this->db->query('SELECT id,image FROM assets where section_id='.$value['id'].' AND section="Bike" AND state=2 ORDER BY id ASC ');

        $value['images'] = $img->result_array();
        $dt['search_result'][]=$value;
        }
   
        return $dt;


        
    }

    public function getDealers($type="Dealer") {

    $query='SELECT * from de_users where user_type="'.$type.'" and state=1 order by pname';     
    $result = $this->db->query($query);
    return $result->result();
    }


    

}  







