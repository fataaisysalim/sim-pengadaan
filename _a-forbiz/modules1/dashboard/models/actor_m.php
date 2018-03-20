<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Actor_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function all_actor($actr = null) {
        if (!empty($actr)) {
            for ($x = 0; $x < count($actr); $x++) {
                if ($actr[$x] == 0) {
                    $this->db->where(array("actor_category_id" => $actr[$x]));
                } else {
                    $this->db->or_where(array("actor_category_id" => $actr[$x]));
                }
            }
        }
        $data['ct'] = $this->db->get("actor_category")->result();
        if (count($data['ct']) > 0) {
            foreach ($data['ct'] as $num => $row) {
                $data['act'][$num] = $this->crud_model->read_data("actor", array("actor_category_id" => $row->actor_category_id, "actor_status" => 1), array("actor_id" => "DESC"))->result();
            }
        }
        return $data;
    }

}
