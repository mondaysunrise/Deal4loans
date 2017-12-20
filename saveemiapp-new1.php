<?php
require 'scripts/functions.php';?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Save My EMI</title>
<link href="save-my-emi-styles1.css" type="text/css" rel="stylesheet"  />
<link type="text/css" rel="stylesheet" href="easy-responsive-tabssvemi.css" />
    <script src="jquery-1.6.3.min.js"></script>
    <script src="easyResponsiveTabssvemi.js" type="text/javascript"></script>
	<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script  type="text/JavaScript">
function change2pl()
{	
	var chkvaloc = document.getElementById('outstanding_amount_cc').value;
	var chkvalcity = document.getElementById('City').value;
	var putherediv = document.getElementById('puthere');
		if(chkvaloc>50000 && chkvalcity!='Please Select')
		{
			if(chkvalcity=="Others")
			{
				putherediv.innerHTML ='<table cellpadding="2" cellspacing="0"  width="100%" style="margin-top:3px;"> <tr><td class="indfromtxt">Other City</td><td align="center"><input type="text" name="other_city" id="other_city" class="inputtxtcc"/></td>  </tr><tr> <td class="indfromtxt">Your Company Name</td><td align="center"><input type="text" name="company_name" class="inputtxtcc" id="company_name" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onFocus="addToolTip(\'company_name\');"/></td></tr><tr><td class="indfromtxt">Net monthly Income</td><td align="center"><input type="text" name="net_income" id="net_income" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'net_income\');"/></td>  </tr>    <tr>  <td  class="indfromtxt">Age</td><td align="center"><input type="text" name="age" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'age\');"/></td></tr>    <tr> <td class="indfromtxt">Salary Account Bank Name</td><td align="center"><input type="text" name="salary_account" class="inputtxtcc" onFocus="addToolTip(\'salary_account\');" id="salary_account"/></td></tr><tr> <td class="indfromtxt">Since how long you holding this credit card?</td><td align="center"><select name="card_vintage" class="inputtxtcc" id="card_vintage" onFocus="addToolTip(\'card_vintage\');"/><option value="1">Less than 6 months</option><option value="2">6 to 9 months</option> 				<option value="3">9 to 12 months</option>	<option value="4">more than 12 months</option> </select></td></tr></table>';
			}
			else
			{
		putherediv.innerHTML ='<table cellpadding="2" cellspacing="0"  width="100%" style="margin-top:3px;"> <tr> <td class="indfromtxt">Your Company Name</td><td align="center"><input type="text" name="company_name" class="inputtxtcc" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onFocus="addToolTip(\'company_name\');"/></td></tr><tr><td class="indfromtxt">Net monthly Income</td><td align="center"><input type="text" name="net_income" id="net_income" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'net_income\');"/></td>  </tr>    <tr>  <td  class="indfromtxt">Age</td><td align="center"><input type="text" name="age" id="age" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'age\');"/></td></tr>    <tr> <td class="indfromtxt">Salary Account Bank Name</td><td align="center"><input type="text" name="salary_account" class="inputtxtcc" onFocus="addToolTip(\'salary_account\');"/></td></tr><tr> <td class="indfromtxt">Since how long you holding this credit card?</td><td align="center"><select name="card_vintage" class="inputtxtcc" onFocus="addToolTip(\'card_vintage\');"/><option value="1">Less than 6 months</option>				<option value="2">6 to 9 months</option> 				<option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select></td></tr></table>';
		}
		}
}
function addToolTip(statval)
{
	var ni1 = document.getElementById('tooltipContent');
	if(statval=="outstanding_amount_cc")
	{
	ni1.innerHTML = 'Please fill Total Outstanding on Card';
	}
	if(statval=="City")
	{
	ni1.innerHTML = 'Select city';
	}
	if(statval=="company_name")
	{
	ni1.innerHTML = 'Please fill your current Company Name';
	}
	if(statval=="age")
	{
	ni1.innerHTML = 'Fill your Age';
	}
	if(statval=="net_income")
	{
	ni1.innerHTML = 'Please Fill your Net Monthly Income';
	}
	if(statval=="salary_account")
	{
	ni1.innerHTML = 'Please Fill Salary account bank name';
	}
	if(statval=="card_vintage")
	{
	ni1.innerHTML = 'Select how long you holding this card';
	}

	//for pl bt
	if(statval=="existing_bank_pl")
	{
	ni1.innerHTML = 'Your Personal loan running from which bank, specify name';
	}
	if(statval=="existing_la_pl")
	{
	ni1.innerHTML = 'please fill your Existing personal loan amount';
	}
	if(statval=="plbt_income")
	{
	ni1.innerHTML = 'please fill your Net Monthly Income';
	}
	if(statval=="existing_tenure_pl")
	{
	ni1.innerHTML = 'please fill Personal Loan tenure';
	}
	if(statval=="existing_noofemi_pl")
	{
	ni1.innerHTML = 'please fill Number of EMIs paid of personal loan';
	}
	if(statval=="existing_roi_pl")
	{
	ni1.innerHTML = 'please fill Rate Of Insterest on your cureent personal loan';
	}
	if(statval=="plbt_companyname")
	{
	ni1.innerHTML = 'please fill Name of Company you currently working with';
	}
	if(statval=="existing_prepay_pl")
	{
	ni1.innerHTML = 'please fill prepayment on your personal loan';
	}
	//for hl bt
	
	if(statval=="existing_bank_hl")
	{
	ni1.innerHTML = 'Your Home loan running from which bank, specify name';
	}
	if(statval=="existing_la_hl")
	{
	ni1.innerHTML = 'please fill your Existing Home loan amount';
	}
	if(statval=="existing_tenure_hl")
	{
	ni1.innerHTML = 'please fill Home Loan tenure';
	}
	if(statval=="existing_noofemi_hl")
	{
	ni1.innerHTML = 'please fill Number of EMIs paid of Home loan';
	}
	if(statval=="existing_roi_hl")
	{
	ni1.innerHTML = 'please fill Rate Of Insterest on your cureent Home loan';
	}	
}

function fillthefield()
{

}
</script>	
<!--<script type="text/javascript" src="ajax-dynamic-list.js"></script>-->
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
.tool-tip-image{ width:125px; margin-top:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#990000; padding:10px; background:#eeeeee; border-radius:5px; border:#CCC solid 2px; }
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
    </style>
</head>
<form name="save_emiform" action="save-emi-app-continue.php" method="post">
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
<br>
<div style="clear:both;"></div>
<div class="myapp-save_second-wrapper-new">
<div class="myapp-save_second-wrapper">
<div class="box-save-app-left"><img src="images/joint-line.png" width="24" height="210"></div>
<div class="box-save-app1">
<div class="demo">
      <div id="tabInfo">
        Selected tab: <span class="tabName"></span>
   </div>
      <!--vertical Tabs-->
        <div id="verticalTab">
         <ul class="resp-tabs-list">
         <li style=" margin-top:0px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="65%">Credit Card <br>
           Outstanding</td>
    <td width="35%" align="left"><img src="images/credit-card.png"></td>
  </tr>
</table>
</li>
<li>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="65%">Personal Loan  Running</td>
    <td width="35%" align="left"><img src="images/pl-icon-man.png"></td>
  </tr>
</table>
</li>
            <li><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="65%">Home Loan  <br>
           Running</td>
    <td width="35%" align="left"><img src="images/home-loan-icon.png"></td>
  </tr>
</table></li>
           </ul>
            <div class="resp-tabs-container">
                <div><!--cc clause-->
<table cellpadding="2" cellspacing="0"  width="100%" style="margin-top:10px;"><tr> <td class="indfromtxt">Total Outstanding on Card</td><td align="center"><input type="text" name="outstanding_amount_cc" class="inputtxtcc" id="outstanding_amount_cc" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  onFocus="addToolTip('outstanding_amount_cc');" onChange="change2pl();"/></td> </tr>  <tr>
                    <td class="indfromtxt">You Currently live in </td> <td width="53%" align="left"><select name="City" id="City" class="inputtxtcc" style="height:28px; width:233px;" onChange="change2pl();" onFocus="addToolTip('City');">
                            <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
                        </select></td> 
                    </tr><tr><td id="puthere" colspan="2"></td></tr> </table><!--cc clause end here-->
              </div>
                <div><!--PL clause-->
                    <table cellpadding="2" cellspacing="0"  width="100%" style="margin-top:10px;">   
                   <tr>    
                  <td width="47%" class="indfromtxt">Existing Bank</td>  <td width="53%" align="left"><select name="existing_bank_pl" id="existing_bank_pl" class="inputtxt" onFocus="addToolTip('existing_bank_pl');"><option value="Axis">Axis Bank</option><option value="Bajaj">Bajaj Finserv</option><option value="Capital First">Capital First</option><option value="Citibank">Citibank</option><option value="Fullerton">Fullerton India</option><option value="HDFC">HDFC Bank</option><option value="HDBFS">HDB Financial Services</option><option value="HSBC">HSBC Bank</option><option value="ICICI">ICICI Bank</option><option value="IngVysya">IngVysya Bank</option><option value="Kotak">Kotak Bank</option><option value="Indusind">Indusind Bank</option><option value="Standard">Standard Chartered</option><option value="Others">Others</option></select>                  
                  </td> 
                  </tr>
                  <tr><td class="indfromtxt">Existing Loan Amount</td>   <td align="left"><input type="text" name="existing_la_pl" class="inputtxt" onFocus="addToolTip('existing_la_pl');" id="existing_la_pl" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>  
                  </tr>  
                  <tr>
                  <td  class="indfromtxt">Existing ROI</td> <td align="left"><input type="text" name="existing_roi_pl" class="inputtxt" style="width:92px !important;" onFocus="addToolTip('existing_roi_pl');"  id="existing_roi_pl"/> %</td>
                  </tr>   
                   <tr> 	<td class="indfromtxt">No. of EMI Paid</td>  <td align="left"><input type="text" name="existing_noofemi_pl" class="inputtxt" style="width:32px !important;" onFocus="addToolTip('existing_noofemi_pl');" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> (In months)</td>
                   </tr>
                  <tr>  <td class="indfromtxt">Total Tenure</td> <td align="left"><input type="text" name="existing_tenure_pl" class="inputtxt" style="width:45px !important;" onFocus="addToolTip('existing_tenure_pl');" id="existing_tenure_pl" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>  (In years)</td>
                  </tr> 
                    <tr>
                    <td class="indfromtxt">Pre-payment Charges</td> <td align="left"><input type="text" name="existing_prepay_pl" class="inputtxt" style="width:92px !important;" onFocus="addToolTip('existing_prepay_pl');" id="existing_prepay_pl"/> %</td> 
                    </tr>
                    <tr>
                    <td class="indfromtxt">Company Name</td> <td align="left"><input type="text" name="plbt_companyname" class="inputtxt"  onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" onFocus="addToolTip('plbt_companyname');" id="plbt_companyname"/> </td> 
                    </tr>
                    <tr>
                    <td class="indfromtxt">Monthly Net Income</td> <td align="left"><input type="text" name="plbt_income" class="inputtxt"  onFocus="addToolTip('plbt_income');" id="plbt_income" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> </td> 
                    </tr>                                        
                    </table>
					<!--PL clause end-->
                </div>
                <div>
                    <!--HL clause--><table cellpadding="2" cellspacing="0"  width="100%" style="margin-top:10px;">   
                     <tr>   
                     <td width="47%" class="indfromtxt">Existing Bank</td>    <td width="53%" align="left">
                     <select name="existing_bank_hl" id="existing_bank_hl" class="inputtxt" onFocus="addToolTip('existing_bank_hl');"><option value="Axis">Axis Bank</option><option value="Bajaj">Bajaj Finserv</option><option value="Capital First">Capital First</option><option value="Citibank">Citibank</option><option value="Fullerton">Fullerton India</option><option value="HDFC">HDFC Bank</option><option value="HDBFS">HDB Financial Services</option><option value="HSBC">HSBC Bank</option><option value="ICICI">ICICI Bank</option><option value="IngVysya">IngVysya Bank</option><option value="Kotak">Kotak Bank</option><option value="Indusind">Indusind Bank</option><option value="Standard">Standard Chartered</option><option value="Others">Others</option></select>
                   </td>  
                     </tr> 
                      <tr>  <td class="indfromtxt">Existing Loan Amount</td>  <td align="left"><input type="text" name="existing_la_hl" class="inputtxt" onFocus="addToolTip('existing_la_hl');" id="existing_la_hl" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>                                                </tr>
                       <tr> 	
                       <td  class="indfromtxt">Existing ROI</td>   <td align="left"><input type="text" name="existing_roi_hl" class="inputtxt" style="width:92px !important;"  onFocus="addToolTip('existing_roi_hl');" id="existing_roi_hl"/> %</td>      </tr>   
                        <tr>
                        <td class="indfromtxt">No. of EMI Paid</td>    <td align="left"><input type="text" name="existing_noofemi_hl" class="inputtxt" style="width:32px !important;" onFocus="addToolTip('existing_noofemi_hl');" id="existing_noofemi_hl" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> (In months)</td>    
                        </tr>
                        <tr> 
                         <td class="indfromtxt">Total Tenure</td>     <td align="left"><input type="text" name="existing_tenure_hl" class="inputtxt" style="width:45px !important;" onFocus="addToolTip('existing_tenure_hl');" id="existing_tenure_hl" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>  (In years)</td>
                      </tr>
                         <tr> 
                          <td class="indfromtxt">Pre-payment Charges</td>  <td align="left"><input type="text" name="existing_prepay_hl" class="inputtxt" style="width:92px !important;" onFocus="addToolTip('existing_prepay_hl');" id="existing_prepay_hl" /> %</td> 
                      </tr>  
                        </table><!--HL clause-->                       
                </div>
          </div>
   </div>  
</div>
<div style="clear:both;"></div>
</div>
<div class="right-panel-new-app-box1">
<div class="rightall-wrapper"><div class="right-icon-box"><img src="images/graphimage-right.png" width="44" height="48" title="Bar Chart"></div>
<div class="right-icon-box"><img src="images/excel-icon.jpg" width="44" height="49" title="Exzcel File"></div>
<div style="clear:both;"></div>
<div class="tool-tip-image" id="tooltipContent">Please fill the details </div><div class="tool-tiparrow"><img src="images/arrow-icici-app-tool-tip.png" width="53" height="13" /></div>
<div class="character-bx-new"><img src="images/save-my-emi-cartoon-character.png" width="100" height="185"></div>
</div>

<div class="arrow-box-share"><img src="images/share-text-box-img-new.png" width="200" height="280"></div>

</div>
<div style="clear:both;"></div>
<div class="save-my-emi-button-wrapper-new">
<div class="save-my-emi-button">
<input name="image"  value="Submit" type="image" src="images/save-myemi-btn.jpg" width="341" height="82"  style="border:0px;"  />
</div></div>
</div> </div>
<div style="clear:both;"></div>
<div class="button-lining"></div>
<div class="change-textbox">
<img src="images/change-textimg.png" width="983" height="288"> </div>
<div style="clear: both; height:50px;"></div>
<div class="video-box">
<div class="video-box-inn"><img src="images/how.jpg"></div>
</div>
<div class="my-app-buttom"><div class="my-app-buttom-inn buttom-text"><a href="#">ABOUT US</a> | <a href="#">LEGAL TERMS</a> | <a href="#">CONTACT US</a> | <a href="#">ADVERTISING</a> | <a href="#">HELP</a></div> 
</div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
            }
        });
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>
</body>
</html>