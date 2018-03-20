<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Salary extends MY_Controller {

    private $title = "Salary";
    private $header = "Salary";
    private $url = "finance/Salary/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model('origin_model');
    }

    public function index($mode = null) {
        $data['sess']       = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['salary_m']       = ($mode == 'monitoring') ? 1 : '';
        $data['salary_pph21']   = ($mode != 'monitoring') ? 1 : '';
        $data['title']      = $this->title;
        $data['header']     = $this->header;
        $data['url_access'] = $this->url;
        $data['mode']       = $mode;

        $join = array(
            "project_access pa" => "pa.project_id = p.project_id"
        );
        $where = array(
            "md5(users_id)"     => $data['sess']['users_id']
        );
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => $join, "where" => $where))->result();
        
        $data['mandor'] = $this->origin_model->actor(3);
        $data['content'] = "finance/report/salary/index";
        $this->load->view("../index", $data);
    }

    public function table($project = null, $start = null, $end = null, $mode = null, $actor = null) {
        $data['sess']   = $this->authentication_root();
        $data['start']  = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends']   = strtotime($start) > strtotime($end) ? $start : $end;
        $data['mode']   = $mode;
        $where = array(
            "md5(sal.project_id)"       => "$project",
            "DATE(sal.salary_date) >="  => date2mysql($data['start']),
            "DATE(sal.salary_date) <="  => date2mysql($data['ends'])
        );
        if($actor != null) :
            $where['md5(sal.actor_id)'] = $actor;
        endif;
        $order = array("sal.salary_date" => "asc");
        $join = array(
            "actor ac"   => "ac.actor_id = sal.actor_id",
            "project p"  => "p.project_id = sal.project_id"
        );
        $data["show"] = $this->crud_model->read_data_with_false("salary sal", $where, $order, $join)->result();
        
        foreach($data['show'] as $index => $row) :
            $data['tax'] = $this->crud_model->read_data("salary_tax",array('salary_id' => $row->salary_id), null, array('tax' => 'salary_tax.tax_id = tax.tax_id'))->result();
            if(count($data['tax']) > 0) :
                foreach($data['tax'] as $row_) :
                    $data['show'][$index]->salary_tax = $data['tax'];
                endforeach;
            else:
                $data['show'][$index]->salary_tax = array();
            endif;
        endforeach;
        $this->load->view("finance/report/salary/salary_table", $data);
    }

}