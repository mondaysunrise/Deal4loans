<?
session_start();	
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];	
	
	$qry1=str_replace("\'", "'", $qry1);	
 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());


	for($i=0;$i<$recordcount;$i++)
	{
		if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$i]["company_type"]==4)
		{
			$comp_type="Govt.(Central/State)";
		}
		elseif($row_result[$i]["company_type"]==5)
		{
			$comp_type="PSU (Public sector Undertaking)";
		}
		elseif($row_result[$i]["company_type"]==1)
		{
			$comp_type="Pvt Ltd";
		}
		elseif($row_result[$i]["company_type"]==2)
		{
				$comp_type="MNC Pvt Ltd";
		}
		elseif($row_result[$i]["company_type"]==3)
		{
				$comp_type="Limited";
		}
		else
		{
			$comp_type="";
		}

	$annualincome=$row_result[$i]["net_salary"] * 12;

	$getBidderSql = "select * from msging where rid='".$row_result[$i]["ingvyasyaplid"]."'";
	 list($recordcount1,$getBidderQuery)=MainselectfuncNew($getBidderSql,$array = array());
	$bid = $getBidderQuery[0]['bid'];


		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['name'], 'dob'=>$row_result[$i]['age'], 'email'=>$row_result[$i]['mobile_number'], 'emp_status'=>$row_result[$i]['email_id'], 'c_name'=>$row_result[$i]['DOB'], 'city'=>$emp_status, 'city_other'=>$row_result[$i]['company_name'], 'year_in_comp'=>$row_result[$i]['city'], 'total_exp'=>$comp_type, 'mobile_number'=>$row_result[$i]['net_salary'], 'net_salary'=>$row_result[$i]['primary_acc'], 'residential_status'=>$row_result[$i]['eligible_loanAmt'], 'loan_any'=>$row_result[$i]['Feedback'], 'emi_paid'=>$row_result[$i]['comment_section'], 'cc_holder'=>$row_result[$i]['Dated'], 'add_comment'=>$annualincome, 'referred_page'=>$bid, 'residence_address'=>$row_result[$i]['residence_address'], 'address_apt'=>$row_result[$i]['office_address'], 'pancard'=>$row_result[$i]['Panno']);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
	}

	$qry="select  name as Name, dob as Age, email as MobileNumber, emp_status as EmailID, c_name as DOB, city as EmploymentStatus, city_other as CompanyName, year_in_comp as City, total_exp as CompanyType, mobile_number as NetSalary, add_comment AS AnnualIncome, residential_status as LoanAmount, loan_any as Feedback, emi_paid as Comment, cc_holder as DOE, referred_page as BidderID, pancard AS Pancard, residence_address AS ResidenceAddress, address_apt AS OfficeAddress  from temp where session_id='".$session_id."' order by doe DESC ";

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
