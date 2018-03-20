<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class System extends MY_Controller {

    private $title = "System";
    private $header = "System";
    private $url = "dashboard/system/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("sistem_m");
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        is_filtered_mod($data['sess']['validation']);
        $data['active'] = $data['sess']['gotcurrent']->mod_menu_id;
        $data['permit'] = $data['sess']['permit'];
        if (in_array(1, array($data['permit']->access_read, $data['permit']->access_update))) {
            $data['title'] = $this->title;
            $data['header'] = $this->header;
            $data['private_url_access'] = $this->url;
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->input->post("seo") == 'system') {
                $this->form_validation->set_rules('sistem_name', 'Nama Sistem', 'required');
                $this->form_validation->set_rules('sistem_site', 'Website Perusahaan', 'required');
                $this->form_validation->set_rules('sistem_phone', 'Telepon Perusahaan', 'required');
                $this->form_validation->set_rules('sistem_address', 'Alamat Perusahaan', 'required');
            } else {
                $this->form_validation->set_rules('sistem_meta_des', 'Meta Deskripsi', 'required');
            }
            if ($this->form_validation->run() == FALSE) {
                $data['sistem'] = $this->sistem_m->by_id();
                $data['content'] = "dashboard/system/index";
                $this->load->view("../index", $data);
            } else {
                if ($this->input->post("seo") == 'system') {
                    $save_data['apps_name'] = $this->input->post("sistem_name");
                    if (!empty($_FILES['foto']['name'])) {
                        $lokasi_file = $_FILES['foto']['tmp_name'];
                        $nama_file = $_FILES['foto']['name'];
                        $acak = rand(000000, 999999);
                        $nama_file_unik = $acak . $nama_file;
                        if (!empty($lokasi_file)) {
                            $upload = $this->crud_model->upload("img/apps", $nama_file_unik, 'foto');
                            if ($upload == true) {
                                $see = $this->db->query("select * from apps where apps_id = '1'")->row();
                                if (!empty($see->apps_logo)) {
                                    $this->crud_model->unlink($see->apps_logo, "img/apps");
                                }
                                $save_data['apps_logo'] = $nama_file_unik;
                            } else {
                                $this->session->set_flashdata("message", "Logo failed uploaded");
                                redirect("dashboard/system");
                            }
                        } else {
                            $this->session->set_flashdata("message", "Logo failed uploaded");
                            redirect("dashboard/system");
                        }
                    }
                    if (!empty($_FILES['sistem_ground']['name'])) {
                        $lokasi_files = $_FILES['sistem_ground']['tmp_name'];
                        $nama_files = $_FILES['sistem_ground']['name'];
                        $acaks = rand(000000, 999999);
                        $nama_file_uniks = $acaks . $nama_files;
                        if (!empty($lokasi_files)) {
                            $upload = $this->crud_model->upload("img/apps", $nama_file_uniks, 'sistem_ground');
                            if ($upload == true) {
                                $see = $this->db->query("select * from apps where apps_id = '1'")->row();
                                if (!empty($see->apps_image)) {
                                    $this->crud_model->unlink($see->apps_image, "img/apps");
                                }
                                $save_data['apps_image'] = $nama_file_uniks;
                            } else {
                                $this->session->set_flashdata("message", "Background failed uploaded");
                                redirect("dashboard/system");
                            }
                        } else {
                            $this->session->set_flashdata("message", "Background failed uploaded");
                            redirect("dashboard/system");
                        }
                    }
                    $save_data['apps_address'] = ucwords($this->input->post("sistem_address"));
                    $save_data['apps_phone'] = ucwords($this->input->post("sistem_phone"));
                    $save_data['apps_site'] = $this->input->post("sistem_site");
                    $save_data['apps_client'] = $this->input->post("sistem_klien");
                    $save_data['apps_mail'] = $this->input->post("sistem_mail");
                } else {
                    if (!empty($_FILES['favicon']['name'])) {
                        $lokasi_file = $_FILES['favicon']['tmp_name'];
                        $nama_file = $_FILES['favicon']['name'];
                        $acak = rand(000000, 999999);
                        $nama_file_unik = $acak . $nama_file;
                        if (!empty($lokasi_file)) {
                            $upload = $this->crud_model->upload("img/apps", $nama_file_unik, 'favicon', 'favicon');
                            if ($upload == true) {
                                $see = $this->db->query("select * from apps where apps_id = '1'")->row();
                                if (!empty($see->apps_favicon)) {
                                    $this->crud_model->unlink($see->apps_favicon, "img/apps");
                                }
                                $save_data['apps_favicon'] = $nama_file_unik;
                            } else {
                                $this->session->set_flashdata("message", "Favicon failed uploaded");
                                redirect("dashboard/system");
                            }
                        } else {
                            $this->session->set_flashdata("message", "Favicon failed uploaded");
                            redirect("dashboard/system");
                        }
                    }
                    $save_data['apps_meta_description'] = $this->input->post("sistem_meta_des");
                    $save_data['apps_meta_keyword'] = $this->input->post("sistem_meta_key");
                }
                $save_data['apps_id'] = 1;
                $this->crud_model->update_data('apps', $save_data, 'apps_id');
                $this->recActivity("Updated profile system", "dashboard");
                $this->session->set_flashdata("message", "Profile system successfully changed");
                redirect("dashboard/system");
            }
        }
    }

}
