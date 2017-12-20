 <?
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	//echo "1::";
	$mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	$qry1=str_replace("\'", "'", $qry1);
	
	$search_result=ExecQuery($qry1);
	
	while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["CC_Holder"]==0) { $cc_holder="No"; } 
		if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }
		
		if($row_result["Card_Vintage"]==1)
		{	$card_vintage="Less than 6 months";}
		if($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
	if($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
	if($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
	$strcrd="";
	if(strlen($row_result["Eligible_Card_Option"])>0)
			{
		$slctcard= ExecQuery("Select cc_bank_name from credit_card_banks_eligibility where cc_bankid in (".$row_result["Eligible_Card_Option"].")");
	 $arrcrd="";
	 while($crdrow=mysql_fetch_array($slctcard))
		{
		  $arrcrd[]= $crdrow['cc_bank_name'];
		}
		$strcrd = implode(",", $arrcrd);
			}
		
		//if($row_result["Email"]=="")
		//{		$dob=$row_result["dob"];} else { $dob=$row_result["DOB"];}
		$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other,  std_code, landline, std_code_o, landline_o , net_salary, descr, vehicle_owned, cc_holder, is_processed, pancard, no_of_banks, pincode, card_vintage, doe, source, count_replies, request_id, address_apt ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$row_result["Descr"]."', '".$vehicle_owned."', '".$cc_holder."', '".$strcrd."', '".$row_result["Pancard"]."',  '".$row_result["applied_card_name"]."', '".$row_result["Pincode"]."', '".$card_vintage."', '".$row_result["Dated"]."', '".$row_result["source"]."', '".$row_result["Bidder_Count"]."', '".$row_result["RequestID"]."', '".$row_result["No_of_Banks"]."')";
			$result1=ExecQuery($qry1);
		
		//$qry2="insert into mailpancard ( name,  email, request_id, pancard ) values ('".$row_result["Name"]."', '".$row_result["Email"]."', '".$row_result["Req_Id"]."', '".$row_result["Pancard"]."')";
		
			//$result2=ExecQuery($qry2);
	
		
		
	}
	//echo "3::";
	$qry="select name, dob, email, emp_status, c_name, city, city_other, net_salary, descr, vehicle_owned, cc_holder,card_vintage , pancard, is_processed As OptionGiven, Feedback,  no_of_banks AS CardOpted, address_apt as ExistingCard, doe, source, pincode , is_valid, count_replies As BidderCount from temp where session_id='".$session_id."'";
	
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
