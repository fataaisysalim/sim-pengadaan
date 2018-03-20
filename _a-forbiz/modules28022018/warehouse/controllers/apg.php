<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Apg extends MY_Controller {

    private $title = "APG";
    private $header = "APG";
    private $url = "warehouse/APG/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->library('cfpdf');
        $this->load->config('pdf_config');
    }

    public function index($ct = null) {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['url_access'] = $this->url;
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
        $data['content'] = "warehouse/report/apg/index";
        $this->load->view("../index", $data);
    }

    public function table($project = null, $start = null, $end = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $data['start'] = strtotime($start) > strtotime($end) ? $end : $start;
            $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
            $data["show"] = $this->crud_model->read_data("stock_final sf", array("md5(sf.project_id)" => "$project", "DATE(sf.stock_final_date) >=" => date2mysql($data['start']), "DATE(sf.stock_final_date) <=" => date2mysql($data['ends'])), array("sf.stock_final_date" => "asc"), array("material_sub ms" => "ms.material_sub_id = sf.material_sub_id", "material m" => "m.material_id=ms.material_id", "project p" => "p.project_id=sf.project_id"))->result();
            $this->load->view("warehouse/report/apg/apg_table", $data);
        }
    }

    public function detail($actor_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data["supplier_dt"] = $this->crud_model->read_data("actor a", array("md5(actor_id)" => $actor_id), NULL, array("actor_category ac" => "ac.actor_category_id = a.actor_category_id"))->row();

        $this->load->view("warehouse/report/apg/apg_detail", $data);
    }

    public function pdf_apg($material_id = NULL, $project = null, $start = null, $end = null) {
        $data['start'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $data['apg_dt'] = $this->crud_model->read_data("stock st", array("md5(st.project_id)" => $project, "md5(st.material_sub_id)" => $material_id, "DATE(stock_date) >=" => date2mysql($data['start']), "DATE(stock_date) <=" => date2mysql($data['ends'])), array("st.stock_id" => "ASC"), array("mog" => array("mog.mog_id = st.mog_id", 'LEFT'), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), 'material_sub ms' => 'st.material_sub_id = ms.material_sub_id', 'material_unit mu' => 'ms.material_unit_id = mu.material_unit_id'))->result();
        $data['dt'] = $this->crud_model->read_data("stock st", array("md5(st.project_id)" => $project, "md5(st.material_sub_id)" => $material_id, "DATE(stock_date) >=" => date2mysql($data['start']), "DATE(stock_date) <=" => date2mysql($data['ends'])), array("st.stock_id" => "ASC"), array("mog" => array("mog.mog_id = st.mog_id", 'LEFT'), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), 'material_sub ms' => 'st.material_sub_id = ms.material_sub_id', 'material_unit mu' => 'ms.material_unit_id = mu.material_unit_id'))->last_row();
        $data["md"] = $this->crud_model->read_data("material_sub ms", array("md5(ms.material_sub_id)" => $material_id), null, array("material m" => "ms.material_id=m.material_id", "material_unit u" => array("ms.material_unit_id=u.material_unit_id", "left")))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data("project", array("md5(project_id)" => !empty($project) ? $project : md5(1)))->row();
        $this->recActivity("mengunduh Inventories Warehouse Administration/APG ($data[start] - $data[end])","warehouse");
        $this->load->view("warehouse/report/apg/pdf_apg", $data);
    }

    public function pdf($item = NULL, $project = null, $start = null, $end = null) {
        $this->load->helper('date_format');

        $data['start'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;
        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();
        $data['mt'] = $this->crud_model->read_data("material_sub", array("md5(material_sub_id)" => $item), null, array('material' => 'material_sub.material_id = material.material_id'))->row();
        $data['show'] = $this->crud_model->read_data("stock st", array("md5(st.project_id)" => $project, "md5(st.material_sub_id)" => $item, "DATE(stock_date) >=" => date2mysql($data['start']), "DATE(stock_date) <=" => date2mysql($data['ends'])), null, array("mog" => array("mog.mog_id = st.mog_id", 'LEFT'), "actor ac" => array("ac.actor_id = mog.actor_id", "left"), 'material_sub ms' => 'st.material_sub_id = ms.material_sub_id', 'material_unit mu' => 'ms.material_unit_id = mu.material_unit_id'))->result();


        $this->load->library('pdf');
        $param = '"en-GB-x","A4","","",10,10,10,10,6,3,"L"';
        $pdf = $this->pdf->load($param);
        $pdf->WriteHTML($this->load->view("warehouse/report/apg/pdf_apg_1", $data, true));
        $pdf->Output();
    }

}

?>