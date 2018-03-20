<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Menu extends MY_Controller {

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("modul_m");
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = "Modul & Menu";
        $data['header'] = $data['title'];
        $data['modul'] = $this->crud_model->read_fordata(array("table" => "modul", "where" => "modul_status = 1"))->result();
        $data['content'] = "dashboard/menu/master/index";
        $this->load->view("../index", $data);
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (in_array(1, array($data['permit']->access_create, $data['permit']->access_update))) {
            $data['act'] = (empty($id)) ? "Add" : "Edit";
            $data['url_action'] = "dashboard/menu/save/$id";
            $data['modul'] = $this->crud_model->read_fordata(array("table" => "modul", "where" => "modul_status = 1"))->result();
            $data['header'] = "Menu";
            if (!empty($id)) {
                $data['detail'] = $this->crud_model->read_fordata(array("table" => "mod_menu", "where" => "md5(mod_menu_id)='$id'"))->row();
            }
            $this->load->view("dashboard/menu/master/form", $data);
        }
    }

    public function table($modul = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            if (!empty($modul)) {
                $child = "(select count(mod_menu_access_id) from mod_menu_access where mod_menu_id = modd.mod_menu_id) as access";
                $data['show'] = $this->crud_model->read_fordata(array("table" => "mod_menu modd", "select" => array("*, $child"), "where" => "md5(modd.modul_id)='$modul'", "order" => array("modd.mod_menu_position" => "ASC")))->result();
            }
            $this->load->view("dashboard/menu/master/data", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $modul['modul_id'] = $this->input->post("modul");
        $modul['mod_menu_name'] = $this->input->post("menu");
        $modul['mod_menu_icon'] = $this->input->post("icon");
        $modul['mod_menu_display'] = $this->input->post("display");
        $modul['mod_menu_url'] = !empty($this->input->post("url")) ? $this->input->post("url") : "#";
        $modul['mod_menu_position'] = $this->input->post("position");
        $modul['mod_menu_create'] = !empty($this->input->post("create")) ? $this->input->post("create") : 0;
        $modul['mod_menu_read'] = !empty($this->input->post("read")) ? $this->input->post("read") : 0;
        $modul['mod_menu_update'] = !empty($this->input->post("update")) ? $this->input->post("update") : 0;
        $modul['mod_menu_delete'] = !empty($this->input->post("delete")) ? $this->input->post("delete") : 0;
        $modul['mod_menu_special'] = !empty($this->input->post("special")) ? $this->input->post("special") : 0;
        if (empty($id)) {
            $check = $this->crud_model->read_fordata(array("table" => "mod_menu", "where" => array("mod_menu_url" => $modul['mod_menu_url'], "mod_menu_name" => $modul['mod_menu_name'], "modul_id" => $modul['modul_id'])))->num_rows();
            if ($check == 0) {
                $this->crud_model->insert_data("mod_menu", $modul);
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Menu failed to save</div>"));
                exit();
            }
        } else {
            $check = $this->crud_model->read_fordata(array("table" => "mod_menu", "where" => array("md5(mod_menu_id) !=" => $id,"mod_menu_url" => $modul['mod_menu_url'],"mod_menu_name" => $modul['mod_menu_name'], "modul_id" => $modul['modul_id'])))->num_rows();
            if ($check == 0) {
                $menu = $this->crud_model->read_fordata(array("table" => "mod_menu", "where" => array("md5(mod_menu_id)" => $id)))->row();
                $modul['mod_menu_id'] = $menu->mod_menu_id;
                $this->crud_model->update_data("mod_menu", $modul, "mod_menu_id");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Menu failed to save</div>"));
                exit();
            }
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Menu successfully saved</div>");
        echo json_encode(array("status" => 1, "modul" => md5($modul['modul_id'])));
    }

    public function delete($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $check = $this->crud_model->read_fordata(array("table" => "mod_menu_access", "where" => array("md5(users_position_id)" => "$id")))->num_rows();
            if ($check == 0) {
                $this->crud_model->delete_data("mod_menu", array("md5(mod_menu_id)" => "$id"));
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Menu successfully removed</div>");
                echo json_encode(array("status" => 1));
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Menu failed to removed</div>"));
            }
            exit();
        }
    }

    public function status($id = NULL, $status = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_special == 1) {
            $mod_menu = $this->crud_model->read_data("mod_menu", array("md5(mod_menu_id)" => $id))->row();
            $usr['mod_menu_id'] = $mod_menu->mod_menu_id;
            $usr['mod_menu_status'] = $status;
            $this->crud_model->update_data("mod_menu", $usr, "mod_menu_id");
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Status successfully changed</div>");
            echo json_encode(array("status" => 1));
        }
    }

}

?>