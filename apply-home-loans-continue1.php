<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
//cho "uh";

function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		$City = $_POST['City'];
		$Property_Identified= $_POST['Property_Identified'];
		$Property_Loc= $_POST['Property_Loc'];
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$dob_arr[] = $_POST['year'];
		$dob_arr[] = $_POST['month'];
		$dob_arr[] = $_POST['day'];
		$dateofbirth = implode("-", $dob_arr);
		$company_name = $_POST['company_name'];
		$Employment_Status = $_POST['Employment_Status'];
		$Net_Salary = $_POST['Net_Salary'];
		$monthly_income = ($Net_Salary /12);
		$obligations = $_POST['obligations'];
		$loan_amount = $_POST['Loan_Amount'];
		$co_appli = $_POST['co_appli'];
		$co_name = $_POST['co_name'];
		$dob_arr_co[] = $_POST['co_year'];
		$dob_arr_co[] = $_POST['co_month'];
		$dob_arr_co[] = $_POST['co_day'];
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = $_POST['co_monthly_income'];
		$co_obligations = $_POST['co_obligations'];
		$property_value = $_POST['property_value'];
		$Pincode = $_POST['Pincode'];
		$hdfclife = $_POST['hdfclife'];
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$Activate = $_POST['Activate'];
		$Type_Loan = "Req_Loan_Home";
		$source = $_POST['source'];
		$Creative = $_POST['creative'];
		$Section = $_POST['section'];
		$Accidental_Insurance = $_POST['Accidental_Insurance'];
		$Referrer=$_REQUEST['referrer'];
		$IP = getenv("REMOTE_ADDR");
		$netAmount=($getnetAmount - $total_obligation);
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		$edelweiss = $_POST["edelweiss"];
		
		//$getDOB = str_replace("-","", $dateofbirth);
$age =$DOB;
//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;
//echo $exactage."<br>";
//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;
	
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}

function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
		$Sql = "INSERT INTO ibibo_compaign_leads ( ibibo_product , ibibo_requestid , ibibo_name,  ibibo_city, ibibo_mobile, ibibo_dob , ibibo_car_name,  ibibo_dated, ibibo_email  ) VALUES ( '2','".$ProductValue."','".$Name."','".$City."', '".$Phone."' ,'".$DOB."', '".$Ibibo_compaign."', Now(),'".$Email."')";
		$query = mysql_query($Sql);
		//echo "Edelweiss:".$Sql."<br>";
		//exit();
	}

		$crap = " ".$Name." ".$Email." ".$City_Other;
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
			
			$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			//echo $getdetails."<br>";
			//exit();
			$checkavailability = ExecQuery($getdetails);
			$alreadyExist = mysql_num_rows($checkavailability);
			$myrow = mysql_fetch_array($checkavailability);
		
			if($alreadyExist>0)
			{
				$ProductValue=$myrow['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
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
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance,Property_Identified,Employment_Status,DOB,  	  Property_Loc,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income,Co_Applicant_Obligation,Property_Value, Total_Obligation, Edelweiss_Compaign, Pincode) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$loan_amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance','$Property_Identified','$Employment_Status','$dateofbirth','$Property_Loc','$co_name','$DOB_co','$co_monthly_income','$co_obligations','$property_value','$obligations','".$edelweiss."' , '".$Pincode."' )"; 
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance,Property_Identified,Employment_Status,DOB,  	  Property_Loc,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income,Co_Applicant_Obligation,Property_Value, Total_Obligation, Edelweiss_Compaign, Pincode) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$loan_amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance','$Property_Identified','$Employment_Status','$dateofbirth','$Property_Loc','$co_name','$DOB_co','$co_monthly_income','$co_obligations','$property_value','$obligations', '".$edelweiss."','".$Pincode."' )";
				//echo "<br>else".$InsertProductSql;
			}
			
			//echo $InsertProductSql."<br>";
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();
	
			if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}

		if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($ProductValue, $Name, $strcity, $Phone, $DOB, $Ibibo_compaign, $Email);
		}
		
		if($hdfclife==1)
		{
			$Product=2;
			Insert_HdfcLife($Name, $strcity, $Phone, $dateofbirth, $Email, $Net_Salary, $Product, $ProductValue );
		}
			list($First,$Last) = split('[ ]', $Name);

			
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan";
			
			if(strlen(trim($Phone)) > 0)
			{
				//SendSMS($SMSMessage, $Phone);
				NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			}
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$FName=$Name;
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
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
$_SESSION['ProductValueHL'] = $ProductValue;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Type="text/javascript">
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function taxinsertData()
		{
			var get_netSalary = document.getElementById('netSalary').value;
			var get_DOB = document.getElementById('DOB').value;
			var get_agecalc = document.getElementById('agecalc').value;
			
			
			if(get_netSalary!='')
			{
				var queryString = "?netSalary=" + get_netSalary + "&dob=" + get_DOB + "&agecalc=" + get_agecalc ;
			}
			
			//alert(queryString); 
				ajaxRequest.open("GET", "insert_pension_premimum.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
					
						var ajaxDisplay = document.getElementById('calculate');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					   

				
					}
				}

				ajaxRequest.send(null); 
			 
		}

		window.onload = ajaxFunction;
		</script>

</head>
<style>
.bnk_logo{
	width:105px;
	height:35px;
	padding-left:4px;
	padding-top:0px;
	*padding-top:11px;
}

.colprop{
color:#373737;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
line-height:15px;

}
</style>
<body>
<?php include '~Top-new.php';?>
<?php //include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
  <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a call from us.
  
  </h1>

<?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);
$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0)
	{
		//echo "hello1: ";
		 
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
}?>


 <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);

$Final_Bid = "";
		while (list ($key,$val) = @each($bankID)) { 
			$Final_Bid[]= $val; 
		} 

$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0 )
	 {

	?>
	
<div align="center"><b>Your EMI and Rates Quotes for the Home Loan from partner Banks are listed Below.
</b></div>
<div align="left" style="padding-left:40px; padding-bottom:3px; padding-top:3px;">
We at deal4loans.com believe that its big financial decision that you
are about to take.<br />
To get best deal, speak to 3 - 4 banks mentioned below and then decide
upon the best deal.<br />
This will help you get best deal & save on Emi & choose best product &
best service.
</b>
</div>
	
     <table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" background="new-images/hl-thnk-hdr1.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td width="141" height="30" class="fontbld10"><b>Bank Name</b></td>
            <td width="191" class="fontbld10"><b>Interest Rate</b> </td>
           <!-- <td width="205" class="fontbld10"><b>EMI (Per Lac)</b></td> -->
            <td width="205" class="fontbld10"><b>EMI (Per Month)</b></td>
            <td width="65" class="fontbld10"><b>Tenure</b></td>
            <td width="127" class="fontbld10"><b>Eligible Loan Amount</b></td>
            <td width="229" class="fontbld10"><b>Request for more Information</b></td>
          </tr>
        </table></td>
      </tr>
    
          <?
for($i=0;$i<count($Final_Bid);$i++)
	{
	
		?>
		 <td height="70" background="new-images/hl-thnk-bnkbg1.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
                  <?
    if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($axisviewLoanAmt>0)
		{
		?>
		  <td width="145" height="30"><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 	  <? echo $Final_Bid[$i]; ?></td>		  
		  <td width="192" align="center"  class="colprop"><?php echo $axisinter; ?> %</td>
		  <!--<td width="201" align="center"  class="colprop">Rs. <?php //echo  $axisperlacemi; ?> </td> -->
            <td width="201" align="center"  class="colprop">Rs. <?php echo $axisemi; ?> </td>
		  <td width="66"  class="colprop"><?php echo abs($axisprint_term); ?> yrs.</td>
		  <td width="132"  class="colprop">Rs. <?php echo abs($axisviewLoanAmt); ?></td>
		  <td width="224" align="center" class="colprop">
          <form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 167px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(new-images/ne_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
          </td>
  <? }
  else
		{ ?>
		<td width="145" height="30"  ><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
<td   bgcolor="#FFFFFF" height="57" colspan="5"><b><form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 167px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(new-images/ne_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></b></td>
	<? 	}
	}

	
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{
		list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		?> 
		<td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-idbi.gif" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td width="192" align="left"  class="colprop"><?php echo $idbiinter; ?> %</td>
		<!--<td width="201" align="left"  class="colprop">Rs. <?php //echo  $idbiperlacemi; ?></td> -->
        <td width="201" align="center"  class="colprop">Rs. <?php echo $idbiemi; ?></td>
		<td width="66"  class="colprop"><?php echo abs($idbiprint_term); ?> yrs.</td>
		<td width="132"  class="colprop">Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
<!--		<td width="224" align="left"  class="colprop">Rs. <?php //echo $idbiemi; ?></td> -->
         <td width="224" align="center" class="colprop"><form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 167px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(new-images/ne_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
		<?
		
	}
	elseif($Final_Bid[$i]=="LIC Housing" || $Final_Bid[$i]=="LIC")
	{
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	?>
		  <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-lic.gif" width="86" height="20" /><br />  <? echo $Final_Bid[$i]; ?></td>		
		  <td width="192" align="left"  class="colprop"><?php echo $licinter; ?> %</td>
		<!--  <td width="201" align="left"  class="colprop"><?php //echo $licperlacemi; ?></td> -->
           <td width="201" align="center"  class="colprop"><?php echo $licemi; ?></td>
		   <td width="66"  class="colprop"><?php echo $licprint_term; ?> yrs.</td>
		   <td width="132"  class="colprop"><?php echo "Rs.".$licviewLoanAmt; ?></td>
<!--		  <td width="224" align="left"  class="colprop"><?php //echo $licemi; ?></td> -->
           <td width="224" align="center" class="colprop"><form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 167px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(new-images/ne_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
		  <?
	}
	elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
?>
	   <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
  <? echo $Final_Bid[$i]; ?></td>	
	  <td width="192" align="left" class="colprop" ><? echo $iciciinter; ?> %</td>
	  <!--<td width="201" align="left" class="colprop"> <?php //echo $iciciperlacemi; ?></td> -->
       <td width="201" align="center" class="colprop"> <?php echo $iciciactualemi; ?></td>
	 <td width="66" class="colprop"><?php echo abs($iciciprint_term); ?> yrs.</td>
	  <td width="132" class="colprop">Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
	<!--   <td width="224" align="left" class="colprop"><?  //echo $iciciactualemi; ?></td> -->
        <td width="224" align="center" class="colprop"><form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 167px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(new-images/ne_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
	  <?
	
	}
	elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank" || $Final_Bid[$i]=="HDFC Ltd")
	{
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
?>
	 <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
  <? echo $Final_Bid[$i]; ?></td>
	  <td width="192" align="left" class="colprop"><?php echo $hdfcinter; ?></td>
	  <td width="201" align="center" class="colprop" ><?php echo $hdfcemi; //echo  $hdfcperlacemi; ?></td>
	  <td width="66" class="colprop"><?php echo abs($hdfcprint_term); ?> yrs.</td>
	  <td width="132" class="colprop">Rs. <?php echo $hdfcviewLoanAmt; ?></td>
	<!--   <td width="224" align="left" class="colprop"><?php //echo $hdfcemi; ?></td> -->
     <td width="224" align="center" class="colprop"><form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 167px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(new-images/ne_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
	  <?
}
elseif($Final_Bid[$i]=="First Blue Home Finance" || $Final_Bid[$i]=="First Blue" || (strncmp ("First", $Final_Bid[$i],5))==0)
	{
		if($Employment_Status==0)
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSE($getnetAmount,$age,$total_obligation,$property_value,$Property_Identified);
		}
		else
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSal($getnetAmount,$age,$total_obligation,$property_value,$Property_Identified);
		}
		
?>
	 <td width="145" height="55" ><img src="http://www.deal4loans.com/new-images/first-blue-logo.jpg" width="95"  /></td>
	  <td width="192"  class="colprop"><?php echo $frstblinter; ?> %</td>
<!--	  <td width="201" class="colprop" >Rs. <?php //echo  $perlacemi; ?></td> -->
       <td width="201" class="colprop"  >Rs. <?php echo  $frstblactualemi; ?></td>
	  <td width="66" class="colprop"><?php echo $frstblterm; ?> yrs.</td>
	  <td width="132" class="colprop">Rs. <?php echo $frstblloan_amount; ?></td>
<!--	   <td width="224"  class="colprop">Rs. <?php echo $frstblactualemi; ?></td> -->
        <td width="224" align="center" class="colprop"><form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 167px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(new-images/ne_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
	  <?
}
	else
	{
		if($Final_Bid[$i]=="Citibank" || $Final_Bid[$i]=="Citi Bank")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-citibnk.jpg" width="86" height="20" />';

	}
	elseif($Final_Bid[$i]=="DHFL")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-dhfl.gif" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="Standard Chartered" || (strncmp ("Standard", $Final_Bid[$i],8))==0 )
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-stantc.jpg" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="Reliance capital" || (strncmp ("Reliance", $Final_Bid[$i],8))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-reliance.gif" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="ING VYSYA" || $Final_Bid[$i]=="Ing Vysya" || (strncmp ("ING", $Final_Bid[$i],3))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ing.gif" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="India Bulls")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-indiabull.gif" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="Kotak Bank" || (strncmp ("Kotak", $Final_Bid[$i],5))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif" width="86" height="20" />';
		
	}
	elseif((strncmp ("Barclays", $Final_Bid[$i],8))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-brclys.jpg" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="Citifinancial")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-citifncl.jpg"" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="SBI")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-sbi.jpg" width="86" height="20" />';
		
	}
	else
		{
			$bankwimg='&nbsp;';
		}
		?> <td width="145" height="30"  ><? echo $bankwimg;?><br /> 
              <? echo $Final_Bid[$i]; ?></td>
                                    
                                    
<td   bgcolor="#FFFFFF" height="57" colspan="5"><b><img src="new-images/ne_bnk.jpg" border="0" width="190" height="48" /></b></td>
	<? }
	?>

           </tr>
           
            </table></td>
          </tr>
          <? }
		list($sbiemi,$sbiinter,$sbiprint_term,$sbiloan_amount,$sbiviewLoanAmt,$sbiperlacemi,$sbiterm)=@sbi_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($sbiloan_amount>0)
		{
			//echo "hello";
		?>
       
       
		<tr>
		
         <td background="new-images/hl-thnk-bnkbg1-new.gif" style="background-repeat:no-repeat; background-height:80px;">
         <table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr align="center">
		  <td width="145"  height="55"  ><img src="http://www.deal4loans.com/new-images/hl-thnk-sbi.jpg" width="90" height="40" /><br /> 
                  <td width="192" align="center" ><?php echo $sbiinter; ?> </td>
                  <!--<td width="201" align="left" ><?php //echo $sbiperlacemi; ?></td> -->
                   <td width="201" align="center" ><?php echo $sbiemi; ?></td>
                   <td width="66" ><?php echo $sbiprint_term; ?> yrs.</td>
                   <td width="132" ><?php echo "Rs.".$sbiviewLoanAmt; ?></td>
                 
                   <td width="224" align="center" class="colprop"><form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="SBI">
			<input type="submit" style="width: 167px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(new-images/ne_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
		 </tr>
		 <table>
         </td></tr>
		 <? }
		?>
          <tr>
            <td colspan="6" align="right" ><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a>
            <p align="center"> 
				<span style="font-size:10px;">Advertisment</span><br />
			<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=92&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a97316c1' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=92&amp;n=a97316c1' border='0' alt=''></a></noscript>
<?php
$insTrackSql = ExecQuery("INSERT INTO `trackBanner` (`RequestID` ,`PageName` ,`Dated` ,`Counter`) VALUES ('".$ProductValue."', '".$_SERVER['HTTP_REFERER']."', Now(), 1)");
?>
</p>
            </td>
          </tr>
          <tr>
            <td colspan="6" align="center" bgcolor="#FFFFFF"><img src="new-images/hl-thnk-btm.jpg" width="959" height="11" /></td>
          </tr>
    </table></td>
  </tr>
</table>
    
	<? }
	
	 }
	 	 
	 else
	 {
		 //echo "hello2: ";
		 
		 ?>
            <p align="center"> 
				<span style="font-size:10px;">Advertisment</span><br />
			<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=92&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a97316c1' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=92&amp;n=a97316c1' border='0' alt=''></a></noscript>
<?php
$insTrackSql = ExecQuery("INSERT INTO `trackBanner` (`RequestID` ,`PageName` ,`Dated` ,`Counter`) VALUES ('".$ProductValue."', '".$_SERVER['HTTP_REFERER']."', Now(), 1)");
?>
</p>
    <?
	 }
    if($Property_Identified==0)
	{
		//echo "enter<br>";
		$chkdlqry="Select * From property_deals Where ( propertyd_city like '%".$City."%' and propertyd_valid=1)";
		//echo $chkdlqry."<br>";
		$chkdlresult=ExecQuery($chkdlqry);
				$chkdlresultcont = mysql_num_rows($chkdlresult);
	while($chkdl=mysql_fetch_array($chkdlresult))
		{
		$property_dlmrk_prc[] = $chkdl['propertyd_market_price'];
		$property_dloff_prc[] = $chkdl['propertyd_offer_price'];
		$property_dlttl[] = $chkdl['property_title'];
		$propertyd_dlid[] = $chkdl['propertyd_id'];
		}
		//print_r($property_dlmrk_prc);
		//print_r($property_dloff_prc);

		//$i=1;
		if($chkdlresultcont>0)
		{ ?>
<table width="100%" border="0" cellpadding="2" cellspacing="1" >
<tr><td>&nbsp;</td></tr>
 <tr><td style="color:#CC3300; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px;" align="center" height="25"><b>Buy Your Dream Home At Discounted Prices Now!</b></td></tr>
  
			<?  //while($chkdl=mysql_fetch_array($chkdlresult))
		//{
			$halfcnt = $chkdlresultcont/2;
			?>
			
  <tr>
  <td width="100%">




<? for($i=0; $i<$chkdlresultcont;$i=$i+2) 
	{?>
	<table width="100%" cellpadding="0" cellspacing="0" >
  <tr>
		<!--<div style="float:left; text-align:left; width:240px;  margin-left:0px;" >-->
<td width="50%">
<form name="property_deals" method="POST" action="/apply-home-loans-thank.php">
<input type="hidden" name="prprtydid" id="prprtydid" value="<? echo $propertyd_dlid[$i]; ?>">
<input type="hidden" name="custreqtid" id="custreqtid" value="<? echo $ProductValue; ?>">
<table bgcolor="#CFECA9" width="100%">
	<tr>
    <td valign="middle" colspan="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; padding-left:5px; color:#194602" ><img src="new-images/home-deal.gif" height="20"/>&nbsp;&nbsp;<b><? echo $property_dlttl[$i]; //#FBFABF ?></b></td>
  </tr>
<tr><td>
  <table width="90%"  cellpadding="0" cellspacing="0" style="padding-left:10px;" bgcolor="#FFFFFF" align="center">
  <tr><td width="30%" height="25" align="center" style="color:#CC3300;"><b>Market Price</b> </td><td width="5%" align="center"><b> : </b></td><td width="30%" align="center"> <? echo $property_dlmrk_prc[$i]; ?>/-</td><td width="35%" rowspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(new-images/exprss_intr.jpg); width: 100px; height: 20px; margin-bottom: 0px;" value=""/></td></tr>
    <tr><td  height="25" align="center" style="color:#348236;"><b>Groffr Price</b></td><td align="center"><b> : </b></td><td align="center"><? echo $property_dloff_prc[$i]; ?>/-</td></tr>
	<tr><td colspan="4" style="border-bottom:1px dashed black;" width="100%">&nbsp;</td></tr>
  </table>
  </td>
  </tr></table>
  </form>
</td>
  <!--</div>-->

 
  <td style="color:#FFFFFF;">&nbsp;</td>
 
 		
 <td width="50%">
 <? if(strlen($propertyd_dlid[$i+1])>0)
		{
	 ?>
  <form name="property_deals" method="POST" action="/apply-home-loans-thank.php">
<input type="hidden" name="prprtydid" id="prprtydid" value="<? echo $propertyd_dlid[$i+1]; ?>">
<input type="hidden" name="custreqtid" id="custreqtid" value="<? echo $ProductValue; ?>">
  <table bgcolor="#CFECA9" width="100%">
	<tr>
    <td valign="middle" colspan="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; padding-left:5px; color:#194602" ><img src="new-images/home-deal.gif" height="20"/>&nbsp;&nbsp;<b><? echo $property_dlttl[$i+1] //#FBFABF ?></b></td>
  </tr>
<tr><td>
<table width="90%"  cellpadding="0" cellspacing="0" style="padding-left:10px;" bgcolor="#FFFFFF" align="center">
  <tr><td width="30%" height="25" align="center" style="color:#CC3300;"><b>Market Price</b> </td><td width="5%" align="center"><b> : </b></td><td width="30%" align="center"> <? echo $property_dlmrk_prc[$i+1]; ?>/-</td><td width="35%" rowspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(new-images/exprss_intr.jpg); width: 100px; height: 20px; margin-bottom: 0px;" value=""/></td></tr>
    <tr><td  height="25" align="center" style="color:#348236;"><b>Groffr Price</b></td><td align="center"><b> : </b></td><td align="center"><? echo $property_dloff_prc[$i+1]; ?>/-</td></tr>
	<tr><td colspan="4" style="border-bottom:1px dashed black;" width="100%">&nbsp;</td></tr>
  </table></td>
  </tr></table>
  </form>
  <? } ?>
</td>
 </tr>
  </table>
  <!--</div>-->
  <? } ?>

 
  <tr><td>&nbsp;</td></tr>
  </td></tr>
 
		<? 
		//$i=$i+1;
		//} 
		?>
</table>
		<? }
		else
		{

		}


	}
	else
	{

	}

	 

$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		{
			 
		  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
		$get_Bankresult=ExecQuery($get_Bank);
		$citirecordcount = mysql_num_rows($get_Bankresult);
		if($citirecordcount>0)
			{
		 ?>
<div style="text-align:center; font-weight:bold; line-height:18px; padding:15px 0px;">
		There are some other financial products that are on offer for you on the basis of details you have submitted.
			<br />
		If you are interested, Go ahead and <font color="#5e3307">Apply</font></div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
		<?
		while($myrow = mysql_fetch_array($get_Bankresult))
		 {?>
				<td valign="top">
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
						<tr>
							<td height="30" class="crdbhdng"><a href="<? if (strlen($myrow["cc_bank_url"])>0) {echo $myrow["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow["cc_bank_name"];?></a></td>
						</tr>
						<tr>
							<td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow["cc_bank_url"])>0) {echo $myrow["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow["card_image"];?>"  width="150" height="244" /></a></td>
						</tr>
						<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
						<tr>
							<td class="crdtext" height="325"><? echo $myrow["cc_bank_features"];?></td>
						</tr>
						<tr>
							<td  align="center" valign="bottom"><a href="<? if (strlen($myrow["cc_bank_url"])>0) {echo $myrow["cc_bank_url"];} else {echo "#";}?>" target="_blank"><input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
						</tr>
					</table>
				</td>
				<? }?>
				<td align="center" valign="top" width="160"><div align="center">

</div>
</td>
			</tr>
		</table>


	<? }
		}
	else
	 {
		if(count($FinalBidder)>0)
	 {?>
		
	<?
	 }}
	


?>

</div>
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php //include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
<?// }?>
</body>
</html>
