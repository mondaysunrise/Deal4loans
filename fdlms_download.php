<?
session_start();	

	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
//echo "hello".$_SESSION['BidderID'];
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
	//$value=explode(",", $_POST["qry2"]);
       // $qry2=$value[1];
//echo "gff=".$qry2;
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	
	
	$qry1=str_replace("\'", "'", $qry1);
	
     
	list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
	$cntr=0;

	
	while($cntr<count($row_result))
        {
		$duration ='';
		 if($row_result[$cntr]["investment_duration"]=="5")
		 {
			$duration =  "7 - 180 days";
		 }
		 else if($row_result[$cntr]["investment_duration"]=="11")
		 {
			$duration =  "181 - 365 days";
		 }
		 else if($row_result[$cntr]["investment_duration"]=="23")
		 {
			$duration =  "1st-2nd Year";
		 }
		 else if($row_result[$cntr]["investment_duration"]=="35")
		 {
			$duration =  "2nd-3rd Year";
		 }
		 else if($row_result[$cntr]["investment_duration"]=="46")
		 {
			$duration =  "3rd-4th Year";
		 }
		 else if($row_result[$cntr]["investment_duration"]=="58")
		 {
			$duration =  "4th-5th Year";
		 }
		 else if($row_result[$cntr]["investment_duration"]=="118")
		 {
			$duration =  "5th-10th Year";
		 }
			 	
			$dataInsert = array("session_id"=>$session_id, "name"=>$row_result[$cntr]["name"], "dob"=>$row_result[$cntr]["dob"], "email"=>$row_result[$cntr]["email"], "emp_status"=>$row_result[$cntr]["mobile_number"], "c_name"=>$row_result[$cntr]["investment_amount"], "city_other"=>$duration, "city"=>$row_result[$cntr]["city"], "doe"=>$row_result[$cntr]["dated"], "add_comment"=>$row_result[$cntr]["comment_section"], "Feedback"=>$row_result[$cntr]["Feedback"]);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
			
		

 $cntr=$cntr+1;	}

		$qry="select name as Name, dob as DOB, email as Email, emp_status as MobileNumber, city as City, c_name as InvestmentAmount, city_other as Duration,add_comment as Comment,Feedback, doe as Dated   from temp where session_id='".$session_id."' order by doe DESC ";

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$Dated = ExactServerdate();
	$dataBidder = array('BidderID'=>$_SESSION['BidderID'], 'BidderName'=>$_SESSION['UName'], 'BidderProduct'=>$_SESSION['ReplyType'], 'BidderTable'=>$qry2, 'BidderSession'=>$session_id, 'NoofRecords'=>$num_rows, 'Dated'=>$Dated, 'MinDate'=>$mindate, 'MaxDate'=>$maxdate);
	$insert = Maininsertfunc ("BidderDownloadCount", $dataBidder);
	
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
?>
