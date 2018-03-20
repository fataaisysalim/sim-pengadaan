<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Material extends MY_Controller {

    private $title = "Material Receipt";
    private $url = "procurement/transaction/material/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
    }

    public function index($id = null) {
        $data['sess'] = $this->authentication_root();
        $data['active'] = empty($id)?$data['sess']['gotcurrent']->mod_menu_id:null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['url_access'] = $this->url;
        if ($data['sess']['position_id'] == 1) {
            if (!empty($id)) {
                $data['mog_id'] = $id;
            }
        }
        $data['content'] = "procurement/transaction/material/entry/index";
        $this->load->view("../index", $data);
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['transaction_ct'] = "Monitoring Pengadaan Material";
        $data['url_access'] = "$this->url";
        $data['url_action'] = $this->url . 'save/' . $id;
        if ($data['sess']['position_id'] == 5) {
            $data['mog'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("mog.mog_status" => 0),"join"=>array("actor a"=>"a.actor_id = mog.actor_id","project p"=>"p.project_id = mog.project_id")))->result();
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
        } else if ($data['sess']['position_id'] == 1) {
            if (!empty($id)) {
                $data['mog_id'] = $id;
                $data['supplier'] = $this->origin_model->actor(1);
                $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
                $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
                $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog", "join" => array("project p" => "p.project_id = mog.project_id", "actor a" => "a.actor_id = mog.actor_id"), "where" => array("md5(mog_id)" => $id)))->row();
            } else {
                $data['mog'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("mog.mog_status" => 0),"join"=>array("actor a"=>"a.actor_id = mog.actor_id","project p"=>"p.project_id = mog.project_id")))->result();
                $data['supplier'] = $this->origin_model->actor(1);
                $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
                $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
            }
        }
        $data['material_sub'] = $this->crud_model->read_fordata(array("table" => "material_sub", "where" => array("material_sub_status" => 1)))->result();

        $this->load->view("procurement/transaction/material/entry/material_entry_form", $data);
    }
	
    public function tambah($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['active'] = empty($id)?$data['sess']['gotcurrent']->mod_menu_id:null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['url_access'] = $this->url;
        if ($data['sess']['position_id'] == 1) {
            if (!empty($id)) {
                $data['mog_id'] = $id;
            }
        }
        $data['content'] = "procurement/transaction/material/entry/form_pengadaan";
        $this->load->view("../index", $data);
    }

    public function table() {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;

        $child = "(select count(transaction_entry_id) from transaction_entry_stok where transaction_entry_id = e.transaction_entry_id) as child";
        $data['show'] = $this->crud_model->read_fordata(array("table" => "transaction_entry e", "select" => array("*", $child), "join" => array("transaction_entry_ct ec" => "ec.transaction_entry_ct_id = e.transaction_entry_ct_id")))->result();

        $this->load->view("procurement/master/transaction_entry/transaction_entry_table", $data);
    }

    public function get_material($project = null, $counter = null) {
        $data['count'] = $counter;
        $data['show'] = $this->origin_model->material_stock($project);
        $this->load->view("procurement/transaction/material/extend/material", $data);
    }

    public function get_mog_detail($id = NULL) {
        if (!empty($id)) {
            $data['sess'] = $this->authentication_root();
            $data['mog_status'] = $this->crud_model->read_fordata(array("select" => "mog_status", "table" => "mog", "where" => array("md5(mog_id)" => $id)))->row()->mog_status;
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
            $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"), "where" => array("md5(mog_id)" => $id, "mog_dt_status" => 1)))->result();
            $this->load->view("procurement/transaction/material/extend/mog_entry_detail", $data);
        }
    }

    public function get_mog($id = NULL) {
        if (!empty($id)) {
            $mog = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("md5(mog_id)" => $id), "join" => array("project p" => "p.project_id = mog.project_id", "actor a" => "a.actor_id = mog.actor_id")))->row();
            echo json_encode(array('status' => 1, 'mog' => $mog));
        }
    }

    public function save($id = NULL) {
        $data['sess'] = $this->authentication_root();

        $material_sub = array_filter($this->input->post('material'));
        $mog_dt_volume = array_filter($this->input->post('mog_dt_volume'));
        $mog_dt_price = $this->input->post('mog_dt_price') ? array_filter($this->input->post('mog_dt_price')) : NULL;
        $code = $this->input->post('code') ? array_filter($this->input->post('code')) : NULL;
        $mog_dt_note = $this->input->post('mog_dt_note') ? array_filter($this->input->post('mog_dt_note')) : NULL;
        $mog_dt_convertion = $this->input->post('mog_dt_convertion') ? array_filter($this->input->post('mog_dt_convertion')) : NULL;
        $mog_dt_status = $this->input->post('mog_dt_status');
        $mog_dt_date = NULL;
        $action = $this->input->post('action');
        if (!empty($id)) {
            $mog_dt_id = array_filter($this->input->post('mog_dt'));
        }

        $mog['transaction_ct_id'] = 1;
        $mog['users_id'] = $this->crud_model->read_fordata(array("table" => "users", "where" => array("md5(users_id)" => $data['sess']['users_id'])))->row()->users_id;
        $mog['project_id'] = $this->input->post("project");
        $mog['actor_id'] = $this->input->post("actor");
        $mog['mog_number'] = $this->input->post("mog_number");
        $mog['mog_number_letter'] = $this->input->post("mog_number_letter") ? $this->input->post("mog_number_letter") : NULL;
        $mog['mog_total'] = str_replace('.', '', $this->input->post("mog_total"));
        if (isset($mog)) {
            if (empty($id)) {
                $where_m['actor_id'] = $mog['actor_id'];
                $where_m['project_id'] = $mog['project_id'];
                $where_m['mog_number_letter'] = $mog['mog_number_letter'];
                
                $duplicate = $this->crud_model->read_fordata(array("table" => "mog", "where" => $where_m))->num_rows();
                if ($duplicate == 0) {
                    $mog['mog_status'] = 0;
                    $mog['mog_date'] = date('Y-m-d H:i:s');
                    if ($data['sess']['position_id'] == 1) {
                        $mog['mog_status'] = 1;
                        $mog['mog_date_verify'] = date('Y-m-d H:i:s');
                    }
                    $this->crud_model->insert_data("mog", $mog);
                    $actions = "tambah";
                    $mogid = $this->crud_model->read_data("mog")->last_row()->mog_id;
                } else {
                    echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><i class='fa fa-info-circle mg-r-md'></i> Data BAPB - Material Receipt failed saved</div>"));
                    exit();
                }
            } else {
                $transaction_entry = $this->crud_model->read_data("mog", array("md5(mog_id)" => $id))->row();
                $mog['mog_status'] = $mog_dt_price ? 1 : 0;
                $mog['mog_id'] = $transaction_entry->mog_id;
                $mog['mog_date_verify'] = date('Y-m-d H:i:s');

                $this->crud_model->update_data("mog", $mog, "mog_id");
                $actions = "edit";
                $mogid = $transaction_entry->mog_id;
                if ($data['sess']['position_id'] == 1) {
                    $diff_volume = array_filter($this->input->post('diff_volume'));
                    $status_volume = array_filter($this->input->post('status_volume'));
                }
            }
        }

        for ($in = 0; $in < count($material_sub); $in++) {
            if (isset($material_sub[$in]) || isset($mog_dt_volume[$in])) {
                $mog_dt[$action[$in]]['material_sub_id'] = $material_sub[$in];
                $mog_dt[$action[$in]]['mog_dt_volume'] = str_replace('.', '', $mog_dt_volume[$in]);
                $mog_dt[$action[$in]]['mog_dt_note'] = !empty($mog_dt_note[$in]) ? $mog_dt_note[$in] : NULL;
                $mog_dt[$action[$in]]['code_id'] = !empty($code) ? $code[$in] : NULL;
                $mog_dt[$action[$in]]['mog_dt_convertion'] = !empty($mog_dt_convertion[$in]) ? str_replace(",", ".", str_replace('.', '', $mog_dt_convertion[$in])) : 0;
                $mog_dt[$action[$in]]['mog_dt_status'] = isset($mog_dt_status[$in]) ? $mog_dt_status[$in] : 1;
                $mog_dt[$action[$in]]['mog_dt_price'] = !empty($mog_dt_price) ? str_replace('.', '', $mog_dt_price[$in]) : NULL;
                $mog_dt[$action[$in]]['mog_dt_date'] = date('Y-m-d H:i:s');
                if ($action[$in] == 'edit') {
                    if (isset($mog_dt_id[$in])) {
                        $mog_dt[$action[$in]]['mog_dt_id'] = $mog_dt_id[$in];
                        $this->crud_model->update_data('mog_dt', $mog_dt['edit'], 'mog_dt_id');
                    }
                } else if ($action[$in] == 'add') {
                    $mog_id = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("mog_number" => $mog['mog_number'], "mog_number_letter" => $mog['mog_number_letter'])))->row()->mog_id;
                    $mog_dt[$action[$in]]['mog_id'] = $mog_id;
                    $this->crud_model->insert_data('mog_dt', $mog_dt['add']);
                }

                if ($data['sess']['position_id'] == 1) {
                    $stock_final = $this->crud_model->read_fordata(array("table" => "stock_final", "where" => array("material_sub_id" => $material_sub[$in], "project_id" => $this->input->post("project"))));

                    if ($stock_final->num_rows() == 0) {
                        $stock_fn['insert']['project_id'] = $this->input->post("project");
                        $stock_fn['insert']['material_sub_id'] = $material_sub[$in];
                        $stock_fn['insert']['stock_final_date'] = date('Y-m-d H:i:s');
                        $stock_fn['insert']['stock_final_rest'] = str_replace('.', '', $mog_dt_volume[$in]);
                        $this->crud_model->insert_data("stock_final", $stock_fn['insert']);

                        $stock['stock_rest'] = $stock_fn['insert']['stock_final_rest'];
                    } else {
                        $row = $stock_final->row();

                        $stock_fn['update']['stock_final_id'] = $row->stock_final_id;
                        $stock_fn['update']['stock_final_date'] = date('Y-m-d H:i:s');
                        //jika admin edit data MOG
                        if ($data['sess']['position_id'] == 1 && $action[$in] == 'edit') {

                            if ($mog_dt[$action[$in]]['mog_dt_status'] == 0) {
                                $del_stock_fn['stock_final_id'] = $stock_fn['update']['stock_final_id'];
                                $del_stock_fn['stock_final_rest'] = $row->stock_final_rest - $mog_dt_volume[$in];
                                $this->crud_model->update_data("stock_final", $del_stock_fn, 'stock_final_id');

                                $del_stock['mog_id'] = $mog['mog_id'];
                                $del_stock['project_id'] = $this->input->post("project");
                                $del_stock['material_sub_id'] = $mog_dt[$action[$in]]['material_sub_id'];
                                $del_stock['stock_date'] = date('Y-m-d H:i:s');
                                $del_stock['stock_exit'] = str_replace('.', '', $mog_dt_volume[$in]);
                                $del_stock['stock_rest'] = $del_stock_fn['stock_final_rest'];

                                $this->crud_model->insert_data("stock", $del_stock);
                            }

                            if (isset($status_volume[$in])) {
                                if ($status_volume[$in] == 2) {
                                    $stock_fn['update']['stock_final_rest'] = str_replace('.', '', $diff_volume[$in]) + $row->stock_final_rest;
                                    //                                $this->crud_model->update_data("stock_final", $stock_fn['update'], 'stock_final_id');
                                } else if ($status_volume[$in] == 3) {
                                    $stock_fn['update']['stock_final_rest'] = str_replace('.', '', $row->stock_final_rest - $diff_volume[$in]);
                                }
                                $this->crud_model->update_data("stock_final", $stock_fn['update'], 'stock_final_id');
                            }
                        } else {
                            $stock_fn['update']['stock_final_rest'] = str_replace('.', '', $mog_dt_volume[$in]) + $row->stock_final_rest;
                            $this->crud_model->update_data("stock_final", $stock_fn['update'], 'stock_final_id');
                        }

                        $stock['stock_rest'] = isset($stock_fn['update']['stock_final_rest']) ? $stock_fn['update']['stock_final_rest'] : NULL;
                    }

                    if (!empty($id)) {
                        $stock['mog_id'] = $mog['mog_id'];
                        $stock['stock_date'] = date('Y-m-d');
                    } else {
                        $stock['mog_id'] = $mog_id;
                        $stock['stock_date'] = $mog['mog_date'];
                    }
                    $stock['project_id'] = $this->input->post("project");
//                    $stock['material_sub_id'] = $material_sub[$in];
                    $stock['material_sub_id'] = $mog_dt[$action[$in]]['material_sub_id'];
                    if ($data['sess']['position_id'] == 1 && $action[$in] == 'edit') {
                        if (isset($status_volume[$in]) && $status_volume[$in] == 2) {
                            $stock['stock_entry'] = str_replace('.', '', $diff_volume[$in]);
                        } else if (isset($status_volume[$in]) && $status_volume[$in] == 3) {
                            $stock['stock_exit'] = str_replace('.', '', $diff_volume[$in]);
                        }
                    } else {
                        $stock['stock_entry'] = str_replace('.', '', $mog_dt_volume[$in]);
                    }

                    if ($data['sess']['position_id'] == 1 && $action[$in] == 'edit') {
                        if (isset($status_volume[$in])) {
                            $this->crud_model->insert_data("stock", $stock);
                        }
                    } else {
                        $this->crud_model->insert_data("stock", $stock);
                    }
                }
            }
        }
        $this->session->set_flashdata("msgTransM", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Data BAPB - Material Receipt successfully saved</div>");
        echo json_encode(array('status' => 1, 'id' => md5($mogid)));
    }

    public function delete($id = NULL) {
        if(!empty($id)) {
            $get_mog = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("md5(mog_id)" => $id)))->row();
            $get_dt = $this->crud_model->read_fordata(array("table" => "mog_dt dt", "where" => array("md5(mog_id)" => $id)))->result();
            
            $data['mog_id'] = $get_mog->mog_id;
            
            foreach($get_dt as $dt){
                $stock_final = $this->crud_model->read_fordata(array("table" => "stock_final", "where" => array("project_id" => $get_mog->project_id, "material_sub_id" => $dt->material_sub_id)))->row();
                
                $stock_fn['stock_final_id'] = $stock_final->stock_final_id;
                if($get_mog->transaction_ct_id == 1) {
                    $stock_fn['stock_final_rest'] = $stock_final->stock_final_rest - $dt->mog_dt_volume;
                } else if($get_mog->transaction_ct_id == 2) {
                    $stock_fn['stock_final_rest'] = $stock_final->stock_final_rest + $dt->mog_dt_volume;
                }
                $this->crud_model->update_data("stock_final", $stock_fn, "stock_final_id");
                
                $get_stock = $this->crud_model->read_fordata(array("table" => "stock", "where" => array("project_id" => $get_mog->project_id, "material_sub_id" => $dt->material_sub_id)))->last_row();
                $stock['stock_rest'] = $stock_fn['stock_final_rest'];
                $stock['stock_id'] = $get_stock->stock_id;
                $this->crud_model->update_data("stock", $stock, "stock_id");
            }
            $this->crud_model->delete_data("stock", $data);
            $this->crud_model->delete_data("mog_dt", $data);
            $this->crud_model->delete_data("mog", $data);
            
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Equipment has been successfully removed</div>");
            echo json_encode(array("status" => 1));
        }
    }
    
    public function get_unit_material($id = NULL, $project = NULL) {
        $data = $this->crud_model->read_fordata(array("table" => "material_sub ms", "join" => array("material_unit mu" => "ms.material_unit_id = mu.material_unit_id"), "where" => array("material_sub_id" => $id)))->row();
        $stock_fn = $this->crud_model->read_fordata(array("table" => "stock_final", "where" => array("project_id" => $project, "material_sub_id" => $id)))->num_rows();
        echo json_encode(array('status' => 1, 'data' => $data, 'stock_fn' => $stock_fn));
    }
    
    public function getdata_suplier($id) {
        $data = $this->crud_model->read_data("actor", array("actor_id" => $id))->row();
        echo json_encode(array('status' => 1, 'data' => $data));
    }
    
    public function getdata_project($id, $ct, $table = NULL) {
        $table = !empty($table) ? $table : "mog";
        $column = !empty($table) ? $table . "_number" : "mog_number";
        $data = $this->crud_model->read_data("project", array("project_id" => $id))->row();
        $number = $this->crud_model->read_data("$table", array("project_id" => $id))->last_row();
        $number = isset($number->$column) ? $number->$column + 1 : 1;
        echo json_encode(array('status' => 1, 'data' => $data, 'number' => serial_number($number)));
    }

}

?>