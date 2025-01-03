<?php session_start();
//error_reporting(0);
require_once("dbconnect_emri_102.php"); 

date_default_timezone_set("Asia/Kolkata");


$sms = mysql_fetch_array(mysql_query("SELECT `smsUser`, `smsPwd`, `smsSenderId` FROM sms_details where is_active=1"));

log('test');

 
 if($sms['is_active'] ==1)
 {
//Please Enter Your Details
$user=$sms['smsUser']; //your username
$password=$sms['smsPwd']; //"XXXXXX"; //your password
$senderid=$sms['smsSenderId'];  //"SMSCountry";

$smsQuery = mysql_query("select * from sms_q where `STATUS` ='FAIL'");

while($dataSms = mysql_fetch_array($smsQuery))
{
			
			
		$mobilenumbers= "91".$dataSms['mobile']; //  "919XXXXXXXXX"; //enter Mobile numbers comma seperated
		$message = $dataSms['msg'];  //"test messgae"; //enter Your Message
		 //Your senderid

		$messagetype="N"; //Type Of Your Message
		$DReports="Y"; //Delivery Reports
		$url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
		$message = urlencode($message);
		$ch = curl_init();
		if (!$ch){die("Couldn't initialize a cURL handle");}
		$ret = curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt ($ch, CURLOPT_POSTFIELDS,
		"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
		$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
		// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
		$curlresponse = curl_exec($ch); // execute
		if(curl_errno($ch))
		echo 'curl error : '. curl_error($ch);

log(curl_errno($ch));
			mysql_query("update sms_q set `status`='FAIL' where `id`='".$dataSms['id']."' ");
			
			mysql_query("insert into  sms_q_log  (select * from sms_q where `id`='".$dataSms['id']."')");
			
			mysql_query("delete from sms_q  where `id`='".$dataSms['id']."' ");
		if (empty($ret)) 
		{
			mysql_query("update sms_q set `status`='FAIL' where `id`='".$dataSms['id']."' ");
			
			mysql_query("insert into  sms_q_log  (select * from sms_q where `id`='".$dataSms['id']."')");
			
			mysql_query("delete from sms_q  where `id`='".$dataSms['id']."' ");
		// some kind of an error happened
			die(curl_error($ch));


			
		curl_close($ch); // close cURL handler
		} 
		else
		{
			$info = curl_getinfo($ch);
			curl_close($ch); // close cURL handler


			mysql_query("update sms_q set `status`='SENT' where `id`='".$dataSms['id']."' ");
			
			mysql_query("insert into  sms_q_log  (select * from sms_q where `id`='".$dataSms['id']."')");
			
			mysql_query("delete from sms_q  where `id`='".$dataSms['id']."' ");

		echo $curlresponse; //echo "Message Sent Succesfully" ;
	}
}
 }
 
 
 
 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/sms".date("Y-m-d_H").".csv";
     if(file_exists($log_file))
       {
         $LOGFILE_HANDLE = fopen($log_file,"a");
       }
     else
       {
         $LOGFILE_HANDLE = fopen($log_file,"w");
       }

     chmod($log_file,0755);
     $dataString = "\"".date("Y-m-d H:i:s")."\","."\"".$Query."\"";
     $dataString .= "\n";
     fwrite($LOGFILE_HANDLE,$dataString);
     fclose($LOGFILE_HANDLE);
     $dataString ="";
}

?>