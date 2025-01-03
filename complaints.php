<?php session_start();
require_once("dbconnect_emri.php");
  


if($_SESSION['user_login'] != "USER")
 {
	echo '<script>location.replace("login.php");</script>';
 }
 
 if($_SESSION['username'] =='')
 {
	 echo '<script>location.replace("login.php");</script>';
 }
 
 
 $agent_id = $_SESSION['username'];
 
$Query0 = "SELECT r.beneficiary_name,g.call_id,g.date,c.`Name`,g.name,g.`grievance_id`,g.`rDate`,g.`district_name`,g.`mobile1`,g.`name`,mad.`Agency_Name`,mi.`Name` FROM 
`grievance` g
left JOIN `m_institute` mi ON mi.`ID` = g.`institue`
left JOIN `m_agency_details` mad ON mad.`Agency_id`= g.`spocId`
left JOIN  `m_complaintstype` c ON c.ID=g.`complaintId`
LEFT JOIN `registration` r ON r.call_id=g.call_id  
 WHERE g.call_id <>'' AND g.`status` ='OPEN'; ";
$result = mysql_query($Query0);   


?>
<!DOCTYPE html>
<html>
<head>
<title>:: GVK EMRI :: </title>
        <script src="main_validation.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/custom.css" rel="stylesheet" />
<style>
        .main {
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
   
   <script src="scripts/main_validation.js"></script>
</head>
   <body style='width:99%'  >
  
  
	
  
  
  
  
	<div class="col-md-12" align="center">
                <h4><b> Complaints </b> </h4>
				 <div style="text-align:right"> <a align="right"  href="login.php?agent_id=<?php echo $agent_id;?>">logout</a></div>
        </div>
	<div class="col-md-6">
		<h4><b>Pending: <?=mysql_num_rows($result);?></b></h4>
        </div>
        
        <div class="col-md-12">
  		<table cellpadding="10" cellspacing="10" style="" width="100%" >
      	<tr style='background-color:lightgrey;'>
          <th>Sno</th>
          <th>callid</th>
          <th>Caller Name</th>
          <th>Complaint</th>
          <th>Phone Number</th>
          <th>Complaint Date</th> 
          <th>Status</th>
      	</tr>
	<?php
	if(mysql_num_rows($result) > 0) 
	 {
		$count=1;
		while($complaint_details = mysql_fetch_array($result))
	 	 {
			?>
			<tr onclick="postURL('Complaint_Details.php?call_id=<?=$complaint_details["call_id"];?>','false');return false;" onMouseOver="this.style.cursor='pointer'" <?=(($complaint_details["duration"]>48)?"style=background-color:red;color:white;":"");?>>
			<?php
                	echo "<td align=center>".$count."</td>";
               		echo "<td>".$complaint_details["call_id"]."</td>";
               		echo "<td>".$complaint_details["beneficiary_name"]."</td>";
               		echo "<td>".$complaint_details["Name"]."</td>";
               		echo "<td>".$complaint_details["mobile1"]."</td>";
               		echo "<td>".$complaint_details["rDate"]."</td>"; 
               		echo "<td>OPEN</td>";
			echo "</tr>";
			$count++;
		 }
	 }
	else
	 {
		echo "<td colspan='7' align='center' ><font color='red' size=2><b>No Records Found</b></font></td>";
	 }
	?>
		</table>
		</div>
	  

</html>
