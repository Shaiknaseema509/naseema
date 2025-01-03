<?php 

require_once("dbconnect_emri.php");

/*if($enable_post_check == "Y")
 {
        if($_SERVER["REQUEST_METHOD"]!="POST")
         {
                exit("In-Valid Request..");
         }
 }
*/
//echo "<pre>".print_r($_POST,1)."</pre>";


$call_id 	= $_REQUEST['callid'];

$CALL_TYPE_ARRAY = array();
$call_type_query = "SELECT call_type_id, call_type_name FROM m_call_type  WHERE is_active=1;";
$call_type_result = mysql_query($call_type_query);
while($call_type_details = mysql_fetch_array($call_type_result))
 {
        $CALL_TYPE_ARRAY[$call_type_details["call_type_id"]] = $call_type_details["call_type_name"];
 }

$Query1  = "SELECT advice_by, addvice_sought_by, Past_history, present_symptoms, advice FROM Call_benificiary WHERE callid=".$call_id;
$Result1 = mysql_query($Query1); 

$Query2	= "SELECT MA.callid, MAC.category_name, MASC.subcategory_name, MAQ.question, MAR.response FROM medical_advice as MA LEFT JOIN registration AS R ON MA.callid=R.call_id  LEFT JOIN m_medicaladivce_category AS MAC ON MAC.category_id = MA.category_id LEFT JOIN m_medicaladivce_subcategory AS MASC ON MASC.subcategory_id = MA.subcategory_id LEFT JOIN m_medicaladivce_questions AS MAQ ON MAQ.question_id = MA.question_id LEFT JOIN m_medicaladivce_question_response AS MAR ON MAR.response_id = MA.response_id WHERE MA.callid ='".$call_id."'";
$Result1 = mysql_query($Query1);

$Query3	= "SELECT C.callid, CC.category_name, CSC.subcategory_name, CQ.question, CR.response FROM counselling AS C LEFT JOIN registration AS R ON C.callid=R.call_id  LEFT JOIN m_counseling_category AS CC ON CC.category_id = C.category_id LEFT JOIN  m_counseling_subcategory AS CSC ON CSC.subcategory_id = C.subcategory_id LEFT JOIN m_counseling_questions AS CQ ON CQ.question_id = C.question_id LEFT JOIN m_counseling_question_response AS CR ON CR.response_id = C.response_id WHERE C.callid ='".$call_id."'";
$Result3 = mysql_query($Query3);

$Query4 = $Query2." UNION ".$Query3;
$Result4 = mysql_query($Query4);

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
                $sno = 1;
                while($Details = mysql_fetch_array($Result1))
                 {
                        echo "<tr>";
                                echo "<td>".$Details["advice_by"]."</td>";
                                echo "<td>".$Details["addvice_sought_by"]."</td>";
                                echo "<td>".$Details["Past_history"]."</td>";
                                echo "<td>".$Details["present_symptoms"]."</td>";
                                echo "<td>".$Details["advice"]."</td>";
                        echo "</tr>";
                        $sno++;
                 }
         }
        else
         {
                echo "<td colspan='16' align='center' ><font color='red' size=2><b>No Records Found</b></font></td>";
         }

	echo "</table>";
        
	echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead><tr>";
                echo "<th nowrap>Sno</th>";
                echo "<th nowrap>Category</th>";
                echo "<th nowrap>Sub Category</th>";
                echo "<th nowrap >Question</th>";
                echo "<th nowrap >Response</th>";
        echo "</tr></thead>";

	if(mysql_num_rows($Result4) > 0)
         {
                $sno = 1;
                while($Details = mysql_fetch_array($Result4))
                 {
                        echo "<tr>";
                                echo "<td>".$sno."</td>";
                                echo "<td>".$Details["category_name"]."</td>";
                                echo "<td>".$Details["subcategory_name"]."</td>";
                                echo "<td>".$Details["question"]."</td>";
                                echo "<td>".$Details["response"]."</td>";
                        echo "</tr>";
                        $sno++;
                 }
         }
        else
         {
                echo "<td colspan='16' align='center' ><font color='red' size=2><b>No Records Found</b></font></td>";
         }
        echo "</table>";

?>
</div>
</body>
</html>
