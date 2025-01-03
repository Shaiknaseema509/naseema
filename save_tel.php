<?php
error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$action	= $_POST['type'];

switch($action)
{ 
	
		case 'getcontact':

	
 	//$sysdocID = $_POST['sysdocID1'];  
	$sysdocID = explode("~",$_POST['sysdocID1']);

 	$contactQuery = "SELECT `contact_number` FROM `m_doctor_details` WHERE `doctor_id` = '".$sysdocID[0]."' AND is_active = 1";
	//echo "SELECT `contact_number` FROM `m_doctor_details` WHERE `doctor_id` = '".$sysdocID[0]."' AND is_active = 1";
	$contactResult = mysql_query($contactQuery);
	$contactDetails = mysql_fetch_array($contactResult);

	echo $contact=$contactDetails['contact_number'];	
	break;
	
	
   case "getdoctype":
       		
        $villages_query = "SELECT `doctor_id`,`doctor_name` FROM `m_doctor_details` WHERE doctor_type_id ='".$_POST['sysdocID1']."' and is_active = 1";
		echo "SELECT `doctor_id`,`doctor_name`,`contact_number` FROM `m_doctor_details` WHERE doctor_type_id ='".$_POST['sysdocID1']."' and is_active = 1";
        $villages_result=mysql_query($villages_query);
        echo "<option value=''>-- select Doctor --</option>";
	while($villages_details=mysql_fetch_array($villages_result))
	 { 
		echo "<option value='".$villages_details["doctor_id"]."~".$villages_details["doctor_name"]."' >".$villages_details["doctor_name"]."</option>";
	 }

   break;
	
}