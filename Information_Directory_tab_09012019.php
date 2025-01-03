<?php  error_reporting(0);
require_once("dbconnect_emri.php"); ?>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

   

<script src="scripts/main_validation.js"></script>
<script>
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
function GetRegions1(ID,index)
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
				var callQuery = "action=GetAgency&area_id="+ID;
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
						document.getElementById("tehsil1").innerHTML=Response;
						document.getElementById("city_name1").innerHTML="<option value=''>-- Pickup City/Village --</option>";
					 }
					else if(index == 2)
					 {
						document.getElementById("city_name1").innerHTML=Response;	
					 }
					 else if(index == 3)
					 {
						document.getElementById("agency_id").innerHTML=Response;	
					 }
					 else if(index == 5)
					 {
						document.getElementById("agencyassignedf").innerHTML=Response;	
					 }
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 </script>
 
 


<form name="Grievance" id="Grievance" method="POST" action="" >
<div id='mh' style='border:0px solid green;'>
<div id='mhinfo' style='border:0px solid red;'>
<table   width="100%"  border="0" >
<tr bgcolor="#000080"> 
<th colspan="4" id="mhtitle"><font color="white" family="arial" size="3px"><center>सरकारी योजना स्क्रीन</center></font></th>
</tr>
<tr > 
<td colspan=4>
	 
	<table width="100%" cellspacing="1" cellpadding="1" border="1">
	<tbody>
	<tr>
		<td> 
		<span id="district_span" name="district_span">
				<select id='District' name='District' onchange='GetRegions1(this.value,"1");' >
					<option value=''>Select District</option>
				<?php
				mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8',
				character_set_database = 'utf8', character_set_server = 'utf8'");
				$district_query	= "SELECT ds_dsid,ds_lname,districtname FROM m_district WHERE is_active=1 ORDER BY districtname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($Beneficiary_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["districtname"]."'>".$district_details["districtname"]."</option>";
				 }
				?>	
				</select></span>
			</td>
			
			 
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Taluka/Block: </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='tehsil1' name='tehsil1' onchange='GetRegions1(this.value,"2");' class="col-md-10">
		<!--		<option value=''>Select Tehsil</option>-->
				<?php
					$SEL = ($Beneficiary_Details['Taluka_ID'])?"selected":"";
					echo  ($Beneficiary_Details['Taluka_ID'])?"<option  value='".$Beneficiary_Details['Taluka_ID']."~".$Beneficiary_Details['Taluka_Name']."'$SEL>".$Beneficiary_Details['Taluka_Name']."</option>":"<option value=''>--Pickup Taluka--</option>";
				?>
				</select>
			</td>
		 <td align='right' style="font-family:arial;font-size:15px;color:black;" >Village/City: </td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='city_name1' name='city_name1' class="col-md-10">
				<?php
					$SEL = ($Beneficiary_Details['Village_ID'])?"selected":"";
 					echo  ($Beneficiary_Details['Village_ID'])?"<option  value='".$Beneficiary_Details['Village_ID']."~".$Beneficiary_Details['Village_Name']."' $SEL>".$Beneficiary_Details['Village_Name']."</option>":"<option value=''>--Pickup City--</option>";
				?>
			</select>
			</td>
		
		 <td>
			<select  id='sub_directory' name='sub_directory' >
			<option value=''>Select Directory</option>
		 <?php        $i=0;         
                $stmtVILL="SELECT directory_id,directory_name,QueryName FROM m_hospital_health_facilities_directory where is_active=1 ORDER BY directory_id desc;";
                $resultVILL=mysql_query($stmtVILL);
                while($row=mysql_fetch_array($resultVILL))
                {$i++;?>         		 		 
				  <option value='<?php echo $row["directory_id"];?>'><?php echo $row["directory_name"];?></option>
				<?php }  ?>
			</select>	
			</td>	
			
<!--			<td><input type="button" class="btn btn-warning" value="Seach" onclick="GetHospitalsList(sub_directory.value,District.value);" ></td>-->
			<td><input type="button" class="btn btn-warning" value="Search" onclick="SaveInformationDirectory(sub_directory.value,District.value);" ></td>
			
		</tr>	 
		</tbody>
		</table> 
		
		
		 <div id="hospitals_list">
		 </div>
		
		
		
		</div>
		 
		</div>
		 

</form> 
