<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';


function getsaveagentmap()
{
	$strstart_date =Date('Y-m-d');

$bajajfinid = array('2423','2425','2426');

	for($r=0;$r<count($bajajfinid);$r++)
	{
$selReqID = "select * from lead_allocation_table where (BidderID=".$bajajfinid[$r].")";
list($alreadyExist,$gam)=Mainselectfunc($selReqID,$array = array());
$last_allocated_to=$gam["last_allocated_to"];
$total_no_agents=$gam["total_no_agents"];
$lead_allocation_logic =$gam["lead_allocation_logic"];
$newrequestid = $gam["total_lead_count"];

	if($newrequestid>0)
	{		
		$search_query="SELECT RequestID,Feedback_ID,Name,Mobile_Number,Net_Salary,Company_Name,Primary_Acc,City FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =".$bajajfinid[$r]." and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT Feedback_ID,RequestID,Name,Mobile_Number,Net_Salary,Company_Name,Primary_Acc,City FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =".$bajajfinid[$r]." and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}

$SMSMessage="";
$mySMSMessage="";
$ctr=1;
list($numRows,$row)=MainselectfuncNew($search_query,$array = array());

for($ii=0;$ii<$numRows;$ii++)
		{
$selReqIDn= "select * from lead_allocation_table where (BidderID=".$bajajfinid[$r].")";
list($selReqIDnRows,$gamn)=Mainselectfunc($selReqIDn,$array = array());
$last_allocated_to=$gamn["last_allocated_to"];
$total_no_agents=$gamn["total_no_agents"];
$lead_allocation_logic =$gamn["lead_allocation_logic"];
$newrequestid = $gamn["total_lead_count"];
$currentdate=date('d-m-Y');

$finalReqid = $row[$ii]['Feedback_ID'];
$Name = $row[$ii]['Name'];
$Phone = $row[$ii]['Mobile_Number'];
$Net_Salary = $row[$ii]['Net_Salary'];
$Company_Name = $row[$ii]['Company_Name'];
$Primary_Acc = $row[$ii]['Primary_Acc'];
$City = $row[$ii]['City'];
$RequestID = $row[$ii]['RequestID'];

	

//select agent now
if($total_no_agents>$last_allocated_to)
	{
	
	$differnce=$last_allocated_to+1;
		$checkagentseq="Select * from Req_Compaign Where (BidderID=".$bajajfinid[$r]." and Reply_Type=1 and Sequence_no='".$differnce."' and priority=1)";

	}
	else
	{
		$checkagentseq="Select * from Req_Compaign Where ( BidderID=".$bajajfinid[$r]." and Reply_Type=1 and Sequence_no=1 and priority=1)";
	
	}
	list($Rows,$getrow)=Mainselectfunc($checkagentseq,$array = array());


$strmobile_no = $getrow['Mobile_no'];
$Sequence_no = $getrow['Sequence_no'];
$Bank_Name  = $getrow['Bank_Name'];

$message ="Your Personal loan Leads on (".$currentdate.") : ";
$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc;

if(strlen(trim($strmobile_no)) > 0)
			SendSMSforLMS($message.$SMSMessage, $strmobile_no);

$mySMSMessage=$mySMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc;

if($bajajfinid[$r]==2426)
	{
		$mymobile_no=9811999227;
	}
	elseif($bajajfinid[$r]==2425)
	{
		$mymobile_no=9773399232;
	}
	elseif($bajajfinid[$r]==2423)
	{
		$mymobile_no=9945215124;
	}
	else
	{
		$mymobile_no=9717594462;
	}


if(strlen(trim($mymobile_no)) > 0)
		SendSMSforLMS($message.$mySMSMessage, $mymobile_no);


		$Dated = ExactServerdate();
		$DataArray = array("last_allocated_to"=>$Sequence_no , "total_lead_count"=>$finalReqid);
		$wherecondition ="(lead_allocation_logic='".$lead_allocation_logic."' and BidderID=".$bajajfinid[$r].")";
		Mainupdatefunc ('lead_allocation_table', $DataArray, $wherecondition);

		$data = array("AllRequestID"=>$RequestID , "BidderID"=>$bajajfinid[$r] , "axis_executive_name"=>$Bank_Name , "Reply_Type"=>'1' );
		$table = 'Req_Feedback';
		$insert = Maininsertfunc ($table, $data);


$ctr=$ctr+1;
		}
	}

}
	

main();

function main()
{
	$ShowDate = date("H:i:s");
	$StartTime = "08:00:00";
	$EndTime = "18:30:00";	

if(($ShowDate > $StartTime) && ($ShowDate < $EndTime))			
			{
	getsaveagentmap();
			}
}

?>