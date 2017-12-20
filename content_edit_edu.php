<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/sample.js" type="text/javascript"></script>
<link href="ckeditor/sample.css" rel="stylesheet" type="text/css" />
<style>
	.input {
    border: 1px solid #006;
    background: #ffc;
	height:20px;
}
.textarea {
    border: 1px solid #006;
    background: #ffc;
}

.button {
    border: 1px solid #006;
    background: #9cf;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:45px;
}
label {
    display: block;
    float: left;
    text-align: right;
}
br { clear: left; }
	</style>
</head>

<body>


<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
<?php
include "content_header.php";
$pid = $_REQUEST['pid'];
$getPageSql = "select * from city_pages where pid ='".$pid."'";
$getPageQuery = ExecQuery($getPageSql);
$num = mysql_num_rows($getPageQuery);
$City = mysql_result($getPageQuery,0,'City');
$Title = mysql_result($getPageQuery,0,'Title');
$metadesc = mysql_result($getPageQuery,0,'MetaDescription');
$keyword = mysql_result($getPageQuery,0,'MetaKeyword');
$header = mysql_result($getPageQuery,0,'HeaderDEscription');
$mainDesc = mysql_result($getPageQuery,0,'PageDescription');
$State = mysql_result($getPageQuery,0,'State');

?>
<form action="content_edit_edu_continue.php" method="post">
<input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>" />
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2"><div align="center">Education Loan</div></td>
    </tr>
   <tr>
    <td width="25%"><strong>State</strong></td>
    <td width="75%">
      <input type="text" name="State" id="State" class="input" style="width:202px;" value="<?php echo $State; ?>"  />
    </td>
  </tr>
  <tr>
    <td width="25%"><strong>City</strong></td>
    <td width="75%">
      <input type="text" name="City" id="City" class="input" style="width:202px;" value="<?php echo $City; ?>"  />
    </td>
  </tr>
  <tr>
    <td><strong>Title</strong></td>
    <td>
      <input type="text" name="Title" id="title" style="width:672px;" class="input"  value="<?php echo $Title; ?>"  />
   </td>
  </tr>
  <tr>
    <td><strong>Meta Keyword</strong></td>
    <td>
      <textarea name="keyword" id="keyword" cols="125" rows="5"><?php echo $keyword; ?></textarea>
    </td>
  </tr>
  <tr>
    <td><strong>Meta Description</strong></td>
    <td><textarea name="metadesc" id="metadesc" cols="125" rows="5"><?php echo $metadesc; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Header</strong> </td>
  </tr>
   <tr>
    <td colspan="2"><textarea class="ckeditor" cols="120" id="header" name="header" rows="10"><?php echo $header; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Main Description</strong></td>
  </tr>
     <tr>
    <td colspan="2"> <textarea class="ckeditor" cols="120" id="mainDesc" name="mainDesc" rows="20"><?php echo $mainDesc; ?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" style="padding:10px;">
      <input type="submit" name="button" id="button" value="Submit" class="button"  />
   </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>




</form>
</body>
</html>
