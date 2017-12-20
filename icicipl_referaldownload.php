<?
session_start();	

	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	$qry1=$_POST["qry1"];
	       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	
	
	$qry1=str_replace("\'", "'", $qry1);
	
 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{
		
if($row_result[$i]["referral_ccholder"]==1) { $ccholder="yes"; } else { $ccholder="No"; }

	$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['employee_name'], 'dob'=>$row_result[$i]['referral_dob'], 'email'=>$row_result[$i]['employ_contact'], 'emp_status'=>$row_result[$i]['employee_email'], 'c_name'=>$row_result[$i]['referral_occupation'], 'city'=>$row_result[$i]['referral_company_name'], 'city_other'=>$row_result[$i]['employee_city'], 'year_in_comp'=>$row_result[$i]['icici_leadtype'], 'total_exp'=>$row_result[$i]['referral_income'], 'mobile_number'=>$row_result[$i]['employee_pincode'], 'net_salary'=>$row_result[$i]['referral_loan_amount'], 'residential_status'=>$row_result[$i]['employ_id'], 'loan_any'=>$ccholder, 'emi_paid'=>$row_result[$i]['icicipl_dated']);
	$table = 'temp';
	$insert = Maininsertfunc ($table, $dataInsert);	
	
	}

	$qry="select residential_status AS EmployID , name AS Name, dob AS DOB, email AS Contact, emp_status AS Email, city AS CompanyName, city_other AS City, total_exp AS Income, mobile_number AS Pincode, net_salary AS LoanAmt, loan_any AS CCHolder, year_in_comp AS LeadType, emi_paid AS DOE from temp where session_id='".$session_id."' order by doe DESC ";


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
