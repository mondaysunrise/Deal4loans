<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<title>Untitled Document</title>
<style type="text/css">
<!--
 
ul.ppt {
	position: relative;
	height: 100%;
	width: 100%;
}

.ppt li {
	list-style-type: none;
	position: absolute;
	top: 0px;
	left: 0;
	
	<?php 
	if(strlen(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0")) > 0) 
	{
	?>
	margin-top: -10px;
	margin-left: -35px;
	<?php
	}
	else
	{
	?>
	margin-top: -16px;
	
	<?php
	
	}
	?>
	float: left;
	height: 202px;
	width: 222px;
 
}

.ppt img {
 
}
</style>

 
<link href="source.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}


.text11 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none; 
	
}

.text9 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: normal;
	color: #697e94;
	text-decoration: none; 
}


.text12 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none; 
}


 
.text {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
	line-height: 18px;
}


.text2 {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
}

.text3 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #909faf;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans);
 
}

a.btn:link {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 	padding:5px 12px 5px 12px ;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans);
 
 
}



a.btn:visited {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 		padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans);
 
 
}

a.btn:hover {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
	font-variant: normal;
	color: #203f5f;
	text-decoration: none;
	  	padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans);
 
 
}


.text4 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 10px;
	font-weight: bold;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans);
 
}


.textbox {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #666;
	text-decoration: none;
	height: 18px;
	width: 153px;
	border: none;
	margin-top:7px;
	margin-left:30px;
 
 
}



.font {
	font-family: DroidSansRegular;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #666666;
	text-decoration: none;
	font-style: italic;	 
 
}


-->
</style>
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

 if (document.loan_form.Type_Loan.selectedIndex==0)
	{
		document.getElementById('productRVal').innerHTML = "<span  class='hintanchorqa'>Select Product</span>";	
		document.loan_form.Type_Loan.focus();
		return false;
	}
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
		document.getElementById('acceptRVal').innerHTML = "<span class='hintanchorqa'>Accept the Terms and Condition!</span>";	
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
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Droid+Sans::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
  
  <script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Droid+Serif::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body >
<form name="loan_form" method="post" action="Right3.php" onsubmit="return chkformR();">
<table width="253" border="0" cellspacing="0" cellpadding="0">

<tr>
	<td align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="28" align="left" valign="top">&nbsp;</td>
	<td  align="center" valign="top" width="250">
		<table width="245" border="0" cellpadding="0" cellspacing="3">
		<tr>
			<td align="left" valign="middle" colspan="2" class="text3" style=" color:#666666; font-size:20px;  text-align:center; height:35px; "><strong>Quick Apply</strong></td>
		</tr>
	<tr>
	<td width="69"  height="23" align="left" valign="top" class="text" style=" font-size:12px; color:#666666; ">
		Product</td>
	<td width="167"  class="text" style="font-size:12px; color:#666666; ">
		
		<select name="Type_Loan" id="Type_Loan"  onchange="validateDiv('productRVal');"  style=" height:20px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c; width:150px;" tabindex="1" >
			<option value="1">Please select</option>
			<option value="Req_Loan_Personal">Personal Loan</option>
			<option value="Req_Loan_Home">Home Loan</option>
			<option value="Req_Loan_Car">Car loan</option>
			<option value="Req_Loan_Against_Property">Loan against Property</option>
			<option value="Req_Credit_Card">Credit Card</option>
			<option value="Req_Loan_Education">Education Loan</option>
			<option value="Req_Loan_Gold">Gold Loan</option>
		</select>
	<div id="productRVal"></div>
	</td>
</tr>
<tr>
<td width="69" height="23" align="left" valign="top" class="text" style="font-size:12px; color:#666666;  ">
<input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>" />
Full Name</td><td width="167" class="text" style="font-size:12px; color:#666666; " height="23">
<input name="fullname" id="fullname" type="text" style="width:145px; height:14px;" onkeydown="validateDiv('nameRVal');" tabindex="2" />
<div id="nameRVal"></div>   
</td>
</tr>
<tr>
<td width="69" height="23" class="text" style="font-size:12px; color:#666666;  ">
Mobile</td>
<td width="167" class="text" style="font-size:12px; color:#666666; ">
+91 
<input name="mobile" id="mobile" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:122px; height:14px;" onkeydown="validateDiv('phoneRVal');" tabindex="3"  />
<div id="phoneRVal"></div>   
</td>
</tr>
<tr>
<td width="69" height="23" class="text" style=" font-size:12px; color:#666666;  ">
Email ID </td>
<td width="167" class="text" style="font-size:12px; color:#666666; ">
<input name="email_id" id="email_id" type="text" style="width:145px; height:14px;" onkeydown="validateDiv('emailRVal');" tabindex="4" />
<div id="emailRVal"></div>   
</td>
</tr>
<tr>
<td width="69" height="23" align="left" valign="top" class="text" style="font-size:12px; color:#666666;  ">
City</td>
<td width="167" class="text" style="font-size:12px; color:#666666; ">
<select name="city" id="city" style=" height:18px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c; width:150px;" onchange="validateDiv('cityRVal');" tabindex="5" >
<?=plgetCityList($City)?>
</select>
<div id="cityRVal"></div>   
</td>
</tr>
<tr>
<td width="69" height="23" align="left" valign="top" class="text" style="font-size:12px; color:#666666;   padding-right:2px;">
Net Salary (Yearly)</td>
<td width="167" class="text" style="color:#FFF; font-size:11px;  ">
<input name="net_salary" id="net_salary" type="text" style="width:145px; height:14px;" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv('netSalaryRVal');" tabindex="6"  />
<div id="netSalaryRVal"></div>   
</td>
</tr>
<tr>
<td align="left" valign="top" colspan="2" class="text9" style="font-size:10px; color:#666666;  margin-top:0px; ">
  <input name="accept" type="checkbox" tabindex="7"/>  
     I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text9" style=" color:#666666; font-size:10px; text-decoration:underline;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text9" style=" color:#666666; font-size:10px; text-decoration:underline;">Terms</a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text9" style=" color:#666666; font-size:10px; text-decoration:underline;">& Conditions</a>.
     <div id="acceptRVal"></div>
</td>
</tr>
<tr>
<td>&nbsp;</td><td  align="center" valign="top"  style= "margin-left:0px;">
<input type="submit" style="border: 0px none ; background-image: url(images/sub_btn.jpg); width: 94px; height: 27px; margin-bottom: 0px;" value="" tabindex="8"/>
</td>
</tr> 
</table>
        </td>


</table></td>
</tr>
<tr>
<td height="15" align="left" valign="top"  >&nbsp;</td>
</tr>
</table>
</form>

</body>
</html>
