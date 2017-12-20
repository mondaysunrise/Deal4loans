<?php
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	require 'getlistof_ppbajajbidders.php';
	
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.58" || $IP=="182.73.4.59" || $IP=="182.73.4.60" || $IP=="182.73.4.61" || $IP=="182.73.4.62" || $IP=="182.71.109.218")){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$leadid = FixString($leadid);
		if($leadid>0)
		{
		$bidderslist = FixString($bidderslist);
		$checkbidder = FixString($checkbidder);
	//$bidderslist = substr($bidderslist, 0, strlen($bidderslist)-1); //remove the final comma sign from the final array

if(strlen($bidderslist)>2)
	{
		$upbidders="Update Req_Loan_Personal set Bidderid_Details='".$bidderslist."', Allocated=2 Where (RequestID=".$leadid.")";
		//echo "Update Req_Loan_Personal set Bidderid_Details='".$arrFinalBidder."', Allocated=2 Where (RequestID=".$ProductValue.")";

		$upbiddersresult = ExecQuery($upbidders);
	}	
	header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/bajajfinserv_mlrentry.php");
						exit;
	}
	else
		{
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Loan_Amount= FixString($Loan_Amount);
		$Pincode = FixString($Pincode);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Employment_Status = FixString($Employment_Status);
		$Card_Vintage = FixString($Card_Vintage);
		$Email = FixString($Email);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
		$Company_Type = $_REQUEST['Company_Type'];
		$Residential_Status = $_REQUEST['Residential_Status'];
		$Primary_Acc= $_REQUEST['Primary_Acc'];
		$Loan_Any = $_REQUEST['Loan_Any'];
		$EMI_Paid = $_REQUEST['EMI_Paid'];
		$Credit_Limit = $_REQUEST['Credit_Limit'];
		$Total_Experience = $_REQUEST['Total_Experience'];
		$Years_In_Company = $_REQUEST['Years_In_Company'];
		$leadid = $_REQUEST['leadid'];
		$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
		
	if($City=="Others")
	{
		if(strlen($Other_City)>0)
		{
			$strCity=$Other_City;
		}
		else
		{
			$strCity=$City;
		}
	}
	else
	{
		$strCity=$City;
	}
		
if(($validMobile==1) && ($Name!="") && strlen($City)>0) 
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	//echo $getdetails."<br>";
	//exit();
	$checkavailability = ExecQuery($getdetails);
	$alreadyExist = mysql_num_rows($checkavailability);
	$myrow = mysql_fetch_array($checkavailability);

	if($alreadyExist>0)
	{
		$ProductValue=$myrow['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "Lead already exist";

	}
	else
	{	
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Dated, Pincode,  source, CC_Bank, Card_Vintage,Referrer, Updated_Date, IP_Address, Company_Type, PL_EMI_Amt, Primary_Acc, Residential_Status, Card_Limit, Years_In_Company, Total_Experience, EMI_Paid, Loan_Any)
				VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', Now(), '$Pincode','$source','$From_Pro','$Card_Vintage','$REFERER_URL',Now(),'$IP', '".$Company_Type."','".$PL_EMI_Amt."','".$Primary_Acc."','".$Residential_Status."' ,'".$Credit_Limit."','".$Years_In_Company."','".$Total_Experience."','".$EMI_Paid."','".$Loan_A."')";
			//	echo "<br>if".$InsertProductSql;
			
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID1 = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Dated, Pincode, source, CC_Bank, Card_Vintage,Referrer,Updated_Date, IP_Address, Company_Type, PL_EMI_Amt, Primary_Acc, Residential_Status, Card_Limit, Years_In_Company, Total_Experience, EMI_Paid, Loan_Any)
VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', Now(), '$Pincode', '$source','$From_Pro','$Card_Vintage','$REFERER_URL', Now(),'$IP','".$Company_Type."','".$PL_EMI_Amt."','".$Primary_Acc."','".$Residential_Status."' ,'".$Credit_Limit."','".$Years_In_Company."','".$Total_Experience."','".$EMI_Paid."','".$Loan_A."')";
				//echo "<br>else".$InsertProductSql;
				}
			//echo "hello>".$InsertProductSql."<br>";
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();

			list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$ProductValue,$strCity);
	
		$arrFinalBidder=implode(',',$FinalBidder);
}
	
}
		}
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<table align="center">
<tr><td>
<form name="personalloan_form"  action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="leadid" id="leadid" value="<? echo $ProductValue; ?>">
<input type="hidden" name="bidderslist" id="bidderslist" value="<? echo $arrFinalBidder; ?>">
<input type="hidden" name="checkbidder" id="checkbidder" value="1">
<? if($checkbidder==1)
{ ?>
<table width="95%"  border="0" align="right" cellpadding="2" cellspacing="0">
				<tr align="left">
				  <Td colspan="2" height="35" align="center"> <b>Thank you</b></Td>				 
				  </tr>
				  </table>
<? }
else {?>
<table width="95%"  border="0" align="right" cellpadding="2" cellspacing="0">
				<tr align="left">
				  <Td colspan="2" height="35" align="center"> <b>Personal Loan Form (Bajaj Finserv)</b></Td>				 
				  </tr>
				<tr align="left">
				  <Td height="35" align="center"></Td><td><?php  for($i=0;$i<count($FinalBidder);$i++)
			{ echo $finalBidderName[$i]."(".$FinalBidder[$i].")<br>";
			} ?></td>				 
				  </tr>
           
            <tr>
              <td  colspan="2" align="left"  >&nbsp;</td>
            </tr>            		 				
				<tr align="center">
				  <Td colspan="2"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></Td>
				  </tr>
                </table>
		<? } ?>
				</form>
				</td></tr>
				</table>
</body>
</html>
