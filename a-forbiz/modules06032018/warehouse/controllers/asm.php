<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Asm extends MY_Controller {

    private $title = "BAPB Monitoring Supplier";
    private $header = "BAPB Monitoring Supplier";
    private $url = "warehouse/asm/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("origin_model");
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
        $data['project'] = $this->origin_model->proByAccess($data['sess']['users_id']);
        $data['content'] = "warehouse/report/asm/index";
        $this->load->view("../index", $data);
    }

    public function table($project = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if ($data['permit']->access_read == 1) {
            $data["show"] = $this->crud_model->read_fordata(array("table" => "actor a", "group" => "m.actor_id", "join" => array("mog m" => "m.actor_id = a.actor_id", "project p" => "p.project_id = m.project_id"), "where" => "m.transaction_ct_id = 1 and md5(p.project_id) = '$project'", "select" => array("*, (select count(mog_id) from mog where actor_id = a.actor_id and project_id = p.project_id) as count_mog, (select sum(mog_total) from mog where actor_id = a.actor_id and project_id = p.project_id) as invoice"), "order" => array("a.actor_id" => "asc")))->result();
            $this->load->view("warehouse/report/asm/table", $data);
        }
    }

    public function detail($actor_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data["supplier_dt"] = $this->crud_model->read_data("actor a", array("md5(actor_id)" => $actor_id), NULL, array("actor_category ac" => "ac.actor_category_id = a.actor_category_id"))->row();

        $this->load->view("warehouse/report/asm/detail", $data);
    }

    public function pdf_asm($project = null, $actor_id = NULL) {
        $data["md"] = $this->crud_model->read_data("mog_dt md", array("md5(mo.actor_id)" => $actor_id), null, array("material_sub ms" => array("ms.material_sub_id=md.material_sub_id", "left"), "material m" => array("ms.material_id=m.material_id", "left"), "material_unit u" => array("ms.material_unit_id=u.material_unit_id", "left"), "mog mo" => array("mo.mog_id=md.mog_id", "left")
                    , "actor a" => array("a.actor_id=mo.actor_id", "left")))->result();
        $data["acc"] = $this->crud_model->read_data("actor a", array("md5(a.actor_id)" => $actor_id), null)->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data("project", array("md5(project_id)" => !empty($project) ? $project : md5(1)))->row();
        $this->recActivity("Mengunduh BAPB Monitoring Supplier","warehouse");
        $this->load->view("warehouse/report/asm/pdf", $data);
    }

}

?>