<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	class Bulk_Driver {
		
		private $user ;
		private $password ;
		private $packets ;
		private $priority ;
		private $sender ;
		private $dr_url ;
		
		function __construct() {
			$this->packets = array() ;
			$this->priority = 'Normal' ;
			$this->password = '' ;
			$this->user = '' ;
			$this->sender = '' ;
			$this->dr_url = '' ;
		}
		
		
		function request() {
			$Url = "http://webapps.promediautama.com:29003/sms_applications/smsb/api_mt_send_message.php" ;
			$xmlPacket = "" ;
			foreach ($this->packets as $msisdn => $sms) {
				$xmlPacket .= " 
					<packet>
						<msisdn>".$this->xmlentities($msisdn)."</msisdn>
						<sms>".$this->xmlentities($sms)."</sms>
					</packet>
				" ;
			}
			$xmlData = trim(sprintf(
				"
					<?xml version=\"1.0\"?>
					<bulk_sending>
						<username>%s</username>
						<password>%s</password>
						<priority>%s</priority>
						<sender>%s</sender>
						<dr_url>%s</dr_url>
						<data_packet>
							%s
						</data_packet>
					</bulk_sending>
				",
				$this->xmlentities($this->user),
				$this->xmlentities($this->password),
				$this->xmlentities($this->priority),
				$this->xmlentities($this->sender),
				$this->xmlentities($this->dr_url),
				$xmlPacket
			)) ;
			$Param = "data=".urlencode($xmlData) ;	
			$httpResult = $this->sendHTTP($Url,$Param) ;
			return $httpResult ;
		}
		
		function addSMS($msisdn,$sms) {
			$this->packets[$msisdn] = $sms ;
		}
		
		function resetSMS() {
			$this->packets = array() ;
		}
		
		function setAccess($user,$password) {
			$this->user = $user ;
			$this->password = $password ;
		}
		
		function setSenderID($senderID) {
			$this->sender = $senderID ;
		}
		
		function setHighPriority() {
			$this->priority = 'High' ;
		}
		
		function setLowPriority() {
			$this->priority = 'Low' ;
		}
		
		function setNormalPriority() {
			$this->priority = 'Normal' ;
		}
		
		function setDeliveryReportURL($url) {
			$this->dr_url = $url ;
		}
		
		
		function xmlentities($str) {
			return str_replace(array('&','"',"'",'<','>'), array('&amp;','&quot;','&apos;','&lt;','&gt;'),$str) ;
		}
		
		function sendHTTP($Url,$Parameter) {
			$httpResponses = array(
				"200" => "Request: OK",
				"201" => "Request: Created",
				"202" => "Request: Accepted",
				"203" => "Request: Non-Authorative Information",
				"204" => "Request: No Content",
				"205" => "Request: Reset Content",
				"206" => "Request: Partial Content",
				"300" => "Redirect: Multiple Choices",
				"301" => "Redirect: Moved Permanently",
				"302" => "Redirect: Moved Temporarily",
				"303" => "Redirect: See Other",
				"304" => "Redirect: Not Modified",
				"305" => "Redirect: Use Proxy",
				"400" => "Request: Bad Request",
				"401" => "Request: Authorization Required",
				"402" => "Request: Payment Required (not used yet)",
				"403" => "Request: Forbidden",
				"404" => "Request: Not Found",
				"405" => "Request: Method Not Allowed",
				"406" => "Request: Not Acceptable (encoding)",
				"407" => "Request: Proxy Authentication Required",
				"408" => "Request: Request Timed Out",
				"409" => "Request: Conflicting Request",
				"410" => "Request: Gone",
				"411" => "Request: Content Length Required",
				"412" => "Request: Precondition Failed",
				"413" => "Request: Request Entity Too Long",
				"414" => "Request: Request URI Too Long",
				"415" => "Request: Unsupported Media Type",
				"500" => "Server: Internal Server Error",
				"501" => "Server: Not Implemented",
				"502" => "Server: Bad Gateway",
				"503" => "Server: Service Unavailable",
				"504" => "Server: Gateway Timeout",
				"505" => "Server: HTTP Version Not Supported"
			) ;					
			
			$httpResult = array() ;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $Url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $Parameter);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_ENCODING, "");
			curl_setopt($ch, CURLOPT_USERAGENT, "Andalabs-Bulk-Gateway-Class-ver.1.0");
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$httpResult["response_body"]          = curl_exec($ch);
			$httpResult["response_code"]          = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$httpResult["response_description"]   = trim($httpResponses[$httpResult["response_code"]]) ;
			curl_close($ch);
			return $httpResult ;
		}
	}	
	
	
//	/* How To Use */ 
//	
//	header("content-type: text/plain") ; // Dont use this, only for demo //
//	
//	/* Construct the Bulk Driver Class */
//	$drv = new BulkDriver() ;
//
//	/* Set The Property of Sending Messanges */
//	$drv->setAccess('admin','21232f297a57a5a743894a0e4a801fc3') ;
//	$drv->setSenderID('IMS') ;
//	$drv->setDeliveryReportURL('http://www.promediautama.com/bulk/status/received_dr_url.php') ;
//	
//	/* Priority */
//	$drv->setNormalPriority() ; // To Set Normal Priority
//	$drv->setLowPriority() ; // To Set Low Priority
//	$drv->setHighPriority() ; // To Set High Priority
//	
//	/* Add SMS Packets */
//	$drv->addSMS('6281619371231','SMS Ke Nomor Pertama') ;
//	$drv->addSMS('6281619371232','SMS Ke Nomor Kedua') ;
//	$drv->addSMS('6281619371233','SMS Ke Nomor Ketiga') ;
//	
//	$drv->resetSMS() ; // To Clean the packet, First 3 Packets will be deleted //
//	$drv->addSMS('6281619371'.rand(10,99),'SMS Ke Nomor Pertama') ;
//	$drv->addSMS('6281619371'.rand(10,99),'SMS Ke Nomor Kedua') ;
//	
//	/* Request To Bulk Server */
//	$response = $drv->request() ;
//	
//	/* Print Out the Bulk Server Response */
//	print "Response Code => " . $response['response_code'] . "\n\n" ; 
//	print "Response Code Description => " . $response['response_description'] . "\n\n" ; 
//	print "Response XML Body :\n" . $response['response_body'] . "\n\n" ; 
	
?>
