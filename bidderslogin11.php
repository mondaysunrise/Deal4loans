<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_destroy();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Email = $_POST["Email"];
		$PWD = $_POST["PWD"];
		//$Name = $_POST["Name"];
		$pdo = db_connect_PDO();

		$stmt = $pdo->prepare('SELECT * FROM Bidders WHERE Email = :email and  PWD = :pwd and Is_Verified>1');
		$stmt->execute(array('email' => $Email, 'pwd'=> $PWD));
		$num_rows = $stmt->rowCount();
		$_SESSION['ReplyType']=" ";
		if($num_rows>0)
					{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			 $BidderID= $row["BidderID"];
			$Email= $row["Email"];
			$Global_Access_ID = $row['Global_Access_ID'];
			$_SESSION['DefinePrePost'] = $row['Define_PrePost'];
			$_SESSION['product']= $row["Reply_Type"];
			$_SESSION['leadidentifier']= $row["leadidentifier"];
			$_SESSION['Process_Name']= $row["Process_Name"];
			$_SESSION['CallStatus']= $row["CallStatus"];
			setSessionBidder($Email, $row);
			$result1 = ExecQuery("Select BankID,Reply_Type,Dated,City from Bidders_List where BidderID='".$_SESSION['BidderID']."'");
					
			while($row1=mysql_fetch_array($result1))
			{
				$_SESSION['Date'] = $row1['Dated'];
				$_SESSION['city'] = $row1['City'];
				$_SESSION['ReplyType'] = $_SESSION['ReplyType'].",".$row1['Reply_Type'];
				$_SESSION['ReplyType'];
				$_SESSION['BankID'] = $row1['BankID'];
			}
		/* Dump Resultset */
		mysql_free_result($result);
		mysql_free_result($result1);
		$IP_Remote = $_SERVER["REMOTE_ADDR"];
		if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
		else { $IP= $IP_Remote;	}
		
		$sqlbidseid = "INSERT INTO bidders_session_details (sessionid, bidderid, product, ip_address, login_date) VALUES ('".$_SESSION["our_session"]."', '".$_SESSION['BidderID']."', '".$row["Reply_Type"]."', '".$IP."', Now())";
		ExecQuery($sqlbidseid);
	   //$last_inserted_value = mysql_insert_id();

		$sql = "INSERT INTO Bidders_Login_Details (BidderID,Bidder_Name, Last_Login_Date, IP_Address, Product_Type, City ) Values ('".$_SESSION['BidderID'] ."', '".$_SESSION['UName']."',  Now(), '$IP', '".$_SESSION['ReplyType']."' ,'".$_SESSION['city']."' )";
		 ExecQuery($sql);
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
			  	$sqlTrackBidder = "update BiddersLoginDetails set  ".$fielddate." = ".$countofDate." where BidderID = '".$_SESSION['BidderID'] ."' and Month_Details = $inputmonth";
				//echo $sqlTrackBidder;
			}
			else 
			{
			 	$sqlTrackBidder = "INSERT INTO BiddersLoginDetails (BidderID, Bidder_Name, First_Login_Date, ".$fielddate.", Month_Details ) Values ('".$_SESSION['BidderID'] ."', '".$_SESSION['UName']."',  '".$todayinput ."', $countofDate, $inputmonth)";
				//echo $sqlTrackBidder;
			}
	
 		  ExecQuery($sqlTrackBidder);
			$strDir = dir_name();

			if($_SESSION['BidderID']==1050 || $_SESSION['BidderID']==1000 || $_SESSION['BidderID']==1015 || $_SESSION['BidderID']==1012 || $_SESSION['BidderID']==1037 || $_SESSION['BidderID']==996 || $_SESSION['BidderID']==1023)
			{
				global $Msg;
				$Msg =  "** Invalid Email. Please try again **";
			}
			else if($row1['Reply_Type']==9 || $_SESSION['ReplyType']==9 || $row["Reply_Type"]==9)
			{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bidders_eduview.php");
				 exit;
			}
			else if($_SESSION['BidderID']==5202 && ($IP=="192.168.20.123" || $IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="1.23.114.53" || "185.93.231.12"))
			{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."citibank_pl_4505view.php");
				exit;
			}
			else if($_SESSION['BidderID']==6168 || $_SESSION['BidderID']==6254 || $Global_Access_ID==6168)
			{
				if($Global_Access_ID==6168)
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."sbihl_callingindividualview.php");
					exit;
				}
				else
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."sbihl_callingview.php");
					exit;
				}
			}
			elseif($_SESSION['BidderID']==6319)
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."sbihl_callingview_int.php");
					exit;
				}
			elseif($_SESSION['BidderID']==7341 || $_SESSION['BidderID']==7342)
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."sbihl_callingview_calleracct.php");
					exit;
				}
			elseif($_SESSION['BidderID']==6492)
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bobbidders_index.php");
					exit;
				}
                        elseif($_SESSION['BidderID']==6507)
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bidders_update_feedback_upload.php");
					exit;
				}
              elseif($_SESSION['BidderID']==5933 || $_SESSION['BidderID']==5934 || $_SESSION['BidderID']==7102 || $_SESSION['BidderID']==7103 || $_SESSION['BidderID']==7179  || $_SESSION['BidderID']==7185)
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bidders_hdfc_index.php");
					exit;
				}
			elseif($_SESSION['leadidentifier']=="CallerAccount" || $_SESSION['leadidentifier']=="Fullertonpllms" || $_SESSION['leadidentifier']=="Fullertonpllms7444")
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."callers_callingview.php");
					exit;
				}
			elseif($_SESSION['leadidentifier']=="ConsolidateCallerAccount")
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."callers_consolidate.php");
					exit;
				}
                                elseif($_SESSION['BidderID']==7340)
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."consolidate-lms-list.php");
					exit;
				}
			elseif($_SESSION['leadidentifier']=="CallerAccountICICI" || $_SESSION['leadidentifier']=="CallerAccountTata" || $_SESSION['leadidentifier']=="CallerAccountOICICI" || $_SESSION['leadidentifier']=="CallerAccountBTata" || $_SESSION['leadidentifier']=="CallerAccountHTata" || $_SESSION['leadidentifier']=="CallerAccountMICICI" || $_SESSION['leadidentifier']=="CallerAccountCICICI" || $_SESSION['leadidentifier']=="CallerAccountMTata" || $_SESSION['leadidentifier']=="CallerAccountCTata" || $_SESSION['leadidentifier']=="CallerAccountPTata" || $_SESSION['leadidentifier']=="CallerAccountPICICI" || $_SESSION['leadidentifier']=="CallerAccountABFL" || $_SESSION['leadidentifier']=="AccountFullertonProcess" || $_SESSION['leadidentifier']=="CallerAccountRBLDMP" || $_SESSION['leadidentifier']=="CallerAccountRBLBHC" || $_SESSION['leadidentifier']=="CallerAccountINDUSINDDMP" || $_SESSION['leadidentifier']=="CallerAccountINDUSINDBCH" || $_SESSION['leadidentifier']=="CallerAccountRBLDH" || $_SESSION['leadidentifier']=="CallerAccountDialingDMP" || $_SESSION['leadidentifier']=="CallerAccountDialingBCH"|| $_SESSION['leadidentifier']=="CallerAccountQBERABCD" || $_SESSION['leadidentifier']=="CallingHDFCBL" || $_SESSION['leadidentifier']=="CallerAccountINDUSINDCKP" || $_SESSION['leadidentifier']=="CallingIncredDM" || $_SESSION['leadidentifier']=="PL_ICICI_BCDHKMP" || $_SESSION['leadidentifier']=="tatacapitalcalling" || $_SESSION['leadidentifier']=="ICICISALAccount" || $_SESSION['leadidentifier']=="CallerAccountQBERAMETRO" || $_SESSION['leadidentifier']=="CallerAccountCFLAllCity" || $_SESSION['leadidentifier']=="CallerAccountINDUSINDALL" || $_SESSION['leadidentifier']=="CallerAccountAPKTata" ||  $_SESSION['leadidentifier']=="CallingUploadBL" || $_SESSION['leadidentifier']=="CallerAccountCFL" || $_SESSION['leadidentifier']=="CallerAccountIIFL" || $_SESSION['leadidentifier']=="CallerAccountRBLMCK" || $_SESSION['leadidentifier']=="tatacapitalBcalling" || $_SESSION['leadidentifier']=="CallerAccountICICIBangalore" || $_SESSION['leadidentifier']=="CallerAccountINDUSINDCLK")
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."callers_calling_index.php");
					exit;
				}
			elseif($_SESSION['BidderID']==6251)
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."citibankcc_leadsview.php");
					exit;
				}
			else
			{
			if($_SESSION['BidderID']==1059) //not active
			{
				 //header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."citi_pl_index.php");
				 //	exit;
				 global $Msg;
				$Msg =  "** Your are Not authorised **";
			}
			else if($_SESSION['BidderID']==4505 || $_SESSION['BidderID']==5202) //not active
			{
				// header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."citibank_pl_4505view.php");
				//		exit;
				global $Msg;
				$Msg =  "** Your are Not authorised **";
			}
			else if($_SESSION['BidderID']==3838)//not active
			{
				// header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."amex_leadsview.php");
				//exit;
				global $Msg;
				$Msg =  "** Your are Not authorised **";
			}
			else if($_SESSION['BidderID']==1728)//not active
			{
				 //header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."stanc_common_index.php");
				  //exit;
				 global $Msg;
				$Msg =  "** Your are Not authorised **";
			}
			else if($_SESSION['BidderID']==2009)//not active
			{
				// header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bidders_index_hdfc.php");
				// exit;
				global $Msg;
				$Msg =  "** Your are Not authorised **";
			}
			else if($_SESSION['BidderID']==1778)
			{
				 //header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."hdfcpl_consolidate_view.php");
				 //exit;
				 global $Msg;
					$Msg =  "** Your are Not authorised **";
			}
			else if($_SESSION['BidderID']==1023)
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."fullerton_majorcty_view.php");
				 exit;
			}
			else if($_SESSION['BidderID']==5202)
			{
				global $Msg;
				$Msg =  "** Your are Not authorised **";
			}
			elseif($_SESSION['BidderID']==4664)
				{
					 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."scb_zonewise_index.php");
				 exit;
				}
			else if($_SESSION['BidderID']==1796 || $_SESSION['BidderID']==1797 || $_SESSION['BidderID']==1798 || $_SESSION['BidderID']==1799 || $_SESSION['BidderID']==1800 || $_SESSION['BidderID']==1801 || $_SESSION['BidderID']==1802 || $_SESSION['BidderID']==1803)
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."stanc_cc_view.php");
				 exit;
			}
			elseif($_SESSION['BidderID']==6392)
				{
					 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bidders_consolidate.php");
				 exit;
				}
			else if($_SESSION['BidderID']==1830 || $_SESSION['BidderID']==1831 || $_SESSION['BidderID']==1832 || $_SESSION['BidderID']==1833 || $_SESSION['BidderID']==1834 || $_SESSION['BidderID']==1835 || $_SESSION['BidderID']==1836 || $_SESSION['BidderID']==1837 || $_SESSION['BidderID']==1838 || $_SESSION['BidderID']==1839 || $_SESSION['BidderID']==1840 || $_SESSION['BidderID']==1841 || $_SESSION['BidderID']==1842 || $_SESSION['BidderID']==1843 || $_SESSION['BidderID']==1844 || $_SESSION['BidderID']==1845 || $_SESSION['BidderID']==1846 || $_SESSION['BidderID']==1847 || $_SESSION['BidderID']==1848 || $_SESSION['BidderID']==1849 || $_SESSION['BidderID']==1850 || $_SESSION['BidderID']==1851 || $_SESSION['BidderID']==1852 || $_SESSION['BidderID']==1853 || $_SESSION['BidderID']==1854)
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."hdfc_cl_individual_view.php");
				 exit;
			}
			else if($_SESSION['BidderID']==1825)
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."hdfc_cl_view.php");
				 exit;
			}
			else if($_SESSION['BidderID']==1794)
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."stanc_cccommon_view.php");
				 exit;
			}
			else if($_SESSION['BidderID']==1992)
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."dhflcm_view.php");
				 exit;
			}
			else if($_SESSION['BidderID']==4931 || $_SESSION['BidderID']==4936 || $_SESSION['BidderID']==5023 || $_SESSION['BidderID']==4952 || $_SESSION['BidderID']==4957 || $_SESSION['BidderID']==5027 || $_SESSION['BidderID']==5033 || $_SESSION['BidderID']==4932 || $_SESSION['BidderID']==5374 || $_SESSION['BidderID']==4939 || $_SESSION['BidderID']==5024 || $_SESSION['BidderID']==5025 || $_SESSION['BidderID']==4950 || $_SESSION['BidderID']==4963 || $_SESSION['BidderID']==4966 || $_SESSION['BidderID']==5001)
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."hdfcpl_citywise_view.php");
				 exit;
			}			
			else
			{
				//echo "hello";
				if(($_SESSION['BidderID']==6503 || $_SESSION['BidderID']==2125 || $_SESSION['BidderID']==2270 || $_SESSION['BidderID']==2325 || $_SESSION['BidderID']==2408 || $_SESSION['BidderID']==2501 || $_SESSION['BidderID']==2565 || $_SESSION['BidderID']==2724 || $_SESSION['BidderID']==2725 || $_SESSION['BidderID']==2847 || $_SESSION['BidderID']==2913 || $_SESSION['BidderID']==2920 || $_SESSION['BidderID']==2924 || $_SESSION['BidderID']==2976 || $_SESSION['BidderID']==3081 || $_SESSION['BidderID']==3345 || $_SESSION['BidderID']==3395 || $_SESSION['BidderID']==3427 || $_SESSION['BidderID']==3522 || $_SESSION['BidderID']==3526 || $_SESSION['BidderID']==3599 || $_SESSION['BidderID']==2414 || $_SESSION['BidderID']==3727 || $_SESSION['BidderID']==3888 || $_SESSION['BidderID']==4093 || $_SESSION['BidderID']==6732 || $_SESSION['BidderID']==6733 || $_SESSION['BidderID']==4394 || $_SESSION['BidderID']==4487 || $_SESSION['BidderID']==4833 || $_SESSION['BidderID']==5069 || $_SESSION['BidderID']==5155 || $_SESSION['BidderID']==5191 || $_SESSION['BidderID']==5304 || $_SESSION['BidderID']==5312 || $_SESSION['BidderID']==5356 || $_SESSION['BidderID']==5398 || $_SESSION['BidderID']==5459 || $_SESSION['BidderID']==5550 || $_SESSION['BidderID']==5567  || $_SESSION['BidderID']==5500 || $_SESSION['BidderID']==5788 || $_SESSION['BidderID']==5799 || $_SESSION['BidderID']==5878 || $_SESSION['BidderID']==5901 || $_SESSION['BidderID']==5957 || $_SESSION['BidderID']==6028 || $_SESSION['BidderID']==6078 || $_SESSION['BidderID']==6100 || $_SESSION['BidderID']==6112 || $_SESSION['BidderID']==6096 || $_SESSION['BidderID']==6119 || $_SESSION['BidderID']==6148 || $_SESSION['BidderID']==6167 || $_SESSION['BidderID']==6387 || $_SESSION['BidderID']==6679) || 				
				(($_SESSION['BidderID']==2679 || $_SESSION['BidderID']==5264 || $_SESSION['BidderID']==2680 || $_SESSION['BidderID']==2997 || $_SESSION['BidderID']==2454 || $_SESSION['BidderID']==2663 || $_SESSION['BidderID']==5373 || $_SESSION['BidderID']==5654 || $_SESSION['BidderID']==6147 || $_SESSION['BidderID']==6279|| $_SESSION['BidderID']==6538 || $_SESSION['BidderID']==6448 || $_SESSION['BidderID']==6575 || $_SESSION['BidderID']==6582 || $_SESSION['BidderID']==6898 || $_SESSION['BidderID']==6921 || $_SESSION['BidderID']==6913 || $_SESSION['BidderID']==6903 || $_SESSION['BidderID']==6888 || $_SESSION['BidderID']==6893 || $_SESSION['BidderID']==6883 || $_SESSION['BidderID']==7084 || $_SESSION['BidderID']==7180 || $_SESSION['BidderID']==7236  || $_SESSION['BidderID']==7479 || $_SESSION['BidderID']==7480) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.58" || $IP=="182.73.4.59" || $IP=="182.73.4.60" || $IP=="182.73.4.61" || $IP=="182.73.4.62" || $IP=="182.71.109.218" || $IP=="115.249.245.30" || $IP=="180.151.74.83" || $IP=="1.23.114.53" || "185.93.231.12")))
				{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bidders_consolidate.php");
					exit;
				}
				else
				{	
					if(($_SESSION['BidderID']==2679 || $_SESSION['BidderID']==5264 || $_SESSION['BidderID']==2680 || $_SESSION['BidderID']==2997 || $_SESSION['BidderID']==2454 || $_SESSION['BidderID']==2663 || $_SESSION['BidderID']==5373 || $_SESSION['BidderID']==5654 || $_SESSION['BidderID']==6147))
					{
						global $Msg;
						$Msg =  "** Invalid Email. Please try again **";
					}
					else
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bidders_index.php");
					exit;
					}
			}
			}
			}//else		
				}				
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
   <?php
   $getCheckSql = "select BidderID from Bidders where Bidders like '%Yes%' and Reply_Type=4";
   $getCheckQuery = d4l_ExecQuery($getCheckSql);
   $getCheckNumRows = d4l_mysql_num_rows($getCheckQuery);
   if($getCheckNumRows>0) {} else {
   ?>
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
	<?php } ?>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td align="center">
		 
	 </td>
   </tr>
	 <tr>
    <td bgcolor="#45B2D8" align="center"><table width="361"   border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="361" height="43" align="center" valign="middle"><img src="images/login-form-topshine-bg.gif" width="361" height="43"></td>
        </tr>
        <tr>
          <td height="156" align="center" valign="middle" background="images/login-form-login-bg.gif"><form method="post" action="<? //echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
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
 <script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-1312775-1', 'deal4loans.com');
ga('require', 'displayfeatures');
ga('send', 'pageview');
</script>
</body>
</html>

