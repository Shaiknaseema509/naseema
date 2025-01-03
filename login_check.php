<?php session_start();
//error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
require_once("dbconnect_emri.php");
// echo "select designation,user_name from acl_user where user_name='".$_POST["lg_username"]."' and password='".$_POST["lg_password"]."'";
	 $login_query= mysql_query("select designation,user_name from acl_user where 
	 user_name='".mysql_real_escape_string($_POST["lg_username"])."' and password='".mysql_real_escape_string($_POST["lg_password"])."'") or die(mysql_error());
	// $num= mysql_num_rows($login_query);
	
	 if(mysql_num_rows($login_query) != 0)
	 {
		 $result = mysql_fetch_array($login_query);
		 $date_time = date('Y-m-d H:i:s');
			$_SESSION['username']=$result['user_name'];
			$_SESSION['user_login']='USER';
			echo $_SESSION['usertype']=$result['designation'];
			
			$update_login_history = "insert into acl_user_history (user_id,user_name,login_time,logout_time) (select user_id,user_name,login_time,logout_time from acl_user WHERE user_name='".$_POST["lg_username"]."' and password='".$_POST["lg_password"]."')";
			mysql_query($update_login_history);
			
			
			$update_login = "UPDATE acl_user SET is_login=1,login_time='".$date_time."',logout_time='0000-00-00 00:00:00' WHERE user_name='".$_POST["lg_username"]."' and password='".$_POST["lg_password"]."' and is_login=0";
			mysql_query($update_login);
			 
	 /*if($result['designation'] == 'ero' || $result['designation'] == 'ERO' )
		 {
			 echo '<script>location.replace("Home.php");</script>';
		 }
		 else
		 {
			 echo '<script>location.replace("district_caseclose.php");</script>';
		 } */
		 //echo 'success';
		 
	 }
	 else
	 {
		 echo 'Invalid details';
	 } 
