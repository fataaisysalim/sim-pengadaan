<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Payment extends MY_Controller {

    private $title = "Payment";
    private $url = "finance/payment/";
    private $view_path = "finance/transaction/payment/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model", "payment_model"));
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
        if ($data['permit']->access_update == 1) {
            if (!empty($id)) {
                $data['invoice_id'] = $id;
            }
        }
        $data['content'] = $this->view_path . "index";
        $this->load->view("../index", $data);
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->segment(2);
        $data['title'] = $this->title;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['id'] = (!empty($id)) ? $id : null;
        $data['transaction_ct'] = "Payment";
        $data['url_access'] = "$this->url";
        $data['url_action'] = "$data[url]/payment-inv/$id";
        if ($data['permit']->access_update == 1 && !empty($id)) {
            $data['invoice_id'] = $id;
            $data['invoice'] = $this->crud_model->read_fordata(array("table" => "invoice i", "where" => array("md5(invoice_id)" => $id)))->row();
            $data['suplier'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("invoice i" => "i.actor_id = a.actor_id"), "group" => "a.actor_id"))->result();
        } else {
            $data['suplier'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("invoice i" => "i.actor_id = a.actor_id"), "where" => array("invoice_payment_status !=" => "1"), "group" => "a.actor_id"))->result();
        }

        /* finance lanjut */
//        $this->load->view($this->view_path ."payment_form", $data);
        /* pembayaran invoice */
        $this->load->view($this->view_path . "payment_invoice_form", $data);
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;

        $child = "(select count(transaction_entry_id) from transaction_entry_stok where transaction_entry_id = e.transaction_entry_id) as child";
        $data['show'] = $this->crud_model->read_fordata(array("table" => "transaction_entry e", "select" => array("*", $child), "join" => array("transaction_entry_ct ec" => "ec.transaction_entry_ct_id = e.transaction_entry_ct_id")))->result();

        $this->load->view("finance/master/transaction_entry/transaction_entry_table", $data);
    }

    public function get_select_invoice($id, $invoice_id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
        $child1 = "(select invoice_wo_ct_name from invoice_wo iw join invoice_wo_ct ct on (ct.invoice_wo_ct_id = iw.invoice_wo_ct_id) where invoice_id = i.invoice_id) as wo_ct";
        $child2 = "(select invoice_wo_sequence from invoice_wo where invoice_id = i.invoice_id) as sequence";
        if ($data['permit']->access_update == 1 && $invoice_id != NULL) {
            $data['invoice_id'] = $this->crud_model->read_fordata(array("table" => "invoice i", "where" => array("md5(invoice_id)" => $invoice_id)))->row();
            $data['invoice'] = $this->crud_model->read_fordata(array("select" => "*, $child1, $child2", "table" => "invoice i", "join" => array("actor a" => "a.actor_id = i.actor_id"), "where" => array("md5(i.actor_id)" => $id)))->result();
        } else {
            $data['invoice'] = $this->crud_model->read_fordata(array("select" => "*, $child1, $child2", "table" => "invoice i", "join" => array("actor a" => "a.actor_id = i.actor_id"), "where" => array("md5(i.actor_id)" => $id, "invoice_payment_status !=" => "1")))->result();
        }

        $this->load->view($this->view_path . "select_invoice", $data);
    }

    public function get_invoice_payment($id) {
        $data['sess'] = $this->authentication_root();
        $data['invoice'] = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("md5(invoice_id)" => $id)))->row();
        $data['invoice_tax'] = $this->crud_model->read_fordata(array("select" => array("sum(invoice_tax_nominal) as tax, tax_name"), "table" => "invoice_tax it", "join" => array("tax" => "tax.tax_id = it.tax_id"), "where" => array("md5(invoice_id)" => $id), "group" => "it.tax_id"))->result();
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
        if ($data['invoice']->invoice_resource_code == 4) {
            $data['inv_wo'] = $this->crud_model->read_fordata(array("table" => "invoice i", "join" => array("work_order w" => "w.work_order_id = i.work_order_id", "invoice_wo iw" => "iw.invoice_id = i.invoice_id"), "where" => array("md5(i.invoice_id)" => $id)))->row();

            if ($data['inv_wo']->invoice_wo_ct_id == 2) {
                $data['pot_termin'] = $this->crud_model->read_fordata(array("table" => "invoice i", "join" => array("invoice_wo iw" => "iw.invoice_id = i.invoice_id"), "where" => array("work_order_id" => $data['inv_wo']->work_order_id, "invoice_wo_sequence <" => $data['inv_wo']->invoice_wo_sequence, "invoice_wo_ct_id" => 2)))->result();
            }
        }

        $this->load->view($this->view_path . "invoice_payment", $data);
    }

    public function get_invoice_detail($id) {
        if (!empty($id)) {
            $data['sess'] = $this->authentication_root();
            $data['counter'] = $counter;
        }
    }

    public function get_invoice($id) {
        $invoice = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("invoice_id" => $id)))->row();
        if ($invoice->invoice_payment_status == 2) {
            $get = $this->crud_model->read_fordata(array("table" => "payment", "where" => array("invoice_id" => $id)))->row();
        }
        $sisa = isset($get) ? $get->payment_sequence : 0;
        $id = isset($get) ? $get->payment_id : NULL;
        echo json_encode(array('status' => 1, 'data' => $invoice, 'payment_id' => $id, 'sisa' => $sisa));
    }

    public function get_transaction_detail($id) {
        $data['sess'] = $this->authentication_root();
        $invoice = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("invoice_id" => $id)))->row();

        $data['total_invoice'] = $invoice->invoice_total;
        $data['invoice_dt'] = $this->payment_model->show_invoice_detail($id, $invoice->invoice_resource_code);
        if ($invoice->invoice_resource_code == 1) {
            $this->load->view($this->url . "invoice_detail_mog", $data);
        } else if ($invoice->invoice_resource_code == 2) {
            $this->load->view($this->view_path . "detail_invoice_equipt", $data);
        }
    }

    public function get_select_transaction($counter, $actor = NULL, $project = NULL, $resource) {
        if (!empty($actor) && !empty($project)) {
            $data['counter'] = $counter;
            $data['resource'] = $resource;
            if ($resource == 1) {
                $data['mog'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("actor_id" => $actor, "project_id" => $project, "mog_status" => 1)))->result();
            } else if ($resource == 2) {
                $data['equipt'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction", "where" => array("actor_id" => $actor, "project_id" => $project, "equipt_transaction_status" => 1)))->result();
            }
            $this->load->view($this->view_path . "select_transaction", $data);
        }
    }

    public function get_select_actor($resource) {
        if (!empty($resource)) {
            if ($resource == 1) {
                $data['supplier'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("mog" => "mog.actor_id = a.actor_id"), "group" => "a.actor_id"))->result();
            } else if ($resource == 2) {
                $data['supplier'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("equipt_transaction et" => "et.actor_id = a.actor_id"), "group" => "a.actor_id"))->result();
            }
            $this->load->view($this->view_path . "select_actor", $data);
        }
    }

    public function update_payment_status() {
        $id = $this->input->post('invoice');
        $data['invoice_id'] = $this->crud_model->read_fordata(array("table" => 'invoice', "where" => array("md5(invoice_id)" => $id)))->row()->invoice_id;
        $data['invoice_payment_status'] = $this->input->post('invoice_payment_status');

        $actions = 'edit';

        $this->crud_model->update_data("invoice", $data, "invoice_id");
        $this->session->set_flashdata("msgTransM", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Data berhasil di$actions</div>");
        echo json_encode(array('status' => 1));
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
        $payment['invoice_id'] = $this->input->post("invoice");
        $inv = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("invoice_id" => $payment['invoice_id'])))->row();
        if (isset($payment)) {
            if (empty($id)) {
                $payment['payment_date'] = date('Y-m-d H:i:s');
                $payment['payment_total'] = str_replace('.', '', $this->input->post("payment_total"));
                $payment['payment_sequence'] = str_replace('.', '', $this->input->post("invoice_total")) - $payment['payment_total'];
//                $duplicate = $this->crud_model->read_fordata(array("table" => "payment", "where" => array("invoice_id" => $payment['payment_number'])))->num_rows();
//                if ($duplicate == 0) {
//                    $payment['payment_date'] = date("Y-m-d H:i:s", strtotime($this->input->post("payment_date")));
                $this->crud_model->insert_data("payment", $payment);
                $actions = "tambah";
//                    $payment_id = $this->crud_model->read_data("payment")->last_row()->payment_id;
//                } else {
//                    echo json_encode(array('status' => 0, 'msg' => 'Data duplikat'));
//                    exit();
//                }
                $invoice['invoice_payment_status'] = $payment['payment_sequence'] == 0 ? 1 : 2;
                $invoice['invoice_id'] = $payment['invoice_id'];
                $this->crud_model->update_data('invoice', $invoice, 'invoice_id');
                $this->recActivity("Payment Invoice No. <b>$inv->invoice_number</b> on Payment Transaction", "finance");
            } else {
                $get = $this->crud_model->read_data("payment", array("payment_id" => $id))->row();
                $payment['payment_total'] = str_replace('.', '', $this->input->post("payment_total")) + $get->payment_total;
                $payment['payment_sequence'] = str_replace('.', '', $this->input->post("payment_total")) - str_replace('.', '', $this->input->post("payment_sequence"));
                $payment['payment_id'] = $id;

                $this->crud_model->update_data("payment", $payment, "payment_id");
                $actions = "edit";

                $invoice['invoice_payment_status'] = $payment['payment_sequence'] == 0 ? 1 : 2;
                $invoice['invoice_id'] = $payment['invoice_id'];
                $this->crud_model->update_data('invoice', $invoice, 'invoice_id');
                $this->recActivity("Update status payment Invoice No. <b>$inv->invoice_number</b> on Payment Transaction", "finance");
            }
        }


        $this->session->set_flashdata("msgTransM", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Data berhasil di$actions</div>");
        echo json_encode(array('status' => 1));
    }

}

?>