<?php 

class Admin_boats_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    

    public function insertBoat($data)
    {
        $this->db->insert('boats', $data);
        return $this->db->insert_id();
    }
    

    public function listBoats($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='b.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM boats b where '.$where.''); 
        $qr='select b.id,b.`title`,b.`title_slug`,b.year,b.boat_typeid,b.make_id,b.price,b.length,b.capacity,ast.image,b.created_dt,b.created_by,mk.make,bt.type
                from boats b 
                left join boat_makes mk on (b.make_id=mk.id)
                left join boat_types bt on (b.boat_typeid=bt.id)
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

    public function editBoat($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('boats', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updateBoat($id)
    {
        $email=$this->session->userdata('email');
        $date = date('Y-m-d H:i:s');

        $title=$this->input->post('title');
        $title_slug = $this->common_model->create_slug($title); 


        $update_data=array(
                'title' => $title,
                'title_slug' => $title_slug,
                'year' => $this->input->post('year'),
                'boat_typeid' => $this->input->post('boat_typeid'),				
                'make_id' => $this->input->post('make_id'),								
                'price' => $this->input->post('price'),
                'length' => $this->input->post('length'),
                'capacity' => $this->input->post('capacity'),
                'power' => $this->input->post('power'),
                'des' => $this->input->post('des'), 
                'condition' => $this->input->post('condition'),            
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
            $this->db->update('boats', $update_data);
        }
        return $id;
    }

    public function deleteBoat($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('boats', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }



    public function listBoatsApprove($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='b.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM boats b where '.$where.''); 
        $qr='select b.id,b.`title`,b.`title_slug`,b.year,b.boat_typeid,b.make_id,b.price,b.length,b.capacity,ast.image,b.created_dt,b.created_by,mk.make,bt.type,b.mobile
        from boats b 
        left join boat_makes mk on (b.make_id=mk.id)
        left join boat_types bt on (b.boat_typeid=bt.id)
        right join assets ast on (b.id=ast.section_id AND ast.state=2)                
        where '.$where.'
                group by b.id
                order by id desc
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs=$this->db->query($qr);

        foreach ($rs->result_array() as $value) {
        
        $img= $this->db->query('SELECT id,image FROM assets where section_id='.$value['id'].' AND section="Boat" AND state=2 ORDER BY id ASC ');

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







