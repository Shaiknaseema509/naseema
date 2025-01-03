<?php
error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$action	= $_POST['type'];

switch($action)
{
   case 'SaveBeneficiary':
	
		$call_id		= $_POST['call_id'];
		$agent_id		= $_POST['agent_id'];
		$beneficiary_id		= $_POST['beneficiary_id'];
		$beneficiary_name	= $_POST['beneficiary_name'];
		$benificiery_surname	= $_POST['benificiery_surname'];
		$beneficiary_lname	= $_POST['beneficiary_lname'];
		$age			= $_POST['age'];
		$age_type		= $_POST['age_type'];
		$Gender			= $_POST['Gender'];
		$mother			= $_POST['mother'];
		$state			= $_POST['state'];
		$contact_no		= $_POST['contact_no'];

		$language_id		= explode("~",$_POST['language_id']);
		$district_id		= explode("~",$_POST['district_id']);
		$block_id		= explode("~",$_POST['block_id']);
		$village_id		= explode("~",$_POST['village_id']);
		$caste			= explode("~",$_POST['caste']);
		$education_id		= explode("~",$_POST['education_id']);
		$occupation_id		= explode("~",$_POST['occupation_id']);
		$marital_status_id	= explode("~",$_POST['marital_status_id']);
		$relationship_id	= explode("~",$_POST['relationship_id']);
		
		$registration_id	= $_POST['registration_id'];
		$aadhar_uid_no		= $_POST['aadhar_uid_no'];
		$address		= $_POST['address'];
		
		//$address	= explode("'",$_POST['address']);
		
		$dob		= $_POST['dob'];
		$ano		= $_POST['ano'];
		
		if($ano =='') $ano=0;
		if($dob =='') $dob=0;
		if($caste[1] =='') $caste[1]='0';
		
		
	
		$qu = mysql_query("select call_id,registration_id from registration where contact_no='".$contact_no."'");
		
		$norows = mysql_num_rows($qu);
		$databid = mysql_fetch_array($qu);
		if($norows ==0  || $norows =='')
		{
		$Q = "SELECT md_dsid FROM m_mandal WHERE is_active=1 AND md_mdid='".$block_id[0]."' ORDER BY md_lname ASC";
		$Q = mysql_query($Q);
		if()
		$Query123	= "INSERT INTO registration SET call_id='".$call_id."', aPhoneno='".$ano."',dob='".$dob."',agent_id='".$agent_id."',beneficiary_last='".$beneficiary_lname."', beneficiary_name='".$beneficiary_name."', benificiery_surname='".$benificiery_surname."', 		age='".$age."', age_type='".$age_type."', Gender='".$Gender."', mother='".$mother."',  district_id='".$district_id[0]."', 		district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 		village_name='".$village_id[1]."', contact_no='".$contact_no."', language_id=0, education_id=0, 		occupation_id=0, marital_status_id=0, relationship_id=0, caste_id=0,		caste_name='0', registered_contact_no='".$contact_no."',aadhar_uid_no='".$aadhar_uid_no."', address='".mysql_escape_string($address)."', createdon=NOW()";
		$d = mysql_query($Query123);
		$bID =  mysql_insert_id();
		}			
		else
		{			 
			$Query123	= "update registration SET aPhoneno='".$ano."',dob='".$dob."',agent_id='".$agent_id."',		beneficiary_last='".$beneficiary_lname."', beneficiary_name='".$beneficiary_name."', benificiery_surname='".$benificiery_surname."', 		age='".$age."', age_type='".$age_type."', Gender='".$Gender."', mother='".$mother."',  district_id='".$district_id[0]."', 		district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 		village_name='".$village_id[1]."',  language_id=0, education_id=0, 		occupation_id=0, marital_status_id=0, relationship_id=0, caste_id=0, 		caste_name='0', registered_contact_no='".$contact_no."',aadhar_uid_no='".$aadhar_uid_no."', address='".mysql_escape_string($address)."' where contact_no=".$contact_no;			
			mysql_query($Query123);
		}
			
		
		//mysql_query($Query123);
		
		//$bID = mysql_insert_id();
		//if($bID =='' || $bID ==0) $bID = $databid['registration_id'];
		
		
		//$qu = mysql_query("select call_id,registration_id from registration where contact_no='".$contact_no."'");
		
		//$norows = mysql_num_rows($qu);
		//$databid = mysql_fetch_array($qu);
		//$bID = $databid['registration_id'];
		
		echo $bID;
		
		dblog($Query123);
		$Queryw	= "INSERT INTO registration_patient SET call_id='".$call_id."', aPhoneno='".$ano."',dob='".$dob."',agent_id='".$agent_id."',		beneficiary_last='".$beneficiary_lname."', beneficiary_name='".$beneficiary_name."', benificiery_surname='".$benificiery_surname."', 		age='".$age."', age_type='".$age_type."', Gender='".$Gender."', mother='".$mother."',  district_id='".$district_id[0]."',district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', 		village_name='".$village_id[1]."', contact_no='".$contact_no."', language_id=0, education_id=0,occupation_id=0, marital_status_id=0, relationship_id=0, caste_id=0,caste_name='0', registered_contact_no='".$contact_no."',aadhar_uid_no='".$aadhar_uid_no."', address='".$address."', createdon=NOW()";
		mysql_query($Queryw);
		dblog($Queryw);
		
    break;
	
	
	
	case 'fever104assignment':
		//echo 333333333; die;
		$cheifcomplaintf = $_POST['cheifcomplaintf'];
		$othercomplaints = $_POST['othercomplaints'];
		$complaintf = $_POST['complaintf'];
		$feversince = $_POST['feversince'];
		$agencyassignedf = $_POST['agencyassignedf1'];
		$remarks = $_POST['remarks'];
		$agencycontact = $_POST['agencycontact'];
		$callid = $_POST['callid'];		
		$ass = $_POST['ass'];
		$assign108 = $_POST['assign108'];
		$cl_CallType = $_POST['reason'];
		$ass = $_POST['ass'];
		$levels = $_POST['levels'];
		
			$area   	= $_POST["area_id"];
			$area_array 	= explode("~",$area);
			$agencyassignedf1q 	= explode("~",$agencyassignedf);
		$agencyassignedf1=$agencyassignedf1q[0];
		if($ass ==1)
		{
			$Query	= "INSERT INTO callincidentinfoemg SET agency_id='".$agencyassignedf1."',cl_callid='".$callid."', datetimes=now(),cl_callremarks='".$remarks."',
		feverdays='".$feversince."',complaint='".$complaintf."',remarks='".$remarks."',chiefcomplaint='".$cheifcomplaintf."',othercomplaints='".$othercomplaints."'";
			mysql_query($Query);
			
			$Query	= "INSERT INTO agency_assigned SET callid='".$callid."', agency='".$agencyassignedf1."',assigneddtm=now(),agent_id='".$agent_id."',
		mobileno='".$agencycontact."'";
			mysql_query($Query);
		}
		else
		{
			  $Query	= "INSERT INTO callincidentinfononemg SET cl_CallType='".$agencyassignedf1."',
			 agency_id='".$agencyassignedf1."',cl_callid='".$callid."',datetimes=now(),cl_callremarks='".$remarks."'";
			mysql_query($Query);
			
			 $area_id       = $area_array[0]; 
			 
			   $call_type = "SELECT `Agency_id`, `Agency_Name`,Mobile FROM `m_agency_details` WHERE isactive=1 and area_id='$area_id' 
			   and Level_No='$levels' ORDER BY Agency_Name ASC ;";
			$villages_detail = mysql_query($call_type);
			 
			 
		   echo "<option value=''>Select Agency Name</option>";
			while($villages_details=mysql_fetch_array($villages_detail))
			 { 
				echo "<option value='".$villages_details["Agency_id"]."~".$villages_details["Mobile"]."' >".$villages_details["Agency_Name"]."</option>";
			 }
		} 
	
	break;



	
}



 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/ben_".date("Y-m-d_H").".csv";
     if(file_exists($log_file))
       {
         $LOGFILE_HANDLE = fopen($log_file,"a");
       }
     else
       {
         $LOGFILE_HANDLE = fopen($log_file,"w");
       }

     chmod($log_file,0755);
     $dataString = "\"".date("Y-m-d H:i:s")."\",     "."\"".$Query."\"";
     $dataString .= "\n";
     fwrite($LOGFILE_HANDLE,$dataString);
     fclose($LOGFILE_HANDLE);
     $dataString ="";
}	
 


?>
