<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$CityN = $_REQUEST['loan'];

if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	$pageName = "twowheeler-loan/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}

$maxage=date('Y')-62;
$minage=date('Y')-18;

$CityN = $_REQUEST['loan'];
$getPageSql = "select * from city_pages where City='".$CityN."' and Product='2Wheeler' ";
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
<h1 class="pl-h1">2 Wheeler Loan <?php echo $City?></h1>
<div style="clear:both;"></div>
<div class="body_pl_new"><?php echo $HeaderDEscription; ?></div>
<div style="clear:both;"></div>
<div class="pl_form_wrapper_main">
<?php include "bike_loan.php"; ?>
</div>
<div><img src="http://www.deal4loans.com/new-images/pl-new-shadow_frm_btm.jpg" width="756" height="25" style="width:100%;" /></div>
<div class="bank_listings_box">
<div class="overflow-width">
<table width="100%">
 <tr><td>
   <p><h3><strong>2  Wheeler Loan Interest Rates</strong></h3></p>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td bgcolor="#eaeaea"><table border="0" cellspacing="1" cellpadding="0" width="100%">
         <tr>
           <td width="50%" height="35" bgcolor="#FFFFFF" ><strong>Banks Name</strong></td>
           <td width="50%" align="center" bgcolor="#FFFFFF" ><strong>Interest Rates</strong></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" > Bank of Maharashtra </td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">10.3%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of India</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">17.95%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Bank of India</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">10.7%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Central Bank of India</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">11%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Corporation Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">11%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Corporation Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">11%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Indian Overseas Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">11%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Syndicate bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">11%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Corporation Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">11.5%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Bank of India</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">11.5%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Indian Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">12.95%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Lakshmi Vilas Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">13%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Punjab National Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">13.25%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Jammu &amp; Kashmir Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">13.25%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Dena Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">13.3%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Karnataka Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">13.75%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Punjab National Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">13.75%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Jammu &amp; Kashmir Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">13.75%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Dena Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">13.8%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Bank of Baroda</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">14.25%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Punjab National Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">14.25%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Punjab National Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">14.25%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>City Union Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">14.5%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>HDFC Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">14.5%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Punjab National Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">14.75%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Saurashtra Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">15%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Union Bank of India</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">15%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Bikaner &amp; Jaipur</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">15.25%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Bikaner &amp; Jaipur</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">15.5%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Bikaner &amp; Jaipur</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">15.75%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Karur Vysya Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">15.75%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Saurashtra Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">16%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Tamilnad Mercantile Bank Limited</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">16.25%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Patiala</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">16.5%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>ICICI Bank</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">16.5%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Mysore</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">16.65%</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Travancore</p></td>
           <td align="center" bgcolor="#FFFFFF" ><p align="center">17%</p></td>
         </tr>
       </table></td>
     </tr>
   </table>
   <p><h3><strong> Two wheeler loan banks</strong></h3></p>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td bgcolor="#eaeaea"><table border="0" cellspacing="1" cellpadding="0" width="100%">
         <tr>
           <td bgcolor="#FFFFFF" > Two Wheeler Loan by Other Banks </td>
           <td bgcolor="#FFFFFF" ><p>&nbsp;</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>UCO Bank Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>Shriram City Union Finance Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Vijya Bank Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>Lakshmi Vilas Bank Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Tata Capital Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>L&amp;T Finance Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Syndicate Bank Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>SBI Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Travancore Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>South Indian Bank Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Patiala Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>Punjab National Bank Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Axis Bank Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>Punjab And Sind Bank Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>HDFC Bank Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>Oriental Bank Of Commerce Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>ICICI Bank Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>Andhra Bank Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Allahabad Bank Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>Mahindra Finance Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Mysore Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>Bajaj Finserv Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>State Bank of Bikaner Jaipur Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>City Union Bank Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Federal Bank Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>RBL Bank Two Wheeler Loan</p></td>
         </tr>
         <tr>
           <td bgcolor="#FFFFFF" ><p>Nainital Bank Two Wheeler Loan</p></td>
           <td bgcolor="#FFFFFF" ><p>Bank of India (BOI) Two Wheeler Loan</p></td>
         </tr>
       </table></td>
     </tr>
   </table>
   <p><h3><strong>Documents  required for two wheeler loans</strong></h3>
     <strong>Documents Required</strong><br />
     The following papers are to be submitted along  with loan application:</p>
   <ul style="margin-left:25px;">
     <li><strong>Statement of Bank account of the  borrower for last 12 months.</strong></li>
     <li><strong>2 passport size photographs of  borrower(s).</strong></li>
     <li><strong>Signature identification from bankers  of borrower(s).</strong></li>
   </ul></td></tr></table>
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
$getStateSql = "select * from city_pages where City='".$CityN."' and Product='2Wheeler' ";
list($CountVal,$getSateQuery)=MainselectfuncNew($getStateSql,$array = array());
$State = $getSateQuery[0]['State'];
$getCitySql = "select * from city_pages where City!='".$CityN."' and state='".$State."' and Product='2Wheeler' ";
list($CityCount,$getCityQuery)=MainselectfuncNew($getCitySql,$array = array());
?>
<div class="state-main-box">
<div class="head-left">Find Two wheeler Loan Deals in Your City</div>
<div class="righthead"><a style="text-decoration:none !important;" href="http://www.deal4loans.com/loans-in/<?php echo $State;?>">Two wheeler Loan <?php echo ucwords($State);?></a></div>
<div style="clear:both;"></div>
<div>
<ul style="list-style:none;">
<?php 
for($j=0;$j<$CityCount;$j++)
	{
$City = $getCityQuery[$j]['City'];
?>
<li class="state-box"><a href="http://www.deal4loans.com/twowheeler-loan/<?php echo $City;?>" alt="<?php echo ucfirst($City);?> Two wheeler Loan"><?php echo ucfirst($City); ?></a></li>
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