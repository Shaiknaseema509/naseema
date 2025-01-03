<?php
require_once("dbconnect_emri.php"); 
$dir ="/var/www/html/EMRI/FEEDBACK_SMS_LOG";	
if (!is_dir($dir))
 {
	mkdir($dir);
	chmod($dir, 0777);
	$indexFile=fopen($dir."/dbconnect_emri.php","w+");
	fwrite($indexFile,'<?php ?> <HTML><META HTTP-EQUIV="REFRESH" CONTENT="0; URL=../EMRI/dbconnect_emri.php"></HTML>');
	fclose($indexFile);
 }
	
$myFile = $dir."/".date("Y-m-d")."_LogFile_feedback_sms.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
$host     = $_SERVER['HTTP_HOST'];
$script   = $_SERVER['SCRIPT_NAME'];
$params   = str_replace("%20"," ",$_SERVER['QUERY_STRING']);
$currentUrl = $protocol . '://' . $host . $script . '?' . $params;
$stringData.="Date and Time : ".date("Y-m-d H:i:s")."\n";
$stringData.="URL           : ".$currentUrl."\n";

$call_id = $_REQUEST["call_id"];

$reg_q 	    = "SELECT * FROM registration WHERE call_id='".$call_id."'";
$rslt_q	    = mysql_query($reg_q);
$rslt_sms   =mysql_fetch_array($rslt_q);
echo$registration_id  = $rslt_sms[registration_id];


$response="";
$stringData.="Response      : ".$response."\n\n";
fwrite($fh, $stringData);
fclose($fh);

?>

<form name="page" id="page" method="post" action="" onsubmit="return validate()">
    <input type="hidden" name="method" value="Later">
    <table border="1" align="center">
        <tbody><tr>
            <th colspan="2" align="center">
               Details 
            </th>
        </tr>
         <tr>
            <td>
                Beneficiary ID:<span style="color:#ff0000;">*</span>
            </td>
            <td>
                <input type="text" name="beneficiary_id" id="beneficiary_id" value="<?php echo $rslt_sms['registration_id'];?>">
            </td>
        </tr>
		<tr>
            <td>
                Beneficiary Name:<span style="color:#ff0000;">*</span>
            </td>
            <td>
                <input type="text" name="beneficiary_name" id="beneficiary_name" value="<?php echo $rslt_sms['beneficiary_name'];?>">
            </td>
        </tr>
        <tr>
            <td>
                Benificiary Surname:<span style="color:#ff0000;">*</span>
            </td>
            <td>
                <input type="text" name="benificiery_surname" id="benificiery_surname" value="<?php echo $rslt_sms['benificiery_surname'];?>">
            </td>
        </tr>
		<tr>
            <td>
                Age:
            </td>
            <td>
                <input type="text" name="age" id="age" value="<?php echo $rslt_sms['age'];?>">
            </td>
        </tr>
        <tr>
            <td>
                Gender:
            </td>
            <td>
                <input type="text" name="Gender" id="Gender" value="<?php echo $rslt_sms['Gender'];?>">
            </td>
        </tr>
        <tr>
            <td>
                Mother:
            </td>
            <td>
                <input type="text" name="mother" id="mother" value="<?php echo $rslt_sms['mother'];?>">
            </td>
        </tr>        
	<tr>
		<td> </td>
		<td><input type="radio" name="qnine" id="qnine_y" value="Yes" >Yes <input type="radio" name="qnine" id="qnine_n" value="No" >No</td>
	</tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Submit" name="sub">    
                <input type="reset" value="Reset" name="sub" onclick="javascript:document.getElementById('dummy_page').reset();">
            </td>
        </tr>
    </tbody></table>
</form>

