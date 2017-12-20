<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	
	$qry1=str_replace("\'", "'", $qry1);
	
	$search_result=ExecQuery($qry1);
	
	while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["Marital_Status"]==1) {  $marital_status="Single"; } else { $marital_status="Married"; }
		if($row_result["Residential_Status"]==0) { $residential_status="not available"; } 
		if($row_result["Residential_Status"]==1) { $residential_status="Owned By Parent/Sibling"; }  if($row_result["Residential_Status"]==2) { $residential_status="Rented Staying alone"; } if($row_result["Residential_Status"]==3) { $residential_status="Company Provided"; }
			if($row_result["Residential_Status"]==4) { $residential_status="Owned By Self/Spouse"; }  
			if($row_result["Residential_Status"]==5) { $residential_status="Rented - With Family"; }  
			if($row_result["Residential_Status"]==6) { $residential_status="Rented - With Friends"; }  
			if($row_result["Residential_Status"]==7) { $residential_status="Paying Guest"; }  
			if($row_result["Residential_Status"]==8) { $residential_status="Hostel"; }  


		if($row_result["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_result["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_result["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
		if($row_result["Loan_Any"]==0) { $loan_any="N/A"; } if($row_result["Loan_Any"]==1) { $loan_any="Car Loan"; } 	if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
		
		if($row_result["EMI_Paid"]=="0") { $emi_paid="Please select"; }
		if($row_result["EMI_Paid"]=="1") { $emi_paid="Less than 6 months"; }
		if($row_result["EMI_Paid"]=="2") { $emi_paid="6 to 9 months"; }
		if($row_result["EMI_Paid"]=="3") { $emi_paid="9 to 12 months"; }
		if($row_result["EMI_Paid"]=="4") { $emi_paid="more than 12 months"; }
				if($row_result["EMI_Paid"]=="") { $emi_paid=""; }

		if($row_result["Card_Vintage"]=="0") { $card_vintage=""; }
		if($row_result["Card_Vintage"]=="1") { $card_vintage="Less than 6 months"; }
		if($row_result["Card_Vintage"]=="2") { $card_vintage="6 to 9 months"; }
		if($row_result["Card_Vintage"]=="3") { $card_vintage="9 to 12 months"; }
		if($row_result["Card_Vintage"]=="4") { $card_vintage="more than 12 months"; }	

		if($row_result["Salary_Drawn"]==0) { $Salary_Drawn="Not available"; }
		if($row_result["Salary_Drawn"]==1) { $Salary_Drawn="Cash"; }
		if($row_result["Salary_Drawn"]==2) { $Salary_Drawn="Cheque"; }
		if($row_result["Salary_Drawn"]==3) { $Salary_Drawn="Account Transfer"; }
		
		 if($row_result["IsProcessed"]==1 && $row_result["Direct_Allocation"]==1 && $row_result["Bidder_Count"]>0) 
			{
			$feedbck="Sent Direct";
			 } 
			 else if($row_result["IsProcessed"]==1 && $row_result["Direct_Allocation"]==0 && $row_result["Bidder_Count"]>0)
			{
					$feedbck="Sent Via LMS";
			}
			else if($row_result["IsProcessed"]==1 && $row_result["Direct_Allocation"]==0 && $row_result["Bidder_Count"]==0)
			{
				$feedbck=$row_result["Feedback"];
			}
			else if($row_result["IsProcessed"]==1 && $row_result["Direct_Allocation"]==1 && $row_result["Bidder_Count"]==0) 
			{
				$feedbck="Direct NE";
			}
			else
		{
			$feedbck=$row_result["Feedback"];
		}
	$BidderID="";
	
	$BiddersChurn="SELECT Bidder_Name,Req_Feedback_Bidder_PL.BidderID As bid FROM Req_Feedback_Bidder_PL LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder_PL.BidderID and Bidders_List.Reply_Type =1 WHERE (AllRequestID = '".$row_result["RequestID"]."' AND Req_Feedback_Bidder_PL.Reply_Type =1)";
	//echo $BiddersChurn;
	$BiddersChurnSql = ExecQuery($BiddersChurn);
	$NumRowBiddersChurnSql = mysql_num_rows($BiddersChurnSql);
	while($newrow=mysql_fetch_array($BiddersChurnSql))
				{
			$BidderID[]=$newrow["Bidder_Name"]."(".$newrow["bid"].")";
			//print_r($BidderID);
				}
			
	$descr=implode(',', $BidderID);		
		
	$sqlFeeds = "SELECT Feedback FROM `Req_Feedback_PL` where AllRequestID='".$row_result["RequestID"]."' and BidderID in (846,847,854,9,10) and Reply_Type=1";
	$queryFeeds = ExecQuery($sqlFeeds);
	$FeedbackLMS = mysql_result($queryFeeds,0,'Feedback');
	
		if($row_result["Is_Permit"]==1)
		{
			$Is_Permit="Yes";
		}
		else
		{
			$Is_Permit="No";
		}
		$AnnualTurnover = '';
		$Annual_Turnover = $row_result["Annual_Turnover"];
		if($Annual_Turnover==1)
		{
			$AnnualTurnover = 'Less Than 1 Cr';
		}
		else if($Annual_Turnover==2)
		{
			$AnnualTurnover = '1Cr - 3Crs';
		}
		else if($Annual_Turnover==3)
		{
			$AnnualTurnover = '3Crs & above';		
		}

		$qry1="insert into temp (session_id, name, dob, mobile_number, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, pincode, doe, current_age, source, count_replies, employer,Feedback,count_views,is_valid,is_processed,card_vintage,add_comment,descr, is_modified, plan_interested,address_apt, docs,product_type,budget  ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Net_Salary"]."', '".$residential_status."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."','".$row_result["Updated_Date"]."', '".$dobofbirth."', '".$row_result["source"]."', '".$row_result["Bidder_Count"]."', '".$strCountBidders."','".$feedbck."','".$Salary_Drawn."','".$row_result["Is_Valid"]."','".$row_result["IsProcessed"]."','".$card_vintage."','".$row_result["Add_Comment"]."','".$descr."','".$statsms."', '".$FeedbackLMS."','".$row_result["Referrer"]."','".$Is_Permit."', '".$AnnualTurnover."','".$row_result["Caller_Name"]."')";
		$result1=ExecQuery($qry1);
	}
		 
	// mobile_number,
	$qry="select name, dob, mobile_number AS Mobile, email AS Email, emp_status, c_name, city, city_other, year_in_comp, total_exp, net_salary, residential_status, loan_any, emi_paid, cc_holder, card_vintage, loan_amount, pincode, doe, current_age, source, count_replies as SentToTotalBidders, employer as CountofBidders,Feedback,count_views AS SalaryDrawn,is_valid AS Valid,is_processed AS DirectAllocate, add_comment AS Comments,descr AS BidderGone, is_modified AS SmsStat, plan_interested as LMSFeedback, product_type as TurnOver, address_apt AS Referrer, docs AS Surrogate, budget AS callerName from temp where session_id='".$session_id."'";
			
	$header="";
	$data="";
	$result = ExecQuery($qry);
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
	}
	
	while($row = mysql_fetch_row($result)){
	  $line = '';
	  foreach($row as $value){
		if(!isset($value) || $value == ""){
		  $value = '"' . $value . '"' . "\t";
		}else{
	# important to escape any quotes to preserve them in the data.
		  $value = str_replace('"', '""', $value);
	# needed to encapsulate data in quotes because some data might be multi line.
	# the good news is that numbers remain numbers in Excel even though quoted.
		  $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	  }
	  $data .= trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	  $data = str_replace("\r", "", $data);
	
	
	# Nice to let someone know that the search came up empty.
	# Otherwise only the column name headers will be output to Excel.
	if ($data == "") {
	  $data = "\nno matching records found\n";
	}
	
	# This line will stream the file to the user rather than spray it across the screen
	header("Content-type: application/octet-stream");
	
	# replace excelfile.xls with whatever you want the filename to default to
	header("Content-Disposition: attachment; filename=data.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $header."\n".$data; 
	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	$result1 = ExecQuery($qry1);
	//*/

?>
