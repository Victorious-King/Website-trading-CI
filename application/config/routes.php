<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "home";
$route['404_override'] = '';



//for parts
$route['used-cars(.*)'] = "cars";
$route['(en|ar|cn)/used-cars(.*)'] = 'cars';


$route['(.*)terms-and-conditions'] = "terms";

$route['sitemap'] = 'sitemap';
$route['login'] = 'login';
//$route['postad'] = 'postad';
$route['myposts'] = 'myposts';
$route['myads'] = 'myads';
$route['contact'] = 'contact';
//$route['cars'] = 'cars';
$route['success'] = 'success';
$route['admin/login'] = 'admin/login';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/cars'] = 'admin/cars';
$route['numberplates'] = 'numberplates';

$route['boats'] = 'boats';
$route['bikes'] = 'bikes';
$route['mobilenumbers'] = 'mobilenumbers';
$route['about'] = 'about';
$route['dealers'] = 'dealers';
$route['checkout/(:num)'] = 'checkout';
$route['checkout/(:num)/(:any)'] = 'checkout';

$route['user_authentication'] = 'user_authentication';




$route['^(cn|ar)/(.+)$'] = "$2";
$route['^(cn|ar)$'] = $route['default_controller'];

$route['(:any)'] = 'dealer/cars/$1';
$route['plates/(:any)'] = 'dealer/plates/$1';
$route['boat/(:any)'] = 'dealer/boat/$1';




