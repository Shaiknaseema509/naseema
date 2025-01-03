<?php
require("dbconnect_emri.php");

//echo "<pre>".print_r($_REQUEST,1)."</pre>";


$subSubDirectoryID1 	= $_POST["subSubDirectoryID"];

$district_array		= explode("~",$subSubDirectoryID1); 



$subSubDirectoryID = $district_array[0];

if($subSubDirectoryID =='') $subSubDirectoryID =1;
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

        /*   function endCall1()
	 {
		var callTypes  = document.getElementById('CallTypeSS').value.split('~');
		var callType = callTypes[0]; 

         if(callType == "")	
	     {
		   alert("Please select call type");
		   return false;
	     }
		 else {
			  alert("Created Successfully");
			     Response = xmlHttp.responseText;
                  alert(Response);
		 }
	  
	 }	 */ 

</script>

<!--<style>
	#myTable{
		max-height: 400px;
		height: 400px;
		min-height: 250px;
		overflow-y: scroll;
		width: 100%;
	}
</style>-->
  
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
	<table width="100%"  cellspacing="1" cellpadding="1" border="1">
	 
		<thead><tr><td></td><td><input id="searchInput" onkeyup="myFunction()" value="" placeholder="Type to search" ></td></tr></thead>
		<tbody id="myTable">		 
		 <?php        $i=0;         
                $stmtVILL="SELECT Scheme,EnglishDoc,id FROM m_government_schemes where categoryId=$subSubDirectoryID and isActive=1 ORDER BY order_by desc;";
                $resultVILL=mysql_query($stmtVILL);
                while($row=mysql_fetch_array($resultVILL))
                {$i++;?>
         		 
				 <tr>
					<td>
						<label class="btn btn-success  ">
							<input type="checkbox"   class="ads_Checkbox" value="<?=$row['id'];?>"  name="chk" >
							<span class="glyphicon glyphicon-ok"></span>
						</label>
					</td>
					 
					<td style="color:color:#1d1e1e;"> <?=$row['Scheme'];?></td>
					<td> <input class="btn btn-danger" style="cursor:pointer" id="<?=$row['EnglishDoc'];?>" type="button" onclick="return saveGovtDetails11('<?=$row['EnglishDoc'];?>');" value="View" name="save"> </td>
				 </tr>			 
				 
				<?php  
                }
                ?>
			</tbody>
			<tr>
				<td></td>
				<td>Remarks <textarea id="remarks"> </textarea></td>
				<td><input value="Submit" style="color: #ff0000; font-weight: bold; font-size: 10pt;" id="endcall" type="button" onclick="endCall1();"></td>
			</tr>
		 
	 
		</table> 
		</div>
		<div style="padding-bottom:5px;"></div>
		</div>
		</tr>
		</table>
		</div>
</div>
</form> 
<div style="clear:both"> &nbsp; </div>