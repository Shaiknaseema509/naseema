<?php 

require_once("dbconnect_emri.php");

$call_id 	= $_REQUEST['callid'];

$CALL_TYPE_ARRAY = array();
$call_type_query = "SELECT call_type_id, call_type_name FROM m_call_type  WHERE is_active=1;";
$call_type_result = mysql_query($call_type_query);
while($call_type_details = mysql_fetch_array($call_type_result))
 {
        $CALL_TYPE_ARRAY[$call_type_details["call_type_id"]] = $call_type_details["call_type_name"];
 }


$Query1  = "SELECT * FROM Call_benificiary WHERE callid=".$call_id." ORDER BY service_type,advice_time;";
$Result1 = mysql_query($Query1); 

//medical
$Query2	= "SELECT MA.callid, MAC.category_name, MASC.subcategory_name, MAQ.question, MAR.response FROM medical_advice as MA LEFT JOIN registration AS R ON MA.callid=R.call_id  LEFT JOIN m_medicaladivce_category AS MAC ON MAC.category_id = MA.category_id LEFT JOIN m_medicaladivce_subcategory AS MASC ON MASC.subcategory_id = MA.subcategory_id LEFT JOIN m_medicaladivce_questions AS MAQ ON MAQ.question_id = MA.question_id LEFT JOIN m_medicaladivce_question_response AS MAR ON MAR.response_id = MA.response_id WHERE MA.callid ='".$call_id."';";
$Result2 = mysql_query($Query2);

//councelling
$Query3 = "SELECT C.callid, CC.category_name, CSC.subcategory_name, CQ.question, CR.response FROM counselling AS C LEFT JOIN registration AS R ON C.callid=R.call_id  LEFT JOIN m_counseling_category AS CC ON CC.category_id = C.category_id LEFT JOIN  m_counseling_subcategory AS CSC ON CSC.subcategory_id = C.subcategory_id LEFT JOIN m_counseling_questions AS CQ ON CQ.question_id = C.question_id LEFT JOIN m_counseling_question_response AS CR ON CR.response_id = C.response_id WHERE C.callid ='".$call_id."'";
$Result3 = mysql_query($Query3);

//grievance
$Query4  = "SELECT grievance_type, nature, brief_application FROM grievance WHERE call_id ='".$call_id."';";
$Result4 = mysql_query($Query4);

//information govt scheme
$Query5  = "SELECT GS.Scheme FROM m_government_schemes AS GS JOIN govt_scheme_result AS GSR ON GS.id=GSR.govt_schemes_id WHERE GSR.call_id='".$call_id."';";
$Result5 = mysql_query($Query5);

//information Directory
//$Query6  = "";
//$Result6 = mysql_query($Query6);
?>
<html>
<head>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/custom.css" rel="stylesheet" />

        <style>

        .main
         {
                width: 1000px;
                padding-bottom: 0px;
                border-top: 0px;
                background-color: #FDFDFD;
                margin-left: auto;
                margin-right: auto;
                min-height: 412px;
                height: auto !important;
                box-shadow: 0 3px 3px rgba(104, 104, 104, 0.25);
                margin-top: 15px;
                margin-bottom: 15px;
         }

        </style>

        <script>
                
        </script>
</head>
<body>
        <div class="container">
        <div class="x_content" style="margin-top: 12px;">
        <div class="form-group">
        <?
	echo "<table class='table table-bordered table-hover table-striped'>";
	echo "<thead><tr>";
	echo "<th nowrap> Advice By</th>";
	echo "<th nowrap> Advice Sought By</th>";
	echo "<th nowrap> Past History</th>";
	echo "<th nowrap> Presenet Complaint</th>";
	echo "<th nowrap> Advice </th>";
	echo "</tr></thead>";

	if(mysql_num_rows($Result1) > 0)
         {
		while($Details1 = mysql_fetch_array($Result1))
		 {
			if($Details1["service_type"]==2)
			 {
			 	echo "<th>Medical</th>";
			 }
			elseif($Details1["service_type"]==3)
			 {
			 	echo "<th>Councelling</th>";
			 }
			elseif($Details1["service_type"]==4)
			 {
			 	echo "<th>Grievance</th>";
			 }
			elseif($Details1["service_type"]==5)
			 {
			 	echo "<th> Information Directory</th>";
			 }
			elseif($Details1["service_type"]==6)
			 {
			 	echo "<th> Information Govt Schemes</th>";
			 }
			echo "<tr>";
                                echo "<td>".$Details1["advice_by"]."</td>";
                                echo "<td>".$Details1["addvice_sought_by"]."</td>";
                                echo "<td>".$Details1["Past_history"]."</td>";
                                echo "<td>".$Details1["present_symptoms"]."</td>";
                                echo "<td>".$Details1["advice"]."</td>";
                        echo "</tr>";
		}	
	 }
	else
         {
                echo "<tr><td colspan='16' align='center' ><font color='red' size=2><b>No Records Found</b></font></td></tr>";
         }

	if(mysql_num_rows($Result2) > 0)
         {
		echo "<table class='table table-bordered table-hover table-striped'>";
		echo "<thead><tr>";
		echo "<th>Medical</th></tr><tr>";
		echo "<th nowrap>Sno </th>";
		echo "<th nowrap>Category</th>";
		echo "<th nowrap>Sub Category </th>";
		echo "<th nowrap>Question </th>";
		echo "<th nowrap>Response </th>";
		echo "</tr></thead>";
		$sno =1;
		while($Details2 = mysql_fetch_array($Result2))
		 {	
                        echo "<tr>";
				echo "<td>".$sno."</td>";
                                echo "<td>".$Details2["category_name"]."</td>";
                                echo "<td>".$Details2["subcategory_name"]."</td>";
                                echo "<td>".$Details2["question"]."</td>";
                                echo "<td>".$Details2["response"]."</td>";
                        echo "</tr>";
			$sno++;
		 }                        
	        
        	echo "</table>";
	}
	if(mysql_num_rows($Result3) > 0)
	 {
		echo "<table class='table table-bordered table-hover table-striped'>";
                echo "<thead><tr>";
                echo "<th>Councelling</th></tr><tr>";
                echo "<th nowrap>Sno </th>";
                echo "<th nowrap>Category</th>";
                echo "<th nowrap>Sub Category </th>";
                echo "<th nowrap>Question </th>";
                echo "<th nowrap>Response </th>";
                echo "</tr></thead>";
                $sno =1;
                while($Details3 = mysql_fetch_array($Result3))
                 {
                        echo "<tr>";
                                echo "<td>".$sno."</td>";
                                echo "<td>".$Details3["category_name"]."</td>";
                                echo "<td>".$Details3["subcategory_name"]."</td>";
                                echo "<td>".$Details3["question"]."</td>";
                                echo "<td>".$Details3["response"]."</td>";
                        echo "</tr>";
                        $sno++;
                 }

                echo "</table>";
	 }
	if(mysql_num_rows($Result4) > 0)
	 {
		echo "<table class='table table-bordered table-hover table-striped'>";
                echo "<thead><tr>";
                echo "<th>Grievance</th></tr><tr>";
                echo "<th nowrap>Sno </th>";
                echo "<th nowrap>Grievance Type</th>";
                echo "<th nowrap>Nature </th>";
                echo "<th nowrap>Brief Application </th>";
                echo "</tr></thead>";
                $sno =1;
                while($Details4 = mysql_fetch_array($Result4))
                 {
                        echo "<tr>";
                                echo "<td>".$sno."</td>";
                                echo "<td>".$Details4["grievance_type"]."</td>";
                                echo "<td>".$Details4["nature"]."</td>";
                                echo "<td>".$Details4["brief_application"]."</td>";
                        echo "</tr>";
                        $sno++;
                 }

                echo "</table>";
	 }
	if(mysql_num_rows($Result5) > 0)
	 {
		echo "<table class='table table-bordered table-hover table-striped'>";
                echo "<thead><tr>";
                echo "<th>Infromation Govt Schemes</th></tr><tr>";
                echo "<th nowrap>Sno </th>";
                echo "<th nowrap>Schemes</th>";
                echo "</tr></thead>";
                $sno =1;
                while($Details5 = mysql_fetch_array($Result5))
                 {
                        echo "<tr>";
                                echo "<td>".$sno."</td>";
                                echo "<td>".$Details5["Scheme"]."</td>";
                        echo "</tr>";
                        $sno++;
                 }

                echo "</table>";
	 }

?>
</div>
</body>
</html>
