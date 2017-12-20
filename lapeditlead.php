<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/db_init_bima.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncLAP.php';
//require 'neweligibilelist.php';

	
	$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];
		

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$lapproperty_value = $_POST['lapproperty_value'];
		$lapname = $_POST['lapname'];
		$fm_subcategory=$_POST['fm_subcategory'];
		$reg_year=$_POST['reg_year'];
		$reg_month=$_POST['reg_month'];
		$tataaig_home=$_POST['Tataaig_Home'];
		$purchase_date=$reg_month."-".$reg_year;
		$fm_category_id=$_POST['fm_category_id'];
		$renewal_date= $_POST['renewal_date'];
		$tataaig_health=$_POST["Tataaig_Health"];
		$tataaig_auto=$_POST["Tataaig_Auto"];
		$lapemail = $_POST["lapemail"];
		$lapmobile = $_POST["lapmobile"];
		$lapstd_code = $_POST["lapstd_code"];
		$laplandline = $_POST["laplandline"];
		$lapresidential_status = $_POST["lapresidential_status"];
		$lapemlapoyment_status = $_POST["lapemlapoyment_status"];
		$laplandline_o = $_POST["laplandline_o"];
		$lapstd_code_o = $_POST["lapstd_code_o"];
		$lapnet_salary = $_POST["lapnet_salary"];
		$lapcompany_name = $_POST["lapcompany_name"];
//print_r ($Loan_Any)."<br>";
		$lappincode = $_POST["lappincode"];
		$lapdob=$_POST['lapdob'];
		$laploan_amount = $_POST["laploan_amount"];
		$lapcity = $_POST["lapcity"];
		$lapcity_other = $_POST["lapcity_other"];
		$lapactivation_code = $_POST["lapactivation_code"];
		$lapbidder_count = $_POST["lapbidder_count"];
		$lapfeedback = $_POST["lapfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$lapcontact_time = $_POST["lapcontact_time"];
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		//echo "araay::";
		$Accidental_Insurance=$_POST['Accidental_Insurance'];
		//print_r ($Final_Bidder)."<br>";
		$Bidder_Id = $_REQUEST['BidderId'];
		$lapadd_comment= $_REQUEST['lapadd_comment'];
		$property_loc = $_REQUEST['property_loc'];

	/*$n       = count($Final_Bidder);
	   $i      = 0;
	   while ($i < $n)
	   {
		  $Final_Bid.= "$Final_Bidder[$i], ";
		 $i++;
	   }*/
$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 

$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }

$Final_Bid = substr($Final_Bid, 0, strlen($Final_Bid)-1); //remove the final comma sign from the final array
//echo "hello".$Final_Bid."<br>";
if(strlen($Final_Bid)>0)
	{
	$Allocated=2;
	$Is_Valid = 1;
	}
	else 
	{
		$Allocated=0;
		$Is_Valid=0;
	}
	
		
	if(strlen($Final_Bid)>0)
	{
	$updatelead="Update Req_Loan_Against_Property set Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',Name='$lapname',Company_Name='$lapcompany_name',DOB='$lapdob',Email='$lapemail',City='$lapcity',City_Other='$lapcity_other', Mobile_Number='$lapmobile', Std_Code='$lapstd_code',Landline='$laplandline',Std_Code_O='$lapstd_code_o',Landline_O='$laplandline_o',Net_Salary='$lapnet_salary',Pincode='$lappincode',Employment_Status='$lapemployment_status',Bidderid_Details='$Final_Bid',Add_Comment='$lapadd_comment',Updated_Date=Now(), Allocated='$Allocated',Contact_Time='$lapcontact_time',Property_Value='$lapproperty_value',Loan_Amount='$laploan_amount',Property_Loc='$property_loc',Is_Valid='$Is_Valid',IsModified=2 where RequestID=".$post;
	
	}
	else
	{
	$updatelead="Update Req_Loan_Against_Property set Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',Name='$lapname',Company_Name='$lapcompany_name',DOB='$lapdob',Email='$lapemail',City='$lapcity',City_Other='$lapcity_other', Mobile_Number='$lapmobile', Std_Code='$lapstd_code',Landline='$laplandline',Std_Code_O='$lapstd_code_o',Landline_O='$laplandline_o',Net_Salary='$lapnet_salary',Pincode='$lappincode',Employment_Status='$lapemployment_status',Bidderid_Details='$Final_Bid',Add_Comment='$lapadd_comment',Contact_Time='$lapcontact_time',Property_Value='$lapproperty_value',Loan_Amount='$laploan_amount',Property_Loc='$property_loc' where RequestID=".$post;
	}
		//echo "query".$updatelead;
	 $updateleadresult=ExecQuery($updatelead);

if($Accidental_Insurance==1)
	{
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=5");		
		//echo "select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=2";
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update `tataaig_leads` Set Mobile_Number='".$plmobile."'";
			$strSQL=$strSQL."Where `T_RequestID`=".$post;
		}
		else
		{
			$strSQL="INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, Mobile_Number, `T_Dated` ) VALUES ('".$post."', '5','".$lapcity."', '".$lapmobile."' , Now())";
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

}
//FOR TATAAIG Auto INSURANCE
if($tataaig_auto==1)
	{
		$autostrSQL="";
		$Msg="";
		$autoresult = ExecQuery_bima("select RequestID from Req_Auto_Insurance where Referrer=".$post." AND Crosssell_Product=5");		
		//echo "select RequestID from Req_Auto_Insurance where Referrer=".$post." AND Creative=pl";
		$num_rows = mysql_num_rows($autoresult);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($autoresult);
			$autostrSQL="Update Req_Auto_Insurance Set Phone='".$lapmobile."'";
			$autostrSQL=$autostrSQL."Where Referrer=".$post." and Crosssell_Product=5";
					//echo "update".$autostrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($autostrSQL);
		}
		else
		{
			$autostrSQL="INSERT INTO Req_Auto_Insurance ( Referrer , Creative , `City`, Phone, `Dated` ,DOB,Name,Email,`City_Other`,Source,Pincode,Std_Code,Landline,Renewal_Date,Crosssell_Product,Bidderid_Details,Vehicle_Make, Vehicle_Model,Car_Purchase_Date) VALUES ('".$post."', 'lap','".$lapcity."', '".$lapmobile."' , Now(),'$lapdob','$lapname','$lapemail','$lapcity_other','cross-sell','$lappincode','$lapstd_code','$laplandline','$renewal_date','5','201','$fm_category_id', '$fm_subcategory','$purchase_date')";
			//echo "insert".$autostrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($autostrSQL);
			$last_inserted_id = mysql_insert_id();

			
		}

		if ($autoresult == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your lead for tataaig Auto insurance. Please try again.";
		}

}
//FOR TATAAIG HOME INSURANCE
if($tataaig_home==1)
	{
		$tatastrSQL="";
		$Msg="";
		$tatatresult = ExecQuery_bima("select RequestID from Req_Home_Insurance where Referrer=".$post." and Crosssell_Product=5");		
		//echo "select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=2";
		$num_rows = mysql_num_rows($tatatresult);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($tatatresult);
			$tatastrSQL="Update Req_Home_Insurance Set Phone='".$lapmobile."'";
			$tatastrSQL=$tatastrSQL."Where Referrer=".$post." and Crosssell_Product=5";
			echo "for home:".$tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
		}
		else
		{
			$tatastrSQL="INSERT INTO Req_Home_Insurance ( Referrer , Creative , `City`, Phone, `Dated` ,DOB,Name,Email,`Other_City`,Source,Pincode,Std_Code,Landline,Crosssell_Product,Bidderid_Details) VALUES ('".$post."', 'lap','".$lapcity."', '".$lapmobile."' , Now(),'$lapdob','$lapname','$lapemail','$lapcity_other','cross-sell','$lappincode','$lapstd_code','$laplandline','5','201')";
			echo "for home".$tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
			$last_inserted_id = mysql_insert_id();

			
		}
		//echo $tatastrSQL."<br><br>";

		
		
		if ($tatatresult == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your lead for tataaig health insurance. Please try again.";
		}
	}
//FOR TATAAIG HEALTH INSURANCE
if($tataaig_health==1)
	{
		$tatastrSQL="";
		$Msg="";
		$tatatresult = ExecQuery_bima("select RequestID from Req_Health_Insurance where Referrer=".$post." and Crosssell_Product=5");		
		//echo "select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=2";
		$num_rows = mysql_num_rows($tatatresult);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($tatatresult);
			$tatastrSQL="Update Req_Health_Insurance Set Phone='".$lapmobile."'";
			$tatastrSQL=$tatastrSQL."Where Referrer=".$post." and Crosssell_Product=5";
			//echo $tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
		}
		else
		{
			$tatastrSQL="INSERT INTO Req_Health_Insurance ( Referrer , Creative , `City`, Phone, `Dated` ,DOB,Name,Email,`Other_City`,Source,Pincode,Std_Code,Landline,CC_Holder,Crosssell_Product,Bidderid_Details, Is_Valid) VALUES ('".$post."', 'lap','".$lapcity."', '".$lapmobile."' , Now(),'$lapdob','$lapname','$lapemail','$lapcity_other','cross-sell','$lappincode','$lapstd_code','$laplandline','0','5','201','1')";
			//echo $tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
			$last_inserted_id = mysql_insert_id();

			
		}
				
		if ($tatatresult == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your lead for tataaig health insurance. Please try again.";
		}

}


	 if(strlen($lapfeedback)>0)
	{
		if($lapfeedback=="Not Contactable")
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
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_LAP where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=5");		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$notcontactableCounter=$row["not_contactable_counter"];
			$updatedcounter=$notcontactableCounter+1;
			$strSQL="Update Req_Feedback_LAP Set Feedback='".$lapfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
			if($notcontactableCounter<2)
			{
				$product="Loan Against Property";	
		$feedback=$lapfeedback;
		include "scripts/feedbackmailerscript.php";
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//echo $Type_Loan;

		if($feedback=="Not Contactable" && (strlen($lapemail)>0))
		{
			mail($lapemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
		}
			}
		}
		else
		{
			$strSQL="Insert into Req_Feedback_LAP(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",5,'".$lapfeedback."','".$FollowupDate."','".$counter."')";

		$product="Loan Against Property";	
		$feedback=$lapfeedback;
		include "scripts/feedbackmailerscript.php";
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//echo $Type_Loan;

		if($feedback=="Not Contactable" && (strlen($lapemail)>0))
		{
			mail($lapemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
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
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
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
<p align="center"><b>Loan Against Property Lead Details </b></p>

<?php 


$viewqry="select * from Req_Loan_Against_Property LEFT OUTER JOIN Req_Feedback_LAP ON Req_Feedback_LAP.AllRequestID=Req_Loan_Against_Property.RequestID and Req_Feedback_LAP.BidderID= '".$bidid."' where Req_Loan_Against_Property.RequestID=".$post." "; 

//echo "dd".$viewqry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
$property_loc = mysql_result($viewlead,0,'Property_Loc');
$Tataaig_Home=  mysql_result($viewlead,0,'Tataaig_Home');
$Tataaig_Health=  mysql_result($viewlead,0,'Tataaig_Health');
$Tataaig_Auto=  mysql_result($viewlead,0,'Tataaig_Auto');
$Accidental_Insurance = mysql_result($viewlead,0,'Accidental_Insurance');
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
$Dated = mysql_result($viewlead,0,'Dated');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
$Email = mysql_result($viewlead,0,'Email');
$source = mysql_result($viewlead,0,'source');
$Pincode = mysql_result($viewlead,0,'Pincode');
$SentEmail = mysql_result($viewlead,0,'SentEmail');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$Feedback = mysql_result($viewlead,0,'Feedback');
$Property_Value = mysql_result($viewlead,0,'Property_Value');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$DOB = mysql_result($viewlead,0,'DOB');
$Contact_Time  = mysql_result($viewlead,0,'Contact_Time');
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
if($Bidder_Count!=0)
{
	$strbidderid="";
	$z=0;
$retrieve_query="select BidderID from Req_Feedback_Bidder1 where AllRequestID=".$post." and Reply_Type=5";
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
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><input type="text" name="lapname" id="lapname" value="<?echo $Name;?>"></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="lapemail" id="lapemail" value="<?echo $Email;?>"></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="lapdob" id="lapdob"size="15" value="<?echo $DOB;?>"></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="text" name="lapmobile" id="lapmobile" size="15" value="<?echo $Mobile;?>"></td>
			</tr>
			
		<tr>
			<td class="fontstyle"><b>Residence No</b></td>
			<td class="fontstyle"><input type="text" name="lapstd_code" size="1" value="<? echo $Std_Code;?>" >-<input type="text" name="laplandline" size="8" value="<?echo $Landline;?>"></td>
			<td class="fontstyle" ><b>Office No.</b></td>
			<td class="fontstyle"><input type="text" name="lapstd_code_o"  size="1" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="laplandline_o" size="9" value="<?echo $Landline_O;?>"></td>
		</tr>
		
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><select size="1" name="lapcity" id="lapcity"> <?=getCityList($City)?></select></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><input type="text" name="lapcity_other" id="lapcity_other" size="10" value="<?echo $City_Other;?>" ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="lappincode" size="10" value="<?echo $Pincode;?>" ></td>
		<td colspan="2">&nbsp;</td>
		</tr>
				
		<input type="hidden" name="BidderId" value="<?echo $bidid;?>"><input type="hidden" name="laprequestid" id="laprequestid" value="<?echo $post;?>">
<tr>
	<!--<td><table width="100%">
	<tr>-->
		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><select class="fontstyle" name="lapemployment_status" id="lapemployment_status">
			<option value="1" <?if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
			<option value="0" <?if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>		</td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><input type="text" name="lapnet_salary" id="lapnet_salary" value="<?echo $Net_Salary;?>"  onKeyUp="getDigitToWords('lapnet_salary','formatedIncome','wordIncome');" onKeyPress="getDigitToWords('lapnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('lapnet_salary','formatedIncome','wordIncome');"></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><input type="text" name="lapcompany_name" id="lapcompany_name" value="<? echo $Company_Name;?>"></td></tr>
	<tr>
<td colspan="2" >&nbsp;</td>
	<td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
	
	<td class="fontstyle"><b>Loan Amount Required</b></td>
	<td class="fontstyle"><input type="text" name="laploan_amount" id="laploan_amount" value="<?echo $Loan_Amount;?>"  onKeyUp="getDigitToWords('laploan_amount','formatedloan','wordloan');" onKeyPress="getDigitToWords('laploan_amount','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('laploan_amount','formatedloan','wordloan');"></td>
	<td class="fontstyle">&nbsp;</td>	
</tr>

 

<tr>
<td colspan="2">&nbsp;</td>
	<td colspan="2" ><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Other Details</b></td></tr>
		<tr><td><b>Property Value</b></td><td><input type="text" name="lapproperty_value" id="lapproperty_value" value="<?php echo $Property_Value;?>"></td><td><b>Contact Time</b></td>
		  <td> <select size="1" align="left" name="lapcontact_time" id="lapcontact_time" class="style4">
		  <option value="-1" >Prefered Time</option> 
		  <option value="10- 12 am" <? if($Contact_Time=="10- 12 am") echo "selected" ?>>10- 12 am</option> 
		  <option value="12- 2 pm" <? if($Contact_Time=="12- 2 pm") echo "selected" ?>>12- 2 pm</option> 
		  <option value="2- 4 pm" <? if($Contact_Time=="2- 4 pm") echo "selected" ?>>2- 4 pm</option>
		  <option value="4- 6 pm" <? if($Contact_Time=="4- 6 pm") echo "selected" ?>>4- 6 pm</option>
		  <option value="After 6 pm" <? if($Contact_Time=="After 6 pm") echo "selected" ?>>After 6 pm</option>
		  </select>
		  </td></tr>
<tr><td><b>Property Location</b></td><td><input type="text" name="property_loc" id="property_loc" value="<? echo $property_loc; ?>"></td><td colspan="2">&nbsp;</td></tr>
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
<tr><td class="fontstyle"><b>Eligible for Bidders</b></td><? if(strlen($Bidderid_Details)>0){?><td class="fontstyle" colspan="2"> already send</td><? } else {?><td colspan="2"><div id="checkdiv" name="checkdiv"><? list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Against_Property",$post,$City);
   for($i=0;$i<count($FinalBidder);$i++)
			{
		echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
		//echo $FinalBidder[$i];
			}
}
	
		?></div><!--<input type="button" onclick="insertTemp();" value="hello">--></td>
</tr>


		<!--</table>
	</td>
</tr>-->
<!--<tr><td>
<table width="100%">-->
<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>


<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle"><select name="lapfeedback" id="feedback">
		<option value="" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
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
	</select>	</td>
	

	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>

	<tr><td class="fontstyle"><b>Source</b></td>
		<td><? echo $source; ?></td>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="lapadd_comment" id="lapadd_comment" ><? echo $Add_Comment; ?></textarea></td>
	</tr>
<tr><td class="fontstyle"><b></b></td>
		<td><? echo $Is_Valid; ?></td>
		<td colspan="2"></td>
	</tr>

 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit">      </td>
   </tr>
</table>
</form>
</body>
</html>