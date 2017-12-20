<?php
	//require 'scripts/functions.php';
	require 'scripts/db_init.php';
	session_start();
	//print_r($_SERVER['SCRIPT_FILENAME']);
	$msg = "Thank You, Your mail had been sent Successfully to your FRIENDS!!!!";

	$destinationurl=$_REQUEST["url"];

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

		$To_Name = $_REQUEST['To_Name'];
		$To_Email = $_REQUEST['To_Email'];
		$From_Name = $_REQUEST['From_Name'];
		$From_Email = $_REQUEST['From_Email'];
		$Message = $_REQUEST['message'];
		$form_URL = $_REQUEST['form_URL'];
		$urlname="http://www.deal4loans.com".$form_URL;
		$newMessage="<table><tr><td>$Message</td></tr><tr><td>$urlname</td></tr></table>";
		$To_Name = FixString($To_Name);
		$To_Email = FixString($To_Email);
		$From_Name = FixString($From_Name);
		$From_Email = FixString($From_Email);
		$Message = FixString($Message);

	$headers = 'From: '.$From_Name.' <'.$From_Email.'>' . "\r\n";
	$headers .= "Return-Path: <".$From_Email.">\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$Dated = ExactServerdate();
	mail($To_Email1, "Just Go Through this Site, its Exciting!!", $newMessage, $headers );
	$dataInsert = array('Name'=>$To_Name1, 'Email'=>$To_Email1, 'Phone'=>$Phone1, 'Friend_Name'=>$From_Name, 'Friend_Email'=>$From_Email, 'Friend_URL'=>$form_URL, 'Date'=>$Dated);
	$table = 'Tell_Friends';
		$insert = Maininsertfunc ($table, $dataInsert);
	if ($To_Email2!=null)
		{
	mail($To_Email2, "Just Go Through this Site, its Exciting", $newMessage, $headers );
	$dataInsert = array('Name'=>$To_Name2, 'Email'=>$To_Email2, 'Phone'=>$Phone2, 'Friend_Name'=>$From_Name, 'Friend_Email'=>$From_Email, 'Friend_URL'=>$form_URL, 'Date'=>$Dated);
	$table = 'Tell_Friends';
		$insert = Maininsertfunc ($table, $dataInsert);
	
		}
	if ($To_Email3!=null)
		{
	mail($To_Email3, "Just Go Through this Site, its Exciting", $newMessage, $headers);
	$dataInsert = array('Name'=>$To_Name2, 'Email'=>$To_Email2, 'Phone'=>$Phone2, 'Friend_Name'=>$From_Name, 'Friend_Email'=>$From_Email, 'Friend_URL'=>$form_URL, 'Date'=>$Dated);
	$table = 'Tell_Friends';
		$insert = Maininsertfunc ($table, $dataInsert);
	
		}
	//echo "<script language=javascript>alert('".$msg."');"." location.href='".$form_URL."'"."</script>";
	//echo "<script>window.close()"."</script>";
	}
?>
<html>
<head>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
</head>
<body>
<Script Language="JavaScript">
//window.resizeTo(510,550);

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
function validatetellMe()
	{
if(document.friend_frm.From_Name.value=="")
	{
		alert("Please fill your name.");
		document.friend_frm.From_Name.focus();
		return false;
	}

	if(document.friend_frm.From_Email.value=="")
	{
		alert("Please fill your Email.");
		document.friend_frm.From_Email.focus();
		return false;
	}
	if(document.friend_frm.From_Email.value!="")
	{
		if (!validmail(document.friend_frm.From_Email.value))
		{
			//alert("Please enter your valid email address!");
			document.friend_frm.From_Email.focus();
			return false;
		}
	}
	if(document.friend_frm.To_Email1.value=="")
	{
		alert("Please fill your Email.");
		document.friend_frm.To_Email1.focus();
		return false;
	}
	 if(document.friend_frm.To_Email1.value!="")
	{
		if (!validmail(document.friend_frm.To_Email1.value))
		{
			//alert("Please enter your valid email address!");
			document.friend_frm.To_Email1.focus();
			return false;
		}
	}
	if(document.friend_frm.To_Email2.value!="")
	{
		if (!validmail(document.friend_frm.To_Email2.value))
		{
			//alert("Please enter your valid email address!");
			document.friend_frm.To_Email2.focus();
			return false;
		}
		
	
	}
	if(document.friend_frm.To_Email3.value!="")
	{
		if (!validmail(document.friend_frm.To_Email3.value))
		{
			//alert("Please enter your valid email address!");
			document.friend_frm.To_Email3.focus();
			return false;
		}
		
	
	}
	//return true;
    }
	



/*function removeviewcomment()
{	
	document.getElementById('viewaddcomment').style.visibility = 'hidden';
	
 
}*/


    </Script>

 <form name="friend_frm" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validatetellMe();">
 <table width="500" border="0" cellpadding="2" cellspacing="0" bordercolor="#111111" class="blueborder" id="frm" style="border-collapse: collapse">
   <tr>
     <td colspan="2" align="Center" class="head1">Tell A Friend</td>
   </tr>
     
	  <tr>
     <td class="bodyarial11">Your Name</td>
     <td width="58%" class="bodyarial11" ><input name="From_Name"  type="text" class="form" size="30" style="margin-top:4px; font-size:11px; height:19px;"><input name="form_URL" type="hidden" class="form" size="30" value="<? echo $destinationurl ;?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Your Email Address</td>
     <td  class="bodyarial11"><input name="From_Email" type="text" class="form" size="30" style="height:19px; margin-top:4px; font-size:11px;"></td>
   </tr>
   <tr><td colspan="2">&nbsp;</td></tr>
   <tr><td colspan="2" style="border-top:1px solid black;border-bottom:1px solid black;">
   <table border="0 " width="100%">
   <tr><td width="50%" style="border-right:1px solid black;">
   <table border="0" width="100%" >
      <tr>
      <td class="bodyarial11" >Your Friend's Email ID</td></tr><tr>
     <td class="bodyarial11"><input name="To_Email1" type="text" class="form" size="30" style="height:19px; font-size:11px;"></td>
     
   </tr>
   <tr>
      <td class="bodyarial11">Your Friend's Email ID</td></tr><tr>
     <td class="bodyarial11">
     <input name="To_Email2" type="text" class="form" size="30" style="height:19px; font-size:11px;"></td>
    
   </tr>
   <tr>
                <td class="bodyarial11">Your Friend's Email ID</td></tr><tr>
     <td class="bodyarial11">
     <input name="To_Email3" type="text" class="form"size="30" style="height:19px; font-size:11px;"></td>
       </tr>
	   </table>
	   </td><td width="50%">
	   <table width="100%"><tr>
									<td class="bodyarial11"><b>
									&nbsp;Message: </b>(optional)</font></td>
									</tr><tr><td class="bodyarial11"><textarea name="message" cols="40" rows="5" style="font-size:11px;"></textarea></td>
								</tr>
								</table></td></tr>
								</table></td></tr>
  
  
   <tr>
     <td colspan="2"align="center"><input type="submit" class="bluebutton" value="Send Now" style="height:17px;"><br></td>
   </tr>
  </table>
 </form>    
 </body>
 </html>
 