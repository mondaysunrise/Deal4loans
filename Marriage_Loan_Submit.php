<?php session_start(); ?>
<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
		
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
		//print_r($_SESSION);
		$Reference_Code0 = $_SESSION['Temp_Reference_Code'];
		$Email= $_SESSION['Temp_Email'];
		$Mobile = $_SESSION['Temp_Phone'];
		$Name= $_SESSION['Temp_Name'];
		$last_inserted_value = $_SESSION['last_inserted'];
		
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$Reference_Code1 = $_REQUEST['Reference_Code1'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$From_Product = $_REQUEST['From_Product'];
			$From_Product1 = $_REQUEST['From_Product1'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$RePhone = $_REQUEST['RePhone'];
			
			 $nn = count($Loan_Any);
			 $ii  = 0;
			 while ($ii < $nn)
			 {
					$Loan_A .= "$Loan_Any[$ii], ";
					$ii++;
			  }
		

	
		//	retrieve ref_code from db and match it here and mob. no too
	
			
			if(($Reference_Code0 == $Reference_Code1) || ($Mobile == $RePhone ))
				{
				
					$Is_Valid=1;
				
				}
			else
				{
					$Is_Valid=0;
				}
	
		
				getEligibleBidders("personal","$City","$Mobile");	
//				$qry="Update Req_Loan_Personal SET Primary_Acc='$Primary_Acc', CC_Bank='$from',Years_In_Company='$Years_In_Company', Is_Valid='$Is_Valid', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A' Where Name='".$Name."' and Mobile_Number='".$Mobile."' and Email='".$Email."' ";
				//$qry="Update Req_Loan_Personal SET Primary_Acc='$Primary_Acc', Years_In_Company='$Years_In_Company', Is_Valid='$Is_Valid', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A' Where  RequestID=".$last_inserted_value;
			//	echo $qry;
				//$result = ExecQuery($qry);
				$DataArray = array("Primary_Acc"=>$Primary_Acc, "Years_In_Company"=>$Years_In_Company, "Is_Valid"=>$Is_Valid, "Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A);
				$wherecondition ="RequestID=".$last_inserted_value;
				Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
				
				$productname = "PersonalLoan";
				$filename = "Contents_Personal_Loan_Mustread.php?product=$productname";
				header("Location: $filename");
				exit();
			
		}


?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Thank You</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
   <?php include '~Upper.php';?>

    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
<html>
<head>

<table width="500"  border="0" cellspacing="0" cellpadding="0">
		<tr><td width="30">&nbsp;</td><td>&nbsp;</td></tr>
		<tr>
		<td width="30">&nbsp;</td>
            <td>
 
 <p><b><font color="#3366CC">Thank You, Your Request has been added Successfully ...</font></b></p>

     &nbsp;</td>
     </tr>
	 
            </table>
			</div>
	  <?php include '~Right1.php';?>
	<!--  <img src="images/120_90.gif"><BR><BR>
	  	  <img src="images/120_240.gif">
	  -->
	  </div>
    <?php include '~Bottom.php';?>
 
</body>
</html>

