<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;


$CityN = $_REQUEST['loan'];
/*
if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	$pageName = "property-loan/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}
*/	
$maxage=date('Y')-62;
$minage=date('Y')-18;

$CityN = $_REQUEST['loan'];
 $getPageSql = "select * from city_pages where (City='".$CityN."' and Product='LAP' and Status=1) ";
$getPageQuery = ExecQuery($getPageSql);
$Title = mysql_result($getPageQuery,0,'Title');
$MetaKeyword = mysql_result($getPageQuery,0,'MetaKeyword');
$MetaDescription = mysql_result($getPageQuery,0,'MetaDescription');
$PageDescription = mysql_result($getPageQuery,0,'PageDescription');
$City =  ucwords(strtolower(mysql_result($getPageQuery,0,'City')));
$HeaderDEscription = mysql_result($getPageQuery,0,'HeaderDEscription');

	$retrivesource="LAP_".$City;
	$Msg = "";
	$newsource=$retrivesource;
	//$subjectLine="Loan Against Property ".$City;
	$subjectLine=" Loan Against Property in ".$City;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title><?php echo $Title; ?></title>
<meta name="keywords" content="<?php echo $MetaKeyword; ?>">
<meta name="description" content="<?php echo $MetaDescription; ?>">

<link href="http://www.deal4loans.com/css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
<link href="http://www.deal4loans.com/source.css" rel="stylesheet" type="text/css" />
<link href="http://www.deal4loans.com/css/personal-loan-citywise-styles.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/style-popup.css" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/inner-styles-onclick.css" />
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/jquery-jscrollpane.css" media="all"/>
<script type="text/javascript" src="http://www.deal4loans.com/scripts/mainmenu.js"></script>
<style type="text/css">
<!--
body { margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; background-color: #203f5f;	overflow-x:hidden;	background-color:#FFF;}
.red { color: #F00;} .tblwt_txt { color: #1c50b0; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; font-weight: bold; padding: 2px; }
.tbl_txt {color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; padding: 2px;} #txt a:hover { color: #FF9900;  }
#txt a { color: #1C50B0; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; line-height: 15px; text-decoration: none;}
#txt a { text-decoration: none;} #txt a:link {color: #666666; } #txt a:visited { color: #666666;  } #txt a:active { color: #666666;  } 
h3{	font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	text-decoration:none; color:#1c50b0; padding:0px; margin:0px 0px 0px 0px; text-align:left;}.faqContainer{	padding:10px;}.faqContainer .toggler { padding:5px 0px 0px 15px;font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:13px;	line-height:17px;	font-weight:bold; text-align:justify; background:transparent url(http://www.deal4loans.com/images/bullet12.gif) no-repeat scroll 0px 10px; cursor:pointer;}.elementInside{ border-bottom:1px solid #CCCCCC; margin:4px 0px 4px 0px; padding:4px 0px 5px 0px; font-family: Verdana, Geneva, sans-serif; font-size: 11px;	font-weight: normal; font-variant: normal; color:#4c4c4c; text-decoration: none;}.element_atStart_dv{margin:4px 0px 4px 0px; border-bottom:1px solid #CCCCCC; height:auto; font-family: Verdana, Geneva, sans-serif;	font-size: 11px; font-weight: normal; font-variant: normal; color:#4c4c4c; text-decoration: none; }
</style>
<?php include "lap-form-jscity.php"; ?>
</head>
<body>
<div class="tp_hid_cont"><?php include "top-menu.php"; ?><?php include "main-menu.php"; ?></div>
<div class="second_wrapper_pl_new">
<div class="logo_plnew"><img src="/images/logo.gif" width="243" height="90" /></div>
<div class="left-container">
<div class="breadcrumb_text"><a href="http://www.deal4loans.com/">Home</a> > <a href="/loan-against-property.php">Loan Against Property</a> > <span style="color:#000;">Apply Loan Against Property - <?php echo $City?></span></div>
<h1 class="h1_text">Loan Against Property <?php echo $City?></h1>
<div style="clear:both;"></div>
<div class="pl_form_wrapper_main">
<?php include "lap-formcity.php";?>
</div>
<div><img src="http://www.deal4loans.com/new-images/pl-new-shadow_frm_btm.jpg" width="756" height="25" style="width:100%;" /></div>
<div class="bank_listings_box">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="22" valign="top" >&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"  ><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" style="border: 1px solid #ececec; ">
      <tr>
        <td height="36" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px; "><strong>Banks</strong></strong></td>
        <td height="36" align="center" valign="middle" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;" class="font2"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>up to 30 lacs</strong></strong></td>
        <td height="36" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>30-75 lacs</strong></strong></td>
        <td height="36" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>75 & above</strong></strong></td>
        <td height="36" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>Processing fees</strong></strong></td>
        </tr>
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong>HDFC<br />
        </strong></td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">12.75%<br />
         </td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13.50%</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13.50%</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">1% of the loan amount</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong>Fullerton
          <br />
        </strong></td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"> 15.5%
          <br /></td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">15.5%</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">15.5%</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">1% of the loan amount</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong>Ing vysya 
        </strong></td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13% fixed for 3 years	</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13% fixed for 3 years	</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13% fixed for 3 years	</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">1% + service tax</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong>Axis Bank  
        </strong></td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13% - 14%	</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13% - 14%	</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13% - 14%	</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">1% of the loan amount	</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong>India Bulls          </strong></td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13.50%</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13.50%</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">13.50%</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">1% + service tax</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1;" ><strong>ICICI Bank 
        </strong></td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1;"> 13.25%	
      </td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1;">13.25%	</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1;">13.25%	</td>
        <td align="center" valign="middle" class="font" style="border-right:1px solid #d5cfb1;">0.5% - 1%</td>
      </tr>
    </table></td>
  </tr>
</table> 
</div>
<div style="clear:both;"></div>
<div class="text_cont_wrap_new" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="body_pl_new"><br />
	<?php
echo $HeaderDEscription;
?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="body_pl_new">
     <?php
echo $PageDescription;
?></td>
  </tr>
</table>
</div>
</div>
<div class="right_container">
<div><a href="https://plus.google.com/117667049594254872720?prsrc=3" rel="publisher" target="_top" style="text-decoration:none;display:inline-block;color:#333;text-align:center; font:13px/16px arial,sans-serif;white-space:nowrap;"><span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px; margin-top:8px;">Deal4loans</span><span style="display:inline-block;vertical-align:top;margin-right:15px; margin-top:8px;">on</span><img src="//ssl.gstatic.com/images/icons/gplus-32.png" alt="Google+" style="border:0;width:32px;height:32px;"/></a>
</div>
<div><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;width=200&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe></div>
<div class="compare_rightbx">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="35" align="center" class="comp_text" >Compare Offers</td>
</tr>
<tr>
<td style="font-family:Verdana, Geneva, sans-serif; font-size:14px; padding-left:20px;">
<a href="/property-loan/sbi" style="color:#001f79; text-decoration:none; font-weight:bold;" target="_blank">SBI</a><br />
<a href="/property-loan/hdfc" style="color:#0c3b6f; text-decoration:none; font-weight:bold;" target="_blank">HDFC</a><br />
<a href="/property-loan/icici" style="color:#e13322; text-decoration:none; font-weight:bold;" target="_blank">ICICI </a><br />
<a href="/property-loan/kotak-mahindra" style="color:#0199cd; text-decoration:none; font-weight:bold;" target="_blank">Kotak Mahindra</a><br />
<a href="/property-loan/hsbc" target="_blank" style="color:#d41f27; text-decoration:none; font-weight:bold;">HSBC</a>
</td>
</tr>
</table>
</div>
<div class="compare_rightbx" style="margin-top:5px;"><img src="http://www.deal4loans.com/new-images/Loan-against-property-blink-text-right.gif" width="165" height="138" /></div>
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

<div style="clear:both; height:15px;"></div></div>
<!--partners-->
<!--partners-->
<div class="tp_hid_cont">
<?php include "footer_pl1707.php"; ?></div>
<script type="text/javascript">
			$('#ca-container').contentcarousel();
			
		</script>
</body>
</html>