<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Logpage extends MY_Controller {

    private $title = "Template Login";
    private $header = "Template Login";
    private $url = "dashboard/login-page/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['gallery_m'] = 1;
        $data['gallery_sm'] = 1;
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['url_access'] = $this->url;
        $data['js_load'] = "extend/js_fancybox";
        $data['content'] = "dashboard/login_page/index";
        $this->load->view("../index", $data);
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['header'] = $this->header;
        $data['data'] = $this->crud_model->read_fordata(array("table" => "page_config", "where" => array("page_config_ct_id" => 1)))->result();
        $this->load->view("dashboard/login_page/table", $data);
    }

    public function form($id = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['header'] = $this->header;
        $data['url_access'] = $this->url;
        $data['pageid'] = !empty($id) ? $id : null;
        $data['act'] = !empty($id) ? "Edit" : "Add";
        if (!empty($id)) {
            $data['dt'] = $this->crud_model->read_fordata(array("table" => "page_config", "where" => array("md5(page_config_id)" => $id)))->row();
        }
        $this->load->view("dashboard/login_page/form", $data);
    }

    public function save($id = null) {
        if (!empty($_FILES['filetemplate']['name'])) :
            $this->load->library('libs_function');
            $file_random = rand(00000000000, 99999999999);
            $file_name = $file_random . $_FILES['filetemplate']['name'];
            $file_url = "assets/files/login-page/";
            $this->libs_function->upload_single_image($file_url, $file_name, "filetemplate");
            $data['page_config_picture'] = $this->libs_function->upload_regex_character($file_url, $file_name);
        endif;
        $data['page_config_name'] = $this->input->post("page_name");
        $data['page_config_url'] = $this->input->post("page_url");
        $data['page_config_ct_id'] = 1;
        if (!empty($id)) {
            $getpage = $this->crud_model->read_fordata(array("table" => "page_config", "where" => array("md5(page_config_id)" => $id)))->row();
            $data['page_config_id'] = $getpage->page_config_id;
            $this->crud_model->update_data("page_config", $data, "page_config_id");
            $action = "Updated";
        } else {
            $this->crud_model->insert_data("page_config", $data);
            $action = "Created";
        }
        $this->session->set_flashdata("messageform", "<div class='alert alert-success row alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Login page successfully $action</div>");
        redirect($this->url);
    }

    public function status($id = null, $status = null) {
        if ($status == "active") {
            $reset['page_config_status'] = 0;
            $this->crud_model->update_data("page_config", $reset);
            $getpage = $this->crud_model->read_fordata(array("table" => "page_config", "where" => array("md5(page_config_id)" => $id)))->row();
            $data['page_config_id'] = $getpage->page_config_id;
            $data['page_config_status'] = $status == "active" ? 1 : 0;
            $this->crud_model->update_data("page_config", $data, "page_config_id");
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Login page successfully updated</div>");
            echo json_encode(array("status" => 1));
        } else {
            $getpage = $this->crud_model->read_fordata(array("table" => "page_config", "where" => array("md5(page_config_id) !=" => $id, "page_config_status" => 0)))->result();
            if (count($getpage) < 1) {
                $this->session->set_flashdata("message", "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Login page cannot updated, one page must be showed</div>");
                echo json_encode(array("status" => 0));
            } else {
                $data['page_config_id'] = $getpage->page_config_id;
                $data['page_config_status'] = $status == "active" ? 1 : 0;
                $this->crud_model->update_data("page_config", $data, "page_config_id");
                $this->recActivity("Changed status login page to hide", "dashboard");
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Login page successfully updated</div>");
                echo json_encode(array("status" => 1));
            }
        }
    }

    public function delete($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $get = $this->crud_model->read_data("page_config", array("md5(page_config_id)" => $id), NULL)->row();
            if (count($get) > 0) :
                if (file_exists($get->page_config_picture)) :
                    unlink($get->page_config_picture);
                endif;
                $this->crud_model->delete_data("page_config", array("md5(page_config_id)" => $id));
                $this->recActivity("Deleted template <b>$get->page_config_name</b> on Template Login", "dashboard");
            endif;
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Template successfully deleted</div>");

            echo json_encode(array("status" => 1));
        }
    }

}