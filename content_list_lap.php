<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//Paging
	$pagesize=30;
	$startrow=0;
	
	//Set the page no

	if(empty($_GET['pageno']))
	{
		if($startrow == 0)
		{
			$pageno = $startrow + 1;
		}
	}
	else
	{
		$pageno = $_GET['pageno'];
		$startrow = ($pageno - 1) * $pagesize;
	}
	
	//Set the counter start
	if($pageno/$pagesize == 0)
	{
		$counterstart = $pageno - ($pagesize - 1);
	}
	else
	{
		$counterstart = $pageno - ($pageno % $pagesize) + 1;
	}
	//Counter End
	$counterend = $counterstart + ($pagesize - 1);
	///

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
<script language="javascript">
function sendmail(form)
{
	var gifName = form;
	document.frmsearch.action="content_list_lap.php?search=y"+gifName;
	document.frmsearch.submit();
}
</script>
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
?>
 <?php
include "content_header.php";
?>
<div style="text-align:center; font-size:14px; font-weight:bold;">Loan Against Property</div>
 <form name="frmsearch" action="" method="post">
 <table width="950" border="0" align="center" cellpadding="1" cellspacing="3" bgcolor="#FFFFFF" >
 <? 

		$sql = "select * from city_pages where 1=1 and 	Product='LAP' ";
$result = ExecQuery($sql);
		
$recordcount = mysql_num_rows($result);
	//echo "<br>".$sql;
 ?>	  <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
     </tr>
 
   <tr>
  
     <td width="122" align="center" bgcolor="#FFFFFF" class="style2">City</td>
	 <td width="728" align="center" bgcolor="#FFFFFF" class="style2">Title</td>
      <td width="82" align="center" bgcolor="#FFFFFF" class="style2">Edit</td>
    
   </tr>
	<?
		//Set Maximum Page start
		$maxpage = $recordcount % $pagesize;
		if($recordcount % $pagesize == 0)
		{
			$maxpage = $recordcount / $pagesize;
		}
		else
		{
			$maxpage = ceil($recordcount / $pagesize);
		}
		
		
		$sql = "select * from city_pages where 1=1 and Product='LAP'";
		$sql=$sql." order by City DESC";
		$sql=$sql." LIMIT $startrow, $pagesize"; 
		$result = ExecQuery($sql);
		
		$recordcount = mysql_num_rows($result);
		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{																												
	?>

   <tr>
     <td align="center" bgcolor="#DFF6FF" class="style3" >
		 <a href="http://www.deal4loans.com/property-loan/<?php echo $row["City"]; ?>" target="_blank"><strong><? echo ucfirst($row["City"]); ?></strong></a></td>
	  <td style="padding-left:4px;" bgcolor="#DFF6FF" class="style3"><? echo $row["Title"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><a href="content_edit_lap.php?pid=<?php echo $row["pid"]; ?>">Edit</a></td>
	</tr>
<?	$i=$i+1;
			}
	?>
			
   
	<?
					
		}
		
		
	?>
 </table>
 <br>
 <table width="758"  border="0" cellpadding="5" cellspacing="1">
	<? 
	if($recordcount>0)
	{
	?>
   <tr>
     <td align="center" >
	 <? 
		$c=1;
		for($c=1;$c<=$maxpage;$c++)
		{	
	
			if( $pageno==$c)
			{
				echo '<span style="font-size:14px; font-weight:bold;">';			
				echo "&nbsp;&nbsp;".$c."&nbsp;";
				echo '</span>';
			}
			else
			{
			?>
				<a onClick="javascript:sendmail('<? echo "&id=".$i."&pageno=".$c; ?>')" style="font-size:14px; text-decoration:underline;"><? echo $c; ?></a>
			<?
			}
		
		} 
		?>		</td>
   </tr>
   <? 
   } 
   ?>
 </table>
</form>
</body>
</html>