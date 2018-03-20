<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Doc_control extends MY_Controller {

    private $title = "Document Control";
    private $url = "secretariat/doc-control";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array("origin_model"));
        $this->load->helper("romawi_helper");
        $this->load->library('cfpdf');
        $this->load->config('pdf_config');
        $this->load->library('zip');
    }

    public function index($id = null) {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        $data['url_access'] = $this->url;
        if (in_array(1, array($data['permit']->access_create, $data['permit']->access_update))) {
            $data['title'] = $this->title;
            $data['js_load'] = "extend/js_fancybox";
            $data['content'] = "secretariat/transaction/document_control/index";
            if (!empty($id) AND $data['permit']->access_update == 1) {
                $data['docId'] = $id;
            }
            $this->load->view("../index", $data);
        }
    }

    public function form($id = NULL) {
        $data['sess'] = $this->authentication_root();
        $data['permit'] = $data['sess']['permit'];
        if (in_array(1, array($data['permit']->access_create, $data['permit']->access_update))) {
            $data['act'] = (empty($id)) ? "add" : "edit";
            $data['header'] = $this->title;
            $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
            $data['actor'] = $this->origin_model->actor(4);
            $data['url_access'] = $this->url;
            $data['letcode'] = $this->crud_model->read_data("doc_control_letcode")->result();
            $data['new'] = $this->crud_model->read_data("doc_control")->last_row();
            if (!empty($id) AND $data['permit']->access_update == 1) {
                $data['doc'] = $this->origin_model->docDt($id);
            }
            $this->load->view("secretariat/transaction/document_control/form", $data);
        }
    }

    public function save($id = NULL) {
        $sess = $this->authentication_root();

        $doc['users_id'] = $sess['users']->users_id;
        $doc['actor_id'] = $this->input->post("actor");
        $doc['doc_control_letcode_id'] = $this->input->post("letter_code");
        $doc['doc_control_number'] = $this->input->post("letter_number");
        $doc['doc_control_case'] = $this->input->post("doc_case");
        $doc['doc_control_desc'] = $this->input->post("doc_desc");

        if (isset($doc)) {
            if (empty($id)) {
                $doc['project_id'] = $this->input->post("project");
                $doc['doc_control_ct_id'] = $this->input->post("type_doc") == md5(1) ? 1 : 2;
                $doc['doc_control_date'] = date("Y-m-d H:i:s");
                $this->crud_model->insert_data("doc_control", $doc);
                $this->recActivity("Created Document <b>$doc[doc_control_case]</b> on Document Control", "secretariat");
                $actions = "tambah";
                $docid = $this->crud_model->read_data("doc_control")->last_row()->doc_control_id;
                $this->session->set_flashdata("idDoc", md5($docid));
            } else {
                $docCtrl = $this->crud_model->read_data("doc_control", array("md5(doc_control_id)" => $id))->row();
                $doc['doc_control_id'] = $docCtrl->doc_control_id;
                $this->crud_model->update_data("doc_control", $doc, "doc_control_id");
                $this->recActivity("Updated Document <b>$doc[doc_control_case]</b> on Document Control", "secretariat");
                $actions = "edit";
                $docid = $docCtrl->doc_control_id;
            }


            for ($in = 0; $in < count($_FILES['attach']['name']); $in++) {
                if (!empty($_FILES['attach']['name'][$in])) {
                    $lokasi_file = $_FILES['attach']['tmp_name'][$in];
                    $nama_file = $_FILES['attach']['name'][$in];
                    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
                    $acak = rand(000000, 999999);
                    $nama_file_unik = "$acak." . strtolower($ext);
//                    if (!empty($id)) {
//                        $filex = $this->crud_model->read_data("doc_attach", array("doc_attach" => $docid))->row();
//                        if (!empty($filex->doc_attach_files)) {
//                            $this->crud_model->unlink($filex->doc_attach_files, 'files/doc_control');
//                        }
//                    }
                    $upload = $this->crud_model->upload('files/doc_control', $nama_file_unik, "attach", $lokasi_file);
                    $attach[$in]['doc_control_id'] = $docid;
                    $attach[$in]['doc_attach_name'] = $doc['doc_control_case'];
                    $attach[$in]['doc_attach_files'] = $nama_file_unik;
                    $this->crud_model->insert_data("doc_attach", $attach[$in]);
                }
            }
        }

        $this->session->set_flashdata("DocCt", md5($doc['doc_control_ct_id']));
        $this->session->set_flashdata("message", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Documents successfully saved</div>");
        redirect($this->url);
    }

    public function delete($doc_control_id = NULL) {

        $sess = $this->authentication_root();
        $data['sess'] = $this->authentication_root();
        if (!empty($doc_control_id)) {
            $doc = $this->crud_model->read_data("doc_control", array("md5(doc_control_id)" => $doc_control_id))->num_rows();
            if ($doc != 0) {
                if ($sess['position_id'] == 1) {
                    $files = $this->crud_model->read_data("doc_attach", array("md5(doc_control_id)" => $doc_control_id))->result();
                    foreach ($files as $i => $filex) {
                        if (!empty($filex->doc_attach_files)) {
                            $this->crud_model->unlink($filex->doc_attach_files, 'files/doc_control');
                        }
                    }
                    $docs = $this->crud_model->read_data("doc_control", array("md5(doc_control_id)" => $doc_control_id))->row();
                    $this->recActivity("Deleted document <b>$docs->doc_control_case</b> of Document Control", "secretariat");
                    $this->crud_model->delete_data("doc_attach", array("md5(doc_control_id)" => "$doc_control_id"));
                    $this->crud_model->delete_data("doc_control", array("md5(doc_control_id)" => "$doc_control_id"));
                    $this->session->set_flashdata("messageDoc", "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-md'></i>Document successfully removed</div>");
                    echo json_encode(array("status" => 1));
                } else {
                    echo json_encode(array("status" => 0, "msg" => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-warning mg-r-md'></i>You don't have access the feature</div>"));
                }
            } else {
                echo json_encode(array("status" => 0, "msg" => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-warning mg-r-md'></i>Document not exist</div>"));
            }
        } else {
            echo json_encode(array("status" => 0, "msg" => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-warning mg-r-md'></i>Document not exist</div>"));
        }
    }

    public function receipt($document_id) {
        $data["md"] = $this->crud_model->read_data("doc_control dc", array("md5(dc.doc_control_id)" => $document_id), null, array("actor a" => "a.actor_id=dc.actor_id", "users u" => "u.users_id = dc.users_id", "employee e" => "e.employee_id=u.employee_id", "project p" => array("p.project_id=dc.project_id", "left")))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null)->row();
        $this->load->view("secretariat/transaction/document_control/pdf_receipt", $data);
    }

    public function disposition($document_id) {
        $data["md"] = $this->crud_model->read_data("doc_control dc", array("md5(dc.doc_control_id)" => $document_id), null, array("actor a" => "a.actor_id=dc.actor_id", "project p" => array("p.project_id=dc.project_id", "left")))->row();
        $data['detail'] = $this->crud_model->read_data('apps', null, null)->row();
        $this->load->view("secretariat/transaction/deposisi/pdf_disposition", $data);
    }

    public function download($id) {
        if (!empty($id)) {
            $check = $this->crud_model->read_fordata(array("table" => "doc_control", "where" => array("md5(doc_control_id)" => $id)))->row();
            if (count($check) > 0) {
                $filegets = $this->crud_model->read_fordata(array("table" => "doc_attach", "where" => array("md5(doc_control_id)" => $id)))->result();
                foreach ($filegets as $x => $z) {
                    $this->zip->read_file("assets/files/doc_control/$z->doc_attach_files");
                }
                $this->recActivity("Downloaded document <b>$check->doc_control_case</b>", "secretariat");
                $this->zip->download("$check->doc_control_number.zip");
            } else {
                redirect();
            }
        } else {
            redirect();
        }
    }

}

?>