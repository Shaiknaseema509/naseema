<?php 
require_once("dbconnect_emri.php");


$phone_number = $_REQUEST['phone_number'];
$tableName = $_REQUEST['tableName'];
$keyText = $_REQUEST['keyText'];

//$sql= mysql_query("");

 $vba = explode('@@#@@',$keyText);
 $hName =  $vba[0];
 $hNo =  $vba[2];
 $hAdd =  $vba[1];
 

$smsTest ='નમસ્તે ! ૧૦૪ માં આપે જે બાબતે કોલ કર્યો હતો તે માટેની માહિતી નીચે પ્રમાણે છે.
Hospital Name : '.$hName.',
Address : '.$hAdd.',
Contact No : '.$hNo.'
આભાર.';

			//$mulSms = "91".$phone_number;
			$mulSms = "91".$phone_number;
			

			mysql_query("INSERT INTO `sms_queue` SET `sms_id`=1,`mobile_number`='".$mulSms."',`sms_template`='".$smsTest."',`entry_time`=NOW();");	
				$Query8_log_sms = "INSERT INTO `sms_queue` SET `sms_id`=1,`mobile_number`='".$mulSms."',`sms_template`='".$smsTest."',`entry_time`=NOW();";
		//	mysql_query("insert into emri.smsqueue set mobileno='".$vehicle_contact_number."',message='".$vehicleSms."',sent_time =now(),issmssent=1");	
			//mysql_query("insert into smsqueue set mobileno='".$vehicle_contact_number."',message='".$vehicleSms."',sent_time =now(),issmssent=1");	
			dblog($Query8_log_sms);
			

				
			//Please Enter Your Details
			$user="gvkemergency"; //your username
			$password="Emri@108"; //your password
			$mobilenumbers=$mulSms; //enter Mobile numbers comma seperated
			  $message = $smsTest; //enter Your Message
			//$senderid="GJEMRI"; //Your senderid
			$messagetype="LNG"; //Type Of Your Message
			$msgtype_list="N"; //Type Of Your Message
			$DReports="Y"; //Delivery Reports
			//$url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
			$message = urlencode($message);
			$url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$user."&pass=".$password."&senderid=GJEMRI&dest_mobileno=".$mulSms."&msgtype=TXT&message=".$message."&response=Y&dlttempid=1407161762148070733";
			
			$ch = curl_init();
			if (!$ch){die("Couldn't initialize a cURL handle");}
			$ret = curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			//curl_setopt ($ch, CURLOPT_POSTFIELDS,"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
			$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
			// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
			$curlresponse = curl_exec($ch); // execute
			if(curl_errno($ch))
			  echo 'curl error : '. curl_error($ch);
			if (empty($ret)) {
			// some kind of an error happened
			die(curl_error($ch));
			curl_close($ch); // close cURL handler
			} else {
			$info = curl_getinfo($ch);
			curl_close($ch); // close cURL handler
			  echo $curlresponse; //echo "Message Sent Succesfully" ;
			}



 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/sms_".date("Y-m-d_H").".csv";
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
			 