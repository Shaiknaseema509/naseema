<?php 
include("dbconnect_emri.php");
 
$call_id = $_REQUEST['callid']; 

//echo '<pre>'; print_r($_REQUEST);
 //die;
 
$phone_number = $_REQUEST['callernumber'];   
$agentid 	  = $_REQUEST['agentid'];   

 
$Queue 	              = strtoupper($_REQUEST["queue_name"]);
$Queue                = ($Queue)?$Queue:"MEDADV_MQ";
$agentID 	      = $_REQUEST["agentid"];
$call_hit_referenceno = $_REQUEST["call_hit_referenceno"];
$convoxID = $_REQUEST["convoxID"];

 
if($call_id =='') $call_id='20200000017656';
if($agentID =='') $agentID='test';
if($phone_number =='') $phone_number='9824002886';


//$co_details_query=mysql_query("call get_latest_call_details_phonenumber('".$phone_number."', '".$call_id."');");

$co_details_query= mysql_query("SELECT * FROM `call_incident_info_details_suicide` WHERE caller_id = '".$call_id."' ;"); 



$co_Details = mysql_fetch_array($co_details_query);

if($co_Details1['district_id'] == '' && $co_Details1['mandal_id'] == '') 
{
	
	$co_details_query= mysql_query("SELECT * FROM `call_incident_info_details_suicide` WHERE phone_number = '".$phone_number."' and district_id != '' and mandal_id != '' order by caller_id desc ;"); 

}
$co_Details1='';

$co_Details = mysql_fetch_array($co_details_query);
 
 
$my	= "INSERT INTO `incident_timings_suicide` (`caller_id`,`agent_id`,`pop_up_time`,`level`,`type`)
	   VALUES ('".$call_id."','".$agentID."',NOW(),'CO','POPUP')";
	   
mysql_query($my);

 
 

//echo '<pre>'; print_r($co_Details); die;

//mysql_free_result();

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
		  
		  
		   <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
	 <script type="text/javascript" src="js/bootstrap-3.3.2.min.js"></script> 
	 <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
	 <link rel="stylesheet" href="css/bootstrap-3.3.2.min.css" type="text/css"> 
		  
	 
<script src="scripts/main_validation.js"></script>

<script>

	function showAlert()
	 {
		$('.alert').show();
		$('.alert_content').html('Fields Should Not be empty');
		setTimeout(function(){$('.alert').hide();},10000); 
	 }	
	 
	 	function isNumberKey(evt)
      {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
      }
	
function referralss(a)
{
	$('#referralsconcerned').val(0);	
	$('.raman').hide();
	$('.level_'+a).show();
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
 
 
/*			 else if(index == 9)
			 { 
				var ID2 = $('#risklevel').val(); 
				var callQuery = "action=Getreferral&risk_id="+ID2;
			 }
			 */
			// alert(callQuery);
			xmlHttp.open("POST","get_suicide_details.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if(xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText;
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
 					 
					 else if(index == 8)
					 {
						document.getElementById("redressal").innerHTML=Response;	
					 } 		
		/*			 else if(index == 9)
					 {
						document.getElementById("referralsconcerned").innerHTML=Response;	
					 } 	*/
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 

function AddDrugs()
{
	

	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block';
	$.post("getDrugList.php",{CallID:$('#callerno').val()},function(data){
		$('#btnsave').show();
		$('#DrugContent').html(data);
		
	});
}
 
   
function counsellordetails1()
{
	//alert(document.getElementById('callerno').value);
	var calltype = document.getElementById('calltype').value
	var calltype_array = calltype.split("~");
	var call_type_id = calltype_array[0]; 
	var xmlHttp=newHttpObject();
	if(call_type_id == 1 || call_type_id == 2 || call_type_id == 3 || call_type_id == 4 )
	{
		  
	 	 var caller_id	= document.getElementById('caller_id').value;
		 
	 	 var callerno	= document.getElementById('callerno').value;

		 var patient_name	= document.getElementById('patient_name').value;
		if(patient_name == "")	
		  {
			alert("Please enter Patient Name");
			document.getElementById('patient_name').focus();
			return false;
		  } 
	  	 var caller_name	= document.getElementById('caller_name').value;
		if(caller_name == "")	
		  {
			alert("Please enter Caller Name");
			document.getElementById('caller_name').focus();
			return false;
		  } 
	  	 var alt_no	= document.getElementById('alt_no').value;
		 if(alt_no == "")	
		  {
			alert("Please enter Alternate Number");
			document.getElementById('alt_no').focus();
			return false;
		  } 
	  	 var age	= document.getElementById('age').value;
		if(age == "")	
		  {
			alert("Please enter Age");
			document.getElementById('age').focus();
			return false;
		  } 
		var gender	= document.getElementById('gender').value;

		if(gender == "")	
		  {
			alert("Please Select Gender");
			document.getElementById('gender').focus();
			return false;
		  } 
	  	 var District	= document.getElementById('District').value;
			 var tehsil1	= document.getElementById('tehsil1').value;

	  	 var city_name1	= document.getElementById('city_name1').value;
	  	 var location	= document.getElementById('location').value;

if($('#chxdata').is(':checked')){ 
	  	 var District	= document.getElementById('District').value;
			 var tehsil1	= document.getElementById('tehsil1').value;

	  	 var city_name1	= document.getElementById('city_name1').value;
	  	 var location	= document.getElementById('location').value;
}
else
{
	// var District	= document.getElementById('District').value;
		if(District == "")	
		  {
			alert("Please Select District");
			document.getElementById('District').focus();
			return false;
		  } 
	  	// var tehsil1	= document.getElementById('tehsil1').value;
		if(tehsil1 == "")	
		  {
			alert("Please Select Mandal");
			document.getElementById('tehsil1').focus();
			return false;
		  } 
	  	// var city_name1	= document.getElementById('city_name1').value;
		if(city_name1 == "")	
	  {
		alert("Please Select City");
		document.getElementById('city_name1').focus();
		return false;
	  } 
	  	// var location	= document.getElementById('location').value;
	if(location == "")	
	  {
		alert("Please Enter Location");
		document.getElementById('location').focus();
		return false;
	  }
}	
	  	 var gender	= document.getElementById('gender').value;
		if(gender == "")	
		  {
			alert("Please Select Gender");
			document.getElementById('gender').focus();
			return false;
		  } 

	 var category	= document.getElementById('category').value;
	if(category == "")	
	  {
		alert("Please Select Category");
		document.getElementById('category').focus();
		return false;
	  } 
	  	 var subcategory	= document.getElementById('subcategory').value;
	if(subcategory == "")	
	  {
		alert("Please Select Sub Category");
		document.getElementById('subcategory').focus();
		return false;
	  } 
	
	  	 var risklevel	= document.getElementById('risklevel').value;
	if(risklevel == "")	
	  {
		alert("Please Select Risk Level");
		document.getElementById('risklevel').focus();
		return false;
	  } 
	  	 var referralsconcerned	= $("#referralsconcerned").val();
	if(referralsconcerned == "")	
	  {
		alert("Please Select Referrals Concerned");
		document.getElementById('referralsconcerned').focus();
		return false;
	  } 
	  	  	 var calltype	= $("#calltype").val();
	if(calltype == "")	
	  {
		alert("Please Select Call Type");
		document.getElementById('calltype').focus();
		return false;
	  } 
	  	 var co_remarks	= document.getElementById('co_remarks').value;
	if(co_remarks == "")	
	  {
		alert("Please Enter Remarks");
		document.getElementById('co_remarks').focus();
		return false;
	  } 
 if($('#consent').is(':checked')){ 
 var consent = 1; 
}
else
{
	var consent = 0;
}	

 
			var callQuery="type=SaveDetailsCounsellor1&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&patient_name="+patient_name+"&caller_name="+caller_name+"&alt_no="+alt_no+"&age="+age+"&gender="+gender+"&District="+District+"&tehsil1="+tehsil1+"&city_name1="+city_name1+"&location="+location+"&calltype="+calltype+"&category="+category+"&subcategory="+subcategory+"&risklevel="+risklevel+"&referralsconcerned="+referralsconcerned+"&co_remarks="+co_remarks+"&consent="+consent+"&callerno="+callerno;
 
                        xmlHttp.open("POST","save_suicide_details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                {
									 
									var Response = null;
									Response = xmlHttp.responseText;
									//$('#save').hide();
									$('#save').text('Update');
									$('#TransferP').show();
									$('#endcall').show();
									
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
									 
						postURL(end_call_url,"false");
								}
                         }


		 
	}		 
		 else
		 {
			 
			 
			 
			  var caller_id	= document.getElementById('caller_id').value;
		 
	 	 var callerno	= document.getElementById('callerno').value;

		 var patient_name	= document.getElementById('patient_name').value;
		 
	  	 var caller_name	= document.getElementById('caller_name').value;
		  
	  	 var alt_no	= document.getElementById('alt_no').value;
		   
	  	 var age	= document.getElementById('age').value;
		 
	  	 var gender	= document.getElementById('gender').value;
	 
	  	 var District	= document.getElementById('District').value;
			 var tehsil1	= document.getElementById('tehsil1').value;

	  	 var city_name1	= document.getElementById('city_name1').value;
	  	 var location	= document.getElementById('location').value;

if($('#chxdata').is(':checked')){ 
 var District = 0; 
 var tehsil1 = 0;
 var city_name1 = 0;
 var location =0;
}
 

	 var category	= document.getElementById('category').value;

	  	 var subcategory	= document.getElementById('subcategory').value;

	  	var risklevel	= document.getElementById('risklevel').value;
	  	var referralsconcerned	= $("#referralsconcerned").val();
	  	var calltype	= $("#calltype").val(); 
	  	var co_remarks	= document.getElementById('co_remarks').value;
 
 if($('#consent').is(':checked')){ 
 var consent = 1; 
}
else
{
	var consent = 0;
}		 
 
			var callQuery="type=SaveDetailsCounsellor1&agent_id=<?=$agentID;?>&caller_id="+caller_id+"&patient_name="+patient_name+"&caller_name="+caller_name+"&alt_no="+alt_no+"&age="+age+"&gender="+gender+"&District="+District+"&tehsil1="+tehsil1+"&city_name1="+city_name1+"&location="+location+"&calltype="+calltype+"&category="+category+"&subcategory="+subcategory+"&risklevel="+risklevel+"&referralsconcerned="+referralsconcerned+"&co_remarks="+co_remarks+"&consent="+consent+"&callerno="+callerno;
 
                        xmlHttp.open("POST","save_suicide_details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                {
									 
									var Response = null;
									Response = xmlHttp.responseText;
									//$('#save').hide();
									$('#save').text('Update');
									$('#TransferP').show();
									$('#endcall').show();
									
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
							 <td style="align:right"><button type="button" id="" onclick='AddDrugs();'>Show History</button> </td>			
	
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">

		<tr>
			<td> Case ID</td>
			<td><input class="form-control" type="text" id="caller_id" value="<?php echo $_REQUEST['callid'];?>" style="height: 30px;" /></td>
			<td> Caller Number</td>
			<td><input class="form-control" type="text" id="callerno" value="<?php echo $phone_number;?>" onkeypress="return isNumberKey(event)"  style="height: 30px;" /></td>			
			<td> Patient Name</td>
			<td><input class="form-control" type="text" id="patient_name" value="<?php echo $co_Details['patient_name'];?>"  style="height: 30px;" /></td>
			<td> Caller Name</td>
			<td><input class="form-control" type="text" id="caller_name" value="<?php echo $co_Details['caller_name'];?>"  style="height: 30px;" /></td>
		</tr>
		<tr>
			<td> Alternate Number</td>
			<td><input class="form-control" type="text" id="alt_no" value="<?php echo $co_Details['alternate_number'];?>" onkeypress="return isNumberKey(event)"  style="height: 30px;" /></td>
			<td> Age</td>
			<td><input class="form-control" type="text" id="age" value="<?php echo $co_Details['age'];?>" onkeypress="return isNumberKey(event)"  style="height: 30px;" /></td>
			<!--<td> Gender</td>
			<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['gender_name'];?>"  style="height: 30px;" /></td>-->
			<td>Gender</td>
			<td><select id="gender" class="form-control" value="<?php echo $co_Details['gender_name'];?>" >
			<option value=''>Select Gender</option>
				<?php
				$district_query	= "SELECT `gender_id`,`gender_name` FROM `m_gender_suicide` WHERE `is_active` = 1";
				$district_result= mysql_query($district_query) or die(mysql_error());
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($co_Details['gender_name']==$district_details["gender_name"])?"selected":"";
					echo "<option value='".$district_details["gender_name"]."~".$district_details["gender_name"]."' $SEL >".$district_details["gender_name"]."</option>";
				 }
				?>	
 
			</select></td>			
		</tr>
		<tr>
						
		</tr>
		<tr>
			<td>District</td>
			<td><select id="District" class="form-control" onchange='GetRegions(this.value,"1");'>
			<option value=''>Select District</option>
				<?php
				$district_query	= "SELECT ds_dsid,districtname ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
				$district_result= mysql_query($district_query)or die(mysql_error());
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($co_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."' $SEL >".$district_details["ds_lname"]."</option>";
				 }
				?>	
			</select></td>			
 			<td>Taluka</td>
			<td><select id="tehsil1" class="form-control" onchange='GetRegions(this.value,"2");'>
						<option value=''>Select Taluka</option>
				<?php
				$district_query	= "SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid=".$co_Details['district_id']." ORDER BY md_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					 
					$SEL = ($co_Details['mandal_id']==$district_details["md_mdid"])?"selected":"";
					echo  ($district_details['md_mdid'])?"<option  value='".$district_details['md_mdid']."~".$district_details['md_lname']."'$SEL>".$district_details['md_lname']."</option>":"<option value=''>--Pickup Taluka--</option>";
				 }
				?>	
			</select></td>	
			<td>Village</td>
			<td><select id="city_name1" class="form-control" onchange='GetRegions(this.value,"5");' >
			<option value=''>Select Village</option>
				<?php
				$district_query	= "SELECT ct_ctid,ct_lname FROM m_city WHERE ct_mdid=".$co_Details['mandal_id']." AND is_active=1 ORDER BY ct_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					 
					$SEL = ($co_Details['village_id']==$district_details["ct_ctid"])?"selected":"";
					echo  ($district_details['ct_ctid'])?"<option  value='".$district_details['ct_ctid']."~".$district_details['ct_lname']."'$SEL>".$district_details['ct_lname']."</option>":"<option value=''>--Pickup City--</option>";
				 }
				?>	
			</select></td>			
		</tr>
		<tr>
	

			<td> Location/Landmark</td>
			<td><input class="form-control" type="text" id="location" value="<?php echo $co_Details['location'];?>"  style="height: 30px;" /></td> 
					<td><input type="checkbox" name="chxdata" id="chxdata" value="Yes" /></td>
			<td> Not Willing To Share Location Details</td>
		</tr>
		  
		<table align="right" width="99%">
		<tr align="right">
			<td width="70%"></td>

		</tr>
	</table>
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
			
			<td> Call Type</td>
			<td><select class="form-control" id="calltype" name="calltype" onchange='GetRegions(this.value,"6"); GetRegions(this.value,"7");'>  
				<option value=''> Select Call Type </option>
 	
				<?php
				$district_query	= "SELECT * FROM `m_call_type_suicide` WHERE `is_active`=1;";
				$district_result= mysql_query($district_query)or die(mysql_error());
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($co_Details['call_type_id']==$district_details["call_type_id"])?"selected":"";
					echo "<option value='".$district_details["call_type_id"]."~".$district_details["call_type_name"]."' $SEL >".$district_details["call_type_name"]."</option>";
				 }
				?>	
			</select></td> 
 
	
			<td>Category</td>
			<td><select class="form-control" id="category" name="category" onchange='GetRegions(this.value,"6"); GetRegions(this.value,"7");'>  
				<option value=''> Select Category </option>
				<?php
				$district_query	= "SELECT * FROM `m_category` WHERE `is_active`=1;";
				$district_result= mysql_query($district_query)or die(mysql_error());
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($co_Details['category_id']==$district_details["category_id"])?"selected":"";
					echo "<option value='".$district_details["category_id"]."~".$district_details["category_name"]."' $SEL >".$district_details["category_name"]."</option>";
				 }
				?>	
				
			</select>
			</td> 
			<td>Sub Category</td>
			<td><select id="subcategory" class="form-control" >
			<option value=''> Select Sub Category </option>
							<?php
				$district_query	= "SELECT * FROM `m_sub_category` WHERE `is_active`=1 and category_id = '".$co_Details['category_id']."';";
				$district_result= mysql_query($district_query)or die(mysql_error());
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($co_Details['sub_category_id']==$district_details["sub_category_id"])?"selected":"";
					echo "<option value='".$district_details["sub_category_id"]."~".$district_details["sub_category_name"]."' $SEL >".$district_details["sub_category_name"]."</option>";
				 }
				?>	
			</select></td>	
			</tr>
	 
		<tr> 
			<td> Risk Level</td>
			<td><select class="form-control" id="risklevel" name="risklevel" onchange='GetRegions(this.value,"9"); referralss(this.value);'>  
				<option value=''> Select Risk Level</option> 
				<option value='1'>High</option>
				<option value='2'>At Risk</option>
				<option value='3'>Low</option>
				</select>
			</td> 
 		
			<td> Referrals Concerned				                        
			<select id="referralsconcerned" class='referralsconcerned' multiple="multiple"> 
			<?php $query = mysql_query("select * from `m_referrals_concerned`");
			while($db = mysql_fetch_array($query)){?>
			<option class="raman level_<?php echo $db['risk_level'];?>"  value='<?php echo $db['referal_name'];?>'><?php echo $db['referal_name'];?></option>
			<?php }?> 

            </select></td>
					  
			<td>&nbsp;&nbsp;<input type="checkbox" name="consent" id="consent" value="Yes" />Consent For Welfare Call</td>
					
			<td>Remarks</td>
			<td><textarea class ="textarea1" cols="50" rows="2" id="co_remarks" maxlength="500" style="width: 387px; height: 79px;"  onkeypress="return blockSpecialChar(event)" ><?php echo $co_Details['co_remarks'];?></textarea></td> 
			<td><button type="button" class="btn btn-large btn-danger" onclick="counsellordetails1();">Submit</button></td>

		</tr>
<tr>
			<td> Type Of Conference</td>
			<td><select class="form-control" id="risklevel" name="risklevel" >  
				<option value=''> Select</option> 
				<option value='1'>108</option>
				<option value='2'>100</option>
				<option value='3'>181</option>
				<option value='4'>Supervisor</option>
			</select></td> 
			        <td><button type="button" class="btn btn-large btn-warning" id="Confrence"  onclick="conCall();">
                                                    Confrence
                    </button></td>
</tr>

<tr>	 
			<script type="text/javascript">
                                    $(document).ready(function() {
                                       // $('.referralsconcerned').multiselect();
                                    });
            </script>
</tr>
	
	</table>
	</fieldset>
</form> 
</div>
	<table align="right" width="99%">
		<tr align="right">
			<td width="70%"></td>
			<td>
             <div style="float:center">
			 </div> </td>
		</tr>
	</table>

  <div id="light" class="white_content">  <a style="float:right" href="javascript:void(0)" 
onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
  
  
	<br>

	<div id="DrugContent">
 

	</div>
  

   <div id="fade" class="black_overlay" style="display: contents;"></div>  
	  </div>

  	
<script> 
function conCall()
{
	openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php?vehicle_phone_number="+108,"Conference_Call","width=420,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");                            
    //openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php?callid="+callid+"&vehicle_phone_number="+vehicle_phone_number,"Conference_Call","width=380,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");
	return false;
}
</script>  

	<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title></title>
    <script type="text/javascript">
    function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
        }
    </script>
	<style>
	/* When moving the mouse over the close button */
.closebtn:hover {
color: black;
}

.black_overlay {
  display: none;
   top: 0%;
  left: 0%;
  width: 100%;
  height: 160%;
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
  height: 30%;
  padding: 16px;
  border: 3px solid orange;
  background-color: white;
  z-index: 1002;
  overflow: auto;
}

.displaynone{ display:none;}
	</style>
</head> 
</html>
 
	
	
	
	
