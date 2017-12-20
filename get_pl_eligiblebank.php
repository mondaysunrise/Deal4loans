<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	

	
	if($_SESSION=="")
		{
		$product_name = $_SERVER['Temp_Type'];
		$Name= $_SERVER['Temp_Name'];
		$Type_Loan2 = $_SERVER['Temp_Type_Loan'];
		$Mobile = $_SERVER['Temp_Phone'];
 		$Panno = $_SERVER['Temp_Pancard'];
		$from = $_SERVER['Temp_From_Pro'];
		$DOB=$_SERVER['Temp_DOB'];
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
		$DOB=$_SESSION['Temp_DOB'];
		$Type_Loan2 = $_SESSION['Temp_Type_Loan'];
		$Mobile = $_SESSION['Temp_Phone'];
 		$Panno = $_SESSION['Temp_Pancard'];
		$from = $_SESSION['Temp_From_Pro'];
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
	?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Apply Personal Loans | Compare Personal Loans</title>
<meta name="keywords" content="Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
<?php if ((($_REQUEST['flag'])!=1))
	{ ?>
   <?php include '~Upper.php';?><?php } ?>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
    
		<table width="777"  border="0" cellspacing="0" cellpadding="0">
 <tr><td  colspan="2" valign="top"><div style="Font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:10px; padding-top:10px;">Thanks for applying Personal Loan through Deal4loans.com.<br> 
   You will soon receive a Call from us.</div>
<div style="  Font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:5px;">
 Following Banks are interested in your profile, will get back to you & give you the best Deal..</div>
 <table width="100%" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1" >
   <tr  >
     <td height="25" align="center" bgcolor="#494949" class="tblwt_txt" >Bank Name</td>
     <td align="center" bgcolor="#494949" class="tblwt_txt" >ROI</td>
	  <td align="center" bgcolor="#494949" class="tblwt_txt" >Processing Fee</td>
	   <td align="center" bgcolor="#494949" class="tblwt_txt" >Loan Amount</td>
	    <td align="center" bgcolor="#494949" class="tblwt_txt" >Prepayment Charges</td>
		 <td align="center" bgcolor="#494949" class="tblwt_txt" >Disbursal Time</td>
		 <td align="center" bgcolor="#494949" class="tblwt_txt" >Documents</td>
     <td align="center" bgcolor="#494949" class="tblwt_txt" >Apply</td>
   </tr>
   <?php 
   if($City=="Others")
{
	if(strlen($Other_City)>0)
	{
		$strCity=$Other_City;
	}
	else
	{
		$strCity=$City;
	}
}
else
{
	$strCity=$City;
}
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$_SESSION['Temp_LID'],$strCity);
//print_r($bankID);
$Final_Bid = "";
		while (list ($key,$val) = @each($bankID)) { 
			$Final_Bid[]= $val; 
		} 


	$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0)
	 {

		
	?>
   <form name="check_bidders" action="get_checked_bidders.php" method="POST">
     <input type="hidden" name="reply_product2" value="Req_Loan_Personal">
     <input type="hidden" name="requestid2" value="<? echo $_SESSION['Temp_LID'];?>">
     <input type="hidden" name="selectbidderID2" id="selectbidderID2" value="<? echo $FinalBidder ;?>">
     <input type="hidden" name="realbankID2" id="realbankID2" value="<? echo $realbankiD ;?>">
     <?
for($i=0;$i<count($Final_Bid);$i++)
			{
		 if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
		$getlink="<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	elseif((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
	{
		$getlink="<a href='/fullerton-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
		$getlink="<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif(($Final_Bid[$i]=="CITIBANK") ||  ($Final_Bid[$i]=="Citibank"))
	{
		$getlink="<a href='/citibank-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif($Final_Bid[$i]=="Barclays")
	{
		$getlink="<a href='/barclays-finance-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	else
	{
		$getlink="<a href='/personal-loan-banks-information.php#".$Final_Bid[$i]."' target='_blank'> Know More </a>";
	}
//echo 		$Final_Bid[$i];
	echo "<tr><td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:12px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$Final_Bid[$i]."</td>";
	//echo $finalBidderName[$i]."<br>".$FinalBidder[$i]."<br>";
	if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC") || ($Final_Bid[$i]=="CITIBANK") ||  ($Final_Bid[$i]=="Citibank") || (strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
				{

		$selectplbanks="Select * From personal_loan_banks_eligibility where pl_bank_name like '%".$Final_Bid[$i]."%'";
	//$plbankresult = ExecQuery($selectplbanks);
	 list($recordcount,$myrow)=MainselectfuncNew($selectplbanks,$array = array());
		$cntr=0;
	
	$rowscount = count($myrow);
	 
while($cntr<count($myrow))
        {

echo	"<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$myrow["pl_bank_roi"]."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$myrow["pl_bank_processing_fee"]."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$myrow["pl_bank_loan_amt"]."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$myrow["pl_bank_prepayment"]."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$myrow["pl_bank_disbursal_time"]."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$getlink."</td>";
		$cntr = $cntr+1; }
				}
				else
				{
			
			echo	"<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:12px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$getlink."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$getlink."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$getlink."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$getlink."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$getlink."</td>
<td align='center' bgcolor='#FFFFFF'  style='color:#2A72BC; Font-size:11px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>".$getlink."</td>";
				}
	
	/*echo"<td bgcolor='#FFFFFF'  align='center' style='color:#2A72BC; Font-size:12px; font-family:verdana, Helvetica, sans-serif; font-weight:bold;'>";
	if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
		echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	elseif((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
	{
		echo "<a href='/fullerton-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
		echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif(($Final_Bid[$i]=="CITIBANK") ||  ($Final_Bid[$i]=="Citibank"))
	{
		echo "<a href='/citibank-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif($Final_Bid[$i]=="Barclays")
	{
		echo "<a href='/barclays-finance-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	else
	{
		echo "<a href='/personal-loan-banks-information.php#".$Final_Bid[$i]."' target='_blank'> Know More </a>";
	}*/
	echo "</td><td bgcolor='#FFFFFF' style='color:#2A72BC; Font-size:15px; font-family:verdana; font-weight:bold;' align='center'><input type='checkbox' value='$Final_Bid[$i]' name='Final_Bidder[$i]' checked></td></tr>";
//echo $Final_Bid[$i]."  er ".$finalBidderName[$i]."<br>";
}
?>
    
     <tr>
       <td height="30" colspan="8" align="center" bgcolor="#FFFFFF"><input type="submit" name="submit2" value="submit" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;color: #FFFFFF;	background-color: #529BE4;	border: 1px solid #529BE4;
	font-weight: bold;"></td>
     </tr>
   </form>
 </table></td></tr>
  
<tr><td height="60" colspan="2" valign="middle"><hr  color="#78c2ee" size="2" noshade="noshade"></td></tr>
<tr><td colspan="2" width='100%'><form name="plpensionform" action="http://www.bimadeals.com/life-insurance-india/thank_life_insurance_d4l.php" method="POST"><table width='100%' border='0' cellpadding='0' cellspacing='0' style='border:1px solid #e2e2e2;'>
<input type='hidden' value='<? echo $Net_Salary;?>' name='netSalary' id='netSalary'>
<input type='hidden' name='DOB' id='DOB' value='<? echo $getDOB;?>'>
<input type='hidden' name='Mobile' id='Mobile' value='<? echo $Mobile;?>'>
<input type='hidden' name='City' id='City' value='<? echo $City;?>'>
<input type='hidden' name='Email' id='Email' value='<? echo $Email;?>'>
<input type='hidden' name='Name' id='Name' value='<? echo $Name;?>'>
<input type='hidden' name='getDOB' id='getDOB' value='<? echo $DOB;?>'>

<tr>
  <td align="left" style='Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; padding:4px; line-height:17px;'></td>
</tr>
</table>
</form>
</td></tr></table>
<? }
else
{
	
	$filename = "Contents_Personal_Loan_Mustread.php";
	header("Location: $filename");
	exit();
}?>
	</div>

  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~NewBottom.php';?><?php } ?>

  </body>
</html>