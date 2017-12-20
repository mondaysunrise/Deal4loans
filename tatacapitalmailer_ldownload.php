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
		if($row_result[$i]["tatacapital_employment_status"]==1) { $empstat="Salaried";}elseif($row_result[$i]["tatacapital_employment_status"]==0) { $empstat="Sele Employed";}
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['tatacapital_name'], 'email'=>$row_result[$i]['tatacapital_email'], 'mobile_number'=>$row_result[$i]['tatacapital_mobile_number'], 'dob'=>$row_result[$i]['tatacapital_age'], 'city'=>$row_result[$i]['tatacapital_city'], 'city_other'=>$row_result[$i]['tatacapital_other_city'], 'emp_status'=>$empstat, 'net_salary'=>$row_result[$i]['tatacapital_net_Salary'], 'annual_income'=>$row_result[$i]['tatacapital_annual_turnover'], 'total_exp'=>$row_result[$i]['tatacapital_total_experience'], 'loan_amount'=>$row_result[$i]['tatacapital_loan_amount'], 'c_name'=>$row_result[$i]['tatacapital_company_name'], 'ip_address'=>$row_result[$i]['tatacapital_ip'], 'Feedback'=>$row_result[$i]['tatacapital_feedback'], 'doe'=>$row_result[$i]['tatacapital_dated']);
			$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
	}
	
	$qry="select name AS Name, email AS Email, mobile_number AS MobileNo, dob AS DOB, city AS City, city_other AS OtherCity, emp_status AS Occupation, net_salary AS AnnualIncome, annual_income AS AnnualTurnover, total_exp AS totalExp, loan_amount As LoanAmount, c_name As ComapnyName, ip_address As IPaddress, Feedback, doe AS DateOfEntry from temp where session_id='".$session_id."'";		
			
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
	$cntr=0;
	
while($cntr<count($myrow))
        {
			
		$myrowarr=$myrow[$cntr];
		
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
	 $cntr=$cntr+1;}
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
