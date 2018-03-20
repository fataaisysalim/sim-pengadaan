<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Gallery extends MY_Controller {

    private $title = "Gallery";
    private $header = "gallery";
    private $url = "dashboard/gallery/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($ct = null) {
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
        $data['content'] = "dashboard/gallery/index";
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
                $data["gallery_dt"] = $this->crud_model->read_data("apps_gallery", array("md5(apps_gallery_id)" => $id), NULL)->row();
            }
            $this->load->view("dashboard/gallery/form", $data);
        }
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $data["show"] = $this->crud_model->read_data("apps_gallery")->result();
            $this->load->view("dashboard/gallery/table", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();

        if (!empty($_FILES['userfile']['name'])) :
            $file_random = rand(00000000000, 99999999999);
            $file_name = $file_random . $_FILES['userfile']['name'];
            $file_url = "assets/folarium/gallery/";

            $this->load->library('libs_function');

            $pro['apps_gallery_files'] = $this->libs_function->upload_regex_character($file_url, $file_name);
            $pro['apps_gallery_date'] = $this->input->post("apps_gallery_date");
            $pro['apps_gallery_status'] = $this->input->post("apps_gallery_status");
            $pro['apps_gallery_note'] = $this->input->post("apps_gallery_note");

            $this->libs_function->upload_single_image($file_url, $file_name);

            if (empty($id)) {
                $this->crud_model->insert_data("apps_gallery", $pro);
                $this->recActivity("Uploaded <b>$pro[apps_gallery_files]</b> on Login Gallery", "dashboard");
            } else {
                $gallery = $this->crud_model->read_data("apps_gallery", array("md5(apps_gallery_id)" => $id))->row();
                $pro['apps_gallery_id'] = $gallery->apps_gallery_id;
                if (file_exists($gallery->apps_galery_files)) :
                    unlink($gallery->apps_gallery_files);
                endif;
                $this->crud_model->update_data("apps_gallery", $pro, "apps_gallery_id");
            }
        endif;
        redirect($this->url);
    }

    public function status($id = NULL, $mode = null) {
        if ($mode == null) :
            $check = $this->crud_model->read_data("apps_gallery", array("apps_gallery_status" => 1, "md5(apps_gallery_id) !=" => $id), NULL)->result();
            if (count($check) < 4) :
                $get = $this->crud_model->read_data("apps_gallery", array("md5(apps_gallery_id)" => $id), NULL)->row();
                if (count($get) > 0) :
                    $pro['apps_gallery_id'] = $get->apps_gallery_id;
                    $pro['apps_gallery_status'] = 1;
                    $this->crud_model->update_data("apps_gallery", $pro, "apps_gallery_id");
                    $this->recActivity("Changed status gallery <b>$get->apps_gallery_files</b> to show", "dashboard");
                endif;
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Gallery successfully updated</div>");
                echo json_encode(array("status" => 1));
            else:
                $this->session->set_flashdata("message", "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Gallery cannot updated</div>");
                echo json_encode(array("status" => 0));
            endif;
        else:
            $check = $this->crud_model->read_data("apps_gallery", array("apps_gallery_status" => 1, "md5(apps_gallery_id) !=" => $id), NULL)->result();
            if (count($check) > 0) :
                $get = $this->crud_model->read_data("apps_gallery", array("md5(apps_gallery_id)" => $id), NULL)->row();
                $pro['apps_gallery_id'] = $get->apps_gallery_id;
                $pro['apps_gallery_status'] = 0;
                $this->crud_model->update_data("apps_gallery", $pro, "apps_gallery_id");
                $this->recActivity("Changed status gallery <b>$get->apps_gallery_files</b> to hide", "dashboard");
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Gallery successfully updated</div>");
                echo json_encode(array("status" => 1));
            else:
                $this->session->set_flashdata("message", "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Gallery cannot updated, one gallery must be showed</div>");
                echo json_encode(array("status" => 0));
            endif;
        endif;
//        redirect($this->url);
    }

    public function delete($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {

            $get = $this->crud_model->read_data("apps_gallery", array("md5(apps_gallery_id)" => $id), NULL)->row();
            if (count($get) > 0) :
                if (file_exists($get->apps_gallery_files)) :
                    unlink($get->apps_gallery_files);
                endif;
                $this->crud_model->delete_data("apps_gallery", array("md5(apps_gallery_id)" => $id));
                $this->recActivity("Deleted gallery <b>$get->apps_gallery_files</b> on Gallery Login", "dashboard");
            endif;
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Gallery successfully deleted</div>");

            echo json_encode(array("status" => 1));
        }
    }

}
