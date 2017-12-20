<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/personal_loan_eligibility_function.php';
error_reporting('E_ALL');

main();
Function main()
{
getSCBCmp();
}


function DetermineAgeGETDOB ($YYYYMMDD_In)
{
	$yIn=substr($YYYYMMDD_In, 0, 4);
	$mIn=substr($YYYYMMDD_In, 4, 2);
	$dIn=substr($YYYYMMDD_In, 6, 2);

	$ddiff = date("d") - $dIn;
	$mdiff = date("m") - $mIn;
	$ydiff = date("Y") - $yIn;

	// Check If Birthday Month Has Been Reached
	if ($mdiff < 0)
	{
		// Birthday Month Not Reached
		// Subtract 1 Year From Age
		$ydiff--;
	} elseif ($mdiff==0)
	{
		// Birthday Month Currently
		// Check If BirthdayDay Passed
	if ($ddiff < 0)
	{
	//Birthday Not Reached
	// Subtract 1 Year From Age
	$ydiff--;
	}
	}
	return $ydiff;
}


function getSCBCmp()
{
echo "I M :<br>";

//$citifinid = array('1646','1632','1633','1634','1635','1636','1759','1760','2020','2021');
$citifinid = array('1646','1632','1633','1634','1635','1759','1760','2020','2021');
//$reqcitifinid = array('716261','716094','716464','715931','715628','716285','712495','716192');

for($j=0;$j<count($citifinid);$j++)
 {
$strstart_date=date('Y-m-d');
$getagentdetails="select BidderID, RequestID, Mobile_no From Req_Compaign where (BidderID=".$citifinid[$j]." and Reply_Type=1 and Sms_Flag=0)";

list($alreadyExist,$row)=MainselectfuncNew($getagentdetails,$array = array());
$rowcontr=count($row)-1;
$BidderID = $row[$rowcontr]["BidderID"];
$newrequestid = $row[$rowcontr]["RequestID"];
//$newrequestid = $reqcitifinid[$j];
$Sequence_no = $row[$rowcontr]["Sequence_no"];
$priority = $row[$rowcontr]["priority"];
$Compaign_ID = $row[$rowcontr]["Compaign_ID"];
$strmobile_no=$row[$rowcontr]["Mobile_no"];

if($newrequestid>0)
{
	$search_query="SELECT Feedback_ID,RequestID,Name,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Primary_Acc,Company_Type,Primary_Acc,PL_EMI_Amt,EMI_Paid,Card_Vintage,DOB,Bidder_Count FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =".$citifinid[$j]." and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
}
else
{
	$search_query="SELECT Feedback_ID,RequestID,Name,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Primary_Acc,Company_Type,Primary_Acc,PL_EMI_Amt,EMI_Paid,Card_Vintage,DOB,Bidder_Count FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =".$citifinid[$j]." and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
}

echo $search_query."<br>";
list($recorcount,$myrow)=MainselectfuncNew($search_query,$array = array());
$myrowcontr=count($myrow)-1;
//echo "get bidder no::".$strmobile_no."<br>";
echo "RECORD: ".$recorcount."<br>";
$currentdate=date('d-m-Y');
$ctr=1;

if ($recorcount>0)
{
	$SMSMessage="";
	$SMSMessage1="";
	$strgetfinalbid="";
	$getfinalbid="";
	$fruits="";
	$strcitibank="";
	$strbarclays="";
	$strhdfc="";
	//echo "1:<br>";
	for($i=0;$i<count($recorcount);$i++)
	{
	//echo "2:<br>";

	$request=trim($myrow[$myrowcontr]["Feedback_ID"]);
	$RequestID=trim($myrow[$myrowcontr]["RequestID"]);
	$Name=trim($myrow[$myrowcontr]["Name"]);
	$City=trim($myrow[$myrowcontr]["City"]);
	$Phone=trim($myrow[$myrowcontr]["Mobile_Number"]);
	$Net_Salary=trim($myrow[$myrowcontr]["Net_Salary"]);
	$Company_Name =trim($myrow[$myrowcontr]["Company_Name"]);
	$Loan_Amount=trim($myrow[$myrowcontr]["Loan_Amount"]);
	$BidderID = $citifinid[$j];
	$Primary_Acc=trim($myrow[$myrowcontr]["Primary_Acc"]);
	$Company_Type = $myrow[$myrowcontr]['Company_Type'];
	$Primary_Acc = $myrow[$myrowcontr]['Primary_Acc'];
	$PL_EMI_Amt = $myrow[$myrowcontr]['PL_EMI_Amt'];
	$company=$Company_Name;
	$EMI_Paid = $myrow[$myrowcontr]['EMI_Paid'];
	$Card_Vintage = $myrow[$myrowcontr]['Card_Vintage'];
	$DOB=trim($myrow[$myrowcontr]["DOB"]);
	$getDOB =DetermineAgeGETDOB($DOB);
	$Bidder_Count = $myrow[$myrowcontr]["Bidder_Count"];
	
	$append="";
	$sqlExclusive = "select  BidderID  from Req_Feedback_Bidder1 where (AllRequestID = '".$RequestID."' and Reply_Type='1')";
	list($numRowsExclusive,$myrow1)=MainselectfuncNew($sqlExclusive,$array = array());
	 if($numRowsExclusive==1)
	 {
	 	$append=" [Exclusive]";
	 }
	 else
	 {
	 	$append="";
	 }

//get eligibility first/
$getcompany='select hdfc_bank,fullerton,citibank,barclays  from pl_company_list where company_name="'.$Company_Name.'"';
echo $getcompany."<br>";
echo "<br>";
list($recorcount1,$grow)=MainselectfuncNew($getcompany,$array = array());
$growcontr = count($grow)-1;


$hdfccategory= $grow[$growcontr]["hdfc_bank"];
$fullertoncategory= $grow[$growcontr]["fullerton"];
$citicategory= $grow[$growcontr]["citibank"];
$barclayscategory = $grow[$growcontr]["barclays"]; 

$monthsalary = $Net_Salary/12;
if($monthsalary>=20000)
{
echo "in hdfc<br>";
	list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=@hdfcbank($monthsalary,$PL_EMI_Amt,$Company_Name,$hdfccategory,$getDOB,$Company_Type,$Primary_Acc);
}

if($monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
{
echo "in barclays<br>";
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm)=@barclays($monthsalary,$PL_EMI_Amt,$Company_Name,$barclayscategory,$getDOB,$City);
}

if(strlen($citicategory)>0 && $monthsalary>=22000)
{
	echo "in citibank<br>";
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=@citibank($monthsalary,$PL_EMI_Amt,$Company_Name,$getDOB,$citicategory);
}
else
{
	$citigetloanamout="";
	$citiinterestrate="";
}

//Check for lowest rate
if(strlen($citiinterestrate)>0)
{
	$strcitibank=substr(trim($citiinterestrate), 0, strlen(trim($citiinterestrate))-1);
}
if (strlen($barclayinterestrate)>0)
{
	$strbarclays=substr(trim($barclayinterestrate), 0, strlen(trim($barclayinterestrate))-1);
}

if (strlen($hdfcinterestrate)>0)
{
	$strhdfc=substr(trim($hdfcinterestrate), 0, strlen(trim($hdfcinterestrate))-1);
}

$fruits = array($strhdfc,$strbarclays,$strcitibank);
sort($fruits,SORT_NUMERIC);
//print_r($fruits);

if($fruits[0]>1)
{
	$getfinalbid=$fruits[0];
	}
	else if ($fruits[0]=="" && $fruits[1]>1)
	{
	$getfinalbid=$fruits[1];
	}
	else if ($fruits[2]>0 && $fruits[0]=="" && $fruits[1]=="")
	{
	$getfinalbid=$fruits[2];
}

if(($getfinalbid)>0)
{
$strgetfinalbid=", Lowest ROI Frm Other Bank -".$getfinalbid." %";
$strgetfinalbidDB="Other Bank -".$getfinalbid." %";
}
//END OF CHECK
if(strlen($strgetfinalbid)>0 && (($getfinalbid)>0))
{
//	$sql2="Update Req_Loan_Personal set Residence_Address='".$strgetfinalbidDB."' Where (RequestID=".$RequestID.")";
//	echo $sql2."<br><br>";
	//$result2=ExecQuery($sql2);
}

if($recorcount>0)
{
 	$message ="Your Personal loan Leads on (".$currentdate.") : ";

	$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",cty".$City;

		$SMSMessage1=$SMSMessage1."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",cty".$City.",Co- ".$Company_Name;
}
	$SMSMessage = $SMSMessage.$append;
	$SMSMessage1 = $SMSMessage1.$append;
$ctr=$ctr+1;
if($citifinid[$j]==2020 || $citifinid[$j]==2021)
		{
		if(strlen(trim($SMSMessage1))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			SendSMSforLMS($message.$SMSMessage1, $strmobile_no);

			$exstrmobile_no=9916992700;

			if(strlen(trim($exstrmobile_no)) > 0)
		SendSMSforLMS($message.$SMSMessage1, $exstrmobile_no);
		}
		}
		else
		{
	if(strlen(trim($SMSMessage))>0)
	{

		echo "MOBILE: ".$strmobile_no;
		echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";
		if(strlen(trim($strmobile_no)) > 0)
		SendSMSforLMS($message.$SMSMessage, $strmobile_no);

if($citifinid[$j]==1646)
		{
			//$exstrmobile_no=9899574825;

			//if(strlen(trim($exstrmobile_no)) > 0)
		//SendSMS($message.$SMSMessage, $exstrmobile_no);

		}
		else if(($citifinid[$j]==1632) && ($City=="Mumbai" || $City=="Thane" || $City=="Navi Mumbai"))
		{
			$exstrmobile_no=9768177267;
			if(strlen(trim($exstrmobile_no)) > 0)
		SendSMSforLMS($message.$SMSMessage, $exstrmobile_no);
		}
	}
}
	$dataUpdate = array('RequestID'=>$request);
	$wherecondition = "(BidderID=".$citifinid[$j]." and Reply_Type=1 and Sms_Flag=0)";
	Mainupdatefunc ('Req_Compaign', $dataUpdate, $wherecondition);

}
}

}
}

?>