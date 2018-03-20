<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Menu_access extends MY_Controller {

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("modul_m");
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['permit'] = $data['sess']['permit'];
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['features'] = "dashboard";
        $data['title'] = "Position Available";
        $data['header'] = $data['title'];
        $data['content'] = "dashboard/menu/access/index";
        $this->load->view("../index", $data);
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (in_array(1, array($data['permit']->access_create, $data['permit']->access_update))) {
            $data['act'] = (empty($id)) ? "Add" : "Edit";
            $data['url_action'] = "dashboard/menu_access/save/$id";
            $data['header'] = "Menu Access";
            $data["mod_menu"] = $this->modul_m->mod_menu($id);
            if (!empty($id) AND $data['permit']->access_update == 1) {
                $data['detail'] = $this->crud_model->read_fordata(array("table" => "users_position", "where" => array("md5(users_position_id)" => $id)))->row();
            }
            $this->load->view("dashboard/menu/access/form", $data);
        }
    }

    public function table($modul = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $child = "(select count(mod_menu_access_id) from mod_menu_access where users_position_id = up.users_position_id) as menu_available,(select count(users_id) from users where users_position_id = up.users_position_id) as check_users";
            $data['show'] = $this->crud_model->read_fordata(array("table" => "users_position up", "select" => array("*, $child"), "order" => array("up.users_position_name" => "ASC")))->result();
            $this->load->view("dashboard/menu/access/data", $data);
        }
    }

    public function detail($features = null, $id = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            if ($features == "users") {
                $data['header'] = "Users Active";
                if (!empty($id)) {
                    $data['detail'] = $this->crud_model->read_fordata(array("table" => "users_position", "where" => array("md5(users_position_id)" => $id)))->row();
                    $data['show'] = $this->crud_model->read_fordata(array("table" => "users", "where" => array("md5(users.users_position_id)" => $id), "join" => array("employee em" => "em.employee_id = users.employee_id")))->result();
                }
                $this->load->view("dashboard/menu/access/detail/users", $data);
            } elseif ($features == "group") {
                $data['header'] = "Deial Group Permission";
                if (!empty($id)) {
                    $data['detail'] = $this->crud_model->read_fordata(array("table" => "users_position", "where" => array("md5(users_position_id)" => $id)))->row();
                    $data['show'] = $this->modul_m->mod_menu_active($id);
                }
                $this->load->view("dashboard/menu/access/detail/group", $data);
            }
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $modul['users_position_name'] = $this->input->post("position");
        if (empty($id)) {
            $check = $this->crud_model->read_fordata(array("table" => "users_position", "where" => array("users_position_name" => $modul['users_position_name'])))->num_rows();
            if ($check == 0) {
                $this->crud_model->insert_data("users_position", $modul);
                $getlast = $this->crud_model->read_data("users_position")->last_row();
                for ($x = 0; $x < count($this->input->post("menu")); $x++) {

                    if (!empty($_POST['create'][$_POST['menu'][$x]]) || !empty($_POST['read'][$_POST['menu'][$x]]) || !empty($_POST['update'][$_POST['menu'][$x]]) || !empty($_POST['delete'][$_POST['menu'][$x]]) || !empty($_POST['special'][$_POST['menu'][$x]])) {
                        $acsmod["mod_menu_id"] = $_POST['menu'][$x];
                        $acsmod["users_position_id"] = $getlast->users_position_id;
                        $acsmod["access_create"] = !empty($_POST['create'][$_POST['menu'][$x]]) ? $_POST['create'][$acsmod["mod_menu_id"]] : 0;
                        $acsmod["access_read"] = !empty($_POST['read'][$_POST['menu'][$x]]) ? $_POST['read'][$acsmod["mod_menu_id"]] : 0;
                        $acsmod["access_update"] = !empty($_POST['update'][$_POST['menu'][$x]]) ? $_POST['update'][$acsmod["mod_menu_id"]] : 0;
                        $acsmod["access_delete"] = !empty($_POST['delete'][$_POST['menu'][$x]]) ? $_POST['delete'][$acsmod["mod_menu_id"]] : 0;
                        $acsmod["access_special"] = !empty($_POST['special'][$_POST['menu'][$x]]) ? $_POST['special'][$acsmod["mod_menu_id"]] : 0;
                        $this->crud_model->insert_data("mod_menu_access", $acsmod);
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Menu failed to save</div>"));
                exit();
            }
        } else {
            $check = $this->crud_model->read_fordata(array("table" => "users_position", "where" => array("users_position_name" => $modul['users_position_name'], "md5(users_position_id) !=" => $id)))->num_rows();
            if ($check == 0) {
                $getposition = $this->crud_model->read_fordata(array("table" => "users_position", "where" => array("md5(users_position_id)" => $id)))->row();
                $modul['users_position_id'] = $getposition->users_position_id;
                $this->crud_model->update_data("users_position", $modul, "users_position_id");
                $this->crud_model->delete_data("mod_menu_access", array("md5(users_position_id)" => "$id"));
                for ($x = 0; $x < count($this->input->post("menu")); $x++) {

                    if (!empty($_POST['create'][$_POST['menu'][$x]]) || !empty($_POST['read'][$_POST['menu'][$x]]) || !empty($_POST['update'][$_POST['menu'][$x]]) || !empty($_POST['delete'][$_POST['menu'][$x]]) || !empty($_POST['special'][$_POST['menu'][$x]])) {
                        $acsmod["mod_menu_id"] = $_POST['menu'][$x];
                        $acsmod["users_position_id"] = $getposition->users_position_id;
                        $acsmod["access_create"] = !empty($_POST['create'][$_POST['menu'][$x]]) ? $_POST['create'][$acsmod["mod_menu_id"]] : 0;
                        $acsmod["access_read"] = !empty($_POST['read'][$_POST['menu'][$x]]) ? $_POST['read'][$acsmod["mod_menu_id"]] : 0;
                        $acsmod["access_update"] = !empty($_POST['update'][$_POST['menu'][$x]]) ? $_POST['update'][$acsmod["mod_menu_id"]] : 0;
                        $acsmod["access_delete"] = !empty($_POST['delete'][$_POST['menu'][$x]]) ? $_POST['delete'][$acsmod["mod_menu_id"]] : 0;
                        $acsmod["access_special"] = !empty($_POST['special'][$_POST['menu'][$x]]) ? $_POST['special'][$acsmod["mod_menu_id"]] : 0;
                        $this->crud_model->insert_data("mod_menu_access", $acsmod);
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Menu failed to save</div>"));
                exit();
            }
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Menu successfully saved</div>");
        echo json_encode(array("status" => 1));
    }

    public function delete($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $check = $this->crud_model->read_fordata(array("table" => "users", "where" => array("md5(users_position_id)" => "$id")))->num_rows();
            if ($check == 0) {
                $this->crud_model->delete_data("mod_menu_access", array("md5(users_position_id)" => "$id"));
                $this->crud_model->delete_data("users_position", array("md5(users_position_id)" => "$id"));
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
            $mod_menu = $this->crud_model->read_data("users_position", array("md5(users_position_id)" => $id))->row();
            $usr['users_position_id'] = $mod_menu->users_position_id;
            $usr['users_position_status'] = $status;
            $this->crud_model->update_data("users_position", $usr, "users_position_id");
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Status successfully changed</div>");
            echo json_encode(array("status" => 1));
        }
    }

}

?>