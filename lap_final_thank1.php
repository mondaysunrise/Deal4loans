<?php
ob_start();
require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
		require 'eligiblebidderfuncLAP.php';
	//require 'cardsview.php';


	if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

		$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$DOB= $year."-".$month."-".$day;
		$Property_Value = $_POST['Property_Value'];
		$name = $_POST['name'];
		$userid = $_POST['userid'];
		$Phone = $_POST['Phone'];		
		$city = $_POST['city'];
		$net_salary = $_POST['net_salary'];
		$Reference_Code = generateNumberNEWc(5);
		$Pincode = $_POST['Pincode'];
		$Employment_Status = $_POST['Employment_Status'];
		$Loan_Amount = $_POST['Loan_Amount'];
$_SESSION['ProductValue'] = $userid;

		$dataUpdate = array('Reference_Code'=>$Reference_Code, 'Pincode'=>$Pincode, 'Property_Value'=>$Property_Value, 'Employment_Status'=>$Employment_Status, 'DOB'=>$DOB, 'Loan_Amount'=>$Loan_Amount);
		$wherecondition = "(RequestID='".$userid."')";
		Mainupdatefunc ('citi_appointments', $DataArray, $wherecondition);
}
			
list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Against_Property",$userid,$city);
if(count($FinalBidder)>0)
	{
			$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

			if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMSMessage, $Phone);
	}

if(count($finalBidderName)==0)
{
	header("Location: apply-loan-against-property-thanks.php");
	exit();
	//echo "Not Valid";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Thank you</title>
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>

</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="loan-against-property.php"  class="text12" style="color:#0080d6;"><u>Loan Against Property</u></a> <a href="#"  class="text12" style="color:#4c4c4c;">> Apply Loan Against Property</a></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">    
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="3" >
      <tr>
     <td>

	  <form name="lap_verify" action="apply-loan-against-property-thanks.php" method="post">
         <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $userid; ?>" >
		 <input type="hidden" name="Reference_Code" id="Reference_Code" value="<? echo $Reference_Code; ?>">     
       <table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <tr>
        <td height="55" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><div class="text3" style=" color:#FFF; font-size:16px; text-transform:none; font-weight:bold; line-height:25px;">To get quotes and Compare offers from all Banks and <span style="color: #D02037;"> Save Upto Rs. 1 lac * by comparison on your EMI</span>. Please verify your Mobile Number. <br />We have sent an activation code on <span style="color: #D02037;"><? echo $Phone; ?></span>
</div></td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F"><table width="895" border="0" cellpadding="0" cellspacing="0">
          <tr>
            
            <td width="600" align="left" valign="top"><table width="598" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="173" height="60">
                      <div class="text" style=" float:left; width:170px; height:auto; color:#FFF; font-size:14px; text-transform:none;">Activation Code:</div></td><td width="214" height="50"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">
                        <input name="activation_code" id="activation_code" type="text" style="width:100px; height:18px;" onkeydown="validateDiv('nameVal');"  maxlength="5"/>
  
                      </div></td><td width="211" align="center" valign="top">
  <div style=" width:114px; height:47px; margin-top:0px; margin-left:0px; margin-right:23px;">  <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td>
                </tr>
             </table></td>
         </tr>
       </table></td>
      </tr>
      <tr>
        <td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table></form>
     </td>
      </tr>
		   <tr>
            <td  height="25" align="center" class="frmbldtxt"  style="font-weight:normal; color:#000000;" colspan="2" >
			1) In next screen get Rates, EMI , Processing Fee information.<br />
			2) Compare EMI and <span style="color: #D02037;">Save upto Rs. 1lac on interest.</span><br />
			3) Help in processing your loan   faster.<br />
             4) Gives you best offer.                </td>
           
          </tr>
      <tr><td>&nbsp;</td></tr>
    </table>
</div>
<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
</body>
</html>
<? function generateNumberNEWc($plength)
{
	if(!is_numeric($plength) || $plength <= 0)
	{
	    $plength = 8;
	}
	if($plength > 32)
	{
	    $plength = 32;
	}

	$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	mt_srand(microtime() * 1000000);
	for($i = 0; $i < $plength; $i++)
	{
	   $key = mt_rand(0,strlen($chars)-1);
	   $pwd = $pwd . $chars{$key};
	}
	   for($i = 0; $i < $plength; $i++)
	{
	    $key1 = mt_rand(0,strlen($pwd)-1);
	    $key2 = mt_rand(0,strlen($pwd)-1);

	    $tmp = $pwd{$key1};
	    $pwd{$key1} = $pwd{$key2};
	    $pwd{$key2} = $tmp;
	}

	return $pwd;
}
?>