<?php
require_once("dbconnect_emri.php");

date_default_timezone_set('Asia/Calcutta'); 

$action = $_POST["action"];

switch($action)
 {
   case "CLOSE" :
	
	$agent_id             = $_POST["agent_id"];
	$CallTypeSSub             = $_POST["CallTypeSSub"];
	$call_hit_referenceno = $_POST["call_hit_referenceno"];
	$call_type_id         = $_POST["call_type_id"];
	$subCatMul         = $_POST["subCatMul"];
	$callTypedup         = $_POST["callTypedup"];
	$call_information_id  = ($_POST["call_information_id"])?$_POST["call_information_id"]:0;
	$beneficiary_id       = $_POST["beneficiary_id"];
	$callid			= $_POST["call_id"];

	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	//$Details1 = mysql_fetch_array($Result1);
	//$agent_status = $Details1["status"];
	//$action_id = $Details1["actionid"];
$Query2 = "SELECT callid FROM call_incident_info WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		$Result2 = mysql_query($Query2);
	/*if($agent_status == "ONCALL")
	 {
		$Query2 = "SELECT callid FROM call_incident_info WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		$Result2 = mysql_query($Query2);
		$Details2 = mysql_fetch_array($Result2);
		$call_id = $Details2["callid"];
		
		$Query3 = "UPDATE call_conversations SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		//$Query4 = "UPDATE call_incident_info SET call_end_time=NOW() WHERE callid='".$callid."' ;";
		//mysql_query($Query4);
	 } */
	if($call_type_id =='') $call_type_id=44;
	if($call_type_id == 13)
	{
		$Query5 = "delete from registration_patient where WHERE callid='".$callid."';";
		mysql_query($Query5);
	}
	if($call_type_id !=36)  $subCatMul='';
	if($call_type_id ==39)
	{if($CallTypeSSub =='')  $CallTypeSSub=5;
	if($CallTypeSSub ==0)  $CallTypeSSub=5;}
	else {$CallTypeSSub =0;}
	//if($CallTypeSSub =='')  $CallTypeSSub=5;
	
	//$sba= mysql_fetch_array(mysql_query("select call_type_id from call_incident_info where callid='".$callid."'"));
	//if($sba['call_type_id'] !='')
	//{	
		#$Query5 = "UPDATE call_incident_info SET call_information_id='".$CallTypeSSub."',service_id='".$subCatMul."',call_type_id='".$call_type_id."', call_information_id='".$call_information_id."',popup_close_time=NOW(),call_end_time=NOW() WHERE callid='".$callid."' ;";
		$Query5 = "UPDATE call_incident_info SET call_information_id='".$CallTypeSSub."',service_id='".$subCatMul."',call_type_id='".$call_type_id."',popup_close_time=NOW(),call_end_time=NOW() WHERE callid='".$callid."' ;";
		$Query5new = "UPDATE call_incident_info_new SET call_information_id='".$CallTypeSSub."',service_id='".$subCatMul."',call_type_id='".$call_type_id."', popup_close_time=NOW(),call_end_time=NOW() WHERE callid='".$callid."' ;";
		$Query5Log = "UPDATE call_incident_info SET call_information_id='".$CallTypeSSub."',service_id='".$subCatMul."',call_type_id='".$call_type_id."', popup_close_time='".date("Y-m-d H:i:s")."',call_end_time='".date("Y-m-d H:i:s")."' WHERE callid='".$callid."' ;";
		mysql_query($Query5);
		//mysql_query($Query5new);
		
		dblog($Query5Log);
	//}
	 $Query = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	// $Query = "DELETE FROM agentcallid WHERE agent_id='".$agent_id."';";
	mysql_query($Query);

	if($callTypedup == 9999)
	 {
		$past_history		= $_POST["past_history"];
		$present_compalint	= $_POST["present_compalint"];
		$advice_given		= $_POST["advice_given"];
		$Advice_sought_by	= $_POST["Advice_sought_by"];
		$advice			= $_POST["advice"];
		$beneficiary_id       	= $_POST["beneficiary_id"];
		
		$service_type		= $_POST["service_type"];

		$Query6 = "INSERT INTO Call_benificiary SET callid='".$callid."', benificiary_id='".$beneficiary_id."', service_type='".$service_type."' , advice_by='".$advice_given."', addvice_sought_by='".$Advice_sought_by."', Past_history='".$past_history."', present_symptoms='".$present_compalint."', advice='".$advice."', advice_time=NOW();";
		mysql_query($Query6);
	 }
	 echo 1;

   break;
   
   case "CLOSESCHEME" :
	
	$remarks             = $_POST["remarks"];
	$CallTypeSSub             = $_POST["CallTypeSSub"];
	$agent_id             = $_POST["agent_id"];
	$call_hit_referenceno = $_POST["call_hit_referenceno"];
	$call_type_id         = $_POST["call_type_id"];
	$callTypedup         = $_POST["callTypedup"];
	$call_information_id  = ($_POST["call_information_id"])?$_POST["call_information_id"]:0;
	$beneficiary_id       = $_POST["beneficiary_id"];
	$cat_sub_directory       = $_POST["cat_sub_directory"];
	$callid			= $_POST["call_id"];
	$cou			= $_POST["cou"];

	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];
	
	if($call_type_id ==39)
	{if($CallTypeSSub =='')  $CallTypeSSub=3;
	if($CallTypeSSub ==0)  $CallTypeSSub=3;}
	else {$CallTypeSSub =0;}

	for($i=1;$i<=$cou;$i++)
	{
		$cat= $_POST['id'.$i];
		
		$cat_sub_directory_id		= explode("~",$cat_sub_directory); 
		if($cat_sub_directory_id[0] !='') $cat_sub_directory_id=$cat_sub_directory_id[0]; else $cat_sub_directory_id=0;
		$Query6 = "INSERT INTO govt_scheme_result SET call_id='".$callid."', sub_category_id='".$cat_sub_directory_id."', govt_schemes_id='".$cat."' ,
		agent_id='".$agent_id."';";
		mysql_query($Query6);
		dblog($Query6);
	}
	//die;
		
	if($agent_status == "ONCALL")
	 {
		$Query2 = "SELECT callid FROM call_incident_info WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		$Result2 = mysql_query($Query2);
		$Details2 = mysql_fetch_array($Result2);
		$call_id = $Details2["callid"];
		
		$Query3 = "UPDATE call_conversations SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		//$Query4 = "UPDATE call_incident_info SET call_end_time=NOW() WHERE callid='".$callid."' ;";
		//mysql_query($Query4);
	 }
	
	if($call_type_id == 13)
	{
		$Query5 = "delete from registration_patient where WHERE callid='".$callid."';";
		mysql_query($Query5);
	}
	 
	/*$Query5 = "UPDATE call_incident_info SET call_information_id='".$CallTypeSSub."',call_type_id='".$call_type_id."', call_information_id='".$call_information_id."',
	popup_close_time=NOW(),call_end_time=NOW(),remarks='".mysql_escape_string($remarks)."' WHERE callid='".$callid."' ;"; */
	
	$Query5 = "UPDATE call_incident_info SET call_information_id='".$CallTypeSSub."',call_type_id='".$call_type_id."',popup_close_time=NOW(),call_end_time=NOW(),remarks='".mysql_escape_string($remarks)."' WHERE callid='".$callid."' ;";
	
	mysql_query($Query5);
	dblog($Query5);

	 $Query = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	  //$Query = "DELETE FROM agentcallid WHERE agent_id='".$agent_id."';";
	mysql_query($Query);

	if($callTypedup == 9999)
	 {
		$past_history		= $_POST["past_history"];
		$present_compalint	= $_POST["present_compalint"];
		$advice_given		= $_POST["advice_given"];
		$Advice_sought_by	= $_POST["Advice_sought_by"];
		$advice			= $_POST["advice"];
		$beneficiary_id       	= $_POST["beneficiary_id"];
		
		$service_type		= $_POST["service_type"];

		$Query6 = "INSERT INTO Call_benificiary SET callid='".$callid."', benificiary_id='".$beneficiary_id."', service_type='".$service_type."' , advice_by='".$advice_given."', addvice_sought_by='".$Advice_sought_by."', Past_history='".$past_history."', present_symptoms='".$present_compalint."', advice='".$advice."', advice_time=NOW();";
		mysql_query($Query6);
	 }

   break;
   
   
   case "COUNSELLINGCLOSE" :
	
	$agent_id             = $_POST["agent_id"];
	$call_hit_referenceno = $_POST["call_hit_referenceno"];
	$call_id         = $_POST["call_id"];
	$tRemarks         = $_POST["tRemarks"];
	 
	 
	$Query5 = "UPDATE call_incident_info SET  transferEndTime=NOW() WHERE callid='".$call_id."' ;";
	mysql_query($Query5);
	
	$Query5 = "UPDATE registration SET  tRemarks='".$tRemarks."' WHERE call_id='".$call_id."' ;";
	mysql_query($Query5);
 

   break;

   case "MEDICALADVICECATEGORY" :
	
	$call_id     = ($_POST["call_id"])?$_POST["call_id"]:0;
	$category_id = $_POST["category_id"];
	
	$Query = "INSERT INTO medical_advice SET callid=".$call_id.", category_id=".$category_id.";";
	mysql_query($Query);

   break;

   case "MEDICALADVICESUBCATEGORY" :
	
	$call_id         = ($_POST["call_id"])?$_POST["call_id"]:0;
	$category_id     = $_POST["category_id"];
	$sub_category_id = $_POST["sub_category_id"];

	$SelectQuery = "SELECT subcategory_id FROM medical_advice WHERE callid=".$call_id." AND category_id=".$category_id.";";
	$SelectResult = mysql_query($SelectQuery);
	$SelectDetails = mysql_fetch_array($SelectResult);
	$subcategory_id = $SelectDetails["subcategory_id"];	

	if($subcategory_id == 0)
	 {
		$Query = "UPDATE medical_advice SET subcategory_id=".$sub_category_id." WHERE callid=".$call_id." AND category_id=".$category_id.";";
		mysql_query($Query);
	 }
	else if($sub_category_id != $subcategory_id)
	 {
		$Query = "INSERT INTO medical_advice SET callid=".$call_id.", category_id=".$category_id.", subcategory_id=".$sub_category_id.";";
		mysql_query($Query);
	 }

   break;

   case "MEDICALADVICEQUESTIONRESPONSE" :
	
	$call_id         = ($_POST["call_id"])?$_POST["call_id"]:0;
	$category_id     = $_POST["category_id"];
	$sub_category_id = $_POST["sub_category_id"];
	$question_id     = $_POST["question_id"];
	$response_id     = $_POST["response_id"];

	$SelectQuery = "SELECT sno FROM medical_advice WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id." ORDER BY sno DESC LIMIT 1;";
	$SelectResult =	mysql_query($SelectQuery);
	$SelectDetails = mysql_fetch_array($SelectResult);
	$sno = $SelectDetails["sno"];
	if($sno == 0)
	 {
		$Query = "UPDATE medical_advice SET question_id=".$question_id.", response_id=".$response_id.", sno=1 WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id.";";
		mysql_query($Query);
	 }
	else if($sno > 0)
	 {
		$sno = $sno+1;
		$Query = "INSERT INTO medical_advice SET callid=".$call_id.", category_id=".$category_id.", subcategory_id=".$sub_category_id.", question_id=".$question_id.", response_id=".$response_id.", sno=".$sno.";";
		mysql_query($Query);
	 }

   break;

   case "DELETEPREVIOUSQUESTION" :
		
	$call_id         = ($_POST["call_id"])?$_POST["call_id"]:0;
        $category_id     = $_POST["category_id"];
        $sub_category_id = $_POST["sub_category_id"];

        $SelectQuery = "SELECT sno FROM medical_advice WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id." ORDER BY sno DESC LIMIT 1;";
        $SelectResult = mysql_query($SelectQuery);
        $SelectDetails = mysql_fetch_array($SelectResult);
        $sno = $SelectDetails["sno"];
        if($sno == 1)
         {
		$Query = "UPDATE medical_advice SET question_id=0, response_id=0, sno=0 WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id.";";
		mysql_query($Query);
	 }
	else if($sno > 1)
	 {
		$Query = "DELETE FROM medical_advice WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id." AND sno=".$sno.";";
		mysql_query($Query);
	 }

   break;

   case "COUNSELLINGCATEGORY" :
	
	$call_id     = ($_POST["call_id"])?$_POST["call_id"]:0;
	$category_id = $_POST["category_id"];
	
	$Query = "INSERT INTO counselling SET callid=".$call_id.", category_id=".$category_id.";";
	mysql_query($Query);

   break;

   case "COUNSELLINGSUBCATEGORY" :
	
	$call_id     = ($_POST["call_id"])?$_POST["call_id"]:0;
	$category_id = $_POST["category_id"];
	$sub_category_id = $_POST["sub_category_id"];
	
	$SelectQuery = "SELECT subcategory_id FROM counselling WHERE callid=".$call_id." AND category_id=".$category_id.";";
	$SelectResult = mysql_query($SelectQuery);
	$SelectDetails = mysql_fetch_array($SelectResult);
	$subcategory_id = $SelectDetails["subcategory_id"];	

	if($subcategory_id == 0)
	 {
		$Query = "UPDATE counselling SET subcategory_id=".$sub_category_id." WHERE callid=".$call_id." AND category_id=".$category_id.";";
		mysql_query($Query);
	 }
	else if($sub_category_id != $subcategory_id)
	 {
		$Query = "INSERT INTO counselling SET callid=".$call_id.", category_id=".$category_id.", subcategory_id=".$sub_category_id.";";
		mysql_query($Query);
	 }

   break;

   case "COUNSELLINGQUESTIONRESPONSE":

	$call_id         = ($_POST["call_id"])?$_POST["call_id"]:0;
        $category_id     = $_POST["category_id"];
        $sub_category_id = $_POST["sub_category_id"];
        $question_id     = $_POST["question_id"];
        $response_id     = $_POST["response_id"];

        $SelectQuery = "SELECT sno FROM counselling WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id." ORDER BY sno DESC LIMIT 1;";
        $SelectResult = mysql_query($SelectQuery);
        $SelectDetails = mysql_fetch_array($SelectResult);
        $sno = $SelectDetails["sno"];
        if($sno == 0)
         {
                $Query = "UPDATE counselling SET question_id=".$question_id.", response_id=".$response_id.", sno=1 WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id.";";
                mysql_query($Query);
         }
        else if($sno > 0)
         {
                $sno = $sno+1;
                $Query = "INSERT INTO counselling SET callid=".$call_id.", category_id=".$category_id.", subcategory_id=".$sub_category_id.", question_id=".$question_id.", response_id=".$response_id.", sno=".$sno.";";
                mysql_query($Query);
         }

   break;
	
   case "DELETECOUNSELLINGPREVIOUSQUESTION" :

        $call_id         = ($_POST["call_id"])?$_POST["call_id"]:0;
        $category_id     = $_POST["category_id"];
        $sub_category_id = $_POST["sub_category_id"];

        $SelectQuery = "SELECT sno FROM counselling WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id." AND question_id=".$question_id." AND response_id=".$response_id." ORDER BY sno DESC LIMIT 1;";
        $SelectResult = mysql_query($SelectQuery);
        $SelectDetails = mysql_fetch_array($SelectResult);
        $sno = $SelectDetails["sno"];
        if($sno == 1)
         {
                $Query = "UPDATE counselling SET question_id=0, response_id=0, sno=0 WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id.";";
                mysql_query($Query);
         }
        else if($sno > 1)
         {
                $Query = "DELETE FROM counselling WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id." AND sno=".$sno.";";
                mysql_query($Query);
         }

   break;
   
   
   
    case "agencyAssigned":

		$call_id         = ($_POST["call_id"])?$_POST["call_id"]:0;
        $category_id     = $_POST["category_id"];
        $sub_category_id = $_POST["sub_category_id"];
        $question_id     = $_POST["question_id"];
        $response_id     = $_POST["response_id"];
        $agency		     = $_POST["agency"];

        $SelectQuery = "SELECT agency FROM agency_assigned WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id." ORDER BY sno DESC LIMIT 1;";
        $SelectResult = mysql_query($SelectQuery);
        $SelectDetails = mysql_fetch_array($SelectResult);
        $sno = $SelectDetails["agency"];
        if($sno == 0)
         {
                $Query = "UPDATE agency_assigned SET agency=".$question_id.", response_id=".$response_id.", sno=1 WHERE callid=".$call_id." AND category_id=".$category_id." AND subcategory_id=".$sub_category_id.";";
                mysql_query($Query);
         }
        else if($sno > 0)
         {
                $sno = $sno+1;
                $Query = "INSERT INTO agency_assigned SET callid=".$call_id.", category_id=".$category_id.", subcategory_id=".$sub_category_id.", question_id=".$question_id.", response_id=".$response_id.", sno=".$sno.";";
                mysql_query($Query);
         }

   break;
   
   

 }	
 
 
 
 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/save_inbound_questions_".date("Y-m-d_H").".csv";
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
