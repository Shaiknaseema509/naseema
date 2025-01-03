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
	
	function SaveTypeSevenQuestions()
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var contraception_methods = "";
			if(document.getElementById("qone_y").checked)
			 {
				contraception_methods = document.getElementById("qone_y").value;
			 }
			else if(document.getElementById("qone_n").checked)
			 {
				contraception_methods = document.getElementById("qone_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 1');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qone_y").focus();
				return false;
			 }

			var  infertility = "";
			if(document.getElementById("qtwo_y").checked)
			 {
				infertility = document.getElementById("qtwo_y").value;
			 }
			else if(document.getElementById("qtwo_n").checked)
			 {
				infertility = document.getElementById("qtwo_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qtwo_y").focus();
				return false;
			 }

			var  pregnancy = "";
			if(document.getElementById("qthree_y").checked)
			 {
				pregnancy = document.getElementById("qthree_y").value;
			 }
			else if(document.getElementById("qthree_n").checked)
			 {
				pregnancy = document.getElementById("qthree_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 3');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qthree_y").focus();
				return false;
			 }

			var abortion_mtp = "";
			if(document.getElementById("qfour_y").checked)
			 {
				abortion_mtp = document.getElementById("qfour_y").value;
			 }
			else if(document.getElementById("qfour_n").checked)
			 {
				abortion_mtp = document.getElementById("qfour_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 4');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qfour_y").focus();
				return false;
			 }

			var government_plan = "";
			if(document.getElementById("qfive_y").checked)
			 {
				 government_plan = document.getElementById("qfive_y").value;
			 }
			else if(document.getElementById("qfive_n").checked)
			 {
				government_plan = document.getElementById("qfive_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 5');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qfive_y").focus();
				return false;
			 }

			var callQuery = "type=seven&call_hit_referenceno=<?=$_REQUEST["CallReferenceID"];?>&call_id="+CallID+"&beneficiary_id=&agent_id=<?=$_REQUEST["agentid"];?>&contraception_methods="+contraception_methods+"&infertility="+infertility+"&pregnancy="+pregnancy+"&abortion_mtp="+abortion_mtp+"&government_plan="+government_plan;
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
					var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE7";
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
	<form >
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
		<td class="hvr-sweep-to-right" style="font-size:18;">Contraception and other Contraception Methods<br>गर्भनिरोधक और अन्य गर्भनिरोधक तरीके </td>
		<td><input type="radio" name="qone" id="qone_y" value="Yes" >Yes <input type="radio" name="qone" id="qone_n" value="No" >No</td>
	</tr>
	<tr>
		<td>2 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Infertility<br>बांझपन </td>
		<td><input type="radio" name="qtwo" id="qtwo_y" value="Yes" >Yes <input type="radio" name="qtwo" id="qtwo_n" value="No" >No</td>
	</tr>
	<tr>
		<td>3 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Pregnancy<br>गर्भावस्था </td>
		<td><input type="radio" name="qthree" id="qthree_y" value="Yes" >Yes <input type="radio" name="qthree" id="qthree_n" value="No" >No</td>
	</tr>
	<tr>
		<td>4 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Abortion-MTP<br>गर्भपात-एमटीपी </td>
		<td><input type="radio" name="qfour" id="qfour_y" value="Yes" >Yes <input type="radio" name="qfour" id="qfour_n" value="No" >No</td>
	</tr>
	<tr>
		<td>5 </td>
		<td class="hvr-sweep-to-right" style="font-size:18;">Government Initiatives and Schemes for Family Planning<br>परिवार नियोजन के लिए सरकार की पहल और योजनाएं </td>
		<td><input type="radio" name="qfive" id="qfive_y" value="Yes" >Yes <input type="radio" name="qfive" id="qfive_n" value="No" >No</td>
	</tr>
	<tr>
		<td align='center' colspan=3><button type="button" name="save_type_seven" id="save_type_seven" onclick="SaveTypeSevenQuestions();"> Save </button></td>
	</tr>
	</tbody>
	</table>
	</form>
</body>
</html>

