<?php

require_once("dbconnect_emri.php");

$CALL_TYPE_ARRAY = array();
$call_type_query = "SELECT call_type_id, call_type_name FROM m_call_type  WHERE is_active=1;";
$call_type_result = mysql_query($call_type_query);
while($call_type_details = mysql_fetch_array($call_type_result))
 {
	$CALL_TYPE_ARRAY[$call_type_details["call_type_id"]] = $call_type_details["call_type_name"];	
 }
$phone_number = $_POST["phone_number"];
$current_date = date("Y-m-d");

$Query ="SELECT `Agency_id`,`District_id`,`districtname`,`Mandal_id`,`md_lname` `mandal`,`Agency_Name`,`Mobile`,`Level_No`  `level`,`email_id`
FROM `m_grivence_details`
LEFT JOIN `m_district` ON `m_district`.`ds_dsid`  = m_grivence_details.District_id
LEFT JOIN `m_mandal` ON `m_mandal`.`md_mdid`=m_grivence_details.Mandal_id
 WHERE isactive=1  limit 10;";

$Result = mysql_query($Query);

?>
<html>
<head>
        <link href="css/bootstrap.min.css" rel="stylesheet" />   
        <link href="css/custom.css" rel="stylesheet" />

	<style>
        
	.main 
	 {
		width: 1000px;
		padding-bottom: 0px;
		border-top: 0px;
		background-color: #FDFDFD;
		margin-left: auto;
		margin-right: auto;
		min-height: 412px;
		height: auto !important;
		box-shadow: 0 3px 3px rgba(104, 104, 104, 0.25);
		margin-top: 15px;
		margin-bottom: 15px;
	 }

	</style>

	<script src="js/jquery-1.10.2.min.js"></script>
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
		
	function saveUpdateDeleteShow(ID)
	{
		$('#edit_'+ID).hide();
		$('#sub_'+ID).show();
	}	
		
		
	function GetRegions(ID,index)
	 {
		var xmlHttp=newHttpObject();
        $('.all').hide();
		
		var v= ID.split('~');
		if(xmlHttp)
		 {
			if(index == 1)
			 {
				var callQuery = "action=Mandals&district_id="+ID;
				$('.did_'+v[0]).show();
			 }
			else  
			 {
				var callQuery = "action=Villages&mandal_id="+ID;
				$('.mand_'+v[0]).show();
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
						document.getElementById("tehsil").innerHTML=Response; 
					 }
					 
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 
	 
	 function saveUpdateDelete(ID,T)
	 {
		var xmlHttp=newHttpObject();
       
		if(xmlHttp)
		 {
			
			var mobile= $('#mobile_'+ID).val();	
			var email= $('#email_'+ID).val();	
			var callQuery = "action="+T+"&ID="+ID+"&email="+email+"&mobile="+mobile;
						 
			xmlHttp.open("POST","get_grivence_updatedelete.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText;
					
					 if(T==1) 
					 {
						 $('#edit_'+ID).show();
						$('#sub_'+ID).hide();
					 }
					 else
					 {
						  $('.id_'+ID).hide();
					 }
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 
	</script>
</head>
<body>
	<div class="container">
	<div class="x_content" style="margin-top: 12px;">
	<div class="form-group">
	<table>
	<tr>
		<td><select class="form-control" style="font-family:arial;"  id='district' name='district' onchange='GetRegions(this.value,"1");' class="form-control" >
					<option value=''>Select District</option>
				<?php
				$district_query	= "SELECT ds_dsid,districtname ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					//$SEL = ($Beneficiary_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."' $SEL >".$district_details["ds_lname"]."</option>";
				 }
				?>		
			
				</select></td>
				<td>
				
				<select class="form-control" style="font-family:arial;" id='tehsil' name='tehsil' onchange='GetRegions(this.value,"2");' class="form-control">
		<!--		<option value=''>Select Tehsil</option>-->
				<?php
				$district_query	= "SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid=".$Beneficiary_Details['district_id']." ORDER BY md_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					 
					$SEL = ($Beneficiary_Details['block_id'])?"selected":"";
					echo  ($district_details['md_mdid'])?"<option  value='".$district_details['md_mdid']."~".$district_details['md_lname']."'$SEL>".$district_details['md_lname']."</option>":"<option value=''>--Pickup Taluka--</option>";
				 }
				?>	
				</select>
				</td>
				</table>
	<?php
	echo "<table class='table table-bordered table-hover table-striped'>";
	echo "<thead><tr>";
		echo "<th nowrap>Sno</th>";
		echo "<th nowrap>districtname</th>";
		echo "<th nowrap>mandal</th>";
		echo "<th nowrap>Agency Name</th>";
		echo "<th nowrap>level</th>";
		echo "<th nowrap>Mobile</th>"; 
		echo "<th nowrap>email id</th>"; 
		echo "<th nowrap>Options</th>"; 
	echo "</tr></thead>";

	if(mysql_num_rows($Result) > 0)
	 {
		$sno = 1;
		while($Details = mysql_fetch_array($Result))
		 {
			echo "<tr class='all id_".$Details["Agency_id"]." did_".$Details["District_id"]." mand_".$Details["Mandal_id"]."'>";
				echo "<td>".$sno."</td>";
				echo "<td>".$Details["districtname"]."</td>";
				echo "<td>".$Details["mandal"]."</td>";
				//echo "<td>".$Details["beneficiary_name"]."</td>";
				echo "<td>".$Details["Agency_Name"]."</td>";
				echo "<td>".$Details["level"]."</td>";
				echo "<td><input type='text' value=".$Details["Mobile"]." id='mobile_".$Details["Agency_id"]."' /></td>";
				echo "<td><input type='text' value=".$Details["email_id"]." id='email_".$Details["Agency_id"]."' /></td>";
				echo "<td><input onclick='return saveUpdateDelete(".$Details["Agency_id"].",1)' type='button' id='sub_".$Details["Agency_id"]."' class='btn-warm' value='Submit' style='display:none' /><input type='button' class='btn-success' id='edit_".$Details["Agency_id"]."' onclick='return saveUpdateDeleteShow(".$Details["Agency_id"].");' value='Edit' /> <input onclick='return saveUpdateDelete(".$Details["Agency_id"].",2)' type='button' class='btn-danger' value='Delete' /></td>";
				//echo "<td>".$Details["block_name"]."</td>";
				//echo "<td>".$Details["village_name"]."</td>";
			echo "</tr>";
			$sno++;
	 	 }
 	 }
	else
	 {
		echo "<tr><td colspan='16' align='center' ><font color='red' size=2><b>No Records Found</b></font></td></tr>";
	 } 
	echo "</table>";
	
?>
</div>
</body>
</html>
