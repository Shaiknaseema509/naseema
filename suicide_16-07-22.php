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

// echo 111; 
$Beneficiary_details_query= mysql_query("select * from mcth_mother where ID_No=''");
$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);


if($phone_number == '')
 {
	// die;	//echo '<script>location.replace("login.php");</script>';
 }


if($agent_id =='') $agent_id='test';
if($phone_number == '') $phone_number='7600195618';
//if($convoxID == '') $convoxID=rand(1233333333,99999999999);

$Beneficiary_details_query= mysql_query("SELECT ci.callid,ci.phone_number,cis.`patient_name`,cis.`caller_name`,cis.`alternate_number`,cis.`age`,cis.`gender_name`,cis.`district_id`,
cis.`district_name`,cis.`mandal_id`,cis.`mandal_name`,
cis.`village_id`,cis.`village_name`,cis.`location`
FROM `call_incident_info` ci 
LEFT JOIN `call_incident_info_details_suicide` cis ON ci.callid = cis.caller_id 
WHERE  ci.phone_number = '".$phone_number."' ORDER BY callid DESC LIMIT 1");
$Beneficiary_Details1 = mysql_fetch_array($Beneficiary_details_query);
 

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



<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVK EMRI </title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    	  <script src="js/jquery-1.10.2.min.js"></script>
<script src="js/moment-with-locales.js"></script>
	<script src="js/bootstrap-datetimepicker.js"></script>
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />

<script type="text/javascript"> 
        var secondsLabel = document.getElementById("seconds");
        var totalSeconds = 0;
        setInterval(setTime, 1000);

        function setTime()
        {
            ++totalSeconds;
            secondsLabel.innerHTML = pad(totalSeconds%1000); 
			
			if(secondsLabel.innerHTML >90)
			{
				 $("#seconds").css("color", "Red");	
			}
			
		if(secondsLabel.innerHTML >110)
			{ 
				 //alert(12321);
				   $("#seconds").addClass("body1");
			} 
			
        }

        function pad(val)
        {
            var valString = val + "";
            if(valString.length < 2)
            {
                return "0" + valString;
            }
            else
            {
                return valString;
            }
	
        }
		
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
	
	
	function endCall1()
	 {
		var disposition = "";
		var Queue = "<?=$Queue;?>";
		var remarks =  document.getElementById('remarks').value;
		var call_id =  document.getElementById('callidValue').value;
		var cat_sub_directory =  document.getElementById('cat_sub_directory').value;
		var callTypes  = document.getElementById('CallTypeSS').value.split('~');
		var callType = callTypes[0]; 
		var callTypedup = callTypes[0]; 
		if(callType == 9999)
		{
			var callTypes  = document.getElementById('CallTypeS').value.split('~');
			var callType = callTypes[0]; 
		}
		
		if(callType ==1  || callType ==4 || callType ==5)
		{ 
			var beneficiary_id =  document.getElementById('beneficiary_ids').value;
			if(beneficiary_id =='' || beneficiary_id == 0)
			{
				 
			}
			 var bids=document.getElementById('bids').value; 
				 if(bids ==0)
				 {
					 // $('.alert').show();
					//$('.alert_content').html('please Add Beneficiary ..!'); 
					//setTimeout(function(){$('.alert').hide();},10000); 
					alert('please Add Beneficiary ..!');
					return false; 
					$('.alert').show();
					$('.alert_content').html('please Add Beneficiary ..!'); 
					setTimeout(function(){$('.alert').hide();},10000); 
					
				 }
		}
		var ccd= ''; var ij=0;
		 $('.ads_Checkbox:checked').each(function () {
            //alert($(this).val());
			ij++;
			var db = $(this).val();
			ccd += '&id'+ij+'='+db;
		});      
		
		//alert(ccd);	 return false;
		 
			disposition = "MEDICALADVICEF";
		 

		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {     
                        var callQuery = "action=CLOSESCHEME&agent_id=<?=$agentID;?>&cat_sub_directory="+cat_sub_directory+"&remarks="+remarks+"&call_id="+call_id+"&call_type_id="+callType+"&callTypedup="+callTypedup+"&cou="+ij+ccd;
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
									alert("Call Successfully Closed");
									var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>&disposition="+disposition;
								 
									postURL(end_call_url,"false");
							 }
                         }
                 }
                delete xmlHttp;         


	 }	
	function GetRegions1(ID,index)
	 {
		 if(index =='') return false;
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
			  else if(index == 6)
			 {
				var callQuery = "action=GetSubcategory&area_id="+ID;
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
						document.getElementById("city_name1").innerHTML="<option value=''>-- Select City/Village --</option>";
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
					  else if(index == 6)
					 {
						document.getElementById("cat_sub_directory").innerHTML=Response;	
					 }
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 function saveGovtDetails11(clickedElement)
         {
                var xmlHttp=newHttpObject();
                
                if(xmlHttp)
                 {
                    	var URL = clickedElement;
						 window.open('Govt_Schemes/'+URL,'winname','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,resizable=no,width=800,height=800');
						 return false;
						 var callQuery="type=SaveGrievance&agent_id=<?=$_REQUEST["agentid"];?>&contact_no=<?=$_REQUEST["callernumber"];?>&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&aadhar_no="+aadhar_no+"&source="+source+"&date="+date+"&grievance_type="+grievance_type+"&nature="+nature+"&name="+name+"&mobile1="+mobile1+"&mobile2="+mobile2+"&email="+email+"&area="+area+"&state="+state+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&branch="+branch+"&residential_address="+residential_address+"&brief_application="+brief_application;
                        //alert(callQuery); //return false;
                        xmlHttp.open("POST","save_Grievance_Details.php",true);
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
		 
		function saveGovtDetails111(clickedElement)
         {
                var xmlHttp=newHttpObject();
                
                if(xmlHttp)
                 {
                    	var URL = clickedElement;
						 window.open('SupportServices/'+URL,'winname','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,resizable=no,width=800,height=800');
						 return false;
						 var callQuery="type=SaveGrievance&agent_id=<?=$_REQUEST["agentid"];?>&contact_no=<?=$_REQUEST["callernumber"];?>&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&aadhar_no="+aadhar_no+"&source="+source+"&date="+date+"&grievance_type="+grievance_type+"&nature="+nature+"&name="+name+"&mobile1="+mobile1+"&mobile2="+mobile2+"&email="+email+"&area="+area+"&state="+state+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&branch="+branch+"&residential_address="+residential_address+"&brief_application="+brief_application;
                        //alert(callQuery); //return false;
                        xmlHttp.open("POST","save_Grievance_Details.php",true);
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
	
	function getAge(dateString) 
	{ 
	
	
		var dateString= $('#dob').val();
		var today = new Date();
		if(dateString =='') return false;
		//  var today = $.format.date(new Date(), 'dd-M-yyyy');
		/*var birthDate = new Date(dateString);
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
		$('#age').val(age);*/
		
		var xmlHttp=newHttpObject();
	
			if(xmlHttp)
			 {
				var callQuery='tabs='+dateString;
				xmlHttp.open("POST","dateofbirth.php",true);
				xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlHttp.send(callQuery);
				xmlHttp.onreadystatechange=function()
				{
					var Response = null;
					Response = xmlHttp.responseText; 
					$('#dbhtml').html(Response);
				}
			 }
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
			$('#not104fever').hide();
			$('#endcall').val('Terminate');
			$('#endcall').show();
		}			
	}
	
	
	function callType(ID)
	{  
		//var callType = $('#callType').val();
		
		var callTypes  = ID;  //document.getElementById('CallTypeS').value.split('~');
		var callType = ID; //callTypes[0];
		
		
		if(callType ==1  || callType ==4 || callType ==5)
		{ 			 
			 var bids=document.getElementById('bids').value; 
			 if(bids ==0)
			 {
				 alert('please Add Beneficiary ..!');
				 return false; 
				 $('.alert').show();
				$('.alert_content').html('please Add Beneficiary ..!'); 
				setTimeout(function(){$('.alert').hide();},10000); 
				return false; 
			 }
		}
		
		
		
		if(callType ==13 || callType ==26) $('#not104fever').hide();
		else $('#not104fever').show();
		 
		 document.getElementById('CallTypeS').value=ID;
		 
		 
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
					//alert(3);
					$('#section_one').html(Response); 
					//$('.displayDataHtml').show(); 
					//if(callType == 13)  $('#endcall').hide();else 
					//$('#endcall').show(); 
					if(ID ==26 || ID ==13) $('.abcdtransergroup').hide();
					else $('.abcdtransergroup').show();
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
										return false;
                                 }
                         }
                 }
                delete xmlHttp;         
	 }

        function transfer_to_queue(ACTION)
        {
			
                //alert(ACTION);
				 
				 var bids=document.getElementById('bids').value; 
				 if(bids ==0)
				 {
					// alert('Add Beneficiary');
					$('.alert').show();
					$('.alert_content').html('please Add Beneficiary ..!'); 
					setTimeout(function(){$('.alert').hide();},10000); 
					return false; 
				 }
				 
				 
				
                var xmlHttp=newHttpObject();
                if(xmlHttp)
                {
					var abc= document.getElementById('call_transfer').value;
			var transfer_split = document.getElementById('call_transfer').value.split('~'); //alert(transfer_split);
			var call_transfer = transfer_split[0]; //alert(queue_id);
			var tf_queue_name = transfer_split[1];
			var queue_id = transfer_split[2];
			
			if(abc =='undefined'  || abc =='')
			{
				 $('.alert').show();
					$('.alert_content').html('Please Select Queue ..!'); 
					setTimeout(function(){$('.alert').hide();},10000); 
					return false; 
			}
                        var beneficiary_id=document.getElementById('beneficiary_ids').value; //alert(beneficiary_id);
                        var agentID = "<?=$agentID;?>"; ;
                        var phoneNumber = "<?=$phone_number;?>";
                        var leadID = "<?=$convoxID;?>"; 
                        var call_id =  document.getElementById('callidValue').value;
					   var process = "<?=$_POST['callProcess'];?>";  
                        
						var call_hit_referenceno = "<?=$call_hit_referenceno;?>";
                        var queue_name = "<?=$_POST[queue_name];?>"; 
                        var call_status = "<?=$_POST[call_status];?>";
                        var transfer_type = "PROCESS";
						
						
						
						if(queue_id ==120)
							var transfer_tos = "MO_104";
                        else
							var transfer_tos = "CO_104";
						
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
					//		alert(callQuery); return false;
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
												alert("Call Tranfer Successfully");
var transfer_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=TRANSFER&convoxid="+leadID+"&agent_id="+agentID+"&disposition=TRANSFERED_CALL&type=PROCESS&transfer_to_process="+transfer_tos+"&call_id="+call_id+"&beneficiary_id="+beneficiary_id;
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
						document.getElementById("city_name").innerHTML="<option value=''>-- Select City/Village --</option>";
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
			else
			{
				$('.alert').hide();
				$('.alert_content').html('');
				//$('#ano').focus();
				//setTimeout(function(){$('.alert').hide();},10000); 
				//return false;
			}				
		 }
	 }
	 
	function saveBeneficiaryDetails1()
	 {
		var xmlHttp=newHttpObject();
		
		if(xmlHttp)
		 {
			var caller_name	= document.getElementById('caller_name').value;
 
			
			var patient_name	= document.getElementById('patient_name').value; 
		  
 
			
			var age	= document.getElementById('age').value;
 
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
 
			var gender = "";
			if(document.getElementById("male").checked)
			 {
				gender = document.getElementById("male").value;
			 }
			else if(document.getElementById("female").checked)
			 {
				gender = document.getElementById('female').value;
			 }
			 else if(document.getElementById("transgender").checked)
			 {
				gender = document.getElementById('transgender').value;
			 }
 
 
			
			var District = document.getElementById('district').value;
 
			var tehsil1 = document.getElementById('tehsil').value; 
			
			var city_name1 = document.getElementById('city_name').value;
 
			 var monthyear = document.getElementById('monthyear').value;
 
			var call_id =  document.getElementById('callidValue').value;
			var phone_number =  document.getElementById('phone_number_val').value; 

			var callQuery="type=SaveDetails&agent_id=<?=$agentID;?>&phone_number="+phone_number+"&ano="+ano+"&age_type="+monthyear+"&call_id="+call_id+"&age="+age+"&Gender="+gender+"&District="+District+"&tehsil1="+tehsil1+"&city_name1="+city_name1+"&address="+address+"&caller_name="+caller_name+"&patient_name="+patient_name;
 
                        xmlHttp.open("POST","save_suicide_details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
									 
									var Response = null;
									Response = xmlHttp.responseText;
									if(Response !='') 
									{
										
										$('#beneficiary_ids').val(Response);
										$('#basicinputNumberbeneficiary_ids').val(Response);
										$('#basicinputNumberbeneficiary_ids_label').html(Response);
									}
									$('.alert').show();
									$('.alert_content').html('Data updated..!');
									setTimeout(function(){$('.alert').hide();},10000); 
									  document.getElementById('bids').value =11; 

									//$('#save').hide();
									$('#save').text('Update');
									$('#TransferP').show();
									$('#endcall').show();
								}
                         }

		 }
		delete xmlHttp;	
	 } 	
	 
	     function transfer_to_queueco(ACTION)
        {           
		saveBeneficiaryDetails1();
                var xmlHttp=newHttpObject();
                if(xmlHttp)
                {
					 
                        //var beneficiary_id=document.getElementById('beneficiary_ids').value; //alert(beneficiary_id);
                        var agentID = "<?=$agentID;?>"; ;
                        var phoneNumber = "<?=$phone_number;?>";
                        var leadID = "<?=$convoxID;?>"; 
                        var call_id =  document.getElementById('callidValue').value;
					   var process = "<?=$_POST['callProcess'];?>";  
                        
						var call_hit_referenceno = "<?=$call_hit_referenceno;?>";
                        var queue_name = "<?=$_POST[queue_name];?>"; 
                        var call_status = "<?=$_POST[call_status];?>";
                        var transfer_type = "PROCESS";
						
						 
							var transfer_tos = "COS_104"; 
						var callQuery='';
					if(call_status == 'WRAPUP')
                        {
                                document.getElementById('call_transfer').disabled=true;
                                alert("You Cannot Tranfer the Call in WRAPUP MODE");
                        }               
                        else
                        {
                                
							callQuery+="&ACTION=TRANSFER&agent_id="+agentID+"&phone_number="+phoneNumber+"&process="+process+"&call_id="+call_id+"&leadID="+leadID+"&call_hit_referenceno="+call_hit_referenceno;
							///alert(callQuery); return false;
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
												alert("Call Tranfer Successfully");
var transfer_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=TRANSFER&convoxid="+leadID+"&agent_id="+agentID+"&disposition=TRANSFERED_CALL&type=PROCESS&transfer_to_process="+transfer_tos+"&call_id="+call_id;
													//alert(transfer_url);//return false;
													postURL(transfer_url,"false");          
											}
									}
							}
                        }
                }
                delete xmlHttp;
        }
	

	 
	 
	 function submits()
	 {
		 $('#cName').html($('#f').val());
		 $('#cAge').html($('#age').val());
		 
		 var callTypes  = document.getElementById('district').value.split('~');
		var callType = callTypes[1]; 
		 
		 $('#cDistrict').html(callType);
		  var callTypes  = document.getElementById('tehsil').value.split('~');
		var callType = callTypes[1]; 
		 
		 $('#cTaluka').html(callType);
		   var callTypes  = document.getElementById('city_name').value.split('~');
		var callType = callTypes[1]; 
		 $('#cVillage').html(callType);
		 
		  var number = 2019000000 + Math.floor(Math.random() * 6);
		 $('#basicinputNumber').val(number);
		 
		  var prgnt  = document.getElementById('prgnts').value;
		 
		  $('#cPregency').html(prgnt);
		 return false;
	 }
	 
	 
	 
	 
	function endCall()
	 {
		var disposition = "";
		var Queue = "<?=$Queue;?>";
		var call_id =  document.getElementById('callidValue').value;
		var callTypes  = document.getElementById('CallTypeSS').value.split('~');
		var callType = callTypes[0]; 
		var callTypedup = callTypes[0]; 
		
		if(callTypes =='')
		{
			 $('.alert').show();
			$('.alert_content').html('Please Select Call Type ..!'); 
			setTimeout(function(){$('.alert').hide();},10000); 
			return false; 
		}
		
		if(callType == 9999)
		{
			var callTypes  = document.getElementById('CallTypeS').value;
			var callType = callTypes; 
		}
		
		if(callType ==1  || callType ==4 || callType ==5)
		{ 
			var beneficiary_id =  document.getElementById('beneficiary_ids').value;
			if(beneficiary_id =='' || beneficiary_id == 0)
			{
				/*$('.alert').show();
				$('.alert_content').html('Save Beneficiary ..!');
				//document.getElementById('aadhar_uid_no').focus();
				setTimeout(function(){$('.alert').hide();},10000); 
				return false;*/
			}
			 var bids=document.getElementById('bids').value; 
				 if(bids ==0)
				 {
					// $('.alert').show();
					//$('.alert_content').html('please Add Beneficiary ..!'); 
					//setTimeout(function(){$('.alert').hide();},10000); 
					alert('please Add Beneficiary ..!');
					return false; 
				 }
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
										alert("Call Closed Successfully");
										
									var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>&disposition="+disposition;
									 
										postURL(end_call_url,"false");
                                 }
                         }
                 }
                delete xmlHttp;         


	 }	

</script>

    <script>
	
		function removeSP(ID)
		{
			var va = $('#'+ID).val();
			//if(va =='#')
				str = va.replace(/[_\W]+/g, "");
			$('#'+ID).val(str);
		}
	
		function checkPrgenet()
		{
			var age =  $('#age').val();
			var monthyear =  $('#monthyear').val();
			//var female =  $('#female').val();
			if(document.getElementById("male").checked)
			 {
				gender = document.getElementById("male").value;
			 }
			else if(document.getElementById("female").checked)
			 {
				gender = document.getElementById('female').value;
			 }
			 else if(document.getElementById("transgender").checked)
			 {
				gender = document.getElementById('transgender').value;
			 }
			//prgnt
			if(gender != 'F')
			{
				$('.prgnt').hide(); //return false;
			}
			if(gender =='F' && monthyear =='YEAR')
			{
				if(14 < age  && age < 49)
				{
					$('.prgnt').show();
				}
				else
				{
					$('.prgnt').hide();
				}				
			}
			else
			{
				$('.prgnt').hide();
			}
			 
		}
	
		
        function myFunction() {
            document.getElementById("section_one").style.display = "block";
            document.getElementById("section_two").style.display = "none";
            document.getElementById("section_three").style.display = "none";
            document.getElementById("section_four").style.display = "none";
        }

        function myFunction1() {
            document.getElementById("section_two").style.display = "block";
            document.getElementById("section_one").style.display = "none";
            document.getElementById("section_three").style.display = "none";
            document.getElementById("section_four").style.display = "none";
        }
        function myFunction2() {
            document.getElementById("section_three").style.display = "block";
            document.getElementById("section_one").style.display = "none";
            document.getElementById("section_two").style.display = "none";
            document.getElementById("section_four").style.display = "none";
        }
        function myFunction3() {
            document.getElementById("section_four").style.display = "block";
            document.getElementById("section_one").style.display = "none";
            document.getElementById("section_two").style.display = "none";
            document.getElementById("section_three").style.display = "none";
        }
    </script>
</head>

 
	
	
 

<body onload='GetCallID();'>
	<input type="hidden" value="" id="callidValue"  />
<div class="alert">
	<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
	<div class='alert_content'></div>
	</div>
    <div class="navbar navbar-fixed-top" style="display:none">
        <div class="navbar-inner">
            <div class="container" style="width:1130px !important">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>
                <a class="brand" href="index.html">
                    <b>
                        <span>Health Helpline </span>
                    </b>
                </a>
                <div class="nav-collapse collapse navbar-inverse-collapse">

                    <ul class="nav pull-right">

                        <li>
                            <a href="#">
                                <img src="images/gvk-emri.jpg" style="height:40px;width:180px;"></img>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /navbar -->
    <div class="wrapper" style="min-height:600px;">
	      <div class="container" style="width:100% !important">
            <div class="row" style="width:1300px !important"><input type="hidden" value="<?=$phone_number;?>" id="phone_number_val" />
            
             

			 <div class="span9">
                    <div class="content">
                        <section id="section_one" style="min-height: 450px;">
                            <div class="btn-controls" style="color:white;background: radial-gradient(ellipse farthest-corner at center center, rgba(0,0,0,0.5) 20%, rgba(0,0,0,0.85) 100%) repeat scroll 0% 0%; min-height:410px;max-height:510px;overflow-x: hidden;overflow-y:scroll">
                                 
                                <div class="modue">
                                    <div class="module-boy">
									<legend class="">
                        <button type="button" style="width:100%" class="btn btn-info ribbon">Caller Information</button>
                    </legend>
                                        <form class="form-horizontal row-fluid">
                                            <div class="row ">
											 
                    
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Phone Number</label>
                                                        <div class="controls">
                                                            <input class="form-control" type="text" id="phone_number_val" readonly value="<?=$phone_number;?>" placeholder="Type Phone Number..." class="span12">
															<input type="hidden" id="beneficiary_ids"  name='beneficiary_ids' value="<?php echo $Beneficiary_Details1['registration_id'];?>" />                                                     
													 </div>
                                                    </div>
                                                </div>
                                                <div class="span6" style="display:none">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Transfer Group</label>
                                                        <div class="controls">
                                                            <input class="form-control" type="text" id="basicinput" placeholder="Type Phone Number..." 
															>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
 
                                            <div class="row">
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Caller Name</label>
                                                        <div class="controls">
                                                            <input type="text" id="caller_name" onkeypress="return allowValidKey(event,'callername');" value="<?php echo $Beneficiary_Details1['caller_name'];?>" onkeyup="return removeSP('beneficiary_lname');"  placeholder="Type Last Name..." class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
												
												 <div class="span6"  >
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Patient Name</label>
                                                        <div class="controls">
                                                            <input type="text" id="patient_name" onkeypress="return allowValidKey(event,'callername');" value="<?php echo $Beneficiary_Details1['patient_name'];?>"  onkeyup="return removeSP('beneficiary_lname');"
															placeholder="Type Number..." class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                            </div><br />
                                            <div class="row">
                                                <div class="span6">
                                                    <div class="control-group">
													
													<input type="hidden" id='dob' name='dob' class="followup_time_picker" onblur="return getAge();" 
				onkeypress="return allowValidKey(event,'number');"   />
                                                        <label class="control-label" for="basicinput">Age</label>
                                                        <div class="controls">
                                                           <select name="monthyear" id="monthyear" onchange="return checkPrgenet()" class="form-control" style="width:90px" >
													<option <?=($Beneficiary_Details["age_type"]=='YEAR')?"checked":"";?> value="YEAR">Year</option>
													<option <?=($Beneficiary_Details["age_type"]=='MONTH')?"checked":"";?> value="MONTH">Month</option>
												</select>
												<input type="text" id='age' class="form-control" name='age' style="width:110px" maxlength=3
												onkeyup="AgeLimit(this.value,this.id,monthyear.value);" onblur="return checkPrgenet();"  onkeypress="return allowValidKey(event,'number');" value="<?php echo $Beneficiary_Details1['age'];?>" 
												/><span id="age_span" style='color:red;font-size:10px'></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">GENDER </label>
                                                        <div class="controls">
                                                           <input type="radio" id="male" onclick="return checkPrgenet();" checked  name="Gender" value="M" <?=($Beneficiary_Details1["gender"]=='M')?"checked":"";?>>Male        
														   <input type="radio" id="female" onclick="return checkPrgenet();" name="Gender" value="F" <?=($Beneficiary_Details1["gender"]=='F')?"checked":"";?> > Female 
														   <input type="radio" id="transgender" onclick="return checkPrgenet();" name="Gender" value="T" <?=($Beneficiary_Details1["gender"]=='T')?"checked":"";?> > Transgender 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Alternative Number</label>
                                                        <div class="controls">
                                                            <input type="text" id="ano" maxlength='10' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															onblur="return validcheckaadhar123();" onkeypress="return allowValidKey(event,'number');" placeholder="Enter Alternative Number..." class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">District</label>
                                                        <div class="controls">
                                                            <select class="form-control" style="font-family:arial;"  id='district' name='district' onchange='GetRegions(this.value,"1");' class="form-control" >
					<option value=''>Select District</option>
				<?php
				$district_query	= "SELECT ds_dsid,districtname ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					$SEL = ($Beneficiary_Details1['district_id']==$district_details["ds_dsid"])?"selected":"";
					echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."' $SEL >".$district_details["ds_lname"]."</option>";
				 }
				?>		
			
				</select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Taluka/Block</label>
                                                        <div class="controls">
                                                           <select class="form-control" style="font-family:arial;" id='tehsil' name='tehsil' onchange='GetRegions(this.value,"2");' class="form-control">
		<!--		<option value=''>Select Tehsil</option>-->
				<?php
				$district_query	= "SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid=".$Beneficiary_Details1['district_id']." ORDER BY md_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {
					 
					$SEL = ($Beneficiary_Details1['block_id'])?"selected":"";
					echo  ($district_details['md_mdid'])?"<option  value='".$district_details['md_mdid']."~".$district_details['md_lname']."'$SEL>".$district_details['md_lname']."</option>":"<option value=''>--Pickup Taluka--</option>";
				 }
				?>	
				</select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Village/City</label>
                                                        <div class="controls">
                                                            <select class="form-control" style="font-family:arial;font-size:15px;color:black;" id='city_name' name='city_name' class="form-control">
				<?php
				$district_query	= "SELECT ct_ctid,ct_lname FROM m_city WHERE ct_mdid=".$Beneficiary_Details1['block_id']." AND is_active=1 ORDER BY ct_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {?>
				<?php
					$SEL = ($Beneficiary_Details1['village_id'])?"selected":"";
 					echo  ($district_details['ct_ctid'])?"<option  value='".$district_details['ct_ctid']."~".$district_details['ct_lname']."' $SEL>".$district_details['ct_lname']."</option>":"<option value=''>--Pickup City--</option>";
				 }?>
			</select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Landmark </label>
                                                        <div class="controls">
                                                            <input type="text" id='address' class="form-control" name='address' value="<?php echo $Beneficiary_Details1['address'];?>"  placeholder="Enter Landmark..." class="span12">
                                                        </div>
                                                    </div>
                                                </div>
 
                                            </div><br />
   
                                            <div class="control-group" style="float:right">
 
												
												 <div style="float:left" class="abcdtransergroup">
                                                <button type="button" onclick="transfer_to_queueco('TRANSFER');" id="TransferP" class="btn btn-large btn-primary">Transfer</button>
												</div>
												
                                            </div>
                                            <br />
                                            <hr />
                                          
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.wrapper-->
    <div class="footer" style="display:none">
        <div class="container">
            <b class="copyright">&copy; 2019 GVK-EMRI ITIS </b>All rights reserved.
        </div>
    </div>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="scripts/common.js" type="text/javascript"></script>

</body>

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

function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function SaveInformationDirectory(sub_directory,District)
	 {
		var xmlHttp=newHttpObject(); 
		
		if(xmlHttp)
		 {
			var call_id 	   = document.getElementById('callid').innerHTML;
			var DistrictID	   = document.getElementById('District').value;
			var SubDirectoryID = document.getElementById('sub_directory').value;
			var subSubDirectoryID = document.getElementById('cat_sub_directory').value;
			
			var callQuery = "action=SEARCHHOSPITAL&sub_directory_id="+SubDirectoryID+"&subSubDirectoryID="+subSubDirectoryID+"&district_id="+DistrictID+"&call_id="+call_id;
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
	 
function SaveInformationDirectoryMedical(sub_directory)
	 {
		var xmlHttp=newHttpObject(); 
		
		if(xmlHttp)
		 {
			var call_id 	   = document.getElementById('callid').innerHTML;  
			
			var complaint = document.getElementById('complaint').value;
			var advice = document.getElementById('advice').value;
			var bskpoint = document.getElementById('bskpoint').value;
			
			
			var output = jQuery.map($(':checkbox[name=chkSmolking\\[\\]]:checked'), function (n, i) {
				return n.value;
			}).join(',');
			
			var callQuery = "type=SAVEMEDICAL&complaint="+complaint+"&advice="+advice+"&outputs="+output+"&call_id="+call_id+"&bskpoint="+bskpoint;
			//alert(callQuery);
			xmlHttp.open("POST","getMedicaladvicequestions.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText; 
						 $('#idmdn').hide();

			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 	 
</script>

<style>
	  
 
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