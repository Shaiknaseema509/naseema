<?php 
require_once("dbconnect_emri.php");  
 

  ?>   
<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVK EMRI </title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">  
    	  <script src="js/jquery-1.10.2.min.js"></script> 
		
<script src="scripts/main_validation.js"></script>  
		  
	 <script type="text/javascript">
 	
	
	function abcd(a)
	{
		if(a == 'Yes')
			$('.hidshow').show();
		else
			$('.hidshow').hide();
		
		if(a == 'No')
			$('.hidshow1').show();
		else
			$('.hidshow1').hide();
	}
	
		
    </script>
 
<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
			<legend>
				<button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Questionnaire  1 / 7 </button>
		   </legend>
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>1)  Ambulance Reached on time on that day?</b></td>
		</tr>
		<tr>
			<td>
				<select id="amb_quest" class="form-control" onchange="return abcd(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>		
			<td class="hidshow" style="display:none">Ambulance Reach time in minutes?</td>
			<td class="hidshow" style="display:none">
			<select id="amb_reach_time" class="form-control" >
				<option value=''>Select</option>
				<option value='5 Minutes'>5 Minutes</option>
				<option value='10 Minutes'>10 Minutes</option>
				<option value='15 Minutes'>15 Minutes</option>			
				<option value='20 Minutes'>20 Minutes</option>
				<option value='More Than 20 Minutes'>More Than 20 Minutes</option> 
			</select>
			</td> 
			<td class="hidshow1" style="display:none">Not Availed Reasons</td>
			<td class="hidshow1" style="display:none">
				<select id="amb_not_reach_time" class="form-control" >
					<option value=''>Select</option>
					<option value='Vehicle or Ambulance service not required'>Vehicle or Ambulance service not required</option>
					<option value='Vehicle busy'>Vehicle busy</option>
					<option value='Vehicle breakdown'>Vehicle breakdown</option>	 
					<option value='Chosen another means of transport to shift the victim'>Chosen another means of transport to shift the victim</option> 
				</select>
			</td> 
		</tr>
		
		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="display:none"><button class="btn btn-danger" type="button" onclick="return back(1);" value="back">Back</button></td>
			<td><button class="btn btn-success" type="button" onclick="return saveLoad(2);" value="Submit">Submit -></button></td> 
		</tr>
		 
	</table>
	</fieldset>
</form> 
</div>

<style>
	  
 
.alert { top:0px;
                padding: 0px;
                background-color: #f44336; /* Red */
                color: white;
				font-size:16;
                position:fixed; display:none;
                width:93%;
                margin-bottom: 5px;
				z-index:9999;
                }

                /* The close button */
                .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
                }

                /* When moving the mouse over the close button */
                .closebtn:hover {
                color: black;
                }


	</style> 
  
  