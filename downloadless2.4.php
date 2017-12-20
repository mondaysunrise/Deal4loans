<?
session_start();	

	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
//echo "hello".$_SESSION['BidderID'];
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
	//$value=explode(",", $_POST["qry2"]);
       // $qry2=$value[1];
//echo "gff=".$qry2;
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	
	
	$qry1=str_replace("\'", "'", $qry1);
	
		list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{

		
			if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			if($row_result[$i]["Residential_Status"]==1) { $residential_status="Owned By Parent/Sibling"; }  if($row_result[$i]["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result[$i]["Residential_Status"]==3) { $residential_status="Company Provided"; }
			if($row_result[$i]["Residential_Status"]==4) { $residential_status="Owned By Self/Spouse"; }  
			if($row_result[$i]["Residential_Status"]==5) { $residential_status="Rented - With Family"; }  
			if($row_result[$i]["Residential_Status"]==6) { $residential_status="Rented - With Friends"; }  
			if($row_result[$i]["Residential_Status"]==7) { $residential_status="Paying Guest"; }  
			if($row_result[$i]["Residential_Status"]==8) { $residential_status="Hostel"; }  

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
$feeds = '';
$BiddName = '';
$feedsSql = "SELECT Feedback,BidderID from Req_Feedback_PL where BidderID in (846,847,854,9,10) and Reply_Type=1 and AllRequestID='".$row_result[$i]["RequestID"]."'";
list($numFeeds,$feedsQuery)=MainselectfuncNew($feedsSql,$array = array());

	$feeds = $feedsQuery[0]['Feedback'];
	$BiddsID = $feedsQuery[0]['BidderID'];
	
	$BidsSql = "SELECT Bidder_Name from Bidders where BidderID ='".$BiddsID."'";
			list($count,$BidsQuery)=MainselectfuncNew($BidsSql,$array = array());

	$BiddName = $BidsQuery[0]['Bidder_Name'];



			$dob=$row_result[$i]["DOB"];
		$Dateofallocation = $row_result[$i]["Allocation_Date"];
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$dob, 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'year_in_comp'=>$row_result[$i]['Years_In_Company'], 'total_exp'=>$row_result[$i]['Total_Experience'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'residential_status'=>$residential_status, 'loan_any'=>$row_result[$i]['Loan_Any'], 'emi_paid'=>$emi_paid, 'cc_holder'=>$cc_holder, 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'Feedback'=>$row_result[$i]['Feedback'], 'count_views'=>$hdfceligibility, 'count_replies'=>$citieligibility, 'is_modified'=>$barclayeligibility, 'is_processed'=>$row_result[$i]['PL_EMI_Amt'], 'pincode'=>$row_result[$i]['Pincode'], 'doe'=>$Dateofallocation, 'card_vintage'=>$card_vintage, 'card_limit'=>$row_result[$i]['Card_Limit'], 'ip_address'=>$row_result[$i]['IP_Address'], 'add_comment'=>$row_result[$i]['comment_section'], 'Documents'=>$row_result[$i]['identification_proof'], 'residence_address'=>$row_result[$i]['Residence_Address'], 'bank_name'=>$row_result[$i]['Primary_Acc'], 'property_type'=>$Company_Type, 'address_apt'=>$Salary_Drawn, 'referred_page'=>$row_result[$i]['axis_executive_name'], 'car_model'=>$TMobile, 'car_type'=>$TName, 'year_of_establishment'=>$feeds, 'industry'=>$BiddName);

	$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
	}


//	$qry="select name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc, net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, doe  from temp where session_id='".$session_id."' order by doe DESC ";
$qry="select name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, year_of_establishment as LMSFeedback, industry as LMSUSER, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,add_comment,doe,property_type AS CompanyType  from temp where session_id='".$session_id."' order by doe DESC ";

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
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
	//*/

?>
