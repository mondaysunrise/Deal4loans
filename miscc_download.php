<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

	function getSBIStatus($value)
	{
		if($value==1) { $SBIStatus= 'Processed Successfully (moved to Lead allocation Queue)'; }
		else if($value==2) { $SBIStatus= 'Processed Successfully (moved to Fulfillment Queue)'; }
		else if($value==3) { $SBIStatus= 'Completeness check failed (moved to Curing Queue)'; }
		else if($value==4) { $SBIStatus= 'Interface Error Occurred (moved to Error Technical Queue)'; }
		else if($value==5) { $SBIStatus= 'Interface Error Occurred (moved to Retry Queue)'; }
		else if($value==6) { $SBIStatus= 'Some Other Issue Occurred'; }
		else if($value==7) { $SBIStatus= 'Application is finally declined'; }
		else if($value==0) { $SBIStatus= $value; }
		return $SBIStatus;
	}



	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];	
	
	$qry1=str_replace("\'", "'", $qry1);	
	
    $rowQuery= ExecQuery($qry1);
	//echo "fff".$qry1."<br>";
	//$num_rows = mysql_num_rows($rowQuery);
	
	
	while($row_result= mysql_fetch_array($rowQuery)) {
		//RequestID, AgentID, Name, Mobile_Number, NetProfit, Annual_Turnover, Loan_Amount,City,City_Other, Vintage, Company_Type as TypeofCompany, Feedback, Followup_Date, Dated,Add_Comment as Comment
		$UserID= $row_result["UserID"];/*to download*/
		$RequestID = $row_result["RequestID"];/*to download*/
		$AgentID= $row_result["AgentID"];/*to download*/
                $RefID ="CC".$RequestID."S".$AgentID;/*to download*/
		$Name = $row_result["Name"];/*to download*/
		$Net_Salary= $row_result["Net_Salary"];/*to download*/
	
		$City= $row_result["City"];/*to download*/
		$City_Other= $row_result["City_Other"];/*to download*/
			
		$Feedback= $row_result["Feedback"];/*to download*/
		$Followup_Date= $row_result["Followup_Date"];/*to download*/
		$Comment= $row_result["comment_section"];/*to download*/
		
		
//		sbi_credit_card_5633 [SBI CC Tbl]
		$SBIApplicationNumber='';
		$SBIProcessingStatus='';
		$SBIMessages= '';
		$SBImessage= '';
		$cc_alldetailsqry = ExecQuery("select * from sbi_credit_card_5633_log Where (cc_requestid=".$UserID.") group by cc_requestid order by first_dated DESC");
		$ccNum = mysql_num_rows($cc_alldetailsqry);
		if($ccNum>0)
		{
		
			$ccal=mysql_fetch_array($cc_alldetailsqry); 
	 		$SBIApplicationNumber= $ccal["ApplicationNumber"];/*to download*/
			$SBIProcessingStatus= getSBIStatus($ccal["ProcessingStatus"]); /*to download*/
			$SBIMessages= $ccal["Messages"];/*to download*/
			$SBImessage= $ccal["message"]; /*to download*/
		}
		else
		{
			$SBIApplicationNumber='';
			$SBIProcessingStatus='';
			$SBIMessages= '';
			$SBImessage= '';
		}
		
		$scbSql = "select * from credit_card_banks_apply where cc_requestid='".$UserID."' and applied_bankname='Standard Chartered'";
		$scbQuery = ExecQuery($scbSql);
		$scbNum = mysql_num_rows($scbQuery);
		$scbResponse= '';
		if($scbNum>0)
		{
			$scb=mysql_fetch_array($scbQuery); 
	 		$scbResponse= $scb["response_data"];/*to download*/
	 	}
	 	else
	 	{
	 		$scbResponse= '';/*to download*/
	 	}
		//credit_card_banks_apply [SCB] Standard Chartered

		$amexSql = "select * from credit_card_banks_apply where cc_requestid='".$UserID."' and applied_bankname='American Express'";
		$amexQuery = ExecQuery($amexSql);
		$amexNum = mysql_num_rows($amexQuery);
		$amexResponse= '';
		$amexStatus = '';
		$amexerrorResponse = '';
		if($amexNum>0)
		{
			$amex=mysql_fetch_array($amexQuery); 
	 		$amexResponse= $amex["response_data"];
	 	
	 	
		 	$amexResponse= str_replace('<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><submitApplicationResponse xmlns="http://tempuri.org/">', '', $amexResponse);

			$amexResponse= str_replace('</submitApplicationResponse></soap:Body></soap:Envelope>', '', $amexResponse);
			
			$xml = new SimpleXMLElement($amexResponse);
			
			$amexStatus = $xml->status->success;/*to download*/

			if($amex=="false")
			{
				$amexerrorResponse = $xml->objFailureResponse->validationError->errorDesc;/*to download*/
			}
	}

		//credit_card_banks_apply [Amex] American Express
	
//	16
		

		$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, car_make, car_model, car_type, loan_tenure, property_type, property_value, year_in_comp, total_exp, mobile_number , std_code, landline) values ('".$session_id."', '".$RequestID."', '".$AgentID."', '".$Name."', '".$Net_Salary."', '".$City."', '".$City_Other."', '".$Feedback."', '".$Followup_Date."', '".$Comment."', '".$SBIApplicationNumber."', '".$SBIProcessingStatus."', '".$SBIMessages."', '".$SBImessage."', '".$scbResponse."', '".$amexStatus."', '".$amexerrorResponse."', '".$UserID."', '".$RefID."')";
		ExecQuery($qry1);
//		echo $qry1;
//		echo "<br>";		
	
	  }
		// std_code as UserID,  
	$qry="select landline AS ReferenceID, name as RequestID, dob as AgentID, email as Name, emp_status as NetSalary, c_name as City, city as OtherCity , city_other as Feedback, car_make as FollowupDate, car_model as Comment, car_type as SBIApplicationNumber, loan_tenure as SBIStatus, property_type as SBIMsg, property_value as SBIMessage, year_in_comp as SCBResponse, total_exp as AmexStatus, mobile_number as AmexResponse from temp where session_id='".$session_id."' order by doe DESC ";
$header="";
//echo $qry."<br>";
	$data="";
$result = ExecQuery($qry);	
	$count = mysql_num_fields($result);
//	die();
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
//	$qry1="delete from `temp` where session_id='7gesspepnu7b2th0idsc5l1gj3'";

?>
