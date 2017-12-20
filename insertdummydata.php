<?php
session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	//echo "1::";
	$mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	$qry1=str_replace("\'", "'", $qry1);
	

	list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
		$cntr=0;
	
	
	while($cntr<count($row_result))
        {
		if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$cntr]["Marital_Status"]==1) {  $marital_status="Single"; } else { $marital_status="Married"; }
		if($row_result[$cntr]["Residential_Status"]==0) { $residential_status="not available"; } 
		if($row_result[$cntr]["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result[$cntr]["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result[$cntr]["Residential_Status"]==3) { $residential_status="Company Provided"; }
		if($row_result[$cntr]["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
		if($row_result[$cntr]["Loan_Any"]==0) { $loan_any="N/A"; } if($row_result[$cntr]["Loan_Any"]==1) { $loan_any="Car Loan"; } 	if($row_result[$cntr]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$cntr]["CC_Holder"]==0) { $cc_holder="No"; }
	
	$BiddersChurn = "select  BidderID from Req_Feedback_Bidder1 where  AllRequestID=".$row_result[$cntr]['RequestID']." and Reply_Type=1";
//echo $BiddersChurn."<br>";
	
	 list($recordcount,$row)=MainselectfuncNew($BiddersChurn,$array = array());
		$i=0;
	
	$strBidders_1="";
	while($i<count($row))
        {
		$requestid=$row[$i]['AllRequestID'];
		$strBidders_1 = $strBidders_1.$row[$i]['BidderID'].",";
		$i = $i + 1;

	}
	$strBidders_1 = substr(trim($strBidders_1), 0, strlen(trim($strBidders_1))-1);
	
	$biddername="select  Bidder_Name from Bidders_List where BidderID in (".$strBidders_1.")";
	list($recordcount,$row1)=MainselectfuncNew($biddername,$array = array());
		$j=0;
	
$strBidders="";
if(strlen($strBidders_1)>0 || $strBidders_1!='')
		{
while($j<count($row1))
        {
		//$requestid=$row['AllRequestID'];
		$strBidders = $strBidders.$row1[$j]['Bidder_Name'].",";
	
	$j = $j +1;
	}
		}
		else
			{
$strBidders=0;
			}
		
			 $cntr=$cntr+1;
			 }

			echo "done";

			?>