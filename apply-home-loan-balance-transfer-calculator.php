<?php
	require 'scripts/session_check.php';
  	require 'scripts/functions.php';
	
if(isset($_REQUEST["srcbnr"]))
	{
		$srcbnr = $_REQUEST["srcbnr"];
	}
	else	
	{
		$srcbnr = "Balance Transfer Calc LP";
	}
	
	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Loan Balance Transfer Calculator</title>
<meta name="description" content="Home Loan Balance Transfer Calculator. Calculate home loan interest rate difference with latest interest rate policy">
 <script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
  <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
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
<style  >
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
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
.orgtext{
	color:#d75b10;
	line-height:16px;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
}

.nrmltxt{
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}

.nrmltxt span{
	font-weight:bold;
	color:#a9643a;
	font-size:12px;

}

.bldtxt{
	font-weight:bold;
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}


#slider{
	width:590px;
	margin:0 0 0 50px;
 }	

#slider ul, #slider li{
	margin:0;
	padding:0;
	list-style:none;
}

#slider li{ 
	/* 
	define width and height of list item (slide)
	entire slider area will adjust according to the parameters provided here
	*/ 
	width:590px;
	height:65px;
	overflow:hidden; 
}
		
	
#slider li div{
	display:block;
	float:left;
	width:143px;
 }

p#controls{
	margin:-76px 0 0 15;
	position:relative;
	width:650px;
} 
	
		
#prevBtn, #nextBtn{ 
	display:block;
	overflow:hidden;
	text-indent:-8000px;		
	width:36px;
	height:80px;
	position:absolute;
}	

														
#prevBtn a, #nextBtn a{  
	display:block;
	width:36px;
	height:84px;
	background: url(new-images/hl/slider/prv-btn.jpg) no-repeat left center;
 
}	

#nextBtn a{ 
	background: url(new-images/hl/slider/nxt-btn.jpg) no-repeat left center;
}

.hinttooltip{
position:absolute;
background-color:#F5FCE1;
width: 175px;
padding: 2px;
border:1px solid #7F9D27;
font:normal 10px Verdana;
color:#404042;
line-height:14px;
z-index:100;
border-right: 3px solid #7F9D27;
border-bottom: 3px solid #7F9D27;
}	
/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:149px;	/* Width of box */
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

											
 </style>
<script>
function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function check_form(Form)
{

var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
//var i;
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if((Form.Name.value=="") || (Trim(Form.Name.value))==false)
	{
		alert("Fill Your Full Name!");
		Form.Name.focus();
		return false;
	}
	  
   
	
	if (Form.Phone.value=="")
	{
		alert("Fill Your Mobile Number!");
		Form.Phone.focus();
		return false;
	}
	 if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
    		alert("Enter numeric value!<");	
	        Form.Phone.focus();
			return false;  
		}
        if (Form.Phone.value.length < 10 )
		{
			document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
			Form.Phone.focus();
			return false;
        }
        if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
			alert("Number starts with 9 or 8 or 7!");
			Form.Phone.focus();
            return false;
        }
	
	if(Form.Email.value=="")
	{
		alert("Enter  Email Address!");	
		Form.Email.focus();
		return false;
	}
	
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		alert("Enter Valid Email Address!");	
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Enter Valid Email Address!");
		Form.Email.focus();
		return false;
	}
	
	 if (Form.City.selectedIndex==0)
	{
		alert("Fill Your City!");	
		Form.City.focus();
		return false;
	}
	
	if(Form.loan_amount.value=="")
	{
		alert("Enter Loan Amount!");
		Form.loan_amount.focus();
		return false;
	}
	if(Form.emi_paid.value=="")
	{
		alert("Enter Pre-Payment Charges!");
		Form.emi_paid.focus();
		return false;
	}
	
	
if(Form.tenure.selectedIndex==0)
	{
		alert("Select Tenure!");
		Form.tenure.focus();
		return false;
	}	
	if(Form.roi.value=="")
	{
		alert("Rate of Interest!");
		Form.roi.focus();
		return false;
	}

	if(Form.pre_payment_charges.value=="")
	{
		alert("Enter Pre-Payment Charges!");
		Form.pre_payment_charges.focus();
		return false;
	}
	
	if (Form.Existing_Bank.value=="")
	{
		document.getElementById('existBankVal').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}	
	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
		
	
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function shw_tooltip()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "<span  class='hinttooltip'>Most Banks/NBFC charge 0% prepayment offers. Please check with your lender.</span>";
}

function shw_tooltipOFF()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "";
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loancalc.City.value;
	
	
	if(cit =="Ahmedabad" || cit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}	


</script>
</head>

<body onbeforeunload="HandleOnClose('closedby_hl.php')">
<table align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr><td height='55' style="padding-left:20px;"><img src='http://www.deal4loans.com/emailer/images/tp_hlbthdr.jpg' height='51' width='500'></td>
			  </tr>
          <tr>
            <td height="250"  valign="top" align="right"><img src="http://www.deal4loans.com/new-images/hlbt_hdrng_.jpg" width="650" height="250" /></td>
          </tr>
          
          <tr>
            <td colspan="4"><table  border="0"   cellpadding="0" cellspacing="0">
            
               
              <tr>
                <td class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
              </tr>
                <tr>
                <td height="25"  style=" padding-left:15px; " ><img src="new-images/hl/why-d4l.gif" width="173" height="21"></td>
              </tr>
              <tr>
                <td height="25"  style="padding-left:20px; " ><table width="623" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #def3f8; ">
                  <tr>
                    <td width="582" ><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Over 20 lakh customers have taken quote at Deal4loans.com</div></td>
                      </tr>
                      <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Home Loan Balance Transfer Quotes are free for customers.</div></td>
                      </tr>
                      <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Deal4loans.com has tie ups with all Home loan Banks in India.</div></td>
                      </tr>
                      <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Your contact details will not be shared with any Bank, Unless you give your consent.</div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td   >&nbsp;</td>
              </tr>
             
            </table></td>
            </tr>
        </table></td>
        <td width="34%" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="289" height="88" align="left" valign="top"><img src="http://www.deal4loans.com/new-images/hl/frm-bthdng.gif" width="307" height="88" /></td>
              </tr>
              <tr>
                <td valign="top" style="border-left:1px solid #c2c2c2; border-right:1px solid #c2c2c2; padding-top:15px;">
				<form name="loancalc" id="loancalc" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);" method="post">
				
                            <table width="94%" border="0" align="right" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="121" height="26" align="left" valign="middle" class="bldtxt">First Name</td>
                                <td width="154" class="bldtxt">
							          <input type="hidden" name="source" value="<? echo $srcbnr; ?>">
                                  			<input type="text" name="Name" id="Name" style="width:140px;" tabindex="1"></td>
                              </tr>
                              <tr>
                                <td width="121" height="26" align="left" valign="middle" class="bldtxt">Mobile</td>
                                <td class="nrmltxt"><font class="style4">+91</font>
                                    <input type="text"  style="width:113px;" maxlength="10"  name="Phone" id="Phone"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip(); " tabindex="2">                                </td>
                              </tr>
                             <tr>
		  <td colspan="2"><div id="myDiv" style="color:#7d0606; font-family:Verdana; font-size:11px;"></div></td>
		  </tr>
                              <tr>
                                <td height="26" align="left" valign="middle" class="bldtxt">Email</td>
                                <td class="nrmltxt"><input class="style4" style="width:140px;" name="Email" id="Email"onBlur="onBlurDefault(this,'Email Id');"  onFocus="removetooltip();"  tabindex="3">                                </td>
                              </tr>
                              <tr>
                                <td height="30" align="left" valign="middle" class="bldtxt">City</td>
                                <td class="style4"><select size="1" align="left" style="width:140"  name="City" id="City" onChange="addhdfclife();"  tabindex="4"/>
                                
                                    <?=getCityList1($City)?>
                                    </select></td>
                              </tr>
                              <tr>
                                <td height="35" align="left" valign="middle" class="bldtxt">Total Home Loan Borrowed </td>
                                <td class="nrmltxt"><input name="loan_amount" id="loan_amount" style="width: 140px;"  type="text" tabindex="5">                                </td>
                              </tr>
                              <tr>
                                <td width="121" height="30" align="left" valign="middle" class="bldtxt">No. of EMI Paid </td>
                                <td class="bldtxt"><input   type="text" name="emi_paid" onFocus="this.select();" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" style="width:80px;" tabindex="6">  <span align="center" style="font-weight:normal;">(in Months)</span>                               </td>
                              </tr>
                                                            <tr>
                                <td height="35" align="left" valign="middle" class="bldtxt">Tenure of Home Loan</td>
                                <td class="bldtxt"> <select name="tenure" id="tenure" style="width:80px; font-family:Verdana, Geneva, sans-serif; font-size:11px; " tabindex="7"><option value="">Select</option>
                         <?php 
		   for($i=5;$i<=25;$i++)
		   {
		   		$selected = "";
				if($i==$Duration_of_Loan)
				{
					$selected = "selected";
				}	
		   		echo "<option value='".$i."' ".$selected." >".$i."</option>";
		   }
		   ?>
                       </select> <span align="center" style="font-weight:normal;">(in Years)</span>                                                                    </td>
                              </tr>
                              <tr>
							     <td height="35" align="left" valign="middle" class="bldtxt" style="color:#4b4b4b;">Present Rate Of Interest</td>
                                <td class="nrmltxt"><input type="text" name="roi" id="roi"  style="width:140px;" tabindex="8" /></td>
                              </tr> 
							  <tr>
                                <td width="121" height="35" align="left" valign="middle" class="bldtxt"  style="color:#4b4b4b;">Name of Existing Bank </td>
                                <td width="154" class="nrmltxt">
							    <input type="text" name="Existing_Bank"  id="Existing_Bank" style="width:140px;"  onkeyup="ajax_showOptions(this,'getCountriesByLetters',event);" tabindex="9" /></td>
                              </tr>
							 
							 <tr>
                                <td width="121" height="35" align="left" valign="middle" class="bldtxt" style="color:#4b4b4b;">Pre Payment Charges</td>
                                <td class="bldtxt" style="color:#4b4b4b;">
                                  <input type="text" name="pre_payment_charges" id="pre_payment_charges" style="width:140px;" onKeyDown="intOnly(this);" onKeyUp="intOnly(this);" tabindex="10"  onFocus="shw_tooltip();" onBlur="shw_tooltipOFF();"/>
                              	  <div id="shw_tultip"></div></td>
                              </tr>
					    <tr>
	   <td  colspan="2" align="left" style="padding:5px;"> <div id="hdfclife"></div></td>
		 </tr>
						
							 <tr>  <td height="35" colspan="2" align="left" valign="middle" class="nrmltxt">
								
								<input type="checkbox" name="accept" style="border:none;" checked> 
I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank" style="text-decoration:none; ">Privacy Policy</a> and agree to the <a href="http://www.deal4loans.com/Privacy.php"  style="text-decoration:none; ">Terms And Condition</a>.</td>
                              </tr>
                              <tr>
                                <td height="54" colspan="2" align="center" valign="middle"><input type="image" name="Submit"  src="new-images/hl/calc_savbt.gif"  style="width:160px; height:29px; border:none; " /></td>
                              </tr>
                          </table>
</form></td>
              </tr>
              <tr>
                <td valign="top"><img src="images/cl/frm-btm.gif" width="307"   height="21"></td>
              </tr>
              <tr>
                <td height="10" ></td>
              </tr>
             
            </table></td>
            <td width="33" height="336" align="right" valign="top"><img src="new-images/hl/frm-rgt.gif" width="33" height="310" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <Tr>
  <td>&nbsp;</td>
  </Tr>
</table>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
