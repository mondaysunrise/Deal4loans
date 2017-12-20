<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];	
	
	$qry1=str_replace("\'", "'", $qry1);	
	$qry=$qry1;
      
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$result = ExecQuery($qry);
	//echo "fff".$qry."<br>";
	$num_rows = mysql_num_rows($result);
	
	$count = mysql_num_fields($result);
	
	while($row_result = mysql_fetch_array($result)){
	
	$RequestID= $row_result["RequestID"];/*to download*/
	$AgentID= $row_result["sentbidder"];/*to download*/
	
	$Feedback= $row_result["Feedback"];/*to download*/
	$Followup_Date= $row_result["Followup_Date"];/*to download*/
	$Dated= $row_result["Dated"];/*to download*/
	$Comments= $row_result["Comments"];/*to download*/	
	
		  
	$sqlExtraFields = "select cibil_reference_id from Req_Loan_Personal_Extra_Fields where RequestID='".$RequestID."'";
	$queryExtraFields = ExecQuery($sqlExtraFields);
	$numRowsExtraFields = mysql_num_rows($queryExtraFields);

	$sqlRefID = "select BidderID as AgID, Feedback_ID as FeedID from client_lead_allocate where AllRequestID='".$RequestID."' and BidderID='".$AgentID."'";
	$queryRefID = ExecQuery($sqlRefID);
	$numRowsRefID = mysql_num_rows($queryRefID);
	$AgID = mysql_result($queryRefID,0,'AgID');
	$FeedID= mysql_result($queryRefID,0,'FeedID');
	$RefID = "PL".$FeedID."S".$AgID;
	

	  $line = '';
	  
	$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city) values ('".$session_id."', '".$RefID."', '".$AgentID."', '".$Feedback."', '".$Followup_Date."', '".$Dated."', '".$Comments."')";
		ExecQuery($qry1);
	}
	//
	$qry="select name as ReferenceID,dob as AgentID, email as Feedback, emp_status as FollowupDate, c_name as LeadDate, city as Comments from temp where session_id='".$session_id."' order by doe DESC ";
$header="";
	$data="";
$result = ExecQuery($qry);	
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
	}

	
	
while($row = mysql_fetch_row($result)){
	  $line = '';
	  foreach($row as $value){
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
	$result1 = ExecQuery($qry1);
	//*/
?>
