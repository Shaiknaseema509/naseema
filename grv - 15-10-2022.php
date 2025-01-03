<?php 
require_once("dbconnect_emri.php"); 
//$ID = $_REQUEST['ID'];  


  ?>  
 
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

   
   <link rel="stylesheet" href="js/jquery-ui.css">
  
  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>

<script>

function checkCompliant()
		{
			var Compliant =  $('#Compliant').val();
			//alert(Compliant);
			//console.log(Compliant);
			
			if(Compliant ==17)
			{
					$('.show-Others').show();
								
			}
			else
			{
				$('.show-Others').hide();
			}
		}
		

	function showAlert()
	 {
		$('.alert').show();
		$('.alert_content').html('Fields Should Not be empty');
		setTimeout(function(){$('.alert').hide();},10000); 
	 }	

$(document).ready(function(){
	$('#hidediv').hide();	
});
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
				var callQuery = "action=greaareas&mandal_id="+ID;
			 }
			 else if(index == 3)
			 {
				var callQuery = "action=areas&village_id="+ID;
			 }
			 else if(index == 5)
			 {
				var IDS = $('#tehsil1').val(); 
				var city_name1 = $('#city_name1').val(); 
				var facility = $('#Facility').val(); 
				var Institute = $('#Institute').val(); 
				var facility_name = $('#facility_name').val(); 
				var callQuery = "action=GetAgencyGre&area_id="+IDS+"&Institute="+Institute+"&village_id="+city_name1+"&facility="+facility+"&facility_name="+facility_name;
			 }
			 else if(index == 6)
			 {
				var IDS = $('#tehsil1').val(); 
				var city_name1 = $('#city_name1').val(); 
				var facility = $('#Facility').val(); 
				var Institute = $('#Institute').val(); 
				var callQuery = "action=GetAgencyfacility&area_id="+IDS+"&Institute="+Institute+"&village_id="+city_name1+"&facility="+facility;
			 } 

			//alert(callQuery);
			xmlHttp.open("POST","reg.php",true);
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
					 else if(index == 5)
					 {
						//var str = Response.split('~');
						// alert(str);
						document.getElementById("spocname").innerHTML=Response;	
						//document.getElementById("facility_name").value=str[1];	
					 } 
					 else if(index == 6)
					 {

						document.getElementById("facility_name").innerHTML=Response;	

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
		//$('#facility_name').val(str[4]);
	}	
	 
function saveSubmit()
{	
var xmlHttp=newHttpObject();
		 var call_id = document.getElementById('callidValue').value;
		if(xmlHttp)
		 {
	var Compliant	= document.getElementById('Compliant').value;
	if(Compliant == "")	
	  {
		showAlert();
		document.getElementById('Compliant').focus();
		return false;
	  }
	  
	    var Others	= document.getElementById('Others').value;
			  
	var goc	= document.getElementById('goc').value;
	if(goc == "")	
	  {
		showAlert();
		document.getElementById('goc').focus();
		return false;
	  }  
	 var complaintagainst	= document.getElementById('complaintagainst').value;
	if(complaintagainst == "")	
	  {
		showAlert();
		document.getElementById('complaintagainst').focus();
		return false;
	  }   
	  
	  
	  var industryname	= document.getElementById('industryname').value;
	if(industryname == "")	
	  {
		showAlert();
		document.getElementById('industryname').focus();
		return false;
	  }  
	  
	  	  
	   var landmark	= document.getElementById('landmark').value;
	if(landmark == "")	
	  {
		showAlert();
		document.getElementById('landmark').focus();
		return false;
	  } 
	  
	 var remarks_ro	= document.getElementById('remarks_ro').value;
	if(remarks_ro == "")	
	  {
		showAlert();
		document.getElementById('remarks_ro').focus();
		return false;
	  } 
	  
	   var callerEmail	= document.getElementById('callerEmail').value;
	 if(callerEmail == "")	
	{
	showAlert();
	document.getElementById('callerEmail').focus();
	return false;
	}

	 var designation1	= document.getElementById('designation1').value;
	if(designation1 == "")	
	  {
		showAlert();
		document.getElementById('designation1').focus();
		return false;
	  } 
	 
	var Facility	= document.getElementById('Facility').value;
	if(Facility == "")	
	  {
		showAlert();
		document.getElementById('Facility').focus();
		return false;
	  } 
	var facility_name	= document.getElementById('facility_name').value;
	if(facility_name == "")	
	  {
		showAlert();
		document.getElementById('facility_name').focus();
		return false;
	  } 	  
	  
	  var noc	= document.getElementById('noc').value;
	if(noc == "")	
	  {
		showAlert();
		document.getElementById('noc').focus();
		return false;
	  } 

  var Department	= document.getElementById('Department').value;
	if(Department == "")	
	  {
		showAlert();
		document.getElementById('Department').focus();
		return false;
	  }	  
		
	  var District	= document.getElementById('District').value;
	if(District == "")	
	  {
		showAlert();
		document.getElementById('District').focus();
		return false;
	  }   
		
	 var rdate	= document.getElementById('rdate').value;
	
	var spoccontact	= document.getElementById('spoccontact').value;
	 var sEmail	= document.getElementById('sEmail').value;
	if(rdate == "")	
	  {
		showAlert();
		document.getElementById('rdate').focus();
		return false;
	  }   
	  
	   var sector	= document.getElementById('sector').value;
	if(sector == "")	
	  {
		showAlert();
		document.getElementById('sector').focus();
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
		
	var spocname	= document.getElementById('spocname').value;
	if(spocname == "")	
	  {
		showAlert();
		document.getElementById('spocname').focus();
		return false;
	  } 	
	  
	  var callQuery="type=SaveBeneficiary&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&spoccontact="+spoccontact+"&Others="+Others+"&sector="+sector+"&sEmail="+sEmail+"&Facility="+Facility+"&spocname="+spocname+"&callerEmail="+callerEmail+"&city_name1="+city_name1+"&tehsil1="+tehsil1+"&rdate="+rdate+"&District="+District+"&call_id="+call_id+"&noc="+noc+"&Department="+Department+"&designation1="+designation1+"&remarks_ro="+remarks_ro+"&complaintagainst="+complaintagainst+"&industryname="+industryname+"&landmark="+landmark+"&goc="+goc+"&Compliant="+Compliant+"&facility_name="+facility_name;
		//alert(callQuery);
		xmlHttp.open("POST","save_grivence_Details.php",true);
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
						$('#hidediv').show();
						return false;
					}
					
							

				}
		 }
	 }
		delete xmlHttp;		 
	
}


function conference_call(PNO)
 {
	var CallID = document.getElementById('callidValue').value;
	var VehiclePhoneNumber = PNO; // document.getElementById("vehicle_phone_number").value;
        //alert(VehiclePhoneNumber);       
	openWindowpostURL("http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/control_panel.php?callid="+CallID+"&vehicle_phone_number="+VehiclePhoneNumber,"Conference_Call","width=600,height=450,left = 1000,top = 100,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");
 }

</script>

<body onload='getdiv();'>
<script src="scripts/main_validation.js"></script>
<div class="col-md-12" style="color:white;background: radial-gradient(ellipse farthest-corner at center center) repeat scroll 0% 0%;background-color:#e1dfdf;border: 1px solid #eedcdc; "> 
	<form >
	  <div class="form-group">
                <fieldset> <legend class="custm_legend">
                            <!--<button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Grievance</button>-->
							<div class="module-head custm_call_closer">
                                <h3>Grievance</h3>
                            </div>
                        </legend>
						</fieldset>
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		 
		<tr>
		
			<td class="custm_label_txt">Compliant</td>
			<td>			
			<select class="form-control custm_input_form" id="Compliant" onchange="return checkCompliant();">
				<option value=''> Select Complaint </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_complaint_type` WHERE `ISACTIVE`=1 ORDER BY ID;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['ID'];?>'><?php echo $db['Name'];?></option>
				<?php }?>
			</select>			
			</td>			
			<td class="custm_label_txt"> Gist of Complaint</td>
			<td><input class="form-control custm_input_form" type="text" id="goc" /></td>
			
			<td class="custm_label_txt">Complaint Against</td>
			<td><input class="form-control custm_input_form" type="text" id="complaintagainst" /></td>
		</tr>
		
		<tr class="show-Others" style="display:none;">
		<td class="custm_label_txt"> Others</td>
		<td><input type="text" id="Others" class="form-control custm_input_form" /></td>
		</tr>
		
		<tr>			
				<td class="custm_label_txt"> Designation</td>
			<td><input class="form-control custm_input_form" type="text" id="designation1" /></td>
			
			<td class="custm_label_txt">Nature of Compliant</td>
			<td> 
			<select class="form-control custm_input_form" id="noc">
				<option value=''> Select Complaint </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_complaintstype` WHERE `ISACTIVE`=1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['ID'];?>'><?php echo $db['Name'];?></option>
				<?php }?>
			</select>
			</td>
			
			<td class="custm_label_txt">Industry Type</td>
			<td><select id="Facility" class="form-control custm_input_form" name="Facility" >
			<option value=''> Select Industry </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_industrytype` WHERE `ISACTIVE`=1 ORDER BY `ID` ASC;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['ID'];?>'><?php echo $db['Name'];?></option>
				<?php }?> </select></td>
		</tr>
		
		<tr>
			
			<td class="custm_label_txt">Industry Name</td>
			<td><input class="form-control custm_input_form" type="text" id="industryname" /></td>
			
			<td class="custm_label_txt">Landmark</td>
			<td><input class="form-control custm_input_form" type="text" id="landmark" /></td>
			
				<td class="custm_label_txt"> Reference Date</td>
			<td><input type="text" class="form-control datepicker custm_input_form"  id="rdate" /></td>
		
			</tr>
			
			<tr>
			<td class="custm_label_txt">District</td>
			<td><select id="District" class="form-control custm_input_form" onchange='GetRegions(this.value,"1");'>
			<option value=''>Select District</option>
				<?php
				$district_query	= "SELECT ds_dsid,districtname ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($Beneficiary_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."' $SEL >".$district_details["ds_lname"]."</option>";
				 }
				?>	
			</select></td>	
			
			<td class="custm_label_txt">Taluka</td>
			<td><select id="tehsil1" class="form-control custm_input_form" onchange='GetRegions(this.value,"2");'></select></td>
	
			<td class="custm_label_txt"> Village</td>
			<td><select id="city_name1" class="form-control custm_input_form" onchange='GetRegions(this.value,"6");' ></select></td>
			</tr>
			
		<tr>
		<td class="custm_label_txt"> Sector <b aria-required="true">*</b></td>
			<td>
			 <select id="sector" name="sector" class="form-control custm_form_input custm_form_select">
			  <option value="">Select Sector</option>
			  <option value="Organized">Organized</option>
				<option value="Unorganized">Unorganized</option>																								 														
			  </select>
             </td>
		
		<!--<td class="custm_label_txt">Sector</td>
			<td><select id="facility_name" class="form-control custm_input_form" name="facility_name" onchange='GetRegions(this.value,"5");' >
			<option value=''> Select Sector </option>
			</td>-->
			
			<td class="custm_label_txt">SPOC Name</td>
			<td><select id="spocname" class="form-control custm_input_form" onchange="return spoccontactName(this.value);">
			 
			</select></td>
		
		
			
            <td class="custm_label_txt"> SPOC Email</td>
			<td><input type="text" id="sEmail" class="form-control custm_input_form" />  </td>
			</tr>
			
			<tr>
			<td class="custm_label_txt"> SPOC Contact</td>
			<td><input type="text" id="spoccontact" class="form-control custm_input_form" style="width: 160px;" />
			<input type="button" onclick="conference_call(spoccontact.value)" id="btnsa" value="Call" class="form-control btn btn-danger" style="width:40px" />	
			</td>
			
				<td class="custm_label_txt"> Caller's Email Id</td>
		<td><input type="text" id="callerEmail" class="form-control custm_input_form" /></td>
			
			
			<td class="custm_label_txt">Responsible Department</td>
			<td><select class="form-control" id="Department" name="Department">  
				<option value=''> Select Department </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_rdepartment` WHERE `ISACTIVE`=1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['ID'];?>'><?php echo $db['Name'];?></option>
				<?php }?> 
			</select></td>
			</tr>
	   <tr>
			
		<td class="custm_label_txt">RO Remarks</td>
		<td><textarea id='remarks_ro' class="form-control custm_form_input" name='remarks_ro'></textarea></td>
		
		<td> <label class="custm_label_txt" style="padding-left: 12px;"><input type="checkbox" value="SMS" style="margin: 0px;" /> SMS </label></td>
		<td><label class="custm_label_txt" style="padding-left: 2px;"><input type="checkbox" value="EMAIL" style="margin: 0px;" /> EMAIL </label></td>
		
		<td><!--<input type="button" class="btn btn-danger" value="Submit" id="btngre" onclick="return saveSubmit();" />-->
		<button style="margin-left:-130px" class="btn btn-danger" value="Submit" id="btngre" onclick="return saveSubmit();">Submit</button>
		</td> 
		</tr>
	
	</table>
</form> 
</div>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
  } );
  </script>
  
  
  <style>
  .custm_legend{
	margin-bottom:5px !important;
}
  .custm_call_closer{
	background-color:#248aaf;
	border:1px solid #248aaf;
}
.custm_call_closer h3{
	font-size: 16px;
    font-weight: 500;
    color: #fff;
}
.custm_label_txt{
	color:#000;
	padding-left:15px;
	font-size: 14px;
}
.custm_input_form{
	margin-top:10px;
	border: 1px solid #9b9898 !important;
	margin-right:12px;
}
  
  </style>