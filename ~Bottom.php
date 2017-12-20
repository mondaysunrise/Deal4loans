<?php

if($_SESSION['siten']=="ndtv")
{
?>
	
	<div align="center" style=" float:left; width:960px; background-color:#f5f5f5; height: auto; margin-top:10px; ">
	<div class="global">
  <div class="globalcont"><img src="/images/global_nav.gif" width="960" /></div>
</div>
</div>
<?php
}
else
{
?>
<?php
$absolutepath = "/"; 
if(!isset($_SESSION['UserType']))
{
?>
<div id="dvFTMenu"  align="center" >
<?php if(((strlen(strpos($_SERVER['SCRIPT_NAME'], "index.php")) == 0)))
 {?>
<table width="776" cellpadding="0" cellspacing="0" >
	<tr>
		<td align="center" style="padding:8px 0px; ">
	<?php	if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Calculators.php")) > 0))
{
?>
<?php
}
else
{
?>
		
<?php } ?>
</td>
	</tr>
</table>
<? }?>
<?php $absolutepath = "http://www.deal4loans.com/"; ?>

<table bgcolor="#2A72BC" width="776" cellpadding="0" cellspacing="2"  align="center" ><tr><td align="center" style="font:11px; font-family:Arial, Helvetica, sans-serif; color:#FFFFFF;">
<a href="<?php echo $absolutepath; ?>personal-loans.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Personal Loan</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>home-loans.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Home Loan</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>Contents_Car_Loan.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Car Loan</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>credit-cards.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Credit Card</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>Contents_Loan_Against_Property.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Loan Against Property</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>Contents_Business_Loan_Mustread.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Business Loan</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>Contents_Articles.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Articles</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>debt-consolidation-plans.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Debt Consolidation</a>
</td></tr>
<tr>
<td align="center" style="font:11px; font-family:Arial, Helvetica, sans-serif; color:#FFFFFF;"><a href="<?php echo $absolutepath; ?>Contents_Blogs.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Blogs</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>Contents_Feedback.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Testimonials</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>newsletter_archives.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Newsletter</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>mediarelease.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Media Coverage</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>calculators-index.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Calculators</a>&nbsp; <font size="1">|</font> &nbsp;<a href="<?php echo $absolutepath; ?>Contact_Us.php" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-decoration:none;">Contact Us</a></td></tr></table></div>
<?php } ?>
  <div id="dvft">
  <div style=" width:700px; text-align:left; float:left;  color:#5b5b5b; font-size:10px; padding-top:5px;"><b>Disclaimer:</b> Information is sourced from respective Banks websites. We don't provide Loans on our own but ensures your information is sent to bank/agent which you have opted for. We don't do short term loans. Deal4loans has no sales team on its own and we just help you to compare loans .All loans are on discretion of the associated Banks/Agents. <a href="http://www.deal4loans.com/Contents_Disclaimer.php">Read More</a></div>
    <div id="dvFooter"> &copy; Copyright <?php echo date("Y"); ?>, Deal4Loans, India. </div>
    <div id="dvFtlink"> <a href="<?php echo $absolutepath; ?>Privacy.php">Privacy Policy</a> |<a href="<?php echo $absolutepath; ?>Contents_Disclaimer.php"> Disclaimer</a></div>
  </div>
  </div>
  <?php } ?>
  
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>