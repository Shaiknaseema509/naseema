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

        function showfoursubquestions()
         {
                document.getElementById('tr_4_1').style.display = "";           
                document.getElementById('tr_4_2').style.display = "";           
         }

        function hidefoursubquestions()
         {
                document.getElementById('tr_4_1').style.display = "none";               
                document.getElementById('tr_4_2').style.display = "none";               
         }

	function SaveTypeFiveQuestions()
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var selected_hospital_delivery = "";
			if(document.getElementById("qone_y").checked)
			 {
				selected_hospital_delivery = document.getElementById("qone_y").value;
			 }
			else if(document.getElementById("qone_n").checked)
			 {
				selected_hospital_delivery = document.getElementById("qone_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 1');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qone_y").focus();
				return false;
			 }

			var  anyone_during_delivery = "";
			if(document.getElementById("qtwo_y").checked)
			 {
				anyone_during_delivery = document.getElementById("qtwo_y").value;
			 }
			else if(document.getElementById("qtwo_n").checked)
			 {
				anyone_during_delivery = document.getElementById("qtwo_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qtwo_y").focus();
				return false;
			 }

			var with_asha_delivery = "";
			if(document.getElementById("qthree_y").checked)
			 {
				with_asha_delivery = document.getElementById("qthree_y").value;
			 }
			else if(document.getElementById("qthree_n").checked)
			 {
				with_asha_delivery = document.getElementById("qthree_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 3');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qthree_y").focus();
				return false;
			 }

			var  bank_account_open_aadhar = "";
			if(document.getElementById("qfour_y").checked)
			 {
				bank_account_open_aadhar = document.getElementById("qfour_y").value;
			 }
			else if(document.getElementById("qfour_n").checked)
			 {
				bank_account_open_aadhar = document.getElementById("qfour_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 4');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qfour_y").focus();
				return false;
			 }

			var info_janani_yojana = "";
			if(document.getElementById("qfive_y").checked)
			 {
				info_janani_yojana = document.getElementById("qfive_y").value;
			 }
			else if(document.getElementById("qfive_n").checked)
			 {
				info_janani_yojana = document.getElementById("qfive_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 5');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qfive_y").focus();
				return false;
			 }
	
			var govt_expenditure = "";
			if(document.getElementById("qsix_y").checked)
			 {
				govt_expenditure = document.getElementById("qsix_y").value;
			 }
			else if(document.getElementById("qsix_n").checked)
			 {
				govt_expenditure = document.getElementById("qsix_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 6');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qsix_y").focus();
				return false;
			 }

			var callQuery = "type=five&call_hit_referenceno=<?=$_REQUEST["CallReferenceID"];?>&call_id="+CallID+"&beneficiary_id=&agent_id=<?=$_REQUEST["agentid"];?>&selected_hospital_delivery="+selected_hospital_delivery+"&anyone_during_delivery="+anyone_during_delivery+"&with_asha_delivery="+with_asha_delivery+"&bank_account_open_aadhar="+bank_account_open_aadhar+"&info_janani_yojana="+info_janani_yojana+"&govt_expenditure="+govt_expenditure+"&beneficiary_num=<?=$Beneficiary_Details['Whom_PhoneNo'];?>&asha_num=<?=$Beneficiary_Details['ASHA_Phone'];?>&anm_num=<?=$Beneficiary_Details['ANM_Phone'];?>&beneficiary_name=<?=$Beneficiary_Details['Name'];?>&benificary_village=<?=$Beneficiary_Details['Village_Name'];?>";
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
					var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE5";
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
		</tr><tr><th colspan=4>नमस्कार ये काल उत्तर प्रदेस स्वास्थ्य विभाग की ओर से आपके गर्भावस्था में सहयोग प्रदान करने के लिए की जा रही है। आपकी प्रसव की तारीख अब नजदीकी है। आपसे जानना चाहेंगेः </th></tr><tr>
		<th width="2%">S.no</th>
		<th width="">Question</th>
		<th>Result</th>
	</tr>
	</thead>
	<tbody class="">
	<tr >
		<td>1 </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'> क्या आपने प्रसव के लिए अस्पताल का चयन कर लिया है </td>
		<td><input type="radio" name="qone" id="qone_y" value="Yes" >Yes <input type="radio" name="qone" id="qone_n" value="No" >No</td>
	</tr>
	<tr>
		<td>2 </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'> आपके डिलवरी के समय कौन साथ रहेगा क्या आपने यह सुनिश्चित किया है?</td>
		<td><input type="radio" name="qtwo" id="qtwo_y" value="Yes" >Yes <input type="radio" name="qtwo" id="qtwo_n" value="No" >No</td>
	</tr>
	<tr>
		<td>3 </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'> क्या आपको पता है कि आपकी आशा को आपके प्रसव हेतु अस्पताल चलना चाहिए?</td>
		<td><input type="radio" name="qthree" id="qthree_y" value="Yes" >Yes <input type="radio" name="qthree" id="qthree_n" value="No" >No</td>
	</tr>
	<tr>
		<td>4 </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'> क्या आपका आधार कार्ड से जुड़ा बैंक खाता खुल गया है?</td>
		<td><input type="radio" name="qfour" id="qfour_y" value="Yes" onclick="hidefoursubquestions();">Yes <input type="radio" name="qfour" id="qfour_n" value="No" onclick="showfoursubquestions();">No</td>
	</tr>
        <tr id="tr_4_1" style="display:none;">
        </tr>
        <tr id="tr_4_2" style="display:none;">
                <td> </td>
                <td class="hvr-sweep-to-right" style="font-size:18;"> कृपया अपना आधार कार्ड से जुडा बैंक खाता खुलवाये क्योंकि सरकार द्वारा प्रदान की जाने वाली राशि बैंक खाते में ही दी जायेगी।</td>
		<td></td>
        </tr>
	<tr>
		<td>5 </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'> क्या आपको जननी शिशु सुरक्षा योजना के बारे में जानकारी है, जिसमें गर्भवती को अस्पताल में ही प्रसव करावने पर प्रोत्साहन राशि दी जाती है।</td>
		<td><input type="radio" name="qfive" id="qfive_y" value="Yes" >Yes <input type="radio" name="qfive" id="qfive_n" value="No" >No</td>
	</tr>
	<tr>
		<td>6 </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'> क्या आपको जानकारी है कि सरकार आपके प्रसव के दौरान होने वाला खर्च वहन करती है। </td>
		<td><input type="radio" name="qsix" id="qsix_y" value="Yes" >Yes <input type="radio" name="qsix" id="qsix_n" value="No" >No</td>
	</tr>
	<tr>
		<td align='center' colspan=3><button type="button" class="btn btn-primary" name="save_type_five" id="save_type_five" onclick="SaveTypeFiveQuestions();"> Save </button></td>
	</tr>
	</table>
	</tbody>
	</form>
</body>
</html>
