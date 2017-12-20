<LINK REL="SHORTCUT ICON" HREF="http://www.deal4loans.com/D4L.ico" type="image/vnd.microsoft.icon">
<link href="style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<style>
.newstyle
{ 
	font-family:verdana;
	color:white;
	font-weight:bold;

}
</style>
</head>
<body >
<div align="center">
<div id="dvContainer">
  <!-- Start Top Panel -->
  <div id="dvTopPanel">
    <div id="dvLogoPanel">
      <div id="dvLogo"><img src="/images/logo.gif" alt="Deal4Loans" onClick="javascript:location.href='index.php'"/></div>
      <div id="dvTopRightPanel">
	    <h1>
	 <?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<font style='Font-size:12px;'>Welcome ".ucwords($_SESSION['UserType'])." <b>".$_SESSION['UName']." ( <a href=/Logout.php>Logout</a> )</b>";
	}		
	?>	  
</h1>
      </div>
    </div>
  </div>  
  <!-- End  Top Panel -->
  <!-- Start Menu Panel -->
  <!-- End  Top Panel -->
  <!-- Start Menu Panel -->  
  <table border="0" cellpadding="4" cellspacing="1" style='border:solid 1px;'width="100%" align="center">
  <? if($_SESSION['BidderID']=='766' || $_SESSION['BidderID']=='1334' )
  {?>
 <tr><td class="newstyle" align="center">
 <a href="/personalloan_index.php">Personal Loan</a> <font style="color:black;"> <b>|</b></font>
<a href="/homeloan_index.php">Home Loan</a><font style="color:black;"> <b> |</b></font>
<a href="/carloan_index.php">Car Loan</a><font style="color:black;"> <b> |</b></font>
<a href="/creditcard_index.php">Credit Card</a> <font style="color:black;"> <b>|</b></font>
 <a href="/Laplogin_index.php">Loan Against Property</a><font style="color:black;"> <b> |</b></font>
<a href="/businessloan_index.php">Business Loan</a> <font style="color:black;"> <b>|</b></font>
<a href="/goldloan_index.php">Gold loan</a></td></tr>
<tr><td class="newstyle" align="center">
<a href="/chat_index.php"><b>Registered Chat Customers</b> </a><font style="color:black;"> <b> |</b></font>
 <a href="/bidderslogin_details_index.php">Bidders Login Details</a><font style="color:black;"> <b> |</b></font>
<a href="/ViewBiddersTrial.php">Bidders Details</a><font style="color:black;"> <b> |</b></font>
<a href="/ProductsCountDetails.php">Productwise Report </a><font style="color:black;"> <b>
 |</b></font> <a href="/getbidderdeatails.php">Bidder List</a>
 </td></tr>
 <tr><td class="newstyle" align="center">
<a href="/quickapply.php">Quick Apply</a><font style="color:black;"> <b>
 |</b></font> <a href="/prepaid_accounts.php">PrePaid Bidders</a><font style="color:black;"><font style="color:black;"> <b>
 |</b></font> <a href="/postpaid_leadcount.php">PostPaid Bidders</a><font style="color:black;"> <b>
 |</b></font> <a href="/incomplete_index.php">Incomplete Data</a><font style="color:black;"> <b> |</b></font><a href="/cc_offer_leads.php">Cc Offer Leads</a><font style="color:black;"> <b> |</b></font>
<a href="/pl_direct_allocate_index.php">PL Direct Allocation</a> </td></tr>
<tr>
<td class="newstyle">
		<a href="/personalloan_postpaid.php">PL Postpaid Direct</a><font style="color:black;"> <b> |</b></font> <a href="/educationloan_index.php">Education Loan</a><font style="color:black;"> <b> |</b></font> <a href="/savemicalc_index.php">Save EMI Calc Leads</a>
		</td></tr>
<? } 
else if($_SESSION['BidderID']=='1674')
{
?>
<tr align="center">
	<td>
		<a href="/bidderslogin_details_index.php">Bidders Login Details</a><font style="color:black;"> <b> |</b></font>
		<a href="/ViewBiddersTrial.php">Bidders Details</a><font style="color:black;"> <b> |</b></font>
<a href="/ProductsCountDetails.php">Productwise Report </a><font style="color:black;"> <b>
 |</b></font> <a href="/getbidderdeatails.php">Bidder List</a>
 <font style="color:black;"> <b> |</b></font>
 <a href="/prepaid_accounts.php">PrePaid Bidders</a><font style="color:black;"><font style="color:black;"> <b>
 |</b></font> <a href="/postpaid_leadcount.php">PostPaid Bidders</a><font style="color:black;">
	<b>|</b>	<a href="/blogs_index.php"> View Blogs</a><font style="color:black;"> <b> |</b></font>
		<a href="/replyblogs_index.php"> Reply Blogs</a> <font style="color:black;"> <b>|</b></font>
		<a href="/testimonial_index.php"> View Testimonials</a> <font style="color:black;"> <b> |</b></font>
		<a href="/prepaidcount_accounts.php"> check Report</a>
	</td>
</tr>
<? }
else
{?>
<tr align="center">
	<td>
		<a href="/creditcard_index.php">Credit Card</a> <font style="color:black;"> <b>|</b></font>
		<a href="/blogs_index.php"> View Blogs</a><font style="color:black;"> <b> |</b></font>
		<a href="/replyblogs_index.php"> Reply Blogs</a> <font style="color:black;"> <b>|</b></font>
		<a href="/testimonial_index.php"> View Testimonials</a> <font style="color:black;"> <b>|</b></font>
		 <a href="/personal_loan_allocation.php">Personal Loan Allocation</a>
	</td>	
</tr>
<? } ?>
 <tr>
     <td>&nbsp;</td></tr></table>
	

  