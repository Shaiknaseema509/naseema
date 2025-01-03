<?php 
require_once("dbconnect_emri.php");

$agent_id             = $_POST["agent_id"];
$phone_number         = $_POST["phone_number"];
$service_id           = $_POST["service_id"];
$call_hit_referenceno = $_POST["call_hit_referenceno"];
$call_date            = $_POST["call_date"];
$call_time            = $_POST["call_time"];

$SelectQuery0 = "SELECT agent_id FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
$SelectResult0 = mysql_query($SelectQuery0);
$cid = mysql_num_rows($SelectResult0);
if($cid!=0 && $cid !='')
 {
	$CallidQuery = "SELECT currentnumber, calltime FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	$CallidResult = mysql_query($CallidQuery);
	$CallidDetails = mysql_fetch_array($CallidResult);

	echo $Callid=$CallidDetails['currentnumber'];	
 }
else
 {
	$Query = "UPDATE outbound_sequenceno SET currentnumber = currentnumber + 1 WHERE	sequencename = 'CallID' AND YEAR = YEAR(NOW());";	
	mysql_query($Query);
	
	$Query1 = "INSERT INTO agent_sequenceno (agent_id,currentnumber,calltime) VALUES ('".$agent_id."',(SELECT max(currentnumber) FROM outbound_sequenceno),CONCAT(CURRENT_DATE,' ',CURRENT_TIME));";
	mysql_query($Query1);
	
	$CallidQuery = "SELECT currentnumber, calltime FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	$CallidResult = mysql_query($CallidQuery);
	$CallidDetails = mysql_fetch_array($CallidResult);

	echo $Callid=$CallidDetails['currentnumber'];	
 }

$SelectQuery1 = "SELECT callid FROM call_incident_info_out WHERE callid='".$Callid."';";
$ResultQuery1 = mysql_query($SelectQuery1);
$rowCount = mysql_num_rows($ResultQuery1);
if($rowCount ==0)
 {
	$QueryInsert = "INSERT INTO call_incident_info_out SET callid='".$Callid."', call_time='".$call_date." ".$call_time."', phone_number='".$phone_number."', service_id='".$service_id."', agent_id='".$agent_id."', call_referenceno='".$call_hit_referenceno."', popup_time=NOW();";
	mysql_query($QueryInsert);
 }
?>
