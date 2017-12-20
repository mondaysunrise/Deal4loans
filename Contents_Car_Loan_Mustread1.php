<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$Name = FixString($Name);
		$Email = FixString($Email);
		$content = FixString($content);
		$subject = FixString($subject);
	    $Dated = ExactServerdate();
		
	
	$dataInsert = array("PostID"=>'' , "Name"=>$Name , "Email"=>$Email , "Subject"=>$subject , "Message"=>$content, "Product_type"=>'Car Loan' , "Dated"=>$Dated );
$table = 'Req_Message';
$insert = Maininsertfunc ($table, $dataInsert);
	
	//echo "pp".$sql;
	echo "<script language=javascript>alert('Thanks for posting a message.Our team would review it and if accepted will be uploaded at this page within 24 hours.');"." location.href='Contents_Car_Loan_Mustread1.php'"."</script>";
		}
	?>	
	<html>
<head>

<title>Car Loans| Car Loans India| Car Loans Apply | Car Loans Compare| Car Loans EMI | Deal4Loans - Compare Apply</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="hassle free car loans, car loans india, car finance, best car loan, flexible car loan, best car loan providers, car loans interest rate, low interest car loan, car finance companies, car loan repayment schemes, compare car loans, easy car loans, online car loans">
<meta name="Description" content="Car finance facility for quick car loans to avail car loans for new car in India. Find valuable information on car loan schemes offered by differed car loan provider like car loan interest rates, car loan repayment options etc at deal4loans.com.">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/contentpage.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<style>
a
{
	cursor:pointer;

}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}
</style>
</head>
<body align="center">
<table width="712"  border="0" cellspacing="0" cellpadding="0">
                <tr>
     	<span class="bodyarialnew"><br>
   <p class="head2" align="center">Car Loan</p>
   <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr> 
					  <td width="33">&nbsp</td>
                        <td valign="top" align="center"> 
                          <table width="712" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">
                            <tr> 
                              <td> 
                                <font face="Verdana" size="2">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="95%" id="AutoNumber1">
                                    <tr>
                                      <td width="100%"><a name="top"></a></td>
                                    </tr>
                                    <tr>
                                      <td width="100%"><font face="Verdana" size="2">
                                      <table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
                                        <tr>
                                          <td width="100%" align="right"><table border="0" cellspacing="0" cellpadding="4">
                                            <tr>
                                              <td><font face="Verdana" size="2"><b><font size="4"><a href="Contents_Car_Loan_Eligibility.php"><img border="0" src="images/view_eligibility.jpg" alt="Eligibility for Car Loan " /></a></font></b></font></td>
                                              <td><b><font size="4"><a href="Request_Loan_Car_New.php"><img border="0" src="images/apply.gif" alt="Apply for Car Loan " /></a></font></b></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td width="100%" align="center">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="100%" align="center">
                                          <p align="justify" class="bodyarialnew"><b>Avail almost all types of car loans now!!</b></p>

                                          <p align="justify" class="bodyarialnew">Looking for Best Car Loans?? If it's what you are searching for, then you
										  are at the right spot!! Because at deal4loans, getting a car loan is a lot simpler.
</p>

                                          <p align="justify" class="bodyarialnew">We, at deal4loans, give you access to various leading and prominent banks in
										  the country. To avail our services, all you need to do is just fill the online-form (will take just a few minutes). After you submit your details, we let the banks (with whom we have partnered), evaluate your details in order to provide you with an appropriate deal.</p>

                                          <p align="justify" class="bodyarialnew">If you just go to a showroom and pick out a car and do the financing, you could get the car, but in all probability would also end up paying some thousands of rupees more than you should have.</p>

                                          <p align="justify" class="bodyarialnew">Today the Internet has revolutionized the way we buy cars. So it is important to educate yourself before-hand, about how to get the best deal when you buy a car.</p>

                                          <p align="left" class="bodyarialnew">Buying a car, now, has become easier than ordering a home-deliverd pizza.Banks today provide easy finance schemes where you can drive away with a car. But deciding on the right car finance is very challenging. You may be confused on which one is beneficial for you and might end up with one that has various "invisible" strings attached to it.</p>

                                          <p align="left" class="bodyarialnew"><b>So here are a few things, we think might help you in chosing the right car-financing option:</b></p>

                                          <p align="justify" class="bodyarialnew">The first thing you need to know, before availing for car loan, is the type
										  of car you want and see if it suits your estimated budget. Narrow your choice of cars, to two or three. Compare rates of all banks and get their best rates. Also ask for recommended dealers for the car(s) of your choice to see which dealer is giving you the best deal.</p>

                                          <p align="left" class="bodyarialnew"> You apply for a loan and you buy a car. You go to a bank and fill
										  out some forms and they disburse your check. Sounds simple enough,
										  doesn't it?.


                                          <p align="justify" class="bodyarialnew">However, your application could be denied or cancelled, or you may get an
										  offer at a high interest rate if you have bad-credit history.  All
										  banks go through your financial history when you apply for a loan.
										  Different banks have different standards of judging a credit history.
    									  So it is wise to clear up all old debts, if you have any, before you
										  apply for a loan. This will help you get your loan approved at lower
										  interest rates.
											</p>

                                          <p align="justify" class="bodyarialnew">You repay the loan in equated monthly installments (EMIs), comprising of principal amount and the Interest Rate. The EMI depends upon the loan amount, the interest rate and the tenure of the loan.</p>

                                          <p align="left" class="bodyarialnew">Also don't just evaluate the deal based on monthly EMIs.  Calculate how much you will be paying over the tenure of the loan. This in turn is a function of Interest rates</p>

                                          <p align="justify" class="bodyarialnew">The interest rate depends on the Flat Rate and Reducing Balance method. In the Flat Rate of interest, the principal amount(on which interest calculations are made)remains same for the entire tenure of the loan. The total interest is divided over the number of installments to derive the EMI.</p>

                                          <p align="left" class="bodyarialnew">Reducing Balance, means reducing the paid-up principal amount (on which interest calculations are made) from the outstanding loan
										  amount. The interest you pay is calculated on outstanding principal balance.</p>


                                          <p align="justify" class="bodyarialnew">Car loans typically dont require a guarantor but if your income does not meet the credit criteria, then you will be required to have a guarantor for your
										  loan. Gurantor can be your spouse, if employed, or a third party guarantee will do</p>

                                          <p align="left" class="bodyarialnew">Processing fees is a one-time charge taken for processing and legal paperwork. At the beginning of the period, the bank requires you to pay 2-4 percent of the loan amount as processing fees. For example, if
										  you take Rs.5 lac at 15% for 5 years (60 EMIS) and charges you 2 percent as processing fees, you are in effect paying an amount of Rs 10,000.</p>


                                          <p align="justify" class="bodyarialnew">If you chose to pay up your entire money before the tenure, a Pre-payment penalty is charged. So know about such penalties
										  before-hand to avoid future mis-understanding between you and the bank.</p>

                                          <p align="left" class="bodyarialnew">Also keep in mind that most banks offer you the option of pre-payment,but they do not give the flexibility of part-payment.</p>
	

                                          <p align="justify" class="bodyarialnew">You "have-to" insure your car. It is against the law to drive an uninsured car. You must get an insurance policy for a year's duration, after which you have to renew it. The amount of insurance is equal to the market value of the vehicle and not the book value of the vehicle.</p>
                                          <p align="justify" class="bodyarialnew">The premium is added to the EMI paid for the loan tenure and you are insured for the amount you have taken, incase something unexpected happens.
										  Assured amount will be given to the bank without burdening the members of the family.</p>
										  <p align="justify" class="bodyarialnew">So keep these few things in mind while financing your next car !You have reached the best spot to get the  best loan, for your car,from the best banks. Go, fill the application form now !</p>

									</td>
                                        </tr>
										<tr><td><hr></td></tr>
										<?php
$sql = "Select Name,Subject,Message,Dated From Req_Message Where Is_Verified=1 and Product_Type='Car Loan'";

	 list($recordcount,$row)=MainselectfuncNew($sql,$array = array());
		$cntr=0;
	

	while($cntr<count($row))
        {
	?>
	<tr>
	<td class="bodyarial11"><b><? echo $row[$cntr]["Subject"]; ?></b></td></tr>
	<tr>
   <td class="bodyarial11">By <? echo $row[$cntr]["Name"]; ?>&nbsp on &nbsp<? echo $row[$cntr]["Dated"]; ?></td></tr> 
   
	<tr>    
    <td class="bodyarial11"><? echo $row[$cntr]["Message"]; ?></td></tr>
	<tr><td><hr></td></tr>
		<?php
	   $cntr = $cntr +1;}
?>
                                       <tr><td rowspan="2" width="100%" bgcolor="DAEAF9" height="20"><font color="#1A5EA2"><b>
										MESSAGE BOARD</b></font></td>
										</tr>
										<tr><td></td></tr>
                                        <tr>
                                          <td width="100%" align="center"><!---New edition--><table width="100%"  id="myTable" ><tr><td><a onClick="insRow()" onMouseOver="this.style.color='blue'"><img src="images/discuss_icon.gif"><u>Post a message</u></a></td></tr></table>
										  </form>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="100%" align="center">
                                          <p align="right" class="bluelink"> 
   <font face="Verdana" size="2">
                                          <a href="javascript:history.go(-1)">
                                          Back</a></font></td>
                                        </tr>

                                        <tr>
                                          <td width="100%" align="center">
                                          <p align="right" class="bluelink"> 
   <font face="Verdana" size="2">
                                          <a href="Contents_Disclaimer.php">
                                          Disclaimer</a></font></td>
                                        </tr>
                                        <tr>
                                          <td width="100%" align="center">&nbsp;                                          </td>
                                        </tr>
                                      </table>
                                </font> 
                                      </td>
                                    </tr>
                                    </table>
                                  
                                </font> 
                              </td>
                            </tr>
                            </table>
                        </td>
                      </tr>
    </table>
</span>
</td>
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