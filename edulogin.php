<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	session_start();
	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		formHandler();

	function formHandler(){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$result = ("select * from Bidders where Email='$Email' and PWD='$PWD' and BidderID=1921");
		 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
		//$num_rows = mysql_num_rows($result);
		$_SESSION['ReplyType']=" ";
		if($num_rows > 0){
			 /* Get Resultset */
			//$row = mysql_fetch_array($result);

			 /* Create Session Variables */
			setSessionBidder($Email, $row[$cntr]);
	//	echo $sql = "Select Reply_Type,Dated from Bidders_List where BidderID='".$_SESSION['BidderID']."'";
		$result1 = ("Select Reply_Type,Dated,City from Bidders_List where BidderID='".$_SESSION['BidderID']."'");
		 list($recordcount,$row1)=MainselectfuncNew($result1,$array = array());
		$m=0;			
			
while($m<count($row1))
        {
				$_SESSION['Date'] = $row1[$m]['Dated'];
				$_SESSION['city'] = $row1[$m]['City'];
				$_SESSION['ReplyType'] =$_SESSION['ReplyType'].",".$row1[$m]['Reply_Type'];
				$_SESSION['ReplyType'];
				$m = $m +1;
		}
			 /* Dump Resultset */
			mysql_free_result($result);
			mysql_free_result($result1);
			$IP = getenv("REMOTE_ADDR");
			
		
			
	//$sql = "INSERT INTO Bidders_Login_Details (BidderID,Bidder_Name, Last_Login_Date, IP_Address, Product_Type, City ) Values ('".$_SESSION['BidderID'] ."', '".$_SESSION['UName']."',  Now(), '$IP', '".$_SESSION['ReplyType']."' ,'".$_SESSION['city']."' )";
    // ExecQuery($sql);
   $dataInsert = array("BidderID"=>$_SESSION['BidderID'], "Bidder_Name"=>$_SESSION['UName'], "Last_Login_Date"=>$Dated, "IP_Address"=>$IP, "Product_Type"=>$_SESSION['ReplyType'], "City"=>$_SESSION['city']);
$table = 'Bidders_Login_Details';
$insert = Maininsertfunc ($table, $dataInsert);
   
   $last_inserted_value = mysql_insert_id();
   $_SESSION['last_inserted_value'] = $last_inserted_value;

   
  			$today = date("Y-m");
			
			$explodeToday = explode("-",date("Y-m-d"));
			$field_date =  $explodeToday[2];
			$fielddate = "Date_".$field_date;
			//$fielddate = "date_02";
			$todayinput =  date("Y-m-d H:i:s");
            $selectDate =$today."-01 00:00:00";
			$inputmonth = date("m");
			
		   $checkBidderSQL = "select * from BiddersLoginDetails where BidderID ='".$_SESSION['BidderID'] ."' and  First_Login_Date>='".$selectDate."'";
			
			$checkBidderQUERY = ExecQuery($checkBidderSQL);
			$checkBidderNumRows = mysql_num_rows($checkBidderQUERY);
			$checkBidderROW = mysql_fetch_array($checkBidderQUERY);
			$z = mysql_result($checkBidderQUERY,0,$fielddate);
			//echo "hello".$z;
			if($z > 0)
				$countofDate = $z+1;
			else 
				$countofDate = 1;
					
			if($checkBidderNumRows>0)
			{	
			  	//$sqlTrackBidder = "update BiddersLoginDetails set  ".$fielddate." = ".$countofDate." where BidderID = '".$_SESSION['BidderID'] ."' and First_Login_Date>='".$selectDate."' and Month_Details = $inputmonth";
				$sqlTrackBidder = "update BiddersLoginDetails set  ".$fielddate." = ".$countofDate." where BidderID = '".$_SESSION['BidderID'] ."' and Month_Details = $inputmonth";
				//echo $sqlTrackBidder;
			
			}
			else 
			{
			 	$sqlTrackBidder = "INSERT INTO BiddersLoginDetails (BidderID, Bidder_Name, First_Login_Date, ".$fielddate.", Month_Details ) Values ('".$_SESSION['BidderID'] ."', '".$_SESSION['UName']."',  '".$todayinput ."', $countofDate, $inputmonth)";
				//echo $sqlTrackBidder;
			}
		
 		  ExecQuery($sqlTrackBidder);

   
				//echo "hello";
			header("Location: edu_index.php");
			exit;
		}
		else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}
	}
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />


    
   <style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}

.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
</style>
  <Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.Email, 'Email', 4))
	{
		return false;
	}
	var str=theFrm.Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
					return false;
					}
	if(!checkData(theFrm.PWD, 'Password', 3))
		return false;
	return true;
    }
 </Script>
 <body style="margin:0px; padding:0px; background-color:#45B2D8;">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse" valign="top">
	 <tr bgcolor="#FFFFFF">
	 <Td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="323" height="93" align="left" valign="top"><img src="images/login-logo.gif" width="323" height="93" /></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="67" align="right" bgcolor="#C6E3F2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></Td>
   </tr>
	 <tr>
		<td style="padding-top:15px;">&nbsp;</td>
   </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td align="center">
		 
	 </td>
   </tr>
	 <tr>
    <td bgcolor="#45B2D8" ><table width="361"   border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="361" height="43" align="center" valign="middle"><img src="images/login-form-topshine-bg.gif" width="361" height="43"></td>
        </tr>
        <tr>
          <td height="156" align="center" valign="middle" background="images/login-form-login-bg.gif"><form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
			<table width="250" border="0" cellpadding="4" cellspacing="0">
			   
			   <tr>
				 <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
			   </tr>
			   <tr>
				 <td width="100%" class="style1">Username</td>
				 <td width="100%"><input type="text" name="Email" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="100%" class="style1">Password</td>
				 <td width="100%"><input type="password" name="PWD" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="100%" colspan="2" align="center"><input name="submit" type="image"  src="images/login-form-lgn-sbtn.gif" style="width:111px; height:35px; border:none;"></td>
			   </tr>
		  </table>
		 </form>
          </td>
        </tr>
        <tr>
          <td width="361" height="70" align="center" valign="middle"><img src="images/login-form-bot-shine-bg.jpg" width="361" height="70"></td>
    </tr>
  </table></td>
  </tr>
</table>
 
</body>
</html>

