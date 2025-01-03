<?php require_once("dbconnect_emri.php"); 
//echo "<pre>".print_r($_POST,1)."</pre>";


$Beneficiary_details_query= mysql_query("select * from mcth_mother where ID_No='010100107611300100'");
$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);
?>

<html>
<head>
<script src="scripts/main_validation.js"></script>
	<script type="text/javascript">
	function SaveTypeEightQuestions()
	 {
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {
			var MeaslesVaccine = "";
			if(document.getElementById("qone_y").checked)
			 {
				MeaslesVaccine = document.getElementById("qone_y").value;
			 }
			else if(document.getElementById("qone_n").checked)
			 {
				MeaslesVaccine = document.getElementById("qone_n").value;
			 }
			else
			 {
				alert("Please Choose Yes/No For Question 1");
				document.getElementById("qone_y").focus();
				return false;
			 }

			var VitASyrup = "";
			if(document.getElementById("qtwo_y").checked)
			 {
				VitASyrup = document.getElementById("qtwo_y").value;
			 }
			else if(document.getElementById("qtwo_n").checked)
			 {
				VitASyrup = document.getElementById("qtwo_n").value;
			 }
			else
			 {
				alert("Please Choose Yes/No For Question 2");
				document.getElementById("qtwo_y").focus();
				return false;
			 }
	
			var WeightGain = "";
			if(document.getElementById("qthree_y").checked)
			 {
				WeightGain = document.getElementById("qthree_y").value;
			 }
			else if(document.getElementById("qthree_n").checked)
			 {
				WeightGain = document.getElementById("qthree_n").value;
			 }
			else
			 {
				alert("Please Choose Yes/No For Question 3");
				document.getElementById("qthree_y").focus();
				return false;
			 }

			var CompmentaryFeeding = "";
			if(document.getElementById("qfour_y").checked)
			 {
				CompmentaryFeeding = document.getElementById("qfour_y").value;
			 }
			else if(document.getElementById("qfour_n").checked)
			 {
				CompmentaryFeeding = document.getElementById("qfour_n").value;
			 }
			else
			 {
				alert("Please Choose Yes/No For Question 4");
				document.getElementById("qfour_y").focus();
				return false;
			 }

			var InformationAboutNextVisit = "";
			if(document.getElementById("qfive_y").checked)
			 {
				 InformationAboutNextVisit = document.getElementById("qfive_y").value;
			 }
			else if(document.getElementById("qfive_n").checked)
			 {
				InformationAboutNextVisit = document.getElementById("qfive_n").value;
			 }
			else
			 {
				alert("Please Choose Yes/No For Question 5");
				document.getElementById("qfive_y").focus();
				return false;
			 }

			var callQuery = "measles_vaccine="+MeaslesVaccine+"&vit_a_syrup="+VitASyrup+"&weight_gain="+WeightGain+"&compmentary_feeding="+CompmentaryFeeding+"&information_about_next_visit="+InformationAboutNextVisit;
                        alert(callQuery);//return false;
			xmlHttp.open("POST","",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
                                        var Response = null;
                                        Response = xmlHttp.responseText;
                                        //alert(Response);
					var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_POST["convoxuid"];?>&agent_id=<?=$_POST["agentid"];?>&disposition=CALLTYPE8";
					//alert(end_call_url);                          
					postURL(end_call_url,"false");
                                 }
                         }
		 }
		delete xmlHttp;		
	 }			
	</script>



</head>
	<body>

	
	<div class="row" >
	 <div class="col-md-12"  >
	 <!-- <div class="row" style=" background-color: #58fcea ">
		 <div class="col-md-3"> UP  HEALTH  HELP LINE  </div>
		 <div class="col-md-3"><span> LOG IN ID :</span> xxxxxx </div>
		 <div class="col-md-3">  NAME : M.S Reddy</div> 
		 <div class="col-md-3"> CALL FLOW : Outbound - Beneficiary </div>
	 </div>   -->
	 <div class="row" style="background-color: #000080 ">
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"> Phone Number : <?php echo $Beneficiary_Details['PhoneNo_Of_Whom'];?> </div>
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"><span> Call ID :</span> xxxxxx </div>
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;">  Date : <?php echo $Beneficiary_Details['PhoneNo_Of_Whom'];?></div> 
		 <div class="col-md-3" style="font-family:arial;font-size:18px;color:white;font-weight:bold;"> Time : <?php echo $Beneficiary_Details['PhoneNo_Of_Whom'];?> </div>
	 </div>  
	  	 
	 </div>	
	 <div class="col-md-3"  style="background-color: #9cbdff ">
		
		<div class="form-group" > 
			<table>
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
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">ASHA Verification</li>
					<li id="chc" class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">Antenatal Care</li>
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">Postnatal Care</li>
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">Anemia During pregnancy</li>
					<li class="get_static" style="font-family:arial;font-size:13px;color:white;font-weight:bold;">Child Immunization</li>
				</ul>
			 </div>
            <div class="col-md-12" >
				<div id="questions_html">
				<?php $skillset_page_query = mysql_query("select page from page_types where process='".$_POST['callProcess']."'") or die(mysql_error());
					  $skillset_page = mysql_fetch_array($skillset_page_query);	
					if($skillset_page["page"] == '') include("type_one.php");		
					else include($skillset_page["page"]); ?>					
				</div>	
				<div id="content_html">	</div>
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
	var get_html_page = $(this).attr('id');
	$.post('pages/'+get_html_page+'.php', function(return_data){
		$('#content_html').html(return_data);
	}); 
});

</script>

<style>
	 .form-control {height:25px !important; }
	 ul li { border-right: 2px solid white; cursor:pointer;float: left; font-size:15px;   list-style: outside none none;    margin: 3px;    padding: 3px;}
	 .li_active {  background-color: blue ;}
	 .fontsytle { font-size:12px}
	</style> 
