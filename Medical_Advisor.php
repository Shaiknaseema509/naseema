<?php 
require_once("dbconnect_emri.php"); 

$phone_number         = $_REQUEST["callernumber"];
$Queue 	              = $_REQUEST["Queue"];
$agent_id 	      = $_REQUEST["agentid"];
$call_hit_referenceno = $_REQUEST["CallReferenceID"];
$service_id           = $_REQUEST["DID"];
$call_date            = $_REQUEST["CallDate"];
$call_time            = $_REQUEST["CallTime"];
$transfer_callid      = $_REQUEST["CallID"];
$callids      = $_REQUEST["callid"];
$convoxID      = $_REQUEST["convoxID"];
$beneficiary_id	      = $_REQUEST["BeneficiaryID"];



//if($callid = '') $callid = 20180000000010;
//if($transfer_callid= '') $transfer_callid= 20180000000010;
$callid = $callids;
//echo 
//echo "<pre>".print_r($_REQUEST,1)."</pre>";

 
	$q= "select * from registration where call_id='$callids'";
	$Beneficiary_details_query= mysql_query($q)or die(mysql_error());
	$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);
 
//echo "<pre>".print_r($Beneficiary_Details)."</pre>"; 
$current_date = date("Y-m-d");

 $Query1 = "SELECT COUNT(*) AS TODAY_COUNT FROM call_incident_info WHERE call_time >= '$current_date 00:00:00' AND call_time <= '$current_date 23:59:59' 
AND callid='".$callids."';";
$Result1     = mysql_query($Query1);
$Details1    = mysql_fetch_array($Result1);
$Today_Count = $Details1["TODAY_COUNT"];


mysql_query("update call_incident_info set transferTime = now(),transferAgent='".$agent_id."' where callid='".$callids."' order by callid desc limit 1");

?>
<html>
<head>
<script src="scripts/main_validation.js"></script>
<script>
	
	 
	
	function isNumberKey(evt)
	{
		var keynum = (evt.which) ? evt.which : event.keyCode;
		//if (charCode > 31 && (charCode < 48 || charCode > 57))
		var ctrlDown = evt.ctrlKey||evt.metaKey;
		if((keynum==9)||(keynum==46)||(keynum==8)||(keynum>=35 && keynum<=40) ||(ctrlDown && (keynum==86||keynum==88 ||keynum==67)))return true;
		var keychar = String.fromCharCode(keynum);
		buf="0123456789`abcdefghi";
		//alert(keychar);
		if(buf.indexOf(keychar)>=0){return true;}
		return false;
	}

        function searchGetDetails()
        {       
                var register_details=document.getElementById("register_details").value;
                var search_by = document.getElementById("search_by").value; //alert(search_by);
                if(register_details=="")
                {
                        alert("Please Provide Registered Mobile Number OR UID Number OR Beneficiary ID to Get The Details.");  
                        return false;
                }
                URL = "get_details_link.php?register_details="+register_details+"&search_by="+search_by;
                my_window = window.open(URL, "Get_Details", "width=900px,height=400px,top=300px,left=200px,scrollbars=yes");
        }

	function searchvalidate()
	{	
		var register_details=document.getElementById("register_details_hidden").value;
		var search_by = document.getElementById("search_by").value; //alert(search_by);
		/*if(register_details=="")
		{
			alert("Please Provide Registered Mobile Number OR UID Number OR Beneficiary ID to Get The Details.");  
			return false;
		}
		else
		{*/
	                var xmlHttp=newHttpObject();
        	        if(xmlHttp)
                	 {
				if(search_by == 'phone_number')
				{
                        		var callQuery = "ACTION=GetRegPhoneNumberDetails&register_details="+register_details;
				}
				if(search_by == 'beneficiary_id')
				{
                                        var callQuery = "ACTION=GetBeneficiaryDetails&register_details="+register_details;				
				}
				if(search_by == 'aadhar_no')
                                {
                                        var callQuery = "ACTION=GetAadharDetails&register_details="+register_details;                              
                                }
	                        //alert(callQuery);//return false;
        	                xmlHttp.open("POST","get_register_details.php",true);
                	        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        	xmlHttp.send(callQuery);
	                        xmlHttp.onreadystatechange=function()
        	                 {
					if (xmlHttp.readyState == 4 && xmlHttp.status == 200) 
					{
						var Response = null;
						Response = xmlHttp.responseText;
						//alert(Response);
						var ResponseArry=Response.split("$");
                                                var arrylen=ResponseArry.length; 
                                                //alert(arrylen);                                         
                                                //alert(ResponseArry[10]);
                                                if(ResponseArry[0])
                                                        document.getElementById("beneficiary_name").value=ResponseArry[0];
                                                //if(ResponseArry[1])
                                                        //document.getElementById("beneficiary_surname").value=ResponseArry[1];
                                                if(ResponseArry[2])
                                                        document.getElementById("age").value=ResponseArry[2];
                                                if(ResponseArry[3]=='M')
                                                        document.getElementById("male").checked=true;
                                                else
                                                        document.getElementById("female").checked=true;
                                                if(ResponseArry[4])
                                                        document.getElementById("mother").value=ResponseArry[4];
                                                if(ResponseArry[5])
                                                        document.getElementById("district").innerHTML=ResponseArry[5];
                                                if(ResponseArry[6])
                                                        document.getElementById("tehsil").innerHTML=ResponseArry[6];
                                                if(ResponseArry[7])
                                                        document.getElementById("city_name").innerHTML=ResponseArry[7];
                                                if(ResponseArry[8])
                                                        document.getElementById("language").innerHTML=ResponseArry[8];  
                                                //if(ResponseArry[9])
                                                       // document.getElementById("caste").innerHTML=ResponseArry[9];
                                                if(ResponseArry[10])
                                                        document.getElementById("education").innerHTML=ResponseArry[10];
                                                if(ResponseArry[11])
                                                        document.getElementById("occupation").innerHTML=ResponseArry[11];
                                                if(ResponseArry[12])
                                                        document.getElementById("marrital_status").innerHTML=ResponseArry[12];
                                                if(ResponseArry[13])
                                                        document.getElementById("relationship").innerHTML=ResponseArry[13];
						if(ResponseArry[14])
                                                        document.getElementById("beneficiary_id").value=ResponseArry[14];
                                                if(ResponseArry[15])
                                                        document.getElementById("aadhar_uid_no").value=ResponseArry[15];
                                                if(ResponseArry[16])
                                                        document.getElementById("address").value=ResponseArry[16];
                                                if(ResponseArry[17])
                                                        document.getElementById("age_type").innerHTML=ResponseArry[17];
                                                        
						document.getElementById("save").style.display='none';
						document.getElementById("beneficiaryHistory").style.display='block';					
                			}
        			}
				delete xmlHttp; 			
			}		
		//}
	}
	
	function SaveCategory(Action,CategoryID,SubCategoryID,QuestionID,ResponseID)
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var call_id = document.getElementById('callid').innerHTML;
			var callQuery = "action="+Action+"&call_id="+call_id+"&category_id="+CategoryID+"&sub_category_id="+SubCategoryID+"&question_id="+QuestionID+"&response_id="+ResponseID;
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
			var tf_process_name = transfer_split[3]; //alert(tf_process_name);
			var queue_id = transfer_split[2];
                        var beneficiary_id=document.getElementById('beneficiary_id').value; //alert(beneficiary_id);
                        var agentID = "<?=$_REQUEST[agentid];?>"; ;
                        var phoneNumber = "<?=$_REQUEST[callernumber];?>";
                        var leadID = "<?=$_REQUEST[convoxuid];?>"; 
                        var process = "<?=$_REQUEST[Process];?>"; 
                        var call_date = "<?=$_REQUEST[CallDate];?>";
                        var call_time = "<?=$_REQUEST[CallTime];?>"; 
                        var call_hit_referenceno = "<?=$_REQUEST[CallReferenceID];?>";
                        var queue_name = "<?=$_REQUEST[Queue];?>"; 
                        var call_status = "<?=$_REQUEST[call_status];?>";
			var call_id = document.getElementById('callid').innerHTML; //alert(call_id);                     
 				
			var call_type_id = document.getElementById('call_type').value;
			if(call_type_id == "")
		 	 {
				$('.alert').show();
				$('.alert_content').html('Please Select Call Type');
				setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("call_type").focus();
				return false;
		 	 }

			 var call_type_id_array = call_type_id.split("~");
			if((call_type_id_array[0] == 1)||(call_type_id_array[0] == 2)||(call_type_id_array[0] == 3)||(call_type_id_array[0] == 4)||(call_type_id_array[0] == 5)||(call_type_id_array[0] == 6))
                	 {
        		        //alert(call_type_id);return false;
                        	var Advice_sought_by    = document.getElementById('Advice_sought_by').value;
	                        if(Advice_sought_by == "")
	                         {
	                                showAlert();
	                                document.getElementById('Advice_sought_by').focus();
	                                return false;
	                         }
	                        var past_history        = document.getElementById('past_history').value;
	                        if(past_history == "")  
	                         {
	                                showAlert();
	                                document.getElementById('past_history').focus();
	                                return false;
	                         } 
	
	                        var present_compalint   = document.getElementById('present_complaint').value;
	                        if( present_compalint == "" )
	                         {
	                                showAlert();
	                                document.getElementById('present_complaint').focus();
	                                return false;
	                         }
		
	                        var advice              = document.getElementById('advice').value;
	                        if( advice == "")
	                         {
	                                showAlert();
        	                      	document.getElementById('advice').focus();
                	                return false;
	                         }
	                 }	
	
			var call_information_id = document.getElementById('call_information').value;
			var beneficiary_id 	= document.getElementById('beneficiary_id').value;

			if(!document.getElementById('anonomus').checked)
			 {
				if(document.getElementById('beneficiary_id').value == "")
				 {
					$('.alert').show();
					$('.alert_content').html('Beneficiary ID Should Not Be Empty. Please Save Beneficiary Details.');
					setTimeout(function(){$('.alert').hide();},10000); 
					return false;
				 }
			 }

			/*if(call_status == 'WRAPUP')
                        {
                                document.getElementById('call_transfer').disabled=true;
                                alert("You Cannot Tranfer the Call in WRAPUP MODE");
                        }
                        else 
                        {*/
				
				if(call_transfer=='MaleDoctor')
                                {
					callQuery="&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id+"&tf_process_name="+tf_process_name;
				 		
                                }
                                else if(call_transfer=='FemaleDoctor')
                                {
                                        callQuery="&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id+"&tf_process_name="+tf_process_name;
                                }
                                else if(call_transfer=='MaleCounselor')
                                {
					callQuery="&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id+"&tf_process_name="+tf_process_name;
                                }
                                else if(call_transfer=='FemaleCounselor')
                                {
                                        callQuery="&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id+"&tf_process_name="+tf_process_name;
                                }
                                else if(call_transfer=='InfoDirectory')
                                {
                                        callQuery="&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id+"&tf_process_name="+tf_process_name;
                                }
                                else if(call_transfer=='InfoGovt')
                                {
                                        callQuery="&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id+"&tf_process_name="+tf_process_name;
                                }
                                else if(call_transfer=='Grievance')
                                {
                                        callQuery="&beneficiary_id="+beneficiary_id+"&call_transfer="+call_transfer+"&tf_queue_name="+tf_queue_name+"&queue_id="+queue_id+"&tf_process_name="+tf_process_name;
                                }
                                
                                callQuery+="&ACTION=TRANSFER&queue_name="+queue_name+"&agent_id="+agentID+"&phone_number="+phoneNumber+"&process="+process+"&call_date="+call_date+"&call_time="+call_time+"&call_id="+call_id+"&leadID="+leadID+"&call_hit_referenceno="+call_hit_referenceno+"&call_type_id="+call_type_id_array[0]+"&call_information_id="+call_information_id+"&beneficiary_id="+beneficiary_id;
                                //alert(callQuery);//return false;
				
				if((call_type_id_array[0] == 1)||(call_type_id_array[0] == 2)||(call_type_id_array[0] == 3)||(call_type_id_array[0] == 4)||(call_type_id_array[0] == 5)||(call_type_id_array[0] == 6))
	                         {
                	                callQuery+="&Advice_sought_by="+Advice_sought_by+"&past_history="+past_history+"&present_compalint="+present_compalint+"&advice="+advice+"&call_id="+call_id+"&service_type="+call_type_id_array[0];
                        	 }
	
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
							if(process == tf_process_name )
							{							
	                                                        var transfer_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=TRANSFER&convoxid="+leadID+"&agent_id="+agentID+"&disposition=TRANSFERED_CALL&type=QUEUE&transfer_to_queue="+tf_queue_name+"&call_id="+call_id+"&beneficiary_id="+beneficiary_id;
							}
							else
							{
								var transfer_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=TRANSFER&convoxid="+leadID+"&agent_id="+agentID+"&disposition=TRANSFERED_CALL&type=PROCESS&transfer_to_process="+tf_process_name+"&call_id="+call_id+"&beneficiary_id="+beneficiary_id;
							}
                                                        //alert(transfer_url);//return false;
                                                        postURL(transfer_url,"false");          
                                                }
                                        }
                                }
                        //}
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
						Response = Response.split("$$@@$$");
						document.getElementById("tehsil").innerHTML=Response[0];
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
			var call_id		= document.getElementById('callid').innerHTML;
			var beneficiary_id	= document.getElementById('beneficiary_id').value;
			var beneficiary_name	= document.getElementById('beneficiary_name').value;
			if(beneficiary_name == "")	
			  {
				showAlert();
				document.getElementById('beneficiary_name').focus();
				return false;
			  }
			
			var age	= document.getElementById('age').value;
			if (age == "")
			 {
				showAlert();
				document.getElementById('age').focus();
				return false;
			 }
			
			var age_type = document.getElementById('age_type').value;	

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
			
			var address = document.getElementById('address').value;
			if( address == "" )
			 {
				showAlert();
				document.getElementById('address').focus();
				return false;
			 }
			
		
			var language_id = document.getElementById('language').value;
			if(language_id == "")
			 {
				showAlert();
				document.getElementById('language').focus();
				return false;
			 }
		
			var education_id = document.getElementById('education').value;
			var occupation_id = document.getElementById('occupation').value;
			var marital_status_id = document.getElementById('marrital_status').value;
			
			var relationship_id = document.getElementById('relationship').value;
			if(relationship_id == "" )
			{
				showAlert();
				document.getElementById('relationship').focus();
				return false;
			}

			var aadhar_uid_no = document.getElementById('aadhar_uid_no').value;
			
			var callQuery="type=SaveBeneficiary&agent_id=<?=$_REQUEST["agentid"];?>&contact_no=<?=$_REQUEST["callernumber"];?>&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&beneficiary_name="+beneficiary_name+"&age="+age+"&Gender="+gender+"&mother="+mother+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&language_id="+language_id+"&education_id="+education_id+"&occupation_id="+occupation_id+"&marital_status_id="+marital_status_id+"&relationship_id="+relationship_id+"&aadhar_uid_no="+aadhar_uid_no+"&address"+address+"&age_type="+age_type;
		//	alert(callQuery);
                        
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
					document.getElementById('beneficiary_id').value=Response;
					document.getElementById('save').style.display='none';
					document.getElementById("beneficiaryHistory").style.display='block';
                                 }
                         }

		 }
		delete xmlHttp;	
	 } 	

	function endCall()
	 {
		
		 
		
		var tRemarks = document.getElementById('tRemarks').value;
		var call_id = '<?php echo $callid;?>';
		 

		 

		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			
                        var callQuery = "action=COUNSELLINGCLOSE&tRemarks="+tRemarks+"&call_id="+call_id;

			 

                        //alert(callQuery);
                        xmlHttp.open("POST","save_inbound_questions.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
                                        var Response = null;
                                        Response = xmlHttp.responseText;
										  
var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agent_id;?>&disposition=1";
					
					postURL(end_call_url,"false");
                                 }
                         }
                 }
                delete xmlHttp;         
	 }	

</script>
</head>
	<body style="overflow-x:hidden;" >
	<div class="alert">
	<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	<div class='alert_content'></div>
	</div>
	<div class="row" >
	<div class="col-md-12"  >
	<div class="row" style="background-color: #000080 ">
		 <div class="col-md-3 header "> फ़ोन नंबर : <?=$phone_number;?> </div>
		 <div class="col-md-3 header "><span> कॉल आईडी :</span> <span id="callid"><?=($callids)?$callids:"";?></span> </div>
		 <div class="col-md-3 header "> तारीख : <?=$Beneficiary_Details["CallDate"];?> </div> 
		 <div class="col-md-3 header "> पहर : <?=$Beneficiary_Details["CallTime"];?></div>
	</div>  
	</div>
        <?php
	/*if($_REQUEST[search_number]=="Search" && $_REQUEST[register_details]!="")
        {
                echo"<script>alert('BLOCK');</script>";
		echo $queryDetails = "SELECT * FROM mcth_mother WHERE ID_No='".$_REQUEST[register_details]."' LIMIT 1";
		$Beneficiary_details_query= mysql_query($queryDetails);
		$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);

        }*/
        ?>
	
	<div class="col-md-3"  style="background-color: #9cbdff ">
	<div class="form-group" > 
                <table cellpadding="2" cellspacing="2" width="100%"  style="display:none;border: 1px solid #fff">
                <tr>
                <td align='left' style="font-family:arial;font-size:12px;color:black;">
                <input type='text' name='register_details' id='register_details' value='<?=$phone_number;?>' onkeydown='return isNumberKey(event);' style="font-family:arial;font-size:14px;color:black;" class="col-md-5"/>
		<input type="hidden" id="register_details_hidden">
                <select name='search_by' id='search_by' title='Search By' style="font-family:arial;font-size:15px;color:black;" class="col-md-6">
		<option value='phone_number' $selected_phone>फ़ोन नंबर</option>
                <option value='beneficiary_id' $selected_name>लाभार्थी आईडी</option>
		<option value='aadhar_no' $selected_name>आधार संख्या</option>
                </select></td>
		</tr><tr>
		<td align='center'>
			<input type='submit' value='Get Details' class='searchbt' title='search' style="font-family:arial;font-size:15px;color:red;font-weight:bold;" onclick='return searchGetDetails();'></td></tr>
                </tr>
		</table>

		<table cellpadding="2" cellspacing="2" width="100%"  style="border: 1px solid #fff">
		 
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;">लाभार्थी आईडी :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><span id="beneficiary_id_span" name="beneficiary_id_span"><input type="text" id="beneficiary_id" name='beneficiary_id' value="<?=$Beneficiary_Details['registration_id'];?>" readonly /></span></td>
		</tr><tr><td></td></tr>	
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" ><font color="red">*</font>पूरा नाम  :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><span id="beneficiary_name_span" name="beneficiary_name_span">
			<input type="text" id='beneficiary_name' name='beneficiary_name' onkeypress="return allowValidKey(event,'callername');" value="<?=$Beneficiary_Details['beneficiary_name'];?>"  /></span></td>
		</tr><tr><td></td></tr>	
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" ><font color="red">*</font>आयु : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
			<select name="age_type" id="age_type" onchange="document.getElementById('age').value='';">
                                <?php
                                $dob_array=split(",","years,months,days");
                                foreach($dob_array as $value)
                                 {
                                        echo "<option value='".$value."' >".ucfirst($value)."</option>";
                                 }
                                ?>
                                </select>
                                <input type="text" id='age' name='age' maxlength=3  style="width:50px;"  onkeypress="return allowValidKey(event,'age');" onblur="document.getElementById('age_span').innerHTML='';" value="<?=$Beneficiary_Details['age'];?>"  />
                        <span id="age_span" style='color:red;font-size:12px'></span>
                        </td>
		</tr><tr><td></td></tr>	
		<tr>
		
			<td align='right' style="font-family:arial;font-size:15px;color:black;" ><font color="red">*</font>लिंग : </td>		
			<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;">
				<span id="male_span" name="male_span"><input type="radio" id="male"  name="Gender" value="M" <?=($Beneficiary_Details["gender"]=='M')?"checked":"";?>></span>पुरुष
		         <span id="female_span" name="female_span"><input type="radio" id="female" name="Gender" value="F" <?=($Beneficiary_Details["gender"]=='F')?"checked":"";?> ></span> महिला
		         <span id="female_span" name="female_span"><input type="radio" id="female" name="Gender" value="T" <?=($Beneficiary_Details["gender"]=='T')?"checked":"";?> ></span> T
			</td>
		</tr><tr><td></td></tr>
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" ><font color="red"></font>मां : </td>		
			<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;"><span id="mother_span" name="mother_span"><input type="text" id="mother" name="mother" onkeypress="return allowValidKey(event,'callername');" value="<?=$Beneficiary_Details['mother'];?>" /></span></td>
		</tr>	
		</tr><tr><td></td></tr>
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" ><font color="red">*</font>जिला : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><span id="district_span" name="district_span">
				<select style="font-family:arial;font-size:15px;color:black;"  id='district' name='district' onchange='GetRegions(this.value,"1");' class="col-md-10">
					<option value=''>Select District</option>
				<?php
				$district_query	= "SELECT ds_dsid,districtname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($Beneficiary_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["districtname"]."' $SEL >".$district_details["districtname"]."</option>";
				 }
				?>		
			
				</select></span>
			</td>
		</tr><tr><td></td></tr>	
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" ><font color="red">*</font>तहसील : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><span id="tehsil_span" name="tehsil_span">
				<select style="font-family:arial;font-size:15px;color:black;" id='tehsil' name='tehsil' onchange='GetRegions(this.value,"2");' class="col-md-10">
		<!--		<option value=''>Select Tehsil</option>-->
				<?php
			        echo"<option value=''>--Pickup Tehsil--</option>";
			 
			        	$stmtTEH="SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid='".$Beneficiary_Details["district_id"]."' ORDER BY md_lname ASC;";
				        $resultTEH=mysql_query($stmtTEH);
				        while($row=mysql_fetch_array($resultTEH))
				        {
				                $SEL = ($Beneficiary_Details['block_id']==$row["md_mdid"])?"selected":"";
			        	        echo"<option value='".$row["md_mdid"]."~".$row["md_lname"]."' $SEL >".$row["md_lname"]."</option>";
				        }
				 
				?>
				</select></span>
			</td>
		</tr>	
		<tr><tr><td></td></tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" ><font color="red">*</font> गाँव : </td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><span id="city_name_span" name="city_name_span">
				<select style="font-family:arial;font-size:15px;color:black;" id='city_name' name='city_name' class="col-md-10">
				<?php
			        echo "<option value=''>--Pickup Village--</option>";
				 
			        	$stmtVILL="SELECT ct_ctid,ct_lname FROM m_city WHERE is_active=1 AND ct_mdid='".$Beneficiary_Details["block_id"]."' ORDER BY ct_lname ASC;";
				        $resultVILL=mysql_query($stmtVILL);
				        while($row=mysql_fetch_array($resultVILL))
				        {
				               $SEL = ($Beneficiary_Details['village_id']==$row["ct_ctid"])?"selected":"";
			        	       echo"<option value='".$row["ct_ctid"]."~".$row["ct_lname"]."' $SEL >".$row["ct_lname"]."</option>";
				        }
				 
				?>
				</select></span>
		</tr>
		<tr><tr><td></td></tr>
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" ><font color="red">*</font> पता :</td>
 			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><span id="address_span" name="address_span">
			 <?php echo "<textarea id='address' name='address' style='font-family:arial;font-size:14px;color:black;width:170px;height:40px' >".$Beneficiary_Details['address']."</textarea>";?></span></td>	
		</tr>
		<tr><tr><td></td></tr>
		  
		<tr>
			<td></td><td align='left' style="display:none;font-family:arial;font-size:15px;color:black;" ><button id='save' name='save' onclick='saveBeneficiaryDetails();'>Save</button> </td>
			<td></td>
		</tr>
		</table>
		<table cellpadding="2" cellspacing="2" width="100%"  style="border: 1px solid #fff">
		 
				 
				<tr>
					<td>Remarks </td>
					<td> <textarea id="tRemarks">  </textarea></td>
					</tr>
					<tr>
					<td>  </td>
					<td><input value="Terminate" style="color: #ff0000; font-weight: bold; font-size: 10pt;" type="button" onclick="endCall();"></td>
				</tr>
				 
			</table>	
		
		</div>
	 </div>
        <div class="col-md-9" >	  
          <div class="row" >			 
				   
 
			 <div class="col-md-12" style="background-color: #000080 ">
				
				<?php
						include('counselling_tab.php');
					?>				
			 </div>
            <div class="col-md-12" >
				<div id="questions_html">
				 					
				</div>	
				<div id="content_html" >
					<iframe id="navcontent" name="navcontent" src="blank.html" border='0' width="100%" height="500px"> </iframe>
				</div>
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
