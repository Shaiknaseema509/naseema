<?php
require_once("dbconnect_emri.php"); 


$dats = $_POST['is_days'];


$Beneficiary_details_query= mysql_query("SELECT mg.`escalationLevelName`,g.closed_remarks,r.`beneficiary_name`,g.status,ci.phone_number,
 g.call_id,g.`contact_no`,g.`date`,g.`district_name`,g.`block_name`,g.`village_name` FROM `grievance` g 
 JOIN `call_incident_info` ci ON ci.callid = g.call_id
 JOIN `registration` r ON ci.phone_number = r.contact_no 
 -- JOIN `m_grivence_details` mg ON mg.`Agency_id`=g.spocId
 JOIN `escalationresult` mg ON mg.ID=g.spocId
WHERE g.cLevel=1 AND  g.`status` <>'CLOSED'  AND `date` >= DATE(NOW() - INTERVAL ".$dats." DAY)  GROUP BY g.`call_id`  ORDER BY g.call_id DESC LIMIT 200;");
/*
$Beneficiary_details_query= mysql_query("SELECT mg.`Agency_Name`,g.closed_remarks,r.`beneficiary_name`,g.status,ci.phone_number,g.call_id,g.`contact_no`,
	g.`date`,g.`district_name`,g.`block_name`,g.`village_name` FROM `grievance` g 
LEFT JOIN `call_incident_info` ci ON ci.callid = g.call_id
LEFT JOIN `registration` r ON ci.phone_number = r.contact_no 
LEFT JOIN `m_grivence_details` mg ON mg.`Agency_id`=g.spocId
WHERE g.cLevel=1 and  g.`status` <>'CLOSED' AND `date` >= DATE(NOW() - INTERVAL ".$dats." DAY) order by g.call_id desc ;"); */
?>

<tr style="background-color:lightblue">
					<th>S.no</th>
					<th>Date of Generation</th>
					<th>Incident Id</th>
					<th>Caller Name</th>
					<th>Caller Number</th>
					<th>Status</th>
					<th>Level-1</th>
					<th>Remarks</th>
					<th>Level-2</th>
					<th>Remarks</th>
					<th>Level-3</th>
					<th>Remarks</th>
				</tr>
				
				<?php $i=1; while($Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query))
				{
					
					$level2 = mysql_fetch_array(mysql_query("SELECT mg.`Agency_Name` FROM `grievance` g  
LEFT JOIN `m_grivence_details` mg ON mg.`Agency_id`=g.spocId
WHERE cLevel=2 and call_id='".$Beneficiary_Details['call_id']."' limit 1 ; "));

				$level3 = mysql_fetch_array(mysql_query("SELECT mg.`Agency_Name` FROM `grievance` g  
LEFT JOIN `m_grivence_details` mg ON mg.`Agency_id`=g.spocId
WHERE cLevel=3 and call_id='".$Beneficiary_Details['call_id']."' limit 1 ; "));
					
					?>
					<tr>
						<td><?php echo $i++;?></td>						
						<td><?php echo date('Y-m-d',strtotime($Beneficiary_Details['date']));?></td>
						<?php /* <td><a href="trackgrevenceview.php?ID=<?php echo $Beneficiary_Details['call_id'];?>" ><?php echo $Beneficiary_Details['call_id'];?></a></td> */ ?>
					 <td style="color:green; cursor:pointer" onclick="return callTypeGre(333,<?php echo $Beneficiary_Details['call_id'];?>);"> <?php echo $Beneficiary_Details['call_id'];?></td> 
						<td><?php echo $Beneficiary_Details['beneficiary_name'];?></td>
						<td><?php echo $Beneficiary_Details['phone_number'];?></td>
						<td><?php echo $Beneficiary_Details['status'];?></td> 					 
						<?php //$level1 = mysql_query(mysql_fetch_array("select "));?>
						<td><?php echo $Beneficiary_Details['Agency_Name'];?></td>
						<td><?php //echo $Beneficiary_Details['district_name'];?></td>
						<td><?php echo $level2['Agency_Name'];?></td>
						<td></td>
						<td><?php echo $level3['Agency_Name'];?></td>
						<td></td>
						<td><?php echo $Beneficiary_Details['closed_remarks'];?></td>
						
						<?php /* <td><a href="grevenceview.php?ID=<?php echo $Beneficiary_Details['call_id'];?>"><input type="button" class="btn-success" value="View" ></a></td>*/?>
					</tr>
				<?php }




































die;
//include("includes/config.php");
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "shram_shayak_104");
$column = array("date","call_id","name","contact_no","status","name","name","name","name","name","closed_remarks");
$query = "
 SELECT * FROM grievance WHERE 
";

if(isset($_POST["is_days"]))
{
 $query .= "date BETWEEN CURDATE() - INTERVAL ".$_POST["is_days"]." DAY AND CURDATE() AND ";
}

if(isset($_POST["search"]["value"]))
{
 $query .= '(grievance_id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR date LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR call_id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR contact_no LIKE "%'.$_POST["search"]["value"].'%") ';
 $query .= 'OR status LIKE "%'.$_POST["search"]["value"].'%") ';
 $query .= 'OR closed_remarks LIKE "%'.$_POST["search"]["value"].'%") ';
 
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY grievance_id ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["grievance_id"];
 $sub_array[] = $row["date"];
 $sub_array[] = $row["call_id"];
 $sub_array[] = $row["name"];
 $sub_array[] = $row["contact_no"];
 $sub_array[] = $row["status"];
 $sub_array[] = $row["name"];
 $sub_array[] = $row["name"];
 $sub_array[] = $row["name"];
 $sub_array[] = $row["name"];
 $sub_array[] = $row["name"];
  $sub_array[] = $row["closed_remarks"];

 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM grievance";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);



?>