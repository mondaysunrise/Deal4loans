<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

main();
function main()
{
	getRequestidhl();
}

function getRequestidhl()
{
$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query="Select * from Req_Compaign Where Reply_Type='2' and Bank_Name='HSBC' and BidderID=2456";
	list($alreadyExist,$result1)=MainselectfuncNew($query,$array = array());
$result1contr=count($result1)-1;
	$requestid = $result1[$result1contr]["RequestID"];
	
	 
	If(($requestid)>0)
	{
		$search_query="SELECT Bidder_Count,Add_Comment,Feedback_ID,Name,Mobile_Number,Email,DOB,Employment_Status,Company_Name,City,City_Other,Pincode,Pincode,Net_Salary,Loan_Amount,Property_Identified,Property_Value,Property_Loc from Req_Feedback_Bidder1,Req_Loan_Home WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 2456 and Req_Feedback_Bidder1.Feedback_ID in (1258704,1256884,1256887,1257432,1257435,1258383,1258738,1258884,1258915,1258918,1260147,1261891,1261893,1260257,1260159,1260314,1260788,1260318,1263226,1260811,1261189,1261195,1261416,1263230,1261595,1263234,1263239,1263242,1263245,1263028,1263811) and Req_Feedback_Bidder1.Allocation_Date between '2012-09-01 00:00:00' and '2012-09-28 23:59:59')";

	}
	else
	{
		$search_query="SELECT Bidder_Count,Add_Comment,Feedback_ID,Name,Mobile_Number,Email,DOB,Employment_Status,Company_Name,City,City_Other,Pincode,Pincode,Net_Salary,Loan_Amount,Property_Identified,Property_Value,Property_Loc from Req_Feedback_Bidder1,Req_Loan_Home WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 2456 and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

	}
	//echo "hello1".$search_query."<br>";
	list($recorcount,$myrow)=MainselectfuncNew($sql,$array = array());
	
	
	$Dated = ExactServerdate();
	$dataInsert = array('hdfcstart_time'=>$Dated, 'hdfc_bidderid'=>'2456', 'hdfc_product'=>'2', 'run_date'=>$Dated, 'hdfc_leadcount'=>$recorcount);
	$table = 'hdfc_hlnlap_cronlog';
	$insert = Maininsertfunc ($table, $dataInsert);
for($i=0;$i<$recorcount;$i++)
	{
		
		$feedbackid =$myrow[$i]["Feedback_ID"];
		$Name= $myrow[$i]["Name"];
		$Phone= $myrow[$i]["Mobile_Number"];
		$Email= $myrow[$i]["Email"];
		$DOB= $myrow[$i]["DOB"];		
		$Employment_Status= $myrow[$i]["Employment_Status"];
		$Company_Name = $myrow[$i]["Company_Name"];
		$City= $myrow[$i]["City"];
		$City_Other= $myrow[$i]["City_Other"];
		$Pincode= $myrow[$i]["Pincode"];
		$Net_Salary= $myrow[$i]["Net_Salary"];
		$Loan_Amount= $myrow[$i]["Loan_Amount"];
		$Property_Identified= $myrow[$i]["Property_Identified"];
		$Property_Value= $myrow[$i]["Property_Value"];
		$Property_Loc= $myrow[$i]["Property_Loc"];
		$Add_Comment =  $myrow[$i]["Add_Comment"];
		$Bidder_Count =  $myrow[$i]["Bidder_Count"];

if($City=="Others" && strlen($City_Other)>0)
		{
			$strcity=$City_Other;
		}
		else
		{
			$strcity=$City;
		}

If(($recorcount)>0)
{
	//ExecQuery("update Req_Compaign set RequestID='".$feedbackid."' where (Reply_Type=2 and Bank_Name='HSBC' and BidderID=2456)");	
}

//SendHLLeadToHSBC("test", "9999047207", "test@d4l.com", "1980", "1", "WRS info india Pvt Ltd", "Delhi", "110092", "500000", "2000000", "1", "3000000", "Delhi" );

SendHLLeadToHSBC($Name, $Phone, $Email, $DOB, $Employment_Status, $Company_Name, $strcity, $Pincode, $Net_Salary, $Loan_Amount, $Property_Identified, $Property_Value, $Property_Loc, $Bidder_Count, $Add_Comment );	
	
	///IF ($redcordcount)
	}//WHILE LOOP

	if($recorcount>25)
	{
	$Content ="Total Leads pushed in : ".$recorcount;
	$Email="mehra3@gmail.com,ranjana@deal4loans.com";
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		//mail($Email,'HSBC HL report -Deal4loans', $Content, $headers);
	}

	
}//End of function

function SendHLLeadToHSBC($Name, $Phone, $Email, $DOB, $Employment_Status, $Company_Name, $strcity, $Pincode, $Net_Salary, $Loan_Amount, $Property_Identified, $Property_Value, $Property_Loc, $Bidder_Count, $Add_Comment)
{
	//$getDOB = str_replace("-","/", $DOB);
	list($year,$month,$day) = split('[-]', $DOB);
	$getDOB=$day."/".$month."/".$year;

	if($Employment_Status == "0")
	{
		$stroccupation="Self Employed";
	}
	else if($Employment_Status == "1")
	{
		$stroccupation="Salaried";
	}
	else
	{
		$stroccupation="Salaried";
	}
	if($Property_Identified == "0")
	{
		$strproperty="No";
	}
	else if($Property_Identified == "1")
	{
		$strproperty="Yes";
	}
	else
	{
		$strproperty="No";
	}
	if($Bidder_Count==1)
	{
		$leadtype="Exclusive";
	}
	else
	{
		$leadtype="Non-Exclusive";
	}
	//http://server1.iacampaigns.com/hsbc_deal4loans/lead_submit.php?fullname=test&mobile_number=9898989898&email=test@ia.com&dob=11/11/1983&employement_status=va&company_name=ia&city=mumbai&pincode=400101&annual_income=1234567&loan_ammount=12345&property_identified=yes&property_location=mumbai&property_value=1000000&source=deal4loans&lead_type=Exclusive&description=somedescriptivetext 
//http://server1.iacampaigns.com/hsbc_deal4loans/lead_submit.php?fullname=test&mobile_number=9898989898&email=test@ia.com&dob=11/11/1983&employement_status=va&company_name=ia&city=mumbai&pincode=400101&annual_income=1234567&loan_ammount=12345&property_identified=yes&property_location=mumbai&property_value=1000000&source=deal4loans


	$request = ""; //initialize the request variable
	 $param["fullname"] = $Name; 
	 $param["mobile_number"] = $Phone; 
	 $param["email"] = $Email; 
	 $param["dob"] = $getDOB; 
	 $param["employement_status"] = $stroccupation;
	 $param["company_name"] = $Company_Name;
	 $param["city"] = $strcity;
	 $param["pincode"] = $Pincode;
	 $param["annual_income"] = $Net_Salary;
	 $param["loan_ammount"] = $Loan_Amount;
	 $param["property_identified"] = $strproperty;
	 $param["property_location"] = $Property_Loc;
	 $param["property_value"] = $Property_Value;
	 $param["source"] = "deal4loans";
	 $param["lead_type"] = $leadtype;
	 $param["description"] = $Add_Comment;

	 
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "server1.iacampaigns.com";
	$script = "/hsbc_deal4loans/lead_submit.php";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
	if ($method == "GET") 
	{
	  $script .= "?$request";
	}

	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";

	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  fclose($socket); 
	} 
	print_r($output); 

	//$updtequery=ExecQuery("Update hdfc_hlnlap_cronlog set hdfc_leadcount='".count($posts)."',hdfcend_time=Now() Where hdfc_logid=".$instid);
}