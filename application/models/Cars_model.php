<?php 

class Cars_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    
    public function listCars($limit,$offset) 
    {   
        if ($this->uri->segment(1) == 'ar') {
            $car_make_url= $this->uri->segment(3);
            $car_model_url= $this->uri->segment(4);
        }else if ($this->uri->segment(1) == 'cn'){
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

        $condition = $this->input->get('condition');

        $city = str_replace("-", " ", $this->input->get('city'));

        $ex_color_id = $this->input->get('ex_color_id');
        $specs_id = $this->input->get('specs_id');

        $code = $this->input->get('code');

        $keywords = $this->input->get('keywords');
        

        
        $where ='c.state=1 AND  (c.expiry >="' . $this->common_model->dt . '" OR c.expiry is null)';

        $where.=($car_make <> '' ? ' and c.make_id=' . $this->db->escape($car_make) . '' : '');
        $where.=($car_model <> '' ? ' and c.model_id=' . $this->db->escape($car_model) . '' : '');

        $where.=($condition <> '' ? ' and c.condition=' . $this->db->escape($condition) . '' : '');

        $where.=($ex_color_id <> '' ? ' and c.ex_color_id=' . $this->db->escape($ex_color_id) . '' : '');
        $where.=($specs_id <> '' ? ' and c.specs_id=' . $this->db->escape($specs_id) . '' : '');

        $where.=($city <> '' ? ' and c.city=' . $this->db->escape($city) . '' : '');

        $where.=($code <> '' ? ' and c.code=' . $this->db->escape($code) . '' : '');

        $where.=($keywords <> '' ? ' and c.title like "%' . $keywords . '%" or c.des like "%' . $keywords . '%" or mk.make like "%' . $keywords . '%" or md.model like "%' . $keywords . '%" ' : '');


        
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
                left join model md on (c.model_id=md.id) 
                left join de_users u on (c.user_id=u.id and u.state=1 )  
                where '.$where.''); 
        $qr='select c.id,c.title,c.year,c.price,c.mileage,c.fuel_type,c.ex_color,c.in_color,c.body_type,c.title_slug,c.des,c.make_id,c.model_id,ast.image,ast.state image_state,c.created_dt,c.created_by,mk.make,md.model,mk.make_ar,md.model_ar,mk.make_cn,md.model_cn,
                u.pname profile_name,u.user_type,u.id user_id,c.mobile,c.code,u.logo,
                u.mobile user_mobile,c.city,c.badges,c.featured
                from cars c 
                left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id)
                left join assets ast on (c.id=ast.section_id and ast.state=1)
                left join de_users u on (c.user_id=u.id and u.state=1 )                 
                where '.$where.'
                group by c.id
                order by c.featured desc, '.$orderby.'
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs = $this->db->query($qr);
        $result=$rs->result_array();       

        foreach ($result as $value) {           
            if (!empty($value['user_id'])) {
                $qr1 = 'SELECT id,image,state FROM assets_logo where section_id=' . $value['user_id'] . ' AND section="Logo" AND ( state=1) ORDER BY id ASC limit 1';
                $img= $this->db->query($qr1);
                $value['images'] = $img->result_array();
            }
            $dt['search_result'][]=$value;
        }       

        // $rs->free_result();
        return $dt;
    }


    public function getCarDetails($car_id) {
        $car_id = $this->db->escape($car_id);
       $car_query = 'select c.id, c.title, c.year, c.price, mk.make, mk.make_ar,mk.make_cn, mk.id make_id, mo.model, mo.model_ar,mo.model_cn, mo.id model_id,
                c.des, c.created_dt, c.edited_dt, c.country,c.code,c.visits,c.mileage,c.city, c.mobile,u.id user_id,u.pname profile_name, u.user_type, u.city user_city, u.email user_email, u.mobile user_mobile,u.logo,u.pname_slug, c.lat, c.lng,u.country,c.city,u.address,ast.image,c.expiry,
                bt.body_type_ar,bt.body_type_cn,bt.body_type,
                ft.fuel_type_ar,ft.fuel_type_cn,ft.fuel_type,
                cc_ex.color_ar ex_color_ar,cc_ex.color_cn ex_color_cn,cc_ex.color ex_color,
                cc_in.color_ar in_color_ar,cc_in.color_cn in_color_cn,cc_in.color in_color,
                sp.specs_ar,sp.specs_cn,sp.specs,
                tr.trans_ar,tr.trans_cn,tr.trans
                from cars c
                left join make mk ON(c.make_id=mk.id) 
                left join model mo ON(c.model_id=mo.id) 
                left join de_users u on (c.user_id=u.id and u.state=1 ) 
                left join assets ast on (c.id=ast.section_id)
                left join car_body_type bt ON(bt.id=c.body_type_id) 
                left join car_color cc_ex ON(cc_ex.id=c.ex_color_id) 
                left join car_color cc_in ON(cc_in.id=c.in_color_id)
                left join car_fuel_type ft ON(ft.id=c.fuel_type_id) 
                left join car_specs sp ON(sp.id=c.specs_id) 
                left join car_trans tr ON(tr.id=c.trans_id) 
                
                WHERE c.state = 1 AND c.id = ' . $car_id . ' AND  (c.expiry >="' . $this->common_model->dt . '" OR c.expiry is null)
                GROUP BY c.id ';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        if (!empty($result)) {
            $img = $this->db->query('SELECT id,image,state FROM assets where section_id=' . $result['id'] . ' AND section="Car" AND ( state=1) ORDER BY id ASC');

            $result['images'] = $img->result_array();

            if ($result['user_id']) {
                $img1 = $this->db->query('SELECT id,image,state FROM assets_logo where section_id=' . $result['user_id'] . ' AND section="Logo" AND ( state=1) ORDER BY id ASC');

            $result['img_logo'] = $img1->result_array();
            }

            
        }

        //update visits 
        $this->common_model->updateVisits(array('id' => $result['id']), 'cars');

        
        return $result;
    }


    public function getTagDescMake($makeid) {
        $make_id = $this->db->escape($makeid);
        $car_query = 'select c.id, c.type, mk.make, mk.make_ar,mk.make_cn, mk.id make_id, mo.model, mo.model_ar, mo.id model_id,
                c.desc,c.desc_ar,h1_tag,h1_tag_ar
                from tags_desc c
                left join make mk ON(c.make_id=mk.id) 
                left join model mo ON(c.model_id=mo.id)
                WHERE c.state = 1 and c.make_id = ' . $make_id . ' 
                GROUP BY c.id ';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        return $result;
    }

    public function getTagDescModel($modelid) {
        $modelid = $this->db->escape($modelid);
        $car_query = 'select c.id, c.type, mk.make, mk.make_ar, mk.make_cn, mk.id make_id, mo.model, mo.model_ar, mo.id model_id,
                c.desc,c.desc_ar,h1_tag,h1_tag_ar
                from tags_desc c
                left join make mk ON(c.make_id=mk.id) 
                left join model mo ON(c.model_id=mo.id)
                WHERE c.state = 1 and c.model_id = ' . $modelid . ' 
                GROUP BY c.id ';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        return $result;
    }

    public function get_contents_default() {
        $make_id = $this->db->escape($makeid);
        $car_query = 'select c.id, c.type, mk.make, mk.make_ar,mk.make_cn, mk.id make_id, mo.model, mo.model_ar, mo.id model_id,
                c.desc,c.desc_ar,h1_tag,h1_tag_ar,h1_tag_cn
                from tags_desc c
                left join make mk ON(c.make_id=mk.id) 
                left join model mo ON(c.model_id=mo.id)
                WHERE c.state = 1 and c.make_id = 0 
                GROUP BY c.id ';

        $query = $this->db->query($car_query);
        $result = $query->row_array();
        return $result;
    }


    

}  







