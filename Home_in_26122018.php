<?php  error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$phone_number         = $_REQUEST["callernumber"];
$Queue 	              = strtoupper($_REQUEST["queue_name"]);
$Queue                = ($Queue)?$Queue:"MEDADV_MQ";
$agentID 	      = $_REQUEST["agentid"];
$call_hit_referenceno = $_REQUEST["call_hit_referenceno"];
$convoxID = $_REQUEST["convoxID"];

//echo "<pre>".print_r($_REQUEST,1)."</pre>";
$Beneficiary_details_query= mysql_query("select * from mcth_mother where ID_No=''");
$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);


if($agent_id =='') $agent_id='test';
if($phone_number == '') $phone_number='1234567890';
//if($convoxID == '') $convoxID=rand(1233333333,99999999999);

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
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/moment-with-locales.js"></script>
	<script src="js/bootstrap-datetimepicker.js"></script>
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
	
	
	 <script type="text/javascript">
 	$(function () {
                //$('.followup_time_picker').datetimepicker({format: 'YYYY/MM/DD'});
				$('.followup_time_picker').datetimepicker({format: 'YYYY/MM/DD'});
        });
		
    </script>
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
	function getAge(dateString) 
	{ 
		var dateString= $('#dob').val();
		var today = new Date();
		//  var today = $.format.date(new Date(), 'dd-M-yyyy');
		var birthDate = new Date(dateString);
		var age = today.getFullYear() - birthDate.getFullYear();
		
		var m = today.getMonth() - birthDate.getMonth();
		if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
		{
			age--;
			$('#monthyear').val('YEAR');
		}
		//alert(m);
		if(age ==0 )
		{
			age= m;
			$('#monthyear').val('MONTH');
		}
		$('#age').val(age);
	}
	
	
	function getPhoneno(a)
	{ 
		var callTypes  = a.split('~');
		var callType = callTypes[1]; 
		 if(callType =='') 
			$('#agencycontact').val('');
		else
			$('#agencycontact').val(callType);
	}
	 
	function callTyped()
	{ 
		var callTypes  = document.getElementById('CallTypeSS').value.split('~');
		var callType = callTypes[0]; 
		$('#displayDataHtml').hide();	
		if(callType == 9999)
		{
			$('#mainCalltype').show();
			$('#endcall').val('Submit');
			$('#endcall').hide();
		}			
		else
		{
			$('#mainCalltype').hide();
			$('#endcall').val('Terminate');
			$('#endcall').show();
		}			
	}
	
	
	function callType()
	{
		//var callType = $('#callType').val();
		var callTypes  = document.getElementById('CallTypeS').value.split('~');
		var callType = callTypes[0];
		$('.HIDEALL').hide();
		if(callType =='') 
		{
			$('#endcall').hide(); return false;	
		}
		//alert(callType);
		//$('.HIDEALL').hide();
		 
		if(callType==1) $('.displayDataHtml').css('background-color','#000080');
		else $('.displayDataHtml').css('background-color','#fff');
		
		var xmlHttp=newHttpObject();
	
			if(xmlHttp)
			 {
				var callQuery='tabs='+callType+'&callernumber=<?php echo $phone_number;?>&agentid=<?php echo $agentID;?>&convoxID=<?php echo $convoxID;?>';
				xmlHttp.open("POST","ajax.php",true);
				xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlHttp.send(callQuery);
				xmlHttp.onreadystatechange=function()
				{
					var Response = null;
					Response = xmlHttp.responseText; 
					$('.displayDataHtml').html(Response); 
					$('.displayDataHtml').show(); 
					//if(callType == 13)  $('#endcall').hide();else 
					$('#endcall').show();	
				}
		    }
			
	}
	
	function GetCallID()
         {
			var xmlHttp=newHttpObject();
	
			if(xmlHttp)
			 {
				var callQuery='agent_id=<?=$agentID;?>&phone_number=<?=$phone_number;?>';
				xmlHttp.open("POST","getCallid.php",true);
				xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlHttp.send(callQuery);
				xmlHttp.onreadystatechange=function()
				{
					var Response = null;
					Response = xmlHttp.responseText;
					document.getElementById('callid').innerHTML=Response;
					document.getElementById('callidValue').value=Response;
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
		 var call_id =  document.getElementById('callidValue').value;
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var callQuery = "action="+Action+"&call_id="+call_id+"&category_id="+CategoryID+"&sub_category_id="+SubCategoryID+"&question_id="+QuestionID+"&response_id="+ResponseID;
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
                        var agentID = "<?=$agentID;?>"; ;
                        var phoneNumber = "<?=$phone_number;?>";
                        var leadID = "<?=$convoxID;?>"; 
                        var call_id =  document.getElementById('callidValue').value;
					   var process = "<?=$_POST[callProcess];?>";  
                        
						var call_hit_referenceno = "<?=$call_hit_referenceno;?>";
                        var queue_name = "<?=$_POST[queue_name];?>"; 
                        var call_status = "<?=$_POST[call_status];?>";
                        var transfer_type = "PROCESS";
                        
						var callQuery='';
						
//var transfer_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=TRANSFER&convoxid="+leadID+"&agent_id="+agentID+"&disposition=TRANSFERED_CALL&type=PROCESS&transfer_to_queue="+tf_queue_name+"&call_id=&beneficiary_id="+beneficiary_id;						
						
                        if(call_status == 'WRAPUP')
                        {
                                document.getElementById('call_transfer').disabled=true;
                                alert("You Cannot Tranfer the Call in WRAPUP MODE");
                        }               
                        else
                        {
                                
							callQuery+="&ACTION=TRANSFER&agent_id="+agentID+"&phone_number="+phoneNumber+"&process="+process+"&call_id="+call_id+"&leadID="+leadID+"&call_hit_referenceno="+call_hit_referenceno;
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
var transfer_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=TRANSFER&convoxid="+leadID+"&agent_id="+agentID+"&disposition=TRANSFERED_CALL&type=PROCESS&transfer_to_process=CO_104&call_id="+call_id+"&beneficiary_id="+beneficiary_id;
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
						document.getElementById("tehsil").innerHTML=Response;
						document.getElementById("city_name").innerHTML="<option value=''>-- Pickup City/Village --</option>";
					 }
					else if(index == 2)
					 {
						document.getElementById("city_name").innerHTML=Response;	
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
	
	function GetRegionsfever(ID,index)
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
				// var ID = $('#tehsil1').val();
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
						document.getElementById("agency_id1").innerHTML=Response;	
					 }
					 else if(index == 5)
					 {
						document.getElementById("agencyassignedf1").innerHTML=Response;	
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

	 
	 function validcheckaadhar12()
	 { 
		 var aadhar_uid_no = document.getElementById('aadhar_uid_no').value;
		if( aadhar_uid_no != "" )
		 {
			  if(aadhar_uid_no.length != 12)
			  {
				$('.alert').show();
				$('.alert_content').html('Invalid Aadhar ..!');
				$('#aadhar_uid_no').focus();
				setTimeout(function(){$('.alert').hide();},10000); 
				return false;
				}				
		 }
	 }
	  function validcheckaadhar123()
	 { 
		 var aadhar_uid_no = document.getElementById('ano').value;
		if( aadhar_uid_no != "" )
		 {
			  if(aadhar_uid_no.length != 10)
			  {
				$('.alert').show();
				$('.alert_content').html('Invalid Number ..!');
				$('#ano').focus();
				setTimeout(function(){$('.alert').hide();},10000); 
				return false;
				}				
		 }
	 }
	 
	function saveBeneficiaryDetails()
	 {
		var xmlHttp=newHttpObject();
		
		if(xmlHttp)
		 {
			var beneficiary_id	= document.getElementById('beneficiary_id').value;
			/*if(beneficiary_id == "")
			{
				showAlert();
                                document.getElementById("beneficiary_id").focus();
                                return false;
			}*/
			
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
			 var beneficiary_lname	= document.getElementById('beneficiary_lname').value;
			if(beneficiary_lname == "")
			 {
				showAlert();
				document.getElementById('beneficiary_lname').focus();
				return false;
			 }
			
			var age	= document.getElementById('age').value;
			if (age == "")
			 {
				showAlert();
				document.getElementById('age').focus();
				return false;
			 }
			 if (age > 121)
			 {
				$('.alert').show();
					$('.alert_content').html('Invalid Age ..!');
					document.getElementById('age').focus();
					setTimeout(function(){$('.alert').hide();},10000); 
				return false;
			 }
			 
			  var ano	= document.getElementById('ano').value;
			 var address	= document.getElementById('address').value;
			if (address == "")
			 {
				showAlert();
				document.getElementById('address').focus();
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
			 else if(document.getElementById("tran").checked)
			 {
				gender = document.getElementById('tran').value;
			 }
			else
			 {
				showAlert();
				document.getElementById('male').focus();
				return false;
			 }
			
			var aadhar_uid_no = document.getElementById('aadhar_uid_no').value;
			if( aadhar_uid_no != "" )
			 {
				  if(aadhar_uid_no.length !=12)
				  {
					$('.alert').show();
					$('.alert_content').html('Invalid Aadhar ..!');
					document.getElementById('aadhar_uid_no').focus();
					setTimeout(function(){$('.alert').hide();},10000); 
					return false;
					}				
			 }
			
			var district_id = document.getElementById('district').value;
			if( district_id == "" )
			 {
				showAlert();
				document.getElementById('district').focus();
				return false;
			 }
			
			var block_id = document.getElementById('tehsil').value;
			var dob = document.getElementById('dob').value;
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
			
			//var email = document.getElementById('email').value;
			var monthyear = document.getElementById('monthyear').value;
			 
		
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
			 

			var occupation_id = document.getElementById('occupation').value;
			 
			
			var marital_status_id = document.getElementById('marrital_status').value;
			 
			
			var Advice_sought_by = document.getElementById('Advice_sought_by').value;
			 
			
			var relationship_id = document.getElementById('relationship').value;
			 
			
			var present_compalint = document.getElementById('present_complaint').value;
			 
		
			var advice_given = document.getElementById('advice_given').value;
			 var call_id = document.getElementById('callidValue').value;
var mother='';var email='';
			var callQuery="type=SaveBeneficiary&agent_id=<?=$_POST["agentid"];?>&contact_no=<?=$phone_number;?>&ano="+ano+"&dob="+dob+"&aadhar_uid_no="+aadhar_uid_no+"&age_type="+monthyear+"&beneficiary_lname="+beneficiary_lname+"&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&beneficiary_name="+beneficiary_name+"&benificiery_surname="+beneficiary_surname+"&age="+age+"&Gender="+gender+"&mother="+mother+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&email="+email+"&language_id="+language_id+"&education_id="+education_id+"&occupation_id="+occupation_id+"&marital_status_id="+marital_status_id+"&address="+address+"&relationship_id="+relationship_id+"&present_compalint="+present_compalint+"&advice_given="+advice_given;
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
									$('.alert').show();
									$('.alert_content').html('Data updated..!');
									setTimeout(function(){$('.alert').hide();},10000); 
									document.getElementById('beneficiary_id').value=Response;
									//$('#save').hide();
									$('#save').text('Update');
									$('#TransferP').show();
									$('#endcall').show();
								}
                         }

		 }
		delete xmlHttp;	
	 } 	

	function endCall()
	 {
		var disposition = "";
		var Queue = "<?=$Queue;?>";
		var call_id =  document.getElementById('callidValue').value;
		var callTypes  = document.getElementById('CallTypeSS').value.split('~');
		var callType = callTypes[0]; 
		var callTypedup = callTypes[0]; 
		if(callType == 9999)
		{
			var callTypes  = document.getElementById('CallTypeS').value.split('~');
			var callType = callTypes[0]; 
		}
		
		
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
                        var callQuery = "action=CLOSE&agent_id=<?=$agentID;?>&call_id="+call_id+"&call_type_id="+callType+"&callTypedup="+callTypedup;
                      //  alert(callQuery);//return false;
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
										
									var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>&disposition="+disposition;
									 
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
	<div class='alert_content'></div>
	</div>
	<div class="row" >
	<div class="col-md-12"  > 
	<div class="row" style="background-color: #000080 ">
		 <div class="col-md-3 header "> Phone Number : <input type="hidden" value="<?=$phone_number;?>" id="phone_number_val" /><?=$phone_number;?> </div>
		 <div class="col-md-3 header "><span> Call ID :</span> <span id="callid"></span> </div>
		 <div class="col-md-3 header "> Date : <?=date('d-m-Y');?> </div> 
		 <div class="col-md-3 header "> Time : <?=date('H:i:s');?></div>
	</div>  
	</div>	
	<div class="col-md-3"  style="background-color: #9cbdff ">
	<div class="form-group" > 
		<table cellpadding="2" cellspacing="2" width="100%"  style="border: 1px solid #fff">
		<tr style="display:none">
			<td align='right' style="font-family:arial;font-size:15px;color:black;">Beneficiary ID :<input type="hidden" value="" id="callidValue"  /></td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
			<input type="text" id="beneficiary_id" onkeypress="return allowValidKey(event,'number');" value="<?php echo rand(000011,999999999);?>" name='beneficiary_id' value="" /></td>
		</tr><tr><td></td></tr>	
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >First Name :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
			<input type="text" id='beneficiary_name' name='beneficiary_name' onkeypress="return allowValidKey(event,'callername');" value="<?=$Beneficiary_Details['Name'];?>"  /></td>
		</tr><tr><td></td></tr>	
		<tr>
					
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Middle Name  :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
			<input type="text" id='beneficiary_surname' name='beneficiary_surname' onkeypress="return allowValidKey(event,'callername');" value=""  /></td>
		</tr><tr><td></td></tr>	
		
		<tr>
					
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Last Name  :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<input type="text" id='beneficiary_lname' name='beneficiary_lname' onkeypress="return allowValidKey(event,'callername');" value=""  /></td>
		</tr><tr><td></td></tr>	
		
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >DOB : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<input type="text" id='dob' name='dob' class="followup_time_picker" onblur="return getAge();" 
				onkeypress="return allowValidKey(event,'number');" value=""  />
				
				<span id="age_span" style='color:red;font-size:10px'></span></td>
		</tr><tr><td></td></tr>	
		
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >AGE : </td>
			<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;">
				<select name="monthyear" id="monthyear" >
					<option value="YEAR">Year</option>
					<option value="MONTH">Month</option>
				</select>
				<input type="text" id='age' name='age' style="width:50px" maxlength=3
				onkeyup="AgeLimit(this.value,this.id);"  onkeypress="return allowValidKey(event,'number');" value=""  
				/><span id="age_span" style='color:red;font-size:10px'></span></td>
		</tr><tr><td></td></tr>	
		<tr>
		
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >GENDER : </td>		
			<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;">
				<label><input type="radio" id="male" checked  name="Gender" value="M" <?=($Beneficiary_Details["gender"]=='M')?"checked":"";?>>Male </label>
		        <label><input type="radio" id="female" name="Gender" value="F" <?=($Beneficiary_Details["gender"]=='F')?"checked":"";?> > Female</label>
				 <label><input type="radio" id="tran" name="Gender" value="T" <?=($Beneficiary_Details["gender"]=='T')?"checked":"";?> > T</label>
			</td>
		</tr><tr><td></td></tr>
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Aadhar : </td>		
			<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;">
			<input type="text" id="aadhar_uid_no" name="aadhar_uid_no" maxlength='12' 
			onkeypress="return allowValidKey(event,'number');" value="" onblur="validcheckaadhar12();" /></td>
		</tr>	
		</tr><tr><td></td></tr>
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >DISTRICT : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;"  id='district' name='district' onchange='GetRegions(this.value,"1");' class="col-md-10">
					<option value=''>Select District</option>
				<?php
				$district_query	= "SELECT ds_dsid,districtname ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
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
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Taluka/Block: </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='tehsil' name='tehsil' onchange='GetRegions(this.value,"2");' class="col-md-10">
		<!--		<option value=''>Select Tehsil</option>-->
				<?php
					$SEL = ($Beneficiary_Details['Taluka_ID'])?"selected":"";
					echo  ($Beneficiary_Details['Taluka_ID'])?"<option  value='".$Beneficiary_Details['Taluka_ID']."~".$Beneficiary_Details['Taluka_Name']."'$SEL>".$Beneficiary_Details['Taluka_Name']."</option>":"<option value=''>--Pickup Taluka--</option>";
				?>
				</select>
			</td>
		</tr>	
		<tr><tr><td></td></tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Village/City: </td>
					
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='city_name' name='city_name' class="col-md-10">
				<?php
					$SEL = ($Beneficiary_Details['Village_ID'])?"selected":"";
 					echo  ($Beneficiary_Details['Village_ID'])?"<option  value='".$Beneficiary_Details['Village_ID']."~".$Beneficiary_Details['Village_Name']."' $SEL>".$Beneficiary_Details['Village_Name']."</option>":"<option value=''>--Pickup City--</option>";
				?>
			</select>
			</td>
		</tr>	
		<tr><tr><td></td></tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Landmark  : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
			<input type="text" id='address' name='address'   /></td>
		</tr><tr><td></td></tr>	
		<tr><tr><td></td></tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Alternative No  : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
			<input type="text" id='ano' name='ano' maxlength='10'  onblur="return validcheckaadhar123();" onkeypress="return allowValidKey(event,'number');" value=""  /></td>
		</tr><tr><td></td></tr>	
		<tr><tr><td></td></tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >landline No  : </td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
			<input type="text" id='ano' name='ano' maxlength='12'  onkeypress="return allowValidKey(event,'number');" value=""  /></td>
		</tr><tr><td></td></tr>	
		<tr>
					
			<td align='right' style="display:none;font-family:arial;font-size:15px;color:black;" >LANGUAGE </td>
			<td align='nowrap' style="display:none;font-family:arial;font-size:15px;color:black;">
				<select  style="font-family:arial;font-size:15px;color:black;" id='language' name='language' class="col-md-10">
					<option value='1~english' >Select Language</option>
					<option  value='1~english' >English </option>
					<option  value='2~hindi' >Hindi</option>
					<option  value='3~Native' >Native</option>
					<option  value='4~Others' >Others</option>
				</select>
			</td>
		</tr><tr><td></td></tr>	
		<tr>
			<td align='right' style="display:none;font-family:arial;font-size:15px;color:black;" >Caste : </td>
			<td align='nowrap' style="display:none;font-family:arial;font-size:15px;color:black;">
				<select style="font-family:arial;font-size:15px;color:black;" id='caste'  name='caste' class="col-md-10">
					<option value="1~g">Select Caste</option>
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
			<td></td><td align='left' style="font-family:arial;font-size:15px;color:black;" >
			<button id='save' name='save' onclick='saveBeneficiaryDetails();'>Save</button> </td>
			<td></td>
		</tr>
		</table>
		<table cellpadding="5" cellspacing="5" width="100%"  style="border: 1px solid #fff">
		<tr>
					<td>Call Type</td>
					<td>
						<select name="CallType" id="CallTypeSS" onchange="return callTyped();"   class="col-md-12">
							<option value="">Select Call Type</option>
							<option value="9999~valid"> Valid </option>
						<?php
						$calltype_query = "SELECT call_type_id,call_type_name FROM m_call_type  WHERE is_active=1 and is_valid=0 order by order_by asc;";
						$calltype_result= mysql_query($calltype_query);
						while($calltype_details = mysql_fetch_array($calltype_result))
						 {
							echo "<option value='".$calltype_details["call_type_id"]."~".$calltype_details["call_type_name"]."' >".$calltype_details["call_type_name"]."</option>";
						 }
						?>
						</select>
					</td>
				</tr>
				
				
			<tr style="display:none" id="mainCalltype">
					<td>Service Type</td>
					<td>
						<select name="CallType" id="CallTypeS" onchange="return callType();"   class="col-md-12">
							<option value="">Select Service Type</option> 
						<?php
						$calltype_query = "SELECT call_type_id,call_type_name FROM m_call_type  WHERE is_active=1 and is_valid=1 order by order_by asc;";
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
					<td><input value="Terminate" style="display:none;color: #ff0000; font-weight: bold; font-size: 10pt;" id="endcall" type="button" onclick="endCall();"></td>
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
					<td><input value="Transfer" style="display:none;color: #ff0000; font-weight: bold; font-size: 10pt;" type="button" onclick="transfer_to_queue('TRANSFER');" id="TransferP"></td>
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
				
			 <div class="col-md-12 HIDEALL displayDataHtml" style="background-color: #000080;display:none " id="HOME" >
				
				<?php //echo $Queue;
				//include('medical_advice_tab.php');
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
				
				  <?php //include('fever.php');?>
				  
			 </div>
			
			 <div class="col-md-12 HIDEALL"  style="display:none" id="SUBPAGEGSS" >
				
				  <?php //include('government_schemes_screen.php');?>
				  
			 </div>
			 <div class="col-md-12 HIDEALL" style="display:none" id="SUBPAGEGREVIENCES" >
				 
				  <?php //include('type_five.php');?>
				  
			 </div>
			  <div class="col-md-12 HIDEALL" style="display:none" id="SUBPAGEINFDIR" >
				 
				  <?php //include('Information_Directory_tab.php');?>
				  
			 </div>
			 
			 
			 
			 
			 
            
          </div>
        </div>       
      </div>
	
	</body>
</html>



<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/grid.css" rel="stylesheet" />
<link href="css/hover.css" rel="stylesheet" media="all">
 

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
