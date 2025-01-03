<?php

$birth_date = $_POST['tabs'];  //'12-12-2018';  //2019-12-10';
if($birth_date =='') 
{
	echo 0; die;
}
$yearmnth = 'YEAR';
$age= date("Y") - date("Y", strtotime($birth_date));


if($age ==0 || $age =='' )
{
	$yearmnth = 'MONTH';
	$age= date("m") - date("m", strtotime($birth_date));	
}
	 
 
 
 if($age >0)
	$age =$age;
else 
	$age= 0;

//echo $yearmnth;
?>

<td align='right' style="font-family:arial;font-size:15px;color:black;" >AGE : </td>
<td align='nowrap' tyle="font-family:arial;font-size:15px;color:black;">
	<select name="monthyear" id="monthyear" >
		<option value="YEAR" <?php if($yearmnth == 'YEAR') echo 'selected="selected"'; ?>>Year</option>
		<option value="MONTH" <?php if($yearmnth == 'MONTH') echo 'selected="selected"'; ?>>Month</option>
	</select>
	<input type="text" id='age' name='age' style="width:50px" maxlength=3
	onkeyup="AgeLimit(this.value,this.id);"  onkeypress="return allowValidKey(event,'number');" value="<?php echo $age;?>"  
	/><span id="age_span" style='color:red;font-size:10px'></span></td>