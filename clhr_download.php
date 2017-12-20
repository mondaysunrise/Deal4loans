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
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		
	if($row_result["Car_Type"]==0) { $car_type="Used"; } else { $car_type="New"; }

				$dob = $row_result["DOB"];
				$dateofbirth = date('Y')-substr($row_result["DOB"],0,4);
			
		$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, std_code, landline, mobile_number, std_code_o, landline_o, net_salary, car_make, car_model, car_type, loan_amount, pincode, Feedback, doe, current_age, source,is_valid,  plan_interested,add_comment ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$car_make."', '".$row_result["Car_Model"]."', '".$car_type."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."', '".$row_result["Feedback"]."', '".$row_result["Dated"]."',  '".$dobofbirth."', '".$row_result["source"]."', '".$row_result["Is_Valid"]."', '".$row_result["Bidder_Count"]."','".$row_result["Add_Comment"]."')";

		$result1=ExecQuery($qry1);
	}
	
//	$qry="select name, c_name, email, city, city_other, pincode, contact_time, emp_status, net_salary, dob, std_code, landline, mobile_number, std_code_o, landline_o, loan_amount, car_type, Feedback, doe, current_age, source,is_valid,plan_interested As CarInsurance from temp where session_id='".$session_id."'";
		
$qry="select name, dob , mobile_number, email, city, city_other, pincode, net_salary AS Salary, loan_amount AS LoanAmt, Feedback, doe, source,is_valid,plan_interested As BidderCount, add_comment AS Comment  from temp where session_id='".$session_id."'";

	
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
	
	//echo $data;
	///exit();
	
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
