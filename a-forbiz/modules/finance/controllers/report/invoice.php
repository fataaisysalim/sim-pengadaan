<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Invoice extends MY_Controller {

    private $title = "Invoice";
    private $header = "Invoice";
    private $url = "finance/Invoice/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model('origin_model');
    }

    public function index($mode = null) {
        $data['sess']       = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['invoice_m']  = ($mode == null) ? 1 : '';
        if($mode != null) :
            $data['invoice_outs']   = ($mode == 0) ? 1 : '';
            $data['invoice_paid']   = ($mode == 1) ? 1 : '';
        endif;
        $data['title']      = $this->title;
        $data['header']     = $this->header;
        $data['url_access'] = $this->url;
        $data['mode']       = ($mode == null) ? 'all' : $mode;

        $join = array(
            "project_access pa" => "pa.project_id = p.project_id"
        );
        $where = array(
            "md5(users_id)"     => $data['sess']['users_id']
        );
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => $join, "where" => $where))->result();
        
        $data['supplier'] = $this->origin_model->actor(1);
        $data['content'] = "finance/report/invoice/index";
        $this->load->view("../index", $data);
    }

    public function table($project = null, $start = null, $end = null, $status = null, $actor = null) {
        $data['sess']   = $this->authentication_root();
        $data['start']  = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends']   = strtotime($start) > strtotime($end) ? $start : $end;
        $data['actor']  = $actor;
        $data['mode']   = $status;
        
        
        $where = array(
            "md5(inv.project_id)"           => "$project",
            "DATE(inv.invoice_date_kwt) >="  => date2mysql($data['start']),
            "DATE(inv.invoice_date_kwt) <="  => date2mysql($data['ends'])
        );
        if($actor != null) {
            $where['md5(inv.actor_id)'] = $actor;
        }
        if($status != null) {
            if($status != 'all') :
                $where['inv.invoice_payment_status'] = $status;
            endif;
        }
        $order = array("inv.invoice_date_kwt" => "asc");
        $join = array(
            "actor ac"   => "ac.actor_id = inv.actor_id",
            "users us"   => "us.users_id = inv.users_id",
            "project p"  => "p.project_id = inv.project_id"
        );
        $data["show"] = $this->crud_model->read_data_with_false("invoice inv", $where, $order, $join)->result();
        
        foreach($data['show'] as $index => $row) :
            $data['tax'] = $this->crud_model->read_data("invoice_tax",array('invoice_id' => $row->invoice_id), null, array('tax' => 'invoice_tax.tax_id = tax.tax_id'))->result();
            if(count($data['tax']) > 0) :
                foreach ($data['tax'] as $row_) :
                    $data['show'][$index]->invoice_tax = $data['tax'];
                endforeach;
            else:
                $data['show'][$index]->invoice_tax = array();
            endif;
        endforeach;
        $this->load->view("finance/report/invoice/invoice_table", $data);
    }

}