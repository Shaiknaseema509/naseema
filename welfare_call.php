<?php 
require_once("dbconnect_emri.php"); 
$call_id = $_REQUEST['id']; 
 session_start();
$agentID=$_SESSION["agentID"];
$Queue=$_SESSION["Queue"];
$call_hit_referenceno=$_SESSION["call_hit_referenceno"];
$convoxID= $_SESSION["convoxID"]; 

$co_details_query= mysql_query("SELECT caller_id,phone_number,`patient_name`,`caller_name`,`alternate_number`,`age`,`gender_name`,`district_id`,
`district_name`,`mandal_id`,`mandal_name`,
`village_id`,`village_name`,`location`,
mc.`category_name`,ms.`sub_category_name`, mr.`risk_level_name`,cid.`referrals_concerned_name`, cid.co_remarks
FROM `call_incident_info_details_suicide` cid
left JOIN `m_category` mc ON mc.`category_id` = cid.`category_id`
LEFT JOIN `m_sub_category` ms ON ms.`sub_category_id` = cid.`sub_category_id`
LEFT JOIN `m_risk_level` mr ON mr.`risk_level_id` = cid.`risk_level_id` 
WHERE `caller_id` = '".$call_id."'");


$co_Details = mysql_fetch_array($co_details_query);

 

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
		    
   <link rel="stylesheet" href="js/jquery-ui.css">
			<script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
		  
		  	 <script type="text/javascript">
  $( function() {
    $( ".datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
  } );
  </script>
<script src="scripts/main_validation.js"></script>
<script>

  	 $(document).ready(function() {
		
		 $('body').on('click','#call_not_answered',function()
{  
	if ($("#call_not_answered").is(':checked')) 
	{
	
	$('#btnsubmit').hide();
	$('#btnterminate').show();
	$('#notanswered').show(); 
	}
	else
	{
	$('#btnsubmit').show();
	$('#btnterminate').hide();
	$('#notanswered').hide(); 
	}	   
});

	 });
	 
	  
	  
$( window ).load(function() {
	
	
	$("#notanswered").hide();
	
	
  $('#consent').change(function() {
	if($('#consent').is(':checked')){
		//alert(123);
	$("#followup_date").show();
	
	}
	else
	{
		$("#followup_date").hide();
	}
  });
  
 
 
	 
 
});
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
		function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
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

function welfaredetails()
{	

var xmlHttp=newHttpObject();
		 var caller_id = document.getElementById('caller_id').value;
		   
		if(xmlHttp)
		 {
	var maritalstatus	= document.getElementById('maritalstatus').value;
	if(maritalstatus == "")	
	  { 
		alert("Please Select Marital Status..");
		document.getElementById('maritalstatus').focus();
		return false;
	  }
	var education	= document.getElementById('education').value;
	if(education == "")	
	  {
		alert("Please Select Education Status..");
		document.getElementById('education').focus();
		return false;
	  }  
	 var occupation	= document.getElementById('occupation').value;
	if(occupation == "")	
	  {
		alert("Please Select Occupation..");
		document.getElementById('occupation').focus();
		return false;
	  }  
	  	 var economicstatus	= document.getElementById('economicstatus').value;
	if(economicstatus == "")	
	  {
		alert("Please Select Economic Status..");
		document.getElementById('economicstatus').focus();
		return false;
	  }  
	  	  	 var socialstatus	= document.getElementById('socialstatus').value;
	if(socialstatus == "")	
	  {
		alert("Please Select Economic Status..");
		document.getElementById('socialstatus').focus();
		return false;
	  }  
	  	  	 var socioeconomicstatus	= document.getElementById('socioeconomicstatus').value;
	if(socioeconomicstatus == "")	
	  {
		alert("Please Select Economic Status..");
		document.getElementById('socioeconomicstatus').focus();
		return false;
	  }  
	  var risklevel1	= document.getElementById('risklevel').value;
	if(risklevel1 == "")	
	  {
		alert("Please Select Economic Status..");
		document.getElementById('risklevel').focus();
		return false;
	  }  
	 var welfare_remarks	= document.getElementById('welfare_remarks').value;
	if(welfare_remarks == "")	
	  {
		alert("Please Enter Supervisor Remarks..");
		document.getElementById('welfare_remarks').focus();
		return false;
	  } 
	  	  
	if($('#consent').is(':checked')){ 
	var consentforfollowup = 1; 
	}
	else
	{	
	var consentforfollowup = 0;
	}	
		 var notanswered = document.getElementById('notanswered').value;
	
	
	var txt_followup_date = document.getElementById('text_followup_date').value;

	  
	var callQuery="type=SaveDetailswelfare&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&maritalstatus="+maritalstatus+"&education="+education+"&occupation="+occupation+"&economicstatus="+economicstatus+"&socialstatus="+socialstatus+"&socioeconomicstatus="+socioeconomicstatus+"&risklevel1="+risklevel1+"&welfare_remarks="+welfare_remarks+"&consentforfollowup="+consentforfollowup+"&notanswered="+notanswered+"&txt_followup_date="+txt_followup_date;
																		

	xmlHttp.open("POST","save_suicide_details.php",true);
	xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlHttp.send(callQuery);
	xmlHttp.onreadystatechange=function()
	{
	if(xmlHttp.readyState==4 && xmlHttp.status==200)
	{
		var Response = null;
		Response = xmlHttp.responseText; 
 		var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
		postURL(end_call_url,"false");
				}
		 }
	 }
		delete xmlHttp;		 
	
}

function notanswereddet()
{
	
var xmlHttp=newHttpObject();
		 var caller_id = document.getElementById('caller_id').value;
		   
		if(xmlHttp)
		 {
 
	 var notanswered	= document.getElementById('notanswered').value;
	if(notanswered == "")	
	  {
		alert("Please select Not Answered Reason..");
		document.getElementById('notanswered').focus();
		return false;
	  } 
	  	  
 
	  
	var callQuery="type=notansweredreason&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&notanswered="+notanswered;
																		

	xmlHttp.open("POST","save_suicide_details.php",true);
	xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlHttp.send(callQuery);
	xmlHttp.onreadystatechange=function()
	{
	if(xmlHttp.readyState==4 && xmlHttp.status==200)
	{
		var Response = null;
		Response = xmlHttp.responseText; 
 		var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
		postURL(end_call_url,"false");
				}
	}
	 }
		delete xmlHttp;	
}


</script>

<script src="scripts/main_validation.js"></script>
<div class="col-md-12" style=""> 
	<form >
	  <div class="form-group">
                <fieldset> <legend>
                            <button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Suicide Prevention Help Line</button>
                           </legend>
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">

		 
		<tr>
					<td> Callid</td>
			<td><input class="form-control" type="text" id="caller_id" value="<?php echo $co_Details['caller_id'];?>"  style="height: 30px;" /></td>
			<td> Caller Number</td>
			<td><input class="form-control" type="text" id="callerno" value="<?php echo $co_Details['phone_number'];?>" onkeypress="return isNumberKey(event)"  style="height: 30px;" /></td>			
			<td> Patient Name</td>
			<td><input class="form-control" type="text" id="patient_name" value="<?php echo $co_Details['patient_name'];?>"  style="height: 30px;" /></td>

		</tr>
		<tr>
	<!--		 <td>Complaint Against</td>
			<td><input class="form-control" type="text" id="complaintagainst" /></td>		-->	
									<td> Caller Name</td>
			<td><input class="form-control" type="text" id="caller_name" value="<?php echo $co_Details['caller_name'];?>"  style="height: 30px;" /></td>

			<td> Alternate Number</td>
			<td><input class="form-control" type="text" id="alt_no" value="<?php echo $co_Details['alternate_number'];?>" onkeypress="return isNumberKey(event)"  style="height: 30px;" /></td>
			<td> Age</td>
			<td><input class="form-control" type="text" id="age" value="<?php echo $co_Details['age'];?>"  style="height: 30px;" /></td>
			<td> Gender</td>
			<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['gender_name'];?>"  style="height: 30px;" /></td>
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
			<td><input class="form-control" type="text" id="District" value="<?php echo $co_Details['district_name'];?>"  style="height: 30px;" /></td>			
			<!-- 			<td>Taluka</td>
			<td><select id="tehsil1" class="form-control" onchange='GetRegions(this.value,"2");'>
						<option value=''>Select Taluka</option>
				<?php
				$district_query	= "SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid=".$co_Details['district_id']." ORDER BY md_lname ASC;";
				$district_result= mysql_query($district_query);
				while($mandal_details = mysql_fetch_array($district_result))
				 {
					 
					$SEL = ($co_Details['mandal_id'])?"selected":"";
					echo  ($mandal_details['md_mdid'])?"<option  value='".$mandal_details['md_mdid']."~".$mandal_details['md_lname']."'$SEL>".$mandal_details['md_lname']."</option>":"<option value=''>--Pickup Taluka--</option>";
				 }
				?>	
			</select></td>	-->
			
			<td> Mandal</td>
			<td><input class="form-control" type="text" id="tehsil1" value="<?php echo $co_Details['mandal_name'];?>"  style="height: 30px;" /></td>	
			
			<!--<td>Village</td>
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
			</select></td>		-->
			
			<td> Village</td>
			<td><input class="form-control" type="text" id="city_name1" value="<?php echo $co_Details['village_name'];?>"  style="height: 30px;" /></td>
			
			<td> Location/Landmark</td>
			<td><input class="form-control" type="text" id="location" value="<?php echo $co_Details['location'];?>"  style="height: 30px;" /></td> 
		</tr>
		<tr> 
			<td> Category </td>
			<td><input class="form-control" type="text" id="category" value="<?php echo $co_Details['category_name'];?>"  style="height: 30px;" /></td>	
			<td> Sub Category</td>
			<td><input class="form-control" type="text" id="subcategory" value="<?php echo $co_Details['sub_category_name'];?>"  style="height: 30px;" /></td>
			<td> Risk Level</td>
			<td><input class="form-control" type="text" id="risklevel" value="<?php echo $co_Details['risk_level_name'];?>"  style="height: 30px;" /></td>
						
		</tr>
		<tr> 
			<td> Referral Concerned</td>
			<td><input class="form-control" type="text" id="referralconcerned" value="<?php echo $co_Details['referrals_concerned_name'];?>"  style="height: 30px;" /></td>
 
			<td>Counsellor Remarks</td>
			<td><input class="form-control" type="text" id="co_remarks" value="<?php echo $co_Details['co_remarks'];?>" onkeypress="return clean(event)" style="width: 253px; height: 79px;" /></td>	
		</tr>
 
	</table>
	</fieldset>
</form> 
</div>


<div class="col-md-12" style=""> 
	<form >
	  <div class="form-group">
                <fieldset> <legend>
                            <button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Case Details </button>
                           </legend>
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		 
		<tr>
 			
			<td> Marital Status</td>
			<td><select class="form-control" id="maritalstatus" name="maritalstatus" >  
				<option value=''> Select Marital Status </option>
				<?php $query = mysql_query("select * from `m_marital_status_suicide` where is_active = 1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['marital_status_id'];?>'><?php echo $db['marital_status_name'];?></option>
				<?php }?> 
			</select></td> 
				 			<td> Education</td>
			<td><select class="form-control" id="education" name="education" >  
				<option value=''> Select Education </option>
				<?php $query = mysql_query("SELECT * FROM `m_education` WHERE is_active = 1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['education_id'];?>'><?php echo $db['education_type'];?></option>
				<?php }?> 
			</select></td> 
			<td> Occupation</td>
			<td><select class="form-control" id="occupation" name="occupation" >  
				<option value=''> Select Occupation </option>
				<?php $query = mysql_query("SELECT * FROM `m_occupation` WHERE is_active = 1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['occupation_id'];?>'><?php echo $db['occupation_name'];?></option>
				<?php }?> 
			</select></td>
	

 		</tr>

		
<tr>
		<td> Economic Status</td>
			<td><select class="form-control" id="economicstatus" name="economicstatus" >  
				<option value=''> Select Economic Status </option>
				<?php $query = mysql_query("SELECT * FROM `m_economic_status_suicide` WHERE is_active = 1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['economic_status_id'];?>'><?php echo $db['economic_status_name'];?></option>
				<?php }?> 
			</select></td>
		<td> Social Status</td>
			<td><select class="form-control" id="socialstatus" name="socialstatus" >  
				<option value=''> Select Social Status </option>
				<?php $query = mysql_query("SELECT * FROM `m_social_status_suicide` WHERE is_active = 1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['social_status_id'];?>'><?php echo $db['social_status_name'];?></option>
				<?php }?> 
			</select></td>
			
					<td> Socio Economic Status</td>
			<td><select class="form-control" id="socioeconomicstatus" name="socioeconomicstatus" >  
				<option value=''> Select Social Economic Status </option>
				<?php $query = mysql_query("SELECT * FROM `m_socio_economic_status` WHERE is_active = 1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['socio_economic_status_id'];?>'><?php echo $db['socio_economic_status_name'];?></option>
				<?php }?> 
			</select></td>
	 

</tr>
<tr>
			<td> Risk Level</td>
			<td><select class="form-control" id="risklevel" name="risklevel" onchange='GetRegions(this.value,"9");'>  
				<option value=''> Select Risk Level</option>  
				<?php $query = mysql_query("SELECT * FROM `m_risk_level` WHERE is_active = 2 order by order_by;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['risk_level_id'];?>'><?php echo $db['risk_level_name'];?></option>
				<?php }?> 
			</select></td>
		<td>Remarks</td>
			<td><textarea class ="textarea1" cols="50" rows="2" id="welfare_remarks" maxlength="500" onkeypress="return blockSpecialChar(event)" style="width: 387px; height: 79px;" ></textarea></td>
			<td>&nbsp;&nbsp;<input type="checkbox" name="consent" id="consent" value="Yes" />Consent For Followup Call</td>
			 <td style="display:none;" id="followup_date"><input class="form-control datepicker" type="text" id="text_followup_date"  /> 
			</td>
			<td><input type="checkbox" name="ccsradio"  id="call_not_answered" value = "2" /><b class="radio" />Call Not Answered
 
		 
			<select class="form-control" id="notanswered" name="notanswered" onchange='GetRegions(this.value,"9");'>  
				<option value=''> Select Reasons</option>  
				<?php $query = mysql_query("select * from `m_not_answered_reasons` where is_active = 1");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['reason_id'];?>'><?php echo $db['reason_name'];?></option>
				<?php }?> 
			</select></td>
			</tr>
					<tr>	<td><button type="button" id = "btnsubmit" class="btn btn-large btn-danger" onclick="welfaredetails();" >Submit</button>
					<button type="button" id = "btnterminate" class="btn btn-large btn-danger" onclick="notanswereddet();" style= "display:none;">Terminate</button>
					<button type="button" class="btn btn-large btn-warning" id="Confrence"  onclick="conCall();">
                    Conference
                    </button>
						</td>
			</tr>
</tr>
<tr>

             
			 </div> </td>
</tr>
	
	
	</table>
	</fieldset>
</form> 
</div>
 
 