<p>
<table border="0" cellpadding="0" cellspacing="0" width="690" height="68">
<tr><td style="background:url(/new-images/prefcl.jpg); width:690; height:70px; font-family:Verdana, Arial , Helvetica ,  sans-serif; font-size:12px; color:#000000; font-weight:bold;" valign="top" ><p style="padding-left:9px; padding-top:6px; padding-right:9px; line-height:17px;">
<?php

$bankNamesArr = array('SBI Card', 'HDFC Credit Card', 'HSBC Credit Card', 'ICICI Credit Card', 'Citibank Credit Card', 'Kotak Credit Card', 'Standard Chartered Credit Card');

$bankUrlArr = array('http://www.deal4loans.com/loans/banks/sbi-credit-cards/', 'http://www.deal4loans.com/loans/credit-card/hdfc-credit-card-eligibility-apply/', 'http://www.deal4loans.com/loans/credit-card/hsbc-credit-card-compare-features-apply/', 'http://www.deal4loans.com/loans/credit-card/icici-bank-credit-cards-eligibility-documents-apply/', 'http://www.deal4loans.com/loans/credit-card/citibank-credit-card-compare-eligibility-features-apply-online/', 'http://www.deal4loans.com/loans/credit-card/kotak-mahindra-credit-cards-eligibility-offers-documents-apply/', 'http://www.deal4loans.com/loans/credit-card/standard-chartered-credit-card-online-offers-apply/');


for($i=0;$i<count($bankNamesArr);$i++)
{
	
	$printBank[] = "<a href='".$bankUrlArr[$i]."' style='text-decoration:none; font-family:Verdana ,  Arial ,  Helvetica ,  sans-serif; font-size:12px;  font-weight:bold;' target='_blank'>".$bankNamesArr[$i]."</a>";
	//echo $printBank;
}
//print_r($printBank);
shuffle($printBank);

$implode = implode(" | ", $printBank );
echo $implode;
//foreach ($printBank as $number) {
//    echo $number ;
//}


?></p>
</td></tr>
</table>
</p>
<p>&nbsp;</p>
