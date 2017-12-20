<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'individual_lead_allocation.php';
			
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$choosenBid_id = $_POST["choosenBid_id"];
	$pl_last_inserted = $_POST["pl_last_inserted"];
	$bank_name = $_POST["bank_name"];
	$strbank_name=$bank_name." For";
	

$SelectePlSql="Select Bidderid_Details,Allocated From Req_Loan_Personal Where (Req_Loan_Personal.RequestID='".$pl_last_inserted."')";
list($alreadyExist,$row)=Mainselectfunc($SelectePlSql,$array = array());
$Bidderid_Details = $row["Bidderid_Details"];
$Allocated = $row["Allocated"];
$City = $row["City"];
$City_Other = $row["City_Other"];

if($City=="Others")
{
	$strcity=$row["City_Other"];
}
	else
	{
		$strcity=$row["City"];
	}



$arrbid_details=explode(",",$Bidderid_Details);
$arrchoosenbid=explode(",",$choosenBid_id);

//print_r($arrbid_details);
//print_r($arrchoosenbid);

if($Allocated==1)
	{
		$arrresult = array_diff($arrchoosenbid, $arrbid_details);
		if(count($arrresult)>0 && $arrresult[0]>0)
		{
$telecalled_bidderid=implode(",",$arrresult);

			insertLogDataBiddersList($LogID, $pl_last_inserted, $strcity, $ProductID, $FieldName, $FieldValue);
				
			getEligibleBiddersList("1",$pl_last_inserted,$strcity,$telecalled_bidderid); 
		}
		else
		{

		}
	}
	else
	{

if(strlen($Bidderid_Details)>0)
	{
	$arrresult = array_diff($arrchoosenbid, $arrbid_details);
		if(count($arrresult)>0 && $arrresult[0]>0)
		{
			$newBidderid_Details = $Bidderid_Details.",".$choosenBid_id;
		}
		else
		{
			echo "no updation";
		}


	}
	else
	{
	$newBidderid_Details = $choosenBid_id;
	

	}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>For information on loans and hassle free loans contact - Deal4Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="hassle free loans, loans india, best loan providers, loans interest rate, low interest loan, compare loans, online loan information">
<meta name="Description" content="Looking for hassle free loans at attractive interest rates and flexible repayment option; Deal4Loans provides you an online information services on flexible loan schemes available with best loan provider banks in India.">
<link href="css/hdfc_pl.css" rel="stylesheet" type="text/css">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<?php include'../~sml-hdr.php';?>
<div class="lfttxtbar">
	
  <div id="txt">
    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
 
      <tr>
        <td height="3">&nbsp;</td>
      </tr>
	 
	  <tr><td height="35" class="boldtxt" style="color:#103E6B; padding-left:15px; line-height:18px; font-size:12px; "><b>Dear Customer ,<br>
	    Thanks For Applying For <? echo $strbank_name;?>  Personal Loan. </b></td>
	  </tr>
	       	   
      <tr>
        <td >&nbsp;</td>
      </tr> 
	  <tr>
        <td >&nbsp;</td>
      </tr> 
</table>
  </div>
</div>
</div>
<? if(!isset($_SESSION['UserType'])) 
  {
  //include '~Right-new1.php';
  }
  ?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>

