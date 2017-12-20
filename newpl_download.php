<?
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

	
	//$search_result=ExecQuery($qry1);
	
	while($cntr<count($row_result))
        {
		if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$cntr]["Marital_Status"]==1) {  $marital_status="Single"; } else { $marital_status="Married"; }
		if($row_result[$cntr]["Residential_Status"]==0) { $residential_status="not available"; } 
		if($row_result[$cntr]["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result[$cntr]["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result[$cntr]["Residential_Status"]==3) { $residential_status="Company Provided"; }
		if($row_result[$cntr]["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
		if($row_result[$cntr]["Loan_Any"]==0) { $loan_any="N/A"; } if($row_result[$cntr]["Loan_Any"]==1) { $loan_any="Car Loan"; } 	if($row_result[$cntr]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$cntr]["CC_Holder"]==0) { $cc_holder="No"; }
	
	$BiddersChurn = "select  BidderID from Req_Feedback_Bidder1 where  AllRequestID=".$row_result[$cntr]['RequestID']." and BidderID in (324,594,633,607,609,720,721,722,723,724,725,726,727,728,729,730)and Reply_Type=1";
//echo $BiddersChurn."<br>";
	 list($recordcount,$row)=MainselectfuncNew($BiddersChurn,$array = array());
		$i=0;
	
	//$BiddersChurnSql = ExecQuery($BiddersChurn);
	$strBidders_1="";
	
	
	
while($i<count($row))
        {
		$requestid=$row[$i]['AllRequestID'];
		$strBidders_1 = $strBidders_1.$row[$i]['BidderID'].",";
	 	$i = $i +1;
	 }
	$strBidders_1 = substr(trim($strBidders_1), 0, strlen(trim($strBidders_1))-1);
	
	$biddername="select  Bidder_Name from Bidders_List where BidderID in (".$strBidders_1.")";
	//$biddernameresult=ExecQuery($biddername);
 list($recordcount,$row1)=MainselectfuncNew($biddername,$array = array());
		$j=0;

$strBidders="";
if(strlen($strBidders_1)>0 || $strBidders_1!='')
		{
while($j<count($row1))
        {
		//$requestid=$row['AllRequestID'];
		$strBidders = $strBidders.$row1['Bidder_Name'].",";
	$j = $j+1;
	}
		}
		else
			{
$strBidders=0;
			}
		
	//$strCountBidders = count($strShowBidders);
	// echo $strBidders."<br>";
		
		


		//if($row_result[$cntr]["Email"]=="")
		//{		$dob=$row_result[$cntr]["dob"];} else { $dob=$row_result[$cntr]["DOB"];}
		//$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, std_code, landline, mobile_number, std_code_o, landline_o, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, pincode, count_views, is_modified, is_processed, doe, current_age, source, is_valid, count_replies, loan_time) values ('".$session_id."', '".$row_result[$cntr]["Name"]."', '".$row_result[$cntr]["dob"]."', '".$row_result[$cntr]["Email"]."', '".$emp_status."', '".$row_result[$cntr]["Company_Name"]."', '".$row_result[$cntr]["City"]."', '".$row_result[$cntr]["City_Other"]."', '".$row_result[$cntr]["Years_In_Company"]."', '".$row_result[$cntr]["Total_Experience"]."', '".$row_result[$cntr]["Code"]."', '".$row_result[$cntr]["Land"]."', '".$row_result[$cntr]["Mobile_Number"]."', '".$row_result[$cntr]["Std_Code_O"]."', '".$row_result[$cntr]["Landline_O"]."',  '".$row_result[$cntr]["Net_Salary"]."', '".$marital_status."', '".$residential_status."', '".$vehicle_owned."', '".$row_result[$cntr]["Loan_Any"]."', '".$row_result[$cntr]["EMI_Paid"]."', '".$cc_holder."', '".$row_result[$cntr]["Loan_Amount"]."', '".$row_result[$cntr]["Pincode"]."', '".$row_result[$cntr]["Count_Views"]."', '".$row_result[$cntr]["IsModified"]."', '".$row_result[$cntr]["IsProcessed"]."', '".$row_result[$cntr]["Dated"]."', '".$dobofbirth."', '".$row_result[$cntr]["source"]."', '".$row_result[$cntr]["Is_Valid"]."', '".$row_result[$cntr]["Bidder_Count"]."', '".$strBidders."')";
			
			//$result1=ExecQuery($qry1);
			
			
			$dataInsert = array("session_id"=>$session_id, "name"=>$row_result[$cntr]["Name"], "dob"=>$row_result[$cntr]["dob"], "email"=>$row_result[$cntr]["Email"], "emp_status"=>$emp_status, "c_name"=>$row_result[$cntr]["Company_Name"], "city"=>$row_result[$cntr]["City"], "city_other"=>$row_result[$cntr]["City_Other"], "year_in_comp"=>$row_result[$cntr]["Years_In_Company"], "total_exp"=>$row_result[$cntr]["Total_Experience"], "std_code"=>$row_result[$cntr]["Code"], "landline"=>$row_result[$cntr]["Land"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"], "std_code_o"=>$row_result[$cntr]["Std_Code_O"], "landline_o"=>$row_result[$cntr]["Landline_O"], "net_salary"=>$row_result[$cntr]["Net_Salary"], "marital_status"=>$marital_status, "residential_status"=>$residential_status, "vehicle_owned"=>$vehicle_owned, "loan_any"=>$row_result[$cntr]["Loan_Any"], "emi_paid"=>$row_result[$cntr]["EMI_Paid"], "cc_holder"=>$cc_holder, "loan_amount"=>$row_result[$cntr]["Loan_Amount"], "pincode"=>$row_result[$cntr]["Pincode"], "count_views"=>$row_result[$cntr]["Count_Views"], "is_modified"=>$row_result[$cntr]["IsModified"], "is_processed"=>$row_result[$cntr]["IsProcessed"], "doe"=>$row_result[$cntr]["Dated"], "current_age"=>$dobofbirth, "source"=>$row_result[$cntr]["source"], "is_valid"=>$row_result[$cntr]["Is_Valid"], "count_replies"=>$row_result[$cntr]["Bidder_Count"], "loan_time"=>$strBidders);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
			
			
			
		//$qry2="insert into mailpancard ( name,  email, request_id, pancard ) values ('".$row_result[$cntr]["Name"]."', '".$row_result[$cntr]["Email"]."', '".$row_result[$cntr]["Req_Id"]."', '".$row_result[$cntr]["Pancard"]."')";
		
			//$result2=ExecQuery($qry2);
	
		
		
	 $cntr=$cntr+1;
	 }
	//echo "3::";
	$qry="select name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, std_code, landline, mobile_number, std_code_o, landline_o, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, pincode, doe, current_age, source, is_valid, count_replies as SentToTotalBidders, loan_time as senttobidders from temp where session_id='".$session_id."'";
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$result = ExecQuery($qry);
	$num_rows = mysql_num_rows($result);
	$CountInsertSql = "insert into BidderDownloadCount (BidderID, BidderName, BidderProduct, BidderTable, BidderSession, NoofRecords, Dated, MinDate, MaxDate) values ('".$_SESSION['BidderID']."', '".$_SESSION['UName']."', 'creditcard', '".$qry2."', '".$session_id."',  '".$num_rows."', Now(), '".$mindate."', '".$maxdate."') ";
	
	$CountInsertQuery  = ExecQuery($CountInsertSql);
	
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
