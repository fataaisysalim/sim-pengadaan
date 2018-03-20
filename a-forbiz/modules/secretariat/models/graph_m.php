<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Graph_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function transaction_average($tahun, $project) {
        if (isset($tahun)) {
            $year = $tahun;
        } else {
            $year = date('Y');
        }
        $entry = "SELECT " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 01 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 02 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 03 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 04 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 05 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 06 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 07 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 08 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 09 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 10 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 11 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 1 and month(doc_control_date) = 12 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Des " .
                "from doc_control where doc_control_ct_id = 1 " .
                "order by year(doc_control_date) " .
                "limit 1 ";
        $exits = "SELECT " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 01 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 02 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 03 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 04 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 05 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 06 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 07 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 08 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 09 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 10 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 11 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT count(doc_control_id) from doc_control where doc_control_ct_id = 2 and month(doc_control_date) = 12 and year(doc_control_date ) = $year and project_id = $project group by month(doc_control_date), year(doc_control_date) order by year(doc_control_date) desc limit 1), 0) as Des " .
                "from doc_control where doc_control_ct_id = 2 " .
                "order by year(doc_control_date) " .
                "limit 1 ";
        $data['entry'] = $this->db->query($entry, false)->row_array();
        $data['exits'] = $this->db->query($exits, false)->row_array();
        return $data;
    }

}
