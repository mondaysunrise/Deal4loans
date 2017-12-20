<?php
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	session_start();


	 function getTransferURL($pKey){
	$titles = array(
		'Chat' => 'Contents_chat.php'	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 2 URL=".$R_URL);
	}

//print_r($_POST);
	if(isset($_POST['submit']) && (isset($_POST['chat_city'])) )
	{
		$chat_name = $_REQUEST['chat_name'];
		$chat_email = $_REQUEST['chat_email'];
		$chat_city = $_REQUEST['chat_city'];
		$chat_contact = $_REQUEST['chat_contact'];
		
                $Creative = $_REQUEST['creative'];
		$Section = $_REQUEST['section'];

		$product_type = "Req_Loan_Personal";
		$chat_source ="live-chat";
		
		    $Dated = ExactServerdate();

			//	$chatlead="INSERT INTO Chat_Registered_User (Chat_Name,Chat_Email,Chat_Contact,Chat_City,Product_Type,Chat_Dated,Chat_Source,Creative, Section) Values ('$chat_name','$chat_email','$chat_contact','$chat_city', '$product_type', Now(),'$chat_source', '$Creative', '$Section')";
		//echo "hello::".$chatlead;
		
		$dataInsert = array("Chat_Name"=>$chat_name, "Chat_Email"=>$chat_email, "Chat_Contact"=>$chat_contact, "Chat_City"=>$chat_city, "Product_Type"=>$product_type, "Chat_Dated"=>$Dated, "Chat_Source"=>$chat_source, "Creative"=>$Creative, "Section"=>$Section);
$table = 'Chat_Registered_User';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
		//$chatresult=ExecQuery($chatlead);
		echo "<script language=javascript>window.open('http://www.websitealive7.com/1118/rRouter.asp?groupid=1118&departmentid=&websiteid=0','guest','width=500,height=500')</script>";
	//header("location: Contents_chat.php");
	//exit();
	}
//javascript:;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Chat Live Loans India | Personal Loans Chat | Home Loans Chat</title>
<meta name="keywords" content="Home Loans Chat, Deal4loans chat, Live chat, Business loan chat, Personal Loans chat, Chat calendar">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">

<style>

 input{
    border:1px solid #C77840;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color: #666666;
	font-weight:normal;
	height:15px;
	margin-bottom:8px;
	padding: 0px;
}

select{
    border:1px solid #C77840;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color: #666666;
	font-weight:normal;
	height:17px;
	margin:0px ;
	padding:0px;

}

.text{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;
color:#000000;
text-decoration:none;
padding-left:8px;
line-height:16px;
padding-right:8px;
}
.text b{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
color:#000000;
line-height:16px;
font-weight:bold;
text-decoration:none;
}
.frm-text{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
color:#062940;
font-weight:bold;
text-decoration:none;
padding-left:35px;
}
.headng{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
color:#FFFFFF;
font-weight:bold;
text-decoration:none;



}




</style>
<script language="javascript">


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

 function RegisterFrom()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

		
	if(document.chat_register_details.chat_name.value=="")
	{
			alert("Please enter your name!");
			document.chat_register_details.chat_name.focus();
			return false;
	
	}

	if(document.chat_register_details.chat_contact.value=="")
	{
			alert("Please enter your Mobile Number!");
			document.chat_register_details.chat_contact.focus();
			return false;
	
	}
	
		   if(document.chat_register_details.chat_contact.value=="")
		{
			alert("Please fill your mobile number.");
			document.chat_register_details.chat_contact.focus();
			return false;
		}
        if(isNaN(document.chat_register_details.chat_contact.value)|| document.chat_register_details.chat_contact.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  document.chat_register_details.chat_contact.focus();
			  return false;  
		}
        if (document.chat_register_details.chat_contact.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.chat_register_details.chat_contact.focus();
				return false;
        }
        if (document.chat_register_details.chat_contact.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 document.chat_register_details.chat_contact.focus();
                return false;
        }

	
	if(document.chat_register_details.chat_email.value!="")
	{
			if (!validmail(document.chat_register_details.chat_email.value))
			{
				document.chat_register_details.chat_email.focus();
				return false;
			}
	}
	if (document.chat_register_details.chat_city.selectedIndex==0)
	{
		alert("Please select City");
		document.chat_register_details.chat_city.focus();
		return false;
	}
	if (document.chat_register_details.product_type.selectedIndex==0)
	{
		alert("Please select product");
		document.chat_register_details.product_type.focus();
		return false;
	}
	
}
</script>

</head>

<body>

  <form name="chat_register_details" method="post" action="live-chat.php" onSubmit="return RegisterFrom();">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0"  style="border: 1px solid #1087D5;">
  <tr>
    <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
<td width="355" height="70" align="right" valign="middle"><img src="images/live-cht-tp-pl-txt.gif" width="259" height="55" /></td>
	<!--<td width="355" height="70" align="right" valign="middle"><img src="images/live-cht-tp-new-txt.gif" width="259" height="55" /></td>-->
    <td width="423" align="left"><img src="images/live-cht-tp-rgt-text.gif" width="307" height="55" /></td>
  </tr>
  <tr bgcolor="#FBFBF3">
    <td colspan="2" align="left"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr bgcolor="#D54710">
        <td width="201" height="23" align="left" valign="top"><img src="images/live-cht-cnt-lft.gif" width="201" height="23" /></td>
        <td width="100%" align="center" bgcolor="#D54710" class="headng">What Chat is All About?</td>
        <td width="201" height="23" align="right" valign="top"><img src="images/live-cht-cnt-rgt.gif" width="201" height="23" /></td>
      </tr>
      <tr>
        <td colspan="3" class="text" style="padding:5px 5px; border:1px solid #D54710; border-top:none;">It&rsquo;s a platform where you can interact with 4-5 banks at the same time &amp; get instant quotes
          <strong>Participating Banks: HDFC Bank,IDBI Bank, Kotak Bank and LIC Housing Finance</strong> &amp; many more&hellip;</td>
        </tr>
    </table></td>
    </tr>
  <tr bgcolor="#FBFBF3">
    <td  class="text"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td height="27" align="center" bgcolor="#B63C0D"><b style="color:#FFFFFF;">Live Chat Advantages</b></td>
      </tr>
      <tr>
        <td valign="top"> <ul style="padding-left:25px; padding-top:8px; margin-top:0px; margin-left:5px; list-style-type:decimal;">
		<li><b>Get instant quotes</b></li>
		<li><b>Compare rates across banks</b> </li>
		<li><b>Choose the best Deal</b></li>


		</ul></td>
      </tr>
      <tr>
        <td align="center" valign="bottom" ><b>All of this Live !</b></td>
      </tr>
    </table></td>
    <td style="padding-top:8px;"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="13" height="24" align="left" valign="top"><img src="images/live-cht-frm-lft-corn.gif" width="13" height="24" /></td>
            <td bgcolor="#2475C0" align="center" ><b class="headng">Participate in Live Chat</b></td>
            <td width="13" height="24"><img src="images/live-cht-frm-rgt-corn.gif" width="13" height="24" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td  colspan="2" height="10"></td>
      </tr>
      <tr>
        <td width="127" valign="top" class="frm-text">Name</td>
        <td width="173"><input name="chat_name" id="chat_name" type="text"  style="width:140px;" /></td>
      </tr>
      <tr>
	          <td valign="top" class="frm-text">Mobile</td>
        <td><input name="chat_contact" id="chat_contact" type="text"  style="width:140px;" maxlength="10"/></td>
      </tr>
      <tr>
	          <td valign="top" class="frm-text">Email Id</td>
        <td><input name="chat_email" id="chat_email" type="text"  style="width:140px;" /></td>
      </tr>
      <tr>
        <td valign="top" class="frm-text">City</td>
        <td><select size="1" name="chat_city" style="width:140px;"><option value="Please Select">Please Select</option><option value="Bangalore">Bangalore</option><option value="Chennai">Chennai</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Kolkata">Kolkata</option><option value="Mumbai">Mumbai</option><option value="Pune">Pune</option></select></td>
      </tr>
      
      <tr>
        <td height="35" valign="bottom"  colspan="2" align="center">		<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
		<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>"><input type="submit" value="Chat with Banks Now" style="height:20px; font-weight:bold;" name="submit" /></td>
      </tr>
      <tr>
        <td colspan="2" style="border-bottom:1px solid #2475C0;">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr bgcolor="#FBFBF3">
    <td colspan="2" class="text"><b>Testimonial</b><br />
    I think that the launch of a service like Live Chat from deal4loans.com has eased the loan. seeking and deal hunting process for the likes of me. I wish u guys all the success.<div style="float:right; margin-right:15px;" class="text"><b>Pooja</b></div></td>
  </tr>
</table>
</td>
  </tr>
</table>
</form>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
<?php 
if(isset($_POST['submit']) && (isset($_POST['chat_city'])) )
{
?>
<!-- Google Code for Lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1056387586;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
if (1.0) {
  var google_conversion_value = 1.0;
}
var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height="1" width="1" border="0" src="http://www.googleadservices.com/pagead/conversion/1056387586/?value=1.0&amp;label=lead&amp;script=0"/>
</noscript>
<?
echo "<script language=javascript>location.href='live-chat.php?r_url=".getTransferURL("Chat")."'"."</script>"; 
}
?>
</body>
</html>
