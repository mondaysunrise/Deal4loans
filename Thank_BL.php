<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

	
	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}

	
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

if($_SESSION==""){
		$product_name = $_SERVER['Temp_Type'];
		$Name= $_SERVER['Temp_Name'];
		$Type_Loan2 = $_SERVER['Temp_Type_Loan'];
		 $Mobile= $_SERVER['Temp_Phone'];
		$Reference_Code0 = $_SERVER['Temp_Reference_Code'];
		$Email= $_SERVER['Temp_Email'];
		$Net_Salary= $_SERVER['Temp_Net_Salary'];
		$Company_Name= $_SERVER['Temp_Company_Name'];
		$City= $_SERVER['Temp_City'];
		$Other_City= $_SERVER['Temp_City_Other'];
		$Pincode= $_SERVER['Temp_Pincode'];
		$Contact_Time= $_SERVER['Temp_Contact_Time'];
		$Employment_Status= $_SERVER['Temp_Employment_Status'];
		}
		else
			{
		$product_name = $_SESSION['Temp_Type'];
		$Name= $_SESSION['Temp_Name'];
		$Type_Loan2 = $_SESSION['Temp_Type_Loan'];
		 $Mobile= $_SESSION['Temp_Phone'];
		$Reference_Code0 = $_SESSION['Temp_Reference_Code'];
		$Email= $_SESSION['Temp_Email'];
		$Net_Salary= $_SESSION['Temp_Net_Salary'];
		$Company_Name= $_SESSION['Temp_Company_Name'];
		$City= $_SESSION['Temp_City'];
		$Other_City= $_SESSION['Temp_City_Other'];
		$Pincode= $_SESSION['Temp_Pincode'];
		$Contact_Time= $_SESSION['Temp_Contact_Time'];
		$Employment_Status= $_SESSION['Temp_Employment_Status'];
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
		$Pancard=$_REQUEST['Pancard'];
		$Reference_Code1 = $_REQUEST['Reference_Code1'];
		
		$Primary_Acc= $_REQUEST['Primary_Acc'];
		$Loan_Any = $_REQUEST['Loan_Any'];
		$EMI_Paid = $_REQUEST['EMI_Paid'];
		$From_Product = $_REQUEST['From_Product'];
		$From_Product1 = $_REQUEST['From_Product1'];
		$Descr = $_REQUEST['Descr'];
		$product = $_REQUEST['type'];
		
		$budget = $_REQUEST['Budget'];
		$Credit_Limit = $_REQUEST['Credit_Limit'];
////Business Loan
		$CCbusiness = $_REQUEST['CCbusiness'];
		$Property_Identified = $_REQUEST['Property_Identified'];
		$Property_Loc = $_REQUEST['Property_Loc'];
		//$Total_Experience = $_REQUEST['Total_Experience'];
		$Loan_Time = $_REQUEST['Loan_Time'];
		$Card_Vintage = $_REQUEST['Card_Vintage'];
		$RePhone = $_REQUEST['RePhone'];
		//echo $RePhone."<br>";
	
/////////////////////having cc from which bank/////////////
	   $n       = count($From_Product);
	   $i      = 0;
	   while ($i < $n)
	   {
		  $From_Pro .= "$From_Product[$i], ";
		 $i++;
	   }
	////////////////Applied with banks in last 6 months/////////////////////////////	
	   $r = count($From_Product1);
	   $p = 0;
	   while ($p < $r)
	   {
		  $From_Pro1 .= "$From_Product1[$p], ";
		 $p++;
	   }
/////Any loan is running/////////////////////////////////
	  	$nn = count($Loan_Any);
		 $ii  = 0;
		while ($ii < $nn)
		{
		  $Loan_A .= "$Loan_Any[$ii], ";
		 $ii++;
		 }
	/////////////////////////////////////////////////////////	
		if(($Reference_Code0 == $Reference_Code1) || ($Mobile == $RePhone ))
			{
			
			$Is_Valid=1;
			
			}
		else
			{
			$Is_Valid=0;
			}
		
	if (($Type_Loan2=="Req_Credit_Card") || ($product=="CreditCard"))
		{
		getEligibleBidders("cc","$City","$Mobile");				
	//$qry="Update Req_Credit_Card SET Pancard='$Pancard', Credit_Limit='$Credit_Limit', No_of_Banks='$From_Pro', Descr='$Descr', Card_Vintage='$Card_Vintage', Is_Valid='$Is_Valid', Applied_With_Banks='$From_Pro1' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Company_Name='".$Company_Name."' and Employment_Status='".$Employment_Status."'";
	
		$DataArray = array("Pancard"=>$Pancard, "Credit_Limit"=>$Credit_Limit, "No_of_Banks"=>$From_Pro, "Descr"=>$Descr, "Card_Vintage"=>$Card_Vintage, "Is_Valid"=>$Is_Valid, "Applied_With_Banks"=>$From_Pro1);
		$wherecondition ="Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Company_Name='".$Company_Name."' and Employment_Status='".$Employment_Status."'";
		Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	
	
	//$result = ExecQuery($qry);
			}
	if (($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan"))
		{
	getEligibleBidders("personal","$City","$Mobile");	
	//$qry="Update Req_Loan_Personal SET Primary_Acc='$Primary_Acc', Years_In_Company='$Years_In_Company', Is_Valid='$Is_Valid', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Company_Name='".$Company_Name."' and Employment_Status='".$Employment_Status."' ";
	//$result = ExecQuery($qry);
	
		$DataArray = array("Primary_Acc"=>$Primary_Acc, "Years_In_Company"=>$Years_In_Company, "Is_Valid"=>$Is_Valid, "Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A);
		$wherecondition ="Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Company_Name='".$Company_Name."' and Employment_Status='".$Employment_Status."'";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
	
		}
	if (($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan"))
		{
		getEligibleBidders("home","$City","$Mobile");
		//$qry="Update Req_Loan_Home SET Property_Identified='$Property_Identified', Property_Loc ='$Property_Loc', Loan_Time='$Loan_Time', Is_Valid='$Is_Valid', Budget='$budget' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Employment_Status='".$Employment_Status."'";
	//$result = ExecQuery($qry);
		$DataArray = array("Property_Identified"=>$Property_Identified, "Property_Loc"=>$Property_Loc, "Loan_Time"=>$Loan_Time, "Is_Valid"=>$Is_Valid, "Budget"=>$budget);
		$wherecondition ="Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Employment_Status='".$Employment_Status."'";
		Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
	
	
		}
		if ($product=="BusinessLoan")
		{
	  //$qry="Update Req_Business_Loan SET CC_Holder='$CCbusiness', CC_Bank='$From_Pro', Card_Vintage='$Card_Vintage', Is_Valid='$Is_Valid', EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."'";
	//echo $qry;
	//$result = ExecQuery($qry);
	
	$DataArray = array("CC_Holder"=>$CCbusiness, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Is_Valid"=>$Is_Valid, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A);
	$wherecondition ="Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."'";
	Mainupdatefunc ('Req_Business_Loan', $DataArray, $wherecondition);
	
		
		}

 if($_SESSION['flag']==1)
	{ 
		if($product=="PersonalLoan"){
			?>
			 <img src="http://sify.com/finance/loans/dealforloans/fwrite.php?form=PersonalLoan&userid=<?php echo $_SESSION['Temp_Email'];?>&url=http://www.deal4loans.com/Request_Loan_Personal_New.php?flag=1" width="0" height="0" /> <?php } 
	 elseif($product=="CreditCard"){
		 ?>
		 <img src="http://sify.com/finance/loans/dealforloans/fwrite.php?form=CreditCard&userid=<?php echo $_SESSION['Temp_Email'];?>&url=http://www.deal4loans.com/Request_Credit_Card_New.php?flag=1" width="0" height="0" /> <?php } 
	  elseif($product=="HomeLoan"){
		  ?>
		 <img src="http://sify.com/finance/loans/dealforloans/fwrite.php?form=HomeLoan&userid=<?php echo $_SESSION['Temp_Email'];?>&url=http://www.deal4loans.com/Request_Loan_Home_New.php?flag=1" width="0" height="0" /> <?php } 
	 elseif($product_name=="PropertyLoan")
		{ ?>
		 <img src="http://sify.com/finance/loans/dealforloans/fwrite.php?form=PropertyLoan&userid=<?php echo $_SESSION['Temp_Email'];?>&url=http://www.deal4loans.com/Request_Loan_Against_Property_New.php?flag=1" width="0" height="0" /> <?php }
	elseif($product_name=="CarLoan")
			{?>
		<img src="http://sify.com/finance/loans/dealforloans/fwrite.php?form=CarLoan&userid=<?php echo $_SESSION['Temp_Email'];?>&url=http://www.deal4loans.com/Request_Loan_Car_New.php?flag=1" width="0" height="0" />
			<? }
	elseif($product=="BusinessLoan"){
			?>
			 <img src="http://sify.com/finance/loans/dealforloans/fwrite.php?form=BusinessLoan&userid=<?php echo $_SESSION['Temp_Email'];?>&url=http://www.deal4loans.com/Req_Business_Loan_New.php?flag=1" width="0" height="0" /> <?php } 
	}

		 if($_SESSION['flag']==1) 
		 { 
			if($product=="PersonalLoan")
				$filename = "Contents_Personal_Loan_Mustread.php?product=$product&flag=1";
			else if($product=="HomeLoan")
				$filename = "Contents_Home_Loan_Mustread.php?product=$product&flag=1";
			else if($product=="CreditCard")
				$filename = "Contents_Credit_Card_Mustread.php?product=$product&flag=1";
		 }
		else
		 {
			if($product=="PersonalLoan")
				$filename = "Contents_Personal_Loan_Mustread.php?product=$product";
			else if($product=="HomeLoan")
				$filename = "Contents_Home_Loan_Mustread.php?product=$product";
			else if($product=="CreditCard")
				$filename = "Contents_Credit_Card_Mustread.php?product=$product";
		 }
	
	//else if($page_Name=="LoanAgainstProperty")
		//$filename = "closedby_lap.php";
	//else if($page_Name=="CarLoan")
		//$filename = "closedby_cl.php";
		
		//header("Location: $filename");
		//exit();
		
	if(isset($_SESSION['UserType'])) 
		{
			 if($_SESSION['flag']==1)
			{
		echo "<script language=javascript>"." location.href='myRequests.php?flag=1'"."</script>";
		//$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "myRequests.php");
		//	echo $Msg;
			}
			else
			{
				echo "<script language=javascript>"." location.href='myRequests.php'"."</script>";
			}

		}
	}
	
	 if($_SESSION['flag']==1) 
		 { 	
	if($product_name=="PropertyLoan")
	{
		$file_name = "Contents_Loan_Against_Property_Mustread.php?product=$product_name&flag=1";
		header("Location: $file_name");
		exit();
	}
	else if($product_name=="CarLoan")
	{
		$file_name = "Contents_Car_Loan_Mustread.php?product=$product_name&flag=1";
		header("Location: $file_name");
		exit();
	}
	 }
		else
		 {
	if($product_name=="PropertyLoan")
	{
		$file_name = "Contents_Loan_Against_Property_Mustread.php?product=$product_name";
		header("Location: $file_name");
		exit();
	}
	else if($product_name=="CarLoan")
	{
		$file_name = "Contents_Car_Loan_Mustread.php?product=$product_name";
		header("Location: $file_name");
		exit();
	}
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
<?php if ($_REQUEST['flag']!=1)
	{ ?>
   <?php include '~Upper.php';?><?php } ?>

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
	  <?php if ($_REQUEST['flag']!=1)
	{ ?>
    <?php include '~Bottom.php';?>
	<? } ?>
	



 
<!-- Google Code for lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1063319470;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (1) {
  var google_conversion_value = 1;
}
var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1063319470/imp.gif?value=1&label=lead&script=0">
</noscript>
</body>
</html>

