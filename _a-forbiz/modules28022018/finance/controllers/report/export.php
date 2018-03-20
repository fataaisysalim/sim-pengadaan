<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Export extends MY_Controller {

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->helper(array('folarium', 'date_format'));
        $this->load->model("origin_model");
    }

    public function index() {
        //nothing to do here
    }

    public function invoice($project = null, $start = null, $end = null, $status = null, $actor = null) {
        $data = array(
            'title_page' => 'Invoice',
            'title_file' => 'invoice',
            'title_company' => $this->config->item('config_client'),
            'setting_date' => date('Y-m-d')
        );
        switch ($status):
            case null:
                break;
            case 'all':
                $data['title_page'] = $data['title_page'] . ' All';
                $data['title_file'] = $data['title_file'] . '_all';
                break;
            case 0 :
                $data['title_page'] = $data['title_page'] . ' Outstanding';
                $data['title_file'] = $data['title_file'] . '_outstanding';
                break;
            case 1 :
                $data['title_page'] = $data['title_page'] . ' Paid';
                $data['title_file'] = $data['title_file'] . '_paid';
                break;
        endswitch;
        $data['start'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;

        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();
        $data['actor'] = $actor;
        $data['mode'] = $status;

        $where = array(
            "md5(inv.project_id)" => "$project",
            "DATE(inv.invoice_date_kwt) >=" => date2mysql($data['start']),
            "DATE(inv.invoice_date_kwt) <=" => date2mysql($data['ends'])
        );
        if ($actor != null) {
            $where['md5(inv.actor_id)'] = $actor;
        }
        if ($status != null) {
            if ($status != 'all') :
                $where['inv.invoice_payment_status'] = $status;
            endif;
        }
        $data["show"] = $this->origin_model->invTotal($where);
        $data['content'] = "finance/report/export/export_invoice";
        $this->load->view($data['content'], $data);
    }

    public function salary($project = null, $start = null, $end = null, $mode = null) {
        $data = array(
            'title_page' => 'Salary',
            'title_file' => 'salary',
            'title_company' => $this->config->item('config_client'),
            'setting_date' => date('Y-m-d')
        );
        if ($mode == 'monitoring') :
            $data['title_page'] = $data['title_page'] . ' Monitoring';
            $data['title_file'] = $data['title_file'] . '_monitoring';
        else:
            $data['title_page'] = $data['title_page'] . ' Pph Pasal 21';
            $data['title_file'] = $data['title_file'] . '_pph21';
        endif;
        $data['start'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;

        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();
        $data['mode'] = $mode;

        $where = array(
            "md5(sal.project_id)" => "$project",
            "DATE(sal.salary_date) >=" => date2mysql($data['start']),
            "DATE(sal.salary_date) <=" => date2mysql($data['ends'])
        );
        $order = array("sal.salary_date" => "asc");
        $join = array(
            "actor ac" => "ac.actor_id = sal.actor_id",
            "project p" => "p.project_id = sal.project_id"
        );
        $data["show"] = $this->crud_model->read_data_with_false("salary sal", $where, $order, $join)->result();

        foreach ($data['show'] as $index => $row) :
            $data['tax'] = $this->crud_model->read_data("salary_tax", array('salary_id' => $row->salary_id), null, array('tax' => 'salary_tax.tax_id = tax.tax_id'))->result();
            if (count($data['tax']) > 0) :
                foreach ($data['tax'] as $row_) :
                    $data['show'][$index]->salary_tax = $data['tax'];
                endforeach;
            else:
                $data['show'][$index]->salary_tax = array();
            endif;
        endforeach;

        $data['content'] = "finance/report/export/export_salary";
        $this->load->view($data['content'], $data);
    }

    public function invoice_tax($project = null, $start = null, $end = null, $mode = null) {
        $data = array(
            'title_page' => 'Invoice',
            'title_file' => 'invoice',
            'title_company' => $this->config->item('config_client'),
            'setting_date' => date('Y-m-d')
        );

        switch ($mode) :
            case 'ppn' :
                $data['mode_title'] = "PPN";
                $data['title_file'] = $data['title_file'] . '_ppn';
                break;
            case 'pph21':
                $data['mode_title'] = "PPh Pasal 21";
                $data['title_file'] = $data['title_file'] . '_pph21';
                break;
            case 'pph22' :
                $data['mode_title'] = "PPh Pasal 22";
                $data['title_file'] = $data['title_file'] . '_pph22';
                break;
            case 'pph23':
                $data['mode_title'] = "PPh Pasal 23";
                $data['title_file'] = $data['title_file'] . '_pph23';
                break;
        endswitch;

        $data['starts'] = strtotime($start) > strtotime($end) ? $end : $start;
        $data['ends'] = strtotime($start) > strtotime($end) ? $start : $end;

        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();
        $data['mode'] = $mode;

        $where = array(
            "md5(inv.project_id)" => "$project",
            "DATE(inv.invoice_date_kwt) >=" => date2mysql($data['starts']),
            "DATE(inv.invoice_date_kwt) <=" => date2mysql($data['ends'])
        );
        $order = array("inv.invoice_date_kwt" => "asc");
        $join = array(
            "actor ac" => "ac.actor_id = inv.actor_id",
            "users us" => "us.users_id = inv.users_id",
            "project p" => "p.project_id = inv.project_id"
        );
        $data["show"] = $this->crud_model->read_data_with_false("invoice inv", $where, $order, $join)->result();

        foreach ($data['show'] as $index => $row) :
            $data['tax'] = $this->crud_model->read_data("invoice_tax", array('invoice_id' => $row->invoice_id), null, array('tax' => 'invoice_tax.tax_id = tax.tax_id'))->result();
            if (count($data['tax']) > 0) :
                foreach ($data['tax'] as $row_) :
                    $data['show'][$index]->invoice_tax = $data['tax'];
                endforeach;
            else:
                $data['show'][$index]->invoice_tax = array();
            endif;
        endforeach;

        $where_start = array(
            "md5(inv.project_id)" => "$project",
            "DATE(inv.invoice_date_kwt) >=" => date2mysql($data['starts'])
        );
        $select_start = "DATE(inv.invoice_date_kwt) as starts";
        $order_start = array("inv.invoice_date_kwt" => "asc");
        $limit_start = 1;
        $data['start_date'] = $this->crud_model->read_data_with_false('invoice inv', $where_start, $order_start, null, $limit_start, null, $select_start)->row();

        $where_end = array(
            "md5(inv.project_id)" => "$project",
            "DATE(inv.invoice_date_kwt) <=" => date2mysql($data['ends'])
        );
        $select_end = "DATE(inv.invoice_date_kwt) as ends";
        $order_end = array("inv.invoice_date_kwt" => "DESC");
        $limit_end = 1;
        $data['end_date'] = $this->crud_model->read_data_with_false('invoice inv', $where_end, $order_end, null, $limit_end, null, $select_end)->row();

        $data['content'] = "finance/report/export/export_invoice_tax";
        $this->load->view($data['content'], $data);
    }

}
