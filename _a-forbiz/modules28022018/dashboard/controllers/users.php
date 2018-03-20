<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Users extends MY_Controller {

    private $title = "User";
    private $header = "user";
    private $url = "dashboard/users/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($ct = null) {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['setting_m'] = 1;
        $data['users_sm'] = 1;
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['url_access'] = $this->url;
        $data['content'] = "dashboard/users/index";
        $this->load->view("../index", $data);
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
            $data['users_position'] = $this->crud_model->read_data("users_position")->result();
            $data['users_role'] = $this->crud_model->read_data("master_user_role")->result();
            $data['users_employee'] = $this->crud_model->read_fordata(array("table" => "users u", "join" => array("employee e" => array("u.employee_id = e.employee_id", "RIGHT"))))->result();
            if (!empty($id) AND $data['permit']->access_update == 1) {
                $data["users_dt"] = $this->crud_model->read_data("users u", array("md5(users_id)" => $id), NULL)->row();
            }
            $this->load->view("dashboard/users/users_form", $data);
        }
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $child1 = "(select count(users_id) from project_access where users_id = u.users_id) as child1";
            $child2 = "(select count(users_id) from actor where users_id = u.users_id) as child2";
            $child3 = "(select count(users_id) from activity where users_id = u.users_id) as child3";
            $data["show"] = $this->crud_model->read_data("users u", NULL, array("u.users_id" => "DESC"), array("users_position up" => "up.users_position_id = u.users_position_id", "employee e" => "e.employee_id = u.employee_id", "master_user_role mr" => "mr.id_user_role = u.users_divisi"), NULL, NULL, array("*", $child1, $child2, $child3))->result();

            $this->load->view("dashboard/users/users_table", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $usr['users_position_id'] = $this->input->post("users_position");
        $usr['users_divisi'] = $this->input->post("users_divisi");
        $usr['users_username'] = strtolower(clearChar($this->input->post("users_username")));
        if (empty($id)) {
            $usr['employee_id'] = $this->input->post("users_employee");
            $usr['users_password'] = md5("system");
            $usr['users_registered'] = date('Y-m-d H:i:s');
            $usr['users_status'] = 1;
            $check = $this->crud_model->read_data("users", array("users_username" => $this->input->post("users_username")))->num_rows();
            $action = "tambah";
            if ($check == 0) {
                $this->crud_model->insert_data("users", $usr);
                $this->recActivity("Created <b>$usr[users_username]</b> on Master Users", "dashboard");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>User failed to save</div>"));
                exit();
            }
        } else {
            $usr['employee_id'] = $this->input->post("users_employee");
            $users = $this->crud_model->read_data("users", array("md5(users_id)" => $id))->row();
            $usr['users_id'] = $users->users_id;
            $check = $this->crud_model->read_data("users", array("users_username" => $this->input->post("users_username"), "md5(users_id) !=" => $id))->num_rows();
            $action = "edit";
            if ($check == 0) {
                $this->crud_model->update_data("users", $usr, "users_id");
                $this->recActivity("Updated <b>$usr[users_username]</b> on Master Users", "dashboard");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>User failed to save</div>"));
                exit();
            }
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>User successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function delete($users_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $users = $this->crud_model->read_data("users", array("md5(users_id)" => $users_id))->row();
            $this->recActivity("Deleted <b>$users->users_username</b> of Master Users", "dashboard");
            $this->crud_model->delete_data("users", array("md5(users_id)" => $users_id));
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>User successfully deleted</div>");
            echo json_encode(array("status" => 1));
        }
    }

    public function reset($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_special == 1) {
            $users = $this->crud_model->read_data("users", array("md5(users_id)" => $id))->row();
            $usr['users_id'] = $users->users_id;
            $usr['users_password'] = md5("wika" . date("Hi"));
            $this->crud_model->update_data("users", $usr, "users_id");
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Password successfully reset</div>");
            echo json_encode(array("status" => 1));
        }
    }

    public function status($id = NULL, $status = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_special == 1) {
            $users = $this->crud_model->read_data("users", array("md5(users_id)" => $id))->row();
            $usr['users_id'] = $users->users_id;
            $usr['users_status'] = $status;
            $this->crud_model->update_data("users", $usr, "users_id");
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Status successfully changed</div>");
            echo json_encode(array("status" => 1));
        }
    }

}

?>