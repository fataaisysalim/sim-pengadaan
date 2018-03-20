<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Export extends MY_Controller {

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->helper(array('folarium', 'date_format'));
    }

    public function index() {
        //nothing to do here
    }

    public function actor($mode, $status = null) {
        $data = array(
            'title_page' => 'Laporan Data',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
        $data['identity'] = "Supplier";
        switch ($mode):
            case 1:
                $data['title_page'] = "Data Supplier";
                $data['title_file'] = "Supplier";
                $data['identity'] = "NPWP";
                break;
            case 2:
                $data['title_page'] = "Data Sub Kontraktor";
                $data['title_file'] = "Kontraktor";
                $data['identity'] = "NPWP";
                break;
            case 3:
                $data['title_page'] = "Data Mandor";
                $data['title_file'] = "Mandor";
                $data['identity'] = "Identitas";
                break;
            case 4:
                $data['title_page'] = "Data Owner";
                $data['title_file'] = "Owner";
                $data['identity'] = "Identitas";
                break;
        endswitch;

        if ($status != 'all') {
            $where['a.actor_status'] = $status == 'active' ? 1 : 0;
        }
        $where['a.actor_category_id'] = $mode;
        $child = "(select count(actor_id) from mog where actor_id = a.actor_id) as child";
        $data["show"] = $this->crud_model->read_data("actor a", $where, array("actor_id" => "DESC"), array("actor_category ac" => "ac.actor_category_id = a.actor_category_id"), NULL, NULL, array("*", $child))->result();

        $data['content'] = "warehouse/info/export/export_actor";
        $this->load->view($data['content'], $data);
    }

    public function material($ct = null, $type = null, $unit = null, $status = null) {
        $data = array(
            'title_page' => 'Data Material',
            'title_file' => 'Material',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );

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
        $data['show'] = $this->crud_model->read_data("material_sub ms", $where, array("ms.material_sub_id" => "DESC"), array("material m" => "m.material_id = ms.material_id", "material_category mc" => "m.material_category_id = mc.material_category_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"))->result();

        $data['content'] = "warehouse/info/export/export_material";
        $this->load->view($data['content'], $data);
    }

    public function equipment($ct = null, $unit = null, $status = null) {
        $data = array(
            'title_page' => 'Data Peralatan',
            'title_file' => 'Equipment',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );

        if (!empty($status)) {
            if ($status != 'all') {
                $where['eq.equipment_status'] = $status == 'active' ? 1 : 0;
            }
        }
        if (!empty($unit)) {
            if ($unit != 'all') {
                $where['eq.equipment_unit_id'] = $unit;
            }
        }
        $where['md5(eq.equipment_ct_id)'] = $ct;
        $data['show'] = $this->crud_model->read_data("equipment eq", $where, array("eq.equipment_id" => "DESC"), array("equipment_ct ct" => "ct.equipment_ct_id = eq.equipment_ct_id", "equipment_unit eu" => "eu.equipment_unit_id = eq.equipment_unit_id"))->result();

        $data['content'] = "warehouse/info/export/export_equipment";
        $this->load->view($data['content'], $data);
    }

    public function stock_material($project = null, $ct = null, $type = null) {
        $data = array(
            'title_page' => 'laporan Stok Material',
            'title_file' => 'Material_Stock',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );

//        $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
//        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $where["md5(m.material_category_id)"] = $ct;
        $where["md5(sf.project_id)"] = md5(1);
        $where["ms.material_sub_status"] = 1;
        $where["m.material_status"] = 1;
//        $where["DATE(sf.stock_final_date) >="] = date2mysql($data['starts']);
//        $where["DATE(sf.stock_final_date) <="] = date2mysql($data['ends']);
        if (!empty($type)) {
            $where["md5(m.material_id)"] = $type;
        }
        if (!empty($project)) {
            $where["md5(sf.project_id)"] = !empty($project) ? $project : md5(1);
        }
        $data['project'] = $this->crud_model->read_data("project", array("md5(project_id)" => !empty($project) ? $project : md5(1)))->row();
        $data['category'] = $this->crud_model->read_data("material_category", array("md5(material_category_id)" => $ct))->row();
        $data['show'] = $this->crud_model->read_data("material_sub ms", $where, array("ms.material_sub_id" => "DESC"), array("material m" => "m.material_id = ms.material_id", "material_category mc" => "m.material_category_id = mc.material_category_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id", "stock_final sf" => "sf.material_sub_id = ms.material_sub_id", "project pj" => "sf.project_id = pj.project_id"))->result();

        $data['content'] = "warehouse/info/export/export_material_stock";
        $this->load->view($data['content'], $data);
    }

    public function stock_equipment($ct = null, $project = null, $actor = null) {
        $data = array(
            'title_page' => 'Laporan Stok Peralatan Gudang',
            'title_file' => 'Equipment_Stock',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
//        $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
//        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $where["md5(eq.equipment_ct_id)"] = $ct;
        $where["eq.equipment_status"] = 1;
        $where["md5(sf.project_id)"] = !empty($project) ? $project : md5(1);
        if (!empty($project)) {
            $where["md5(sf.project_id)"] = $project;
        }
        if (!empty($actor)) {
            $where["md5(sf.actor_id)"] = $actor;
        }
//        $where["DATE(sf.equipment_stock_final_date) >="] = date2mysql($data['starts']);
//        $where["DATE(sf.equipment_stock_final_date) <="] = date2mysql($data['ends']);
        $data['project'] = $this->crud_model->read_data("project", array("md5(project_id)" => !empty($project) ? $project : md5(1)))->row();
        $data['category'] = $this->crud_model->read_data("equipment_ct", array("md5(equipment_ct_id)" => $ct))->row();
        $data['show'] = $this->crud_model->read_data("equipment eq", $where, array("eq.equipment_id" => "DESC"), array("equipment_ct ct" => "eq.equipment_ct_id = ct.equipment_ct_id", "equipment_unit eu" => "eu.equipment_unit_id = eq.equipment_unit_id", "equipment_stock_final sf" => "eq.equipment_id = sf.equipment_id","actor a"=>"a.actor_id = sf.actor_id", "project pr" => "sf.project_id = pr.project_id"))->result();

        $data['content'] = "warehouse/info/export/export_equipment_stock";
        $this->load->view($data['content'], $data);
    }

    public function stock_detail($feature = null, $item = null, $actor = null) {
        $data = array(
            'title_page' => 'Laporan Data',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
        $data['project'] = $this->crud_model->read_data("project", array("md5(project_id)" => !empty($project) ? $project : md5(1)))->row();
//        $data['starts'] = !empty($start) ? strtotime($start) > strtotime($end) ? $end : $start : date("d-m-Y");
//        $data['ends'] = !empty($end) ? strtotime($start) > strtotime($end) ? $start : $end : date("d-m-Y");
        $data['item'] = $item;
        $data['actors'] = $actor;
        if ($feature == 'material') {
            $data['mt'] = $this->crud_model->read_data("material_sub", array("md5(material_sub_id)" => $item))->row();
            $data['show'] = $this->crud_model->read_data("stock st", array("md5(st.material_sub_id)" => $item), null, array("mog" => array("mog.mog_id = st.mog_id", "LEFT"), "actor ac" => array("ac.actor_id = mog.actor_id", "LEFT")))->result();

            $data['title_page'] = "Laporan Data Material Stock Detail";
            $data['title_file'] = "Material_Stock_Detail";
            $data['content'] = "warehouse/info/export/export_material_stock_det";
        } elseif ($feature == 'equipment') {
            $where = array("md5(st.equipment_id)" => $item);
            if (!empty($actor)) {
                $where["md5(et.actor_id)"] = $actor;
            }
            $data['actor'] = $this->crud_model->read_fordata(array("table"=>"actor","where"=>"md5(actor_id)= '$actor'"))->row();
            $data['eq'] = $this->crud_model->read_data("equipment", array("md5(equipment_id)" => $item))->row();
            $data['show'] = $this->crud_model->read_data("equipment_stock st", $where, null, array("equipt_transaction et" => array("et.equipt_transaction_id = st.equipt_transaction_id", "LEFT"), "actor ac" => array("ac.actor_id = et.actor_id", "LEFT")))->result();
            $data['title_page'] = "Laporan Stok Peralatan";
            $data['title_file'] = "stok_peralatan";
            $data['content'] = "warehouse/info/export/export_equipment_stock_det";
        }

        $this->load->view($data['content'], $data);
    }

    public function mog($start = null, $end = null, $ct = null) {
        $data = array(
            'title_page' => '',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
        $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;

        $data['category'] = $this->crud_model->read_data("transaction_ct", array("md5(transaction_ct_id)" => $ct))->row();
        $data['show'] = $this->crud_model->read_data("mog", array("md5(mog.transaction_ct_id)" => $ct, "DATE(mog_date) >=" => date2mysql($data['starts']), "DATE(mog_date) <=" => date2mysql($data['ends'])), array("mog.mog_id" => "DESC"), array("actor ac" => "ac.actor_id = mog.actor_id", "project pr" => "mog.project_id = pr.project_id"), null, null, "*, (select count(mog_dt_id) from mog_dt where mog_id = mog.mog_id) as item_usage")->result();

        $data['title_page'] = ($data['category']->transaction_ct_id == 1) ? 'Laporan Data Penerimaan Material (BAPB)' : 'Laporan Pemakaian Material (BPM)';
        $data['title_file'] = ($data['category']->transaction_ct_id == 1) ? 'Penerimaan_Material(BAPB)' : 'Pemakaian_Material(BPM)';
        $data['content'] = "warehouse/info/export/export_mog";
        $this->load->view($data['content'], $data);
    }

    public function lease($start = null, $end = null) {
        $this->load->model('origin_model');
        $data = array(
            'title_page' => 'Laporan Data Equipment Monitoring',
            'title_file' => 'Equipment_Monitoring',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
        $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $data['show'] = $this->origin_model->lease($data['starts'], $data['ends']);

        $data['content'] = "warehouse/info/export/export_lease";
        $this->load->view($data['content'], $data);
    }

    public function apg($project = null, $start = null, $end = null) {
        $data = array(
            'title_page' => 'Laporan APG Sisa',
            'title_file' => 'APGsisa',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
        $data['start'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $data["show"] = $this->crud_model->read_data("stock_final sf", array("md5(sf.project_id)" => "$project", "DATE(sf.stock_final_date) >=" => date2mysql($data['start']), "DATE(sf.stock_final_date) <=" => date2mysql($data['ends'])), array("sf.stock_final_date" => "asc"), array("material_sub ms" => "ms.material_sub_id = sf.material_sub_id", "material m" => "m.material_id=ms.material_id", "project p" => "p.project_id=sf.project_id"))->result();

        $data['content'] = "warehouse/report/export/export_apg";
        $this->load->view($data['content'], $data);
    }

    public function apg_det($project = null, $item = null, $start = null, $end = null) {
        $data = array(
            'title_page' => 'Administrasi Persediaan Gudang',
            'title_file' => 'apg',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
        $data['start'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();
        $data['mt'] = $this->crud_model->read_data("material_sub", array("md5(material_sub_id)" => $item), null, array('material' => 'material_sub.material_id = material.material_id'))->row();
        $data['show'] = $this->crud_model->read_data("stock st", array("md5(st.project_id)" => $project, "md5(st.material_sub_id)" => $item, "DATE(stock_date) >=" => date2mysql($data['start']), "DATE(stock_date) <=" => date2mysql($data['ends'])), array("st.stock_id" => "ASC"), array("mog" => array("mog.mog_id = st.mog_id", 'LEFT'), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), 'material_sub ms' => 'st.material_sub_id = ms.material_sub_id', 'material_unit mu' => 'ms.material_unit_id = mu.material_unit_id'))->result();
        $data['dt'] = $this->crud_model->read_data("stock st", array("md5(st.project_id)" => $project, "md5(st.material_sub_id)" => $item, "DATE(stock_date) >=" => date2mysql($data['start']), "DATE(stock_date) <=" => date2mysql($data['ends'])), array("st.stock_id" => "ASC"), array("mog" => array("mog.mog_id = st.mog_id", 'LEFT'), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), 'material_sub ms' => 'st.material_sub_id = ms.material_sub_id', 'material_unit mu' => 'ms.material_unit_id = mu.material_unit_id'))->last_row();
        $data['content'] = "warehouse/report/export/export_apg_det";
        $this->load->view($data['content'], $data);
    }

    public function asm($project = null) {
        $data = array(
            'title_page' => 'BAPB Monitoring Supplier',
            'title_file' => 'BAPB_Monitoring',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
        $child = "(select count(actor_id) from actor ) as child, (select sum(mog_total) from mog where actor_id= a.actor_id) as invoice";
        $data["show"] = $this->crud_model->read_data("actor a", array("m.transaction_ct_id" => 1, "md5(p.project_id)" => "$project"), array("a.actor_id" => "asc"), array("mog m" => "m.actor_id = a.actor_id", "project p" => "p.project_id=m.project_id"), NULL, "a.actor_id", array("*", "(select count( mog_id )  from mog where actor_id= a.actor_id) as  count_mog", $child))->result();

        $data['content'] = "warehouse/report/export/export_asm";
        $this->load->view($data['content'], $data);
    }

    public function asm_det($project = null, $supp = null) {
        $data = array(
            'title_page' => 'BAPB Monitoring Supplier',
            'title_file' => 'BAPB_Monitoring',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();
        $data['sp'] = $this->crud_model->read_data("actor", array("actor_category_id" => 1, "md5(actor_id)" => $supp), null, null)->row();
        $data['show'] = $this->crud_model->read_data("mog mg ", array("md5(mg.project_id)" => $project, "md5(mg.actor_id)" => $supp), null, array("mog_dt md" => "mg.mog_id = md.mog_id", "actor ac" => "ac.actor_id = mg.actor_id", 'material_sub ms' => 'md.material_sub_id = ms.material_sub_id'))->result();
        $data['content'] = "warehouse/report/export/export_asm_det";
        $this->load->view($data['content'], $data
        );
    }

    public function transaction_equipment($start = null, $end = null, $ct = null) {
        $data = array(
            'title_page' => 'Laporan Data ',
            'title_file' => 'BAPB_Monitoring',
            'title_company' => $this->crud_model->read_data("apps")->row()->apps_client,
            'setting_date' => date('Y-m-d')
        );
        $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $data['category'] = $this->crud_model->read_data("transaction_ct", array("md5(transaction_ct_id)" => $ct))->row();

        $data['title_page'] = $data['category']->transaction_ct_id == 1 ? "Laporan Data Peminjaman Peralatan (BAPP)" : "Laporan Data Pengembalian Peralatan (BPP)";
        $data['title_file'] = $data['category']->transaction_ct_id == 1 ? "Peminjaman_Peralatan(BAPP)" : "Pengembalian_Peralatan(BPP)";

        $data['show'] = $this->crud_model->read_data("equipt_transaction eq", array("md5(eq.transaction_ct_id)" => $ct, "equipt_transaction_status" => 1, "DATE(eq.equipt_transaction_date) >=" => date2mysql($data['starts']), "DATE(eq.equipt_transaction_date) <=" => date2mysql($data['ends'])), array("eq.equipt_transaction_id" => "DESC"), array("actor ac" => "ac.actor_id = eq.actor_id"), null, null, "*, (select count(equipt_transaction_dt_id) from equipt_transaction_dt where equipt_transaction_id = eq.equipt_transaction_id) as item_usage")->result();

        $data['content'] = "warehouse/info/export/export_transaction_equipment";
        $this->load->view($data['content'], $data);
    }

    public function monitoring_equipment($project = null, $actor = null) {
        $array = array();
        $date = array();
        $variable = array();
        $array_total = array();
        $variable_total = array();
        $date_total = array();

        $data = array(
            'title_page' => 'Gudang Alat',
            'title_file' => 'gudang_alat',
            'title_company' => $this->config->item('config_client'),
            'setting_date' => date('Y-m-d')
        );
        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();
        $data['actor'] = $this->crud_model->read_data('actor', array('md5(actor_id)' => $actor), null)->row();

        $join = array(
            "equipt_transaction et" => array("et.equipt_transaction_id = st.equipt_transaction_id", "LEFT"),
            "equipment eq" => array("eq.equipment_id = st.equipment_id", "LEFT"),
        );
        $where = array(
            "md5(st.project_id)" => "$project",
            "md5(et.actor_id)" => "$actor",
        );
        $group = 'st.equipment_id';
        $select = 'st.equipment_id, equipment_name, equipment_type';
        $order = array('st.equipment_id' => 'asc');
        $show = $this->crud_model->read_data("equipment_stock st", $where, $order, $join, null, $group, $select)->result_array();
        foreach ($show as $index => $row) :
            $variable[] = $row;
            $variable_total[] = $row;
            $variable[$index]['equipment_price'] = 0;
            $variable[$index]['equipment_entry'] = 0;
            $variable[$index]['equipment_exit'] = 0;
            $variable[$index]['equipment_rest'] = 0;
            $variable[$index]['equipment_datediff'] = 0;
            $variable[$index]['equipment_subtotal'] = 0;
            $variable_total[$index]['equipment_total'] = 0;
            $variable_total[$index]['equipment_rest'] = 0;
            $variable_total[$index]['equipment_pay'] = 0;
        endforeach;

        $where_date = array(
            'MONTH(equipment_stock_date)' => date('m'),
            "md5(st.project_id)" => "$project",
            "md5(et.actor_id)" => "$actor",
        );
        $group_date = 'DATE(st.equipment_stock_date)';
        $select_date = 'DATE(st.equipment_stock_date) as equipment_stock_date';
        $order_date = array('DATE(st.equipment_stock_date)' => 'asc');
        $show_date = $this->crud_model->read_data("equipment_stock st", $where_date, $order_date, $join, null, $group_date, $select_date)->result_array();
        foreach ($show_date as $index => $row) :
            $array[$index]['equipment_stock_date'] = $row['equipment_stock_date'];
            $date[] = $row['equipment_stock_date'];
        endforeach;
        foreach ($array as $index => $row) :
            $array[$index]['equipment_stock_detail'] = $variable;
        endforeach;

        $where_total = array(
            'MONTH(debt_date)' => date('m'),
            "md5(project_id)" => $project,
            "md5(actor_id)" => $actor,
        );
        $group_total = 'DATE(debt_date)';
        $select_total = 'DATE(debt_date) AS debt_date';
        $order_total = array('DATE(debt_date)' => 'asc');
        $show_total = $this->crud_model->read_data("debt", $where_total, $order_total, null, null, $group_total, $select_total)->result_array();

        foreach ($show_total as $index => $row) :
            $array_total[$index]['debt_date'] = $row['debt_date'];
            $date_total[] = $row['debt_date'];
        endforeach;
        foreach ($array_total as $index => $row) :
            $array_total[$index]['debt_detail'] = $variable_total;
        endforeach;

        $count_array = count($array);
        foreach ($array as $index => $row) :
            foreach ($array[$index]['equipment_stock_detail'] as $vainde => $varow) :
                $where_pertdate = array(
                    'DATE(equipment_stock_date)' => $row['equipment_stock_date'],
                    'st.equipment_id' => $varow['equipment_id'],
                    "md5(st.project_id)" => $project,
                    "md5(et.actor_id)" => $actor,
                );
                $group_pertdate = 'st.equipment_id';
                $order_pertdate = array('st.equipment_id' => 'asc');
                $select_pertdate = 'st.equipment_id, equipment_stock_price, COALESCE(SUM(equipment_stock_entry),0) as equipment_stock_entry, COALESCE(SUM(equipment_stock_exit),0) as equipment_stock_exit, COALESCE(SUM(equipment_stock_rest),0) as equipment_stock_rest,'
                        . 'datediff(NOW(), equipment_stock_date) as equipment_stock_datediff';
                $show_pertdate = $this->crud_model->read_data_with_false("equipment_stock st", $where_pertdate, $order_pertdate, $join, null, $group_pertdate, $select_pertdate)->row_array();
                if (count($show_pertdate) > 0) :
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_price'] = $show_pertdate['equipment_stock_price'];
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_entry'] = $show_pertdate['equipment_stock_entry'];
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_rest'] = $show_pertdate['equipment_stock_rest'];
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_datediff'] = $show_pertdate['equipment_stock_datediff'];
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_subtotal'] = $show_pertdate['equipment_stock_datediff'] * ($show_pertdate['equipment_stock_price'] * $show_pertdate['equipment_stock_rest']);
                endif;
                if (($index + 1) == $count_array) :
                endif;
            endforeach;
        endforeach;


        $count_array_total = count($array_total);
        foreach ($array_total as $index => $row) :
            foreach ($array_total[$index]['debt_detail'] as $vainde => $varow) :
                $where_pertotal = array(
                    'DATE(debt_date)' => $row['debt_date'],
                    'deb.equipment_id' => $varow['equipment_id'],
                    "md5(deb.project_id)" => $project,
                    "md5(deb.actor_id)" => $actor,
                );
                $group_pertotal = 'deb.equipment_id';
                $order_pertotal = array('deb.equipment_id' => 'asc');
                $select_pertotal = 'deb.equipment_id, COALESCE(SUM(debt_total),0) as debt_total, COALESCE(SUM(debt_rest),0) as debt_rest';
                $show_pertotal = $this->crud_model->read_data_with_false("debt deb", $where_pertotal, $order_pertotal, null, null, $group_pertotal, $select_pertotal)->row_array();
                if (count($show_pertotal) > 0) :
                    $array_total[$index]['debt_detail'][$vainde]['equipment_total'] = $show_pertotal['debt_total'];
                    $array_total[$index]['debt_detail'][$vainde]['equipment_rest'] = $show_pertotal['debt_rest'];
                    $array_total[$index]['debt_detail'][$vainde]['equipment_pay'] = $show_pertotal['debt_total'] - $show_pertotal['debt_rest'];
                endif;
                if (($index + 1) == $count_array_total) :
                endif;
            endforeach;
        endforeach;

        $data['head'] = $variable;
        $data['array'] = $array;
        $data['array_total'] = $array_total;

//        echo '<pre>';
//        print_r($array);
//        print_r($array_total);
//        echo '</pre>';

        $data['content'] = "finance/monitoring/export/export_equipment";
        $this->load->view($data['content'], $data);
    }

}
