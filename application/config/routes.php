<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'public/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;




//login
$route['backend/login'] = 'backend/login';


//login
$route['login'] = 'public/login';
//public
$route['home_maps'] = 'public/home_maps';

$route['home'] = 'public/home';

$route['maps'] = 'public/maps';

$route['google_maps'] = 'public/maps/google_maps';

$route['maps/(:any)/(:any)/(:any)'] = 'public/maps/lokasi_tujuan/$1/$2/$3';

$route['maps/(:any)/(:any)/(:any)/(:any)'] = 'public/maps/jarak_tempuh/$1/$2/$3/$4';

$route['profile'] = 'public/profile';

$route['service'] = 'public/service';
// $route['service/detail/(:num)'] = 'public/service/detail/$1';

$route['service/detail/(:num)/(:num)'] = 'public/service/detail/$1/$2';

$route['update'] = 'public/update_km';

$route['tentang'] = 'public/tentang';

$route['notifikasi'] = 'public/notifikasi';

$route['notifikasi/detail/(:num)'] = 'public/notifikasi/detail/$1';

$route['history'] = 'public/history';

$route['history/detail/(:num)'] = 'public/history/detail/$1';


$route['jadwal_service'] = 'public/jadwal_service';

$route['jadwal_service/detail/(:num)'] = 'public/jadwal_service/detail/$1';
