<?php

require_once("dbconnect_emri.php");

if($enable_post_check == "Y")
 {
	if($_SERVER["REQUEST_METHOD"]!="POST")
 	 {
        	exit("In-Valid Request..");
 	 }
 }

//echo "<pre>".print_r($_REQUEST,1)."</pre>";

$register_details = $_REQUEST["register_details"];
$search_by = $_REQUEST["search_by"];
$current_date = date("Y-m-d");

if($search_by=='phone_number')
{
	$Query = "SELECT R.registration_id, R.contact_no, R.beneficiary_name, R.district_name, R.block_name, R.village_name, R.aadhar_uid_no, R.createdon, R.agent_id FROM registration AS R WHERE R.contact_no = '$register_details' ORDER BY createdon DESC;";
	$Result = mysql_query($Query);
}
elseif($search_by=='beneficiary_id')
{
	$Query = "SELECT R.registration_id, R.contact_no, R.beneficiary_name, R.district_name, R.block_name, R.village_name, R.aadhar_uid_no, R.createdon, R.agent_id FROM registration AS R WHERE R.registration_id = '$register_details' ORDER BY createdon DESC;";
	$Result = mysql_query($Query);
}
elseif($search_by=='aadhar_no')
{
	$Query = "SELECT R.registration_id, R.contact_no, R.beneficiary_name, R.district_name, R.block_name, R.village_name, R.aadhar_uid_no, R.createdon, R.agent_id FROM registration AS R WHERE R.aadhar_uid_no = '$register_details' ORDER BY createdon DESC;";
	$Result = mysql_query($Query);
}

?>
<html>
<head>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/custom.css" rel="stylesheet" />

	<style>
        
	.main 
	 {
		width: 1000px;
		padding-bottom: 0px;
		border-top: 0px;
		background-color: #FDFDFD;
		margin-left: auto;
		margin-right: auto;
		min-height: 412px;
		height: auto !important;
		box-shadow: 0 3px 3px rgba(104, 104, 104, 0.25);
		margin-top: 15px;
		margin-bottom: 15px;
	 }

	</style>

	<script>
	newHttpObject = function()
         {
		var xmlHttp=null;
                try
                {
                    // Firefox, Opera 8.0+, Safari
                    xmlHttp=new XMLHttpRequest();
                }
                catch (e)
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

	function searchvalidate_details(beneficiary_id,search_by,contact_no,aadhar_no)
        {
		opener.document.getElementById('search_by').value = search_by; //alert(search_by);
		if(search_by=='phone_number')
		{
			opener.document.getElementById('register_details_hidden').value = beneficiary_id;//alert(contact_no);
		}
		if(search_by=='beneficiary_id')
		{
			opener.document.getElementById('register_details_hidden').value = beneficiary_id;//alert(contact_no);
		}
                if(search_by=='aadhar_no')
                {
                        opener.document.getElementById('register_details_hidden').value = beneficiary_id;//alert(contact_no);
                }

		opener.searchvalidate(beneficiary_id,search_by,contact_no,aadhar_no);
		
		window.close();
	}

	</script>
</head>
<body>
	<div class="container">
	<div class="x_content" style="margin-top: 12px;">
	<div class="form-group">
	<?
	echo "<table class='table table-bordered table-hover table-striped'>";
	echo "<thead><tr>";
		echo "<th nowrap>Sno</th>";
		echo "<th nowrap>Action</th>";
		echo "<th nowrap>Beneficiary ID</th>";
		echo "<th nowrap>Contact Number</th>";
		echo "<th nowrap>Benificiary Name</th>";
		echo "<th nowrap >District</th>";
		echo "<th nowrap >Mandal</th>";
		echo "<th nowrap>City</th>";
		echo "<th nowrap>Aadhar No</th>";
		echo "<th nowrap >Present Complaint</th>";
		echo "<th nowrap >Created On</th>";
		echo "<th nowrap >Created By</th>";
	echo "</tr></thead>";

	if(mysql_num_rows($Result) > 0)
	 {
		$sno = 1;
		while($Details = mysql_fetch_array($Result))
		 {
			echo "<tr>";
				echo "<td>".$sno."</td>";
				echo "<td><a href='javascript:searchvalidate_details(\"$Details[registration_id]\",\"$search_by\",\"$Details[contact_no]\",\"$Details[aadhar_uid_no]\");'>Get Details </a></td>";
				echo "<td>".$Details["registration_id"]."</td>";
				echo "<td>".$Details["contact_no"]."</td>";
				echo "<td>".$Details["beneficiary_name"]."</td>";
				echo "<td>".$Details["district_name"]."</td>";
				echo "<td>".$Details["block_name"]."</td>";
				echo "<td>".$Details["village_name"]."</td>";
				echo "<td>".$Details["aadhar_uid_no"]."</td>";
				echo "<td>".$Details["present_compalint"]."</td>";
				echo "<td>".$Details["createdon"]."</td>";
				echo "<td>".$Details["agent_id"]."</td>";
			echo "</tr>";
			$sno++;
	 	 }
 	 }
	else
	 {
		echo "<td colspan='16' align='center' ><font color='red' size=2><b>No Records Found</b></font></td>";
	 } 
	echo "</table>";
	
?>
</div>
</body>
</html>
