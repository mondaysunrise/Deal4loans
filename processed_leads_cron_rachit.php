<?php
require 'scripts/db_init.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//processed_sbi_leads_allocation();
//processed_icici_leads_allocation();
//processed_scb_leads_allocation();
//processed_rbl_leads_allocation();
//processed_amex_leads_allocation();

/*SBI Processed Lead Allocation Start*/
function processed_sbi_leads_allocation(){
	$leadidentifier= 'sbiprocessedleads';
	$lead_allocation_logic = 112;

	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersQry = "SELECT BidderID FROM Bidders WHERE (leadidentifier='".$leadidentifier."' AND Status=1) ORDER BY BidderID ASC";

	list($recordCountActiveBidders,$getActiveBidders) = MainselectfuncNew($getActiveBiddersQry);
	//echo '<pre>';print_r($getActiveBidders);exit;
	
	$BidderIDArr = '';
	$counterVal = 1;
	for($i=0;$i<$recordCountActiveBidders;$i++){
		$BidderID = $getActiveBidders[$i]['BidderID'];

		$BidderIDArr[$counterVal] = $BidderID;
		$counterVal = $counterVal + 1;
	}
	$BidderIDStr = implode(',', $BidderIDArr);
	
	$getLastAllocatedRequestIDQry="SELECT total_lead_count FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

	list($recordcount,$getLastAllocatedRequestID) = MainselectfuncNew($getLastAllocatedRequestIDQry);
	$LastAllocatedRequestID = $getLastAllocatedRequestID[0]["total_lead_count"];

	
	if($LastAllocatedRequestID){
		$sbiccqry = "SELECT RequestID,Updated_Date FROM `Req_Credit_Card` WHERE RequestID IN (
						SELECT RequestID  FROM `sbi_credit_card_5633` WHERE `ProcessingStatus` = 1 GROUP BY RequestID 
						UNION 
						SELECT cc_requestid FROM `sbi_credit_card_5633_log` WHERE `ProcessingStatus` = 1 GROUP BY cc_requestid
					) AND RequestID >'".$LastAllocatedRequestID."' AND Updated_Date Between '".$min_date."' AND '".$max_date."' LIMIT 0,5";
	}else{
		$sbiccqry = "SELECT RequestID,Updated_Date FROM `Req_Credit_Card` WHERE RequestID IN (
						SELECT RequestID  FROM `sbi_credit_card_5633` WHERE `ProcessingStatus` = 1 GROUP BY RequestID 
						UNION 
						SELECT cc_requestid FROM `sbi_credit_card_5633_log` WHERE `ProcessingStatus` = 1 GROUP BY cc_requestid
					) AND Updated_Date Between '".$min_date."' AND '".$max_date."' LIMIT 0,5";
	}
	echo $sbiccqry."<br>";

	list($recordcount1,$row2) = MainselectfuncNew($sbiccqry);
	//echo '<pre>';print_r($row2);exit;

	$bidderID="";

	foreach($row2 as $key=>$value){
		$AllRequestID = $value["RequestID"];
		$Allocation_Date = $value["Updated_Date"];
		if($AllRequestID>0){
			$checkleadallocationtableqry = "SELECT last_allocated_to,total_no_agents FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

			list($rowcount,$row3) = MainselectfuncNew($checkleadallocationtableqry);

			$last_allocated_to = $row3[0]["last_allocated_to"];
			$total_no_agents = $row3[0]["total_no_agents"];
			
			if($total_no_agents>$last_allocated_to){
				$sequence=$last_allocated_to+1;
			}
			else{
				$sequence=1;
			}	
			//echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
			$getCheckSQl = "SELECT * FROM lead_allocate WHERE AllRequestID = '".$AllRequestID."' AND BidderID in (".$BidderIDStr.")  ";
			list($getCheckNum,$row4) = MainselectfuncNew($getCheckSQl);
			if($getCheckNum>0){
				//Already Existing Lead
			}
			else{
				$bidderID = $BidderIDArr[$sequence];

				echo $bidderID.", ".$AllRequestID;
				if($AllRequestID>0 && $bidderID>1){
					//insert allocation
					$InsertDataArray = array("AllRequestID" =>$AllRequestID, "BidderID"=>$bidderID, "Reply_Type"=>4, "Allocated"=>0, "Allocation_Date"=>$Allocation_Date);
					Maininsertfunc('lead_allocate', $InsertDataArray);

					$UpdateDataArray = array("last_allocated_to" =>$sequence, "total_lead_count"=>$AllRequestID);
					$UpdateWhereCond ="(Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";
					Mainupdatefunc ('lead_allocation_table', $UpdateDataArray, $UpdateWhereCond);

				}
			}
			
		}
	}
}
/*SBI Processed Lead Allocation End */



/*ICICI Processed Lead Allocation Start*/
function processed_icici_leads_allocation(){
	$leadidentifier= 'iciciprocessedleads';
	$lead_allocation_logic = 113;

	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersQry = "SELECT BidderID FROM Bidders WHERE (leadidentifier='".$leadidentifier."' AND Status=1) ORDER BY BidderID ASC";

	list($recordCountActiveBidders,$getActiveBidders) = MainselectfuncNew($getActiveBiddersQry);
	//echo '<pre>';print_r($getActiveBidders);exit;
	
	$BidderIDArr = '';
	$counterVal = 1;
	for($i=0;$i<$recordCountActiveBidders;$i++){
		$BidderID = $getActiveBidders[$i]['BidderID'];

		$BidderIDArr[$counterVal] = $BidderID;
		$counterVal = $counterVal + 1;
	}
	$BidderIDStr = implode(',', $BidderIDArr);
	
	$getLastAllocatedRequestIDQry="SELECT total_lead_count FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

	list($recordcount,$getLastAllocatedRequestID) = MainselectfuncNew($getLastAllocatedRequestIDQry);
	//echo '<pre>';print_r($getLastAllocatedRequestID);
	$LastAllocatedRequestID = $getLastAllocatedRequestID[0]["total_lead_count"];

	
	if($LastAllocatedRequestID){
		$sbiccqry = "SELECT `RequestID`,`Updated_Date` FROM `Req_Credit_Card` AS rcc JOIN `credit_card_banks_apply` AS ccba ON(rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'ICICI Bank' AND ccba.`response_data` LIKE '%Approved%' AND rcc.RequestID >'".$LastAllocatedRequestID."' AND rcc.Updated_Date Between '".$min_date."' AND '".$max_date."'";
	}else{
		$sbiccqry = "SELECT `RequestID`,`Updated_Date` FROM `Req_Credit_Card` AS rcc JOIN `credit_card_banks_apply` AS ccba ON(rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'ICICI Bank' AND ccba.`response_data` LIKE '%Approved%' AND rcc.Updated_Date Between '".$min_date."' AND '".$max_date."'";
	}
	echo $sbiccqry."<br>";
	//exit;

	list($recordcount1,$row2) = MainselectfuncNew($sbiccqry);
	//echo '<pre>';print_r($row2);exit;

	$bidderID="";

	foreach($row2 as $key=>$value){
		$AllRequestID = $value["RequestID"];
		$Allocation_Date = $value["Updated_Date"];
		if($AllRequestID>0){
			$checkleadallocationtableqry = "SELECT last_allocated_to,total_no_agents FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

			list($rowcount,$row3) = MainselectfuncNew($checkleadallocationtableqry);

			$last_allocated_to = $row3[0]["last_allocated_to"];
			$total_no_agents = $row3[0]["total_no_agents"];
			
			if($total_no_agents>$last_allocated_to){
				$sequence=$last_allocated_to+1;
			}
			else{
				$sequence=1;
			}	
			//echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
			$getCheckSQl = "SELECT * FROM lead_allocate WHERE AllRequestID = '".$AllRequestID."' AND BidderID in (".$BidderIDStr.")  ";
			list($getCheckNum,$row4) = MainselectfuncNew($getCheckSQl);
			if($getCheckNum>0){
				//Already Existing Lead
			}
			else{
				$bidderID = $BidderIDArr[$sequence];

				echo $bidderID.", ".$AllRequestID;
				if($AllRequestID>0 && $bidderID>1){
					//insert allocation
					$InsertDataArray = array("AllRequestID" =>$AllRequestID, "BidderID"=>$bidderID, "Reply_Type"=>4, "Allocated"=>0, "Allocation_Date"=>$Allocation_Date);
					Maininsertfunc('lead_allocate', $InsertDataArray);

					$UpdateDataArray = array("last_allocated_to" =>$sequence, "total_lead_count"=>$AllRequestID);
					$UpdateWhereCond ="(Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";
					Mainupdatefunc ('lead_allocation_table', $UpdateDataArray, $UpdateWhereCond);

				}
			}
			
		}
	}
}
/*ICICI Processed Lead Allocation End */



/*SCB Processed Lead Allocation Start*/
function processed_scb_leads_allocation(){
	$leadidentifier= 'scbprocessedleads';
	$lead_allocation_logic = 114;

	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersQry = "SELECT BidderID FROM Bidders WHERE (leadidentifier='".$leadidentifier."' AND Status=1) ORDER BY BidderID ASC";

	list($recordCountActiveBidders,$getActiveBidders) = MainselectfuncNew($getActiveBiddersQry);
	//echo '<pre>';print_r($getActiveBidders);exit;
	
	$BidderIDArr = '';
	$counterVal = 1;
	for($i=0;$i<$recordCountActiveBidders;$i++){
		$BidderID = $getActiveBidders[$i]['BidderID'];

		$BidderIDArr[$counterVal] = $BidderID;
		$counterVal = $counterVal + 1;
	}
	$BidderIDStr = implode(',', $BidderIDArr);
	
	$getLastAllocatedRequestIDQry="SELECT total_lead_count FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

	list($recordcount,$getLastAllocatedRequestID) = MainselectfuncNew($getLastAllocatedRequestIDQry);
	//echo '<pre>';print_r($getLastAllocatedRequestID);
	$LastAllocatedRequestID = $getLastAllocatedRequestID[0]["total_lead_count"];

	
	if($LastAllocatedRequestID){
		$sbiccqry = "SELECT `RequestID`,`Updated_Date` FROM `Req_Credit_Card` AS rcc JOIN `credit_card_banks_apply` AS ccba ON(rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'Standard Chartered' AND ccba.`response_data` LIKE '%Status -1%' AND rcc.RequestID >'".$LastAllocatedRequestID."' AND rcc.Updated_Date Between '".$min_date."' AND '".$max_date."' GROUP BY RequestID";
	}else{
		$sbiccqry = "SELECT `RequestID`,`Updated_Date` FROM `Req_Credit_Card` AS rcc JOIN `credit_card_banks_apply` AS ccba ON(rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'Standard Chartered' AND ccba.`response_data` LIKE '%Status -1%' AND rcc.Updated_Date Between '".$min_date."' AND '".$max_date."' GROUP BY RequestID";
		
	}
	echo $sbiccqry."<br>";
	//exit;

	list($recordcount1,$row2) = MainselectfuncNew($sbiccqry);
	//echo '<pre>';print_r($row2);exit;

	$bidderID="";

	foreach($row2 as $key=>$value){
		$AllRequestID = $value["RequestID"];
		$Allocation_Date = $value["Updated_Date"];
		if($AllRequestID>0){
			$checkleadallocationtableqry = "SELECT last_allocated_to,total_no_agents FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

			list($rowcount,$row3) = MainselectfuncNew($checkleadallocationtableqry);

			$last_allocated_to = $row3[0]["last_allocated_to"];
			$total_no_agents = $row3[0]["total_no_agents"];
			
			if($total_no_agents>$last_allocated_to){
				$sequence=$last_allocated_to+1;
			}
			else{
				$sequence=1;
			}	
			//echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
			$getCheckSQl = "SELECT * FROM lead_allocate WHERE AllRequestID = '".$AllRequestID."' AND BidderID in (".$BidderIDStr.")  ";
			list($getCheckNum,$row4) = MainselectfuncNew($getCheckSQl);
			if($getCheckNum>0){
				//Already Existing Lead
			}
			else{
				$bidderID = $BidderIDArr[$sequence];

				echo $bidderID.", ".$AllRequestID;
				if($AllRequestID>0 && $bidderID>1){
					//insert allocation
					$InsertDataArray = array("AllRequestID" =>$AllRequestID, "BidderID"=>$bidderID, "Reply_Type"=>4, "Allocated"=>0, "Allocation_Date"=>$Allocation_Date);
					Maininsertfunc('lead_allocate', $InsertDataArray);

					$UpdateDataArray = array("last_allocated_to" =>$sequence, "total_lead_count"=>$AllRequestID);
					$UpdateWhereCond ="(Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";
					Mainupdatefunc ('lead_allocation_table', $UpdateDataArray, $UpdateWhereCond);

				}
			}
			
		}
	}
}
/*SCB Processed Lead Allocation End */



/*RBL Processed Lead Allocation Start*/
function processed_rbl_leads_allocation(){
	$leadidentifier= 'rblprocessedleads';
	$lead_allocation_logic = 115;

	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersQry = "SELECT BidderID FROM Bidders WHERE (leadidentifier='".$leadidentifier."' AND Status=1) ORDER BY BidderID ASC";

	list($recordCountActiveBidders,$getActiveBidders) = MainselectfuncNew($getActiveBiddersQry);
	//echo '<pre>';print_r($getActiveBidders);exit;
	
	$BidderIDArr = '';
	$counterVal = 1;
	for($i=0;$i<$recordCountActiveBidders;$i++){
		$BidderID = $getActiveBidders[$i]['BidderID'];

		$BidderIDArr[$counterVal] = $BidderID;
		$counterVal = $counterVal + 1;
	}
	$BidderIDStr = implode(',', $BidderIDArr);
	
	$getLastAllocatedRequestIDQry="SELECT total_lead_count FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

	list($recordcount,$getLastAllocatedRequestID) = MainselectfuncNew($getLastAllocatedRequestIDQry);
	//echo '<pre>';print_r($getLastAllocatedRequestID);
	$LastAllocatedRequestID = $getLastAllocatedRequestID[0]["total_lead_count"];

	
	if($LastAllocatedRequestID){
		$sbiccqry = "SELECT `RequestID`,`Updated_Date` FROM `Req_Credit_Card` AS rcc JOIN `credit_card_banks_apply` AS ccba ON(rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'RBL Bank' AND ccba.`response_data` LIKE '%Status -1%' AND rcc.RequestID >'".$LastAllocatedRequestID."' AND rcc.Updated_Date Between '".$min_date."' AND '".$max_date."' GROUP BY RequestID";
	}else{
		$sbiccqry = "SELECT `RequestID`,`Updated_Date` FROM `Req_Credit_Card` AS rcc JOIN `credit_card_banks_apply` AS ccba ON(rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'RBL Bank' AND ccba.`response_data` LIKE '%Status -1%' AND rcc.Updated_Date Between '".$min_date."' AND '".$max_date."' GROUP BY RequestID";
	}
	echo $sbiccqry."<br>";
	//exit;

	list($recordcount1,$row2) = MainselectfuncNew($sbiccqry);
	//echo '<pre>';print_r($row2);exit;

	$bidderID="";

	foreach($row2 as $key=>$value){
		$AllRequestID = $value["RequestID"];
		$Allocation_Date = $value["Updated_Date"];
		if($AllRequestID>0){
			$checkleadallocationtableqry = "SELECT last_allocated_to,total_no_agents FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

			list($rowcount,$row3) = MainselectfuncNew($checkleadallocationtableqry);

			$last_allocated_to = $row3[0]["last_allocated_to"];
			$total_no_agents = $row3[0]["total_no_agents"];
			
			if($total_no_agents>$last_allocated_to){
				$sequence=$last_allocated_to+1;
			}
			else{
				$sequence=1;
			}	
			//echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
			$getCheckSQl = "SELECT * FROM lead_allocate WHERE AllRequestID = '".$AllRequestID."' AND BidderID in (".$BidderIDStr.")  ";
			list($getCheckNum,$row4) = MainselectfuncNew($getCheckSQl);
			if($getCheckNum>0){
				//Already Existing Lead
			}
			else{
				$bidderID = $BidderIDArr[$sequence];

				echo $bidderID.", ".$AllRequestID;
				if($AllRequestID>0 && $bidderID>1){
					//insert allocation
					$InsertDataArray = array("AllRequestID" =>$AllRequestID, "BidderID"=>$bidderID, "Reply_Type"=>4, "Allocated"=>0, "Allocation_Date"=>$Allocation_Date);
					Maininsertfunc('lead_allocate', $InsertDataArray);

					$UpdateDataArray = array("last_allocated_to" =>$sequence, "total_lead_count"=>$AllRequestID);
					$UpdateWhereCond ="(Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";
					Mainupdatefunc ('lead_allocation_table', $UpdateDataArray, $UpdateWhereCond);

				}
			}
			
		}
	}
}
/*RBL Processed Lead Allocation End */



/*AMEX Processed Lead Allocation Start*/
function processed_amex_leads_allocation(){
	$leadidentifier= 'amexprocessedleads';
	$lead_allocation_logic = 116;

	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersQry = "SELECT BidderID FROM Bidders WHERE (leadidentifier='".$leadidentifier."' AND Status=1) ORDER BY BidderID ASC";

	list($recordCountActiveBidders,$getActiveBidders) = MainselectfuncNew($getActiveBiddersQry);
	//echo '<pre>';print_r($getActiveBidders);exit;
	
	$BidderIDArr = '';
	$counterVal = 1;
	for($i=0;$i<$recordCountActiveBidders;$i++){
		$BidderID = $getActiveBidders[$i]['BidderID'];

		$BidderIDArr[$counterVal] = $BidderID;
		$counterVal = $counterVal + 1;
	}
	$BidderIDStr = implode(',', $BidderIDArr);
	
	$getLastAllocatedRequestIDQry="SELECT total_lead_count FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

	list($recordcount,$getLastAllocatedRequestID) = MainselectfuncNew($getLastAllocatedRequestIDQry);
	//echo '<pre>';print_r($getLastAllocatedRequestID);
	$LastAllocatedRequestID = $getLastAllocatedRequestID[0]["total_lead_count"];

	
	if($LastAllocatedRequestID){
		$sbiccqry = "SELECT `RequestID`,`Updated_Date` FROM `Req_Credit_Card` AS rcc JOIN `credit_card_banks_apply` AS ccba ON(rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'American Express' AND ccba.`response_data` LIKE '%<success>true</success>%' AND rcc.RequestID >'".$LastAllocatedRequestID."' AND rcc.Updated_Date Between '".$min_date."' AND '".$max_date."' GROUP BY RequestID";
	}else{
		$sbiccqry = "SELECT `RequestID`,`Updated_Date` FROM `Req_Credit_Card` AS rcc JOIN `credit_card_banks_apply` AS ccba ON(rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'American Express' AND ccba.`response_data` LIKE '%<success>true</success>%' AND rcc.Updated_Date Between '".$min_date."' AND '".$max_date."' GROUP BY RequestID";
	}
	echo $sbiccqry."<br>";
	//exit;

	list($recordcount1,$row2) = MainselectfuncNew($sbiccqry);
	//echo '<pre>';print_r($row2);exit;

	$bidderID="";

	foreach($row2 as $key=>$value){
		$AllRequestID = $value["RequestID"];
		$Allocation_Date = $value["Updated_Date"];
		if($AllRequestID>0){
			$checkleadallocationtableqry = "SELECT last_allocated_to,total_no_agents FROM lead_allocation_table WHERE (Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";

			list($rowcount,$row3) = MainselectfuncNew($checkleadallocationtableqry);

			$last_allocated_to = $row3[0]["last_allocated_to"];
			$total_no_agents = $row3[0]["total_no_agents"];
			
			if($total_no_agents>$last_allocated_to){
				$sequence=$last_allocated_to+1;
			}
			else{
				$sequence=1;
			}	
			//echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
			$getCheckSQl = "SELECT * FROM lead_allocate WHERE AllRequestID = '".$AllRequestID."' AND BidderID in (".$BidderIDStr.")  ";
			list($getCheckNum,$row4) = MainselectfuncNew($getCheckSQl);
			if($getCheckNum>0){
				//Already Existing Lead
			}
			else{
				$bidderID = $BidderIDArr[$sequence];

				echo $bidderID.", ".$AllRequestID;
				if($AllRequestID>0 && $bidderID>1){
					//insert allocation
					$InsertDataArray = array("AllRequestID" =>$AllRequestID, "BidderID"=>$bidderID, "Reply_Type"=>4, "Allocated"=>0, "Allocation_Date"=>$Allocation_Date);
					Maininsertfunc('lead_allocate', $InsertDataArray);

					$UpdateDataArray = array("last_allocated_to" =>$sequence, "total_lead_count"=>$AllRequestID);
					$UpdateWhereCond ="(Citywise='".$leadidentifier."' AND lead_allocation_logic='".$lead_allocation_logic."')";
					Mainupdatefunc ('lead_allocation_table', $UpdateDataArray, $UpdateWhereCond);

				}
			}
			
		}
	}
}
/*AMEX Processed Lead Allocation End */

?>
