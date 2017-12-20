<?php
ob_start();
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
			$Pincode = $_REQUEST['Pincode'];
			$Loan_Amount = $_REQUEST['Loan_Amount'];
			$Employment_Status = $_REQUEST['Employment_Status'];
			$CC_Holder = $_REQUEST['CC_Holder'];
			$Card_Vintage = $_REQUEST['Card_Vintage'];
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Document_proof=$_REQUEST['Document_proof'];
			$Document_proof_doc=implode(",",$Document_proof);
$IP = getenv("REMOTE_ADDR");
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
	$getpldetails=("select City_Other,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')");
	
	 list($recordcount,$plrow)=MainselectfuncNew($getpldetails,$array = array());
		$m=0;

$getCompany_Name = $plrow[$m]['Company_Name'];
$City = $plrow[$m]['City'];
$Name = $plrow[$m]['Name'];
$DOB = $plrow[$m]['DOB'];
$Net_Salary = $plrow[$m]['Net_Salary'];
$Other_City = $plrow[$m]['City_Other'];	

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
			$DataArray = array("IP_Address"=>$IP, "Company_Type"=>$Company_Type, "PL_EMI_Amt"=>$PL_EMI_Amt, "Primary_Acc"=>$Primary_Acc, " Residential_Status"=>$Residential_Status, "Card_Limit"=>$Credit_Limit, "Years_In_Company"=>$Years_In_Company, "Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A, "identification_proof"=>$Document_proof_doc, "Pincode"=>$Pincode, "Loan_Amount"=>$Loan_Amount, "Employment_Status"=>$Employment_Status, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage);
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
<?php //include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">

<?php 

if ($leadid>0)
 {?>
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important;"> Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a call from us.</h1>
 <?

 $getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$getCompany_Name.'"';
 //echo $getcompany;
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
?>

 <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
	$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0)
	 {
	?>
<div style="line-height:18px;"><b>1. We at deal4loans.com believe that its big financial decision that you
are about to take.<br />
2. To get best deal  speak to 3-4 banks  mentioned below and then decide
upon the best deal.<br />
3. This will help you get best deal & save on Emi & choose best product &
best service.<br />
</b></div>
<table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td height="35" background="new-images/sixnewbox.jpg" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
           <tr align="center">
            <td width="141" height="35" class="fontbld10">Bank Name</td>
            <td width="129" class="fontbld10">Interest
Rate</td>
            <!--<td width="204" class="fontbld10">EMI (Per Lac) </td>-->
            <td width="138" class="fontbld10">Maximum Loan Eligibility</td>
            <td width="102" class="fontbld10">EMI (Per month)</td>
            <td width="90" class="fontbld10">Tenure (in Yrs)</td>
			<td width="360"  class="fontbld10">Apply</td>			
          </tr>
        </table></td>
      </tr>
	  <? 
      	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
//print_r($bankID);
$Final_Bid = "";
		while (list ($key,$val) = @each($bankID)) { 
			$Final_Bid[]= $val; 
		} 

   
//print_r($Final_Bid);
//echo "<br>";
	$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);

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
for($i=0;$i<count($Final_Bid);$i++)
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
		$getdoc="select document_proof,identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'";
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
	if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" />';
	}
else if((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
		{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-fulrtn.jpg" />';
	}
	else if($Final_Bid[$i]=="Kotak")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif"  />';

	}
	else if($Final_Bid[$i]=="Citibank")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" />';
	
	}
	else if($Final_Bid[$i]=="Barclays Finance" || (strncmp ("Barclays", $Final_Bid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg"/>';
	
	}
	else if($Final_Bid[$i]=="Standard Chartered" || (strncmp ("Standard", $Final_Bid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg"/>';
	
	}
	else
		{
		$imagebank='';
		}
	
	?>
             <td width="141" height="30" >&nbsp;&nbsp;<? echo  $imagebank; ?><br />
<? echo $Final_Bid[$i];?></td>
 
	
    
	<? if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{
	?>
			<td width="129" class="fontbld10"><? echo $hdfcinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $hdfcperlacemi; ?></td>-->
            <td width="138"  ><? echo $hdfcgetloanamout; ?></td>
            <td width="102" ><? echo $hdfcgetemicalc; ?></td>
            <td width="90" ><? echo $hdfcterm; ?></td>
		 
	<?
		}
	else
		{?>
  <td width="300" align="center" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">&nbsp;</td>
	<?	}
		//echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	elseif((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
	{
	list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	?>
	<td width="129" class="fontbld10"><? echo $fullertoninterestrate; ?></td>
            <!--<td width="204"  ><? //echo $fullertonperlacemi; ?></td>-->
            <td width="138"  ><? echo $fullertongetloanamout; ?></td>
            <td width="102" ><? echo $fullertongetemicalc; ?></td>
            <td width="90" ><? echo $fullertonterm; ?></td>
	
	<?
		}
	else
		{?>
  <td width="300" align="center" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">&nbsp;</td>
		<? }
		
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
	?>

	 <td align="center" width="300" bgcolor="#FFFFFF" height="51" colspan="4"><b>&nbsp;</b></td>
		
	<? //echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif((($Final_Bid[$i]=="CITIBANK") ||  ($Final_Bid[$i]=="Citibank")) && (strlen($citicategory)>0))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlacemi)=citibank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$age,$citicategory,$getCompany_Name);
	if($citigetloanamout>0)
		{
		?>
		<td width="129" class="fontbld10"><? echo $citiinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $citiperlacemi; ?></td>-->
            <td width="138"  ><? echo $citigetloanamout; ?></td>
            <td width="102" ><? echo $citigetemicalc; ?></td>
            <td width="90" ><? echo $cititerm; ?></td>

	<?
		}
	else
		{
		?>
 <td align="center" width="300" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">&nbsp;</td>
		<? }

	}
	elseif($Final_Bid[$i]=="Barclays")
	{
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm,$barclayperlacemi)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
	if($barclaygetloanamout>0)
		{
	?>
	<td width="129" class="fontbld10"><? echo $barclayinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $barclayperlacemi; ?></td>-->
            <td width="138"  ><? echo $barclaygetloanamout; ?></td>
            <td width="102" ><? echo $barclaygetemicalc; ?></td>
            <td width="90" ><? echo $barclayterm; ?></td>
		<?
		}
	else
		{?>
<td align="center" width="300" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">&nbsp;</td>
		<? }
	}
	else
	{
	?>
	
  <td align="center" width="300" bgcolor="#FFFFFF" height="45" colspan="4" class="fontbld10"><b>&nbsp;</b></td>
		<? 
		
	}
	?>
	<td width="360" align="center"><form action="apply_pl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form></td>
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
 
	 <? }?>
<?php 

$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		{
		 $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
		list($recordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
		if($recordcount>0)
			{
		 ?>
		<div style="text-align:center; font-weight:bold; line-height:18px; padding:15px 0px;">
		There are some other financial products that are on offer for you on the basis of details you have submitted.
		<br />
		If you are interested, Go ahead and <font color="#5e3307">Apply</font></div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
		 <?
		 
		for($i=0;$i<$recordcount;$i++)
		{?>
				<td valign="top" >
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
						<tr>
							<td height="30" class="crdbhdng"><a href="<? if (strlen($myrow[$i]["cc_bank_url"])>0) {echo $myrow[$i]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow[$i]["cc_bank_name"];?></a></td>
						</tr>
						<tr>
							<td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow[$i]["cc_bank_url"])>0) {echo $myrow[$i]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow[$i]["card_image"];?>"  width="150" height="244" /></a></td>
						</tr>
						<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
						<tr>
							<td height="270" valign="top" class="crdtext"><? echo $myrow[$i]["cc_bank_features"];?></td>
						</tr>
						<tr>
							<td align="center" valign="bottom"><a href="<? if (strlen($myrow[$i]["cc_bank_url"])>0) {echo $myrow[$i]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
						</tr>
					</table>
				</td>
				<? }?>
			</tr>
		</table>

	<? }
		}
	else
	 {
		if(count($FinalBidder)>0)
	 {?>
<?}
	 }

?>

 </div>
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div>
<? }?>

   
</body>
</html>