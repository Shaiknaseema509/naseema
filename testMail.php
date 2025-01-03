<?php // error_reporting(0); 
		
		$call_id=123;
		$url= 'http://202.131.123.37/emriview/grevenceview.php?ID='.$call_id;
		
		$message= '<table width="98%" border="1" cellpadding="10" cellspacing="10">
			<tr>
				<td>Date & Time</td>
				<td>'.date("Y-m-d H:i:s").'</td>
			</tr>
			<tr>
				<td>Incident ID</td>
				<td>'.$call_id.'</td>
			</tr>
			<tr>
				<td>Caller Name and Number</td>
				<td> '.$userDetails['beneficiary_name'].', '.$userDetails['contact_no'].'</td>
			</tr>
			<tr>
				<td>Complaint Against & Designation</td>
				<td>'.$complaintagainst.' & '.$designationDetails['Name'].'</td>
			</tr>
			<tr>
				<td>Institute Name</td>
				<td>'.$insDetails['Name'].'</td>
			</tr>
			<tr>
				<td>Address_District_Taluka_Village</td>
				<td>'.$district_id[1].','.$block_id[1].','.$village_id[1].'  </td>
			</tr>
			<tr>
				<td>Gist of Complaint</td>
				<td>'.$goc.'</td>
			</tr>
			<tr>
				<td>URL</td>
				<td'.$url.'td>
			</tr>
		</table>';
		
		
		
		
		
		ini_set("SMTP","mail.emri.in"); 
			ini_set("smtp_port","587");

$sEmail =123;
			 
			if($sEmail !='')
			{
				$subject = 'Grievance';
//$message = ' ';
			#$header = 'From:rameshbabu_m@emri.in' . "\r\n" ;
			$header = 'From:rameshbabu_m@emri.in' . "\r\n" ;
			$to      = 'rameshbabu_m@emri.in'; //'santosh_nerlekar@emri.in';
			 
			//$header .= 'Cc:nikunj_prajapati@emri.in' . "\r\n";
			$header .= 'Cc: tushar_shroff@emri.in' . "\r\n";
			//$header .= 'Cc:	vasanth_k@emri.in ' . "\r\n";
			
			$header.= "MIME-Version: 1.0\r\n"; 
			$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
			$header.= "X-Priority: 1\r\n"; 

			 
			
			echo $status = mail($to, $subject, $message, $header);
			 
				if($status)
				{ 
					//mysql_query("insert into maillog set mailID='".$sEmail."',msg='".$message."',status='SENT',createdDate=now()"); 
				}
				else 
				{ 
					//mysql_query("insert into maillog set mailID='".$sEmail."',msg='".$message."',status='FAIL',createdDate=now()"); 
				}
			}
			
			
			 

?>
