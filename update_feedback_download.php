<?php
session_start();	
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	error_reporting();
	function encrypt($string, $key) {
	$result = '';
	for($i=0; $i<strlen($string); $i++) {
	$char = substr($string, $i, 1);
	$keychar = substr($key, ($i % strlen($key))-1, 1);
	$char = chr(ord($char)+ord($keychar));
	$result.=$char;
	}
	
	return base64_encode($result);
	}
	
	function decrypt($string, $key) {
	$result = '';
	$string = base64_decode($string);
	
	for($i=0; $i<strlen($string); $i++) {
	$char = substr($string, $i, 1);
	$keychar = substr($key, ($i % strlen($key))-1, 1);
	$char = chr(ord($char)-ord($keychar));
	$result.=$char;
	}
	
	return $result;
	}    
	
	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
      
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	
	
	 $qry1=str_replace("\'", "'", $qry1);
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());


	for($i=0;$i<$recordcount;$i++)
	{
		if($row_result[$i]["City"]=="Others")
		{
			$City = $row_result[$i]["City_Other"];
		}
		else
		{
			$City = $row_result[$i]["City"];
		}
		$key = "abcdefghij";
		$BiddID = encrypt($row_result[$i]["BidID"], $key);
		
	//	$BiddID = decrypt($ecrypt, $key);
		
		$ReqID = encrypt($row_result[$i]["RequestID"], $key);
		
	
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]["Name"], 'dob'=>$City, 'email'=>$row_result[$i]["Mobile_Number"], 'emp_status'=>$BiddID, 'c_name'=>$ReqID);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);

		
	}
	
		$qry="select c_name as DonotChange, emp_status as DontChange, name as Name, dob as City, email as MobileNumber, card_limit as Feedback, ip_address as Comment from temp where session_id='".$session_id."' ";
	
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
