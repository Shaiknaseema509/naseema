<?php 
require_once("dbconnect_emri.php");  
 

  ?>   
<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVK EMRI </title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    	  <script src="js/jquery-1.10.2.min.js"></script>
<script src="js/moment-with-locales.js"></script>
	<script src="js/bootstrap-datetimepicker.js"></script>
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
		  
		  
	 <script type="text/javascript">
 	
	function abcd(a)
	{
		if(a == 'Yes')
			$('.hidshow').show();
		else
			$('.hidshow').hide();
	}
	
		function abcd1(b,c)
	{
		if(b == 'Yes')
			$('.hidshow1'+c).show();
		else
			$('.hidshow1'+c).hide();
	}

 
		
    </script>
<script src="scripts/main_validation.js"></script>
 
<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
			<legend>
				<button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Questionnaire  4 / 7 </button>
		   </legend>
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>4)  Any History of Suicides in your family?</b></td>
		</tr>
 
 		<tr>

 			<td><select id="suicide_history" class="form-control" onchange="return abcd(this.value);">
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>		
 
 			<td class="hidshow" style="display:none">Relation <select id="relation" class="form-control" >
			<option value=''>Select</option>
			<option value='1'>Mother</option>
			<option value='2'>Father</option>
			<option value='3'>Sister</option>			
			<option value='4'>Brother</option>
			<option value='5'>Son</option>
			<option value='6'>Daughter</option>
			<option value='7'>Wife</option>
			<option value='8'>Husband</option>			
			</select></td> 
			<td class="hidshow" style="display:none">Reasons</td><td class="hidshow" style="display:none"><select id="reason" class="form-control" >
			<option value=''>Select</option>
			<option value='1'>Financial issues</option>
			<option value='2'>Psychiatric illness</option>
			<option value='3'>Medical Illness</option>			
			<option value='4'>Love Failures</option>
			<option value='5'>Fear of Failure</option>
			<option value='6'>Conflicts with family relations</option> 
			</select> 
			<td class="hidshow" style="display:none">
			<button type="button" id="btnsave" onclick = 'return savesuicidequestion();'>Save</button></td>
			</td> 
			
			<div class="datagrid" id="datagrid" >
			</div> </tr>	
		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><button class="btn btn-danger" type="button" onclick="return back(3);" value="back">Back</button></td>
			<td><button class="btn btn-success" type="button" value="Submit" onclick="return saveLoad(5);">Submit -></button></td> 
		</tr>
		 
	</table>
	</fieldset>
</form> 

</div>
<script src="scripts/main_validation.js"></script>
<script>
function loadDoc(test) {
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
document.getElementById("datagrid").innerHTML = this.responseText;
}
};
  xhttp.open("GET", "suicidequestionare.php?test="+test, true);
   
  xhttp.send();
}
function savesuicidequestion() 
{  
var xmlHttp=newHttpObject();
		 var caller_id = document.getElementById('caller_id').value;
		   
		if(xmlHttp)
		 {
	var relation_id	= document.getElementById('relation').value;
	var relation_name = $('#relation option:selected').text();
	var reason_id	= document.getElementById('reason').value;
	var reason_name = $('#reason option:selected').text();
 
	  
	var callQuery="type=suicidequestionnare&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&relation_id="+relation_id+"&relation_name="+relation_name+"&reason_id="+reason_id+"&reason_name="+reason_name;
																		
	//alert(callQuery);
		xmlHttp.open("POST","save_suicide_details.php",true);
		xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlHttp.send(callQuery);
		xmlHttp.onreadystatechange=function()
		 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
				 {
					var Response = null;
					Response = xmlHttp.responseText; 
					
					if(Response =='' || Response ==0)
					{
						$('.alert').show();
						$('.alert_content').html('Please Add Beneficiary ');
						setTimeout(function(){$('.alert').hide();},10000); 
						return false;
					} 
					else
					{
						$('.alert').show();
						$('.alert_content').html('Grievance Created ..');
						setTimeout(function(){$('.alert').hide();},10000); 
						$('#btngre').hide();
						return false;
					}
				}
		 }
	 }
		delete xmlHttp;		 
	loadDoc($('#caller_id').val());
}
 
</script>
<style>
.datagrid table { border-collapse: collapse; text-align: center; width: 100%;  } 
.datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; 
background: #fff; overflow: hidden; border: 1px solid #3A7999; 
border-radius: 10px; }
.datagrid tr:nth-child(even) {
  background-color:#E0FFFF;
  color: #000000;
}
.datagrid table td, .datagrid table th { padding: 16px 8px; }
.datagrid table thead th {
background-color:rgb(41, 183, 211); color:#FFFFFF; font-size: 12px; text-align: center; font-weight: bold; border-left: 1px solid #0070A8; } 

.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: bold; }
.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }
.datagrid table tbody td:first-child { border-left: none; }
.datagrid table tbody tr:last-child td { border-bottom: none; }

</style>
  
  