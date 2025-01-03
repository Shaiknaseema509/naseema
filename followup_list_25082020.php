<?php 
include("includes/config.php");  
error_reporting(0);
session_start();
//echo '<pre>'; print_r($_REQUEST);
$agentID=$_REQUEST["agentid"];
$_SESSION['agentID']=$_REQUEST["agentid"];
$_SESSION['Queue']=strtoupper($_REQUEST["queue_name"]);
$_SESSION['call_hit_referenceno']=$_REQUEST["call_hit_referenceno"];
$_SESSION['convoxID']= $_REQUEST["convoxID"];
$convoxID= '192.168.3.24';

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
		<th>Followup Time</th>
        <th>Patient Name</th>
		<th>Call Type Name</th>
        <th>Category Name</th>
        <th>Sub Category Name</th>
        <th>Risk Level Name</th>
		<th>Referral Name</th>
		<th>Followup Number</th> 
		<th>Future Followup Date</th>
        </tr>
		</thead>
		<tbody>
		<?php		
 
		$row=$mysqli->query("SELECT cid.`caller_id`, cid.`call_end_time`, cid.`patient_name`, mcs.`call_type_name`, mc.`category_name`, ms.`sub_category_name`, 
mr.`risk_level_name`, fl.`followup_name`,cid.`referrals_concerned_name`,fs.are_you_willing_for_future_followup `fs1`
,fsn.are_you_willing_for_future_followup `fs2`, IF(fs.next_follow_up_date IS NULL, wc.followup_date,fs.next_follow_up_date) `next_follow_up_date`,
IF(fs.`followup_datetime` IS NULL, fsn.`followup_datetime`,fs.`followup_datetime`) `Followup_Date`
FROM `call_incident_info_details_suicide` cid
LEFT JOIN `welfare_call_details_suicide` wc ON wc.callid = cid.caller_id
LEFT JOIN `m_category` mc ON mc.`category_id` = cid.`category_id`
LEFT JOIN `m_call_type_suicide` mcs ON mcs.`call_type_id` = cid.call_type_id
LEFT JOIN `m_sub_category` ms ON ms.`sub_category_id` = cid.`sub_category_id`
LEFT JOIN `m_risk_level` mr ON mr.`risk_level_id` = cid.`risk_level_id`
LEFT JOIN `followup_save_details` fs ON fs.`callid` = wc.callid
LEFT JOIN `followup_save_details_2` fsn ON fsn.`callid` = cid.caller_id
LEFT JOIN `followup_levels` fl ON fl.`followup_id` = fs.`followup_no`
WHERE `status` <> 1 AND `status` <> 0 AND `consent_for_followup` = 1
AND cid.caller_id NOT IN (SELECT callid FROM `followup_save_details` WHERE `followup_call_not_answered_reason` = 7)"); 
		$i = 0;
		
		if($row->num_rows>0){
	
			while($result = $row->fetch_assoc()){
			if($result["fs1"] == 'No' || $result["fs2"] == 'No') continue; 
			$i++;
 
				
		?>
		 
		
		<tr onmouseover="this.style.cursor='pointer'" onclick="window.location ='followup.php?id=<?php echo $result["caller_id"];?>&agent_id=<?php echo $agentID;?>&convoxid=<?php echo $convoxID;?>'">
		
		<td><?php echo $i; ?></td>
		<td><?php echo ucfirst($result["caller_id"]);?></td> 
		<td><?php echo ucfirst($result["call_end_time"]);?></td>
		<td><?php echo ucfirst($result["Followup_Date"]);?></td>
		<td><?php echo ucfirst($result["patient_name"]);?></td>
		<td><?php echo $result["call_type_name"];?></td>
		<td><?php echo $result["category_name"];?></td>
		<td><?php echo $result["sub_category_name"];?></td>
		<td><?php echo $result["risk_level_name"];?></td>
		<td><?php echo $result["referrals_concerned_name"];?></td>		
		<td><?php echo $result["followup_name"];?></td> 
		<td><?php echo $result["next_follow_up_date"];?></td> 

		
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

