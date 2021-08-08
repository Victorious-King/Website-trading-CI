<?php

class LangSwitch extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

   /*

    function switchLanguage($language = "") {
        $language = ($language != "") ? $language : "en";
        
        $pointer = 0;
        if (stristr(base_url(), 'localhost') !== FALSE) {
            $pointer = 1;
        }

        if (stristr(base_url(), 'tes') !== FALSE) {
            $pointer += 1;
        }

        if ($this->uri->segment(1) != 'ar' && $language == 'ar') {
            $site_lang = 'ar';
            $this->config->set_item('base_url', base_url() . $site_lang);
        } else {
            if (stristr(base_url(), '/ar') !== FALSE) {
                $base_url = base_url();
                $base_arr = explode('/', $base_url);
                unset($base_arr[(3+$pointer)]);
                unset($base_arr[(3+$pointer)]);
                $this->config->set_item('base_url', implode('/', $base_arr));
            }
        }

        $ref = explode('/', $_SERVER['HTTP_REFERER']);

        if ($language != 'ar') {            
            if( (($ref[4]=='products') && ($language != 'ar')) || (($ref[4]=='testimonials') && ($language != 'ar')) || (($ref[4]=='career') && ($language != 'ar')) || (($ref[4]=='contact') && ($language != 'ar')) || (($ref[4]=='services') && ($language != 'ar')) ){                
                unset($ref[(6+$pointer)]);               
            }else{
                unset($ref[(3+$pointer)]);
            }
            
        } else {

            if ($ref[(3+$pointer)] != 'ar') {
                $arr1 = array_slice($ref, 0, (3+$pointer));
                $arr2 = array_slice($ref, (3+$pointer), count($ref));
                $ref = array_merge($arr1, array('ar'), $arr2);
            }
            if ($arr2[0] == 'fa') {
                    unset($arr2[0]);
                }
        }
        
        //print_r($ref); die;
      
        $redirect = implode('/', $ref);
        if (stristr($ref[(4+$pointer)], 'find?query') !== FALSE) {
            $redirect = base_url();
        }
        
        //echo $redirect; die;
        header('Location:' . $redirect);
        exit;
        // redirect(base_url());
    }

    */ 

    function switchLanguage($language = "") {
        $language = ($language != "") ? $language : "en";

        $old_url = base_url();

        $pointer = 0;
        if (stristr(base_url(), 'localhost') !== FALSE) {
            $pointer = 1;
        }

        // if (stristr(base_url(), 'autotraderpersia') !== FALSE) {
        //     $pointer += 1;
        // }


        if ($this->uri->segment(1) != 'ar' && $language == 'ar') {
            $site_lang = 'ar';
            $this->config->set_item('base_url', base_url() . $site_lang);
        } else {
            if (stristr(base_url(), '/ar') !== FALSE) {
                $base_url = base_url();
                $base_arr = explode('/', $base_url);
                unset($base_arr[(3 + $pointer)]);
                unset($base_arr[(3 + $pointer)]);
                $this->config->set_item('base_url', implode('/', $base_arr));
            }
        }

        $ref = explode('/', $_SERVER['HTTP_REFERER']);

        if ($language != 'ar') {
            unset($ref[(3 + $pointer)]);
        } else {

            if ($ref[(3 + $pointer)] != 'ar') {
                $arr1 = array_slice($ref, 0, (3 + $pointer));
                $arr2 = array_slice($ref, (3 + $pointer), count($ref));

                if ($arr2[0] == 'cn') {
                    unset($arr2[0]);
                }


                $ref = array_merge($arr1, array('ar'), $arr2);
            }
        }

        //print_r($ref); die;

        $redirect = implode('/', $ref);
        if (stristr($ref[(4 + $pointer)], 'find?query') !== FALSE) {
            $redirect = base_url();
        }



        // echo $redirect; die;

        header('Location:' . $redirect);
        exit;
        // redirect(base_url());
    }

    function switchLanguageCn($language = "") {
        $language = ($language != "") ? $language : "en";

        $pointer = 0;
        if (stristr(base_url(), 'localhost') !== FALSE) {
            $pointer = 1;
        }

        // if (stristr(base_url(), 'autotraderpersia') !== FALSE) {
        //     $pointer += 1;
        // }

        if ($this->uri->segment(1) != 'cn' && $language == 'cn') {
            $site_lang = 'cn';
            $this->config->set_item('base_url', base_url() . $site_lang);
        } else {
            if (stristr(base_url(), '/cn') !== FALSE) {
                $base_url = base_url();
                $base_arr = explode('/', $base_url);
                unset($base_arr[(3 + $pointer)]);
                unset($base_arr[(3 + $pointer)]);
                $this->config->set_item('base_url', implode('/', $base_arr));
            }
        }

        $ref = explode('/', $_SERVER['HTTP_REFERER']);

        if ($language != 'cn') {
            unset($ref[(3 + $pointer)]);
        } else {

            if ($ref[(3 + $pointer)] != 'cn') {
                $arr1 = array_slice($ref, 0, (3 + $pointer));
                $arr2 = array_slice($ref, (3 + $pointer), count($ref));

                if ($arr2[0] == 'ar') {
                    unset($arr2[0]);
                }


                $ref = array_merge($arr1, array('cn'), $arr2);
            }
        }

        //print_r($ref); die;

        $redirect = implode('/', $ref);
        if (stristr($ref[(4 + $pointer)], 'find?query') !== FALSE) {
            $redirect = base_url();
        }

        header('Location:' . $redirect);
        exit;
        // redirect(base_url());
    }


}
