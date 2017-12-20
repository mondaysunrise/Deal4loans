<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	error_reporting();
	require 'getlistofeligiblebidders.php';
	require 'scripts/home_loan_eligibility_function.php';
	
	$page_Name = "LandingPage_HL";

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
	

	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
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


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = $_POST['Name'];
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['IncomeAmount'];
	$monthly_income = ($Net_Salary /12);
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Referrer=$_REQUEST['referrer'];
	$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");

	$Day=$_REQUEST['day'];
	$Month=$_REQUEST['month'];
	$Year=$_REQUEST['year'];
	$DOB=$Year."-".$Month."-".$Day;
	$Employment_Status = $_REQUEST['Employment_Status'];			
	$Property_Identified = $_REQUEST['Property_Identified'];
	$Property_Loc = $_REQUEST['Property_Loc'];
	$updateProperty = $_REQUEST['updateProperty'];
	$property_value = $_POST['Property_Value'];
	$obligations = $_POST['obligations'];
	$getnetAmount = ($monthly_income + $co_monthly_income);
	$total_obligation = $obligations + $co_obligations;
	$netAmount=($getnetAmount - $total_obligation);
	$currentyear=date('Y');
	$age=$currentyear-$Year;

	

	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		list($alreadyExist,$myrow)=MainselectfuncNew($GetDateSql,$array = array());
		$myrowcontr=count($myrow)-1;
		
		$TDated = $myrow[$myrowcontr]["Dated"];
		$TCity = $myrow[$myrowcontr]["City"];
		$Mobile = $myrow[$myrowcontr]["Mobile_Number"];
		$Dated=ExactServerdate();
		$Product_Name = "2";
		
		//$Sql = "INSERT INTO `tataaig_leads` ( T_RequestID , T_Product , T_City, Mobile_Number, T_Dated ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";

		$data = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $data);
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
			
			$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number not in (9971396361,9811215138,9891118553)  and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
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
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];

				//$InsertProductSql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance,DOB,  Employment_Status, Property_Identified, Property_Loc, Total_Obligation, Property_Value) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$Loan_Amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance', '".$DOB."', '".$Employment_Status."', '".$Property_Identified."', '".$Property_Loc."', '".$total_obligation."', '".$property_value."' )"; 
				
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance,"DOB"=>$DOB,        "Employment_Status"=>$Employment_Status, "Property_Identified"=>$Property_Identified, "Property_Loc"=>$Property_Loc, "Total_Obligation"=>$Total_Obligation, "Property_Value"=>$Property_Value );
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);	
				
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "DOB"=>$DOB, "Employment_Status"=>$Employment_Status, "Property_Identified"=>$Property_Identified, "Property_Loc"=>$Property_Loc, "Total_Obligation"=>$Total_Obligation, "Property_Value"=>$Property_Value );
			}
			$ProductValue = Maininsertfunc ($Type_Loan, $data);		
			//$InsertProductQuery = ExecQuery($InsertProductSql);
			//$ProductValue = mysql_insert_id();
			//exit();
			if($Accidental_Insurance=="1")
			{
				InsertTataAig($ProductValue, "Req_Loan_Home");
			}
			
			list($First,$Last) = split('[ ]', $Name);

			//echo "heelo";
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan. You will get a call from us to give you quotes & information to get you best deal for loans.";
			//if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
				$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			}	
			
			$CheckSql = "select  Reference_Code,Name from ".$Type_Loan." where RequestID =".$ProductValue;
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckRef = $myrow[$myrowcontr]["Reference_Code"];
			$Name = $myrow[$myrowcontr]["Name"];
			$CheckRow = $alreadyExist;
				
			$getDOB = str_replace("-","", $DOB);
			$age = DetermineAgeGETDOB($getDOB);
		//	echo $age."<br>";
			$agecalc="50";
			$exactage = $agecalc- $age;
			//echo $exactage."<br>";
			//get inflation amount
			$getinflation = $Net_Salary *(5/100);
			$getinflationage = $getinflation * $exactage;
			$getexactvalue = $getinflationage + $Net_Salary;
			$getexactvaluemonthly = $getexactvalue/12;
			getEligibleBidders("home","$City","$Mobile");
			
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
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">

<?php 

//echo "dfsfdfds";
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
	<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#dbf2ff">
   <tr>
        <td height="45" background="new-images/hl-thnk-hdr.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td width="157" height="30"><b>Bank Name</b></td>
            <td width="204"><b>ROI</b></td>
            <td width="210"><b>EMI (Per Lac)</b></td>
            <td width="63"><b>Tenure</b></td>
            <td width="96"><b>Eligible Loan Amount</b></td>
            <td width="230"><b>EMI (Per Month)</b></td>
          </tr>
        </table></td>
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
        <td height="117" background="new-images/hl-thnk-bnk.jpg" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr align="center">
              <td width="157" height="30"><? echo $Final_Bid[$i];?><!--<img src="new-images/hl-thnk-icici.jpg" width="129" height="54" />--></td>
 
	
    <?
    if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	
	
		?>	
	 <td width="204"><?php echo abs($axisinter); ?> %</td>
	<td width="210" class="tbl_txt1">Rs. <?php echo  abs($axisperlacemi); ?></td>
	 <td width="63"><?php echo abs($axisprint_term); ?> yrs.</td>
	 <td width="63">Rs. <?php echo abs($axisviewLoanAmt); ?></td>
	<td width="230" class="tbl_txt1">Rs. <?php echo $axisemi; ?></td>
			
		
	<? }
	elseif($Final_Bid[$i]=="Citibank" || $Final_Bid[$i]=="Citi Bank")
	{
		echo "<td colspan='6'><span class='tbl_txt1'><b>Get Quote on call from Bank</b></td>";
	}
	elseif($Final_Bid[$i]=="DHFL")
	{
		echo "<td colspan='6' align='center' bgcolor='#FFFFFF' style='font-size:12px;'>Get Quote on call from Bank</b></td>";
	}
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{
		echo "<td colspan='6' align='center' bgcolor='#FFFFFF' style='font-size:12px;'>Get Quote on call from Bank</b></td>";

	
		//echo "<a href='/home-loan-idbi-homefinance.php' target='_blank'>Know More</a></b></td>";
	}
	elseif($Final_Bid[$i]=="LIC Housing" || $Final_Bid[$i]=="LIC")
	{
	echo "<td colspan='6' align='center' bgcolor='#FFFFFF' style='font-size:12px;'>Get Quote on call from Bank</b></td>";
	}
	elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 

			?>
	<td width="204"><? echo $iciciinter; ?> %</td>
	<td width="210" class="tbl_txt1">Rs. <?php echo $iciciperlacemi; ?></td>
	<td width="63"><?php echo abs($iciciprint_term); ?> yrs.</td>
	<td width="63">Rs. <?php echo abs($iciciviewLoanAmt); ?></td>

		<td width="230" class="tbl_txt1">Rs <?  echo $iciciactualemi; ?></td>
	
	<?
		//echo "<a href='/icici-hfc-home-loan.php' target='_blank'>Know More</a></b></td>";

	}
	elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank")
	{
		
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		
		?>
		  
	<td width="204"><?php echo $hdfcinter; ?>%</td>
	<td width="210"  class="tbl_txt1">Rs. <?php echo  $hdfcperlacemi; ?></b></td>
	<td width="63"  class="style1"><?php echo abs($hdfcprint_term); ?> yrs.</b></td>
	<td width="63"  class="style1">Rs. <?php echo abs($hdfcviewLoanAmt); ?></b></td>

		<td width="230"  class="tbl_txt1">Rs. <?php echo $hdfcemi; ?></td>

	<?

		//echo "<a href='/hdfc-bank-home-loan.php' target='_blank'>Know More</a></b></td>";
	}
	else
	{
		echo "<td colspan='5' style='font-size:12px;' align='center' bgcolor='#FFFFFF'><b> Get Quote on call from Bank </b></td>";
	}
	?>
   
  </tr>
        </table></td>
      </tr>
  <? } ?>
   
	<tr>
	<td colspan="6" align="right" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
    </tr>
</form>
 </table>
 <? }
	else
	{
	?>
	<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a Call from us.<br /></div>
	<?php
	}
	 }
	 	 
	 else
	 {
		?>
	<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a Call from us.<br /></div>
	<?php
	 }
	 
$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		{
			 
		  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
		list($alreadyExist,$myrow)=MainselectfuncNew($get_Bank,$array = array());
		$citirecordcount = $alreadyExist;
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
<script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 160x600, created 7/23/10 */
google_ad_slot = "3315324675";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
</td>
			</tr>
		</table>


	<? }
		}
	else
	 {
		if(count($FinalBidder)>0)
	 { ?>
		
	<?
	 }}
	
?>

</div>
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
<? // }?>

<script type='text/javascript'><!--//<![CDATA[

    var OA_p=location.protocol=='https:'?'https:':'http:';
    var OA_r=Math.floor(Math.random()*999999);
    document.write ("<" + "script language='JavaScript' ");
    document.write ("type='text/javascript' src='"+OA_p);
    document.write ("//n.admagnet.net/panda/www/delivery/tjs.php");
    document.write ("?trackerid=10&amp;r="+OA_r+"'><" + "/script>");
//]]>--></script><noscript><div id='m3_tracker_10' style='position: absolute; left: 0px; top: 0px; visibility: hidden;'><img src='http://n.admagnet.net/panda/www/delivery/ti.php?trackerid=10&amp;adid=&amp;sname=%%SNAME_VALUE%%&amp;Order_ID=%%ORDER_ID_VALUE%%&amp;OrderID=%%ORDERID_VALUE%%&amp;Quantity=%%QUANTITY_VALUE%%&amp;Value=%%VALUE_VALUE%%&amp;Transactionid=%%TRANSACTIONID_VALUE%%&amp;cb=%%RANDOM_NUMBER%%' width='0' height='0' alt='' /></div></noscript>
</body>
</html>

