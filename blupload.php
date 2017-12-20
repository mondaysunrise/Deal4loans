<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';

/*
 * Fullerton bank PL Function called
 * parameters 1- $source, 2-$lead_allocation_logic, 3-$Global_Access_ID
 */

BLuploadAccount();
indusindbankplAllCity();//Yaswant 020817 Indusind bank for ALL City
indusindbankplDMP();

indusindbankplBCH('CallerAccountINDUSINDBCH', 90, 6803); // Bangalore, Hyderabad,Kolkata, Vizag
indusindbankplBCH('CallerAccountINDUSINDCLK', 166, 7483); // for Chennai,Lucknow,and Small City // 08-11-2017 - Yaswant
//indusindbankplCKP();
rblbankplMCK();
rblbankplDH();
rblbankplBHC();
rblbankplDMP();
hdfcbackprocess_leads_allocation();

//Fullerton backcalling Process 
backCallingProcessLeadAllocation('Fullerton_pl_backcalling','fullertonbackcalling',145);

// Back Calling  Allocation Process End
//Kotak backcalling Process Delhi NCR City
KotakbackCallingLeadAllocation('kotak_pl_delhi_backcalling', 'kotakbackcallingDelhi', 146);

//Kotak backcalling Process JCK City
//KotakbackCallingLeadAllocation('Kotak_pl_backcalling', 'kotakbackcallingJCK', 147);

//Kotak backcalling Process Others City
KotakbackCallingLeadAllocation('Kotak_pl_backcalling', 'kotakbackcallingOthers', 148);


/*
 * Fullerton bank PL Function called
 * parameters 1- $source, 2-$lead_allocation_logic, 3-$Global_Access_ID
 */
echo FullertonBankplABJJRS('Fullertonpllms', 156, 7340);
echo "<br>";
echo FullertonBankplABJJRS('Fullertonpllms7444', 164, 7444); // Yaswant 091017 Fullerton Bank Ahmedabad,Baroda,Jaipur,Jodhpur,Rajkot,Surat
echo "<hr />";
CapitalFirstBankSal('capitalfirstSalLMS', 183, 7525);
echo "<hr />";

echo FullertonBankplABJJRS('Fullertonpllms4665', 184, 4665); // Yaswant 141117 Fullerton Bank Kolkata

FullertonBankPLFICCL('fullertoncalling_MUM', 167, 7493);
echo "<hr />";
FullertonBankPLFICCL('fullertoncalling_PUNBAN', 168, 7494);
echo "<hr />";
FullertonBankPLFICCL('fullertoncalling_HYD', 169, 7495);
echo "<hr />";
FullertonBankPLFICCL('fullertoncalling_MUMALL', 170, 7496);
echo "<hr />";

SCBBankPL_Calling('SMS_SCB_CALLING', 189, 7606); // SCB Data Upload 
echo "<hr />";

HDBFinance_PL_Calling('SMS_HDBFINANCE_CALLING', 191,'sms_pl_hdb'); // HDB Finance Data Upload
echo "<hr />";

/*
 * BFL Calling LMS
 * Tables Use : lead_allocation_table,Bidders,Req_Loan_Personal,lead_allocate
 * Param 1 : source - sms_pl_bfl
 * param 2 : Leadidentifier - sms_bflcalling_pl
 * param 3 : LeadAllocationLogicID - 196
 */
smsBFLPL('sms_pl_bfl', 'sms_bflcalling_pl', 196);

//Start Business Loan upload
function BLuploadAccount()
{
	$source = 'CallingUploadBL';
	$lead_allocation_logic = 134;
	$Global_Access_ID = 7107;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select RequestID From Req_Loan_Personal Where (source like '%SMS_BL_UPLOAD%' and RequestID>'".$total_lead_count."' and Updated_Date between '".$min_date."' and '".$max_date."') order by RequestID ASC ";
	}
	else
	{
		$citibankplqry="Select RequestID From Req_Loan_Personal Where (source like '%SMS_BL_UPLOAD%' and Updated_Date between '".$min_date."' and '".$max_date."') order by RequestID ASC ";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	$recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["RequestID"];
		echo $AllRequestID = $row2["RequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End Business Loan Upload

//Start IndusInd Bank All City
function indusindbankplAllCity()
{
	$source = 'CallerAccountINDUSINDALL';
	$lead_allocation_logic = 133;
	$Global_Access_ID = 7127;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	echo $recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End IndusInd Bank ALL City

//Start Indusind bank for Delhi,Mumbai,Pune
function indusindbankplDMP()
{
	$source = 'CallerAccountINDUSINDDMP';
	$lead_allocation_logic = 89;
	$Global_Access_ID = 6802;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	echo $recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End Indusind bank for Delhi,Mumbai,Pune

//Start Indusind bank for Bangalore,Chennai,Hyderabad
function indusindbankplBCH($source,$lead_allocation_logic,$Global_Access_ID)
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	echo $recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
}
 //End Indusind bank for Bangalore,Hyderabad

//Start Indusind bank for Chennai,Pune, Kolkata
function indusindbankplCKP()
{
	$source = 'CallerAccountINDUSINDCKP';
	$lead_allocation_logic = 111;
	$Global_Access_ID = 6988;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
       while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	$trbidder=implode("','",$arrBidderID);
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	//print_r($arrCallerrID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	//echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	echo $recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		$AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
}
//end Indusind bank for Chennai,Pune, Kolkata

//Start RBL Bank Calling Process Mumbai Chennai Kolkata
function rblbankplMCK() {
    $source = 'CallerAccountRBLMCK';
    $lead_allocation_logic = 140;
    $Global_Access_ID = 7183;
    $currentdate = Date('Y-m-d');
    //$currentdate="2017-04-20";
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $source . "' and Status=1) order by BidderID ASC");
    while ($rowcal = mysql_fetch_array($arrcallerqry)) {
        $arrCallerrID[$counterVal] = $rowcal["BidderID"];
        $counterVal = $counterVal + 1;
    }
    print_r($arrCallerrID);

    //die();
    while ($row2 = mysql_fetch_array($citiplqryresult)) {
        $Feedback_ID = $row2["Feedback_ID"];
        echo $AllRequestID = $row2["AllRequestID"];
        $BidderID = $row2["BidderID"];
        $Allocation_Date = $row2["Updated_Date"];

        if ($AllRequestID > 0) {
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')");
            $seqid = mysql_fetch_array($sequenceid);
            $last_allocated_to = $seqid["last_allocated_to"];
            $total_no_agents = $seqid["total_no_agents"];

            if ($total_no_agents > $last_allocated_to) {
                $sequence = $last_allocated_to + 1;
            } else {
                $sequence = 1;
            }

            $getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '" . $Feedback_ID . "' and BidderID=" . $BidderID . ")";

            $getCheckQuery = ExecQuery($getCheckSQl);
            $getCheckNum = mysql_num_rows($getCheckQuery);
            if ($getCheckNum > 0) {
                //Already Existing Lead
            } else {
                $callerID = $arrCallerrID[$sequence];
                if ($AllRequestID > 0 && $callerID > 1) {
                    //insert allocation
                    $final_allocationciti = "INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('" . $Feedback_ID . "','" . $AllRequestID . "','" . $callerID . "','1', Now())";
                    $final_allocationcitiresult = ExecQuery($final_allocationciti);
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
                    echo "<br>" . $final_allocationciti . "<br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}
//End RBL Bank Calling Process Mumbai Chennai Kolkata

//Start RBL Bank Calling Process Delhi, hyderabad
function rblbankplDMP()
{
	$source = 'CallerAccountRBLDMP';
	$lead_allocation_logic = 92;
	$Global_Access_ID = 6799;
	$currentdate=Date('Y-m-d');
	//$currentdate="2017-04-20";
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	$recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End RBL Bank Calling Process Delhi, hyderabad

//Start RBL Bank Calling Process Bangalore, chennai
function rblbankplBHC()
{
	$source = 'CallerAccountRBLBHC';
	$lead_allocation_logic = 93;
	$Global_Access_ID = 6800;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	$recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End RBL Bank Calling Process Bangalore chennai

//RBL Bank Calling Process Mumbai Pune
function rblbankplDH()
{
                $source = 'CallerAccountRBLDH';
                $lead_allocation_logic = 98;
                $Global_Access_ID = 6823;
                $currentdate=Date('Y-m-d');
                //$currentdate="2017-04-20";
                $min_date = $currentdate." 00:00:00";
                $max_date = $currentdate." 23:59:59";
                
                $startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
                echo $startprocess."<br><br>";
                $startprocessresult = ExecQuery($startprocess);
                $recordcount = mysql_num_rows($startprocessresult);
                $row=mysql_fetch_array($startprocessresult);
                echo $total_lead_count = $row["total_lead_count"];
                
                $arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
                while($rowbid=mysql_fetch_array($arrbidderqry))
                {
                                $arrBidderID[] = $rowbid["BidderID"];
                }
                echo $trbidder=implode("','",$arrBidderID);
                
                if($total_lead_count>0)
                {
                         $citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
                }
                else
                {
                    $citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
                }
                echo $citibankplqry."<br>";
                $citiplqryresult = ExecQuery($citibankplqry);
                $recordcount1 = mysql_num_rows($citiplqryresult);
                $bidderID="";
                
                $counterVal = 1;
                $arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
                while($rowcal=mysql_fetch_array($arrcallerqry))
                {
                                $arrCallerrID[$counterVal] = $rowcal["BidderID"];
                                $counterVal = $counterVal + 1;
                }
		print_r($arrCallerrID);

		//die();

		while($row2 = mysql_fetch_array($citiplqryresult))
		{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];

		if($AllRequestID>0)
		{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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

		$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";

		$getCheckQuery = ExecQuery($getCheckSQl);
		$getCheckNum = mysql_num_rows($getCheckQuery);
		if($getCheckNum>0)
		{
						//Already Existing Lead
		}
		else
		{
						$callerID = $arrCallerrID[$sequence];
						if($AllRequestID>0 && $callerID>1)
						{
										//insert allocation
										$final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
										$final_allocationcitiresult = ExecQuery($final_allocationciti);
						$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
						echo "<br>".$final_allocationciti."<br>";
						$updateqryresult = ExecQuery($updateqry);
										echo "<br><br>";
						}
		}
		$getCheckNum = '';
		}
		}
} //End RBL Bank Calling Process Mumbai Pune


//Back Calling Allocation Process Start
function backCallingProcessLeadAllocation($Source,$leadidentifier, $leadAllocationLogic) {

    $lead_allocation_logic = $leadAllocationLogic;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $getActiveBiddersSql = "Select BidderID from Bidders Where (leadidentifier='" . $leadidentifier . "' and Status=1) order by BidderID ASC";
    $getActiveBiddersQry = ExecQuery($getActiveBiddersSql);
    $recordCountActiveBidders = mysql_num_rows($getActiveBiddersQry);
    $BidderIDArr = '';
    $counterVal = 1;
    for ($i = 0; $i < $recordCountActiveBidders; $i++) {
        $BidderID = mysql_result($getActiveBiddersQry, $i, 'BidderID');
        $BidderIDArr[$counterVal] = $BidderID;
        $counterVal = $counterVal + 1;
    }
    echo $BidderIDStr = implode(',', $BidderIDArr);

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    $total_lead_count = $row["total_lead_count"];

    if ($total_lead_count > 0) {
       echo  $sbiccqry = "select RequestID,Updated_Date,source,callerid from  Req_PL_BackCalling Where ((Dated between '" . $min_date . "' and '" . $max_date . "') and  RequestID>'" . $total_lead_count . "' and source='".$Source."')";
    }
    echo $sbiccqry . "<br>";
    $select4mcardsresult = ExecQuery($sbiccqry);
    $recordcount1 = mysql_num_rows($select4mcardsresult);
    $bidderID = "";
//die();

    while ($row2 = mysql_fetch_array($select4mcardsresult)) {
        $AllRequestID = $row2["RequestID"];
        $Allocation_Date = $row2["Updated_Date"];
        $Feedback_ID = $row2["RequestID"];
        $callerid = $row2["callerid"];

        if ($AllRequestID > 0) {
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')");
            $seqid = mysql_fetch_array($sequenceid);
            $last_allocated_to = $seqid["last_allocated_to"];
            $total_no_agents = $seqid["total_no_agents"];

            if ($total_no_agents > $last_allocated_to) {
                $sequence = $last_allocated_to + 1;
            } else {
                $sequence = 1;
            }
            echo "<br> Seq - " . $sequence . ", " . $last_allocated_to . ", " . $total_no_agents . "<br>";
            $getCheckSQl = "select * from lead_allocate where AllRequestID = '" . $AllRequestID . "' and BidderID in (" . $BidderIDStr . ")  ";
            $getCheckQuery = ExecQuery($getCheckSQl);
            $getCheckNum = mysql_num_rows($getCheckQuery);
            if ($getCheckNum > 0) {
                //Already Existing Lead
            } else {
                if (trim($callerid > 0)) {
                    $bidderID = trim($callerid);
                } else {
                    $bidderID = $BidderIDArr[$sequence];
                }
//				
                echo $bidderID . ", " . $AllRequestID;
                if ($AllRequestID > 0 && $bidderID > 1) {
                    //insert allocation
                    //echo "<br><br>";
                    $inserticiciqry = "INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('" . $AllRequestID . "', '" . $bidderID . "', '12', '0', '" . $Allocation_Date . "');";
                    $inserticiciqryresult = ExecQuery($inserticiciqry);
                    echo $inserticiciqry . "<br><br>";
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $AllRequestID . "' Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
                    $updateqryresult = ExecQuery($updateqry);
                    echo $updateqry . "<br><br>";
                }
            }
        }
    }
}
// Back Calling  Allocation Process End

//Kotak Back Calling Allocation Process Start
function KotakbackCallingLeadAllocation($Source, $leadidentifier, $leadAllocationLogic) {
    $lead_allocation_logic = $leadAllocationLogic;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $getActiveBiddersSql = "Select BidderID,City from Bidders Where (leadidentifier='" . $leadidentifier . "' and Status=1) order by BidderID ASC";
    $getActiveBiddersQry = ExecQuery($getActiveBiddersSql);
    $recordCountActiveBidders = mysql_num_rows($getActiveBiddersQry);
    $BidderIDArr = '';
    $counterVal = 1;
    for ($i = 0; $i < $recordCountActiveBidders; $i++) {
        $BidderID = mysql_result($getActiveBiddersQry, $i, 'BidderID');
        $BidderIDArr[$counterVal] = $BidderID;
        $counterVal = $counterVal + 1;
        $CityName = mysql_result($getActiveBiddersQry, $i, 'City');
           echo "<br>";
    }
     $CityName = mysql_result($getActiveBiddersQry, 0, 'City');
    $BidderIDStr = implode(',', $BidderIDArr);
    echo $CityVal = str_replace(',', "','", $CityName);
    echo "<br>";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"] . "<br>";
    
    /*if ($leadidentifier == 'kotakbackcallingDelhi') {
        $cityclause = " AND City in ('$CityVal')";
    } elseif ($leadidentifier == 'kotakbackcallingJCK') {
        $cityclause = " AND City in ('$CityVal')";
    } else {
        $cityclause = "";
    }*/
    if ($total_lead_count > 0) {
        //echo $sbiccqry = "select RequestID,Updated_Date,source,callerid,City from  Req_PL_BackCalling Where ((Dated between '" . $min_date . "' and '" . $max_date . "') " . $cityclause . " and Allocated='0' and RequestID>'" . $total_lead_count . "' and source='" . $Source . "')";
        echo $sbiccqry = "select RequestID,Updated_Date,source,callerid,City from  Req_PL_BackCalling Where ((Dated between '" . $min_date . "' and '" . $max_date . "') and Allocated='0' and RequestID>'" . $total_lead_count . "' and source='" . $Source . "')";
    }
    echo $sbiccqry . "<br>";
    $select4mcardsresult = ExecQuery($sbiccqry);
    $recordcount1 = mysql_num_rows($select4mcardsresult);
    $bidderID = "";
//die();

    while ($row2 = mysql_fetch_array($select4mcardsresult)) {
        $AllRequestID = $row2["RequestID"];
        $Allocation_Date = $row2["Updated_Date"];
        $Feedback_ID = $row2["RequestID"];
        $callerid = $row2["callerid"];
        $City = $row2["City"];

        if ($AllRequestID > 0) {

            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')");
            $seqid = mysql_fetch_array($sequenceid);
            $last_allocated_to = $seqid["last_allocated_to"];
            $total_no_agents = $seqid["total_no_agents"];

            if ($total_no_agents > $last_allocated_to) {
                $sequence = $last_allocated_to + 1;
            } else {
                $sequence = 1;
            }
            echo "<br> Seq - " . $sequence . ", " . $last_allocated_to . ", " . $total_no_agents . "<br>";
            $getCheckSQl = "select * from lead_allocate where AllRequestID = '" . $AllRequestID . "' and BidderID in (" . $BidderIDStr . ")  ";
            $getCheckQuery = ExecQuery($getCheckSQl);
            $getCheckNum = mysql_num_rows($getCheckQuery);
            if ($getCheckNum > 0) {
                //Already Existing Lead
            } else {
                if (trim($callerid > 0)) {
                    $bidderID = trim($callerid);
                } else {
                    $bidderID = $BidderIDArr[$sequence];
                }
//				
                echo $bidderID . ", " . $AllRequestID . "<br>";
                if ($AllRequestID > 0 && $bidderID > 1) {
                    //insert allocation
                    //echo "<br><br>";
                   
                        $inserticiciqry = "INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('" . $AllRequestID . "', '" . $bidderID . "', '12', '0', '" . $Allocation_Date . "');";
                        $inserticiciqryresult = ExecQuery($inserticiciqry);
                        echo $inserticiciqry . "<br><br>";
                        $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $AllRequestID . "' Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
                        $updateqryresult = ExecQuery($updateqry);
                        echo $updateqry . "<br><br>";
                        
                        //Update Allocate =1;
                        $AllocUpdateSql = "Update Req_PL_BackCalling set Allocated='1' Where (RequestID='" . $AllRequestID . "')";
                         $AllocUpdateResult = ExecQuery($AllocUpdateSql);
                        
                  
                }
            }
        }
    }
    echo "<hr />";
}
// Kotak Back Calling Allocation Process End

//Start Fullerton Bank Ahmedabad,Baroda,Jaipur,Jodhpur,Rajkot,Surat
function FullertonBankplABJJRS($source, $lead_allocation_logic, $Global_Access_ID) {

    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID LIKE '%" . $Global_Access_ID . "%')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);


    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $Global_Access_ID . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC ";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $Global_Access_ID . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $source . "' and Status=1) order by BidderID ASC");
    while ($rowcal = mysql_fetch_array($arrcallerqry)) {
        $arrCallerrID[$counterVal] = $rowcal["BidderID"];
        $counterVal = $counterVal + 1;
    }

    print_r($arrCallerrID);

    //die();

    while ($row2 = mysql_fetch_array($citiplqryresult)) {
        $Feedback_ID = $row2["Feedback_ID"];
        echo $AllRequestID = $row2["AllRequestID"];
        echo "<br>";
        echo $BidderID = $row2["BidderID"];

        $Allocation_Date = $row2["Updated_Date"];

        if ($AllRequestID > 0) {
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')");
            $seqid = mysql_fetch_array($sequenceid);
            $last_allocated_to = $seqid["last_allocated_to"];
            $total_no_agents = $seqid["total_no_agents"];

            if ($total_no_agents > $last_allocated_to) {
                $sequence = $last_allocated_to + 1;
            } else {
                $sequence = 1;
            }

            echo $getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '" . $Feedback_ID . "' and BidderID=" . $BidderID . ")";

            $getCheckQuery = ExecQuery($getCheckSQl);
            $getCheckNum = mysql_num_rows($getCheckQuery);
            if ($getCheckNum > 0) {
                //Already Existing Lead
            } else {


                $callerID = $arrCallerrID[$sequence];

                if ($AllRequestID > 0 && $callerID > 1) {

//insert allocation
                    $final_allocationciti = "INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('" . $Feedback_ID . "','" . $AllRequestID . "','" . $callerID . "','1', Now())";
                    $final_allocationcitiresult = ExecQuery($final_allocationciti);
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
                    echo "<br>" . $final_allocationciti . "<br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//End Fullerton Bank Ahmedabad,Baroda,Jaipur,Jodhpur,Rajkot,Surat


//HDFC Back Calling Process Start
function hdfcbackprocess_leads_allocation()
{
	$leadidentifier= 'hdfcback_calling';
	$lead_allocation_logic = 165;

	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."' and Status=1) order by BidderID ASC";
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
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{	
		$sbiccqry="select RequestID,Updated_Date,source,callerid from  Req_PL_BackCalling Where ((Dated between '".$min_date."' and '".$max_date."') and  RequestID>'".$total_lead_count."' and source='hdfcpl_backcalling')";
	}
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
//die();
	
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["RequestID"];
		$callerid = $row2["callerid"];
		
		if($AllRequestID>0)
		{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
				$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")  ";
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{			
					if(trim($callerid>0))
					{
						$bidderID = trim($callerid);
					}
					else
					{
					$bidderID = $BidderIDArr[$sequence];
					}
//				
					echo $bidderID.", ".$AllRequestID;
					if($AllRequestID>0 && $bidderID>1)
					{
						//insert allocation
						//echo "<br><br>";
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '12', '0', '".$Allocation_Date."');";
						$inserticiciqryresult = ExecQuery($inserticiciqry);
		echo  $inserticiciqry."<br><br>";
						$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
						$updateqryresult = ExecQuery($updateqry);
						echo $updateqry."<br><br>";
					}
				}
		}
	}
}
//HDFC Back Calling Process End

//Start Capital First Bank
function CapitalFirstBankSal($source,$lead_allocation_logic,$Global_Access_ID)
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
        //echo "Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')";
        
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	echo $recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
}
 //End Capital First Bank

//Start Fullerton Bank
function FullertonBankPLFICCL($source,$lead_allocation_logic,$Global_Access_ID)
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	echo $recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
}
 //End Fullerton Bank

function SCBBankPL_Calling($LeadIdentifier,$lead_allocation_logic,$Global_Access_ID) {
    
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $LeadIdentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    if ($total_lead_count > 0) {
        $citibankplqry="select RequestID,Updated_Date,source from  Req_Loan_Personal Where (source='sms_pl_scb' and RequestID>'".$total_lead_count."'  and Updated_Date between '" . $min_date . "' and '" . $max_date . "') ";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    
    
    
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $LeadIdentifier . "' and Status=1) order by BidderID ASC");
    while ($rowcal = mysql_fetch_array($arrcallerqry)) {
        $arrCallerrID[$counterVal] = $rowcal["BidderID"];
        $counterVal = $counterVal + 1;
    }
    echo $strCallerBidder = implode("','", $arrCallerrID);

    while ($row2 = mysql_fetch_array($citiplqryresult)) {
        $Feedback_ID = $row2["RequestID"];
        echo $AllRequestID = $row2["RequestID"];
        $Allocation_Date = $row2["Updated_Date"];

        if ($AllRequestID > 0) {
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $LeadIdentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')");
            $seqid = mysql_fetch_array($sequenceid);
            $last_allocated_to = $seqid["last_allocated_to"];
            $total_no_agents = $seqid["total_no_agents"];

            if ($total_no_agents > $last_allocated_to) {
                $sequence = $last_allocated_to + 1;
            } else {
                $sequence = 1;
            }

         echo   $getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '" . $Feedback_ID . "' and BidderID in (" . $strCallerBidder . ")";

            $getCheckQuery = ExecQuery($getCheckSQl);
            $getCheckNum = mysql_num_rows($getCheckQuery);
            if ($getCheckNum > 0) {
                //Already Existing Lead
            } else {
                $callerID = $arrCallerrID[$sequence];
                if ($AllRequestID > 0 && $callerID > 1) {
                    //insert allocation
                    $final_allocationciti = "INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('" . $Feedback_ID . "','" . $AllRequestID . "','" . $callerID . "','1', Now())";
                    $final_allocationcitiresult = ExecQuery($final_allocationciti);
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='" . $LeadIdentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
                    echo "<br>" . $final_allocationciti . "<br>";
                   $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

function HDBFinance_PL_Calling($LeadIdentifier,$lead_allocation_logic,$LeadSource) {
    
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $LeadIdentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    if ($total_lead_count > 0) {
        $citibankplqry="select RequestID,Updated_Date,source from  Req_Loan_Personal Where (source='".$LeadSource."' and RequestID>'".$total_lead_count."'  and Updated_Date between '" . $min_date . "' and '" . $max_date . "') ";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $LeadIdentifier . "' and Status=1) order by BidderID ASC");
    while ($rowcal = mysql_fetch_array($arrcallerqry)) {
        $arrCallerrID[$counterVal] = $rowcal["BidderID"];
        $counterVal = $counterVal + 1;
    }
    echo $strCallerBidder = implode("','", $arrCallerrID);
    while ($row2 = mysql_fetch_array($citiplqryresult)) {
        $Feedback_ID = $row2["RequestID"];
        echo $AllRequestID = $row2["RequestID"];
        $Allocation_Date = $row2["Updated_Date"];

        if ($AllRequestID > 0) {
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $LeadIdentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')");
            $seqid = mysql_fetch_array($sequenceid);
            $last_allocated_to = $seqid["last_allocated_to"];
            $total_no_agents = $seqid["total_no_agents"];

            if ($total_no_agents > $last_allocated_to) {
                $sequence = $last_allocated_to + 1;
            } else {
                $sequence = 1;
            }

         echo   $getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '" . $Feedback_ID . "' and BidderID in (" . $strCallerBidder . ")";

            $getCheckQuery = ExecQuery($getCheckSQl);
            $getCheckNum = mysql_num_rows($getCheckQuery);
            if ($getCheckNum > 0) {
                //Already Existing Lead
            } else {
                $callerID = $arrCallerrID[$sequence];
                if ($AllRequestID > 0 && $callerID > 1) {
                    //insert allocation
                    $final_allocationciti = "INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('" . $Feedback_ID . "','" . $AllRequestID . "','" . $callerID . "','1', Now())";
                    $final_allocationcitiresult = ExecQuery($final_allocationciti);
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='" . $LeadIdentifier . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
                    echo "<br>" . $final_allocationciti . "<br>";
                   $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//BFL SMS Leads Start
function smsBFLPL($Source, $leadidentifier, $leadAllocationLogic) {
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $leadAllocationLogic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];
    echo "<br>";

    $arrCallerrID = '';
    $allcounterVal = 1;
    $allarrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $leadidentifier . "' and Status=1) order by BidderID ASC");
    while ($allrowcal = mysql_fetch_array($allarrcallerqry)) {
        $arrCallerrID[$allcounterVal] = $allrowcal["BidderID"];
        $allcounterVal = $allcounterVal + 1;
    }
    echo "All Agents - ";
    echo $allarrCallerrIDStr = implode("','", $arrCallerrID); // Get All Agents
    echo "<br>";

    echo "<br>";
    if ($total_lead_count > 0) {
        $smsplqry = "select RequestID,Updated_Date from  Req_Loan_Personal Where ((source ='" . $Source . "') and RequestID>'" . $total_lead_count . "' and Updated_Date  between '" . $min_date . "' and '" . $max_date . "')";
    }
    echo $smsplqry . "<br>";

//	die();
    $smsplqryresult = ExecQuery($smsplqry);
    $recordcount1 = mysql_num_rows($smsplqryresult);
    $bidderID = "";

    while ($row2 = mysql_fetch_array($smsplqryresult)) {
        echo "hello";
        $AllRequestID = $row2["RequestID"];
        $Allocation_Date = $row2["Updated_Date"];
        $DOE = $row2["Updated_Date"];

        if ($AllRequestID > 0) {
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $leadAllocationLogic . "')");
           
            $seqid = mysql_fetch_array($sequenceid);
            $last_allocated_to = $seqid["last_allocated_to"];
            $total_no_agents = $seqid["total_no_agents"];

            if ($total_no_agents > $last_allocated_to) {
                $sequence = $last_allocated_to + 1;
            } else {
                $sequence = 1;
            }

            $getCheckSQl = "select * from lead_allocate where AllRequestID = '" . $AllRequestID . "' and BidderID in ('" . $allarrCallerrIDStr . "')";
            echo "<br>";
            echo $getCheckSQl;
            echo "<br>";
            $getCheckQuery = ExecQuery($getCheckSQl);
            $getCheckNum = mysql_num_rows($getCheckQuery);
            if ($getCheckNum > 0) {
                //Already Existing Lead
                echo "In if condition";
            } else {
                echo "else ";
                echo $callerID = $arrCallerrID[$sequence];
                if ($AllRequestID > 0 && $callerID > 1) {
                    //insert allocation
                    echo "<br><br>";
                    echo $inserticiciqry = "INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('" . $AllRequestID . "', '" . $callerID . "', '1', '0', '" . $Allocation_Date . "');";
                    $inserticiciqryresult = ExecQuery($inserticiciqry);
                    echo "<br><br>";
                    echo $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $AllRequestID . "' Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $leadAllocationLogic . "')";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

?>