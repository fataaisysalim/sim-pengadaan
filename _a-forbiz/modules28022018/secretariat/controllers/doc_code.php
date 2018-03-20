<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Doc_code extends MY_Controller {

    private $title = "Document Code";
    private $header = "Document Code";
    private $url = "secretariat/doc-code/";

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
        $data['js_load'] = "extend/js_fancybox";
        $data['content'] = "secretariat/master/doc_code/index";
        $this->load->view("../index", $data);
    }

    public function info($ct = null, $status = null) {
        $data['sess'] = $this->authentication_root();
        if (!empty($ct)) {
            if (!empty($status)) {
                if ($status != 'all') {
                    $where['tx.letcode_status'] = $status == 'active' ? 1 : 0;
                }
            }
            $data['show'] = $this->crud_model->read_data("doc_control_letcode tx", null, array("tx.doc_control_letcode_id" => "DESC"), null)->result();
            $this->load->view("secretariat/info/doc_code/data", $data);
        } else {
            $data['show'] = $this->origin_model->letcode();
            $this->load->view("secretariat/info/doc_code/index", $data);
        }
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
            if (!empty($id) AND $data['permit']->access_update == 1) {
                $data["letcode_dt"] = $this->crud_model->read_fordata(array("table" => "doc_control_letcode e", "where" => array("md5(doc_control_letcode_id)" => $id), null))->row();
            }
            $this->load->view("secretariat/master/doc_code/form", $data);
        }
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $data['title'] = $this->title;
            $data['header'] = $this->header;
            $child = "(select count(doc_control_letcode_id) from doc_control where doc_control_letcode_id = e.doc_control_letcode_id) as child";
            $data['show'] = $this->crud_model->read_fordata(array("table" => "doc_control_letcode e", "select" => array("*", $child), null))->result();
            $this->load->view("secretariat/master/doc_code/table", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $txu['doc_control_letcode_name'] = ucwords($this->input->post("letcode_name"));
        $txu['doc_control_letcode_number'] = $this->input->post("letcode_number");
        if (empty($id)) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "doc_control_letcode", "where" => array("doc_control_letcode_name" => $this->input->post("letcode_name"))))->num_rows();
            if ($duplicate == 0) {
                $this->crud_model->insert_data("doc_control_letcode", $txu);
                $this->recActivity("Created <b>$txu[doc_control_letcode_name]</b> on Master Document Code", "secretariat");
                $action = "tambah";
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Code name already exist</div>"));
                exit();
            }
        } else {
            $letcode = $this->crud_model->read_data("doc_control_letcode", array("md5(doc_control_letcode_id)" => $id))->row();
            $txu['doc_control_letcode_id'] = $letcode->doc_control_letcode_id;
            $this->crud_model->update_data("doc_control_letcode", $txu, "doc_control_letcode_id");
            $this->recActivity("Updated <b>$txu[doc_control_letcode_name]</b> on Master Document Code", "secretariat");
            $action = "ubah";
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Document code successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function delete($doc_control_letcode_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $letcode = $this->crud_model->read_data("doc_control_letcode", array("md5(doc_control_letcode_id)" => $doc_control_letcode_id))->row();
            $this->recActivity("Deleted <b>$letcode->doc_control_letcode_name</b> of Master Document Code", "secretariat");
            $this->crud_model->delete_data("doc_control_letcode", array("md5(doc_control_letcode_id)" => "$doc_control_letcode_id"));
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Document code successfully removed</div>");
            echo json_encode(array("status" => 1));
        }
    }

    public function status($id, $status) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_special == 1) {
            $statuss = $status == 2 ? "nonactive" : "active";
            $letcode = $this->crud_model->read_data("doc_control_letcode", array("doc_control_letcode_id" => $id))->row();
            $this->recActivity("Changed status <b>$letcode->doc_control_letcode_name</b> to $status on Master Document Code", "secretariat");
            $this->crud_model->update_data("doc_control_letcode", array("letcode_status" => $status == 2 ? 0 : 1, "doc_control_letcode_id" => $id), 'doc_control_letcode_id');
            echo json_encode(array("status" => 1));
        }
    }

    public function data($id) {
        if (!empty($id)) {
            $data = $this->crud_model->read_data("doc_control_letcode", array("doc_control_letcode_id" => $id))->row();
            echo json_encode(array('status' => 1, 'code' => $data->doc_control_letcode_number));
        } else {
            echo json_encode(array("status" => 0));
        }
    }

}

?>