<?php

//210517
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
?>
<html><head>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="includes/style1.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
$FName="Ranjana Chauhan";
$City="Delhi";
$Net_Salary="300000";
$Email="ranjana5chauhan@gmail.com";
$Phone="9811215138";
$ProductValue="210517";

$Message2="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><p><b>Dear $FName</b>,<br />
              We thank you for applying a Credit Card on Deal4loans.com.We are committed to provide you with a platform to compare & choose the best deal that fits your credit needs from the various offers that our participating banks will extend to you. The details that have been provided to the participating banks are listed below. <br />
                  <br />
              
              Your Name: $FName<br />
              Location: $City<br />
              Income/Salary: $Net_Salary<br />
              Email Id: $Email<br />
              Contact : $Phone<br />
  <br /></p></td></tr>";
$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$City."%' and cc_bank_flag=1) order by cc_bank_fee ASC";
	echo "query1 ".$selectccbanks."<br><br>";
	
	 list($rowscount,$row)=MainselectfuncNew($selectccbanks,$array = array());
		$cntr=0;
	
if($rowscount >0)
{
 $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>The following Credit Card companies are interested in your profile:</b></td></tr>"; 
  $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> <table  border='1' cellspacing='0' cellpadding='0'>
		<tr>
		<td  height='40' bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;' >Name</td>
		<td height='40'bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;' >Age</td>
		<td height='40'bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;'>Fee</td>
		<td height='40'bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;' >Features</td>
		<td  height='40' bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;' >Interest Rates</td>
		
		 <td  height='40'bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;'  >&nbsp;</td>
			  
			  </tr>";
   
	  while($cntr<count($row))
        {
        $cc_bank_query  = $row[$cntr]['cc_bank_query'];
		$cc_bankid  = $row[$cntr]['cc_bankid'];
		$cc_bank_url  = $row[$cntr]['cc_bank_url'];
	    $qry2 = $cc_bank_query.' and Req_Credit_Card.RequestID ='.$ProductValue;
	    list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
		if($recordcount>0)
		 {
		 	$i=0;
			
			$get_Bank='Select * From credit_card_banks_eligibility Where cc_bankid='.$cc_bankid.' order by cc_bank_fee ASC';

    list($recordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
		$i=0;
			
		while($i<count($myrow))
        {
			  if($myrow[$i]['cc_bank_fee']==0)
			 {
				  $cardfee="free";
			 }
			 else
			 {
				$cardfee=$myrow[$i]['cc_bank_fee'];
			 }

			 $Message2.=" <tr>
			  <td  bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241;' ><a href='".$cc_bank_url."' target='_blank'>".$myrow[$i]['cc_bank_name']."</a></td>
			  <td  bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;' >".$myrow[$i]['cc_bank_age']."</td>
			  <td bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;' >".$cardfee."</td>
			  <td valign='top' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:8px; color:#061c33; line-height:18px;padding-left:5px; ' class='tblpdng_txt' bgcolor='#ecf7ff'>".$myrow[$i]['cc_bank_features']."</td>
			  <td bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;' >". $myrow[$i]['cc_bank_rates']."</td>
			    <td  bgcolor='#ecf7ff' align='center' style='font-size:11px; text-align:center;font-weight:bold; '><a href='".$cc_bank_url."' target='_blank' ><img src='http://www.deal4loans.com/emailer/cc-mailer09/apl-btn.gif' width='80' height='25' style='border:none;' /></a></td>
			  </tr>";
			 
			
			  $i = $i +1;}
			  
    
	  }
	$cntr = $cntr +1;
	}
	 $Message2.="</table></td></tr>";
	 $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
			  If you havent applied them,Click on the above links to apply for your set of Credit Cards.It will Just take two minutes to apply for your Credit card.Just make sure you have your Pan card number handy with you.<br><br></td></tr>";

	  }
                    $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Other Services from Deal4loans</b>
<ul >
<li ><b>Personal Loan:</b> <a href='http://deal4loans.com/personal-loan-banks.php?source=ccAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://deal4loans.com/Contents_Personal_Loan_Eligibility.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>View Eligibility</a>  | <a href='http://deal4loans.com/personal-loan-interest-rate.php?source=ccAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a>  |<br /> 
    <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Personal loan</a>  | <a href='http://www.deal4loans.com/Request_Loan_Personal_New.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Personal Loan</a></li>
	
	 <li  ><b>Home Loan:</b> <a href='http://www.deal4loans.com/home-loan-banks.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/Contents_Home_Loan_Eligibility.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>View Eligibility</a> | <a href='http://deal4loans.com/home-loans-interest-rates.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a>  | <br /> 
    <a href='http://www.deal4loans.com/Contents_Home_Loan_Mustread.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Home Loan</a> | <a href='http://www.deal4loans.com/Request_Loan_Home_New.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Home Loan</a></li> 
	
	<li  ><b>Life Insurance:</b> <a href='http://www.bimadeals.in/content/life-insurance-policies' target='_blank' style='color:#0a4988; text-decoration:underline;'>Types of life insurance policies</a> | <a href='http://www.bimadeals.com/life-insurance-india/Contents_Life_Insurance_Mustread.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Life Insurance</a>  | <a href='http://www.bimadeals.com/life-insurance-india/Req_Life_Insurance_New.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Life Insurance</a></li> 
	
	<li  ><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li> 
	
	<li  ><b>Debt Consolidation:</b> A Debt consolidation plan basically looks for ways to reduce your total debt servicing out flow by combining your various loans and credit card outstanding and repaying them using the cheapest available funding option best suited for the individual. This single payment is typically lower than the sum of the payments on the individual debts. This is often done to secure a lower interest rate, secure a fixed interest rate or for the convenience of servicing only one loan.<br /> 
    <a href='http://www.deal4loans.com/AskAmitoj.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'><b>Post your request a have a Debt Consolidation plan</b></a></li>
</ul>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a> </div></td>
          </tr>
		  <tr><td><a href='http://www.deal4loans.com/earn-credit-card.php' target='_blank'><img src='http://www.deal4loans.com/emailer/newsletter09may/crdt-bann.gif' width='550' height='101' border='0'/></a></td>
		  </tr>
        </table></td>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
      </tr>
    </table></td>
  </tr>
  <tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>

  </tr>
</table>";

echo  $Message2."<br><br>";
?>
</body>
</html>
