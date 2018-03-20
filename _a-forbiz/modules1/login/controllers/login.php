<?php

/**
 * Description of login
 *
 * @author Fachrur Rois H
 */
class Login extends MY_Controller {

    private $title = " System";

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function in_verifiy($data = null) {
        $log_in = $this->session->userdata(md5('for_wika'));
        if (!empty($log_in) AND $log_in == true) {
            redirect('dashboard');
        } else {
            $getTemplate = $this->crud_model->read_fordata(array("table" => "page_config", "where" => array("page_config_status" => 1)))->row();
            $this->load->view("$getTemplate->page_config_url/index", $data);
        }
    }

    public function index() {
	//	die(md5('123456'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><button class="close" data-dismiss="alert"></button>', '</div>');
        $this->form_validation->set_rules('user_username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|xss_clean|callback_check');
        if ($this->form_validation->run() == FALSE) {
            $data['image'] = $this->crud_model->read_data("apps_gallery", array("apps_gallery_status" => 1), NULL)->result();
            $data['title_page'] = $this->title;
            $data['external'] = $this->get_system();
            $this->in_verifiy($data);
        } else {
            $this->check();
        }
    }

    public function check() {
        $username = $this->input->post('user_username');
        $password = $this->input->post('user_password');
        $result = $this->login_model->login($username, md5($password));

        if (count($result['user']) > 0) {
            $sess_array = array(
                'user_id' => $result['user']->users_id,
                'position_id' => $result['user']->users_position_id,
                'login' => true
            );
            $this->session->set_userdata(md5('for_wika'), $sess_array);
            $this->recActivity("Log in system", "access");
            redirect('dashboard', 'refresh');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><button class="close" data-dismiss="alert"></button><strong><i class="fa fa-warning m-r-10"></i></strong>Your Account not Valid !</div>');
            redirect('');
        }
    }

}
