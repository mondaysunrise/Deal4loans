<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_POST);
	if(isset($_POST['submit']) || $_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$source = $_POST['source'];
		$City = $_POST['City'];
		$Type_Loan = "Req_Loan_Home";
		$IP = getenv("REMOTE_ADDR");
		$Employment_Status =1;
		$Net_Salary=650000;
		$dateofbirth="1978-01-01";
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
		$validMobile = is_numeric($Phone);	
		$Existing_Bank= $_POST['Existing_Bank'];
		$Existing_Loan= $_POST['loan_amount'];
		$Existing_ROI= $_POST['roi'];
		$hdfclife = $_POST["hdfclife"];
		$Reference_Code = generateNumber(4);

if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1)
{
  $validname=0;
}
else
{
	$validname=1;
}

if(($validMobile==1) && ($Name!="") && strlen($City)>0 && $validname==1)
{
$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);
			}			
		$ProductValue = Maininsertfunc ("Req_Loan_Home", $dataArray);
		if(strlen($Phone)>1)
		{
			$SMScampMessage = "Please use this code: ".$Reference_Code." to activate your loan request at deal4loans.com";

		if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMScampMessage, $Phone);
		}
			}
		$loan_amount = $_POST['loan_amount'];
		$Interest_Rate = $_POST['roi'];
		$Duration_of_Loan = $_POST['tenure'];
		$emi_paid = $_POST['emi_paid'];
		$pre_payment_charges = $_POST['pre_payment_charges'];		
	}
	}
	else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
?>
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>
<div id="pagewrap">
<header id="header_continue">
<div id="continue_logo"><img src="new-images/pl/deal4loans-continue-logo.jpg"></div></header>
<div style="clear:both;"></div>
<br><br>
<div class="pl_cont_text" style="color:#136071;" align="center">Get comparison on your EMI and Save</span>. Please verify your Mobile Number. <br />
  We have sent an activation code on <span style="color: #D02037;"><? echo $Phone; ?></div>
  <div id="continue_form" style="margin-top:10px;">
 <table width="60%" border="0" align="center" cellpadding="2" cellspacing="0">     
      <tr>
      <td colspan="2" align="center">
      <form name="bnrvalidate" method="POST" action="apply-home-loans-btcampcomtinue.php">
      <input type="hidden" value="<? echo $ProductValue;?>" name="hlrequestid" id="hlrequestid">
       <input type="hidden" value="<? echo $Reference_Code;?>" name="reference_code" id="reference_code">
	   <input type="hidden" value="<? echo $Name; ?>" name="name" id="name">
	   <input type="hidden" value="<? echo $loan_amount; ?>" name="loan_amount" id="loan_amount">
	   <input type="hidden" value="<? echo $Interest_Rate; ?>" name="roi" id="roi">
	   <input type="hidden" value="<? echo $Duration_of_Loan; ?>" name="tenure" id="tenure">
	   <input type="hidden" value="<? echo $emi_paid; ?>" name="emi_paid" id="emi_paid">
	   <input type="hidden" value="<? echo $pre_payment_charges; ?>" name="pre_payment_charges" id="pre_payment_charges">
	   <input type="hidden" value="<? echo $source; ?>" name="source" id="source">
	   <input type="hidden" value="<? echo $City; ?>" name="City" id="City">	  
      <table cellpadding="5">

      <tr>
      	<td height="35">Activation Code</td>
        <td><input type="text" name="activation_code" id="activation_code"></td>
      </tr>
      <tr>
      	<td colspan="2" align="center" height="50"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " tabindex="13" /></td>
      </tr>
      </table>
      </form></td></tr>
  </table>
</div>
</div>
</body>
</html>