<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

//Print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$requestid=$_POST["requestid"];
	$quotetblid=$_POST["quotetblid"];
	$Reference_Code=$_POST["Reference_Code"];
	$activation_code=$_POST["activation_code"];
	
	if($Reference_Code== $activation_code)
	{
		$dataUpdate = array('Is_Valid'=>'1');
		$wherecondition = "(saveemiid=".$requestid.")";
		Mainupdatefunc ('saveemicalc_tbl', $dataUpdate, $wherecondition);	
	}

	//check for name and verify mobile
	$saveemiqry="Select * from  saveemicalc_tbl_quotes Where (quotetblid=".$quotetblid." and saveemiid=".$requestid.")";
	list($recordcount,$myrow)=MainselectfuncNew($saveemiqry,$array = array());
	$myrowcontr=count($myrow)-1;

	$cc_bankname = $myrow[$myrowcontr]["bank_name"];
	$cc_loanamount = $myrow[$myrowcontr]["loan_amount"];
	$cc_interestrate = $myrow[$myrowcontr]["interest_rate"];
	$cc_emi = $myrow[$myrowcontr]["emi_amount"];
	$cc_term = $myrow[$myrowcontr]["term_period"];
	$cc_totalsave = $myrow[$myrowcontr]["total_saving"];
	$processing_fee = $myrow[$myrowcontr]["processing_fee"];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Save My EMI</title>
<link href="save-my-emi-styles1.css" type="text/css" rel="stylesheet"  />
<link type="text/css" rel="stylesheet" href="easy-responsive-tabssvemi.css" />
    <script src="jquery-1.6.3.min.js"></script>
    <script src="scripts/easyResponsiveTabssvemi.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">	
.div-displaytext{ width:98%; padding:10px 0px 10px 0px; border-radius:7px; border:thin solid #feb800; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-indent:5px; color:#990000;}
.tool-tip-image{ width:185px; margin-top:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#990000; padding:25px 10px 25px 10px; background:#eeeeee; border-radius:7px; border:#90dcef solid 1px; float:left; z-index:2px; margin-left:-5px;  }
.tool-tiparrow{ width:53px; margin:-4px auto;}
</style>
    <style type="text/css">
        .demo {
            width: 1000px;
            margin: 0px auto;
        }
        .demo h1 {
                margin:33px 0 25px;
            }
        .demo h3 {
                margin: 10px 0;
            }
        pre {
            background: #fff;
        }
        @media only screen and (max-width: 780px) {
        .demo {
                margin: 5%;
                width: 90%;
         }
        .how-use {
                float: left;
                width: 300px;
                display: none;
            }
        }
        #tabInfo {display:none;}
		.diverboxnew{width:100%; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:20px; text-align:center;}
		.diverboxnew-new{width:300px; margin:15px auto; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:18px; text-align:center;}
		.boxyesone{ float:left; width:100px; margin-left:15px;}
		.thanks_section{ width:1000px; margin:auto; padding-bottom:10px;}
    </style>
    <link rel="stylesheet" href="tabs.css" type="text/css" media="screen, projection"/>	
</head>
<div class="header-emi-app"></div>
<div class="nav-app-main">
<div class="nav-app-in">
<div class="navmenu">
<ul>
<li><a href="#">Know More</a></li>
<li style="background:url(images/light-blue-bg.jpg) repeat-x !important; "><a href="#" style="padding:25px 15px 15px 15px;">Contact Us</a></li>
</ul>
</div>
</div>
</div>
<div style="clear:both;"></div>
<div class="myapp-save_second-wrapper-new">
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div> </div>
<div style="clear:both;"></div>
<div class="thanks_section">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-radius:7px; background:#FFF;" height="300">
  <tr>
    <td height="55" align="center" bgcolor="#FFFFFF" class="columntext-app"><table width="100%" border="0" cellspacing="1" cellpadding="0" style=" border-radius:7px; border:#999 solid thin;">
      <tr>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Banks </td>
        <td width="18%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Loan Amount</td>
        <td width="19%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Interest Rate</td>
        <td width="16%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">EMI</td>
        <td width="13%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Tenure</td>
		<? if(strlen($processing_fee)>1)
		{ ?>
		<td width="13%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Processing Fee</td>
		<? } ?>
        <td height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Save</td>    
      </tr>
      <tr>
        <td height="7" colspan="7" bgcolor="#CCCCCC" class="td-bg"></td>
      </tr>   
	<tr>
   			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><? echo $cc_bankname; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text">Rs. <? echo $cc_loanamount; ?></td>
			<td height="35" bgcolor="#D6D6D6" class="td-details-bg"><? echo $cc_interestrate; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text">Rs. <? echo $cc_emi; ?></td>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><? echo $cc_term; ?></td>
			<? if(strlen($processing_fee)>1)
		{ ?>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><? echo $processing_fee; ?></td>
			<? } ?>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text">Rs. <? echo $cc_totalsave; ?></td>
           </tr>
		</table>
        </td></tr></table>	
	
</div>
<div class="section-box-buttom">
<div class="section-box-buttom-inn">
<div class="section-box-buttom-left">
<div class="highlight-text"><img src="images/money-pig.png" width="179" height="245"></div>
<div class="highlight-text-b"></div>
</div>
<div class="section-box-buttom-right"><img src="images/laptopgif.gif" width="709" height="503"></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div>
<div class="newwrappersecond"> <div class="mobilebox"><img src="images/mobo-img.jpg" width="438" height="570"></div>
<div class="graph-bxnew"><img src="images/graph-savemyapp-img.jpg" width="319" height="318"></div> </div>
<div style="clear: both; height:10px;"></div>
<div class="my-app-buttom"><div class="my-app-buttom-inn buttom-text"><a href="#">ABOUT US</a> | <a href="#">LEGAL TERMS</a> | <a href="#">CONTACT US</a> | <a href="#">ADVERTISING</a> | <a href="#">HELP</a></div> </div>
</body>
</html>