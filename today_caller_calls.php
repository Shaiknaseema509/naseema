<?php

require_once("dbconnect_emri.php");

$CALL_TYPE_ARRAY = array();
$call_type_query = "SELECT call_type_id, call_type_name FROM m_call_type  WHERE is_active=1;";
$call_type_result = mysql_query($call_type_query);
while($call_type_details = mysql_fetch_array($call_type_result))
 {
	$CALL_TYPE_ARRAY[$call_type_details["call_type_id"]] = $call_type_details["call_type_name"];	
 }
$phone_number = $_POST["phone_number"];
$current_date = date("Y-m-d");

$Query ="SELECT CIO.callid, CIO.call_time, CIO.call_type_id,mct.call_type_name, R.aadhar_uid_no, R.beneficiary_name, R.agent_id, R.district_name, R.block_name, 
R.village_name FROM call_incident_info AS CIO 
LEFT JOIN registration AS R ON (CIO.beneficiary_id = R.registration_id) 
LEFT JOIN m_call_type AS mct ON (mct.call_type_id = CIO.call_type_id) 
WHERE CIO.call_time >= '$current_date 00:00:00' AND CIO.call_time <= '$current_date 23:59:59' AND CIO.phone_number='".$phone_number."' ORDER BY CIO.callid DESC;";

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
	<?php
	echo "<table class='table table-bordered table-hover table-striped'>";
	echo "<thead><tr>";
		echo "<th nowrap>Sno</th>";
		echo "<th nowrap>Call ID</th>";
		echo "<th nowrap>Aadhar No</th>";
		echo "<th nowrap>Benificiary Name</th>";
		echo "<th nowrap>Para medico</th>";
		echo "<th nowrap>Call Time</th>";
		echo "<th nowrap>Call Type</th>";
		echo "<th nowrap >District</th>";
		echo "<th nowrap >Mandal</th>";
		echo "<th nowrap>City</th>";
	echo "</tr></thead>";

	if(mysql_num_rows($Result) > 0)
	 {
		$sno = 1;
		while($Details = mysql_fetch_array($Result))
		 {
			echo "<tr>";
				echo "<td>".$sno."</td>";
				echo "<td>".$Details["callid"]."</td>";
				echo "<td>".$Details["aadhar_uid_no"]."</td>";
				echo "<td>".$Details["beneficiary_name"]."</td>";
				echo "<td>".$Details["agent_id"]."</td>";
				echo "<td>".$Details["call_time"]."</td>";
				echo "<td>".$Details["call_type_name"]."</td>";
				echo "<td>".$Details["district_name"]."</td>";
				echo "<td>".$Details["block_name"]."</td>";
				echo "<td>".$Details["village_name"]."</td>";
			echo "</tr>";
			$sno++;
	 	 }
 	 }
	else
	 {
		echo "<tr><td colspan='16' align='center' ><font color='red' size=2><b>No Records Found</b></font></td></tr>";
	 } 
	echo "</table>";
	
?>
</div>
</body>
</html>
