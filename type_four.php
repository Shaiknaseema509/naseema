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
<script type='text/javascript'>
	
	function SaveTypeTwoQuestions()
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var child_drinking_mother_milk = "";
                	if(document.getElementById('qone_y').checked)
			 {
                	       child_drinking_mother_milk = document.getElementById('qone_y').value;
                	 }
                	else if(document.getElementById('qone_n').checked)
			 {
                	     	child_drinking_mother_milk = document.getElementById('qone_n').value;
                	 }
                	else
			 {
                	    	$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 1');
                		setTimeout(function(){$('.alert').hide();},10000);
                	        document.getElementById('qone_y').focus();
                	        return false;
                	 }              

			var child_vaccines_three_month = "";
			if(document.getElementById('qtwo_y').checked)
			 {
				child_vaccines_three_month = document.getElementById('qtwo_y').value;
			 }
			else if(document.getElementById('qtwo_n').checked)
			 {
				child_vaccines_three_month = document.getElementById('qtwo_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById('qtwo_y').focus();
				return false;
			 }
		
			var adopted_family_planning = "";
			if(document.getElementById('qthree_y').checked)
			 {
				adopted_family_planning = document.getElementById('qthree_y').value;
			 }
			else if(document.getElementById('qthree_n').checked)
			 {
				adopted_family_planning = document.getElementById('qthree_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 3');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById('qthree_y').focus();
				return false;
			 }
		
			var to_know_family_planning = "";
			if(document.getElementById('qfour_y').checked)
			 {
				to_know_family_planning = document.getElementById('qfour_y').value;
			 }
			else if(document.getElementById('qfour_n').checked)
			 {
				to_know_family_planning = document.getElementById('qfour_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 4');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById('qfour_y').focus();
				return false;
			 }
				
			var weight_baby_measured_anm = "";
			if(document.getElementById('qfive_y').checked)
			 {
				weight_baby_measured_anm = document.getElementById('qfive_y').value;
			 }
			else if(document.getElementById('qfive_n').checked)
			 {
				weight_baby_measured_anm = document.getElementById('qfive_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 5');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById('qfive_y').focus();
				return false;
			 }

			var callQuery="type=two&call_hit_referenceno=<?=$_REQUEST["CallReferenceID"];?>&call_id="+CallID+"&beneficiary_id=<?=$Beneficiary_Details['ID_No'];?>&agent_id=<?=$_REQUEST["agentid"];?>&child_drinking_mother_milk="+child_drinking_mother_milk+"&child_vaccines_three_month="+child_vaccines_three_month+"&adopted_family_planning="+adopted_family_planning+"&to_know_family_planning="+to_know_family_planning+"&weight_baby_measured_anm="+weight_baby_measured_anm+"&beneficiary_num=<?=$Beneficiary_Details['Whom_PhoneNo'];?>&asha_num=<?=$Beneficiary_Details['ASHA_Phone'];?>&anm_num=<?=$Beneficiary_Details['ANM_Phone'];?>&beneficiary_name=<?=$Beneficiary_Details['Name'];?>&benificary_village=<?=$Beneficiary_Details['Village_Name'];?>";
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
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE4&FEEDBACK_IVR=N";
					 }
					else
					 {
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE4&FEEDBACK_IVR=Y&convox_ivr_ids="+convox_ivr_ids;
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
		</tr><tr><th colspan=4>नमस्कार ये कॉल उत्तर प्रदेश स्वास्थ विभाग की तरफ से आपके शिशु के विकास में सहयोग प्रदान करने के लिए की जा रही है-</th></tr><tr>
		<th width="2%">S.no</th>
		<th width="">Question</th>
		<th>Result</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>1 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या शिशु सिर्फ माँ का दूध पी रहा है?</td>
		<td><input type="radio" name="qone" id="qone_y" value="Yes" >Yes <input type="radio" name="qone" id="qone_n" value="No" >No</td>
	</tr>
	<tr>
		<td>2 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या बच्चे को साढ़े तीन महीने तक लगने वाले सभी टीके लगाए जा चुकें हैं?</td>
		<td><input type="radio" name="qtwo" id="qtwo_y" value="Yes" >Yes <input type="radio" name="qtwo" id="qtwo_n" value="No" >No</td>
	</tr>
	<tr>
		<td>3 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आपने परिवार नियोजन का कोई साधन अपनाया है?</td>
		<td><input type="radio" name="qthree" id="qthree_y" value="Yes" >Yes <input type="radio" name="qthree" id="qthree_n" value="No" >No</td>
	</tr>
	<tr>
		<td>4 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या आप परिवार नियोजन के साधनों के बारे में जानकारी लेना चाहते हैं?</td>
		<td><input type="radio" name="qfour" id="qfive_y" value="Yes" >Yes <input type="radio" name="qfour" id="qfour_n" value="No" >No</td>
	</tr>
	<tr>
		<td>5 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">क्या बच्चे का वजन हर माह ए०एन०एम० के द्वारा मापा गया है?</td>
		<td><input type="radio" name="qfive" id="qfive_y" value="Yes" >Yes <input type="radio" name="qfive" id="qfive_n" value="No" >No</td>
	</tr>
	<tr>
		<td align='center' colspan=3><button type="button" class="btn btn-primary" name="save_type_two" id="save_type_two" onclick="SaveTypeTwoQuestions();"> Save </button></td>
	</tr>
	</tbody>
	</table>
	</form>
</body>
</html>
