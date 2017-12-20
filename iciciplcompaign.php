<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

function getRequestidpl()
{

	$query="Select * from Req_Compaign Where Reply_Type='1' and Bank_Name='icicicompaign' and BidderID=873";
	 list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
		$cntr=0;
	
	while($cntr<count($row1))
        {
        
	 $requestid= $row1[$cntr]["RequestID"];
	 $cntr=$cntr+1;
	 }
	 
	If((strlen(trim($requestid))<=0))
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 873 and (Req_Feedback_Bidder1.Allocation_Date >='2008-07-07 00:00:00' ) ORDER BY `Feedback_ID` ASC ";
	
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 873 and (Req_Feedback_Bidder1.Feedback_ID>'$requestid' and (Req_Feedback_Bidder1.Allocation_Date >='2008-07-07 00:00:00' )) ORDER BY `Feedback_ID` ASC ";
	}
	echo "hello1".$search_query."<br>";
	 list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());
	
	$i = 0;
	//$result = ExecQuery($search_query);
	//$recorcount = mysql_num_rows($result);

	while($i<count($row))
        {
		$request =$row[$i]["Feedback_ID"];
		//$request= $row["AllRequestID"];
		$Name= $row[$i]["Name"];
		list($first_name,$last_name) = split(' ', $Name);
		$tel_m= $row[$i]["Mobile_Number"];
		if(strlen($row[$i]["Landline"])>0)
		{
			$tel_r= $row[$i]["Landline"];
		}
		else
		{
		 $tel_r= $row[$i]["Landline_O"];
		}
		$DOB= $row[$i]["DOB"];
		list($year,$mm,$dd) = split('[/.-]', $DOB);
		$email= $row[$i]["Email"];
		$city= $row[$i]["City"];
		$occupation= $row[$i]["Employment_Status"];
		$income= $row[$i]["Net_Salary"];
		$company= $row[$i]["Company_Name"];
		
//echo $request."<br>";
//If(($recorcount)>0)
	//{ 
	
	   $DataArray = array("RequestID"=>$request);
		$wherecondition ="Reply_Type='1' and Bank_Name='icicicompaign' and BidderID=873";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
        
	
	//}
	SendPLLeadToICICICompaign($first_name, $last_name, $dd, $mm, $year, $tel_m, $tel_r, $email, $city,  $occupation, $income, $company);	
	
	///IF ($redcordcount)
	$i = $i +1;}//WHILE LOOP
}



function SendPLLeadToICICICompaign($first_name, $last_name, $dd, $mm, $year, $tel_m, $tel_r, $email, $city,  $occupation, $income, $company)
{

	if(is_numeric($income))
	{
		$monthlyincome = $income/12;

		if($monthlyincome < 8000)
		{
			$incomeslab = "&lt;  8,000";
		}
		else if($monthlyincome >= 8000 && $monthlyincome < 10000)
		{
			$incomeslab = "8,000 - 10,000";	
		}
		else if($monthlyincome >= 10000 && $monthlyincome < 15000)
		{
			$incomeslab = "10,000 - 15,000";	
		}
		else if($monthlyincome >= 15000 && $monthlyincome < 25000)
		{
			$incomeslab = "15,000 - 25,000";	
		}
		else if($monthlyincome >= 25000 && $monthlyincome < 50000)
		{
			$incomeslab = "25,000 - 50,000";	
		}
		else
		{
			$incomeslab = "&gt;  50,000";	
		}
	}
	else
	{
		$incomeslab = $income;
	}

	if($occupation == "0")
	{
		$stroccupation="Self employed";
	}
	else if($occupation == "1")
	{
		$stroccupation="Salaried";
	}
	else
	{
		$stroccupation="Others";
	}

	$request = ""; //initialize the request variable
	$param["first_name"] = $first_name; 
	$param["last_name"] = $last_name; 
	$param["dd"] = $dd; 
	$param["mm"] = $mm; 
	$param["year"] = $year;
	$param["tel_m"] = $tel_m;
	$param["tel_r"] = $tel_r;
	$param["email"] = $email;
	$param["city"] = $city;
	$param["place_opt"] = "yes";
	$param["occupation"] = $stroccupation;
	$param["income"] = $incomeslab;
	$param["company"] = $company;

	$param["refsite"] = "deal4loans";
	$param["adunit"] = "400x400";
	$param["channel"] = "channel";
	$param["campaign"] = "campaign";


	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "65.111.165.214";
	$script = "/icici/new_easy/lead_submit_new.php";
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
}

main();

Function main()
{
    getRequestidpl();
	
}
?>