

  <script src="js/jquery-1.10.2.min.js"></script>

 <script>
$(document).ready(function(){ 
		var xml = "9000916708";
		$.post("abc.php",{phone:xml},function(data){ var res = data.split("@@#P@I@G@@"); $('#lat').val(res[0]);$('#long').val(res[1]);$('#addres').val(res[2]); });
	}); 
	
	</script>
	
	<input type="text" id="lat" />
	<input type="text" id="long" />
	<input type="text" id="addres" />
