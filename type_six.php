<?php
?>
<html>
<head>
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
<script type="text/javascript">

        function oneshowfoursubquestions()
         {
                document.getElementById('tr_2_4_1').style.display = "";         
                document.getElementById('tr_2_4_2').style.display = "none";         
                document.getElementById('tr_2_4_3').style.display = "none";         
                document.getElementById('tr_2_4_4').style.display = "none";         
         }

        function twoshowfoursubquestions()
         {
                document.getElementById('tr_2_4_1').style.display = "none";             
                document.getElementById('tr_2_4_2').style.display = "";             
                document.getElementById('tr_2_4_3').style.display = "none";             
                document.getElementById('tr_2_4_4').style.display = "none";             
         }

        function threeshowfoursubquestions()
         {
                document.getElementById('tr_2_4_1').style.display = "none";         
                document.getElementById('tr_2_4_2').style.display = "none";         
                document.getElementById('tr_2_4_3').style.display = "";         
                document.getElementById('tr_2_4_4').style.display = "none";         
         }

        function fourshowfoursubquestions()
         {
                document.getElementById('tr_2_4_1').style.display = "none";             
                document.getElementById('tr_2_4_2').style.display = "none";             
                document.getElementById('tr_2_4_3').style.display = "none";             
                document.getElementById('tr_2_4_4').style.display = "";             
         }

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

        function showfivesubquestions()
         {
                document.getElementById('tr_5_1').style.display = "";           
                document.getElementById('tr_5_2').style.display = "";           
                document.getElementById('tr_5_3').style.display = "";           
                document.getElementById('tr_5_4').style.display = "";           
                document.getElementById('tr_5_5').style.display = "";           
         }
        
        function hidefivesubquestions()
         {
                document.getElementById('tr_5_1').style.display = "none";               
                document.getElementById('tr_5_2').style.display = "none";               
                document.getElementById('tr_5_3').style.display = "none";               
                document.getElementById('tr_5_4').style.display = "none";               
                document.getElementById('tr_5_5').style.display = "none";               
         }

	function SaveTypeSixQuestions()
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var baby_diagnoise_measles = "";
			if(document.getElementById("qone_y").checked)
			 {
				baby_diagnoise_measles = document.getElementById("qone_y").value;
			 }
			else if(document.getElementById("qone_n").checked)
			 {
				baby_diagnoise_measles = document.getElementById("qone_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 1');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qone_y").focus();
				return false;
			 }

			var vitamin_A_ninemonth = "";
			if(document.getElementById("qtwo_y").checked)
			 {
				vitamin_A_ninemonth = document.getElementById("qtwo_y").value;
			 }
			else if(document.getElementById("qtwo_n").checked)
			 {
				vitamin_A_ninemonth = document.getElementById("qtwo_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qtwo_y").focus();
				return false;
			 }

			var other_than_mother_milk = "";
			if(document.getElementById("qthree_y").checked)
			 {
				other_than_mother_milk = document.getElementById("qthree_y").value;
			 }
			else if(document.getElementById("qthree_n").checked)
			 {
				other_than_mother_milk = document.getElementById("qthree_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 3');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qthree_y").focus();
				return false;
			 }

			var nutr_child_weight = "";
			if(document.getElementById("qfour_one_1").checked)
			 {
				nutr_child_weight = document.getElementById("qfour_one_1").value;
			 }
			else if(document.getElementById("qfour_one_2").checked)
			 {
				nutr_child_weight = document.getElementById("qfour_one_2").value;
			 }
                        else if(document.getElementById("qfour_one_3").checked)
                         {
                                nutr_child_weight = document.getElementById("qfour_one_3").value;
                         }
                        else if(document.getElementById("qfour_one_4").checked)
                         {
                                nutr_child_weight = document.getElementById("qfour_one_4").value;
                         }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Option For Question 4(i)');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qfour_one_1").focus();
				return false;
			 }

			var nutr_childdrink_mohthermilk = "";
			if(document.getElementById("qfour_two_y").checked)
			 {
				 nutr_childdrink_mohthermilk = document.getElementById("qfour_two_y").value;
			 }
			else if(document.getElementById("qfour_two_n").checked)
			 {
				nutr_childdrink_mohthermilk = document.getElementById("qfour_two_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 4(ii)');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qfour_two_y").focus();
				return false;
			 }

			var nutr_child_givenfood_4_5hr = "";
			if(document.getElementById("qfour_three_y").checked)
			 {
				 nutr_child_givenfood_4_5hr = document.getElementById("qfour_three_y").value;
			 }
			else if(document.getElementById("qfour_three_n").checked)
			 {
				nutr_child_givenfood_4_5hr = document.getElementById("qfour_three_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 4(iii)');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qfour_three_y").focus();
				return false;
			 }

                        var familyPlan_means_taken = "";
                        if(document.getElementById("qfive_y").checked)
                         {
                                 familyPlan_means_taken = document.getElementById("qfive_y").value;
                         }
                        else if(document.getElementById("qfive_n").checked)
                         {
                                familyPlan_means_taken = document.getElementById("qfive_n").value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 5');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById("qfive_y").focus();
                                return false;
                         }

			var familyPlan_info = "";
			var familyPlan_diffbw_child = "";
			var familyPlan_adopt = "";
			var familyPlan_allowed = "";
			var familyPlan_facility_hos = "";		
	
			if(familyPlan_means_taken == "No")
			{
       		                if(document.getElementById("qfive_1_y").checked)
                       		 {
	                                familyPlan_info = document.getElementById("qfive_1_y").value;
	                         }
	                        else if(document.getElementById("qfive_1_n").checked)
	                         {
	                                familyPlan_info = document.getElementById("qfive_1_n").value;
	                         }
	                        else
	                         {
	                                $('.alert').show();
	                                $('.alert_content').html('Please Choose Option For Question 5 No(i)');
	                                setTimeout(function(){$('.alert').hide();},10000); 
	                                document.getElementById("qfive_1_y").focus();
	                                return false;
				 }

				if(document.getElementById("qfive_2_y").checked)
 				 {
					familyPlan_diffbw_child = document.getElementById("qfive_2_y").value;
				 }
				else if(document.getElementById("qfive_2_n").checked)
				 {
					familyPlan_diffbw_child = document.getElementById("qfive_2_n").value;
				 }
				else
				 {
					$('.alert').show();
					$('.alert_content').html('Please Choose Option For Question 5 No(ii)');
					setTimeout(function(){$('.alert').hide();},10000); 
					document.getElementById("qfive_2_y").focus();
					return false;
				 }

				if(document.getElementById("qfive_3_y").checked)
				 {
					familyPlan_adopt = document.getElementById("qfive_3_y").value;
				 }
				else if(document.getElementById("qfive_3_n").checked)
				 {
					familyPlan_adopt = document.getElementById("qfive_3_n").value;
				 }
				else
				 {
					$('.alert').show();
					$('.alert_content').html('Please Choose Option For Question 5 No(iii)');
					setTimeout(function(){$('.alert').hide();},10000); 
					document.getElementById("qfive_2_y").focus();
					return false;
				 }

				if(document.getElementById("qfive_4_y").checked)
				 {
					familyPlan_allowed = document.getElementById("qfive_4_y").value;
				 }
				else if(document.getElementById("qfive_4_n").checked)
				 {
					familyPlan_allowed = document.getElementById("qfive_4_n").value;
				 }
				else
				 {
					$('.alert').show();
					$('.alert_content').html('Please Choose Option For Question 5 No(iv)');
					setTimeout(function(){$('.alert').hide();},10000); 
					document.getElementById("qfive_4_y").focus();
					return false;
				 }

				if(document.getElementById("qfive_5_y").checked)
				 {
					familyPlan_facility_hos = document.getElementById("qfive_5_y").value;
				 }
				else if(document.getElementById("qfive_5_n").checked)
				 {
					familyPlan_facility_hos = document.getElementById("qfive_5_n").value;
				 }
				else
				 {
					$('.alert').show();
					$('.alert_content').html('Please Choose Option For Question 5 No(v)');
					setTimeout(function(){$('.alert').hide();},10000); 
					document.getElementById("qfive_5_y").focus();
					return false;
				 }
			}

			var know_means_familyPlan = "";
                        if(document.getElementById("qsix_y").checked)
                         {
                                 know_means_familyPlan = document.getElementById("qsix_y").value;
                         }
                        else if(document.getElementById("qsix_n").checked)
                         {
				know_means_familyPlan = document.getElementById("qsix_n").value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 6');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById("qsix_y").focus();
                                return false;
                         }

			var callQuery = "type=six&call_hit_referenceno=<?=$_REQUEST["CallReferenceID"];?>&call_id="+CallID+"&beneficiary_id=&agent_id=<?=$_REQUEST["agentid"];?>&baby_diagnoise_measles="+baby_diagnoise_measles+"&vitamin_A_ninemonth="+vitamin_A_ninemonth+"&other_than_mother_milk="+other_than_mother_milk+"&nutr_child_weight="+nutr_child_weight+"&nutr_childdrink_mohthermilk="+nutr_childdrink_mohthermilk+"&nutr_child_givenfood_4_5hr="+nutr_child_givenfood_4_5hr+"&familyPlan_means_taken="+familyPlan_means_taken+"&familyPlan_info="+familyPlan_info+"&familyPlan_diffbw_child="+familyPlan_diffbw_child+"&familyPlan_adopt="+familyPlan_adopt+"&familyPlan_allowed="+familyPlan_allowed+"&familyPlan_facility_hos="+familyPlan_facility_hos+"&know_means_familyPlan="+know_means_familyPlan+"&beneficiary_num=<?=$Beneficiary_Details['Whom_PhoneNo'];?>&asha_num=<?=$Beneficiary_Details['ASHA_Phone'];?>&anm_num=<?=$Beneficiary_Details['ANM_Phone'];?>&beneficiary_name=<?=$Beneficiary_Details['Name'];?>&benificary_village=<?=$Beneficiary_Details['Village_Name'];?>";;
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
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE6&FEEDBACK_IVR=N";
					 }
					else
					 {
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE6&FEEDBACK_IVR=Y&convox_ivr_ids="+convox_ivr_ids;
					 }
					//alert(end_call_url);
					postURL(end_call_url,"false");
                                 }
                         }
		 }
		delete xmlHttp;		
	 }
			
</script>
</head>
<body>
	<form>
	<table class="table table-striped abc">
	<thead>
	<tr>
		</tr><tr><th colspan=3>नमस्कार उत्तर प्रदेश स्वास्थ्य विभाग की तरफ से आपको बच्चे के पहले जन्म दिवस की हार्दिक बधाई-हम आपके और आपके बच्चे के अच्छे स्वास्थ्य के लिए कटिबद्ध हैं इस संम्बंध में आपसे जानना चाहेंगे कि-</th></tr><tr>
		<th width="2%">S.no</th>
		<th width="">Question</th>
		<th>Result</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>1 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;"> क्या आपके शिशु को खसरे का टीका लग गया है? </td>
		<td><input type="radio" name="qone" id="qone_y" value="Yes" >Yes <input type="radio" name="qone" id="qone_n" value="No" >No</td>
	</tr>
	<tr>
		<td>2 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;"> क्या आपके शिशु को नौ माह पर दी जाने वाली विटामिन ए की खुराक दी गयी है? </td>
		<td><input type="radio" name="qtwo" id="qtwo_y" value="Yes" >Yes <input type="radio" name="qtwo" id="qtwo_n" value="No" >No</td>
	</tr>
	<tr>
		<td>3 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;"> क्या आपका शिशु माँ के दूध के अलावा ऊपर का आहार जैसे दाल रोटी, उबला आलू, दही, खिचड़ी, दलिया, दाल, केला आदि खाने लगा है? </td>
		<td><input type="radio" name="qthree" id="qthree_y" value="Yes" >Yes <input type="radio" name="qthree" id="qthree_n" value="No" >No</td>
	</tr>
	<tr>
		<td>4 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;"> क्या हम आपके शिशु के पोषण सम्बंधिक कुछ प्रश्न कर सकते हैं? </td>
		<td></td>
	</tr>
	<tr>
                <td>i </td>
                <td class="hvr-sweep-to-right" style="font-size:18;"> बच्चे का बजन कितना है?</td>
		<td>
			<input type="radio" name="qfour_one" id="qfour_one_1" value="lessthan6kg" onclick="oneshowfoursubquestions();">06 किलो से कम
			<input type="radio" name="qfour_one" id="qfour_one_2" value="lessthan8kg" onclick="twoshowfoursubquestions();">08 किलो से कम 
			<input type="radio" name="qfour_one" id="qfour_one_3" value="8to9kg" onclick="threeshowfoursubquestions();">08 से 09 कलो 
			<input type="radio" name="qfour_one" id="qfour_one_4" value="9to11kg" onclick="fourshowfoursubquestions();">09 से 11 किलो 
		</td>
	</tr>
        <tr id="tr_2_4_1" style="display:none;">
                <td> </td>
                <td class="hvr-sweep-to-right" style="font-size:20;">यदि बच्चे का वजन 06 किलो से कम है तो बच्चे की माँ को बताएंगे कि बच्चे को अस्पताल में जाकर दिखाऐं। </td>
                <td></td>
        </tr>
        <tr id="tr_2_4_2" style="display:none;">
                <td> </td>
                <td class="hvr-sweep-to-right" style="font-size:20;"></td>
                <td></td>
        </tr>
        <tr id="tr_2_4_3" style="display:none;">
                <td> </td>
                <td class="hvr-sweep-to-right" style="font-size:20;">यदि बच्चे का वजन 08 से 09 किलो है तो माँ को उसे पौष्टिक आहार जैसे कि बच्चे को पौष्टक आहार जैसे की दलिया, खिचड़ी, दाल, रोटी, उबला, आलू, दही, केला इत्यादि भी देने को बताएंगे।</td>
                <td></td>
        </tr>
        <tr id="tr_2_4_4" style="display:none;">
                <td> </td>
                <td class="hvr-sweep-to-right" style="font-size:18;"></td>
                <td></td>
        </tr>
	<tr>
		<td>ii </td>
		<td class="hvr-sweep-to-right" style="font-size:18;"> क्या आपका बच्चा माँ का दूध पी रहा है? </td>
		<td><input type="radio" name="qfour_two" id="qfour_two_y" value="Yes" onclick="hideonesubquestions();">Yes <input type="radio" name="qfour_two" id="qfour_two_n" value="No" onclick="showonesubquestions();">No</td>
	</tr>
        <tr id="tr_1_1" style="display:none;">
        </tr>
        <tr id="tr_1_2" style="display:none;">
                <td> </td>
                <td class="hvr-sweep-to-right" style="font-size:20;">यदि नही तो बताएंगे कि दो साल तक के बच्चे को दिन में दो बार माँ का दूध अवश्य पिलाएं।</td>
		<td></td>
        </tr>
        <tr>
                <td>iii </td>
                <td class="hvr-sweep-to-right" style="font-size:18;"> क्या बच्चे को हर -4-05 घंटे में खाना देते हैं? </td>
                <td><input type="radio" name="qfour_three" id="qfour_three_y" value="Yes">Yes <input type="radio" name="qfour_three" id="qfour_three_n" value="No">No</td>
        </tr>
	<tr>
		<td>5 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;"> क्या आपने परिवार नियोजन का कोई साधन आपनाया है? </td>
		<td><input type="radio" name="qfive" id="qfive_y" value="Yes" onclick="hidefivesubquestions();">Yes <input type="radio" name="qfive" id="qfive_n" value="No" onclick="showfivesubquestions();">No</td>
	</tr>
        <tr id="tr_5_1" style="display:none;">
                <td>i </td>
                <td class="hvr-sweep-to-right" style="font-size:18;"> क्या आपको परिवार नियोजन के साधनों के बारे में कोई जानकारी है?</td>
                <td><input type="radio" name="qfive_1" id="qfive_1_y" value="Yes" >Yes <input type="radio" name="qfive_1" id="qfive_1_n" value="No" >No</td>
        </tr>
        <tr id="tr_5_2" style="display:none;">
                <td>ii </td>
                <td class="hvr-sweep-to-right" style="font-size:18;"> क्या आपको पता है कि बच्चों के बीच उचित अन्तर बनाये रखने से शिशु का विकास अच्छी तरह से होता है?</td>
                <td><input type="radio" name="qfive_2" id="qfive_2_y" value="Yes" >Yes <input type="radio" name="qfive_2" id="qfive_2_n" value="No" >No</td>
        </tr>
        <tr id="tr_5_3" style="display:none;">
                <td>iii </td>
                <td class="hvr-sweep-to-right" style="font-size:18;"> क्या आप परिवार नियोजन अपनाना चाहती हैं?</td>
                <td><input type="radio" name="qfive_3" id="qfive_3_y" value="Yes" >Yes <input type="radio" name="qfive_3" id="qfive_3_n" value="No" >No</td>
        </tr>
        <tr id="tr_5_4" style="display:none;">
                <td>iv </td>
                <td class="hvr-sweep-to-right" style="font-size:18;"> क्या आपका परिवार आपको परिवार नियोजन अपनाने के लिए अनुमति है?</td>
                <td><input type="radio" name="qfive_4" id="qfive_4_y" value="Yes" >Yes <input type="radio" name="qfive_4" id="qfive_4_n" value="No" >No</td>
        </tr>
        <tr id="tr_5_5" style="display:none;">
                <td>v </td>
                <td class="hvr-sweep-to-right" style="font-size:18;">  क्या आपको अस्पताल में परिवार नियोजन सम्बंधी सुविधा प्रदान की गयी?</td>
		<td><input type="radio" name="qfive_5" id="qfive_5_y" value="Yes" >Yes <input type="radio" name="qfive_5" id="qfive_5_n" value="No" >No</td>
        </tr>
        <tr>
                <td>6 </td>
                <td class="hvr-sweep-to-right" style="font-size:18;">  क्या आप परिवार नियोजन के साधनों के बारे में जानकारी लेना चाहते हैं? </td>
                <td><input type="radio" name="qsix" id="qsix_y" value="Yes" >Yes <input type="radio" name="qsix" id="qsix_n" value="No" >No</td>
        </tr>
	<tr>
		<td align='center' colspan=3><button type="button" class="btn btn-primary" name="save_type_eight" id="save_type_eight" onclick="SaveTypeSixQuestions();"> Save </button></td>
	</tr>
	</tbody>
	</table>
	</form>
</body>
</html>
