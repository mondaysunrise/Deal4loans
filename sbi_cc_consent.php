<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	
	$cc_bankid = $_REQUEST["cc_bankid"];
	$RequestID = $_REQUEST["RequestID"];
	
	if($cc_bankid==11)
	{
		$crd_nme="SBI Gold Credit Card";
	}
	elseif($cc_bankid==34)
	{
		$crd_nme="SBI Signature Credit Card";
	}
$strcrd_nme="";
if((strlen(trim($crd_nme))>0) && $cc_bankid >1)
{
	$slct="select applied_card_name from Req_Credit_Card Where (RequestID='".$RequestID."')";
	list($count1,$row)=MainselectfuncNew($slct,$array = array());

	if(strlen($row[0]['applied_card_name'])>0)
	{
	echo $strcrd_nme=$row[0]['applied_card_name'].",".$crd_nme;
	}
	else
	{
		echo $strcrd_nme=$crd_nme;
	}

$Dated = ExactServerdate();
$dataUpdate = array('applied_card_name'=>$strcrd_nme);
$wherecondition = "(RequestID='".$RequestID."')";
Mainupdatefunc ('Req_Credit_Card', $dataUpdate, $wherecondition);
if($cc_bankid==11)
	{
	header("https://www.sbicard.com/EApplyWeb/EApplyCustomLandingServlet/GoldNMoreLanding?GEMID1=dis_d4l_sbag1_eapp_mas_010115_ia_e-apply");
	 exit;	
	}
elseif($cc_bankid==34)
	{
		header("https://www.sbicard.com/EApplyWeb/EApplyCustomLandingServlet/SignatureLanding?GEMID1=dis_d4l_sbas1_eapp_mas_010115_ia_e-apply");
		 exit;	
	}
else
	{

		header("https://www.sbicard.com/EApplyWeb/EApplyCustomLandingServlet/GoldNMoreLanding?GEMID1=dis_d4l_sbag1_eapp_mas_010115_ia_e-apply");
		 exit;
	}
	
}
?>
