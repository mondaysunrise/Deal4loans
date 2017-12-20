<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$CityN = $_REQUEST['loan'];

if(strlen(strpos($_SERVER['REQUEST_URI'], "vijaya")) > 0)
{
	header("Location: personal-loans.php");
	exit();
}	

if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	$pageName = "personal-loan/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}

$maxage=date('Y')-62;
$minage=date('Y')-18;

$CityN = $_REQUEST['loan'];
$getPageSql = "select * from city_pages where City='".$CityN."' and Product='Personal Loan' ";
$getPageQuery = ExecQuery($getPageSql);
$Title = mysql_result($getPageQuery,0,'Title');
$MetaKeyword = mysql_result($getPageQuery,0,'MetaKeyword');
$MetaDescription = mysql_result($getPageQuery,0,'MetaDescription');
$PageDescription = mysql_result($getPageQuery,0,'PageDescription');
$City =  ucwords(strtolower(mysql_result($getPageQuery,0,'City')));
$HeaderDEscription = mysql_result($getPageQuery,0,'HeaderDEscription');


	$retrivesource="PL_".$City;
	$newsource=$retrivesource;
	$subjectLine="Personal Loan ".$City;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title; ?></title>
<meta name="keywords" content="<?php echo $MetaKeyword; ?>">
<meta name="description" content="<?php echo $MetaDescription; ?>">
<link href="http://www.deal4loans.com/css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/style-popup.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/inner-styles-onclick.css" />
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/jquery-jscrollpane.css" media="all"/>


<?php include "pl-formcity-jscalc.php"; ?>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="/scripts/jquery.easing-new.js"></script>
		<!-- the jScrollPane script -->
		<!--<script type="text/javascript" src="scripts/jquery.mousewheel-new.js"></script>-->
		<script type="text/javascript" src="/scripts/jquery.contentcarousel-new.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="second_wrapper_pl_new">
<div class="left-container">
<div class="common-bread-crumb" style="width:100%; max-width:970px; margin-top:70px; color:#0a8bd9;"><a href="http://www.deal4loans.com/" style="color:#0080d6;">Home</a> <img src="http://www.deal4loans.com/new-images/breadcrumb_arrow.jpg" width="10" height="9" /> <a href="http://www.deal4loans.com/personal-loans.php" style="color:#0080d6;">Personal Loan</a> <img src="http://www.deal4loans.com/new-images/breadcrumb_arrow.jpg" width="10" height="9" /> <span style="color:#000;"><?php echo $City?> Loans</span></div>
<h1 class="pl-h1">Personal Loan <?php echo $City?></h1>
<div style="clear:both;"></div>
<div class="body_pl_new"><?php echo $HeaderDEscription; ?></div>
<div style="clear:both;"></div>
<div class="pl_form_wrapper_main">
<?php include "pl-formcity-test.php";?>
</div>
<div><img src="http://www.deal4loans.com/new-images/pl-new-shadow_frm_btm.jpg" width="756" height="25" style="width:100%;" /></div>
<div class="bank_listings_box">
<div class="overflow-width">
<table>
 <tr>
      <td height="30" class="h1_text" style="font-size:18px;">Current Personal Loan Interest Rates in <?php echo $City?></td>
    </tr>
  <tr><td>
    <?php
/* Getting Bank's total information regarding loan */
$showBankInfoSql = "select * from personal_loan_banks_eligibility where (pl_bank_flag=1) order by pl_bank_roi ASC";
$showBankInfoQry =  ExecQuery($showBankInfoSql);
$totalBankRecords = mysql_num_rows($showBankInfoQry);
?>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td height="47" width="13%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;">Banks</td>
<td height="47" width="10%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Rate of Interest</td>
<td height="47" width="17%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Processing Fee</td>
        <td height="47" width="18%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Loan Amount</td>
        <td height="47" width="18%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Prepayment Charges</td>
        <td height="47" width="13%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Disbursal Time</td>
        <td height="47" width="10%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;">Part Payment Option</td>
    </tr>
	<?php
	if($totalBankRecords > 0){
		
		$cntr = 1;
		while($showBankInfoResult=mysql_fetch_array($showBankInfoQry)){
		
		if($cntr%2==0){
			$addBgcolor = 'bgcolor="#e0f0fb"';
		}else{
			$addBgcolor = 'bgcolor="#fafdff"';
		}
		$cntr++;
	?>    
    <tr>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin; font-size:14px;"><strong><?php echo $showBankInfoResult['pl_bank_name']; ?></strong></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult['pl_bank_roi']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo nl2br($showBankInfoResult['pl_bank_processing_fee']); ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult['pl_bank_loan_amt']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo nl2br($showBankInfoResult['pl_bank_prepayment']); ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult['pl_bank_disbursal_time']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c"><?php echo $showBankInfoResult['part_payment_option']; ?></td>
    </tr>
    <?php 
		}
	}else{ 
	?>
    <tr>
    	<td colspan="100%" height="64" align="center" bgcolor="#e0f0fb" class="apply_pl_table_text_new-c" style="color:#AE0000; font-size:16px;"> Records not found !</td>
    </tr>
    <?php } ?>
</table>

</td></tr></table>
</div>
<div style="clear:both; height:15px;"></div>
  
</div>
<div style="clear:both;"></div>
<div class="boxes_wrapper_nw" style="overflow:hidden;">
<div id="ca-container" class="ca-container"  >
		    <div class="ca-wrapper" style="overflow:hidden;"  >
				<div class="ca-item ca-item-1">
						<div class="ca-item-main">
														<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" class="eglibily_head" height="35"><h3>Eligibility Criteria</h3></td>
  </tr>
  <tr>
    <td align="left" class="body_pl_new"><em>Eligibility Criteria for Personal Loan in <?php echo $City?></em></td>
  </tr>
  <tr>
    <td align="left" height="10"></td>
  <tr>
    <td align="left" class="body_pl_new">Banks offer Loan to borrowers depending on various factors such <br />as income, employment, continuity of business so as to make sure that they repay the loan with interest before the due date. </td>
  </tr>
  <tr>
    <td align="right"><a href="#" class="ca-more"><img src="http://www.deal4loans.com/new-images/more-pl_box.jpg" width="78" height="21" border="0" /></a></td>
  </tr>
                          </table>
						</div>
						<div class="ca-content-wrapper"><a href="#" class="ca-close">close</a>
							<div class="ca-content" >
								
								
								<div class="ca-content-text" >
                                <div class="wrapper-content">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="body_pl_new">Banks offer  Loan to borrowers depending on various factors such as income, employment,  continuity of business so as to make sure that they repay the loan with  interest before the due date. The eligibility criterion of a personal loans is  primarily based on the work profile of a loan seeker which is broadly divided  into the following two classes: </td>
  </tr>
  <tr>
  <td height="10"></td>
  </tr>
  <tr>
  
    <td><table cellpadding="4" style="border:thin solid #CCC;" cellspacing="0" border="1" width="98%" class="body_pl_new">
      <tr>
        <td align="center"><strong>Salaried</strong></td>
        <td align="center"><strong>Self Employed</strong></td>
      </tr>
      <tr>
        <td><strong>Metros</strong>: Minimum Salary Required is Rs. 15000/- p.m<br />
          <strong>Other Cities</strong>: Minimum Salary is Rs. 12500/- p.m </td>
        <td ><strong>Metros</strong>: Minimum ITR Rs. 150000/-<br />
          <strong>Other Cities</strong>: Minimum ITR Rs. 150000/- </td>
      </tr>
    </table></td>
  </tr>
</table></div>
								</div>
							</div>
						</div>
			  </div>
              
					<div class="ca-item ca-item-2">
						<div class="ca-item-main">
								
<table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" class="eglibily_head"><h3>List of Personal Loans Banks</h3></td>
  </tr>
  <tr>
    <td align="left" class="sbi_text_pl_new" height="24" >HDFC Bank</td>
  </tr>
  <tr>
    <td align="left" class="stnrd_text_pl_new" height="24">ICICI Bank</td>
  </tr>
  <tr>
    <td align="left" class="bob_text_pl_new" height="24">Bajaj Finserv</td>
  </tr>
  <tr>
    <td align="left" class="yes_text_pl_new" height="24">Yes Bank</td>
  </tr>
  <tr>
    <td align="left" class="sbi_text_pl_new" height="24">Canara Bank</td>
  </tr>
  <tr>
  
    <td align="right">
								<a href="#" class="ca-more"><img src="http://www.deal4loans.com/new-images/more-pl_box.jpg" width="78" height="21" border="0" /></a></td>
  </tr>
</table>
						</div>
						<div class="ca-content-wrapper">
							<div class="ca-content">
							<a href="#" class="ca-close">close</a>	
                               								
								<div class="ca-content-text">
									<div class="wrapper-content">
                         <div style="margin-top:10px;"> <table border="1" cellspacing="0" cellpadding="0" align="center" width="100%" class="body_pl_new">
  
    <tr>
      <td width="128"  align="center">HDFC Bank</td>
      <td width="128"  align="center">Bajaj Finserv</td>
      <td width="128" align="center">ICICI Bank</td>
      <td width="128"  align="center">Axis Bank</td>
    </tr>
    <tr>
      <td width="128"  align="center">Fullerton India</td>
      <td width="128"  align="center">ING Vysya</td>
      <td width="128"  align="center">Kotak Bank</td>
      <td width="128"  align="center">HDB Financial Services</td>
    </tr>
    <tr>
      <td width="128"  align="center">Bank of India</td>
      <td width="128" align="center">Union Bank of India</td>
      <td width="128"  align="center">United Bank of India</td>
      <td width="128"  align="center">Punjab National Bank</td>
    </tr>
    <tr>
      <td width="128" >IndusInd Bank</td>
      <td width="128"  align="center">Dena Bank</td>
      <td width="128"  align="center">Andhra Bank</td>
      <td width="128" align="center">Citibank</td>
    </tr>
    <tr>
      <td width="128"  align="center">Indian Bank</td>
      <td width="128"  align="center">Vijaya Bank</td>
      <td width="128"  align="center">Corporation Bank</td>
      <td width="128"  align="center">RBS</td>
    </tr>
  
</table>       </div>  
                                    </div>
								</div>
							</div>
						</div>
					</div>
					<div class="ca-item ca-item-3">
						<div class="ca-item-main">
								
							<table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" class="eglibily_head"><h3>Documents required <br />for Personal Loan</h3></td>
  </tr>
   <tr>
    <td align="left" class="body_pl_new"><em>Documents required for Personal<br /> Loan in <?php echo $City?></em></td>
  </tr>
  <tr>
    <td align="left" height="10" class="body_pl_new"></td>
  </tr>
   <tr>
    <td align="left" height="28" class="body_pl_new"><strong>Identity Proof :</strong> Passport/ Driving License/PAN card/ Photo credit card (with embossed Signature and last two months</td>
  </tr>
  <tr>
    <td align="left" height="28" class="body_pl_new"></td>
  </tr>
  <tr>
    <td align="right">
								<a href="#" class="ca-more"><img src="http://www.deal4loans.com/new-images/more-pl_box.jpg" width="78" height="21" border="0"/></a></td>
  </tr>
</table>
						</div>
						<div class="ca-content-wrapper">
							<div class="ca-content">
								
								<a href="#" class="ca-close">close</a>
								<div class="ca-content-text">
								<div class="wrapper-content">	<table width="98%" border="1" cellspacing="0" cellpadding="0" style="border:thin solid #CCC;" >
  <tr>
    <td class="body_pl_new"><strong>Age Proof : </strong>PAN Card/ Passport/ Driving License / School leaving certificate/ Voter&rsquo;s card/BirthCertificate/ LIC policy (only for age Proof). <strong>(Anyone of the above)</strong>
      <strong>Address Proof : </strong>Passport/ Telephone bill (BSNL/MTNL)/ Electricity bill/ Title deed of property/Rental agreement/ Driving license/ Election ID card/ Photo-credit card (with last two month statements) <strong>(Anyone of the above)</strong><br />
<strong>Income Proof : </strong>Latest salary slip/current dated salary Certificate with latest form 16 <strong>(Anyone of the above)</strong><br />
<strong>Job Continuity Proof : </strong>Form 16/relieving letter/appointment Letter (for last two months)<strong> (Anyone of the above)</strong><br />
<strong>Banking History : </strong>Bank statements of latest 2 months/ 3 months bank passbook <strong>(Anyone of the above)</strong><br /></td>
  </tr>
</table></div>
								</div>
						  </div>
						</div>
					</div>
                    
                    <div class="ca-item ca-item-1">
						<div class="ca-item-main">
														<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" class="eglibily_head" height="35"><h3>Eligibility Criteria</h3></td>
  </tr>
  <tr>
    <td align="left" class="body_pl_new"><em>Eligibility Criteria for Personal Loan in <?php echo $City?></em></td>
  </tr>
  <tr>
    <td align="left" height="10"></td>
  <tr>
    <td align="left" class="body_pl_new">Banks offer Loan to borrowers depending on various factors such <br />as income, employment, continuity of business so as to make sure that they repay the loan with interest before the due date. </td>
  </tr>
  <tr>
    <td align="right"><a href="#" class="ca-more"><img src="http://www.deal4loans.com/new-images/more-pl_box.jpg" width="78" height="21" border="0" /></a></td>
  </tr>
                          </table>
						</div>
						<div class="ca-content-wrapper"><a href="#" class="ca-close">close</a>
							<div class="ca-content" >
								
								
								<div class="ca-content-text" >
                                <div class="wrapper-content">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="body_pl_new">Banks offer  Loan to borrowers depending on various factors such as income, employment,  continuity of business so as to make sure that they repay the loan with  interest before the due date. The eligibility criterion of a personal loans is  primarily based on the work profile of a loan seeker which is broadly divided  into the following two classes: </td>
  </tr>
  <tr>
  <td height="10"></td>
  </tr>
  <tr>
  
    <td><table cellpadding="4" style="border:thin solid #CCC;" cellspacing="0" border="1" width="98%" class="body_pl_new">
      <tr>
        <td align="center"><strong>Salaried</strong></td>
        <td align="center"><strong>Self Employed</strong></td>
      </tr>
      <tr>
        <td><strong>Metros</strong>: Minimum Salary Required is Rs. 15000/- p.m<br />
          <strong>Other Cities</strong>: Minimum Salary is Rs. 12500/- p.m </td>
        <td ><strong>Metros</strong>: Minimum ITR Rs. 150000/-<br />
          <strong>Other Cities</strong>: Minimum ITR Rs. 150000/- </td>
      </tr>
    </table></td>
  </tr>
</table></div>
								</div>
							</div>
						</div>
			  </div>
		</div>
                   
                    <div style="clear:both;"></div>
	  </div>
                   
</div>
<div style="clear:both;"></div>
<div class="text_cont_wrap_new" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="body_pl_new"><br />
	<?php echo $PageDescription; ?>
    <!--<strong>Tips for Best Personal loan deal</strong><br />
    1) Compare exact Emi | Processing fee | Tenure | <a href="http://www.deal4loans.com/loans/personal-loan/personal-loan-documents-requirement-deal4loans/">Documents</a> before choosing bank.<br />
    2) Never pay any fee to any person to get loan sanctioned.Processing fee is deducted from Loan amount.<br />
    3) Only give documents to one bank and check whether he is authorized Bank employee or vendor.--> 
	</td>
  </tr>
</table>
</div>

</div>
<div class="right_container" style="margin-top:70px;">
<div><!-- Place this code where you want the badge to render. -->
<a href="https://plus.google.com/+Deal4loansofficial"
   rel="publisher" target="_top" style="text-decoration:none;display:inline-block;color:#333;text-align:center; font:13px/16px arial,sans-serif;white-space:nowrap;">
<span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px; margin-top:8px;">Deal4loans</span><span style="display:inline-block;vertical-align:top;margin-right:15px; margin-top:8px;">on</span>
<img src="//ssl.gstatic.com/images/icons/gplus-32.png" alt="Google+" style="border:0;width:32px;height:32px;"/>
</a>
</div>
<div><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;width=200&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe></div>
<div class="compare_rightbx">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" align="center" class="comp_text">Compare Offers</td>
    </tr>
    <tr>
      <td><img src="http://www.deal4loans.com/new-images/comp-banks-logo.jpg" width="166" height="154" /></td>
    </tr>
  </table>
</div>
<div class="compare_rightbx" style="margin-top:5px;"><img src="http://www.deal4loans.com/new-images/blinking-right-why.gif" width="165" height="138" /></div>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-6880092259094596";
/* 160x600, created 6/25/10 */
google_ad_slot = "6829559960";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>

</div>
  
<table cellpadding="0" cellspacing="1" border="0" width="100%" align="center">
<tr><td width="70%" valign="top">
<table cellpadding="0" cellspacing="1" border="0">

<tr><td class="text11" style="color:#4c4c4c; padding-left:8px;">
<?php
//echo $HeaderDEscription;
?>
</td></tr></table>
</td></tr></table>
<div style="clear:both;"></div>
</div>
</div>
<?php include("footer_sub_menu.php"); ?>
<script type="text/javascript">
$('#ca-container').contentcarousel();
</script>
</body>
</html>