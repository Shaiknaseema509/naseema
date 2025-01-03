<?php  error_reporting(0);


$phone_number         = $_REQUEST["callernumber"]; 
$agent_id 	      = $_REQUEST["agentid"];  
$convoxID      = $_REQUEST["convoxID"]; 
$callid      = $_REQUEST["callid"]; 

 /*
		if($_POST['tabs'] ==1)
			include('medical_advice_tab.php'); 
		else if($_POST['tabs'] ==13)
		  include('fever.php');
	  else if($_POST['tabs'] ==6)
		  include('government_schemes_screen.php'); 
	  else if($_POST['tabs'] ==4)
		  include('type_five.php'); 
	  else if($_POST['tabs'] ==5)
		  include('Information_Directory_tab.php'); 
	  else
		  echo '';*/
	  
	  
	  if($_POST['tabs'] ==1)
			include('MedicalAdviseNew.php'); 
		else if($_POST['tabs'] ==13)
		  echo '<iframe width="98%" height="600px" frameBorder="0" src="http://192.168.3.23/104/IncidentInformation.aspx?agent_id=12345&mobilenumber='.$phone_number.'&convoxid='.$convoxID.'&DID=DID&agent_name='.$agent_id.'&newcallid='.$callid.'"></iframe>';
	  else if($_POST['tabs'] ==6)
		  include('government_schemes_screen.php'); 
	  else if($_POST['tabs'] ==49)
		  include('grv.php'); 
	  else if($_POST['tabs'] ==5)
		  include('Information_Directory_tab.php'); 
	   else if($_POST['tabs'] ==55)
		  include('CounsellingNew.php'); 
	  else if($_POST['tabs'] ==32)
		  include('suicide.php'); 
	   else if($_POST['tabs'] ==33)
		  include('../SSH_Closer/trackGrievance.php'); 
		else if($_POST['tabs'] ==333)
		  include('../SSH_Closer/trackgrevenceview.php'); 
	  else if($_POST['tabs'] ==26)
		  echo '<iframe width="98%" height="500px" frameBorder="0" src="http://192.168.3.23/104/CaseClosingSearch.aspx?agent_id='.$agent_id.'&mobilenumber='.$phone_number.'&convoxid='.$convoxID.'&DID=DID"></iframe>';
	  else
		  echo '';
	  
	  ?>
			 