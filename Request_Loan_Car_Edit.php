<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;

		$result = ("Select * From Req_Loan_Car Where RequestID=$RequestID");
	
	 list($recordcount,$myrow)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		//echo mysql_error();
		if ($cntr<count($getrow)) {
			$Employment_Status=$myrow[$cntr]["Employment_Status"];
			$Company_Name=$myrow[$cntr]["Company_Name"];
			$City=$myrow[$cntr]["City"];
			$City_Other=$myrow[$cntr]["City_Other"];
			$Net_Salary=$myrow[$cntr]["Net_Salary"];
			$Car_Make=$myrow[$cntr]["Car_Make"];
			$Car_Model=$myrow[$cntr]["Car_Model"];
			$Car_Type=$myrow[$cntr]["Car_Type"];
			$Loan_Tenure=$myrow[$cntr]["Loan_Tenure"];
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
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Net_Salary = FixString($Net_Salary);
		$Car_Make = FixString($Car_Make);
		$Car_Model = FixString($Car_Model);
		$Car_Type = FixString($Car_Type);
		$Loan_Tenure = FixString($Loan_Tenure);
		$Loan_Amount = FixString($Loan_Amount);
		$Descr = FixString($Descr);
		   $Dated = ExactServerdate();

		//SQL Query
		//$sql = "Update Req_Loan_Car SET Employment_Status='$Employment_Status', Company_Name='$Company_Name', City='$City', City_Other='$City_Other', Net_Salary='$Net_Salary', Car_Make='$Car_Make', Car_Model='$Car_Model', Car_Type='$Car_Type', Loan_Tenure= '$Loan_Tenure', Loan_Amount='$Loan_Amount', Descr='$Descr', Dated=Now() WHERE RequestID=$RequestID" ;

		//$result = ExecQuery($sql);
		//echo mysql_error();
 		$DataArray = array("Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Net_Salary"=>$Net_Salary, "Car_Make"=>$Car_Make, "Car_Model"=>$Car_Model, "Car_Type"=>$Car_Type, "Loan_Tenure"=> $Loan_Tenure, "Loan_Amount"=>$Loan_Amount, "Descr"=>$Descr, "Dated"=>$Dated);
		$wherecondition ="RequestID=$RequestID";
		Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);

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
<title>Car Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<link href="includes/style1.css" rel="stylesheet" type="text/css">
 <?php include '~Top.php'; ?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><img src="images/Car_loan2.gif" usemap="#map_name2"></td><td valign="middle" style="padding-left:10px" ><font class="newstyle"> Do you want a decent set of wheels but looking for a loan to take its possession? Given the large pool of companies 
                        that are into this business of providing loans, 
                                it's a matter of which one to pick. This section 
                                here deals with how to get about wrangling with 
                                the best loan deal for your chosen vehicle. loans.</td></tr></table><map name="map_name2">
  <area shape="rect" coords="17,52,120,70" hrEF="Contents_Car_Loan_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="Request_Loan_Car_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="Contents_Car_Loan_Mustread.php">
    <area shape="rect" coords="17,140,80,100" hrEF="Contents_Car_Loan_Faqs.php">
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
	if(!checkNum(theFrm.Net_Salary, 'Net Salary',0))
		return false;
	if(!checkData(theFrm.Car_Model, 'Car Model',2))
		return false;
	if(!checkNum(theFrm.Loan_Tenure, 'Loan Tenure',0))
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
     <td colspan="2" class="head1">Edit Car Loan Request</td>
   </tr>
   <tr><td colspan="2" id="Alert">&nbsp; <?=$Msg?></td></tr>
   <tr>
     <td width="35%" class="bodyarial11">Employment Status</td>
     <td width="65%" class="bodyarial11"><select size="1" name="Employment_Status">
	<?=AmISelected("Salaried", $Employment_Status, "1")?>
	<?=AmISelected("Self Employed", $Employment_Status, "0")?>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Company Name</td>
     <td class="bodyarial11"><input type="text" name="Company_Name" size="30" maxlength="15" value="<?=$Company_Name?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">City Name</td>
	 <td class="bodyarial11"><select size="1" name="City" value="<?=$City?>">
     <?=getCityList($City)?>
	 </select> Others
     <input type="text" name="City_Other" size="10" value="<?=$City_Other?>" ></td>
   </tr>
   <tr>
     <td class="bodyarial11">Net Salary(Yearly)</td>
     <td class="bodyarial11">
     <input type="text" name="Net_Salary" size="15" maxlength="30" value="<?=$Net_Salary?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Car Make</td>
     <td class="bodyarial11">
     <select size="1" name="Car_Make">
	<?=AmISelected("Chevrolet", $Car_Make, "1")?>
	<?=AmISelected("Fiat", $Car_Make, "2")?>
	<?=AmISelected("Ford", $Car_Make, "3")?>
	<?=AmISelected("General Motors", $Car_Make, "4")?>
	<?=AmISelected("Hindustan Motors", $Car_Make, "5")?>
	<?=AmISelected("Honda", $Car_Make, "6")?>
	<?=AmISelected("Hyundai", $Car_Make, "7")?>
	<?=AmISelected("Lexus", $Car_Make, "8")?>
	<?=AmISelected("Mahindra & Mahindra", $Car_Make, "9")?>
	<?=AmISelected("Maruti Udyog Ltd.", $Car_Make, "10")?>
	<?=AmISelected("Mercedes Benz", $Car_Make, "11")?>
	<?=AmISelected("Nissan India", $Car_Make, "12")?>
	<?=AmISelected("Porsche", $Car_Make, "13")?>
	<?=AmISelected("Skoda Auto", $Car_Make, "14")?>
	<?=AmISelected("Tata Motors", $Car_Make, "15")?>
	<?=AmISelected("Toyota Kirlosker", $Car_Make, "16")?>
	<?=AmISelected("Others", $Car_Make, "17")?>
	 </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Car Model</td>
     <td class="bodyarial11">
     <input type="text" name="Car_Model" size="15" maxlength="30" value="<?=$Car_Model?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Car Type</td>
     <td class="bodyarial11">
     <select size="1" name="Car_Type">
	<?=AmISelected("New", $Car_Type, "1")?>
	<?=AmISelected("Used", $Car_Type, "0")?>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Loan Tenure (in Years)</td>
     <td class="bodyarial11">
     <input type="text" name="Loan_Tenure" size="15" maxlength="30" value="<?=$Loan_Tenure?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Loan Amount Required</td>
     <td class="bodyarial11">
     <input type="text" name="Loan_Amount" size="15" maxlength="30" value="<?=$Loan_Amount?>"></td>
   </tr>
   <tr>
     <td valign="top" class="bodyarial11">Special Requirements</td>
     <td class="bodyarial11"><textarea rows="5" name="Descr" cols="50"><?=$Descr?></textarea></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><br><input type="submit" class="bluebutton" value="Submit">
     <input type="reset" class="bluebutton" value="Reset"></td>
   </tr>
  </table>
 </form>
	
     </td>
   </tr>
 </table>
 </div>
 </div>
<?php include '~Bottom.php';?>
 </center>
</div>
</body>

</html>