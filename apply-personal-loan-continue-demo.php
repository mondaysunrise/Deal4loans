<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="PL Site Page";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 
<title>Apply for Personal Loan | Personal Loans Online Apply India |Deal4Loans</title>
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans banks like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad.">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <link href="css/slider.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
 <script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script language="javascript">
$(function() {
	$("#IncomeAmount").focusout(function(){
			if($("#IncomeAmount").val()<=50000){

		var ai=$("#IncomeAmount").val();
	var mai= Math.round(ai/12);
		    $( "#dialog-modal" ).dialog({
			title:"You Have Indicated Your Annual Income Is 'Rs. " + ai + "' which is 'Rs." + mai + "' per month. If correct Continue or Edit Annual Income to get Right Quote",
            height: 0,
            modal: true
        });
			//$("#IncomeAmount").val().focus();
		}
		});
    });



function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function othercity1(){	if(document.personalloan_form.City.value=='Others')		document.personalloan_form.City_Other.disabled=false;	else		document.personalloan_form.City_Other.disabled=true; }
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param) {	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false; }
function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	if((document.personalloan_form.Name.value=="") || (Trim(document.personalloan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.personalloan_form.Name.focus();
		return false;
	}
	if(document.personalloan_form.Name.value!="")
	{
		if(containsdigit(document.personalloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.personalloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.personalloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.personalloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.personalloan_form.Name.focus();
			return false;
		}
  }
	if(document.personalloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.personalloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.personalloan_form.Phone.value)|| document.personalloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.personalloan_form.Phone.focus();
		return false;  
	}
	if (document.personalloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
	if ((document.personalloan_form.Phone.value.charAt(0)!="9") && (document.personalloan_form.Phone.value.charAt(0)!="8") && (document.personalloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
if(document.personalloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	
	var str=document.personalloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
		
	if (document.personalloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.personalloan_form.City.focus();
		return false;
	}

	if (document.personalloan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.personalloan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.personalloan_form.IncomeAmount, 'Annual Income',0))
		return false;

	if (document.personalloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.personalloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.personalloan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	if(!document.personalloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	

		document.personalloan_form.accept.focus();
		return false;
	}	
}  

function addIdentified()
{
		var ni1 = document.getElementById('myDiv1');
	    ni1.innerHTML = '<div style=" float:left; width:183px; height:47px;  margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Card held since?</div>    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select size="1" name="Card_Vintage" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div id="vintageVal"></div></div>';
					
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	var ni2 = document.getElementById('myDiv2');		
	ni1.innerHTML = '';
	ni2.innerHTML = '';
			
		return true;

}	

function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}



 function addibibo()
{
	var ni1 = document.getElementById('getibibo');
	var cit = document.personalloan_form.City.value;
	//alert(cit);	
	ni1.innerHTML = '';
	if(cit!="Please Select")
	{
		//alert("ranjana");
		ni1.innerHTML = ' <table  style="border:1px solid #999999; padding:2px;"> <tr> <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> <u>Special offer for Deal4loans customers</u></td>		 </tr>	  <tr>	 <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal;"> Take  a Free Test  Drive for New Maruti  and <b>Win a Branded Laptop</b></td> </tr>	 <tr> <td style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" style="border:none;" value="Estillo"/> Estillo <input type="radio" style="border:none;" value="WagonR" name="Ibibo_compaign" id="Ibibo_compaign"/> WagonR <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" value="A-Star" style="border:none;"/> A-Star</td>	 </tr>	</table>	';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.personalloan_form.City.value;
	//var otrcit = document.personalloan_form.City_Other.value;
		ni1.innerHTML = '';
	//alert(cit);	
	if(cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px; width:706px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

  </script>
  
</head>

<body >
<!--top-->

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->

<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div class="intrl_txt" style="margin:auto;">
<div style=" float:right; width:663px; height:auto; margin-top:5px; text-align:justify;"><table align="center" border="0" width="660"><tr><td align="center"><table width="90%" cellpadding="2" cellspacing="0" bgcolor="#EDF8FC" style="border:1px solid #ADE4F8;"><tr><td width="22%" rowspan="2" style="color:#FF6600; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;" align="right"><b>Festive Offer :</b></td><td width="78%" align="center" style="color:#4E4D4D; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;"><b>Get gifts upto Rs 12500 on disbursal.</b></td></tr><tr><td align="center" style="color:#4E4D4D; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;">Refer to T & C - www.deal4loans.com/personal-loan-offers.php 
</td></tr></table></td></tr></table></div>
<div style="clear:both; height:1px;"></div>

<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <tr>
        <td height="55" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><div class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong>Apply Personal Loan</strong></div></td>
            <td width="196" rowspan="2" valign="top">&nbsp;</td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td><span class="text3" style="float:left; width:575px; font-size:24px; color:#FFF; text-transform:none; margin-top:11px"><img src="images/animated_pl.gif"  /></span></td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F">
        <form name="personalloan_form"  action="insert_personal_loanstage1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
		<input type="hidden" name="Type_Loan" value="Req_Loan_Personal" />
        <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
  <table width="660" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="660" align="left" valign="top" ><table width="661" border="0" cellspacing="0" cellpadding="0">
     
   
      <tr>
        <td align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="28" align="left" valign="top">&nbsp;</td>
            <td width="178" align="left" valign="top"><table width="186" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="186" height="50" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                     <input name="Name" id="Name" type="text" style="width:180px; height:15px;" onkeydown="validateDiv('nameVal');" tabindex="1"/>
   <div id="nameVal"></div>   
                    </div>
                </div></td>
              </tr>
            
              <tr>
                <td height="50"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:2px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                      <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div>
                    <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; ">
                    <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:153px; height:15px;" onkeydown="validateDiv('phoneVal');"  tabindex="2" />
            <div id="phoneVal"></div>   
                      </div>
                  </div>
                </div></td>
              </tr>
            </table></td>
            <td width="36" align="left" valign="top">&nbsp;</td>
            <td width="183" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
               <tr>
                <td height="50"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                      <input name="Email" id="Email" type="text" style="width:180px; height:15px;" onkeydown="validateDiv('emailVal');" tabindex="3"  />
          <div id="emailVal"></div>   
                    </div>
                </div></td>
              </tr>
              <tr>
                <td width="183" height="50" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:2px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                                      <select name="City" id="City" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="addhdfclife(); validateDiv('cityVal');" tabindex="4">
                            <?=plgetCityList($City)?>
                        </select>
                         <div id="cityVal"></div>   
                    </div>
                </div></td>
              </tr>
         
            </table></td>
            <td width="33" align="left" valign="top">&nbsp;</td>
            <td width="203" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income: </div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                <input type="text" name="IncomeAmount" id="IncomeAmount" style="width:180px; height:15px;"  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount');" onkeydown="validateDiv('netSalaryVal');" tabindex="5"  />
              <div id="dialog-modal" > </div>
        <div id="netSalaryVal"></div>   
                  </div>
                </div>
                  <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>
                </td>
              </tr>
            
            </table></td>
            <td width="33" align="left" valign="top">&nbsp;</td>
            <td width="203" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:2px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                 <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:180px; height:15px;" onkeydown="validateDiv('loanAmtVal');" tabindex="6" />
     <div id="loanAmtVal"></div>
                  </div>
                </div><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>
                </td></tr></table></td>
          </tr>
          <tr>
            <td height="52" align="left" valign="top">&nbsp;</td>
            <td colspan="7" align="left" valign="top"><table width="884" border="0" cellspacing="0" cellpadding="0">
              <tr>
              
                <td width="754" align="left" valign="top"><div class="text" style=" float:left; width:750px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                  
                  <div class="text" style=" float:left; width:750px; height:auto; color:#FFF; font-size:11px; text-transform:none; clear:right; margin-top:0px; ">  <input name="accept" type="checkbox" checked="checked" tabindex="7" />  
                  I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
                  <div id="acceptVal"></div></div>
                </div></td>
                <td width="130" align="left" valign="top"><div style=" float:left; width:114px; height:47px; margin-top:0px; clear:right; margin-left:0px;">
                 <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value="" tabindex="8" />
             </div></td>
              </tr>
              <tr>
              
                <td align="left" valign="top" colspan="2">
                <div id="hdfclife"></div>
                </td></tr>
            </table></td>
           
            </tr>
        </table></td>
      </tr>
      
    </table></td>
  </tr>
</table>
</form>
</td>
      </tr>
      <tr>
        <td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<div style=" float:left; width:940px; height:auto; margin-top:15px;  margin-left:20px; text-align:justify;">
  <span class="text11" style="color:#88a943; font-size:17px; font-weight:bold;">Quotes available from following Banks - Maximum Personal loan Bank Tie ups in online space<br />
<br />
</span></div>
<br />
<table width="864" border="0" align="center" cellpadding="0" cellspacing="0"  style="border: 1px solid #ececec; ">
  
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
  list($rowscount,$myrow)=MainselectfuncNew($selectplbanks,$array = array());
	  ?>
       <?
		 if($rowscount>0)
		 {
		 	$i=0;
		for($ii=0;$ii<$rowscount;$ii++)
		 {?>
   <td valign="top"  >
    <table width="147" border="0" align="center" cellpadding="0" cellspacing="0"  >
      <tr>
        <td height="48" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:16px;"><strong><? echo $myrow[$ii]["pl_bank_name"];?></strong></strong></td></tr>
  <tr>
        <td width="147" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$ii]["pl_bank_roi"];?>
        </strong></td></tr>
  <tr>
        <td width="147" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$ii]["pl_bank_processing_fee"];?>
        </strong></td></tr>
          <tr>
        <td width="147" height="53" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$ii]["pl_bank_loan_amt"];?>
        </strong></td></tr>
          <tr>
        <td width="147" height="90" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$ii]["pl_bank_prepayment"];?>
        </strong></td></tr>
          <tr>
        <td width="147" height="70" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$ii]["pl_bank_disbursal_time"];?>
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

<div style="clear:both; height:15px;"></div>
<div style="clear:both; height:20px; width:964px; margin:auto; margin-top:10px; padding-bottom:15px;">
<table width="962" cellpadding="0" cellspacing="0">
<tr><td>
<span class="text11" style="color:#4c4c4c; ">
<b>Tips for Best Personal loan deal</b><br>
1) Compare exact Emi|Processing fee |Tenure|Documents before choosing bank|<br>
2) Never pay any fee to any person to get loan sanctioned.Processing fee are deducted from Loan amount.<br>
3) Only give documents to one bank and check whether he is authorized Bank employee or vendor.
</span></td><td>
<a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></td></tr></table></div>
<!--partners-->
<div class="text" style="margin:auto; width:962px; height:auto; margin-top:35px; color:#8dae48;">Loan Partners</div>
<div style="margin:auto; width:949px; height:90px;; margin-top:20px;">
<div class="sldrpnl" style="height:70px; margin-left: 1px; width: 940px; float: left; !important">
<table cellpadding="0" cellspacing="0">
<tr><td>
<div style="display:block; 	float:left;	width:155px;"><img  src="/new-images/thumb/fullrton.jpg" alt="Fullerton" width="146" height="56"  style="border:none;" /></div>
</td><td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/slider/thumb/hdfc_pllogo.jpg" alt="HDFC Bank" width="146" height="56"  style="border:none;"/></div></td>
<td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/thumb/bajaj-finserv1.jpg" alt="Bajaj Finserv" width="146" height="56"  style="border:none;"/></div></td>
<td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/thumb/hdb-logo.jpg" alt="HDB Financial Services" width="146" height="56"  style="border:none;"/></div></td>
<td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/thumb/icici.jpg" width="146" height="56" style="border:none;" alt="ICICI Bank"/></div></td>
<td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/thumb/ingv.gif" alt="ING Vysya" width="146" height="56"  style="border:none;"/></div></td>
</tr></table>
         

</div>
</div>
</div>
<!--partners-->
<?php include "footer1.php"; ?>

</body>
</html>
