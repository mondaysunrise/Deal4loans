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
		if($row_result["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result["Residential_Status"]==3) { $residential_status="Company Provided"; }
		 if($row_result["Property_Type"]==0) { $property_type="Commercial office Space"; } 
     if($row_result["Property_Type"]==1) { $property_type="Appartment"; }  if($row_result["Property_Type"]==2) { $property_type="Industrial House"; } if($row_result["Property_Type"]==3) { $property_type="Showroom"; }
		if($row_result["Property_Type"]==4) { $property_type="Factory"; }  if($row_result["Property_Type"]==5) { $property_type="Plot"; } if($row_result["Property_Type"]==6) { $property_type="Godown"; }
        if($row_result["Property_Type"]==7) { $property_type="Bungalow"; }
	if($row_result["Email"]=="")
		{
			$dob=$row_result["dob"];} else { $dob=$row_result["DOB"];}
		$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, residential_status, pincode, descr, property_type, property_value, loan_amount, residence_address, doe, source,is_valid, count_replies) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Code"]."',  '".$row_result["Land"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$residential_status."', '".$row_result["Pincode"]."', '".$row_result["Descr"]."', '".$property_type."', '".$row_result["Property_Value"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Residence_Address"]."', '".$row_result["Dated"]."', '".$row_result["source"]."', '".$row_result["Is_Valid"]."', '".$row_result["Bidder_Count"]."')";
			$result1=ExecQuery($qry1);
		
		
	}
	
	$qry="select name, dob, emp_status, c_name, city, city_other, net_salary, residential_status, pincode, descr, property_type, property_value, loan_amount, residence_address, doe, source,is_valid,count_replies  from temp where session_id='".$session_id."'";
	
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
