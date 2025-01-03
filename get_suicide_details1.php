<?php
require_once("dbconnect_emri.php");

$action   	= $_POST["action"];
$district 	= $_POST["district_id"];
$district_array = explode("~",$district);
$mandal   	= $_POST["mandal_id"];
$mandal_array 	= explode("~",$mandal);

$village   	= $_POST["village_id"];
$village_array 	= explode("~",$village);

$area   	= $_POST["area_id"];
$area_array 	= explode("~",$area);

$grievance = $_POST["grievance_id"];
$grievance_array 	= explode("~",$grievance);

$phone = $_POST["phonenumber"]; 

//cmo details
$Officer_details= $_POST['OfficerDetails'];
$Officer_array  = explode("~",$Officer_details); 


switch($action)
 {
   case "Mandals":
       		
        $mandals_query = "SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid=".$district_array[0]." ORDER BY md_lname ASC;";
        $mandals_result=mysql_query($mandals_query);
        echo "<option value=''>-- select Mandals --</option>";
	while($mandals_details=mysql_fetch_array($mandals_result))
	 { 
		echo "<option value='".$mandals_details["md_mdid"]."~".$mandals_details["md_lname"]."' >".$mandals_details["md_lname"]."</option>";
	 }

	echo "$$@@$$";

	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
     /*   $cmo_query = "SELECT sno,officer_name,designation,office_number,mobile_number FROM Directory_cmo WHERE district_id =".$district_array[0]." ORDER BY officer_name ASC;";
        $cmo_result=mysql_query($cmo_query);
        echo "<option value=''>-- Select CMO --</option>";
	while($cmo_details=mysql_fetch_array($cmo_result))
	 { 
		echo "<option value='".$cmo_details["sno"]."~".$cmo_details["officer_name"]."~".$cmo_details["designation"]."' >".$cmo_details["officer_name"]."</option>";
	 }*/

   break;
	
   case "Villages":
       		
        $villages_query = "SELECT ct_ctid,ct_lname FROM m_city WHERE ct_mdid=".$mandal_array[0]." AND is_active=1 ORDER BY ct_lname ASC;";
        $villages_result=mysql_query($villages_query);
        echo "<option value=''>-- select City/Village --</option>";
	while($villages_details=mysql_fetch_array($villages_result))
	 { 
		echo "<option value='".$villages_details["ct_ctid"]."~".$villages_details["ct_lname"]."' >".$villages_details["ct_lname"]."</option>";
	 }

   break;
   
   case "areas":
       		
       // $villages_query = "SELECT `ar_areaid`,`ar_lname` FROM `cctareas` WHERE `ar_ctid`=".$mandal_array[0]." AND is_active=1 ORDER BY ar_lname ASC;";
        $villages_query = "SELECT `ar_areaid`,`ar_lname` FROM `cctareas` WHERE `ar_ctid`=".$village_array[0]." ORDER BY ar_lname ASC;";
        $villages_result=mysql_query($villages_query);
        echo "<option value=''>-- select Area --</option>";
	while($villages_details=mysql_fetch_array($villages_result))
	 { 
		echo "<option value='".$villages_details["ar_areaid"]."~".$villages_details["ar_lname"]."' >".$villages_details["ar_lname"]."</option>";
	 }

   break;
 
 
   
 
    case 'GetSubcategory':
 
        $category_id       = $_REQUEST['category_id']; 
			 
			 $call_type = "SELECT * FROM `m_sub_category` WHERE `category_id` = '$category_id' ;";
			  
			$villages_detail = mysql_query($call_type);
			 
			 
	   echo "<option value=''>Select Sub Category</option>";
		while($villages_details=mysql_fetch_array($villages_detail))
		 { 
	 		echo "<option value='".$villages_details["sub_category_id"]."~".$villages_details["sub_category_name"]."' >".$villages_details["sub_category_name"]."</option>";

 		 }
			 
			 
   break;
   
       case 'GetGrevience':
 
        $category_id       = $_REQUEST['category_id']; 
			 
			 $call_type = "SELECT * FROM `m_suicide_grievance` WHERE `category_id` = '$category_id' ;";
			$villages_detail = mysql_query($call_type);
			 
			 
	   echo "<option value=''>Select Grievance</option>";
		while($villages_details=mysql_fetch_array($villages_detail))
		 { 
	 		echo "<option value='".$villages_details["grievance_id"]."~".$villages_details["grievance_name"]."' >".$villages_details["grievance_name"]."</option>";

 		 }
			 
			 
   break;
   
   
          case 'Getredressal':
		  
		
  
		$referal_id       = $_REQUEST['referal_id']; 
		
			 
			 $call_type = "SELECT mre.`redressal_id`, mre.`redressal_name` FROM `m_grievance_referrals_concerned` mgr
							JOIN `m_redressal` mre ON mre.`redressal_id` = mgr.`redressal_id`
							WHERE mgr.`grievance_id` = '1'    AND mgr.`referal_id` = '1';";
							  
			$villages_detail = mysql_query($call_type);
			 
			 
	   echo "<option value=''>Select Redressal</option>";
		while($villages_details=mysql_fetch_array($villages_detail))
		 { 
	 		echo "<option value='".$villages_details["redressal_id"]."~".$villages_details["redressal_name"]."' >".$villages_details["redressal_name"]."</option>";

 		 }
			 
			 
   break;
    
	
	 case 'Getreferral':
		  
		
  
		$risk_id       = $_REQUEST['risk_id']; 
		
			 
			 $call_type = "SELECT `referal_id`,`referal_name` FROM `m_referrals_concerned` WHERE `risk_level` = '$risk_id '";
							
 
							
			$villages_detail = mysql_query($call_type);
			 
			 
	   echo "<option value=''>Select Referrals Concerned</option>";
		while($villages_details=mysql_fetch_array($villages_detail))
		 { 
	 		echo "<option value='".$villages_details["referal_id"]."~".$villages_details["referal_name"]."' >".$villages_details["referal_name"]."</option>";

 		 } 
			 
   break;
   
   
   	case 'getsuicidedetails':  
 echo "hi";
		
$Row = "SELECT ci.callid,ci.phone_number,cis.`patient_name`,cis.`caller_name`,cis.`alternate_number`,cis.`age`,
cis.`gender_name`,cis.`district_id`,
cis.`district_name`,cis.`mandal_id`,cis.`mandal_name`,
cis.`village_id`,cis.`village_name`,cis.`location`,mcs.`call_type_id`, mc.`category_id`, msc.`sub_category_id`,
mr.`risk_level_id`, cis.`co_remarks`
FROM `call_incident_info` ci 
LEFT JOIN `call_incident_info_details_suicide` cis ON ci.callid = cis.caller_id 
LEFT JOIN `m_call_type_suicide` mcs ON mcs.`call_type_id` = cis.`call_type_id`
LEFT JOIN `m_category` mc ON mc.`category_id` = cis.`category_id`
LEFT JOIN `m_sub_category` msc ON msc.`sub_category_id` = cis.`sub_category_id`
LEFT JOIN `m_risk_level` mr ON mr.`risk_level_id` = cis.`risk_level_id`
WHERE  ci.phone_number = '".$phone."'  AND  `caller_name` != '' AND district_id != '' ORDER BY callid DESC LIMIT 1";

echo "SELECT ci.callid,ci.phone_number,cis.`patient_name`,cis.`caller_name`,cis.`alternate_number`,cis.`age`,
cis.`gender_name`,cis.`district_id`,
cis.`district_name`,cis.`mandal_id`,cis.`mandal_name`,
cis.`village_id`,cis.`village_name`,cis.`location`,mcs.`call_type_id`, mc.`category_id`, msc.`sub_category_id`,
mr.`risk_level_id`, cis.`co_remarks`
FROM `call_incident_info` ci 
LEFT JOIN `call_incident_info_details_suicide` cis ON ci.callid = cis.caller_id 
LEFT JOIN `m_call_type_suicide` mcs ON mcs.`call_type_id` = cis.`call_type_id`
LEFT JOIN `m_category` mc ON mc.`category_id` = cis.`category_id`
LEFT JOIN `m_sub_category` msc ON msc.`sub_category_id` = cis.`sub_category_id`
LEFT JOIN `m_risk_level` mr ON mr.`risk_level_id` = cis.`risk_level_id`
WHERE ci.phone_number = '".$phone."' AND  `caller_name` != '' AND district_id != '' ORDER BY callid DESC LIMIT 1";
 
 
	$Result5 = mysql_query($Row);
	//$Details = mysql_fetch_array($Result5);
	
 while ($Details5 = mysql_fetch_array($Result5)) 
{	
    $Details55[] = $Details5;
}
	echo json_encode(array('suicidedetails'=>$Details55));
			 
    break;
    
	

 }
?> 
    
	
 