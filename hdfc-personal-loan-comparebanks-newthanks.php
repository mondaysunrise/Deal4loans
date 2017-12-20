<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
		
//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$choosenBid_id = $_POST["choosenBid_id"];
	$pl_last_inserted = $_POST["pl_last_inserted"];
	$bank_name = $_POST["bank_name"];

$SelectePlSql="Select Bidderid_Details From Req_Loan_Personal Where (Req_Loan_Personal.RequestID='".$pl_last_inserted."')";
list($resultExist,$row)=MainselectfuncNew($SelectePlSql,$array = array());
$Bidderid_Details = $row[0]["Bidderid_Details"];
if(strlen($Bidderid_Details)>0)
	{
		$newBidderid_Details = $Bidderid_Details.",".$choosenBid_id;
		$dataUpdate = array('Bidderid_Details'=>$newBidderid_Details);
		$wherecondition = "(Req_Loan_Personal.RequestID='".$pl_last_inserted."')";
		Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
	}
	else
	{
		$newBidderid_Details = $choosenBid_id;
		$dataUpdate = array('Bidderid_Details'=>$newBidderid_Details, 'Allocated'=>'2');
		$wherecondition = "(Req_Loan_Personal.RequestID='".$pl_last_inserted."')";
		Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HDFC Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/hdfc_pl.css" rel="stylesheet" type="text/css">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6" class="lftshado">&nbsp;</td>
    <td bgcolor="#FFFFFF"><table width="965"  border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
    <td width="6" class="lftshado">&nbsp;</td>
    <td bgcolor="#FFFFFF"><table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div id="dvtpbg">
<div id="logo">
	<img src="/new-images/d4l-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>

</div>
</div></td>
      </tr>
      <tr>
        <td height="3"></td>
      </tr>
	 
	  <tr><td height="35" class="boldtxt" style="color:#103E6B; padding-left:15px; line-height:18px; font-size:12px; "><b>Dear Customer ,<br>
	    Thanks For Applying For <? echo $bank_name;?> For Personal Loan. </b></td>
	  </tr>
	       	    </table></td>
    <td width="6" class="rgtshado">&nbsp;</td>
  </tr>
</table>
</td></tr></table>
</body>
</html>
