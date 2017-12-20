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
	  	$exclusiveLead = '';
	list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{

		  if($row_result[$i]["icici_feedback"]=="" || $row_result[$i]["icici_feedback"]=="FollowUp" || $row_result[$i]["icici_feedback"]=="Logged In" ||  $row_result[$i]["icici_feedback"]=="Appointment fixed" || $row_result[$i]["icici_feedback"]=="Appointment postponed") 
			  { $icici_ccstatus="Open"; } else { $icici_ccstatus="Closed"; }
				
		if($row_result[$i]["icici_emp_status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
		if($row_result[$i]["icici_exist_rel"]==1) { $exist_rel="Yes"; } else { $exist_rel="No"; }

	if($row_result[$i]["icici_typrofrel"]==1) { $typrofrel="Account Holder"; }  if($row_result[$i]["icici_typrofrel"]==2) { $typrofrel="Loan Running";}
	if($row_result[$i]["icici_typrofrel"]==3) { $typrofrel="Others";}
		if($row_result[$i]["icici_typrofrel"]==0) { $typrofrel="";}
		
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['icici_name'], 'dob'=>$row_result[$i]['icici_dob'], 'email'=>$row_result[$i]['icici_email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['icici_employer'], 'city'=>$row_result[$i]['icici_city'], 'mobile_number'=>$row_result[$i]['icici_mobileno'], 'net_salary'=>$row_result[$i]['icici_income'], 'Feedback'=>$row_result[$i]['icici_feedback'], 'doe'=>$row_result[$i]['icici_dated'], 'add_comment'=>$row_result[$i]['icici_comment'], 'descr'=>'ICICI Bank Platinum Chip Credit Card', 'apt_dt'=>$icici_ccstatus, 'city_other'=>$row_result[$i]['icici_city_other'], 'is_processed'=>$exist_rel, 'Documents'=>$typrofrel);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);	
	}
	
$qry="select name AS Name, dob AS DOB, email AS EmailID, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity,  mobile_number AS MobileNo, net_salary AS AnnualIncome, Feedback, doe AS DateOfEntry, add_comment AS Comment, descr AS CardType, apt_dt AS Status, is_processed AS ExistingRel, Documents AS TypeofRel from temp where session_id='".$session_id."' order by doe DESC";
			
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());
	$dataBidder = array('BidderID'=>$_SESSION['BidderID'], 'BidderName'=>$_SESSION['UName'], 'BidderProduct'=>$_SESSION['ReplyType'], 'BidderTable'=>$qry2, 'BidderSession'=>$session_id, 'NoofRecords'=>$num_rows, 'Dated'=>$Dated, 'MinDate'=>$mindate, 'MaxDate'=>$maxdate);
    Maininsertfunc ("BidderDownloadCount", $dataBidder);	
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
