<?php

class Invoice extends MY_Controller {

    private $title = "Invoice";
    private $header = "Invoice";
    private $url = "finance/stock/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function info($category = null, $project = null, $start = null, $end = null, $status = null, $actor = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['menu'] = array(1 => 'Material', 2 => 'Equipment', 4 => 'Subcon');

        if (!empty($start) && !empty($end)) {
            $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
            $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
            $data['ctid'] = $category;

            $where = array(
                "md5(inv.project_id)" => "$project",
                "DATE(inv.invoice_date_kwt) >=" => date2mysql($data['starts']),
                "DATE(inv.invoice_date_kwt) <=" => date2mysql($data['ends'])
            );
            if ($actor != null) {
                $where['md5(inv.actor_id)'] = $actor;
            }
            if ($status != null) {
                if ($status != 'all') :
                    $where['inv.invoice_payment_status'] = $status;
                endif;
            }
            if ($category != null) {
                $where['inv.invoice_resource_code'] = $category;
            }


            $order = array("inv.invoice_date_kwt" => "asc");
            if ($category == 4) :
                $join = array(
                    "actor ac" => "ac.actor_id = inv.actor_id",
                    "users us" => "us.users_id = inv.users_id",
                    "project p" => "p.project_id = inv.project_id",
                    'work_order wo' => array("inv.work_order_id = wo.work_order_id", 'LEFT'),
                    'invoice_wo inwo' => array("inv.invoice_id = inwo.invoice_id", 'LEFT')
                );
            else:
                $join = array(
                    "actor ac" => "ac.actor_id = inv.actor_id",
                    "users us" => "us.users_id = inv.users_id",
                    "project p" => "p.project_id = inv.project_id",
                );
            endif;

            $data["show"] = $this->crud_model->read_data_with_false("invoice inv", $where, $order, $join)->result();

            foreach ($data['show'] as $index => $row) :
                $data['tax'] = $this->crud_model->read_data("invoice_tax", array('invoice_id' => $row->invoice_id), null, array('tax' => 'invoice_tax.tax_id = tax.tax_id'))->result();
                if (count($data['tax']) > 0) :
                    foreach ($data['tax'] as $row_) :
                        $data['show'][$index]->invoice_tax = $data['tax'];
                    endforeach;
                else:
                    $data['show'][$index]->invoice_tax = array();
                endif;
            endforeach;

//            echo '<pre>';
//            print_r($data['show']);
//            echo '</pre>';

            $this->load->view("finance/info/invoice/data", $data);
        } else {
            $data['supplier'] = $this->origin_model->actor(1);
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();

            $this->load->view("finance/info/invoice/index", $data);
        }
    }

    public function detail($id = null) {
        $where = array(
            'md5(inv.invoice_id)' => $id
        );
        $order = array("inv.invoice_date_kwt" => "asc");
        $join = array(
            "actor ac" => "ac.actor_id = inv.actor_id",
            "users us" => "us.users_id = inv.users_id",
            "project p" => "p.project_id = inv.project_id",
            "work_order wo" => array("inv.work_order_id = wo.work_order_id", 'LEFT')
        );
        $data["show"] = $this->crud_model->read_data_with_false("invoice inv", $where, $order, $join)->row();
        $data['tax'] = $this->crud_model->read_data("invoice_tax", array('md5(invoice_id)' => $id), null, array('tax' => 'invoice_tax.tax_id = tax.tax_id'))->result();
        if (count($data['show']) > 0) :
            $wo_where = array(
                'md5(wo_inv.invoice_id)' => $id
            );
            $wo_order = array("wo_inv.invoice_wo_date" => "asc");
            $wo_join = array(
                "invoice_wo_ct ct" => "wo_inv.invoice_wo_ct_id= ct.invoice_wo_ct_id",
            );
            $data['inwo'] = $this->crud_model->read_data_with_false('invoice_wo wo_inv', $wo_where, $wo_order, $wo_join)->row();
            $inwod = $data['inwo'];
            $dummy = array(
                'wo_total' => 0,
                'wo_extra' => 0,
                'wo_serch' => 0,
                'wo_serid' => null,
                'wo_modes' => 0,
                'wo_perce' => 0,
                'wo_todus' => 0,
                'wo_totas' => 0,
            );

            if (count($data['inwo']) != 0) :
                if ($data['show']->work_order_id != '') :

                    $dummy['wo_total'] = $data['show']->work_order_contract;
                    $dummy['wo_todus'] = $data['show']->work_order_contract;
                    if ($data['show']->work_order_extra_mode == '') :
                        $dummy['wo_extra'] = 0;
                    elseif ($data['show']->work_order_extra_mode == 1) :
                        $dummy['wo_extra'] = $data['show']->work_order_extra;
                    elseif ($data['show']->work_order_extra_mode == 2) :
                        $dummy['wo_extra'] = -($data['show']->work_order_extra);
                    else:
                        $dummy['wo_extra'] = 0;
                    endif;
                    $dummy['wo_serch'] = $data['inwo']->invoice_wo_sequence;
                    $dummy['wo_serid'] = $data['inwo']->invoice_wo_id;

                    $woloop_where = array(
                        'work_order_id' => $data['show']->work_order_id
                    );
                    $woloop_order = array("invoice_wo_sequence" => "asc");
                    $woloop_join = array(
                        "invoice" => "invoice.invoice_id = invoice_wo.invoice_id",
                    );
                    $woloop_select = 'invoice_wo_id, invoice_wo_ct_id, invoice_wo_sequence, invoice_wo_percent';
                    $inwo_rest = $this->crud_model->read_data_with_false('invoice_wo', $woloop_where, $woloop_order, $woloop_join, null, null, $woloop_select)->result();

                    foreach ($inwo_rest as $indewo => $rowwo) :
                        if ($rowwo->invoice_wo_id < $dummy['wo_serid']) :
                            if ($dummy['wo_modes'] == 1) :
                                $dummy['wo_perce'] = 0;
                            endif;
                            if ($rowwo->invoice_wo_ct_id == 1) :
                                $dummy['wo_perce'] = $data['show']->work_order_dp;
                            elseif ($rowwo->invoice_wo_ct_id == 2) :
                                if ($dummy['wo_modes'] == 1) :
                                    $dummy['wo_perce'] = $rowwo->invoice_wo_percent;
                                else:
                                    $dummy['wo_perce'] = $rowwo->invoice_wo_percent - $dummy['wo_perce'];
                                endif;
                            elseif ($rowwo->invoice_wo_ct_id == 3) :
                                $dummy['wo_perce'] = $rowwo->work_order_retensi;
                            endif;
                            $dummy['wo_todus'] = (($dummy['wo_perce'] / 100) * $dummy['wo_total']);
                            $dummy['wo_totas'] = $dummy['wo_totas'] + $dummy['wo_todus'];
                            $dummy['wo_modes'] = $rowwo->invoice_wo_ct_id;
                        endif;
                    endforeach;

                    if ($inwod->invoice_wo_ct_id == 3) :
                        $data['inwo_rest'] = $dummy['wo_totas'];
                    else:
                        $data['inwo_rest'] = $dummy['wo_totas'];
                    endif;

                endif;
            endif;

        endif;
        $this->load->view("finance/info/invoice/detail", $data);
    }

}
