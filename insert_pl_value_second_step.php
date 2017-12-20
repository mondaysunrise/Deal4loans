<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders_test.php';
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
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$chkbnkID = $_REQUEST['chkbnkID'];
			$Document_proof=$_REQUEST['Document_proof'];
			$Document_proof_doc=implode(",",$Document_proof);
			$bank_id = $_POST['bankid'];
						
$chk_bid="";
$n       = count($chkbnkID);
$i      = 0;
while ($i < $n)
{
  $chk_bid .= "$chkbnkID[$i], ";
 $i++;
}
$chk_bid = substr(trim($chk_bid), 0, strlen(trim($chk_bid))-1);
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
	$getpldetails=("select Mobile_Number,City_Other,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')");
	 list($recordcount,$plrow)=MainselectfuncNew($getpldetails,$array = array());
		$cntr=0;

$getCompany_Name = $plrow[$cntr]['Company_Name'];
$City = $plrow[$cntr]['City'];
$Name = $plrow[$cntr]['Name'];
$DOB = $plrow[$cntr]['DOB'];
$Net_Salary = $plrow[$cntr]['Net_Salary'];
$Other_City = $plrow[$cntr]['City_Other'];	
$Mobile_Number = $plrow[$cntr]['Mobile_Number'];	

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
		

$DataArray = array("Company_Type"=>$Company_Type, "PL_EMI_Amt"=>$PL_EMI_Amt, "Primary_Acc"=>$Primary_Acc, "Residential_Status"=>$Residential_Status, "Card_Limit"=>$Credit_Limit, "Years_In_Company"=>$Years_In_Company, " Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A);
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
font-size:11px;
line-height:13px;
}
.fontbld10 {
font-size:11px;
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

if ($leadid>0)
 {?>
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a call from us.</h1>
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

$nchk_bid=explode(',',$chk_bid);
for($r=0;$r<count($nchk_bid);$r++)
 {
	if($nchk_bid[$r]==1 && (strlen($citicategory)==0))
	 {

	 }
	 else if($nchk_bid[$r]==8 && (strlen($stanccategory)==0))
	 {

	 }
	 else
	 {
		 $nchckbid[]=$nchk_bid[$r];
	 }
 }
$getnchckbid=implode(',',$nchckbid);

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
?>

 <?php 
	list($Bnkd,$bidder_id)= getBiddersList("Req_Loan_Personal",$leadid,$strCity,$getnchckbid);
 //	print_r($bidder_id);
//	print_r($Bnkd);
$finalchk_bid=implode(',',$bidder_id);
$finalBnkd=implode(',',$Bnkd);

$DataArray = array("checked_bidders"=>$finalchk_bid, "income_proof"=>$finalBnkd);
$wherecondition ="(RequestID='".$leadid."')";
Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);



if(count($Bnkd)>0 && strlen($finalBnkd)>0)
	 {
	?>
	<div align="center" style="line-height:28px; "><b>Your EMI and Rates quotes for the Personal Loan from partner Banks are listed Below.
</b></div>
<form name="pl_selected_bidders" action="pl_final_thanku.php" method="POST" >
<table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
	  <td height="40" style="background:url(new-images/pl-thank-hdnbg.gif) no-repeat center top;">
          <!--<td height="35" background="new-images/pl-thnk-hdr2-new.gif" style="background-repeat:no-repeat; ">--><table width="100%"  border="0" cellspacing="0" cellpadding="0">
           <tr align="center">
            <td width="173" height="40" class="fontbld10">Bank Name</td>
            <td width="172" class="fontbld10">Interest
Rate</td>
            <!--<td width="204" class="fontbld10">EMI (Per Lac) </td>-->
            <td width="193" class="fontbld10">Maximum Loan Eligibility</td>
            <td width="196" class="fontbld10" style="font-weight:normal; "><b>EMI</b> (Per month)</td>
            <td width="226" class="fontbld10" style="font-weight:normal; "><b>Tenure</b> (in Yrs)</td>
			 <!--<td width="164" class="fontbld10">Interested In</td>-->
			<? //if((strlen($Document_proof_doc)>0) )
		 //{?>
           <!--<td width="164" class="fontbld10">Interested In</td>-->
			<?//}?>
          </tr>
        </table></td>
      </tr>
	  <? 
      	list($Bnkd,$bidder_id)= getBiddersList("Req_Loan_Personal",$leadid,$strCity,$getnchckbid);


if(count($Bnkd)>0)
	 {
	?>
   
     <?

for($i=0;$i<count($Bnkd);$i++)
			{
	$getbankid="select Bank_Name from Bank_Master where BankID=".$Bnkd[$i];
		//echo $getbankid;
	 list($recordcount,$row)=MainselectfuncNew($getbankid,$array = array());
		$b=0;
	
		//$bankidresult=ExecQuery($getbankid);
		//$row=mysql_fetch_array($bankidresult);
		$bnk_nm= $row[$b]["Bank_Name"];
//echo
	if(((strncmp ("Standard", $bnk_nm,8))==0 ||  ($bnk_nm=="Standard Chartered")) && $stanccategory=='')
	{

	}
	else if(((strncmp ("Citibank", $bnk_nm,8))==0 ||  ($bnk_nm=="Citibank")) && $citicategory=='')
	{

	}
	else
				{

?>
<tr>
        <!--<td height="57" align="center" background="new-images/pl-thnk-bnkbg2-new.gif" style="background-repeat:no-repeat; ">-->
	<td  height="57" align="center" style="background:url(new-images/pl-thank-bg.gif) no-repeat center top;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">          <tr align="center">
<!--//add Bank alogos-->
<?
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
	
	?>
             <td width="169" height="30" >&nbsp;&nbsp;<? echo  $imagebank; ?><br />
<? echo $bnk_nm;?></td>
 	<? if(($bnk_nm=="HDFC Bank") || ($bnk_nm=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{
	?>
			<td width="176" class="fontbld10"><? echo $hdfcinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $hdfcperlacemi; ?></td>-->
            <td width="193"  ><? echo $hdfcgetloanamout; ?></td>
            <td width="196" ><? echo $hdfcgetemicalc; ?></td>
            <td width="226" ><? echo $hdfcterm; ?></td>
		 
	<?
		}
	else
		{?>
  <td  height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
	<?	}
		//echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	elseif((strncmp ("Fullerton", $bnk_nm,9))==0 || ($bnk_nm=="Fullerton"))
	{
	list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	?>
	<td width="160" class="fontbld10"><? echo $fullertoninterestrate; ?></td>
            <!--<td width="204"  ><? //echo $fullertonperlacemi; ?></td>-->
            <td width="150"  ><? echo $fullertongetloanamout; ?></td>
            <td width="193" ><? echo $fullertongetemicalc; ?></td>
            <td width="196" ><? echo $fullertonterm; ?></td>
	<?
		}
	else
		{?>
  <td  height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
		<?}
		
	}
	elseif($bnk_nm=="Kotak")
	{
	?>

	 <td   bgcolor="#FFFFFF" height="51" colspan="4"><b>Get Quote on call from Bank</b></td>
		
	<? //echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif((($bnk_nm=="CITIBANK") ||  ($bnk_nm=="Citibank")) && (strlen($citicategory)>0))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlacemi)=citibank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$age,$citicategory,$getCompany_Name);
	if($citigetloanamout>0)
		{
		?>
		<td width="160" class="fontbld10"><? echo $citiinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $citiperlacemi; ?></td>-->
            <td width="150"  ><? echo $citigetloanamout; ?></td>
            <td width="193" ><? echo $citigetemicalc; ?></td>
            <td width="196" ><? echo $cititerm; ?></td>

	<?
		}
	else
		{
		?>
 <td  height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
		<? }

	}
	elseif($bnk_nm=="Barclays")
	{
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm,$barclayperlacemi)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
	if($barclaygetloanamout>0)
		{ ?>
	<td width="169" class="fontbld10"><? echo $barclayinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $barclayperlacemi; ?></td>-->
            <td width="1706"  ><? echo $barclaygetloanamout; ?></td>
            <td width="193" ><? echo $barclaygetemicalc; ?></td>
            <td width="196" ><? echo $barclayterm; ?></td>
		<?
		}
	else
		{?>
 <td height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
		<? }
	}
	else
	{
	?>
	
   <td   bgcolor="#FFFFFF" height="53" colspan="5"><b>Get Quote on call from Bank</b></td>
		<? 
	}
	?>

	<!--<td width="168" >
	<input type="checkbox"  name="checked_bidders" id="checked_bidders" value="<? echo $bankID; ?>"/>apply
	</td>-->
	
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

  <tr>
			<td colspan="2" align="center">&nbsp;
			</td>
          </tr>
		  
         
	   </table>
	   </form>

 <? }
 ?>
 
 <?
 	 }	 

	 else
	 {?>
 
	 <? }?>

 </div>
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div>
<? }?>

   
</body>
</html>