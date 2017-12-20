<?
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	
	$qry1=str_replace("\'", "'", $qry1);
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());


	for($i=0;$i<$recordcount;$i++)
	{
		if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		
	if($row_result[$i]["Car_Type"]==0) { $car_type="Used"; } else { $car_type="New"; }

		$dob = $row_result[$i]["DOB"];
		$dateofbirth = date('Y')-substr($row_result[$i]["DOB"],0,4);
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'std_code'=>$row_result[$i]['Std_Code'], 'landline'=>$row_result[$i]['Landline'], 'std_code_o'=>$row_result[$i]['Std_Code_O'], 'landline_o'=>$row_result[$i]['Landline_O'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'car_make'=>$car_make, 'car_model'=>$row_result[$i]['Car_Model'], 'car_type'=>$row_result[$i]['car_type'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'pincode'=>$row_result[$i]['Pincode'], 'Feedback'=>$row_result[$i]['Feedback'], 'doe'=>$row_result[$i]['Dated'], 'current_age'=>$dobofbirth, 'source'=>$row_result[$i]['source'], 'is_valid'=>$row_result[$i]['Is_Valid'], 'plan_interested'=>$row_result[$i]['Bidder_Count'], 'add_comment'=>$row_result[$i]['Add_Comment']);
				$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
	}
	
//	$qry="select name, c_name, email, city, city_other, pincode, contact_time, emp_status, net_salary, dob, std_code, landline, mobile_number, std_code_o, landline_o, loan_amount, car_type, Feedback, doe, current_age, source,is_valid,plan_interested As CarInsurance from temp where session_id='".$session_id."'";
		
$qry="select name, dob ,city, city_other, pincode, net_salary AS Salary, loan_amount AS LoanAmt, Feedback, doe, source,is_valid,plan_interested As BidderCount, add_comment AS Comment  from temp where session_id='".$session_id."'";

	
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
		Maindeletefunc($qry1,$array = array());
	//*/

?>
