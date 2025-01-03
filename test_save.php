<?php error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$action	= $_POST['type'];

switch($action)
{
   case 'SaveBeneficiary':
   
	
		//$Facility		= $_POST['Facility'];
		$call_id		= $_POST['call_id'];
		$agent_id		= $_POST['agent_id'];
		$spocname		= $_POST['spocname']; 
		$sEmail		= $_POST['sEmail']; 
		$spoccontact		= $_POST['spoccontact']; 
		dblog($sEmail);
		
		$spoc		= explode("~",$_POST['spocname']);
		$spocId = $spoc[0];
		$spocName = $spoc[1];
		
		$rdate	= $_POST['rdate'];
		$goc			= $_POST['goc'];
		$noc		= $_POST['noc'];
		$Institute			= $_POST['Institute'];
		$Designation			= $_POST['Designation'];
		$complaintagainst			= $_POST['complaintagainst'];
		$contact_no		= $_POST['contact_no'];
 
		$district_id		= explode("~",$_POST['District']);
		$Facility		= explode("~",$_POST['Facility']);
		$facility_name		= explode("~",$_POST['facility_name']);
		$block_id		= explode("~",$_POST['tehsil1']);
		$village_id		= explode("~",$_POST['city_name1']); 
		
		$Compliant	= $_POST['Compliant']; 
		
		//$qu = mysql_query("select call_id from registration where call_id='".$call_id."'");
 
		$rdate = date('Y-m-d',strtotime($rdate));
		
		
		 
		$qu = mysql_query("select call_id from grievance where call_id='".$call_id."'");
		 
		
		$norows = mysql_num_rows($qu);
		if($norows ==0  || $norows =='')
		{
			$Query123	= "INSERT INTO grievance SET spocId='".$spocId."',call_id='".$call_id."', complaintId='".$Compliant."',contact_no='".$contact_no."',agent_id='".$agent_id."',
		complaintagainst='".$complaintagainst."', Designation='".$Designation."', institue='".$Institute."', facility_type_id='".$Facility[0]."',facility_id='".$facility_name[0]."',
		nComplaint='".$noc."', gistComplatint='".$goc."', rdate='".$rdate."',   district_id='".$district_id[0]."', 
		district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 
		village_name='".$village_id[1]."', `date`=NOW()";
		
		echo "INSERT INTO grievance SET spocId='".$spocId."',call_id='".$call_id."', complaintId='".$Compliant."',contact_no='".$contact_no."',agent_id='".$agent_id."',
		complaintagainst='".$complaintagainst."', Designation='".$Designation."', institue='".$Institute."', facility_type_id='".$Facility[0]."',facility_id='".$facility_name[0]."',
		nComplaint='".$noc."', gistComplatint='".$goc."', rdate='".$rdate."',   district_id='".$district_id[0]."', 
		district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 
		village_name='".$village_id[1]."', `date`=NOW()";
		 
		//$d = mysql_query($Query123);
		}			
		else
		{			 
			$Query123	= "update grievance SET spocId='".$spocId."',complaintId='".$Compliant."',contact_no='".$contact_no."',agent_id='".$agent_id."',
		complaintagainst='".$complaintagainst."', Designation='".$Designation."', institue='".$Institute."', facility_id='".$Facility[0]."',facility_id='".$facility_name[0]."',
		nComplaint='".$noc."', gistComplatint='".$goc."', rdate='".$rdate."',   district_id='".$district_id[0]."', 
		district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 
		village_name='".$village_id[1]."' where call_id='".$call_id."'";
	 		
		
		}
			mysql_query($Query123);
		dblog($Query123);
		
		echo 111;
		
		$Query123	= "insert into  escalationresult SET spocId='".$spocId."',dateTime=now(),escalationLevelId='1',escalationLevelName='".$spocName."',
		agentId='".$agent_id."', callid='".$call_id."'";
		
			mysql_query($Query123);
		dblog($Query123);
		
		
		$Query123	= "insert into  grievanceEscalationLevel SET callid='".$call_id."',lastModfied=now(),levelNo='1'";
		
			mysql_query($Query123);
		dblog($Query123);
		
		
		
		
		$userDetails = mysql_fetch_array(mysql_query("select contact_no,beneficiary_name from registration where call_id ='".$call_id."'"));
		$insDetails = mysql_fetch_array(mysql_query("select Name from m_institute where ID ='".$Institute."'"));
		$designationDetails = mysql_fetch_array(mysql_query("select Name from m_designation where ID ='".$Designation."'"));
		//$designationDetails = mysql_query(mysql_fetch_array("select contact_no,beneficiary_name from registration where call_id ='".$call_id."'"));
		
		
		//$url= 'http://202.131.123.37/emriview/grevenceview.php?ID='.$call_id;
		$url= 'http://104gj.emri.in:8888/emriview/grevenceview.php?ID='.$call_id;
		
		$message= '<table width="98%" border="1" cellpadding="10" cellspacing="10">
			<tr>
				<td>Date & Time</td>
				<td>'.date("Y-m-d H:i:s").'</td>
			</tr>
			<tr>
				<td>Incident ID</td>
				<td>'.$call_id.'</td>
			</tr>
			<tr>
				<td>Caller Name and Number</td>
				<td> '.$userDetails['beneficiary_name'].', '.$userDetails['contact_no'].'</td>
			</tr>
			<tr>
				<td>Complaint Against & Designation</td>
				<td>'.$complaintagainst.' & '.$designationDetails['Name'].'</td>
			</tr>
			<tr>
				<td>Institute Name</td>
				<td>'.$insDetails['Name'].'</td>
			</tr>
			<tr>
				<td>Address_District_Taluka_Village</td>
				<td>'.$district_id[1].','.$block_id[1].','.$village_id[1].'  </td>
			</tr>
			<tr>
				<td>Gist of Complaint</td>
				<td>'.$goc.'</td>
			</tr>
			<tr>
				<td>URL</td>
				<td>'.$url.'<td>
			</tr>
		</table>';
		
		
		
		
		
		ini_set("SMTP","mail.emri.in"); 
			ini_set("smtp_port","587");


			 
			if($sEmail !='')
			{
				$subject = 'Grievance';
//$message = ' ';
			#$header = 'From:rameshbabu_m@emri.in' . "\r\n" ;
			$header = 'From:gj_104healthhelpline@emri.in' . "\r\n" ;
			//$to      = $sEmail;  
			$to = 'tushar_shroff@emri.in';
			 
			$header .= 'Cc: tushar_shroff@emri.in' . "\r\n";
			//$header .= 'Cc:	rameshbabu_m@emri.in ' . "\r\n";
			
			$header.= "MIME-Version: 1.0\r\n"; 
			$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
			$header.= "X-Priority: 1\r\n"; 

			 
			
			$status = mail($to, $subject, $message, $header);
			 
				if($status ==1)
				{ 
					mysql_query("insert into maillog set mailID='".$sEmail."',msg='".$message."',status='SENT',createdDate=now()"); 
				}
				else 
				{ 
					mysql_query("insert into maillog set mailID='".$sEmail."',msg='".$message."',status='FAIL',createdDate=now()"); 
				}
			}
			
			
			
			

			$sms = mysql_fetch_array(mysql_query("SELECT `smsUser`, `smsPwd`, `smsSenderId` FROM m_sms_details where is_active=1"));

			 
			 
				//Please Enter Your Details
				$user=$sms['smsUser']; //your username
				$password=$sms['smsPwd']; //"XXXXXX"; //your password
				$senderid=$sms['smsSenderId'];  //"SMSCountry";
				#Grievance Created {#var#}{#var#}{#var#}{#var#} , ID: {#var#}, Grievance View URL :http://104gj.emri.in:8888/emriview/grevenceview.php?ID={#var#} - GUJ 104 GVK EMRI
				#$smsmsg  ='Grievance Created '.$district_id[1].','.$block_id[1].','.$village_id[1].'   , ID:'.$call_id.', Grievance View URL :'.$url;
				$smsmsg  ='Grievance Created '.$district_id[1].','.$block_id[1].','.$village_id[1].' , ID: '.$call_id.', Grievance View URL :'.$url.' - GUJ 104 GVK EMRI';
				
					$dataSms['mobile'] = $spoccontact; // '9949839898';
					$mobilenumbers= "91".$dataSms['mobile'].",919824009040"; //  "919XXXXXXXXX"; //enter Mobile numbers comma seperated
					$message = $smsmsg;  //"test messgae"; //enter Your Message
					 //Your senderid
					 $dlttempname="1407161761958480946";
/*
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
					"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports&dlttempid=1407161761958480946&msgtype=TXT");
					$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
					// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
					$curlresponse = curl_exec($ch); // execute
					 

					 if($curlresponse =='') $curlresponse =0;
					 
					//log(curl_errno($ch));
						 */
			$mulSms  =$mobilenumbers;			 
			$user="gvkemergency"; //your username
			$password="Emri@108"; //your password
			$mobilenumbers=$mulSms; //enter Mobile numbers comma seperated
			  //$message = $smsTest; //enter Your Message
			//$senderid="GJEMRI"; //Your senderid
			$messagetype="LNG"; //Type Of Your Message
			$msgtype_list="N"; //Type Of Your Message
			$DReports="Y"; //Delivery Reports
			//$url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
			$message = urlencode($message);
			$url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$user."&pass=".$password."&senderid=GJEMRI&dest_mobileno=".$mulSms."&msgtype=TXT&message=".$message."&response=Y&dlttempid=1407161761958480946";
			
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
						 
						 
						 
						 
					$ms= "insert into  sms_q_log  set `mobile_number`='".$dataSms['mobile']."',`sms_template`='".$smsmsg."',`push_time`=NOW(),`sent_time`=NOW(),`sms_status`='sent',`transaction_id`='".$curlresponse."'";
					dblog($ms);
					mysql_query("insert into  sms_q_log  set `mobile_number`='".$dataSms['mobile']."',`sms_template`='".$smsmsg."',`push_time`=NOW(),`sent_time`=NOW(),`sms_status`='sent',`transaction_id`='".$curlresponse."'");
			 
			
			
			
		
		
		
		
		 $Query = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query);
		 
    break;
	
	
	
	
	case 'updategreven':   
	
		$escalationremarks		= $_POST['escalationremarks'];
		$remarks		= $_POST['remarks'];
		$status		= $_POST['status'];
		$escalationID		= $_POST['escalationID'];
		$spocremarks		= $_POST['spocremarks'];
		
		
		$call_id		= $_POST['call_id'];		
		$agent_id		= $_POST['agent_id'];
		$spocname		= $_POST['spocname']; 
		$rdate	= $_POST['rdate'];
		$goc			= $_POST['goc'];
		$noc		= $_POST['noc'];
		$Institute			= $_POST['Institute'];
		$Designation			= $_POST['Designation'];
		$complaintagainst			= $_POST['complaintagainst'];
		$contact_no		= $_POST['contact_no'];
 
		$district_id		= explode("~",$_POST['District']);
		$block_id		= explode("~",$_POST['tehsil1']);
		$village_id		= explode("~",$_POST['city_name1']); 
		
		$Compliant	= $_POST['Compliant']; 
 
		
		 
		$qu = mysql_query("select call_id from grievance where call_id='".$call_id."'");
		
		$norows = mysql_num_rows($qu);
 
			$Query123	= "INSERT INTO grievance SET call_id='".$call_id."', complaintId='".$Compliant."',contact_no='".$contact_no."',agent_id='".$agent_id."',
		complaintagainst='".$complaintagainst."', Designation='".$Designation."', institue='".$Institute."', 
		nComplaint='".$noc."', gistComplatint='".$goc."', rdate='".$rdate."',   district_id='".$district_id[0]."', 
		district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 
		village_name='".$village_id[1]."', `date`=NOW()";
		$d = mysql_query($Query123);
	 			 
 
	 
			mysql_query($Query123);
		dblog($Query123);
		
		
	
		
		
		if($status ='CLOSED')
		{
			mysql_query("update grievance set status='$status' where call_id=$call_id");
		}
		else
		{
				$Query123	= "insert into  escalationresult SET dateTime=now(),escalationLevelId='$escalationID',
		escalationRemarks='".$escalationremarks."',remarks='".$remarks."',escalationLevelName='',agentId='".$agent_id."', callid='".$call_id."'";
		
			mysql_query($Query123);
			dblog($Query123);
		}
		
		
		echo 111;
		
		
		 //$Query = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
		//mysql_query($Query);
		 
    break;
	
	 
	
}



 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/gre_".date("Y-m-d_H").".csv";
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
