<?php
require("dbconnect_emri.php");

//echo "<pre>".print_r($_REQUEST,1)."</pre>";
?>
 
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

        function saveGovtDetails(clickedElement)
         {
                var xmlHttp=newHttpObject();
                
                if(xmlHttp)
                 {
                    	var URL = clickedElement.id;
						 window.open('Govt_Schemes/'+URL,'winname','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,resizable=no,width=800,height=800');
						 return false;
						 var callQuery="type=SaveGrievance&agent_id=<?=$_REQUEST["agentid"];?>&contact_no=<?=$_REQUEST["callernumber"];?>&call_id="+call_id+"&beneficiary_id="+beneficiary_id+"&aadhar_no="+aadhar_no+"&source="+source+"&date="+date+"&grievance_type="+grievance_type+"&nature="+nature+"&name="+name+"&mobile1="+mobile1+"&mobile2="+mobile2+"&email="+email+"&area="+area+"&state="+state+"&district_id="+district_id+"&block_id="+block_id+"&village_id="+village_id+"&branch="+branch+"&residential_address="+residential_address+"&brief_application="+brief_application;
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
                                 }
                         }

                 }
                delete xmlHttp; 
         }      

</script>
 
<form name="Grievance" id="Grievance" method="POST" action="" >
<div id='mh' style='border:0px solid green;'>
<div id='mhinfo' style='border:0px solid red;'>
<table   width="100%"  border="0" >
<tr bgcolor="#000080"> 
<th colspan="4" id="mhtitle"><font color="white" family="arial" size="3px"><center>Govt Scheme Screen</center></font></th>
</tr>
<tr > 
<td colspan=4>
	<div style="font-family:arial;font-size:15px;color:black;font-weight:bold;">Scheme Details<div>
	<table width="100%" cellspacing="1" cellpadding="1" border="1">
	<tbody>
		 
		 <?php        $i=0;         
                $stmtVILL="SELECT Scheme,EnglishDoc FROM m_government_schemes ORDER BY order_by desc;";
                $resultVILL=mysql_query($stmtVILL);
                while($row=mysql_fetch_array($resultVILL))
                {$i++;?>
         		 
				 <tr>
					<td> <?=$i;?></td>
					<td> <?=$row['Scheme'];?></td>
					<td> <input id="<?=$row['EnglishDoc'];?>" type="button" onclick="return saveGovtDetails(this);" value="View" name="save"> </td>
				 </tr>			 
				 
				<?php  
                }
                ?>
		
		 
		</tbody>
		</table> 
		</div>
		<div style="padding-bottom:140px;"></div>
		</div>
		</tr>
		</table>
		</div>
</div>
</form> 
<div style="clear:both"> &nbsp; </div>