<?php
session_start();	

	require 'scripts/db_init.php';
	require 'scripts/functions.php';
function Determine_AgeFrom_DOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;   if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0) {    if ($ddiff < 0)    {    $ydiff--;    }  }  return $ydiff;}
	
	$session_id=session_id();
//echo "hello".$_SESSION['BidderID'];
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
	//$value=explode(",", $_POST["qry2"]);
       // $qry2=$value[1];
//echo "gff=".$qry1;
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	$Dated = ExactServerdate();
	
	
	$qry1=str_replace("\'", "'", $qry1);
	
     
 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
$cntr=0;
while($cntr<count($row_result))
      {
		$DOB = $row_result[$cntr]["DOB"];
		$impldob = str_replace("-", "", $DOB);
		$age = Determine_AgeFrom_DOB($impldob);
		
		if($row_result[$cntr]["Country"]=="1")
		{
			$country =  "India";
		}			
		else if($row_result[$cntr]["Country"]=="2")
		{
			$country =  "UK";
		}
		else if($row_result[$cntr]["Country"]=="3")
		{
			$country =  "USA";
		}
		else if($row_result[$cntr]["Country"]=="4")
		{
			$country =  "Others";
		}
		
		if($row_result[$cntr]["Course"]=="1")
		{
			$Course =  "MBA";
		}			
		else if($row_result[$cntr]["Course"]=="2")
		{
			$Course =  "Post Graduation Courses";
		}
		else if($row_result[$cntr]["Course"]=="3")
		{
			$Course =  "Graduation Courses";
		}
		else if($row_result[$cntr]["Course"]=="4")
		{
			$Course = "Other Courses";
		}
		
	$dataInsert = array("session_id"=>$session_id, "name"=>$row_result[$cntr]["Name"], "dob"=>$age, "email"=>$row_result[$cntr]["Email"], "emp_status"=>$country, "c_name"=>$Course, "city"=>$row_result[$cntr]["Loan_Amount"], "city_other"=>$$row_result[$cntr]["Email"], "year_in_comp"=>$row_result[$cntr]["Mobile_Number"], "total_exp"=>$row_result[$cntr]["Residence_City"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"], "std_code"=>$row_result[$cntr]["Collateral_Security"], "industry"=>$row_result[$cntr]["source"]);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
		//echo "".$qry1."<br>";
	 $cntr=$cntr+1;
	 }
		$qry="select name as Name, dob as Age, email as Gender, emp_status as Country, c_name as Course, city as LoanAmount, city_other Email, year_in_comp as MobileNumber, total_exp as ResidenceCity, mobile_number as CollateralSecurity, industry  as Source , std_code as Date from temp where session_id='".$session_id."' order by doe DESC ";


	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
		
	$dataInsert = array("BidderID"=>$_SESSION['BidderID'], "BidderName"=>$_SESSION['UName'], "BidderProduct"=>$_SESSION['ReplyType'], "BidderTable"=>$qry2, "BidderSession"=>$session_id, "NoofRecords"=>$num_rows, "Dated"=>$Dated, "MinDate"=>$mindate, "MaxDate"=>$maxdate);
$table = 'BidderDownloadCount';
$insert = Maininsertfunc ($table, $dataInsert);
	
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
