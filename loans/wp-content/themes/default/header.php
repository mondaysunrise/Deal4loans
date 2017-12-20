<?php
ob_start();
if((strlen(strpos($_SERVER['SERVER_SIGNATURE'], "www.deal4loans.com")) > 0))
{
}
else
{
	header("Location: 404.html");
	exit();
}
if($_SERVER['HTTPS']=="on")
{
 $redirect= "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 header("Location:$redirect");
}
error_reporting(0);
require '../scripts/functions.php';
$responsiveTheme = '';	
if((strlen(strpos($_SERVER['REQUEST_URI'], "/loans/credit-card/hdfc-credit-card-eligibility-apply/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/banks/sbi-credit-cards/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/credit-card/icici-bank-credit-cards-eligibility-documents-apply/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/calculators/sbi-home-loan-emi-calculator-eligibility-calculator/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/education-loan/sbi-education-loan-interest-rates-documents-sbi-schemes/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/personal-loan/hdfc-personal-loan-bhopal-interest-rates-apply-online/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/loan/gold-loan-loan/sbi-gold-loan-interest-rates-onlinme-apply-eligibility/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/loan/hdfc-bank-business-loan-interest-rates-documents-apply/")) > 0))
{
	$responsiveTheme = "active";
}	
else
{
	$responsiveTheme = "active";
//	$responsiveTheme = "active";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="http://www.deal4loans.com/css/wp.css" rel="stylesheet" type="text/css" />

<?php
if((strlen(strpos($_SERVER['REQUEST_URI'], "/loans/tag_removed290616")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/category"))))
{
?>
<META NAME="ROBOTS" CONTENT="NOINDEX, FOLLOW">
<?php
}
?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<!--<script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>-->
<!--<link href="http://www.deal4loans.com/source.css" rel="stylesheet" type="text/css" />-->
<style type="text/css" media="screen">

<?php
// Checks to see whether it needs a sidebar or not
/*if ( empty($withcomments) && !is_single() ) {
?>
	#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/kubrickbg-<?php bloginfo('text_direction'); ?>.jpg") repeat-y top; border: none; }
<?php } else { // No sidebar ?>
	#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/kubrickbgwide.jpg") repeat-y top; border: none; }
<?php }*/ 
?>

</style>

<?php // if( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#373737;
}
.red {
	color: #F00;
}
-->

.calculator_box{ float:left; width:490px; margin-top:5px;}
.calculator_box{ float:left; width:400px; margin-top:5px;}

/*..................................


/*...................................new styles added for wordpree menu on 23-9-2014 Satarts ...........*/
.wp-logod4l{float:left; clear:right; width:180px; height:66px; margin-top:13px;}
.wp-right-menud4l{float:right; clear:right; width:720px; margin-right:-40px; background-image:url(http://www.deal4loans.com/images/nav_bg.gif );}
.wp-menuwidths{margin:auto; width:970px; height:95px; margin-top:25px;}
.wp-space-height{height:100px; display:none;}

.wp-menu1{text-align:center; width:116px;}
.wp-menu2{text-align:center; width:95px;}
.wp-menu3{text-align:center; width:85px;}
.wp-menu4{text-align:center; width:105px; }
.wp-menu5{text-align:center; width:164px;}
.wp-menu6{text-align:center; width:117px;}
.wp-menu_ul{margin-left:-139px;}
.wp-responsive-icon{ display:none; }
#home-minus-margin{margin-left:-5px;}

.hide-main-menu{ display:none;}

/*...................................new styles added for wordpree menu on 23-9-2014 Satarts ...........*/
  
@media screen and (max-width:768px) {
/*
.wp-responsive-icon{ display:block; background:#88a943; width:100%; padding:5px 0px 5px 5px; }
*/
.hide-main-menu{ display:inherit;}
.hide-top{ display:none; }
.wp-responsive-menu{ background-color:#88a943; color:#ffffff; margin-top:-20px !important;}
.wp-space-height{height:160px; display:inherit;}
.wp-menuwidths{margin:auto; width:100%; margin-top:25px;}
.calculator_box{width:100%; margin-top:5px;}
.calculator_box{width:100%; margin-top:5px;}
.wp-right-menud4l{float:none!important; clear:right; width:100%; margin-right:-40px; background:none!important;}
ul.menu{list-style:none;margin:0;padding:0px;}
ul.menu *{margin:0;padding:0px;}
ul.menu a{display:block;color:#000;text-decoration:none; color:#FFFFFF!important;}
ul.menu li{position:relative;float:none!important;margin-right:2px; }
ul.menu ul{position:absolute;top:30px;left:0;background:#d1d1d1;display:none;opacity:0;list-style:none}
ul.menu ul li{position:relative;border:1px solid #aaa;border-top:none;width:248px;margin:0}
ul.menu ul li a{display:block;background-color:#88a943!important;padding:3px 7px 5px; color:#FFFFFF!important;}
ul.menu ul ul{left:198px; top:-1px;}
ul.menu .menulink{border:1px solid #aaa;font-weight:700; background-color:#c5c5c5;width:234px;padding:5px 7px 7px}
ul.menu .sub{background-color:#fff;width:266px;height:8px;}
ul.menu .topline{border-top:1px solid #aaa;background-color:#fff;}

.wp-menu1{text-align:left!important; width:100%;}
.wp-menu2{text-align:left!important; width:100%;}
.wp-menu3{text-align:left!important; width:100%;}
.wp-menu4{text-align:left!important; width:100%; }
.wp-menu5{text-align:left!important; width:100%;}
.wp-menu6{text-align:left!important; width:100%;}
.wp-menu_ul{margin-left:0px;}
a.btn:link,a.btn:visited{font-family:'Droid Sans', sans-serif;font-size:14px;font-variant:normal;color:#588f27;text-decoration:none;importurlhttp://fonts.googleapis.com/css?family=Droid+Sans);padding:5px 5px !important;}

#home-minus-margin{margin-left:0px;}

}
  
</style>
<!--<script src="//code.jquery.com/jquery-1.8.2.js"></script>-->

<script type="text/javascript">
/*
function show_menu(){
	$(document).ready(function() {		
		$("#wp-responsive-menu").toggle( 2000, function() {
			
			$(".wp-space-height").height("200px");
			// Animation complete.
		});
	});	
}
*/
</script>

<!-- Code for Polling starts -->
<link href="http://www.deal4loans.com/css/bank-polling-styles.css" type="text/css" rel="stylesheet" />
<link href="http://www.deal4loans.com/css/bank-polling-verticle-styles.css" type="text/css" rel="stylesheet"  />
<style type="text/css">
.label
{
	font-family: Verdana;
	font-size: medium;
	font-weight: bold;
	color: #000000;
}
.click
{
	font-family: Verdana;
	font-size: medium;
	font-weight: bold;
	color: #000000;
	padding:300px;
}
.Title
{
	font-family: Verdana;
	font-size: large;
	font-weight: bold;
	color: #FF9900;
}
#Button1
{
	width: 64px;
	 font-family: Verdana;
	font-size: medium;
	font-weight: bold;
	background-color:Teal;
	color:#FFF;
}
.black_overlay{
	display:none;
	position:absolute;
	top: 0%;
	left: 0%;
	width:100%;
	height: 410%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}
.white_content {
	display: none;
	position: absolute;
	top: 310% !important;
	left: 25%;
	width: 30%;
	height: 40%;
	padding: 16px;
	box-shadow:inset 0 0 4px 4px #999;
	background-color: white;
	z-index:1002;
	overflow: auto;
	border-radius:10px;
	margin-left:8%;
}
</style>
<script type="text/javascript" language="javascript">

function checkFormPollOne(){
	
	//alert('Hi');
	if(document.frmPollForLoan.employment_status.value==''){
		
		alert("Please select your employment status!");
		document.frmPollForLoan.employment_status.focus();
		return false;
	}
	if(document.frmPollForLoan.annual_income.value==''){
		
		alert("Please select your annual income.");
		document.frmPollForLoan.annual_income.focus();
		return false;
	}
	if(document.frmPollForLoan.loan_type.value==''){
		
		alert("Please select loan type.");
		document.frmPollForLoan.loan_type.focus();
		return false;
	}
	if(document.frmPollForLoan.loan_amount.value==''){
		
		alert("Please select loan amount.");
		document.frmPollForLoan.loan_amount.focus();
		return false;
	}
	if((document.getElementById("city-bank").checked==false && document.getElementById("hdb-financial").checked==false && document.getElementById("hdfc-bank").checked==false && document.getElementById("ing-vysya").checked==false) && (document.getElementById("other-bank").value=='Other Bank' || document.getElementById("other-bank").value=='')){
		
		alert('Please select at least one bank or mention other bank preferrence.');
		document.getElementById("city-bank").focus();
		return false;
	}
	createlightbox();
	return false;
}

function checkFormPoll(){
	
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var i;
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if(document.frmPollForLoan.employment_status.value==''){
		
		alert("Please select your employment status!");
		document.frmPollForLoan.employment_status.focus();
		return false;
	}
	if(document.frmPollForLoan.annual_income.value==''){
		
		alert("Please select your annual income.");
		document.frmPollForLoan.annual_income.focus();
		return false;
	}
	if(document.frmPollForLoan.loan_type.value==''){
		
		alert("Please select loan type.");
		document.frmPollForLoan.loan_type.focus();
		return false;
	}
	if(document.frmPollForLoan.loan_amount.value==''){
		
		alert("Please select loan amount.");
		document.frmPollForLoan.loan_amount.focus();
		return false;
	}
	if((document.getElementById("city-bank").checked==false && document.getElementById("hdb-financial").checked==false && document.getElementById("hdfc-bank").checked==false && document.getElementById("ing-vysya").checked==false) && (document.getElementById("other-bank").value=='Other Bank' || document.getElementById("other-bank").value=='')){
		
		alert('Please select at least one bank or mention other bank preferrence.');
		document.getElementById("city-bank").focus();
		return false;
	}
	
	createlightbox();
	//alert("Hi");
	if((document.frmPollForLoan.full_name.value=="") || (Trim(document.frmPollForLoan.full_name.value))==false)
	{
		alert("Please enter your full name.");
		document.frmPollForLoan.full_name.focus();
		return false;
	}
	if (document.frmPollForLoan.mobile.value=="")
	{
		alert("Please enter your mobile number.");
		document.frmPollForLoan.mobile.focus();
		return false;
	}
	if(isNaN(document.frmPollForLoan.mobile.value) || document.frmPollForLoan.mobile.value.indexOf(" ")!=-1)
	{
		alert("Please enter only numeric value for mobile number.");
		document.frmPollForLoan.mobile.focus();
		return false;  
	}
	if (document.frmPollForLoan.mobile.value.length < 10 )
	{
		alert("Please enter 10 digits number only");
		document.frmPollForLoan.mobile.focus();
		return false;
	}
	if ((document.frmPollForLoan.mobile.value.charAt(0)!="9") && (document.frmPollForLoan.mobile.value.charAt(0)!="8") && (document.frmPollForLoan.mobile.value.charAt(0)!="7"))
	{
		alert("Mobile number should start with 9 or 8 or 7!");
		document.frmPollForLoan.mobile.focus();
		return false;
	}
	if(document.frmPollForLoan.email.value=="")
	{
		alert("Please enter e-mail address.");	
		document.frmPollForLoan.email.focus();
		return false;
	}
		
	var str=document.frmPollForLoan.email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		alert("Please enter valid E-mail Address.");
		document.frmPollForLoan.email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Enter valid E-mail Address.");
		document.frmPollForLoan.email.focus();
		return false;
	}
	if (document.frmPollForLoan.city.selectedIndex=="")
	{
		alert("Please enter your city.");
		document.frmPollForLoan.city.focus();
		return false;
	}
	return true;
}

<!-- Script for Lightbox form -->
function createlightbox()
{
	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block'
}
function closelightbox()
{
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none'
}
<!--//-->

</script>
<!-- Code for Polling ends -->
<?php
include("../scripts/db_init.php");

$srchQry = " ";
if(isset($_SESSION['city'])){
	$srchQry = " (`city` like '%".$_SESSION['city']."%') and  ";
}
/************ Loan Amount :: Data Starts **********/
$empChartSql = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." loan_amount=1 group by employment_status order by employment_status ASC";
$empChartSql = ExecQuery($empChartSql);

while($empChartRes=mysql_fetch_array($empChartSql))
{
	$counr[] = $empChartRes["empstat"];
}
$salariedcount=$counr["1"];
$selfemployedcount=$counr[0];
$total = $salariedcount + $selfemployedcount;

if($total!=0){
	$percentagesal=round(($salariedcount/$total) * 100);
	$percentageselfemp=round(($selfemployedcount/$total) * 100);
}else{
	$percentagesal=0;
	$percentageselfemp=0;
}

$empChartSql2 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." loan_amount=2 group by employment_status order by employment_status ASC";
$empChartSql2 = ExecQuery($empChartSql2);

while($empChartRes2=mysql_fetch_array($empChartSql2))
{
	$counr2[] = $empChartRes2["empstat"];
}
$salariedcount2=$counr2["1"];
$selfemployedcount2=$counr2[0];
$total2 = $salariedcount2 + $selfemployedcount2;

if($total2!=0){
	$percentagesal2=round(($salariedcount2/$total2) * 100);
	$percentageselfemp2=round(($selfemployedcount2/$total2) * 100);
}else{
	$percentagesal2=0;
	$percentageselfemp2=0;
}

$empChartSql3 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." loan_amount=3 group by employment_status order by employment_status ASC";
$empChartSql3 = ExecQuery($empChartSql3);

while($empChartRes3=mysql_fetch_array($empChartSql3))
{
	$counr3[] = $empChartRes3["empstat"];
}
$salariedcount3=$counr3["1"];
$selfemployedcount3=$counr3[0];
$total3 = $salariedcount3 + $selfemployedcount3;

if($total3!=0){
	$percentagesal3 = round(($salariedcount3/$total3) * 100);
	$percentageselfemp3 = round(($selfemployedcount3/$total3) * 100);
}else{
	$percentagesal3 = 0;
	$percentageselfemp3 = 0;
}

$empChartSql4 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." loan_amount=4 group by employment_status order by employment_status ASC";
$empChartSql4 = ExecQuery($empChartSql4);

while($empChartRes4=mysql_fetch_array($empChartSql4))
{
	$counr4[] = $empChartRes4["empstat"];
}
$salariedcount4=$counr4["1"];
$selfemployedcount4=$counr4[0];
$total4 = $salariedcount4 + $selfemployedcount4;

if($total4!=0){
	$percentagesal4=round(($salariedcount4/$total4) * 100);
	$percentageselfemp4=round(($selfemployedcount4/$total4) * 100);
}else{
	$percentagesal4=0;
	$percentageselfemp4=0;
}
/*********** Loan Amount :: Data ends ***********/

/*********** Annual Income :: Data starts **********/
$empAiChartSql = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." annual_income=1 group by employment_status order by employment_status ASC";
$empAiChartSql = ExecQuery($empAiChartSql);

while($empAiChartRes=mysql_fetch_array($empAiChartSql))
{
	$counrAi[] = $empAiChartRes["empstat"];
}
$salariedcountAi=$counrAi["1"];
$selfemployedcountAi=$counrAi[0];
$totalAi = $salariedcountAi + $selfemployedcountAi;

if($totalAi!=0){
	$percentagesalAi=round(($salariedcountAi/$totalAi) * 100);
	$percentageselfempAi=round(($selfemployedcountAi/$totalAi) * 100);
}else{
	$percentagesalAi=0;
	$percentageselfempAi=0;
}

$empAiChartSql2 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." annual_income=2 group by employment_status order by employment_status ASC";
$empAiChartSql2 = ExecQuery($empAiChartSql2);

while($empAiChartRes2=mysql_fetch_array($empAiChartSql2))
{
	$counrAi2[] = $empChartResAi2["empstat"];
}
$salariedcountAi2=$counrAi2["1"];
$selfemployedcountAi2=$counrAi2[0];
$totalAi2 = $salariedcountAi2 + $selfemployedcountAi2;

if($totalAi2!=0){
	$percentagesalAi2=round(($salariedcountAi2/$totalAi2) * 100);
	$percentageselfempAi2=round(($selfemployedcountAi2/$totalAi2) * 100);
}else{
	$percentagesalAi2=0;
	$percentageselfempAi2=0;
}

$empAiChartSql3 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." annual_income=3 group by employment_status order by employment_status ASC";
$empAiChartSql3 = ExecQuery($empAiChartSql3);

while($empAiChartRes3=mysql_fetch_array($empAiChartSql3))
{
	$counrAi3[] = $empAiChartRes3["empstat"];
}
$salariedcountAi3=$counrAi3["1"];
$selfemployedcountAi3=$counrAi3[0];
$totalAi3 = $salariedcountAi3 + $selfemployedcountAi3;

if($totalAi3!=0){
	$percentagesalAi3 = round(($salariedcountAi3/$totalAi3) * 100);
	$percentageselfempAi3 = round(($selfemployedcountAi3/$totalAi3) * 100);
}else{
	$percentagesalAi3 = 0;
	$percentageselfempAi3 = 0;
}

$empAiChartSql4 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." annual_income=4 group by employment_status order by employment_status ASC";
$empAiChartSql4 = ExecQuery($empAiChartSql4);

while($empAiChartRes4=mysql_fetch_array($empAiChartSql4))
{
	$counrAi4[] = $empAiChartRes4["empstat"];
}
$salariedcountAi4=$counrAi4["1"];
$selfemployedcountAi4=$counrAi4[0];
$totalAi4 = $salariedcountAi4 + $selfemployedcountAi4;

if($totalAi4!=0){
	$percentagesalAi4=round(($salariedcountAi4/$totalAi4) * 100);
	$percentageselfempAi4=round(($selfemployedcountAi4/$totalAi4) * 100);
}else{
	$percentagesalAi4=0;
	$percentageselfempAi4=0;
}
/*********** Annual Income :: Data ends **********/

/*********** Bank Wise :: Data starts ************/
$bankChartSql = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." (preferred_banks like '%Citibank%') group by employment_status order by employment_status ASC";
$bankChartQry = ExecQuery($bankChartSql);

while($bankChartRes=mysql_fetch_array($bankChartQry))
{
	$countBnk[] = $bankChartRes["empstat"];
}
$salariedCountBnk=$countBnk["1"];
$selfEmployedCountBnk=$countBnk[0];
$totalBnk = $salariedCountBnk + $selfEmployedCountBnk;

if($totalBnk!=0){
	$percentageSalBnk=round(($salariedCountBnk/$totalBnk) * 100);
	$percentageSelfEmpBnk=round(($selfEmployedCountBnk/$totalBnk) * 100);
}else{
	$percentageSalBnk=0;
	$percentageSelfEmpBnk=0;
}

$bankChartSql2 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." (preferred_banks like '%HDBFS%') group by employment_status order by employment_status ASC";
$bankChartQry2 = ExecQuery($bankChartSql2);

while($bankChartRes2=mysql_fetch_array($bankChartQry2))
{
	$countBnk2[] = $bankChartRes2["empstat"];
}
$salariedCountBnk2=$countBnk2["1"];
$selfEmployedCountBnk2=$countBnk2[0];
$totalBnk2 = $salariedCountBnk2 + $selfEmployedCountBnk2;

if($totalBnk2!=0){
	$percentageSalBnk2=round(($salariedCountBnk2/$totalBnk2) * 100);
	$percentageSelfEmpBnk2=round(($selfEmployedCountBnk2/$totalBnk2) * 100);
}else{
	$percentageSalBnk2=0;
	$percentageSelfEmpBnk2=0;
}

$bankChartSql3 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." (preferred_banks like '%HDFC%') group by employment_status order by employment_status ASC";
$bankChartQry3 = ExecQuery($bankChartSql3);

while($bankChartRes3=mysql_fetch_array($bankChartQry3))
{
	$countBnk3[] = $bankChartRes3["empstat"];
}
$salariedCountBnk3=$countBnk3["1"];
$selfEmployedCountBnk3=$countBnk3[0];
$totalBnk3 = $salariedCountBnk3 + $selfEmployedCountBnk3;

if($totalBnk3!=0){
	$percentageSalBnk3=round(($salariedCountBnk3/$totalBnk3) * 100);
	$percentageSelfEmpBnk3=round(($selfEmployedCountBnk3/$totalBnk3) * 100);
}else{
	$percentageSalBnk3=0;
	$percentageSelfEmpBnk3=0;
}

$bankChartSql4 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." (preferred_banks like '%IngVysya%') group by employment_status order by employment_status ASC";
$bankChartQry4 = ExecQuery($bankChartSql4);

while($bankChartRes4=mysql_fetch_array($bankChartQry4))
{
	$countBnk4[] = $bankChartRes4["empstat"];
}
$salariedCountBnk4=$countBnk4["1"];
$selfEmployedCountBnk4=$countBnk4[0];
$totalBnk4 = $salariedCountBnk4 + $selfEmployedCountBnk4;

if($totalBnk4!=0){
	$percentageSalBnk4=round(($salariedCountBnk4/$totalBnk4) * 100);
	$percentageSelfEmpBnk4=round(($selfEmployedCountBnk4/$totalBnk4) * 100);
}else{
	$percentageSalBnk4=0;
	$percentageSelfEmpBnk4=0;
}

$bankChartSql5 = "select employment_status,count(employment_status) as empstat from poll_for_loan where ".$srchQry." (preferred_banks like '%Other Bank%') group by employment_status order by employment_status ASC";
$bankChartQry5 = ExecQuery($bankChartSql5);

while($bankChartRes5=mysql_fetch_array($bankChartQry5))
{
	$countBnk5[] = $bankChartRes5["empstat"];
}
$salariedCountBnk5=$countBnk5["1"];
$selfEmployedCountBnk5=$countBnk5[0];
$totalBnk5 = $salariedCountBnk5 + $selfEmployedCountBnk5;

if($totalBnk5!=0){
	$percentageSalBnk5=round(($salariedCountBnk5/$totalBnk5) * 100);
	$percentageSelfEmpBnk5=round(($selfEmployedCountBnk5/$totalBnk5) * 100);
}else{
	$percentageSalBnk5=0;
	$percentageSelfEmpBnk5=0;
}

/*********** Bank Wise :: Data ends ************/

?>
<!-- Poll for Loan :: Code to show Google Charts starts here -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {

  var data = google.visualization.arrayToDataTable([
    ['Loan Amount Range', 'Self Employed', 'Salaried'],
    ['(1-3) lacs',  <?php echo $percentageselfemp; ?>,      <?php echo $percentagesal; ?>],
    ['(3-5) lacs',  <?php echo $percentageselfemp2; ?>,      <?php echo $percentagesal2; ?>],
    ['(5-7) lacs',  <?php echo $percentageselfemp3; ?>,       <?php echo $percentagesal3; ?>],
    ['7 lacs & above',  <?php echo $percentageselfemp4; ?>,      <?php echo $percentagesal4; ?>]
  ]);

  var options = {
    title: 'Loan Amount',
    hAxis: {title: 'Loan Amount Range', titleTextStyle: {color: 'red'}},
	vAxis: {minValue: 0, maxValue: 10, format: '#\'%\''}
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}

google.setOnLoadCallback(drawChart2);
function drawChart2() {

  var data = google.visualization.arrayToDataTable([
    ['Annual Income Range', 'Self Employed', 'Salaried'],
    ['(1-3) lacs',  <?php echo $percentageselfempAi; ?>,      <?php echo $percentagesalAi; ?>],
    ['(3-5) lacs',  <?php echo $percentageselfempAi2; ?>,      <?php echo $percentagesalAi2; ?>],
    ['(5-7) lacs',  <?php echo $percentageselfempAi3; ?>,       <?php echo $percentagesalAi3; ?>],
    ['7 lacs & above',  <?php echo $percentageselfempAi4; ?>,      <?php echo $percentagesalAi4; ?>]
  ]);

  var options = {
    title: 'Annual Income',
    hAxis: {title: 'Annual Income Range', titleTextStyle: {color: 'red'}},
	vAxis: {minValue: 0, maxValue: 10, format: '#\'%\''}
  };

  var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
  chart2.draw(data, options);
}

google.setOnLoadCallback(drawChart3);
function drawChart3() {

  var data = google.visualization.arrayToDataTable([
    ['Preferred Banks', 'Self Employed', 'Salaried'],
    ['Citibank',  <?php echo $percentageSelfEmpBnk; ?>,      <?php echo $percentageSalBnk; ?>],
    ['HDBFS',  <?php echo $percentageSelfEmpBnk2; ?>,      <?php echo $percentageSalBnk2; ?>],
    ['HDFC',  <?php echo $percentageSelfEmpBnk3; ?>,       <?php echo $percentageSalBnk3; ?>],
	['IngVysya',  <?php echo $percentageSelfEmpBnk4; ?>,       <?php echo $percentageSalBnk4; ?>],
    ['Other Banks',  <?php echo $percentageSelfEmpBnk5; ?>,      <?php echo $percentageSalBnk5; ?>]
  ]);

  var options = {
    title: 'Preferred Banks',
    hAxis: {title: 'Preferred Banks', titleTextStyle: {color: 'red'}},
	vAxis: {minValue: 0, maxValue: 10, format: '#\'%\''}
  };

  var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
  chart3.draw(data, options);
}
</script>
<!-- Poll for Loan :: Code to show Google Charts ends here -->

</head>
<body <?php body_class(); ?> >
<?php
session_start();
include("../middle-menu.php");

?>
<div class="intrl_txt" style="margin-top:70px;">