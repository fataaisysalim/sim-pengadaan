<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->flush_cache();
    }

   public function show_invoice_detail($id, $resource) {
        if($resource == 1) {
           $this->db->join("mog", "mog.mog_id = id.transaction_id");
           $this->db->join("mog_dt md", "mog.mog_id = md.mog_id");
           $this->db->join("code c", "c.code_id = md.code_id");
           $this->db->join("material_sub ms", "ms.material_sub_id = md.material_sub_id");
           $this->db->join("material_unit mu", "mu.material_unit_id = ms.material_unit_id");
        } else if($resuorce == 2) {
           $this->db->join("equipt_transaction et", "et.equipt_transaction_id = id.transaction_id");
           $this->db->join("equipt_transaction_dt etd", "etd.equipt_transaction_id = et.equipt_transaction_id");
           $this->db->join("code c", "c.code_id = etd.code_id");
           $this->db->join("equipment e", "e.equipment_id = etd.equipment_id");
           $this->db->join("equipment_unit eu", "eu.equipment_unit_id = e.equipment_unit_id");
        }
        $this->db->where("id.invoice_id", $id);
        return $this->db->get("invoice_dt id")->result();
   }
}
