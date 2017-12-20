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
	
	list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{
		$Employment_Status = $row_result[$i]["Employment_Status"];
		if($Employment_Status==1)
		{
			$EmpStatus = "Salaried";
		}
		else
		{
			$EmpStatus = "Self Employed";		
		}
		$Residence_Status = $row_result[$i]["Residence_Status"];
		if($Residence_Status==1) { $ResiAddress = "Owned By Parent/Sibling"; }
		else if($Residence_Status==2) { $ResiAddress = "Rented - Staying Alone"; }
		else if($Residence_Status==3) { $ResiAddress = "Company Provided"; }
		else if($Residence_Status==4) { $ResiAddress = "Owned By Self/Spouse"; }
		else if($Residence_Status==5) { $ResiAddress = "Rented - With Family"; }
		else if($Residence_Status==6) { $ResiAddress = "Rented - With Friends"; }
		else if($Residence_Status==7) { $ResiAddress = "Paying Guest"; }
		else if($Residence_Status==8) { $ResiAddress = "Hostel"; }		
		$income_proof_doc =  $row_result[$i]["income_proof_doc"];
		if(strlen($income_proof_doc)>0)
		{			$income_proof_doc =  "http://www.deal4loans.com/upload_hdfcCL/".$row_result[$i]["income_proof_doc"];		}
		$address_proof_doc =  $row_result[$i]["address_proof_doc"];
		if(strlen($income_proof_doc)>0)
		{			$address_proof_doc =  "http://www.deal4loans.com/upload_hdfcCL/".$row_result[$i]["address_proof_doc"];		}

		$identify_proof_doc =  $row_result[$i]["identify_proof_doc"];
		if(strlen($income_proof_doc)>0)
		{			$identify_proof_doc =  "http://www.deal4loans.com/upload_hdfcCL/".$row_result[$i]["identify_proof_doc"];		}

		$bank_statement_doc =  $row_result[$i]["bank_statement_doc"];
		if(strlen($income_proof_doc)>0)
		{			$bank_statement_doc =  "http://www.deal4loans.com/upload_hdfcCL/".$row_result[$i]["bank_statement_doc"];		}

		$reward_selected = $row_result[$i]["reward_selected"];
		$getGiftsSql = "SELECT * FROM hdfc_car_loan_gifts WHERE id= '".$reward_selected."'";		
		list($count,$getGiftsQuery)=MainselectfuncNew($getGiftsSql,$array = array());
		$reward = $getGiftsQuery[0]['Name'];
		
	
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'emp_status'=>$row_result[$i]['Pancard'], 'c_name'=>$row_result[$i]['Residence_Address'], 'city'=>$row_result[$i]['Residence_Pincode'], 'city_other'=>$row_result[$i]['Resi_Std'], 'year_in_comp'=>$row_result[$i]['Resi_Telephone'], 'total_exp'=>$EmpStatus, 'net_salary'=>$row_result[$i]['Net_Salary'], 'residential_status'=>$row_result[$i]['Company_Name'], 'loan_any'=>$row_result[$i]['Primary_Acc'], 'emi_paid'=>$ResiAddress, 'cc_holder'=>$row_result[$i]['Total_Experience'], 'loan_amount'=>$row_result[$i]['salary_account'], 'Feedback'=>$row_result[$i]['Resi_Stability'], 'count_views'=>$row_result[$i]['CC_Holder'], 'count_replies'=>$row_result[$i]['Off_Landline'], 'is_modified'=>$row_result[$i]['office_std'], 'is_processed'=>$row_result[$i]['Off_Address'], 'pincode'=>$row_result[$i]['off_pincode'], 'docs'=>$row_result[$i]['Dated'], 'card_vintage'=>$row_result[$i]['Loan_Amount'], 'card_limit'=>$row_result[$i]['Car_Model'], 'ip_address'=>$row_result[$i]['Car_Price'], 'add_comment'=>$row_result[$i]['intr_rate'], 'Documents'=>$row_result[$i]['Tenure'], 'employer'=>$row_result[$i]['AppID'], 'plan_interested'=>$income_proof_doc, 'descr'=>$address_proof_doc, 'login_date'=>$identify_proof_doc, 'apt_dt'=>$bank_statement_doc, 'product_type'=>$reward, 'doe'=>$row_result[$i]['Dated'], 'property_loc'=>$row_result[$i]['City']);
	$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
	}



$qry="select name as Name, mobile_number as MobileNumber, dob as DOB, email as Email, property_loc as City, emp_status as Pancard, c_name as ResiAddress, city as ResiPincode, city_other as ResiStd, year_in_comp as ResiTelephone, total_exp as EmpStatus, net_salary as NetSalary, card_vintage as LoanAmount, residential_status as Company, loan_any as PrimaryAcc, emi_paid as ResiAddress, cc_holder as TotalExperience, loan_amount as SalAccount, Feedback as ResiStability, count_views as CCHolder, count_replies as OffLandline, is_modified as OfficeSTD, is_processed as OfficeAddress, pincode as Pincode, docs as Dated, card_limit as CarModel, ip_address as CarPrice, add_comment as IntRate, Documents as Tenure,  employer as AppID, plan_interested as IncomeProof, descr as IdentityProof, login_date AddressProof, apt_dt as BankStat,product_type as Reward  from temp where session_id='".$session_id."' order by doe DESC"; 

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