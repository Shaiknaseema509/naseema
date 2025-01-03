<?php 
include("includes/config.php"); 

error_reporting(0);
 session_start();
//echo '<pre>'; print_r($_REQUEST);
$_SESSION['agentID']=$_REQUEST["agentid"];
$_SESSION['Queue']=strtoupper($_REQUEST["queue_name"]);
$_SESSION['call_hit_referenceno']=$_REQUEST["call_hit_referenceno"];
$_SESSION['convoxID']= $_REQUEST["convoxID"];
 
 

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
		  
		  
 
<script src="scripts/main_validation.js"></script>
 
 
<td>
<div class="datagrid">
<table><thead><tr>
        <th>SNo</th>
        <th>Call ID</th>
		<th>Call Time</th>
        <th>Patient Name</th>
		<th>Contact</th>
        <th>Alternate Contact</th>
        <th>District Name</th>
        <th>Mandal Name</th>
		<th>Village Name</th>
		<th>Category Name</th>
		<th>Sub Category Name</th>
		<th>Risk Level Name</th>
		<th>Referral Name</th>		
        </tr>
		</thead>
		<tbody>
		<?php		
 
		$row=$mysqli->query("SELECT cid.`caller_id`, ci.`call_time`,cid.`patient_name`,cid.`phone_number`, cid.`alternate_number`,
cid.`district_name`,cid.`mandal_name`,cid.`village_name`,cid.`location`,
mc.`category_name`,ms.`sub_category_name`, mr.`risk_level_name`,cid.`referrals_concerned_name`, cid.`call_not_answered_reason`
FROM call_incident_info_details_suicide cid
LEFT JOIN `m_category` mc ON mc.`category_id` = cid.`category_id`
LEFT JOIN `m_sub_category` ms ON ms.`sub_category_id` = cid.`sub_category_id`
LEFT JOIN `m_suicide_grievance` mg ON mg.`grievance_id` = cid.`grievace_id`
LEFT JOIN `m_risk_level` mr ON mr.`risk_level_id` = cid.`risk_level_id` 
JOIN `call_incident_info` ci ON ci.`callid` = cid.caller_id
WHERE cid.`consent_for_welfarecall` = 1 AND cid.`status` <> 2 AND cid.`call_not_answered_reason` <> 4 
AND cid.`call_not_answered_reason` <> 5"); 

		$i = 0;
		
		if($row->num_rows>0){
	
		while($result = $row->fetch_assoc()){$i++; ?>
		 
		
		<tr onmouseover="this.style.cursor='pointer'" onclick="window.location ='welfare_call.php?id=<?php echo $result["caller_id"];?>'">
		
		<td><?php echo $i; ?></td>
		<td><?php echo ucfirst($result["caller_id"]);?></td>
		<td><?php echo ucfirst($result["call_time"]);?></td>
		<td><?php echo ucfirst($result["patient_name"]);?></td>
		<td><?php echo $result["phone_number"];?></td>
		<td><?php echo $result["alternate_number"];?></td>
		<td><?php echo $result["district_name"];?></td>
		<td><?php echo $result["mandal_name"];?></td>
		<td><?php echo $result["village_name"];?></td>		
		<td><?php echo $result["category_name"];?></td>
		<td><?php echo $result["sub_category_name"];?></td>
		<td><?php echo $result["risk_level_name"];?></td>
		<td><?php echo $result["referrals_concerned_name"];?></td>
		
		</tr>
		
		<?php }}
		else
		{
			echo "<tr><td colspan='7' align='center' style='color:red;font-weight: bold;'>Records not found.</td></tr>";
		}
		
		?>
</tbody></table></div></form>
</div>		
</body>
</html>



<style>
.datagrid table { border-collapse: collapse; text-align: center; width: 100%;  } 
.datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; 
background: #fff; overflow: hidden; border: 1px solid #3A7999; 
border-radius: 10px; }
.datagrid tr:nth-child(even) {
  background-color:#E0FFFF;
  color: #000000;
}
.datagrid table td, .datagrid table th { padding: 16px 8px; }
.datagrid table thead th {
background-color:rgb(41, 183, 211);; color:#FFFFFF; font-size: 12px; text-align: center; font-weight: bold; border-left: 1px solid #0070A8; } 

.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: bold; }
.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }
.datagrid table tbody td:first-child { border-left: none; }
.datagrid table tbody tr:last-child td { border-bottom: none; }

</style>

