<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
			require 'scripts/home_loan_eligibility_function.php';


	function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	
function DetermineAgeGETDOB ($YYYYMMDD_In)
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


	
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
			$Type_Loan=$_REQUEST['Type_Loan'];
			$Reference_Code1 = $_REQUEST['Reference_Code1'];
			$ProductValue = $_REQUEST['ProductValue'];	
			$Day=$_REQUEST['day'];
			$Month=$_REQUEST['month'];
			$Year=$_REQUEST['year'];
			$DOB=$Year."-".$Month."-".$Day;
			$Residence_Address = $_REQUEST['Residence_Address'];
			$Pincode = $_REQUEST['Pincode'];
			$Employment_Status = $_REQUEST['Employment_Status'];
			$Company_Name = $_REQUEST['Company_Name'];
			$Property_Identified = $_REQUEST['Property_Identified'];
			$Property_Loc = $_REQUEST['Property_Loc'];
			$updateProperty = $_REQUEST['updateProperty'];
			$Loan_Time = $_REQUEST['Loan_Time'];
			$Budget = $_REQUEST['Budget'];
			$Accidental_Insurance = $_REQUEST['Accidental_Insurance'];
			$RePhone = $_REQUEST['RePhone'];
			$Phone = $_REQUEST['Phone'];
			$City = $_REQUEST['City'];
			$Net_Salary = $_REQUEST['Net_Salary'];
			$Net_Salary = $_POST['Net_Salary'];
			$monthly_income = ($Net_Salary /12);
			$obligations = $_POST['obligations'];
			$co_appli = $_POST['co_appli'];
			$co_name = $_POST['co_name'];
			$dob_arr_co[] = $_POST['co_year'];
			$dob_arr_co[] = $_POST['co_month'];
			$dob_arr_co[] = $_POST['co_day'];
			$DOB_co = implode("-", $dob_arr_co);
			$co_monthly_income = $_POST['co_monthly_income'];
			$co_obligations = $_POST['co_obligations'];
			$property_value = $_POST['Property_Value'];
			$getnetAmount = ($monthly_income + $co_monthly_income);
			$total_obligation = $obligations + $co_obligations;
			$netAmount=($getnetAmount - $total_obligation);
			$currentyear=date('Y');
$age=$currentyear-$Year;



			$CheckSql = "select  Reference_Code,Name from ".$Type_Loan." where RequestID =".$ProductValue;
			$CheckQuery = ExecQuery($CheckSql);
			$CheckRow = mysql_fetch_array($CheckQuery);
			$CheckRef = $CheckRow['Reference_Code'];
			$Name = $CheckRow['Name'];
			
			
				
				$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;
//echo $exactage."<br>";
//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;

				
			$crap = " ".$Property_Identified." ".$Property_Loc." ".$company." ".$City_Other." ".$Primary_Acc." ".$Descr." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
	
				
				if (($Type_Loan=="Req_Loan_Home") || ($product=="HomeLoan"))
					{
					
																
						getEligibleBidders("home","$City","$Mobile");
						
						$qry="Update Req_Loan_Home SET  Co_Applicant_Name='$co_name',Co_Applicant_DOB='$DOB_co',Co_Applicant_Income='$co_monthly_income',Co_Applicant_Obligation='$co_obligations',Property_Value='$property_value', Total_Obligation='$total_obligation',DOB = '$DOB', Residence_Address = '$Residence_Address', Pincode ='$Pincode', Employment_Status ='$Employment_Status', Company_Name='$Company_Name', Property_Identified='$Property_Identified', Property_Loc ='$Property_Loc', Loan_Time='$Loan_Time', Is_Valid='$Is_Valid', Budget='$budget' Where RequestID=".$ProductValue;
				//		echo $qry;
						$result = ExecQuery($qry);
				
						if($Net_Salary>=200000)
						{
							$productname = "hlsalaryclause";
						}
						else
						{
						$productname = "HomeLoan";
						}

						//$filename = "Contents_Home_Loan_Mustread.php?product=$productname";
						//header("Location: $filename");
						//exit();
					/*	echo "<script language=javascript>location.href='t_y1.php?r_url=".getTransferURL("Req_Loan_Home")."'"."</script>"; */
				
					}
			
				if(isset($_SESSION['UserType'])) 
				{
					echo "<script language=javascript>"." location.href='myRequests.php'"."</script>";
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
		
	}//$_POST
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
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
	<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a Call from us.<br />
Following Banks are interested in your profile, will get back to you & give you the best Deal..</div>
	<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#e8e6d9">
  <tr>
    <td width="11%" height="25" align="center" valign="middle" bgcolor="#494949"><b style=" color:#FFFFFF;">Bank Name</b></td>
	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">ROI</b></td>
	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">EMI(Per Lac)</b></td>
	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Tenure</b></td>
	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Eligible Loan Amt</b></td>

		<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">EMI(Per Month)</b></td>
<!--	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Total Interest Amt</b></td>-->
<!--	<td width="11%" align="center"><b style="font-size:12px;">Information</b></td>-->
   <!-- <td width="6%" colspan="25" align="center" bgcolor="#494949"><b style="color:#FFFFFF;">Apply</b></td>-->
  </tr>
   <form name="check_bidders" action="get_checked_bidders.php" method="POST">
	<input type="hidden" name="reply_product" value="Req_Loan_Home">
	<input type="hidden" name="requestid" value="<? echo $ProductValue;?>">
	<input type="hidden" name="selectbidderID" id="selectbidderID" value="<? echo $FinalBidder ;?>">
		<input type="hidden" name="realbankID" id="realbankID" value="<? echo $realbankiD ;?>">
	<?
for($i=0;$i<count($Final_Bid);$i++)
	{
		?>
  <tr>
    <td height="22" align="center" bgcolor="#FFFFFF"><b><? echo $Final_Bid[$i];?></b></td>
	
    <?
    if($finalBidderName[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis Bank")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	
	//echo "<a href='/home-loan-axis-bank.php' target='_blank'>Know More</a>";
		?>	
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($axisinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  abs($axisperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($axisprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($axisviewLoanAmt); ?></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $axisemi; ?></td>
	<!--<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
							    /*  $axisinterestfortwoyr= ($axissemi * 12);
							   $axisremingterm=$axisterm - 12;
						   $axisgetinterestamt=(($axisactualemi * $axisremingterm)); 
						   $axistotalinterestamt= (($axisinterestfortwoyr + $axisgetinterestamt) - $axisviewLoanAmt);
						    echo abs($axistotalinterestamt); */?></td>-->
		
		
	<? }
	elseif($finalBidderName[$i]=="Citibank" || $Final_Bid[$i]=="Citibank")
	{
		echo "<td colspan='6' style='font-size:12px;' align='center' bgcolor='#FFFFFF'><b>Get Quote on call from Bank</b></td>";
	}
	elseif($finalBidderName[$i]=="DHFL" || $Final_Bid[$i]=="DHFL")
	{
		echo "<td colspan='6' align='center' bgcolor='#FFFFFF' style='font-size:12px;'>Get Quote on call from Bank</b></td>";
	}
	elseif(($finalBidderName[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Housing Finance"))
	{
		list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		?>
		 
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo "8.25%(Fixed for 2 yrs)".abs($idbiinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  $idbiperlacemifortwo."(Fixed For 2 yrs)".abs($idbiperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($idbiprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($idbiviewLoanAmt); ?></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $idbiemi; ?></td>
<!--	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
							   
							 /*  $idbiinterestfortwoyr= ($idbisemi * 24);
							   $remingterm=$idbiterm - 24;
						   $idbigetinterestamt=($idbiactualemi * $remingterm); 
						   $idbitotalinterestamt= ( ($idbiinterestfortwoyr + $idbigetinterestamt) - $idbiviewLoanAmt);
						   echo abs($idbitotalinterestamt); */?></td>-->
	<?
		//echo "<a href='/home-loan-idbi-homefinance.php' target='_blank'>Know More</a></b></td>";
	}
	elseif($finalBidderName[$i]=="LIC Housing" || $Final_Bid[$i]=="LIC Housing")
	{
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	?>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($licinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($licperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($licprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($licviewLoanAmt); ?></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $licemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php $licgetinterestamt=(($licemi * $licterm)); echo $licgetinterestamt; ?></td>
	<?
		//echo "<a href='/lic-housing-home-loan.php' target='_blank'>Know More</a></b></td>";
	}
	elseif($finalBidderName[$i]=="ICICI" || $Final_Bid[$i]=="ICICI")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
/*if($iciciviewLoanAmt<=2000000)
		{
			$viewinter="8%";
		}
		elseif($iciciviewLoanAmt>2000000)
		{
			$viewinter="8.25%";
		}*/
			?>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><? echo abs($iciciinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($iciciperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($iciciprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($iciciviewLoanAmt); ?></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs <? echo $iciciemi; ?></td>
	<!--<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php /* $iciciinterestfortwoyr= (($icicisemi * 24) );
							   $remingterm=$iciciterm - 24;
						     $icicigetinterestamt=(($iciciactualemi * $remingterm));
						  $icicitotalinterestamt= (($iciciinterestfortwoyr + $icicigetinterestamt) - $iciciviewLoanAmt);
							 echo abs($icicitotalinterestamt)."<br>"; */?></td>-->
	<?
		//echo "<a href='/icici-hfc-home-loan.php' target='_blank'>Know More</a></b></td>";

	}
	elseif($finalBidderName[$i]=="HDFC" || $Final_Bid[$i]=="HDFC")
	{
		/*if($hdfcviewLoanAmt<=300000)
		{
			$viewinter="9%";
		}
		elseif($hdfcviewLoanAmt>300000)
		{
			$viewinter="9.25%";
		}*/
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		?>
		  
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo "8.25%(Fixed for 1 yr) 9% (Fixed for 2 yrs), Then".abs($hdfcinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  abs($hdfcperlacemi); ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($hdfcprint_term); ?> yrs.</b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($hdfcviewLoanAmt); ?></b></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $restemi.",Then".$hdfcemi; ?></td>
<!--	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
  /* $hdfcinterestfortwoyr= (($hdfcsemi * 24));
   $remingterm=$hdfcterm - 24;
   $hdfcgetinterestamt=(($hdfcactualemi * $remingterm)); 
   $hdfctotalinterestamt= (($hdfcinterestfortwoyr + $hdfcgetinterestamt) - $hdfcloan_amount);
   echo abs($hdfctotalinterestamt);*/ ?></td>-->
	<?

		//echo "<a href='/hdfc-bank-home-loan.php' target='_blank'>Know More</a></b></td>";
	}
	else
	{
		echo "<td colspan='5' style='font-size:12px;' align='center' bgcolor='#FFFFFF'><b> Get Quote on call from Bank </b></td>";
	}
	?>
    <!--<td bgcolor="#FFFFFF" align="center"><input type='checkbox' value='<? //echo $Final_Bid[$i];?>' name='Final_Bidder[<? //echo $i;?>]' checked style="border:none;" /></td>-->
  </tr>
  <? } ?>
   <!--<tr>
    <td height="30" colspan="7" align="center" bgcolor="#FFFFFF"><input type="submit" name="submit" value="Submit" style="font-family: Verdana, Arial, Helvetica, sans-serif; width:90px; font-size: 13px;color: #FFFFFF;	background-color: #529BE4; border:none;
	font-weight: bold;" /></td>
    </tr>-->
	<td colspan="6" align="right" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
    </tr>
</form>
 </table>
 <? }
	
	 }
	 	 
	 else
	 {
		 //echo "hello2: ";
		 
		 ?>
		 <form name="plpensionform" action="http://www.bimadeals.com/life-insurance-india/thank_life_insurance_d4l.php" method="POST">
		<table width='500' border='0' cellpadding='0' cellspacing='0' style='border:1px solid #e2e2e2;' align="center">
			<input type='hidden' value='<? echo $Net_Salary;?>' name='netSalary' id='netSalary'>
			<input type='hidden' name='DOB' id='DOB' value='<? echo $getDOB;?>'>
			<input type='hidden' name='Mobile' id='Mobile' value='<? echo $Mobile;?>'>
			<input type='hidden' name='City' id='City' value='<? echo $City;?>'>
			<input type='hidden' name='Email' id='Email' value='<? echo $Email;?>'>
			<input type='hidden' name='Name' id='Name' value='<? echo $Name;?>'>
			<input type='hidden' name='getDOB' id='getDOB' value='<? echo $DOB;?>'>
			<tr>
				<td align="left" width="500" height="118"><img src="images/bima-hdr.gif" width="500" height="118" /></td>
			</tr>
			<tr>
				<td align="left" style="border:1px solid #75beec; border-top:none; padding:5px; Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; line-height:17px;" ><table width='100%' border='0' align="left" cellpadding='0' cellspacing='0'>
			<tr>
				<td style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Do you know at your <b>current income</b>, you would require 
				<div id='calculate' style='Font-size:12px; font-family:Verdana, Arial verdana, Helvetica, sans-serif; font-weight:bold;'>Rs. <? echo round($getexactvaluemonthly);?> per month</div>At your Retirement Age of <input type='text' value='50' name='agecalc' id='agecalc' size='3' onchange='taxinsertData();'> yrs. to lead a quality Life<br />
				<br />
				<b style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">Is your investment enough to meet all your requirements when there will be no source of Income? </b><br />
				If yes, Is it adequate enough to meet your current living style, medical expenses of old age, holiday of your choice, surprise gift for grannies &amp; for many more unlived moments of life??</td>
			</tr>
			<tr>
				<td align="right" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'>Check here to invest today &amp; make your tomorrow better with Bimadeals <br />
			Get &amp; compare offers from Bimadeals Insurance partners &amp; choose the Best Deal for yourself.!! </td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Bimadeals is a one stop shop for all your insurance/investment requirements. Get & Choose Offers from <b style="font-family:Verdana, Arial, Helvetica, sans-serif;">ICICI prudential, Kotak, LIC, Max New York, MetLife</b> & many more just in three easy steps:</td>
			</tr>
			<tr>
				<td ><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#e7e5e5">
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/posticn.jpg" width="17" height="20" /></td>
				<td width="445" bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Post Insurance Requirement</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/cmpricon.jpg" width="19" height="19" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Compare &amp; Get offers from Insurance Companies.</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/dealicn.jpg" width="22" height="15" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Choose the Best Deal to suit your needs.</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
				<td height="22" style="color:#2A72BC; Font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;"> Live A Tension Free Life! </td>
			</tr>
			<tr>
				<td height="35" align="right" valign="top" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			</table></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; padding:4px; line-height:17px;'></td>
			</tr>
		</table>
	</form>
	<?
	 }?>
<?php 

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
			</tr>
		</table>


	<?}
		}
	else
	 {
		if(count($FinalBidder)>0)
	 {?>
		
	<form name="plpensionform" action="http://www.bimadeals.com/life-insurance-india/thank_life_insurance_d4l.php" method="POST">
		<table width='500' border='0' cellpadding='0' cellspacing='0' style='border:1px solid #e2e2e2;' align="center">
			<input type='hidden' value='<? echo $Net_Salary;?>' name='netSalary' id='netSalary'>
			<input type='hidden' name='DOB' id='DOB' value='<? echo $getDOB;?>'>
			<input type='hidden' name='Mobile' id='Mobile' value='<? echo $Mobile;?>'>
			<input type='hidden' name='City' id='City' value='<? echo $City;?>'>
			<input type='hidden' name='Email' id='Email' value='<? echo $Email;?>'>
			<input type='hidden' name='Name' id='Name' value='<? echo $Name;?>'>
			<input type='hidden' name='getDOB' id='getDOB' value='<? echo $DOB;?>'>
			<tr>
				<td align="left" width="500" height="118"><img src="images/bima-hdr.gif" width="500" height="118" /></td>
			</tr>
			<tr>
				<td align="left" style="border:1px solid #75beec; border-top:none; padding:5px; Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; line-height:17px;" ><table width='100%' border='0' align="left" cellpadding='0' cellspacing='0'>
			<tr>
				<td style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Do you know at your <b>current income</b>, you would require 
				<div id='calculate' style='Font-size:12px; font-family:Verdana, Arial verdana, Helvetica, sans-serif; font-weight:bold;'>Rs. <? echo round($getexactvaluemonthly);?> per month</div>At your Retirement Age of <input type='text' value='50' name='agecalc' id='agecalc' size='3' onchange='taxinsertData();'> yrs. to lead a quality Life<br />
				<br />
				<b style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">Is your investment enough to meet all your requirements when there will be no source of Income? </b><br />
				If yes, Is it adequate enough to meet your current living style, medical expenses of old age, holiday of your choice, surprise gift for grannies &amp; for many more unlived moments of life??</td>
			</tr>
			<tr>
				<td align="right" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'>Check here to invest today &amp; make your tomorrow better with Bimadeals <br />
			Get &amp; compare offers from Bimadeals Insurance partners &amp; choose the Best Deal for yourself.!! </td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Bimadeals is a one stop shop for all your insurance/investment requirements. Get & Choose Offers from <b style="font-family:Verdana, Arial, Helvetica, sans-serif;">ICICI prudential, Kotak, LIC, Max New York, MetLife</b> & many more just in three easy steps:</td>
			</tr>
			<tr>
				<td ><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#e7e5e5">
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/posticn.jpg" width="17" height="20" /></td>
				<td width="445" bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Post Insurance Requirement</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/cmpricon.jpg" width="19" height="19" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Compare &amp; Get offers from Insurance Companies.</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/dealicn.jpg" width="22" height="15" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Choose the Best Deal to suit your needs.</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
				<td height="22" style="color:#2A72BC; Font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;"> Live A Tension Free Life! </td>
			</tr>
			<tr>
				<td height="35" align="right" valign="top" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			</table></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; padding:4px; line-height:17px;'></td>
			</tr>
		</table>
	</form>

	 <?
	 }}
	

	/*if(count($FinalBidder)=="")
	{
	$filename = "Contents_Home_Loan_Mustread.php?product=$productname";
	header("Location: $filename");
	exit();
	}*/

?>

</div>
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
<?// }?>

<!-- Google Code for lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1063319470;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (1) {
  var google_conversion_value = 1;
}
var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1063319470/imp.gif?value=1&label=lead&script=0">
</noscript>
</body>
</html>

