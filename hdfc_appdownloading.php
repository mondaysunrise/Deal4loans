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
	
	$hdfcgifts = "Select * from hdfc_car_loan_gifts where (hdfc_car_loan_gifts.id=".$row_result[$i]["reward_selected"].")");
	 list($giftcount,$row_gifts)=MainselectfuncNew($hdfcgifts,$array = array());
	 $Product_Name = $row_gifts["Product_Name"];

	$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['Car_Model'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'total_exp'=>$row_result[$i]['Total_Experience'], 'doe'=>$row_result[$i]['Dated'], 'pancard'=>$row_result[$i]['Pancard'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'add_comment'=>$Product_Name);
$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
	}


	$qry="select name AS Name, dob AS DOB, mobile_number AS MobileNo, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS CarModel, net_salary AS Salary, total_exp AS TotalExperience, pancard AS Pancard, loan_amount AS LoanAmt, add_comment AS Gift, doe AS DOE  from temp where session_id='".$session_id."' order by doe DESC ";


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
