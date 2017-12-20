<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$last_id = $_POST['last_id'];
	$name = $_POST['name'];
	$card_type_cc = $_POST['card_type_cc'];
	$card_type_dc = $_POST['card_type_dc'];

	//echo "//////////////////////// Credit Card /////////////////////////////////////<br>";
	if(isset($card_type_cc))
	{
		$category_cc = $_POST['category_cc'];
		$countCC = count($category_cc);
		$cc_Details = "";
		$bankNameCC_Arr = "";
		$cardID_Arr = "";
		for($i=0;$i<$countCC;$i++)
		{
			$cc_Details = $category_cc[$i];
			$exp_cc_Details = explode("_", $cc_Details);
			$bankName = $exp_cc_Details[1];
			
			$ccardTypeID = $exp_cc_Details[0];
			$getCardNameSql = "select card_name from creditndebit_card_offer where ccndc_offerid='".$ccardTypeID."'";
		//	echo "Credit card"."select card_name from creditndebit_card_offer where ccndc_offerid='".$ccardTypeID."'";

			list($alreadyExist,$getCardNameQuery)=MainselectfuncNew($getCardNameSql,$array = array());
			$myrowcontr=count($getCardNameQuery)-1;
			$ccardTypeName = $getCardNameQuery[0]['card_name'];
			$cc_offers = $_POST['category_cc_'.$ccardTypeID];
			
			//if(count($cc_offers)>0)
			if($ccardTypeID>0)
			{
				$bankNameCC_Arr[] = $bankName;
				$cardID_Arr[] = $ccardTypeID;
				$imp_cc_offers = implode(",", $cc_offers);
				$dataInsert = array('bank_name'=>$bankName, 'card_id'=>$ccardTypeID, 'card_name'=>$ccardTypeName, 'card_offers'=>$imp_cc_offers, 'user_id'=>$last_id, 'card_type'=>$card_type_cc);
				$insert = Maininsertfunc ("store_mailer_cards", $dataInsert);
			}
		}
		$uniqueBanks = array_unique($bankNameCC_Arr);
		$imp_uniqueBanks = implode(",",$uniqueBanks);
		
		$cardID = implode(",",$cardID_Arr);
		$dataUpdate = array('ccholder_bank'=>$imp_uniqueBanks, 'cc_card_id'=>$cardID);
		$wherecondition = "(mailerid ='".$last_id."')";
		Mainupdatefunc ('store_records_mailer', $dataUpdate, $wherecondition);
	}
	//echo "<br>//////////////////////// Credit Card /////////////////////////////////////<br>";
	//echo "<br>//////////////////////// Debit Card /////////////////////////////////////<br>";
	if(isset($card_type_dc))
	{
		//echo "debit card enter: <br><br>";
		$category_dc = $_POST['category_dc'];
		//print_r($category_dc);
		$countDC = count($category_dc);
		//echo $countDC."<br>";
		$dc_Details = "";
		$bankNameDC_Arr = "";
		$cardID_Arr = "";
		for($i=0;$i<$countDC;$i++)
		{
			$dc_Details = $category_dc[$i];
			$exp_dc_Details = explode("_", $dc_Details);
			$bankName = $exp_dc_Details[1];
			$dcardTypeID = $exp_dc_Details[0];
			$getDebitNameSql = "select card_name from creditndebit_card_offer where ccndc_offerid='".$dcardTypeID."'";
			//	echo "select card_name from creditndebit_card_offer where ccndc_offerid='".$dcardTypeID."'";
			list($alreadyExist,$getDebitNameQuery)=MainselectfuncNew($getDebitNameSql,$array = array());
			$myrowcontr=count($getCardNameQuery)-1;
			$dcardTypeName = $getCardNameQuery[0]['card_name'];
			$dc_offers = $_POST['category_dc_'.$dcardTypeID];
		//	print_r($dc_offers)."<br>";
			
			//if(count($dc_offers)>0)
			if($dcardTypeID>0)
			{
				//echo "hello";
				$bankNameDC_Arr[] = $bankName;
				$cardID_Arr[] = $dcardTypeID;
				$imp_dc_offers = implode(",", $dc_offers);
				$dataInsert = array('bank_name'=>$bankName, 'card_id'=>$dcardTypeID, 'card_name'=>$dcardTypeName, 'card_offers'=>$imp_dc_offers, 'user_id'=>$last_id, 'card_type'=>$card_type_dc);
				$insert = Maininsertfunc ("store_mailer_cards", $dataInsert);
			}
		}
		$uniqueBanks = array_unique($bankNameDC_Arr);
		$imp_uniqueBanks = implode(",",$uniqueBanks);
		$cardID = implode(",",$cardID_Arr);
		$dataUpdate = array('dcholder_bank'=>$imp_uniqueBanks, 'dc_card_id'=>$cardID);
		$wherecondition = "(mailerid ='".$last_id."')";
		Mainupdatefunc ('store_records_mailer', $dataUpdate, $wherecondition);
	}		
	//echo "<br>//////////////////////// Debit Card /////////////////////////////////////<br>";
	//CREATE TABLE `store_mailer_cards` (`m_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,`bank_name` VARCHAR( 100 ) NOT NULL ,`card_id` INT NOT NULL ,`card_name` VARCHAR( 120 ) NOT NULL ,`card_offers` VARCHAR( 255 ) NOT NULL ,`user_id` INT NOT NULL ,`card_type` TINYINT NOT NULL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
<style type="text/css">
.content{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	vertical-align:top; }

.content table td
	{ font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	vertical-align:top; }


.nrmltxt{
	text-decoration:none;
	color:#4d4d4d;
	font-weight:normal;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px;
}
.bldtxt img{
	margin-right:6px;
	vertical-align:middle;
}

.bldtxt{
	text-decoration:none;
	line-height:20px;
	padding-left:8px;
	color:#7b4501;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px;
}

.bnkbg{
	background-color:#fff1e0; 
	border-left:5px solid #7b4501; 
	padding-left:8px;
	margin-top:10px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#7b4501;
	font-weight:bold;
	line-height:30px;

}
	.bldtxt1 {	text-decoration:none;
	line-height:20px;
	padding-left:8px;
	color:#7b4501;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px;
}

</style>
</head>
<body>
<!--top-->
<?php include "middle-menu.php"; ?>
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;">Credit Card</a> > <span class="text12" style="color:#4c4c4c;">Apply Credit Card</span></u></div>
<div class="intrl_txt">

<div style="clear:both; height:15px;"></div>
	
    <h1 style="color:#88a943;" align="center">Credit Card and Debit Card Offers</h1>
 	 <table border="0" cellpadding="0" width="100%">
       <tr>
         <td style="color:#062a4a; line-height:17px; padding-bottom:8px; font-family: Verdana, Geneva, sans-serif; font-size:12px;">
<b>		 Dear <? echo $name;?>,</b><br>
Thanks for registering yourself with Deal4loans.com for the latest Credit Card and Debit Card offers  . The latest card offers will be sent to your email id on month to month bases. See the current offers on your credit card and debit card. 	 </td>
       </tr>
	   <tr><td>
     
<?    $getcontent='<table width="605" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid;">
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
<tr><td><table border="0" cellpadding="0" width="605">
       <tr>
         <td style="color:#062a4a; line-height:17px; padding-bottom:8px;">
<b>		 Dear '.ucfirst($name).',</b><br>
Thanks for registering yourself with Deal4loans.com for the latest Credit Card and Debit Card offers  . The latest card offers will be sent to your email id on month to month bases. See the current offers on your credit card and debit card. 	 </td>
       </tr>
	   <tr><td>';
	

$getcarddetails="select card_id,card_offers from store_mailer_cards where  user_id=".$last_id."";
list($count_Details,$row)=MainselectfuncNew($getcarddetails,$array = array());
?>
<table border="0" align="left" cellspacing="0" cellpadding="0" style="border:1px dashed #999999;">
<?
 $getcontent.='<table border="0" align="left" cellspacing="0" cellpadding="0" style="border:1px dashed #999999;">';

$card_offers="";
for($k=o;$k<$count_Details;$k++)
{
	 $card_id = $row[$k]["card_id"];
	 $card_offers = $row[$k]["card_offers"];
	// echo "h ".$card_offers."<br>";
	 if(strlen($card_offers)>0)
	{
		 $card_offers = $row[$k]["card_offers"];
	}
	else
	{
		 $card_offers = "dinning_offers,shopping_offers,entertainment_offers,travel_offers,petrol_offers,reward_points_offers,other_offers";
	}
	 

	$getcompletedetails="select bank_name,card_name,".$card_offers." from creditndebit_card_offer where(ccndc_offerid=".$card_id.") ";
	list($countDetails,$getcompletedetailsresult)=MainselectfuncNew($getcompletedetails,$array = array());
	$explode_card_offers = explode(",",$card_offers);
	
	for ($i=0;$i<$countDetails;$i++)
	{
		$bank_name = $getcompletedetailsresult[$i]['bank_name'];
		$card_name = $getcompletedetailsresult[$i]['card_name'];

		
	
	?>
	<tr>
    <td  style="background-color:#fff1e0; border-left:5px solid #7b4501; padding-left:8px; margin-top:10px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	color:#7b4501;	font-weight:bold;	line-height:30px;" height="27"><? echo $bank_name;?></td>
  </tr>
  <tr>    
  <td  style="padding-left:15px; text-decoration:none; line-height:20px; padding-left:8px; color:#7b4501;	font-weight:bold;	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;"><b><? echo $card_name;?></b></td>
    </tr>
   <tr>
    <td  style="line-height:16px; padding-left:15px; text-decoration:none; color:#4d4d4d; 	font-weight:normal;	font-family:Verdana, Arial, Helvetica, sans-serif; 	font-size:11px;">
	<?
	$getcontent.='<tr>
    <td  style="background-color:#89CFF1; border-left:5px solid #29A8E8; padding-left:8px; margin-top:10px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	color:#062a4a;	font-weight:bold;	line-height:30px;" height="27">'.$bank_name.'</td>
  </tr>
  <tr>    
  <td  style="padding-left:15px; text-decoration:none; line-height:20px; padding-left:8px; color:#062a4a;	font-weight:bold;	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;"><b>'.$card_name.'</b></td>
    </tr>
   <tr>
    <td  style="line-height:16px; padding-left:15px; text-decoration:none; color:#4d4d4d; 	font-weight:normal;	font-family:Verdana, Arial, Helvetica, sans-serif; 	font-size:11px;">';
		
		

		$value = "";
		for($j=0;$j<count($explode_card_offers);$j++)
		{
			
			$value = $getcompletedetailsresult[$i][$explode_card_offers[$j]];
			if(strlen($value)>0)
			{
				$card_offers_type=str_replace("_"," ", $explode_card_offers[$j]);
				
				echo ucfirst($card_offers_type)." :  ".$value;
				

				$getcontent.='<b>'.ucfirst($card_offers_type).' </b>:  '.$value;
								//echo "<br>".$explode_card_offers[$j]." :  ".$value."<br>";
			}
			
		
		}
		?>
		</td>
  </tr> 
  <tr><td><hr></td></tr>
		<?
		$getcontent.='</td>
  </tr> 
  <tr><td>&nbsp;</td></tr>';
		
}
	
}
?>

</table>
 </td></tr>                   
                   

     </table>
	 <?
 $getcontent.='</table>
 </td></tr>                   
                   

     </table></td></tr><tr><td bgcolor="#2A84DA"><table width="100%"><tr><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="20" align="center"><a href="http://www.deal4investments.com" style="color:#FFFFFF;">Deal4investments.com</a></td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="15" align="center">|</td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="20" align="center"><a href="http://www.askamitoj.com" style="color:#FFFFFF;">Debt consolidation</a></td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="15" align="center">|</td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="20" align="center"><a href="http://www.bimadeals.com" style="color:#FFFFFF;">Bimadeals.com</a></td></tr></table></td></tr>
<tr>
<td width="605" align="center" valign="top"><img src="http://www.deal4loans.com/emailer/cards-mailer09jan/ftr-brdr.gif" width="605" height="22" /></td>
</tr>
</table>';
	// echo $getcontent."<br>";
$subject="Your Credit Card and Debit Card Offers - Deal4loans";

	 $headers  = 'From: Credit Card and Debit Card Offers<no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	if(strlen($email)>0)
	mail($email,$subject, $getcontent, $headers);
	 ?>

<div style="clear:both; height:15px;"></div>
</div>
<!--partners-->
<!--partners-->
<?php include "footer_sub_menu.php"; ?>

</body>
</html>
