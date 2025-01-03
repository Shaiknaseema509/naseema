<?php
require_once("dbconnect_emri.php");

$action	= $_REQUEST['type'];

switch($action)
{
   case 'SaveGovt':
	
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
		$Response_ID   		= $_REQUEST['Response_ID'];

		$district_id		= explode("~",$_REQUEST['district_id']);
		$block_id		= explode("~",$_REQUEST['block_id']);
		$village_id		= explode("~",$_REQUEST['village_id']);
		
		$aadhar_no		= $_REQUEST['aadhar_no'];
	
		$Query  = "SELECT call_id FROM govt_scheme_result WHERE call_id='".$call_id."'";
		$Result = mysql_query($Query);
		$Details = mysql_num_rows($Result);
		if($Details >0)
		 {
		 	$Query = "UPDATE govt_scheme_result SET govt_schemes_id='".$Response_ID."',agent_id='".$agent_id."', contact_no='".$contact_no."'  WHERE call_id ='".$call_id."'";

			mysql_query($Query);
			echo "UPDATE";
		 }
		else
		 {
			echo $Query	= "INSERT INTO govt_scheme_result SET govt_schemes_id='".$Response_ID."',agent_id='".$agent_id."', contact_no='".$contact_no."', call_id='".$call_id."'";

			mysql_query($Query) or die(mysql_error());	
			echo "INSERT";
		 }
    break;
}
?>
