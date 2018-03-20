<?php

class Stock extends MY_Controller {

    private $title = "Stock";
    private $header = "Stock";
    private $url = "warehouse/stock/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function material($ct = null, $project = null, $type = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (!empty($ct)) {

//            $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
//            $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
            $where["md5(m.material_category_id)"] = $ct;
            $where["ms.material_sub_status"] = 1;
            $where["m.material_status"] = 1;
//            $where["DATE(sf.stock_final_date) >="] = date2mysql($data['starts']);
//            $where["DATE(sf.stock_final_date) <="] = date2mysql($data['ends']);
            if (!empty($type)) {
                $where["md5(m.material_id)"] = $type;
            }
            $where["md5(sf.project_id)"] = md5(1);
            if (!empty($project)) {
                $where["md5(sf.project_id)"] = $project;
            }
            $data['category'] = $this->crud_model->read_data("material_category", array("md5(material_category_id)" => $ct))->row();
            $data['material'] = $this->crud_model->read_data("material_sub ms", $where, array("ms.material_sub_id" => "DESC"), array("material m" => "m.material_id = ms.material_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id", "stock_final sf" => "sf.material_sub_id = ms.material_sub_id"))->result();
            $this->load->view("warehouse/info/stock/material/data", $data);
        } else {
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();
            $data['material'] = $this->origin_model->material_stock(1);
            $this->load->view("warehouse/info/stock/material/index", $data);
        }
    }

    public function equipment($ct = null, $project = null, $actor = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (!empty($ct)) {
//            $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
//            $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
            $where["md5(eq.equipment_ct_id)"] = $ct;
            $where["eq.equipment_status"] = 1;
            $where["md5(sf.project_id)"] = md5(1);
            if (!empty($project)) {
                $where["md5(sf.project_id)"] = $project;
            }
            if (!empty($actor)) {
                $where['md5(sf.actor_id)'] = $actor;
            }
            $data['category'] = $this->crud_model->read_data("equipment_ct", array("md5(equipment_ct_id)" => $ct))->row();
            $data['equipment'] = $this->crud_model->read_data("equipment eq", $where, array("eq.equipment_id" => "DESC"), array("equipment_unit eu" => "eu.equipment_unit_id = eq.equipment_unit_id", "equipment_stock_final sf" => "eq.equipment_id = sf.equipment_id", "actor ac" => "sf.actor_id = ac.actor_id"))->result();
            $this->load->view("warehouse/info/stock/equipment/data", $data);
        } else {
            $data['supplier'] = $this->origin_model->actor(1);
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();
            $data['show'] = $this->origin_model->equipment();
            $this->load->view("warehouse/info/stock/equipment/index", $data);
        }
    }

    public function detail($feature = null, $item = null, $actor = null) {
//        $data['starts'] = !empty($start) ? strtotime($start) > strtotime($end) ? $end : $start : date("d-m-Y");
//        $data['ends'] = !empty($end) ? strtotime($start) > strtotime($end) ? $start : $end : date("d-m-Y");
        $data['sess'] = $this->authentication_root();
        $data['item'] = $item;
        $data['actors'] = $actor;
        if ($feature == 'material') {
            $data['mt'] = $this->crud_model->read_data("material_sub", array("md5(material_sub_id)" => $item))->row();
            $data['material'] = $this->crud_model->read_data("stock st", array("md5(st.material_sub_id)" => $item), null, array("mog" => array("mog.mog_id = st.mog_id", "left"), "actor ac" => array("ac.actor_id = mog.actor_id", "left")))->result();
            $this->load->view("warehouse/info/stock/material/detail", $data);
        } elseif ($feature == 'equipment') {
            $where["md5(st.equipment_id)"] = "$item";
//            if (!empty($start)) {
//                $where["DATE(st.equipment_stock_date) >="] = date2mysql($data['starts']);
//            }
//            if (!empty($end)) {
//                $where["DATE(st.equipment_stock_date) <="] = date2mysql($data['ends']);
//            }
            $where["md5(st.equipment_id)"] = "$item";
            if (!empty($actor)) {
                $where['md5(et.actor_id)'] = $actor;
            }
            $data['actor'] = $this->crud_model->read_data("actor", array('md5(actor_id)' => $actor))->row();
            $data['eq'] = $this->crud_model->read_data("equipment", array("md5(equipment_id)" => "$item"))->row();
            $data['equipment'] = $this->crud_model->read_data("equipment_stock st", $where, null, array("equipt_transaction et" => array("st.equipt_transaction_id = et.equipt_transaction_id", "left"), "actor ac" => array("ac.actor_id = et.actor_id", "left")))->result();
            $this->load->view("warehouse/info/stock/equipment/detail", $data);
        }
    }

    public function get_material($id) {
        $data = $this->crud_model->read_fordata(array("table" => "material_sub ms", "join" => array("stock_final sf" => "sf.material_sub_id = ms.material_sub_id"), "where" => array("ms.material_sub_id" => $id)))->row();
        echo json_encode(array('status' => 1, 'data' => $data));
    }

}

?>