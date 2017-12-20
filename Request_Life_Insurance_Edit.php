<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;

		$result = ("Select * From Req_Life_Insurance Where RequestID=$RequestID");
		 list($recordcount,$myrow)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
		
		//echo mysql_error();
		if ($cntr<count($getrow)) {
			$Employment_Status=$myrow[$cntr]["Employment_Status"];
			//$Company_Name=$myrow["Company_Name"];
			$City=$myrow[$cntr]["City"];
			$City_Other=$myrow[$cntr]["City_Other"];
			$Marital_Status = $myrow[$cntr]["Marital_Status"];
			$Annual_Income=$myrow[$cntr]["Annual_Income"];
			$no_of_dependent = $myrow[$cntr]["No_of_dependents"];					
			$Plan_Interested = $myrow[$cntr]["Plan_Interested"];		
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
		//$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Annual_Income = FixString($Annual_Income);
		$no_of_dependent = FixString($no_of_dependent);
		$Plan_Interested = FixString($Plan_Interested);
		
		//SQL Query
		$sql = "Update Req_Life_Insurance SET Employment_Status='$Employment_Status', City='$City', City_Other='$City_Other', Marital_Status='$Marital_Status',  No_of_dependents='$no_of_dependent', Annual_Income='$Annual_Income', Plan_Interested='$Plan_Interested' WHERE RequestID=$RequestID" ;

		$DataArray = array("Employment_Status"=>$Employment_Status, "City"=>$City, "City_Other"=>$City_Other, "Marital_Status"=>$Marital_Status, "No_of_dependents"=>$no_of_dependent, "Annual_Income"=>$Annual_Income, "Plan_Interested"=>$Plan_Interested);
		$wherecondition ="RequestID=$RequestID";
		Mainupdatefunc ('Req_Life_Insurance', $DataArray, $wherecondition);
        
		
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
<title>Life Insurance</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">


 <?php include '~Top.php'; ?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/banner_life_gif.gif" /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
  <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td>
    <Script Language="JavaScript">
	function initPage(strPlan)
{
       if (document.getElementById('plantype') != undefined)
       {
               document.getElementById('plantype').innerHTML = strPlan;
       }

       return true;
}

   function validateMe(theFrm){
	
	if (theFrm.City.selectedIndex==0)
		{alert("Please Enter City Name to Continue");
		theFrm.City.focus();
		return false;}
	if(!checkNum(theFrm.Annual_Income, 'Annual Income',0))
		return false;
	if(!checkNum(theFrm.no_of_dependent, 'no of dependent',0))
		return false;
	return true;
    }
    </Script>
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
 <input type="hidden" name="RequestID" value="<?=$RequestID?>">
 <table width="450" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td colspan="2" class="head1">Edit Life Insurance Request</td>
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
    
   <tr>
     <td class="bodyarial11">City Name</td>
	 <td class="bodyarial11"><select size="1" name="City" value="<?=$City?>">
     <?=getCityList($City)?>
	 </select> Others
     <input type="text" name="City_Other" size="10" value="<?=$City_Other?>" ></td>
   </tr>
    <tr>
     <td class="bodyarial11">Marital Status</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Marital_Status" class="NoBrdr" <?=AmIChecked($Marital_Status,1)?>>Single
     <input type="radio" value="2" name="Marital_Status" class="NoBrdr" <?=AmIChecked($Marital_Status,2)?>>Married</td>
   </tr>
   <tr>
     <td class="bodyarial11">No of Dependents</td>
     <td class="bodyarial11">
     <input type="text" name="no_of_dependent" size="15" maxlength="30" value="<?=$no_of_dependent?>"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Annual Income(Yearly)</td>
     <td class="bodyarial11">
     <input type="text" name="Annual_Income" size="15" maxlength="30" value="<?=$Annual_Income?>"></td>
   </tr>
        <tr> 
     <td valign="top" class="bodyarial11">Plan Interested For</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Plan_Interested" class="NoBrdr" <?=AmIChecked($Plan_Interested,1)?>>Protection
     <input type="radio" value="2" name="Plan_Interested" class="NoBrdr" <?=AmIChecked($Plan_Interested,2)?>>Investment
	 <input type="radio" value="3" name="Plan_Interested" class="NoBrdr" <?=AmIChecked($Plan_Interested,3)?>>Pension
	 <input type="radio" value="4" name="Plan_Interested" class="NoBrdr" <?=AmIChecked($Plan_Interested,4)?>>Savings</td>
</tr>
<tr>
<td>&nbsp</td>
<td>&nbsp</td>
</tr>
<tr>
<td>&nbsp</td>
<td>&nbsp</td>
</tr>
<tr>
<td>&nbsp</td>
<td>&nbsp</td>
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