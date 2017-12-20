<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/htmlMimeMail.php';

	$Msg = "";
	$BidderID = $_REQUEST['BidderID'];
	$Table= "";
	$Title="";
	$Reply_Type_Code;
	$PostedBy = ($_SESSION['UserType']=='bidder')?2:1;
	$UserSession = $PostedBy;
	$SMSLen="160";
	$SMSFixedLen="17";
	$SMSBidderNameLen;
	$SMSEffectiveLen;

	getSMSLen();
////////////////////////////////////////////////////////

function getRequestData($table, $RequestID){
	$str = "";
	
	$result = ExecQuery("Select R.*, U.UserID, U.Email, U.FName, U.LName  From Req_$table R Inner Join wUsers U On R.UserID= U.UserID Where R.RequestID=$RequestID");
	echo mysql_error();

	if ($myrow = mysql_fetch_array($result)){
		$str = call_user_func('Template_'.$table, $myrow);
		mysql_free_result($result);
	}
	return $str;
   }

   function Template_Loan_Personal($myrow){
	$str = "";

	$str = formatRow("User Name", $myrow["FName"]." ".$myrow["LName"]);
	$str .= formatRow("Loan Amount", $myrow["Loan_Amount"]);
	$str .= formatRow("Employment Status", getEmpStatus($myrow["Employment_Status"]));
	$str .= formatRow("Company Name", $myrow["Company_Name"]);
	$str .= formatRow("City Name", $myrow["City"]);
	$str .= formatRow("Years In Company", $myrow["Years_In_Company"]);
	$str .= formatRow("Total Experience", $myrow["Total_Experience"]);
	$str .= formatRow("Net Salary", $myrow["Net_Salary"]);
	$str .= formatRow("Marital Status", getCodeValue("Marital".$myrow["Marital_Status"]));
	$str .= formatRow("Residential Status", getCodeValue("Resident".$myrow["Residential_Status"]));
	$str .= formatRow("Vehicles Owned", getCodeValue("Vehicle".$myrow["Vehicles_Owned"]));
	$str .= formatRow("Taken Any Loan", getCodeValue("Loan".$myrow["Loan_Any"]));
	$str .= formatRow("EMI's Paid", $myrow["EMI_Paid"]);
	$str .= formatRow("Credit Card Holder", getYesNo($myrow["CC_Holder"]));
	$str .= formatRow("Dated", $myrow["Dated"]);

	return $str;
   }

   function Template_Loan_Home($myrow){
	$str = "";

	$str = formatRow("User Name", $myrow["FName"]." ".$myrow["LName"]);
	$str .= formatRow("Loan Amount", $myrow["Loan_Amount"]);
	$str .= formatRow("Employment Status", getEmpStatus($myrow["Employment_Status"]));
	$str .= formatRow("Company Name", $myrow["Company_Name"]);
	$str .= formatRow("City Name", $myrow["City"]);
	$str .= formatRow("Total Experience", $myrow["Total_Experience"]);
	$str .= formatRow("Net Salary", $myrow["Net_Salary"]);
	$str .= formatRow("Property Type", getPropertyType($myrow["Property_Type"]));
	$str .= formatRow("Property Value", $myrow["Property_Value"]);
	$str .= formatRow("Description", $myrow["Descr"]);
	$str .= formatRow("Dated", $myrow["Dated"]);

	return $str;
   }


    function Template_Credit_Card($myrow){
	$str = "";

	$str = formatRow("User Name", $myrow["FName"]." ".$myrow["LName"]);
	$str .= formatRow("Employment Status", getEmpStatus($myrow["Employment_Status"]));
	$str .= formatRow("Company Name", $myrow["Company_Name"]);
	$str .= formatRow("City Name", $myrow["City"]);
	$str .= formatRow("Total Experience", $myrow["Total_Experience"]);
	$str .= formatRow("Net Salary", $myrow["Net_Salary"]);
	$str .= formatRow("Vehicles Owned", getCodeValue("Vehicle".$myrow["Vehicles_Owned"]));
	$str .= formatRow("Credit Card Holder", getYesNo($myrow["CC_Holder"]));
	$str .= formatRow("Description", $myrow["Descr"]);
	$str .= formatRow("Dated", $myrow["Dated"]);

	return $str;
   }

   function Template_Loan_Car($myrow){
	$str = "";

	$str = formatRow("User Name", $myrow["FName"]." ".$myrow["LName"]);
	$str .= formatRow("Employment Status", getEmpStatus($myrow["Employment_Status"]));
	$str .= formatRow("Company Name", $myrow["Company_Name"]);
	$str .= formatRow("City Name", $myrow["City"]);
	$str .= formatRow("Net Salary", $myrow["Net_Salary"]);
	$str .= formatRow("Car Make", getCarMake($myrow["Car_Make"]));
	$str .= formatRow("Car Model", $myrow["Car_Model"]);
	$str .= formatRow("Car Type", getCarType($myrow["Car_Type"]));
	$str .= formatRow("Loan Amount", $myrow["Loan_Amount"]);
	$str .= formatRow("Loan Tenure", $myrow["Loan_Tenure"]);
	$str .= formatRow("Description", $myrow["Descr"]);
	$str .= formatRow("Dated", $myrow["Dated"]);

	return $str;
   }

   function Template_Loan_Against_Property($myrow){
	$str = "";

	$str = formatRow("User Name", $myrow["FName"]." ".$myrow["LName"]);
	$str .= formatRow("Loan Amount", $myrow["Loan_Amount"]);
	$str .= formatRow("Employment Status", getEmpStatus($myrow["Employment_Status"]));
	$str .= formatRow("Company Name", $myrow["Company_Name"]);
	$str .= formatRow("City Name", $myrow["City"]);
	$str .= formatRow("Total Experience", $myrow["Total_Experience"]);
	$str .= formatRow("Net Salary", $myrow["Net_Salary"]);
	$str .= formatRow("Residential Status", getResidentialStatus($myrow["Residential_Status"]));
	$str .= formatRow("Property Type", getPropertyType($myrow["Property_Type"]));
	$str .= formatRow("Property Value", $myrow["Property_Value"]);
	$str .= formatRow("Description", $myrow["Descr"]);
	$str .= formatRow("Dated", $myrow["Dated"]);

	return $str;
   }
	function Template_Life_Insurance($myrow){
	$str = "";

	$str = formatRow("User Name", $myrow["FName"]." ".$myrow["LName"]);
	$str .= formatRow("Employment Status", getEmpStatus($myrow["Employment_Status"]));
	$str .= formatRow("Company Name", $myrow["Company_Name"]);
	$str .= formatRow("City Name", $myrow["City"]);
	$str .= formatRow("Marital Status", getCodeValue("Marital".$myrow["Marital_Status"]));
	$str .= formatRow("No Of Dependents", $myrow["No_of_dependents"]);
	$str .= formatRow("Annual Income", $myrow["Annual_Income"]);
	$str .= formatRow("Plan Interested", getCodeValue("Plan_Interested".$myrow["Plan_Interested"]));
	$str .= formatRow("Dated", $myrow["Dated"]);

	return $str;
   }
   function formatRow($key, $val){
	static $i=0; $i++;
	return "<tr id=row".($i % 2)."><td><b>$key</b></td><td>$val</td></tr>";
   }
////////////////////////////////////////////////////////
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;
		$type = $Reply_Type;
		$Reply_Type = getCodeValue("ReplyType_$Reply_Type");
		
		switch($Reply_Type){
		case "1":
			$str= "Req_Loan_Personal"; $Table_Preview= "Loan_Personal"; break;
		case "2":
			$str= "Req_Loan_Home"; $Table_Preview= "Loan_Home"; break;
		case "3":
			$str= "Req_Loan_Car"; $Table_Preview= "Loan_Car"; break;
		case "4":
			$str= "Req_Credit_Card"; $Table_Preview= "Credit_Card"; break;
		case "5":
			$str= "Req_Loan_Against_Property"; $Table_Preview= "Loan_Against_Property"; break;
		case "6":
			$str= "Req_Life_Insurance"; $Table_Preview= "Life_Insurance"; break;
	   }
	   if($_SESSION['UserType']=='bidder')
		{
		//$result = ExecQuery("UPDATE $str SET IsModified='0' WHERE RequestID=$RequestID and UserID=$UserID");
	    echo mysql_error();
	   }
	   if($_SESSION['UserType']=='user')
		{
		$result = ExecQuery("UPDATE $str SET IsModified='0' WHERE RequestID=$RequestID and UserID=$UserID");
		
	    echo mysql_error();
	   }
		//echo $PostedBy;
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_GET as $a=>$b)
			$$a=$b;
	   switch($Reply_Type){
		case "1":
			$Table= "Loan_Personal"; $Title="personal"; $Title_Request="Personal Loan"; $Table_Preview= "Loan_Personal"; $Reply_Type_Code = 1; break;
		case "2":
			$Table= "Loan_Home"; $Title="home"; $Title_Request="Home Loan"; $Table_Preview= "Loan_Home"; $Reply_Type_Code = 2; break;
		case "3":
			$Table= "Loan_Car"; $Title="car"; $Title_Request="Car Loan"; $Table_Preview= "Loan_Car"; $Reply_Type_Code = 3; break;
		case "4":
			$Table= "Credit_Card"; $Title="cc"; $Title_Request="Credit Card"; $Table_Preview= "Credit_Card"; $Reply_Type_Code = 4; break;
		case "5":
			$Table= "Loan_Against_Property"; $Title="property"; $Title_Request="Loan Against Property";  $Table_Preview= "Loan_Against_Property"; $Reply_Type_Code = 5; break;
		case "6":
			$Table= "Life_Insurance"; $Title="Life Insurance"; $Title_Request="Life Insurance"; $Table_Preview= "Life_Insurance"; $Reply_Type_Code = 6; break;
	   }
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		/* FIX STRING */
		$Message = FixString($Message);

//$Request_Message = "";
//End of that File
		$sql = ExecQuery("Select *  from Bidders where BidderID='".$BidderID."'");
				echo mysql_error();
				if ($myrow = mysql_fetch_array($sql)) 
				{
					$Bidder_Name=$myrow["Bidder_Name"];
					$Associated_Bank=$myrow["Associated_Bank"];

				}
				///echo "UserID == ".$UserID."<BR>";
				
				mysql_free_result($sql);

		$sql = "Select *  from wUsers where UserID='".$UserID."'";
		$result = ExecQuery($sql);
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) {
				do
				{
					$UserID=$myrow["UserID"];
					$EmailID=$myrow["Email"];
					$Fname=$myrow["FName"];
					$Phone=$myrow["Phone"];
				}while ($myrow = mysql_fetch_array($result));

				}
				mysql_free_result($result);

		$sql = "Select *  from Req_Loan_Personal where RequestID='".$RequestID."'";
		$result = ExecQuery($sql);
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) {
				do
				{
					$Count_Replies=$myrow["Count_Replies"];
				}while ($myrow = mysql_fetch_array($result));

				}
				mysql_free_result($result);

		$sql = "Select *  from Req_Loan_Home where RequestID='".$RequestID."'";
		$result = ExecQuery($sql);
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) {
				do
				{
					$Count_Replies=$myrow["Count_Replies"];
				}while ($myrow = mysql_fetch_array($result));

				}
				mysql_free_result($result);

		$sql = "Select *  from Req_Loan_Car where RequestID='".$RequestID."'";
		$result = ExecQuery($sql);
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) {
				do
				{
					$Count_Replies=$myrow["Count_Replies"];
				}while ($myrow = mysql_fetch_array($result));

				}
				mysql_free_result($result);

	$sql = "Select *  from Req_Credit_Card where RequestID='".$RequestID."'";
		$result = ExecQuery($sql);
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) {
				do
				{
					$Count_Replies=$myrow["Count_Replies"];
				}while ($myrow = mysql_fetch_array($result));

				}
				mysql_free_result($result);

	$sql = "Select *  from Req_Loan_Against_Property where RequestID='".$RequestID."'";
		$result = ExecQuery($sql);
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) {
				do
				{
					$Count_Replies=$myrow["Count_Replies"];
				}while ($myrow = mysql_fetch_array($result));

				}
				mysql_free_result($result);
	$sql = "Select *  from Req_Life_Insurance where RequestID='".$RequestID."'";
		$result = ExecQuery($sql);
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) {
				do
				{
					$Count_Replies=$myrow["Count_Replies"];
				}while ($myrow = mysql_fetch_array($result));

				}
				mysql_free_result($result);


		//$Count_Replies ="";
		$Count_Replies = $Count_Replies + 1;
		//echo $Count_Replies;
		$sql = "UPDATE Req_Loan_Personal SET Count_Replies='$Count_Replies', IsModified='1' WHERE RequestID=$RequestID and UserID=$UserID";
		$result = ExecQuery($sql);
		$sql = "UPDATE Req_Loan_Home SET Count_Replies='$Count_Replies', IsModified='1' WHERE RequestID=$RequestID and UserID=$UserID";
		$result = ExecQuery($sql);
		$sql = "UPDATE Req_Loan_Against_Property SET Count_Replies='$Count_Replies', IsModified='1' WHERE RequestID=$RequestID and UserID=$UserID";
		$result = ExecQuery($sql);
		$sql = "UPDATE Req_Loan_Car SET Count_Replies='$Count_Replies', IsModified='1' WHERE RequestID=$RequestID and UserID=$UserID";
		$result = ExecQuery($sql);
		$sql = "UPDATE Req_Credit_Card SET Count_Replies='$Count_Replies', IsModified='1' WHERE RequestID=$RequestID and UserID=$UserID";
		$result = ExecQuery($sql);
		$sql = "UPDATE Req_Life_Insurance SET Count_Replies='$Count_Replies', IsModified='1' WHERE RequestID=$RequestID and UserID=$UserID";
		$result = ExecQuery($sql);
		echo mysql_error();
		$PostedBy = ($_SESSION['UserType']=='bidder')?2:1;
		//echo $PostedBy;
		//$Message = convert_word_to_ascii($Message);
		$result = ExecQuery("INSERT INTO Replies (RequestID, UserID, BidderID, SequenceID, PostedBy, Reply_Type, Message, Other_Comments, Rate, EMI, Tenure, smsreply, Dated) VALUES ( '$RequestID',  '$UserID', '$BidderID', '0', '$PostedBy', '$Reply_Type', '$Message', '$Other_Comments', '$Rate', '$EMI', '$Tenure', '$smsreply', Now() )");

		echo mysql_error();
		if ($result == 1)
		{
			//echo "Fname == ".$Fname."<BR>";
			//echo "EmailID == ".$EmailID."<BR>";
			//echo "Bidder_Name == ".$Bidder_Name."<BR>";
			//echo "Message == ".$Message."<BR>";
			$PostedBy = $_REQUEST['PostedBy'];
			$Message = $_REQUEST['Message'];
			$Other_Comments = $_REQUEST['Other_Comments'];
			$smsreply = $_REQUEST['smsreply'];
			$Rate = $_REQUEST['Rate'];
			$EMI = $_REQUEST['EMI'];
			$Tenure = $_REQUEST['Tenure'];
			$Reply_Type = $_REQUEST['Reply_Type'];
			$pass_type = getCodeValue($Reply_Type);
			$UserID = $_REQUEST['UserID'];
			$RequestID = $_REQUEST['RequestID'];
			$BidderID = $_REQUEST['BidderID'];
			$ifbidder = "possitive";
			

			$SMSMessage = $smsreply;
			if(strlen(trim($Phone)) > 0 && strlen(trim($SMSMessage))> 0)
			{
				global	$SMSEffectiveLen;
				if(strlen(trim($SMSMessage)) > $SMSEffectiveLen)
				{
					$SMSMessage = substr($SMSMessage, 0, $SMSEffectiveLen);
				}
				$SMSMessage = "Bidder-".trim($_SESSION['UName'])." posted: ".$SMSMessage;
				SendSMS($SMSMessage, $Phone);
			}

			//$Request_Message = getRequestData($Table, $RequestID);
			//echo getRequestData($Table, $RequestID);
			
			//echo "lllll:".$pass_type;
			//$showpopup = print"<a href='http://www.deal4loans.com/Bidder_View_Window.php?BidderID='.$BidderID.''>"</a>";
			if($Reply_Type=='1'||$Reply_Type=='2'||$Reply_Type=='3'||$Reply_Type=='5'||$Reply_Type=='6') {
			$Message1= "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='450' id='AutoNumber1'><tr><td bgcolor='#529BE4'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#FFFFFF'><p><font face='Arial' size='2'>Dear $Fname,<br>Thanks for using Deal4loans.com for your $Title_Request requirement</font></p><p><font face='Arial' size='2'><b>E-Quote</b> from <a href='http://www.deal4loans.com/Bidder_View_Window.php?BidderID=$BidderID'>$Bidder_Name</a>,<br><b>Associated Bank:</b> $Associated_Bank</font></p><p><b><font face='Arial' size='2'>Documents Required:<br></font></b><font face='Arial' size='2'>$Message</font></p><p><font face='Arial' size='2'><b>Other Comments:</b>$Other_Comments<br><br><strong>ROI:</strong> $Rate%<br><strong>EMI:</strong> Rs.$EMI <br><strong>TENURE:</strong> $Tenure Years</font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team <a href='http://www.deal4loans.com'>deal4loans.com</a></b> </font></p><br><br><font face='Arial' size='2'><b><a href='http://www.deal4loans.com/Login_Email.php?RequestID=$RequestID&UserID=$UserID&BidderID=$BidderID&Reply_Type=$Reply_Type'>Reply to This Mail</a></b></font></td></tr></table></td></tr></table>";
			}
			/*
			<form name='frm_deal4loans' method='post' action='http://www.deal4loans.com/reply_email.php'><input type='hidden' name='Fname' value='$Fname'><input type='hidden' name='Bidder_Name' value='$Bidder_Name'><input type='hidden' name='Reply_Type' value='$Reply_Type'><input type='hidden' name='PostedBy' value='2'><input type='hidden' name='UserID' value='$UserID'><input type='hidden' name='type' value='$type'><input type='hidden' name='RequestID' value='$RequestID'><input type='hidden' name='BidderID' value='$BidderID'><input type='hidden' name='ifbidder' value='possitive'><p align='center'><b><textarea rows='4' name='Message' cols='30'>Post Your Reply to this Bidder Here</textarea></b></p><p align='center'><input type='submit' value='Submit'></p></form>
			*/
			else
			{
			$Message1= "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='450' id='AutoNumber1'><tr><td bgcolor='#529BE4'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#FFFFFF'><p><font face='Arial' size='2'>Dear $Fname,<br>Thanks for using Deal4loans.com for your $Title_Request requirement</font></p><p><font face='Arial' size='2'><b>E-Quote</b> from <a href='http://www.deal4loans.com/Bidder_View_Window.php?BidderID=$BidderID'>$Bidder_Name</a>,<br><b>Associated Bank:</b> $Associated_Bank</font></p><p><b><font face='Arial' size='2'>Documents Required:<br></font></b><font face='Arial' size='2'>$Message</font></p><p><font face='Arial' size='2'><b>Other Comments:</b>$Other_Comments</font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team <a href='http://www.deal4loans.com'>deal4loans.com</a></b></font></p><br><br><font face='Arial' size='2'><b><a href='http://www.deal4loans.com/Login_Email.php?RequestID=$RequestID&UserID=$UserID&BidderID=$BidderID&Reply_Type=$Reply_Type'>Reply to This Mail</a></b></font></td></tr></table></td></tr></table>";
			}
/*
<form name='frm_deal4loans' method='post' action='http://www.deal4loans.com/reply_email.php'><input type='hidden' name='Fname' value='$Fname'><input type='hidden' name='Bidder_Name' value='$Bidder_Name'><input type='hidden' name='Reply_Type' value='$Reply_Type'><input type='hidden' name='PostedBy' value='2'><input type='hidden' name='UserID' value='$UserID'><input type='hidden' name='type' value='$type'><input type='hidden' name='RequestID' value='$RequestID'><input type='hidden' name='BidderID' value='$BidderID'><input type='hidden' name='ifbidder' value='possitive'><p align='center'><b><textarea rows='4' name='Message' cols='30'>Post Your Reply to this Bidder Here</textarea></b></p><p align='center'><input type='submit' value='Submit'></p></form>
*/

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Additional headers
/*
			$headers .= 'To: '.$Fname.' <'.$EmailID.'>' . "\r\n";
			$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			mail($EmailID,'Bidder Reply For Your Request', $Message1, $headers);
			//send_mail_new($Fname,$EmailID,$Bidder_Name,'Admin@deal4loans.com','Reply to Your Request id='.$RequestID,$Message1);
			$Msg = "** Your reply has been added Successfully !! ";
		}
		else
			$Msg = "** There was a problem in adding your reply. Please try again. !! ";
	}
	function getReplies(){
	global $type, $Reply_Type,$Reply_Type_Code, $UserID, $BidderID, $RequestID, $PostedBy, $UserSession;
	$str = ""; $ExtraSql = "";
	static $i=0;

	//////////////////Execute Query//////////////////////////////
	if($UserSession==2)
		$ExtraSql = " And R.BidderID=$BidderID ";


		$sql = "Select R.*, U.FName, U.LName, B.Bidder_Name From Replies R INNER JOIN wUsers U On R.UserID=U.UserID INNER JOIN Bidders B on R.BidderID=B.BidderID Where R.Reply_Type=$Reply_Type And R.RequestID=$RequestID And R.UserID=$UserID $ExtraSql Order By R.BidderID, R.Dated";
		//echo $sql;

	$result = ExecQuery($sql);
	echo mysql_error();

	if ($myrow = mysql_fetch_array($result)) {
	  do
	  {
		$BidderID=$myrow["BidderID"];
		$User_Name=$myrow["FName"]." ".$myrow["LName"];
		$Bidder_Name=$myrow["Bidder_Name"];
		$ReplyID=$myrow["ReplyID"];
		$Message=$myrow["Message"];
		$Other_Comments=$myrow["Other_Comments"];
		$smsreply=$myrow["smsreply"];
		$Rate=$myrow["Rate"];
		$EMI=$myrow["EMI"];
		$Tenure=$myrow["Tenure"];
		$PostedBy=$myrow["PostedBy"];
		$PostedBy2=getCodeValue("PostedBy".$myrow["PostedBy"]);
		$Dated=$myrow["Dated"];
		//echo "ans".$PostedBy;
		if($_SESSION['UserType']=='user')
		 {
			$str .= "<Div class=Box".getRowID($i++)."><p>Posted on <u>$Dated</u> by <b>$PostedBy2</b><p><b>Documents Required:</b><br>$Message<p><b>Rate:</b> $Rate% &nbsp; &nbsp; <b>EMI:</b> $EMI &nbsp; &nbsp;<b>Tenure:</b> $Tenure<p><b>Other Comments: </b>$Other_Comments<p>";
			if($PostedBy == "2")
				$str .=" <p><b>SMS Reply: </b>$smsreply<p> ";
			$str .= "<p><b>User Name</b>: $User_Name &nbsp; &nbsp; <b>Bidder Name</b>: <a href='Bidder_View.php?BidderID=$BidderID'>$Bidder_Name</a> &nbsp; &nbsp; <a href=\"Reply.php?RequestID=$RequestID&UserID=$UserID&BidderID=$BidderID&Reply_Type=$type&PostedBy=$UserSession\"><b>Reply</b></a></Div>";
		}
		else
		{
			$str .= "<Div class=Box".getRowID($i++)."><p>Posted on <u>$Dated</u> by <b>$PostedBy2</b><p><b>Documents Required:</b><br> $Message<p><b>Rate:</b> $Rate% &nbsp; &nbsp;<b>EMI:</b> $EMI &nbsp; &nbsp;<b>Tenure:</b> $Tenure <p><b>Other Comments:</b> $Other_Comments<p>";
			if($PostedBy == "2")
				$str .= "<p><b>SMS Reply:</b> $smsreply<p>";
			$str .= "<p><b>User Name</b>: $User_Name &nbsp; &nbsp; <b>Bidder Name</b>: $Bidder_Name  &nbsp; &nbsp;</Div>";
		}

	  }while ($myrow = mysql_fetch_array($result));
          mysql_free_result($result);
	}
	return $str;
   }
   function getSMSLen()
   {
	   global $SMSLen, $SMSFixedLen, $SMSBidderNameLen, $SMSEffectiveLen;
		$SMSBidderNameLen = strlen(trim($_SESSION['UName']));
		$SMSEffectiveLen = $SMSLen - ($SMSFixedLen + $SMSBidderNameLen);
   }

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Replies</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<link href="includes/style1.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

<script language="javascript" type="text/javascript">
<!--
function imposeMaxLength(Object, MaxLen)
{
  return (Object.value.length <= MaxLen);
}
-->
</script> 

 <?php include '~Top.php'; ?>
 <div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif" /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
<table border="0" cellspacing="1" cellpadding="0">
   <tr>
     <td width="202" align="left" valign="top" bgcolor="">
<?php if(isset($_SESSION['UserType']))
	{
	include '~Left.php';
	}
	
?>     </td>
     <td width="510" valign="top" align=center><strong class="head2"><br>
       Replies</strong>
       <p class="bodyarial11"><?=$Msg?></p>
	<span class="bodyarial11"><?=getReplies()?></span>
	<p>&nbsp;</p>
		<Script Language="JavaScript">
	   function validateMe(theFrm){
		if(!checkData(theFrm.Message, ' Reply ', 10))
			return false;
		return true;
	    }
	 </Script>
	<form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
	  <input type="hidden" name="PostedBy" value="<?=$PostedBy?>">
	  <input type="hidden" name="UserID" value="<?=$UserID?>">
	  <input type="hidden" name="Reply_Type" value="<?=$Reply_Type?>">
	  <input type="hidden" name="RequestID" value="<?=$RequestID?>">
	  <input type="hidden" name="BidderID" value="<?=$BidderID?>">
	  <table width="50%" cellpadding="4" cellspacing="1" class="blueborder" id="Grid">
  <tr id="HD">
    <td colspan="2" class="bodyarial11"><span class="style1">Request Details</span></td>
  </tr>
  <tr>
    <td class="Brdr" colspan="2"></td>
    <?=getRequestData($Table_Preview, $RequestID);
	 ?>
  </tr>
</table>
<br>
<br>
	 <? if($_SESSION['UserType']=='bidder') {?>
	 <table width="450" border="0" cellpadding="3" cellspacing="0" class="blueborder">
		<tr>
		<td height="19" colspan="2" class="head1"><b>Reply</b></td>
	   </tr>
	          <tr>
                <td height="19" colspan="2" class="bodyarial11">&nbsp;</td>
	    </tr>
        <tr>
                <td height="68" class="bodyarial11">
                <p align="left"><b>Documents Required:</b></td>
                <td height="68" class="bodyarial11"> 
                <textarea name="Message" cols="40" rows="4" class="form" style="font-family: Verdana;"></textarea></td>
	    </tr>
	    <? if($Reply_Type=='1'||$Reply_Type=='2'||$Reply_Type=='3'||$Reply_Type=='5') {?>
        <tr>
                <td height="22" class="bodyarial11">
                <p align="left"><b>Rate :</b></td>
                <td height="22" class="bodyarial11"> 
                <input name="Rate" type="text" class="form" value="00.0" size="5">
                %</td>
	    </tr>
        <tr>
                <td height="22" class="bodyarial11">
                <p align="left"><b>EMI :</b></td>
                <td height="22" class="bodyarial11"><input name="EMI" type="text" class="form" value="00.0" size="6"></td>
	    </tr>
        <tr>
                <td height="22" class="bodyarial11">
                <p align="left"><b>Tenure :</b></td>
                <td height="22" class="bodyarial11"> 
                <input name="Tenure" type="text" class="form" value="0 Years" size="6">Years</td>
	    </tr>
	    <? } ?>
        <tr>
                <td height="68" class="bodyarial11"><b>Other Comments:&nbsp; </b>                </td>
                <td height="68" class="bodyarial11"> 
                <textarea name="Other_Comments" cols="40" rows="4" class="form" style="font-family: Verdana;"></textarea></td>
	    </tr>
        <tr>
                <td height="68" class="bodyarial11"><b>SMS Reply:&nbsp;(Max <? echo $SMSEffectiveLen; ?> characters)</b></td>
                <td height="68" class="bodyarial11"> 
                    <textarea name="smsreply" cols="40" rows="6" class="form" style="font-family: Verdana;" onKeyPress="return imposeMaxLength(this, <? echo ($SMSEffectiveLen-1); ?>);"></textarea>				</td>
	    </tr>
	    <tr align="Center">
                <td width="30%" height="19" colspan="2" class="bodyarial11">&nbsp;</td>
	   </tr>
	   <tr>
	     <td height="45" colspan="2" align="center" class="bodyarial11"><br>
	       <input type="submit" class="bluebutton" value="Submit"></td>
	   </tr>
	  </table>
	  <? } ?>
	 </form>
     </td>
	
   </tr>
 </table>
 </div>
 </div>
<?php include '~Bottom.php';?>
 
</body>
</html>