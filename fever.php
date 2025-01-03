<?php  error_reporting(0);
require_once("dbconnect_emri.php"); 
?>


  
 
<fieldset class="fieldset1818">
<legend class="legend2334">Patient Information</legend>
<input type="checkbox" value="" onclick="return copycaller();" id="copycaller" > copy to caller information
<div>
<tr>
<input style="display:none" type="number" id="levelss" value='1' />
 
<td><b class="test1">Patient Name</b></td><td></td><td>
	  <input type="text" class="test" name="patientname"  id="patientname" />
	  </td>
	  
	  <td><b class="test1">Phone</b></td><td></td><td>
	  <input type="text" class="test" name="phone" id="callername" />
	  </td>
	  
	  
	  
	  <td><b class="test1">Land</b></td><td></td><td>
	  <input type="text" class="test"  name="land" id="land" />
	  </td>

</tr>
</div>

<div>
<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >DISTRICT</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;"  id='districtf1' name='districtf' onchange='GetRegionsfever(this.value,"1");' class="col-md-10">
					<option value=''>Select District</option>
				<?php
				$district_query	= "SELECT ds_dsid,districtname ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					//$SEL = ($Beneficiary_Details['District_ID']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."'  >".$district_details["ds_lname"]."</option>";
				 }
				?>		
			
				</select>
				</td>
	  
			<td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Block</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='tehsil1' name='tehsil1' onchange='GetRegionsfever(this.value,"2");' class="col-md-10">
				<option value=''>Select Block</option>
				<?php
					//$SEL = ($Beneficiary_Details['Taluka_ID'])?"selected":"";
					//echo  ($Beneficiary_Details['Taluka_ID'])?"<option  value='".$Beneficiary_Details['Taluka_ID']."~".$Beneficiary_Details['Taluka_Name']."'>".$Beneficiary_Details['Taluka_Name']."</option>":"<option value=''>--Pickup Tehsil--</option>";
				?>
				</select>
			</td>
	  
			<td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Village : </td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='city_name1' onchange='GetRegionsfever(this.value,"3");' name='city_name1' class="col-md-10">
				<option value=''>Select Village</option>
				<?php
					//$SEL = ($Beneficiary_Details['Village_ID'])?"selected":"";
 					//echo  ($Beneficiary_Details['Village_ID'])?"<option  value='".$Beneficiary_Details['Village_ID']."~".$Beneficiary_Details['Village_Name']."' >".$Beneficiary_Details['Village_Name']."</option>":"<option value=''>--Pickup City--</option>";
				?>
			</select>
			</td>
	  
	  <td><b class="test1">Area</b>
	  <select style="font-family:arial;font-size:15px;color:black;width:150px;" onchange='GetRegionsfever(this.value,"5");'  id='agency_id1' name='agency_id1' class="col-md-10">
				<?php
					//$SEL = ($Beneficiary_Details['Village_ID'])?"selected":"";
 					//echo  ($Beneficiary_Details['Village_ID'])?"<option  value='".$Beneficiary_Details['Village_ID']."~".$Beneficiary_Details['Village_Name']."' >".$Beneficiary_Details['Village_Name']."</option>":"<option value=''>--Pickup City--</option>";
				?>
			</select>
	  </td>

</tr>
</div>
<br/>
<div>
<tr>
<td><b class="test1">Landmark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
	  <input type="text"  class="test" name="landmark"  id="landmark" />
	  </td>
	  
			<td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Gender</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='genderf' name='genderf' onchange='GetRegions(this.value,"2");' class="col-md-10">
	<option value=''>Select Gender</option>
	<option value='M'>Male</option>
	<option value='F'>Female</option>
	<option value='T'>Transgender</option>
	
				</select>
			</td>
	  
	  <td><b class="test1">Age</b>
	  <input type="text"  class="test" name="age1" id="age1" />
	  </td>
	  

</tr>
</div>

</fieldset>


<tr><td rowspan="2">

<td><fieldset class="fieldset1820">
<legend class="legend2334">Clinical Information</legend>
<div><tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Cheif Complaint</td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='cheifcomplaintf' name='cheifcomplaintf' class="col-md-10">
		<option value=''>Select Complaint</option>
				<?php
			$call_type = "SELECT ID, Name FROM m_complaintstype WHERE ISACTIVE=1 ORDER BY Name ASC ;";
			$call_type_result = mysql_query($call_type);
			while($call_type_details = mysql_fetch_array($call_type_result))
			 {?>
	<option value='<?=$call_type_details["ID"];?>~<?=$call_type_details["Name"];?>'><?=$call_type_details["Name"];?></option>
			 <?php }?>
			</select>
			</td>
	  	  <td><b class="test1">Fever Since</b>
	  <input type="text" class="test" name="feversince" id="feversince" />
	  </td>
	  
	  </tr></div>
<div id="checkboxes"><tr>
   <td>
 <ul>
 <li><b class="test1">Other Complaints If</b></li>
    <li><input name="complaintf" id="complaintf" type="checkbox">&nbsp;Altered Conscoiusness</li>
    <li><input name="complaintf"  type="checkbox">&nbsp;Anemia</li>
    <li><input name="complaintf"  type="checkbox">&nbsp;Arthralgia</li>
    <li><input name="complaintf"  type="checkbox">&nbsp;BackAche</li>
	<li><input name="complaintf"  type="checkbox">&nbsp;Bleeding(Internal Organs)</li>
  </ul></td></tr>
</div>
	  </td>
	  </tr>
</fieldset></td>


<td><fieldset class="fieldset1819">
<legend class="legend2334">Agency Information</legend>
	  <div><tr>			
	 
			
	  <td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Agency Name</td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
			<select style="font-family:arial;font-size:15px;color:black;width:150px;" onchange="getPhoneno(this.value);" id='agencyassignedf1' name='agencyassignedf1' class="col-md-10">
			<option >Select Agency</option>
			</select>
			</td>
			
	 <td><b class="test1">Agency Contact Number </b>
	  <input type="text" class="test" name="agencycontact" id="agencycontact" />
	  </td>
	<td> <button  value="Call" onclick='return conCall();' id='conferencecall' >Call</button></td>
	  </tr>
	  <tr>
	  	  <td><b class="test1">Agency Assigned Date&Time </b>
	  <input type="text" class="test" name="agencyassignedtime" value="<?php echo date('d-m-Y H:i:s');?>" id="agencyassignedtime" />
	  </td>
	  </tr>
	  </div>
 <br/>
 <div>
<tr>
<td>
<input type="radio" class = "radionew" name="ccsradio" id="assigned" onclick="return ass();" value = "1" /><b id="" class="radio" >Assigned</b>
</td>
<td>
<input type="radio" class = "radionew" name="ccsradio" id="notassigned" onclick="return ass();" checked value = "2" /><b class="radio" >Not Assigned</b>
</td>

	  <td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Reason</td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='reason' name='reason' class="col-md-10">
				
				<?php
			$call_type = "SELECT `reason_id`,`reason_name` FROM `m_agency_try_reason` WHERE isactive=1;;";
			$call_type_result = mysql_query($call_type);
			while($call_type_details = mysql_fetch_array($call_type_result))
			 {?>
	<option value='<?=$call_type_details["reason_id"];?>~<?=$call_type_details["reason_name"];?>'><?=$call_type_details["reason_name"];?></option>
			 <?php }?>
			</select>
			</td>
	  <td><input type="checkbox">&nbsp;Assign To 108 </td>
	  
	  <td><button type="button" id="btnnextagency" onclick = 'assigned();'>Next Agency</button></td>
	 
	 <td>
<button type="button" style="display:none" id="btnnextagency1" onclick = 'assigned();'>Busy</button></td>
</tr></div>

<div><tr>
<td><b class="test1">Call Remarks</b>
<textarea class="textarea4343" cols="50" rows="2" id="remarks" maxlength="250" ></textarea></td>
	
</tr>
</fieldset></td>

</td></tr></div>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="scripts/main_validation.js"></script>
<script>


function assigned()
{
	var agencyassignedf1	= document.getElementById('agencyassignedf1').value;
	if(agencyassignedf1 == "")	
	  {
		showAlert();
		document.getElementById('agencyassignedf1').focus();
		return false;
	  }
	
	var cheifcomplaintf	= document.getElementById('cheifcomplaintf').value;
	if(cheifcomplaintf == "")
	 {
		showAlert();
		document.getElementById('cheifcomplaintf').focus();
		return false;
	 }
	
	 var xmlHttp=newHttpObject(); 
		
		if(xmlHttp)
		 { 
			var cheifcomplaintf = document.getElementById('cheifcomplaintf').value;
			var feversince	   = document.getElementById('feversince').value;
			var agencyassignedf1 = document.getElementById('agencyassignedf1').value;
			var remarks = document.getElementById('remarks').value;
			var callid 	   = document.getElementById('callid').innerHTML;
			var agencycontact = document.getElementById('agencycontact').value;
			var complaintf = document.getElementById('complaintf').value;
			var reason = document.getElementById('reason').value;
			var area_id = document.getElementById('agency_id1').value;
			var levels = $('#levelss').val();
			//var area_id = document.getElementById('agency_id1').value;
			
			var notassigned = document.getElementById('notassigned').value;
			var assigned = document.getElementById('assigned').value;
			
			if(document.getElementById("assigned").checked)
			 {
				var ass = document.getElementById("assigned").value;
			 }
			else  
			 {
				var ass = document.getElementById("notassigned").value;
			 }
		//alert(levels);
			var callQuery = "type=fever104assignment&levels="+levels+"&area_id="+area_id+"&reason="+reason+"&complaintf="+complaintf+"&ass="+ass+"&callid="+callid+"&agencycontact="+agencycontact+"&remarks="+remarks+"&cheifcomplaintf="+cheifcomplaintf+"&feversince="+feversince+"&agencyassignedf1="+agencyassignedf1;
			//alert(callQuery); return false;
			xmlHttp.open("POST","save_Beneficiary_Details.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText;
                    //document.getElementById("hospitals_list").innerHTML=Response;   
					
					if(ass ==1)
					{
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>&disposition=6";
									 
						postURL(end_call_url,"false");
					}
					else
					{
						document.getElementById("agencyassignedf1").innerHTML=Response;	
						 var number  =  parseInt(levels)+1; 
						 //alert(number);
						$('#levelss').val(number);
					}
					
			 	 }
		 	 }
	 	 }
		delete xmlHttp;		 
	  
}



function ass()
{
	if($('#assigned').is(":checked"))
	{
		$('#btnnextagency').html('Assign & Close');
	}
	if($('#notassigned').is(":checked"))
	{
		$('#btnnextagency').html('Next Agency');
	}
}

function copycaller()
{
	if($('#copycaller').is(":checked"))
	{
		$('#patientname').val($('#beneficiary_name').val());
		$('#land').val($('#ano').val());
		$('#landmark').val($('#address').val());
		$('#age1').val($('#age').val());
		$('#callername').val($('#phone_number_val').val());
		//$('#land').val($('#phone_number_val').val());
		
		var v= $('#tehsil option:selected').val();
		var t= $('#tehsil option:selected').text();
		$("#tehsil1 option[value='']").remove();
		$('#tehsil1').append('<option value='+v+'>'+t+'</option>');
		
		var v= $('#city_name option:selected').val();
		var t= $('#city_name option:selected').text();
		$("#city_name1 option[value='']").remove();
		$('#city_name1').append('<option value='+v+'>'+t+'</option>');

		
		$('#districtf1').val($('#district').val());
		var dd= $('input[name=Gender]:checked').val();
		$('#genderf').val(dd);
		GetRegionsfever(v,"3");
		//$('#patientname').val($('#beneficiary_name').val());
		//$('#patientname').val($('#beneficiary_name').val());
	}
	else
	{
		$('#patientname').val($('#beneficiary_name').val());
	}
}


function conCall()
{ 
	var vehicle_phone_number=document.getElementById("agencycontact").value;
	var callid =document.getElementById('callid').innerHTML; 
    openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php?callid="+callid+"&vehicle_phone_number="+vehicle_phone_number,"Conference_Call","width=420,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");                            
    //openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php?callid="+callid+"&vehicle_phone_number="+vehicle_phone_number,"Conference_Call","width=380,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");
return false;
}

</script>




  