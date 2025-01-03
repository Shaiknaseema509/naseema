<?php
require_once("dbconnect_emri.php");
mysql_query('SET character_set_results=utf8');


 
$action       		= $_POST["action"];
$directory_id 		= $_POST["directory_id"];
$subdirectory_id 	= $_POST["sub_directory_id"];
$subSubDirectoryID 	= $_POST["subSubDirectoryID"];

$district_array		= explode("~",$_POST["district_id"]); 
$call_id		= $_POST["call_id"];


switch($action) 
{

  case 'SEARCHHOSPITAL': 
  
  
  
  if($call_id!='' && $subdirectory_id !='')
	 {
		 $district_id = $district_array[0];
		 if($district_id =='') $district_id=0;
		 
		 $Query = "INSERT INTO info_directory_result SET call_id='".$call_id."', district_id='".$district_id."', sub_directory_id='".$subdirectory_id."';";
		mysql_query($Query);
	 }
	 if($subdirectory_id ==109)
	{
		//if($subSubDirectoryID =='') {echo 'Please Select Category'; die;}
		/*$Search_Sub_Directory_Query = "SELECT  QueryName FROM m_hospital_health_facilities_directory WHERE directory_id ='".$subdirectory_id."' ";
	$Search_Sub_Directory_Result = mysql_query($Search_Sub_Directory_Query);
	$Search_Query  = mysql_fetch_array($Search_Sub_Directory_Result);
		include('pdf.php?id='.$Search_Query["QueryName"]);*/
		 
			echo '<iframe src="pdf/Gujarati Immunization Schedule.pdf" style="width:99%;height:500px;border:none;scroll:none"></iframe>';
	 
		die;
	}
	
	 if($subdirectory_id ==112)
	{
		//if($subSubDirectoryID =='') {echo 'Please Select Category'; die;}
		/*$Search_Sub_Directory_Query = "SELECT  QueryName FROM m_hospital_health_facilities_directory WHERE directory_id ='".$subdirectory_id."' ";
	$Search_Sub_Directory_Result = mysql_query($Search_Sub_Directory_Query);
	$Search_Query  = mysql_fetch_array($Search_Sub_Directory_Result);
		include('pdf.php?id='.$Search_Query["QueryName"]);*/
		 
			echo '<iframe src="pdf/First1000Days.pdf" style="width:99%;height:500px;border:none;scroll:none"></iframe>';
	 
		die;
	}
	
	if($subdirectory_id ==114)
	{	 
			echo '<iframe src="pdf/MAyojnaFAQ.pdf" style="width:99%;height:500px;border:none;scroll:none"></iframe>';
	 
		die;
	}
  
  if($subdirectory_id ==106)
	{
		if($subSubDirectoryID =='') {echo 'Please Select Category'; die;}
		include('government_schemes_screen.php');
		die;
	}
 if($subdirectory_id ==107)
	{
		//if($subSubDirectoryID =='') {echo 'Please Select Category'; die;}
		include('support_schemes_screen.php');
		die;
	}	
  
	$Search_Sub_Directory_Query = "SELECT  QueryName FROM m_hospital_health_facilities_directory WHERE directory_id ='".$subdirectory_id."' ";
	$Search_Sub_Directory_Result = mysql_query($Search_Sub_Directory_Query);
	$Search_Query  = mysql_fetch_array($Search_Sub_Directory_Result);
   	$Search_Hospitals_Query = "".$Search_Query["QueryName"]." WHERE district like '%".$district_array[1]."%';"; 
 	//$Search_Hospitals_Query = "".$Search_Query["QueryName"].";"; 
	$Search_Hospitals_Result = mysql_query($Search_Hospitals_Query);
	$numfields = mysql_num_fields($Search_Hospitals_Result);

	echo "<table class='table-border table-hver table-strped' cellspacing='0' rules='all' border='1' style='color:white;border-collapse:collapse;line-height:normal'>";
	echo "<tr style='color:White;background-color:#993300;'  colspan='".$numfields."'>";
	echo '<th>&nbsp;</th>';
	for ($i=0; $i < $numfields; $i++)
	 { echo '<th>'.mysql_field_name($Search_Hospitals_Result, $i).'</th>'; }
	echo "</tr>";
	if(mysql_num_rows($Search_Hospitals_Result)>0)
	 {
	 	while($Hospitals_Details = mysql_fetch_array($Search_Hospitals_Result))
         	 {
		   //echo "<tr style='height:25px'><td><label  class='btn btn-success'><input type='checkbox'   class='ads_Checkbox' value='' name='chk' ><span class='glyphicon glyphicon-ok'></span></label></td>";
		   if($subdirectory_id ==105) 
		   { 
				$sms = $Hospitals_Details['HospitalName'].'@@#@@'.$Hospitals_Details['Address'].'@@#@@'.$Hospitals_Details['ContactPersonMobile']; ?>
				<tr style='height:25px'><td><label  class='btn btn-success'><input type='button' onclick='return sendSMS("<?php echo $sms;?>","directory_hospital");' class='ads_Checkbox btn btn-success' value='SendSMS'   name='chk' ><span class='glyphicon glyphicon-ok'></span></label></td>
		<?php } else if($subdirectory_id ==104)
		{ 
			$sms = $Hospitals_Details['hospital_name'].'@@#@@'.$Hospitals_Details['address'].'@@#@@'.$Hospitals_Details['ContactNo-1']; ?>
			<tr style='height:25px'><td><label  class='btn btn-success'><input type='button' onclick='return sendSMS("<?php echo $sms;?>","directory_bloodbank");' class='ads_Checkbox btn btn-success' value='SendSMS'   name='chk' ><span class='glyphicon glyphicon-ok'></span></label></td>
		<?php }
		   else { echo "<tr style='height:25px'><td><label  class='btn btn-success'><input type='checkbox'   class='ads_Checkbox' value='' name='chk' ><span class='glyphicon glyphicon-ok'></span></label></td>";}

		   for ($i=0; $i < $numfields; $i++)
         		{ echo '<td width="25%">'.$Hospitals_Details[mysql_field_name($Search_Hospitals_Result, $i)].'</td>'; }	
		  echo "</tr>";
         	 }
	  }
	 else
	  {
	 	echo "<tr style='height:25px'><td colspan='".$numfields."' align='center'><font color='red' size=2><b>No Records Found</b></font></td></tr>";
		
	  }
        	echo "</table>";

	

   break;

}
 ?>
