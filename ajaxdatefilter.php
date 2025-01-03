<?php
require_once("dbconnect_emri.php"); 

if(isset($_POST["from"],$_POST["to"]))
{
    $result = '';
   $query = " SELECT * FROM grievance WHERE date(date) BETWEEN '".$_POST["from"]."' and '".$_POST["to"]."' and status='OPEN' group by call_id";

    $sql = mysql_query($query);
    
    $result .='
    <table class="table ">
    <tr>
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
	<th>Remarks</th>    </tr>';

    if(mysql_num_rows($sql) >= 0)
    {

        while($row = mysql_fetch_array($sql))
        {
			$level2 = mysql_fetch_array(mysql_query("SELECT mg.`Agency_Name` FROM `grievance` g  
LEFT JOIN `m_grivence_details` mg ON mg.`Agency_id`=g.spocId
WHERE cLevel=2 and call_id='".$row['call_id']."' limit 1 ; "));

				$level3 = mysql_fetch_array(mysql_query("SELECT mg.`Agency_Name` FROM `grievance` g  
LEFT JOIN `m_grivence_details` mg ON mg.`Agency_id`=g.spocId
WHERE cLevel=3 and call_id='".$row['call_id']."' limit 1 ; "));
			
            $result .='
            <tr>
            <td>'.$row["id"].'</td>
            <td>'.$row["date"].'</td>';
			$result .='<td style="color:green; cursor:pointer" onclick="return callTypeGre(333,'.$row["call_id"].');"> '.$row["call_id"].'</td>'; 
            
			$result .='<td>'.$row["beneficiary_name"].'</td>
			<td>'.$row["phone_number"].'</td>
            <td>'.$row["status"].'</td>
			<td>'.$row["Agency_Name"].'</td>
            <td>'.$level2["Agency_Name"].'</td>
			<td>'.$level3["Agency_Name"].'</td>
            <td>'.$row["closed_remarks"].'</td>
            </tr>';
        }
		
		
		
		
		
		
    }

    else{
     $result .='
     <tr>
     <td>no records </td>
     </tr>';
    }

    $result .='</table>';
    echo $result;
}

?>