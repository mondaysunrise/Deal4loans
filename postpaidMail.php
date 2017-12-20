<?php
//This file is not required Please cross check
require 'scripts/db_init.php';
//require 'scripts/db_init-rnew.php';
require 'scripts/functions.php';

$GetBankID = '1060,1000,1537';
$CustomerID = 496387; 
$Product = 1;


echo SendMailToCustomers($GetBankID,$CustomerID,$Product);


//function getTableName Start
function getTableName($pKey)
{
    $titles = array(
        1=> 'Req_Loan_Personal',
        2=> 'Req_Loan_Home',
        3=> 'Req_Loan_Car',
        4=> 'Req_Credit_Card',
        5=> 'Req_Loan_Against_Property',
        6=> 'Req_Business_Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}
//function getTableName End

function getforemailer($pKey){
    $titles = array(
        '1' => 'Personal Loan',
        '2' => 'Home Loan',
        '3' => 'Car Loan',
        '4' => 'Credit Card',
        '5' => 'Loan Against Property',
        '6' => 'Business Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function SendMailToCustomers($GetBankID,$CustomerID,$Product)
{
	$GetBidderID = explode(',',$GetBankID);
	$ExpBidderName = "";
	$ExpBidderContact="";
	for($bid=0;$bid<count($GetBidderID);$bid++)	
	{
		$GetBankSql = "select Bidders_List.BidderID AS biddrbid,BankID,Banker_Contact,Bidder_Contact_To_Customers.BidderID AS contbid from Bidders_List LEFT OUTER JOIN Bidder_Contact_To_Customers ON Bidder_Contact_To_Customers.BidderID=Bidders_List.BidderID AND Bidder_Contact_To_Customers.Sms_Flag=1 and Bidder_Contact_To_Customers.Reply_Type=".$Product." where (Bidders_List.BidderID =".$GetBidderID[$bid]." and Bidders_List.Reply_Type =".$Product." )";
		
		 list($GetBankCount,$getrow)=MainselectfuncNew($GetBankSql,$array = array());
		$cntr=0;
		
		
		$NameID = $getrow[$cntr]['BankID'];
		$BankerContact = $getrow[$cntr]['Banker_Contact'];

		if($GetBankCount>0)
		{
			$GetBank_Sql = "select * from Bank_Master where BankID  = ".$NameID ."";
			list($GetBankCount,$Myrow)=MainselectfuncNew($GetBank_Sql,$array = array());
			$i=0;
			
			$BidderName = $Myrow[$i]['Bank_Name'];
			$ExpBidderName[] = $BidderName;
			$ExpBidderContact[] = $BankerContact;
			$bdrBidderID = $getrow[$cntr]['biddrbid'];
			$arrbiddrbid[] = $bdrBidderID;

		}
	}

	$Bank_Name = "";
	for($exp=0;$exp<count($ExpBidderName);$exp++)
	{	
		$Count = $exp +1;
		$GetExpBidderContact=" - ".$ExpBidderContact[$exp];
		$Bank_Name[] = "<b>".$ExpBidderName[$exp]."".$GetExpBidderContact."</b><br>";

	}
	$FinalBidderName = implode('',$Bank_Name);
	
	//echo "ranjana2 : " ;
	//print_r($ExpBidderName);
	
	$getproductforemailer=getforemailer($Product);
		
	$TableName = getTableName($Product);
	if($Product==1)
	{
		$GetCustIDSql = "select PL_Tenure,Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	else if($Product==3)
	{
	$GetCustIDSql = "select Account_No,Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	else
	{
		$GetCustIDSql = "select Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	
	list($GetBankCount,$Arrrow)=MainselectfuncNew($GetCustIDSql,$array = array());
			$J=0;
	
	$full_name = $Arrrow[$J]['Name'];
	$email  = $Arrrow[$J]['Email'];
	$city  = $Arrrow[$J]['City'];
	$Net_Salary  = $Arrrow[$J]['Net_Salary'];
		 
	if($city == "Others")
	{
		$city  = $Arrrow[$J]['City_Other'];
	}
	$mobile_no  = $Arrrow[$J]['Mobile_Number'];

	if($Product==1)
	{
		$Account_No  = $Arrrow[$J]['PL_Tenure'];
	}
	else if($Product==3)
	{
		$Account_No  = $Arrrow[$J]['Account_No'];
	}
	
	
	if(((strlen($email)) > 0) && (count($ExpBidderName)>0) ) 
	{
		if($Product==1)
		{
			if($Net_Salary>=240000 && (count($ExpBidderName)>1))
			{
			$full_name = "Upendra Kumar";
				$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  $full_name,</b></p> 
<p>
Thank you for choosing Deal4loans.com, we are pleased to inform you
that your registration for $getproductforemailer has been successful and we
have forwarded your request to the following $getproductforemailer bank service providers:</p>
<p> <table cellpadding='0' cellspacing='0' border='1'>
<tr>
<td height='27' bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Name</td>
<td  bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Bank Contact</td>
<td bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'></td></tr>";

for($m=0; $m <count($ExpBidderName);$m++)
		{
	$definetypw=("select Define_PrePost from Bidders Where (BidderID=".$arrbiddrbid[$m].")");
	
	 list($recordcount,$defrow)=MainselectfuncNew($definetypw,$array = array());
		$K=0;
	if($defrow[$K]['Define_PrePost'] == "PostPaid")
			{
			
	
	$Message .= "<tr>
<td width='106' height='24' valign='top' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderName[$m]."<br>".$ExpBidderContact[$m]."</td>
<td width='210' valign='top' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; padding:2px; text-align:center;'>";

  $Message .= "<a href='http://www.deal4loans.com/upload-documents.php?pl_requestid=".$CustomerID."&source=mailer&b_id=".$arrbiddrbid[$m]."' target='_blank' style='text-decoration: none;'><img src='http://www.deal4loans.com/new-images/upload.gif' border='0' /></a><br>This will help in faster processing.<br>Upload all documents you can<br>Rest will be collected by team. ";
  
  $Message .= "</td><td width='394' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '>";
 if(($ExpBidderName[$m]=="HDFC" || $ExpBidderName[$m]=="Standard Chartered" || $ExpBidderName[$m]=="Citibank") && $Account_No=='')
				{
 $Message .= "<a href='http://www.deal4loans.com/apply-personal-loans-continue-thank.php?requestid=".$CustomerID."&salary_acc=".$ExpBidderName[$m]."' target='_blank' style='text-decoration: none;'>If you have salary account with the corresponding Bank - Please share your account number. <b>CLICK HERE</b> <br>1) This will help Bank to process your loan faster. <br>2) They may be able to give you discount based on your account number.<br> 3)They may have special pre-approved offer for you based on your account</a>";
  }
  $Message .= "</td></tr>";
				
		
			}
			else
			{
				$Message.="<tr>
<td  height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderName[$m]."</td>
<td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderContact[$m]."</td><td>&nbsp;</td>
</tr>";
			}
		}

$Message.="</table><br><br>
You will receive calls within 24 hours from the Companies executives,
you can compare the rates & choose the best deal. <br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3)	Apply to the bank which provides you the best offer.<br />
<br />
<b>Please ensure that you process your application with the concerned bank respective only. Do not entertain multiple offers from one single person, compare yourself and choose the best. <br><br>Deal4loans do not sell any loans on its own. We act as a comparison online platform to choose the best deal.
For any product, process related issue please contact your Bank where you have submitted your application</b>
<br><br>
<font style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the bank's sales representative.</b></font></p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td align='center' valign='middle' style= 'color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.in?source=d4l-sendnow'style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
			}
			else if($Net_Salary<240000 && (count($ExpBidderName)==1) && $ExpBidderName[0]=="Fullerton")
			{
	$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  $full_name,</b></p> 
<p>
Thank you for choosing Deal4loans.com, we are pleased to inform you
that your registration for $getproductforemailer has been successful and we
have forwarded your request to the following $getproductforemailer bank service providers:</p>";
$FinalBidder_Name = explode(' ',$FinalBidderName);
$Message .="<p><table cellpadding='0' cellspacing='1' bgcolor='#000000' width='540'><tr><td valign='top' height='24' bgcolor='#ffffff' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px; padding:2px; text-align:center;'><b>Bank Name</b></td><td valign='top' bgcolor='#ffffff' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px; padding:2px; text-align:center;'><b>Contact Number</b></td><td valign='top' bgcolor='#ffffff' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px; padding:2px; text-align:center;'><b>Online Application</b></td></tr><tr><td valign='top' bgcolor='#ffffff' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; padding:4px; text-align:center;'><b>".$FinalBidder_Name[0]."</b></td><td valign='top' bgcolor='#ffffff' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; padding:4px; text-align:center;'><b>".$FinalBidder_Name[2]."</b></td><td  height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; padding:7px; text-align:left;'  valign='top' bgcolor='#ffffff'><a href='http://www.deal4loans.com/upload-documents.php?pl_requestid=".$CustomerID."&source=mailer' target='_blank' style='text-decoration: none;'><img src='http://www.deal4loans.com/new-images/upload.gif' border='0' /></a><br>This will help in faster processing.<br>Upload all documents you can<br>Rest will be collected by Fullerton team. </td>
</tr>";			
$Message.="</table></p>";

$Message .="<p><br />
You will receive calls within 24 hours from the Companies executives,
you can compare the rates & choose the best deal. <br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3)	Apply to the bank which provides you the best offer.<br />
<br />
<b>Please ensure that you process your application with the concerned bank respective only. Do not entertain multiple offers from one single person, compare yourself and choose the best. <br><br>Deal4loans do not sell any loans on its own. We act as a comparison online platform to choose the best deal.
For any product, process related issue please contact your Bank where you have submitted your application</b>
<br><br>
<font style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the bank's sales representative.</b></font></p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td align='center' valign='middle' style= 'color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.in?source=d4l-sendnow'style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
				
					
				
				
			}
			else
			{
$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  $full_name,</b></p> 
<p>
Thank you for choosing Deal4loans.com, we are pleased to inform you
that your registration for $getproductforemailer has been successful and we
have forwarded your request to the following $getproductforemailer bank service providers:</p>
<p>
<b>".$FinalBidderName."</b><br /><br />
You will receive calls within 24 hours from the Companies executives,
you can compare the rates & choose the best deal. <br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3)	Apply to the bank which provides you the best offer.<br />
<br />
<b>Please ensure that you process your application with the concerned bank respective only. Do not entertain multiple offers from one single person, compare yourself and choose the best. <br><br>Deal4loans do not sell any loans on its own. We act as a comparison online platform to choose the best deal.
For any product, process related issue please contact your Bank where you have submitted your application</b>
<br><br>
<font style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the bank's sales representative.</b></font></p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td align='center' valign='middle' style= 'color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.in?source=d4l-sendnow'style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
	}
		}
	else if($Product==3)
	{
	$Message="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  ".$full_name.",</b></p> 
<p>
Thank you for choosing Deal4loans.com, we are pleased to inform you
that your registration for ".$getproductforemailer." has been successful and we
have forwarded your request to the following ".$getproductforemailer." bank service providers:</p>
<p> <table cellpadding='0' cellspacing='0' border='1'>
<tr>
<td  height='27' bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Name</td>
<td bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Contact</td>
<td bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'></td></tr>";
for($m=0; $m <count($ExpBidderName);$m++)
			{
	if($ExpBidderName[$m]=="HDFC")
				{
		$Message.="<tr>
<td width='106' height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderName[$m]."</td>
<td width='210' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderContact[$m]."</td>
<td width='394' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '><a href='http://www.deal4loans.com/apply-car-loans-continue.php?requestid=".$CustomerID."&salary_acc=".$ExpBidderName[$m]."' target='_blank' style='text-decoration: none;'>If you have salary account with the corresponding Bank - Please share your account number. <b>CLICK HERE</b> <br>
1) This will help Bank to process your loan faster. <br>
2) They may be able to give you discount based on your account number.<br> 3)They may have special pre-approved offer for you based on your account</a></td>
</tr>";
		
				}
				else
				{
					$Message.="<tr>
<td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderName[$m]."</td>
<td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderContact[$m]."</td><td style='border-left:none;'></td>

</tr>";
				}
				
			}
$Message.="</table><br>You will receive calls within 24 hours from the Companies executives,
you can compare the rates & choose the best deal. <br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3)	Apply to the bank which provides you the best offer.<br />
<br />
<b>Please ensure that you process your application with the concerned bank respective only. Do not entertain multiple offers from one single person, compare yourself and choose the best. <br><br>Deal4loans do not sell any loans on its own. We act as a comparison online platform to choose the best deal.
For any product, process related issue please contact your Bank where you have submitted your application</b>
<br><br>
<font style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the bank's sales representative.</b></font></p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td align='center' valign='middle' style= 'color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.in?source=d4l-sendnow'style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
		}
		else
		{ 
			$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  ".$full_name.",</b></p> 
<p>
Thank you for choosing Deal4loans.com, we are pleased to inform you
that your registration for ".$getproductforemailer." has been successful and we
have forwarded your request to the following ".$getproductforemailer." bank service providers:</p>
<p>
<b>".$FinalBidderName."</b><br /><br />
You will receive calls within 24 hours from the Companies executives,
you can compare the rates & choose the best deal. <br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3)	Apply to the bank which provides you the best offer.<br />
<br />
<b>Please ensure that you process your application with the concerned bank respective only. Do not entertain multiple offers from one single person, compare yourself and choose the best. <br><br>Deal4loans do not sell any loans on its own. We act as a comparison online platform to choose the best deal.
For any product, process related issue please contact your Bank where you have submitted your application</b>
<br><br>
<font style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the bank's sales representative.</b></font></p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td align='center' valign='middle' style= 'color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.in?source=d4l-sendnow'style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
		}
$messagecc="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  $full_name,</b></p> <p>Thank you for choosing Deal4loans.com, we are pleased to inform you that your registration for $getproductforemailer has been successful and we have forwarded your request to the following $getproductforemailer providers:</p><p><b>".$FinalBidderName."</b><br /> You will receive calls within 24 hours from the Companies executives, you can compare the rates &amp; choose the best deal.</p></td></tr><tr><td>&nbsp;</td></tr><tr>
  <td>&nbsp;</td>
</tr><tr><td><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style=' font-family:Verdana;  color:#ffffff; '>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Quiz</a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Guru </a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.in?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//$headers .= 'To: '.$full_name.' ' . "\r\n";
	$headers .= 'From: deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	//$headers .= 'Bcc: extra4testing@gmail.com' . "\r\n";
	//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//	$email="ranjana5chauhan@gmail.com";
	$email="tech@deal4loans.com";
	 echo $Message;
	if($Product==4)
	{

		//if($email == "ranjana5chauhan@gmail.com")
		//{
			mail($email,'Thanks for Registering for '.$getproductforemailer.' on deal4loans.com', $messagecc, $headers);
		//}
	}
	else
	{
		mail($email,'Thanks for Registering for '.$getproductforemailer.' on deal4loans.com', $Message, $headers);
	}
	
	}

	//echo $Message;	
}	
?>