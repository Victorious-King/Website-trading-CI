<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myposts extends CI_Controller {

	var $user_id;

	function __construct() {

        parent::__construct();

        if (!$this->session->userdata('user_id')) {
           
            redirect(base_url());
           
        }

        
        $this->user_id = $this->session->userdata('user_id');
        
        $this->load->model('myads_model');
    }

  public function index()
	{	
    $data['myads_cars'] =  $this->common_model->getNumberOfRows('SELECT id from cars where user_id="' . $this->user_id . '" AND (state=1 or state=2) AND (expiry >="' . $this->common_model->dt . '")');	

    $data['myads_numberplates'] =  $this->common_model->getNumberOfRows('SELECT id from plates where user_id="' . $this->user_id . '" AND (state=1 or state=2) AND (expiry >="' . $this->common_model->dt . '")');	     
    
    $data['myads_boats'] =  $this->common_model->getNumberOfRows('SELECT id from boats where user_id="' . $this->user_id . '" AND (state=1 or state=2) AND (expiry >="' . $this->common_model->dt . '")');	  

    $data['myads_bikes'] =  $this->common_model->getNumberOfRows('SELECT id from bikes where user_id="' . $this->user_id . '" AND (state=1 or state=2) AND (expiry >="' . $this->common_model->dt . '")');

    $data['myads_mobilenumber'] =  $this->common_model->getNumberOfRows('SELECT id from mobile_numbers where user_id="' . $this->user_id . '" AND (state=1 or state=2) AND (expiry >="' . $this->common_model->dt . '")');

    $this->load->view("myads", $data);	
  }

	public function cars()
	{			
		$ptype=$this->uri->segment(1);
		//echo $ptype;die;
		$limit=200;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->myads_model->listCars($limit,$page,$this->user_id);
		
		
		if ($result['totalRows']){
			$data['list_cars']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_cars']=$result['totalRows'];

    $this->load->view("myads_cars", $data);	
    
	}

    function check_default($post_string)
    {
      return $post_string == '0' ? FALSE : TRUE;

    }

	public function addCar()
	{	
		
		$email=$this->session->userdata('email');
		$date = date('Y-m-d H:i:s');

    $expiry=date('Y-m-d', strtotime("+180 days"));

		$title=$this->input->post('title');
		$title_slug = $this->common_model->create_slug($title);	

        if ($this->session->userdata('user_type')=="Private") {
            $code = "P";
        } else{
            $code = "D";
        }

        $img_state = ($this->session->userdata('user_type') == "Dealer" ? 1 : 2);

        if ($this->input->post('featured')){
          $featured = 1;
          
        }else{
          $featured = 0;
          
        }

		
        $this->form_validation->set_rules('title', 'Title', 'required'); 
        $this->form_validation->set_rules('year','Year','required|callback_check_default');
        $this->form_validation->set_rules('make_id','Make','required|callback_check_default');
        $this->form_validation->set_rules('model_id','Model','required|callback_check_default');
        
        $this->form_validation->set_rules('price', 'Price', 'required'); 

        $this->form_validation->set_rules('mileage', 'Mileage', 'required');
        $this->form_validation->set_rules('body_type_id','Body type','required|callback_check_default');

        $this->form_validation->set_rules('des', 'Car description', 'required');

        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        

        if (($this->form_validation->run() == FALSE)) {            
            $last_link = $this->input->post('last_link') . '?err=1';
            $_SESSION['sess_alert']=validation_errors();
            redirect(''. base_url() .'postad/car/?st=1');
            
        } else { 
        $last_link = $this->input->post('last_link');           
                $data=array(
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
                  'in_color' => $this->input->post('in_color'),
                  'specs' => $this->input->post('specs'),
                  'trans' => $this->input->post('trans'), 

                  'body_type_id' => $this->input->post('body_type_id'),                
                  'fuel_type_id' => $this->input->post('fuel_type_id'),
                  'ex_color_id' => $this->input->post('ex_color_id'),
                  'in_color_id' => $this->input->post('in_color_id'),
                  'specs_id' => $this->input->post('specs_id'),
                  'trans_id' => $this->input->post('trans_id'),

                  'des' => $this->input->post('des'),
                  'condition' => $this->input->post('condition'),    
                  
                  'featured' => $featured,
  
                  'user_id' => $this->user_id,
                  'code' => $code,
                  'ip' => $_SERVER["REMOTE_ADDR"],
                  'country' => $this->input->post('country'),
                  'city' => $this->input->post('city'),
                  'location' => $this->input->post('location'),
                  'mobile' => $this->input->post('mobile'),
                  'expiry' => $expiry,
                  'lat' => $this->input->post('lat'),
                  'lng' => $this->input->post('lng'),
                  'video' => $this->input->post('video'),
  
  
                  'created_dt' => $date,              
                  'edited_dt' => $date,
                  'created_by' => $email,
                  'edited_by' => $email,
                  'state' => 1
				);
      $insert_id = $this->myads_model->insertCar($data);	
      // $files=$this->input->post('files[]');
      // for ($i = 0; $i < count($files); $i++) {
      // print_r($files[$i]['name']);die;
      // }
      $this->asset_model->addAsset($insert_id, 'Car', "files", $img_state);

      $data['get_car'] = $this->myads_model->get_cars_email($insert_id);

      //echo"<pre>";print_r($data['get_car']['make']);echo"</pre>";die;

      $car_make= $data['get_car']['make'];
      $car_model= $data['get_car']['model'];

      // Email
      $message = base_url() . 'cars/cardetails/'.$car_make.'/'.$car_model.'/'.$insert_id.'/';

      //echo $message; die;

      $title="New AD from User";
      $this->load->library('email');
      $config['mailtype'] = 'html';
      $config['wordwrap'] = TRUE;
      $config['charset'] = 'UTF-8';

      $this->email->initialize($config);

      $this->email->from('online@dubaiedition.com', 'DubaiEdition');
      $this->email->to('dubaiedition.com@gmail.com');  
      $this->email->subject($title);
      $this->email->message($message);
                    
      $this->email->send();  

      //echo $this->email->print_debugger(); die;
      

			//$this->email_ack($insert_id);

      $_SESSION['sess_alert']= 'Your Ad has been posted successfully!';
            //$this->load->view("edit_car", $data);   
            //$data['product_featured'] = $this->myads_model->getProduct($id=1); 
            //print_r($data['product_featured']['id']);
            //$this->load->view("options", $data);   
            //print_r($_SESSION['sess_alert']);die;
            redirect($last_link . '?err=1');
               
        }        
        
	}


	public function editCar($id)
    {   
        
    $data['actionType']='update';
		$this->config->load('site_settings');

		$data['car'] = $this->myads_model->editCar($id);

		$data['countries']=$this->common_model->getRows('SELECT country from countries where state=1 limit 6');
		$data['city_list'] = $this->common_model->getRows('SELECT city FROM country_city WHERE state=1 and country="' . $data['car']['country'] . '" order by city');

		// $data['car_body_type']=$this->config->item('car_body_type');
		// $data['fuel_type']=$this->config->item('fuel_type');
		// $data['color']=$this->config->item('color');
		// $data['specs']=$this->config->item('specs');

    $data['car_body_type']=$this->common_model->getRows('SELECT id,body_type,body_type_ar,body_type_cn from car_body_type where state=1 order by id ASC');

		$data['fuel_type']=$this->common_model->getRows('SELECT id,fuel_type,fuel_type_ar,fuel_type_cn from car_fuel_type where state=1 order by id ASC');

		$data['color']=$this->common_model->getRows('SELECT id,color,color_ar,color_cn from car_color where state=1 order by id ASC');

		$data['specs']=$this->common_model->getRows('SELECT id,specs,specs_ar,specs_cn from car_specs where state=1 order by id ASC');

		$data['trans']=$this->common_model->getRows('SELECT id,trans,trans_ar,trans_cn from car_trans where state=1 order by id ASC');

		$data['city']=$this->config->item('city');
		

		
		$data['make'] = $this->common_model->getMakeList();
		$data['model']=$this->common_model->getRows('SELECT id,model FROM model WHERE make_id="'.$data['car']['make_id'].'" AND state=1 ORDER BY model ');
		
		$data['assets'] = $this->asset_model->getAssetsMyads('Car', $id);


    if ($this->user_id) {
      //get phone number
      $user_exdet=$this->common_model->getRow('SELECT mobile,city,user_type,limit_featured FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
	//   echo 'SELECT mobile,city,user_type FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1';
			$data['phone_number'] = $user_exdet->mobile; 			    
      		$data['user_city'] = $user_exdet->city;
			$data['user_type'] = $user_exdet->user_type;
			$data['limit_featured'] = $user_exdet->limit_featured;
			//print_r($data['limit_featured']);   

			$data['featured_ct'] = $this->common_model->rowsCount('cars', 'user_id='.$this->user_id.' and featured=1');

			// print_r($data['featured_ct']);   echo "------";
			// print_r($data['limit_featured']);  
			
  	}

        
        $this->load->view("edit_car",$data);
    }

    public function updateCar()
    {	
    	
    	$car_id=$this->input->post('car_id');    	
      $data['car'] = $this->myads_model->updateCar($car_id);	
      
      $img_state = ($this->session->userdata('user_type') == "Dealer" ? 1 : 2);


      $this->asset_model->addAsset($car_id, 'Car', "files", $img_state);

    	//$this->asset_model->addAsset($car_id, 'Car');

		$last_link = $this->input->post('last_link'); 

		//print_r($last_link);die;			

		$_SESSION['sess_alert'] = '<strong>Car </strong> has been updated successfully!';
        //redirect($last_link . '?err=1');
        redirect(''. base_url() .'myposts/editCar/'. $car_id .'/?err=1');
        //$this->load->view("post/edit_car",$data);

	}

	public function removeAsset($id, $section_id) {

        $this->asset_model->removeAsset($id);

        redirect(''. base_url() .'myposts/editCar/'. $section_id .'/?err=1');
        // redirect('admin/cars/editCar/' . $section_id . '/suc');
    }

    public function deleteCar($id)
	{
    	$delete = $this->myads_model->deleteCar($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Car </strong> has been deleted successfully!';            	
		redirect(''. base_url() .'myposts/?err=1');
  }

  public function removeFad($id)
	{
    	$delete_fad = $this->myads_model->delete_fad($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Featured AD </strong> has been removed successfully!';            	
		redirect(''. base_url() .'myposts/editCar/'. $id .'?err=1');
  }

  public function numberplates()
	{			
		$ptype=$this->uri->segment(1);
		//echo $ptype;die;
		$limit=200;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->myads_model->listPlates($limit,$page,$this->user_id);
		
		
		if ($result['totalRows']){
			$data['list_plates']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_plates']=$result['totalRows'];

    $this->load->view("myads_numberplates", $data);	
    
	}


  public function addPlate()
	{	
		
		$email=$this->session->userdata('email');
		$date = date('Y-m-d H:i:s');

    $expiry=date('Y-m-d', strtotime("+180 days"));

		$title=$this->input->post('title');
		$title_slug = $this->common_model->create_slug($title);	

        if ($this->session->userdata('user_type')=="Private") {
            $code = "P";
        } else{
            $code = "D";
        }       

		
        $this->form_validation->set_rules('title', 'Title', 'required'); 
        $this->form_validation->set_rules('city_id','Plate city','required|callback_check_default');
        $this->form_validation->set_rules('citycode_id','City code','required|callback_check_default');
        $this->form_validation->set_rules('number', 'Number', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required'); 
        $this->form_validation->set_rules('des', 'Plate description', 'required');

        $this->form_validation->set_rules('mobile', 'Mobile number', 'required');
        

        if (($this->form_validation->run() == FALSE)) {            
            $last_link = $this->input->post('last_link') . '?err=1';
            $_SESSION['sess_alert']=validation_errors();
            redirect(''. base_url() .'postad/numberplate/?st=1');
            
        } else { 
        $last_link = $this->input->post('last_link');           
                $data=array(
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

                  'user_id' => $this->user_id,
                  'code' => $code,                                
                  'city' => $this->input->post('city'),                  
                  'mobile' => $this->input->post('mobile'),
                  'expiry' => $expiry,
                  'ip' => $_SERVER["REMOTE_ADDR"],    
                  'lat' => $this->input->post('lat'),
                  'lng' => $this->input->post('lng'),                 
  
  
                  'created_dt' => $date,              
                  'edited_dt' => $date,
                  'created_by' => $email,
                  'edited_by' => $email,
                  'state' => 1
				);			
      $insert_id = $this->myads_model->insertPlate($data);	
      

      $data['error'] = 'Your Ad has been posted successfully!';
      $this->load->view("edit_plate", $data);   
            //print_r($_SESSION['sess_alert']);die;
            //redirect($last_link . '?err=1');
               
        }        
        
  }
  
  public function editPlate($id)
    {   
        
    $data['actionType']='update';
    $this->config->load('site_settings');

    if ($this->user_id) {
      //get phone number
      $user_exdet=$this->common_model->getRow('SELECT mobile,city FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
			$data['phone_number'] = $user_exdet->mobile; 			    
      $data['user_city'] = $user_exdet->city;
			$data['user_type'] = $user_exdet->type;
			//print_r($data['user_city']);   
  	}
    
   

    $data['plate'] = $this->myads_model->editPlate($id);

    $platecity=$this->common_model->getRow('SELECT city FROM plate_city WHERE id="'.$data['plate']['city_id'].'" AND state=1 limit 1');

    $platecode=$this->common_model->getRow('SELECT code FROM plate_citycode WHERE id="'.$data['plate']['citycode_id'].'" AND state=1 limit 1');    
    
    //echo"<pre>";print_r($data['plate']);echo"</pre>";

    $data['pcity']=$platecity->city;
    $data['pcitycode']=$platecode->code;

    //print_r($data['getplatecitycode']);

    $data['city']=$this->config->item('city');
    $data['plate_city'] = $this->common_model->getplatecity();
    
    $data['citycode']=$this->common_model->getRows('SELECT id,code FROM plate_citycode WHERE city_id="'.$data['plate']['city_id'].'" AND state=1 ORDER BY code ');
    
    $this->load->view("edit_plate",$data);
    }

    public function updatePlate()
    {	
    	
    	$plate_id=$this->input->post('plate_id');    	
    	$data['plate'] = $this->myads_model->updatePlate($plate_id);	    	

	  	$last_link = $this->input->post('last_link'); 

		

      $_SESSION['sess_alert'] = '<strong>Number plate </strong> has been updated successfully!';
          
      redirect(''. base_url() .'myposts/editPlate/'. $plate_id .'/?err=1');
        

  }
  
  public function deletePlate($id)
	{
    	$delete = $this->myads_model->deletePlate($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Number plate </strong> has been deleted successfully!';            	
		redirect(''. base_url() .'myposts/numberplates/?err=1');
  }
  

  


    public function email_ack($insert_id) {

        $to = $this->session->userdata('email');
        $title = 'Your DubaiEdition ad is now live!';
        $get_url = $this->common_model->getUrl($insert_id);


        $message = '
                    <!DOCTYPE html>
                    <html>
                    <head>
                      <title></title>  
                    </head>
                    <body bgcolor="#ece7de">
                      <table cellpadding="0" cellpadding="0" width="100%" bgcolor="#ece7de">
                        <tr>
                          <td height="70"></td>
                        </tr>
                        <tr>
                          <td class="middle" align="center">
                              

                          <table cellspacing="0" cellpadding="0" width="700" bgcolor="#ffffff" style="border-radius:10px;overflow:hidden;">
                            <tr>
                              <td>

                                  <!-- Email Header -->
                                  <table cellpadding="0" cellspacing="0" width="700" bgcolor="#ffffff">
                                    <tr>
                                      <td colspan="5" height="20"></td>
                                    </tr>
                                    <tr>
                                      <td width="50"></td>
                                      <td width="200"></td>
                                      <td width="100" align="center">
                                        <img src="'. theme_url() .'img/DubaiEdition_logo.png" alt="" width="250" height="54" />
                                      </td>
                                      <td width="200" valign="top" align="right" style="font-family: Arial;font-size:15px;">
                                        
                                      </td>
                                      <td width="50"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="5" height="20"></td>
                                    </tr>
                                  </table>



                                  <!-- Notification Banner -->
                                  <table cellpadding="0" cellspacing="0" width="700" bgcolor="#318bca">
                                    <tr><td height="18"></td></tr>
                                    <tr>
                                      <td width="700" align="center" style="font-family: Arial;font-size:20px;color:#ffffff;">
                                          Thank you for your Posting!
                                      </td>              
                                    </tr>
                                    <tr><td height="18"></td></tr>
                                  </table>




                                        <table cellpadding="0" cellspacing="0" width="700" bgcolor="#ffffff">
                                          <tr><td colspan="3" height="20"></td></tr>
                                          <tr>
                                            <td width="50"></td>
                                            <td width="600"> 
                                              <p style="font-family: Arial;font-size:15px;line-height:24px;"><strong>Welcome !</strong></p> 
                                              <p style="font-family: Arial;font-size:15px;line-height:24px;">Your ad is now live.</p>                        
                                              <p style="font-family: Arial;font-size:15px;line-height:24px;">
                                                Please take few minutes to read this valuable advice. We’ve put together some general tips below for buying safely online. 
                                              </p>
                                              <p>
                                                <ul style="font-family: Arial;font-size:15px;line-height:24px;">
                                                    <li>Meet face to face, never send any money for any items you have not seen</li>
                                                    <li>Do not ship items - always trade face to face</li>
                                                    <li>Never ever give your bank details or bank card details to buyers</li>                                                    
                                                </ul>
                                              </p>

                                              <p style="font-family: Arial;font-size:15px;line-height:24px;">Your AD link:  '.$get_url.'</p>
                                            </td>
                                            <td width="50"></td>
                                          </tr>
                                          <tr><td colspan="3" height="10"></td></tr>
                                          <tr>
                                            <td width="50"></td>
                                            <td width="600">
                                                

                                               




                                           



                                            </td>              
                                            <td width="50"></td>
                                          </tr>

                                          <tr><td colspan="3" height="50"></td></tr>            
                                        </table>




                                     <!-- Email Footer -->
                                     <table cellpadding="0" cellspacing="0" width="700" bgcolor="#333333">
                                      <tr><td height="4" bgcolor="#e44141"></td></tr>
                                      <tr><td height="30"></td></tr>
                                      <tr>
                                        <td width="700" align="center" style="font-family: Arial;font-size:20px;color:#ffffff;">
                                            Have any query?
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="700" align="center">

                                            <table cellpadding="0" cellspacing="0" width="700"> 
                                              <tr>
                                                <td colspan="3" height="12"></td>
                                              </tr>
                                              <tr>
                                                <td width="150"></td>
                                                <td width="400" align="center">
                                                  <p style="font-family: Arial;padding:0;margin:0;font-size:15px;line-height:22px;color:#e5e5e5;">Please click below and drop your message. We will try to get back to you as soon as possible.</p>
                                                </td>
                                                <td width="150"></td>
                                              </tr>
                                              <tr>
                                                <td colspan="3" height="16"></td>
                                              </tr>
                                            </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="700" align="center">
                                            <table width="200" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td>
                                                  <div>
                                                    <!--[if mso]>
                                                      <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://www.google.com" style="font-family: Arial;height:36px;v-text-anchor:middle;width:200px;" arcsize="5%" strokecolor="#FF3E3B" fillcolor="#FF3E3B">
                                                        <w:anchorlock/>
                                                        <center style="font-family: Arial;color:#ffffff;font-size:16px;">Customer Support &rarr;</center>
                                                      </v:roundrect>
                                                    <![endif]-->
                                                    <a href="'. base_url() .'contact" target="_blank" style="font-family: Arial;background-color:#e44141;border:1px solid #FF3E3B;border-radius:0px;color:#ffffff;display:inline-block;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;">Customer Support &rarr;</a>
                                                  </div>
                                                </td>
                                              </tr>
                                            </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td height="26"></td>
                                      </tr>
                                      <tr>
                                        <td width="700" align="center" style="font-family: Arial;color:#A2A2A2;font-size:12px;">
                                           &#x00A9; 2016 DubaiEdition. All rights reserved.
                                        </td>
                                      </tr>
                                      <tr><td height="15"></td></tr>
                                    </table>


                              
                              </td>
                            </tr>
                          </table>




                          </td>
                        </tr>
                        <tr>
                          <td height="70"></td>
                        </tr>
                      </table>
                    </body>
                    </html>
                    ';
        //echo $message;die; 
        $this->load->library('email');

        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $config['charset'] = 'UTF-8';

        $this->email->initialize($config);

        
        $this->email->from('noreply@DubaiEdition.com', 'DubaiEdition');
        $this->email->reply_to($email);
        $this->email->to($to);        
        $this->email->cc('DubaiEdition.com@gmail.com');
        $this->email->subject($title);
        $this->email->message($message);
        
        $this->email->send();      
    }




    //Boat
    public function boats()
    {			
      $ptype=$this->uri->segment(1);
      //echo $ptype;die;
      $limit=200;
      $page = (($this->input->get("page"))?$this->input->get("page"):0);

      $result=$this->myads_model->listBoats($limit,$page,$this->user_id);
      
      
      if ($result['totalRows']){
        $data['list_boats']=$result['search_result'];
      }
      
      $data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

      $data['total_boats']=$result['totalRows'];

      $this->load->view("myads_boats", $data);	
      
    }
  
    public function addBoat()
    {	
      
      $email=$this->session->userdata('email');
      $date = date('Y-m-d H:i:s');

      $expiry=date('Y-m-d', strtotime("+180 days"));

      $title=$this->input->post('title');
      $title_slug = $this->common_model->create_slug($title);	

          if ($this->session->userdata('user_type')=="Private") {
              $code = "P";
          } else{
              $code = "D";
          }

          $img_state = ($this->session->userdata('user_type') == "Dealer" ? 1 : 2);

      
          $this->form_validation->set_rules('title', 'Title', 'required'); 
          $this->form_validation->set_rules('year','Year','required|callback_check_default');
          $this->form_validation->set_rules('make_id','Make','required|callback_check_default');
          $this->form_validation->set_rules('boat_typeid','Boat type','required|callback_check_default');
          
          $this->form_validation->set_rules('price', 'Price', 'required'); 

          $this->form_validation->set_rules('length', 'Length', 'required');          

          $this->form_validation->set_rules('des', 'Boat description', 'required');

          $this->form_validation->set_rules('mobile', 'Mobile', 'required');
          

          if (($this->form_validation->run() == FALSE)) {            
              $last_link = $this->input->post('last_link') . '?err=1';
              $_SESSION['sess_alert']=validation_errors();
              redirect(''. base_url() .'postad/boat/?st=1');
              
          } else { 
          $last_link = $this->input->post('last_link');           
                  $data=array(
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
    
                    'user_id' => $this->user_id,
                    'code' => $code,
                    'ip' => $_SERVER["REMOTE_ADDR"],
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'location' => $this->input->post('location'),
                    'mobile' => $this->input->post('mobile'),
                    'expiry' => $expiry,
                    'lat' => $this->input->post('lat'),
                    'lng' => $this->input->post('lng'),   
    
                    'created_dt' => $date,              
                    'edited_dt' => $date,
                    'created_by' => $email,
                    'edited_by' => $email,
                    'state' => 1
          );			
        $insert_id = $this->myads_model->insertBoat($data);	
        
        

        $this->asset_model->addAssetBoat($insert_id, 'Boat', "files", $img_state);
        

        //$this->email_ack($insert_id);

              $data['error'] = 'Your Ad has been posted successfully!';
              $this->load->view("edit_boat", $data);   
              //print_r($_SESSION['sess_alert']);die;
              //redirect($last_link . '?err=1');
                
          }        
          
    }


    public function editBoat($id)
    {   
        
    $data['actionType']='update';
    $this->config->load('site_settings');
    
    $data['boat_type'] = $this->common_model->getBoatType();
    $data['boat_make'] = $this->common_model->getBoatMakeList();
    
    if ($this->user_id) {
      //get phone number
      $user_exdet=$this->common_model->getRow('SELECT mobile,city FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
			$data['phone_number'] = $user_exdet->mobile; 			    
      $data['user_city'] = $user_exdet->city;
			$data['user_type'] = $user_exdet->type;
			//print_r($data['user_city']);   
  	}
    

    $data['boat'] = $this->myads_model->editBoat($id);
    
		$data['city']=$this->config->item('city');
				
		$data['assets'] = $this->asset_model->getAssetsMyadsBoat('Boat', $id);

    $this->load->view("edit_boat",$data);
    }

    public function updateBoat()
    {	
    	
    	$boat_id=$this->input->post('boat_id');    	
      $data['boat'] = $this->myads_model->updateBoat($boat_id);	
      
      $img_state = ($this->session->userdata('user_type') == "Dealer" ? 1 : 2);


      $this->asset_model->addAssetBoat($boat_id, 'Boat', "files", $img_state);

    	//$this->asset_model->addAsset($boat_id, 'Boat');

		$last_link = $this->input->post('last_link'); 

		//print_r($last_link);die;			

		$_SESSION['sess_alert'] = '<strong>Boat </strong> has been updated successfully!';
        //redirect($last_link . '?err=1');
        redirect(''. base_url() .'myposts/editBoat/'. $boat_id .'/?err=1');
        //$this->load->view("post/edit_car",$data);

  }
  

  public function deleteBoat($id)
	{
    	$delete = $this->myads_model->deleteBoat($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Boat </strong> has been deleted successfully!';            	
		redirect(''. base_url() .'myposts/?err=1');
  }

  public function removeAssetBoat($id, $section_id) {

    $this->asset_model->removeAssetBoat($id);

    redirect(''. base_url() .'myposts/editBoat/'. $section_id .'/?err=1');
    // redirect('admin/cars/editCar/' . $section_id . '/suc');
}

      
	

//Bikes
public function bikes()
{			
  $ptype=$this->uri->segment(1);
  //echo $ptype;die;
  $limit=200;
  $page = (($this->input->get("page"))?$this->input->get("page"):0);

  $result=$this->myads_model->listBikes($limit,$page,$this->user_id);
  
  
  if ($result['totalRows']){
    $data['list_bikes']=$result['search_result'];
  }
  
  $data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

  $data['total_bikes']=$result['totalRows'];

  $this->load->view("myads_bikes", $data);	
  
}

public function addBike()
{	
  
  $email=$this->session->userdata('email');
  $date = date('Y-m-d H:i:s');

  $expiry=date('Y-m-d', strtotime("+180 days"));

  $title=$this->input->post('title');
  $title_slug = $this->common_model->create_slug($title);	

      if ($this->session->userdata('user_type')=="Private") {
          $code = "P";
      } else{
          $code = "D";
      }

      $img_state = ($this->session->userdata('user_type') == "Dealer" ? 1 : 2);

  
      $this->form_validation->set_rules('title', 'Title', 'required'); 
      $this->form_validation->set_rules('year','Year','required|callback_check_default');
      $this->form_validation->set_rules('make_id','Make','required|callback_check_default');     
      
      $this->form_validation->set_rules('price', 'Price', 'required'); 

      $this->form_validation->set_rules('condition', 'Condition', 'required');          

      $this->form_validation->set_rules('des', 'Bike description', 'required');

      $this->form_validation->set_rules('mobile', 'Mobile', 'required');
      

      if (($this->form_validation->run() == FALSE)) {            
          $last_link = $this->input->post('last_link') . '?err=1';
          $_SESSION['sess_alert']=validation_errors();
          redirect(''. base_url() .'postad/bike/?st=1');
          
      } else { 
      $last_link = $this->input->post('last_link');           
              $data=array(
                'title' => $title,
                'title_slug' => $title_slug,
                'year' => $this->input->post('year'),                		
                'make_id' => $this->input->post('make_id'),								
                'price' => $this->input->post('price'),
                'condition' => $this->input->post('condition'),                
                'des' => $this->input->post('des'),

                'user_id' => $this->user_id,
                'code' => $code,
                'ip' => $_SERVER["REMOTE_ADDR"],
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'location' => $this->input->post('location'),
                'mobile' => $this->input->post('mobile'),
                'expiry' => $expiry,
                'lat' => $this->input->post('lat'),
                'lng' => $this->input->post('lng'),   

                'created_dt' => $date,              
                'edited_dt' => $date,
                'created_by' => $email,
                'edited_by' => $email,
                'state' => 1
      );			
    $insert_id = $this->myads_model->insertBike($data);	
    
    

    $this->asset_model->addAssetBike($insert_id, 'Bike', "files", $img_state);
    

    //$this->email_ack($insert_id);

          $data['error'] = 'Your Ad has been posted successfully!';
          $this->load->view("edit_bike", $data);   
          //print_r($_SESSION['sess_alert']);die;
          //redirect($last_link . '?err=1');
            
      }        
      
}


public function editBike($id)
{   
    
$data['actionType']='update';
$this->config->load('site_settings');

$data['bike_make'] = $this->common_model->getBikeMakeList();

if ($this->user_id) {
  //get phone number
  $user_exdet=$this->common_model->getRow('SELECT mobile,city FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
  $data['phone_number'] = $user_exdet->mobile; 			    
  $data['user_city'] = $user_exdet->city;
  $data['user_type'] = $user_exdet->type;
  //print_r($data['user_city']);   
}


$data['bike'] = $this->myads_model->editBike($id);

$data['city']=$this->config->item('city');
    
$data['assets'] = $this->asset_model->getAssetsMyadsBike('Bike', $id);

$this->load->view("edit_bike",$data);
}

public function updateBike()
{	
  
  $bike_id=$this->input->post('bike_id');    	
  $data['bike'] = $this->myads_model->updateBike($bike_id);	

  $img_state = ($this->session->userdata('user_type') == "Dealer" ? 1 : 2);

  //$this->asset_model->addAsset($bike_id, 'Bike');
  $this->asset_model->addAssetBike($bike_id, 'Bike', "files", $img_state);

$last_link = $this->input->post('last_link'); 

//print_r($last_link);die;			

$_SESSION['sess_alert'] = '<strong>Bike </strong> has been updated successfully!';
    //redirect($last_link . '?err=1');
    redirect(''. base_url() .'myposts/editBike/'. $bike_id .'/?err=1');
    //$this->load->view("post/edit_car",$data);

}


public function deleteBike($id)
{
  $delete = $this->myads_model->deleteBike($id);
  $last_link = $this->input->post('last_link'); 			

$_SESSION['sess_alert'] = '<strong>Bike </strong> has been deleted successfully!';            	
redirect(''. base_url() .'myposts/?err=1');
}

public function removeAssetBike($id, $section_id) {

$this->asset_model->removeAssetBike($id);

redirect(''. base_url() .'myposts/editBike/'. $section_id .'/?err=1');
// redirect('admin/cars/editCar/' . $section_id . '/suc');
}




//Mobile number section

public function mobilenumbers()
	{			
		$ptype=$this->uri->segment(1);
		//echo $ptype;die;
		$limit=200;
		$page = (($this->input->get("page"))?$this->input->get("page"):0);

		$result=$this->myads_model->listMobilenumbers($limit,$page,$this->user_id);
		
		
		if ($result['totalRows']){
			$data['list_mobilenumbers']=$result['search_result'];
		}
		
		$data['pagination']=$this->common_model->all_pagination_links_pg($limit,$page,$result['totalRows'],$ptype,'');

		$data['total_mobilenumbers']=$result['totalRows'];

    $this->load->view("myads_mobilenumbers", $data);	
    
	}



public function addMobilenumber()
	{	
		
		$email=$this->session->userdata('email');
		$date = date('Y-m-d H:i:s');

    $expiry=date('Y-m-d', strtotime("+180 days"));

		$title=$this->input->post('title');
		$title_slug = $this->common_model->create_slug($title);	

        if ($this->session->userdata('user_type')=="Private") {
            $code = "P";
        } else{
            $code = "D";
        }       

		
        $this->form_validation->set_rules('title', 'Title', 'required'); 
        $this->form_validation->set_rules('operator','Operator','required|callback_check_default');
        $this->form_validation->set_rules('operator_code','Operator code','required|callback_check_default');
        $this->form_validation->set_rules('number', 'Number', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required'); 
        $this->form_validation->set_rules('des', 'Plate description', 'required');

        $this->form_validation->set_rules('mobile', 'Mobile number', 'required');
        

        if (($this->form_validation->run() == FALSE)) {            
            $last_link = $this->input->post('last_link') . '?err=1';
            $_SESSION['sess_alert']=validation_errors();
            redirect(''. base_url() .'postad/mobilenumber/?st=1');
            
        } else { 
        $last_link = $this->input->post('last_link');           
                $data=array(
                  'title' => $title,
                  'title_slug' => $title_slug,                			
                  'operator' => $this->input->post('operator'),
                  'operator_code' => $this->input->post('operator_code'),
                  'number' => $this->input->post('number'),                  
                  'price' => $this->input->post('price'),                  
                  'des' => $this->input->post('des'),                  
                  'featured' => $this->input->post('featured'),                 

                  'user_id' => $this->user_id,
                  'code' => $code,                                
                  'city' => $this->input->post('city'),                  
                  'mobile' => $this->input->post('mobile'),
                  'expiry' => $expiry,
                  'ip' => $_SERVER["REMOTE_ADDR"],    
                  'lat' => $this->input->post('lat'),
                  'lng' => $this->input->post('lng'),                 
  
  
                  'created_dt' => $date,              
                  'edited_dt' => $date,
                  'created_by' => $email,
                  'edited_by' => $email,
                  'state' => 1
				);			
      $insert_id = $this->myads_model->insertMobilenumber($data);	
      

      $data['error'] = 'Your Ad has been posted successfully!';
      $this->load->view("edit_mobilenumber", $data);   
            //print_r($_SESSION['sess_alert']);die;
            //redirect($last_link . '?err=1');
               
        }        
        
  }
  
  public function editMobilenumber($id)
    {   
        
    $data['actionType']='update';
    $this->config->load('site_settings');

    if ($this->user_id) {
      //get phone number
      $user_exdet=$this->common_model->getRow('SELECT mobile,city FROM de_users WHERE id = '.$this->user_id.' AND state=1 limit 1');
			$data['phone_number'] = $user_exdet->mobile; 			    
      $data['user_city'] = $user_exdet->city;
			$data['user_type'] = $user_exdet->type;
			//print_r($data['user_city']);   
  	}
    
    $data['operator']=$this->config->item('mobile_operator');
   

    $data['mobile'] = $this->myads_model->editMobilenumber($id);
    $data['city']=$this->config->item('city'); 
    
    $this->load->view("edit_mobilenumber",$data);
    }

    public function updateMobilenumber()
    {	
    	
    	$mobilenumber_id=$this->input->post('mobilenumber_id');    	
    	$data['plate'] = $this->myads_model->updateMobilenumber($mobilenumber_id);	    	

	  	$last_link = $this->input->post('last_link'); 

		

      $_SESSION['sess_alert'] = '<strong>Mobile number </strong> has been updated successfully!';
          
      redirect(''. base_url() .'myposts/editMobilenumber/'. $mobilenumber_id .'/?err=1');
        

  }
  
  public function deleteMobilenumber($id)
	{
    	$delete = $this->myads_model->deleteMobilenumber($id);
    	$last_link = $this->input->post('last_link'); 			

		$_SESSION['sess_alert'] = '<strong>Mobile number </strong> has been deleted successfully!';            	
		redirect(''. base_url() .'myposts/mobilenumbers/?err=1');
  }


  function refreshMyads($flag = "") {

    $id = $this->input->post('ref_id');    

    $refresh_date = date('Y-m-d h:i:s');

    $update_data = array(
        'edited_dt' => $refresh_date,        
        'created_time' => $refresh_date
    );
    if ($id > 0) {
        $this->db->where('id', $id);
        $this->db->update('cars', $update_data);
    }

    redirect('myposts/cars/suc?id=' . $id);
}
  

  


	


}
