<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Invoice_Tax extends MY_Controller {

    private $title = "Invoice";
    private $header = "Invoice";
    private $url = "finance/Invoice/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model('origin_model');
    }

    public function index($mode = null) {
        $data['sess']           = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['invoice_taxppn']     = ($mode == 'ppn') ? 1 : '';
        $data['invoice_taxpph21']   = ($mode == 'pph21') ? 1 : '';
        $data['invoice_taxpph22']   = ($mode == 'pph22') ? 1 : '';
        $data['invoice_taxpph23']   = ($mode == 'pph23') ? 1 : '';
        $data['title']          = $this->title;
        $data['header']         = $this->header;
        $data['url_access']     = $this->url;
        $data['mode']           = $mode;

        $join = array(
            "project_access pa" => "pa.project_id = p.project_id"
        );
        $where = array(
            "md5(users_id)"     => $data['sess']['users_id']
        );
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => $join, "where" => $where))->result();
        
        $data['actor'] = $this->origin_model->actor(($mode == 'pph21') ? 3 : 1);
        $data['content'] = "finance/report/invoice_tax/index";
        $this->load->view("../index", $data);
    }

    public function table($project = null, $start = null, $end = null, $mode = null, $actor = null) {
        $data['sess']   = $this->authentication_root();
        $data['start']  = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends']   = strtotime($start) > strtotime($end) ? $start : $end;
        $data['mode']   = $mode;
        
        switch ($mode) :
            case 'ppn' :
                $data['mode_title'] = "PPN Tax Report";
                $variable = array(
                    'one' => 3,
                    'two' => 4,
                );
                break;
            case 'pph21':
                $data['mode_title'] = "Reports Tax PPh Article 21";
                $variable = array(
                    'one' => 5,
                    'two' => 6,
                );
                break;
            case 'pph22' :
                $data['mode_title'] = "Reports Tax PPh Article  22";
                $variable = array(
                    'one' => 11,
                    'two' => 12,
                );
                break;
            case 'pph23':
                $data['mode_title'] = "Reports Tax PPh Article 23";
                $variable = array(
                    'one' => 15,
                    'two' => 16,
                );
                break;
        endswitch;
        
        $where = array(
            "md5(inv.project_id)"               => "$project",
            "DATE(inv.invoice_date_kwt) >="     => date2mysql($data['start']),
            "DATE(inv.invoice_date_kwt) <="     => date2mysql($data['ends'])
        );
        if($actor != null) :
            $where['md5(inv.actor_id)'] = $actor;
        endif;
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
        $this->load->view("finance/report/invoice_tax/invoice_tax_table", $data);
    }

}