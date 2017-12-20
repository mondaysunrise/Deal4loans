<?php
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

if (!empty($_SERVER['REMOTE_ADDR']))
{
        exit; 
}
else
{
	main();
}

function getsaveagentmap()
{
$today= date('Y-m-d');
$min_date=$today." 00:00:00";
$max_date=$today." 23:59:59";

$getrequestID=ExecQuery("select  RequestID from Req_Compaign where (BidderID=993 and  Sms_Flag=0 and  City_Wise='' and  Mobile_no='' and Bank_Name='icicipancountry')");
$req= mysql_fetch_array($getrequestID);
echo $getrequestID."<br>";
$requestrecordcount = mysql_num_rows($getrequestID);
if($req["RequestID"]>0)
	{
	/*$qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home  WHERE (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 993 and Req_Feedback_Bidder1.Reply_Type=2 and Req_Feedback_Bidder1.Feedback_ID=509339)";*/
	
		$qry="SELECT City,Name,Mobile_Number,RequestID,Allocation_Date,Feedback_ID,AllRequestID FROM Req_Feedback_Bidder1,Req_Loan_Home  WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 993 and Req_Feedback_Bidder1.Reply_Type=2 and Req_Feedback_Bidder1.Feedback_ID>".$req["RequestID"]."  and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		//$qry=$qry.$FeedbackClause;
		$qry=$qry."group by Req_Loan_Home.Mobile_Number";
	}
	else
	{
		$qry="SELECT City,Name,Mobile_Number,RequestID,Allocation_Date,Feedback_ID,AllRequestID FROM Req_Feedback_Bidder1,Req_Loan_Home  WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 993 and Req_Feedback_Bidder1.Reply_Type=2 and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		//$qry=$qry.$FeedbackClause;
		$qry=$qry."group by Req_Loan_Home.Mobile_Number";

	}
	echo $qry."<br>";

		$result=ExecQuery($qry);
///$leadid= mysql_fetch_array($result);

while($row=mysql_fetch_array($result))
	{
//LEAD ALLOCATION****************************************************************************************//
$getagentmapped="select last_allocated_to,total_no_agents,lead_allocation_logic from icici_lead_allocation_table where (city like '%".$row["City"]."%' and BidderID=993) ";
echo $getagentmapped."<br>";

$selectAppDetails_result= ExecQuery($getagentmapped);
$recordcount = mysql_num_rows($selectAppDetails_result);
$gam= mysql_fetch_array($selectAppDetails_result);
$last_allocated_to=$gam["last_allocated_to"];
$total_no_agents=$gam["total_no_agents"];
$lead_allocation_logic =$gam["lead_allocation_logic"];
$AgentSMSMessage="";
if($recordcount>0)
		{
//select agent now
if($total_no_agents>$last_allocated_to)
	{
	
	$differnce=$last_allocated_to+1;
		$checkagentseq=ExecQuery("select agentid,agent_name,agent_email,agent_no,agent_city,agent_sequence from icici_hfc_agents where agent_sequence='".$differnce."' and  agent_city Like '%".$row["City"]."%' and agent_flag=1 ");
		echo "select * from icici_hfc_agents where agent_sequence='".$differnce."' and  agent_city Like '%".$row["City"]."%' and agent_flag=1 "."<br>";
	
	}
	else
	{
		//echo "else:: <br>";
		$checkagentseq=ExecQuery("select agentid,agent_name,agent_email,agent_no,agent_city,agent_sequence from icici_hfc_agents where agent_sequence=1 and  agent_city Like '%".$row["City"]."%' and agent_flag=1");
		echo "select * from icici_hfc_agents where agent_sequence=1 and  agent_city Like '%".$row["City"]."%' and agent_flag=1"."<br>";
	}
	
	//echo 
	$getagentdet= mysql_fetch_array($checkagentseq);
	
	$AgentID = $getagentdet['agentid'];
	$Agent_name = $getagentdet['agent_name'];
	$Agent_Email = $getagentdet['agent_email'];
	//$Agent_Contact_No = $getagentdet['agent_no'];
	//$getAgent_Contact_No = $getagentdet['agent_no'];
	$Agent_City = $getagentdet['agent_city'];
	$sequence =	$getagentdet['agent_sequence'];
	
	$updatedetails="insert into icici_agent_leadallocation (bidderid,agentid,feedback_id,product,allocation_date,allrequestid) Values ('993','".$AgentID."','".$row["Feedback_ID"]."','2','".$row["Allocation_Date"]."','".$row["AllRequestID"]."') ";
	//echo $updatedetails."<br>";
	$updatedetailsresult=ExecQuery($updatedetails);
echo $$updatedetails."<br>";

	$nowgetagentmapped=ExecQuery("update icici_lead_allocation_table set last_allocated_to='".$sequence."' where (lead_allocation_logic='".$lead_allocation_logic."' and BidderID=993)");
	
echo "update icici_lead_allocation_table set last_allocated_to='".$sequence."' where (lead_allocation_logic='".$lead_allocation_logic."' and BidderId=993)"."<br>";
//$Agent_Contact_No="9811215138";

if(strlen($Agent_Contact_No)>0)
		{
	
echo "sms sent";
$AgentSMSMessage=$AgentSMSMessage."".$row["Name"]."-".$row["Mobile_Number"];

$currentdate=date('d-m-Y');
	$message ="Your Leads for as on (".$currentdate.") :";

		//if(strlen(trim($Agent_Contact_No)) > 0)
		//SendSMS($message.$AgentSMSMessage, $Agent_Contact_No);
		}
		
if(strlen(trim($row["Mobile_Number"]))>0)
			{
					if(strlen(trim($Agent_Contact_No)) > 0)
				{
					$custSMSMessage="ICICI HFC -".$Agent_Contact_No;
				}

//getBidderContactDetailsToCustomers($row["RequestID"],$row["Mobile_Number"],$custSMSMessage);
/*******************************************************************************************************/

/********************************************************************************************************/

			}

//update leadallocation table
		$updatelead=ExecQuery("update Req_Compaign set RequestID='".$row["Feedback_ID"]."' where (Reply_Type=2 and BidderID=993 and  Sms_Flag=0 and Bank_Name='icicipancountry' and  City_Wise='' and  Mobile_no='')");

		echo "update Req_Compaign set RequestID='".$row["Feedback_ID"]."' where Reply_Type=2 and BidderID=993 and  Sms_Flag=0 and  City_Wise='' and  Mobile_no=''";
	}//if($recordcount>0)
	}//while($row=mysql_fetch_array($result))
	
}


function getBidderContactDetailsToCustomers($leadid,$Mobile_number,$custSMSMessage)
{
	
	$strmobileSQL = "SELECT BidderID FROM Req_Feedback_Bidder1 WHERE  (AllRequestID=".$leadid." and Reply_Type=2)";
	echo $strmobileSQL."<br>";
	$mobileresult = ExecQuery($strmobileSQL);
	$getbidderid="";
	while($Mobrow = mysql_fetch_array($mobileresult))
	{
		$strbidderid[]=$Mobrow["BidderID"];
	}

	$strProduct=2;
	$Phone=$Mobile_number;
	$GetBidderID = implode(',',$strbidderid);
	$SMSMessage="Dear Customer,Following are contact details of your chosen Banks @ deal4loans:";
	$SMSMessageBidders="";
	$ctr=2;
	$mvarType = $strProduct;
	$mvarCity = strtoupper($strCity);

	$strSQL = "SELECT Bank_Name,Banker_Contact FROM Bidder_Contact_To_Customers WHERE BidderID in (".$GetBidderID.") AND Reply_Type=".$mvarType." AND Sms_Flag=1";

	echo "SQL : ".$strSQL."<BR>";
	$result = ExecQuery($strSQL);
	echo mysql_error();

	
		If ($myrow = mysql_fetch_array($result))
	{
		do
		{
			$mvar_Bidder_Bank=trim($myrow["Bank_Name"]);
			
			$mvar_Bidder_Number=trim($myrow["Banker_Contact"]);
			$SMSMessageBidders=$SMSMessageBidders." (".$ctr.") ".$mvar_Bidder_Bank."-".$mvar_Bidder_Number." ";
			$ctr=$ctr+1;
			
	  }while ($myrow = mysql_fetch_array($result));
		  mysql_free_result($result);
	}
	
	
	if(strlen(trim($SMSMessageBidders))>0)
	{

		//if(strlen(trim($Phone)) > 0)
			//SendSMS($SMSMessage."(1)".$custSMSMessage."".$SMSMessageBidders, $Phone);

/*$mobile="9811215138";
		if(strlen(trim($mobile)) > 0)
			SendSMS($SMSMessage."(1)".$custSMSMessage."".$SMSMessageBidders, $mobile);*/

echo $SMSMessage.$SMSMessageBidders."<br>";
	}

}
	
function main()
{
	getsaveagentmap();
}
?>