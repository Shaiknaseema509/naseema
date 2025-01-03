<?php
require_once("dbconnect_emri.php");
mysql_query('SET character_set_results=utf8');


 
$action       		= $_POST["action"];
$directory_id 		= $_POST["directory_id"];
$subdirectory_id 	= $_POST["sub_directory_id"];
$subSubDirectoryID 	= $_POST["subSubDirectoryID"];
$severity 	= $_POST["severity"];
$Complaint 	= $_POST["Complaint"];
$Advice 	= $_POST["Advice"];
$pph 	= $_POST["pph"];
$Med 	= $_POST["Med"];
$call_id 	= $_POST["call_id"];

$district_array		= explode("~",$_POST["district_id"]); 
$call_id		= $_POST["call_id"];

dblog(print($_POST),1);
switch($action) 
{

  case 'SEARCHHOSPITAL': 
   
   
    if($directory_id =='') $directory_id=1;
   if($subdirectory_id =='') $subdirectory_id=1;
   if($subSubDirectoryID =='') $subSubDirectoryID=1;
   
   
	if($call_id!='')
	 {
		 $Query = "INSERT INTO `counselling` SET `pph`='".$pph."',`callid`='".$call_id."',`category_id`='".$directory_id."',`subcategory_id`='".$subdirectory_id."',
		 `response_id`='".$response."',`mStatus`='".$subdirectory_id."',`severity`='".$severity."',
		 `medication`='".$Med."',`complaint`='".$Complaint."',`advice`='".$Advice."';";
		mysql_query($Query);
		dblog($Query);
	 }

   break;

}




 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/cou_".date("Y-m-d_H").".csv";
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
