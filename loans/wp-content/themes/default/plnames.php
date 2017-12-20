<p>
<table border="0" cellpadding="1" cellspacing="1" width="691" height="70">
<tr><td style="background:url(/new-images/prefpl.jpg); width:691; height:70px; font-family:Verdana ,  Arial ,  Helvetica ,  sans-serif; font-size:12px; color:#000000; font-weight:bold;" valign="top" ><p style="padding-left:9px; padding-top:6px; padding-right:6px; line-height:17px;">
<?php

$bankNamesArr = array('SBI Personal Loan', 'HDFC Personal Loan', 'ICICI Personal Loan', 'HSBC Personal Loan', 'Citibank Personal Loan', 'Axis Bank Personal Loan', 'Bank of Baroda Personal Loan', 'Bank of India Personal Loan', 'Barclays Personal Loan');

$bankUrlArr = array('http://www.deal4loans.com/personal-loan-sbi.php', 'http://www.deal4loans.com/hdfc-personal-loan-eligibility.php', 'http://www.deal4loans.com/personal-loan-icici-bank.php', 'http://www.deal4loans.com/personal-loan-hsbc-bank.php', 'http://www.deal4loans.com/citibank-personal-loan-eligibility.php', 'http://www.deal4loans.com/personal-loan-axis-bank.php', 'http://www.deal4loans.com/loans/personal-loan/bank-of-baroda-personal-loans-eligibility-rates-emi/', 'http://www.deal4loans.com/loans/personal-loan/bank-of-india-personal-loan-eligibility-rates-emi-processing-fee/', 'http://www.deal4loans.com/barclays-finance-personal-loan-eligibility.php');


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
