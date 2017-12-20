<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$CityN = $_REQUEST['loan'];

if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	$pageName = "education-loan/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}
$TagLine = "Get Instant Quote on Education Loan in ".ucfirst($CityN);
$maxage=date('Y')-62;
$minage=date('Y')-18;

$CityN = $_REQUEST['loan'];
$getPageSql = "select * from city_pages where City='".$CityN."' and Product='Education' ";
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
	$subjectLine="Education Loan ".$City;
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
<link href="http://www.deal4loans.com/css/education-loan-styles.css" type="text/css" rel="stylesheet"  />

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
<h1 class="pl-h1">Education Loan <?php echo $City?></h1>
<div style="clear:both;"></div>
<div class="body_pl_new"><?php echo $HeaderDEscription; ?></div>
<div style="clear:both;"></div>
<div class="pl_form_wrapper_main">
<?php include "education-loan-widget-loans.php";?>
</div>
<div><img src="http://www.deal4loans.com/new-images/pl-new-shadow_frm_btm.jpg" width="756" height="25" style="width:100%;" /></div>
<div class="bank_listings_box">
<div class="overflow-width">
<table width="100%">
 <tr><td>
<table width="100%">
 <tr>
      <td width="100%" height="30" class="h1_text" style="font-size:18px;"><h3>Current Education Loan Interest Rates in <?php echo $City?></h3></td>
    </tr>
  <tr><td bgcolor="#CCCCCC">
  <table width="100%" border="0" cellspacing="1" cellpadding="2" align="center">
<tr>
<td height="47" width="25%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style=" padding-left:5px; padding-right:5px;">Banks</td>
<td height="47" width="25%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="padding-left:5px; padding-right:5px;" nowrap="nowrap">Rate of Interest</td>
<td height="47" width="25%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="padding-left:5px; padding-right:5px;" nowrap="nowrap">MCLR Rates</td>
        <td height="47" width="25%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="padding-left:5px; padding-right:5px;" nowrap="nowrap">Processing Fee</td>
     
    </tr>
	<?php $addBgcolor = 'bgcolor="#e0f0fb"'; ?>    
    <tr>
        <td   <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin; font-size:14px;"><strong>SBI</strong></td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">10.85% - 11.15%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">9.15%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">NIL</td>
    </tr>
<?php  	$addBgcolor = 'bgcolor="#fafdff"'; ?>
    <tr>
        <td  <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin; font-size:14px;"><strong>Credila</strong></td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">12.10%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">-</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">N.A</td>
    </tr>
<?php  	$addBgcolor = 'bgcolor="#e0f0fb"'; ?>
    <tr>
        <td <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin; font-size:14px;"><strong>BOB Education Loan</strong></td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">11.15% - 11.90%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">9.40%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"> </td>
    </tr>
<?php  	$addBgcolor = 'bgcolor="#fafdff"'; ?>
    <tr>
        <td  <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin; font-size:14px;"><strong>Axis Bank Education Loan</strong></td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">15.00% - 17.50%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">9.30%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">Nil</td>
    </tr>
<?php  	$addBgcolor = 'bgcolor="#e0f0fb"'; ?>
    <tr>
        <td <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin; font-size:14px;"><strong>HDFC Education Loan</strong></td>
        <td align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">10.00% - 15.08%</td>
        <td align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">-</td>
        <td align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">1% of loan amount </td>
    </tr>
    <?php $addBgcolor = 'bgcolor="#fafdff"'; ?>
    <tr>
        <td <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin; font-size:14px;"><strong>BOI Education Loan</strong></td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">11.10% -12.40%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">9.40%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">N.A.</td>
    </tr>
<?php  	$addBgcolor = 'bgcolor="#e0f0fb"'; ?>
    <tr>
        <td <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin; font-size:14px;"><strong>PNB Education Loan</strong></td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">11.50% - 12.50%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">9.40%</td>
        <td  align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;">Nil</td>
    </tr>    
</table>

</td></tr></table>
</td></tr>
 <tr>
   <td bgcolor="#FFFFFF">&nbsp;</td>
 </tr>
 <tr>
   <td bgcolor="#FFFFFF"><h3>Education Loan Banks</h3></td>
 </tr>
 <tr>
  <td bgcolor="#eaeaea">
  <table border="0" cellspacing="1" cellpadding="2" width="100%">
    
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Avanse Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Allahabad Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Andhra Bank Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Axis Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Bank of Baroda Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Bank of India Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Canara Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>City Union Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Corporation Bank Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Dena Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Dhanalakshmi Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Federal Bank Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>HDFC Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Indian Overseas Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>IDBI Bank Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Indian Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Jammu and Kashmir Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Karnataka Bank Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Karur Vysya Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Lakshmi Vilas Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Oriental Bank of Commerce Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Punjab National Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Punjab and Sind Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>State Bank OF Travancore Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Saraswat Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>SBI Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>South Indian Bank Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>State Bank of Bikaner and Jaipur Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>SBH Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>SBM Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>State Bank of Patiala Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Syndicate Bank Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>TJSB Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>TMB Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>United Bank of India Education Loan</p></td>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>UCO Bank Education Loan</p></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Union Bank of India Education Loan</p></td>
        <td colspan="2" valign="bottom" bgcolor="#FFFFFF" style="border-right:#fbf9f6 solid thin; font-size:14px; padding-left:2px;"><p>Vijaya Bank Education Loan</p></td>
      </tr>
    </table>
      </td></tr>
 <tr>
   <td><h3>Documents required for Education Loan</h3></td>
 </tr>
 <tr><td bgcolor="#eaeaea">
<table border="0" cellspacing="1" cellpadding="1" width="100%">
  <tr>
    <td width="36%" height="30" valign="middle" bgcolor="#FFFFFF"><strong>Purpose</strong><strong> </strong></td>
    <td width="31%" align="center" valign="middle" bgcolor="#FFFFFF"><strong>Salaried</strong></td>
    <td width="33%" align="center" valign="middle" bgcolor="#FFFFFF"><strong>Others</strong></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><p>Proof of identity</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Passport or Voter's ID card or driving license or PAN card or government department ID card</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Passport or Voter's ID card or driving license or PAN card</p></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><p>Proof of income</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Latest salary slip    showing all deductions or Form 16 along with recent salary certificate</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>IT returns for the    last 2 years and computation of income for the last 2 years certified by a CA</p></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><p>Proof of residence</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Bank account  statement or latest electricity bill or latest mobile or telephone bill or    latest credit card statement or existing house lease agreement</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Bank account    statement or latest electricity bill or latest mobile or telephone bill or    latest credit card statement or existing house lease agreement</p></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><p>Bank statement or    Pass Book where salary or income is credited</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Last 6 months</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Last 6 months</p></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><p>Guarantor form</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Optional</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Optional</p></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><p>Other Documents</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Copy of admission    letter of the Institute along with Fees schedule, mark sheets / pass certificates    of S.S.C, H.S.C , Degree courses</p></td>
    <td valign="top" bgcolor="#FFFFFF"><p>Copy of admission    letter of the Institute along with Fees schedule, mark sheets / pass    certificates of S.S.C, H.S.C , Degree courses</p></td>
  </tr>
</table>

</td></tr></table>
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
$getStateSql = "select * from city_pages where City='".$CityN."' and Product='Education' ";
list($CountVal,$getSateQuery)=MainselectfuncNew($getStateSql,$array = array());
$State = $getSateQuery[0]['State'];
$getCitySql = "select * from city_pages where City!='".$CityN."' and state='".$State."' and Product='Education' ";
list($CityCount,$getCityQuery)=MainselectfuncNew($getCitySql,$array = array());
?>
<div class="state-main-box">
<div class="head-left">Find Education Loan Deals in Your City</div>
<div class="righthead"><a style="text-decoration:none !important;" href="http://www.deal4loans.com/loans-in/<?php echo $State;?>">Education Loan <?php echo ucwords($State);?></a></div>
<div style="clear:both;"></div>
<div>
<ul style="list-style:none;">
<?php 
for($j=0;$j<$CityCount;$j++)
	{
$City = $getCityQuery[$j]['City'];
?>
<li class="state-box"><a href="http://www.deal4loans.com/education-loan/<?php echo $City;?>" alt="<?php echo ucfirst($City);?> Education Loan"><?php echo ucfirst($City); ?></a></li>
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