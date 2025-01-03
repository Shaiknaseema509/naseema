<?php 
//error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$action	= $_POST['type'];

echo $_POST['referralsconcerned'];

		$call_id					= $_POST['call_id'];
		$agent_id					= $_POST['agent_id'];   
		$address					= $_POST['address'];   
		$age_type					= $_POST['age_type'];
		$ano						= $_POST['ano'];
		$age						= $_POST['age'];
		$Gender						= $_POST['Gender'];
		$patient_name				= $_POST['patient_name'];
		$caller_name				= $_POST['caller_name'];
		$contact_no					= $_POST['phone_number']; 			
		$caller_id					= $_POST['caller_id'];
		$alt_no						= $_POST['alt_no'];
		$callerno					= $_POST['callerno'];
		$location					= $_POST['location'];
		$category					= explode("~",$_POST['category']);
		$subcategory				= explode("~",$_POST['subcategory']);
		$grievance					= explode("~",$_POST['grievance']);
		$risklevel					= explode("~",$_POST['risklevel']); 
		$referralsconcerned			= $_POST['referralsconcerned'];
		$co_remarks					= $_POST['co_remarks'];
		$District					= explode("~",$_POST['District']);
		$tehsil1					= explode("~",$_POST['tehsil1']);
		$city_name1					= explode("~",$_POST['city_name1']);
		$gender						= explode("~",$_POST['gender']);
		$supremarks					= $_POST['supremarks'];
		$maritalstatus				= $_POST['maritalstatus'];
		$education					= $_POST['education'];
		$occupation					= $_POST['occupation'];
		$economicstatus				= $_POST['economicstatus'];
		$consent					= $_POST['consent'];
		$consentforfollowup	        = $_POST['consentforfollowup'];
		$socialstatus	        = $_POST['socialstatus'];
		$socioeconomicstatus	        = $_POST['socioeconomicstatus'];
		$risklevel1	        = $_POST['risklevel1'];
		$welfare_remarks	        = $_POST['welfare_remarks'];
		$calltype       = $_POST['calltype'];
		$notanswered       = $_POST['notanswered'];
		$textfollowupdate = $_POST['txt_followup_date'];

 if($ano == '')
	 $ano =0 ;
  if($age == '')
	 $age =0 ;
  if($gender == '')
	 $gender =0 ;
  if($District[0] == '')
	 $District[0] =0 ;
  if($tehsil1[0] == '')
	 $tehsil1[0] =0 ;
  if($city_name1[0] == '')
	 $city_name1[0] =0 ;
  if($address == '')
	 $address =0 ;
  if($contact_no == '')
	 $contact_no =0 ;
  if($notanswered == '')
	 $notanswered =0 ;
  if($category[0] == '')
	$category[0] =0 ;
  if($subcategory[0] == '')
	 $subcategory[0] =0 ;
  if($risklevel[0] == '')
	 $risklevel[0] =0 ;
  if($referralsconcerned == '')
	 $referralsconcerned =0 ;
  if($callerno == '')
	 $callerno =0 ;
  if($patient_name == '')
	 $patient_name =0 ;
  if($caller_name == '')
	 $caller_name =0 ;
  if($location == '')
	 $location =0 ; 
 if($textfollowupdate == '')
	 $textfollowupdate = 0;
  
 
		
switch($action)
{
   case 'SaveDetails': 

 
			$Query123	= "INSERT INTO call_incident_info_details_suicide (`caller_id`,`patient_name`,`caller_name`,
						`alternate_number`,`age`,`gender_name`,`district_id`,
						`district_name`,`mandal_id`,`mandal_name`,`village_id`,`village_name`,`location`,phone_number,call_not_answered_reason) 
						VALUES ('".$_POST['call_id']."','".$patient_name."','".$caller_name."','".$ano."','".$age."','".$gender[1]."','".$District[0]."','".$District[1]."',
						'".$tehsil1[0]."','".$tehsil1[1]."','".$city_name1[0]."','".$city_name1[1]."','".$address."','".$contact_no."','".$notanswered."')";
					
 				
		mysql_query($Query123);
		dblog($Query123); 
		
		$Query1 = "UPDATE `call_incident_info` SET `call_type_id` = 32, `popup_close_time` = NOW() WHERE `callid` = '".$_POST['call_id']."';";
		mysql_query($Query1);
break;
		
 
		
case 'SaveDetailsCounsellor1': 
 
  
 $dba = mysql_fetch_array(mysql_query("SELECT cis.`caller_id` FROM `call_incident_info_details_suicide` cis
WHERE cis.phone_number = '".$callerno."' ORDER BY caller_id DESC LIMIT 1"));
 
	$Query123 = "UPDATE `call_incident_info_details_suicide` SET `patient_name` = '".$patient_name."',`caller_name` = '".$caller_name."',`alternate_number` = '".$alt_no."',
`age` = '".$age."', `gender_name` = '".$gender[1]."', `district_id` = '".$District[0]."', `district_name` = '".$District[1]."', `mandal_id` = '".$tehsil1[0]."', `mandal_name` = '".$tehsil1[1]."',
`village_id` = '".$city_name1[0]."',`village_name` = '".$city_name1[1]."', `location` = '".$location."',`call_type_id` = '".$calltype[0]."', `category_id` = '".$category[0]."', `sub_category_id` = '".$subcategory[0]."', 
`risk_level_id` = '".$risklevel[0]."',  `referrals_concerned_name` = '".$referralsconcerned."', `co_remarks` = '".mysql_escape_string($co_remarks)."',
`consent_for_welfarecall` = '".$consent."', `status` = 1, `call_end_time` = NOW(), `call_not_answered_reason` = '".$notanswered."' WHERE `caller_id` = '".$dba['caller_id']."'"; 
 
 	
 	mysql_query($Query123); 
	dblog($Query123);  
	
	$Query9 = "INSERT INTO incident_timings_suicide (`caller_id`,`agent_id`,`pop_up_time`,`level`,`type`) 
			   VALUES ('".$caller_id."','".$agent_id."',NOW(),'CO', 'POPUP' ) ";
	 
	mysql_query($Query9); 
	break;
 
 			case 'SaveDetailswelfare': 
			$Query123	= "INSERT INTO `welfare_call_details_suicide` (`callid`,`marital_status_id`,`education_status_id`,`occupation_status_id`,
			`economic_status_id`,`welfare_remarks`,`social_status_id`,`socio_economic_status_id`,`risk_level_name`,agent_id,call_not_answered_reason,followup_date,call_time) 
			VALUES ('".$_POST['caller_id']."','".$maritalstatus."','".$education."','".$occupation."','".$economicstatus."','".$welfare_remarks."'
			,'".$socialstatus."','".$socioeconomicstatus."','".$risklevel1."','".$agent_id."','".$notanswered."','".$textfollowupdate."',NOW())";	
			
			echo "INSERT INTO `welfare_call_details_suicide` (`callid`,`marital_status_id`,`education_status_id`,`occupation_status_id`,
			`economic_status_id`,`welfare_remarks`,`social_status_id`,`socio_economic_status_id`,`risk_level_name`,agent_id,call_not_answered_reason,followup_date,call_time) 
			VALUES ('".$_POST['caller_id']."','".$maritalstatus."','".$education."','".$occupation."','".$economicstatus."','".$welfare_remarks."'
			,'".$socialstatus."','".$socioeconomicstatus."','".$risklevel1."','".$agent_id."','".$notanswered."','".$textfollowupdate."',NOW())";
 
 
  	mysql_query($Query123); 
			
			dblog($Query123); 
			
			$Query1 = "UPDATE `call_incident_info_details_suicide` SET `consent_for_followup` = '".$consentforfollowup."', `status` = 2 where caller_id = '".$_POST['caller_id']."'";
  
  //echo "UPDATE `call_incident_info_details_suicide` SET `consent_for_followup` = '".$consentforfollowup."', `status` = 2 where caller_id = '".$_POST['caller_id']."'";
  
  mysql_query($Query1); 
			break;
 
 
   			case 'suicidequestionnare': 
			 
			$Query123	= "insert into `suicide_history` (`callid`,`relation_id`,`relation_name`,`finacial_reason_id`,`financial_reason_name`) 
			values ('".$_POST['caller_id']."','".$_POST['relation_id']."','".$_POST['relation_name']."','".$_POST['reason_id']."','".$_POST['reason_name']."')";	
		mysql_query($Query123);
 
		dblog($Query123); 
		
		$Query124 = "";
 break;
 
    			case 'notansweredreason': 
			 
			$Query123	= "UPDATE `call_incident_info_details_suicide` SET `call_not_answered_reason` = '".$notanswered[0]."',not_answered_time = NOW()  WHERE `caller_id` = '".$_POST['caller_id']."'";	

			mysql_query($Query123);
 
		dblog($Query123); 
		
		$Query124 = "";
 break;
 
     			case 'notansweredreasonfollowup': 
			 
			$Query123	= "UPDATE `followup_save_details` SET `followup_call_not_answered_reason` = '".$notanswered[0]."', `call_not_answered_time` = NOW()  WHERE `callid` = '".$_POST['caller_id']."'";	

			mysql_query($Query123);
 
		dblog($Query123); 
		
		$Query124 = "";
 break;
 }
		

 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/suicide_".date("Y-m-d_H").".csv";
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
