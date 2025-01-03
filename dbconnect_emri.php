<?php error_reporting(0);
if(!isset($_SESSION)) {session_start();}

$convox_file = "convox3.conf";
if(file_exists($convox_file))
  {
   $lines = file($convox_file);
   
   foreach($lines as $line)
          {
            $line  = preg_replace("/ |>|\n|\r|\t|\#.*|;.*/","",$line);
            if(ereg("^host_ip",$line))
              {
               $host_ip = $line;
               $host_ip = preg_replace("/.*=/","",$host_ip);
              } 
            if(ereg("^emri_db_ip",$line))
              {
               $emri_host_ip = $line;
               $emri_host_ip = preg_replace("/.*=/","",$emri_host_ip);
              } 
            if(ereg("^emri_db_name",$line))
              {
               $emri_db_name = $line;
               $emri_db_name = preg_replace("/.*=/","",$emri_db_name);
              } 
            if(ereg("^emri_db_user",$line))
              {
               $emri_db_user = $line;
               $emri_db_user = preg_replace("/.*=/","",$emri_db_user);
              }
            if(ereg("^emri_db_pass",$line))
              {
               $emri_db_pass = $line;
               $emri_db_pass = preg_replace("/.*=/","",$emri_db_pass);
              }
            if(ereg("^emri_db_port",$line))
              {
               $db_port = $line;
               $db_port = preg_replace("/.*=/","",$emri_db_port);
              }        
            if(ereg("^company",$line))
              {
               $company = $line;
               $company = preg_replace("/.*=/","",$company);
              }        
            if(ereg("^google_map_api_key",$line))
              {
               $google_map_api_key = $line;
               $google_map_api_key = preg_replace("/.*=/","",$google_map_api_key);
              }  
            if(ereg("^enable_post_check",$line))
              {
               $enable_post_check = $line;
               $enable_post_check = preg_replace("/.*=/","",$enable_post_check);
              }  
          }   
   
  }
  else
  {
   exit("please contact convox administrator\n");
  }

$link=mysql_connect("$emri_host_ip:$emri_db_port", "$emri_db_user", "$emri_db_pass") or die(mysql_error());

mysql_select_db("$emri_db_name")or die(mysql_error());
?>
