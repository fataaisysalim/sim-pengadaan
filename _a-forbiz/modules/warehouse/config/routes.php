<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//----------------- Warehouse ends
$route['warehouse/sub-contractor/save/(:any)'] = "dashboard/actor/save/$1";
$route['warehouse/sub-contractor/save'] = "dashboard/actor/save";
$route['warehouse/sub-contractor/delete/(:any)'] = "dashboard/actor/delete/$1";
$route['warehouse/sub-contractor/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['warehouse/sub-contractor/form/(:any)'] = "dashboard/actor/form/2/$1";
$route['warehouse/sub-contractor/form'] = "dashboard/actor/form/2";
$route['warehouse/sub-contractor/table'] = "dashboard/actor/table/2";
$route['warehouse/sub-contractor'] = "dashboard/actor/index/2";

$route['warehouse/foreman/save/(:any)'] = "dashboard/actor/save/$1";
$route['warehouse/foreman/save'] = "dashboard/actor/save";
$route['warehouse/foreman/delete/(:any)'] = "dashboard/actor/delete/$1";
$route['warehouse/foreman/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['warehouse/foreman/form/(:any)'] = "dashboard/actor/form/3/$1";
$route['warehouse/foreman/form'] = "dashboard/actor/form/3";
$route['warehouse/foreman/table'] = "dashboard/actor/table/3";
$route['warehouse/foreman'] = "dashboard/actor/index/3";

$route['warehouse/supplier/save/(:any)'] = "dashboard/actor/save/$1";
$route['warehouse/supplier/save'] = "dashboard/actor/save";
$route['warehouse/supplier/delete/(:any)'] = "dashboard/actor/delete/$1";
$route['warehouse/supplier/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['warehouse/supplier/form/(:any)'] = "dashboard/actor/form/1/$1";
$route['warehouse/supplier/form'] = "dashboard/actor/form/1";
$route['warehouse/supplier/table'] = "dashboard/actor/table/1";
$route['warehouse/supplier'] = "dashboard/actor/index/1";

$route['warehouse/vendor-foreman/status/(:any)/(:any)'] = "dashboard/actor/status/$1/$2";
$route['warehouse/vendor-foreman/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['warehouse/vendor-foreman/(:any)/(:any)'] = "dashboard/actor/info/1-2-3/$1/$2";
$route['warehouse/vendor-foreman/(:any)'] = "dashboard/actor/info/1-2-3/$1";
$route['warehouse/vendor-foreman'] = "dashboard/actor/info/1-2-3";

$route['warehouse/eq-stock/(:any)/(:any)/(:any)'] = "warehouse/stock/equipment/$1/$2/$3";
$route['warehouse/eq-stock/(:any)/(:any)'] = "warehouse/stock/equipment/$1/$2";
$route['warehouse/eq-stock/(:any)'] = "warehouse/stock/equipment/$1";
$route['warehouse/eq-stock'] = "warehouse/stock/equipment";

$route['warehouse/mt-stock/(:any)/(:any)/(:any)'] = "warehouse/stock/material/$1/$2/$3";
$route['warehouse/mt-stock/(:any)/(:any)'] = "warehouse/stock/material/$1/$2";
$route['warehouse/mt-stock/(:any)'] = "warehouse/stock/material/$1";
$route['warehouse/mt-stock'] = "warehouse/stock/material";

$route['warehouse/eq-information/(:any)/(:any)'] = "warehouse/equipment/info/$1/$2";
$route['warehouse/eq-information/(:any)'] = "warehouse/equipment/info/$1";
$route['warehouse/eq-information'] = "warehouse/equipment/info";

$route['warehouse/mt-information/(:any)/(:any)/(:any)/(:any)'] = "warehouse/material/info/$1/$2/$3/$4";
$route['warehouse/mt-information/(:any)/(:any)/(:any)'] = "warehouse/material/info/$1/$2/$3";
$route['warehouse/mt-information/(:any)/(:any)'] = "warehouse/material/info/$1/$2";
$route['warehouse/mt-information/(:any)'] = "warehouse/material/info/$1";
$route['warehouse/mt-information'] = "warehouse/material/info";

$route['warehouse/eq-monitoring/(:any)/(:any)/(:any)/(:any)'] = "warehouse/monitoring/equipment/$1/$2/$3/$4";
$route['warehouse/eq-monitoring/(:any)/(:any)/(:any)'] = "warehouse/monitoring/equipment/$1/$2/$3";
$route['warehouse/eq-monitoring'] = "warehouse/monitoring/equipment";

$route['warehouse/bapb-bpm-information/(:any)/(:any)/(:any)/(:any)'] = "warehouse/mog/info/$1/$2/$3/$4";
$route['warehouse/bapb-bpm-information'] = "warehouse/mog/info";
$route['warehouse/bapp-bpp-information/(:any)/(:any)/(:any)/(:any)'] = "warehouse/equipment_transaction/info/$1/$2/$3/$4";
$route['warehouse/bapp-bpp-information'] = "warehouse/equipment_transaction/info";

$route['warehouse/e-trans/data-by-project/(:any)/(:any)/(:any)'] = "warehouse/equipment_transaction/equipment_by_project/$1/$2/$3";
$route['warehouse/e-trans/data-stock/(:any)/(:any)/(:any)'] = "warehouse/equipment_transaction/get_stok/$1/$2/$3";
$route['warehouse/e-trans/data-equipment/(:any)/(:any)'] = "warehouse/equipment_transaction/get_equipment/$1/$2";
$route['warehouse/e-trans/data-unit/(:any)'] = "warehouse/equipment_transaction/get_unit/$1";
$route['warehouse/e-trans/delete/(:any)'] = "warehouse/equipment_transaction/delete/$1";

$route['warehouse/bapp/trans/detail/(:any)'] = "warehouse/equipment_transaction/get_transaction_detail/$1";
$route['warehouse/bapp/trans/(:any)'] = "warehouse/equipment_transaction/get_transaction/$1";
$route['warehouse/bapp/detail/(:any)'] = "warehouse/equipment_transaction/detail/$1";
$route['warehouse/bapp/save/(:any)'] = "warehouse/equipment_transaction/save/$1";
$route['warehouse/bapp/save'] = "warehouse/equipment_transaction/save";
$route['warehouse/bapp/form/(:any)'] = "warehouse/equipment_transaction/form/entry/$1";
$route['warehouse/bapp/form'] = "warehouse/equipment_transaction/form/entry";
$route['warehouse/bapp/(:any)'] = "warehouse/equipment_transaction/entry/$1";
$route['warehouse/bapp'] = "warehouse/equipment_transaction/entry";

$route['warehouse/bpp/trans/detail/(:any)/(:any)'] = "warehouse/equipment_transaction/get_detail/$1/$2";
$route['warehouse/bpp/detail/(:any)'] = "warehouse/equipment_transaction/detail/$1";
$route['warehouse/bpp/save/(:any)'] = "warehouse/equipment_transaction/save/$1";
$route['warehouse/bpp/save'] = "warehouse/equipment_transaction/save";
$route['warehouse/bpp/form/(:any)'] = "warehouse/equipment_transaction/form/exit/$1";
$route['warehouse/bpp/form'] = "warehouse/equipment_transaction/form/exit";

$route['warehouse/bpp/(:any)'] = "warehouse/equipment_transaction/out/$1";
$route['warehouse/bpp'] = "warehouse/equipment_transaction/out";
$route['warehouse/get-supplier/(:any)'] = "dashboard/actor/getdata/$1";
$route['warehouse/get_supplier/(:any)'] = "dashboard/actor/getdata_nasabah/$1";
$route['warehouse/get-project/(:any)/(:any)'] = "dashboard/project/getdata/$1/$2";

$route['warehouse/bapb-print/(:any)'] = "warehouse/print/transaction/bapb/$1";
$route['warehouse/bpm-print/(:any)'] = "warehouse/print/transaction/bpm/$1";
$route['warehouse/bapp-print/(:any)'] = "warehouse/print/transaction/bapp/$1";
$route['warehouse/bpp-print/(:any)'] = "warehouse/print/transaction/bpp/$1";

$route['warehouse'] = "warehouse/index";
//----------------- Warehouse starts
