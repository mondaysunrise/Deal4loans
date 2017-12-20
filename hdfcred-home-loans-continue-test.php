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
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function  InsertEdelweiss($ProductValue, $Name,$City, $Phone, $DOB , $Pincode)
	{
		$Dated=ExactServerdate();
		$dataInsert = array('E_RequestID'=>$ProductValue, 'E_Product'=>'2', 'E_Name'=>$Name, 'E_City'=>$City, 'E_Mobile_Number'=>$Phone, 'E_DOB'=>$DOB, 'E_Pincode'=>$Pincode, 'E_Dated'=>$Dated);
		$table = 'edelweiss_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
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
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
				list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Privacy'=>$accept);
			}
			$ProductValue = Maininsertfunc ("Req_Loan_Home", $dataArray);
			if($edelweiss=="1")
				{
				 InsertEdelweiss($ProductValue, $Name,$City, $Phone, $dateofbirth, $Pincode );
				}
			
			list($First,$Last) = split('[ ]', $Name);

			
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan. You will get a call from us to give you quotes & information to get you best deal for loans.";
			if(strlen(trim($Phone)) > 0)
			SendSMS($SMSMessage, $Phone);
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
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
	

		
/*list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm)=ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);*/
/*
list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);

list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm)=IDBI_Homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);

list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm)=HDFC_Homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);

list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm)=Axis_Homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);
*/
}


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
</style>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">

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
	<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a call from us.</h1>
<div align="center"><b>Your EMI and Rates Quotes for the Home Loan from partner Banks are listed Below.
</b></div>
	
     <table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" background="new-images/hl-thnk-hdr1.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td width="141" height="30" class="fontbld10"><b>Bank Name</b></td>
            <td width="191" class="fontbld10"><b>Interest Rate</b> </td>
            <td width="205" class="fontbld10"><b>EMI (Per Lac)</b></td>
            <td width="65" class="fontbld10"><b>Tenure</b></td>
            <td width="127" class="fontbld10"><b>Eligible Loan Amount</b></td>
            <td width="229" class="fontbld10"><b>EMI (Per Month)</b></td>
          </tr>
        </table></td>
      </tr>
    
          <?
for($i=0;$i<count($Final_Bid);$i++)
	{
	
		?>
		<tr> <td height="63" background="new-images/hl-thnk-bnkbg1.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
                  <?
    if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		?>
                  <td width="145" height="30"  ><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
				  
                  <td width="192" align="left" ><?php echo $axisinter; ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo  $axisperlacemi; ?> </td>
                  <td width="66" ><?php echo abs($axisprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($axisviewLoanAmt); ?></td>
                  <td width="224" align="left" ><?php echo $axisemi; ?> </td>
                  <? }
	
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{
		list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		?> 
		<td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-idbi.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
                 
                  <td width="192" align="left" ><?php echo $idbiinter; ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo  $idbiperlacemi; ?></td>
                 <td width="66" ><?php echo abs($idbiprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
                  <td width="224" align="left" >Rs. <?php echo $idbiemi; ?></td>
                  <?
		//echo "<a href='/home-loan-idbi-homefinance.php' target='_blank'>Know More</a></b></td>";
	}
	elseif($Final_Bid[$i]=="LIC Housing" || $Final_Bid[$i]=="LIC")
	{
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	?>
                  <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-lic.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
				
                  <td width="192" align="left" ><?php echo $licinter; ?> %</td>
                  <td width="201" align="left" ><?php echo $licperlacemi; ?></td>
                   <td width="66" ><?php echo $licprint_term; ?> yrs.</td>
                   <td width="132" ><?php echo "Rs.".$licviewLoanAmt; ?></td>
                  <td width="224" align="left" ><?php echo $licemi; ?></td>
                  <?
		//echo "<a href='/lic-housing-home-loan.php' target='_blank'>Know More</a></b></td>";
	}
	elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
?>
                   <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
				
                  <td width="192" align="left" ><? echo $iciciinter; ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo $iciciperlacemi; ?></td>
                 <td width="66" ><?php echo abs($iciciprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
                   <td width="224" align="left" >Rs
                      <?  echo $iciciactualemi; ?></td>
                  <?
		//echo "<a href='/icici-hfc-home-loan.php' target='_blank'>Know More</a></b></td>";

	}
	elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank")
	{
		//echo "IC:".$getnetAmount."LA:".$loan_amount."Age:".$age."TO:".$total_obligation."Cty:".$strCity."PV:".$property_value."<br>";
			list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		
		?>
                 <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
                  <td width="192" align="left" ><?php echo $hdfcinter; ?>%</td>
                  <td width="201" align="left" >Rs. <?php echo  $hdfcperlacemi; ?></td>
                  <td width="66" ><?php echo abs($hdfcprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo $hdfcviewLoanAmt; ?></td>
                   <td width="224" align="left" >Rs. <?php echo $hdfcemi; ?></td>
                  <?

		//echo "<a href='/hdfc-bank-home-loan.php' target='_blank'>Know More</a></b></td>";
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
                                    
<td   bgcolor="#FFFFFF" height="57" colspan="5"><b>Get Quote on call from Bank</b></td>
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
		  <td width="145"  ><img src="http://www.deal4loans.com/new-images/hl-thnk-sbi.jpg" width="90" height="40" /><br /> </td>
                  <td width="192" align="left" ><?php echo $sbiinter; ?> </td>
                  <td width="201" align="left" ><?php echo $sbiperlacemi; ?></td>
                   <td width="66" ><?php echo $sbiprint_term; ?> yrs.</td>
                   <td width="132" ><?php echo "Rs.".$sbiviewLoanAmt; ?></td>
                  <td width="224" align="left" ><?php echo $sbiemi; ?></td>
		 </tr>
		 <table></td></tr>
		 <? }
		?>
       
        <tr>
            <td colspan="6" align="right" style="padding-top:15px;" ><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
          </tr>
          <tr>
            <td colspan="6" align="center" bgcolor="#FFFFFF"><img src="new-images/hl-thnk-btm.jpg" width="959" height="11" /></td>
          </tr>
         <?php
		
		
		 if($Property_Identified==0)
		 {
		 ?> <tr> <td height="63" align="center"  ><table width="70%"  border="0" cellspacing="0" cellpadding="0" style="padding-top:30px; background-color:#FFFFFF; border:#FF0000 1px solid; ">
          <tr align="center">
          <td width="145"  >
          <img src="http://www.deal4loans.com/new-images/hdfcred.jpg" />
          </td>
            <td   align="center" style="padding-bottom:10px; padding-top:10px; font-weight:bold; color:#FF0000;" >
           
            <?php
			if($City=='Bangalore')
			{
				$targetURL = "http://www.hdfcred.com/properties-in-bengaluru";
				?>
                <a href="<?php echo $targetURL; ?>" target="_blank" style="padding-bottom:10px; padding-top:10px; font-weight:bold; color:#FF0000; font-size:14px; text-decoration:none;">Click for HDFC Properties within your Budget at <?php echo $City; ?></a>
                <?php
			}
			else if($City=='Chennai')
			{
				$targetURL = "http://www.hdfcred.com/properties-in-chennai";			
								?>
                <a href="<?php echo $targetURL; ?>" target="_blank" style="padding-bottom:10px; padding-top:10px; font-weight:bold; color:#FF0000; font-size:14px; text-decoration:none;">Click for HDFC Properties within your Budget at <?php echo $City; ?></a>
                <?php
			}
			else if($City=='Delhi' || $City=='Gaziabad'  || $City=='Noida' || $City=='Gurgaon' || $City=='Faridabad' || $City=='Greater Noida' || $City=='Sahibabad')
			{
				$targetURL = "http://www.hdfcred.com/properties-in-delhi";
								?>
                <a href="<?php echo $targetURL; ?>" target="_blank" style="padding-bottom:10px; padding-top:10px; font-weight:bold; color:#FF0000; font-size:14px; text-decoration:none;">Click for HDFC Properties within your Budget at <?php echo $City; ?></a>
                <?php
			}
			else if($City=='Navi Mumbai' || $City=='Mumbai'  || $City=='Thane' )
			{
				$targetURL = "http://www.hdfcred.com/properties-in-mumbai";			
								?>
                <a href="<?php echo $targetURL; ?>" target="_blank" style="padding-bottom:10px; padding-top:10px; font-weight:bold; color:#FF0000; font-size:14px; text-decoration:none;">Click for HDFC Properties within your Budget at <?php echo $City; ?></a>
                <?php
			}
			else if($City=='Hyderabad')
			{
				$targetURL = "http://www.hdfcred.com/properties-in-hyderabad";			
								?>
                <a href="<?php echo $targetURL; ?>" target="_blank" style="padding-bottom:10px; padding-top:10px; font-weight:bold; color:#FF0000; font-size:14px; text-decoration:none;">Click for HDFC Properties within your Budget at <?php echo $City; ?></a>
                <?php
			}
			else if($City=='Pune')
			{
				$targetURL = "http://www.hdfcred.com/properties-in-pune";			
								?>
                <a href="<?php echo $targetURL; ?>" target="_blank" style="padding-bottom:10px; padding-top:10px; font-weight:bold; color:#FF0000; font-size:14px; text-decoration:none;">Click for HDFC Properties within your Budget at <?php echo $City; ?></a>
                <?php
			}
			
			
			?>
                        </td>
          </tr>
          </table></td></tr>
       <?php
	   }
	   ?>
          
   
</table>
    
	<? }
	
	
	
	 }
	 	 
	 else
	 {
		 //echo "hello2: ";
		 
		 ?>
    <?
	 }?>
    <?php 

$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		{
			 
		  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
		list($citirecordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
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
		for($k=0;$k<$citirecordcount;$k++)
		 {?>
				<td valign="top">
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
						<tr>
							<td height="30" class="crdbhdng"><a href="<? if (strlen($myrow[$k]["cc_bank_url"])>0) {echo $myrow[$k]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow[$k]["cc_bank_name"];?></a></td>
						</tr>
						<tr>
							<td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow[$k]["cc_bank_url"])>0) {echo $myrow[$k]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow[$k]["card_image"];?>"  width="150" height="244" /></a></td>
						</tr>
						<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
						<tr>
							<td class="crdtext" height="325"><? echo $myrow[$k]["cc_bank_features"];?></td>
						</tr>
						<tr>
							<td  align="center" valign="bottom"><a href="<? if (strlen($myrow[$k]["cc_bank_url"])>0) {echo $myrow[$k]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
						</tr>
					</table>
				</td>
				<? }?>
				<td align="center" valign="top" width="160"><div align="center">

</div>
</td>
			</tr>
		</table>


	<?}
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
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
<?// }?>


</body>
</html>

