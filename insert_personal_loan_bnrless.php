<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	
	
	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

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

	
$getCompany_Name = $Company_Name;
		list($year,$month,$day) = split('[-]', $DOB);

$currentyear=date('Y');
$age=$currentyear-$year;

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		    $leadid = $_REQUEST['leadid'];
			$LoanAny = $_REQUEST["LoanAny"];
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Salary_Drawn = $_REQUEST['Salary_Drawn'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$is_permit = $_REQUEST['is_permit'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Activation_Code = $_REQUEST['activation_code'];
			$Document_proof=$_REQUEST['Document_proof'];
	$Company_Name = $_REQUEST['Company_Name'];
	$Loan_Amount = $_REQUEST['Loan_Amount'];
	$Pincode = $_REQUEST['Pincode'];
	$CC_Holder = $_REQUEST['CC_Holder'];
	$Card_Vintage = $_REQUEST['Card_Vintage'];
	$getCompany_Name =$Company_Name;
	$fullerton_loan = $_REQUEST["fullerton_loan"];

			$Document_proof_doc=implode(",",$Document_proof);
			
	
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
	$getpldetails=("select Employment_Status,City_Other,City,Company_Name,Name,Net_Salary,DOB,Reference_Code From Req_Loan_Personal Where (RequestID='".$leadid."')");
list($recordcount,$plrow)=Mainselectfunc($getpldetails,$array = array());

$City = $plrow['City'];
$Name = $plrow['Name'];
$DOB = $plrow['DOB'];
$Net_Salary = $plrow['Net_Salary'];
$Other_City = $plrow['City_Other'];	
$Reference_Code = $plrow['Reference_Code'];
$Employment_Status = $plrow['Employment_Status'];

$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;

//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;
//echo "Net_Salary: ".$Net_Salary."<br>";
$monthsalary =$Net_Salary/12;
$reference_code=$_SESSION['cap_code'];
		if($_POST['captcha'] == $_SESSION['cap_code'])
		{
			$Is_Valid=1;
		}
		else
		{
			$Is_Valid=0;
		}
	

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
				
			$crap = $City_Other." ".$Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
	
	if($strCity=="Delhi" || $strCity=="Mumbai" || $strCity=="Chennai" || $strCity=="Kolkata" || $strCity=="Bangalore" || $strCity=="Hyderabad" || $strCity=="Pune" || $strCity=="Noida" || $strCity=="Gurgaon" || $strCity=="Gaziabad" || $strCity=="Faridabad" || $strCity=="Thane" || $strCity=="Navi Mumbai")
		{
			if($CC_Holder==1 || ($LoanAny==1 && $EMI_Paid>0) || $is_permit==1)
			{
			$permited=1;

			}
				else
			{
				$permited=0;
			}
		}
		else
		{
			$permited=1;
		}

	if($leadid>0)
				{														
					$DataArray = array('Is_Permit'=>$is_permit, 'Company_Name'=>$Company_Name, 'Pincode'=>$Pincode, 'Loan_Amount'=>$Loan_Amount, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'Reference_Code'=>$reference_code, 'Company_Type'=>$Company_Type, 'PL_EMI_Amt'=>$PL_EMI_Amt, 'Primary_Acc'=>$Primary_Acc, ' Residential_Status'=>$Residential_Status.'" ,Card_Limit= "'.$Credit_Limit, ' Years_In_Company'=>$Years_In_Company, ' Total_Experience'=>$Total_Experience, 'EMI_Paid'=>$EMI_Paid, ' Loan_Any'=>$Loan_A, 'identification_proof'=>$Document_proof_doc, 'Is_Valid'=>$Is_Valid, 'Bidderid_Details'=>$strFinal_Bid, 'Allocated'=>$Allocated, 'Salary_Drawn'=>$Salary_Drawn, 'Direct_Allocation'=>'1', 'HL_Bank'=>$Activation_Code);	
					$wherecondition ="(RequestID=".$leadid.")";
					Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
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

		if($fullerton_loan==1)
		{
			$permited=0;
		}
		
	}//$_POST
	
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Thank you</title>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/tooltip.js"></script>
<style type="text/css">

.font10 {
font-size:10px;
line-height:13px;
}
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
}

#dhtmltooltip{
position: absolute;
left: -300px;
width: 320px;
border: 1px solid black;
padding: 2px;
background-color: #fff3be;
visibility: hidden;
z-index: 100;
/*Remove below line to remove shadow. Below line should always appear last within this CSS*/
filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
}
</style>
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
<?php include "top-menu.php"; ?>
<?php include "main-menu.php"; ?>
<div id="container">
  <div id="txt" style="padding:15px;" >
  <p style="text-align:center;"><strong>Thanks for applying Personal Loan through Deal4loans.com.</strong></p>
<?php 
if($Is_Valid==1)
		{
	//echo "entered";
	//echo "<br>";
list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
$arrFinal_Bid = "";
		while (list ($key,$val) = @each($FinalBidder)) { 
			$arrFinal_Bid[]= $val; 
		} 

$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 

	$strFinal_Bid=implode(',',$arrFinal_Bid);

	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);


//if($leadid>0 && (strlen($strFinal_Bid)>0) && (($Salary_Drawn==2) || ($Salary_Drawn==3)) && ($permited==1) )
if($leadid>0 && ((strlen($strFinal_Bid)>0) && (((($Salary_Drawn==2) || ($Salary_Drawn==3)) && $Employment_Status==1) || ($Employment_Status==0))) && $permited==1)
	{

$arrfinal_bidders="";
$getbankid="";
for($i=0;$i<count($arrFinal_Bid);$i++)
		{	
	if(strlen($Final_Bid[$i])>1)
			{
			if(((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton")) && ($Residential_Status==1 || $Residential_Status==3 || $Residential_Status==4 || $Residential_Status==5))
			{
				$arrfinal_bidders[]=$arrFinal_Bid[$i];
				$getbankid[]=$Final_Bid[$i];
			}
			else if(((strncmp ("Citifinancial", $Final_Bid[$i],12))==0 || ($Final_Bid[$i]=="Citifinancial")))
			{
				$arrfinal_bidders[]=$arrFinal_Bid[$i];
				$getbankid[]=$Final_Bid[$i];
			}
			else
			{
				$arrfinal_bidders[]=$arrFinal_Bid[$i];
				$getbankid[]=$Final_Bid[$i];

			}
			}
			

		}
		//print_r($arrfinal_bidders);
		//print_r($getbankid);


		$getarrfinal_bidders=implode(',',$arrfinal_bidders);

	if(strlen($getarrfinal_bidders)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}

		$DataArray = array('Bidderid_Details'=>$getarrfinal_bidders, 'Allocated'=>$Allocated);	
		$wherecondition ="(RequestID=".$leadid.")";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
		
		}
		}

	

//if ($leadid>0 && $Is_Valid==1 && (($Salary_Drawn==2) || ($Salary_Drawn==3)) && ($permited==1))
if ($leadid>0 && (((($Salary_Drawn==2) || ($Salary_Drawn==3)) && $Employment_Status==1) || ($Employment_Status==0)) && $permited==1)
 { ?>

 <?

$getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$getCompany_Name.'"';
list($recordcount,$grow)=Mainselectfunc($getcompany,$array = array());

$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$citicategory= $grow["citibank"];
$barclayscategory= $grow["barclays"];
$stanccategory = $grow["standard_chartered"];

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


if(count($FinalBidder)>0 && (strlen($strFinal_Bid)>1))
	 {
	?>
	<div align="center" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:22px;"><b>Your application has been scanned under below mentioned Banks for Personal Loan Eligibility:<br />
<table><tr><td width="15" height="37" valign="middle" class="fontbld10">&nbsp; 1) &nbsp;</td>
<td width="97"><img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" height="26"/></td>
<td width="27" valign="middle" class="fontbld10">&nbsp;&nbsp; 2) &nbsp;</td>
<td width="86"> <img src="http://www.deal4loans.com/new-images/bajaj-finserv-logo.jpg" /></td>
<!--<td width="27" valign="middle" class="fontbld10">&nbsp;&nbsp; 3) &nbsp;</td>
<td width="74"> <img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" /></td>-->
<td width="27" valign="middle"class="fontbld10">&nbsp;&nbsp; 3) &nbsp;</td>
<td width="56"> <img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg" /></td>
<td width="21" valign="middle"class="fontbld10">&nbsp;&nbsp;4)&nbsp;</td>
<td width="103"><img src="new-images/pl/icici_lgo.jpg" width="99" height="27" /></td>
<td width="28" valign="middle"class="fontbld10">&nbsp;&nbsp;5)&nbsp;</td>
<td width="100"><img src="http://www.deal4loans.com/new-images/pl/ing_vlgo.jpg"  width="100"  /></td>
</tr></table>
<font style="color:#CC3333;">--------------------------------------------------------------------------------------------------------------------------------------------<br /></font>
We have found as per your details you are eligibile for :<br /><br />

</b></div>
<table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td height="35" background="new-images/sixnewbox.jpg" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
           <tr align="center">
            <td width="140" height="35" class="fontbld10">Bank Name</td>
            <td width="129" class="fontbld10">Interest
Rate</td>
            <td width="139" class="fontbld10">Maximum Loan Eligibility</td>
            <td width="104" class="fontbld10">EMI (Per month)</td>
            <td width="87" class="fontbld10">Tenure<br /> 
              (in Yrs)</td>
						<td width="361" class="fontbld10">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  <? 
   
if(count($FinalBidder)>0)
	 {
	?>
   
     <?
$getrespf="";
$getrespf="";
$getidpf="";
$actual_ident_proof="";
$actual_residence_proof="";
$actual_income_proof="";
$getinpf="";
$getdocpf="";
for($i=0;$i<count($arrfinal_bidders);$i++)
			{
	if(((strncmp ("Standard", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Standard Chartered")) && $stanccategory=='')
	{
	}
	else if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Citibank")) && $citicategory=='')
	{
	}
	else if(($Final_Bid[$i]=="HappyRupee") && ($hdfccategory==''))
		{
		}	
	else
				{ $shownToBidders_Arr[] = $Final_Bid[$i];
//echo $Final_Bid[$i];
		//
		$getdoc=("select document_proof,identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'");
		list($recordcount,$myrow)=Mainselectfunc($getdoc,$array = array());

if($recordcount>0)
				{
		$identification_prf=$myrow["identification_proof"];
	$residence_prf=$myrow["residence_proof"];
	$income_prf=$myrow["income_proof"];
	$document_prf=$myrow["document_proof"];
//echo $document_prf."<br>";
	$arrid_pf=explode(",",$identification_prf);
	$arrres_pf=explode(",",$residence_prf);
	$arrinc_pf=explode(",",$income_prf);
	$arrdoc_pf=explode(",",$document_prf);


$getidpf=array_intersect($Document_proof,$arrid_pf);
$getrespf=array_intersect($Document_proof,$arrres_pf);
$getinpf=array_intersect($Document_proof,$arrinc_pf);
$getdocpf=array_intersect($Document_proof,$arrdoc_pf);


}
?>
<tr>
        <td height="57" align="center" background="new-images/sixnewbox.jpg" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">          <tr align="center">
<!--//add Bank alogos-->
<?
	if(($getbankid[$i]=="HDFC Bank") || ($getbankid[$i]=="HDFC"))
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" />';
	}
else if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
		{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-fulrtn.jpg" />';
	}
	else if($getbankid[$i]=="Kotak")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif"  />';

	}
	else if($getbankid[$i]=="Citibank")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" />';
	
	}
	else if($getbankid[$i]=="Barclays Finance" || (strncmp ("Barclays", $getbankid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg"/>';
	
	}
	else if($getbankid[$i]=="Standard Chartered" || (strncmp ("Standard", $getbankid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg"/>';
	}
	else if($Final_Bid[$i]=="Bajaj Finserv")
	{
		$imagebank='<img src="http://www.deal4loans.com/new-images/bajaj-finserv-logo.jpg" />';
	}
	else
		{
		$imagebank='';
		}
	
	?>
             <td width="138" height="30" ><? echo  $imagebank; ?><br />
<? echo $getbankid[$i];?></td>
 
	
    
	<? if(($getbankid[$i]=="HDFC Bank") || ($getbankid[$i]=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{
	?>
			<td width="125" class="fontbld10"><? echo $hdfcinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $hdfcperlacemi; ?></td>-->
            <td width="137"  ><? echo $hdfcgetloanamout; ?></td>
            <td width="104" ><? echo $hdfcgetemicalc; ?></td>
            <td width="87" ><? echo $hdfcterm; ?></td>
		 
	<?
		}
	else
		{?>
  <td width="400" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">&nbsp;</td>
	<?	}
		//echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	else if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
	{
	list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	?>
	<td width="125" class="fontbld10"><? echo $fullertoninterestrate; ?></td>
            <!--<td width="204"  ><? //echo $fullertonperlacemi; ?></td>-->
            <td width="137"  ><? echo $fullertongetloanamout; ?></td>
            <td width="102" ><? echo $fullertongetemicalc; ?></td>
            <td width="87" ><? echo $fullertonterm; ?></td>
	
	<?
		}
	else
		{?>
  <td width="400" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">&nbsp;</td>
		<? }
		
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
	?>

	 <td  width="400" bgcolor="#FFFFFF" height="51" colspan="4"><b>&nbsp;</b></td>
		
	<? //echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif((($getbankid[$i]=="CITIBANK") ||  ($getbankid[$i]=="Citibank")) && (strlen($citicategory)>0))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlacemi)=citibank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$age,$citicategory,$getCompany_Name);
	if($citigetloanamout>0)
		{
		?>
		<td width="129" class="fontbld10"><? echo $citiinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $citiperlacemi; ?></td>-->
            <td width="139"  ><? echo $citigetloanamout; ?></td>
            <td width="104" ><? echo $citigetemicalc; ?></td>
            <td width="89" ><? echo $cititerm; ?></td>

	<?
		}
	else
		{
		?>
 <td width="400" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">&nbsp;</td>
		<? }

	}
	elseif($getbankid[$i]=="Barclays")
	{
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm,$barclayperlacemi)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
	if($barclaygetloanamout>0)
		{
	?>
	<td width="129" class="fontbld10"><? echo $barclayinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $barclayperlacemi; ?></td>-->
            <td width="139"  ><? echo $barclaygetloanamout; ?></td>
            <td width="104" ><? echo $barclaygetemicalc; ?></td>
            <td width="89" ><? echo $barclayterm; ?></td>
		<?
		}
	else
		{?>
 <td width="400" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">&nbsp;</td>
		<? }
	}
	else
	{
	?>
	
  <td colspan="4" bgcolor="#FFFFFF" class="fontbld10" width="400">Check this bank offer via phone</td>
		<? 
		
	}
	?>

    <td width="141">
    <?php
	
	if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
		{
		
    ?>
        <form action="get-instantquote-submit.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		  <input type="hidden" name="max_loan_amount" value="<?php echo $fullertongetloanamout ; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $fullertongetemicalc ; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $fullertonterm ; ?>" />
            <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $getbankid[$i]; ?>">
			<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form>
    
    <?php
	}
	else
	{
	?>
    <form action="apply_pl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $getbankid[$i]; ?>">
			<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form>
     <?php } ?> 
                 </td>
  </tr>
</table></td></tr>
  <?
			}} ?>
			 </table>
      <tr>	
 <td align="right" bgcolor="#dbf2ff"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a>&nbsp; </td>
    </tr>
  <tr>
        <td ><img width="959" height="11" src="new-images/hl-thnk-btm.jpg"/></td>
      </tr>
    </table>
 
 <? 	$shownToBidders_Str = implode(",",$shownToBidders_Arr);

		$DataArray = array('checked_bidders'=>$shownToBidders_Str);	
		$wherecondition ="(RequestID=".$leadid.")";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
	 }
 	 }	 

	 else
	 {?>
 
	 <? }
	

?>
        <? }?>
  </div>
 </div>
<?php include "footer1.php"; ?>
</body>
</html>