<?php
require_once("dbconnect_emri.php");
$action       = $_POST["action"];
$status_id    = $_POST["status_id"];
$complaint_id = $_POST["complaint_id"];
$closure_remarks = $_POST["closure_remarks"];
$action_details  = $_POST["action_details"];
$Compalaint_CallId  = $_POST["callid"];


$caremarks  = $_POST["caremarks"];
$emp  = $_POST["emp"]; 

//echo "<pre>".print_r($_POST,1)."</pre>";

function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  system("mkdir -p $log_path");
  $log_file = "$log_path/emri_queries_20_".date("Y-m-d_H").".csv";
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

function getCurrentDate()
{
 return date("Y-m-d H:i:s"); 
}


switch($action)
 {

   case "COMPLAINT":
   $sql = "";
	if($status_id == 2)
	 {
		$sql = ", closed_date=NOW(), closed_by='".$_POST["agent_id"]."'";
	 }
	 
		$spocname		= $_POST['spocname']; 
		
		$spoc		= explode("~",$_POST['spocname']);
		$spocId = $spoc[0];
		$spocName = $spoc[1];
	
		if($status_id == 2) { $status ='CLOSED'; $level=1;  }
		else 
		{
			$level=2;$status ='OPEN';
		
		$Query123	= "insert into  escalationresult SET spocId='".$spocId."',dateTime=now(),escalationLevelId='2',escalationLevelName='".$spocName."',
		agentId='".$agent_id."', callid='".$call_id."'";
		mysql_query($Query123);
		dblog($Query123);
		};
	
	 
			$Query123	= "update grievance SET closed_remarks='".$Compliant."',cLevel=$level,action_details='".$contact_no."', 
		status='".$status."' where call_id='".$Compalaint_CallId."'";	
		
		 
			mysql_query($Query123);
		dblog($Query123);
	

	if($_POST["agent_status"] == "ONCALL")
	 {
		$Query0 = "UPDATE call_conversations SET end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$_POST["callid"]."' AND from_user_id='".$_POST["agent_id"]."' AND actionid='".$_POST["action_id"]."' AND end_time='0000-00-00 00:00:00';";

		$Query0_log = "UPDATE call_conversations SET end_time='".getCurrentDate()."', duration=(UNIX_TIMESTAMP('".getCurrentDate()."')-UNIX_TIMESTAMP(start_time)) WHERE callid='".$_POST["callid"]."' AND from_user_id='".$_POST["agent_id"]."' AND actionid='".$_POST["action_id"]."' AND end_time='0000-00-00 00:00:00';";

   		dblog($Query0_log);
		mysql_query($Query0);
	 }

	echo "SUCCESS";
   break;

   case "CONVERSATIONS" :

        if($_POST["agent_status"] == "ONCALL")
         {
                $Query0 = "UPDATE call_conversations SET end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$_POST["callid"]."' AND from_user_id='".$_POST["agent_id"]."' AND actionid='".$_POST["action_id"]."' AND end_time='0000-00-00 00:00:00';";

                $Query0_log = "UPDATE call_conversations SET end_time='".getCurrentDate()."', duration=(UNIX_TIMESTAMP('".getCurrentDate()."')-UNIX_TIMESTAMP(start_time)) WHERE callid='".$_POST["callid"]."' AND from_user_id='".$_POST["agent_id"]."' AND actionid='".$_POST["action_id"]."' AND end_time='0000-00-00 00:00:00';";

   		dblog($Query0_log);
                mysql_query($Query0);

                if(mysql_affected_rows()>0)
                 {
                        echo "SUCCESS";
                 }
         }
        else
         {
                echo "SUCCESS";
         }

   break;

 }   
?>
