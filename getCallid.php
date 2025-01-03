<?php 
require_once("dbconnect_emri.php");

date_default_timezone_set('Asia/Calcutta'); 

$agent_id             = $_POST["agent_id"];
$phone_number         = $_POST["phone_number"];
$service_id           = $_POST["service_id"];
$call_hit_referenceno = $_POST["call_hit_referenceno"];
$call_date            = $_POST["call_date"];
$call_time            = $_POST["call_time"];

$SelectQuery0 = "SELECT agent_id FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
$SelectResult0 = mysql_query($SelectQuery0);
$cid = mysql_num_rows($SelectResult0);

mysql_query("START TRANSACTION");

if($cid!=0 && $cid !='')
 {
	$CallidQuery = "SELECT currentnumber, calltime FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	$CallidResult = mysql_query($CallidQuery);
	$CallidDetails = mysql_fetch_array($CallidResult);

	echo $Callid=$CallidDetails['currentnumber'];	
	$QueryInsert = "update call_incident_info SET  call_time=now(), phone_number='".$phone_number."', agent_id='".$agent_id."', call_referenceno='".$call_hit_referenceno."', popup_time=NOW() where callid=".$Callid;
	mysql_query($QueryInsert);
 }
else
 {
	#$Query = "UPDATE sequenceno SET currentnumber = currentnumber + 1 WHERE	sequencename = 'CallID' AND YEAR = YEAR(NOW());";	
	$Query = "UPDATE sequenceno SET currentnumber = currentnumber + 1 ;";	
	mysql_query($Query);
	
	#$Query1 = "INSERT INTO agent_sequenceno (agent_id,currentnumber,calltime) VALUES ('".$agent_id."',(SELECT max(currentnumber) FROM sequenceno),CONCAT(CURRENT_DATE,' ',CURRENT_TIME));";
	$Query1 = "INSERT INTO agent_sequenceno (agent_id,currentnumber,calltime) SELECT  '".$agent_id."', max(currentnumber) ,now() FROM sequenceno;";
	mysql_query($Query1);
	
	$CallidQuery = "SELECT currentnumber, calltime FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	$CallidResult = mysql_query($CallidQuery);
	$CallidDetails = mysql_fetch_array($CallidResult);
echo $Callid=$CallidDetails['currentnumber'];	


	 $QueryInsert = "update call_incident_info SET  call_time=now(), phone_number='".$phone_number."', agent_id='".$agent_id."', call_referenceno='".$call_hit_referenceno."', popup_time=NOW() where callid=".$Callid;
	mysql_query($QueryInsert);
	
	
 }
 
  mysql_query("COMMIT");

$SelectQuery1 = "SELECT count(callid) 'cal' FROM call_incident_info WHERE callid=".$Callid.";";
$ResultQuery1 = mysql_query($SelectQuery1);
//$rowCount = mysql_num_rows($ResultQuery1);
$rowCount = mysql_fetch_array($ResultQuery1);
if($rowCount['cal'] ==0)
 {
	$QueryInsert = "INSERT INTO call_incident_info SET callid='".$Callid."', call_time=now(), phone_number='".$phone_number."', service_id='".$service_id."', agent_id='".$agent_id."', call_referenceno='".$call_hit_referenceno."', popup_time=NOW(),process='104';";
	$QueryInsertnew = "INSERT INTO call_incident_info_new SET callid='".$Callid."', call_time=now(), phone_number='".$phone_number."', service_id='".$service_id."', agent_id='".$agent_id."', call_referenceno='".$call_hit_referenceno."', popup_time=NOW(),process='104';";
	$QueryInsertLog = "INSERT INTO call_incident_info SET callid='".$Callid."', call_time='".date("Y-m-d H:i:s")."', phone_number='".$phone_number."', service_id='".$service_id."', agent_id='".$agent_id."', call_referenceno='".$call_hit_referenceno."', popup_time='".date("Y-m-d H:i:s")."',process='104';";
	mysql_query($QueryInsert);
	
	//mysql_query($QueryInsertnew);
	dblog($QueryInsertLog);
 }
 
 
 
 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/getcallid_".date("Y-m-d_H").".csv";
     if(file_exists($log_file))
       {
         $LOGFILE_HANDLE = fopen($log_file,"a");
       }
     else
       {
         $LOGFILE_HANDLE = fopen($log_file,"w");
       }

     chmod($log_file,0755);
     $dataString = "\"".date("Y-m-d H:i:s")."\",   "."\"".$Query."\"";
     $dataString .= "\n";
     fwrite($LOGFILE_HANDLE,$dataString);
     fclose($LOGFILE_HANDLE);
     $dataString ="";
}	
?>
