<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class index extends MY_Controller {

    private $title = "Dashboard";
    private $header = "Dashboard";
    private $url = "home/home";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("warehouse/graph_m");
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        $data['active'] = null;
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['private_url_access'] = "$this->url/show";
        $data['content'] = "home";
        $data['now'] = date('Y');
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
        $data["last_activity"] = $this->crud_model->read_fordata(array("table" => "activity a", "where" => array("a.activity_ct" => "warehouse"), "join" => array("users u" => "u.users_id = a.users_id", "users_position up" => "up.users_position_id = u.users_position_id", "employee e" => "e.employee_id = u.employee_id"), "order" => array("a.activity_id" => "DESC"), "limit" => 12))->result();
        $data['supplier'] = $this->crud_model->read_data("actor", array("actor_category_id" => 1, "actor_status" => 1))->num_rows();
        $data['subkon'] = $this->crud_model->read_data("actor", array("actor_category_id" => 2, "actor_status" => 1))->num_rows();
        $data['mandor'] = $this->crud_model->read_data("actor", array("actor_category_id" => 3, "actor_status" => 1))->num_rows();
        $data['material'] = $this->crud_model->read_data("material_sub", array("material_sub_status" => 1))->num_rows();
        $data['equipment'] = $this->crud_model->read_data("equipment")->num_rows();
        $this->load->view("../index", $data);
    }

    public function transaverage($year_load = null, $project_load = null) {
        $year = isset($year_load) ? $year_load : date('Y');
        $data['year'] = $year;
        $data['average'] = $this->graph_m->transaction_average($year, $project_load);
        if ($data['average'] != null) {
            $average = $data['average'];
            $avg[0] = array(
                "name" => "BAPB",
                "data" => array(
                    !empty($average['bapb']['Jan']) ? $average['bapb']['Jan'] : 0,
                    !empty($average['bapb']['Feb']) ? $average['bapb']['Feb'] : 0,
                    !empty($average['bapb']['Mar']) ? $average['bapb']['Mar'] : 0,
                    !empty($average['bapb']['Apr']) ? $average['bapb']['Apr'] : 0,
                    !empty($average['bapb']['Mei']) ? $average['bapb']['Mei'] : 0,
                    !empty($average['bapb']['Jun']) ? $average['bapb']['Jun'] : 0,
                    !empty($average['bapb']['Jul']) ? $average['bapb']['Jul'] : 0,
                    !empty($average['bapb']['Agus']) ? $average['bapb']['Agus'] : 0,
                    !empty($average['bapb']['Sept']) ? $average['bapb']['Sept'] : 0,
                    !empty($average['bapb']['Okto']) ? $average['bapb']['Okto'] : 0,
                    !empty($average['bapb']['Nove']) ? $average['bapb']['Nove'] : 0,
                    !empty($average['bapb']['Des']) ? $average['bapb']['Des'] : 0
                )
            );
            $avg[1] = array(
                "name" => "BPM",
                "data" => array(
                    !empty($average['bpm']['Jan']) ? $average['bpm']['Jan'] : 0,
                    !empty($average['bpm']['Feb']) ? $average['bpm']['Feb'] : 0,
                    !empty($average['bpm']['Mar']) ? $average['bpm']['Mar'] : 0,
                    !empty($average['bpm']['Apr']) ? $average['bpm']['Apr'] : 0,
                    !empty($average['bpm']['Mei']) ? $average['bpm']['Mei'] : 0,
                    !empty($average['bpm']['Jun']) ? $average['bpm']['Jun'] : 0,
                    !empty($average['bpm']['Jul']) ? $average['bpm']['Jul'] : 0,
                    !empty($average['bpm']['Agus']) ? $average['bpm']['Agus'] : 0,
                    !empty($average['bpm']['Sept']) ? $average['bpm']['Sept'] : 0,
                    !empty($average['bpm']['Okto']) ? $average['bpm']['Okto'] : 0,
                    !empty($average['bpm']['Nove']) ? $average['bpm']['Nove'] : 0,
                    !empty($average['bpm']['Des']) ? $average['bpm']['Des'] : 0
                )
            );
            $avg[2] = array(
                "name" => "BAPP",
                "data" => array(
                    !empty($average['bapp']['Jan']) ? $average['bapp']['Jan'] : 0,
                    !empty($average['bapp']['Feb']) ? $average['bapp']['Feb'] : 0,
                    !empty($average['bapp']['Mar']) ? $average['bapp']['Mar'] : 0,
                    !empty($average['bapp']['Apr']) ? $average['bapp']['Apr'] : 0,
                    !empty($average['bapp']['Mei']) ? $average['bapp']['Mei'] : 0,
                    !empty($average['bapp']['Jun']) ? $average['bapp']['Jun'] : 0,
                    !empty($average['bapp']['Jul']) ? $average['bapp']['Jul'] : 0,
                    !empty($average['bapp']['Agus']) ? $average['bapp']['Agus'] : 0,
                    !empty($average['bapp']['Sept']) ? $average['bapp']['Sept'] : 0,
                    !empty($average['bapp']['Okto']) ? $average['bapp']['Okto'] : 0,
                    !empty($average['bapp']['Nove']) ? $average['bapp']['Nove'] : 0,
                    !empty($average['bapp']['Des']) ? $average['bapp']['Des'] : 0
                )
            );
            $avg[3] = array(
                "name" => "BPP",
                "data" => array(
                    !empty($average['bpp']['Jan']) ? $average['bpp']['Jan'] : 0,
                    !empty($average['bpp']['Feb']) ? $average['bpp']['Feb'] : 0,
                    !empty($average['bpp']['Mar']) ? $average['bpp']['Mar'] : 0,
                    !empty($average['bpp']['Apr']) ? $average['bpp']['Apr'] : 0,
                    !empty($average['bpp']['Mei']) ? $average['bpp']['Mei'] : 0,
                    !empty($average['bpp']['Jun']) ? $average['bpp']['Jun'] : 0,
                    !empty($average['bpp']['Jul']) ? $average['bpp']['Jul'] : 0,
                    !empty($average['bpp']['Agus']) ? $average['bpp']['Agus'] : 0,
                    !empty($average['bpp']['Sept']) ? $average['bpp']['Sept'] : 0,
                    !empty($average['bpp']['Okto']) ? $average['bpp']['Okto'] : 0,
                    !empty($average['bpp']['Nove']) ? $average['bpp']['Nove'] : 0,
                    !empty($average['bpp']['Des']) ? $average['bpp']['Des'] : 0
                )
            );
            $data['json'] = json_encode($avg, JSON_NUMERIC_CHECK);
        }
        $this->load->view("extend/graph/warehouse_transaction_average", $data);
    }

}
