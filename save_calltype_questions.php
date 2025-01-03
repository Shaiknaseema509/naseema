<?php
require_once("dbconnect_emri.php");

$type = $_POST["type"];

switch($type)
 {

   case "CLOSE" :
	
	$agent_id             = $_POST["agent_id"];
	$call_hit_referenceno = $_POST["call_hit_referenceno"];
	$beneficiary_id       = $_POST["beneficiary_id"];

	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];

	if($agent_status == "ONCALL")
	 {
		$Query2 = "SELECT callid FROM call_incident_info_out WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		$Result2 = mysql_query($Query2);
		$Details2 = mysql_fetch_array($Result2);
		$call_id = $Details2["callid"];
		
		$Query3 = "UPDATE call_conversations_out SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		$Query4 = "UPDATE call_incident_info_out SET call_end_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		mysql_query($Query4);
	 }

	$Query5 = "UPDATE call_incident_info_out SET beneficiary_id='".$beneficiary_id."', popup_close_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
	mysql_query($Query5);

	$Query = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query);

   break;

   case "one" :

	$call_hit_referenceno = $_POST["call_hit_referenceno"];	
	$agent_id             = $_POST["agent_id"];
	$call_id              = ($_POST["call_id"])?$_POST["call_id"]:0;
	$beneficiary_id       = $_POST["beneficiary_id"];
	$mcp_card 	      = $_POST["mcp_card"];
	$blood_test           = $_POST["blood_test"];
	$urine_test	      = $_POST["urine_test"];
	$blood_pressure       = $_POST["blood_pressure"];
	$calcium_tablet	      = $_POST["calcium_tablet"];
        $weight		      = $_POST["weight"];
	$tt_injection         = $_POST["tt_injection"];
	$acid_tablet	      = $_POST["acid_tablet"];
	$food_info	      = $_POST["food_info"];
	$danger_pregnancy     = $_POST["danger_pregnancy"];
	$risk_prone_pregnancy = $_POST["risk_prone_pregnancy"];
	$beneficiary_num      = $_POST["beneficiary_num"];
	$asha_num             = $_POST["asha_num"];
	$anm_num              = $_POST["anm_num"];
	$beneficiary_name     = $_POST["beneficiary_name"];

	$Query = "INSERT INTO calltype1 SET callid=".$call_id.", beneficiary_id='".$beneficiary_id."', mcp_card='".$mcp_card."', blood_test='".$blood_test."', urine_test='".$urine_test."', blood_pressure='".$blood_pressure."', calcium_tablet='".$calcium_tablet."', weight='".$weight."', tt_injection='".$tt_injection."', acid_tablet='".$acid_tablet."', food_info='".$food_info."', danger_pregnancy='".$danger_pregnancy."', risk_prone_pregnancy='".$risk_prone_pregnancy."';";
	mysql_query($Query);

	if($mcp_card == 'No')
	 {
		$SelQuery = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=1;";
		$SelResult = mysql_query($SelQuery);
		while($SelDetails = mysql_fetch_array($SelResult))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आपके कार्यक्षेत्र – गांव की ".$beneficiary_name." जी जो कि गर्भवती हैं और जिनका एम०सी०पी० कार्ड अभी तक नहीं बना है कृपया उनसे सम्पर्क करके कार्ड बनवायें।', entry_time=NOW(), push_time='".$push_time."';";
			mysql_query($InsQuery);
		 }	
	 }

	$convox_ivr_id = "";

	if($blood_test == 'No' && $urine_test == 'No' && $blood_pressure == 'No' && $calcium_tablet == 'No' && $weight == 'No' && $tt_injection == 'No' && $acid_tablet == 'No' && $food_info == 'No' && $danger_pregnancy == 'No' && $risk_prone_pregnancy == 'No')
	 {
		$SelQuery = "SELECT receipent_type, push_days, ivr_id FROM sms_details WHERE question_id=2;";
                $SelResult = mysql_query($SelQuery);
                while($SelDetails = mysql_fetch_array($SelResult))
                 {
                        $receipent_type = $SelDetails["receipent_type"];
                        $push_days      = $SelDetails["push_days"];
                        $ivr_id         = $SelDetails["ivr_id"];
			
			$convox_ivr_id .= $SelDetails["ivr_id"]."@@";

                        if($receipent_type == 'benificiary')
                         {
                                $mobile_number = $beneficiary_num;
                         }
                        else if($receipent_type == 'ASHA')
                         {
                                $mobile_number = $asha_num;
                         }
                        else if($receipent_type == 'ANM')
                         {
                                $mobile_number = $anm_num;
                         }

                        $push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

                        $InsQuery = "INSERT INTO ivr_queue SET ivr_id='".$ivr_id."', mobile_number='".$mobile_number."', entry_time=NOW(), push_time='".$push_time."';";
                        mysql_query($InsQuery);
                 }
         }

	echo $convox_ivr_id = substr($convox_ivr_id,0,-2);

	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];

	if($agent_status == "ONCALL")
	 {
		$Query3 = "UPDATE call_conversations_out SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		$Query4 = "UPDATE call_incident_info_out SET call_end_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		mysql_query($Query4);
	 }

	$Query5 = "UPDATE call_incident_info_out SET beneficiary_id='".$beneficiary_id."', popup_close_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
	mysql_query($Query5);
	
	$Query6 = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query6);

   break;
	
   case "two" :
	
	$call_hit_referenceno           = $_POST["call_hit_referenceno"];	
	$agent_id                       = $_POST["agent_id"];
        $call_id         		= ($_POST["call_id"])?$_POST["call_id"]:0;
        $beneficiary_id 		= $_POST["beneficiary_id"];
	$child_drinking_mother_milk     = $_POST["child_drinking_mother_milk"];
	$child_vaccines_three_month	= $_POST["child_vaccines_three_month"];
	$adopted_family_planning        = $_POST["adopted_family_planning"];
	$to_know_family_planning	= $_POST["to_know_family_planning"];
	$weight_baby_measured_anm	= $_POST["weight_baby_measured_anm"];

	$beneficiary_num      		= $_POST["beneficiary_num"];
	$asha_num             		= $_POST["asha_num"];
	$anm_num              		= $_POST["anm_num"];
	$beneficiary_name     		= $_POST["beneficiary_name"];
	$benificary_village  		= $_POST["benificary_village"];

	$Query = "INSERT INTO calltype2 SET callid=".$call_id.", beneficiary_id='".$beneficiary_id."', child_drinking_mother_milk='".$child_drinking_mother_milk."', child_vaccines_three_month='".$child_vaccines_three_month."', adopted_family_planning='".$adopted_family_planning."', to_know_family_planning='".$to_know_family_planning."', weight_baby_measured_anm='".$weight_baby_measured_anm."';";
	mysql_query($Query);
	
	if($mcp_card == 'Yes')
	 {
		$SelQuery1 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=16;";
		$SelResult1 = mysql_query($SelQuery1);
		while($SelDetails = mysql_fetch_array($SelResult1))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery1 = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी परिवार नियोजन के साधनों के विषय में जानकारी लेना चाहती हैं कृपया उनसे सम्पर्क करके उचुत जानकारी प्रदान करें।', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery1);
		 }
		
		$SelQuery2 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=17;";
		$SelResult2 = mysql_query($SelQuery2);
		while($SelDetails = mysql_fetch_array($SelResult2))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery2 = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी के बच्चे का वजन नहीं मापा गया है। कृपया उनके घर जाकर बच्चे का वजन लें।', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery2);
		 }
	
	 }	

	$convox_ivr_id = "";

	if($child_drinking_mother_milk == 'No')
	 {
		$SelQuery = "SELECT receipent_type, push_days, ivr_id FROM sms_details WHERE question_id IN (13);";
                $SelResult = mysql_query($SelQuery);
                while($SelDetails = mysql_fetch_array($SelResult))
                 {
                        $receipent_type = $SelDetails["receipent_type"];
                        $push_days      = $SelDetails["push_days"];
                        $ivr_id         = $SelDetails["ivr_id"];

			$convox_ivr_id .= $SelDetails["ivr_id"]."@@";

                        if($receipent_type == 'benificiary')
                         {
                                $mobile_number = $beneficiary_num;
                         }
                        else if($receipent_type == 'ASHA')
                         {
                                $mobile_number = $asha_num;
                         }
                        else if($receipent_type == 'ANM')
                         {
                                $mobile_number = $anm_num;
                         }

                        $push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

                        $InsQuery = "INSERT INTO ivr_queue SET ivr_id='".$ivr_id."', mobile_number='".$mobile_number."', entry_time=NOW(), push_time='".$push_time."'";
                        mysql_query($InsQuery);
                 }
         }

	echo $convox_ivr_id = substr($convox_ivr_id,0,-2);


	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];

	if($agent_status == "ONCALL")
	 {
		$Query3 = "UPDATE call_conversations_out SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		$Query4 = "UPDATE call_incident_info_out SET call_end_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		mysql_query($Query4);
	 }

	$Query5 = "UPDATE call_incident_info_out SET beneficiary_id='".$beneficiary_id."', popup_close_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
	mysql_query($Query5);

	$Query6 = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query6);

   break;

   case "three":

	$call_hit_referenceno           = $_POST["call_hit_referenceno"];	
	$agent_id                       = $_POST["agent_id"];
	$call_id                	= ($_POST["call_id"])?$_POST["call_id"]:0;
        $beneficiary_id         	= $_POST["beneficiary_id"];
	$delivery_govt_hospital		= $_POST["delivery_govt_hospital"];
	$childbirth_home_id		= $_POST["childbirth_home_id"];
	$childbirth_home_value		= $_POST["childbirth_home_value"];
	$delivery_pvt_hospital_id	= $_POST["delivery_pvt_hospital_id"];
	$delivery_pvt_hospital_value	= $_POST["delivery_pvt_hospital_value"];
	$free_ambulance_fordelivery	= $_POST["free_ambulance_fordelivery"];
	$free_delivery	                = $_POST["free_delivery"];
	$need_undergo_surgery	        = $_POST["need_undergo_surgery"];
	$where_was_operation	        = $_POST["where_was_operation"];
	$govt_hospital_free	        = $_POST["govt_hospital_free"];
	$need_blood_labor	        = $_POST["need_blood_labor"];
	$get_free_blood                 = $_POST["get_free_blood"];
	$get_free_meals                 = $_POST["get_free_meals"];
	$get_money_enquiry              = $_POST["get_money_enquiry"];
	$child_drink_mothermilk         = $_POST["child_drink_mothermilk"];
	$giving_child_upperdiet         = $_POST["giving_child_upperdiet"];
	$child_examined_byASHA          = $_POST["child_examined_byASHA"];
	$ASHA_check_sixtoseven          = $_POST["ASHA_check_sixtoseven"];
	$ASHA_check_below_sixtime       = $_POST["ASHA_check_below_sixtime"];
	$child_vaccine_before24hr       = $_POST["child_vaccine_before24hr"];
	$adopted_family_planning        = $_POST["adopted_family_planning"];
	$info_family_planning           = $_POST["info_family_planning"];
	$want_to_adopt_familyPlan       = $_POST["want_to_adopt_familyPlan"];
	$family_allow_familyPlan        = $_POST["family_allow_familyPlan"];
	$familyPlan_facility_hospital   = $_POST["familyPlan_facility_hospital"];
	$beneficiary_num      = $_POST["beneficiary_num"];
	$asha_num             = $_POST["asha_num"];
	$anm_num              = $_POST["anm_num"];
	$beneficiary_name     = $_POST["beneficiary_name"];
	$village              = $_POST["village"];

	$Query = "INSERT INTO calltype3 SET callid=".$call_id.", beneficiary_id='".$beneficiary_id."', delivery_govt_hospital='".$delivery_govt_hospital."', childbirth_home_id='".$childbirth_home_id."', childbirth_home_value='".$childbirth_home_value."', delivery_pvt_hospital_id='".$delivery_pvt_hospital_id."', delivery_pvt_hospital_value='".$delivery_pvt_hospital_value."', free_ambulance_fordelivery='".$free_ambulance_fordelivery."', free_delivery='".$free_delivery."', need_undergo_surgery='".$need_undergo_surgery."', where_was_operation='".$where_was_operation."', govt_hospital_free='".$govt_hospital_free."', need_blood_labor='".$need_blood_labor."', get_free_blood='".$get_free_blood."', get_free_meals='".$get_free_meals."', get_money_enquiry='".$get_money_enquiry."', child_drink_mothermilk='".$child_drink_mothermilk."', giving_child_upperdiet='".$giving_child_upperdiet."', child_examined_byASHA='".$child_examined_byASHA."', ASHA_check_sixtoseven='".$ASHA_check_sixtoseven."', ASHA_check_below_sixtime='".$ASHA_check_below_sixtime."', child_vaccine_before24hr='".$child_vaccine_before24hr."', adopted_family_planning='".$adopted_family_planning."', info_family_planning='".$info_family_planning."', want_to_adopt_familyPlan='".$want_to_adopt_familyPlan."', family_allow_familyPlan='".$family_allow_familyPlan."', familyPlan_facility_hospital='".$familyPlan_facility_hospital."';";
	mysql_query($Query);
	
	$convox_ivr_id = "";

	if($child_drink_mothermilk == 'No')
	 {
		$SelQuery = "SELECT receipent_type, push_days, ivr_id FROM sms_details WHERE question_id=31;";
                $SelResult = mysql_query($SelQuery);
                while($SelDetails = mysql_fetch_array($SelResult))
                 {
                        $receipent_type = $SelDetails["receipent_type"];
                        $push_days      = $SelDetails["push_days"];
                        $ivr_id         = $SelDetails["ivr_id"];

			$convox_ivr_id .= $SelDetails["ivr_id"]."@@";

                        if($receipent_type == 'benificiary')
                         {
                                $mobile_number = $beneficiary_num;
                         }
                        else if($receipent_type == 'ASHA')
                         {
                                $mobile_number = $asha_num;
                         }
                        else if($receipent_type == 'ANM')
                         {
                                $mobile_number = $anm_num;
                         }

                        $push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

                        $InsQuery = "INSERT INTO ivr_queue SET ivr_id='".$ivr_id."', mobile_number='".$mobile_number."', entry_time=NOW(), push_time='".$push_time."';";
                        mysql_query($InsQuery);
                 }
         }

	if($giving_child_upperdiet == 'Yes')
	 {
		$SelQuery = "SELECT receipent_type, push_days, ivr_id FROM sms_details WHERE question_id=32;";
                $SelResult = mysql_query($SelQuery);
                while($SelDetails = mysql_fetch_array($SelResult))
                 {
                        $receipent_type = $SelDetails["receipent_type"];
                        $push_days      = $SelDetails["push_days"];
                        $ivr_id         = $SelDetails["ivr_id"];

			$convox_ivr_id .= $SelDetails["ivr_id"]."@@";

                        if($receipent_type == 'benificiary')
                         {
                                $mobile_number = $beneficiary_num;
                         }
                        else if($receipent_type == 'ASHA')
                         {
                                $mobile_number = $asha_num;
                         }
                        else if($receipent_type == 'ANM')
                         {
                                $mobile_number = $anm_num;
                         }

                        $push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

                        $InsQuery = "INSERT INTO ivr_queue SET ivr_id='".$ivr_id."', mobile_number='".$mobile_number."', entry_time=NOW(), push_time='".$push_time."';";
                        mysql_query($InsQuery);
                 }
         }

	echo $convox_ivr_id = substr($convox_ivr_id,0,-2);

        if($child_examined_byASHA == 'No')
	 {
		$SelQuery = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=33;";
		$SelResult = mysql_query($SelQuery);
		while($SelDetails = mysql_fetch_array($SelResult))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आपके कार्य क्षेत्र ".$village." गाँव की ".$beneficiary_name." जी के बच्चे को अस्पताल से वापस घर आने के बाद कोई जांच नहीं हुई है कृपया उनके घर जाकर जांच करें।', entry_time=NOW(), push_time='".$push_time."';";
			mysql_query($InsQuery);
		 }	
	 }

	if($ASHA_check_sixtoseven == 'Yes')
	 {
		$SelQuery = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=35;";
		$SelResult = mysql_query($SelQuery);
		while($SelDetails = mysql_fetch_array($SelResult))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आपके कार्य क्षेत्र ".$village." गाँव की ".$beneficiary_name." जी जी के बच्चे को आशा ने 06 से 07 बार नहीं देखा है इस विषय की जांच करें।', entry_time=NOW(), push_time='".$push_time."';";
			mysql_query($InsQuery);
		 }	
	 }
	
	if($child_vaccine_before24hr == 'No')
	 {
		$SelQuery = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=37;";
		$SelResult = mysql_query($SelQuery);
		while($SelDetails = mysql_fetch_array($SelResult))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आपके कार्य क्षेत्र ".$village." गाँव की ".$beneficiary_name." जी के बच्चे को पोलियों की खुराक बी०सी०जी० का टीका और हैपेटाइटिस बी का टीक अभी तक नहीं लगा है। कृपया उनसे सम्पर्क कर टीका लगाएं।', entry_time=NOW(), push_time='".$push_time."';";
			mysql_query($InsQuery);
		 }	
	 }

	if($adopted_family_planning == 'No' && $info_family_planning == 'No' && $want_to_adopt_familyPlan == 'No' && $family_allow_familyPlan == 'No' && $familyPlan_facility_hospital == 'No')
	 {
		$SelQuery = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=38;";
		$SelResult = mysql_query($SelQuery);
		while($SelDetails = mysql_fetch_array($SelResult))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आपके कार्य क्षेत्र ".$village." गाँव की ".$beneficiary_name." जी को परिवार नियोजन के साधन उपलब्ध नहीं हो पाएं हैं कृपया उनसे सम्पर्क कर सुविधा उपलब्ध कराएं।', entry_time=NOW(), push_time='".$push_time."';";
			mysql_query($InsQuery);
		 }	
	 }

	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];

	if($agent_status == "ONCALL")
	 {
		$Query3 = "UPDATE call_conversations_out SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		$Query4 = "UPDATE call_incident_info_out SET call_end_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		mysql_query($Query4);
	 }

	$Query5 = "UPDATE call_incident_info_out SET beneficiary_id='".$beneficiary_id."', popup_close_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
	mysql_query($Query5);

	$Query6 = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query6);

   break;

   case "four":

	$call_hit_referenceno      = $_POST["call_hit_referenceno"];	
	$agent_id                  = $_POST["agent_id"];
	$call_id                   = ($_POST["call_id"])?$_POST["call_id"]:0;
	$beneficiary_id            = $_POST["beneficiary_id"];
	$problem_in_pregnancy      = $_POST["problem_in_pregnancy"];
	$hazards_during_pregnancy  = $_POST["hazards_during_pregnancy"];
	$asha_anm_enquiry          = $_POST["asha_anm_enquiry"];
	$ultrasound_checked        = $_POST["ultrasound_checked"];

	
	$beneficiary_num      		= $_POST["beneficiary_num"];
	$asha_num             		= $_POST["asha_num"];
	$anm_num              		= $_POST["anm_num"];
	$beneficiary_name     		= $_POST["beneficiary_name"];
	$benificary_village  		= $_POST["benificary_village"];
	

	$Query = "INSERT INTO calltype4 SET callid=".$call_id.", beneficiary_id='".$beneficiary_id."', problem_in_pregnancy='".$problem_in_pregnancy."', hazards_during_pregnancy='".$hazards_during_pregnancy."', asha_anm_enquiry='".$asha_anm_enquiry."', ultrasound_checked='".$ultrasound_checked."';";
	mysql_query($Query);

	$convox_ivr_id = "";

	if($hazards_during_pregnancy == 'Yes')
	 {

		$SelQuery = "SELECT receipent_type, push_days, ivr_id FROM sms_details WHERE question_id IN (44);";
                $SelResult = mysql_query($SelQuery);
                while($SelDetails = mysql_fetch_array($SelResult))
                 {
                        $receipent_type = $SelDetails["receipent_type"];
                        $push_days      = $SelDetails["push_days"];
                        $ivr_id         = $SelDetails["ivr_id"];

			$convox_ivr_id .= $SelDetails["ivr_id"]."@@";

                        if($receipent_type == 'benificiary')
                         {
                                $mobile_number = $beneficiary_num;
                         }
                        else if($receipent_type == 'ASHA')
                         {
                                $mobile_number = $asha_num;
                         }
                        else if($receipent_type == 'ANM')
                         {
                                $mobile_number = $anm_num;
                         }

                        $push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

                        $InsQuery = "INSERT INTO ivr_queue SET ivr_id='".$ivr_id."', mobile_number='".$mobile_number."', entry_time=NOW(), push_time='".$push_time."'";
                        mysql_query($InsQuery);
                 }

         }

	echo $convox_ivr_id = substr($convox_ivr_id,0,-2);

	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];

	if($agent_status == "ONCALL")
	 {
		$Query3 = "UPDATE call_conversations_out SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		$Query4 = "UPDATE call_incident_info_out SET call_end_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		mysql_query($Query4);
	 }

	$Query5 = "UPDATE call_incident_info_out SET beneficiary_id='".$beneficiary_id."', popup_close_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
	mysql_query($Query5);

	$Query6 = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query6);

    break;  

   case "five" :
	 
	$call_hit_referenceno 		= $_POST["call_hit_referenceno"];	
	$agent_id         		= $_POST["agent_id"];
	$call_id          		= ($_POST["call_id"])?$_POST["call_id"]:0;
	$beneficiary_id   		= $_POST["beneficiary_id"];
	$selected_hospital_delivery  	= $_POST["selected_hospital_delivery"];	
	$anyone_during_delivery       	= $_POST["anyone_during_delivery"];
	$with_asha_delivery      	= $_POST["with_asha_delivery"];
	$bank_account_open_aadhar      	= $_POST["bank_account_open_aadhar"];
	$info_janani_yojana	  	= $_POST["info_janani_yojana"];
	$govt_expenditure 		= $_POST["govt_expenditure"];

	$beneficiary_num      		= $_POST["beneficiary_num"];
	$asha_num             		= $_POST["asha_num"];
	$anm_num              		= $_POST["anm_num"];
	$beneficiary_name     		= $_POST["beneficiary_name"];
	$benificary_village  		= $_POST["benificary_village"];

	
	$Query = "INSERT INTO calltype5 SET callid=".$call_id.", beneficiary_id='".$beneficiary_id."', selected_hospital_delivery='".$selected_hospital_delivery."', anyone_during_delivery='".$anyone_during_delivery."', with_asha_delivery='".$with_asha_delivery."', bank_account_open_aadhar='".$bank_account_open_aadhar."', info_janani_yojana='".$info_janani_yojana."', govt_expenditure='".$govt_expenditure."';";
	mysql_query($Query);

	if($mcp_card == 'No')
	 {
		$SelQuery1 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=49;";
		$SelResult1 = mysql_query($SelQuery1);
		while($SelDetails = mysql_fetch_array($SelResult1))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी जो कि गर्भवती हैं और जिन्होंने अभी तक प्रसव के लिये अस्पताल का चयन नहीं किया है कृपया उनसे सम्पर्क करके अस्पताल का चयन करायें। ', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery);
		 }	
		
		$SelQuery2 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=51;";
		$SelResult2 = mysql_query($SelQuery2);
		while($SelDetails = mysql_fetch_array($SelResult2))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी जो कि गर्भवती हैं और जिन्हें अभी तक यह नहीं पता कि कौन सा आशा बहन जी प्रसव के समय उनके साथ रहेगीं कृपया उनसे सम्पर्क करके यह जानकारी प्रदान करें। ', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery);
		 }
	
		$SelQuery3 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=54;";
		$SelResult3 = mysql_query($SelQuery3);
		while($SelDetails = mysql_fetch_array($SelResult3))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी जो कि गर्भवती हैं और जिन्हे जननी शिशु सुरक्षा योजना की जानकारी नहीं हैं कृपया उनसे सम्पर्क करके यह जानकारी प्रदान करें।  ', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery);
		 }

		$SelQuery4 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=55;";
		$SelResult4 = mysql_query($SelQuery4);
		while($SelDetails = mysql_fetch_array($SelResult4))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी  जो कि गर्भवती हैं और जिन्हें सरकार द्वारा प्रदान की जाने वाली खर्च वहन सम्बन्धित जानकारी नहीं है कृपया उनसे सम्पर्क करके यह जानकारी प्रदान करें। ', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery);
		 }	
		
	 }
	
	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];

	if($agent_status == "ONCALL")
	 {
		$Query3 = "UPDATE call_conversations_out SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		$Query4 = "UPDATE call_incident_info_out SET call_end_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		mysql_query($Query4);
	 }

	$Query5 = "UPDATE call_incident_info_out SET beneficiary_id='".$beneficiary_id."', popup_close_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
	mysql_query($Query5);

	$Query6 = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query6);

   break;

   case "six" :
	
	$call_hit_referenceno 			= $_POST["call_hit_referenceno"];	
	$call_id                      		= ($_POST["call_id"])?$_POST["call_id"]:0;
	$beneficiary_id               		= $_POST["beneficiary_id"];	
	$baby_diagnoise_measles              	= $_POST["baby_diagnoise_measles"];
	$vitamin_A_ninemonth                  	= $_POST["vitamin_A_ninemonth"];
	$other_than_mother_milk                 = $_POST["other_than_mother_milk"];
	$nutr_child_weight          		= $_POST["nutr_child_weight"];
	$nutr_childdrink_mohthermilk 		= $_POST["nutr_childdrink_mohthermilk"];
	$nutr_child_givenfood_4_5hr             = $_POST["nutr_child_givenfood_4_5hr"];
        $familyPlan_means_taken                 = $_POST["familyPlan_means_taken"];
        $familyPlan_info                    	= $_POST["familyPlan_info"];
        $familyPlan_diffbw_child                = $_POST["familyPlan_diffbw_child"];
        $familyPlan_adopt                      	= $_POST["familyPlan_adopt"];
        $familyPlan_allowed            		= $_POST["familyPlan_allowed"];
        $familyPlan_facility_hos             	= $_POST["familyPlan_facility_hos"];
        $know_means_familyPlan                 	= $_POST["know_means_familyPlan"];
	
	$beneficiary_num      			= $_POST["beneficiary_num"];
	$asha_num             			= $_POST["asha_num"];
	$anm_num              			= $_POST["anm_num"];
	$beneficiary_name     			= $_POST["beneficiary_name"];
	$benificary_village  			= $_POST["benificary_village"];
	
	$Query = "INSERT INTO calltype6 SET callid=".$call_id.", beneficiary_id='".$beneficiary_id."', baby_diagnoise_measles='".$baby_diagnoise_measles."', vitamin_A_ninemonth='".$vitamin_A_ninemonth."', other_than_mother_milk='".$other_than_mother_milk."', nutr_child_weight='".$nutr_child_weight."', nutr_childdrink_mohthermilk='".$nutr_childdrink_mohthermilk."', nutr_child_givenfood_4_5hr='".$nutr_child_givenfood_4_5hr."', familyPlan_means_taken='".$familyPlan_means_taken."', familyPlan_info='".$familyPlan_info."', familyPlan_diffbw_child='".$familyPlan_diffbw_child."', familyPlan_adopt='".$familyPlan_adopt."', familyPlan_allowed='".$familyPlan_allowed."', familyPlan_facility_hos='".$familyPlan_facility_hos."', know_means_familyPlan='".$know_means_familyPlan."';";
	mysql_query($Query);
	
	if($mcp_card == 'No')
	 {
		$SelQuery1 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=56;";
		$SelResult1 = mysql_query($SelQuery1);
		while($SelDetails = mysql_fetch_array($SelResult1))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी के बच्चे को खसरे का टीका अभी तक नहीं लगा है कृपया उनसे सम्पर्क कर के टीका लगाएं। ', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery);
		 }

		$SelQuery2 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=57;";
		$SelResult2 = mysql_query($SelQuery2);
		while($SelDetails = mysql_fetch_array($SelResult2))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी के बच्चे को विटामिन ए की खुराक अभी तक नहीं दी गयी है कृपया उनसे सम्पर्क करके विटामिन ए की खुराक दिलवाऐ। ', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery);
		 }
		$SelQuery3 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=72;";
		$SelResult3 = mysql_query($SelQuery3);
		while($SelDetails = mysql_fetch_array($SelResult3))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी के बच्चे का वजन 08 किलो से कम है कृपया उनसे सम्पर्क कर उचित सुझाव दें। ', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery);
		 }
		$SelQuery4 = "SELECT receipent_type, push_days, sms_id FROM sms_details WHERE question_id=72;";
		$SelResult4 = mysql_query($SelQuery4);
		while($SelDetails = mysql_fetch_array($SelResult4))
		 {
			$receipent_type = $SelDetails["receipent_type"];
			$push_days      = $SelDetails["push_days"];
			$sms_id         = $SelDetails["sms_id"];

			if($receipent_type == 'benificiary')
		 	 {
				$mobile_number = $beneficiary_num;
		 	 }
			else if($receipent_type == 'ASHA')
		 	 {
				$mobile_number = $asha_num;
		 	 }
			else if($receipent_type == 'ANM')
		 	 {
				$mobile_number = $anm_num;
		 	 }

			$push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

			/*$SelQuery1 = "SELECT template FROM sms_template WHERE sms_temp_id='".$sms_id."';";
			$SelResult1 = mysql_query($SelQuery1);
			$SelDetails1 = mysql_fetch_array($SelResult1);
			$template = $SelDetails1["template"];*/

			$InsQuery = "INSERT INTO sms_queue SET sms_id='".$sms_id."', mobile_number='".$mobile_number."', sms_template='आप के कार्य क्षेत्र में ".$benificary_village." गाँव की  ".$beneficiary_name." जी परिवार नियोजन के साधनों के विषय में जानकारी लेना चाहती है कृपया उनसे सम्पर्क कर के उचित जानकारी प्रदान करें। ', entry_time=NOW(), push_time='".$push_time."'";
			mysql_query($InsQuery);
		 }
	 }
	
	$convox_ivr_id = "";

	if($nutr_child_weight  == 'lessthan8kg' && $nutr_child_givenfood_4_5hr == 'Yes')
	 {
		$SelQuery1 = "SELECT receipent_type, push_days, ivr_id FROM sms_details WHERE question_id IN (64);";
                $SelResult1 = mysql_query($SelQuery1);
                while($SelDetails = mysql_fetch_array($SelResult1))
                 {
                        $receipent_type = $SelDetails["receipent_type"];
                        $push_days      = $SelDetails["push_days"];
                        $ivr_id         = $SelDetails["ivr_id"];

			$convox_ivr_id .= $SelDetails["ivr_id"]."@@";

                        if($receipent_type == 'benificiary')
                         {
                                $mobile_number = $beneficiary_num;
                         }
                        else if($receipent_type == 'ASHA')
                         {
                                $mobile_number = $asha_num;
                         }
                        else if($receipent_type == 'ANM')
                         {
                                $mobile_number = $anm_num;
                         }

                        $push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

                        $InsQuery = "INSERT INTO ivr_queue SET ivr_id='".$ivr_id."', mobile_number='".$mobile_number."', entry_time=NOW(), push_time='".$push_time."'";
                        mysql_query($InsQuery);
                 }

		$SelQuery2 = "SELECT receipent_type, push_days, ivr_id FROM sms_details WHERE question_id IN (58);";
                $SelResult2 = mysql_query($SelQuery2);
                while($SelDetails = mysql_fetch_array($SelResult2))
                 {
                        $receipent_type = $SelDetails["receipent_type"];
                        $push_days      = $SelDetails["push_days"];
                        $ivr_id         = $SelDetails["ivr_id"];

			$convox_ivr_id .= $SelDetails["ivr_id"]."@@";

                        if($receipent_type == 'benificiary')
                         {
                                $mobile_number = $beneficiary_num;
                         }
                        else if($receipent_type == 'ASHA')
                         {
                                $mobile_number = $asha_num;
                         }
                        else if($receipent_type == 'ANM')
                         {
                                $mobile_number = $anm_num;
                         }

                        $push_time = date('Y-m-d H:i:s', strtotime("+".$push_days." days"));

                        $InsQuery = "INSERT INTO ivr_queue SET ivr_id='".$ivr_id."', mobile_number='".$mobile_number."', entry_time=NOW(), push_time='".$push_time."'";
                        mysql_query($InsQuery);
                 }
         }

	echo $convox_ivr_id = substr($convox_ivr_id,0,-2);

	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];

	if($agent_status == "ONCALL")
	 {
		$Query3 = "UPDATE call_conversations_out SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		$Query4 = "UPDATE call_incident_info_out SET call_end_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		mysql_query($Query4);
	 }

	$Query5 = "UPDATE call_incident_info_out SET beneficiary_id='".$beneficiary_id."', popup_close_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
	mysql_query($Query5);

	$Query6 = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query6);

   break;

   case "seven" :
	
	$call_hit_referenceno = $_POST["call_hit_referenceno"];	
	$agent_id              = $_POST["agent_id"];
	$call_id               = ($_POST["call_id"])?$_POST["call_id"]:0;
	$beneficiary_id        = $_POST["beneficiary_id"];	
	$contraception_methods = $_POST["contraception_methods"];
	$infertility           = $_POST["infertility"];
	$pregnancy	       = $_POST["pregnancy"];
	$abortion_mtp          = $_POST["abortion_mtp"];
	$government_plan       = $_POST["government_plan"];
	
	$Query = "INSERT INTO calltype7 SET callid=".$call_id.", beneficiary_id='".$beneficiary_id."', contraception_methods='".$contraception_methods."', infertility='".$infertility."', pregnancy='".$pregnancy."', abortion_mtp='".$abortion_mtp."', government_plan='".$government_plan."';";
	mysql_query($Query);
	
	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];

	if($agent_status == "ONCALL")
	 {
		$Query3 = "UPDATE call_conversations_out SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		$Query4 = "UPDATE call_incident_info_out SET call_end_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		mysql_query($Query4);
	 }

	$Query5 = "UPDATE call_incident_info_out SET beneficiary_id='".$beneficiary_id."', popup_close_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
	mysql_query($Query5);

	$Query6 = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query6);

   break;

   case "eight" :

	$call_hit_referenceno = $_POST["call_hit_referenceno"];	
	$agent_id                           = $_POST["agent_id"];
	$call_id                            = ($_POST["call_id"])?$_POST["call_id"]:0;
	$beneficiary_id                     = $_POST["beneficiary_id"];	
	$anemia                             = $_POST["anemia"];
	$hypertension                       = $_POST["hypertension"];
	$diabetes                           = $_POST["diabetes"];
	$epilepsy                           = $_POST["epilepsy"];
	$obesewomen                         = $_POST["obesewomen"];
	$multiplegestation                  = $_POST["multiplegestation"];
	$pregnancybeforecompletionof17years = $_POST["pregnancybeforecompletionof17years"];
	$pregnancywithhiv                   = $_POST["pregnancywithhiv"];
	 
	$Query = "INSERT INTO calltype8 SET callid=".$call_id.", beneficiary_id='".$beneficiary_id."', anemia='".$anemia."', hypertension='".$hypertension."', diabetes='".$diabetes."', epilepsy='".$epilepsy."', obesewomen='".$obesewomen."', multiplegestation='".$multiplegestation."', pregnancybeforecompletionof17years='".$pregnancybeforecompletionof17years."', pregnancywithhiv='".$pregnancywithhiv."';";
	mysql_query($Query);

	$Query1 = "SELECT status, actionid FROM federated.convoxccs_agent_status WHERE agent_id='".$agent_id."';";
	$Result1 = mysql_query($Query1);
	$Details1 = mysql_fetch_array($Result1);
	$agent_status = $Details1["status"];
	$action_id = $Details1["actionid"];

	if($agent_status == "ONCALL")
	 {
		$Query3 = "UPDATE call_conversations_out SET completed_by='agent', end_time=NOW(), duration=(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time)) WHERE callid='".$call_id."' AND actionid='".$action_id."' AND end_time='0000-00-00 00:00:00';";
		mysql_query($Query3);

		$Query4 = "UPDATE call_incident_info_out SET call_end_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
		mysql_query($Query4);
	 }

	$Query5 = "UPDATE call_incident_info_out SET beneficiary_id='".$beneficiary_id."', popup_close_time=NOW() WHERE call_referenceno='".$call_hit_referenceno."' AND agent_id='".$agent_id."';";
	mysql_query($Query5);

	$Query6 = "DELETE FROM agent_sequenceno WHERE agent_id='".$agent_id."';";
	mysql_query($Query6);

   break;

 } 
?>
