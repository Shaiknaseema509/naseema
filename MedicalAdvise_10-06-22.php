
<?php  error_reporting(0);
require_once("dbconnect_emri.php");


$callid = $_REQUEST['callid'];


$phone_number         = $_REQUEST["callernumber"];
$Queue 	              = $_REQUEST["Queue"];
$agent_id 	      = $_REQUEST["agentid"];
$agentID 	      = $_REQUEST["agentid"];
$call_hit_referenceno = $_REQUEST["CallReferenceID"];
$service_id           = $_REQUEST["DID"];
$call_date            = $_REQUEST["CallDate"];
$call_time            = $_REQUEST["CallTime"];
$transfer_callid      = $_REQUEST["CallID"];
$callids      = $_REQUEST["callid"];
$convoxID      = $_REQUEST["convoxID"];
$beneficiary_id	      = $_REQUEST["BeneficiaryID"];

if($callid =='') $callid=20190000108063;
 
mysql_set_charset('utf8'); 

 ?>

 
 <link href="css/bootstrap.min.css" rel="stylesheet" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="scripts/main_validation.js"></script>
<title> Medical </title>
<style>
[class*="span"]
{margin-left:0px !important}
</style>

<script type="text/javascript">
   
function SaveInformationDirectoryMedical(sub_directory)
	 {
		var xmlHttp=newHttpObject(); 
		
		if(xmlHttp)
		 {
			var call_id 	   = document.getElementById('callid').innerHTML;  
			
			var complaint = document.getElementById('complaint').value;
			var advice = document.getElementById('advice').value;
			var bskpoint = document.getElementById('bskpoint').value;
			var remarks = document.getElementById('remarks').value;
			
			
			var output = jQuery.map($(':checkbox[name=chkSmolking\\[\\]]:checked'), function (n, i) {
				return n.value;
			}).join(',');
			
			var callQuery = "type=SAVEMEDICAL&complaint="+complaint+"&remarks="+remarks+"&advice="+advice+"&outputs="+output+"&call_id="+call_id+"&bskpoint="+bskpoint+"&agent_id=<?=$agentID;?>";
			//alert(callQuery);
			xmlHttp.open("POST","getMedicaladvicequestions.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText; 
						// $('#idmdn').hide();
					var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
								 
									postURL(end_call_url,"false");	
						

			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 
	 function Savedrugdetails()
	 {
		 if ($('.dosageData').length<=0){
			  alert("Please Select any Drug Info");
			 return;
		 }
		 
		 
		 var diagnosis = document.getElementById('diagnosis').value;
         if(diagnosis ==""){
			 alert("Please Field The Diagnosis Remarks");
			 return;
		 }
		 
		 
		var xmlHttp=newHttpObject(); 
		
		if(xmlHttp)
		 {
			var call_id = document.getElementById('callid').innerHTML;  
			var diagnosisDesc = document.getElementById('diagnosis').value;  
			
			//var complaint = document.getElementById('complaint').value;
			//var advice = document.getElementById('advice').value;
			///var bskpoint = document.getElementById('bskpoint').value;
			//var remarks = document.getElementById('remarks').value;
			var numItems = $('.dosageData').length;
		
			var callQuery1='abc';//alert(44); 
			var callQuery = "type=SAVEMEDICALDOSAGES&call_id="+call_id+"&countUsage="+numItems+"&remarks="+diagnosisDesc+"&agent_id=<?=$agentID;?>";
			$(".dosageData").each(function() {
				  var gType = $(this).data('type');
				  var gId = $(this).data('id');
				 //alert(gType);
				 if(gType == 'dosage')
				 { 
					 var desc = $('#description_dosage_remarks_'+gId).val();
					 callQuery1 +='&groupType[]=dosage&description[]='+desc+'&gId[]='+gId;
				 }
				 else 
				 { 
					 var desc = $('#description_dosagemhu_remarks_'+gId).val();
					 callQuery1 +='&groupType[]=dosagemhu&description[]='+desc+'&gId[]='+gId; 
				 }
				 	
			});
			 
			callQuery +="&data="+callQuery1;
			
			
			xmlHttp.open("POST","getMedicaladvicequestions.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText; 
					console.log("====>>>>",);
						// $('#idmdn').hide();
						if(xmlHttp.status==200){
						
							alert("Sucessfully Done ..!");
							
							 $('#ddud').empty();
							 $('#diagnosis').val('');
							 //$('.custm_drug').val('');
							  //$('.custm_drug').empty();
							  //$('.alldrugs').val('');
							  //$('.alldrugs').empty();
							 var modal = document.getElementById('myModal');
							 modal.style.display = "none";
						
						}else{
							alert("Something went wrong ..!");
						}
						
						return false;
					var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
								 
									postURL(end_call_url,"false");	
									
					
						

			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 
    function VisiblePanel() 
	{ 
        var x = document.getElementById('panelDiv').style.visibility = 'visible';
    }
	
function conCall()
{
	 
    openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php","Conference_Call","width=420,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");                            
    //openWindowpostURL("http://<?=$host_ip;?>/ConVox3.0/Agent/control_panel.php?callid="+callid+"&vehicle_phone_number="+vehicle_phone_number,"Conference_Call","width=380,height=486,left = 1000,top = 170,scrollbars=1,location=0, resizable=yes,dependant=yes,dialog=yes,modal=yes, unadorned=yes,status=0");
	return false;
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
	  function saveGovtDetails(clickedElement,b)
         {
                var xmlHttp=newHttpObject();
                
                if(xmlHttp)
                 {
                    	//var URL = 'DiseaseSummary/English/'+clickedElement+'.pdf';
                    	 var bb= $('#'+b).val();
                    	//var URL = 'DiseaseSummary/English/'+clickedElement+'.pdf';
                    	var URL = 'DiseaseSummary/'+bb;
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

function GetRegions123(ID)
{
	var IDTEXT = $('#sub_directory option:selected').text();
	var IDVALUE = $('#sub_directory option:selected').val();
	$('#rolesym').html(IDTEXT);
	var call_id =  document.getElementById('callidValue').value;
	var xmlHttp=newHttpObject();
      //alert(3);          
	if(xmlHttp)
	 {
			 $('.btnvalue').val(''); 
		 var callQuery="type=SaveGrievance&ID="+IDVALUE+"&call_id="+call_id+"&cat="+IDVALUE+"&catvalue="+IDTEXT; 
		xmlHttp.open("POST","getMedicaladvicequestions.php",true);
		xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlHttp.send(callQuery);
		xmlHttp.onreadystatechange=function()
		 {
			if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 {
				var Response = null;
				Response = xmlHttp.responseText; 
				$('#ques').html(Response);
			 }
		 }
	 }
	delete xmlHttp; 
}
function GetRegions1234(ID,ANS)
{
	var xmlHttp=newHttpObject();                
	if(xmlHttp)
	 {			 
		var call_id =  document.getElementById('callidValue').value;
		var IDVALUE = $('#sub_directory option:selected').val();
		 var callQuery="type=getQuestions&ID="+ID+"&result="+ANS+"&call_id="+call_id+"&cat="+IDVALUE; 
		xmlHttp.open("POST","getMedicaladvicequestions.php",true);
		xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlHttp.send(callQuery);
		xmlHttp.onreadystatechange=function()
		 {
			if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 {
				 $('.btnvalue').val('');
				var Response = null;
				Response = xmlHttp.responseText; 
				if(Response !='' ) $('#ques').html(Response);
			 }
		 }
	 }
	delete xmlHttp; 
}

function GetRegions12345(ID,ANS)
{
	var call_id =  document.getElementById('callidValue').value;
	var IDVALUE = $('#sub_directory option:selected').val();
	var xmlHttp=newHttpObject();                
	if(xmlHttp)
	 {			 
		 var callQuery="type=getQuestionsYES&ID="+ID+"&result="+ANS+"&call_id="+call_id+"&cat="+IDVALUE; 
		xmlHttp.open("POST","getMedicaladvicequestions.php",true);
		xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlHttp.send(callQuery);
		xmlHttp.onreadystatechange=function()
		 {
			if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 {
				var Response = null;
				Response = xmlHttp.responseText; 
				$('#abcd').html(Response);
			 }
		 }
	 }
	delete xmlHttp; 
}

function dosageDelete(a,b)
{
	$('#description_'+a+'_'+b).html('');
}

</script>	 


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
  
	<h2 align="center"> Prescription <div style="float:right" align="right" float="right">  <span class="close" onclick="return closePopup();">&times;</span> </div></h2>
   
	<div class="row" style="background-color:">
		<div class=" col-md-4" style="float:left; width:20%"> 
		<table cellpadding="3" cellspacing="3" class="table-responsive"  >
			<tr>
            <div style="padding-bottom:15px">
                <input type="radio" id="custm_drug" name="custmgeneral" value="custmgeneral" checked> <span>General Drug</span>
                <input type="radio" id="custm_MHU" name="custmgeneral" value="custmgeneral"> <span>MHU Drug</span>
            </div>
				<td>
				<div class="custm_drug">
				<select name="GroupId" id="GroupId" onchange="return showHidedrugs(this.value);" style="width: 100%;">
					<option value="">Select General Drug</option>
					 <?php       
					 $stmtVILL="SELECT `GroupId`,`GroupName` FROM `druggroups` where GroupType=1 ORDER BY GroupName ASC;";
					 $resultVILL=mysql_query($stmtVILL);
					 while($row=mysql_fetch_array($resultVILL))
					 {?>
						<option value='<?php echo $row["GroupId"];?>'><?php echo $row["GroupName"];?></option>
					<?php }  ?>	
				</select>
				</div>
                <div class="custm_MHU">
				<select name="GroupId_MHU" id="GroupId_MHU" onchange="return showHidedrugs_mhu(this.value); " style="width: 80%;">
					<option value="">Select MHU Drug</option>
					 <?php       
					 $stmtVILL="SELECT `GroupId`,`GroupName` FROM `druggroups` where GroupType=2 ORDER BY GroupName ASC;";
					 $resultVILL=mysql_query($stmtVILL);
					 while($row=mysql_fetch_array($resultVILL))
					 {?>
						<option value='<?php echo $row["GroupId"];?>'><?php echo $row["GroupName"];?></option>
					<?php }  ?>	
				</select>
				</div>
				
				</td>
			</tr>
			 <?php       
				 $stmtVILL="SELECT `DrugId`,`DrugName`,GroupId FROM `drugdetailsnew` ORDER BY DrugName ASC;";
				 $resultVILL=mysql_query($stmtVILL);
				 //echo $resultVILL;
				 while($row=mysql_fetch_array($resultVILL))
				 {?>
				<tr class="alldrugs_main alldrugs <?php echo $row["GroupId"];?>" style="display:none">
					<td>
						<input type="hidden" id="anv_<?php echo $row["DrugId"];?>" value='<?php echo $row["DrugName"];?>' />
							<a href="javascript:void(0);" id="anvRet_<?php echo $row["DrugId"];?>" onclick="return showDose(<?php echo $row["DrugId"];?>);"> <?php echo $row["DrugName"];?></a>
					</td>
				</tr>
		<?php }  ?>	
		
		<?php       
				 $stmtVILL="SELECT `DrugId`,`DrugName`,GroupId FROM `drugdetailsnewmhu` ORDER BY DrugName ASC;";
				 $resultVILL=mysql_query($stmtVILL);
				 while($row=mysql_fetch_array($resultVILL))
				 {?>
				<tr class="alldrugs_mhu_main alldrugs_mhu <?php echo $row["GroupId"];?>" style="display:none">
					<td>
						<input type="hidden" id="anv_mhu<?php echo $row["DrugId"];?>" value='<?php echo $row["DrugName"];?>' />
							<a href="javascript:void(0);" id="anvRet_mhu<?php echo $row["DrugId"];?>" onclick="return MHUDrug(<?php echo $row["DrugId"];?>);"> <?php echo $row["DrugName"];?></a>
					</td>
				</tr>
		<?php }  ?>
		</table>
		</div>
		
		<div class=" col-md-8" > 
			<table cellpadding="3" class="table" cellspacing="3" >
				<thead class="thead-dark">
				<tr>
					<th style="width:40%">Drug Name </th>
					<th width="25%">Dosage  </th>
					<th width="25%">Age  </th>
					<!-- <td width="25%">Days </td>-->
					<th width="25%">Group Type </th>
					<th width="25%">Description </th>
					<th width="25%">Options </th>
				</tr>
				</thead>
				<tbody id="ddud">
				</tbody>
				
				<tr>
					<td colspan="3" style="padding-top:25px">
						Provisional Diagnosis <textarea id="diagnosis"></textarea>
					</td>
				</tr>	

				<tr>
					<td><input type="checkbox" value="SMS"  /> SMS</td> 
					<td colspan="4" align="right">
					
						<input type="button" value="Submit" class="btn btn-success  btn-sm custm_btn_ancortag" onclick="Savedrugdetails();" style="cursor: pointer;"/>
					</td>
				</tr>	
				
			</table>	
		</div>
	</div>
</div>
</div>


    <div class="row">
<div class="col-md-3" >
			   <div class="span3">
                    <div class="sidebar">            

					
<?php $rdata = mysql_fetch_array(mysql_query("SELECT `benificiery_surname`,`beneficiary_last`,`call_id`,`beneficiary_name`,`age`,`Gender`,`district_name`,`block_name`,`village_name` FROM `registration` WHERE `call_id`='".$callids."'"));?>					
					
                          <ul class="widget widget-menu unstyled">
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Incident Id : <span id="callid"><?php echo $callid;?></span>
									<input type="hidden" value="<?php echo $callid;?>" id="callidValue" />
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Caller Name : <span id="cName"> <?php echo $rdata['benificiery_surname'];?><?php echo $rdata['beneficiary_name'];?><?php echo $rdata['beneficiary_last'];?>  </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Caller PhoneNo : <?=$phone_number;?>
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Age : <span id="cAge">  <?php echo $rdata['age'];?>  </span> 
                                </span>
                            </li>
                             
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    District: <span id="cDistrict">  <?php echo $rdata['district_name'];?>  </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Taluka: <span id="cTaluka">  <?php echo $rdata['block_name'];?>  </span> 
                                </span>
                            </li>
                            <li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Village: <span id="cVillage">  <?php echo $rdata['village_name'];?>  </span> 
                                </span>
                            </li>
							<li style="line-height:44px;background-color:#2d2b32;color:white;">
                                <span style="margin-left:20px;">
                                    Pregency : <span id="cPregency">  No<?php //echo $rdata['beneficiary_name'];?>  </span> 
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
                                   Basic Ailment 	 :test
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
										$call_transfer_Q = "SELECT transfer_to,transfer_value,transfer_queue_name,transfer_queue_id FROM m_call_transfer WHERE transfer_queue_name NOT IN ('$_POST[queue_name]') and call_transfer_id<>1  AND active='Y';";
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
      
    <form>
        <div class="container" >
            <div class="col-md-12" style="background: radial-gradient(ellipse farthest-corner at center center, rgba(0,0,0,0.5) 20%, rgba(0,0,0,0.85) 100%) repeat scroll 0% 0%; ">
                <div class="form-group">
                    <fieldset>
                        <legend>
                            <button type="button" class="btn btn-info ribbon">Medical Advice</button>
                        </legend>
                        <table cellpadding="2" id="not104fever" cellspacing="2" width="100%" style="border: 0px solid #fff;margin-top:20px;">
                            <tr>
                                <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;">Sympton :</td>
                                <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                    <select id='sub_directory' name='sub_directory' onchange='GetRegions123(this.value);' class="form-control">
                                        <option value=''>Select Sympton</option>
										 <?php       
											 $stmtVILL="SELECT `scat_scatID`,`scat_Name_Eng` FROM `prtsubcategory` WHERE `scat_catId` =3 ORDER BY scat_Name_Eng ASC;";
											 $resultVILL=mysql_query($stmtVILL);
											 while($row=mysql_fetch_array($resultVILL))
											 {?>
												<option value='<?php echo $row["scat_scatID"];?>'><?php echo $row["scat_Name_Eng"];?></option>
											<?php }  ?>	
                                    </select>
                                </td>
                                <td colspan="2" rowspan="4">
                                    <div align="center" id="panelDiv">
                                        <!--style="visibility:hidden"-->
                                        <div class="panel panel-primary" style="border:0px solid white;">
                                            <div class="panel-body" style="margin-top:-55px;">
<input type="text" name="Search" id="searchInput" onkeyup="myFunction()" class="form-control" style="text-align: center;width: 260px;height: 40px;"  placeholder="DISEASE SUMMURIES" />
                                               

                                                <table id="tblSearch" align="center" 
												style="border: 1px solid white;background-color:#ccc;">
                                                    <tr>
                                                        <td>
                                                          <div style="max-height:300px;overflow-y:scroll">
                                                                <table style="width:100%" id="myTable"> 
<?php      mysql_query('SET character_set_results=utf8');
                                                     $stmtVILL="SELECT  `mi_Shortdesc_Eng`,`mi_miID`,`mi_DocPath_Eng`,mi_DocPath_Tel,mi_Title_hin FROM `prtmoreinfo`
													 WHERE `mi_IsActive`=1 ORDER BY mi_Shortdesc_Eng ASC;";
                                                     $resultVILL=mysql_query($stmtVILL); $i=1;
                                                     while($row=mysql_fetch_array($resultVILL))
                                                     { ?>  
																  <tr>
                                                                        <td>
                                                                            <input type="checkbox" name="chkSmolking[]" value="<?php echo $row['mi_miID'];?>" id="chkSmolking" />
                                                                        </td>
                                                                        <td style="color:black;">
                                                                            <a href="#"> <label id="lblSmoking"><?php echo $row['mi_Shortdesc_Eng'].' - '.$row['mi_Title_hin'];?></label></a>
                                                                        </td>
                                                                        <td>
                                                                       <input type="hidden" value="<?php echo $row['mi_DocPath_Tel'];?>" id="abcd_<?php echo $i;?>" />
                                                                            <input style="cursor:pointer" type="button" onclick="return saveGovtDetails('<?php echo $row['mi_DocPath_Tel'];?>','abcd_<?php echo $i;?>');" id="btnSmoking" class="btn btn-warning" align="center" value="View" style="width: 60px;color:white;background-color: green;float:right">
                                                                        </td>
                                                                    </tr>
                                                                     <?php $i++; }?>  
                                                                </table>
                                                            </div>
                                                        </td>

                                                    </tr>
													
                                                </table> 
                                            </div>
                                            <div class="panel-footer">

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:arial;font-size:15px;color:#ffffff;" colspan="2">
                                    <br />
                                    <div style="border: 1px solid white;" id="ques">
                                         
                                    </div>
                                </td>
                            </tr>
                            <tr style="width:100%">
                                <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;" colspan="2">
                                   
                                    <div style="border: 1px solid white;height:125px;width:3%;float:left; display:none">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:5px;">
                                            <span id="rolesym" >sample </span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                            </button>
                                        </div>
                                        
                                    </div>

                                    <div style="border: 1px solid white;height:250px;">
                                        <table id="abcd" width="100%">
                                            <tr>
                                                <td align="right">
                                                    <textarea   name="Search" id=" " row="2" class="btnvalue form-control" placeholder="Info" ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <textarea   name="Search" id=" " row="2"  class="btnvalue form-control" placeholder="Action" ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <textarea   name="Search" id=" " row="2"  class="btnvalue form-control" placeholder="Do &" ></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr> 
                            <tr>
                                <td colspan="4"> 
                                </td>
                            </tr>
                            <tr>
                                <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;">Complaint </td>
                                <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                    <textarea id="complaint" rows="1" cols="30" class="form-control"></textarea>
                                </td>
                                <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;">Advice :</td>
                                <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                    <textarea id="advice" rows="1" cols="30" class="form-control"></textarea>
                                </td>
                            </tr>
							
							<tr>
                                <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;">Remarks </td>
                                <td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
                                    <textarea id="remarks" rows="1" cols="30" class="form-control"></textarea>
                                </td>
                                 
                            </tr>
							
                            <tr>
                               
                                      <td align='right' style="font-family:arial;font-size:15px;color:#ffffff;">Basic Ailment </td>
										<td align='nowrap' style="font-family:arial;font-size:15px;color:#ffffff;">
											<input type="text" id="bskpoint"  class="form-control" />
										</td>
                                
                                <td><button type="button" id="myBtn"> Prescription </button></td>
                                <td align="right">
<input type="button" class="btn btn-info" id="idmdn" align="center" value="Save" onclick="SaveInformationDirectoryMedical(sub_directory.value);">
<input type="button" class="btn btn-danger" id="idmdn" align="center" value="Conference" onclick="conCall();" >
                                   
								   <input style="display:none" type="button" class="btn btn-warning" align="center" value="Cancel" onclick="SaveInformationDirectoryMedical(sub_directory.value);">
                                </td>
                            </tr>

                        </table>
						
						<div style="color:white">
						<?php // $d= mysql_fetch_array(mysql_query("select * from casefulldetails where callid='".$callid."'"));
						
						//echo $d['message'];?>
					</div>
                    </fieldset>
					
					

                </div>
            </div>

        </div>
    </form>
	</div>




<style>
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold; 
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.custm_MHU{
	display:none;
}
.custm_d_none{
	display:none;
}
</style>


<script>
 var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
function closePopup()
{
	 modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
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

function showHidedrugs(a)
{
	//alert(a);
	$('.alldrugs').hide();
	$('.'+a).show();

}

function showHidedrugs_mhu(m)
{
	//alert(m);
	$('.alldrugs_mhu').hide();
	$('.'+m).show();
}

function showDose(a)
{
	 
	 var dName = $('#anv_'+a).val();
	// var anvRet = $('#anvRet_'+a).val();
		var xmlHttp=newHttpObject();
        
		if(xmlHttp)
		 {
			 
				var callQuery = "action=GetShowDose&id="+a+"&dName="+dName;
			 
			 
			xmlHttp.open("POST","getDoseData.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText; 
					$('#anvRet_'+a).attr('onclick','');
						$("#ddud").append(Response);	
					  
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 
}

function MHUDrug(m)
{
	 
	 var dName = $('#anv_mhu'+m).val();
	// var anvRet = $('#anvRet_'+a).val();
		var xmlHttp=newHttpObject();
        
		if(xmlHttp)
		 {
			 
				var callQuery = "action=GetMHUDrug&id="+m+"&dName="+dName;
			 
			 
			xmlHttp.open("POST","getDoseData.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
			 	 {
					var Response = null;
					Response = xmlHttp.responseText; 
					$('#anvRet_mhu'+m).attr('onclick','');
						$("#ddud").append(Response);	
					  
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 
}


</script>   

<script>
$(document).ready(function(){
  $("#custm_drug").click(function(){
  $(".custm_drug").show();
    $(".custm_MHU").hide(); 
	//$(".alldrugs").hide();
	//$(".alldrugs_mhu").hide();
  });
  $("#custm_MHU").click(function(){
    $(".custm_drug").hide();
    $(".custm_MHU").show();
	//$(".alldrugs").hide();
  });
});

$(document).ready(function(){
  $("#custm_drug").click(function(){
  $(".custm_d_none").hide();
  $(".custm_d_block").show();
    
  });
  $("#custm_MHU").click(function(){
	$(".custm_d_none").show();
    $(".custm_d_block").hide();
  });
});

$('#custm_MHU').change(function (){
	$('.alldrugs_main').hide();
});

$('#custm_drug').change(function (){
	$('.alldrugs_mhu_main').hide();
});

</script>
</body>


</html>
