<?php
//session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?
$Query="SELECT * FROM Req_Credit_Card WHERE RequestID=210517";

echo $Query;
list($NumRows,$getrow)=MainselectfuncNew($Query,$array = array());
$cntr=0;

while($cntr<count($getrow))
        {
$EmailID= trim($getrow[$cntr]['Email']);
$Name = trim($getrow[$cntr]['Name']);
$ProductValue = trim($getrow[$cntr]['RequestID']);
$City = trim($getrow[$cntr]['City']);



$subject="Apply Credit Cards in 2 Minutes";


$Message2="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
 <tr>
      <td height='25' align='center'   style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-decoration:none; color:#000000;'>If you are not able to view this mailer properly, please <a href='http://www.deal4loans.com/emailer/credit-card09.php' target='_blank'>Click here</a> </td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='174' height='185'><img src='http://www.deal4loans.com/emailer/cc-mailer09/hdr-lft.gif' width='174' height='185' /></td>
        <td width='187' height='185'><img src='http://www.deal4loans.com/emailer/cc-mailer09/hdr-mdl.gif' width='187' height='185' /></td>
        <td width='199' height='185'><img src='http://www.deal4loans.com/emailer/cc-mailer09/hdr-rgt.gif' width='199' height='185' /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor='#3680b9'><table width='558' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>
      
      <tr>
        <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-align:justify; color:#032241;'><table width='546' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr bgcolor='#FFFFFF'>
            <td height='58' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; line-height:14px;'>Comparing and applying for Credit Cards is as easy as 1-2-3.Just compare features, rewards from 8 Credit cards listed below and choose your type of Credit Card. Apply directly at Banks and keep your information secure !!!</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:justify; color:#032241;'>At different stages of life our wishes differ, and with the  time our requirements as well. Requirements also differ from individual to  individuals. To get the most out from a credit cards, its best to start out on  the right foot. Before going for a Credit Card, we need to check that where we are  using our card the most; it&rsquo;s either on shopping, on traveling, on dinning, on  entertainment or on petrol.</td>
          </tr>
          
          <tr bgcolor='#FFFFFF'>
            <td height='50' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;   text-align:justify; color:#032241; font-weight:bold;'>To apply online for a Credit Card, you need to spend 2 minutes of yours and need to keep your Pan Card Number ready.So no more hassles of filling long Application forms or walking in the branch to get the Credit Card.</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='38' bgcolor='#FFFFFF' style='font-family:Verdana, Arial, Helvetica, sans-serif;  font-size:11px; font-weight:bold; text-align:justify; color:#032241;'>At Deal4loans you can apply for a Credit Card according to  your need. Check the features and apply accordingly.</td>
          </tr>
          
          <tr bgcolor='#FFFFFF'>
            <td  ><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
              <tr>
                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td height='25' colspan='2' align='left' valign='middle' bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;'><b>Kotak Bank Range of Credit Card</b><br />
<img src='http://www.deal4loans.com/images/spacer.gif' width='200' height='1' border='0' /></td>
                    <td width='1' rowspan='23'   align='center' bgcolor='#92c3e8'><img src='http://www.deal4loans.com/images/spacer.gif' width='1' height='250' border='0' /></td>
					<td height='25' colspan='2' align='left' valign='middle' bgcolor='#c2e5ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;'> Citibank<b> Range of </b> Credit Card<br />
<img src='http://www.deal4loans.com/images/spacer.gif' width='250' height='1' border='0' /></td>
                  </tr>
                  <tr>
                    <td width='120' align='center' valign='middle' bgcolor='#ecf7ff'><img src='http://www.deal4loans.com/emailer/cc-mailer09/ktk-crd.jpg' width='82' height='100' /></td>
                    <td width='138' align='left' valign='top' bgcolor='#ecf7ff' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>Requires 2 minutes to fill application</td>
                    <td width='161' align='center' bgcolor='#ecf7ff'><img src='http://www.deal4loans.com/emailer/cc-mailer09/ctbnk-crd.jpg' width='123' height='87' /></td>
                    <td width='117' align='left' valign='top' bgcolor='#ecf7ff' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>Completely online application.
No calls, No Docs!</td>
                  </tr>
                  
                 
            </table></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td  >&nbsp;</td>
          </tr>
		 ";//<!--------------------------------------------------------------->
	
	   if($ProductValue>0)
  {
$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$City."%' and cc_bank_flag=1) order by cc_bank_fee ASC";
	//echo "query1 ".$selectccbanks."<br><br>";
	 list($rowscount,$row)=MainselectfuncNew($selectccbanks,$array = array());
		$i=0;
	
if($rowscount >0)
{
 $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>The following Credit Card companies are interested in your profile:</b></td></tr>"; 
  $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> <table  border='1' cellspacing='0' cellpadding='0'>
		<tr><td><table border='1'>";
   
	while($i<count($row))
        {
        $cc_bank_query  = $row[$i]['cc_bank_query'];
		$cc_bankid  = $row[$i]['cc_bankid'];
		$cc_bank_url  = $row[$i]['cc_bank_url'];
		  $qry2 = $cc_bank_query.' and Req_Credit_Card.RequestID ='.$ProductValue;
			  list($recordcount,$row1) = MainselectfuncNew($qry2,$array = array());
    	if($recordcount>0)
		 {
		 	$i=0;
			$arrcc_bankid="";
			$get_Bank='Select * From credit_card_banks_eligibility Where cc_bankid='.$cc_bankid.' order by cc_bank_fee ASC';
    		  list($recordcount1,$myrow) = MainselectfuncNew($get_Bank,$array = array());
			
		for($ii=0;$ii<$recordcount1;$ii++)
		 {
			
			  if($myrow[$ii]['cc_bank_fee']==0)
			 {
				  $cardfee="free";
			 }
			 else
			 {
				$cardfee=$myrow[$ii]['cc_bank_fee'];
			 }
				
				$cc_bankidRR=$myrow[$ii]['cc_bankid'];
				//ECHO $cc_bankidRR;
				$arrcc_bankid[]=$cc_bankidRR;
				//print_r($arrcc_bankid);
				$getbankname=$myrow[$ii]['cc_bank_name'];
		 }
		 $j=0;
		 for($j=0;$j<count($arrcc_bankid);$j++)
				 {
			 $Message2.="<tr>";
if($arrcc_bankid[$j]==5 || $arrcc_bankid[$j]==7 || $arrcc_bankid[$j]==8 || $arrcc_bankid[$j]==9)
			 {
//echo 	"hello".$arrcc_bankid[$j]."<br>";
//echo $getbankname;
			 $Message2.=" 
			  <td  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' ><a href='".$cc_bank_url."' target='_blank'>".$getbankname."</a></td>";
			 
			 }
			 elseif($arrcc_bankid[$j]==1 || $arrcc_bankid[$j]==2 || $arrcc_bankid[$j]==3 || $arrcc_bankid[$j]==4)
			 {
				$Message2.=" 
			  <td  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' ><a href='".$cc_bank_url."' target='_blank'>".$getbankname."</a></td>";

			 }
			 $Message2.="</tr>";
			  }
			  
    
	  }
	$i = $i + 1;}
	 $Message2.="</table></td></tr><tr><td></table></td></tr>";
	 $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
			  If you havent applied them,Click on the above links to apply for your set of Credit Cards.It will Just take two minutes to apply for your Credit card.Just make sure you have your Pan card number handy with you.<br><br></td></tr>";

	  }
  }
  
 
		 // <!--------------------------------------------------------------------->
		  
          
         $Message2.="</table></td>
      </tr>
      
    </table></td>
  </tr>
  
  <tr>
    <td width='560' height='22'><img src='http://www.deal4loans.com/emailer/cc-mailer09/crd-btmline.gif' width='560' height='22' /></td>
  </tr>
 
</table></td></tr></table>";

echo $Message2."<br>";


//echo $getcontent."<br>";
$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: Credit Card Offers <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	echo "count".$j."name ".$Name."Email:  ".$EmailID."banks ".$cc_bank."LeadID ".$LID."<br>";
	//if(strlen($email)>0)
	//{
	//$EmailID="";
//$EmailID ="ranjana5chauhan@gmail.com,ranjana.chauhan@rediffmail.com,ranjanachauhan5@yahoo.com,ranjana5chauhan@hotmail.com";
	//mail($EmailID,$subject, $getcontent, $headers);
	//}
	echo "done";
 $cntr=$cntr+1;
 }
?>
</body>
</html>
