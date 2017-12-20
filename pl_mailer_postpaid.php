<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders_new.php';
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

	if ($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		   /* $leadid = $_REQUEST['leadid'];
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Salary_Drawn = $_REQUEST['Salary_Drawn'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Document_proof=$_REQUEST['Document_proof'];
			$Document_proof_doc=implode(",",$Document_proof);
*/
		 $leadid =439461; 
			$PL_EMI_Amt =""; 
			$Company_Type =3; 
			$Residential_Status =1;
			$Primary_Acc= "HDFC";
			$Loan_Any =""; 
			$EMI_Paid = "";
			$Credit_Limit = "";
			$Salary_Drawn =2; 
			$Total_Experience =10; 
			$Years_In_Company = 5;
			
	
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
	$getpldetails=ExecQuery("select City_Other,City,Company_Name,Name,Net_Salary,DOB,Mobile_Number From Req_Loan_Personal Where (RequestID='".$leadid."')");
	echo "select Other_City,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
	$plrow = mysql_fetch_array($getpldetails);
$getCompany_Name = $plrow['Company_Name'];
$City = $plrow['City'];
$Name = $plrow['Name'];
$DOB = $plrow['DOB'];
$Net_Salary = $plrow['Net_Salary'];
$Other_City = $plrow['City_Other'];	
$Mobile_Number = $plrow['Mobile_Number'];

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
	
				
			$crap = $City_Other." ".$Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
	
	if($leadid>0)
				{														
				$qry="Update Req_Loan_Personal SET Company_Type='$Company_Type',PL_EMI_Amt='$PL_EMI_Amt',Primary_Acc='$Primary_Acc', Residential_Status='$Residential_Status' ,Card_Limit= '$Credit_Limit', Years_In_Company='$Years_In_Company', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A',identification_proof='$Document_proof_doc' Where RequestID=".$leadid;
		
					//echo $qry;
					//$result = ExecQuery($qry);
				
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

</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">

<?php 

if ($leadid>0 && ($Salary_Drawn==1))
{
	?>

<h2 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:12px !important; line-height:20px;" > Dear Customer,<br>
As per information provided by you,<br>
We were not able to find a Personal Loan quote from any Bank.<br><br />
Team Deal4loans </h2>

<?  }
else
 {  

 $getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$getCompany_Name.'"';
 //echo $getcompany;
$getcompanyresult = ExecQuery($getcompany);
$grow=mysql_fetch_array($getcompanyresult);
$recordcount = mysql_num_rows($getcompanyresult);
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

	list($Bnkd,$bidder_id)=getBiddersList("Req_Loan_Personal",$leadid,$strCity);
$finalchk_bid=implode(',',$bidder_id);
//print_r($bidder_id);
$finalBnkd=implode(',',$Bnkd);
$fnl_chk_bid="";
for($j=0;$j<count($Bnkd);$j++)
			{
$getbankid_new="select Bank_Name from Bank_Master where BankID=".$Bnkd[$j];
		//echo $getbankid;
		$bankidresult_new=ExecQuery($getbankid_new);
		$row_new=mysql_fetch_array($bankidresult_new);
		$bnk_nm_new= $row_new["Bank_Name"];

	if(((strncmp ("Standard", $bnk_nm_new,8))==0 ||  ($bnk_nm_new=="Standard Chartered")) && $stanccategory=='')
	{

	}
	else if(((strncmp ("Citibank", $bnk_nm_new,8))==0 ||  ($bnk_nm_new=="Citibank")) && $citicategory=='')
	{

	}
	else if(((strncmp ("Fullerton", $bnk_nm_new,9))==0 ||  ($bnk_nm_new=="Fullerton")) && ($Residential_Status==6 || $Residential_Status==2 || $Residential_Status==7  || $Residential_Status==8))
		{
		}
	else
		{
			$fnl_chk_bid[]=$bidder_id[$j];
		}

			}
$final_chk_bid=implode(',',$fnl_chk_bid);

$plmailer='<div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#D3120B !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"><b>Dear'.$Name.'</b></div>

<table><tr><td><div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#D3120B !important;  padding-left:10px; font-size:12px !important; line-height:20px; "><b>Your contact number is - '.$Mobile_Number.'&nbsp;</b><br />
Here are your Personal loan quotes from all Banks.
To get more information from   all Banks - </b><br />
<b>To Apply in your choice of Bank- Apply against the Bank</b></div>
</td></tr></table>
</form>';

if(strlen($finalchk_bid)>0)
			{
	
	$plmailer.='<table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td height="40" background="http://www.deal4loans.com/new-images/pl-thnk-hdr2-new.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
           <tr align="center">
			   <td width="139" height="35" class="fontbld10">Bank Name</td>
			   <td width="105" class="fontbld10">Interest Rate</td>
			   <td width="204" class="fontbld10">Maximum Loan Eligibility</td>
				<td width="168" class="fontbld10">EMI (Per month)</td>
				<td width="113" class="fontbld10">Tenure (in Yrs)</td>
				<td width="231" class="fontbld10">Apply</td>
          </tr>
        </table></td>
      </tr>';
	
      list($Bnkd,$bidder_id)=getBiddersList("Req_Loan_Personal",$leadid,$strCity);
$finalchk_bid=implode(',',$bidder_id);
//print_r($bidder_id);
$finalBnkd=implode(',',$Bnkd);
if(strlen($finalchk_bid)>0)
			{
$getrespf="";
$getrespf="";
$getidpf="";
$actual_ident_proof="";
$actual_residence_proof="";
$actual_income_proof="";
$getinpf="";
$getdocpf="";
for($i=0;$i<count($Bnkd);$i++)
			{
$getbankid="select Bank_Name from Bank_Master where BankID=".$Bnkd[$i];
		//echo $getbankid;
		$bankidresult=ExecQuery($getbankid);
		$row=mysql_fetch_array($bankidresult);
		$bnk_nm= $row["Bank_Name"];

	if(((strncmp ("Standard", $bnk_nm,8))==0 ||  ($bnk_nm=="Standard Chartered")) && $stanccategory=='')
	{

	}
	else if(((strncmp ("Citibank", $bnk_nm,8))==0 ||  ($bnk_nm=="Citibank")) && $citicategory=='')
	{

	}
	else if(((strncmp ("Fullerton", $bnk_nm,9))==0 ||  ($bnk_nm=="Fullerton")) && ($Residential_Status==6 || $Residential_Status==2 || $Residential_Status==7  || $Residential_Status==8))
		{
		

		}
	else
				{

		
$plmailer.='<tr>
        <td height="62" align="center" background="http://www.deal4loans.com/new-images/pl-thnk-bnkbg2-new.gif" style="background-repeat:no-repeat; "><form name="hdfc_form" action="http://www.deal4loans.com/apply-personal-loans-thanks-mailer.php" method="Post" target="_blank">
		  <input type="hidden" name="choosenBid_id" value="'.$bidder_id[$i].'">
		  <input type="hidden" name="pl_last_inserted" id="pl_last_inserted"  value="'.$leadid.'">
		  <input type="hidden" name="bank_name" value="'.$bnk_nm.'"><table width="100%"  border="0" cellspacing="0" cellpadding="0">          <tr align="center">';

	if(($bnk_nm=="HDFC Bank") || ($bnk_nm=="HDFC"))
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" />';
	}
else if((strncmp ("Fullerton", $bnk_nm,9))==0 || ($bnk_nm=="Fullerton"))
		{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-fulrtn.jpg" />';
	}
	else if($bnk_nm=="Kotak")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif"  />';

	}
	else if($bnk_nm=="Citibank")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" />';
	
	}
	else if($bnk_nm=="Barclays Finance" || (strncmp ("Barclays", $bnk_nm,8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg"/>';
	
	}
	else if($bnk_nm=="Standard Chartered" || (strncmp ("Standard", $bnk_nm,8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg"/>';
	
	}
	else
		{
		$imagebank='';
		}
	

             $plmailer.='<td width="115" height="30" >&nbsp;&nbsp;'.$imagebank.'<br />
'.$bnk_nm.'</td>'; 

if(($bnk_nm=="HDFC Bank") || ($bnk_nm=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{
		$plmailer.='<td width="80" class="fontbld10">'.$hdfcinterestrate.'</td>
           <td width="170"  >'.$hdfcgetloanamout.'</td>
            <td width="112" >'.$hdfcgetemicalc.'</td>
            <td width="64" >'.$hdfcterm .'</td>';
	}
	else
		{
$plmailer.='<td width="299" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>';
	}
		
	}
	elseif(((strncmp ("Fullerton", $bnk_nm,9))==0 || ($bnk_nm=="Fullerton")))
	{
	list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	$plmailer.='<td width="80" class="fontbld10">'.$fullertoninterestrate.'</td>
          	 <td width="170"  >'.$fullertongetloanamout.'</td>
            <td width="112" >'.$fullertongetemicalc.'</td>
            <td width="64" >'.$fullertonterm.'</td>';
		}
	else
		{ 
  $plmailer.='<td width="299" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>';
	}		
	}
	elseif($bnk_nm=="Kotak")
	{
	 
	 $plmailer.='<td   bgcolor="#FFFFFF" height="51" colspan="4"><b>Get Quote on call from Bank</b></td>';
	}
	elseif((($bnk_nm=="CITIBANK") ||  ($bnk_nm=="Citibank")) && (strlen($citicategory)>0))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlacemi)=citibank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$age,$citicategory,$getCompany_Name);
	if($citigetloanamout>0)
		{
		$plmailer.='<td width="80" class="fontbld10">'.$citiinterestrate.'</td>
            <td width="170"  >'.$citigetloanamout.'</td>
            <td width="112" >'.$citigetemicalc.'</td>
            <td width="64" >'.$cititerm.'</td>';
		}
	else
		{
		$plmailer.='<td width="299" height="53" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>';
		}
	}
	elseif($bnk_nm=="Barclays" || (strncmp ("Barclay", $bnk_nm,7))==0)
	{
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm,$barclayperlacemi)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
	if($barclaygetloanamout>0)
		{
		$plmailer.='<td width="80" class="fontbld10">'.$barclayinterestrate.'</td>          
            <td width="170"  >'.$barclaygetloanamout.'</td>
            <td width="112" >'.$barclaygetemicalc.'</td>
            <td width="64" >'.$barclayterm.'</td>';
		}
	else
		{
 $plmailer.='<td width="299" height="53" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>';
		}
	}
	else
	{
   $plmailer.='<td  bgcolor="#FFFFFF" width="299" height="53" colspan="4"><b>Get Quote on call from Bank</b></td>';
	}
	$plmailer.='<td  width="168">&nbsp;<input type="image" name="Submit"  src="http://www.deal4loans.com/new-images/apl-yelo1.gif" style="border:0px; " /></td>
  </tr>
</table></form></td></tr>';
		}} 
			 $plmailer.='</table>
			 <tr>	
 <td align="right" bgcolor="#dbf2ff"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a>&nbsp; </td>
    </tr>
  <tr>
        <td ><img width="959" height="11" src="http://www.deal4loans.com/new-images/hl-thnk-btm.jpg"/></td>
      </tr>
	   </table>';
 }
 echo $plmailer."<br>";
$email="ranjana5chauhan@gmail.com";
 $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	mail($email,'Thanks for Registering for Personal Loan on deal4loans.com', $plmailer, $headers);
 	 }	 
	 else
	 {?>
 	 <? }?>
 </div>
</div>
<? }?>
</body>
</html>