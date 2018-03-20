<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Project extends MY_Controller {

    private $title = "Project";
    private $header = "project";
    private $url = "dashboard/project/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($ct = null) {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['project_m'] = 1;
        $data['project_sm'] = 1;
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['url_access'] = $this->url;
        $data['content'] = "dashboard/project/index";
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
                $data["project_dt"] = $this->crud_model->read_data("project p", array("md5(project_id)" => $id), NULL)->row();
            }
            $this->load->view("dashboard/project/form", $data);
        }
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $child = "(select count(project_id) from project_access where project_id = p.project_id) as child";
            $data["show"] = $this->crud_model->read_data("project p", NULL, array("project_id" => "DESC"), NULL, NULL, NULL, array("*", $child))->result();

            $this->load->view("dashboard/project/table", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $pro['project_name'] = ucwords($this->input->post("project_name"));
        $pro['project_address'] = $this->input->post("project_address");
        $pro['project_number'] = strtoupper($this->input->post("project_number"));
        $pro['project_code'] = strtoupper($this->input->post("project_code"));
        $pro['project_region'] = strtoupper($this->input->post("project_region"));

        if (empty($id)) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "project", "where" => array("project_name" => $pro['project_name']), "or_where" => array("project_number" => $pro['project_number']), "or_where" => array("project_code" => $pro['project_code'])))->num_rows();
            if ($duplicate == 0) {
                $this->crud_model->insert_data("project", $pro);
                $this->recActivity("Created <b>$pro[project_name]</b> on Master Project", "dashboard");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Project Failed saved</div>"));
                exit();
            }
        } else {
            $project = $this->crud_model->read_data("project", array("md5(project_id)" => $id))->row();
            $duplicate = $this->crud_model->read_fordata(array("table" => "project", "where" => array("project_name" => $pro['project_name'], "project_code" => $pro['project_code'], "project_number" => $pro['project_number'], "md5(project_id) !=" => $id)))->num_rows();
            if ($duplicate == 0) {
                $pro['project_id'] = $project->project_id;
                $this->crud_model->update_data("project", $pro, "project_id");
                $this->recActivity("Updated data <b>$pro[project_name]</b> on Master Project", "dashboard");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Project Failed saved</div>"));
                exit();
            }
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Project successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function delete($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $project = $this->crud_model->read_data("project", array("md5(project_id)" => $id))->row();
            $this->recActivity("Deleted <b>$project->project_name</b> on Master Project", "dashboard");
            $this->crud_model->delete_data("project", array("md5(project_id)" => $id));
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Project successfully deleted</div>");
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