<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

function getsaveagentmap()
{
$selReqID="select * from lead_allocation_table where (BidderID=1060)";
list($CheckRowNR,$gam)=MainselectfuncNew($selReqID,$array = array());
$gamcontr = count($gam)-1;
		
$last_allocated_to = $gam[$gamcontr]["last_allocated_to"];
$total_no_agents = $gam[$gamcontr]["total_no_agents"];
$lead_allocation_logic = $gam[$gamcontr]["lead_allocation_logic"];
$newrequestid = $gam[$gamcontr]["total_lead_count"];
	if($newrequestid>0)
	{
		
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1060 and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1060 and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}
echo $search_query."<br>";
list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
$cntr=0;


$SMSMessage="";
$mySMSMessage="";
while($cntr<count($row))
        {
        $currentdate=date('d-m-Y');

$finalReqid = $row[$cntr]['Feedback_ID'];
$Name = $row[$cntr]['Name'];
$Phone = $row[$cntr]['Mobile_Number'];
$Net_Salary = $row[$cntr]['Net_Salary'];
$Company_Name = $row[$cntr]['Company_Name'];
$Primary_Acc = $row[$cntr]['Primary_Acc'];

//select agent now
if($total_no_agents>$last_allocated_to)
	{
	
	$differnce=$last_allocated_to+1;
		$checkagentseq=("Select * from Req_Compaign Where (Bank_Name='citibankdelhi' and BidderID=1060 and Reply_Type=1 and Sequence_no='".$differnce."' and priority=1)");
	 list($recordcount,$getrow)=MainselectfuncNew($checkagentseq,$array = array());
		
	
	}
	else
	{

	$checkagentseq=("Select * from Req_Compaign Where (Bank_Name='citibankdelhi' and BidderID=1060 and Reply_Type=1 and Sequence_no=1 and priority=1)");
	list($recordcount,$getrow)=MainselectfuncNew($checkagentseq,$array = array());
	}

//$getrow=mysql_fetch_array($checkagentseq);
	$i = 0;
	$strmobile_no = $getrow[$i]['Mobile_no'];
$Sequence_no = $getrow[$i]['Sequence_no'];

$message ="Personal loan Leads on (".$currentdate.") : ";
$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc;

if(strlen(trim($strmobile_no)) > 0)
SendSMS($message.$SMSMessage, $strmobile_no);

$mySMSMessage=$mySMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$strmobile_no;


		$DataArray = array("last_allocated_to"=>$Sequence_no, "total_lead_count"=>$finalReqid);
		$wherecondition ="(lead_allocation_logic='".$lead_allocation_logic."' and BidderID=1060)";
		Mainupdatefunc ('lead_allocation_table', $DataArray, $wherecondition);
		echo "<br>";
		 $cntr=$cntr+1;
		 }


}
	

main();

function main()
{
	$ShowDate = date("H:i:s");
	$StartTime = "08:00:00";
	$EndTime = "18:00:00";	

if(($ShowDate > $StartTime) && ($ShowDate < $EndTime))			
			{
	getsaveagentmap();
			}
}

?>