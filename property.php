<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

$CityN = $_REQUEST['loan'];

if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	$pageName = "property-loan/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}

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

	$retrivesource="SEO_D4L_LAP_".$City;
	$Msg = "";
	$newsource=$retrivesource;
	//$subjectLine="Loan Against Property ".$City;
	$subjectLine=" Loan Against Property in ".$City;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title><?php echo $Title; ?></title>
<meta name="keywords" content="<?php echo $MetaKeyword; ?>">
<meta name="description" content="<?php echo $MetaDescription; ?>">
<link href="http://www.deal4loans.com/css/loan-against-property-styles.css" type="text/css" rel="stylesheet"  />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/inner-styles-onclick.css" />
<link rel="stylesheet" type="text/css" href="http://www.deal4loans.com/css/jquery-jscrollpane.css" media="all"/>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<?php include "lap-form-jscity.php"; ?>

</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="lap_inner_wrapper">
<div class="lac-left-box">

<div class="common-bread-crumb" style="width:100%; max-width:970px;  margin-top:70px; color:#0a8bd9;"><a href="http://www.deal4loans.com/" style="color:#0080d6;">Home</a> > <a href="/loan-against-property.php" style="color:#0080d6;">Loan Against Property</a> > <span style="color:#000;">Apply Loan Against Property - <?php echo $City?></span></div>

<h1 class="lap-h1">Loan Against Property <?php echo $City?></h1>
<div style="clear:both;"></div>

<div class="body_pl_new"><?php echo $HeaderDEscription; ?></div>
<div style="clear:both;"></div>

<div class="pl_form_wrapper_main">
<?php include "lap-formcity.php";?>
</div>
<div><img src="http://www.deal4loans.com/new-images/pl-new-shadow_frm_btm.jpg" width="756" height="25" style="width:100%;" /></div>
<div class="overflow-width">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="table_bgcolor_Border">
      <tr class="table_bgcolor">
        <td height="36" align="center" valign="middle"><strong>Banks</strong></td>
<td height="36" align="center" valign="middle"><strong>up to 30 lacs</strong></strong></td>
        <td height="36" align="center" valign="middle"><strong>30-75 lacs</strong></strong></td>
        <td height="36" align="center" valign="middle"><strong>75 & above</strong></td>
        <td height="36" align="center" valign="middle"><strong>Processing fees</strong></td>
        </tr>
<?php
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
$getRatesSql = "select * FROM  `lap_interest_rate` where Status =1 and B_id in (1,27,4,17,7,3) order by Sequence asc";
$getRatesQuery = ExecQuery($getRatesSql);
$getRatesNumRows = mysql_num_rows($getRatesQuery);
$BankURL = '';
$link1 = '';
$link2 = '';
for($i=0;$i<$getRatesNumRows;$i++)
{
	$BankURL = '';
	$link1 = '';
	$link2 = '';
	$BankName = mysql_result($getRatesQuery,$i,'BankName');
	$Upto30 = mysql_result($getRatesQuery,$i,'Upto30');
	$Upto75 = mysql_result($getRatesQuery,$i,'Upto75');
	$Above75 = mysql_result($getRatesQuery,$i,'Above75');
	$ProcessingFee = mysql_result($getRatesQuery,$i,'ProcessingFee');
	$BankURL = mysql_result($getRatesQuery,$i,'BankURL');

?>
      <tr>
        <td height="30" align="center" valign="middle" bgcolor="#FFFFFF"><strong><a href="<?php echo $BankURL;?>"><?php echo $BankName; ?></a><br />
        </strong></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $Upto30; ?>
         </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $Upto75; ?></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $Above75; ?></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $ProcessingFee; ?></td>
      </tr>
<?php } ?>
    </table> 
</div>
<div style="clear:both;"></div>
<div class="text_cont_wrap_new" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="body_pl_new"><br />
	<?php echo $PageDescription; ?>
    </td>
  </tr>
</table>
<?php 
$getStateSql = "select * from city_pages where City='".$CityN."' and Product='LAP' and Status=1";
list($CountVal,$getSateQuery)=MainselectfuncNew($getStateSql,$array = array());
$State = $getSateQuery[0]['State'];
$getCitySql = "select * from city_pages where City!='".$CityN."' and state='".$State."' and Product='LAP' and Status=1";
list($CityCount,$getCityQuery)=MainselectfuncNew($getCitySql,$array = array());
?>
<div class="state-main-box">
<div class="head-left">Find Property Loans in Your City</div>
<div class="righthead"><a style="text-decoration:none !important;" href="http://www.deal4loans.com/loans-in/<?php echo $State;?>">Loan against Property <?php echo ucwords($State);?></a></div>
<div style="clear:both;"></div>
<div>
<ul style="list-style:none;">
<?php 
for($j=0;$j<$CityCount;$j++)
	{
$City = $getCityQuery[$j]['City'];
?>
<li class="state-box"><a href="http://www.deal4loans.com/property-loan/<?php echo $City;?>" alt="<?php echo ucfirst($City);?> Property Loan"><?php echo ucfirst($City); ?></a></li>
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
<div><a href="https://plus.google.com/+Deal4loansofficial" rel="publisher" target="_top" style="text-decoration:none;display:inline-block;color:#333;text-align:center; white-space:nowrap;"><span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px; margin-top:8px;">Deal4loans</span><span style="display:inline-block;vertical-align:top;margin-right:15px; margin-top:8px;">on</span><img src="//ssl.gstatic.com/images/icons/gplus-32.png" alt="Google+" style="border:0;width:32px;height:32px;"/></a>
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
<?php include("footer-loansinindia.php"); ?>
<script type="text/javascript">
			$('#ca-container').contentcarousel();
			
		</script>
</body>
</html>