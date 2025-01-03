<?php error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$action	= $_POST['type'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

switch($action)
{
   case 'SaveBeneficiary':
   
	
		$Facility		= $_POST['Facility'];
		$cName		= $_POST['cName'];
		$call_id		= $_POST['call_id'];
		$agent_id		= $_POST['agent_id'];
		$spocname		= $_POST['spocname']; 
		$sEmail		= $_POST['sEmail']; 
		$spoccontact		= $_POST['spoccontact']; 
		//dblog($sEmail);
		
		$spoc		= explode("~",$_POST['spocname']);
		$spocId = $spoc[0];
		$spocName = $spoc[1];
		
		$rdate	= $_POST['rdate'];
		$gistofcomplaint			= $_POST['goc'];
		$goc   = mysql_real_escape_string($gistofcomplaint); 
		//$goc			= $_POST['goc'];
		$escalationboard		= $_POST['escalationboard'];
		$noc		= $_POST['noc'];
		//$Institute			= $_POST['Institute'];
		//$Designation			= $_POST['Designation'];
		$complaintagainst			= $_POST['complaintagainst'];
		$designation1			= $_POST['designation1'];
		$callerEmail			= $_POST['callerEmail'];
		$industryname			= $_POST['industryname'];
		$landmark			= $_POST['landmark'];
		$contact_no		= $_POST['contact_no'];
		$ro_remarks			= $_POST['remarks_ro'];
		$remarks_ro   = mysql_real_escape_string($ro_remarks);
		//$remarks_ro			= $_POST['remarks_ro'];
		$Others			= $_POST['Others'];
        //$residence			= $_POST['residence'];
		$district_id		= explode("~",$_POST['District']);
		$Facility		= explode("~",$_POST['Facility']);
		$facility_name		= explode("~",$_POST['facility_name']);
		$block_id		= explode("~",$_POST['tehsil1']);
		$village_id		= explode("~",$_POST['city_name1']); 
		//$uploadImage   = $_POST['uploadImage'];
		$file_name		= $_POST['file_name'];
		
		$Compliant	= $_POST['Compliant']; 
		$Department		= $_POST['Department'];
		$sector		= $_POST['sector'];
		$current_time = date('Y-m-d H:i:s');
		
		//$qu = mysql_query("select call_id from registration where call_id='".$call_id."'");
		$qu = mysql_query("select call_id,registration_id from registration_patient where contact_no='".$contact_no."'");		
		//dblog("select call_id,registration_id from registration_patient where contact_no='".$contact_no."'");
		$norows = mysql_num_rows($qu);
		//echo $norows;
		if($norows ==0  || $norows =='')
		{
			echo $norows; die;
		}
		
		$rdate = date('Y-m-d',strtotime($rdate));
		
		
		 
		$qu = mysql_query("select call_id from grievance where call_id='".$call_id."'");
		 
		
		$norows = mysql_num_rows($qu);
		//echo $norows;
		if($norows ==0  || $norows =='')
		{
			 mysql_set_charset('utf8');
			$Query_1	= "INSERT INTO grievance SET spocId='".$spocId."',call_id='".$call_id."', complaintId='".$Compliant."', Others='".$Others."',contact_no='".$contact_no."',agent_id='".$agent_id."',escalationboard='".$escalationboard."',
		complaintagainst='".$complaintagainst."',callerEmail='".$callerEmail."',industryname='".$industryname."',landmark='".$landmark."',remarks_ro='".mysql_escape_string($remarks_ro)."', designation1='".$designation1."',  facility_type_id='".$Facility[0]."',facility_id='".$facility_name[0]."',
		nComplaint='".$noc."',rDepartment='".$Department."',sector='".$sector."', gistComplatint='".mysql_escape_string($goc)."', rdate='".$rdate."',   district_id='".$district_id[0]."', 
		district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 
		village_name='".$village_id[1]."',mailstatus='0', `date`='".$current_time."',created_on=NOW()";
		 
		$d = mysql_query($Query_1);
		dblog($Query_1);
		}			
		else
		{			 
			$Query122	= "update grievance SET spocId='".$spocId."',call_id='".$call_id."',closed_by='".$agent_id."', `source`='Web-SSH',
		status='".$status."',closedTime=now(),spocremarks='".mysql_escape_string($spocremarks)."',file='".$file_name."',
        closed_remarks='".$escalationremarks."',caller_remarks='".$remarks."'		where call_id='".$call_id."'";
	 		
		
		}
			mysql_query($Query122);
		dblog(Query122);
		
		echo 111;
		
		$Query1232	= "insert into  escalationresult_live SET spocId='".$spocId."',dateTime=now(),escalationLevelId='".$escalationboard."',escalationLevelName='".$spocName."',
		agentId='".$agent_id."', callid='".$call_id."'";
		
			mysql_query($Query1232);
		dblog($Query1232);
		
		
		$Query123	= "insert into  grievanceEscalationLevel SET callid='".$call_id."',lastModfied=now(),levelNo='1'";
		
			mysql_query($Query123);
		dblog($Query123);
		
		$dateTime = $current_time; // Example date and time value
		$timestamp = strtotime($dateTime);
		$date = date('d-m-Y', $timestamp);
		//echo $date; // Output: 03-06-2024

		
		$complainName = mysql_fetch_array(mysql_query("SELECT `Name` FROM `m_complaint_type` WHERE ID='".$Compliant."';"));
		$userDetails = mysql_fetch_array(mysql_query("select contact_no,beneficiary_name,`district_name`,`block_name`,`village_name`,address from registration_patient where call_id ='".$call_id."'"));
		//$insDetails = mysql_fetch_array(mysql_query("select Name from m_institute where ID ='".$Institute."'"));
		$designationDetails = mysql_fetch_array(mysql_query("select Name from m_designation where ID ='".$Designation."'"));
		//$designationDetails = mysql_query(mysql_fetch_array("select contact_no,beneficiary_name from registration where call_id ='".$call_id."'"));
		
		
		//$url= 'http://202.131.123.37/emriview/grevenceview.php?ID='.$call_id;
		//$url= 'http://104gj.emri.in:8888/emriview/grevenceview.php?ID='.$call_id;
		$url= 'http://gjssh.emri.in:8888/emriview_ssh/grevenceview.php?ID='.$call_id;
		
		$message= '<table width="80%" border="1" cellpadding="10" cellspacing="0">
			<tr>
				<td><b>Date & Time</b></td>
				<td colspan ="2">'.date("Y-m-d H:i:s").'</td>
			</tr>
			<tr>
				<td><b>Registration Date</b></td>
				<td colspan ="2">'.$date.'</td>
			</tr>
			<tr>
				<td><b>Incident ID</b></td>
				<td colspan="2">'.$call_id.'</td>
			</tr>
			<tr>
				<td><b>Caller Name and Number</b></td>
				<td colspan="2"> '.$userDetails['beneficiary_name'].', '.$userDetails['contact_no'].'</td>
			</tr>
			<tr>
				<td><b>Complaint</b></td>
				<td colspan="2">'.$complainName ['Name'].'</td>
			</tr>
			<tr>
				<td><b>Complaint Against & Designation</b></td>
				<td colspan="2">'.$complaintagainst.' & '.$designation1.'</td>
			</tr>
			
			<tr>
				<td><b>Industry Name </b></td>
				<td colspan="2">'.$industryname.'</td>
			</tr>
			<tr>
				<td rowspan="2"><b>Industry Address </b></td>
				<td><b>LandMark </td>
				<td>'.$landmark.'</td>
			</tr>
			<tr>
				<td><b>Address_District_Taluka_Village</b></td>
				<td>'.$district_id[1].','.$block_id[1].','.$village_id[1].'  </td>
			</tr>
			<tr>
				<td rowspan="2"><b>Caller/Complainer Address </b></td>
				<td>LandMark </td>
				<td>'.$userDetails['address'].'</td>
			</tr>
              <tr>			
				<td><b>Address_District_Taluka_Village</b></td>
				<td>'.$userDetails['district_name'].','.$userDetails['block_name'].','.$userDetails['village_name'].'  </td>
			</tr>
			<tr>
				<td><b>Gist of Complaint</b></td>
				<td colspan="2">'.$goc.'</td>
			</tr>
			<tr>
				<td><b>URL</b></td>
				<td colspan="2">'.$url.'</td>
			</tr>
		</table>';
		//dblog($message);
		
		
		
		$mail = new PHPMailer();
$multipleEmails = array(
    'addlcommi-labour@gujarat.gov.in',
    'dycommi-admin-labour@gujarat.gov.in',
    'comp-labour@gujarat.gov.in'
);

$multipleEmail = array(
    'tushar_shroff@emri.in',
    'dr.dhaval26@gmail.com',
    'dhavalkumar_mandaliya@emri.in'
);

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'sskhelpline@emri.in'; // Your Gmail address
$mail->Password = 'Ssk@104$';//'vlui uvoh zoru laqi';  //'emws aaga jpdd iuxw'; // Your Gmail password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Sender and recipient settings
$mail->setFrom('sskhelpline@emri.in', 'Grievance Registered SSH level-1');
$mail->addAddress($sEmail,$sEmail);
foreach ($multipleEmails as $email) {
    $mail->addCC($email);
}
foreach ($multipleEmail as $emails) {
    $mail->addBCC($emails);
}

// dblog($sEmail);
 
// Email content
$mail->isHTML(true);
$mail->Subject = 'Grievance Registered';
$mail->Body = $message;

// Send email
if ($mail->send()) {
     mysql_query("insert into maillog set mailID='".$sEmail."',msg='".$message."',status='SENT',createdDate=now()"); 
	  mysql_query("update grievance set mailstatus =1 where call_id='".$call_id."' ");
	  
	 echo "Email sent successfully!";
}
else 
{ 
mysql_query("insert into maillog set mailID='".$sEmail."',msg='".$message."',status='FAIL',createdDate=now()"); 
 echo "Email delivery failed: " . $mail->ErrorInfo;
}
		
		
		
		
		/*ini_set("SMTP","mail.emri.in"); 
			ini_set("smtp_port","587");


			 
			if($sEmail !='')
			{
				$subject = 'Grievance Registered SSH level-1';

			$header = 'From:sskhelpline@emri.in' . "\r\n" ;
			$to .= 'TO:	'.$sEmail.' ' . "\r\n";  
			
			 
			$header .= 'Cc: tushar_shroff@emri.in' . "\r\n";
			$header .= 'Cc: sskhelpline@emri.in' . "\r\n";
	
			$header .= 'Cc:	dr.dhaval26@gmail.com' . "\r\n";
			$header .= 'Cc:	dhavalkumar_mandaliya@emri.in' . "\r\n";
			
			$header.= "MIME-Version: 1.0\r\n"; 
			$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
			$header.= "X-Priority: 1\r\n"; 

			 $tomails= $sEmail.',dhavalkumar_mandaliya@emri.in,dr.dhaval26@gmail.com';
			
			$status = mail($to, $subject, $message, $header);
			 
				if($status ==1)
				{ 
					mysql_query("insert into maillog set mailID='".$tomails."',msg='".$message."',status='SENT',createdDate=now()"); 
				}
				else 
				{ 
					mysql_query("insert into maillog set mailID='".$tomails."',msg='".$message."',status='FAIL',createdDate=now()"); 
				}
			}*/
			
			
			
			

			$sms = mysql_fetch_array(mysql_query("SELECT `smsUser`, `smsPwd`, `smsSenderId` FROM m_sms_details where is_active=1"));

			 
			 
				//Please Enter Your Details
				$user=$sms['smsUser']; //your username
				$password=$sms['smsPwd']; //"XXXXXX"; //your password
				$senderid=$sms['smsSenderId'];  //"SMSCountry";
				#$smsmsg  ='Grievance Created '.$district_id[1].','.$block_id[1].','.$village_id[1].' , ID: '.$call_id.', Grievance View URL :'.$url.' - GUJ 104 GVK EMRI';
				#$smsmsg  ='Grievance Created '.$district_id[1].','.$block_id[1].' for '.$userDetails['beneficiary_name'].'; Grievance ID: '.$call_id.'. Requesting you to close within 20 days. Grievance View URL: '.$url.' – GJSSH EMRI';
				$smsmsg  ='Grievance Created '.$district_id[1].', '.$block_id[1].' for '.$userDetails['beneficiary_name'].' ID: '.$call_id.'.kindly close within 20 days.URL: http://gjssh.emri.in:8888/emriview_ssh/grevenceview.php?ID='.$call_id.' -GJSSH EMRI';
				
					$dataSms['mobile'] = $spoccontact; // '9949839898';
					//$mobilenumbers= "91".$dataSms['mobile'].",919824009040"; 
					$mobilenumbers= "91".$dataSms['mobile'].""; 
					$message = $smsmsg;  //"test messgae"; //enter Your Message
					 //Your senderid
					 $dlttempname="1407166696232797282";
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
			$url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$user."&pass=".$password."&senderid=GJEMRI&dest_mobileno=".$mulSms."&msgtype=TXT&message=".$message."&response=Y&dlttempid=1407166696232797282";
			
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
			 
			
			
			//calller sms start 
			# $smsmsg1  ='104HHL Grievance : We have registered your Grievance in 104 HHL with Reference Number -  '.$call_id.' we will get back to you with resolution within 7 Days, Thanks for calling 104 Health Helpline. - 104-GJEMRI';
			 $smsmsg1  ='Shramik Grievance: Your Grievance with Reference Number - '.$call_id.' is registered and we will get back to you with a resolution within 20 Days, Thanks for calling Shramik Sahayak Helpline – GJSSH EMRI';
				
					$dataSms['mobile'] = $spoccontact; // '9949839898';
					$mobilenumbers= "91".$contact_no.",919824009040"; //  "919XXXXXXXXX"; //enter Mobile numbers comma seperated
					$message = $smsmsg1;  //"test messgae"; //enter Your Message
					 
					 $dlttempname="1407166625677210104";
 
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
			$url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$user."&pass=".$password."&senderid=GJEMRI&dest_mobileno=".$mulSms."&msgtype=TXT&message=".$message."&response=Y&dlttempid=1407166625677210104";
			
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
						 
						 
						 
						 
					$ms= "insert into  sms_q_log  set `mobile_number`='".$contact_no."',`sms_template`='".$smsmsg1."',`push_time`=NOW(),`sent_time`=NOW(),`sms_status`='sent',`transaction_id`='".$curlresponse."'";
					dblog($ms);
					mysql_query("insert into  sms_q_log  set `mobile_number`='".$contact_no."',`sms_template`='".$smsmsg1."',`push_time`=NOW(),`sent_time`=NOW(),`sms_status`='sent',`transaction_id`='".$curlresponse."'");
			
			
			
		
		
		
		
		 $Query = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query);
		 
    break;
	
	
	
	
	case 'updategreven':   
		
		
		$escalationremarks		= $_POST['escalationremarks'];
		$remarks		= $_POST['remarks'];
		$status		= $_POST['status'];
		$escalationID		= $_POST['escalationID'];
		$spocremarks		= $_POST['spocremarks'];
		
		$escalationboard		= $_POST['escalationboard'];
		$call_id		= $_POST['call_id'];		
		$agent_id		= $_POST['agent_id'];
		$spocname		= $_POST['spocname']; 
		$rdate	= $_POST['rdate'];
		$goc			= $_POST['goc'];
		$noc		= $_POST['noc'];
		//$Institute			= $_POST['Institute'];
		//$Designation			= $_POST['Designation'];
		$complaintagainst			= $_POST['complaintagainst'];
		$designation1			= $_POST['designation1'];
		$callerEmail			= $_POST['callerEmail'];
		$industryname			= $_POST['industryname'];
		$landmark			= $_POST['landmark'];
		$remarks_ro			= $_POST['remarks_ro'];
		$contact_no		= $_POST['contact_no'];
        $Others			= $_POST['Others'];
		//$residence			= $_POST['residence'];
		$district_id		= explode("~",$_POST['District']);
		$block_id		= explode("~",$_POST['tehsil1']);
		$village_id		= explode("~",$_POST['city_name1']); 
		$Facility		= explode("~",$_POST['Facility']);
		$facility_name		= explode("~",$_POST['facility_name']);
		$file_name		= $_POST['file_name'];
		
		$Compliant	= $_POST['Compliant']; 
	    $Department	= $_POST['Department']; 
		$sector		= $_POST['sector'];
		
		
		
		 $query1 = mysql_query("select call_id from registration_patient where call_id='".$call_id."'");
		 dblog($query1);
		//echo "$file_name".$file_name;
		
		$norows = mysql_num_rows($query1);
		echo $norows;
		if($norows ==0  || $norows =='')
		{
			echo $norows; die;
		}
		
		$rdate = date('Y-m-d',strtotime($rdate));
		
		
		 
		$qu1 = mysql_query("select call_id from grievance where call_id='".$call_id."'");
		dblog('case2'+ $qu1);
		$norows = mysql_num_rows($qu1);
		if($norows ==0  || $norows =='')
		{
			$Query1233	= "INSERT INTO grievance SET call_id='".$call_id."',spocId='".$spocId."', complaintId='".$Compliant."', Others='".$Others."',contact_no='".$contact_no."',agent_id='".$agent_id."',escalationboard='".$escalationboard."',
		complaintagainst='".$complaintagainst."',callerEmail='".$callerEmail."',industryname='".$industryname."',landmark='".$landmark."',remarks_ro='".$remarks_ro."', designation1='".$designation1."',  facility_type_id='".$Facility[0]."',facility_id='".$facility_name[0]."',
		nComplaint='".$noc."',rDepartment='".$Department."',sector='".$sector."', gistComplatint='".$goc."', rdate='".$rdate."',   district_id='".$district_id[0]."', 
		district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 
		village_name='".$village_id[1]."', `date`=NOW(),created_on=NOW()";
		$d = mysql_query($Query1233);
		dblog($Query1233);
		}			
		else
		{			 
			$Query1234	= "update grievance SET spocId='".$spocId."',call_id='".$call_id."',closed_by='".$agent_id."', `source`='Web-SSH',
		status='".$status."',closedTime=now(),spocremarks='".mysql_escape_string($spocremarks)."',file='".$file_name."',
         closed_remarks='".$escalationremarks."',caller_remarks='".$remarks."'		where call_id='".$call_id."'";	
		
		//echo "===>>>>". $Query123; 
		
		}
			mysql_query($Query1234);
		dblog('updategreven'+ $Query1234);
		
		
	
		
		
		if($status == 'CLOSED')
		{
			mysql_query("update grievance set status='$status',closed_by='$agent_id' where call_id=$call_id");
		}
		else
		{
				$Query123	= "insert into  escalationresult_live SET dateTime=now(),escalationLevelId='$escalationID',
		escalationRemarks='".$escalationremarks."',remarks='".$remarks."',escalationLevelName='".$spocName."',agentId='".$agent_id."', callid='".$call_id."'";
		
			mysql_query($Query123);
			dblog('case2'+ $Query123);
		}
		
		
		echo 111;
		
		
		 //$Query = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
		//mysql_query($Query);
		 
    break;
	
	case 'updategrevence': 
	
		//print_r($_POST);
	    $spocId = $_POST['spocname_id'];
		 //  dblog($spocId);
		$escalationremarks		= $_POST['escalationremarks'];
		$remarks		= $_POST['remarks'];
		$status		= $_POST['status'];
		$escalationID		= $_POST['escalationID'];
		$spocremarks		= $_POST['spocremarks'];
		
		
		//$call_id		= $_POST['call_id'];		
		$call_id		= $_POST['call_id'];	
	//	dblog($call_id);
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
        $spocremarks   = $_POST['spocremarks']; 
		$remarks = $_POST['spocremarks'];
		$escalationremarks =  $_POST['escalationremarks'];		
		
	    $temp_sql = "select call_id from registration_patient where call_id='".$call_id."'";
		$qu = mysql_query($temp_sql);
		
		$norows = mysql_num_rows($qu);
		if($norows ==0  || $norows =='')
		{
			echo $norows;
		}
		
		$rdate = date('Y-m-d',strtotime($rdate));
		
		 $query12 = "select call_id from grievance where call_id='".$call_id."'";
		 
	$qu = mysql_query($query12);
		
		$norows = mysql_num_rows($qu);
		
		if($norows ==0  || $norows =='')
		{
			$Query123	= "INSERT INTO grievance SET call_id='".$call_id."', complaintId='".$Compliant."',contact_no='".$contact_no."',agent_id='".$agent_id."',
		complaintagainst='".$complaintagainst."', Designation='".$Designation."', institue='".$Institute."', facility_id='".$Facility."', 
		nComplaint='".$noc."', gistComplatint='".$goc."', rdate='".$rdate."',   district_id='".$district_id[0]."', 
		district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 
		village_name='".$village_id[1]."', `date`=NOW(),created_on=NOW()";
		$d = mysql_query($Query123);
		dblog('case3'+ $Query123);
		}			
		else
		{			 
		 $Query12345	= "update grievance SET closed_by='".$agent_id."', `source`='Web-SSH',
		status='".$status."',closedTime=now(),spocremarks='".mysql_escape_string($spocremarks)."',
        closed_remarks='".$escalationremarks."',caller_remarks='".$remarks."' where call_id='".$call_id."'";	
		
		}
			mysql_query($Query12345);
		dblog('case4'+ $Query12345);
		
		
	
		
		
		if($status == 'CLOSED')
		{
			mysql_query("update grievance set status='$status' where call_id=$call_id");
		}
		else
		{
				$Query1234	= "insert into  escalationresult SET dateTime=now(),escalationLevelId='$escalationID',
		escalationRemarks='".$escalationremarks."',remarks='".$remarks."',escalationLevelName='',agentId='".$agent_id."', callid='".$call_id."'";
		
			mysql_query($Query1234);
			dblog('case5'+ $Query1234);
			mysql_query("insert into grievanceescalationlevel set lastModfied=now(),`status`=0,callid='".$call_id."',levelNo='1' ");
		}
		 
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
