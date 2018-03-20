<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//----------------- Finance ends
$route['finance/invoice/data-termin/(:any)'] = "finance/transaction/invoice/show_detail_termin/$1";
$route['finance/invoice/data-termin'] = "finance/transaction/invoice/show_detail_termin";

$route['finance/invoice/data-equipment/(:any)/(:any)/(:any)/(:any)'] = "finance/transaction/invoice/get_select_equipment/$1/$2/$3/$4/$5";
$route['finance/invoice/data-equipment/(:any)/(:any)/(:any)'] = "finance/transaction/invoice/get_select_equipment/$1/$2/$3/$4";
$route['finance/invoice/transaction-detail/(:any)/(:any)/(:any)'] = "finance/transaction/invoice/get_transaction_detail/$1/$2/$3";
$route['finance/invoice/inv-history/(:any)/(:any)'] = "finance/transaction/invoice/get_invoice_history/$1/$2";
$route['finance/invoice/inv-history/(:any)'] = "finance/transaction/invoice/get_invoice_history/$1";
$route['finance/invoice/wo-data/(:any)'] = "finance/transaction/invoice/get_work_order/$1";
$route['finance/invoice/wo-data'] = "finance/transaction/invoice/get_work_order";
$route['finance/invoice/get-tax/(:any)/(:any)/(:any)'] = "finance/transaction/invoice/get_select_tax/$1/$2/$3";
$route['finance/invoice/get-tax/(:any)/(:any)'] = "finance/transaction/invoice/get_select_tax/$1/$2";
$route['finance/invoice/detail-data-display/(:any)/(:any)/(:any)'] = "finance/transaction/invoice/get_select_transaction/$1/$2/$3";
$route['finance/invoice/data-display/(:any)/(:any)/(:any)/(:any)/(:any)'] = "finance/transaction/invoice/get_select_transaction/$1/$2/$3/$4/$5";
$route['finance/invoice/data-display/(:any)/(:any)/(:any)/(:any)'] = "finance/transaction/invoice/get_select_transaction/$1/$2/$3/$4";
$route['finance/invoice/count/(:any)'] = "finance/transaction/invoice/show_row_count/$1";
$route['finance/invoice/bapb/detail/(:any)'] = "warehouse/transaction/material/get_invoice_detail/$1";
$route['finance/invoice/bapb/(:any)'] = "warehouse/transaction/material/get_invoice/$1";
$route['finance/invoice/data-include/(:any)/(:any)/(:any)/(:any)'] = "finance/transaction/invoice/show_row_detail/$1/$2/$3/$4";
$route['finance/invoice/data-include/(:any)/(:any)/(:any)'] = "finance/transaction/invoice/show_row_detail/$1/$2/$3";
$route['finance/invoice/vendor-data/(:any)'] = "dashboard/actor/getdata/$1";
$route['finance/invoice/vendor/(:any)/(:any)'] = "finance/transaction/invoice/get_select_actor/$1/$2";
$route['finance/invoice/vendor/(:any)'] = "finance/transaction/invoice/get_select_actor/$1";
$route['finance/invoice/project/(:any)'] = "dashboard/project/getdata/$1/1/invoice";
$route['finance/invoice/save/data/(:any)'] = "finance/transaction/invoice/save/$1";
$route['finance/invoice/save/data'] = "finance/transaction/invoice/save";
$route['finance/invoice/save/subcon/(:any)'] = "finance/transaction/invoice/save_subkon/$1";
$route['finance/invoice/save/subcon'] = "finance/transaction/invoice/save_subkon";
$route['finance/invoice/form/(:any)'] = "finance/transaction/invoice/form/$1";
$route['finance/invoice/form'] = "finance/transaction/invoice/form";
$route['finance/invoice'] = "finance/transaction/invoice";
$route['finance/invoice/(:any)'] = "finance/transaction/invoice/index/$1";

$route['finance/payment/payment-inv/(:any)'] = "finance/transaction/payment/update_payment_status/$1";
$route['finance/payment/payment-inv'] = "finance/transaction/payment/update_payment_status";
$route['finance/payment/get-invoice/(:any)'] = "finance/transaction/payment/get_select_invoice/$1";
$route['finance/payment/invoice/(:any)'] = "finance/transaction/payment/get_invoice_payment/$1";
$route['finance/payment/form/(:any)'] = "finance/transaction/payment/form/$1";
$route['finance/payment/form'] = "finance/transaction/payment/form";
$route['finance/payment/(:any)'] = "finance/transaction/payment/index/$1";
$route['finance/payment'] = "finance/transaction/payment";

$route['finance/fee-transaction/delete/(:any)'] = "finance/transaction/salary/delete/$1";
$route['finance/fee-transaction/save/(:any)'] = "finance/transaction/salary/save/$1";
$route['finance/fee-transaction/save'] = "finance/transaction/salary/save";
$route['finance/fee-transaction/get-tax/(:any)'] = "finance/transaction/salary/get_select_tax/$1";
$route['finance/fee-transaction/form/(:any)'] = "finance/transaction/salary/form/$1";
$route['finance/fee-transaction/form'] = "finance/transaction/salary/form";
$route['finance/fee-transaction'] = "finance/transaction/salary";
$route['finance/fee-transaction/(:any)'] = "finance/transaction/salary/index/$1";

$route['finance/inv-information/detail/(:any)'] = "finance/info/invoice/detail/$1";

$route['finance/inv-information/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "finance/info/invoice/info/$1/$2/$3/$4/$5/$6";
$route['finance/inv-information/(:any)/(:any)/(:any)/(:any)/(:any)'] = "finance/info/invoice/info/$1/$2/$3/$4/$5";
$route['finance/inv-information/(:any)/(:any)/(:any)/(:any)'] = "finance/info/invoice/info/$1/$2/$3/$4";
$route['finance/inv-information/(:any)/(:any)/(:any)'] = "finance/info/invoice/info/$1/$2/$3";
$route['finance/inv-information/(:any)/(:any)'] = "finance/info/invoice/info/$1/$2";
$route['finance/inv-information/(:any)'] = "finance/info/invoice/info/$1";
$route['finance/inv-information'] = "finance/info/invoice/info";



$route['finance/foreman-fee/detail/(:any)'] = "finance/info/salary/detail/$1";
$route['finance/foreman-fee/(:any)/(:any)/(:any)/(:any)'] = "finance/info/salary/info/$1/$2/$3/$4";
$route['finance/foreman-fee/(:any)/(:any)/(:any)'] = "finance/info/salary/info/$1/$2/$3";
$route['finance/foreman-fee/(:any)/(:any)'] = "finance/info/salary/info/$1/$2";
$route['finance/foreman-fee/(:any)'] = "finance/info/salary/info/$1";
$route['finance/foreman-fee'] = "finance/info/salary/info";

$route['finance/eq-monitoring/(:any)/(:any)'] = "finance/monitoring/equipment/index/$1/$2";
$route['finance/eq-monitoring/(:any)'] = "finance/monitoring/equipment/index/$1";
$route['finance/eq-monitoring'] = "finance/monitoring/equipment/index";

$route['finance/wo-progress/extra/(:any)'] = "procurement/work_order/extra/$1";
$route['finance/wo-progress/(:any)'] = "procurement/work_order/info/$1";
$route['finance/wo-progress/extra-save/(:any)'] = "procurement/work_order/save/$1";
$route['finance/wo-progress'] = "procurement/work_order/info";

$route['finance/vendor-foreman/status/(:any)/(:any)'] = "dashboard/actor/status/$1/$2";
$route['finance/vendor-foreman/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['finance/vendor-foreman/(:any)/(:any)'] = "dashboard/actor/info/1-2-3/$1/$2";
$route['finance/vendor-foreman/(:any)'] = "dashboard/actor/info/1-2-3/$1";
$route['finance/vendor-foreman'] = "dashboard/actor/info/1-2-3";

$route['finance/report/invoice/mode/outstanding'] = "finance/report/invoice/index/0";
$route['finance/report/invoice/mode/paid'] = "finance/report/invoice/index/1";
$route['finance/report/salary/monitoring'] = "finance/report/salary/index/monitoring";
$route['finance/report/salary/pph21'] = "finance/report/salary/index/pph21";

$route['finance/tax-report-vat'] = "finance/report/invoice_tax/index/ppn";
$route['finance/tax-report-pph21'] = "finance/report/invoice_tax/index/pph21";
$route['finance/tax-report-pph22'] = "finance/report/invoice_tax/index/pph22";
$route['finance/tax-report-pph23'] = "finance/report/invoice_tax/index/pph23";
$route['finance/report/invoice/progress'] = "finance/report/invoice_progress/index";

$route['finance/supplier/save/(:any)'] = "dashboard/actor/save/$1";
$route['finance/supplier/save'] = "dashboard/actor/save";
$route['finance/supplier/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['finance/supplier/delete/(:any)'] = "dashboard/actor/delete/$1";
$route['finance/supplier/form/(:any)'] = "dashboard/actor/form/1/$1";
$route['finance/supplier/form'] = "dashboard/actor/form/1";
$route['finance/supplier/table'] = "dashboard/actor/table/1";
$route['finance/supplier'] = "dashboard/actor/index/1";

$route['finance/sub-contractor/save/(:any)'] = "dashboard/actor/save/$1";
$route['finance/sub-contractor/save'] = "dashboard/actor/save";
$route['finance/sub-contractor/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['finance/sub-contractor/delete/(:any)'] = "dashboard/actor/delete/$1";
$route['finance/sub-contractor/form/(:any)'] = "dashboard/actor/form/2/$1";
$route['finance/sub-contractor/form'] = "dashboard/actor/form/2";
$route['finance/sub-contractor/table'] = "dashboard/actor/table/2";
$route['finance/sub-contractor'] = "dashboard/actor/index/2";

$route['finance/foreman/save/(:any)'] = "dashboard/actor/save/$1";
$route['finance/foreman/save'] = "dashboard/actor/save";
$route['finance/foreman/detail/(:any)'] = "dashboard/actor/detail/$1";
$route['finance/foreman/delete/(:any)'] = "dashboard/actor/delete/$1";
$route['finance/foreman/form/(:any)'] = "dashboard/actor/form/3/$1";
$route['finance/foreman/form'] = "dashboard/actor/form/3";
$route['finance/foreman/table'] = "dashboard/actor/table/3";
$route['finance/foreman'] = "dashboard/actor/index/3";

$route['finance/invoice-receipt/(:any)'] = "finance/print/transaction/invoice/$1";
$route['finance/invoice-receipt'] = "404";
$route['finance/fee-receipt/(:any)'] = "finance/print/transaction/sallary/$1";
$route['finance/fee-receipt'] = "404";

$route['finance'] = "finance/index";
//----------------- Finance starts