<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Tax extends MY_Controller {

    private $title = "Tax";
    private $header = "Tax";
    private $url = "finance/tax/";

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
        $data['content'] = "finance/master/tax/index";
        $this->load->view("../index", $data);
    }

    public function info($ct = null, $status = null) {
        $data['sess'] = $this->authentication_root();
        if (!empty($ct)) {
            if (!empty($status)) {
                if ($status != 'all') {
                    $where['tx.tax_status'] = $status == 'active' ? 1 : 0;
                }
            }
            $where['md5(tx.tax_ct_id)'] = $ct;
            $data['show'] = $this->crud_model->read_data("tax tx", $where, array("tx.tax_id" => "DESC"), null)->result();
            $this->load->view("finance/info/tax/data", $data);
        } else {
            $data['show'] = $this->origin_model->tax();
            $this->load->view("finance/info/tax/index", $data);
        }
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['act'] = (empty($id)) ? "Add" : "Edit";
        $data['url_access'] = "$this->url";
        $data['url_action'] = $this->url . 'save/' . $id;
        $data['header'] = $this->header;
        $data['tax_ct'] = $this->crud_model->read_fordata(array("table" => "tax_ct"))->result();
        $data['tax_mode'] = $this->crud_model->read_fordata(array("table" => "tax_mode"))->result();
        if (!empty($id)) {
            $data["tax_dt"] = $this->crud_model->read_fordata(array("table" => "tax e", "where" => array("md5(tax_id)" => $id), "join" => array("tax_ct ec" => "ec.tax_ct_id = e.tax_ct_id")))->row();
        }

        $this->load->view("finance/master/tax/tax_form", $data);
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $child = "(select count(tax_id) from invoice_tax where tax_id = e.tax_id) + (select count(tax_id) from salary_tax where tax_id = e.tax_id) as child";
        $data['show'] = $this->crud_model->read_fordata(array("table" => "tax e", 'where' => array('tax_status' => 1), "select" => array("*", $child), "join" => array("tax_ct ec" => "ec.tax_ct_id = e.tax_ct_id", "tax_mode tmd" => "tmd.tax_mode_id = e.tax_mode_id")))->result();
        $this->load->view("finance/master/tax/tax_table", $data);
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $txu['tax_ct_id'] = $this->input->post("tax_ct");
        $txu['tax_name'] = ucwords($this->input->post("tax_name"));
        $txu['tax_cuts'] = $this->input->post("tax_cuts");

        if (empty($id)) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "tax", "where" => $txu))->num_rows();
            if ($duplicate == 0) {
                $this->crud_model->insert_data("tax", $txu);
                $this->recActivity("Created tax $txu[tax_name] on Master Tax", "finance");
                $action = "tambah";
            } else {
                echo json_encode(array('status' => 0, 'msg' => 'Data duplikat'));
                exit();
            }
        } else {
            $tax = $this->crud_model->read_data("tax", array("md5(tax_id)" => $id))->row();
            $txu['tax_id'] = $tax->tax_id;
            $this->crud_model->update_data("tax", $txu, "tax_id");
            $this->recActivity("Updated tax $txu[tax_name] on Master Tax", "finance");
            $action = "ubah";
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Tax successfully changed</div>");
        echo json_encode(array('status' => 1));
    }

    public function delete($tax_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $this->crud_model->delete_data("tax", array("md5(tax_id)" => "$tax_id"));
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Tax successfully removed</div>");
            echo json_encode(array("status" => 1));
        }
    }

    public function status($id, $status) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_special == 1) {
            $this->crud_model->update_data("tax", array("tax_status" => $status == 2 ? 0 : 1, "tax_id" => $id), 'tax_id');
            echo json_encode(array("status" => 1));
        }
    }

    public function category($exe = null, $id = null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Tax Category";
        $data['header'] = "Tax Category";
        if (empty($exe)) {
            $child = "(select count(tax_ct_id) from tax where tax_ct_id = ec.tax_ct_id) as child";
            $data['show'] = $this->crud_model->read_fordata(array("table" => "tax_ct ec", "select" => array("*", $child)))->result();
            $this->load->view("finance/master/tax/category/table", $data);
        } else {
            if ($exe == "form") {
                $data['act'] = (empty($id)) ? "Add" : "Edit";
                $data['url_access'] = "$this->url";
                $data['url_action'] = $this->url . 'category/saving/' . $id;
                if (!empty($id)) {
                    $data["tax_ct_dt"] = $this->crud_model->read_data("tax_ct", array("md5(tax_ct_id)" => $id))->row();
                }

                $this->load->view("finance/master/tax/category/form", $data);
            } elseif ($exe == "saving") {
                $txu['tax_ct_name'] = ucwords($this->input->post("tax_ct_name"));
                if (empty($id)) {
                    $duplication = $this->crud_model->read_fordata(array("table" => "tax_ct", "where" => array("tax_ct_name" => ucwords($this->input->post("tax_ct_name")))))->num_rows();
                    if ($duplication == 0) {
                        $this->crud_model->insert_data("tax_ct", $txu);
                        $action = "tambah";
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => 'Data duplikat'));
                        exit();
                    }
                } else {
                    $tax_ct = $this->crud_model->read_data("tax_ct", array("md5(tax_ct_id)" => $id))->row();
                    $txu['tax_ct_id'] = $tax_ct->tax_ct_id;
                    $this->crud_model->update_data("tax_ct", $txu, "tax_ct_id");
                    $action = "edit";
                }
                $this->session->set_flashdata("message_ct", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Tax category successfully saved</div>");
                echo json_encode(array('status' => 1));
            } elseif ($exe == "delete") {
                $this->crud_model->delete_data("tax_ct", array("md5(tax_ct_id)" => "$id"));
                $this->session->set_flashdata("message_ct", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Tax category successfully removed</div>");
                echo json_encode(array("status" => 1));
            }
        }
    }

}

?>