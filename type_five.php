 
 
<style>
.abc { background-color:#fffff}
.abc tr:nth-child(even) {background-color: #E6E6FA !important}
.abc tr:nth-child(odd) {background-color: #FFF}

.sub_que{ padding-right:5px;}
.main_que td{ font-size:18px; color:#0000c1; }


/* Sweep To Right */
.hvr-sweep-to-right {
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  box-shadow: 0 0 1px transparent;
  position: relative;
  -webkit-transition-property: color;
  transition-property: color;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.hvr-sweep-to-right:before {
  content: "";
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #2098D1;
  -webkit-transform: scaleX(0);
  transform: scaleX(0);
  -webkit-transform-origin: 0 50%;
  transform-origin: 0 50%;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.hvr-sweep-to-right:hover, .hvr-sweep-to-right:focus, .hvr-sweep-to-right:active {
  color: white;
}
.hvr-sweep-to-right:hover:before, .hvr-sweep-to-right:focus:before, .hvr-sweep-to-right:active:before {
  -webkit-transform: scaleX(1);
  transform: scaleX(1);
}


</style>
<script src="scripts/main_validation.js"></script>
	<script type='text/javascript'>

	function showonesubquestions()
	 {
		document.getElementById('tr_1_1').style.display = "";		
		document.getElementById('tr_1_2').style.display = "";		
	 }

	function hideonesubquestions()
	 {
		document.getElementById('tr_1_1').style.display = "none";		
		document.getElementById('tr_1_2').style.display = "none";		
	 }

	function showtwofoursubquestions()
	 {
		document.getElementById('tr_2_4_1').style.display = "";		
		document.getElementById('tr_2_4_2').style.display = "";		
		document.getElementById('tr_2_4_3').style.display = "";		
		document.getElementById('tr_2_4_4').style.display = "";		
		document.getElementById('tr_2_4_5').style.display = "";		
	 }

	function hidetwofoursubquestions()
	 {
		document.getElementById('tr_2_4_1').style.display = "none";		
		document.getElementById('tr_2_4_2').style.display = "none";		
		document.getElementById('tr_2_4_3').style.display = "none";		
		document.getElementById('tr_2_4_4').style.display = "none";		
		document.getElementById('tr_2_4_5').style.display = "none";		
	 }

	function showeightsubquestions()
	 {
		document.getElementById('tr_8_1').style.display = "";		
		document.getElementById('tr_8_2').style.display = "";		
		document.getElementById('tr_8_3').style.display = "";		
		document.getElementById('tr_8_4').style.display = "";		
	 }
	
	function hideeightsubquestions()
	 {
		document.getElementById('tr_8_1').style.display = "none";		
		document.getElementById('tr_8_2').style.display = "none";		
		document.getElementById('tr_8_3').style.display = "none";		
		document.getElementById('tr_8_4').style.display = "none";		
	 }

	function SaveTypeThreeQuestions()
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var delivery_govt_hospital = "";
			if(document.getElementById('qone_y').checked)
			 {
				delivery_govt_hospital = document.getElementById('qone_y').value;
			 }
			else if(document.getElementById('qone_n').checked)
			 {
				delivery_govt_hospital = document.getElementById('qone_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 1');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qone_y').focus();
				return false;
			 }  
	
			var childbirth_home_id = "";
			var childbirth_home_value = "";
			var delivery_pvt_hospital_id = "";
			var delivery_pvt_hospital_value = "";

			if(delivery_govt_hospital == "No")
			 {
				var childbirth_home_details = document.getElementById('qone_1').value;	
				var childbirth_home_details_array = childbirth_home_details.split("~");
				childbirth_home_id = childbirth_home_details_array[0];
				childbirth_home_value = childbirth_home_details_array[1];
				
				var delivery_pvt_hospital_details = document.getElementById('qone_2').value;
				var delivery_pvt_hospital_details_array = delivery_pvt_hospital_details.split("~");
				delivery_pvt_hospital_id = delivery_pvt_hospital_details_array[0];
				delivery_pvt_hospital_value = delivery_pvt_hospital_details_array[1];
			 }	

			var free_ambulance_fordelivery = "";
			if(document.getElementById('qtwo_1_y').checked)
			 {
				free_ambulance_fordelivery = document.getElementById('qtwo_1_y').value;
			 }
			else if(document.getElementById('qtwo_1_n').checked)
			 {
				free_ambulance_fordelivery = document.getElementById('qtwo_1_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2 i');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qtwo_1_y').focus();
				return false;
			 }   
		
			var free_delivery = "";
			if(document.getElementById('qtwo_2_y').checked)
			 {
				free_delivery = document.getElementById('qtwo_2_y').value;
			 }
			else if(document.getElementById('qtwo_2_n').checked)
			 {
				free_delivery = document.getElementById('qtwo_2_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2 ii');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qtwo_2_y').focus();
				return false;
			 }   
		
			var need_undergo_surgery = "";
			if(document.getElementById('qtwo_3_y').checked)
			 {
				need_undergo_surgery = document.getElementById('qtwo_3_y').value;
			 }
			else if(document.getElementById('qtwo_3_n').checked)
			 {
				need_undergo_surgery = document.getElementById('qtwo_3_n').value;
			 }
			else
			 { 
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2 iii');
                		setTimeout(function(){$('.alert').hide();},10000);				
				document.getElementById('qtwo_3_y').focus();
				return false;
			 }   
		
			var where_was_operation_id = "";	
			var where_was_operation = "";	
			if(document.getElementById('qtwo_4_y').checked)
			 {
				var where_was_operation_details = document.getElementById('qtwo_4_y').value;
				var where_was_operation_details_array = where_was_operation_details.split("~");
				where_was_operation_id = where_was_operation_details_array[0];
				where_was_operation = where_was_operation_details_array[1];
                	 }
			else if(document.getElementById('qtwo_4_n').checked)
			 {
				var where_was_operation_details = document.getElementById('qtwo_4_n').value;
				var where_was_operation_details_array = where_was_operation_details.split("~");
				where_was_operation_id = where_was_operation_details_array[0];
				where_was_operation = where_was_operation_details_array[1];
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2 iv');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qtwo_4_y').focus();
				return false;
			 }   
	
			var govt_hospital_free = "";
			var need_blood_labor = "";
			var get_free_blood = "";
			var get_free_meals = "";
			var get_money_enquiry = "";

			if(where_was_operation_id == "Government")
			 {
				if(document.getElementById('qtwo_4_1_y').checked)
			 	 {
					govt_hospital_free = document.getElementById('qtwo_4_1_y').value;
			 	 }
				else if(document.getElementById('qtwo_4_1_n').checked)
			 	 {
					govt_hospital_free = document.getElementById('qtwo_4_1_n').value;
			 	 }
				else
			 	 {	 
					$('.alert').show();
                			$('.alert_content').html('Please Choose Yes/No For Question 2 iv i');
                			setTimeout(function(){$('.alert').hide();},10000);				
					document.getElementById('qtwo_4_1_y').focus();
					return false;
			 	 }   

				if(document.getElementById('qtwo_4_2_y').checked)
			 	 {
					need_blood_labor = document.getElementById('qtwo_4_2_y').value;
			 	 }
				else if(document.getElementById('qtwo_4_2_n').checked)
			 	 {
					need_blood_labor = document.getElementById('qtwo_4_2_n').value;
			 	 }
				else
			 	 {	 
					$('.alert').show();
                			$('.alert_content').html('Please Choose Yes/No For Question 2 iv ii');
                			setTimeout(function(){$('.alert').hide();},10000);				
					document.getElementById('qtwo_4_2_y').focus();
					return false;
			 	 }   

				if(document.getElementById('qtwo_4_3_y').checked)
			 	 {
					get_free_blood = document.getElementById('qtwo_4_3_y').value;
			 	 }
				else if(document.getElementById('qtwo_4_3_n').checked)
			 	 {
					get_free_blood = document.getElementById('qtwo_4_3_n').value;
			 	 }
				else
			 	 {	 
					$('.alert').show();
                			$('.alert_content').html('Please Choose Yes/No For Question 2 iv iii');
                			setTimeout(function(){$('.alert').hide();},10000);				
					document.getElementById('qtwo_4_3_y').focus();
					return false;
			 	 }   

				if(document.getElementById('qtwo_4_4_y').checked)
			 	 {
					get_free_meals = document.getElementById('qtwo_4_4_y').value;
			 	 }
				else if(document.getElementById('qtwo_4_4_n').checked)
			 	 {
					get_free_meals = document.getElementById('qtwo_4_4_n').value;
			 	 }
				else
			 	 {	 
					$('.alert').show();
                			$('.alert_content').html('Please Choose Yes/No For Question 2 iv iv');
                			setTimeout(function(){$('.alert').hide();},10000);				
					document.getElementById('qtwo_4_4_y').focus();
					return false;
			 	 }   

				if(document.getElementById('qtwo_4_5_y').checked)
			 	 {
					get_money_enquiry = document.getElementById('qtwo_4_5_y').value;
			 	 }
				else if(document.getElementById('qtwo_4_5_n').checked)
			 	 {
					get_money_enquiry = document.getElementById('qtwo_4_5_n').value;
			 	 }
				else
			 	 {	 
					$('.alert').show();
                			$('.alert_content').html('Please Choose Yes/No For Question 2 iv v');
                			setTimeout(function(){$('.alert').hide();},10000);				
					document.getElementById('qtwo_4_5_y').focus();
					return false;
			 	 }   
			 }
	
			var child_drink_mothermilk = "";
			if(document.getElementById('qthree_y').checked)
			 {
				child_drink_mothermilk = document.getElementById('qthree_y').value;
			 }
			else if(document.getElementById('qthree_n').checked)
			 {
				child_drink_mothermilk = document.getElementById('qthree_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 3');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qthree_y').focus();
				return false;
			 }   
		
			var giving_child_upperdiet = "";
			if(document.getElementById('qfour_y').checked)
			 {
				giving_child_upperdiet = document.getElementById('qfour_y').value;
			 }
			else if(document.getElementById('qfour_n').checked)
			 {
				giving_child_upperdiet = document.getElementById('qfour_n').value;
			 }
			else
			 { 
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 4');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qfour_y').focus();
				return false;
			 }   
		
			var child_examined_byASHA  = "";
			if(document.getElementById('qfive_y').checked)
			 {
				child_examined_byASHA = document.getElementById('qfive_y').value;
			 }
			else if(document.getElementById('qfive_n').checked) 
			 {
				child_examined_byASHA = document.getElementById('qfive_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 5');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qfive_y').focus();
				return false;
			 }   
		
			var  ASHA_check_sixtoseven = "";
			if(document.getElementById('qsix_1_y').checked)
			 {
				ASHA_check_sixtoseven = document.getElementById('qsix_1_y').value;
			 }
			else if(document.getElementById('qsix_1_n').checked)
			 {
				ASHA_check_sixtoseven = document.getElementById('qsix_1_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 6 i');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qsix_1_y').focus();
				return false;
			 }   
		
			var ASHA_check_below_sixtime = "";
			if(document.getElementById('qsix_2_y').checked)
			 {
				ASHA_check_below_sixtime = document.getElementById('qsix_2_y').value;
			 }
			else if(document.getElementById('qsix_2_n').checked)
			 {
				ASHA_check_below_sixtime = document.getElementById('qsix_2_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 6 ii');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qsix_2_y').focus();
				return false;
			 }   
		
			var child_vaccine_before24hr   = "";
			if(document.getElementById('qseven_y').checked)
			 {
				child_vaccine_before24hr = document.getElementById('qseven_y').value;
			 }
			else if(document.getElementById('qseven_n').checked) 
			 {
				child_vaccine_before24hr = document.getElementById('qseven_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 7');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qseven_y').focus();
				return false;
			 }   

			var adopted_family_planning   = "";
			if(document.getElementById('qeight_y').checked)
			 {
				adopted_family_planning = document.getElementById('qeight_y').value;
			 }
			else if(document.getElementById('qeight_n').checked) 
			 {
				adopted_family_planning = document.getElementById('qeight_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 8');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qeight_y').focus();
				return false;
			 }   

			var info_family_planning  = "";
			var want_to_adopt_familyPlan  = "";
			var family_allow_familyPlan  = "";
			var familyPlan_facility_hospital  = "";

			if(adopted_family_planning == "No")
			 {
				if(document.getElementById('qeight_1_y').checked)
			 	 {
					info_family_planning = document.getElementById('qeight_1_y').value;
			 	 }
				else if(document.getElementById('qeight_1_n').checked) 
			 	 {
					info_family_planning = document.getElementById('qeight_1_n').value;
			 	 }
				else
			 	 {
					$('.alert').show();
                			$('.alert_content').html('Please Choose Yes/No For Question 8 i');
                			setTimeout(function(){$('.alert').hide();},10000);
					document.getElementById('qeight_1_y').focus();
					return false;
			 	 }   

				if(document.getElementById('qeight_2_y').checked)
			 	 {
					want_to_adopt_familyPlan = document.getElementById('qeight_2_y').value;
			 	 }
				else if(document.getElementById('qeight_1_n').checked) 
			 	 {
					want_to_adopt_familyPlan = document.getElementById('qeight_2_n').value;
			 	 }
				else
			 	 {
					$('.alert').show();
                			$('.alert_content').html('Please Choose Yes/No For Question 8 ii');
                			setTimeout(function(){$('.alert').hide();},10000);
					document.getElementById('qeight_2_y').focus();
					return false;
			 	 }   

				if(document.getElementById('qeight_3_y').checked)
			 	 {
					family_allow_familyPlan = document.getElementById('qeight_3_y').value;
			 	 }
				else if(document.getElementById('qeight_3_n').checked) 
			 	 {
					family_allow_familyPlan = document.getElementById('qeight_3_n').value;
			 	 }
				else
			 	 {
					$('.alert').show();
                			$('.alert_content').html('Please Choose Yes/No For Question 8 iii');
                			setTimeout(function(){$('.alert').hide();},10000);
					document.getElementById('qeight_3_y').focus();
					return false;
			 	 }   

				if(document.getElementById('qeight_4_y').checked)
			 	 {
					familyPlan_facility_hospital = document.getElementById('qeight_4_y').value;
			 	 }
				else if(document.getElementById('qeight_4_n').checked) 
			 	 {
					familyPlan_facility_hospital = document.getElementById('qeight_4_n').value;
			 	 }
				else
			 	 {
					$('.alert').show();
                			$('.alert_content').html('Please Choose Yes/No For Question 8 iv');
                			setTimeout(function(){$('.alert').hide();},10000);
					document.getElementById('qeight_4_y').focus();
					return false;
			 	 }   
			 }

			var callQuery = "type=three&call_hit_referenceno=<?=$_REQUEST["CallReferenceID"];?>&call_id="+CallID+"&beneficiary_id=<?=$Beneficiary_Details['ID_No'];?>&agent_id=<?=$_REQUEST["agentid"];?>&delivery_govt_hospital="+delivery_govt_hospital+"&childbirth_home_id="+childbirth_home_id+"&childbirth_home_value="+childbirth_home_value+"&free_ambulance_fordelivery="+free_ambulance_fordelivery+"&free_delivery="+free_delivery+"&need_undergo_surgery="+need_undergo_surgery+"&where_was_operation="+where_was_operation+"&govt_hospital_free="+govt_hospital_free+"&need_blood_labor="+need_blood_labor+"&get_free_blood="+get_free_blood+"&get_free_meals="+get_free_meals+"&get_money_enquiry="+get_money_enquiry+"&child_drink_mothermilk="+child_drink_mothermilk+"&giving_child_upperdiet="+giving_child_upperdiet+"&child_examined_byASHA="+child_examined_byASHA+"&ASHA_check_sixtoseven="+ASHA_check_sixtoseven+"&ASHA_check_below_sixtime="+ASHA_check_below_sixtime+"&child_vaccine_before24hr="+child_vaccine_before24hr+"&adopted_family_planning="+adopted_family_planning+"&info_family_planning="+info_family_planning+"&want_to_adopt_familyPlan="+want_to_adopt_familyPlan+"&family_allow_familyPlan="+family_allow_familyPlan+"&familyPlan_facility_hospital="+familyPlan_facility_hospital+"&beneficiary_num=<?=$Beneficiary_Details['Whom_PhoneNo'];?>&asha_num=<?=$Beneficiary_Details['ASHA_Phone'];?>&anm_num=<?=$Beneficiary_Details['ANM_Phone'];?>&beneficiary_name=<?=$Beneficiary_Details['Name'];?>&village=<?=$Beneficiary_Details['Village_Name'];?>";
			//alert(callQuery);//return false;
			xmlHttp.open("POST","save_calltype_questions.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
                                        var Response = null;
                                        Response = xmlHttp.responseText;
                                        //alert(Response);
					if(Response)
                                         {
                                                var convox_ivr_ids = Response;
                                         }

                                        if(Response=="")
                                         {
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE5&FEEDBACK_IVR=N";
					 }
					else
					 {
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE5&FEEDBACK_IVR=Y&convox_ivr_ids="+convox_ivr_ids;
					 }
					//alert(end_call_url);
					postURL(end_call_url,"false");
                                 }
                         }
		 }
		delete xmlHttp;		
	 }

</script>

 
	<form>
	<table class="table table-striped abc">
	<thead>
	<tr>
		</tr><tr><th colspan=4>उत्तर प्रदेश स्वास्थ्य विभाग की तरफ से नमस्कार आपको माँ/पिता बनने की बहुत बहुत बधाई हम आपके और आपके बच्चे के अच्छे स्वस्थ्य के  प्रतिबद्ध हैं इस संदर्भ में आपसे जानना चाहेंगे</th></tr><tr>
		<th width="2%">S.no</th>
		<th width="">Question</th>
		<th>Result</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>1 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपका प्रसव सरकारी अस्पताल में हुआ है?</td>
		<td><input type="radio" name="qone" id="qone_y" value="Yes" onclick="hideonesubquestions();">Yes <input type="radio" name="qone" id="qone_n" value="No" onclick="showonesubquestions();">No</td>
	</tr>
	<tr id="tr_1_1" style="display:none;">
		<td>i </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">प्रसव घर पर हुआ तो</td>
		<td><select name="qone_1" id="qone_1" class="col-md-12">
		<option value='1~परिवार वाले घर में ही प्रसव कराना चाहते थे?'>परिवार वाले घर में ही प्रसव कराना चाहते थे?</option>
		<option value='2~एम्बुलेंस की सुविधा न मिल पाने के कारण प्रसव घर पर हुआ?'>एम्बुलेंस की सुविधा न मिल पाने के कारण प्रसव घर पर हुआ?</option>
		<option value='3~जच्चा बच्चा कार्ड न होने के कारम प्रसव घर पर हुआ/'>जच्चा बच्चा कार्ड न होने के कारम प्रसव घर पर हुआ/</option>
		<option value='4~अचानक प्रसव पीड़ा होने की वजह से आपका प्रसव घर पर हुआ?'>अचानक प्रसव पीड़ा होने की वजह से आपका प्रसव घर पर हुआ?</option>
		</select></td>
	</tr>
	<tr id="tr_1_2" style="display:none;">
		<td>ii </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">प्रसव प्राइवेट हास्पिटल में हुआ तो</td>
		<td><select name="qone_2" id="qone_2" class="col-md-12">
		<option value='1~सरकारी अस्पताल मे डाक्टर उपलब्ध नहीं थे।'>सरकारी अस्पताल मे डाक्टर उपलब्ध नहीं थे</option>
		<option value='2~सरकारी अस्पताल की तुलना में प्राइवेट अस्पताल में बेहतर सुविधा होने की अनुभूति'>सरकारी अस्पताल की तुलना में प्राइवेट अस्पताल में बेहतर सुविधा होने की अनुभूति</option>
		<option value='3~आशा दीदी ने वहाँ भेजा।'>आशा दीदी ने वहाँ भेजा।</option>
		<option value='4~अन्य'>अन्य</option>
		</select></td>
	</tr>
	<tr>
		<td>2 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपको संस्थागत प्रसव के ले निम्न सुविधाएं निःशुल्क दी गयी थी?</td>
		<td></td>
	</tr>
	<tr>
		<td>i </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपको निःशुल्क एम्बुलेंस की सुविधा प्रसव हेतु मिली थी?</td>
		<td><input type="radio" name="qtwo_1" id="qtwo_1_y" value="Yes" >Yes <input type="radio" name="qtwo_1" id="qtwo_1_n" value="No" >No</td>
	</tr>
	<tr>
		<td>ii </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपका प्रसव निःशुल्क हुआ हैं?</td>
		<td><input type="radio" name="qtwo_2" id="qtwo_2_y" value="Yes" >Yes <input type="radio" name="qtwo_2" id="qtwo_2_n" value="No" >No</td>
	</tr>
	<tr>
		<td>iii </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या प्रसव में आपरेशन की आवश्यकता पड़ी?</td>
		<td><input type="radio" name="qtwo_3" id="qtwo_3_y" value="Yes" >Yes <input type="radio" name="qtwo_3" id="qtwo_3_n" value="No" >No</td>
	</tr>
	<tr>
		<td>iv </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">आपरेशन कहाँ हुआ था</td>
		<td><input type="radio" name="qtwo_4" id="qtwo_4_y" value="Government~सरकारी अस्पताल" onclick="showtwofoursubquestions();">सरकारी अस्पताल <input type="radio" name="qtwo_4" id="qtwo_4_n" value="Private~प्राइवेट अस्पताल" onclick="hidetwofoursubquestions();">प्राइवेट अस्पताल</td>
	</tr>
	<tr id="tr_2_4_1" style="display:none;">
		<td>i </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या सरकारी अस्पताल में निःशुल्क हुआ है?</td>
		<td><input type="radio" name="qtwo_4_1" id="qtwo_4_1_y" value="Yes" >Yes <input type="radio" name="qtwo_4_1" id="qtwo_4_1_n" value="No" >No</td>
	</tr>
	<tr id="tr_2_4_2" style="display:none;">
		<td>ii </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या प्रसव के दौरान खून की आवश्यकता पड़ी?</td>
		<td><input type="radio" name="qtwo_4_2" id="qtwo_4_2_y" value="Yes" >Yes <input type="radio" name="qtwo_4_2" id="qtwo_4_2_n" value="No" >No</td>
	</tr>
	<tr id="tr_2_4_3" style="display:none;">
		<td>iii </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या खून निःशुल्क मिला?</td>
		<td><input type="radio" name="qtwo_4_3" id="qtwo_4_3_y" value="Yes" >Yes <input type="radio" name="qtwo_4_3" id="qtwo_4_3_n" value="No" >No</td>
	</tr>
	<tr id="tr_2_4_4" style="display:none;">
		<td>iv </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपको निःशुल्क भोजन प्राप्त हुआ?</td>
		<td><input type="radio" name="qtwo_4_4" id="qtwo_4_4_y" value="Yes" >Yes <input type="radio" name="qtwo_4_4" id="qtwo_4_4_n" value="No" >No</td>
	</tr>
	<tr id="tr_2_4_5" style="display:none;">
		<td>v </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपसे किसी भी जांच के लिए कोई पैसे लिए गये?</td>
		<td><input type="radio" name="qtwo_4_5" id="qtwo_4_5_y" value="Yes" >Yes <input type="radio" name="qtwo_4_5" id="qtwo_4_5_n" value="No" >No</td>
	</tr>
	<tr>
		<td>3 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या बच्चा अभी पूरी तरह से माँ का दूध पी रहा है?</td>
		<td><input type="radio" name="qthree" id="qthree_y" value="Yes" >Yes <input type="radio" name="qthree" id="qthree_n" value="No" >No</td>
	</tr>
	<tr>
		<td>4 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या बच्चे को ऊपरी आहार दिया जा रहा है?</td>
		<td><input type="radio" name="qfour" id="qfour_y" value="Yes" >Yes <input type="radio" name="qfour" id="qfour_n" value="No" >No</td>
	</tr>
	<tr>
		<td>5 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या अस्पताल स वापस घर आने के बाद आशा द्वारा आपकी और आपके बच्चे की जांच की गयी थी?</td>
		<td><input type="radio" name="qfive" id="qfive_y" value="Yes" >Yes <input type="radio" name="qfive" id="qfive_n" value="No" >No</td>
	</tr>
	<tr>
		<td>6 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">अब तक आपके गाँव की आशा बच्चे के जन्म के बाद कितनी बार बच्चे एवं माँ की जांच करने आई है?</td>
		<td></td>
	</tr>
	<tr>
		<td>i </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">06 से 07 बार</td>
		<td><input type="radio" name="qsix_1" id="qsix_1_y" value="Yes" >Yes <input type="radio" name="qsix_1" id="qsix_1_n" value="No" >No</td>
	</tr>
	<tr>
		<td>ii </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">06 बार से कम</td>
		<td><input type="radio" name="qsix_2" id="qsix_2_y" value="Yes" >Yes <input type="radio" name="qsix_2" id="qsix_2_n" value="No" >No</td>
	</tr>
	<tr>
		<td>7 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या अस्पताल में जन्में बच्चे को जन्म के 24 घंटे के अंदर पोलियो की खुराक, बी०सी०जी० का टीका और हैपेटाइटिस बी का टीका लगा था?</td>
		<td><input type="radio" name="qseven" id="qseven_y" value="Yes" >Yes <input type="radio" name="qseven" id="qseven_n" value="No" >No</td>
	</tr>
	<tr>
		<td>8 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपने परिवार नियोजन का कोई साधन अपनाया है?</td>
		<td><input type="radio" name="qeight" id="qeight_y" value="Yes" onclick="hideeightsubquestions();">Yes <input type="radio" name="qeight" id="qeight_n" value="No" onclick="showeightsubquestions();">No</td>
	</tr>
	<tr id="tr_8_1" style="display:none;">
		<td>i </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपको परिवार नियोजन के साधनों के बारे में कोई जानकारी है?</td>
		<td><input type="radio" name="qeight_1" id="qeight_1_y" value="Yes" >Yes <input type="radio" name="qeight_1" id="qeight_1_n" value="No" >No</td>
	</tr>
	<tr id="tr_8_2" style="display:none;">
		<td>ii </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आप परिवार नियोजन अपनाना चाहती हैं?</td>
		<td><input type="radio" name="qeight_2" id="qeight_2_y" value="Yes" >Yes <input type="radio" name="qeight_2" id="qeight_2_n" value="No" >No</td>
	</tr>
	<tr id="tr_8_3" style="display:none;">
		<td>iii </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपका परिवार आपको परिवार नियोजन अपनाने के लिए अनुमति देता है?</td>
		<td><input type="radio" name="qeight_3" id="qeight_3_y" value="Yes" >Yes <input type="radio" name="qeight_3" id="qeight_3_n" value="No" >No</td>
	</tr>
	<tr id="tr_8_4" style="display:none;">
		<td>iv </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपको अस्पताल में परिवार नियोजन सम्बंधी सुविधा प्रदान की गयी?</td>
		<td><input type="radio" name="qeight_4" id="qeight_4_y" value="Yes" >Yes <input type="radio" name="qeight_4" id="qeight_4_n" value="No" >No</td>
	</tr>
	<tr>
		<td align='center' colspan=3><button type="button" name="save_type_three" id="save_type_three" onclick="SaveTypeThreeQuestions();"> Save </button></td>
	</tr>
	</tbody>
	</table>
</form> 
