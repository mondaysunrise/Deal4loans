<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';


function getsaveagentmap()
{
	$strstart_date =Date('Y-m-d');

$fullrtnfinid = array('1025');

$selReqID=ExecQuery("select * from lead_allocation_table where (BidderID=1025)");
$gam= mysql_fetch_array($selReqID);
$newrequestid = $gam["total_lead_count"];

	if($newrequestid>0)
	{		
		$search_query="SELECT RequestID,Feedback_ID,Name,Mobile_Number,Net_Salary,Company_Name,Primary_Acc,City FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE (Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID =1025 and Req_Feedback_Bidder_PL.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT Feedback_ID,RequestID,Name,Mobile_Number,Net_Salary,Company_Name,Primary_Acc,City FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE (Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID =1025 and (Req_Feedback_Bidder_PL.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}

$result = ExecQuery($search_query);

$ctr=1;
while($row=mysql_fetch_array($result))
		{
	$SMSMessage="";
$mySMSMessage="";
$message="";
$selReqIDn=ExecQuery("select * from lead_allocation_table where (BidderID=1025)");
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

//select agent now
if($total_no_agents>$last_allocated_to)
	{
	
	 $differnce=$last_allocated_to+1;
		$checkagentseq=ExecQuery("Select * from Req_Compaign Where (BidderID=1025 and Reply_Type=1 and Sequence_no='".$differnce."' and priority=1)");
		

	}
	else
	{
		$checkagentseq=ExecQuery("Select * from Req_Compaign Where ( BidderID=1025 and Reply_Type=1 and Sequence_no=1 and priority=1)");
			
	}
	
$getrow=mysql_fetch_array($checkagentseq);
	$strmobile_no = $getrow['Mobile_no'];
$Sequence_no = $getrow['Sequence_no'];
$Bank_Name  = $getrow['Bank_Name'];

$message ="Your Personal loan Leads on (".$currentdate.") : ";
$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-Login Code MA002";

if(strlen(trim($strmobile_no)) > 0)
		SendSMSforLMS($message.$SMSMessage, $strmobile_no);


$nowgetagentmapped=ExecQuery("update lead_allocation_table set last_allocated_to='".$Sequence_no."',total_lead_count='".$finalReqid."' where (lead_allocation_logic='".$lead_allocation_logic."' and BidderID=1025)");

$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , axis_executive_name) Values ('".$RequestID."','1025',1,'".$Bank_Name."')";

$strSQLresult = ExecQuery($strSQL);

$ctr=$ctr+1;
		}
	//}

}
	

main();

function main()
{
	$ShowDate = date("H:i:s");
	$StartTime = "08:00:00";
	$EndTime = "19:30:00";	

//if(($ShowDate > $StartTime) && ($ShowDate < $EndTime))			
			//{
	getsaveagentmap();
			//}
}

?>