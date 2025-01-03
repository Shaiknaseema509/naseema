<?php 
require_once("dbconnect_emri.php");


$phone_number         = $_REQUEST["callernumber"]; 
$agent_id 	      = $_REQUEST["agent_id"];  
$convoxID      = $_REQUEST["convoxID"];  
$id       =		$_REQUEST["callid"]; 
$id1      =      $_REQUEST["caller_id"]; 
$question = 	$_POST["question"];
$atn1 	  = 	$_REQUEST["atn1"];
$atn2     = 	$_REQUEST["atn2"];
$amb_quest     = 	$_REQUEST["amb_quest"];
$amb_reach_time     = 	$_REQUEST["amb_reach_time"];
$amb_not_reach_time     = 	$_REQUEST["amb_not_reach_time"];
$ques_3     = 	$_REQUEST["ques_3"];
$psychiatry_sphl     = 	$_REQUEST["psychiatry_sphl"];
$provided_psychiatry     = 	$_REQUEST["provided_psychiatry"];
$referred_ngo     = 	$_REQUEST["referred_ngo"];
$referral_sphl     = 	$_REQUEST["referral_sphl"];
$contact_sphl     = 	$_REQUEST["contact_sphl"];
$referral_psychiartist     = 	$_REQUEST["referral_psychiartist"];
$contact_psychiartist     = 	$_REQUEST["contact_psychiartist"];
$referral_ngo     = 	$_REQUEST["referral_ngo"];
$contact_ngo     = 	$_REQUEST["contact_ngo"];
$referral_doctor     = 	$_REQUEST["referral_doctor"];
$contact_doctor     = 	$_REQUEST["contact_doctor"];
$qtn_5     = 	$_REQUEST["qtn_5"];
$provided_sphl_5     = 	$_REQUEST["provided_sphl_5"];
$referral_psychiatry_5     = 	$_REQUEST["referral_psychiatry_5"];
$contact_psychiatry_5     = 	$_REQUEST["contact_psychiatry_5"];
$provided_psychiatry_5     = 	$_REQUEST["provided_psychiatry_5"];
$referral_psychiartist_5     = 	$_REQUEST["referral_psychiartist_5"];
$contact_psychiartist_5     = 	$_REQUEST["contact_psychiartist_5"];
$referred_ngo_5     = 	$_REQUEST["referred_ngo_5"];
$referral_ngo_5     = 	$_REQUEST["referral_ngo_5"];
$contact_ngo_5     = 	$_REQUEST["contact_ngo_5"];
$doctor_consult_5     = 	$_REQUEST["doctor_consult_5"];
$referral_doctor_5     = 	$_REQUEST["referral_doctor_5"];
$contact_doctor_5     = 	$_REQUEST["contact_doctor_5"];
$qtn_6					=   $_REQUEST["qtn_6"];
$provided_psychiatry_6					=   $_REQUEST["provided_psychiatry_6"];
$referral_psychiatry_6					=   $_REQUEST["referral_psychiatry_6"];
$contact_psychiatry_6					=   $_REQUEST["contact_psychiatry_6"];
$provided_ngo_6					=   $_REQUEST["provided_ngo_6"];
$referral_psychiartist_6					=   $_REQUEST["referral_psychiartist_6"];
$contact_psychiartist_6					=   $_REQUEST["contact_psychiartist_6"];
$referred_lively_hood					=   $_REQUEST["referred_lively_hood"];
$referral_lively_hood					=   $_REQUEST["referral_lively_hood"];
$contact_lively_hood					=   $_REQUEST["contact_lively_hood"];
$legal_counselling_6					=   $_REQUEST["legal_counselling_6"];
$referral_legal_counselling_6					=   $_REQUEST["referral_legal_counselling_6"];
$any_medication_6					=   $_REQUEST["any_medication_6"];
$referral_mediaction_6					=   $_REQUEST["referral_mediaction_6"];
$contact_medication_6					=   $_REQUEST["contact_medication_6"];
$qtn_7					=   $_REQUEST["qtn_7"];
$followupdatetime					=   $_REQUEST["followupdatetime"];
$followup_level					=   $_REQUEST["followup_level"];
		$followup_level		= $_REQUEST['followup_level']; 
		
		$followup		= explode("~",$_POST['followup_level']);
		$followupId = $spoc[0];
		$followupName = $spoc[1];
	
 
 if($amb_reach_time == '')
	 $amb_reach_time =0;
 
 if($amb_not_reach_time == '')
	 $amb_not_reach_time =0;
 
 $Query123 = "insert into followup_save_details_07102020 set `callid` =  '".$id."',`ambulance_reached_on_time` = '".$amb_quest."',`ambulance_reach_time` = '".$amb_reach_time."', 
			`ambulance_not_availed_reasons`= '".$amb_not_reach_time."',followup_number ='".$followupId."', followup_datetime = NOW(), agent_id = '".$agent_id."',
			`police_attended_incident_location_in_time` = '".$question."',
			`police_reach_time_in_minutes` = '".$atn1."', `police_not_availed_reasons` = '".$atn2."',`how_are_you_feeling_now` ='".$ques_3."', `Provided_Psychiatry_counselling_at_SPHL_1` = '".$psychiatry_sphl."',
						`referral_sphl_1` = '".$referral_sphl."', `contact_sphl_1` = '".$contact_sphl."', `Referred_to_Psychiatry_Consultation_1` = '".$provided_psychiatry."', 
						`referral_psychiartist_1` = '".$referral_psychiartist."',
						`contact_psychiartist_1` = '".$contact_psychiartist."', `Referred_to_NGO_for_support_1` = '".$referred_ngo."', `referral_ngo_1` = '".$referral_ngo."', `contact_ngo_1` = '".$contact_ngo."', 
						`Referred_to_Doctor_Consultation_for_further_Medical_assistance_1` = '".$doctor_consult."', `referral_doctor_1` = '".$referral_doctor."',
						`contact_doctor_1` = '".$contact_doctor."',`Still_do_you_feel_depressed_or_hopelessness` = '".$qtn_5."', 
						`Provided_Psychiatry_counselling_at_SPHL_2` = '".$provided_sphl_5."',
						`referral_sphl_2` = '".$referral_psychiatry_5."', `contact_sphl_2` = '".$contact_psychiatry_5."', 
						`Referred_to_Psychiatry_Consultation_2` = '".$provided_psychiatry_5."', `referral_psychiartist_2` = '".$referral_psychiartist_5."',
						`contact_psychiartist_2` = '".$contact_psychiartist_5."', `Referred_to_NGO_for_support_2` = '".$referred_ngo_5."',
						`referral_ngo_2` = '".$referral_ngo_5."', `contact_ngo_2` = '".$contact_ngo_5."', 
						`Referred_to_Doctor_Consultation_for_further_Medical_assistance_2` = '".$doctor_consult_5."', `referral_doctor_2` = '".$referral_doctor_5."',
						`contact_doctor_2` = '".$contact_doctor_5."', `Do_you_need_any_support_or_service` = '".$qtn_6."' , 
						`Psychiatry_Consultation_Counselling` = '".$provided_psychiatry_6."',
						`referral_Psychiatry_3` = '".$referral_psychiatry_6."', `contact_Psychiatry_3` = '".$contact_psychiatry_6."', `NGO_Support` = '".$provided_ngo_6."', 
						`referral_ngo_3` = '".$referral_psychiartist_6."', `contact_ngo_3` = '".$contact_psychiartist_6."',
						`Lively_Hood_Support` = '".$referred_lively_hood."', `referral_lively_hood` = '".$referral_lively_hood."', `contact_lively_hood` = '".$contact_lively_hood."', 
						`Legal_Counselling_Support` = '".$legal_counselling_6."',`referral_legal_counselling` = '".$referral_legal_counselling_6."', 
						`contact_legal_counselling` = '".$contact_legal_counselling_6."', 
						`Any_Doctor_Consultation` = '".$any_medication_6."',`referral_doctor_Consultation` = '".$referral_mediaction_6."', `contact_doctor_consultation` = '".$contact_medication_6."',
						`are_you_willing_for_future_followup` = '".$qtn_7."', `next_follow_up_date` = '".$followupdatetime."'";
  echo "insert into followup_save_details_07102020 set `callid` =  '".$id."',`ambulance_reached_on_time` = '".$amb_quest."',`ambulance_reach_time` = '".$amb_reach_time."', 
			`ambulance_not_availed_reasons`= '".$amb_not_reach_time."',followup_number =1, followup_datetime = NOW(), agent_id = '".$agent_id."',
			`police_attended_incident_location_in_time` = '".$question."',
			`police_reach_time_in_minutes` = '".$atn1."', `police_not_availed_reasons` = '".$atn2."',`how_are_you_feeling_now` ='".$ques_3."', `Provided_Psychiatry_counselling_at_SPHL_1` = '".$psychiatry_sphl."',
						`referral_sphl_1` = '".$referral_sphl."', `contact_sphl_1` = '".$contact_sphl."', `Referred_to_Psychiatry_Consultation_1` = '".$provided_psychiatry."', 
						`referral_psychiartist_1` = '".$referral_psychiartist."',
						`contact_psychiartist_1` = '".$contact_psychiartist."', `Referred_to_NGO_for_support_1` = '".$referred_ngo."', `referral_ngo_1` = '".$referral_ngo."', `contact_ngo_1` = '".$contact_ngo."', 
						`Referred_to_Doctor_Consultation_for_further_Medical_assistance_1` = '".$doctor_consult."', `referral_doctor_1` = '".$referral_doctor."',
						`contact_doctor_1` = '".$contact_doctor."',`Still_do_you_feel_depressed_or_hopelessness` = '".$qtn_5."', 
						`Provided_Psychiatry_counselling_at_SPHL_2` = '".$provided_sphl_5."',
						`referral_sphl_2` = '".$referral_psychiatry_5."', `contact_sphl_2` = '".$contact_psychiatry_5."', 
						`Referred_to_Psychiatry_Consultation_2` = '".$provided_psychiatry_5."', `referral_psychiartist_2` = '".$referral_psychiartist_5."',
						`contact_psychiartist_2` = '".$contact_psychiartist_5."', `Referred_to_NGO_for_support_2` = '".$referred_ngo_5."',
						`referral_ngo_2` = '".$referral_ngo_5."', `contact_ngo_2` = '".$contact_ngo_5."', 
						`Referred_to_Doctor_Consultation_for_further_Medical_assistance_2` = '".$doctor_consult_5."', `referral_doctor_2` = '".$referral_doctor_5."',
						`contact_doctor_2` = '".$contact_doctor_5."', `Do_you_need_any_support_or_service` = '".$qtn_6."' , 
						`Psychiatry_Consultation_Counselling` = '".$provided_psychiatry_6."',
						`referral_Psychiatry_3` = '".$referral_psychiatry_6."', `contact_Psychiatry_3` = '".$contact_psychiatry_6."', `NGO_Support` = '".$provided_ngo_6."', 
						`referral_ngo_3` = '".$referral_psychiartist_6."', `contact_ngo_3` = '".$contact_psychiartist_6."',
						`Lively_Hood_Support` = '".$referred_lively_hood."', `referral_lively_hood` = '".$referral_lively_hood."', `contact_lively_hood` = '".$contact_lively_hood."', 
						`Legal_Counselling_Support` = '".$legal_counselling_6."',`referral_legal_counselling` = '".$referral_legal_counselling_6."', 
						`contact_legal_counselling` = '".$contact_legal_counselling_6."', 
						`Any_Doctor_Consultation` = '".$any_medication_6."',`referral_doctor_Consultation` = '".$referral_mediaction_6."', `contact_doctor_consultation` = '".$contact_medication_6."',
						`are_you_willing_for_future_followup` = '".$qtn_7."', `next_follow_up_date` = '".$followupdatetime."'";

 
 

			mysql_query($Query123);
			dblog($Query123); 
 
 
 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/followup_".date("Y-m-d_H").".csv";
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
			 