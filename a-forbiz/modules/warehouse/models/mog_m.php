<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mog_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function by_id() {
        $this->db->where("setting_id", 1);
        return $this->db->get("setting")->row();
    }

}
