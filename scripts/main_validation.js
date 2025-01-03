//Ajax Function

newHttpObject = function()
{
  var xmlHttp=null;
  try
  {
   // Firefox, Opera 8.0+, Safari
   xmlHttp=new XMLHttpRequest();
  }
  catch (e)
   {
    // Internet Explorer
    try
     {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
     }
    catch (e)
     {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
     }
   }
  return xmlHttp;
}

//clear Fields

function clearFields(element)
 { 

    for (var i = 0; i < element.childNodes.length; i++)
     {
          var e = element.childNodes[i];
	  if (e.tagName) switch (e.tagName.toLowerCase())
	   {
	    case 'input':
            switch (e.type)
             {
               case "radio":
               case "checkbox": e.checked = false; break;
               case "button":
               case "submit":
               case "image": break;
               default: e.value = ''; break;
             }
            break;
            case 'textarea': e.value = ''; break;
		 case 'select': e.selectedIndex = 0; break;
            default: clearFields(e);
      	  }
    }
  
 }

function isExists(field_name,table_name,column_name,primary_key_column,primary_key_value,submit_form)
 {
	var xmlHttp=newHttpObject();
	if(xmlHttp)
	 {
		callQuery="table_name="+table_name+"&primary_key_column="+primary_key_column+"&primary_key_value="+primary_key_value+"&column_name="+column_name+"&field_name_value="+document.getElementById(field_name).value;
		//alert(callQuery);
		xmlHttp.open('POST','Module/main_validation.php');
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlHttp.send(callQuery); 
		xmlHttp.onreadystatechange = function() 
		 { 	
			if((xmlHttp.readyState == 4)&&(xmlHttp.status==200))
			 {
				var Response = null;
				Response = xmlHttp.responseText;
				//alert(Response);
				if(Response)
				 {
					document.getElementById(field_name+"_span").innerHTML=Response;
					document.getElementById(submit_form).disabled=true;
				 }
				else
				 {
					document.getElementById(field_name+"_span").innerHTML="";
					document.getElementById(submit_form).disabled=false;
				 }
			}
		 }
		delete xmlHttp;
	  }
 }

function allowValidKey(evt,type)
  {

	var key= evt.which?evt.which:evt.keyCode;
	var str=String.fromCharCode(key);
	
	if((evt.keyCode>=37&&evt.keyCode<=40)||evt.keyCode==8||evt.keyCode==46||(evt.keyCode==13&&type=="text"))
	 {return true;}//allowing arrow keys , delete key and enter key
	 
	switch(type)
	 {
 	
 		case 'id':var reg=/[a-zA-Z0-9\b\t_.]/;break;
 		
 		case 'name':var reg=/[a-zA-Z0-9\b\t\ \-_.]/;break;
 		
		case 'callername':var reg=/[a-zA-Z\/\\b\t\ ]/;break;

		case 'benificiarydata':var reg=/[a-zA-Z0-9\b\t]/;break;

 		case 'context':var reg=/[a-zA-Z0-9\b\t\-]/;break;
 		
 		case 'pass':var reg=/[a-zA-Z0-9\b\t\@\-_.]/;break;
		
 		case 'number':var reg=/[0-9\b\t]/;break;

 		case 'age':var reg=/[0-9\b\t\.]/;break;
 		
		case 'dt':var reg=/[0-9\-\b\t]/;break;
 		
 		case 'ip':var reg=/[0-9\b\t\.]/;break;
 		
 		case 'dahdi_id':var reg=/[gr0-9\b\t]/;break;
 		
 		case 'text':var reg=/[a-zA-Z0-9\b\t\n\-_@.:,*!$%&()\[\]=+?\/{}\ ]/;break;

		case 'email':var reg=/[a-z0-9_.\@\b\t]/;break;
		
		case 'multinum':var reg=/[0-9,\b\t]/;break;
 	
	  }

 	return reg.test(str);
	
 }

function AgeLimit(AgeValue,AgeID,AgeType)
 {// alert(3);
 //alert(AgeValue);
 //alert(AgeID);
 //alert(AgeType);
        if(AgeValue > 120 && AgeType == "YEAR")
         {
               // document.getElementById(AgeID+"_span").innerHTML = "Age Should be Less Than Or Equal To 120 Years";
                document.getElementById(AgeID).value = AgeValue.slice(0, -1);      
         }
	else if(AgeValue > 12 && AgeType == "MONTH")
	 {
                //document.getElementById(AgeID+"_span").innerHTML = "Age Should be Less Than Or Equal To 12 Months";
                document.getElementById(AgeID).value = AgeValue.slice(0, -1);      
	 }
	else if(AgeValue > 31 && AgeType == "days")
	 {
                //document.getElementById(AgeID+"_span").innerHTML = "Age Should be Less Than Or Equal To 31 Days";
                document.getElementById(AgeID).value = AgeValue.slice(0, -1);      
	 }
	else
	 {
               // document.getElementById(AgeID+"_span").innerHTML = "";
	 } 
 }

function postURL(url,current_window)
 {	
	var form = document.createElement("FORM");
	form.method = "POST";
	form.style.display = "none";
	if(current_window != "true" && current_window != "false")
	 {
		form.target=current_window;
	 }
	else if(current_window == "true")
	 {
		form.target="_blank";
	 }
	document.body.appendChild(form);
	form.action = url.replace(/\?(.*)/, function(_, urlArgs) {
	urlArgs.replace(/\+/g, " ").replace(/([^&=]+)=([^&=]*)/g, function(input, key, value) {
	input = document.createElement("INPUT");
	input.type = "hidden";
	input.name = decodeURIComponent(key);
	input.value = decodeURIComponent(value);
	form.appendChild(input);
	});
	return "";
	});
	form.submit();
 }

function openWindowpostURL(url,windowName,windowOption)
 {
	var form = document.createElement("FORM");
	form.method = "POST";
	form.style.display = "none";
	form.target=windowName;
	document.body.appendChild(form);
	form.action = url.replace(/\?(.*)/, function(_, urlArgs) {
	urlArgs.replace(/\+/g, " ").replace(/([^&=]+)=([^&=]*)/g, function(input, key, value) {
	input = document.createElement("INPUT");
	input.type = "hidden";
	input.name = decodeURIComponent(key);
	input.value = decodeURIComponent(value);
	form.appendChild(input);
	});
	return "";
	});
	var openedWindow = window.open("", windowName, windowOption);
	form.submit();
	openedWindow.focus();
 }
