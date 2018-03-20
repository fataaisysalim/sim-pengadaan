<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Equipment extends MY_Controller {

    private $title = "Equipment";
    private $header = "Equipment";
    private $url = "warehouse/equipment/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function index($ct = null) {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['url_access'] = $this->url;
        $data['content'] = "warehouse/master/equipment/index";
        $this->load->view("../index", $data);
    }

    public function info($ct = null, $status = null, $unit = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (!empty($ct)) {
            if (!empty($status)) {
                if ($status != 'all') {
                    $where['eq.equipment_status'] = $status == 'active' ? 1 : 0;
                }
            }
            if (!empty($unit)) {
                if ($unit != 'all') {
                    $where['eq.equipment_unit_id'] = $unit;
                }
            }
            $where['md5(eq.equipment_ct_id)'] = $ct;
            $data['show'] = $this->crud_model->read_data("equipment eq", $where, array("eq.equipment_id" => "DESC"), array("equipment_unit eu" => "eu.equipment_unit_id = eq.equipment_unit_id"))->result();
            $this->load->view("warehouse/info/equipment/data", $data);
        } else {
            $data['show'] = $this->origin_model->equipment();
            $this->load->view("warehouse/info/equipment/index", $data);
        }
    }

    public function detail($eq, $start = null, $end = null) {
        $starts = !empty($start) ? date("Y-m-d", strtotime($start)) : date("Y-m-d");
        $ends = !empty($end) ? date("Y-m-d", strtotime($end)) : date("Y-m-d");
        $data['sess'] = $this->authentication_root();
        $data['ct'] = $this->crud_model->read_data("equipment_ct", null, array("equipment_ct_id" => "DESC"))->result();
        $data['eq'] = $this->crud_model->read_data("equipment", array("md5(equipment_id)" => $eq))->row();
        $data['equipment'] = $this->crud_model->read_data("equipment_stock st", array("md5(st.equipment_id)" => $eq, "st.equipment_stock_date >=" => $starts, "st.equipment_stock_date <=" => $ends), null)->result();
        $this->load->view("warehouse/info/stock/equipment/detail", $data);
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (in_array(1, array($data['permit']->access_create, $data['permit']->access_update))) {
            $data['title'] = $this->title;
            $data['act'] = (empty($id)) ? "Add" : "Edit";
            $data['url_access'] = "$this->url";
            $data['url_action'] = $this->url . 'save/' . $id;
            $data['header'] = $this->header;
            $data['equipment_unit'] = $this->crud_model->read_fordata(array("table" => "equipment_unit"))->result();
            $data['equipment_ct'] = $this->crud_model->read_fordata(array("table" => "equipment_ct"))->result();

            if (!empty($id)) {
                $data["equipment_dt"] = $this->crud_model->read_fordata(array("table" => "equipment e", "where" => array("md5(equipment_id)" => $id), "join" => array("equipment_ct ec" => "ec.equipment_ct_id = e.equipment_ct_id")))->row();
            }

            $this->load->view("warehouse/master/equipment/equipment_form", $data);
        }
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $data['title'] = $this->title;
            $data['header'] = $this->header;

            $child = "(select count(equipment_id) from equipment_stock where equipment_id = e.equipment_id) as child";
            $data['show'] = $this->crud_model->read_fordata(array("table" => "equipment e", "select" => array("*", $child), "join" => array("equipment_ct ec" => "ec.equipment_ct_id = e.equipment_ct_id", "equipment_unit eu" => "eu.equipment_unit_id = e.equipment_unit_id")))->result();

            $this->load->view("warehouse/master/equipment/equipment_table", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $equ['equipment_unit_id'] = $this->input->post("equipment_unit");
        $equ['equipment_ct_id'] = $this->input->post("equipment_ct");
        $equ['equipment_name'] = ucwords($this->input->post("equipment_name"));
        $equ['equipment_type'] = $this->input->post("equipment_type");

        if ($this->input->post("equipment_ct") == '') :
            echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Equipment category is empty</div>"));
            exit();
        elseif ($this->input->post("equipment_unit") == '') :
            echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Equipment unit is empty</div>"));
            exit();
        endif;

        if (empty($id)) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "equipment", "where" => $equ))->num_rows();
            if ($duplicate == 0) {
                $this->crud_model->insert_data("equipment", $equ);
                $this->recActivity("Created <b>$equ[equipment_name]</b> on Master Equipment", "warehouse");
                $action = "tambah";
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Equipment already exist</div>"));
                exit();
            }
        } else {
            $equipment = $this->crud_model->read_data("equipment", array("md5(equipment_id)" => $id))->row();
            $equ['equipment_id'] = $equipment->equipment_id;
            $this->crud_model->update_data("equipment", $equ, "equipment_id");
            $this->recActivity("Updated <b>$equ[equipment_name]</b> on Master Equipment", "warehouse");
            $action = "ubah";
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Equipment successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function delete($equipment_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $get = $this->crud_model->read_data("equipment", array("md5(equipment_id)" => "$equipment_id"))->row();
            $this->recActivity("Deleted <b>$get->equipment_name</b> of Master Equipment", "warehouse");
            $this->crud_model->delete_data("equipment", array("md5(equipment_id)" => "$equipment_id"));
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Equipment successfully deleted</div>");
            echo json_encode(array("status" => 1));
        }
    }

    public function status($id, $status) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_special == 1) {
            $statuss = $status == 2 ? "nonactive" : "active";
            $get = $this->crud_model->read_data("equipment", array("equipment_id" => "$equipment_id"))->row();
            $this->recActivity("Changed status <b>$get->equipment_name</b> to $statuss on Master Equipment", "warehouse");
            $this->crud_model->update_data("equipment", array("equipment_status" => $status == 2 ? 0 : 1, "equipment_id" => $id), 'equipment_id');
            echo json_encode(array("status" => 1));
        }
    }

    public function unit($exe = null, $id = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = "Equipment Unit";
        $data['header'] = "Equipment Unit";
        if (empty($exe)) {
            $child = "(select count(equipment_unit_id) from equipment where equipment_unit_id = ec.equipment_unit_id) as child";
            $data['show'] = $this->crud_model->read_fordata(array("table" => "equipment_unit ec", "select" => array("*", $child)))->result();
            $this->load->view("warehouse/master/equipment/unit/table", $data);
        } else {
            if ($exe == "form") {
                $data['act'] = (empty($id)) ? "Add" : "Edit";
                $data['url_access'] = "$this->url";
                $data['url_action'] = $this->url . 'unit/saving/' . $id;
                if (!empty($id)) {
                    $data["equipment_unit_dt"] = $this->crud_model->read_data("equipment_unit", array("md5(equipment_unit_id)" => $id))->row();
                }

                $this->load->view("warehouse/master/equipment/unit/form", $data);
            } elseif ($exe == "saving") {
                $equ['equipment_unit_name'] = ucwords($this->input->post("equipment_unit_name"));
                if (empty($id)) {
                    $duplication = $this->crud_model->read_fordata(array("table" => "equipment_unit", "where" => array("equipment_unit_name" => ucwords($this->input->post("equipment_unit_name")))))->num_rows();
                    if ($duplication == 0) {
                        $this->crud_model->insert_data("equipment_unit", $equ);
                        $this->recActivity("Created <b>$equ[equipment_unit_name]</b> on Master Equipment Unit", "warehouse");
                        $action = "tambah";
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Unit already exist</div>"));
                        exit();
                    }
                } else {
                    $equipment_ct = $this->crud_model->read_data("equipment_unit", array("md5(equipment_unit_id)" => $id))->row();
                    $equ['equipment_unit_id'] = $equipment_ct->equipment_unit_id;
                    $this->crud_model->update_data("equipment_unit", $equ, "equipment_unit_id");
                    $this->recActivity("Updated <b>$equ[equipment_unit_name]</b> on Master Equipment Unit", "warehouse");
                    $action = "edit";
                }
                $this->session->set_flashdata("message_unit", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Unit successfully saved</div>");
                echo json_encode(array('status' => 1));
            } elseif ($exe == "delete") {
                $get = $this->crud_model->read_data("equipment_unit", array("md5(equipment_unit_id)" => "$id"))->row();
                $this->recActivity("Deleted <b>$get->equipment_unit_name</b> of Master Equipment Unit", "warehouse");
                $this->crud_model->delete_data("equipment_unit", array("md5(equipment_unit_id)" => "$id"));
                $this->session->set_flashdata("message_unit", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Unit successfully deleted</div>");
                echo json_encode(array("status" => 1));
            }
        }
    }

    public function category($exe = null, $id = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = "Equipment Category";
        $data['header'] = "Equipment Category";
        if (empty($exe)) {
            $child = "(select count(equipment_ct_id) from equipment where equipment_ct_id = ec.equipment_ct_id) as child";
            $data['show'] = $this->crud_model->read_fordata(array("table" => "equipment_ct ec", "select" => array("*", $child)))->result();
            $this->load->view("warehouse/master/equipment/category/table", $data);
        } else {
            if ($exe == "form") {
                $data['act'] = (empty($id)) ? "Add" : "Edit";
                $data['url_access'] = "$this->url";
                $data['url_action'] = $this->url . 'category/saving/' . $id;
                if (!empty($id)) {
                    $data["equipment_ct_dt"] = $this->crud_model->read_data("equipment_ct", array("md5(equipment_ct_id)" => $id))->row();
                }

                $this->load->view("warehouse/master/equipment/category/form", $data);
            } elseif ($exe == "saving") {
                $equ['equipment_ct_name'] = ucwords($this->input->post("equipment_ct_name"));
                if (empty($id)) {
                    $duplication = $this->crud_model->read_fordata(array("table" => "equipment_ct", "where" => array("equipment_ct_name" => ucwords($this->input->post("equipment_ct_name")))))->num_rows();
                    if ($duplication == 0) {
                        $this->crud_model->insert_data("equipment_ct", $equ);
                        $this->recActivity("Created <b>$equ[equipment_ct_name]</b> on Master Equipment Category", "warehouse");
                        $action = "tambah";
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Category already exist</div>"));
                        exit();
                    }
                } else {
                    $equipment_ct = $this->crud_model->read_data("equipment_ct", array("md5(equipment_ct_id)" => $id))->row();
                    $equ['equipment_ct_id'] = $equipment_ct->equipment_ct_id;
                    $this->crud_model->update_data("equipment_ct", $equ, "equipment_ct_id");
                    $this->recActivity("Updated <b>$equ[equipment_ct_name]</b> on Master Equipment Category", "warehouse");
                    $action = "edit";
                }
                $this->session->set_flashdata("message_ct", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Category successfully saved</div>");
                echo json_encode(array('status' => 1));
            } elseif ($exe == "delete") {
                $get = $this->crud_model->read_data("equipment_ct", array("md5(equipment_ct_id)" => "$id"))->row();
                $this->recActivity("Deleted <b>$get->equipment_ct_name</b> of Master Equipment Category", "warehouse");
                $this->crud_model->delete_data("equipment_ct", array("md5(equipment_ct_id)" => "$id"));
                $this->session->set_flashdata("message_ct", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Category successfuly deleted</div>");
                echo json_encode(array("status" => 1));
            }
        }
    }

}

?>