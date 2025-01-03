<?php
require_once("dbconnect_emri.php");

$action	= $_REQUEST['type'];

switch($action)
{
   case 'SaveGrievance':
	
		$call_id		= $_REQUEST['call_id'];
		$agent_id		= $_REQUEST['agent_id'];
		$beneficiary_id		= $_REQUEST['beneficiary_id'];
                $source   	        = $_REQUEST['source'];
                $date		        = $_REQUEST['date'];
                $grievance_type         = $_REQUEST['grievance_type'];
                $nature         	= $_REQUEST['nature'];
                $name                	= $_REQUEST['name'];
                $mobile1               	= $_REQUEST['mobile1'];
                $mobile2         	= $_REQUEST['mobile2'];
                $email                 	= $_REQUEST['email'];
                $branch                 = $_REQUEST['branch'];
                $residential_address    = $_REQUEST['residential_address'];
                $brief_application      = $_REQUEST['brief_application'];

		$state			= $_REQUEST['state'];
		$area                  	= $_REQUEST['area'];
		$contact_no		= $_REQUEST['contact_no'];
		$email			= $_REQUEST['email'];

		$district_id		= explode("~",$_REQUEST['district_id']);
		$block_id		= explode("~",$_REQUEST['block_id']);
		$village_id		= explode("~",$_REQUEST['village_id']);
		
		$aadhar_no		= $_REQUEST['aadhar_no'];
	
		$call_type		= $_REQUEST['call_type'];		

		$Query  = "SELECT call_id FROM grievance WHERE call_id='".$call_id."'";
		$Result = mysql_query($Query);
		$Details = mysql_num_rows($Result);
		if($Details >0)
		 {
		 	$Query = "UPDATE grievance SET agent_id='".$agent_id."', beneficiary_id='".$beneficiary_id."', contact_no='".$contact_no."', call_id='".$call_id."', aadhar_no='".$aadhar_no."', source='".$source."', grievance_type='".$grievance_type."', nature='".$nature."', name='".$name."', mobile1='".$mobile1."', mobile2='".$mobile2."', email='".$email."', area='".$area."', state='".$state."', district_id='".$district_id[0]."', district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', village_name='".$village_id[1]."', branch='".$branch."', residential_address='".$residential_address."', brief_application='".$brief_application."', call_type='".$call_type."' WHERE call_id ='".$call_id."'";

			mysql_query($Query);
			dblog($Query);
			echo "UPDATE";
		 }
		else
		 {
			$Query	= "INSERT INTO grievance SET agent_id='".$agent_id."', beneficiary_id='".$beneficiary_id."', contact_no='".$contact_no."', call_id='".$call_id."', aadhar_no='".$aadhar_no."', source='".$source."', grievance_type='".$grievance_type."', nature='".$nature."', name='".$name."', mobile1='".$mobile1."', mobile2='".$mobile2."', email='".$email."', area='".$area."', state='".$state."', district_id='".$district_id[0]."', district_name='".$district_id[1]."', block_id='".$block_id[0]."', block_name='".$block_id[1]."', village_id='".$village_id[0]."', village_name='".$village_id[1]."', branch='".$branch."', residential_address='".$residential_address."', brief_application='".$brief_application."', call_type='".$call_type."'";

			mysql_query($Query);
			dblog($Query);			
			echo "INSERT";
		 }
    break;
	
   case 'SaveCMODetails':

	$call_id        = $_POST['call_id'];
	$cmo_contact    = $_POST['cmo_contact'];
	$cmo_name       = $_POST['cmo_name'];
	$emergency_type = $_POST['emergency_type'];


        $Query = "SELECT count(*) FROM grievance WHERE call_id ='".$call_id."';";
        $Result = mysql_query($Query);
        $count  = mysql_num_rows($Result);

        if($count = 0)
         {
            $Query1 = "INSERT INTO grievance SET call_id='".$call_id."', emergency_type='".$emergency_type."', cmo='".$cmo_name."', cmo_contact='".$cmo_contact."';";
                mysql_query($Query1);
         }
        else
         {
            $Query1 = "UPDATE grievance SET emergency_type='".$emergency_type."', cmo='".$cmo_name."', cmo_contact='".$cmo_contact."' WHERE call_id = '".$call_id."';";
                mysql_query($Query1);
         }

  break;
  
  
  
  
 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/gri_".date("Y-m-d_H").".csv";
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
