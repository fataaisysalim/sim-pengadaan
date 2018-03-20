<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Project_access extends MY_Controller {

    private $title = "Project";
    private $header = "project";
    private $url = "dashboard/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($ct = null) {
        $data['sess'] = $this->authentication_root();
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['project_m'] = 'active';
        $data['proaccess_sm'] = 'active';
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['url_access'] = $this->url;
        $data['content'] = "dashboard/project/access/index";
        $this->load->view("../index", $data);
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (in_array(1, array($data['permit']->access_create, $data['permit']->access_update))) {
            $data['title'] = $this->title;
            $data['act'] = (empty($id)) ? "Add" : "Edit";
            $data['url_access'] = "dashboard/project_access/";
            $data['url_action'] = 'dashboard/project_access/save/' . $id;
            $data['header'] = $this->header;
            $data['project'] = $this->crud_model->read_data("project")->result();
            $data['users'] = $this->crud_model->read_data("users")->result();
            if (!empty($id) AND $data['permit']->access_update == 1) {
                $data["project_access_dt"] = $this->crud_model->read_data("project_access p", array("md5(project_access_id)" => $id), NULL)->row();
            }
            $this->load->view("dashboard/project/access/form", $data);
        }
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $data['show'] = $this->crud_model->read_fordata(array("group" => "pa.project_id", "table" => "project_access pa", "join" => array("project p" => "p.project_id = pa.project_id", "users u" => "u.users_id = pa.users_id")))->result();
            $this->load->view("dashboard/project/access/table", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $users = $this->input->post("users");
        foreach (array_filter($users) as $usr) {
            $pro['users_id'] = $usr;
            $pro['project_id'] = $this->input->post("project");
            if (empty($id)) {
                $check = $this->crud_model->read_data("project_access", array("project_id" => $this->input->post("project"), "users_id" => $usr))->num_rows();
                if ($check == 0) {
                    $this->crud_model->insert_data("project_access", $pro);
                    $project = $this->crud_model->read_data("project", array("project_id" => $pro['project_id']))->row();
                    $users = $this->crud_model->read_fordata(array("table" => "employee e", "join" => array("users u" => "u.employee_id = e.employee_id"), "where" => array("u.users_id" => $pro['users_id'])))->row();
                    $this->recActivity("Setting access <b>$users->employee_name</b> to $project->project_name project", "dashboard");
                } else {
                    echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Users already registered</div>"));
                    exit();
                }
            } else {
                $project_access = $this->crud_model->read_data("project_access", array("md5(project_access_id)" => $id))->row();
                $pro['project_access_id'] = $project_access->project_access_id;
                $check = $this->crud_model->read_data("project_access", array("project_id" => $this->input->post("project"), "users_id" => $usr, "md5(project_access_id) !=" => $id))->num_rows();
                if ($check == 0) {
                    $this->crud_model->update_data("project_access", $pro, "project_access_id");
                    $project = $this->crud_model->read_data("project", array("project_id" => $pro['project_id']))->row();
                    $users = $this->crud_model->read_fordata(array("table" => "employee e", "join" => array("users u" => "u.employee_id = e.employee_id"), "where" => array("u.users_id" => $pro['users_id'])))->row();
                    $this->recActivity("Updated access <b>$users->employee_name</b> to $project->project_name project", "dashboard");
                } else {
                    echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Users already registered</div>"));
                    exit();
                }
            }
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Users successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function data($idpro = null) {
        $data['sess'] = $this->authentication_root();
        $user = $this->crud_model->read_fordata(array("table" => "project_access", 'select' => 'users_id', "where" => array("project_id" => $idpro)))->result_array();
        $aus = array();
        foreach ($user as $row) :
            $aus[] = $row['users_id'];
        endforeach;

        if (count($aus) > 0) :
            $data['proSer'] = $this->db->where_not_in('users.users_id', $aus);
        endif;
        $data['proSer'] = $this->db->get('users')->result();

        $this->load->view("dashboard/project/access/project", $data);
    }

    public function detail($project_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['project_access_dt'] = $this->crud_model->read_fordata(array("select" => "*", "table" => "project_access pa", "join" => array("users u" => "u.users_id = pa.users_id"), "where" => array("md5(project_id)" => $project_id)))->result();
        $this->load->view("dashboard/project/access/detail", $data);
    }

    public function delete($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $project = $this->crud_model->read_fordata(array("table" => "employee e", "join" => array("users u" => "u.employee_id = e.employee_id", "project_access pa" => "pa.users_id = u.users_id", "project p" => "p.project_id = pa.project_id"), "where" => array("md5(pa.project_access_id)" => $id)))->row();
            $this->recActivity("Deleted access <b>$project->employee_name</b> of $project->project_name project", "dashboard");
            $this->crud_model->delete_data("project_access", array("md5(project_access_id)" => $id));
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Users successfully removed</div>");
            echo json_encode(array("status" => 1));
        }
    }

    public function getdata($id, $ct, $table = NULL) {
        $table = !empty($table) ? $table : "mog";
        $data = $this->crud_model->read_data("project", array("project_id" => $id))->row();
        $number = $this->crud_model->read_data("$table", array("project_id" => $id))->num_rows();
        $number = $number + 1;
        echo json_encode(array('status' => 1, 'data' => $data, 'number' => serial_number($number)));
    }

}

?>