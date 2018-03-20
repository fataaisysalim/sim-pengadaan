<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Transaction extends MY_Controller {

    private $title = "Templatee";
    private $header = "Template";
    private $url = "warehouse/formcontrollertemplate/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->library('cfpdf');
        $this->load->helper('romawi_helper');
        $this->load->config('pdf_config');
    }

    function bapb($id) {
        $data['sess'] = $this->authentication_root();
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1, "md.mog_dt_status != " => 0), null, array("mog" => array("mog.mog_id=md.mog_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left"), "stock_final s" => array("s.material_sub_id= ms.material_sub_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "project p" => "mog.project_id=p.project_id"))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null, null)->row();
        $this->load->view("warehouse/print/pdf_bapb", $data);
    }

    function bapb_warehouse($id) {
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1, "md.mog_dt_status != " => 0), null, array("mog" => array("mog.mog_id=md.mog_id", "left"), "stock s" => array("s.mog_id= mog.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "project p" => "mog.project_id=p.project_id"))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null, null)->row();
        $this->load->view("warehouse/print/pdf_bapb_warehouse", $data);
    }

    function bapb_procurement($id = null) {
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1, "md.mog_dt_status != " => 0), null, array("mog" => array("mog.mog_id=md.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 1), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "project p" => "mog.project_id=p.project_id"))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null, null)->row();
        $this->load->view("warehouse/print/pdf_bapb_procurement", $data);
    }

    function bpm($id) {
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 2, "md.mog_dt_status != " => 0), null, array("mog" => array("mog.mog_id=md.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left"), "stock_final s" => array("s.material_sub_id= ms.material_sub_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 2), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "project p" => "mog.project_id=p.project_id"))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null, null)->row();
        $this->load->view("warehouse/print/pdf_bpm", $data);
    }

    function bpm_warehouse($id) {
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 2, "md.mog_dt_status != " => 0), null, array("mog m" => array("mog.mog_id=md.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 2), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "project p" => "mog.project_id=p.project_id"))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null, null)->row();
        $this->load->view("warehouse/print/pdf_bpm_warehouse", $data);
    }

    function bpm_procurement($id) {
        $data['mog'] = $this->crud_model->read_data("mog_dt md", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 2, "md.mog_dt_status != " => 0), null, array("mog" => array("mog.mog_id=md.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), "users ur" => array("ur.users_id = mog.users_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "material_sub ms" => array("md.material_sub_id=ms.material_sub_id", "left")
                    , "material_unit mu" => array("mu.material_unit_id=ms.material_unit_id", "left"), "code c" => array("md.code_id=c.code_id", "left")))->result();
        $data['mogdet'] = $this->crud_model->read_data("mog", array("md5(mog.mog_id)" => $id, "mog.transaction_ct_id" => 2), null, array("actor ac" => "ac.actor_id = mog.actor_id", "users ur" => "ur.users_id = mog.users_id", "project p" => "mog.project_id=p.project_id"))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null, null)->row();
        $this->load->view("warehouse/print/pdf_bpm_procurement", $data);
    }

    public function bapp($id = null) {
        $data['transaction'] = $this->crud_model->read_data("equipt_transaction_dt etd", array("md5(et.equipt_transaction_id)" => $id, "et.transaction_ct_id" => 1), null, array("equipt_transaction et" => array("et.equipt_transaction_id=etd.equipt_transaction_id", "left"), "users ur" => array("ur.users_id = et.users_id", "left"), "actor ac" => array("ac.actor_id = et.actor_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "equipment e" => array("e.equipment_id=etd.equipment_id", "left")
                    , "equipment_unit eu" => array("eu.equipment_unit_id=e.equipment_unit_id", "left")))->result();
        $data['tdet'] = $this->crud_model->read_data("equipt_transaction et", array("md5(et.equipt_transaction_id)" => $id, "et.transaction_ct_id" => 1), null, array("actor ac" => array("ac.actor_id = et.actor_id", "left"), "users ur" => array("ur.users_id = et.users_id", "left"), "project p" => array("et.project_id=p.project_id", "left")))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null, null)->row();
        $this->load->view("warehouse/print/bapp", $data);
    }

    public function bpp($id = null) {
        $data['transaction'] = $this->crud_model->read_data("equipt_transaction_dt etd", array("md5(et.equipt_transaction_id)" => $id, "et.transaction_ct_id" => 2), null, array("equipt_transaction et" => array("et.equipt_transaction_id=etd.equipt_transaction_id", "left"), "users ur" => array("ur.users_id = et.users_id", "left"), "actor ac" => array("ac.actor_id = et.actor_id", "left"), "employee ep" => array("ep.employee_id = ur.employee_id", "left"), "equipment e" => array("e.equipment_id=etd.equipment_id", "left")
                    , "equipment_unit eu" => array("eu.equipment_unit_id=e.equipment_unit_id", "left")))->result();
        $data['tdet'] = $this->crud_model->read_data("equipt_transaction et", array("md5(et.equipt_transaction_id)" => $id, "et.transaction_ct_id" => 2), null, array("actor ac" => array("ac.actor_id = et.actor_id", "left"), "users ur" => array("ur.users_id = et.users_id", "left"), "project p" => array("et.project_id=p.project_id", "left")))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null, null)->row();
        $this->load->view("warehouse/print/bpp", $data);
    }

}

?>