<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/db_init_bima.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPL.php';
//require 'neweligibilelist.php';

	session_start();
	$post=$_REQUEST['id'];

	$bidid =847;
		

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$fm_subcategory=$_POST['fm_subcategory'];
		$reg_year=$_POST['reg_year'];
		$plname =$_POST['plname'];
		$reg_month=$_POST['reg_month'];
		$tataaig_home=$_POST['Tataaig_Home'];
		$purchase_date=$reg_month."-".$reg_year;
		$fm_category_id=$_POST['fm_category_id'];
		$renewal_date= $_POST['renewal_date'];
		$tataaig_health=$_POST["Tataaig_Health"];
		$tataaig_auto=$_POST["Tataaig_Auto"];
		$plemail = $_POST["plemail"];
		$Accidental_Insurance=$_POST['Accidental_Insurance'];
		$pltotal_experience = $_POST["pltotal_experience"];
		$plyears_in_company = $_POST["plyears_in_company"];
		$plmobile = $_POST["plmobile"];
		$plstd_code = $_POST["plstd_code"];
		$pllandline = $_POST["pllandline"];
		$plresidential_status = $_POST["plresidential_status"];
		$plemployment_status = $_POST["plemployment_status"];
		$pllandline_o = $_POST["pllandline_o"];
		$plstd_code_o = $_POST["plstd_code_o"];
		$plnet_salary = $_POST["plnet_salary"];
		//$plcc_holder =$_POST["plcc_holder"];
		$plcc_holder = $_POST["plcc_holder"];
		$Loan_Any = $_POST["Loan_Any"];
		$emi_amt = $_POST["emi_amt"];
	$plcompany_name = $_POST["plcompany_name"];
//print_r ($Loan_Any)."<br>";
		$plemi_paid = $_POST["plemi_paid"];
		$plpincode = $_POST["plpincode"];
		$pldob=$_POST['pldob'];
		$plloan_amount = $_POST["plloan_amount"];
		$plcity = $_POST["plcity"];
		$plmobile_connection = $_POST["plmobile_connection"];
		$pllandline_connection = $_POST["pllandline_connection"];
		$plcity_other = $_POST["plcity_other"];
		$plactivation_code = $_POST["plactivation_code"];
		$plbidder_count = $_POST["plbidder_count"];
		$plfeedback = $_POST["plfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		//echo "araay::";
		print_r ($Final_Bidder)."<br>";
		$Bidder_Id = $_REQUEST['BidderId'];
		$pladd_comment= $_REQUEST['pladd_comment'];
		$Primary_Acc= $_REQUEST['Primary_Acc'];

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
echo "hello".$Final_Bid."<br>";
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
	$updatelead="Update Req_Loan_Personal set Name='$plname',Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection',Bidderid_Details='$Final_Bid',Add_Comment='$pladd_comment',Dated=Now(), Allocated='$Allocated',Primary_Acc='$Primary_Acc' where RequestID=".$post;
	
	}
	else
	{
	$updatelead="Update Req_Loan_Personal set Name='$plname',Primary_Acc='$Primary_Acc', Tataaig_Home='$tataaig_home',Accidental_Insurance='$Accidental_Insurance', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Add_Comment='$pladd_comment' where RequestID=".$post;
	}
		//echo "query".$updatelead;
	 $updateleadresult=ExecQuery($updatelead);

if($Accidental_Insurance==1)
	{
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=1");		
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
			$strSQL="INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, Mobile_Number, `T_Dated` ) VALUES ('".$post."', '1','".$plcity."', '".$plmobile."' , Now())";
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
		$autoresult = ExecQuery_bima("select RequestID from Req_Auto_Insurance where Referrer=".$post." AND Crosssell_Product=1");		
		//echo "select RequestID from Req_Auto_Insurance where Referrer=".$post." AND Creative=pl";
		$num_rows = mysql_num_rows($autoresult);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($autoresult);
			$autostrSQL="Update Req_Auto_Insurance Set Phone='".$plmobile."'";
			$autostrSQL=$autostrSQL."Where Referrer=".$post." and Crosssell_Product=1";
					//echo "update".$autostrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($autostrSQL);
		}
		else
		{
			$autostrSQL="INSERT INTO Req_Auto_Insurance ( Referrer , Creative , `City`, Phone, `Dated` ,DOB,Name,Email,`City_Other`,Source,Pincode,Std_Code,Landline,Renewal_Date,Crosssell_Product,Bidderid_Details,Vehicle_Make, Vehicle_Model,Car_Purchase_Date) VALUES ('".$post."', 'pl','".$plcity."', '".$plmobile."' , Now(),'$pldob','$plname','$plemail','$plcity_other','cross-sell','$plpincode','$plstd_code','$pllandline','$renewal_date','1','201','$fm_category_id', '$fm_subcategory','$purchase_date')";
			//echo "insert".$autostrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($autostrSQL);
			$last_inserted_id = mysql_insert_id();

			//$tatafeedback=ExecQuery_bima("INSERT INTO Req_Feedback_Bidder (AllRequestID,BidderID,Reply_Type,Allocated,Allocation_Date) Values ('$last_inserted_id','201','3','1',Now())");
			//echo "INSERT INTO Req_Feedback_Bidder (AllRequestID,BidderID,Reply_Type,Allocated,Allocation_Date) Values ('$last_inserted_id','201','3','1',Now())";
			//echo "<br>";
			

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
		$tatatresult = ExecQuery_bima("select RequestID from Req_Home_Insurance where Referrer=".$post." and Crosssell_Product=1");		
		//echo "select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=2";
		$num_rows = mysql_num_rows($tatatresult);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($tatatresult);
			$tatastrSQL="Update Req_Home_Insurance Set Phone='".$plmobile."'";
			$tatastrSQL=$tatastrSQL."Where Referrer=".$post." and Crosssell_Product=1";
			echo "for home:".$tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
		}
		else
		{
			$tatastrSQL="INSERT INTO Req_Home_Insurance ( Referrer , Creative , `City`, Phone, `Dated` ,DOB,Name,Email,`Other_City`,Source,Pincode,Std_Code,Landline,Crosssell_Product,Bidderid_Details) VALUES ('".$post."', 'pl','".$plcity."', '".$plmobile."' , Now(),'$pldob','$plname','$plemail','$plcity_other','cross-sell','$plpincode','$plstd_code','$pllandline','1','201')";
			echo "for home".$tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
			$last_inserted_id = mysql_insert_id();

			//$tatafeedback=ExecQuery_bima("INSERT INTO Req_Feedback_Bidder (AllRequestID,BidderID,Reply_Type,Allocated,Allocation_Date) Values ('$last_inserted_id','201','2','1',Now())");
//echo 			"INSERT INTO Req_Feedback_Bidder (AllRequestID,BidderID,Reply_Type,Allocated,Allocation_Date) Values ('$last_inserted_id','201','2','1',Now())";
//echo "<br>";
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
		$tatatresult = ExecQuery_bima("select RequestID from Req_Health_Insurance where Referrer=".$post." and Crosssell_Product=1");		
		//echo "select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=2";
		$num_rows = mysql_num_rows($tatatresult);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($tatatresult);
			$tatastrSQL="Update Req_Health_Insurance Set Phone='".$plmobile."'";
			$tatastrSQL=$tatastrSQL."Where Referrer=".$post." and Crosssell_Product=1";
			//echo $tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
		}
		else
		{
			$tatastrSQL="INSERT INTO Req_Health_Insurance ( Referrer , Creative , `City`, Phone, `Dated` ,DOB,Name,Email,`Other_City`,Source,Pincode,Std_Code,Landline,CC_Holder,Crosssell_Product,Bidderid_Details, Is_Valid) VALUES ('".$post."', 'pl','".$plcity."', '".$plmobile."' , Now(),'$pldob','$plname','$plemail','$plcity_other','cross-sell','$plpincode','$plstd_code','$pllandline','$plcc_holder','1','201','1')";
			//echo $tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
			$last_inserted_id = mysql_insert_id();

			//$tatafeedback=ExecQuery_bima("INSERT INTO Req_Feedback_Bidder (AllRequestID,BidderID,Reply_Type,Allocated,Allocation_Date) Values ('$last_inserted_id','201','2','1',Now())");
//echo 			"INSERT INTO Req_Feedback_Bidder (AllRequestID,BidderID,Reply_Type,Allocated,Allocation_Date) Values ('$last_inserted_id','201','2','1',Now())";
//echo "<br>";
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


	 if(strlen($plfeedback)>0)
	{
		if($plfeedback=="Not Contactable")
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
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=1");		
		//echo "select FeedbackID,not_contactable_counter from Req_Feedback where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=1";
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = mysql_fetch_array($result);
			$notcontactableCounter=$row["not_contactable_counter"];
		
			$updatedcounter=$notcontactableCounter+1;
			$strSQL="Update Req_Feedback Set Feedback='".$plfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
			if($notcontactableCounter<2)
			{
				$product="Personal Loan";	
				$feedback=$plfeedback;
					include "scripts/feedbackmailerscript.php";

					$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if($feedback=="Not Contactable" && (strlen($plemail)>0))
					{
						mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
					}
			}

		}
		else
		{
			$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",1,'".$plfeedback."','".$FollowupDate."','".$counter."')";

			$product="Personal Loan";	
		$feedback=$plfeedback;
					include "scripts/feedbackmailerscript.php";

					$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if($feedback=="Not Contactable" && (strlen($plemail)>0))
					{
						mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
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

<script>

var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
////////////////To view bidders after clicking contactable //////////////////
		function insertEligibleBidder(new_active_code)
		{
			
			var new_request = document.getElementById('plrequestid').value;
			var new_city_other= document.getElementById('plcity_other').value;
			var new_city = document.getElementById('plcity').value;
			//var new_active_code = document.getElementById('plactivation_code').value;
			
			

			if(new_active_code==1)
			{
			if(new_city_other!='')
			{
				var queryString = "?Request=" + new_request + "&City=" + new_city + "&City_Other" + new_city_other + "&valid=" + new_active_code;
			}
			else
			{
				var queryString = "?Request=" + new_request + "&City=" + new_city + "&valid=" + new_active_code ;
			}
			}
			else
			{
				var queryString = "?Request=" + new_request + "&valid=" + new_active_code;
			}
				//alert(queryString); 
				ajaxRequest.open("GET", "dynamiceligiblebidderlistPL.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('checkdiv');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
						alert(ajaxRequest.responseText);
					
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		

		function insertPLTemp()
		{
			var new_type = document.getElementById('CCmailertype').value;
			var new_request = document.getElementById('plrequestid').value;
			var new_name = document.getElementById('plname').value;
			var new_email = document.getElementById('plemail').value;
			

			if((new_name!=""))
			{

				var queryString = "?Name=" + new_name + "&Email="+ new_email + "&Type=" + new_type + "&Request=" + new_request ;
				//alert(queryString); 
				ajaxRequest.open("GET", "sendPLmail.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('CCajaxDiv');
						ajaxDisplay.innerHTML = "sent";
						
					
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}
	
	window.onload = ajaxFunction;
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
<p align="center"><b>Personal loan Lead Details </b></p>

<?php 


$viewqry="select * from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." "; 

//echo "dd".$viewqry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
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
$Residential_Status = mysql_result($viewlead,0,'Residential_Status');
$City = mysql_result($viewlead,0,'City');
$City_Other = mysql_result($viewlead,0,'City_Other');
$Is_Valid = mysql_result($viewlead,0,'Is_Valid');
$Dated = mysql_result($viewlead,0,'Dated');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
$Email = mysql_result($viewlead,0,'Email');
$Contactable = mysql_result($viewlead,0,'Contactable');
$source = mysql_result($viewlead,0,'source');
$Loan_Any = mysql_result($viewlead,0,'Loan_Any');
$Pincode = mysql_result($viewlead,0,'Pincode');
$SentEmail = mysql_result($viewlead,0,'SentEmail');
$Emi_Paid = mysql_result($viewlead,0,'Emi_Paid');
$CC_Holder = mysql_result($viewlead,0,'CC_Holder');
$Card_Vintage = mysql_result($viewlead,0,'Card_Vintage');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$Feedback = mysql_result($viewlead,0,'Feedback');
$CC_Mailer = mysql_result($viewlead,0,'CC_Mailer');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$PL_EMI_Amt = mysql_result($viewlead,0,'PL_EMI_Amt');
$Card_Limit = mysql_result($viewlead,0,'Card_Limit');
$Salary_Drawn = mysql_result($viewlead,0,'Salary_Drawn');
$Landline_Connection = mysql_result($viewlead,0,'Landline_Connection');
$Mobile_Connection = mysql_result($viewlead,0,'Mobile_Connection');
$Total_Experience = mysql_result($viewlead,0,'Total_Experience');
$Years_In_Company = mysql_result($viewlead,0,'Years_In_Company');
$DOB = mysql_result($viewlead,0,'DOB');
//$Company_Name  = mysql_result($viewlead,0,'Company_Name');
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
$checked_bidders = mysql_result($viewlead,0,'checked_bidders');
$Primary_Acc = mysql_result($viewlead,0,'Primary_Acc');
$checked_bidders = explode(",",$checked_bidders);
//print_r($checked_bidders);
//echo "ff".$SentEmail;
$Loan_Any = substr($Loan_Any, 0, strlen($Loan_Any)-1); 
if($Bidder_Count!=0)
{
	$strbidderid="";
	$z=0;
$retrieve_query="select BidderID from Req_Feedback_Bidder1 where AllRequestID=".$post." and Reply_Type=1";
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
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>" >
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plname" id="plname" value="<?echo $Name;?>"></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plemail" id="plemail" value="<?echo $Email;?>"></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="pldob" id="pldob"size="15" value="<?echo $DOB;?>"></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="text" name="plmobile" size="15" value="<?echo $Mobile;?>"></td>
			</tr>
			
		<tr>
			<td class="fontstyle"><b>Residence No</b></td>
			<td class="fontstyle"><input type="text" name="plstd_code" size="1" value="<? echo $Std_Code;?>" >-<input type="text" name="pllandline" size="8" value="<?echo $Landline;?>"></td>
			<td class="fontstyle" ><b>Office No.</b></td>
			<td class="fontstyle"><input type="text" name="plstd_code_o"  size="1" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="pllandline_o" size="9" value="<?echo $Landline_O;?>"></td>
		</tr>
		
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><select size="1" name="plcity" id="plcity"> <?=getCityList($City)?></select></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><input type="text" name="plcity_other" id="plcity_other" size="10" value="<?echo $City_Other;?>" ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="plpincode" size="10" value="<?echo $Pincode;?>" ></td>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Residence Status</b></td>
			<td colspan="2" class="fontstyle"><input type="radio" id="plresidential_status" value="1" name="plresidential_status" <?if($Residential_Status==1){ echo "checked";}?> class="NoBrdr" checked> Owned
			 <input type="radio" value="2" name="plresidential_status" id="plresidential_status" class="NoBrdr" <?if($Residential_Status==2){ echo "checked";}?>> Rented<input type="radio" value="3" name="plresidential_status" id="plresidential_status" class="NoBrdr" <?if($Residential_Status==3){ echo "checked";}?>> Company Provided</td>
			<td>&nbsp;</td>
		</tr>
		

	
		<tr>
			<td class="fontstyle" colspan="2"><b>Primary Account in which bank?</b>			</td>
	<td><input type="text" size="18"  name="Primary_Acc" id="Primary_Acc" value="<?php echo $Primary_Acc; ?>"></td>
	<td>&nbsp;</td></tr>
			
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="BidderId" value="<?echo $bidid;?>"></td></tr>
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="plrequestid" id="plrequestid" value="<?echo $post;?>"></td>
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
		<td class="fontstyle"><select class="fontstyle" name="plemployment_status" id="plemployment_status">
			<option value="1" <?if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
			<option value="0" <?if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>
		</td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><input type="text" name="plnet_salary" id="plnet_salary" value="<?echo $Net_Salary;?>"  onKeyUp="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" onKeyPress="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('plnet_salary','formatedIncome','wordIncome');"></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><input type="text" name="plcompany_name" id="plcompany_name" value="<? echo $Company_Name;?>"></td></tr>
	<tr>
<td colspan="2" >&nbsp;</td>
	<td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>

	<tr>
		<td class="fontstyle"><b>Total Experience</b></td>
		<td class="fontstyle"><input type="text" name="pltotal_experience" id="pltotal_experience" size="5" value="<?echo $Total_Experience;?>"><b>(years)</b>
		</td>
		<td class="fontstyle"><b>Current experience in company</b></td>
		<td class="fontstyle"><input type="text" name="plyears_in_company" id="plyears_in_company" value="<?echo $Years_In_Company;?>" size="5"><b>(years)</b></td>
	</tr>
	

<tr>
<!--<td><table width="100%">
<tr>--><td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td></tr>

<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><input type="radio" value="1" name="plcc_holder" id="plcc_holder" <? if($CC_Holder==1){ echo "checked";}?> class="NoBrdr" checked>Yes
     <input type="radio" value="0" name="plcc_holder"  id="plcc_holder" class="NoBrdr" <?if($CC_Holder==0){ echo "checked";}?>>No</td>
	 
		<td class="fontstyle"><b>Credit Card Limit?</b></td>
		 <td class="fontstyle"><input size="18" class="style4" name="plcard_limit" id="plcard_limit" value="<?echo $Card_Limit;?>">
					</td>
			   </tr>
	 
<tr>
	<td class="fontstyle"><b>Card held since?</b></td><td class="fontstyle"><select  class="fontstyle" size="1" name="plcard_vintage" id="plcard_vintage">
	<option value="0" <?if($Card_Vintage==0) { echo "selected"; } ?>>Please select</option>
	<option value="1" <?if($Card_Vintage==1) { echo "selected"; } ?>>Less than 6 months</option>
	<option value="2" <?if($Card_Vintage==2) { echo "selected"; } ?>>6 to 9 months</option> 
	<option value="3" <?if($Card_Vintage==3) { echo "selected"; } ?>>9 to 12 months</option>
	<option value="4" <?if($Card_Vintage==4) { echo "selected"; } ?>>more than 12 months</option>
	</select></td>	
	<td class="fontstyle"><b>Loan Amount Required</b></td>
	<td class="fontstyle"><input type="text" name="plloan_amount" id="plloan_amount" value="<?echo $Loan_Amount;?>"  onKeyUp="getDigitToWords('plloan_amount','formatedloan','wordloan');" onKeyPress="getDigitToWords('plloan_amount','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('plloan_amount','formatedloan','wordloan');"></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
	<td colspan="2" ><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
	<td class="fontstyle"><b>Any Loan Running ?</b></td>
	
	<td >
		<table border="0">	
			<tr>
				<td class="fontstyle"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl" <?php if((strlen(strpos($Loan_Any, "hl")) > 0)) echo "checked"; ?>>Home</td>
				<td class="fontstyle"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl" <?php if((strlen(strpos($Loan_Any, "pl")) > 0)) echo "checked"; ?>>Personal</td>
			</tr>
			<tr>
				<td class="fontstyle"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr"  value="cl" <?php if((strlen(strpos($Loan_Any, "cl")) > 0)) echo "checked"; ?>>Car</td>
				<td class="fontstyle"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap" <?php if((strlen(strpos($Loan_Any, "lap")) > 0)) echo "checked"; ?>>Property</td>
			</tr>
			<tr>
				<td colspan="2" class="fontstyle"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other" <?php if((strlen(strpos($Loan_Any, "other")) > 0)) echo "checked"; ?>>Other</td>
			</tr> 
		</table>
	</td>

		<td class="fontstyle"><b>No of Emis Paid for oldest loan</b></td>
		<td class="fontstyle">
			<select name="plemi_paid" class="fontstyle">
				<option value="0" <?if($Emi_Paid==0) { echo "selected"; } ?>>Please select</option>
				<option value="1" <?if($Emi_Paid==1) { echo "selected"; } ?>>Less than 6 months</option>
				<option value="2" <?if($Emi_Paid==2) { echo "selected"; } ?>>6 to 9 months</option> 
				<option value="3" <?if($Emi_Paid==3) { echo "selected"; } ?>>9 to 12 months</option>
				<option value="4" <?if($Emi_Paid==4) { echo "selected"; } ?>>more than 12 months</option> 
			</select>
		</td>
		
	</tr>
	<tr><td class="fontstyle">Amount of EMI Paying</td><td class="fontstyle"><input type="text" name="emi_amt" id="emi_amt" value="<? echo $PL_EMI_Amt;?>"></td><td colspan="2"></td></tr>
<!--</table>
</td></tr>-->
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
<tr><td class="fontstyle"><b>Eligible for Bidders</b></td><?
$BidderID="";
	
	$BiddersChurn="SELECT Bidder_Name,Req_Feedback_Bidder1.BidderID As bid FROM Req_Feedback_Bidder1 LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder1.BidderID and Bidders_List.Reply_Type =1 WHERE AllRequestID = '".$post."' AND Req_Feedback_Bidder1.Reply_Type =1";
	//echo $BiddersChurn;
	$BiddersChurnSql = ExecQuery($BiddersChurn);
	$NumRowBiddersChurnSql = mysql_num_rows($BiddersChurnSql);
	while($newrow=mysql_fetch_array($BiddersChurnSql))
				{
			$BidderID[]=$newrow["Bidder_Name"]."(".$newrow["bid"].")";
			
				}
			
?>
	<td class="fontstyle" colspan="2"><? echo implode(',', $BidderID); ?></td>
			
</tr>

<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>


<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle"><select name="plfeedback" id="feedback">
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

 <?php 
		if($City=='Delhi' || $City=='Noida'  ||  $City=='Gurgaon'  ||  $City=='Faridabad'  ||  $City=='Gaziabad'  ||  $City_Other=='Faridabad'  ||  $City_Other=='Greater Noida'  ||  $City=='Chennai'  ||  $City=='Mumbai'  ||  $City=='Thane'  ||  $City=='Navi mumbai'  ||  $City=='Kolkata'  ||  $City=='Kolkota'  ||  $City=='Hyderabad'  ||  $City=='Pune'  || $City=='Bangalore')
{?>
		<tr>	<td colspan="4" class="formtxt"><input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1"<? if($Accidental_Insurance==1) echo "checked";?> >&nbsp; Get free personal accident insurance from TATA AIG</td></tr>
<?} 
  
		   
 ?>

 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>

</table>
</form>
</body>
</html>