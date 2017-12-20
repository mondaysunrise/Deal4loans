<?php
	header("Location: home-loans.php");
	exit();
	require 'scripts/functions.php';
	session_start();
	?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<title>Home loans India | Aspects of Home Loan | Home Loan Eligibilty- Deal4loans</title>
<meta name="keywords" content="Home Loans, Home loans India, Types of Home Loan, Fixed rate home loan, floating rate home loan, Home loans information, Home loan documents, Home Loan rates, Home loan eligibility, Mortgage Loans, Housing Loan, home contruction loan, home renovation loan, apply home loan on deal4loans.com">
<meta name="Description" content="Avail Home Loans for constructing a home, purchasing a ready built house/flat, residential plot and even for re-financing existing loans you may have availed from other banks or housing. Read about types of home loan, home loan eligibity, home loan documents, Home loan interesr rates etc on Deal4loans.com.">

<link href="includes/style1.css" rel="stylesheet" type="text/css">
<?php include '~Top.php';?>
<div id="dvMainbanner">
<? if ((($_REQUEST['flag'])!=1))
	{ ?>
    <?php include '~Upper.php';?><? } ?> 
        <div id="dvbannerContainer"><?php include 'header_hl.php';?></div>

  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent">
	     <?php if(isset($_SESSION['UserType']))
	{?>
   <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>   
	  <div align="center"><H1 class="head2">Home Loan</H1></div>
	<br>
	  <table width="510" cellpadding="0" cellspacing="0" style="width:100%">
	  <tr><td><h2 class="head3"><a href="http://www.deal4loans.com/Interest-Rate-Home-Loans.php" >Compare home loan interest rates</a></h2></td><td align="right">&nbsp;</td></tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td >&nbsp;</td>
	    </tr>
	  <tr>
	    <td colspan="2"> <P >Presenting the home loan you have been looking for. We realize what owning your home means to you and your family. We are here to make your dream home a realty through a best deal in Home Loan. Home loans can be used for all kinds of things – re-mortgaging, doing up the house or just raising a bit of cash – and because they're secured on your house, you can expect very favourable terms from the big-name lenders.</P>

<p>You can avail of the <a href="http://www.deal4loans.com/home-loan-banks.php">Home Loans</a> for constructing a home, purchasing a ready built house/flat, residential plot and even for re-financing existing loans you may have availed from other banks or housing. </p>

</td>
	    </tr>
	  <tr>
	    <td colspan="2"><P>
<b>Aspects of Home Loan</b><br>
<br>
 <font face="Verdana" size="1" color="0F74D4">•</font> <a href="Contents_home_loan_enhance.php">How to enhance Your home loan eligibility</a><br/>
       <font face="Verdana" size="1" color="0F74D4">•</font> <a href="Contents_home_loan_journey.php">Journey towards home loan</a><br/>
     <font face="Verdana" size="1" color="0F74D4">•</font> <a href="Contents_types_of_home_loan.php">Types of home loan</a><br/>
	
      
        <font face="Verdana" size="1" color="0F74D4">•</font> <a href="Contents_home_loan_fixed_floating_rate_of_interest.php">Floating Vs. Fixed Rate of Interest</a><br/>
		 <font face="Verdana" size="1" color="0F74D4">•</font> <a href="http://www.deal4loans.com/Home-Loan-Articles.php">Read more articles on Home Loan</a>
		
	    </p></td>
	    </tr>
	  <tr>
	    <td colspan="2"><p>
As most housing finance companies have reduced their interest rates, this is a good time to buy your dream home using a home loan. And with improved technology, the best way to look for home loans is online. You can surf Deal4loans and compare the rates, policies and terms of different lenders and then choose the best kind of home loan for yourself. This whole process of searching for home loan online is completely hassle free and will save your time energy and money.
</p></td>
	    </tr>
	  <tr>
	    <td colspan="2"><p><b>Insurance cover for your Dream Home</b> - many banks may insist on getting your home insured to safeguard their interest. There are various kinds of insurance covers available for you. Apart from getting the mandatory ones you should try to get insurance as per your circumstances. You also have a choice of getting insured from another company without any objection from your bank. <a href="http://www.bimadeals.com/home-insurance-india/Contents_Home_Insurance_Faqs.php">Home Insurance</a> protects your home from natural & man-made disasters and shelters the structure & contents of your home. The Policy covers the losses occurred to the building (structure) of your home or to its contents due to natural and man-made catastrophes. <a href="http://www.bimadeals.com/home-insurance-india/Req_Home_Insurance_New.php">Apply for Home Insurance here!</a>

</p></td>
      </tr>
	</table>
     
	 </td></tr></table>
    </div>
	<?
  include '~Right.php';
  
  ?>
  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><? } ?>
  </body>
</html>