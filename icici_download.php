<?
	//include ("includes/check_login.php");
	require 'scripts/db_init.php';
	//require 'scripts/db_init-main.php';
	require 'scripts/functions.php';
	session_start();
	$session_id=session_id();
	//echo "<br>";
	$qry1=$_POST["qry1"];
	$mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	$Dated = ExactServerdate();
	
	$qy1=str_replace("\'", "'", $qry1);
	
	
	//echo $qry1;
	//exit();
		list($recordcount,$row)=MainselectfuncNew($qry1,$array = array());

	for($i=0;$i<$recordcount;$i++)
		{
	
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row[$i]['clientld_name'], 'email'=>$row[$i]['clientld_email'], 'city'=>$row[$i]['clientld_city'], 'mobile_number'=>$row[$i]['clientld_mobile'], 'doe'=>$row[$i]['clientld_date']);
			$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	

		}
	
	  $qry="select name as Name, email AS Email, city as City, mobile_number as MobileNumber, doe AS DOE from temp where session_id='".$session_id."'";

	//echo $qry;
	//exit();	
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
	
	//exit();
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