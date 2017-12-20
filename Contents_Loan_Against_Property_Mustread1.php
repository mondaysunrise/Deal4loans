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
		
//$sql = "INSERT INTO Req_Message( PostID, Name, Email, Subject, Message, Product_type, Dated)
//	VALUES ( '', '$Name','$Email', '$subject', '$content', 'Loan against Property', Now() )";

$dataInsert = array("PostID"=>'' , "Name"=>$Name , "Email"=>$Email , "Subject"=>$subject , "Message"=>$content, "Product_type"=>'Loan against Property' , "Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
	
	//$result = ExecQuery($sql);
	//echo "pp".$sql;
	echo "<script language=javascript>alert('Thanks for posting a message.Our team would review it and if accepted will be uploaded at this page within 24 hours.');"." location.href='Contents_Loan_Against_Property_Mustread1.php'"."</script>";
		}
	?>
<html>
<head>
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
<title>Loan Against Property | Loan Against Property India | Loan Against Property Apply | Loan Against Property Compare | Loan Against Property EMI | Deal4Loans - Compare Apply</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="loan against property, loan against commercial, loan against residential property, loan against property providers, loan against property schemes, eligibility for loan on property, cash against property, low interest loan against property, all purpose loans, loans for weddings, loans for emergency">
<meta name="Description" content="Loan against property is an all purpose loan useful to avail funds for marriage ceremony, medical emergency, celebration of holiday with family etc. Loan against your residential property or loan against commercial property is available for both salaried & self employed individuals with attractive interest rate.">
<meta http-equiv="refresh" content="900">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/contentpage.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body align="center">
<table width="712"  border="0" cellspacing="0" cellpadding="0">
                <tr>
     	<span class="bodyarialnew"><br>

    <p class="head2" align="center">Loan Against Property</p>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
	<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr> 
                        <td valign="top" align="center"> 
                          <table width="712" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">
                            <tr> 
							<td width="33">&nbsp</td>
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
                                              <td><font face="Verdana" size="2"><b><font size="4"><a href="Contents_Loan_Against_Property_Eligibility.php"><img border="0" src="images/view_eligibility.jpg" alt="Eligibility for Loan against property " /></a></font></b></font></td>
                                              <td><b><font size="4"><a href="Request_Loan_Against_Property_New.php"><img border="0" src="images/apply.gif" alt="Apply for Loan against property " /></a></font></b></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td width="100%" align="center">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="100%" align="center">
                                          <p align="justify" class="bodyarialnew">Loan Against Property refers to the secured loan category where the borrower gives a 
										guarantee by using his property as a security. The right of ownership of the property is still with the borrower, and if he/she is unable to repay the loan amount, he/she can sell the property to pay off the debts.
 </p>

                                          <p align="justify" class="bodyarialnew"><b>Typically these loans are used to start or expand business or to renovate your house. But it can also be used to repay existing high rate loans.</b></p>

                                          <p align="justify" class="bodyarialnew">• The maximum loan amount varies from bank to bank. It could range from Rs.2 lacs up to 
										  Rs.100 lacs. The exact amount depends on your property valuation, income and of course repayment capacity.<br>• The rate of interest is usually 6.5%+, but depending on one's profile and the Bank's criteria, it may vary.<br>• The maximum loan amount can come upto 50% of property value for commercial setups and up to 60% for residential properties.<br>• The maximum loan tenure is 15 years.<br>• You require security, collateral or guarantors for obtaining a Loan Against Property. 
Most banks do not accept properties that are on lease or that are based on power of attorney.<br>• The maximum age limit of eligibility is 60 years.<br>• You can choose either Fixed or Floating rate of interest. You also have an option of 
changing from Fixed to Floating interest rates and vice versa once every year.<br>• A processing fee is usually 0.05% to 3% of the loan amount and is payable upfront. This fee however will be deducted from the disbursal amount payable to you. You should always ask for the 0% processing fee or negotiate the processing fees.<br>• You pay your loan in EMIs through post-dated cheques or through ECS to debit your Bank account through ECS with the EMI amount.<br>• You can also prepay the entire loan outstanding anytime after 180 days of availing the loan. Pre-payment charges will be levied accordingly. If you intend to do so, please ask for the pre-payment amount to be waived or a reduction in the penalty charges.<br>• You can also increase or enhance your loan eligibility. For that you need to show income of atleast three persons, most preferably a family member or a business partner.
</p>

                                          <p align="justify" class="bodyarialnew"><b>Also know these pointers before availing a LAP:</b>
<br>• Decide on the basis of what you really need. Also see if the cost fits into your 
estimated budget.
<br>• Compare the quotations given and interest rates from 3-4 banks, select the one which 
offers maximum benefit and serves your purpose.
<br>• Also determine the tenure of the loan. The EMI may come less for longer tenure, but the 
total interest outgo will be higher.
<br>• Know all about processing fees and time. Some banks may waive the processing fee for 
processing loan but they build this cost on their interest rates.
<br>• Consider pre-payment options. All banks charges 2% - 3% of the loan in case you decide 
to pre-pay the outstanding amount.
<br>• Default in payments results in penalties. It can also adversely affect your credit 
history and profile. So make sure to make your payments on time.
<br>• Make sure that all deals and offers agreed upon are supported by relevant papers. So make sure you always ask for a letter in a banks letter-head mentioning the likes of, exact rate of interests, processing fees, pre-payment charges along with interest-schedule.
  <br>• Also before signing the documents, make sure you recheck all terms and conditions.
<br>• Do not at any circumstance give any false information. This may amount to fraud and could land you in trouble.
<br>• Do not sign any blank documents. Even if it takes you a few hours to fill-up the form, 
please do so. Do not leave anything for the executive to fill-up.
<br>• Finally, once you have received a loan do your best to pay it back as quickly as possible. Banks make their money off the interest they charge and the sooner you pay back a loan the less money you will have to pay in interest.

 </p>
 <p align="justify" class="bodyarialnew">And again, thank you visting our website</p>
			</td>
                                        </tr>
										<tr><td><hr></td></tr>
										<?php
$sql = "Select Name,Subject,Message,Dated From Req_Message Where Is_Verified=1 and Product_Type='Loan Against Property'";

	 list($recordcount,$row)=MainselectfuncNew($sql,$array = array());
		$cntr=0;
	
	//$result = ExecQuery($sql);
	 while($cntr<count($row))
        {
	?>
	<tr>
	<td class="bodyarial11"><b><? echo $row[$cntr]["Subject"]; ?></b></td></tr>
	<tr>
   <td class="bodyarial11">By <? echo $row[$cntr]["Name"]; ?>&nbsp; on &nbsp;<? echo $row[$cntr]["Dated"]; ?></td></tr> 
   
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