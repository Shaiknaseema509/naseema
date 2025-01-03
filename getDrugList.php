<?php include("dbconnect_emri.php"); 

$CallID= $_POST['CallID'];

?> 

<table border='2' cellpadding="5" cellspacing="5">
	<tr>
		<td>S.no</td>
		<td>Callid</td>
		<td>Caller Name</td>
		<td>Patient Name</td>
		<td>Phone Number</td> 
		<td>District Name</td>		
		<td>Mandal Name</td>
		<td>City Name</td>
		<td>Call Type Name</td>
	</tr>
	
 
	
	<?php $i=1;
	
	$drugQuery = mysql_query("SELECT cis.*, mc.`call_type_name`  FROM `call_incident_info_details_suicide` cis
							  JOIN `m_call_type_suicide` mc ON mc.`call_type_id` = cis.`call_type_id`
	                          WHERE phone_number = $CallID");
	while($drugData = mysql_fetch_array($drugQuery))
	{?>
	<tr>
	
		<td><?=$i++;?></td>
		<td><?php echo $drugData['caller_id'];?></td>
		<td align="center"><?php echo $drugData['caller_name'];?></td> 
		<td align="center"><?php echo $drugData['patient_name'];?></td>
		<td align="center"> <?php echo $drugData['phone_number'];?></td>
		<td align="center"><?php echo $drugData['district_name'];?></td>
		<td align="center"><?php echo $drugData['mandal_name'];?></td>
		<td align="center"><?php echo $drugData['village_name'];?></td>
		<td align="center"><?php echo $drugData['call_type_name'];?></td>


 	</tr>
<?php }?>
</table>