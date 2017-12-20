<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_check.php';

$get_reqid = $_REQUEST['get_reqid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<style>
.frst_cl {
	color:#663300; 
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:12px;
}
.btnclr {
background-color:#006EAB;
border:medium none;
color:#FFFFFF;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:12px;
font-weight:bold;
height:25px;
width:120px;
}
</style>
<script>
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
function chkhlloan_frm()
{
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	

	if((document.getElementById('full_name').value=="") || (document.getElementById('full_name').value=="Name")|| (Trim(document.getElementById('full_name').value))==false)
	{
		alert("Kindly fill in your Name!");
		document.getElementById('full_name').focus();
		return false;
	}
	else if(containsdigit(document.getElementById('full_name').value)==true)
	{
		alert("Name contains numbers!");
		document.getElementById('full_name').focus();
		return false;
	}
	  for (var i = 0; i < document.getElementById('full_name').value.length; i++) {
		if (iChars.indexOf(document.getElementById('full_name').value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		document.getElementById('full_name').focus();
		return false;
		}
	  }
	if((document.getElementById('mobile').value=='Mobile No') || (document.getElementById('mobile').value=='') || Trim(document.getElementById('mobile').value)==false)
		{
			alert("Kindly fill in your Mobile Number!");
			document.getElementById('mobile').focus();
			return false;
		}
	else if(isNaN(document.getElementById('mobile').value)|| document.getElementById('mobile').value.indexOf(" ")!=-1)
		{
			alert("Enter numeric value in ");
			document.getElementById('mobile').focus();
			return false;  
		}
	else if (document.getElementById('mobile').value.length < 10 )
		{
			alert("Please Enter 10 Digits"); 
			document.getElementById('mobile').focus();
			return false;
		}
	else if ((document.getElementById('mobile').value.charAt(0)!="9") && (document.getElementById('mobile').value.charAt(0)!="8") && (document.getElementById('mobile').value.charAt(0)!="7"))
		{
			alert("The number should start only with 9 or 8 or 7");
			document.getElementById('mobile').focus();
			return false;
		}

	  if(document.getElementById('email').value=="")
	{
		alert("Please enter your valid email address!");
			document.getElementById('email').focus();
			return false;
			
		}
	if(document.getElementById('email').value!="")
	{
		if (!validmail(document.getElementById('email').value))
		{
			//alert("Please enter your valid email address!");
			document.getElementById('email').focus();
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
function Trim(strValue)
	{
		var j=strValue.length-1;i=0;
		while(strValue.charAt(i++)==' ');
		while(strValue.charAt(j--)==' ');

		return strValue.substr(--i,++j-i+1);
	}
</script>
</head>

<body>
<table width="990">
	<tr>
		<td  colspan="2" width="100%"><table width="100%" style="padding-left:5px; padding-top:5px;"><tr>
		<td width="197" height="117"><img src="new-images/first_blue_logo.jpg" width="188" height="117"/></td>
		<td width="773" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:26px; color:#F8C301; font-weight:450;">Get competitive offers on First Blue Home finance</td>
	</tr></table></td>
	</tr>
	<tr>
		<td colspan="2" valign="top" align="center"> 
			<table  >
 <tr>
        <td>&nbsp;</td>

      </tr>
      <tr>
        <td bgcolor="#FFFFFF">
		<form name="firstblue_hl_loan" method="post" action="apply_first_blue_thanks.php"  onSubmit="return chkhlloan_frm();">
				<input type="hidden" name="get_reqid" id="get_reqid" value="<? echo $_REQUEST['get_reqid']; ?>"/>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tr>
           
            <td width="817" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="450" align="center">
              <tr>
                <td height="30" bgcolor="#F08600" colspan="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#FFFFFF;"><table width="100%"><tr><td height="30" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#FFFFFF;" width="81%"><b>First Blue Home Loan Application</b></td>
              
                </tr></table></td>
              </tr>
              <tr>
			 			 
			               <td width="837" height="286" valign="top"  align="center" bgcolor="#F8C301">
				
            
				<table width="80%"  border="0" align="center" cellpadding="4" cellspacing="4" bgcolor="#F8C301">
  <tr align="center">
    <td height="11" colspan="4"></td>
  </tr>
  <tr>
	<td width="149" height="26" align="left" class="frst_cl">First Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

	<td width="200" align="left" class="frst_cl"><input style="width:150px;  height:21px;"  name="full_name" id="full_name" tabindex="1"></td>
	
   <tr>
                    <td class="frst_cl" align="left" valign="middle">Mobile No. <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
                    <td class="frst_cl" align="left" valign="middle"><input gtbfieldid="6" name="mobilestd" class="txtbox" id="mobilestd" value="91" style="width: 25px; background-color: rgb(229, 229, 229); text-align: center;" readonly="readonly" type="text"> <input type="text" name="mobile" id="mobile" maxlength="10"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" style="width:110px;"  class="txtbox" tabindex="2"/></td>
                  </tr> 
	<td height="26" align="left" class="frst_cl">Email <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frst_cl"><input  style="width:150px;  height:21px;"   name="email" id="email" tabindex="3"/></td>
   </tr>
    <tr>
				 <td colspan="2" class="form_txt" align="center" height="40" valign="bottom">
	  				 <input name="submit" type="submit" class="btnclr" value="Apply Now" />
				
				 </td> 
</table>
				
				
				</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table>
		</form></td>
      </tr>
     
	  </table>
		</td>
	</tr>
</table>
</body>
</html>
