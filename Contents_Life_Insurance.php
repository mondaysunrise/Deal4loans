<?php
	require 'scripts/functions.php';
	session_start();
	?>
<html>
<head>

<title>Life Insurance India </title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">


<link href="includes/style1.css" rel="stylesheet" type="text/css">
<?php include '~Top.php';?>
<div id="dvMainbanner">
   <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><img src="images/life_insurance1.gif" usemap="#map_name4"></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">Life Insurance generally provides financial coverage to specified beneficiaries upon the death of the insured individual. It involves a contract providing for payment of an assured sum of money to the person insured.</td></tr></table>  <map name="map_name4">

   <area shape="rect" coords="17,75,100,95" hrEF="insurance_form.php">
         </map> </div>
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
	<div align="center"><font class="head2">Life Insurance</font></div>
	<br>
	<p>Life Insurance generally provides financial coverage to specified beneficiaries upon the death of the insured individual. It involves a contract providing for payment of an assured sum of money to the person insured.  </p>

<p><font color="0F74D4"><b>Why you need life Insurance?</b></font><br>
First and foremost is that life insurance isn't for you. It's for your family. Some people believe that buying life insurance is like planning for their death -will bring misfortune to their lives. The fact is that life insurance is not about death, it's about buying  peace of mind prepared to face any financial crisis that would hit the family in case of an untimely demise. </p>

<p>The need for Life Insurance becomes a priority when the need to safeguard your family is realised. Life Insurance is necessary to replace lost income in case of death or disability.</p> 
<p>Insurance is the risk cover to protect against losses suffered on account of any unforeseen event. It provides you with a sense of security that no other form of investment provides. Life Insurance is considered one of the most popular savings/investment schemes that provides sound returns as well as protection and also serves as tax saving mechanism too. </p>

<p> <font color="0F74D4"><b>Whole Life Policy</b></font><br>

This is probably the simplest policy to understand. Every year you pay a fixed premium based on your age and other such factors. And then, as the years go by, you earn a certain interest on your policy's cash value. The policy continues into your old age for the same premium you started out with. This policy provides protection that is permanent and also accumulates handsome returns. Whole Life Policy is an insurance cover against death, irrespective of when it happens. </p>

<p>This policy, however, fails to address the additional needs of the insured during the post-retirement years. It doesn't consider a person's increasing financial needs either. While the insured buys the policy at a young age, his/her needs typically increase over time. By the time he/she dies, the value of the sum assured might be too low to meet his/her family's needs. As a result of these drawbacks, insurance firms now offer either a modified Whole Life Policy or combine in with another type of policy. </p>

<p><font color="0F74D4"><b>Endowment policy</b></font><br>

Endowment policy is the most popular policy in the world of life insurance as it is the combination of risk cover with financial savings. An Endowment Life Insurance policy provides more of an investment. One can earn more capital for specific purposes and is also protected against the insured's premature death. If the insured dies during the tenure of the policy, the insurance firm has to pay the sum assured just as any other pure risk cover. Endowment Life insurance is mostly used by many for anticipated financial needs, like children's education or ones' retirement. <br>
Premium for an Endowment Life policy is much higher compared to a Whole Life policy. The cost of such a policy is higher but worth its value.</p>

<p><font color="0F74D4"><b> Money Back policy</b></font><br/>

This is more of an Endowment policy as part of the amount assured is paid at fixed periods, before the maturity date, in the form of survival benefits. These policies are structured to provide sums required as anticipated expenses over a stipulated period of time.  The premium is payable for a particular period of time. If the insured survives till the expiry of maturity date of the policy, the survival benefits are deducted from the maturity value. </p>
 
<p><font color="0F74D4"><b>Annuities and Pension</b></font><br/>
In an annuity, the insurer agrees to pay the insured a stipulated sum of money periodically. The main purpose of an annuity is to protect against risk as well as provide money in the form of pension at regular intervals. </p>

<p>Over the years, insurers have added various features to basic insurance policies in order to address specific needs of a cross section of people</p>

	  
	 </td></tr></table>
    </div>
<? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right.php';
  }
  ?>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>