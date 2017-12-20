<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//require 'hdfcplMails.php';	
	//print_r($_POST);
		
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$last_inserted_id = $_POST['lead_id'];
	$city = $_POST['city'];
	$bidders_details = $_POST['bidders_details'];
	$pllead_id = $_POST["pllead_id"];

	$DataArray = array("eligible"=>"Yes");
	$wherecondition ="(hdfcplid=".$last_inserted_id.")";
	Mainupdatefunc ('hdfc_pl_calc_leads', $DataArray, $wherecondition);

	if(strlen($bidders_details)>2)
	{
		$DataUpdate = array("Allocated"=>"2", 'Bidderid_Details'=>$bidders_details);
		$wherecondition ="(RequestID=".$pllead_id.")";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
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
</head>

<body>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6" class="lftshado">&nbsp;</td>
    <td bgcolor="#FFFFFF"><table width="965"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="77%" height="74"><img src="new-images/hdfc-pl/hdfcbank_logo.gif" width="171" height="29"></td>
            <td width="23%"><img src="new-images/hdfc-pl/deal4loans_logo.gif" width="200" height="54"></td>
          </tr>
        </table></td>
      </tr>
      <!--<tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="200" height="290" align="left" valign="top"><img src="new-images/hdfc-pl/hdr1.gif" width="200" height="290"></td>
            <td width="187"><img src="new-images/hdfc-pl/hdr2-new.gif" width="187" height="290"></td>
            <td width="202"><img src="new-images/hdfc-pl/hdr3-new.gif" width="202" height="290"></td>
            <td width="193" align="left" valign="top"><img src="new-images/hdfc-pl/hdr4-new.gif" width="193" height="290"></td>
            <td width="183" align="left" valign="top"><img src="new-images/hdfc-pl/hdr5.gif" width="183" height="290"></td>
          </tr>
        </table></td>
      </tr>
      -->
      <tr>
        <td height="3"></td>
      </tr>
	  <? if($getloanamout>0 && $Employment_Status ==1)
		{ ?>
	  <tr><td height="35" class="boldtxt" style="color:#103E6B; padding-left:15px; line-height:18px; font-size:12px; "><b>Dear Customer ,<br>
	    Based on the information furnished by you, we are   pleased to offer you a Tentative Personal Loan Eligibility Quote as per details   mentioned: <br><br>Offer Details: </b></td>
	  </tr>
	  <? } ?>
      <tr>
        <td height="450" align="center" valign="top" class="hdng" style="padding-top:15px; ">	
 <table width="949"  align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="66" background="new-images/hdfc-pl/thank-bg.gif" style="background-repeat:no-repeat; ">
	<table width="90%"   border="0" align="center" cellpadding="0" cellspacing="0" >
		<? 
		$getData = "select * from  hdfc_pl_calc_leads where hdfcplid ='".$last_inserted_id."'";
		list($num,$getDataQuery)=MainselectfuncNew($getData,$array = array());
		if($num>0)
		{
		$getloanamout = $getDataQuery[0]['eligible_loanAmt'];
		$interestrate = $getDataQuery[0]['eligible_interestRate'];
		$get_emi =  $getDataQuery[0]['eligible_emi'];
		$getterm =  $getDataQuery[0]['eligible_term'];
	
		?>
	<tr>
	<tr><td height="55" align="center" class="boldtxt" style="font-size:13px; line-height:28px;" > Loan Amount<br>
	    <span style="color:#b04c09; "><? echo "Rs ".number_format($getloanamout) ; ?></span></td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">Interest Rate<br>
		  <span style="color:#b04c09; "><? echo $interestrate; ?></span></td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">EMI (Per month)<br>
		  <span style="color:#b04c09; "><? echo "Rs ".$get_emi; ?></span></td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">Tenure<br>
		  <span style="color:#b04c09; "><? echo $getterm; ?> yrs</span></td>
	</tr>
	<tr>
		<td class="boldtxt" colspan="7" >&nbsp;</td>
	</tr>
	<tr><td colspan="7" style="color:#103E6B; padding-left:15px; line-height:25px; font-size:12px; " class="boldtxt">Thank You for your Interest. Our representative will get in touch with you shortly for further process. </td></tr>
	<? }
	else
	{?>
	<tr>
		<td colspan="7" class="boldtxt" style="color:#103E6B; padding-left:15px; line-height:18px; font-size:12px; ">We're sorry. Our automated system could not locate an offer for you at this time. However our representatives might be able to find you an offer and communicate to you. <? //echo $Feedback; ?></td>
	</tr>
	<? } ?>
		
</table></td>
  </tr>
</table>
 </td>
      </tr>
	  <tr><td style="font-family:Verdana, Arial, Helvetica, sans-serif; Font-size:11px; color:#FF0000;">* Terms & Conditions Apply , Credit at the sole discretion  of HDFC Bank </td>
	  </tr>
    </table></td>
    <td width="6" class="rgtshado">&nbsp;</td>
  </tr>
</table>


</body>
</html>
