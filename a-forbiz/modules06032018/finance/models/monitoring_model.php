<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitoring_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->flush_cache();
    }

    public function get_invoice($where) {
        $this->db->join('invoice_wo_ct', 'invoice_wo.invoice_wo_ct_id = invoice_wo_ct.invoice_wo_ct_id');
        $this->db->where_in('invoice_id', $where);
        return $this->db->get('invoice_wo')->result_array();
    }

    public function get_stock_by_date($where, $equipment_id) {
        $this->db->select('st.equipment_id, COALESCE(st.equipment_stock_price * SUM(equipment_stock_rest) * datediff(current_date(), DATE(st.equipment_stock_date)),0) as equipment_stock_total', FALSE);
        $this->db->where_in('DATE(equipment_stock_date)', $where);
        $this->db->where('equipment_id', $equipment_id);
        return $this->db->get('equipment_stock st')->result_array();
    }

}
