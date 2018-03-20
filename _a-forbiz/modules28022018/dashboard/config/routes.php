<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$route['dashboard/login-page/status/(:any)'] = "dashboard/logpage/status/$1";
$route['dashboard/login-page/save/(:any)'] = "dashboard/logpage/save/$1";
$route['dashboard/login-page/save'] = "dashboard/logpage/save";
$route['dashboard/login-page/delete/(:any)'] = "dashboard/logpage/delete/$1";
$route['dashboard/login-page/detail/(:any)'] = "dashboard/logpage/detail/$1";
$route['dashboard/login-page/form/(:any)'] = "dashboard/logpage/form/$1";
$route['dashboard/login-page/form'] = "dashboard/logpage/form";
$route['dashboard/login-page/table'] = "dashboard/logpage/table";
$route['dashboard/login-page'] = "dashboard/logpage/index";

