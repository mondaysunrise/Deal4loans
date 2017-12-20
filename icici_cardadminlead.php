<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncICICICC.php';

	session_start();
	$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];
		
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		/* FIX STRINGS */
		
		$Bidder_Id = $_REQUEST['BidderId'];
		$appointment_date  = $_REQUEST["appointment_date"];
		$appointment_time  = $_REQUEST["appointment_time"];
		$appointment_place  = $_REQUEST["appointment_place"];
		$appointment_address = $_REQUEST["appointment_address"];
		$Salary_Account = $_REQUEST["Salary_Account"];
		$ccfeedback = $_REQUEST["ccfeedback"];
		

	$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$cccompany_name.'"';
 list($recordcounthdfccc,$grow)=MainselectfuncNew($gethdfccccompany,$array = array());
		$cntr=0;

if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $grow[$cntr]["company_category"];
	}

if($hdfc_cccategory=="Cat AB" || $hdfc_cccategory=="ELITE" || $hdfc_cccategory=="PREFERRED" || $hdfc_cccategory=="SUPERPRIME")
	{
		$Company_HDFC_Cat=1;
	}
	else
	{
		$Company_HDFC_Cat=0;
	}

$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 

$r = count($which_card);
	$s  = 0;
	while ($s < $r)
	{
		$which_cc .= "$which_card[$s], ";
		$s++;
}

$which_cc = substr($which_cc, 0, strlen($which_cc)-2);
if(strlen($applied_card_name)>0)
{
	$final_cardselect = $applied_card_name.",".$which_cc;
}
else
{
	$final_cardselect = $which_cc;
}


	 if(strlen($ccfeedback)>0)
	{
		 /*if($ccfeedback=="Verified")
		{
			$upccquery ="Update Req_Credit_Card set lead_cost=1 Where (RequestID=".$post.")";
			$upccqueryresult = ExecQuery($upccquery);

			$upccquerysn ="Update icicilms_allocation set icici_sendnow_date=Now() Where (cc_requestid=".$post.")";
			$upccquerysnresult = ExecQuery($upccquerysn);	
		}*/
		$strSQL="";
		$Msg="";
	
		$result = ("select iciciallocateid from icicilms_allocation where cc_requestid=".$post."  AND product =4");		
 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$j=0;

		if($num_rows > 0)
		{
			$updatedcounter=$notcontactableCounter+1;
			$strSQL="Update icicilms_allocation Set verifier_feedback='".$ccfeedback."',icici_followupdate='".$FollowupDate."'";
			$strSQL=$strSQL."Where iciciallocateid=".$row[$j]["iciciallocateid"];
		}
		
	}

}	?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-cclist.js"></script>
<STYLE>
a
{	cursor:pointer;
}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}

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
</head>
<body>
<p align="center"><b>Credit Card Lead Details </b></p>
<?php 
$viewqry="select * from Req_Credit_Card LEFT OUTER JOIN icicilms_allocation ON icicilms_allocation.cc_requestid=Req_Credit_Card.RequestID and icicilms_allocation.bidderid in (936,69) where Req_Credit_Card.RequestID=".$post." "; 
//echo "dd".$viewqry;

 list($viewleadscount,$Arrrow)=MainselectfuncNew($viewqry,$array = array());
		$P=0;

$Name = $Arrrow[$P]['Name'];
$Add_Comment= $Arrrow[$P]['Add_Comment'];
$Mobile = $Arrrow[$P]['Mobile_Number'];
$Landline = $Arrrow[$P]['Landline'];
$Landline_O = $Arrrow[$P]['Landline_O'];
$Std_Code = $Arrrow[$P]['Std_Code'];
$Std_Code_O = $Arrrow[$P]['Std_Code_O'];
$Net_Salary = $Arrrow[$P]['Net_Salary'];
$City = $Arrrow[$P]['City'];
$City_Other = $Arrrow[$P]['City_Other'];
$Is_Valid = $Arrrow[$P]['Is_Valid'];
$Updated_Date = $Arrrow[$P]['Updated_Date'];
$Employment_Status = $Arrrow[$P]['Employment_Status'];
$Email = $Arrrow[$P]['Email'];
$source = $Arrrow[$P]['source'];
$CC_Holder = $Arrrow[$P]['CC_Holder'];
$Salary_Account = $Arrrow[$P]['Salary_Account'];
$No_of_Banks = $Arrrow[$P]['No_of_Banks'];
$followup_date = $Arrrow[$P]['icici_followupdate'];
$icici_feedback = $Arrrow[$P]['icici_feedback'];
$Feedback = $Arrrow[$P]['verifier_feedback'];
	
$Company_Name = $Arrrow[$P]['Company_Name'];
$month_sal= $Net_Salary/12;
$No_of_Banks = $Arrrow[$P]['No_of_Banks'];
$Applied_With_Banks = $Arrrow[$P]['Applied_With_Banks'];
$applied_card_name = $Arrrow[$P]['applied_card_name'];
$Credit_Limit = $Arrrow[$P]['Credit_Limit'];
$Card_Vintage = $Arrrow[$P]['Card_Vintage'];
$DOB = $Arrrow[$P]['DOB'];
$Bidderid_Details = $Arrrow[$P]['Bidderid_Details'];
$getapptqry = "select RuleStatus,Response,appointment_date, appointment_time,appointment_place,appointment_address,	documents from credit_card_cibil_check where (RequestID='".$post."') order by cibilchkid DESC";
 list($rescount,$appt_dt)=MainselectfuncNew($getapptqry,$array = array());
		$Q=0;

$appointment_place = $appt_dt[$Q]["appointment_place"];
$appointment_address = $appt_dt[$Q]["appointment_address"];
$appointment_time = $appt_dt[$Q]["appointment_time"];
$documents = $appt_dt[$Q]["documents"];
?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<input type="hidden" name="BidderId" value="<? echo $bidid;?>">
<input type="hidden" name="ccrequestid" id="ccrequestid" value="<? echo $post;?>">
<input type="hidden" name="applied_card_name" id="applied_card_name" value="<? echo $applied_card_name;?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><? echo $Name;?></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><? //echo $Email;?></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><? echo $DOB;?></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<? //echo $Mobile;?></td>
			</tr>			
		<tr>
			<td class="fontstyle"><b>Residence No</b></td>
			<td class="fontstyle"><? echo $Std_Code;?>-<? echo $Landline;?></td>
			<td class="fontstyle" ><b>Office No.</b></td>
			<td class="fontstyle"><? echo $Std_Code_O; ?>"-<? echo $Landline_O;?></td>
		</tr>				
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><? echo $City; ?></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><? echo $City_Other;?></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><? echo $Pincode;?></td>
        <td class="fontstyle"><b>Salary Account</b></td><td><? echo $Salary_Account; ?></td>
				</tr>		
		
	<tr>
		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><? if($Employment_Status ==1){?>Salaried<? }?>
			 <? if($Employment_Status ==0) { ?>Self Employed <? } ?>
		</td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><? echo $Net_Salary; ?></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><? echo $Company_Name;?></td>

	<td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
<td><label for="country">check Company Name </label></td>
<td><? echo $Company_Name;?>                               
</td><td colspan="2">&nbsp;</td></tr>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td></tr>
<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><? if($CC_Holder==1){ echo "Yes";}?> 
     <? if($CC_Holder==0){ echo "No";}?></td> 
					<td class="fontstyle"><b>Bank Name</b></td>
					<td class="fontstyle"><? echo $No_of_Banks; ?></td>
			   </tr>
               <tr>
	<td class="fontstyle"><b>Card Vintage </b></td>
	<td class="fontstyle"><? if($Card_Vintage==0) { echo "Please select"; } 
 elseif($Card_Vintage==1) { echo "Less than 6 months"; } 
 elseif($Card_Vintage==2) { echo "6 to 9 months"; } 
elseif($Card_Vintage==3) { echo "9 to 12 months"; }
elseif($Card_Vintage==4) { echo "more than 12 months"; } ?>
		<td class="fontstyle"><b>Credit Limit</b></td>
		 <td class="fontstyle">                    
            <? if($Credit_Limit==0) { echo "Please select"; }                   
            elseif($Credit_Limit==1) { echo "Upto 75,000"; } 
			elseif($Credit_Limit==2) { echo "75,000 to 1,50,000"; } 
			elseif($Credit_Limit==3) { echo "1,50,000 & Above"; } ?>
					</td>
			   </tr>
			 
               <tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>TU Details </b></td></tr>

<tr>
<td>Status</td>
<td><? echo $appt_dt["RuleStatus"];?></td>
</tr>
<tr>
<td>Status Description</td>
<td colspan="3"><?
 $TUEF_ErrorResponse = $appt_dt["Response"];
$toreplace = array("<Response><Status>", "</Status><ErrorCode>", "</ErrorCode><ErrorDescription>","</ErrorDescription><Segment>","</Segment></Response>");
$replacewid   = array(",", ",", ",", ",", ",");
$newphrase = str_replace($toreplace, $replacewid, $TUEF_ErrorResponse);
$newphrase1 = explode(",",$newphrase);

echo "Response : <br><b> ErrorCode</b> : ".$newphrase1[2]."<br> <b>ErrorDescription :</b> ".$newphrase1[3]."<br> <b>Segment</b> : ".$newphrase1[4]."";?></td>
</tr>
<?

if($appt_dt["RuleStatus"]=='Error' || $appt_dt["RuleStatus"]=="" || $appt_dt["RuleStatus"]=='Pending' || ($appt_dt["RuleStatus"]=="Rejected" && $Employment_Status ==0))
{
?>
<tr>
<td colspan="4" align="center" style="font-size:16px; font-weight:bold; " height="40" ><a href="/icici_cclms_tu.php?reqdid=<? echo $post; ?>" target="_blank" style="background-color:#FFCC00;">Transunion Check</a></td>
</tr>
<? } ?>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Bidders Details </b></td></tr>
<? if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}
?>
<tr><td class="fontstyle"><b>Eligible for Bidders</b></td><? if(strlen($Bidderid_Details)>0){?><td class="fontstyle" colspan="2"> already send</td><? } else {?><td colspan="2"><div id="checkdiv" name="checkdiv"><? list($FinalBidder,$finalBidderName)= getBiddersList("Req_Credit_Card",$post,$City);
  for($i=0;$i<count($FinalBidder);$i++)
		{
		
		echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]." (".$FinalBidder[$i].") ";
		
		}
}
			?></div></td>			
</tr>
<tr><td class="fontstyle"><b>Selected Card</b></td>
<td colspan="3"><? echo $applied_card_name; ?>
	</td></tr>
 <tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Documents </b></td></tr>
 <tr><td colspan="4">KYC Document&nbsp;&nbsp;
<select name="documents[]" id="documents[]">
 <option value=""  >Please Select</option>
<option value="Passport" <? if((strlen(strpos($documents, "Passport")) > 0)) echo "Selected"; ?>>Passport</option>
<option value="VoterID" <? if((strlen(strpos($documents, "VoterID")) > 0)) echo "Selected"; ?>>Voter ID</option>
<option value="DrivingLicense" <? if((strlen(strpos($documents, "DrivingLicense")) > 0)) echo "Selected"; ?>>Driving License</option>
<option value="AadharCard" <? if((strlen(strpos($documents, "AadharCard")) > 0)) echo "Selected"; ?>>Aadhar Card</option>
<option value="PANCard" <? if((strlen(strpos($documents, "PANCard")) > 0)) echo "Selected"; ?>>PAN Card</option>
</select>
 </td></tr>
  <tr><td colspan="4">  
  Income Documents : <? if($Employment_Status ==1) {  ?>
  <br><input type="checkbox" name="documents[]" id="documents[]" <? if((strlen(strpos($documents, "Salary Ac with ICICI Bank")) > 0)) echo "checked"; ?> value="Salary Ac with ICICI Bank"> Salary A/c with ICICI Bank  
  <br><input type="checkbox" name="documents[]" id="documents[]" value="Last 2 month salary slip" <? if((strlen(strpos($documents, "Last 2 month salary slip")) > 0)) echo "checked"; ?>> Last 2 month salary slip   
  <br> <input type="checkbox" name="documents[]" id="documents[]" value="Last 3 months Bank Statement of salary account" <? if((strlen(strpos($documents, "Last 3 months Bank Statement of salary account")) > 0)) echo "checked"; ?>> Last 3 months Bank Statement of salary account <? } if($Employment_Status ==0) {?>  
  <br><input type="checkbox" name="documents[]" id="documents[]" value="Savings or Current account" <? if((strlen(strpos($documents, "Savings or Current account")) > 0)) echo "checked"; ?>> Savings or Current account mandatory with 6 months vintage.
  <br> <input type="checkbox" name="documents[]" id="documents[]" value="ITR copy" <? if((strlen(strpos($documents, "ITR copy")) > 0)) echo "checked"; ?>> ITR copy, Computation of income with acknowledgement receipt. ITR filed to be  2.5 lacs or more <? } ?></td></tr> 
  <tr><td colspan="4">
    <? echo  	$documents; ?></td></tr> 
   <tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Appointment Details </b></td></tr>

<tr><td>Appointment Date</td><td><input type="Text"  name="appointment_date" id="appointment_date" maxlength="25" size="15" <?php if($appt_dt["appointment_date"] !='0000-00-00') { ?>value="<?php  echo $appt_dt["appointment_date"]; ?>" <?php } ?>><a href="javascript:NewCal('appointment_date','yyyymmdd',false,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td><td>Appointment Time</td><td><select name="appointment_time" id="appointment_time" tabindex="14">
	<option value="please select">Time slab</option>
<option value="Call Before coming" <? if($appointment_time=="Call Before coming") { echo "Selected"; } ?>>Call Before coming</option>			
	<option value="8(am)-9(am)" <? if($appointment_time=="8(am)-9(am)") { echo "Selected"; } ?>>8(am)-9(am)</option>
	<option value="9(am)-10(am)" <? if($appointment_time=="9(am)-10(am)") { echo "Selected"; } ?>>9(am)-10(am)</option>
	<option value="10(am)-11(am)" <? if($appointment_time=="10(am)-11(am)") { echo "Selected"; } ?>>10(am)-11(am)</option>
	<option value="11(am)-12(am)" <? if($appointment_time=="11(am)-12(am)") { echo "Selected"; } ?>>11(am)-12(am)</option>
	<option value="12(am)-1(pm)" <? if($appointment_time=="12(am)-1(pm)") { echo "Selected"; } ?>>12(am)-1(pm)</option>
	<option value="1(pm)-2(pm)" <? if($appointment_time=="1(pm)-2(pm)") { echo "Selected"; } ?>>1(pm)-2(pm)</option>
	<option value="2(pm)-3(pm)" <? if($appointment_time=="2(pm)-3(pm)") { echo "Selected"; } ?>>2(pm)-3(pm)</option>
	<option value="3(pm)-4(pm)" <? if($appointment_time=="3(pm)-4(pm)") { echo "Selected"; } ?>>3(pm)-4(pm)</option>
	<option value="4(pm)-5(pm)" <? if($appointment_time=="4(pm)-5(pm)") { echo "Selected"; } ?>>4(pm)-5(pm)</option>
	<option value="5(pm)-6(pm)" <? if($appointment_time=="5(pm)-6(pm)") { echo "Selected"; } ?>>5(pm)-6(pm)</option>
	<option value="6(pm)-7(pm)" <? if($appointment_time=="6(pm)-7(pm)") { echo "Selected"; } ?>>6(pm)-7(pm)</option>
	<option value="7(pm)-8(pm)" <? if($appointment_time=="7(pm)-8(pm)") { echo "Selected"; } ?>>7(pm)-8(pm)</option>
							</select>	</td></tr>

 <tr><td>Appointment Place</td><td><select name="appointment_place" id="appointment_place" >
 <option>please select</option>
 <option value="Office" <? if($appointment_place=="Office") { echo "Selected";} ?>>Office</option>
 <option value="Residence" <? if($appointment_place=="Residence") { echo "Selected";} ?>>Residence</option></select>
</td><td>Appointment Address</td><td><textarea rows="2" cols="20" name="appointment_address" id="appointment_address"><? echo $appointment_address; ?></textarea></td></tr>
<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>
<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle"><select name="ccfeedback" id="feedback">
		<option value="No Feedback" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
	<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
	<option value="Verified" <?if($Feedback == "Verified") { echo "selected"; }?>>Verified</option>
	</select>
	</td>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><?php  echo $followup_date; ?></td>
</tr>
	<tr><td class="fontstyle"><b>Telecaller feedback</b></td>
		<td><? echo $icici_feedback; ?></td>
		<td><b>Add Comment</b></td>
		<td><? echo $Add_Comment; ?></td>
	</tr>
	<tr><td class="fontstyle"><b>Verifier feedback</b></td>
		<td><? echo $Feedback; ?></td>
		<td colspan="2"></td>
	</tr>
 <tr>
     <td colspan="4" align="center"><p>
       <input type="submit" class="bluebutton" value="Submit">
     </p>       
      </td>
   </tr>
</table>
</form>
</body>
</html>