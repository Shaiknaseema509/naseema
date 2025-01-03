<?php
?>
<html>
<head>
<style>
.abc { background-color:#fffff}
.abc tr:nth-child(even) {background-color: #E6E6FA !important}
.abc tr:nth-child(odd) {background-color: #FFF}
</style>
<script src="scripts/main_validation.js"></script>
<script type="text/javascript">
	$("tr td:nth-child(2)").addClass("hvr-bounce-to-right ");
	function SaveTypeFiveQuestions()
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var Condoms = "";
			if(document.getElementById("qone_1_y").checked)
			 {
				Condoms = document.getElementById("qone_1_y").value;
			 }
			else if(document.getElementById("qone_1_n").checked)
			 {
				Condoms = document.getElementById("qone_1_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 1 i');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qone_1_y").focus();
				return false;
			 }

			var  Pills = "";
			if(document.getElementById("qone_2_y").checked)
			 {
				Pills = document.getElementById("qone_2_y").value;
			 }
			else if(document.getElementById("qone_2_n").checked)
			 {
				Pills = document.getElementById("qone_2_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 1 ii');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qone_2_y").focus();
				return false;
			 }

			var IUCD = "";
			if(document.getElementById("qone_3_y").checked)
			 {
				IUCD = document.getElementById("qone_3_y").value;
			 }
			else if(document.getElementById("qone_3_n").checked)
			 {
				IUCD = document.getElementById("qone_3_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 1 iii');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qone_3_y").focus();
				return false;
			 }

			var PPIUD = "";
			if(document.getElementById("qtwo_1_y").checked)
			 {
				PPIUD = document.getElementById("qtwo_1_y").value;
			 }
			else if(document.getElementById("qtwo_1_n").checked)
			 {
				PPIUD = document.getElementById("qtwo_1_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2 i');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qtwo_1_y").focus();
				return false;
			 }

			var PPIUD_free_cost = "";
			if(document.getElementById("qtwo_2_y").checked)
			 {
				PPIUD_free_cost = document.getElementById("qtwo_2_y").value;
			 }
			else if(document.getElementById("qtwo_2_n").checked)
			 {
				PPIUD_free_cost = document.getElementById("qtwo_2_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2 ii');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qtwo_2_y").focus();
				return false;
			 }
	
			var PPIUD_service = "";
			if(document.getElementById("qtwo_3_y").checked)
			 {
				PPIUD_service = document.getElementById("qtwo_3_y").value;
			 }
			else if(document.getElementById("qtwo_3_n").checked)
			 {
				PPIUD_service = document.getElementById("qtwo_3_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2 iii');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qtwo_3_y").focus();
				return false;
			 }

			var vasectomy = "";
			if(document.getElementById("qthree_1_y").checked)
			 {
				vasectomy = document.getElementById("qthree_1_y").value;
			 }
			else if(document.getElementById("qthree_1_n").checked)
			 {
				vasectomy = document.getElementById("qthree_1_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 3 i');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qthree_1_y").focus();
				return false;
			 }

			var Tubectomy = "";
			if(document.getElementById("qthree_2_y").checked)
			 {
				Tubectomy = document.getElementById("qthree_2_y").value;
			 }
			else if(document.getElementById("qthree_2_n").checked)
			 {
				Tubectomy = document.getElementById("qthree_2_n").value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 3 ii');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qthree_2_y").focus();
				return false;
			 }

			var callQuery = "type=five&call_id=&beneficiary_id=&agent_id=<?=$_POST["agentid"];?>&Condoms="+Condoms+"&Pills="+Pills+"&IUCD="+IUCD+"&PPIUD="+PPIUD+"&PPIUD_free_cost="+PPIUD_free_cost+"&PPIUD_service="+PPIUD_service+"&vasectomy="+vasectomy+"&Tubectomy="+Tubectomy;
                        alert(callQuery);//return false;
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
					var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_POST["convoxuid"];?>&agent_id=<?=$_POST["agentid"];?>&disposition=TYPE5";
					alert(end_call_url);
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
		<td colspan=2>What family planning method you are following?</td>
	</tr>
	<tr>
		<td>i </td>
		<td>Condoms </td>
		<td><input type="radio" name="qone_1" id="qone_1_y" value="Yes" >Yes <input type="radio" name="qone_1" id="qone_1_n" value="No" >No</td>
	</tr>
	<tr>
		<td>ii </td>
		<td>Pills</td>
		<td><input type="radio" name="qone_2" id="qone_2_y" value="Yes" >Yes <input type="radio" name="qone_2" id="qone_2_n" value="No" >No</td>
	</tr>
	<tr>
		<td>iii </td>
		<td>IUCD</td>
		<td><input type="radio" name="qone_3" id="qone_3_y" value="Yes" >Yes <input type="radio" name="qone_3" id="qone_3_n" value="No" >No</td>
	</tr>
	<tr>
		<td>2 </td>
		<td colspan=2>Are you aware that –</td>
	</tr>
	<tr>
		<td>i </td>
		<td>PPIUD (Postpartum Intra Uterine Contraceptive Device)<br> is easy and offers long term protection against pregnancy.</td>
		<td><input type="radio" name="qtwo_1" id="qtwo_1_y" value="Yes" >Yes <input type="radio" name="qtwo_1" id="qtwo_1_n" value="No" >No</td>
	</tr>
	<tr>
		<td>ii </td>
		<td>It is provided free of cost</td>
		<td><input type="radio" name="qtwo_2" id="qtwo_2_y" value="Yes" >Yes <input type="radio" name="qtwo_2" id="qtwo_2_n" value="No" >No</td>
	</tr>
	<tr>
		<td>iii </td>
		<td>Where to get the free service</td>
		<td><input type="radio" name="qtwo_3" id="qtwo_3_y" value="Yes" >Yes <input type="radio" name="qtwo_3" id="qtwo_3_n" value="No" >No</td>
	</tr>
	<tr>
		<td>3 </td>
		<td colspan=2>If the choice is the permanent method?</td>
	</tr>
	<tr>
		<td>i </td>
		<td>Are you aware of vasectomy (for men)?</td>
		<td><input type="radio" name="qthree_1" id="qthree_1_y" value="Yes" >Yes <input type="radio" name="qthree_1" id="qthree_1_n" value="No" >No</td>
	</tr>
	<tr>
		<td>ii </td>
		<td>Are you aware of Tubectomy (for women)?</td>
		<td><input type="radio" name="qthree_2" id="qthree_2_y" value="Yes" >Yes <input type="radio" name="qthree_2" id="qthree_2_n" value="No" >No</td>
	</tr>
	<tr>
		<td align='center' colspan=3><button type="button" name="save_type_five" id="save_type_five" onclick="SaveTypeFiveQuestions();"> Save </button></td>
	</tr>
	</table>
	</tbody>
	</form>
</body>
</html>
