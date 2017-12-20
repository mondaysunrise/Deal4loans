<?php
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/db_init_bima.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPL.php';
require 'scripts/personal_loan_eligibility_function_lms.php';
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
		$plrequestid= $_POST['plrequestid'];
		$producttype=1;
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
		$plCompany_Type = $_REQUEST['plCompany_Type'];
		
		$Bidder_Id = $_REQUEST['BidderId'];
		$pladd_comment= $_REQUEST['pladd_comment'];
		$Primary_Acc= $_REQUEST['Primary_Acc'];
		$acc_no = $_REQUEST["acc_no"];
		$want_home_loan = $_REQUEST["want_home_loan"];

	
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
	}
	else 
	{
		$Allocated=0;
	}
	
		
	if(strlen($Final_Bid)>0)
	{
	$updatelead="Update Req_Loan_Personal set Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection',Bidderid_Details='$Final_Bid',Add_Comment='$pladd_comment',Dated=Now(), Allocated='$Allocated',Primary_Acc='$Primary_Acc',Direct_Allocation=0,ex_source='below60k' where RequestID=".$post;
	
	}
	else
	{
	$updatelead="Update Req_Loan_Personal set Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Primary_Acc='$Primary_Acc', Tataaig_Home='$tataaig_home',Accidental_Insurance='$Accidental_Insurance', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Add_Comment='$pladd_comment',Direct_Allocation=0,ex_source='below60k' where RequestID=".$post;
	}
		//echo "query".$updatelead;
	 $updateleadresult=d4l_ExecQuery($updatelead);


	 if(strlen($plfeedback)>0)
	{
		if($plfeedback=="Not Contactable" || $plfeedback=="Ringing" || $plfeedback=="Wrong Number")
		{
			$counter="1";
		}
		else
		{
			$counter="";
		}

		$strSQL="";
		$Msg="";
		$result = d4l_ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=1");		
		
		$num_rows = d4l_mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = d4l_mysql_fetch_array($result);
			$notcontactableCounter=$row["not_contactable_counter"];
		if($plfeedback=="Not Contactable" || $plfeedback=="Ringing" || $plfeedback=="Wrong Number" )
			{
				$updatedcounter=$notcontactableCounter+1;
			}
			else
			{
				$updatedcounter=$notcontactableCounter;
			}
			$strSQL="Update Req_Feedback_PL Set Feedback='".$plfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
			
				$product="Personal Loan";	
				$feedback=$plfeedback;
					include "scripts/feedbackmailerscript.php";

$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testing4use@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
					if(((($feedback=="Not Contactable" || $feedback=="Ringing" || $feedback=="Wrong Number" ) && ($notcontactableCounter<1)) || ($feedback=="Not Interested") || ($feedback=="Not Eligible")) && (strlen($plemail)>0))
					{
						
						mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
					}
			

		}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",1,'".$plfeedback."','".$FollowupDate."','".$counter."')";

			$product="Personal Loan";	
		$feedback=$plfeedback;
					include "scripts/feedbackmailerscript.php";

$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testing4use@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	

					if((($feedback=="Not Contactable" || $feedback=="Ringing" || $feedback=="Wrong Number" ) || ($feedback=="Not Interested") || ($feedback=="Not Eligible")) && (strlen($plemail)>0))
					{
						echo "hello2"."<br>";
						mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
					}
		}

		//echo $strSQL;
		$result = d4l_ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}

	}
if($want_home_loan==1)
	{
	
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			 $getdetails="select RequestID,Updated_Date From Req_Loan_Home  Where (Mobile_Number='".$plmobile."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			$checkavailability = d4l_ExecQuery($getdetails);
			$alreadyExist = d4l_mysql_num_rows($checkavailability);
			$myrow = d4l_mysql_fetch_array($checkavailability);
		
			if($alreadyExist>0)
			{
				echo "<b>Lead Already Exist in Home Loan, Applied Date.".$myrow['Updated_Date']."</b>";
			}
			else
			{
				
				$CheckSql = "select UserID from wUsers where Email = '".$plemail."'";
			$CheckQuery = d4l_ExecQuery($CheckSql);
			$CheckNumRows = d4l_mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = d4l_mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, Updated_Date, Company_Name, Employment_Status, Pincode ) VALUES ( '$UserID', '$plname', '$plemail', '$plcity', '$plcity_other', '$plmobile', '$plnet_salary', '$plloan_amount', Now(), 'PL_LMS', Now(),'".$plcompany_name."','".$plemployment_status."','".$plpincode."')"; 
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$plemail', '$plname', '$plmobile', Now(), '$IsPublic')";			
				$InsertwUsersQuery = d4l_ExecQuery($InsertwUsersSql);
				$UserID = d4l_mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, Updated_Date, Company_Name, Employment_Status, Pincode) VALUES ( '$UserID', '$plname', '$plemail', '$plcity', '$plcity_other', '$plmobile', '$plnet_salary', '$plloan_amount', Now(), 'PL_LMS', Now(),'".$plcompany_name."','".$plemployment_status."','".$plpincode."')";
			}
				$InsertProductQuery = d4l_ExecQuery($InsertProductSql);
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


$viewqry="select Company_Type,PL_Bank,PL_Tenure,Name,Tataaig_Home,Tataaig_Health,Tataaig_Auto,Accidental_Insurance,Add_Comment,Mobile_Number,Landline,Landline_O,Std_Code,Std_Code_O,Net_Salary,Residential_Status,City,City_Other,Is_Valid,Dated,Employment_Status,Loan_Amount,Email,Contactable,source,Loan_Any,Pincode,SentEmail,Emi_Paid,CC_Holder,Card_Vintage,Followup_Date,Feedback,CC_Mailer,Company_Name,PL_EMI_Amt,Card_Limit,Salary_Drawn,Landline_Connection,Mobile_Connection,Total_Experience,Years_In_Company,DOB,Bidderid_Details,checked_bidders,Primary_Acc,Referral_Flag from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_PL.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." "; 

//echo "dd".$viewqry;
$viewlead = d4l_ExecQuery($viewqry);
$viewleadscount =d4l_mysql_num_rows($viewlead);
$Name = d4l_mysql_result($viewlead,0,'Name');
$Tataaig_Home=  d4l_mysql_result($viewlead,0,'Tataaig_Home');
$Tataaig_Health=  d4l_mysql_result($viewlead,0,'Tataaig_Health');
$Tataaig_Auto=  d4l_mysql_result($viewlead,0,'Tataaig_Auto');
$Accidental_Insurance = d4l_mysql_result($viewlead,0,'Accidental_Insurance');
$Add_Comment= d4l_mysql_result($viewlead,0,'Add_Comment');
$Mobile = d4l_mysql_result($viewlead,0,'Mobile_Number');
$Landline = d4l_mysql_result($viewlead,0,'Landline');
$Landline_O = d4l_mysql_result($viewlead,0,'Landline_O');
$Std_Code = d4l_mysql_result($viewlead,0,'Std_Code');
$Std_Code_O = d4l_mysql_result($viewlead,0,'Std_Code_O');
$Net_Salary = d4l_mysql_result($viewlead,0,'Net_Salary');
$Residential_Status = d4l_mysql_result($viewlead,0,'Residential_Status');
$City = d4l_mysql_result($viewlead,0,'City');
$City_Other = d4l_mysql_result($viewlead,0,'City_Other');
$Is_Valid = d4l_mysql_result($viewlead,0,'Is_Valid');
$Dated = d4l_mysql_result($viewlead,0,'Dated');
$Employment_Status = d4l_mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = d4l_mysql_result($viewlead,0,'Loan_Amount');
$Email = d4l_mysql_result($viewlead,0,'Email');
$Contactable = d4l_mysql_result($viewlead,0,'Contactable');
$source = d4l_mysql_result($viewlead,0,'source');
$Loan_Any = d4l_mysql_result($viewlead,0,'Loan_Any');
$Pincode = d4l_mysql_result($viewlead,0,'Pincode');
$SentEmail = d4l_mysql_result($viewlead,0,'SentEmail');
$Emi_Paid = d4l_mysql_result($viewlead,0,'Emi_Paid');
$CC_Holder = d4l_mysql_result($viewlead,0,'CC_Holder');
$Card_Vintage = d4l_mysql_result($viewlead,0,'Card_Vintage');
$followup_date = d4l_mysql_result($viewlead,0,'Followup_Date');
$Feedback = d4l_mysql_result($viewlead,0,'Feedback');
$CC_Mailer = d4l_mysql_result($viewlead,0,'CC_Mailer');
$Company_Name = d4l_mysql_result($viewlead,0,'Company_Name');
$PL_EMI_Amt = d4l_mysql_result($viewlead,0,'PL_EMI_Amt');
$Card_Limit = d4l_mysql_result($viewlead,0,'Card_Limit');
$Salary_Drawn = d4l_mysql_result($viewlead,0,'Salary_Drawn');
$Landline_Connection = d4l_mysql_result($viewlead,0,'Landline_Connection');
$Mobile_Connection = d4l_mysql_result($viewlead,0,'Mobile_Connection');
$Total_Experience = d4l_mysql_result($viewlead,0,'Total_Experience');
$Years_In_Company = d4l_mysql_result($viewlead,0,'Years_In_Company');
$DOB = d4l_mysql_result($viewlead,0,'DOB');
$PL_Tenure  = d4l_mysql_result($viewlead,0,'PL_Tenure');
$Bidderid_Details = d4l_mysql_result($viewlead,0,'Bidderid_Details');
$checked_bidders = d4l_mysql_result($viewlead,0,'checked_bidders');
$Primary_Acc = d4l_mysql_result($viewlead,0,'Primary_Acc');
$Referral_Flag = d4l_mysql_result($viewlead,0,'Referral_Flag');
$Company_Type = d4l_mysql_result($viewlead,0,'Company_Type');
$checked_bidders = explode(",",$checked_bidders);
$Loan_Any = substr($Loan_Any, 0, strlen($Loan_Any)-1); 
$getDOB =DetermineAgeGETDOB($DOB);
$PL_Bank = d4l_mysql_result($viewlead,0,'PL_Bank');
	
$getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered, ingvyasya, bajajfinserv from pl_company_list where ((company_name="'.$company.'") or (company_name="'.$Company_Name.'"))';
//$getcompany."<br>";
$getcompanyresult = d4l_ExecQuery($getcompany);
$grow=d4l_mysql_fetch_array($getcompanyresult);
$recordcount = d4l_mysql_num_rows($getcompanyresult);
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$bajajfinservcategory= $grow["bajajfinserv"];
$citicategorycmp= $grow["citibank"];
if($Primary_Acc=="Citibank" || $Primary_Acc=="citibank" || $Primary_Acc=="Citi Bank")
{
	$citicategory= "Done";
	$citicategorybk= "Done";
}
else
{
	$citicategory= $grow["citibank"];
	
}
//echo $citicategory."<br>";
$barclayscategory= $grow["barclays"];
if($Primary_Acc=="Standard Chartered" || $Primary_Acc=="StandardChartered" || $Primary_Acc=="standard chartered" || $Primary_Acc=="scb")
{
	$standard_charteredcategory= "Done";
}
else
{
$standard_charteredcategory = $grow["standard_chartered"];
}

$ingvyasyacategory = $grow["ingvyasya"];

$monthsalary = $Net_Salary/12;

if($Bidder_Count!=0)
{
	$strbidderid="";
	$z=0;
$retrieve_query="select BidderID from Req_Feedback_Bidder1 where AllRequestID=".$post." and Reply_Type=1";
//echo $retrieve_query."<br>";
	$retrieve_result = d4l_ExecQuery($retrieve_query);
	$retrieve_recordcount =d4l_mysql_num_rows($retrieve_result);
	for($r=0;$r<$retrieve_recordcount;$r++)
	{
		$BidderID12 = d4l_mysql_result($retrieve_result,$r,'BidderID');
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
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
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
			<td class="fontstyle"><select size="1" name="plcity" id="plcity"> <?=plgetCityList($City)?></select></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><input type="text" name="plcity_other" id="plcity_other" size="10" value="<?echo $City_Other;?>" ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="plpincode" size="10" value="<?echo $Pincode;?>" ></td>
		<td class="fontstyle"><b>Source</b></td>
		<td><? echo $source; ?></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Residence Status</b></td>
			<td colspan="2" class="fontstyle"><input type="radio" id="plresidential_status" value="1" name="plresidential_status" <?if($Residential_Status==1){ echo "checked";}?> class="NoBrdr" checked> Owned
			 <input type="radio" value="2" name="plresidential_status" id="plresidential_status" class="NoBrdr" <?if($Residential_Status==2){ echo "checked";}?>> Rented<input type="radio" value="3" name="plresidential_status" id="plresidential_status" class="NoBrdr" <?if($Residential_Status==3){ echo "checked";}?>> Company Provided</td>
			<td>&nbsp;</td>
		</tr>
		
		<? if($Net_Salary<=239000)
	{ ?>
		<tr>
			<td class="fontstyle"><b>Mobile Connection?</b></td>
			<td class="fontstyle"><input type="radio"  value="1"  name="plmobile_connection" id="plmobile_connection" <?if($Mobile_Connection==1){ echo "checked";}?>>Prepaid
			<input size="10" type="radio" name="plmobile_connection" id="plmobile_connection" value="2" <?if($Mobile_Connection==2){ echo "checked";}?>> Postpaid</td>
			<td class="fontstyle" ><b>Do you have landline at your Residence?</b></td>
			<td class="fontstyle"><input type="radio"  value="1"  name="pllandline_connection" id="pllandline_connection" <?if($Landline_Connection==1){ echo "checked";}?>>Yes
			<input size="10" type="radio" name="pllandline_connection" id="pllandline_connection" value="2" <?if($Landline_Connection==2){ echo "checked";}?>>No</td>
		</tr>
		<? }?>
	
		<tr>
			<td class="fontstyle" colspan="2"><b>Salary Account in which bank?</b>			</td>
	<td><select  name="Primary_Acc" id="Primary_Acc"><option value="">Please Select</option> <? $bnknm=d4l_ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
	while($plbnk=d4l_mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($Primary_Acc)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<? }
	?>
<option value="Other" <? if(strtoupper($Primary_Acc)=="OTHER") { echo "Selected";} ?>>Other</option></select>
	<!--<input type="text" size="18"  name="Primary_Acc" id="Primary_Acc" value="<?php //echo $Primary_Acc; ?>">--></td>
	<td>&nbsp;</td></tr>
			
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="BidderId" value="<?echo $bidid;?>"></td></tr>
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="plrequestid" id="plrequestid" value="<?echo $post;?>"></td>
		</tr>
	
<tr>
	
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
	<td class="fontstyle"><input type="text" name="plcompany_name" id="plcompany_name" value="<? echo $Company_Name;?>"></td><td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
	<tr>
<td><b>Account No</b></td>
<td><input type="text" name="acc_no" id="acc_no" value="<? echo $PL_Tenure; ?>"></td>
	<td>Company Type</td><td><select name="plCompany_Type" id="plCompany_Type" style="width: 190px;">
		  <option value="0" <? if($Company_Type==0) {echo "selected";} ?>>Please Select</option>
		  	<option value="1" <? if($Company_Type==1) {echo "selected";} ?>>Pvt Ltd</option>
			<option value="2" <? if($Company_Type==2) {echo "selected";} ?>>MNC Pvt Ltd</option>
			<option value="3" <? if($Company_Type==3) {echo "selected";} ?>>Limited</option>
			<option value="4" <? if($Company_Type==4) {echo "selected";} ?>>Govt.( Central/State )</option>
		<option value="5" <? if($Company_Type==5) {echo "selected";} ?>>PSU (Public sector Undertaking)</option>
			</select></td>
</tr>

	<tr>
		<td class="fontstyle"><b>Total Experience</b></td>
		<td class="fontstyle"><input type="text" name="pltotal_experience" id="pltotal_experience" size="5" value="<?echo $Total_Experience;?>"><b>(years)</b>
		</td>
		<td class="fontstyle"><b>Current experience in company</b></td>
		<td class="fontstyle"><input type="text" name="plyears_in_company" id="plyears_in_company" value="<?echo $Years_In_Company;?>" size="5"><b>(years)</b></td>
	</tr>
	<? if($Net_Salary<=200000)
	{ ?>
	<tr>
	<td class="fontstyle"><b>Salary Drawn?</b></td>
			<td colspan="3" class="fontstyle"><input type="radio"  value="1"  name="Salary_Drawn" id="Salary_Drawn" <?if($Salary_Drawn==1){ echo "checked";}?> >Cash &nbsp;
			<input size="10" type="radio" name="plsalary_drawn" id="plsalary_drawn" value="2" <?if($Salary_Drawn==2){ echo "checked";}?>>Account Transfer<input size="10" type="radio" name="plsalary_drawn" id="plsalary_drawn"  value="3" <?if($Salary_Drawn==3){ echo "checked";}?>>Cheque</td>
		</tr>
		<? } ?>
	
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
<tr><td class="fontstyle"><b>Eligible for Bidders</b></td><? if(strlen($Bidderid_Details)>0){?><td class="fontstyle" colspan="2"> already send</td><? } else {?><td colspan="2"><div id="checkdiv" name="checkdiv"><? list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$post,$City,$Referral_Flag,$source);

//print_r($FinalBidder);
//echo "<br>";
   for($i=0;$i<count($FinalBidder);$i++)
			{
	   if(($FinalBidder[$i]==2490 || $FinalBidder[$i]==2496 || $FinalBidder[$i]==2497 || $FinalBidder[$i]==2498 || $FinalBidder[$i]==2499 || $FinalBidder[$i]==2500) && ($ingvyasyacategory=='') && $Employment_Status ==1 && $Company_Type!=4 && $Company_Type!=5)
	   {
	   
	   }
	   else if((($FinalBidder[$i]==1632 || $FinalBidder[$i]==1633 || $FinalBidder[$i]==1634 || $FinalBidder[$i]==1635 || $FinalBidder[$i]==1636 || $FinalBidder[$i]==1646 || $FinalBidder[$i]==1759  || $FinalBidder[$i]==2020 || $FinalBidder[$i]==2021) && ($standard_charteredcategory=='') && $Employment_Status ==1 && $Net_Salary<600000) || ($FinalBidder[$i]==1760 && $standard_charteredcategory==''))
				{
					
				}
				else if(($FinalBidder[$i]==1053 || $FinalBidder[$i]==1054 || $FinalBidder[$i]==1057 || $FinalBidder[$i]==1058 || $FinalBidder[$i]==1055 || $FinalBidder[$i]==1913 || $FinalBidder[$i]==1056 || $FinalBidder[$i]==1154 || $FinalBidder[$i]==2073 || $FinalBidder[$i]==2072 || $FinalBidder[$i]==1060) && ($citicategory=='') && $Employment_Status ==1)
				{
//echo "hello";
				}
				elseif(($FinalBidder[$i]==2721 || $FinalBidder[$i]==2722 || $FinalBidder[$i]==2723)  && (($citicategorycmp=='' && $Net_Salary>360000) || ($citicategorybk=='' && $Net_Salary<360000)))
				//elseif(($FinalBidder[$i]==2721 || $FinalBidder[$i]==2722 || $FinalBidder[$i]==2723)  && $citicategorycmp=='' )
				{
				}
				elseif(($FinalBidder[$i]==6321 || $FinalBidder[$i]==6322 || $FinalBidder[$i]==6323 || $FinalBidder[$i]==6324 || $FinalBidder[$i]==6325) && ($citicategorycmp==''))
				{
				}
				/*elseif(($FinalBidder[$i]== 2422 || $FinalBidder[$i]== 2423 || $FinalBidder[$i]== 2424 || $FinalBidder[$i]== 2425 || $FinalBidder[$i]== 2426 || $FinalBidder[$i]== 2427 || $FinalBidder[$i]== 2428 || $FinalBidder[$i]== 2429 || $FinalBidder[$i]== 2430 || $FinalBidder[$i]== 2431 || $FinalBidder[$i]== 2432 || $FinalBidder[$i]== 2433 || $FinalBidder[$i]== 2434 || $FinalBidder[$i]== 2435 || $FinalBidder[$i]== 2436 || $FinalBidder[$i]== 2437 || $FinalBidder[$i]== 2438 || $FinalBidder[$i]== 2439 || $FinalBidder[$i]== 2440 || $FinalBidder[$i]== 2441 || $FinalBidder[$i]== 2442 || $FinalBidder[$i]== 2443 || $FinalBidder[$i]== 2444 || $FinalBidder[$i]== 2445 || $FinalBidder[$i]== 2446 || $FinalBidder[$i]== 2447 || $FinalBidder[$i]== 2448 || $FinalBidder[$i]== 2449 || $FinalBidder[$i]== 2450 || $FinalBidder[$i]== 2451 || $FinalBidder[$i]== 2476 ) && ($bajajfinservcategory=='') && ($Employment_Status ==1) )
				{
				
				}*/
				else if ($City=="Chandigarh" && ($Company_Name=="dell international" || $Company_Name=="DELL INTERNATIONAL SERVICE LIMITED/DELL INTERNATIONAL SERVICES INDIA PVT. LIMITED" || (strncmp ("Dell", $Company_Name,4))==0 || (strncmp ("DELL", $Company_Name,4))==0 || (strncmp ("dell", $Company_Name,4))==0) && $FinalBidder[$i]==1887)
				{

				}
				else
				{
		echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
		//echo $FinalBidder[$i];
				}
			}
}
	
		?></div><!--<input type="button" onclick="insertTemp();" value="hello">--></td>
			
</tr>

<tr><td class="fontstyle"><b>Bidders Choosen by Customer</b><td colspan="3">
<?php echo $PL_Bank;
/*for($cb=0;$cb<count($checked_bidders);$cb++)
{
	$getcheckedname=d4l_ExecQuery("select Bidder_Name from Bidders_List where BidderID=".$checked_bidders[$cb]."");

	while($row = d4l_mysql_fetch_array($getcheckedname))
	{
	$getchoosenbidders[]=$row['Bidder_Name'];
	}
	
}
$getchoosenbidders= implode(",",$getchoosenbidders);*/
?>
<? //echo $getchoosenbidders;?></td>
			
</tr>
<tr>
					<td><label for="country">Company Name </label></td>

					<td><input name="company" id="company"   type="text" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="<? echo $Company_Name;?>" size=45/>                                   
					</td>
				</tr>	
<tr><td colspan="4"><table border="1">
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Loan Amount</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Tenure</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Lac)</b></td>
	</tr>

<? for($ij=0;$ij<count($FinalBidder);$ij++)
{
	//echo $finalBidderName[$ij];
	if(($finalBidderName[$ij]=="Stanc" || $finalBidderName[$ij]=="Standard Chartered") && $standard_charteredcategory!='')
	{
		?>
		<tr> <td colspan="5" height="25" align="center" valign="middle"><b style="font-size:12px;">Eligible for Standard Chartered</b></td>
	</tr>

	<? }
		else if($finalBidderName[$ij]=="HDFC" || $finalBidderName[$ij]=="HDFC Bank")
		{
			list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=hdfcbank($monthsalary,$PL_EMI_Amt,$Company_Name,$hdfccategory,$getDOB);
			?>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcgetloanamout; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcinterestrate; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcterm."yrs";?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcgetemicalc; ?></b></td>
	</tr>	
		<?}
		elseif(($finalBidderName[$ij]=="Citibank" || $finalBidderName[$ij]=="Citibank") && $citicategory!='')
		{
			list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=citibank($monthsalary,$PL_EMI_Amt,$Company_Name,$getDOB,$citicategory);
			?>
			<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $citigetloanamout; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $citiinterestrate; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $cititerm; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? $citigetemicalc; ?></b></td>
			</tr>	
		<?
		}
		elseif($finalBidderName[$ij]=="Fullerton" || $finalBidderName[$ij]=="Fullerton" || $finalBidderName[$ij]=="Fullerton (Chattisgarh)")
		{
			list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($monthsalary,$PL_EMI_Amt,$Company_Name,$fullertoncategory,$getDOB,$City);
				?>
			<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetloanamout; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertoninterestrate; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertonterm; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetemicalc; ?></b></td>
			</tr>	
		<?
		}

		elseif($finalBidderName[$ij]=="Barclays Finance" || $finalBidderName[$ij]=="Barclays Finance")
		{
			list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm)=@barclays($monthsalary,$PL_EMI_Amt,$Company_Name,$barclayscategory,$getDOB,$City);
				?>
			<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclaygetloanamout; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclayinterestrate; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclayterm; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclaygetemicalc; ?></b></td>
			</tr>	
		<?
		}
		
		
}?>
</table></td></tr>

<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>


<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle"><select name="plfeedback" id="feedback">
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
	</select>
	</td>
	

	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
<tr>
<td class="fontstyle"><b>Send SMS</b></td>
<td class="fontstyle"><input type="button" name="sms" onClick="window.open('sendsms-email.php?Mobile=<? echo $Mobile;?>&RequestID=<? echo urlencode($post);?>&pro=1')" value="SendSMS"></td>
<td class="fontstyle"><b>Send mailer</b></td>
	<? if(($CC_Mailer != 1) && (strlen(trim($Email))>0)) {?> <td><div id="CCajaxDiv"><input type="button"  value="ccmailer" name="CCmailertype" id="CCmailertype" onClick="insertPLTemp();"></div> <?} else {?><td>&nbsp;</td> <? }?></tr>
	<tr><td colspan="2"><input type="checkbox" name="want_home_loan" id="want_home_loan" value="1" style="border:none;"><b> Want Home Loan</b></td>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $Add_Comment; ?></textarea></td>
	</tr>
<!--</table>
</td></tr>-->
 

 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>
</table>
</form>
</body>
</html>