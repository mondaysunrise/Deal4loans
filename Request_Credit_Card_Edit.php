<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;

		$result = ("Select * From Req_Credit_Card Where RequestID=$RequestID");
		//echo mysql_error();
		 list($recordcount,$myrow)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
		if ($cntr<count($myrow)) {
			$Employment_Status = $myrow[$cntr]["Employment_Status"];
			$Company_Name = FixNewLine($myrow[$cntr]["Company_Name"]);
			$City = FixNewLine($myrow[$cntr]["City"]);
			$City_Other = FixNewLine($myrow[$cntr]["City_Other"]);
			$Total_Experience = FixNewLine($myrow[$cntr]["Total_Experience"]);
			$Net_Salary = FixNewLine($myrow[$cntr]["Net_Salary"]);
			$Vehicles_Owned = $myrow[$cntr]["Vehicles_Owned"];
			$CC_Holder = $myrow[$cntr]["CC_Holder"];
			$Descr = FixNewLine($myrow[$cntr]["Descr"]);
			
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
		$Total_Experience = FixString($Total_Experience);
		$Net_Salary = FixString($Net_Salary);
		$Descr = FixString($Descr);

		//SQL Query
		//$sql = "UPDATE Req_Credit_Card SET Employment_Status='$Employment_Status', Company_Name='$Company_Name', City='$City', City_Other='$City_Other', Total_Experience='$Total_Experience', Net_Salary='$Net_Salary', Vehicles_Owned='$Vehicles_Owned', CC_Holder='$CC_Holder', Dated=Now(), Descr='$Descr' WHERE RequestID=$RequestID";

		$DataArray = array("Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Total_Experience"=>$Total_Experience, "Net_Salary"=>$Net_Salary, "Vehicles_Owned"=>$Vehicles_Owned, "CC_Holder"=>$CC_Holder, "Dated"=>$Dated, "Descr"=>$Descr);
		$wherecondition ="RequestID=$RequestID";
		Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
		
		$result = ExecQuery($sql);
		echo mysql_error();

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
<title>Credit Card</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>


<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><img src="images/Credit_card1.gif" usemap="#map_name3"></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">Have you ever stood behind 
                                someone in line at the store and watched him 
                                shuffle through a stack of what must be at least 
                                10 credit cards? Consumers with this many cards 
                                are still in the minority, but experts say that 
                                the majority of modern day inhabitants have at 
                                least one credit card and usually two or three.</td></tr></table>   <map name="map_name3">
  <area shape="rect" coords="17,52,120,70" hrEF="Contents_Credit_Card_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="Request_Credit_Card_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="Contents_Credit_Card_Mustread.php">
     <area shape="rect"coords="17,140,80,100" hrEF="Contents_Credit_Card_Faqs.php">
         </map> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
  <table border="1">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td>
<td>
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
	return true;
    }
    </Script>
      <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
	<input type="hidden" name="RequestID" value="<?=$RequestID?>">
 <table width="450" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td colspan="2" class="head1">Edit Credit Card Request</td>
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
     <td class="bodyarial11">Total Experience(Years)/<br>
     Total Years in Business</td>
     <td class="bodyarial11">
     <input type="text" value="<?=$Total_Experience?>" name="Total_Experience" size="15" maxlength="15" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Net Salary(Yearly)</td>
     <td class="bodyarial11">
     <input type="text" value="<?=$Net_Salary?>" name="Net_Salary" size="15" maxlength="30" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Vehicles Owned</td>
     <td class="bodyarial11"><select size="1" name="Vehicles_Owned">
	<?=AmISelected("2 Wheeler", $Vehicles_Owned, "0")?>
	<?=AmISelected("4 Wheeler", $Vehicles_Owned, "1")?>
	<?=AmISelected("Other", $Vehicles_Owned, "2")?>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Are you a Credit Card Holder of Any Bank?</td>
     <td class="bodyarial11"><input type="radio" value="1" name="CC_Holder" class="NoBrdr" <?=AmIChecked($CC_Holder, 1)?>>Yes
     <input type="radio" value="0" name="CC_Holder" class="NoBrdr" <?=AmIChecked($CC_Holder, 0)?>>No</td>
   </tr>
   <tr>
     <td valign="top" class="bodyarial11">Special benefit required for the card</td>
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
            </table></td></tr></table>
 </div>
  <?php// include '~Right.php';?>
  </div>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>