<?php
//error_reporting(E_ALL);
require 'scripts/db_init.php';

function ICICIcc()
{
$curr_date2 = date("Y-m-d");
$curr_date1 = date("H:i:s");
$curr_date = $curr_date2."T".$curr_date1;
	//code starts
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type=4 and Bank_Name like'%ICICI Bank%' and BidderID=3667)";
list($numrow1,$row1)=MainselectfuncNew($query1,$array = array());
 $requestid= $row1[0]["RequestID"];


If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT
* FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID in (3662,3663,3664,3665,3666,3778,3820,3821,3822,3823,4499,4500,4501,4502,4503) and (Req_Feedback_Bidder_CC.Allocation_Date between '".$mindate."' and '".$maxdate."')";
	}
	else
	{
	$query="SELECT * FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID  in (3662,3663,3664,3665,3666,3778,3820,3821,3822,3823,4499,4500,4501,4502,4503) and Req_Feedback_Bidder_CC.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_CC.Allocation_Date between '".$mindate."' and '".$maxdate."')";
}

//$query="SELECT * FROM Req_Credit_Card WHERE RequestID=691935";

// fetch leads from database
echo $query."<br>";
list($recordcount,$row)=MainselectfuncNew($query,$array = array());
	for($i=0;$i<$recordcount;$i++)
	{
	$bidderid = $row[$i]["BidderID"];
	$Feedback_ID = $row[$i]["Feedback_ID"];
	$RequestID = $row[$i]["RequestID"];
	$Name = $row[$i]["Name"];
	$dateDOB = $row[$i]["DOB"];
	$Email = $row[$i]["Email"];
	$Mobile_Number = $row[$i]["Mobile_Number"];
	$Employment_Status = $row[$i]["Employment_Status"];
	if($Employment_Status==1){ $emp_stat="Salaried";} else {$emp_stat="Self Employed";}
		$Company_Name = $row[$i]["Company_Name"];
		$strcompany_Name = substr($Company_Name, 0, 40);
		$City = $row[$i]["City"];
		$City_Other = $row[$i]["City_Other"];
		$Pincode = $row[$i]["Pincode"];
		$CC_Holder = $row[$i]["CC_Holder"];
	if($CC_Holder==1){ $cc_holder="Yes";} else { $cc_holder="No";}
		$Primary_Acc = $row[$i]["Primary_Acc"];
		$Net_Salary = $row[$i]["Net_Salary"];
		list($netsal,$larest) = split('[.]',$Net_Salary);
		$Card_Vintage = $row[$i]["Card_Vintage"];
		if($Card_Vintage==1)	{	$card_vintage="Less than 6 months";}
			elseif($Card_Vintage==2)	{	$card_vintage="6 to 9 months";}
		elseif($Card_Vintage==3)	{	$card_vintage="9 to 12 months";}
		elseif($Card_Vintage==4)		{	$card_vintage="more than 12 months";}
		else	{	$card_vintage="";	}
		$No_of_Banks = $row[$i]["No_of_Banks"];
		$Residence_Address = $row[$i]["Residence_Address"];
		$Salary_Account = $row[$i]["Salary_Account"];
		$IP_Address = $row[$i]["IP_Address"];
		$Pancard=$row[$i]["Pancard"];
		$DOE = Date('Y-m-d H:i:s');
		$applied_card_name = $row[$i]["applied_card_name"];
		$arrcardname=explode(",",$applied_card_name);
		$findme   = 'ICICI';
		for($ar=0;$ar<count($arrcardname);$ar++)
			{
				$pos = strpos($arrcardname[$ar], $findme);	
				if(strlen($pos)>0)
				{
					$cardname=$arrcardname[$ar];
				}
			}
		echo "<br>".$cardname."<br>";
$param["Name"]=$Name;
$param["DOB"]="11/11/1980";
$param["Email"]=$Email;
$param["Occupation"]=$emp_stat;
$param["CompanyName"]=$Company_Name;
$param["City"]=$City;
$param["CityOther"]=$City_Other;
$param["MobileNo"]=$Mobile_Number;
$param["StdCode"]="022";
$param["Landline"]="25914513";
$param["AnnualIncome"]=$netsal;
$param["CardHolder"]=$cc_holder;
$param["Feedback"]="test";
$param["LeadStatus"]="test";
$param["Pancard"]=$Pancard;
$param["PancardNumber"]="123658G78";
$param["AlredyCardHolderOfBank"]=$No_of_Banks;
$param["CardVintage"]=$card_vintage;
$param["CreditLimit"]="2000000";
$param["doe"]=$DOE;
$param["Comments"]="test";
$param["AccountNo"]="123654987";
$param["CardName"]=$cardname;
$param["ExistingRelation"]="No";
$param["SalaryAcc"]=$Salary_Account;
$param["ResiAddress"]="Residence Address";

$url = 'http://123.252.223.4/mobileapp_nca/sms.aspx';
$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		//$request = rawurldecode(substr($request, 0, strlen($request)-1)); //remove the final ampersand sign from the request
		$request = substr($request, 0, strlen($request)-1);
		echo $request."<br><br>";
		$url = "http://123.252.223.4/mobileapp_nca/sms.aspx?".$request;
		echo $url;
		echo "<br>";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec ($ch);
		print_r($content); 
		curl_close ($ch);
		echo "<br>";
		echo $outputstr=trim(strip_tags($content));
		echo "<br>";

echo "<br><br>";

$Dated = ExactServerdate();
$dataInsert = array('requestid'=>$RequestID, 'feedback'=>$outputstr, 'dated'=>$Dated,'bidderid'=>$bidderid);
$insert = Maininsertfunc ('icicipl_webservice', $dataInsert);
if($Feedback_ID>0)
{
	$dataUpdate = array('RequestID'=>$Feedback_ID);
	$wherecondition = "(Reply_Type=4 and Bank_Name like'%ICICI Bank%' and BidderID=3667)";
	Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
}
	}//while ends here
// They need to use XML parsing for further operation
}

main();

function main()
{
	ICICIcc();
}
   
?>

