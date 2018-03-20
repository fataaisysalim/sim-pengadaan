<?php

class Salary extends MY_Controller {

    private $title = "Salary";
    private $header = "Salary";
    private $url = "finance/stock/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function info($project = null, $start = null, $end = null, $mode = null, $actor = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (!empty($start) && !empty($end)) {
            $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
            $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
            $data['mode'] = $mode;
            $where = array(
                "md5(sal.project_id)" => "$project",
                "DATE(sal.salary_date) >=" => date2mysql($data['starts']),
                "DATE(sal.salary_date) <=" => date2mysql($data['ends'])
            );
            if ($actor != null) :
                $where['md5(sal.actor_id)'] = $actor;
            endif;
            $order = array("sal.salary_date" => "asc");
            $join = array(
                "actor ac" => "ac.actor_id = sal.actor_id",
                "project p" => "p.project_id = sal.project_id"
            );
            $data["show"] = $this->crud_model->read_data_with_false("salary sal", $where, $order, $join)->result();

            foreach ($data['show'] as $index => $row) :
                $data['tax'] = $this->crud_model->read_data("salary_tax", array('salary_id' => $row->salary_id), null, array('tax' => 'salary_tax.tax_id = tax.tax_id'))->result();
                if (count($data['tax']) > 0) :
                    foreach ($data['tax'] as $row_) :
                        $data['show'][$index]->salary_tax = $data['tax'];
                    endforeach;
                else:
                    $data['show'][$index]->salary_tax = array();
                endif;
            endforeach;
            $this->load->view("finance/info/salary/data", $data);
        } else {
            $data['mandor'] = $this->origin_model->actor(3);
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();

            $this->load->view("finance/info/salary/index", $data);
        }
    }

    public function detail($id = null) {
        $where = array(
            'md5(sal.salary_id)' => $id
        );
        $order = array("sal.salary_date" => "asc");
        $join = array(
            "actor ac" => "ac.actor_id = sal.actor_id",
            "project p" => "p.project_id = sal.project_id"
        );
        $data["show"] = $this->crud_model->read_data_with_false("salary sal", $where, $order, $join)->row();
        $data['tax'] = $this->crud_model->read_data("salary_tax", array('md5(salary_id)' => $id), null, array('tax' => 'salary_tax.tax_id = tax.tax_id'))->result();

        $this->load->view("finance/info/salary/detail", $data);
    }

}
