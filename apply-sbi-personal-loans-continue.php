<?php
	
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
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
</style>

<script type="text/javascript">
window.addEvent('domready', function(){
var accordion = new Accordion('h3.atStart', 'div.atStart', {
opacity: false,
onActive: function(toggler, element){
toggler.setStyle('color', '#330101');
},

onBackground: function(toggler, element){
toggler.setStyle('color', '#330101');
}
}, $('accordion'));

//This is for default selected optio		
var newTog = new Element('h3', {'class': 'toggler1'}).setHTML('');

var newEl = new Element('div', {'class': 'element1'}).setHTML('');

accordion.addSection(newTog, newEl, 0);
}); 

//
</script>
<Script Language="JavaScript" Type="text/javascript">

function addDiv()
{
		var ni = document.getElementById('mynewDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div id="expanddiv" class="expandeddiv" ></div>';
				

			}
		}
		
		return true;

	}
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}


function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}

function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			
				ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="240"  height="20" align="left" class="bldtxt">Any type of loan(s) running? </td><td colspan="3" align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left">&nbsp;</td></tr><tr> <td  width="71" height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td width="93" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td width="160" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table></td></tr><tr><td align="left" height="30" class="bldtxt">How many EMI paid?  </td> <td colspan="3"  align="left" width="324"><select name="EMI_Paid" style="width:203px;"  > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr></table>';
			
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}

	function submitform(Form)
	{

var btn2;
	var btn3;
	var myOption;
	var i;
	
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
	
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;

	}	
	if(!checkNum(Form.Years_In_Company, 'No of years in current company',0))
		return false;

	if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(Form.Total_Experience, 'Total Experience',0))
		return false;

	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}

				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
			return false;
		}
		
return true;
}
function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.Loan_Any.length; i++) 
	{
        if(document.personalloan_form.Loan_Any[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}
function addElement()
{
	
		var ni = document.getElementById('myDiv');
		 var newdiv = document.createElement('div');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0"><tr><td height="25">Reconfirm Mobile No.</td>	<td width="158" ><input size="18" type="text"  maxlength="10"  name="RePhone" id="RePhone"></td></tr></table>';
			
			ni.appendChild(newdiv);
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
		}

		
/*********************************************************************************************************/
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function getstatementlink()
		{
			var primary_acc=document.getElementById('Primary_Acc').value;		
			//alert(primary_acc);
			//if((document.getElementById('Primary_Acc').value>0))
			//{
				var queryString = "?primary_acc=" + primary_acc;
		//alert(queryString); 
				ajaxRequest.open("GET", "get_statement_link.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{				
						// alert(ajaxRequest.responseText);
						var ajaxDisplay = document.getElementById('myDivstatement');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 //}
			
		}
		
		
		
	window.onload = ajaxFunction;
	/*********************************************************************************************************/
</script>

</head>

<body>
<div id="logo_sml">
	<img src="/new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
<table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>               
       <td align="center" valign="middle" style="color: #643E02; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; ">60% of your application for quote from all Banks is complete.</td>            
      </tr>
	  <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	  
      <tr>               
       <td align="center" valign="middle" ><img src="new-images/hl/ajax-loader.gif" width="220" height="19" /></td>            
      </tr>
	   <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	  <tr>               
       <td align="center" valign="middle" style="color: #136071; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; ">Share few more details to get exact quote on Emi,Rates & Loan Amount.
</td>            
      </tr>
    </table></td>
  </tr>
<tr>
    <td valign="top" style="padding-top:8px; "><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
   
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="21" height="21" align="left" valign="top"><img src="new-images/pl/lft-tp-curv.gif" width="21" height="21" /></td>
    <td style="border-top:1px solid #d4d4d4 ">&nbsp;</td>
    <td width="21" height="21" align="right" valign="top"><img src="new-images/pl/rgt-tp-curv.gif" width="21" height="21" /></td>
  </tr>
  <tr>
    <td  style="border-left:1px solid #d4d4d4 ">&nbsp;</td>
    <td><form name="personalloan_form"  action="insert_personal_loan_value_step2.php" method="POST" onsubmit="return submitform(document.personalloan_form); ">
	<input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
            
            <tr align="center" bgcolor="#f4f4f4">
              <td height="35" colspan="2" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; "> Personal Loan Quote Request</td>
              </tr>
            <tr>
              <td height="10" colspan="2" ></td>
              </tr>
            <tr>
              <td width="234" height="35" align="left" class="bldtxt">Primary Account 
                in which bank?</td>
              <td width="313" height="20"  align="left"><input type="text" style="width:200px;" name="Primary_Acc" id="Primary_Acc" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="getstatementlink();" onclick="getstatementlink();"></td>
            </tr>
            <tr>
              <td height="20" align="left" class="bldtxt">Residential Status </td>
              <td  align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="6%" ><input type="radio" style="border:none;" value="1" name="Residential_Status"  checked="checked" /></td>
                    <td width="19%" >                        Owned</td>
                    <td width="6%" ><input type="radio" style="border:none;" value="2" name="Residential_Status" /></td>
                    <td width="19%" >                        Rented</td>
                    <td width="6%" ><input type="radio" style="border:none;" value="3" name="Residential_Status" /></td>
                    <td width="44%" > Company Provided</td>
                  </tr>
              </table></td>
            </tr>
			<tr align="left">
                <td height="35" class="bldtxt">Company Type</td>
          <td class="frmtxt"><select name="Company_Type" id="Company_Type" style="width: 203px;">
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			 <option value="4">Govt.( Central/State )</option>
		<option value="5">PSU (Public sector Undertaking)</option>
			</select></td>
        </tr>  
            <tr>
              <td height="35" align="left" class="bldtxt" >No. of years in  
                this Company</td>
              <td align="left" ><input type="text" name="Years_In_Company" style="width:200px;" maxlength="15"></td>
            </tr>
            <tr>
              <td height="42" align="left" class="bldtxt" >Total Experience (Years)/
                Total Years  
                in Business</td>
              <td align="left" ><input style="width:200px;"  name="Total_Experience" onfocus="this.select();">              </td>
            </tr>
            <tr>
              <td colspan="2"><input type="hidden" value="PersonalLoan" name="type" /></td>
            </tr>
            <? if ($_SESSION['Temp_CC_Holder']==1 || $_SERVER['Temp_CC_Holder']==1)
			{?>
            <tr>
              <td height="30" align="left" class="bldtxt" >Credit Card Limit?</td>
              <td align="left" ><input style="width:200px;" name="Credit_Limit" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onfocus="this.select();">              </td>

            </tr>
            <? } ?>
            <tr>
              <td height="30" align="left" class="bldtxt" >Any Loan running?</td>
              <td align="left" ><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" /> Yes &nbsp;  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0"> No</td>
            </tr>
            <tr>
              <td colspan="2" id="myDivLoan"></td>
            </tr>
            <? 
				//if(($_SESSION['Temp_Net_Salary']<=200000) || ($Net_Salary<=200000))
				//{?>
            <!--<tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">


						 	<tr>
					<td align="left"  width="149" height="30">Mobile Connection?</td>
					<td width="155" colspan="3" align="left"><input type="radio" style="border:none;"  value="1"  name="Mobile_Connection"  >					  Yes <input size="10" type="radio" style="border:none; margin-left:25px;" name="Mobile_Connection"  id="Mobile_Connection" value="2" > No</td>
				</tr>
					<tr>

					<td align="left"  width="149" height="35">Do you have landline at your Residence?</td>
					<td align="left"  height="35" colspan="3"><input type="radio" style="border:none;"  value="1"  name="Landline_Connection" >  Prepaid <input size="10" type="radio" style="border:none;" name="Landline_Connection"   value="2" > Postpaid</td>
				</tr>
				<tr>
					<td  width="149" rowspan="2" align="left"> Salary Drawn?</td>

				  <td height="30"  colspan="3" align="left" valign="bottom"><input type="radio" style="border:none;"  value="1"  name="Salary_Drawn" > Cash <input size="10" type="radio" style="border:none; margin-left:20px;" name="Salary_Drawn"   value="3" > Cheque </td>
				</tr>
				<tr>
				  <td colspan="3" align="left" valign="top">
					<input size="10" type="radio" style="border:none;" name="Salary_Drawn"   value="2" >
				  Account Transfer</td>
			    </tr>
</table>
<? //}?></td>
  </tr> -->
            <!--<tr>
              <td height="35" colspan="2" align="left" style="font-weight:normal; line-height:17px;"><div class="bldtxt" >Documentation Wizard-</div>
                Please share which of the following documents that you have or can arrange , so that we can let you know what more documents are required by each bank.This will help you to choose your Personal Loan Provider better.</td>
              </tr>
           <tr>
              <td height="25" colspan="2"  align="left" class="bldtxt">Which of the following Documents you Have?</td>
            <tr>
              <td colspan="2"> 
              
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="4%" height="20" align="center" valign="middle"><input type="checkbox" value="Appointment Letter" name="Document_proof[]" id="Document_proof" style="border:none;"/></td>
                            <td width="38%" align="left">Appointment Letter </td>
                            <td width="4%" align="center" valign="middle"><input type="checkbox" value="Form16" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td width="54%" align="left">Form -16</td>
                          </tr>
                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Latest 3 months salary slip" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Latest 3 months Salary Slip</td>
							<td width="4%" align="center" valign="middle"><input type="checkbox" value="6 months bank statement" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
							<td align="left">6 months Bank Statement</td>
                          </tr>-->
                       
                        
                        
                          <!--<tr>
                            <td width="4%" height="20" align="center" valign="middle"><input type="checkbox" value="Pancard" name="Document_proof[]" id="Document_proof"style="border:none;" /></td>
                            <td width="38%" align="left">Pan Card </td>
                            <td width="4%" align="center" valign="middle"><input type="checkbox" value="Voterid" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td width="54%" align="left">Voter Id </td>
                          </tr>

                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Passport" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Passport</td>
                            <td align="center" valign="middle"><input type="checkbox" value="Driving License" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Driving License </td>
                          </tr>
                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="photo" name="identification_proof[]" id="identification_proof"  style="border:none;"/></td>
                            <td align="left">Passport size photo </td>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="LIC Policy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">LIC Policy 
                       
                          
                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Telephone Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Telphone Bill </td>
                            <td align="center" valign="middle"><input type="checkbox" value="Electricity Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Electricity Bill </td>
                          </tr>
						  <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Loan Track" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Loan Track </td>
                            <td align="center" valign="middle"><input type="checkbox" value="Credit Card photocopy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Credit Card photocopy</td>
                          </tr>
						
                        </table>
                     
                  </td>
            </tr>-->
			
            <tr>
              <td  colspan="2" align="left"  >&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="2" align="center"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></td>
            </tr>
          </table>
		  </form></td>
    <td  style="border-right:1px solid #d4d4d4 ">&nbsp;</td>
  </tr>
  <tr>
    <td width="21" height="21"><img src="new-images/pl/lft-btm-crv.gif" width="21" height="21" /></td>
    <td  style="border-bottom:1px solid #d4d4d4 ">&nbsp;</td>
    <td width="21" height="21"><img src="new-images/pl/rgt-btm-curv.gif" width="21" height="21" /></td>
  </tr>
  
</table>

</td>
      
              
             
      </tr>
    </table></td>
  </tr>
  <tr>
              <td  colspan="2" align="left"  >&nbsp;</td>
            </tr>
</table>

<!-- Google Code for SBI Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "666666";
var google_conversion_label = "ZYYhCPG8PxCHz7f8Aw";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=ZYYhCPG8PxCHz7f8Aw&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>
