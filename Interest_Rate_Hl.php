<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$loan_amount=trim($_REQUEST["loan_amount"]);
	$loan_tenure = trim($_REQUEST["loan_tenure"]);
	//echo $loan_tenure."<br>";
	//echo $loan_amount."";

$selectresult="select  bank_name,".$loan_amount.", prepayment_charges,processing_fee from `home_loan_interest_rate_chart` where  tenure='".$loan_tenure."' order by bank_name ASC";
//echo "query2".$selectresult."<br>";
	$getbank_result=ExecQuery($selectresult);
	$get=mysql_fetch_array($getbank_result);
	$msg="valid";
	}
	else
	{
		$selectgetresult="select  bank_name,upto_30lacs, prepayment_charges,processing_fee from `home_loan_interest_rate_chart` where  tenure='4' order by bank_name ASC";
		//echo "query1".$selectgetresult."<br>";
	$newgetbank_result=ExecQuery($selectgetresult);
	//$newget=mysql_fetch_array($newgetbank_result);
	$getmsg="valid";
	}
?>
<html>
<head>

<title>Home Loan Interest rate | Home Loan Comparison Rate | Deal4loans</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="Best Home Loan Rates, Best Interest Rates, Home loans, Home loan, Home loans India, Home loan in India, Home loan interest rates,  Home loan rates in India, Home finance loans, compare Home loan rates, Home loans at least interest rate">
<meta name="Description" content="Home loan interest rate comparison with various banks. Know processing fee, Special Interest rates for salaried and self employed personnel / professionals. Compare home loan interest rates from Allahabad Bank, AXIS Bank , Barclays Bank, Corporation Bank, Dena Bank, DHFL HFC, Deutsche Post, Federal Bank, HDFC, ICICI Home Finance, Bank of Baroda, IDBI Bank, ING VYSYA, Oriental Bank of Commerce, Kotak, LIC housing, Punjab National Bank, Standard Chartered, SBI, Union Bank of India, Vijaya Bank.">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<link href="includes/style1.css" rel="stylesheet" type="text/css">

<script src="scripts/scroller1.js" type="text/javascript"></script>
<style type="text/css">

#topbar{
position:absolute;
margin: 502px 0px 0px 155px ;
padding: 4px ;
background-color: #E8F0F6;
width: 620px;
visibility: hidden;
}

</style>

<?php include '~Top.php';?>
<div id="dvMainbanner">
    <?php include '~Upper.php';?>
   
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent" style="margin-top:0px;">
	
	  
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>
      
<table width="777" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  valign="top" align="center" style="padding:2px; color:#333333;"> <H1 class="pg_heading" style="padding-bottom:0px; margin-bottom:0px;">Interest Rates for Home Loans</H1><font face="Verdana" size="2" color="#0F74D4">( Last edited on : <? echo $currentdate; ?> )</font>  
      <p>Buying your first home can seem intimidating, especially when faced 
            with many different loan types. Don't worry. Use this list to compare 
            and narrow down the choices to know which is the best.
<br>
<br>
To help its customers get the best interest rates on <a href="home-loans.php">home loans</a> deal4loans has consolidated all the information regarding current rate of interest for all the banks at one place. Please keep visiting this section to check updated rate of interest for home loans.</p></td>
    <td width="237" align="right" valign="top"><? if(!isset($_SESSION['UserType'])) 
  {
  include 'right-interestrate.php';
  }
  ?>
</td>
  </tr>
  <tr>
    <td colspan="2"><form name="hlinterest" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST">
	<div style="padding:10px 0px;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="75"><img src="images/lft-int-corn.gif" width="10" height="75"></td>
    <td align="center" valign="middle" style="border-top:1px solid  #d2d2d2; border-bottom:1px solid  #d2d2d2;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" align="center" valign="middle"><b>Loan Amount</b></td>
        <td align="center" valign="middle"><b>Loan Tenure</b></td>
        <td width="180" height="52" rowspan="2"><input type="image" src="images/gt-intrate.gif"  style="border:0px;" value="submit" name="none" /></td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle"><select name="loan_amount"> 
	<option value="PLease Select">PLease Select</option>
	<option value="upto_20lacs" <?if($loan_amount=="upto_20lacs" ) { echo "selected";}?>>Upto 20lacs</option>
	<option value="upto_30lacs" <?if($loan_amount=="upto_30lacs" ) { echo "selected";} elseif(!isset($msg)) {echo "selected";}?> >Above 20lacs to 30lacs</option>
	<option value="above_30lacs" <?if($loan_amount=="above_30lacs") { echo "selected";}?>>Above 30lacs to 75lacs</option>
	<option value="above_75lacs" <?if($loan_amount=="above_75lacs" ) { echo "selected";}?>>Above 75lacs to 1.5crores</option>
	</select></td>
        <td align="center" valign="middle"><select name="loan_tenure"> 
	<option value="PLease Select">PLease Select</option>
	<option value="1" <?if($loan_tenure=="1") { echo "selected";}?>>Upto 5yrs</option>
	<option value="2" <?if($loan_tenure=="2") { echo "selected";}?>>From 5yrs to 10yrs</option>
	<option value="3" <?if($loan_tenure=="3") { echo "selected";}?>>From 10yrs to 15yrs</option>
	<option value="4" <?if($loan_tenure=="4") { echo "selected";} elseif(!isset($msg)) {echo "selected";}?>>From 15yrs to 20yrs</option>
	<option value="5" <?if($loan_tenure=="5") { echo "selected";}?>>From 20yrs to 25yrs</option>
	</select></td>
        </tr>
    </table></td>
    <td width="10" height="75"><img src="images/rgt-int-corn.gif" width="10" height="75"></td>
  </tr>
</table></div>

	
	
 <table width="777"   border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
<!--<tr>
	<td>Loan Tenure</td><td>
	<select name="loan_tenure"> 
	<option value="PLease Select">PLease Select</option>
	<option value="1" <?if($loan_tenure=="1") { echo "selected";}?>>Upto 5yrs</option>
	<option value="2" <?if($loan_tenure=="2") { echo "selected";}?>>From 5yrs to 10yrs</option>
	<option value="3" <?if($loan_tenure=="3") { echo "selected";}?>>From 10yrs to 15yrs</option>
	<option value="4" <?if($loan_tenure=="4") { echo "selected";} elseif(!isset($msg)) {echo "selected";}?>>From 15yrs to 20yrs</option>
	<option value="5" <?if($loan_tenure=="5") { echo "selected";}?>>From 20yrs to 25yrs</option>
	</select>
	</td>
</tr>-->
<!--<tr>
	<td><input type="image" src="images/sbmt.gif"  style="border:0px;" value="submit" name="none" /></td>
</tr>-->
<?if($msg=="valid")
{?>

<tr bgcolor="#E8F0F6"><td height="25" align="center" bgcolor="#494949" class="tblwt_txt"> <b>Bank Name</b></td>
<td height="25" align="center" bgcolor="#494949" class="tblwt_txt"><b>Interest rate</b></td>
<td height="25" align="center" bgcolor="#494949" class="tblwt_txt"><b>Processing Fee</b></td>
<td height="25" align="center" bgcolor="#494949" class="tblwt_txt"><b>Prepayment Charges</b></td>
</tr>
<? while($multiget=mysql_fetch_array($getbank_result)) 
		{
	?>
			<tr bgcolor="#F6F4ED"><td height="25" bgcolor="#FFFFFF" class="tbl_txt"><? echo $multiget["bank_name"];?></td>
			<td bgcolor="#FFFFFF" class="tbl_txt"><? echo $multiget[1];?></td>
			<td bgcolor="#FFFFFF" class="tbl_txt"><? echo $multiget[2];?></td>
			<td bgcolor="#FFFFFF" class="tbl_txt"><? echo $multiget[3];?></td>
			</tr>
	<?	}
}?>
<?if($getmsg=="valid" && (!isset($msg)))
{?>

<tr bgcolor="#E8F0F6"><td height="25" align="center" bgcolor="#494949" class="tbletext"><b>Bank Name</b></td>
<td height="25" align="center" bgcolor="#494949" class="tbletext"><b>Interest rate</b></td>
<td height="25" align="center" bgcolor="#494949" class="tbletext"><b>Processing Fee</b></td>
<td height="25" align="center" bgcolor="#494949" class="tbletext"><b>Prepayment Charges</b></td>
</tr>
<? while($newmultiget=mysql_fetch_array($newgetbank_result)) 
		{
	?>
			<tr bgcolor="#F6F4ED"><td height="25" bgcolor="#FFFFFF" class="tbl_txt"><? echo $newmultiget["bank_name"];?></td>
			<td bgcolor="#FFFFFF" class="tbl_txt"><? echo $newmultiget[1];?></td>
			<td bgcolor="#FFFFFF" class="tbl_txt"><? echo $newmultiget[2];?></td>
			<td bgcolor="#FFFFFF" class="tbl_txt"><? echo $newmultiget[3];?></td>
			</tr>
	<?	}
}?>

</table>
</form></td>
  </tr>
</table><br>

<div style="width:777px; float:left;">   

                              
    </p>		 <p> <b>Disclaimer:</b> Please note that the interest rates given here are based 
            on the market research. To enable the comparisons certain set of data 
            has been reorganized / restructured / tabulated. Users are advised 
            to recheck the same with the individual companies / organizations. 
            This site does not take any responsibility for any sudden / uninformed 
            changes in interest rates.<br><br>

            Banks/ Financial Institutions can contact us at <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> 
            for inclusions or updates </p>
	</div>
    </div>


  </div>
<?php include '~Bottom.php';?>
  </body>
</html>