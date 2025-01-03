<?php error_reporting(0);
require_once("dbconnect_emri.php"); 
date_default_timezone_set('Asia/Calcutta'); 

$action	= $_POST['type'];
$ID	= $_POST['ID'];
$result	= $_POST['result'];
$call_id	= $_POST['call_id'];
$agent_id	= $_POST['agent_id'];

$complaint	= $_POST['complaint'];
$advice	= $_POST['advice'];
$output	= $_POST['outputs'];
$cat	= $_POST['cat'];
$bskpoint	= $_POST['bskpoint'];
  
  if($agent_id =='') $agent_id='test';
 
mysql_set_charset('utf8'); 
 
 if($action == 'SaveGrievance')
 {
	 $qu = mysql_query("SELECT `sym_symID`,`sym_Name_Eng`,`sym_YesParent`,`sym_NoParent`,sym_Name_Tel FROM `prtsymptoms` WHERE  `sym_IsActive`=1 AND `sym_scatID`=$ID");
	 $data = mysql_fetch_array($qu);
	  $c= mysql_num_rows($qu);
		 if($c =='' ) die; 
		 
		 else {?>
		<center > <?php if($data['sym_Name_Tel'] !='') echo $m=$data['sym_Name_Tel']; else echo $m=$data['sym_Name_Eng'];?>
			<br />
			<input type="button" class="btn btn-info" align="center" value="Yes" onclick="return GetRegions12345('<?php echo $data['sym_symID'];?>','YES');">
			<input type="button" class="btn btn-warning" align="center" value="No"  onclick="return GetRegions1234('<?php echo $data['sym_NoParent'];?>','NO');" >	 
		 </center>
		 <?php  
		 
		$nQuery= mysql_query("select * from medical_advice where callid='".$call_id."'");
			 if(mysql_num_rows($nQuery) >0)
			 {
				 mysql_query("update medical_advice set category_id='".$ID."' where callid ='".$call_id."'");
			 }
			 else
			 {
				 mysql_query("insert into medical_advice set callid ='".$call_id."',category_id='".$ID."'");
			 }
		 }
		 
		 $message = '<table border="1" style="text-align:center;color:white" width="90%"><tr><td>'.$_POST['catvalue'].' </td></tr><tr><td>'.$m.'</td></tr>';
		 $d= mysql_query("select * from casefulldetails where callid = '".$call_id."';"); 
		
		if(mysql_num_rows($d)>0)
		{
			$Query	= "update casefulldetails SET `message`=CONCAT(`message`,'".$message."') where callid='".$call_id."'";
		}
		 else
		 {		
			 $Query	= "INSERT INTO casefulldetails SET	agentId='".$agent_id."',callid='".$call_id."', message='".$message."',dateTime=NOW()";
		}
		//dblog($Query);
		mysql_query($Query);
		 
 }
 
 
 if($action == 'getQuestions')
 {
	 if($result =='NO')
	 {
		$qu = mysql_query("SELECT `sym_symID`,`sym_Name_Eng`,`sym_YesParent`,`sym_NoParent`,sym_Name_Tel FROM `prtsymptoms` WHERE  `sym_IsActive`=1 AND `sym_scatID`=$cat AND sym_NoParent=$ID");
		 
		 $c= mysql_num_rows($qu);
		 if($c =='' ) die;
		 
		 
		 $data = mysql_fetch_array($qu);?>
		  <center > <?php if($data['sym_Name_Tel'] !='') echo $m=$data['sym_Name_Tel']; else echo $m=$data['sym_Name_Eng'];?>
			<br />
			<input type="button" class="  btn btn-info" align="center" value="Yes" onclick="return GetRegions12345('<?php echo $data['sym_symID'];?>','YES');">
			<input type="button" class="  btn btn-warning" align="center" value="No"  onclick="return GetRegions1234('<?php echo $data['sym_symID'];?>','NO');" >	 
			 </center>
	 <?php  
			 $message = '<tr><td>NO </td></tr><tr><td>'.$m.'</td></tr>';
		 $d= mysql_query("select * from casefulldetails where callid = '".$call_id."';"); 
		
		if(mysql_num_rows($d)>0)
		{
			$Query	= "update casefulldetails SET `message`=CONCAT(`message`,'".$message."') where callid='".$call_id."'";
		}
		 else
		 {		
			 $Query	= "INSERT INTO casefulldetails SET	agentId='".$agent_id."',callid='".$call_id."', message='".$message."',dateTime=NOW()";
		} 
		mysql_query($Query);
	 
	 } 
	 else 
	 {?>
		 
		 
		 
	 <?php }
 }
 
 if($action == 'getQuestionsYES')
 {
	 if($result =='YES')
	 {
		 $qu1 = mysql_fetch_array(mysql_query("SELECT `if_ifID`,`if_desc_Eng`,if_desc_Tel FROM `prtinfo` WHERE `if_symID`=$ID"));
		 $qu2 = mysql_fetch_array(mysql_query("SELECT `sdd_sddID`,`sdd_DOdesc_Eng`,sdd_DOdesc_Tel FROM `prtsymdodonts` WHERE `sdd_symID` =$ID"));
		 $qu3 = mysql_fetch_array(mysql_query("SELECT `act_actID`,`act_desc_Eng`,act_desc_Tel FROM `prtsymaction` WHERE `act_symID`=$ID"));
		  ?>
		<tr>
		<td align="right">
		<textarea type="text" name="Search" id="txtAutoSearch"  row="2" class="btnvalue form-control"  placeholder="Info" >
		<?php if($qu1['if_desc_Tel'] !='') echo $res1=$qu1['if_desc_Tel']; else echo $res1=$qu1['if_desc_Eng'];?></textarea>
		</td>
		</tr>
		<tr>
		<td align="right">
		<textarea type="text" name="Search" id="txtAutoSearch"   row="2"class="btnvalue form-control" placeholder="Action" >
		<?php if($qu3['sdd_DOdesc_Tel'] !='') echo $res2=$qu3['sdd_DOdesc_Tel']; else  echo $res2=$qu3['act_desc_Eng'];?> </textarea>
		</td>
		</tr>
		<tr>
		<td align="right">
		<textarea type="text" name="Search" id="txtAutoSearch"  row="2" class="btnvalue form-control"  placeholder="Do &" >
		<?php if($qu2['act_desc_Tel'] !='') echo $res3=$qu2['act_desc_Tel']; else  echo $res3=$qu2['sdd_DOdesc_Eng'];?></textarea>
		</td>
		</tr>
		
<?php //echo "update medical_advice set question_id='".$ID."' where callid ='".$call_id."'";
		 mysql_query("update medical_advice set question_id='".$ID."' where callid ='".$call_id."'");
		 
		  //$message = 'YES';
		   $message = '<tr><td>YES </td></tr><tr><td>('.$res1.','.$res2.','.$re3.')</td></tr>';
		 $d= mysql_query("select * from casefulldetails where callid = '".$call_id."';"); 
		
		if(mysql_num_rows($d)>0)
		{
			$Query	= "update casefulldetails SET `message`=CONCAT(`message`,' ->".$message."') where callid='".$call_id."'";
		}
		 else
		 {		
			 $Query	= "INSERT INTO casefulldetails SET	agentId='".$agent_id."',callid='".$call_id."', message='".$message."',dateTime=NOW()";
		} 
		mysql_query($Query);

 } 
	 else 
	 {?>
		 
		 
		 
	 <?php }
 }
 
  if($action == 'SAVEMEDICAL')
 {
	// echo "update medical_advice set summries_id='".$output."',advice='".$advice."',complaint='".$complaint."' where callid ='".$call_id."'";
	 mysql_query("insert into  medical_advice set summries_id='".$output."',advice='".$advice."',complaint='".$complaint."',bskpoint='".$bskpoint."', callid ='".$call_id."'"); 
	 mysql_query("update medical_advice set summries_id='".$output."',advice='".$advice."',complaint='".$complaint."',bskpoint='".$bskpoint."' where callid ='".$call_id."'"); 
 }
 
 
 

 function dblog($Query)
{
  $log_path = "log/".date("Y-m")."/".date("Y-m-d");
  mkdir($log_path,0777,true);
  $log_file = "$log_path/med_".date("Y-m-d_H").".csv";
     if(file_exists($log_file))
       {
         $LOGFILE_HANDLE = fopen($log_file,"a");
       }
     else
       {
         $LOGFILE_HANDLE = fopen($log_file,"w");
       }

     chmod($log_file,0755);
     $dataString = "\"".date("Y-m-d H:i:s")."\","."\"".$Query."\"";
     $dataString .= "\n";
     fwrite($LOGFILE_HANDLE,$dataString);
     fclose($LOGFILE_HANDLE);
     $dataString ="";
}	
 


?>
