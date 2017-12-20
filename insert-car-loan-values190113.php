<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'eligiblebidderfuncCL.php';
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$last_id = FixString($last_id);
		$Phone = FixString($Phone);
		$Email = FixString($Email);
		$Activate = FixString($Activate);
		$City = FixString($City);
		$Car_Type = FixString($Car_Type);
		$Employment_Status = FixString($Employment_Status);
		$Car_Insurance = FixString($Car_Insurance);
		$City_Other = FixString($City_Other);
		$Pincode = FixString($Pincode);
		$Net_Salary = FixString($Net_Salary);
		$Ibibo_compaign = FixString($Ibibo_compaign);
		$Car_Model = FixString($Car_Model);
		$Car_Varient = FixString($Car_Varient);
		$Loan_Tenure = FixString($Loan_Tenure);
		$Car_Booked = FixString($Car_Booked);
		$Loan_Amount = FixString($Loan_Amount);
		$cpp_card_protect = FixString($cpp_card_protect);
		$hdfclife = FixString($hdfclife);
		$bajaj_Allianz = FixString($bajaj_Allianz);
		$accept = FixString($accept);
		$cldelivery_date = FixString($cldelivery_date);
		$From_Product = $_REQUEST['From_Product'];
		$Net_Salary_Monthly = $Net_Salary / 12;
		$IsPublic = 1;
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Reference_Code = generateNumberNEWc(5);
		$IP = getenv("REMOTE_ADDR");
		$QArequestid = $_REQUEST["QArequestid"];
		$ABMMU_flag = $_REQUEST["adty_brl"];
		
		$n       = count($From_Product);
		$i      = 0;
		//echo $n."<br>";
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		  
$final_url=$_SERVER['HTTP_REFERER'];
$_SESSION['final_url'] = $final_url;
$_SESSION['Net_Salary'] = $Net_Salary;
$_SESSION['City']= $City;
$_SESSION['City_Other']= $City_Other;
$QArequestid = $_SESSION['Temp_Last_Inserted'];

$Type_Loan="Req_Loan_Car";


if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}

	function  bajaj_allianz($ProductValue, $Name, $Email, $City, $Phone, $DOB, $Income, $Car_Type )
	{
		$Dated = ExactServerdate();
		$dataInsert = array('requestid'=>$ProductValue, 'name'=>$Name, 'email'=>$Email, 'city'=>$City, 'phone'=>$Phone, 'dob'=>$DOB, 'income'=>$Income, 'car_type'=>$Car_Type, 'dated'=>$Dated);
		$insert = Maininsertfunc ('bajajallianz_carloancomp', $dataInsert);
	}

		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		/*if($crapValue=='Put')
		{*/
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Car Where ( Mobile_Number not in (9971396361,9999570210,9811215138,9811555306,9873678914) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
	if($alreadyExist>0 && $source!="CLQuickapply")
	{
		$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-car-loan-lead.php'"."</script>";

	}
	else
	{
		if($source=="CLQuickapply")
		{
			$ProductValue=$myrow['RequestID'];
			$dataUpdate = array('ABMMU_flag'=>$ABMMU_flag, 'Employment_Status'=>$Employment_Status, 'City'=>$City, 'City_Other'=>$City_Other, 'Loan_Amount'=>$Loan_Amount, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Pincode'=>$Pincode, 'Dated=Now(),Car_Type'=>$Car_Type, 'Car_Model'=>$Car_Model);
			$wherecondition = "(RequestID =".$QArequestid.")";
			Mainupdatefunc ('Req_Loan_Car', $dataUpdate, $wherecondition);
			 $lastInserted = $QArequestid;
			$_SESSION['Temp_LID'] = $lastInserted;
			$client_transaction_id = $lastInserted."_CL";
			if($City=="Others")
		{
			$strCity = $City_Other;
		}
		else
		{
			$strCity = $City;
		}

			if($lastInserted>0)
		{
			list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$lastInserted,$strCity);
		}
			
		}
		else
		{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				
			//	echo "<br>if".$InsertProductSql;
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Car_Type'=>$Car_Type, 'Dated'=>$Dated, 'source'=>$source, 'Pincode'=>$Pincode, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Car_Insurance'=>$Car_Insurance, 'Accidental_Insurance'=>$Accidental_Insurance, 'Car_Varient'=>$Car_Varient, 'Car_Model'=>$Car_Model, 'Updated_Date'=>$Dated, 'Email'=>$Email, 'Loan_Tenure'=>$Loan_Tenure, 'Cpp_Compaign'=>$cpp_card_protect, 'Car_Booked'=>$Car_Booked, 'Reference_Code'=>$Reference_Code, 'ABMMU_flag'=>$ABMMU_flag, 'Delivery_Date'=>$cldelivery_date, 'Privacy'=>$accept);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Car_Type'=>$Car_Type, 'Dated'=>$Dated, 'source'=>$source, 'Pincode'=>$Pincode, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Car_Insurance'=>$Car_Insurance, 'Accidental_Insurance'=>$Accidental_Insurance, 'Car_Varient'=>$Car_Varient, 'Car_Model'=>$Car_Model, 'Updated_Date'=>$Dated, 'Email'=>$Email, 'Loan_Tenure'=>$Loan_Tenure, 'Cpp_Compaign'=>$cpp_card_protect, 'Car_Booked'=>$Car_Booked, 'Reference_Code'=>$Reference_Code, 'ABMMU_flag'=>$ABMMU_flag, 'Delivery_Date'=>$cldelivery_date, 'Privacy'=>$accept);
			}
			//echo $InsertwUsersSql."<br>";
				$ProductValue = Maininsertfunc ('Req_Loan_Car', $dataInsert);
		}
			
			$lastInserted = $ProductValue;
			$_SESSION['Temp_LID'] = $ProductValue;
			$client_transaction_id = $lastInserted."_CL";

if($lastInserted>0)
		{
			list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$lastInserted,$strCity);
		}


	if(count($finalBidderName)>0)
		{
			$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

			if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMSMessage, $Phone);
			//$zipdimage = mobile_verify($Phone,$client_transaction_id);
		}

		if($bajaj_Allianz==1)
		{
			bajaj_allianz ($ProductValue, $Name, $Email, $City, $Phone, $DOB, $Net_Salary, $Car_Type); 	
		}

if($City=="Others")
		{
			$strCity = $City_Other;
		}
		else
		{
			$strCity = $City;
		}
			
		if($hdfclife==1)
		{
			$Product=3;
			Insert_HdfcLife($Name, $strCity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}


		
		if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}

			list($First,$Last) = split('[ ]', $Name);

			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Car Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Car Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
		
	if(count($finalBidderName)==0)
		{
		if(strlen($Email)>0)
			{
			$Message="<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $Name,</b><p>As per your profile, no bank is associated with us to serve your <b>Car loan</b> requirement. We will not be able to service your request and hence we are not sharing your details with any bank.</p><p>&nbsp; <br />
  Regards</p>
Team Deal4loans.com <br /><br /></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Loan Quiz</a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Loan Guru </a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.in?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Askamitoj.com</a> </td></tr></table></td></tr></table>";
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testthankuse@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($Email,'Thanks for Registering for Car Loan on deal4loans.com', $Message, $headers);
			}

			header("Location: thank_cl.php");
				exit();
		}

	}

		}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Car Loans | Apply Car Loans online | Compare Car Loans</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>

</head>
<body><?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car Loan</u></a> <span  class="text12" style="color:#4c4c4c;">> Apply Car Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">    
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="3" >
      <tr>
     <td>
      <? if($source=="CLQuickapply")
	  {$lastInserted = $QArequestid; }?>
	  <form name="car_loan_verify" action="thank_cl.php" method="post">
         <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $lastInserted; ?>" >
	 <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
	 <input type="hidden" name="Reference_Code" id="Reference_Code" value="<? echo $Reference_Code; ?>">     
       <table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <tr>
        <td height="55" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><div class="text3" style=" color:#FFF; font-size:16px; text-transform:none; font-weight:bold; line-height:25px;">To get quotes and Compare offers from all Banks and <span style="color: #D02037;"> Save Upto Rs. 25000* by comparison on your EMI</span>. Please verify your Mobile Number. <br />We have sent an activation code on <span style="color: #D02037;"><? echo $Phone; ?></span>
</div></td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F"><table width="895" border="0" cellpadding="0" cellspacing="0">
          <tr>
            
            <td width="600" align="left" valign="top"><table width="598" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="173" height="60">
                      <div class="text" style=" float:left; width:170px; height:auto; color:#FFF; font-size:14px; text-transform:none;">Activation Code:</div></td><td width="214" height="50"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">
                        <input name="activation_code" id="activation_code" type="text" style="width:100px; height:18px;" onkeydown="validateDiv('nameVal');"  maxlength="5"/>
  
                      </div></td><td width="211" align="center" valign="top"><div style=" width:114px; height:47px; margin-top:0px; margin-left:0px; margin-right:23px;">  <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td>
                </tr>
             </table></td>
         </tr>
       </table></td>
      </tr>
      <tr>
        <td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table></form>
     </td>
      </tr>
		   <tr>
            <td  height="25" align="center" class="frmbldtxt"  style="font-weight:normal; color:#000000;" colspan="2" >
			1) Get call back assistance on <span style="color: #D02037;">verified mobile number</span> directly from all the comparable banks within 24 hours. <br />
2) Compare EMI and <span style="color: #D02037;">save Upto Rs. 25000 on interest</span> .<br />
3) Provides you with the best suitable offers.<br /> 
4) Help in processing your loan faster.         </td>
           
          </tr>
      <tr><td>&nbsp;</td></tr>
    </table>
</div>
<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
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