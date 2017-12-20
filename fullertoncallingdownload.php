<?php
//Not Done
//ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
session_start();

function filter_blank($var) 
{
        return !(empty($var) || is_null($var));
}	
		
$Today = date("Y-m-d"); 
//$min_date=$Today." 00:00:00";
//$max_date=$Today." 23:59:59";

$min_date=$_POST['min_date'];
$max_date=$_POST['max_date'];

$sql  = "select a_city from fullerton_leads where 1=1 and (dated between '".$min_date."' and '".$max_date."') group by a_city";

 list($numRows,$getrow)=MainselectfuncNew($sql,$array = array());
		$cntr=0;
$titles_city = "";
while($cntr<count($getrow))
   {
	$a_city = $getrow[$cntr]['a_city'];
	$titles_city[] = $a_city;
	$cntr=$cntr+1;
	}


$titles = array_filter($titles_city, "filter_blank"); 	
$session_id="";
//print_r($titles);

for($j=0;$j<count($titles);$j++)
{
	$session_id="";
	$session_id=session_id();
	
	$search_qry="";
	
	$search_qry="SELECT * FROM fullerton_leads where a_city='".$titles[$j]."' and (dated between '".$min_date."' and '".$max_date."')";	
	 list($recordcount,$row_result)=MainselectfuncNew($search_qry,$array = array());
		$k=0;
	
	
	$newfileatt = "";
	$row_result = "";
	
while($k<count($row_result))
        {
		
		$a_feedback = $row_result[$k]["a_feedback"];
		$a_fullowup_date = $row_result[$k]["a_fullowup_date"];
		$a_month = $row_result[$k]["a_month"];
		$a_telecaller = $row_result[$k]["a_telecaller"];
		$a_date = $row_result[$k]["a_date"];
		$a_time = $row_result[$k]["a_time"];
		$a_city = $row_result[$k]["a_city"];
		if($a_city =="Asaf Ali" || $a_city =="Nehru P")
		{
			$City = "Delhi";
		}
		else if($a_city =="Tushal" || $a_city =="Samadan Kale")
		{
			$City = "Pune";
		}
		else
		{
			$City = $a_city;
		}

		$a_pincode = $row_result[$k]["a_pincode"];
		$a_loan_amt = $row_result[$k]["a_loan_amt"];
		$a_final_loan_amt = $row_result[$k]["a_final_loan_amt"];
		$a_leaddate  = $row_result[$k]["a_leaddate"];
		$a_netsalary = $row_result[$k]["a_netsalary"];
		$a_remark = $row_result[$k]["a_remark"];
		$LeadID = $row_result[$k]["LeadID"];
		$a_address = $row_result[$k]["a_address"];
		$roi = $row_result[$k]["roi"];
		
		$getUserSql = "select * from Req_Loan_Personal where RequestID='".$LeadID."'";

	    list($recordcount,$Arrrow)=MainselectfuncNew($getUserSql,$array = array());
		$n=0;
	
		$Name = $Arrrow[$h]['Name'];
		$Employment_Status = $Arrrow[$h]['Employment_Status'];
		if($Employment_Status==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		$Company_Name = $Arrrow[$h]['Company_Name'];
		//$City =$Arrrow[$h]['City'];
		$City_Other  =$Arrrow[$h]['City_Other'];
		$Mobile_Number =$Arrrow[$h]['Mobile_Number'];
		$dob =$Arrrow[$h]['DOB'];
		
		$expDt = explode(" ",$a_date);
		$expday = explode("-", $expDt[0]);
		$expTime = explode("-", $expDt[1]);
		$mkTime = mktime($expTime[0],$expTime[1],$expTime[2],$expday[1], $expday[2],$expday[0]);
		
		$a_date_Needed = date("d-M",$mkTime);

		
		$expleadDt = explode(" ",$a_leaddate);
		$expleadday = explode("-", $expleadDt[0]);
		$expleadTime = explode("-", $expleadDt[1]);
		$mkleadTime = mktime($expleadTime[0],$expleadTime[1],$expleadTime[2],$expleadday[1], $expleadday[2],$expleadday[0]);
		
		$a_leaddate_Needed = date("d-M",$mkleadTime);
		
		
		//Net Salary, Loan Amt, 
			
			$qry1 = "";
			
			
			$dataInsert = array("session_id"=>$session_id, "name"=>$Name, "dob"=>$dob, "emp_status"=>$emp_status, "c_name"=>$Company_Name, "city"=>$City, "city_other"=>$City_Other, "mobile_number"=>$Mobile_Number, "std_code"=>$a_final_loan_amt, "landline"=>$a_time, "std_code_o"=>$a_pincode, "landline_o"=>$a_feedback, "net_salary"=>$a_netsalary, "marital_status"=>$a_loan_amt, "residential_status"=>$a_loan_amt, "vehicle_owned"=>$a_date_Needed, "loan_any"=>$a_month, "emi_paid"=>$a_telecaller, "ip_address"=>$a_leaddate_Needed, "is_processed"=>$a_address, " pancard"=>'', "contact_time"=>$roi);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
			
			

	
		//echo "<br>".$qry1."<br>";
	$k = $k +1;}
	
}
	$qry = '';
	 $qry="select loan_any as Month, emi_paid as Telecaller, ip_address as LeadDate, vehicle_owned as ApptDate, name as Name, mobile_number as MobileNumber, dob as DOB, emp_status as EmpStatus, c_name as CompanyName, marital_status as NetSalary, residential_status as LoanAmount, std_code as FinalLoanAmount, landline as ApptTime, is_processed as Address, city as City,  std_code_o as Pincode, landline_o as Feedback, net_salary as Remark, pancard as LoginDate , contact_time as ROI from temp where session_id='".$session_id."' order by doe DESC ";
	
	
	//echo "<br>".$qry."<br>";
	$newfileatt = "";		
	$header="";
	$newdata="";
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
	
	$qry1="delete from `temp` where session_id='".$session_id."'";
	Maindeletefunc($qry1,$array = array());
?>