<?php
require 'scripts/db_init.php';

amexCC();

function amexCC()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type='4' and Bank_Name='American Express' and BidderID=5596)";
$result1 = ExecQuery($query1);

while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 }
//$requestid="433598";
If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT
 BidderID, RequestID, Feedback_ID, DOB, Name, Email, Mobile_Number, Net_Salary, Company_Name, Pincode, City, Gender, State, Pancard, Residence_Address, applied_card_name FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID=5596 and Req_Feedback_Bidder_CC.Reply_Type=4 and (Req_Feedback_Bidder_CC.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
	else
	{
	$query="SELECT BidderID, RequestID, Feedback_ID, DOB, Name, Email, Mobile_Number, Net_Salary, Company_Name, Pincode, City, Gender, State, Pancard, Residence_Address, applied_card_name FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID=5596 and Req_Feedback_Bidder_CC.Reply_Type=4 and  Req_Feedback_Bidder_CC.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_CC.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
echo $query."<br>";
//$query="Select * from Req_Credit_Card Where (RequestID=788287)";
$tataplqryresult = ExecQuery($query);
while($rowcc=mysql_fetch_array($tataplqryresult))
{
	
	$BidderID = $rowcc["BidderID"];
	$RequestID = $rowcc["RequestID"];
	$Feedback_ID = $rowcc["Feedback_ID"];
	$DOB = $rowcc["DOB"];
	list($year,$mm,$dd) = split('[-]',$DOB);
	$Name = $rowcc["Name"];
	list($firstname,$lastname) = split('[ ]',$Name);
	$Email = $rowcc["Email"];
	$Mobile_Number = $rowcc["Mobile_Number"];
	$Net_Salary = $rowcc["Net_Salary"];
	$Company_Name = $rowcc["Company_Name"];
	$Pincode = $rowcc["Pincode"];
	$City = $rowcc["City"];
	$Gender = "Male";
	$State = $rowcc["State"];
	$Pancard = $rowcc["Pancard"];
	$Residence_Address = $rowcc["Residence_Address"];
	list($line1,$line2,$line3) = split('[|]',$Residence_Address);
	$applied_card_name = $rowcc["applied_card_name"];
	$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
	if($lastname=="")
	{ $lastname="Kumar";	}

	$cardsarr=explode(",",trim($applied_card_name));
	$cardsarrunq="";
	$cardsarrunq = array_unique($cardsarr);
			for($r=0;$r<count($cardsarrunq);$r++)
			{	if(strpos($cardsarrunq[$r], 'American')>=0)
				{	$newstring = $cardsarrunq[$r];
					if(strpos($newstring, 'Gold')>0)
					{		$choosencard="gold";	}
					elseif(strpos($newstring, 'JetAirways')>0)
					{ $choosencard="JetAirways";	}
					elseif(strpos($newstring, 'PAYBACK')>0)
					{ $choosencard="payback";	}
					elseif(strpos($newstring, 'MakeMyTrip')>0)
					{ $choosencard="makeMyTrip";	}
					elseif(strpos($newstring, 'Reserve')>0)
					{ $choosencard="platinumR";	}
					elseif(strpos($newstring, 'Travel')>0)
					{ $choosencard="platinumTravel";	}
					else{ $choosencard="platinum"; }				
				}
			}

	$param["chosenCard"]=$choosencard;
	$param["fname"] = $firstname;
	$param["mname"] = "";
	$param["lname"] = $lastname;
	$param["email"] = $Email;
	$param["mobile"] = $Mobile_Number;
	$param["dd"] = $dd;
	$param["mm"] = $mm;
	$param["yy"] = $year;
	$param["gender"] = $Gender;
	$param["pancard"]  = $Pancard;
	$param["annual_income"] = $Net_Salary;
	$param["address"] = $line1;
	$param["address2"] = $line2;
	$param["address3"] = $line3;
	$param["city"] = $City;
	$param["state"] = $State;
	$param["pincode"] = $Pincode;
	$param["disclaimer"] = "i agree";
	$param["siteid"] = "deal4loan";
	$param["ip"] = $IP;

$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		//$request = rawurldecode(substr($request, 0, strlen($request)-1)); //remove the final ampersand sign from the request
	
		$request = substr($request, 0, strlen($request)-1);
		$url = "https://www.americanexpressindia.co.in/submitLeadprequal.ashx?".$request;
		echo $url;
		echo "<br>";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);		
		$content = curl_exec ($ch);
		print_r($content); 
		curl_close ($ch);  
		echo "<br>";
		echo $outputstr=$content;
		echo "<br>";
echo "<br><br>";

$update=ExecQuery("Update Req_Compaign set RequestID=".$RequestID." Where (Reply_Type='4' and Bank_Name='American Express' and BidderID=5596)");

echo $qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid) VALUES('".$Feedback_ID."','4','".$content."','".$BidderID."',NOW(),'".$RequestID."')");
}
}
?>