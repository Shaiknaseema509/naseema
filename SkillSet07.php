<?php 
require_once("dbconnect_emri.php"); 

$phone_number         = $_REQUEST["callernumber"];
$agent_id 	      = $_REQUEST["agentid"];
$call_hit_referenceno = $_REQUEST["CallReferenceID"];
$service_id           = $_REQUEST["DID"];
$call_date            = $_REQUEST["CallDate"];
$call_time            = $_REQUEST["CallTime"];

//echo "<pre>".print_r($_REQUEST,1)."</pre>";
//$Beneficiary_details_query= mysql_query("select * from mcth_mother where ID_No=''");
$Beneficiary_details_query= mysql_query("select * from mcth_mother where Whom_PhoneNo='$phone_number'");
$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);
?>

<html>
<head>
<script src="scripts/main_validation.js"></script>
<script>

	function GetCallID()
         {
                var xmlHttp=newHttpObject();
        
                if(xmlHttp)
                 {
			var callQuery="agent_id=<?=$agent_id;?>&phone_number=<?=$phone_number;?>&service_id=<?=$service_id;?>&call_hit_referenceno=<?=$call_hit_referenceno;?>&call_date=<?=$call_date;?>&call_time=<?=$call_time;?>";
                        xmlHttp.open("POST","getOutCallid.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                var Response = null;
                                Response = xmlHttp.responseText;
                                document.getElementById('callid').innerHTML=Response;
                                document.getElementById('hidden_callid').value=Response;
                                window.CallID = Response;                 
                         }
                 }
         }
	function EndCall()
	 {
                var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var callQuery="type=CLOSE&agent_id=<?=$agent_id;?>&call_hit_referenceno=<?=$call_hit_referenceno;?>&beneficiary_id=<?=$Beneficiary_Details['ID_No'];?>";
                        xmlHttp.open("POST","save_calltype_questions.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                var Response = null;
                                Response = xmlHttp.responseText;
				var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE7";
                		//alert(end_call_url);
				postURL(end_call_url,"false");	
			 }
		 }
	 }

        function grievance_details()
         {
                var phone_number= "<?=$phone_number;?>";
                var beneficiary_id = "<?=$Beneficiary_Details['ID_No'];?>";
                var aadhar_no = "<?=$Beneficiary_Details['Aadhar_No'];?>";
                var call_id = document.getElementById("hidden_callid").value; 
                var agentid = "<?=$agent_id;?>";
                URL = "http://jansunwai.up.nic.in/IGRSAPP/INIT/login.aspx?agentid="+agentid+"&phone_number="+phone_number+"&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&uid="+aadhar_no+"&call_type=outbound";
                my_window = window.open(URL, "Complaint_Details", "width=900px,height=400px,top=300px,left=200px,scrollbars=yes");
                
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
	 <!-- <div class="row" style=" background-color: #58fcea ">
		 <div class="col-md-3"> UP  HEALTH  HELP LINE  </div>
		 <div class="col-md-3"><span> LOG IN ID :</span> xxxxxx </div>
		 <div class="col-md-3">  NAME : M.S Reddy</div> 
		 <div class="col-md-3"> CALL FLOW : Outbound - Beneficiary </div>
	 </div>   -->
	 <div class="row" style="background-color: #000080 ">
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"> फ़ोन नंबर : <?=$_REQUEST["callernumber"];?> </div>
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"><span> कॉल आईडी :</span> <span id="callid"></span> </div>
		 <input type="hidden" id="hidden_callid" />
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"> तारीख : <?=$_REQUEST["CallDate"];?> </div> 
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"> पहर : <?=$_REQUEST["CallTime"];?> </div>
	 </div>  
	  	 
	 </div>	
	 <div class="col-md-3"  style="background-color: #9cbdff ">
		
		<div class="form-group" > 
			<table cellpadding="5" cellspacing="5" width="100%"  style="border: 1px solid #fff">
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;">लाभार्थी आईडी :</td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['ID_No'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >नाम :</td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Name'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >पति का नाम :</td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Husband_Name'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >जन्म की तारीख : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Birthdate'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >आयु : </td>
					<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Age'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >जिला : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['District_Name'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >ब्लॉक : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Taluka_Name'];?></td>
				</tr>	
				<tr><tr><td></td></tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >पंचायत : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Village_Name'];?></td>
				</tr>	
				<tr><tr><td></td></tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >पता : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Address'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >जेएसआई लाभार्थी : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['JSY_Beneficiary'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >जाति : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Caste'];?></td>
				</tr><tr><td></td></tr>	
			</table>
			
			<table cellpadding="5" cellspacing="5" width="100%"  style="border: 1px solid #fff">
				<tr>
					<td>कॉल प्रकार :</td>
					<td>
						<select name="Call Type" class="col-md-12">
							<option value="">Call type</option>
							<option value="/">Valid call</option>
							<option value="/">Missed call</option>
							<option value="/">Noise disturbance</option>
							<option value="/">Disconnected call</option>
							<option value="/">Wrong call</option>
							<option value="/">Follow-up call</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>कॉल सूचना :</td>
					<td>
						<select name="Close Type"  class="col-md-12">
							<option value="">Close Type</option>
							<option value="/">Antenatal Advice</option>
							<option value="/">Counselling for ANC visits</option>
							<option value="/">Counselling Institutional delivery</option>
							<option value="/">Child vaccination Advice</option>
							<option value="/">Verification of beneficiary services</option>
							<option value="/">Verification of ASHA</option>
							<option value="/">Verification of ANM</option>							
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input value="Terminate" style="color: #ff0000; font-weight: bold; font-size: 10pt;" type="button" onclick='EndCall();'></td>
				</tr>
			</table>	
		</div>
	 </div>
        <div class="col-md-9" >	  
          <div class="row" >			 
				 <div class="col-md-3" style="background-color: #9cbdff;font-family:arial;font-size:16px;color:black;"> यू आईडी : <?php echo $Beneficiary_Details['PhoneNo_Of_Whom'];?> </div> 
				<div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff"> उप केंद्र का नाम : <?php echo $Beneficiary_Details['SubCentre_Name'];?>  </div>
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff"><span> ANM का नाम : <?php echo $Beneficiary_Details['ANM_Name'];?>  </div>
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff"> ANM का फ़ोन नंबर : <?php echo $Beneficiary_Details['ANM_Phone'];?></div> 
				
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff"> Associated ASHA का नाम : <?php echo $Beneficiary_Details['ASHA_Name'];?></div> 
				<div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff">ASHA की आईडी : <?php echo $Beneficiary_Details['ASHA_Name'];?> </div>
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff">ASHA का फ़ोन नंबर : <?php echo $Beneficiary_Details['ASHA_Phone'];?></div>
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff"> <button type="button" name='Complaint' id='Complaint' class="btn-success"  style=""  onclick="return grievance_details();"> शिकायत करें </button> </div> 	
			   
			 
			 <div class="col-md-12" style="background-color: #000080 ">
				<ul>
					<li class="li_active get_questions" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">लाभार्थी सत्यापन</li>
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
						<a href="pages/outbound/beneficiary/pregdetails.html" target="navcontent" >गर्भावस्था कैलक्यूलेटर</a></li>
					<!--<li class="get_static"  style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
						<a href="pages/outbound/antenatalcare/antenatalcare.html" target="navcontent" >प्रसवपूर्व देखभाल</a></li>
					<li id="chc" href="antenatalcare/antenatalcare.html" target="navcontent" class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">Antenatal Care</li> 
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
						<a href="pages/outbound/pnc/puerperium.html" target="navcontent" >प्रसवकालीन देखभाल</a></li>
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
						<a href="pages/outbound/medicaldisorders/anemia.html" target="navcontent" >गर्भावस्था के दौरान एनीमिया</a></li>
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
					<a href="pages/outbound/immunization/nis.html" target="navcontent" >बाल टीकाकरण</a></li>
-->
				</ul>
			 </div>
            <div class="col-md-12" >
				<div id="questions_html">
					<?php
					  include("type_seven.php");
			  		?>					
				</div>	
				<div id="content_html" style="display:none">
					<iframe id="navcontent" name="navcontent" src="blank.html" border='0' width="100%" height="600px"> </iframe>
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
//setTimeout(function(){$('#content_html').hide();},1000);
</script>

<style>
	 .form-control {height:25px !important; }
	 ul li { border-right: 2px solid white; cursor:pointer;float: left; font-size:15px;   list-style: outside none none;    margin: 3px;    padding: 3px;}
	 .li_active {  background-color: blue ;}
	 .fontsytle { font-size:12px}
	 ul li a{ color:#fff;}
	  /* The alert message box */
.alert { top:0px;
                padding: 10px;
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
