<?php 

class Home_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    
    public function getCarsHome($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='c.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM cars c where '.$where.''); 
         $qr='select c.id,c.title,c.year,c.price,c.title_slug,c.des,c.make_id,c.model_id,c.mileage,ast.image,c.created_dt,c.created_by,mk.make,md.model,mk.make_ar,md.model_ar,
                u.pname profile_name, u.user_type,u.id user_id,ast.state image_state, c.city,c.badges,c.featured
                from cars c 
                left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id)
                left join assets ast on (c.id=ast.section_id and ast.state=1)
                left join de_users u on (c.user_id=u.id and u.state=1 )                 
                where '.$where.'
                group by c.id
                order by c.featured desc,id desc
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }

    public function getCarsNumberplates() 
    {   
       
        $where ='p.state=1';

     
         $qr='select p.id,p.`title`,p.title_slug,p.`number`,p.hide_code,p.price,p.city_id,p.citycode_id,p.plate_type,p.created_dt,p.created_by,pc.city numberplate_city,pcc.code city_code,p.city user_city
                from plates p 
                left join plate_city pc on (p.city_id=pc.id)
                left join plate_citycode pcc on (p.citycode_id=pcc.id)                        
                where '.$where.'
                group by p.id
                order by id desc
                limit 8
                ';         
                $result = $this->db->query($qr);
                return $result->result_array();
    }

    public function getTopBrands() 
    {  
        $qr = 'SELECT id,make,make_ar,make_cn FROM make WHERE state=1 and id in (4,5,6,8,12,21,24,27,29,34,35,39,40,41,49,54,60,62,72,76) order by make';

        $rs=$this->db->query($qr);
           

        foreach ($rs->result_array() as $value) {

            $qr2 = 'SELECT id,image,state FROM assets_brands where section_id=' . $value['id'] . ' AND section="Brand" AND state=1 ORDER BY id ASC limit 1';
            $img= $this->db->query($qr2);
            $value['images'] = $img->result_array();
            // echo '<pre>';
            // print_r($value['images']);

            $qr1 = 'SELECT count(id) ct FROM cars where make_id=' . $value['id'] . ' AND state=1';
            $ct_cars = $this->db->query($qr1);
            $value['count'] = $ct_cars->row_array();

	   	 	$dt['all_make'][]=$value;
	   	}
        
        $rs->free_result();

        return $dt;


    }

    

}  







