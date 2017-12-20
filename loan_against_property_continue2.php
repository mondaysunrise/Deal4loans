<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$maxage=date('Y')-62;
$minage=date('Y')-18;
	
	$page_Name = "LandingPage_HL";

$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
	//	Header("Refresh: 5 URL=".$R_URL);
	}

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	

	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
	$City = $_SESSION['Temp_city'];
	$Net_Salary = $_SESSION['Temp_net_salary'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link rel="stylesheet" href="css/loan_property.css" type="text/css" />
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
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
function submitform(Form)
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";


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


	 if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Please select employment status ");
		Form.Employment_Status.focus();
		return false;
	}
	if((Form.Property_Value.value==''))
{
	alert("Please enter Property Value to Continue");
	Form.Property_Value.select();
	return false;
}
if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
alert("Kindly fill in your Pincode!");
Form.Pincode.select();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.select();
return false;
}
if((Form.Loan_Amount.value==''))
{
	alert("Please enter Loan Amount to Continue");
	Form.Loan_Amount.select();
	return false;
}

}
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
			     
               
       }

       return true;
}
</script>
<?
if($_SESSION['Temp_loan_type'] == "Req_Loan_Against_Property")
		$file_name = "closedby_lap.php";
	

?>

<body>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="206" height="139" align="left" valign="top"><img src="images/lap-header1.gif" width="206" height="139" /></td>
            <td width="168" height="139" align="left" valign="top"><img src="images/lap-header2.gif" width="168" height="139" /></td>
            <td width="200" height="139" align="left" valign="top"><img src="images/lap-header3.gif" width="200" height="139" /></td>
          </tr>
          <tr>
            <td width="206" height="122" align="left" valign="top"><img src="images/lap-header4.gif" width="206" height="122" /></td>
            <td width="168" height="122" align="left" valign="top"><img src="images/lap-header5.gif" width="168" height="122" /></td>
            <td width="200" height="122" align="left" valign="top"><img src="images/lap-header6.gif" width="200" height="122" /></td>
          </tr>
        </table></td>
        <td width="206" height="261" align="right" valign="top"><img src="images/lap-right-hdr.gif" width="206" height="261" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"  style="border:1px solid #C6C6C6; border-bottom:none; border-top:none;">
	<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0"  >
      <tr>
        <td width="450"  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="99" valign="top" background="images/lap-step-bg.gif" ><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="38%"  valign="middle" class="blue-text" style="padding-top:35px;">Post your Loan Against Property requirement</td>
                  <td width="38%" class="blue-text" style="padding-top:35px;">Get &amp; Compare Offers<br />
                    from all Banks</td>
                  <td width="24%" class="blue-text" style="padding-top:35px;">Go with the Best<br />
                    Bid</td>
                </tr>
            </table></td>
          </tr>
          <tr>
				<td class="blue-text" style="padding-left:8px; padding-top:10px;" ><span class="bluebld-text">www.deal4loans.com</span><br />
              The one-stop shop for best on all loan requirements. Now get offers
              from <b>ICICI Bank</b>, <b>IDBI Bank</b>, <b>GE Money</b>, <b>Citifinancial</b>, <b> Axis Bank</b> and Choose the Best Deal!<br />
              -----------------------------------------------------------------------------------<br />
              <span class="bluebld-text"> Why to opt for Loan Against Property ?</span><br />
              &bull; Capital requirement for Business.<br />
              &bull; For your Child's marriage.<br />
              &bull; Send your Child for higher studies!<br />
              &bull; Fund Medical Treatments.<br />
              &bull; In Debt consolidation <br />
              <br />
              </td>
          </tr>
		  <!------------------>
		 
		  
		  <!--------------->
        </table></td>
        <td align="right" valign="top"><table width="100%"   border="0" align="right" cellpadding="0" cellspacing="0">
          
		  <tr>
		    <td width="317" height="80" align="center" class="whtbold-text" valign="bottom" background="images/lap-form-bg.gif" style="background-repeat:no-repeat; background-position:center; font-size:14px; color:#5E5509;">Loan Against Property Request </td>
		    </tr>
			 <tr>
		    <td  class="whtbold-text" align="center" valign="bottom" background="images/lap-form-bot-bg.gif" style="background-repeat:repeat-y; background-position:center; padding-top:15px; color:#5E5509;"> Step 2 of 2</td>
		    </tr>
		  <tr>
		 
		    <td align="center" valign="bottom" background="images/lap-form-bot-bg.gif" style="background-repeat:repeat-y; background-position:center; padding-top:15px;">
			<form name="laploan_form" method="post" action="lap_final_thank1.php" onSubmit="return submitform(document.laploan_form);">
			<table width="85%" border="0" align="center" cellpadding="0" cellspacing="2"   >
			<input type="hidden" name="userid" value="<? echo $last_id;?>">
			<input type="hidden" name="net_salary" value="<? echo $IncomeAmount;?>">
			<input type="hidden" name="city" value="<? echo $City;?>">
            <input type="hidden" name="name" value="<? echo $name;?>">
             <input type="hidden" name="Phone" value="<? echo $mobile;?>">
			<input type="hidden" name="Reference_Code" value="<? echo $Reference_Code;?>">
			  <tr>
                <td width="50%" height="23" align="left" class="whtbold-text"  style="color:#5E5509;">DOB</td>
                <td width="56%" align="left"><input type="text" name="day" value="dd"  id="day" size="4" maxlength="2">
                    <input name="month" id="month" size="4" maxlength="2"  value="mm">
                    <input name="year" type="text" id="year" value="yyyy" size="6" maxlength="4" /></td>
              </tr>
			<tr>
                <td width="50%" height="23" align="left" class="whtbold-text"   style="color:#5E5509;">Employment Status</td>
                          <td align="left"><select  name="Employment_Status" style="width:132px;">
				<option selected value="-1">Please Select</option>
				<option  value="1">Salaried</option>
				<option value="0">Self Employed</option>
				</select>
				</td>
              </tr>
             <tr>
                <td width="50%" height="23" align="left" class="whtbold-text"   style="color:#5E5509;">Property Value </td>
                <td width="56%" align="left"><input type="text" name="Property_Value" id="Property_Value"  onchange="intOnly(this); insertData();"  onKeyUp="intOnly(this); getDigitToWords('Property_Value','formatedproperty','wordproperty');" onKeyPress="intOnly(this); getDigitToWords('Property_Value','formatedproperty','wordproperty');" style="float:left; width:130px;"  onKeyDown="getDigitToWords('Property_Value','formatedproperty','wordproperty');" onblur="getDigitToWords('Property_Value','formatedproperty','wordproperty'); "/></td>
              </tr>
			   <tr>
                <td colspan="2" align="left"><span id='formatedproperty' style='font-size:11px;
		font-weight:bold;color:#5E5509;font-Family:Verdana;'></span><span id='wordproperty' style='font-size:11px;
		font-weight:bold;color:#5E5509;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td width="50%" height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Pincode</td>
                <td width="56%" align="left"><input type="text"  maxlength="6" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onfocus="this.select();" name="Pincode"  style="width:130px;"  /></td>
              </tr>
              <tr>
                <td height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Loan Amount</td>
                <td align="left"><input type="text" id ="Loan_Amount" name="Loan_Amount" onfocus="this.select();" class="style4"onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt');" style="float:left; width:130px;"  onKeyDown="getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt');" onblur="getDigitToWords('Loan_Amount','formatedIncome','wordIncome'); "  /></td>
              </tr>
            
             
              
              <tr>
                <td colspan="2" align="left"><span id='formatedloanamt' style='font-size:11px;
		font-weight:bold;color:#5E5509;font-Family:Verdana;'></span><span id='wordloanamt' style='font-size:11px;
		font-weight:bold;color:#5E5509;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td colspan="2" align="left" valign="bottom" id="tataaig_compaign" class="wht-text"></td>
              </tr>
              
              <tr>
                <td height="25" colspan="2" align="center" valign="bottom"><input name="submit" type="image" src="images/lap-form-sbt.gif"  width="123px" height="43px" style="border:none;" /></td>
              </tr>
            </table>
			</form>			</td>
		    </tr>
		  <tr>
		  <td align="center" valign="bottom" background="images/lap-form-bot-bg.gif" style="background-repeat:repeat-y; background-position:center;"><img src="images/lap-form-bot.gif" width="300" height="11" /></td>
		  </tr>
		
          
          
        </table></td>
      </tr>
    </table></td>
  </tr>
 <tr><td class="blue-text" style="padding-left:8px; padding-top:10px; border:1px solid #C6C6C6; border-bottom:none; border-top:none;"><span class="bluebld-text">Helpful Tips</span><br />
              Please ensure that you compare your Loan Against Property
bid from various Banks on the following parameters:<br />
              &bull; Interest rates .<br />
              &bull; Processing Fees.<br />
              &bull; Pre-payment/Foreclosure charges.<br />
              &bull; Documents required.<br />
              &bull; Is your Propety located in an approved location.<br />
              <div style="float:right;" class="bluebld-text"><a href="http://www.deal4loans.com/Contents_Loan_Against_Property_Mustread.php" target="_bank">Know more........</a></div></td></tr>
   <tr>
            <td class="blue-text" style="padding-left:8px; padding-top:10px; border:1px solid #C6C6C6; border-bottom:none; border-top:none;" ><span class="bluebld-text">Testimonials</span><br />
              Blore Loan Against Property<br />
              I am glad that i could get 3 quotes on my loan requirement within just 48 hrs that too w/o stepping out of home. I can now close out my property also. Only thing is that I came across your site accidentally- you should promote ur value-adding services better..
              <div style="float:right; font-weight:bold; padding-right:5px">By lakshminarayan</div></td>
		  </tr>
  <tr>
    <td><img src="images/lap-bot-panle.gif" width="780" height="22" /></td>
  </tr>
</table>


<!-- Google Code for lead Conversion Page -->


<script language="JavaScript" type="text/javascript">

<!--
var google_conversion_id = 1056387586;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "FFFFFF";
if (1) {
  var google_conversion_value = 1;
}

var google_conversion_label = "lead";
//-->
</script>

<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1056387586/imp.gif?value=1&label=lead&script=0">
</noscript>

<SCRIPT language="JavaScript" type="text/javascript">
<!-- Yahoo!
window.ysm_customData = new Object();
window.ysm_customData.conversion = "transId=,currency=,amount=";
var ysm_accountid  = "135AHO229GAA5G7GKVUE46C65OO";
document.write("<SCR" + "IPT language='JavaScript' type='text/javascript' " 
+ "SRC=//" + "srv1.wa.marketingsolutions.yahoo.com" + "/script/ScriptServlet" + "?aid=" + ysm_accountid 
+ "></SCR" + "IPT>");
// -->
</SCRIPT>

</body>
</html>

