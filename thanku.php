<?php

	require 'scripts/session_check.php';

	require 'scripts/db_init.php';

	require 'scripts/functions.php';

	
	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }



	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		//$Name = FixString($Name);
		$PWD1 = FixString($PWD1);
		$FName = FixString($FName);
		$LName = FixString($LName);
		
		$Name=$FName." ".$LName;
		
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		
		$DOB=$Year."-".$Month."-".$Day;
		
		$Phone = FixString($Phone);
		$Std_Code = FixString($Std_Code);
		$Std_Code_O = FixString($Std_Code_O);
		$Landline_O = FixString($Landline_O);
		$Phone1 = FixString($Phone1);
		$Email = FixString($Email);
		$Item_ID = FixString($Item_ID);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		//$Years_In_Company = FixString($Years_In_Company);
		//$Total_Experience = FixString($Total_Experience);
		$Type_Loan = FixString($Type_Loan);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Net_Salary = FixString($IncomeAmount);
		$Marital_Status = FixString($Marital_Status);
		$Net_Salary_Monthly = $Net_Salary / 12;
		//if(!isset($IsPublic))
		   $IsPublic = 1;

		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		/*if($Referrer=="google")
		{
			$source="MT";
		}
		else
		{
			$source="";
		 }*/

		$IP = getenv("REMOTE_ADDR");

		$Creative=$_REQUEST['creative'];
		$Section=$_REQUEST['section'];
		$_SESSION['Temp_Type'] = "PersonalLoan";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_PWD1'] = $PWD1;
		$_SESSION['Temp_FName'] = $FName;
		$_SESSION['Temp_LName'] = $LName;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_Phone1'] = $Phone1;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_Std_Code_O'] = $Std_Code_O;
		$_SESSION['Temp_Std_Code'] = $Std_Code;
		$_SESSION['Temp_Landline_O'] = $Landline_O;
		
		$_SESSION['Temp_Message'] = $Message;
		$_SESSION['Temp_Message1'] = $Message1;
		$_SESSION['Temp_Flag'] = "0";
		$_SESSION['Temp_Email'] = $Email;
		$_SESSION['Temp_Email_New'] = $Email_New;
		$_SESSION['Temp_Net_Salary_Monthly'] = $Net_Salary_Monthly;
		$_SESSION['Temp_Item_ID'] = $Item_ID;
		$_SESSION['Temp_Name_New'] = $Name_New;
		$_SESSION['Temp_Flag_Message'] = "0";
		$_SESSION['Temp_Company_Name'] = $Company_Name;
		$_SESSION['Temp_City'] = $City;
		$_SESSION['Temp_City_Other'] = $City_Other;
		$_SESSION['Temp_Pincode'] = $Pincode;
		$_SESSION['Temp_Contact_Time'] = $Contact_Time;
		//$_SESSION['Temp_Years_In_Company'] = $Years_In_Company;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		//$_SESSION['Temp_Total_Experience'] = $Total_Experience;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		//}
		//$Marital_Status = FixString($Marital_Status);
		//$Residential_Status = FixString($Residential_Status);
		//$Vehicles_Owned = FixString($Vehicles_Owned);
		//$Loan_Any = FixString($Loan_Any);
	//	$EMI_Paid = FixString($EMI_Paid);
		//$CC_Holder = FixString($CC_Holder);
		$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;	
		

		//SQL Query
		if(isset($_SESSION['UserType'])) 
		{
			

		$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB)
			VALUES ( '$UserID', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative' , '$Section', '$IP', '$DOB' )"; 
			
		}
		
		else
			{
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB)
			VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB' )"; 
		}

		$Email = trim($Email);
		$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
		$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
		$msgUserDoesNotExist = "Email does not exists in the database";
		$result = ExecQuery($query);
		$rows = mysql_num_rows($result);		
		echo mysql_error();

		if(isset($_SESSION['UserType']))
				{
			$result = ExecQuery($sql);
			$rows = mysql_num_rows($result);
			getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($FName, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}

			$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "myRequests.php");
			echo $Msg;
			//echo "<script language=javascript>location.href='t_y.php?r_url=myRequests.php'"."</script>";
			echo mysql_error();
				}
		else if ($myrow = mysql_fetch_array($result)) 
		{
			do
			{
				$_SESSION['Temp_UserID'] = $myrow["UserID"];
			}while ($myrow = mysql_fetch_array($result));
			mysql_free_result($result);
			$_SESSION['Temp_Flag'] = "1";

			$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			$res_user=ExecQuery($qry_user);
			$row_user=mysql_fetch_array($res_user);
			$UserID1=$row_user["UserID"];
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB)
			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB')"; 
	
		
			$result = ExecQuery($sql);
			getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($FName, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}
			
			echo "<script language=javascript>location.href='thanku.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";

			//echo "<script language=javascript>location.href='thanku.php'</script>";
		}
		
		else
			{
			$result = ExecQuery($sql);
			getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($FName, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}
			$rows = mysql_num_rows($result);
			$_SESSION['Temp_Flag'] = "0";
			$strDir = dir_name();
				if($Email!="")
				{
					//header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
					echo "<script language=javascript>location.href='thanku.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
					//echo "<script language=javascript>location.href='thanku.php'</script>";
					echo mysql_error();
				}
			}
		echo mysql_error();

		if ($result == 1 && isset($_SESSION['UserType']))
			{
			$Msg = getAlert("Your request has been added. !!", TRUE, "myRequests.php");
			}
    }

	$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}


	$EmailID = $_SESSION['Temp_Email'];

	//$Email_New = $_SESSION['Temp_Email_New'];

	$Name_New = $_SESSION['Temp_Name_New'];

	$Net_Salary_Monthly = $_SESSION['Temp_Net_Salary_Monthly'];

	$Item_ID = $_SESSION['Temp_Item_ID'];

	//$Message1 = $_SESSION['Temp_Message1'];

	$Flag_Message = $_SESSION['Temp_Flag_Message'];

	$Msg = "";

	$UserID_Message = "";
	
	$FName = $_SESSION['Temp_FName'];
	
	$LName = $_SESSION['Temp_LName'];
	
	$DOB = $_SESSION['Temp_DOB'];
	
	$PWD1 = $_SESSION['Temp_PWD1'];
	
	$Phone = $_SESSION['Temp_Phone'];

	$IsPublic = $_SESSION['Temp_IsPublic'];

	//Query to check if user exists

	$result = ExecQuery("select IsPublic from wUsers where Email='$EmailID' ");

	echo mysql_error();

	$num_rows = mysql_num_rows($result);



	if($num_rows > 0)
	{
		mysql_free_result($result);
		$Msg = "** User with this email id already exists. !! ";
	}
	else
	{
		$sql = "INSERT INTO wUsers (Email,FName,LName,PWD,Phone,DOB,Join_Date,Last_Login,Count_Requests,IsPublic) VALUES ('$EmailID','$FName','$LName','$PWD1','$Phone','$DOB',Now(),Now(),0,'$IsPublic')";
		$result = mysql_query($sql);
		if ($result == 1)
		{
			$SMSMessage = "Dear $FName, Thank you for Registering with deal4loans. Your registration details are as follows: EmailID: $EmailID. Password: $PWD1";
			if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
		if($Type_Loan=="Req_Loan_Personal")
			{
				$Message2="<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $FName,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>We thank you for registering on www.deal4loans.com.<br>Your registration details are as follows:<p>Your Email ID: $EmailID<br>Your Password: $PWD1<p>We are committed towards providing you with a platform to - compare and choose the best deal from our participating banks.</p><p>Do read the attached note on Personal Loans- it might help you in your loan seeking process.<br><br>Need Cash? is the how banks typically sell Personal Loans - a product that you should opt during times of any cash crunch.A personal loan is an unsecured loan so it means that the bank assumes that they are taking a high risk in giving out such loans.</p><p>The applicable rates can vary from 14% to 40% depending on the individual profile.All banks have their own criteria of assesing an applicant's profile but the basic parameters are:</p><ul><li>      Your Salary/Income-Tax-Returns.</li><li>       Company/Business profile.</li><li>    Total work experience/current work experience.</li><li>       Your residential Address/status.</li><li>       Your credit/default profile.</li></ul><p>Generally the rate applicable to an applicant decreases with increasing salary. The bank sees a higher capability at your end to repay a loan, hence a lower perceived risk.</p><p>If you work in large company banks are ok with lower rates. Call centres/BPOs are not treated at par with other profiles as they tend to have high attrition rates. Banks generally want an applicant who has a stable job and hence check the current and total work experience. So if you have been working in one company for last 5 years a bank is more willing to lend a loan to you.</p><p>Residential status : If you own a house thats a perfect situation for bank to lend. But even if you have taken an accommodation on rent so long as the lease documents are in place, there should be no problems.</p><p>Past Credit Profile: Banks verify whether you have defaulted any of your previous loan repayments. This is done against both internal systems and third party systems like Cibil/Satyam .So now its really  tough to have bad debts with one bank and take loan from other banks.</p><p>Generally banks check these things before giving loans. In simple terms they check your ability to pay and gauge your intention to pay. So when you negiotiate with bank remember what are your advantages and disadvantages and bargain with them on those terms. </p><p>As a customer you should avoid doing the following while applying for a loan:</p><ul><li>   Incorrect address on application form.</li><li>   Not disclosing earlier loans. </li><li>   Cheque bounces in your bank accounts as this affects your credit record</li></ul><p>Hope this has helped you understand the Personal Loan product better. <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php'>Know More</a>...</p><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></font></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
		}
		else {

				$Message2= "<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $FName,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>Thank you for Registering with deal4loans. Your one stop solution for all your loan and insurance deals. Your registration details are as follows:<p>Your Email ID: $EmailID<br>Your Password: $PWD1<p>You will receive various deals from banks and insurance companies both at your EMAIL ID and you can also SIGN IN at our site to view various offers.<br><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></font></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";

		}

/*
				$headers  = 'MIME-Version: 1.0' . "\r\n";

				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$headers .= 'To: '.$fname.' <'.$EmailID.'>' . "\r\n";

				$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				mail($EmailID,'Welcome to Deal4loans - '.$fname, $Message2, $headers);

		}
		if ($Flag_Message == 1)
		{
			$sqltest = ExecQuery("Select RequestID from Req_Loan_Personal order by RequestID desc limit 1");
			echo mysql_error();
			if ($myrow = mysql_fetch_array($sqltest)) 
			{
				$Item_ID = $myrow["RequestID"];
			}
			mysql_free_result($sqltest);
			$sqltest1 = ExecQuery("Select UserID from wUsers order by UserID desc limit 1");
			echo mysql_error();
			if ($myrow = mysql_fetch_array($sqltest1))
			{
				$UserID_Message=$myrow["UserID"];
			}
			mysql_free_result($sqltest1);

				

		}
			if ($Flag_Message == 2)

			{

				$sqltest = ExecQuery("Select RequestID from Req_Credit_Card order by RequestID desc limit 1");

				echo mysql_error();

				if ($myrow = mysql_fetch_array($sqltest))

				{

					$Item_ID=$myrow["RequestID"];

				}

				mysql_free_result($sqltest);

				$sqltest1 = ExecQuery("Select UserID from wUsers order by UserID desc limit 1");

				echo mysql_error();

				if ($myrow = mysql_fetch_array($sqltest1))

				{

					$UserID_Message=$myrow["UserID"];

				}

				mysql_free_result($sqltest1);

				

			}

			if ($result == 1) 

			{	

				if(strlen(trim($EmailID)) > 0 )
				{
					$sql = ExecQuery("Select *  from wUsers where Email='".$EmailID."'");

					echo mysql_error();

					if ($myrow = mysql_fetch_array($sql)) 

					{

						$UserID=$myrow["UserID"];

						

						/* Get Resultset */

						mysql_fetch_array($sql);



							$sub_sql = ExecQuery("Update Req_Loan_Personal SET UserID=".$UserID.", Count_Replies='1', IsModified='1' Where Email='".$EmailID."'");



							$sub_sql = ExecQuery("Update Req_Loan_Home SET UserID=".$UserID." Where Email='".$EmailID."'");

							$sub_sql = ExecQuery("Update Req_Loan_Against_Property SET UserID=".$UserID." Where Email='".$EmailID."'");



							$sub_sql = ExecQuery("Update Req_Credit_Card SET UserID=".$UserID." Where Email='".$EmailID."'");



							$sub_sql = ExecQuery("Update Req_Loan_Car SET UserID=".$UserID." Where Email='".$EmailID."'");
							
							$sub_sql = ExecQuery("Update Req_Life_Insurance SET UserID=".$UserID." Where Email='".$EmailID."'");

						mysql_free_result($sub_sql);

					}

				}

				

				/* Dump Resultset */

				mysql_free_result($result);

				session_unset();

				$Msg = getAlert("Congratulations!!! You have become our Registred User Now. Click OK to Continue !!", TRUE, "Login.php");

				}

				

			//else

			//	$Msg = "** There was a problem with your registration process. Please try again. !! ";

		}

	

?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Thank You</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
   <?php include '~Upper.php';?>

    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
<html>
<head>

<table width="500"  border="0" cellspacing="0" cellpadding="0">
		<tr><td width="30">&nbsp</td><td>&nbsp;</td></tr>
		<tr>
		<td width="30">&nbsp</td>
            <td>
 
 <p><b><font color="#3366CC">Congratulations!!! Your Request has been added Successfully.........</font></b></p>

     &nbsp;</td>
     </tr>
	 
            </table>
			</div>
	  <?php include '~Right1.php';?>
	<!--  <img src="images/120_90.gif"><BR><BR>
	  	  <img src="images/120_240.gif">
	  -->
	  </div>
    <?php include '~Bottom.php';?>
 
<!-- Google Code for lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1063319470;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (1) {
  var google_conversion_value = 1;
}
var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1063319470/imp.gif?value=1&label=lead&script=0">
</noscript>
</body>
</html>
