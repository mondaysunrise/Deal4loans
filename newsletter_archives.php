<?php
$pageName = "/";
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deal4loans newsletter archives</title>
<meta name="keywords" content="Newsletter, Deal4loans newsletter, Deal4loans update, Deal4loans newsletter archives">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<!--<script type="text/javascript" src="js/dropdowntabs.js"></script>-->
</head>
<body>
<?php include 'middle-menu.php';?>
<div id="container" style="margin-top:70px;">  
<div id="lftbar">
<div class="lfttxtbar">
  <span><a href="index.php">Home</a> >  Newsletter Gallery</span>
  <div id="txt" style="padding-top:10px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="0" style="border:1px solid #494949;" >
	  <tr>
          <td height="25" align="center" bgcolor="#494949"><h1 style="color:#FFFFFF; margin:0px; padding:0px;"> Newsletter Gallery</h1></td>
	  </tr>
	<?php	 
		$newsmenuqry="select * from Newsletter where 1=1 order by News_Dated Desc ";
		list($newsrecordcount,$newsmenuresult)=MainselectfuncNew($newsmenuqry,$array = array());
		 
		 for($h=0;$h<$newsrecordcount;$h++)
		 {
			$News_Content = $newsmenuresult[$h]['News_Content'];
			$News_Subject = $newsmenuresult[$h]['News_Subject'];
			$News_Date = $newsmenuresult[$h]['News_Month'];
			$News_Id  = $newsmenuresult[$h]['News_Id'];
			if($h%2==0)
			{
				$bgcolor = "#f5f5f5";
			}
			else
			{
				$bgcolor = "#FFFFFF";
			}
		 ?>
		 <tr bgcolor="<?php echo $bgcolor; ?>">
		<td align="left" style="padding-left:20px;">&bull;&nbsp;&nbsp;<a href="/viewnewsletter/newsletter/<? echo $News_Id; ?>" class="blue-text" style="font-weight:normal; line-height:16px;"><? echo  $News_Subject." (".$News_Date.")";?></a></td>
		</tr>
		 <?
		 }
		 
		 ?>
	    </table>
	<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="new-images/top.gif"/></a></div>
  </div></div></div>
<?php include '~Right-Newsletter.php'; ?>
</div>
<?php include 'footer_sub_menu.php';?>  
</body>
</html>

