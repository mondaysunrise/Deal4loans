<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'incred_api_functions.php';

//print_r($_POST);
//echo "<br><br>";
 $requestid = FixString($_POST["requestid"]);
 	$doc_type = FixString($_POST["doc_type"]);
//$cfile = new CURLFile($_FILES['uploadfile']['tmp_name'],$_FILES['uploadfile']['type'],$_FILES['uploadfile']['name']);
/***************This is for bank statement*******************/
$UploadFile = $_FILES["uploadFile"]["name"];
$fileSize = $_FILES["uploadFile"]["size"] / 1024;
$fileType = $_FILES["uploadFile"]["type"];
$fileTmpName = $_FILES["uploadFile"]["tmp_name"];
$FirstFileUploadDetails=$fileTmpName.",".$fileType.",".$UploadFile.",".$fileSize;

/***************This is for bank statement END*******************/
/***************This is for KYC document*******************/
$uploadFile_another = $_FILES["uploadFile_another"]["name"];
$fileSizeAnother = $_FILES["uploadFile_another"]["size"] / 1024;
$fileTypeAnother = $_FILES["uploadFile_another"]["type"];
$fileTmpNameAnother = $_FILES["uploadFile_another"]["tmp_name"];
$secondFileUploadDetails=$fileTmpNameAnother.",".$fileTypeAnother.",".$uploadFile_another.",".$fileSizeAnother;
/***************This is for bank statement END*******************/

$Dated = ExactServerdate();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $requestid = FixString($_POST["requestid"]);
    $loan_amount = FixString($_POST["loan_amount"]);
    $name = FixString($_POST["name"]);
    $NameArr = explode(" ", $name);
    $FirstName = current($NameArr);
    $midName = next($NameArr);
    $EndName = end($NameArr);
    $LastName = $midName . " " . $EndName;
    $source = FixString($_POST["source"]);
    $dob = FixString($_POST["dob"]);
    $DObVal = date("d/m/Y", strtotime($dob));
    $City = FixString($_POST["City"]);
    $Email = FixString($_POST["Email"]);
    $Mobile_Number = FixString($_POST["Mobile_Number"]);
    $gender = FixString($_POST["gender"]);
    if ($gender == 2) {
        $GenderVal = "M";
    } else {
        $GenderVal = "F";
    }
    $panno = FixString($_POST["panno"]);
    $ResAddress = FixString($_POST["ResAddress"]);
    $Respincode = FixString($_POST["Respincode"]);
    $company_name = FixString($_POST["company_name"]);
    $salary = FixString($_POST["GrossMonthly"]);
    $pl_bank_name = FixString($_POST["pl_bank_name"]);
    $net_salary = $salary * 12;
    $BankName = FixString($_POST["BankName"]);
    $city = $City;
    $designation = FixString($_POST["designation"]);
    $joinmonth = FixString($_POST["joinmonth"]);
    $joinyear = FixString($_POST["joinyear"]);
    $FromDate = $joinmonth . "/" . $joinyear;
    $OfficeAddress = FixString($_POST["OfficeAddress"]);
    $OfficeCity = FixString($_POST["OfficeCity"]);
    $office_state = FixString($_POST["office_state"]);
    $OfficePincode = FixString($_POST["OfficePincode"]);
    $salary_type = FixString($_POST["salary_type"]);
    $ACCOUNT_HOLDER_NAME  = FixString($_POST["AccHolderName"]);
    $ACCOUNT_NUM = FixString($_POST["AccNumber"]);
    $ACCOUNT_TYPE = FixString($_POST["account_type"]);
	$Operatemonth = FixString($_POST["Operatemonth"]);
	$Operateyear = FixString($_POST["Operateyear"]);
	$OperateSince = $Operatemonth . "/" . $Operateyear;
   // $OperateSince = FixString($_POST["OperateSince"]);
    $PrimaryFlag = FixString($_POST["PrimaryFlag"]);
	$doc_name = FixString($_POST["doc_name"]);

	if($doc_type=="PL_IN_ADR_PRF")
		{
			$residence_proof =$uploadPathAnother;
			$identification_proof="";
		}
	else
		{
			$identification_proof =$uploadPathAnother;
			$residence_proof="";
		}
	
	if($salary_type=="CASH"){ $salary_drawn="1";} elseif($salary_type=="CHEQUE"){$salary_drawn="2";} elseif($salary_type=="NEFT"){$salary_drawn="3";}
    $dataarray = array("Loan_Amount" => $loan_amount, "Name" => $name, "DOB" => $dob, "Gender" => $gender, "Pancard" => $panno, "Residence_Address" => $ResAddress, "Pincode" => $Respincode, "Company_Name" => $company_name, "Net_Salary" => $net_salary, "PL_Bank" => $BankName, "Salary_Drawn" =>$salary_drawn, "ex_source"=>$FromDate, "PL_Tenure"=>$OperateSince, "Holding_Current_Account"=>$PrimaryFlag, "income_proof"=>$uploadPath, "identification_proof"=>$identification_proof ,"residence_proof"=>$residence_proof );
    $wherecondition = "(Req_Loan_Personal.RequestID=" . $requestid . ")";
    $rowcount = Mainupdatefunc("Req_Loan_Personal", $dataarray, $wherecondition);
	
	$arrayInCredExclusive = array("designation"=>$designation, "office_address"=>$OfficeAddress, "office_city"=>$OfficeCity, "office_state"=>$office_state, "office_pincode"=>$OfficePincode, "account_holder_name"=>$ACCOUNT_HOLDER_NAME, "account_number"=>$ACCOUNT_NUM, "account_type"=>$ACCOUNT_TYPE, "doc_type"=>$doc_type, "doc_name"=>$doc_name);
	//print_r($arrayInCredExclusive);

	foreach($arrayInCredExclusive as $key => $value) {
    //do something with your $key and $value;   
	$arrayInsertInCredExclusive= array("lead_id"=>$requestid, "bank_code"=>"86", "attribute_name"=>$key, "attribute_value"=>$value, "status"=>"1");
	$insert = Maininsertfunc ('lead_personal_loan_attributes', $arrayInsertInCredExclusive);
	//print_r($arrayInsertInCredExclusive);
}
	
	$extraarray=array("DATA_ENTRY_TYPE"=>$DATA_ENTRY_TYPE, "FILE_PATH"=>$uploadPath, "FILE_TYPE"=>$FirstFileUploadDetails, "FILE_TYPE_ANOTHER"=>$secondFileUploadDetails, "FILE_PATH_ANOTHER"=>$uploadPathAnother);
	$PostArray=array_merge($_POST,$extraarray);

//print_r($PostArray);
if($requestid>0)
	{
	IncredApplicationCreate($PostArray);
	}
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
                <meta name="viewport" content="width=device-width, initial-scale=1" /> 
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Apply for Personal Loan  | Personal Loan Application | Personal Loans Comparison Chart</title>
                <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
                    <meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
                        <meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
                            <link href="source.css" rel="stylesheet" type="text/css" />
                            <link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
                            <script type="text/javascript" src="scripts/common.js"></script>
                            </head>
                            <body>
                                <?php include "middle-menu.php"; ?>
                                <div style="clear:both;"></div>
                                <div class="lac-main-wrapper">
                                    <div class="text12" style="margin:auto; width:height:11px; margin-top:70px; color:#0a8bd9;"></div>
                                    <div style="clear:both; height:1px;"></div>
                                    <div style="clear:both; width:margin:auto;  margin-top:25px;">
                                        <div id="container">
                                            <div id="txt"  style="padding-top:15px; height:60px;">
                                                <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Personal Loan from <? echo $pl_bank_name; ?> through Deal4loans.com </h1>
                                            </div>
                                        </div>
                                        <div style="clear:both; height:80px; width:964px; margin:auto; margin-top:10px;"></div>
                                    </div>
                                </div>
                                <?php include "footer_sub_menu.php"; ?>
                            </body>
                            </html>