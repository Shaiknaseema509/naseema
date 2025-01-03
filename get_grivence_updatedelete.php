<?php
require_once("dbconnect_emri.php");

$action   	= $_POST["action"];
$ID   	= $_POST["ID"];
$mobile   	= $_POST["mobile"];
$email_id   	= $_POST["email"];

if($ID =='') die;


  if($action =='2' && $ID !='')
	mysql_query("update `m_grivence_details` set isactive=2 WHERE `Agency_id` =$ID ;");
else
	mysql_query("update `m_grivence_details` set Mobile='".$mobile."',email_id='".$email_id."' WHERE `Agency_id` =$ID ;");	

  
  
  
?>
