<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Employee extends MY_Controller {

    private $title = "Employee";
    private $header = "Employee";
    private $url = "dashboard/employee/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($ct = null) {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['url_access'] = $this->url;
        $data['content'] = "dashboard/employee/index";
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
            if (!empty($id) AND $data['permit']->access_update == 1) {
                $data["employee_dt"] = $this->crud_model->read_data("employee a", array("md5(employee_id)" => $id))->row();
            }
            $this->load->view("dashboard/employee/employee_form", $data);
        }
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $child = "(select count(employee_id) from users where employee_id = e.employee_id) as child";
            $data['show'] = $this->crud_model->read_fordata(array("table" => "employee e", "select" => array("*", $child)))->result();
            $this->load->view("dashboard/employee/employee_table", $data);
        }
    }

    public function detail($employee_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $data['title'] = $this->title;
            $data['header'] = $this->header;
            $data["employee_dt"] = $this->crud_model->read_fordata(array("table" => "employee", "where" => array("md5(employee_id)" => $employee_id)))->row();
            $this->load->view("dashboard/employee/employee_detail", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        if (!empty($_FILES['foto']['name'])) {
            $lokasi_file = $_FILES['foto']['tmp_name'];
            $nama_file = $_FILES['foto']['name'];
            $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
            $acak = rand(000000, 999999);
            $nama_file_unik = $acak . '_' . str_replace(' ', '_', $this->input->post("employee_name")) . '.' . $ext;
            if (!empty($lokasi_file)) {
                if (!empty($id)) {
                    $photo = $this->crud_model->read_sg_data("employee", array("md5(employee_id)" => "$id"))->row();
                    if (!empty($photo->employee_photo)) {
                        $this->crud_model->unlink($photo->employee_photo, 'image/employee');
                    }
                }
                $upload = $this->crud_model->upload('image/employee', $nama_file_unik, 'foto');
                $data['employee_image'] = $nama_file_unik;
            } else {
                $this->session->set_flashdata("message-form", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Photo failed to upload</div>");
                redirect("dashboard/employee/");
            }
        }
        $emp['employee_nik'] = $this->input->post("employee_nik");
        $emp['employee_name'] = $this->input->post("employee_name");
        $emp['employee_address'] = $this->input->post("employee_address");
        $emp['employee_phone'] = $this->input->post("employee_phone");
        $emp['employee_email'] = $this->input->post("employee_email");
        $emp['employee_status'] = 1;

        if (empty($id)) {
            $check = $this->crud_model->read_data("employee", array("employee_name" => $emp['employee_name']))->num_rows();
            $action = "tambah";
            if ($check == 0) {
                $this->crud_model->insert_data("employee", $emp);
                $this->recActivity("Created <b>$emp[employee_name]</b> on Master Employee", "dashboard");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Employee failed to save</div>"));
                exit();
            }
        } else {
            $check = $this->crud_model->read_data("employee", array("employee_name" => $emp['employee_name'], "md5(employee_id) !=" => $id))->num_rows();
            $action = "edit";
            if ($check == 0) {
                $employee = $this->crud_model->read_data("employee", array("md5(employee_id)" => $id))->row();
                $emp['employee_id'] = $employee->employee_id;
                $this->recActivity("Updated <b>$emp[employee_name]</b> on Master Employee", "dashboard");
                $this->crud_model->update_data("employee", $emp, "employee_id");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Employee failed to save</div>"));
                exit();
            }
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Employees successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function delete($employee_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $employee = $this->crud_model->read_data("employee", array("md5(employee_id)" => $employee_id))->row();
            $this->recActivity("Deleted <b>$employee->employee_name</b> on Master Employee", "dashboard");
            $this->crud_model->delete_data("employee", array("md5(employee_id)" => "$employee_id"));
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Employee successfully removed</div>");
            echo json_encode(array("status" => 1));
        }
    }

}

?>