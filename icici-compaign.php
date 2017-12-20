<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

function getRequestidhl()
{

	$query="Select * from Req_Compaign Where Reply_Type='2' and Bank_Name='icici' and BidderID=9992";
	 list($recorcount,$row1)=Mainselectfunc($query,$array = array());

	 $requestid= $row1["RequestID"];
	 
	If((strlen(trim($requestid))<=0))
	{
		$search_query="SELECT * FROM Req_Loan_Home WHERE ((Dated >='2008-02-04 00:00:00') and (City Not Like'%Mumbai%' or City Not Like'%Thane%'or City Not Like'%Navi Mumbai%' or City Like '%Noida%'))";

	}
	else
	{
		$search_query="SELECT * FROM Req_Loan_Home WHERE RequestID>'$requestid' and (Dated >='2008-02-04 00:00:00') and (City Not Like'%Mumbai%' or City Not Like'%Thane%'or City Not Like'%Navi Mumbai%' or City Like '%Noida%')";

	}

	 list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;

	while($cntr<count($row))
        {
		//$feedbackid =$row["Feedback_ID"];
		$request= $row[$cntr]["RequestID"];
		$Name= $row[$cntr]["Name"];
		$Phone= $row[$cntr]["Mobile_Number"];
		$Phone1= $row[$cntr]["Landline"];
		$DOB= $row[$cntr]["DOB"];
		$Email= $row[$cntr]["Email"];
		$City= $row[$cntr]["City"];
		$City_Other= $row[$cntr]["City_Other"];
		$Employment_Status= $row[$cntr]["Employment_Status"];
		$Net_Salary= $row[$cntr]["Net_Salary"];
		$Residence_Address= $row[$cntr]["Residence_Address"];
		$Pincode= $row[$cntr]["Pincode"];
		$Loan_Amount= $row[$cntr]["Loan_Amount"];
		$Property_Identified= $row[$cntr]["Property_Identified"];
		$Budget= $row[$cntr]["Budget"];

If(($recorcount)>0)
	{
		$DataArray = array("RequestID"=>$request);
		$wherecondition ="(Reply_Type='2' and Bank_Name='icici' and BidderID=9992)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	
	}
	SendHLLeadToICICI( $Name, $DOB, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Residence_Address, $Pincode, $Loan_Amount, $Property_Identified, $Budget);	
	
	///IF ($redcordcount)
	   $cntr=$cntr+1; }//WHILE LOOP
}//End of function

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


//////////////////////////////////////////////////////////////////HL FOR MUMBAI////////////////
function getRequestidhlmum()
{

	$query="Select * from Req_Compaign Where Reply_Type='2' and Bank_Name='icicimum' and BidderID=765";
	 list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
		$i=0;
	while($i<count($row1))
        {
	 $requestid= $row1[$i]["RequestID"];
	 $i = $i +1;
	 
	 }
	 
	If((strlen(trim($requestid))<=0))
	{
		//$search_query="SELECT * FROM Req_Loan_Home WHERE (Dated >='2008-02-04 00:00:00')";


	$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Home.RequestID AND Req_Feedback.BidderID= 765 WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 765 and (Req_Feedback_Bidder1.Allocation_Date >='2008-03-24 00:00:00' and Req_Loan_Home.Dated >='2008-03-24 00:00:00')";
	}
	else
	{
		//$search_query="SELECT * FROM Req_Loan_Home WHERE RequestID>'$requestid' and (Dated >='2008-02-04 00:00:00')";

	$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Home.RequestID AND Req_Feedback.BidderID= 765 WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 765 and (Req_Feedback_Bidder1.Feedback_ID>'$requestid' and (Req_Feedback_Bidder1.Allocation_Date >='2008-03-24 00:00:00' and Req_Loan_Home.Dated >='2008-03-24 00:00:00') )";
	}

 list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());
		$j=0;
		
		while($j<count($row))
        {
        

		//$feedbackid =$row["Feedback_ID"];
		$request= $row[$j]["RequestID"];
		$Name= $row[$j]["Name"];
		$Phone= $row[$j]["Mobile_Number"];
		$Phone1= $row[$j]["Landline"];
		$DOB= $row[$j]["DOB"];
		$Email= $row[$j]["Email"];
		$City= $row[$j]["City"];
		$City_Other= $row[$j]["City_Other"];
		$Employment_Status= $row[$j]["Employment_Status"];
		$Net_Salary= $row[$j]["Net_Salary"];
		$Residence_Address= $row[$j]["Residence_Address"];
		$Pincode= $row[$j]["Pincode"];
		$Loan_Amount= $row[$j]["Loan_Amount"];
		$Property_Identified= $row[$j]["Property_Identified"];
		$Budget= $row[$j]["Budget"];

If(($recorcount)>0)
	{
		$DataArray = array("RequestID"=>$request);
		$wherecondition ="(Reply_Type='2' and Bank_Name='icicimum' and BidderID=765)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	}
	SendHLLeadToICICI( $Name, $DOB, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Residence_Address, $Pincode, $Loan_Amount, $Property_Identified, $Budget);	
	
	///IF ($redcordcount)
	$j = $j+1;}//WHILE LOOP
}//End of function
/////////////////////////////////LAP///////////////////////////////////////////////////////////////////////////////////////////////
	
function getRequestidlap()
{
	
	$query="Select * from Req_Compaign Where Reply_Type='5' and Bank_Name='icici' and BidderID=9995";
	 list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
		$cntr=0;
	
	while($cntr<count($row1))
        {
	 $requestid= $row1[$cntr]["RequestID"];
 	$cntr = $cntr +1;}
	//echo "hello".$requestid;
	if((strlen(trim($requestid))<=0))
	{
	$search_query="Select * from Req_Loan_Against_Property where (Dated >='2008-02-02 00:00:00')";
	}
	else
	{
		
	$search_query="Select * from Req_Loan_Against_Property where RequestID>'$requestid' and (Dated>= '2008-02-02 00:00:00') ";
	}
	 list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());
		$k=0;
	
	while($k<count($row))
        {
		$request= $row[$k]["RequestID"];
		$Name= $row[$k]["Name"];
		$Phone= $row[$k]["Mobile_Number"];
		$Phone1= $row[$k]["Landline"];
		$DOB= $row[$k]["DOB"];
		$Email= $row[$k]["Email"];
		$City= $row[$k]["City"];
		$City_Other= $row[$k]["City_Other"];
		$Employment_Status= $row[$k]["Employment_Status"];
		$Net_Salary= $row[$k]["Net_Salary"];
		$Residence_Address= $row[$k]["Residence_Address"];
		$Pincode= $row[$k]["Pincode"];
		$Loan_Amount= $row[$k]["Loan_Amount"];
	
	if(($recorcount)>0)
	{
	 	$DataArray = array("RequestID"=>$request);
		$wherecondition ="(Reply_Type='5' and Bank_Name='icici' and BidderID=9995)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	}
	 SendLAPLeadToICICI($Name, $DOB, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Residence_Address, $Pincode, $Loan_Amount);		
	//IF($recordcount)
	$k = $k +1;}//WHILE LOOP
}



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
////////////////////////BUSINESS LOAN//////////////
function getRequestidbl()
{
	
	$query="Select * from Req_Compaign Where Reply_Type='6' and Bank_Name Like'%icici%' and BidderID=9996";
	 list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
		$cntr=0;
	while($cntr<count($row1))
        {
			$requestid= $row1[$cntr]["RequestID"];
		 	$cntr=$cntr+1;
		}
	
	If((strlen(trim($requestid))<=0))
	{
		
	$search_query="Select * from Req_Business_Loan where (Dated>='2008-02-06 00:00:00')";
	}
	else
	{
	$search_query="Select * from Req_Business_Loan where RequestID>'$requestid' and (Dated>= '2008-02-06 00:00:00')";
	}
	
	
	echo "hello1".$search_query."<br>";
 list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());
		$m=0;
	while($m<count($row))
        {
		$request= $row[$m]["RequestID"];
		$Name= $row[$m]["Name"];
		list($First,$Last) = split('[/.-]', $Name);
		$Phone= $row[$m]["Mobile_Number"];
		$Tel_O= $row[$m]["Landline"];
		$DOB= $row[$m]["DOB"];
		list($year,$mm,$dd) = split('[/.-]', $DOB);
		$Email= $row[$m]["Email"];
		$City= $row[$m]["City"];
		$City_Other= $row[$m]["City_Other"];
		$Year_Of_Establishment= $row[$m]["Year_Of_Establishment"];
		$Occupation= $row[$m]["Constitution"];
		$Annual_Turnover= $row[$m]["Annual_Turnover"];
		$Company_Name= $row[$m]["Company_Name"];
		//$LName="";
		
	If(($recorcount)>0)
	{
		$DataArray = array("RequestID"=>$request);
		$wherecondition ="(Reply_Type='2' and Bank_Name='%icici%' and BidderID=9996)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	}

		SendBLLeadToICICI($request, $First, $Last, $dd, $mm, $year, $Phone, $Email, $City, $City_Other, $Year_Of_Establishment, $Occupation, $Annual_Turnover, $Company_Name, $Tel_O );		
		
	$m = $m +1;}

}

function SendBLLeadToICICI($request, $First, $Last, $dd, $mm, $year, $Phone, $Email, $City, $City_Other, $Year_Of_Establishment, $Occupation, $Annual_Turnover, $Company_Name, $Tel_O)
{


if($Annual_Turnover==1)
	{
		$turnover="Less than 25 lac";
	}
elseif($Annual_Turnover==2 || $Annual_Turnover>2)
	{
		$turnover="More than 25 lac";
	}
	else
	{ $turnover="Less than 25 lac";}

$year =date('Y');
//$year_of_establishment ="2006";
$final=$year-$Year_Of_Establishment;

if($final<1)
{
	$experience="&lt; 1 year";
}
elseif($final==1 || $final==3 || $final<3)
{
  $experience="1-3 years";
}
elseif($final>3)
{
  $experience="&gt; 3 years";
}
else
	{
		$experience="&lt; 1 year";
	}


	$request = ""; //initialize the request variable
	//$param["did"] = $requestid; 
	$param["first_name"] = $First; 
	$param["last_name"] = $Last; 
	$param["dd"] = $dd; 
	$param["mm"] = $mm; 
	$param["year"] = $year;
	$param["tel_m"] = $Phone;
	$param["tel_o"] = $Tel_O;
	$param["email"] = $Email;
	$param["city"] = strtolower($City);
	$param["other_city"] = strtolower($City_Other);
	$param["occupation"] = $Occupation;
	$param["turnover"] = $turnover;
	$param["experience"] = $experience;
	$param["company"] = $Company_Name;
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
	$script = "/icici_bil_lp/lead_submit.php";
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

//////////////////////////////////////////////////////////////////////////////////////////



main();

Function main()
{
    // getRequestidhl();
	 //getRequestidhlmum();
	 //getRequestidlap();
	 //getRequestidbl();
	
}