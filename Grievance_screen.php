<?php
require("dbconnect_emri.php");

//echo "<pre>".print_r($_REQUEST,1)."</pre>";
?>

<html>
<head>
<title> Grievance Screen</title>
<script>
	newHttpObject = function()
	{
		var xmlHttp=null;
		try
		{
			// Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest();
		}
		catch (e)
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

        function isNumberKey(evt)
        {
                var keynum = (evt.which) ? evt.which : event.keyCode;
                //if (charCode > 31 && (charCode < 48 || charCode > 57))
                var ctrlDown = evt.ctrlKey||evt.metaKey;
                if((keynum==9)||(keynum==46)||(keynum==8)||(keynum>=35 && keynum<=40) ||(ctrlDown && (keynum==86||keynum==88 ||keynum==67)))return true;
                var keychar = String.fromCharCode(keynum);
                buf="0123456789`abcdefghi";
                //alert(keychar);
                if(buf.indexOf(keychar)>=0){return true;}
                return false;
        }

        function GetRegions_Gr(ID,index)
         {
                var xmlHttp=newHttpObject();
        
                if(xmlHttp)
                 {
                        if(index == 1)
                         {
                                var callQuery = "action=Mandals&district_id="+ID;
                         }
                        else if(index == 2)
                         {
                                var callQuery = "action=Villages&mandal_id="+ID;
                         }

                        //alert(callQuery);
                        xmlHttp.open("POST","get_region.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
                                        var Response = null;
                                        Response = xmlHttp.responseText;
                                        //alert(Response);
                                        if(index == 1)
                                         {
                                                document.getElementById("tehsil_gr").innerHTML=Response;
                                                document.getElementById("city_name_gr").innerHTML="<option value=''>-- Pickup City/Village --</option>";
                                         }
                                        else if(index == 2)
                                         {
                                                document.getElementById("city_name_gr").innerHTML=Response;        
                                         }
                                 }
                         }
                 }
                delete xmlHttp; 
         }

        function showAlert()
         {
                $('.alert').show();
                $('.alert_content').html('Fields Should Not be empty');
                setTimeout(function(){$('.alert').hide();},10000); 
         }      

        function saveGrievanceDetails()
         {
                var xmlHttp=newHttpObject();
                
                if(xmlHttp)
                 {
                        var source = document.getElementById('source').value;
                        if(source == "")      
                          {
                                showAlert();
                                document.getElementById('source').focus();
                                return false;
                          }
                        
                        var date = document.getElementById('date').value;
                        if(date == "")
                         {
                                showAlert();
                                document.getElementById('date').focus();
                                return false;
                         }
                        
                        var grievance_type = "";
			if(document.getElementById("complaint").checked)
                         {
                                grievance_type = document.getElementById("complaint").value;
                         }
                        else if(document.getElementById("demand").checked)
                         {
                                grievance_type = document.getElementById('demand').value;
                         }
                        else if(document.getElementById("advice").checked)
                         {
                                grievance_type = document.getElementById('advice').value;
                         }
                        else if(document.getElementById("others").checked)
                         {
                                grievance_type = document.getElementById('others').value;
                         }
                        else
                         {
                                showAlert();
                                document.getElementById('complaint').focus();
                                return false;
                         }
        
                        var nature = "";
                        if(document.getElementById("tatkal").checked)
                         {
                                nature = document.getElementById("tatkal").value;
                         }
                        else if(document.getElementById("normal").checked)
                         {
                                nature = document.getElementById('normal').value;
                         }
                        else if(document.getElementById("procedural").checked)
                         {
                                nature = document.getElementById('procedural').value;
                         }
                        else
                         {
                                showAlert();
                                document.getElementById('normal').focus();
                                return false;
                         }
                        
                        var name = document.getElementById('name').value;
                        if( name == "" )
                         {
                                showAlert();
                                document.getElementById('name').focus();
                                return false;
                         }
                        
                        var mobile1 = document.getElementById('mobile1').value;
                        if( mobile1 == "" )
                         {
                                showAlert();
                                document.getElementById('mobile1').focus();
                                return false;
                         }
                        
                        var mobile2 = document.getElementById('mobile2').value;
                        /*if( mobile2 == "" )
                         {
                                showAlert();
                                document.getElementById('mobile2').focus();
                                return false;
                         }*/
                       
                        var email = document.getElementById('email_gr').value;
                        /*if( email == "" )
                         {
                                showAlert();
                                document.getElementById('email_gr').focus();
                                return false;
                         }*/

                        var area = "";
                        if(document.getElementById("rural").checked)
                         {
                                area = document.getElementById("rural").value;
                         }
                        else if(document.getElementById("urban").checked)
                         {
                                area = document.getElementById('urban').value;
                         }
                        else
                         {
                                showAlert();
                                document.getElementById('rural').focus();
                                return false;
                         }

                        var state = document.getElementById('state').value;
                        if( state == "" )
                         {
                                showAlert();
                                document.getElementById('state').focus();
                                return false;
                         }
                        
                        var district_id = document.getElementById('district_gr').value;
                        if( district_id == "" )
                         {
                                showAlert();
                                document.getElementById('district_gr').focus();
                                return false;
                         }
                        
                        var block_id = document.getElementById('tehsil_gr').value;
                        if( block_id == "" )
                         {
                                showAlert();
                                document.getElementById('tehsil_gr').focus();
                                return false;
                         }
                        
                        var village_id = document.getElementById('city_name_gr').value;
                        if ( village_id == "" ) 
                         {
                                showAlert();
                                document.getElementById('city_name_gr').focus();
                                return false;
                         }
                  
                        var branch = document.getElementById('branch').value;
                        /*if(branch == "")
                         {
                                showAlert();
                                document.getElementById('branch').focus();
                                return false;
                         }*/
                
                        var residential_address = document.getElementById("residential_address").value;     
                        if(residential_address == "")
                         {
                                showAlert();
                                document.getElementById("residential_address").focus();
                                return false;
                         }      

                        var brief_application = document.getElementById('brief_application').value;
                        if( brief_application == "" )
                         {
                                showAlert();
                                document.getElementById('brief_application').focus();
                                return false;
                         }

			var call_id = document.getElementById('callid').innerHTML; //alert(call_id);
			var beneficiary_id = document.getElementById('beneficiary_id').value; //alert(beneficiary_id);
			var aadhar_no = document.getElementById('aadhar_uid_no').value; //alert(aadhar_no);
			var call_type = "inbound";
                        var callQuery="type=SaveGrievance&agent_id=<?=$_REQUEST["agentid"];?>&contact_no=<?=$_REQUEST["callernumber"];?>&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&aadhar_no="+aadhar_no+"&source="+source+"&date="+date+"&grievance_type="+grievance_type+"&nature="+nature+"&name="+name+"&mobile1="+mobile1+"&mobile2="+mobile2+"&email="+email+"&area="+area+"&state="+state+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&branch="+branch+"&residential_address="+residential_address+"&brief_application="+brief_application+"&call_type="+call_type;
                        //alert(callQuery); //return false;
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
					if(Response == "INSERT")
					{
						alert("Complaint is Inserted Successfully.");
                                        }
					if(Response == "UPDATE")
					{
						alert("Complaint is Updated Successfully.");
					}
					
                                 }
                         }

                 }
                delete xmlHttp; 
         }      

</script>
</head>

<body bgcolor=#E6EEFE border="0">
<form name="Grievance" id="Grievance" method="POST" action="" >
<div id='mh' style='border:0px solid green;'>
<div id='mhinfo' style='border:0px solid red;'>
<table   width="100%"  border="0" >
<tr bgcolor="#000080"> 
<th colspan="4" id="mhtitle"><font color="white" family="arial" size="3px"><center>Grievance Screen / शिकायत स्क्रीन</center></font></th>
</tr>
<tr > 
<td colspan=4>
	<div style="font-family:arial;font-size:15px;color:black;font-weight:bold;">Referance Details<br>संदर्भ विवरण<div>
	<table width="100%" cellspacing="1" cellpadding="1" border="1">
	<tbody>
		<tr>	
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;">Source<br>स्रोत<span><b style="color: red;">*</b></span></th>
		<td class="labletext" colspan="1">
		<input type="text" name="source" id="source" value="Call Center" readonly>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;"><b>Date<br>तारीख</b><span><b style="color: red;">*</b></span></th>
		<td class="labletext">
		<input id="date" type="text" value="<?php echo date("Y-m-d");?>" readonly>	
		</td>
		</tr>
		<tr>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;">Grievance Type<br>शिकायत प्रकार<span><b style="color: red;">*</b></span></th>
		<td class="labletext" width="50%" colspan="3">
		<table id="MainContent_rdoreferencetype" cellspacing="1" cellpadding="0" style="width:50%;">
		<tbody>
		<tr>
		<td>
		<input id="complaint" type="radio" value="complaint" name="grievance_type" checked="checked"><label> Complaint<br>शिकायत </label>
		</td>
		<td>
		<input id="demand" type="radio" value="demand" name="grievance_type"><label>Demand<br>मांग</label>
		</td>
		<td>
		<input id="advice" type="radio" value="advice" name="grievance_type"><label>Suggestions<br>सलाह</label>
		</td>
		<td>
		<input id="others" type="radio" value="others" name="grievance_type"><label>Other<br>अन्य</label>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		<tr>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;">Nature<br>प्रकृति<span><b style="color: red;">*</b></span></th>
		<td class="labletext" align="left" colspan="5">
		<table id="MainContent_rdobtnNature" cellspacing="1" cellpadding="0" style="width:50%;">
		<tbody>
		<tr>
		<td>
		<input id="tatkal" type="radio" value="tatkal" name="nature" checked="checked"><label>Tatkal<br>तत्काल</label>
		</td>
		<td>
		<input id="normal" type="radio" value="normal" name="nature"><label>Normal<br>सामान्य</label>
		</td>
		<td>
		<input id="procedural" type="radio" value="procedural" name="nature"><label>Procedural<br>प्रक्रियात्मक</label>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
	</tbody>
	</table>
	<br>
	<div style="font-family:arial;font-size:15px;color:black;font-weight:bold;">Details of the Complainee<br>आवेदक का विवरण<div>
	<table id="MainContent_idtableDetailsofApplicant" width="100%" cellspacing="0" cellpadding="0" border="1">
	<tbody>
		<!--<tr id="MainContent_trchkGG">
		<th class="labletd"> Collective complaint </th>
		<td class="labletext" align="left" colspan="5">
		<input id="MainContent_chkGG" type="checkbox" onclick="javascript:setTimeout('__doPostBack(\'ctl00$MainContent$chkGG\',\'\')', 0)" name="ctl00$MainContent$chkGG">
		<label for="MainContent_chkGG">Yes</label>
		</td>
		</tr>-->
		<tr>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;">Name<br>नाम<span><b style="color: red;">*</b></span>
		</th>
		<td class="labletext" width="17%" style="font-family:arial;font-size:14px;color:black;">
		<input id="name" class="tb10" type="text" maxlength="100" name="name">
		</td>
		<th class="labletd" width="17%" style="font-family:arial;font-size:14px;color:black;">Mobile Number 01<br>मोबाइल नंबर 01<span><b style="color: red;">*</b></span>
		</th>
		<td class="labletext" width="22%" style="font-family:arial;font-size:14px;color:black;">
		<input id="mobile1" class="tb10" type="text" maxlength="10" name="mobile1" onkeydown="return isNumberKey(event);">
		</td>
		<th class="labletd" width="17%" style="font-family:arial;font-size:14px;color:black;">Mobile Number 02<br>मोबाइल नंबर 02</th>
		<td class="labletext" width="17%" style="font-family:arial;font-size:14px;color:black;">
		<input id="mobile2" class="tb10" type="text" maxlength="10" name="mobile2" onkeydown="return isNumberKey(event);">
		</td>
		</tr>
		<tr>
		<th class="labletd" style="font-family:arial;font-size:14px;color:black;"> E-Mail<br>ईमेल </th>
		<td class="labletext" colspan="5">
		<input id="email_gr" class="tb10" type="text" maxlength="50" name="email">
		</td>
		</tr>
	</tbody>
	</table>
	<br>
	<div style="font-family:arial;font-size:15px;color:black;font-weight:bold;">Complainee Residential Information<br>शिकायत / सुझाव क्षेत्र की जानकारी<div>
	<table id="tblSameas" width="100%" cellspacing="0" cellpadding="0" border="1">
	<tbody>
		<tr>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;">Area<br>क्षेत्र</th>
		<th class="labletext" colspan="5">
		<table id="MainContent_rdobtnGRuralUrban" cellspacing="1" cellpadding="0" style="width:50%;">
		<tbody>
		<tr>
		<td style="font-family:arial;font-size:14px;color:black;"><label>Rural<br>ग्रामीण</label>
		<input id="rural" type="radio" checked="checked" value="rural" name="area">
		</td>
		<td style="font-family:arial;font-size:14px;color:black;"><label>Urban<br>शहरी</label>
		<input id="urban" type="radio" value="urban" name="area">
		</td>
		</tr>
		</tbody>
		</table>
		</th>
		</tr>
		<tr>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;">State<br>राज्य<span><b style="color: red;">*</b></span>
		</th>
		<td class="labletext" width="17%" style="font-family:arial;font-size:14px;color:black;">
		<input id="state" type="text" value="Uttar Pradesh" readonly>
		</td>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;">District<br>जिला<span><b style="color: red;"> </b></span>
		</th>
		<td class="labletext" width="17%" style="font-family:arial;font-size:14px;color:black;">
		<select id='district_gr' name='district_gr' onchange='GetRegions_Gr(this.value,"1");'>
		<option value=''>Select District</option>
                <?php
                $district_query = "SELECT ds_dsid,ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC;";
                $district_result= mysql_query($district_query);
                while($district_details = mysql_fetch_array($district_result))
                 {
                	$SEL = ($Beneficiary_Details['district_id']==$district_details["ds_dsid"])?"selected":"";
                        echo "<option value='".$district_details["ds_dsid"]."~".$district_details["ds_lname"]."' $SEL >".$district_details["ds_lname"]."</option>";
		 }
                ?>
                </select>
		</td>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;">Tehsil<br>तहसील<span></span></th>
		<td class="labletext" width="17%" style="font-family:arial;font-size:14px;color:black;">
		<select id='tehsil_gr' name='tehsil_gr' onchange='GetRegions_Gr(this.value,"2");'>
                <?php
                echo"<option value=''>--Pickup Tehsil--</option>";
                $stmtTEH="SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid='".$Beneficiary_Details["district_id"]."' ORDER BY md_lname ASC;";
                $resultTEH=mysql_query($stmtTEH);
                while($row=mysql_fetch_array($resultTEH))
                {
	                $SEL = ($Beneficiary_Details['block_id']==$row["md_mdid"])?"selected":"";
                        echo"<option value='".$row["md_mdid"]."~".$row["md_lname"]."' $SEL >".$row["md_lname"]."</option>";
                }
                ?>
         	</select>
		</td>
		</tr>
		<tr>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;"><span>Panchayat<br>पंचायत<span><b style="color: red;"></b></span>
		</th>
		<td class="labletext" style="font-family:arial;font-size:14px;color:black;" width="17%">
		<select id='city_name_gr' name='city_name_gr'>
                <?php
                echo"<option value=''>--Pickup Village--</option>";
                $stmtVILL="SELECT ct_ctid,ct_lname FROM m_city WHERE is_active=1 AND ct_mdid='".$Beneficiary_Details["block_id"]."' ORDER BY ct_lname ASC;";
                $resultVILL=mysql_query($stmtVILL);
                while($row=mysql_fetch_array($resultVILL))
                {
         		$SEL = ($Beneficiary_Details['village_id']==$row["ct_ctid"])?"selected":"";
                        echo"<option value='".$row["ct_ctid"]."~".$row["ct_lname"]."' $SEL >".$row["ct_lname"]."</option>";
                }
                ?>
                </select>
		</td>
		</th>
		<th class="labletd" width="9%" style="font-family:arial;font-size:14px;color:black;"><span>Branch<br>ब्रांच</span>
		</th>
		<td class="labletext" colspan="5" style="font-family:arial;font-size:14px;color:black;" width="17%">
		<select id='branch' name='branch'>
		<option value="">--Select Branch--</option>
		</select>
		</td>
		</tr>
		<tr>
		<th class="labletd" width="10%" style="font-family:arial;font-size:14px;color:black;"> Residential Address<br>घर का पता</th>
		<td class="labletext" colspan="5">
		<textarea id="residential_address" class="tb10" style="width:92%;" cols="20" rows="2" name="residential_address"> </textarea><span style="text-align: right"></span>
		</td>
		</tr>
	</tbody>
	</table>
        <br>
        <div style="font-family:arial;font-size:15px;color:black;font-weight:bold;">Complaints / Suggestions<br>आवेदन का विवरण<div>
	<table width="100%" cellspacing="0" cellpadding="0" border="1">
	<tbody>
		<tr>
		<th class="labletd" width="11%" style="font-family:arial;font-size:14px;color:black;">Details<br>संक्षिप्त आवेदन<span><b style="color: red;">*</b></span>
		</th>
		<td class="labletext" colspan="5" >
		<textarea id="brief_application" class="tb10" style="width:92%;" cols="20" rows="2" name="brief_application"></textarea><span</span>
		</td>
		</tr>
		<!--<tr style="border-bottom:1px;">
		<td class="labletd" style="width: 11%;border-top:1px;">
		<b>आवेदन एवम् सम्बंधित दस्तावेज अपलोड करे</b>
		<br>
		<br>
		</td>
		<td class="labletext" style="width: 65px;border-top:1px;">
		<table>
		<tbody>
		<tr>
		<td>
		<input id="upload" class="file_1" type="file" style="font-size:15px;font-weight:bold;" onchange="validateFileSize();" name="ctl00$MainContent$FileUpload1">
		</td>
		<td>
		<span id="MainContent_lblUploadPDF" style="color:Red;font-size:10pt;font-weight:bold;">कृपया PDF/JPG/JPEG/PNG अपलोड करे!</span>
		</td>
		<td class="auto-style5">
		<span id="MainContent_lblpdfSize" style="color:Red;font-size:10pt;font-weight:bold;">(केवल 500KB तक ही मान्य है)!</span>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>-->
		<tr>
		<td class="lablebtn" align="center" style="border-top:1px;width:100px;" colspan="6">
		<input id="save" type="button" onclick="return saveGrievanceDetails();" value="Save" name="save">
		</td>
		</tr>
		</tbody>
		</table>
		<br>
		</div>
		<div style="padding-bottom:140px;"></div>
		</div>
		</div>

</form>
</body>
</html>
