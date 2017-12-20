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
		$dataUpdate = array('appointment_date'=>$appointment_date, 'appointment_time'=>$appointment_time, 'appointment_place'=>$appointment_place, 'appointment_address'=>$appointment_address, 'documents'=>$completedocumentsstr, 'other_documents'=>$other_docs);
		$wherecondition = "(RequestID=".$post.")";
		Mainupdatefunc ('credit_card_cibil_check', $dataUpdate, $wherecondition);
	}
	$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$cccompany_name.'"';
	list($recordcounthdfccc,$grow)=MainselectfuncNew($gethdfccccompany,$array = array());
	$myrowcontr=count($myrow)-1;
	if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $grow[$myrowcontr]["company_category"];
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
		 if($ccfeedback=="Verified")
		{
			$Dated = ExactServerdate();
			$dataUpdate1 = array('lead_cost'=>'1', 'Updated_Date'=>$Dated);
			$wherecondition = "(RequestID=".$post.")";
			Mainupdatefunc ('Req_Credit_Card', $dataUpdate1, $wherecondition);

			$dataUpdate2 = array('icici_sendnow_date'=>$Dated);
			$wherecondition = "(cc_requestid=".$post.")";
			Mainupdatefunc ('icicilms_allocation', $dataUpdate2, $wherecondition);

		}
		$strSQL="";
		$Msg="";
	
		$result = "select iciciallocateid from icicilms_allocation where cc_requestid=".$post."  AND product =4";
		list($num_rows,$row)=MainselectfuncNew($sql,$array = array());
		if($num_rows > 0)
		{
			$updatedcounter=$notcontactableCounter+1;
			$dataUpdate3 = array('verifier_feedback'=>$ccfeedback, 'icici_followupdate'=>$FollowupDate);
			$wherecondition = "(iciciallocateid=".$row['iciciallocateid'].")";
			Mainupdatefunc ('icicilms_allocation', $dataUpdate3, $wherecondition);	
		}
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
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
list($viewleadscount,$viewlead)=MainselectfuncNew($viewqry,$array = array());
$viewleadcontr=count($viewlead)-1;
$Name = $viewlead[$viewleadcontr]['Name'];
$Add_Comment= $viewlead[$viewleadcontr]['Add_Comment'];
$Mobile = $viewlead[$viewleadcontr]['Mobile_Number'];
$Landline = $viewlead[$viewleadcontr]['Landline'];
$Landline_O = $viewlead[$viewleadcontr]['Landline_O'];
$Std_Code = $viewlead[$viewleadcontr]['Std_Code'];
$Std_Code_O = $viewlead[$viewleadcontr]['Std_Code_O'];
$Net_Salary = $viewlead[$viewleadcontr]['Net_Salary'];
$City = $viewlead[$viewleadcontr]['City'];
$City_Other = $viewlead[$viewleadcontr]['City_Other'];
$Is_Valid = $viewlead[$viewleadcontr]['Is_Valid'];
$Updated_Date = $viewlead[$viewleadcontr]['Updated_Date'];
$Employment_Status = $viewlead[$viewleadcontr]['Employment_Status'];
$Email = $viewlead[$viewleadcontr]['Email'];
$source = $viewlead[$viewleadcontr]['source'];
$CC_Holder = $viewlead[$viewleadcontr]['CC_Holder'];
$Salary_Account = $viewlead[$viewleadcontr]['Salary_Account'];
$No_of_Banks = $viewlead[$viewleadcontr]['No_of_Banks'];
$followup_date = $viewlead[$viewleadcontr]['icici_followupdate'];
$icici_feedback = $viewlead[$viewleadcontr]['icici_feedback'];
$Feedback = $viewlead[$viewleadcontr]['verifier_feedback'];
	
$Company_Name = $viewlead[$viewleadcontr]['Company_Name'];
$month_sal= $Net_Salary/12;
$No_of_Banks = $viewlead[$viewleadcontr]['No_of_Banks'];
$Applied_With_Banks = $viewlead[$viewleadcontr]['Applied_With_Banks'];
$applied_card_name = $viewlead[$viewleadcontr]['applied_card_name'];
$Credit_Limit = $viewlead[$viewleadcontr]['Credit_Limit'];
$Card_Vintage = $viewlead[$viewleadcontr]['Card_Vintage'];
$DOB = $viewlead[$viewleadcontr]['DOB'];
$Bidderid_Details = $viewlead[$viewleadcontr]['Bidderid_Details'];
$getapptqry = "select other_documents,RuleStatus,Response,appointment_date, appointment_time,appointment_place,appointment_address,	documents from credit_card_cibil_check where (RequestID='".$post."') order by cibilchkid DESC";
list($appt_dtcount,$appt_dt)=MainselectfuncNew($getapptresult,$array = array());
$appt_dtcontr=count($appt_dt)-1;
$appointment_place = $appt_dt[$appt_dtcontr]["appointment_place"];
$appointment_address = $appt_dt[$appt_dtcontr]["appointment_address"];
$appointment_time = $appt_dt[$appt_dtcontr]["appointment_time"];
$documents = $appt_dt[$appt_dtcontr]["documents"];
$other_documents = $appt_dt[$appt_dtcontr]["other_documents"];
?>
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
	}
}
</script>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" onSubmit="return chkpersonalloan(document.loan_form);">
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
			<td class="fontstyle" width="150"><?echo $Email;?></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><? echo $DOB;?></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<? echo $Mobile;?></td>
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
	<option value="Verified" <?if($Feedback == "Verified") { echo "selected"; }?>>Verified</option>
	</select>
	</td>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><?php  echo $followup_date; ?></td>
</tr>
	<tr><td class="fontstyle"><b>Already feedback</b></td>
		<td><? echo $icici_feedback; ?></td>
		<td><b>Add Comment</b></td>
		<td><? echo $Add_Comment; ?></td>
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