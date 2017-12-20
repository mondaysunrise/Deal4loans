<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;

		$result = ExecQuery("Select * From Req_Loan_Personal Where RequestID=$RequestID");
		echo mysql_error();
		if ($myrow = mysql_fetch_array($result)) {
			$Employment_Status = $myrow["Employment_Status"];
			$Company_Name = FixNewLine($myrow["Company_Name"]);
			$City = FixNewLine($myrow["City"]);
			$City_Other = FixNewLine($myrow["City_Other"]);
			$Years_In_Company = FixNewLine($myrow["Years_In_Company"]);
			$Total_Experience = FixNewLine($myrow["Total_Experience"]);
			$Net_Salary = FixNewLine($myrow["Net_Salary"]);
			$Marital_Status = $myrow["Marital_Status"];
			$Residential_Status = $myrow["Residential_Status"];
			$Vehicles_Owned = $myrow["Vehicles_Owned"];
			$Loan_Any = $myrow["Loan_Any"];
			$EMI_Paid = FixNewLine($myrow["EMI_Paid"]);
			$CC_Holder = $myrow["CC_Holder"];
			$Loan_Amount = FixNewLine($myrow["Loan_Amount"]);

		    mysql_free_result($result);
		}
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$UserID = $_SESSION['UserID'];

		/* FIX STRINGS */
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Years_In_Company = FixString($Years_In_Company);
		$Total_Experience = FixString($Total_Experience);
		$Net_Salary = FixString($Net_Salary);
		$EMI_Paid = FixString($EMI_Paid);
		$Loan_Amount = FixString($Loan_Amount);

	$sql = "UPDATE Req_Loan_Personal SET Employment_Status='$Employment_Status', Company_Name='$Company_Name', City='$City', City_Other='$City_Other', Years_In_Company='$Years_In_Company',		Total_Experience='$Total_Experience', Net_Salary='$Net_Salary', Marital_Status='$Marital_Status', Residential_Status='$Residential_Status', Vehicles_Owned='$Vehicles_Owned',	Loan_Any='$Loan_Any', EMI_Paid='$EMI_Paid', CC_Holder='$CC_Holder', Loan_Amount='$Loan_Amount', Dated=Now() WHERE RequestID=$RequestID";

		$result = ExecQuery($sql);
		echo mysql_error();

		if ($result == 1) 
			$Msg = getAlert("Your request has been Updated. !!", TRUE, "myRequests.php");
		else
			$Msg = "** There is a problem in adding your request. **";
    }
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Personal Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">


 <?php include '~Top.php'; ?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><img src="images/personal_loan1.gif" usemap="#map_name5"></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">A wedding in the family. Maybe your house needs renovation. Or your daughter has obtained admission to a medical college.. Gift your wife a beautiful gold pendant, pay for your children’s higher education, or send your parents on a much-needed holiday- we offer various kinds of personal loans to fulfill your dreams in India.</td></tr></table>  <map name="map_name5">
  <area shape="rect" coords="17,52,120,70" hrEF="Contents_Personal_Loan_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="Request_Loan_Personal_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="Contents_Personal_Loan_Mustread.php">
   <area shape="rect"coords="17,140,80,100" hrEF="Contents_Personal_Loan_Faqs.php">
        </map> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
  <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td>
    <Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.Company_Name, 'Company Name', 5))
		return false;
	if (theFrm.City.selectedIndex==0)
		{alert("Please enter City Name to Continue");
		theFrm.City.focus();
		return false;}
	if(!checkData(theFrm.City, 'City', 3))
		return false;
	if(!checkNum(theFrm.Years_In_Company, 'Years In Company',0))
		return false;
	if(!checkNum(theFrm.Total_Experience, 'Total Experience',0))
		return false;
	if(!checkNum(theFrm.Net_Salary, 'Net Salary',0))
		return false;
	if(!checkNum(theFrm.Loan_Amount, 'Loan Amount',0))
		return false;
	return true;
    }
    </Script>
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
	<input type="hidden" name="RequestID" value="<?=$RequestID?>">
 <table width="450" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td colspan="2" class="head1">Edit Personal Loan Request</td>
   </tr>
   <tr><td colspan="2" id="Alert">&nbsp; <?=$Msg?></td></tr>
   <tr>
     <td width="35%" class="bodyarial11">Employment Status</td>
     <td width="65%"><select size="1" name="Employment_Status">
	<?=AmISelected("Salaried", $Employment_Status, "1")?>
	<?=AmISelected("Self Employed", $Employment_Status, "0")?>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Company Name</td>
     <td><input type="text" value="<?=$Company_Name?>" name="Company_Name" size="30" maxlength="15"></td>
   </tr>
   <tr>
     <td class="bodyarial11">City Name</td>
	 <td class="bodyarial11"><select size="1" name="City" value="<?=$City?>">
     <?=getCityList($City)?>
	 </select> Others
     <input type="text" name="City_Other" size="10" value="<?=$City_Other?>" ></td>
   </tr>
   <tr>
     <td class="bodyarial11">No. of years in this Company</td>
     <td>
     <input type="text" value="<?=$Years_In_Company?>" name="Years_In_Company" size="15" maxlength="15" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Total Experience(years)/<br>
     Total Years in Business</td>
     <td>
     <input type="text" value="<?=$Total_Experience?>" name="Total_Experience" size="15" maxlength="15" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Net Salary(Yearly)</td>
     <td>
     <input type="text" value="<?=$Net_Salary?>" name="Net_Salary" size="15" maxlength="30" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Marital Status</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Marital_Status" class="NoBrdr" <?=AmIChecked($Marital_Status,1)?>>Single
     <input type="radio" value="2" name="Marital_Status" class="NoBrdr" <?=AmIChecked($Marital_Status,2)?>>Married</td>
   </tr>
   <tr>
     <td class="bodyarial11">Residential Status</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Residential_Status" class="NoBrdr" checked <?=AmIChecked($Residential_Status, 1)?>>Owned
     <input type="radio" value="2" name="Residential_Status" class="NoBrdr" <?=AmIChecked($Residential_Status, 2)?>>Rented     <input type="radio" value="3" name="Residential_Status" class="NoBrdr" <?=AmIChecked($Residential_Status, 3)?>>Company Provided</td>
   </tr>
   <tr>
     <td class="bodyarial11">Vehicles Owned</td>
     <td>
     <select size="1" name="Vehicles_Owned">
	<?=AmISelected("2 Wheeler", $Vehicles_Owned, "0")?>
	<?=AmISelected("4 Wheeler", $Vehicles_Owned, "1")?>
	<?=AmISelected("Other", $Vehicles_Owned, "2")?>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Any type of loan(s) running</td>
     <td class="bodyarial11">
     <select size="1" name="Loan_Any">
	<?=AmISelected("N/A", $Loan_Any, "0")?>
	<?=AmISelected("Car Loan", $Loan_Any, "1")?>
	<?=AmISelected("Home Loan", $Loan_Any, "2")?>
	<?=AmISelected("Personal Loan", $Loan_Any, "3")?>
	<?=AmISelected("Other", $Loan_Any, "4")?>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">How many EMI paid?</td>
     <td>
     <input type="text" value="<?=$EMI_Paid?>" name="EMI_Paid" value="0" size="15" maxlength="30"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Are you a Credit Card Holder of Any Bank</td>
     <td class="bodyarial11">
     <input type="radio" value="1" name="CC_Holder" class="NoBrdr" <?=AmIChecked($CC_Holder, 1)?>>Yes
     <input type="radio" value="0" name="CC_Holder" class="NoBrdr" <?=AmIChecked($CC_Holder, 0)?>>No</td>
   </tr>
   <tr>
     <td class="bodyarial11">Loan Amount Required</td>
     <td>
     <input type="text" value="<?=$Loan_Amount?>" name="Loan_Amount" size="15" maxlength="30" value="0"></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><br><input type="submit" class="bluebutton" value="Submit">
     <input type="reset" class="bluebutton" value="Reset"></td>
   </tr>
  </table>
 </form>
	
     
	  <?php //include '~Right.php';?>
	<!--  <img src="images/120_90.gif"><BR><BR>
	  	  <img src="images/120_240.gif">
	  -->
	  
	 </td>

   </tr>
 </table>
 </div>
 </div>
<?php include '~Bottom.php';?>
</body>

</html>