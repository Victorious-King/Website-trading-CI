<?php 

class Bikes_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    
    public function listBikes($limit,$offset) 
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

        
        $bike_make = $this->input->get('bike_make');

        $price_min = $this->input->get('price_min');
        $price_max = $this->input->get('price_max');

        $year_min = $this->input->get('year_min');
        $year_max = $this->input->get('year_max');

        $condition = $this->input->get('condition');

        
        $where ='b.state=1';

        $where.=($bike_make <> '' ? ' and b.make_id=' . $this->db->escape($bike_make) . '' : '');

        $where.=($condition <> '' ? ' and b.condition=' . $this->db->escape($condition) . '' : '');


       
        if (!empty($_SERVER['QUERY_STRING'])) {                     
            $where.=($year_min && $year_max ? ' and b.year BETWEEN ' . $this->db->escape($year_min) . ' AND ' . $this->db->escape($year_max) . '' : '');
            $where.=($price_min && $price_max ? ' and b.price BETWEEN ' . $this->db->escape($price_min) . ' AND ' . $this->db->escape($price_max) . '' : '');
        }
        
        $where.=(($this->input->get('st') == 'hl' || $this->input->get('st') == 'lh') ? ' AND b.price>0' : '');

        $pricehl='';
        $pricelh='';
        $on='';
        $no='';

        if ($this->input->get('st') == 'hl') {
            $pricehl='b.price desc';
        }

        if ($this->input->get('st') == 'lh') {
            $pricelh='b.price';
        }

        if ($this->input->get('st') == 'no') {
            $no='b.id desc';
        }

        if ($this->input->get('st') == 'on') {
            $on='b.id';
        }

        $orderby = ($this->input->get('st') <> ''? ' ' .$pricehl.' ' .$pricelh.' ' .$no.' ' .$on.' ' : 'b.id desc');

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT b.id FROM bikes b where '.$where.''); 
         $qr='select b.id,b.`title`,b.`title_slug`,b.year,b.make_id,b.price,ast.image,b.created_dt,b.created_by,mk.make,u.pname profile_name,u.user_type,u.id user_id,b.mobile,b.code,u.logo,u.mobile user_mobile,b.city,b.featured,u.pname_slug
         from bikes b 
         left join bike_makes mk on (b.make_id=mk.id)         
         left join assets_bike ast on (b.id=ast.section_id and ast.section="Bike" and ast.state=1) 
         left join de_users u on (b.user_id=u.id and u.state=1 )                  
                where '.$where.'
                group by b.id
                order by '.$orderby.'
                limit '.$offset.' ,'.$limit.'
                ';         
                $rs = $this->db->query($qr);
                $result=$rs->result_array();       
        
                foreach ($result as $value) {           
                    if (!empty($value['user_id'])) {
                        $qr1 = 'SELECT id,image,state FROM assets where section_id=' . $value['user_id'] . ' AND section="Logo" AND ( state=1) ORDER BY id ASC limit 1';
                        $img= $this->db->query($qr1);
                        $value['images'] = $img->result_array();
                    }
                    $dt['search_result'][]=$value;
                }       
        
                // $rs->free_result();
                return $dt;
    }


    public function getBikeDetails($bike_id) {
        $bike_id = $this->db->escape($bike_id);
        $bike_query = 'select b.id,b.`title`,b.`title_slug`,b.year,b.make_id,b.price,ast.image,b.created_dt,b.created_by,mk.make,u.pname profile_name,u.user_type,u.id user_id,b.mobile,b.code,u.logo,u.mobile user_mobile,b.city,b.featured,b.des,b.condition
        from bikes b 
        left join bike_makes mk on (b.make_id=mk.id)
        left join assets_bike ast on (b.id=ast.section_id and ast.section="Bike") 
        left join de_users u on (b.user_id=u.id and u.state=1 ) 
                WHERE b.state = 1 AND b.id = ' . $bike_id . ' AND  (b.expiry >="' . $this->common_model->dt . '" OR b.expiry is null)
                GROUP BY b.id ';

        $query = $this->db->query($bike_query);
        $result = $query->row_array();
        if (!empty($result)) {
            $img = $this->db->query('SELECT id,image,state FROM assets_bike where section_id=' . $result['id'] . ' AND section="Bike" AND ( state=1) ORDER BY id ASC');

            $result['images'] = $img->result_array();
        }

        //update visits 
        $this->common_model->updateVisits(array('id' => $result['id']), 'bikes');

        
        return $result;
    }

    public function get_contents_default() {
        $make_id = $this->db->escape($makeid);
        $car_query = 'select c.id, c.type, mk.make, mk.make_ar, mk.id make_id, mo.model, mo.model_ar, mo.id model_id,
                c.desc,c.desc_ar,h1_tag,h1_tag_ar,h1_tag_cn
                from tags_desc c
                left join make mk ON(c.make_id=mk.id) 
                left join model mo ON(c.model_id=mo.id)
                WHERE c.state = 1 and c.make_id = 0 and c.type="bike"
                GROUP BY c.id ';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        return $result;
    }


    
    

}  







