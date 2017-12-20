<?
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	
	/*$qry1="SELECT * FROM icici_agent_leadallocation, Req_Loan_Home WHERE icici_agent_leadallocation.allrequestid = Req_Loan_Home.RequestID AND icici_agent_leadallocation.bidderid =993 AND icici_agent_leadallocation.product =2
AND ( icici_agent_leadallocation.allocation_date BETWEEN '2014-11-29 00:00:00' AND '2014-12-30 23:59:59') group by Mobile_Number";*/
	$qry1=str_replace("\'", "'", $qry1);
	
	$search_result=ExecQuery($qry1);
	
	while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["Property_Type"]==0) { $property_type="Commercial office space"; }
		if($row_result["Property_Type"]==1) { $property_type="Appartment"; }  if($row_result["Property_Type"]==2) { $property_type="Industrial House"; } if($row_result["Property_Type"]==3) { $property_type="Showroom"; }
		if($row_result["Property_Type"]==4) { $property_type="Factory"; }  if($row_result["Property_Type"]==5) { $property_type="Plot"; } if($row_result["Property_Type"]==6) { $property_type="Godown"; }
        if($row_result["Property_Type"]==7) { $property_type="Bungalow"; }
		if($row_result["Property_Identified"]==1) { $property_identified="yes"; } else { $property_identified="no"; }
		
		$getagentallocate=ExecQuery("select agentid From icici_agent_leadallocation Where allrequestid=".$row_result["RequestID"]." group by allrequestid");
		$allcte=mysql_fetch_array($getagentallocate);

		$getagent=ExecQuery("select  agent_dma_id  From icici_hfc_agents Where  agentid=".$allcte["agentid"]."  ");
		$get=mysql_fetch_array($getagent);
	
		list($First,$Last) = split('[ ]',$row_result["Name"]);

		if($_SESSION['BidderID']==3397)
				{
			$code="CHD4U - LAP DEAL 4 U";
				}
				else
				{
		$code="CHD4U - HL DEAL 4 U";
				}

				$bank_name = "ICICI Bank-Home Loan"; //Base Product
$product_type = "Home Loan"; //Base Product
$docs ="online";
$source = "Central Upload";
$account_no = "195816";
$gender ="Male";
$Documents = "Preferred User";
$no_of_banks="Mortgages";

$qry1="insert into temp (session_id,  account_no , add_comment , bidderid , dob , docs , email , gender , landline , no_of_banks , loan_amount , marital_status , mobile_number , name , pincode , product_type , source , std_code , std_code_o , bank_name ,city ,Documents , emp_status, is_valid, landline_o ) values		
		('".$session_id."', '".$account_no."' , 'New Customer' , 'Mr' , '".$Last."' , '".$docs."' , '".$row_result["Email"]."' , 'Male' , '".$row_result["Landline"]."' , '".$no_of_banks."' , '".$row_result["Loan_Amount"]."' , '' , '".$row_result["Mobile_Number"]."' , '".$First."' , '".$row_result["Pincode"]."' , '".$product_type."' , '".$source."' , '' , '' ,'".$bank_name."' ,'".$row_result["City"]."' ,'".$Documents."' , '".$emp_status."', '','' )";
			$result1=ExecQuery($qry1);
			
	}


/*name , dob , email , emp_status , c_name , city , city_other , car_make , car_model , car_type , loan_tenure , descr , property_type , property_value , year_in_comp , total_exp , mobile_number , std_code , landline , std_code_o , landline_o , net_salary , gender , marital_status , residential_status , vehicle_owned , loan_any , emi_paid , cc_holder , loan_amount , no_of_dependents , annual_income , plan_interested , pincode , source , Feedback , contact_time , count_views , count_replies , is_modified , is_processed , already_download , doe , budget , product_type , count , total_bill , pancard , no_of_banks , residence_address , current_age , property_identified , property_loc , card_vintage , referred_page , bidderid , login_date , logout_date , ip_address , is_valid , constitution , year_of_establishment , industry , request_id , query_type , employer , loan_time , Card_Limit , add_comment , Documents , bank_name , account_no , apt_dt , docs , address_apt , changeapp_time*/

	$qry="select emp_status AS SelfEmployedSalaried, bidderid AS Salutation , add_comment AS CustomerType , name AS FirstName , dob AS LastName , mobile_number AS MobilePhone , std_code AS ResidenceSTD , landline AS ResidencePhone , std_code_o AS OfficeSTD ,landline_o AS OfficePhone , no_of_banks AS  BusinessLine ,bank_name AS BaseProduct , product_type AS ProductType , docs AS Channel , loan_amount AS LoanAmount ,is_valid AS TenureInMonths , source AS LeadSource , account_no AS Event ,is_valid AS OpeningBranch ,is_valid AS SourceBranch ,is_valid AS  LANACNoCreditCardNo ,is_valid AS ProcessShopName ,is_valid AS ApplicationFormNo ,is_valid AS ApplicationFormDate ,is_valid AS SchemeName ,is_valid AS DealerPartnerName ,is_valid AS  DOBDOI , gender AS Gender , marital_status AS MaritalStatus ,is_valid AS Qualifications ,is_valid AS NoOfDependents , email AS EmailID ,is_valid AS PAN ,city AS CommunicationAddressLine1 ,is_valid AS CommunicationAddressLine2 ,is_valid AS CommunicationAddressLine3 , is_valid AS CommunicationCountry ,is_valid AS  CommunicationState ,is_valid AS  CommunicationCity , pincode AS  CommunicationPincode ,is_valid AS ResidenceStatus ,is_valid AS YearsatResidence , is_valid AS  MonthofResidence ,is_valid AS ResidenceType ,is_valid AS NatureofBusiness ,is_valid AS Industry ,is_valid AS CompanyName ,is_valid AS CompanyType ,is_valid AS Yearsincurrentbusiness ,is_valid AS Monthsincurrentbusiness ,is_valid AS ProcessingFees ,is_valid AS Promotion ,city AS OfficeAddressLine1 ,is_valid AS OfficeAddressLine2 ,is_valid AS OfficeAddressLine3 ,is_valid AS OfficeCountry ,is_valid AS OfficeState ,is_valid AS OfficeCity ,is_valid AS OfficePincode ,is_valid AS ReferrerName ,is_valid AS ReferralCode ,Documents AS RoutingParameter ,is_valid AS SolID ,is_valid AS AssignTo ,is_valid AS Pincode ,city AS Location ,is_valid AS CompletedApplicationForm , is_valid AS FreshLeadRemarks ,is_valid AS  LoanType ,is_valid AS PropertyIdentified ,is_valid AS SignatureVerification ,is_valid AS BankStatement ,is_valid AS Incomeproof ,is_valid AS KYCCertifiedBy ,is_valid AS  GrossMonthly ,is_valid AS OptedForInsurance ,is_valid AS ExShowroomPrice ,is_valid AS ValuationsDoneForUsedCar ,is_valid AS ValuationAmount ,is_valid AS LeadWarmth , is_valid AS CarManufactureYear ,is_valid AS OnRoadCost ,is_valid AS Remarks  from temp where session_id='".$session_id."'";

	//$qry="select name AS FirstName, dob, email, std_code, landline, std_code_o, landline_o, mobile_number, emp_status, c_name, city, city_other, net_salary, descr, property_type, property_value, loan_amount, pincode, source, residence_address, budget, property_identified, property_loc, doe, bidderid As AgentName from temp where session_id='".$session_id."'";
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$result = ExecQuery($qry);
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."~";
	}
	
	while($row = mysql_fetch_row($result)){
	  $line = '';
	  foreach($row as $value){
		if(!isset($value) || $value == ""){
		  $value = '' . $value . '' . "~";
		}else{
	# important to escape any quotes to preserve them in the data.
		  //$value = str_replace('"', '""', $value);
	# needed to encapsulate data in quotes because some data might be multi line.
	# the good news is that numbers remain numbers in Excel even though quoted.
		  $value = '' . $value . '' . "~";
		}		
		$line .= $value;
	  }
	  $line = substr(trim($line), 0, strlen(trim($line))-1);
	  $data .=trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	  //$data = str_replace("\n", "\n", $data);	
	
	# Nice to let someone know that the search came up empty.
	# Otherwise only the column name headers will be output to Excel.
	if ($data == "") {
	  $data = "\nno matching records found\n";
	}	
	# This line will stream the file to the user rather than spray it across the screen
	header("Content-type: application/octet-stream");
	
	# replace excelfile.xls with whatever you want the filename to default to
	header("Content-Disposition: attachment; filename=data.txt");
	header("Pragma: no-cache");
	header("Expires: 0");
	$header = substr(trim($header), 0, strlen(trim($header))-1);
	echo $header."\n".$data; 	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	$result1 = ExecQuery($qry1);
?>
