<?php
error_reporting(0);
require_once("dbconnect_emri.php"); 
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");
 



//header("Content-Type: text/xml; charset=utf-8");

 $times = date('YmdHis');
 $phone = $_POST['phone'];
 $callid = $_POST['callid'];
  
 mysql_query("insert into lbstest set `callid`='".$callid."',`phoneNumber`='".$phone."',`pushTime`=now()")or die(mysql_error());
 
 $url = "192.168.13.11:9092/getlocation";  //$url = "http://stackoverflow.com";
$xml = '<?xml version="1.0" encoding="UTF-8"?><iLocator>  <Request>    <username>Gvkgj104</username><password>gvk123!</password><msisdn>'.$phone.'</msisdn><timestamp>'.$times.'</timestamp>    <provide__meta>True</provide__meta>    <OPTIONAL>      <PARAM1>null</PARAM1>      <PARAM4>UP_INT</PARAM4>    </OPTIONAL>  </Request></iLocator>';




$headers = array(
    "Content-type: text/xml",
    "Content-length: " . strlen($xml),
    "Connection: close",
);

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
#curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); 
curl_setopt($ch, CURLOPT_TIMEOUT, 40);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$data = curl_exec($ch); 
 
if(curl_errno($ch))
    print curl_error($ch);
else
    curl_close($ch);
$xml = simplexml_load_string($data); // assume XML in $x
 $xml['latitude'];

$arr = (array) $xml->Response;

 

//$arr['latitude'].','.$arr['longitude'];
 if($arr['latitude'] !=0) 
 {
	 $result = getAddress($arr['latitude'],$arr['longitude']);
	 $output = $arr['latitude'].'@@#P@I@G@@'.$arr['longitude'].'@@#P@I@G@@'.$result.'@@#P@I@G@@'.$arr['METADATA']->name;
 }
 else {$output ='';}
 
 echo $output;
 
 if($callid == '' || $callid ==0)
	mysql_query("update lbstest set names='".$arr['METADATA']->name."',`pullTime`=now(),`lat`='".$arr['latitude']."',`long`='".$arr['longitude']."',`location`='".$result."'  where `phoneNumber`='".$phone."'");
else 
	mysql_query("update lbstest set names='".$arr['METADATA']->name."',`pullTime`=now(),`lat`='".$arr['latitude']."',`long`='".$arr['longitude']."',`location`='".$result."'  where `callid`='".$callid."'");
 
 // echo $arr['latitude'].','.$arr['longitude']; //print_r($arr);
  
  
  
  
function getAddress($latitude,$longitude)
{
	
	//$url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false&key=AIzaSyAG9NKpvl2C3rLGON1usqa2Z_Y2IiTQKOk';  
	$url = 'https://apis.mapmyindia.com/advancedmaps/v1/sy6sdjdfa2xozaqtdc6wgmdscc13j5ob/rev_geocode?lng='.trim($longitude).'&lat='.trim($latitude);  

	// $output = json_decode($geocodeFromLatLong);
		 $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
	if (curl_error($ch)) {
   echo  $error_msg = curl_error($ch);
	}
		
        $response_a = json_decode($response, true);
        //Get address from json data
		//echo '<pre>'; print_r($response_a); //die;
		  $address = $response_a['results'][0]['formatted_address']; //['address_components'][0]['formatted_address'];
		
      //  $address = ($status=="OK")?$output->results[1]->formatted_address:'';
        //Return address of the given latitude and longitude
        if(!empty($address))
		{
            return $address;
        }
		else
		{
            return false;
        }
     
}

 

?>
 