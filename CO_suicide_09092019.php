<?php 
require_once("dbconnect_emri.php"); 
echo $call_id = $_REQUEST['callid']; 

echo '<br>';
echo $phone_number = $_REQUEST['callernumber'];   




$co_details_query= mysql_query("SELECT caller_id,phone_number,`patient_name`,`caller_name`,`alternate_number`,`age`,`gender_name`,`district_id`,
`district_name`,`mandal_id`,`mandal_name`,
`village_id`,`village_name`,`location` 
FROM `call_incident_info_details_suicide` 
WHERE `caller_id` = '".$call_id."' AND phone_number = '".$phone_number."'");
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
		  
	 
<script src="scripts/main_validation.js"></script>
<script>

	function showAlert()
	 {
		$('.alert').show();
		$('.alert_content').html('Fields Should Not be empty');
		setTimeout(function(){$('.alert').hide();},10000); 
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
	 
function saveSubmit1()
{	
var xmlHttp=newHttpObject();
		 var call_id = document.getElementById('callidValue').value;
		   
		if(xmlHttp)
		 {
	var caller_id	= document.getElementById('caller_id').value;
	if(caller_id == "")	
	  { 
		showAlert();
		document.getElementById('caller_id').focus();
		return false;
	  }
	var callerno	= document.getElementById('callerno').value;
	if(callerno == "")	
	  {
		showAlert();
		document.getElementById('callerno').focus();
		return false;
	  }  
	 var patient_name	= document.getElementById('patient_name').value;
	if(patient_name == "")	
	  {
		showAlert();
		document.getElementById('patient_name').focus();
		return false;
	  }  
	 var caller_name	= document.getElementById('caller_name').value;
	if(caller_name == "")	
	  {
		showAlert();
		document.getElementById('caller_name').focus();
		return false;
	  } 
	 var alt_no	= document.getElementById('alt_no').value;
	if(alt_no == "")	
	  {
		showAlert();
		document.getElementById('alt_no').focus();
		return false;
	  }  
	  
	  var age	= document.getElementById('age').value;
	if(age == "")	
	  {
		showAlert();
		document.getElementById('age').focus();
		return false;
	  }   
		
	  var gender	= document.getElementById('gender').value;
	if(gender == "")	
	  {
		showAlert();
		document.getElementById('gender').focus();
		return false;
	  }   
	  	  var District	= document.getElementById('District').value;
	if(District == "")	
	  {
		showAlert();
		document.getElementById('District').focus();
		return false;
	  }   
	  	  var tehsil1	= document.getElementById('tehsil1').value;
	if(tehsil1 == "")	
	  {
		showAlert();
		document.getElementById('tehsil1').focus();
		return false;
	  }   
	  	  var city_name1	= document.getElementById('city_name1').value;
	if(city_name1 == "")	
	  {
		showAlert();
		document.getElementById('city_name1').focus();
		return false;
	  }   	 
	  var location	= document.getElementById('location').value;
	if(location == "")	
	  {
		showAlert();
		document.getElementById('location').focus();
		return false;
	  } 

	  var category	= document.getElementById('category').value;
	if(category == "")	
	  {
		showAlert();
		document.getElementById('category').focus();
		return false;
	  }   
	  var subcategory	= document.getElementById('subcategory').value;
	if(subcategory == "")	
	  {
		showAlert();
		document.getElementById('subcategory').focus();
		return false;
	  }   
	  var grievance	= document.getElementById('grievance').value;
	if(grievance == "")	
	  {
		showAlert();
		document.getElementById('grievance').focus();
		return false;
	  }   
	  var risklevel	= document.getElementById('risklevel').value;
	if(risklevel == "")	
	  {
		showAlert();
		document.getElementById('risklevel').focus();
		return false;
	  }   
	  var referralsconcerned	= document.getElementById('referralsconcerned').value;
	if(referralsconcerned == "")	
	  {
		showAlert();
		document.getElementById('referralsconcerned').focus();
		return false;
	  }   
	  var co_remarks	= document.getElementById('co_remarks').value;
	if(co_remarks == "")	
	  {
		showAlert();
		document.getElementById('co_remarks').focus();
		return false;
	  }   	  
		 
	  
	  var callQuery="type=SaveDetailsCounsellor&agent_id=<?=$agentID;?>&location="+location+"&caller_id="+caller_id+"&callerno="+callerno+"&patient_name="+patient_name+"&caller_name="+caller_name+"&alt_no="+alt_no+"&age="+age+"&gender="+gender+"&District="+District+"&tehsil1="+tehsil1+"&city_name1="+city_name1+"&location="+location+"&category="+category+"&subcategory="+subcategory+"&grievance="+grievance+"&risklevel="+risklevel+"&referralsconcerned="+referralsconcerned+"&co_remarks="+co_remarks;
																		
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

<script src="scripts/main_validation.js"></script>
<div class="col-md-12" style=""> 
	<form >
	  <div class="form-group">
                <fieldset> <legend>
                            <button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Suicide Prevention Help Line</button>
                           </legend>
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		 
		<tr>
					<td> Caller Number</td>
			<td><input class="form-control" type="text" id="caller_id" value="<?php echo $co_Details['caller_id'];?>" /></td>
			<td> Caller Number</td>
			<td><input class="form-control" type="text" id="callerno" value="<?php echo $co_Details['phone_number'];?>" /></td>			
			<td> Patient Name</td>
			<td><input class="form-control" type="text" id="patient_name" value="<?php echo $co_Details['patient_name'];?>" /></td>
									<td> Caller Name</td>
			<td><input class="form-control" type="text" id="caller_name" value="<?php echo $co_Details['caller_name'];?>" /></td>
		</tr>
		<tr>
	<!--		 <td>Complaint Against</td>
			<td><input class="form-control" type="text" id="complaintagainst" /></td>		-->	


			<td> Alternate Number</td>
			<td><input class="form-control" type="text" id="alt_no" value="<?php echo $co_Details['alternate_number'];?>" /></td>
			<td> Age</td>
			<td><input class="form-control" type="text" id="age" value="<?php echo $co_Details['age'];?>" /></td>
			<td> Gender</td>
			<td><input class="form-control" type="text" id="gender" value="<?php echo $co_Details['gender_name'];?>" /></td>
		</tr>
		<tr>
						
		</tr>
		<tr>
			<td>District</td>
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
			</select></td>			
 			<td>Taluka</td>
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
			</select></td>	
			<td>Village</td>
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
			</select></td>			
		</tr>
		<tr>
	

					<td> Location/Landmark</td>
			<td><input class="form-control" type="text" id="location" value="<?php echo $co_Details['location'];?>" /></td> 
		</tr>
		  
		<table align="right" width="99%">
		<tr align="right">
			<td width="70%"></td>
			<td>
             <div style="float:center">
             <button type="button" class="btn btn-large btn-danger" onclick="saveSubmit1();" >Submit</button>
			 </div> </td>
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
			<td> Case ID</td>
			<td><input class="form-control" type="text" id="caseid" value ="20190000123393" /></td>			
			 			<td> Category</td>
			<td><select class="form-control" id="category" name="category" onchange='GetRegions(this.value,"6"); GetRegions(this.value,"7");'>  
				<option value=''> Select Category </option>
				<?php $query = mysql_query("SELECT * FROM `m_category` WHERE `is_active`=1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['category_id'];?>'><?php echo $db['category_name'];?></option>
				<?php }?> 
			</select></td> 
			 			<td>Sub Category</td>
			<td><select id="subcategory" class="form-control" >
			<option value=''> Select Sub Category </option>
			</select></td>	

			</select></td> 
		</tr>
	 
		<tr>
 
			<td> Grievance</td>
			<td><select class="form-control" id="grievance" name="grievance">  
				<option value=''> Select Grievance</option> 
			</select></td> 
									<td> Risk Level</td>
			<td><select class="form-control" id="risklevel" name="risklevel" onchange='GetRegions(this.value,"9");'>  
				<option value=''> Select Risk Level</option> 
				<option value='1'>High</option>
				<option value='2'>Medium</option>
				<option value='3'>Low</option>
			</select></td> 
			<td> Referrals Concerned</td>
			<td><select class="form-control" id="referralsconcerned" name="referralsconcerned" onchange='GetRegions(this.value,"8");'>  
				<option value=''> Select Referrals Concerned</option> 

			</select></td>  

		</tr>
 
		 
	 
		
<tr>
		<td>Remarks</td>
			<td><textarea class ="textarea1" cols="50" rows="2" id="co_remarks" maxlength="500" ></textarea></td> 
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
             <button type="button" class="btn btn-large btn-danger" >Submit</button>
             <button type="button" class="btn btn-large btn-warning" id="Confrence"  onclick="conCall();">
                                                    Confrence
                                                </button>
			 </div> </td>
		</tr>
	</table>	
  <script> 
  function conCall()
{
	 
    openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php?vehicle_phone_number="+108,"Conference_Call","width=420,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");                            
    //openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php?callid="+callid+"&vehicle_phone_number="+vehicle_phone_number,"Conference_Call","width=380,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");
	return false;
}
  </script>