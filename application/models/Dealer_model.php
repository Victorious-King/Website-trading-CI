<?php 

class Dealer_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    
    public function listCars($limit,$offset) 
    {   
        if ($this->uri->segment(1) == 'ar') {
            $car_make_url= $this->uri->segment(3);
            $car_model_url= $this->uri->segment(4);
        }else{
            $car_make_url= $this->uri->segment(2);
            $car_model_url= $this->uri->segment(3);
        }

      
        
        
        //echo $car_make_url;die;

        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $car_make = $this->input->get('car_make');
        $car_model = $this->input->get('car_model');

        $price_min = $this->input->get('price_min');
        $price_max = $this->input->get('price_max');

        $year_min = $this->input->get('year_min');
        $year_max = $this->input->get('year_max');

        
        $where ='c.state=1';

        $where.=($car_make <> '' ? ' and c.make_id=' . $this->db->escape($car_make) . '' : '');
        $where.=($car_model <> '' ? ' and c.model_id=' . $this->db->escape($car_model) . '' : '');

        
        $where.=($car_make_url <> '' ? ' AND REPLACE(mk.make,"-"," ")="' . $this->common_model->makeReplace($car_make_url) . '"' : '');
        $where.=($car_model_url <> '' ? ' AND REPLACE(md.model,"-"," ")="' . $this->common_model->makeReplace($car_model_url) . '"' : '');

       
        if (!empty($_SERVER['QUERY_STRING'])) {                     
            $where.=($year_min && $year_max ? ' and c.year BETWEEN ' . $this->db->escape($year_min) . ' AND ' . $this->db->escape($year_max) . '' : '');
            $where.=($price_min && $price_max ? ' and c.price BETWEEN ' . $this->db->escape($price_min) . ' AND ' . $this->db->escape($price_max) . '' : '');
        }
        
        $where.=(($this->input->get('st') == 'hl' || $this->input->get('st') == 'lh') ? ' AND c.price>0' : '');

        $pricehl='';
        $pricelh='';
        $on='';
        $no='';

        if ($this->input->get('st') == 'hl') {
            $pricehl='c.price desc';
        }

        if ($this->input->get('st') == 'lh') {
            $pricelh='c.price';
        }

        if ($this->input->get('st') == 'no') {
            $no='c.id desc';
        }

        if ($this->input->get('st') == 'on') {
            $on='c.id';
        }

        $orderby = ($this->input->get('st') <> ''? ' ' .$pricehl.' ' .$pricelh.' ' .$no.' ' .$on.' ' : 'c.id desc');

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT c.id FROM cars c left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id) where '.$where.''); 
         $qr='select c.id,c.title,c.year,c.price,c.mileage,c.fuel_type,c.ex_color,c.in_color,c.body_type,c.title_slug,c.des,c.make_id,c.model_id,ast.image,ast.state image_state,c.created_dt,c.created_by,mk.make,md.model,mk.make_ar,md.model_ar,
                u.pname profile_name,u.user_type,u.id user_id,c.mobile,c.code,u.logo,
                u.mobile user_mobile,c.city
                from cars c 
                left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id)
                left join assets ast on (c.id=ast.section_id and ast.state=1)
                left join de_users u on (c.user_id=u.id and u.state=1 )                 
                where '.$where.'
                group by c.id
                order by '.$orderby.'
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        //$rs->free_result();
        return  $dt['search_result'];
    }


    public function getDealerDetails($dealer_name) {
        //$car_id = $this->db->escape($car_id);
        $car_query = 'SELECT d.id, d.pname, d.pname_slug, d.pname_ar, d.address, d.city, d.country, d.tel, d.mobile, d.fax,d.loc, d.lat, d.lng, d.postal,REPLACE(d.website,"http://","") website, d.logo, d.des, d.created_dt, d.edited_dt,d.user_type,ast.image marker, d.fb_handle, d.fb_link, d.insta_handle, d.insta_link, d.twt_handle, d.twt_link
        from de_users d
        left join assets ast on (d.id = ast.section_id and ast.section="Marker")
        where d.pname = "' . $dealer_name . '" and d.user_type="Dealer" and d.state=1';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        if (!empty($result)) {
            $img = $this->db->query('SELECT id,image,state FROM assets where section_id=' . $result['id'] . ' AND section="Cover" AND ( state=1) ORDER BY id ASC');

            $result['images'] = $img->result_array();
        }

        if (!empty($result)) {
            $img = $this->db->query('SELECT id,image,state FROM assets_logo where section_id=' . $result['id'] . ' AND section="Logo" AND ( state=1) ORDER BY id ASC');

            $result['logo'] = $img->result_array();
        }

        //update visits 
        //$this->common_model->updateVisits(array('id' => $result['id']), 'cars');

        
        return $result;
    }

    public function getCars($limit,$offset,$dealer_id) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='c.state=1  AND user_id = ' . $dealer_id . '';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM cars c where '.$where.''); 
         $qr='select c.id,c.title,c.year,c.price,c.title_slug,c.des,c.make_id,c.model_id,c.mileage,ast.image,c.created_dt,c.created_by,mk.make,md.model,mk.make_ar,md.model_ar,
                u.pname profile_name, u.user_type,u.id user_id,ast.state image_state, c.city
                from cars c 
                left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id)
                left join assets ast on (c.id=ast.section_id and ast.state=1)
                left join de_users u on (c.user_id=u.id and u.state=1 )                 
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


    public function getPlates($limit,$offset,$dealer_id) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='p.state=1  AND user_id = ' . $dealer_id . '';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM plates p where '.$where.''); 
         $qr='select p.id,p.`title`,p.title_slug,p.`number`,p.hide_code,p.price,p.city_id,p.citycode_id,p.plate_type,p.created_dt,p.created_by,pc.city numberplate_city,pcc.code city_code,p.city user_city
                from plates p 
                left join plate_city pc on (p.city_id=pc.id)
                left join plate_citycode pcc on (p.citycode_id=pcc.id) 
                left join assets ast on (p.id=ast.section_id and ast.state=1)
                left join de_users u on (p.user_id=u.id and u.state=1 )                 
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

    public function getBoats($limit,$offset,$dealer_id) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='b.state=1  AND user_id = ' . $dealer_id . '';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM boats b where '.$where.''); 
         $qr='select b.id,b.`title`,b.`title_slug`,b.year,b.boat_typeid,b.make_id,b.price,b.length,b.capacity,ast.image,b.created_dt,b.created_by,mk.make,bt.type,u.pname profile_name,u.user_type,u.id user_id,b.mobile,b.code,u.logo,u.mobile user_mobile,b.city,b.featured
         from boats b 
         left join boat_makes mk on (b.make_id=mk.id)
         left join boat_types bt on (b.boat_typeid=bt.id)
         left join assets ast on (b.id=ast.section_id and ast.section="Boat" and ast.state=1) 
         left join de_users u on (b.user_id=u.id and u.state=1 )                 
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




    public function getdealerlists($limit,$offset)
    {
       $where ='d.state=1';       
        
       $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT d.id FROM de_users d where '.$where.''); 

        $qr='SELECT d.id, d.pname, d.pname_slug, d.pname_ar, d.address, d.city, d.country, d.tel, d.mobile, d.fax,d.loc, d.lat, d.lng, d.postal,REPLACE(d.website,"http://","") website, d.logo, d.des, d.created_dt, d.edited_dt,d.user_type,ast.image marker, d.fb_handle, d.fb_link, d.insta_handle, d.insta_link, d.twt_handle, d.twt_link,d.user_type_lists
        from de_users d
        left join assets ast on (d.id = ast.section_id and ast.section="Marker")
        left join cars c on (d.id = c.user_id)
        where '.$where.' and d.user_type="Dealer" and d.state=1 and c.id>0 group by id order by id ASC limit '.$offset.' ,'.$limit.'';

        $rs=$this->db->query($qr);

        

        foreach ($rs->result_array() as $value) {

             $qr1 = 'SELECT id,image,state FROM assets_logo where section_id=' . $value['id'] . ' AND section="Logo" AND ( state=1) ORDER BY id ASC limit 1';
            $img= $this->db->query($qr1);
            $value['images'] = $img->result_array();
            // echo '<pre>';
            // print_r($value['images']);

            $qr2 = 'SELECT count(id) ct FROM cars where user_id=' . $value['id'] . ' AND state=1';
            $ct_cars = $this->db->query($qr2);
            $value['count'] = $ct_cars->row_array();

	   	 	$dt['search_result'][]=$value;
	   	}
        
        $rs->free_result();

        return $dt;
           
       
    }
    
    

}  







