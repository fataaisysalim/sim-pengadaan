<?php

class MY_Controller extends CI_Controller {

    public $development = FALSE;

    public function __construct() {
        parent::__construct();
        $this->load->library("User_agent");
    }

    public function authentication_root() {
        if ($this->session->userdata(md5('for_wika'))) {
            $session_data = $this->session->userdata(md5('for_wika'));
            $user = $this->db->query("select * from users u join users_position ul on ul.users_position_id = u.users_position_id where u.users_id = '$session_data[user_id]'")->row();
            $data['users_id'] = md5($session_data['user_id']);
            $data['position_id'] = $user->users_position_id;
            $data['users'] = $user;
            $data['employee'] = $this->crud_model->read_data("employee", array("employee_id" => $user->employee_id))->row();
            $data['system'] = $this->crud_model->read_data("apps", array("apps_id" => 1))->row();
            $data['login'] = md5($session_data['login']);
            $data['external'] = $this->crud_model->read_data("apps", array("apps_id" => 1))->row();
            $data['development'] = $this->development;
            $data['modactive'] = $this->uri->segment(1);
            $data['modulsys'] = $this->modul_m->modul_current($user->users_position_id);
            $data['menusys'] = $this->modul_m->menu_current($user->users_position_id);
            $data['validation'] = $this->modul_m->restricted_menu($user->users_position_id)->num_rows();
            $data['gotcurrent'] = $this->modul_m->restricted_menu($user->users_position_id)->row();
            $data['permit'] = $data['gotcurrent'];
            return $data;
        }
    }

    public function get_system() {
        $data['system'] = $this->crud_model->read_data("apps", array("apps_id" => 1))->row();
        return $data;
    }

    public function user_session($module, $view, $data = FALSE) {
        $this->load->view($module . '/' . $view, $data);
    }

    public function recActivity($action = null, $ct = null) {
        if (!empty($ct) || !empty($action)) {
            $sess = $this->authentication_root();
            $user = $this->crud_model->read_data("users", array("md5(users_id)" => $sess['users_id']))->row();
            $data['users_id'] = $user->users_id;
            $data['activity_ct'] = $ct;
            $data['activity_action'] = $action;
            $data['activity_date'] = date("Y-m-d H:i:s");
            $data['activity_agent'] = $this->input->ip_address() . ";" . $this->agent->browser() . ";" . $this->agent->platform();
            $this->crud_model->insert_data('activity', $data);
        }
    }

    public function recCountActivityRole($role_id=null) {
        if (!empty($role_id)) {
            $this->db->query("UPDATE master_user_role SET jml_proses=jml_proses+1 WHERE id_user_role='".$role_id."'");
        }
    }

}
