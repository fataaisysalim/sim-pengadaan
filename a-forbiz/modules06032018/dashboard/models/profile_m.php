<?php

class profile_m extends CI_Model {


    function get_by_id($id) {
        $this->db->select("*, u.users_id");
        $this->db->join('users_level ul', 'ul.users_level_id = u.users_level_id', 'LEFT');
        $this->db->where('md5(u.users_id)', $id);
        return $this->db->get('users u')->row();
    }
    function check($id, $pass = null) {
        if (isset($pass)) {
            $this->db->where('users_password', $pass);
        }
        $this->db->where('md5(users_id)', $id);
        return $this->db->get('users');
    }

}

?>