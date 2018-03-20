<?php

class Mog extends MY_Controller {

    private $url = "warehouse/mog/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("warehouse/mog_m", "origin_model"));
        $this->load->library('cfpdf');
        $this->load->config('pdf_config');
    }

    public function info($start = null, $end = null, $ct = null, $project = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['url_access'] = $this->url;
        if (!empty($start) && !empty($end) && !empty($ct)) {
            $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
            $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
            $data['category'] = $this->crud_model->read_data("transaction_ct", array("md5(transaction_ct_id)" => $ct))->row();
            $where["md5(project_id)"] = !empty($project) ? $project : md5(1);
            $where["md5(mog.transaction_ct_id)"] = $ct;
            $where["DATE(mog_date) >="] = date2mysql($data['starts']);
            $where["DATE(mog_date) <="] = date2mysql($data['ends']);
//            $where["mog_status !="]= 0;
            $data['show'] = $this->crud_model->read_data("mog", $where, array("mog.mog_id" => "DESC"), array("actor ac" => "ac.actor_id = mog.actor_id"), null, null, "*, (select count(mog_dt_id) from mog_dt where mog_id = mog.mog_id and mog_dt_status != 0) as item_usage")->result();
            $this->load->view("warehouse/info/mog/data", $data);
        } else {
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();
            $data['show'] = $this->origin_model->mog();
            $this->load->view("warehouse/info/mog/index", $data);
        }
    }

    public function detail($id) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['mog'] = $this->crud_model->read_data("mog", array("md5(mog_id)" => $id), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "employee ep" => "ep.employee_id = ur.employee_id"))->row();
        $data['mog_dt'] = $this->crud_model->read_data("mog_dt mog", array("md5(mog.mog_id)" => "$id", "mog.mog_dt_status !=" => 0), array("mog_dt_id" => "DESC"), array("code cde" => array("cde.code_id = mog.code_id", "LEFT"), "material_sub msb" => "msb.material_sub_id = mog.material_sub_id", "material m" => "m.material_id = msb.material_id", "material_unit mu" => "mu.material_unit_id = msb.material_unit_id"))->result();
        $this->load->view("warehouse/info/mog/detail", $data);
    }

    function bapb($id) {
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1, "md.mog_dt_status != " => 0), null, array("mog" => array("mog.mog_id=md.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "project p" => "mog.project_id=p.project_id"))->row();
        $this->load->view("warehouse/pdf/form_bapb", $data);
    }

    function bapb_pengadaan($id) {
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1, "md.mog_dt_status !=" => 0), null, array("mog" => array("mog.mog_id=md.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "project p" => "mog.project_id=p.project_id"))->row();
        $this->load->view("warehouse/pdf/form_bpab2", $data);
    }

    function bpm($id) {
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 2, "md.mog_dt_status !=" => "0"), null, array("mog" => array("mog.mog_id=md.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 2), null, array("actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "project p" => array("mog.project_id=p.project_id", "left")))->row();
        $this->load->view("warehouse/pdf/form_bpm", $data);
    }

}

?>
