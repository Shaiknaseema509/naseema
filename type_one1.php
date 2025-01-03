<?php
?>
<html>
<head>
<style>
.abc { background-color:#fffff}
.abc tr:nth-child(even) {background-color: #ccffcc !important}
.abc tr:nth-child(odd) {background-color: #FFF}
</style>
</head>
	<script type='text/javascript'>
	
	function validate()
	{
		var xmlhttp;
		
		var examined_id="";
		if ((document.getElementById('qone_doctor').checked)!="") {
			var examined_id = document.getElementById('qone_doctor').value;
		 }
		else if ((document.getElementById('qone_anm').checked)!="") {
			var examined_id = document.getElementById('qone_anm').value;
		 }
		else if ((document.getElementById('qone_asha').checked)!="") {
			var examined_id = document.getElementById('qone_asha').value;
		 }
		if(examined_id =="")
		{
			alert('Please select the Examiner Name');
			return false;
		}
		alert(examined_id);
			
		var blood_test="";		
		if ((document.getElementById('qtwo_y').checked)!="") {
			var blood_test = document.getElementById('qtwo_y').value;
		 }
		else if ((document.getElementById('qtwo_n').checked)!="") {
			var blood_test = document.getElementById('qtwo_n').value;
		 }
		else if(blood_test==""){
			alert("Please Select YES/NO for Question 2");
			document.getElementById('qtwo_y').focus();
			return false;
		 }		

		var height_weight="";
		if ((document.getElementById('qthree_y').checked)!="") {
			var height_weight = document.getElementById('qthree_y').value;
		 }
			else if ((document.getElementById('qthree_n').checked)!="") {
			var height_weight = document.getElementById('qthree_n').value;
		 }
		else if(height_weight==""){
			alert('Please Select YES/NO for Question 3');
			document.getElementById('qthree_y').focus();
		}
		
		var tt_injection="";		
		if ((document.getElementById('qfour_y').checked)!="") {
			var tt_injectio = document.getElementById('qfour_y').value;
		 }
		else if ((document.getElementById('qfour_n').checked)!="") {
			var tt_injection = document.getElementById('qfour_n').value;
		 }
		else if(tt_injection==""){
			alert("Please Select YES/NO for Question 4");
			document.getElementById('qfour_y').focus();
			return false;
		}
		
		var danger_pregnancy="";		
		if ((document.getElementById('qfive_y').checked)!="") {
			var danger_pregnancy = document.getElementById('qfive_y').value;
		 }
		else if ((document.getElementById('qfive_n').checked)!="") {
			var danger_pregnancy = document.getElementById('qfive_n').value;
		 }
		else if(danger_pregnancy==""){
			alert("Please Select YES/NO for Question 5");
			document.getElementById('qfive_y').focus();
			return false;
		}

		var information="";		
		if ((document.getElementById('qsix_y').checked)!="") {
			var information = document.getElementById('qsix_y').value;
		 }
		else if ((document.getElementById('qsix_n').checked)!="") {
			var information = document.getElementById('qsix_n').value;
		 }
		else if(information==""){
			alert("Please Select YES/NO for Question 6");
			document.getElementById('qsix_y').focus();
			return false;
		}
	
		var Call_Query = 'ACTION=INSERT&type=type_one&examined_id='+examined_id+'&blood_test='+blood_test+'&height_weight='+height_weight+'&tt_injection='+tt_injection+'&danger_pregnancy='+danger_pregnancy+'&102_information='+information;
		alert(Call_Query);exit;

	 }

	</script>
</head>
<body>
	<form name='type_one' method='POST' >
	<table class="table table-striped">
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
		<td>Who examined you </td>
		<td><input type='radio' id='qone_doctor' name ='qone' value='doctor'>Doctor <input type='radio' id='qone_anm' name ='qone' value='anm'>ANM <input type='radio' id='qone_asha' name ='qone' value='asha'>ASHA </td>				
	</tr>
	<tr>
		<td>2 </td>
		<td>Any Blood Test Was done </td>
		<td><input type="radio" name="qtwo" id="qtwo_y" value="Yes" >Yes <input type="radio" name="qtwo" id="qtwo_n" value="No" >No</td>
	</tr>
	<tr>
		<td>3 </td>
		<td>Have they recorded your Height and weight? </td>
		<td><input type="radio" name="qthree" id="qthree_y" value="Yes" >Yes <input type="radio" name="qthree" id="qthree_n" value="No" >No</td>
	</tr>
	<tr>
		<td>4 </td>
		<td>Have you received TT injection? </td>
		<td><input type="radio" name="qfour" id="qfour_y" value="Yes" >Yes <input type="radio" name="qfour" id="qfour_n" value="No" >No</td>
	</tr>
	<tr>
		<td>5 </td>
		<td>Are you informed about danger signs of pregnancy? </td>
		<td><input type="radio" name="qfive" id="qfive_y" value="Yes" >Yes <input type="radio" name="qfive" id="qfive_n" value="No" >No</td>
	</tr>
	<tr>
		<td>6 </td>
		<td>Are you informed about toll free 102 number for transporting <br >the pregnant women to a health care facility free of cost? </td>
		<td><input type="radio" name="qsix" id="qsix_y" value="Yes" >Yes <input type="radio" name="qsix" id="qsix_n" value="No" >No</td>
	</tr>
				
	</table>
	<table class="table">
	<tr>
		<td></td><td>
		<input type='button' id='submit' name='submit' value='Submit' onclick =" return validate();"></td>
		<td></td>
	</tr>
	</table>
	</form>
</body>
</html>
