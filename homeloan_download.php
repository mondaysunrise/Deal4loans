<?
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	
	$qry1=$_POST["qry1"];
	
	$qry1=str_replace("\'", "'", $qry1);
	
	$search_result=ExecQuery($qry1);
	
	while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["Property_Type"]==0) { $property_type="Commercial office space"; }
		if($row_result["Property_Type"]==1) { $property_type="Appartment"; }  if($row_result["Property_Type"]==2) { $property_type="Industrial House"; } if($row_result["Property_Type"]==3) { $property_type="Showroom"; }
		if($row_result["Property_Type"]==4) { $property_type="Factory"; }  if($row_result["Property_Type"]==5) { $property_type="Plot"; } if($row_result["Property_Type"]==6) { $property_type="Godown"; }
        if($row_result["Property_Type"]==7) { $property_type="Bungalow"; }
		if($row_result["Property_Identified"]==1) { $property_identified="yes"; } else { $property_identified="no"; }
		
$BidderID="";
	
	$BiddersChurn="SELECT Bidder_Name,Req_Feedback_Bidder1.BidderID As bid FROM Req_Feedback_Bidder1 LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder1.BidderID and Bidders_List.Reply_Type =2 WHERE (AllRequestID = '".$row_result["RequestID"]."' AND Req_Feedback_Bidder1.Reply_Type =2)";
	//echo $BiddersChurn;
	$BiddersChurnSql = ExecQuery($BiddersChurn);
	$NumRowBiddersChurnSql = mysql_num_rows($BiddersChurnSql);
	while($newrow=mysql_fetch_array($BiddersChurnSql))
	{
		$BidderID[]=$newrow["Bidder_Name"]."(".$newrow["bid"].")";
		//print_r($BidderID);
	}

	$getCallStatusNum='';
	$getCallStatus='';
  	$getCallStatusSql = "select Disposition  from Req_Dialler_Report where RequestID='".$row_result["RequestID"]."' AND Disposition in ('CONNECTED','NOTCONNECTED','BUSY')";
	$getCallStatusQuery = ExecQuery($getCallStatusSql);
	$getCallStatusNum = mysql_num_rows($getCallStatusQuery);
	if($getCallStatusNum>0) { $getCallStatus="Y";	} else { $getCallStatus="N"; }
	      
  	$getCallSql = "select  DAY(date_created) as datedCall, count(*) as countleadsCall from Req_Dialler_Report where RequestID='".$row_result["RequestID"]."' group by datedCall";
	$getCallQuery = ExecQuery($getCallSql);
	$getCallNum = mysql_num_rows($getCallQuery);	
	$getCallDaysStr = '';
	$getCallDays='';

	if($getCallNum>0)
	{
		$getCallDaysStr = '';
		$getCallDays='';
		for($ii=0;$ii<$getCallNum;$ii++)
		{
			$datedCall= mysql_result($getCallQuery,$ii,'datedCall');
			$countleadsCall = mysql_result($getCallQuery,$ii,'countleadsCall');
			$getCallDays[]=$datedCall." [".$countleadsCall."]";
		}
		$getCallDaysStr = implode(' - ', $getCallDays);
  	}
	
	$descr=implode(',', $BidderID);

$dob_loan=$row_result["dob"];
		if(strlen($dob_loan)>0)
		{
			$dob=$dob_loan;} else { $dob=$row_result["DOB"];}
		$qry1="insert into temp (session_id, name, dob, mobile_number, email, emp_status, c_name, city, city_other, total_exp, net_salary,  property_type, property_value, loan_amount, pincode, source, count_views, is_modified, is_processed, residence_address, budget, property_identified, property_loc, doe, count_replies, bidderid,Feedback,descr,docs,address_apt, feedback_1) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Mobile_Number"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Total_Experience"]."', '".$row_result["Net_Salary"]."', '".$property_type."', '".$row_result["Property_Value"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."', '".$row_result["source"]."', '".$row_result["Count_Views"]."','".$row_result["IsModified"]."', '".$row_result["IsProcessed"]."', '".$row_result["Residence_Address"]."', '".$row_result["Budget"]."', '".$property_identified."', '".$row_result["Property_Loc"]."', '".$row_result["Updated_Date"]."', '".$row_result["Bidder_Count"]."','".$row_result["Bidderid_Details"]."','".$row_result["Feedback"]."','".$descr."','".$row_result["Caller_Name"]."', '".$getCallStatus."', '".$getCallDaysStr."')";
			$result1=ExecQuery($qry1);
		}
	
	$qry="select name, dob, mobile_number AS mobile,email AS email, emp_status, c_name, city, city_other, net_salary, descr, property_type, property_value, loan_amount, pincode, source, residence_address, budget, property_identified, property_loc, doe, count_replies AS BidderCount,bidderid,Feedback,descr AS BiddersGone,docs AS CallerName, address_apt as CallStatus, feedback_1 as CallDetails from temp where session_id='".$session_id."'";
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
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
