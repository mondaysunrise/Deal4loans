<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;

		$result = ("Select * From Req_Loan_Against_Property Where RequestID=$RequestID");
		 list($recordcount,$myrow)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
		//echo mysql_error();
		if ($cntr<count($getrow)) {
			$Employment_Status=$myrow[$cntr]["Employment_Status"];
			$Company_Name=$myrow[$cntr]["Company_Name"];
			$City=$myrow[$cntr]["City"];
			$City_Other=$myrow[$cntr]["City_Other"];
			$Total_Experience=$myrow[$cntr]["Total_Experience"];
			$Net_Salary=$myrow[$cntr]["Net_Salary"];
			$Residential_Status=$myrow[$cntr]["Residential_Status"];
			$Property_Type=$myrow[$cntr]["Property_Type"];
			$Property_Value=$myrow[$cntr]["Property_Value"];
			$Loan_Amount=$myrow[$cntr]["Loan_Amount"];
			$Descr=$myrow[$cntr]["Descr"];

		    mysql_free_result($result);
		}
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$UserID = $_SESSION['UserID'];

		/* FIX STRINGS */
		$RequestID = FixString($RequestID);
		$Employment_Status = FixString($Employment_Status);
		$Company_Name = FixString($Company_Name);
		$City_Other = FixString($City_Other);
		$City = FixString($City);
		$Total_Experience = FixString($Total_Experience);
		$Net_Salary = FixString($Net_Salary);
		$Residential_Status = FixString($Residential_Status);
		$Property_Type = FixString($Property_Type);
		$Property_Value = FixString($Property_Value);
		$Loan_Amount = FixString($Loan_Amount);
		$Descr = FixString($Descr);

		//SQL Query
		//$sql = "Update Req_Loan_Against_Property SET Employment_Status='$Employment_Status', Company_Name='$Company_Name', City='$City', City_Other='$City_Other', Total_Experience='$Total_Experience', Net_Salary='$Net_Salary', Residential_Status='$Residential_Status', Property_Type='$Property_Type',	Property_Value='$Property_Value', Loan_Amount='$Loan_Amount', Descr='$Descr', Dated=Now() WHERE RequestID=$RequestID" ;

		
		$DataArray = array("Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Total_Experience"=>$Total_Experience, "Net_Salary"=>$Net_Salary, "Residential_Status"=>$Residential_Status, "Property_Type"=>$Property_Type, "Property_Value"=>$Property_Value, "Loan_Amount"=>$Loan_Amount, "Descr"=>$Descr, "Dated"=>$Dated);
		$wherecondition ="RequestID=$RequestID";
		Mainupdatefunc ('Req_Loan_Against_Property', $DataArray, $wherecondition);
        
		
		//$result = ExecQuery($sql);
		//echo mysql_error();

		if ($result == 1) 
			$Msg = getAlert("Your request has been updated. !!", TRUE, "myRequests.php");
		else
			$Msg = "** There is a problem in adding your request. **";

    }		
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Loan Against Property</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
 <?php include '~Top.php'; ?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><img src="images/lap1.gif" usemap="#map_name1"></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">A dream comes true! An ALL PURPOSE LOAN for anything that life throws up at you!! Do you need funds for a Marriage ceremony, want to take your family to a well-deserved holiday or for a sudden medical emergency? You have some property, but would rather not sell it? Then why not avail of this ALL PURPOSE LOAN. We now 
      make it very much possible for you to only keep your property but also have liquid funds against it.</td></tr></table> <map name="map_name1">
  <area shape="rect" coords="17,52,120,70" hrEF="Contents_Loan_Against_Property_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="Request_Loan_Against_Property_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="Contents_Loan_Against_Property_Mustread.php">
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
		{alert("Please Enter City Name to Continue");
		theFrm.City.focus();
		return false;}
	if(!checkNum(theFrm.Total_Experience, 'Total Experience',0))
		return false;
	if(!checkNum(theFrm.Net_Salary, 'Net Salary',0))
		return false;
	if(!checkNum(theFrm.Property_Value, 'Value of the Property',0))
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
     <td colspan="2" class="head1">Edit Loan Against Property Request</td>
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
     <td><input type="text" name="Company_Name" size="30" maxlength="15" value="<?=$Company_Name?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">City Name</td>
	 <td class="bodyarial11"><select size="1" name="City" value="<?=$City?>">
     <?=getCityList($City)?>
	 </select> Others
     <input type="text" name="City_Other" size="10" value="<?=$City_Other?>" ></td>
   </tr>
   <tr>
     <td class="bodyarial11">Total Experience/<br>
     Total Years in Business</td>
     <td>
     <input type="text" name="Total_Experience" size="15" maxlength="15" value="<?=$Total_Experience?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Net Salary(Yearly)</td>
     <td>
     <input type="text" name="Net_Salary" size="15" maxlength="30" value="<?=$Net_Salary?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Residential Status</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Residential_Status" class="NoBrdr" checked <?=AmIChecked($Residential_Status, 1)?>>Owned
     <input type="radio" value="2" name="Residential_Status" class="NoBrdr" <?=AmIChecked($Residential_Status, 2)?>>Rented     <input type="radio" value="3" name="Residential_Status" class="NoBrdr" <?=AmIChecked($Residential_Status, 3)?>>Company Provided</td>
   </tr>
   <tr>
     <td class="bodyarial11">Property Type</td>
     <td class="bodyarial11"><select size="1" name="Property_Type">
	<?=AmISelected("Commercial Office Space", $Property_Type, "0")?>
	<?=AmISelected("Apartment", $Property_Type, "1")?>
	<?=AmISelected("Industrial House", $Property_Type, "2")?>
	<?=AmISelected("Showroom", $Property_Type, "3")?>
	<?=AmISelected("Factory", $Property_Type, "4")?>
	<?=AmISelected("Plot", $Property_Type, "5")?>
	<?=AmISelected("Godown", $Property_Type, "6")?>
	<?=AmISelected("Bungalow", $Property_Type, "7")?>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Value Of Property</td>
     <td>
     <input type="text" name="Property_Value" size="15" maxlength="30" value="<?=$Property_Value?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Loan Amount Required</td>
     <td>
     <input type="text" name="Loan_Amount" size="15" maxlength="30" value="<?=$Loan_Amount?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11" valign="top">Special Requirements</td>
     <td><textarea rows="5" name="Descr" cols="50"><?=$Descr?></textarea></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><br><input type="submit" value="Submit" class="bluebutton"><input type="reset" value="Reset" class="bluebutton"></td>
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