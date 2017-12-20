<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$page_Name = "LandingPage_HL";

$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
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

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$last_id = $_POST['last_id'];
	$Name = $_POST['Name'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$DOB= $year."-".$month."-".$day;
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$IncomeAmount = $_POST['IncomeAmount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;


		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
		
			{
		
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($year);
		$validMonth = is_numeric($month);
		$validDay = is_numeric($day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{		
	
	
	list($First,$Last) = split('[ ]', $Name);

			//echo "heelo";
		$SMSMessage = "Dear $First,your activation code is: $Reference_Code.Use it in 2nd step to get bidder contacts & quotes. And help us serve you better";
		$dataUpdate = array('Name'=>$Name, 'Mobile_Number'=>$Phone, 'City'=>$City, 'City_Other'=>$City_Other, 'DOB'=>$DOB, 'Email'=>$Email, 'Net_Salary'=>$IncomeAmount, 'Reference_Code'=>$Reference_Code);
		$wherecondition ="(RequestID='".$last_id."')";
		Mainupdatefunc ('Req_Loan_Against_Property', $DataArray, $wherecondition);
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
				$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			

			
/*echo "<script language=javascript>location.href='thank_loanproperty.php?r_url=Contents_Loan_Against_Property_Mustread.php'"."</script>";*/
}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL =$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}

}
		}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
	
}	
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
function submitform(Form)
{

if((Form.activation_code.value==''))
{
	alert("Please enter Activation code to Continue");
	Form.activation_code.select();
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
			<form name="laploan_form" method="post" action="lap_final_thank.php" onSubmit="return submitform(document.laploan_form);">
			<table width="85%" border="0" align="center" cellpadding="0" cellspacing="2"   >
			<input type="hidden" name="userid" value="<? echo $last_id;?>">
			<input type="hidden" name="net_salary" value="<? echo $IncomeAmount;?>">
			<input type="hidden" name="city" value="<? echo $City;?>">
			<input type="hidden" name="Reference_Code" value="<? echo $Reference_Code;?>">
			 <tr>
                <td width="50%" height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Activation Code</td>
                <td width="56%" align="left"><input type="text"  maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="activation_code" id="activation_code" style="width:130px;"  onFocus="return Decorate('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')"  onBlur="return Decorate1(' ')"><div id="plantype2" style="position:absolute;font-size:11px;width:150;font-weight:none; " ></div></td>
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

