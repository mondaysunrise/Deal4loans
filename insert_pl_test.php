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
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Salary_Drawn = $_REQUEST['Salary_Drawn'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Activation_Code = $_REQUEST['activation_code'];
			$Document_proof=$_REQUEST['Document_proof'];

			$Document_proof_doc=implode(",",$Document_proof);
			
	
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
	$getpldetails=("select City_Other,City,Company_Name,Name,Net_Salary,DOB,Reference_Code From Req_Loan_Personal Where (RequestID='".$leadid."')");
	
	 list($recordcount,$plrow)=MainselectfuncNew($getpldetails,$array = array());
		$cntr=0;
	
	//echo "select Other_City,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
	//$plrow = mysql_fetch_array($getpldetails);
$getCompany_Name = $plrow[$cntr]['Company_Name'];
$City = $plrow[$cntr]['City'];
$Name =  $plrow[$cntr]['Name'];
$DOB = $plrow[$cntr]['DOB'];
$Net_Salary = $plrow[$cntr]['Net_Salary'];
$Other_City = $plrow[$cntr]['City_Other'];	
$Reference_Code = $plrow[$cntr]['Reference_Code'];

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
	
	
	if($leadid>0)
				{														
					
			 $DataArray = array("Reference_Code"=>$reference_code, "Company_Type"=>$Company_Type, "PL_EMI_Amt"=>$PL_EMI_Amt, "Primary_Acc"=>$Primary_Acc, "Residential_Status"=>$Residential_Status, "Card_Limit"=>$Credit_Limit, "Years_In_Company"=>$Years_In_Company, " Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A, "identification_proof"=>$Document_proof_doc, "Is_Valid"=>$Is_Valid, "Bidderid_Details"=>$strFinal_Bid, "Allocated"=>$Allocated, "Salary_Drawn"=>$Salary_Drawn, "Direct_Allocation"=>1, "HL_Bank"=>$Activation_Code);
		$wherecondition ="RequestID=".$leadid;
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

		
		
	}//$_POST
	
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
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
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
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


if($leadid>0 && (strlen($strFinal_Bid)>0) && (($Salary_Drawn==2) || ($Salary_Drawn==3)) )
	{

$arrfinal_bidders="";
$getbankid="";
for($i=0;$i<count($arrFinal_Bid);$i++)
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

$DataArray = array("Bidderid_Details"=>$getarrfinal_bidders, "Allocated"=>$Allocated);
$wherecondition ="RequestID=".$leadid;
Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
		
		}
		}

	

if ($leadid>0 && $Is_Valid==1 && (($Salary_Drawn==2) || ($Salary_Drawn==3)))
 {?>

 <?

 $getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$getCompany_Name.'"';
 //echo $getcompany;
list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$n=0;

$hdfccategory= $grow[$n]["hdfc_bank"];
$fullertoncategory= $grow[$n]["fullerton"];
$citicategory= $grow[$n]["citibank"];
$barclayscategory= $grow[$n]["barclays"];
$stanccategory = $grow[$n]["standard_chartered"];

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


if(count($FinalBidder)>0)
	 {
	?>
	<div align="center" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:22px;"><b>Your application has been scanned under below mentioned Banks for Personal Loan Eligibility:<br />
<table><tr><td width="15" height="37" valign="middle" class="fontbld10">&nbsp; 1) &nbsp;</td>
<td width="97"><img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" height="26"/></td>
<td width="27" valign="middle" class="fontbld10">&nbsp;&nbsp; 2) &nbsp;</td>
<td width="86"> <img src="http://www.deal4loans.com/new-images/thnk-axis.gif" /></td>
<td width="27" valign="middle" class="fontbld10">&nbsp;&nbsp; 3) &nbsp;</td>
<td width="74"> <img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" /></td>
<td width="27" valign="middle"class="fontbld10">&nbsp;&nbsp; 4) &nbsp;</td>
<td width="56"> <img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg" /></td>
<td width="21" valign="middle"class="fontbld10">&nbsp;&nbsp;5)&nbsp;</td>
<td width="103"><img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg" /></td>
<td width="28" valign="middle"class="fontbld10">&nbsp;&nbsp;6)&nbsp;</td>
<td width="100"><img src="http://www.deal4loans.com/new-images/hl-thnk-sbi.jpg" width="100" height="35" /></td>
</tr></table>
<font style="color:#CC3333;">--------------------------------------------------------------------------------------------------------------------------------------------<br /></font>
We have found as per your details you are eligibile for :<br /><br />

</b></div>
<table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td height="35" background="new-images/sevenbox-hdr.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
           <tr align="center">
            <td width="140" height="35" class="fontbld10">Bank Name</td>
            <td width="98" class="fontbld10">Interest
Rate</td>
            <td width="128" class="fontbld10">Maximum Loan Eligibility</td>
            <td width="143" class="fontbld10">EMI (Per month)</td>
            <td width="89" class="fontbld10">Tenure<br /> (in Yrs)</td>
			<? if((strlen($Document_proof_doc)>0) )
		 {?>
            <td width="221" class="fontbld10">Pending Documents</td>
			<? }?>
			<td width="141" class="fontbld10">&nbsp;</td>
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
	else
				{
//echo $Final_Bid[$i];
		//
		$getdoc=("select document_proof,identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'");
		//echo "select identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'";
		 list($recordcount,$myrow)=MainselectfuncNew($getdoc,$array = array());
		$p=0;
		
		//$myrow = mysql_fetch_array($getdoc);
		//$recordcount = mysql_num_rows($getdoc);
if($recordcount>0)
				{
		$identification_prf=$myrow[$p]["identification_proof"];
	$residence_prf=$myrow[$p]["residence_proof"];
	$income_prf=$myrow[$p]["income_proof"];
	$document_prf=$myrow[$p]["document_proof"];
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
        <td height="57" align="center" background="new-images/sevenbox.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">          <tr align="center">
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
	else
		{
		$imagebank='';
		}
	
	?>
             <td width="140" height="30" ><? echo  $imagebank; ?><br />
<? echo $getbankid[$i];?></td>
 
	
    
	<? if(($getbankid[$i]=="HDFC Bank") || ($getbankid[$i]=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{
	?>
			<td width="98" class="fontbld10"><? echo $hdfcinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $hdfcperlacemi; ?></td>-->
            <td width="128"  ><? echo $hdfcgetloanamout; ?></td>
            <td width="143" ><? echo $hdfcgetemicalc; ?></td>
            <td width="89" ><? echo $hdfcterm; ?></td>
		 
	<?
		}
	else
		{?>
  <td width="458" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
	<?	}
		//echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	else if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
	{
	list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	?>
	<td width="98" class="fontbld10"><? echo $fullertoninterestrate; ?></td>
            <!--<td width="204"  ><? //echo $fullertonperlacemi; ?></td>-->
            <td width="128"  ><? echo $fullertongetloanamout; ?></td>
            <td width="143" ><? echo $fullertongetemicalc; ?></td>
            <td width="89" ><? echo $fullertonterm; ?></td>
	
	<?
		}
	else
		{?>
  <td width="458" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
		<? }
		
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
	?>

	 <td  width="458" bgcolor="#FFFFFF" height="51" colspan="4"><b>Get Quote on call from Bank</b></td>
		
	<? //echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif((($getbankid[$i]=="CITIBANK") ||  ($getbankid[$i]=="Citibank")) && (strlen($citicategory)>0))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlacemi)=citibank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$age,$citicategory,$getCompany_Name);
	if($citigetloanamout>0)
		{
		?>
		<td width="98" class="fontbld10"><? echo $citiinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $citiperlacemi; ?></td>-->
            <td width="128"  ><? echo $citigetloanamout; ?></td>
            <td width="143" ><? echo $citigetemicalc; ?></td>
            <td width="89" ><? echo $cititerm; ?></td>

	<?
		}
	else
		{
		?>
 <td width="458" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
		<? }

	}
	elseif($getbankid[$i]=="Barclays")
	{
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm,$barclayperlacemi)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
	if($barclaygetloanamout>0)
		{
	?>
	<td width="98" class="fontbld10"><? echo $barclayinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $barclayperlacemi; ?></td>-->
            <td width="128"  ><? echo $barclaygetloanamout; ?></td>
            <td width="143" ><? echo $barclaygetemicalc; ?></td>
            <td width="89" ><? echo $barclayterm; ?></td>
		<?
		}
	else
		{?>
 <td width="458" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
		<? }
	}
	else
	{
	?>
	
   <td width="458" bgcolor="#FFFFFF" height="53" colspan="4"><b>Get Quote on call from Bank</b></td>
		<? 
		
	}
	 if((strlen($Document_proof_doc)>0) && $recordcount>0)
	 {
			?>
     <?php   
            if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
	{
	?>
    <td width="362" colspan="2" align="left" style="padding-left:15px;" >
    <?php
	} else  { ?>
		<td width="221" >
       <?php } ?> 
        
		<? if ($recordcount>0)
				 {
		if(count($getidpf)==0 && strlen($identification_prf)>0)
					 {
						$docreq1= @str_replace(",", "/", $identification_prf)."(Any one of these)";
					 }
					
					 if(count($getrespf)==0 && strlen($residence_prf)>0)
					 {
						 if(count($getidpf)==0)
						 {
							$docreq2="and";
						 }
						$docreq3=" ".@str_replace(",", "/", $residence_prf)."(Any one of these)";
					 }
					 if(count($getinpf)==0 && strlen($income_prf)>0)
					 {
						 if(count($getrespf)==0)
						 {
							$docreq4="and";
						 }
						$docreq5=" ".@str_replace(",", "/", $income_prf)." ";
					 }
					
if(count($getdocpf)>0 && count(array_diff($arrdoc_pf,$getdocpf))>0)
		{
			if((count($getinpf)==0 && strlen($income_prf)>0)|| (count($getidpf)==0 &&  strlen($identification_prf)>0) || (count($getrespf)==0 && strlen($residence_prf)>0) )
						 {
							$docreq6="and";
						 }
						 
						 $getexactpf=array_diff($arrdoc_pf,$getdocpf);
						 $strexactpf=implode(",",$getexactpf);

			$docreq7= " ".@str_replace(",", " | ", $strexactpf)."";
		}
		elseif(count($getdocpf)==0 && count(array_diff($arrdoc_pf,$getdocpf))>0)
					 {	
						if((count($getinpf)==0 && strlen($income_prf)>0)|| (count($getidpf)==0 &&  strlen($identification_prf)>0) || (count($getrespf)==0 && strlen($residence_prf)>0) )
						 {
							//"<font color='#000000'>and</font>"
							$docreq8= "and";
						 }
				
			$docreq9=" ".@str_replace(",", " | ", $document_prf)."";
					 }

if((count($getidpf)>0) && (count($getrespf)>0) && (count($getinpf)>0) && (count(array_diff($arrdoc_pf,$getdocpf))==0) && count($getdocpf)>0)
					 {	
						$docreq10= "Complete Documents";
					 }
					 elseif((count($getidpf)>0) && (count($getrespf)>0) && (strlen($income_prf)==0) && (count(array_diff($arrdoc_pf,$getdocpf))==0) && count($getdocpf)>0)
					 {
						$docreq11= "Complete Documents";
					 }

					 $exactdocreq=$docreq1.$docreq2.$docreq3.$docreq4.$docreq5.$docreq6.$docreq7.$docreq8.$docreq9.$docreq10.$docreq11;
					//echo $exactdocreq;
 if((strncmp ("Fullerton", $getbankid[$i],9))!=0 || ($getbankid[$i]!="Fullerton"))
	{ 
?>
					 <u><a style="cursor:pointer;" onMouseover="ddrivetip('<? echo $exactdocreq; ?>')" onMouseout="hideddrivetip()">Pending Document</a></u>
					 <?
			}		
					
				 }
		 else
		 {
			 echo"";
		 }?>
    <?php
    if((strncmp ("Fullerton", $getbankid[$i],9))!=0 || ($getbankid[$i]!="Fullerton"))
	{    
	 ?>
	</td>
    <?php } ?>
    
	<? }?>

	
    <?php
	if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
	{
	
	$toolTip = '';
	$toolTip = 'This will help in faster processing.<br>Upload all documents you can<br>Rest will be collected by Fullerton team';
	?>
    <form action="upload-documents.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
			<input type="submit" style="width: 190px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(new-images/upload.gif); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onMouseover="ddrivetip('<? echo $toolTip; ?>')" onMouseout="hideddrivetip()" />
				  </form>
    
    <?php 
	}
	else
	{
	?>
    <td width="141">
    <form action="apply_pl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $getbankid[$i]; ?>">
			<input type="submit" style="width: 87px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(new-images/start.gif); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
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
 
 <? }
 	 }	 

	 else
	 {?>
 
	 <? }

$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		{
		 $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
		 
		  list($recordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
		$r=0;
		//$get_Bankresult=ExecQuery($get_Bank);
		//$recordcount = mysql_num_rows($get_Bankresult);
		if($recordcount>0)
			{
		 ?>
	<div style="text-align:center; font-weight:bold; line-height:18px; padding:15px 0px;">
		There are some other financial products that are on offer for you on the basis of details you have submitted.
  <br />
		If you are interested, Go ahead and <font color="#5e3307">Apply</font>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <?
		 
		while($r<count($myrow))
        {
        ?>
            <td valign="top" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
                <tr>
                  <td height="30" class="crdbhdng"><a href="<? if (strlen($myrow[$r]["cc_bank_url"])>0) {echo $myrow[$r]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow[$r]["cc_bank_name"];?></a></td>
                </tr>
                <tr>
                  <td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow[$r]["cc_bank_url"])>0) {echo $myrow[$r]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow[$r]["card_image"];?>"  width="150" height="244" /></a></td>
                </tr>
                <tr>
                  <td height="22" valign="bottom" class="crdbold">Features</td>
                </tr>
                <tr>
                  <td height="270" valign="top" class="crdtext"><? echo $myrow[$r]["cc_bank_features"];?></td>
                </tr>
                <tr>
                  <td align="center" valign="bottom"><a href="<? if (strlen($myrow[$r]["cc_bank_url"])>0) {echo $myrow[$r]["cc_bank_url"];} else {echo "#";}?>" target="_blank">
                    <input name="image" type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" />
                  </a></td>
                </tr>
            </table></td>
            <?   $r=$r+1;
			
			 }?>
          </tr>
        </table>
		</div>

		<? }
		}
	else
	 {
		if(count($FinalBidder)>0)
	 {?>
        <?}
	 }

?>
        <? }?>
  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div>


   
</body>
</html>