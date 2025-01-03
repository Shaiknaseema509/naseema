<?php
require_once("dbconnect_emri.php");
$action = $_REQUEST["ACTION"];
$register_details = $_REQUEST["register_details"];

if($action == 'GetRegPhoneNumberDetails')
{
	$queryDetails = "SELECT beneficiary_name,benificiery_surname,age,Gender,mother,district_id,block_id,village_id,language_id,caste_id,education_id,occupation_id,marital_status_id,relationship_id,registration_id,aadhar_uid_no,address,age_type FROM registration WHERE registration_id='".$register_details."' LIMIT 1";
        $Beneficiary_details_query= mysql_query($queryDetails);
        $Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query); 
}
elseif($action == 'GetBeneficiaryDetails')
{
	$queryDetails = "SELECT beneficiary_name,benificiery_surname,age,Gender,mother,district_id,block_id,village_id,language_id,caste_id,education_id,occupation_id,marital_status_id,relationship_id,registration_id,aadhar_uid_no,address,age_type FROM registration WHERE registration_id='".$register_details."' LIMIT 1";
        $Beneficiary_details_query= mysql_query($queryDetails);
        $Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);
}
elseif($action == 'GetAadharDetails')
{
	$queryDetails = "SELECT beneficiary_name,benificiery_surname,age,Gender,mother,district_id,block_id,village_id,language_id,caste_id,education_id,occupation_id,marital_status_id,relationship_id,registration_id,aadhar_uid_no,address,age_type FROM registration WHERE registration_id='".$register_details."' LIMIT 1";
        $Beneficiary_details_query= mysql_query($queryDetails);
        $Beneficiary_Details = mysql_fetch_array($Beneficiary_details_query);
}
	$paraBN.=$Beneficiary_Details['beneficiary_name'];
	$paraBS.=$Beneficiary_Details['benificiery_surname'];
        $paraAGE.=$Beneficiary_Details['age'];
        $paraGEN.=$Beneficiary_Details['Gender'];
	$paraMOT.=$Beneficiary_Details['mother'];
        $paraBID.=$Beneficiary_Details['registration_id'];
	$paraUID.=$Beneficiary_Details['aadhar_uid_no'];
	$paraADD.=$Beneficiary_Details['address'];
    
	$stmtDIST="SELECT ds_dsid,ds_lname FROM m_district WHERE is_active=1 ORDER BY ds_lname ASC";
	$resultDIST=mysql_query($stmtDIST);
	$paraDIST="<option value=''>--Pickup District--</option>";   
	while($row=mysql_fetch_array($resultDIST))
	{
		$SEL = ($Beneficiary_Details['district_id']==$row["ds_dsid"])?"selected":"";
		$paraDIST.= "<option value='".$row["ds_dsid"]."~".$row["ds_lname"]."' $SEL >".$row["ds_lname"]."</option>";
	
	}

	$stmtTEH="SELECT md_mdid,md_lname FROM m_mandal WHERE is_active=1 AND md_dsid='".$Beneficiary_Details["district_id"]."' ORDER BY md_lname ASC;";
	$resultTEH=mysql_query($stmtTEH);
	$paraTEH="<option value=''>--Pickup Tehsil--</option>";   
	while($row=mysql_fetch_array($resultTEH))
	{
		$SEL = ($Beneficiary_Details['block_id']==$row["md_mdid"])?"selected":"";
                $paraTEH.= "<option value='".$row["md_mdid"]."~".$row["md_lname"]."' $SEL >".$row["md_lname"]."</option>";
	}
    
	$stmtVILL="SELECT ct_ctid,ct_lname FROM m_city WHERE is_active=1 AND ct_mdid='".$Beneficiary_Details["block_id"]."' ORDER BY ct_lname ASC;";
	$resultVILL=mysql_query($stmtVILL);
	$paraVILL="<option value=''>--Pickup Village--</option>";   
	while($row=mysql_fetch_array($resultVILL))
	{
		$SEL = ($Beneficiary_Details['village_id']==$row["ct_ctid"])?"selected":"";
		$paraVILL.= "<option value='".$row["ct_ctid"]."~".$row["ct_lname"]."' $SEL >".$row["ct_lname"]."</option>";
	}

        $stmtLANG="SELECT lang_id,language FROM m_language WHERE is_active=1 ORDER BY lang_id ASC;";
        $resultLANG=mysql_query($stmtLANG);
        $paraLANG.= "<option value=''>--Select Language--</option>";
        while($row=mysql_fetch_array($resultLANG))
        {
		$SEL = ($Beneficiary_Details['language_id']==$row["lang_id"])?"selected":"";
                $paraLANG.= "<option value='".$row["lang_id"]."~".$row["language"]."' $SEL >".$row["language"]."</option>";
        }

        $stmtCAST="SELECT caste_id,caste_name FROM m_caste WHERE is_active=1";
        $resultCAST=mysql_query($stmtCAST);
        $paraCAST.= "<option value=''>--Select Caste--</option>";
        while($row=mysql_fetch_array($resultCAST))
        {
		$SEL = ($Beneficiary_Details['caste_id']==$row["caste_id"])?"selected":"";
                $paraCAST.= "<option value='".$row["caste_id"]."~".$row["caste_name"]."' $SEL >".$row["caste_name"]."</option>";
        }

        $stmtEDU="SELECT education_id,education_type FROM m_education WHERE is_active=1";
        $resultEDU=mysql_query($stmtEDU);
        $paraEDU.= "<option value=''>--Select Education--</option>";
        while($row=mysql_fetch_array($resultEDU))
        {
		$SEL = ($Beneficiary_Details['education_id']==$row["education_id"])?"selected":"";
                $paraEDU.= "<option value='".$row["education_id"]."~".$row["education_type"]."' $SEL >".$row["education_type"]."</option>";
        }

        $stmtOCC="SELECT occupation_id,occupation_name FROM m_occupation WHERE is_active=1";
        $resultOCC=mysql_query($stmtOCC);
        $paraOCC.= "<option value=''>--Select Occupation--</option>";
        while($row=mysql_fetch_array($resultOCC))
        {
		$SEL = ($Beneficiary_Details['occupation_id']==$row["occupation_id"])?"selected":"";
                $paraOCC.= "<option value='".$row["occupation_id"]."~".$row["occupation_name"]."' $SEL >".$row["occupation_name"]."</option>";
        }

        $stmtMARR="SELECT maritalstatus_id,maritalstatus_name FROM m_marital_status WHERE is_active=1";
        $resultMARR=mysql_query($stmtMARR);
        $paraMARR.= "<option value=''>--Select Marital Status--</option>";
        while($row=mysql_fetch_array($resultMARR))
        {
		$SEL = ($Beneficiary_Details['marital_status_id']==$row["maritalstatus_id"])?"selected":"";
                $paraMARR.= "<option value='".$row["maritalstatus_id"]."~".$row["maritalstatus_name"]."' $SEL >".$row["maritalstatus_name"]."</option>";
        }

        $stmtREL="SELECT relationship_id,relationship_name FROM m_relationship WHERE is_active=1";
        $resultREL=mysql_query($stmtREL);
        $paraREL.= "<option value=''>--Select Relationship--</option>";
        while($row=mysql_fetch_array($resultREL))
        {
		$SEL = ($Beneficiary_Details['relationship_id']==$row["relationship_id"])?"selected":"";
                $paraREL.= "<option value='".$row["relationship_id"]."~".$row["relationship_name"]."' $SEL >".$row["relationship_name"]."</option>";
        }

	$dob_array=split(",","years,months,days");
	foreach($dob_array as $value)
	 {
		$SEL = ($Beneficiary_Details['age_type']==$value)?"selected":"";
		$paraAgeType.= "<option value='".$value."' $SEL>".$value."</option>";
	 }


	$parameter=$paraBN."$".$paraBS."$".$paraAGE."$".$paraGEN."$".$paraMOT."$".$paraDIST."$".$paraTEH."$".$paraVILL."$".$paraLANG."$".$paraCAST."$".$paraEDU."$".$paraOCC."$".$paraMARR."$".$paraREL."$".$paraBID."$".$paraUID."$".$paraADD."$".$paraAgeType;
	echo $parameter;

?>
