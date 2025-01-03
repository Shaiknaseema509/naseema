<?php  error_reporting(0);
require_once("dbconnect_emri.php"); ?>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    


<form name="Grievance" id="Grievance" method="POST" action="" >



<div id='mh' style='border:0px solid green;'>
<div id='mhinfo' class="col-md-12" style="background: radial-gradient(ellipse farthest-corner at center center, rgba(0,0,0,0.5) 20%, rgba(0,0,0,0.85) 100%) repeat scroll 0% 0%; ">
 <fieldset>
                    <legend>
                        <button type="button"style="width:100%;font-size:17px;font-style:bold" class="btn btn-info ribbon">Health Information</button>
                    </legend>
<table   width="100%"  border="0" >
 
<tr > 
<td colspan=4>
	 
	<table width="100%" cellspacing="1" cellpadding="1" border="1">
	<tbody>
	<tr>
		<td>
			<select  id='sub_directory' name='sub_directory' onchange='GetRegions1(this.value,"6");'>
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
			
			<td>
			<select  id='cat_sub_directory' name='cat_sub_directory' >
				<option value=''>Select sub Directory</option>
		 
			</select>	
			</td>	
			
		</tr>
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
			
			 
			 
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='tehsil1' name='tehsil1' onchange='GetRegions1(this.value,"2");' class="col-md-10">
		<!--		<option value=''>Select Tehsil</option>-->
				<?php
					$SEL = ($Beneficiary_Details['Taluka_ID'])?"selected":"";
					echo  ($Beneficiary_Details['Taluka_ID'])?"<option  value='".$Beneficiary_Details['Taluka_ID']."~".$Beneficiary_Details['Taluka_Name']."'$SEL>".$Beneficiary_Details['Taluka_Name']."</option>":"<option value=''>--Pickup Taluka--</option>";
				?>
				</select>
			</td>
		  
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='city_name1' name='city_name1' class="col-md-10">
				<?php
					$SEL = ($Beneficiary_Details['Village_ID'])?"selected":"";
 					echo  ($Beneficiary_Details['Village_ID'])?"<option  value='".$Beneficiary_Details['Village_ID']."~".$Beneficiary_Details['Village_Name']."' $SEL>".$Beneficiary_Details['Village_Name']."</option>":"<option value=''>--Pickup City--</option>";
				?>
			</select>
			</td>
		
		 
			
<!--			<td><input type="button" class="btn btn-warning" value="Seach" onclick="GetHospitalsList(sub_directory.value,District.value);" ></td>-->
			<td><input type="button" class="btn btn-warning" value="Search" onclick="SaveInformationDirectory(sub_directory.value,District.value);" ></td>
			
		</tr>	 
		</tbody>
		</table> 
		
		
		 <div id="hospitals_list" style="max-height:300px; max-width:868px; overflow-y:scroll">
		 </div>
		
		
		
		</div>
		 
		</div>
		 

</form> 
