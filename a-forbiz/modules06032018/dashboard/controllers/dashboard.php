<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Dashboard extends MY_Controller {

    private $title = "Dashboard";
    private $header = "Dashboard";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("dashboard/sistem_m");
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        $data['active'] = null;
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['content'] = "dashboard";
        $data['now'] = date('Y');
         $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
        $data["last_activity"] = $this->crud_model->read_fordata(array("table" => "activity a", "where" => array("a.activity_ct !=" => "access"), "join" => array("users u" => "u.users_id = a.users_id", "users_position up" => "up.users_position_id = u.users_position_id", "employee e" => "e.employee_id = u.employee_id"), "order" => array("a.activity_id" => "DESC"), "limit" => 12))->result();
        $data["log_access"] = $this->crud_model->read_fordata(array("table" => "activity a", "where" => array("a.activity_ct " => "access"), "join" => array("users u" => "u.users_id = a.users_id", "users_position up" => "up.users_position_id = u.users_position_id", "employee e" => "e.employee_id = u.employee_id"), "order" => array("a.activity_id" => "DESC"), "limit" => 7))->result();
        $data['employeeCots'] = $this->crud_model->read_data("employee", array("employee_status" => 1))->num_rows();
        $data['projectCots'] = $this->crud_model->read_data("project")->num_rows();
        $data['usersCots'] = $this->crud_model->read_data("users", array("users_status" => 1))->num_rows();
        $this->load->view("../index", $data);
    }

    public function home() {
        $data['sess'] = $this->authentication_root();
        $data['active'] = null;
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['content'] = "home";
        $data['now'] = date('Y');
         $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
        $data["last_activity"] = $this->crud_model->read_fordata(array("table" => "activity a", "where" => array("a.activity_ct !=" => "access"), "join" => array("users u" => "u.users_id = a.users_id", "users_position up" => "up.users_position_id = u.users_position_id", "employee e" => "e.employee_id = u.employee_id"), "order" => array("a.activity_id" => "DESC"), "limit" => 12))->result();
        $data["log_access"] = $this->crud_model->read_fordata(array("table" => "activity a", "where" => array("a.activity_ct " => "access"), "join" => array("users u" => "u.users_id = a.users_id", "users_position up" => "up.users_position_id = u.users_position_id", "employee e" => "e.employee_id = u.employee_id"), "order" => array("a.activity_id" => "DESC"), "limit" => 7))->result();
        $data['employeeCots'] = $this->crud_model->read_data("employee", array("employee_status" => 1))->num_rows();
        $data['projectCots'] = $this->crud_model->read_data("project")->num_rows();
        $data['usersCots'] = $this->crud_model->read_data("users", array("users_status" => 1))->num_rows();
        $this->load->view("../index", $data);
    }

    public function set_session_project($project){
        $this->session->set_userdata("project_id", $project);
    }
    public function backup() {
        $this->load->dbutil();
        $backup = & $this->dbutil->backup();
        $this->load->helper('file');
        $now = date("d-m-Y H_i_s");
        write_file("z-dbackup/FORDB $now.zip", $backup);
        $this->load->helper('download');
        $this->recActivity("Backup Database WG System", "dashboard");
        force_download("FORDB $now.zip", $backup);
    }

    public function effectivusage($year_load = null) {
        $year = isset($year_load) ? $year_load : date('Y');
        $data['year'] = $year;
        $data['usage'] = $this->sistem_m->effectivitnas($year);
        if ($data['usage'] != null) {
            $usage = $data['usage'];
            $avg[0] = array(
                "name" => "User Experience",
                "data" => array($usage['Jan'], $usage['Feb'], $usage['Mar'], $usage['Apr'], $usage['Mei'], $usage['Jun'], $usage['Jul'], $usage['Agus'], $usage['Sept'], $usage['Okto'], $usage['Nove'], $usage['Des'])
            );
            $data['json'] = json_encode($avg, JSON_NUMERIC_CHECK);
        }
        $this->load->view("extend/graph/effectivusage", $data);
    }

}
