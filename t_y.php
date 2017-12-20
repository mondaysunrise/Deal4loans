<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'cardsview.php';
	
	
	//$Type_Loan= $_GET["Type_Loan"];
	
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
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;
		
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = getProductCode($ProductName);
		
		
		
$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		//echo $Sql;
		//exit();

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

	if($_SESSION=="")
		{
		$product_name = $_SERVER['Temp_Type'];
		$Name= $_SERVER['Temp_Name'];
		$Type_Loan2 = $_SERVER['Temp_Type_Loan'];
		$Mobile = $_SERVER['Temp_Phone'];
 		$Panno = $_SERVER['Temp_Pancard'];
		$from = $_SERVER['Temp_From_Pro'];
		$DOB=$_SERVER['Temp_DOB'];
		$Reference_Code0 = $_SERVER['Temp_Reference_Code'];
		$Email= $_SERVER['Temp_Email'];
		$Net_Salary= $_SERVER['Temp_Net_Salary'];
		$Company_Name= $_SERVER['Temp_Company_Name'];
		$City= $_SERVER['Temp_City'];
		$Other_City= $_SERVER['Temp_City_Other'];
		$Pincode= $_SERVER['Temp_Pincode'];
		$Contact_Time= $_SERVER['Temp_Contact_Time'];
		$Employment_Status= $_SERVER['Temp_Employment_Status'];
$Name_New = $_SERVER['Temp_Name_New'];
		}
		else
		{
		$product_name = $_SESSION['Temp_Type'];
		$Name= $_SESSION['Temp_Name'];
		$DOB=$_SESSION['Temp_DOB'];
		$Name_New = $_SESSION['Temp_Name_New'];
		$Type_Loan2 = $_SESSION['Temp_Type_Loan'];
		$Mobile = $_SESSION['Temp_Phone'];
 		$Panno = $_SESSION['Temp_Pancard'];
		$from = $_SESSION['Temp_From_Pro'];
		$Reference_Code0 = $_SESSION['Temp_Reference_Code'];
		$Email= $_SESSION['Temp_Email'];
		$Net_Salary= $_SESSION['Temp_Net_Salary'];
		$Company_Name= $_SESSION['Temp_Company_Name'];
		$City= $_SESSION['Temp_City'];
		$Other_City= $_SESSION['Temp_City_Other'];
		$Pincode= $_SESSION['Temp_Pincode'];
		$Contact_Time= $_SESSION['Temp_Contact_Time'];
		$Employment_Status= $_SESSION['Temp_Employment_Status'];
		}

list($year,$month,$day) = split('[-]', $DOB);

$currentyear=date('Y');
$age=$currentyear-$year;
		
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
			
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Reference_Code1 = $_REQUEST['Reference_Code1'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$From_Product = $_REQUEST['From_Product'];
			$From_Product1 = $_REQUEST['From_Product1'];
			$Descr = $_REQUEST['Descr'];
			$Card_Limit = $_REQUEST['Card_Limit'];
			$cc_holder = $_REQUEST['CC_Holder'];
			$product = $_REQUEST['type'];
			$budget = $_REQUEST['Budget'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$company = $_REQUEST['Company_Name'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Property_Identified = $_REQUEST['Property_Identified'];
			$Property_Loc = $_REQUEST['Property_Loc'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Loan_Time = $_REQUEST['Loan_Time'];
			$Card_Vintage = $_REQUEST['Card_Vintage'];
			$RePhone = $_REQUEST['RePhone'];
			$Accidental_Insurance = $_REQUEST['Accidental_Insurance'];
			$Std_Code = $_REQUEST['Std_Code'];
			//echo "std code:".$Std_Code."<br>";
			$Landline = $_REQUEST['Landline'];
			//echo "std code:".$Landline."<br>";
			$Std_Code_O = $_REQUEST['Std_Code_O'];
			//echo "std code:".$Std_Code_O."<br>";
			$Pancard_no = $_REQUEST['Pancard_no'];
			//echo "std code:".$Pancard_no."<br>";
			$Office_Address = $_REQUEST['Office_Address'];
			$Landline_O = $_REQUEST['Landline_O'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			//echo "std code:".$Landline_O."<br>";
			$Residence_Address=$_REQUEST['Residence_Address'];
			$pinno=$_REQUEST['Pincode'];
			//echo $RePhone."<br>";
	//echo $product."second".$Type_Loan2.":  ".$product_name."<br><br>";
		   $n       = count($From_Product);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
			
		   $r = count($From_Product1);
		   $p = 0;
		   while ($p < $r)
		   {
			  $From_Pro1 .= "$From_Product1[$p], ";
			 $p++;
		   }
	
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
			
			if(($Reference_Code0 == $Reference_Code1) || ($Mobile == $RePhone ))
				{
				
				$Is_Valid=1;
				
				}
			else
				{
				$Is_Valid=0;
				}
				
				
			$crap = " ".$Property_Identified." ".$Property_Loc." ".$company." ".$City_Other." ".$Primary_Acc." ".$Descr." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
	
				
				
			//echo $Is_Valid;
				if (($Type_Loan2=="Req_Credit_Card") || ($product=="CreditCard") )
					{
						
						if($Accidental_Insurance==1)
						{
							$RequestID = $_SESSION['Temp_LID'];
							$ProductName = "Req_Credit_Card";
							//InsertTataAig($RequestID, $ProductName);
						}

						
						getEligibleBidders("cc","$City","$Mobile");				
		$DataArray = array("Credit_Limit"=>$Credit_Limit, "No_of_Banks"=>$From_Pro, "Applied_With_Banks"=>$From_Pro1, "Pincode"=>$pinno, "Residence_Address"=>$Residence_Address, "Is_Valid"=>$Is_Valid, "Office_Address"=>$Office_Address, "Std_Code"=>$Std_Code, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_O, "Landline"=>$Landline, "Pancard_No"=>$Pancard_no);
		$wherecondition ="Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Employment_Status='".$Employment_Status."'";
		Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
        
						

						//echo $qry;
						$productname = "CreditCard";
						$filename = "Contents_Credit_Card_Mustread.php?product=$productname";
						header("Location: $filename");
						exit();
						
						
					}
				if (($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan"))
					{
						
						if($Accidental_Insurance==1)
						{
							$RequestID = $_SESSION['Temp_LID'];
							$ProductName = "Req_Loan_Personal";
							//InsertTataAig($RequestID, $ProductName);
						}

						
						getEligibleBidders("personal","$City","$Mobile");
							if($Residential_Status>0)	
							{	
						$qry="Update Req_Loan_Personal SET Primary_Acc='$Primary_Acc', Residential_Status='$Residential_Status' ,Card_Vintage='$Card_Vintage',Card_Limit= '$Card_Limit', CC_Bank='$from',Years_In_Company='$Years_In_Company', Is_Valid='$Is_Valid', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Company_Name='".$Company_Name."' and Employment_Status='".$Employment_Status."' ";
						
						
						}
						else {
						$qry="Update Req_Loan_Personal SET  Primary_Acc='$Primary_Acc', CC_Bank='$from',Card_Vintage='$Card_Vintage',Card_Limit= '$Card_Limit',Years_In_Company='$Years_In_Company', Is_Valid='$Is_Valid', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Company_Name='".$Company_Name."' and Employment_Status='".$Employment_Status."' ";
						
						}
						
//						echo $qry;


						if($Net_Salary>=200000)
						{
							$productname = "plsalaryclause";
						}
						else
						{
						$productname = "PersonalLoan";
						}
					}
				if (($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan"))
					{
					
						if($Accidental_Insurance==1)
						{
							$RequestID = $_SESSION['Temp_LID'];
							$ProductName = "Req_Loan_Home";
							//InsertTataAig($RequestID, $ProductName);
						}
						
						getEligibleBidders("home","$City","$Mobile");
						$qry="Update Req_Loan_Home SET Property_Identified='$Property_Identified', Property_Loc ='$Property_Loc', Loan_Time='$Loan_Time', Is_Valid='$Is_Valid', Budget='$budget',Company_Name='$company' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' and Employment_Status='".$Employment_Status."'";
						//echo $qry;

						if($Net_Salary>=200000)
						{
							$productname = "hlsalaryclause";
						}
						else
						{
						$productname = "HomeLoan";
						}

					}
					
			
				if(isset($_SESSION['UserType'])) 
					{
						echo "<script language=javascript>"." location.href='myRequests.php'"."</script>";
						//$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "myRequests.php");
						//	echo $Msg;
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
	
	
	
	
	if($product_name=="PropertyLoan")
	{
		$file_name = "Contents_Loan_Against_Property_Mustread.php?product=$product_name";
		header("Location: $file_name");
		exit();
	}
	else if($product_name=="CarLoan")
	{
		$file_name = "Contents_Car_Loan_Mustread.php?product=$product_name";
		header("Location: $file_name");
		exit();
	}
	
	


?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Thank You</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<style type="text/css" >
.table-top-content{
text-align:left;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
font-weight:normal;
line-height:18px;
color:#041423;
text-decoration:none;
}

</style>
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


<table width="500"  border="0" cellspacing="0" cellpadding="0">
		<tr><td width="30">&nbsp;</td><td>&nbsp;</td></tr>
		<tr>
		<td width="30">&nbsp;</td>
            <td>
 
 <p><b><font color="#3366CC"><!---------->
 <?
if(($Type_Loan2=="Req_Loan_Personal" || $product=="PersonalLoan" ))
{
$getproduct="Req_Loan_Personal";
$typeproduct="1";
}
elseif($Type_Loan2=="Req_Loan_Home" || $product=="HomeLoan" ) 
{
	$typeproduct="2";
$getproduct="Req_Loan_Home";
}
 $select=("select RequestID from ".$getproduct." where  Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."' ");
 list($recordcount,$getrow)=MainselectfuncNew($select,$array = array());
		$cntr=0;
//$getrow=mysql_fetch_array($select);
$getexactRequestID=$getrow[$cntr]['RequestID'];



 if($Net_Salary>="150000" && (($Type_Loan2=="Req_Loan_Personal" || $product=="PersonalLoan" ) || ($Type_Loan2=="Req_Loan_Home" || $product=="HomeLoan" ) ))
						{

$cardquery="select * from  compaign_bidders_list where (City like '%".$City."%') and Salary_Clause<='".$Net_Salary."' and Age_Clause<='".$age."' and Restrict_Bidder=1";


//$num_rows = mysql_num_rows($geteligiblebanks);
 list($num_rows,$bankrow)=MainselectfuncNew($cardquery,$array = array());
		$i=0;

if($num_rows>0)
{
while($i<count($bankrow))
        {
	$bankid = $bankrow[$i]['BidderID'];
	$bankiddetails[] = $bankid;
	$i = $i +1;
}
//print_r($bankiddetails);
echo "<table width='510' border='0' cellpadding='0' cellspacing='0' align='left'> ";
echo "<tr><td class='table-top-content' align='left' height='25' valign='top' style='font-weight:bold; color: #234C76;'>Dear $Name_New,</td></tr>";
if(($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan") )
	{
echo "<tr><td align='center' valign='middle' width='503' height='110'><img src='images/thanks-cont-img.gif' width='503' height='85'></td></tr>";
	}
	
	elseif(($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan") )
	{
		echo "<tr><td align='center' valign='middle' width='503' height='110'><img src='images/thanks-cont-home-img.gif' width='503' height='85'></td></tr>";
	}
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
$getcitydetails =array('Lucknow','Mangalore','Mumbai','Cochin','Coimbatore','Nagpur','Agra','Surat','Ahmedabad','Gujarat','Madurai','Ludhiana');
if(((($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan") || ($product_name=="PersonalLoan")) && ((in_array($City, $getcitydetails))>0 && $age>=30) ) || ((($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan") || ($product_name=="HomeLoan")) && ($Net_Salary>=400000 && $age>=30) ))
	{
		?>
		<tr><td  align='center' ><br>
		 <font style="Font-size:11px; font-family:Century Gothic;color:#898989;" align='center'>Advertisement</font><br>
		<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=65&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=aced4166' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=65&amp;n=aced4166' border='0' alt=''></a></noscript><br>
		</td></tr>

	<?}

echo "</table>";
}

else
	{
	$getcitydetails =array('Lucknow','Mangalore','Mumbai','Cochin','Coimbatore','Nagpur','Agra','Surat','Ahmedabad','Gujarat','Madurai','Ludhiana');
	echo "<table width='510' border='0' cellpadding='0' cellspacing='0' align='left' valign='top'> ";

	if(((($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan") || ($product_name=="PersonalLoan")) && ((in_array($City, $getcitydetails))>0 && $age>=30) ) || ((($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan") || ($product_name=="HomeLoan")) && ($Net_Salary>=400000 && $age>=30) ))
	{
		?>
		<tr><td class='table-top-content' align='left' height='25' valign='top' style='font-weight:bold; color: #234C76;'><?php if(($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan") || ($product_name=="PersonalLoan")) {?>Thanks for applying Personal Loan through Deal4Loans.com. On the basis of the details you have inputted, Here is the offer for your Personal Loan requirement Apply Now!! <? } elseif(($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan") || ($product_name=="HomeLoan")) {?> Thanks for applying Home Loan through Deal4Loans.com. You will soon receive a Call-back from our call-center. <br>We are offering another deal for fulfilling your Cash Requirement through Citifinancial. Apply Here for Personal Loan!!<?}?> <br>
		</td></tr>
		<tr><td align="center"><br>

		<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=65&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=aced4166' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=65&amp;n=aced4166' border='0' alt=''></a></noscript><br><br>
		</td></tr></table>

	<?}
	else
		{
	$RequestID = $_SESSION['Temp_LID'];
if(($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan") )
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
		elseif(($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan") )
		{
			if($Net_Salary>=200000)
						{
							$productname = "hlsalaryclause";
						}
						else
						{
						$productname = "HomeLoan";
						}
$filename = "Contents_Home_Loan_Mustread.php?product=$productname";
	//exit();
	header("Location: $filename");
	exit();
		}
		
			
	}
	}
		}
					
	else
	{
		if(($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan") )
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
		elseif(($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan") )
		{
			if($Net_Salary>=200000)
						{
							$productname = "hlsalaryclause";
						}
						else
						{
						$productname = "HomeLoan";
						}
$filename = "Contents_Home_Loan_Mustread.php?product=$productname";
	//exit();
	header("Location: $filename");
	exit();
		}

	}
						
	?>
 <!--------------------------------------------------------->
 </font></b></p>

     &nbsp;</td>
     </tr>
	 
            </table>
			</div>
	  <?php include '~Right1.php';?>
	<!--  <img src="images/120_90.gif"><BR><BR>
	  	  <img src="images/120_240.gif">
	  -->
	  </div>
    <?php include '~NewBottom.php';?>
 
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

