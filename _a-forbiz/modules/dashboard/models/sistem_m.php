<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sistem_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function by_id() {
        $this->db->where("apps_id", 1);
        return $this->db->get("apps")->row();
    }

    public function effectivitnas($tahun) {
        if (isset($tahun)) {
            $year = $tahun;
        } else {
            $year = date('Y');
        }
        $sql = "SELECT " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 01 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 02 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 03 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 04 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 05 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 06 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 07 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 08 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 09 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 10 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 11 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT count(activity_id) from activity where month(activity_date) = 12 and year(activity_date) = $year group by month(activity_date), year(activity_date) order by year(activity_date) desc limit 1), 0) as Des " .
                "from activity " .
                // "group by month(activity_date), year(activity_date) ".
                "order by year(activity_date) " .
                "limit 1 ";
        return $this->db->query($sql, false)->row_array();
    }

}
