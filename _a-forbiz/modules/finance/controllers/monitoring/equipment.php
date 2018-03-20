<?php

class Equipment extends MY_Controller {

    private $title = "Stock";
    private $header = "Stock";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function index($project = null, $actor = null) {
        $data['sess'] = $this->authentication_root();
        if (!empty($actor)) {
            $where = array(
                "md5(et.project_id)" => $project,
            );
            $join = array(
                "equipt_transaction et" => array("et.equipt_transaction_id = st.equipt_transaction_id", "LEFT"),
                "actor ac" => array('et.actor_id = ac.actor_id', 'LEFT'),
                "equipment eq" => array("eq.equipment_id = st.equipment_id", "LEFT"),
            );
            if ($actor != 'all' && $actor != '') :
                $where['md5(et.actor_id)'] = $actor;
            endif;
            $order = array("et.actor_id, st.equipment_stock_date, st.equipment_id" => "ASC");
            $group = 'st.equipment_stock_date, st.equipment_id';
            $select = '*, SUM(equipment_stock_rest) as equipment_stock_sum';
            $data['show'] = $this->crud_model->read_data("equipment_stock st", $where, $order, $join, null, $group, $select)->result();
            $this->load->view("finance/info/stock/equipment/data", $data);
        } else {
            $data['supplier'] = $this->origin_model->actor(1);
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project"))->result();
            $this->load->view("finance/info/stock/equipment/index", $data);
        }
    }

}
