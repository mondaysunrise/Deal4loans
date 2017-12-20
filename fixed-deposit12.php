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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Fixed Deposit Rates – Compare Fixed Deposit Interest Rates of Various Banks | Deal4Loans India</title>
<meta name="keywords" content="Fixed Deposit, fixed deposit rates, fixed term deposit, term deposit rates, fd rates, fixed deposit interest rates, fixed deposit interest rate, interest rates of fixed deposits, fd interest rates">
<meta name="description" content="Fixed Deposit Rates: Choose Best fixed deposit interest rates. Best returns on Deposits with Highest Interest Rates. Compare various Banks Fixed Deposit rate.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript">
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}


function chkeducaionloan(Form)
{
	
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";


if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
{
alert("Kindly fill in your Name!");
Form.Name.focus();
return false;
}
else if(containsdigit(Form.Name.value)==true)
{
alert("Name contains numbers!");
Form.Name.focus();
return false;
}
  for (var i = 0; i < Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Name.focus();
  	return false;
  	}
  }

if(Form.Email.value!="Email Id")
{
	if (!validmail(Form.Email.value))
	{
		//alert("Please enter your valid email address!");
		Form.Email.focus();
		return false;
	}
}


if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
alert("Kindly enter your Date of Birth");
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
alert("Kindly enter your Date of Birth(numbers Only)");
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
alert("Kindly Enter your valid Date of Birth(Range 1-31)");
Form.day.select();
return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
alert("Kindly enter your Month of Birth(numbers Only)");
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
alert("Kindly Enter your valid Month of Birth(Range 1-12)");
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
alert("Month February cannot have more than 29 days");
Form.day.select();
return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
alert("Kindly enter your Year of Birth");
Form.year.select();
return false;
}

else if(!num.test(Form.year.value))
{
alert("Kindly enter your Year of Birth(numbers Only) !");
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
alert("February cannot have more than 28 days.");
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
Form.year.select();
return false;
}
else if((Form.year.value < "<?php echo $maxage;?>") || (Form.year.value >"<?php echo $minage;?>"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
Form.year.select();
return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
	alert("Cannot have 31st Day");Form.day.select();
	return false;
}

if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
if((Form.amount_invest.value=='')||(Form.amount_invest.value=="Loan Amount"))
{
alert("Kindly fill in your Investment Amount (Numeric Only)!");
Form.amount_invest.focus();
return false;
}
else if(containsalph(Form.amount_invest.value)==true)
{
alert("Investment Amount contains characters!");
Form.amount_invest.focus();
return false;
}

if(Form.tenure.selectedIndex==0)
{
	alert("Please enter Tenure to Continue");
	Form.tenure.focus();
	return false;
}


if(!Form.accept.checked)
{
	alert("Accept the Terms and Condition");
	Form.accept.focus();
	return false;
}
	
}

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
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
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

</script>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="scripts/common.js"></script>
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
    <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
	<Script Language="JavaScript">
function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}

var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
				try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
	
function newcomplete_div()
{
	var get_roi = document.getElementById('get_roi').value;
	var get_tenure = document.getElementById('amount1').value;
	var get_amount_invest = document.getElementById('amount_invest').value;		
	var get_day = document.getElementById('day').value;		
	var get_month = document.getElementById('month').value;		
	var get_year = document.getElementById('year').value;			
			
	var queryString = "?get_roi=" + get_roi +"&get_tenure=" + get_tenure +"&get_amount_invest=" + get_amount_invest +"&get_day=" + get_day +"&get_month=" + get_month  +"&get_year=" + get_year ;
	//alert(queryString);
			
  $('#complete_div').html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div').load("get_slider_info.php" + queryString);
}

window.onload = ajaxFunctionMain;
	
</script>
	<script>
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: 8.25,
			min: 5.5,
			step: .25,
			max:  11,
			slide: function( event, ui ) {
				$( "#get_roi" ).val( "" + ui.value + "" );
			}
		});
		$( "#get_roi" ).val( "" + $( "#slider-range-min" ).slider( "value" ) );
	});
	</script>

	<script>
	$(function() {
		$( "#slider-range-min1" ).slider({
			range: "min",
			value: 13,
			step: 1,
			min: 0,
			max: 120,
			slide: function( event, ui ) {
				$( "#amount1" ).val( "" + ui.value );
			}
		});
		$( "#amount1" ).val( "" + $( "#slider-range-min1" ) .slider( "value" ) );
	});

	</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 <? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>
<div id="container"  >  
  <span><a href="index.php">Home</a> > Fixed Deposit  Interest Rate</span>
  <div style="padding-top:15px; ">
  
<font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong>
          <?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?>
          </strong></font>
            <form name="eduloan_form"  action="fixed-deposit-continue.php" method="POST" onSubmit="return chkeducaionloan(document.eduloan_form);"> 
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
	 <tr>
        <td style=" padding:12px;"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;"> Fixed Deposit Interest Rate<br />
 <span style="font-size:11px; font-weight:normal;">(Last edited on : <? echo $currentdate; ?>)</span></h1></td>
  </tr>
</table></td>
 </tr>
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
          <tr>
            <td colspan="2" align="center">
<input type="hidden" name="source" value="<? echo $source; ?>"> 
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></td>
	      </tr>
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td width="6%" height="28" class="frmbldtxt" style="padding-top:3px; "> Name :</td>
                     <td width="23%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Name" id="Name" tabindex="1" /></td>
                     <td width="15%" height="28" class="frmbldtxt" style="padding-top:3px; ">Email  :</td>
                     <td width="21%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Email" id="Email" tabindex="2" /></td>
                     <td width="18%" height="28" class="frmbldtxt" style="padding-top:3px; ">Dob  :</td>
                     <td width="17%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input name="day" type="text" id="day"  value="dd" style="width:32px;" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="3"/>&nbsp;&nbsp;
                <input  name="month" type="text" id="month" style="width:32px;" value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="4"/>&nbsp;&nbsp;
                <input name="year" type="text" id="year" style="width:49px;" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="5" /></td>
                   </tr>
                   <tr valign="middle">
                    <td width="6%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                     <td width="23%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="City" id="City" style="width:154px;" tabindex="6">
                           <?=getCityList($City)?>
                       </select></td>
                     <td height="28" class="frmbldtxt">Amount to Invest :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="amount_invest" id="amount_invest" onChange="intOnly(this);"  onkeyup="intOnly(this); getDigitToWords('amount_invest','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('amount_invest','formatedIncome','wordIncome');" maxlength="10" tabindex="7" /></td>                     <td height="28" class="frmbldtxt">Tenure :</td>
                     <td height="28" class="frmbldtxt">
<!--//0-6
//6-12
//12-24 (1-2yrs)
//24-36 (2-3yrs)
//36-48 (3-4yrs)
//48-60 (4-5yrs)
//60-120 (5-10yrs)
 -->                     <select name="tenure"  style="width:154px;">
                     <option value="">Select</option>
                     <option value="5">7 - 180 days</option>
                     <option value="11">181 - 365 days</option>
                     <option value="23">1st-2nd Year</option>
                     <option value="35">2nd-3rd Year</option>
                     <option value="46">3rd-4th Year</option>
                     <option value="58">4th-5th Year</option>
                     <option value="118">5th-10th Year</option>                  
                     </select>
                     </td>
                     </tr>
                   <tr valign="middle">
                    <td width="6%" height="28" class="frmbldtxt" style="padding-top:3px; "></td>
                     <td width="23%" height="28" class="frmbldtxt"  style="padding-top:3px; "></td>
                     <td height="28" class="frmbldtxt" colspan="2"><span id='formatedIncome' style='font-size:11px; color:666699; '></span><span id='wordIncome' style='font-size:11px; color:666699; capitalize;'></span></td>
                     <td height="28" colspan="2" align="left" class="frmbldtxt"></td>
                     </tr>
                   
                     <tr>
            <td align="left" class="frmbldtxt"  style="font-weight:normal;" colspan="5">
		              <input type="checkbox" name="accept" style="border:none;" checked>
I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and
              agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>
			  </td>
            <td width="18%"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
          </tr>
               <tr>
            <td align="left" class="frmbldtxt"  style="font-weight:normal;" colspan="6">&nbsp;</td></tr>   
                 
                 </table></td>
                 
               </tr>
             </table></td>
          </tr>
             <tr>
            <td class="frmbldtxt" colspan="6" align="center"> 
         <table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr><td valign="top">   
          
         <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="45" align="left" valign="middle" background="new-images/term-qtbg.gif"   >
		  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
             <tr align="center">
                <td class="tbl_txt"><b>Sample Interest Rates: </b></td>
                <td width="1" height="33"><img src="new-images/term-sprt-line.gif" width="1" height="33" /></td>
                <td class="tbl_txt"><b>Age</b> - 32 Years</td>
                <td width="1" height="33"><img src="new-images/term-sprt-line.gif" width="1" height="33" /></td>
                 <td class="tbl_txt"><b>Amount</b>  -  Rs. 7 lacs</td>
                <td width="1" height="33"><img src="new-images/term-sprt-line.gif" width="1" height="33" /></td>
				 <td class="tbl_txt">&nbsp;</td>
             </tr>
          </table>
		  
		  </td>
          </tr>
        </table>
		 <table width="97%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
	  <tr>
         <td width="430" height="25" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:12px;" >Company Name</td>
        <td width="162" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt"  style="font-size:12px;">ROI</td>
        <td width="141" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt"  style="font-size:12px;">Tenure</td>
      </tr> 

  <tr><td colspan="5" width="100%" align="center">
  <table cellpadding="3" cellspacing="3"  width="100%">
  <?php
  	$bankIDS = "31,4,3,30,12,21,13,26,32,25,33,14,6,11";
	$bankArr = explode(",", $bankIDS);
	
	for($ii=0;$ii<count($bankArr);$ii++)
	{
	
	
	$sql = "select 7_180bellow15,180_364bellow15,1_2yrbellow15, 2_3yrbellow15,3_4yrbellow15,4_5yrbellow15,5_10yrbellow15 from fd_interestrates  where fd_bankID = '".$bankArr[$ii]."' ";
	list($count,$query)=MainselectfuncNew($sql,$array = array());
	$header = '';
	$fieldValue = '';
	for ($i = 0; $i < $count; $i++){
		$fieldName = mysql_field_name($query, $i);
		$header[] = $fieldName;
	}
	
	
	$bellow15_7_180 =  $query[0]['7_180bellow15'];
	$bellow15_180_364 =  $query[0]['180_364bellow15'];
	$yrbellow15_1_2 =  $query[0]['1_2yrbellow15'];
	$yrbellow15_2_3 =  $query[0]['2_3yrbellow15'];
	$yrbellow15_3_4 =  $query[0]['3_4yrbellow15'];
	$yrbellow15_4_5 =  $query[0]['4_5yrbellow15'];
	$yrbellow15_5_10 =  $query[0]['5_10yrbellow15'];
	$valueArr = array($bellow15_7_180,$bellow15_180_364,$yrbellow15_1_2,$yrbellow15_2_3,$yrbellow15_3_4,$yrbellow15_4_5,$yrbellow15_5_10);
	
	$maximumVal = max($valueArr);
//	print_r($maximumVal);
	$key = array_search($maximumVal, $valueArr); // $key = 2;
	
	$finalField = $header[$key];
	
	if($finalField=='7_180bellow15')	{		$tenureValue = "7-180 Days";	}	else if($finalField=='180_364bellow15')	{		$tenureValue = "180-364 Days";	}	else if($finalField=='1_2yrbellow15')	{		$tenureValue = "1-2 Yrs";	}	else if($finalField=='2_3yrbellow15')	{		$tenureValue = "2-3 Yrs";	}	else if($finalField=='3_4yrbellow15')	{		$tenureValue = "3-4 Yrs";	}	else if($finalField=='4_5yrbellow15')	{		$tenureValue = "4-5 Yrs";	}	else if($finalField=='5_10yrbellow15')	{		$tenureValue = "5-10 Yrs";	}
		
	$bankNameSql = "select * from fd_interestrate_bank where fd_bankID='".$bankArr[$ii]."'";
		list($count,$bankNameQuery)=MainselectfuncNew($bankNameSql,$array = array());
	$bankName = $bankNameQuery[0]['fd_bank'];
	$banklogo = $bankNameQuery[0]['logo'];	
?>

 <tr>
      <td width="430" height="30" align="left" bgcolor="#FFFFFF" class="tbl_txt" style="font-weight:bold; font-size:13px; color:#02358a; width:430px; "><span class="verdred12" style="padding:2px;"><img src='<?php echo $banklogo; ?>' alt="" border='0' /></span><br />
<?php echo $bankName; ?></td>
      <td width="162" height="30" align="left" bgcolor="#FFFFFF" class="tbl_txt" style="font-weight:bold; font-size:13px; color:#02358a; width:162px;"><span class="verdred12" style="padding:2px;"><?php echo $maximumVal?> %</span></td>
      <td width="141" height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center; font-weight:bold; font-size:13px; color:#02358a;  width:141px;"><span class="verdred12" style="padding:2px;"><?php echo $tenureValue?> </span></td>
    </tr>

<?php
}
?>
     
     
                
	</table></td></tr>

    </table>
 </td><td valign="top"><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 300x250, created 3/8/11 */
google_ad_slot = "4370078512";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<br /><br />
<script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 300x250, created 3/8/11 */
google_ad_slot = "4370078512";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td></tr></table>
  
</td>
            </tr> 
	   </table></td>
      </tr>
      <tr><td style="padding:20px;"><p><strong><u>FIXED  DEPOSITS</u></strong> <br />
              <u>D</u><u>efinition:</u> A  fixed-income debt security, usually issued by banks is called a Fixed Deposit  (or as commonly known as FD). In simple words a FD is like loaning the bank  your money on which Bank pays you interest.<br />
        The rate of interest for Bank Fixed Deposits depends on the maturity period.  The tenure is fixed and the rate is guaranteed. Rate is usually higher in case  of longer maturity period. <br />
  <strong><u>Features:</u></strong></p>
          <p style="padding-left:10px;">
          <ul>
            <li>Term of FD can range from 15days to 5 years. </li>
            <li>The interest can be compounded quarterly, half-yearly  or annually and varies from bank to bank. </li>
            <li>Minimum deposit amount is Rs 1000/- and there is  no upper limit. </li>
            <li>Loan / overdraft facility is available against  bank fixed deposits.  </li>
            <li>One can break the FD in case of emergency  monetary requirement but it involves loss of interest.</li>
          </ul></p>
          <p><strong>What one should know before creating an FD?</strong><br />
            Before selecting the bank for FD one should </p>
          <p style="padding-left:10px;">
          <ul>
            <li>Check the financial position of the bank, </li>
            <li>Check the rates of interest for different banks  for different periods. </li>
            <li>It is advisable to keep many small deposits instead  of putting a big amount in one fixed deposit. As this will help if one needs to  make any premature withdrawal of partial amount, then only one or two deposits  may need to be prematurely encashed making the loss of interest minimal.</li>
            <li>Check deposit receipts carefully to ensure that  all details have been properly and accurately filled in. </li>
            <li>Do not leave the renewal column unfilled.  Otherwise, on maturity the fixed deposit amount will go back into an FD. </li>
            <li>Before investing in a FD it is important to  consider the rate of interest and the inflation rate. A high inflation rate can  reduce the real returns. </li>
          </ul></p>
          <p><strong>Advantages of investing in Fixed Deposit </strong></p>
         <p style="padding-left:10px;">
          <ul type="disc">
            <li>Fixed deposits are among the safest modes of investment;       nationalized, private, or foreign, are governed by the RBI's rules and       regulations, and give due weightage to the interest of the investor. In       fact all bank deposits were insured under the Deposit Insurance &amp;       Credit Guarantee Scheme of India, which has now been made optional.</li>
            <li>One can get loans up to 75- 90% of the deposit amount       from banks against FD receipts.</li>
          </ul>
          <p><strong>Tax Implications</strong> </p>
          <ul type="disc">
            <li>The amount invested in fixed deposits with a maturity       period of 5 years in a Scheduled bank is eligible for tax deduction under       section 80C but the interest earned on the deposit is taxable.</li>
            <li>Tax will be deducted at the source, if the interest       income on a fixed deposit per annum exceeds Rs.10000.</li>
          </ul>
          </p>
          <p><strong>How To Open a Bank Fixed Deposit  Account?</strong><br />
            Some banks insist on a savings account with them to operate a FD. IT is as  simple as filing a form and depositing cash with the bank and FD is made. </p>
          <p><strong>Eligibility  &amp; Documentation</strong></p>
          A valid Identity proof and an address proof are  required by the depositor for opening a Fixed Deposit account</td>
      </tr>
    </table>
	</form>  
   </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?> <? } ?>
</div></body>
</html>

