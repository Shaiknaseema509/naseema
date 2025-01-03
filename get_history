<?php include("dbconnect_emri.php");
  

 
$CallID= $_POST['CallID'];
?> 

<table border='2' cellpadding="5" cellspacing="5">
	<tr>
		<td>S.no</td>
		<td>Drug Name</td>
		<td>Quantity</td>
		<td>Unit</td>
		<td>Unit Price</td>
		<td>Measurement</td>
		<td>Route of Administration</td>		
		<td>Price</td>
		<td>Options</td>
	</tr>
	
	<tr>
		<td> </td>
		<td >
			<select id="drug_name" onchange="return DrugsData()">
				<option value=''>Select Drug Name</option>
				<?php  $drugName = mysql_query("SELECT md.`drug_id`,md.name_of_item  FROM animal.m_drugs_unit md 
												 LEFT JOIN( SELECT DISTINCT drug_id FROM animal.call_drugs_supplied WHERE `callid`=$CallID)  cd ON md.drug_id=cd.drug_id
												 WHERE cd.drug_id IS NULL");  
 
 
					while($drugNameData = mysql_fetch_array($drugName))
					{?>
						<option value="<?php echo $drugNameData['drug_id'];?>"><?php echo $drugNameData['name_of_item'];?></option>
				<?php }?>
			</select>
		</td>
		<td align="center"><input type="text" style="width:50px"  id="drug_quantity" onblur="return getPriceQty();" /></td> 
		<td align="center"><input type="text" style="width:50px" id="drug_units_now" disabled  readonly /></td>
		<td align="center" ><input type="text"  style="width:50px" disabled  readonly id="drug_measurement_now" ></td>
		<td align="center"><input type="text" disabled  readonly id="drug_unitprice_now"  style="width:70px" /></td>
		<td> <input type="hidden"  id="drug_SpeciesID" value="<?=$SpeciesID;?>" />
			<select id="type_mes"  style="display:none">
			<option value='1'>I/M</option>
			<option value='2'>I/V</option>
			<option value='2'>S/C</option>
			<option value='2'>P/O</option>
			<option value='2'>I/R</option>
			<option value='2'>I/U</option>
			<option value='2'>I/Mammary</option>
			<option value='2'>SubConjunctival</option>
				<option value=""></value>
			</select>
		</td>
		<td> <input type="hidden"  id="drug_CallID" value="<?=$CallID;?>" /> 
			<input  style="width:50px" type="text" disabled  readonly id="drug_total_price" > </td>
		<td align="center"><input type="button" value="Add" onclick="return SaveDrugs();" ></td>
	</tr>
	
	<?php $i=1;
	
	$drugQuery = mysql_query(" SELECT id,quantity,price,m_drugs_unit.name_of_item FROM call_drugs_supplied
	LEFT JOIN animal.m_drugs_unit ON m_drugs_unit.drug_id=call_drugs_supplied.drug_id WHERE callid=$CallID");
	while($drugData = mysql_fetch_array($drugQuery))
	{?>
	<tr>
	
		<td><?=$i++;?></td>
		<td><?php echo $drugData['name_of_item'];?></td>
		<td align="center"><?php echo $drugData['quantity'];?></td>
		<td align="center"><?php echo $drugData['drug_unit'];?></td>
		<td></td>
		<td align="center"> <?php echo $drugData['price']*$drugData['drug_quantity']/$drugData['unit'];?></td>
		<td><td align="center"><?php echo $drugData['price'];?></td></td>
		<td> <input type="button" value="delete" onclick="return DeleteDrugs(<?php echo $drugData['id'];?>);"  /></td>
	</tr>
<?php }?>
</table>