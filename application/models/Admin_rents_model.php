<?php 

class Admin_rents_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    

    public function insertCar($data)
    {
        $this->db->insert('rents', $data);
        return $this->db->insert_id();
    }
    

    public function listCars($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='c.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM rents c where '.$where.''); 
        $qr='select c.id,c.`title`,c.year,c.price_per_day,c.price_per_week,c.price_per_month,c.title_slug,c.make_id,c.model_id,ast.image,c.created_dt,c.created_by,mk.make,md.model
                from rents c 
                left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id)
                left join assets ast on (c.id=ast.section_id)                
                where '.$where.'
                group by c.id
                order by id desc
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }

    public function editCar($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('rents', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updateCar($id)
    {
        $email=$this->session->userdata('email');
        $date = date('Y-m-d H:i:s');

        $title=$this->input->post('title');
        $title_slug = $this->common_model->create_slug($title); 

 

            if ($this->input->post('featured')){
                $featured = 1;
                
            }else{
                $featured = 0;
                
            }

        $update_data=array(
          'title' => $title,
          'title_slug' => $title_slug,
          'year' => $this->input->post('year'),				
          'make_id' => $this->input->post('make_id'),
          'model_id' => $this->input->post('model_id'),
          'price_per_day' => $this->input->post('price_per_day'),
          'price_per_week' => $this->input->post('price_per_week'),
          'price_per_month' => $this->input->post('price_per_month'),
          'body_type' => $this->input->post('body_type'),  
          'des' => $this->input->post('des'),
          'booked_date' => $this->input->post('booked_date'), 

                'ip'   => $_SERVER["REMOTE_ADDR"],
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'location' => $this->input->post('location'),
                'mobile' => $this->input->post('mobile'),                
                'lat' => $this->input->post('lat'),
                'lng' => $this->input->post('lng'),
                'video' => $this->input->post('video'),
                'featured' => $featured,
               

                'edited_dt' => $email,
                'edited_by' => $email,
                'state' => 1
                                
                );
    
        if($id>0){
            $this->db->where('id', $id);
            $this->db->update('rents', $update_data);
        }
        return $id;
    }

    public function deleteCar($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('rents', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }




    public function getDealers($type="Dealer") {

    $query='SELECT * from de_users where user_type="'.$type.'" and user_type_lists="rents" and state=1 order by pname';     
    $result = $this->db->query($query);
    return $result->result();
    }


    

}  







