<? 
require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();


	$Msg = "";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		formHandler();

	function formHandler(){
		foreach($_POST as $a=>$b)
			$$a=$b;
		
		$result = "select * from Bidders where (Email='$Email' and PWD='$PWD' and BidderID=4843)";
		list($num_rows,$row) = Mainselectfunc($result,$array = array());
		$_SESSION['ReplyType']=" ";
		$IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}

 if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134")
			{
		if($num_rows > 0){
			 /* Get Resultset */
			
			$Global_Access_ID = $row['Global_Access_ID'];
			$_SESSION['DefinePrePost'] = $row['Define_PrePost'];
			$_SESSION['product']= $row["Reply_Type"];
			$Count_Replies = $row["Count_Replies"];
			 /* Create Session Variables */
			setSessionBidder($Email, $row);
	
		$result1 = "Select BankID,Reply_Type,Dated,City from Bidders_List where BidderID='".$_SESSION['BidderID']."'";
		list($num_rows1,$row1) = MainselectfuncNew($result1,$array = array());
		for($j=0;$j<$num_rows1;$j++)			
		{
				$_SESSION['Date'] = $row1[$j]['Dated'];
				$_SESSION['city'] = $row1[$j]['City'];
				$_SESSION['ReplyType'] =$_SESSION['ReplyType'].",".$row1[$j]['Reply_Type'];
		
				$_SESSION['ReplyType'];
				$_SESSION['BankID'] = $row1[$j]['BankID'];
		}
			 /* Dump Resultset */
			mysql_free_result($result);
			mysql_free_result($result1);
			$IP = $_SERVER["HTTP_X_REAL_IP"];
				
		$dataInsert = array("sessionid"=>$_SESSION["our_session"] , "bidderid"=>$_SESSION['BidderID'], "product"=>$row["Reply_Type"], "ip_address"=>$IP, "login_date"=>$Dated);
		$last_inserted_value = Maininsertfunc ('bidders_session_details', $dataInsert);
	
		$dataInsert = array("BidderID"=>$_SESSION["BidderID"] , "Bidder_Name"=>$_SESSION['UName'], "Last_Login_Date"=>$Dated, "IP_Address"=>$IP, "Product_Type"=>$row["ReplyType"], "City"=>$_SESSION['city'] );
		$last_inserted_value = Maininsertfunc ('Bidders_Login_Details', $dataInsert);


   $_SESSION['last_inserted_value'] = $last_inserted_value;
   
  		header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/bajajfinserv_callinglms.php");
				exit;
		}	
		else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
			
		}
		}
			else{
			global $Msg;
			$Msg =  "** Your are not Authorized **";
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
