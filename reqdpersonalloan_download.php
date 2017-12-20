<?php
	
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1="select * from Req_Loan_Personal where ((Dated between '2014-06-01 00:00:00' and '2014-06-30 23:59:59') and source='netcorepl' and Allocated=1)";
	
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
		$cntr=0;
	while($cntr<count($row_result))
        {
		if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$cntr]["Marital_Status"]==1) {  $marital_status="Single"; } else { $marital_status="Married"; }
		if($row_result[$cntr]["Residential_Status"]==0) { $residential_status="not available"; } 
		if($row_result[$cntr]["Residential_Status"]==1) { $residential_status="Owned By Parent/Sibling"; }  if($row_result[$cntr]["Residential_Status"]==2) { $residential_status="Rented Staying alone"; } if($row_result[$cntr]["Residential_Status"]==3) { $residential_status="Company Provided"; }
			if($row_result[$cntr]["Residential_Status"]==4) { $residential_status="Owned By Self/Spouse"; }  
			if($row_result[$cntr]["Residential_Status"]==5) { $residential_status="Rented - With Family"; }  
			if($row_result[$cntr]["Residential_Status"]==6) { $residential_status="Rented - With Friends"; }  
			if($row_result[$cntr]["Residential_Status"]==7) { $residential_status="Paying Guest"; }  
			if($row_result[$cntr]["Residential_Status"]==8) { $residential_status="Hostel"; }  


		if($row_result[$cntr]["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
		if($row_result[$cntr]["Loan_Any"]==0) { $loan_any="N/A"; } if($row_result[$cntr]["Loan_Any"]==1) { $loan_any="Car Loan"; } 	if($row_result[$cntr]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$cntr]["CC_Holder"]==0) { $cc_holder="No"; }
		
		if($row_result[$cntr]["EMI_Paid"]=="0") { $emi_paid="Please select"; }
		if($row_result[$cntr]["EMI_Paid"]=="1") { $emi_paid="Less than 6 months"; }
		if($row_result[$cntr]["EMI_Paid"]=="2") { $emi_paid="6 to 9 months"; }
		if($row_result[$cntr]["EMI_Paid"]=="3") { $emi_paid="9 to 12 months"; }
		if($row_result[$cntr]["EMI_Paid"]=="4") { $emi_paid="more than 12 months"; }
		if($row_result[$cntr]["EMI_Paid"]=="") { $emi_paid=""; }

		if($row_result[$cntr]["Card_Vintage"]=="0") { $card_vintage=""; }
		if($row_result[$cntr]["Card_Vintage"]=="1") { $card_vintage="Less than 6 months"; }
		if($row_result[$cntr]["Card_Vintage"]=="2") { $card_vintage="6 to 9 months"; }
		if($row_result[$cntr]["Card_Vintage"]=="3") { $card_vintage="9 to 12 months"; }
		if($row_result[$cntr]["Card_Vintage"]=="4") { $card_vintage="more than 12 months"; }
		


		if($row_result[$cntr]["Salary_Drawn"]==0) { $Salary_Drawn="Not available"; }
		if($row_result[$cntr]["Salary_Drawn"]==1) { $Salary_Drawn="Cash"; }
		if($row_result[$cntr]["Salary_Drawn"]==2) { $Salary_Drawn="Cheque"; }
		if($row_result[$cntr]["Salary_Drawn"]==3) { $Salary_Drawn="Account Transfer"; }
		
		 if($row_result[$cntr]["IsProcessed"]==1 && $row_result[$cntr]["Direct_Allocation"]==1 && $row_result[$cntr]["Bidder_Count"]>0) 
			{
			$feedbck="Sent Direct";
			 } 
			 else if($row_result[$cntr]["IsProcessed"]==1 && $row_result[$cntr]["Direct_Allocation"]==0 && $row_result[$cntr]["Bidder_Count"]>0)
			{
					$feedbck="Sent Via LMS";
			}
			else if($row_result[$cntr]["IsProcessed"]==1 && $row_result[$cntr]["Direct_Allocation"]==0 && $row_result[$cntr]["Bidder_Count"]==0)
			{
				$feedbck=$row_result[$cntr]["Feedback"];
			}
			else if($row_result[$cntr]["IsProcessed"]==1 && $row_result[$cntr]["Direct_Allocation"]==1 && $row_result[$cntr]["Bidder_Count"]==0) 
			{
				$feedbck="Direct NE";
			}
			else
		{
			$feedbck=$row_result[$cntr]["Feedback"];
		}
	$BidderID="";
	
	$BiddersChurn="SELECT Bidder_Name,Req_Feedback_Bidder_PL.BidderID As bid FROM Req_Feedback_Bidder_PL LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder_PL.BidderID and Bidders_List.Reply_Type =1 WHERE (AllRequestID = '".$row_result[$cntr]["RequestID"]."' AND Req_Feedback_Bidder_PL.Reply_Type =1 and Req_Feedback_Bidder_PL.BidderID in (3894,2490,2496,2497,2498,2499,2500,2813,2887,4018,4019,4020,4342,4309,4302,4528,2422,2423,2424,2425,2426,2427,2428,2429,2430,2431,2432,2433,2434,2435,2436,2437,2438,2439,2440,2441,2442,2443,2444,2445,2446,2447,2448,2449,2450,2451,3335,3629,3645,3842,3953,3966,3967,4631,4656,1226,1029,4667,4641,1548,1379,1562,3325,1381,2295,1558,1107,2168,1375,1516,2337,1546,1106,1387,3323,1221,4658,4642,1102,1876,2336,1642,1384,4466,1223,1480,2304,2299,1426,3315,1096,1554,2305,3319,1523,1343,1473,2338,2297,1857,1598,1425,2291,1354,1430,1364,1347,2286,2341,1386,1287,1599,2301,1359,1292,1860,1165,4467,1436,2280,1877,1873,1872,1204,4643,1439,1293,1125,1100,1557,1103,2339,1470,2343,1166,1378,2342,1369,1457,1162,2290,1463,1374,1675,1355,1427,3317,2281,1686,1339,1527,1547,4666,1025,4665,1438,1524,2286,1356,1372,4468,1551,1167,4644,1163,1520,1342,1525,2289,1433,1875,1168,3324,1871,1345,4645,1284,1550,1560,1295,2335,1435,1361,1373,1360,1522,1383,4469,1460,1104,1098,1464,1517,1352,1357,2300,1434,1294,1366,1222,1423,1376,3316,2296,1429,1555,1431,4470,1164,4471,3322,1105,1858,3320,1859,1350,1553,1428,3318,1095,2303,1471,2302,2284,1454,2283,1549,4472,1367,1215,2340,1521,1519,1340,1344,1362,1351,1338,1346,1377,1424,1597,1349,1432,1365,1515,1368,1371,1561))";
	//echo $BiddersChurn;
	$BiddersChurnSql = ExecQuery($BiddersChurn);
	$NumRowBiddersChurnSql = mysql_num_rows($BiddersChurnSql);
	while($newrow=mysql_fetch_array($BiddersChurnSql))
				{
			$BidderID[]=$newrow["Bidder_Name"]."(".$newrow["bid"].")";
			//print_r($BidderID);
				}
			
	$descr = implode(",", $BidderID);
		
	$sqlFeeds = "SELECT Feedback FROM `Req_Feedback_PL` where AllRequestID='".$row_result[$cntr]["RequestID"]."' and BidderID in (846,847,854,9,10) and Reply_Type=1";
	 list($recordcount,$Arrrow)=MainselectfuncNew($sqlFeeds,$array = array());
		$j=0;
	$FeedbackLMS = $Arrrow[$j]['Feedback'];
	
		if($row_result[$cntr]["Is_Permit"]==1)
		{
			$Is_Permit="Yes";
		}
		else
		{
			$Is_Permit="No";
		}
		$AnnualTurnover = '';
		$Annual_Turnover = $row_result[$cntr]["Annual_Turnover"];
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
	$dataInsert = array("session_id"=>$session_id, "name"=>$row_result[$cntr]["Name"], "dob"=>$row_result[$cntr]["DOB"], "emp_status"=>$emp_status, "c_name"=>$row_result[$cntr]["Company_Name"], "city"=>$row_result[$cntr]["City"], "city_other"=>$row_result[$cntr]["City_Other"], "year_in_comp"=>$row_result[$cntr]["Years_In_Company"], "total_exp"=>$row_result[$cntr]["Total_Experience"], "net_salary"=>$row_result[$cntr]["Net_Salary"], "residential_status"=>$residential_status, "loan_any"=>$row_result[$cntr]["Loan_Any"], "emi_paid"=>$emi_paid, "cc_holder"=>$cc_holder, "loan_amount"=>$row_result[$cntr]["Loan_Amount"], "pincode"=>$row_result[$cntr]["Pincode"], "doe"=>$row_result[$cntr]["Updated_Date"], "current_age"=>$dobofbirth, "source"=>$row_result[$cntr]["source"], "count_replies"=>$row_result[$cntr]["Bidder_Count"], "employer"=>$strCountBidders, "Feedback"=>$feedbck, "count_views"=>$Salary_Drawn, "is_valid"=>$row_result[$cntr]["Is_Valid"], "is_processed"=>$row_result[$cntr]["IsProcessed"], "card_vintage"=>$card_vintage, "add_comment"=>$row_result[$cntr]["Add_Comment"], "descr"=>$descr, "is_modified"=>$statsms, "plan_interested"=>$FeedbackLMS, "address_apt"=>$row_result[$cntr]["Referrer"], "docs"=>$Is_Permit, "product_type"=>$AnnualTurnover, "budget"=>$row_result[$cntr]["Caller_Name"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"]);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
	
$cntr=$cntr+1;	}
		 
	// mobile_number,
	$qry="select name, dob, mobile_number AS Mobile, emp_status, c_name, city, city_other, year_in_comp, total_exp, net_salary, residential_status, loan_any, emi_paid, cc_holder, card_vintage, loan_amount, pincode, doe, current_age, source, count_replies as SentToTotalBidders, employer as CountofBidders,Feedback,count_views AS SalaryDrawn,is_valid AS Valid,is_processed AS DirectAllocate, add_comment AS Comments,descr AS BidderGone, is_modified AS SmsStat, plan_interested as LMSFeedback, product_type as TurnOver, address_apt AS Referrer, docs AS Surrogate, budget AS callerName from temp where session_id='".$session_id."'";
			
	$header="";
	$data="";
	list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());
	 $field_names = getFieldNames($qry);
	
	for ($i = 0; $i < $count; $i++){
		$header .= $field_names[$i]."\t";
	}
	
	for($dnld=0;$dnld<count($myrow);$dnld++)
	{
	  $myrowarr=$myrow[$dnld];
	  $line = '';
	  foreach($myrowarr as $value){
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
	$deleterowcount=Maindeletefunc($qry1,$array = array());
	//*/
?>
