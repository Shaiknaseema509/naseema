<?php 
require_once("dbconnect_emri.php"); 
//echo "<pre>".print_r($_POST,1)."</pre>";
$Beneficiary_details_query= mysql_query("select * from mcth_mother where ID_No=''");
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
                        var callQuery='agentID=<?=$agentID;?>';
                        xmlHttp.open("POST","getCallid.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                var Response = null;
                                Response = xmlHttp.responseText;
                                document.getElementById('callid').innerHTML=Response;
                                document.getElementById('hidden_callid').value=Response;
                         }
                 }
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
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"> Phone Number : <?=$_POST["callernumber"];?> </div>
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"><span> Call ID :</span> <span id="callid"></span> 
		 <input type="hidden" id="hidden_callid" /> </div>
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"> Date : <?=$_POST["call_date"];?> </div> 
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"> Time : <?=$_POST["call_time"];?> </div>
	 </div>  
	  	 
	 </div>	
	 <div class="col-md-3"  style="background-color: #9cbdff ">
		
		<div class="form-group" > 
			<table cellpadding="5" cellspacing="5" width="100%"  style="border: 1px solid #fff">
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;">Beneficiary ID :</td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['ID_No'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >Name :</td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Name'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >Husband Name :</td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Husband_Name'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >DOB : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Birthdate'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >Age : </td>
					<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Age'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >District : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['District_Name'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >Block : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Taluka_Name'];?></td>
				</tr>	
				<tr><tr><td></td></tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >Panchayat : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?=$Beneficiary_Details['ID_No'];?></td>
				</tr>	
				<tr><tr><td></td></tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >Address : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Address'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >JSY Beneficiary : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['JSY_Beneficiary'];?></td>
				</tr><tr><td></td></tr>	
				<tr>
					<td align='right' style="font-family:arial;font-size:15px;color:black;" >Caste : </td>
					<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><?php echo $Beneficiary_Details['Caste'];?></td>
				</tr><tr><td></td></tr>	
			</table>
			
			<table cellpadding="5" cellspacing="5" width="100%"  style="border: 1px solid #fff">
				<tr>
					<td>Call Type</td>
					<td>
						<select name="Call Type">
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
					<td>Call Information </td>
					<td>
						<select name="Close Type"  class="col-md-9">
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
					<td><input value="Terminate" style="color: #ff0000; font-weight: bold; font-size: 10pt;" type="button"></td>
				</tr>
			</table>	
		</div>
	 </div>
        <div class="col-md-9" >	  
          <div class="row" >			 
				 <div class="col-md-3" style="background-color: #9cbdff;font-family:arial;font-size:16px;color:black;"> U ID : <?php echo $Beneficiary_Details['PhoneNo_Of_Whom'];?> </div> 
				<div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff"> Name of Sub Center : <?php echo $Beneficiary_Details['SubCentre_Name'];?>  </div>
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff"><span> Name of ANM : <?php echo $Beneficiary_Details['ANM_Name'];?>  </div>
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff">  Phone NO of ANM : <?php echo $Beneficiary_Details['ANM_Phone'];?></div> 
				
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff"> Name Of Associated ASHA : <?php echo $Beneficiary_Details['ASHA_Name'];?></div> 
				<div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff">ID of ASHA : <?php echo $Beneficiary_Details['ASHA_Name'];?> </div>
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff">Phone NO of ASHA : <?php echo $Beneficiary_Details['ASHA_Phone'];?></div>
				 <div class="col-md-3" style="font-family:arial;font-size:16px;color:black;background-color: #9cbdff">  </div> 	
			   
			 
			 <div class="col-md-12" style="background-color: #000080 ">
				<ul>
					<li class="li_active get_questions" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">Beneficiary Verification</li>
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
						<a href="pages/outbound/asha/asha.html" target="navcontent" >ASHA Verification</a></li>
					<li class="get_static"  style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
						<a href="pages/outbound/antenatalcare/antenatalcare.html" target="navcontent" >Antenatal Care</a></li>
					<!-- <li id="chc" href="antenatalcare/antenatalcare.html" target="navcontent" class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">Antenatal Care</li> -->
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
						<a href="pages/outbound/pnc/puerperium.html" target="navcontent" >Postnatal Care</a></li>
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
						<a href="pages/outbound/medicaldisorders/anemia.html" target="navcontent" >Anemia During pregnancy</a></li>
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">
					<a href="pages/outbound/immunization/nis.html" target="navcontent" >Child Immunization</a></li>
				</ul>
			 </div>
            <div class="col-md-12" >
				<div id="questions_html">
				<?php $skillset_page_query = mysql_query("select page from page_types where process='".$_POST['callProcess']."'") or die(mysql_error());
					  $skillset_page = mysql_fetch_array($skillset_page_query);	
					  include('type_one.php'); ?>					
				</div>	
				<div id="content_html" style="display:none">
					<iframe id="navcontent" name="navcontent" src="blank.html" border='0' width="100%" height="400px"> </iframe>
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
