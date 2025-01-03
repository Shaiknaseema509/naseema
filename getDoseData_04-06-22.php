<?php
require_once("dbconnect_emri.php");

$action   	= $_POST["action"];
$id   	= $_POST["id"];
$dName   	= $_POST["dName"];
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
   case "GetShowDose":
       		
         $mandals_query = "SELECT `AwdId`,`AgeId`,`Dosage` FROM `dosage`WHERE `DrugId`=".$id." ORDER BY Dosage ASC limit 1;";
        $mandals_result=mysql_query($mandals_query);
       $i=1;
	while($mandals_details=mysql_fetch_array($mandals_result))
	 { 
		 echo "<tr class='dosageData' data-type='dosage' data-id='".$mandals_details["AwdId"]."' id='description_dosage_".$mandals_details["AwdId"]."'>";
		echo "<td>".$dName."</td>";
		echo "<td>".$mandals_details["Dosage"]."<input type='hidden' id='dosage_".$mandals_details["AwdId"]."' name='dosage_".$mandals_details["AwdId"]."' value='".$mandals_details["AwdId"]."' /></td>";
		echo "<td>".$mandals_details["AgeId"]."</td>";
		//echo "<td>".$mandals_details["NoOfDays"]."</td>";
		echo "<td><input type='text' name='description_dosage_".$mandals_details["AwdId"]."' id='description_dosage_remarks_".$mandals_details["AwdId"]."' /></td>";
		echo "<td><input type='button' class='btn-danger' value='Delete' onclick='dosageDelete(\"dosage\",".$mandals_details['AwdId'].")' /></td>";
		 echo "</tr>";
	 $i++; }

	break;

	//mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
   case "GetMHUDrug":
   
		 $mandals_query = "SELECT `AwdId`,`AgeId`,`Dosage` FROM `dosagemhu`WHERE `DrugId`=".$id." ORDER BY Dosage ASC limit 1;";
        $mandals_result=mysql_query($mandals_query);
       
	while($mandals_details=mysql_fetch_array($mandals_result))
	 { 
		 echo "<tr class='dosageData' data-type='dosagemhu' data-id='".$mandals_details["AwdId"]."' id='description_dosagemhu_".$mandals_details["AwdId"]."'>";
		echo "<td>".$dName."</td>";
		echo "<td>".$mandals_details["Dosage"]."<input type='hidden' id='dosagemhu_".$mandals_details["AwdId"]."' name='dosagemhu_".$mandals_details["AwdId"]."' value='".$mandals_details["AwdId"]."' /></td>";
		echo "<td>".$mandals_details["AgeId"]."</td>";
		//echo "<td>".$mandals_details["NoOfDays"]."</td>";
		echo "<td><input type='text'  name='description_dosagemhu_".$mandals_details["AwdId"]."' id='description_dosagemhu_remarks_".$mandals_details["AwdId"]."' /></td>";
		echo "<td><input type='button' class='btn-danger' value='Delete' onclick='dosageDelete(\"dosagemhu\",".$mandals_details['AwdId'].")' /></td>";
		 echo "</tr>";
	 }

break;
   
	 
    
	

 }
?>
