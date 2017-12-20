<?php
	header("location: car-loans.php");
	require 'scripts/functions.php';
	session_start();
	?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<title>Car Loan Features | Motoe Car Loans India | Motor Car Loans Compare Apply-Deal4loans</title>
<meta name="keywords" content="Motor Loans India, Vehicle Loans India, Car loans India, Car loans information, Car  loan documents, Car Loan rates, Car loan eligibility, Vehicle Loans, Motor Loans">
<meta name="Description" content="Looking for hassle free car loans schemes at low interest rates and flexible repayment option, repay with easy EMIs, less documentation; Deal4Loans provides you online information on flexible car loans available with best car (vehicle) loan providing banks in India.">

<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<div id="dvMainbanner">
<? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Upper.php';?>
  <? } ?>
                        <div id="dvbannerContainer"><?php include 'header_cl.php';?></div>

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
   <div align="center"><H1 class="head2">Car loan</H1></div>
	<br>
       
      <P>Car loans come under secured loan section of banks as most of these loans when disbursed your car is hypothecated under the lenders name and 
        your name.</P>
      <P>These days a large set of cash discounts are available when you try to buy the dream vehicle.So the important part is that you know what you 
     can get while taking this loan.</P>

   
<P>

	      <font face="Verdana" size="1" color="#0F74D4">
•                                </font> Covers the widest range of cars and multi-utility vehicles in India.<br>
          <font face="Verdana" size="1" color="#0F74D4">
•                                </font>  Flexible repayment options, ranging from 12 to 84 months.<br/>
         <font face="Verdana" size="1" color="#0F74D4">
•                                </font>  Repay with easy EMIs.<br/>
  <font face="Verdana" size="1" color="#0F74D4">
•                                </font>  Among lowest interest rates<br/>
     <font face="Verdana" size="1" color="#0F74D4">
•                                </font>  Hassle free documentation <br/>
     <font face="Verdana" size="1" color="#0F74D4">
•                                </font> Flexible schemes &amp; quick processing. 
        </p>
		</td></tr></table>
    </div>
	<?
  include '~Right.php';
  
  ?> 
  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?>
<? } ?>
  </body>
</html>