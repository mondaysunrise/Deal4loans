<?php
	header("Location: earn-credit-card.php");
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$city = $_POST['city'];
		$From_Product = $_POST['From_Product'];
		$source= $_POST['source'];
		$url= $_POST['REFERER_URL'];
		$Accidental_Insurance=$_POST['Accidental_Insurance'];
		$IP = getenv("REMOTE_ADDR");
		$Dated = ExactServerdate();
	   $n       = count($From_Product);
	   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i],";
			 $i++;
		   }

//echo $name;
		   $_SESSION['CC_Bank']=$From_Pro;
		   $_SESSION['email']=$email;


//Code for Tataaig
function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, city, city_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ("select tataaigID,t_name,t_mobile,t_email,t_city,t_dated from get_tataaig_leads where tataaigID = $RequestID");
		
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;

		//$RowGetDate = mysql_fetch_array($GetDateSql);
		
		$TDated = $RowGetDate[$cntr]['t_dated'];
		$Tcity = $RowGetDate[$cntr]['t_city'];
		$Mobile = $RowGetDate[$cntr]['t_mobile'];
		$Product_Name = 7;
		
		//$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_city`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$Tcity."', '".$Mobile."' , Now())";
		//$query = mysql_query($Sql);
		
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		
		//echo $Sql;
		///exit();

	}
//code ends here


if(strlen($name)>0 && strlen($email)>0 && strlen($mobile)>0 && strlen($city)>0)
		{
	//echo "kh";
		//$getCcOffersDetails="INSERT INTO store_records_mailer (name,email,mobile,city,ccholder_bank,source,accidental_insurance,mailer_dated,mailerip,url)
		//Values ('".$name."','".$email."','".$mobile."','".$city."','".$From_Pro."','".$source."','".$Accidental_Insurance."',NOW(),'".$IP."','".$url."') ";
		
		$dataInsert = array("name"=>$name, "email"=>$email, "mobile"=>$mobile, "city"=>$city, "ccholder_bank"=>$From_Pro, "source"=>$source, "accidental_insurance"=>$Accidental_Insurance, "mailer_dated"=>$Dated, "mailerip"=>$IP, "url"=>$url);
$table = 'store_records_mailer';
$insert = Maininsertfunc ($table, $dataInsert);
		
		//$getCcOffersDetails_result=ExecQuery($getCcOffersDetails);
 //$last_inserted_id = mysql_insert_id();

if($Accidental_Insurance==1)
						{
	//$tataaigselect="INSERT INTO get_tataaig_leads (t_name,t_mobile,t_email,t_city,t_dated,t_source,t_ip) Values ('".$name."','".$mobile."','".$email."','".$city."',NOW(),'".$source."','".$IP."')";
	
	$dataInsert = array("t_name"=>$name, "t_mobile"=>$mobile, "t_email"=>$email, "t_city"=>$city, "t_dated"=>$Dated, "t_source"=>$source, "t_ip"=>$IP);
$table = 'get_tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
	
	//$tataaigselect_result=ExecQuery($tataaigselect);
	//echo $tataaigselect."<br><br>";
	$last_inserted_id = mysql_insert_id();

							$RequestID = $last_inserted_id;
							$ProductName = "get_tataaig_leads";
							InsertTataAig($RequestID, $ProductName);
						}
		}
	


$cc_bank=$From_Pro;


$cc_bank = substr(trim($cc_bank), 0, strlen(trim($cc_bank))-1);
$cc_bank=trim($cc_bank);
$getcc_bank=explode(",", $cc_bank);

//print_r($getcc_bank);

if(strlen($email)>0){
	$subject="Your Credit Card Offers - Deal4loans";
	$getcontent='<table width="605" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="110" height="235" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cards-mailer09jan/hdr1.gif" width="110" height="235" /></td>
<td width="126" height="235" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cards-mailer09jan/hdr2.gif" width="126" height="235" /></td>
<td width="112" height="235" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cards-mailer09jan/hdr3.gif" width="112" height="235" /></td>
<td width="121" height="235" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cards-mailer09jan/hdr4.gif" width="121" height="235" /></td>
<td  height="235" valign="top"><img src="http://www.deal4loans.com/emailer/cards-mailer09jan/hdr5.gif" width="137" height="235"></td>
</tr>
</table></td>
</tr>
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="1" bgcolor="#178ecb"></td>
<td width="603"><table width="603" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" align="left"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td>&nbsp;</td></tr>
<tr><td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#144a79; font-weight:bold; padding-left:3px; letter-spacing:-1px;" height="20">Dear Customer,</td></tr>
<tr>
<td valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; color:#051e33; padding-left:3px; text-align:justify;">Thanks for registering yourself with Deal4loans.com for the latest Credit Card Offers of ';
$getcontent.=$cc_bank;
$getcontent.='The latest card offers will be sent to your email id on month to month bases.

See the current offers on your ';
$getcontent.=$cc_bank;
$getcontent.=' credit card
</td>
</tr>
<tr><td>&nbsp;</td></tr>
';

for($i=0;$i<count($getcc_bank);$i++)
{
$getcc_data=("select * from creditndebit_card_offer where ( bank_name like '%".$getcc_bank[$i]."%' and ccndc_approval=1 and ccndc_offer_type=1)");

 list($recordcount,$row)=MainselectfuncNew($getcc_data,$array = array());
		$k=0;
while($k<count($row))
        {
$cc_bankname=$row[$k]['bank_name'];
$cc_content=$row[$k]['ccndc_features'];
$card_name=$row[$k]['card_name'];

$getcontent.='<tr>
<td height="25" align="left" style="background-color:#e6f4fc; border-left:4px solid #3589b8; color:#013552; font-size:13px; font-weight:bold; text-indent:5px;">';
$getcontent.=$cc_bankname."&nbsp;:&nbsp;".$card_name;
$getcontent.='</td>
</tr>
<tr><td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px;  color:#062a4a;  text-align:justify;">';
$getcontent.=$cc_content;
'</td></tr>';
$k = $k +1;
}
}
$getcontent.='            </table></td>
<td width="192" height="101" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
<td valign="top">
<form  name="CC_offers_mailer" action="http://www.deal4loans.com/emailer/cc-mailer09.php" method="POST"><table width="190" border="0" align="left" cellpadding="0" cellspacing="0">
<tr>
<td width="1" bgcolor="#178ecb"></td>
<td valign="top"></td>
<td bgcolor="#178ecb" width="1"></td>
</tr>

</table></form></td>
</tr>
<tr>
<td width="190" height="27" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cards-mailer09jan/test-hd.gif" width="190" height="27" /></td>
</tr>

<tr>
<td><table width="190" border="0" align="left" cellpadding="0" cellspacing="0">
<tr>
<td width="1" bgcolor="#178ecb"></td>
<td valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; color:#051e33; padding:4px; text-align:left; "><p>The entire information  about loans &amp; credit card is really relevant. wish you good luck &amp; keep  going.</p>
<b style="float:right;"> - Saurabh Shukla</b></td>
<td width="1" bgcolor="#178ecb"></td>
</tr>
</table></td>
</tr>
<tr>
<td width="190" height="25" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cards-mailer09jan/test-ftr.gif" width="190" height="22" /></td>
</tr>

</table></td>
</tr>
</table></td>
<td width="1" bgcolor="#178ecb"></td>
</tr>
</table></td>
</tr>
<tr><td bgcolor="#2A84DA"><table width="100%"><tr><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="20" align="center"><a href="http://www.deal4investments.com" style="color:#FFFFFF;">Deal4investments.com</a></td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="15" align="center">|</td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="20" align="center"><a href="http://www.askamitoj.com" style="color:#FFFFFF;">Debt consolidation</a></td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="15" align="center">|</td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="20" align="center"><a href="http://www.bimadeals.com" style="color:#FFFFFF;">Bimadeals.com</a></td></tr></table></td></tr>
<tr>
<td width="605" align="center" valign="top"><img src="http://www.deal4loans.com/emailer/cards-mailer09jan/ftr-brdr.gif" width="605" height="22" /></td>
</tr>
</table>';
$headers  = 'From: Credit Card Offers<no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	if(strlen($email)>0)
	mail($email,$subject, $getcontent, $headers);
}
	}

	?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Credit Cards| Credit Cards India| Credit Cards Apply| Credit Cards Compare | Deal4Loans - Compare Apply</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="credit cards online information, credits cards schemes, credit card benefits, discounts on credits cards, compare credit cards in india, best credit card providers, apply online for credit cards, credit cards, credit card plans, online credit card, convenient credit card, Co branded credit cards, free credit cards">
<meta name="Description" content="Get online information on best credit cards in India. We also provide information on different credit card schemes. This information will help you to compare credit card features like service charges, annual fees, add on cards, interest free credit period, zero liability on lost cards, free insurance coverage etc.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
<div id="txt">	

   <h1 class="pg_heading" align="center">Credit Card Offers for Nov 09 </h1>
   
   <table border="0" cellpadding="0">
       <tr>
         <td style="color:#062a4a; line-height:17px; padding-bottom:8px;">
<b>		 Dear <? echo $name;?>,</b><br>
Thanks for registering yourself with Deal4loans.com for the latest Credit card offers of <? echo $cc_bank;?> . The latest card offers will be sent to your email id on month to month bases. See the current offers on your credit card 	 </td>
       </tr>
	   <?php 
$i=0;
		for($i=0;$i<count($getcc_bank);$i++)
		{
		$getcc_data=("select * from creditndebit_card_offer where ( bank_name ='".$getcc_bank[$i]."' and ccndc_approval=1 and ccndc_offer_type=1)");
		//echo "select * from monthly_creditcard_offer where compare_value like '%".$getcc_bank[$i]."%'";

 list($recordcount,$row)=MainselectfuncNew($getcc_data,$array = array());
		$n=0;

while($n<count($row))
        {

	$cc_bankname=$row[$n]['bank_name'];
	$cc_content=$row[$n]['ccndc_features'];
	$card_name = $row[$n]['card_name'];
?>
	<tr>
		<td height="25" style="background-color:#e6f4fc; border-left:4px solid #3589b8; color:#013552; font-size:13px; font-weight:bold; text-indent:5px;"><? echo $cc_bankname;?> &nbsp;:&nbsp; <? echo $card_name;?></td>
	</tr>
	<tr><td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px;  color:#062a4a;  text-align:justify;"><? echo $cc_content;?><br></td></tr>
<?  $n = $n +1;}
		}
?>
			  
                   
                 
     </table>   




<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="new-images/top.gif"/></a></div>


   </div></div></div>
	<? include '~Right-new.php'; ?>

<? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom-new.php';?><? } ?> </div>
  </body>
</html>