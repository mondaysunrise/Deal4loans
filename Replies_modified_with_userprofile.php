<?php
	require 'scripts/session_check.php';
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

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;

		$type = $Reply_Type;
		$Reply_Type = getCodeValue("ReplyType_$Reply_Type");
		//echo $PostedBy;
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_GET as $a=>$b)
			$$a=$b;
	   switch($Reply_Type){
		case "1":
			$Table= "Loan_Personal"; $Title="Personal Loan"; $Reply_Type_Code = 1; break;
		case "2":
			$Table= "Loan_Home"; $Title="Home Loan"; $Reply_Type_Code = 2; break;
		case "3":
			$Table= "Investment"; $Title="Investment/Insurance"; $Reply_Type_Code = 3; break;
		case "4":
			$Table= "Credit_Card"; $Title="Credit Card"; $Reply_Type_Code = 4; break;
	   }
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		/* FIX STRING */
		$Message = FixString($Message);
// Here inclusion of Request File on to which response is been made....
function getRequestData($Table, $RequestID){
	$str = "";
	$result = ExecQuery("Select R.*, U.UserID, U.Email, U.FName, U.LName From Req_$Table R Inner Join wUsers U On R.UserID= U.UserID Where R.RequestID=$RequestID");
	//echo "Testing".$Table;

//echo "Select R.*, U.UserID, U.Email, U.FName, U.LName  From Req_$Table R Inner Join wUsers U On R.UserID= U.UserID Where R.RequestID=$RequestID"."<BR>";
	echo mysql_error();

	if ($myrow = mysql_fetch_array($result)){
		$str = call_user_func('Template_'.$Table, $myrow);
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
	$str .= formatRow("Total Experience", $myrow["Total_Experience"]);
	$str .= formatRow("Net Salary", $myrow["Net_Salary"]);
	$str .= formatRow("Property Type", getPropertyType($myrow["Property_Type"]));
	$str .= formatRow("Property Value", $myrow["Property_Value"]);
	$str .= formatRow("Description", $myrow["Descr"]);
	$str .= formatRow("Dated", $myrow["Dated"]);

	return $str;
   }


   function Template_Investment($myrow){
	$str = "";

	$str = formatRow("User Name", $myrow["FName"]." ".$myrow["LName"]);
	$str .= formatRow("Amount", $myrow["Amount"]);
	$str .= formatRow("Period", $myrow["Period"]);
	$str .= formatRow("Insurance Linked", getYesNo($myrow["Insurance_Linked"]));
	$str .= formatRow("Investment Type", getCodeValue("Inv".$myrow["Investment_Type"]));
	$str .= formatRow("Dated", $myrow["Dated"]);

	return $str;
   }

   function Template_Credit_Card($myrow){
	$str = "";

	$str = formatRow("User Name", $myrow["FName"]." ".$myrow["LName"]);
	$str .= formatRow("Employment Status", getEmpStatus($myrow["Employment_Status"]));
	$str .= formatRow("Company Name", $myrow["Company_Name"]);
	$str .= formatRow("Total Experience", $myrow["Total_Experience"]);
	$str .= formatRow("Net Salary", $myrow["Net_Salary"]);
	$str .= formatRow("Vehicles Owned", getCodeValue("Vehicle".$myrow["Vehicles_Owned"]));
	$str .= formatRow("Credit Card Holder", getYesNo($myrow["CC_Holder"]));
	$str .= formatRow("Description", $myrow["Descr"]);
	$str .= formatRow("Dated", $myrow["Dated"]);

	return $str;
   }

   function formatRow($key, $val){
	static $i=0; $i++;
	return "<tr id=row".($i % 2)."><td><b>$key</b></td><td>$val</td></tr>";
   }
$Request_Message = "";


//End of that File
		$sql = ExecQuery("Select *  from Bidders where BidderID='".$BidderID."'");
				echo mysql_error();
				if ($myrow = mysql_fetch_array($sql)) 
				{
					$Bidder_Name=$myrow["Bidder_Name"];

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
	
		//$Count_Replies ="";
		$Count_Replies = $Count_Replies + 1;
		//echo $Count_Replies;
		$sql = "UPDATE Req_Loan_Personal SET Count_Replies='$Count_Replies' WHERE RequestID=$RequestID";
		$result = ExecQuery($sql);
		$sql = "UPDATE Req_Loan_Home SET Count_Replies='$Count_Replies' WHERE RequestID=$RequestID";
		$result = ExecQuery($sql);
		$sql = "UPDATE Req_Loan_Car SET Count_Replies='$Count_Replies' WHERE RequestID=$RequestID";
		$result = ExecQuery($sql);
		$sql = "UPDATE Req_Credit_Card SET Count_Replies='$Count_Replies' WHERE RequestID=$RequestID";
		$result = ExecQuery($sql);
		echo mysql_error();
		$PostedBy = ($_SESSION['UserType']=='bidder')?2:1;
		//echo $PostedBy;
		$result = ExecQuery("INSERT INTO Replies (RequestID, UserID, BidderID, SequenceID, PostedBy, Reply_Type, Message, Rate, EMI, Tenure, Dated) VALUES ( '$RequestID',  '$UserID', '$BidderID', '0', '$PostedBy', '$Reply_Type', '$Message', '$Rate', '$EMI', '$Tenure', Now() )");

		echo mysql_error();
		if ($result == 1)
		{
			//echo "Fname == ".$Fname."<BR>";
			//echo "EmailID == ".$EmailID."<BR>";
			//echo "Bidder_Name == ".$Bidder_Name."<BR>";
			//echo "Message == ".$Message."<BR>";
			$PostedBy = $_REQUEST['PostedBy'];
			$Message = $_REQUEST['Message'];
			$Rate = $_REQUEST['Rate'];
			$EMI = $_REQUEST['EMI'];
			$Tenure = $_REQUEST['Tenure'];
			$Reply_Type = $_REQUEST['Reply_Type'];
			$pass_type = getCodeValue($Reply_Type);
			$UserID = $_REQUEST['UserID'];
			$RequestID = $_REQUEST['RequestID'];
			$BidderID = $_REQUEST['BidderID'];
			$ifbidder = "possitive";
			$Request_Message = getRequestData($Table, $RequestID);
			//echo getRequestData($Table, $RequestID);
			
			//echo "lllll:".$pass_type;

			$Message1= "<html><head><title>apply here</title><link rel='stylesheet' type='text/css' href='http://www.deal4loans.com/site1/css/style.css'></head><body><form name='deal4loans' method='post' action=http://www.deal4loans.com/site1/reply_email.php target='_new'><input type='hidden' name='Reply_Type' value= $Reply_Type><input type='hidden' name='PostedBy' value='2'><input type='hidden' name='UserID' value='$UserID'><input type='hidden' name='RequestID' value='$RequestID'><input type='hidden' name='BidderID' value='$BidderID'><input type='hidden' name='ifbidder' value='possitive'><script language='javascript'>function PopUpDeal4loans(){window.open('http://www.deal4loans.com/site1/Bidder_View_Window.php?BidderID=$BidderID','hell','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=500,height=300,top=100,left=100')}</script><table border='0' cellspacing='0' width='300' cellpadding='4' id='frm'>	<tr><td width='100%' bgcolor='#EEF0E3'><font face='Verdana'><b><font size='2'><table border='0' cellpadding='0' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber26' bgcolor='#DEE3CD'><tr><font face='Verdana' size='2'><td width='100%' align='center' colspan='5'><b><font size='2'>Deal4loans</font></b></td></font></tr><tr><font face='Verdana' size='2'><td width='100%' align='center' colspan='5'></td></font></tr><tr><td align='center'><img border='0' src='http://www.deal4loans.com/site1/images/personal_small.jpg' width='30' height='29' alt='Personal Loan'></td><td align='center'><font face='Verdana' size='2'>  <img border='0' src='http://www.deal4loans.com/site1/images/home_small.jpg' width='30' height='32' alt='Home Loan'></font></td><td align='center'><font face='Verdana' size='2'><img border='0' src='http://www.deal4loans.com/site1/images/car_small.jpg' width='30' height='31' alt='Car Loan'></font></td><td align='center'><font face='Verdana' size='2'><img border='0' src='http://www.deal4loans.com/site1/images/cc_small.jpg' width='30' height='33' alt='Credit Card'></font></td><td align='center'><font face='Verdana' size='2'><img border='0' src='http://www.deal4loans.com/site1/images/insurance_small.jpg' width='30' height='34' alt='Insurance'></font></td></tr><tr><font face='Verdana' size='2'><td align='center'></td><td align='center'></td><td align='center'></td><td align='center'></td><td align='center'></td></font></tr><tr><font face='Verdana' size='2'><td align='center' colspan='5'><font face='Verdana'><b><font face='Verdana' size='2'><u>Original Request Posted By You</u></b></td></tr><tr><td align='center' colspan='5'><div align='center'><center><table border='1' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='75%' id='AutoNumber27'><tr><td width='100%'>  <p align='left'><b><font face='Verdana' size='2'>$Request_Message</font></td></tr></table></center></div> </td></font></tr><tr><font face='Verdana' size='2'><td align='center'></td><td align='center'></td><td align='center'></td><td align='center'></td><td align='center'></td></font></tr><tr><font face='Verdana' size='2'><td align='center' colspan='5'><font face='Verdana'><b><font face='Verdana' size='2'><u>Reply to Your Request Posted By Bidder</u> &nbsp;<a href='javascript:PopUpDeal4loans()'>$Bidder_Name</a><br></font></font></b></font><font face='Verdana' size='2'>$Message<br>RATE : $Rate%<br>EMI : Rs. $EMI <br>TENURE : $Tenure</font></b><br><Center><textarea rows='8' name='Message' cols='60'>----Post Your Message Here to This Bidder-------</textarea></Center></font></td></font></tr><tr><td align='center'></td><td align='center'></td><td align='center'></td><td align='center'></td><td align='center'></td></tr><tr><td align='center' colspan='5'><font face='Verdana' size='2'><INPUT TYPE='image' NAME='submit' src='http://www.deal4loans.com/site1/images/submit_now.jpg' border='0' alt='Submit' width='70' height='24'></font></td></tr><tr><td align='center' colspan='5'></td></tr></table></td></tr><tr><td ID='Alert'><?=$Msg?></td></tr><tr><td></td></tr><tr><td align='center'><br></td></tr></table></FORM></body></html>";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To: '.$Fname.' <'.$EmailID.'>, Abhi <abhi1022004@yahoo.com>' . "\r\n";
	$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= 'Cc: no-reply@deal4loans.com' . "\r\n";
	mail($EmailID,'Bidder Reply', $Message1, $headers);
	//send_mail_new($Fname,$EmailID,$Bidder_Name,'Admin@deal4loans.com','Bidder Reply',$Message1);	
	$Msg = "** Your reply has been added. !! ";
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
		$Rate=$myrow["Rate"];
		$EMI=$myrow["EMI"];
		$Tenure=$myrow["Tenure"];
		$PostedBy=$myrow["PostedBy"];
		$PostedBy2=getCodeValue("PostedBy".$myrow["PostedBy"]);
		$Dated=$myrow["Dated"];
		//echo "ans".$PostedBy;
		if($_SESSION['UserType']=='user')
		  {
			$str .= "<Div class=Box".getRowID($i++)."><p>Posted on <u>$Dated</u> by <b>$PostedBy2</b><p>$Message<p><b>Rate:</b> $Rate &nbsp; &nbsp; <b>EMI:</b> $EMI &nbsp; &nbsp;<b>Tenure:</b> $Tenure <p><b>User Name</b>: $User_Name; &nbsp; &nbsp; <b>Bidder Name</b>: <a href='Bidder_View.php?BidderID=$BidderID'>$Bidder_Name</a> &nbsp; &nbsp; <a href=\"Reply.php?RequestID=$RequestID&UserID=$UserID&BidderID=$BidderID&Reply_Type=$type&PostedBy=$UserSession\"><b>Reply</b></a></Div>";}
		else
		  {$str .= "<Div class=Box".getRowID($i++)."><p>Posted on <u>$Dated</u> by <b>$PostedBy2</b><p>$Message<p><b>Rate:</b> $Rate &nbsp; &nbsp;<b>EMI:</b> $EMI &nbsp; &nbsp;<b>Tenure:</b> $Tenure <p><b>User Name</b>: $User_Name; &nbsp; &nbsp; <b>Bidder Name</b>: $Bidder_Name  &nbsp; &nbsp;</Div>";}


	  }while ($myrow = mysql_fetch_array($result));
          mysql_free_result($result);
	}
	return $str;
   }
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Replies</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/menu.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div align="center">
 <center>
 <?php include '~Top.php'; ?>
<table border="0" cellspacing="1" width="100%" cellpadding="0"  bgcolor="#F9FAF5">
   <tr>
     <td width="200" align="center" valign="top" bgcolor="#DEE3CE">
<?php if(isset($_SESSION['UserType']))
	{
	include '~Left.php';
	}
	else
	{
	include '~Login.php';
	}
?>    
     </td>
     <td width="1" bgcolor="#636F40"></td>
     <td width="1" bgcolor="#DEE3CE"></td>
     <td width="*" valign="top" align=center>
	<table border="0" cellspacing="0" width="450" cellpadding="4" id="frm">
   		<tr><td colspan="2" id="Title">Replies</td></tr>
	</table>
	<p><?=$Msg?></p>
	<?//echo "kkkkkkkkkk".$PostedBy;?>
	<?=getReplies()?>
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
	 <? if($_SESSION['UserType']=='bidder') {?>
	 <table border="0" cellspacing="0" width="300" cellpadding="4" id="frm">
	   <tr>
	     <td id="Title">Reply</td>
	   </tr>
	   <tr>
	     <td><textarea rows="8" style="font-family: Verdana;" name="Message" cols="60"></textarea><p>Rate :
         <input type="text" name="Rate" size="5" value="00.0">&nbsp; EMI :
         <input type="text" name="EMI" size="6" value="00.0">&nbsp; Tenure :
         <input type="text" name="Tenure" size="6" value="0 Years"></td>
	   </tr>
	   <tr>
	     <td align="center"><br><input type="submit" value="Submit"></td>
	   </tr>
	  </table>
	  <? } ?>
	 </form>
     </td>
   </tr>
 </table>
<?php include '~Bottom.php';?>
 </center>
</div>
</body>
</html>