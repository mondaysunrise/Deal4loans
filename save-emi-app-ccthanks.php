<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$requestid = $_POST["unique_code"];
	$cc_bankname = $_POST["cc_bankname"];
	$cc_loanamount = $_POST["cc_loanamount"];
	$cc_interestrate = $_POST["cc_interestrate"];
	$cc_emi = $_POST["cc_emi"];
	$cc_term = $_POST["cc_term"];
	$cc_totalsave = $_POST["cc_totalsave"];
	$quote_type = $_POST["quote_type"];
	$processing_fee = $_POST["processing_fee"];
	$cc_bidderid = $_POST["cc_bidderid"];
	$cc_bankid = $_POST["cc_bankid"];

	//check for name and verify mobile
	$saveemiqry="Select Name,Mobile_No from  saveemicalc_tbl Where (saveemiid=".$requestid.")";
	list($myrowNR,$myrow)=MainselectfuncNew($saveemiqry,$array = array());
	if(strlen($myrow[0]["Name"])>0 && strlen($myrow[0]["Mobile_No"])>0)
	{

		 $msg="Only thanks";
	}
	else
	{
		$msg="ask more details";
		$notvalid=1;		
	}
	//check for same quote entry
	$saveemiquoteqry="Select quotetblid from  saveemicalc_tbl_quotes Where (saveemiid=".$requestid." and quote_type='".$quote_type."' and bank_name like '%".$cc_bankname."%')";

	list($myquoteNR,$myquote)=MainselectfuncNew($saveemiquoteqry,$array = array());
	if($myquote[0]["quotetblid"]>0)
	{
		$msg="Only thanks";
	}
	else
	{
		if($cc_bankid>0)
		{
			$getbidderidlist="select BidderID from Bidders_List Where (BankID=".$cc_bankid." and BidderID in (".$cc_bidderid."))";
			list($bidrowNR,$bidrow)=MainselectfuncNew($getbidderidlist,$array = array());
			for($i=0;$i<$bidrowNR;$i++)
			{
				$finalBidderid[] = $bidrow[$i]["BidderID"];
			}
			$allocatebidderid=implode(",",$finalBidderid);
		}

		//insert details
		$dataInsert = array('saveemiid'=>$requestid, 'quote_type'=>$quote_type, 'bank_name'=>$cc_bankname, 'loan_amount'=>$cc_loanamount, 'interest_rate'=>$cc_interestrate, 'emi_amount'=>$cc_emi, 'term_period'=>$cc_term, 'processing_fee'=>$processing_fee, 'total_saving'=>$cc_totalsave, 'Bidders_idlist'=>$allocatebidderid);
		$table = 'saveemicalc_tbl_quotes';
		$quotetblid_nw = Maininsertfunc ($table, $dataInsert);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
		.hintanchor{ color: #FF0000; font-size: 10px; font-weight: bold;}
		</style>    
<script>
function chkpersonalloan(Form)
{
		if(Form.name.value=="")
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
			Form.name.focus();
			return false;
		}
		if((Form.mobile_number.value==''))
		{
		document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter Mobile Number</span>";
		Form.mobile_number.focus();
		return false;
		}
		else if(isNaN(Form.mobile_number.value)|| Form.mobile_number.value.indexOf(" ")!=-1)
		{
		document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter Numeric Value</span>";
		Form.mobile_number.focus();
		return false;  
		}
		else if (Form.mobile_number.value.length < 10 )
		{
		document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter 10 Digits</span>";
		Form.mobile_number.focus();
		return false;
		}
		else if ((Form.mobile_number.value.charAt(0)!="9") && (Form.mobile_number.value.charAt(0)!="8") && (Form.mobile_number.value.charAt(0)!="7"))
		{
		alert("The number should start only with 9 or 8 or 7");
		document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Start with 9 or 8 or 7</span>";
		Form.mobile_number.focus();
		return false;
		}
		if(Form.email.value=="")
		{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		Form.email.focus();
		return false;
		}
		
		var str=Form.email.value
		var aa=str.indexOf("@")
		var bb=str.indexOf(".")
		var cc=str.charAt(aa)
		if(aa==-1)
		{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.email.focus();
		return false;
		}
		else if(bb==-1)
		{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.email.focus();
		return false;
		}
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
</script>
    <link rel="stylesheet" href="tabs.css" type="text/css" media="screen, projection"/>	
    <style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	form{
		display:inline;
	}	
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
    </style>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.text11 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none; 	
}
.text9 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: normal;
	color: #697e94;
	text-decoration: none; 
}

.text9 a{
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: normal;
	color: #697e94;
	margin:0px;
	padding:0px;
	text-decoration:underline;
}

.text12 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none; 
}
 
.text {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
	line-height: 18px;
}
.text2 {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
}
.text3 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #909faf;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:link {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 	padding:5px 12px 5px 12px ;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:visited {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 		padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:hover {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
	font-variant: normal;
	color: #203f5f;
	text-decoration: none;
	  	padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
.text4 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 10px;
	font-weight: bold;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
.textbox {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #666;
	text-decoration: none;
	height: 18px;
	width: 153px;
	border: none;
	margin-top:7px;
	margin-left:30px;
 }

.font {
	font-family: DroidSansRegular;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #666666;
	text-decoration: none;
	font-style: italic;	  
}
-->
</style>
<link href="source1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<link href="source.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
</head>
<?php include "top-menu.php"; ?><!-top-></div>
<!-logo navigation->
<?php include "main-menu-saveemiapp.php"; ?>
<div style="clear:both;"></div>
<div class="myapp-save_second-wrapper-new">
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div> </div>
<div style="clear:both;"></div>
<div class="thanks_section">
<? if($notvalid==1)
{
?>
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
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><? echo round($cc_term/12); ?> yrs</td>
		<? if(strlen($processing_fee)>1)
		{ ?>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><? echo $processing_fee; ?></td>
			<? } ?>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text">Rs. <? echo $cc_totalsave; ?></td>
           </tr>
		</table>
        </td></tr>
         <tr><td align="center" >&nbsp;</td></tr>
                  
        <tr><td align="center" valign="top">
<form action="save-emi-app-validate.php" method="POST" name="personaldetails" onSubmit="return chkpersonalloan(document.personaldetails);">
<input type="hidden" name="quotetblid" id="quotetblid" value="<? echo $quotetblid_nw;?>">
<input type="hidden" name="requestid" id="requestid" value="<? echo $requestid;?>">
   <table width="600" cellpadding="0" cellspacing="0" height="200" border="0" style="border:1px #666666 solid;">
        <tr>
            <td valign="top" align="center" style="padding-top:12px;">
                <table cellpadding="0" cellspacing="10" border="0" width="100%">
                <tr>
                  <td colspan="3" ><span style="color: #0A66BF; font-family: Arial,Helvetica,sans-serif; font-size: 20px; padding-bottom: 10px;">Personal Details</span><table>
                  <tr><td width="5%" ><span style="font-size:10px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#666666;"><img src="http://www.deal4loans.com/images/security.png" alt="" width="14" height="16"></span></td>
                  <td colspan="2"><span style="font-size:10px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#666666;">To Learn and Apply for the offer.Please share your details</span></td></tr>
                  </table></td>
                </tr>             
                    <tr>	
                        <td colspan="2" >Name</td>
                        <td width="60%"><input type="text" name="name" id="name" style="border: 1px solid #878787; margin:0; padding:0; width:300px; height:22px;" onKeyDown="validateDiv('nameVal');"><div id="nameVal"></div></td>
                    </tr>
                      <tr>	
                        <td colspan="2">Email</td>
                        <td><input type="text" name="email" id="email" style="border: 1px solid #878787; margin:0; padding:0; width:300px; height:22px;" onKeyDown="validateDiv('emailVal');"><div id="emailVal"></div></td>
                    </tr>
                      <tr>	
                        <td colspan="2">Mobile Number</td>
                        <td>+91 <input type="text" name="mobile_number" id="mobile_number" style="border: 1px solid #878787; margin:0; padding:0; width:270px; height:22px;" onKeyDown="validateDiv('mobileVal');" maxlength="10"><div id="mobileVal"></div></td>
                    </tr>
                    <tr>	
                        <td colspan="3" align="center"><input name="image"  value="Submit" type="image" src="images/saveemi-sbt.jpg" width="120" height="39"  style="border:0px;" />							                          </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
	</form>
    </td></tr></table>
    <? }
	else
	{ ?>
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
   			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><? echo "Bank I"; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text">Rs. <? echo $cc_loanamount; ?></td>
			<td height="35" bgcolor="#D6D6D6" class="td-details-bg"><? echo $cc_interestrate; ?> %</td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text">Rs. <? echo $cc_emi; ?></td>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><? echo round($cc_term/12); ?> yrs</td>
		<? if(strlen($processing_fee)>1)
		{ ?>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><? echo $processing_fee; ?></td>
			<? } ?>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text">Rs. <? echo $cc_totalsave; ?></td>
           </tr>
		</table>
        </td></tr></table>	
	<? } ?>
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
<div style="background-color:#203F5F;"><?php include "footer_index.php";?> </div>
</body>
</html>