﻿<?php  error_reporting(0);
require_once("dbconnect_emri.php");




$phone_number         = $_REQUEST["callernumber"];
$Queue 	              = $_REQUEST["Queue"];
$agent_id 	      = $_REQUEST["agentid"];
$call_hit_referenceno = $_REQUEST["CallReferenceID"];
$service_id           = $_REQUEST["DID"];
$call_date            = $_REQUEST["CallDate"];
$call_time            = $_REQUEST["CallTime"];
$transfer_callid      = $_REQUEST["CallID"];
$callids      = $_REQUEST["callid"];
$convoxID      = $_REQUEST["convoxID"];
$beneficiary_id	      = $_REQUEST["BeneficiaryID"];

mysql_set_charset('utf8'); 

if($callid == '') $callid = 20190000108063; 
if($callid1 == '') $callid1 = 20190000108063; 

//if($transfer_callid= '') $transfer_callid= 20180000000010;
$callid = $callids;
//echo 
//echo "<pre>".print_r($_REQUEST,1)."</pre>";

 
	$q= "select * from registration where call_id='$callids'";
	$Beneficiary_details_query= mysql_query($q)or die(mysql_error());
	$Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);
 
//echo "<pre>".print_r($Beneficiary_Details)."</pre>"; 
$current_date = date("Y-m-d");

 $Query1 = "SELECT COUNT(*) AS TODAY_COUNT FROM call_incident_info WHERE call_time >= '$current_date 00:00:00' AND call_time <= '$current_date 23:59:59' 
AND callid='".$callids."';";
$Result1     = mysql_query($Query1);
$Details1    = mysql_fetch_array($Result1);
$Today_Count = $Details1["TODAY_COUNT"];


mysql_query("update call_incident_info set transferTime = now(),transferAgent='".$agent_id."' where callid='".$callids."' order by callid desc limit 1");


 ?>


<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">


<script src="scripts/main_validation.js"></script>


<style>
  

    tblSearch tr {
        border: 1px solid black;
    }
</style>
<style>
[class*="span"]
{margin-left:0px !important}
</style>
<script type="text/javascript">



 function transfer_to_queue(ACTION)
        {
                //alert(ACTION);
				 
				
                var xmlHttp=newHttpObject();
                if(xmlHttp)
                {
					var abc= document.getElementById('call_transfer').value;
			var transfer_split = document.getElementById('call_transfer').value.split('~'); //alert(transfer_split);
			var call_transfer = transfer_split[0]; //alert(queue_id);
			var tf_queue_name = transfer_split[1];
			var queue_id = transfer_split[2];
			
			if(abc =='undefined'  || abc =='')
			{
				 $('.alert').show();
					$('.alert_content').html('Please Select Queue ..!'); 
					setTimeout(function(){$('.alert').hide();},10000); 
					return false; 
			}
                        var beneficiary_id=11111; //document.getElementById('beneficiary_ids').value; //alert(beneficiary_id);
                        var agentID = "<?=$agentID;?>"; ;
                        var phoneNumber = "<?=$phone_number;?>";
                        var leadID = "<?=$convoxID;?>"; 
                        var call_id = 111111;// document.getElementById('callidValue').value;
					   var process = "<?=$_POST['callProcess'];?>";  
                        
						var call_hit_referenceno = "<?=$call_hit_referenceno;?>";
                        var queue_name = "<?=$_POST[queue_name];?>"; 
                        var call_status = "<?=$_POST[call_status];?>";
                        var transfer_type = "PROCESS";
						
						
						
						if(queue_id ==120)
							var transfer_tos = "MO_104";
                        else
							var transfer_tos = "CO_104";
						
						var callQuery='';
						
//var transfer_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=TRANSFER&convoxid="+leadID+"&agent_id="+agentID+"&disposition=TRANSFERED_CALL&type=PROCESS&transfer_to_queue="+tf_queue_name+"&call_id=&beneficiary_id="+beneficiary_id;						
						
                        if(call_status == 'WRAPUP')
                        {
                                document.getElementById('call_transfer').disabled=true;
                                alert("You Cannot Tranfer the Call in WRAPUP MODE");
                        }               
                        else
                        {
                                
							callQuery+="&ACTION=TRANSFER&agent_id="+agentID+"&phone_number="+phoneNumber+"&process="+process+"&call_id="+call_id+"&leadID="+leadID+"&call_hit_referenceno="+call_hit_referenceno;
							//alert(callQuery);//return false;
							xmlHttp.open("POST","callcontrol_transfer.php",true);
							xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlHttp.send(callQuery);
							xmlHttp.onreadystatechange=function()
							{
									if (xmlHttp.readyState==4 && xmlHttp.status==200)
									{
											var Response = xmlHttp.responseText;
											//alert(Response);
											if(ACTION == "TRANSFER")
											{
												alert("Call Tranfer Successfully");
var transfer_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=TRANSFER&convoxid="+leadID+"&agent_id="+agentID+"&disposition=TRANSFERED_CALL&type=PROCESS&transfer_to_process="+transfer_tos+"&call_id="+call_id+"&beneficiary_id="+beneficiary_id;
													//alert(transfer_url);//return false;
													postURL(transfer_url,"false");          
											}
									}
							}
                        }
                }
                delete xmlHttp;
        }

    //function pageLoad() {
    //    document.getElementById('panelDiv').style.visibility = 'hidden';
    //}
    //$(document).ready(function()
    //{
    //    $('#<%= btnCounsellingGuide.ClientID %>').click(function () { $('#panelDiv').show(); });
    //    $('#<%= btnCounsellingGuide.ClientID %>').click(function () { $('#panelDiv').hide(); });

    //});
    function VisiblePanel() {


        var x = document.getElementById('panelDiv').style.visibility = 'visible';


    }

 
    newHttpObject = function()
    {
        var xmlHttp=null;
        try
        {
            // Firefox, Opera 8.0+, Safari
            xmlHttp=new XMLHttpRequest();
        }
        catch(e)
        {
            // Internet Explorer
            try
            {
                xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e)
            {
                xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        return xmlHttp;
    }
     function SaveInformationDirectory(sub_directory,District)
     {
        var xmlHttp=newHttpObject();

        if(xmlHttp)
         {
            var call_id 	   = 123; //document.getElementById('callid').innerHTML;
            var DistrictID	   = document.getElementById('District').value;
            var SubDirectoryID = document.getElementById('sub_directory').value;
            var subSubDirectoryID = document.getElementById('cat_sub_directory').value;

            var callQuery = "action=SEARCHHOSPITAL&sub_directory_id="+SubDirectoryID+"&subSubDirectoryID="+subSubDirectoryID+"&district_id="+DistrictID+"&call_id="+call_id;
            //alert(callQuery);
            xmlHttp.open("POST","get_medical_details.php",true);
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send(callQuery);
            xmlHttp.onreadystatechange=function()
             {
                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                 {
                    var Response = null;
                    Response = xmlHttp.responseText;
                    //alert(Response);
                         document.getElementById("hospitals_list").innerHTML=Response;

                 }
             }
         }
        delete xmlHttp;
     }
	 
	  function saveGovtDetails(clickedElement)
         {
                var xmlHttp=newHttpObject();
                
                if(xmlHttp)
                 {
                    	//var URL = 'CounselingGuidlines/'+clickedElement+'.pdf';
                    	var URL = 'CounselingGuidlines/'+clickedElement;
						 window.open(URL,'winname','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,resizable=no,width=800,height=800');
						 return false;
						 var callQuery="type=SaveGrievance&agent_id=<?=$_REQUEST["agentid"];?>&contact_no=<?=$_REQUEST["callernumber"];?>&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&aadhar_no="+aadhar_no+"&source="+source+"&date="+date+"&grievance_type="+grievance_type+"&nature="+nature+"&name="+name+"&mobile1="+mobile1+"&mobile2="+mobile2+"&email="+email+"&area="+area+"&state="+state+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&branch="+branch+"&residential_address="+residential_address+"&brief_application="+brief_application;
                        //alert(callQuery); 
						return false;
                        xmlHttp.open("POST","save_Grievance_Details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
                                        var Response = null;
                                        Response = xmlHttp.responseText;
                                        //alert(Response);
                                 }
                         }

                 }
                delete xmlHttp; 
         }


function myFunction() { //alert(55);
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}		 
</script>
<link href="bootstrap.min.css" rel="stylesheet" />
 

 
    <div class="row">
		<div class="col-md-3" >
			   <div class="span3">
                    <div class="sidebar">            

                        <ul class="widget widget-menu unstyled">
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Incident Id : <span id="callid"></span>
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Caller Name : <span id="cName"> ----  </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Caller PhoneNo : <?=$phone_number;?>
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Age : <span id="cAge"> ----  </span> 
                                </span>
                            </li>
                             
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    District: <span id="cDistrict"> ----  </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Taluka: <span id="cTaluka"> ----  </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Village: <span id="cVillage"> ----  </span> 
                                </span>
                            </li>
							<li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Pregency : <span id="cPregency"> NO  </span> 
                                </span>
                            </li>
                        </ul>
                    
					
						 <ul class="widget widget-menu unstyled" >
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Medical Sympton   : <span id=""> Back Pain</span>
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                     Complaint : <span id="cName"> test  </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                     Basic Ailment  	 :test
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Advice  : <span id="cAge"> Test  </span> 
                                </span>
                            </li> 
							
							 <li style="line-height:44px;background-color:#2d2b32;color:white;">
							 
								<label class="control-label" for="basicinput">Transfer Group 
									<select name="call_transfer" id="call_transfer"  data-placeholder="Select here.." class="span12">
									  <option value="">Select here..</option>  
									  <?php
										$call_transfer_Q = "SELECT transfer_to,transfer_value,transfer_queue_name,transfer_queue_id FROM m_call_transfer WHERE transfer_queue_name NOT IN ('$_POST[queue_name]') and call_transfer_id<>3 AND active='Y';";
										$call_transfer_rslt = mysql_query($call_transfer_Q);
										while($call_transfer_details = mysql_fetch_array($call_transfer_rslt))
										{
											echo "<option value='".$call_transfer_details["transfer_value"]."~".$call_transfer_details["transfer_queue_name"]."~".$call_transfer_details["transfer_queue_id"]."'>".$call_transfer_details["transfer_to"]."</option>";
										}
									   ?>
									</select></label>
							</li>
						<li style="line-height:44px;background-color:#2d2b32;color:white;">
							 <button type="button"  onclick="transfer_to_queue('TRANSFER');" id="TransferP" class="btn btn-large btn-primary">Transfer</button>
							 </li>
                        </ul>
					
					
					</div>
                </div>             
			</div>
		
		
        <div class="col-md-8" style="background: radial-gradient(ellipse farthest-corner at center center, rgba(0,0,0,0.5) 20%, rgba(0,0,0,0.85) 100%) repeat scroll 0% 0%; ">
            <div class="form-group">
                <fieldset>
                    <legend>
                        <button type="button" class="btn btn-info ribbon">Counselling</button>
                    </legend>
                    <table cellpadding="2" id="not104fever" cellspacing="2" width="100%" style="border: 0px solid #fff">
                        <tr>
                            <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;">Marital Status :</td>
                            <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                <select id='sub_directory' name='sub_directory'  class="form-control">
                                    <option value=''>Select MedicalStatus</option>
                                    <?php        $i=0;
                                                     $stmtVILL="SELECT `maritalstatus_id`,`maritalstatus_name` FROM `m_marital_status`;";
                                                     $resultVILL=mysql_query($stmtVILL);
                                                     while($row=mysql_fetch_array($resultVILL))
                                                     {$i++;?>
                                    <option value='<?php echo $row["maritalstatus_id"];?>'><?php echo $row["maritalstatus_name"];?></option>
                                    <?php }  ?>
                                </select>
                            </td>
                            <td colspan="2" rowspan="4">
                                <div align="center" id="panelDiv">
                                    <!--style="visibility:hidden"-->
                                    <div class="panel panel-primary" style="border:0px solid white;">

                                        <div class="panel-body" style="margin-top:3px;">
                                            <input style="text-align: center;width: 260px;height: 40px;" type="text" name="Search"  class="form-control" style="width:400px;" id="searchInput" onkeyup="myFunction()" value="" placeholder="COUNSELLING GUIDELINES" />
                                            

                                            <table id="tblSearch" align="center" 
											style=" border: 1px solid white;background-color:#ccc;">
                                                <tr>
                                                    <td>
                                                        <div style="max-height:210px;overflow-y:scroll">
                                                            <table style="width:100%" id="myTable">
                                                               
													<?php      
                                                     $stmtVILL="SELECT `mi_Shortdesc_Eng`,`mi_DocPath_Eng` FROM `counseling_guidelines` where mi_IsActive=1 ORDER BY `mi_Shortdesc_Eng` ASC;";
                                                     $resultVILL=mysql_query($stmtVILL);
                                                     while($row=mysql_fetch_array($resultVILL))
                                                     { ?> 
															   <tr >
                                                                    <td>
                                                                        <input type="checkbox" id="chkSmolking" />
                                                                    </td>
                                                                    <td style="color:black;">
                                                                        <label id="lblSmoking" ><?php echo $row['mi_Shortdesc_Eng'];?></label>
                                                                    </td>
                                                                    <td>
                                                                        <input onclick="return saveGovtDetails('<?php echo $row['mi_DocPath_Eng'];?>');" type="button" id="btnSmoking" class="btn btn-warning" align="center" value="View" style="width: 60px;color:white;background-color: green;float:right; cursor:pointer">
                                                                    </td>
                                                                </tr>
													 <?php }?>         
																 
																 
																 
                                                            </table>
                                                        </div>
                                                    </td>

                                                </tr>

                                            </table>
                                            <!--<table>
                                                <tr>
                                                    <td>
                                                        <label id="lblchecktext" style="color: white;">Alcohol</label>
                                                    </td>
                                                </tr>
                                            </table>-->

                                        </div>
                                        <div class="panel-footer">

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;"><br />Past Psychiatric History :</td>
                            <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                <br /><input type="radio" name="Desc" value="1"  checked><span style="color: white">Yes</span>
                                <input type="radio" name="Desc" value="2"><span style="color: white">No</span>
                            </td>

                        </tr>
                        <tr>
                            <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;"><br />Severity :</td>
                            <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                <br /><select id='cat_sub_directory' name='cat_sub_directory' class="form-control">
                                    <option value=''>Select Severity</option>
                                    <option value=''>High</option>
                                    <option value=''>Medium</option>
                                    <option value=''>Low</option>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;">Medication :</td>
                            <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                
                                <input type="radio" name="Med" value="1" onclick="document.getElementById('ddlMedication').style.display='block'" ><span style="color: white">Yes</span>
                                <input type="radio" name="Med" value="2" onclick="document.getElementById('ddlMedication').style.display='none'" checked>  <span style="color: white">No</span>
                                <select id='ddlMedication' name='Medication' class="form-control" style="display:none">
                                    <option value=''>Select Medication</option>
 <option value=''>Less Than 1 Year </option>                                   
								   <option value=''>1 Year</option>
                                    <option value=''>2 Year</option>
                                    <option value=''>More than 2 Year</option> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"> 

                            </td>
                        </tr>
                        <tr>
                            <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;"><br />Complaint :</td>
                            <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                <textarea rows="1" cols="30" class="form-control"></textarea>
                            </td>
                            <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;"><br />Advice :</td>
                            <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                <textarea rows="1" cols="30" class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">
                                        </td>
                            <td>&nbsp;</td>
                            <td align="right"> <input type="button" class="btn btn-info" align="center" value="Save" onclick="SaveInformationDirectory(sub_directory.value,District.value);">

                   
                                <input type="button" class="btn btn-warning" align="center" value="Cancel" onclick="SaveInformationDirectory(sub_directory.value,District.value);">
                            </td>
                        </tr>

                    </table>
					
					
					<div style="color:white">
						<?php $d= mysql_fetch_array(mysql_query("select * from casefulldetails where callid='".$callid1."'"));
						
						echo $d['message'];?>
					</div>
                </fieldset>

            </div>
        </div></div></div>

    </div>
</form>


<form name="Counselling" id="fCounselling" method="POST" action="" style="display:none">
    <div id='mh' style='border:0px solid green;'>
        <div id='mhinfo' style='border:0px solid red;'>
            <table width="100%" border="0">
                <!--<tr bgcolor="#000080">-->
                <tr bgcolor="#5bc0de">
                    <th colspan="4" id="mhtitle"><font color="white" family="arial" size="6px"><center>Counselling</center></font></th>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>

                    <br />

                    <td colspan=4>

                        <table width="70%" cellspacing="1" cellpadding="1" border="0" style="border-collapse: collapse;margin-top:20px;align-content: center" align="center">
                            <tbody>
                                <tr>
                                    <td style="padding:5px">
                                        <label id="lblMaritalStatus" style="color: white">Marital Status :</label>
                                    </td>
                                    <td></td>
                                    <td style="margin-left: -170px">
                                        <label id="lblsubdirectory" style="color: white" style="margin-left: -170px">Severity :</label>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px">
                                        <label id="lbldistrictspan" style="color: white">Past Medical History :</label>
                                    </td>
                                    <td>
                                        <!--<span id="district_span" name="district_span" style="margin-left: -7px">-->
                                        <!--<select id='District' name='District' onchange='GetRegions1(this.value,"1");'>
                                            <option value=''>Select History</option>
                                            <?php
                                                mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8',
                                                character_set_database = 'utf8', character_set_server = 'utf8'");
                                                $district_query	= "SELECT ds_dsid,ds_lname,districtname FROM m_district WHERE is_active=1 ORDER BY districtname ASC;";
                                                $district_result= mysql_query($district_query);
                                                while($district_details = mysql_fetch_array($district_result))
                                                {
                                                $SEL = ($Beneficiary_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
                                                echo "
                                            <option value='".$district_details["ds_dsid"]."~".$district_details["districtname"]."'>".$district_details["districtname"]."</option>";
                                            }
                                            ?>
                                        </select>-->
                                        <input type="radio" name="Desc" value="1" checked><span style="color: white">Yes</span>
                                        <input type="radio" name="Desc" value="2"><span style="color: white">No</span>

                                        <!--</span>-->
                                    </td>

                                    <td>
                                        <label id="lblTaluka" style="color: white" style="margin-left: -10px">Medication :</label>

                                    </td>



                                    <td align='nowrap' style="font-family:arial;font-size:15px;color:black;">
                                        <!--<select style="font-family:arial;font-size:15px;color:black;margin-left: -100px" id='tehsil1' name='tehsil1' onchange='GetRegions1(this.value,"2");' class="col-md-10">

                                            <?php
                                                $SEL = ($Beneficiary_Details['Taluka_ID'])?"selected":"";
                                                echo  ($Beneficiary_Details['Taluka_ID'])?"
                                            <option value='".$Beneficiary_Details[' Taluka_ID']."~".$Beneficiary_Details['Taluka_Name']."'$SEL>".$Beneficiary_Details['Taluka_Name']."</option>":"
                                            <option value=''>--Pickup Taluka--</option>";
                                            ?>
                                        </select>-->

                                    </td>
                                    <td></td>
                                </tr>





                                <!--			<td><input type="button" class="btn btn-warning" value="Seach" onclick="GetHospitalsList(sub_directory.value,District.value);" ></td>-->



                            </tbody>
                        </table>
                        <div align="left">

                        </div>
                        <br />
                        <hr />
                        <table width="70%" cellspacing="1" cellpadding="1" border="0" style="border-collapse: collapse;margin-top:20px;align-content: center" align="center">
                            <tr>

                                <label id="txtComplaint" style="color: white;margin-left: 200px">Complaint :</label>
                                <td>
                                    <textarea rows="3" cols="30" style="margin-top :-40px;margin-left: 100px;"></textarea>
                                </td>
                                <label id="txtAdvice" style="color: white;margin-left:420px">Advice :</label>
                                <td>
                                    <textarea rows="3" cols="30" style="margin-top :-40px;margin-left: 120px;"></textarea>
                                </td>
                            </tr>

                        </table>

                        <div align="center">

                        </div>
                        <hr />


                        <div id="hospitals_list">
                        </div>



        </div>


    </div>


</form>


