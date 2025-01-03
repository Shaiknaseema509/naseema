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

        function showthreesubquestions()
         {
                document.getElementById('tr_3_1').style.display = "";           
                document.getElementById('tr_3_2').style.display = "";           
         }

        function hidethreesubquestions()
         {
                document.getElementById('tr_3_1').style.display = "none";               
                document.getElementById('tr_3_2').style.display = "none";               
         }

	function SaveTypeFourQuestions()
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var problem_in_pregnancy = "";
                        if(document.getElementById('qone_y').checked)
                         {
                               problem_in_pregnancy = document.getElementById('qone_y').value;
                         }
                        else if(document.getElementById('qone_n').checked)
                         {
                               problem_in_pregnancy = document.getElementById('qone_n').value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 1');
                                setTimeout(function(){$('.alert').hide();},10000);
                                document.getElementById('qone_y').focus();
                                return false;
                         }              

                        var hazards_during_pregnancy = "";
                        if(document.getElementById('qtwo_y').checked)
                         {
                                hazards_during_pregnancy = document.getElementById('qtwo_y').value;
                         }
                        else if(document.getElementById('qtwo_n').checked)
                         {
                                hazards_during_pregnancy = document.getElementById('qtwo_n').value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 2');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById('qtwo_y').focus();
                                return false;
                         }

			var asha_anm_enquiry = "";
                        if(document.getElementById('qthree_y').checked)
                         {
                                asha_anm_enquiry = document.getElementById('qthree_y').value;
                         }
                        else if(document.getElementById('qthree_n').checked)
                         {
                                asha_anm_enquiry = document.getElementById('qthree_n').value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 3');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById('qthree_y').focus();
                                return false;
                         }
                
                        var ultrasound_checked = "";
                        if(document.getElementById('qfour_y').checked)
                         {
                                ultrasound_checked = document.getElementById('qfour_y').value;
                         }
                        else if(document.getElementById('qfour_n').checked)
                         {
                                ultrasound_checked = document.getElementById('qfour_n').value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 4');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById('qfour_y').focus();
                                return false;
                         }

			var callQuery = "type=four&call_hit_referenceno=<?=$_REQUEST["CallReferenceID"];?>&call_id="+CallID+"&beneficiary_id=<?=$Beneficiary_Details['ID_No'];?>&agent_id=<?=$_REQUEST["agentid"];?>&problem_in_pregnancy="+problem_in_pregnancy+"&hazards_during_pregnancy="+hazards_during_pregnancy+"&asha_anm_enquiry="+asha_anm_enquiry+"&ultrasound_checked="+ultrasound_checked+"&beneficiary_num=<?=$Beneficiary_Details['Whom_PhoneNo'];?>&asha_num=<?=$Beneficiary_Details['ASHA_Phone'];?>&anm_num=<?=$Beneficiary_Details['ANM_Phone'];?>&beneficiary_name=<?=$Beneficiary_Details['Name'];?>&benificary_village=<?=$Beneficiary_Details['Village_Name'];?>";
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
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE2&FEEDBACK_IVR=N";
					 }
					else
					 {
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE2&FEEDBACK_IVR=Y&convox_ivr_ids="+convox_ivr_ids;
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
		</tr><tr><th colspan=4>नमस्कार ये काल उत्तर प्रदेश स्वास्थ्य विभाग की ओर से आपके गर्भावस्था में सहयोग प्रदान करने के लिए की जा रही है। आपसे जानना चाहेंगेः</th></tr><tr>
		<th width="2%">S.no</th>
		<th width="">Question</th>
		<th>Result</th>
	</tr>
	</thead>
	<tbody>
	<tr>
                <td>1 </td>
                <td class="hvr-sweep-to-right" style="font-size:18;">आपको गर्भावस्था में कोई दिक्कत हो रही है?</td>
                <td><input type="radio" name="qone" id="qone_y" value="Yes" onclick="showonesubquestions();">Yes <input type="radio" name="qone" id="qone_n" value="No" onclick="hideonesubquestions();">No</td>
        </tr>
        <tr id="tr_1_1" style="display:none;">
                <td> </td>
                <td class="hvr-sweep-to-right" style="font-size:20;">यदि उत्तर हाँ है तो- कृपया आशा या ए०एन०एम० से सम्पर्क करें तथा सरकारी अस्पताल जा कर दिखाये।</td>
		<td></td>
        </tr>
        <tr id="tr_1_2" style="display:none;">
        </tr>
        <tr>
                <td>2 </td>
                <td class="hvr-sweep-to-right" style="font-size:18;">क्या आपको गर्भावस्था के दौरान होने वाले खतरों के लक्षण के बारे में जानकारी है?
गर्भावस्था के <br> गम्भीर लक्षण हैं- जैसे अचानक योनि के नीचे के रास्ते से बदबूदार खून आना, अचानक सर दर्द, नजरों <br>में गड़बड़ी एवं धुंधलापन अत्याधिक पेट दर्द, झटके आना, हाथ पैर एवं चेहरे पर सूजन, बुखार एवं बच्चा हिलता-डुलता नहीं है।</td>
                <td><input type="radio" name="qtwo" id="qtwo_y" value="Yes" >Yes <input type="radio" name="qtwo" id="qtwo_n" value="No" >No</td>
        </tr>
        <tr>
                <td>3 </td>
                <td class="hvr-sweep-to-right" style="font-size:18;">पहली जाँच के दौरान आशा या ए०एन०एम० बहन जी ने आपमें खून की कमी, बढा हुआ बी पी, मधुमेह की शिकायत बतायी थी?</td>
                <td><input type="radio" name="qthree" id="qthree_y" value="Yes" onclick="showthreesubquestions();">Yes <input type="radio" name="qthree" id="qthree_n" value="No" onclick="hidethreesubquestions();">No</td>
        </tr>
        <tr id="tr_3_1" style="display:none;">
                <td> </td>
                <td class="hvr-sweep-to-right" style="font-size:20;">यदि उत्तर हाँ है तो- कृपया आशा या ए०एन०एम० से सम्पर्क करें एवं हर माह सरकारी अस्पताल जा कर चिकित्सक को दिखाये।</td>
                <td></td>
        </tr>
        <tr id="tr_3_2" style="display:none;">
        </tr>
        <tr>
                <td>4 </td>
                <td class="hvr-sweep-to-right" style="font-size:18;">क्या आपकी अल्ट्रासाउन्ड की जाँच हुई है?</td>
                <td><input type="radio" name="qfour" id="qfive_y" value="Yes" >Yes <input type="radio" name="qfour" id="qfour_n" value="No" >No</td>
        </tr>
	<tr>
		<td align='center' colspan=3><button type="button" name="save_type_five" class="btn btn-primary" id="save_type_five" onclick="SaveTypeFourQuestions();"> Save </button></td>
	</tr>
	</table>
	</tbody>
	</form>
</body>
</html>
