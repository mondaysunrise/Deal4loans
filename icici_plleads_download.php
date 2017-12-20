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
	$PLresult='';
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{
				$exclusiveLead = '';
				$residential_status='';
				if($row_result[$i]["Bidder_Count"]==1)
				{				
				$exclusiveLead = "Exclusive Lead";
				}
		if($row_result[$i]["Annual_Turnover"]==1) { $annual_turnover="0-40 Lacs"; } 
		else if($row_result[$i]["Annual_Turnover"]==2) { $annual_turnover="1Cr - 3Crs"; } 
		else if($row_result[$i]["Annual_Turnover"]==3) { $annual_turnover="3Crs & above"; } 
		else if($row_result[$i]["Annual_Turnover"]==4) { $annual_turnover="40Lacs To 1 Cr"; } 
		else { $annual_turnover="";  }

		if($row_result[$i]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$i]["CC_Holder"]==0) { $cc_holder="No"; }
				
					if($row_result[$i]["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
					elseif($row_result[$i]["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
					elseif($row_result[$i]["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
					elseif($row_result[$i]["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
					else
					{ $emi_paid="";
					}
					if($row_result[$i]["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
					elseif($row_result[$i]["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
				elseif($row_result[$i]["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
				elseif($row_result[$i]["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
				else
					{
						$card_vintage="";
					}

		if($row_result[$i]["Salary_Drawn"]==0) { $Salary_Drawn="Not available"; }
				if($row_result[$i]["Salary_Drawn"]==1) { $Salary_Drawn="Cash"; }
				if($row_result[$i]["Salary_Drawn"]==2) { $Salary_Drawn="Cheque"; }
				if($row_result[$i]["Salary_Drawn"]==3) { $Salary_Drawn="Account Transfer"; }

		if($row_result[$i]["Company_Type"]==0)	{	$Company_Type="";}
		if($row_result[$i]["Company_Type"]==1)	{	$Company_Type="Pvt Ltd";}
		if($row_result[$i]["Company_Type"]==2)	{	$Company_Type="MNC Pvt Ltd";}
		if($row_result[$i]["Company_Type"]==3)	{	$Company_Type="Limited";}
		if($row_result[$i]["Company_Type"]==4)	{	$Company_Type="Govt.( Central/State )";}
		if($row_result[$i]["Company_Type"]==5)	{	$Company_Type="PSU (Public sector Undertaking)";}

	$tudetails="Select PLResult from icici_pl_cibili_check Where (icicirequestID=".$row_result[$i]["icicirequestID"].") order by plcibilid ASC"; 
	 list($turowcount,$turow)=Mainselectfunc($tudetails,$array = array());
	$PLresult=$turow["PLResult"];	

		
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'email'=>$row_result[$i]['Email'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'dob'=>$row_result[$i]['DOB'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'year_in_comp'=>$row_result[$i]['Years_In_Company'], 'total_exp'=>$row_result[$i]['Total_Experience'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'residential_status'=>$residential_status, 'loan_any'=>$row_result[$i]['Loan_Any'], 'emi_paid'=>$emi_paid, 'cc_holder'=>$row_result[$i]['cc_holder'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'is_processed'=>$row_result[$i]['PL_EMI_Amt'], 'pincode'=>$row_result[$i]['Pincode'], 'doe'=>$row_result[$i]['Allocation_Date'], 'card_vintage'=>$card_vintage, 'card_limit'=>$row_result[$i]['Card_Limit'], 'ip_address'=>$row_result[$i]['IP_Address'], 'account_no'=>$row_result[$i]['Add_Comment'], 'Documents'=>$row_result[$i]['identification_proof'], 'bank_name'=>$row_result[$i]['Primary_Acc'], 'property_type'=>$row_result[$i]['TelecallerID'], 'address_apt'=>$row_result[$i]['icici_feedback'], 'plan_interested'=>$PLresult[$i]['verifier_feedback'], 'Feedback'=>$PLresult);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);	
	}			
		

$qry="select  name AS Name, email As Email, mobile_number AS MobileNo, dob AS DOB, emp_status AS Occupation, net_salary AS AnnualIncome, city AS City, city_other AS CityOther, doe , ip_address,Documents, bank_name AS PrimaryAcc,	property_type AS TelecallerID ,address_apt AS Telecallerfeedback, plan_interested AS VerifierFeedback, Feedback AS TUFeedback  from temp where session_id='".$session_id."' order by doe DESC";

//echo $qry."<br>";
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());
	$dataBidder = array('BidderID'=>$_SESSION['BidderID'], 'BidderName'=>$_SESSION['UName'], 'BidderProduct'=>$_SESSION['ReplyType'], 'BidderTable'=>$qry2, 'BidderSession'=>$session_id, 'NoofRecords'=>$num_rows, 'Dated'=>$Dated, 'MinDate'=>$mindate, 'MaxDate'=>$maxdate);
    Maininsertfunc ("BidderDownloadCount", $dataBidder);	
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
