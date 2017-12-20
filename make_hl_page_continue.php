<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_POST);

//Array ( [City] => [Title] => [textarea] => [textarea2] => [header] => [mainDesc] => [button] => Submit ) 
$State = strtolower($_POST['State']);
$City = strtolower($_POST['City']);
$Title = $_POST['Title'];
$metadesc = $_POST['metadesc'];
$keyword = $_POST['keyword'];
$header = $_POST['header'];
$mainDesc = $_POST['mainDesc'];

$getPageSql = "select * from city_pages where City='".$City."' and Product='Home Loan'";
$getPageQuery = ExecQuery($getPageSql);
$num = mysql_num_rows($getPageQuery);

if($num>0)
{
	$report = "Duplicate";
}
else
{
	$sql = "INSERT INTO city_pages (Product ,City ,State, Title ,MetaKeyword ,MetaDescription ,PageDescription ,HeaderDEscription ,Dated ,Status) VALUES ('Home Loan',  '".$City."', '".$State."',  '".$Title."',  '".$keyword."',  '".$metadesc."',  '".$mainDesc."', '".$header."', Now(), '1')";
	$query = ExecQuery($sql);
	//echo "<br>".$sql;
	$report = "Inserted";
	$creadetPage = '<a href="http://www.deal4loans.com/home-loan/'.$City.'" target="_blank">Created Page</a>';

}
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
?>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
    <td ><div align="center">Home Loan</div></td>
    </tr>
<tr><td>
<?php
echo $report;
?>

<br><br>
</td></tr><tr><td>
<?php
echo $creadetPage;
?>
<br><br>
</td></tr><tr><td>
<a href="make_hl_page_index.php">Make Other Page</a>
</td></tr></table>
</body>
</html>