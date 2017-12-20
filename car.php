<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$CityN = $_REQUEST['loan'];

if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	$pageName = "car-loan/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}
$maxage=date('Y')-62;
$minage=date('Y')-18;

$getPageSql = "select * from city_pages where City='".$CityN."' and Product='Car Loan' ";

list($Getnum,$MyRows)=Mainselectfunc($getPageSql,$array = array());

$Title = $MyRows['Title'];
$MetaKeyword = $MyRows['MetaKeyword'];
$MetaDescription = $MyRows['MetaDescription'];
$PageDescription = $MyRows['PageDescription'];
$City =  ucwords(strtolower($MyRows['City']));
$HeaderDEscription = $MyRows['HeaderDEscription'];
$retrivesource="SEO_D4L_CL_".$City;
	$newsource=$retrivesource;
	$subjectLine="Car Loan ".$City;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title; ?></title>
<meta name="keywords" content="<?php echo $MetaKeyword; ?>">
<meta name="description" content="<?php echo $MetaDescription; ?>">
<link href="http://www.deal4loans.com/css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
<link href="http://www.deal4loans.com/css/car-loan-styles.css" type="text/css" rel="stylesheet"  />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-list-clhdfc.js"></script>
<script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style type="text/css">
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}

</style>
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
<script type="text/javascript" src="/scripts/jquery.contentcarousel-new.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?><div style="clear:both;"></div>
<div class="cl_inner_wrapper">
<div class="cl_left_box">
<div class="text12" style="width:100%; max-width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="http://www.deal4loans.com/car-loans.php">Car Loan</a> > <span style="color:#000;"><?php echo $City?> Car Loans</span></div>

<h1 class="cl-h1">Car Loan <?php echo $City?></h1>
<div style="clear:both;"></div>
<div ><?php echo $HeaderDEscription; ?></div>
<div style="clear:both;"></div>
<div class="pl_form_wrapper_main">
<?php include "cl-formcity.php";?>
</div>
<div><img src="http://www.deal4loans.com/new-images/pl-new-shadow_frm_btm.jpg" width="100%" height="25" style="width:100%;" /></div>
<div class="bank_listings_box">

  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  style="border: 1px solid #ececec; ">
<tr>
  <td valign="top"  >
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="table_bgcolor_Border">
      <tr class="table_bgcolor">
        <td height="53" align="center" valign="middle"><strong>Banks/Rates</strong></td>
        <td height="53" align="center" valign="middle"><strong>HDFC Bank</strong></td>
        <td height="53" align="center" valign="middle"><strong>Kotak</strong></strong></td>
        <td height="53" align="center" valign="middle"><strong>Axis Bank</strong></td>
        <td height="53" align="center" valign="middle"><strong>State Bank of India (SBI)</strong></td>
        </tr>
      <tr bgcolor="#FFFFFF">
        <td width="25%" height="57" align="center" valign="middle"><strong>New Car Loan </strong><br />
       </td>
        <td width="25%" align="center" valign="middle"><strong>9.45% - 12.50%</strong></td>
        <td width="25%" align="center" valign="middle"><strong>11.50% - 13.50%</strong></td>
        <td width="25%" align="center" valign="middle"><strong>9.40% - 12.00%</strong></td>
        <td width="25%" align="center" valign="middle"><strong>9.45%( for WOMEN)
9.50%( for Others)
</strong></td>
      </tr>
        
      <tr bgcolor="#FFFFFF">
        <td height="51" align="center" valign="middle"  ><b>Processing Fee</b></td>
        <td align="center" valign="middle">Up to 2.5 Lakhs: Rs.  3220/-, (Above 2.5 Lac, Rs.4390/- to Rs.5870/-)</td>
        <td align="center" valign="middle">Rs.3300/- to Rs.4750/-</td>
        <td align="center" valign="middle">Rs.3500/- to Rs.5500/-</td>
        <td align="center" valign="middle">Nil</td>
      </tr>
    </table></td></tr></table>
  
</div>
<div style="clear:both;"></div>
<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="body_pl_new"><br />
	<?php echo $PageDescription; ?>
    </td>
  </tr>
</table>

<?php 
$getStateSql = "select * from city_pages where City='".$CityN."' and Product='Car Loan' ";
list($CountVal,$getSateQuery)=MainselectfuncNew($getStateSql,$array = array());
$State = $getSateQuery[0]['State'];
$getCitySql = "select * from city_pages where City!='".$CityN."' and state='".$State."' and Product='Car Loan' ";
list($CityCount,$getCityQuery)=MainselectfuncNew($getCitySql,$array = array());
?>
<div class="state-main-box">
<div class="head-left">Find Car Loan Deals in Your City</div>
<div class="righthead"><a style="text-decoration:none !important;" href="http://www.deal4loans.com/loans-in/<?php echo $State;?>">Car Loan <?php echo ucwords($State);?></a></div>
<div style="clear:both;"></div>
<div>
<ul style="list-style:none;">
<?php 
for($j=0;$j<$CityCount;$j++)
	{
$City = $getCityQuery[$j]['City'];
?>
<li class="state-box"><a href="http://www.deal4loans.com/car-loan/<?php echo $City;?>" alt="<?php echo ucfirst($City);?> Car Loan"><?php echo ucfirst($City); ?></a></li>
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
<div><a href="https://plus.google.com/+Deal4loansofficial" rel="publisher" target="_top" style="text-decoration:none;display:inline-block;color:#333;text-align:center; font:13px/16px arial,sans-serif;white-space:nowrap;"><span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px; margin-top:8px;">Deal4loans</span><span style="display:inline-block;vertical-align:top;margin-right:15px; margin-top:8px;">on</span><img src="//ssl.gstatic.com/images/icons/gplus-32.png" alt="Google+" style="border:0;width:32px;height:32px;"/></a>
</div>
<div><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;width=200&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe></div>
<div class="compare_rightbx">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="35" align="center" class="comp_text" >Compare Offers</td>
</tr>
<tr>
<td style="font-family:Verdana, Geneva, sans-serif; font-size:14px; padding-left:20px;">
<a href="http://www.deal4loans.com/loans/car-loan/hdfc-car-loan-eligibility-interest-rates-and-documents-requirement-for-apply-hdfc-bank-car-loans/" style="color:#001f79; text-decoration:none; font-weight:bold;" target="_blank">HDFC Bank</a><br />
<a href="http://www.deal4loans.com/loans/car-loan/icici-bank-car-loans/" style="color:#0c3b6f; text-decoration:none; font-weight:bold;" target="_blank">ICICI Bank</a><br />
<a href="http://www.deal4loans.com/loans/car-loan/kotak-car-loans-eligibility-documents-interest-rates-apply/" style="color:#e13322; text-decoration:none; font-weight:bold;" target="_blank">Kotak Mahindra</a><br />
<a href="http://www.deal4loans.com/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/" style="color:#0199cd; text-decoration:none; font-weight:bold;" target="_blank">SBI</a><br />
<a href="http://www.deal4loans.com/loans/car-loan/magma-fincorp-car-loan-interest-rates-documents-eligibility/" target="_blank" style="color:#d41f27; text-decoration:none; font-weight:bold;">Magma Fincorp</a>
</td>
</tr>
</table>
</div>
<div class="compare_rightbx" style="margin-top:5px;"><img src="http://www.deal4loans.com/new-images/car-loan-blink-text-right.gif" width="165" height="138" /></div>
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
</div>
</body>
</html>