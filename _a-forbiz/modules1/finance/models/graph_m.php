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
        $outstanding = "SELECT " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 01 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 02 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 03 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 04 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 05 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 06 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 07 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 08 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 09 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 10 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 11 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = '0' and month(invoice_date_kwt) = 12 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Des " .
                "from invoice where invoice_payment_status = '0' " .
                "order by year(invoice_date_kwt) " .
                "limit 1 ";
        $paid = "SELECT " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 01 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 02 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 03 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 04 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 05 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 06 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 07 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 08 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 09 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 10 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 11 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT sum(invoice_total_final) from invoice where invoice_payment_status = 1 and month(invoice_date_kwt) = 12 and year(invoice_date_kwt ) = $year and project_id = $project group by month(invoice_date_kwt), year(invoice_date_kwt) order by year(invoice_date_kwt) desc limit 1), 0) as Des " .
                "from invoice where invoice_payment_status = 1 " .
                "order by year(invoice_date_kwt) " .
                "limit 1 ";
        $data['outstanding'] = $this->db->query($outstanding, false)->row_array();
        $data['paid'] = $this->db->query($paid, false)->row_array();
        return $data;
    }

    public function transaction_average_fee($tahun, $project) {
        if (isset($tahun)) {
            $year = $tahun;
        } else {
            $year = date('Y');
        }
        $fee = "SELECT " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 01 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Jan, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 02 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Feb, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 03 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Mar, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 04 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Apr, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 05 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Mei, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 06 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Jun, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 07 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Jul, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 08 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Agus, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 09 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Sept, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 10 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Okto, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 11 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Nove, " .
                "COALESCE((SELECT sum(salary_total_final) from salary where month(salary_date) = 12 and year(salary_date ) = $year and project_id = $project group by month(salary_date), year(salary_date) order by year(salary_date) desc limit 1), 0) as Des " .
                "from salary " .
                "order by year(salary_date) " .
                "limit 1 ";
        $data['fee'] = $this->db->query($fee, false)->row_array();
        return $data;
    }

}
