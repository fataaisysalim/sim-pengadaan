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
        $bapb = "SELECT " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 01 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 02 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 03 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 04 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 05 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 06 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 07 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 08 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 09 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 10 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 11 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 1 and month(mog_date) = 12 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Des " .
                "from mog where transaction_ct_id = 1 " .
                "order by year(mog_date) " .
                "limit 1 ";
        $bpm = "SELECT " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 01 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 02 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 03 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 04 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 05 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 06 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 07 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 08 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 09 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 10 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 11 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT count(mog_id) from mog where transaction_ct_id = 2 and month(mog_date) = 12 and year(mog_date) = $year and project_id = $project group by month(mog_date), year(mog_date) order by year(mog_date) desc limit 1), 0) as Des " .
                "from mog where transaction_ct_id = 2 " .
                "order by year(mog_date) " .
                "limit 1 ";
        $bapp = "SELECT " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 01 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 02 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 03 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 04 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 05 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 06 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 07 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 08 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 09 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 10 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 11 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 1 and month(equipt_transaction_date) = 12 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Des " .
                "from equipt_transaction where transaction_ct_id = 1 " .
                "order by year(equipt_transaction_date) " .
                "limit 1 ";
        $bpp = "SELECT " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 01 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 02 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 03 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 04 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 05 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 06 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 07 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 08 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 09 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 10 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 11 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT count(equipt_transaction_id) from equipt_transaction where transaction_ct_id = 2 and month(equipt_transaction_date) = 12 and year(equipt_transaction_date) = $year and project_id = $project group by month(equipt_transaction_date), year(equipt_transaction_date) order by year(equipt_transaction_date) desc limit 1), 0) as Des " .
                "from equipt_transaction where transaction_ct_id = 2 " .
                "order by year(equipt_transaction_date) " .
                "limit 1 ";
        $data['bapb'] = $this->db->query($bapb, false)->row_array();
        $data['bpm'] = $this->db->query($bpm, false)->row_array();
        $data['bapp'] = $this->db->query($bapp, false)->row_array();
        $data['bpp'] = $this->db->query($bpp, false)->row_array();
        return $data;
    }

}
