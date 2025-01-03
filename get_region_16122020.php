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
   
    case "greaareas":
       		
       // $villages_query = "SELECT `ar_areaid`,`ar_lname` FROM `cctareas` WHERE `ar_ctid`=".$mandal_array[0]." AND is_active=1 ORDER BY ar_lname ASC;";
        $villages_query = "SELECT `ct_ctid`,`ct_lname` FROM `m_city_area` WHERE `ct_mdid`=".$mandal_array[0]." ORDER BY ct_lname ASC;";
        $villages_result=mysql_query($villages_query);
        echo "<option value=''>-- select Area --</option>";
	while($villages_details=mysql_fetch_array($villages_result))
	 { 
		echo "<option value='".$villages_details["ct_ctid"]."~".$villages_details["ct_lname"]."' >".$villages_details["ct_lname"]."</option>";
	 }

   break;

  case 'GetCMODetails':

        $cmo_sno	= $_POST['cmo_sno'];
        $cmo_name       = $_POST['cmo_name'];

	$Query1 = "SELECT office_number,mobile_number FROM Directory_cmo WHERE sno='".$cmo_sno."';";
	$Result1 = mysql_query($Query1);
	 echo "<option value=''>-- Select Contact --</option>";
	 while($Details=mysql_fetch_array($Result1))
	 {
		if(($Details["office_number"]!= "")&&($Details["office_number"]!= 0))
		{  echo "<option value='".$Details["office_number"]."' >".$Details["office_number"]."</option>"; }
		if(($Details["mobile_number"]!= "")&&($Details["mobile_number"]!=0))
		{  echo "<option value='".$Details["mobile_number"]."' >".$Details["mobile_number"]."</option>"; }
	 } 
   break;
   
    case "GetSubcategory":
       		
       // $villages_query = "SELECT `ar_areaid`,`ar_lname` FROM `cctareas` WHERE `ar_ctid`=".$mandal_array[0]." AND is_active=1 ORDER BY ar_lname ASC;";
        $villages_query = "SELECT * FROM `m_hospital_health_facilities_sub_directory` WHERE parent_id=".$area_array[0]." ORDER BY directory_name ASC;";
        $villages_result=mysql_query($villages_query);
        echo "<option value=''>-- select sub category --</option>";
	while($villages_details=mysql_fetch_array($villages_result))
	 { 
		echo "<option value='".$villages_details["directory_id"]."~".$villages_details["directory_name"]."' >".$villages_details["directory_name"]."</option>";
	 }

   break;
   
   
    case 'GetAgency':
 
        $area_id       = $area_array[0]; 
			 
			# $call_type = "SELECT `Agency_id`, `Agency_Name`,Mobile FROM `m_agency_details` WHERE isactive=1 and area_id='$area_id' and Level_No=1 ORDER BY Agency_Name ASC ;";
			 $call_type = "SELECT `Agency_id`, `Agency_Name`,Mobile FROM `m_grivence_details` WHERE isactive=1 and Mandal_id='$area_id' and Level_No=1 ORDER BY Agency_Name ASC ;";
			$villages_detail = mysql_query($call_type);
			 
			 
	   echo "<option value=''>Select Agency Name</option>";
		while($villages_details=mysql_fetch_array($villages_detail))
		 { 
			echo "<option value='".$villages_details["Agency_id"]."~".$villages_details["Agency_Name"]."~".$villages_details["Mobile"]."' >".$villages_details["Agency_Name"]."</option>";
		 }
			 
			 
   break;
   
   case 'GetAgencyGre':
 
         
       
        $city_id       = $village_array[0]; 
        $Institute       = $_POST['Institute']; 
		
		if($Institute ==69)	
		{
			$area_id       = $area_array[0];
			 $call_type = "SELECT `Agency_id`, `Agency_Name`,Mobile,email_id FROM `m_grivence_details` WHERE Agency_type_id=2 and  isactive=1 and Mandal_id='$area_id' and Level_No=1 ORDER BY Agency_Name ASC ;";
		}			
		else
		{   
			$area_id       = $city_id; 
			   $call_type = "SELECT `Agency_id`, `Agency_Name`,Mobile,email_id FROM `m_grivence_details` WHERE 
			   -- Agency_type_id=1 and 
			  isactive=1  and area_id='$area_id' and Level_No=1 GROUP BY Agency_Name ORDER BY Agency_Name ASC ;";	
		}
			
			
#			$call_type = "SELECT `Agency_id`, `Agency_Name`,Mobile,email_id FROM `m_grivence_details` WHERE Agency_type_id=1 and isactive=1 and Mandal_id='$area_id' and Level_No=1 ORDER BY Agency_Name ASC ;";
		
		
		$villages_detail = mysql_query($call_type);
			 
			 
	   echo "<option value=''>Select Agency Name</option>";
		while($villages_details=mysql_fetch_array($villages_detail))
		 { 
			echo "<option value='".$villages_details["Agency_id"]."~".$villages_details["Agency_Name"]."~".$villages_details["Mobile"]."~".$villages_details["email_id"]."' >".$villages_details["Agency_Name"]."</option>";
		 }
			 
			 
   break;
   
    case 'GetAgencyGreLevel':
 
        $area_id       = $area_array[0]; 
			 
			 $call_type = "SELECT `Agency_id`, `Agency_Name`,Mobile,email_id FROM `m_grivence_details`
			 WHERE isactive=1 and Mandal_id='$area_id' and Level_No=1 ORDER BY Agency_Name ASC ;";
			$villages_detail = mysql_query($call_type);
			 
			 
	   echo "<option value=''>Select Agency Name</option>";
		while($villages_details=mysql_fetch_array($villages_detail))
		 { 
			echo "<option value='".$villages_details["Agency_id"]."~".$villages_details["Agency_Name"]."~".$villages_details["Mobile"]."~".$villages_details["email_id"]."' >".$villages_details["Agency_Name"]."</option>";
		 }
			 
			 
   break;
    
	

 }
?>
