<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

session_start();

$type=$_REQUEST['type'];
$city=$_REQUEST['city'];

getEligibleBidders1($type,$city,"9810316335");
	
// personal, home, car, cc, property, insurance
function getEligibleBidders1($strProduct, $strCity, $Phone)
{
	$SMSMessage="Dear user, here are the contacts of Banks/DSA for your request on deal4loans : ";
	$SMSMessageBidders="";
	$ctr=1;
	$mvarType = getCodeValue("ReplyType_$strProduct");
	$mvarCity = strtoupper($strCity);

	echo "mavrType : ".$mvarType."<BR>";
	echo "mvarCity : ".$mvarCity."<BR>";

	$strSQL = "SELECT Bidder_Bank, Bidder_Contact, Bidder_Number FROM Eligible_Bidder_List WHERE City LIKE '%".$mvarCity."%' AND Reply_Type=".$mvarType." AND IsValid=1";


		list($numRowsCarName,$myrow)=Mainselectfunc($strSQL,$array = array());
			$mvar_Bidder_Bank=$myrow["Bidder_Bank"];
			$mvar_Bidder_Contact=$myrow["Bidder_Contact"];
			$mvar_Bidder_Number=$myrow["Bidder_Number"];

			echo "mvar_Bidder_Bank : ".$mvar_Bidder_Bank."<BR>";
			echo "mvar_Bidder_Contact : ".$mvar_Bidder_Contact."<BR>";
			echo "mvar_Bidder_Number : ".$mvar_Bidder_Number."<BR>";

			$SMSMessageBidders=$SMSMessageBidders."(".$ctr.") ".$mvar_Bidder_Bank."-".$mvar_Bidder_Contact."-".$mvar_Bidder_Number." ";
			$ctr=$ctr+1;
	
	
	if(strlen(trim($SMSMessageBidders))>0)
	{
		echo $SMSMessage.$SMSMessageBidders."<BR>";
//		if(strlen(trim($Phone)) > 0)
//			SendSMS($SMSMessage.$SMSMessageBidders, $Phone);

	}
}

?>

