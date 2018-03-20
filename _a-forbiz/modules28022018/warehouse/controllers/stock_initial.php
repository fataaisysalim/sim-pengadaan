<?php

class Stock_initial extends MY_Controller {

    private $title = "Stock";
    private $header = "Stock";
    private $url = "warehouse/stock_initial/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_update == 1) {
            $data['title'] = "Inistial Stock";
            $data['url_access'] = $this->url;
            $data['url_action'] = $this->url . "saving";
            $data['content'] = "warehouse/stock/initial_stock";
            $data["actor"] = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_category_id" => 1), "or_where" => array("actor_category_id" => 2)))->result();
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();
            $this->load->view("../index", $data);
        }
    }

    public function table($resource = NULL, $projec_id = NULL, $actor = NULL) {
        if (!empty($resource) && !empty($projec_id)) {
            if ($resource == 1) {
                $data['resource'] = 'material';
                $param_search = $actor;
                $check_stock = $this->crud_model->read_fordata(array("table" => "stock_final", "where" => array("project_id" => $projec_id)))->num_rows();
                if ($check_stock == 0) {
                    $data['data'] = $this->crud_model->read_fordata(array("table" => "material_sub ms", "join" => array("material_unit mu" => "mu.material_unit_id = ms.material_unit_id")))->result();
                } else {
                    $sql_where = null;
                    if(!empty($param_search)){
                        $sql_where = " where ms.material_sub_name like '%$param_search%'";
                    }
                    $child = "(select count(material_sub_id) from mog_dt join mog on (mog.mog_id = mog_dt.mog_id) where project_id = $projec_id and material_sub_id = ms.material_sub_id) as child";
                    $child_2 = "(select stock_final_rest from stock_final where project_id = $projec_id and material_sub_id = ms.material_sub_id) as stock";
                    $data['data'] = $this->db->query("select *,$child , $child_2 from material_sub ms join material_unit mu on mu.material_unit_id = ms.material_unit_id $sql_where group by ms.material_sub_id")->result();
                }
            } else if ($resource == 2) {
                $data['resource'] = 'equipment';
                $check_stock = $this->crud_model->read_fordata(array("table" => "equipment_stock_final", "where" => array("project_id" => $projec_id, "actor_id" => $actor)))->num_rows();

                if ($check_stock == 0) {
                    $data['data'] = $this->crud_model->read_fordata(array("table" => "equipment e", "join" => array("equipment_unit eu" => "eu.equipment_unit_id = e.equipment_unit_id")))->result();
                } else {
                    $child = "(select count(equipment_id) from equipt_transaction_dt dt join equipt_transaction et on (et.equipt_transaction_id = dt.equipt_transaction_id) where project_id = $projec_id and equipment_id = e.equipment_id) as child";
                    $child_2 = "(select equipment_stock_final_rest from equipment_stock_final where project_id = $projec_id and actor_id = $actor and equipment_id = e.equipment_id) as stock";
                    $data['data'] = $this->crud_model->read_fordata(array("select" => array("*, $child, $child_2"), "table" => "equipment e", "join" => array("equipment_unit eu" => "eu.equipment_unit_id = e.equipment_unit_id"), "group" => "e.equipment_id"))->result();
                }
            }
            $this->load->view("warehouse/stock/initial_stock_table", $data);
        }
    }

    public function saving() {
        $resource = $this->input->post('resource') ? array_filter($this->input->post('resource')) : NULL;
        $volume = $this->input->post('volume') ? array_filter($this->input->post('volume')) : NULL;
        $action = $this->input->post('action');

        $date = date('Y-m-d H:i:s');
        for ($in = 0; $in < count($resource); $in++) {

            if ($this->input->post('resource_ct') == 1) {
                $table = 'stock';
                $table2 = 'material_sub_id';
                $stock_final_id = 'stock_final_id';
                $stock_id = 'stock_id';

                $stock_fn[$action[$in]]['material_sub_id'] = $resource[$in];
                $src = $stock_fn[$action[$in]]['material_sub_id'];
                $stock[$action[$in]]['material_sub_id'] = $resource[$in];
                $stock[$action[$in]]['mog_id'] = NULL;
                $restock[$in] = $this->crud_model->read_fordata(array("table" => "mog_dt", "where" => array("material_sub_id" => $resource[$in])))->num_rows();
                if ($action[$in] == 'edit') {
                    $finaltock[$in] = $this->crud_model->read_fordata(array("table" => "stock_final", "where" => array("material_sub_id" => $resource[$in])))->row()->stock_final_rest;
                }
            } else if ($this->input->post('resource_ct') == 2) {
                $table = 'equipment_stock';
                $table2 = 'equipment_id';
                $stock_final_id = 'equipment_stock_final_id';
                $stock_id = 'equipment_stock_id';
                $stock[$action[$in]]["actor_id"] = $this->input->post('actor');
                $stock_fn[$action[$in]]['equipment_id'] = $resource[$in];
                $src = $stock_fn[$action[$in]]['equipment_id'];
                $stock[$action[$in]]['equipment_id'] = $resource[$in];
                $stock_fn[$action[$in]]["actor_id"] = $this->input->post('actor');
                $stock[$action[$in]]['equipt_transaction_id'] = NULL;
                $restock[$in] = $this->crud_model->read_fordata(array("table" => "equipt_transaction_dt", "where" => array("equipment_id" => $resource[$in])))->num_rows();
                if ($action[$in] == 'edit') {
                    $finaltock[$in] = $this->crud_model->read_fordata(array("table" => "equipment_stock_final", "where" => array("equipment_id" => $resource[$in])))->row()->equipment_stock_final_rest;
                }
            }
            if ($restock[$in] < 1) {

                $stock[$action[$in]]['project_id'] = $this->input->post('project');
                $stock[$action[$in]][$table . '_entry'] = !isset($volume[$in]) ? 0 : str_replace(",", ".", str_replace(".", "", $volume[$in]));
                $stock[$action[$in]][$table . '_rest'] = !isset($volume[$in]) ? 0 : str_replace(",", ".", str_replace(".", "", $volume[$in]));

                $stock[$action[$in]][$table . '_date'] = $date;
                $stock_fn[$action[$in]]['project_id'] = $stock[$action[$in]]['project_id'];
                $stock_fn[$action[$in]][$table . '_final_rest'] = !isset($volume[$in]) ? 0 : str_replace(",", ".", str_replace(".", "", $volume[$in]));
                $stock_fn[$action[$in]][$table . '_final_date'] = $date;
                if ($action[$in] == 'add') {
                    $this->crud_model->insert_data($table, $stock['add']);
                    $this->crud_model->insert_data($table . '_final', $stock_fn['add']);
                    $this->recActivity("Setup initial stock", "warehouse");
                } else if ($action[$in] == 'edit') {
                    if ($finaltock[$in] != $stock_fn[$action[$in]][$table . '_final_rest']) {
                        $getdata1 = $this->crud_model->read_fordata(array("table" => $table . '_final', "where" => array("project_id" => $this->input->post('project'), "$table2" => $src)))->row();
                        $getdata2 = $this->crud_model->read_fordata(array("table" => $table, "where" => array("project_id" => $this->input->post('project'), "$table2" => $src)))->row();

                        $stock_fn['edit'][$table . '_final_id'] = $getdata1->$stock_final_id;
                        $stock['edit'][$table . '_id'] = $getdata2->$stock_id;

                        $this->crud_model->update_data($table, $stock['edit'], $table . '_id');
                        $this->crud_model->update_data($table . '_final', $stock_fn['edit'], $table . '_final_id');
                        $this->recActivity("Memperbarui stock opname", "warehouse");
                    }
                }
            }
        }
        $this->session->set_flashdata("msg", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Initial stock successfully saved</div>");
        redirect("warehouse/stock_initial");
    }

}

?>