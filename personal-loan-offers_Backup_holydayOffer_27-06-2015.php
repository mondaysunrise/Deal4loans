<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Personal Loan Festival Offers | Deal4loans</title>
<link href="source.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="lac-main-wrapper">
<div class="common-bread-crumb" style="margin:auto; margin-top:70px;"><a href="index.php">Home</a> > Personal Loan Festival Offers</div>
<div style="clear:both; height:15px;"></div>
<div class="intrl_txt">
<h1 class="d4l-h1">Personal Loan Festival Offers</h1>
<div style="clear:both; height:15px;"></div>

<!--class="lfttxtbar" -->

<div>
  <p>Deal4loans introduces exciting Rewards offers for its  customers who successfully avails the information services from Deal4loans.com<br />
    <br />
    Apply for a Personal  Loan through Deal4loans and get Better Deals, as we offer our customers with  additional benefits of reward offers on successful Loan Applications </p>
  <p>Whatever  your financial requirements are, just apply with us and get benefited with exclusive  gift offers: </p>
  <table border="0" cellspacing="2" cellpadding="5" width="100%" class="table_bgcolor_Border">
    <tr class="table_bgcolor">
      <td align="center" height="30"><strong>Loan Amount </strong></td>
      <td align="center"><strong>Gift Item</strong></td>
      <td align="center"><strong>Worth </strong></td>
    </tr>
    <tr>
      <td width="189" align="center" valign="bottom" nowrap="nowrap" bgcolor="#FFFFFF"><p><strong> <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 1 lac - <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 3 Lac</strong></p></td>
      <td width="505" valign="bottom" bgcolor="#FFFFFF"><p><strong>Wrist Watch</strong></p></td>
      <td width="116" align="center" valign="bottom" nowrap="nowrap" bgcolor="#FFFFFF"><p><strong>MRP <img src="http://www.deal4loans.com/new-images/rupees.gif" border="0" /> 2999</strong></p></td>
    </tr>
    <tr>
      <td width="189" align="center" valign="bottom" nowrap="nowrap"  bgcolor="#FFFFFF"><p><strong>Above <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 3 lac - <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 6 lac </strong></p></td>
      <td width="505" valign="bottom"  bgcolor="#FFFFFF"><p><strong><u>Combo Offer</u></strong><strong>: <br />
          Wrist Watch +  Sunglasses<u></u></strong></p></td>
      <td width="116" align="center" valign="bottom" nowrap="nowrap" bgcolor="#FFFFFF"><p><strong>MRP <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 7000</strong></p></td>
    </tr>
    <tr>
      <td width="189" align="center" valign="bottom" nowrap="nowrap" bgcolor="#FFFFFF"><p><strong> Above <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 6 lac - <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 10 lac </strong></p></td>
      <td width="505" valign="bottom" bgcolor="#FFFFFF"><p><strong><u>Combo Offer:</u><br />
          Wrist Watch +  Sunglasses </strong> + <strong>Wallet</strong></p></td>
      <td width="116" align="center" valign="bottom" nowrap="nowrap" bgcolor="#FFFFFF"><p><strong>MRP <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 8,300</strong></p></td>
    </tr>
    <tr>
      <td width="189" align="center" valign="bottom" nowrap="nowrap"  bgcolor="#FFFFFF"><p><strong> <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 10 lac above </strong></p></td>
      <td width="505" valign="bottom"  bgcolor="#FFFFFF"><p><strong><u>Combo Offer:</u><br />
          Wrist Watch +  Sunglasses +  Wallet</strong> + <strong> Trolley Bag </strong></p></td>
      <td width="116" align="center" valign="bottom" nowrap="nowrap"  bgcolor="#FFFFFF"><p><strong>MRP <img src="http://www.deal4loans.com/new-images/rupees.gif" alt="" border="0" /> 13,800</strong></p></td>
    </tr>
  </table>
  <p>
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td>
        <h3><strong>To  avail this offer</strong></h3>
       </td>
      <td><span style="float:right;font-size:22px;" class="text"><strong><a href="http://www.deal4loans.com/apply-personal-loan-continue.php">Apply for  Personal Loan</a></strong></span></td>
    </tr>
  </table>
  </p>
  <ul>
    <li>Apply Personal Loan through Deal4loans.com.</li>
    <li>On successful disbursal of Personal Loan from Deal4loans.com associated Banks under Deal4loans.com Reference Code.</li>
    <li>Send us a mail at specialoffers@deal4loans.com along with <strong>disbursement letter from the lender</strong>, <strong>Full Name, Contact Number,Email ID &amp; Address </strong> used at applying at Deal4loans.com</li>
    <li>Validated entries will get the reward item within 30 days  duration.</li>
  </ul>
  <p>The offer is valid till
    <?php
  $curDate = date("n");
  if($curDate==1 || $curDate==3 || $curDate==5 || $curDate==7 || $curDate==8 || $curDate==10 || $curDate==12)
  { echo "31th ";  }  else if($curDate==2) { echo "28th ";}  else {echo "30th "; }  echo date("F Y");
  ?>
    , so apply now and  treat yourself with an exciting gift during this festive season.</p>
  <p><strong>Please note</strong>: The gifts  offered on your loan application is not a part of your loan, has nothing to do with your financer/banker/lender and hence does not affect your loan quotes.</p>
 
  <h3><strong>Process Notification</strong></h3>
  <strong>This promotion is funded under special sales promotion scheme  of WRS Info. India Pvt. Ltd. (Deal4loans.com) </strong>
  <ol start="1" type="1">
    <li>The       Gift offer is <strong>available only if the loan is taken through Our network       within 60 days of applying on our Site.</strong></li>
    <li>To make a claim for the gift item,&nbsp;send an&nbsp;<strong>email to&nbsp;specialoffers@deal4loans.com within 90 days of applying on our Site. Thereafter no claim (for the gift item) will be entertained at any cost.</strong></li>
    <li>Mail us a scanned copy of the&nbsp;<strong>disbursement letter from the lender</strong>&nbsp;containing       the detailed terms and conditions of the loan. </li>
    <li>Mention Your residence address where the gift has to be  delivered, one used at the time       of registration.  </li>
    <li>Mention <strong>your details like Full Name, Contact Number &amp; Email ID</strong>&nbsp;(Both       used to Register with deal4loans during loan application).</li>
    <li>Once the gift item is  delivered  to you  <strong>send us a confirmation       on&nbsp;</strong>specialoffers@deal4loans.com. </li>
  </ol>
 
  <h3><strong>Terms  &amp; conditions:</strong></h3>
 
  <p><strong>This promotion is funded under a special sales promotion scheme  from WRS info. India Pvt. Ltd. (Deal4loans.com)</strong></p>
  <p>The consumer's (You or Your) personal loan application will  be forwarded to Our network who will co-ordinate directly with You for  finalizing Your loan disbursement.<br />
    <strong>Gift items on offer is available only if the loan is taken successfully through Our network within 60 days of applying on our Site.</strong> If you take loan other than our network then the scheme is not applicable in this case, to check the network where your application is forwarded check your Email ID through which you have applied on Deal4loans.com. If your Loan is not disbursed through our network, you will not be  entitled to avail this offer. These gift offers are valid and applicable only if your Personal Loan is disbursed through our network.</p>
  <p><strong>Credit is at the sole discretion of the lender and this  promotion in no way guarantees that You will actually be eligible for a loan.</strong><br />
    Lenders follow different practices regarding return of  documentation on loan applications that are rejected and We or Our network  takes no responsibility for return of documents for cases that are rejected by  the lender.</p>
  <p><strong><u>Please  do not pay any fees in cash or cheque or any other mode to any entity including  our network.</u></strong><br />
    The processing fee will be deducted from Your disbursement  if the loan is approved. We are not responsible for any losses caused due to  payment of any amount to any entity including our network.&nbsp;<br />
    <br />
    This offer is available in selected cities in India only and for Indian Residents  only.<br />
    <br />
    You will need to make a claim for gift items&nbsp;by sending an email to&nbsp;specialoffers@deal4loans.com  within 90 days of applying on our Site and include a scanned copy of the  disbursement letter from the lender containing the detailed terms and  conditions of the loan You will also need to fill the form  with your detail. Gift Item will be couriered  to you within 30 Days.<br />
    <br>
    Gift offers are discretion of the Deal4loans.com. and shall not be questioned/challenged at any cost nor can be claimed as a matter of right.</p>
  <p><span style="color:#FF0000;">**</span><i>All gift items offered above are from recognised brands.</i><br />
    <br />
    All disputes are subject to the jurisdiction of Courts in Delhi.<br />
    <br />
    Subject to change without prior notice. </p>
  <br />
  </div>
 </div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
