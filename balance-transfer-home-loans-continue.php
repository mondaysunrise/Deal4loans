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
		
		$Existing_Bank= $_POST['Existing_Bank'];
		$Existing_Loan= $_POST['Existing_Loan'];
		$Existing_ROI= $_POST['Existing_ROI'];
		
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

function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
		$Dated = ExactServerdate();		
		$dataInsert = array("ibibo_product"=>'2' , "ibibo_requestid"=>$ProductValue , "ibibo_name"=>$Name , "ibibo_city"=>$City , "ibibo_mobile"=>$Phone, "ibibo_dob"=>$DOB , "ibibo_car_name"=>$Ibibo_compaign , "ibibo_dated"=>$Dated , "ibibo_email"=>$Email );
		$table = 'ibibo_compaign_leads';
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
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);
				//echo "<br>else".$InsertProductSql;
			}
			
			//echo $InsertProductSql."<br>";
			//exit();
			$ProductValue = Maininsertfunc ("Req_Loan_Home", $dataArray);

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
		
			header("Location: balance-transfer-homeloancontinue.php");
			exit();				
			
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
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
<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->


<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.html" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <a href="#"  class="text12" style="color:#4c4c4c;">> Apply for Home Loan</a></div>
<div style="clear:both; height:15px;"></div>

<div style="clear:both; height:306px; width:960px; margin:auto; margin-top:15px;">
<div style=" float:left; width:881px; height:auto; margin-left:25px; margin-top:7px; background-color:#FFFFFF;" >
    
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" class="brdr5">
	
      <tr>
     <td>
     <form action="balance-transfer-homeloancontinue.php" method="post" name="hl">
         <input type="hidden" name="ProductValue" id="ProductValue"  value="<? echo $ProductValue; ?>" >
          <input type="hidden" name="strcity" id="strcity"  value="<? echo $strcity; ?>" >
           <input type="hidden" name="Name" id="Name"  value="<? echo $Name; ?>" >

       <table width="100%"  border="0" cellspacing="0" cellpadding="0">
	   <tr>
        <td style=" padding:12px;" colspan="2"><table width="539" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="489" height="30"  bgcolor="#FFFFFF" class="frmbldtxt" align="center" ><h1 style="margin:0px; padding:0px;"> Balance Transfer Home Loan Application</h1></td>
  </tr>
</table></td>
 </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; ">Dear <?php echo $Name ; ?>, </td>
                     
                     <td width="24%" height="28" class="frmbldtxt"  style="padding-top:3px; ">&nbsp;</td>
                   </tr>
                     <tr valign="middle">
                     <td height="28" colspan="2" class="frmbldtxt" style="padding-top:3px; font-weight:normal; " align="center">To get quotes and Compare offers from all Banks and <span style="color: #D02037;"> Save Upto Rs. 50000* by comparison on your EMI</span>. Please verify your Mobile Number.	</td>                   
                     </tr>
  <tr><td colspan="2" style="color: #D02037; font-size:12px;" height="20" align="center"><b>To Verify, Please Initiate A Miss Call From your Mobile "<span style="color:#000000;" ><? echo $Phone; ?></span>" , To The Below Mentioned TOLL-FREE Number</b></td></tr>
                   <tr><td colspan="2" align="center">
                   <?php
				   $client_transaction_id = $ProductValue."_HL";
				   	$zipdimage = mobile_verify($Phone,$client_transaction_id);
				   
                   ?>
                   <img src="<? echo $zipdimage; ?>" /></td></tr>
				    <tr><td style="color: #D02037; font-size:12px; padding-left:250px;" height="30" align="center">Will auto disconnect after 1 ring </td><td colspan="3"><input name="submit" type="submit" style="width:240px; background-color: #D02037; color:#FFFFFF; font-weight:700" value="Click After 10 secs of Missed Call" /></td></tr>
                 </table>
        </form>
     
     </td>
      </tr>
       <tr>
            <td  height="25" align="center" class="frmbldtxt"  style="font-weight:normal;" colspan="2" >
			1) Get call back assistance on <span style="color: #D02037;">verified mobile number</span>. <br />
2) Compare EMI and <span style="color: #D02037;">save Upto Rs. 50000 on interest</span>.<br />
3) Provides you with the best suitable offers.<br /> 
4) Help in processing your loan faster.         </td>
           
      </tr>
		   <tr><td>&nbsp;</td></tr>
		 
       <tr><td>&nbsp;</td></tr>
	   
    </table>

</div>
</div>
<?php include "footer1.php"; ?>

</body>
</html>