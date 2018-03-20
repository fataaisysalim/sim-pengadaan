<?php

class Transaction extends MY_Controller {

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->library('cfpdf');
        $this->load->helper('romawi_helper');
        $this->load->config('config');
    }

    public function invoice($id) {
        $data['sess'] = $this->authentication_root();
        $data['detail'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['invoice'] = $this->crud_model->read_data('invoice i', array("i.invoice_id" => $id), null, array('actor a' => array("a.actor_id=i.actor_id", "left"), "project p" => array('p.project_id=i.project_id', "left")))->row();
        $data['ppn'] = $this->crud_model->read_data('invoice i', array("i.invoice_id" => $id, "t.tax_type" => 0), null, array('actor a' => array("a.actor_id=i.actor_id", "left"), 'invoice_tax it' => array("i.invoice_id=i.invoice_id", "left"), "project p" => array('p.project_id=i.project_id', "left"), "invoice_tax it" => array("i.invoice_id=it.invoice_id", "left"), "tax t" => array("t.tax_id=it.tax_id", "left")))->row();
        $data['pph'] = $this->crud_model->read_data('invoice i', array("i.invoice_id" => $id, "t.tax_type" => 1), null, array('actor a' => array("a.actor_id=i.actor_id", "left"), "project p" => array('p.project_id=i.project_id', "left"), "invoice_tax it" => array("i.invoice_id=it.invoice_id", "left"), "tax t" => array("t.tax_id=it.tax_id", "left")))->row();
        $this->load->view("finance/print/invoice", $data);
    }

    public function sallary($id) {
        $data['sess'] = $this->authentication_root();
        $data['detail'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['salary'] = $this->crud_model->read_data('salary s', array("s.salary_id" => $id), null, array('actor a' => array("a.actor_id=s.actor_id", "left"), "project p" => array('p.project_id=s.project_id', "left")))->row();
        $data['ppn'] = $this->crud_model->read_data('salary s', array("s.salary_id" => $id, "t.tax_type" => 0), null, array('actor a' => array("a.actor_id=s.actor_id", "left"), 'salary_tax it' => array("s.salary_id=i.salary_id", "left"), "project p" => array('p.project_id=s.project_id', "left"), "salary_tax it" => array("s.salary_id=it.salary_id", "left"), "tax t" => array("t.tax_id=it.tax_id", "left")))->row();
        $data['pph'] = $this->crud_model->read_data('salary s', array("s.salary_id" => $id, "t.tax_type" => 1), null, array('actor a' => array("a.actor_id=s.actor_id", "left"), "project p" => array('p.project_id=s.project_id', "left"), "salary_tax it" => array("s.salary_id=it.salary_id", "left"), "tax t" => array("t.tax_id=it.tax_id", "left")))->row();
        $this->load->view("finance/print/sallary", $data);
    }

    public function invoice_1($id) {
        $data['sess'] = $this->authentication_root();
        $data['ppn'] = $this->crud_model->read_data('invoice i', array("i.invoice_id" => $id, "t.tax_type" => 0), null, array('actor a' => array("a.actor_id=i.actor_id", "left"), 'invoice_tax it' => array("i.invoice_id=i.invoice_id", "left"), "project p" => array('p.project_id=i.project_id', "left"), "invoice_tax it" => array("i.invoice_id=it.invoice_id", "left"), "tax t" => array("t.tax_id=it.tax_id", "left")))->row();
        $data['pph'] = $this->crud_model->read_data('invoice i', array("i.invoice_id" => $id, "t.tax_type" => 1), null, array('actor a' => array("a.actor_id=i.actor_id", "left"), "project p" => array('p.project_id=i.project_id', "left"), "invoice_tax it" => array("i.invoice_id=it.invoice_id", "left"), "tax t" => array("t.tax_id=it.tax_id", "left")))->row();
        $this->load->view("finance/print/invoice_1", $data);
    }

}

?>