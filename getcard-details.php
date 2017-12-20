<?php
ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$bidderid=$_REQUEST['cardid'];
$requestid=$_REQUEST['requestid'];
$producttype=$_REQUEST['product'];
$cardname=$_REQUEST['cname'];
//echo $bidderid;

function getCodeProduct($pKey){
	$titles = array(
		'1' => 'Req_Loan_Personal',
		'2' => 'Req_Loan_Home',
		'3' => 'Req_Loan_Car',
		'4' => 'Req_Credit_Card',
		'5' => 'Req_Loan_Against_Property',
		'6' => 'Req_Business_Loan',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

if(($bidderid=="903" || $bidderid=="913") && $producttype>0)
{
	if($producttype==1)
		{
			$product= getCodeProduct($producttype);
			$selectdata="select UserID,Name,Mobile_Number,DOB,Employment_Status,Email,Company_Name,City,City_Other,Pincode,Net_Salary,CC_Holder,Card_Vintage from Req_Loan_Personal where RequestID='".$requestid."'";
			///$selectdataresult = ExecQuery($selectdata);
			//$rows = mysql_num_rows($selectdataresult);
//echo "select: ".$selectdata."<br>";
			//$myrow = mysql_fetch_array($selectdataresult);
			
			 list($rows,$myrow)=MainselectfuncNew($selectdata,$array = array());
		$cntr=0;
			
			$userid=$myrow[$cntr]['UserID'];
			$name=$myrow[$cntr]['Name'];
			$email=$myrow[$cntr]['Email'];
			$dob=$myrow[$cntr]['DOB'];
			$emp_stat=$myrow[$cntr]['Employment_Status'];
			$company_name=$myrow[$cntr]['Company_Name'];
			$city=$myrow[$cntr]['City'];
			$city_other=$myrow[$cntr]['City_Other'];
			$pincode=$myrow[$cntr]['Pincode'];
			$net_salary=$myrow[$cntr]['Net_Salary'];
			$cc_holder=$myrow[$cntr]['CC_Holder'];
			$card_vintage=$myrow[$cntr]['Card_Vintage'];
			$mobile_number=$myrow[$cntr]['Mobile_Number'];
		}
		elseif($producttype==2)
	{
			$product= getCodeProduct($producttype);
			$selectdata="select UserID,Name,Mobile_Number,DOB,Mobile_Number,Employment_Status,Email,Company_Name,City,City_Other,Pincode,Net_Salary,CC_Holder from Req_Loan_Home where RequestID='".$requestid."'";
			//$selectdataresult = ExecQuery($selectdata);
			//$rows = mysql_num_rows($selectdataresult);
//echo "select: ".$selectdata."<br>";
			//$myrow = mysql_fetch_array($selectdataresult);
			
			 list($rows,$myrow)=MainselectfuncNew($selectdata,$array = array());
		$cntr=0;
			
			$userid=$myrow[$cntr]['UserID'];
			$name=$myrow[$cntr]['Name'];
			$email=$myrow[$cntr]['Email'];
			$dob=$myrow[$cntr]['DOB'];
			$emp_stat=$myrow[$cntr]['Employment_Status'];
			$company_name=$myrow[$cntr]['Company_Name'];
			$city=$myrow[$cntr]['City'];
			$city_other=$myrow[$cntr]['City_Other'];
			$pincode=$myrow[$cntr]['Pincode'];
			$net_salary=$myrow[$cntr]['Net_Salary'];
			$cc_holder=$myrow[$cntr]['CC_Holder'];
			$card_vintage=$myrow[$cntr]['Card_Vintage'];
			$mobile_number=$myrow[$cntr]['Mobile_Number'];
	}
	
if($rows>0)
	{
$getlead="select RequestID from Compaign_Credit_Card where Mobile_Number='".$mobile_number."' and DOB='".$dob."' and Descr='".$cname."' and Bidderid_Details='".$bidderid."'";

 list($recordcount,$myrow)=MainselectfuncNew($getlead,$array = array());
	$i = 0;
//$getleadresult = ExecQuery($getlead);
//$myrow = mysql_fetch_array($getleadresult);
//$recordcount = mysql_num_rows($getleadresult);
if($recordcount>0)
	{
	//$getvalue="Update  Compaign_Credit_Card set UserID='$userid',Name='$name',Email='$email',Employment_Status='$emp_stat',Company_Name='$company_name',City='$city',City_Other='$city_other',Pincode='$pincode',Net_Salary='$net_salary',CC_Holder='$cc_holder',Card_Vintage='$card_vintage',Dated=Now(),Bidderid_Details='$bidderid',Is_Valid='$producttype' where Mobile_Number='".$mobile_number."' and DOB='".$dob."' and Descr='".$cname."' and Bidderid_Details='".$bidderid."'";
//    echo "update: ".$getvalue."<br>";
//echo "update: ".$getvalue."<br>";
	 $last_inserted_id = $myrow[$i]['RequestID'];
		$DataArray = array("UserID"=>$userid, "Name"=>$name, "Email"=>$email, "Employment_Status"=>$emp_stat, "Company_Name"=>$company_name, "City"=>$city, "City_Other"=>$city_other, "Pincode"=>$pincode, "Net_Salary"=>$net_salary, "CC_Holder"=>$cc_holder, "Card_Vintage"=>$card_vintage, "Dated"=>$Dated, "Bidderid_Details"=>$bidderid, "Is_Valid"=>$producttype);
		$wherecondition ="Mobile_Number='".$mobile_number."' and DOB='".$dob."' and Descr='".$cname."' and Bidderid_Details='".$bidderid."'";
		Mainupdatefunc ('Compaign_Credit_Card', $DataArray, $wherecondition);
	
	//$getvalueresult = ExecQuery($getvalue);
 


	}
else
	{
//$getvalue="INSERT INTO Compaign_Credit_Card (UserID,Mobile_Number,Name,Email,Employment_Status,DOB,Company_Name,City,City_Other,Pincode,Net_Salary,CC_Holder,Card_Vintage,Dated,Bidderid_Details,Descr,Is_Valid) Values ('$userid','$mobile_number','$name','$email','$emp_stat','$dob','$company_name','$city','$city_other','$pincode','$net_salary','$cc_holder','$card_vintage',Now(),'$bidderid','$cname','$producttype')";
//echo "insert: ".$getvalue."<br>";
	//$getvalueresult = ExecQuery($getvalue);
  
  
  $dataInsert = array("UserID"=>$userid, "Mobile_Number"=>$mobile_number, "Name"=>$name, "Email"=>$email, "Employment_Status"=>$emp_stat, "DOB"=>$dob, "Company_Name"=>$company_name, "City"=>$city, "City_Other"=>$city_other, "Pincode"=>$pincode, "Net_Salary"=>$net_salary, "CC_Holder"=>$cc_holder, "Card_Vintage"=>$card_vintage, "Dated"=>$Dated, "Bidderid_Details"=>$bidderid, "Descr"=>$cname, "Is_Valid"=>$producttype);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
$last_inserted_id = mysql_insert_id();

	}

}

}




 ?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Personal Loans India Apply Compare | Education Holiday Marriage Loan</title>
<meta name="description" content="Get online information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="personal loans India, Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>

<div align="center">
 <div id="main-header">
 
  <div  id="text-hdr-lft">
  <div id="header-text">Varied Individuals. Various Needs.</div>
 <div id="hdr-txt">Loans by Choice not by Chance.</div>
 </div>
 <div id="header-rgt-img"></div>
 </div>
 </div>  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
 
  <div id="dvContentPanel">
   <?php if(isset($_SESSION['UserType']))
	{?><div id="dvMaincontent">
   <table width="776" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  
  <td align="left" valign="top" style="padding-left:8px;"><? }?>
  <table width="380" align="left"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
	<table align="center" width="380" cellpadding="0" bgcolor="#F6F7F9" cellspacing="0" style="border:1px solid #314C74;">
<?if($bidderid=="913")
{?>
		<tr><td colspan="2" align="center" bgcolor="#314C74" style="color:#FFFFFF; font-size:15px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;" height="25">Card Details</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td>
		<form name="compaigncustomer" action="compaign_cc_thank.php" onSubmit="return compaignform(document.compaigncustomer);" method="post">
				<table width="500" border="0"  cellspacing="2" cellpadding="4" align="center">
				  <tr>
					<td >Residence Landline</td>
					<td > <input type="text" name="std_code" id="std_code" size="3"><input type="text" name="landline" id="landline" style="width:130px;"/></td>
				  </tr>
				  <tr>
					<td>Office Landline </td>
					<td><input type="text" name="std_code_o" id="std_code_o" size="3">
					  <input type="text" name="landline_o" id="landline_o" style="width:130px;"/></td>
				  </tr>
				  <tr>
			<td  ><b>I have an active credit card from ? </b></td>
			<td  >
			<table border="0" width="100%">
			<tr>
				<td class="style4" ><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro"> ABN AMRO</td>
				<td class="style4"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex" > Amex</td>
				</tr>
			<tr>
				<td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="style4"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" > Citi Bank</td>
			</tr>
			<tr>
				<td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank"> Deutsche Bank</td><td class="style4"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr"> HDFC</td>
			</tr>
			<tr>
				<td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" > HSBC</td>
				<td class="style4"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI"> ICICI</td>
			</tr>
			<tr>
				<td class="style4" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" > Standard Chartered</td>
			</tr>
			<tr>
			<td class="style4"><input type="checkbox" name="From_Product[]" value="Barclays" id="From_Product" class="noBrdr" > Barclays</td><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi" > SBI</td></tr>
			<tr><td colspan="2" class="style4"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" > Others</td>
			</tr>
			</table>			</td>
			</tr>
				  <tr><td colspan="2"><input type="text" name="last_inserted_id" id="last_inserted_id" value="<? echo $last_inserted_id; ?>"><input type="text" name="product" id="product" value="Req_Credit_Card">&nbsp; </td></tr>
				  <tr><td colspan="2" align="center"><input type="submit" value="submit"/></td></tr>
				</table>
		  </form>
	
		</td>
		</tr>
	</table>
	<?}
	else
	{
		$msg = "CreditCard";
	$R_URL="Contents_Credit_Card_Mustread.php?product=$msg";

	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}
//$filename = "Contents_Credit_Card_Mustread.php";
//	//exit();
	//header("Location: $filename");
	//exit();?>
	<table width="510">
		<tr><td style="font-family:Verdana; Font-size:12px; font-weight:bold; ;" >Thanks For applying for <font color="0F74D4" ><i><?echo $cardname; ?></i></font> through Deal4loans.com</td></tr>
		</table>
<?	}?></td>
  </tr>
</table></td>
  <td align="right" valign="top"><? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right1.php';
  }
  ?></td>
     </tr>
     </table>
	 </div>

<? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom.php';?>
  <?}?>
</div>
  </body>
</html>