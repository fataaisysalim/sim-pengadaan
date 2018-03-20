<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Actor extends MY_Controller {

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("actor_m");
    }

    public function info($ct = null, $actor = null, $status = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
        if (!empty($actor)) {
            if (!empty($status)) {
                if ($status != 'all') {
                    $where['actor_status'] = $status == 'active' ? 1 : 0;
                }
            }
            $where['md5(actor_category_id)'] = $actor;
            $data['ct'] = $this->crud_model->read_fordata(array("table" => "actor_category", "where" => array("md5(actor_category_id)" => $actor)))->row();
            $data["show"] = $this->crud_model->read_fordata(array("table" => "actor", "where" => $where))->result();
            $this->load->view("dashboard/actor/data", $data);
        } else {
            $actor = $this->crud_model->read_fordata(array("table" => "actor_category", "where" => array("actor_category_id" => $ct)))->row();
            $data["header"] = strtoupper($data['permit']->mod_menu_name);
            $data["show"] = $this->actor_m->all_actor(explode("-", $ct));
            $this->load->view("dashboard/actor/index", $data);
        }
    }

    public function index($ct) {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $actor = $this->crud_model->read_fordata(array("table" => "actor_category", "where" => array("actor_category_id" => $ct)))->row();
        $data['title'] = ucwords($actor->actor_category_name);
        $data['header'] = ucwords($actor->actor_category_name);
        $data['url'] = $this->uri->uri_string();
        $data['content'] = "dashboard/actor/master/index";
        $this->load->view("../index", $data);
    }

    public function form($ct = null, $id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (in_array(1, array($data['permit']->access_create, $data['permit']->access_update))) {
            $actor = $this->crud_model->read_fordata(array("table" => "actor_category", "where" => array("actor_category_id" => $ct)))->row();
            $data['header'] = ucwords($actor->actor_category_name);
            $data['act'] = (empty($id)) ? "Add" : "Edit";
            $data["ct_actor"] = $actor->actor_category_id;
            $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
            $data['url_action'] = $data['url'] . "save/$id";
            if (!empty($id) AND $data['permit']->access_update == 1) {
                $data["actor_dt"] = $this->crud_model->read_data("actor a", array("md5(actor_id)" => $id), NULL, array("actor_category ac" => "ac.actor_category_id = a.actor_category_id"))->row();
            }

            $this->load->view("dashboard/actor/master/form", $data);
        }
    }

    public function table($ct = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $actor = $this->crud_model->read_fordata(array("table" => "actor_category", "where" => array("actor_category_id" => $ct)))->row();
            $data['header'] = ucwords($actor->actor_category_name);
            $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
            $child = "(select count(actor_id) from mog where actor_id = a.actor_id) as child";
            $data["show"] = $this->crud_model->read_fordata(array("table" => "actor a", "select" => array("*, $child"), "where" => array("ac.actor_category_id" => $ct), "order" => array("actor_id" => "DESC"), "join" => array("actor_category ac" => "ac.actor_category_id = a.actor_category_id")))->result();
            $this->load->view("dashboard/actor/master/table", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data_actor['actor_category_id'] = $this->input->post("actor_ct");
        $data_actor['actor_name'] = $this->input->post("actor_name");
        $data_actor['actor_identity'] = $this->input->post("actor_identity");
        $data_actor['actor_address'] = $this->input->post("actor_address");
        $data_actor['actor_phone'] = $this->input->post("actor_phone");
        $data_actor['actor_email'] = $this->input->post("actor_email");
        $data_actor['actor_code'] = $this->input->post("actor_code");
        $data_actor['actor_pkp_date'] = date("Y-m-d", strtotime($this->input->post("actor_pkp_date")));
        $data_actor['actor_pkp_number'] = $this->input->post("actor_pkp_number");
        $data_actor['actor_tax_number'] = $this->input->post("actor_tax_number");
        $data_actor['actor_status'] = 1;
        $get_actors = $this->crud_model->read_fordata(array("table" => "actor_category", "where" => array("actor_category_id" => $data_actor['actor_category_id'])))->row();
        if ($this->input->post("actor_pkp_date_checked") == 1) :
            $data_actor['actor_pkp_date'] = null;
        endif;
        $getVendor = $this->crud_model->read_fordata(array("table" => "actor_category", "where" => array("actor_category_id" => $data_actor['actor_category_id'])))->row();
        if (empty($id)) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_name" => $data_actor['actor_name'], "actor_category_id" => $data_actor['actor_category_id'])))->num_rows();
            $names = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_name" => $data_actor['actor_name'])))->num_rows();
            $npwp = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_identity" => $data_actor['actor_identity'])))->num_rows();
            if ($duplicate == 0 && $npwp == 0 && $names == 0) {
                $this->crud_model->insert_data("actor", $data_actor);
                $this->recActivity("Created <b>$data_actor[actor_name]</b> on Master $getVendor->actor_category_name", "dashboard");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> $get_actors->actor_category_name already exist</div>"));
                exit();
            }
        } else {
            $names = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_name" => $data_actor['actor_name'], "md5(actor_id) !=" => $id)))->num_rows();
            if ($names == 0) {
                $actor = $this->crud_model->read_data("actor", array("md5(actor_id)" => $id))->row();
                $data_actor['actor_id'] = $actor->actor_id;
                $this->recActivity("Updated data <b>$data_actor[actor_name]</b> on Master $getVendor->actor_category_name", "dashboard");
                $this->crud_model->update_data("actor", $data_actor, "actor_id");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>$get_actors->actor_category_name already exist</div>"));
                exit();
            }
        }
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>$get_actors->actor_category_name successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function detail($actor_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
        $data['atr'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("actor_category ac" => "ac.actor_category_id = a.actor_category_id"), "where" => array("md5(a.actor_id)" => $actor_id)))->row();
        $this->load->view("dashboard/actor/detail", $data);
    }

    public function delete($actor_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            $this->crud_model->delete_data("actor", array("md5(actor_id)" => $actor_id));
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Supplier successfully deleted</div>");
            echo json_encode(array("status" => 1));
        }
    }

    public function status($id, $status) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_special == 1) {
            $actor = $this->crud_model->read_fordata(array("table" => "actor", "join" => array("actor_category ac" => "ac.actor_category = actor.cator_category"), "where" => array("actor_id" => $id)))->row();
            $this->recActivity("Deleted <b>$actor->actor_name</b> on Master $actor->actor_category_name", "dashboard");
            $this->crud_model->update_data("actor", array("actor_status" => $status == 2 ? 0 : 1, "actor_id" => $id), 'actor_id');
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Supplier status successfully changed</div>");
            echo json_encode(array("status" => 1));
        }
    }

    public function getdata($id) {
        $data = $this->crud_model->read_data("actor", array("actor_id" => $id))->row();
        echo json_encode(array('status' => 1, 'data' => $data));
    }

    public function getdata_nasabah($id) {
        $data = $this->crud_model->read_data("mst_nasabah_konstruksi", array("id" => $id))->row();
        echo json_encode(array('status' => 1, 'data' => $data));
    }

}

?>