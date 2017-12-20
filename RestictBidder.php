<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
function CheckLeadCount()
{
	
	$search_query="Select * from Bidders_List where (Lead_Count IS NOT Null or Lead_Count!=0) and Restrict_Bidder=1 ";
	 list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;
	//$result = ExecQuery($search_query);
	echo $search_query;
	while($cntr<count($row))
        {
		$bidderid = $row[$cntr]["BidderID"];
		$Query = $row[$cntr]["Query"];
		$val = $row[$cntr]["Table_Name"];
		$Reply_Type = $row[$cntr]["Reply_Type"];
		$Dated = $row[$cntr]["Dated"];
		$Dated = $Dated." 00:00:00"; 
		$Lead_Count = $row[$cntr]["Lead_Count"];
		$makedate=date('Y-m');
		$min_date= $makedate."-01 00:00:00";
		
		if($Dated > $min_date )
		{
		$Query= "SELECT * FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$bidderid."' WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID = '".$bidderid."' and ".$val.".Dated Between '".$Dated."' and Now()";
		list($recordcount,$getrow)=MainselectfuncNew($Query,$array = array());
		
		}
		else
		{
		$Query= "SELECT * FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$bidderid."' WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID = '".$bidderid."' and ".$val.".Dated Between '".$min_date."' and Now()";
		list($recordcount,$getrow)=MainselectfuncNew($Query,$array = array());
		
		}
		//echo "hello".$Query."<br>";
		//$Query_Result = ExecQuery($Query);
		//echo $Query_Result;
	// $recordcount = mysql_num_rows($Query_Result);
	echo $recordcount."<br>";
		if(($recordcount == $Lead_Count) || ($recordcount > $Lead_Count))
		{
			echo "bidderid::".$bidderid."<br>";
			$qry="Update Bidders_List set Restrict_Bidder=0 where BidderID='$bidderid' and Reply_Type='$Reply_Type' ";
		
		$DataArray = array("Restrict_Bidder"=>0);
		$wherecondition ="BidderID='$bidderid' and Reply_Type='$Reply_Type'";
		Mainupdatefunc ('Bidders_List', $DataArray, $wherecondition);
		
			
			
			echo $qry;
			

		}
		//echo "hello".$Query;
		

	 $cntr=$cntr+1; }
}

main();
Function main()
{
   CheckLeadCount();	
}
?>