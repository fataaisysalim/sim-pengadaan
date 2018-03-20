<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//----------------- Secretariat ends
$route['secretariat/relation/save/(:any)'] = "dashboard/actor/save/$1";
$route['secretariat/relation/save'] = "dashboard/actor/save";
$route['secretariat/relation/delete/(:any)'] = "dashboard/actor/delete/$1";
$route['secretariat/relation/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['secretariat/relation/form/(:any)'] = "dashboard/actor/form/4/$1";
$route['secretariat/relation/form'] = "dashboard/actor/form/4";
$route['secretariat/relation/table'] = "dashboard/actor/table/4";
$route['secretariat/relation'] = "dashboard/actor/index/4";


$route['secretariat/relation-info/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['secretariat/relation-info/(:any)/(:any)'] = "dashboard/actor/info/4/$1/$2";
$route['secretariat/relation-info/(:any)'] = "dashboard/actor/info/4/$1";
$route['secretariat/relation-info/status/(:any)/(:any)'] = "dashboard/actor/status/$1/$2";
$route['secretariat/relation-info'] = "dashboard/actor/info/4";
$route['secretariat/get-project/(:any)/(:any)'] = "dashboard/project/getdata/$1/$2";
$route['secretariat/doc-control/receipt/(:any)'] = "secretariat/doc_control/receipt/$1";
$route['secretariat/doc-control/disposition/(:any)'] = "secretariat/doc_control/disposition/$1";
$route['secretariat/doc-control/download/(:any)'] = "secretariat/doc_control/download/$1";
$route['secretariat/doc-control/delete/(:any)'] = "secretariat/doc_control/delete/$1";
$route['secretariat/doc-control/save/(:any)'] = "secretariat/doc_control/save/$1";
$route['secretariat/doc-control/save'] = "secretariat/doc_control/save";
$route['secretariat/doc-control/form/(:any)'] = "secretariat/doc_control/form/$1";
$route['secretariat/doc-control/form'] = "secretariat/doc_control/form";
$route['secretariat/doc-control/(:any)'] = "secretariat/doc_control/index/$1";
$route['secretariat/doc-control'] = "secretariat/doc_control/index";

$route['secretariat/doc-code/data/(:any)'] = "secretariat/doc_code/data/$1";
$route['secretariat/doc-code/delete/(:any)'] = "secretariat/doc_code/delete/$1";
$route['secretariat/doc-code/save/(:any)'] = "secretariat/doc_code/save/$1";
$route['secretariat/doc-code/save'] = "secretariat/doc_code/save";
$route['secretariat/doc-code/form/(:any)'] = "secretariat/doc_code/form/$1";
$route['secretariat/doc-code/form'] = "secretariat/doc_code/form";
$route['secretariat/doc-code/table'] = "secretariat/doc_code/table";
$route['secretariat/doc-code/(:any)'] = "secretariat/doc_code/index/$1";
$route['secretariat/doc-code'] = "secretariat/doc_code/index";

$route['secretariat'] = "secretariat/index";
//----------------- Secretariat starts