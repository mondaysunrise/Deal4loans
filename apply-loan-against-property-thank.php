<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'eligiblebidderfuncLAP.php';
	
	
	function DetermineAgeGETDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

	function get_DOB($DOB)
{
	if($DOB<=40 )
		{
			//echo $DOB;
			$term = 120;
			$print_term = "10";
		}
		else if($DOB>40 && $DOB<=45)
		{
			$term = 120;
			$print_term = "10";
		}
		else if($DOB>45 && $DOB<=50)
		{
			$term = 120;
			$print_term = "10";
		}
		else if($DOB>50 && $DOB<=55)
		{
			$term = 60;
			$print_term = "5";
		}
		else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
		}
		else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
		}
		else if($DOB>56 && $DOB<=57)
		{
			$term = 36;
			$print_term = "3";
		}
		else if($DOB>57 && $DOB<=58)
		{
			$term = 24;
			$print_term = "2";
		}
		else if($DOB>58 && $DOB<=59)
		{
			$term = 12;
			$print_term = "1";
		}
		else if ($DOB>=60)
	{
		$term = 0;
			$print_term = "0";
	}

		$getterm[]= $term;
		$getterm[]= $print_term;
		return($getterm);

}


$R_URL="Contents_Loan_Against_Property_Mustread.php";

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="HL Site Page";
}

$page_Name = "LoanAgainstProperty";
  if ($_SESSION['flag']==1)
		{
		$source="partner1";
		}

	

//$RequestID = $_POST['RequestID'];
//$RequestID = 38085;
$RequestID = $_SESSION['Temp_LID'];

 $getdetails="select * From Req_Loan_Against_Property  Where RequestID='".$RequestID."'" ;
 list($Getnum,$ArrRow)=Mainselectfunc($getdetails,$array = array());
 
$City = $ArrRow['City'];
$Loan_Amount = $ArrRow['Loan_Amount'];
$DOB = $ArrRow['DOB'];
$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
list($term,$print_term)=get_DOB($age);
		list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Against_Property",$RequestID,$City);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Apply and Compare Loans Against Property India</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Apply Loans Against Property online. Know the schemes from all loans against property providing banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc. Compare Documents, EMI, Interest rates and Fees.">
<meta name="keywords" content="Loan Against Property India, Apply Loan Against Property, Compare Loan Against Property in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">

<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 
<div id="container"  >  
   <span><a href="index.php">Home</a> > <a href="loan-against-property.php">Loan Against Property</a> > Apply Loan Against Property</span>
  <div style="padding-top:15px; ">

           
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
	 <tr>
        <td style=" padding:12px;"><table width="539" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="489" height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;"> Loan Against Property Application</h1></td>
  </tr>
</table></td>
 </tr>
 	 <tr>
        <td style=" padding:12px;">
     Dear Customers,<br />

Based on your information, the bellow mentioned Banks will call you and give you more details about the product.<br />

This will help you to compare and save on your EMI.
   
        </td>
     </tr>
     <tr>
     <td align="center" height="200" valign="top"  style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold;">
 <?php
 if(count($finalBidderName)>0)
 {
 
 ?>
 
     <table width="97%" border="0" cellpadding="2" cellspacing="1" bgcolor="#e8e6d9">
 <tr>
    <td width="14%" height="25" align="center" valign="middle" bgcolor="#494949"><b style=" color:#FFFFFF;">Bank Name</b></td>
	 <td width="13%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Loan Amount</b></td>
    <td width="26%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Rate of Interest</b></td>
   
 <!--   <td width="21%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">EMI(Per Month)</b></td>
        <td width="12%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Term</b></td> -->
	</tr>
    <?php
	for($i=0;$i<count($finalBidderName);$i++)
	{
	?>
      <tr>
    <td height="22" align="center" bgcolor="#FFFFFF"><b><? 
	 if($finalBidderName[$i]=="HDFC Bank")
	 {
	 	 echo "HDFC LTD";
     }
     else
     {
     	 echo $finalBidderName[$i];
     }
     ?>
     </b></td>
 
     <? 
	 if($finalBidderName[$i]=="Barclays Finance")
	 {
	 $interest = 12.25;
	 $int = $interest/1200;


	 
	 ?>
        <td height="22" align="center" bgcolor="#FFFFFF"><b><? 
	 
	 	 echo "Rs. ".number_format($Loan_Amount);
     
     ?>
     </b></td>
	 <td height="22" align="center" bgcolor="#FFFFFF"><b><?php echo $interest; ?> %</b></td>
<!--	 <td height="22" align="center" bgcolor="#FFFFFF"><b>
     <?php
	 
     $emicalc=round($Loan_Amount * $int / (1 - (pow(1/(1 + $int), $term))));
	//  echo	"Rs. ".number_format($emicalc);
	 ?>
      </b></td>     
           <td height="22" align="center" bgcolor="#FFFFFF"><b><?php //echo $print_term; ?> yrs</b></td> -->
     <?php
	 }
	 else if($finalBidderName[$i]=="HDFC Bank")
	 {
	 	$interest = 13.25;
		 $int = $interest/1200;
		
	 
	 
	 ?>
	   <td width="2%" height="22" align="center" bgcolor="#FFFFFF"><b><? 
	 
	 	  echo "Rs. ".number_format($Loan_Amount);
     
     ?>
     </b></td>
     <td width="2%" height="22" align="center" bgcolor="#FFFFFF"><b><?php echo $interest; ?>%</b></td>
	<!-- <td width="2%" height="22" align="center" bgcolor="#FFFFFF"><b>
     <?php
      $emicalc=round($Loan_Amount * $int / (1 - (pow(1/(1 + $int), $term))));
	//  echo	"Rs. ".number_format($emicalc);
 	 ?>
      </b></td> 
      <td width="3%" height="22" align="center" bgcolor="#FFFFFF"><b><?php //echo $print_term; ?> yrs</b></td> -->
      <?php
	 }
	 else
	 {
	 ?>
      <td width="5%" height="22" colspan="2" align="center" bgcolor="#FFFFFF"><b>Get Quote on Call</b></td>
      <?php
	 }
	 ?>
        
    </tr>
    
    <?php
	} 
	?>
</table>
<?php
}
else
{
	echo "Thanks for applying for Loan Against Property. We will contact you shortly.";
}
?>

     </td>
      </tr>
	  </table>
	<br />
  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?> <? } ?>
</div>
</body>
</html>