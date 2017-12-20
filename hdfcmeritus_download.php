<?
	//include ("includes/check_login.php");
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	
	$qry1=str_replace("\'", "'", $qry1);
	
	
	list($recordcount,$getrow)=MainselectfuncNew($qry1,$array = array());
	$cntr=0;
	while($cntr<count($row_result))
        {
			list($date,$time) = split('[ ]', $row_result[$cntr]["Date_Of_Entry"]);
				
		$dataInsert = array("session_id"=>$session_id , "name"=>$row_result[$cntr]["Student_Name"], "dob"=>$row_result[$cntr]["DOB"] , "c_name"=>$row_result[$cntr]["Father_Name"], "city"=>$row_result[$cntr]["City"], "mobile_number"=>$row_result[$cntr]["Mobile_No"], "ip_address"=>$row_result[$cntr]["Student_Class"] , "descr"=>$row_result[$cntr]["Student_Class"], "doe"=>$Dated);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
	}
	
	$qry="select  name As StudentName, c_name As FatherName,descr As StudentClass, dob As StudentDOB ,  city, mobile_number As MobileNo,doe As DateOfEntry from temp where session_id='".$session_id."'";
	
	
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
Maindeletefunc($qry1,$array = array());	//*/

?>
