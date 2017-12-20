<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$UserID = $_SESSION['UserID'];
		$finalurl=$_POST["PostURL"];
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
		$pubid = $_REQUEST['pubid']; // used by ad2click only 19 nov2016
		$From_Product = $_REQUEST['From_Product'];
		$City_Other = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$Annual_Turnover = FixString($Annual_Turnover);
		$REFERER_URL = $_POST["REFERER_URL"];
		$accept = FixString($accept);
		$Reference_Code = generateNumber(4);
		$Dated=ExactServerdate();
		$Updated_Date=ExactServerdate();
		$edelweiss="";
		$cpp_card_protect="";
		$Std_Code1="";
		$Phone1="";
		$Direct_Allocation="";
		$IsProcessed="";
			
		$IsPublic = 1;
		$n       = count($From_Product);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];
		$IP = $_SERVER["HTTP_X_REAL_IP"];

$Type_Loan="Req_Loan_Personal";

if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1)
{
	$validname=0;
}
else
		{
	$validname=1;
		}

		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($Name!="") && strlen($City)>0 && $validname==1 && $source!='komlipl')
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9811555306,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	if($alreadyExist>0)
	{
		$ProductValue=$myrow['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";
	}
	else
	{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$myrow1)=Mainselectfunc($CheckSql,$array = array());
			if($CheckNumRows>0)
			{
				$UserID = $myrow1["UserID"];
				$pldata = array("UserID" => $UserID,  "Name" => $Name,  "Email" => $Email,  "Employment_Status" => $Employment_Status,  "Company_Name" => $Company_Name,  "City" => $City,  "City_Other" => $City_Other,  "Mobile_Number" => $Phone,  "Std_Code" => $Std_Code1,  "Landline" => $Phone1,  "Net_Salary" => $Net_Salary,  "CC_Holder" => $CC_Holder,  "Loan_Amount" => $Loan_Amount,  "DOB" => $DOB,  "Dated" => $Dated,  "Pincode" => $Pincode,  "source" => $source,  "CC_Bank" => $From_Pro,  "Card_Vintage" => $Card_Vintage, "Referrer" => $REFERER_URL,  "Creative" => $Creative,  "Section" => $Section,  "Updated_Date" => $Updated_Date,  "IP_Address"=> $IP ,  "Reference_Code" => $Reference_Code,  "Direct_Allocation" => $Direct_Allocation,  "IsProcessed" => $IsProcessed,  "Edelweiss_Compaign" => $edelweiss,  "Cpp_Compaign" => $cpp_card_protect,  "Annual_Turnover" => $Annual_Turnover, "Privacy"=> $accept);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID1 = Maininsertfunc("wUsers", $wUsersdata);
				$pldata = array("UserID" => $UserID1,  "Name" => $Name,  "Email" => $Email,  "Employment_Status" => $Employment_Status,  "Company_Name" => $Company_Name,  "City" => $City,  "City_Other" => $City_Other,  "Mobile_Number" => $Phone,  "Std_Code" => $Std_Code1,  "Landline" => $Phone1,  "Net_Salary" => $Net_Salary,  "CC_Holder" => $CC_Holder,  "Loan_Amount" => $Loan_Amount,  "DOB" => $DOB,  "Dated" => $Dated,  "Pincode" => $Pincode,  "source" => $source,  "CC_Bank" => $From_Pro,  "Card_Vintage" => $Card_Vintage, "Referrer" => $REFERER_URL,  "Creative" => $Creative,  "Section" => $Section,  "Updated_Date" => $Updated_Date,  "IP_Address"=> $IP ,  "Reference_Code" => $Reference_Code,  "Direct_Allocation" => $Direct_Allocation,  "IsProcessed" => $IsProcessed,  "Edelweiss_Compaign" => $edelweiss,  "Cpp_Compaign" => $cpp_card_protect,  "Annual_Turnover" => $Annual_Turnover, "Privacy"=> $accept);
				//echo "<br>else".$InsertProductSql;
				}
			$ProductValue = Maininsertfunc("Req_Loan_Personal", $pldata);
			
if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
	
			$_SESSION['Temp_LID'] = $ProductValue;
			list($First,$Last) = split('[ ]', $Name);

	
	if((strlen(strpos($finalurl, "apply-personal-loans-bnrcamp.php")) > 0) || (strlen(strpos($finalurl, "requestpersonal-loans-new.php")) > 0) || (strlen(strpos($finalurl, "get-personal-loan-digital.php")) > 0) || $source=="komlipl" || $source=="timesmobpl"  || $source=="logicserve"  || $source=="dgm_ploct13" || $source=="infomedia" || $source=="hindustantimes" || $source=="inuxu_oct13" || $source=="netcorepl" || $source=="pyxelconnectpl" || $source=="icubespl" || $source=="ibiboplnw" || $source=="monsterpl" || $source=="yahoopl" || $source=="creditvidyaPL" || $source=="allbankngsolnPL" || $source=="investmentyogiPL" || $source=="valuefirstpl" || $source=="blueearthpl" || $source=="clickZootpl" || $source=="proformicspl" || $source=="monsterplnw" || (strncmp("CCPN", $source,4))==0 || $source=="shopatbestpl" || $source=="vcommissionpl" || $source=="cardekhopl" || $source=="pkonlinepl" || $source=="svgmediapl" || $source=="ammv3pl" || $source=="ammbctpl" || $source=="AFL_MLR_OPTMED_PL" || $source=="AFL_MLR_OPICLE_PL" || $source=="AFL_MLR_POINTIFIC_PL" || $source=="AFL_MLR_LEADSUTRA_PL" || $source=="AFL_WFMLR_CARTRADE_PL" || $source=="AFL_MLR_ADCANOPUSPIVOT_PL" || $source=="AFL_WFMLR_CARTRADE_PL" || $source=="AFL_MLR_LEADSUTRA_PL" || $source=="AFL_D4LMLR_SHOPCLUES_PL" || $source=="AFL_D4LMLR_LUCINI_PL" || $source=="AFL_MLR_AD2CLICK_PL" || $source=="AFL_MLR_LEADSUTRA_NEW_PL" || $source=="AFL_MLR_PROFILIAD_PL")
		{
			$SMScampMessage = "Please use this code: ".$Reference_Code." to activate your loan request at deal4loans.com";
		if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMScampMessage, $Phone);
		}
	
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailtocommonproduct.php";
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Personal Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Personal Loan";
	
	$headers = "From: deal4loans <no-reply@deal4loans.com>";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
	    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $Message2 . "\n\n";
					
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $message, $headers);
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
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>
<div id="pagewrap">
<header id="header_continue">
<div id="continue_logo"><img src="new-images/pl/deal4loans-continue-logo.jpg"></div></header>
<div style="clear:both;"></div>
<br><br>

<div class="pl_cont_text" style="color:#136071;" align="center">Save Upto Rs. 25000* by comparison on your EMI</span>. Please verify your Mobile Number. <br />We have sent an activation code on <span style="color: #D02037;"><? echo $Phone; ?></div>
  <div id="continue_form" style="margin-top:10px;">
 <table width="60%" border="0" align="center" cellpadding="2" cellspacing="0">     
      <tr>
      <td colspan="2" align="center">
	  <? if((strncmp("CCPN", $source,4))==0)
	  { ?>
      <form name="bnrvalidate" method="POST" action="pl_thank_formbased.php">
	  <? }
	  else
	  { ?> 
		<form name="bnrvalidate" method="POST" action="apply-personal-loans-bnrcampcontinue.php">
		<input type="hidden" name="pubid" id="pubid" value="<? echo $pubid; ?>">
	  <? } ?>
      <input type="hidden" value="<? echo $ProductValue;?>" name="plrequestid" id="plrequestid">
       <input type="hidden" value="<? echo $Reference_Code;?>" name="reference_code" id="reference_code">
	   <input type="hidden" value="<? echo $Employment_Status; ?>" name="Employment_Status" id="Employment_Status">
	   <input type="hidden" value="<? echo $strcity; ?>" name="City" id="City">
      <table cellpadding="5">
      <tr>
      	<td height="35">Activation Code</td>
        <td><input type="text" name="activation_code" id="activation_code"></td>
      </tr>
      <tr>
      	<td colspan="2" align="center" height="50"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " tabindex="13" /></td>
      </tr>
      </table>
      </form></td></tr>
  </table>
</div>
</div>
</body>
</html>