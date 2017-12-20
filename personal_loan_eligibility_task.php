<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	require 'scripts/personal_loan_eligibility_function.php';

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

$query="Select * from Req_Compaign Where Reply_Type='1' and Bank_Name='fullerton' and BidderID=1023";
	$result1 = ExecQuery($query);
	//echo "hello".$query."<br>";
	while($row1 = mysql_fetch_array($result1))
	{
	 $frequestid= $row1["RequestID"];
	 //$frequestid="564848";
	 }
	 
	If((strlen(trim($frequestid))<=0))
	{

$sql1="SELECT BidderID,Name,Company_Name,RequestID,Net_Salary,PL_EMI_Amt,DOB,City,Feedback_ID,Company_Type,Primary_Acc,EMI_Paid,Card_Vintage FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (996,997,998,1012,1037) and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date > '2010-04-03 00:00:00'))";
	}
	else
	{
		
$sql1="SELECT BidderID,Name,Company_Name,RequestID,Net_Salary,PL_EMI_Amt,DOB,City,Feedback_ID,Company_Type,Primary_Acc,EMI_Paid,Card_Vintage FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (996,997,998,1012,1037) and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date > '2010-04-03 00:00:00') and Req_Feedback_Bidder_PL.Feedback_ID>'".$frequestid."')";

	}

$result1=ExecQuery($sql1);
//echo $sql1."<br>";
$recordcount = mysql_num_rows($result1);
$i=1;

if($recordcount>0)
		{
			
		while($row=mysql_fetch_array($result1))
		{
			$hdfcgetloanamout="";

$hdfcinterestrate="";
$citiinterestrate="";
$citigetloanamout="";
$citicategory="";
$hdfccategory="";
$citibankeligibility="";
$SMSMessage="";
$barclaygetloanamout="";
$barclayinterestrate="";

			//echo "<br>";
			$company = $row['Company_Name'];
			$Name = $row['Name'];
			$Company_Type = $row['Company_Type'];
			$Primary_Acc = $row['Primary_Acc'];
			$requestid = $row['RequestID'];
			$Feedback_ID = $row['Feedback_ID'];
			$Net_Salary = $row['Net_Salary'];
			$DOB = $row['DOB'];
			$getDOB =DetermineAgeGETDOB($DOB);
			$PL_EMI_Amt = $row['PL_EMI_Amt'];
			$City = $row['City'];
			$Company_Name=$company;
			$BidderID = $row['BidderID'];
			$EMI_Paid = $row['EMI_Paid'];
			$Card_Vintage = $row['Card_Vintage'];
//echo "<br>";

$getcompany='select hdfc_bank,fullerton,citibank,barclays  from pl_company_list where company_name="'.$company.'"';
//echo $getcompany."<br>";
$getcompanyresult = ExecQuery($getcompany);
$grow=mysql_fetch_array($getcompanyresult);
//$recordcount = mysql_num_rows($getcompanyresult);
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$citicategory= $grow["citibank"];
$barclayscategory = $grow["barclays"]; 

$monthsalary = $Net_Salary/12;

//for hdfc

if($monthsalary>=20000)
			{
//	echo "in hdfc";
list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=@hdfcbank($monthsalary,$PL_EMI_Amt,$Company_Name,$hdfccategory,$getDOB,$Company_Type,$Primary_Acc);
			}

if($monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
			{
list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm)=@barclays($monthsalary,$PL_EMI_Amt,$Company_Name,$barclayscategory,$getDOB,$City);

			}

if(strlen($citicategory)>0 && $monthsalary>=22000)
			{
//echo "in citi";
	
//for Citibank
list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=@citibank($monthsalary,$PL_EMI_Amt,$Company_Name,$getDOB,$citicategory);
			}
			else
			{
				$citigetloanamout="";
				$citiinterestrate="";
			}
						
//for fullerton
//list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($monthsalary,$PL_EMI_Amt,$Company_Name,$fullertoncategory,$getDOB,$City);

if($citigetloanamout>0 || $hdfcgetloanamout>0)
			{
	if($hdfcgetloanamout>0 && $monthsalary>=20000)

				{
	$hdfceligibility=$hdfcgetloanamout." at ".$hdfcinterestrate;
	$hdfcsms="Hdfc -".$hdfceligibility.",";
				}
				else
				{
					$hdfcsms="Hdfc - Not Eligible";
				}

				if($citigetloanamout>0 && $monthsalary>=22000)
				{
	$citibankeligibility=$citigetloanamout." at ".$citiinterestrate;

	$citisms="Citi -".$citibankeligibility.",";
				}
				else
				{
					$citibankeligibility="";
					$citisms="Citibank - Not Eligible";
				}

				if($barclaygetloanamout>0 && $monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
				{
	$barclayseligibility=$barclaygetloanamout." at ".$barclayinterestrate;
	$barclaysms="Barclays -".$barclayseligibility.",";
				}
				else
				{
					$barclaysms="Barclays - Not Eligible";
				}
				
	

	$sql2="Update Req_Loan_Personal set Barclays_Eligibility='".$barclayseligibility."',Citibank_Eligibility='".$citibankeligibility."', Hdfc_Eligibility='".$hdfceligibility."' Where (RequestID=".$requestid.")";
	echo $sql2."<br><br>";
	$result2=ExecQuery($sql2);

	//$getagent=ExecQuery("select * from Req_Compaign where (BidderID=".$BidderID." and Reply_Type=1 )");
	$getagent=ExecQuery("select Mobile_Number from fullerton_leads_allocation where (BidderID=".$BidderID." and RequestID='".$requestid."')");

	echo "select Mobile_Number from fullerton_leads_allocation where (BidderID=".$BidderID." and RequestID='".$requestid."')";
	echo "<br>";
	$agentw=mysql_fetch_array($getagent);
$strmobile_no=$agentw['Mobile_Number'];
echo $strmobile_no."<br>";
	echo "<br>";
if(strlen($hdfceligibility)>0 || strlen($citibankeligibility)>0 || strlen($barclayseligibility)>0)
				{
$SMSMessage="Name- ".$Name.",".$hdfcsms."".$citisms."".$barclaysms;
//echo $SMSMessage."<br>";
//$newmobile_no="9811215138";

	if(strlen(trim($strmobile_no)) > 0)
			 	SendSMS($SMSMessage, $strmobile_no);

	//if(strlen(trim($newmobile_no)) > 0)
			 //	SendSMS($SMSMessage, $newmobile_no);

				}



 
			}

If(($recordcount)>0)
	{
	ExecQuery("update Req_Compaign set RequestID='".$Feedback_ID."' where Reply_Type='1' and Bank_Name='fullerton' and BidderID=1023");	
	echo "update Req_Compaign set RequestID='".$Feedback_ID."' where Reply_Type='1' and Bank_Name='fullerton' and BidderID=1023";
	//echo "<br><br>";
	
	}


$i=$i+1;

		}


		}

?>