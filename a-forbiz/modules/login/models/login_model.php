<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function login($username, $password) {
        $user_clear = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($username, ENT_QUOTES))));
        $pass_clear = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($password, ENT_QUOTES))));
        $this->db->where("users_username", $user_clear);
        $this->db->where("users_password", $pass_clear);
        $this->db->where("users_status", 1);
        $user = $this->db->get('users')->row();
        return array('user' => $user);
    }

    function user_log($user, $action) {
        $data = array(
            'users_id' => $user,
            'users_log_date' => date("Y-m-d H:i:s"),
            'users_log_ip' => $_SERVER['REMOTE_ADDR'],
            'users_log_act' => $action
        );
        $this->db->insert('users_log', $data);
    }

}
