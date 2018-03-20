<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Doc_exits extends MY_Controller {

    private $title = "Dokumen";
    private $header = "Dokumen";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("origin_model");
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['header'] = $this->title;
        $data['code'] = $this->crud_model->read_data("doc_control_letcode")->result();
        $data['project'] = $this->origin_model->proByAccess($data['sess']['users_id']);
        $this->load->view("secretariat/info/exit/index", $data);
    }

    public function data($project = null, $start = null, $end = null, $code = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['header'] = $this->title;
        $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $statment["table"] = "doc_control dc";
        $statment["order"] = array("dc.doc_control_id" => "DESC");
        $statment["join"] = array("actor a" => "a.actor_id = dc.actor_id", "project p" => "p.project_id = dc.project_id", "users u" => "u.users_id = dc.users_id", "employee e" => "e.employee_id = u.employee_id");
        $where["md5(dc.project_id)"] = $project;
        $where["dc.doc_control_ct_id"] = 2;
        $where["DATE(dc.doc_control_date) >="] = date2mysql(!empty($data['starts']) ? $data['starts'] : date("d-m-Y"));
        $where["DATE(dc.doc_control_date) <="] = date2mysql(!empty($data['ends']) ? $data['ends'] : date("d-m-Y"));
        if (!empty($code)) {
            if ($code != 'all') {
                $where["md5(dc.doc_control_letcode_id)"] = $code;
            }
        }
        $statment["where"] = $where;
        $data['doc'] = $this->crud_model->read_fordata($statment)->result();
        $this->recActivity("Exported <b>Document Exits ($data[starts] - $data[ends])</b>", "secretariat");
        $this->load->view("secretariat/info/exit/data", $data);
    }

    public function export($project = null, $start = null, $end = null, $code = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['header'] = $this->title;

        $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $statment["table"] = "doc_control dc";
        $statment["order"] = array("dc.doc_control_id" => "DESC");
        $statment["join"] = array("actor a" => "a.actor_id = dc.actor_id", "project p" => "p.project_id = dc.project_id", "users u" => "u.users_id = dc.users_id", "employee e" => "e.employee_id = u.employee_id");
        $where["md5(dc.project_id)"] = $project;
        $where["dc.doc_control_ct_id"] = 2;
        $where["DATE(dc.doc_control_date) >="] = date2mysql(!empty($data['starts']) ? $data['starts'] : date("d-m-Y"));
        $where["DATE(dc.doc_control_date) <="] = date2mysql(!empty($data['ends']) ? $data['ends'] : date("d-m-Y"));
        if (!empty($code)) {
            if ($code != 'all') {
                $where["md5(dc.doc_control_letcode_id)"] = $code;
            }
        }
        $statment["where"] = $where;
        $data['doc'] = $this->crud_model->read_fordata($statment)->result();

        $data['pro'] = $this->crud_model->read_fordata(array("table" => "project", "where" => array("md5(project_id)" => $project)))->row();
        $this->load->view("secretariat/info/exit/export", $data);
    }

    public function detail($project = null, $start = null, $end = null, $code = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['header'] = $this->title;
        $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $data['doc'] = $this->origin_model->docDt($project);
        $this->load->view("secretariat/info/exit/detail", $data);
    }

}
