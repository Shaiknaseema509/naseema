<?php 
$dbname='shramik_sahayak_104';
$dbuser='emri';
$dbpass='emri';
$dbhost= '192.168.3.23'; //'192.168.96.16';


$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) 
{
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//die;
//define("SITE_URL","http://localhost/Newfolder/AnimalHusbandry/");		

?>


