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
	
	function SaveTypeEightQuestions()
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var Anemia = "";
			if(document.getElementById("qone_y").checked)
			 {
				Anemia = document.getElementById("qone_y").value;
			 }
			else if(document.getElementById("qone_n").checked)
			 {
				Anemia = document.getElementById("qone_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 1');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qone_y").focus();
				return false;
			 }

			var Hypertension = "";
			if(document.getElementById("qtwo_y").checked)
			 {
				Hypertension = document.getElementById("qtwo_y").value;
			 }
			else if(document.getElementById("qtwo_n").checked)
			 {
				Hypertension = document.getElementById("qtwo_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qtwo_y").focus();
				return false;
			 }

			var Diabetes = "";
			if(document.getElementById("qthree_y").checked)
			 {
				Diabetes = document.getElementById("qthree_y").value;
			 }
			else if(document.getElementById("qthree_n").checked)
			 {
				Diabetes = document.getElementById("qthree_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 3');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qthree_y").focus();
				return false;
			 }

			var Epilepsy = "";
			if(document.getElementById("qfour_y").checked)
			 {
				Epilepsy = document.getElementById("qfour_y").value;
			 }
			else if(document.getElementById("qfour_n").checked)
			 {
				Epilepsy = document.getElementById("qfour_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 4');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qfour_y").focus();
				return false;
			 }

			var ObeseWomen = "";
			if(document.getElementById("qfive_y").checked)
			 {
				ObeseWomen = document.getElementById("qfive_y").value;
			 }
			else if(document.getElementById("qfive_n").checked)
			 {
				ObeseWomen = document.getElementById("qfive_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 5');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qfive_y").focus();
				return false;
			 }

			var MultipleGestation = "";
			if(document.getElementById("qsix_y").checked)
			 {
				MultipleGestation = document.getElementById("qsix_y").value;
			 }
			else if(document.getElementById("qsix_n").checked)
			 {
				MultipleGestation = document.getElementById("qsix_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 6');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qsix_y").focus();
				return false;
			 }

			var PregnancyBeforeCompletionOf17Years = "";
			if(document.getElementById("qseven_y").checked)
			 {
				 PregnancyBeforeCompletionOf17Years = document.getElementById("qseven_y").value;
			 }
			else if(document.getElementById("qseven_n").checked)
			 {
				PregnancyBeforeCompletionOf17Years = document.getElementById("qseven_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 7');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qseven_y").focus();
				return false;
			 }

			var PregnancyWithHIV = "";
			if(document.getElementById("qeight_y").checked)
			 {
				PregnancyWithHIV = document.getElementById("qeight_y").value;
			 }
			else if(document.getElementById("qeight_n").checked)
			 {
				PregnancyWithHIV = document.getElementById("qeight_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 5');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qeight_y").focus();
				return false;
			 }

			var callQuery = "type=eight&call_hit_referenceno=<?=$_REQUEST["CallReferenceID"];?>&call_id="+CallID+"&beneficiary_id=&agent_id=<?=$_REQUEST["agentid"];?>&anemia="+Anemia+"&hypertension="+Hypertension+"&diabetes="+Diabetes+"&epilepsy="+Epilepsy+"&obesewomen="+ObeseWomen+"&multiplegestation="+MultipleGestation+"&pregnancybeforecompletionof17years="+PregnancyBeforeCompletionOf17Years+"&pregnancywithhiv="+PregnancyWithHIV;
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
					var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE8";
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
		<th width="2%">S.no</th>
		<th width="">Question</th>
		<th>Result</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>1 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Women with anemia<br>एनीमिया के साथ महिलाएं </td>
		<td><input type="radio" name="qone" id="qone_y" value="Yes" >Yes <input type="radio" name="qone" id="qone_n" value="No" >No</td>
	</tr>
	<tr>
		<td>2 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Women with Hypertension<br>उच्च रक्तचाप वाली महिलाएं </td>
		<td><input type="radio" name="qtwo" id="qtwo_y" value="Yes" >Yes <input type="radio" name="qtwo" id="qtwo_n" value="No" >No</td>
	</tr>
	<tr>
		<td>3 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Women with diabetes<br>मधुमेह के साथ महिलाएं </td>
		<td><input type="radio" name="qthree" id="qthree_y" value="Yes" >Yes <input type="radio" name="qthree" id="qthree_n" value="No" >No</td>
	</tr>
	<tr>
		<td>4 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Women with epilepsy<br>मिर्गी के साथ महिलाएं </td>
		<td><input type="radio" name="qfour" id="qfour_y" value="Yes" >Yes <input type="radio" name="qfour" id="qfour_n" value="No" >No</td>
	</tr>
	<tr>
		<td>5 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Obese women<br>मोटापे से ग्रस्त महिलाएं </td>
		<td><input type="radio" name="qfive" id="qfive_y" value="Yes" >Yes <input type="radio" name="qfive" id="qfive_n" value="No" >No</td>
	</tr>
	<tr>
		<td>6 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Multiple gestation<br>एकाधिक गर्भावस्था </td>
		<td><input type="radio" name="qsix" id="qsix_y" value="Yes" >Yes <input type="radio" name="qsix" id="qsix_n" value="No" >No</td>
	</tr>
	<tr>
		<td>7 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Pregnancy before completion of 17 years<br>17 वर्ष पूरे होने से पहले गर्भावस्था </td>
		<td><input type="radio" name="qseven" id="qseven_y" value="Yes" >Yes <input type="radio" name="qseven" id="qseven_n" value="No" >No</td>
	</tr>
	<tr>
		<td>8 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Pregnancy with HIV<br>एचआईवी के साथ गर्भावस्था </td>
		<td><input type="radio" name="qeight" id="qeight_y" value="Yes" >Yes <input type="radio" name="qeight" id="qeight_n" value="No" >No</td>
	</tr>
	<tr>
		<td align='center' colspan=3><button type="button" name="save_type_eight" id="save_type_eight" onclick="SaveTypeEightQuestions();"> Save </button></td>
	</tr>
	</tbody>
	</table>
	</form>
</body>
</html>
