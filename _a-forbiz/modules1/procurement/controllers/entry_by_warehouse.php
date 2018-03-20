<?php

class Entry_by_warehouse extends MY_Controller {

    private $url = "procurement/entry_by_warehouse/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->library('cfpdf');
        $this->load->config('pdf_config');
    }

    public function index() {
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();
        $this->load->view("procurement/info/entry_by_warehouse/index", $data);
    }

    public function bapb($features = null, $project = null, $start = null, $end = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($features == "data") {
            $data['xyz'] = 0;
            if (!empty($start)) {
                $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
                $where["DATE(mog.mog_date) >="] = date2mysql($data['starts']);
            }
            if (!empty($end)) {
                $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
                $where["DATE(mog.mog_date) <="] = date2mysql($data['ends']);
            }
            $where["mog.transaction_ct_id"] = 1;
            $where["md5(mog.project_id)"] = !empty($project) ? $project : md5(1);
           // $where["mog.mog_status"] = 0;
            $data['show'] = $this->crud_model->read_data("mog", $where, array("mog.mog_id" => "DESC"), array("actor ac" => "ac.actor_id = mog.actor_id"), null, null, "*, (select count(mog_dt_id) from mog_dt where mog_id = mog.mog_id and mog_dt_status != 0) as item_usage")->result();
            $this->load->view("procurement/info/entry_by_warehouse/bapb", $data);
        } elseif ($features == "detail") {
            $id = $project;
            $data['mog'] = $this->crud_model->read_data("mog", array("md5(mog_id)" => $id), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "employee ep" => "ep.employee_id = ur.employee_id"))->row();
            $data['mog_dt'] = $this->crud_model->read_data("mog_dt mog", array("md5(mog.mog_id)" => "$id", "mog.mog_dt_status !=" => 0), array("mog_dt_id" => "DESC"), array("code cde" => array("cde.code_id = mog.code_id", "LEFT"), "material_sub msb" => "msb.material_sub_id = mog.material_sub_id", "material m" => "m.material_id = msb.material_id", "material_unit mu" => "mu.material_unit_id = msb.material_unit_id"))->result();
            $this->load->view("procurement/info/entry_by_warehouse/bapb_detail", $data);
        }
    }

    public function bapp($features = null, $project = null, $start = null, $end = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($features == "data") {
            $data['xyz'] = 1;
            if (!empty($start)) {
                $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
                $where["DATE(eq.equipt_transaction_date) >="] = date2mysql($data['starts']);
            }
            if (!empty($end)) {
                $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
                $where["DATE(eq.equipt_transaction_date) <="] = date2mysql($data['ends']);
            }
            $where["eq.equipt_transaction_status"] = 0;
            $where["eq.transaction_ct_id"] = 1;
            $data['show'] = $this->crud_model->read_data("equipt_transaction eq", $where, array("eq.equipt_transaction_id" => "DESC"), array("actor ac" => "ac.actor_id = eq.actor_id"), null, null, "*, (select count(equipt_transaction_dt_id) from equipt_transaction_dt where equipt_transaction_id = eq.equipt_transaction_id and equipt_transaction_dt_status != 0) as item_usage")->result();
            $this->load->view("procurement/info/entry_by_warehouse/bapp", $data);
        } elseif ($features == "detail") {
            $id = $project;
            $data['mog'] = $this->crud_model->read_data("equipt_transaction et", array("md5(et.equipt_transaction_id)" => $id), null, array("actor ac" => "ac.actor_id = et.actor_id", "users ur" => "ur.users_id = et.users_id", "employee ep" => "ep.employee_id = ur.employee_id"))->row();
            $data['mog_dt'] = $this->crud_model->read_data("equipt_transaction_dt etd", array("md5(etd.equipt_transaction_id)" => "$id", "equipt_transaction_dt_status !=" => 0), array("etd.equipt_transaction_dt_id" => "DESC"), array("code cde" => array("cde.code_id = etd.code_id", "LEFT"), "equipment eq" => "eq.equipment_id = etd.equipment_id", "equipment_ct eqc" => "eqc.equipment_ct_id = eq.equipment_ct_id", "equipment_unit eu" => "eu.equipment_unit_id = eq.equipment_unit_id"))->result();
            $this->load->view("procurement/info/entry_by_warehouse/bapp_detail", $data);
        }
    }

    function bapb_pengadaan($id) {
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1, "md.mog_dt_status !=" => 0), null, array("mog" => array("mog.mog_id=md.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "project p" => "mog.project_id=p.project_id"))->row();
        $this->load->view("warehouse/pdf/form_bpab2", $data);
    }

}

?>
