<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

	?>
<html>
<head>

<title>Deal4loans newsletter archives</title>
<meta name="keywords" content="Newsletter, Deal4loans newsletter, Deal4loans update, Deal4loans newsletter archives">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="refresh" content="900">
<link href="/includes/style1.css" rel="stylesheet" type="text/css">
<?php include '~Top.php';?>
<div id="dvMainbanner">
    <?php include '~Upper.php';?>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent">
	 
	  <table width="520" border="0" cellspacing="2" cellpadding="0" style="border:1px solid #0865C5;" >
	  <tr>
          <td height="25" align="center" bgcolor="#0865C5"  ><h1 style="color:#FFFFFF; font-size:12px;" class="blue-text"> Newsletter Gallery</h1></td>
	  </tr>
	 
	<?	 $newsmenuqry="select * from Newsletter where 1=1 order by News_Dated Desc ";
			 //echo "ffff".$newsqry;
			
			 list($newsrecordcount,$getrow)=MainselectfuncNew($newsmenuqry,$array = array());
		$h=0;
			 
		while($h<count($getrow))
        {
        
			$News_Content = $getrow[$h]['News_Content'];
			$News_Subject = $getrow[$h]['News_Subject'];
			$News_Date = $getrow[$h]['News_Month'];
			$News_Id  = $getrow[$h]['News_Id'];
			if($h%2==0)
			{
				$bgcolor = "#F1F5FA";
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
		$h = $h + 1; }
		 
		 ?>
		 </table>
	
    </div>
<div style=" background-image: url(http://www.deal4loans.com/images/newlter-form.gif); float:right; width:240px; height:190px;">
<form>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="56" align="center" valign="bottom" >&nbsp;</td>
  </tr>
  <tr>
    <td height="35" align="center"><input type="text" name="fullname" value="Full Name" style="width:150px;" maxlength="30"></td>
  </tr>
  <tr>
    <td height="35" align="center"><input type="text" name="email_id" value="Email Id" style="width:150px;"></td>
  </tr>
  <tr>
    <td height="53" align="right" valign="bottom" style="padding-right:22px;"><input type="submit" name="submit" style="background-image: url(http://www.deal4loans.com/images/sbscrb-btn.gif); background-repeat: no-repeat; width: 107px; height: 29px; background-position: center; border:none; font-size: 1px;" value="submit"/></td>
  </tr>
</table>
</form>
</div>

  </div>
<?php include '~Bottom.php';?>
  </body>
</html>
