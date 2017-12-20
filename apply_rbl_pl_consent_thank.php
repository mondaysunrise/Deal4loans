<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$Dated = ExactServerdate();
$requestid = FixString($_POST["requestid"]);
$source = FixString($_POST["source"]);
$pl_bank_name = FixString($_POST["pl_bank_name"]);
$rbl_irr = $_REQUEST['rbl_irr'];
$rbl_lnamt = $_REQUEST['rbl_lnamt'];
$rbl_tnrmths = $_REQUEST['rbl_tnrmths'];
$rbl_procfee = $_REQUEST['rbl_procfee'];

if($rbl_tnrmths>0)
{
	$TnrMths = $rbl_tnrmths*12;
}
else
{
	$TnrMths = 36;
}

if($rbl_irr>0)
{
	$IRR = $rbl_irr;
}
else
{
	$IRR = 15;
}

if($rbl_procfee>0)
{
	$ProcFee = $rbl_procfee;
}
else
{
	$ProcFee = 2000;
}

//echo $requestid;
if (strlen($requestid) > 1) {

    $CityArray = array('7' => 'Gurgaon', '15' => 'Hyderabad', '19' => 'Bengaluru', '21' => 'Chennai', '25' => 'Mumbai', '26' => 'Pune', '78' => 'Noida', '87' => 'Ghaziabad', '163' => 'Navi Mumbai', '318' => 'New Delhi', '640' => 'Thane', '981' => 'Faridabad', '1470' => 'Panvel', '704' => 'Greater Noida', '9' => 'Chandigarh', '100' => 'Jaipur', '2002' => 'Ahmedabad', '993' => 'Vadodara', '106' => 'Indore', '69' => 'Coimbatore', '1011' => 'Hubli', '2062' => 'Tumkoor', '135' => 'Nagpur', '94' => 'Secunderabad', '190' => 'Surat', '623' => 'Bhopal', '2087' => 'Hosur', '983' => 'Kolhapur', '989' => 'Salem', '990' => 'Sangli', '2132' => 'Vijayawada', '2248' => 'Vizag', '3053' => 'Chakan');

    $loan_amount = FixString($_POST["loan_amount"]);
    $name = FixString($_POST["name"]);
    $Email = FixString($_POST["Email"]);
    $Mobile_Number = FixString($_POST["Mobile"]);
    $dob = FixString($_POST["dob"]);
    $gender = FixString($_POST["gender"]);
    $qualification = FixString($_POST["qualification"]);
    $panno = FixString($_POST["panno"]);
    $caddress = FixString($_POST["caddress"]);
    $ResCity = FixString($_POST["ResCity"]);

    $CityKey = array_search($ResCity, $CityArray);

    $ResPIN = FixString($_POST["ResPIN"]);
    $ResType = FixString($_POST["ResType"]);
    $CurResSince = FixString($_POST["CurResSince"]);
    $EmpType = FixString($_POST["EmpType"]);
    $company_name = FixString($_POST["company_name"]);
    $OrgCategory = FixString($_POST["OrgCategory"]);
    $TotWrkExp = FixString($_POST["TotWrkExp"]);
    $CurCmpnyJoinDt = FixString($_POST["CurCmpnyJoinDt"]);
    $salary = FixString($_POST["salary"]);
    $net_salary = $salary * 12;

     $nameArr = explode(' ', $name);
    $FirstName = $nameArr[0];
    $countArr = count($nameArr);
    if ($countArr == 1) {
        $LastName = "Kumar";
    } else if ($countArr == 2) {
        $LastName = $nameArr[1];
		$MiddleName="";
    } else {
        $MiddleName = $nameArr[1];
        $LastName = $nameArr[2];
    }

    $dobFormat = date("d-m-Y", strtotime($dob)); // For API FORMAT
    $CurResSinceFormat = date("d-m-Y", strtotime($CurResSince)); // For API FORMAT
    $CurCmpnyJoinDtFormat = date("d-m-Y", strtotime($CurCmpnyJoinDt)); // For API FORMAT

    if (strlen($pl_bank_name) > 1 && $requestid > 1) {
        $dataUpdate = array('Name' => $name, 'Email' => $Email, 'City' => $ResCity, 'Mobile_Number' => $Mobile_Number, 'DOB' => $dob, 'Gender' => $gender, 'Pancard' => $panno, 'Loan_Amount' => $loan_amount, 'Company_Name' => $company_name, 'Residence_Address' => $caddress, 'Pincode' => $ResPIN, 'Total_Experience' => $TotWrkExp, 'Residential_Status' => $ResType, 'Company_Type' => $OrgCategory, 'Net_Salary' => $net_salary, 'Dated' => $Dated);
        $wherecondition = "(Req_Loan_Personal.RequestID=" . $requestid . ")";
        $UpdateProductValue = Mainupdatefunc("Req_Loan_Personal", $dataUpdate, $wherecondition);

        $arrayRBL = array("CurCmpnyJoinDt" => $CurCmpnyJoinDt, "CurResSince" => $CurResSince, "qualification" => $qualification);
        foreach ($arrayRBL as $key => $value) {
            //do something with your $key and $value;   
            $arrayInsertRBL = array("lead_id" => $requestid, "bank_code" => "68", "attribute_name" => $key, "attribute_value" => $value, "status" => "1");
            $insert = Maininsertfunc('lead_personal_loan_attributes', $arrayInsertRBL);
        }

//RBL API 
        if (strlen($name) > 1 && strlen($Mobile_Number) > 1 && $requestid > 1) {

            require_once 'lib/nusoap.php';
            $auth = array("Authentication" => array("UserId" => "pl_connector_28", "Password" => "d4l@uat"));
            $cust_details = array("PersonalLoan" => array("Version" => 5, "ConUniqRefCode" => $requestid, "FirstName" => $FirstName, "MiddleName" => $MiddleName, "LastName" => $LastName, "Gender" => $gender, "DOB" => $dobFormat, "Qualification" => $qualification, "ResAddress1" => $caddress, "ResAddress2" => "", "ResLand" => "", "ResCity" => $CityKey, "ResPIN" => $ResPIN, "ResType" => $ResType, "CurResSince" => $CurResSinceFormat, "Email" => $Email, "Mobile" => $Mobile_Number, "EmpType" => $EmpType, "CompanyName" => $company_name, "OrgCategory" => $OrgCategory, "TotWrkExp" => (int)$TotWrkExp, "CurCmpnyJoinDt" => $CurCmpnyJoinDtFormat, "NMI" => (int)$salary, "EmiCurPay" => 0, "OffAddress1" => "", "OffAddress2" => "", "OffCity" => "", "OffPIN" => "", "OffPhone" => "", "PAN" => $panno, "LnAmt" => (int)$loan_amount, "TnrMths" => $TnrMths, "IRR" => $IRR, "ProcFee" => $ProcFee));
  
            $request_arr = array("RPRequest" => array_merge($auth, $cust_details));
            $UserId = "rupeepower_rblbank";
            $Password = "sdfk7823rbl";
			$data_string = json_encode($request_arr);
             $soapClient = new nusoap_client("http://uat-r2.rupeepower.com/connector/RPPersonalLoanConnector.wsdl?wsdl", true);
              $soapClient->setCredentials($UserId, $Password, "basic");
              $result = $soapClient->call("personalLoan", $request_arr); // For UAT
             
			  $result_string = json_encode($result);
			$resultobj = json_decode($result_string);
			$finalstatus = $resultobj->Errorcode; 
			 $rblpllog = array('product'=>"PL", 'productid'=>'3236722', 'bankid'=>"68", 'api_name'=>"RBL_PL_Connector", 'api_version'=>"UAT", 'api_request'=>$data_string, 'api_response'=>$result_string, 'api_response_status'=>$finalstatus);
	//print_R($rblpllog);	
	$insert = Maininsertfunc ('webservice_details_pl', $rblpllog);
            
        }
    }
}
//die;
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
                                    <div class="text12" style="margin:auto; width:11px; margin-top:70px; color:#0a8bd9;"></div>
                                    <div style="clear:both; height:1px;"></div>
                                    <div style="clear:both; margin:auto;  margin-top:25px;">
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