<?php
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncBike.php';

//require 'neweligibilelist.php';

	session_start();
	$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];
		
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


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$clname =$_POST['clname'];
		$clemail = $_POST["clemail"];
		$clmobile = $_POST["clmobile"];
		$clemployment_status = $_POST["clemployment_status"];
		$clnet_salary = $_POST["clnet_salary"];
		$clcompany_name = $_POST["clcompany_name"];
		$cldob=$_POST['cldob'];
		$clloan_amount = $_POST["clloan_amount"];
		$clcity = $_POST["clcity"];
		$clcity_other = $_POST["clcity_other"];
		$clbidder_count = $_POST["clbidder_count"];
		$clfeedback = $_POST["clfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		$Bidder_Id = $_REQUEST['BidderId'];
		$cladd_comment= $_REQUEST['cladd_comment'];
		$clbike_model= $_REQUEST['clbike_model'];
		$clbike_varient= $_REQUEST['clbike_varient'];
		$clDated = $_REQUEST['Dated'];
		$clcar_type = $_REQUEST['clcar_type'];
		$car_booked = $_REQUEST['car_booked'];
		$acc_no = $_REQUEST['acc_no'];
		$Primary_Acc = $_REQUEST['Primary_Acc'];
		$clbank = $_REQUEST['clbank'];

	
$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 


$Final_Bid = substr($Final_Bid, 0, strlen($Final_Bid)-1); //remove the final comma sign from the final array
//echo "hello".$Final_Bid."<br>";
if(strlen($Final_Bid)>0)
	{
	$Allocated=2;
	$Is_Valid=1;
	}
	else 
	{
		$Allocated=0;
		$Is_Valid=0;
	}
	
	if(strlen($Final_Bid)>0)
	{
		$updatelead="Update Req_Loan_Bike set Bike_Varient='$clbike_varient', Bike_Model='$clbike_model', Name='$clname', Company_Name='$clcompany_name', DOB='$cldob', Email='$clemail', City='$clcity', City_Other='$clcity_other', Mobile_Number='$clmobile', Net_Salary='$clnet_salary', Loan_Amount='$clloan_amount', Employment_Status='$clemployment_status', Bidderid_Details='$Final_Bid', Add_Comment='$cladd_comment', Updated_Date=Now(),CL_Bank='$clbank', Allocated='$Allocated', Is_Valid='$Is_Valid', IsModified=2 where RequestID=".$post;
	}
	else
	{
		$updatelead="Update Req_Loan_Bike set Bike_Varient='$clbike_varient', Bike_Model='$clbike_model', Name='$clname', Company_Name='$clcompany_name', DOB='$cldob', Email='$clemail', City='$clcity', City_Other='$clcity_other', Mobile_Number='$clmobile', Net_Salary='$clnet_salary', Loan_Amount='$clloan_amount', Employment_Status='$clemployment_status',Add_Comment='$cladd_comment', 	CL_Bank='$clbank',Updated_Date=Now() where RequestID=".$post;
	}
	//echo "query".$updatelead;
	 $updateleadresult=ExecQuery($updatelead);

 if(strlen($clfeedback)>0)
	{
		if($clfeedback=="Not Contactable")
		{
			$counter="1";
		}
		else
		{
			$counter="";
		}

		$strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=3");		
		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = mysql_fetch_array($result);
			$notcontactableCounter=$row["not_contactable_counter"];
		
			$updatedcounter=$notcontactableCounter+1;
			$strSQL="Update Req_Feedback Set Feedback='".$clfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
			if($notcontactableCounter<2)
			{
				$product="Bike Loan";	
				$feedback=$clfeedback;
					include "scripts/feedbackmailerscript.php";

					$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if($feedback=="Not Contactable" && (strlen($clemail)>0))
					{
					//	mail($clemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
					}
			}

		}
		else
		{
			$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",10,'".$clfeedback."','".$FollowupDate."','".$counter."')";

			$product="Bike Loan";	
			$feedback=$clfeedback;
			include "scripts/feedbackmailerscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//echo $Type_Loan;
			if($feedback=="Not Contactable" && (strlen($clemail)>0))
			{
				//mail($clemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
			}
		}
		
		//echo "<br>";
//		echo $strSQL;
		
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}

  if(strlen($clfeedback)>0)
	{
		if($clfeedback=="Not Contactable")
		{
			$counter="1";
		}
		else
		{
			$counter="";
		}

		$strSQLcl="";
		$Msg="";
		$resultcl = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=10");		
		
		$num_rowscl = mysql_num_rows($resultcl);
		if($num_rowscl > 0)
		{	
			$rowcl = mysql_fetch_array($resultcl);
			$notcontactableCounter = $rowcl["not_contactable_counter"];
		
			$updatedcounter=$notcontactableCounter+1;
			$strSQLcl="Update Req_Feedback Set Feedback='".$clfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."'";
			$strSQLcl=$strSQLcl."Where FeedbackID=".$rowcl["FeedbackID"];
		}
		else
		{
			$strSQLcl="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter) Values (";
			$strSQLcl=$strSQLcl.$post.",".$Bidder_Id.",10,'".$clfeedback."','".$FollowupDate."','".$counter."')";
		
		}

		//echo $strSQL;
		$resultcl = ExecQuery($strSQLcl);
		if ($resultcl == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}



	}
		
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style type="text/css">
	
	/* START CSS NEEDED ONLY IN DEMO */
	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;
		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
	

<STYLE>
a
{
	cursor:pointer;

}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}</style>

</head>

<body >
<p align="center"><b>Bike loan Lead Details </b></p>

<?php 


$viewqry="select * from Req_Loan_Bike LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Bike.RequestID and Req_Feedback.BidderID= '".$bidid."' where Req_Loan_Bike.RequestID=".$post." "; 

//echo "dd".$viewqry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
$Mobile = mysql_result($viewlead,0,'Mobile_Number');
$Email = mysql_result($viewlead,0,'Email');
$Net_Salary = mysql_result($viewlead,0,'Net_Salary');
$Is_Valid = mysql_result($viewlead,0,'Is_Valid');
$City = mysql_result($viewlead,0,'City');
$City_Other = mysql_result($viewlead,0,'City_Other');
$Dated = mysql_result($viewlead,0,'Dated');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
$source = mysql_result($viewlead,0,'source');
$Pincode = mysql_result($viewlead,0,'Pincode');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$Feedback = mysql_result($viewlead,0,'Feedback');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$DOB = mysql_result($viewlead,0,'DOB');
//$Company_Name  = mysql_result($viewlead,0,'Company_Name');
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
$Bike_Model = mysql_result($viewlead,0,'Bike_Model');
$Bike_Varient = mysql_result($viewlead,0,'Bike_Varient');
$Add_Comment = mysql_result($viewlead,0,'Add_Comment');



$getDOB =DetermineAgeGETDOB($DOB);
	
$monthsalary = $Net_Salary/12;

if($Bidder_Count!=0)
{
	$strbidderid="";
	$z=0;
$retrieve_query="select BidderID from Req_Feedback_Bidder1 where AllRequestID=".$post." and Reply_Type=10";
//echo $retrieve_query."<br>";
	$retrieve_result = ExecQuery($retrieve_query);
	$retrieve_recordcount =mysql_num_rows($retrieve_result);
	for($r=0;$r<$retrieve_recordcount;$r++)
	{
		$BidderID12 = mysql_result($retrieve_result,$r,'BidderID');
		$strbidderid = $strbidderid.$BidderID12.",";

	}
	
}

?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" ><input type="hidden" name="Dated" id="Dated" value="<? echo $Dated; ?>"><input type="hidden" name="BidderId" value="<?echo $bidid;?>"><input type="hidden" name="clrequestid" id="clrequestid" value="<?echo $post;?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><input type="text" name="clname" id="clname" value="<? echo $Name;?>"></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="clemail" id="clemail" value="<? echo $Email;?>"></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="cldob" id="cldob"size="15" value="<? echo $DOB;?>"></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="text" name="clmobile" size="15" value="<? echo $Mobile;?>"></td>
			</tr>
		
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><select size="1" name="clcity" id="clcity"> <?=getCityList($City)?></select></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><input type="text" name="clcity_other" id="clcity_other" size="10" value="<?echo $City_Other;?>" ></td>
		</tr>
	
	
		
<tr>
	
		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><select class="fontstyle" name="clemployment_status" id="clemployment_status">
			<option value="1" <? if($Employment_Status ==1){echo "selected"; } ?>>Salaried</option>
			<option value="0" <? if($Employment_Status ==0) {echo "selected"; } ?>>Self Employed</option></select>		</td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><input type="text" name="clnet_salary" id="clnet_salary" value="<?echo $Net_Salary;?>"  onKeyUp="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" onKeyPress="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('plnet_salary','formatedIncome','wordIncome');"></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><input type="text" name="clcompany_name" id="clcompany_name" value="<? echo $Company_Name;?>"></td><td ><b>Loan Amount</b></td>
	<td><input type="text" name="clloan_amount" id="clloan_amount" value="<? echo $Loan_Amount;?>" onKeyUp="getDigitToWords('clloan_amount','formatedloanamt','wordloanamt');" onKeyPress="getDigitToWords('clloan_amount','formatedloanamt','wordloanamt');"></td>
    </tr>
<tr>

	<td><b>Bike Model</b></td>
	<td><input type="text" name="clbike_model" id="clbike_model" value="<? echo $Bike_Model;?>"></td>

	<td><b>Bike Varient</b></td>
	<td><input type="text" name="clbike_varient" id="clbike_varient" value="<? echo $Bike_Varient;?>"></td>
</tr>
	

<tr>
	
		<!--<table width="100%">
		<tr>--><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Bidders Details </b></td></tr>
		<? if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}
//echo $City;?>
<tr><td class="fontstyle"><b>Eligible for Bidders</b></td><? if(strlen($Bidderid_Details)>0){?><td class="fontstyle" colspan="2"> already send</td><? } else {?><td colspan="2"><div id="checkdiv" name="checkdiv"><? list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Bike",$post,$City);
$finalBidderNamestr = implode(",",$finalBidderName);
?>
<input type="hidden" name="clbank" id="clbank" value="<? echo $finalBidderNamestr; ?>">
<?
   for($i=0;$i<count($FinalBidder);$i++)
			{
		echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
		//echo $FinalBidder[$i];
			}
}
	
		?></div></td>
</tr>




<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>


<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle"><select name="clfeedback" id="feedback" >
		<option value="No Feedback" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <? if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Send Now" <? if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
		<option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Duplicate" <? if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
	<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
</select>	</td>
	

	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
<tr>
     <td class="fontstyle"><b>Add Comment</b></td>
	 <td align="center"><textarea rows="3" cols="25" name="cladd_comment" id="cladd_comment"><? echo $Add_Comment; ?> </textarea></td>
	 <td>Source</td>
				<td><?  echo $source;?></td>
        </tr>
 <tr><td colspan="2"><input type="text" name="is_valid" id="is_valid" value="<? echo $Is_Valid; ?>" style="width:20px;" readonly ></td></tr> 

 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit">      </td>
   </tr>
   <tr><td colspan="4" align="center">&nbsp;</td></tr>
</table>
</form>
</body>
</html>