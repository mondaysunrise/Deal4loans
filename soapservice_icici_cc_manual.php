<?php
//This file is not required
//error_reporting(E_ALL);
require 'scripts/db_init.php';

function ICICIcc()
{

	$query="SELECT * FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID  in (3662,3663,3664,3665,3666,3778,3820,3821,3822,3823,4499,4500,4501,4502,4503) and Req_Feedback_Bidder_CC.Feedback_ID in (1463254,1461069) and (Req_Feedback_Bidder_CC.Allocation_Date between '2014-06-01 00:00:00' and '2014-07-01 23:59:59')";

//$query="SELECT * FROM Req_Credit_Card WHERE RequestID=691935";

// fetch leads from database
echo $query."<br><br>";
$result = ExecQuery($query);
$recordcount = mysql_num_rows($result);
while($row=mysql_fetch_array($result))
	{
	echo $query."<br>";
$result = ExecQuery($query);
$recordcount = mysql_num_rows($result);
while($row=mysql_fetch_array($result))
	{
	$bidderid = $row["BidderID"];
	$Feedback_ID = $row["Feedback_ID"];
	$RequestID = $row["RequestID"];
	$Name = $row["Name"];
	$dateDOB = $row["DOB"];
	$Email = $row["Email"];
	$Mobile_Number = $row["Mobile_Number"];
	$Employment_Status = $row["Employment_Status"];
	if($Employment_Status==1){ $emp_stat="Salaried";} else {$emp_stat="Self Employed";}
		$Company_Name = $row["Company_Name"];
		$strcompany_Name = substr($Company_Name, 0, 40);
		$City = $row["City"];
		$City_Other = $row["City_Other"];
		$Pincode = $row["Pincode"];
		$CC_Holder = $row["CC_Holder"];
	if($CC_Holder==1){ $cc_holder="Yes";} else { $cc_holder="No";}
		$Primary_Acc = $row["Primary_Acc"];
		$Net_Salary = $row["Net_Salary"];
		list($netsal,$larest) = split('[.]',$Net_Salary);
		$Card_Vintage = $row["Card_Vintage"];
		if($Card_Vintage==1)	{	$card_vintage="Less than 6 months";}
			elseif($Card_Vintage==2)	{	$card_vintage="6 to 9 months";}
		elseif($Card_Vintage==3)	{	$card_vintage="9 to 12 months";}
		elseif($Card_Vintage==4)		{	$card_vintage="more than 12 months";}
		else	{	$card_vintage="";	}
		$No_of_Banks = $row["No_of_Banks"];
		$Residence_Address = $row["Residence_Address"];
		$Salary_Account = $row["Salary_Account"];
		$IP_Address = $row["IP_Address"];
		$Pancard=$row["Pancard"];
		$DOE = Date('Y-m-d H:i:s');
		$applied_card_name = $row["applied_card_name"];
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
$param["ResiAddress"]="Residence_Address";

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


$Dated = ExactServerdate();
$dataInsert = array('requestid'=>$RequestID, 'feedback'=>$outputstr, 'dated'=>$Dated,'bidderid'=>$bidderid);
$insert = Maininsertfunc ('icicipl_webservice', $dataInsert);
	}//while ends here
// They need to use XML parsing for further operation
}
}

main();

function main()
{
	ICICIcc();
}
   
?>

