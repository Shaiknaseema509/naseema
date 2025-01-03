<?php  error_reporting(0);
require_once("dbconnect_emri.php"); 
?>


  
 
<fieldset class="fieldset1818">
<legend class="legend2334">Patient Information</legend>
<div>
<tr>

 
<td><b class="test1">Patient Name</b></td><td></td><td>
	  <input type="text" class="test" name="patientname"  id="patientname" />
	  </td>
	  
	  <td><b class="test1">Phone</b></td><td></td><td>
	  <input type="text" class="test" name="phone" id="callername" />
	  </td>
	  
	  <td><b class="test1">STD</b></td><td></td><td>
	  <input type="text" class="test"  name="std" id="std" />
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
				<select style="font-family:arial;font-size:15px;color:black;width:150px;"  id='districtf' name='districtf' onchange='GetRegions(this.value,"1");' class="col-md-10">
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
	  
			<td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >TEHSIL</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='tehsilf' name='tehsilf' onchange='GetRegions(this.value,"2");' class="col-md-10">
		<!--<option value=''>Select Tehsil</option>-->
				<?php
					//$SEL = ($Beneficiary_Details['Taluka_ID'])?"selected":"";
					echo  ($Beneficiary_Details['Taluka_ID'])?"<option  value='".$Beneficiary_Details['Taluka_ID']."~".$Beneficiary_Details['Taluka_Name']."'>".$Beneficiary_Details['Taluka_Name']."</option>":"<option value=''>--Pickup Tehsil--</option>";
				?>
				</select>
			</td>
	  
			<td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Village : </td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='city_namef' name='city_namef' class="col-md-10">
				<?php
					//$SEL = ($Beneficiary_Details['Village_ID'])?"selected":"";
 					echo  ($Beneficiary_Details['Village_ID'])?"<option  value='".$Beneficiary_Details['Village_ID']."~".$Beneficiary_Details['Village_Name']."' >".$Beneficiary_Details['Village_Name']."</option>":"<option value=''>--Pickup City--</option>";
				?>
			</select>
			</td>
	  
	  <td><b class="test1">Area</b>
	  <input type="text" class="test" name="area" id="area" />
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
	<option value='1'>Male</option>
	<option value='2'>Female</option>
	
				</select>
			</td>
	  
	  <td><b class="test1">Age</b>
	  <input type="text"  class="test" name="age" id="age" />
	  </td>
	  
	  <td><b class="test1">City Type</b>
	  <input type="text" class="test" name="citytype" id="citytype" />
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
    <li><input type="checkbox">&nbsp;Altered Conscoiusness</li>
    <li><input type="checkbox">&nbsp;Anemia</li>
    <li><input type="checkbox">&nbsp;Arthralgia</li>
    <li><input type="checkbox">&nbsp;BackAche</li>
	<li><input type="checkbox">&nbsp;Bleeding(Internal Organs)</li>
  </ul></td></tr>
</div>
	  </td>
	  </tr>
</fieldset></td>


<td><fieldset class="fieldset1819">
<legend class="legend2334">Agency Information</legend>
	  <div><tr>			
	<!--  <td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Agency Assigned</td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='agencyassignedf' name='agencyassignedf' class="col-md-10">
				<?php
					$SEL = ($Beneficiary_Details['Village_ID'])?"selected":"";
 					echo  ($Beneficiary_Details['Village_ID'])?"<option  value='".$Beneficiary_Details['Village_ID']."~".$Beneficiary_Details['Village_Name']."' $SEL>".$Beneficiary_Details['Village_Name']."</option>":"<option value=''>--Pickup Cheif Complaint--</option>";
				?>
			</select>
			</td>-->
			
	  <td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Agency Name</td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
			<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='agencyassignedf' name='agencyassignedf' class="col-md-10">
			<option value="">Select Agency Name</option>

			<?php
			$call_type = "SELECT `Agency_id`, `Agency_Name` FROM `m_agency_details` WHERE isactive=1 ORDER BY Agency_Name ASC ;";
			$call_type_result = mysql_query($call_type);
			while($call_type_details = mysql_fetch_array($call_type_result))
			 {?>
	<option value='<?=$call_type_details["Agency_id"];?>~<?=$call_type_details["Agency_Name"];?>'><?=$call_type_details["Agency_Name"];?></option>
			 <?php }?>
			</select>
			</td>
			
	 <td><b class="test1">Agency Contact Number </b>
	  <input type="text" class="test" name="agencycontact" id="agencycontact" />
	  </td>
	  
	  	  <td><b class="test1">Agency Assigned Date&Time </b>
	  <input type="text" class="test" name="agencyassignedtime" id="agencyassignedtime" />
	  </td>
	  </tr>
	  </div>
 <br/>
 <div>
<tr>
<td>
<input type="radio" class = "radionew" name="ccsradio" id="assigned" value = "1" /><b id="" class="radio" >Assigned</b>
</td>
<td>
<input type="radio" class = "radionew" name="ccsradio" id="notassigned" value = "2" /><b class="radio" >Not Assigned</b>
</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;

	  <td align='right' style="font-family:arial;font-size:15px;color:black;width:150px;" >Reason</td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;width:150px;">
				<select style="font-family:arial;font-size:15px;color:black;width:150px;" id='reason' name='reason' class="col-md-10">
				<?php
					$SEL = ($Beneficiary_Details['Village_ID'])?"selected":"";
 					echo  ($Beneficiary_Details['Village_ID'])?"<option  value='".$Beneficiary_Details['Village_ID']."~".$Beneficiary_Details['Village_Name']."' $SEL>".$Beneficiary_Details['Village_Name']."</option>":"<option value=''>--Pickup Cheif Complaint--</option>";
				?>
			</select>
			</td>
	  <td><input type="checkbox">&nbsp;Assign To 108 </td>
	  
	  <td>
<button type="button" id="btnnextagency" onclick = 'ccssubmit();'>Next Agency</button></td>
	  <td>
<button type="button" id="btnnextagency" onclick = 'ccssubmit();'>Busy</button></td>
</tr></div>

<div><tr>
<td><b class="test1">Call Remarks</b>
<textarea class="textarea4343" cols="50" rows="2" id="remarks" maxlength="250" onkeypress="return blockSpecialChar(event)" ></textarea></td>
	
</tr>
</fieldset></td>

</td></tr></div>
 
<script>
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

			//alert(callQuery);
			xmlHttp.open("POST","get_region.php",true);
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
						document.getElementById("tehsilf").innerHTML=Response;
						document.getElementById("city_namef").innerHTML="<option value=''>-- Pickup City/Village --</option>";
					 }
					else if(index == 2)
					 {
						document.getElementById("city_namef").innerHTML=Response;	
					 }
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
</script>
<style>
.test1{
  color: #4C5A63;
  font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
  font-size: 16px;
}

.fieldset1818
{
margin: 8px;
width: auto;
border-radius: 10px;
 padding: 7px;
 border-width:4px;
 border-color: 	#2F4F4F;
height: 187px;
border:2px #2c528a solid;
}
 
.fieldset1819
{
margin: 8px;
width: auto;
border-radius: 10px;
 padding: 7px;
 border-width:4px;
 border-color: 	#2F4F4F;
height: 187px;
border:2px #2c528a solid;
}


.fieldset1820
{
margin: 8px;
width: auto;
border-radius: 10px;
 padding: 7px;
 border-width:4px;
 border-color: 	#2F4F4F;
 height: 146px;
border:2px #2c528a solid;
}

.legend2334 {

    display: block;
    width: 22%;
    padding: 0;
    margin-bottom: .5rem;
    font-size: 1.5rem;
    line-height: inherit;

}

.textarea4343{
	width:50%;
	height: 38px;
	resize: both;
}

.radionew
{
color: #4C5A63;
font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
font-size: 16px;
	
}


</style>