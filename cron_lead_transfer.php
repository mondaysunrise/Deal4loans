<?php
require 'scripts/db_init.php';
//require 'scripts/functions.php';

echo "###################################################### Transfer LEADS to CC################################################<br>";
tead_transfer_hl_cc ();
echo "###################################################### Transfer LEADS to Agents################################################<br>";
sbicardslmsSMS();
function tead_transfer_hl_cc ()
{
		$source = 'HL2CCTRANSFER';
		$lead_allocation_logic = 121;
		$currentdate=Date('Y-m-d');
		//$currentdate="2017-07-01";
		$date_created = $currentdate." 00:00:00";
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
		$Dated = ExactServerdate();

		
		$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
		echo $startprocess."<br><br>";
		$startprocessresult = ExecQuery($startprocess);
		$recordcount = mysql_num_rows($startprocessresult);
		$row=mysql_fetch_array($startprocessresult);
		echo $id = $row["total_lead_count"];
		
		$transferLeadSql = "select id,RequestID,productid,Name,Email,Mobile_Number, Employment_Status, City, Net_Salary, City_Other, IP_Address FROM leads_with_other_processes left join Req_Loan_Home on Req_Loan_Home.RequestID=leads_with_other_processes.productid  WHERE id>'".$id."' AND status=0 AND date_created>'".$date_created."' AND product='HL' AND transfer_productid='' order by id asc";
		
	//	$transferLeadSql = "select id,RequestID,productid,Name,Email,Mobile_Number, Employment_Status, City, Net_Salary, City_Other,IP_Address FROM leads_with_other_processes left join Req_Loan_Home on Req_Loan_Home.RequestID=leads_with_other_processes.productid  WHERE id>2";
		echo "<br>".$transferLeadSql."<br>";
		$transferLeadQuery = ExecQuery($transferLeadSql);
		$transferLeadNumRows = mysql_num_rows($transferLeadQuery);
		echo "Count - ".$transferLeadNumRows;
		//die();
		$insertBundleSql = '';
		$insertBundleRequestID = '';
		$insert_status = '';
		$source_cc = 'SBI_HL_LEAD';
		for($i=0;$i<$transferLeadNumRows;$i++)
		{
			$insert_status = '';
			$tableID= mysql_result($transferLeadQuery,$i,'id');
			$RequestID= mysql_result($transferLeadQuery,$i,'RequestID');
			$Mobile_Number= mysql_result($transferLeadQuery,$i,'Mobile_Number');
		//	$checkLeadSql = "select RequestID from Req_Credit_Card where Mobile_Number='".$Mobile_Number."' AND  Updated_Date between '".$days30datetime."' and '".$currentdatetime."'";
		//	$checkLeadQuery = ExecQuery($checkLeadSql);
		//	$checkLeadNumRows = mysql_num_rows($checkLeadQuery);
			$getdetails="select RequestID From Req_Credit_Card Where ((Mobile_Number='".$Mobile_Number."' and Mobile_Number not in ('9811555306','9811215138','9971396361','9999047207','9311773341','9555060388')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
			//echo  "<br>".$getdetails."<br>";
			if($alreadyExist>0) 
			{
				//Duplicate
				echo $insert_status = 2;
				$ProductValue = $myrow[0]["RequestID"];
			} else
			{
				$Name= mysql_result($transferLeadQuery,$i,'Name');
				$Email= mysql_result($transferLeadQuery,$i,'Email');
				$Employment_Status= mysql_result($transferLeadQuery,$i,'Employment_Status');
				$City= mysql_result($transferLeadQuery,$i,'City');
				//$DOB= mysql_result($transferLeadQuery,$i,'DOB');
				$timestamp = strtotime('-22 years');
				$DOB= date('Y-m-d',$timestamp);
				$City_Other= mysql_result($transferLeadQuery,$i,'City_Other');
				$IP= mysql_result($transferLeadQuery,$i,'IP_Address');
				$Net_Salary= mysql_result($transferLeadQuery,$i,'Net_Salary');
				//$insertSQl = "insert into Req_Credit_Card (Name,Email,Mobile_Number, Employment_Status, City, Net_Salary) VALUES ('".$Name."', '".$Email."', '".$Mobile_Number."', '".$Employment_Status."', '".$City."', '".$Net_Salary."')";
				
			//	$insertBundleSql[] =  "('".$Name."', '".$Email."', '".$Mobile_Number."', '".$Employment_Status."', '".$City."', '".$Net_Salary."')";
			//	$insertBundleRequestID[] = $RequestID;
				$dataInsert = array('Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Mobile_Number, 'Net_Salary'=>$Net_Salary, 'Dated'=>$Dated, 'source'=>$source_cc, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Updated_Date'=>$Dated, 'Email'=>$Email);	
			//	print_r($dataInsert);
				$ProductValue = Maininsertfunc ('Req_Credit_Card', $dataInsert);
				$insert_status = 1;
				
				//echo "<br>";
			//	print_r($updateAllocationSql);
				$RequestID = $ProductValue;
				echo "<br>Inserted ID".$RequestID."<br>";
				$insertFeedbackArr = array("AllRequestID"=>$RequestID, "BidderID"=>5633, "Reply_Type"=>4, "Allocation_Date"=>$Dated);
				Maininsertfunc("Req_Feedback_Bidder1", $insertFeedbackArr);
				Maininsertfunc("Req_Feedback_Bidder_CC", $insertFeedbackArr);
				$updateProductAllocationArr = array("Allocated"=>1);
				$UpdateProductWhereCond ="(RequestID='".$RequestID."')";
				Mainupdatefunc("Req_Credit_Card", $updateProductAllocationArr, $UpdateProductWhereCond);
				
				$updateAllocationSql= array( 'total_lead_count'=>$tableID);
				$whereconditionAllocation="( Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."' )";
			//	echo $whereconditionAllocation;
				Mainupdatefunc("lead_allocation_table", $updateAllocationSql, $whereconditionAllocation);
				
				
			}
				//update Sql 
				$updateProductSql= array('status'=>$insert_status,'transfer_product'=>'CC', 'transfer_productid'=>$ProductValue);
				$wherecondition ="( id=".$tableID.")";
				Mainupdatefunc("leads_with_other_processes", $updateProductSql, $wherecondition);
		}
			
}	


//HL Leads SBI
function sbicardslmsSMS()
{
	$currentdate=Date('Y-m-d');
	$currentdate="2017-07-01";
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	$lead_allocation_logic = 122;
	$source = 'CCTRANSFER2CALLER';

	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='CCTRANSFER2CALLER' and Status=1";
	$getActiveBiddersQry = ExecQuery($getActiveBiddersSql);
	$recordCountActiveBidders = mysql_num_rows($getActiveBiddersQry);
	$BidderIDArr = '';
	$counterVal = 1;
	for($i=0;$i<$recordCountActiveBidders;$i++)
	{
		$BidderID = mysql_result($getActiveBiddersQry,$i,'BidderID');
		$BidderIDArr[$counterVal] = $BidderID;
		$counterVal = $counterVal + 1;
	}

 echo $BidderIDStr = implode(',', $BidderIDArr);

	$startprocess="Select lead_allocation_logic,total_no_agents,last_allocated_to,total_lead_count From lead_allocation_table Where (Citywise='CCTRANSFER2CALLER'  and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$id = $row["total_lead_count"];
	$lead_allocation_logic = $row["lead_allocation_logic"];
	
	$sbiccqry="select id, RequestID,Updated_Date FROM leads_with_other_processes left join Req_Credit_Card on Req_Credit_Card.RequestID=leads_with_other_processes.transfer_productid  WHERE id>'".$id."' AND status=1 AND date_created>'".$min_date."' AND transfer_product='CC' order by id asc";
	echo "<br><br>q 3: ".$sbiccqry."<br>";
	
	$smsplqryresult = ExecQuery($sbiccqry);
	echo $recordcount1 = mysql_num_rows($smsplqryresult);
	
	//die();
	$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	//echo "fff";
	$AllRequestID = $row2["RequestID"];
	$Allocation_Date = $row2["Updated_Date"];
	$Feedback_ID = $row2["id"];
	
	if($AllRequestID>0)
	{
		
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and  BidderID in (".$BidderIDStr.") and `Reply_Type`=4)";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CCTRANSFER2CALLER' and lead_allocation_logic='".$lead_allocation_logic."')");
				$seqid = mysql_fetch_array($sequenceid);
				$last_allocated_to = $seqid["last_allocated_to"];
				$total_no_agents = $seqid["total_no_agents"];
				
				if($total_no_agents>$last_allocated_to)
				{
					$sequence=$last_allocated_to+1;
				}
				else
				{
					$sequence=1;
				}
				echo $bidderID = $BidderIDArr[$sequence];	
				if($AllRequestID>0 && $bidderID>1)
				{	
					//insert allocation
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '1', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='CCTRANSFER2CALLER'  and lead_allocation_logic='".$lead_allocation_logic."')";
					$updateqryresult = ExecQuery($updateqry);
					//echo "<br><br>";
				}
			
			}
		$getCheckNum = '';
			
	}
}
}// SBI 
		

?>