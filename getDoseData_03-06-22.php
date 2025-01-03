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
       		
         $mandals_query = "SELECT `AwdId`,`AgeId`,`Dosage`,`Usege`,`NoOfDays` FROM `dosage`WHERE `DrugId`=".$id." ORDER BY Dosage ASC limit 1;";
        $mandals_result=mysql_query($mandals_query);
       
	while($mandals_details=mysql_fetch_array($mandals_result))
	 { 
		 echo "<tr>";
		echo "<td>".$dName."</td>";
		echo "<td>".$mandals_details["Dosage"]."</td>";
		echo "<td>".$mandals_details["Usege"]."</td>";
		echo "<td>".$mandals_details["NoOfDays"]."</td>";
		echo "<td><input type='button' class='btn-danger' value='Delete' /></td>";
		 echo "</tr>";
	 }

	

	//mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    

   break;
	 
    
	

 }
?>
