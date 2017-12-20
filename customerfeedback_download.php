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
		
	$qry1="insert into temp (session_id, name, city, city_other, mobile_number, loan_amount, pincode, doe, employer, loan_time, source,count_replies, loan_any) 

values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."',  '".$row_result["Mobile_Number"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."',  '".$row_result["Dated"]."', '".$row_result["received_call"]."', '".$row_result["bank_experience"]."', '".$row_result["bank_requirement_fulfilled"]."', '".$row_result["bank_name"]."', '".$row_result["gone_to_bankname"]."' )";
		$result1=ExecQuery($qry1);
	}
	 
	
	$qry="select name, city, city_other, mobile_number, loan_amount, pincode, doe, employer AS Did_you_receive_call_from_Bank, loan_time As experience_with_banks_services_offered, source AS Did_you_finalize_loan_with_any_bank,count_replies AS If_yes_then_which_bank, loan_any AS GoneToBanks from temp where session_id='".$session_id."'";
		
		
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
