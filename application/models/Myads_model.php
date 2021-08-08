<?php 

class Myads_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    

     public function insertCar($data)
    {
        $this->db->insert('cars', $data);
        return $this->db->insert_id();
    }

    

    public function listCars($limit,$offset,$user_id) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='c.state=1 and c.user_id='.$user_id.'';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM cars c where '.$where.''); 
        $qr='select c.id,c.`title`,c.year,c.price,c.title_slug,c.make_id,c.model_id,ast.image,c.created_dt,c.created_by,mk.make,md.model,mk.make_ar,md.model_ar
                from cars c 
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
            $query = $this->db->get_where('cars', array('id' => $id));
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
            'price' => $this->input->post('price'),
            'mileage' => $this->input->post('mileage'),
            'mil' => $this->input->post('mil'),

            'body_type' => $this->input->post('body_type'),                
            'fuel_type' => $this->input->post('fuel_type'),
            'ex_color' => $this->input->post('ex_color'),
            'specs' => $this->input->post('specs'),
            'in_color' => $this->input->post('in_color'),
            'trans' => $this->input->post('trans'),    
            

            'body_type_id' => $this->input->post('body_type_id'),                
            'fuel_type_id' => $this->input->post('fuel_type_id'),
            'ex_color_id' => $this->input->post('ex_color_id'),
            'in_color_id' => $this->input->post('in_color_id'),
            'specs_id' => $this->input->post('specs_id'),
            'trans_id' => $this->input->post('trans_id'),

            'des' => $this->input->post('des'), 
            'condition' => $this->input->post('condition'),  
                          
            'ip' => $this->input->post('ip'),
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
            $this->db->update('cars', $update_data);
        }
        return $id;
    }

    public function deleteCar($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('cars', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }

    public function delete_fad($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('cars', array('featured' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }



    public function listCarsApprove($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='c.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('select c.id
                from cars c 
                left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id)
                right join de_users us on (us.id=c.user_id)
                right join assets ast on (c.id=ast.section_id and ast.state=2)                
                where '.$where.'
                group by c.id'); 
        $qr='select c.id,c.`title`,c.year,c.price,c.mobile,c.title_slug,c.make_id,c.model_id,ast.image,c.created_dt,c.created_by,mk.make,md.model,ast.state,
                us.pname,us.email,us.mobile
                from cars c 
                left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id)
                right join de_users us on (us.id=c.user_id)
                right join assets ast on (c.id=ast.section_id and ast.state=2)                
                where '.$where.'
                group by c.id
                order by id desc
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs=$this->db->query($qr);

        foreach ($rs->result_array() as $value) {
        
        $img= $this->db->query('SELECT id,image FROM assets where section_id='.$value['id'].' AND section="Car" AND state=2 ORDER BY id ASC ');

        $value['images'] = $img->result_array();
        $dt['search_result'][]=$value;
        }
   
        return $dt;


        
    }

    public function listPlates($limit,$offset,$user_id) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='p.state=1 and p.user_id='.$user_id.'';

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



    public function insertPlate($data)
    {
        $this->db->insert('plates', $data);
        return $this->db->insert_id();
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
        $email=$this->session->userdata('email');
        $date = date('Y-m-d H:i:s');

        $title=$this->input->post('title');
        $title_slug = $this->common_model->create_slug($title); 

        $update_data=array(
            'title' => $title,
            'title_slug' => $title_slug,                			
            'city_id' => $this->input->post('city_id'),
            'citycode_id' => $this->input->post('citycode_id'),
            'number' => $this->input->post('number'),
            'hide_code' => $this->input->post('hide_code'),
            'price' => $this->input->post('price'),                
            'des' => $this->input->post('des'),  
            'featured' => $this->input->post('featured'),
            'plate_type' => $this->input->post('plate_type'),          
            
            
            'city' => $this->input->post('city'),            
            'mobile' => $this->input->post('mobile'),
            'ip'   => $_SERVER["REMOTE_ADDR"],            
            'lat' => $this->input->post('lat'),
            'lng' => $this->input->post('lng'),								
            
            'edited_dt' => $date,
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


// Boats
    public function insertBoat($data)
    {
        $this->db->insert('boats', $data);
        return $this->db->insert_id();
    }

    public function listBoats($limit,$offset,$user_id) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='b.state=1 and b.user_id='.$user_id.'';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM boats b where '.$where.''); 
        $qr='select b.id,b.`title`,b.`title_slug`,b.year,b.boat_typeid,b.make_id,b.price,b.length,b.capacity,ast.image,b.created_dt,b.created_by,mk.make,bt.type,b.mobile
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
                    'ip' => $this->input->post('ip'),
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'location' => $this->input->post('location'),
                    'mobile' => $this->input->post('mobile'),                
                    'lat' => $this->input->post('lat'),
                    'lng' => $this->input->post('lng'),                    

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


    // Bikes
    public function insertBike($data)
    {
        $this->db->insert('bikes', $data);
        return $this->db->insert_id();
    }

    public function listBikes($limit,$offset,$user_id) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='b.state=1 and b.user_id='.$user_id.'';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM bikes b where '.$where.''); 
        $qr='select b.id,b.`title`,b.`title_slug`,b.year,b.make_id,b.price,b.condition,ast.image,b.created_dt,b.created_by,mk.make,b.mobile
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
                    'ip' => $this->input->post('ip'),
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'location' => $this->input->post('location'),
                    'mobile' => $this->input->post('mobile'),                
                    'lat' => $this->input->post('lat'),
                    'lng' => $this->input->post('lng'),                    

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


    public function get_cars_email($id) 
    {          

        $where ='c.state=1 and c.id='.$id.'';

        $qr='select c.id,c.`title`,c.year,c.price,c.title_slug,c.make_id,c.model_id,ast.image,c.created_dt,c.created_by,mk.make,md.model,mk.make_ar,md.model_ar
                from cars c 
                left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id)
                left join assets ast on (c.id=ast.section_id)                
                where '.$where.'
                group by c.id                
                ';         
        $query = $this->db->query($qr);
        $result = $query->row_array();
        return $result;
    }



    //Mobile numbers 

    public function listMobilenumbers($limit,$offset,$user_id) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='p.state=1 and p.user_id='.$user_id.'';

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


    public function insertMobilenumber($data)
    {
        $this->db->insert('mobile_numbers', $data);
        return $this->db->insert_id();
    }


    public function editMobilenumber($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('mobile_numbers', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updateMobilenumber($id)
    {
        $email=$this->session->userdata('email');
        $date = date('Y-m-d H:i:s');

        $title=$this->input->post('title');
        $title_slug = $this->common_model->create_slug($title); 

        $update_data=array(
            'title' => $title,
            'title_slug' => $title_slug,                			
            'operator' => $this->input->post('operator'),
            'operator_code' => $this->input->post('operator_code'),
            'number' => $this->input->post('number'),                  
            'price' => $this->input->post('price'),                  
            'des' => $this->input->post('des'),                  
            'featured' => $this->input->post('featured'),  
            
            'city' => $this->input->post('city'),            
            'mobile' => $this->input->post('mobile'),
            'ip'   => $_SERVER["REMOTE_ADDR"],            
            'lat' => $this->input->post('lat'),
            'lng' => $this->input->post('lng'),								
            
            'edited_dt' => $date,
            'edited_by' => $email,
            'state' => 1
                                
                );
    
        if($id>0){
            $this->db->where('id', $id);
            $this->db->update('mobile_numbers', $update_data);
        }
        return $id;
    }

    public function deleteMobilenumber($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('mobile_numbers', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }

    public function getProduct($id) {
        $query = 'SELECT id,name,price FROM product WHERE state=1 and id = '.$id.' ';
        $qr = $this->db->query($query);
        $result = $qr->row_array();
        return $result;
    }

   

}  







