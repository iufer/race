<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

$route['default_controller'] = "site";
$route['404_override'] = '';

$route['(:any).css'] = '$1/css';

$route['admin'] = 'site/site_admin/index';
$route['admin/login'] = 'site/site_admin/login';
$route['admin/logout'] = 'site/site_admin/logout';

// Handles the auto-routing for module admin controllers
$route['admin/([a-z_]+)'] = "$1/$1_admin/index";
$route['admin/([a-z_]+)/(:any)'] = "$1/$1_admin/$2";


$route['rider/(:num)'] = 'rider/view/$1';

$route['race/index'] = "race/index";
$route['race/index/(:any)'] = "race/index/$1";
$route['race/rss'] = "race/rss";
$route['race/calendar'] = "race/calendar";
$route['race/calendar/(:any)'] = "race/calendar/$1";
$route['race/willAttend/(:num)'] = "race/willAttend/$1"; 
$route['race/(:any)'] = 'race/view/$1';

$route['course/kml/(:any)'] = "course/kml/$1";
$route['course/push_kml/(:any)'] = "course/push_kml/$1";
$route['course/(:any)'] = 'course/view/$1';

$route['series/(:any)'] = 'series/view/$1';
