<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('main_model');   

        $this->user_id = $this->session->userdata('user_id');        
    }


public function validateUser() {
    
    $this->load->library('session');
    
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {    
               
            $_SESSION['sess_alert_ve'] = validation_errors();  
            
            redirect(''. base_url() .'login?st=3');  
        }else{              
            $result = $this->main_model->validate();
                 
            if(!$result){
                // If user did not validate, then show them login page again
                $_SESSION['sess_alert_iv'] = "Invalid Login";       
                       
                redirect(''. base_url() .'login?st=4');                   
            }else{
                // If user did validate, 
                // Send them to members area                
                redirect(''. base_url() .'myaccount/dashboard');
            }        
        
        }
}


public function xxxx()
{	
  echo "sdsdsd";
}

public function register() {
         
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
    
    if ($this->form_validation->run() == FALSE)
    {   
        $_SESSION['sess_alert'] = validation_errors();  
          
        redirect(''. base_url() .'login/?st=2#register'); 
    }else{  
        $to = $this->input->post('email');
        $email_exist = $this->common_model->rowsCount('de_users', 'activation=1 and email="' . $to . '"');

        if ($email_exist == 0) {
            //$activation = 1; //md5(uniqid(rand(), true));
            $activation = md5(uniqid(rand(), true));
            $last_id = $this->main_model->createAccount($activation);

            $result = $this->main_model->validate();

            $url = base_url() . 'main/verifyEmail/' . $activation;
            $url_show = base_url() . 'verifyEmail/' . $activation;
            $link = '<a href="' . $url . '">' . $url_show . '</a>'; 

            // Email
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
                                <img src="'. theme_url() .'img/at_logo_new.png" alt="" width="250" height="54" />
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
                          <table cellpadding="0" cellspacing="0" width="700" bgcolor="#FF3E3B">
                            <tr><td height="18"></td></tr>
                            <tr>
                              <td width="700" align="center" style="font-family: Arial;font-size:20px;color:#ffffff;">
                                  Thank You for Joining Us! 
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
                                      <p style="font-family: Arial;font-size:15px;line-height:24px;">Congratulations on successful registration with autotraders.ae

                                      </p>    
                                      <p style="font-family: Arial;font-size:15px;line-height:24px;">Please verify your email address by clicking this link

                                      </p>  
                                      </p>    
                                      <p style="font-family: Arial;font-size:15px;line-height:24px;">'. $link .'

                                      </p>   
                                                     
                                      <p style="font-family: Arial;font-size:15px;line-height:10px;">
                                      Thanks,
                                      </p> 
                                      <p style="font-family: Arial;font-size:15px;line-height:5px;">
                                      Team autotraders.ae
                                      </p>                                              

                                      
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
                              <tr><td height="4" bgcolor="#FF3E3B"></td></tr>
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
                                            <a href="'. base_url() .'contact" target="_blank" style="font-family: Arial;background-color:#FF3E3B;border:1px solid #FF3E3B;border-radius:0px;color:#ffffff;display:inline-block;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;">Customer Support &rarr;</a>
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
                                   &#x00A9; 2019 autotraders. All rights reserved.
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

                    $title="Activation link from Autotraders";
                    $this->load->library('email');
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $config['charset'] = 'UTF-8';

                    $this->email->initialize($config);

                    
                    $this->email->from('noreply@autotraders.ae', 'AutoTraders');
                    $this->email->to($to);  
                    $this->email->subject($title);
                    $this->email->message($message);
                    
                    $this->email->send();  
                    //echo $message;die;

            redirect(''. base_url() .'myaccount/dashboard');
        }else{
          $_SESSION['sess_alert'] = "Email already exist";   
            redirect(''. base_url() .'login/?st=2#register');
        }
    
    }
}

public function forgotPassword() {
    
    $email = $this->input->post('email');

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    
        
        if ($this->form_validation->run() == FALSE)
        {            
            $_SESSION['sess_alert'] = validation_errors();  
            redirect(''. base_url() .'login/forgotPassword/?st=1'); 
              
        }else{   
            $qr = 'SELECT id,pname,email FROM de_users WHERE email="' . $email . '" LIMIT 1';
            $rs = $this->db->query($qr);
                 
             if ($rs->num_rows() == 1) {

                $row = $rs->row();

                $reset_key = substr(sha1(rand()), 0, 30); 
                $user_reset_key = $this->main_model->updateResetkey($row->id,$reset_key); 

                
                
                
                $url = base_url() . 'main/resetPassword/' . $reset_key;
                $link = '<a href="' . $url . '">' . $url . '</a>'; 
                
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
                                        <img src="'. theme_url() .'img/at_logo_new.png" alt="" width="250" height="54" />
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
                                  <table cellpadding="0" cellspacing="0" width="700" bgcolor="#ea383e">
                                    <tr><td height="18"></td></tr>
                                    <tr>
                                      <td width="700" align="center" style="font-family: Arial;font-size:20px;color:#ffffff;">
                                          Password reset request
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
                                              <p style="font-family: Arial;font-size:15px;line-height:24px;">A request has been submitted to recover a lost password from autotraders.ae account.</p>                        
                                              <p style="font-family: Arial;font-size:15px;line-height:24px;">
                                                Please go to the following link and choose a new password:
                                              </p>                                             

                                              <p style="font-family: Arial;font-size:15px;line-height:24px;">'.$link.'</p>
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
                                           &#x00A9; 2019 autotraders. All rights reserved.
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
                    $title="Your Password Reset Request";
                    $this->load->library('email');
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $config['charset'] = 'UTF-8';

                    $this->email->initialize($config);

                    
                    $this->email->from('noreply@autotraders.ae', 'AutoTraders');
                    $this->email->to($email);  
                    $this->email->subject($title);
                    $this->email->message($message);
                    
                    $this->email->send();  
                    //echo $message;die;
                    
                    $_SESSION['sess_alert']="We have e-mailed you a link to reset your password." ;    
                    redirect(''. base_url() .'success/?st=1');  
            }else{                            
                $_SESSION['sess_alert']="Oops, that's not a match. Try again?" ;    
                redirect(''. base_url() .'login/forgotPassword/?st=1');                        
            }        
        
        }
}

public function resetPassword()
{   
    
    
    $reset_key = $this->uri->segment(3);

    
    $qr = 'SELECT id FROM de_users WHERE reset_password_key="' . $reset_key . '" LIMIT 1';
    $rs = $this->db->query($qr);
                 
    if ($rs->num_rows() == 1) {        
        $this->load->view('reset_password', $data);
    }else{
        $_SESSION['sess_alert']="Sorry the password link you are using has either expired or is incorrect." ;  
        redirect(''. base_url() .'success/?st=1');         
    }
     
}

public function resetPasswordVal()
{   
   
    $reset_key = $this->input->post('reset_key');
    
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

    if ($this->form_validation->run() == FALSE)
    {             
        $_SESSION['sess_alert']=validation_errors();   
        //print_r($_SESSION['sess_alert']);
        redirect(''. base_url() .'main/resetPassword/' . $reset_key . '/?st=1');
    }else{
      
        $qr = 'SELECT id FROM de_users WHERE reset_password_key="' . $reset_key . '" LIMIT 1';
        
        $rs = $this->db->query($qr);
                 
        if ($rs->num_rows() == 1) {    
          
            $last_id = $this->main_model->updateNewPassword();
            //$_SESSION['sess_alert']='New password has been updated successfully. Please'.<a href=''>.'click here'.</a>.'to login' ;  
            $_SESSION['sess_alert']="Thank you, your password has now been changed successfully!<a href='". base_url() .'login' ."'>&nbsp; click here</a> to login" ;  
            redirect(''. base_url() .'success/?st=1');
        }else{          
            $_SESSION['sess_alert']="Sorry the password link you are using has either expired or is incorrect." ;  
            redirect(''. base_url() .'success/?st=1');
        }   
        
        //redirect(''. base_url() .'login/forgotPassword/?st=1');
        //We've e-mailed you a link to reset your password.
    }
}

public function verifyEmail()
{   
    
    
    $activation = $this->uri->segment(3);
    //echo $reset_key; die;

    
    $qr = 'SELECT id FROM de_users WHERE `activation`="' . $activation . '" LIMIT 1';
    $rs = $this->db->query($qr);

    $result = $rs->row_array();
    
    $dealer_id=$result['id'];

    
                 
    if ($rs->num_rows() == 1) {  
      $this->main_model->activeEmail($activation);      
      $_SESSION['sess_alert']="Your Email has been verified successfully !!" ;  
      redirect(''. base_url() .'success/?st=1');  
    }else{
        $_SESSION['sess_alert']="Sorry the activation link you are using has either expired or is incorrect." ;  
        redirect(''. base_url() .'success/?st=1');         
    }
     
}

public function logOut()
{
        $this->load->helper('cookie');
        $userData = array(
                    'user_id' => '',
                    'pname' => '',                    
                    'email' => '',
                    'validated' => false
        );
        $this->session->set_userdata($userData);
        $this->session->sess_destroy();
        delete_cookie('ci_session');
        redirect(''. base_url() .'');  
}


    
public function getCityList($cn) {
        $country = str_replace('_', " ", $cn);
        $country = str_replace('-', " ", $cn);
        $city = $this->common_model->getRows('SELECT city,city_ar from country_city where country="' . $country . '" AND state=1');
       

        $body = ' <option value="">Select country first</option>';
        foreach ($city as $ct) {
            $body.='<option value="' . $ct['city'] . '">' . $ct['city'] . '</option>';
        }
        echo $body;
        die;
}

// public function getModelList($id,$car_model) { 
  
//   //echo $car_model;
//         $model = $this->common_model->getRows('SELECT id,model,model_ar from model where make_id="' . $id . '" AND state=1');
        
//         // if($this->uri->segment(1)=='ar'){
//         //   $get_model = $this->uri->segment(3);
//         // }else{
//         //   $get_model = $this->uri->segment(2);
          
//         // }
       
//         $body = ' <option value="">Select make first</option>';
//         foreach ($model as $md) {
//             $body.='<option '.($car_model==$md['model']?'selected':'').' value="' . $md['id'] . '" id="' . $md['model'] . '">' . ($this->uri->segment(1)=='ar'?$md['model_ar']:$md['model']) . '</option>';
//         }
//         echo $body;
//         die;
// }

public function getModelList($id) {        
  $model = $this->common_model->getRows('SELECT id,model,model_ar,model_cn from model where make_id="' . $id . '" AND state=1 order by model');
  
  
 

  $body = ' <option value="">Select model</option>';
  foreach ($model as $md) {
      $body.='<option value="' . $md['id'] . '" id="' . $md['model'] . '">' . ($this->uri->segment(1)=='ar'?$md['model_ar']:($this->uri->segment(1)=='cn'?$md['model_cn']:$md['model'])) . '</option>';
  }
  echo $body;
  die;
}

public function getCityCode($id) {        
  $city = $this->common_model->getRows('SELECT id,code from plate_citycode where city_id="' . $id . '" AND state=1');

  $body = ' <option value="">Select city first</option>';
  foreach ($city as $ct) {
      $body.='<option value="' . $ct['id'] . '" >' . $ct['code'] . '</option>';
  }
  echo $body;
  die;
}

public function updatePassword() {


          
    
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
    
        
        if ($this->form_validation->run() == FALSE)
        {   
            $_SESSION['sess_alert']=validation_errors();
            redirect(''. base_url() .'myaccount/settings/?st=2');
        }else{  
            $result = $this->main_model->updateSettings($this->user_id);
            $_SESSION['sess_alert']='Password has been updated successfully!';                         
            redirect(''. base_url() .'myaccount/settings/?st=1');
        }
}


public function updateAccount() {
          
    
    $this->form_validation->set_rules('mobile', 'Mobile', 'required');    
    
        
        if ($this->form_validation->run() == FALSE)
        {             
            $_SESSION['sess_alert']=validation_errors();
            redirect(''. base_url() .'myaccount/settings/?st=2');
        }else{       
            $result = $this->main_model->updatePersonalDetails($this->user_id);
            $_SESSION['sess_alert']='Personal details has been updated successfully!';                         
            redirect(''. base_url() .'myaccount/settings/?st=1');
        }
}


public function emailCar() {

 
        
        // $is_robot = $this->input->post('text_verification');
        // if ($is_robot != '') {
        //     redirect('/');
        //     exit;
        // }

        $url = $this->input->post('last_link');
        $url_spl = explode('/', $url);

        $last_link = $this->input->post('last_link');
        $ad_link = $this->input->post('last_link');

        // print_r($url_spl);
        // echo $url_spl[3];
        // echo $url_spl[4];
        // echo $url_spl[5];
        // die;
        
       
        
        $date = date('Y-m-d H:i:s');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('contact', 'Mobile', 'required');        
        $this->form_validation->set_rules('message', 'Message', 'required');


        



        if (($this->form_validation->run() == FALSE)) {            
          $_SESSION['sess_alert']=validation_errors();
          // print_r($_SESSION['sess_alert']);die;
  
          redirect($last_link . '?succ=2');
        } else {     

          
         
                $last_link = $this->input->post('last_link').'?succ=1';  

                $get_user_email = $this->common_model->getRow('select id,email from de_users where id=' . $this->input->post('user_id') . ' ');
                $email_user = $get_user_email->email;
                //print_r($email_user);die;
                $name = $this->input->post('name');
                $contact = $this->input->post('contact');
                $email = $this->input->post('email');                
                $message = $this->input->post('message');

                $data=array(                    
                    'name'=> $name,
                    'contact'=> $contact,
                    'email' => $email,                
                    'message'=> $message,
                    'date'=> $date
                );      
                
                //print_r($data);die;

                $subject = 'Hi! I am interested in the car that you have posted on autotraders.ae';
                $this->load->library('email');
                $this->email->from($email, $name);
                $this->email->reply_to($email);
                $this->email->to($email_user);
                $this->email->from($email);
                $this->email->cc('mutea@hotmail.com');
                $this->email->bcc('mohamednm777@gmail.com');
                $this->email->subject($subject);
                $this->email->message(
                        "Name: $name\r\n Email: $email\r\n Mobile number: $contact\r\n Message: $message\r\n Your ad link: $ad_link\r\n Thanks!!"
                );
                $this->email->send();                
                //echo $this->email->print_debugger();die;
                $_SESSION['sess_alert']='Message has been sent successfully';
                // if ($this->uri->segment(1)=='ar') {
                //   $redirect_url=redirect(''. base_url() .'cardetails/'.$url_spl[4].'/'.$url_spl[5].'/'.$url_spl[6].'/?succ=1');
                  
                // }else{
                //   $redirect_url=redirect(''. base_url() .'cardetails/'.$url_spl[3].'/'.$url_spl[4].'/'.$url_spl[5].'/?succ=1');
                  
                // }
                redirect($last_link . '?succ=1');
        }
    
       
} 


public function emailOffer() { 

        $is_robot = $this->input->post('text_verification');
        if ($is_robot != '') {
            redirect('/');
            exit;
        }
               
        $url = $this->input->post('last_link');
        $url_spl = explode('/', $url);

        // print_r($url_spl);
        // echo $url_spl[4];
        // echo $url_spl[5];
        // die;

       
        
        $date = date('Y-m-d H:i:s');

        $this->form_validation->set_rules('offer_price', 'Offer price', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');        
        
        

        if (($this->form_validation->run() == FALSE)) {                  
            $_SESSION['sess_alert']=validation_errors();
            if ($this->uri->segment(1)=='ar') {
              $redirect_url=redirect(''. base_url() .'cars-for-sale/cardetails/'.$url_spl[4].'/'.$url_spl[5].'/'.$url_spl[6].'/?st=1');
            }else{
              $redirect_url=redirect(''. base_url() .'cars-for-sale/cardetails/'.$url_spl[3].'/'.$url_spl[4].'/'.$url_spl[5].'/?st=1');
            }
        } else {                      
                $last_link = $this->input->post('last_link').'?st=1';  

                $get_user_email = $this->common_model->getRow('select id,email from de_users where id=' . $this->input->post('user_id') . ' ');
                $email = $get_user_email->email;
                //print_r($email);die;   
                $offer_price = $this->input->post('offer_price');             
                $mobile = $this->input->post('mobile');
                $email = $this->input->post('email');                
                

                $data=array(                    
                    'offer_price'=> $offer_price,
                    'mobile'=> $mobile,
                    'email' => $email,
                    'date'=> $date
                );                

                $subject = 'Hi! I am interested in the car that you have posted on autotraders.ae.';
                $this->load->library('email');
                $this->email->from($email, $name);
                $this->email->reply_to($email);
                $this->email->to($email);
                $this->email->from($email);
                $this->email->cc('mutea@hotmail.com');
                $this->email->subject($subject);
                $this->email->message(
                        "Offer price: $offer_price\r\n Email: $email\r\n Mobile number: $mobile\r\n Your ad link: $last_link\r\n Thanks!!"
                );
                $this->email->send();                
                //echo $this->email->print_debugger();die;
                $_SESSION['sess_alert']='Message has been sent successfully';
                if ($this->uri->segment(1)=='ar') {
                  $redirect_url=redirect(''. base_url() .'cars-for-sale/cardetails/'.$url_spl[4].'/'.$url_spl[5].'/'.$url_spl[6].'/?st=1');
                }else{
                  $redirect_url=redirect(''. base_url() .'cars-for-sale/cardetails/'.$url_spl[3].'/'.$url_spl[4].'/'.$url_spl[5].'/?st=1');
                }
        }
    
       
}

public function enqEmail() {
      
        
        $date = date('Y-m-d H:i:s');


        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('contact', 'Contact', 'required');        
        $this->form_validation->set_rules('message', 'Message', 'required');

            if (($this->form_validation->run() == FALSE)) {            
            $_SESSION['sess_alert']=validation_errors();
            //print_r($_SESSION['sess_alert']);die;
            redirect(''. base_url() .'contact/?st=1');
            } else {            
                $last_link = $this->input->post('last_link').'?st=1';                  
                $name = $this->input->post('name');
                $contact = $this->input->post('contact');
                $email = $this->input->post('email');                
                $message = $this->input->post('message');

                $data=array(                    
                    'name'=> $name,
                    'contact'=> $contact,
                    'email' => $email,                
                    'message'=> $message,
                    'date'=> $date
                );                

                $subject = 'Enquiry from autotraders.ae.';
                $this->load->library('email');
                $this->email->from($email, $name);
                $this->email->reply_to($email);
                $this->email->to('mutea@hotmail.com');
                $this->email->from($email);
                $this->email->cc('mohamednm777@gmail.com');
                $this->email->subject($subject);
                $this->email->message(
                        "Name: $name\r\n Email: $email\r\n Mobile number: $contact\r\n Message: $message\r\n Thanks!!"
                );
                $this->email->send();                
                //echo $this->email->print_debugger();die;
                $_SESSION['sess_alert']='Message has been sent successfully';
                redirect(''. base_url() .'contact/?st=1');
            }
     


        
    
       
}



public function base64url_encode($data) { 
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

public function base64url_decode($data) { 
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
}


public function getOperatorCodes($code) {

 //echo $code; echo "--sd"; die;
  

  //print_r($this->input->get('op_code'));echo "ss";die;
  $op=$this->input->get('op_code');
  //$code=$code[0];

  echo $op;

  
 
  $this->config->load('site_settings');

  if ($code=='Du'||$code=='055'||$code=='052'||$code=='058') {
      $operator_code=$this->config->item('operator_code_du');
  }else if($code=='Etisalat'||$code=='050'||$code=='054'||$code=='056'){
      $operator_code=$this->config->item('operator_code_etisalat');
  }else{
    $operator_code=$this->config->item('operator_code_virgin');
  }        
  
  $body=' <option value="">Select operator</option>';
  foreach ($operator_code as $key=>$code)
      {
          $body.='<option value="'.$code.'" '.($code == $op ? 'selected' : '').'>'.$code.'</option>';
      }
  echo $body;
}


    



    


}
                            
                                