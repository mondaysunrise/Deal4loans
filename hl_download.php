<?
	//include ("includes/check_login.php");
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	
	$qry1=str_replace("\'", "'", $qry1);
	
	//$search_result=ExecQuery($qry1);
	list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
		$cntr=0;
	
	while($cntr<count($row_result))
        {
		if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$cntr]["Property_Type"]==0) { $property_type="Commercial office space"; }
		 if($row_result[$cntr]["Property_Type"]==0) { $property_type="Commercial office Space"; } 
		if($row_result[$cntr]["Property_Type"]==1) { $property_type="Appartment"; }  if($row_result[$cntr]["Property_Type"]==2) { $property_type="Industrial House"; } if($row_result[$cntr]["Property_Type"]==3) { $property_type="Showroom"; }
		if($row_result[$cntr]["Property_Type"]==4) { $property_type="Factory"; }  if($row_result[$cntr]["Property_Type"]==5) { $property_type="Plot"; } if($row_result[$cntr]["Property_Type"]==6) { $property_type="Godown"; }
        if($row_result[$cntr]["Property_Type"]==7) { $property_type="Bungalow"; }
		if($row_result[$cntr]["Email"]=="")
		{
			$dob=$row_result[$cntr]["dob"];} else { $dob=$row_result[$cntr]["DOB"];}
	
	$dataInsert = array("session_id"=>$session_id, "name"=>$row_result[$cntr]["Name"], "dob"=>$dob, "email"=>$row_result[$cntr]["Email"], "emp_status"=>$emp_status, "c_name"=>$row_result[$cntr]["Company_Name"], "city"=>$row_result[$cntr]["City"], "city_other"=>$row_result[$cntr]["City_Other"], "pincode"=>$row_result[$cntr]["Pincode"], "total_exp"=>$row_result[$cntr]["Total_Experience"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"], "std_code"=>$row_result[$cntr]["Code"], "landline"=>$row_result[$cntr]["Land"], "std_code_o"=>$row_result[$cntr]["Std_Code_O"], "landline_o"=>$row_result[$cntr]["Landline_O"], "net_salary"=>$row_result[$cntr]["Net_Salary"], "descr"=>$row_result[$cntr]["Descr"], "property_type"=>$property_type, "property_value"=>$row_result[$cntr]["Property_Value"], "loan_amount"=>$row_result[$cntr]["Loan_Amount"], "Feedback"=>$row_result[$cntr]["Feedback"], "count_views"=>$row_result[$cntr]["Count_Views"], "count_replies"=>$row_result[$cntr]["Count_Replies"], "is_modified"=>$row_result[$cntr]["IsModified"], "is_processed"=>$row_result[$cntr]["IsProcessed"], "doe"=>$row_result[$cntr]["Dated"]);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);	
		
	$cntr=$cntr+1;}
	
	$qry="select name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, pincode, net_salary, descr, property_type, property_value, loan_amount, Feedback, doe from temp where session_id='".$session_id."'";
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
    list($count,$row)=MainselectfuncNew($qry,$array = array());

		$cnt=0;

	$field_names = getFieldNames($qry);
	
for ($i = 0; $i <count($field_names); $i++){
		$header .= $field_names[$i]."\t";
	}
	
	while($cnt<count($row))
        {
	  $line = '';
	  foreach($row[$cnt] as $value){
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
	  $cnt=$cnt+1;}
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
	$deleterowcount=Maindeletefunc($qry1,$array = array());
	//*/

?>
