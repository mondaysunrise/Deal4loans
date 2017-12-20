<!--<p>
<table border="0" cellpadding="0" cellspacing="0" width="690" height="70">
<tr><td style="background:url(/new-images/prefcl.jpg); width:690; height:70px; font-family:Verdana, Arial , Helvetica ,  sans-serif; font-size:12px; color:#000000; font-weight:bold;" valign="top" ><p style="padding-left:9px; padding-top:6px; padding-right:9px; line-height:17px;">
<?php

$bankNamesArr = array('Sbi Car Loan', 'ICICI Car Loan', 'hdfc Car Loan', 'Axis Bank Car Loan', 'Kotak Mahindra Car Loan', 'Bank of Baroda Car Loan', 'PNB Car Loan');

$bankUrlArr = array('http://www.deal4loans.com/loans/sbi/sbi-car-loan-interest-rates-eligibility-documents-apply/', 'http://www.deal4loans.com/loans/car-loan/icici-bank-car-loans/', 'http://www.deal4loans.com/loans/car-loan/hdfc-car-loan-eligibility-interest-rates-and-documents-requirement-for-apply-hdfc-bank-car-loans/', 'http://www.deal4loans.com/loans/car-loan/axis-bank-car-loan-interest-rates-eligibility-apply-online-axis-car-loan/', 'http://www.deal4loans.com/loans/car-loan/kotak-car-loans-eligibility-documents-interest-rates-apply/', 'http://www.deal4loans.com/loans/car-loan/bank-of-baroda-car-loan-interest-rates-documents-apply-online/', 'http://www.deal4loans.com/loans/car-loan/punjab-national-bank-car-loan-interest-rates-eligibility-apply-online-pnb-car-loan/');


for($i=0;$i<count($bankNamesArr);$i++)
{
	
	$printBank[] = "<a href='".$bankUrlArr[$i]."' style='text-decoration:none; font-family:Verdana ,  Arial ,  Helvetica ,  sans-serif; font-size:12px;  font-weight:bold;' target='_blank'>".$bankNamesArr[$i]."</a>";
	//echo $printBank;
}
//print_r($printBank);
shuffle($printBank);

$implode = implode(" | ", $printBank );
//echo $implode;
//foreach ($printBank as $number) {
//    echo $number ;
//}


?></p>
</td></tr>
</table>
</p>
<p>&nbsp;</p>
 -->