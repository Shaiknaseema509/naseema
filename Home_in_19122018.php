<?php  error_reporting(0);
require_once("dbconnect_emri.php"); 

$phone_number         = $_POST["callernumber"];
$Queue 	              = strtoupper($_POST["queue_name"]);
$Queue                = ($Queue)?$Queue:"MEDADV_MQ";
$agentID 	      = $_POST["agentid"];
$call_hit_referenceno = $_POST["call_hit_referenceno"];

//echo "<pre>".print_r($_POST,1)."</pre>";
$Beneficiary_details_query= mysql_query("select * from mcth_mother where ID_No=''");
$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);



if($phone_number == '') $phone_number='1234567890';

$current_date = date("Y-m-d");

$Query1 = "SELECT COUNT(*) AS TODAY_COUNT FROM call_incident_info WHERE call_time >= '$current_date 00:00:00' AND call_time <= '$current_date 23:59:59' AND phone_number='".$phone_number."' AND status!='ABANDONED';";
$Result1     = mysql_query($Query1);
$Details1    = mysql_fetch_array($Result1);
$Today_Count = $Details1["TODAY_COUNT"];


if($agentID=='') $agentID='TEST';

/*$Callid_query= mysql_query("CALL updatesequenceNo('".$agentID."')");
$Callid_array = mysql_fetch_array($Callid_query);
$call_id=$Callid_array['currentnumber'];
  */
// mysql_query("delete from  from agent_sequenceno where agent_id='".$agentID."'");
?>
<html>
<head>
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
	
	
	function callType()
	{
		//var callType = $('#callType').val();
		var callTypes  = document.getElementById('CallTypeS').value.split('~');
		var callType = callTypes[0];
		//alert(callType);
		$('.HIDEALL').hide();
		if( callType == 13)
		{
			$('#SUBPAGEFEVER').show(); 
		}	
		else if( callType == 4)
		{
			$('#SUBPAGEGREVIENCES').show(); 
		}	
		else if( callType == 6)
		{
			$('#SUBPAGEGSS').show(); 
		}			
		else if( callType == 1)
		{
			$('#HOME').show(); 
		}
		else if( callType == 5)
		{
			$('#SUBPAGEINFDIR').show(); 
		}
		else{}
			
	}
	
	function GetCallID()
         {
			var xmlHttp=newHttpObject();
	
			if(xmlHttp)
			 {
				var callQuery='agentID=<?=$agentID;?>';
				xmlHttp.open("POST","getCallid.php",true);
				xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlHttp.send(callQuery);
				xmlHttp.onreadystatechange=function()
				{
					var Response = null;
					Response = xmlHttp.responseText;
					document.getElementById('callid').innerHTML=Response;
					/*if(Response !='')
					{	
						var callQuery1='callIDS='+Response+'&IncidentInfo=IncidentInfo';
						xmlHttp.open("POST","getCallid.php",true);
						xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlHttp.send(callQuery1);
						xmlHttp.onreadystatechange=function()
						{
							var Responses = null;
							Responses = xmlHttp.responseText;
						}	
					}	*/
				}
		    }
	    }
	
	
	
	function SaveCategory(Action,CategoryID,SubCategoryID,QuestionID,ResponseID)
	 {
		 $('#displayDataHtml').show();
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var callQuery = "action="+Action+"&call_id=&category_id="+CategoryID+"&sub_category_id="+SubCategoryID+"&question_id="+QuestionID+"&response_id="+ResponseID;
                 //       alert(callQuery);//return false;
                        xmlHttp.open("POST","save_inbound_questions.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
                                        var Response = null;
                                        Response = xmlHttp.responseText;
                                        //alert(Response);
                                 }
                         }
                 }
                delete xmlHttp;         
	 }

        function transfer_to_queue(ACTION)
        {
                //alert(ACTION);
                var xmlHttp=newHttpObject();
                if(xmlHttp)
                {
			var transfer_split = document.getElementById('call_transfer').value.split('~'); //alert(transfer_split);
			var call_transfer = transfer_split[0]; //alert(call_transfer);
			var tf_queue_name = transfer_split[1];
			var queue_id = transfer_split[2];
                        var beneficiary_id=document.getElementById('beneficiary_id').value; //alert(beneficiary_id);
                        var agentID = "<?=$_POST[agentid];?>"; ;
                        var phoneNumber = "<?=$_POST[callernumber];?>";
                        var leadID = "<?=$_POST[convoxuid];?>"; 
                        var process = "<?=$_POST[callProcess];?>"; 
                        var call_date = "<?=$_POST[call_date];?>";
                        var call_time = "<?=$_POST[call_time];?>"; 
                        var call_hit_referenceno = "<?=$_POST[call_hit_referenceno];?>";
                        var queue_name = "<?=$_POST[queue_name];?>"; 
                        var call_status = "<?=$_POST[call_status];?>";
                        var transfer_type = "QUEUE";
                        
                        if(call_status == 'WRAPUP')
                        {
                                document.getElementById('call_transfer').disabled=true;
                                alert("You Cannot Tranfer the Call in WRAPUP MODE");
                        }               
                        else
                        {
                                if(transfer_type == 'QUEUE');
                                {
                                        if(call_transfer=='MaleDoctor')
                                        {
                                                callQuery="&type="+transfer_type+"&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id;
                                        }
                                        else if(call_transfer=='FemaleDoctor')
                                        {
                                                callQuery="&type="+transfer_type+"&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id;
                                        }
                                        else if(call_transfer=='MaleCounselor')
                                        {
                                                callQuery="&type="+transfer_type+"&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id;
                                        }
                                        else if(call_transfer=='FemaleCounselor')
                                        {
                                                callQuery="&type="+transfer_type+"&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id;
                                        }
                                        else if(call_transfer=='InfoDirectory')
                                        {
                                                callQuery="&type="+transfer_type+"&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id;
                                        }
                                        else if(call_transfer=='InfoGovt')
                                        {
                                                callQuery="&type="+transfer_type+"&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id;
                                        }
                                        else if(call_transfer=='Grievance')
                                        {
                                               callQuery="&type="+transfer_type+"&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id;
                                        }
                                }
                                callQuery+="&ACTION=TRANSFER&queue_name="+queue_name+"&agent_id="+agentID+"&phone_number="+phoneNumber+"&process="+process+"&call_date="+call_date+"&call_time="+call_time+"&call_id=&leadID="+leadID+"&call_hit_referenceno="+call_hit_referenceno;
                                //alert(callQuery);//return false;
                                xmlHttp.open("POST","callcontrol_transfer.php",true);
                                xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                                xmlHttp.send(callQuery);
                                xmlHttp.onreadystatechange=function()
                                {
                                        if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                        {
                                                var Response = xmlHttp.responseText;
                                                //alert(Response);
                                                if(ACTION == "TRANSFER")
                                                {
                                                        var transfer_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=TRANSFER&convoxid="+leadID+"&agent_id="+agentID+"&disposition=TRANSFERED_CALL&type="+transfer_type+"&transfer_to_queue="+tf_queue_name+"&call_id=&beneficiary_id="+beneficiary_id;
                                                        //alert(transfer_url);//return false;
                                                        postURL(transfer_url,"false");          
                                                }
                                        }
                                }
                        }
                }
                delete xmlHttp;
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
						document.getElementById("city_name").innerHTML="<option value=''>-- Pickup City/Village --</option>";
					 }
					else if(index == 2)
					 {
						document.getElementById("city_name").innerHTML=Response;	
					 }
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	
	function showAlert()
	 {
		$('.alert').show();
		$('.alert_content').html('Fields Should Not be empty');
		setTimeout(function(){$('.alert').hide();},10000); 
	 }	

	function saveBeneficiaryDetails()
	 {
		var xmlHttp=newHttpObject();
		
		if(xmlHttp)
		 {
			var beneficiary_id	= document.getElementById('beneficiary_id').value;
			if(beneficiary_id == "")
			{
				showAlert();
                                document.getElementById("beneficiary_id").focus();
                                return false;
			}
			
			var beneficiary_name	= document.getElementById('beneficiary_name').value;
			if(beneficiary_name == "")	
			  {
				showAlert();
				document.getElementById('beneficiary_name').focus();
				return false;
			  }
			
			var beneficiary_surname	= document.getElementById('beneficiary_surname').value;
			if(beneficiary_surname == "")
			 {
				showAlert();
				document.getElementById('beneficiary_surname').focus();
				return false;
			 }
			
			var age	= document.getElementById('age').value;
			if (age == "")
			 {
				showAlert();
				document.getElementById('age').focus();
				return false;
			 }
			
			var gender = "";
			if(document.getElementById("male").checked)
			 {
				gender = document.getElementById("male").value;
			 }
			else if(document.getElementById("female").checked)
			 {
				gender = document.getElementById('female').value;
			 }
			else
			 {
				showAlert();
				document.getElementById('male').focus();
				return false;
			 }
			
			var mother = document.getElementById('mother').value;
			if( mother == "" )
			 {
				showAlert();
				document.getElementById('mother').focus();
				return false;
			 }
			
			var district_id = document.getElementById('district').value;
			if( district_id == "" )
			 {
				showAlert();
				document.getElementById('district').focus();
				return false;
			 }
			
			var block_id = document.getElementById('tehsil').value;
			if( block_id == "" )
			 {
				showAlert();
				document.getElementById('tehsil').focus();
				return false;
			 }
			
			var village_id = document.getElementById('city_name').value;
			if ( village_id == "" )	
			 {
				showAlert();
				document.getElementById('city_name').focus();
				return false;
			 }
			
			/*var contact_no = docuemnt.getElementById('contact_no').value;
			if( contact_no == "" )
			 {
				showAlert();
				document.getElementById('contact_no').value;
				return false;
			 }*/
			
			var email = document.getElementById('email').value;
			 
		
			var language_id = document.getElementById('language').value;
			 
		
			var caste = document.getElementById("caste").value;	
			 

			/*var social_status = document.getElementById('social_status').value;
			if( social_status == "" )
			 {
				showAlert();
				document.getElementById('social_status').focus();
				return false;
			 }*/
			
			var education_id = document.getElementById('education').value;
			if( education_id == "" )
			 {
				showAlert();
				document.getElementById('education').focus();
				return false;
			 }

			var occupation_id = document.getElementById('occupation').value;
			if( occupation_id == "")
			 {
				showAlert();
				document.getElementById('occupation').focus();
				return false;
			 }
			
			var marital_status_id = document.getElementById('marrital_status').value;
			if( marital_status_id == "" )
			 {
				showAlert();	
				document.getElementById('marrital_status').focus();
				return false;
			 }
			
			var Advice_sought_by = document.getElementById('Advice_sought_by').value;
			if(Advice_sought_by == "")
			 {
				showAlert();
				document.getElementById('Advice_sought_by').focus();
				return false;
			 }
			
			var relationship_id = document.getElementById('relationship').value;
			if(relationship_id == "" )
			{
				showAlert();
				document.getElementById('relationship').focus();
				return false;
			}
			
			var present_compalint = document.getElementById('present_complaint').value;
			if( present_compalint == "" )
			 {
				showAlert();
				document.getElementById('present_complaint').focus();
				return false;
			 }
		
			var advice_given = document.getElementById('advice_given').value;
			if( advice_given == "")
			 {
				showAlert();
				document.getElementById('advice_given').focus();
				return false;
			 }

			var callQuery="type=SaveBeneficiary&agent_id=<?=$_POST["agentid"];?>&contact_no=<?=$_POST["callernumber"];?>&beneficiary_id="+beneficiary_id+"&beneficiary_name="+beneficiary_name+"&benificiery_surname="+beneficiary_surname+"&age="+age+"&Gender="+gender+"&mother="+mother+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&email="+email+"&language_id="+language_id+"&education_id="+education_id+"&occupation_id="+occupation_id+"&marital_status_id="+marital_status_id+"&Advice_sought_by="+Advice_sought_by+"&relationship_id="+relationship_id+"&present_compalint="+present_compalint+"&advice_given="+advice_given;
			//alert(callQuery);
                        xmlHttp.open("POST","save_Beneficiary_Details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
                                        var Response = null;
                                        Response = xmlHttp.responseText;
                                        //alert(Response);
                                 }
                         }

		 }
		delete xmlHttp;	
	 } 	

	function endCall()
	 {
		var disposition = "";
		var Queue = "<?=$Queue;?>";
		if(Queue == "MEDADV_MQ")
		 {
			disposition = "MEDICALADVICEM";
		 }
		else if(Queue == "INFDIR_Q")
		 {
			disposition = "INFODIRECTORY";
		 }
		else if(Queue == "INFGOVT_Q")
		 {
			disposition = "INFOGOVTSCHEMES";	
		 }
		else if(Queue == "COUNSLG_MQ")
		 {
			disposition = "MALECOUNSELLING";
		 }
		else if(Queue == "GRVNC_Q")
		 {
			disposition = "GRIEVANCES";		
		 }
		else if(Queue == "COUNSLG_FQ")
		 {
			disposition = "FEMALECOUNSELLING";	
		 }
		else if(Queue == "MEDADV_FQ")
		 {
			disposition = "MEDICALADVICEF";
		 }

		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
                        var callQuery = "action=CLOSE&agent_id=<?=$_POST["agentid"];?>";
                        //alert(callQuery);//return false;
                        xmlHttp.open("POST","save_inbound_questions.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
                                        var Response = null;
                                        Response = xmlHttp.responseText;
                                        //alert(Response);
					var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_POST["convoxuid"];?>&agent_id=<?=$_POST["agentid"];?>&disposition="+disposition;
					//alert(end_call_url);
					postURL(end_call_url,"false");
                                 }
                         }
                 }
                delete xmlHttp;         


	 }	

</script>
</head>
<body onload='GetCallID();'>
	<div class="alert">
	<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	<br><br>
	<div class='alert_content'></div>
	</div>
	<div class="row" >
	<div class="col-md-12"  >
	<!-- <div class="row" style=" background-color: #58fcea ">
		 <div class="col-md-3"> UP  HEALTH  HELP LINE  </div>
		 <div class="col-md-3"><span> LOG IN ID :</span> xxxxxx </div>
		 <div class="col-md-3">  NAME : M.S Reddy</div> 
		 <div class="col-md-3"> CALL FLOW : Outbound - Beneficiary </div>
	</div>   -->
	<div class="row" style="background-color: #000080 ">
		 <div class="col-md-3 header "> Phone Number : <?=$phone_number;?> </div>
		 <div class="col-md-3 header "><span> Call ID :</span> <span id="callid"></span> </div>
		 <div class="col-md-3 header "> Date : <?=date('d-m-Y');?> </div> 
		 <div class="col-md-3 header "> Time : <?=date('H:i:s');?></div>
	</div>  
	</div>	
	<div class="col-md-3"  style="background-color: #9cbdff ">
	<div class="form-group" > 
		<table cellpadding="2" cellspacing="2" width="100%"  style="border: 1px solid #fff">
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;">Beneficiary ID :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" id="beneficiary_id" name='beneficiary_id' value="" /></td>
		</tr><tr><td></td></tr>	
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >NAME :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" id='beneficiary_name' name='beneficiary_name' onkeypress="return allowValidKey(event,'callername');" value="<?=$Beneficiary_Details['Name'];?>"  /></td>
		</tr><tr><td></td></tr>	
		<tr>
					
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >SURNAME :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" id='beneficiary_surname' name='beneficiary_surname' onkeypress="return allowValidKey(event,'callername');" value=""  /></td>
		</tr><tr><td></td></tr>	
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >AGE : </td>
			<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;">
				<input type="text" id='age' name='age' maxlength=3  onkeyup="AgeLimit(this.value,this.id);"  onkeypress="return allowValidKey(event,'number');" value=""  /><span id="age_span" style='color:red;font-size:10px'></span></td>
		</tr><tr><td></td></tr>	
		<tr>
		
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >GENDER : </td>		
			<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;">
				<input type="radio" id="male"  name="Gender" value="M" <?=($Beneficiary_Details["gender"]=='M')?"checked":"";?>>Male
		                <input type="radio" id="female" name="Gender" value="F" <?=($Beneficiary_Details["gender"]=='F')?"checked":"";?> > Female
			</td>
		</tr><tr><td></td></tr>
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >MOTHER : </td>		
			<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;"><input type="text" id="mother" name="mother" onkeypress="return allowValidKey(event,'callername');" value="" /></td>
		</tr>	
		</tr><tr><td></td></tr>
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >DISTRICT : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;"  id='district' name='district' onchange='GetRegions(this.value,"1");' class="col-md-10">
					<option value=''>Select District</option>
				<?php
				$district_query	= "SELECT ds_dsid,ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($Beneficiary_Details['District_ID']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."' $SEL >".$district_details["ds_lname"]."</option>";
				 }
				?>		
			
				</select>
			</td>
		</tr><tr><td></td></tr>	
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >TEHSIL : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='tehsil' name='tehsil' onchange='GetRegions(this.value,"2");' class="col-md-10">
		<!--		<option value=''>Select Tehsil</option>-->
				<?php
					$SEL = ($Beneficiary_Details['Taluka_ID'])?"selected":"";
					echo  ($Beneficiary_Details['Taluka_ID'])?"<option  value='".$Beneficiary_Details['Taluka_ID']."~".$Beneficiary_Details['Taluka_Name']."'$SEL>".$Beneficiary_Details['Taluka_Name']."</option>":"<option value=''>--Pickup Tehsil--</option>";
				?>
				</select>
			</td>
		</tr>	
		<tr><tr><td></td></tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >PANCHAYAT : </td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='city_name' name='city_name' class="col-md-10">
				<?php
					$SEL = ($Beneficiary_Details['Village_ID'])?"selected":"";
 					echo  ($Beneficiary_Details['Village_ID'])?"<option  value='".$Beneficiary_Details['Village_ID']."~".$Beneficiary_Details['Village_Name']."' $SEL>".$Beneficiary_Details['Village_Name']."</option>":"<option value=''>--Pickup Tehsil--</option>";
				?>
		</tr>	
		<tr><tr><td></td></tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >EMAIL : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" id='email' name='email' onkeypress="return allowValidKey(event,'email');" value=""  /></td>
		</tr><tr><td></td></tr>	
		<tr>
					
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >LANGUAGE </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select  style="font-family:arial;font-size:15px;color:black;" id='language' name='language' class="col-md-10">
					<option>Select Language</option>
					<option  value='1~english' >English </option>
					<option  value='2~hindi' >Hindi</option>
					<option  value='3~Native' >Native</option>
					<option  value='4~Others' >Others</option>
				</select>
			</td>
		</tr><tr><td></td></tr>	
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Caste : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='caste'  name='caste' class="col-md-10">
					<option>Select Caste</option>
				<?php
				$caste_query  = "SELECT caste_id,caste_name FROM m_caste WHERE is_active=1 ;";
				$caste_result = mysql_query($caste_query);
				while($caste_details = mysql_fetch_array($caste_result))
				 {
					echo "<option value='".$caste_details["caste_id"]."~".$caste_details["caste_name"]."'>".$caste_details["caste_name"]."</option>";
				 }
				?>
				</select>
			</td>
		</tr><tr><td></td></tr>	
		<tr>
			<td></td><td align='left' style="font-family:arial;font-size:15px;color:black;" ><button id='save' name='save' onclick='saveBeneficiaryDetails();'>Save</button> </td>
			<td></td>
		</tr>
		</table>
		<table cellpadding="5" cellspacing="5" width="100%"  style="border: 1px solid #fff">
		<tr>
					<td>Call Type</td>
					<td>
						<select name="CallType" id="CallTypeS" onchange="return callType();"   class="col-md-12">
							<option value="">Select Call Type</option>
						<?php
						$calltype_query = "SELECT call_type_id,call_type_name FROM m_call_type  WHERE is_active=1 order by order_by asc;";
						$calltype_result= mysql_query($calltype_query);
						while($calltype_details = mysql_fetch_array($calltype_result))
						 {
							echo "<option value='".$calltype_details["call_type_id"]."~".$calltype_details["call_type_name"]."' >".$calltype_details["call_type_name"]."</option>";
						 }
						?>
						</select>
					</td>
				</tr>
				<tr style="display:none">
					<td>Call Information </td>
					<td>
						<select name="Close Type"  class="col-md-12">
							<option value="">--Choose Close Type--</option>
						<?php
						$callInfo_query = "SELECT call_info_id,call_info_name FROM m_call_information  WHERE is_active =1;";
						$callInfo_result=mysql_query($callInfo_query);
						while($callInfo_details = mysql_fetch_array($callInfo_result))
						 {
							echo "<option value='".$callInfo_details["call_info_id"]."~".$callInfo_details["call_info_name"]."'>".$callInfo_details["call_info_name"]."</option>";
						 }
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input value="Terminate" style="color: #ff0000; font-weight: bold; font-size: 10pt;" type="button" onclick="endCall();"></td>
				</tr>
				
				<tr>
					<td>Transfer</td>
					<td><select name="call_transfer" id="call_transfer" class="col-md-12">
                        <?php
						$call_transfer_Q = "SELECT transfer_to,transfer_value,transfer_queue_name,transfer_queue_id FROM m_call_transfer WHERE transfer_queue_name NOT IN ('$_POST[queue_name]') AND active='Y';";
						$call_transfer_rslt = mysql_query($call_transfer_Q);
						while($call_transfer_details = mysql_fetch_array($call_transfer_rslt))
						{
							echo "<option value='".$call_transfer_details["transfer_value"]."~".$call_transfer_details["transfer_queue_name"]."~".$call_transfer_details["transfer_queue_id"]."'>".$call_transfer_details["transfer_to"]."</option>";
						}
                       ?>
					</select></td>
				</tr>
				<tr>
					<td></td>
					<td><input value="Transfer" style="color: #ff0000; font-weight: bold; font-size: 10pt;" type="button" onclick="transfer_to_queue('TRANSFER');"></td>
				</tr>
				<tr>
					<td><b><?=$Today_Count;?></b> Calls Received Today</td>
                        		<td><button type="button" onclick="openWindowpostURL('today_caller_calls.php?phone_number=<?=$phone_number;?>','Today_Calls','width=900px,height=400px,top=300px,left=200px,scrollbars=yes');" >CallHistory</button></td>
				</tr>
			</table>	
		
		</div>
	 </div>
        <div class="col-md-9" >	  
          <div class="row" >	
				<span style="display:none">
				 <div class="col-md-3 blueclass" style="font-family:arial;font-size:15px;color:black;"> U ID :
				 <?php echo $Beneficiary_Details['PhoneNo_Of_Whom'];?> </div> 
				<div class="col-md-3 blueclass " style="font-family:arial;font-size:14px;color:black;"> 
					<select id="education"  name="education" class="col-md-12">
						<option value="1">--Select Education--</option>
					<?php
					$education_query  = "SELECT education_id,education_type FROM m_education WHERE is_active=1";
					$education_result = mysql_query($education_query);
					while($education_details = mysql_fetch_array($education_result))
					{
						//$SEL = ($Beneficiary_Details['education_id']==$education_details["education_id"])?"selected":"";
						//echo "<option value='".$Beneficiary_Details["education_id"]."~".$Beneficiary_Details["education_id"]."' $SEL >".$education_details["education_type"]."</option>";
						echo "<option value='".$education_details["education_id"]."~".$education_details["education_type"]."'>".$education_details["education_type"]."</option>";

					}
					?>	
					</select>  
				</div>
				 <div class="col-md-3 blueclass " style="font-family:arial;font-size:14px;color:black;">
					 <select id="occupation" name="occupation" class="col-md-12">
						<option value="1">--Select Occupation--</option>
					<?php
					$occupation_query = "SELECT occupation_id,occupation_name FROM m_occupation WHERE is_active=1";
					$occupation_result= mysql_query($occupation_query);
					while($occupation_details=mysql_fetch_array($occupation_result))
					 {
						//$SEL = ($Beneficiary_Details['occupation_id']==$occupation_details["occupation_id"])?"selected":"";
						//echo "<option value='".$Beneficiary_Details["occupation_id"]."~".$Beneficiary_Details["occupation_name"]."' $SEL >".$occupation_details["occupation_name"]."</option>";
						echo "<option value='".$occupation_details["occupation_id"]."~".$occupation_details["occupation_name"]."'>".$occupation_details["occupation_name"]."</option>";
					  }
					?>
					</select> 
				</div>
				 <div class="col-md-3 blueclass " style="font-family:arial;font-size:14px;color:black;"> 
					<select id="marrital_status" name="marrital_status" class="col-md-12">
						<option value="1">--Select Marital Status--</option>
					<?
					$mstatus_query = "SELECT maritalstatus_id,maritalstatus_name FROM m_marital_status WHERE is_active=1";
					$mstatus_result= mysql_query($mstatus_query);
					while($mstatus_details = mysql_fetch_array($mstatus_result))
					 {
						//$SEL = ($Beneficiary_Details['maritalstatus_id']==$mstatus_details["maritalstatus_id"])?"selected":"";
						//echo "<option value='".$Beneficiary_Details["maritalstatus_id"]."~".$Beneficiary_Details["maritalstatus_name"]."' $SEL >".$mstatus_details["maritalstatus_name"]."</option>";
						echo "<option value='".$mstatus_details["maritalstatus_id"]."~".$mstatus_details["maritalstatus_name"]."'>".$mstatus_details["maritalstatus_name"]."</option>";	
					 }
					?>
					</select>
				 </div> 
				
				 <div class="col-md-3 blueclass " style="font-family:arial;font-size:15px;color:black;"> Advice Sought By: <input type="text"id="Advice_sought_by" name="Advice_sought_by" value="" style="font-family:arial;font-size:14px;color:black;" class="col-md-12"/></div> 
				<div class="col-md-3 blueclass" style="font-family:arial;font-size:14px;color:black;"> &nbsp; 
					<select id='relationship' name="relationship" class="col-md-12">
						<option value="1">--Select Relationship--</option>
					<?
					$relation_query	= "SELECT relationship_id,relationship_name FROM m_relationship WHERE is_active=1";
					$relation_result= mysql_query($relation_query);
					while($relation_details = mysql_fetch_array($relation_result))
					 {
						
						//$SEL = ($Beneficiary_Details['relationship_id']==$relation_details["relationship_id"])?"selected":"";
						//echo "<option value='".$Beneficiary_Details["relationship_id"]."~".$Beneficiary_Details["relationship_name"]."' $SEL >".$relation_details["relationship_name"]."</option>";
						echo "<option value='".$relation_details["relationship_id"]."~".$relation_details["relationship_name"]."'>".$relation_details["relationship_name"]."</option>";
					 }
					?>
					</select>
				</div>
				
				 <div class="col-md-3 blueclass " style="font-family:arial;font-size:15px;color:black;">
				 Past History:<input id="past_history" name="past_history" type="text" value="00" style="font-family:arial;font-size:14px;color:black;" class="col-md-12"></div>
				
				 <div class="col-md-3 blueclass " style="font-family:arial;font-size:15px;color:black;">Present Complaint:
				 <input type="text" id="present_complaint" onkeypress="return allowValidKey(event,'text');" name="present_complaint" value="00" style="font-family:arial;font-size:14px;color:black;" class="col-md-12"> </div> 	
				 
				<div class="col-md-12 blueclass" style="font-family:arial;font-size:15px;color:black;display:none;">Advice Given By:
				<input id="advice_given" name="advice_given" type="text" onkeypress="return allowValidKey(event,'callername');" value="00" style="font-family:arial;font-size:14px;color:black;" class="col-md-12"></div>
			   	</span>		 
			 <div class="col-md-12 HIDEALL" style="background-color: #000080;display:none " id="HOME" >
				
				<?php //echo $Queue;
				include('medical_advice_tab.php');
					/*if($Queue == 'MEDADV_MQ' || $Queue == 'MEDADV_FQ')
						include('medical_advice_tab.php');
					else if($Queue == 'INFGOVT_Q')
						include('info_govt_tab.php');	
					else if($Queue == 'COUNSLG_FQ' || $Queue == 'COUNSLG_MQ')
						include('counselling_tab.php');	
					else if($Queue == 'INFDIR_Q')
						include('information_directory_tab.php');	
					else if($Queue == 'GRVNC_Q')
						include('grevience_tab.php');
					else  
						include('information_directory_tab.php');						
					*/?>				
			 </div>
			 <div class="col-md-12 HIDEALL" id="displayDataHtml">
				<div id="questions_html">
				 					
				</div>	
				<div id="content_html" >
					<iframe id="navcontent" name="navcontent" src="blank.html" border='0' width="100%" height="400px"> </iframe>
				</div>
			</div>
			 
			  <div class="col-md-12 HIDEALL"  id="SUBPAGEFEVER" style="display:none" >
				
				  <?php include('fever.php');?>
				  
			 </div>
			
			 <div class="col-md-12 HIDEALL"  style="display:none" id="SUBPAGEGSS" >
				
				  <?php include('government_schemes_screen.php');?>
				  
			 </div>
			 <div class="col-md-12 HIDEALL" style="display:none" id="SUBPAGEGREVIENCES" >
				 
				  <?php include('type_five.php');?>
				  
			 </div>
			  <div class="col-md-12 HIDEALL" style="display:none" id="SUBPAGEINFDIR" >
				 
				  <?php include('Information_Directory_tab.php');?>
				  
			 </div>
			 
			 
			 
			 
			 
            
          </div>
        </div>       
      </div>
	
	</body>
</html>



<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/grid.css" rel="stylesheet" />
<link href="css/hover.css" rel="stylesheet" media="all">
<script src="js/jquery-1.10.2.min.js"></script>

<script>
$('body').on('click','.get_questions',function()
{
	$('#questions_html').show();
	$('#content_html').hide();	
	$(this).addClass('li_active');
	$('.get_static').removeClass('li_active');
});

$('body').on('click','.get_static',function()
{
	$('#questions_html').hide();
	$('#content_html').show();	
	$('.get_static, .get_questions').removeClass('li_active');
	$(this).addClass('li_active');	
	/*var get_html_page = $(this).attr('id');
	$.post('pages/'+get_html_page+'.php', function(return_data){
		$('#content_html').html(return_data);
	}); */
});
$('#content_html').hide();



function SaveInformationDirectory(sub_directory,District)
	 {
		var xmlHttp=newHttpObject(); 
		
		if(xmlHttp)
		 {
			var call_id 	   = document.getElementById('callid').innerHTML;
			var DistrictID	   = document.getElementById('District').value;
			var SubDirectoryID = document.getElementById('sub_directory').value;
			
			var callQuery = "action=SEARCHHOSPITAL&sub_directory_id="+SubDirectoryID+"&district_id="+DistrictID+"&call_id="+call_id;
			//alert(callQuery);
			xmlHttp.open("POST","get_medical_details.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText;
					//alert(Response);
                                        document.getElementById("hospitals_list").innerHTML=Response;   

			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
</script>

<style>
	 .form-control {height:25px !important; }
	 ul li { border-right: 2px solid white; cursor:pointer;float: left; font-size:15px;   list-style: outside none none;    margin: 3px;    padding: 3px;}
	 .li_active {  background-color: blue ;}
	 .fontsytle { font-size:12px}
	 ul li a{ color:#fff;}
	 .blueclass {font-family:arial;font-size:12px;color:black;background-color: #9cbdff}
	 .blueclass_1{ font-family:arial;font-size:13px;color:white;font-weight:bold;}
	 .header { font-family:arial;font-size:16px;color:white;font-weight:bold;}
	 input[type="text"]{ width:150px}
	  /* The alert message box */
.alert { top:0px;
                padding: 0px;
                background-color: #f44336; /* Red */
                color: white;
				font-size:16;
                position:fixed; display:none;
                width:93%;
                margin-bottom: 5px;
				z-index:9999;
                }

                /* The close button */
                .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
                }

                /* When moving the mouse over the close button */
                .closebtn:hover {
                color: black;
                }


	</style> 
