<?php
require 'scripts/session_check_online.php';

require 'scripts/db_init.php';
require 'scripts/db_init_bima.php';
require 'scripts/functions.php';
require 'eligiblebidderfunc.php';
require 'scripts/home_loan_eligibility_function.php';

	$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$hlname = $_POST["hlname"];
		$fm_subcategory=$_POST['fm_subcategory'];
		$reg_year=$_POST['reg_year'];
		$reg_month=$_POST['reg_month'];
		$tataaig_home=$_POST['Tataaig_Home'];
		$purchase_date=$reg_month."-".$reg_year;
		$tataaig_health=$_POST["Tataaig_Health"];
		$tataaig_auto=$_POST["Tataaig_Auto"];
	$renewal_date= $_POST['renewal_date'];
		$bidderid_details = $_SESSION['bidderid_details'];
		$hlemail = $_POST["hlemail"];
		$hladd_comment = $_POST["hladd_comment"];
		$hlmobile = $_POST["hlmobile"];
		$hlstd_code = $_POST["hlstd_code"];
		$hllandline = $_POST["hllandline"];
		$hlother_city = $_POST["hlother_city"];
		$hldate = $_POST["Dated"];
		$hldob = $_POST["hldob"];
		//$hlcity = $_POST["hllandline"];
		$hlemployment_status = $_POST["hlemployment_status"];
		$hllandline_o = $_POST["hllandline_o"];
		$hlstd_code_o = $_POST["hlstd_code_o"];
		$hlnet_salary = $_POST["hlnet_salary"];
		$hlresiaddress = $_POST["hlresiaddress"];
		$hlpincode = $_POST["hlpincode"];
		$hlloanamt = $_POST["hlloanamt"];
		$hlcity = $_POST["hlcity"];
		$hlloantime = $_POST["hlloantime"];
		$hlbudget = $_POST["hlbudget"];
		$hlproperty_loc = $_POST["hlproperty_loc"];
		$hlproperty_identified = $_POST["hlproperty_identified"];
		$hlfeedback = $_POST["hlfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		$Bidder_Id = $_REQUEST['BidderId'];
		$hlcompany_name = $_REQUEST['hlcompany_name'];
		$selectbidderID=$_REQUEST['selectbidderID'];
$selectbidderID=explode(',',$selectbidderID);
	//	print_r($selectbidderID);
		$realbankID=$_REQUEST['realbankID'];
		$realbankID=explode(',',$realbankID);
		//print_r($realbankID);
		$Accidental_Insurance = $_REQUEST['Accidental_Insurance'];
	$hlProperty_Value = $_REQUEST['hlProperty_Value'];
	$hlTotal_Obligation = $_REQUEST['hlTotal_Obligation'];
	$hlCo_Applicant_Name = $_REQUEST['hlCo_Applicant_Name'];
	$hlCo_Applicant_DOB = $_REQUEST['hlCo_Applicant_Income'];
	$hlCo_Applicant_Income = $_REQUEST[''];
	$hlCo_Applicant_Obligation = $_REQUEST['hlCo_Applicant_Obligation'];
///////Get common bidder NAme//////////////////////////
//echo "<br>";
//print_r($Final_Bidder);
	$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 

$Final_Bid = substr(trim($Final_Bid), 0, strlen(trim($Final_Bid))-1); //remove the final comma sign

///////////////CODE ENDS HERE////////////////
//FOR TATAAIG Auto INSURANCE
if($tataaig_auto==1)
	{
	//echo $tataaig_auto;
		$autostrSQL="";
		$Msg="";
		$autoresult = ExecQuery_bima("select RequestID from Req_Auto_Insurance where Referrer=".$post." AND Crosssell_Product=2");		
		//echo "select RequestID from Req_Auto_Insurance where Referrer=".$post." AND Creative=pl";
		$num_rows = mysql_num_rows($autoresult);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($autoresult);
			$autostrSQL="Update Req_Auto_Insurance Set Phone='".$hlmobile."'";
			$autostrSQL=$autostrSQL."Where Referrer=".$post." and Crosssell_Product=2";
						//echo $autostrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($autostrSQL);
		}
		else
		{
			$autostrSQL="INSERT INTO Req_Auto_Insurance ( Referrer , Creative , `City`, Phone, `Dated` ,DOB,Name,Email,`City_Other`,Source,Pincode,Std_Code,Landline,Renewal_Date,Crosssell_Product,Bidderid_Details,Vehicle_Make, Vehicle_Model,Car_Purchase_Date) VALUES ('".$post."', 'hl','".$hlcity."', '".$hlmobile."' , Now(),'$hldob','$hlname','$hlemail','$hlcity_other','cross-sell','$hlpincode','$hlstd_code','$hllandline','$renewal_date','2','201','$fm_category_id', '$fm_subcategory','$purchase_date')";
			//echo $autostrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($autostrSQL);
			$last_inserted_id = mysql_insert_id();

			$tatafeedback=ExecQuery_bima("INSERT INTO Req_Feedback_Bidder (AllRequestID,BidderID,Reply_Type,Allocated,Allocation_Date) Values ('$last_inserted_id','201','3','1',Now())");
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

//FOR HOME INSURANCE///
if($tataaig_home==1)
	{
		$tatastrSQL="";
		$Msg="";
		$tatatresult = ExecQuery_bima("select RequestID from Req_Home_Insurance where Referrer=".$post." and Crosssell_Product=2");		
		//echo "select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=2";
		$num_rows = mysql_num_rows($tatatresult);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($tatatresult);
			$tatastrSQL="Update Req_Home_Insurance Set Phone='".$hlmobile."'";
			$tatastrSQL=$tatastrSQL."Where Referrer=".$post." and Crosssell_Product=2";
			//echo "update".$tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
		}
		else
		{
			$tatastrSQL="INSERT INTO Req_Home_Insurance ( Referrer , Creative , `City`, Phone, `Dated` ,DOB,Name,Email,`Other_City`,Source,Pincode,Std_Code,Landline,Crosssell_Product,Bidderid_Details) VALUES ('".$post."', 'hl','".$hlcity."', '".$hlmobile."' , Now(),'$hldob','$hlname','$hlemail','$hlcity_other','cross-sell','$hlpincode','$hlstd_code','$hllandline','2','201')";
			//echo "insert".$tatastrSQL."<br><br>";
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
		$tatatresult = ExecQuery_bima("select RequestID from Req_Health_Insurance where Referrer=".$post." and Crosssell_Product=2");		
		//echo "select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=2";
		$num_rows = mysql_num_rows($tatatresult);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($tatatresult);
			$tatastrSQL="Update Req_Health_Insurance Set Phone='".$hlmobile."'";
			$tatastrSQL=$tatastrSQL."Where Referrer=".$post." and Crosssell_Product=2";
			//echo $tatastrSQL."<br><br>";
			$tatatresult = ExecQuery_bima($tatastrSQL);
		}
		else
		{
			$tatastrSQL="INSERT INTO Req_Health_Insurance ( Referrer , Creative , `City`, Phone, `Dated` ,DOB,Name,Email,`Other_City`,Source,Pincode,Std_Code,Landline,CC_Holder,Crosssell_Product,Bidderid_Details, Is_Valid) VALUES ('".$post."', 'hl','".$hlcity."', '".$hlmobile."' , Now(),'$hldob','$hlname','$hlemail','$hlcity_other','cross-sell','$hlpincode','$hlstd_code','$hllandline','$hlcc_holder','2','201','1')";
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
////////////////////////////////////////////////

if($Accidental_Insurance==1)
	{
	$strSQL="";
		$Msg="";
		$result = ExecQuery("select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=2");		
		//echo "select Tataaig_ID from `tataaig_leads` where T_RequestID=".$post." AND T_Product=2";
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update `tataaig_leads` Set Mobile_Number='".$hlmobile."'";
			$strSQL=$strSQL."Where `T_RequestID`=".$post;
		}
		else
		{
			$strSQL="INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, Mobile_Number, `T_Dated` ) VALUES ('".$post."', '2','".$hlcity."', '".$hlmobile."' , Now())";
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



if(strlen($Final_Bid)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}



	if($hlemployment_status =="Salaried")
	{
			$hlemp_stat=1;
	}
	elseif ($hlemployment_status =="Self Employed")
	{
		$hlemp_stat=0;
	}
	else
	{
		$hlemp_stat=0;
	}
		
	//if(strlen($bidderid_details)<=0)
	//{
		if(strlen($Final_Bid)>0)
		{
		$updatelead="Update Req_Loan_Home set Property_Value='$hlProperty_Value',Co_Applicant_Name='$hlCo_Applicant_Name',Co_Applicant_DOB='$hlCo_Applicant_DOB',Co_Applicant_Income='$hlCo_Applicant_Income' ,Co_Applicant_Obligation='$hlCo_Applicant_Obligation',Total_Obligation='$hlTotal_Obligation',Tataaig_Home='$tataaig_home', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',Company_Name='$hlcompany_name', Name='$hlname',Email='$hlemail', Mobile_Number='$hlmobile',Employment_Status='$hlemployment_status', Std_Code='$hlstd_code',Landline='$hllandline',Std_Code_O='$hlstd_code_o',Landline_O='$hllandline_o',City='$hlcity',City_Other='$hlcity_other',Net_Salary='$hlnet_salary',Residence_Address='$hlresiaddress',Pincode='$hlpincode',Property_Identified='$hlproperty_identified',Loan_Time='$hlloantime',Loan_Amount='$hlloanamt',Budget='$hlbudget',Property_Loc='$hlproperty_loc',Bidderid_Details='$Final_Bid',Allocated='$Allocated',DOB='$hldob', Add_Comment='$hladd_comment',Accidental_Insurance='$Accidental_Insurance',City_Other='$hlother_city', Dated=Now() where RequestID=".$post;
		}
		else
		{
			$updatelead="Update Req_Loan_Home set Property_Value='$hlProperty_Value',Co_Applicant_Name='$hlCo_Applicant_Name',Co_Applicant_DOB='$hlCo_Applicant_DOB',Co_Applicant_Income='$hlCo_Applicant_Income' ,Co_Applicant_Obligation='$hlCo_Applicant_Obligation',Total_Obligation='$hlTotal_Obligation',Tataaig_Home='$tataaig_home', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',Company_Name='$hlcompany_name', Name='$hlname',Email='$hlemail', Mobile_Number='$hlmobile',Employment_Status='$hlemployment_status', Std_Code='$hlstd_code',Landline='$hllandline',Std_Code_O='$hlstd_code_o',Landline_O='$hllandline_o',City='$hlcity',City_Other='$hlcity_other',Net_Salary='$hlnet_salary',Residence_Address='$hlresiaddress',Pincode='$hlpincode',Property_Identified='$hlproperty_identified',Loan_Time='$hlloantime',Loan_Amount='$hlloanamt',Budget='$hlbudget',Property_Loc='$hlproperty_loc',DOB='$hldob', Add_Comment='$hladd_comment',Accidental_Insurance='$Accidental_Insurance',City_Other='$hlother_city',Dated=Now()  where RequestID=".$post;
		}
		//echo "query".$updatelead;
		$updateleadresult=ExecQuery($updatelead);
	//}

	 if(strlen($hlfeedback)>0)
	{
		 if($hlfeedback=="Not Contactable")
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
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=2");	
		//echo "select FeedbackID,not_contactable_counter from Req_Feedback where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=2";
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$notcontactableCounter=$row["not_contactable_counter"];
			$updatedcounter=$notcontactableCounter+1;
			$strSQL="Update Req_Feedback Set Feedback='".$hlfeedback."' ,not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];

if($notcontactableCounter<2)
			{
			$product="Home Loan";	
			$feedback=$hlfeedback;
			include "scripts/feedbackmailerscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//echo $Type_Loan;

			if($feedback=="Not Contactable" && (strlen($hlemail)>0))
			{
				mail($hlemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
			}
			}
		}
		else
		{
			$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",2,'".$hlfeedback."','".$FollowupDate."','".$counter."')";
			
			$product="Home Loan";	
			$feedback=$hlfeedback;
			include "scripts/feedbackmailerscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//echo $Type_Loan;

			if($feedback=="Not Contactable" && (strlen($hlemail)>0))
			{
				mail($hlemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
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

		function insertTemp()
		{
			var new_type = document.getElementById('CCmailertype').value;
			var new_request = document.getElementById('hlrequestid').value;
			var new_name = document.getElementById('hlname').value;
			var new_email = document.getElementById('hlemail').value;
			

			if((new_name!=""))
			{

				var queryString = "?Name=" + new_name + "&Email="+ new_email + "&Type=" + new_type + "&Request=" + new_request ;
				//alert(queryString); 
				ajaxRequest.open("GET", "sendHlemail.php" + queryString, true);
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

function insertHLTemp()
		{
			var new_type = document.getElementById('HLmailertype').value;
			var new_request = document.getElementById('hlrequestid').value;
			var new_name = document.getElementById('hlname').value;
			var new_email = document.getElementById('hlemail').value;
			

			if((new_name!=""))
			{

				var queryString = "?Name=" + new_name + "&Email="+ new_email + "&Type=" + new_type + "&Request=" + new_request ;
				//alert(queryString); 
				ajaxRequest.open("GET", "sendHlemail.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('HLajaxDiv');
						ajaxDisplay.innerHTML = "sent";
						
					
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}
	//function OnloadCalls()
	//{
		//ajaxFunction();
		//insertTemp();
		
		
	//}
	//window.onload = OnloadCalls;
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
<p align="center"><b>Home loan Lead Details </b></p>

<?php 


/*$qry="SELECT RequestID from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID AND Req_Feedback.BidderID= '".$bidid."' WHERE  Req_Loan_Home.RequestID > 33792 and ( Req_Loan_Home.Dated Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."')";
		$qry=$qry.$FeedbackClause;
	$qry=$qry."group by Req_Loan_Home.Mobile_Number";
		
	//echo"hello".$search_qry."<br>";
		$changedresult=ExecQuery($qry);
		$recordcount = mysql_num_rows($changedresult);
		for($i=0;$i<$recordcount;$i++)
		{
		$lead = mysql_result($changedresult,$i,'RequestID');
		$leadsid[] =$lead;
		}


$pageNum = $leadsid;
print_r($leadarr);
$CountLead = count($pageNum);
//echo $CountLead;
$i=$post;
$key = array_search($i, $pageNum);
//echo "<br>";
$PreviousValue = $pageNum[$key-1];
$LastValue = $pageNum[$key+1];*/
//echo $key;


$viewqry="select Property_Value,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income ,Co_Applicant_Obligation,Total_Obligation,Req_Loan_Home.checked_bidders,Req_Loan_Home.Tataaig_Home,Req_Loan_Home.Tataaig_Auto,Req_Loan_Home.Tataaig_Health,Req_Loan_Home.Company_Name, Req_Loan_Home.Dated,Req_Loan_Home.Name,Req_Loan_Home.Accidental_Insurance,Req_Loan_Home.source,Req_Loan_Home.Add_Comment,Req_Loan_Home.Landline,Req_Loan_Home.Std_Code,Req_Loan_Home.Residence_Address,Req_Loan_Home.Net_Salary,Req_Loan_Home.Sms_Sent,Req_Loan_Home.Email_Sent,Req_Loan_Home.Landline_O,Req_Loan_Home.Std_Code_O,Req_Loan_Home.Mobile_Number,Req_Loan_Home.Employment_Status,Req_Loan_Home.City,Req_Loan_Home.City_Other,Req_Loan_Home.Loan_Amount,Req_Loan_Home.Email,Req_Loan_Home.DOB,Req_Loan_Home.Budget,Req_Loan_Home.Property_Loc,Req_Loan_Home.Pincode,Req_Loan_Home.Loan_Time,Req_Loan_Home.Hl_mailer,Req_Loan_Home.Property_Identified,Req_Feedback.Feedback,Req_Feedback.BidderID,Req_Feedback.Followup_Date,Req_Loan_Home.Bidderid_Details from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback.BidderID= '".$bidid."' where Req_Loan_Home.RequestID=".$post." "; 

//echo "dd".$qry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
$Tataaig_Home=  mysql_result($viewlead,0,'Tataaig_Home');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$Hl_mailer = mysql_result($viewlead,0,'Hl_mailer');
$Dated = mysql_result($viewlead,0,'Dated');
$Tataaig_Health=  mysql_result($viewlead,0,'Tataaig_Health');
$Tataaig_Auto=  mysql_result($viewlead,0,'Tataaig_Auto');
$Mobile = mysql_result($viewlead,0,'Mobile_Number');
$Landline = mysql_result($viewlead,0,'Landline');
$Landline_O = mysql_result($viewlead,0,'Landline_O');
$Std_Code = mysql_result($viewlead,0,'Std_Code');
$Std_Code_O = mysql_result($viewlead,0,'Std_Code_O');
$Net_Salary = mysql_result($viewlead,0,'Net_Salary');
$Residence_Address = mysql_result($viewlead,0,'Residence_Address');
$City = mysql_result($viewlead,0,'City');
$City_Other = mysql_result($viewlead,0,'City_Other');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
$Email = mysql_result($viewlead,0,'Email');
$source = mysql_result($viewlead,0,'source');
$add_comment = mysql_result($viewlead,0,'Add_Comment');
$Pincode = mysql_result($viewlead,0,'Pincode');
$Property_Loc = mysql_result($viewlead,0,'Property_Loc');
$Loan_Time = mysql_result($viewlead,0,'Loan_Time');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$Feedback = mysql_result($viewlead,0,'Feedback');
$Email_Sent = mysql_result($viewlead,0,'Email_Sent');
$Sms_Sent = mysql_result($viewlead,0,'Sms_Sent');
$Budget = mysql_result($viewlead,0,'Budget'); 
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
$Property_Identified = mysql_result($viewlead,0,'Property_Identified');
$DOB = @mysql_result($viewlead,0,'DOB');
$Accidental_Insurance = @mysql_result($viewlead,0,'Accidental_Insurance');
$checked_bidders = @mysql_result($viewlead,0,'checked_bidders');
$checked_bidders = explode(",",$checked_bidders);
$Property_Value = mysql_result($viewlead,0,'Property_Value');
$Co_Applicant_Name = @mysql_result($viewlead,0,'Co_Applicant_Name');
$Co_Applicant_DOB = @mysql_result($viewlead,0,'Co_Applicant_DOB');
$Co_Applicant_Income = @mysql_result($viewlead,0,'Co_Applicant_Income');
$Co_Applicant_Obligation = @mysql_result($viewlead,0,'Co_Applicant_Obligation');
$Total_Obligation = @mysql_result($viewlead,0,'Total_Obligation');

 ?>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<input type="hidden" name="bidderid_details" value="<?echo $Bidderid_Details;?>">
<input type="hidden" name="BidderId" value="<?echo $bidid;?>">
<input type="hidden" name="hlrequestid" id="hlrequestid" value="<?echo $post;?>">
<input type="hidden" name="Dated" value="<?echo $Dated;?>">
<table style='border:1px dotted #9C9A9C;'width="600" height="80%" align="center" >
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr><tr>	<td ><b>Name</b>
	</td>
	<td ><input type="text" name="hlname" id="hlname" value="<?echo $Name;?>"> </td>
	
<td ><b>Email id</b></td>
	<td ><input type="text" name="hlemail" id="hlemail" value="<?echo $Email;?>"></td>
	</tr>
<tr>
	<td width="25%"><b>Mobile</b></td>
	<td width="25%">+91<input type="text" name="hlmobile" size="15" value="<?echo $Mobile;?>"></td>
	<td ><b>DOB </b></td>
	<td ><input type="text" name="hldob" id="hldob" value="<?echo $DOB;?>">(yyyy-mm-dd)</td>
</tr>
<tr>
	<td><b>Residence No.</b></td>
	<td><input type="text" name="hlstd_code" size="2" value="<? echo $Std_Code;?>" >-<input type="text" name="hllandline" size="10" value="<?echo $Landline;?>"></td>
	
	<td ><b>Office No.</b></td>
	<td ><input type="text" name="hlstd_code_o"  size="2" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="hllandline_o" size="10" value="<?echo $Landline_O;?>"></td>
  </tr>
<tr>
	<td ><b>City</b></td>
	<td><!--<input type="text" name="hlcity" id="hlcity" value="<?echo $City;?>"></textarea>--><select size="1" name="hlcity" > <?=getCityList($City)?></select></td>
	<td ><b>Pincode</b></td>
	<td ><input type="text" name="hlpincode" size="10" value="<?echo $Pincode;?>" id="hlpincode"></td>
</tr>
<tr>
	<td ><b>Residence Address</b></td>
	<td  ><textarea  name="hlresiaddress" rows="2" cols="18"><?echo $Residence_Address;?></textarea></td>
	<td ><b>Other City</b></td>
	<td><!--<input type="text" name="hlcity" id="hlcity" value="<?echo $City;?>"></textarea>--><input type="text" name="hlother_city" id="hlother_city" value="<? echo $City_Other;?>"> </td>
</tr>
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Employment Details</b></td></tr>
<tr>
	<td><b>Employment Status</b></td>
	<td><select name="hlemployment_status" id="hlemployment_status">
		<option value="1" <?if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
		<option value="0" <?if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>
	</td>

	<td ><b>Annual Income</b></td>
	<td><input type="text" name="hlnet_salary" id="hlnet_salary" value="<?echo $Net_Salary;?>"  onKeyUp="getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" onKeyPress=" getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('hlnet_salary','formatedIncome','wordIncome');"></td>
</tr>
<tr><td><b>Company Name</b></td><td><input type="text" name="hlcompany_name" id="hlcompany_name" value="<? echo $Company_Name?>"></td><td colspan="2"></td></tr>
<tr>
<td colspan="2">&nbsp;</td>
	<td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Other Details</b></td></tr>
<tr>
	<td><b>Loan Amount</b></td>
	<td><input type="text" name="hlloanamt" id="hlloanamt" value="<?echo $Loan_Amount;?>" onKeyUp="getDigitToWords('hlloanamt','formatedloan','wordloan');" onKeyPress="getDigitToWords('hlloanamt','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('hlloanamt','formatedloan','wordloan');"></td>
<td ><b>Loan Time</b></td>
	<td ><select name="hlloantime" >
	<option value="-1" <? if (($Loan_Time==-1) || ($Loan_Time=="")) { echo "selected";}?>>Please select</option>
    	<OPTION value="15 days" <?if($Loan_Time =="15 days"){echo "selected"; }?>>15 days</OPTION>
	<OPTION value="1 month" <?if($Loan_Time =="1 month"){echo "selected"; }?>>1 months</OPTION>
	<OPTION value="2 months" <?if($Loan_Time =="2 months"){echo "selected"; }?>>2 months</OPTION>
	<OPTION value="3 months" <?if($Loan_Time =="3 months"){echo "selected"; }?>>3 months</OPTION>
	<OPTION value="3 months above" <?if($Loan_Time =="3 months above"){echo "selected"; }?>>more than 3 months</OPTION>
	</SELECT>
	</td>
	
</tr>
<tr>

	<td colspan="2" ><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td><b>Property Identified</b></td>

	<td ><input type="radio" name="hlproperty_identified" <?if($Property_Identified==1){ echo "checked";}?> value="1">Yes<input type="radio" name="hlproperty_identified" <?if($Property_Identified==0){echo "checked";}?> value="0">No</td>
	<td><b>Property Location</b></td>
	<td ><input type="text" name="hlproperty_loc" value="<?echo  $Property_Loc;?>"></td>
</tr>

<tr>
	<td><b>Property Value</b></td>
<td><input type="text" name="hlProperty_Value" id="hlProperty_Value" value="<? echo $Property_Value; ?>"></td>
	<td><b>Total Obligation</b></td>
<td><input type="text" name="hlTotal_Obligation" id="hlTotal_Obligation" value="<? echo $Total_Obligation; ?>"></td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Co applicant Details</b></td></tr>
	<tr>
	<td><b>Co Applicant Name:</b></td>
<td><input type="text" name="hlCo_Applicant_Name" id="hlCo_Applicant_Name" value="<? echo $Co_Applicant_Name; ?>"></td>
	<td ><b>Co-Applicant DOB</b></td><td><input type="text" name="hlCo_Applicant_DOB" id="hlCo_Applicant_DOB" value="<? echo $Co_Applicant_DOB; ?>"></td>
</tr>
<tr>
	<td><b>Co Monthly Income:</b></td>
<td><input type="text" name="hlCo_Applicant_Income" id="hlCo_Applicant_Income" value="<? echo $Co_Applicant_Income; ?>"></td>
	<td ><b>Co Applicant Obligation</b></td><td><input type="text" name="hlCo_Applicant_Obligation" id="hlCo_Applicant_Obligation" value="<? echo $Co_Applicant_Obligation; ?>"></td>
</tr>
<!--<tr>
	<td ><b>Budget</b></td>
	<td>
	<select name="hlbudget" >
	<option value="-1" <? //if (($Budget==-1) || ($Budget=="")) { echo "selected";}?>>Please select</option>
	<option value="Upto 7 Lakhs" <?if($Budget =="Upto 7 Lakhs"){echo "selected"; }?>>Upto 7 Lakhs </option>
	<option value="7-15 Lakhs"  <?if($Budget =="7-15 Lakhs"){echo "selected"; }?>>7-15 Lakhs </option>
	<option value="15-20 Lakhs"  <?if($Budget =="15-20 Lakhs"){echo "selected"; }?>>15-20 Lakhs </option>
	<option value="20-25 Lakhs"  <?if($Budget =="20-25 Lakhs"){echo "selected"; }?>>20-25 Lakhs </option>
	<option value="Above 25 Lakhs"  <?if($Budget =="Above 25 Lakhs"){echo "selected"; }?>>Above 25 Lakhs</option></SELECT>

	</td>
	<td colspan="2">&nbsp;</td>
</tr>-->
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Bidder Details</b></td></tr>
<? if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}
//echo $City;?>
<tr><td><b>Eligible for Bidders</b></td><? if(strlen($Bidderid_Details)>0){?><td> already send</td><? } else {?><td id="check"><? list($FinalBidder,$finalBidderName)= geteligibleBiddersList("Req_Loan_Home",$post,$City);
   for($i=0;$i<count($FinalBidder);$i++)
			{
		echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].") ";
		//echo $FinalBidder[$i];
			}
}
	
		?></td></tr>
		<tr><td class="fontstyle"><b>Bidders Choosen by Customer</b><td colspan="3">
<?php
for($cb=0;$cb<count($checked_bidders);$cb++)
{
	$getcheckedname=ExecQuery("select Bidder_Name from Bidders_List where BidderID=".$checked_bidders[$cb]." and Reply_Type=2");

	while($row = mysql_fetch_array($getcheckedname))
	{
	$getchoosenbidders[]=$row['Bidder_Name'];
	}
	
}
$getchoosenbidders= implode(",",$getchoosenbidders);

?>
<? echo $getchoosenbidders;?></td>
			
</tr>
<tr><td colspan="4">
<? for($ij=0;$ij<count($getchoosenbidders);$ij++)
{
		if($getchoosenbidders=="HDFC")
		{
			list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm)=HDFC_Homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);
		?>
		  
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo "8.25%(Fixed for 2 yrs)".abs($hdfcinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $hdfcemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($hdfcprint_term); ?> yrs.</b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($hdfcviewLoanAmt); ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  $hdfcperlacemifortwo."(Fixed For 2 yrs)".abs($hdfcperlacemi); ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
   $hdfcinterestfortwoyr= (($perlacemifortwo * 24));
   $remingterm=$hdfcterm - 24;
   $hdfcgetinterestamt=(($hdfcactualemi * $remingterm)); 
   $hdfctotalinterestamt= (($hdfcinterestfortwoyr + $hdfcgetinterestamt) - $hdfcloan_amount);
   echo abs($hdfctotalinterestamt); ?></td>
		}
		elseif($getchoosenbidders=="ICICI")
		{
		list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm)=ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value); 
			?>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><? echo "8.25% (for first 2 yrs)".abs($iciciinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs <? echo $iciciemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($iciciprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $perlacemifortwo." (for first 2 yrs)".abs($iciciperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php  $iciciinterestfortwoyr= (($perlacemifortwo * 24) );
							   $remingterm=$iciciterm - 24;
						     $icicigetinterestamt=(($iciciactualemi * $remingterm));
						  $icicitotalinterestamt= (($iciciinterestfortwoyr + $icicigetinterestamt) - $iciciviewLoanAmt);
							 echo abs($icicitotalinterestamt)."<br>"; ?></td>
		}
		elseif($getchoosenbidders=="Lic Housing")
		{
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);
	?>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($licinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $licemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($licprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($licviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($licperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php $licgetinterestamt=(($licemi * $licterm)); echo $licgetinterestamt; ?></td>
		}
		elseif($getchoosenbidders=="IDBI")
		{
			list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm)=IDBI_Homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);
		?>
		 
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo "8.25%(Fixed for 2 yrs)".abs($idbiinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $idbiemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($idbiprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  $idbiperlacemifortwo."(Fixed For 2 yrs)".abs($idbiperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
							   
							   $idbiinterestfortwoyr= ($idbiperlacemifortwo * 24);
							   $remingterm=$idbiterm - 24;
						   $idbigetinterestamt=($idbiactualemi * $remingterm); 
						   $idbitotalinterestamt= ( ($idbiinterestfortwoyr + $idbigetinterestamt) - $idbiviewLoanAmt);
						   echo abs($idbitotalinterestamt); ?></td>
		}
} 
?>

</td></tr>
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Add Feedback</b></td></tr>
<tr>
	<td><b>Feedback</b></td>
	<td><select name="hlfeedback" id="feedback">
		<option value="No Feedback" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>

	<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
	</select>
	</td>
	

	<td><b>Follow Up Date</b></td>
	<td><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
	
</tr>
<tr><td><b>Send SMS</b></td>
<td colspan="2"><input type="button" name="sms" onClick="window.open('sendsms-email.php?Mobile=<? echo $Mobile;?>&RequestID=<? echo urlencode($post);?>&pro=2')" value="SendSMS"></td></tr>
<tr>
<td><b>Send CCmailer</b></td>
	<? if(($Email_Sent != 1) && (strlen(trim($Email))>0)) {?> <td><div id="CCajaxDiv"><input type="button"  value="ccmailer" name="CCmailertype" id="CCmailertype" onClick="insertTemp();"></div> <?} else {?><td>&nbsp;</td> <? }?></tr>
<tr>
<td><b>Send HLmailer</b></td>
	<? if(($Hl_mailer != 1) && (strlen(trim($Hl_mailer))>0)) {?> <td><div id="HLajaxDiv"><input type="button" value="hlmailer" name="HLmailertype" id="HLmailertype" onClick="insertHLTemp();"></div> <?} else {?><td>&nbsp;</td> <? }?></tr>

	<tr><td><b>Source</b></td>
		<td><? echo $source; ?></td>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="hladd_comment" id="hladd_comment" ><? echo $add_comment; ?></textarea></td>
	</tr>
 <?php 
		if($City=='Delhi' || $City=='Noida'  ||  $City=='Gurgaon'  ||  $City=='Faridabad'  ||  $City=='Gaziabad'  ||  $City_Other=='Faridabad'  ||  $City_Other=='Greater Noida'  ||  $City=='Chennai'  ||  $City=='Mumbai'  ||  $City=='Thane'  ||  $City=='Navi mumbai'  ||  $City=='Kolkata'  ||  $City=='Kolkota'  ||  $City=='Hyderabad'  ||  $City=='Pune'  || $City=='Bangalore')
{?>
		<tr>	<td colspan="4" class="formtxt"><input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1"<? if($Accidental_Insurance==1) echo "checked";?> >&nbsp; Get free personal accident insurance from TATA AIG</td></tr>';
<?} 
 $getvalue=tataaigcity($City);
  
  if(($getvalue=="1") && ($Accidental_Insurance!="1"))  {?>
  <tr>	<td colspan="4" class="formtxt"><input type="checkbox"  class="NoBrdr" name="Tataaig_Health" id="Tataaig_Health" value="1" <? if($Tataaig_Health==1) echo "checked";?> >&nbsp; Health and Accidental Insurance from Tataaig</td></tr>
  <tr>	<td colspan="4" class="formtxt"><input type="checkbox"  class="NoBrdr" name="Tataaig_Home" id="Tataaig_Home" value="1" <? if($Tataaig_Home==1) echo "checked";?> >&nbsp; Home Insurance from Tataaig</td></tr>
   <tr>	<td colspan="4" class="formtxt"><input type="checkbox"  class="NoBrdr" name="Tataaig_Auto" id="Tataaig_Auto" value="1" <? if($Tataaig_Auto==1) echo "checked";?>>&nbsp; Auto Insurance from tataaig</td></tr>
        <? if($Tataaig_Auto!=1) {?>
	 <tr>
       <td class="fontstyle" width="50%">Vehicle Manufacturer</td><td width="50%" class="fontstyle">
        <select name="fm_category_id" id='fm_category_id' onChange="getSubCategory(this.value)" >
   <option value="-1" selected> Please Select </option> 
   <?
		   $query = ExecQuery_bima("SELECT * from fs_category where ParentID='-1' order by Name");
		   $num_rows = mysql_num_rows($query);
		   for($i=0;$i<$num_rows;$i++)
		   {        
				   $id = mysql_result($query,$i,'CategoryID'); 
				$Name = mysql_result($query,$i,'Name'); 
				echo "<option value=".$id.">".$Name."</option>";
					//$selected = ($iPACategoryID == $iCatInfo["CategoryID"])? " Selected":""; 
				   //echo "<option value='$iCatInfo[CategoryID]' $selected>$iCatInfo[Name]</option>\n";
		   } 
   ?>
</select>
</td>
</tr>
		   <tr valign="top"> 
				   <td class="fontstyle">Vehicle Model</td>
				   <td class="fontstyle">
				   <?php
						   $query1 = ExecQuery_bima("SELECT b.ParentID, b.CategoryID as CatID, a.Name as SubCatText, b.Name as CatText  FROM fs_category AS a RIGHT JOIN fs_category AS b ON a.CategoryID = b.ParentID where b.Name Is Null OR a.ParentID='-1' order by b.Position ASC  ");
						   while($iSubCatInfo = mysql_fetch_array($query1)) 
						   {
								   if($iPACategoryID == $iSubCatInfo["CatID"])
								   { 
										   $iParentCat = $iSubCatInfo["ParentID"];
								   }
								   $ParentID[]="'".$iSubCatInfo["ParentID"]."'";                        
								   $CatID[]="'".$iSubCatInfo["CatID"]."'";                        
								   $SubCatText[]="'".$iSubCatInfo["CatText"]."'";                        
						   }
                                       ?>
 
<Script Language="javascript">
		   var parent_id =[<? echo implode(",",$ParentID)?>]; 
		   var cat_id =[<? echo implode(",",$CatID)?>];
		   var subcat_text =[<? echo implode(",",$SubCatText)?>]; 
		   
		   function getSubCategory(ids)
		   {
				   var subcat = document.getElementById("sub_category")
				   for (i = subcat.length - 1; i>=0; i--) subcat.remove(i);
				   for(var i=0;i<parent_id.length;i++){ 
						   if(parent_id[i] == ids){
								   var lcOpObj = document.createElement("OPTION") 
								   lcOpObj.value=subcat_text[i];
								   lcOpObj.text=subcat_text[i];
								   if(document.all) subcat.add(lcOpObj);
								   else subcat.add(lcOpObj,null); 
						   }
				   }
		   }
</Script> 
      
<select name='fm_subcategory' id='sub_category' style='width:120px'>
</select>
      
      </td></tr>

		<tr>
			 <td class="fontstyle">Car Purchase Date</td>
			</td>
			<td> <select  name="reg_month" id="reg_month">
			     <option value="-1">Month</option>
				<option value="JAN">JAN</option>
				<option value="FEB">FEB</option>
				<option value="MAR">MAR</option>
				<option value="APR">APR</option>
				<option value="MAY">MAY</option>
				<option value="JUN">JUN</option>
				<option value="JUL">JUL</option>
				<option value="AUG">AUG</option>
				<option value="SEP">SEP</option>
				<option value="OCT">OCT</option>
				<option value="NOV">NOV</option>
				<option value="DEC">DEC</option>
				</select>
				&nbsp;
				<select name="reg_year" id="reg_year" style="width:60" class="style4">
				  <option value="-1">Year</option>
				  <option value="1990">1990</option>
				<option value="1991">1991</option>
				<option value="1992">1992</option>
				<option value="1993">1993</option>
				<option value="1994">1994</option>
				<option value="1995">1995</option>
				<option value="1996">1996</option>
				<option value="1997">1997</option>
				<option value="1998">1998</option>
				<option value="1999">1999</option>
				<option value="2000">2000</option>
				<option value="2001">2001</option>
				<option value="2002">2002</option>
				<option value="2003">2003</option>
				<option value="2004">2004</option>
				<option value="2005">2005</option>
				<option value="2006">2006</option>
				<option value="2007">2007</option>
				<option value="2007">2008</option>
				</select>
			
				</td>

			</tr>
	 <!------------------------------------------------------------------------------>
    <!--<tr><td colspan="4">Renewal Date <input type='text' name='renewal_date' id='renewal_date' size="10"><a href="javascript:NewCal('renewal_date','yyyymmdd',false,24)"><img src='images/cal.gif' width='16' height='16' border='0' alt='Pick a date'></a></td></tr>-->
	<? }?>
  <? }?>
 
<tr><td colspan="4">&nbsp;</td></tr>
 <tr>

     <td colspan="4" align="center"><br><input type="submit" class="bluebutton" value="Submit"> 
    </td>
  </tr>

</table>
<!--<table width="600" align="center"><tr>
    <td align="center"><?php // if($key>=1 && $key<=($CountLead-1)) { ?><a href="?id=<?echo $PreviousValue;?>&Bid=<? //echo $bidid;?>&to=<? //echo $min_date?>&from=<? //echo $max_date;?>">Back</a><?php //} else echo "First Lead"; ?></td>
    <td align="center"><?php //if($key<=($CountLead-2)) { ?><a href="?id=<?echo $LastValue;?>&Bid=<? //echo $bidid;?>&to=<? //echo $min_date?>&from=<? //echo $max_date;?>">Next</a><?php  //} else echo "Last Lead"; ?></td>
</tr></table>-->
</form>
</body>
</html>