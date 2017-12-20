<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';


function getRequestidhl()
{
	//echo "hl";
	$query="Select * from Req_Compaign Where Reply_Type='2' and Bank_Name='icici' and BidderID=9992";
	
	 list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
		$cntr=0;

	while($cntr<count($row1))
        {
        	 $requestid= $row1[$cntr]["RequestID"];
	 		$cntr=$cntr+1;
		}
	 //echo "hello".$requestid;
	If((strlen(trim($requestid))<=0))
	{
		$search_query="SELECT * FROM Req_Loan_Home WHERE (Dated >='2008-01-08 17:00:00')";


	}
	else
	{
		$search_query="SELECT * FROM Req_Loan_Home WHERE RequestID>'$requestid' and (Dated >='2008-01-08 17:00:00')";
	}
	//echo "hello1".$search_query."<br>";
	 list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());
		$i=0;

while($i<count($row))
        {
		$feedbackid =$row[$i]["Feedback_ID"];
		$request= $row[$i]["RequestID"];
		$Name= $row[$i]["Name"];
		$Phone= $row[$i]["Mobile_Number"];
		$Phone1= $row[$i]["Landline"];
		$DOB= $row[$i]["DOB"];
		$Email= $row[$i]["Email"];
		$City= $row[$i]["City"];
		$City_Other= $row[$i]["City_Other"];
		$Employment_Status= $row[$i]["Employment_Status"];
		$Net_Salary= $row[$i]["Net_Salary"];
		$Residence_Address= $row[$i]["Residence_Address"];
		$Pincode= $row[$i]["Pincode"];
		$Loan_Amount= $row[$i]["Loan_Amount"];
		$Property_Identified= $row[$i]["Property_Identified"];
		$Budget= $row[$i]["Budget"];

If(($recorcount)>0)
	{
		$DataArray = array("RequestID"=>$feedbackid);
		$wherecondition ="( Reply_Type='2' and Bank_Name='icici' and BidderID=9992)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

		SendHLLeadToICICI( $Name, $DOB, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Residence_Address, $Pincode, $Loan_Amount, $Property_Identified, $Budget);	
	}
	 $i=$i+1;}
}


function getRequestidlap()
{
	//cho "lap";
	$query="Select * from Req_Compaign Where Reply_Type='5' and Bank_Name='icici' and BidderID=9995";

	 list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
		$cntr=0;
	
	//echo "hello2".$query."<br>";
	while($cntr<count($row1))
        {
	 $requestid= $row1[$cntr]["RequestID"];
 	$cntr=$cntr+1;
	}
	//echo "hello".$requestid;
	If((strlen(trim($requestid))<=0))
	{
	$search_query="Select * from Req_Loan_Against_Property where (Dated >='2007-07-24 00:00:00')";
	}
	else
	{
		
	$search_query="Select * from Req_Loan_Against_Property where RequestID>'$requestid' and (Dated>= '2007-07-24 00:00:00') ";
	}

 list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());
		$i=0;
		
	
while($i<count($row))
        {
		$request= $row[$i]["RequestID"];
		$Name= $row[$i]["Name"];
		$Phone= $row[$i]["Mobile_Number"];
		$Phone1= $row[$i]["Landline"];
		$DOB= $row[$i]["DOB"];
		$Email= $row[$i]["Email"];
		$City= $row[$i]["City"];
		$City_Other= $row[$i]["City_Other"];
		$Employment_Status= $row[$i]["Employment_Status"];
		$Net_Salary= $row[$i]["Net_Salary"];
		$Residence_Address= $row[$i]["Residence_Address"];
		$Pincode= $row[$i]["Pincode"];
		$Loan_Amount= $row[$i]["Loan_Amount"];
			
		$DataArray = array("RequestID"=>$request);
		$wherecondition ="( Reply_Type='5' and Bank_Name='icici' and BidderID=9995)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

	 SendLAPLeadToICICI($Name, $DOB, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Residence_Address, $Pincode, $Loan_Amount);		

	 $i=$i+1;}
}



function SendHLLeadToICICI($name, $dob, $mobile, $res_phone, $email, $city, $other_city, $occupation, $income, $address, $pincode, $loan, $property, $budget)
{
	 $age= date('Y')-substr($dob,0,4); 
 if(is_numeric($age))
	{
		if($age < 21)
		{
			$ageslab = "Less than 21";
		}
		else if($age >= 21 && $age < 24)
		{
			$ageslab = "21-24";	
		}
		else if($age >= 24  && $age < 34)
		{
			$ageslab = "25-34";	
		}
		else if($age >= 34  && $age < 44 )
		{
			$ageslab = "35-44";	
		}
		else
		{
			$ageslab = "45+";	
		}
	}
	else
	{
		$ageslab = $age;
	}
	
	if(is_numeric($income))
	{
		$monthlyincome = $income/12;

		
		if($monthlyincome >= 10000 && $monthlyincome < 15000)
		{
			$incomeslab = "10001-15000";	
		}
		else if($monthlyincome >= 15000 && $monthlyincome < 25000)
		{
			$incomeslab = "15001-25000";	
		}
		else if($monthlyincome >= 25000 && $monthlyincome < 40000)
		{
			$incomeslab = "25001-40000";	
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
		$stroccupation="Self Employed";
	}
	else if($occupation == "1")
	{
		$stroccupation="Salaried";
	}
	else
	{
		$stroccupation="Salaried";
	}
	if($property == "0")
	{
		$strproperty="No";
	}
	else if($property == "1")
	{
		$strproperty="Yes";
	}
	else
	{
		$strproperty="No";
	}
	
	if(is_numeric($loan))
	{
	
		if($loan < 500000)
		{
			$loanslab = "0 to 5 Lakhs";
		}
		else if($loan >= 500000 && $loan < 1000000)
		{
			$loanslab = "5 to 10 Lakh";	
		}
		else if($loan >= 1000000 && $loan < 1500000)
		{
			$loanslab = "10 to 15 Lakhs";	
		}
		else if($loan >= 1500000 && $loan < 2000000)
		{
			$loanslab = "15 to 20 Lakhs";	
		}
		else
		{
			$loanslab = "20+ Lakhs";	
		}
	}
	else
	{
		$loanslab = $loan;
	}
	
	$request = ""; //initialize the request variable
	 $param["first_name"] = $name; 
	 $param["age"] = $ageslab; 
	 $param["address"] = $address; 
	 $param["pincode"] = $pincode; 
	 $param["loan"] = $loanslab;
	 $param["res_phone"] = $res_phone;
	 $param["email"] = $email;
	 $param["mobile"] = $mobile;
	 $param["property"] = $strproperty;
	 $param["city"] = strtolower($city);
	 $param["othercity"] = strtolower($other_city);
	 $param["occupation"] = $stroccupation;
	 $param["income"] = $incomeslab;
	 $param["budget"] = $budget;
	 $param["refsite"] = "deal4loans";
	 $param["adunit"] = "text";
	 $param["channel"] = "testchannel";
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
	//print_r($output); 
}



//////////////////////////////////////////////////////////////////LAP/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
 function SendLAPLeadToICICI($name, $dob, $mobile, $res_tel, $email, $city, $other_city, $occupation, $income, $address, $pincode, $loan)
{
	 $age= date('Y')-substr($dob,0,4); 
	 if(is_numeric($age))
	{
		if($age < 21)
		{
			$ageslab = "Less than 21";
		}
		else if($age >= 21 && $age < 24)
		{
			$ageslab = "21-24";	
		}
		else if($age >= 24  && $age < 34)
		{
			$ageslab = "25-34";	
		}
		else if($age >= 34  && $age < 44 )
		{
			$ageslab = "35-44";	
		}
		else
		{
			$ageslab = "45+";	
		}
	}
	else
	{
		$ageslab = $age;
	}
	
	if(is_numeric($income))
	{
		$monthlyincome = $income/12;

		if($monthlyincome < 7000)
		{
			$incomeslab = "Less than 7000";
		}
		else if($monthlyincome >= 7000 && $monthlyincome < 10000)
		{
			$incomeslab = "7001-10000";	
		}
		else if($monthlyincome >= 10000 && $monthlyincome < 15000)
		{
			$incomeslab = "10001-15000";	
		}
		else if($monthlyincome >= 15000 && $monthlyincome < 25000)
		{
			$incomeslab = "15001 - 25000";	
		}
		else if($monthlyincome >= 25000 && $monthlyincome < 40000)
		{
			$incomeslab = "25001 - 40000";	
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
		$stroccupation="Self Employed";
	}
	else if($occupation == "1")
	{
		$stroccupation="Salaried";
	}
	else
	{
		$stroccupation="Salaried";
	}
	if(is_numeric($loan))
	{
	
		if($loan < 500000)
		{
			$loanslab = "0 to 5 Lakhs";
		}
		else if($loan >= 500000 && $loan < 1000000)
		{
			$loanslab = "5 to 10 Lakh";	
		}
		else if($loan >= 1000000 && $loan < 1500000)
		{
			$loanslab = "10 to 15 Lakhs";	
		}
		else if($loan >= 1500000 && $loan < 2000000)
		{
			$loanslab = "15 to 20 Lakhs";	
		}
		else
		{
			$loanslab = "20+ Lakhs";	
		}
	}
	else
	{
		$loanslab = $loan;
	}


	$request = ""; //initialize the request variable
	 $param["first_name"] = $name; 
	 $param["pincode"] = $pincode; 
	 $param["mobile"] = $mobile; 
	 $param["age"] = $ageslab; 
	 $param["res_tel"] = $res_tel; 
	 $param["email"] = $email; 
	 $param["city"] = strtolower($city); 
	 $param["othercity"] = strtolower($other_city); 
	 $param["occupation"] = $stroccupation; 
	 $param["income"] = $incomeslab; 
	 $param["loan"] = $loanslab;
	 $param["address"] = $address;
	 $param["refsite"] = "deal4loans";
	 $param["adunit"] = "LAP";
	 $param["channel"] = "test";
	 $param["campaign"] = "icici_lap";


	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "65.111.165.214";
	$script = "/icici_lap/homeequity_submit.php" ;
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
	//print_r($output); 
}

function getRequestidpl()
{
	//echo "helllooooo";
	$query="Select * from Req_Compaign Where Reply_Type='1' and Bank_Name='icici'";
	list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
	$cntr=0;
	while($cntr<count($row1))
        {
	 $requestid= $row1[$cntr]["RequestID"];
	$cntr = $cntr +1;
	 }
	 //echo "hello".$requestid;
	If((strlen(trim($requestid))<=0))
	{
		
	$search_query="Select * from Req_Loan_Personal where (Dated>='2007-08-31 00:00:00' )";
	}
	else
	{
	$search_query="Select * from Req_Loan_Personal where RequestID>'$requestid' and (Dated>= '2007-07-31 00:00:00')";
	}
 list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$i=0;
	while($i<count($row))
        {
		$request= $row[$i]["RequestID"];
		$Name= $row[$i]["Name"];
		$Phone= $row[$i]["Mobile_Number"];
		$Phone1= $row[$i]["Landline"];
		$DOB= $row[$i]["DOB"];
		list($year,$mm,$dd) = split('[/.-]', $DOB);
		$Email= $row[$i]["Email"];
		$City= $row[$i]["City"];
		$City_Other= $row[$i]["City_Other"];
		$Employment_Status= $row[$i]["Employment_Status"];
		$Net_Salary= $row[$i]["Net_Salary"];
		$Company_Name= $row[$i]["Company_Name"];
		$LName="";
				
		$DataArray = array("RequestID"=>$request);
		$wherecondition ="( Reply_Type='1' and Bank_Name='icici')";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

		SendPLLeadToICICIX($request, $Name, $LName, $dd, $mm, $year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);		
		
	$i = $i+1;}

}


function SendPLLeadToICICIX($requestid, $first_name, $last_name, $dd, $mm, $year, $tel_m, $tel_r, $email, $city, $other_city, $occupation, $income, $company)
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
		$stroccupation="Self Employed";
	}
	else if($occupation == "1")
	{
		$stroccupation="Salaried";
	}
	else
	{
		$stroccupation="Salaried";
	}

	$request = ""; //initialize the request variable
	$param["did"] = $requestid; 
	$param["first_name"] = $first_name; 
	$param["last_name"] = $last_name; 
	$param["dd"] = $dd; 
	$param["mm"] = $mm; 
	$param["year"] = $year;
	$param["tel_m"] = $tel_m;
	$param["tel_r"] = $tel_r;
	$param["email"] = $email;
	$param["city"] = strtolower($city);
	$param["other_city"] = strtolower($other_city);
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
	$script = "/icici/lead_submit_new.php";
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
	//print_r($output); 
}

function getRequestidbl()
{
	//echo "helllooooo";
	$query="Select * from Req_Compaign Where Reply_Type='6' and Bank_Name='icici'";


	 list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
		$cntr=0;

	
	//echo "hello".$query."<br>";
	while($cntr<count($row1))
        {
	 $requestid= $row1[$cntr]["RequestID"];
	$cntr = $cntr +1;
	
	 }
	 //echo "hello".$requestid;
	If((strlen(trim($requestid))<=0))
	{
		
	$search_query="Select * from Req_Business_Loan where (Dated>='2007-10-04 00:00:00')";
	}
	else
	{
	$search_query="Select * from Req_Business_Loan where RequestID>'$requestid' and (Dated>= '2007-10-04 00:00:00')";
	}
	
	 list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$i=0;

	while($i<count($row))
        {
		$request= $row[$i]["RequestID"];
		$Name= $row[$i]["Name"];
		$Phone= $row[$i]["Mobile_Number"];
		$Phone1= "";
		$DOB= $row[$i]["DOB"];
		list($year,$mm,$dd) = split('[/.-]', $DOB);
		$Email= $row[$i]["Email"];
		$City= $row[$i]["City"];
		$City_Other= $row[$i]["City_Other"];
		$Employment_Status= $row[$i]["Industry"];
		$Net_Salary= $row[$i]["Net_Salary"];
		$Company_Name= $row[$i]["Constitution"];
		$LName="";
		
		

		$DataArray = array("RequestID"=>$request);
		$wherecondition ="( Reply_Type='6' and Bank_Name='icici')";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

		SendBLLeadToICICI($request, $Name, $LName, $dd, $mm, $year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);		
		
	$i = $i +1;}

}

function SendBLLeadToICICI($requestid, $first_name, $last_name, $dd, $mm, $year, $tel_m, $tel_r, $email, $city, $other_city, $occupation, $income, $company)
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

	

	$request = ""; //initialize the request variable
	$param["did"] = $requestid; 
	$param["first_name"] = $first_name; 
	$param["last_name"] = $last_name; 
	$param["dd"] = $dd; 
	$param["mm"] = $mm; 
	$param["year"] = $year;
	$param["tel_m"] = $tel_m;
	$param["tel_r"] = $tel_r;
	$param["email"] = $email;
	$param["city"] = strtolower($city);
	$param["other_city"] = strtolower($other_city);
	$param["occupation"] = $occupation;
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
	$script = "/icici/lead_submit_new.php";
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
	//print_r($output); 
}



// hl blocked on 24 august 07

main();

Function main()
{
     //getRequestidhl();
	// getRequestidlap();
	 //getRequestidpl();
	  //getRequestidbl();
	
	
}?>



