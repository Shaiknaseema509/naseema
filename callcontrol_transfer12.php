<?php
require_once("dbconnect_emri.php");

$action = $_REQUEST['ACTION'];
$type = $_REQUEST['type'];
$beneficiary_id = $_REQUEST['beneficiary_id'];
$queue_id = $_REQUEST['queue_id'];
$queue_name = $_REQUEST['queue_name'];
$call_id = $_REQUEST['call_id'];
$lead_id = $_REQUEST['leadID'];
$tf_queue_name = $_REQUEST['tf_queue_name'];
$call_transfer = $_REQUEST['call_transfer'];
$agent_id = $_REQUEST['agent_id'];
$phone_number = $_REQUEST['phone_number'];
$process = $_REQUEST['process'];
$call_date = $_REQUEST['call_date'];
$call_time = $_REQUEST['call_time'];
$date = $call_date." ".$call_time;
$call_hit_referenceno = $_REQUEST['call_hit_referenceno'];
$call_type_id         = $_POST["call_type_id"];
$call_information_id  = ($_POST["call_information_id"])?$_POST["call_information_id"]:0;
$beneficiary_id       = $_POST["beneficiary_id"];

//echo "<pre>".print_r($_POST,1)."</pre>";

$strings = "|". print_r($_REQUEST,1);
dblog($strings);

$transfer_insert_q = "INSERT INTO inbound_transfer_details SET agent_id='".$agent_id."', action='".$action."', call_type='INBOUND', 
call_time=now(), lead_id='".$lead_id."', beneficiary_id='".$beneficiary_id."', call_id='".$call_id."', 
phone_number='".$phone_number."', process='".$process."', queue_name='".$_POST['tType']."', call_hit_referenceno='".$call_hit_referenceno."', queue_id='".$queue_id."', transfer_queue_name='".$tf_queue_name."', transfer_time=NOW()";
mysql_query($transfer_insert_q) or die(mysql_error());
dblog($transfer_insert_q);

        $Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
        $Result1 = mysql_query($Query1);
        $Details1 = mysql_fetch_array($Result1);
        $agent_status = $Details1["status"];
        $action_id = $Details1["actionid"];

        if($agent_status == "ONCALL")
         {
                $Query2 = "SELECT callid FROM call_incident_info WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
                $Result2 = mysql_query($Query2);
                $Details2 = mysql_fetch_array($Result2);
                $Call_ID = $Details2["callid"];

                $Query3 = "UPDATE call_conversations SET end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$Call_ID."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
                mysql_query($Query3);

                $Query4 = "UPDATE call_incident_info SET call_end_time=NOW() and call_type_id = ='".$call_type_id."' WHERE callid='".$call_id."';";
               // mysql_query($Query4);
				dblog($Query4);
         }
		 
		 if($_POST['tType'] =='CO_104') $callTypeID = 44;
		 else  $callTypeID = 55;

	$Query5 = "UPDATE call_incident_info SET call_end_time=NOW(),call_type_id='".$callTypeID."', call_information_id='".$call_information_id."',
	beneficiary_id='1', popup_close_time=NOW() WHERE callid='".$call_id."';";
	mysql_query($Query5);
	
	dblog($Query5);

        $Query = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
        mysql_query($Query);
		
dblog($Query);
		
	if($call_type_id == 1 || $call_type_id == 2 || $call_type_id == 3 || $call_type_id == 4 || $call_type_id == 5 || $call_type_id == 6)
	 {              
		$past_history           = $_POST["past_history"];
		$present_compalint      = $_POST["present_compalint"];
		$Advice_sought_by	= $_POST["Advice_sought_by"];
		$advice                 = $_POST["advice"];
		$beneficiary_id         = $_POST["beneficiary_id"];
		$callid                 = $_POST["call_id"];
		$service_type		= $_POST["service_type"];
	
			$Query6 = "INSERT INTO Call_benificiary SET callid='".$callid."', benificiary_id='".$beneficiary_id ."', service_type='".$service_type."', addvice_sought_by='".$Advice_sought_by."', Past_history='".$past_history."', present_symptoms='".$present_compalint."', advice='".$advice."', advice_time=NOW();";
			mysql_query($Query6);
			dblog($Query6);
	 }
	  
	 
	 

 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/tran_".date("Y-m-d_H").".csv";
     if(file_exists($log_file))
       {
         $LOGFILE_HANDLE = fopen($log_file,"a");
       }
     else
       {
         $LOGFILE_HANDLE = fopen($log_file,"w");
       }

     chmod($log_file,0755);
     $dataString = $Query;
     $dataString .= "\n";
     fwrite($LOGFILE_HANDLE,$dataString);
     fclose($LOGFILE_HANDLE);
     $dataString ="";
}	
	 
	 
	 
	 
?>
