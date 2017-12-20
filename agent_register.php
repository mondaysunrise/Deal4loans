<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

function generatePasswordPWD($length = 10) {
    $chars = 'abcdefghjkmnpqrstuvwxyz23456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}
	$msg = "Thank You, You will be soon contacted by our Executive";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$From_Name = $_REQUEST['From_Name'];
		$From_Email = $_REQUEST['From_Email'];
		$From_City = $_REQUEST['city'];
		$From_City_Other = $_REQUEST['city_other'];
		
		$Mobile = $_REQUEST['Mobile'];
		$Products = $_REQUEST['Product'];
		$Company = $_REQUEST['Company'];
		$query_type = $_REQUEST['query_type'];
		$product_type =$_REQUEST['product_type'];
		$pwd = generatePasswordPWD();
		$Address = $_POST['Address'];
		
		$Product = implode(',', $Products);

		$DataSql = "select * from Req_Agent_Pay where A_Mobile = '".$Mobile."'";

		$Data = ExecQuery($DataSql);
		$DataNumRows = mysql_num_rows($Data);
		if($DataNumRows>0)
		{
			$Msg = "Agent Mobile Number Already Exists.";
		}
		else
		{
			$Sql = "INSERT INTO `Req_Agent_Pay` (`A_Name` , `A_Email` , `A_City` , `A_City_Other` , `A_Mobile` , `A_Product` , `A_Company`, `A_Date`, `A_Query_Type`, pwd, Address  ) VALUES ('".$From_Name."', '".$From_Email."', '".$From_City."', '".$From_City_Other."', '".$Mobile."', '".$Product."', '".$Company."', Now(), '".$Product."', '".$pwd."', '".$Address."')";
	//		echo "query".$Sql;
			ExecQuery($Sql);
			$insertedID = mysql_insert_id();
			
				$message = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>	  <tr>		<td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>	  </tr>	  <tr>		<td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>		  <tr>			<td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>			<td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>			  <tr><td align='left'>	<table width='88%' border='0' align='center' cellpadding='3' cellspacing='2'>	<tr><td width='100%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr>	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Dear ".$From_Name.",</strong></td>	<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>&nbsp;</td></tr>	<tr>	  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'>Please login your account to make the Payment for your package.</td>	</tr>";	$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>";
	$message .= "<p><strong>URL</strong> : http://www.deal4loans.com/agentregistration.php</p>";
	$message .= "<p><strong>Username</strong> : ".$From_Email."</p>";	
	$message .= "<p><strong>Password</strong> : ".$pwd."</p>";
	$message .= "</td></tr>";
	$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr>	</table> 	</td>	</tr>	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>	<b>Regards</b> <br />	Team Deal4loans.com<br />	Loans by choice not by chance!!<br />	</td>			  </tr>			  </table></td>			<td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>		  </tr>		</table></td>	  </tr>	  <tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>		  </tr>	</table>";
//	echo $message;
	
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$SubjectLine = "Agent Login for Payment on Deal4loans.com";

	mail($From_Email, $SubjectLine, $message, $headers);

			
			$_SESSION['insertedID'] = $insertedID;
			header("Location: agent_register_continue.php");
			exit();
			
			
		}
	}
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

<form name="agent_frm" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
<table width="458" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td>&nbsp;</td>
 </tr>
 <tr>
    <td height="74" valign="middle" background="images/apl-tp.gif" style="background-repeat:no-repeat; "><h2 style="color:#443133; font-size:17px;  margin:0 0 10px; padding:15px 0 3px; text-align:center; font-family:Arial, Helvetica, sans-serif;">Agent Payment Registration</h2></td>
  </tr>
   
  <tr>
    <td class="aplfrm"><table width="400" border="0" align="right" cellpadding="2" cellspacing="2"   >
     <tr>
				 <td align="center" id="Alert" class="frmbldtxt" height="27" colspan="2">&nbsp; <span class="bodyarial11" style="color:#FF0000;"><? echo $Msg ?></span></td>
			   </tr>
      <tr>
        <td width="37%" height="26" valign="middle" class="frmbldtxt"> Name<font size="1" color="#FF0000">*</font></td>
        <td width="63%" align="left"><input name="From_Name" type="text" class="form" style="width:150px;" /></td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt"> Email ID<font size="1" color="#FF0000">*</font></td>
        <td align="left"><input name="From_Email" type="text" class="form" style="width:150px;" /></td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Address <font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmbldtxt"><input name="Address" type="text" class="form" style="width:150px;" />    </td>
      </tr>

      <tr>
        <td height="26" valign="middle" class="frmbldtxt">City <font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmbldtxt"><select size="1" name="city" id="city" onChange="cityother()"  style="width:155px;">
            <?=getCityList($city)?>
          </select>        </td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Other City<font size="1" color="#FF0000">*</font></td>
        <td width="63%" align="left" class="frmbldtxt"><input type="text" name="city_other" id="city_other" disabled="disabled" value="Other City" onFocus="this.select();" style="width:150px;" /></td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Mobile<font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmtxt">+91 
            <input name="Mobile" id="Mobile" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; type="text" class="form"  style="width:123px;" maxlength="10" /></td>
      </tr>
      <tr>
        <td valign="middle" class="frmbldtxt" colspan="2">
            <table width="430" border="0" align="right"  cellpadding="0" cellspacing="0">
              <tr>
                <td width="159" valign="top" class="frmbldtxt">Product deals in<font size="1" color="#FF0000">*</font></td>
                <td width="271" align="left" valign="middle" class="frmtxt">
                <table cellpadding="3"><tr><td>                
                <input type="checkbox" value='Personal Loan'class="NoBrdr" id="Product" name="Product[]"  style="border:none;"/>
                  Personal Loan </td><td>
                  <input type="checkbox" value='Home Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Home Loan </td></tr><tr><td>
                  <input type="checkbox" value='Car Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Car Loan</td><td>
                  <input type="checkbox" value='Loan Against Property' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Loan Against Property</td></tr><tr><td>
                  <input type="checkbox" value='Business Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Business Loan</td><td><input type="checkbox" value='Credit Card' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Credit Card</td></tr>
                  <tr><td>
                  <input type="checkbox" value='Life Insurance' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Life Insurance</td><td><input type="checkbox" value='Health Insurance' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Health Insurance</td></tr>
                  
                  </table></td>
              </tr>
            </table>

           </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><br />
            <input name="submit" type="submit" class="btnclr" value="Submit" /></td>
      </tr>
    </table></td>
  </tr>
   <tr>
          <td width="458" height="26"><img src="images/apl-bt.gif" width="458" height="26" /></td>
  </tr>
</table>
        </form>



</td></tr>
 <tr><td align="center">&nbsp;</td>
 </tr></table>
</td></tr></table>
</td></tr></table>
</body>
</html>