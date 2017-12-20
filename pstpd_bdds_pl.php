<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	 echo $pl_requestid = $_REQUEST['pl_requestid'];
echo $pl_bank_name = $_REQUEST['pl_bank_name'];
echo $pl_bidid = $_REQUEST['pl_bidid'];



if (strlen($pl_bank_name)>1 && $pl_requestid>1)
{
	$selqry="select PL_Bank,Bidderid_Details from Req_Loan_Personal Where RequestID=".$pl_requestid;

 list($recordcount,$plrow)=MainselectfuncNew($selqry,$array = array());
		$cntr=0;


$pl_banks=$plrow[$cntr]['PL_Bank'];
$Bidderid_Details = $plrow[$cntr]['Bidderid_Details'];

if(strlen($pl_banks)>1 && strlen($Bidderid_Details)>1)
	{
		$newpl_banks= $pl_banks.",".$pl_bank_name;
		$nwBidderid_Details = $Bidderid_Details.",".$pl_bidid;

	$DataArray = array("PL_Bank"=>$newpl_banks, "Bidderid_Details"=>$nwBidderid_Details);
	$wherecondition ="(Req_Loan_Personal.RequestID=".$pl_requestid.")";
	
	}
	else
	{
	$DataArray = array("PL_Bank"=>$pl_bank_name, "Bidderid_Details"=>$pl_bidid, "Allocated"=>2);
	$wherecondition ="(Req_Loan_Personal.RequestID=".$pl_requestid.")";
	
	}
	Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);

	//echo $plupdate."<br>";

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Personal Loan  | Personal Loan Application | Personal Loans Comparison Chart</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>

</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>

<div id="container">

  <div id="txt"  style="padding-top:15px; height:60px;">
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Personal Loan from <? echo $pl_bank_name; ?> through Deal4loans.com </h1>
  
</div>


  <?php include '~Bottom-new.php';?>
</div><!-- </div> -->
</body>
</html>