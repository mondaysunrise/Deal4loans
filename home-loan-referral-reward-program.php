<?php
ob_start( 'ob_gzhandler' );
require 'scripts/functions.php';
require 'scripts/db_init.php';
$RequestID= base64_decode($_REQUEST['id']);
//$RequestID= $_REQUEST['id'];
 $getRefereeSql = "SELECT * FROM  Req_Loan_Home where RequestID='".$RequestID."'";
$getRefereeQuery = ExecQuery($getRefereeSql);
$r_name = mysql_result($getRefereeQuery,0,'Name');
$r_Email= mysql_result($getRefereeQuery,0,'Email');
$r_Mobile= mysql_result($getRefereeQuery,0,'Mobile_Number');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan referral reward program</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<meta name="keywords" content="" />
<meta name="Description" content="" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/hl-referral-reward-program-styles.css" type="text/css" rel="stylesheet"  />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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
	if(!checkData(document.refFrm.mobile, 'Mobile number', 10))
		return false;

return true;
}
function chkformR()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var cnt;
var myOption;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

 
	if(document.refFrm.name.value=="")
	{
		document.getElementById('nameRVal').innerHTML = "<span  class='hintanchorqa'>Fill Your Name.</span>";	
		document.refFrm.name.focus();
		return false;
	}
 
	if(document.refFrm.email.value=="")
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter  Email Address!</span>";	
		document.refFrm.email.focus();
		return false;
	}
	
	var str=document.refFrm.email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.refFrm.email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.refFrm.email.focus();
		return false;
	}
	
	
  if(document.refFrm.mobile.value=="")
	{
		document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
		document.refFrm.mobile.focus();
		return false;
	}
  if(isNaN(document.refFrm.mobile.value)|| document.refFrm.mobile.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
        alert("Enter numeric value");
		  document.refFrm.mobile.focus();
		  return false;  
	}
    if (document.refFrm.mobile.value.length < 10 )
	{
            alert("Please Enter 10 Digits"); 
			 document.refFrm.mobile.focus();
			return false;
    }
    if ((document.refFrm.mobile.value.charAt(0)!="9") && (document.refFrm.mobile.value.charAt(0)!="8") && (document.refFrm.mobile.value.charAt(0)!="7"))
	{
            alert("The number should start only with 9 or 8 or 7");
			 document.refFrm.mobile.focus();
            return false;
	}
	
	if (document.refFrm.city.selectedIndex==0)
	{
		document.getElementById('cityRVal').innerHTML = "<span class='hintanchorqa'>Please Select City!</span>";
		document.refFrm.city.focus();
		return false;
	}
	
	if(!document.refFrm.accept.checked)
	{
		document.getElementById('acceptRVal').innerHTML = "<span class='hintanchorqa'>Accept the Terms and Condition!</span>";	
		document.refFrm.accept.focus();
		return false;
	}

	
}


</script>
<style>
.hintanchorqa {
    color: #F00;
    font-size: 11px;
    background: #FFF;
    padding: 0px 5px 0px 5px;
}
</style>
</head>
<body>
<form method="POST" onsubmit="return chkformR();" action="refer-for-home-loan-continue.php" name="refFrm">
<?php include "middle-menu.php"; ?>
<div class="hl-ref-bnr-bg">
<div class="hl-ref-bnr-container">
<h1>Let's <span>Share</span>, Sharing is <span>Caring</span></h1>
<p>The best way to multiply your happiness is to share it with others. </p>
<p>The more you share, the more you get. </p>
<p>Help your loved once to fulfill their dream and also get a reward.</p>
<h3>Refer & Earn Free gifts at <strong>deal4loans</strong> worth upto <span class="amount-big-size">Rs 20,000/-</span></h3>
<div class="hl-ref-bnr-form-container">
<div class="hl-ref-left-form">
<div class="hl-ref-form-head-box"><img src="new-images/down-arrow.png" /> Your Details</div>
<div class="hl-form-wrapper">
<div class="prefilled-text"><?php echo $r_name; ?></div>
<div class="prefilled-text"><?php echo $r_Email; ?></div>
<div class="prefilled-text"><?php echo $r_Mobile; ?></div>
<div class="prefilled-text"> <div class="group"> <input type="text"  name="r_alternate_number" id="r_alternate_number" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" /> <span class="highlight"></span>
      <span class="bar"></span>
      <label>Alternate Number</label>
    </div>
</div>
<div>Your <span>rewards</span> varies with the Loan Amount.</div>
<div class="rewards-box"><img src="new-images/goggles.png"/>
<p>Upto 25 Lakhs</p>
</div>
<div class="rewards-box"><img src="new-images/bags.png" />
<p>25 – 50 Lakhs</p>
</div>
<div class="rewards-box"><img src="new-images/mobiles.png" />
<p>50 -100 lakhs</p>
</div>
<div style="clear:both;"></div>
<div class="rewards-box-half">
<div class="rewards-box-half-inn"><img src="new-images/tablets.png" /> <p>1 – 2 Cr</p></div>
<div class="rewards-box-half-inn"><img src="new-images/laptop.png" /> <p>More than 
	2 Cr</p>
</div>
</div>


</div>
</div>
<div class="hl-ref-right-form">
<div class="hl-ref-right-form-head-box"><img src="new-images/moving-arrow.png" /> Refer A <strong>FRIEND</strong></div>
<div class="hl-form-wrapper">
    <input type="hidden" name="referrer_id"  readonly value="<?php echo $RequestID; ?>" /><input type="hidden" name="r_name" placeholder="Name" readonly value="<?php echo $r_name; ?>" />
  <input type="hidden" name="r_mobile" readonly value="<?php echo $r_Mobile; ?>" /><input type="hidden" name="r_email" readonly value="<?php echo $r_Email; ?>" />

    <div class="group">      
      <input type="text" name="name" id="name"  onkeydown="validateDiv('nameRVal');" /><div id="nameRVal"></div>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Name</label>
    </div>
      
    <div class="group">      
       <input type="text" name="email" id="email" onkeydown="validateDiv('emailRVal');" /><div id="emailRVal"></div>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Email</label>
    </div>
    <div class="group">      
    
    <input type="text"  name="mobile" id="mobile" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" /><div id="phoneRVal"></div>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Mobile</label>
    </div>
    <div class="group">      
      <select name="city" id="city"  onchange="validateDiv('cityRVal');" >
<?=plgetCityList($City)?>
</select>
<div id="cityRVal"></div>   

      <span class="highlight"></span>
      <span class="bar"></span>

    </div>
    <div class="checkbox-wrapper">
<input type="checkbox" name="accept" id="check-one" checked="checked" value="1" aria-required="true" class="checkbox" /> I hereby declare that I have obtained due consent from my friends/relatives referred above to share their contact details with Deal4Loans.com and that Deal4Loans.com may contact him/her to offer its Home Loan products. I shall be responsible to Deal4Loans., for any losses or claims that may be occasioned upon Deal4Loans., in the event that this declaration is found to be false.

<p>I have read the Terms and Conditions of the Deal4Loans - Referral Program.</p>

<p>I authorize Deal4Loans and/or its associates/subsidiaries/affiliates to contact me in this regard.</p>
    </div>

    <input name="" type="submit" class="hl-ref-right-btn" value="Submit" />

</div>
</div>
<div style="clear:both;"></div>

</div>
</div>


</div>






<div style="clear:both; height:15px;"></div>
<?php //include "responsive_footer.php"; ?>
</div>
<div class="hide_top_menu">
  <?php 
#include "footer_pl.php";
include("footer_sub_menu.php");
?>
</div>
 </form>
</body>
</html>