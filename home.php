<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$CityN = $_REQUEST['loan'];

if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{	
	$pageName = "home-loan/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}

$maxage=date('Y')-62;
$minage=date('Y')-18;

	$CityN = $_REQUEST['loan'];
	$getPageSql = "select * from city_pages where City='".$CityN."' and Product='Home Loan' ";
list($alreadyExist,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());
$getPageQuerycontr=count($getPageQuery)-1;
$Title = $getPageQuery[$getPageQuerycontr]['Title'];
$MetaKeyword = $getPageQuery[$getPageQuerycontr]['MetaKeyword'];
$MetaDescription = $getPageQuery[$getPageQuerycontr]['MetaDescription'];
$PageDescription = $getPageQuery[$getPageQuerycontr]['PageDescription'];
$City =  ucwords(strtolower($getPageQuery[$getPageQuerycontr]['City']));
$HeaderDEscription = $getPageQuery[$getPageQuerycontr]['HeaderDEscription'];
	$retrivesource="SEO_D4L_HL_".$City;
	$newsource=$retrivesource;
	$subjectLine="Home Loan ".$City;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title; ?></title>
<meta name="keywords" content="<?php echo $MetaKeyword; ?>">
<meta name="description" content="<?php echo $MetaDescription; ?>">
<link href="http://www.deal4loans.com/css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
<link href="http://www.deal4loans.com/css/home-loan-styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/style-popup.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/inner-styles-onclick.css" />
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/jquery-jscrollpane.css" media="all"/>
<script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
<script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<?php include "pl-formcity-jscalc.php"; ?>
<script type="text/javascript">
window.addEvent('domready', function(){
var accordion = new Accordion('h3.atStart', 'div.atStart', {
opacity: false,
onActive: function(toggler, element){
toggler.setStyle('color', '#FF0000');
},
onBackground: function(toggler, element){
toggler.setStyle('color', '#062B5F');
}
}, $('accordion'));
var newTog = new Element('h3', {'class': 'toggler1'}).setHTML('');
var newEl = new Element('div', {'class': 'element1'}).setHTML('');
accordion.addSection(newTog, newEl, 0);
}); 
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="/scripts/jquery.easing-new.js"></script>
<!-- the jScrollPane script -->
<!--<script type="text/javascript" src="scripts/jquery.mousewheel-new.js"></script>-->
<script type="text/javascript" src="/scripts/jquery.contentcarousel-new.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="second_wrapper_pl_new">
  <div class="left-container">
    <div class="text12" style="width:100%; max-width:970px; margin-top:70px; color:#0a8bd9;"><a href="http://www.deal4loans.com/" style="color:#0080d6;">Home</a> > <a href="http://www.deal4loans.com/home-loans.php"  style="color:#0080d6;">Home Loan</a> > <span style="color:#000;"><?php echo $City?> Home Loans</span></div>
    <h1 class="h1_text">Home Loan <?php echo $City?></h1>
    <div style="clear:both;"></div>
    <div class="body_pl_new"><?php echo $HeaderDEscription; ?></div>
    <div style="clear:both;"></div>
    <div class="pl_form_wrapper_main">
      <?php include "hl-formcity-test.php";?>
    </div>
    <div><img src="http://www.deal4loans.com/new-images/pl-new-shadow_frm_btm.jpg" width="756" height="25" style="width:100%;" /></div>
    <div class="bank_listings_box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="30" class="h1_text" style="font-size:18px;">Current Home Loan Interest Rates in <?php echo $City?></td>
        </tr>
        <tr>
          <td><div class="database_boxes">
              <table width="100%" border="0" align="left" cellpadding="0" cellspacing="1">
                <tr class="table_bgcolor">
                  <td height="30" align="center" valign="middle"><strong>Banks</strong></td>
                </tr>
                <tr>
                  <td width="142" height="30" align="center" valign="middle" class="td_border_lrb"><strong>Rate of Interest </strong></td>
                </tr>
                <tr>
                  <td width="142" height="75" align="center" valign="middle" class="td_border_lrb"><strong>Processing Fee </strong></td>
                </tr>
                <tr>
                  <td width="142" height="114" align="center" valign="middle" class="td_border_lrb"><strong>Prepayment Charges </strong></td>
                </tr>
              </table>
            </div>
            <?php
$gethlrates = "Select ndtv_rates,bank_name,bank_url,processing_fee,prepayment_charges From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (5,8,2,203) and flag=1) order by  priority ASC";
list($rowscount,$myrow)=MainselectfuncNew($gethlrates,$array = array());

		 if($rowscount>0)
		 {
		 	$i=0;
		for($j=0;$j<$rowscount;$j++)
		{ ?>
            <div class="database_boxes">
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
                <tr class="table_bgcolor">
                  <td height="30" align="center" valign="middle"><strong><? echo $myrow[$j]["bank_name"];?></strong></td>
                </tr>
                <tr>
                  <td width="142" height="30" align="center" valign="middle" class="td_border_rb"><? echo $myrow[$j]["ndtv_rates"];?></td>
                </tr>
                <tr>
                  <td width="142" height="75" align="center" valign="middle" class="td_border_rb"><? echo $myrow[$j]["prepayment_charges"];?></td>
                </tr>
                <tr>
                  <td width="142" height="114" align="center" valign="middle" class="td_border_rb"><? echo $myrow[$j]["processing_fee"];?></td>
                </tr>
              </table>
            </div>
            <? 
			   $i=$i+1;
			   }
			   }
			   ?></td>
        </tr>
      </table>
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
                  <td align="left" class="body_pl_new"><em>Eligibility Criteria for Home Loan in <?php echo $City?></em></td>
                </tr>
                <tr>
                  <td align="left" height="10"></td>
                <tr>
                  <td align="left" class="body_pl_new">The  borrower's eligibility of getting a housing loan depend upon his/her repayment  capacity &amp; the banks establish this repayment capacity by considering  various factors such income, spouse's income, age, assets etc. </td>
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
                        <td class="body_pl_new">The  borrower's eligibility of getting a housing loan depend upon his/her repayment  capacity &amp; the banks establish this repayment capacity by considering  various factors such income, spouse's income, age, number of dependants  qualifications , assets, liabilities, stability and continuity of occupation  and savings history. <a href="http://www.deal4loans.com/home-loan-calculator.php">Calculate your  Eligibility for Home loan</a><br />
                          Your <a href="http://www.deal4loans.com/home-loans.php">Home  Loan</a> eligibility is determined by your repayment capacity, taking into  consideration, factors such as: Your:<br />
                          • Income<br />
                          • Qualifications<br />
                          • Age<br />
                          • Spouse's income<br />
                          • No. of dependants<br />
                          • Stability and continuity of occupation<br />
                          • Assets/LiabilitiesM.<br />
                          • Savings history.<br />
                          The most important concern of banks in determining your loan eligibility is  that whether or not you are contentedly able to pay off the amount you borrow. </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="ca-item ca-item-2">
            <div class="ca-item-main">
              <table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td align="left" class="eglibily_head"><h3>List of Home Loans Banks</h3></td>
                </tr>
                <tr>
                  <td align="left" class="sbi_text_pl_new" height="24" >State Bank of India(SBI)</td>
                </tr>
                <tr>
                  <td align="left" class="stnrd_text_pl_new" height="24">HDFC Ltd</td>
                </tr>
                <tr>
                  <td align="left" class="bob_text_pl_new" height="24">LIC Housing Finance</td>
                </tr>
                <tr>
                  <td align="left" class="yes_text_pl_new" height="24">ICICI Bank</td>
                </tr>
                <tr>
                  <td align="left" class="sbi_text_pl_new" height="24">Axis Bank</td>
                </tr>
                <tr>
                  <td align="right"><a href="#" class="ca-more"><img src="http://www.deal4loans.com/new-images/more-pl_box.jpg" width="78" height="21" border="0" /></a></td>
                </tr>
              </table>
            </div>
            <div class="ca-content-wrapper">
              <div class="ca-content"> <a href="#" class="ca-close">close</a>
                <div class="ca-content-text">
                  <div class="wrapper-content">
                    <div style="margin-top:10px;">
                      <table border="1" cellspacing="0" cellpadding="4" width="100%">
                        <tr>
                          <td  valign="top" align="center">State Bank of India(SBI)</td>
                          <td  valign="top" align="center">HDFC Ltd</td>
                          <td  valign="top" align="center">LIC Housing Finance</td>
                          <td  valign="top" align="center">ICICI Bank</td>
                          <td  valign="top" align="center">Axis Bank</td>
                        </tr>
                        <tr>
                          <td  valign="top" align="center">Fedbank</td>
                          <td  valign="top" align="center">PNB Housing</td>
                          <td  valign="top" align="center">ING Vysya</td>
                          <td  valign="top" align="center">Kotak Bank</td>
                          <td  valign="top" align="center">DHFL</td>
                        </tr>
                        <tr>
                          <td  valign="top" align="center">Bank of Baroda</td>
                          <td  valign="top" align="center">Bank of India</td>
                          <td  valign="top" align="center">Union Bank of India</td>
                          <td  valign="top" align="center">United Bank of India</td>
                          <td  valign="top" align="center">Punjab National Bank</td>
                        </tr>
                        <tr>
                          <td  valign="top" align="center">Standard Chartered</td>
                          <td  valign="top" align="center">IndusInd Bank</td>
                          <td  valign="top" align="center">IDBI Housing Finance</td>
                          <td  valign="top" align="center">Andhra Bank</td>
                          <td  valign="top" align="center">Citibank</td>
                        </tr>
                        <tr>
                          <td  valign="top">Canara Bank</td>
                          <td  valign="top">Indian Bank</td>
                          <td  valign="top">Vijaya Bank</td>
                          <td  valign="top">Corporation Bank</td>
                          <td  valign="top">IDBI Bank</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="ca-item ca-item-3">
            <div class="ca-item-main">
              <table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td align="left" class="eglibily_head"><h3>Documents required <br />
                      for Home Loan</h3></td>
                </tr>
                <tr>
                  <td align="left" class="body_pl_new"><em>Documents required for Home<br />
                    Loan in <?php echo $City?></em></td>
                </tr>
                <tr>
                  <td align="left" height="10" class="body_pl_new"></td>
                </tr>
                <tr>
                  <td align="left" height="28" class="body_pl_new">Generally the documents required to processing your loan application are almost similar  across all the banks; however they may differ with various banks</td>
                </tr>
                <tr>
                  <td align="left" height="28" class="body_pl_new"></td>
                </tr>
                <tr>
                  <td align="right"><a href="#" class="ca-more"><img src="http://www.deal4loans.com/new-images/more-pl_box.jpg" width="78" height="21" border="0"/></a></td>
                </tr>
              </table>
            </div>
            <div class="ca-content-wrapper">
              <div class="ca-content"> <a href="#" class="ca-close">close</a>
                <div class="ca-content-text">
                  <div class="wrapper-content"> Generally the  documents required to processing your loan application are almost similar  across all the banks; however they may differ with various banks depending upon  specific requirement etc. Following documents are required by financial  institutions to process the loan application: <br />
                    · Age Proof <br />
                    · Address Proof <br />
                    · Income Proof of the  applicant &amp; co-applicant <br />
                    · Last 6 months bank  A/C statement <br />
                    · Passport size  photograph of the applicant &amp; co-applicant<br />
                    <table cellpadding="4" cellspacing="0" border="1" width="100%">
                      <tr>
                        <td align="center" width="42%"><strong>Salaried</strong></td>
                        <td width="58%" align="center"><strong>Self Employed</strong></td>
                      </tr>
                      <tr>
                        <td valign="top">· Employment  certificate from the employer, <br />
                          · Copies of pay slips  for last few months and TDS certificate <br />
                          · Latest Form 16 issued  by employer Bank statements</td>
                        <td > · Copy of audited  financial statements for the last 2 years <br />
                          · Copy of partnership  deed if it is a partnership firm or copy of memorandum of association and  articles of association if it is a company <br />
                          · Profit and loss  account for the last few years <br />
                          · Income tax assessment  order </td>
                      </tr>
                    </table>
                  </div>
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
                  <td align="left" class="body_pl_new"><em>Eligibility Criteria for Home Loan in <?php echo $City?></em></td>
                </tr>
                <tr>
                  <td align="left" height="10"></td>
                <tr>
                  <td align="left" class="body_pl_new">The  borrower's eligibility of getting a housing loan depend upon his/her repayment  capacity &amp; the banks establish this repayment capacity by considering  various factors such income, spouse's income, age, assets etc. </td>
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
                        <td class="body_pl_new">The  borrower's eligibility of getting a housing loan depend upon his/her repayment  capacity &amp; the banks establish this repayment capacity by considering  various factors such income, spouse's income, age, number of dependants  qualifications , assets, liabilities, stability and continuity of occupation  and savings history. <a href="http://www.deal4loans.com/home-loan-eligibility-calculator.php">Calculate your  Eligibility for Home loan</a><br />
                          Your <a href="http://www.deal4loans.com/home-loans.php">Home  Loan</a> eligibility is determined by your repayment capacity, taking into  consideration, factors such as: Your:<br />
                          • Income<br />
                          • Qualifications<br />
                          • Age<br />
                          • Spouse's income<br />
                          • No. of dependants<br />
                          • Stability and continuity of occupation<br />
                          • Assets/LiabilitiesM.<br />
                          • Savings history.<br />
                          The most important concern of banks in determining your loan eligibility is  that whether or not you are contentedly able to pay off the amount you borrow.</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="clear:both;"></div>
      </div>
    </div>
    <div style="clear:both;"></div>
    <div class="text_cont_wrap_new" align="center">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="body_pl_new"><br />
            <?php echo $PageDescription; ?></td>
        </tr>
      </table>
      <?php 
$getStateSql = "select * from city_pages where City='".$CityN."' and Product='Home Loan' ";
list($CountVal,$getSateQuery)=MainselectfuncNew($getStateSql,$array = array());
$State = $getSateQuery[0]['State'];
$getCitySql = "select * from city_pages where City!='".$CityN."' and state='".$State."' and Product='Home Loan' ";
list($CityCount,$getCityQuery)=MainselectfuncNew($getCitySql,$array = array());
?>
<div class="state-main-box">
<div class="head-left">Find Home Loan Deals in Your City</div>
<div class="righthead"><a style="text-decoration:none !important;" href="http://www.deal4loans.com/loans-in/<?php echo $State;?>">Home Loan <?php echo ucwords($State);?></a></div>
<div style="clear:both;"></div>
<div>
<ul style="list-style:none;">
<?php 
for($j=0;$j<$CityCount;$j++)
	{
$City = $getCityQuery[$j]['City'];
?>
<li class="state-box"><a href="http://www.deal4loans.com/home-loan/<?php echo $City;?>" alt="<?php echo ucfirst($City);?> Home Loan"><?php echo ucfirst($City); ?></a></li>
<?php 
	}

 ?>
</ul>
</div>
<div style="clear:both;"></div>
</div>
      
      
      
    </div>
  </div>
  <div class="right_container" style="margin-top:70px;">
    <div><!-- Place this code where you want the badge to render. --> 
      <a href="https://plus.google.com/+Deal4loansofficial"
   rel="publisher" target="_top" style="text-decoration:none;display:inline-block;color:#333;text-align:center; font:13px/16px arial,sans-serif;white-space:nowrap;"> <span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px; margin-top:8px;">Deal4loans</span><span style="display:inline-block;vertical-align:top;margin-right:15px; margin-top:8px;">on</span> <img src="//ssl.gstatic.com/images/icons/gplus-32.png" alt="Google+" style="border:0;width:32px;height:32px;"/> </a> </div>
    <div>
      <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;width=200&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
    </div>
    <div class="compare_rightbx">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" align="center" class="comp_text">Compare Offers</td>
        </tr>
        <tr>
          <td><img src="http://www.deal4loans.com/new-images/banks-logo-home-loans.jpg" width="166" height="113" /></td>
        </tr>
      </table>
    </div>
    <div class="compare_rightbx" style="margin-top:5px;"><img src="http://www.deal4loans.com/new-images/home-loan-blink-text-right.gif" width="165" height="138" /></div>
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
<div style="clear:both;"></div>
</div>
</div>
<?php include("footer-loansinindia.php"); ?>
<script type="text/javascript">
			$('#ca-container').contentcarousel();
		</script>
</body>
</html>