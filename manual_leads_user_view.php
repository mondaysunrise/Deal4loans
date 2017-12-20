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
 
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif">
     <table width="95%" border="0" cellpadding="3" cellspacing="3">
   
   <tr><td colspan="4" style="font-size:16px; font-weight:bold; text-align:center;">View User</td></tr>
   <tr><td colspan="4">&nbsp;</td></tr>
<tr> <td width="146" align="center" bgcolor="#FFFFFF" class="style2">Source</td> <td width="146" align="center" bgcolor="#FFFFFF" class="style2">User Name</td> <td width="146" align="center" bgcolor="#FFFFFF" class="style2">Product</td> <td width="146" align="center" bgcolor="#FFFFFF" class="style2">Fields</td></tr>
   <tr><td colspan="4">&nbsp;</td></tr>
<?php 


$viewUserSql = "select * from manual_user_details where 1=1";
$viewUserQuery = ExecQuery($viewUserSql);
$numRows = mysql_num_rows($viewUserQuery);
for($i=0;$i<$numRows;$i++)
{
	$BidderID = mysql_result($viewUserQuery,$i,'BidderID');	
	$source = mysql_result($viewUserQuery,$i,'source');	
	$standard_fields = mysql_result($viewUserQuery,$i,'standard_fields');	
	$getBiddersSql = "select * from Bidders where BidderID = '".$BidderID."'";
	$getBiddersQuery = ExecQuery($getBiddersSql);
	$Email = mysql_result($getBiddersQuery,0,'Email');
	$Bidder_Name = mysql_result($getBiddersQuery,0,'Bidder_Name');
	$Reply_Type = mysql_result($getBiddersQuery,0,'Reply_Type');
	if($Reply_Type==1) { $Product = "Personal Loan"; } else if($Reply_Type==2) { $Product = "Home Loan"; }
	?>
<tr><td align="center" bgcolor="#DFF6FF" class="style3" ><?php echo $source; ?></td><td valign="middle" align="center" bgcolor="#DFF6FF" class="style3"><?php echo $Bidder_Name; ?></td><td align="center" bgcolor="#DFF6FF" class="style3"><?php echo $Product; ?></td><td align="center" bgcolor="#DFF6FF" class="style3"><?php echo $standard_fields; ?></td></tr>
    
    
	<?php
}
?>

   
 </table>
 </td>
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
