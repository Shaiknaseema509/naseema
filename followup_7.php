<?php require_once("dbconnect_emri.php");  ?>   



<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVK EMRI </title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">  
    	  <script src="js/jquery-1.10.2.min.js"></script> 
			<script src="js/bootstrap-datetimepicker.js"></script>
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="scripts/main_validation.js"></script>  

   <link rel="stylesheet" href="js/jquery-ui.css">
  
  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
		  	 <script type="text/javascript">
  $( function() {
    $( ".datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
  } );
  </script>
	 <script type="text/javascript">
 	
	
	function abcd(a)
	{
		if(a == 'Yes')
			$('.hidshow').show();
		else
			$('.hidshow').hide();
	}
	
	
	$("#chk_doctor").change(function() {
    if(this.checked) {
	$.post("getdatevehicle.php",{"source":"GETTIME"}, function(return_data){
	$('#referral_doctor').val(return_data);
	});
      
    }
	else
	{
		$('#referral_doctor').val('');
	}
});
		
    </script>
 
<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
			<legend>
				<button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Questionnaire  7 / 7 </button>
		   </legend>
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>7)	Are you/ Victim willing to take follow up counselling in future?</b></td>
		</tr>
 <tr>
			<td>
				<select id="qtn_7" class="form-control" onchange="return abcd(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>
  			<td class="hidshow" style="display:none"><input class="form-control datepicker" type="text" id="referral_doctor"  /> 
			</td>
</tr>
		
		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="display:none"><button class="btn btn-danger" type="button" onclick="return back(6);" value="back">Back</button></td>
			<td><button class="btn btn-success" type="button" onclick="return saveLoad(8);" value="Submit">Submit -></button></td> 
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
  
  