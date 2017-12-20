<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//print_r ($_POST);
	
if($_POST['submit'])
{
	$Name = $_POST['name'];
	$Email = $_POST['email'];
	$Pancard = $_POST['pancard_no'];
	$Phone = $_POST['contact_no'];
	$Product = $_POST['product'];
	$ReqID = $_POST['requestid'];
	
	
	//$SQL = "INSERT INTO `Req_User_Update` (`RUU_Name` , `RUU_Email` , `RUU_RequestID` , `RUU_Product` , `RUU_Date` , `RUU_Pancard`, `RUU_Phone` ) VALUES ('".$Name."', '".$Email."', '".$ReqID."', '".$Product."', Now(), '".$Pancard."', '".$Phone."' )";
	
	$dataInsert = array("RUU_Name"=>$Name , "RUU_Email"=>$Email , "RUU_RequestID"=>$ReqID , "RUU_Product"=>$Product , "RUU_Date"=>$Dated, "RUU_Pancard"=>$Pancard , "RUU_Phone"=>$Phone);
		$table = 'Req_User_Update';
		$insert = Maininsertfunc ($table, $dataInsert);
	
	//ExecQuery($SQL);
	
	header("Location:Contents_Credit_Card_Mustread.php");
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Apply online for credit cards in Delhi, Gurgaon & Noida | Credit cards Mumbai</title>
<meta name="description" content="Get online information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="apply online for credit cards, credit cards, credit card plans, online credit card, Noida, Mumbai, Delhi, Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner"><?php if ((($_REQUEST['flag'])!=1))
	{ ?>
    <?php include '~Upper.php';?><?php } ?>
    <div id="dvbannerContainer"><table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><?php include '~Image.php';?></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">Have you ever stood behind 
                                someone in line at the store and watched him 
                                shuffle through a stack of what must be at least 
                                10 credit cards? Consumers with this many cards 
                                are still in the minority, but experts say that 
                                the majority of modern day inhabitants have at 
                                least one credit card and usually two or three.</td></tr></table> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
    <?php if(isset($_SESSION['UserType']))
	{?>
   <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>
	<table width="520"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center" class="head2">Credit Card Request<td></tr>
<tr><td>&nbsp;</td></tr>
		<tr>
<td colspan='2'align='center'><font style='color:white;font-Family:Verdana;font-size:12px;'> Fill the following details</font>
</td>
</tr>
<tr><td colspan='2'></td></tr>
<tr><td colspan='2'><input type='hidden' name='product' value='ccmailer'></td></tr>
<tr><td colspan='2'><input type='hidden' name='name' value='$name'></td></tr>
<tr><td colspan='2'><input type='hidden' name='requestid' value='$requestid'></td></tr>
<tr>
<td width='45%'><font style='color:Black;font-Family:Verdana;font-size:12px;'>&nbsp;Email id </font></td><td width='65%'><input type='hidden' name='email' value='<?php echo $Email; ?>'> </td>
</tr>
<tr>
<td width='45%'><font style='color:Black;font-Family:Verdana;font-size:12px;'>&nbsp;Contact No </font></td><td width='65%'><input type='text' size='15' name='contact_no'> </td>
</tr>
<tr>
<td width='40%'><tr><td width="50%"><font style="color:Black;font-Family:Verdana;font-size:12px;">&nbsp;Pancard No</font></td><td><input type="text" name="pancard_no" size="15" maxlength="10"></td></tr>
<tr><td colspan='2' id='myDiv'></td></tr>
 <tr>
 <td colspan='2' align='center' class='bodyarial11'><br><input type='submit' class='bluebutton' value='Submit'><input type='reset' class='bluebutton' value='Reset' ></td>
   </tr>
            </table>
			</td></tr></table>
			</div>
<?
  include '~Right2.php';

  ?>
   </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><?php } ?>

  </body>
</html>

