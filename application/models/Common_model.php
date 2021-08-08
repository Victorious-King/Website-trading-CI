<?php

class Common_model extends CI_Model {

    var $dt;
    var $c_date;
    var $component_path; 
    var $filters_path;

    function __construct() {
        parent::__construct();
        $this->dt = date('Y-m-d H:i:s');
        $this->c_date = date('Y-m-d'); 
        $this->component_path = $this->config->item('component_path');  
        $this->filters_path = $this->config->item('filters_path');        
    }

    public function checkForValidUser(){
        
        if(!$this->session->userdata('userid'))
            {
                redirect('admin/login');
            }
            
            return ;
    }

    
    
    public function getNumberOfRows($query) {
        $rs = $this->db->query($query);
        return $rs->num_rows();
    }

    public function rowsCount($table, $where) {        
        $rs = $this->db->query('SELECT count(id) ct FROM ' . $table . ' WHERE ' . $where . '');
        $ttl = $rs->row();
        return $ttl->ct;
    }
    
    function getRows($query) {
        $result = $this->db->query($query);
        if ($result) {
            $dt = $result->result_array();
            $result->free_result();
        }
        return $dt;
    }

    function getRow($query) {
        $result = $this->db->query($query);
        $dt = $result->row();
        $result->free_result();
        return $dt;
    }

    public function trimUrl($text) {

        //$text=strtolower(str_replace(array(' ',',','+','!','&',"'",";",":","?","(",")","â€™",'â€�','â€œ','/'),array('-','-','','','','','','','','','','','','',''),$text));
        $text = strtolower(url_title($text));
        $text = strip_tags($text);

        if (!$text) {
            $text = '-';
        }

        return $text;
    }

    function all_pagination_links_pg($records_per_page,$page,$totalRecords,$ptype,$get_dealer_name)
    {      
        // echo $records_per_page.'<br>';
        // echo $page.'<br>';
        // echo $totalRecords.'<br>';
        // echo $get_dealer_name.'<br>';
        
        $this->load->library('pagination_pg');

        $page = (($page!="")?$page:0);
       
        if ($this->uri->segment(1) == 'clients') {
            $burl=base_url().'/clients/?';
        }
        if ($this->uri->segment(3) == 'listMakes') {
            $burl=base_url().'/admin/brands/listMakes/?';
        }

        if ($this->uri->segment(3) == 'listModels') {
            $burl=base_url().'/admin/brands/listModels/'.$this->uri->segment(4).'/?make_id='.$this->input->get('make_id').'';
        }

        if ($this->uri->segment(3) == 'listCars') {
            $burl=base_url().'/admin/cars/listCars/?';
        }

        if ($this->uri->segment(3) == 'deletecar_com') {
            $burl=base_url().'/admin/cars/deletecar_com/?';
        }

        if ($this->uri->segment(3) == 'listplates') {
            $burl=base_url().'/admin/plate/listplates/?';
        }

        if ($this->uri->segment(3) == 'listTagsdesc') {
            $burl=base_url().'/admin/tagsdesc/listTagsdesc/?';
        }

        if ($this->uri->segment(3) == 'approveCars') {
            $burl=base_url().'/admin/cars/approveCars/?';
        }
        
        if ($this->uri->segment(1) == 'used-cars') {
            
            $burl=base_url().'/used-cars/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/?st='.$_GET['st'].'&car_make='.$_GET['car_make'].'&car_model='.$_GET['car_model'].'&ex_color_id='.$_GET['ex_color_id'].'&specs_id='.$_GET['specs_id'].'&year_min='.$_GET['year_min'].'&year_max='.$_GET['year_max'].'&price_min='.$_GET['price_min'].'&price_max='.$_GET['price_max'].'&condition='.$_GET['condition'].'&code='.$_GET['code'].'&keywords='.$_GET['keywords'];
        }

        if ($this->uri->segment(2) == 'used-cars') {
            
            $burl=base_url().'/used-cars/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/?st='.$_GET['st'].'&car_make='.$_GET['car_make'].'&car_model='.$_GET['car_model'].'&ex_color_id='.$_GET['ex_color_id'].'&specs_id='.$_GET['specs_id'].'&year_min='.$_GET['year_min'].'&year_max='.$_GET['year_max'].'&price_min='.$_GET['price_min'].'&price_max='.$_GET['price_max'].'&condition='.$_GET['condition'].'&code='.$_GET['code'].'&keywords='.$_GET['keywords'];
        }

        if ($this->uri->segment(1) == 'boats') {
            
            $burl=base_url().'/boats/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/?st='.$_GET['st'].'&type='.$_GET['type'].'&make='.$_GET['make'];
        }

        if ($this->uri->segment(1) == 'bikes') {
            
            $burl=base_url().'/bikes/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/?st='.$_GET['st'].'&make='.$_GET['make'];
        }

       
       
        if ($this->uri->segment(1) == 'numberplates') {                       
            $burl=base_url().'numberplates/?st='.$_GET['st'].'&city_id='.$_GET['city_id'].'&citycode_id='.$_GET['citycode_id'].'&number='.$_GET['number'].'&digit='.$_GET['digit'];
           // echo $burl; 
        }

        if ($this->uri->segment(1) == 'mobilenumbers') {                       
            $burl=base_url().'mobilenumbers/?st='.$_GET['st'].'&operator='.$_GET['operator'].'&operator_code='.$_GET['operator_code'].'&number='.$_GET['number'];
           // echo $burl; 
        }

        if ($this->uri->segment(1) == $get_dealer_name) {                       
            $burl=base_url().$get_dealer_name.'/?car_make='.$_GET['car_make'].'&car_model='.$_GET['car_model'];
           // echo $burl; 
        }

        if ($this->uri->segment(1) == 'plates') {                       
            $burl=base_url().'plates/'.$this->uri->segment(2).'/?city_id='.$_GET['city_id'].'&citycode_id='.$_GET['citycode_id'].'&number='.$_GET['number'];
           // echo $burl; 
        }

        
        if ($this->uri->segment(3) == 'listDeusers') {
            $burl=base_url().'/admin/deusers/listDeusers/?keywords='.$_GET['keywords'].'&user_type='.$_GET['user_type'].'';
        }

        
        //echo $this->uri->segment(1);
            
        //$burl=base_url().$this->uri->segment(1).'/?car_make='.$_GET['car_make'].'&car_model='.$_GET['car_model'];

        
        

        if ($this->uri->segment(1) == 'car-dealers') {
            $burl=base_url().'/car-dealers/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/?';
        }

        if ($this->uri->segment(1) == 'my-ads') {
            $burl=base_url().'/my-ads/?';
        }

        $config['base_url'] = $burl;
        $config['suffix'] = '&limit='.$records_per_page.'';           
        $config['total_rows'] =$totalRecords;
        $config['per_page'] = $records_per_page;

        $config['first_url'] = $config['base_url']."&page=1".$config['suffix']; 
        //$config['first_url'] = $config['base_url'].$config['prefix'].(0 * $config['per_page']).$config['suffix']; 

        $config['page_query_string'] = TRUE;
        //$config['query_string_segment'] = 'page';

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['first_link'] = "<span aria-hidden=\"true\">&laquo; First</span>";
        $config['last_link'] = "<span aria-hidden=\"true\">Last &raquo;</span>";
        
        
        $this->pagination_pg->initialize($config);
        
        return $this->pagination_pg->create_links();
    }

    public function right_menu() {        
        
        $q = 'select c.id,c.cat,c.cat_ar
                from category c 
                left join subcategory s on (c.id=s.catid)
                where c.state=1 and s.id > 0
                group by c.id 
                order by c.cat';       
        $rs = $this->common_model->getRows($q);
        $category = $rs;

        //echo"<pre>";print_r($category);echo"</pre>";die;

        include_once($this->component_path . 'right_menu.php');        
        
    }

    public function brand_slider() {        
        
        $q = 'select b.id,b.brand,b.brand_slug,b.logo
                from brands b                 
                where b.state=1                
                order by b.brand';       
        $rs = $this->common_model->getRows($q);
        $brands = $rs;

        //echo"<pre>";print_r($category);echo"</pre>";die;

        include_once($this->component_path . 'brands.php');        
        
    }

    public function get_subcategory($catid) {

        $dat = $this->getRows('SELECT id,subcat,subcat_ar FROM subcategory where catid=' . $catid . ' AND state=1 ORDER BY subcat');
        //echo"<pre>";print_r($dat);echo"</pre>";
        return $dat;
    }

    public function create_slug($str, $lowercase = TRUE) {

        if ($lowercase === TRUE)
            $str = strtolower($str);
        $str = strip_tags($str);
        $str = str_replace('.', '', $str);
// Use dash or underscore as separator        
        $replace = '-';
        $trans = array(
            '\s+' => $replace,
            '/' => $replace,
            '[^a-z0-9\-\._]' => '',
            $replace . '+' => $replace,
            $replace . '$' => $replace,
            '^' . $replace => $replace,
            '\.+$' => ''
        );

        foreach ($trans as $key => $val) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }
        $str = trim(stripslashes($str));
        return $str;
    }

    public function getMakeList() {
        $list = $this->common_model->getRows('SELECT id,make,make_ar,make_cn FROM make WHERE state=1 order by make');
        return $list;
    }

    public function getMakeID($make_name) {
        $qr = 'select id from make where make = "' . $make_name . '"';

        $query = $this->db->query($qr);
        $result = $query->row_array();
        return $result;
    }

    public function getMakeListCar() {
        $qr = 'SELECT id,make,make_ar,make_cn FROM make WHERE state=1 order by make';

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

    public function getBoatTypes() {
        $qr = 'SELECT id,type FROM boat_types WHERE state=1 order by type';

        $rs=$this->db->query($qr);
           

        foreach ($rs->result_array() as $value) {           

            $qr1 = 'SELECT count(id) ct FROM boats where boat_typeid=' . $value['id'] . ' AND state=1';
            $ct_boats = $this->db->query($qr1);
            $value['count'] = $ct_boats->row_array();

	   	 	$dt['all_type'][]=$value;
	   	}
        
        $rs->free_result();

        return $dt;
    }

    public function getBikeMakes() {
        $qr = 'SELECT id,make FROM bike_makes WHERE state=1 order by make';

        $rs=$this->db->query($qr);
           

        foreach ($rs->result_array() as $value) {           

            $qr1 = 'SELECT count(id) ct FROM bikes where make_id=' . $value['id'] . ' AND state=1';
            $ct_boats = $this->db->query($qr1);
            $value['count'] = $ct_boats->row_array();

	   	 	$dt['all_make'][]=$value;
	   	}
        
        $rs->free_result();

        return $dt;
    }

    public function getModelListCar($makeid_getmodel) {
        $qr = 'SELECT id,model,model_ar,model_cn FROM model WHERE make_id=' . $makeid_getmodel . ' and state=1 order by model';

        $rs=$this->db->query($qr);
           

        foreach ($rs->result_array() as $value) {

            $qr1 = 'SELECT count(id) ct FROM cars where model_id=' . $value['id'] . ' AND state=1';
            $ct_cars = $this->db->query($qr1);
            $value['count'] = $ct_cars->row_array();

	   	 	$dt['all_model'][]=$value;
	   	}
        
        $rs->free_result();

        return $dt;
    }

    public function get_carmodels($makeid) {

        $dat = $this->getRows('SELECT id,model,model_ar FROM model WHERE make_id=' . $makeid . ' and state=1 order by model');
        //echo"<pre>";print_r($dat);echo"</pre>";
        return $dat;
    }

    public function getBoatType() {
        $list = $this->common_model->getRows('SELECT id,type FROM boat_types WHERE state=1 order by type');
        return $list;
    }

    public function getBoatMakeList() {
        $list = $this->common_model->getRows('SELECT id,make FROM boat_makes WHERE state=1 order by make');
        return $list;
    }

    public function getBikeMakeList() {
        $list = $this->common_model->getRows('SELECT id,make FROM bike_makes WHERE state=1 order by make');
        return $list;
    }

    public function getplatecity() {
        $list = $this->common_model->getRows('SELECT id,city FROM plate_city WHERE  state=1 order by id');
        return $list;
    }

    //Urls

    public function getCarUrl($id, $make = '', $model = '') {
        $url = base_url() . 'cardetails/' . strtolower(str_replace(' ', '-', $make) . '/' . str_replace(' ', '-', $model)) . '/' . $id . '/';
        return $url;
    }

    public function getCarDealerUrl($title = '', $id = "") {       
        $url = base_url().'car-dealers/'. $title . '/'. $id ;       
        return $url;
    }

    public function getPlateUrl($id, $city = '', $code = '') {
        $url = base_url() . 'numberplates/platedetails/' . strtolower(str_replace(' ', '-', $city) . '/' . str_replace(' ', '-', $code)) . '/' . $id . '/';
        return $url;
    }

    public function getPlateDealerUrl($title = '') {  
        $url = base_url(). 'plates/'. $title . '/';            
        //$url = base_url(). $title . '/' ;       
        return $url;
    }

    public function getMobilenumberUrl($id, $operator = '', $operator_code = '') {
        $url = base_url() . 'mobilenumbers/mobilenumberdetails/' . strtolower(str_replace(' ', '-', $operator) . '/' . str_replace(' ', '-', $operator_code)) . '/' . $id . '/';
        return $url;
    }

    public function getBoatDealerUrl($title = '') {  
        $url = base_url(). 'boat/'. $title . '/';            
        //$url = base_url(). $title . '/' ;       
        return $url;
    }

    public function getBoatUrl($id, $type = '', $make = '') {
        $url = base_url() . 'boats/boatdetails/' . strtolower(str_replace(' ', '-', $type) . '/' . str_replace(' ', '-', $make)) . '/' . $id . '/';
        return $url;
    }

    public function getBikeUrl($id, $make = '') {
        $url = base_url() . 'bikes/bikedetails/' . strtolower(str_replace(' ', '-', $make)) . '/' . $id . '/';
        return $url;
    }

    public function getBikeDealerUrl($title = '') {  
        $url = base_url(). 'bike/'. $title . '/';            
        //$url = base_url(). $title . '/' ;       
        return $url;
    }

    //Urls

    public function updateVisits($id_array = array(), $table) {       

        $q = "UPDATE $table SET visits = visits + 1 WHERE " . key($id_array) . " = " . $id_array[key($id_array)];
        $r = $this->db->query($q);
    }


    public function carSearch() {

        $get_make=$this->input->get("car_make");

        $q = 'select mk.id, mk.make,mk.make_ar
                from make mk                 
                where mk.state=1                
                order by mk.make';       
        $rs = $this->common_model->getRows($q);
        $make = $rs;

        if ($get_make <> '') {
            $q_model = 'SELECT md.id,md.model,md.model_ar FROM model md
                WHERE md.make_id=' . $get_make . ' and
                md.state=1 group by md.id';
            $rs1 = $this->common_model->getRows($q_model);
            $model = $rs1;
        }

        if ((empty($_SERVER['QUERY_STRING']) && $this->uri->rsegment(2) <> '' )) {
            $make_ur = $this->uri->rsegment(2);
            //echo $make_ur;
            //echo 'select id from make where state=1 AND REPLACE(make," ","_")="' . $make_ur . '"';
            if ($make_ur != '') {
                if ($make_ur == 'Mercedes_Benz') {
                        $get_make = 'REPLACE(make,"-","_")="' . $make_ur . '"' ;
                     } else{
                        $get_make = 'REPLACE(make," ","_")="' . $make_ur . '"' ;
                }
                

                $mk = $this->getRow('select id from make where state=1 AND '.$get_make.' ');

                //echo 'select id from make where state=1 AND '.$get_make.' ';

                $get_make = $mk->id;

                //print_r($get_make);
            }
            
            $rs1=$this->common_model->getRows('SELECT id,model FROM model WHERE make_id="'.$get_make.'" AND state=1 ORDER BY model ');
            $model = $rs1;
        }

        $year = range(date("Y")+1, date("Y") - 70);

        include_once($this->filters_path . 'car_search.php');
    }

    function makeReplace($make) {
        $make = str_replace('-', ' ', $make);
        return $make;
    }

    public function breadCrumbs($id = '') {
        $html = '';

        $controller = $this->uri->rsegment(1);

        if (stristr($controller, '_') !== FALSE) {
            $controller = str_replace('_', '-', $controller);
        }        
        
        switch ($controller) {            
            case 'cars-for-sale':                
                $html.=$this->breadCrumbsCars();
                break;  
            case 'cars-for-sale':                
                $html.=$this->breadCrumbsCars();
                break;            
            default:
                $html.='<ol class="breadcrumb"><li><a href="' . base_url() . '">'.$this->lang->line('home').'</a></li></ol>';
        }        
        //$this->smarty->caching = 0;
        echo $html;
        //$this->smarty->caching = 1;
    }

    public function breadCrumbsCars() {
        
        $make=$this->uri->rsegment(2);
        $model=$this->uri->rsegment(3);

        //echo $make;

        $rs1=$this->getRow('SELECT id,make,make_ar FROM make WHERE make="'.$make.'" AND state=1');
        $rs2=$this->getRow('SELECT id,model,model_ar FROM model WHERE model="'.$model.'" AND state=1');        
        
        
       
        if ($this->uri->segment(1)=='ar') {            
            $make_d=$rs1->make_ar;
            $model_d=$rs2->model_ar;
        }else{            
            $make_d=$rs1->make;
            $model_d=$rs2->model;
        }

        
        if ($this->uri->segment(1)=='ar') {
            if ($this->uri->segment(3)) {
                $bread_menu='
                    <li><a href="' . base_url() . 'cars-for-sale/'.$make.'">'.$make_d.'</a></li>
                    <li><a href="' . base_url() . 'cars-for-sale/'.$make.'/'.$model.'">'.$model_d.'</a></li>  
                ';
            }
        }else{
            if ($this->uri->segment(2)) {
                $bread_menu='
                    <li><a href="' . base_url() . 'cars-for-sale/'.$make.'">'.$make_d.'</a></li>
                    <li><a href="' . base_url() . 'cars-for-sale/'.$make.'/'.$model.'">'.$model_d.'</a></li>  
                ';
            }
        }
        
          

        $html = '<ol class="breadcrumb">
                    <li><a href="' . base_url() . '">'.$this->lang->line('home').'</a></li>
                    <li class="active"><a href="' . base_url() . 'cars-for-sale">'.$this->lang->line('cars_for_sale').'</a></li>  
                    '.$bread_menu.'
                               
                </ol>';        
        
        return $html;
    }

    public function breadCrumbsDetails($id = '') {
        $html = '';

        $controller = $this->uri->rsegment(2);

        if (stristr($controller, '_') !== FALSE) {
            $controller = str_replace('_', '-', $controller);
        }        
        
        switch ($controller) {            
            case 'cardetails':                
                $html.=$this->breadCrumbsCarDetails();
                break;                       
            default:
                $html.='<ol class="breadcrumb"><li><a href="' . base_url() . '">'.$this->lang->line('home').'</a></li></ol>';
        }        
        //$this->smarty->caching = 0;
        echo $html;
        //$this->smarty->caching = 1;
    }

    public function breadCrumbsCarDetails() {
        $make=$this->uri->rsegment(3);
        $model=$this->uri->rsegment(4);

        $rs1=$this->getRow('SELECT id,make,make_ar FROM make WHERE make="'.$make.'" AND state=1');
        $rs2=$this->getRow('SELECT id,model,model_ar FROM model WHERE model="'.$model.'" AND state=1');
        
        
        
       
        if ($this->uri->segment(1)=='ar') {            
            $make_d=$rs1->make_ar;
            $model_d=$rs2->model_ar;
        }else{            
            $make_d=$rs1->make;
            $model_d=$rs2->model;
        }


        $html = '<ol class="breadcrumb">
                    <li><a href="' . base_url() . '">'.$this->lang->line('home').'</a></li>
                    <li class="active"><a href="' . base_url() . 'cars-for-sale">'.$this->lang->line('cars_for_sale').'</a></li>
                    <li class="active"><a href="' . base_url() . 'cars-for-sale/'.$make.'">'.$make_d.'</a></li>
                    <li class="active"><a href="' . base_url() . 'cars-for-sale/'.$make.'/'.$model.'">'.$model_d.'</a></li>               
                </ol>';        
        
        return $html;
    }

    function getUrl($id) {
        $row = $this->getRow('SELECT mk.make,md.model FROM cars c
                LEFT JOIN  make mk on (c.make_id=mk.id and mk.state=1)
                LEFT JOIN  model md on (c.model_id=md.id and md.state=1)                
                WHERE c.id="' . $id . '" AND c.state=1 GROUP BY c.id limit 1');
        $url = $this->getCarUrl($id, $row->make, $row->model);
        return $url;
    }


    function get_dt($date) {
        $date = new DateTime($date);
        return $date->format('d-M-Y');
        //return $date->format('d-M-Y H:i');
    }

    public function mobileDigitalLinkHome() {
        

        $this->load->library('Mobile_Detect');
        
        $detect = new Mobile_Detect();

        
        
        if ($detect->isAndroidOS()) {
            return '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="app-title">
                        Get our app for the best experience
                    </div>
                    <div class="app-img">
                        <div class="image">
                        <img src="'. theme_url() .'img/android_app.png" alt="" />
                        </div>
                    </div>

                    <div class="btn-cont">
                        <a href="https://play.google.com/store/apps/details?id=com.divyams.autotraders" class="btn btn-primary"><i class="fab fa-android"></i> Get the Android App</a>
                    </div>

                    
                  
                </div>
                
              </div>
            </div>
            </div>
            ';
        } else {
            return '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="app-title">
                        Get our app for the best experience
                    </div>
                    <div class="app-img">
                        <div class="image">
                        <img src="'. theme_url() .'img/iphone_app.png" alt="" />
                        </div>
                    </div>

                    <div class="btn-cont">
                        <a href="https://apps.apple.com/us/developer/batol-sebai/id1556220138" class="btn btn-primary"><i class="fab fa-apple"></i> Get the iphone App</a>
                    </div>

                    
                  
                </div>
                
              </div>
            </div>
            </div>';
        }
    }

    

    
}
?>