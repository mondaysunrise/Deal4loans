<?
	//include ("includes/check_login.php");
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	
	$qry1=str_replace("\'", "'", $qry1);
	
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
		$cntr=0;
			
	while($cntr<count($row_result))
        {
		$Name = $row_result[$cntr]["Name"];
		$City = $row_result[$cntr]["City"];
		$Phone = $row_result[$cntr]["Phone"];
		$Email = $row_result[$cntr]["Email"];
		$portfolio = $row_result[$cntr]["portfolio"];
		$Loan_Amount = $row_result[$cntr]["Loan_Amount"];
		$IP = $row_result[$cntr]["IP"];
		$Dated = $row_result[$cntr]["Dated"];
			
		
		$dataInsert = array("session_id"=>$session_id, "name"=>$row_result[$cntr]["Name"], "city"=>$row_result[$cntr]["City"], "city_other"=>$Phone, "net_salary"=>$row_result[$cntr]["Email"], "doe"=>$row_result[$cntr]["Dated"], "bank_name"=>$row_result[$cntr]["IP"], "property_type "=>$portfolio, "gender"=>$Loan_Amount);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
	$cntr=$cntr+1;
	}
	//echo "ee".$qry1;
	$qry="select name as Name, city as City, city_other as Phone, net_salary as Email, gender as LoanAmount, property_type  as Portfolio ,  bank_name as IP, doe as DateodEntry from temp where session_id='".$session_id."'";
		//echo $qry; exit();
	
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
		} else {
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
//	echo $data;
//	exit();
	
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
