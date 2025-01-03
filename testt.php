<?php include("includes/config.php");
error_reporting(0);

session_start();


$mobilenumber=$_SESSION['mobilenumber'];
$agent_id=$_SESSION['agent_id'];
$convoxid= $_SESSION['convoxid'];
$host_ip=$_SESSION['host_ip'];

 

?>

<html>
<head>
<title> </title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/StyleSheets.css" type="text/css">
<link rel="stylesheet" href="css/jquery-ui-timepicker-addon.css" type="text/css">
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css"> 
 

  	  <script src="js/jquery-1.10.2.min.js"></script> 
		
<script src="scripts/main_validation.js"></script>  

 


 <script type = "text/javascript" >
 	function abcd(a)
	{
		if(a == 'Yes')
			$('.hidshow').show();
		else
			$('.hidshow').hide();
		
		if(a == 'No')
			$('.hidshow1').show();
		else
			$('.hidshow1').hide();
	}
	function abcd1(a)
	{
		if(a == 'Yes')
			$('.hidshow2').show();
		else
			$('.hidshow2').hide();
		
		if(a == 'No')
			$('.hidshow3').show();
		else
			$('.hidshow3').hide();
	}
	function abcd2(a)
	{
		if(a == 'Still with Suicidal Ideations')
			$('.hidshow4').show();
		else
			$('.hidshow4').hide();
	}
	
	function abcd3(b,c)
	{
		if(b == 'Yes')
			$('.hidshow5'+c).show();
		else
			$('.hidshow5'+c).hide();
	}
		function abcd4(a)
	{
		if(a == 'Yes')
			$('.hidshow34').show();
		else
			$('.hidshow34').hide();
	}
	
		function abcd5(a)
	{
		if(a == 'Yes')
			$('.hidshow14').show();
		else
			$('.hidshow14').hide();
	}
	
	function abcd6(b,c)
	{
		if(b == 'Yes')
			$('.hidshow1'+c).show();
		else
			$('.hidshow1'+c).hide();
	}
	
	function abcd7(a)
	{
		if(a == 'Yes')
			$('.hidshow14').show();
		else
			$('.hidshow14').hide();
	}
	
	function abcd8(b,c)
	{
		if(b == 'Yes')
			$('.hidshow2'+c).show();
		else
			$('.hidshow2'+c).hide();
	}
	
 </script>


 <div class="wrapper">
 

<form name="myForm" action=""  method="">
  <body onload="populateanimals();">
 




<table><tr>

<tr><td style="width:22%"> 
 
 

</select></td></tr><tr><td rowspan="2" valign="top">
<fieldset>
<legend class="legendclass">Incident Information</legend>
<div><table><td>
 <tr><td><b class="test1">Pending&nbsp;Cases</b></td><td></td><td><input type="text" class="testa" name="pendingcases" id="pendingcases" readonly
  value=<?php echo $row12["count"]; ?>  ></td></tr>
<tr>
<td><b class="test1">Call&nbsp;ID </b></td><td></td>
<td><input type="text" class="testa" name="calid" id = "calid" readonly value="<?php echo $row["callid"]; ?>" ></td>
</tr>
<tr>
<td><b class="test1">Call&nbsp;Time</b></td><td></td>
<td><input type="text" class="testa" name="caltime" id = "caltime" readonly  value="<?php echo $row["call_time"]; ?>"  ></td>
</tr>
  <tr><td><b class="test1"> Original&nbsp;Call&nbsp;ID</b></td><td></td><td><input type="text" class="testa" name="originalcallid" id="originalcallid"    /></td></tr>
  <tr><td><b class="test1">Caller&nbsp;name</b></td><td></td><td>
<input type ="text" class="testa" name="callername" id="callername" readonly  value="<?php echo $row["caller_name"];?>"  ></td>
</tr> 
  <tr><td><b class="test1">Phone&nbsp;no</b></td><td></td><td>
<input type ="text" class="testa" name="phonenumber" id="phonenumber" readonly  value="<?php echo $row["phone_number"];?>"   ></td>
</tr> 

 <tr><td><b class="test1">House&nbsp;no</b></td><td></td><td>
 
<input type ="text" class="testa" name="houseno" id="houseno" readonly  value="<?php echo $row["house_no"];?>" ></td>
</tr>
 <tr><td><b class="test1">Street</b></td><td></td><td>
<input type ="text" class="testa" name="street" id="street" readonly  value="<?php echo $row["street"];?>" ></td>
</tr>
 <tr><td><b class="test1">locality</b></td><td></td><td>
<input type ="text" class="testa" name="locality" id="locality" readonly  value="<?php echo $row["locality"];?>" ></td>
</tr>
 <tr><td><b class="test1">road</b></td><td></td><td>
<input type ="text" class="testa" name="road" id="road" readonly  value="<?php echo $row["road"];?>" ></td>
</tr>
 <tr><td><b class="test1">Land&nbsp;Mark</b></td><td></td><td>
<input type ="text" class="testa" name="landmark" id ="landmark" readonly  value="<?php echo $row["landmark"];?>" ></td>
</tr>
  <tr><td><b class="test1">District</b></td><td></td><td>
<input type ="text" class="testa" name="district" id="district" readonly  value="<?php echo $row["district_name"];?>" ></td>
</tr> 
 <tr><td><b class="test1">Mandal</b></td><td></td><td>
<input type ="text" class="testa" name="mandal" id="mandal" readonly  value="<?php echo $row["mandal_name"];?>" ></td>
</tr> 
 <tr><td><b class="test1">City</b></td><td></td><td>
<input type ="text" class="testa" name="city" id="city" readonly  value="<?php echo $row["city_name"];?>" ></td>
</tr> 
 <tr><td><b class="test1">Emergency&nbsp;name</b></td><td></td><td>
<input type ="text" class="testa" name="emergencyname" id="emergencyname" readonly  value="<?php echo $row["emergencyname"];?>" ></td>
</tr>
<tr><td><b class="test1">CallType&nbsp;Name</b></td><td></td><td>
<input type ="text" class="testa" name="calltypename" id ="calltypename"  readonly value="<?php echo $row["call_type_name"];?>" ></td>
</tr> 
<tr><td><b class="test1">Complaint&nbsp;Name</b></td><td></td><td>
<input type ="text" class="testa" name="complaintname" id="complaintname" readonly value="<?php echo $row["complaintname"];?>" ></td>
</tr> 

  <tr><td><b class="test1">Animal&nbsp;Name</b></td><td></td><td>
<input type ="text" class="testa" name="animalname" id="animalname" readonly  value="<?php echo $row["animalname"];?>" ></td>
</tr> 
  <tr><td><b class="test1">Risk&nbsp;Level</b></td><td></td><td>
<input type ="text" class="testa" name="risklevel" id="risklevel" readonly  value="<?php echo $row["risklevel"];?>" ></td>
</tr> 

</table></td></div></fieldset>
<td><fieldset class="fieldset2 scrolldata">
<legend class="legendclass">Questtionare</legend><table><tr>
<td colspan = 3>
<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>1)  Ambulance Reached on time on that day?</b></td>
		</tr>
		<tr>
			<td>
				<select id="amb_quest" class="form-control" onchange="return abcd(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>		
			<td class="hidshow" style="display:none">Ambulance Reach time in minutes?</td>
			<td class="hidshow" style="display:none">
			<select id="amb_reach_time" class="form-control" >
				<option value=''>Select</option>
				<option value='5 Minutes'>5 Minutes</option>
				<option value='10 Minutes'>10 Minutes</option>
				<option value='15 Minutes'>15 Minutes</option>			
				<option value='20 Minutes'>20 Minutes</option>
				<option value='More Than 20 Minutes'>More Than 20 Minutes</option> 
			</select>
			</td> 
			<td class="hidshow1" style="display:none">Not Availed Reasons</td>
			<td class="hidshow1" style="display:none">
				<select id="amb_not_reach_time" class="form-control" >
					<option value=''>Select</option>
					<option value='Vehicle or Ambulance service not required'>Vehicle or Ambulance service not required</option>
					<option value='Vehicle busy'>Vehicle busy</option>
					<option value='Vehicle breakdown'>Vehicle breakdown</option>	 
					<option value='Chosen another means of transport to shift the victim'>Chosen another means of transport to shift the victim</option> 
				</select>
			</td> 
		</tr>
		
 
		 
	</table>
	</fieldset>
</form> 
</div>
</div>

<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
		<input type ="hidden" value='<?php echo $id;?>' id="callid" />
			<td ><b>2)	Police attended the incident location in time?</b></td>
		</tr>
		<tr>
			<td>
				<select id="qtn" class="form-control" onchange="return abcd(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>		
			<td class="hidshow2" style="display:none">Police Reach time in minutes?</td>
			<td class="hidshow2" style="display:none">
			<select id="atn1" class="form-control" >
				<option value=''>Select</option>
				<option value='5 Minutes'>5 Minutes</option>
				<option value='10 Minutes'>10 Minutes</option>
				<option value='15 Minutes'>15 Minutes</option>			
				<option value='20 Minutes'>20 Minutes</option>
				<option value='More Than 20 Minutes'>More Than 20 Minutes</option> 
			</select>
			</td> 
			<td class="hidshow3" style="display:none">Police Not Reached?</td>
			<td class="hidshow3" style="display:none">
				<select id="atn2" class="form-control" >
					<option value=''>Select</option>
					<option value='Vehicle or Ambulance service not required'>Vehicle or Ambulance service not required</option>
					<option value='Vehicle busy'>Vehicle busy</option>
					<option value='Vehicle breakdown'>Vehicle breakdown</option>	 
					<option value='Chosen another means of transport to shift the victim'>Chosen another means of transport to shift the victim</option> 
				</select>
			</td> 
		</tr>
		
 
		 
	</table>
	</fieldset>
</form> 
</div>

<div class="col-md-12" style=""> 
 
<div class="form-group">
<fieldset> 
 
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>3) How you are feeling now?</b></td>
		</tr>
		<tr>
			<td>
				<select id="ques_3" class="form-control" onchange="return abcd(this.value);" >
					<option value=''>Select</option>
					<option value='Still with Suicidal Ideations'>Still with Suicidal Ideations</option>
					<option value='In Recovery state and feeling well'>In Recovery state and feeling well</option> 
				</select>
			</td>	
<tr>
			<td class="hidshow4" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;Provided Psychological counselling at SPHL</td>
			<td class="hidshow4" style="display:none"><select id="psychiatry_sphl" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,1);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow5" style="display:none"><input class="form-control" type="text" id="referral_sphl"  /> 
			<input class="form-control" type="text" id="contact_sphl" /></td>
 
  
</tr>
<tr>
			<td class="hidshow6" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to Psychiatry Consultation</td>
			<td class="hidshow6" style="display:none"><select id="provided_psychiatry" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,2);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow7" style="display:none"><input class="form-control" type="text" id="referral_psychiartist"  /> 
			<input class="form-control" type="text" id="contact_psychiartist" /></td>
 
  
</tr>
<tr>
			<td class="hidshow8" style="display:none"><input type="checkbox" name="cities" id="chk_ngo" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to NGO’s for support</td>
			<td class="hidshow8" style="display:none"><select id="referred_ngo" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,3);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow9" style="display:none"><input class="form-control" type="text" id="referral_ngo"  /> 
			<input class="form-control" type="text" id="contact_ngo" /></td>
 
  
</tr>
<tr>
			<td class="hidshow10" style="display:none"><input type="checkbox" name="cities" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to Doctor Consultation for further Medical assistance</td>
			<td class="hidshow10" style="display:none"><select id="doctor_consult" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,4);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow11" style="display:none"><input class="form-control" type="text" id="referral_doctor"  /> 
			<input class="form-control" type="text" id="contact_doctor" /></td>
 
  
</tr>		
		
 
		 
	</table>
	</fieldset>
</form> 
</div>
</div>

<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 
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
 
 			<td class="hidshow34" style="display:none">Relation <select id="relation" class="form-control" >
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
			<td class="hidshow35" style="display:none">Reasons</td><td class="hidshow37" style="display:none"><select id="reason" class="form-control" >
			<option value=''>Select</option>
			<option value='1'>Financial issues</option>
			<option value='2'>Psychiatric illness</option>
			<option value='3'>Medical Illness</option>			
			<option value='4'>Love Failures</option>
			<option value='5'>Fear of Failure</option>
			<option value='6'>Conflicts with family relations</option> 
			</select> 
			<td class="hidshow36" style="display:none">
			<button type="button" id="btnsave" onclick = 'return savesuicidequestion();'>Save</button></td>
			</td> 
			
			<div class="datagrid" id="datagrid" >
			</div> </tr>	
		
 
		 
	</table>
	</fieldset>
</form> 

</div>
</div>

<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 	
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>5)  Still do you/Victim feel depressed or hopelessness?</b></td>
		</tr>
		<tr>
			<td>
				<select id="qtn_5" class="form-control" onchange="return abcd(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>	
<tr>
			<td class="hidshow14" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;Provided Psychological counselling at SPHL</td>
			<td class="hidshow14" style="display:none"><select id="provided_sphl_5" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,1);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow15" style="display:none"><input class="form-control" type="text" id="referral_psychiatry_5"  /> 
			<input class="form-control" type="text" id="contact_psychiatry_5" /></td>
 
  
</tr>
<tr>
			<td class="hidshow16" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to Psychiatry Consultation</td>
			<td class="hidshow16" style="display:none"><select id="provided_psychiatry_5" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,2);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow17" style="display:none"><input class="form-control" type="text" id="referral_psychiartist_5"  /> 
			<input class="form-control" type="text" id="contact_psychiartist_5" /></td>
 
  
</tr>
<tr>
			<td class="hidshow18" style="display:none"><input type="checkbox" name="cities" id="chk_ngo" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to NGO’s for support</td>
			<td class="hidshow18" style="display:none"><select id="referred_ngo_5" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,3);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow19" style="display:none"><input class="form-control" type="text" id="referral_ngo_5"  /> 
			<input class="form-control" type="text" id="contact_ngo_5" /></td>
 
  
</tr>
<tr>
			<td class="hidshow20" style="display:none"><input type="checkbox" name="cities" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to Doctor Consultation for further Medical assistance</td>
			<td class="hidshow20" style="display:none"><select id="doctor_consult_5" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,4);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow21" style="display:none"><input class="form-control" type="text" id="referral_doctor_5"  /> 
			<input class="form-control" type="text" id="contact_doctor_5" /></td>
 
  
</tr>		
		
 
		 
	</table>
	</fieldset>
</form> 
</div>
</div>


<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 	
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td><b>6) Do you need any support or service (to refer to agencies or peers)?</b></td>
		</tr>
		<tr>
			<td>
				<select id="qtn_6" class="form-control" onchange="return abcd(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>	
<tr>
			<td class="hidshow22" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;a.	Psychiatry Consultation / Counselling</td>
			<td class="hidshow22" style="display:none"><select id="provided_psychiatry_6" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,1);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow23" style="display:none"><input class="form-control" type="text" id="referral_psychiatry_6"  /> 
			<input class="form-control" type="text" id="contact_psychiatry_6" /></td>
 
  
</tr>
<tr>
			<td class="hidshow24" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;b.	NGO’s Support</td>
			<td class="hidshow24" style="display:none"><select id="provided_ngo_6" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,2);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow25" style="display:none"><input class="form-control" type="text" id="referral_psychiartist_6"  /> 
			<input class="form-control" type="text" id="contact_psychiartist_6" /></td>
 
  
</tr>
<tr>
			<td class="hidshow26" style="display:none"><input type="checkbox"  id="chk_ngo" value="Yes" />&nbsp;&nbsp;&nbsp;c.	Lively Hood Support</td>
			<td class="hidshow26" style="display:none"><select id="referred_lively_hood" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,3);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow27" style="display:none"><input class="form-control" type="text" id="referral_lively_hood"  /> 
			<input class="form-control" type="text" id="contact_lively_hood" /></td>
 
  
</tr>
<tr>
			<td class="hidshow28" style="display:none"><input type="checkbox" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;d.	Legal Counselling / Support</td>
			<td class="hidshow29" style="display:none"><select id="legal_counselling_6" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,4);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow30" style="display:none"><input class="form-control" type="text" id="referral_legal_counselling_6"  /> 
			<input class="form-control" type="text" id="contact_legal_counselling_6" /></td>
 
  
</tr>		
<tr>
			<td class="hidshow31" style="display:none"><input type="checkbox" name="cities" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;e.	Any Medications / Doctor Consultation</td>
			<td class="hidshow31" style="display:none"><select id="any_medication_6" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,5);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow32" style="display:none"><input class="form-control" type="text" id="referral_mediaction_6"  /> 
			<input class="form-control" type="text" id="contact_medication_6" /></td>
 
  
</tr>		
 
	</table>
	</fieldset>
</form> 
</div>
</div>


<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>7)	Are you/ Victim willing to take follow up counselling in future?</b></td>
		</tr>
 <tr>
			<td>
				<select id="qtn_7" class="form-control" onchange="return abcd(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>
  			<td class="hidshow33" style="display:none"><input class="form-control datepicker" type="text" id="referral_doctor"  /> 
			</td>
</tr>
		
 
	</table>
	</fieldset>
</form> 
</div>

</div>

 </td>
</tr>
<tr>

</tr>
 
</table></fieldset></td>

</tr>

 <tr>
    <td colspan =3>
	<div id="divvictimhide">
 
	
 
 
 
  <div id="light" class="white_content">  <a style="float:right" href="javascript:void(0)" onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
	<br>
	<div id="DrugContent"></div>
  
  </div>
  <div id="fade" class="black_overlay"></div>


<style>
  /* The alert message box */
.alert { top:0px;
padding: 20px;
background-color: #f44336; /* Red */
color: white;
font-size:20;
position:fixed; display:none;
width:87%;
margin-bottom: 10px;
}

/* The close button */
.closebtn {
margin-left: 15px;
color: white;
font-weight: bold;
float: right;
font-size: 22px;
line-height: 20px;
cursor: pointer;
transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
color: black;
}

.black_overlay {
  display: none;
  position: absolute;
  top: 0%;
  left: 0%;
  width: 100%;
  height: 160%;
  background-color: black;
  z-index: 1001;
  -moz-opacity: 0.8;
  opacity: .80;
  filter: alpha(opacity=80);
}
.white_content {
  display: none;
  position: absolute;
  top: 25%;
  left: 15%;
  width: 70%;
  height: 50%;
  padding: 16px;
  border: 3px solid orange;
  background-color: white;
  z-index: 1002;
  overflow: auto;
}

.scrolldata
{
font: normal 12px/150% Arial, Helvetica, sans-serif;
background: #fff;
overflow: hidden;
border: 1px solid #3A7999;
border-radius: 10px;
overflow: scroll;
height: 514px;
}

</style>










