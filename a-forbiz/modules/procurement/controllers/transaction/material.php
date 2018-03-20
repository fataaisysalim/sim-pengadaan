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
        $this->load->library('wika_email');
    }

    function load_lib($n, $f = null) {
        return extension_loaded($n) or dl(((PHP_SHLIB_SUFFIX === 'dll') ? 'php_' : '') . ($f ? $f : $n) . '.' . PHP_SHLIB_SUFFIX);
    }

    public function index($view=null, $id = null) {
        $headers = 'From: no-reply@wikagedung.co.id' . "\r\n" .
            'Reply-To: no-reply@wikagedung.co.id' . "\r\n" .
            "MIME-Version: 1.0" . "\r\n" . 
            "Content-type: text/html; charset=UTF-8" . "\r\n".
            'X-Mailer: PHP/' . phpversion();
         //$this->gmc_send_sms(19);die();
        //mail("rajawali.king@gmail.com", "test", "test", $headers);
       //ini_get( FCPATH.'z-source/application/libraries/php.ini');
        //echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";die();
      // $this->load_lib('openssl');
        //$this->wika_email->send_email_transaction("SUBMITTED", 16, 13);
       // $this->wika_email->phpmailer();
        
        $data['sess'] = $this->authentication_root();
        $data['active'] = empty($id)?$data['sess']['gotcurrent']->mod_menu_id:null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['url_access'] = $this->url;
        $data['view'] = $view;
        if ($data['sess']['position_id'] == 1) {
            if (!empty($id)) {
                $data['mog_id'] = $id;
            }
        }
        $data['content'] = "procurement/transaction/material/entry/index";
        $this->load->view("../index", $data);
    }

    public function form($view=null,$id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['dtx'] = $this->authentication_root();
        $sess = $this->authentication_root();
        //$data['mog_ex'] =$this->crud_model->listing($sess);
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['transaction_ct'] = "Monitoring Pengajuan/Pengadaan Material";
        $data['url_access'] = "$this->url";
        $data['url_action'] = $this->url . 'save/' . $id;
        /*print_r($data['sess']['users']->users_divisi);
        die();*/
        /*if ($data['sess']['position_id'] == 5) {
            $data['mog'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("mog.mog_status" => 0),"join"=>array("actor a"=>"a.actor_id = mog.actor_id","project p"=>"p.project_id = mog.project_id")))->result();
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
        } else*/ 
		
		if ($data['sess']['users']->users_divisi <> 1) {
            if (!empty($id)) {
                $data['mog_id'] = $id;
                $data['supplier'] = $this->origin_model->actor(1);
                $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
                $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
                $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog", "join" => array("project p" => "p.project_id = mog.project_id", "actor a" => "a.actor_id = mog.actor_id"), "where" => array("md5(mog_id)" => $id)))->row();
            } else {
                if(!empty($view)){
                    $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog","join"=>array("project p"=>"p.project_id = mog.project_id")))->result();
                }else{
                    if ($data['sess']['users']->users_divisi == 19) {
                    $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("role_id"=>$sess['users']->users_divisi),"or_where"=> array('role_id'=>100),"join"=>array("project p"=>"p.project_id = mog.project_id"),"order" => array("mog.mog_id"=>"desc")))->result();    
                    }else{
						if ($data['sess']['users']->users_divisi == 13){
						$data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("role_id"=>$sess['users']->users_divisi),"join"=>array("project p"=>"p.project_id = mog.project_id"),"order" => array("mog.mog_id"=>"desc")))->result();	
						}else{
                        $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("role_id"=>$sess['users']->users_divisi),"join"=>array("project p"=>"p.project_id = mog.project_id"),"order" => array("mog.mog_id"=>"desc")))->result();
						}
                    }
                }
                
                $data['supplier'] = $this->origin_model->actor(1);
                $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
                $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
            }
        }else{
            $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog","join"=>array("project p"=>"p.project_id = mog.project_id"), "order" => array("mog.mog_id" => "DESC")))->result();
		    $data['supplier'] = $this->origin_model->actor(1);
			$data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
			$data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
        }
        $data['material_sub'] = $this->crud_model->read_fordata(array("table" => "material_sub", "where" => array("material_sub_status" => 1)))->result();

        $this->load->view("procurement/transaction/material/entry/material_entry_form", $data);
    }

    public function autosupplier($term=null){
        $q = strtolower($_GET['term']);
        $this->db->select('*');
        $this->db->like('actor_name', $q);
        $query = $this->db->get('actor');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            //$new_row['label']=htmlentities(stripslashes($row['actor_id']));
            $new_row['value']=htmlentities(stripslashes($row['actor_name']));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    public function automaterial($term=null){
        $q = strtolower($_GET['term']);
        $this->db->select('*');
        $this->db->like('material_sub_name', $q);
        $query = $this->db->get('material_sub');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            //$new_row['label']=htmlentities(stripslashes($row['actor_id']));
            $new_row['value']=htmlentities(stripslashes($row['material_sub_name']));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    public function tambah($id = null, $aksi=null) {
        $data['sess'] = $this->authentication_root();
        if($data['sess']['users']->users_divisi == 16){
            $data['transaction_ct'] = "Verifikasi Pengajuan/Pengadaan Material";
        }else{
            $data['transaction_ct'] = "Tambah Data Pengajuan Material";    
        }
        
        $data['url_action'] = $this->url . 'save/' . $id;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['active'] = empty($id)?$data['sess']['gotcurrent']->mod_menu_id:null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['aksi'] = $aksi;
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
            $data['row'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("mog_id" => $id)))->row();
            $data['idne'] = $id;
			$data['role_id'] = $this->crud_model->read_fordata(array("select" => "role_id", "table" => "mog", "where" => array("mog_id" => $id)))->row()->role_id;
        } else {
			$data['role_id'] = 0;
		}
		$list_supplier = $this->db->select("actor_id, actor_name")->get("actor")->result_array();
        $data['supplier'] = $this->origin_model->nasabah();
        $data['no_bapb'] = $this->crud_model->getLastNoBapb();
        $data['nomor_pengajuan'] = $this->crud_model->getLastNoPengajuan();
        $data['content'] = "procurement/transaction/material/entry/add";
        $this->load->view("../index", $data);
    }
	
    public function ajax_by_id_supplier(){
        $supplier = $this->input->post('supplier');

        $query = $this->db->get_where('mog', array('actor_id' => $supplier, 'jenis_procurement' => 'pengadaan'));
		echo options($query, 'no_kontrak', '', 'no_kontrak');
    }
	
    public function ajax_get_total_pengajuan(){
        $no_kontrak = $this->input->post('no_kontrak');
        $budget     = $this->crud_model->get_budget_amount($no_kontrak); 
        $total      = $this->crud_model->get_total_pengajuan($no_kontrak);
        
        echo $budget->budget_amount.'#'.$total->total_pengajuan;
    }

    public function add_pengadaan($id = null, $aksi=null) {
        $data['sess'] = $this->authentication_root();
        if($data['sess']['users']->users_divisi == 16){
            $data['transaction_ct'] = "Verifikasi Pengajuan/Pengadaan Material";
        }else{
            $data['transaction_ct'] = "Tambah Data Pengadaan Material";    
        }
        
        $data['url_action'] = $this->url . 'save/' . $id;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['active'] = empty($id)?$data['sess']['gotcurrent']->mod_menu_id:null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['aksi'] = $aksi;
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
            $data['row'] = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("mog_id" => $id)))->row();
            $data['idne'] = $id;
            $data['role_id'] = $this->crud_model->read_fordata(array("select" => "role_id", "table" => "mog", "where" => array("mog_id" => $id)))->row()->role_id;
        } else {
            $data['role_id'] = 0;
        }
        $list_supplier = $this->db->select("actor_id, actor_name")->get("actor")->result_array();
        $data['supplier'] = $this->origin_model->nasabah();
        $data['no_bapb'] = $this->crud_model->getLastNoBapb();
        $data['nomor_pengajuan'] = $this->crud_model->getLastNoPengajuan();
        $data['content'] = "procurement/transaction/material/entry/add_pengadaan";
        $this->load->view("../index", $data);
    }

    public function approve($jenis_procurement){
        //print_r($_POST);die()
		$data['sess'] = $this->authentication_root();
        $sess = $this->authentication_root();
        $id = $this->input->post('mog_id');
        $no_spb = $this->input->post('no_spb');
        $no_bapb = $this->input->post('no_bapb');
		$actor = $this->input->post('actor');
		$no_surat_jalan = $this->input->post('no_surat_jalan');

        $tgl_pengiriman = date('Y-m-d',strtotime($this->input->post("tanggal_kirim")));
		//$tgl_pengiriman = $this->input->post('tanggal_kirim');
		$jenis = $jenis_procurement;
		//$jenis = $this->input->post('jenis_procurement');
		$mog_total = (int)str_replace('.', '', $this->input->post("mog_total"));
        if(!empty($_FILES['surat_jalan_document']['name'])){
              $config['upload_path'] = FCPATH.'uploads/surat_jalan_document/';
              $config['allowed_types'] = '*';
              $config['max_filename'] = '255';
                    //$config['encrypt_name'] = TRUE;
              $upload_file = $config['file_name']   = $mog['no_bapb']."_".preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['spb_document']['name']);
                    $config['max_size'] = '10024'; //10 MB
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('surat_jalan_document')) {
                        echo $this->upload->display_errors();
                    }

              }else{
                $upload_file = "";
              }
	  
        $no_bapb = $this->crud_model->getLastNoBapb();
		$no_spb = $this->crud_model->getLastNoSpb();

        //cek no spb udah ada apa blom cuy
        $cek_spb = $this->crud_model->read_data("mog", array("mog_id" => $id))->row();

        if($jenis==="pengajuan"){
            if($sess['users']->users_divisi == 11){
                //echo $sess['users']->users_divisi;die();
                $this->db->query("UPDATE mog set role_id='12', tujuan='Approval MP  ' where mog_id='$id'");
                $this->recCountActivityRole(12);
                $this->wika_email->send_email_transaction("APPROVED", 12, $id);
                $this->nexmo_sms(12);
                ////supplier
            }elseif($sess['users']->users_divisi == 12){
                // $this->db->query("UPDATE mog set role_id='16', tujuan='Verifikasi Pengajuan' where mog_id='$id'");
                // $this->recCountActivityRole(16);
                // $this->wika_email->send_email_transaction("APPROVED", 16, $id);
				$this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier' where mog_id='$id'");
                $this->recCountActivityRole(18);
                $this->wika_email->send_email_transaction("APPROVED", 18, $id);
                $this->nexmo_sms(18);
            }elseif($sess['users']->users_divisi == 16){
					$this->db->query("UPDATE mog set role_id='13', tujuan='Approval M.DAN' where mog_id='$id'");
					$this->recCountActivityRole(13);
					$this->wika_email->send_email_transaction("APPROVED", 13, $id);
                    $this->nexmo_sms(13);
            }elseif($sess['users']->users_divisi == 13){
				if($mog_total<=500000000){
                    if(!empty($cek_spb->no_spb)){
                        $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier' where mog_id='$id'");
                    }else{
                        $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier', no_spb='$no_spb' where mog_id='$id'");
                    }
                    
					$this->recCountActivityRole(18);
					$this->wika_email->send_email_transaction("APPROVED", 18, $id);
                    $this->nexmo_sms(18);
				}else{
					$this->db->query("UPDATE mog set role_id='7', tujuan='Approval M.DIV' where mog_id='$id'");
					$this->recCountActivityRole(7);
					$this->wika_email->send_email_transaction("APPROVED", 7, $id);
                    $this->nexmo_sms(7);
				}
            }elseif($sess['users']->users_divisi == 7){
				if($mog_total>500000000 and $mog_total <=1000000000){
                    if(!empty($cek_spb->no_spb)){
    					$this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier' where mog_id='$id'");
                    }else{
                        $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier', no_spb='$no_spb' where mog_id='$id'");
                    }
					$this->recCountActivityRole(18);
					$this->wika_email->send_email_transaction("APPROVED", 18, $id);
                    $this->nexmo_sms(18);
				}else{
					$this->db->query("UPDATE mog set role_id='10', tujuan='Approval Direksi' where mog_id='$id'");
					$this->recCountActivityRole(10);
					$this->wika_email->send_email_transaction("APPROVED", 10, $id);
                    $this->nexmo_sms(10);
				}
            }
			elseif($sess['users']->users_divisi == 10){
                if(!empty($cek_spb->no_spb)){
                    $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier' where mog_id='$id'");
                }else{
                    $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier',no_spb='$no_spb' where mog_id='$id'");
                }
                $this->recCountActivityRole(18);
                $this->wika_email->send_email_transaction("APPROVED", 18, $id);
                $this->nexmo_sms(18);
            }
			elseif($sess['users']->users_divisi == 18){
                $this->db->query("UPDATE mog set role_id='17', tujuan='Approval Gudang (Penerimaan Barang)' where mog_id='$id'");
                $this->recCountActivityRole(17);
                $this->wika_email->send_email_transaction("APPROVED", 17, $id);
                $this->nexmo_sms(17);
                //staff gudang
            }elseif($sess['users']->users_divisi == 17){
                $this->db->query("UPDATE mog set role_id='15', tujuan='Approval QC', upload_file_surat_jalan='$upload_file' where mog_id='$id'");
                $this->recCountActivityRole(15);
                $this->wika_email->send_email_transaction("APPROVED", 15, $id);
                $this->nexmo_sms(15);
                //QC
            }elseif($sess['users']->users_divisi == 15){
                $this->db->query("UPDATE mog set role_id='20', tujuan='Approval KASI KA' where mog_id='$id'");
                $this->recCountActivityRole(20);
                $this->wika_email->send_email_transaction("APPROVED", 20, $id);
                $this->nexmo_sms(20);
                //KASI KA
            }elseif($sess['users']->users_divisi == 20){
                $this->db->query("UPDATE mog set role_id='19', tujuan='Approval KSPP' where mog_id='$id'");
                $this->recCountActivityRole(19);
                $this->wika_email->send_email_transaction("APPROVED", 19, $id);
                $this->nexmo_sms(19);

            }elseif($sess['users']->users_divisi == 19){
                $this->db->query("UPDATE mog set mog_status='1', no_bapb='$no_bapb', role_id='100', tujuan='Approved By KSPP' where mog_id='$id'");
            }
        }elseif($jenis==="pengadaan"){
            if($sess['users']->users_divisi == 11){
                //echo $sess['users']->users_divisi;die();
                $this->db->query("UPDATE mog set role_id='12', tujuan='Approval MP  ' where mog_id='$id'");
                $this->recCountActivityRole(12);
                $this->wika_email->send_email_transaction("APPROVED", 12, $id);
                $this->nexmo_sms(12);
                ////supplier
            }elseif($sess['users']->users_divisi == 12){
                // $this->db->query("UPDATE mog set role_id='16', tujuan='Verifikasi Pengajuan' where mog_id='$id'");
                // $this->recCountActivityRole(16);
                // $this->wika_email->send_email_transaction("APPROVED", 16, $id);
                if(!empty($cek_spb->no_spb)){
    				$this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier' where mog_id='$id'");
                }else{
                    $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier', no_spb='$no_spb' where mog_id='$id'");    
                }
                $this->recCountActivityRole(18);
                $this->wika_email->send_email_transaction("APPROVED", 18, $id);
                $this->nexmo_sms(18);
            }elseif($sess['users']->users_divisi == 16){
					$this->db->query("UPDATE mog set role_id='13', tujuan='Approval M.DAN' where mog_id='$id'");
					$this->recCountActivityRole(13);
					$this->wika_email->send_email_transaction("APPROVED", 13, $id);
                    $this->nexmo_sms(13);
            }elseif($sess['users']->users_divisi == 13){
				if($mog_total<=500000000){
                    if(!empty($cek_spb->no_spb)){
					   $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier' where mog_id='$id'");
                    }else{
                        $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier', no_spb='$no_spb' where mog_id='$id'");
                    }
					$this->recCountActivityRole(18);
					$this->wika_email->send_email_transaction("APPROVED", 18, $id);
                    $this->nexmo_sms(18);
				}else{
					$this->db->query("UPDATE mog set role_id='7', tujuan='Approval M.DIV' where mog_id='$id'");
					$this->recCountActivityRole(7);
					$this->wika_email->send_email_transaction("APPROVED", 7, $id);
                    $this->nexmo_sms(7);
				}
            }elseif($sess['users']->users_divisi == 7){
				if($mog_total>500000000 and $mog_total <=1000000000){
                    if(!empty($cek_spb->no_spb)){
					   $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier' where mog_id='$id'");
                    }else{
                      $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier', no_spb='$no_spb' where mog_id='$id'");
                    }
					$this->recCountActivityRole(18);
					$this->wika_email->send_email_transaction("APPROVED", 18, $id);
                    $this->nexmo_sms(18);
				}else{
					$this->db->query("UPDATE mog set role_id='10', tujuan='Approval Direksi' where mog_id='$id'");
					$this->recCountActivityRole(10);
					$this->wika_email->send_email_transaction("APPROVED", 10, $id);
                    $this->nexmo_sms(10);
				}
            }
			elseif($sess['users']->users_divisi == 10){
                if(!empty($cek_spb->no_spb)){
                    $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier' where mog_id='$id'");
                }else{
                    $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier', no_spb='$no_spb' where mog_id='$id'");
                }
                $this->recCountActivityRole(18);
                $this->wika_email->send_email_transaction("APPROVED", 18, $id);
                $this->nexmo_sms(18);
            }
			elseif($sess['users']->users_divisi == 18){
                $this->db->query("UPDATE mog set role_id='17', tujuan='Approval Gudang (Penerimaan Barang)', no_spb='$no_spb' where mog_id='$id'");
                $this->recCountActivityRole(17);
                $this->wika_email->send_email_transaction("APPROVED", 17, $id);
                $this->nexmo_sms(17);
                //staff gudang
            }elseif($sess['users']->users_divisi == 17){
                $this->db->query("UPDATE mog set role_id='15', tujuan='Approval QC', upload_file_surat_jalan='$upload_file' where mog_id='$id'");
                $this->recCountActivityRole(15);
                $this->wika_email->send_email_transaction("APPROVED", 15, $id);
                $this->nexmo_sms(15);
                //QC
            }elseif($sess['users']->users_divisi == 15){
                $this->db->query("UPDATE mog set role_id='20', tujuan='Approval KASI KA' where mog_id='$id'");
                $this->recCountActivityRole(20);
                $this->wika_email->send_email_transaction("APPROVED", 20, $id);
                $this->nexmo_sms(20);
                //KASI KA
            }elseif($sess['users']->users_divisi == 20){
                $this->db->query("UPDATE mog set role_id='19', tujuan='Approval KSPP' where mog_id='$id'");
                $this->recCountActivityRole(19);
                $this->wika_email->send_email_transaction("APPROVED", 19, $id);
                $this->nexmo_sms(19);

            }elseif($sess['users']->users_divisi == 19){
                $this->db->query("UPDATE mog set mog_status='1', no_bapb='$no_bapb', role_id='100', tujuan='Approved By KSPP' where mog_id='$id'");
            }
        }    
        
        $material_sub = $this->input->post('material');
        $mog_dt_volume = $this->input->post('mog_dt_volume');
        $mog_dt_price = $this->input->post('mog_dt_price') ? $this->input->post('mog_dt_price') : NULL;
        $code = $this->input->post('uraian') ? $this->input->post('uraian') : NULL;
        $mog_dt_note = $this->input->post('mog_dt_note') ? $this->input->post('mog_dt_note') : NULL;
        $mog_dt_convertion = $this->input->post('mog_dt_convertion') ? $this->input->post('mog_dt_convertion') : NULL;
        $mog_dt_status = $this->input->post('mog_dt_status');
        $mog_dt_date = NULL;
        $action = $this->input->post('action');
         if (!empty($id)) {
            $mog_dt_id = $this->input->post('mog_dt');
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
                }

                if ($data['sess']['position_id'] == 1 || $data['sess']['position_id'] == 11) {
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
						//$transaction_entry = $this->crud_model->read_data("mog", array("md5(mog_id)" => $id))->row();
						//var_dump($id);
						// hardcode
						$mog['mog_id'] = 20;
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

                    if (($data['sess']['position_id'] == 1 || $data['sess']['position_id'] == 11) && $action[$in] == 'edit') {
                        if (isset($status_volume[$in])) {
                            $this->crud_model->insert_data("stock", $stock);
                        }
                    } else {
                        $this->crud_model->insert_data("stock", $stock);
                    }
                }
            }
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
           $this->db->query("UPDATE mog set role_id='1', catatan='$komentar', mog_status='2', tujuan='' where mog_id='$id'");
        
        $this->recActivity("Melakukan Reject Pengajuan oleh <b>".$sess['users']->users_username."</b>", "dashboard");

        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Pengajuan Berhasil Disetujui</div>");
            //echo json_encode(array("status" => 1));
            redirect('procurement/transaction/material');
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

    public function get_mog_detail($id = NULL, $aksi=NULL) {
        if (!empty($id)) {
            $data['aksi'] = $aksi;
            $data['sess'] = $this->authentication_root();
            $data['mog_status'] = $this->crud_model->read_fordata(array("select" => "mog_status", "table" => "mog", "where" => array("mog_id" => $id)))->row()->mog_status;
			$data['role_id'] = $this->crud_model->read_fordata(array("select" => "role_id", "table" => "mog", "where" => array("mog_id" => $id)))->row()->role_id;
            $data['code'] = $this->crud_model->read_fordata(array("table" => "code", "where" => array("code_ct_id" => 1, "code_status" => 1)))->result();
            $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"), "where" => array("mog_id" => $id, "mog_dt_status" => 1)))->result();
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
        $material_sub = $this->input->post('material');
        $mog_dt_volume = $this->input->post('mog_dt_volume');
        $mog_dt_price = $this->input->post('mog_dt_price') ? $this->input->post('mog_dt_price') : NULL;
        $code = $this->input->post('uraian') ? $this->input->post('uraian') : NULL;
        $mog_dt_note = $this->input->post('mog_dt_note') ? $this->input->post('mog_dt_note') : NULL;
        $mog_dt_convertion = $this->input->post('mog_dt_convertion') ? $this->input->post('mog_dt_convertion') : NULL;
        $mog_dt_status = $this->input->post('mog_dt_status');
        $mog_dt_date = NULL;
        $action = $this->input->post('action');

        if (!empty($id)) {
            $mog_dt_id = $this->input->post('mog_dt');
        }
        $mog['transaction_ct_id'] = 1;
        $mog['users_id'] = $this->crud_model->read_fordata(array("table" => "users", "where" => array("md5(users_id)" => $data['sess']['users_id'])))->row()->users_id;
        $mog['project_id'] = $this->input->post("project");
        $mog['actor_id'] = $this->input->post("actor");
        $mog['no_spb'] = $this->input->post("no_spb") ? $this->input->post("no_spb") : NULL;
        $mog['pph'] = $this->input->post("pph");
        $mog['tanggal_kirim'] = date('Y-m-d',strtotime($this->input->post("tanggal_kirim")));
        $mog['nomor_pengajuan'] = $this->input->post("nomor_pengajuan") ? $this->input->post("nomor_pengajuan") : NULL;
        $mog['tanggal_spb'] = date('Y-m-d',strtotime($this->input->post("tanggal")));
        $mog['no_bapb'] = $this->input->post("no_bapb") ? $this->input->post("no_bapb") : NULL;
        $mog['jenis_procurement'] = $this->input->post("jenis");
        $mog['mog_total'] = str_replace('.', '', $this->input->post("mog_total"));
		$mog['no_kontrak'] = $this->input->post("no_kontrak");
		
        if (isset($mog)) {
             if(!empty($_FILES['spb_document']['name'])){
              $config['upload_path'] = FCPATH.'uploads/bapb_doc/';
              $config['allowed_types'] = '*';
              $config['max_filename'] = '255';
                    //$config['encrypt_name'] = TRUE;
              $mog['upload_file'] = $config['file_name']   = preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['spb_document']['name']);
                    $config['max_size'] = '10024'; //10 MB
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('spb_document')) {
                        echo $this->upload->display_errors();
                    }

              }else{
                $mog['upload_file'] = "";
              }
            if (empty($id)) {
                $where_m['actor_id'] = $mog['actor_id'];
                $where_m['project_id'] = $mog['project_id'];
                //$where_m['mog_number_letter'] = $mog['mog_number_letter'];
                
                $duplicate = $this->crud_model->read_fordata(array("table" => "mog", "where" => $where_m))->num_rows();
                //if ($duplicate == 0) {
				/* BACKUP ROLE & TUJUAN BY FATA	
                if($mog['jenis_procurement']=="pengajuan"){
                    $mog['role_id'] = 16;
                    $mog['tujuan'] = "Verifikasi Pengajuan";
                }else{
                    $mog['role_id'] = 11;
                    $mog['tujuan'] = "Approval KSPP";
                }
                */  
				if($mog['jenis_procurement']=="pengajuan"){
                    $mog['role_id'] = 16;
                    $mog['tujuan'] = "Verifikasi Pengajuan";
                }else{
					if($data['sess']["users"]->users_jenis=='Pusat'){
						$mog['role_id'] = 16;
						$mog['tujuan'] = "Verifikasi Pengajuan";  
					}else{
						$mog['role_id'] = 11;
						$mog['tujuan'] = "Approval KSPP";
					}
                }
                    $mog['mog_status'] = 0;
                    $mog['mog_date'] = date('Y-m-d H:i:s');
                    if ($data['sess']['position_id'] == 1) {
                        //$mog['mog_status'] = 1;
                        $mog['mog_date_verify'] = date('Y-m-d H:i:s');
                    }
                    $this->crud_model->insert_data("mog", $mog);
                    $actions = "tambah";
                    $mogid = $this->crud_model->read_data("mog")->last_row()->mog_id;
                    $this->recCountActivityRole($mog['role_id']);
                /*} else {
                    echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button><i class='fa fa-info-circle mg-r-md'></i> Data Pengajuan/Pengadaan - Material failed saved</div>"));
                    exit();
                }*/
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
                    $mog_id = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("nomor_pengajuan" => $mog['nomor_pengajuan'])))->row()->mog_id;
                    $mog_dt[$action[$in]]['mog_id'] = $mogid;
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
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Data Pengajuan/Pengadaan - Material  successfully saved</div>");
        echo json_encode(array('status' => 1, 'id' => md5($mogid)));
         $this->wika_email->send_email_transaction("SUBMITTED", $mog['role_id'], $mogid);
         $this->nexmo_sms($mog['role_id']);
        // $this->gmc_send_sms($mog['role_id']);
        redirect('procurement/transaction/material');
    }

    function nexmo_sms($bagian_id){
        $this->load->library('nexmo');
        // set response format: xml or json, default json
        $this->nexmo->set_format('json');
        
        if (!$member = $this->crud_model->read_fordata(array("table" => "users",
            "join"=>array("employee p"=>"p.employee_id = users.employee_id"),
            "where" => array("users.users_divisi"=>$bagian_id)
            ))->row()) return false;
        //echo $member->employee_phone;die();     
        // **********************************Text Message*************************************
        $from = 'WG';
        $to = $member->employee_phone;
        $message = array(
            'text' => 'Notifikasi Persetujuan - Proyek Wika Gedung',
        );
        $response = $this->nexmo->send_message($from, $to, $message);
       /* echo "<h1>Text Message</h1>";
        $this->nexmo->d_print($response);
        echo "<h3>Response Code: ".$this->nexmo->get_http_status()."</h3>";*/
        
    }

    public function filter() {
        $noPengajuan = $this->input->post('noPengajuan');
        $tglAwal = $this->input->post('tglAwal');
        $tglAkhir = $this->input->post('tglAkhir');
        $jenis = $this->input->post('jenis');
        $supplier= $this->input->post('supplier');
        $jenis_material= $this->input->post('jenis_material');
        $volume= $this->input->post('volume');
        $operator= $this->input->post('operator');
		$id = $this->input->post('id');
        $data['jenis_procurement'] = $jenis;
        $data['sess'] = $this->authentication_root();
        $data['mog_dt'] =$this->crud_model->filterTabs($noPengajuan, $tglAwal, $tglAkhir, $jenis, $supplier, $jenis_material, $volume, $operator, $id);
       /* $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog",
            "join"=>array("project p"=>"p.project_id = mog.project_id")))->result();*/
        $this->load->view("procurement/transaction/material/entry/filter", $data);
    }
	
	
	public function reqEdit($idMog) {
        $this->db->query("UPDATE mog set stat_edit='0' where mog_id='$idMog'");
        $this->wika_email->send_email_transaction("APPROVED EDIT", 20, $idMog);
        $this->nexmo_sms(20);
		echo json_encode(array("status" => 1));
    }
	
	public function appEdit($idMog) {
        $this->db->query("UPDATE mog set stat_edit='1' where mog_id='$idMog'");
		echo json_encode(array("status" => 1));
    }
	
	public function reqDelete($idMog) {
        $this->db->query("UPDATE mog set stat_del='0' where mog_id='$idMog'");
        $this->wika_email->send_email_transaction("APPROVED DELETE", 20, $idMog);
        $this->nexmo_sms(20);
		echo json_encode(array("status" => 1));
    }
	
	public function appDelete($idMog) {
        $this->db->query("UPDATE mog set stat_del='1' where mog_id='$idMog'");
		echo json_encode(array("status" => 1));
    }

    public function delete($id = NULL) {
        if(!empty($id)) {
            $get_mog = $this->crud_model->read_fordata(array("table" => "mog", "where" => array("mog_id" => $id)))->row();
            $get_dt = $this->crud_model->read_fordata(array("table" => "mog_dt dt", "where" => array("mog_id" => $id)))->result();
            
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
            
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Data Pengajuan/Pengadaan has been successfully removed</div>");
            echo json_encode(array("status" => 1));
            redirect('procurement/transaction/material');
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

    public function cetak($id = null, $aksi=null) {
        $data['sess'] = $this->authentication_root();
        $data['transaction_ct'] = "Cetak Pengajuan/Pengadaan Material";
        $data['url_action'] = $this->url . 'save/' . $id;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['active'] = empty($id)?$data['sess']['gotcurrent']->mod_menu_id:null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['aksi'] = $aksi;
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
            $data['row'] = $this->crud_model->read_fordata(array("table" => "mog", 
                "join" => array("project pa" => "pa.project_id = mog.project_id"),
                "where" => array(
                        "mog_id" => $id,
                        )
                ))->row();
            $data['idne'] = $id;
            $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"), "where" => array("mog_id" => $id, "mog_dt_status" => 1)))->result();
        }
        $list_supplier = $this->db->select("actor_id, actor_name")->get("actor")->result_array();
        $this->load->view("procurement/transaction/material/entry/cetak", $data);
    }
	
	public function cetak_bapb($id = null, $aksi=null) {
        $data['sess'] = $this->authentication_root();
        $data['transaction_ct'] = "Berita Acara Penerimaan Barang";
        $data['url_action'] = $this->url . 'save/' . $id;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['active'] = empty($id)?$data['sess']['gotcurrent']->mod_menu_id:null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['aksi'] = $aksi;
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
            $data['row'] = $this->crud_model->read_fordata(array("table" => "mog", 
                "join" => array("project pa" => "pa.project_id = mog.project_id"),
                "where" => array(
                        "mog_id" => $id,
                        )
                ))->row();
            $data['idne'] = $id;
            $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"), "where" => array("mog_id" => $id, "mog_dt_status" => 1)))->result();
        }
        $list_supplier = $this->db->select("actor_id, actor_name")->get("actor")->result_array();
        $this->load->view("procurement/transaction/material/entry/cetak_bapb", $data);
    }

    //tambahan cetak spb
    public function cetak_spb($id = null, $aksi=null) {
        $data['sess'] = $this->authentication_root();
        $data['transaction_ct'] = "Surat Pesanan Barang";
        $data['url_action'] = $this->url . 'save/' . $id;
        $data['act'] = (empty($id)) ? "Tambah" : "Edit";
        $data['active'] = empty($id)?$data['sess']['gotcurrent']->mod_menu_id:null;
        $data['permit'] = $data['sess']['permit'];
        $data['title'] = $this->title;
        $data['aksi'] = $aksi;
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
            $data['row'] = $this->crud_model->read_fordata(array("table" => "mog", 
                "join" => array("project pa" => "pa.project_id = mog.project_id"),
                "where" => array(
                        "mog_id" => $id,
                        )
                ))->row();
            $data['idne'] = $id;
            $data['mog_dt'] = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"), "where" => array("mog_id" => $id, "mog_dt_status" => 1)))->result();
        }
        $list_supplier = $this->db->select("actor_id, actor_name")->get("actor")->result_array();
        $this->load->view("procurement/transaction/material/entry/cetak_spb", $data);
    }

    function gmc_send_sms($bagian_id, $datetime='', $debug=false) {
            if ( !is_numeric($bagian_id) ) return false;

            $bagian_id  = $bagian_id;
            if ( !$bagian_id ) return false;

            //header("content-type: text/plain") ; // Dont use this, only for demo //
            if (!$member = $this->crud_model->read_fordata(array("table" => "users",
            "join"=>array("employee p"=>"p.employee_id = users.employee_id"),
            "where" => array("users.users_divisi"=>$bagian_id)
            ))->row()) return false;
        //echo $member->employee_phone;die();
            //$drv = new BulkDriver() ;
            $this->load->library("bulk_driver");
            /* Set The Property of Sending Messanges */
            $this->bulk_driver->setAccess('wika1','ff5e774ae6425c92f36d836899fb0e6c') ; // set here for user name , password 
            $this->bulk_driver->setSenderID('WG Urbano') ; // set here for  sender masking
            $this->bulk_driver->setDeliveryReportURL('http://www.promediautama.com/bulk/status/received_dr_url.php') ; // set delivery report url here , set EMPTU if dr url not available

            /* Priority */
            $this->bulk_driver->setNormalPriority() ; // To Set Normal Priority

            /* Add SMS Packets */
            $this->bulk_driver->addSMS($member->employee_phone,'Pemberitahuan Persetujuan Pengajuan / Pengadaan');
            //$drv->addSMS('6285219755657','SMS Ke Nomor Kedua');
            //$drv->addSMS('628121234567890125','SMS Ke Nomor Ketiga');

            /* Request To Bulk Server */
            $response = $this->bulk_driver->request() ;

            
            
            
            // send
            if ($debug) {
                
            } else {
               /* $CI->gmc_sms->sms_bonus(
                    $member->users_no_telp, 
                    $member->users_username, 
                    "Pemberitahuan Persetujuan Pengajuan / Pengadaan"
                    );*/
            }
        }
	/* BACKUP FUNCTION SCRIPT
	public function approve($jenis_procurement){
        //print_r($_POST);die()
		$data['sess'] = $this->authentication_root();
        $sess = $this->authentication_root();
        $id = $this->input->post('mog_id');
        $no_spb = $this->input->post('no_spb');
        $no_bapb = $this->input->post('no_bapb');
		$actor = $this->input->post('actor');
		$no_surat_jalan = $this->input->post('no_surat_jalan');

        $tgl_pengiriman = date('Y-m-d',strtotime($this->input->post("tanggal_kirim")));
		//$tgl_pengiriman = $this->input->post('tanggal_kirim');
		$jenis = $jenis_procurement;
		//$jenis = $this->input->post('jenis_procurement');
		
		
        if(!empty($_FILES['surat_jalan_document']['name'])){
              $config['upload_path'] = FCPATH.'uploads/surat_jalan_document/';
              $config['allowed_types'] = '*';
              $config['max_filename'] = '255';
                    //$config['encrypt_name'] = TRUE;
              $upload_file = $config['file_name']   = $mog['no_bapb']."_".preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['spb_document']['name']);
                    $config['max_size'] = '10024'; //10 MB
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('surat_jalan_document')) {
                        echo $this->upload->display_errors();
                    }

              }else{
                $upload_file = "";
              }
	  
		  
        if($jenis==="pengajuan"){
            //staff pengadaan pusat
            if($sess['users']->users_divisi == 16){
                $this->db->query("UPDATE mog set role_id='18', no_spb='$no_spb', actor_id='$actor', tanggal_kirim='$tgl_pengiriman', tujuan='Staff Pengadaan Pusat' where mog_id='$id'");
				
				
				$this->recCountActivityRole(18);
                $this->wika_email->send_email_transaction("APPROVED", 18, $id);
                ////supplier
            }elseif($sess['users']->users_divisi == 18){
                $this->db->query("UPDATE mog set role_id='17', tujuan='Supplier', mog_number_letter='$no_surat_jalan' where mog_id='$id'");
                $this->recCountActivityRole(17);
                $this->wika_email->send_email_transaction("APPROVED", 17, $id);
                //staff gudang
            }elseif($sess['users']->users_divisi == 17){
                $this->db->query("UPDATE mog set role_id='15', tujuan='Bagian Gudang', no_bapb='$no_bapb', upload_file_surat_jalan='$upload_file' where mog_id='$id'");
                $this->recCountActivityRole(15);
                $this->wika_email->send_email_transaction("APPROVED", 15, $id);
                //QC
            }elseif($sess['users']->users_divisi == 15){
                $this->db->query("UPDATE mog set role_id='20', tujuan='Bagian QC' where mog_id='$id'");
                $this->recCountActivityRole(20);
                $this->wika_email->send_email_transaction("APPROVED", 20, $id);
                //KASI KA
            }elseif($sess['users']->users_divisi == 20){
                $this->db->query("UPDATE mog set role_id='19', tujuan='Approval KASI KA' where mog_id='$id'");
                $this->recCountActivityRole(19);
                $this->wika_email->send_email_transaction("APPROVED", 19, $id);

            }elseif($sess['users']->users_divisi == 19){
                $this->db->query("UPDATE mog set mog_status='1', role_id='100', tujuan='Approval KSPP' where mog_id='$id'");
            }
        }elseif($jenis==="pengadaan"){
            if($sess['users']->users_divisi == 11){
                //echo $sess['users']->users_divisi;die();
                $this->db->query("UPDATE mog set role_id='12', tujuan='Approval MP  ' where mog_id='$id'");
                $this->recCountActivityRole(12);
                $this->wika_email->send_email_transaction("APPROVED", 12, $id);
                ////supplier
            }elseif($sess['users']->users_divisi == 12){
                // $this->db->query("UPDATE mog set role_id='16', tujuan='Verifikasi Pengajuan' where mog_id='$id'");
                // $this->recCountActivityRole(16);
                // $this->wika_email->send_email_transaction("APPROVED", 16, $id);
				$this->db->query("UPDATE mog set role_id='18', tujuan='Kirim Barang' where mog_id='$id'");
                $this->recCountActivityRole(18);
                $this->wika_email->send_email_transaction("APPROVED", 18, $id);
            }elseif($sess['users']->users_divisi == 16){
                $this->db->query("UPDATE mog set role_id='13', tujuan='Approval M.DAN' where mog_id='$id'");
                $this->recCountActivityRole(13);
                $this->wika_email->send_email_transaction("APPROVED", 13, $id);
            }elseif($sess['users']->users_divisi == 13){
                $this->db->query("UPDATE mog set role_id='7', tujuan='Approval M.DIV' where mog_id='$id'");
                $this->recCountActivityRole(7);
                $this->wika_email->send_email_transaction("APPROVED", 7, $id);
            }elseif($sess['users']->users_divisi == 7){
                $this->db->query("UPDATE mog set role_id='10', tujuan='Approval Direksi' where mog_id='$id'");
                $this->recCountActivityRole(10);
                $this->wika_email->send_email_transaction("APPROVED", 10, $id);
            }elseif($sess['users']->users_divisi == 10){
                $this->db->query("UPDATE mog set role_id='18', tujuan='Approval Supplier' where mog_id='$id'");
                $this->recCountActivityRole(18);
                $this->wika_email->send_email_transaction("APPROVED", 18, $id);
            
            }elseif($sess['users']->users_divisi == 18){
                $this->db->query("UPDATE mog set role_id='17', tujuan='Supplier', mog_number_letter='$no_surat_jalan' where mog_id='$id'");
                $this->recCountActivityRole(17);
                $this->wika_email->send_email_transaction("APPROVED", 17, $id);
                //staff gudang
            }elseif($sess['users']->users_divisi == 17){
                $this->db->query("UPDATE mog set role_id='15', tujuan='Bagian Gudang', no_bapb='$no_bapb', upload_file_surat_jalan='$upload_file' where mog_id='$id'");
                $this->recCountActivityRole(15);
                $this->wika_email->send_email_transaction("APPROVED", 15, $id);
                //QC
            }elseif($sess['users']->users_divisi == 15){
                $this->db->query("UPDATE mog set role_id='20', tujuan='Bagian QC' where mog_id='$id'");
                $this->recCountActivityRole(20);
                $this->wika_email->send_email_transaction("APPROVED", 20, $id);
                //KASI KA
            }elseif($sess['users']->users_divisi == 20){
                $this->db->query("UPDATE mog set role_id='19', tujuan='Approval KASI KA' where mog_id='$id'");
                $this->recCountActivityRole(19);
                $this->wika_email->send_email_transaction("APPROVED", 19, $id);

            }elseif($sess['users']->users_divisi == 19){
                $this->db->query("UPDATE mog set mog_status='1', role_id='100', tujuan='Approval KSPP' where mog_id='$id'");
            }
        }    
        
        $material_sub = $this->input->post('material');
        $mog_dt_volume = $this->input->post('mog_dt_volume');
        $mog_dt_price = $this->input->post('mog_dt_price') ? $this->input->post('mog_dt_price') : NULL;
        $code = $this->input->post('uraian') ? $this->input->post('uraian') : NULL;
        $mog_dt_note = $this->input->post('mog_dt_note') ? $this->input->post('mog_dt_note') : NULL;
        $mog_dt_convertion = $this->input->post('mog_dt_convertion') ? $this->input->post('mog_dt_convertion') : NULL;
        $mog_dt_status = $this->input->post('mog_dt_status');
        $mog_dt_date = NULL;
        $action = $this->input->post('action');
         if (!empty($id)) {
            $mog_dt_id = $this->input->post('mog_dt');
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
                }

                if ($data['sess']['position_id'] == 1 || $data['sess']['position_id'] == 11) {
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
						//$transaction_entry = $this->crud_model->read_data("mog", array("md5(mog_id)" => $id))->row();
						//var_dump($id);
						// hardcode
						$mog['mog_id'] = 20;
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

                    if (($data['sess']['position_id'] == 1 || $data['sess']['position_id'] == 11) && $action[$in] == 'edit') {
                        if (isset($status_volume[$in])) {
                            $this->crud_model->insert_data("stock", $stock);
                        }
                    } else {
                        $this->crud_model->insert_data("stock", $stock);
                    }
                }
            }
        }

        $this->recActivity("Melakukan Persetujuan Pengajuan oleh <b>".$sess['users']->users_username."</b>", "dashboard");

        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i> Pengajuan Berhasil Disetujui</div>");
            //echo json_encode(array("status" => 1));
            redirect('procurement/transaction/material');
    }
	*/

}

?>