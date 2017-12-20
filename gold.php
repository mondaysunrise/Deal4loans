<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$CityN = $_REQUEST['loan'];

if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	$pageName = "gold-loan/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}
$TagLine = "Get Instant Quote on Gold Loan in ".ucfirst($CityN);
$maxage=date('Y')-62;
$minage=date('Y')-18;

$CityN = $_REQUEST['loan'];
$getPageSql = "select * from city_pages where City='".$CityN."' and Product='Gold' ";
list($alreadyExist,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());
$getPageQuerycontr=count($getPageQuery)-1;
$Title = $getPageQuery[$getPageQuerycontr]['Title'];
$MetaKeyword = $getPageQuery[$getPageQuerycontr]['MetaKeyword'];
$MetaDescription = $getPageQuery[$getPageQuerycontr]['MetaDescription'];
$PageDescription = $getPageQuery[$getPageQuerycontr]['PageDescription'];
$City =  ucwords(strtolower($getPageQuery[$getPageQuerycontr]['City']));
$HeaderDEscription = $getPageQuery[$getPageQuerycontr]['HeaderDEscription'];


	$retrivesource="SEO_D4L_PL_".$City;
	$newsource=$retrivesource;
	$subjectLine="Gold Loan ".$City;
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
<link href="http://www.deal4loans.com/css/gold-loan-styles.css" type="text/css" rel="stylesheet"  />

<?php //include "pl-formcity-jscalc.php"; ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="/scripts/jquery.easing-new.js"></script>
		<!-- the jScrollPane script -->
		<!--<script type="text/javascript" src="scripts/jquery.mousewheel-new.js"></script>-->
		<script type="text/javascript" src="/scripts/jquery.contentcarousel-new.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="second_wrapper_pl_new">
<div >
<div class="common-bread-crumb" style="width:100%; max-width:970px; margin-top:70px; color:#0a8bd9;"><a href="http://www.deal4loans.com/" style="color:#0080d6;">Home</a> <img src="http://www.deal4loans.com/new-images/breadcrumb_arrow.jpg" width="10" height="9" /> <span style="color:#000;"><?php echo $City?> Loans</span></div>
<h1 class="pl-h1">Gold Loan <?php echo $City?></h1>
<div style="clear:both;"></div>
<div class="body_pl_new"><?php echo $HeaderDEscription; ?></div>
<div style="clear:both;"></div>
<div class="pl_form_wrapper_main">
<?php include "gold-loan-widget-loans.php"; ?>
</div>
<div><img src="http://www.deal4loans.com/new-images/pl-new-shadow_frm_btm.jpg" width="756" height="25" style="width:100%;" /></div>
<div class="bank_listings_box">
<div class="overflow-width">
<table width="100%">
 <tr><td>
   <p><h3>GOLD Loan Interest Rates</h3></p>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td bgcolor="#eaeaea"><table border="0" cellspacing="1" cellpadding="1" width="100%">
         <tr>
           <td   valign="middle" bgcolor="#FFFFFF"><strong> Bank </strong></td>
           <td align="center"   valign="middle" bgcolor="#FFFFFF"><p><strong>Interest Rates</strong></p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>Manappuram</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>12.00% - 26.00%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>Muthoot</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>14.00% - 24.00%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>SBI</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>11.15% - 11.15%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>Pnb</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>11.00% - 12.00%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>HDFC Bank</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>10.75% - 15.70%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>Canara Bank</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>12.75% - 12.75%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>IndusInd Bank</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>13.50% - 15.50%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>Axis Bank</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>14.50% - 17.00%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>Federal Bank</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>13.00% - 13.50%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>IIFL</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>12.00% - 20.00%</p></td>
         </tr>
         <tr>
           <td   valign="bottom" bgcolor="#FFFFFF"><p><strong>Andhra Bank</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>11.40% - 11.40%</p></td>
         </tr>
         <tr>
           <td  valign="bottom" bgcolor="#FFFFFF"><p><strong>ICICI Bank</strong></p></td>
           <td align="center"   valign="bottom" bgcolor="#FFFFFF"><p>12.00% - 16.50%</p></td>
         </tr>
       </table></td>
       </tr>
   </table>
   <p><h3><b>Documents Needed for Gold Loan</b></h3>
   <p><br />
     KYC - (PAN card,  address proof, and passport size photograph). Verification of ownership of jewelry  in some cases<br />
     Gold Loan Banks  in India<br />
   </p>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td bgcolor="#eaeaea"><table border="0" cellspacing="1" cellpadding="0" width="100%">
         <tr>
           <td  valign="middle" bgcolor="#FFFFFF"> SBI Gold Loan </td>
           <td  valign="top" bgcolor="#FFFFFF"><p>ICICI Gold Loan</p></td>
           <td  valign="top" bgcolor="#FFFFFF"><p>Muthoot Gold Loan</p></td>
         </tr>
         <tr>
           <td  valign="top" bgcolor="#FFFFFF"><p>Mannapuram Gold Loan</p></td>
           <td  valign="top" bgcolor="#FFFFFF"><p>RBL Gold Loan</p></td>
           <td  valign="top" bgcolor="#FFFFFF"><p>Canara Bank Gold Loan</p></td>
         </tr>
         <tr>
           <td  valign="top" bgcolor="#FFFFFF"><p>South Indian Bank Gold Loan</p></td>
           <td  valign="top" bgcolor="#FFFFFF"><p>Indian Bank Gold Loan</p></td>
           <td  valign="top" bgcolor="#FFFFFF"><p>Federal Bank Gold Loan</p></td>
         </tr>
         <tr>
           <td  valign="top" bgcolor="#FFFFFF"><p>Central Bank Gold Loan</p></td>
           <td  valign="top" bgcolor="#FFFFFF"><p>Kotak Bank Gold Loan</p></td>
           <td  valign="top" bgcolor="#FFFFFF"><p>HDFC Gold Loan</p></td>
         </tr>
         <tr>
           <td  valign="top" bgcolor="#FFFFFF"><p>Bank of India Gold Loan</p></td>
           <td  valign="top" bgcolor="#FFFFFF"><p>Axis Bank Gold Loan</p></td>
           <td  valign="top" bgcolor="#FFFFFF"><p>Union Bank Gold Loan</p></td>
         </tr>
       </table></td>
       </tr>
   </table>
   <p><br />
   </p>   </p></td></tr></table>
</div>
<div style="clear:both; height:15px;"></div>

  
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
$getStateSql = "select * from city_pages where City='".$CityN."' and Product='Gold' ";
list($CountVal,$getSateQuery)=MainselectfuncNew($getStateSql,$array = array());
$State = $getSateQuery[0]['State'];
$getCitySql = "select * from city_pages where City!='".$CityN."' and state='".$State."' and Product='Gold' ";
list($CityCount,$getCityQuery)=MainselectfuncNew($getCitySql,$array = array());
?>
<div class="state-main-box">
<div class="head-left">Find Gold Loan Deals in Your City</div>
<div class="righthead"><a style="text-decoration:none !important;" href="http://www.deal4loans.com/loans-in/<?php echo $State;?>">Gold Loan <?php echo ucwords($State);?></a></div>
<div style="clear:both;"></div>
<div>
<ul style="list-style:none;">
<?php 
for($j=0;$j<$CityCount;$j++)
	{
$City = $getCityQuery[$j]['City'];
?>
<li class="state-box"><a href="http://www.deal4loans.com/gold-loan/<?php echo $City;?>" alt="<?php echo ucfirst($City);?> Gold Loan"><?php echo ucfirst($City); ?></a></li>
<?php 
	}

 ?>
</ul>
</div>
<div style="clear:both;"></div>
</div>

</div>

</div>


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