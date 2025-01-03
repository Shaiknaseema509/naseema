<?php 
require_once("dbconnect_emri.php");  
$call_id = $_REQUEST['id']; 
 session_start();
//echo '<pre>'; print_r($_REQUEST);

$agentID=$_REQUEST["agent_id"];
$Queue=$_SESSION["Queue"];
$call_hit_referenceno=$_SESSION["call_hit_referenceno"];
$convoxID= $_SESSION["convoxID"]; 

$followup_numb = mysql_query("select * from `followup_save_details` where callid = '".$call_id."'");
$result = mysql_num_rows($followup_numb);
if ($result>0) 
{
$followp_details_query = "INSERT INTO `followup_save_details_2` (`callid`, `followup_datetime`, `agent_id`,followup_no)
VALUES ('".$call_id."', NOW(),'".$agentID."',1)";

mysql_query($followp_details_query);
}
else
{
$followp_details_query = "INSERT INTO `followup_save_details` (`callid`, `followup_datetime`, `agent_id`,followup_no)
VALUES ('".$call_id."', NOW(),'".$agentID."',1)";

mysql_query($followp_details_query);
} 


$co_details_query= mysql_query("SELECT caller_id,phone_number,`patient_name`,`caller_name`,`alternate_number`,`age`,`gender_name`,`district_id`,
`district_name`,`mandal_id`,`mandal_name`,
`village_id`,`village_name`,`location`,
mc.`category_name`,ms.`sub_category_name`, mr.`risk_level_name`, cid.`referrals_concerned_name`,
fl.`followup_id`, wf.welfare_remarks,cid.co_remarks,fl.followup_name,fs.next_follow_up_date
FROM `call_incident_info_details_suicide` cid
LEFT JOIN `welfare_call_details_suicide` wf ON wf.callid = cid.caller_id
JOIN `m_category` mc ON mc.`category_id` = cid.`category_id`
LEFT JOIN `m_sub_category` ms ON ms.`sub_category_id` = cid.`sub_category_id`
LEFT JOIN `m_risk_level` mr ON mr.`risk_level_id` = cid.`risk_level_id` 
LEFT JOIN `followup_save_details` fs ON fs.`callid` = cid.caller_id
left join `followup_levels` fl on fl.`followup_id` = fs.`followup_no`
WHERE `caller_id` = '".$call_id."'"); 



$co_Details = mysql_fetch_array($co_details_query);



$my	= "INSERT INTO `incident_timings_suicide` (`caller_id`,`agent_id`,`pop_up_time`,`level`,`type`)
	   VALUES ('".$call_id."','".$agent_id."',NOW(),'Followup','ON_POPUP')";
	   
	mysql_query($my);

 
  ?> 

<html>
<head>
<title> </title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/StyleSheets.css" type="text/css">
<link rel="stylesheet" href="css/jquery-ui-timepicker-addon.css" type="text/css">
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css"> 
 			<script src="js/bootstrap-datetimepicker.js"></script>
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />

  	  <script src="js/jquery-1.10.2.min.js"></script> 
		
<script src="scripts/main_validation.js">

</script>  
		  	 <script type="text/javascript">
  $( function() {
    $( ".datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
  } );
  </script>
 
  <script type="text/javascript">
  
   $(document).ready(function() {
	 
	$('body').on('click','#call_not_answered',function()
{  
	if ($("#call_not_answered").is(':checked')) 
	{ 
	$('#btnterminate').show();

	}
	else
	{
	$('#btnterminate').hide();

	}	   
});

});


  </script>

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
			$('.hidshow22').show();
		else
			$('.hidshow22').hide();
	}
	
	function abcd8(b,c)
	{ 
		if(b == 'Yes')
			$('.hidshow9'+c).show();
		else
			$('.hidshow9'+c).hide();
	}
	
	function abcd9(a)
	{
		if(a == 'Yes')
			$('.hidshow33').show();
		else
			$('.hidshow33').hide();
	}
	
	
	$("#chk_doctor").change(function() {
    if(this.checked) {
	$.post("getdatevehicle.php",{"source":"GETTIME"}, function(return_data){
	$('#referral_doctor').val(return_data);
	});
      
    }
	else
	{
		$('#referral_doctor').val('');
	}
});

/*function populateanimals()
{
	if($('#followup_level').val() == 'First Followup')
{
		$('#questions1').show();
		$('#questions2').hide();
}
else
{
		$('#questions2').show();
		$('#questions1').hide();	
}
}
*/

 </script>


 <div class="wrapper">
 

<form name="myForm" action=""  method="">
  <body onload="populateanimals();">
 




<table><tr>

<tr><td style="width:22%"> 
 
 

</select></td></tr><tr><td rowspan="4" valign="top">
<fieldset>
<legend class="legendclass">Incident Information</legend>
<div><table><td>
 
<tr>
<td><b class="test1">Call&nbsp;ID </b></td>
<td><input type="text" class="testa" name="calid" id = "calid" readonly value="<?php echo $co_Details['caller_id'];?>" ></td>
</tr>
<tr>
<td> Caller Number</td>
<td><input class="form-control" type="text" id="callerno" value="<?php echo $co_Details['phone_number'];?>" onkeypress="return isNumberKey(event)" /></td>			
			
</tr>
<tr><td>Patient Name</td>
<td><input class="form-control" type="text" id="patient_name" value="<?php echo $co_Details['patient_name'];?>" /></td></tr>
<tr><td>Caller Name</td>
<td><input class="form-control" type="text" id="caller_name" value="<?php echo $co_Details['caller_name'];?>" /></td>
</tr> 
<tr><td>Alternate Number</td>
<td><input class="form-control" type="text" id="alt_no" value="<?php echo $co_Details['alternate_number'];?>" onkeypress="return isNumberKey(event)" /></td>
</tr> 
<tr><td>Age</td>
<td><input class="form-control" type="text" id="age" value="<?php echo $co_Details['age'];?>" /></td>
</tr>
 <tr><td> Gender</td>
			<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['gender_name'];?>" /></td>
</tr>
 <tr><td> District</td>
			<td><input class="form-control" type="text" id="District" value="<?php echo $co_Details['district_name'];?>" /></td>	
</tr>
 <tr><td> Taluka</td>
			<td><input class="form-control" type="text" id="tehsil1" value="<?php echo $co_Details['mandal_name'];?>" /></td>
</tr>
<tr><td> Village</td>
<td><input class="form-control" type="text" id="city_name1" value="<?php echo $co_Details['village_name'];?>" /></td>
</tr>
<tr><td> Location/Landmark</td>
<td><input class="form-control" type="text" id="location" value="<?php echo $co_Details['location'];?>" /></td>
</tr> 
<tr><td>Call Type</td>
<td><input class="form-control" type="text" id="gender" value="Suicide" /></td>	
</tr> 
<tr><td> Category </td>
<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['category_name'];?>" /></td>	
</tr> 
<tr><td>Sub Category</td>
<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['sub_category_name'];?>" /></td>
</tr>
<tr><td>Risk Level</td>
<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['risk_level_name'];?>" /></td>
</tr> 
<tr><td>Referral Concerned</td>
<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['referrals_concerned_name'];?>" /></td>
</tr>  
<tr><td>Counsellor Remarks</td>
<td><input class="form-control" type="text" id="co_remarks" value="<?php echo $co_Details['co_remarks'];?>"  style="width: 253px; height: 79px;" /></td>
</tr> 
<tr><td>Welfare Remarks</td>
<td><input class="form-control" type="text" id="welfare_remarks" value="<?php echo $co_Details['welfare_remarks'];?>"  style="width: 253px; height: 79px;" /></td>	
</tr> 

</table></td></div></fieldset></td>
 
<td>Followup Level 
<select class="form-control" id="followup_level" name="followup_level" >  
<option value=''> Select Followup</option>
				<?php
				$followup_query	= "SELECT * FROM `followup_levels`";
				$followup_result= mysql_query($followup_query);
				while($followup_details = mysql_fetch_array($followup_result))
				 {
					 
					$SEL = ($co_Details['followup_name'])?"selected":"";
					echo  ($followup_details['followup_name'])?"<option value='".$followup_details['followup_id']."~".$followup_details['followup_name']."'$SEL>".$followup_details['followup_name']."</option>":"<option value=''>--Pickup Followup--</option>";
				 }
				?>	
			</select>
			
<input type="checkbox" name="ccsradio"  id="call_not_answered" value = "2" /><b class="radio" />Call&nbsp;Not&nbsp;Answered
<select class="form-control" id="notanswered" name="notanswered" onchange='GetRegions(this.value,"9");'>  
				<option value=''> Select Reasons</option>  
				<?php $query = mysql_query("select * from `m_not_answered_reasons` where is_active = 1 or is_active = 2");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['reason_id'];?>'><?php echo $db['reason_name'];?></option>
				<?php }?> 
			</select>
<button type="button" id = "btnterminate" class="btn btn-large btn-danger" onclick="notanswereddet();" style='display:none;' >Terminate</button>

	<div class="loadPage" id="loadPage">
		<?php $callid=$co_Details['caller_id']; if($co_Details['followup_name'] == 'First Followup')include('f1.php');
		else include('f2.php');?> 
	</div>
 

</div> 
</td>

</tr>

 
<script type="text/javascript">
 function saveLoad(a) 
	 { 		
var xmlHttp=newHttpObject();
		if(xmlHttp)
		 {	 

				  var caller_id = document.getElementById('calid').value; 			   
				   var ques_3 = document.getElementById('ques_3').value;  
				   var psychiatry_sphl = document.getElementById('psychiatry_sphl').value; 
				   var provided_psychiatry = document.getElementById('provided_psychiatry').value;
				   var referred_ngo = document.getElementById('referred_ngo').value;	
				   var referral_sphl = document.getElementById('referral_sphl').value;
				   var contact_sphl = document.getElementById('contact_sphl').value;
				   var referral_psychiartist = document.getElementById('referral_psychiartist').value;
				   var contact_psychiartist = document.getElementById('contact_psychiartist').value;
				   var referral_ngo = document.getElementById('referral_ngo').value;
				   var contact_ngo = document.getElementById('contact_ngo').value;
				   var referral_doctor = document.getElementById('referral_doctor').value;
				   var contact_doctor = document.getElementById('contact_doctor').value;				   
				   var doctor_consult = document.getElementById('doctor_consult').value;
				   var qtn_5 = document.getElementById('qtn_5').value;  
				   var provided_sphl_5 = document.getElementById('provided_sphl_5').value; 
				   var referral_psychiatry_5 = document.getElementById('referral_psychiatry_5').value;
				   var contact_psychiatry_5 = document.getElementById('contact_psychiatry_5').value;	
				   var provided_psychiatry_5 = document.getElementById('provided_psychiatry_5').value;
				   var referral_psychiartist_5 = document.getElementById('referral_psychiartist_5').value;
				   var contact_psychiartist_5 = document.getElementById('contact_psychiartist_5').value;
				   var referred_ngo_5 = document.getElementById('referred_ngo_5').value;
				   var referral_ngo_5 = document.getElementById('referral_ngo_5').value;
				   var contact_ngo_5 = document.getElementById('contact_ngo_5').value;
				   var doctor_consult_5 = document.getElementById('doctor_consult_5').value;
				   var referral_doctor_5 = document.getElementById('referral_doctor_5').value;				   
				   var contact_doctor_5 = document.getElementById('contact_doctor_5').value;
				   var qtn_6 = document.getElementById('qtn_6').value;  
				   var provided_psychiatry_6 = document.getElementById('provided_psychiatry_6').value; 
				   var referral_psychiatry_6 = document.getElementById('referral_psychiatry_6').value;
				   var contact_psychiatry_6 = document.getElementById('contact_psychiatry_6').value;	
				   var provided_ngo_6 = document.getElementById('provided_ngo_6').value;
				   var referral_psychiartist_6 = document.getElementById('referral_psychiartist_6').value;
				   var contact_psychiartist_6 = document.getElementById('contact_psychiartist_6').value;
				   var referred_lively_hood = document.getElementById('referred_lively_hood').value;
				   var contact_lively_hood = document.getElementById('contact_lively_hood').value;
				   var legal_counselling_6 = document.getElementById('legal_counselling_6').value;
				   var referral_legal_counselling_6 = document.getElementById('referral_legal_counselling_6').value;
				   var contact_legal_counselling_6 = document.getElementById('contact_legal_counselling_6').value;	
				   var referral_mediaction_6 = document.getElementById('referral_mediaction_6').value;
				   var contact_medication_6 = document.getElementById('contact_medication_6').value;					   
				   var any_medication_6 = document.getElementById('any_medication_6').value;
				   var qtn_7 = document.getElementById('qtn_7').value;  
				   var followupdatetime = document.getElementById('referral_doctor').value; 
				   
				  if(a == 1)
				   { 
			      var amb_quest = document.getElementById('amb_quest').value;  
				  var amb_reach_time = document.getElementById('amb_reach_time').value; 
				  var amb_not_reach_time = document.getElementById('amb_not_reach_time').value;
				  var followup_level = document.getElementById('followup_level').value; 
				  var question = document.getElementById('qtn').value;  
				  var atn1 = document.getElementById('atn1').value; 
				  var atn2 = document.getElementById('atn2').value;						  
					if(amb_quest == "")
						{
							alert("Please select the Fields..");
							return false;
						}
						else if(amb_quest == "Yes")
						{
							if(amb_reach_time == "")
							{
								alert("Fields Should not be empty..");
								return false;
							}
						
						} 
						else if(amb_quest == "No")
						{
							if(amb_not_reach_time == "")
							{
								alert("Fields Should not be empty..");
								return false;
							}
						
						}
						
						if(question == "")
						{
							alert("Please select the Fields..");
							return false;
						}
						else if(question == "Yes")
						{ 
							if(atn1 == "")
							{
								alert("Fields Should not be empty..");
								return false;
							}
						
						}
						else if(question == "No")
						{ 
							if(atn2 == "")
							{
								alert("Fields Should not be empty..");
								return false;
							}
						
						} 	
				   }
			 
				   
					if(ques_3 == "")
						{
							alert("Please select the Fields..");
							return false;
						}
						else if(ques_3 == "Still with Suicidal Ideations")
						{ 
							if(psychiatry_sphl == "" || provided_psychiatry == "" || referred_ngo == "" || doctor_consult == "")
							{ 
								alert("Fields Should not be empty..");
								return false;
							}
							
							if(psychiatry_sphl == "Yes")
							{

							if(referral_sphl == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_sphl').focus();
								return false;
							  } 
							  if(contact_sphl == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_sphl').focus();
								return false;
							  }
													
							}
							if(provided_psychiatry == "Yes")
							{

							if(referral_psychiartist == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_psychiartist').focus();
								return false;
							  } 
							  if(contact_psychiartist == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_psychiartist').focus();
								return false;
							  }
													
							}
							if(referred_ngo == "Yes")
							{

							if(referral_ngo == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_ngo').focus();
								return false;
							  } 
							  if(contact_ngo == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_ngo').focus();
								return false;
							  }
													
							}
							if(doctor_consult == "Yes")
							{

							if(referral_doctor == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_doctor').focus();
								return false;
							  } 
							  if(contact_doctor == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_doctor').focus();
								return false;
							  }
													
							}							
						} 
				 		
							if(qtn_5 == "")
						{
							alert("Please select the Fields..");
							return false;
						}
						else if(qtn_5 == "Yes")
						{ 
							if(provided_sphl_5 == "" || provided_psychiatry_5 == "" || referred_ngo_5 == "" || doctor_consult_5 == "")
							{ 
								alert("Fields Should not be empty..");
								return false;
							}
							
							if(provided_sphl_5 == "Yes")
							{

							if(referral_psychiatry_5 == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_psychiatry_5').focus();
								return false;
							  } 
							  if(contact_psychiatry_5 == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_psychiatry_5').focus();
								return false;
							  }
													
							}
							if(provided_psychiatry_5 == "Yes")
							{

							if(referral_psychiartist_5 == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_psychiartist_5').focus();
								return false;
							  } 
							  if(contact_psychiartist_5 == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_psychiartist_5').focus();
								return false;
							  }
													
							}
							if(referred_ngo_5 == "Yes")
							{

							if(referral_ngo_5 == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_ngo_5').focus();
								return false;
							  } 
							  if(contact_ngo_5 == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_ngo_5').focus();
								return false;
							  }
													
							}
							if(doctor_consult_5 == "Yes")
							{

							if(referral_doctor_5 == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_doctor_5').focus();
								return false;
							  } 
							  if(contact_doctor_5 == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_doctor_5').focus();
								return false;
							  }
													
							}							
						}	
						
						if(qtn_5 == "")
						{
							alert("Please select the Fields..");
							return false;
						}
						else if(qtn_5 == "Yes")
						{ 
							if(provided_psychiatry_6 == "" || provided_ngo_6 == "" || referred_lively_hood == "" || legal_counselling_6 == "" || any_medication_6 == "")
							{ 
								alert("Fields Should not be empty..");
								return false;
							}
							
							if(provided_psychiatry_6 == "Yes")
							{

							if(referral_psychiatry_6 == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_psychiatry_6').focus();
								return false;
							  } 
							  if(contact_psychiatry_6 == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_psychiatry_6').focus();
								return false;
							  }
													
							}
							if(provided_ngo_6 == "Yes")
							{

							if(referral_psychiartist_6 == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_psychiartist_6').focus();
								return false;
							  } 
							  if(contact_psychiartist_6 == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_psychiartist_6').focus();
								return false;
							  }
													
							}
							if(legal_counselling_6 == "Yes")
							{

							if(referral_legal_counselling_6 == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_legal_counselling_6').focus();
								return false;
							  } 
							  if(contact_legal_counselling_6 == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_legal_counselling_6').focus();
								return false;
							  }
													
							}
							if(referred_lively_hood == "Yes")
							{

							if(referral_lively_hood == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_lively_hood').focus();
								return false;
							  } 
							  if(contact_lively_hood == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_lively_hood').focus();
								return false;
							  }
													
							}							
							if(any_medication_6 == "Yes")
							{

							if(referral_mediaction_6 == "")	
							  {
								alert("Enter Referral Name");
								document.getElementById('referral_mediaction_6').focus();
								return false;
							  } 
							  if(contact_medication_6 == "")	
							  {
								alert("Enter Contact Number");
								document.getElementById('contact_medication_6').focus();
								return false;
							  }
													
							}

						}	 
					
						if(qtn_7 == "")
						{
							alert("Please select the Fields..");
							return false;
						}					
						if(qtn_7 == "Yes")
						{
 							if(followupdatetime == "")
							{
							alert("Please select the Fields..");
							document.getElementById('followupdatetime').focus();
 							return false;
							}
						}
	
 
 
	 	var	callQuery = "callid="+caller_id+"&amb_quest="+amb_quest+"&amb_reach_time="+amb_reach_time+"&amb_not_reach_time="+amb_not_reach_time+"&followup_level="+followup_level+"&question="+question+"&atn1="+atn1+"&atn2="+atn2+"&ques_3="+ques_3+"&psychiatry_sphl="+psychiatry_sphl+"&provided_psychiatry="+provided_psychiatry+"&referred_ngo="+referred_ngo+"&referral_sphl="+referral_sphl+"&contact_sphl="+contact_sphl+"&referral_psychiartist="+referral_psychiartist+"&contact_psychiartist="+contact_psychiartist+"&referral_ngo="+referral_ngo+"&contact_ngo="+contact_ngo+"&referral_doctor="+referral_doctor+"&contact_doctor="+contact_doctor+"&doctor_consult="+doctor_consult+"&qtn_5="+qtn_5+"&provided_sphl_5="+provided_sphl_5+"&referral_psychiatry_5="+referral_psychiatry_5+"&contact_psychiatry_5="+contact_psychiatry_5+"&provided_psychiatry_5="+provided_psychiatry_5+"&referral_psychiartist_5="+referral_psychiartist_5+"&contact_psychiartist_5="+contact_psychiartist_5+"&referred_ngo_5="+referred_ngo_5+"&referral_ngo_5="+referral_ngo_5+"&contact_ngo_5="+contact_ngo_5+"&doctor_consult_5="+doctor_consult_5+"&referral_doctor_5="+referral_doctor_5+"&contact_doctor_5="+contact_doctor_5+"&qtn_6="+qtn_6+"&provided_psychiatry_6="+provided_psychiatry_6+"&referral_psychiatry_6="+referral_psychiatry_6+"&contact_psychiatry_6="+contact_psychiatry_6+"&provided_ngo_6="+provided_ngo_6+"&referral_psychiartist_6="+referral_psychiartist_6+"&contact_psychiartist_6="+contact_psychiartist_6+"&referred_lively_hood="+referred_lively_hood+"&contact_lively_hood="+contact_lively_hood+"&legal_counselling_6="+legal_counselling_6+"&referral_legal_counselling_6="+referral_legal_counselling_6+"&contact_legal_counselling_6="+contact_legal_counselling_6+"&referral_mediaction_6="+referral_mediaction_6+"&contact_medication_6="+contact_medication_6+"&any_medication_6="+any_medication_6+"&qtn_7="+qtn_7+"&followupdatetime="+followupdatetime+"&agent_id="<?=$agentID;?>; 
		
 //var callQuery="type=SaveDetailsCounsellor&agent_id=<?=$agentID;?>&location="+location+"&caller_id="+caller_id+"&callerno="+callerno+"&patient_name="+patient_name+"&caller_name="+caller_name+"&alt_no="+alt_no+"&age="+age+"&gender="+gender+"&District="+District+"&tehsil1="+tehsil1+"&city_name1="+city_name1+"&location="+location+"&category="+category+"&subcategory="+subcategory+"&grievance="+grievance+"&risklevel="+risklevel+"&referralsconcerned="+referralsconcerned+"&co_remarks="+co_remarks;
																		
	//alert(callQuery);
		xmlHttp.open("POST","save_test.php",true);
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
						//$('#btngre').hide();
						return false;
					}
				}
		 }
		 }
		delete xmlHttp;			
	 }
	
</script>

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
height: 586px;
}

</style>










