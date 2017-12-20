<?php
  require 'scripts/db_init.php';
	 echo $crd_nme = $_REQUEST['crd_nme'];
	echo $prdct_id = $_REQUEST['prdct_id'];

if((strlen(trim($crd_nme))>0) && $prdct_id >1)
{
	$slct=("select applied_card_name from Req_Credit_Card Where (RequestID='".$prdct_id."')");
	 list($recordcount,$row)=MainselectfuncNew($slct,$array = array());
		$cntr=0;
	
	if(strlen($row[$cntr]['applied_card_name'])>0)
	{
	$strcrd_nme=$row[$cntr]['applied_card_name'].",".$crd_nme;
	}
	else
	{
		$strcrd_nme=$crd_nme;
	}

	$DataArray = array("applied_card_name"=>$strcrd_nme);
	$wherecondition ="(RequestID='".$prdct_id."')";
	Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	
	}
	
	
?>
