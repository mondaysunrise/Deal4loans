<?php

require 'scripts/db_init.php';
require 'scripts/functions.php';
error_reporting('E_ALL');

function DetermineAgeFromDOB ($YYYYMMDD_In)
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


 function filter_blank($var) 
{
        return !(empty($var) || is_null($var));
}

function getsaveagentmapicici()
{
	$strstart_date=date('Y-m-d');

	$getagentdetails=("select total_lead_count From lead_allocation_table where BidderID=2085");
	
	 list($recordcount,$row)=MainselectfuncNew($getagentdetails,$array = array());
		$cntr=0;
	//$row= mysql_fetch_array($getagentdetails);
	$newrequestid=$row[$cntr]["total_lead_count"];
	//echo $newrequestid;
	//$newrequestid=836132;
	
	if($newrequestid>0)
	{
		
		$search_query="SELECT * FROM Req_Feedback_Bidder1,fixed_deposit  WHERE (Req_Feedback_Bidder1.AllRequestID= fixed_deposit.requestid and Req_Feedback_Bidder1.BidderID =2085 and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,fixed_deposit  WHERE (Req_Feedback_Bidder1.AllRequestID= fixed_deposit.requestid and Req_Feedback_Bidder1.BidderID =2085 and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}

 list($recorcount,$Arrtrow)=MainselectfuncNew($search_query,$array = array());
		$bid=0;

echo $search_query."<br>";
//$result = ExecQuery($search_query);
	//$recorcount = mysql_num_rows($result);
//echo "<br>";
while($cntr<count($Arrtrow))
        {
	$Feedback_ID = $Arrtrow[$bid]['Feedback_ID'];
	$AllRequestID = $Arrtrow[$bid]['AllRequestID'];
	$Name = $Arrtrow[$bid]['name'];
	$age = $Arrtrow[$bid]['age'];
	$mobile_no = $Arrtrow[$bid]['mobile_number'];
	$City = $Arrtrow[$bid]['city'];
	$tenure = $Arrtrow[$bid]['investment_duration'];
	$amount_invest = $Arrtrow[$bid]['investment_amount'];

//LEAD ALLOCATION****************************************************************************************//
$getagentmapped="select * from lead_allocation_table where (BidderID=2085)";
//echo $getagentmapped."<br>";
 list($gamCount,$gam)=MainselectfuncNew($getagentmapped,$array = array());
		$f=0;

//$selectAppDetails_result= ExecQuery($getagentmapped);
//$gam= mysql_fetch_array($selectAppDetails_result);
$requestid=$gam[$f]["total_lead_count"];
$last_allocated_to=$gam[$f]["last_allocated_to"];
$total_no_agents=$gam[$f]["total_no_agents"];
$lead_allocation_logic =$gam[$f]["lead_allocation_logic"];
//echo "<br>";
//select agent now
if($total_no_agents>$last_allocated_to)
	{
	
	$differnce=$last_allocated_to+1;
		$checkagentseq=("select * from Req_Compaign where Sequence_no='".$differnce."' and Sms_Flag =0 and BidderID=2085");
		//echo "<br>";
		//echo "select * from Req_Compaign where Sequence_no='".$differnce."' and Sms_Flag =0 and BidderID=2085";
	}
	else
	{
		
		$checkagentseq=("select * from Req_Compaign where Sequence_no='1' and BidderID=2085 and Sms_Flag =0");
		//echo "select * from Req_Compaign where Sequence_no='1' and BidderID=2085";
		//echo "<br>";
	}
	//echo "<br>";
	
	 list($recordcount,$getagentdet)=MainselectfuncNew($checkagentseq,$array = array());
		$k=0;
	
	//$getagentdet= mysql_fetch_array($checkagentseq);
	$AgentID = $getagentdet[$k]['Compaign_ID'];
	//echo "<br>";
	$Agent_Contact_No = $getagentdet[$k]['Mobile_no'];
	$sequence =	$getagentdet[$k]['Sequence_no'];

	
if($AgentID>0)
	{
	
	//$nowgetagentmapped=ExecQuery("update lead_allocation_table set last_allocated_to='".$sequence."', total_lead_count='".$Feedback_ID."' where (lead_allocation_logic='".$lead_allocation_logic."' and BidderID=2085)");

	$DataArray = array("last_allocated_to"=>$sequence, "total_lead_count"=>$Feedback_ID);
	$wherecondition ="(lead_allocation_logic='".$lead_allocation_logic."' and BidderID=2085)";
	Mainupdatefunc ('lead_allocation_table', $DataArray, $wherecondition);
	
	//echo "update lead_allocation_table set last_allocated_to='".$sequence."', total_lead_count='".$Feedback_ID."' where (lead_allocation_logic='".$lead_allocation_logic."' and BidderID=2085)";
	
	}

if(strlen($Agent_Contact_No)>0)
		{

	/*if($Bidder_Count==1)
		{
			$append = " [Exclusive Lead] ";
		}
		else
		{
			$append = "";
		}*/
//echo "<br>";
$currentdate=date('d-m-Y');
$AgentSMSMessage = "FD Lead: Name-".$Name.",Age-".$age.",Mob-".$mobile_no.",City-".$City.",Term-".$tenure.",Amt-".$amount_invest." ";

//$AgentSMSMessage=$AgentSMSMessage;

$admAgentSMSMessage=$AgentSMSMessage.$Agent_Contact_No;

echo "<br>";
echo $AgentSMSMessage;
	if(strlen(trim($Agent_Contact_No)) > 0)
		SendSMS($AgentSMSMessage, $Agent_Contact_No);

$adnAgent_Contact_No=9811215138;
	if(strlen(trim($adnAgent_Contact_No)) > 0)
		SendSMS($admAgentSMSMessage, $adnAgent_Contact_No);

	}
$bid = $bid +1;
}


}
	
main();

function main()
{
	getsaveagentmapicici();
}
?>