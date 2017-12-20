<?php
//ob_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(isset($_POST['submit']) && (isset($_POST['Email'])) )
{
	$requestmailid = $_POST['requestmailid'];
	$Name=$_POST['Name'];	
	$Email=$_POST['Email'];	
	$Contact=$_POST['Contact'];	
	$PageName = "Business Loan";
	$sql = "INSERT INTO Req_Apply_Here (Name , Email , Contact , Referred_Page, Dated ) VALUES ( '".$Name."', '".$Email."', '".$Contact."', '".$PageName."', Now())";

			$result = ExecQuery($sql);

	header("location:closepopup.php");

}
else 
{

?>
<html>
<head>
<title>Credit Card | Deal4loans</title>
<meta name="keywords" content="Business Loan applying, Deal4loans, Bimadeals, Insurance" /> 
<meta name="description" content="Deal4Loans an loan information portal, provides information on Personal loan, Credit cards, Home loan, Car loan in India offered by ICICI, Barclays, SBI. Apply for best loan and credit card on Deal4loans.com">
<style>
.style1{
font-size:12px;
line-height:150%;
color:68718A;
font-weight:bold;
font-Family:Verdana;
}
.style5{
font-size:14px;
font-weight:bold;
color:0F74DA;
font-Family:Verdana;
}

.style4{
font-size:14px;
font-weight:bold;
color:666699;
font-Family:Verdana;
}
.style3{
font-size:12px;
color:68718A;
font-weight:bold;
line-height:150%;
font-Family:Verdana;
}
.style2{
font-size:12.5px;
color:white;

font-weight:bolder;
font-Family:Verdana;
}
input, select {font:12px Arial; padding:2px; margin:0px; border: 1px solid #68718A;}
input.NoBrdr	{font:12px Arial; padding:0px; margin:0px; border: 0px}
</style>

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript">


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



 function checkNumber(data, msg, reqLen){
	if((data.value == "") || (data.value.length < reqLen)) {
		alert('Please enter '+msg+' with atleast '+reqLen+' digits.');
		data.focus();
		return false;
	}
	return true;
   }

function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkNumber(document.close_details.Contact, 'Mobile number', 10))
		return false;

return true;
}

 
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	
	if(document.close_details.Email.value=="")
	{
			alert("Please enter your email address!");
			document.close_details.Email.focus();
			return false;
	
	}


	if(document.close_details.Email.value!="")
	{
		if (!validmail(document.close_details.Email.value))
		{
			alert("Please enter your valid email address!");
			document.close_details.Email.focus();
			return false;
		}
	}
	
	if(document.close_details.Contact.value!="")
	{
		if (!validmobile(document.close_details.Contact.value))
		{
			//alert("Please enter your valid email address!");
			document.close_details.Contact.focus();
			return false;
		}
	}
	
}


function addElement()
{
  var ni = document.getElementById('myDiv');
  
  if(ni.innerHTML=="")
  {
  
   if(document.close_details.requestmailid.value="on")
   {
    ni.innerHTML = '<table><tr><td  align="left" class="style4" style="float: left" > Kindly register your e-mail Id :</td></tr><tr><td class="style4" style="float: left">Your Name:&nbsp;&nbsp;&nbsp;</td><td><INPUT TYPE="text" NAME="Name"></td></tr><tr><td  class="style4" style="float: left">Your E-mail Id:&nbsp;&nbsp;&nbsp;</td><td><INPUT TYPE="text" NAME="Email"></td></tr><tr><td  class="style4" style="float: left">Your Mobile Number:&nbsp;&nbsp;&nbsp;</td><td><INPUT TYPE="text" NAME="Contact"  maxlength=10 onChange="intOnly(this);" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);"></td></tr><tr><td></td><td><INPUT TYPE="submit" name="submit" value="submit"></td></tr></table>'; 
   }
  }
  
  return true;
 }


function removeElement()
{
  var ni = document.getElementById('myDiv');
  
  if(ni.innerHTML!="")
  {
  
   if(document.close_details.requestmailid.value="on")
   {
    //alert( document.close_details.requestmailid.value);
    ni.innerHTML = '';
   }
  }
  
  return true;

 }



 </script>

</head>
<body>
 <form name="close_details" method="post" action="closedby_cl.php" onSubmit="return chkform();">
 <table border="0" cellpadding="4" cellspacing="0" align="center">
 <tr>
                
      <td valign="top" align="left" class="style5"><img src="images/logo_thumb.gif" alt="Deal4Loans">&nbsp;&nbsp;&nbsp;Loans by Choice Not by Chance.</td>
     <td ></td>
   </tr>
<tr><td><hr></td></tr>
<tr><td>&nbsp;</td></tr>
      <tr>
                <td  class="style4" style="float: left">Were you looking for some other Loan?</td>
     <td class="bodyarial11"></td>

   </tr>
    
      <tr>
             
     <td>
	 <div id="dvFTMenu">
	<a href="Contents_Personal_Loan.php?popup=popup"><font style="color:blue;font-family:Verdana ;font-size:12px;font-weight:bolder;">Personal Loan</a>&nbsp;&nbsp;&nbsp;
	<a href="Contents_Home_Loan.php?popup=popup"><font style="color:blue;font-family:Verdana ;font-size:12px;font-weight:bolder;">Home Loan</a>&nbsp;&nbsp;&nbsp;
	<!-- <a href="Contents_Car_Loan.php?popup=popup"><font style="color:blue;font-family:Verdana ;font-size:9px;font-weight:bolder;">Car Loan</a>&nbsp;&nbsp;&nbsp;-->
	 <a href="Contents_Credit_Card.php?popup=popup" ><font style="color:blue;font-family:Verdana ;font-size:12px;font-weight:bolder;">Credit Card</a>&nbsp;&nbsp;&nbsp;
	 <a href="Contents_Loan_Against_Property.php?popup=popup"><font style="color:blue;font-family:Verdana ;font-size:12px;font-weight:bolder;">Loan Against Property</a>
	 </div></td>

   </tr>

<tr><td>&nbsp;</td></tr>
	   <tr>
       <td  class="style4" style="float: left">Need further updates on loan products <input type="radio"  name="requestmailid" class="NoBrdr"  value="1"  onclick="addElement();" ><font class="style4">Yes</font>
   <input type="radio" class="NoBrdr" name="requestmailid" value="0" onclick="removeElement();"><font class="style4"  >No</font></td>
       <td class="bodyarial11"></td>
     </tr>
	  
	  <tr>
      
	    <td  id="MyDiv"></td><td></td></tr>
		<!--	
	 <tr>
                <td  class="style4" style="float: left">Are you looking for some other information on Loan?</td>
     <td class="bodyarial11"></td>

   </tr>
 
      <tr>
              <td>
			  
			  <div id="dvFTMenu">
	 <a href="http://deal4loans.com/Contents_Personal_Loan_Mustread.php" target="_blank"><font style="color:blue;font-family:Verdana ;font-size:9px;font-weight:bolder;">Personal Loan</a>&nbsp;&nbsp;&nbsp;
	 <a href="http://deal4loans.com/Contents_Home_Loan_Mustread.php" target="_blank"><font style="color:blue;font-family:Verdana ;font-size:9px;font-weight:bolder;">Home Loan</a>&nbsp;&nbsp;&nbsp;
	 <a href="http://deal4loans.com/Contents_Car_Loan_Mustread.php" target="_blank" ><font style="color:blue;font-family:Verdana ;font-size:9px;font-weight:bolder;">Car Loan</a>&nbsp;&nbsp;&nbsp;
	 <a href="http://deal4loans.com/Contents_Credit_Card_Mustread.php" target="_blank"> <font style="color:blue;font-family:Verdana ;font-size:9px;font-weight:bolder;">Credit Card</a>&nbsp;&nbsp;&nbsp;
	 <a href="http://deal4loans.com/Contents_Loan_Against_Property_Mustread.php" target="_blank"><font style="color:blue;font-family:Verdana ;font-size:9px;font-weight:bolder;">Loan Against Property</a>
	 </div></td></tr>-->
</table>

</form>
</body>
</html>
<?php 
}
?>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>