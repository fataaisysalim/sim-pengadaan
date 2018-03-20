<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Origin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->flush_cache();
    }

    public function material($kode = null) {
        $data['ct'] = $this->crud_model->read_data("material_category", null, array("material_category_name" => "ASC"))->result();

        foreach ($data['ct'] as $number => $row) {
            $data['type'][] = $this->crud_model->read_data('material', array("material_category_id" => $row->material_category_id), array("material_id" => "DESC"))->result();
            $data['unit'][] = $this->crud_model->read_data("material_unit", null, array("material_unit_name" => "ASC"))->result();
            $data['mt'][] = $this->crud_model->read_data("material_sub ms", array("m.material_category_id" => $row->material_category_id), array("ms.material_sub_id" => "DESC"), array("material m" => "m.material_id = ms.material_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"))->result();
            $data["mtt"][] = $this->crud_model->read_data("material_sub", array("m.material_category_id" => $row->material_category_id), array("material_sub_name" => "ASC"), array("material m" => "m.material_id = material_sub.material_id", "material_unit mu" => array("mu.material_unit_id = material_sub.material_unit_id", "left")))->result();
        }
        return $data;
    }

    public function material_stock($project) {
        $data['ct'] = $this->crud_model->read_data("material_category", null, array("material_category_id" => "ASC"))->result();

        foreach ($data['ct'] as $number => $row) {
            $data['type'][] = $this->crud_model->read_data("material", array("material_category_id" => $row->material_category_id))->result();
            if ($project != 'all') {
                $where["sf.project_id"] = $project;
                $join["stock_final sf"] = "sf.material_sub_id = ms.material_sub_id";
                $where["sf.stock_final_rest >"] = 0;
            }
            $join["material m"] = "m.material_id = ms.material_id";
            $join["material_unit mu"] = "mu.material_unit_id = ms.material_unit_id";
            $where["m.material_category_id"] = $row->material_category_id;
            $where["ms.material_sub_status"] = 1;
            $where["m.material_status"] = 1;
            $data['mt'][] = $this->crud_model->read_data("material_sub ms", $where, array("ms.material_sub_id" => "DESC"), $join)->result();
        }
        return $data;
    }

    /*public function material_stock($project) {
        //$statement["where"] = array("kode_parent != ''");
        $where_is=null;
        $where_is["kode_parent"] != "";
        $data['ct'] = $this->crud_model->read_data("mst_sumberdaya", $where_is, array("nama" => "ASC"))->result();

        foreach ($data['ct'] as $number => $row) {
            
            $where["ms.kode_child"] = $row->kode_parent;
            $data['mt'][] = $this->crud_model->read_data("mst_sumberdaya ms", $where, array("ms.nama" => "ASC"))->result();
        }
        return $data;
    }*/

    public function equipment() {
        $data['ct'] = $this->crud_model->read_data("equipment_ct", null, array("equipment_ct_id" => "ASC"))->result();
        foreach ($data['ct'] as $number => $row) {
            $data['unit'][] = $this->crud_model->read_data("equipment_unit", null, array("equipment_unit_id" => "DESC"))->result();
            $data['eq'][] = $this->crud_model->read_data("equipment eq", array("eq.equipment_ct_id" => $row->equipment_ct_id, "equipment_status" => 1), array("eq.equipment_id" => "DESC"), array("equipment_unit eu" => "eu.equipment_unit_id = eq.equipment_unit_id"), null, null, "*, (select equipment_stock_rest equipment_stock_rest from equipment_stock where equipment_stock_id = (select max(equipment_stock_id) equipment_stock_rest from equipment_stock where equipment_id = eq.equipment_id)) as final_stock")->result();
        }
        return $data;
    }

    public function mog() {
        $data['ct'] = $this->crud_model->read_data("transaction_ct", array("transaction_ct_id != " => 3), array("transaction_ct_id" => "ASC"))->result();
        foreach ($data['ct'] as $number => $row) {
            $data['mog'][] = $this->crud_model->read_data("mog", array("mog.transaction_ct_id" => $row->transaction_ct_id), array("mog.mog_id" => "DESC"), array("actor ac" => "ac.actor_id = mog.actor_id"), null, null, "*, (select count(mog_dt_id) from mog_dt where mog_id = mog.mog_id) as item_usage")->result();
        }
        return $data;
    }

    public function transEq() {
        $data['ct'] = $this->crud_model->read_data("transaction_ct", array("transaction_ct_id != " => 3), array("transaction_ct_id" => "ASC"))->result();
        foreach ($data['ct'] as $number => $row) {
            $data['equ'][] = $this->crud_model->read_data("equipt_transaction et", array("et.transaction_ct_id" => $row->transaction_ct_id), array("et.equipt_transaction_id" => "DESC"), array("actor ac" => "ac.actor_id = et.actor_id"), null, null, "*, (select count(equipt_transaction_dt_id) from equipt_transaction_dt where equipt_transaction_id = et.equipt_transaction_id) as item_usage")->result();
        }
        return $data;
    }

    public function lease($starts, $ends) {
        $data['etrans'] = $this->crud_model->read_data("equipt_transaction et", array("transaction_ct_id" => 1, "DATE(equipt_transaction_date) >=" => $starts, "DATE(equipt_transaction_date) <=" => $ends), array("et.equipt_transaction_id" => "DESC"), array("actor ac" => "ac.actor_id = et.actor_id"))->result();
        foreach ($data['etrans'] as $number => $row) {
            $data['etransc'][] = $this->crud_model->read_data("equipt_transaction et", array("equipt_transaction_rent_id" => $row->equipt_transaction_id, "transaction_ct_id" => 2))->last_row();
        }
        return $data;
    }

    public function nasabah() {
        $statement["table"] = "actor";
        //$statement["where"] = array("jenis" => "Vend");
        $data['ct'] = $this->crud_model->read_fordata($statement)->result();
        return $data;
    }

    public function actor($acts) {
        $statement["table"] = "actor_category";
        if ($acts == 1) {
            $statement["where"] = array("actor_category_id" => 1);
            $statement["or_where"] = array("actor_category_id" => 2);
        } elseif ($acts == 3) {
            $statement["where"] = array("actor_category_id" => 3);
            $statement["or_where"] = array("actor_category_id" => 2);
        } else {
            $statement["where"] = array("actor_category_id" => $acts);
        }
        $data['ct'] = $this->crud_model->read_fordata($statement)->result();

        foreach ($data['ct'] as $num => $row) {
            $data['act'][$num] = $this->crud_model->read_data("actor", array("actor_category_id" => $row->actor_category_id, "actor_status" => 1), array("actor_id" => "DESC"))->result();
        }
        return $data;
    }

    public function tax($kode = null) {
        $data['ct'] = $this->crud_model->read_data("tax_ct", null, array("tax_ct_name" => "ASC"))->result();

        foreach ($data['ct'] as $number => $row) {
            $data['type'][] = $this->crud_model->read_data('tax', array("tax_ct_id" => $row->tax_ct_id), array("tax_id" => "DESC"))->result();
        }
        return $data;
    }

    public function proByAccess($idUser = null) {
        $where = null;
        if (!empty($idUser)) {
            $where["md5(pa.users_id)"] = $idUser;
        }
        return $this->crud_model->read_data("project p", $where, null, array("project_access pa" => "pa.project_id = p.project_id"))->result();
    }

    public function docDt($id = null) {
        $data['control'] = $this->crud_model->read_fordata(array("table" => "doc_control dc", "where" => array("md5(dc.doc_control_id)" => $id), "join" => array("actor a" => "a.actor_id = dc.actor_id", "project p" => "p.project_id = dc.project_id", "users u" => "u.users_id = dc.users_id", "employee e" => "e.employee_id = u.employee_id")))->row();
        $data['attach'] = $this->crud_model->read_fordata(array("table" => "doc_attach", "where" => array("md5(doc_control_id)" => $id)))->result();
        return $data;
    }

    public function invTotal($where) {
        $order = array("inv.invoice_date_kwt" => "asc");
        $join = array(
            "actor ac" => "ac.actor_id = inv.actor_id",
            "users us" => "us.users_id = inv.users_id",
            "project p" => "p.project_id = inv.project_id"
        );
        $data['invoice'] = $this->crud_model->read_data_with_false("invoice inv", $where, $order, $join)->result();
        foreach ($data['invoice'] as $x => $row) {
            $data['taxppn'][$x] = $this->crud_model->read_fordata(array("table" => "invoice_tax itax", "where" => array("itax.invoice_id" => $row->invoice_id, "tax.tax_name " => "PPN"), "join" => array("tax" => "itax.tax_id = tax.tax_id")))->row();
            $data['taxexppn'][$x] = $this->crud_model->read_fordata(array("table" => "invoice_tax itax", "where" => array("itax.invoice_id" => $row->invoice_id, "tax.tax_name !=" => "PPN"), "join" => array("tax" => "itax.tax_id = tax.tax_id")))->result();
        }
        return $data;
    }

}
