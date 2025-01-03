<?php  error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$phone_number         = $_REQUEST["callernumber"];
$Queue 	              = strtoupper($_REQUEST["queue_name"]);
$Queue                = ($Queue)?$Queue:"MEDADV_MQ";
$agentID 	      = $_REQUEST["agent_id"];
$call_hit_referenceno = $_REQUEST["call_hit_referenceno"];
$convoxID = $_REQUEST["convoxid"];
$callid = $_REQUEST["callid"];

//echo "<pre>".print_r($_REQUEST,1)."</pre>"; die;

$Beneficiary_details_query= mysql_query("select * from mcth_mother where ID_No=''");
$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);


if($phone_number == '')
 {
	// die;	//echo '<script>location.replace("login.php");</script>';
 }


if($agent_id =='') $agent_id='test';
if($phone_number == '') $phone_number='7227018160';
//if($convoxID == '') $convoxID=rand(1233333333,99999999999);

$current_date = date("Y-m-d");

$Query1 = "SELECT COUNT(*) AS TODAY_COUNT FROM call_incident_info WHERE call_time >= '$current_date 00:00:00' AND call_time <= '$current_date 23:59:59' AND phone_number='".$phone_number."' AND status!='ABANDONED';";
//$Result1     = mysql_query($Query1);
//$Details1    = mysql_fetch_array($Result1);
$Today_Count =0; // $Details1["TODAY_COUNT"];


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
		  
		 
 <link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">
  <script src="js/jquery.dropdown.js"></script>
   <script type="text/javascript" src="js/mock.js"></script>
		 
	 <script type="text/javascript">
 	$(function () {
                //$('.followup_time_picker').datetimepicker({format: 'YYYY/MM/DD'});
			//	$('.followup_time_picker').datetimepicker({format: 'DD-MM-YYYY'});
				//$('.followup_time_picker').datetimepicker({format: 'DD-MM-YYYY'});
        });
		
		function drugFormUnits(a)
		{
			//alert(a);
			if(a == 'YES')
			{
				
				$('#drugFormUnit').show();
				$('#drug_Save').show();
				$('#save_Details').hide();				
			}				
			else
			{
				$('#drugFormUnit').hide();
				$('#save_Details').show();
				$('#drug_Save').hide();
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
	
	
	function callTypeChange()
	{
		var disposition = "";
		var Queue = "<?=$Queue;?>";
		//var subCatMul =  document.getElementById('subCatMul').value;
		var call_id =  document.getElementById('callidValue').value;
		var callTypes  = document.getElementById('CallTypeSS').value.split('~');
		var callType = callTypes[0]; 
		var callTypedup = callTypes[0]; 
		
		 
		if(callType !=36)
		{ 
			 $('.subCatSuspect').hide();
		}
		else 
		{
			$('.subCatSuspect').show();
		}
	}
	
	function sendSMS(keyText,tableName)
	{
		var xmlHttp=newHttpObject();
                
		if(xmlHttp)
		 {				 
				 var callQuery="keyText="+keyText+"&tableName="+tableName+"&phone_number=<?=$phone_number;?>";
				 
				xmlHttp.open("POST","ajaxSMS.php",true);
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
	 
	 function GetRegionsdrug(ID,index)
	 {
		 if(index =='') return false;
		var xmlHttp=newHttpObject();
        
		if(xmlHttp)
		 {
			 
				var callQuery = "action=GetSubdrugForm&area_id="+ID;
			 
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
					 
						document.getElementById("sysmed1_"+index).innerHTML=Response;	
					 
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
		
		var callTYpeIDS= document.getElementById('CallTypeS').value;
		if(callTYpeIDS =='')
		{	 
			document.getElementById('CallTypeS').value=ID;
		}
		else 
		{
			 $('.alert').show();
				$('.alert_content').html('Already select Call type ..!'); 
				setTimeout(function(){$('.alert').hide();},10000); 
			return false;
		}
		  //document.getElementById('CallTypeS').value=ID;
		var calliIDD = document.getElementById('callidValue').value;
		 
		 
		var xmlHttp=newHttpObject();
	
			if(xmlHttp)
			 {
				var callQuery='tabs='+callType+'&callernumber=<?php echo $phone_number;?>&agentid=<?php echo $agentID;?>&convoxID=<?php echo $convoxID;?>&callid='+calliIDD;
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
			$('#CallTypeSS').val('9999~valid');
			 document.getElementById('CallTypeSS').disabled=true;	
	}
	
	
	
	function GetCallID()
         {
			var xmlHttp=newHttpObject();
	
			if(xmlHttp)
			 {
				var callQuery='agent_id=<?=$agentID;?>&call_hit_referenceno=<?=$call_hit_referenceno;?>&phone_number=<?=$phone_number;?>' ;
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
                                
							callQuery+="&ACTION=TRANSFER&agent_id="+agentID+"&phone_number="+phoneNumber+"&process="+process+"&call_id="+call_id+"&leadID="+leadID+"&call_hit_referenceno="+call_hit_referenceno+"&tType="+transfer_tos;
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
	 
	function saveBeneficiaryDetails()
	 {
		var xmlHttp=newHttpObject();
		
		if(xmlHttp)
		 {
			var beneficiary_id	= document.getElementById('beneficiary_ids').value;
			/*if(beneficiary_id == "")
			{
				showAlert();
                                document.getElementById("beneficiary_id").focus();
                                return false;
			}*/
			
 
			
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
			 else if(document.getElementById("transgender").checked)
			 {
				gender = document.getElementById('transgender').value;
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
			 
		
			var language_id = ''; //document.getElementById('language').value;
			 
		
			var caste = ''; //document.getElementById("caste").value;	
			 

			/*var social_status = document.getElementById('social_status').value;
			if( social_status == "" )
			 {
				showAlert();
				document.getElementById('social_status').focus();
				return false;
			 }*/
			
			var education_id = ''; //document.getElementById('education').value;
			 

			var occupation_id = ''; //document.getElementById('occupation').value;
			 
			
			var marital_status_id = ''; //document.getElementById('marrital_status').value;
			 
			
			var Advice_sought_by = ''; //document.getElementById('Advice_sought_by').value;
			 
			
			var relationship_id = ''; //document.getElementById('relationship').value;
			 
			
			var present_compalint = ''; //document.getElementById('present_complaint').value;
			 
		
			var advice_given = ''; //document.getElementById('advice_given').value;
			 var call_id = document.getElementById('callidValue').value;
		var mother='';var email=''; 

		
		
		$('#cName').html($('#beneficiary_name').val());
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
		 
		 $('#cPregency').html($('#prgnts').val());
		 
		//  var number = 2019000000 + Math.floor(Math.random() * 6);
		 //$('#basicinputNumber').val(number);


			var callQuery="type=SaveBeneficiary&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&ano="+ano+"&dob="+dob+"&aadhar_uid_no="+aadhar_uid_no+"&age_type="+monthyear+"&beneficiary_lname="+beneficiary_lname+"&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&beneficiary_name="+beneficiary_name+"&benificiery_surname="+beneficiary_surname+"&age="+age+"&Gender="+gender+"&mother="+mother+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&email="+email+"&language_id="+language_id+"&education_id="+education_id+"&occupation_id="+occupation_id+"&marital_status_id="+marital_status_id+"&address="+address+"&relationship_id="+relationship_id+"&present_compalint="+present_compalint+"&advice_given="+advice_given;
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
									if(Response !='') 
									{
										$('#beneficiary_ids').val(Response);
										$('#bids').val(Response);
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


function save_details2()
{
				var disposition = "";
		var Queue = "<?=$Queue;?>";
	if($('#beneficiary_name').val())
	
		var xmlHttp=newHttpObject();
		
		if(xmlHttp)
		 {
			var beneficiary_id	= document.getElementById('basicinputNumberbeneficiary_ids').value; 
			var mhu	= document.getElementById('mhu').value; 
			var call_type	= document.getElementById('call_type').value; 
			if(call_type == "")
			 {
				showAlert();
				document.getElementById('call_type').focus();
				return false;
			 }		
			
			var callid	= document.getElementById('callid').value; 
			var sysdig	= document.getElementById('sysdig').value;	 
			var sysdoc	= document.getElementById('sysdoc').value; 
			var abdbdoctor	= document.getElementById('abdbdoctor').value; 
			var adbsp	= document.getElementById('adbsp').value; 
			var medp = document.getElementById('medp').value; 
			var medprem = document.getElementById('medprem').value;
 

			var callQuery="type=save_telemedicine&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&beneficiary_id="+beneficiary_id+"&callid="+callid+"&sysdig="+sysdig+"&sysdoc="+sysdoc+"&abdbdoctor="+abdbdoctor+"&adbsp="+adbsp+"&medp="+medp+"&medprem="+medprem+"&mhu="+mhu+"&call_type="+call_type;
 
                        xmlHttp.open("POST","save_details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
							 var end_call_url = "http://192.168.3.24/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
									//alert(end_call_url);
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 { //alert(123);
									/*var Response = null;
									Response = xmlHttp.responseText;
									if(Response !='') 
									{
										$('#beneficiary_ids').val(Response);
										$('#bids').val(Response);
										$('#basicinputNumberbeneficiary_ids').val(Response);
										$('#basicinputNumberbeneficiary_ids_label').html(Response);
									}
									$('.alert').show();
									$('.alert_content').html('Data updated..!');
									setTimeout(function(){$('.alert').hide();},10000); 
									document.getElementById('bids').value =11; 
				 
 
									$('#save').text('Update');
									$('#TransferP').show();
									$('#endcall').show();
*/
								//	var end_call_url = "http://192.168.3.24/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
									//alert(end_call_url);
									//postURL(end_call_url,"false");
 

								}
                         }

		 }
		delete xmlHttp;
}

function save_details1()
{
	
	//save_details2();
				var disposition = "";
		var Queue = "<?=$Queue;?>";
	if($('#beneficiary_name').val())
	
		var xmlHttp=newHttpObject();
		
		if(xmlHttp)
		 {
			var beneficiary_id	= document.getElementById('basicinputNumberbeneficiary_ids').value; 
			var mhu	= document.getElementById('mhu').value; 
			var call_type	= document.getElementById('call_type').value; 
			if(call_type == "")
			 {
				showAlert();
				document.getElementById('call_type').focus();
				return false;
			 }		
			
			var callid	= document.getElementById('callid').value; 
			var sysdig	= document.getElementById('sysdig').value;	 
			var sysdoc	= document.getElementById('sysdoc').value; 
			var abdbdoctor	= document.getElementById('abdbdoctor').value; 
			var adbsp	= document.getElementById('adbsp').value; 
			var medp = document.getElementById('medp').value; 
			var medprem = document.getElementById('medprem').value;
 

			var callQuery="type=save_telemedicine&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&beneficiary_id="+beneficiary_id+"&callid="+callid+"&sysdig="+sysdig+"&sysdoc="+sysdoc+"&abdbdoctor="+abdbdoctor+"&adbsp="+adbsp+"&medp="+medp+"&medprem="+medprem+"&mhu="+mhu+"&call_type="+call_type;
 
                        xmlHttp.open("POST","save_details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
							 var end_call_url = "http://192.168.3.24/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
									//alert(end_call_url);
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 { //alert(123);
									/*var Response = null;
									Response = xmlHttp.responseText;
									if(Response !='') 
									{
										$('#beneficiary_ids').val(Response);
										$('#bids').val(Response);
										$('#basicinputNumberbeneficiary_ids').val(Response);
										$('#basicinputNumberbeneficiary_ids_label').html(Response);
									}
									$('.alert').show();
									$('.alert_content').html('Data updated..!');
									setTimeout(function(){$('.alert').hide();},10000); 
									document.getElementById('bids').value =11; 
				 
 
									$('#save').text('Update');
									$('#TransferP').show();
									$('#endcall').show();
*/
									var end_call_url = "http://192.168.3.24/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
									//alert(end_call_url);
									postURL(end_call_url,"false");
 

								}
                         }

		 }
		delete xmlHttp;
}

function drug_save()
{
	save_details2();
			var disposition = "";
		var Queue = "<?=$Queue;?>";
		var xmlHttp=newHttpObject();
		
		if(xmlHttp)
		 {  
			var beneficiary_id	= document.getElementById('basicinputNumberbeneficiary_ids').value; 			
			var callid	= document.getElementById('callid').value; 
			var callQuery ="type=save_drug&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&beneficiary_id="+beneficiary_id+"&callid="+callid;
 
			  for (var i = 0; i <=4; i++) 
			  {
				var sysdig	= document.getElementById('sysdig1_'+i).value; 
				var sysmed	= document.getElementById('sysmed1_'+i).value;
				var descsysmer	= document.getElementById('descsysmer_'+i).value;
				callQuery +="&sysdig1_"+i+"="+sysdig+"&sysmed1_"+i+"="+sysmed+"&descsysmer1_"+i+"="+descsysmer; 
			  } 
			  
                        xmlHttp.open("POST","save_details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                        {
                                if(xmlHttp.readyState==4 && xmlHttp.status==200)
                                {
									var Response = null;
									Response = xmlHttp.responseText;
									if(Response !='') 
									{
										$('#beneficiary_ids').val(Response);
										$('#bids').val(Response);
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
									
									var end_call_url = "http://192.168.3.24/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>&disposition="+disposition;
									postURL(end_call_url,"false");
									 
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
		var subCatMul =  document.getElementById('subCatMul').value;
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
		if(callType ==36)
		{ 
			if(subCatMul =='')
			{
				 $('.alert').show();
				$('.alert_content').html('Please Select Subb Call Type ..!'); 
				setTimeout(function(){$('.alert').hide();},10000); 
				return false; 
			}
		}
		
		if(callType == 9999)
		{
			var callTypes  = document.getElementById('CallTypeS').value;
			var callType = callTypes; 
			
			 var bids=document.getElementById('bids').value; 
				 if(bids ==0)
				 {
					// $('.alert').show();
					//$('.alert_content').html('please Add Beneficiary ..!'); 
					//setTimeout(function(){$('.alert').hide();},10000); 
					alert('Please Add Beneficiary ..!');
					return false; 
				 }
			
		}
		 var subCatMuls='';
		 $.each($(".subCatMul option:selected"), function(){
				subCatMuls += $(this).val()+',';   //alert($(this).val());
			});
		
		//alert(subCatMuls); return false;
		//if(callType ==1  || callType ==4 || callType ==5 || callType ==35 || callType ==24 || callType ==36)
		if(callType ==1  || callType ==2  || callType ==3 || callType ==4 || callType ==6 || callType ==5 || callType ==9 || callType ==13 || callType ==19 || callType ==20 || callType ==22 || callType ==24 || callType ==25 || callType ==26 || callType ==28 || callType ==29 || callType ==30 || callType ==31 || callType ==32 || callType ==33  || callType ==34  || callType ==35 || callType ==36 || callType ==37 )
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
					alert('Please Add Beneficiary ..!');
					return false; 
				 }
		}
		//alert(subCatMul); return false;
		
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
                        var callQuery = "action=CLOSE&agent_id=<?=$agentID;?>&call_id="+call_id+"&call_type_id="+callType+"&callTypedup="+callTypedup+"&subCatMul="+subCatMuls;
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
	 
function conCall()
{
 
	var vehicle_phone_number='';
	var vehicle_phone_number=document.getElementById("txtcontact").value;
     openWindowpostURL("http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/control_panel.php?vehicle_phone_number=07922810089","Conference_Call","width=420,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");                            
 return false;
}

function openWindowpostURL(url,windowName,windowOption)
{
                var form = document.createElement("FORM");
                form.method = "POST";
                form.style.display = "none";
                form.target=windowName;
                document.body.appendChild(form);
                form.action = url.replace(/\?(.*)/, function(_, urlArgs) {
                urlArgs.replace(/\+/g, " ").replace(/([^&=]+)=([^&=]*)/g, function(input, key, value) {
                input = document.createElement("INPUT");
                input.type = "hidden";
                input.name = decodeURIComponent(key);
                input.value = decodeURIComponent(value);
                form.appendChild(input);
                });
                return "";
                });
                var openedWindow = window.open("", windowName, windowOption);
                form.submit();
                openedWindow.focus();
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


	<?php
$benquery = "SELECT * FROM registration WHERE contact_no = '".$phone_number."' order by call_id desc limit 1 ;";
$benquery1     = mysql_query($benquery);
$Beneficiary_Details    = mysql_fetch_array($benquery1);	


if($Beneficiary_Details['registration_id'] == '') $bids='';
	else $bids=11;
?>	
	
	
	 <input type="hidden" id="bids" value='<?php echo $bids;?>' />


<body onload=''>
	<input type="hidden" value="<?php echo $callid;?>" id="callidValue"   />
<div class="alert">
	<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
	<div class='alert_content'></div>
	</div>
     
    <!-- /navbar -->
    <div class="wrapper" style="min-height:600px;">
        <div class="container" align="center" style="">
            <div class="row" style=""><input type="hidden" value="<?=$phone_number;?>" id="phone_number_val" />
              
			 <div class="span9" style="width:1100px;">
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
	                                                   
													 </div>
                                                    </div>
                                                </div>
                                             <!--   <div class="span6" style="display:none">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Transfer Group</label>
                                                        <div class="controls">
                                                            <input class="form-control" type="text" id="basicinput" placeholder="Type Phone Number..." 
															>
                                                        </div>
                                                    </div>
                                                </div>-->
												<div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Callid</label>
                                                        <div class="controls">
                                                            <input class="form-control" type="text" id="callid" readonly value="<?php echo $callid;?>" placeholder="Type Phone Number..." class="span12">
	                                                   
													 </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">First Name</label>
                                                        <div class="controls">
                                                            <input type="text" id="beneficiary_name" 
															value="<?php echo $Beneficiary_Details['beneficiary_name'];?>" 
															class="form-control" onkeypress="return allowValidKey(event,'callername');" onkeyup="return removeSP('beneficiary_name');"  placeholder="Type First Name..."class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Middile Name</label>
                                                        <div class="controls">
                                                            <input type="text" id="beneficiary_surname" onkeypress="return allowValidKey(event,'callername');" onkeyup="return removeSP('beneficiary_surname');"  value="<?php echo $Beneficiary_Details['benificiery_surname'];?>" placeholder="Type Middile Name..." class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Last Name</label>
                                                        <div class="controls">
                                                            <input type="text" id="beneficiary_lname" onkeypress="return allowValidKey(event,'callername');" onkeyup="return removeSP('beneficiary_lname');"  value="<?php echo $Beneficiary_Details['beneficiary_last'];?>" placeholder="Type Last Name..." class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
												
												 <div class="span6"  >
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Landline No</label>
                                                        <div class="controls">
                                                            <input type="text" maxlength='12' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  onkeypress="return allowValidKey(event,'number');"
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
												onkeyup="AgeLimit(this.value,this.id,monthyear.value);" onblur="return checkPrgenet();"  onkeypress="return allowValidKey(event,'number');" value="<?php echo $Beneficiary_Details['age'];?>" 
												/><span id="age_span" style='color:red;font-size:10px'></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">GENDER </label>
                                                        <div class="controls">
                                                           <input type="radio" id="male" onclick="return checkPrgenet();" checked  name="Gender" value="M" <?=($Beneficiary_Details["gender"]=='M')?"checked":"";?>>Male        
														   <input type="radio" id="female" onclick="return checkPrgenet();" name="Gender" value="F" <?=($Beneficiary_Details["gender"]=='F')?"checked":"";?> > Female 
														   <input type="radio" id="transgender" onclick="return checkPrgenet();" name="Gender" value="T" <?=($Beneficiary_Details["gender"]=='T')?"checked":"";?> > Transgender 
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
																$SEL = ($Beneficiary_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
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
				$district_query	= "SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid=".$Beneficiary_Details['district_id']." ORDER BY md_lname ASC;";
				$district_result= mysql_query($district_query);
				while($district_details = mysql_fetch_array($district_result))
				 {					 
					$SEL = ($Beneficiary_Details['block_id'] == $district_details['md_mdid'])?"selected":"";
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
																$district_query	= "SELECT ct_ctid,ct_lname FROM m_city WHERE ct_mdid=".$Beneficiary_Details['block_id']." AND is_active=1 ORDER BY ct_lname ASC;";
																$district_result= mysql_query($district_query);
																while($district_details = mysql_fetch_array($district_result))
																 {?>
																<?php
																	$SEL = ($Beneficiary_Details['village_id'] == $district_details['ct_ctid'])?"selected":"";
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
														<textarea id='address' class="form-control" name='address'  placeholder="Enter Landmark..." class="span12"><?php echo $Beneficiary_Details['address'];?></textarea>
													<?php /*	<input type="text" id='address' class="form-control" name='address' value="<?php echo $Beneficiary_Details['address'];?>"  placeholder="Enter Landmark..." class="span12"> */ ?>
                                                        
														</div>
                                                    </div>
                                                </div>
                                                <div class="span6"  >
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Aadhar No</label>
                                                        <div class="controls">
                                                            <input type="text" onkeypress="return allowValidKey(event,'number');"   maxlength='12' 
															id="aadhar_uid_no" placeholder="Enter No..." onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" onblur="validcheckaadhar12();" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Beneficiary ID </label>
                                                        <div class="controls">
                                                            <input type="hidden" id="basicinputNumberbeneficiary_ids" value="<?php echo $bids;?>" disabled class="form-control">
														<p id="basicinputNumberbeneficiary_ids_label"> <?php echo $Beneficiary_Details['registration_id'];?></p>
													   </div>
                                                    </div>
                                                </div>
                                                <div class="span6 prgnt" >
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">	Call Type</label>
                                                        <div class="controls">
                                                            <select name="call_type1" id="call_type1">
															<option value="">Select </option>
															<option value="1">Effective</option>
															<option value="2">Suspected Case</option>
															<option value="3">Corona Virus</option>
															<option value="4">Covid 19 Vaccine</option>												
														 </select>
														</div>
                                                    </div>
                                                </div>
                                            </div> 
                                          <!--  <div class="control-group" style="float:right">
                                                <div class="controls">
                                                    <input type="button" onclick="return saveBeneficiaryDetails();" class="btn btn-large btn-primary"
													value="Update" />
                                                </div>
                                            </div>-->
                                            <br />
                                            <hr />
                                          
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                         
						 
						 <section id="section_one" style="min-height: 450px;">
                            <div class="btn-controls" style="color:white;background: radial-gradient(ellipse farthest-corner at center center, rgba(0,0,0,0.5) 20%, rgba(0,0,0,0.85) 100%) repeat scroll 0% 0%; min-height:410px;max-height:510px;overflow-x: hidden;overflow-y:scroll">
                                 
                                <div class="modue">
                                    <div class="module-boy">
									<legend class="">
										<button type="button" style="width:100%" class="btn btn-info ribbon">Adviser IncidentInfo - <?php echo $callid;?></button>
									</legend>
                                        <form class="form-horizontal row-fluid">
                                            <div class="row " style="display:none">  
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Do You want call </label>
                                                        <div class="controls">
															<input type="radio" name="abcd" value="YES">Yes    	                                                   
															<input type="radio" name="abcd" checked value="NO">No    	                                                   
														</div>
                                                    </div>
                                                </div>
												<div class="span6">
                                                    <div class="control-group">
                                                         
                                                    </div>
                                                </div>
											</div>
											<div class="row "> 	
												<div class="span6">

                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput"> Call Type </label>
                                                        <div class="controls">
                                                            <select class="form-control" style="font-family:arial;font-size:15px;color:black;" id='call_type' name='call_type' class="form-control">
																<?php $ab= mysql_query("SELECT `call_type_id`,`call_type_name` FROM `m_call_type` WHERE call_category = 1");
																while($dig =mysql_fetch_array($ab))
																{?>
																	<option value="<?php echo $dig['call_type_id'];?>"><?php echo $dig['call_type_name'];?></option>
																<?php } ?>
															</select>
                                                        </div>
                                                    </div>													
                                                </div>
												<div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">	MHU</label>
                                                        <div class="controls">
                                                            <select name="mhu" id="mhu">
															<option value="">Select </option>
																<?php $ab= mysql_query("SELECT `ID`,`UserName` FROM `tblmhuusers`");
																while($dig =mysql_fetch_array($ab))
																{?>
																	<option value="<?php echo $dig['ID'];?>"><?php echo $dig['UserName'];?></option>
																<?php } ?>
															</select>
														</div>                                                         
                                                    </div>
                                                </div>
                                                </div> <br/>
											<div class="row "> 	
												<div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">	Symptoms  Diagnosis</label>
                                                        <div class="controls">
                                                            <select name="sysdig" id="sysdig">
															<option value="">Select </option>
																<?php $ab= mysql_query("SELECT `Id`,`Diagnosis` FROM `tbldiagnosis`");
																while($dig =mysql_fetch_array($ab))
																{?>
																	<option value="<?php echo $dig['Id'];?>"><?php echo $dig['Diagnosis'];?></option>
																<?php } ?>
															</select>
														</div>
                                                    </div>
                                                </div>
												<div class="span6">
                                                    <div class="control-group">
                                                         
                                                    </div>
                                                </div>
                                                </div> <br/>
											<div class="row "> 	
												 <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">	Conference</label>
                                                        <div class="controls">
                                                            <select name="consr"><option value="YES">Yes</option><option selected value="NO">No</option></select>
														</div>
                                                    </div>
                                                </div>
												<div class="span6">
                                                    <div class="control-group">
                                                         <label class="control-label" for="basicinput">Doctor</label>
                                                        <div class="controls">
                                                            <select name="sysdoc" id="sysdoc" class="select_combo" onchange="return getcontact();">
															<option value="">Select Doctor</option>
																<?php $ab= mysql_query("SELECT `DRID`,`DName`,`MobileNo`,`Specialization` FROM `tbldoctormaster` where is_active = 1;");
																while($dig =mysql_fetch_array($ab))
																{?>
																<!--<option value="<?php echo $dig['DRID'];?>"><?php echo $dig['DName'].'-'.$dig['MobileNo'].'-'.$dig['Specialization'];?></option>-->
																<option value="<?php echo $dig['DRID'];?>"><?php echo $dig['DName'];?></option>
																
																<?php } ?>
															</select>
															<div><input type = "text" id="txtcontact" name="txtcontact"  /></div>
															<input type="button" id="btncall" class="btn btn-success" name="abds" value="Call" onclick="return  conCall();" />
														</div>
                                                    </div>
                                                </div>
											</div>	 <br />
											<div class="row "> 	
												<div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Advice By Doctor</label>
                                                        <div class="controls">
                                                            <input type="text" id="abdbdoctor" name="abdbdoctor" />
														</div>
                                                    </div>
                                                </div>
												<div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Advice By Specility</label>
                                                        <div class="controls">
                                                            <input type="text" id="adbsp" name="adbsp" />
														</div> 
                                                    </div>
                                                </div>                                          
											</div>

										<br />
											<div class="row "> 	
												<div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Medicine Prescribed</label>
                                                        <div class="controls">
                                                            <input type="text" id="medp" name="medp" />
														</div>
                                                    </div>
                                                </div>
												<div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Remarks</label>
                                                        <div class="controls">
                                                            <input type="text" id="medprem" name="medprem" />
														</div> 
                                                    </div>
                                                </div>                                          
											</div>
											
											<div class="row "> 	
												<div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">	Advice by Specialist </label>
                                                        <div class="controls">
                                                            <input type="radio" onclick="return drugFormUnits('YES');" id="presbr" value="YES" name="presbr" /> Yes
                                                            <input type="radio" onclick="return drugFormUnits('NO');" checked id="presbr" value="NO" name="presbr" /> No
														</div>
                                                    </div>
                                                </div>												                                       
											</div>
											
											
											<div class="row " id="drugFormUnit" style="display:none;" > 	
												<div class="span12">
                                                    <div class="control-group">
                                                        <table class="table" width="60%" style="width:60%">
															<tr>
																<td>S.no</td>
																<td>Drug FORM</td>
																<td>Medicine</td>
																<td>Description</td>
															</tr>
															
															<?php $j=1;for($i=0;$i<=4;$i++){ ?>
															<tr>
																<td><?php echo $j; $j++;?></td>
																<td>
																	<select name="sysdig1" id="sysdig1_<?php echo $i;?>" onchange='GetRegionsdrug(this.value,"<?php echo $i;?>");'>
																	<option value="">Select </option>
																		<?php $ab= mysql_query("SELECT id,DrugForm FROM `tbldrugform`");
																		while($dig =mysql_fetch_array($ab))
																		{?>
																			<option value="<?php echo $dig['id'];?>"><?php echo $dig['DrugForm'];?></option>
																		<?php } ?>
																	</select>
																</td>
																<td>
																	<select name="sysmed" id="sysmed1_<?php echo $i;?>">
																	<option value="">Select </option>
																		<?php $ab= mysql_query("SELECT `id`,`DrugFormId`,`DrugName` FROM `tbldrugdetail`");
																		while($dig =mysql_fetch_array($ab))
																		{?>
																			<option value="<?php echo $dig['id'];?>"><?php echo $dig['DrugName'];?></option>
																		<?php } ?>
																	</select>
																</td>
																<td><input type="text" name="descsysmer" id="descsysmer_<?php echo $i;?>"></td>
															</tr>
															<?php }?>
															
														</table>
                                                    </div>
                                                </div>												                                           
											</div>
											
											<div class="row "> 	
												<div class="span6">
                                                    <div class="control-group">
                                                         
                                                    </div>
                                                </div>
												<div class="span6">
                                                    <div class="control-group">
                                                         
                                                        <div class="controls">
                                                            <input type="button" id="save_Details" class="btn btn-success" name="abds" value="Save Details" onclick="return  save_details1();" />
														</div> 
                                                    </div>
                                                </div>   
												<div class="span6" >
                                                    <div class="control-group">
                                                         
                                                        <div class="controls">
                                                            <input style=display:none; type="button" id="drug_Save" class="btn btn-success" name="abds" value="Submit" onclick="return  drug_save();" />
														</div> 
                                                    </div>
                                                </div>                                          
											</div>
											
											
										</div>
									</form>
                                </div>
                            </div>
                        </section>
                        
						 
						 
						 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.wrapper-->
     
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
     

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


function getcontact()
	 {
		var xmlHttp=newHttpObject(); 
		
		if(xmlHttp)
		 {
			var sysdocID = document.getElementById('sysdoc').value;
			
			var callQuery = "type=getcontact&sysdocID1="+sysdocID;
			xmlHttp.open("POST","save_tel.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText;
					//alert(Response);
                    document.getElementById("txtcontact").value=Response;  
	
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
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
	
	
	<link href="css/select2.min.css" rel="stylesheet" />
<script src="js/select2.min.js"></script>
<script type="text/javascript">
  $('.select_combo').select2({allowClear: true, theme: "classic",templateResult: function (data, container) {
    if (data.element) {
      $(container).addClass($(data.element).attr("class"));
    }
    return data.text;
  }});
 
</script>	
	