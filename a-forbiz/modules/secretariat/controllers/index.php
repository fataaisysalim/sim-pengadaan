<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Index extends MY_Controller {

    private $title = "Secretariat";
    private $header = "Secretariat";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("secretariat/graph_m");
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['active'] = null;
        $data['content'] = "home";
        $data['now'] = date("Y");
        $data['js_load'] = "extend/js_fancybox";
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
        $data["last_activity"] = $this->crud_model->read_fordata(array("table" => "activity a", "where" => array("a.activity_ct" => "secretariat"), "join" => array("users u" => "u.users_id = a.users_id", "users_position up" => "up.users_position_id = u.users_position_id", "employee e" => "e.employee_id = u.employee_id"), "order" => array("a.activity_id" => "DESC"), "limit" => 12))->result();
        $data['inCots'] = $this->crud_model->read_data("doc_control", array("doc_control_ct_id" => 1))->num_rows();
        $data['outCots'] = $this->crud_model->read_data("doc_control", array("doc_control_ct_id" => 2))->num_rows();
        $data['features'] = "secretariat";
        $this->load->view("../index", $data);
    }

    public function transaverage($year_load = null, $project_load = null) {
        $year = isset($year_load) ? $year_load : date('Y');
        $data['year'] = $year;
        $data['average'] = $this->graph_m->transaction_average($year, $project_load);
        if ($data['average'] != null) {
            $average = $data['average'];
            $avg[0] = array(
                "name" => "Document Entry",
                "data" => array(
                    !empty($average['entry']['Jan']) ? $average['entry']['Jan'] : 0,
                    !empty($average['entry']['Feb']) ? $average['entry']['Feb'] : 0,
                    !empty($average['entry']['Mar']) ? $average['entry']['Mar'] : 0,
                    !empty($average['entry']['Apr']) ? $average['entry']['Apr'] : 0,
                    !empty($average['entry']['Mei']) ? $average['entry']['Mei'] : 0,
                    !empty($average['entry']['Jun']) ? $average['entry']['Jun'] : 0,
                    !empty($average['entry']['Jul']) ? $average['entry']['Jul'] : 0,
                    !empty($average['entry']['Agus']) ? $average['entry']['Agus'] : 0,
                    !empty($average['entry']['Sept']) ? $average['entry']['Sept'] : 0,
                    !empty($average['entry']['Okto']) ? $average['entry']['Okto'] : 0,
                    !empty($average['entry']['Nove']) ? $average['entry']['Nove'] : 0,
                    !empty($average['entry']['Des']) ? $average['entry']['Des'] : 0
                )
            );
            $avg[1] = array(
                "name" => "Document Exits",
                "data" => array(
                    !empty($average['exits']['Jan']) ? $average['exits']['Jan'] : 0,
                    !empty($average['exits']['Feb']) ? $average['exits']['Feb'] : 0,
                    !empty($average['exits']['Mar']) ? $average['exits']['Mar'] : 0,
                    !empty($average['exits']['Apr']) ? $average['exits']['Apr'] : 0,
                    !empty($average['exits']['Mei']) ? $average['exits']['Mei'] : 0,
                    !empty($average['exits']['Jun']) ? $average['exits']['Jun'] : 0,
                    !empty($average['exits']['Jul']) ? $average['exits']['Jul'] : 0,
                    !empty($average['exits']['Agus']) ? $average['exits']['Agus'] : 0,
                    !empty($average['exits']['Sept']) ? $average['exits']['Sept'] : 0,
                    !empty($average['exits']['Okto']) ? $average['exits']['Okto'] : 0,
                    !empty($average['exits']['Nove']) ? $average['exits']['Nove'] : 0,
                    !empty($average['exits']['Des']) ? $average['exits']['Des'] : 0
                )
            );
            $data['json'] = json_encode($avg, JSON_NUMERIC_CHECK);
        }
        $this->load->view("extend/graph/secretariat_transaction_average", $data);
    }

}
