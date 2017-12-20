<?php
//include ("includes/check_login.php");
require 'scripts/db_init.php';
require 'scripts/functions.php';

$session_id=session_id();
$qry1=$_POST["qry1"];
$qry1=str_replace("\'", "'", $qry1);
$section = $_POST["section"];

 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());


	for($i=0;$i<$recordcount;$i++)
	{
		if($section=="GreenChannel")
		{
			if($row_result[$i]["bajajf_gender"]==1) { $bajajgender="Male";}elseif($row_result[$i]["bajajf_gender"]==2) { $bajajgender="Female";}
			
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['bajajf_name'], 'mobile_number'=>$row_result[$i]['bajajf_mobile'], 'city'=>$row_result[$i]['bajajf_city'], 'dob'=>$row_result[$i]['bajajf_dob'], 'gender'=>$bajajgender, 'loan_amount'=>$row_result[$i]['bajajf_loan_amt'], 'pancard'=>$row_result[$i]['bajajf_panno'], 'residence_address'=>$row_result[$i]['bajajf_caddress'], 'residential_status'=>$row_result[$i]['bajajf_cstate'], 'pincode'=>$row_result[$i]['bajajf_cpincode'], 'c_name'=>$row_result[$i]['bajajf_company_name'], 'count_replies'=>$row_result[$i]['bajajf_paddress'], 'is_modified'=>$row_result[$i]['bajajf_pstate'], 'is_processed'=>$row_result[$i]['bajajf_ppincode'], 'net_salary'=>$row_result[$i]['bajajf_salary'], 'doe'=>$row_result[$i]['bajaj_dated'], 'Feedback'=>$row_result[$i]['bajajfg_feedback']);
		}
		else
		{
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['bajajf_name'], 'email'=>$row_result[$i]['bajajf_email'], 'mobile_number'=>$row_result[$i]['bajajf_mobile'], 'city'=>$row_result[$i]['bajajf_city'], 'city_other'=>$row_result[$i]['bajajf_city_other'], 'c_name'=>$row_result[$i]['bajajf_company_name'], 'net_salary'=>$row_result[$i]['bajajf_net_salary'], 'loan_amount'=>$row_result[$i]['bajajf_loan_amount'], 'pincode'=>$row_result[$i]['bajajf_pincode'], 'doe'=>$row_result[$i]['bajajf_dated'], 'Feedback'=>$row_result[$i]['bajajfg_feedback'], 'count_replies'=>$row_result[$i]['residence_address'], 'is_modified'=>$row_result[$i]['residence_landline'], 'is_processed'=>$row_result[$i]['purpose_of_loan'], 'residential_status'=>$row_result[$i]['qualification'], 'residence_address'=>$row_result[$i]['marital_status'], 'plan_interested'=>$row_result[$i]['no_of_dependent'], 'descr'=>$row_result[$i]['residence_type'], 'login_date'=>$row_result[$i]['residing_since'], 'apt_dt'=>$row_result[$i]['designation'], 'docs'=>$row_result[$i]['department'], 'address_apt'=>$row_result[$i]['current_experience'], 'current_age'=>$row_result[$i]['total_experience'], 'car_make'=>$row_result[$i]['office_address'], 'car_model'=>$row_result[$i]['office_landline'], 'car_type'=>$row_result[$i]['office_email'], 'pancard'=>$row_result[$i]['bajajf_panno'], 'dob'=>$row_result[$i]['bajajf_dob'], 'source'=>$row_result[$i]['bajajf_source']);
 
		}
	$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
	}
	if($section=="GreenChannel")
		{
			$qry="select name AS Name, mobile_number AS MobileNo, city AS City, dob AS DOB, gender AS Gender, loan_amount AS LoanAmt, pancard AS Pancard, residence_address AS CurrentAddr, residential_status AS CurrentState, pincode AS CrrentPincode, c_name AS CompanyName, count_replies AS PermanentAddr, is_modified AS PermanentState, is_processed AS PPincode,  net_salary AS Income, Feedback AS Feedback, doe AS DateOfEntry  from temp where session_id='".$session_id."'";
		}
		else
		{	
	
	$qry="select name AS CustomerName, email AS Emailid, mobile_number AS MobileNo,dob AS DOB, city AS City, city_other AS OtherCity, pincode AS Pincode, c_name AS CompanyName, net_salary AS Salary, loan_amount AS LoanAmt,pancard AS PanCard, count_replies AS Resiaddress, is_modified AS Resilandline, is_processed AS purposeOfloan, residential_status AS qualification, residence_address AS Maritalstat, plan_interested AS Noofdependent, descr AS Resitype, login_date AS ResidingSince, apt_dt AS Designation, docs AS Department, address_apt AS currentexperience, current_age AS totalexp ,car_make AS Officeaddress, car_model AS officelandline, car_type AS officeemail, Feedback AS Feedback, doe AS DateOfEntry, source AS SRCCODE from temp where session_id='".$session_id."'";		
		}
	
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
