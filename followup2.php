<?php 
require_once("dbconnect_emri.php");  
$call_id = $_REQUEST['id']; 
 session_start();
$agentID=$_REQUEST["agent_id"];
$Queue=$_SESSION["Queue"];
$call_hit_referenceno=$_SESSION["call_hit_referenceno"];
$convoxID= $_SESSION["convoxID"]; 

 
$co_details_query= mysql_query("SELECT caller_id,phone_number,`patient_name`,`caller_name`,`alternate_number`,`age`,`gender_name`,`district_id`,
`district_name`,`mandal_id`,`mandal_name`,
`village_id`,`village_name`,`location`,
mc.`category_name`,ms.`sub_category_name`, mr.`risk_level_name`, cid.`referrals_concerned_name`,
fl.`followup_id`, wf.welfare_remarks,cid.co_remarks
FROM `call_incident_info_details_suicide` cid
LEFT JOIN `welfare_call_details_suicide` wf ON wf.callid = cid.caller_id
JOIN `m_category` mc ON mc.`category_id` = cid.`category_id`
LEFT JOIN `m_sub_category` ms ON ms.`sub_category_id` = cid.`sub_category_id`
LEFT JOIN `m_risk_level` mr ON mr.`risk_level_id` = cid.`risk_level_id` 
JOIN `followup_levels` fl ON fl.`followup_id` = cid.`status` 
WHERE `caller_id` = '".$call_id."'"); 



$co_Details = mysql_fetch_array($co_details_query);

$followup_det = "SELECT * FROM `followup_save_details` WHERE callid = '".$call_id."';";

if($followup_det->num_rows == 0){
	
$followp_details_query = "INSERT INTO `followup_save_details` (`callid`, `followup_datetime`, `agent_id`)
VALUES ('".$call_id."', NOW(),'".$agent_id."')";

mysql_query($followp_details_query);

}

$my	= "INSERT INTO `incident_timings_suicide` (`caller_id`,`agent_id`,`pop_up_time`,`level`,`type`)
	   VALUES ('".$call_id."','".$agent_id."',NOW(),'Followup','ON_POPUP')";
	   
	mysql_query($my);



/*$co_details_query= mysql_query("SELECT caller_id,phone_number,`patient_name`,`caller_name`,`alternate_number`,`age`,`gender_name`,`district_id`,
`district_name`,`mandal_id`,`mandal_name`,
`village_id`,`village_name`,`location` 
FROM `call_incident_info_details_suicide` 
WHERE `caller_id` = '".$call_id."' AND phone_number = '".$phone_number."'");
$co_Details = mysql_fetch_array($co_details_query);
*/

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
<script src="scripts/main_validation.js"></script>
		  
	 <script type="text/javascript">
	 newHttpObject = function()
	{
		var xmlHttp=null;
		try	
		{
			// Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest();
		}
		catch(e)
		{
			// Internet Explorer
			try
			{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e)
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		return xmlHttp;
	}
 function saveLoad(a) 
	 {
		 
		var xmlHttp=newHttpObject();
        
		if(xmlHttp)
		 {    
				  var caller_id = document.getElementById('caller_id').value;
//alert(a);
var callQuery = "tabs="+a+"&callid="+caller_id;

			if(a == 2)
			 {

		 
					var amb_quest = document.getElementById('amb_quest').value;  
					var amb_reach_time = document.getElementById('amb_reach_time').value; 
					var amb_not_reach_time = document.getElementById('amb_not_reach_time').value;

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
					callQuery += "&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&amb_quest="+amb_quest+"&amb_reach_time="+amb_reach_time+"&amb_not_reach_time="+amb_not_reach_time; 
			 }
			 
			if(a == 3)
			 { 
					var question = document.getElementById('qtn').value;  
					var atn1 = document.getElementById('atn1').value; 
				    var atn2 = document.getElementById('atn2').value; 
					
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
				 					
 
				 callQuery += "&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&question="+question+"&atn1="+atn1+"&atn2="+atn2; 
			 }
			if(a == 4)
			 { 
   
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
				 							   
				   
				   callQuery += "&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&ques_3="+ques_3+"&psychiatry_sphl="+psychiatry_sphl+"&provided_psychiatry="+provided_psychiatry+"&referred_ngo="+referred_ngo+"&referral_sphl="+referral_sphl+"&contact_sphl="+contact_sphl+"&referral_psychiartist="+referral_psychiartist+"&contact_psychiartist="+contact_psychiartist+"&referral_ngo="+referral_ngo+"&contact_ngo="+contact_ngo+"&referral_doctor="+referral_doctor+"&contact_doctor="+contact_doctor+"&doctor_consult="+doctor_consult; 
			 }
 
			 if(a == 6)
			 {
   
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
				   
				   callQuery += "&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&qtn_5="+qtn_5+"&provided_sphl_5="+provided_sphl_5+"&referral_psychiatry_5="+referral_psychiatry_5+"&contact_psychiatry_5="+contact_psychiatry_5+"&provided_psychiatry_5="+provided_psychiatry_5+"&referral_psychiartist_5="+referral_psychiartist_5+"&contact_psychiartist_5="+contact_psychiartist_5+"&referred_ngo_5="+referred_ngo_5+"&referral_ngo_5="+referral_ngo_5+"&contact_ngo_5="+contact_ngo_5+"&doctor_consult_5="+doctor_consult_5+"&referral_doctor_5="+referral_doctor_5+"&contact_doctor_5="+contact_doctor_5; 
			 }
			 if(a == 7)
			 {
   
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

				   callQuery += "&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&qtn_6="+qtn_6+"&provided_psychiatry_6="+provided_psychiatry_6+"&referral_psychiatry_6="+referral_psychiatry_6+"&contact_psychiatry_6="+contact_psychiatry_6+"&provided_ngo_6="+provided_ngo_6+"&referral_psychiartist_6="+referral_psychiartist_6+"&contact_psychiartist_6="+contact_psychiartist_6+"&referred_lively_hood="+referred_lively_hood+"&contact_lively_hood="+contact_lively_hood+"&legal_counselling_6="+legal_counselling_6+"&referral_legal_counselling_6="+referral_legal_counselling_6+"&contact_legal_counselling_6="+contact_legal_counselling_6+"&referral_mediaction_6="+referral_mediaction_6+"&contact_medication_6="+contact_medication_6+"&any_medication_6="+any_medication_6; 
			 }
			 if(a == 8)
			 {
 				 
   
					var qtn_7 = document.getElementById('qtn_7').value;  
				    var followupdatetime = document.getElementById('referral_doctor').value; 
					
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
						
				 callQuery += "&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&qtn_7="+qtn_7+"&followupdatetime="+followupdatetime; 
				 			 
			 }
			 

			
			xmlHttp.open("POST","ajaxHtml.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText;
					 $('#loadPage').html(Response);
					 
					 if(a == 8)
					 {
					var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
					postURL(end_call_url,"false");	
					 }					
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	 
	}
	
	function back(a) 
	 { 
		var xmlHttp=newHttpObject(); 
		if(xmlHttp)
		 {  
			var callQuery = "tabs="+a;
			xmlHttp.open("POST","ajaxHtml.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText;
					 $('#loadPage').html(Response);
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	 
	 }
	
	
 
	function showAlert()
	 {
		$('.alert').show();
		$('.alert_content').html('Fields Should Not be empty');
		setTimeout(function(){$('.alert').hide();},10000); 
	 }	
	 
	function conCall()
{
	 
    openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php?vehicle_phone_number="+108,"Conference_Call","width=420,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");                            
    //openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php?callid="+callid+"&vehicle_phone_number="+vehicle_phone_number,"Conference_Call","width=380,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");
	return false;
}
	 
	 function isNumberKey(evt)
      {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
      } 
function GetRegions(ID,index)
	 { 
		var xmlHttp=newHttpObject();
        
		if(xmlHttp)
		 {
			if(index == 1)
			 {
				var callQuery = "action=Mandals&district_id="+ID;
			 }
			else if(index == 2)
			 {
				var callQuery = "action=Villages&mandal_id="+ID;
			 }
			 else if(index == 3)
			 {
				var callQuery = "action=areas&village_id="+ID;
			 }
			 else if(index == 5)
			 {
				var IDS = $('#tehsil1').val(); 
				var callQuery = "action=GetAgencyGre&area_id="+IDS;
			 }
			 else if(index == 6)
			 { 
				var ID2 = $('#category').val(); 
				var callQuery = "action=GetSubcategory&category_id="+ID2;
			 }
			 else if(index == 7)
			 { 
				var ID2 = $('#category').val(); 
				var callQuery = "action=GetGrevience&category_id="+ID2;
			 }
			 else if(index == 8)
			 { 
				var ID3 = $('#grievance').val(); 
				var ID4 = $('#referralsconcerned').val(); 
				var callQuery = "action=Getredressal&grievance_id="+ID3+"&referal_id="+ID4; 
			 } 
			 
			 else if(index == 9)
			 { 
				var ID2 = $('#risklevel').val(); 
				var callQuery = "action=Getreferral&risk_id="+ID2;
			 }
			 
			// alert(callQuery);
			xmlHttp.open("POST","get_suicide_details.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText;
					//alert(Response);
					if(index == 1)
					 {
						document.getElementById("tehsil1").innerHTML=Response;
						document.getElementById("city_name1").innerHTML="<option value=''>-- Pickup City/Village --</option>";
					 }
					else if(index == 2)
					 {
						document.getElementById("city_name1").innerHTML=Response;	
					 } 
					 else if(index == 6)
					 {
						document.getElementById("subcategory").innerHTML=Response;	
					 } 
					 else if(index == 7)
					 {
						document.getElementById("grievance").innerHTML=Response;	
					 } 					 
					 else if(index == 8)
					 {
						document.getElementById("redressal").innerHTML=Response;	
					 } 		
					 else if(index == 9)
					 {
						document.getElementById("referralsconcerned").innerHTML=Response;	
					 } 	
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 
function spoccontactName(NOS)
	{
		var str = NOS.split('~');
		$('#spoccontact').val(str[2]);
		$('#sEmail').val(str[3]);
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
 
function welfaredetails()
{	
var xmlHttp=newHttpObject();
		 var caller_id = document.getElementById('caller_id').value;
		   
		if(xmlHttp)
		 {
	var maritalstatus	= document.getElementById('maritalstatus').value;
	if(maritalstatus == "")	
	  { 
		showAlert();
		document.getElementById('maritalstatus').focus();
		return false;
	  }
	var education	= document.getElementById('education').value;
	if(education == "")	
	  {
		showAlert();
		document.getElementById('education').focus();
		return false;
	  }  
	 var occupation	= document.getElementById('occupation').value;
	if(occupation == "")	
	  {
		showAlert();
		document.getElementById('occupation').focus();
		return false;
	  }  
	  	 var economicstatus	= document.getElementById('economicstatus').value;
	if(economicstatus == "")	
	  {
		showAlert();
		document.getElementById('economicstatus').focus();
		return false;
	  }  
	 var supremarks	= document.getElementById('supremarks').value;
	if(supremarks == "")	
	  {
		showAlert();
		document.getElementById('supremarks').focus();
		return false;
	  } 
	  	  
		 
	  
	  var callQuery="type=SaveDetailswelfare&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&maritalstatus="+maritalstatus+"&education="+education+"&occupation="+occupation+"&economicstatus="+economicstatus+"&supremarks="+supremarks;
																		
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
	
}
</script>


<div class="col-md-12" style=""> 
	<form >
	  <div class="form-group">
                <fieldset> <legend>
                            <button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Suicide Prevention Help Line</button>
                           </legend>
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">

		 
		<tr>
			<td> Callid</td>
			<td><input class="form-control" type="text" id="caller_id" value="<?php echo $co_Details['caller_id'];?>" /></td>
			<td> Caller Number</td>
			<td><input class="form-control" type="text" id="callerno" value="<?php echo $co_Details['phone_number'];?>" onkeypress="return isNumberKey(event)" /></td>			
			<td> Patient Name</td>
			<td><input class="form-control" type="text" id="patient_name" value="<?php echo $co_Details['patient_name'];?>" /></td>
			<td> Caller Name</td>
			<td><input class="form-control" type="text" id="caller_name" value="<?php echo $co_Details['caller_name'];?>" /></td>

		</tr>
		<tr>
	<!--		 <td>Complaint Against</td>
			<td><input class="form-control" type="text" id="complaintagainst" /></td>		-->	

			<td> Alternate Number</td>
			<td><input class="form-control" type="text" id="alt_no" value="<?php echo $co_Details['alternate_number'];?>" onkeypress="return isNumberKey(event)" /></td>
			<td> Age</td>
			<td><input class="form-control" type="text" id="age" value="<?php echo $co_Details['age'];?>" /></td>
			<td> Gender</td>
			<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['gender_name'];?>" /></td>
		</tr>
		<tr>


		<!--	<td>District</td>
			<td><select id="District" class="form-control" onchange='GetRegions(this.value,"1");'>
			<option value=''>Select District</option>
				<?php
				$district_query	= "SELECT ds_dsid,districtname ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($co_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."' $SEL >".$district_details["ds_lname"]."</option>";
				 }
				?>	
			</select></td>	-->	
			<td> District</td>
			<td><input class="form-control" type="text" id="District" value="<?php echo $co_Details['district_name'];?>" /></td>			
			<!--<td>Taluka</td>
			<td><select id="tehsil1" class="form-control" onchange='GetRegions(this.value,"2");'>
						<option value=''>Select Taluka</option>
				<?php
				$district_query	= "SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid=".$co_Details['district_id']." ORDER BY md_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {  
					$SEL = ($co_Details['mandal_id'])?"selected":"";
					echo  ($district_details['md_mdid'])?"<option  value='".$district_details['md_mdid']."~".$district_details['md_lname']."'$SEL>".$district_details['md_lname']."</option>":"<option value=''>--Pickup Taluka--</option>";
				 }
				?>	
			</select></td>	-->
			<td> Taluka</td>
			<td><input class="form-control" type="text" id="tehsil1" value="<?php echo $co_Details['mandal_name'];?>" /></td>
		<!--	<td>Village</td>
			<td><select id="city_name1" class="form-control" onchange='GetRegions(this.value,"5");' >
			<option value=''>Select Village</option>
				<?php
				$district_query	= "SELECT ct_ctid,ct_lname FROM m_city WHERE ct_mdid=".$co_Details['mandal_id']." AND is_active=1 ORDER BY ct_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					 
					$SEL = ($co_Details['mandal_id'])?"selected":"";
					echo  ($district_details['ct_ctid'])?"<option  value='".$district_details['ct_ctid']."~".$district_details['ct_lname']."'$SEL>".$district_details['ct_lname']."</option>":"<option value=''>--Pickup City--</option>";
				 }
				?>	
			</select></td>	-->
			<td> Village</td>
			<td><input class="form-control" type="text" id="city_name1" value="<?php echo $co_Details['village_name'];?>" /></td>			
					<td> Location/Landmark</td>
			<td><input class="form-control" type="text" id="location" value="<?php echo $co_Details['location'];?>" /></td> 
		</tr>
		<tr>
	

			<td> Call Type</td>
			<td><input class="form-control" type="text" id="gender" value="Suicide" /></td>	
			
			<td> Category </td>
			<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['category_name'];?>" /></td>	
						<td> Sub Category</td>
			<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['sub_category_name'];?>" /></td>
									<td> Risk Level</td>
			<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['risk_level_name'];?>" /></td>
						
		</tr>
		<tr> 
			<td> Referral Concerned</td>
			<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['referrals_concerned_name'];?>" /></td>
 			<td>Counsellor Remarks</td>
			<td><input class="form-control" type="text" id="co_remarks" value="<?php echo $co_Details['co_remarks'];?>"  style="width: 253px; height: 79px;" /></td>	
			<td>Welfare Remarks</td>
			<td><input class="form-control" type="text" id="welfare_remarks" value="<?php echo $co_Details['welfare_remarks'];?>"  style="width: 253px; height: 79px;" /></td>	
			<td>Followup Level</td>
			<td><select id="followup_level" class="form-control" >
			
				<?php
				$district_query	= "SELECT * FROM `followup_levels` WHERE is_active = 1 order by followup_id;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 { 
					echo "<option value='".$district_details["followup_id"]."~".$district_details["followup_name"]."' >".$district_details["followup_name"]."</option>";
				 }
				?>	
			</select></td>	
			</tr>
	
	</table>
	</fieldset>
</form> 
</div>


	<div class="loadPage" id="loadPage">
		<?php $callid=$co_Details['caller_id']; include('followup_1.php');?> 
	</div>
	
	
	
<style>
	  
 
.alert { top:0px;
                padding: 0px;
                background-color: #f44336; /* Red */
                color: white;
				font-size:16;
                position:fixed; display:none;
                width:93%;
                margin-bottom: 5px;
				z-index:9999;
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


	</style> 
  
  