<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];	
	
	$qry1=str_replace("\'", "'", $qry1);	
	$qry=$qry1;
      
	/*while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["company_type"]==4)
		{
			$comp_type="Govt.(Central/State)";
		}
		elseif($row_result["company_type"]==5)
		{
			$comp_type="PSU (Public sector Undertaking)";
		}
		elseif($row_result["company_type"]==1)
		{
			$comp_type="Pvt Ltd";
		}
		elseif($row_result["company_type"]==2)
		{
				$comp_type="MNC Pvt Ltd";
		}
		elseif($row_result["company_type"]==3)
		{
				$comp_type="Limited";
		}
		else
		{
			$comp_type="";
		}

	$annualincome=$row_result["net_salary"] * 12;

	$getBidderSql = "select * from msging where rid='".$row_result["ingvyasyaplid"]."'";
	$getBidderQuery = ExecQuery($getBidderSql);
	$bid = mysql_result($getBidderQuery,0,'bid');
//name,age,	mobile_number ,	email_id, DOB, Employment_Status, company_name, city, company_type,net_salary , primary_acc, eligible_loanAmt 
$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder,add_comment,referred_page, residence_address, address_apt, pancard) values ('".$session_id."', '".$row_result["name"]."', '".$row_result["age"]."', '".$row_result["mobile_number"]."', '".$row_result["email_id"]."', '".$row_result["DOB"]."', '".$emp_status."', '".$row_result["company_name"]."', '".$row_result["city"]."', '".$comp_type."', '".$row_result["net_salary"]."',  '".$row_result["primary_acc"]."', '".$row_result["eligible_loanAmt"]."', '".$row_result["Feedback"]."', '".$row_result["comment_section"]."', '".$row_result["Dated"]."','".$annualincome."','".$bid."','".$row_result["residence_address"]."', '".$row_result["office_address"]."', '".$row_result["Panno"]."')";
			$result1=ExecQuery($qry1);
		//	echo "fsfsd ".$qry1."<br>";
	}

	$qry="select  name as Name, dob as Age, email as MobileNumber, emp_status as EmailID, c_name as DOB, city as EmploymentStatus, city_other as CompanyName, year_in_comp as City, total_exp as CompanyType, mobile_number as NetSalary, add_comment AS AnnualIncome, residential_status as LoanAmount, loan_any as Feedback, emi_paid as Comment, cc_holder as DOE, referred_page as BidderID, pancard AS Pancard, residence_address AS ResidenceAddress, address_apt AS OfficeAddress  from temp where session_id='".$session_id."' order by doe DESC ";
	*/

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$result = ExecQuery($qry);
	//echo "fff".$qry."<br>";
	$num_rows = mysql_num_rows($result);
	
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
