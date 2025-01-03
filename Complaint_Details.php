<?php session_start();
require_once("dbconnect_emri.php");

//echo "<pre>".print_r($_POST,1)."</pre>";
 
 
 $callID = $_POST["call_id"];
 
$Query = "SELECT r.block_id,r.contact_no,r.beneficiary_name,g.call_id,g.date,c.`Name` cname,g.name,g.`grievance_id`,
g.`rDate`,g.`district_name`,g.`mobile1`,g.`name`,mad.`Agency_Name`,mi.`Name` FROM 
`grievance` g
left JOIN `m_institute` mi ON mi.`ID` = g.`institue`
left JOIN `m_agency_details` mad ON mad.`Agency_id`= g.`spocId`
left JOIN  `m_complaintstype` c ON c.ID=g.`complaintId`
LEFT JOIN `registration` r ON r.call_id=g.call_id  
 WHERE g.call_id ='$callID' AND g.`status` ='OPEN' ;";
$result = mysql_query($Query)or die('query:'.$Query.'|Error: ' . mysql_error());
$rows   = mysql_num_rows($result);
$Row = mysql_fetch_array($result);




 if($_SESSION['username'] =='')
 {
	 echo '<script>location.replace("login.php");</script>';
 }
 
 
 $agent_id = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>::: GVK EMRI :::</title>
   <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/main_validation.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
<style>
        .main {
            width: 1000px;
            padding-bottom: 0px;
            border-top: 0px;
            background-color: #FDFDFD;
            margin-left: auto;
            margin-right: auto;
            min-height: 412px;
            height: auto !important;
            box-shadow: 0 3px 3px rgba(104, 104, 104, 0.25);
            margin-top: 15px;
            margin-bottom: 15px;
        }
</style>
   <script>

	setInterval(function() { document.getElementById("alert").innerHTML = "";},20000);

	
	function complains(a)
	{		
		$('.forr').hide();
		$('#forwards').hide();
		if(a == 4 || a == 3)
		{
			$('#forwards').show();
			$('.forr').show(); 
		}
	}
	
	function GetRegions(ID,index)
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
			 else if(index == 3)
			 {
				var callQuery = "action=areas&village_id="+ID;
			 }
			 else if(index == 5)
			 {
				var IDS = $('#tehsil1').val(); 
				var callQuery = "action=GetAgencyGre&area_id="+IDS;
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
 
						document.getElementById("spocname").innerHTML=Response;	
					 
			 	 }
		 	 }
	 	 }
		delete xmlHttp;	
 	 }
	 
	function SaveDetails(StatusID,ClosureRemarks,ActionDetails)
	 {
		var xmlHttp=newHttpObject();
	  
		if(xmlHttp)
		 {
			var callQuery = "action=AGENTSTATUS&agent_id=<?=$_POST["agentid"];?>";
			//alert(callQuery);
			xmlHttp.open("POST","emri_bridge.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
				 {
					var Response = null;
					Response = xmlHttp.responseText;
					//alert(Response);
		
					var agent_status = Response;

					if(StatusID == 3)
	 	 			 {
    						if(ClosureRemarks == "") 
			 			 { 
                        				document.getElementById("alert").innerHTML = "Closure Remarks Should Not be Empty";
							document.getElementById("closure_remarks").focus();
	        					return false;
    			 			 }		 
    						if(ActionDetails == "") 
			 			 {
                        				document.getElementById("alert").innerHTML = "Action Details Should Not be Empty";
							document.getElementById("action_details").focus();
	        					return false;
    			 			 }
		 			 } 	

					 var emp = document.getElementById("forr").value; 
					 var spocname = document.getElementById("forr").value; 
                	var caremarks = document.getElementById("caremarks").value;
					
					
					if(xmlHttp)
		 			 {
						var callQuery = "action=COMPLAINT&spocname="+spocname+"&status_id="+StatusID+"&emp="+emp+"&caremarks="+caremarks+"&closure_remarks="+ClosureRemarks+"&complaint_id=<?=$Row["complaint_id"];?>&action_details="+ActionDetails+"&agent_id=<?=$_POST["agentid"];?>&action_id=<?=$_POST["action_id"];?>&agent_status="+agent_status+"&callid=<?=$_POST["call_id"];?>";
                        			//alert(callQuery);
                        			xmlHttp.open("POST","save_complaint_management.php",true);
                        			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        			xmlHttp.send(callQuery);
                        			xmlHttp.onreadystatechange=function()
                         			 {
							if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 			 {
                                        			var Response = null;
                                        			Response = xmlHttp.responseText;
                                        			//alert(Response);
                                        			if(Response.indexOf("SUCCESS")>=0)
                                         			 {
									if(agent_status == "ONCALL" || agent_status == "WRAPUP")
									 {
										 postURL("complaints.php?agentid=<?=$_POST["agentid"];?>","false");
										//postURL("http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&call_id=<?=$callid;?>&convoxid=<?=$_POST["convoxuid"];?>&agent_id=<?=$_POST["agentid"];?>&disposition=SAVE","false");
									 }
									else
									 {
										postURL("complaints.php?agentid=<?=$_POST["agentid"];?>","false");
									 }
                                         			 }
                                 			 }
                         			 }
					}
				 }
			 }
                 }
                delete xmlHttp; 
	 }
	
	function DialCaller(PhoneNumber,StatusID) 
	 {
		if(PhoneNumber!= "")
		 {
			var agent_id = "<?=$_POST["agentid"];?>";

			var xmlHttp=newHttpObject();
			if(xmlHttp)
			 {
				var callQuery = "action=PDO&agent_id="+agent_id+"&call_id=<?=$_POST["call_id"];?>&status_id="+StatusID+"&complaint_id=<?=$_POST["complaint_id"];?>";
				//alert(callQuery);
				xmlHttp.open("POST","http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/emri_bridge.php",true);
				xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlHttp.send(callQuery);
				xmlHttp.onreadystatechange=function()
				 {
					var response = xmlHttp.responseText;
					//alert(response);
					postURL("http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/bridge.php?ACTION=CALL&user="+agent_id+"&phone_number="+PhoneNumber,"false");	
				 }
			}   
		 }
	 }

	function CallerDialClose(Disposition)
	 {
		 postURL("complaints.php?agentid=<?=$agentid;?>","false");
		 return false;
		var xmlHttp=newHttpObject();
	  
		if(xmlHttp)
		 {
			var callQuery = "action=AGENTSTATUS&agent_id=<?=$_POST["agentid"];?>";
			//alert(callQuery);
			xmlHttp.open("POST","emri_bridge.php",true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(callQuery);
			xmlHttp.onreadystatechange=function()
		 	 {
				if (xmlHttp.readyState==4 && xmlHttp.status==200)
				 {
					var Response = null;
					Response = xmlHttp.responseText;
					//alert(Response);
		
					var agent_status = Response;

					if(xmlHttp)
		 			 {
						var callQuery = "action=CONVERSATIONS&callid=<?=$_POST["call_id"];?>&agent_id=<?=$_POST["agentid"];?>&action_id=<?=$_POST["action_id"];?>&agent_status="+agent_status;
						//alert(callQuery);
						xmlHttp.open("POST","save_complaint_management.php",true);
						xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlHttp.send(callQuery);
						xmlHttp.onreadystatechange=function()
			 			 {
							if(xmlHttp.readyState==4 && xmlHttp.status==200)
				 			 {
								var Response = null;
								Response = xmlHttp.responseText;
								//alert(Response);
								if(Response.indexOf("SUCCESS")>=0)
					 			 {
									if(agent_status == "ONCALL" || agent_status == "WRAPUP")
									 {
										postURL("http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&call_id=<?=$callid;?>&convoxid=<?=$_POST["convoxuid"];?>&agent_id=<?=$_POST["agentid"];?>&disposition="+Disposition,"false");
									 }
									else
									 {
										postURL("complaints.php?agentid=<?=$_POST["agentid"];?>","false");
									 }
					 			 }
				  			 }	
			  			 }
		  			 }
				 }
			 }
		 }
		delete xmlHttp;                      
	 }		
    </script>
    <style>
        ul.tabs {
            padding: 7px 0;
            font-size: 0;
            margin: 0;
            list-style-type: none;
            text-align: left;
        }

            ul.tabs li {
                display: inline;
                margin: 0;
                margin-right: 3px;
            }

                ul.tabs li a {
                    font: normal 12px Verdana;
                    text-decoration: none;
                    position: relative;
                    z-index: 1;
                    padding: 7px 16px;
                    border: 1px solid #CCC;
                    border-bottom-color: #B7B7B7;
                    color: #000;
                    background: #F0F0F0;
                    border-radius: 6px 6px 0px 0px;
                    -moz-border-radius: 6px 6px 0px 0px;
                    outline: none;
                }

                    ul.tabs li a:hover {
                        border: 1px solid #B7B7B7;
                        background: #E0E0E0;
                    }

                ul.tabs li.selected a {
                    position: relative;
                    top: 0px;
                    font-weight: bold;
                    background: white;
                    border: 1px solid #B7B7B7;
                    border-bottom-color: white;
                }

        div.tabcontents {
            width: 400px;
            border: 1px solid #B7B7B7;
            padding: 20px;
            background-color: #FFF;
            border-radius: 0 2px 2px 2px;
        }
    </style>
</head>
<body>
        
	<div class="row" style=' padding-left:220px'>
        <div class="col-md-8 col-xs-12">
        <div class="x_panel">
        <div class="x_title">
		<h2 style="font-size:17px"> Complaint Case Details : <b><?=$_POST["call_id"];?></b></h2>
        <div class="clearfix">
	</div>
        </div>
        </div>
        </div>
        </div>
        <br />
	<div  class="x_content"   style="padding-left:220px;margin-top: 12px;">
        <div class="form-group">
 	<div class="col-md-10">
	  <div class="col-md-6">
		<div class="col-md-4">	
                <label   for="complaint_id" style="margin-top: 12px;">Complaint ID </label>
        	</div>
		<div class="col-md-8">	
                <input   type="text" id="complaint_id" value="<?=$Row['grievance_id'];?>" disabled class="form-control" >
        	</div>
	  </div>
          <div class="col-md-6">
		<div class="col-md-4">	
		<input type="hidden" value="<?=$Row['block_id'];?>" id="tehsil1"  />
                <label  for="compalint_date" style="margin-top: 12px;">Compalint Date </label>
        	</div>
		<div class="col-md-8">	
                <input type="text" id="compalint_date" value="<?=$Row['rDate'];?>" disabled class="form-control" >
        	</div>
	  </div>
	</div>
 	<div class="col-md-10">
	  <div class="col-md-6">
		<div class="col-md-4">	
                <label   for="callername" style="margin-top: 12px;">Caller Name </label>
        	</div>
		<div class="col-md-8">	
                <input   type="text" id="callername" value="<?=$Row['beneficiary_name'];?>" disabled class="form-control" >
        	</div>
	  </div>
          <div class="col-md-6">
		<div class="col-md-4">	
                <label  for="callerphone" style="margin-top: 12px;">Caller Number </label>
        	</div>
		<div class="col-md-8">	
                <input type="text" id="callerphone" value="<?=$Row['contact_no'];?>" disabled   style="padding:10px 2px">
		 </div>
	  </div>
	</div>
 	<div class="col-md-10">
	  <div class="col-md-6">
		<div class="col-md-4">	
                <label   for="category_name" style="margin-top: 12px;">Complaint</label>
        	</div>
		<div class="col-md-8">	
                <input   type="text" id="category_name" value="<?=$Row['cname'];?>" disabled class="form-control" >
        	</div>
	  </div>
          <div class="col-md-6">
		<div class="col-md-4">	
                <label  for="Compalaint_CallId" style="margin-top: 12px;">Call ID </label>
        	</div>
		<div class="col-md-8">	
                <input type="text" id="Compalaint_CallId" value="<?=$Row['call_id'];?>" disabled class="form-control" >
        	</div>
	  </div>
	</div>
        </div>
        </div>
        <br /><br />
        <div class="row" style="padding-left:220px">
	<div  class="x_content"   style="margin-top: 12px;">
        <div class="form-group">
 	<div class="col-md-10">
	  <div class="col-md-6">
		<div class="col-md-4">	
                <label  for="category_status_name" style="margin-top: 12px;">Status</label>
        	</div>
		<div class="col-md-8">	
                <select class="form-control" id="category_status_name" name="category_status_name" onchange="return complains(this.value);" >
		<?php
		$Status_Query  = "SELECT category_status_id, category_status_name FROM m_complaint_status  WHERE is_active = '1' ORDER BY category_status_name;";
                $Status_Result  =  mysql_query($Status_Query);
		while($Status_List = mysql_fetch_array($Status_Result))
                 {
			$SEL = ($_POST["category_status_id"] == $Status_List["category_status_id"])? "selected": "";
                        echo "<option value='".$Status_List["category_status_id"]."' $SEL>".$Status_List["category_status_name"]."</option>";
                 }
		?>
                </select> <br />
				
				  
        	</div>
	  </div>
          <div class="col-md-6">
		<div class="col-md-4">	
                <label  for="caller_remarks" style="margin-top: 12px;">Caller Remarks</label>
        	</div>
		<div class="col-md-8">	
                <input type="text" id="caller_remarks" value="<?=$Row['caller_remarks'];?>" style="display" disabled class="form-control" >
        	</div>
	  </div>
	</div>
	</div>
	</div>
	
	<div  class="x_content forr"   style="display:none;margin-top: 12px;" >
        <div class="form-group">
 	<div class="col-md-10">
	  <div class="col-md-6">
		<div class="col-md-4">	
                <label  for="category_status_name" style="margin-top: 12px;"> SPOC Name </label>
        	</div>
		<div class="col-md-8">	
                
				
				  <select class="form-control" id="forr" name="forr" >
					<?php 
		 $Status_Query  = "SELECT `Agency_id`, `Agency_Name`,Mobile,email_id FROM `m_grivence_details`
			 WHERE isactive=1 and Mandal_id='".$Row['block_id']."' and Level_No=1 ORDER BY Agency_Name ASC;";
                $Status_Result  =  mysql_query($Status_Query);
		$Status_List = mysql_fetch_array($Status_Result);
                 //{
			//$SEL = ($_POST["category_status_id"] == $Status_List["category_status_id"])? "selected": "";
                        echo "<option value='".$Status_List["Agency_id"]."~".$Status_List["Agency_Name"]."~".$Status_List["Mobile"]."~".$Status_List["email_id"]."'>".$Status_List["Agency_Name"]."</option>";
                // }
		?>
                </select> <br>
				<?php echo $Status_List["Mobile"];?>,<?php echo $Status_List["email_id"];?>
        	</div>
	  </div>
          <div class="col-md-6">
		<div class="col-md-4">	
                <label  for="caller_remarks" style="margin-top: 12px;">Remarks</label>
        	</div>
		<div class="col-md-8">	
                <textarea type="text" id="caremarks" style="display" class="form-control" > </textarea>
        	</div>
	  </div>
	</div>
	</div>
	</div>
	
        <br /></br >
		
		
		 <div class="col-md-10" id="forwards" style="  background-color: #e0fab0 ">
	  <div class="col-md-12">
			<table class="table">
				<tr><th style="color:green">Compalint Updates</th></tr>
				<tr>
					<td>Status </td>
					<td>Status By </td>
					<td>Date </td>
					<td>Remarks </td>
				</tr>
				
				<?php 
					$qy=mysql_query("select ce.*,STS.category_status_name from complaints_emp ce 
					INNER JOIN m_complaint_status AS STS ON (ce.statusId=STS.category_status_id)  
					where ce.callid='".$callID."'");
					
				while($data = mysql_fetch_array($qy)){?>
					<tr>
					<td><?php echo $data['category_status_name'];?></td>
					<td><?php echo $data['empName'];?></td>
					<td> <?php echo $data['dateTime'];?></td>
					<td> <?php echo $data['empRemarks'];?> </td>
				</tr>
				<?php }?>  
			</table>
        	</div>
	  </div>
		
		 
        <div class="form-group">
 	<div class="col-md-10">
	  <div class="col-md-6">
		<div class="col-md-4">	
                <label   for="closure_remarks" style="margin-top: 12px;"> Remarks </label>
        	</div>
		<div class="col-md-8">	
        	<textarea style="resize:none" rows="2" cols="20"  ID="closure_remarks" name="closure_remarks" class="form-control" required><?=$Row['closure_remarks'];?></textarea>
        	</div>
	  </div>
          <div class="col-md-6">
		<div class="col-md-4">	
                <label  for="action_details" style="margin-top: 12px;">Action  </label>
        	</div>
		<div class="col-md-8">	
        	<textarea style="resize:none" rows="2" cols="20"  ID="action_details" name="action_details" class="form-control" required><?=$Row['action_details'];?></textarea>
        	</div>
	  </div>
	</div>
	
	
	
	 
	</div>
	<br />
	
	
	
	<div class ="row"> 	
		<div>
			<div class="col-md-12 " align='center'>
				
				<button type="button"  id= "Back"  name="Back" class="btn btn-rounded btn-success" onclick="CallerDialClose('BACK');">Back</button>
				<button type="button"  id= "save"  name="save" class="btn btn-rounded btn-success" onclick="SaveDetails(category_status_name.value,closure_remarks.value,action_details.value);">Save</button>
	</div>
        <div class="col-md-12">
        <span id="alert" align="center" style="color:red;font-size:20px;"></span>
        </div>
		
	</div>
	</div>
</body>
</html>



