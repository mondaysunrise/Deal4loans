<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
		
	?>
<html>
<head>
<meta name="keywords" content="Home Loans Testimonials, Personal Loans Testimonials, Credit cards Testimonials, Loan against property Testimonials, Business Loans Testimonials, Car loan Testimonials, Deal4loans Testimonials">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards. Give your feedback on Deal4loans Testimonials.">
<title>Loan Testimonials Deal4loans</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/contentpage.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif" /> </div>
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
          
		   
		   <table cellpadding="0" cellspacing="0" width="520" border="0" class="blueborder" height="385">
   
<tr><td bgcolor="DAEAF9" height="20" ><font style="font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:center;"><font color="#1A5EA2" ><center><b>
										Testimonials</b></center></font></font></td>
										</tr>
										<tr><td valign="top">
                                         <P> <font face="Verdana" size="1" color="0F74D4">
•                                </font> I was able to compare rates & terms for my home loan and got best deal because www.deal4loans.com Keep up the good work.<br>
<b>- Srinath Kumar TCS (Bangalore) </b> </P>

<p> <font face="Verdana" size="1" color="0F74D4">
•                                </font> Got a good deal on my loans with the help of www.deal4loans.com<br>
<b>- Ankit Sharma (Ahmedabad)  </b></p>
</td></tr>
										 <tr>
                                        

                                        
                                        <tr>
                                          <td width="100%" align="center">&nbsp;                                          </td>
                                        </tr></table>
										</td></tr></table>
	  </div>
 
    <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right1.php';
  }
  ?>
</div>  
<?php include '~Bottom.php';?>
  </body>
</html>