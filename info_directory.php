<?php 
require_once("dbconnect_emri.php"); 
//echo "<pre>".print_r($_POST,1)."</pre>";
$Beneficiary_details_query= mysql_query("select * from mcth_mother where ID_No='010100107611300100'");
$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);
?>

<html>
<head>
 </head>
	<body>

	<div class="alert">
	<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	<br><br>
	<div class='alert_content'></div>
</div>

	
	<div class="row" >
	<div class="col-md-12"  >
	<div class="row" style="background-color: #000080 ">
		<div class="col-md-3 header "> Phone Number : <?=$_POST["callernumber"];?> </div>
		<div class="col-md-3 header "><span> Call ID :</span> xxxxxx </div>
		<div class="col-md-3 header "> Date : <?=$_POST["call_date"];?> </div> 
		<div class="col-md-3 header "> Time : <?=$_POST["call_time"];?></div>
	</div>  
	  	 
	</div>	
	<div class="col-md-3"  style="background-color: #9cbdff ">
		
	<div class="form-group" > 
		<table cellpadding="2" cellspacing="2" width="100%"  style="border: 1px solid #fff">
		<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;">Beneficiary ID :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['ID_No'];?>"  /></td>
			</tr><tr><td></td></tr>	
			<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Name :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['Name'];?>"  /></td>
			</tr><tr><td></td></tr>	
			<tr>
			<td align='right' style="font-family:arial;font-size:15px;color:black;" >Husband Name :</td>
			<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['Husband_Name'];?>"  /></td>
			</tr><tr><td></td></tr>	
			<tr>
				<td align='right' style="font-family:arial;font-size:15px;color:black;" >DOB : </td>
				<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['Birthdate'];?>"  /></td>
			</tr><tr><td></td></tr>	
			<tr>
				<td align='right' style="font-family:arial;font-size:15px;color:black;" >Age : </td>
				<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['Age'];?>"  /></td>
			</tr><tr><td></td></tr>	
			<tr>
				<td align='right' style="font-family:arial;font-size:15px;color:black;" >District : </td>
				<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['District_Name'];?>"  /></td>
			</tr><tr><td></td></tr>	
			<tr>
				<td align='right' style="font-family:arial;font-size:15px;color:black;" >Block : </td>
				<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['Taluka_Name'];?>"  /></td>
			</tr>	
			<tr><tr><td></td></tr>
				<td align='right' style="font-family:arial;font-size:15px;color:black;" >Panchayat : </td>
				<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['ID_No'];?>"  /></td>
			</tr>	
			<tr><tr><td></td></tr>
				<td align='right' style="font-family:arial;font-size:15px;color:black;" >Address : </td>
				<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['Address'];?>"  /></td>
			</tr><tr><td></td></tr>	
			<tr>
				<td align='right' style="font-family:arial;font-size:15px;color:black;" >JSY Beneficiary : </td>
				<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['JSY_Beneficiary'];?>"  /></td>
			</tr><tr><td></td></tr>	
			<tr>
				<td align='right' style="font-family:arial;font-size:15px;color:black;" >Caste : </td>
				<td align='nowrap' style="font-family:arial;font-size:15px;color:black;"><input type="text" value="<?=$Beneficiary_Details['Caste'];?>"  /></td>
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
				
			<tr>
				<td>Transfer</td>
				<td><select name="call_transfer">
					<option value="Doctor">Doctor</option>
					<option value="Counselling">Counselling</option> 
				</select></td>
			</tr>
			<tr>
			<td></td>
				<td><input value="Transfer" style="color: #ff0000; font-weight: bold; font-size: 10pt;" type="button"></td>
			</tr>
		</table>	
		
	</div>
	</div>
        <div class="col-md-9" >	  
        <div class="row" >			 
		<div class="col-md-3 blueclass" style="font-family:arial;font-size:15px;color:black;"> U ID : <?php echo $Beneficiary_Details['PhoneNo_Of_Whom'];?> </div> 
		<div class="col-md-3 blueclass " style="font-family:arial;font-size:13px;color:black;"> 
		<select name="Education">
		<option value="EDUCATION">EDUCATION</option>
		<option value="No Schoolin">No Schooling</option>
		<option value="Primary">Primary Schooling</option>
		<option value="Secondary">Up to 10th</option>
		<option value="Graduation">Graduation</option>
		<option value="">Post Graduation</option>
		</select>  
	</div>
	<div class="col-md-3 blueclass " style="font-family:arial;font-size:13px;color:black;">
		<select name="Occupation">
		<option value="OCCUPATION">OCCUPATION</option>
		<option value="Student">Student</option>
		<option value="Employed">Employed</option>
		<option value="Un-employed">Un-employed</option>
		<option value="Home Maker">Home Maker</option>
		<option value="Retired">Retired</option>
		<option value="Agriculture">Agriculture</option>
		<option value="Business">Business</option>
		<option value="Labourer">Labourer</option>
		<option value="Others">Others</option>
		</select> 
	</div>
	<div class="col-md-3 blueclass " style="font-family:arial;font-size:13px;color:black;"> 
		<select name="Marrital status">
		<option value="MARITAL STATUS">MARITAL STATUS</option>
		<option value="Not applicable">Not applicable</option>
		<option value="Un-Married">Un-Married</option>
		<option value="Married">Married</option>
		<option value="Divorcee">Divorcee</option>
		<option value="Widowed">Widowed</option>
		<option value="Seperated">Seperated</option>
		<option value="Live-In">Live-In</option>
		</select>
	</div> 
				
	<div class="col-md-3 blueclass " style="font-family:arial;font-size:15px;color:black;"> Advice Sought By: <input type="text" /></div> 
	<div class="col-md-3 blueclass " style="font-family:arial;font-size:13px;color:black;"> 
		<select name="RELATIONSHIP">
		<option value="RELATIONSHIP">RELATIONSHIP</option>
		<option value="Parent">Parent</option>
		<option value="Spouse">Spouse</option>
		<option value="Relative">Relative</option>
		<option value="friend">friend</option>
		<option value="Known">Known</option>
		<option value="Unknown">Unknown</option>
		</select>
	</div>
	<div class="col-md-3 blueclass " style="font-family:arial;font-size:15px;color:black;">Past History: <input type="text" ></div>
	<div class="col-md-3 blueclass " style="font-family:arial;font-size:15px;color:black;"> Present Complaint :<input type="text" > </div> 	
			   			 
	<div class="col-md-12" style="background-color: #000080 ">
		<ul>
			<li class="li_active get_questions  blueclass_1 ">Beneficiary Verification</li>
			<li class="get_static blueclass_1 "><a href="pages/inbound/general/general.html" target="navcontent" >General</a></li>
			<li class="get_static"  style="font-family:arial;font-size:13px;color:white;font-weight:bold;"><a href="pages/inbound/pain/pain.html" target="navcontent" >Pain</a></li> 
			<li class="get_static blueclass_1 "><a href="pages/inbound/adolescence/adolescence.html" target="navcontent" > Adolescence </a></li>
			<li class="get_static blueclass_1 "><a href="pages/inbound/women/women.html" target="navcontent" > Women </a></li>
			<li class="get_static blueclass_1 "><a href="pages/inbound/antenatalcare/antenatalcare.html" target="navcontent" >  Pregnancy </a></li>
			<li class="get_static blueclass_1 "><a href="pages/inbound/contraception/contraception.html" target="navcontent" >  Contraception </a></li>
			<li class="get_static blueclass_1 "><a href="pages/inbound/immunization/nis.html" target="navcontent" >  Immunization </a></li>
		</ul>
	</div>
	<div class="col-md-12" >
	<div id="questions_html">
		<?php $skillset_page_query = mysql_query("select page from page_types where process='".$_POST['callProcess']."'") or die(mysql_error());
		$skillset_page = mysql_fetch_array($skillset_page_query);	
		if($skillset_page["page"] == '')  include('type_five.php');
		else  include($skillset_page["page"]); ?>					
	</div>	
	<div id="content_html" >
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
