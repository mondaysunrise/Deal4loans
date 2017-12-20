<?php
session_start();	
require 'scripts/db_init.php';
require 'scripts/functions.php';

$session_id=session_id();
$qry1=$_POST["qry1"];

$qry2=$_POST["qry2"];
$mindate=$_POST["min_date"];
$maxdate=$_POST["max_date"];

$qry1=str_replace("\'", "'", $qry1);

$search_result=ExecQuery($qry1);
$exclusiveLead = '';
$row_result=mysql_fetch_array($search_result);

while($row_result=mysql_fetch_array($search_result))
{
	if($row_result["Annual_Turnover"]==1) { $annual_turnover="0-40 Lacs"; } 
		else if($row_result["Annual_Turnover"]==2) { $annual_turnover="1Cr - 3Crs"; } 
		else if($row_result["Annual_Turnover"]==3) { $annual_turnover="3Crs & above"; } 
		else if($row_result["Annual_Turnover"]==4) { $annual_turnover="40Lacs To 1 Cr"; } 
		else { $annual_turnover="";  }
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["Residential_Status"]==1) { $residential_status="Owned By Parent/Sibling"; }  
		if($row_result["Residential_Status"]==2) { $residential_status="Rented - Staying Alone"; } 
		if($row_result["Residential_Status"]==3) { $residential_status="Company Provided"; }
		if($row_result["Residential_Status"]==4) { $residential_status="Owned By Self/Spouse"; }  
		if($row_result["Residential_Status"]==5) { $residential_status="Rented - With Family"; }  
		if($row_result["Residential_Status"]==6) { $residential_status="Rented - With Friends"; }  
		if($row_result["Residential_Status"]==7) { $residential_status="Paying Guest"; }  
		if($row_result["Residential_Status"]==8) { $residential_status="Hostel"; }  

		if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  
		if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
	
		if($row_result["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
		elseif($row_result["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
		elseif($row_result["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
		elseif($row_result["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
		else
		{ 
			$emi_paid="";
		}
		if($row_result["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
		elseif($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result["Card_Vintage"]==4)	{	$card_vintage="more than 12 months";}
		else
		{
			$card_vintage="";
		}

		if($row_result["Salary_Drawn"]==0) { $Salary_Drawn="Not available"; }
		if($row_result["Salary_Drawn"]==1) { $Salary_Drawn="Cash"; }
		if($row_result["Salary_Drawn"]==2) { $Salary_Drawn="Cheque"; }
		if($row_result["Salary_Drawn"]==3) { $Salary_Drawn="Account Transfer"; }

		if($row_result["Company_Type"]==0)	{	$Company_Type="";}
		if($row_result["Company_Type"]==1)	{	$Company_Type="Pvt Ltd";}
		if($row_result["Company_Type"]==2)	{	$Company_Type="MNC Pvt Ltd";}
		if($row_result["Company_Type"]==3)	{	$Company_Type="Limited";}
		if($row_result["Company_Type"]==4)	{	$Company_Type="Govt.( Central/State )";}
		if($row_result["Company_Type"]==5)	{	$Company_Type="PSU (Public sector Undertaking)";}

		$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,account_no,Documents,residence_address, bank_name,property_type,address_apt, referred_page,vehicle_owned, plan_interested, current_age, docs,request_id, car_make, car_model, car_type,add_comment ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$residential_status."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$hdfceligibility."', '".$citieligibility."', '".$barclayeligibility."', '".$row_result["PL_EMI_Amt"]."', '".$row_result["Pincode"]."', '".$row_result["Updated_Date"]."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["Add_Comment"]."','".$row_result["identification_proof"]."','".$asmtype."','".$row_result["Primary_Acc"]."','".$Company_Type."','".$Salary_Drawn."','".$row_result["axis_executive_name"]."', '".$zone."','".$annual_turnover."','".$exclusiveLead."', '".$BiddCity."','".$citiuniqueid."', '".$row_result["Existing_Bank"]."', '".$row_result["Existing_Loan"]."', '".$row_result["Existing_ROI"]."', '".$row_result["comment_section"]."')";		
	$result1=ExecQuery($qry1);
}
//echo "<br><br>";
if($qry2=="Req_Loan_Personal")
{
	$qry="select name, dob, email, mobile_number,emp_status, c_name AS CompName, year_in_comp AS CurrentExp, total_exp AS TotalExp, address_apt AS SalryDrawn, city AS City, city_other, pincode, residential_status AS ResiStat, cc_holder, net_salary, loan_any, emi_paid, is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit,  ip_address,bank_name AS PrimaryAcc , Documents AS AvailableDocuments,add_comment,doe,count_views AS HdfcEligibility, count_replies AS citiEligibility, is_modified AS BarclaysEligibility,referred_page AS AgntName, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI from temp where session_id='".$session_id."' order by doe DESC ";
}
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$result = ExecQuery($qry);
	//echo "fff".$qry."<br>";
	$num_rows = mysql_num_rows($result);
	$CountInsertSql = "insert into BidderDownloadCount (BidderID, BidderName, BidderProduct, BidderTable, BidderSession, NoofRecords, Dated, MinDate, MaxDate) values ('".$_SESSION['BidderID']."', '".$_SESSION['UName']."', '".$_SESSION['ReplyType']."', '".$qry2."', '".$session_id."',  '".$num_rows."', Now(), '".$mindate."', '".$maxdate."') ";
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
?>
