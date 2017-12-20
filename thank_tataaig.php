<?php
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';

//print_r($_SERVER['REQUEST_METHOD']);
//print_r($_POST);
function getproductn($pKey){
    $titles = array(
        'Personal Loan' => '1',
        'Home Loan' => '2',
        'Car Loan' => '3',
        'Credit Card' => '4',
        'Loan Against Property' => '5',
		'Credit Card & Debit Card Offers' => '7'
        
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$requestid = $_POST['requestid'];
			 $product = $_POST['product'];
			 $email = $_POST['email'];

			$newproduct = getproductn($product);



if($requestid>0 && $newproduct>0)
		{
$get_dnccust="INSERT INTO non_dnc_tataaigleads ( non_dncid, ndnc_requestid, ndnc_product, ndnc_email, ndnc_dated ) Values('','".$requestid."','".$newproduct."','".$email."',Now())";
$CheckQuery = ExecQuery($get_dnccust);

//echo $get_dnccust;
		}
		else 
		{
			header("Location: index.php");
			exit();
		}

	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Personal Accidental Insurance | Personal Loans India | Personal loans Online | Deal4loans</title>
<meta name="keywords" content="Personal Accidental Insurance, Tataaig Insurance, Personal Loan India, Get Loan, Personal Loans India, Personal loans Online">
<meta name="description" content="Personal Accidental Insurance: Get quote for personal loan. Compare personal loans interest rates and EMI from all major personal loan banks such as Sbi, Hdfc Bank, Barclays Finance, Fullerton, Citifinancial, Citibank.">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
   
  <div id="txt">
 <div style="Font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:10px; padding-top:10px;" align="center">Dear Customer, Thank you for registering for free persoanl accident cover worth Rs.50000/- TATA AIG team will shortly get in touch with you.<br><br><br><br><br></div>

</div>


<?php include '~Bottom-new1.php';?>
</div>

</body>
</html>

