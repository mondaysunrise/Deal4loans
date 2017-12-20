<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'cardsview.php';
	$Dated = ExactServerdate();
	
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

	function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		//$RowGetDate = mysql_fetch_array($GetDateSql);
		
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = getProductCode($ProductName);
		
		//$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		//$query = mysql_query($Sql);
		//echo $Sql;
		//exit();

		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
  

	}



	
   

	if($_SESSION=="")
		{
		$product_name = $_SERVER['Temp_Type'];
		$Name= $_SERVER['Temp_Name'];
		$Type_Loan2 = $_SERVER['Temp_Type_Loan'];
		$Mobile = $_SERVER['Temp_Phone'];
 		$City= $_SERVER['Temp_City'];
		$Other_City= $_SERVER['Temp_City_Other'];
		
		}
		else
		{
		$product_name = $_SESSION['Temp_Type'];
		$Name= $_SESSION['Temp_Name'];
		$Type_Loan2 = $_SESSION['Temp_Type_Loan'];
		$Mobile = $_SESSION['Temp_Phone'];
 		$City= $_SESSION['Temp_City'];
		$Other_City= $_SESSION['Temp_City_Other'];
		
		}

		
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//$Reference_Code1=$_REQUEST['Reference_Code1'];
		$Email=$_REQUEST['Email'];	
		$Pincode=$_REQUEST['Pincode'];
		$Employment_Status=$_REQUEST['Employment_Status'];	
		$Company_Name=$_REQUEST['Company_Name'];	
		$IncomeAmount=$_REQUEST['IncomeAmount'];	
		$Loan_Amount=$_REQUEST['Loan_Amount'];	
		$Primary_Acc=$_REQUEST['Primary_Acc'];	
		$Residential_Status=$_REQUEST['Residential_Status'];	
		$Years_In_Company=$_REQUEST['Years_In_Company'];	
		$Total_Experience=$_REQUEST['Total_Experience'];
		$CC_Holder=$_REQUEST['CC_Holder'];
		$Card_Vintage=$_REQUEST['Card_Vintage'];
		$Credit_Limit=$_REQUEST['Credit_Limit'];
		$LoanAny=$_REQUEST['LoanAny'];
		$Loan_Any=$_REQUEST['Loan_Any'];
		$EMI_Paid=$_REQUEST['EMI_Paid'];
		$Mobile_Connection=$_REQUEST['Mobile_Connection'];
		$Landline_Connection=$_REQUEST['Landline_Connection'];
		$Salary_Drawn=$_REQUEST['Salary_Drawn'];
		$product=$_REQUEST['type'];

if($Employment_Status==1)
		{
			$Net_Salary = $_REQUEST['IncomeAmount'] *12;
		}
		else
		{
			$Net_Salary = $_REQUEST['IncomeAmount'];
		}

			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
				
				
			$crap = " ".$City_Other." ".$Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
		
			$crapValue = validateValues($crap);
		
			
			if($crapValue=="Put")
			{
					
if (($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan"))
	{
$Type_Loan=$Type_Loan2;

	$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Personal Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Personal Loan";

			//echo $Type_Loan;
			if(isset($Type_Loan2) || isset($product))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
				if($Accidental_Insurance==1)
				{
					$RequestID = $_SESSION['Temp_LID'];
					$ProductName = "Req_Loan_Personal";
					InsertTataAig($RequestID, $ProductName);
				}
				
				
		getEligibleBidders("personal","$City","$Mobile");
		
			
		$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			//$CheckQuery = ExecQuery($CheckSql);
		 list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
		$k=0;
		
			
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$k]['UserID'];
				//$InsertProductSql = "Update Req_Loan_Personal SET UserID='$UserID', Email='$Email',	Pincode='$Pincode', Employment_Status='$Employment_Status',	Company_Name='$Company_Name',Net_Salary='$Net_Salary',Loan_Amount='$Loan_Amount',Primary_Acc='$Primary_Acc',Residential_Status='$Residential_Status',Years_In_Company='$Years_In_Company',	Total_Experience='$Total_Experience',CC_Holder='$CC_Holder',Card_Vintage='$Card_Vintage',Card_Limit='$Credit_Limit',Loan_Any='$Loan_A',EMI_Paid='$EMI_Paid',	Mobile_Connection='$Mobile_Connection',	Landline_Connection='$Landline_Connection',	Salary_Drawn='$Salary_Drawn' Where Mobile_Number='".$Mobile."' and Name='".$Name."' and City='".$City."' ";
				//echo "<br>if".$InsertProductSql;
		$DataArray = array("UserID"=>$UserID, "Email"=>$Email,	"Pincode"=>$Pincode, "Employment_Status"=>$Employment_Status,	"Company_Name"=>$Company_Name, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Primary_Acc"=>$Primary_Acc, "Residential_Status"=>$Residential_Status, "Years_In_Company"=>$Years_In_Company,	"Total_Experience"=>$Total_Experience, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "Card_Limit"=>$Credit_Limit, "Loan_Any"=>$Loan_A, "EMI_Paid"=>$EMI_Paid,	"Mobile_Connection"=>$Mobile_Connection, "Landline_Connection"=>$Landline_Connection, "Salary_Drawn"=>$Salary_Drawn);
		$wherecondition ="Mobile_Number='".$Mobile."' and Name='".$Name."' and City='".$City."'";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
			
			}
			else
			{
				//$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
			//	$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
			$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
			$table = 'wUsers';
			$insert = Maininsertfunc ($table, $dataInsert);
				
				$UserID1 = mysql_insert_id();
				//$InsertProductSql = "Update Req_Loan_Personal SET UserID='$UserID1', Email='$Email',	Pincode='$Pincode', Employment_Status='$Employment_Status',	Company_Name='$Company_Name',Net_Salary='$Net_Salary',Loan_Amount='$Loan_Amount',Primary_Acc='$Primary_Acc',Residential_Status='$Residential_Status',Years_In_Company='$Years_In_Company',	Total_Experience='$Total_Experience',CC_Holder='$CC_Holder',Card_Vintage='$Card_Vintage',Card_Limit='$Credit_Limit',Loan_Any='$Loan_A',EMI_Paid='$EMI_Paid',	Mobile_Connection='$Mobile_Connection',	Landline_Connection='$Landline_Connection',	Salary_Drawn='$Salary_Drawn' Where Mobile_Number='".$Mobile."' and Name='".$Name."' and City='".$City."' ";
				//echo "<br>else".$InsertProductSql;
				$DataArray = array("UserID"=>$UserID1, "Email"=>$Email, "Pincode"=>$Pincode, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Primary_Acc"=>$Primary_Acc, "Residential_Status"=>$Residential_Status, "Years_In_Company"=>$Years_In_Company, "Total_Experience"=>$Total_Experience, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "Card_Limit"=>$Credit_Limit, "Loan_Any"=>$Loan_A, "EMI_Paid"=>$EMI_Paid, "Mobile_Connection"=>$Mobile_Connection, "Landline_Connection"=>$Landline_Connection, "Salary_Drawn"=>$Salary_Drawn);
				$wherecondition ="Mobile_Number='".$Mobile."' and Name='".$Name."' and City='".$City."'";
				Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
				
				
			}

		$result = ExecQuery($InsertProductSql);
		if($Net_Salary>=200000)
		{
			$productname = "plsalaryclause";
		}
		else
		{
		$productname = "PersonalLoan";
		}


		
			
		//$filename = "Contents_Personal_Loan_Mustread.php?product=$productname";
		//exit();
		//header("Location: $filename");
		//exit();
				
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
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Thank You</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
   <?php include '~Upper.php';?>

    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
<html>
<head>

<table width="500"  border="0" cellspacing="0" cellpadding="0">
		<tr><td width="30">&nbsp;</td><td>&nbsp;</td></tr>
		<tr>
		<td width="30">&nbsp;</td>
            <td>
 
 <p><b><font color="#3366CC"><!---------------------------CROSS SELL ACTIVITY----------------------------------------------->
<?
 $typeproduct="1";
//$getproduct="Req_Loan_Home";

 $select=("select RequestID,DOB from Req_Loan_Personal where  Mobile_Number='".$Mobile."' and Name='".$Name."' and City='".$City."' ");
// echo "select RequestID,DOB from Req_Loan_Personal where  RequestID=".$ProductValue;
 list($recordcount,$getrow)=MainselectfuncNew($select,$array = array());
		$p=0;

//$getrow=mysql_fetch_array($select);
$getexactRequestID=$getrow[$p]['RequestID'];
$DOB=$getrow[$p]['DOB'];
list($year,$month,$day) = split('[-]', $DOB);
$currentyear=date('Y');
$age=$currentyear-$year;
//echo $DOB.":".$age;

 if($Net_Salary>="150000")
{

$cardquery="select * from  compaign_bidders_list where (City like '%".$City."%' OR  City like '%".$Other_City."%') and Salary_Clause<='".$Net_Salary."' and Age_Clause<='".$age."' and Restrict_Bidder=1";
//echo $cardquery;

//$Employment_Status="1";
//$geteligiblebanks = ExecQuery($cardquery);
//$num_rows = mysql_num_rows($geteligiblebanks);
 list($num_rows,$bankrow)=MainselectfuncNew($cardquery,$array = array());
		$j=0;

if($num_rows>0)
{
while($j<count($bankrow))
        {
	$bankid = $bankrow[$j]['BidderID'];
	$bankiddetails[] = $bankid;
	//echo "hello".$bankid;
$j  =$j+1;
}
//print_r($bankiddetails);

echo "<table width='510' border='0' cellpadding='0' cellspacing='0' align='left'> ";
echo "<tr><td class='table-top-content' align='left' height='25' valign='top' style='font-weight:bold; color: #234C76;'>Dear $Name,</td></tr>";
echo "<tr><td align='center' valign='middle' width='503' height='110'><img src='images/thanks-cont-img.gif' width='503' height='85'></td></tr>";
	
echo "<tr>";
if ((in_array("903", $bankiddetails)) &&  (strlen($getexactRequestID)>0)) {
	
    icicicard($typeproduct,$getexactRequestID,$Net_Salary);
	
}
if ((in_array("913", $bankiddetails))&&  (strlen($getexactRequestID)>0)) {
    hdfccard($typeproduct,$getexactRequestID,$Net_Salary);
}
if ((in_array("943", $bankiddetails)) &&  (strlen($getexactRequestID)>0)) {
    kotakcard($typeproduct,$getexactRequestID,$Employment_Status);
}
echo "</table>";
}

else
							{
			if($Net_Salary>=200000)
						{
							$productname = "plsalaryclause";
						}
						else
						{
						$productname = "PersonalLoan";
						}
$filename = "Contents_Personal_Loan_Mustread.php?product=$productname";
	//exit();
	header("Location: $filename");
	exit();
		
		
			
	}
						}
						
						else
						{
											
			if($Net_Salary>=200000)
						{
							$productname = "plsalaryclause";
						}
						else
						{
						$productname = "PersonalLoan";
						}
$filename = "Contents_Personal_Loan_Mustread.php?product=$productname";
	//exit();
	header("Location: $filename");
	exit();
		
		
			
	}

						?>

<!--------------------------------------------------------------------------></font></b></p>

     &nbsp;</td>
     </tr>
	 
            </table>
			</div>
	  <?php include '~Right1.php';?>
	<!--  <img src="images/120_90.gif"><BR><BR>
	  	  <img src="images/120_240.gif">
	  -->
	  </div>
    <?php include '~Bottom.php';?>
 
<!-- Google Code for lead Conversion Page -->

</body>
</html>

