<?php  error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 
 
 if($_POST)
	 $dat = '"'.$_POST['dates'].'"';
 else
	 $dat = 'date(now())';
 
?>
<html>
<head> 
<title>REPORTS</title>
<script type="text/javascript">
function ExportToExcel(mytblId){
       var htmltable= document.getElementById('my-table-id');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }
</script>


<input type="button" onclick="ExportToExcel(1);" value="Export"  />

<form action="" method="post">
	<tr>
		<td><input type="text" name="dates" value="2019-07-08"  /> <input type="submit" value="Search" name="sear" /></td>
	</tr>	
</form>

	<table id="my-table-id" cellpadding="5" width="80%" cellspacing="5" border="1">
	
		<tr>
			<td colspan="5" align="center">
			GUJARAT GVK EMRI - 104 HEALTH HELPLINE - FEVER  <br />
			Daily Report : <?php echo $dat;?>
			</td>
		</tr>
		<tr>
			<td colspan="2">CALL DETAILS</td>
			<td>TODAY	</td>
			<td>CUMULATIVE THIS MONTH</td>	
			<td>LAUNCH TO TILL DATE</td>
		</tr>
		
		<tr >
			<td rowspan="4">Call Types</td> 
		</tr>	
		
		<tr>
			<td>Effective Calls</td>
			
			<?php //echo "select callid from `call_incident_info` WHERE DATE(`call_time`)=$dat and  call_type_id IN(1,2,3,4,5,6,13,26); ";?>"
			<td><?php echo $a=mysql_num_rows(mysql_query("select callid from `call_incident_info` WHERE DATE(`call_time`)=$dat and  call_type_id IN(24,28,22,13,31,4,5,1,30,26,29); "));?></td>
			<td><?php echo $b=mysql_num_rows(mysql_query("SELECT callid FROM `call_incident_info` WHERE MONTH(`call_time`)=MONTH(NOW()) AND  call_type_id IN(24,28,22,13,31,4,5,1,30,26,29);"));?></td>
			<td><?php echo $c=mysql_num_rows(mysql_query("SELECT callid FROM `call_incident_info` WHERE call_type_id IN(24,28,22,13,31,4,5,1,30,26,29);"));?></td>
			 
		</tr>
			<tr>
			<td>Ineffective Calls</td>
			<td><?php echo $d=mysql_num_rows(mysql_query("select callid from `call_incident_info` WHERE DATE(`call_time`)=$dat and  call_type_id not IN(24,28,22,13,31,4,5,1,30,26,29); "));?></td>
			<td><?php echo $e=mysql_num_rows(mysql_query("SELECT callid FROM `call_incident_info` WHERE MONTH(`call_time`)=MONTH(NOW()) AND  call_type_id not IN(24,28,22,13,31,4,5,1,30,26,29);"));?></td>
			<td><?php echo $f=mysql_num_rows(mysql_query("SELECT callid FROM `call_incident_info` WHERE call_type_id not IN(24,28,22,13,31,4,5,1,30,26,29);"));?></td>
			 
			</tr>
			<tr>
			<td>Total Calls</td>
			<td><?php echo $a+$d;?></td>
			<td><?php echo $b+$e;?></td>
			<td><?php echo $c+$f;?></td>
		</tr>	
	 
	 <tr>
		<td colspan="5">
			<table cellpadding="5" width="100%" cellspacing="5" border="1">
				<tr>
					<td>Call types</td>
					<td>TODAY	</td>
					<td>CUMULATIVE THIS MONTH</td>	
					<td>LAUNCH TO TILL DATE</td>
				</tr>
				<?php $dis = mysql_query("SELECT `call_type_id`,`call_type_name` FROM `m_call_type` where `is_active`=1 and call_type_id IN(24,28,22,13,31,4,5,1,30,26,29) order by call_type_name ASC");
				while($d= mysql_fetch_array($dis)){?>
				<tr> 
					<td><?php echo $d['call_type_name'];?></td>
					<td><?php echo $a=mysql_num_rows(mysql_query("SELECT callid FROM `call_incident_info` WHERE `call_type_id`='".$d['call_type_id']."' AND DATE(`call_time`) =$dat;"));?></td>
					<td><?php echo $a=mysql_num_rows(mysql_query("SELECT callid FROM `call_incident_info` WHERE `call_type_id`='".$d['call_type_id']."' AND month(`call_time`) =month(NOW());"));?></td>
					<td><?php echo $d=mysql_num_rows(mysql_query("SELECT callid FROM `call_incident_info` WHERE `call_type_id`='".$d['call_type_id']."' ;"));?></td>
				</tr>
				<?php  }?>
				
				
			</table>
		</td>
	</tr>	
	 
	</table>
	
	

</html>

 