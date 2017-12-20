<?php 
require_once("includes/application-top-inner.php");

$session_id=session_id();
$setExcelName = "Download_Excel";

$qry1=$_POST["qry1"];
$qry2=$_POST["qry2"];
$search_result = $obj->fun_db_query($qry1);
$exclusiveLead = '';
while($row_result = $obj->fun_db_fetch_rs_object($search_result))
	{
	
	$qryFeedBack="select AllRequestID, BidderID, Feedback, comment_section from Req_Feedback_PL where AllRequestID='".$row_result->AllRequestID."' AND BidderID='".$row_result->BidderID."'";
	$resultFeedBack = $obj->fun_db_query($qryFeedBack);
	$rowFeedBack = $obj->fun_db_fetch_rs_object($resultFeedBack);
	if($row_result->CC_Holder==1)
		{
			$CC_Holder = 'Yes';
		}
	else{
			$CC_Holder = 'No';
		}
	if($row_result->Card_Vintage==1)	{	$card_vintage="Less than 6 months";}
		elseif($row_result->Card_Vintage==2){$card_vintage="6 to 9 months";}
		elseif($row_result->Card_Vintage==3){$card_vintage="9 to 12 months";}
		elseif($row_result->Card_Vintage==4){$card_vintage="more than 12 months";}
		else
		{
			$card_vintage="";
		}
		$QuryRFBPL = "SELECT BidderID FROM Req_Feedback_Bidder_PL WHERE (Req_Feedback_Bidder_PL.BidderID in (1029,4667,4641,4641,1546,1221,4658,5966,4642,5915,1223,1480,1096,1343,1857,1204,5917,4643,1125,5690,1162,1339,4666,5106,5429,1025,4665,1167,4644,1163,1342,1871,4645,1284,1295,5938,1294,5379,1215,5992,5661,1351,1338,4770,1365,1515,5918) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.AllRequestID ='".$row_result->RequestID."')";
		$getBidderresult = $obj->fun_db_query($QuryRFBPL);
		$Bidderrow = $obj->fun_db_fetch_rs_object($getBidderresult);
		$qryInsert="insert into temp (session_id, name, email, c_name, city, city_other, mobile_number, total_exp, net_salary, loan_amount, dob, pincode, cc_holder, card_vintage, Feedback,  add_comment, bidderid) values ('".$session_id."', '".$row_result->Name."', '".$row_result->Email."', '".$row_result->Company_Name."', '".$row_result->City."', '".$row_result->City_Other."', '".$row_result->Mobile_Number."', '".$row_result->Total_Experience."', '".$row_result->Net_Salary."', '".$row_result->Loan_Amount."', '".$row_result->DOB."', '".$row_result->Pincode."', '".$CC_Holder."', '".$card_vintage."', '".$rowFeedBack->Feedback."', '".$rowFeedBack->comment_section."', '".$Bidderrow->BidderID."')";
$result1=$obj->fun_db_query($qryInsert);
}

$qry="select name AS Name, email AS Email, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS MobileNumber, total_exp AS TotalExp, net_salary AS NetSalary, loan_amount AS LoanAmount, dob AS DOB, pincode AS Pincode, cc_holder AS CCHolder, card_vintage AS CardVintage, Feedback AS Feedback, add_comment AS Comment, bidderid AS BidderID from temp where session_id='".$session_id."' order by doe DESC";

$result = $obj->fun_db_query($qry);
$count = mysql_num_fields($result);
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
	}
	
	while($row = $obj->fun_db_fetch_rs_object($result)){
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
	header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $header."\n".$data;	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	$result1 = $obj->fun_db_query($qry1);

?>