<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function.php';
	
	
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
		$GetDateSql = "select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID";
		list($alreadyExist,$myrow)=MainselectfuncNew($GetDateSql,$array = array());
		$myrowcontr=count($myrow)-1;
		
		$TDated = $myrow[$myrowcontr]["Dated"];
		$TCity = $myrow[$myrowcontr]["City"];
		$Mobile = $myrow[$myrowcontr]["Mobile_Number"];
		$Dated=ExactServerdate();
		$Product_Name = 1;
		
		$data = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $data);

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
		}
		else
		{
		$product_name = $_SESSION['Temp_Type'];
		$Name= $_SESSION['Temp_Name'];
		$DOB=$_SESSION['Temp_DOB'];
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

$getCompany_Name = $Company_Name;
		list($year,$month,$day) = split('[-]', $DOB);

$currentyear=date('Y');
$age=$currentyear-$year;
//echo $age."<br>";
//echo "1:".$getCompany_Name."<br>";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//$experiment=$_REQUEST['FullName'];
			//echo $experiment;
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Std_Code = $_REQUEST['Std_Code'];
			$Landline = $_REQUEST['Landline'];
			$Std_Code_O = $_REQUEST['Std_Code_O'];
			$Pancard_no = $_REQUEST['Pancard_no'];
			$Office_Address = $_REQUEST['Office_Address'];
			$Landline_O = $_REQUEST['Landline_O'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Reference_Code1 = $_REQUEST['Reference_Code1'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			 $From_Product = $_REQUEST['From_Product'];
			$From_Product1 = $_REQUEST['From_Product1'];
			$Descr = $_REQUEST['Descr'];
			$cc_holder = $_REQUEST['CC_Holder'];
			$product = $_REQUEST['type'];
			$budget = $_REQUEST['Budget'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$company = $_POST['Company_Name'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Property_Identified = $_REQUEST['Property_Identified'];
			$Property_Loc = $_REQUEST['Property_Loc'];
			$Accidental_Insurance = $_REQUEST['Accidental_Insurance'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Loan_Time = $_REQUEST['Loan_Time'];
			$Card_Vintage = $_REQUEST['Card_Vintage'];
			$RePhone = $_REQUEST['RePhone'];
			$CCbusiness = $_REQUEST['CCbusiness'];
			$Constitution = $_REQUEST['Constitution'];
			$Company_Name = $_REQUEST['Company_Name'];
			$Office_Status = $_REQUEST['Office_Status'];
			$Mobile_Connection =$_REQUEST['Mobile_Connection'];
			$Landline_Connection =$_REQUEST['Landline_Connection'];
			$Salary_Drawn=$_REQUEST['Salary_Drawn'];
			$pinno=$_REQUEST['Pincode'];
			$Residence_Address=$_REQUEST['Residence_Address'];
			$Document_proof=$_REQUEST['Document_proof'];
			//print_r($Document_proof);
			//echo "2:".$getCompany_Name;
			// for identification Proof 
			$Document_proof_doc=implode(",",$Document_proof);
			
	
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
			//echo $Loan_A."<br>";
			if(($Reference_Code0 == $Reference_Code1) || ($Mobile == $RePhone ))
				{
				
				$Is_Valid=1;
				
				}
			else
				{
				$Is_Valid=0;
				}

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
	
				
			$crap = " ".$Property_Identified." ".$Property_Loc." ".$company." ".$City_Other." ".$Primary_Acc." ".$Descr." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
	
	

			//echo $Is_Valid;
				if (($product=="CreditCard") || ($product_name=="CreditCard"))
					{

						if($Accidental_Insurance==1)
						{
							$RequestID = $_SESSION['Temp_LID'];
							$ProductName = "Req_Credit_Card";
							InsertTataAig($RequestID, $ProductName);
						}

						getEligibleBidders("cc","$City","$Mobile");				
						$dataUpdate = array('Credit_Limit'=>$Credit_Limit, 'No_of_Banks'=>$From_Pro, 'Pincode'=>$pinno, 'Residence_Address'=>$Residence_Address, 'Is_Valid'=>$Is_Valid, 'Applied_With_Banks'=>$From_Pro1, 'Office_Address'=>$Office_Address, 'Std_Code'=>$Std_Code, 'Std_Code_O'=>$Std_Code_O, 'Landline_O'=>$Landline_O, 'Landline'=>$Landline, 'Pancard_No'=>$Pancard_no);
						$wherecondition = "(Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."')";
						Mainupdatefunc ('Req_Credit_Card', $dataUpdate, $wherecondition);
						$productname = "CreditCard";
						$dataCCUpdate = array();
					}
				if (($product=="PersonalLoan") || ($product_name=="PersonalLoan"))
					{
								if($Accidental_Insurance==1)
								{
									$RequestID = $_SESSION['Temp_LID'];
									$ProductName = "Req_Loan_Personal";
									InsertTataAig($RequestID, $ProductName);
								}
								
								//exit();
						getEligibleBidders("personal","$City","$Mobile");
							if($Residential_Status>0)	
							{	
						
						$dataUpdate = array('Company_Type'=>$Company_Type, 'PL_EMI_Amt'=>$PL_EMI_Amt, 'Primary_Acc'=>$Primary_Acc, 'Residential_Status'=>$Residential_Status, 'Card_Limit'=>$Credit_Limit, 'Years_In_Company'=>$Years_In_Company, 'Is_Valid'=>$Is_Valid, 'Total_Experience'=>$Total_Experience, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_A, 'Mobile_Connection'=>$Mobile_Connection, 'Landline_Connection'=>$Landline_Connection, 'Salary_Drawn'=>$Salary_Drawn, 'identification_proof'=>$Document_proof_doc);
						$wherecondition = "(Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."')";
						}
						else {
						
						$dataUpdate = array('PL_EMI_Amt'=>$PL_EMI_Amt, 'Primary_Acc'=>$Primary_Acc, 'Years_In_Company'=>$Years_In_Company, 'Is_Valid'=>$Is_Valid, 'Card_Limit'=>$Credit_Limit, 'Total_Experience'=>$Total_Experience, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_A, 'Mobile_Connection'=>$Mobile_Connection, 'Landline_Connection'=>$Landline_Connection, 'Salary_Drawn'=>$Salary_Drawn, 'identification_proof'=>$Document_proof_doc);
						$wherecondition = "(Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."')";
						}
							Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);

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
					//	header("Location: $filename");
						//exit();

					
					}
				if (($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan") || ($product_name=="HomeLoan"))
					{
						
						if($Accidental_Insurance==1)
						{
							$RequestID = $_SESSION['Temp_LID'];
							$ProductName = "Req_Loan_Home";
							InsertTataAig($RequestID, $ProductName);
						}
						
						getEligibleBidders("home","$City","$Mobile");
						
						$dataUpdate = array('Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Loan_Time'=>$Loan_Time, 'Is_Valid'=>$Is_Valid, 'Budget'=>$budget, 'Company_Name'=>$company);
						$wherecondition = "(Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."')";
						Mainupdatefunc ('Req_Loan_Home', $dataUpdate, $wherecondition);
						
						
			if($Net_Salary>=200000)
						{
							$productname = "hlsalaryclause";
						}
						else
						{
						$productname = "HomeLoan";
						}
						//$filename = "Contents_Home_Loan_Mustread.php?product=$productname";
						//header("Location: $filename");
						//exit();
					
				
					}
					if (($Type_Loan2=="Req_Business_Loan") || ($product=="BusinessLoan") || ($product_name=="BusinessLoan"))
					{
					
						if($Accidental_Insurance==1)
						{
							$RequestID = $_SESSION['Temp_LID'];
							$ProductName = "Req_Business_Loan";
							InsertTataAig($RequestID, $ProductName);
						}
						
						getEligibleBidders("home","$City","$Mobile");
					
						$dataUpdate = array('Residential_Status'=>$Residential_Status, 'Office_Status'=>$Office_Status, 'Accidental_Insurance'=>$Accidental_Insurance, 'CC_Holder'=>$CCbusiness, 'Company_Name'=>$Company_Name, 'Constitution'=>$Constitution, 'Card_Vintage'=>$Card_Vintage, 'CC_Bank'=>$From_Pro, 'Card_Limit'=>$Credit_Limit, 'Loan_Any'=>$Loan_A, 'Is_Valid'=>$Is_Valid, 'EMI_Paid'=>$EMI_Paid);
						$wherecondition = "(Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."')";
						Mainupdatefunc ('Req_Business_Loan', $dataUpdate, $wherecondition);
						

						$productname = "BusinessLoan";
						
//exit();
						$filename = "Contents_Business_Loan_Mustread.php?product=$productname";
						header("Location: $filename");
						exit();
						/*echo "<script language=javascript>location.href=".$filename."</script>"; */
				
					}
			
			
			
				if(isset($_SESSION['UserType'])) 
					{
						echo "<script language=javascript>"." location.href='myRequests.php'"."</script>";
						
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
	
	
	
	
	if($product=="PropertyLoan" || $product_name=="PropertyLoan")
	{
		$file_name = "Contents_Loan_Against_Property_Mustread.php?product=$product_name";
		header("Location: $file_name");
		exit();
	}
	else if($product=="CarLoan" || $product_name=="CarLoan")
	{
		$file_name = "Contents_Car_Loan_Mustread.php?product=$product_name";
		header("Location: $file_name");
		exit();
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

if (($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan") || ($product_name=="PersonalLoan"))
 {
 //echo "month income".$monthsalary."pl emi: ".$PL_EMI_Amt."company : ".$getCompany_Name." age :".$age."City : ".$City."<br><br>";
 
 $getcompany='select hdfc_bank,fullerton,citibank,barclays from pl_company_list where company_name="'.$getCompany_Name.'"';
list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$hdfccategory= $grow[0]["hdfc_bank"];
$fullertoncategory= $grow[0]["fullerton"];
$citicategory= $grow[0]["citibank"];
$barclayscategory= $grow[0]["barclays"];

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
<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;"> Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a Call from us.<br /></div>
 <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$_SESSION['Temp_LID'],$strCity);
	$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0)
	 {
	?>
	<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;">
Following Banks are interested in your profile, will get back to you & give you the best Deal..</div>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#e8e6d9">
  <tr>
    <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	 <? if((strlen($Document_proof_doc)>0) )
		 {?>
    <td width="72%" align="center"><b style="font-size:12px;">Pending Documents</b></td>
	<?}?>
    <!--<td width="11%" align="center"><b style="font-size:12px;">Information</b></td> -->
	<td width="11%" align="center"><b style="font-size:12px;">Maximum Loan Eligibility</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Interest Rate</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Month)</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Tenure(yrs)</b></td>
    <!--<td width="6%" align="center"><b style="font-size:12px;">Apply</b></td> -->
  </tr>
 <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$_SESSION['Temp_LID'],$strCity);
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
   <form name="check_bidders" action="get_checked_bidders.php" method="POST" >
     <input type="hidden" name="reply_product" value="Req_Loan_Personal">
     <input type="hidden" name="requestid" value="<? echo $_SESSION['Temp_LID'];?>">
     <input type="hidden" name="selectbidderID" id="selectbidderID2" value="<? echo $FinalBidder ;?>">
     <input type="hidden" name="realbankID" id="realbankID2" value="<? echo $realbankiD ;?>">
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
//echo $Final_Bid[$i];
		//
		$getdoc="select document_proof,identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'";
	list($recordcount,$myrow)=MainselectfuncNew($getdoc,$array = array());

if($recordcount>0)
				{
		$identification_prf=$myrow[0]["identification_proof"];
	$residence_prf=$myrow[0]["residence_proof"];
	$income_prf=$myrow[0]["income_proof"];
	$document_prf=$myrow[0]["document_proof"];
//echo $document_prf."<br>";
	$arrid_pf=explode(",",$identification_prf);
	$arrres_pf=explode(",",$residence_prf);
	$arrinc_pf=explode(",",$income_prf);
	$arrdoc_pf=explode(",",$document_prf);

//print_r($Document_proof);
//echo "<br>";
//print_r($arrid_pf);
//print_r(array_intersect($Document_proof,$arrid_pf));
$getidpf=array_intersect($Document_proof,$arrid_pf);

//print_r($arrid_pf);
$getrespf=array_intersect($Document_proof,$arrres_pf);
//echo count($arrdoc_pf)."<br>";
//print_r(array_intersect($Document_proof,$arrres_pf));
$getinpf=array_intersect($Document_proof,$arrinc_pf);

$getdocpf=array_intersect($Document_proof,$arrdoc_pf);
//print_r($getdocpf);
//echo "<br>";
}
?>
  <tr>
    <td height="22" align="center" bgcolor="#FFFFFF"><b><? echo $Final_Bid[$i];?></b></td>
	<? if((strlen($Document_proof_doc)>0) )
	 {
		?>
		<td height="30" align="left" valign="middle" bgcolor="#FFFFFF">
		<?if ($recordcount>0)
				 {
		if(count($getidpf)==0 && strlen($identification_prf)>0)
					 {
						echo @str_replace(",", "/", $identification_prf)."<font size=1 color='#000000'> (Any one of these)</font>";
					 }
					
					 if(count($getrespf)==0 && strlen($residence_prf)>0)
					 {
						 if(count($getidpf)==0)
						 {
							echo " <font color='#000000'>and</font><br>";
						 }
						 echo "".@str_replace(",", "/", $residence_prf)."<font size=1  color='#000000'> (Any one of these)</font>";
					 }
					 if(count($getinpf)==0 && strlen($income_prf)>0)
					 {
						 if(count($getrespf)==0)
						 {
							echo " <font color='#000000'>and</font><br>";
						 }
						echo  " ".@str_replace(",", "/", $income_prf)."<font size=1 color='#000000'> (Any one of these)</font><br>";
					 }
					
if(count($getdocpf)>0 && count(array_diff($arrdoc_pf,$getdocpf))>0)
		{
			if((count($getinpf)==0 && strlen($income_prf)>0)|| (count($getidpf)==0 &&  strlen($identification_prf)>0) || (count($getrespf)==0 && strlen($residence_prf)>0) )
						 {
							echo " <font color='#000000'>and</font><br>";
						 }
						 
						 $getexactpf=array_diff($arrdoc_pf,$getdocpf);
						 $strexactpf=implode(",",$getexactpf);

			echo  " ".@str_replace(",", " | ", $strexactpf)." <br>";
		}
		elseif(count($getdocpf)==0 && count(array_diff($arrdoc_pf,$getdocpf))>0)
					 {	
						if((count($getinpf)==0 && strlen($income_prf)>0)|| (count($getidpf)==0 &&  strlen($identification_prf)>0) || (count($getrespf)==0 && strlen($residence_prf)>0) )
						 {
							echo " <font color='#000000'>and</font><br>";
						 }
				
			echo  " ".@str_replace(",", " | ", $document_prf)." <br>";
					 }

if((count($getidpf)>0) && (count($getrespf)>0) && (count($getinpf)>0) && (count(array_diff($arrdoc_pf,$getdocpf))==0) && count($getdocpf)>0)
					 {	
						echo "Complete Documents";
					 }
					 elseif((count($getidpf)>0) && (count($getrespf)>0) && (strlen($income_prf)==0) && (count(array_diff($arrdoc_pf,$getdocpf))==0) && count($getdocpf)>0)
					 {
						echo "Complete Documents";
					 }



		
				 }
		 else
		 {
			 echo"";
		 }?>
	</td>
	<? }?>
    
	<? if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{
	?>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $hdfcgetloanamout; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $hdfcinterestrate; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $hdfcgetemicalc; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $hdfcterm; ?></b></td>
	<?
		}
	else
		{?>
<td align="center" bgcolor="#FFFFFF" colspan="4"><b>Get Quote on call from Bank</b></td>
	<?	}
		//echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	elseif((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
	{
	list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	?>
	<td align="center" bgcolor="#FFFFFF"><b><? echo $fullertongetloanamout; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $fullertoninterestrate; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $fullertongetemicalc; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $fullertonterm; ?></b></td>
	<?
		}
	else
		{?>
<td align="center" bgcolor="#FFFFFF" colspan="4"><b>Get Quote on call from Bank</b></td>
		<?}
		//echo "<a href='/fullerton-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
	?>
<!--	<td align="center" bgcolor="#FFFFFF" colspan="4"><b><a href='/kotak-personal-loan-eligibility.php' target='_blank'>Get Quote on call from Bank</a> </b></td> -->
	<td align="center" bgcolor="#FFFFFF" colspan="4"><b>Get Quote on call from Bank</b></td>
		
	<? //echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif((($Final_Bid[$i]=="CITIBANK") ||  ($Final_Bid[$i]=="Citibank")) && (strlen($citicategory)>0))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=citibank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$age,$citicategory);
	if($citigetloanamout>0)
		{
	?>
	<td align="center" bgcolor="#FFFFFF"><b><? echo $citigetloanamout; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $citiinterestrate; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $citigetemicalc; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $cititerm; ?></b></td>
	<?
		}
	else
		{
		?>
<td align="center" bgcolor="#FFFFFF" colspan="4"><b>Get Quote on call from Bank</b></td> 
		<?}
		//echo "<a href='/citibank-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif($Final_Bid[$i]=="Barclays")
	{
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
	if($barclaygetloanamout>0)
		{
	?>
	<td align="center" bgcolor="#FFFFFF"><b><? echo $barclaygetloanamout; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $barclayinterestrate; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $barclaygetemicalc; ?></b></td>
		<td align="center" bgcolor="#FFFFFF"><b><? echo $barclayterm; ?></b></td>
		<?
		}
	else
		{?>
<td align="center" bgcolor="#FFFFFF" colspan="4"><b>Get Quote on call from Bank</b></td> 
		<?}
	}
	else
	{
	?>
	<!--	<td align="center" bgcolor="#FFFFFF" colspan="4"><b><a href='/personal-loan-banks-information.php#<? //echo $Final_Bid[$i]; ?>' target='_blank'>Get Quote on call from Bank</a></b></td> -->
<td align="center" bgcolor="#FFFFFF" colspan="4"><b>Get Quote on call from Bank</b></td> 
		<? 
		//echo "<a href='/personal-loan-banks-information.php#".$Final_Bid[$i]."' target='_blank'> Know More </a>";
	}
	?>
	
   <!-- <td bgcolor="#FFFFFF" align="center"><input type='checkbox' value='<? //echo $Final_Bid[$i]; ?>' name='Final_Bidder[<? //echo $i;?>]' checked  style="border:none;" /></td> -->
  </tr>
  <? } ?>
   <!--<tr>
    <td height="30" colspan="7" align="center" bgcolor="#FFFFFF"><input type="submit" name="submit" value="Submit" style="font-family: Verdana, Arial, Helvetica, sans-serif; width:90px; font-size: 13px;color: #FFFFFF;	background-color: #529BE4; border:none;
	font-weight: bold;" /></td>
    </tr> -->
	<tr>
    <td colspan="6" align="right" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
    </tr>
</form>
 </table>
 <? }
	 }
	 else
	 {?>
<form name="plpensionform" action="http://www.bimadeals.com/life-insurance-india/thank_life_insurance_d4l.php" method="POST">
		<table width='500' border='0' cellpadding='0' cellspacing='0' style='border:1px solid #e2e2e2;' align="center">
			<input type='hidden' value='<? echo $Net_Salary;?>' name='netSalary' id='netSalary'>
			<input type='hidden' name='DOB' id='DOB' value='<? echo $getDOB;?>'>
			<input type='hidden' name='Mobile' id='Mobile' value='<? echo $Mobile;?>'>
			<input type='hidden' name='City' id='City' value='<? echo $City;?>'>
			<input type='hidden' name='Email' id='Email' value='<? echo $Email;?>'>
			<input type='hidden' name='Name' id='Name' value='<? echo $Name;?>'>
			<input type='hidden' name='getDOB' id='getDOB' value='<? echo $DOB;?>'>
			<tr>
				<td align="left" width="500" height="118"><img src="images/bima-hdr.gif" width="500" height="118" /></td>
			</tr>
			<tr>
				<td align="left" style="border:1px solid #75beec; border-top:none; padding:5px; Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; line-height:17px;" ><table width='100%' border='0' align="left" cellpadding='0' cellspacing='0'>
			<tr>
				<td style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Do you know at your <b>current income</b>, you would require 
				<div id='calculate' style='Font-size:12px; font-family:Verdana, Arial verdana, Helvetica, sans-serif; font-weight:bold;'>Rs. <? echo round($getexactvaluemonthly);?> per month</div>At your Retirement Age of <input type='text' value='50' name='agecalc' id='agecalc' size='3' onchange='taxinsertData();'> yrs. to lead a quality Life<br />
				<br />
				<b style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">Is your investment enough to meet all your requirements when there will be no source of Income? </b><br />
				If yes, Is it adequate enough to meet your current living style, medical expenses of old age, holiday of your choice, surprise gift for grannies &amp; for many more unlived moments of life??</td>
			</tr>
			<tr>
				<td align="right" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'>Check here to invest today &amp; make your tomorrow better with Bimadeals <br />
			Get &amp; compare offers from Bimadeals Insurance partners &amp; choose the Best Deal for yourself.!! </td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Bimadeals is a one stop shop for all your insurance/investment requirements. Get & Choose Offers from <b style="font-family:Verdana, Arial, Helvetica, sans-serif;">ICICI prudential, Kotak, LIC, Max New York, MetLife</b> & many more just in three easy steps:</td>
			</tr>
			<tr>
				<td ><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#e7e5e5">
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/posticn.jpg" width="17" height="20" /></td>
				<td width="445" bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Post Insurance Requirement</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/cmpricon.jpg" width="19" height="19" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Compare &amp; Get offers from Insurance Companies.</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/dealicn.jpg" width="22" height="15" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Choose the Best Deal to suit your needs.</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
				<td height="22" style="color:#2A72BC; Font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;"> Live A Tension Free Life! </td>
			</tr>
			<tr>
				<td height="35" align="right" valign="top" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			</table></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; padding:4px; line-height:17px;'></td>
			</tr>
		</table>
	</form>
	 <?}?>
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
		for($ii=0;$ii<$recordcount;$ii++)
		 {?>
				<td valign="top" >
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
						<tr>
							<td height="30" class="crdbhdng"><a href="<? if (strlen($myrow[$ii]["cc_bank_url"])>0) {echo $myrow[$ii]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow[$ii]["cc_bank_name"];?></a></td>
						</tr>
						<tr>
							<td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow[$ii]["cc_bank_url"])>0) {echo $myrow[$ii]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow[$ii]["card_image"];?>"  width="150" height="244" /></a></td>
						</tr>
						<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
						<tr>
							<td height="270" valign="top" class="crdtext"><? echo $myrow[$ii]["cc_bank_features"];?></td>
						</tr>
						<tr>
							<td align="center" valign="bottom"><a href="<? if (strlen($myrow[$ii]["cc_bank_url"])>0) {echo $myrow[$ii]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
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
<form name="plpensionform" action="http://www.bimadeals.com/life-insurance-india/thank_life_insurance_d4l.php" method="POST">
		<table width='500' border='0' cellpadding='0' cellspacing='0' style='border:1px solid #e2e2e2;' align="center">
			<input type='hidden' value='<? echo $Net_Salary;?>' name='netSalary' id='netSalary'>
			<input type='hidden' name='DOB' id='DOB' value='<? echo $getDOB;?>'>
			<input type='hidden' name='Mobile' id='Mobile' value='<? echo $Mobile;?>'>
			<input type='hidden' name='City' id='City' value='<? echo $City;?>'>
			<input type='hidden' name='Email' id='Email' value='<? echo $Email;?>'>
			<input type='hidden' name='Name' id='Name' value='<? echo $Name;?>'>
			<input type='hidden' name='getDOB' id='getDOB' value='<? echo $DOB;?>'>
			<tr>
				<td align="left" width="500" height="118"><img src="images/bima-hdr.gif" width="500" height="118" /></td>
			</tr>
			<tr>
				<td align="left" style="border:1px solid #75beec; border-top:none; padding:5px; Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; line-height:17px;" ><table width='100%' border='0' align="left" cellpadding='0' cellspacing='0'>
			<tr>
				<td style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Do you know at your <b>current income</b>, you would require 
				<div id='calculate' style='Font-size:12px; font-family:Verdana, Arial verdana, Helvetica, sans-serif; font-weight:bold;'>Rs. <? echo round($getexactvaluemonthly);?> per month</div>At your Retirement Age of <input type='text' value='50' name='agecalc' id='agecalc' size='3' onchange='taxinsertData();'> yrs. to lead a quality Life<br />
				<br />
				<b style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">Is your investment enough to meet all your requirements when there will be no source of Income? </b><br />
				If yes, Is it adequate enough to meet your current living style, medical expenses of old age, holiday of your choice, surprise gift for grannies &amp; for many more unlived moments of life??</td>
			</tr>
			<tr>
				<td align="right" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'>Check here to invest today &amp; make your tomorrow better with Bimadeals <br />
			Get &amp; compare offers from Bimadeals Insurance partners &amp; choose the Best Deal for yourself.!! </td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Bimadeals is a one stop shop for all your insurance/investment requirements. Get & Choose Offers from <b style="font-family:Verdana, Arial, Helvetica, sans-serif;">ICICI prudential, Kotak, LIC, Max New York, MetLife</b> & many more just in three easy steps:</td>
			</tr>
			<tr>
				<td ><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#e7e5e5">
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/posticn.jpg" width="17" height="20" /></td>
				<td width="445" bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Post Insurance Requirement</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/cmpricon.jpg" width="19" height="19" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Compare &amp; Get offers from Insurance Companies.</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/dealicn.jpg" width="22" height="15" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Choose the Best Deal to suit your needs.</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
				<td height="22" style="color:#2A72BC; Font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;"> Live A Tension Free Life! </td>
			</tr>
			<tr>
				<td height="35" align="right" valign="top" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			</table></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; padding:4px; line-height:17px;'></td>
			</tr>
		</table>
	</form>
	 <?}
	 }

	/*if((($Net_Salary<350000) && (count($FinalBidder)=="")))
	{
	$filename = "Contents_Personal_Loan_Mustread.php?product=$productname";
	header("Location: $filename");
	exit();
	}*/

?>

 </div>
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
<? }?>
<!--END OF PL SECTION -->
<!--HOME LOAN START -->
<?  //echo $_SESSION['Temp_LID']=232701;
/*echo $_SESSION['Temp_LID']=107712;
echo $Type_Loan2="Req_Loan_Home";
echo $strCity="Delhi";
echo $Net_Salary=400000;
echo $City="Delhi";
//echo $Document_proof_doc="Appointment Letter,Form16,Latest 3 months salary slip,6 months bank statement,Pancard,Passport,LIC Policy,Credit Card photocopy";*/

if(($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan") || ($product_name=="HomeLoan"))
 {
	 //echo "fffff";
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
<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a Call from us.<br />
</div>
 <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$_SESSION['Temp_LID'],$strCity);
$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);


if(count($FinalBidder)>0)
	 {
	
	?>
<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;">Following Banks are interested in your profile, will get back to you & give you the best Deal..</div>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#e8e6d9">
  <tr>
    <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Information</b></td>
    <td width="6%" align="center"><b style="font-size:12px;">Apply</b></td>
  </tr>
 <?

	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$_SESSION['Temp_LID'],$strCity);
//print_r($bankID);
$Final_Bid = "";
		while (list ($key,$val) = @each($bankID)) { 
			$Final_Bid[]= $val; 
		} 

 
	$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0)
	 {
	?>
   <form name="check_bidders" action="get_checked_bidders.php" method="POST">
	<input type="hidden" name="reply_product" value="Req_Loan_Home">
	<input type="hidden" name="requestid" value="<? echo $_SESSION['Temp_LID'];?>">
	<input type="hidden" name="selectbidderID" id="selectbidderID" value="<? echo $FinalBidder ;?>">
		<input type="hidden" name="realbankID" id="realbankID" value="<? echo $realbankiD ;?>">
		<?
for($i=0;$i<count($Final_Bid);$i++)
			{
		?>
  <tr>
    <td height="22" align="center" bgcolor="#FFFFFF"><b><? echo $Final_Bid[$i];?></b></td>
	
    <td align="center" bgcolor="#FFFFFF">
	<?
	if($finalBidderName[$i]=="Axis Bank")
	{
		echo "<a href='/home-loan-axis-bank.php' target='_blank'>Know More</a>";	
	}
	elseif($finalBidderName[$i]=="Citibank")
	{
		echo "<a href='/home-loan-citibank.php' target='_blank'>Know More</a>";
	}
	elseif($finalBidderName[$i]=="DHFL")
	{
		echo "<a href='/dhfl.php' target='_blank'>Know More</a>";
	}
	elseif(($finalBidderName[$i]=="IDBI Housing Finance"))
	{
		echo "<a href='/home-loan-idbi-homefinance.php' target='_blank'>Know More</a>";
	}
	elseif($finalBidderName[$i]=="Lic Housing")
	{
		echo "<a href='/lic-housing-home-loan.php' target='_blank'>Know More</a>";
	}
	elseif($finalBidderName[$i]=="ICICI")
	{
		echo "<a href='/icici-hfc-home-loan.php' target='_blank'>Know More</a>";
	}
	elseif($finalBidderName[$i]=="HDFC Bank")
	{
		echo "<a href='/hdfc-bank-home-loan.php' target='_blank'>Know More</a>";
	}
	else
	{
		echo "<a href='/home-loan-banks.php#".$finalBidderName[$i]."' target='_blank'> Know More </a>";
	}
	?>
	</b></td>
    <td bgcolor="#FFFFFF" align="center"><input type='checkbox' value='<? echo $Final_Bid[$i];?>' name='Final_Bidder[<? echo $i;?>]' checked style="border:none;" /></td>
  </tr>
  <? } ?>
   <tr>
    <td height="30" colspan="4" align="center" bgcolor="#FFFFFF"><input type="submit" name="submit" value="Submit" style="font-family: Verdana, Arial, Helvetica, sans-serif; width:90px; font-size: 13px;color: #FFFFFF;	background-color: #529BE4; border:none;
	font-weight: bold;" /></td>
    </tr>
</form>
 </table>
 <? }
	
	 }
	 
	 else
	 {
		 ?>
		 <form name="plpensionform" action="http://www.bimadeals.com/life-insurance-india/thank_life_insurance_d4l.php" method="POST">
		<table width='500' border='0' cellpadding='0' cellspacing='0' style='border:1px solid #e2e2e2;' align="center">
			<input type='hidden' value='<? echo $Net_Salary;?>' name='netSalary' id='netSalary'>
			<input type='hidden' name='DOB' id='DOB' value='<? echo $getDOB;?>'>
			<input type='hidden' name='Mobile' id='Mobile' value='<? echo $Mobile;?>'>
			<input type='hidden' name='City' id='City' value='<? echo $City;?>'>
			<input type='hidden' name='Email' id='Email' value='<? echo $Email;?>'>
			<input type='hidden' name='Name' id='Name' value='<? echo $Name;?>'>
			<input type='hidden' name='getDOB' id='getDOB' value='<? echo $DOB;?>'>
			<tr>
				<td align="left" width="500" height="118"><img src="images/bima-hdr.gif" width="500" height="118" /></td>
			</tr>
			<tr>
				<td align="left" style="border:1px solid #75beec; border-top:none; padding:5px; Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; line-height:17px;" ><table width='100%' border='0' align="left" cellpadding='0' cellspacing='0'>
			<tr>
				<td style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Do you know at your <b>current income</b>, you would require 
				<div id='calculate' style='Font-size:12px; font-family:Verdana, Arial verdana, Helvetica, sans-serif; font-weight:bold;'>Rs. <? echo round($getexactvaluemonthly);?> per month</div>At your Retirement Age of <input type='text' value='50' name='agecalc' id='agecalc' size='3' onchange='taxinsertData();'> yrs. to lead a quality Life<br />
				<br />
				<b style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">Is your investment enough to meet all your requirements when there will be no source of Income? </b><br />
				If yes, Is it adequate enough to meet your current living style, medical expenses of old age, holiday of your choice, surprise gift for grannies &amp; for many more unlived moments of life??</td>
			</tr>
			<tr>
				<td align="right" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'>Check here to invest today &amp; make your tomorrow better with Bimadeals <br />
			Get &amp; compare offers from Bimadeals Insurance partners &amp; choose the Best Deal for yourself.!! </td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Bimadeals is a one stop shop for all your insurance/investment requirements. Get & Choose Offers from <b style="font-family:Verdana, Arial, Helvetica, sans-serif;">ICICI prudential, Kotak, LIC, Max New York, MetLife</b> & many more just in three easy steps:</td>
			</tr>
			<tr>
				<td ><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#e7e5e5">
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/posticn.jpg" width="17" height="20" /></td>
				<td width="445" bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Post Insurance Requirement</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/cmpricon.jpg" width="19" height="19" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Compare &amp; Get offers from Insurance Companies.</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/dealicn.jpg" width="22" height="15" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Choose the Best Deal to suit your needs.</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
				<td height="22" style="color:#2A72BC; Font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;"> Live A Tension Free Life! </td>
			</tr>
			<tr>
				<td height="35" align="right" valign="top" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			</table></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; padding:4px; line-height:17px;'></td>
			</tr>
		</table>
	</form>
	<?
	 }?>
<?php 

$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		{
		 ?>
		<div style="text-align:center; font-weight:bold; line-height:18px; padding:15px 0px;">
		There are some other financial products that are on offer for you on the basis of details you have submitted.
		<br />
		If you are interested, Go ahead and <font color="#5e3307">Apply</font></div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
		 <?
		  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
list($recordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
for($ii=0;$ii<$recordcount;$ii++)
		 {?>
				<td valign="top">
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
						<tr>
							<td height="30" class="crdbhdng"><a href="<? if (strlen($myrow[$ii]["cc_bank_url"])>0) {echo $myrow[$ii]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow[$ii]["cc_bank_name"];?></a></td>
						</tr>
						<tr>
							<td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow[$ii]["cc_bank_url"])>0) {echo $myrow[$ii]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow[$ii]["card_image"];?>"  width="150" height="244"/></a></td>
						</tr>
						<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
						<tr>
							<td class="crdtext" height="270"><? echo $myrow[$ii]["cc_bank_features"];?></td>
						</tr>
						<tr>
							<td  align="center" valign="bottom"><a href="<? if (strlen($myrow[$ii]["cc_bank_url"])>0) {echo $myrow[$ii]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
						</tr>
					</table>
				</td>
				<? }?>
			</tr>
		</table>

	<?}
	else
	 {
		if(count($FinalBidder)>0)
	 {?>
		
	<form name="plpensionform" action="http://www.bimadeals.com/life-insurance-india/thank_life_insurance_d4l.php" method="POST">
		<table width='500' border='0' cellpadding='0' cellspacing='0' style='border:1px solid #e2e2e2;' align="center">
			<input type='hidden' value='<? echo $Net_Salary;?>' name='netSalary' id='netSalary'>
			<input type='hidden' name='DOB' id='DOB' value='<? echo $getDOB;?>'>
			<input type='hidden' name='Mobile' id='Mobile' value='<? echo $Mobile;?>'>
			<input type='hidden' name='City' id='City' value='<? echo $City;?>'>
			<input type='hidden' name='Email' id='Email' value='<? echo $Email;?>'>
			<input type='hidden' name='Name' id='Name' value='<? echo $Name;?>'>
			<input type='hidden' name='getDOB' id='getDOB' value='<? echo $DOB;?>'>
			<tr>
				<td align="left" width="500" height="118"><img src="images/bima-hdr.gif" width="500" height="118" /></td>
			</tr>
			<tr>
				<td align="left" style="border:1px solid #75beec; border-top:none; padding:5px; Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; line-height:17px;" ><table width='100%' border='0' align="left" cellpadding='0' cellspacing='0'>
			<tr>
				<td style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Do you know at your <b>current income</b>, you would require 
				<div id='calculate' style='Font-size:12px; font-family:Verdana, Arial verdana, Helvetica, sans-serif; font-weight:bold;'>Rs. <? echo round($getexactvaluemonthly);?> per month</div>At your Retirement Age of <input type='text' value='50' name='agecalc' id='agecalc' size='3' onchange='taxinsertData();'> yrs. to lead a quality Life<br />
				<br />
				<b style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">Is your investment enough to meet all your requirements when there will be no source of Income? </b><br />
				If yes, Is it adequate enough to meet your current living style, medical expenses of old age, holiday of your choice, surprise gift for grannies &amp; for many more unlived moments of life??</td>
			</tr>
			<tr>
				<td align="right" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'>Check here to invest today &amp; make your tomorrow better with Bimadeals <br />
			Get &amp; compare offers from Bimadeals Insurance partners &amp; choose the Best Deal for yourself.!! </td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Bimadeals is a one stop shop for all your insurance/investment requirements. Get & Choose Offers from <b style="font-family:Verdana, Arial, Helvetica, sans-serif;">ICICI prudential, Kotak, LIC, Max New York, MetLife</b> & many more just in three easy steps:</td>
			</tr>
			<tr>
				<td ><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#e7e5e5">
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/posticn.jpg" width="17" height="20" /></td>
				<td width="445" bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Post Insurance Requirement</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/cmpricon.jpg" width="19" height="19" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Compare &amp; Get offers from Insurance Companies.</td>
			</tr>
			<tr>
				<td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/dealicn.jpg" width="22" height="15" /></td>
				<td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Choose the Best Deal to suit your needs.</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
				<td height="22" style="color:#2A72BC; Font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;"> Live A Tension Free Life! </td>
			</tr>
			<tr>
				<td height="35" align="right" valign="top" style="padding-right:15px;" ><input type="image" name="Submit" src="images/apl-btn.gif" width="75" height="21" style="border:none;" /></td>
			</tr>
			</table></td>
			</tr>
			<tr>
				<td align="left" style='Font-size:12px; font-family:Arial, verdana, Helvetica, sans-serif; padding:4px; line-height:17px;'></td>
			</tr>
		</table>
	</form>

	 <?
	 }}
	

	/*if(count($FinalBidder)=="")
	{
	$filename = "Contents_Home_Loan_Mustread.php?product=$productname";
	header("Location: $filename");
	exit();
	}*/

?>


 </div>
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
<? }?>


   
</body>
</html>