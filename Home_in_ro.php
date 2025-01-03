<?php  error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$phone_number         = $_REQUEST["callernumber"];
$CALL_TYPE         = $_REQUEST["CALL_TYPE"];
$Queue 	              = strtoupper($_REQUEST["queue_name"]);
$Queue                = ($Queue)?$Queue:"MEDADV_MQ";
$agentID 	      = $_REQUEST["agentid"];
$call_hit_referenceno = $_REQUEST["call_hit_referenceno"];
$convoxID = $_REQUEST["convoxID"];

//echo "<pre>".print_r($_REQUEST,1)."</pre>";

$Beneficiary_details_query= mysql_query("select * from mcth_mother where ID_No=''");
$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);


if($phone_number == '')
 {
	// die;	//echo '<script>location.replace("login.php");</script>';
 }


if($agent_id =='') $agent_id='test';
if($phone_number == '') $phone_number='99999999999'; //738640013251
//if($convoxID == '') $convoxID=rand(1233333333,99999999999);

$current_date = date("Y-m-d");

$Query1 = "SELECT COUNT(*) AS TODAY_COUNT FROM call_incident_info WHERE call_time >= '$current_date 00:00:00' AND call_time <= '$current_date 23:59:59' 
AND phone_number='".$phone_number."'" ; // AND status!='ABANDONED';";
//$Result1     = mysql_query($Query1);
//$Details1    = mysql_fetch_array($Result1);
$Today_Count = 0; //$Details1["TODAY_COUNT"];


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
	
<?php if($CALL_TYPE =='INCOMING')	{?>
	  <script type="text/javascript">
 	$(function () {
                //$('.followup_time_picker').datetimepicker({format: 'YYYY/MM/DD'});
			//	$('.followup_time_picker').datetimepicker({format: 'DD-MM-YYYY'});
				//$('.followup_time_picker').datetimepicker({format: 'DD-MM-YYYY'});
       
		//var xml = "7386400132";
		
		
		setTimeout(function(){ $('#address1').val('Loading...');
		var callid = document.getElementById('callidValue').value;
$.post("abc.php",{phone:'<?=$phone_number;?>',callid:callid},function(data){ var res = data.split("@@#P@I@G@@"); $('#names').val(res[3]);$('#lat').val(res[0]);$('#long').val(res[1]); if(res[2] =='') $('#address1').val('NA'); else $('#address1').val(res[2]); }); }, 2000);
		});
		
		
    </script>
<?php }?>
	
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
		var call_transfer  = document.getElementById('call_transfer').value.split('~');
		var call_transfer1 = call_transfer[2]; 
		//alert(callType);
		$('.control-group-ggh').hide();
		if(callType ==9999 || callType == 35 || callType == 36 || callType == 39)
		{
			if(callType == 36)
			{
				 $('.subCatSuspect').show();
				 $('.divconf').show();
				 $('#TransferP').show();
			}
			else if(callType == 39)
			{
				 $('.subCatSuspect').hide();
				 $('.divconf').show();
				 $('.control-group-ggh').show();
				 $('#TransferP').show();
			}
			else if(call_transfer1 == 124)
			{
				 $('.subCatSuspect').hide();
				 $('.divconf').show();
				 $('.control-group-ggh').show();
				 $('#TransferP').show();
			}
			else
			{
				 $('.subCatSuspect').hide();
				 $('.divconf').show();	
				$('#TransferP').show();
				 
			}
			
		}
		else 
		{
			$('.subCatSuspect').hide();
			$('.divconf').hide();
			$('#TransferP').hide();

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
		var CallTypeSSub1 =document.getElementById('CallTypeSSub').value; 
		if(callType ==39)
		{ 
			// var CallTypeSSub=document.getElementById('CallTypeSSub').value; 
				 if(CallTypeSSub1 ==0)
				 {
					 // $('.alert').show();
					//$('.alert_content').html('please Add Beneficiary ..!'); 
					//setTimeout(function(){$('.alert').hide();},10000); 
					alert('please Select Sub call type ..!');
					return false; 
					
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
                        var callQuery = "action=CLOSESCHEME&agent_id=<?=$agentID;?>&cat_sub_directory="+cat_sub_directory+"&remarks="+remarks+"&call_id="+call_id+"&call_type_id="+callType+"&CallTypeSSub="+CallTypeSSub1+"&callTypedup="+callTypedup+"&cou="+ij+ccd;
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
	
	alert("AGE");
	
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
				//xmlHttp.open("POST","getCCallid.php",true);
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
				 		var callTypes  = document.getElementById('CallTypeSS').value.split('~');
		var callType = callTypes[0]; 
		var callTypedup = callTypes[0]; 
			
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
						 var CallTypeSSub1 =document.getElementById('CallTypeSSub').value; 
						
						
						if(queue_id ==120)
							var transfer_tos = "MO_104";
						else if(queue_id ==124)
							var transfer_tos = "TeleMedicineHO";
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
                                
							callQuery+="&ACTION=TRANSFER&agent_id="+agentID+"&CallTypeSSub="+CallTypeSSub1+"&phone_number="+phoneNumber+"&process="+process+"&call_id="+call_id+"&call_type_id="+callType+"&leadID="+leadID+"&call_hit_referenceno="+call_hit_referenceno+"&tType="+transfer_tos;
						
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
			var ismhuEle = document.getElementById('ismhu');
			var  ismhuEleVal;			
			if(ismhuEle.checked == true){
				ismhuEleVal = 1;
			}else{
				ismhuEleVal = 0;
			}
			var beneficiary_id	= document.getElementById('beneficiary_ids').value;
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
			 var remarks_1	= document.getElementById('remarks_1').value;
 		
			
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
		
		$('#btnRegister').hide();

			var callQuery="type=SaveBeneficiary&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&ano="+ano+"&dob="+dob+"&aadhar_uid_no="+aadhar_uid_no+"&age_type="+monthyear+"&beneficiary_lname="+beneficiary_lname+"&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&beneficiary_name="+beneficiary_name+"&benificiery_surname="+beneficiary_surname+"&age="+age+"&Gender="+gender+"&mother="+mother+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&email="+email+"&language_id="+language_id+"&education_id="+education_id+"&occupation_id="+occupation_id+"&marital_status_id="+marital_status_id+"&address="+address+"&relationship_id="+relationship_id+"&present_compalint="+present_compalint+"&advice_given="+advice_given+"&remarks_1="+remarks_1+"&status="+ismhuEleVal;
			
			console.log(callQuery);

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
									$('#btnRegister').show();
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
		if(callType ==1  || callType ==2  || callType ==3 || callType ==4 || callType ==6 || callType ==5 || callType ==9 || callType ==13 || callType ==19 || callType ==20 || callType ==22 || callType ==24 || callType ==25 || callType ==26 || callType ==28 || callType ==29 || callType ==30 || callType ==31 || callType ==32 || callType ==33  || callType ==34  || callType ==35 || callType ==36 || callType ==37 || callType == 39)
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
				 var CallTypeSSub1 =document.getElementById('CallTypeSSub').value; 
				if(callType ==39)
				{  
					 if(CallTypeSSub1 ==0)
					 { 
						alert('please Select Sub call type ..!');
						return false; 						
					 }
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
                        var callQuery = "action=CLOSE&agent_id=<?=$agentID;?>&call_id="+call_id+"&call_type_id="+callType+"&CallTypeSSub="+CallTypeSSub1+"&callTypedup="+callTypedup+"&subCatMul="+subCatMuls;
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
	//alert(1); return false;
 
	var vehicle_phone_number='';
	var vehicle_phone_number=document.getElementById("phone_number_val").value;
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
#$benquery = "SELECT * FROM registration WHERE contact_no = '".$phone_number."' order by call_id desc limit 1 ;";
$benquery = "SELECT * FROM registration WHERE contact_no = '".$phone_number."' ;";
$benquery1     = mysql_query($benquery);
$Beneficiary_Details    = mysql_fetch_array($benquery1);	


if($Beneficiary_Details['registration_id'] == '') $bids='';
	else $bids=11;
?>	
	
	
	 <input type="hidden" id="bids" value='<?php echo $bids;?>' />


<body onload='GetCallID();'>
	<input type="hidden" value="" id="callidValue"  />
<div class="alert custm_alrt_color" style="margin:0px 25px;padding: 15px;">
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
    <div class="wrapper custm_wrapper" style="min-height:600px;padding-top:0px!important">
        <div class="container" style="width:100% !important">
            <div class="row" style="width:100% !important"><input type="hidden" value="<?=$phone_number;?>" id="phone_number_val" />
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu custm_widget-menu unstyled">
						    <input type="hidden" value=""  id="CallTypeS" />
						
							<?php
						$calltype_query = "SELECT call_type_id,call_type_name FROM m_call_type  WHERE is_active=1 and is_valid=1 order by order_by asc;";
						$calltype_result= mysql_query($calltype_query);
						while($calltype_details = mysql_fetch_array($calltype_result))
						 {
							//echo "<option value='".$calltype_details["call_type_id"]."~".$calltype_details["call_type_name"]."' >".$calltype_details["call_type_name"]."</option>";
						 ?>
						  <li>
                                <a style="color:white" href="javascript:void(0);"  name="CallType"  onclick="return callType(<?php echo $calltype_details["call_type_id"];?>);" >
                                    <i class="menu-icon icon-dashboard"></i><?php echo $calltype_details["call_type_name"];?>
                                </a>
                            </li>
							
						 <?php }?>
						 
						 <!--  
						  <li>
                                <a href="javascript:void(0);" name="CallType"   onclick="return callType(13);" >
                                    <i class="menu-icon icon-bullhorn"></i>104 Fever	
                                </a>
                            </li>
							
							 <li>
                                <a href="javascript:void(0);" name="CallType" onclick="return callType(26);" >
                                    <i class="menu-icon icon-bullhorn"></i>104 Fever Case closing
                                </a>
                            </li>
						
						
						
                           <li class="active">
                                <a href="javascript:void(0);"  name="CallType" id="CallTypeS" onclick="return callType(4);" >
                                    <i class="menu-icon icon-dashboard"></i>Grievance
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" name="CallType" id="CallTypeS" onclick="return callType(5);" >
                                    <i class="menu-icon icon-bullhorn"></i>Health Information
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" name="CallType" id="CallTypeS" onclick="return callType(1);"  >
                                    <i class="menu-icon icon-bullhorn"></i>Medical Advice
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" name="CallType" id="CallTypeS" onclick="return callType(55);"  >
                                    <i class="menu-icon icon-bullhorn"></i>Counselling Advice
                                </a>
                            </li>  -->
                        </ul>
						
                            
							
                        <ul class="widget widget-menu custm_widget-menu unstyled custm_ul" >
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Incident Id : <span id="callid"></span>
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Caller Name : <span id="cName">  </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Caller PhoneNo : <?=$phone_number;?>
									<input type="hidden" id="beneficiary_ids"  name='beneficiary_ids' value="<?php echo $Beneficiary_Details['registration_id'];?>" />  
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Age : <span id="cAge">  </span> 
                                </span>
                            </li>
                             
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    District: <span id="cDistrict">  </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Taluka: <span id="cTaluka">   </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Village: <span id="cVillage">   </span> 
                                </span>
                            </li>
							 <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Pregency : <span id="cPregency"> No </span> 
                                </span>
                            </li>
                        </ul>
						
                    </div>
                </div>
             

			 <div class="span9">
                    <div class="content">
                        <section id="section_one" style="min-height: 354px;">
                            <div class="btn-controls" style="color:#000;background-color: #e1dfdf;border: 1px solid #eedcdc; min-height:423px;max-height:423px;overflow-x: hidden;overflow-y:scroll">
                                 
                                <div class="modue">
                                    <div class="module-boy">
									<legend class="custm_legend">
                        <!--<button type="button" class="btn caller_info_btn ribbon">Caller Information</button>-->
						<div class="module-head custm_call_closer">
                                <h3>Caller Information</h3>
                            </div>
                    </legend>
                                        <form class="form-horizontal row-fluid">
                                            <div class="row custm_row">
                                                <div class="custm_col_4">
                                                    <div class="custm_width">
													    <div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Phone Number</label>
														</div>
                                                        <div class="custm_input">
                                                           <input class="form-control custm_form_input" type="text" id="phone_number_val" readonly value="<?=$phone_number;?>" placeholder="Type Phone Number..." class="span12">                                    
													    </div>
                                                    </div>
                                                </div>
                                                <div class="custm_col_4" style="display:none">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Transfer Group</label>
													</div>
                                                        <div class="custm_input">
                                                            <input class="form-control custm_form_input" type="text" id="basicinput" placeholder="Type Phone Number...">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">First Name</label>
													</div>
                                                        <div class="custm_input">
                                                            <input type="text" id="beneficiary_name" 
															value="<?php echo $Beneficiary_Details['beneficiary_name'];?>" 
															class="form-control custm_form_input" onkeypress="return allowValidKey(event,'callername');" onkeyup="return removeSP('beneficiary_name');"  placeholder="Type First Name..."class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Middle Name</label>
													</div>
                                                        <div class="custm_input">
                                                            <input type="text" id="beneficiary_surname" onkeypress="return allowValidKey(event,'callername');" onkeyup="return removeSP('beneficiary_surname');"  value="<?php echo $Beneficiary_Details['benificiery_surname'];?>" placeholder="Type Middile Name..." class="form-control custm_form_input">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row custm_row">
                                                <div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Last Name</label>
													</div>
                                                        <div class="custm_input">
                                                            <input type="text" id="beneficiary_lname" onkeypress="return allowValidKey(event,'callername');" onkeyup="return removeSP('beneficiary_lname');"  value="<?php echo $Beneficiary_Details['beneficiary_last'];?>" placeholder="Type Last Name..." class="form-control custm_form_input">
                                                        </div>
                                                    </div>
                                                </div>
												
												 <div class="custm_col_4"  >
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Landline No</label>
													</div>
                                                        <div class="custm_input">
                                                            <input type="text" maxlength='12' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  onkeypress="return allowValidKey(event,'number');"
															placeholder="Type Number..." class="form-control custm_form_input">
                                                        </div>
                                                    </div>
                                                </div>
												
												<div class="custm_col_4">
                                                    <div class="custm_width">
													
													<input type="hidden" id='dob' name='dob' class="followup_time_picker" onblur="return getAge();" 
				onkeypress="return allowValidKey(event,'number');"   />
				                                    <div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Age</label>
													</div>
                                                        <div class="custm_input">
														<div class="custm_age_width">
                                                           <select name="monthyear" id="monthyear" onchange="return checkPrgenet()" class="form-control custm_form_input custm_form_select" style="width:90px" >
													<option <?=($Beneficiary_Details["age_type"]=='YEAR')?"checked":"";?> value="YEAR">Year</option>
													<option <?=($Beneficiary_Details["age_type"]=='MONTH')?"checked":"";?> value="MONTH">Month</option>
												</select>
												<input type="text" id='age' class="form-control custm_form_input" name='age' style="width:110px" maxlength=3
												onkeyup="AgeLimit(this.value,this.id,monthyear.value);" onblur="return checkPrgenet();"  onkeypress="return allowValidKey(event,'number');" value="<?php echo $Beneficiary_Details['age'];?>" 
												/><span id="age_span" style='color:red;font-size:10px'></span>
                                                        </div>
														</div>
                                                    </div>
                                                </div>
                                                 
                                            </div>
                                            <div class="row custm_row">
                                                
                                                <div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Gender </label>
													</div>
                                                        <div class="custm_input d-f">
                                                           <input type="radio" id="male" onclick="return checkPrgenet();" checked  name="Gender" value="M" <?=($Beneficiary_Details["gender"]=='M')?"checked":"";?>>Male       
														   <input type="radio" id="female" onclick="return checkPrgenet();" name="Gender" value="F" <?=($Beneficiary_Details["gender"]=='F')?"checked":"";?> > Female
														   <input type="radio" id="transgender" onclick="return checkPrgenet();" name="Gender" value="T" <?=($Beneficiary_Details["gender"]=='T')?"checked":"";?> > Transgender
                                                        </div>
                                                    </div>
                                                </div>
												
												<div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Alternative Number</label>
                                                    </div>
														<div class="custm_input">
                                                            <input type="text" id="ano" maxlength='10' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															onblur="return validcheckaadhar123();" onkeypress="return allowValidKey(event,'number');" placeholder="Enter Alternative Number..." class="form-control custm_form_input">
                                                        </div>
                                                    </div>
                                                </div>
												
												<div class="custm_col_4"  >
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Aadhar No</label>
                                                    </div>
														<div class="custm_input">
                                                            <input type="text" onkeypress="return allowValidKey(event,'number');"   maxlength='12' 
															id="aadhar_uid_no" placeholder="Enter No..." onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" onblur="validcheckaadhar12();" class="form-control custm_form_input">
                                                        </div>
                                                    </div>
                                                </div>	
                                            </div>
											
                                            <div class="row custm_row"> 
                                                <div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">District</label>
													</div>
                                                        <div class="custm_input">
                                                            <select class="form-control custm_form_input custm_form_select" style="font-family:arial;"  id='district' name='district' onchange='GetRegions(this.value,"1");' class="form-control" >
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
												
												<div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Taluka/Block</label>
													</div>
                                                        <div class="custm_input">
                                                           <select class="form-control custm_form_input custm_form_select" style="font-family:arial;" id='tehsil' name='tehsil' onchange='GetRegions(this.value,"2");' class="form-control">
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
												
												<div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Village/City</label>
													</div>
                                                        <div class="custm_input">
                                                            <select class="form-control custm_form_input custm_form_select" style="font-family:arial;" id='city_name' name='city_name' class="form-control">
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
                                            </div>
                                            
                                            <div class="row custm_row">
                                                <div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Landmark </label>
													</div>
                                                        <div class="custm_input">
<textarea id='address' class="form-control custm_form_input" name='address'  placeholder="Enter Landmark..." class="span12"><?php echo $Beneficiary_Details['address'];?></textarea>
													<?php /*	<input type="text" id='address' class="form-control" name='address' value="<?php echo $Beneficiary_Details['address'];?>"  placeholder="Enter Landmark..." class="span12"> */ ?>
                                                        
														</div>
                                                    </div>
                                                </div>
												
												<div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput"> LBS Address  </label>
													</div>
                                                        <div class="custm_input">
<textarea id='address1' class="form-control custm_form_input" name='address1' readonly  placeholder="" class="span12"><?php //echo $Beneficiary_Details['address'];?></textarea>
													<?php /*	<input type="text" id='address' class="form-control" name='address' value="<?php echo $Beneficiary_Details['address'];?>"  placeholder="Enter Landmark..." class="span12"> */ ?>
                                                        
														</div>
                                                    </div>
                                                </div>
												
												<div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Remarks  </label>
													</div>
                                                        <div class="custm_input">
											<textarea id='remarks_1' class="form-control custm_form_input" name='remarks_1'  placeholder="" class="span12"><?php echo $Beneficiary_Details['remarks_1'];?></textarea>
													<?php /*	<input type="text" id='address' class="form-control" name='address' value="<?php echo $Beneficiary_Details['address'];?>"  placeholder="Enter Landmark..." class="span12"> */ ?>
                                                        
														</div>
                                                    </div>
                                                </div>
                                            </div>
																																	
											<div class="row custm_row">
                                                <div class="custm_col_4">
                                                    <div class="custm_width custm_longitude">
													    <div class="custm_label">
													        <label class="custm_label_text"> Latitude  </label>
												        </div>
                                                        <div class="custm_input">
														    <input id="lat" class="form-control custm_form_input" readonly>
														</div>
													</div>
												</div>
														
												<div class="custm_col_4">
													<div class="custm_width custm_longitude">
														<div class="custm_label">
														    <label class="custm_label_text"> Longitude  </label>
														</div>
														<div class="custm_input">
														 <input id="long" class="form-control custm_form_input" readonly> 
														</div>
													</div>
												</div>
												
												<div class="custm_col_4">	
													<div class="custm_width custm_longitude">
													    <div class="custm_label">
														    <label class="custm_label_text"> Name  </label>
														</div>
														<div class="custm_input">
														    <input id="names" class="form-control custm_form_input" readonly>
														</div>
                                                    </div>
                                                </div>
                                            </div>
										                                           																		
                                           <div class="row custm_row">
                                                <div class="custm_col_4">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput">Beneficiary ID :</label>
                                                    </div>
														<div class="custm_input">
                                                            <input type="hidden" id="basicinputNumberbeneficiary_ids" value="<?php echo $bids;?>" disabled class="form-control custm_form_input">
														<p id="basicinputNumberbeneficiary_ids_label" style="padding-top:7px"> <?php echo $Beneficiary_Details['registration_id'];?></p>
													   </div>
                                                    </div>
                                                </div>
											
                                                <div class="custm_col_4" style="display: flex;">
												
												<label class="custm_label_text" for="ismhu">Is MHU<b aria-required="true">*</b></label>
                                                <input type="checkbox" name="ismhu" id="ismhu" value="Yes" />
                                              </div>
												
												
                                                <div class="custm_col_4 prgnt" style="display:none;">
                                                    <div class="custm_width">
													<div class="custm_label">
                                                        <label class="custm_label_text" for="basicinput"> Pregent </label>
													</div>
                                                        <div class="custm_input">
                                                          <select id="prgnts" class="form-control custm_form_input custm_form_select">
														  <option value="No">No</option>
															<option value="Yes">Yes</option>													
															 														
														  </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="control-group" style="float:right;margin-right:16px">
                                                <div class="controls">
                                                    <input type="button" onclick="return saveBeneficiaryDetails();" id="btnRegister" class="btn btn-large btn-primary" value="Registration" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                         <div class="module custm_module">
                            <div class="module-head custm_call_closer">
                                <h3>Call Closer</h3>
                            </div>
                            <div class="module-body">
                                <form class="form-horizontal row-fluid">
                                    <div class="row custm_row">
                                        <div class="custm_col_6">
                                            <div class="custm_width">
											<div class="custm_label">
                                                <label class="custm_label_text" for="basicinput" style="color: #0d0d0d;">Call Type</label>
											</div>
                                                <div class="custm_input">
                                                    <select id="CallTypeSS" onchange="return callTypeChange();"   data-placeholder="Select here.." class="span12 custm_form_input">
                                                        <option value="">Select here..</option> 
														<option value="9999~valid"> Effective Call </option>
						<?php
					 
						 
						$calltype_query = "SELECT call_type_id,call_type_name FROM m_call_type  WHERE is_active=1 and is_valid=0 order by order_by asc;";
						$calltype_result= mysql_query($calltype_query);
						while($calltype_details = mysql_fetch_array($calltype_result))
						 {
							echo "<option value='".$calltype_details["call_type_id"]."~".$calltype_details["call_type_name"]."' >".$calltype_details["call_type_name"]."</option>";
						 }
						?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                       <!-- <div class="custm_col_6 abcdtransergroup">
                                            <div class="custm_width">
											<div class="custm_label">
                                                <label class="custm_label_text" for="basicinput" style="color: #0d0d0d;">Transfer Group</label>
											</div>
                                                <div class="custm_input">
                                                    <select name="call_transfer" id="call_transfer"  data-placeholder="Select here.." class="span12 custm_form_input" style="width:100% !important">
                                                      <option value="">Select here..</option>  
													  //<?php
						//$call_transfer_Q = "SELECT transfer_to,transfer_value,transfer_queue_name,transfer_queue_id FROM m_call_transfer WHERE transfer_queue_name NOT IN ('$_POST[queue_name]') AND active='Y';";
						//$call_transfer_rslt = mysql_query($call_transfer_Q);
						//while($call_transfer_details = mysql_fetch_array($call_transfer_rslt))
						//{
						//	echo "<option value='".$call_transfer_details["transfer_value"]."~".$call_transfer_details["transfer_queue_name"]."~".$call_transfer_details["transfer_queue_id"]."'>".$call_transfer_details["transfer_to"]."</option>";
                          //}
                       ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div> 

                                            <!--<div class="row custm_row">
                                                <div class="custm_col_6 divconf">
                                                <div class="custm_width">
												<div class="custm_label">
                                                    <label class="custm_label_text" for="basicinput" style="color: #0d0d0d;">Conference Type</label>
											    </div>
                                                <div class="custm_input">
                                                    <select id="CallTypeSS" onchange="return callTypeChange();"   data-placeholder="Select here.." class="span12 custm_form_input">
                                                        <option value="">Select here..</option> 
														<option value="1"> 1100 </option>
                                                     </select>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="custm_col_6">
                                                <div class="control-group">
                                            <div style="float:left">
                                                <button type="button" class="btn btn-large btn-info" onclick="conCall();">	Conference</button>

                                            </div>
                                                </div>
                                                </div>
                                                </div> -->
                                     <div id="hidediv" class="control-group" style="float:right">
                                        <div class="controls">
                                            <div style="float:left" class="abcdtransergroup divconf">
                                                <button type="button" style="display:none;" onclick="transfer_to_queue('TRANSFER');" id="TransferP" class="btn btn-large btn-primary">Transfer</button>
                                            </div>
                                            <div style="float:left;margin-right: 10px;margin-left:10px">
                                                <button type="button" class="btn btn-large btn-success" id="endcall"  onclick="endCall();">
                                                    Terminate
                                                </button>
                                            </div> 
                                            <div style="float:left;margin-right: 15px;">
                                                <button type="button" class="btn btn-large btn-danger" onclick="endCall();" >Close</button>

                                            </div>
                                        </div>
                                    </div> 
									
									
									<div class="custm_row">
									<div class="custm_col_6">
									<div class="custm_width control-group-ggh" style="display:none">
									        <div class="custm_label">
                                                <label class="custm_label_text" for="basicinput" style="color: #0d0d0d;">Sub Call Type</label> 
											</div>
                                                <div class="custm_input">
                                                    <select id="CallTypeSSub"    data-placeholder="Select here.." class="custm_form_select custm_form_input">
                                                        <option value="0">Select here..</option> 
														 
						<?php 
						$calltype_query = "SELECT call_type_id,call_type_name FROM m_sub_call_type  WHERE is_active=1 and call_category=39 ;";
						$calltype_result= mysql_query($calltype_query);
						while($calltype_details = mysql_fetch_array($calltype_result))
						 {
							echo "<option value='".$calltype_details["call_type_id"]."' >".$calltype_details["call_type_name"]."</option>";
						 }
						?>
                                                    </select>
                                                </div>
                                            </div>   
                                           </div>
                                            
									 <div class="custm_col_6 subCatSuspect" style="display:none">
                                            <div class="custm_width">
											<div class="custm_label">
                                                <label class="custm_label_text" for="basicinput" style="color: #0d0d0d;">Sub category</label>
											</div>
											<div class="custm_input">
                                                <div class="dropdown-mul-1 custm_form_input" style="width:99%">
												<select  id="subCatMul" class="subCatMul custm_form_input " name="subCatMul[]" multiple="multiple"> 
													<option selected value='Fever'>Fever</option>
													<option value='No Symptoms'>No Symptoms</option>
													<option value='Other Symptoms'>Other Symptoms</option>
													<option value='Cough'>Cough</option>
													<option value='Sore Throat'> Sore Throat</option>
													<option value='Breathing Problem'>Breathing Problem</option>
												</select>
												<script>												
												$('.dropdown-mul-1').dropdown({
													  
													  limitCount: 40,
													  multipleMode: 'label',
													  choice: function () {
														// console.log(arguments,this);
													  }
													}); 
												</script>
												</div>
												</div>
											</div>
									</div>
									</div>
                                </form>
                            </div>
                        </div>
                        <div class="module hide custm_module">
                            <div class="module-head">
                                <h3>
                                    Adjust Budget Range
                                </h3>
                            </div>
                            <div class="module-body">
                                <div class="form-inline clearfix">
                                    <a href="#" class="btn pull-right">Update</a>
                                    <label for="amount">
                                        Price range:
                                    </label>
                                    &nbsp;
                                    <input type="text" id="amount" class="input-" />
                                </div>
                                <hr />
                                <div class="slider-range">
                                </div>
                            </div>
                        </div>
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

				.span3{
					width:20% !important;
				}
				.span9{
					width:75% !important;
				}
				.caller_info_btn{
					width:100%;
					padding:12px 0px;
					border-radius:0px !important;
					background-color:#248aaf;
					border:1px solid #248aaf;
					font-size: 15px;
                    font-weight: 500;
                    color: #fff;
					text-align:left;
					padding-left:20px;
				}
				.caller_info_btn:hover{
					background-color:#248aaf;
					color: #fff;
				}
				.caller_info_btn:focus{
					background-color:#248aaf;
					color: #fff;
				}
				.custm_call_closer{
					background-color:#248aaf;
					border:1px solid #248aaf;
				}
				.custm_call_closer h3{
					font-size: 16px;
                    font-weight: 500;
                    color: #fff;
				}
				.span3 .sidebar ul li{
					background-color:#248aaf !important;
					color: #fff !important;
					font-weight:600 !important;
					height:44.6px;
				}
				.span3 .sidebar .widget-menu > li > a {
                    background-color: #248aaf;
                    color: #fff !important;
					font-weight:600 !important;	
					padding: 7px 7px 7px 7px !important;
                }
				
				.span3 .sidebar .widget-menu > li + li {
                    border-top: 1px solid #ddd9d9 !important;
                }
				.span3 .sidebar .widget-menu .menu-icon{
					margin-right: 0px !important;
				}
				.custm_longitude{
					margin-top: 0px !important;
                    padding-top: 9px !important;
                    border-top: 1px solid #e1dfdf !important;
				}
				.custm_longitude input{
					height: 27px; 
                    width: 97%;					
				}
				.custm_row{
					margin-left:0px;
				}
				.custm_col_4{
					width:33.333%;
					float:left;
					padding: 4px 15px;
                    box-sizing: border-box;
				}
				.custm_width{
					width:100%;
					overflow:hidden;
				}
				.custm_label{
					width:33%;
					float:left;
				}
				.custm_input{
					width:67%;
					float:left;
				}
				.custm_input p{
					margin-bottom: 0px !important;
				}
				.custm_label_text{
					padding-top: 4px;
					font-size:14px;
				}
				.custm_form_input{
					width:93%;
					border: 1px solid #9b9898 !important;
				}
				.custm_form_select{
					width:100%;
				}
				.custm_age_width{
					width:100%;
				}
				.custm_age_width .custm_form_input{
					width:46% !important;
					float:left;
				}
				.custm_col_6{
					width:50%;
					float:left;
					padding: 4px 15px;
                    box-sizing: border-box;
				}
				.d-f{
					display: flex;
					align-items: center;
					flex-direction: row;
					justify-content: space-between;
					padding-top: 8px;
				}
				.d-f input[type="radio"]{
					margin-top:0px;
				}
				.custm_alrt_color{
					background-color: #bb1892;
                    border-color: #bb1892;
				}
				.custm_module{
					margin-bottom: 0px !important;
				}
				.custm_module .module-body {
				    padding: 7px 0px 0px 0px !important;
                }
                .custm_legend{
					margin-bottom:5px !important;
				}			
                .custm_ul{
					margin-bottom:0px !important;
				}		
                .custm_wrapper{
					padding-bottom:0px !important;
				}
                .custm_widget-menu{
					border-radius: 0px 0px 0px 0px !important;
				}		

                 ul.unstyled, ol.unstyled {
                  margin-left: 0;
                  list-style: none;
                  margin-bottom: 0px;
                 }				

	</style> 