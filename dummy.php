function drug_save()
{
	var confer = document.getElementById('consr').value;
	var presbr = document.getElementById('presbr').value;
	if(confer == 'YES')
	{
		var doc = document.getElementById('sysdoc').value;
		if(doc == '' || doc == 0)
		{
			alert("Select Doctor Name");
			return false;
		}

	}
	
	var beneficiary_id	= document.getElementById('basicinputNumberbeneficiary_ids').value;
	if(beneficiary_id =='' || beneficiary_id ==0)
	{
		alert("Select Beneficiary");
		return false; 
	}
	
	save_details2();
	
			var disposition = "";
		var Queue = "<?=$Queue;?>";
		var xmlHttp=newHttpObject();
		
		if(xmlHttp)
		 {  
			var beneficiary_id	= document.getElementById('basicinputNumberbeneficiary_ids').value; 			
			var callid	= document.getElementById('callid').value; 
			var call_type	= document.getElementById('call_type').value; 
			
			var lab_test = $('#lab_test').val();
			var lab_test_sms = $('#lab_test_sms').val();
			if($("#lab_test_sms").prop('checked') == true && lab_test != null )
			{
				lab_test_sms=1;
				}
				else 
				{lab_test_sms=0;}
			
			if(call_type == "")
			 {
				showAlert();
				document.getElementById('call_type').focus();
				return false;
			 }
			 	//var lab_test = $('#lab_test').val();
			var callQuery ="type=save_drug&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&beneficiary_id="+beneficiary_id+"&callid="+callid+"&call_type="+call_type+"&lab_test="+lab_test+"&lab_test_sms="+lab_test_sms+"&presbr="+presbr;
			
 
			  for (var i = 0; i <=4; i++) 
			  {
				var sysdig	= document.getElementById('sysdig1_'+i).value; 
				var sysmed	= document.getElementById('sysmed1_'+i).value;
				var descsysmer	= document.getElementById('descsysmer_'+i).value;
				callQuery +="&sysdig1_"+i+"="+sysdig+"&sysmed1_"+i+"="+sysmed+"&descsysmer1_"+i+"="+descsysmer; 
			  } 
			  
                        xmlHttp.open("POST","save_details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                        {
                                if(xmlHttp.readyState==4 && xmlHttp.status==200)
                                {
									var Response = null;
									Response = xmlHttp.responseText;
									if(Response !='') 
									{
										$('#beneficiary_ids').val(Response);
										$('#bids').val(Response);
										$('#basicinputNumberbeneficiary_ids').val(Response);
										$('#basicinputNumberbeneficiary_ids_label').html(Response);
									}
									$('.alert').show();
									$('.alert_content').html('Data updated..!');
									setTimeout(function(){$('.alert').hide();},10000); 
									document.getElementById('bids').value =11; 
				 
									//$('#save').hide();
									$('#save').text('Update');
									$('#TransferP').show();
									$('#endcall').show();
									
									var end_call_url = "http://192.168.3.24/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
									postURL(end_call_url,"false");
									//alert(end_call_url);
									 
								}
                        }

		 }
		delete xmlHttp;
}


//hgjghjhj


function getconf()
{
	var confer = document.getElementById('consr').value;
	if(confer == 'YES')
	{
		//alert(123);
		$('#divdoc').show();
	}
	else
	{
		$('#divdoc').hide();
	}
}

// hhgfghg

function save_details2()
{
		var confer = document.getElementById('consr').value;
	if(confer == 'YES')
	{
		var doc = document.getElementById('sysdoc').value;
		if(doc == '' || doc == 0)
		{
			alert("Select Doctor Name");
			return false;
		}

	}
	
	var disposition = "";
	var Queue = "<?=$Queue;?>";
	if($('#beneficiary_name').val())
	
		var xmlHttp=newHttpObject();
		
		if(xmlHttp)
		 {
			var beneficiary_id	= document.getElementById('basicinputNumberbeneficiary_ids').value; 
			var mhu	= document.getElementById('mhu').value; 
			var call_type	= document.getElementById('call_type').value; 
			if(call_type == "")
			 {
				showAlert();
				document.getElementById('call_type').focus();
				return false;
			 }		
			
			var callid	= document.getElementById('callid').value; 
			var sysdig	= document.getElementById('sysdig').value;	 
			var sysdoc	= document.getElementById('sysdoc').value; 
			var abdbdoctor	= document.getElementById('abdbdoctor').value; 
			var adbsp	= document.getElementById('adbsp').value; 
			var medp = document.getElementById('medp').value; 
			var medprem = document.getElementById('medprem').value;
			var doctor_type = document.getElementById('doctor_type').value;
			var lab_test = $('#lab_test').val();
 

			var callQuery="type=save_telemedicine&agent_id=<?=$agentID;?>&contact_no=<?=$phone_number;?>&beneficiary_id="+beneficiary_id+"&callid="+callid+"&sysdig="+sysdig+"&sysdoc="+sysdoc+"&abdbdoctor="+abdbdoctor+"&adbsp="+adbsp+"&medp="+medp+"&medprem="+medprem+"&mhu="+mhu+"&call_type="+call_type+"&lab_test="+lab_test+"&doctor_type="+doctor_type;
 
                        xmlHttp.open("POST","save_details.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
							 var end_call_url = "http://192.168.3.24/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
									//alert(end_call_url);
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 { //alert(123);
									/*var Response = null;
									Response = xmlHttp.responseText;
									if(Response !='') 
									{
										$('#beneficiary_ids').val(Response);
										$('#bids').val(Response);
										$('#basicinputNumberbeneficiary_ids').val(Response);
										$('#basicinputNumberbeneficiary_ids_label').html(Response);
									}
									$('.alert').show();
									$('.alert_content').html('Data updated..!');
									setTimeout(function(){$('.alert').hide();},10000); 
									document.getElementById('bids').value =11; 
				 
 
									$('#save').text('Update');
									$('#TransferP').show();
									$('#endcall').show();
*/
									var end_call_url = "http://192.168.3.24/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$convoxID;?>&agent_id=<?=$agentID;?>";
									//alert(end_call_url);
								postURL(end_call_url,"false");
 

								}
                         }

		 }
		delete xmlHttp;
}

 //gjkkfk

function save_details2()
{
		var confer = document.getElementById('consr').value;
	if(confer == 'YES')
	{
		var doc = document.getElementById('sysdoc').value;
		if(doc == '' || doc == 0)
		{
			alert("Select Doctor Name");
			return false;
		}

	}
	
	
	
	
	
	
	function checkPrgenet()
		{
			var age =  $('#age').val();
			var monthyear =  $('#monthyear').val();
			//var female =  $('#female').val();
			if(document.getElementById("male").checked)
			 {
				gender = document.getElementById("male").value;
			 }
			else if(document.getElementById("female").checked)
			 {
				gender = document.getElementById('female').value;
			 }
			 else if(document.getElementById("transgender").checked)
			 {
				gender = document.getElementById('transgender').value;
			 }
			//prgnt
			if(gender != 'F')
			{
				$('.prgnt').hide(); //return false;
			}
			if(gender =='F' && monthyear =='YEAR')
			{
				if(14 < age  && age < 49)
				{
					$('.prgnt').show();
				}
				else
				{
					$('.prgnt').hide();
				}				
			}
			else
			{
				$('.prgnt').hide();
			}
			 
		}
	