<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

main();
function main()
{
	getRequestidhl();
	getRequestidpl();
	getRequestidplchennai();
	getRequestidplbangalore();
	getRequestidHydpl();
}

function getRequestidhl()
{
$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query="Select * from Req_Compaign Where (Reply_Type='2' and Bank_Name='Standard Chartered' and BidderID=2756  and Sms_Flag=0)";
list($querycount,$row1)=MainselectfuncNew($query,$array = array());
	for($k=0;$k<$querycount;$k++)
	{
	$requestid= $row1[$k]["RequestID"];
	   // $requestid=1084083;
	 }
	 
	If(($requestid)>0)
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Pincode,Pincode,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Home WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 2756 and Req_Feedback_Bidder1.Feedback_ID>'".$requestid."' and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

	}
	else
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Home WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 2756 and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

	}
	//echo "hello1".$search_query."<br>";
	list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());

	for($k=0;$k<$recorcount;$k++)
	{
		$feedbackid =$row[$k]["Feedback_ID"];
		$Name= $row[$k]["Name"];
		$Phone= $row[$k]["Mobile_Number"];
		$Email= $row[$k]["Email"];
		$Employment_Status= $row[$k]["Employment_Status"];
		$City= $row[$k]["City"];
		$City_Other= $row[$k]["City_Other"];
		$Net_Salary= $row[$k]["Net_Salary"];
		$Loan_Amount= $row[$k]["Loan_Amount"];
		

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
	$DataArray = array("RequestID"=>$feedbackid);
	$wherecondition ="(Reply_Type=2 and Bank_Name='Standard Chartered' and BidderID=2756)";
	Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);}

SendHLLeadToSTANC($Name, $Phone, $Email, $Employment_Status, $strcity, $Net_Salary);	
	
	///IF ($redcordcount)
	}//WHILE LOOP

	
}//End of function


function SendHLLeadToSTANC($Name, $Phone, $Email, $Employment_Status, $strcity, $Net_Salary)
{
	
	if($Employment_Status==0)
	{
		$emp_stat="Self Employed";
	}
	else
	{
		$emp_stat="Salaried";
	}

	$monthIncome = trim($Net_Salary)/12;

	list($FmonthIncome,$LmonthIncome) = split('[.]', $monthIncome);

$Income = substr(trim($Net_Salary), 0, strlen(trim($Net_Salary))-3);

list($First,$Last) = split('[ ]', $Name);

		$request = ""; //initialize the request variable
	 $param["SearchEngine"] ="DS"; 
	 $param["ClientName"] = "sc"; 
	 $param["Campaign"] = "Deal4loansHL"; 
	 $param["Adgroup"] = "lead-push"; 
	 $param["Search_Vs_Content"] = "DI";
	 $param["Keyword"] = "lead-push";
	 $param["referer"] = "";
	 $param["txtfname"] = $First;
	 $param["txtlname"] = $Last;
	 $param["txtemailid"] = $Email;
	 $param["txtmobile"] = $Phone;
	 $param["ddlcity"] = $strcity;
	 $param["isSalaried"] = $emp_stat;
	 $param["txtIncome"] = $FmonthIncome;
	 $param["txtannualincome"] = $Income;
	 $param["isExistingCust"] = "";
	 $param["chkauthorize"] = "on";

	 
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

$request= str_ireplace("%40", "@", $request);
	$host = "http://www.mortgageloans-standardchartered.in";  //intouch
			$script = "leadpush/leadpush.aspx"; //intouch
			//www.mortgageloans-standardchartered.in/leadpush/leadpush.aspx
		   echo $url = "http://www.mortgageloans-standardchartered.in/leadpush/leadpush.aspx?".$request;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			$content = curl_exec ($ch);
		    print_r($content); 
			curl_close ($ch);  

}

function getRequestidpl()
{
$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query="Select * from Req_Compaign Where (Reply_Type=1 and Bank_Name='Standard Chartered' and BidderID=2764  and Sms_Flag=0)";
	list($querycount,$row1)=MainselectfuncNew($query,$array = array());
	for($k=0;$k<$querycount;$k++)
	{
	$requestid= $row1[$k]["RequestID"];

	
	 }
	 
	if(($requestid)>0)
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Pincode,Pincode,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 2764 and Req_Feedback_Bidder1.Feedback_ID>'".$requestid."' and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

	}
	else
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 2764 and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

	}
	echo "hello1".$search_query."<br>";
	list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());

	for($k=0;$k<$recorcount;$k++)
	{
		$feedbackid =$row[$k]["Feedback_ID"];
		$Name= $row[$k]["Name"];
		$Phone= $row[$k]["Mobile_Number"];
		$Email= $row[$k]["Email"];
		$Employment_Status= $row[$k]["Employment_Status"];
		$City= $row[$k]["City"];
		$City_Other= $row[$k]["City_Other"];
		$Net_Salary= $row[$k]["Net_Salary"];
		$Loan_Amount= $row[$k]["Loan_Amount"];
		

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

	$DataArray = array("RequestID"=>$feedbackid);
	$wherecondition ="(Reply_Type=1 and Bank_Name='Standard Chartered' and BidderID=2764)";
	Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	

}

SendPLLeadToSTANC($Name, $Phone, $Email, $Employment_Status, $strcity, $Net_Salary, $Loan_Amount);	
	
	///IF ($redcordcount)
	}//WHILE LOOP

	
}//End of function

function getRequestidHydpl()
{
$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query="Select * from Req_Compaign Where (Reply_Type=1 and Bank_Name='Standard Chartered' and BidderID=3136  and Sms_Flag=0)";
	list($querycount,$row1)=MainselectfuncNew($query,$array = array());
	for($k=0;$k<$querycount;$k++)
	{
	$requestid= $row1[$k]["RequestID"];

	
	 }
	 
	if(($requestid)>0)
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Pincode,Pincode,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 3136 and Req_Feedback_Bidder1.Feedback_ID>'".$requestid."' and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

	}
	else
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 3136 and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

	}
	echo "hello1".$search_query."<br>";
list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());

	for($k=0;$k<$recorcount;$k++)
	{
		$feedbackid =$row[$k]["Feedback_ID"];
		$Name= $row[$k]["Name"];
		$Phone= $row[$k]["Mobile_Number"];
		$Email= $row[$k]["Email"];
		$Employment_Status= $row[$k]["Employment_Status"];
		$City= $row[$k]["City"];
		$City_Other= $row[$k]["City_Other"];
		$Net_Salary= $row[$k]["Net_Salary"];
		$Loan_Amount= $row[$k]["Loan_Amount"];
		

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
		$DataArray = array("RequestID"=>$feedbackid);
	$wherecondition ="(Reply_Type=1 and Bank_Name='Standard Chartered' and BidderID=3136  and Sms_Flag=0)";
	Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	

}

SendPLLeadToSTANC($Name, $Phone, $Email, $Employment_Status, $strcity, $Net_Salary, $Loan_Amount);	
	
	///IF ($redcordcount)
	}//WHILE LOOP

	
}//End of function

function getRequestidplbangalore()
{
$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query="Select * from Req_Compaign Where (Reply_Type=1 and Bank_Name='Standard Chartered' and BidderID=2780 and Sms_Flag=0)";
list($querycount,$row1)=MainselectfuncNew($query,$array = array());
	for($k=0;$k<$querycount;$k++)
	{
	$requestid= $row1[$k]["RequestID"];
	
	 }
	 
	if(($requestid)>0)
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Pincode,Pincode,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 2780 and Req_Feedback_Bidder1.Feedback_ID>'".$requestid."' and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

	}
	else
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 2780 and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

		//$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 2780 and Req_Feedback_Bidder1.Allocation_Date between '2012-05-03 00:00:00' and '2012-05-07 23:59:59')";

	}
	echo "hello1".$search_query."<br>";
list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());

	for($k=0;$k<$recorcount;$k++)
	{
		$feedbackid =$row[$k]["Feedback_ID"];
		$Name= $row[$k]["Name"];
		$Phone= $row[$k]["Mobile_Number"];
		$Email= $row[$k]["Email"];
		$Employment_Status= $row[$k]["Employment_Status"];
		$City= $row[$k]["City"];
		$City_Other= $row[$k]["City_Other"];
		$Net_Salary= $row[$k]["Net_Salary"];
		$Loan_Amount= $row[$k]["Loan_Amount"];

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
	$DataArray = array("RequestID"=>$feedbackid);
	$wherecondition ="(Reply_Type=1 and Bank_Name='Standard Chartered' and BidderID=2780  and Sms_Flag=0)";
	Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	
	

}

SendPLLeadToSTANC($Name, $Phone, $Email, $Employment_Status, $strcity, $Net_Salary, $Loan_Amount);	
	
	///IF ($redcordcount)
	}//WHILE LOOP

	
}//End of function bangalore

function getRequestidplchennai()
{
$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query="Select * from Req_Compaign Where (Reply_Type=1 and Bank_Name='Standard Chartered' and BidderID=2781  and Sms_Flag=0)";
list($querycount,$row1)=MainselectfuncNew($query,$array = array());
	for($k=0;$k<$querycount;$k++)
	{
	$requestid= $row1[$k]["RequestID"];

	
	 }
	 
	if(($requestid)>0)
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Pincode,Pincode,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 2781 and Req_Feedback_Bidder1.Feedback_ID>'".$requestid."' and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";

	}
	else
	{
		$search_query="SELECT Feedback_ID,Name,Mobile_Number,Email,Employment_Status,City,City_Other,Net_Salary,Loan_Amount from Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = 2781 and Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";
		

	}
	echo "hello1".$search_query."<br>";
list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());

	for($k=0;$k<$recorcount;$k++)
	{
		$feedbackid =$row[$k]["Feedback_ID"];
		$Name= $row[$k]["Name"];
		$Phone= $row[$k]["Mobile_Number"];
		$Email= $row[$k]["Email"];
		$Employment_Status= $row[$k]["Employment_Status"];
		$City= $row[$k]["City"];
		$City_Other= $row[$k]["City_Other"];
		$Net_Salary= $row[$k]["Net_Salary"];
		$Loan_Amount= $row[$k]["Loan_Amount"];
		

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

	$DataArray = array("RequestID"=>$feedbackid);
	$wherecondition ="(Reply_Type=1 and Bank_Name='Standard Chartered' and BidderID=2781  and Sms_Flag=0)";
	Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	

}

SendPLLeadToSTANC($Name, $Phone, $Email, $Employment_Status, $strcity, $Net_Salary, $Loan_Amount);	
	
	///IF ($redcordcount)
	}//WHILE LOOP

	
}//End of function chennai


function SendPLLeadToSTANC($Name, $Phone, $Email, $Employment_Status, $strcity, $Net_Salary, $Loan_Amount)
{
	//http://www.personalloans-standardchartered.in/leadpush/leadpush.aspx?SearchEngine=DS&ClientName=sc&Campaign=Deal4loansPLH&Adgroup=lead-push&Search_Vs_Content=DI&Keyword=lead-push&referer=&txtfname=Deal4loansPLH&txtlname=test&txtemailid=deal4loansplh@dl.com&txtmobile=9833798491&ddlcity=Mumbai&isSalaried=Salaried&txtIncome=25636985&txtannualincome=254255452&isExistingCust=&chkauthorize=on
	if($Employment_Status==0)
	{
		$emp_stat="Self Employed";
	}
	else
	{
		$emp_stat="Salaried";
	}

	$monthIncome = trim($Net_Salary)/12;

	list($FmonthIncome,$LmonthIncome) = split('[.]', $monthIncome);

$Income = substr(trim($Net_Salary), 0, strlen(trim($Net_Salary))-3);

//http://clients.resultrix-apps.com/pl/leadpush/leadpush.aspx?
//SearchEngine=&ClientName=&Campaign=Deal4loansPLH&Adgroup=&Search_Vs_Content=&Keyword=&referer=&result12=&txtfname=testAnil&txtlname=test&txtemailid=test@40test.com&txtmobile=9076498621&ddlcity=Mumbai&isSalaried=Salaried&Text1=Monthly+take+home+salary&txtannualincome=35000&Text2=Annual+Income%3A&txtannualincome1=0&isExistingCust=Yes&chkauthorize=on&x=17&y=6


list($First,$Last) = split('[ ]', $Name);

		$request = ""; //initialize the request variable
	 $param["SearchEngine"] ="DS"; 
	 $param["ClientName"] = "sc"; 

	 if($Loan_Amount>=1500000)
	{
	 $param["Campaign"] = "Deal4loansPLH"; 
	}
	else
	{
		$param["Campaign"] = "Deal4loansPLL";
	}

	 $param["Adgroup"] = "lead-push"; 
	 $param["Search_Vs_Content"] = "DI";
	 $param["Keyword"] = "lead-push";
	 $param["referer"] = "";
	 $param["result12"] = "";
	 $param["txtfname"] = $First;
	 $param["txtlname"] = $Last;
	 $param["txtemailid"] = $Email;
	 $param["txtmobile"] = $Phone;
	 $param["ddlcity"] = $strcity;
	 $param["isSalaried"] = $emp_stat;
	 $param["Text1"] = $FmonthIncome;
	 $param["txtannualincome"] = $Income;
	 $param["Text2"] = $FmonthIncome;
	 $param["txtannualincome1"] = $Income;
	 $param["isExistingCust"] = "";
	 $param["chkauthorize"] = "on";
	 $param["x"] = "17";
	 $param["y"] = "6";

	 
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

$request= str_ireplace("%40", "@", $request);
	
		 $url = "http://clients.resultrix-apps.com/pl/leadpush/leadpush.aspx?".$request;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			$content = curl_exec ($ch);
		    print_r($content); 
			curl_close ($ch);  
	


}