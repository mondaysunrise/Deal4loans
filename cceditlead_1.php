<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/db_init_bima.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncCC.php';
//require 'neweligibilelist.php';

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
		//print_r ($Final_Bidder)."<br>";
		$Bidder_Id = $_REQUEST['BidderId'];
		$ccadd_comment= $_REQUEST['ccadd_comment'];
		$From_Product1= $_REQUEST['From_Product1'];
		$From_Product= $_REQUEST['From_Product'];
		$applied_card_name_org = $_REQUEST["applied_card_name_org"];
		$applied_card_name = $_REQUEST["applied_card_name"];

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

$r = count($applied_card_name);
	$s  = 0;
	while ($s < $r)
	{
		$which_cc .= "$applied_card_name[$s], ";
		$s++;
}


$which_cc = substr($which_cc, 0, strlen($which_cc)-2);
//echo "<br>";
if(strlen($applied_card_name_org)>0)
{
	//$final_cardselect = $applied_card_name_org.",".$which_cc;
	$final_cardselect = $which_cc;
}
else
{
	$final_cardselect = $which_cc;
}

 
$Final_Bid = substr($Final_Bid, 0, strlen($Final_Bid)-1); //remove the final comma sign from the final array
//echo "hello".$Final_Bid."<br>";
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
	$updatelead="Update Req_Credit_Card set applied_card_name='$final_cardselect',Salary_Account='$salary_account',Name='$ccname', Company_Name='$cccompany_name',DOB='$ccdob',Email='$ccemail',City='$cccity',City_Other='$cccity_other', Mobile_Number='$ccmobile', Std_Code='$ccstd_code',Landline='$cclandline', Std_Code_O='$ccstd_code_o', Landline_O='$cclandline_o',Net_Salary='$ccnet_salary', Pincode='$ccpincode', Employment_Status='$ccemployment_status', CC_Holder='$cccc_holder', Add_Comment='$ccadd_comment',No_of_Banks='$No_of_Banks',Pancard='$ccpancard',Updated_Date=Now(), Allocated='$Allocated', Pancard_No='$ccpancard_no',Bidderid_Details='$Final_Bid', Company_ICICI_Cat='$Company_HDFC_Cat', Company_HDFC_Cat='$Company_HDFC_Cat',Is_Valid=1 where RequestID=".$post;
	
	}
	else
	{
	$updatelead="Update Req_Credit_Card set applied_card_name='$final_cardselect',Salary_Account='$salary_account',Name='$ccname', Company_Name='$cccompany_name',DOB='$ccdob',Email='$ccemail',City='$cccity',City_Other='$cccity_other', Mobile_Number='$ccmobile', Std_Code='$ccstd_code',Landline='$cclandline', Std_Code_O='$ccstd_code_o', Landline_O='$cclandline_o',Net_Salary='$ccnet_salary', Pincode='$ccpincode', Employment_Status='$ccemployment_status', CC_Holder='$cccc_holder', Add_Comment='$ccadd_comment',No_of_Banks='$No_of_Banks',Pancard='$ccpancard', Pancard_No='$ccpancard_no',Company_ICICI_Cat='$Company_HDFC_Cat', Company_HDFC_Cat='$Company_HDFC_Cat' where RequestID=".$post;
	}

	echo $updatelead."<br><br>";
		
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
		//$strqry="select FeedbackID from Req_Feedback where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=1";
		//echo "ff".$strqry;
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
{
	cursor:pointer;

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

<body >

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
$Residential_Status = mysql_result($viewlead,0,'Residential_Status');
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
$Pancard = mysql_result($viewlead,0,'Pancard');
$Pancard_No = mysql_result($viewlead,0,'Pancard_No');
$No_of_Banks = mysql_result($viewlead,0,'No_of_Banks');
$Applied_With_Banks = mysql_result($viewlead,0,'Applied_With_Banks');
$applied_card_name = mysql_result($viewlead,0,'applied_card_name');

$DOB = mysql_result($viewlead,0,'DOB');

$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');


?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<input type="hidden" name="applied_card_name_org" id="applied_card_name_org" value="<? echo $applied_card_name;?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
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
			<td class="fontstyle"><input type="text" name="cccity_other" id="cccity_other" size="10" value="<?echo $City_Other;?>" ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="ccpincode" size="10" value="<?echo $Pincode;?>" ></td>
		<td class="fontstyle"><b>Salary Account</b></td>
		<td class="fontstyle"><select name="salary_account" id="salary_account" type="text" >
				  <option name="">Please Select</option>
				  <option value="HDFC Bank" <? if($Salary_Account=="HDFC Bank") { echo "selected";} ?>>HDFC Bank</option>
				  <option value="ICICI Bank" <? if($Salary_Account=="ICICI Bank") { echo "selected";} ?>>ICICI Bank</option>
				  <option value="Kotak Bank" <? if($Salary_Account=="Kotak Bank") { echo "selected";} ?>>Kotak Bank</option>
				  <option value="Standard Chartered" <? if($Salary_Account=="Standard Chartered") { echo "selected";} ?>>Standard Chartered</option>
				  <option value="Others" <? if($Salary_Account=="Others") { echo "selected";} ?>>Others</option>
				  </select></td>
		</tr>
		
			<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="BidderId" value="<?echo $bidid;?>"></td></tr>
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="ccrequestid" id="ccrequestid" value="<?echo $post;?>"></td>
		</tr>
		<!--</table>
	</td>
</tr>-->
<tr>
	<!--<td><table width="100%">
	<tr>-->
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
<!--<td><table width="100%">
<tr>--><td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td></tr>

<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><input type="radio" value="1" name="cccc_holder" id="cccc_holder" <? if($CC_Holder==1){ echo "checked";}?> class="NoBrdr" checked>Yes
     <input type="radio" value="0" name="cccc_holder"  id="cccc_holder" class="NoBrdr" <?if($CC_Holder==0){ echo "checked";}?>>No</td>
	 
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
	<td class="fontstyle"><b>Pancard Holder or not? </b></td>
	<td class="fontstyle"><input type="radio" value="Yes" name="ccpancard" id="ccpancard" <? if($Pancard=='Yes'){ echo "checked";}?> class="NoBrdr" >Yes
     <input type="radio" value="No" name="ccpancard"  id="ccpancard" class="NoBrdr" <?if($Pancard=='No'){ echo "checked";}?>>No</td>
	 
		<td class="fontstyle"><b>Pancard No</b></td>
		 <td class="fontstyle"><input size="18" class="style4" name="ccpancard_no" id="ccpancard_no" value="<?echo $Pancard_No;?>">
					</td>
			   </tr>
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
			//if($finalBidderName[$i]=="ICICI Bank")
			//{
		echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]." ";
		//}
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
<? 
if($City=="Others" && strlen($City_Other)>0)
	{
		$strcity=$City_Other;
	}
	else
	{
		$strcity=$City;
	}
$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1) order by cc_bank_fee ASC";
	//echo  $selectccbanks."<br>";
	$ccbankresult = ExecQuery($selectccbanks);
	$rowscount = mysql_num_rows($ccbankresult); 
		
$r=0;
$i=1;
$strcc_bankid="";
	  while($row = mysql_fetch_array($ccbankresult))
    {

	   	$cc_bank_query  = $row["other_query"];
	 	   
	    $cc_bank_name = $row["cc_bank_name"];
		$cc_bankid  = $row["cc_bankid"];
		$cc_bank_url  = $row["cc_bank_url"];
		$cc_bank_new_features = $row["cc_bank_new_features"];
		
	  $qry2 = $cc_bank_query." and Req_Credit_Card.RequestID ='".$post."'";
//$qry2 = $cc_bank_query." and Req_Credit_Card.RequestID =227258";
		//echo   "query2 ".$qry2."<br><br>";
		  $result1=ExecQuery($qry2);
        $recordcount = mysql_num_rows($result1);
		
		if($recordcount>0)
		 {
			$strcc_bankid[] = $cc_bankid;
			
		while($getrow = mysql_fetch_array($result1))
			 {
			//$get_Bank="Select * From credit_card_banks_eligibility Where cc_bankid=".$cc_bankid." order by cc_bank_fee ASC";
			$get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid." and cc_bank_flag =1) ";
			$get_Bankresult=ExecQuery($get_Bank);
			 $getrecordcount = mysql_num_rows($get_Bankresult);
			 $getrow_nw = mysql_fetch_array($get_Bankresult);
	
	?>
	<tr>

	<td><? echo $getrow_nw["cc_bank_name"]; ?><br> 
		</td>
			<td><? echo $getrow_nw["cc_bank_new_features"]; ?></td>
	<td><input type="checkbox" name="applied_card_name[]" id="applied_card_name" value="<? echo $getrow_nw["cc_bank_name"]; ?>" <?php if((strlen(strpos($applied_card_name, $getrow_nw["cc_bank_name"])) > 0)) echo "checked"; ?>></td>
	</tr>
	
	<?
	 }//while
		 }//if
		  $i=$i+1;
	}

	?>
	<? if($month_sal>="20000") 
{ ?>
		<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank HPCL Titanium Credit Card </b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">
<b>Joining Fee</b> - Nil<br>
<b>Annual Fee</b> - Rs. 500 (1st year)
    - Rs. 500 (Reversed in case spends exceed Rs. 50,000 in the previous year)(2nd year onwards)<br>
<b>Joining Benefit</b> - Cashback of Rs 500 if purchases exceed Rs. 5,000 within 60 days of card set up.</td>
		<td width="11%" align="center"><input type="checkbox" name="applied_card_name[]" id="applied_card_name" value="ICICI Bank HPCL Titanium Credit Card" <?php if((strlen(strpos($applied_card_name, "ICICI Bank HPCL Titanium Credit Card")) > 0)) echo "checked"; ?>></td>
		</tr>
<? } if($month_sal>="35000") 
{ ?>
		<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank HPCL Platinum Credit Card </b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>Joining Fee</b> - Nil<br>
<b>Annual Fee</b> - Rs. 500 (1st year)
- Rs. 500 (Reversed in case spends exceed Rs. 50,000 in the previous year)(2nd year onwards)<br>
<b>Joining Benefit </b>- Cashback of Rs 500 if purchases exceed Rs. 5,000 within 60 days of card set up</td>
		<td width="11%" align="center"><input type="checkbox" name="applied_card_name[]" id="applied_card_name" value="ICICI Bank HPCL Platinum Credit Card" <?php if((strlen(strpos($applied_card_name, "ICICI Bank HPCL Platinum Credit Card")) > 0)) echo "checked"; ?>></td>
		</tr>
<? } if($month_sal>="35000") 
{ ?>
		<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank Coral Credit Card </b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">  <b>Option I</b><br>  <b>Joining Fee</b> - Rs. 1,000<br>
<b>Annual Fee</b> - Rs. 500 (2nd Year onwards; waived off if spends cross Rs. 1,25,000 in the previous year)<br>
<b>Welcome Gift:</b> Satya Paul gifts worth Rs.5,000<br><br>
<b>Option II</b><br>
<b>Lifetime Fee</b> - Rs. 5,000<br>
<b>Welcome Gift:</b> Bose Headphones<br></td>
		<td width="11%" align="center"><input type="checkbox" name="applied_card_name[]" id="applied_card_name" value="ICICI Bank Coral Credit Card" <?php if((strlen(strpos($applied_card_name, "ICICI Bank Coral Credit Card")) > 0)) echo "checked"; ?>> </td>
		</tr>
<? } if($month_sal>="50000") 
{ ?>
		<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank Rubyx Credit Cards </b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>Option I</b><br>
<b> Joining Fee</b> - Rs. 5,000<br>
<b> Annual Fee </b>- Rs. 2,000 (2nd Year onwards; waived off if spends cross Rs. 2,50,000 in the previous year) <br>
<b> Welcome Gift:</b> Bose Headphones <br><br>
<b>Option II</b><br>
<b> Lifetime Fee</b> - Rs. 25,000<br>
<b>    Welcome Gift:</b> Apple iPad2</td>
		<td width="11%" align="center"><input type="checkbox" name="applied_card_name[]" id="applied_card_name" value="ICICI Bank Rubyx Credit Cards" <?php if((strlen(strpos($applied_card_name, "ICICI Bank Rubyx Credit Cards")) > 0)) echo "checked"; ?>></td>
		</tr>
		
<? } if($month_sal>="175000") 
{ ?>
<tr><td width="25%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>ICICI Bank Sapphiro Credit Cards  </b></td>
		<td width="64%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><b>Option I</b><br>
<b> Joining Fee</b> - Rs. 25,000<br>
<b> Annual Fee </b>- Rs. 3,500 (2nd Year onwards; waived off if spends cross Rs. 5,00,000 in the previous year)<br>
<b> Welcome Gift:</b> Apple iPad2<br><br>
<b>Option II</b><br>
<b> Lifetime Fee</b> - Rs. 75,000<br>
<b>    Welcome Gift:</b> Apple Macbook Air</td>
		<td width="11%" align="center"><input type="checkbox" name="applied_card_name[]" id="applied_card_name" value="ICICI Bank Sapphiro Credit Cards" <?php if((strlen(strpos($applied_card_name, "ICICI Bank Sapphiro Credit Cards")) > 0)) echo "checked"; ?>></td>
		</tr>
		<? } ?>
		</table>
	</td></tr>
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