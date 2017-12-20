<?php
header("Location: index.php");
exit();

	/*
	require 'scripts/functions.php';
	session_start();
	
	$f="";
	if($_GET["f"]=="Personal_Loan") 
	{
		$title="Personal loans India : Personal loan online information : Personal loan interest rate";
		$keywords="personal loans, instant personal loan, personal loan online information, personal loan for education, personal loans india, loans for salaried persons, loans for doctors, loans for self employed, personal loan repayment, personal loans interest rate, education loan, personal finance, low interest loans, best personal loans, personal loan repayment schemes";
		$description="Personal loan is one of the quick types of loans, useful to fulfill your personal dreams like personal loan for renovation of house, wedding in the family, higher education for children etc. Instant personal loans are available for both salaried & self employed individuals like doctors etc., with lower interest rate. Deal4Loans provides you valuable online information on personal loan.";
	}
	if($_GET["f"]=="Personal_Loan_Eligibility") 
	{
		$title="Personal Loan Eligibility : Personal Loan Banks in India : Best Personal Loans Providers";
		$keywords="best personal loans providers, personal loans eligibility, personal finance eligibility, personal loans india, compare personal loans, personal loan schemes, personal loan banks in India, easy personal loans, quick loans, bank loans, best personal loans, flexible personal loan, low interest personal loan";
		$description="Know more about personal loan eligibility terms and conditions for salaried and self employed individuals from India. Also find online information on best personal loans providers and compare personal loan banks in India like HSBC, HDFC, ICICI, CITI Bank, Standard Chartered, ABN AMRO Bank etc.";
	}
	if($_GET["f"]=="Home_Loan" || $_GET["f"]=="enhance"  || $_GET["f"]=="fixedvfloat"  || $_GET["f"]=="journey"  || $_GET["f"]=="typeofhl") 
	{
		$title="Home loans India : Home loan interest rates : Flexible home loan repayment: Housing financial services India";
		$keywords="hassle free home loans, home loans india, home finance, housing loan, flexible home loan, best home loan providers, home loans interest rate, low interest home loan, housing finance services, home loan repayment schemes, compare home loans, easy home loans, online home loans";
		$description="Looking for hassle free home loans at attractive interest rates and flexible repayment option; Deal4Loans provides you online information services on flexible home loans schemes available with best home loan provider banks and housing financial companies in India. Avail low interest home loans for constructing a home, purchasing house, residential plot and even for re-financing existing loans";
	}
	if($_GET["f"]=="Home_Loan_Eligibility") 
	{
		$title="Home Loan Eligibility : Best Home Loans Providers : Housing Finance Providers India";
		$keywords="housing finance, best home loans providers, home loans eligibility, home finance eligibility, home loans india, compare home loans, home loan schemes, home loan banks in India, easy home loans, quick loans, bank loans, best home loans, flexible home loan, low interest home loan";
		$description="Know more about home loan eligibility terms and conditions for salaried and self employed individuals from India. Also find online information on best home loans (housing finance) providers and compare home loan banks in India like LIC Housing Finance Ltd., HSBC, HDFC, ICICI, CITI Bank, Standard Chartered, ABN AMRO Bank etc.";
	}
	if($_GET["f"]=="Car_Loan") 
	{
		$title="Best car (vehicle) loans India : Low interest rates on car loan : Car Loan online information";
		$keywords="hassle free car loans, car loans india, car finance, best car loan, flexible car loan, best car loan providers, car loans interest rate, low interest car loan, car finance companies, car loan repayment schemes, compare car loans, easy car loans, online car loans";
		$description="Looking for hassle free car loans schemes at low interest rates and flexible repayment option; Deal4Loans provides you online information on flexible car loans available with best car (vehicle) loan provider banks in India.";
	}
	if($_GET["f"]=="Car_Loan_Eligibility") 
	{
		$title="Car Loan Eligibility : Best Car Loans Providers India : Car Loan Schemes";
		$keywords="vehicle finance, best car loans providers, car loans eligibility, car finance eligibility, car loans india, compare car loans, car loan schemes, car loan banks in india, easy car loans, quick loans, bank loans, best car loans, flexible car loan, low interest car loan";
		$description="Know more about car loan eligibility terms and conditions for salaried and self employed individuals from India. Also find online information on best car loans (vehicle finance) providers and compare car loan banks in India like HDFC, State Bank of India, Bank of Baroda, CITI BANK etc.";
	}
	if($_GET["f"]=="Credit_Card") 
	{
		$title="Compare credit cards in India | Online credit cards information | Credit card schemes";
		$keywords="credit cards online information, credits cards schemes, credit card benefits, discounts on credits cards, compare credit cards in india, best credit card providers, apply online for credit cards, credit cards, credit card plans, online credit card, convenient credit card, Co branded credit cards, free credit cards";
		$description="Get online information on best credit cards in India. We also provide information on different credit card schemes. This information will help you to compare credit card features like service charges, annual fees, add on cards, interest free credit period, zero liability on lost cards, free insurance coverage etc.";
	}
	if($_GET["f"]=="Credit_Card_Eligibility") 
	{
		$title="Credit card benefits | Discounts on credits cards | Eligibility for credit cards | Free for life credit cards";
		$keywords="free credit cards, credit cards online information, credits cards schemes, credit card benefits, discounts on credits cards, compare credit cards in india, best credit card providers, eligibility credit cards, credit card plans, online credit card, Co-branded credit cards, air miles credit cards, travel credit cards, airline credit cards, insurance coverage, free for life credit cards";
		$description="Know more about online credit card services (like free for life credit cards) provided by best credit card providers in India like ICICI Bank, American Express, Citi Bank etc. Compare credit cards benefits, discounts on credits cards, rewards points on credit cards, eligibility for credits cards etc.";
	}
	if($_GET["f"]=="Loan_Against_Property") 
	{
		$title="Loan against property | Loan against property schemes";
		$keywords="loan against property, loan against commercial, loan against residential property, loan against property providers, loan against property schemes, eligibility for loan on property, cash against property, low interest loan against property, all purpose loans, loans for weddings, loans for emergency";
		$description="Loan against property is an all purpose loan useful to avail funds for marriage ceremony, medical emergency, celebration of holiday with family etc. Loan against your residential property or loan against commercial property is available for both salaried & self employed individuals with attractive interest rate.";
	}
	if($_GET["f"]=="Loan_Against_Property_Eligibility") 
	{
		$title="Eligibility for loan on property | Loan against property providers in India";
		$keywords="loan against property, loan against commercial, loan against residential property, loan against property providers, loan against property schemes, eligibility for loan on property, cash against property, low interest loan against property, all purpose loans, loans for weddings, loans for emergency";
		$description="Loan against your residential property or loan against commercial property is available for both salaried & self employed individuals with attractive interest rate. Find online information on loan against property eligibility criteria and loan against property providers in India.";
	}
	if($_GET["f"]=="Calculators") 
	{
		$title="Loan interest rate calculator | EMI (equated monthly installments) calculator";
		$keywords="loan calculator, emi calculator, calculate monthly EMI, loan interest rate calculator, yearly interest rates on loans, equated monthly installments, rate of interest";
		$description="Use our equated monthly installments (EMI) calculator to calculate monthly EMI, total amount with interest, yearly loan interest rates, flat interest rate per month etc.";
	}
	if($_GET["f"]=="Disclaimer") 
	{
		$title="Disclaimer | Online information on loan schemes";
		$keywords="home loans, car loans, personal loans, loans against property, credit cards, online loan application, loan schemes information";
		$description="Deal4Loans is an online loan information portal, provides valuable information on all types of loan schemes in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards";
	}
	if($_GET["f"]=="")
	{
		$title="Our Services";
		$keywords="Best Personal Loans in India, Best Loan Quotes in India, Compare Loans in India, Compare Home Loans in India, Compare Home in India, Compare Car loans in India, Car Loans, Compare Personal loans in India, Personal , Compare Credit Cards in India, Compare Loans Against Property in India";
		$description="Personal loan is one of the quick types of loans, useful to fulfill your personal dreams like personal loan for renovation of house, wedding in the family, higher education for children etc. Instant personal loans are available for both salaried & self employed individuals like doctors etc., with lower interest rate. Deal4Loans provides you valuable online information on personal loan.";
	}
	*/
?>
<html>
<head>

<title><? echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="<? echo $keywords; ?>">
<meta name="Description" content="<? echo $description; ?>">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="712" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php include '~Top.php'; ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="202" align="center" valign="top">     <?php if(session_is_registered('Email'))
		{
		include '~Left.php';
		}
		else
		{
		include '~Login.php';
		}
?></td>
	<td width="510"><table width="510"  border="0" cellspacing="0" cellpadding="0">
		<tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
     	<span class="bodyarial11"><br>
     	<?php @include "Contents/".$_GET["f"].".php"; ?></span>
     &nbsp;</td>
     </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php include '~Bottom.php';?></td>
  </tr>
</table>
</body>

</html>