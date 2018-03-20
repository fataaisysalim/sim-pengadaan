<?php

class Material extends MY_Controller {

    private $title = "Material";
    private $header = "material";
    private $url = "warehouse/material/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("origin_model");
    }

    function index() {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['url_access'] = $this->url;
        $data['content'] = "warehouse/master/material/index";
        $this->load->view("../index", $data);
    }

    public function info($ct = null, $status = null, $unit = null, $type = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (!empty($ct)) {
            if (!empty($status)) {
                if ($status != 'all') {
                    $where['ms.material_sub_status'] = $status == 'active' ? 1 : 0;
                }
            }
            if (!empty($unit)) {
                if ($unit != 'all') {
                    $where['ms.material_unit_id'] = $unit;
                }
            }
            if (!empty($type)) {
                if ($type != 'all') {
                    $where['ms.material_id'] = $type;
                }
            }
            $where['md5(m.material_category_id)'] = $ct;
            $data['material'] = $this->crud_model->read_data("material_sub ms", $where, array("ms.material_sub_id" => "DESC"), array("material m" => "m.material_id = ms.material_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"))->result();
            $this->load->view("warehouse/info/material/data", $data);
        } else {
            $data['material'] = $this->origin_model->material();
            $this->load->view("warehouse/info/material/index", $data);
        }
    }

    public function form($feature = NULL, $id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];

        if (in_array(1, array($data['permit']->access_create, $data['permit']->access_update))) {
            $data['act'] = (empty($id)) ? "Add" : "Edit";
            $data['url_access'] = "$this->url";
            $data['header'] = $this->header;

            if (!empty($feature)) {
                if ($feature == 'material_sub') {
                    $data['material_unit'] = $this->crud_model->read_data("material_unit", null, array("material_unit_name" => "ASC"))->result();
                    $data['material'] = $this->origin_model->material();
                }

                if ($feature == 'material') {

                    $data['material_category'] = $this->crud_model->read_data("material_category")->result();
                }

                if (!empty($id)) {
                    $data[$feature . "_dt"] = $this->crud_model->read_data($feature, array("md5(" . $feature . "_id)" => $id))->row();
                }
                $this->load->view("warehouse/master/" . $feature . "/" . $feature . "_form", $data);
            }
        }
    }

    public function table($feature = NULL, $join = NULL, $child = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            if (!empty($feature)) {
                if ($feature == 'material') {
                    $child = "(select count(material_id) from material_sub where material_id = material.material_id) as child";
                    $join = array("material_category mc" => "mc.material_category_id = material.material_category_id");
                }

                if ($feature == 'material_unit') {
                    $child = "(select count(material_unit_id) from material where material_unit_id = material_unit.material_unit_id) as child";
                }

                if ($feature == 'material_category') {
                    $child = "(select count(material_category_id) from material where material_category_id = material_category.material_category_id) as child";
                }

                if ($feature == 'material_sub') {
                    $data["$feature"] = $this->origin_model->material(1);
//                $join = array("material m" => "m.material_id = material_sub.material_id", "material_unit mu" => array("mu.material_unit_id = material_sub.material_unit_id", "left"));
//                $data["$feature"] = $this->crud_model->read_data($feature, NULL, array($feature . "_id" => "DESC"), $join, NULL, NULL, array("*", $child))->result();
                } else {
                    $data["$feature"] = $this->crud_model->read_data($feature, NULL, array($feature . "_id" => "DESC"), $join, NULL, NULL, array("*", $child))->result();
                }
                $this->load->view("warehouse/master/" . $feature . "/" . $feature . "_table", $data);
            }
        }
    }

    function unit() {
        $data['unit'] = $this->crud_model->read_data("material_unit", NULL, array("material_unit_id" => "DESC"))->result();
        $this->load->view("warehouse/master/material_unit/index", $data);
    }

    public function save_unit() {
        $data['material_unit_name'] = strtoupper($this->input->post('material_unit_name'));
        if ($this->input->post('action') == md5('Add')) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "material_unit", "where" => $data))->num_rows();
            if ($duplicate == 0) {
                $this->crud_model->insert_data("material_unit", $data);
                $this->recActivity("Created <b>$data[material_unit_name]</b> on Master Material Unit", "warehouse");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Unit already exist</div>"));
                exit();
            }
            $action = "tambah";
        } else if ($this->input->post('action') == md5('Edit')) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "material_unit", "where" => array("material_unit_name" => $this->input->post('material_unit_name'), "material_unit_id !=" => $this->input->post('material_unit_id'))))->num_rows();
            if ($duplicate == 0) {
                $data['material_unit_id'] = $this->input->post('material_unit_id');
                $this->crud_model->update_data("material_unit", $data, "material_unit_id");
                $this->recActivity("Updated <b>$data[material_unit_name]</b> on Master Material Unit", "warehouse");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Unit already exist</div>"));
                exit();
            }
            $action = "edit";
        }
        $this->session->set_flashdata("message_u", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Unit successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function save_category() {
        $data['material_category_name'] = strtoupper($this->input->post('material_category_name'));
        $actions = null;
        if ($this->input->post('action') == md5('Add')) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "material_category", "where" => $data))->num_rows();
            if ($duplicate == 0) {
                $this->crud_model->insert_data("material_category", $data);
                $this->recActivity("Created <b>$data[material_category_name]</b> on Master Material Category", "warehouse");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Category already exist</div>"));
                exit();
            }
            $actions = "tambah";
        } else if ($this->input->post('action') == md5('Edit')) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "material_category", "where" => array("material_category_name" => $this->input->post('material_category_name'), "material_category_id !=" => $this->input->post('material_unit_id'))))->num_rows();
            if ($duplicate == 0) {
                $data['material_category_id'] = $this->input->post('material_category_id');
                $this->crud_model->update_data("material_category", $data, "material_category_id");
                $this->recActivity("Updated <b>$data[material_category_name]</b> on Master Material Category", "warehouse");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Category already exist</div>"));
                exit();
            }
            $actions = "edit";
        }
        $this->session->set_flashdata("message_ct", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Category successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function save_material() {
        $data['material_name'] = strtoupper($this->input->post('material_name'));
        $data['material_code'] = strtoupper($this->input->post('material_code'));
        $data['material_status'] = 1;

        $data['material_category_id'] = $this->input->post('material_category');

        if ($this->input->post('action') == md5('Add')) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "material", "where" => array("material_name" => $data['material_name'], "material_category_id" => $data['material_category_id'])))->num_rows();
            if ($duplicate == 0) {
                $db = $this->crud_model->insert_data("material", $data);
                $this->recActivity("Created <b>$data[material_name]</b> on Master Material Sub", "warehouse");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Material type already exist</div>"));
                exit();
            }
            $action = "tambah";
        } else if ($this->input->post('action') == md5('Edit')) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "material", "where" => array("material_name" => $data['material_name'], "material_category_id" => $data['material_category_id'], "material_id !=" => $this->input->post('material_id'))))->num_rows();
            if ($duplicate == 0) {
                $data['material_id'] = $this->input->post('material_id');
                $db = $this->crud_model->update_data("material", $data, "material_id");
                $this->recActivity("Updated <b>$data[material_name]</b> on Master Material Sub", "warehouse");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Material type already exist</div>"));
                exit();
            }
            $action = "edit";
        }
        $this->session->set_flashdata("message_m", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Material type successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function save_sub() {
        $data['material_sub_name'] = strtoupper($this->input->post('material_sub_name'));
        $data['material_sub_price'] = str_replace(",", ".", str_replace('.', '', $this->input->post('material_sub_price')));
        $data['material_sub_status'] = 1;
        $data['material_unit_id'] = $this->input->post('material_unit');
        $data['material_id'] = $this->input->post('material');
        $data['material_sub_convertion'] = str_replace(",", ".", str_replace('.', '', $this->input->post('conversion_qty')));
//        print_r($data);
//        exit();
        if ($this->input->post('action') == md5('Add')) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "material_sub", "where" => array("material_sub_name" => $data['material_sub_name'], "material_id" => $data['material_id'], "material_sub_price" => $data['material_sub_price'], "material_sub_convertion" => $data['material_sub_convertion'])))->num_rows();
            if ($duplicate == 0) {
                $db = $this->crud_model->insert_data("material_sub", $data);
                $this->recActivity("Created <b>$data[material_sub_name]</b> on Master Material", "warehouse");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Material already exist</div>"));
                exit();
            }
            $action = "tambah";
        } else if ($this->input->post('action') == md5('Edit')) {
            $duplicate = $this->crud_model->read_fordata(array("table" => "material_sub", "where" => array("material_sub_name" => $data['material_sub_name'], "material_id" => $data['material_id'], "material_sub_price" => $data['material_sub_price'], "material_sub_convertion" => $data['material_sub_convertion'], "material_sub_id !=" => $this->input->post('material_sub_id'))))->num_rows();
            if ($duplicate == 0) {
                $data['material_sub_id'] = $this->input->post('material_sub_id');
                $db = $this->crud_model->update_data("material_sub", $data, "material_sub_id");
                $this->recActivity("Updated <b>$data[material_sub_name]</b> on Master Material", "warehouse");
            } else {
                echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Material already exist</div>"));
                exit();
            }
            $action = "edit";
        }
        $this->session->set_flashdata("message_sub", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Material successfully saved</div>");
        echo json_encode(array('status' => 1));
    }

    public function delete($feature = NULL, $id) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_delete == 1) {
            if (empty($feature)) {
                $get = $this->crud_model->read_data("material_sub", array("md5(material_sub_id)" => $id))->row();
                $this->recActivity("Deleted <b>$get->material_sub_name</b> of Master Material", "warehouse");
                $this->crud_model->delete_data("material_sub", array("md5(material_sub_id)" => $id));
                $action = "Material Sub";
                $alias = "sub";
            } else {
                if ($feature == md5('material_sub')) {
                    $get = $this->crud_model->read_data("material_sub", array("md5(material_sub_id)" => $id))->row();
                    $this->recActivity("Deleted <b>$get->material_sub_name</b> of Master Material", "warehouse");
                    $this->crud_model->delete_data("material_sub", array("md5(material_sub_id)" => $id));
                    $action = "Material Sub";
                    $alias = "sub";
                }
                if ($feature == md5('unit')) {
                    $get = $this->crud_model->read_data("material_unit", array("md5(material_unit_id)" => $id))->row();
                    $this->recActivity("Deleted <b>$get->material_unit_name</b> of Master Material Unit", "warehouse");
                    $this->crud_model->delete_data("material_unit", array("md5(material_unit_id)" => $id));
                    $action = "Material Unit";
                    $alias = "u";
                }
                if ($feature == md5('material')) {
                    $get = $this->crud_model->read_data("material", array("md5(material_id)" => $id))->row();
                    $this->recActivity("Deleted <b>$get->material_name</b> of Master Material Sub", "warehouse");
                    $this->crud_model->delete_data("material", array("md5(material_id)" => $id));
                    $action = "Material";
                    $alias = "m";
                }
                if ($feature == md5('category')) {
                    $get = $this->crud_model->read_data("material_category", array("md5(material_category_id)" => $id))->row();
                    $this->recActivity("Deleted <b>$get->material_category_name</b> of Master Material Category", "warehouse");
                    $this->crud_model->delete_data("material_category", array("md5(material_category_id)" => $id));
                    $action = "Material kategori";
                    $alias = "ct";
                }
            }
            $this->session->set_flashdata("message_$alias", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Material successfully saved</div>");
            echo json_encode(array('status' => 1));
        }
    }

    public function get_unit($id = NULL, $project = NULL) {
        $data = $this->crud_model->read_fordata(array("table" => "material_sub ms", "join" => array("material_unit mu" => "ms.material_unit_id = mu.material_unit_id"), "where" => array("material_sub_id" => $id)))->row();
        $stock_fn = $this->crud_model->read_fordata(array("table" => "stock_final", "where" => array("project_id" => $project, "material_sub_id" => $id)))->num_rows();
        echo json_encode(array('status' => 1, 'data' => $data, 'stock_fn' => $stock_fn));
    }

    public function get_material($project_id = NULL) {
        if (!empty($project_id)) {
            $data['material'] = $this->crud_model->read_fordata(array("select" => array("material_sub_name, sf.material_sub_id, stock_final_rest"), "table" => "stock_final sf", "join" => array("material_sub ms" => "ms.material_sub_id = sf.material_sub_id"), "where" => array("project_id" => $project_id)))->result();
            echo json_encode(array('status' => 1, 'data' => $data));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function status($id, $status) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_special == 1) {
            $statuss = $status == 2 ? "nonactive" : "active";
            $get = $this->crud_model->read_data("material_sub", array("material_sub_id" => $id))->row();
            $this->recActivity("Changed status <b>$get->material_sub_name</b> to $statuss on Master Material", "warehouse");
            $this->crud_model->update_data("material_sub", array("material_sub_status" => $status == 2 ? 0 : 1, "material_sub_id" => $id), 'material_sub_id');
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Material status successfully changed</div>");
            echo json_encode(array("status" => 1));
        }
    }

}

?>