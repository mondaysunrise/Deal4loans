<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$DataSql = "select * from Req_Agent_Pay where A_ID = '".$_SESSION['insertedID']."'";
	$Data = ExecQuery($DataSql);
	$DataNumRows = mysql_num_rows($Data);
	$i=0;
	$A_Name = mysql_result($Data,$i,'A_Name');
	$A_Email = mysql_result($Data,$i,'A_Email');
	$City = mysql_result($Data,$i,'A_City');
	if($City =="Others")
	{
		$City = mysql_result($Data,$i,'A_City_Other');			
	}
	$A_Mobile = mysql_result($Data,$i,'A_Mobile');
	$A_Product = mysql_result($Data,$i,'A_Product');
	$Address  = mysql_result($Data,$i,'Address');
	$A_Date  = mysql_result($Data,$i,'A_Date');
	$pwd = mysql_result($Data,$i,'pwd');
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
.style2 {
	font-family: verdana;
	font-size: 11px;
	font-weight: bold;
	color:#084459;
}

.style3 {
	font-family: verdana;
	font-size: 11px;
	font-weight: normal;
	color:#084459;
	text-decoration:none;
}


.bluebtn{
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:12px;
font-weight:bold;
color:#084459;
border:1px solid #084459;
background-color:#FFFFFF;
}

</style>
<script type="text/javascript" src="scripts/common.js"></script>
<style>
.aplfrm{
background: none repeat scroll 0 0 #F6FCFF;
    border-left: 5px solid #A2D7F6;
    border-right: 5px solid #A2D7F6;
	}
</style>
<Script Language="JavaScript">

function cityother()
{
	if(agent_frm.city.value=="Others")
	{
		agent_frm.city_other.disabled = false;
	}
	else
	{
		agent_frm.city_other.disabled = true;
	}
}

function valButton3() {
    var cnt = -1;
	var i;
    for(i=0; i<document.agent_frm.Product.length; i++) 
	{
        if(document.agent_frm.Product[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}		



function validateMe(theFrm)
{
	var btn3;
	btn3=valButton3();
	if(theFrm.From_Name.value=="")
	{
		alert("Please enter Your Name");
		theFrm.From_Name.focus();
		return false;
	}
	
	if(theFrm.From_Email.value=="")
	{
		alert("Please enter  Email Address");
		theFrm.From_Email.focus();
		return false;
	}
	var str=theFrm.From_Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		alert("Please enter the valid Email Address");
		theFrm.From_Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Please enter the valid Email Address");
		theFrm.From_Email.focus();
		return false;
	}
	if(theFrm.Address.value=="")
	{
		alert("please enter Address!");
		theFrm.Address.focus();
		return false;
	}
	if (theFrm.city.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		theFrm.city.focus();
		return false;
	}
	if((theFrm.city.value=="Others") && (theFrm.city_other.value=="" || theFrm.city_other.value=="Other City"  ) || !isNaN(theFrm.city_other.value))
	{
		alert("Kindly fill your Other City!");
		theFrm.city_other.focus();
		return false;
	}
	if(theFrm.Mobile.value=="")
	{
		alert("Please Enter Mobile Number");
		theFrm.Mobile.focus();
		return false;
	}
	if(isNaN(theFrm.Mobile.value)|| theFrm.Mobile.value.indexOf(" ")!=-1)
	{
		alert("Enter numeric value");
		theFrm.Mobile.focus();
		return false;  
	}
	if (theFrm.Mobile.value.length < 10 )
	{
		alert("Please Enter 10 Digits"); 
		theFrm.Mobile.focus();
		return false;
	}
	if ((theFrm.Mobile.value.charAt(0)!="9") && (theFrm.Mobile.value.charAt(0)!="8")&& (theFrm.Mobile.value.charAt(0)!="7"))
	{
		alert("The number should start only with 9 or 8 or 7.");
		theFrm.Mobile.focus();
		return false;
	}
	if(!btn3)
	{
		alert('Please Select Product you deal in.');
		return false;
	}
	return true;
}
	</script>
</head><body>
<table width="1004" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
<?php 
include "agentregistration_header.php";
?>
</td></tr><tr><td align="center">
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
<tr><td >

<table width="458" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td>&nbsp;</td>
 </tr>
 <tr>
    <td height="74" valign="middle" background="images/apl-tp.gif" style="background-repeat:no-repeat; "><h2 style="color:#443133; font-size:17px;  margin:0 0 10px; padding:15px 0 3px; text-align:center; font-family:Arial, Helvetica, sans-serif;">Agent Payment Registration Details</h2></td>
  </tr>
  <tr>
    <td class="aplfrm"><table width="400" border="0" align="right" cellpadding="2" cellspacing="2"   >
      <tr>
        <td width="37%" height="26" valign="middle" class="frmbldtxt">Agent Name</td>
        <td width="63%" align="left"><?php echo $A_Name; ?></td>
      </tr>
       <tr>
        <td width="37%" height="26" valign="middle" class="frmbldtxt">Agent Name</td>
        <td width="63%" align="left"><?php echo $pwd; ?></td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Agent Email ID<font size="1" color="#FF0000">*</font></td>
        <td align="left"><?php echo $A_Email; ?></td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Address <font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmbldtxt"><?php echo $Address; ?>   </td>
      </tr>

      <tr>
        <td height="26" valign="middle" class="frmbldtxt">City <font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmbldtxt"><?php echo $City; ?>       </td>
      </tr>
    
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Mobile<font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmtxt">+91 
           <?php echo $A_Mobile; ?></td>
      </tr>
            <tr>
        <td height="26" valign="middle" class="frmbldtxt">Product deals in</td>
        <td align="left" class="frmtxt"> 
           <?php echo $A_Product; ?></td>
      </tr>
      
    </table></td>
  </tr>
   <tr>
          <td width="458" height="26"><img src="images/apl-bt.gif" width="458" height="26" /></td>
  </tr>
</table>
      



</td></tr>
 <tr><td align="center">&nbsp;</td>
 </tr></table>
</td></tr></table>
</td></tr></table>
</body>
</html>