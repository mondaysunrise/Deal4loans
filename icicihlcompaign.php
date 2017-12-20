<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

function getRequestidhl()
{

	$query="Select * from Req_Compaign Where Reply_Type='2' and Bank_Name='icicicompaign' and BidderID=956";
	 list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
		$cntr=0;
	
	while($cntr<count($row1))
        {
	 $requestid= $row1[$cntr]["RequestID"];
	 $cntr=$cntr+1;}
	 
	If((strlen(trim($requestid))<=0))
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 956 and (Req_Feedback_Bidder1.Allocation_Date >='2008-11-30 00:00:00' ) ORDER BY `Feedback_ID` ASC ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home  WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 956 and (Req_Feedback_Bidder1.Feedback_ID>'$requestid' and (Req_Feedback_Bidder1.Allocation_Date >='2008-11-30 00:00:00' )) ORDER BY `Feedback_ID` ASC ";
	}
	echo "hello1".$search_query."<br>";
	 list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());
	
	$i = 0;
	
	//$recorcount = mysql_num_rows($result);

	while($i<count($row))
        {
		$request =$row[$i]["Feedback_ID"];
		
		$Name= $row[$i]["Name"];
		//list($first_name,$last_name) = split(' ', $Name);
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
		$city= $row[$i]["City"];
		$Pincode= $row[$i]["Pincode"];
		$occupation= $row[$i]["Employment_Status"];
		$income= $row[$i]["Net_Salary"];
		$budget= $row[$i]["Budget"];
		


	$DataArray = array("RequestID"=>$request);
	$wherecondition ="Reply_Type='2' and Bank_Name='icicicompaign' and BidderID=956";
	Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	//}
	SendHLLeadToICICICompaign($Name, $DOB, $tel_m, $tel_r, $Pincode, $city, $occupation, $income, $budget);	
	$i = $i +1;
	///IF ($redcordcount)
	}//WHILE LOOP
}



function SendHLLeadToICICICompaign($Name, $DOB, $tel_m, $tel_r,$Pincode, $city,  $occupation, $income, $budget)
{

	if(is_numeric($income))
	{
		$monthlyincome = $income/12;
		if($monthlyincome <= 10000)
		{
			$incomeslab = "7001-10000";
		}
		else if($monthlyincome > 10000 && $monthlyincome <= 15000)
		{
			$incomeslab = "10001-15000";	
		}
		else if($monthlyincome > 15000 && $monthlyincome <= 25000)
		{
			$incomeslab = "15001-25000";	
		}
		else if($monthlyincome > 25000 && $monthlyincome <= 40000)
		{
			$incomeslab = "25001-40000";	
		}
		else if($monthlyincome > 40000 )
		{
			$incomeslab = "40000+";	
		}
		else
		{
			$incomeslab = "40000+";	
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
		$stroccupation="Salaried";
	}

 $age= date('Y')-substr($DOB,0,4); 
 if(is_numeric($age))
	{
		if($age >= 24 && $age <= 45)
		{
			$ageslab = "Between 24 and 45";	
		}
		
		else
		{
			$ageslab = "Between 24 and 45";	
		}
	}
	else
	{
		$ageslab = $age;
	}

if($city=="Noida" || $city=="Delhi")
	{
	$getcity="Delhi &amp; NCR";
	}
	elseif($city=="Gaziabad")
	{	
		$getcity="Ghaziabad";
	}
	elseif($city=="Nasik")
	{
		$getcity="Nashik";
	}
	else
	{
		$getcity=$city;
	}

	$request = ""; //initialize the request variable
	$param["home_finance"]= "home_finance";
	$param["name"] = $Name; 
	$param["age"] = $ageslab; 
	$param["tel_m"] = $tel_m;
	$param["tel_r"] = $tel_r;
	$param["pincode"] = $Pincode;
	$param["city"] = $getcity;
	$param["occupation"] = $stroccupation;
	$param["income"] = $incomeslab;
	$param["budget"] = $budget;
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
	$script = "/icici_hl/homeloan_submit.php";
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
	print_r($param);
}

main();

Function main()
{
    getRequestidhl();
	
}
?>