<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$min_date=$_POST["min_date"];
	$max_date=$_POST["max_date"];
	
	if($min_date!="" and $max_date!="")
		{
			$min_date=$min_date." 00:00:00";
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(Telecaller_Mgmt_Entry.TME_Date)>='".strtotime($min_date)."' and UNIX_TIMESTAMP(Telecaller_Mgmt_Entry.TME_Date)<='".strtotime($max_date)."'";
		}
		else if($min_date!="" and $max_date=="")
		{
			$min_date=$min_date." 00:00:00";
			$search_date=$search_date." and UNIX_TIMESTAMP(Telecaller_Mgmt_Entry.TME_Date)>='".strtotime($min_date)."'";
		}
		else if($min_date=="" and $max_date!="")
		{
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(Telecaller_Mgmt_Entry.TME_Date)<='".strtotime($max_date)."'";
		}
		else
		{
			$search_date=$search_date." and Telecaller_Mgmt_Entry.TME_Date!=''";
		}
	
	$qry1 = "Select * from Telecaller_Mgmt_Entry where TME_Name!='' ".$search_date.""; 
	
	$qry1=str_replace("\'", "'", $qry1);
	
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
		$cntr=0;
		
	
	while($cntr<count($row_result))
        {
	
		$TME_Name = $row_result[$cntr]["TME_Name"];
		$TME_Mobile = $row_result[$cntr]["TME_Mobile"];
		$TME_Pancard = $row_result[$cntr]["TME_Pancard"];
		$TME_TCaller_Name  = $row_result[$cntr]["TME_TCaller_Name"];
		$TME_UniqueID = $row_result[$cntr]["TME_UniqueID"];
		$TME_Date = $row_result[$cntr]["TME_Date"];
		$TME_Source = $row_result[$cntr]["TME_Source"];
		$TMU_ID = $row_result[$cntr]["TMU_ID"];   	 
		
		$sqlEnteredBy = "Select * from Telecaller_Mgmt_User where TMU_ID=".$TMU_ID;
		 list($recordcount,$row_EnteredBy)=MainselectfuncNew($sqlEnteredBy,$array = array());
		$i=0;
		
		$TMU_Name = $row_EnteredBy[$i]["TMU_Name"];
		
		
		
		$dataInsert = array("session_id"=>$session_id , "name"=>$TME_Name , "mobile_number"=>$TME_Mobile , "email"=>$TME_Pancard , "c_name"=>$TME_TCaller_Name, "city"=>$TME_UniqueID , "doe"=>$TME_Date , "industry"=>$TME_Source , "residential_status"=>$TMU_Name);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
		
	$cntr =  $cntr+1;
	}
	
	$qry="select name as Name, mobile_number as MobileNumber, email as Pancard,  c_name as CallerName, city as BankUniqueID , industry as Source , doe as DateofEntry, residential_status as EnteredBy  from temp where session_id='".$session_id."'";
		
	
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
?>