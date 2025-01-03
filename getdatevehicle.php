<?php 

include("includes/config.php"); 

date_default_timezone_set('Asia/Calcutta'); 

if($_POST['source'] == 'GETTIME')
{
	//echo date('d-m-y H:m:s');
	//$rowveh=$mysqli->query("SELECT NOW();");
	$result = $mysqli->query("SELECT now() as dat"); 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

echo trim($row['dat']);
}
 ?> 