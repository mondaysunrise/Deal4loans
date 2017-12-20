<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
			$$a=$b;

		$Type_Loan = FixString($Type_Loan);
		$fullname = FixString($fullname);
		$mobile = FixString($mobile);
		$email_id = FixString($email_id);
		$source = FixString($source);
		
		
		$_SESSION['Temp_Name'] = $fullname;
		$_SESSION['Temp_mobile'] = $mobile;
		$_SESSION['Temp_email'] = $email_id;
		$_SESSION['Temp_loan_type'] = $Type_Loan;

		if((strlen($fullname)>0) && (strlen($mobile)>0))
	{
		$sql = "INSERT INTO Req_Apply_Here( ApplyID, Name, Email, Contact, Product_Type, Source, Dated )
		VALUES ( '', '$fullname', '$email_id', '$mobile', '$Type_Loan', 'popup_pl', Now() )";
		ExecQuery($sql);
		//exit();
		$last_inserted_id = mysql_insert_id();
		
	}
	
echo "<script>window.close()"."</script>";
}

?>
<html>
<head>
<title>Personal Loan | Deal4loans| BimaDeals title tags</title>
<meta name="keywords" content="Personal Loan applying, Deal4loans, Bimadeals, Insurance" /> 
<meta name="description" content="Deal4Loans an loan information portal, provides information on Personal loan, Credit cards, Home loan, Car loan in India offered by ICICI, Barclays, SBI. Apply for best loan and credit card on Deal4loans.com">

<style>
.blue-line{
	font-size:12px;
	font-weight:bold;
	color:#FFFFFF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	}

.frmtext{
	font-size:11px;
	color:#000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	}

input{
	font-size:11px;
	color:#000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

select{
	font-size:11px;
	color:#000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

.bluebutton{
	font-size:12px;
	color:#000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	width:80px;
	height:23px;
	font-weight:bold;
	}
</style>
<script Type="text/javascript">
function getformdetails()
{
		var ni = document.getElementById('getquickform');
		
		if(ni.innerHTML=="")
		{
		
			ni.innerHTML = "<table bgcolor='#FFFFFF' width='225' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td colspan='2' height='22' valign='middle' bgcolor='#61a4e7' class='blue-line' align='center'>Quick Apply</td></tr><tr><td style='padding-top:5px;'><table width='95%'  border='0' align='center' cellpadding='0' cellspacing='0' > <tr><td width='40%' align='left' class='frmtext' height='23'>Product Type</td><td width='70%' align='right' class='frmtext'> <select style='width:130px;' name='Type_Loan'><option value='1'>Please select</option> <option value='Req_Credit_Card'>Credit Card</option> <option value='Req_Loan_Home'>Home Loan</option><option value='Req_Loan_Car'>Car loan</option> <option value='Req_Loan_Against_Property'>Loan against Property <option value='Req_Business_Loan'>Business Loan</option></select></td>	 </tr>  <tr align='left'><td colspan='2'><input type='hidden' name='source' value='QuickApply'></td></tr><tr> <td align='left' class='frmtext' height='23'>Full Name</td><td align='right' ><input type='text' name='fullname' style='width:130px;' maxlength='30'></td></tr><tr><td align='left' class='frmtext' height='23'>Mobile</td><td align='right'  class='frmtext'>+91<input type='text' style='width:100px;' maxlength='10' onChange='intOnly(this);' onKeyUp='intOnly(this);' onKeyPress='intOnly(this);' name='mobile'></td></tr>	 <tr><td align='left' class='frmtext' height='23'>Email id</td> <td align='right' ><input type='text' name='email_id' style='width:130px;'></td></tr><tr><td colspan='2'></td></tr><tr><td colspan='2' align='center' height='30'  class='frmtext'> <input type='submit' class='bluebutton' value='Submit' ></td></tr></table></td></tr></table>";
				

			
		}
		
		return true;

	}

function removeformdetails()
{
		var ni = document.getElementById('getquickform');
		
		if(ni.innerHTML!="")
		{
		
			ni.innerHTML = "";
				

			
		}
		
		return true;

	}


</script>
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
function chkform()
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
		alert("Please enter the type of loan you are looking for");
		document.loan_form.Type_Loan.focus();
		return false;
	}
	if(document.loan_form.fullname.value=="")
	{
		alert("Please fill your name.");
		document.loan_form.fullname.focus();
		return false;
	}
 
  if(document.loan_form.mobile.value=="")
	{
		alert("Please fill your mobile no.");
		document.loan_form.mobile.focus();
		return false;
	}
	  if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
		{
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
        if (document.loan_form.mobile.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 document.loan_form.mobile.focus();
                return false;
		}
/*	if(document.loan_form.mobile.value!="")
	{
		if (!validmobile(document.loan_form.mobile.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.mobile.focus();
			return false;
		}
	}
*/
	if(document.loan_form.email_id.value=="")
	{
		alert("Please fill your email id.");
		document.loan_form.email_id.focus();
		return false;
	}
	 if(document.loan_form.email_id.value!="")
	{
		if (!validmail(document.loan_form.email_id.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.email_id.focus();
			return false;
		}
		
	
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
<body >
<table width="504" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#2480dd">
  <tr>
    <td height="45" align="center" valign="middle" class="blue-line">Your Personal Loan request has been successfully submitted </td>
  </tr>
  <tr>
    <td height="2" align="center" valign="middle" ><img src="images/popup-b-line.gif" width="420" height="2"></td>
  </tr>
  <tr>
    <td height="25" align="center" class="blue-line">Do you want to apply for any other product?</td>
  </tr>
  <tr>
    <td height="25" align="center" valign="top"  class="blue-line">&nbsp;
        <input type="Radio" onClick="getformdetails()" name="other_product" value="1" >
      Yes
      <input type="Radio"	 name="other_product" value="0" onClick="removeformdetails();">
      No</td>
  </tr>
  
  <tr>
    <td  class="style4" align="center"><form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
      <div id="getquickform"></div>
    </form></td>
  </tr>
  <tr>
    <td height="47" valign="top"><img src="images/popup-blu-bot.gif" width="504" height="47"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="padding-top:15px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td rowspan="2"><!---<script language='JavaScript' type='text/javascript' src='http://ads.bimadeals.com/adx.js'></script>
              <script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.bimadeals.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=6&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
 <!-- </script>
          <noscript>
            <a href='http://ads.bimadeals.com/adclick.php?n=a02bf867' target='_blank'><img src='http://ads.bimadeals.com/adview.php?clientid=6&amp;n=a02bf867' border='0' alt=''></a>
          </noscript>--></td>
        <td width="180" height="63" align="center" valign="top"><img src="images/index_01.gif" width="180" height="63"></td>
      </tr>
      <tr>
        <td align="center" valign="top" class="frmtext" style="color:#0a529a;">Loans by Choice Not by Chance.</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>