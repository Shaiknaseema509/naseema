
<?php  error_reporting(0);


require_once("dbconnect_emri.php"); ?>

 
 <link href="css/bootstrap.min.css" rel="stylesheet" />

<script src="scripts/main_validation.js"></script>

<style>
[class*="span3"]
{margin-left:0px !important}

                .span3 .sidebar ul li{
					background-color:#248aaf !important;
					color: #fff !important;
					font-weight:600 !important;
					height:38.6px;
					font-size: 14px !important;
				}
                .span3 .sidebar .widget-menu > li > a {
                    background-color: #248aaf;
                    color: #fff !important;
					font-weight:600 !important;	
					padding: 7px !important;
					font-size: 14px !important;
                }

				.custm_call_closer{
					background-color:#248aaf;
					border:1px solid #248aaf;
				}
				.custm_call_closer h3{
					font-size: 16px;
					font-weight: 500;
					color: #fff;
				}
				.custm_input_border{
					border: 1px solid #9b9898 !important;
				}
				.custm_input_element{
					border: 1px solid #9b9898 !important;
					padding: 18px 10px !important;
					margin-top: 12px;
				}
				.custm_padng_left{
					padding-left:13px;
				}
				.custm_padng_right{
					padding-right:12px;
				}
				.custm_margn_l_r{
					margin: 0px 10px;
				}
</style>

<script type="text/javascript">
  
    function VisiblePanel() 
	{ 
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
	  function saveGovtDetails(clickedElement,b)
         {
                var xmlHttp=newHttpObject();
                
                if(xmlHttp)
                 {
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



</script>	 
<div class="row">
    
        <div class="container" style="max-height:400px; overflow-y:scroll">
            <div style="background: radial-gradient(ellipse farthest-corner at center center) repeat scroll 0% 0%;background-color:#e1dfdf;border: 1px solid #eedcdc; ">
                <form>
				<div class="form-group" style="margin-bottom:0px !important">
				
                    <fieldset>
                        <legend>
                            <!--<button type="button" class="btn btn-info ribbon">Medical Advice</button>-->
							<div class="module-head custm_call_closer">
                                <h3>Medical Advice</h3>
                            </div>
                        </legend>
                        <table cellpadding="2" id="not104fever" cellspacing="2" width="100%" style="border: 0px solid #fff;">
                            <tr>
                                <td style="width:12%;" class="custm_padng_left">Symptoms :</td>
                                <td style="width:30%" class="custm_padng_right">
                                    <select id='sub_directory' name='sub_directory' onchange='GetRegions123(this.value);' class="form-control custm_input_border">
                                        <option value=''>Select Symptoms</option>
										 <?php       
										 mysql_query('SET character_set_results=utf8');
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
                                        <div class="panel panel-primary" style="border:0px solid white;margin:0px 15px 0px 0px"">

                                            <div class="panel-body" style="margin-top:0px;">
<input type="text" name="Search" id="searchInput" onkeyup="myFunction()" class="form-control custm_input_border" style="text-align: center;width:50%;height: 40px;"  placeholder="DISEASE SUMMURIES SEARCH"/>
                                               

                                                <table id="tblSearch" align="center" 
												style="border: 1px solid #9b9898 ;background-color:#e8f3f7;width:100%">
                                                    <tr>
                                                        <td>
                                                          <div style="max-height:300px;overflow-y:scroll">
                                                                <table style="width:100%" id="myTable"> 
<?php      mysql_query('SET character_set_results=utf8');
                                                     $stmtVILL="SELECT  `mi_Shortdesc_Eng`,`mi_miID`,`mi_DocPath_Eng`,mi_DocPath_Tel,mi_Title_hin FROM `prtmoreinfo` WHERE `mi_IsActive`=1 ORDER BY mi_Shortdesc_Eng ASC;";
                                                     $resultVILL=mysql_query($stmtVILL); $i=1;
                                                     while($row=mysql_fetch_array($resultVILL))
                                                     { ?>  
																  <tr>
                                                                        <td style="width: 30px;">
                                                                            <input type="checkbox"   name="chkSmolking[]" value="<?php echo $row['mi_miID'];?>" id="chkSmolking" />
                                                                        </td>
                                                                        <td style="color:black;">
                                                                            <a href="#"> <label id="lblSmoking" style="font-size: 15px;"><?php echo $row['mi_Shortdesc_Eng'].' - '.$row['mi_Title_hin'];?></label></a>
                                                                        </td>
                                                                        <td>
																		<input type="hidden" value="<?php echo $row['mi_DocPath_Tel'];?>" id="abcd_<?php echo $i;?>" />
                                                                            <input type="button" onclick="return saveGovtDetails('<?php echo $row['mi_DocPath_Tel'];?>','abcd_<?php echo $i;?>');" id="btnSmoking" class="btn btn-warning btn-sm" align="center" value="View" style="width: 60px;color:white;float:right">
                                                                        </td>
                                                                    </tr>
                                                                     <?php $i++;  }?>  
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
                                <td style="font-family:arial;font-size:15px;color:#000;" colspan="2">
                                    <br />
                                    <div style="border: 1px solid #9b9898;margin: 0px 10px;" id="ques">
                                         
                                    </div>
                                </td>
                            </tr>
                            <tr style="width:100%">
                                <td align='right' style="font-family:arial;font-size:15px;color:#000;" colspan="2">
                                   
                                    <div style="border: 1px solid white;height:125px;width:3%;float:left; display:none">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:5px;">
                                            <span id="rolesym" >sample </span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                            </button>
                                        </div>
                                        
                                    </div>

                                    <div style="border: 1px solid #9b9898;height:250px;" class="custm_margn_l_r">
                                        <table id="abcd" width="100%">
                                            <tr>
                                                <td align="right">
                                                    <textarea   name="Search" id=" " row="2" class="btnvalue form-control custm_input_border" placeholder="Info" ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <textarea   name="Search" id=" " row="2"  class="btnvalue form-control custm_input_border" placeholder="Action" ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <textarea   name="Search" id=" " row="2"  class="btnvalue form-control custm_input_border" placeholder="Do &" ></textarea>
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
                                <td class="custm_padng_left">Complaint </td>
                                <td align='nowrap' class="custm_padng_right">
                                    <textarea id="complaint" rows="1" cols="30" class="form-control custm_input_border"></textarea>
                                </td>
                                <td class="custm_padng_left" >Advice :</td>
                                <td align='nowrap' style="padding: 15px 15px 0px 0px;">
                                    <textarea id="advice" rows="1" cols="30" class="form-control custm_input_border"></textarea>
                                </td>
                            </tr>
                            <tr>
                               
                                      <td class="custm_padng_left" > Basic Element </td>
										<td align='nowrap'  class="custm_padng_right">
											<input type="text" id="bskpoint"  class="form-control custm_input_element" />
										</td>
                                
                                <td>&nbsp;</td>
                                <td align="right">
<input type="button" class="btn btn-info" id="idmdn" align="center" value="Save" onclick="SaveInformationDirectoryMedical(sub_directory.value);" style="margin-right: 14px;">
                                   
								   <input style="display:none" type="button" class="btn btn-warning" align="center" value="Cancel" onclick="SaveInformationDirectoryMedical(sub_directory.value);" style="margin-right: 14px;">
                                </td>
                            </tr>

                        </table>
                    </fieldset>

                </div>
				</form>
            </div>

        </div>
    </div>
   
</body>
</html>
