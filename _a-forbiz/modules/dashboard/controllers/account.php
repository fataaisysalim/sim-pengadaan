<?php

class Account extends MY_Controller {

    private $title = "Profile";
    private $header = "profile";
    private $url = "setting/profil/";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model(array('profile_m'));
    }

    function index() {
        $data['sess'] = $this->authentication_root();
        $data['active'] = null;
        $data['title'] = "Your Account";
        $data["my_activity"] = $this->crud_model->read_fordata(array("table" => "activity a", "where" => array("md5(a.users_id)" => $data['sess']['users_id']), "join" => array("users u" => "u.users_id = a.users_id", "users_position up" => "up.users_position_id = u.users_position_id", "employee e" => "e.employee_id = u.employee_id"), "order" => array("a.activity_id" => "DESC"), "limit" => 7))->result();
        $data['content'] = 'account/index';
        $this->user_session('../', 'index', $data);
    }

    function profile() {
        $data['sess'] = $this->authentication_root();
        $this->user_session('dashboard/account', 'profile', $data);
    }

    function password() {
        $data['sess'] = $this->authentication_root();
        $this->user_session('dashboard/account', 'password', $data);
    }

    function photo() {
        $data['sess'] = $this->authentication_root();
        $this->user_session('dashboard/account', 'photo', $data);
    }

    function save() {
        $session = $this->authentication_root();
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Handphone', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'message' => '<div class="alert alert-danger alert-dismissable row"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-sm"></i>Profile failed to update</div>'));
        } else {
            $data = array(
                'employee_id' => $session['employee']->employee_id,
                'employee_nik' => $this->input->post('nik'),
                'employee_phone' => $this->input->post('phone'),
                'employee_address' => $this->input->post('address'),
                'employee_email' => $this->input->post('email'),
                'employee_name' => $this->input->post('fullname')
            );
            $this->crud_model->update_data('employee', $data, 'employee_id');
            $this->recActivity("Update profile", "profile");
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable row"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-sm"></i>Password seccesful update</div>');
            echo json_encode(array('status' => 1));
        }
    }

    function save_password() {
        $session = $this->authentication_root();
        $this->form_validation->set_rules('old', 'Password Lama', 'required');
        $this->form_validation->set_rules('new', 'Password Baru', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'message' => "<div class='alert alert-danger alert-dismissable row'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-info-circle mg-r-sm'></i>Password can't empty</div>"));
        } else {
            if ($session['users']->users_password == md5($this->input->post('old'))) {
                $data['users_password'] = md5($this->input->post('new'));
                $data['users_id'] = $session['users']->users_id;
                $this->crud_model->update_data('users', $data, 'users_id');
                echo json_encode(array('status' => 1, 'message' => '<div class="alert alert-success alert-dismissable row"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-sm"></i>Your password successfull saved</div>'));
            } else {
                echo json_encode(array('status' => 0, 'message' => '<div class="alert alert-danger alert-dismissable row"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-sm"></i>Your old password not valid</div>'));
            }
        }
    }

    function delete_photo() {
        $session = $this->authentication_root();
        if (!empty($session['employee']->employee_photo)) {
            $this->crud_model->unlink($session['employee']->employee_photo);
            $data['employee_photo'] = NULL;
            $data['employee_id'] = $session['employee']->employee_id;
            $this->crud_model->update_data('employee', $data, 'employee_id');
            $this->recActivity("Deleted photo profile", "profile");
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable row"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Photo successful delete</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable row"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Failed to Upload</div>');
        }
        redirect('dashboard/account');
    }

    function photo_profile() {
        $session = $this->authentication_root();
        $file = $_FILES['foto']['name'];
        if (!empty($file)) {
            $lokasi_file = $_FILES['foto']['tmp_name'];
            $nama_file = $_FILES['foto']['name'];
            $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
            $acak = rand(000000, 999999);
            $nama_file_unik = "profile$acak." . $ext;
            if (!empty($lokasi_file)) {
                $upload = $this->crud_model->upload(null, $nama_file_unik, 'foto', $lokasi_file);
                if ($upload == true) {
                    if (!empty($session['employee']->employee_photo)) {
                        $this->crud_model->unlink($session['employee']->employee_photo);
                    }
                    $data['employee_photo'] = $nama_file_unik;
                    $data['employee_id'] = $session['employee']->employee_id;
                    $this->crud_model->update_data('employee', $data, 'employee_id');
                    $this->recActivity("Uploaded photo profile", "account");
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable row"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Successful to Uploaded</div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable row"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Failed to Upload</div>');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable row"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Failed to Upload</div>');
            }
        }
        redirect('dashboard/account');
    }

}

?>