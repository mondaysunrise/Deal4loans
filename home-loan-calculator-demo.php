<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	require 'scripts/home_loan_eligibility_function.php';
	session_start();
function DetermineAgeFromDOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;  if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }
$maxage=date('Y')-62;
$minage=date('Y')-18;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Net_Salary = $_POST['Net_Salary'];
	$getnetAmount = ($Net_Salary /12);
	$loan_amount = $_POST['Loan_Amount'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dateofbirth = $year."-".$month."-".$day;
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	$total_obligation = $_POST['total_obligation'];
	$netAmount=($getnetAmount - $total_obligation);
	$strCity = "Delhi";
	$property_value = $_POST['Property_Value'];
	$_SESSION['property_value'] = $property_value;
	$_SESSION['loan_amount'] = $loan_amount;
	$_SESSION['Net_Salary'] = $Net_Salary;
	$_SESSION['day'] = $day;
	$_SESSION['month'] = $month;
	$_SESSION['year'] = $year;
	$_SESSION['total_obligation'] = $total_obligation;
}
function money_F($number)
{
	setlocale(LC_ALL, 'en_IN');
 	$strnumber=money_format('%i', $number);
	list($First_num,$Last_num) = split('[ ]', $strnumber);
	$money_strnum = substr(trim($Last_num), 0, strlen(trim($Last_num))-3);
	$getmoney_term[]= $money_strnum;
	return($getmoney_term);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Home Loan Eligibility Calculator: Calculate Home Loan Eligibility</title>
<meta name="keywords" content="home loan calculator, home loan eligibility calculator, Home loan calculator India, housing loan eligibility, housing loan eligibility calculator, housing loan eligibility India"> 
<meta name="Description" content="Home Loan Eligibility Calculator: Calculate Eligibility to Know your eligible loan amount, per month EMI & Tenures and Banks for your housing loan."> 
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
 <script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script language="javascript">
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function cityother() {	if(document.loan_form.City.value=="Others")	{		document.loan_form.City_Other.disabled = false;	}	else	{		document.loan_form.City_Other.disabled = true;	}} 
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param) {	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";				document.loan_form.Name.focus();		return false;	}

	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";			document.loan_form.Name.focus();			return false;		}
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";			document.loan_form.Name.focus();			return false;		}
  }
	
	if(document.loan_form.Phone.value=="")
	{		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";		document.loan_form.Phone.focus();		return false;	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";		document.loan_form.Phone.focus();		return false;  	}
	if (document.loan_form.Phone.value.length < 10 )
	{	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";			document.loan_form.Phone.focus();		return false;	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";			document.loan_form.Phone.focus();		return false;	}
	if(document.loan_form.Email.value=="")
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	if (document.loan_form.City.selectedIndex==0)
	{		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";			document.loan_form.City.focus();		return false;	}
	if (document.loan_form.Net_Salary.value=="")	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";			document.loan_form.Net_Salary.focus();		return false;	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;
	if (document.loan_form.Loan_Amount.value=="")
	{		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";			document.loan_form.Loan_Amount.focus();		return false;	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	if(!document.loan_form.accept.checked)
	
	{		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";				document.loan_form.accept.focus();		return false;	}	
}  

function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{				eval(document.getElementById("divfaq"+j)).style.display=''			}
			else			{				eval(document.getElementById("divfaq"+j)).style.display='none'			}
		}
			
	}
}

function validateDiv(div) {	var ni1 = document.getElementById(div); 	ni1.innerHTML = ''; }
function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
	ni1.innerHTML = '';
	if(cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}
</script>
</head>
<body>
<?php include "top-menu.php";  include "main-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span  class="text12" style="color:#4c4c4c;">Home Loan Eligibility Calculator </span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
<form name="loan_form" method="post" action="home-loanscontinue.php" onSubmit="return chkform();">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
<tr><td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td></tr>
<tr><td height="35" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0"><tr><td width="24"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td><td width="735"><h1 class="text3" style=" color:#FFF; font-size:24px; text-transform:none; ">Home Loan Eligibility Calculator</h1></td><td width="196" rowspan="2" valign="top"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td></tr></table></td></tr>
<tr>
<td  align="center" valign="top" bgcolor="#21405F"><table width="955" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="28" align="left" valign="top">&nbsp;</td>
            <td width="178" align="left" valign="top"><table width="186" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="186" height="50" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                     <input name="Name" id="Name" type="text" style="width:180px; height:15px;" onkeydown="validateDiv('nameVal');" />
   <div id="nameVal"></div>   
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="50"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                      <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div>
                    <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; ">
                    <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:153px; height:15px;" onkeydown="validateDiv('phoneVal');"  />
            <div id="phoneVal"></div>   
                      </div>
                  </div>
                </div></td>
              </tr>
                 </table></td>
            <td width="36" align="left" valign="top">&nbsp;</td>
            <td width="183" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
                  <tr>                <td height="50"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                      <input name="Email" id="Email" type="text" style="width:180px; height:15px;" onkeydown="validateDiv('emailVal');"  />          <div id="emailVal"></div>                       </div>                </div></td>              </tr>
              <tr>                <td width="183" height="50" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                                      <select name="City" id="City" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange=" addhdfclife(); cityother(); validateDiv('cityVal');" tabindex="7">                            <?=getCityList($City)?>                        </select>                         <div id="cityVal"></div>                       </div>                </div></td>              </tr>
               </table></td>
            <td width="33" align="left" valign="top">&nbsp;</td>
            <td width="203" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
              <tr>                <td width="183" height="50" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income: </div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                  <input type="text" name="Net_Salary" id="Net_Salary" style="width:180px; height:15px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"  /><div id="netSalaryVal"></div>                  </div>                </div><span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>              </tr>
    </table></td> 
            <td width="203" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
                           <tr>                <td height="50"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                 <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:180px; height:15px;" onkeydown="validateDiv('loanAmtVal');" />     <div id="loanAmtVal"></div>                  </div>                </div><span id='formatedlA' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>              </tr>
           </table></td> 
           
                    </tr>
          <tr>            <td height="52" align="left" valign="top">&nbsp;</td>            <td colspan="6" align="left" valign="top">      <table width="920" border="0" cellspacing="0" cellpadding="0">
              <tr> <td width="366" align="left" valign="top"><div class="text" style=" float:left; width:320px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                    <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; ">                    <input name="accept" type="checkbox" /><div id="acceptVal"></div>                    </div>                  <div class="text" style=" float:left; width:280px; height:auto; color:#FFF; font-size:11px; text-transform:none; clear:right; margin-top:7px; "> I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.</div>                </div></td>                <td width="114" align="left" valign="top"><div style=" float:left; width:114px; height:47px; margin-top:0px; clear:right; margin-left:0px;"><input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td>              </tr>
              <tr><td width="366" align="left" valign="top" colspan="2">                <div id="hdfclife"></div>                </td></tr>            </table>                      </td>            </tr>
        </table></td></tr>
<tr><td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td></tr>
</table></td></tr>
</table>
</form>
</div>
<div style=" float:left; width:940px; height:auto; margin-top:5px; margin-left:10px; text-align:justify;">
<table cellpadding="0" cellspacing="0" border="0" class="font2"><tr><td valign="top" style="padding:3px;"> Following are eligible to 
<a href="http://www.deal4loans.com/apply-home-loans.php">apply for a Home Loan</a> :<br> 
•	Salaried individuals<br> 
•	Self employed professionals/businessmen <br><br>
You can include your spouse/parents/children as co-applicant if you require higher eligibility subject to maximum of three applicants. <br />
<div style=" float:left; width:630px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;">Monthly Income</span><br />  <span class="text11" style="color:#4c4c4c; ">The income that we get in hand on month to month bases is said as Monthly Income. While taking a <a href="http://www.deal4loans.com/home-loans.php">Home Loan</a>  the Bank initially calculate on the bases of net income that is left in our hand after deduction of all other emi’s. <a href="http://www.deal4loans.com/home-loans.php">Home Loan</a>  the Bank initially calculate on the bases of net income that is left in our hand after deduction of all other emi’s.</span></div>
<div style=" float:left; width:630px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;">Other EMI</span><br />  <span class="text11" style="color:#4c4c4c; ">Other Emi (Equally monthly installment) is the emi that we are paying to for any other <a href="http://www.deal4loans.com/">Loan</a>.</span></div>
<div style=" float:left; width:630px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;">Available Income</span><br />  <span class="text11" style="color:#4c4c4c; "> The income that is left in our hand after deduction of any emi amount that we are paying for any kind of loan. Your <a href="http://www.deal4loans.com/home-loan-calculator.php">Home Loan Eligibility Calculator</a>  will be calculated after deduction of the EMI’s that you are paying.</span></div>
</td><td  style="padding:5px;">
<table cellpadding="0" cellspacing="0" border="0" width="300" ><tr><td  align="right">
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=236732309688469" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe></td><td width="70">
<a class="addthis_button_tweet" style="width:70px;"></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e0d5fb863d78da4"></script>
</td><td align="left" width="80" ><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><g:plusone></g:plusone></td></tr></table>
<br />
<!--<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>-->
<!--
  /* if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=88&amp;source=intCampaign&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");*/
//-->
<!--</script>--><!--<noscript><a href='http://ads.deal4loans.com/adclick.php?n=a3fa85b1' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=88&amp;source=intCampaign&amp;n=a3fa85b1' border='0' alt=''></a></noscript> -->
<a href="https://apply.standardchartered.co.in/credit-card&se=deal4loans_banners&cp=SCB_CreditCards_Display_SCB&ag=SCB_EM&kd=rx_mailer" style="text-decoration:none;" target="_blank"><img src="new-images/cc/stanc_cc_300x250.gif" width="300" height="250" border=0/></a>

</td></tr></table>
<br />
<div style=" float:left; width:940px; height:auto; margin-top:2px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;">Duration of Loan (Years)</span><br />
  <span class="text11" style="color:#4c4c4c; ">It’s one of the most important factors that one should keep in mind while taking loan. It refers to the no. of years for which the loan has to be taken. Longer the tenure higher will be the interest paid and lower will be amount of EMI to be paid and vice-a-versa. It is one of the parameters which helps in comparing the EMIs from different banks keeping it constant for relationship and easing the judgment.</span></div>
<div style=" float:left; width:940px; height:auto; margin-top:15px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;">Interest Rate (in percentage)</span></div>
  <span class="text11" style="color:#4c4c4c; ">Today there are many lenders in the market. Every bank is offering loans whether it’s a nationalized bank, private bank or foreign bank each of them is there in the show. Every bank offers different rate of interest according to the profile of the customer. So, before finalizing a deal one should consider deals from various banks and than come to a conclusion. And aware of the fact that some people might mislead you by charging high rate of interest at reducing rate and might inform the same at flat rate of interest. So, its always advisable to check full detail with the banks and do better comparison in respect of EMIs , Tenure and <a href="http://www.deal4loans.com/home-loans-interest-rates.php">Interest Rates</a>  and keeping tenure as constant with all the banks will ease your comparison and will result in better analysis, finally leading to a prudent decision.</span></div>
<div style=" float:left; width:940px; height:auto; margin-top:15px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;">EMI</span><br />
<span class="text11" style="color:#4c4c4c; "> EMI stands for equally monthly installment; you need to pay a particular amount for the Home loan that you have taken.</span></div>
<div style=" float:left; width:940px; height:auto; margin-top:15px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;">Eligible Loan Amount</span><br />
<span class="text11" style="color:#4c4c4c; "> The net loan amount for which you are eligible for your Home loan is said as Eligible Loan Amount. The loan amount that a Bank can sanction you.</span></div>
<div class="tbl_txt">
<h3>Other Available Calculators are - </h3>
<a href="Contents_Calculators.php"><b>EMI Calculator</b></a> | 
<a href="http://deal4loans.com/car-loan-emi-calculator.php" ><b>Car Loan EMI Calculator</b></a> | 
<a href="balance-transfer-home-loans.php"><strong>Home Loan Balance Transfer</strong></a> | 
<a href="loan-amortization-calculator.php"><strong>Loan Amortization Calculator</strong></a>
</div></div></div></div>
<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
</body>
</html>