<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * FamilyCare Email class.
 *
 * @class gmc_email
 */
class Wika_email 
{
	var $CI;
    var $active;
    
	/**
	 * Constructor - Sets up the object properties.
	 */
	function __construct()
    {
        $this->CI       =& get_instance();
        
	}
	
    /**
	 * Send email function.
	 *
     * @param string    $to         (Required)  To email destination
     * @param string    $subject    (Required)  Subject of email
     * @param string    $message    (Required)  Message of email
     * @param string    $from       (Optional)  From email
     * @param string    $from_name  (Optional)  From name email
     * @param string    $attachment (Optional)  File Attachment
	 * @return Mixed
	 */
	
    function send_email_transaction($action, $id_bagian,$mogid, $debug=false){
        $this->CI->load->model('crud_model');
        $to_email = $this->CI->crud_model->read_fordata(array("table" => "users",
            "join" => array("master_user_role p"=>"p.id_user_role = users.users_divisi", "employee e" =>"e.employee_id = users.employee_id"),
            "where"=>array("users_divisi"=>$id_bagian)

            ));
        $proyek = $this->CI->crud_model->read_fordata(array("table" => "mog",
            "join"=>array("project p"=>"p.project_id = mog.project_id"),
            "where" => array("mog.mog_id"=>$mogid)
            ))->row();
        $nama_bagian = "";
        if($to_email->num_rows()>0){
            $nama_bagian = $to_email->row()->nama_user_role;
        }
        //$message            = new stdClass(); 
        //$message->plain     = $plain_spon;
        //$message->html      = $html_spon;

        $subject = ' [NOTIFICATION] SIM PENGADAAN - '.$action;
        //$message = $html_spon;
        $message2 = '<h2 style="width: 453.594px; text-align: center; margin: 0px auto 20px;">
        <b>KPI MANUAL SYSTEM</b></h2><br />


        <div style="width: 90%; border: 2px solid #E02222; padding: 0; margin: 0 auto;">
        <div style="background-color: #E02222; padding: 5px; color: #FFF; text-align: center; font: bold 13px Arial;"><b>'.$action.' - Notification</b></div>

        <div style="padding 10px; color: #666666; font: 12px/20px Arial;">
        <p style="padding: 0 10px;">Dear : '.$nama_bagian.' has been submited. The Summary of the form is as follows:</p>

        <p style="padding: 0 10px;">
        Proyek : '.$proyek->project_name.'<br />
        Tanggal Pengajuan : '.$proyek->tanggal_spb.'<br />
        Date : '.date('d F Y').'</p>

        <p style="padding: 0 10px;">You are receiving this notification because your name and email address are registered into our SIM PENGADAAN Sistem user database.

Please DO NOT reply back to this email address sender as we are using it for sending purpose only and are not monitoring any incoming emails into it.

If you have any questions or informations regarding this notification, or if you do not want to receive any notifications in the future, please contact our Customer Care officer at below address.</p>

        <p style="width: 50%; padding: 20px 10px 0 10px; color: #888888; font-size: 11px;">Salam Sukses,</p>

        <p style="color: rgb(102, 102, 102); font-family: Arial; font-size: 12px; line-height: 20px; padding: 0px 10px;">PT. WIJAYA KARYA<br />
            Jl. DI. Panjaitan No.Kav 9-10, RT.1/RW.11, Cipinang Cempedak, Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13340</p>

        </div>';
        $headers = 'From: no-reply@wikagedung.co.id' . "\r\n" .
            'Reply-To: no-reply@wikagedung.co.id' . "\r\n" .
            "MIME-Version: 1.0" . "\r\n" . 
            "Content-type: text/html; charset=UTF-8" . "\r\n".
            'X-Mailer: PHP/' . phpversion();

            $config = array(
                'protocol' => 'mail',
                'smtp_host' => 'mail.wikagedung.co.id',
                'smtp_port' => 465,
                'smtp_user' => 'e-danlat@wikagedung.co.id',
                'smtp_pass' => 'w1k4gedung',
                'smtp_timeout'=>300,
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1'
            );

            if($to_email->num_rows()>0){
                $this->CI->load->library('email', $config);
                $this->CI->email->set_newline("\r\n");
                $mail = $this->CI->email;
                $mail->from('no-reply@wikagedung.co.id', 'PT. WIJAYA KARYA');
                $mail->to($to_email->row()->employee_email); 

                $mail->subject($subject);
                $mail->message($message2);   

                //$mail->send();

                if($mail->send()){
                    return true;
                }
                //mail($to_email, $subject, $message2, $headers);
                return false;
            }
    }

    function get_next_bagian(){
        $username_kpi = $this->CI->session->userdata('username_kpi'); 
        $nama_role_kpi = $this->CI->session->userdata('nama_role_kpi'); 
        $cabang_id =  $this->CI->session->userdata('ID_cabang_kpi');
    //cek bagian atasannya
      $sql = $this->CI->db->query("SELECT
        BAG.ID
        FROM
        M_BAGIAN
        LEFT JOIN M_USERS ON M_USERS.BAGIAN_ID = M_BAGIAN. ID
        LEFT JOIN M_BAGIAN BAG ON BAG.ID = M_BAGIAN.HEADER_BAGIAN
        WHERE
        M_USERS.USERNAME = '".$username_kpi."' and M_USERS.CABANG_ID='$cabang_id'")->row();
      if($nama_role_kpi=="producer"){
        $atasan = $this->CI->session->userdata('id_bagian_kpi');
      }else{
        $atasan = $sql->ID;
      }
      return $atasan;
    }  
}

/*
CHANGELOG
---------
Insert new changelog at the top of the list.
-----------------------------------------------
Version	YYYY/MM/DD  Person Name		Description
-----------------------------------------------
1.0.0   2014/12/12  Iqbal           - Created this changelog
*/