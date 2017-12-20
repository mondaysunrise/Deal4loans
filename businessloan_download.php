<?
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	
	$qry1=str_replace("\'", "'", $qry1);
	
	$search_result=ExecQuery($qry1);
	
	while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Loan_Any"]==0) { $loan_any="N/A"; } if($row_result["Loan_Any"]==1) { $loan_any="Car Loan"; } if($row_result["Loan_Any"]==2) { $loan_any="Home Loan"; } if($row_result["Loan_Any"]==3) { $loan_any="Personal Loan"; } if($row_result["Loan_Any"]==4) { $loan_any="Other"; }
	
		if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
	
		if($row_result["Card_Vintage"]==1)
		{	$card_vintage="Less than 6 months";}
		if($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
	if($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
	if($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
	
	if($row_result["EMI_Paid"]==1)
		{	$EMI_Paid="Less than 6 months";}
		if($row_result["EMI_Paid"]==2)	{	$EMI_Paid="6 to 9 months";}
	if($row_result["EMI_Paid"]==3)	{	$EMI_Paid="9 to 12 months";}
	if($row_result["EMI_Paid"]==4)		{	$EMI_Paid="more than 12 months";}
	
	
	if($row_result["Annual_Turnover"]==1)
		{	$Annual_Turnover="Below 25 Lacs"; }
		if($row_result["Annual_Turnover"]==2)	{	$Annual_Turnover="25-50 Lacs";}
	if($row_result["Annual_Turnover"]==3)		{	$Annual_Turnover="50-75 Lacs";}
	if($row_result["Annual_Turnover"]==4)		{	$Annual_Turnover="75-1 Crore";}
	if($row_result["Annual_Turnover"]==5)		{	$Annual_Turnover="1-1.25 crore";}
	if($row_result["Annual_Turnover"]==6)	{	$Annual_Turnover="25-50 Lacs";}

	if($row_result["Residential_Status"]==1)
			{
	$residential_status="owned";
			}
			elseif($row_result["Residential_Status"]==2)
				{
				$residential_status="Rented";
			}
			else
			{
				$residential_status="";
			}
			if($row_result["Office_Status"]==1)
			{
				$office_status="owned";
			}
			elseif($row_result["Office_Status"]==2)
			{
				$office_status="Rented";
			}
			else
			{
				$office_status="";
			}
		$qry1="insert into temp (session_id, name, email, city, city_other, mobile_number, net_salary, industry, constitution, year_of_establishment, loan_amount, pincode, doe, source, cc_holder, card_vintage, no_of_banks, loan_any, emi_paid, annual_income,is_valid,residential_status, marital_status,loan_time ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["Email"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$row_result["Industry"]."', '".$row_result["Constitution"]."', '".$row_result["Year_Of_Establishment"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."', '".$row_result["Dated"]."',  '".$row_result["source"]."', '".$cc_holder."','".$card_vintage."', '".$row_result["CC_Bank"]."', '".$loan_any."', '".$EMI_Paid."', '".$Annual_Turnover."', '".$row_result["Is_Valid"]."','".$residential_status."','".$office_status."','".$row_result["Accidental_Insurance"]."')";
//echo $qry1;
	//exit;
		$result1=ExecQuery($qry1);
	}
	

	$qry="select  name as Name, email as Email, city as City, city_other as CityOther, mobile_number as MobileNumber, net_salary as NetSalary, industry as Industry, constitution as Constitution, year_of_establishment as YearofEstablishment, loan_amount as LoanAmount, pincode as Pincode, doe as DateofEntry,  cc_holder as CCHolder, no_of_banks as NameofBank, loan_any as LoanRunning, emi_paid as EMIPaid, annual_income as AnnualTurnover, source as Source,is_valid as IsValid,residential_status,marital_status As OfficeStatus,loan_time As AccidentalInsurance from temp where session_id='".$session_id."'";
		
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
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
