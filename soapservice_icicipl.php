<?php
error_reporting(E_ALL);
require 'scripts/db_init.php';

function ICICIpl()
{
$curr_date2 = date("Y-m-d");
$curr_date1 = date("H:i:s");
$curr_date = $curr_date2."T".$curr_date1;
	//code starts
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type='1' and Bank_Name like'%ICICI%' and BidderID=2924)";
list($alreadyExist,$row1)=MainselectfuncNew($query1,$array = array());
$row1contr=count($row1)-1;
$requestid= $row1[$row1contr]["RequestID"];

If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT
Bidder_Count,Feedback_ID,RequestID,Name,DOB,Email,Mobile_Number,Employment_Status,Company_Name,City,City_Other,Pincode,CC_Holder,Primary_Acc,Net_Salary,Annual_Turnover,Loan_Any,EMI_Paid,PL_EMI_Amt,Loan_Amount,Card_Vintage,Card_Limit,IP_Address,identification_proof,Add_Comment,Dated,Company_type FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (2929,2933,4387,4393,2896) and (Req_Feedback_Bidder_PL.Allocation_Date between '".$mindate."' and '".$maxdate."')";
	}
	else
	{
	$query="SELECT Bidder_Count,Feedback_ID,RequestID,Name,DOB,Email,Mobile_Number,Employment_Status,Company_Name,City,City_Other,Pincode,CC_Holder,Primary_Acc,Net_Salary,Annual_Turnover,Loan_Any,EMI_Paid,PL_EMI_Amt,Loan_Amount,Card_Vintage,Card_Limit,IP_Address,identification_proof,Add_Comment,Dated,Company_type FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID  in (2929,2933,4387,4393,2896) and Req_Feedback_Bidder_PL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_PL.Allocation_Date between '".$mindate."' and '".$maxdate."')";
}

// fetch leads from database
echo $query."<br>";
list($recordcount,$row)=MainselectfuncNew($query,$array = array());
for($ca=0;$ca<$recordcount;$ca++)
{
	$Feedback_ID = $row[$ca]["Feedback_ID"];
	$RequestID = $row[$ca]["RequestID"];
	$Name = $row[$ca]["Name"];
	$dateDOB = $row[$ca]["DOB"];

	$datearry=explode("-",$dateDOB);
	if(strlen($datearry[1])==1)
	{	$mm = "0".$datearry[1]; } else {$mm = $datearry[1]; }

	if(strlen($datearry[2])==1)
	{	$dd = "0".$datearry[2]; } else {$dd = $datearry[2]; }

	$DOB=$datearry[0]."-".$mm."-".$dd;

	$Email = $row[$ca]["Email"];
	$Mobile_Number = $row[$ca]["Mobile_Number"];
	$Employment_Status = $row[$ca]["Employment_Status"];
	if($Employment_Status==1){ $emp_stat="Salaried";} else {$emp_stat="Self Employed";}
		$Company_Name = $row[$ca]["Company_Name"];
		$strcompany_Name = substr($Company_Name, 0, 40);
		$City = $row[$ca]["City"];
		$City_Other = $row[$ca]["City_Other"];
		$Pincode = $row[$ca]["Pincode"];
		$CC_Holder = $row[$ca]["CC_Holder"];
	if($CC_Holder==1){ $cc_holder="Yes";} else { $cc_holder="No";}
		$Primary_Acc = $row[$ca]["Primary_Acc"];
		echo $Net_Salary = $row[$ca]["Net_Salary"];
		list($annualincome,$rest) = split('[.]', $Net_Salary); 
		echo $annualincome." - ".$rest."<br><br>";
		$Annual_Turnover = $row[$ca]["Annual_Turnover"];
		if($Annual_Turnover==1) { $annual_turnover="0-40 Lacs"; } 
else if($Annual_Turnover==2) { $annual_turnover="1Cr - 3Crs"; } 
else if($Annual_Turnover==3) { $annual_turnover="3Crs & above"; } 
else if($Annual_Turnover==4) { $annual_turnover="40Lacs To 1 Cr"; } 
else { $annual_turnover="";  }
		 $Loan_Any = $row[$ca]["Loan_Any"];
		if(strlen($Loan_Any)>0) { $loanrunning="Yes";} else {$loanrunning="No";}
		$EMI_Paid = $row[$ca]["EMI_Paid"];
		if($EMI_Paid==1){ $emi_paid="Less than 6 months";}
			elseif($EMI_Paid==2) {  $emi_paid="6 to 9 months"; }
			elseif($EMI_Paid==3){  $emi_paid="9 to 12 months"; }
			elseif($EMI_Paid==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
		$PL_EMI_Amt = $row[$ca]["PL_EMI_Amt"];
		$Loan_Amount = $row[$ca]["Loan_Amount"];
		list($loanamt,$larest) = split('[.]',$Loan_Amount);
		$Card_Vintage = $row[$ca]["Card_Vintage"];
		if($Card_Vintage==1)	{	$card_vintage="Less than 6 months";}
			elseif($Card_Vintage==2)	{	$card_vintage="6 to 9 months";}
		elseif($Card_Vintage==3)	{	$card_vintage="9 to 12 months";}
		elseif($Card_Vintage==4)		{	$card_vintage="more than 12 months";}
		else	{	$card_vintage="";	}
		$Card_Limit = $row[$ca]["Card_Limit"];
		list($cardlimit,$clrest) = split('[.]',$Card_Limit);
		$IP_Address = $row[$ca]["IP_Address"];
		$identification_proof = $row[$ca]["identification_proof"];
		$Add_Comment = $row[$ca]["Add_Comment"];
		$AddComment = array("/", "-", "&");
		$comments = str_replace($AddComment, "", $Add_Comment);
		$strcompanyName = str_replace($AddComment, "", $strcompany_Name);
		$DOE = $row[$ca]["Dated"];
		$Company_type = $row[$ca]["Company_type"];
		$feedback = "Need Loan";
		$Bidder_Count = $row[$ca]["Bidder_Count"];
		if($Bidder_Count>1)
		{
			$icicileadstat="NonExclusive";
		}
		else
		{
			$icicileadstat="Exclusive";
		}
		
//code ends
$xmlstr='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <InsertData xmlns="AndromedaIbankWebService">
      <Name>'.$Name.'</Name>
      <DOB>'.$DOB.'</DOB>
      <Email>'.$Email.'</Email>
      <MobileNo>'.$Mobile_Number.'</MobileNo>
      <Occupation>'.$emp_stat.'</Occupation>
      <CompanyName>'.$strcompanyName.'</CompanyName>
      <City>'.$City.'</City>
      <OtherCity>'.$City_Other.'</OtherCity>
      <Pincode>'.$Pincode.'</Pincode>
      <CardHolder>'.$cc_holder.'</CardHolder>
      <PrimaryAcc>'.$Primary_Acc.'</PrimaryAcc>
      <AnnualIncome>'.$annualincome.'</AnnualIncome>
      <AnnualTurnover>'.$annual_turnover.'</AnnualTurnover>
      <LoanRunning>'.$loanrunning.'</LoanRunning>
      <EMIPaid>'.$EMI_Paid.'</EMIPaid>
      <EMIAmt>'.$PL_EMI_Amt.'</EMIAmt>
      <LoanAmount>'.$loanamt.'</LoanAmount>
      <Feedback>'.$feedback.'</Feedback>
      <CardVintage>'.$Card_Vintage.'</CardVintage>
      <CardLimit>'.$cardlimit.'</CardLimit>
      <ip_address>'.$IP_Address.'</ip_address>
      <AvailableDocuments>'.$identification_proof.'</AvailableDocuments>
      <add_comment>'.$comments.'</add_comment>
      <doe>'.$curr_date.'</doe>
      <CompanyType>Pvt Ltd</CompanyType>
      <BankName>ICICI</BankName>
      <Customer_Type>'.$icicileadstat.'</Customer_Type>
      <Rate_of_Interest>rateofinterest</Rate_of_Interest>
      <Processing_Fees>processingfee</Processing_Fees>
      <EMI>emi</EMI>
      <Part_Payment>partpayment</Part_Payment>
      <Pre_Payment>prepayment</Pre_Payment>
    </InsertData>
  </soap:Body>
</soap:Envelope>';
  
echo $xmlstr."<br><br>";

//$url = 'http://123.252.223.4/IbnkWS/IbnkWS.asmx?WSDL';
//OLD http://123.252.223.4/IbnkWS/IbnkWS.asmx
//NEW http://123.252.223.4/IbnkWSN/IbnkWS.asmx

//$url = 'http://123.252.223.4/IbnkWS/IbnkWS.asmx';

$url = 'http://123.252.223.4/IbnkWSN/IbnkWS.asmx';
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));

$result = curl_exec($ch);
$info = curl_getinfo($ch);

//echo "<br><br>divide<br><br>";

curl_close($ch);

echo "<br><br>";
echo "<br><br>";


$webfeedback=$result;
echo "<br><br>";
echo "<br><br>";
//echo print_r($info);

$Dated = ExactServerdate();
$dataInsert = array('requestid'=>$RequestID, 'feedback'=>$webfeedback, 'doe'=>$Dated);
$insert = Maininsertfunc ('icicipl_webservice', $dataInsert);

if($Feedback_ID>0)
	{
	$dataUpdate = array('RequestID'=>$Feedback_ID);
	$wherecondition = "(Reply_Type='1' and Bank_Name like'%ICICI%' and BidderID=2924)";
	Mainupdatefunc ('Req_Compaign', $dataUpdate, $wherecondition);
	
	}
	}//while ends here
// They need to use XML parsing for further operation


}


main();

function main()
{
	ICICIpl();
}
   
?>

