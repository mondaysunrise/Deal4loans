<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

$maxage=date('Y')-62;
$minage=date('Y')-18;


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
<link href="/css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
<link href="/source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/scripts/mainmenu.js"></script>
<link href="/css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="/js/sprinkle.js"></script>
<script type="text/javascript" src="/js/easySlider1.5.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
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
<div style="width:970px; height:33; margin-top:15px; float:left; clear:right;">
<h1 class="text3"  style="width:700px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943; margin-left:15px;">Personal Loan <?php echo $City?></h1>
<div class="text3" style="width:160px; height:33; margin-top:15px; float:right; clear:right;"><a href="/personal-loan-emi-calculator.php"><img src="/images/emipl.gif" name="Image3" width="150" height="20" border="0" id="Image3" /></a></div>
</div>
<div style=" margin-left:15px; float:left; width:940px; height:1px;; margin-top:1px; "><img src="/images/point5.gif" width="940" height="1" /></div>

<div style="clear:both; height:5px;"></div>
<div id="txt">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
<tr><td width="70%" valign="top">
<table cellpadding="0" cellspacing="1" border="0">

<tr><td class="text11" style="color:#4c4c4c; padding-left:8px;">
<?php
echo $HeaderDEscription;
?>
</td></tr></table>
</td></tr></table>
</p>
<?php include "pl-formemicalc.php";?>
</div>

<table border="0" align="center" cellpadding="2" cellspacing="1" width="950" >
<tr><td valign="top" width="780">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
<tr><td class="text11" style="color:#4c4c4c; ">
<?php
echo $PageDescription;
?></td></tr></table>
   </td></tr></table>
<br />
<div style="float:left; color:#4c4c4c;" class="text11" ><h4>Current Personal Loan Interest Rates </h4></div> 
  <?
	  $selectplbanks="Select * From personal_loan_banks_eligibility where pl_bank_flag=1";
	$plbankresult = ExecQuery($selectplbanks);
	$rowscount = mysql_num_rows($plbankresult);
	  ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0"  style="border: 1px solid #ececec; ">
  
  <tr>
    <td valign="top"  >
    <table width="132" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td height="48" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:16px;"><strong>Banks</strong></strong></td></tr>
  <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Rate of Interest 
        </strong></td></tr>
  <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Processing Fee
        </strong></td></tr>
          <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Loan Amount
        </strong></td></tr>
          <tr>
        <td width="142" height="90" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Prepayment Charges
        </strong></td></tr>
          <tr>
        <td width="142" height="70" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Disbursal Time
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
        <td height="48" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:16px;"><strong><? echo $myrow["pl_bank_name"];?></strong></strong></td></tr>
  <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow["pl_bank_roi"];?>
        </strong></td></tr>
  <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow["pl_bank_processing_fee"];?>
        </strong></td></tr>
          <tr>
        <td width="142" height="53" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow["pl_bank_loan_amt"];?>
        </strong></td></tr>
          <tr>
        <td width="142" height="90" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow["pl_bank_prepayment"];?>
        </strong></td></tr>
          <tr>
        <td width="142" height="70" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow["pl_bank_disbursal_time"];?>
        </strong></td></tr>
              </table>
        </td>
          <? 
			   $i=$i+1;
			   }
			   }
			   ?>
  </tr>
   <tr>
    <td width="142" height="47" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Basic Documents</strong></td><td colspan="6"><table  border="0" cellpadding="0" cellspacing="0" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;">
                <tr>
                <td class="font2"><b>Identity Proof : </b>  Passport/ Driving License/PAN card/                                              
                  Photo credit card (with embossed 
                  Signature and last two months                                                      
                  statement)/ banker&rsquo;s sign verification <strong>(Anyone of the above) </strong></td>
              </tr>
              <tr>
                <td class="font2"><b>Age Proof : </b> PAN Card/ Passport/ Driving  License                                                                                                           / School leaving certificate/ Voter&rsquo;s card/BirthCertificate/ LIC policy (only for                                                    
                  age Proof). <strong>(Anyone of the above) </strong></td>
              </tr>
              <tr>
               <td class="font2"><b>Address Proof : </b> Passport/ Telephone bill 
                  (BSNL/MTNL)/ Electricity bill/ Title 
                  deed of property/Rental agreement/                                                                                 
                  Driving license/ Election ID card/ 
                  Photo-credit card (with last two month 
                  statements) <strong>(Anyone of the above)</strong></td>
              </tr>
              <tr>
                 <td class="font2"><b>Income Proof : </b> Latest salary slip/current dated salary                    
                  Certificate with latest form 16 <strong>(Anyone of the above)</strong></td>
              </tr>
              <tr>
                  <td  class="font2"><b>Job Continuity Proof : </b> Form 16/relieving letter/appointment                   
                  Letter (for last two months)<strong> (Anyone of the above)</strong></td>
              </tr>
              <tr>
                
                <td  class="font2"><b>Banking History : </b> Bank statements of latest 2 months/                   
                  3 months bank passbook <strong>(Anyone of the above)</strong></td>
              </tr>
          </table></td></tr>
</table>
<div class="text11" style="color:#4c4c4c; ">  <br />
  <b>Disclaimer:</b> Deal4loans.com doesn't provide Loans on its own but ensures your information is sent to bank which you have opted for. Deal4loans has no
sales team on its own and we just help you to compare loans .All loans are on discretion of the associated Banks.<br></div>


</div>


<div style="clear:both; height:15px;"></div></div>
<!--partners-->
<!--partners-->
<?php include "footer_pl.php"; ?>

</body>
</html>
