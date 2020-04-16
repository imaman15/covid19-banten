<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'home';
$route['404_override'] = 'error_page';
$route['translate_uri_dashes'] = FALSE;

//$route['daftar/(:any)'] = 'volunteer/auth/$1';
$route[M_REGISTER] = 'volunteer/auth/register';
$route[M_ADMIN . '/login'] = 'volunteer/auth/login';
$route[M_ADMIN . '/logout'] = 'volunteer/auth/logout';
$route[M_ADMIN] = 'volunteer/dashboard';
$route[M_USERS] = 'volunteer/users';
$route[M_PROFILE] = 'volunteer/users/editprofile';
$route[M_PASSWORD] = 'volunteer/users/changepassword';
$route[M_DISTRICT] = 'volunteer/district';
$route[M_SUBDISTRICT] = 'volunteer/subdistrict';
$route[M_COVID] = 'volunteer/covid';
$route[M_COVID . '/(:any)'] = 'volunteer/covid/$1';
$route[M_COVID_ADD] = 'volunteer/covid/add';
$route[M_COVID_EDIT . '/(:any)'] = 'volunteer/covid/edit/';
$route[M_CONFIG] = 'volunteer/configuration';
$route[M_NEWS] = 'volunteer/news';
$route[M_NEWS_ADD] = 'volunteer/news/add';

// Frontend
$route[U_NEWS] = 'news';
$route[U_NEWS . '/(:any)'] = 'news/$1';
$route[U_TEAM] = 'team';
