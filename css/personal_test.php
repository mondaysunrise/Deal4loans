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
<link href="css/personal-loan-citywise-styles.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/style-popup.css" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/inner-styles-onclick.css" />
		
		<link rel="stylesheet" type="text/css" href="css/jquery-jscrollpane.css" media="all"/>
<script type="text/javascript" src="http://www.deal4loans.com/scripts/mainmenu.js"></script>


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
}
.red {
	color: #F00;
}
-->
</style>
<style>
.tblwt_txt {
    color: #1c50b0;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 13px;
    font-weight: bold;
    padding: 2px;
}
.tbl_txt {
    color: #373737;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 11px;
    padding: 2px;
}
#txt a {
    color: #1C50B0;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 11px;
    line-height: 15px;
    text-decoration: none;
}
#txt  a {
      text-decoration: none;
  }
#txt   a:link {
     color: #666666;
  }
#txt   a:visited {
      color: #666666;
  }
#txt   a:active {
      color: #666666;
  }
#txt   a:hover {
      color: #FF9900;
  }
</style>
<?php include "pl-form-jscalc.php"; ?>

<style>h3{	font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	text-decoration:none;	color:#1c50b0;	padding:0px;	margin:0px 0px 0px 0px;	text-align:left;}.faqContainer{	padding:10px;}.faqContainer .toggler {	padding:5px 0px 0px 15px;font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:13px;	line-height:17px;	font-weight:bold;	text-align:justify;	background:transparent url(/images/bullet12.gif) no-repeat scroll 0px 10px;	cursor:pointer;}.elementInside{	border-bottom:1px solid #CCCCCC;	margin:4px 0px 4px 0px;	padding:4px 0px 5px 0px; 	font-family: Verdana, Geneva, sans-serif;	font-size: 11px;	font-weight: normal;	font-variant: normal;	color: #4c4c4c;	text-decoration: none;}.element_atStart_dv{margin:4px 0px 4px 0px; border-bottom:1px solid #CCCCCC; height:auto; font-family: Verdana, Geneva, sans-serif;	font-size: 11px;	font-weight: normal;	font-variant: normal;	color: #4c4c4c;	text-decoration: none; }</style>
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
		<script type="text/javascript" src="scripts/jquery.easing-new.js"></script>
		<!-- the jScrollPane script -->
		<!--<script type="text/javascript" src="scripts/jquery.mousewheel-new.js"></script>-->
		<script type="text/javascript" src="scripts/jquery.contentcarousel-new.js"></script>
		


</head>
<body>
<!--top-->
<div class="tp_hid_cont">

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation--></div>
<div class="second_wrapper_pl_new">
<div class="logo_plnew"><img src="images/logo.gif" width="243" height="90" /></div>
<div class="left-container">
<div class="breadcrumb_text"><a href="http://www.deal4loans.com/">Home</a> <img src="new-images/breadcrumb_arrow.jpg" width="10" height="9" /> <a href="http://www.deal4loans.com/personal-loans.php">Personal Loan</a> <img src="new-images/breadcrumb_arrow.jpg" width="10" height="9" /> <span style="color:#000;">Hyderabad Loans</span></div>
<h1 class="h1_text">Personal Loan Hyderabad <?php echo $City?></h1>
<div style="clear:both;"></div>
<div class="pl_form_wrapper_main">
<div class="pl_form_wrapper">
<div class="body_inner_tptxt">Get instant lowest quote on Personal loan in Hyderabad from top 10 Banks</div>
<div class="body_inner2">Professional Details</div>
<div class="pl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Loan Amount:</td>
    </tr>
    <tr>
      <td>
        <input type="text" class="iput_box_new" name="textfield" id="textfield" />
     </td>
    </tr>
  </table>
</div>
<div class="pl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Occupation:</td>
    </tr>
    <tr>
      <td>
        <select name="select" id="select" class="select_box_new">
        <option>Please Select</option>
         <option>Salaried</option>
         <option>Self Employed</option>
        </select>
     </td>
    </tr>
  </table>
</div>
<div class="pl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Annual Income:</td>
    </tr>
    <tr>
      <td><input type="text" class="iput_box_new" name="textfield2" id="textfield2" /></td>
    </tr>
  </table>
</div>
<div class="pl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">City:</td>
    </tr>
    <tr>
      <td><select name="select2" id="select2" class="select_box_new">
        <option>City</option>
      </select></td>
    </tr>
  </table>
</div>

<div class="button_box_new">
  <img src="new-images/get-quote-btn_new-pl.png" width="119" height="31" />
</div>
<div style="clear:both;"></div>
</div>
</div>
<div><img src="new-images/pl-new-shadow_frm_btm.jpg" width="756" height="25" style="width:100%;" /></div>
<div class="bank_listings_box">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" class="h1_text" style="font-size:18px;">Current Personal Loan Interest Rates in Hyderabad</td>
    </tr>
    <tr>
      <td>
      <div class="database_boxes"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" >
        <tr>
          <td height="30" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:14px;"><strong>Banks</strong></strong></td>
        </tr>
        <tr>
          <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Rate of Interest </strong></td>
        </tr>
        <tr>
          <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Processing Fee </strong></td>
        </tr>
        <tr>
          <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Loan Amount </strong></td>
        </tr>
        <tr>
          <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Prepayment Charges </strong></td>
        </tr>
        <tr>
          <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Disbursal Time </strong></td>
        </tr>
      </table></div>
      <div class="database_boxes"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  >
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:14px;"><? echo $myrow["pl_bank_name"];?></strong></td></tr>
  <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size:12px; "><? echo $myrow["pl_bank_roi"];?>
        </td></tr>
  <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size:12px;"><? echo $myrow["pl_bank_processing_fee"];?></td></tr>
          <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size:12px;"><? echo $myrow["pl_bank_loan_amt"];?>
</td></tr>
          <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size:12px;"><? echo $myrow["pl_bank_prepayment"];?>
       </td></tr>
          <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size:12px;"><? echo $myrow["pl_bank_disbursal_time"];?></td></tr>
            </table></div>
      </td>
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
    <td align="left" class="eglibily_head" height="35">Eligibility Criteria</td>
  </tr>
  <tr>
    <td align="left" class="body_pl_new"><em>Eligibility Criteria for Personal Loan in Hyderabad</em></td>
  </tr>
  <tr>
    <td align="left" height="10"></td>
  <tr>
    <td align="left" class="body_pl_new">Banks offer Loan to borrowers depending on various factors such <br />as income, employment, continuity of business so as to make sure that they repay the loan with interest before the due date. </td>
  </tr>
  <tr>
    <td align="right"><a href="#" class="ca-more"><img src="new-images/more-pl_box.jpg" width="78" height="21" border="0" /></a></td>
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
    <td align="left" class="eglibily_head">List of Personal Loans Banks</td>
  </tr>
  <tr>
    <td align="left" class="sbi_text_pl_new" height="24">State Bank of India (SBI)</td>
  </tr>
  <tr>
    <td align="left" class="stnrd_text_pl_new" height="24">Standard Chartered</td>
  </tr>
  <tr>
    <td align="left" class="bob_text_pl_new" height="24">Bank of Baroda</td>
  </tr>
  <tr>
    <td align="left" class="yes_text_pl_new" height="24">Yes Bank</td>
  </tr>
  <tr>
    <td align="left" class="sbi_text_pl_new" height="24">Canara Bank</td>
  </tr>
  <tr>
  
    <td align="right">
								<a href="#" class="ca-more"><img src="new-images/more-pl_box.jpg" width="78" height="21" border="0" /></a></td>
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
    <td align="left" class="eglibily_head">Documents required <br />for Personal Loan</td>
  </tr>
   <tr>
    <td align="left" class="body_pl_new"><em>Documents required for Personal<br /> Loan in Hyderabad</em></td>
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
								<a href="#" class="ca-more"><img src="new-images/more-pl_box.jpg" width="78" height="21" border="0"/></a></td>
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
				
		</div>
                   
                    <div style="clear:both;"></div>
                    
	  </div>
                   
<img src="new-images/discription_shadow.jpg" width="236" height="10" /> </div>
<div style="clear:both;"></div>
<div class="text_cont_wrap_new"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="body_pl_new"><br />
      <strong>Tips for Best Personal loan deal</strong><br />
1) Compare exact Emi | Processing fee | Tenure | <a href="http://www.deal4loans.com/loans/personal-loan/personal-loan-documents-requirement-deal4loans/">Documents</a> before choosing bank.<br />
2) Never pay any fee to any person to get loan sanctioned.Processing fee is deducted from Loan amount.<br />
3) Only give documents to one bank and check whether he is authorized Bank employee or vendor. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="body_pl_new"><span class="eglibily_head">About Hyderabad</span><br />
      Hyderabad is the capital of Andhra Pradesh (AP) and the fifth largest city of India. While AP is known as the most IT savvy state in India, Hyderabad is emerging as a major center for IT exports. It’s share in Indian IT exports is about 12%. The city is galloping towards its dream of becoming the Silicon Valley of India. Today, it is home to many international companies and global IT majors including Microsoft, CA, Oracle, IBM, Dell, Infosys, Wipro, TCS, Satyam and others. Apart from IT, Hyderabad is also emerging as a leader in the pharma, insurance and tourism sectors. In addition, it also houses the state ministries, defense undertakings and research and development organizations.</td>
  </tr>
</table>
</div>

</div>
<div class="right_container">
<div class="social_rightbx"><img src="new-images/social-img.jpg" width="171" height="60" /></div>
<div class="compare_rightbx">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" align="center" class="comp_text">Compare Offers</td>
    </tr>
    <tr>
      <td><img src="new-images/comp-banks-logo.jpg" width="166" height="154" /></td>
    </tr>
  </table>
</div>
<div class="compare_rightbx" style="margin-top:5px;"><img src="new-images/blinking-right-why.gif" width="165" height="138" /></div>

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
  
<div id="txt">
  <div style="clear:both;"></div>
  <?
	  $selectplbanks="Select * From personal_loan_banks_eligibility where pl_bank_flag=1";
	$plbankresult = ExecQuery($selectplbanks);
	$rowscount = mysql_num_rows($plbankresult);
	  ?>
  <div style="clear:both;"></div>
<div>
 <div class="faqContainer"></div>
    </div>
</div>

<table cellpadding="0" cellspacing="1" border="0" width="100%">
<tr><td width="70%" valign="top">
<table cellpadding="0" cellspacing="1" border="0">

<tr><td class="text11" style="color:#4c4c4c; padding-left:8px;">
<?php
echo $HeaderDEscription;
?>
</td></tr></table>
</td></tr></table>
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
