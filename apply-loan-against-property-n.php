<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();
$maxage=date('Y')-65;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="LAP Site Page";
}

# Rating Reviews
$session_id = session_id();
$page_name = $_SERVER['PHP_SELF'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply and Compare Loans Against Property India</title>
<meta name="keywords" content="Loan Against Property India, Apply Loan Against Property, Compare Loan Against Property in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/wp_cl.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="loan_against_property_tst.js"></script>
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

<!-- Code for Aggregate star rating -->
<style type="text/css">
body {margin:15px;font-family:Arial;font-size:13px;}
a img{border:0;}
.datasSent, .serverResponse{margin-top:0px; color:#000000;height:20px;padding:5px;float:left;margin-right:5px}
.datasSent{float:left; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000;}
.serverResponse{position:fixed;left:680px;top:100px}
.datasSent p, .serverResponse p {font-style:italic;font-size:12px; padding:0px 0px 0px 0px; margin:0px 0px 0px 0px; }
.exemple{float:left; margin-top:5px; width:150px; padding-left:5px; font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#000;}
.clr{clear:both}
pre {margin:0;padding:0}
.notice {background-color:#F4F4F4;color:#666;border:1px solid #CECECE;padding:10px;font-weight:bold;width:600px;font-size:12px;margin-top:10px}
.review_wrapper{ width:970px; padding:5px 0px 5px 0px; background:#fff5d9;}
.review_text{ float:left; width:125px; padding-left:8px; font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000; margin-top:5px;}
.review_text-right{ float:right; margin-right:8px; padding:5px;  font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000;}
.review_star{ float:left; margin-top:5px; width:125px; padding-left:0px; font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#000;}
</style>
<!--//-->
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; max-width:970px; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="loan-against-property.php"  class="text12" style="color:#0080d6;"><u>Loan Against Property</u></a> <span  class="text12" style="color:#4c4c4c;">> Apply for Loan Against Property</span></div>
<div class="intrl_txt" style="margin:auto;">
<!-- Code for Aggregate Star Rating Starts -->
<div class="pl_titile_wraper" style="width:100%;">
	<div itemscope itemtype="http://schema.org/Product">
	<h1 class="text3" id="title_pl" itemprop="name" style="width:500px;">Apply Loan Against Property</h1>
        
    <div style="clear:both; height:15px;"></div>
   
</div>
<div style="clear:both;"></div>
</div>
<!-- Aggregate Star Rating Ends -->

<div class="pl_form_box">
  <form name="loan_form" method="post" action="apply-loan-against-property-continue.php" onSubmit="return chkform();">
   <input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="source" value="LAP RBL testpage">
<div style="clear:both;"></div>
<div style="padding-left:20px; font-size:19px; color:#FFFFFF; margin-top:10px;">

</div>

<div style="clear:both;"></div>

<div style="padding-left:20px; font-size:19px; color:#FFFFFF; margin-top:10px;">
Professional Details
</div>
<div style="clear:both;"></div>
<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>
    
      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</span></td>
    </tr><tr>
      <td height="25"><input name="Loan_Amount" id="Loan_Amount" tabindex="1" type="text" class="pl_input_b" maxlength="10" onFocus="this.select();" onChange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
     <div id="loanAmtVal"></div>
      </td>
    </tr>
     <tr>                       <td  class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><span id='formatedlA' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>                    </tr>
         </table>
    </div>
<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation:</span></td>
    </tr><tr>   <td height="25">
      <select   name="Employment_Status"  id="Employment_Status" class="pl_select_b" tabindex="2"  onchange="addSalaryText(this.value); validateDiv('empStatusVal');" >
                           <option value="-1">Employment Status</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employed</option>
                       </select>  <div id="empStatusVal"></div>
     </td>
    </tr>
     </table>
    </div>
    <div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;" id="netSalText">Net Salary/Income (Yearly/ITR):</span></td>
    </tr><tr>
      <td height="25">
      <input type="text" name="Net_Salary" id="Net_Salary" class="pl_input_b" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="3" onkeydown="validateDiv('netSalaryVal');" />
     <div id="netSalaryVal"></div>
      
     </td>
    </tr>
    
       <tr>  <td  class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td> </tr>
        </table>
    </div>

<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
     </tr><tr>
      <td height="25" ><select name="City" id="City" class="pl_select_b" onChange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="4">
  <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>	 </select>
                         <div id="cityVal"></div>   </td>
    </tr>
        </table>
    </div>
<div style="clear:both;"></div>
<div id="other_Details">

<div class="pl_terms_box"><input type="checkbox"  name="accept" style="border:none;"  > I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.</div>                  <div class="cl_new_bnt_b" style="margin-top:6px; margin-right:20px;"><img src="http://www.deal4loans.com/images/wp-loan-get-quote.png" width="114" height="52" border="0" /></div>

</div>
<div style="clear:both;"></div>
<div id="personalDetails"></div>
</form></div>
<div style="clear:both;"></div>
<table border="0" align="center" cellpadding="0" cellspacing="0" style="width:100%; max-width=964px;">
  <tr>
    <td height="22" valign="top" >&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"  ><table border="0" align="center" cellpadding="0" cellspacing="1" style="width:100%; max-width=958px; border: 1px solid #ececec; ">
      <tr>
        <td height="35" align="center" valign="middle" class="font2" style="background-color:#88a943;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>Banks</strong></strong></td>
        <td height="35" align="center" valign="middle" style="background-color:#88a943;" class="font2"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>up to 30 lacs</strong></strong></td>
        <td height="35" align="center" valign="middle" class="font2" style="background-color:#88a943;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>30-75 lacs</strong></strong></td>
        <td height="35" align="center" valign="middle" class="font2" style="background-color:#88a943;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>75 lacs & above</strong></strong></td>
        <td height="35" align="center" valign="middle" class="font2" style="background-color:#88a943;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>Processing fees</strong></strong></td>
        </tr>
<?php
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
$getRatesSql = "select * FROM  `lap_interest_rate` where Status =1 and B_id in (1,2,4,17,7,3,6) order by Sequence asc";
list($getRatesNumRows,$row)=MainselectfuncNew($getRatesSql,$array = array());

//$getRatesQuery = ExecQuery($getRatesSql);
//$getRatesNumRows = mysql_num_rows($getRatesQuery);
$BankURL = '';
$link1 = '';
$link2 = '';
$arrcont=count($row)-1;
$cntr=0;
if($getRatesNumRows>0)
            {
while($cntr<$arrcont)
{
	$BankURL = '';
	$link1 = '';
	$link2 = '';
	$BankName = $row[$cntr]['BankName'];
	$Upto30 = $row[$cntr]['Upto30'];
	$Upto75 = $row[$cntr]['Upto75'];
	$Above75 = $row[$cntr]['Above75'];
	$ProcessingFee = $row[$cntr]['ProcessingFee'];
?>
<tr>
        <td width="12%" height="33" align="center" valign="middle" class="font2" style="border-bottom:2px #ececec dashed;"><strong><?php echo $BankName; ?><br />
        </strong></td>
        <td width="22%" align="center" valign="middle" class="font" style="border-bottom:2px #ececec dashed;"><?php echo $Upto30; ?><br />
         </td>
        <td width="22%" align="center" valign="middle" class="font" style="border-bottom:2px #ececec dashed;"><?php echo $Upto75; ?></td>
        <td width="22%" align="center" valign="middle" class="font" style="border-bottom:2px #ececec dashed;"><?php echo $Above75; ?></td>
        <td width="22%" align="center" valign="middle" class="font" style="border-bottom:2px #ececec dashed;"><?php echo $ProcessingFee; ?></td>
      </tr>
      <?php $cntr=$cntr+1;} } ?>
	  <tr>
        <td width="12%" height="33" align="center" valign="middle" class="font2" style="border-bottom:2px #ececec dashed;"><strong>RBL Bank<br />
        </strong></td>
        <td width="22%" align="center" valign="middle" class="font" style="border-bottom:2px #ececec dashed;">12.25% - 12.75%
         </td>
        <td width="22%" align="center" valign="middle" class="font" style="border-bottom:2px #ececec dashed;">12.25% - 12.75%</td>
        <td width="22%" align="center" valign="middle" class="font" style="border-bottom:2px #ececec dashed;">12.25% - 12.75%</td>
        <td width="22%" align="center" valign="middle" class="font" style="border-bottom:2px #ececec dashed;">1% + service Tax</td>
      </tr>
    </table></td>
  </tr>
</table>
<div style="clear:both; height:15px;"></div>
<div style="clear:both;"></div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>
