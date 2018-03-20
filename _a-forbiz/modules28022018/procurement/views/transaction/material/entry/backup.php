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
        $this->load->model(array("crud_model"));
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

    public function tambah($id = null) {
        $data['sess'] = $this->authentication_root();
        $data['transaction_ct'] = "Tambah Data Pengajuan/Pengadaan Material";
        $data['url_action'] = $this->url . 'save/' . $id;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['active'] = empty($id)?$data['sess']['gotcurrent']->mod_menu_id:null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['url_access'] = $this->url;
        $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
        if ($data['sess']['position_id'] == 1) {
            if (!empty($id)) {
                $data['mog_id'] = $id;
            }
        }
        $data['idne'] ="";
        $data['row'] = "";
        if(!empty($id)){
            $data['row'] = $this->crud_model->read_fordata(array("table" => "procurement", "where" => array("id" => $id)))->row();
            $data['idne'] = $id;
        }
        $data['supplier'] = $this->origin_model->nasabah();
        $data['no_bapb'] = $this->crud_model->getLastNoBapb();
        $data['content'] = "procurement/transaction/material/entry/add";
        $this->load->view("../index", $data);
    }

    public function approve($id){
        $sess = $this->authentication_root();
        if($sess['users']->users_divisi == 11){
            $this->db->query("UPDATE procurement set role_id='12' where id='$id'");
        }elseif($sess['users']->users_divisi == 12){
            $this->db->query("UPDATE procurement set role_id='14' where id='$id'");
        }

        $this->recActivity("Melakukan Persetujuan Pengajuan oleh <b>".$sess['users']->users_username."</b>", "dashboard");

        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Pengajuan Berhasil Disetujui</div>");
            //echo json_encode(array("status" => 1));
            redirect('procurement/transaction/material');
    }

    public function reject($id){
        $id = $this->input->post('id');
        $komentar = date('d-m-Y h:i:s')."-".$this->input->post('komentar');
        $sess = $this->authentication_root();
           $this->db->query("UPDATE procurement set role_id='1', catatan='$komentar' where id='$id'");
        
        $this->recActivity("Melakukan Reject Pengajuan oleh <b>".$sess['users']->users_username."</b>", "dashboard");

        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Pengajuan Berhasil Disetujui</div>");
            //echo json_encode(array("status" => 1));
            redirect('procurement/transaction/material');
    }

    public function form($id = NULL) {
        
        $data['sess'] = $this->authentication_root();
        $sess = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        $data['mog_ex'] =$this->crud_model->listing($sess);
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




     public function filter($noPengajuan=null,$tglAwal=null,$tglAkhir=null) {
        $data['mog_ex'] =$this->crud_model->filterTabs($noPengajuan,$tglAwal,$tglAkhir);
        $this->load->view("procurement/transaction/material/entry/filter", $data);
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
        //if (!empty($id)) {
            $data['sess'] = $this->authentication_root();
            $data['mog_status'] = 1;
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
            /*$data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"), "where" => array("mog_dt_status" => 1)))->result();*/
            $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "procurement_detail md", "join" => array("mst_sumberdaya ms" => "ms.id = md.material_id"), "where" => array("procurement_id" => $id)))->result();
            $this->load->view("procurement/transaction/material/extend/mog_entry_detail", $data);
        //}
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
            $mog_dt_id = ($id);
        }

        //$mog['transaction_ct_id'] = 1;
        $mog['user_id'] = $this->crud_model->read_fordata(array("table" => "users", "where" => array("md5(users_id)" => $data['sess']['users_id'])))->row()->users_id;
        $mog['project_id'] = $this->input->post("project");
        $mog['jenis_procurement '] = $this->input->post("jenis");
        $mog['actor_id'] = $this->input->post("actor");
        $mog['tanggal_spb'] = date('Y-m-d',strtotime($this->input->post("tanggal")));
        $mog['no_bapb'] = $this->input->post("no_bapb") ? $this->input->post("no_bapb") : NULL;
        //$mog['mog_total'] = str_replace('.', '', $this->input->post("mog_total"));
        if (isset($mog)) {
            if(!empty($_FILES['spb_document']['name'])){
              $config['upload_path'] = FCPATH.'uploads/bapb_doc/';
              $config['allowed_types'] = '*';
              $config['max_filename'] = '255';
                    //$config['encrypt_name'] = TRUE;
              $mog['upload_file'] = $config['file_name']   = $mog['no_bapb']."_".preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['spb_document']['name']);
                    $config['max_size'] = '10024'; //10 MB
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('spb_document')) {
                        echo $this->upload->display_errors();
                    }

          }else{
            $mog['upload_file'] = "";
          }
            if (empty($id)) {
                $where_m['project_id'] = $mog['project_id'];
                $where_m['no_bapb'] = $mog['no_bapb'];
                
                $duplicate = $this->crud_model->read_fordata(array("table" => "procurement", "where" => $where_m))->num_rows();
                if ($duplicate == 0) {
                    $mog['role_id'] = 11;
                    //$mog['mog_date'] = date('Y-m-d H:i:s');
                    /*if ($data['sess']['position_id'] == 1) {
                        $mog['mog_status'] = 1;
                        $mog['mog_date_verify'] = date('Y-m-d H:i:s');
                    }*/
                    $this->crud_model->insert_data("procurement", $mog);
                    $actions = "tambah";
                    $mogid = $this->crud_model->read_data("procurement")->last_row()->id;
                } else {
                    echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><i class='fa fa-info-circle mg-r-md'></i> Data BAPB - Material Receipt failed saved</div>"));
                    exit();
                }
            } else {
                $transaction_entry = $this->crud_model->read_data("procurement", array("id" => $id))->row();
                /*$mog['mog_status'] = $mog_dt_price ? 1 : 0;
                $mog['mog_id'] = $transaction_entry->mog_id;
                $mog['mog_date_verify'] = date('Y-m-d H:i:s');*/
                $this->db->query("UPDATE `procurement` SET `user_id` = '".$mog['user_id']."',  `jenis_procurement` = '".$mog['jenis_procurement ']."', `supplier_id` = '".$mog['supplier_id']."', `tanggal_spb` = '".$mog['tanggal_spb']."',`upload_file` = '".$mog['upload_file']."', role_id='11' WHERE `id`='$id'");
                //$this->crud_model->update_data("procurement", $mog, 'id');
                $actions = "edit";
                $mogid = $transaction_entry->id;
                $project_id = $transaction_entry->project_id;
                /*if ($data['sess']['position_id'] == 1) {
                    $diff_volume = array_filter($this->input->post('diff_volume'));
                    $status_volume = array_filter($this->input->post('status_volume'));
                }*/
            }
        }

        for ($in = 0; $in < count($material_sub); $in++) {
            if (isset($material_sub[$in]) || isset($mog_dt_volume[$in])) {
                $mog_dt[$action[$in]]['procurement_id'] = $mogid;
                $mog_dt[$action[$in]]['material_id'] = $material_sub[$in];
                $mog_dt[$action[$in]]['volume'] = str_replace('.', '', $mog_dt_volume[$in]);
                $mog_dt[$action[$in]]['keterangan'] = !empty($mog_dt_note[$in]) ? $mog_dt_note[$in] : NULL;
               // $mog_dt[$action[$in]]['code_id'] = !empty($code) ? $code[$in] : NULL;
                //$mog_dt[$action[$in]]['mog_dt_convertion'] = !empty($mog_dt_convertion[$in]) ? str_replace(",", ".", str_replace('.', '', $mog_dt_convertion[$in])) : 0;
                //$mog_dt[$action[$in]]['mog_dt_status'] = isset($mog_dt_status[$in]) ? $mog_dt_status[$in] : 1;
                $mog_dt[$action[$in]]['price'] = !empty($mog_dt_price) ? str_replace('.', '', $mog_dt_price[$in]) : NULL;
                //$mog_dt[$action[$in]]['mog_dt_date'] = date('Y-m-d H:i:s');
                if ($action[$in] == 'edit') {
                    $this->db->query("DELETE FROM procurement_detail WHERE procurement_id='$mogid'");
                    /*if (isset($mog_dt_id[$in])) {
                        $mog_dt[$action[$in]]['procurement_id'] = $mog_dt_id[$in];
                        $this->crud_model->update_data('procurement_detail', $mog_dt['edit'], 'id');
                    }*/
                    $this->crud_model->insert_data('procurement_detail', $mog_dt['edit']);
                } else if ($action[$in] == 'add') {
                    /*$mog_id = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("mog_number" => $mog['mog_number'], "mog_number_letter" => $mog['mog_number_letter'])))->row()->mog_id;
                    $mog_dt[$action[$in]]['mog_id'] = $mog_id;*/
                    //$this->crud_model->insert_data('mog_dt', $mog_dt['add']);
                    $this->crud_model->insert_data('procurement_detail', $mog_dt['add']);
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
                        $stock['mog_id'] = $mogid;
                        $stock['stock_date'] = date('Y-m-d');
                    }
                    $stock['project_id'] = $this->input->post("project");
//                    $stock['material_sub_id'] = $material_sub[$in];
                    $stock['material_sub_id'] = $mog_dt[$action[$in]]['material_id'];
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
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Data Pengajuan / Pengadaan successfully saved</div>");
        echo json_encode(array('status' => 1, 'id' => md5($mogid)));
        redirect('procurement/transaction/material');
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
        /*$data = $this->crud_model->read_fordata(array("table" => "material_sub ms", "join" => array("material_unit mu" => "ms.material_unit_id = mu.material_unit_id"), "where" => array("material_sub_id" => $id)))->row();
        $stock_fn = $this->crud_model->read_fordata(array("table" => "stock_final", "where" => array("project_id" => $project, "material_sub_id" => $id)))->num_rows();*/
        $data = $this->crud_model->read_fordata(array("table" => "mst_sumberdaya ms", "where" => array("id" => $id)))->row();
        $stock_fn = $this->crud_model->read_fordata(array("table" => "stock_final", "where" => array("project_id" => $project, "material_sub_id" => $id)))->num_rows();
        echo json_encode(array('status' => 1, 'data' => $data, 'stock_fn' => $stock_fn));
    }
    
    public function getdata_suplier($id) {
        $data = $this->crud_model->read_data("mst_nasabah_konstruksi", array("id" => $id))->row();
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

    public function delete_procurement($id = NULL) {

        if(!empty($id)) {
            $this->db->query("DELETE procurement_detail
                FROM procurement_detail
                INNER JOIN procurement 
                  ON procurement.id = procurement_detail.procurement_id

                WHERE procurement.project_id = '$id'");
           
            $this->db->query("DELETE 
                FROM  procurement 
                WHERE procurement.project_id = '$id'");

            $data['id'] = $id;
            $this->crud_model->delete_data("procurement", $data);
            
            
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Pengajuan has been successfully removed</div>");
            //echo json_encode(array("status" => 1));
            redirect('procurement/transaction/material');
        }
    }

}

?>