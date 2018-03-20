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

        //update to database
        /*$this->db->query("CREATE TABLE IF NOT EXISTS `procurement` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `proyek_id` int(11) NOT NULL,
          `supplier_id` int(11) NOT NULL,
          `jenis_procurement` varchar(20) NOT NULL,
          `tanggal_spb` datetime NOT NULL,
          `nomor_pengajuan` int(11) NOT NULL,
          `kontrak_payung` int(11) NOT NULL,
          `catatan` text NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `user_id` int(11) NOT NULL,
          `status` varchar(10) NOT NULL DEFAULT 'open',
          `role_id` int(11) NOT NULL,
          `no_spb` varchar(50) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `procurement_detail` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `procurement_id` int(11) NOT NULL,
          `material_id` int(11) NOT NULL,
          `equipment_id` int(11) NOT NULL,
          `volume` decimal(10,0) NOT NULL,
          `qty` int(11) NOT NULL,
          `keterangan` text NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

        if (!$this->db->field_exists('no_bapb','procurement')){
          $this->db->query("ALTER TABLE  `procurement` ADD  `no_bapb` VARCHAR( 10 ) NOT NULL");
        }

        if (!$this->db->field_exists('upload_file','procurement')){
          $this->db->query("ALTER TABLE  `procurement` ADD  `upload_file` VARCHAR( 200 ) NOT NULL");
        }

        if (!$this->db->field_exists('price','procurement_detail')){
          $this->db->query("ALTER TABLE  `procurement_detail` ADD  `price` INT NOT NULL");
        }
        
        if (!$this->db->field_exists('code_id','procurement_detail')){
          $this->db->query("ALTER TABLE  `procurement_detail` ADD  `code_id` INT NOT NULL AFTER  `procurement_id`");
        }
        
        

       // $this->db->query("ALTER TABLE  `procurement` CHANGE  `proyek_id`  `project_id` INT( 11 ) NOT NULL");
        $this->db->query("ALTER TABLE  `procurement_detail` CHANGE  `keterangan`  `keterangan` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL");

        $this->db->query("ALTER TABLE  `procurement` CHANGE  `no_bapb`  `no_bapb` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL");*/
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
