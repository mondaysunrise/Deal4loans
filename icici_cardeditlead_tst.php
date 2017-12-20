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
		$ICICIDOC = $_POST["ICICIDOC"];
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
		$other_docs  = $_REQUEST["other_docs"];
		$n       = count($documents);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $completedocuments .= "$documents[$i], ";
			 $i++;
		   }
	$completedocumentsstr = $kyc_document.",".$completedocuments;
if($appointment_date!='0000-00-00' && $appointment_date!='' && strlen($appointment_time)>0 && strlen($appointment_place)>1)
	{
		 $appointquery ="Update credit_card_cibil_check set appointment_date='".$appointment_date."',appointment_time='".$appointment_time."', appointment_place='".$appointment_place."', appointment_address= '".$appointment_address."',documents='".$completedocumentsstr."',other_documents='".$other_docs."' Where RequestID=".$post;
			$appointqueryresult = ExecQuery($appointquery);	
	}
	$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$cccompany_name.'"';
// echo $getcompany;
$getcccompanyresult = ExecQuery($gethdfccccompany);
$grow=mysql_fetch_array($getcccompanyresult);
$recordcounthdfccc = mysql_num_rows($getcccompanyresult);
if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $grow["company_category"];
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

$Final_Bid = substr($Final_Bid, 0, strlen($Final_Bid)-1); //remove the final comma sign from the final array

if(strlen($Final_Bid)>0)
	{
	$Allocated=2;
	$lead_cost=1;
	}
	else 
	{
		$Allocated=0;
	}
			
	if(strlen($Final_Bid)>0)
	{
	$updatelead="Update Req_Credit_Card set  lead_cost='".$lead_cost."',cards_flag =1,Residence_Address='$Residence_Address',Credit_Limit='$Credit_Limit',Card_Vintage='$Card_Vintage',applied_card_name='$final_cardselect',Salary_Account='$salary_account',Name='$ccname', Company_Name='$cccompany_name',DOB='$ccdob',Email='$ccemail',City='$cccity',City_Other='$cccity_other', Mobile_Number='$ccmobile', Std_Code='$ccstd_code',Landline='$cclandline', Std_Code_O='$ccstd_code_o', Landline_O='$cclandline_o',Net_Salary='$ccnet_salary', Pincode='$ccpincode', Employment_Status='$ccemployment_status', CC_Holder='$cccc_holder', Add_Comment='$ccadd_comment',No_of_Banks='$No_of_Banks',Pancard='$ccpancard',Updated_Date=Now(), Allocated='$Allocated', Pancard_No='$ccpancard_no',Bidderid_Details='$Final_Bid', Company_ICICI_Cat='$Company_HDFC_Cat', Company_HDFC_Cat='$Company_HDFC_Cat',Is_Valid=1, Salary_Account='$Salary_Account' where RequestID=".$post;	
	$upccquerysn ="Update icicilms_allocation set icici_sendnow_date=Now(),icici_bidders='$Final_Bid' Where (cc_requestid=".$post.")";	
	}
	else
	{
	$updatelead="Update Req_Credit_Card set cards_flag =1,Residence_Address='$Residence_Address',Credit_Limit='$Credit_Limit',Card_Vintage='$Card_Vintage',applied_card_name='$final_cardselect',Salary_Account='$salary_account',Name='$ccname', Company_Name='$cccompany_name',DOB='$ccdob',Email='$ccemail',City='$cccity',City_Other='$cccity_other', Mobile_Number='$ccmobile', Std_Code='$ccstd_code',Landline='$cclandline', Std_Code_O='$ccstd_code_o', Landline_O='$cclandline_o',Net_Salary='$ccnet_salary', Pincode='$ccpincode', Employment_Status='$ccemployment_status', CC_Holder='$cccc_holder', Add_Comment='$ccadd_comment',No_of_Banks='$No_of_Banks',Pancard='$ccpancard', Pancard_No='$ccpancard_no',Company_ICICI_Cat='$Company_HDFC_Cat', Company_HDFC_Cat='$Company_HDFC_Cat' , Salary_Account='$Salary_Account' where RequestID=".$post;
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
	
		$result = ExecQuery("select iciciallocateid,not_contactable_counter from icicilms_allocation where cc_requestid=".$post." and bidderid=".$Bidder_Id." AND product =4");		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$notcontactableCounter=$row["not_contactable_counter"];
			$updatedcounter=$notcontactableCounter+$counter;
			$strSQL="Update icicilms_allocation Set icici_feedback='".$ccfeedback."',not_contactable_counter='".$updatedcounter."',icici_followupdate='".$FollowupDate."'";
			$strSQL=$strSQL."Where iciciallocateid=".$row["iciciallocateid"];
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
		
		//echo $strSQL;
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
		
		$strSQLst="";
		$Msg="";	
		$resultst = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_CC where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=4");
		//echo "select FeedbackID,not_contactable_counter from Req_Feedback_CC where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=4";
		$num_rows = mysql_num_rows($resultst);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($resultst);
				$strSQLst="Update Req_Feedback_CC Set Feedback='".$ccfeedback."',Followup_Date='".$FollowupDate."'";
			$strSQLst=$strSQLst."Where FeedbackID=".$row["FeedbackID"];
		
		}
		else
		{
			$strSQLst="Insert into Req_Feedback_CC(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter) Values (";
			$strSQLst=$strSQLst.$post.",".$Bidder_Id.",4,'".$ccfeedback."','".$FollowupDate."','".$counter."')";
			
		}
		//echo $strSQLst;
		$resultst = ExecQuery($strSQLst);
		if ($resultst == 1)
		{
		}
		else
		{
			//$Msg = "** There was a problem in adding your feedback. Please try again.";
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
$viewqry="select * from Req_Credit_Card LEFT OUTER JOIN icicilms_allocation ON icicilms_allocation.cc_requestid=Req_Credit_Card.RequestID and icicilms_allocation.bidderid= '".$bidid."' where Req_Credit_Card.RequestID=".$post." "; 
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
$followup_date = mysql_result($viewlead,0,'icici_followupdate');
$Feedback = mysql_result($viewlead,0,'icici_feedback');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$month_sal= $Net_Salary/12;
$No_of_Banks = mysql_result($viewlead,0,'No_of_Banks');
$Applied_With_Banks = mysql_result($viewlead,0,'Applied_With_Banks');
$applied_card_name = mysql_result($viewlead,0,'applied_card_name');
$Credit_Limit = mysql_result($viewlead,0,'Credit_Limit');
$Card_Vintage = mysql_result($viewlead,0,'Card_Vintage');
$DOB = mysql_result($viewlead,0,'DOB');
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
$getapptqry = "select other_documents,ApplicationID,RuleStatus,Response,appointment_date, appointment_time,appointment_place,appointment_address,	documents from credit_card_cibil_check where (RequestID='".$post."') order by cibilchkid DESC";
$getapptresult = ExecQuery($getapptqry);
$appt_dt = mysql_fetch_array($getapptresult);
$appointment_place = $appt_dt["appointment_place"];
$documents = $appt_dt["documents"];
$ApplicationID = $appt_dt["ApplicationID"];
$other_documents = $appt_dt["other_documents"];
?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<script>
function chkpersonalloan(Form)
{
	if(document.getElementById("ICICIDOC").checked == true)
	{
	
	if(document.getElementById("doc0").checked == false)
	{
		alert("Passport Size Photo");
		document.getElementById('doc0').focus();
		return false;
	}
	if(document.getElementById('doc1').selectedIndex==0)
	{
		alert("Photo Id Proof");
		document.getElementById('doc1').focus();
		return false;
	}
	if(document.getElementById('doc2').selectedIndex==0)
	{
		alert("KYC Document");
		document.getElementById('doc2').focus();
		return false;
	}
	if(document.getElementById("ccemployment_status").value==0)
	{
		if(document.getElementById("doc10").checked == false)
		{
			alert("Latest ITR Copy");
			document.getElementById('doc10').focus();
			return false;
		}
		if(document.getElementById("doc11").checked == false)
		{
			alert("Computation of income sheet");
			document.getElementById('doc11').focus();
			return false;
		}
		if(document.getElementById("doc12").checked == false)
		{
			alert("Challan copy of Tax paid");
			document.getElementById('doc9').focus();
			return false;
		}
	}
	else
		{
	if(document.getElementById('doc3').selectedIndex==0)
	{
		alert("Income Proof");
		document.getElementById('doc3').focus();
		return false;
	}
	else if(document.getElementById('doc3').selectedIndex==1)
	{
		if(document.getElementById('company_type').value!="")
		{		
			if(document.getElementById('doc4').selectedIndex==0)
			{
				alert("Company Doc");
				document.getElementById('doc4').focus();
				return false;
			}
		}
	}
	else if(document.getElementById('doc3').selectedIndex==2)
	{
		if(document.getElementById("doc5").checked == false)
		{
			alert("Salary slip");
			document.getElementById('doc5').focus();
			return false;
		}
		if(document.getElementById('company_type').value=="PREFERRED")
		{
			if(document.getElementById("doc6").checked == false)
			{
				alert("Bank Statement");
				document.getElementById('doc6').focus();
				return false;
			}
		}
	}
	else if(document.getElementById('doc3').selectedIndex==3)
	{
		if(document.getElementById("doc7").checked == false)
		{
			alert("Credt Card Xerox");
			document.getElementById('doc7').focus();
			return false;
		}
		if(document.getElementById("doc8").checked == false)
		{
			alert("Stenciled copy of card");
			document.getElementById('doc8').focus();
			return false;
		}
		if(document.getElementById("doc9").checked == false)
		{
			alert("Card Statnment");
			document.getElementById('doc9').focus();
			return false;
		}
	}
	}
	}

}

function docslet()
{
	if(document.getElementById('doc3').selectedIndex==1)
	{
		if(document.getElementById('company_type').value!="")
		{
		document.getElementById("companydoc").style.visibility="visible"; 
		}
		
	}
	else
	{
		document.getElementById("companydoc").style.visibility="hidden"; 
	}

	if(document.getElementById('doc3').selectedIndex==2)
	{
		document.getElementById("Option2").style.visibility="visible"; 
	}
	else
	{
		document.getElementById("Option2").style.visibility="hidden"; 
	}
	
	if(document.getElementById('doc3').selectedIndex==3)
	{
		document.getElementById("Option3").style.visibility="visible"; 
	}
	else
	{
		document.getElementById("Option3").style.visibility="hidden"; 
	}
}
 
function eiewdocts()
{	
	if(document.getElementById("ICICIDOC").checked == true)
	{		
	document.getElementById("ViewICICIDOc").style.visibility="visible"; 
	document.getElementById("ICICIDOC").style.visibility="hidden"; 	
	
	if(document.getElementById("ccemployment_status").value==0)
	{
	document.getElementById("incm4selfemp").style.visibility="visible"; 
	document.getElementById("incm4sald").style.visibility="hidden";
	}
	else
	{
		document.getElementById("incm4selfemp").style.visibility="hidden"; 
		document.getElementById("incm4sald").style.visibility="visible";
	}
	}
}
</script>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" onSubmit="return chkpersonalloan(document.loan_form);">
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
        <td class="fontstyle"><b>Salary Account</b></td><td><select  name="Salary_Account" id="Salary_Account"><option value="">Please Select</option> <? $bnknm="select Bank_Name from Bank_Master group by Bank_Name ";
			list($plbnkNR,$plbnk)=MainselectfuncNew($bnknm,$array = array());
	while($plbnk=mysql_fetch_array($bnknm))
	for($i=0;$i<$plbnkNR;$i++)
	{ ?>
			<option value="<? echo $plbnk[$i]["Bank_Name"]; ?>" <? if(strtoupper($Salary_Account)==strtoupper($plbnk[$i]["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk[$i]["Bank_Name"]; ?></option>
	<? }
	?>
<option value="Other" <? if(strtoupper($Primary_Acc)=="OTHER") { echo "Selected";} ?>>Other</option></select></td>
				</tr>		
		
	<tr>
		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><select class="fontstyle" name="ccemployment_status" id="ccemployment_status">
			<option value="1" <? if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
			<option value="0" <? if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>
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
</td><td colspan="2">Company Type : <input type="text" name="company_type" value="<? echo $hdfc_cccategory; ?>" id="company_type" readonly></td></tr>
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
echo "Response : <br><b> ErrorCode</b> : ".$newphrase1[2]."<br> <b>ErrorDescription :</b> ".$newphrase1[3]."<br> <b>Segment</b> : ".$newphrase1[4]."";
echo "<br> <b>ApplicationID: </b>".$ApplicationID;
?></td>
</tr>
<?
if($appt_dt["RuleStatus"]=="")
{
?>
<tr>
<td colspan="4" align="center" style="font-size:16px; font-weight:bold; " height="40" ><a href="/icici_cclms_tu.php?reqdid=<? echo $post; ?>&teleid=<? echo $bidid; ?>" target="_blank" style="background-color:#FFCC00;">Transunion Check</a></td>
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
		<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank HPCL coral Credit Card</b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">
<b>Joining Fee</b> - Nil<br />
(Joining fee will be levied only if spends do not cross Rs. 5,000 within 60 days of card set up)<br>
<b>Annual Fee</b> -  Rs. 199<br />
(Waived off if spends cross Rs. 50,000 in the previous year)
              <br /><br>
              <b>Supplementary Card Fee</b> - NIL<br />
               If total spends on the Credit Card is Rs 50,000 or more during an anniversary year, the Annual Fee for the subsequent year shall be reversed.<br />
                </td>
		<td width="11%" align="center"><input type="checkbox" id="which_card" name="which_card[]" value="ICICI Bank HPCL coral Credit Card" <?php if((strlen(strpos($applied_card_name, "ICICI Bank HPCL coral Credit Card")) > 0)) echo "checked"; ?>></td>
		</tr>
	<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank Platinum Chip Credit Card </b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>Fee </b>- <span style="text-decoration:line-through;">Rs.199</span><b> NIL*</b><br>
Annual Fee (2nd year onwards)<br>
<b>Fee -</b> Rs. 99 (waived off if spends cross Rs. 50,000 during previous year)<br>
</td>
		<td width="11%" align="center"><input type="checkbox" name="which_card[]" id="which_card" value="ICICI Bank Platinum Chip Credit Card" <?php if((strlen(strpos($applied_card_name, "ICICI Bank Platinum Chip Credit Card")) > 0)) echo "checked"; ?>></td>
		</tr>
		<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank Coral Credit Card </b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"> 
    <b>Joining Fee</b>-<span style="text-decoration:line-through;">1,000</span> Rs.500* (Limited Offer)<br>
    <b>Annual Fee</b> - Rs. 500 + ST(2nd Year onwards; waived off if spends cross Rs. 1,25,000 in the previous year)<br>
    <b>Welcome Gift:</b> Provogue Tie worth Rs.999
<br></td>
		<td width="11%" align="center"><input type="checkbox" name="which_card[]" id="which_card" value="ICICI Bank Coral Credit Card" <?php if((strlen(strpos($applied_card_name, "ICICI Bank Coral Credit Card")) > 0)) echo "checked"; ?>> </td>
		</tr>
<?  if($month_sal>="50000" || $CC_Holder==1) 
{ ?>
		<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank Rubyx Credit Cards </b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>Joining Fee</b> - Rs. 3,000<br>
<b>Annual Fee</b> - Rs. 2,000 (2nd Year onwards; waived off if spends cross Rs. 2,50,000 in the previous year)<br>
<b>Welcome Gift:</b> <u>Sennheiser HD219 Headphones</u></td>
		<td width="11%" align="center"><input type="checkbox" name="which_card[]" id="which_card" value="ICICI Bank Rubyx Credit Cards" <?php if((strlen(strpos($applied_card_name, "ICICI Bank Rubyx Credit Cards")) > 0)) echo "checked"; ?>></td>
		</tr>		
<? } if($month_sal>="175000" || $CC_Holder==1) 
{ ?>
<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank Sapphiro Credit Cards  </b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"> <b>Joining Fee</b> - Rs. 6,000 + ST<br>
<b>Annual Fee</b> - Rs. 3,500 (2nd Year onwards; waived off if spends cross Rs. 5,00,000 in the previous year) <br>
<b>Welcome Gift:</b> <u>Bose IE2 Audio Headphones</td>
		<td width="11%" align="center"><input type="checkbox" name="which_card[]" id="which_card" value="ICICI Bank Sapphiro Credit Cards" <?php if((strlen(strpos($applied_card_name, "ICICI Bank Sapphiro Credit Cards")) > 0)) echo "checked"; ?>></td>
		</tr>
		<? } ?>
		</table>
	</td></tr>
<? if(strlen($documents)>5)
{ 
 $styleval="visibility:visible;";
 $stylevaldc="visibility:hidden;";
}
else
{ 
	 $styleval="visibility:hidden;";
	 $stylevaldc="visibility:visible;";
 }
?>
 <tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b><input type="checkbox" name="ICICIDOC" onClick="eiewdocts();" id="ICICIDOC" style="<? echo $stylevaldc; ?>" value="Docsadded" <? if(strlen($documents)>5) { echo "checked";} ?>>Documents </a></b></td></tr>

<tr><td colspan="4">
 <div id="ViewICICIDOc" style="<? echo $styleval; ?>">
<input type="checkbox" name="documents[]" id="doc0" <? if((strlen(strpos($documents, "Passport Size Photo")) > 0)) echo "checked"; ?> value="Passport Size Photo"> Passport Size Photo <br>  
Photo Id Proof &nbsp;&nbsp;
<select name="documents[]" id="doc1">
 <option value=""  >Please Select</option>
<option value="Passport" <? if((strlen(strpos($documents, "Passport")) > 0)) echo "Selected"; ?>>Passport</option>
<option value="DrivingLicense" <? if((strlen(strpos($documents, "DrivingLicense")) > 0)) echo "Selected"; ?>>Driving License</option>
<option value="PANCard" <? if((strlen(strpos($documents, "PANCard")) > 0)) echo "Selected"; ?>>PAN Card</option>
</select>                <br>  <br>   
KYC Document&nbsp;&nbsp;
<select name="documents[]" id="doc2">
 <option value=""  >Please Select</option>
<option value="Passport" <? if((strlen(strpos($documents, "Passport")) > 0)) echo "Selected"; ?>>Passport</option>
<option value="VoterID" <? if((strlen(strpos($documents, "VoterID")) > 0)) echo "Selected"; ?>>Voter ID</option>
<option value="DrivingLicense" <? if((strlen(strpos($documents, "DrivingLicense")) > 0)) echo "Selected"; ?>>Driving License</option>
<option value="AadharCard" <? if((strlen(strpos($documents, "AadharCard")) > 0)) echo "Selected"; ?>>Aadhar Card</option>
</select><br><br>

Income Proof&nbsp;&nbsp;
<? if($Employment_Status ==1)
{ ?>
<div id="incm4sald">
<select name="documents[]" id="doc3" onChange="docslet()">
 <option value=""  >Please Select</option>
<option value="ICICI Existing Relationship" <? if((strlen(strpos($documents, "ICICI Existing Relationship")) > 0)) echo "Selected"; ?>>ICICI Existing Relationship</option>
<option value="NO Relation" <? if((strlen(strpos($documents, "NO Relation")) > 0)) echo "Selected"; ?>>NO Relation</option>
<option value="Surrogate Card" <? if((strlen(strpos($documents, "Surrogate Card")) > 0)) echo "Selected"; ?>>Surrogate Card</option>
</select>
</div>
<? } 
 if($Employment_Status ==0)
 { ?>
<div id="incm4selfemp">
<input type="checkbox" name="documents[]" id="doc10" <? if((strlen(strpos($documents, "Latest ITR Copy")) > 0)) echo "checked"; ?> value="Latest ITR Copy">Latest ITR Copy&nbsp;
<input type="checkbox" name="documents[]" id="doc11" <? if((strlen(strpos($documents, "Computation of income sheet")) > 0)) echo "checked"; ?> value="Computation of income sheet">Computation of income sheet
<input type="checkbox" name="documents[]" id="doc12" <? if((strlen(strpos($documents, "Challan copy of Tax paid")) > 0)) echo "checked"; ?> value="Challan copy of Tax paid">Challan copy of Tax paid
</div>
<? } ?>
<br>      <br>

<? if((strlen(strpos($documents, "ICICI Existing Relationship")) > 0))
{ 
 $stylevalCD="visibility:visible;";
 }
else
{ 
	 $stylevalCD="visibility:hidden;";
}
?>
<div id="companydoc" style="<? echo $stylevalCD; ?>">
Company Docs&nbsp;
<select name="documents[]" id="doc4">
 <option value=""  >Please Select</option>
<option value="Company ID card" <? if((strlen(strpos($documents, "Company ID card")) > 0)) echo "Selected"; ?>>Company ID card</option>
<option value="1 Month salary Slip" <? if((strlen(strpos($documents, "1 Month salary Slip")) > 0)) echo "Selected"; ?>>1 Month salary Slip</option>
<option value="Business Card" <? if((strlen(strpos($documents, "Business Card")) > 0)) echo "Selected"; ?>>Business Card</option>
</select><br>
<br>
</div>
<? if((strlen(strpos($documents, "NO Relation")) > 0))
{ 
 $stylevalSS="visibility:visible;";
 }
else
{ 
	 $stylevalSS="visibility:hidden;";
}
?>
<div id="Option2" style="<? echo $stylevalSS; ?>">
<input type="checkbox" name="documents[]" id="doc5" <? if((strlen(strpos($documents, "Latest two month Salary Slip")) > 0)) echo "checked"; ?> value="Latest two month Salary Slip">Latest two month Salary Slip&nbsp;
<input type="checkbox" name="documents[]" id="doc6" <? if((strlen(strpos($documents, "Latest 3 Months Bank statement")) > 0)) echo "checked"; ?> value="Latest 3 Months Bank statement">Latest 3 Months Bank statement (For Preffered Co. only)
<br><br>
</div>
<? if((strlen(strpos($documents, "Surrogate Card")) > 0))
{ 
 $stylevalSC="visibility:visible;";
 }
else
{ 
	 $stylevalSC="visibility:hidden;";
}
?>
<div id="Option3" style="<? echo $stylevalSC; ?>">
<input type="checkbox" name="documents[]" id="doc7" <? if((strlen(strpos($documents, "Current credit Card Front side Xerox")) > 0)) echo "checked"; ?> value="Current credit Card Front side Xerox">Current credit Card Front side Xerox<br>
<input type="checkbox" name="documents[]" id="doc8" <? if((strlen(strpos($documents, "Stenciled copy of the card")) > 0)) echo "checked"; ?> value="Stenciled copy of the card">Stenciled copy of the card <br>
<input type="checkbox" name="documents[]" id="doc9" <? if((strlen(strpos($documents, "Latest 1 Month Card statement")) > 0)) echo "checked"; ?> value="Latest 1 Month Card statement">Latest 1 Month Card statement
</div>
  </div>
 </td></tr>
   <tr><td colspan="4"><table> <tr><td>Other Documents&nbsp;</td><td ><textarea rows="2" cols="30" name="other_docs" id="other_docs"><? echo $other_documents; ?></textarea></td></tr></table></td></tr>
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