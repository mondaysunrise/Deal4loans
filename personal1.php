<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

/*if(strlen(strpos($_SERVER['REQUEST_URI'], "vijaya")) > 0)
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
*/
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
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title><?php echo $Title; ?></title>
<meta name="keywords" content="<?php echo $MetaKeyword; ?>">
<meta name="description" content="<?php echo $MetaDescription; ?>">
<link href="http://www.deal4loans.com/css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
<link href="http://www.deal4loans.com/source.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript" src="http://www.deal4loans.com/scripts/mootools.js"></script>
<style>h3{	font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	text-decoration:none;	color:#1c50b0;	padding:0px;	margin:0px 0px 0px 0px;	text-align:left;}.faqContainer{	padding:10px;}.faqContainer .toggler {	padding:5px 0px 0px 15px;font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:13px;	line-height:17px;	font-weight:bold;	text-align:justify;	background:transparent url(images/bullet12.gif) no-repeat scroll 0px 10px;	cursor:pointer;}.elementInside{	border-bottom:1px solid #CCCCCC;	margin:4px 0px 4px 0px;	padding:4px 0px 5px 0px; 	font-family: Verdana, Geneva, sans-serif;	font-size: 11px;	font-weight: normal;	font-variant: normal;	color: #4c4c4c;	text-decoration: none;}.element_atStart_dv{margin:4px 0px 4px 0px; border-bottom:1px solid #CCCCCC; height:auto; font-family: Verdana, Geneva, sans-serif;	font-size: 11px;	font-weight: normal;	font-variant: normal;	color: #4c4c4c;	text-decoration: none; }</style>
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

</head>
<body>
<!--top-->

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->


<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="/index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="/personal-loans.php"  class="text12" style="color:#4c4c4c;">Personal Loan</a></u> >  <span  class="text12" style="color:#4c4c4c;"> Apply Personal Loan - <?php echo $City?></span></div>
<div class="intrl_txt">
<div style="width:970px; height:23; margin-top:10px; float:left; clear:right;">
<h1 class="text3"  style="width:700px; height:23; margin-top:0px; float:left; clear:right; font-size:24px; text-transform:none; color:#88a943; margin-left:15px;">Personal Loan <?php echo $City?></h1>
<div class="text3" style="width:160px; height:33; margin-top:15px; float:right; clear:right;"><a href="/personal-loan-emi-calculator.php"><img src="/images/emipl.gif" name="Image3" width="150" height="20" border="0" id="Image3" /></a></div>
</div>
<div style=" margin-left:15px; float:left; width:940px; height:1px;; margin-top:1px; "><img src="/images/point5.gif" width="940" height="1" /></div>

<div style="clear:both; height:10px;"></div>
<div id="txt">
<?php include "pl-formcity.php";?>
<div style="clear:both;"></div>
<div style="float:left; color:#4c4c4c;" class="text11" ><h4>Current Personal Loan Interest Rates in <?php echo $City?> </h4></div> 
  <?
	  $selectplbanks="Select * From personal_loan_banks_eligibility where pl_bank_flag=1";
	$plbankresult = ExecQuery($selectplbanks);
	$rowscount = mysql_num_rows($plbankresult);
	  ?>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0"  style="border: 1px solid #ececec; ">
  
  <tr>
    <td valign="top"  >
    <table width="132" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:14px;"><strong>Banks</strong></strong></td></tr>
  <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Rate of Interest 
        </strong></td></tr>
  <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Processing Fee
        </strong></td></tr>
          <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Loan Amount
        </strong></td></tr>
          <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Prepayment Charges
        </strong></td></tr>
          <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Disbursal Time
        </strong></td></tr>
              </table>
        </td>
 <?
	  $selectplbanks="Select * From personal_loan_banks_eligibility where pl_bank_flag=1";
	$plbankresult = ExecQuery($selectplbanks);
	$rowscount = mysql_num_rows($plbankresult);
	  ?>
              <?
		 if($rowscount>0)
		 {
		 	$i=0;
		 while($myrow = mysql_fetch_array($plbankresult))
		 {?>
  <td valign="top"  >
    <table width="162" border="0" align="center" cellpadding="0" cellspacing="0"  >
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
              </table>
        </td>
          <? 
			   $i=$i+1;
			   }
			   }
			   ?>
  </tr>
</table>
<div style="clear:both;"></div>
<div>
 <div class="faqContainer">
               <div id="demo">
                  <div id="accordion">
                  
                  <div style="width:200px; float:left;"><h3 class="toggler atStart"><b>Eligibility Criteria</b></h3></div> <div style="width:250px; float:left;"><h3 class="toggler atStart"><b>List of Personal Loans Banks </b></h3></div> <div style="width:300px; float:left;"><h3 class="toggler atStart"><b>Documents required for Personal Loan</b></h3></div>
                  <div style="clear:both;"></div>
                    <div class="element atStart">
                      <div class="elementInside">  <p class="p_class"><span style="font-size:13px; font-weight:bold; " >Eligibility Criteria for Personal Loan in <?php echo $City?></span><br /><br />Banks offer  Loan to borrowers depending on various factors such as income, employment,  continuity of business so as to make sure that they repay the loan with  interest before the due date. The eligibility criterion of a personal loans is  primarily based on the work profile of a loan seeker which is broadly divided  into the following two classes: <br>
<table cellpadding="4" cellspacing="0" border="1" width="80%">
<tr><td align="center"><strong>Salaried</strong></td><td align="center"><strong>Self Employed</strong></td></tr>
<tr><td><strong>Metros</strong>: Minimum Salary Required is Rs. 15000/- p.m<br />
<strong>Other Cities</strong>: Minimum Salary is Rs. 12500/- p.m

</td><td >
<strong>Metros</strong>: Minimum ITR Rs. 150000/-<br />
<strong>Other Cities</strong>: Minimum ITR Rs. 150000/-
</td></tr>

</table>
	   <br>
	    In addition to the above factors banks also consider other  aspects such as age, work experience, existing relationship with the bank,  repayment capacity etc.<br>
	    To find your eligibility Criteria across various banks in  accordance with the above parameters; Deal4Loans has brought in the <a href="http://deal4loans.com/Contents_Personal_Loan_Eligibility.php">Eligibility  Criteria</a> Check for Loan  seekers.</p></div> </div>
              
                    <div class="element atStart"><div class="elementInside">
                 <br /> <span style="font-size:13px; font-weight:bold; " >  List of Personal Loans Banks in <?php echo $City?></span><br /><br />
                      <table border="1" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td width="128" valign="top"><p align="center">State Bank of India(SBI)</p></td>
                          <td width="128" valign="top"><p align="center">HDFC Bank</p></td>
                          <td width="128" valign="top"><p align="center">Bajaj Finserv</p></td>
                          <td width="128" valign="top"><p align="center">ICICI Bank</p></td>
                          <td width="128" valign="top"><p align="center">Axis Bank</p></td>
                        </tr>
                        <tr>
                          <td width="128" valign="top"><p align="center">Standard Chartered</p></td>
                          <td width="128" valign="top"><p align="center">Fullerton India</p></td>
                          <td width="128" valign="top"><p align="center">ING Vysya</p></td>
                          <td width="128" valign="top"><p align="center">Kotak Bank</p></td>
                          <td width="128" valign="top"><p align="center">HDB Financial Services</p></td>
                        </tr>
                        <tr>
                          <td width="128" valign="top"><p align="center">Bank of Baroda</p></td>
                          <td width="128" valign="top"><p align="center">Bank of India</p></td>
                          <td width="128" valign="top"><p align="center">Union Bank of India</p></td>
                          <td width="128" valign="top"><p align="center">United Bank of India</p></td>
                          <td width="128" valign="top"><p align="center">Punjab National Bank</p></td>
                        </tr>
                        <tr>
                          <td width="128" valign="top"><p align="center">Yes Bank</p></td>
                          <td width="128" valign="top"><p align="center">IndusInd Bank</p></td>
                          <td width="128" valign="top"><p align="center">Dena Bank</p></td>
                          <td width="128" valign="top"><p align="center">Andhra Bank</p></td>
                          <td width="128" valign="top"><p align="center">Citibank</p></td>
                        </tr>
                        <tr>
                          <td width="128" valign="top"><p align="center">Canara Bank</p></td>
                          <td width="128" valign="top"><p align="center">Indian Bank</p></td>
                          <td width="128" valign="top"><p align="center">Vijaya Bank</p></td>
                          <td width="128" valign="top"><p align="center">Corporation Bank</p></td>
                          <td width="128" valign="top"><p align="center">RBS</p></td>
                        </tr>
                      </table>
                    </div> </div>
                    

				
				<div class="element atStart"><div  class="element_atStart_dv">
           <br />      <span style="font-size:13px; font-weight:bold;" > Documents required for Personal Loan in <?php echo $City?></span><br /><br />
   <ul>
            <li><strong>Identity    Proof : </strong>Passport/ Driving License/PAN card/ Photo credit card (with embossed Signature and last two months    </li>  <li><strong>Age    Proof : </strong>PAN Card/ Passport/ Driving    License / School leaving certificate/ Voter&rsquo;s card/BirthCertificate/ LIC    policy (only for age Proof). <strong>(Anyone of the above) </strong></li>

            <li><strong>Address    Proof : </strong>Passport/ Telephone bill    (BSNL/MTNL)/ Electricity bill/ Title deed of property/Rental agreement/    Driving license/ Election ID card/ Photo-credit card (with last two month    statements) <strong>(Anyone of the above)</strong></li>
            <li><strong>Income    Proof : </strong>Latest salary slip/current dated    salary Certificate with latest form 16 <strong>(Anyone of the above)</strong></li>
            <li><strong>Job Continuity Proof : </strong>Form 16/relieving  letter/appointment Letter (for last two months)<strong> (Anyone of the above)</strong></li>
            <li><strong>Banking History : </strong>Bank statements of latest 2 months/ 3 months bank passbook <strong>(Anyone of the above)</strong></li>
          </ul> </div> </div>
          
       </div>
                 </div>
                </div>
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


<table border="0" align="center" cellpadding="2" cellspacing="1" width="950" >
<tr><td valign="top" width="780">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
<tr><td class="text11" style="color:#4c4c4c; ">
<?php
echo $PageDescription;
?></td></tr></table>
   </td></tr></table>

<div style="clear:both;"></div>
<div class="text11" style="color:#4c4c4c;">  <br />
  <b>Disclaimer:</b> Deal4loans.com doesn't provide Loans on its own but ensures your information is sent to bank which you have opted for. Deal4loans has no
sales team on its own and we just help you to compare loans .All loans are on discretion of the associated Banks.<br></div>


</div>

</div>

<div style="clear:both; height:15px;"></div></div>
<!--partners-->
<!--partners-->
<?php include "footer_pl1707.php"; ?>

</body>
</html>
