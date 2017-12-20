<?php
	
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<link href="landing-page-styles.css" rel="stylesheet" type="text/css">
<link href="landing-page-media-queries.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Apply for Personal Loan | Personal Loans Online Apply India |Deal4Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans banks like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad.">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style type="text/css">
		/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
 
h3{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	text-decoration:none;
	color:#660000;
	padding:0px;
	margin:0px 0px 0px 0px;
	text-align:left;
	cursor:pointer;
}

.faqContainer .toggler {
	padding:5px 0px 0px 15px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:17px;
	font-weight:bold;
	text-align:justify;
	cursor:pointer;
}

.elementInside{
	border-bottom:1px dashed #6a290d;
	margin:0px 0px 4px 0px;
	padding:0px 0px 6px 0px; 
}
 

body {
	margin: 0px;
	padding:0px;	 
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#292323;
	}
	
	
input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}


.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}
  
     
	
	/*--------------step2 css-----------------*/
	
	 
/* extra div*/
.expandeddiv{
height:138px;
width:auto;
border-left:2px solid #5578C8;
border-right:2px solid #5578C8;
}
.addexpandeddiv{
height:150px;
width:auto;
border-left:2px solid #5578C8;
border-right:2px solid #5578C8;
}


</style>


<style>
.bnk_logo{
	width:105px;
	height:35px;
	padding-left:4px;
	padding-top:0px;
	*padding-top:11px;
}

.colprop{
color:#373737;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
line-height:15px;

}
</style>
</head>

<body>
<div id="pagewrap">
<header id="header_continue">
<div id="continue_logo"><img src="new-images/pl/deal4loans-continue-logo.jpg"></div></header>
<div style="clear:both;"></div>
<div class="pl_cont_text">60% of your application for quote from all Banks is complete.</div>
<div class="ajax_loader_box"><img src="new-images/hl/ajax-loader.gif"></div>
<div class="pl_cont_text" style="color:#136071;">Share few more details to get exact quote on Emi,Rates &amp; Loan Amount.</div>
  <div id="continue_form" style="margin-top:10px;">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="35" colspan="7" align="center" bgcolor="#f4f4f4" class="form_text_pl" style="font-size:13px;">Personal Loan Quote Request</td>
      </tr>
      <tr>
        <td width="41%" height="30" class="frmbldtxt">Primary Account in which bank?</td>
        <td colspan="6"><input name="Primary_Acc" type="text" class="input_box" id="Primary_Acc" onChange="getstatementlink();" onClick="getstatementlink();" onKeyDown="getstatementlink();" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();"></td>
      </tr>
      <tr>
        <td height="30" class="frmbldtxt">Residential Status</td>
        <td width="5%" valign="middle"><input type="radio" value="1" name="Residential_Status"  checked="checked" />  
        </form>
      </td>
        <td width="8%">Owned</td>
        <td width="4%"><input type="radio"  value="2" name="Residential_Status" /></td>
        <td width="9%">Rented</td>
        <td width="5%"><input type="radio"  value="3" name="Residential_Status" /></td>
        <td width="28%">Company Provided</td>
      </tr>
      <tr>
        <td height="30" class="frmbldtxt">Company Type</td>
        <td height="30" colspan="6"><select name="Company_Type" class="select_input" id="Company_Type">
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			 <option value="4">Govt.( Central/State )</option>
		<option value="5">PSU (Public sector Undertaking)</option>
		</select></td>
      </tr>
      <tr>
        <td height="30" class="frmbldtxt">No. of years in this Company</td>
        <td colspan="6"><input name="Years_In_Company" type="text" class="input_box"  maxlength="15"></td>
      </tr>
      <tr>
        <td height="30" class="frmbldtxt">Total Experience (Years)/ Total Years in Business</td>
        <td colspan="6"><input   name="Total_Experience" class="input_box" onFocus="this.select();">  </td>
      </tr>
      <tr>
        <td height="30" class="frmbldtxt">Any Loan running?</td>
        <td colspan="6"><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" /> Yes &nbsp;  <input size="10" type="radio"  name="LoanAny"  onclick="removeElementLoan();" value="0"> No</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7" align="center"><input type="image" name="Submit" src="new-images/pl/quote.gif" style="width:115px; height:29px; border:none; "></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6">&nbsp;</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
