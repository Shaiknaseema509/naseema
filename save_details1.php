<?php
error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$action	= $_POST['type'];

switch($action)
{
case 'ineffective':

 		$call_type = $_POST['call_type'];
		$callid = $_POST['callid'];
		
		$Query345	= "update call_incident_info set call_end_time = NOW(),call_type_id='".$call_type."',`process`='Teleinef' where callid ='".$callid."' ";
		//echo "update call_incident_info set call_end_time = NOW(),call_type_id='".$call_type."',`process`='Tele' where callid ='".$callid."'";
		//echo "INSERT INTO `telemedicine` SET `callid`='".$callid."',beneficiary_id='".$beneficiary_id."',call_type_id='".$call_type."',system_diagnosis='".$sysdig."',doctor_id='".$sysdoc."',doctor_advice='".$abdbdoctor."',specility_advice='".$adbsp."',medicine_prescribed='".$medp."',remarks='".$medprem."',agent_id='".$agent_id."'";
		mysql_query($Query345);
		dblog($Query345);
break;


case 'save_telemedicine':
 		$beneficiary_id = $_POST['beneficiary_id'];
 		$call_type = $_POST['call_type'];
		$callid = $_POST['callid'];
		$sysdig = $_POST['sysdig']; 
		$sysdoc = $_POST['sysdoc']; 
		$abdbdoctor = $_POST['abdbdoctor'];
		$adbsp = $_POST['adbsp'];
		$medp = $_POST['medp'];
		$medprem = $_POST['medprem'];	
		$agent_id = $_POST['agent_id'];	
		$mhu = $_POST['mhu'];	
		$lab_test = $_POST['lab_test'];	
		$doctor_type= explode("~",$_POST['doctor_type']);
		
		if($mhu =='') $mhu =0;
		if($sysdig =='') $sysdig =0;
		if($sysdoc =='') $sysdoc =0;
		if($abdbdoctor =='') $abdbdoctor =0;
		if($adbsp =='') $adbsp =0;
		if($medp =='') $medp =0;
		if($medprem =='') $medprem =0;			
		if($agent_id =='') $agent_id =0;			

 	
 
		$Query345	= "INSERT INTO `telemedicine` SET `callid`='".$callid."',beneficiary_id='".$beneficiary_id."',call_type_id='".$call_type."',system_diagnosis='".$sysdig."',doctor_id='".$sysdoc."',doctor_advice='".$abdbdoctor."',specility_advice='".$adbsp."',medicine_prescribed='".$medp."',remarks='".$medprem."',agent_id='".$agent_id."',lab_test='".$lab_test."',doctor_type='".$doctor_type[0]."'";
		echo "INSERT INTO `telemedicine` SET `callid`='".$callid."',beneficiary_id='".$beneficiary_id."',call_type_id='".$call_type."',system_diagnosis='".$sysdig."',doctor_id='".$sysdoc."',doctor_advice='".$abdbdoctor."',specility_advice='".$adbsp."',medicine_prescribed='".$medp."',remarks='".$medprem."',agent_id='".$agent_id."',lab_test='".$lab_test."',doctor_type='".$doctor_type[0]."'";
		mysql_query($Query345);
		dblog($Query345);
		
		$Query345	= "update call_incident_info set call_end_time = NOW(),call_type_id='".$call_type."',`process`='Tele' where callid ='".$callid."' ";
		//echo "update call_incident_info set call_end_time = NOW(),call_type_id='".$call_type."',`process`='Tele' where callid ='".$callid."'";
		//echo "INSERT INTO `telemedicine` SET `callid`='".$callid."',beneficiary_id='".$beneficiary_id."',call_type_id='".$call_type."',system_diagnosis='".$sysdig."',doctor_id='".$sysdoc."',doctor_advice='".$abdbdoctor."',specility_advice='".$adbsp."',medicine_prescribed='".$medp."',remarks='".$medprem."',agent_id='".$agent_id."'";
		mysql_query($Query345);
		dblog($Query345);
			
 
	
	break;	
	
 
		case 'save_drug':
		$beneficiary_id = $_POST['beneficiary_id'];
		$callid = $_POST['callid'];
		$call_type =  $_POST['call_type'];
		

		$msgs ='';
		for($i=0;$i<=4;$i++)
		{
			$sysdig = $_POST['sysdig1_'.$i]; 
			$sysmed = $_POST['sysmed1_'.$i]; 
			$descsysmer = $_POST['descsysmer1_'.$i];
			$a=$i+1;
			if($sysdig !='')
			{			
				$Query123	= "INSERT INTO `telemedicine_drug` (`callid`,`beneficiary_id`,Sno,`drug_form_id`,`medicine_id`,`description`) 
				VALUES ('".$callid."','".$beneficiary_id."',".$a.",'".$sysdig."','".$sysmed."','".$descsysmer."')";
				
				echo "INSERT INTO `telemedicine_drug` (`callid`,`beneficiary_id`,Sno,`drug_form_id`,`medicine_id`,`description`) 
				VALUES ('".$callid."','".$beneficiary_id."',".$a.",'".$sysdig."','".$sysmed."','".$descsysmer."')";
				

				mysql_query($Query123);	 
 
				$ab= mysql_fetch_array(mysql_query("SELECT DrugForm FROM `tbldrugform` where `Id`='".$sysdig."'"));	
				$abc= mysql_fetch_array(mysql_query("SELECT `DrugName` FROM `tbldrugdetail` where `Id`='".$sysmed."'"));
				#$msgs .='Drug Details'.$ab["DrugForm"].', DrugName -'.$abc['DrugName'].', description- '.$descsysmer;	
				#$msgs ='Drug Details'.$ab["DrugForm"].', DrugName -'.$abc['DrugName'].', description- '.$descsysmer;	
				$msgs1 .= $ab["DrugForm"].$abc['DrugName'].$descsysmer;	
				dblog($Query123);	
				
						$Query345	= "update call_incident_info set call_end_time = NOW(),call_type_id='".$call_type."',`process`='Tele' where callid ='".$callid."'";
		//echo "update call_incident_info set call_end_time = NOW(),call_type_id='".$call_type."',`process`='Tele' where callid ='".$callid."'";
		//echo "INSERT INTO `telemedicine` SET `callid`='".$callid."',beneficiary_id='".$beneficiary_id."',call_type_id='".$call_type."',system_diagnosis='".$sysdig."',doctor_id='".$sysdoc."',doctor_advice='".$abdbdoctor."',specility_advice='".$adbsp."',medicine_prescribed='".$medp."',remarks='".$medprem."',agent_id='".$agent_id."'";
		mysql_query($Query345);
		dblog($Query345);
			}
					
		}	
		
		$msgs = "Drug Details -".$msgs1."For E-Sanjeevani Video Consultation https://play.google.com/store/apps/details?id=in.hied.esanjeevaniopd - GJEMRI";
		
		//1100 TelMed Gujarat Incident ID - {#var#} Drug Details -{#var#}{#var#}{#var#}{#var#}{#var#}{#var#}{#var#}
		
		$abcno= mysql_fetch_array(mysql_query("SELECT phone_number FROM `call_incident_info` where `callid`='".$callid."'"));		
		
//1100 TelMed Gujarat Incident ID 32326532, Drug DetailsCream, DrugName -Clobetasol Propionate 0.05% w/w, description- test-GUJ -100 Tel Med 			
#$smsTest ='1100 TelMed Gujarat Incident ID – '.$callid.' Drug Details – ('.$msgs.')';

$smsTest ='1100 TelMed Gujarat Incident ID - '.$callid.' '.$msgs; // .'-GUJ -100 Tel Med';
#$smsTest ='1100 TelMed Gujarat Incident ID '.$callid.', '.$msgs.'-GUJ -100 Tel Med';
#$smsTest ='1100 TelMed Gujarat Incident ID 12121, Drug DetailsSolution, DrugName -Dicyclomine HCL 10 mg/5ml, description- 5454';

			//$mulSms = "91".$phone_number;
			//$mulSms = "91".$abcno['phone_number']; //.$phone_number;
			$mulSms = "91".$abcno['phone_number']; //.$phone_number;
			

			mysql_query("INSERT INTO `sms_queue` SET `sms_id`=1,`mobile_number`='".$mulSms."',`sms_template`='".$smsTest."',`entry_time`=NOW();");	
				$Query8_log_sms = "INSERT INTO `sms_queue` SET `sms_id`=1,`mobile_number`='".$mulSms."',`sms_template`='".$smsTest."',`entry_time`=NOW();";
		//	mysql_query("insert into emri.smsqueue set mobileno='".$vehicle_contact_number."',message='".$vehicleSms."',sent_time =now(),issmssent=1");	
			//mysql_query("insert into smsqueue set mobileno='".$vehicle_contact_number."',message='".$vehicleSms."',sent_time =now(),issmssent=1");	
			dblogsms($Query8_log_sms);
			

				
			//Please Enter Your Details
			$user="gvkemergency"; //your username
			$password="Emri@108"; //your password
			$dlttempname="1407162547967948542"; //your password 1407161744401061167
			$mobilenumbers=$mulSms; //enter Mobile numbers comma seperated
			  $message = $smsTest; //enter Your Message
			//$senderid="GJEMRI"; //Your senderid
			$messagetype="LNG"; //Type Of Your Message
			$msgtype_list="N"; //Type Of Your Message
			$DReports="Y"; //Delivery Reports
			//$url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
			$message = urlencode($message);
			$url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$user."&pass=".$password."&senderid=GJEMRI&dest_mobileno=".$mulSms."&msgtype=TXT&message=".$message."&response=Y&dlttempid=1407162547967948542";
			
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
		
		
		
		
		break;	



	
}



 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/savedetails_".date("Y-m-d_H").".csv";
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

function dblogsms($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/smsteli".date("Y-m-d_H").".csv";
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
