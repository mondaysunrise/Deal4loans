<?php
	header("Location: index.php");
	exit();
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	session_start();


	if(isset($_POST['submit']) && (isset($_POST['chat_contact'])) && (isset($_POST['chat_city'])) )
{
		$chat_name = $_REQUEST['chat_name'];
		$chat_email = $_REQUEST['chat_email'];
		$chat_city = $_REQUEST['chat_city'];
		$chat_contact = $_REQUEST['chat_contact'];
		$product_type = $_REQUEST['product_type'];
		$chat_source ="Contents_Chat";

		$chatlead="INSERT INTO Chat_Registered_User (Chat_Name,Chat_Email,Chat_Contact,Chat_City,Product_Type,Chat_Dated,Chat_Source) Values ('$chat_name','$chat_email','$chat_contact','$chat_city', '$product_type', Now(),'$chat_source')";
		//echo "hello::".$chatlead;
		$chatresult=ExecQuery($chatlead);
		//echo "<script>alert('You have successfully registered for chat');</script>";
	//header("location:closepopup.php");

}
	?>
<html>
<head>

<title>Chat Live Loans India | Personal Loans Chat | Home Loans Chat</title>
<meta name="keywords" content="Home Loans Chat, Deal4loans chat, Live chat, Business loan chat, Personal Loans chat, Chat calendar">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Deal4loans has introduced the Concept of Live Chat, where you can Chat Live with Banks like HDFC, Citibank, Abn Amro Bank, Barclays Bank, IDBI Bank etc for Personal Loan and Home Loan.">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script language="javascript">
function addform()
{
  var ni = document.getElementById('insertform');
  
  if(ni.innerHTML=="")
  {
  
   if(document.chat_register_details.requestmailid.value="on")
   {
     ni.innerHTML = '<table  width="80%" style="border:1px solid #0F74D4;" bgcolor="#DAEAF9"><tr><td class="style4" align="center" colspan="2"><b> Kindly register for chat alert :</b></td></tr><tr><td colspan="2">&nbsp;</td></tr><tr><td style="float: left">Your Name:</td><td><INPUT TYPE="text" NAME="chat_name" value="<? echo $name;?>"></td></tr><tr><td  class="style4" style="float: left">Your E-mail Id:</td><td><INPUT TYPE="text" NAME="chat_email" value="<? echo $email;?>"></td></tr><tr><td  class="style4" style="float: left">Your Mobile Number:</td><td><INPUT TYPE="text" NAME="chat_contact"  value="<? echo $mobile;?>"maxlength="10" onChange="intOnly(this);" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);"></td></tr><tr><td  style="float: left">City</td><td><select size="1" name="chat_city" class="style4"><option value="Please Select">Please Select</option><option value="Bangalore">Bangalore</option><option value="Chennai">Chennai</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Kolkata">Kolkata</option><option value="Mumbai">Mumbai</option><option value="Pune">Pune</option></select></td></tr><tr><td style="float: left">Product</td><td><select name="product_type" class="style4"><OPTION value="-1" selected >Product Name</OPTION><OPTION value="Req_Loan_Personal">Personal Loan</OPTION><OPTION value="Req_Loan_Home">Home Loan</OPTION></select></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan="2" align="center"><INPUT class="bluebutton" TYPE="submit" name="submit" value="submit"></td></tr><tr><td>&nbsp;</td></tr><tr><td class="style4" align="center" colspan="2"><b>You will be sent an sms alert on the day of LIVE CHAT</b></td></tr></table>';
   
   }
  }
  
  return true;
 }


function removeform()
{
  var ni = document.getElementById('insertform');
  
  if(ni.innerHTML!="")
  {
  
   if(document.chat_register_details.requestmailid.value="on")
   {
    //alert( document.close_details.requestmailid.value);
    ni.innerHTML = '';
   }
  }
  
  return true;

 }

 function RegisterFrom()
{
		
	if(document.chat_register_details.chat_name.value=="")
	{
			alert("Please enter your name!");
			document.chat_register_details.chat_name.focus();
			return false;
	
	}
	if(document.chat_register_details.chat_email.value=="")
	{
			alert("Please enter your Email Address!");
			document.chat_register_details.chat_email.focus();
			return false;
	
	}
	if(document.chat_register_details.chat_contact.value=="")
	{
			alert("Please enter your Mobile Number!");
			document.chat_register_details.chat_contact.focus();
			return false;
	
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
<?php include '~Top.php';?>
<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent">
	  
	  <div align="center"><font class="head2">Chat</font><!--<font style="float:right;"><img src="images/chat_now1.gif" onClick="javascript:window.open('http://www.websitealive7.com/1118/rRouter.asp?groupid=1118&departmentid=&websiteid=0','guest','width=500,height=500');" style="cursor:pointer"></font>-->
	 
	   <?php
	  $today = date("Y-m-d H:i:s");
	 if(($today >"2008-11-26 09:30:00" && $today < "2008-11-26 15:30:00"))	
	{
	?>   <br><br>
	  <font style="float:right;"><img src="images/chat_now1.gif" onClick="javascript:window.open('http://www.websitealive7.com/1118/rRouter.asp?groupid=1118&departmentid=&websiteid=0','guest','width=500,height=500');" style="cursor:pointer"></font><br>
	<?php
	 } ?>
	 
	  <form name="chat_register_details" method="post" action="Contents_chat.php" onSubmit="return RegisterFrom();">
	  <?php
	/* $today = date("Y-m-d H:i:s");
		 if(($today >"2008-08-06 10:35:00" && $today < "2008-08-06 15:50:10"))
	{*/
	?>  
	<!--<font style="float:right;"><img src="images/chat_now1.gif" onClick="javascript:window.open('http://www.websitealive7.com/1118/rRouter.asp?groupid=1118&departmentid=&websiteid=0','guest','width=500,height=500');" style="cursor:pointer"></font>-->
	<?php
	// } ?>  
	  
	  </div>
	<br><br>
	
	  <table border="0">
	   <?php 
	   if(isset($_GET['source']))
	   {
	   ?>
	   <tr><td align="center">
	   <table  width="80%" style="border:1px solid #0F74D4;" bgcolor="#DAEAF9"><tr><td class="style4" align="center" colspan="2"><b> Kindly register for chat alert :</b></td></tr><tr><td colspan="2">&nbsp;</td></tr><tr><td style="float: left">Your Name:</td><td><INPUT TYPE="text" NAME="chat_name" value="<? echo $name;?>"></td></tr><tr><td  class="style4" style="float: left">Your E-mail Id:</td><td><INPUT TYPE="text" NAME="chat_email" value="<? echo $email;?>"></td></tr><tr><td  class="style4" style="float: left">Your Mobile Number:</td><td><INPUT TYPE="text" NAME="chat_contact"  value="<? echo $mobile;?>"maxlength="10" onChange="intOnly(this);" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);"></td></tr><tr><td  style="float: left">City</td><td><select size="1" name="chat_city" class="style4"><option value="Please Select">Please Select</option><option value="Bangalore">Bangalore</option><option value="Chennai">Chennai</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Kolkata">Kolkata</option><option value="Mumbai">Mumbai</option><option value="Pune">Pune</option></select></td></tr><tr><td style="float: left">Product</td><td><select name="product_type" class="style4"><OPTION value="-1" selected >Product Name</OPTION><OPTION value="Req_Loan_Personal">Personal Loan</OPTION><OPTION value="Req_Loan_Home">Home Loan</OPTION></select></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan="2" align="center"><INPUT class="bluebutton" TYPE="submit" name="submit" value="submit"></td></tr><tr><td>&nbsp;</td></tr><tr><td class="style4" align="center" colspan="2"><b>You will be sent an sms alert on the day of LIVE CHAT</b></td></tr></table>	   
	   </td></tr>
	   <?php }
	   else {
	    ?>
	   
	<tr>
       <td ><font style="font-size:13px;color:#0F74D4;font-weight:bold;font-family:verdana;">Want to participate in the</font> <font class="head2">LIVE CHAT </font><font style="font-size:13px;color:#0F74D4;font-weight:bold;font-family:verdana;">with banks : </font>&nbsp;<input type="radio"  name="requestmailid" class="NoBrdr"  value="1" onClick="addform();" ><font style="font-size:13px;color:#0F74D4;font-weight:bold;font-family:verdana;"> Yes&nbsp;</font>
   <input type="radio" class="NoBrdr" name="requestmailid" value="0" onClick="removeform();"><font style="font-size:13px;color:#0F74D4;font-weight:bold;font-family:verdana;"> No</font></td>
       </tr>
	    <tr><td id="insertform" align="center"></td></tr>
		<?php } ?>
		
	  <tr><td>&nbsp;</td></tr>
	  <tr><td><font class="head2">Chat Faqs</font></td></tr>
     <tr><td> <p> 
	 Deal4Loans introduced this chat to help you interact live with different banks and thus compare quotes and close the deal All of this LIVE!!! Wondering what it is ? <a href="http://www.deal4loans.com/chat.php">click here</a> to know more.</p>
	 </td></tr>
	 <tr><td><a href="http://www.deal4loans.com/chatcalender.php"><font class="head2"><u>Chat Calendar</a></u></font></td></tr>
	 <tr><td><p>  Deal4loans, your very own portal for online loan comparisons, offers you the opportunity to chat live with the banks of your choice and even close the deal online!!! <!--Just <a href="http://www.deal4loans.com/chatcalender.php">click here</a> to know when the next chat is. --></p>
	 </td></tr>
	 <tr><td>
	 <p><a href="http://www.deal4loans.com/chat/Live_chat_Demo.pdf" target="_blank"><font class="head2"><u>How does it work?</u></font></a></p></td></tr>
	
	  
	 </table>
<script language="javascript">
	function wsa_include_js(){
		var js = document.createElement('script');
		js.setAttribute('language','javascript');
		js.setAttribute('type','text/javascript');
		js.setAttribute('src','http://www.websitealive7.com/1118/Visitor/vTracker_v2.asp?groupid=1118&departmentid=');
		document.getElementsByTagName('head').item(0).appendChild(js);
	}
	window.onload = wsa_include_js;
</script>
	 </form>
    </div>
 <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right1.php';
  }
  ?>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>