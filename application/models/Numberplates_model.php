<?php 

class Numberplates_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    
    public function listNumberplates($limit,$offset) 
    {   
              
        
        //echo $car_make_url;die;

        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='p.state=1 AND  (p.expiry >="' . $this->common_model->dt . '" OR p.expiry is null)';


        $city_id = $this->input->get('city_id');
        $citycode_id = $this->input->get('citycode_id');
        $number = $this->input->get('number');+

        $digit = $this->input->get('digit');

        if($digit == 'All'){

        }else{
            $where .= ($digit ? ' AND CHAR_LENGTH(p.number) ="' . $digit . '" ' : '');
        }

        



        //echo $digits;
        

        
        $where.=($city_id <> '' ? ' and p.city_id=' . $this->db->escape($city_id) . '' : '');
        $where.=($citycode_id <> '' ? ' and p.citycode_id=' . $this->db->escape($citycode_id) . '' : '');
        $where.=($number <> '' ? ' and p.number like "%'.$this->input->get('number').'%"' : '');


        $where.=(($this->input->get('st') == 'hl' || $this->input->get('st') == 'lh') ? ' AND p.price>0' : '');

        $pricehl='';
        $pricelh='';
        $on='';
        $no='';

        if ($this->input->get('st') == 'hl') {
            $pricehl='p.price desc';
        }

        if ($this->input->get('st') == 'lh') {
            $pricelh='p.price';
        }

        if ($this->input->get('st') == 'no') {
            $no='p.id desc';
        }

        if ($this->input->get('st') == 'on') {
            $on='p.id';
        }

        $orderby = ($this->input->get('st') <> ''? ' ' .$pricehl.' ' .$pricelh.' ' .$no.' ' .$on.' ' : 'p.id desc');

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM plates p where '.$where.''); 
        
        $qr='select p.id,p.`title`,p.title_slug,p.`number`,p.hide_code,p.price,p.city_id,p.citycode_id,p.plate_type,p.created_dt,p.created_by,pc.city numberplate_city,pcc.code city_code,p.city user_city
                from plates p 
                left join plate_city pc on (p.city_id=pc.id)
                left join plate_citycode pcc on (p.citycode_id=pcc.id)                        
                where '.$where.'
                group by p.id
                order by '.$orderby.'
                limit '.$offset.' ,'.$limit.'
                ';           
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }


    public function getPlateDetails($plate_id) {
        $plate_id = $this->db->escape($plate_id);
        $car_query = 'select  p.id,p.`title`,p.title_slug,p.`number`,p.hide_code,p.des,p.price,p.city_id,p.citycode_id,p.plate_type,p.created_dt,p.created_by,pc.city numberplate_city,pcc.code city_code,p.city user_city_post,u.id user_id,u.pname profile_name, u.user_type, u.city user_city, u.email user_email, u.mobile user_mobile,u.logo,u.pname_slug, p.lat, p.lng,u.address,p.code,p.mobile
                from plates p
                left join plate_city pc on (p.city_id=pc.id)
                left join plate_citycode pcc on (p.citycode_id=pcc.id)
                left join de_users u on (p.user_id=u.id and u.state=1 ) 
                WHERE p.state = 1 AND p.id = ' . $plate_id . ' AND  (p.expiry >="' . $this->common_model->dt . '" OR p.expiry is null)
                GROUP BY p.id ';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        if (!empty($result)) {
            $img = $this->db->query('SELECT id,image,state FROM assets where section_id=' . $result['id'] . ' AND section="Car" AND ( state=1) ORDER BY id ASC');

            $result['images'] = $img->result_array();
        }

        //update visits 
        $this->common_model->updateVisits(array('id' => $result['id']), 'plates');

        
        return $result;
    }


    public function get_ct($city_id) 
    {
        $rs=$this->db->query('SELECT count(id) ct from plates where city_id=' . $city_id . ' and state=1 ');
        $ttl = $rs->row();
        return $ttl->ct;

    }

    public function get_contents_default() {
        $make_id = $this->db->escape($makeid);
        $car_query = 'select c.id, c.type, mk.make, mk.make_ar, mk.id make_id, mo.model, mo.model_ar, mo.id model_id,
                c.desc,c.desc_ar,h1_tag,h1_tag_ar,h1_tag_cn
                from tags_desc c
                left join make mk ON(c.make_id=mk.id) 
                left join model mo ON(c.model_id=mo.id)
                WHERE c.state = 1 and c.make_id = 0 and c.type="plate"
                GROUP BY c.id ';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        return $result;
    }
    
    

}  







