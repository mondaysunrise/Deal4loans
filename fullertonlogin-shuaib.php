<?php 
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	 $_SESSION["our_session"] =session_id();
	
	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		formHandler();

	function formHandler(){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$result = "select * from Bidders where Email='$Email' and PWD='$PWD' and Is_Verified>1";
		list($num_rows,$row) = MainselectfuncNew($result,$array = array());
		$myrowcontr=count($row)-1;

		$IP = $_SERVER['REMOTE_ADDR'];
	
if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.100.29" || $IP=="122.176.122.134" || $_SERVER["HTTP_X_REAL_IP"]=="122.176.100.28" || $_SERVER["HTTP_X_REAL_IP"]=="122.176.100.27" || $_SERVER["HTTP_X_REAL_IP"]=="122.176.100.29" || $_SERVER["HTTP_X_REAL_IP"]=="122.176.122.134"))
		{
		$_SESSION['ReplyType']=" ";
	
		if($num_rows > 0){
			 /* Get Resultset */
			
			$Global_Access_ID = $row[$myrowcontr]['Global_Access_ID'];
			$_SESSION['DefinePrePost'] = $row[$myrowcontr]['Define_PrePost'];
			$_SESSION['product']= $row[$myrowcontr]["Reply_Type"];

			 /* Create Session Variables */
			setSessionBidder($Email, $row[$myrowcontr]);
		$result1 = "Select Reply_Type,Dated,City from Bidders_List where BidderID='".$_SESSION['BidderID']."'";
		list($num_rows1,$row1) = MainselectfuncNew($result1,$array = array());
		$myrowcontr	=count($row1)-1;

		for($j=0;$j<$num_rows1;$j++)
		{
				$_SESSION['Date'] = $row1[$j]['Dated'];
				$_SESSION['city'] = $row1[$j]['City'];
				$_SESSION['ReplyType'] =$_SESSION['ReplyType'].",".$row1[$j]['Reply_Type'];
				$_SESSION['ReplyType'];
		}
			$IP = $_SERVER["HTTP_X_REAL_IP"];
			$Dated = ExactServerdate();
	 	
		$data = array("sessionid"=>$_SESSION["our_session"] , "bidderid"=>$_SESSION['BidderID'], "product"=>$row["Reply_Type"], "ip_address"=>$IP, "login_date"=>$Dated );
		$table = 'bidders_session_details';
		$insert = Maininsertfunc ($table, $data);
		 $dataInsert = array("BidderID"=>$_SESSION["BidderID"] , "Bidder_Name"=>$_SESSION['UName'], "Last_Login_Date"=>$Dated, "IP_Address"=>$IP, "Product_Type"=>$row["ReplyType"], "City"=>$_SESSION['city'] );
		$table = 'bidders_session_details';
		$last_inserted_value = Maininsertfunc ('Bidders_Login_Details', $dataInsert);
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
			list($checkBidderNumRows,$checkBidderQUERY)=MainselectfuncNew($checkBidderSQL,$array = array());
			$checkBidderQUERYcontr=count($checkBidderQUERY)-1;
			$z = $checkBidderQUERY[$checkBidderQUERYcontr][$fielddate];
			//echo "hello".$z;
			if($z > 0)
				$countofDate = $z+1;
			else 
				$countofDate = 1;
					
			if($checkBidderNumRows>0)
			{	
			  	$dataUpdate = array($fielddate=>$countofDate);
				$wherecondition = "(BidderID = '".$_SESSION['BidderID'] ."' and Month_Details = $inputmonth)";
				Mainupdatefunc ('BiddersLoginDetails', $dataUpdate, $wherecondition);
				//echo $sqlTrackBidder;
			}
			else 
			{
				 $dataInsert = array("BidderID"=>$_SESSION["BidderID"] , "Bidder_Name"=>$_SESSION['UName'], "First_Login_Date"=>$todayinput, $fielddate=>$countofDate, "Month_Details"=>$inputmonth );
				$last_inserted_value = Maininsertfunc ('Bidders_Login_Details', $dataInsert);
			
			}

		
 	

   
			 /* Redirect browser */
			 $strDir = dir_name();
			// echo $_SESSION['BidderID'];
		if($_SESSION['BidderID']==1023)
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."fullerton_majorcty_view.php");
				 exit;
			}
		else if($_SESSION['BidderID']==1050 || $_SESSION['BidderID']==1000 || $_SESSION['BidderID']==1015 || $_SESSION['BidderID']==1012 || $_SESSION['BidderID']==1037 || $_SESSION['BidderID']==996)
		{
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bidders_index.php");
			exit;
		}
		else
		{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}
			
		}
		else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}
		}
		else
		{
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
		<td style="padding-top:15px;">
			<table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >
		
				<tr>
				  <td width="669" height="174" align="left" valign="top" bgcolor="#FFFFFF"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="52" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Debt Consolidation From Deal4Loans</h1></td>
  </tr>
  <tr>
    <td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#052733; line-height:18px;">Deal4Loans has always been a pioneer in providing innovative solutions to its stakeholders. Since the last two months, Deal4Loans has been providing loan seekers in India an option to consolidate their current outstanding loans/credit. We seek detailed information from customers about their individual queries and then structure a debt consolidation plan, specific to their needs.
				      <br/>
                  <a href="debt-consolidation-query.php" target="_blank" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:18px; text-decoration:underline;">Click Here to see <b>More than 100</B> cases of <b>Debt Consolidation</b> where we have structured a solution for customers.</a></td>
  </tr>
</table>
</td>
			  </tr>
		  </table>
		</td>
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

