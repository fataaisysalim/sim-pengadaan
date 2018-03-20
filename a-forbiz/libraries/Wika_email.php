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
	function phpmailer()
    {

        $this->CI->load->library("PhpMailerLib");
            $mail = $this->CI->phpmailerlib->load();
        try {

                /*$config = array(
                'protocol' => 'mail',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_port' => 25,
                'smtp_user' => 'bejonugroho.sign@gmail.com',
                'smtp_pass' => 'complusbejo1',
                'smtp_timeout'=>300,
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1'
            );*/

                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'bejonugroho.sign@gmail.com';                 // SMTP username
                $mail->Password = 'complusbejo1';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
                //Recipients
                $mail->setFrom(' no-reply@wikagedung.co.id', 'PT. WIJAYA KARYA');
                $mail->addAddress('monox.narsis@gmail.com', 'Julius');     // Add a recipient
                //$mail->addAddress('RECEIPIENTEMAIL02');               // Name is optional
                //$mail->addReplyTo('RECEIPIENTEMAIL03', 'Ganesha');
                $mail->addCC('rajawali.king@gmail.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                //echo 'Message has been sent';
            } catch (Exception $e) {
                //echo 'Message could not be sent.';
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }

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
        $bapb = "";
        if(!empty($proyek->no_bapb)){
            $bapb = "No BAPB : ".$proyek->no_bapb;
        }
        if($to_email->num_rows()>0){
            //print_r($to_email->row());
            $nama_bagian = $to_email->row()->nama_user_role;
        }
        //die();
        $subject = ' [NOTIFICATION] SIM PENGADAAN - '.$action;
        //$message = $html_spon;
        if($action=="SUBMITTED"){
            $pesan = "Data Telah disubmit, Detail Data Pengajuan/Pengadaan adalah sebagai berikut :";
        }elseif($action=="APPROVED"){
            $pesan = "Data Telah di Setujui, Silahkan melakukan persetujuan selanjutnya. Detail Data Pengajuan/Pengadaan adalah sebagai berikut :";
        }elseif($action=="REJECTED"){
            $pesan = "Data Telah di Tolak, Silahkan melakukan verifikasi dan perubahan data. Detail Data Pengajuan/Pengadaan adalah sebagai berikut :";
        }elseif($action=="APPROVED EDIT"){
            $pesan = "Data dimintai persetujuan untuk edit data, Silahkan melakukan persetujuan selanjutnya. Detail Data Pengajuan/Pengadaan adalah sebagai berikut :";
        }elseif($action=="APPROVED DELETE"){
            $pesan = "Data dimintai persetujuan untuk hapus data, Silahkan melakukan persetujuan selanjutnya. Detail Data Pengajuan/Pengadaan adalah sebagai berikut :";
        }
        $message2 = '<h2 style="width: 453.594px; text-align: center; margin: 0px auto 20px;">
        <b>WIKA GEDUNG SYSTEM</b></h2><br />


        <div style="width: 90%; border: 2px solid #E02222; padding: 0; margin: 0 auto;">
        <div style="background-color: #E02222; padding: 5px; color: #FFF; text-align: center; font: bold 13px Arial;"><b>'.$action.' - Notification</b></div>

        <div style="padding 10px; color: #666666; font: 12px/20px Arial;">
        <p style="padding: 0 10px;">Dear : '.$nama_bagian.'<br>'.$pesan.'</p>

        <p style="padding: 0 10px;">
        Proyek : '.$proyek->project_name.'<br />
        Tanggal Pengajuan : '.$proyek->tanggal_spb.'<br />
        Date : '.date('d F Y').'</p>
        '.$bapb.'
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
			/*
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
			*/
			
            /*ini_set("SMTP","ssl://smtp.gmail.com");
            ini_set("smtp_port","25");*/
            /*$config = array(
                'protocol' => 'mail',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_port' => 25,
                'smtp_user' => 'bejonugroho.sign@gmail.com',
                'smtp_pass' => 'complusbejo1',
                'smtp_timeout'=>300,
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1'
            );*/
			
			// temp for test
			$config = array(
                'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'miracle.lifeofme@gmail.com',
				'smtp_pass' => 'miracle_life',
				'mailtype'  => 'html',
				'charset'   => 'utf-8'
            );
			// temp for test
			
			
            if($to_email->num_rows()>0){
                $email = $to_email->row()->employee_email;
                $this->CI->load->library('email', $config);
                //$this->CI->email->initialize($config);
                $this->CI->email->set_newline("\r\n");
                $mail = $this->CI->email;
                $mail->from('no-reply@wikagedung.co.id', 'PT. WIJAYA KARYA');
                $mail->to($email); 

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

  
        

    function send_sms($to, $message){
        if ( !$this->available ) return false;
        if ( !is_numeric($to) ) return false;
       
        $postfield  = "userkey=".$this->userkey."&passkey=".$this->passkey."&nohp=".$to."&tipe=".$this->type."&pesan=".urlencode($message);
        $curlHandle = curl_init();

        curl_setopt($curlHandle, CURLOPT_URL, $this->url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postfield);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        
        $results    = curl_exec($curlHandle);
        curl_close($curlHandle);
        return $results;
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