<?php
//echo "<pre>".print_r($_REQUEST,1)."</pre>";
?>
<html>
<head>
<style>
.abc { background-color:#fffff}
.abc tr:nth-child(even) {background-color: #E6E6FA !important}
.abc tr:nth-child(odd) {background-color: #FFF}

.sub_que{ padding-right:5px;}
.main_que td{ font-size:18px; color:#0000c1; }



/* Sweep To Right */
.hvr-sweep-to-right {
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  box-shadow: 0 0 1px transparent;
  position: relative;
  -webkit-transition-property: color;
  transition-property: color;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.hvr-sweep-to-right:before {
  content: "";
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #2098D1;
  -webkit-transform: scaleX(0);
  transform: scaleX(0);
  -webkit-transform-origin: 0 50%;
  transform-origin: 0 50%;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.hvr-sweep-to-right:hover, .hvr-sweep-to-right:focus, .hvr-sweep-to-right:active {
  color: white;
}
.hvr-sweep-to-right:hover:before, .hvr-sweep-to-right:focus:before, .hvr-sweep-to-right:active:before {
  -webkit-transform: scaleX(1);
  transform: scaleX(1);
}

</style>
</head>
<script src="scripts/main_validation.js"></script>
	<script type='text/javascript'>
	
	function SaveTypeOneQuestions()
	 {
				 
		var xmlHttp=newHttpObject();
                if(xmlHttp)
                 {	
                        var mcp_card = "";
                        if(document.getElementById('qone_y').checked)
                         {
                                mcp_card = document.getElementById('qone_y').value;
                         }
                        else if(document.getElementById('qone_n').checked)
                         {
                                mcp_card = document.getElementById('qone_n').value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 1');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById('qone_y').focus();
                                return false;
                         }

			var blood_test = "";		
			if(document.getElementById('qfour_y').checked)
			 {
				blood_test = document.getElementById('qfour_y').value;
			 }
			else if(document.getElementById('qfour_n').checked)
			 {
				blood_test = document.getElementById('qfour_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2(i)');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById('qfour_y').focus();
				return false;
			 }		

                        var urine_test = "";            
                        if(document.getElementById('qfive_y').checked)
                         {
                                urine_test = document.getElementById('qfive_y').value;
                         }
                        else if(document.getElementById('qfive_n').checked)
                         {
                                urine_test = document.getElementById('qfive_n').value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 2(ii)');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById('qfive_y').focus();
                                return false;
                         }

			var blood_pressure = "";		
			if(document.getElementById('qsix_y').checked)
			 {
				blood_pressure = document.getElementById('qsix_y').value;
			 }
			else if(document.getElementById('qsix_n').checked)
			 {
				blood_pressure = document.getElementById('qsix_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2(iii)');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById('qsix_y').focus();
				return false;
			 }		

			var calcium_tablet = "";
			if(document.getElementById('qseven_y').checked)
			 {
				calcium_tablet = document.getElementById('qseven_y').value;
			 }
			else if(document.getElementById('qseven_n').checked)
			 {
				calcium_tablet = document.getElementById('qseven_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2(iv)');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qseven_y").focus();
				return false;
			 }

                        var weight = "";
                        if(document.getElementById('qeight_y').checked)
                         {
                                weight = document.getElementById('qeight_y').value;
                         }
                        else if(document.getElementById('qeight_n').checked)
                         {
                                weight = document.getElementById('qeight_n').value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 2(v)');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById("qeight_y").focus();
                                return false;
                         }
		
			var tt_injection = "";		
			if(document.getElementById('qnine_y').checked)
			 {
				tt_injection = document.getElementById('qnine_y').value;
			 }
			else if(document.getElementById('qnine_n').checked)
			 {
				tt_injection = document.getElementById('qnine_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2(vi)');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qnine_y").focus();
				return false;
			 }

                        var acid_tablet = "";          
                        if(document.getElementById('qten_y').checked)
                         {
                                acid_tablet = document.getElementById('qten_y').value;
                         }
                        else if(document.getElementById('qten_n').checked)
                         {
                                acid_tablet = document.getElementById('qten_n').value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 2(vii)');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById("qten_y").focus();
                                return false;
                         }

                        var food_info = "";          
                        if(document.getElementById('qeleven_y').checked)
                         {
                                food_info= document.getElementById('qeleven_y').value;
                         }
                        else if(document.getElementById('qeleven_n').checked)
                         {
                                food_info = document.getElementById('qeleven_n').value;
                         }
                        else
                         {
                                $('.alert').show();
                                $('.alert_content').html('Please Choose Yes/No For Question 2(viii)');
                                setTimeout(function(){$('.alert').hide();},10000); 
                                document.getElementById("qeleven_y").focus();
                                return false;
                         }
		
			var danger_pregnancy = "";		
			if(document.getElementById('qtwelve_y').checked)
			 {
				danger_pregnancy = document.getElementById('qtwelve_y').value;
			 }
			else if(document.getElementById('qtwelve_n').checked)
			 {
				danger_pregnancy = document.getElementById('qtwelve_n').value;
			 }
			else
			 {
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2(ix)');
                		setTimeout(function(){$('.alert').hide();},10000); 
				document.getElementById("qtwelve_y").focus();
				return false;
			 }

			var risk_prone_pregnancy="";		
			if(document.getElementById('qthirteen_y').checked)
			 {
				risk_prone_pregnancy = document.getElementById('qthirteen_y').value;
			 }
			else if(document.getElementById('qthirteen_n').checked)
			 {
				risk_prone_pregnancy = document.getElementById('qthirteen_n').value;
			 }
			else
			 { 
				$('.alert').show();
                		$('.alert_content').html('Please Choose Yes/No For Question 2(x)');
                		setTimeout(function(){$('.alert').hide();},10000);
				document.getElementById('qthirteen_y').focus();
				return false;
			}
	
			var callQuery = "type=one&call_hit_referenceno=<?=$_REQUEST["CallReferenceID"];?>&call_id="+CallID+"&beneficiary_id=<?=$Beneficiary_Details['ID_No'];?>&agent_id=<?=$_REQUEST["agentid"];?>&mcp_card="+mcp_card+"&blood_test="+blood_test+"&urine_test="+urine_test+"&blood_pressure="+blood_pressure+"&calcium_tablet="+calcium_tablet+"&weight="+weight+"&tt_injection="+tt_injection+"&acid_tablet="+acid_tablet+"&food_info="+food_info+"&danger_pregnancy="+danger_pregnancy+"&risk_prone_pregnancy="+risk_prone_pregnancy+"&beneficiary_num=<?=$Beneficiary_Details['Whom_PhoneNo'];?>&asha_num=<?=$Beneficiary_Details['ASHA_Phone'];?>&anm_num=<?=$Beneficiary_Details['ANM_Phone'];?>&beneficiary_name=<?=$Beneficiary_Details['Name'];?>";
			//alert(callQuery);//return false;
			xmlHttp.open("POST","save_calltype_questions.php",true);
                        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        xmlHttp.send(callQuery);
                        xmlHttp.onreadystatechange=function()
                         {
                                if (xmlHttp.readyState==4 && xmlHttp.status==200)
                                 {
                                        var Response = null;
                                        Response = xmlHttp.responseText;
                                        //alert(Response);

					if(Response)
					 {
						var convox_ivr_ids = Response;
					 }

					if(Response=="")
					{
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE1&FEEDBACK_IVR=N";

					}
					else
					{
						var end_call_url = "http://<?=$GLOBALS["host_ip"];?>/ConVox3.0/Agent/callcontrol.php?ACTION=CLOSE&convoxid=<?=$_REQUEST["convoxuid"];?>&agent_id=<?=$_REQUEST["agentid"];?>&disposition=CALLTYPE1&FEEDBACK_IVR=Y&convox_ivr_ids="+convox_ivr_ids;
					}
					//alert(end_call_url);
					postURL(end_call_url,"false");
                                 }
                         }
		 }
		delete xmlHttp;
	 }

	</script>
</head>
<body>
	<form name='type_one' method='POST' >
	<table class="table table-striped abc">
	<thead>
	<tr>
		</tr><tr><th colspan=4>नमस्कार ये काल उत्तर प्रदेश स्वास्थ्य विभाग की ओर से आपके गार्भावस्था में सहयोग प्रदान करने के लिए की जा रही है। आपसे जानना चाहेंगेः</th></tr><tr>
		<th width="2%">S.No</th>
		<th width="">Question</th>
		<th>Result</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>1 </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपको जच्चा-बच्चा सुरक्षा कार्ड (एम०सी०पी०) मिल गया है</td>
		<td><input type="radio" name="qone" id="qone_y" value="Yes" >Yes <input type="radio" name="qone" id="qone_n" value="No" >No</td>
	</tr>
	<tr>
		<td>2 </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'>गर्भावस्था के दौरान होने वाली जांचें-</td>
		<td> </td>
	</tr>
	<tr>
		<td>i </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपकी खून की जांच हो गई है</td>
		<td><input type="radio" name="qfour" id="qfour_y" value="Yes" >Yes <input type="radio" name="qfour" id="qfour_n" value="No" >No</td>
	</tr>
        <tr>
                <td>ii </td>
                <td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपके पेशाब की जांच हो गई है</td>
                <td><input type="radio" name="qfive" id="qfive_y" value="Yes" >Yes <input type="radio" name="qfive" id="qfive_n" value="No" >No</td>
        </tr>
	<tr>
		<td>iii </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपके बी०पी की जांच हो गई है</td>
		<td><input type="radio" name="qsix" id="qsix_y" value="Yes" >Yes <input type="radio" name="qsix" id="qsix_n" value="No" >No</td>
	</tr>
	<tr>
		<td>iv </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपको कैल्शियम की गोलियाँ मिली हैं</td>
		<td><input type="radio" name="qseven" id="qseven_y" value="Yes" >Yes <input type="radio" name="qseven" id="qseven_n" value="No" >No</td>
	</tr>
        <tr>
                <td>v </td>
                <td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपका वजन मांपा गया है</td>
                <td><input type="radio" name="qeight" id="qeight_y" value="Yes" >Yes <input type="radio" name="qeight" id="qeight_n" value="No" >No</td>
        </tr>
	<tr>
		<td>vi </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपको टी०टी० टेटेनस की सुई लग गई है</td>
		<td><input type="radio" name="qnine" id="qnine_y" value="Yes" >Yes <input type="radio" name="qnine" id="qnine_n" value="No" >No</td>
	</tr>
	<tr>
		<td>vii </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपको आयरन फोलिक एसिड की गोलियाँ मिली हैं</td>
		<td><input type="radio" name="qten" id="qten_y" value="Yes" >Yes <input type="radio" name="qten" id="qten_n" value="No" >No</td>
	</tr>
        <tr>
                <td>viii </td>
                <td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपको आशा या ए०एन०एम० ने गर्भावस्था के दौरान आहार (खाना) के बारे में बताया गया है</td>
                <td><input type="radio" name="qeleven" id="qeleven_y" value="Yes" >Yes <input type="radio" name="qeleven" id="qeleven_n" value="No" >No</td>
        </tr>
        <tr>
                <td>ix </td>
                <td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपके गर्भावस्था के दौरान होने वाली जटिलताओं के बारे में बताया गया है-<br> (जैसे अचानक योनि के नीचे के रास्ते से बदबूदार खून आना, अचानक सर दर्द, नजरों में गड़बड़ी एवं धुंधलापन अत्यधिक पेट दर्द,<br> झटके आना, हाथ पैर एवं चेहरे पर सूजन, बुखार एवं बच्चा हिलता-डुलता नहीं है)</td>
                <td><input type="radio" name="qtwelve" id="qtwelve_y" value="Yes" >Yes <input type="radio" name="qtwelve" id="qtwelve_n" value="No" >No</td>
        </tr>
        <tr>
		<td>x </td>
		<td class="hvr-sweep-to-right" style='font-size:18;'>क्या आपको जोखिम व खतरे वाली गर्भावस्था के रूप में चिन्हित किया गया है (एम०सी०पी० कार्ड पर लाल बिन्दु)</td>
		<td><input type="radio" name="qthirteen" id="qthirteen_y" value="Yes" >Yes <input type="radio" name="qthirteen" id="qthirteen_n" value="No" >No</td>
	</tr>
	<tr>
                <td align='center' colspan=3><button type="button" name="save_type_one" id="save_type_one" onclick="SaveTypeOneQuestions();"> Save </button></td>
        </tr>	
			
	</table>
	</form>
</body>
</html>
