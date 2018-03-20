<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Work_order extends MY_Controller {

    private $title = "Work Order";
    private $url = "procurement/work_order/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();
        $data['content'] = "procurement/transaction/work_order/index";
        $this->load->view("../index", $data);
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (in_array(1, array($data['permit']->access_create, $data['permit']->access_update))) {
            $data['act'] = (empty($id)) ? "add" : "edit";
            $data['header'] = $this->title;
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
            $data['actor'] = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_category_id" => "2", "actor_status" => 1)))->result();
            
            if (!empty($id)) {
                $data['wo'] = $this->crud_model->read_fordata(array("table" => "work_order wo", "join" => array("project p" => "p.project_id = wo.project_id", "actor a" => "a.actor_id = wo.actor_id"), "where" => array("md5(wo.work_order_id)" => $id)))->row();
            }
            $this->load->view("procurement/transaction/work_order/form", $data);
        }
    }

    public function extra($id = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['header'] = $this->title;
        if (!empty($id)) {
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();
            $data['wo'] = $this->crud_model->read_fordata(array("table" => "work_order wo", "join" => array("project p" => "p.project_id = wo.project_id", "actor a" => "a.actor_id = wo.actor_id"), "where" => array("md5(wo.work_order_id)" => $id)))->row();
            $this->load->view("procurement/transaction/work_order/extra", $data);
        }
    }

    public function info($parameter = NULL, $searchby = NULL) {
        $data['sess'] = $this->authentication_root();
        if (empty($parameter) || empty($searchby)) {
            $data['title'] = $this->title;
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();
            $data['subcon'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("work_order wo" => "wo.actor_id = a.actor_id"), "where" => array("actor_category_id" => 2), "group" => "a.actor_id"))->result();
            $data['content'] = "procurement/info/work_order/index";
            $this->load->view($data['content'], $data);
        } else {
            $data['sess'] = $this->authentication_root();
            if($searchby == 1) {
                $where = 'project_id';
            } else if($searchby == 2) {
                $where = 'a.actor_id';
            }
            $child = "(select sum(invoice_netto) from invoice i join invoice_wo iw on (i.invoice_id = iw.invoice_id) where work_order_id = wo.work_order_id and invoice_wo_ct_id = 2) as total_paid";
            $child2 = "(select max(invoice_wo_percent) from invoice i join invoice_wo iw on (i.invoice_id = iw.invoice_id) where work_order_id = wo.work_order_id and invoice_wo_ct_id = 2) as progres";
            $data["show"] = $this->crud_model->read_data("work_order wo", array("md5($where)" => !empty($parameter) ? $parameter : md5(1), "a.actor_category_id" => 2), array("wo.work_order_id" => "DESC"), array("actor a" => "a.actor_id = wo.actor_id", "actor_category ac" => "ac.actor_category_id = a.actor_category_id"), NULL, NULL, array("*", $child, $child2))->result();
            $this->load->view("procurement/info/work_order/table", $data);
        }
    }

    public function detail($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_update == 1) {
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
            if (!empty($id)) {
                $data['wo'] = $this->crud_model->read_fordata(array("table" => "work_order wo", "join" => array("project p" => "p.project_id = wo.project_id", "actor a" => "a.actor_id = wo.actor_id"), "where" => array("md5(wo.work_order_id)" => $id)))->row();
            }
            $this->load->view("procurement/transaction/work_order/detail", $data);
        }
    }

    public function table($start = null, $end = null, $project = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_update == 1) {
            $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
            $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
            $child = "(select count(work_order_id) from invoice where work_order_id = wo.work_order_id) as child";
            $data["show"] = $this->crud_model->read_data("work_order wo", array("md5(project_id)" => !empty($project) ? $project : md5(1), "a.actor_category_id" => 2, "DATE(wo.work_order_date) >=" => date2mysql($data['starts']), "DATE(wo.work_order_date) <=" => date2mysql($data['ends'])), array("wo.work_order_id" => "DESC"), array("actor a" => "a.actor_id = wo.actor_id", "actor_category ac" => "ac.actor_category_id = a.actor_category_id"), NULL, NULL, array("*", $child))->result();
            $this->load->view("procurement/transaction/work_order/table", $data);
        }
    }

    public function save($id = NULL) {
        $sess = $this->authentication_root();
        if (!$this->input->post("ex_mode")) {
            if($this->input->post("actor_input") == 2) {
                $supp['actor_category_id'] = 2;
                $supp['actor_name'] = $this->input->post("actor_name");
                $supp['actor_identity'] = $this->input->post("actor_identity");
                $supp['actor_phone'] = $this->input->post("actor_phone");
                $supp['actor_address'] = $this->input->post("actor_address");
                if ($this->input->post("actor_id")) {
                    $supp['actor_id'] = $this->input->post("actor_id");
                    $this->crud_model->update_data("actor", $supp, "actor_id");
                } else {
                    $duplicate = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_name" => $supp['actor_name'], "actor_category_id" => $supp['actor_category_id'])))->num_rows();
                    $names = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_name" => $supp['actor_name'])))->num_rows();
                    $npwp = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_identity" => $supp['actor_identity'])))->num_rows();
                    if ($duplicate == 0 && $npwp == 0 && $names == 0) {
                        $this->crud_model->insert_data("actor", $supp);
                        $this->recActivity("Created <b>$supp[actor_name]</b> on Work Order", "procurement");
                        $wo['actor_id'] = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_category_id" => 2)))->last_row()->actor_id;
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Sub Contractor already exist </div>"));
                        exit();
                    }
                }
            } else {
                $wo['actor_id'] = $this->input->post("actor");
            }
            $wo['users_id'] = $sess['users']->users_id;
            $wo['project_id'] = $this->input->post("project");
            $wo['work_order_number'] = $this->input->post("contract_num");
            $wo['work_order_desc'] = $this->input->post("wo_desc");
            $wo['work_order_contract'] = str_replace(".", "", $this->input->post("contract"));
            $wo['work_order_dp'] = $this->input->post("dp");
            $wo['work_order_retensi'] = $this->input->post("retensi");
            $wo['work_order_date'] = date("Y-m-d H:i:s");
            $wo['work_order_date_fn'] = null;
            $wo['work_order_status'] = 0;
        } else {
            $actions = "Updated";
            $wo['work_order_extra_mode'] = $this->input->post("ex_mode");
            if ($this->input->post("extra") != null) {
                $wo['work_order_extra'] = str_replace(".", "", $this->input->post("extra"));
                $actions = "Inserted Extra work";
            }
            $wo['work_order_date_fn'] = date("Y-m-d H:i:s");
//            $wo['work_order_status'] = 1;
        }
        if (isset($wo)) {
            if (empty($id)) {
                $this->crud_model->insert_data("work_order", $wo);
                $this->recActivity("Created <b>$wo[work_order_desc] ($wo[work_order_number])</b> on Work Order", "procurement");
                $actions = "tambah";
                $woid = $this->crud_model->read_data("work_order")->last_row()->work_order_id;
            } else {
                $woCtrl = $this->crud_model->read_data("work_order", array("md5(work_order_id)" => $id))->row();
                $wo['work_order_id'] = $woCtrl->work_order_id;
                $this->crud_model->update_data("work_order", $wo, "work_order_id");
                $actions = "edit";
                $this->recActivity("$actions <b>$woCtrl->work_order_desc ($woCtrl->work_order_number)</b> on Work Order", "procurement");
                $woid = $woCtrl->work_order_id;
            }
        } else {
            echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Work order already exist </div>"));
            exit();
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Work Order saved successfully</div>");
        echo json_encode(array('status' => 1, "id" => md5($woid)));
    }

    public function delete($work_order_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $invCheck = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("md5(work_order_id)" => $work_order_id)))->num_rows();
            if ($invCheck == 0) {
                $wo = $this->crud_model->read_data("work_order", array("md5(work_order_id)" => "$work_order_id"))->row();
                $this->recActivity("Deleted data <b>$wo->work_order_desc ($wo->work_order_number)</b> of Work Order", "procurement");
                $this->crud_model->delete_data("work_order", array("md5(work_order_id)" => "$work_order_id"));
                $this->session->set_flashdata("msg", "<div class='alert alert-success alert-dismissable row'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Work Order has been successfully removed</div>");
                echo json_encode(array("status" => 1));
            } else {
                echo json_encode(array("status" => 0, "msg" => "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Work Order can not removed</div>"));
            }
        }
    }

}

?>