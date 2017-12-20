<?php

require 'scripts/db_init.php';
require 'scripts/functions.php';

error_reporting(E_ALL);

function getRequestidpl()
{
	echo "helllooooo";
	$query="Select * from Req_Compaign Where Reply_Type='1'";
	 list($recordcount,$row1)=MainselectfuncNew($query,$array = array());
		$i=0;

	//$result1 = ExecQuery($query);
	//echo "hello".$query."<br>";
	while($i<count($row1))
        {
	 $requestid= $row1[$i]["RequestID"];
	 $i = $i +1;}
	 //echo "hello".$requestid;
	if((strlen(trim($requestid))<=0))
	{
		
	$search_query="Select * from Req_Loan_Personal where (Dated>='2007-08-31 00:00:00' )";
	}
	else
	{
	$search_query="Select * from Req_Loan_Personal where RequestID>'$requestid' and (Dated>= '2007-07-24 00:00:00')";
	}
	//echo "hello1".$search_query."<br>";
	 list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;

	
	//$result = ExecQuery($search_query);

	while($cntr<count($row))
        {
		$request= $row[$cntr]["RequestID"];
		$Name= $row[$cntr]["Name"];
		$Phone= $row[$cntr]["Mobile_Number"];
		$Phone1= $row[$cntr]["Landline"];
		$DOB= $row[$cntr]["DOB"];
		list($year,$mm,$dd) = split('[/.-]', $DOB);
		$Email= $row[$cntr]["Email"];
		$City= $row[$cntr]["City"];
		$City_Other= $row[$cntr]["City_Other"];
		$Employment_Status= $row[$cntr]["Employment_Status"];
		$Net_Salary= $row[$cntr]["Net_Salary"];
		$Company_Name= $row[$cntr]["Company_Name"];
		$LName="";
		
		$DataArray = array("RequestID"=>$request);
		$wherecondition ="Reply_Type='1' and Bank_Name='icici'";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

		SendPLLeadToICICIX($request, $Name, $LName, $dd, $mm, $year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);		
		
	       $cntr=$cntr+1;
		   
		  }

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
	print_r($output); 
}



// hl blocked on 24 august 07

function main()
{
     //getRequestidhl();
	 //getRequestidlap();
	 getRequestidpl();

	
}
main();

?>



