<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//define("ENABLELOGIN", 1);
//for session variables
foreach ($_SESSION as $key=>$val)
 $sessionVar.= $key." ".$val."\n";
//print_r($_SESSION);
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

function removeEmpty($array) {
  return array_filter($array, '_remove_empty_internal');
}

function _remove_empty_internal($value) {
  return !empty($value) || $value === 0;
}

function ucfirstArr($arr)
{
	$newarr = '';
	foreach($arr as $value) { $newarr[] = ucfirst($value); }
	return $newarr;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$product = $_POST['product'];
	$fname = $_POST['fname'];
	$source = $_POST['source'];
	$standard_fields = $_POST['standard_fields'];
	$standardfieldsStr = implode(",", $standard_fields);
	$custom_fields = $_POST['custom_fields'];
	$customfieldsStr = implode(",", $custom_fields);
	$custom_fields_captions = ucfirstArr(removeEmpty($_POST['custom_fields_captions']));
	$customfieldscaptionsStr = implode(",", $custom_fields_captions);
	$username = $_POST['username'];
	$pwd = $_POST['pwd'];
	$status = 1;
	$userOK = '';
	$checkdata=" SELECT Email FROM Bidders WHERE Email='".$username."' ";
	$query=ExecQuery($checkdata);
	if(mysql_num_rows($query)>0)
	{ $userOK = 'No'; }
	else { $userOK = 'Yes'; }
	
	$checkdata1=" SELECT source FROM manual_user_details WHERE source='".$source."' ";
	$query1=ExecQuery($checkdata1);
	if(mysql_num_rows($query1)>0)
	{ $sourceOK = 'No'; }
	else { $sourceOK = 'Yes'; }
	
	if($sourceOK == 'Yes' &&  $userOK == 'Yes')
	{
		$insertBidderSql = "insert into Bidders (Email,PWD,Bidder_Name,Associated_Bank,Join_Date,Is_Verified, Reply_Type, leadidentifier) values ('".$username."', '".$pwd."', '".$fname."', '".$fname."', Now(), 80, 1, '".$source."')";
		$insertQuery = ExecQuery($insertBidderSql);
		$lastID = mysql_insert_id();
	
		$insertSql = "insert into manual_user_details (username, pwd, firstname, standard_fields, custom_fields, custom_fields_captions, source, dated, usertype, status, product, BidderID) Values ('".$username."', '".$pwd."', '".$fname."', '".$standardfieldsStr."', '".$customfieldsStr."', '".$customfieldscaptionsStr."', '".$source."', Now(), '".$usertype."', '".$status."', '".$product."', '".$lastID."')";
		$insertQuery = ExecQuery($insertSql);
		$msg  = "User Created Successfully";
	}
	else
	{
		$msg  = "User Not Created";
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
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
<?php 
	
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	
?>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
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
<script type="text/JavaScript">

// date function finish here
//ebable disable button
function disableIt(obj)
{
	obj.disabled = !(obj.disabled);
	var z = (obj.disabled) ? 'disabled' : 'enabled';
	//alert(obj.type + ' now ' + z);
}
// enable disable finish here		
//-->
function sendmail(form)
{
	var gifName = form;
	document.frmsearch.action="leads_consolidate.php?search=y"+gifName;
	document.frmsearch.submit();
}
function chkform()
{
		
	if(document.frmsearch.fname.value=="")
	{
		alert("Enter First Name.");
		document.frmsearch.fname.value="";
		document.frmsearch.fname.focus();
		return false;
	}
	if(document.frmsearch.source.value=="")
	{
		alert("Enter source.");
		document.frmsearch.source.value="";
		document.frmsearch.source.focus();
		return false;
	}
	if(document.frmsearch.username.value=="")
	{
		alert("Enter User Name.");
		document.frmsearch.username.value="";
		document.frmsearch.username.focus();
		return false;
	}
	var str=frmsearch.username.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					frmsearch.username.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					frmsearch.username.focus();
					return false;
					}
	
	if(document.frmsearch.pwd.value=="")
	{
		alert("Enter Password.");
		document.frmsearch.pwd.value="";
		document.frmsearch.pwd.focus();
		return false;
	}
}

</script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

    function checkname()
    {		
	   var name = document.getElementById("fname").value;
	  if(name)
	   {
	        $.ajax({ type: 'post',  url: 'manualcheck_data.php',  data: {  fname:name, },
			   success: function (response) {
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	   }
	   else
	   { $( '#name_status' ).html("");  return false;  }
	}

	function checksource()
    {
	   var source=document.getElementById( "source" ).value;
	   if(source)
	   {
	       $.ajax({ type: 'post', url: 'manualcheck_data.php', data: { source:source, },
			   success: function (response) {
			   $( '#source_status' ).html(response);
		       if(response=="OK") { return true; }  else { return false; }
             }
		   });
	    }
	    else
	    { $( '#source_status' ).html(""); return false; }
	}
    
	function checkusername()
    {
	   var username=document.getElementById( "username" ).value;
	   if(username)
	   {
	       $.ajax({ type: 'post', url: 'manualcheck_data.php', data: { username:username, },
			   success: function (response) {
			   $( '#username_status' ).html(response);
		       if(response=="OK") { return true; }  else { return false; }
             }
		   });
	    }
	    else
	    { $( '#username_status' ).html(""); return false; }
	}
 
</SCRIPT>
</head>
<body>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
    <tr><td align="right" style="padding-right:10px;">
		<a href="manual_leads_user_view.php" style="color:#FFFFFF;"><b>View User</b></a> &nbsp;&nbsp;		<a href="manual_leads_user_add.php" style="color:#FFFFFF;"><b>Add User</b></a> &nbsp;&nbsp;	<a  href="manual_data_upload.php" style="color:#FFFFFF;"><b>Upload Data</b></a> &nbsp;&nbsp;
	</td></tr>
	
 <tr><td align="center"> 
 <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle">&nbsp;</td>
   </tr>
   <?php 
   if(strlen($msg)>0)
   {
   ?>
   <tr>
     <td height="30" align="center" valign="middle" style="font-size:14px; font-weight:bold;"><?php echo $msg; ?></td>
   </tr>
   <tr>
     <td height="30" align="center" valign="middle">&nbsp;</td>
   </tr>
   <?php
   }
   ?>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif">
   <form name="frmsearch" action="manual_leads_user_add.php" method="post" onSubmit="return chkform();"> 
     <table width="95%" border="0" cellpadding="3" cellspacing="3">
<tr><td colspan="3">&nbsp;</td></tr>
   <tr><td colspan="3">&nbsp;</td></tr>
   
   <tr><td colspan="3" style="font-size:16px; font-weight:bold; text-align:center;">Add User</td></tr>
   <tr><td colspan="3">&nbsp;</td></tr>
  
<tr><td valign="middle"  colspan="3">&nbsp;</td></tr>
<tr><td width="39%" valign="middle" style="padding-left:20px;" class="style1" >Product:</td>
	<td width="61%" align="left" valign="middle" class="bidderclass">
		<select name="product" id="product" style="width:245px;">
<option value="Req_Loan_Personal">Personal Loan</option>
<option value="Req_Loan_Home">Home Loan</option>
</select>
</td></tr>
<tr><td width="39%" valign="middle" style="padding-left:20px;" class="style1" >Name:</td>
	<td width="61%" align="left" valign="middle" class="bidderclass">
		<input type="text" name="fname" id="fname" value="" style="width:330px;" /><!-- <input type="button" name="chkName" value="Check Name Availability" onClick="checkname()" /><span id="name_status" style="color:#F00; font-weight:bold;"></span>-->
</td></tr>
<tr bgcolor="#CCCCCC"><td width="39%" valign="middle" style="padding-left:20px;" class="style1" >Source:</td>
	<td width="61%" align="left" valign="middle" class="bidderclass">
		<input type="text" name="source" id="source" value="" style="width:330px;"  /> <input type="button" name="chkSource" value="Check Source Availability" onClick="checksource()" /><span id="source_status" style="color:#F00; font-weight:bold;"></span>
</td></tr>
<tr><td width="39%" valign="middle" style="padding-left:20px;" class="style1" >Standard Fields:</td>
<td width="61%" align="left" valign="middle" class="bidderclass">
    <table border="0" width="99%" cellpadding="2" cellspacing="2">
	<tr>
    	<td><input type="checkbox" name="standard_fields[]" id="standard_fields" value="Name" checked /> Name</td>
    	<td><input type="checkbox" name="standard_fields[]" id="standard_fields" value="Mobile_Number" checked /> Mobile</td>
        <td><input type="checkbox" name="standard_fields[]" id="standard_fields" value="City" /> City</td>
    </tr>
    <tr>
        <td><input type="checkbox" name="standard_fields[]" id="standard_fields" value="City_Other" /> Other City</td>
        <td><input type="checkbox" name="standard_fields[]" id="standard_fields" value="Net_Salary" checked /> Salary</td>
        <td><input type="checkbox" name="standard_fields[]" id="standard_fields" value="Email" checked /> Email</td>
    </tr>
    <tr>
        <td><input type="checkbox" name="standard_fields[]" id="standard_fields" value="DOB" /> Date of Birth</td>
        <td colspan="2"><input type="checkbox" name="standard_fields[]" id="standard_fields" value="Loan_Amount"  /> Loan Amount</td>
    
    </tr>    
    </table>
</td></tr>
<!--
<tr bgcolor="#CCCCCC"><td width="39%" valign="middle" style="padding-left:20px;" class="style1" >Custom Fields:</td>
<td width="61%" align="left" valign="middle" class="bidderclass">
    <table border="0" width="96%" cellpadding="2" cellspacing="2">
	<tr>
    	<td><input type="checkbox" name="custom_fields[]" id="custom_fields" value="default1" /> Default1 (<input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
    	<td><input type="checkbox" name="custom_fields[]" id="custom_fields" value="default2" /> 
    	Default2  (
    	  <input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
    </tr>
    <tr>
        <td><input type="checkbox" name="custom_fields[]" id="custom_fields" value="default3" /> Default3 (<input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
    
        <td><input type="checkbox" name="custom_fields[]" id="custom_fields" value="default4" /> Default4  (<input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
        </tr>
    <tr>
        <td><input type="checkbox" name="custom_fields[]" id="custom_fields" value="default5" /> Default5 (<input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
        <td><input type="checkbox" name="custom_fields[]" id="custom_fields" value="default6" /> Default6  (<input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
    </tr>
    <tr>
        <td><input type="checkbox" name="standard_fields[]" id="custom_fields" value="default7" /> Default7 (<input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
        <td><input type="checkbox" name="standard_fields[]" id="custom_fields" value="default8" /> Default8  (<input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
        </tr>
    <tr>
        <td><input type="checkbox" name="standard_fields[]" id="custom_fields" value="default9" /> Default9 (<input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
        <td><input type="checkbox" name="standard_fields[]" id="custom_fields" value="default10" /> Default10 (<input type="text" name="custom_fields_captions[]" id="custom_fields_captions"  />)</td>
    </tr>
    
        </table>
</td></tr>
-->
<tr bgcolor="#CCCCCC"><td width="39%" valign="middle" style="padding-left:20px;" class="style1" >User Name:</td>
	<td width="61%" align="left" valign="middle" class="bidderclass">
		<input type="text" name="username" id="username"  style="width:300px;" value="" />  <input type="button" name="chkUName" value="Check User Name Availability" onClick="checkusername()" /> <span id="username_status" style="color:#F00; font-weight:bold;"></span>
</td></tr>

<tr><td width="39%" valign="middle" style="padding-left:20px;" class="style1" >Password:</td>
	<td width="61%" align="left" valign="middle" class="bidderclass">
		<input type="password" name="pwd" id="pwd" value="" />
</td></tr>

   <tr >
      <td colspan="3" align="center" valign="middle"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0"></td>
     </tr>
   
 </table>
 </form>
 </td>
   </tr>
   <tr>
     <td width="650" height="8" align="center" valign="top" ><img src="images/login-bot-pnl.gif" width="650" height="8"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" >&nbsp;</td>
   </tr>
 </table>
	<?php
//logfile entry
if(ENABLELOGIN==1)
{
	$newFileName = './logfile/'.$pagename.".txt";
	file_put_contents($newFileName,$logfilecontent, FILE_APPEND);
}
		//end of logfile entry
	function timeDiff($firstTime,$lastTime)
{
$firstTime=strtotime($firstTime);
$lastTime=strtotime($lastTime);
$timeDiff = ($lastTime-$firstTime)/86400;
return $timeDiff;
}
 ?>

</table>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
