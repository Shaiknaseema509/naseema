<?php

require_once("dbconnect_emri.php");

if($enable_post_check == "Y")
 {
	if($_SERVER["REQUEST_METHOD"]!="POST")
 	 {
        	exit("In-Valid Request..");
 	 }
 }

//echo "<pre>".print_r($_POST,1)."</pre>";

$CALL_TYPE_ARRAY = array();
$call_type_query = "SELECT call_type_id, call_type_name FROM m_call_type  WHERE is_active=1;";
$call_type_result = mysql_query($call_type_query);
while($call_type_details = mysql_fetch_array($call_type_result))
 {
        $CALL_TYPE_ARRAY[$call_type_details["call_type_id"]] = $call_type_details["call_type_name"];
 }

$call_id	= $_POST['call_id'];
$phone_number 	= $_POST["phone_number"];
$current_date 	= date("Y-m-d");

$Query = "SELECT CIO.callid,CIO.call_time, CIO.call_type_id, R.registered_contact_no  FROM registration AS R INNER JOIN  call_incident_info AS CIO ON CIO.beneficiary_id = R.registration_id WHERE R.contact_no='".$phone_number."' ORDER BY callid DESC;";
$Result = mysql_query($Query);

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
		echo "<th nowrap>Call ID</th>";
		echo "<th nowrap>Call Time</th>";
		echo "<th nowrap>Call Type</th>";
	echo "</tr></thead>";

	if(mysql_num_rows($Result) > 0)
	 {
		$sno = 1;
		while($Details = mysql_fetch_array($Result))
		 {
			echo "<tr>";
				echo "<td>".$sno."</td>";
			/*	echo "<td><a href='#'  onclick=\"window.open('CompleteBeneficaryHistory.php?callid=".$Details["callid"]."');\"> ".$Details["callid"]."</a></td>";*/
				echo "<td><a href='#'  onclick=\"window.open('CallDetails.php?callid=".$Details["callid"]."');\"> ".$Details["callid"]."</a></td>";
				echo "<td>".$Details["call_time"]."</td>";
				echo "<td>".$CALL_TYPE_ARRAY[$Details["call_type_id"]]."</td>";
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
