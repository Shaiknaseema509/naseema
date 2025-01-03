<?php   error_reporting(0);
include("includes/config.php");?>

<div class="datagrid">
<table>
  	
    <thead>
      <tr>
        <th>SNo</th>
        <th>Call ID</th>
        <th>Call Time</th>
        <th>Locality</th>
        <th>Caller Name</th>
		<th>Vehicle Number</th>
		<th>Vehicle Phone number </th>
		<th>Vehicle AssignedTime</th>
		<th>VBTransfer/Assign</th>
		<th></th>
		<th></th>	
			
        </tr>
		</thead>
		
		<tbody>
		<?php   
		
		$row=$mysqli->query("CALL getcallerhistory('".$_REQUEST['phone']."')");
		 $i = 0;
		
		 if($row->num_rows>0){
			
		while($result = $row->fetch_assoc()){$i++; ?>
		
		 <tr>

		<td><?php echo $i; ?></td>
		<td><?php echo $result["callid"];?></td>
		<td><?php echo $result["call_time"];?></td>
		<td><?php echo $result["phone_number"];?></td>
		<td><?php echo $result["caller_name"];?></td>
<td><?php echo $result["vehicle_no"];?></td>
<td><?php echo $result["contact_number"];?></td>
<td><?php echo $result["assigned_time"];?></td>
<td><?php echo $result["informed"];?></td>			
		<td><input type="button" value="append" onclick="return appendCallid(<?php echo $result["callid"];?>);" ></td>
		 </tr>
		
		<?php }}
		
		else
		{
			echo "<tr><td colspan='5' align='center' style='color:red;font-weight: bold;'>Records not found.</td></tr>";
		}
		
		
		
		?>
		
		</tbody>
		
  </table>
  

  </div>

</form>
 