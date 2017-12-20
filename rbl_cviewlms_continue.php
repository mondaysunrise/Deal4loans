<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require_once ("lib/nusoap.php");

	$ccrqd = $_POST["ccrqd"];
	$AppliedCC = $_POST["AppliedCC"];
	$Gender = $_POST["Gender"];
	$Qualification = $_POST["Qualification"];
	$ResCity = $_POST["ResCity"]; //prefilled
	$ResiPin = $_POST["ResiPin"];
	$Resiaddress1 = $_POST["Resiaddress1"];
	$Resiaddress2 = $_POST["Resiaddress2"];
	$Phoneno = $_POST["Phoneno"];
	$EmploymentType = $_POST["EmploymentType"];
	$EmployerName = $_POST["EmployerName"];
	$Designation = $_POST["Designation"];
	$CompanyType = $_POST["CompanyType"];
	$SalaryAcc = $_POST["SalaryAcc"];
	if($SalaryAcc=="" && ($EmploymentType==2 || $EmploymentType==3))
	{
		$SalaryAcc=0;
	}
	$Panno = $_POST["Panno"];
	$IncomeProof = $_POST["IncomeProof"];
	$IncomeProofval = $_POST["IncomeProofval"];
	$ExistingCCNo = $_POST["ExistingCCNo"];
	$CCCreditLimit = $_POST["CCCreditLimit"];
	$Cardvintage = $_POST["CardSince"];
	$RBLcustomer = $_POST["RBLcustomer"];
	$CibilChk = $_POST["CibilChk"];
	List($First,$middle,$laststr) = split("[ ]",$_POST["Name"]);
	if($laststr=="")
	{
		if(strlen($middle)>0)
		{
		$last=$middle;
		$middle="";
		}
		else
		{
			$last="K";
		}
	}
	else
	{
		$last=$laststr;
	}
	$Mobile = $_POST["Mobile"];
	$Email = $_POST["Email"];
	$DOB = $_POST["DOB"];
	List($year,$month,$day) = split("[-]",$_POST["DOB"]);
	$strdob = $day."-".$month."-".$year;
	$CC_Holder = $_POST["CC_Holder"];
	 $CC_Bank  = $_POST["CC_Bank"];
	$NetMonthlyIncome = round($_POST["Net_Salary"]/12);
	$UserId = "cc_connector_2";
	$Password = "dmk9mit$4*37btw";
	if($CC_Bank=="HDFC Bank")
	{	$ExistingCC = 100; }
	elseif($CC_Bank=="ICICI Bank")
	{ $ExistingCC = 50;  }
	elseif($CC_Bank=="IndusInd Bank")
	{ $ExistingCC = 60;  }
	elseif($CC_Bank=="Kotak Bank")
	{ $ExistingCC = 70;  }
	elseif($CC_Bank=="RBL Bank")
	{ $ExistingCC = 9999;  }
	elseif($CC_Bank=="Standard Chartered")
	{ $ExistingCC = 80; }
	elseif($CC_Bank=="Others")
	{ $ExistingCC = 9999; }
	else
	{
		if($CC_Holder==1)
		{
		$ExistingCC = 9999;
		}
		else
		{
			$ExistingCC=0;
		}
	}

	if($Cardvintage==1)
	{	
		$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-100, date("Y"));
		$Today = date("d-m-Y", $yesterday); 
		$CardSince=$Today;
	}
	elseif($Cardvintage==2)
	{
		$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-240, date("Y"));
		$Today = date("d-m-Y", $yesterday); 
		$CardSince=$Today;
	}
	elseif($Cardvintage==3)
	{
		$date=date('d-m');
		$year = date('Y')-1;
		$CardSince=$date."-".$year;
	}
	elseif($Cardvintage==4)
	{
		$date=date('d-m');
		$year = date('Y')-2;
		$CardSince=$date."-".$year;
	}
	else
	{
		if($CC_Holder==1)
		{
			$date=date('d-m');
			$year = date('Y')-1;
			$CardSince=$date."-".$year;
		}
		else
		{
		$CardSince="";
		}
	}
	
	$Dated = ExactServerdate();
	$dataInsert = array('cc_requestID'=>$ccrqd, 'AppliedCC'=>$AppliedCC, 'Gender'=>$Gender, 'Qualification'=>$Qualification, 'ResCity'=>$ResCity, 'ResiPin'=>$ResiPin, 'Resiaddress1'=>$Resiaddress1, 'Resiaddress2'=>$Resiaddress2, 'Phoneno'=>$Phoneno, 'EmploymentType'=>$EmploymentType, 'EmployerName'=>$EmployerName, 'Designation'=>$Designation, 'CompanyType'=>$CompanyType, 'SalaryAcc'=>$SalaryAcc, 'Panno'=>$Panno, 'IncomeProof'=>$IncomeProof, 'IncomeProofval'=>$IncomeProofval, 'ExistingCCNo'=>$ExistingCCNo, 'CCCreditLimit'=>$CCCreditLimit, 'CardSince'=>$CardSince, 'RBLcustomer'=>$RBLcustomer, 'Dated'=>$Dated, 'autoflag'=>'1');
	$ProductValue = Maininsertfunc ("rbl_creditcard", $dataInsert);

	if($CC_Holder==1)
	{	$HasExistingCC = "Y";}
	else
	{	$HasExistingCC = "N"; 	}

//old pwd="dmk9mit$4*37btw";
$xmlstr="<RPRequest>
                 <Authentication>
                 <UserId>cc_connector_2</UserId>
               <Password>dfl6prd$42*ats5</Password>
            </Authentication>
            <CreditCard>
                <Version>7</Version>
               <CreditCardApplied>".$AppliedCC."</CreditCardApplied>
               <HasExistingCC>".$HasExistingCC."</HasExistingCC>
               <ExistingCC>".$ExistingCC."</ExistingCC>
               <ExtngCardCreditLimit>".$CCCreditLimit."</ExtngCardCreditLimit>
               <ExtngCCNumber></ExtngCCNumber>
               <ExtngCardMemSince>".$CardSince."</ExtngCardMemSince>
               <IsExtngRblCust>".$RBLcustomer."</IsExtngRblCust>
               <AccountNumber>Nil</AccountNumber>
               <FirstName>".$First."</FirstName>
               <MiddleName>".$middle."</MiddleName>
               <LastName>".$last."</LastName>
               <Gender>".$Gender."</Gender>
               <DOB>".$strdob."</DOB>
               <Qualification>".$Qualification."</Qualification>
               <ResAddress1>".$Resiaddress1."</ResAddress1>
               <ResAddress2>".$Resiaddress2."</ResAddress2>
               <ResCity>".$ResCity."</ResCity>
               <ResPIN>".$ResiPin."</ResPIN>               
               <Email>".$Email."</Email>
               <Mobile>".$Mobile."</Mobile>
               <EmpType>".$EmploymentType."</EmpType>
               <SalaryBankAcc>".$SalaryAcc."</SalaryBankAcc>
               <NMI>".$NetMonthlyIncome."</NMI>
               <CompanyName>".$EmployerName."</CompanyName>
               <Designation>".$Designation."</Designation>
               <CompanyType>".$CompanyType."</CompanyType>
               <IncomeProof>".$IncomeProof."</IncomeProof>
               <IncomeProofValue>".$NetMonthlyIncome."</IncomeProofValue>
               <PAN>".$Panno."</PAN>
               <CibilCheck>Y</CibilCheck>
               <Phone>".$Phoneno."</Phone>
            </CreditCard>
         </RPRequest>"; 

		echo $xmlstr."<br>";
// Keeping reporting on for error tracking
// HDFC's domain
//$url = 'http://uat-rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl';
$url ='https://rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl';
  $soapClient = new nusoap_client("https://rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl", true);

  $info = $soapClient->call("creditCard", $xmlstr, "https://rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl" );

$Dated = ExactServerdate();
$dataUpdate = array('Status'=>$info["Status"], 'ReferenceCode'=>$info["ReferenceCode"], 'Errorcode'=>$info["Errorcode"], 'Errorinfo'=>$info["Errorinfo"], 'RequestIP'=>$info["RequestIP"]);
$wherecondition = "(rblccid=".$ProductValue.")";
Mainupdatefunc ('rbl_creditcard', $dataUpdate, $wherecondition);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ratnakar Bank Credit Card</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="ratnakar-bank-cc-styles.css" type="text/css" rel="stylesheet"  />
<!--[if IE 8]>
<link rel="stylesheet" href="ratnakar-bank-cc-styles_ie.css" type="text/css" media="screen" />
<![endif]-->
</head>
<body>
<div class="header">

</div>
<div class="clearfix"></div>
<div class="container">
<? 
echo "ReferenceCode: ".$info["ReferenceCode"]."<br>";
echo "Error Info: ".$info["Errorinfo"]."<br><br>";
if($info["Status"]==1)
{ ?>
<div style="color: #1c3285; font-family: Arial,Helvetica,sans-serif; font-size: 14px; margin-top: 7px; padding-top: 8px; text-align: left; width:900px;"><b>Congratulations <? echo $_POST["Name"]; ?></b><br><br>
Your Application has been approved-in-principle, subject to the verification of the information provided by you and further credit evaluation by the Bank.<br>
Please note your Application reference number <? echo $info["ReferenceCode"]; ?> for any future correspondence,
 </div>
<? 
}
elseif($info["Status"]==2)
{ ?>
<div style="color: #1c3285; font-family: Arial,Helvetica,sans-serif; font-size: 14px; margin-top: 7px; padding-top: 8px; text-align: left; width:900px;"><b>Thank you <? echo $_POST["Name"]; ?>, your application has been successfully submitted for processing</b><br><br>
You may please note your Application reference number <? echo $info["ReferenceCode"]; ?> for any future correspondence.<br>
A Bank Representative will contact you shortly to guide you on the next steps of your application processing
 </div>
<? }
else
{ ?>
<div style="color: #1c3285; font-family: Arial,Helvetica,sans-serif; font-size: 14px; margin-top: 7px; padding-top: 8px; text-align: left; width:900px;"><b>Thank you <? echo $_POST["Name"]; ?> for applying for a RBL Bank credit Card.</b><br><br>
We regret to inform you that we are unable to offer you a credit card at this point in time.
 </div>
<? } 
/*echo "Status : ".$info["Status"];
echo "<br>";
echo "ReferenceCode : ".$info["ReferenceCode"];
echo "<br>";
echo "Error info : ".$info["Errorinfo"];*/
?>
</div></body></html>
