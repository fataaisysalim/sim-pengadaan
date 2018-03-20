<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//----------------- Procurement ends
$route['procurement/bapb-bapp-process/bapp/(:any)/(:any)/(:any)'] = "procurement/entry_by_warehouse/bapp/data/$1/$2/$3";
$route['procurement/bapb-bapp-process/bapp/detail/(:any)'] = "procurement/entry_by_warehouse/bapp/detail/$1";
$route['procurement/bapb-bapp-process/bapb/(:any)/(:any)/(:any)'] = "procurement/entry_by_warehouse/bapb/data/$1/$2/$3";
$route['procurement/bapb-bapp-process/bapb/detail/(:any)'] = "procurement/entry_by_warehouse/bapb/detail/$1";
$route['procurement/bapb-bapp-process'] = "procurement/entry_by_warehouse/index";

$route['procurement/vendor-foreman/status/(:any)/(:any)'] = "dashboard/actor/status/$1/$2";
$route['procurement/vendor-foreman/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['procurement/vendor-foreman/(:any)/(:any)'] = "dashboard/actor/info/1-2-3/$1/$2";
$route['procurement/vendor-foreman/(:any)'] = "dashboard/actor/info/1-2-3/$1";
$route['procurement/vendor-foreman'] = "dashboard/actor/info/1-2-3";

$route['procurement/work-order/detail/(:any)'] = "procurement/work_order/detail/$1";
$route['procurement/work-order/delete/(:any)'] = "procurement/work_order/delete/$1";
$route['procurement/work-order/save/(:any)'] = "procurement/work_order/save/$1";
$route['procurement/work-order/save'] = "procurement/work_order/save";
$route['procurement/work-order/form/(:any)'] = "procurement/work_order/form/$1";
$route['procurement/work-order/form'] = "procurement/work_order/form";
$route['procurement/work-order/project/(:any)/(:any)'] = "dashboard/project/getdata/$1/$2";
$route['procurement/work-order/table/(:any)/(:any)/(:any)'] = "procurement/work_order/table/$1/$2/$3";
$route['procurement/work-order/table'] = "procurement/work_order/table";
$route['procurement/work-order'] = "procurement/work_order/index";

$route['procurement/rescode/saving/(:any)'] = "procurement/code/resource/saving/$1";
$route['procurement/rescode/saving'] = "procurement/code/resource/saving";
$route['procurement/rescode/table'] = "procurement/code/resource/table";
$route['procurement/rescode/form/(:any)'] = "procurement/code/resource/form/$1";
$route['procurement/rescode/form'] = "procurement/code/resource/form";
$route['procurement/rescode'] = "procurement/code/resource";

$route['procurement'] = "procurement/index";
//----------------- Procurement starts