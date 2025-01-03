<div id = "questions1"  > 
<fieldset class="fieldset2 scrolldata">
<legend class="legendclass">Questtionare</legend><table><tr>
<td colspan = 3>
<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 
						
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
		
 
		 
	</table>
	</fieldset>
</form> 
</div>
</div>

<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
		<input type ="hidden" value='<?php echo $id;?>' id="callid" />
			<td ><b>2)	Police attended the incident location in time?</b></td>
		</tr>
		<tr>
			<td>
				<select id="qtn" class="form-control" onchange="return abcd1(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>		
			<td class="hidshow2" style="display:none">Police Reach time in minutes?</td>
			<td class="hidshow2" style="display:none">
			<select id="atn1" class="form-control" >
				<option value=''>Select</option>
				<option value='5 Minutes'>5 Minutes</option>
				<option value='10 Minutes'>10 Minutes</option>
				<option value='15 Minutes'>15 Minutes</option>			
				<option value='20 Minutes'>20 Minutes</option>
				<option value='More Than 20 Minutes'>More Than 20 Minutes</option> 
			</select>
			</td> 
			<td class="hidshow3" style="display:none">Police Not Reached?</td>
			<td class="hidshow3" style="display:none">
				<select id="atn2" class="form-control" >
					<option value=''>Select</option>
					<option value='Vehicle or Ambulance service not required'>Vehicle or Ambulance service not required</option>
					<option value='Vehicle busy'>Vehicle busy</option>
					<option value='Vehicle breakdown'>Vehicle breakdown</option>	 
					<option value='Chosen another means of transport to shift the victim'>Chosen another means of transport to shift the victim</option> 
				</select>
			</td> 
		</tr>
		
 
		 
	</table>
	</fieldset>
</form> 
</div>

<div class="col-md-12" style=""> 
 
<div class="form-group">
<fieldset> 
 
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>3) How you are feeling now?</b></td>
		</tr>
		<tr>
			<td>
				<select id="ques_3" class="form-control" onchange="return abcd2(this.value);" >
					<option value=''>Select</option>
					<option value='Still with Suicidal Ideations'>Still with Suicidal Ideations</option>
					<option value='In Recovery state and feeling well'>In Recovery state and feeling well</option> 
				</select>
			</td>	
<tr>
			<td class="hidshow4" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;Provided Psychological counselling at SPHL</td>
			<td class="hidshow4" style="display:none"><select id="psychiatry_sphl" class="form-control" style="width: 190px;" onchange="return abcd3(this.value,1);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow51" style="display:none"><input class="form-control" type="text" id="referral_sphl"  /> 
			<input class="form-control" type="text" id="contact_sphl" /></td>
 
  
</tr>
<tr>
			<td class="hidshow4" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to Psychiatry Consultation</td>
			<td class="hidshow4" style="display:none"><select id="provided_psychiatry" class="form-control" style="width: 190px;" onchange="return abcd3(this.value,2);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow52" style="display:none"><input class="form-control" type="text" id="referral_psychiartist"  /> 
			<input class="form-control" type="text" id="contact_psychiartist" /></td>
 
  
</tr>
<tr>
			<td class="hidshow4" style="display:none"><input type="checkbox" name="cities" id="chk_ngo" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to NGO’s for support</td>
			<td class="hidshow4" style="display:none"><select id="referred_ngo" class="form-control" style="width: 190px;" onchange="return abcd3(this.value,3);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow53" style="display:none"><input class="form-control" type="text" id="referral_ngo"  /> 
			<input class="form-control" type="text" id="contact_ngo" /></td>
 
  
</tr>
<tr>
			<td class="hidshow4" style="display:none"><input type="checkbox" name="cities" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to Doctor Consultation for further Medical assistance</td>
			<td class="hidshow4" style="display:none"><select id="doctor_consult" class="form-control" style="width: 190px;" onchange="return abcd3(this.value,4);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow54" style="display:none"><input class="form-control" type="text" id="referral_doctor"  /> 
			<input class="form-control" type="text" id="contact_doctor" /></td>
 
  
</tr>		
		
 
		 
	</table>
	</fieldset>
</form> 
</div>
</div>

<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>4)  Any History of Suicides in your family?</b></td>
		</tr>
 
 		<tr>

 			<td><select id="suicide_history" class="form-control" onchange="return abcd4(this.value);">
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>		
 
 			<td class="hidshow34" style="display:none">Relation <select id="relation" class="form-control" >
			<option value=''>Select</option>
			<option value='1'>Mother</option>
			<option value='2'>Father</option>
			<option value='3'>Sister</option>			
			<option value='4'>Brother</option>
			<option value='5'>Son</option>
			<option value='6'>Daughter</option>
			<option value='7'>Wife</option>
			<option value='8'>Husband</option>			
			</select></td> 
			<td class="hidshow34" style="display:none">Reasons</td><td class="hidshow34" style="display:none"><select id="reason" class="form-control" >
			<option value=''>Select</option>
			<option value='1'>Financial issues</option>
			<option value='2'>Psychiatric illness</option>
			<option value='3'>Medical Illness</option>			
			<option value='4'>Love Failures</option>
			<option value='5'>Fear of Failure</option>
			<option value='6'>Conflicts with family relations</option> 
			</select> 
			<td class="hidshow34" style="display:none">
			<button type="button" id="btnsave" onclick = 'return savesuicidequestion();'>Save</button></td>
			</td> 
			
			<div class="datagrid" id="datagrid" >
			</div> </tr>	
		
 
		 
	</table>
	</fieldset>
</form> 

</div>
</div>

<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 	
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>5)  Still do you/Victim feel depressed or hopelessness?</b></td>
		</tr>
		<tr>
			<td>
				<select id="qtn_5" class="form-control" onchange="return abcd5(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>	
<tr>
			<td class="hidshow14" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;Provided Psychological counselling at SPHL</td>
			<td class="hidshow14" style="display:none"><select id="provided_sphl_5" class="form-control" style="width: 190px;" onchange="return abcd6(this.value,5);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow15" style="display:none"><input class="form-control" type="text" id="referral_psychiatry_5"  /> 
			<input class="form-control" type="text" id="contact_psychiatry_5" /></td>
 
  
</tr>
<tr>
			<td class="hidshow14" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to Psychiatry Consultation</td>
			<td class="hidshow14" style="display:none"><select id="provided_psychiatry_5" class="form-control" style="width: 190px;" onchange="return abcd6(this.value,6);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow16" style="display:none"><input class="form-control" type="text" id="referral_psychiartist_5"  /> 
			<input class="form-control" type="text" id="contact_psychiartist_5" /></td>
 
  
</tr>
<tr>
			<td class="hidshow14" style="display:none"><input type="checkbox" name="cities" id="chk_ngo" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to NGO’s for support</td>
			<td class="hidshow14" style="display:none"><select id="referred_ngo_5" class="form-control" style="width: 190px;" onchange="return abcd6(this.value,7);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow17" style="display:none"><input class="form-control" type="text" id="referral_ngo_5"  /> 
			<input class="form-control" type="text" id="contact_ngo_5" /></td>
 
  
</tr>
<tr>
			<td class="hidshow14" style="display:none"><input type="checkbox" name="cities" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;Referred to Doctor Consultation for further Medical assistance</td>
			<td class="hidshow14" style="display:none"><select id="doctor_consult_5" class="form-control" style="width: 190px;" onchange="return abcd6(this.value,8);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow18" style="display:none"><input class="form-control" type="text" id="referral_doctor_5"  /> 
			<input class="form-control" type="text" id="contact_doctor_5" /></td>
 
  
</tr>		
		
 
		 
	</table>
	</fieldset>
</form> 
</div>
</div>


<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 	
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>6) Do you need any support or service (to refer to agencies or peers)?</b></td>
		</tr>
		<tr>
			<td>
				<select id="qtn_6" class="form-control" onchange="return abcd7(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>	
<tr>
			<td class="hidshow22" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;a.	Psychiatry Consultation / Counselling</td>
			<td class="hidshow22" style="display:none"><select id="provided_psychiatry_6" class="form-control" style="width: 190px;" onchange="return abcd8(this.value,3);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow93" style="display:none"><input class="form-control" type="text" id="referral_psychiatry_6"  /> 
			<input class="form-control" type="text" id="contact_psychiatry_6" /></td>
 
  
</tr>
<tr>
			<td class="hidshow22" style="display:none"><input type="checkbox" name="cities" id="chkpsychiatry" value="Yes" />&nbsp;&nbsp;&nbsp;b.	NGO’s Support</td>
			<td class="hidshow22" style="display:none"><select id="provided_ngo_6" class="form-control" style="width: 190px;" onchange="return abcd8(this.value,4);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow94" style="display:none"><input class="form-control" type="text" id="referral_psychiartist_6"  /> 
			<input class="form-control" type="text" id="contact_psychiartist_6" /></td>
 
  
</tr>
<tr>
			<td class="hidshow22" style="display:none"><input type="checkbox"  id="chk_ngo" value="Yes" />&nbsp;&nbsp;&nbsp;c.	Lively Hood Support</td>
			<td class="hidshow22" style="display:none"><select id="referred_lively_hood" class="form-control" style="width: 190px;" onchange="return abcd8(this.value,5);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow95" style="display:none"><input class="form-control" type="text" id="referral_lively_hood"  /> 
			<input class="form-control" type="text" id="contact_lively_hood" /></td>
 
  
</tr>
<tr>
			<td class="hidshow22" style="display:none"><input type="checkbox" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;d.	Legal Counselling / Support</td>
			<td class="hidshow22" style="display:none"><select id="legal_counselling_6" class="form-control" style="width: 190px;" onchange="return abcd8(this.value,6);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow96" style="display:none"><input class="form-control" type="text" id="referral_legal_counselling_6"  /> 
			<input class="form-control" type="text" id="contact_legal_counselling_6" /></td>
 
  
</tr>		
<tr>
			<td class="hidshow22" style="display:none"><input type="checkbox" name="cities" id="chk_doctor" value="Yes" />&nbsp;&nbsp;&nbsp;e.	Any Medications / Doctor Consultation</td>
			<td class="hidshow22" style="display:none"><select id="any_medication_6" class="form-control" style="width: 190px;" onchange="return abcd8(this.value,7);" >
			<option value=''>Select</option>
			<option value='Yes'>Yes</option>
			<option value='No'>No</option> 
			</select></td>	
 
			<td class="hidshow97" style="display:none"><input class="form-control" type="text" id="referral_mediaction_6"  /> 
			<input class="form-control" type="text" id="contact_medication_6" /></td>
 
  
</tr>		
 
	</table>
	</fieldset>
</form> 
</div>
</div>


<div class="col-md-12" style=""> 
 
	  <div class="form-group">
		<fieldset> 
 
						
	<table 	class="tble tale-stiped ac" cellspacing="5" cellpadding="5">
		<tr>
			<td ><b>7)	Are you/ Victim willing to take follow up counselling in future?</b></td>
		</tr>
 <tr>
			<td>
				<select id="qtn_7" class="form-control" onchange="return abcd9(this.value);" >
					<option value=''>Select</option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option> 
				</select>
			</td>
  			<td class="hidshow33" style="display:none"><input class="form-control datepicker" type="text" id="followupdatetime"  /> 
			</td>
</tr>
		
 
	</table>
	</fieldset>
</form> 
</div>

</div>

 </td>
</tr>
 
<tr>
 <td><button class="btn btn-success" type="button" onclick="return saveLoad(1);" value="Submit">Submit -></button></td> 
</tr>
 
</table></fieldset>
</div></div>

