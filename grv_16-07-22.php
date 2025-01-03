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
	 var Designation	= document.getElementById('Designation').value;
	if(Designation == "")	
	  {
		showAlert();
		document.getElementById('Designation').focus();
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
	  
	  var callQuery="type=SaveBeneficiary&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&spoccontact="+spoccontact+"&sEmail="+sEmail+"&Facility="+Facility+"&spocname="+spocname+"&city_name1="+city_name1+"&tehsil1="+tehsil1+"&rdate="+rdate+"&District="+District+"&call_id="+call_id+"&noc="+noc+"&Designation="+Designation+"&complaintagainst="+complaintagainst+"&goc="+goc+"&Compliant="+Compliant+"&facility_name="+facility_name;
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
<div class="col-md-12" style="color:white; padding:5px;background: radial-gradient(ellipse farthest-corner at center center, rgba(0,0,0,0.5) 20%, rgba(0,0,0,0.85) 100%) repeat scroll 0% 0%; "> 
	<form >
	  <div class="form-group">
                <fieldset> <legend>
                            <button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Grievance</button>
                        </legend>
						</fieldset>
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		 
		<tr>
			<td>Compliant</td>
			<td>			
			<select class="form-control" id="Compliant">
				<option value=''> Select Complaint </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_complaintstype` WHERE `ISACTIVE`=0;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['ID'];?>'><?php echo $db['Name'];?></option>
				<?php }?>
			</select>			
			</td>			
			<td> Gist of Complaint</td>
			<td><input class="form-control" type="text" id="goc" /></td>
		</tr>
		<tr>
			<td>Complaint Against</td>
			<td><input class="form-control" type="text" id="complaintagainst" /></td>			
			<td> Designation</td>
			<td><select class="form-control" id="Designation" name="Designation">  
				<option value=''> Select Designation </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_designation` WHERE `ISACTIVE`=1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['ID'];?>'><?php echo $db['Name'];?></option>
				<?php }?> 
			</select></td>
		</tr>
		<tr>
			<!--<td>Institute</td>
			<td><select id="Institute" class="form-control" name="Institute" >
			<option value=''> Select Institute </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_institute` WHERE `ISACTIVE`=1 order by `Name` asc;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['ID'];?>'><?php echo $db['Name'];?></option>
				<?php }?> </select></td>	-->		
			<td>Nature of Compliant</td>
			<td> 
			<select class="form-control" id="noc">
				<option value=''> Select Complaint </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_complaintstype` WHERE `ISACTIVE`=1;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['ID'];?>'><?php echo $db['Name'];?></option>
				<?php }?>
			</select>
			</td>
		</tr>
		<tr>
			<td>Facility Type</td>
			<td><select id="Facility" class="form-control" name="Facility" >
			<option value=''> Select Facility </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_facility` WHERE `ISACTIVE`=1 order by `Name` asc;");
				while($db = mysql_fetch_array($query)){?>
				<option value='<?php echo $db['ID'];?>'><?php echo $db['Name'];?></option>
				<?php }?> </select></td> 
			<td>Facility</td>
			<td><select id="facility_name" class="form-control" name="facility_name" onchange='GetRegions(this.value,"5");' >
			<option value=''> Select Facility </option>
			</td> 
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
					$SEL = ($Beneficiary_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."' $SEL >".$district_details["ds_lname"]."</option>";
				 }
				?>	
			</select></td>			
			<td> Reference Date</td>
			<td><input type="text" class="form-control datepicker"  id="rdate" /></td>
		</tr>
		<tr>
			<td>Taluka</td>
			<td><select id="tehsil1" class="form-control" onchange='GetRegions(this.value,"2");'></select></td>			
			<td> Village</td>
			<td><select id="city_name1" class="form-control" onchange='GetRegions(this.value,"6");' ></select></td>
		</tr>
		 
		<tr>
			<td>SPOC Name</td>
			<td><select id="spocname" style="width:190px" class="form-control" onchange="return spoccontactName(this.value);">
			 
			</select></td>			
			<td> SPOC Contact</td>
			<td><input type="text" id="spoccontact" class="form-control" style="width:160px" />
			<input type="button" onclick="conference_call(spoccontact.value)" id="btnsa" value="Call" class="form-control btn btn-danger" style="width:40px" />	
			</td>
		</tr>	
		
		<tr>
		    <td> SPOC Email</td>
			<td>
			    <input type="text" id="sEmail" class="form-control" style="width:160px" />
			</td>
			<td> 
			    <label style="float:left">
				   <input type="checkbox" value="SMS" /> SMS
				</label>
				<label>
				   <input type="checkbox" value="EMAIL" /> EMAIL
				</label>
			</td>
			<td   align="right"> <input type="button" class="btn btn-danger" value="Submit" id="btngre" onclick="return saveSubmit();" /></td> 
		</tr>
	
	
	</table>
</form> 
</div>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
  } );
  </script>