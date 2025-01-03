<?php require_once("dbconnect_emri.php"); ?>

<html>
<head>

<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/grid.css" rel="stylesheet" />
<link href="css/hover.css" rel="stylesheet" media="all">
<style>
	 .form-control {height:25px !important; }
	 ul li {list-style:none; float:left}
	</style> 
</head>
	<body>

	
	<div class="row">
	 <div class="col-md-12"  >
	  <div class="row" style=" background-color: #58fcea ">
		 <div class="col-md-3"> UP  HEALTH  HELP LINE  </div>
		 <div class="col-md-3"><span> LOG IN ID :</span> xxxxxx </div>
		 <div class="col-md-3">  NAME : M.S Reddy</div> 
		 <div class="col-md-3"> CALL FLOW : Outbound - Beneficiary </div>
	 </div>  
	 <div class="row">
		 <div class="col-md-3">Phone Number :  </div>
		 <div class="col-md-3"><span> Call ID :</span> xxxxxx </div>
		 <div class="col-md-3">  Date :</div> 
		 <div class="col-md-3"> Time : </div>
	 </div>  
	  	 
	 </div>	
	 <div class="col-md-3"  style="background-color: lightyellow ">
		
		<div class="form-group" > 
			<table>
				<tr>
					<td align='right'>Beneficiary ID : </td>
					<td></td>
				</tr>	
				<tr>
					<td align='right'>Name : </td>
					<td><input type='text' class="form-control"></td>
				</tr>	
				<tr>
					<td align='right'>Husband Name : </td>
					<td><input type='text' class="form-control"></td>
				</tr>	
				<tr>
					<td align='right'>DOB : </td>
					<td><input type='text' class="form-control"></td>
				</tr>	
				<tr>
					<td align='right'>Age : </td>
					<td><input type='text' class="form-control"></td>
				</tr>	
				<tr>
					<td align='right'>District : </td>
					<td><select class="form-control"><option>---Select---</option></select></td>
				</tr>	
				<tr>
					<td align='right'>Block : </td>
					<td><select class="form-control"><option>---Select---</option></select></td>
				</tr>	
				<tr>
					<td align='right'>Panchayat : </td>
					<td><select class="form-control"><option>---Select---</option></select></td>
				</tr>	
				<tr>
					<td align='right'>Address : </td>
					<td><input type='text' class="form-control"></td>
				</tr>	
				<tr>
					<td align='right'>JSY Beneficiary : </td>
					<td><select class="form-control"><option>---Select---</option></select></td>
				</tr>	
				<tr>
					<td align='right'>Caste : </td>
					<td><select class="form-control"><option>---Select---</option></select></td>
				</tr>	
			</table>
		</div>
	 </div>
        <div class="col-md-9" >	  
          <div class="row" >
			 <div class="col-md-12" style="background-color:lightyellow">
				<ul>
					<li>Beneficiary verification</li>
					<li>ASHA verification</li>
					<li>Antenatal care</li>
					<li>Postnatal Care</li>
					<li>Anemia during pregnancy</li>
					<li>Child Immunization</li>
				</ul>
			 </div>
            <div class="col-md-12" style="background-color:lightyellow">
				<?php $skillset_page_query = mysql_query("select page from page_types where process='".$_POST['calProcess']."'") or die(mysql_error());
					  $skillset_page = mysql_fetch_array($skillset_page_query);	
				 echo $skillset_page["page"];
					//echo 'include("'.$skillset_page["page"].'")';
				 ?>
			</div>
          </div>
        </div>       
      </div>
	
	</body>
</html>
