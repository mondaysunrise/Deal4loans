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
			if($row_result["Car_Type"]==1) { $car_type="New"; }
			if($row_result["Car_Type"]==0) { $car_type="Old"; }  
				
		
			if($row_result["Car_Booked"]==1)
			{			 $Car_Booked="Yes";			}
			else if ($row_result["Car_Booked"]==2)
			{			$Car_Booked="No";			}
			else
			{			$Car_Booked="";			}

$acc_no= $row_result["Account_No"];
			
		

			$Dateofallocation = $row_result["Allocation_Date"];
list($firstnme,$lastnme) = split('[ ]', $row_result["Name"]);

list($date,$time) = split('[ ]', $Dateofallocation);
list($year,$month,$day) = split('[-]', $date);
$date_flag=$day."-".date("M", strtotime($date))."-".$year;

			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, car_model, loan_amount, pincode, Feedback, contact_time, is_processed, doe,add_comment, descr,pancard,referred_page, changeapp_time, apt_dt, address_apt, loan_tenure,docs,bank_name,budget,product_type, constitution, current_age, landline , property_value) values ('".$session_id."', '".$firstnme."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."',  '".$row_result["Net_Salary"]."', '".$row_result["Car_Model"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."', '".$row_result["Feedback"]."', '".$row_result["Contact_Time"]."', '".$car_type."', '".$Dateofallocation."','".$row_result["comment_section"]."','".$descr."','".$acc_no."','".$specialP."','".$time."','".$appdate."','".$address_apt."','".$Existing_Relationship."','".$date_flag."', '".$row_result["Pancard"]."', '".$row_result["Office_address"]."', '".$row_result["Residence_Address"]."', '".$Product_Name."','".$exclusiveLead."','".$row_result["Landline"]."', '".$lastnme."')";
			//echo "".$qry1."<br>";
			$result1=ExecQuery($qry1);
		
	}

	$qry="select docs AS Date_Flag,name AS FirstName, property_value AS Lastname, loan_amount AS Loan_Value, net_salary AS Annual_Income, mobile_number AS Individual_Mob_Ph, email AS Email, landline AS Residence_Landline_No, pincode AS Pincode, city AS Pref_Location from temp where session_id='".$session_id."'";

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
	//*/

?>
