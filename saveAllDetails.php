<?php
error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$action	= $_POST['type'];

switch($action)
{
   case 'SaveAllDetails':
	
		$call_id		= $_POST['call_id'];
		$agent_id		= $_POST['agent_id'];
		$message		= $_POST['message'];
		 
		if($call_id =='') die; 
		 
		 
		$d= mysql_query("select * from casefulldetails where callid = '".$call_id."';"); 
		
		if(mysql_num_rows($d)>0)
		{
			$Query	= "update casefulldetails SET `message`=CONCAT(`message`,' ->".$message."') where call_id='".$call_id."'";
		}
		 else
		 {		
			$Query	= "INSERT INTO casefulldetails SET	agentId='".$call_id."',call_id='".$call_id."', message='".$message."',dateTime=NOW()";
		}
		dblog($Query);
		mysql_query($Query);
		
    break;
	 
	
}



 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/ben_".date("Y-m-d_H").".csv";
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
