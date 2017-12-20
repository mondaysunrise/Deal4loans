<?
require '../scripts/session_check_online.php';
	require '../scripts/db_init.php';
	require '../scripts/functions.php';
	
	$session_id=session_id();
	$qry4=$_POST["qry1"];
	$qry2=$_POST["qry2"];
       
    //$mindate=$_POST["min_date"];
	//$maxdate=$_POST["max_date"];	
	
	$qry1=str_replace("\'", "'", $qry4);	
	$qry=$qry1;
    $search_result=ExecQuery($qry1);  
	while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["company_type"]==4)
		{
			$comp_type="Govt.(Central/State)";
		}
		elseif($row_result["company_type"]==5)
		{
			$comp_type="PSU (Public sector Undertaking)";
		}
		elseif($row_result["company_type"]==1)
		{
			$comp_type="Pvt Ltd";
		}
		elseif($row_result["company_type"]==2)
		{
				$comp_type="MNC Pvt Ltd";
		}
		elseif($row_result["company_type"]==3)
		{
				$comp_type="Limited";
		}
		else
		{
			$comp_type="";
		}

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

	$annualincome=$row_result["net_salary"] * 12;

	$getBidderSql = "select * from msging where rid='".$row_result["ingvyasyaplid"]."'";
	$getBidderQuery = ExecQuery($getBidderSql);
	$bid = mysql_result($getBidderQuery,0,'bid');


//capitalfirst_name ,capitalfirst_dob , Email, Mobile_Number AS MobileNo, City, capitalfirst_panno ,Total_Experience AS totalExp ,Years_In_Company As CurrentExp, capitalfirst_marital_stat ,capitalfirst_purpose_ofloan ,capitalfirst_current_address ,capitalfirst_property_stat ,capitalfirst_annual_income ,capitalfirst_company_name ,capitalfirst_office_address, capitalfirst_dated AS Doe

$CapCurrAddressold = str_replace('"', '', str_replace("/", " ", str_replace("#", " ", str_replace("'", " ",$row_result["capitalfirst_current_address"]))));
$CapOfficeAddressold = str_replace('"', '', str_replace("/", " ", str_replace("#", " ", str_replace("'", " ",$row_result["capitalfirst_office_address"]))));
//$CapOfficeAddress = str_replace("#", "", str_replace("'", "", $row_result["capitalfirst_office_address"]));
//$string = preg_replace( '/[^[:print:]]/', '',$string);
$CapCurrAddress=preg_replace( '/[^[:print:]]/', '',$CapCurrAddressold);
$CapOfficeAddress=preg_replace( '/[^[:print:]]/', '',$CapOfficeAddressold);

$qry1='insert into temp (session_id, name, dob, email,  mobile_number, city, pancard, total_exp, year_in_comp, marital_status, loan_time, residence_address, property_type, net_salary, c_name, property_identified, doe, loan_any, emi_paid, cc_holder, card_vintage, add_comment, car_make, car_model, car_type, emp_status) values ("'.$session_id.'", "'.$row_result["capitalfirst_name"].'", "'.$row_result["capitalfirst_dob"].'", "'.$row_result["Email"].'", "'.$row_result["Mobile_Number"].'", "'.$row_result["City"].'", "'.$row_result["capitalfirst_panno"].'", "'.$row_result["Total_Experience"].'", "'.$row_result["Years_In_Company"].'", "'.$row_result["capitalfirst_marital_stat"].'", "'.$row_result["capitalfirst_purpose_ofloan"].'", "'.$CapCurrAddress.'",  "'.$row_result["capitalfirst_property_stat"].'", "'.$row_result["capitalfirst_annual_income"].'", "'.$row_result["capitalfirst_company_name"].'", "'.$CapOfficeAddress.'", "'.$row_result["capitalfirst_dated"].'", "'.$row_result["Loan_Any"].'", "'.$emi_paid.'", "'.$cc_holder.'", "'.$card_vintage.'" , "'.$row_result["Add_Comment"].'","'.$row_result["Existing_Bank"].'", "'.$row_result["Existing_Loan"].'", "'.$row_result["Existing_ROI"].'", "'.$emp_status.'")';
			$result1=ExecQuery($qry1);
			//echo "fsfsd ".$qry1."<br>";
	}

	$qry="select  name as capitalfirst_name, emp_status AS Occupation, dob as capitalfirst_dob, email as Email, mobile_number AS MobileNo, city as City, pancard as capitalfirst_panno, total_exp as totalExp, year_in_comp as CurrentExp, marital_status  AS capitalfirst_marital_stat, loan_time AS capitalfirst_purpose_ofloan, residence_address AS capitalfirst_current_address, property_type AS capitalfirst_property_stat, net_salary AS NetSalary, c_name AS capitalfirst_company_name, loan_any AS LoanAny, emi_paid AS EmiPaid, cc_holder AS CardHolder, card_vintage AS CardVintage, add_comment AS comments, car_make AS ExistingBank, car_model AS ExistingLoan, car_type AS existingRoi, property_identified AS capitalfirst_office_address, doe AS Doe  from temp where session_id='".$session_id."'";
	
	//"select name AS Name, email AS Email, mobile_number AS MobileNo, dob AS DOB, city AS City, city_other AS OtherCity, emp_status AS Occupation, net_salary AS AnnualIncome, annual_income AS AnnualTurnover, total_exp AS totalExp, loan_amount As LoanAmount, c_name As ComapnyName, ip_address As IPaddress, Feedback, doe AS DateOfEntry from temp where session_id='".$session_id."'
	

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$result = ExecQuery($qry);
	//echo "fff".$qry."<br>";
	$num_rows = mysql_num_rows($result);
	
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
