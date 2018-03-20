<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Equipment_transaction extends MY_Controller {

    private $title = "Equipment Receipt";
    private $url = "warehouse/";
    private $view_path = "warehouse/transaction/equipment/";
    private $view_path_entry = "warehouse/transaction/equipment/entry/";
    private $view_path_exit = "warehouse/transaction/equipment/exit/";
    private $view_path_return = "warehouse/transaction/equipment/return/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function entry($id = null) {
        $data['sess'] = $this->authentication_root();
        if (empty($id)) {
            is_filtered_mod($data['sess']['validation']);
        }
        $data['active'] = empty($id) ? $data['sess']['gotcurrent']->mod_menu_id : null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['url_access'] = $this->url;
        if ($data['permit']->access_update == 1) {
            if (!empty($id)) {
                $data['equipt_transaction'] = $id;
            }
        }
        $data['content'] = $this->view_path . "entry/index";
        $this->load->view("../index", $data);
    }

    public function out($id = null) {
        $data['sess'] = $this->authentication_root();
        if (empty($id)) {
            is_filtered_mod($data['sess']['validation']);
        }
        $data['active'] = empty($id) ? $data['sess']['gotcurrent']->mod_menu_id : null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['url_access'] = $this->url;
        if ($data['permit']->access_update == 1) {
            if (!empty($id)) {
                $data['equipt_transaction'] = $id;
            }
        }
        $data['content'] = $this->view_path . "exit/index";
        $this->load->view("../index", $data);
    }

    public function info($start = null, $end = null, $ct = null, $project = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (!empty($start) && !empty($end) && !empty($ct)) {
            $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
            $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
            $data['category'] = $this->crud_model->read_data("transaction_ct", array("md5(transaction_ct_id)" => $ct))->row();
            $data['show'] = $this->crud_model->read_data("equipt_transaction eq", array("md5(eq.transaction_ct_id)" => $ct, "DATE(eq.equipt_transaction_date) >=" => date2mysql($data['starts']), "DATE(eq.equipt_transaction_date) <=" => date2mysql($data['ends']), "md5(eq.project_id)" => !empty($project) ? $project : md5(1)), array("eq.equipt_transaction_id" => "DESC"), array("actor ac" => "ac.actor_id = eq.actor_id"), null, null, "*, (select count(equipt_transaction_dt_id) from equipt_transaction_dt where equipt_transaction_id = eq.equipt_transaction_id and equipt_transaction_dt_status != 0) as item_usage")->result();
            $this->load->view("warehouse/info/equipt_transaction/data", $data);
        } else {
            $data['project'] = $this->origin_model->proByAccess($data['sess']['users_id']);
            $data['show'] = $this->origin_model->transEq();
            $this->load->view("warehouse/info/equipt_transaction/index", $data);
        }
    }

    public function process($ct = null, $project = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (!empty($ct)) {
            $data['category'] = $this->crud_model->read_data("transaction_ct", array("md5(transaction_ct_id)" => $ct))->row();
            $data['show'] = $this->crud_model->read_data("equipt_transaction eq", array("md5(eq.transaction_ct_id)" => $ct, "eq.equipt_transaction_status" => 0, "md5(eq.project_id)" => !empty($project) ? $project : md5(1)), array("eq.equipt_transaction_id" => "DESC"), array("actor ac" => "ac.actor_id = eq.actor_id"), null, null, "*, (select count(equipt_transaction_dt_id) from equipt_transaction_dt where equipt_transaction_id = eq.equipt_transaction_id) as item_usage")->result();
            $this->load->view("warehouse/info/equipt_transaction/data_process", $data);
        } else {
            $data['project'] = $this->origin_model->proByAccess($data['sess']['users_id']);
            $data['show'] = $this->origin_model->transEq();
            $this->load->view("warehouse/info/equipt_transaction/index_process", $data);
        }
    }

    public function detail_process($id) {
        $data['sess'] = $this->authentication_root();
        $data['mog'] = $this->crud_model->read_data("equipt_transaction et", array("md5(et.equipt_transaction_id)" => $id), null, array("actor ac" => "ac.actor_id = et.actor_id", "users ur" => "ur.users_id = et.users_id", "employee ep" => "ep.employee_id = ur.employee_id"))->row();
        $data['mog_dt'] = $this->crud_model->read_data("equipt_transaction_dt etd", array("md5(etd.equipt_transaction_id)" => "$id"), array("etd.equipt_transaction_dt_id" => "DESC"), array("code cde" => array("cde.code_id = etd.code_id", "LEFT"), "equipment eq" => "eq.equipment_id = etd.equipment_id", "equipment_ct eqc" => "eqc.equipment_ct_id = eq.equipment_ct_id", "equipment_unit eu" => "eu.equipment_unit_id = eq.equipment_unit_id"))->result();
        $this->load->view("warehouse/info/equipt_transaction/detail_process", $data);
    }

    public function detail($id) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['mog'] = $this->crud_model->read_data("equipt_transaction et", array("md5(et.equipt_transaction_id)" => $id), null, array("actor ac" => "ac.actor_id = et.actor_id", "users ur" => "ur.users_id = et.users_id", "employee ep" => "ep.employee_id = ur.employee_id"))->row();
        $data['mog_dt'] = $this->crud_model->read_data("equipt_transaction_dt etd", array("md5(etd.equipt_transaction_id)" => "$id", "equipt_transaction_dt_status !=" => 0), array("etd.equipt_transaction_dt_id" => "DESC"), array("code cde" => array("cde.code_id = etd.code_id", "LEFT"), "equipment eq" => "eq.equipment_id = etd.equipment_id", "equipment_ct eqc" => "eqc.equipment_ct_id = eq.equipment_ct_id", "equipment_unit eu" => "eu.equipment_unit_id = eq.equipment_unit_id"))->result();
        $this->load->view("warehouse/info/equipt_transaction/detail", $data);
    }

    public function form($feature = NULL, $id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['transaction_ct'] = $feature == 'entry' ? 1 : 2;
        $data['url_access'] = "$this->url";

        $data['actor']['ct'] = $this->crud_model->read_fordata(array("table" => "actor_category", "where" => array("actor_category_id" => 1), "or_where" => array("actor_category_id" => 2)))->result();
        foreach ($data['actor']['ct'] as $i => $r) {
            $data['actor']['act'][$i] = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_category_id" => $r->actor_category_id, "actor_status" => 1), "order" => array("actor_id" => "desc")))->result();
        }

        if ($feature == 'entry') {
            $data['url_action'] = $this->url . 'bapp/save/' . $id;
            if (!empty($id)) {
                if ($data['permit']->access_update == 1) {
                    $data['equipt_transaction'] = $id;
                    $data['equipt_trans_dt'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction et", "join" => array("project p" => "p.project_id = et.project_id", "actor a" => "a.actor_id = et.actor_id"), "where" => array("md5(et.equipt_transaction_id)" => $id)))->row();
                    $data['equipment'] = $this->crud_model->read_fordata(array("table" => "equipment", "where" => array("equipment_status" => 1)))->result();
                    $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 2, "code_status" => 1)))->result();
                    $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
                }
            } else {
                $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
                $data['equipment'] = $this->crud_model->read_fordata(array("table" => "equipment", "where" => array("equipment_status" => 1)))->result();
            }
            if ($data['permit']->access_special == 1) {
                $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 2, "code_status" => 1)))->result();
                $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
                $data['equipment'] = $this->crud_model->read_fordata(array("table" => "equipment", "where" => array("equipment_status" => 1)))->result();
            }
            $this->load->view($this->view_path . "entry/equipment_form", $data);
        } else if ($feature == 'exit') {
            $data['url_action'] = $this->url . 'bpp/save/' . $id;
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 2, "code_status" => 1)))->result();
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
            if ($data['permit']->access_update == 1) {
                if (!empty($id)) {
                    $data['feature'] = 'exit';
                    $data['equipt_trans'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction et", "join" => array("project p" => "p.project_id = et.project_id", "actor a" => "a.actor_id = et.actor_id"), "where" => array("md5(et.equipt_transaction_id)" => $id)))->row();
                }
            }

            $this->load->view($this->view_path . "exit/equipment_form", $data);
        }
    }

    public function get_detail($id, $project_id) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_update == 1 && !empty($id)) {
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 2)))->result();
            $data['equipt_trans_dt'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction_dt dt", "where" => array("md5(dt.equipt_transaction_id)" => $id, "md5(esf.project_id)" => $project_id, "equipt_transaction_dt_status !=" => 0), "join" => array("equipment e" => "e.equipment_id = dt.equipment_id", "equipment_unit eu" => "eu.equipment_unit_id = e.equipment_unit_id", "equipt_transaction et" => "et.equipt_transaction_id = dt.equipt_transaction_id", "equipment_stock_final esf" => "esf.equipment_id = e.equipment_id and esf.actor_id = et.actor_id")))->result();
            print_r($data['equipt_trans_dt']);
            $this->load->view($this->view_path . "exit/equipment_transaction_dt", $data);
        }
    }

    public function equipment_by_project($id_project = NULL, $actor = NULL, $counter = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['counter'] = $counter;
        $data['equipment'] = $this->crud_model->read_fordata(array("table" => "equipment e", "join" => array("equipment_stock_final esf" => "esf.equipment_id = e.equipment_id"), "where" => array("project_id" => $id_project, "actor_id" => $actor, "equipment_stock_final_rest >" => 0, "e.equipment_status" => 1), "group" => "esf.equipment_id"))->result();
        $this->load->view($this->view_path . "exit/select_equipment", $data);
    }

    public function equipment_transaction($date = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $date = date('Y-m-d', strtotime($date));
        $data['equipt_transaction'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction et", "where" => array("transaction_ct_id" => 2, "equipt_transaction_status" => "0"), "like" => array("equipt_transaction_date" => "$date"), "join" => array("project p" => "p.project_id = et.project_id")))->result();
        $this->load->view($this->view_path . "return/equipment_transaction", $data);
    }

    public function equipment_maintenance($project_id = NULL, $counter = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['counter'] = $counter;
        $data['equipment'] = $this->crud_model->read_fordata(array("table" => "equipment e", "where" => array("e.equipment_status" => 1), "join" => array("equipment_stock_final esf" => "esf.equipment_id = e.equipment_id"), "group" => "e.equipment_id"))->result();
        $this->load->view($this->view_path . "maintenance/select_equipment", $data);
    }

    public function get_unit($id = NULL) {
        $data = $this->crud_model->read_fordata(array("table" => "equipment e", "join" => array("equipment_unit eu" => "eu.equipment_unit_id = e.equipment_unit_id"), "where" => array("e.equipment_id" => $id, "e.equipment_status" => 1)))->row();
        echo json_encode(array('status' => 1, 'data' => $data));
    }

    public function get_stok($id = NULL, $actor = NULL, $project_id = NULL) {
        $data = $this->crud_model->read_fordata(array("table" => "equipment e", "join" => array("equipment_unit eu" => "eu.equipment_unit_id = e.equipment_unit_id", "equipment_stock_final esf" => "esf.equipment_id = e.equipment_id"), "where" => array("esf.actor_id" => $actor, "e.equipment_id" => $id, "esf.project_id" => $project_id, "e.equipment_status" => 1)))->row();
        echo json_encode(array('status' => 1, 'data' => $data));
    }

    public function transaction_detail($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['equipt_transaction_id'] = $id;
        $data['equipt_trans'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction_dt dt", "where" => array("dt.equipt_transaction_id" => $id), "join" => array("equipment e" => "e.equipment_id = dt.equipment_id", "equipment_unit eu" => "eu.equipment_unit_id = e.equipment_unit_id", "equipt_transaction et" => "et.equipt_transaction_id = dt.equipt_transaction_id")))->result();
        $this->load->view($this->view_path . "return/equipment_transaction_dt", $data);
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;

        $child = "(select count(transaction_entry_id) from transaction_entry_stok where transaction_entry_id = e.transaction_entry_id) as child";
        $data['show'] = $this->crud_model->read_fordata(array("table" => "transaction_entry e", "select" => array("*", $child), "join" => array("transaction_entry_ct ec" => "ec.transaction_entry_ct_id = e.transaction_entry_ct_id")))->result();

        $this->load->view("warehouse/master/transaction_entry/transaction_entry_table", $data);
    }

    public function get_transaction_detail($id = NULL) {
        if (!empty($id)) {
            $data['sess'] = $this->authentication_root();
            $data['permit'] = $data['sess']['permit'];
            $data['equipt_transaction_status'] = $this->crud_model->read_fordata(array("select" => "equipt_transaction_status", "table" => "equipt_transaction", "where" => array("md5(equipt_transaction_id)" => $id)))->row()->equipt_transaction_status;
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 2, "code_status" => 1)))->result();
            $data['trans_dt'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction_dt dt", "join" => array("equipment e" => "e.equipment_id = dt.equipment_id", "equipment_unit eu" => "eu.equipment_unit_id = e.equipment_unit_id"), "where" => array("md5(equipt_transaction_id)" => $id, "equipt_transaction_dt_status !=" => 0)))->result();
            $this->load->view($this->view_path . "entry/transaction_detail", $data);
        }
    }

    public function get_transaction($id = NULL) {
        if (!empty($id)) {
            $eq = $this->crud_model->read_fordata(array("table" => "equipt_transaction et", "where" => array("md5(equipt_transaction_id)" => $id), "join" => array("project p" => "p.project_id = et.project_id", "actor a" => "a.actor_id = et.actor_id")))->row();
            echo json_encode(array('status' => 1, 'eq' => $eq));
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $equipment = array_filter($this->input->post('equipment'));
        $volume = array_filter($this->input->post('volume'));
        $price = $this->input->post('price') ? array_filter($this->input->post('price')) : NULL;
        $status = $this->input->post('status') ? array_filter($this->input->post('status')) : NULL;
        $code = $this->input->post('code') ? array_filter($this->input->post('code')) : NULL;
        $condition = $this->input->post('condition') ? array_filter($this->input->post('condition')) : NULL;
        $note = $this->input->post('note') ? array_filter($this->input->post('note')) : NULL;
        $date = NULL;
            $trans_dt_id = array_filter($this->input->post('equipt_transaction_dt'));

        $action = $this->input->post('action');

        $equipt['transaction_ct_id'] = $this->input->post('transaction_ct');
        $equipt['users_id'] = $this->crud_model->read_fordata(array("table" => "users", "where" => array("md5(users_id)" => $data['sess']['users_id'])))->row()->users_id;
        if ($this->input->post("equipt_transaction")) {
            $equipt['equipt_transaction_rent_id'] = $this->input->post("equipt_transaction");
        }
        if (in_array($equipt['transaction_ct_id'], array(2, 3))) {
            $equipt['equipt_transaction_status'] = 0;
        }
        $equipt['project_id'] = $this->input->post("project");
        $equipt['actor_id'] = $this->input->post("actor") ? $this->input->post("actor") : NULL;
        $equipt['equipt_transaction_number'] = $this->input->post("equipt_transaction_number") ? $this->input->post("equipt_transaction_number") : NULL;
        $equipt['equipt_transaction_letter'] = $this->input->post("equipt_transaction_letter") ? $this->input->post("equipt_transaction_letter") : NULL;
        $equipt['equipt_transaction_car'] = $this->input->post("equipt_transaction_car") ? strtoupper($this->input->post("equipt_transaction_car")) : NULL;
        $equipt['equipt_transaction_driver'] = $this->input->post("equipt_transaction_driver") ? $this->input->post("equipt_transaction_driver") : NULL;
        $equipt['equipt_transaction_driver_identity'] = $this->input->post("equipt_transaction_driver_identity") ? $this->input->post("equipt_transaction_driver_identity") : NULL;
//        $equipt['equipt_transaction_date_verify'] = $this->input->post("equipt_transaction_date_verify") ? date('Y-m-d H:i:s', strtotime($this->input->post("equipt_transaction_date_verify"))) : NULL;
        $equipt['equipt_transaction_total'] = $this->input->post("equipt_transaction_total") ? str_replace('.', '', $this->input->post("equipt_transaction_total")) : NULL;
        if (!empty($id)) {
            $sts = $price || $equipt['transaction_ct_id'] == 2 ? 1 : 0;
        } else if ($equipt['transaction_ct_id'] == 2) {
            $sts = 1;
        } else {
            $sts = $data['permit']->access_special == 1 || $price ? 1 : 0;
        }

        $equipt['equipt_transaction_status'] = $sts;

        if (isset($equipt)) {
            $stus = $equipt['transaction_ct_id'] == 1 ? "BAPP" : "BPP";
            $actor = $this->crud_model->read_data("actor", array("actor_id" => $equipt['actor_id']))->row();
            if (empty($id)) {
                $where['project_id'] = $equipt['project_id'];
                $where['actor_id'] = $equipt['actor_id'];
                $where['equipt_transaction_number'] = $equipt['equipt_transaction_number'];
//                $where['equipt_transaction_letter'] = $equipt['equipt_transaction_letter'];

                if ($this->input->post("equipt_transaction")) {
                    $where['md5(equipt_transaction_rent_id) !='] = $this->input->post("equipt_transaction");
                    $duplicate = $this->crud_model->read_fordata(array("table" => "equipt_transaction", "where" => $where))->num_rows();
                    if ($data['permit']->access_special == 1) {
                        $equipt['equipt_transaction_status'] = 1;
                        $equipt['equipt_transaction_date_verify'] = date('Y-m-d H:i:s');
                    }
                    $updt['equipt_transaction_id'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction", "where" => array("md5(equipt_transaction_id)" => $this->input->post("equipt_transaction"))))->row()->equipt_transaction_id;
                    $updt['equipt_transaction_status'] = 1;
                    $this->crud_model->update_data('equipt_transaction', $updt, 'equipt_transaction_id');
                    $this->recActivity("Updated $stus No. <b>$equipt[equipt_transaction_number] (<i>$actor->actor_name</i>)</b> on Transaction $stus", "warehouse");
                } else {
                    // jika tidak maintenis data akan dicek duplikasi
                    if ($equipt['transaction_ct_id'] == 3) {
                        $duplicate = 0;
                    } else {
                        $duplicate = $this->crud_model->read_fordata(array("table" => "equipt_transaction", "where" => $where))->num_rows();
                    }

                    if ($duplicate == 0) {
                        if ($data['permit']->access_special == 1) {
                            $equipt['equipt_transaction_status'] = 1;
                            $equipt['equipt_transaction_date_verify'] = date('Y-m-d H:i:s');
                        }
                        $equipt['equipt_transaction_date'] = $this->input->post("date") ? date('Y-m-d', strtotime($this->input->post("date"))) : date('Y-m-d H:i:s');
                        $this->crud_model->insert_data("equipt_transaction", $equipt);
                        $this->recActivity("Created $stus No. <b>$equipt[equipt_transaction_number] (<i>$actor->actor_name</i>)</b> on Transaction $stus", "warehouse");
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>/button><i class='fa fa-info-circle mg-r-md'></i>Material Receipt failed saved</div>"));
                        exit();
                    }
                }
            } else {
                $transaction_entry = $this->crud_model->read_data("equipt_transaction", array("md5(equipt_transaction_id)" => $id))->row();
                $equipt['equipt_transaction_id'] = $transaction_entry->equipt_transaction_id;
                if ($data['permit']->access_special == 1) {
                    $equipt['equipt_transaction_status'] = 1;
                    $equipt['equipt_transaction_date_verify'] = date('Y-m-d H:i:s');
                }
                $this->crud_model->update_data("equipt_transaction", $equipt, "equipt_transaction_id");
//                $actions = "ubah";

                if ($data['permit']->access_special == 1) {
                    $diff_volume = array_filter($this->input->post('diff_volume'));
                    $status_volume = array_filter($this->input->post('status_volume'));
                }
            }
        }
        for ($in = 0; $in < count($equipment); $in++) {

            if (isset($equipment[$in]) || isset($volume[$in])) {
                $equipt_dt[$action[$in]]['equipment_id'] = $equipment[$in];
                $equipt_dt[$action[$in]]['equipt_transaction_dt_volume'] = $volume[$in];
                $equipt_dt[$action[$in]]['equipt_transaction_dt_condition'] = !empty($condition[$in]) ? $condition[$in] : NULL;
                $equipt_dt[$action[$in]]['equipt_transaction_dt_price'] = !empty($price) ? str_replace('.', '', $price[$in]) : NULL;
                $equipt_dt[$action[$in]]['equipt_transaction_dt_status'] = !empty($status) ? $status[$in] : NULL;
                $equipt_dt[$action[$in]]['equipt_transaction_dt_note'] = isset($note[$in]) ? $note[$in] : NULL;
                $equipt_dt[$action[$in]]['code_id'] = !empty($code) ? $code[$in] : NULL;

                if ($action[$in] == 'edit') {
                    $data_status = $this->input->post('data_status');
                    if (isset($trans_dt_id[$in])) {
                        if ($data_status[$in] == 0) {
                            $equipt_dt[$action[$in]]['equipt_transaction_dt_status'] = $data_status[$in];
                        }
                        $equipt_dt[$action[$in]]['equipt_transaction_dt_id'] = $trans_dt_id[$in];
                        $this->crud_model->update_data('equipt_transaction_dt', $equipt_dt['edit'], 'equipt_transaction_dt_id');
                    }
                } else if ($action[$in] == 'add') {
                    $equipt_trans_id = $this->crud_model->read_fordata(array("table" => "equipt_transaction", "where" => array("equipt_transaction_number" => $equipt['equipt_transaction_number'])))->row()->equipt_transaction_id;
                    $equipt_dt[$action[$in]]['equipt_transaction_id'] = $equipt_trans_id;
                    $this->crud_model->insert_data('equipt_transaction_dt', $equipt_dt['add']);
                }


                $stock_final = $this->crud_model->read_fordata(array("table" => "equipment_stock_final", "where" => array("equipment_id" => $equipment[$in], "project_id" => $this->input->post("project"), "actor_id" => $this->input->post("actor"))));

                if ($stock_final->num_rows() == 0) {
                    $stock_fn['insert']['actor_id'] = $equipt['actor_id'];
                    $stock_fn['insert']['project_id'] = $this->input->post("project");
                    $stock_fn['insert']['equipment_id'] = $equipment[$in];
                    $stock_fn['insert']['equipment_stock_final_date'] = date('Y-m-d');
                    $stock_fn['insert']['equipment_stock_final_rest'] = $volume[$in];

                    $this->crud_model->insert_data("equipment_stock_final", $stock_fn['insert']);

                    $stock['equipment_stock_rest'] = $stock_fn['insert']['equipment_stock_final_rest'];
                } else {
                    $row = $stock_final->row();

                    $stock_fn['update']['equipment_stock_final_id'] = $row->equipment_stock_final_id;
                    $stock_fn['update']['equipment_stock_final_date'] = date('Y-m-d');

                    if ($data['permit']->access_update == 1 && $action[$in] == 'edit') {

                        if ($equipt_dt[$action[$in]]['equipt_transaction_dt_status'] == 0) {
                            $del_stock_fn['equipment_stock_final_id'] = $stock_fn['update']['equipment_stock_final_id'];
                            if ($equipt['transaction_ct_id'] == 1) {
                                $del_stock_fn['equipment_stock_final_rest'] = $row->equipment_stock_final_rest - $volume[$in];
                                $del_stock['equipment_stock_exit'] = $volume[$in];
                            } else {
                                $del_stock['equipment_stock_entry'] = $volume[$in];
                                $del_stock_fn['equipment_stock_final_rest'] = $row->equipment_stock_final_rest + $volume[$in];
                            }
                            $this->crud_model->update_data("equipment_stock_final", $del_stock_fn, 'equipment_stock_final_id');

                            $del_stock['equipt_transaction_id'] = $equipt['equipt_transaction_id'];
                            $del_stock['project_id'] = $this->input->post("project");
                            $del_stock['actor_id'] = $equipt['actor_id'];
                            $del_stock['equipment_id'] = $equipt_dt[$action[$in]]['equipment_id'];
                            $del_stock['equipment_stock_date'] = date('Y-m-d H:i:s');
                            $del_stock['equipment_stock_rest'] = $del_stock_fn['equipment_stock_final_rest'];
                            $del_stock['equipment_stock_price'] = !empty($price) ? str_replace('.', '', $price[$in]) : NULL;

                            $this->crud_model->insert_data("equipment_stock", $del_stock);
                        }

                        if (isset($status_volume[$in])) {
                            if ($status_volume[$in] == 2) {
                                $stock_fn['update']['equipment_stock_final_rest'] = str_replace('.', '', $diff_volume[$in]) + $row->equipment_stock_final_rest;
                            } else if ($status_volume[$in] == 3) {
                                $stock_fn['update']['equipment_stock_final_rest'] = $row->equipment_stock_final_rest - str_replace('.', '', $diff_volume[$in]);
                            }
                            $this->crud_model->update_data("equipment_stock_final", $stock_fn['update'], 'equipment_stock_final_id');
                        }
                    } else {
                        if ($this->input->post('transaction_ct') == 1 || $this->input->post("equipt_transaction")) {
                            $stock_fn['update']['equipment_stock_final_rest'] = $volume[$in] + $row->equipment_stock_final_rest;
                        } else if (in_array($equipt['transaction_ct_id'], array(2, 3)) && !$this->input->post("equipt_transaction")) {
                            $stock_fn['update']['equipment_stock_final_rest'] = $row->equipment_stock_final_rest - $volume[$in];
                        }
                        $this->crud_model->update_data("equipment_stock_final", $stock_fn['update'], 'equipment_stock_final_id');
                    }
                    $stock['equipment_stock_rest'] = isset($stock_fn['update']['equipment_stock_final_rest']) ? $stock_fn['update']['equipment_stock_final_rest'] : NULL;
                }

                if (!empty($id)) {
                    $stock['equipt_transaction_id'] = $equipt['equipt_transaction_id'];
                } else {
                    $stock['equipt_transaction_id'] = $equipt_trans_id;
                }

                $stock['project_id'] = $this->input->post("project");
                $stock['actor_id'] = $equipt['actor_id'];
                $stock['equipment_id'] = $equipment[$in];

                if ($data['permit']->access_update == 1 && $action[$in] == 'edit') {
                    if (isset($status_volume[$in])) {
                        if ($status_volume[$in] == 2) {
                            $stock['equipment_stock_entry'] = str_replace('.', '', $diff_volume[$in]);
                        } else if ($status_volume[$in] == 3) {
                            $stock['equipment_stock_exit'] = str_replace('.', '', $diff_volume[$in]);
                        }

                        $stock['equipment_stock_date'] = date('Y-m-d');
                    }
                } else {
                    if ($this->input->post('transaction_ct') == 1 || $this->input->post("equipt_transaction")) {
                        $stock['equipment_stock_entry'] = $volume[$in];
                    } else if (in_array($equipt['transaction_ct_id'], array(2, 3)) && !$this->input->post("equipt_transaction")) {
                        $stock['equipment_stock_exit'] = $volume[$in];
                    }
                    $stock['equipment_stock_date'] = date('Y-m-d H:i:s');
                }

                $stock['equipment_stock_price'] = !empty($price) ? str_replace('.', '', $price[$in]) : NULL;

                if ($data['permit']->access_update == 1 && $action[$in] == 'edit') {
                    if (isset($status_volume[$in])) {
                        $this->crud_model->insert_data("equipment_stock", $stock);
                    }
                } else {
                    $this->crud_model->insert_data("equipment_stock", $stock);
                }
            }
        }
        if ($equipt['transaction_ct_id'] == 1) :
            $this->session->set_flashdata("msgTransEq", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Data BAPP - Equipment Receipt successfully saved</div>");
        else:
            $this->session->set_flashdata("msgTransEq", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Data BPP - Equipment Return successfully saved</div>");
        endif;
        if (!empty($id)) {
            $ids = $id;
        } else {
            $idx = $this->crud_model->read_data("equipt_transaction", array("transaction_ct_id" => $equipt['transaction_ct_id']))->last_row();
            $ids = md5($idx->equipt_transaction_id);
        }
        echo json_encode(array('status' => 1, "id" => $ids));
    }

    public function get_equipment($project = null, $counter = null) {
        $data['count'] = $counter;
        $data['show'] = $this->crud_model->read_fordata(array("table" => "equipment", "order" => array("equipment_name" => "ASC")))->result();
        $this->load->view("warehouse/transaction/equipment/extend/equipment", $data);
    }

    public function delete($id = NULL) {
        if (!empty($id)) {
            $get_etrans = $this->crud_model->read_fordata(array("table" => "equipt_transaction et", "join" => array("actor a" => "a.actor_id = et.actor_id"), "where" => array("md5(et.equipt_transaction_id)" => $id)))->row();
            $get_dt = $this->crud_model->read_fordata(array("table" => "equipt_transaction_dt dt", "where" => array("md5(equipt_transaction_id)" => $id)))->result();

            $data['equipt_transaction_id'] = $get_etrans->equipt_transaction_id;
            foreach ($get_dt as $dt) {
                $stock_final = $this->crud_model->read_fordata(array("table" => "equipment_stock_final", "where" => array("project_id" => $get_etrans->project_id, "equipment_id" => $dt->equipment_id)))->row();

                $stock_fn['equipment_stock_final_id'] = $stock_final->equipment_stock_final_id;
                if ($get_etrans->transaction_ct_id == 1) {
                    $stock_fn['equipment_stock_final_rest'] = $stock_final->equipment_stock_final_rest - $dt->equipt_transaction_dt_volume;
                } else if ($get_etrans->transaction_ct_id == 2) {
                    $stock_fn['equipment_stock_final_rest'] = $stock_final->equipment_stock_final_rest + $dt->equipt_transaction_dt_volume;
                }
                $this->crud_model->update_data("equipment_stock_final", $stock_fn, "equipment_stock_final_id");

                $get_stock = $this->crud_model->read_fordata(array("table" => "equipment_stock", "where" => array("project_id" => $get_etrans->project_id, "equipment_id" => $dt->equipment_id)))->last_row();
                $stock['equipment_stock_rest'] = $stock_fn['equipment_stock_final_rest'];
                $stock['equipment_stock_id'] = $get_stock->equipment_stock_id;
                $this->crud_model->update_data("equipment_stock", $stock, "equipment_stock_id");
            }
            $stus = $get_etrans->transaction_ct_id == 1 ? "BAPP" : "BPP";
            $this->recActivity("Deleted $stus No. <b>$get_etrans->equipt_transaction_number (<i>$get_etrans->actor_name</i>)</b> of $stus Information", "warehouse");
            $this->crud_model->delete_data("equipment_stock", $data);
            $this->crud_model->delete_data("equipt_transaction_dt", $data);
            $this->crud_model->delete_data("equipt_transaction", $data);

            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Equipment successfully removed</div>");
            echo json_encode(array("status" => 1));
        }
    }

}

?>
