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
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    	  <script src="js/jquery-1.10.2.min.js"></script>
<script src="js/moment-with-locales.js"></script>
	<script src="js/bootstrap-datetimepicker.js"></script>
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
		  
		  
	 <script type="text/javascript">
 	
	function abcd(a)
	{
		if(a == 'Yes')
			$('.hidshow').show();
		else
			$('.hidshow').hide();
	}
	
		function abcd1(b,c)
	{
		if(b == 'Yes')
			$('.hidshow1'+c).show();
		else
			$('.hidshow1'+c).hide();
	}
	
 
		
    </script>
<script src="scripts/main_validation.js"></script>
 
<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
			<legend>
				<button type="button" style="width:100%; font-size:17px;font-style:bold" class="btn btn-info ribbon">Questionnaire  6 / 7 </button>
		   </legend>
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>6) Do you need any support or service (to refer to agencies or peers)?</b></td>
		</tr>
		<tr>
			<td>
				<select id="qtn_6" class="form-control" onchange="return abcd(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>	
<tr>
			<td class="hidshow" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;a.	Psychiatry Consultation / Counselling</td>
			<td class="hidshow" style="display:none"><select id="provided_psychiatry_6" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,1);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow11" style="display:none"><input class="form-control" type="text" id="referral_psychiatry_6"  /> 
			<input class="form-control" type="text" id="contact_psychiatry_6" /></td>
 
  
</tr>
<tr>
			<td class="hidshow" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;b.	NGO’s Support</td>
			<td class="hidshow" style="display:none"><select id="provided_ngo_6" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,2);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow12" style="display:none"><input class="form-control" type="text" id="referral_psychiartist_6"  /> 
			<input class="form-control" type="text" id="contact_psychiartist_6" /></td>
 
  
</tr>
<tr>
			<td class="hidshow" style="display:none"><input type="checkbox"  id="chk_ngo" value="Yes" />&nbsp;&nbsp;&nbsp;c.	Lively Hood Support</td>
			<td class="hidshow" style="display:none"><select id="referred_lively_hood" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,3);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow13" style="display:none"><input class="form-control" type="text" id="referral_lively_hood"  /> 
			<input class="form-control" type="text" id="contact_lively_hood" /></td>
 
  
</tr>
<tr>
			<td class="hidshow" style="display:none"><input type="checkbox" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;d.	Legal Counselling / Support</td>
			<td class="hidshow" style="display:none"><select id="legal_counselling_6" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,4);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow14" style="display:none"><input class="form-control" type="text" id="referral_legal_counselling_6"  /> 
			<input class="form-control" type="text" id="contact_legal_counselling_6" /></td>
 
  
</tr>		
<tr>
			<td class="hidshow" style="display:none"><input type="checkbox" name="cities" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;e.	Any Medications / Doctor Consultation</td>
			<td class="hidshow" style="display:none"><select id="any_medication_6" class="form-control" style="width: 190px;" onchange="return abcd1(this.value,5);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow15" style="display:none"><input class="form-control" type="text" id="referral_mediaction_6"  /> 
			<input class="form-control" type="text" id="contact_medication_6" /></td>
 
  
</tr>		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><button class="btn btn-danger" type="button" onclick="return back(5);" value="back">Back</button></td>
			<td><button class="btn btn-success" type="button" value="Submit" onclick="return saveLoad(7);">Submit -></button></td> 
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
  