 <?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
require 'scripts/personal_loan_eligibility_function.php';
error_reporting('E_ALL');

if (!empty($_SERVER['REMOTE_ADDR']))
{
        exit; 
}
else
{
main();
}

function main()
{
	$ShowDate = date("H:i:s");
	$StartTime = "08:00:00";
	$EndTime = "18:40:00";	

if(($ShowDate > $StartTime) && ($ShowDate < $EndTime))			
			{
	getsaveagentmap();
			}
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

function getsaveagentmap()
{
	$strstart_date =Date('Y-m-d');

$fullertonid = array('1012','1050','1025');

	for($r=0;$r<count($fullertonid);$r++)
	{
$selReqID=ExecQuery("select total_lead_count from lead_allocation_table where (BidderID=".$fullertonid[$r].")");

$gam= mysql_fetch_array($selReqID);

$newrequestid = $gam["total_lead_count"];

	if($newrequestid>0)
	{		
		$search_query="SELECT Feedback_ID,RequestID,Name,Mobile_Number,Net_Salary,Company_Name,Primary_Acc,City,DOB,Company_Type,Card_Vintage,PL_EMI_Amt,EMI_Paid,Bidder_Count FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE (Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID =".$fullertonid[$r]." and Req_Feedback_Bidder_PL.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT Feedback_ID,RequestID,Name,Mobile_Number,Net_Salary,Company_Name,Primary_Acc,City,DOB,Company_Type,Card_Vintage,PL_EMI_Amt,EMI_Paid,Bidder_Count FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE (Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID =".$fullertonid[$r]." and (Req_Feedback_Bidder_PL.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}

$result = ExecQuery($search_query);
$SMSMessage="";
$mySMSMessage="";
$smsdetailstocust="";

$ctr=1;
while($row=mysql_fetch_array($result))
		{
	$selReqIDn=ExecQuery("select * from lead_allocation_table where (BidderID=".$fullertonid[$r].")");
	$gamn= mysql_fetch_array($selReqIDn);
	$last_allocated_to=$gamn["last_allocated_to"];
	$total_no_agents=$gamn["total_no_agents"];
	$lead_allocation_logic =$gamn["lead_allocation_logic"];
	$newrequestid = $gamn["total_lead_count"];
	$currentdate=date('d-m-Y');
	$finalReqid = $row['Feedback_ID'];
	$Name = $row['Name'];
	$Phone = $row['Mobile_Number'];
	$Net_Salary = $row['Net_Salary'];
	$Company_Name = $row['Company_Name'];
	$Primary_Acc = $row['Primary_Acc'];
	$City = $row['City'];
	$RequestID = $row['RequestID'];
	$DOB = $row["DOB"];
	$Company_Type = $row["Company_Type"];
	$Card_Vintage = $row["Card_Vintage"];
	$PL_EMI_Amt = $row["PL_EMI_Amt"];
	$EMI_Paid = $row["EMI_Paid"];
	$Bidder_Count = $row["Bidder_Count"];
	$getDOB = DetermineAgeGETDOB($DOB);
	$monthsalary = $Net_Salary/12;

if($Bidder_Count==1)
		{
				$append="[Exclusive]";
		}
		else
		{
			$append="";
		}

$mySMSMessage="";
$SMSMessage="";

$message ="Your Personal loan Leads on (".$currentdate.") : ";
$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",city-".$City.", ".$compMessage;
$SMSMessage = $SMSMessage.$append;

//select agent now
if($total_no_agents>$last_allocated_to)
	{
		$differnce=$last_allocated_to+1;
		$checkagentseq=ExecQuery("Select * from Req_Compaign Where (BidderID=".$fullertonid[$r]." and Reply_Type=1 and Sequence_no='".$differnce."' and priority=1)");
	}
	else
	{
		$checkagentseq=ExecQuery("Select * from Req_Compaign Where ( BidderID=".$fullertonid[$r]." and Reply_Type=1 and Sequence_no=1 and priority=1)");
	}
	
$getrow=mysql_fetch_array($checkagentseq);
	$strmobile_no = $getrow['Mobile_no'];
$Sequence_no = $getrow['Sequence_no'];
$Bank_Name  = $getrow['Bank_Name'];

//if(strlen(trim($strmobile_no)) > 0)
	//	SendSMSforLMS($message.$SMSMessage, $strmobile_no);
	
$detailstocustomer="Dear Customer,You will get a call from this Authorized Fullerton representative. ";
	$smsdetailstocust=" contact no : ".$strmobile_no;

if(strlen(trim($Phone)) > 0)
			{
		//SendSMSforLMS($detailstocustomer.$smsdetailstocust, $Phone);
			}

 $upSql = "INSERT INTO fullerton_allocation_track (BidderID ,Mobile ,BName ,RequestID ,CName ,CMobile ,Dated) VALUES ('".$fullertonid[$r]."','".$strmobile_no."', '".$Bank_Name."', '".$RequestID."', '".$Name."', '".$Phone."', Now())";

$upQuery = ExecQuery($upSql);

 $mySMSMessage=$mySMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$Bank_Name."-".$strmobile_no;

$nowgetagentmapped=ExecQuery("update lead_allocation_table set last_allocated_to='".$Sequence_no."',total_lead_count='".$finalReqid."' where (lead_allocation_logic='".$lead_allocation_logic."' and BidderID=".$fullertonid[$r].")");

$ctr=$ctr+1;
		}
	}
}

?>