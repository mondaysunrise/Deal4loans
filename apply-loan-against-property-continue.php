<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'eligiblebidderfuncLAP.php';


$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="LAP Site Page";
}

$page_Name = "LoanAgainstProperty";
  if ($_SESSION['flag']==1)
		{
		$source="partner1";
		}


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
			$UserID = $_SESSION['UserID'];

		/* FIX STRINGS */
		 
		$FName = FixString($FName);
		$LName = FixString($LName);
		$Name=$FName." ".$LName;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Age= $_REQUEST["Age"];
		$Activate =FixString($Activate);
		
		$Phone = FixString($Phone);
		$Phone1 = FixString($Phone1);
		$Phone2 = FixString($Phone2);
		$Std_Code1 = FixString($Std_Code1);
		$Std_Code2 = FixString($Std_Code2);
		$Employment_Status = FixString($Employment_Status);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Total_Experience = FixString($Total_Experience);
		$Net_Salary = FixString($Net_Salary);
		$Residential_Status = FixString($Residential_Status);
		$Residence_Address = FixString($Residence_Address);
		$Property_Type = FixString($Property_Type);
		$Property_Value = FixString($Property_Value);
		$Loan_Amount = FixString($Loan_Amount);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Descr = FixString($Descr);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$surrogate = FixString($surrogate);
		$hdfclife = FixString($hdfclife);
		$accept = FixString($accept);
		$ABMMU_flag = $_REQUEST["adty_brl"];
		$Reference_Code = generateNumberNEWc(5);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
        $IsPublic = 1;
		if(strlen($Age)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$Age;
			$DOB = $year."-".$date;
		}
		else
		{
			$DOB=$Year."-".$Month."-".$Day;
		}
		//$IP = getenv("REMOTE_ADDR");
		//$IP= $_SERVER['HTTP_X_REAL_IP'];
		$IP=ExactCustomerIP();
                $Type_Loan="Req_Loan_Against_Property";
		$Ibibo_compaign = FixString($Ibibo_compaign);
		if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where  IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}

if($_SESSION=="")
		{
		$_SERVER['Temp_Type'] = "PropertyLoan";
		$_SERVER['Temp_Name'] = $Name;
		$_SERVER['Temp_FName'] = $FName;
		$_SERVER['Temp_LName'] = $LName;
		$_SERVER['Temp_Phone'] = $Phone;
		$_SERVER['Temp_Phone1'] = $Phone1;
		$_SERVER['Temp_Phone2'] = $Phone2;
		$_SERVER['Temp_Std_Code1'] = $Std_Code1;
		$_SERVER['Temp_Std_Code2'] = $Std_Code2;
		$_SERVER['Temp_DOB'] = $DOB;
		$_SERVER['Temp_Email'] = $Email;
		$_SERVER['Temp_Flag'] = "0";
		$_SERVER['Temp_Employment_Status'] = $Employment_Status;
		$_SERVER['Temp_Company_Name'] = $Company_Name;
		$_SERVER['Temp_City'] = $City;
		$_SERVER['Temp_City_Other'] = $City_Other;
		$_SERVER['Temp_Total_Experience'] = $Total_Experience;
		$_SERVER['Temp_Net_Salary'] = $Net_Salary;
		$_SERVER['Temp_Residential_Status'] = $Residential_Status;
		$_SERVER['Temp_Residence_Address'] = $Residence_Address;
		$_SERVER['Temp_Property_Type'] = $Property_Type;
		$_SERVER['Temp_Property_Value'] = $Property_Value;
		$_SERVER['Temp_Loan_Amount'] = $Loan_Amount;
		$_SERVER['Temp_Descr'] = $Descr;
		$_SERVER['Temp_IsPublic'] = $IsPublic;
		}
		else
		{
		$_SESSION['Temp_Type'] = "PropertyLoan";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_FName'] = $FName;
		$_SESSION['Temp_LName'] = $LName;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_Phone1'] = $Phone1;
		$_SESSION['Temp_Phone2'] = $Phone2;
		$_SESSION['Temp_Std_Code1'] = $Std_Code1;
		$_SESSION['Temp_Std_Code2'] = $Std_Code2;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_Email'] = $Email;
		$_SESSION['Temp_Flag'] = "0";
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		$_SESSION['Temp_Company_Name'] = $Company_Name;
		$_SESSION['Temp_City'] = $City;
		$_SESSION['Temp_City_Other'] = $City_Other;
		$_SESSION['Temp_Total_Experience'] = $Total_Experience;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		$_SESSION['Temp_Residential_Status'] = $Residential_Status;
		$_SESSION['Temp_Residence_Address'] = $Residence_Address;
		$_SESSION['Temp_Property_Type'] = $Property_Type;
		$_SESSION['Temp_Property_Value'] = $Property_Value;
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_Descr'] = $Descr;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		}


function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
		$Sql = "INSERT INTO ibibo_compaign_leads ( ibibo_product , ibibo_requestid , ibibo_name,  ibibo_city, ibibo_mobile, ibibo_dob , ibibo_car_name,  ibibo_dated, ibibo_email ) VALUES ( '5','".$ProductValue."','".$Name."','".$City."', '".$Phone."' ,'".$DOB."', '".$Ibibo_compaign."', Now(),'".$Email."')";
		$query = ExecQuery($Sql);
		//echo "Edelweiss:".$Sql."<br>";
		//exit();
	}

$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Against_Property  Where (Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."' and Mobile_Number not in (9971396361,9811215138,9891118553) ) order by RequestID DESC";
			//echo $getdetails."<br>";
			//exit();
			$checkavailability = ExecQuery($getdetails);
			$alreadyExist = mysql_num_rows($checkavailability);
			$myrow = mysql_fetch_array($checkavailability);
		
			if($alreadyExist>0)
			{
				$ProductValue=$myrow['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-property-loan-lead.php'"."</script>";
			}
			else
			{
			
		
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
			if(($validMobile==1) && ($Name!=""))
{		
list($First,$Last) = split('[ ]', $Name);

				
			
			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO Req_Loan_Against_Property (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Total_Experience, Net_Salary, Residential_Status, Property_Type, Property_Value, Loan_Amount, Descr, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Contact_Time, Pincode, Residence_Address, source,Accidental_Insurance,Updated_Date, Reference_Code,Any_Surrogate,IP_Address, ABMMU_flag, Privacy)
					VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Std_Code2', '$Phone2', '$Total_Experience', '$Net_Salary', '$Residential_Status', '$Property_Type', '$Property_Value', '$Loan_Amount', '$Descr', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Contact_Time', '$Pincode', '$Residence_Address', '$source','$Accidental_Insurance',Now(), '".$Reference_Code."', '".$surrogate."','".$IP."', '".$ABMMU_flag."', '".$accept."' )"; 
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Loan_Against_Property (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Total_Experience, Net_Salary, Residential_Status, Property_Type, Property_Value, Loan_Amount, Descr, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Contact_Time, Pincode, Residence_Address, source,Accidental_Insurance,Updated_Date, Reference_Code,Any_Surrogate,IP_Address, ABMMU_flag, Privacy)					VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Std_Code2', '$Phone2', '$Total_Experience', '$Net_Salary', '$Residential_Status', '$Property_Type', '$Property_Value', '$Loan_Amount', '$Descr', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Contact_Time', '$Pincode', '$Residence_Address', '$source','$Accidental_Insurance',Now(), '".$Reference_Code."', '".$surrogate."', '".$IP."','".$ABMMU_flag."', '".$accept."' )";
				//echo "<br>else".$InsertProductSql;
			}
//echo "<br>else".$InsertProductSql."<br><br>";
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();
			$lastInserted = $ProductValue;
			
			
			//Send SMS
			ProductSendSMStoRegis($Phone);
			
//exit();			
			$_SESSION['ProductValue'] = $ProductValue;
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Against_Property");
				}
			
	if($City=="Others")
	{
		$strcity=$City_Other;
	}
	else
	{	
		$strcity=$City;
	}

	if($hdfclife==1)
		{
			$Product=5;
			Insert_HdfcLife($Name, $strcity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}

/*	if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($ProductValue, $Name, $strcity, $Phone, $DOB, $Ibibo_compaign, $Email);
		}*/
			//exit();

		$lastInserted = $ProductValue;
		//$client_transaction_id = $lastInserted."_LAP";
		
			
		
if($lastInserted>0)
		{

		list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Against_Property",$lastInserted,$strcity);

		}	
	if(count($FinalBidder)>0 || $source=="LAP RBL testpage")
	{
			$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

			if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMSMessage, $Phone);
	}
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
				$SubjectLine = $FName.", Learn to get Best Deal on Loan Against Property";
			else
				$SubjectLine = "Learn to get Best Deal on Loan Against Property";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
		if(count($finalBidderName)==0 && $source!="LAP RBL testpage")
		{
			header("Location: apply-loan-against-property-thanks.php");
				exit();
		}

			}
		
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL = $_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
		
		}
		}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />  
<title>Apply and Compare Loans Against Property India - Deal4loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<meta name="keywords" content="Loan Against Property India, Apply Loan Against Property, Compare Loan Against Property in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore" />
<link href="source.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<!--top-->
<!--logo navigation-->
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto;  height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="loan-against-property.php"  class="text12" style="color:#0080d6;"><u>Loan Against Property</u></a> <a href="#"  class="text12" style="color:#4c4c4c;">> Apply Loan Against Property</a></div>
<div style="clear:both; height:25px;"></div>
<div class="text12" style="margin:auto;">    
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="3" >
      <tr>
     <td>

	  <form name="lap_verify" action="apply-loan-against-property-thanks.php" method="post">
         <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $lastInserted; ?>" />
	 <input type="hidden" name="source" value="<? echo $retrivesource; ?>" />
	 <input type="hidden" name="Reference_Code" id="Reference_Code" value="<? echo $Reference_Code; ?>" /> 
     
     <div class="apply-hl-form" style="background:#21405f;"> 
     <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="text3" style=" color:#fff; font-size:16px; text-transform:none; font-weight:bold; line-height:25px;">To get quotes and Compare offers from all Banks and <span style="color: #D02037;"> Save Upto Rs. 1 lac * by comparison on your EMI</span>. Please verify your Mobile Number. <br />We have sent an activation code on <span style="color: #D02037;"><? echo $Phone; ?></span>
</div></td>
  </tr>
</table>
     <div class="apply-hl-input-wapper" style="margin-top:15px;">
       <table width="98%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td class="formhlwpbody-text" style="color:#FFF;">Activation Code:</td>
         </tr>
         </table>
     </div>

<div class="apply-hl-input-wapper" style="margin-top:15px; margin-bottom:10px;">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="formhlwpbody-text">  <input name="activation_code" id="activation_code" type="text" class="emi_input" onkeydown="validateDiv('nameVal');"  maxlength="5"/></td>
    </tr>
    </table>
</div>
<div class="apply-hl-input-wapper" style="margin-bottom:20px;">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="formhlwpbody-text">  <input type="image" src="http://www.deal4loans.com/images/wp-loan-get-quote.png" value=""/></td>
    </tr>
    </table>
</div>
<div style="clear:both; height:15px;"></div>

     </div>
               </form>
     </td>
      </tr>
		   <tr>
            <td  height="25" align="center" class="frmbldtxt"  style="font-weight:normal; color:#000000; font-size:14px;" colspan="2" >
			1) In next screen get Rates, EMI , Processing Fee information.<br />
			2) Compare EMI and <span style="color: #D02037;">Save upto Rs. 1lac on interest.</span><br />
			3) Help in processing your loan   faster.<br />
             4) Gives you best offer.                </td>
           
          </tr>
      <tr><td>&nbsp;</td></tr>
    </table>
</div>
<div style="clear:both; height:15px;"></div></div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>
<? function generateNumberNEWc($plength)
{
	if(!is_numeric($plength) || $plength <= 0)
	{
	    $plength = 8;
	}
	if($plength > 32)
	{
	    $plength = 32;
	}

	$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	mt_srand(microtime() * 1000000);
	for($i = 0; $i < $plength; $i++)
	{
	   $key = mt_rand(0,strlen($chars)-1);
	   $pwd = $pwd . $chars{$key};
	}
	   for($i = 0; $i < $plength; $i++)
	{
	    $key1 = mt_rand(0,strlen($pwd)-1);
	    $key2 = mt_rand(0,strlen($pwd)-1);

	    $tmp = $pwd{$key1};
	    $pwd{$key1} = $pwd{$key2};
	    $pwd{$key2} = $tmp;
	}

	return $pwd;
}
?>