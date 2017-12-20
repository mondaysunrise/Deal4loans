<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_POST);

//Array ( [City] => [Title] => [textarea] => [textarea2] => [header] => [mainDesc] => [button] => Submit ) 
//Array ( [State] => Uttar Pradesh [City] => Noida [Title] => extension [Rate] => 4600 [Covered] => 980 [Approved] => hdfc [Builder] => gaur green [keyword] => dds [metadesc] => sdfds [mainDesc] => dsdsfd [Agent] => upendra [Email] => [mobile] => 9199713963 [button] => Submit )

$State = strtolower($_POST['State']);
$City = strtolower($_POST['City']);
$Price = $_POST['Price'];
$Title = $_POST['Title'];
$Rate = $_POST['Rate'];
$CoveredArea = $_POST['Covered'];
$Facilities = $_POST['Facilities'];
$ApprovedBy = $_POST['Approved'];
$BuilderName = $_POST['Builder'];


$metadesc = $_POST['metadesc'];
$keyword = $_POST['keyword'];
$Description = $_POST['mainDesc'];
$AgentName = $_POST['Agent'];
$AgentID = $_POST['AgentID'];
$sqlBidder = "select * from B_Property where BidderID='".$AgentID."'";
$queryBidder = ExecQuery($sqlBidder);
$numBidders = mysql_num_rows($queryBidder);
$AgentName = mysql_result($queryBidder,0,'Bidder_Name');

$AgentEmail = $_POST['Email'];
$AgentMobile = $_POST['mobile'];
$AgentPwd = generateNumber(6);
/*$getPageSql = "select * from property_details_hl where City='".$City."'";
$getPageQuery = ExecQuery($getPageSql);
$num = mysql_num_rows($getPageQuery);
$num = 1;
if($num>0)
{
	$report = "Duplicate";
}
else
{*/
	$sql = "INSERT INTO property_details_hl (State ,City ,Price ,Title ,Rate ,CoveredArea ,Facilities ,Description ,ApprovedBy ,BuilderName ,Dated ,Status ,AgentName ,AgentEmail ,AgentMobile ,AgentPwd,metadesc,keyword, AgentID) VALUES ('".State."', '".$City."', '".$Price."', '".$Title."', '".$Rate."', '".$CoveredArea."', '".$Facilities."', '".$Description."', '".$ApprovedBy."', '".$BuilderName."', Now(), 1, '".$AgentName."', '".$AgentEmail."', '".$AgentMobile."', '".$AgentPwd."', '".$metadesc."', '".$keyword."', '".$AgentID."')";
	$query = ExecQuery($sql);
	//echo "<br>".$sql;
	$report = "Inserted";
	$creadetPage = 'Created Page';

//}
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

</td></tr></table>
</body>
</html>