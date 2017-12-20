<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	
	$pageName = "credit-cards/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}

$maxage=date('Y')-62;
$minage=date('Y')-18;

$CityN = $_REQUEST['cards'];
$getPageSql = "select * from city_pages where City='".$CityN."' and Product='CC' ";
list($rowscount,$ArrRow)=MainselectfuncNew($getPageSql,$array = array());
		$i=0;

$Title = $ArrRow[$i]['Title'];
$MetaKeyword = $ArrRow[$i]['MetaKeyword'];
$MetaDescription = $ArrRow[$i]['MetaDescription'];
$PageDescription = $ArrRow[$i]['PageDescription'];
$City =  ucwords(strtolower($ArrRow[$i]['City']));
$HeaderDEscription = $ArrRow[$i]['HeaderDEscription'];

$retrivesource="SEO_D4L_CC_".$City;
	$newsource=$retrivesource;
	$subjectLine="Credit Card ".$City;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://www.deal4loans.com/css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title><?php echo $Title; ?></title>
<meta name="keywords" content="<?php echo $MetaKeyword; ?>">
<meta name="description" content="<?php echo $MetaDescription; ?>">

<?php //include "cc-form-js.php"; ?>
<script  type="text/javascript">
function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function validmobile(phone) 
{
	
	atPos = phone.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.mobile, 'Mobile number', 10))
		return false;

return true;
}
function chkformR()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.loan_form.fullname.value=="")
	{
		document.getElementById('nameRVal').innerHTML = "<span  class='hintanchorqa'>Fill Your Name.</span>";	
		document.loan_form.fullname.focus();
		return false;
	}
 
  if(document.loan_form.mobile.value=="")
	{
		document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
		document.loan_form.mobile.focus();
		return false;
	}
	  if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
		{
			document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
            alert("Enter numeric value");
			  document.loan_form.mobile.focus();
			  return false;  
		}
        if (document.loan_form.mobile.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.mobile.focus();
				return false;
        }
        if ((document.loan_form.mobile.value.charAt(0)!="9") && (document.loan_form.mobile.value.charAt(0)!="8") && (document.loan_form.mobile.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.loan_form.mobile.focus();
                return false;
		}
	if(document.loan_form.email_id.value=="")
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter  Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	
	var str=document.loan_form.email_id.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	
	if (document.loan_form.city.selectedIndex==0)
	{
		document.getElementById('cityRVal').innerHTML = "<span class='hintanchorqa'>Please Select City!</span>";
		document.loan_form.city.focus();
		return false;
	}
	if(document.loan_form.net_salary.value=="")
	{
		document.getElementById('netSalaryRVal').innerHTML = "<span class='hintanchorqa'>Fill your Net salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
	if(document.loan_form.net_salary.value<=0)
	{
		document.getElementById('netSalaryRVal').innerHTML = "<span class='hintanchorqa'>Fill Your Net Salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptRVal').innerHTML = "<span class='hintanchorqa'>Read and Accept Terms & Conditions!</span>";	
		document.loan_form.accept.focus();
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
</script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="cc_inner_wrapper">
<div style="margin-top:70px; color:#0a8bd9;"><u><a href="/index.php" class="common-bread-crumb" style="color:#0080d6;" >Home</a></u> > <a href="/credit-cards.php"  class="common-bread-crumb" style="color:#0080d6;">Credit Card</a></u> >  <span class="common-bread-crumb" style="color:#4c4c4c;"> Apply Credit Card - <?php echo $City?></span></div>
<div >
<div style="width:100%; height:33; margin-top:25px; clear:right;">
<h1 class="cc-h1">Credit Card <?php echo $City?></h1>
<!--
<div class="text3" style="width:95px; height:33; margin-top:15px; float:right; clear:right;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="/images/emi1.gif" name="Image3" width="95" height="20" border="0" id="Image3" /></a></div>
-->
</div>
<div style="clear:both; height:5px;"></div>
<div class="cc_left_box-new"><?php echo $HeaderDEscription; ?><?php echo $PageDescription; ?><?php 
$getStateSql = "select * from city_pages where City='".$CityN."' and Product='CC' ";
list($CountVal,$getSateQuery)=MainselectfuncNew($getStateSql,$array = array());
$State = $getSateQuery[0]['State'];
$getCitySql = "select * from city_pages where City!='".$CityN."' and state='".$State."' and Product='CC' ";
list($CityCount,$getCityQuery)=MainselectfuncNew($getCitySql,$array = array());
?>
<div class="state-main-box">
<div class="head-left">Find Credit Card in Your City</div>
<div class="righthead"><a style="text-decoration:none !important;" href="http://www.deal4loans.com/loans-in/<?php echo $State;?>">Credit Card <?php echo ucwords($State);?></a></div>
<div style="clear:both;"></div>
<div>
<ul style="list-style:none;">
<?php 
for($j=0;$j<$CityCount;$j++)
	{
$City = $getCityQuery[$j]['City'];
?>
<li class="state-box"><a href="http://www.deal4loans.com/credit-cards/<?php echo $City;?>" alt="<?php echo ucfirst($City);?> Credit Card"><?php echo ucfirst($City); ?></a></li>
<?php 
	}

 ?>
</ul>
</div>
<div style="clear:both;"></div>
</div>
</div>



<div class="cc-right-box"><form name="loan_form" method="post" action="/Right.php" onSubmit="return chkformR();">
<table width="95%" border="0" cellpadding="0" cellspacing="3" align="center">
              <tr>
                <td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:18px;  text-align:center; ">
                  <strong>Choose Best Credit Card</strong>			</td>
                </tr>
              
              <tr>
                <td width="59" height="30" align="left" valign="top" class="text" style="  color:#FFF; font-size:14px;; ">
                  <input type="hidden" name="Type_Loan" value="Req_Credit_Card"  />
                  <input type="hidden" name="source" value="<? if(isset($newsource)) { echo $newsource;} else { echo "QuickApply";} ?>" />
                  Full Name</td><td width="172" height="30">
                    <input name="fullname" id="fullname" type="text" class="d4l-side-input" onKeyDown="validateDiv('nameRVal');" tabindex="2" />
                    <div id="nameRVal"></div>   
                    </td>
                </tr>
              <tr>
                <td width="59" height="30" class="form-text-right">
                  Mobile</td>
                <td width="172" height="30">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="form-text-right">+91 </td>
    <td> 
                  <input name="mobile" id="mobile" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text"  onKeyDown="validateDiv('phoneRVal');" tabindex="3"  class="d4l-side-input" />
                  <div id="phoneRVal"></div>   </td>
  </tr>
</table>

                  </td>
                </tr>
              <tr>
                <td width="59" height="30" class="form-text-right">
                  Email ID </td>
                <td width="172" height="30">
                  <input name="email_id" id="email_id" type="text" class="d4l-side-input" onKeyDown="validateDiv('emailRVal');" tabindex="4" />
                  <div id="emailRVal"></div>   
                  </td>
                </tr>
              <tr>
                <td width="59" height="30" align="left" valign="top" class="form-text-right">
                  City</td>
                <td width="172" height="30">
                  <select name="city" id="city" onChange="validateDiv('cityRVal');" tabindex="5" class="d4l-side-select" >
                    <?=plgetCityList($City)?>
                    </select>
                  <div id="cityRVal"></div>   
                  </td>
                </tr>
              <tr>
                <td width="59" height="30" align="left" valign="top" class="form-text-right">
                  Net Salary (Yearly)</td>
                <td width="172" height="30">
                  <input name="net_salary" id="net_salary" type="text" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" onKeyDown="validateDiv('netSalaryRVal');" tabindex="6" class="d4l-side-input"  />
                  <div id="netSalaryRVal"></div>   
                  </td>
                </tr>
              <tr>
                <td align="left" valign="top" colspan="2" class="form-text-right" style="font-size:12px; margin-top:0px; ">
                  <input name="accept" type="checkbox" tabindex="7"/>  
                  I Agree to&nbsp;privacy policy and&nbsp;Terms &amp; Conditions.
                  <div id="acceptRVal"></div>
                  </td>
                </tr>
              <tr>
                <td colspan="2" align="center">
                  <input type="submit" class="cc-get-quotebtn-right" value="Get Quote" tabindex="8"/>                  </td>
                </tr> 
              </table>
</form></div>

</div></div>
<?php include("footer-loansinindia.php"); ?>
</div>
</body>
</html>