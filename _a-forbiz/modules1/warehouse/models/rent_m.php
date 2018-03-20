<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rent_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function equipment() {
        $data['rent'] = $this->crud_model->read_data("equipment_stock es",array("es.equipment_stock_entry"=>"is not null"),null,array("equipt_transaction et"=>"et.equipt_transaction_id = es.equipt_transaction_id","actor a"=>"a.actor_id = et.actor_id"))->result();
        foreach ($data['rent'] as $i => $row){
            $data['back'][]=  $this->crud_model->read_data()->row();
        }
    }

}
