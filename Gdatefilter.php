<?php
require_once("dbconnect_emri.php"); 

if(isset($_POST["from"],$_POST["to"]))
{
    $result = '';
   $query = " SELECT * FROM grievance WHERE date(date) BETWEEN '".$_POST["from"]."' and '".$_POST["to"]."'";

    $sql = mysql_query($query);
    
    $result .='
    <table class="table">
    <tr>
 
	<th>Callid</th>
	<th>Date</th>
	<th>Complaint</th>
	<th>Status</th>
	<th>District</th>
	<th>Uploaded File</th>
	<th>Action</th>
    </tr>';

    if(mysql_num_rows($Beneficiary_details_query) >= 0)
    {
       
        while($Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query))
		{
					<tr>
			
			
            $result .='
            <tr>
           
            <td>'.$Beneficiary_Details["call_id"].'</td>
			<td>'.$Beneficiary_Details["date"].'</td>
            <td>'.$Beneficiary_Details["gistComplatint"].'</td>
			<td>'.$Beneficiary_Details["phone_number"].'</td>
            <td>'.$Beneficiary_Details["status"].'</td>
			<td>'.$Beneficiary_Details["district_name"].'</td>
			<td><a href="uploads/'.$Beneficiary_Details['file'].'"></a></td>
           <td><a href="grevenceview.php?ID='.$Beneficiary_Details['call_id'].'"><input type="button" class="btn-success" value="View" ></a></td>
					</tr>
				
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