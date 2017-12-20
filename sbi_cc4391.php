<?php
error_reporting(E_ALL);
require 'scripts/db_init.php';

function SBICC()
{
	$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type=4 and Bank_Name like'%SBI%' and Compaign_ID =4720)";
//$result1 = ExecQuery($query1);
list($alreadyExist,$row1)=MainselectfuncNew($query1,$array = array());
$row1contr=count($row1)-1;
$requestid= $row1[$row1contr]["RequestID"];

//$requestid=1453430;
If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT
Feedback_ID,RequestID,Name,DOB,Email,Mobile_Number,Employment_Status,Company_Name,City,City_Other,Pincode,CC_Holder,Net_Salary,IP_Address,Add_Comment,Dated FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE (Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID=4391 and (Req_Feedback_Bidder_CC.Allocation_Date between '".$mindate."' and '".$maxdate."'))";
	}
	else
	{
	$query="SELECT
Feedback_ID,RequestID,Name,DOB,Email,Mobile_Number,Employment_Status,Company_Name,City,City_Other,Pincode,CC_Holder,Net_Salary,IP_Address,Add_Comment,Dated FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE (Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID=4391 and Req_Feedback_Bidder_CC.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_CC.Allocation_Date between '".$mindate."' and '".$maxdate."'))";
}
echo $query."<br>";
list($recordcount,$row)=MainselectfuncNew($query,$array = array());

for($ca=0;$ca<$recordcount;$ca++)
{
	$Feedback_ID = $row[$ca]["Feedback_ID"];
	if($row[$ca]["Net_Salary"]>900000)
	{
		$netsalary="Above Rs. 9 Lacs";
	}
	elseif($row[$ca]["Net_Salary"]>=500000 && $row[$ca]["Net_Salary"]<=900000)
	{
		$netsalary="Between Rs. 5- 9 Lacs";
	}
	else
	{
		$netsalary="Upto Rs. 5 Lacs";
	}
if($CC_Holder=1) { $ccholder="Yes"; } else { $ccholder="No";  }
	
	$param="";

	$param["fldName"]=$row[$ca]["Name"];
	$param["fldMobile"]=$row[$ca]["Mobile_Number"];
	$param["fldCity"]=$row[$ca]["City"];
	$param["fldEMail"]=$row[$ca]["Email"];
	$param["fldIncome"]=$netsalary;
	$param["fldCreditCard"]=$ccholder;
	$param["fldSiteId"]="Deal4loan";
	$param["fldAdUnit"]="Mailer2";
	$param["fldBanner"]="Mailer2";
	$param["fldKeyword"]="SbiSignature";
	$param["fldIP"]=$row[$ca]["IP_Address"];
	
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		//$request = rawurldecode(substr($request, 0, strlen($request)-1)); //remove the final ampersand sign from the request
		$request = substr($request, 0, strlen($request)-1);

$request = substr($request, 0, strlen($request)-1);
		$url = "http://www.fly2anewworld.com/air-india-sbi-signature/LeadSubmit.ashx?".$request;
		echo $url;
		echo "<br>";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec ($ch);
		print_r($content); 
		curl_close ($ch);  

	$dataUpdate = array('RequestID'=>$Feedback_ID);
	$wherecondition = "(Reply_Type=4 and Bank_Name like'%SBI%' and Compaign_ID =4720)";
	Mainupdatefunc ('Req_Compaign', $dataUpdate, $wherecondition);

	$Dated = ExactServerdate();
	$dataInsert = array('leadid'=>$Feedback_ID,'product'=>'4','feedback'=>$content, 'bidderid'=>'4391', 'doe'=>$Dated);
	$insert = Maininsertfunc ('webservice_bidder_details', $dataInsert);
}
}
SBICC();
?>