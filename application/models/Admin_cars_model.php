<?php 

class Admin_cars_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    

    public function insertCar($data)
    {
        $this->db->insert('cars', $data);
        return $this->db->insert_id();
    }
    

    public function listCars($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $car_id=$this->input->get('keywords');

        $where ='c.state=1';

        $where.=($car_id <> '' ? ' and c.id=' . $this->db->escape($car_id) . ' or c.mobile like "%' . $car_id . '%" ' : '');

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM cars c where '.$where.''); 
        $qr='select c.id,c.`title`,c.year,c.price,c.title_slug,c.make_id,c.model_id,ast.image,c.created_dt,c.created_by,mk.make,md.model
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

            $badges_arr=$this->input->post('badges');
        
			if(is_array($badges_arr) && !empty($badges_arr)){
						$badges   = implode(',',$badges_arr);
            }   
            

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
                       
                'ip'   => $_SERVER["REMOTE_ADDR"],
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'location' => $this->input->post('location'),
                'mobile' => $this->input->post('mobile'),                
                'lat' => $this->input->post('lat'),
                'lng' => $this->input->post('lng'),
                'video' => $this->input->post('video'),
                'featured' => $featured,
                'badges' => $badges,

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

    public function getDealers($type="Dealer") {

    $query='SELECT * from de_users where user_type="'.$type.'" and state=1 order by pname';     
    $result = $this->db->query($query);
    return $result->result();
    }

    public function delchecked($type, $ids) {
        if (!empty($ids)) {
            $ids2 = implode(",", $ids);
            //$query = 'UPDATE ' . $type . ' SET state=0 WHERE id in (' . $ids2 . ')';

            //echo 'select * from assets WHERE section_id in (' . $ids2 . ') and section="car"';
            			
           //$this->db->query($query);

           $q2 = 'UPDATE assets SET state=0 WHERE section_id in (' . $ids2 . ')';
           $this->db->query($q2);
           

           $qr = 'select * from assets WHERE section_id in (' . $ids2 . ') and section="car"';
           $rs = $this->db->query($qr);
           $result=$rs->result_array();       


           foreach ($result as $value) {    
               // echo $value['image'];
                $file = $_SERVER['DOCUMENT_ROOT'].'/'. $value['image'];
                $file2 = $_SERVER['DOCUMENT_ROOT'].'/'. $this->asset_model->getImage($value['image'],'300x225');
                $file3 = $_SERVER['DOCUMENT_ROOT'].'/'. $this->asset_model->getImage($value['image'],'800x600');

                //echo $file3;

                // chmod($file, 0644);

                unlink($file);
                unlink($file2);
                unlink($file3);


                // if (@file($file)) {
                //     unlink($file);
                // }                

                //unlink('http://localhost:3000/de/posted_images/car/post_38340_42915.jpeg');

                // if (@file($file)) {
                //     unlink($file);
                // }

               
                
           }

           

           
           
        }
    }


    public function listCars_del($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $car_id=$this->input->get('keywords');

        $where ='c.state=0';

        $where.=($car_id <> '' ? ' and c.id=' . $this->db->escape($car_id) . ' or c.mobile like "%' . $car_id . '%" ' : '');

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM cars c where '.$where.''); 
        $qr='select c.id,c.`title`,c.year,c.price,c.title_slug,c.make_id,c.model_id,ast.image,ast.state img_state,c.created_dt,c.created_by,mk.make,md.model
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



    

}  







