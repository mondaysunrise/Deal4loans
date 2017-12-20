<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$rblqry="SELECT * From Req_Credit_Card LEFT OUTER JOIN rbl_creditcard ON rbl_creditcard.cc_requestID= Req_Credit_Card.RequestID WHERE (Req_Credit_Card.RequestID In (750293))";
list($num,$row)=MainselectfuncNew($rblqry,$array = array());
$rowcontr = count($row)-1;

//751092,751733,752883,749022,752182,750293

	$AppliedCC = $row[$rowcontr]["AppliedCC"];
	$Gender = $row[$rowcontr]["Gender"];
	$Qualification = $row[$rowcontr]["Qualification"];
	$ResCity = $row[$rowcontr]["ResCity"]; //prefilled
	$ResiPin = $row[$rowcontr]["ResiPin"];
	$Resiaddress1 = $row[$rowcontr]["Resiaddress1"];
	$Resiaddress2 = $row[$rowcontr]["Resiaddress2"];
	$Phoneno = $row[$rowcontr]["Phoneno"];
	$EmploymentType = $row[$rowcontr]["EmploymentType"];
	$EmployerName = $row[$rowcontr]["EmployerName"];
	$Designation = $row[$rowcontr]["Designation"];
	$CompanyType = $row[$rowcontr]["CompanyType"];
	$SalaryAcc = $row[$rowcontr]["SalaryAcc"];
	if($SalaryAcc=="" && ($EmploymentType==2 || $EmploymentType==3))
	{
		$SalaryAcc=0;
	}
	$Panno = $row[$rowcontr]["Panno"];
	$IncomeProof = $row[$rowcontr]["IncomeProof"];
	$IncomeProofval = $row[$rowcontr]["IncomeProofval"];
	$ExistingCCNo = $row[$rowcontr]["ExistingCCNo"];
	$CCCreditLimit = $row[$rowcontr]["CCCreditLimit"];
	$Cardvintage = $row[$rowcontr]["CardSince"];
	$RBLcustomer = $row[$rowcontr]["RBLcustomer"];
	$CibilChk = $row[$rowcontr]["CibilChk"];
	List($First,$middle,$laststr) = split("[ ]",$row[$rowcontr]["Name"]);
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
	$Mobile = $row[$rowcontr]["Mobile_Number"];
	$Email = $row[$rowcontr]["Email"];
	$DOB = $row[$rowcontr]["DOB"];
	List($year,$month,$day) = split("[-]",$row[$rowcontr]["DOB"]);
	$strdob = $day."-".$month."-".$year;
	$CC_Holder = $row[$rowcontr]["CC_Holder"];
	 $CC_Bank  = $row[$rowcontr]["No_of_Banks"];
	$NetMonthlyIncome = round($row[$rowcontr]["Net_Salary"]/12);
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

?>
