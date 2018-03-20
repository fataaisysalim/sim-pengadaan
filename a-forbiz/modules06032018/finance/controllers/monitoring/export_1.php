<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Export extends MY_Controller {

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->helper(array('folarium', 'date_format'));
    }

    public function index() {
        //nothing to do here
    }

    public function detail($project = null, $work_order = null) {
        $data = array(
            'title_page' => 'Monitoring Subkon',
            'title_file' => 'monitoring_subkon',
            'title_company' => $this->config->item('config_client'),
            'setting_date' => date('Y-m-d')
        );
        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();

        $where = array(
            "md5(work_order_id)" => $work_order,
        );
        $join = array(
            "actor ac" => "ac.actor_id = wok.actor_id",
            "users us" => "us.users_id = wok.users_id",
            "project p" => "p.project_id = wok.project_id"
        );
        $data["work"] = $this->crud_model->read_data_with_false("work_order wok", $where, null, $join)->row_array();
        $data["show"] = $this->crud_model->read_data_with_false("invoice inv", $where, null, null)->result_array();

        foreach ($data['show'] as $index => $row) :
            $data['tax'] = $this->crud_model->read_data("invoice_tax", array('invoice_id' => $row['invoice_id']), null, array('tax' => 'invoice_tax.tax_id = tax.tax_id'))->result_array();
            if (count($data['tax']) > 0) :
                foreach ($data['tax'] as $row_) :
                    $data['show'][$index]['invoice_tax'] = $data['tax'];
                endforeach;
            else:
                $data['show'][$index]->invoice_tax = array();
            endif;
            $data['payment'] = $this->crud_model->read_data("payment", array('invoice_id' => $row['invoice_id']), null, array('payment_ct' => 'payment_ct.payment_ct_id = payment.payment_ct_id'))->result_array();
            if (count($data['payment']) > 0) :
                $data['show'][$index]['payment'] = $data['payment'];
            else:
                $data['show'][$index] = array();
            endif;
        endforeach;

//        echo '<pre>';
//        print_r($data['work']);
//        echo '</pre>';

        $work_contract      = $data['work']['work_order_contract'];
        $work_dp            = $data['work']['work_order_dp'];
        $work_retensi       = $data['work']['work_order_retensi'];
        $work_plus          = ($data['work']['work_order_extra_mode'] == 1) ? $data['work']['work_order_extra'] : 0;
        $work_min           = ($data['work']['work_order_extra_mode'] == 2) ? $data['work']['work_order_extra'] : 0;
        $work_contract_total= $work_contract + $work_plus - $work_min;
        $dummy = array(
            'presentase' => 0,
            'kumulatif' => 0,
            'prenetto' => 0,
            'angsuran' => 0,
            'retensi' => 0,
            'netto' => 0,
            'ppn' => 0,
            'bruto' => 0,
            'pph' => 0,
            'penerimaan' => 0,
            'presentase_total' => 0,
            'rumus_plus' => 0,
            'rumus_minus' => 0,
        );
        $variable = array(
            'tax' => array(
                'tax_ppn' => 0,
                'tax_pph' => 0
            ),
            'downpayment' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'termin' => array(
                'sequence' => 0,
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'retensi_bayar' => array(
                'sequence' => 0,
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'last' => array(
                'sequence' => 0,
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'work_extra_plus' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'work_extra_minus' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'work_extra' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'final' => array(  
                'final_account' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
                'sisa_progress_induk' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
                'work_extra_plus' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
                'work_extra_minus' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
                'final_total' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
            ),
            'retensi' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'retensi_minus' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'retensi_total' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'final_total_final' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
        );
        $array = array();
        $array = array(
            'tax' => array(
                'tax_ppn' => 0,
                'tax_pph' => 0
            ),
            'retensi_bayar' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            )
            
        );
        $count = count($data['show']);
        foreach ($data['show'] as $iro => $row) :
            foreach ($row['invoice_tax'] as $ita => $rowtax) :
                if ($rowtax['tax_name'] == 'PPN')
                    $variable['tax']['tax_ppn'] = $rowtax['tax_cuts'];
                if ($rowtax['tax_name'] == 'PPh 23')
                    $variable['tax']['tax_pph'] = $rowtax['tax_cuts'];
            endforeach;
            $array['tax'] = $variable['tax'];
            foreach ($row['payment'] as $ipa => $rowpa) :
                if ($rowpa['payment_ct_id'] == 1) :
                    //down payment data
                    $variable['downpayment']['sequence']    = $rowpa['payment_sequence'];
                    $variable['downpayment']['presentase']  = $rowpa['payment_total'];
                    $variable['downpayment']['kumulatif']   = '';
                    $variable['downpayment']['prenetto']    = ($variable['downpayment']['presentase']/100) * $work_contract;
                    $variable['downpayment']['angsuran']    = '';
                    $variable['downpayment']['retensi']     = '';
                    $variable['downpayment']['netto']       = $variable['downpayment']['prenetto'];
                    $variable['downpayment']['ppn']         = $variable['downpayment']['netto'] * ($variable['tax']['tax_ppn']/100);
                    $variable['downpayment']['bruto']       = $variable['downpayment']['netto'] + $variable['downpayment']['ppn'];
                    $variable['downpayment']['pph']         = $variable['downpayment']['netto'] * ($variable['tax']['tax_pph']/100);
                    $variable['downpayment']['penerimaan']  = $variable['downpayment']['bruto'] - $variable['downpayment']['pph'];
                    
                    $array['downpayment'] = $variable['downpayment'];
                elseif ($rowpa['payment_ct_id'] == 2) :
                    $variable['termin']['sequence']    = $rowpa['payment_sequence'];
                    $variable['termin']['kumulatif']   = $rowpa['payment_total'];
                    $variable['termin']['presentase']  = $variable['termin']['kumulatif'] - $dummy['kumulatif'];
                    $variable['termin']['prenetto']    = ($variable['termin']['presentase']/100) * $work_contract;
                    if($variable['termin']['kumulatif'] == 100) :
                        $variable['termin']['prenetto'] = $variable['termin']['prenetto'] + $work_plus - $work_min;
                    endif;
                    $variable['termin']['prebagi']     = round(($variable['termin']['prenetto'] / $work_contract_total) * 100,4);
                    $variable['termin']['angsuran']    = (- ($variable['termin']['prenetto']) * ($work_dp/100));
                    if($variable['termin']['kumulatif'] == 100) :
                        if($data['work']['work_order_extra_mode'] == 1) :
                            $variable['termin']['angsuran'] = $variable['termin']['angsuran'] + ($work_plus * ($work_dp/100));
                        elseif($data['work']['work_order_extra_mode'] == 2) :
                            $variable['termin']['angsuran'] = $variable['termin']['angsuran'] - ($work_min * ($work_dp/100));
                        endif;
                    endif;
                    $variable['termin']['retensi']     = (- ($variable['termin']['prenetto']) * ($rowpa['payment_retensi']/100));
                    $variable['termin']['netto']       = $variable['termin']['prenetto'] + $variable['termin']['angsuran'] + $variable['termin']['retensi'];
                    $variable['termin']['ppn']         = $variable['termin']['netto'] * ($variable['tax']['tax_ppn']/100);
                    $variable['termin']['bruto']       = $variable['termin']['netto'] + $variable['termin']['ppn'];
                    $variable['termin']['pph']         = $variable['termin']['netto'] * ($variable['tax']['tax_pph']/100);
                    $variable['termin']['penerimaan']  = $variable['termin']['bruto'] - $variable['termin']['pph'];
                    
                    $array['termin']['termin_' . $ipa] = $variable['termin'];
                    $dummy['kumulatif'] = $variable['termin']['kumulatif'];
                    $dummy['prenetto'] = $variable['termin']['prenetto'];
                    $dummy['presentase_total'] = $dummy['presentase_total'] + $variable['termin']['prebagi'];
                elseif ($rowpa['payment_ct_id'] == 3) :
                   
                    $variable['retensi_bayar']['sequence']    = $rowpa['payment_sequence'];
                    $variable['retensi_bayar']['presentase']  = $rowpa['payment_total'];
                    $variable['retensi_bayar']['kumulatif']   = '';
                    $variable['retensi_bayar']['prenetto']    = ($variable['retensi_bayar']['presentase']/100) * $work_contract_total;
                    $variable['retensi_bayar']['angsuran']    = 0;
                    $variable['retensi_bayar']['retensi']     = $variable['retensi_bayar']['prenetto'];
                    $variable['retensi_bayar']['netto']       = $variable['retensi_bayar']['prenetto'];
                    $variable['retensi_bayar']['ppn']         = $variable['retensi_bayar']['netto'] * ($variable['tax']['tax_ppn']/100);
                    $variable['retensi_bayar']['bruto']       = $variable['retensi_bayar']['netto'] + $variable['retensi_bayar']['ppn'];
                    $variable['retensi_bayar']['pph']         = $variable['retensi_bayar']['netto'] * ($variable['tax']['tax_pph']/100);
                    $variable['retensi_bayar']['penerimaan']  = $variable['retensi_bayar']['bruto'] - $variable['retensi_bayar']['pph'];
                    
                    $array['retensi_bayar'] = $variable['retensi_bayar'];
                endif;
                if($rowpa['payment_ct_id'] != 3) :
                    $variable['last']['sequence']    = $variable['last']['sequence'] + $variable['termin']['sequence'];
                    $variable['last']['presentase']  = $variable['last']['presentase'] + $variable['termin']['presentase'];
                    $variable['last']['kumulatif']   = $variable['last']['kumulatif'] + $variable['termin']['kumulatif'];
                    $variable['last']['prenetto']    = $variable['last']['prenetto'] + $variable['termin']['prenetto'];
                    $variable['last']['angsuran']    = $variable['last']['angsuran'] + $variable['termin']['angsuran'];
                    $variable['last']['retensi']     = $variable['last']['retensi'] + $variable['termin']['retensi'];
                    $variable['last']['netto']       = $variable['last']['netto'] + $variable['termin']['netto'];
                    $variable['last']['ppn']         = $variable['last']['ppn'] + $variable['termin']['ppn'];
                    $variable['last']['bruto']       = $variable['last']['bruto'] + $variable['termin']['bruto'];
                    $variable['last']['pph']         = $variable['last']['pph'] + $variable['termin']['pph'];
                    $variable['last']['penerimaan']  = $variable['last']['penerimaan'] + $variable['termin']['penerimaan'];
                endif;
            endforeach;
            $array['last'] = $variable['last'];
        endforeach;
        
        $variable['work_extra_plus']['prenetto']    = $work_plus;
        $variable['work_extra_plus']['presentase']  = round(($work_plus / $work_contract_total) * 100, 4);
        $variable['work_extra_plus']['kumulatif']   = 0;
        $variable['work_extra_plus']['angsuran']    = (($variable['work_extra_plus']['prenetto']) * ($work_dp / 100));
        $variable['work_extra_plus']['retensi']     = (-($variable['work_extra_plus']['prenetto']) * ($work_retensi / 100));
        $variable['work_extra_plus']['netto']       = $variable['work_extra_plus']['prenetto'] + $variable['work_extra_plus']['angsuran'] + $variable['work_extra_plus']['retensi'];
        $variable['work_extra_plus']['ppn']         = $variable['work_extra_plus']['netto'] * ($variable['tax']['tax_ppn']/100);
        $variable['work_extra_plus']['bruto']       = $variable['work_extra_plus']['netto'] + $variable['work_extra_plus']['ppn'];
        $variable['work_extra_plus']['pph']         = $variable['work_extra_plus']['netto'] * ($variable['tax']['tax_pph']/100);
        $variable['work_extra_plus']['penerimaan']  = $variable['work_extra_plus']['bruto'] - $variable['work_extra_plus']['pph'];
        
        $variable['work_extra_minus']['prenetto']    = (-($work_min));
        $variable['work_extra_minus']['presentase']  = round(($work_min / $work_contract_total) * 100, 4);
        $variable['work_extra_minus']['kumulatif']   = 0;
        $variable['work_extra_minus']['angsuran']    = (($variable['work_extra_minus']['prenetto']) * ($work_dp / 100));
        $variable['work_extra_minus']['retensi']     = (-($variable['work_extra_minus']['prenetto']) * ($work_retensi / 100));
        $variable['work_extra_minus']['netto']       = $variable['work_extra_minus']['prenetto'] + $variable['work_extra_minus']['angsuran'] + $variable['work_extra_minus']['retensi'];
        $variable['work_extra_minus']['ppn']         = $variable['work_extra_minus']['netto'] * ($variable['tax']['tax_ppn']/100);
        $variable['work_extra_minus']['bruto']       = $variable['work_extra_minus']['netto'] + $variable['work_extra_minus']['ppn'];
        $variable['work_extra_minus']['pph']         = $variable['work_extra_minus']['netto'] * ($variable['tax']['tax_pph']/100);
        $variable['work_extra_minus']['penerimaan']  = $variable['work_extra_minus']['bruto'] - $variable['work_extra_minus']['pph'];        
        
        $variable['work_extra']['prenetto']    = $variable['work_extra_plus']['prenetto'] + $variable['work_extra_minus']['prenetto'];
        $variable['work_extra']['presentase']  = $dummy['presentase_total'];
        $variable['work_extra']['kumulatif']   = 0;
        $variable['work_extra']['angsuran']    = (($variable['work_extra']['prenetto']) * ($work_dp / 100));
        $variable['work_extra']['retensi']     = (-($variable['work_extra']['prenetto']) * ($work_retensi / 100));
        $variable['work_extra']['netto']       = $variable['work_extra']['prenetto'] + $variable['work_extra']['angsuran'] + $variable['work_extra']['retensi'];
        $variable['work_extra']['ppn']         = $variable['work_extra']['netto'] * ($variable['tax']['tax_ppn']/100);
        $variable['work_extra']['bruto']       = $variable['work_extra']['netto'] + $variable['work_extra']['ppn'];
        $variable['work_extra']['pph']         = $variable['work_extra']['netto'] * ($variable['tax']['tax_pph']/100);
        $variable['work_extra']['penerimaan']  = $variable['work_extra']['bruto'] - $variable['work_extra']['pph'];
        
        $variable['final']['final_account']['presentase']  = 0;
        $variable['final']['final_account']['kumulatif']   = 0;
        $variable['final']['final_account']['prenetto']    = $work_contract_total;
        $variable['final']['final_account']['angsuran']    = (-($work_contract) * ($work_dp / 100));
        $variable['final']['final_account']['retensi']     = (-($variable['final']['final_account']['prenetto']) * ($work_retensi / 100));
        $variable['final']['final_account']['netto']       = $variable['final']['final_account']['prenetto'] + $variable['final']['final_account']['angsuran'] + $variable['final']['final_account']['retensi'];
        $variable['final']['final_account']['ppn']         = $variable['final']['final_account']['netto'] * ($variable['tax']['tax_ppn']/100);
        $variable['final']['final_account']['bruto']       = $variable['final']['final_account']['netto'] + $variable['final']['final_account']['ppn'];
        $variable['final']['final_account']['pph']         = $variable['final']['final_account']['netto'] * ($variable['tax']['tax_pph']/100);
        $variable['final']['final_account']['penerimaan']  = $variable['final']['final_account']['bruto'] - $variable['final']['final_account']['pph'];
        
        $variable['final']['sisa_progress_induk']['presentase']  = 0;
        $variable['final']['sisa_progress_induk']['kumulatif']   = 0;
        $variable['final']['sisa_progress_induk']['prenetto']    = $work_contract - $variable['last']['prenetto'];
        $variable['final']['sisa_progress_induk']['angsuran']    = (-($variable['final']['sisa_progress_induk']['prenetto']) * ($work_dp / 100));
        $variable['final']['sisa_progress_induk']['retensi']     = (-($variable['final']['sisa_progress_induk']['prenetto']) * ($work_retensi / 100));
        $variable['final']['sisa_progress_induk']['netto']       = $variable['final']['sisa_progress_induk']['prenetto'] + $variable['final']['sisa_progress_induk']['angsuran'] + $variable['final']['sisa_progress_induk']['retensi'];
        $variable['final']['sisa_progress_induk']['ppn']         = $variable['final']['sisa_progress_induk']['netto'] * ($variable['tax']['tax_ppn']/100);
        $variable['final']['sisa_progress_induk']['bruto']       = $variable['final']['sisa_progress_induk']['netto'] + $variable['final']['sisa_progress_induk']['ppn'];
        $variable['final']['sisa_progress_induk']['pph']         = $variable['final']['sisa_progress_induk']['netto'] * ($variable['tax']['tax_pph']/100);
        $variable['final']['sisa_progress_induk']['penerimaan']  = $variable['final']['sisa_progress_induk']['bruto'] - $variable['final']['sisa_progress_induk']['pph'];        
        
        $variable['final']['work_extra_plus']['presentase']   = 0;
        $variable['final']['work_extra_plus']['kumulatif']    = 0;
        $variable['final']['work_extra_plus']['prenetto']     = $work_plus;
        $variable['final']['work_extra_plus']['angsuran']     = 0;
        $variable['final']['work_extra_plus']['retensi']      = $variable['work_extra_plus']['retensi'];
        $variable['final']['work_extra_plus']['netto']        = $variable['work_extra_plus']['netto'];
        $variable['final']['work_extra_plus']['ppn']          = $variable['work_extra_plus']['ppn'];
        $variable['final']['work_extra_plus']['bruto']        = $variable['work_extra_plus']['bruto'];
        $variable['final']['work_extra_plus']['pph']          = $variable['work_extra_plus']['pph'];
        $variable['final']['work_extra_plus']['penerimaan']   = $variable['work_extra_plus']['penerimaan'];
        
        $variable['final']['work_extra_minus']['presentase']  = 0;
        $variable['final']['work_extra_minus']['kumulatif']   = 0;
        $variable['final']['work_extra_minus']['prenetto']    = -$work_min;
        $variable['final']['work_extra_minus']['angsuran']    = 0;
        $variable['final']['work_extra_minus']['retensi']     = $variable['work_extra_minus']['retensi'];
        $variable['final']['work_extra_minus']['netto']       = $variable['work_extra_minus']['netto'];
        $variable['final']['work_extra_minus']['ppn']         = $variable['work_extra_minus']['ppn'];
        $variable['final']['work_extra_minus']['bruto']       = $variable['work_extra_minus']['bruto'];
        $variable['final']['work_extra_minus']['pph']         = $variable['work_extra_minus']['pph'];
        $variable['final']['work_extra_minus']['penerimaan']  = $variable['work_extra_minus']['penerimaan'];
        
        if($variable['work_extra']['presentase'] == 100) :
            $dummy['rumus_plus'] = -($variable['final']['work_extra_plus']['prenetto'] * ($work_dp/100));
            $dummy['rumus_minus'] = ($variable['final']['work_extra_minus']['prenetto'] * ($work_dp/100));
        endif;
        
        $variable['final']['final_total']['presentase']       = $variable['final']['sisa_progress_induk']['presentase'] + $variable['final']['work_extra_plus']['presentase'] + $variable['final']['work_extra_minus']['presentase'] + $variable['final']['final_total']['presentase'];
        $variable['final']['final_total']['kumulatif']        = $variable['final']['sisa_progress_induk']['kumulatif'] + $variable['final']['work_extra_plus']['kumulatif'] + $variable['final']['work_extra_minus']['kumulatif'] + $variable['final']['final_total']['kumulatif'];
        $variable['final']['final_total']['prenetto']         = $variable['final']['sisa_progress_induk']['prenetto'] + $variable['final']['work_extra_plus']['prenetto'] + $variable['final']['work_extra_minus']['prenetto'] + $variable['final']['final_total']['prenetto'];
        $variable['final']['final_total']['angsuran']         = $variable['final']['sisa_progress_induk']['angsuran'] + $variable['final']['work_extra_plus']['angsuran'] + $variable['final']['work_extra_minus']['angsuran'] + $variable['final']['final_total']['angsuran'];
        if($data['work']['work_order_extra_mode'] == 1) :
            $variable['final']['final_total']['angsuran']     = $variable['final']['final_total']['angsuran'] + $dummy['rumus_plus'];   
        elseif($data['work']['work_order_extra_mode'] == 2) :
            $variable['final']['final_total']['angsuran']     = $variable['final']['final_total']['angsuran'] - $dummy['rumus_minus'];    
        endif;
        $variable['final']['final_total']['retensi']          = $variable['final']['sisa_progress_induk']['retensi'] + $variable['final']['work_extra_plus']['retensi'] + $variable['final']['work_extra_minus']['retensi'] + $variable['final']['final_total']['retensi'];
        $variable['final']['final_total']['netto']            = $variable['final']['final_total']['prenetto'] + $variable['final']['final_total']['angsuran'] + $variable['final']['final_total']['retensi'];
        $variable['final']['final_total']['ppn']              = $variable['final']['final_total']['netto'] * ($variable['tax']['tax_ppn']/100);
        $variable['final']['final_total']['bruto']            = $variable['final']['final_total']['netto'] + $variable['final']['final_total']['ppn'];
        $variable['final']['final_total']['pph']              = $variable['final']['final_total']['netto'] * ($variable['tax']['tax_pph']/100);;
        $variable['final']['final_total']['penerimaan']       = $variable['final']['final_total']['bruto'] - $variable['final']['final_total']['pph'];
        
        $variable['retensi']['presentase']   = $work_retensi;
        $variable['retensi']['kumulatif']    = 0;
        $variable['retensi']['prenetto']     = $work_contract_total * ($work_retensi/100);
        $variable['retensi']['angsuran']     = 0;
        $variable['retensi']['retensi']      = $variable['retensi']['prenetto'];
        $variable['retensi']['netto']        = $variable['retensi']['retensi'];
        $variable['retensi']['ppn']          = $variable['retensi']['netto'] * ($variable['tax']['tax_ppn']/100);
        $variable['retensi']['bruto']        = $variable['retensi']['netto'] + $variable['retensi']['ppn'];
        $variable['retensi']['pph']          = $variable['retensi']['netto'] * ($variable['tax']['tax_pph']/100);
        $variable['retensi']['penerimaan']   = $variable['retensi']['bruto'] - $variable['retensi']['pph'];
        
        $variable['retensi_total']['presentase']   = $variable['retensi']['presentase'] - $variable['retensi_bayar']['presentase'];
        $variable['retensi_total']['kumulatif']    = 0;
        $variable['retensi_total']['prenetto']     = $variable['retensi']['prenetto'] - $variable['retensi_bayar']['prenetto'];
        $variable['retensi_total']['angsuran']     = 0;
        $variable['retensi_total']['retensi']      = $variable['retensi']['retensi'] - $variable['retensi_bayar']['retensi'];
        $variable['retensi_total']['netto']        = $variable['retensi']['netto'] - $variable['retensi_bayar']['netto'];
        $variable['retensi_total']['ppn']          = $variable['retensi']['ppn'] - $variable['retensi_bayar']['ppn'];
        $variable['retensi_total']['bruto']        = $variable['retensi']['bruto'] - $variable['retensi_bayar']['bruto'];
        $variable['retensi_total']['pph']          = $variable['retensi']['pph'] - $variable['retensi_bayar']['pph'];
        $variable['retensi_total']['penerimaan']   = $variable['retensi']['penerimaan'] - $variable['retensi_bayar']['penerimaan'];
        
        $variable['retensi_minus']['presentase']   = 0;
        $variable['retensi_minus']['kumulatif']    = 0;
        $variable['retensi_minus']['prenetto']     = 0;
        $variable['retensi_minus']['angsuran']     = $variable['final']['final_total']['angsuran']  + $variable['last']['angsuran'];
        $variable['retensi_minus']['retensi']      = $variable['final']['final_total']['retensi']   + $variable['last']['retensi'];
        $variable['retensi_minus']['netto']        = $variable['downpayment']['netto']              + $variable['final']['final_total']['netto']        + $variable['last']['netto']        + $variable['retensi']['netto'];
        $variable['retensi_minus']['ppn']          = $variable['downpayment']['ppn']                + $variable['final']['final_total']['ppn']          + $variable['last']['ppn']          + $variable['retensi']['ppn'];
        $variable['retensi_minus']['bruto']        = $variable['downpayment']['bruto']              + $variable['final']['final_total']['bruto']        + $variable['last']['bruto']        + $variable['retensi']['bruto'];
        $variable['retensi_minus']['pph']          = $variable['downpayment']['pph']                + $variable['final']['final_total']['pph']          + $variable['last']['pph']          + $variable['retensi']['pph'];
        $variable['retensi_minus']['penerimaan']   = $variable['downpayment']['penerimaan']         + $variable['final']['final_total']['penerimaan']   + $variable['last']['penerimaan']   + $variable['retensi']['penerimaan'];
     
     
        $variable['final_total_final']['presentase']   = 0;
        $variable['final_total_final']['kumulatif']    = 0;
        $variable['final_total_final']['prenetto']     = 0;
        $variable['final_total_final']['angsuran']     = 0;
        $variable['final_total_final']['retensi']      = 0;
        $variable['final_total_final']['netto']        = $variable['downpayment']['netto']      + $variable['work_extra']['netto'];
        $variable['final_total_final']['ppn']          = $variable['downpayment']['ppn']        + $variable['work_extra']['ppn'];
        $variable['final_total_final']['bruto']        = $variable['downpayment']['bruto']      + $variable['work_extra']['bruto'];
        $variable['final_total_final']['pph']          = $variable['downpayment']['pph']        + $variable['work_extra']['pph'];
        $variable['final_total_final']['penerimaan']   = $variable['downpayment']['penerimaan'] + $variable['work_extra']['penerimaan'];
        
        $array['work_extra_plus']   = $variable['work_extra_plus'];
        $array['work_extra_minus']  = $variable['work_extra_minus'];
        $array['work_extra']        = $variable['work_extra'];
        $array['final']             = $variable['final'];
        $array['retensi']           = $variable['retensi'];
        $array['retensi_minus']     = $variable['retensi_minus'];
        $array['retensi_total']     = $variable['retensi_total'];
        $array['final_total_final'] = $variable['final_total_final'];
        
        $data['array'] = $array;
        
//        echo '<pre>';
//        print_r($array);
//        echo '</pre>';
        
        $data['content'] = "finance/monitoring/export/export_work_order";
        $this->load->view($data['content'], $data);
    }

}
