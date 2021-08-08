<?php 

class Mobilenumbers_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    
    public function listMobilenumbers($limit,$offset) 
    {   
              
        
        //echo $car_make_url;die;

        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='m.state=1';


        $operator = $this->input->get('operator');
        $operator_code = $this->input->get('operator_code');
        $number = $this->input->get('number');+

        //echo $digits;
        

        
        $where.=($operator <> '' ? ' and m.operator=' . $this->db->escape($operator) . '' : '');
        $where.=($operator_code <> '' ? ' and m.operator_code=' . $this->db->escape($operator_code) . '' : '');
        $where.=($number <> '' ? ' and m.number like "%'.$this->input->get('number').'%"' : '');


        $where.=(($this->input->get('st') == 'hl' || $this->input->get('st') == 'lh') ? ' AND m.price>0' : '');

        $pricehl='';
        $pricelh='';
        $on='';
        $no='';

        if ($this->input->get('st') == 'hl') {
            $pricehl='m.price desc';
        }

        if ($this->input->get('st') == 'lh') {
            $pricelh='m.price';
        }

        if ($this->input->get('st') == 'no') {
            $no='m.id desc';
        }

        if ($this->input->get('st') == 'on') {
            $on='m.id';
        }

        $orderby = ($this->input->get('st') <> ''? ' ' .$pricehl.' ' .$pricelh.' ' .$no.' ' .$on.' ' : 'm.id desc');

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM mobile_numbers m where '.$where.''); 
        $qr='select m.id,m.`title`,m.title_slug,m.`number`,m.price,m.operator,m.operator_code,m.created_dt,m.created_by,m.city user_city
                from mobile_numbers m                                        
                where '.$where.'
                group by m.id
                order by '.$orderby.'
                limit '.$offset.' ,'.$limit.'
                ';           
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }


    public function getMobilenumberDetails($plate_id) {
        $plate_id = $this->db->escape($plate_id);
        $car_query = 'select m.id,m.`title`,m.title_slug,m.`number`,m.des,m.price,m.operator,m.operator_code,m.created_dt,m.created_by,m.city user_city_post,u.id user_id,u.pname profile_name, u.user_type, u.city user_city, u.email user_email, u.mobile user_mobile,u.logo,u.pname_slug, m.lat, m.lng,u.address,m.code,m.mobile
                from mobile_numbers m                
                left join de_users u on (m.user_id=u.id and u.state=1 ) 
                WHERE m.state = 1 AND m.id = ' . $plate_id . ' AND  (m.expiry >="' . $this->common_model->dt . '" OR m.expiry is null)
                GROUP BY m.id ';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        

        //update visits 
        $this->common_model->updateVisits(array('id' => $result['id']), 'mobile_numbers');

        
        return $result;
    }

    public function get_ct($operator) 
    {
        $rs=$this->db->query('SELECT count(id) ct from mobile_numbers where operator="' . $operator . '" and state=1 ');
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
                WHERE c.state = 1 and c.make_id = 0 and c.type="mobile_number"
                GROUP BY c.id ';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        return $result;
    }
    
    


    
    

}  







