<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$Dated = ExactServerdate();
 
function getReqsmsvalue($pKey){
    $titles = array(
        1=> 'Req_Loan_Personal',
        2=> 'Req_Loan_Home',
        3=> 'Req_Loan_Car',
        4=> 'Req_Credit_Card',
        5=> 'Req_Loan_Against_Property',
        6=> 'Req_Business_Loan'
       
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }



//get all open bidders
$getOpenBidders=("select BidderID,Reply_Type,CapLead_Count From Bidders_List Where (Restrict_Bidder=1)");
//$recordcount = mysql_num_rows($getOpenBidders);
 list($recordcount,$row)=MainselectfuncNew($getOpenBidders,$array = array());
		$cntr=0;

while($cntr<count($row))
        {
				$val=getReqsmsvalue($row[$cntr]["Reply_Type"]);
				$Reply_Type = $row[$cntr]["Reply_Type"];
				$BidderID= $row[$cntr]["BidderID"];
				$CapLead_Count = $row[$cntr]["CapLead_Count"];

			//here get the exact lead count
			$SqlCountLead="SELECT RequestID FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$BidderID."' WHERE (Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID = '".$BidderID."' and  Req_Feedback_Bidder1.Reply_Type = '".$Reply_Type."') group by ".$val.".Mobile_Number";
			
			 list($TotalLeadsLMS,$Myrow)=MainselectfuncNew($SqlCountLead,$array = array());

			
			//$QueryCountLead = ExecQuery($SqlCountLead);
			//$TotalLeadsLMS = mysql_num_rows($QueryCountLead);

$checkDatetime=("select BookEntryTime from Bidders_Book_Keeping where BidderID=".$BidderID." and BookProduct=".$Reply_Type." ORDER BY BookEntryTime DESC LIMIT 1");
//echo "select BookEntryTime from Bidders_Book_Keeping where BidderID=".$BidderID." and BookProduct=".$Reply_Type." ORDER BY BookEntryTime DESC LIMIT 1<br>";

list($TotalLeadsLMS,$datetimerow)=MainselectfuncNew($checkDatetime,$array = array());
	$cntr2=0;
//$datetimerow=mysql_fetch_array($checkDatetime);
$BookEntryTime=$datetimerow[$cntr2]["BookEntryTime"];


			//hereinsert data into table
			$checkDataavailable=("select * from exact_bidder_leads_count where BidderID=".$BidderID." and product_type=".$Reply_Type."");
			list($checkDataavailablecount,$ArrRows)=MainselectfuncNew($checkDataavailable,$array = array());
			
			//$checkDataavailablecount = mysql_num_rows($checkDataavailable);
			if($checkDataavailablecount>0)
			{
				//update here
				//$UpdateData="update exact_bidder_leads_count set leads_count='".$TotalLeadsLMS."' , updated_date=Now() ,caplead_count ='".$CapLead_Count."',lastdatetime='".$BookEntryTime."'  where BidderID=".$BidderID."  and product_type=".$Reply_Type."";
				$DataArray = array("leads_count"=>$TotalLeadsLMS, "updated_date"=>$Dated, "caplead_count"=>$CapLead_Count, "lastdatetime"=>$BookEntryTime);
				$wherecondition ="BidderID=".$BidderID."  and product_type=".$Reply_Type."";
				Mainupdatefunc ('exact_bidder_leads_count', $DataArray, $wherecondition);
				//ExecQuery($UpdateData);
				echo "wswx:".$UpdateData."<br>";
			}
			else
			{
				//insert hereINsewrt
				//$InsertData="INSERT INTO exact_bidder_leads_count (BidderID,product_type,leads_count,updated_date,caplead_count,lastdatetime) value ('".$BidderID."','".$Reply_Type."','".$TotalLeadsLMS."', Now(),'".$CapLead_Count."','".$BookEntryTime."')";
			$dataInsert = array("BidderID"=>$BidderID , "product_type"=>$Reply_Type , "leads_count"=>$TotalLeadsLMS , "updated_date"=>$Dated , "caplead_count"=>$CapLead_Count, "lastdatetime"=>$BookEntryTime);
		$table = 'exact_bidder_leads_count';
		$insert = Maininsertfunc ($table, $dataInsert);
			
			//	ExecQuery($InsertData);
				echo "hello:".$InsertData."<br>";
			}
$cntr = $cntr+1;
		}



?>