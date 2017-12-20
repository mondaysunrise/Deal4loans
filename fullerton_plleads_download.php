<?
session_start();	
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$session_id=session_id();
	$qry1=$_POST["qry1"];
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
		
	$qry1=str_replace("\'", "'", $qry1);

    $exclusiveLead = '';
list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
	$cntr=0;

	
	while($cntr<count($row_result))
	{
				$exclusiveLead = '';
				$residential_status='';
				if($row_result[$cntr]["Bidder_Count"]==1)
				{				
				$exclusiveLead = "Exclusive Lead";
				}
		if($row_result[$cntr]["Annual_Turnover"]==1) { $annual_turnover="0-40 Lacs"; } 
		else if($row_result[$cntr]["Annual_Turnover"]==2) { $annual_turnover="1Cr - 3Crs"; } 
		else if($row_result[$cntr]["Annual_Turnover"]==3) { $annual_turnover="3Crs & above"; } 
		else if($row_result[$cntr]["Annual_Turnover"]==4) { $annual_turnover="40Lacs To 1 Cr"; } 
		else { $annual_turnover="";  }
if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$cntr]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$cntr]["CC_Holder"]==0) { $cc_holder="No"; }
				
					if($row_result[$cntr]["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
					elseif($row_result[$cntr]["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
					elseif($row_result[$cntr]["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
					elseif($row_result[$cntr]["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
					else
					{ $emi_paid="";
					}
					if($row_result[$cntr]["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
					elseif($row_result[$cntr]["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
				elseif($row_result[$cntr]["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
				elseif($row_result[$cntr]["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
				else
					{
						$card_vintage="";
					}

		if($row_result[$cntr]["Salary_Drawn"]==0) { $Salary_Drawn="Not available"; }
				if($row_result[$cntr]["Salary_Drawn"]==1) { $Salary_Drawn="Cash"; }
				if($row_result[$cntr]["Salary_Drawn"]==2) { $Salary_Drawn="Cheque"; }
				if($row_result[$cntr]["Salary_Drawn"]==3) { $Salary_Drawn="Account Transfer"; }

		if($row_result[$cntr]["Company_Type"]==0)	{	$Company_Type="";}
		if($row_result[$cntr]["Company_Type"]==1)	{	$Company_Type="Pvt Ltd";}
		if($row_result[$cntr]["Company_Type"]==2)	{	$Company_Type="MNC Pvt Ltd";}
		if($row_result[$cntr]["Company_Type"]==3)	{	$Company_Type="Limited";}
		if($row_result[$cntr]["Company_Type"]==4)	{	$Company_Type="Govt.( Central/State )";}
		if($row_result[$cntr]["Company_Type"]==5)	{	$Company_Type="PSU (Public sector Undertaking)";}

	
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$cntr]['Name'], 'dob'=>$row_result[$cntr]['DOB'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$cntr]['Company_Name'], 'city'=>$row_result[$cntr]['City'], 'city_other'=>$row_result[$cntr]['City_Other'], 'year_in_comp'=>$row_result[$cntr]['Years_In_Company'], 'total_exp'=>$row_result[$cntr]['Total_Experience'], 'net_salary'=>$row_result[$cntr]['Net_Salary'], 'residential_status'=>$residential_status, 'loan_any'=>$row_result[$cntr]['Loan_Any'], 'emi_paid'=>$emi_paid, 'cc_holder'=>$cc_holder, 'loan_amount'=>$row_result[$cntr]['Loan_Amount'], 'is_processed'=>$row_result[$cntr]['PL_EMI_Amt'], 'pincode'=>$row_result[$cntr]['Pincode'], 'doe'=>$row_result[$cntr]['Allocation_Date'], 'card_vintage'=>$card_vintage, 'card_limit'=>$row_result[$cntr]['Card_Limit'], 'ip_address'=>$row_result[$cntr]['IP_Address'], 'account_no'=>$row_result[$cntr]['Add_Comment'], 'Documents'=>$row_result[$cntr]['identification_proof'], 'bank_name'=>$row_result[$cntr]['Primary_Acc'], 'address_apt'=>$row_result[$cntr]['fullerton_feedback'], 'plan_interested'=>$row_result[$cntr]['verifier_feedback'], 'mobile_number'=>$row_result[$cntr]['Mobile_Number']);
	
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);

 $cntr=$cntr+1;
	}			
		
$qry="select  name AS Name, dob AS DOB, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS CityOther, year_in_comp AS CurrentExperience, total_exp AS TotalExperience, net_salary AS AnnualIncome, residential_status AS ResiStatus, loan_any AS LoanAny, emi_paid AS EMIPaid, cc_holder AS CcHolder, loan_amount AS LoanAmt, is_processed AS PLEMI , pincode AS Pincode, doe , card_vintage, card_limit,ip_address,account_no,Documents, bank_name AS PrimaryAcc,address_apt AS Telecallerfeedback, plan_interested AS VerifierFeedback  from temp where session_id='".$session_id."' order by doe DESC";
//echo $qry."<br>";
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$Dated = ExactServerdate();
	$dataBidder = array('BidderID'=>$_SESSION['BidderID'], 'BidderName'=>$_SESSION['UName'], 'BidderProduct'=>$_SESSION['ReplyType'], 'BidderTable'=>$qry2, 'BidderSession'=>$session_id, 'NoofRecords'=>$num_rows, 'Dated'=>$Dated, 'MinDate'=>$mindate, 'MaxDate'=>$maxdate);
	$insert = Maininsertfunc ("BidderDownloadCount", $dataBidder);
	
list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());

	 $field_names = getFieldNames($qry);
	
	
	for ($i = 0; $i <count($field_names); $i++){
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
		Maindeletefunc($qry1,$array = array());
?>
