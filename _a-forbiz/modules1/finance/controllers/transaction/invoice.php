<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Invoice extends MY_Controller {

    private $title = "Invoice";
    private $url = "finance/transaction/invoice/";
    private $view_path = "finance/transaction/invoice/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function index($id = null) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (empty($id)) {
            is_filtered_mod($data['sess']['validation']);
        }
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
        $data['title'] = $this->title;
        if ($data['permit']->access_update == 1) {
            if (!empty($id)) {
                $data['invoice_id'] = $id;
            }
        }
        $data['content'] = "finance/transaction/invoice/index";
        $this->load->view("../index", $data);
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->segment(2);
        $data['title'] = $this->title;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['transaction_ct'] = "Invoice";
        $data['url_action'] = "$data[url]/save/data/$id";
        if ($data['permit']->access_update == 1 && !empty($id)) {
            $data['mog_id'] = $id;
            $data['supplier'] = $this->origin_model->actor(1);
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();

            $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog", "join" => array("project p" => "p.project_id = mog.project_id", "actor a" => "a.actor_id = mog.actor_id"), "where" => array("md5(mog_id)" => $id)))->row();
        } else {
            $data['supplier'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("mog" => "mog.actor_id = a.actor_id"), "group" => "a.actor_id"))->result();
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(pa.users_id)" => $data['sess']['users_id'])))->result();
        }
        $data['tax'] = $this->crud_model->read_fordata(array("table" => "tax", "where" => array("tax_ct_id" => 2)))->result();

        if (!empty($id)) {
            $data["invoice_id"] = $id;
            $data["invoice"] = $this->crud_model->read_fordata(array("table" => "invoice i", "join" => array("actor a" => "a.actor_id = i.actor_id", "project p" => "p.project_id = i.project_id"), "where" => array("md5(invoice_id)" => $id)))->row();
            if ($data["invoice"]->invoice_resource_code == 4) {
                $data['url_action'] = "$data[url]/save/subcon/$id";
            }
        }
        $this->load->view($this->view_path . "invoice_form", $data);
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['permit'] = $data['sess']['permit'];
        $data['url'] = $this->uri->slash_segment(1) . $this->uri->slash_segment(2);
        $child = "(select count(transaction_entry_id) from transaction_entry_stok where transaction_entry_id = e.transaction_entry_id) as child";
        $data['show'] = $this->crud_model->read_fordata(array("table" => "transaction_entry e", "select" => array("*", $child), "join" => array("transaction_entry_ct ec" => "ec.transaction_entry_ct_id = e.transaction_entry_ct_id")))->result();

        $this->load->view("finance/master/transaction_entry/transaction_entry_table", $data);
    }

    public function get_transaction_detail($id = NULL, $counter = NULL, $resouce) {
        if (!empty($id)) {
            $data['sess'] = $this->authentication_root();
            $data['counter'] = $counter;
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->row();
            if ($resouce == 1) {
                $data['mog'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("mog_id" => $id)))->row();
                $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id", "code c" => array("md.code_id = c.code_id", "left")), "where" => array("mog_id" => $id, "mog_dt_status" => 1)))->result();
                $this->load->view($this->url . "mog_detail", $data);
            } else if ($resouce == 2) {
                $data['equipt'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction", "where" => array("equipt_transaction_id" => $id)))->row();
                $data['equipt_dt'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction_dt ed", "join" => array("equipment e" => "e.equipment_id = ed.equipment_id", "equipment_unit eu" => "eu.equipment_unit_id = e.equipment_unit_id", "code c" => array("ed.code_id = c.code_id", "left")), "where" => array("equipt_transaction_id" => $id, "equipt_transaction_dt_status !=" => 3)))->result();
                $this->load->view($this->url . "equipt_transaction_detail", $data);
            }
        }
    }

    public function get_select_transaction($counter, $actor = NULL, $project = NULL, $resource, $invoice = NULL) {
        if (!empty($actor) && !empty($project)) {
            $data['counter'] = $counter;
            $data['resource'] = $resource;
            if ($resource == 1) {
                $data['mog'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("actor_id" => $actor, "project_id" => $project, "mog_status" => 1)))->result();
            } else if ($resource == 2) {
                $data['equipt'] = $this->crud_model->read_fordata(array("table" => "equipt_transaction", "where" => array("actor_id" => $actor, "project_id" => $project, "equipt_transaction_status" => 1)))->result();
            }
            $this->load->view($this->url . "select_transaction", $data);
        }
    }

    public function get_select_actor($resource, $actor = NULL) {
        if (!empty($resource)) {
            if ($resource == 1) {
                if (empty($actor)) {
                    $data['actor'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("mog" => "mog.actor_id = a.actor_id"), "where" => array("mog.mog_status" => 1), "group" => "a.actor_id", "order" => array("mog.mog_id" => "desc")))->result();
                } else {
                    $data['actor'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("mog" => "mog.actor_id = a.actor_id"), "where" => array("mog.mog_status !=" => 0), "group" => "a.actor_id", "order" => array("mog.mog_id" => "desc")))->result();
                }
            } else if ($resource == 2) {
                if (empty($actor)) {
                    $data['actor'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("equipt_transaction et" => "et.actor_id = a.actor_id"), "where" => array("et.equipt_transaction_status" => 1), "group" => "a.actor_id", "order" => array("et.equipt_transaction_id" => "desc")))->result();
                } else {
                    $data['actor'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("equipt_transaction et" => "et.actor_id = a.actor_id"), "where" => array("et.equipt_transaction_status !=" => 0), "group" => "a.actor_id", "order" => array("et.equipt_transaction_id" => "desc")))->result();
                }
            } else if ($resource == 4) {
                $data['actor'] = $this->crud_model->read_fordata(array("table" => "actor a", "join" => array("work_order w" => "w.actor_id = a.actor_id"), "where" => array("w.work_order_status !=" => 3), "group" => "a.actor_id", "order" => array("work_order_id" => "desc")))->result();
            }

            if (!empty($actor)) {
                $data['actor_id'] = $this->crud_model->read_fordata(array("table" => "actor", "where" => array("md5(actor_id)" => $actor)))->row();
            }
            $this->load->view($this->url . "select_actor", $data);
        }
    }

    public function get_select_tax($mode, $ct, $invoice = NULL) {
        if (!empty($mode)) {
            $data['mode'] = $mode;
            $ct = $ct == 4 ? 2 : $ct;

            $data['tax'] = $this->crud_model->read_fordata(array("table" => "tax", "where" => array("tax_ct_id" => $ct, "tax_mode_id" => $mode, "tax_status" => 1)))->result();
            if (!empty($invoice)) {
                foreach ($data['tax'] as $i => $t) {
                    $data['invoice_tax'][$i] = $this->crud_model->read_fordata(array("table" => "invoice_tax", "where" => array("md5(invoice_id)" => $invoice, "tax_id" => $t->tax_id)))->num_rows();
                }
            }
            $this->load->view($this->url . "select_tax", $data);
        }
    }

    public function get_select_equipment($counter = NULL, $actor = NULL, $project = NULL, $mode = NULL, $equipment = NULL) {
        if (!empty($mode)) {
            $data['mode'] = $mode;
            $data['url_access'] = $this->url;
            $data['counter'] = $counter;
            if (!empty($equipment)) {
                $data['equipment_id'] = $equipment;
            }
            $data['equipment'] = $this->crud_model->read_fordata(array("table" => "equipment e", "join" => array("equipt_transaction_dt etd" => "etd.equipment_id = e.equipment_id", "equipt_transaction et" => "et.equipt_transaction_id = etd.equipt_transaction_id"), "where" => array("actor_id" => $actor, "project_id" => $project, "transaction_ct_id" => 1), "group" => "e.equipment_id"))->result();
            $this->load->view($this->url . "select_equipment", $data);
        }
    }

    public function show_row_detail($resource = NULL, $actor = NULL, $project = NULL, $invoice = NULL) {
        if (!empty($resource)) {
            $data['sess'] = $this->authentication_root();
            $data['resource'] = $resource;
            $data['url_access'] = $this->url;

            if ($resource == 4 && !empty($actor) && !empty($project)) {
                $data['wo_ct'] = $this->crud_model->read_fordata(array("table" => "invoice_wo_ct"))->result();
                $data['work_order'] = $this->crud_model->read_fordata(array("table" => "work_order", "where" => array("actor_id" => $actor, "project_id" => $project, "work_order_status !=" => 3)))->result();
            }

            if (!empty($invoice)) {
                $data['invoice'] = $invoice;
                if ($resource == 1) {
                    $data['detail'] = $this->crud_model->read_fordata(array("table" => "invoice_dt dt", "join" => array("mog" => "mog.mog_id = dt.transaction_id"), "where" => array("md5(invoice_id)" => $data['invoice'])))->result();
                    $data['mog'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("actor_id" => $actor, "project_id" => $project, "mog_status" => 1)))->result();

                    foreach ($data['mog'] as $a => $aa) {
                        $data['mog_dt'][$a] = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id", "code c" => array("md.code_id = c.code_id", "left")), "where" => array("mog_id" => $aa->mog_id, "mog_dt_status" => 1)))->result();
                    }
                }
                if ($resource == 2) {
                    $get = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("actor_id" => $actor, "project_id" => $project, "md5(invoice_id)" => $data['invoice'])))->num_rows();
                    if ($get != 0) {
                        $data['detail'] = $this->crud_model->read_fordata(array("table" => "invoice_equipt_dt dt", "join" => array("debt d" => "d.debt_id = dt.debt_id"), "where" => array("md5(invoice_id)" => $data['invoice'])))->result();
                        $data['equipt'] = $this->crud_model->read_fordata(array("table" => "equipment e", "join" => array("equipt_transaction_dt etd" => "etd.equipment_id = e.equipment_id", "equipt_transaction et" => "et.equipt_transaction_id = etd.equipt_transaction_id"), "where" => array("actor_id" => $actor, "project_id" => $project), "group" => "e.equipment_id"))->result();
                    }
                }
                if ($resource == 4) {
                    $get = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("actor_id" => $actor, "project_id" => $project, "md5(invoice_id)" => $data['invoice'])))->num_rows();
//                    $get = $this->crud_model->read_fordata(array("table" => "invoice_wo", "where" => array("md5(invoice_id)" => $invoice)));

                    if ($get != 0) {
                        $data['detail'] = $this->crud_model->read_fordata(array("table" => "invoice_wo wo", "join" => array("invoice i" => "i.invoice_id = wo.invoice_id", "work_order w" => "i.work_order_id = w.work_order_id", "invoice_wo_ct ct" => "ct.invoice_wo_ct_id = wo.invoice_wo_ct_id"), "where" => array("md5(i.invoice_id)" => $invoice)))->row();

                        $max = $this->crud_model->read_fordata(array("table" => "invoice_wo iw", "join" => array("invoice i" => "i.invoice_id = iw.invoice_id"), "where" => array("work_order_id" => $data['detail']->work_order_id, "invoice_wo_sequence" => $data['detail']->invoice_wo_sequence + 1, "invoice_wo_ct_id" => 2)));
                        $min = $this->crud_model->read_fordata(array("table" => "invoice_wo iw", "join" => array("invoice i" => "i.invoice_id = iw.invoice_id"), "where" => array("work_order_id" => $data['detail']->work_order_id, "invoice_wo_sequence" => $data['detail']->invoice_wo_sequence - 1, "invoice_wo_ct_id" => 2)));

                        if ($max->num_rows() > 0) {
                            $data['max'] = $max->row()->invoice_wo_percent;
                        }
                        if ($min->num_rows() > 0) {
                            $data['min'] = $min->row()->invoice_wo_percent;
                        }
                    }
                }
            }
            $this->load->view($this->url . "row_detail", $data);
        }
    }

    public function show_row_count($resource = NULL, $invoice = NULL) {
        if (!empty($resource)) {
            $data['sess'] = $this->authentication_root();
            $data['url_access'] = $this->url;
            $data['resource'] = $resource;

            if (!empty($invoice)) {
                $data['invoice_id'] = $invoice;
                $data['invoice'] = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("md5(invoice_id)" => $invoice)))->row();
                if ($resource == 4) {
                    $data['invoice_wo'] = $this->crud_model->read_fordata(array("table" => "invoice_wo iw", "join" => array("invoice i" => "i.invoice_id = iw.invoice_id", "work_order wo" => "wo.work_order_id = i.work_order_id", "invoice_wo_ct ct" => "ct.invoice_wo_ct_id = iw.invoice_wo_ct_id"), "where" => array("md5(i.invoice_id)" => $invoice)))->row();
                }
                $data['invoice_tax'] = $this->crud_model->read_fordata(array("table" => "invoice_tax it", "join" => array("tax" => "tax.tax_id = it.tax_id"), "where" => array("md5(invoice_id)" => $invoice)))->result();
            }

            $this->load->view($this->url . "row_count", $data);
        }
    }

    public function get_debt_rest($actor, $project, $equipment, $date) {
        $get_debt_final = $this->crud_model->read_fordata(array("table" => "debt_final", "where" => array("actor_id" => $actor, "project_id" => $project, "equipment_id" => $equipment)));
        $debt = 0;
        $argo = 0;
        $volume = 0;
        $price = 0;

        $get = $this->crud_model->read_fordata(array("table" => "equipt_transaction_dt dt", "join" => array("equipt_transaction et" => "dt.equipt_transaction_id = et.equipt_transaction_id"), "where" => array("actor_id" => $actor, "project_id" => $project, "equipment_id" => $equipment, "transaction_ct_id" => 1, "equipt_transaction_dt_status !=" => 3)))->result();

        if ($get_debt_final->num_rows() > 0) {
            $row = $get_debt_final->row();
            $argo = selisih_hari(date('Y-m-d', strtotime($row->debt_final_date)), date('Y-m-d', strtotime($date)));

            $debt = $row->debt_final_rest;
        }

        foreach ($get as $i => $a) {
            if ($get_debt_final->num_rows() == 0) {
                $argo = selisih_hari(date('Y-m-d', strtotime($a->equipt_transaction_date)), date('Y-m-d', strtotime($date)));
            }

            $out = 0;
            $get_out = $this->crud_model->read_fordata(array("table" => "equipt_transaction et", "join" => array("equipt_transaction_dt dt" => "dt.equipt_transaction_id = et.equipt_transaction_id"), "where" => array("actor_id" => $actor, "project_id" => $project, "equipment_id" => $a->equipment_id, "transaction_ct_id" => 2)));
            if ($get_out->num_rows() > 0) {
                foreach ($get_out->result() as $o) {
                    $out = $out + $o->equipt_transaction_dt_volume;
                }
            }

            $volume = $a->equipt_transaction_dt_volume - $out;
            $price = $a->equipt_transaction_dt_price;
            $debt = $debt + ($argo * $volume * $price);
        }

        echo json_encode(array('status' => 1, 'debt' => $debt));
    }

    public function get_work_order($id = NULL) {
        if (!empty($id)) {
            $get_wo = $this->crud_model->read_fordata(array("table" => "work_order wo", "where" => array("work_order_id" => $id)))->row();
            $check = $this->crud_model->read_fordata(array("table" => "invoice i", "join" => array("invoice_wo w" => "w.invoice_id = i.invoice_id"), "where" => array("work_order_id" => $get_wo->work_order_id, "invoice_wo_ct_id" => 2)))->num_rows();
            echo json_encode(array('status' => 1, 'data' => $get_wo, 'termin' => $check));
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $invoice['users_id'] = $this->crud_model->read_fordata(array("table" => "users", "where" => array("md5(users_id)" => $data['sess']['users_id'])))->row()->users_id;
        $invoice['project_id'] = $this->input->post("project");
        $invoice['actor_id'] = $this->input->post("actor");
        $invoice['invoice_ct_id'] = $this->input->post("invoice_ct");
        $invoice['invoice_number'] = $this->input->post("invoice_number");
        $invoice['invoice_tax_serial'] = $this->input->post("invoice_tax_serial");
        $invoice['invoice_total'] = str_replace('.', '', $this->input->post("invoice_total"));
        $invoice['invoice_total_final'] = str_replace('.', '', $this->input->post("total"));
        $invoice['invoice_netto'] = str_replace('.', '', $this->input->post("invoice_netto"));
        $invoice['invoice_bruto'] = str_replace('.', '', $this->input->post("invoice_bruto"));
        $invoice['invoice_note'] = $this->input->post("invoice_note");
        $invoice['invoice_date_pry'] = date('Y-m-d H:i:s', strtotime($this->input->post("invoice_date_pry")));
        $invoice['invoice_date_kwt'] = date('Y-m-d H:i:s', strtotime($this->input->post("invoice_date_kwt")));

        $invoice['invoice_resource_code'] = $this->input->post("invoice_resource_code");

        if (isset($invoice)) {

            if (empty($id)) {
                $duplicate = $this->crud_model->read_fordata(array("table" => "invoice", "or_where" => array("invoice_number" => $invoice['invoice_number'], "invoice_tax_serial" => $invoice['invoice_tax_serial'])))->num_rows();
                if ($duplicate == 0) {
//                    $invoice['invoice_date'] = date("Y-m-d H:i:s", strtotime($this->input->post("invoice_date")));
                    $this->crud_model->insert_data("invoice", $invoice);
                    $this->recActivity("Created invoice No. $invoice[invoice_number] on Invoice Transaction", "finance");
                    ;
                    $actions = "tambah";
                    $invoice_id = $this->crud_model->read_data("invoice")->last_row()->invoice_id;
                } else {
                    echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><i class='fa fa-info-circle mg-r-md'></i>Invoice failed saved</div>"));
                    exit();
                }
            } else {
                $duplicate = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("invoice_number" => $invoice['invoice_number'], "invoice_tax_serial" => $invoice['invoice_tax_serial'], "md5(invoice_id) !=" => $id)))->num_rows();

                if ($duplicate == 0) {
                    $invoice['invoice_id'] = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("md5(invoice_id)" => $id)))->row()->invoice_id;
                    $this->crud_model->update_data("invoice", $invoice, 'invoice_id');
                    $this->recActivity("Updated invoice No. $invoice[invoice_number] on Invoice Transaction", "finance");
                    ;
                    $actions = "ubah";
                    $invoice_id = $invoice['invoice_id'];
                } else {
                    echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><i class='fa fa-info-circle mg-r-md'></i>Invoice failed saved</div>"));
                    exit();
                }
            }
        }

        if (!empty($id)) {
            $invoice_dt_id = array_filter($this->input->post("transaction_dt"));
        }

        if ($invoice['invoice_resource_code'] == 1) {
            $trans_id = $this->input->post('transaction');
        } else if ($invoice['invoice_resource_code'] == 2) {
            $equipment = $this->input->post('equipment');
            $invoice_dt_total = $this->input->post('invoice_dt_total');
            $debt = $this->input->post('debt');
            if (!empty($id)) {
                $debtId = array_filter($this->input->post('debt_id'));
            }
        }
        $tax_id = $this->input->post('tax') ? array_filter($this->input->post('tax')) : NULL;
//        var_dump($tax_id); exit();
        $action = $this->input->post('action');

        $get_invoice = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("invoice_number" => $invoice['invoice_number'], "invoice_tax_serial" => $invoice['invoice_tax_serial'])))->row();

        if ($invoice['invoice_resource_code'] == 1) {
            for ($in = 0; $in < count($trans_id); $in++) {
                if (isset($trans_id[$in])) {
                    $invoice_dt[$action[$in]]['transaction_id'] = $trans_id[$in];
                    $invoice_dt[$action[$in]]['invoice_id'] = $get_invoice->invoice_id;

                    if ($action[$in] == 'edit') {
                        if (isset($invoice_dt[$in])) {
                            $invoice_dt[$action[$in]]['invoice_dt_id'] = $invoice_dt_id[$in];
                            $this->crud_model->update_data('invoice_dt', $invoice_dt['edit'], 'invoice_dt_id');
                        }
                    } else if ($action[$in] == 'delete') {
                        if (isset($invoice_dt_id[$in])) {
                            $this->crud_model->delete_data('invoice_dt', array('invoice_dt_id' => $invoice_dt_id[$in]));
                        }
                    } else if ($action[$in] == 'add') {
                        $this->crud_model->insert_data('invoice_dt', $invoice_dt['add']);
                    }

                    if ($invoice['invoice_resource_code'] == 1) {
                        $mog['mog_status'] = $action[$in] != 'delete' ? 4 : 1;
                        $mog['mog_id'] = $invoice_dt[$action[$in]]['transaction_id'];

                        $this->crud_model->update_data("mog", $mog, "mog_id");
                    } else if ($invoice['invoice_resource_code'] == 2) {
                        $equipt['equipt_transaction_status'] = 4;
                        $equipt['equipt_transaction_id'] = $invoice_dt[$action[$in]]['transaction_id'];

                        $this->crud_model->update_data("equipt_transaction", $equipt, "equipt_transaction_id");
                    }
                }
            }
        } else if ($invoice['invoice_resource_code'] == 2) {
            for ($in = 0; $in < count($equipment); $in++) {
                if (isset($debt[$in])) {
                    $debt_in[$action[$in]]['actor_id'] = $invoice['actor_id'];
                    $debt_in[$action[$in]]['project_id'] = $invoice['project_id'];
                    $debt_in[$action[$in]]['equipment_id'] = $equipment[$in];
                    $debt_in[$action[$in]]['debt_total'] = str_replace('.', '', $debt[$in]);
                    $debt_in[$action[$in]]['debt_rest'] = $debt_in[$action[$in]]['debt_total'] - str_replace('.', '', $invoice_dt_total[$in]);

                    if ($action[$in] == 'delete') {
                        if (isset($debtId[$in])) {
                            $this->crud_model->delete_data('debt', array('debt_id' => $debtId[$in]));
                        }
                        $debt_id = $this->crud_model->read_fordata(array("table" => "debt", "where" => array("debt_id" => $debtId[$in])))->row();

                        $get_debt_fn = $this->crud_model->read_fordata(array("table" => "debt_final", "where" => array("actor_id" => $debt_in[$action[$in]]['actor_id'], "project_id" => $debt_in[$action[$in]]['project_id'], "equipment_id" => $debt_in[$action[$in]]['equipment_id'])))->row();
                        $get_last_debt = $this->crud_model->read_fordata(array("table" => "debt", "where" => array("actor_id" => $debt_in[$action[$in]]['actor_id'], "project_id" => $debt_in[$action[$in]]['project_id'], "equipment_id" => $debt_in[$action[$in]]['equipment_id'])))->last_row();

                        $debt_in[$action[$in]]['debt_rest'] = (str_replace('.', '', $debt[$in]) - $get_debt_fn->debt_final_rest) + $get_debt_fn->debt_final_rest;

                        if (!empty($get_last_debt)) {
                            $del_debt['debt_id'] = $get_last_debt->debt_id;
                            $del_debt['debt_rest'] = $debt_in[$action[$in]]['debt_rest'];
                            $this->crud_model->update_data("debt", $del_debt, 'debt_id');
                        }
                    } else if ($action[$in] == 'edit') {
                        $debt_in['edit']['debt_id'] = $debtId[$in];
                        $this->crud_model->update_data("debt", $debt_in['edit'], 'debt_id');
                        $debt_id = $this->crud_model->read_fordata(array("table" => "debt", "where" => array("debt_id" => $debtId[$in])))->row();
                    } else if ($action[$in] == 'add') {
                        $debt_in[$action[$in]]['debt_date'] = $invoice['invoice_date_pry'];
                        $this->crud_model->insert_data("debt", $debt_in['add']);
                        $debt_id = $this->crud_model->read_fordata(array("table" => "debt", "where" => $debt_in['add']))->row();
                    }

                    $check = $this->crud_model->read_fordata(array("table" => "debt_final", "where" => array("actor_id" => $debt_in[$action[$in]]['actor_id'], "project_id" => $debt_in[$action[$in]]['project_id'], "equipment_id" => $debt_in[$action[$in]]['equipment_id'])));

                    $debt_fn[$check->num_rows()]['actor_id'] = $debt_in[$action[$in]]['actor_id'];
                    $debt_fn[$check->num_rows()]['project_id'] = $debt_in[$action[$in]]['project_id'];
                    $debt_fn[$check->num_rows()]['equipment_id'] = $debt_in[$action[$in]]['equipment_id'];
                    $debt_fn[$check->num_rows()]['debt_final_rest'] = $debt_in[$action[$in]]['debt_rest'];
                    $debt_fn[$check->num_rows()]['debt_final_date'] = empty($debt_in[$action[$in]]['debt_date']) ? date("Y-m-d H:i:s") : $debt_in[$action[$in]]['debt_date'];

                    if ($check->num_rows() == 0) {
                        $this->crud_model->insert_data("debt_final", $debt_fn[$check->num_rows()]);
                    } else {
                        $row = $check->row();
                        $debt_fn[$check->num_rows()]['debt_final_id'] = $row->debt_final_id;
                        $this->crud_model->update_data("debt_final", $debt_fn[$check->num_rows()], "debt_final_id");
                    }
                }

                if (isset($equipment[$in])) {
                    $invoice_dt[$action[$in]]['equipment_id'] = $debt_in[$action[$in]]['equipment_id'];
                    $invoice_dt[$action[$in]]['invoice_id'] = $get_invoice->invoice_id;
                    $invoice_dt[$action[$in]]['invoice_equipt_dt_total'] = str_replace('.', '', $invoice_dt_total[$in]);

                    if ($action[$in] == 'delete') {
                        if (isset($invoice_dt_id[$in])) {
                            $this->crud_model->delete_data('invoice_equipt_dt', array('invoice_equipt_id' => $invoice_dt_id[$in]));
                        }
                    } if ($action[$in] == 'edit') {
                        $invoice_dt[$action[$in]]['debt_id'] = $debt_id->debt_id;
                        if (isset($invoice_dt)) {
                            $invoice_dt['edit']['invoice_equipt_id'] = $invoice_dt_id[$in];
                            $this->crud_model->update_data('invoice_equipt_dt', $invoice_dt['edit'], 'invoice_equipt_id');
                        }
                    } else if ($action[$in] == 'add') {
                        $invoice_dt[$action[$in]]['debt_id'] = $debt_id->debt_id;
                        $this->crud_model->insert_data('invoice_equipt_dt', $invoice_dt['add']);
                    }
                }
            }
        }

        if (!empty($id)) {
            $del_tax['invoice_id'] = $invoice_id;
            $this->crud_model->delete_data("invoice_tax", $del_tax);
        }

        for ($i = 0; $i < count($tax_id); $i++) {
            if (isset($tax_id[$i])) {
                $tax_in['invoice_id'] = $get_invoice->invoice_id;
                $tax_in['tax_id'] = $tax_id[$i];

                $tax_cuts[$i] = $this->crud_model->read_fordata(array("table" => "tax", "where" => array("tax_id" => $tax_id[$i])))->row()->tax_cuts;

                $tax_in['invoice_tax_cuts'] = $tax_cuts[$i];
                $tax_in['invoice_tax_nominal'] = ($tax_cuts[$i] / 100) * $invoice['invoice_netto'];

                $this->crud_model->insert_data('invoice_tax', $tax_in);
            }
        }

        $this->session->set_flashdata("msgTransM", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Data berhasil di$actions</div>");
        echo json_encode(array('status' => 1, 'id' => $get_invoice->invoice_id));
    }

    public function save_subkon($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $invoice['users_id'] = $this->crud_model->read_fordata(array("table" => "users", "where" => array("md5(users_id)" => $data['sess']['users_id'])))->row()->users_id;
        $invoice['work_order_id'] = $this->input->post("work_order");
        $invoice['project_id'] = $this->input->post("project");
        $invoice['actor_id'] = $this->input->post("actor");
        $invoice['invoice_ct_id'] = $this->input->post("invoice_ct");
        $invoice['invoice_number'] = $this->input->post("invoice_number");
        $invoice['invoice_tax_serial'] = $this->input->post("invoice_tax_serial");
        $invoice['invoice_total'] = str_replace('.', '', $this->input->post("work_order_contract"));
        $invoice['invoice_total_final'] = str_replace('.', '', $this->input->post("total"));
        $invoice['invoice_netto'] = str_replace('.', '', $this->input->post("invoice_netto"));
        $invoice['invoice_bruto'] = str_replace('.', '', $this->input->post("invoice_bruto"));
        $invoice['invoice_note'] = $this->input->post("invoice_note");
        $invoice['invoice_date_pry'] = date('Y-m-d H:i:s', strtotime($this->input->post("invoice_date_pry")));
        $invoice['invoice_date_kwt'] = date('Y-m-d H:i:s', strtotime($this->input->post("invoice_date_kwt")));
//        $invoice['invoice_date_dpt'] = date('Y-m-d H:i:s', strtotime($this->input->post("invoice_date_dpt")));
//        $invoice['invoice_date_due'] = date('Y-m-d', strtotime($this->input->post("invoice_date_due")));
        $invoice['invoice_resource_code'] = $this->input->post("invoice_resource_code");

        if (isset($invoice)) {
            if (empty($id)) {
                $duplicate = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("invoice_number" => $invoice['invoice_number'], "invoice_tax_serial" => $invoice['invoice_tax_serial'])))->num_rows();
                if ($duplicate == 0) {
//                    $invoice['invoice_date'] = date("Y-m-d H:i:s", strtotime($this->input->post("invoice_date")));
                    $this->crud_model->insert_data("invoice", $invoice);
                    $this->recActivity("Created invoice No. $invoice[invoice_number] on Invoice Transaction", "finance");
                    ;
                    $actions = "tambah";
                    $invoice_id = $this->crud_model->read_data("invoice")->last_row()->invoice_id;
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Data duplikat'));
                    exit();
                }
            } else {
                $duplicate = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("invoice_number" => $invoice['invoice_number'], "invoice_tax_serial" => $invoice['invoice_tax_serial'], "md5(invoice_id) !=" => $id)))->num_rows();

                if ($duplicate == 0) {
                    $invoice['invoice_id'] = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("md5(invoice_id)" => $id)))->row()->invoice_id;
                    $this->crud_model->update_data("invoice", $invoice, 'invoice_id');
                    $this->recActivity("Updated invoice No. $invoice[invoice_number] on Invoice Transaction", "finance");
                    ;
                    $actions = "ubah";
                    $invoice_id = $invoice['invoice_id'];
                } else {
                    echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><i class='fa fa-info-circle mg-r-md'></i>Invoice failed saved</div>"));
                    exit();
                }
            }
        }

        $tax_id = $this->input->post('tax') ? array_filter($this->input->post('tax')) : NULL;
        $action = $this->input->post('action');

        $get_invoice = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("invoice_number" => $invoice['invoice_number'], "invoice_tax_serial" => $invoice['invoice_tax_serial'])))->row();

        $get_seq = $this->crud_model->read_fordata(array("table" => "invoice_wo wo", "join" => array("invoice i" => "i.invoice_id = wo.invoice_id"), "where" => array("work_order_id" => $invoice['work_order_id'], "invoice_wo_ct_id" => $this->input->post('invoice_wo_ct'))));

        $sequence = $get_seq->num_rows() > 0 ? $get_seq->last_row()->invoice_wo_sequence + 1 : 1;

        $invoice_wo['invoice_wo_ct_id'] = $this->input->post('invoice_wo_ct');
        $invoice_wo['invoice_id'] = $get_invoice->invoice_id;
        $invoice_wo['invoice_wo_total'] = str_replace('.', '', $this->input->post('total'));
        $invoice_wo['invoice_wo_nominal'] = $this->input->post('new_termin') ? str_replace('.', '', $this->input->post('new_termin')) : str_replace('.', '', $this->input->post('pre_netto'));
        $invoice_wo['invoice_wo_percent'] = $this->input->post('percent_netto') ? str_replace(',', '.', str_replace('.', '', $this->input->post('percent_netto'))) : NULL;
        $invoice_wo['invoice_wo_retensi'] = $this->input->post('retensi') ? str_replace('.', '', $this->input->post('retensi')) : NULL;
        $invoice_wo['invoice_wo_dp'] = $this->input->post('angsuran_um') ? str_replace('.', '', $this->input->post('angsuran_um')) : NULL;

        if (isset($invoice_wo)) {
            if (empty($id)) {
                $invoice_wo['invoice_wo_date'] = $invoice['invoice_date_pry'];
                $invoice_wo['invoice_wo_sequence'] = $invoice_wo['invoice_wo_ct_id'] != 2 ? 0 : $sequence;
                $this->crud_model->insert_data('invoice_wo', $invoice_wo);
            } else {
                $invoice_wo['invoice_wo_id'] = $this->crud_model->read_fordata(array("table" => "invoice_wo", "where" => array("md5(invoice_id)" => $id)))->row()->invoice_wo_id;
                $this->crud_model->update_data('invoice_wo', $invoice_wo, 'invoice_wo_id');
            }

            $wo['work_order_id'] = $invoice['work_order_id'];
            if ($invoice_wo['invoice_wo_ct_id'] == 1) {
                $wo['work_order_status'] = 1;
            } else if ($invoice_wo['invoice_wo_ct_id'] == 3) {
                $wo['work_order_status'] = 3;
            } else if ($invoice_wo['invoice_wo_ct_id'] == 2) {
                $wo['work_order_status'] = $invoice_wo['invoice_wo_percent'] == 100 ? 2 : $this->crud_model->read_fordata(array("table" => "work_order", "where" => array("work_order_id" => $invoice['work_order_id'])))->row()->work_order_status;
            }

            if (isset($wo['work_order_status'])) {
                $this->crud_model->update_data('work_order', $wo, 'work_order_id');
            }
        }

        if (!empty($id)) {
            $del_tax['invoice_id'] = $invoice_id;
            $this->crud_model->delete_data("invoice_tax", $del_tax);
        }

        for ($i = 0; $i < count($tax_id); $i++) {
            if (isset($tax_id[$i])) {
                $tax_in['invoice_id'] = $get_invoice->invoice_id;
                $tax_in['tax_id'] = $tax_id[$i];

                $tax_cuts[$i] = $this->crud_model->read_fordata(array("table" => "tax", "where" => array("tax_id" => $tax_id[$i])))->row()->tax_cuts;

                $tax_in['invoice_tax_cuts'] = $tax_cuts[$i];
                $tax_in['invoice_tax_nominal'] = ($tax_cuts[$i] / 100) * $invoice['invoice_netto'];

                $this->crud_model->insert_data('invoice_tax', $tax_in);
            }
        }

        $this->session->set_flashdata("msgTransM", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Data berhasil di$actions</div>");
        echo json_encode(array('status' => 1, 'id' => $get_invoice->invoice_id));
    }

    public function get_invoice_history($wo_id = NULL, $invoice = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (!empty($wo_id)) {
            $data['url_access'] = $this->url;
            if (empty($invoice)) {
                $data['termin'] = $this->crud_model->read_fordata(array("table" => "invoice i", "join" => array("invoice_wo wo" => "i.invoice_id = wo.invoice_id"), "where" => array("work_order_id" => $wo_id, "invoice_wo_ct_id" => 2)));
            } else {
                $data['invoice'] = $this->crud_model->read_fordata(array("table" => "invoice_wo iw", "where" => array("md5(invoice_id)" => $invoice)))->row();
                $data['termin'] = $this->crud_model->read_fordata(array("table" => "invoice i", "join" => array("invoice_wo wo" => "i.invoice_id = wo.invoice_id"), "where" => array("work_order_id" => $wo_id, "invoice_wo_ct_id" => 2, "invoice_wo_sequence <" => $data['invoice']->invoice_wo_sequence)));
            }

            if ($data['termin']->num_rows() > 0) {
                $data['termin'] = $data['termin']->result();
                $data['max_progres'] = $this->crud_model->read_fordata(array("select" => "max(invoice_wo_percent) as max_percent", "table" => "invoice i", "join" => array("invoice_wo wo" => "i.invoice_id = wo.invoice_id"), "where" => array("work_order_id" => $wo_id, "invoice_wo_ct_id" => 2)))->row()->max_percent;
                $this->load->view($this->url . 'row_termin_history', $data);
            }
        }
    }

    public function show_detail_termin($invoice = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (!empty($invoice)) {
            $data['termin'] = $this->crud_model->read_fordata(array("table" => "invoice i", "join" => array("invoice_wo wo" => "wo.invoice_id = i.invoice_id", "work_order w" => "w.work_order_id = i.work_order_id"), "where" => array("md5(i.invoice_id)" => $invoice)))->row();
            $data['pot_termin'] = $this->crud_model->read_fordata(array("table" => "invoice i", "join" => array("invoice_wo wo" => "i.invoice_id = wo.invoice_id"), "where" => array("work_order_id" => $data['termin']->work_order_id, "invoice_wo_ct_id" => 2, "invoice_wo_sequence <" => $data['termin']->invoice_wo_sequence)))->result();
            $data['invoice_tax'] = $this->crud_model->read_fordata(array("table" => "invoice_tax it", "join" => array("tax" => "tax.tax_id = it.tax_id"), "where" => array("md5(invoice_id)" => $invoice)))->result();

            $this->load->view($this->url . "row_detail_termin", $data);
        }
    }

    public function delete($id = NULL) {
        if (!empty($id)) {
            $get['inv'] = $this->crud_model->read_fordata(array("table" => "invoice", "where" => array("md5(invoice_id)" => $id)));
            if ($get['inv']->num_rows() != 0) {
                $row = $get['inv']->row();
                if ($row->invoice_resource_code == 1) {
                    $get['detail'] = $this->crud_model->read_fordata(array("table" => "invoice_dt dt", "join" => array("mog" => "mog.mog_id = dt.transaction_id"), "where" => array("invoice_id" => $row->invoice_id)))->result();
                    foreach ($get['detail'] as $dt) {
                        $mog['mog_id'] = $dt->mog_id;
                        $mog['mog_status'] = 1;
                        $this->crud_model->update_data("mog", $mog, "mog_id");
                    }

                    $this->crud_model->delete_data("invoice_dt", array("invoice_id" => $row->invoice_id));
                }

                if ($row->invoice_resource_code == 2) {
                    $get['detail'] = $this->crud_model->read_fordata(array("table" => "invoice_equipt_dt dt", "join" => array("debt d" => "d.debt_id = dt.debt_id"), "where" => array("invoice_id" => $row->invoice_id)))->result();
                    foreach ($get['detail'] as $dt) {
                        $this->crud_model->delete_data("debt", array("debt_id" => $dt->debt_id));

                        $get['debt_fn'] = $this->crud_model->read_fordata(array("table" => "debt_final", "where" => array("actor_id" => $row->actor_id, "project_id" => $row->project_id, "equipment_id" => $dt->equipment_id)))->row();
                        $get['debt'] = $this->crud_model->read_fordata(array("table" => "debt", "where" => array("actor_id" => $row->actor_id, "project_id" => $row->project_id, "equipment_id" => $dt->equipment_id)))->last_row();
//                        $debt_fn['debt_final_rest'] = $dt->invoice_equipt_dt_total + $get['debt_fn']->debt_final_rest;
                        $debt_fn['debt_final_date'] = $get['debt']->debt_date;
                        $debt_fn['debt_final_rest'] = $get['debt']->debt_rest;

                        $this->crud_model->update_fordata("debt_final", $debt_fn, array("debt_final_id" => $get['debt_fn']->debt_final_id));
                    }

                    $this->crud_model->delete_data("invoice_equipt_dt", array("invoice_id" => $row->invoice_id));
                }

                if ($row->invoice_resource_code == 4) {
                    $get['wo'] = $this->crud_model->read_fordata(array("table" => "work_order", "where" => array("work_order_id" => $row->work_order_id)))->row();

                    if (!empty($get['wo'])) {
                        if ($get['wo']->work_order_status == 1) {
                            $wo['work_order_status'] = 0;
                        } else if ($get['wo']->work_order_status == 2) {
                            $wo['work_order_status'] = 1;
                        } else if ($get['wo']->work_order_status == 3) {
                            $wo['work_order_status'] = 2;
                        }
                        if (isset($wo)) {
                            $this->crud_model->update_fordata("work_order", $wo, array("work_order_id" => $row->work_order_id));
                        }
                    }

                    $this->crud_model->delete_data("invoice_wo", array("invoice_id" => $row->invoice_id));
                }
                $this->recActivity("Deleted invoice No. $row->invoice_number of Information Invoice", "finance");

                $this->crud_model->delete_data("invoice_tax", array("invoice_id" => $row->invoice_id));
                $this->crud_model->delete_data("invoice", array("invoice_id" => $row->invoice_id));

                $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Peralatan berhasil dihapus</div>");
                echo json_encode(array("status" => 1));
            }
        }
    }

}

?>