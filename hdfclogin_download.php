<?
	//include ("includes/check_login.php");
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	
	$qry1=str_replace("\'", "'", $qry1);
	
	
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
		$cntr=0;
	
	while($cntr<count($row_result))
        {
		if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$cntr]["Marital_Status"]==1) {  $marital_status="Single"; } else { $marital_status="Married"; }
		if($row_result[$cntr]["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result[$cntr]["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result[$cntr]["Residential_Status"]==3) { $residential_status="Company Provided"; }
		if($row_result[$cntr]["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
		if($row_result[$cntr]["Loan_Any"]==0) { $loan_any="N/A"; } if($row_result[$cntr]["Loan_Any"]==1) { $loan_any="Car Loan"; } if($row_result["Loan_Any"]==2) { $loan_any="Home Loan"; } if($row_result[$cntr]["Loan_Any"]==3) { $loan_any="Personal Loan"; } if($row_result[$cntr]["Loan_Any"]==4) { $loan_any="Other"; }
		if($row_result[$cntr]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$cntr]["CC_Holder"]==0) { $cc_holder="No"; }
		$dob_loan=$row_result[$cntr]["dob"];
		if(strlen($dob_loan)>0)
		{
			$dob=$dob_loan;} else { $dob=$row_result[$cntr]["DOB"];}
			
	$dataInsert = array("(session_id"=>$session_id, "name"=>$row_result[$cntr]["Name"], "dob"=>$dob, "email"=>$row_result[$cntr]["Email"], "emp_status"=>$emp_status, "c_name"=>$row_result[$cntr]["Company_Name"], "city"=>$row_result[$cntr]["City"], "city_other"=>$row_result[$cntr]["City_Other"], "year_in_comp"=>$row_result[$cntr]["Years_In_Company"], "total_exp"=>$row_result[$cntr]["Total_Experience"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"], "net_salary"=>$row_result[$cntr]["Net_Salary"], "marital_status"=>$marital_status, "residential_status"=>$residential_status, "vehicle_owned"=>$vehicle_owned, "loan_any"=>$loan_any, "emi_paid"=>$row_result[$cntr]["EMI_Paid"], "cc_holder"=>$cc_holder, "loan_amount"=>$row_result[$cntr]["Loan_Amount"], "count_views"=>$row_result[$cntr]["Count_Views"], "count_replies"=>$row_result[$cntr]["Count_Replies"], "is_modified"=>$row_result[$cntr]["IsModified"], "is_processed"=>$row_result[$cntr]["IsProcessed"], "doe"=>$row_result[$cntr]["Dated"]);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
	
	
	$cntr = $cntr +1;
	
	}
	
	$qry="select name, dob, email, mobile_number, emp_status, c_name, city, city_other, net_salary, loan_any, emi_paid, loan_amount, doe from temp where session_id='".$session_id."'";
		
	
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
