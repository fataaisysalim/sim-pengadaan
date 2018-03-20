<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Code extends MY_Controller {

    private $url = "procurement/rescode";
    private $view_path = "procurement/master/code/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function resource($feature = null, $id = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['active'] = empty($id) ? $data['sess']['gotcurrent']->mod_menu_id : null;
        $data['title'] = "Code Resource";
        $data['url_access'] = $this->url;
        if (empty($feature)) {
            is_filtered_mod($data['sess']['validation']);
            $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
            $data['content'] = $this->view_path . "resource/index";
            $this->load->view("../index", $data);
        } else {
            if ($feature == "table") {
                $child = "(select count(code_id) from mog_dt where code_id = c.code_id) as child";
                $data['show'] = $this->crud_model->read_fordata(array("table" => "code c", "select" => array("*", $child), "join" => array("code_ct cc" => "cc.code_ct_id = c.code_ct_id")))->result();
                $this->load->view($this->view_path . "resource/table", $data);
            } else if ($feature == "form") {
                $data['act'] = (empty($id)) ? "Add" : "Edit";
                $data['url_action'] = "$this->url/saving/$id";
                $data['code_ct'] = $this->crud_model->read_fordata(array("table" => "code_ct"))->result();
                if (!empty($id)) {
                    $data['code_dt'] = $this->crud_model->read_fordata(array("table" => "code c", "join" => array("code_ct cc" => "cc.code_ct_id = c.code_ct_id"), "where" => array("md5(code_id)" => $id)))->row();
                }
                $this->load->view($this->view_path . "resource/form", $data);
            } else if ($feature == 'saving') {
                $code['code_name'] = ucwords($this->input->post("code_name"));
                $code['code_status'] = 1;
                $code['code_ct_id'] = $this->input->post("code_ct");
                if (empty($id)) {
                    $duplication = $this->crud_model->read_fordata(array("table" => "code", "where" => $code))->num_rows();
                    if ($duplication == 0) {
                        $this->crud_model->insert_data("code", $code);
                        $this->recActivity("Created <b>$code[code_name]</b> on Master Resource Code", "warehouse");
                        $action = "tambah";
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Code already exist</div>"));
                        exit();
                    }
                } else {
                    $get_code = $this->crud_model->read_data("code", array("md5(code_id)" => $id))->row();

                    $where['code_name'] = $code['code_name'];
                    $where['code_status'] = $code['code_status'];
                    $where['code_ct_id'] = $code['code_ct_id'];
                    $where['md5(code_id) !='] = $id;
                    $duplication = $this->crud_model->read_fordata(array("table" => "code", "where" => $where))->num_rows();
                    if ($duplication == 0) {
                        $code['code_id'] = $get_code->code_id;
                        $this->crud_model->update_data("code", $code, "code_id");
                        $this->recActivity("Updated <b>$code[code_name]</b> on Master Resource Code", "warehouse");
                        $action = "edit";
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Code already exist</div>"));
                        exit();
                    }
                }
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Code successfully saved</div>");
                echo json_encode(array('status' => 1));
            } elseif ($feature == "delete") {
                $get = $this->crud_model->read_data("code", array("md5(code_id)" => "$id"))->row();
                $this->recActivity("Deleted <b>$get->code_name</b> of Master Resource Code", "warehouse");
                $this->crud_model->delete_data("code", array("md5(code_id)" => "$id"));
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Code successfuly deleted</div>");
                echo json_encode(array("status" => 1));
            }
        }
    }

    public function code_ct($exe = null, $id = null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Code Category";
        $data['header'] = "Code Category";
        $data['url_access'] = $this->url;
        if (empty($exe)) {
            $child = "(select count(code_ct_id) from code where code_ct_id = cc.code_ct_id) as child";
            $data['show'] = $this->crud_model->read_fordata(array("table" => "code_ct cc", "select" => array("*", $child)))->result();
            $this->load->view($this->view_path . "code_ct/table", $data);
        } else {
            if ($exe == "form") {
                $data['act'] = (empty($id)) ? "Add" : "Edit";
                $data['url_action'] = $this->url . 'code_ct/saving/' . $id;
                if (!empty($id)) {
                    $data["code_ct_dt"] = $this->crud_model->read_data("code_ct", array("md5(code_ct_id)" => $id))->row();
                }
                $this->load->view($this->view_path . "code_ct/form", $data);
            } elseif ($exe == "saving") {
                $ct['code_ct_name'] = ucwords($this->input->post("code_ct_name"));
                if (empty($id)) {
                    $duplication = $this->crud_model->read_fordata(array("table" => "code_ct", "where" => $ct))->num_rows();
                    if ($duplication == 0) {
                        $this->crud_model->insert_data("code_ct", $ct);
                        $this->recActivity("Created <b>$ct[code_ct_name]</b> on Master Resource Code Category", "warehouse");
                        $action = "tambah";
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => 'Data duplikat'));
                        exit();
                    }
                } else {
                    $get_code_ct = $this->crud_model->read_data("code_ct", array("md5(code_ct_id)" => $id))->row();
                    $where['code_ct_name'] = $ct['code_ct_name'];
                    $where['md5(code_ct_id) !='] = $id;
                    $duplication = $this->crud_model->read_fordata(array("table" => "code_ct", "where" => $where))->num_rows();

                    if ($duplication == 0) {
                        $ct['code_ct_id'] = $get_code_ct->code_ct_id;
                        $this->crud_model->update_data("code_ct", $ct, "code_ct_id");
                        $this->recActivity("Updated <b>$ct[code_ct_name]</b> on Master Resource Code Category", "warehouse");
                        $action = "edit";
                    } else {
                        echo json_encode(array('status' => 0, 'msg' => 'Data duplikat'));
                        exit();
                    }
                }
                $this->session->set_flashdata("message_unit", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Unit successfully saved</div>");
                echo json_encode(array('status' => 1));
            } elseif ($exe == "delete") {
                $get = $this->crud_model->read_data("code_ct", array("md5(code_ct_id)" => "$id"))->row();
                $this->recActivity("Deleted <b>$get->code_ct_name</b> of Master Resource Code Category", "warehouse");
                $this->crud_model->delete_data("code_ct", array("md5(code_ct_id)" => "$id"));
                $this->session->set_flashdata("message_unit", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Code successfully deleted</div>");
                echo json_encode(array("status" => 1));
            }
        }
    }

}

?>