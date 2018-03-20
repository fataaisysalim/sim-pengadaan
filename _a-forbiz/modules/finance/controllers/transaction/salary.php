<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Salary extends MY_Controller {

    private $title = "Fee";
    private $url = "finance/transaction/salary/";
    private $view_path = "finance/transaction/salary/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function index($id = null) {
        $data['sess'] = $this->authentication_root();
        if (empty($id)) {
            is_filtered_mod($data['sess']['validation']);
        }
        $data['active'] = empty($id) ? $data['sess']['gotcurrent']->mod_menu_id : null;
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
        $data['title'] = $this->title;
        $data['url_access'] = $this->url;
        if (!empty($id)) {
            $data['salary_id'] = $id;
        }
        $data['content'] = $this->url . "index";
        $this->load->view("../index", $data);
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->segment(2);
        $data['title'] = $this->title;
        $data['act'] = (empty($id)) ? "Add" : "Edit";
        $data['transaction_ct'] = "Salary";
        $data['url_access'] = "$this->url";
        $data['url_action'] = $data['url'] . '/save/' . $id;
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
        $data['actor'] = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("actor_category_id" => 3)))->result();

        /* --yang bisa akses adalah admin-- */
        if ($data['permit']->access_update == 1 && !empty($id)) {
            $data['salary_id'] = $this->crud_model->read_fordata(array("table" => "salary", "where" => array("md5(salary_id)" => $id)))->row();
            if ($data['salary_id']->salary_ct_id != 3) {
                $data['salary_tax'] = $this->crud_model->read_fordata(array("table" => "salary_tax", "where" => array("md5(salary_id)" => $id)))->result();
                $child = "(select count(tax_id) from salary_tax where md5(salary_id) = '$id' and tax_id = tax.tax_id) as child";
                $data['tax'] = $this->crud_model->read_fordata(array("select" => array("*, $child"), "table" => "tax", "where" => array("tax_ct_id" => 3, "tax_mode_id" => $data['salary_id']->salary_ct_id, "tax_status" => 1)))->result();
            }
        }

        $this->load->view($this->view_path . "salary_form", $data);
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;

        $child = "(select count(transaction_entry_id) from transaction_entry_stok where transaction_entry_id = e.transaction_entry_id) as child";
        $data['show'] = $this->crud_model->read_fordata(array("table" => "transaction_entry e", "select" => array("*", $child), "join" => array("transaction_entry_ct ec" => "ec.transaction_entry_ct_id = e.transaction_entry_ct_id")))->result();

        $this->load->view("finance/master/transaction_entry/transaction_entry_table", $data);
    }

    public function get_select_tax($mode = NULL) {
        if (!empty($mode)) {
            $data['mode'] = $mode;
            $data['tax'] = $this->crud_model->read_fordata(array("table" => "tax", "where" => array("tax_ct_id" => 3, "tax_mode_id" => $mode, "tax_status" => 1)))->result();
            $this->load->view($this->url . "select_tax", $data);
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();

        $tax = $this->input->post('tax') ? array_filter($this->input->post('tax')) : NULL;

        $salary['actor_id'] = $this->input->post("actor");
        $salary['project_id'] = $this->input->post("project");
        $salary['salary_ct_id'] = $this->input->post("salary_ct");
        $salary['salary_number'] = $this->input->post("salary_number");
        $salary['salary_date'] = date('Y-m-d H:i:s', strtotime($this->input->post("salary_date")));
        $salary['salary_pay'] = str_replace('.', '', $this->input->post("salary_pay"));
        $salary['salary_opname'] = str_replace('.', '', $this->input->post("salary_pay"));
        $salary['salary_total_final'] = str_replace('.', '', $this->input->post("salary_total_final"));
        $salary['salary_pkp'] = str_replace('.', '', $this->input->post("salary_pkp"));
        $salary['salary_evidence'] = $this->input->post("salary_evidence") ? $this->input->post("salary_evidence") : NULL;
        $salary['salary_note'] = $this->input->post("salary_note");
        if (isset($salary)) {
            if (empty($id)) {
                $duplicate = $this->crud_model->read_fordata(array("table" => "salary", "where" => array("salary_number" => $salary['salary_number'], "actor_id" => $salary['actor_id'])))->num_rows();
                if ($duplicate == 0) {
                    $this->crud_model->insert_data("salary", $salary);
                    $actions = "tambah";
                    $this->recActivity("Created sallary No. $salary[salary_number] on Sallary Transaction", "finance");
                } else {
                    echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><i class='fa fa-info-circle mg-r-md'></i>Fee failed saved</div>"));
                    exit();
                }

                $get_salary = $this->crud_model->read_fordata(array("table" => "salary", "where" => $salary))->row();
                $sallaryid = $get_salary->salary_id;
            } else {
                $get = $this->crud_model->read_data("salary", array("md5(salary_id)" => $id))->row();
                $sallaryid = $get->salary_id;
                $salary['salary_id'] = $sallaryid;

                $duplicate = $this->crud_model->read_fordata(array("table" => "salary", "where" => array("salary_number" => $salary['salary_number'], "actor_id" => $salary['actor_id'], "salary_id !=" => $salary['salary_id'])))->num_rows();

                if ($duplicate == 0) {
                    $this->crud_model->update_data("salary", $salary, "salary_id");
                    $actions = "edit";
                    $this->recActivity("Updated sallary No. $salary[salary_number] on Sallary Transaction", "finance");
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Data duplikat'));
                    exit();
                }

                $this->crud_model->update_data('salary', $salary, 'salary_id');
                $get_salary = $this->crud_model->read_fordata(array("table" => "salary", "where" => array("salary_id" => $salary['salary_id'])))->row();
            }

            if (isset($id)) {
                $del['salary_id'] = $get->salary_id;
                $this->crud_model->delete_data("salary_tax", $del);
            }

            for ($in = 0; $in < count($tax); $in++) {
                if (isset($tax[$in])) {
                    $get_tax = $this->crud_model->read_fordata(array("table" => "tax", "where" => array("tax_id" => $tax[$in])))->row();

                    $salary_tax['salary_id'] = $get_salary->salary_id;
                    $salary_tax['tax_id'] = $tax[$in];
                    $salary_tax['salary_tax_cuts'] = $get_tax->tax_cuts;
                    $salary_tax['salary_tax_nominal'] = ($get_tax->tax_cuts / 100) * $salary['salary_pkp'];
                    $this->crud_model->insert_data('salary_tax', $salary_tax);
                }
            }
        }


        $this->session->set_flashdata("msgTransM", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Fee successfully saved</div>");
        echo json_encode(array('status' => 1, 'id' => $sallaryid));
    }

    public function delete($id = NULL) {
        if (!empty($id)) {
            $get['salary'] = $this->crud_model->read_fordata(array("table" => "salary", "where" => array("md5(salary_id)" => $id)));
            if ($get['salary']->num_rows() != 0) {
                $row = $get['salary']->row();
                $this->recActivity("Deleted sallary No. $row->salary_number of Sallary Information", "finance");
                $this->crud_model->delete_data("salary_tax", array("salary_id" => $row->salary_id));
                $this->crud_model->delete_data("salary", array("salary_id" => $row->salary_id));
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Fee successfully removed</div>");
                echo json_encode(array("status" => 1));
            }
        }
    }

}

?>