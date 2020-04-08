<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

///// ROUTING RESITER USERS APP ////
$route['sites-app/dashboard/register.aspx']	= "sites/systems/requirements/eregistrasi";
$route['sites-app/dashboard/access-users.aspx']	= "sites/systems/requirements/usersaccess";
$route['sites-app/dashboard/access-locations.aspx']	= "sites/systems/requirements/locations";
$route['sites-app/dashboard.aspx']	= "sites/systems/requirements/Dashboard";
$route['sites-app/dashboard/users-info.aspx'] = "sites/systems/requirements/informasi";
