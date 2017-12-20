<?php 
require 'scripts/session_check.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Loans| Car Personal Home Loans India | Credit cards India</title>
<meta name="keywords" content="loans, personal loans, personal loan, loans, loan, emi calculator, compare personal loans, debt consolidation , education loans, loan providers, credit cards, loan gyan, loans India, online loan application, loan calculator, loan eligibility, banks India, easy loans, quick loans, Compare loan from ICICI  HDFC SBI and other major banks " > 
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=" >
<meta NAME="AUTHOR" CONTENT="Deal4Loans Team">
<meta name="description" content="Deal4Loans an loan information portal, provides information on Personal loan, Credit cards, Home loan, Car loan, Busiess Loan in India offered by ICICI, Barclays, SBI, Citibank. Apply for best loan and credit card on Deal4loans.com">
<meta content="INDEX, FOLLOW" name="ROBOTS" >
<link REL="SHORTCUT ICON" href="http://www.deal4loans.com/favicon.ico" type="image/vnd.microsoft.icon">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<script Language="JavaScript" Type="text/javascript" src="scripts/scrollable.js"></script>
<link href="style.css" rel="stylesheet" type="text/css">
<style>
.head2 {
	font-family: Century Gothic;
	font-size: 18px;
	color:0F74D4;
	text-decoration: none;
	font-weight: bold;
}
</style>
<?php
	require 'scripts/functions.php';
	session_start();
?>

<?php include '~Top.php';?>

<div align="center">
 <div id="main-header">
 
  <div  id="text-hdr-lft">
  <div id="header-text">Varied Individuals. Various Needs.</div>
 <div id="hdr-txt">Loans by Choice not by Chance.</div>
 </div>
 <div id="header-rgt-img"></div>
 </div>
 </div>  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
 
  <div id="dvContentPanel">
   <?php if(isset($_SESSION['UserType']))
	{?><div id="dvMaincontent">
   <table width="776" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  
  <td valign="top"><?php include '~Left.php';?></td>
  
  <td align="center" valign="top"><? }?>
    <table width="776" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td height="250" colspan="2" align="center" valign="middle" class="head2">
          Thank You for the Payment. We will get back to you soon.</td>
       <!-- <td width="250" align="right" valign="top">
		<? if(!isset($_SESSION['UserType'])) 
  {
  //include '~Right1.php';
  }
  ?> </td>-->
      </tr>
      <tr>
        <td colspan="2" align="center"> <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom.php';?>
  <? } ?></td>
        </tr>
    </table></td>
  </tr>
  
    </tr>
   </table>
   </div>



 </div>





 
 
</body>
</html>


