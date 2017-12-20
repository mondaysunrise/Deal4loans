<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncRBLCC.php';

	session_start();
	$post=$_REQUEST['id'];
	$min_date =$_REQUEST['to'];
	$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];
		
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$ccemail = $_POST["ccemail"];
		$ccname=$_POST['ccname'];
		$ccmobile = $_POST["ccmobile"];
		$ccstd_code = $_POST["ccstd_code"];
		$cclandline = $_POST["cclandline"];
		$ccemployment_status = $_POST["ccemployment_status"];
		$cclandline_o = $_POST["cclandline_o"];
		$ccstd_code_o = $_POST["ccstd_code_o"];
		$ccnet_salary = $_POST["ccnet_salary"];
		$cccc_holder = $_POST["cccc_holder"];
		$cccompany_name = $_POST["cccompany_name"];
		$ccpincode = $_POST["ccpincode"];
		$cccity = $_POST["cccity"];
		$cccity_other = $_POST["cccity_other"];
		$ccbidder_count = $_POST["ccbidder_count"];
		$ccfeedback = $_POST["ccfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		$salary_account = $_REQUEST['salary_account'];
		$ccpancard=$_POST['ccpancard'];
		$No_of_Banks =$_POST["No_of_Banks"];
		$Bidder_Id = $_REQUEST['BidderId'];
		$ccadd_comment= $_REQUEST['ccadd_comment'];
		$From_Product1= $_REQUEST['From_Product1'];
		$From_Product= $_REQUEST['From_Product'];
		$which_card = $_REQUEST["which_card"];
		$applied_card_name = $_REQUEST["applied_card_name"];
		$Credit_Limit = $_REQUEST["Credit_Limit"];
		$Card_Vintage = $_REQUEST["Card_Vintage"];
		$Residence_Address  = $_REQUEST["Residence_Address"];
		$appointment_date  = $_REQUEST["appointment_date"];
		$appointment_time  = $_REQUEST["appointment_time"];
		$appointment_place  = $_REQUEST["appointment_place"];
		$appointment_address = $_REQUEST["appointment_address"];
		$Salary_Account = $_REQUEST["Salary_Account"];
		$documents = $_REQUEST["documents"];
		$kyc_document = $_REQUEST["kyc_document"];
		$n       = count($documents);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $completedocuments .= "$documents[$i], ";
			 $i++;
		   }
	$completedocumentsstr = $kyc_document." ".$completedocuments;
if($appointment_date!='0000-00-00' && $appointment_date!='' && strlen($appointment_time)>0 && strlen($appointment_place)>1)
	{
		 $appointquery ="Update rbl_creditcard set rblappointment_date='".$appointment_date."',rblappointment_time='".$appointment_time."', rblappointment_place='".$appointment_place."', rblappointment_address= '".$appointment_address."',rbldocuments='".$completedocumentsstr."' Where RequestID=".$post;
			$appointqueryresult = ExecQuery($appointquery);
		
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

$Final_Bid = substr($Final_Bid, 0, strlen($Final_Bid)-1); //remove the final comma sign from the final array

if(strlen($Final_Bid)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}
			
	if(strlen($Final_Bid)>0)
	{
	$updatelead="Update Req_Credit_Card set rbl_flag=1,Residence_Address='$Residence_Address',Credit_Limit='$Credit_Limit',Card_Vintage='$Card_Vintage',applied_card_name='$final_cardselect',Salary_Account='$salary_account',Name='$ccname', Company_Name='$cccompany_name',DOB='$ccdob',Email='$ccemail',City='$cccity',City_Other='$cccity_other', Mobile_Number='$ccmobile', Std_Code='$ccstd_code',Landline='$cclandline', Std_Code_O='$ccstd_code_o', Landline_O='$cclandline_o',Net_Salary='$ccnet_salary', Pincode='$ccpincode', Employment_Status='$ccemployment_status', CC_Holder='$cccc_holder', Add_Comment='$ccadd_comment',No_of_Banks='$No_of_Banks',Pancard='$ccpancard',Updated_Date=Now(), Allocated='$Allocated', Pancard_No='$ccpancard_no',Bidderid_Details='$Final_Bid', Company_ICICI_Cat='$Company_HDFC_Cat', Company_HDFC_Cat='$Company_HDFC_Cat',Is_Valid=1, Salary_Account='$Salary_Account' where RequestID=".$post;	

	}
	else
	{
	$updatelead="Update Req_Credit_Card set Residence_Address='$Residence_Address',Credit_Limit='$Credit_Limit',Card_Vintage='$Card_Vintage',applied_card_name='$final_cardselect',Salary_Account='$salary_account',Name='$ccname', Company_Name='$cccompany_name',DOB='$ccdob',Email='$ccemail',City='$cccity',City_Other='$cccity_other', Mobile_Number='$ccmobile', Std_Code='$ccstd_code',Landline='$cclandline', Std_Code_O='$ccstd_code_o', Landline_O='$cclandline_o',Net_Salary='$ccnet_salary', Pincode='$ccpincode', Employment_Status='$ccemployment_status', CC_Holder='$cccc_holder', Add_Comment='$ccadd_comment',No_of_Banks='$No_of_Banks',Pancard='$ccpancard', Pancard_No='$ccpancard_no',Company_ICICI_Cat='$Company_HDFC_Cat', Company_HDFC_Cat='$Company_HDFC_Cat' , Salary_Account='$Salary_Account' where RequestID=".$post;
	}
		
	$updateleadresult=ExecQuery($updatelead);
	 if(strlen($ccfeedback)>0)
	{
		  if($ccfeedback=="Not Contactable")
		{
			$counter="1";
		}
		else
		{
			$counter="";
		}
		$strSQL="";
		$Msg="";
	
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_CC where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=4");		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$notcontactableCounter=$row["not_contactable_counter"];
			$updatedcounter=$notcontactableCounter+1;
			$strSQL="Update Req_Feedback_CC Set Feedback='".$ccfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		if($notcontactableCounter<2)
			{
					$product="Credit Card";	
					$feedback=$ccfeedback;
					include "scripts/feedbackmailerscript.php";

					$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= "Bcc: testing4use@gmail.com"."\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if($feedback=="Not Contactable" && (strlen($ccemail)>0))
					{
						mail($ccemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
					}
			}
		}
		else
		{
			$strSQL="Insert into Req_Feedback_CC(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",4,'".$ccfeedback."','".$FollowupDate."','".$counter."')";
			$product="Credit Card";	
			$feedback=$ccfeedback;
					include "scripts/feedbackmailerscript.php";

					$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= "Bcc: testing4use@gmail.com"."\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if($feedback=="Not Contactable" && (strlen($ccemail)>0))
					{
						mail($ccemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
					}
		}
		echo $strSQL;
		$result = ExecQuery($strSQL);
		if ($result == 1)
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
$viewqry="select * from Req_Credit_Card LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback_CC.BidderID= '".$bidid."' where Req_Credit_Card.RequestID=".$post." "; 
//echo "dd".$viewqry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
$Add_Comment= mysql_result($viewlead,0,'Add_Comment');
$Mobile = mysql_result($viewlead,0,'Mobile_Number');
$Landline = mysql_result($viewlead,0,'Landline');
$Landline_O = mysql_result($viewlead,0,'Landline_O');
$Std_Code = mysql_result($viewlead,0,'Std_Code');
$Std_Code_O = mysql_result($viewlead,0,'Std_Code_O');
$Net_Salary = mysql_result($viewlead,0,'Net_Salary');
$City = mysql_result($viewlead,0,'City');
$City_Other = mysql_result($viewlead,0,'City_Other');
$Is_Valid = mysql_result($viewlead,0,'Is_Valid');
$Updated_Date = mysql_result($viewlead,0,'Updated_Date');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Email = mysql_result($viewlead,0,'Email');
$source = mysql_result($viewlead,0,'source');
$CC_Holder = mysql_result($viewlead,0,'CC_Holder');
$Salary_Account = mysql_result($viewlead,0,'Salary_Account');
$No_of_Banks = mysql_result($viewlead,0,'No_of_Banks');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$Feedback = mysql_result($viewlead,0,'Feedback');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$month_sal= $Net_Salary/12;
$No_of_Banks = mysql_result($viewlead,0,'No_of_Banks');
$Applied_With_Banks = mysql_result($viewlead,0,'Applied_With_Banks');
$applied_card_name = mysql_result($viewlead,0,'applied_card_name');
$Credit_Limit = mysql_result($viewlead,0,'Credit_Limit');
$Card_Vintage = mysql_result($viewlead,0,'Card_Vintage');
$DOB = mysql_result($viewlead,0,'DOB');
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
$getapptqry = "select * from rbl_creditcard where (cc_requestID='".$post."') order by rblccid DESC";
$getapptresult = ExecQuery($getapptqry);
$appt_dt = mysql_fetch_array($getapptresult);
$appointment_place = $appt_dt["rblappointment_place"];
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
			<td class="fontstyle" width="150"><input type="text" name="ccname" id="ccname" value="<? echo $Name;?>"></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="ccemail" id="ccemail" value="<?echo $Email;?>"></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="ccdob" size="15" value="<?echo $DOB;?>"></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="text" name="ccmobile" size="15" value="<?echo $Mobile;?>"></td>
			</tr>			
		<tr>
			<td class="fontstyle"><b>Residence No</b></td>
			<td class="fontstyle"><input type="text" name="ccstd_code" size="1" value="<? echo $Std_Code;?>" >-<input type="text" name="cclandline" size="8" value="<?echo $Landline;?>"></td>
			<td class="fontstyle" ><b>Office No.</b></td>
			<td class="fontstyle"><input type="text" name="ccstd_code_o"  size="1" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="cclandline_o" size="9" value="<?echo $Landline_O;?>"></td>
		</tr>				
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><select size="1" name="cccity" id="cccity"> <?=getCityList($City)?></select></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><input type="text" name="cccity_other" id="cccity_other" size="10" value="<? echo $City_Other;?>" ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="ccpincode" size="10" value="<? echo $Pincode;?>" ></td>
        <td class="fontstyle"><b>Salary Account</b></td><td><select  name="Salary_Account" id="Salary_Account" multiple><option value="">Please Select</option> <? $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
	while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" 
			<?php if((strlen(strpos($Salary_Account, $plbnk["Bank_Name"])) > 0)) echo "Selected"; ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<? }
	?>
<option value="Other" <? if(strtoupper($Primary_Acc)=="OTHER") { echo "Selected";} ?>>Other</option></select></td>
				</tr>		
		
	<tr>
		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><select class="fontstyle" name="ccemployment_status" id="ccemployment_status">
			<option value="1" <?if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
			<option value="0" <?if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>
		</td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><input type="text" name="ccnet_salary" id="ccnet_salary" value="<?echo $Net_Salary;?>"  onKeyUp="getDigitToWords('ccnet_salary','formatedIncome','wordIncome');" onKeyPress="getDigitToWords('ccnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('ccnet_salary','formatedIncome','wordIncome');"></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><input type="text" name="cccompany_name" id="cccompany_name" value="<? echo $Company_Name;?>"></td>

	<td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
<td><label for="country">check Company Name </label></td>
<td><input name="company" id="company"   type="text" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="<? echo $Company_Name;?>" size=45/>                                   
</td><td colspan="2">&nbsp;</td></tr>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td></tr>
<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><input type="radio" value="1" name="cccc_holder" id="cccc_holder" <? if($CC_Holder==1){ echo "checked";}?> class="NoBrdr" checked>Yes
     <input type="radio" value="0" name="cccc_holder"  id="cccc_holder" class="NoBrdr" <? if($CC_Holder==0){ echo "checked";}?>>No</td> 
					<td class="fontstyle"><b>Bank Name</b></td>
					<td class="fontstyle"><select size="1" name="No_of_Banks" id="No_of_Banks" >
					<option value="0" <? if($No_of_Banks==0) {echo "Selected"; } ?>>Please select</option> 
					<option value="HDFC Bank" <? if($No_of_Banks=="HDFC Bank") { echo "Selected"; } ?>>HDFC Bank</option> 
					<option value="Standard Chartered" <? if($No_of_Banks=="Standard Chartered") { echo "Selected"; } ?>>Standard Chartered</option>
					 <option value="Kotak Bank" <? if($No_of_Banks=="Kotak Bank") { echo "Selected"; } ?>>Kotak Bank</option>
					 <option value="ICICI Bank" <? if($No_of_Banks=="ICICI Bank") { echo "Selected"; } ?>>ICICI Bank</option>
					 <option value="Other" <? if($No_of_Banks=="Other") {echo "Selected"; } ?>>Other</option></select></td>
			   </tr>
               <tr>
	<td class="fontstyle"><b>Card Vintage </b></td>
	<td class="fontstyle"><select size="1" name="Card_Vintage" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
    <option value="0" <? if($Card_Vintage==0) { echo "Selected"; } ?>>Please select</option> 
    <option value="1" <? if($Card_Vintage==1) { echo "Selected"; } ?>>Less than 6 months</option> 
    <option value="2" <? if($Card_Vintage==2) { echo "Selected"; } ?>>6 to 9 months</option> 
    <option value="3" <? if($Card_Vintage==3) { echo "Selected"; } ?>>9 to 12 months</option>
    <option value="4" <? if($Card_Vintage==4) { echo "Selected"; } ?>>more than 12 months</option> </select></td>	 
		<td class="fontstyle"><b>Credit Limit</b></td>
		 <td class="fontstyle"><select size="1" name="Credit_Limit" id="Credit_Limit" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >                     
            <option value="0" <? if($Credit_Limit==0) { echo "Selected"; } ?>>Please select</option>                        
            <option value="1"  <? if($Credit_Limit==1) { echo "Selected"; } ?>>Upto 75,000</option>                       
             <option value="2" <? if($Credit_Limit==2) { echo "Selected"; } ?>>75,000 to 1,50,000 </option> 
                                    <option value="3" <? if($Credit_Limit==3) { echo "Selected"; } ?>>1,50,000 & Above</option>                       </select>
					</td>
			   </tr>
			 
               <tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>RBL Details </b></td></tr>

<tr>
<td>Status Description</td>
<td colspan="3">
<? 

echo "Status: ".$Status = $appt_dt["Status"]."<br>";
echo "ReferenceCode: ".$ReferenceCode = $appt_dt["ReferenceCode"]."<br>";
echo "Errorinfo: ".$Errorinfo = $appt_dt["Errorinfo"]."<br>";
?>
</td>
</tr>
<?
if($Status==0)
{
?>
<tr>
<td colspan="4" align="center" style="font-size:16px; font-weight:bold; " height="40" ><a href="/rbl_ccview.php?ccrqd=<? echo $post; ?>" target="_blank" style="background-color:#FFCC00;">RBL Service Check</a></td>
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
<tr><td class="fontstyle"><b>Select Card</b></td>
<td colspan="3">
		<table border="1" width="100%" cellpadding="4" cellspacing="0"><tr><td width="25%"><div align="center"><strong>Card Name</strong></div></td>
		<td width="64%"><div align="center"><strong>Features</strong></div></td>
		<td width="11%"><div align="center"><strong>Apply</strong></div></td>
		</tr>
		<?  if(($month_sal>="45000" && $Employment_Status==1) || $Employment_Status==0) 
{ ?>
		<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>RBL Bank Platinum Maxima Credit Card</b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">
Annual Benefits worth Rs 20000<br>
 5 X  rewards on Dining, Entertainment, Utility Bills & International transactions<br>
Swipe within 60 days and get 8000 reward points<br>
Earn 2 rewards for every Rs. 100 spent and earn<br>
Use your card for purchases of Rs 2 Lakhs or more in a year and get 10,000 reward points<br>
Get additional 10,000 reward points on further achieving 3.5 Lakhs of annual spends on the card
                </td>
		<td width="11%" align="center"><input type="checkbox" id="which_card" name="which_card[]" value="RBL Bank Platinum Maxima Credit Card" <?php if((strlen(strpos($applied_card_name, "RBL Bank Platinum Maxima Credit Card")) > 0)) echo "checked"; ?>></td>
		</tr>
	<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>RBL Bank Platinum Cricket Credit Card</b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">
Swipe within 60 days and get 4000 runs or Delhi daredevil fan kit<br>
Earn 2 Runs for every Rs 100 swiped and 4 Runs for swipe on Dining, Air Travel & Hotels<br>
Earn 6 Runs at partner stores<br>
1 wicket for every 1 lac of spent
</td>
		<td width="11%" align="center"><input type="checkbox" name="which_card[]" id="which_card" value="RBL Bank Platinum Cricket Credit Card" <?php if((strlen(strpos($applied_card_name, "RBL Bank Platinum Cricket Credit Card")) > 0)) echo "checked"; ?>></td>
		</tr>
		<? } ?>		
		<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>RBL Bank Titanium Delight Credit Card</b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">Annual Benefits worth Rs 9000
No Fuel Surcharge<br>
One movie ticket free upto Rs 200 every Wednesday on Bookmyshow <br>
5% value back on Big Bazaar every wednesday<br>
10% value back on Pizza Hut/Domino's every wednesday<br>
Swipe within 60 days and get 2000 reward points. Spend Rs 10,000 and get additional 1,000 reward points
</td>
		<td width="11%" align="center"><input type="checkbox" name="which_card[]" id="which_card" value="RBL Bank Titanium Delight Credit Card" <?php if((strlen(strpos($applied_card_name, "RBL Bank Titanium Delight Credit Card")) > 0)) echo "checked"; ?>></td>
		</tr>		
		</table>
	</td></tr>
 <tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Documents </b></td></tr>
 <tr><td colspan="4"><input type="checkbox" name="documents"> KYC Document&nbsp;&nbsp;<input type="text" name="kyc_document" id="kyc_document" style="width:200px;"></td></tr>
  <tr><td colspan="4">  
  Income Documents : <? if($Employment_Status ==1) {  ?>
  <br><input type="checkbox" name="documents[]" id="documents[]" <? if((strlen(strpos($documents, "Salary Ac with ICICI Bank")) > 0)) echo "checked"; ?> value="Salary Ac with ICICI Bank"> Salary A/c with ICICI Bank  
  <br><input type="checkbox" name="documents[]" id="documents[]" value="Last 2 month salary slip" <? if((strlen(strpos($documents, "Last 2 month salary slip")) > 0)) echo "checked"; ?>> Last 2 month salary slip   
  <br> <input type="checkbox" name="documents[]" id="documents[]" value="Last 3 months Bank Statement of salary account" <? if((strlen(strpos($documents, "Last 3 months Bank Statement of salary account")) > 0)) echo "checked"; ?>> Last 3 months Bank Statement of salary account <? } if($Employment_Status ==0) {?>  
  <br><input type="checkbox" name="documents[]" id="documents[]" value="Savings or Current account" <? if((strlen(strpos($documents, "Savings or Current account")) > 0)) echo "checked"; ?>> Savings or Current account mandatory with 6 months vintage.
  <br> <input type="checkbox" name="documents[]" id="documents[]" value="ITR copy" <? if((strlen(strpos($documents, "ITR copy")) > 0)) echo "checked"; ?>> ITR copy, Computation of income with acknowledgement receipt. ITR filed to be  2.5 lacs or more <? } ?></td></tr> 
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
	</select>
	</td>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
	<tr><td class="fontstyle"><b>Source</b></td>
		<td><? echo $source; ?></td>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="ccadd_comment" id="ccadd_comment" ><? echo $Add_Comment; ?></textarea></td>
	</tr>
<? 		if(($City=="Mumbai" || $City=="Chennai" || $City=="Bangalore" || $City=="Pune" || $City=="Ahmadabad" || $City=="Hyderabad" || $City=="Jaipur" || $City=="Surat" || $City=="Kolkata" || $City=="Coimbatore" || $City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Gaziabad" || $City=="Greater Noida")  && $Net_Salary>=200000 && strlen($Email)>2)
		{ ?>
    <tr><td>SBI gold card</td><td colspan="3"><a href="send_sbigoldcardmail.php?get_email=<? echo $Email; ?>" target="_blank"><input type="button" name="sbicard" id="sbicard"  value="SBI mail"></a></td></tr>
	<? } ?>
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