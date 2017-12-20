<?php
	//require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//Paging
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
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

.buttonfordate {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	background-color: #45B2D8;
	border: 1px solid #45B2D8;
	font-weight: bold;
}
.comment_text_a{font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;}
.comment_text_b{font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; }
.comment_text_c{font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333333; font-weight:bold;}
.comment_text_d{font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; }
.comment ul,li{ list-style:none; width:800px;}
.reply_text{font-family:Arial, Helvetica, sans-serif; font-size:12px; color: #32A0D6; font-weight:bold; }
</style>

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

include "content_header.php";

$Rid = $_REQUEST['Rid'];
$getPageSql = "select Page_Name from comments_pages where Rid = '".$Rid."'";
$getPageQuery = ExecQuery($getPageSql);
$Page_Name = mysql_result($getPageQuery,0,'Page_Name');
?>
<div style="text-align:center; font-size:14px; font-weight:bold;">Comments</div>
 <table width="950" border="0" align="center" cellpadding="1" cellspacing="3" bgcolor="#FFFFFF" >
  <tr>
     <td  style="font-size:17px; font-weight:bold; text-decoration:underline;">
     <?php echo $Page_Name; ?>
     </td></tr>
  <tr>
     <td  style="border-bottom:1px solid #45B2D8;">
     <?php

$reqID = $_REQUEST['Rid'];
function get_categories($parent=0)
{
$getPageSql = "select Rid, Page_Name from comments_pages where Rid = '".$_REQUEST['Rid']."'";
$getPageQuery = ExecQuery($getPageSql);
$Page_Name = mysql_result($getPageQuery,0,'Page_Name');
$Rid = mysql_result($getPageQuery,0,'Rid');
//echo "SELECT * FROM `comments_pages` WHERE `parent` = '$parent' and Page_Name='".$Page_Name."' and Status=1";
    $html = '<ul class="comment">';
    $query = ExecQuery("SELECT * FROM `comments_pages` WHERE `parent` = '$parent' and Page_Name='".$Page_Name."'");
	
    while($row = mysql_fetch_assoc($query))
    {
        $current_id = $row['Rid'];
		$dt = $row['Dated'];
		$dt_arr = explode(" ", $dt);
		$dt_day = explode('-',$dt_arr[0]);
		$dt_time = explode(':',$dt_arr[1]);
		$dt_mktime = mktime($dt_time[0], $dt_time[1], $dt_time[2], $dt_day[1] , $dt_day[2], $dt_day[0]);
		$finalDisplayDate = date("F j, Y g:i a",$dt_mktime);  
		$Status = $row['Status'];
		if($Status == 1)
		{
			$statusBg = "#f7f7f7";				
		}
		else
		{
			$statusBg = "#f4927b";
		}
        $html .= '<li><table bgcolor="'.$statusBg.'"><tr><td><span class="comment_text_c"><b>' . $row['Name'].'</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="comment_text_d">  '.$finalDisplayDate.'</span></td></tr>';
		$html .= '<tr><td class="comment_text_a">' . $row['Comment'].'</td></tr>';
		$html .= '<tr><td class="reply_text" ><a href="comments_edit_continue.php?Rid='.$current_id.'&id='.$Rid.'" style="cursor:pointer;">Edit Comment</a> | <a href="comments_add_continue.php?Rid='.$current_id.'&id='.$Rid.'" style="cursor:pointer;">Add Comment</a> | <a href="delete_continue.php?Rid='.$current_id.'&id='.$Rid.'" style="cursor:pointer;" >Delete</a></td></tr>';
				$html .= '<tr><td id="myTable'.$current_id.'" ></td></tr></table>';
        $has_sub = NULL;
        $has_sub = mysql_num_rows(ExecQuery("SELECT COUNT(`parent`) FROM `comments_pages` WHERE `parent` = '$current_id'"));
        if($has_sub)
        {
            $html .= get_categories($current_id);
        }
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}
print get_categories();
?>

     
     </td>
     </tr>
 </table>
 
</body>
</html>