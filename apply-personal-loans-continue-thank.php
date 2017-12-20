<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$requestid= $_REQUEST["requestid"];
	$salary_acc = $_REQUEST["salary_acc"];

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$requestid =  $_POST["requestid"];
		$salary_acc = $_POST["salary_acc"];
		$Account_No = $_POST["Account_No"];

if(strlen($Account_No)>0)
		{
		$cc_details="update Req_Loan_Personal set Primary_Acc='".$salary_acc."', PL_Tenure='".$Account_No."' Where RequestID=".$requestid;
		$ccresult=ExecQuery($cc_details);
		}

		//echo $cc_details."<br>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Personal Loans | Apply Personal Loans online | Compare Personal Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="car-loans.php">Personal Loan</a> > Apply Personal Loan</span>
 
  <div id="lftbar" style="padding-top:10px; width:100%; ">

 <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><center><strong><?php if($Account_No=="" && ($_SERVER['REQUEST_METHOD'] == 'POST')) echo "Kindly give Valid Details"; ?></strong></center></font>
 <? if(strlen($Account_No)>0)
 { ?>
	 <div align="center" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:22px;"><b> Thanks for Providing your details.</b><br><br></div>
 <? }
 else
 { ?>
 <form name="cc_acc_details" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST">
<input type="hidden" name="requestid" id="requestid" value="<? echo $requestid; ?>">
<input type="hidden" name="salary_acc" id="salary_acc" value="<? echo $salary_acc; ?>">
		<table width="458" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="55" valign="middle" background="new-images/apl-tp.gif" style="background-repeat:no-repeat; "><h2 style="color:#443133; font-size:17px;  margin:0 0 10px; padding:15px 0 3px; text-align:center; font-family:Arial, Helvetica, sans-serif;">Personal Loan Application</h2></td>
  </tr>
<tr>
    <td class="aplfrm"><table width="400" border="0" align="right" cellpadding="0" cellspacing="0"   >
      <tr>
        <td width="37%" height="26" valign="middle" class="frmbldtxt">Bank Name</td>
        <td width="63%" align="left" class="frmbldtxt"><b><? echo $salary_acc; ?></b></td>
      </tr>
	  <tr>
        <td width="37%" height="26" valign="middle" class="frmbldtxt">Account Number<font size="1" color="#FF0000">*</font></td>
        <td width="63%" align="left"><input type="type" name="Account_No" id="Account_No"/></td>
      </tr>
	  <tr>
        <td colspan="2" align="center"><br />
            <input name="submit" type="submit" class="btnclr" value="Save" /></td>
      </tr>
	  </table></td></tr>
	  
<tr>
          <td width="458" height="26"><img src="new-images/apl-bt.gif" width="458" height="26" /></td>
  </tr>
</table>
</form>
<? } ?>
 </div>
 <?php include '~Bottom-new.php';?>
</div>
</body>
</html>