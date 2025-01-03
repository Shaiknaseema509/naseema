<?php 
require_once("dbconnect_emri.php"); 
//$ID = $_REQUEST['ID'];  


  ?>
<title>GVK EMRI </title>  
  
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/moment-with-locales.js"></script>
	<script src="js/bootstrap-datetimepicker.js"></script>
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
	
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
				var callQuery = "action=GetAgency&mandal_id="+ID;
			 }
			 else if(index == 6)
			 {
				 $("#spocname").empty(); 
				var callQuery = "action=GetAgencyLevel2&mandal_id="+ID;
			 }
			 else if(index == 6)
			 {
				 $("#spocname").empty(); 
				var callQuery = "action=GetAgencyLevel2&mandal_id="+ID;
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
 					else if(index == 6)
					 {
						document.getElementById("spocname").innerHTML=Response;	
					 } 
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
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
		
		document.getElementById('Compliant').focus();
		return false;
	  }
	var goc	= document.getElementById('goc').value;
	if(goc == "")	
	  {
		
		document.getElementById('goc').focus();
		return false;
	  }  
	 var complaintagainst	= document.getElementById('complaintagainst').value;
	if(complaintagainst == "")	
	  {
		
		document.getElementById('complaintagainst').focus();
		return false;
	  }  
	  
	 // var industryname	= document.getElementById('industryname').value;
	//if(industryname == "")	
	  //{
		
		//document.getElementById('industryname').focus();
		//return false;
	 // }  
	  
	 var Designation	= document.getElementById('Designation').value;
	if(Designation == "")	
	  {
		
		document.getElementById('Designation').focus();
		return false;
	  } 
	 var Institute	=1; // document.getElementById('Institute').value;
	/*if(Institute == "")	
	  {
		
		document.getElementById('Institute').focus();
		return false;
	  }  */
	  
	  var noc	= document.getElementById('noc').value;
	if(noc == "")	
	  {
		
		document.getElementById('noc').focus();
		return false;
	  }   
		
	  var District	= document.getElementById('District').value;
	if(District == "")	
	  {
		
		document.getElementById('District').focus();
		return false;
	  }   
		
	 var rdate	= document.getElementById('rdate').value;
	if(rdate == "")	
	  {
		
		document.getElementById('rdate').focus();
		return false;
	  }   
	var tehsil1	= document.getElementById('tehsil1').value;
	if(tehsil1 == "")	
	  {
		
		document.getElementById('tehsil1').focus();
		return false;
	  } 
	var city_name1	= document.getElementById('city_name1').value;
	if(city_name1 == "")	
	  {
		
		document.getElementById('city_name1').focus();
		return false;
	  } 
		
	var spocname	= document.getElementById('spocname').value;
	
	if(spocname == "")	
	  {
		
		document.getElementById('spocname').focus();
		return false;
	  } 


	var spocremarks	= document.getElementById('spocremarks').value;
	var escalationremarks	= document.getElementById('escalationremarks').value;	
	var remarks	= document.getElementById('remarks').value;	
	var status	= document.getElementById('status').value;	
	var escalationID	= document.getElementById('escalationID').value;	
	  
	  var callQuery="type=updategreven&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&spocname="+spocname+"&city_name1="+city_name1+"&tehsil1="+tehsil1+"&rdate="+rdate+"&District="+District+"&call_id="+call_id+"&noc="+noc+"&Institute="+Institute+"&Designation="+Designation+"&complaintagainst="+complaintagainst+"&goc="+goc+"&Compliant="+Compliant;
	
	  callQuery +="&escalationID="+escalationID+"&status="+status+"&remarks="+remarks+"&escalationremarks="+escalationremarks+"&spocremarks="+spocremarks;	
	
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
						$('.alert_content').html('Please Add Beneficiary');
						setTimeout(function(){$('.alert').hide();},10000); 
						return false;
					}
					else
					{
						location.replace('Grievance.php');
						$(this).hide();
					}		
				}
		 }
	 }
		delete xmlHttp;		 
	
}
function clickBack()
{
	location.replace('Grievance.php');
}
</script>
<link href="css/bootstrap.min.css" rel="stylesheet" />
<script src="scripts/main_validation.js"></script>
  
  <?php  // $query = mysql_query("SELECT * FROM `grievance` WHERE `call_id`=$ID;");
				//$dbData = mysql_fetch_array($query); // print_r($dbData);?>
				
<?php 

#echo "SELECT * FROM `escalationresult` WHERE callid=$ID order by ID desc limit 1";
//$query1123 = mysql_query("SELECT * FROM `escalationresult` WHERE callid=$ID order by ID desc limit 1")or die(mysql_error());

 
//$dbData165 = mysql_fetch_array($query1123);
 
?>	
			
  
	<table class="table table-striped abc">
	
		<tr>
			<td>Compliant</td>
			<td>			
			<select class="form-control" id="Compliant">
				<option value=''> Select Complaint </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_complaintstype` WHERE `ISACTIVE`=1;");
				while($db = mysql_fetch_array($query)){
					$SEL = ($dbData['complaintId']==$db["ID"])?"selected='selected'":"";?>
				<option value='<?php echo $db['ID'];?>' <?php echo $SEL;?>><?php echo $db['Name'];?></option>
				<?php }?>
			</select>			
			</td>			
			<td> Gist of Complaint</td>
			<td><input class="form-control" type="text" id="goc" value="<?php echo $dbData['gistComplatint'];?>" /></td>
		</tr>
		<tr>
			<td>Complaint Against</td>
			<td><input class="form-control" type="text" id="complaintagainst" value="<?php echo $dbData['complaintAgainst'];?>" /></td>			
			<td> Designation</td>
			<td><select class="form-control" id="Designation" name="Designation">  
				<option value=''> Select Designation </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_designation` WHERE `ISACTIVE`=1;");
				while($db = mysql_fetch_array($query)){
					$SEL = ($dbData['designation']==$db["ID"])?"selected='selected'":"";?>
				<option value='<?php echo $db['ID'];?>' <?php echo $SEL;?>><?php echo $db['Name'];?></option>
				<?php }?> 
			</select></td>
		</tr>
		<tr>
			  <td style="display:none;">Institute</td>
			<td style="display:none;"><select id="Institute" class="form-control" name="Institute" >
			<option value=''> Select Institute </option>
				<?php $query = mysql_query("SELECT `ID`,`Name` FROM `m_institute` WHERE `ISACTIVE`=1;");
				while($db = mysql_fetch_array($query)){
					$SEL = ($dbData['institue']==$db["ID"])?"selected='selected'":"";?>
				<option value='<?php echo $db['ID'];?>' <?php echo $SEL;?>><?php echo $db['Name'];?></option>
				<?php }?> </select></td>			
			<td>Nature of Compliant</td>
			<td><input type="text" class="form-control" id="noc" value="<?php echo $dbData['complaintAgainst'];?>" /></td>
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
					$SEL = ($dbData['district_id']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."' $SEL >".$district_details["ds_lname"]."</option>";
				 }
				?>	
			</select></td>			
			<td> Reference Date</td>
			<td><input type="text" class="form-control followup_time_picker" value="<?php echo $dbData['complaintAgainst'];?>"  id="rdate" /></td>
		</tr>
		<tr>
			<td>Taluka</td>
			<td><select id="tehsil1" class="form-control" onchange='GetRegions(this.value,"2");'>
			<option value="<?php echo $dbData['block_id']."~".$dbData["block_name"];?>"><?php echo $dbData['block_name'];?></option>
			</select></td>			
			<td> Village</td>
			<td><select id="city_name1" class="form-control" >
			<option value="<?php echo $dbData['village_id']."~".$dbData["village_name"];?>"><?php echo $dbData['village_name'];?></option>
			</select></td>
		</tr>
		
		<tr>
		<td colspan="4"> <hr /></td> 
		</tr>

		<tr>
			<td>SPOC Name</td>
			<td><select id="spocname" style="width:190px" class="form-control"  >
			
			<?php
			$mandalid=$dbData['block_id'];
				$spoc_query	= "SELECT DISTINCT `Agency_id`,`Agency_Name` FROM `m_grivence_details` mg
								JOIN `m_level_contacts` mc ON mc.`levelType` = mg.`Level_No`
								JOIN `m_mandal` mm ON mm.`md_mdid` = mg.`Mandal_id`
								WHERE `isactive` = 1 AND mg.`Mandal_id` = '".$mandalid."';";
								
				$spoc_result= mysql_query($spoc_query);
				while($spoc_details = mysql_fetch_array($spoc_result))
				{
					$SEL = ($dbData['spocId']==$spoc_details["Agency_id"])?"selected":"";
					echo "<option value='".$spoc_details["Agency_id"]."~".$spoc_details["Agency_Name"]."' $SEL >".$spoc_details["Agency_Name"]."</option>";
				}
				?>	
			</select></td>			
			<td> SPOC Contact</td>
			<td><input type="text" value="" id="spoccontact" class="form-control"> </td>
		</tr>	
		
		<tr>
			<td>SPOC Remarks</td>
			<td> <textarea class="form-control" id="spocremarks"></textarea> </td>			
			<td> Communication to caller remarks</td>
			<td> <textarea class="form-control" id="remarks"><?php echo $dbData1['remarks'];?></textarea> </td>	
		</tr>	
		
		<!--<tr>
			<td>Escalation Level</td>
			<td> 
				<select id="escalationID" class="form-control" onchange='GetRegions(this.value,"6");'>
				<?php
				$district_query	= "SELECT m.`levelName`,m.levelType FROM `m_level_contacts` m
				left JOIN `escalationresult` l ON m.`levelType` = l.`escalationLevelId` AND l.callid=$ID WHERE m.`status` = 1 order by l.ID desc;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					 echo "<option value='".$district_details["levelType"]."'  >".$district_details["levelName"]."</option>";
				 }
				?>	
				</select>
			</td>			
			<td> Escalation Remarks</td>
			<td> <textarea class="form-control" id="escalationremarks"><?php echo $dbData1['escalationRemarks'];?></textarea> </td>	
		</tr>	-->
		
		
		<tr>
			<td> Status </td>
			<td> <select id="status" class="form-control">
				<option value="OPEN">OPEN</option> 
				<option value="CLOSED" <?php if($dbData['status'] =='CLOSED') echo 'selected';?> >CLOSED</option>
			</select> </td>	 
			<td>ID</td><td><input type="text" readonly value="<?php echo $ID;?>" id="callidValue" class="form-control" /></td>
		</tr>
		
		
		<tr>
			<td colspan="4" align="right"> <input type="button" class="btn btn-success" value="Submit" onclick="return saveSubmit();" />
			<input type="button" class="btn btn-danger" value="Back" onclick="return clickBack();" /></td> 
		</tr>
	
	
	</table>
</form> 
