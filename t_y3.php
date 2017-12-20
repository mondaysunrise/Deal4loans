<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	
	
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
		 $Dated = ExactServerdate();
		

		$dataInsert = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);

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


		list($year,$month,$day) = split('[-]', $DOB);

$currentyear=date('Y');
$age=$currentyear-$year;
//echo $age."<br>";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//$experiment=$_REQUEST['FullName'];
			//echo $experiment;
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
			$company = $_REQUEST['Company_Name'];
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
//echo $exactage."<br>";
//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;

//echo $Type_Loan2."2: ".$product."3: ".$product_name."<br>";
//echo $getexactvaluemonthly;	
				
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
						$qry="Update Req_Credit_Card SET  Credit_Limit='$Credit_Limit', No_of_Banks='$From_Pro', Pincode='$pinno',Residence_Address='$Residence_Address',Is_Valid='$Is_Valid', Applied_With_Banks='$From_Pro1',Office_Address='$Office_Address',Std_Code='$Std_Code',Std_Code_O='$Std_Code_O',Landline_O='$Landline_O',Landline='$Landline',Pancard_No='$Pancard_no' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."'";
						//echo $qry;

						$productname = "CreditCard";

				
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
						$qry="Update Req_Loan_Personal SET  Primary_Acc='$Primary_Acc', Residential_Status='$Residential_Status' ,Card_Limit= '$Credit_Limit', Years_In_Company='$Years_In_Company', Is_Valid='$Is_Valid', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A',Mobile_Connection='$Mobile_Connection',Landline_Connection='$Landline_Connection',Salary_Drawn='$Salary_Drawn',identification_proof='$Document_proof_doc' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."'  ";
						}
						else {
						$qry="Update Req_Loan_Personal SET Primary_Acc='$Primary_Acc', Years_In_Company='$Years_In_Company', Is_Valid='$Is_Valid',Card_Limit= '$Credit_Limit', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A',Mobile_Connection='$Mobile_Connection',Landline_Connection='$Landline_Connection',Salary_Drawn='$Salary_Drawn',identification_proof='$Document_proof_doc' Where  Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."'  ";
						
						}
					
					//echo $qry;


						if($Net_Salary>=200000)
						{
							$productname = "plsalaryclause";
						}
						else
						{
						$productname = "PersonalLoan";
						}
						
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
						$qry="Update Req_Loan_Home SET Property_Identified='$Property_Identified', Property_Loc ='$Property_Loc', Loan_Time='$Loan_Time', Is_Valid='$Is_Valid', Budget='$budget',Company_Name='$company' Where  Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."'";
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
					if (($Type_Loan2=="Req_Business_Loan") || ($product=="BusinessLoan") || ($product_name=="BusinessLoan"))
					{
					
						if($Accidental_Insurance==1)
						{
							$RequestID = $_SESSION['Temp_LID'];
							$ProductName = "Req_Business_Loan";
							InsertTataAig($RequestID, $ProductName);
						}
						
						getEligibleBidders("home","$City","$Mobile");
						$qry="Update Req_Business_Loan SET Residential_Status='$Residential_Status',Office_Status='$Office_Status',Accidental_Insurance='$Accidental_Insurance', CC_Holder='$CCbusiness',Company_Name='$Company_Name',Constitution='$Constitution', Card_Vintage='$Card_Vintage',CC_Bank='$From_Pro', Card_Limit='$Credit_Limit', Loan_Any='$Loan_A', Is_Valid='$Is_Valid', EMI_Paid='$EMI_Paid' Where Mobile_Number='".$Mobile."' and Email='".$Email."' and Net_Salary='".$Net_Salary."' and City='".$City."'";
						//echo $qry;

						
						$productname = "BusinessLoan";
						
//exit();
						$filename = "Contents_Business_Loan_Mustread.php?product=$productname";
						header("Location: $filename");
						exit();
						//echo "<script language=javascript>location.href=".$filename."</script>"; 
				
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
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
 
		
<?
//echo $_SESSION['Temp_LID']=107712;
echo $_SESSION['Temp_LID']=232701;
echo $Type_Loan2="Req_Loan_Personal";
echo $strCity="Delhi";
echo $Net_Salary=400000;
echo $City="Delhi";
echo $Document_proof_doc="Appointment Letter,Form16,Latest 3 months salary slip,6 months bank statement,Pancard,Passport,LIC Policy,Credit Card photocopy";

 if (($Type_Loan2=="Req_Loan_Personal") || ($product=="PersonalLoan") || ($product_name=="PersonalLoan"))
 {
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
}?>
 <table width="850"  border="0" cellspacing="0" cellpadding="0" align="center">
 <tr><td  colspan="2" valign="top"><div style="Font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:10px; padding-top:10px;">Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a Call from us.</div>
    <tr><td colspan="2">
<div style="  Font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:5px;">
 Following Banks are interested in your profile, will get back to you & give you the best Deal..</div>
 <table width="100%" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1" >
   <tr  >
     <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
       <td width="11%" align="center"><b style="font-size:12px;">Information</b></td>
	  <? if((strlen($Document_proof_doc)>0) )
	 {
	?>
	<td width="72%" align="center"><b style="font-size:12px;">Pending Documents</b></td>
	 <?}
?>
      <td width="6%" align="center"><b style="font-size:12px;">Apply</b></td>
   </tr>
  
   <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$_SESSION['Temp_LID'],$strCity);
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
		//
		//echo "select identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'";
		$myrow = mysql_fetch_array($getdoc);
		$recordcount = mysql_num_rows($getdoc);
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


		//
//echo 		$realbankiD[$i];
	echo "<tr><td height='22' align='center' bgcolor='#FFFFFF'><b>".$Final_Bid[$i]."</b></td><td align='center' bgcolor='#FFFFFF'><b>";
	if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
		echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	elseif((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
	{
		echo "<a href='/fullerton-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
		echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif(($Final_Bid[$i]=="CITIBANK") ||  ($Final_Bid[$i]=="Citibank"))
	{
		echo "<a href='/citibank-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif($Final_Bid[$i]=="Barclays")
	{
		echo "<a href='/barclays-finance-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	else
	{
		echo "<a href='/personal-loan-banks-information.php#".$Final_Bid[$i]."' target='_blank'> Know More </a>";
	}
	echo "</b></td>";
	 if((strlen($Document_proof_doc)>0) )
	 {
	
	?><td  height='30' align='left' valign='middle' bgcolor='#FFFFFF' style="padding:4px; line-height:18px;">
	<? if ($recordcount>0)
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
				
			//echo  " ".@str_replace(",", " | ", $document_prf)." <br>";
					 }

if((count($getidpf)>0) && (count($getrespf)>0) && (count($getinpf)>0) && (count(array_diff($arrdoc_pf,$getdocpf))==0) && count($getdocpf)>0)
					 {	
						echo "Complete documents";
					 }


		
				 }
		 else
		 {
			 echo"";
		 }?></td>
 <?}
	echo "<td bgcolor='#FFFFFF'  align='center'><input type='checkbox' value='$Final_Bid[$i]' name='Final_Bidder[$i]' checked style='border:none;'/></td></tr>";
//echo $Final_Bid[$i]."  er ".$finalBidderName[$i]."<br>";
}
?>
    
     <tr>
       <td height="30" colspan="4" align="center" bgcolor="#FFFFFF"><input type="submit" name="submit2" value="Apply" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;color: #FFFFFF;	background-color: #529BE4;	border: 1px solid #529BE4;
	font-weight: bold;"></td>
     </tr>
   </form>
 </table>
 <? }?>
 </td></tr>
   

  
<tr><td height="60" colspan="2" valign="middle"><hr  color="#78c2ee" size="2" noshade="noshade"></td></tr>
<tr><td colspan="2">
<?php 

$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		
		 
		 {
			 
			 ?>
			 <div style="font-weight:bold; font-size:12px; font-family:verdana; padding:8px 0px;">There are some other financial products that are on offer for you on the basis of details you have submitted.<BR> If you are interested, Go ahead and <font color='#75332E'>Apply</font></div>
			<table  border="0" cellspacing="0" cellpadding="0" width="100%">	<tr>
			  <?
			  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
			 list($getrecordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
		$cntr=0;
			

			  //echo "query3 ".$get_Bank."<br><br>";  
			  // $getrecordcount = mysql_num_rows($get_Bankresult);
			  // $myrow = mysql_fetch_array($get_Bankresult);
			   $cc_bankid  = $myrow[$cntr]["cc_bankid"];
		$cc_bank_url  = $myrow[$cntr]["cc_bank_url"];
	?>
		 <?
 
while($cntr<count($myrow))
        {
			  
		
			?>

     <td align="center" valign="top" class="crdbg"  width="238"><table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" class="crdbhdng"><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><? 
		echo $cc_bank_name = $myrow[$cntr]['cc_bank_name'];
		//echo $myrow["cc_bank_name"];?></a></td>
      </tr>
      <tr>
        <td height="135" align="center" valign="bottom">
		<? $card_image =$myrow[$cntr]['card_image'];
		?><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><img src="<? echo $card_image;?>"  height="119" /></a></td>
      </tr>
      <tr>
        <td height="22" valign="bottom" class="crdbold">Features</td>
      </tr>
      <tr>
        <td height="316" valign="top" class="crdtext"><? //echo $myrow["cc_bank_features"];
		echo $cc_bank_features = $myrow[$cntr]['cc_bank_features'];
		?></td>
      </tr>
      <tr>
        <td align="center" valign="bottom"><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank" >
          <input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
      </tr>
    </table></td>
        
		<?
			//echo "heloooooo".$i."<br>";
		

		 $cntr=$cntr+1;
		 
		 }
		?>
		</tr>
			  </table>
		

	<? }
	
	
	?></td></tr></table>

<?	/// }

if((($Net_Salary<350000) && (count($FinalBidder)=="")))
{
	$filename = "Contents_Personal_Loan_Mustread.php?product=$productname";
	header("Location: $filename");
	exit();
}

?>



 </div>
      

  <?php 
  include '~Bottom-new.php';?>
</div>

 <?}

 
 if (($Type_Loan2=="Req_Loan_Home") || ($product=="HomeLoan") || ($product_name=="HomeLoan"))
 {
	 
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
}?>
 <div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;">Thanks for applying Home Loan through Deal4loans.com. 
   You will soon receive a Call from us.</div>
  <table width="750"  border="0" cellspacing="0" cellpadding="0" align="center">

   <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$_SESSION['Temp_LID'],$strCity);
$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);
if(count($FinalBidder)>0)
	 {
	//echo count($FinalBidder);
	?>

   <tr><td colspan="2">
<div style="  Font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:5px;">
 Following Banks are interested in your profile, will get back to you & give you the best Deal..</div></td></tr>
  <tr>
 <td colspan="2">
  <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#e8e6d9">
<tr  > 
		<td width="25%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
		<td width="25%" height="25" align="center" valign="middle"><b style="font-size:12px;">Information</b></td><td width="11%" align="center"><b style="font-size:12px;">Apply</b></td>
	</tr>


<?php 
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
	echo "<tr><td align='center' bgcolor='#FFFFFF'>".$Final_Bid[$i]."</td><td  align='center' valign='middle' bgcolor='#FFFFFF'><b>";
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
	echo "</b></td><td bgcolor='#FFFFFF'   style='color:#2A72BC; Font-size:15px; font-family:verdana; font-weight:bold;' align='center'><input type='checkbox' value='$Final_Bid[$i]' name='Final_Bidder[$i]' checked></td></tr>";


}
?>

<tr>
<td height="30" colspan="3" align="center" bgcolor="#FFFFFF">
  <input type="submit" name="submit" value="Apply" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;color: #FFFFFF;	background-color: #529BE4;	 
	font-weight: bold;"></td></tr>
</form>

<? }?>
</table>
</td></tr>
<tr><td height="60" colspan="2" valign="middle"><hr  color="#78c2ee" size="2" noshade="noshade"></td></tr>
<? }?>




<tr><td colspan="2">
<?php 
//echo "hello".$_SESSION['temp_net_salary']."<br>".$_SESSION['temp_city']."<br>";
//echo "citibank";
$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
	 {
		 
		 ?>
			 <div style="font-weight:bold; font-size:12px; font-family:verdana;">There are some other financial products that are on offer for you on the basis of details you have submitted.<BR> If you are interested, Go ahead and <font color='#75332E'>Apply</font></div>
			<table  border="0" cellspacing="0" cellpadding="0"  width="100%">	
			  <tr>
			  <?
			  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
			 list($getrecordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
			$j=0;
			

			  //echo "query3 ".$get_Bank."<br><br>";  
			 //  $getrecordcount = mysql_num_rows($get_Bankresult);
			   //$myrow = mysql_fetch_array($get_Bankresult);
			   $cc_bankid  = $myrow[$j]["cc_bankid"];
		$cc_bank_url  = $myrow[$j]["cc_bank_url"];
	?>
		 <?
  while($j<count($myrow))
        {
			?>
 
     <td align="center" valign="top" class="crdbg" width="238"><table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" class="crdbhdng"><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><? 
		echo $cc_bank_name = $myrow[$j]['cc_bank_name'];
		//echo $myrow["cc_bank_name"];?></a></td>
      </tr>
      <tr>
        <td height="135" align="center" valign="bottom">
		<? $card_image =$myrow[$j]['card_image'];
		?><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><img src="<? echo $card_image;?>"  height="119" /></a></td>
      </tr>
      <tr>
        <td height="22" valign="bottom" class="crdbold">Features</td>
      </tr>
      <tr>
        <td height="316" valign="top" class="crdtext"><? //echo $myrow["cc_bank_features"];
		echo $cc_bank_features = $myrow[$j]['cc_bank_features'];
		?></td>
      </tr>
      <tr>
        <td align="center" valign="bottom"><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank" >
          <input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
      </tr>
    </table></td>
        
		<?
			//echo "heloooooo".$i."<br>";
		

		$j = $j+1;}
		?>
		</tr>
	  </table>

	<? }
	
	
	?></td></tr>

<? //echo count($FinalBidder)."";
if((($Net_Salary<350000) && (count($FinalBidder)=="")))
{
	//echo "else";
	$filename = "Contents_Home_Loan_Mustread.php?product=$productname";
	header("Location: $filename");
	exit();
}

?>
			

</table>
 
 </div>
      

  <?php 
  include '~Bottom-new.php';?>
</div> 
 <?}

/***********************************************************************************************/
 /****CREDIT CARD CODE**************************************************************************/
 if (($product=="CreditCard") || ($product_name=="CreditCard") ) 
 {?>
 <? list($FinalBidder,$finalBidderName)= getBiddersList("Req_Credit_Card",$_SESSION['Temp_LID'],$City);
//echo "hello".count($FinalBidder)."<br>";
if(count($FinalBidder)>0)
	 {?>
<hr  color="#78c2ee" size="2" noshade="noshade">

		 <table border="0" cellspacing="0" cellpadding="0" width="750" align="center">
 <tr> <td align="center"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;font-weight:normal; ">&nbsp;</td>
                    <td    style="  Font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:10px; padding-top:10px;"> Dear <? echo $Name;?>,<br>
 Thank you for choosing Deal4loans.com, we are pleased to inform you that your registration for Credit Card has been successful done and we have forwarded your request to the following Credit Card providers: <br>
 <? for($i=0;$i<count($FinalBidder);$i++)
{?>
 <font color="red" size="1">&bull;</font>&nbsp;<font style='font-family:Verdana, Arial, Helvetica, sans-serif; text-decoration:none; color:#000000; font-size:11px;'><? echo $finalBidderName[$i];?></font> 
 <? }?>
 </td></tr>
	

			<tr><td colspan="2" width='100%' align="center"><form name="ccpensionform" action="http://www.bimadeals.com/life-insurance-india/thank_life_insurance_d4l.php" method="POST"><table width='500' border='0' cellpadding='0' cellspacing='0' style='border:1px solid #e2e2e2;'>
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
  <tr><td style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Do you know at your <b>current income</b>, you would require 
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
  <tr><td align="left" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'> Bimadeals is a one stop shop for all your insurance/investment requirements. Get & Choose Offers from <b style="font-family:Verdana, Arial, Helvetica, sans-serif;">ICICI prudential, Kotak, LIC, Max New York, MetLife</b> & many more just in three easy steps:</td>
</tr>
  <tr>
    <td ><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#e7e5e5">
      <tr>
        <td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/posticn.jpg" width="17" height="20" /></td>
        <td width="445" bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Post Insurance Requirement</td>
      </tr>
      <tr>
        <td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/cmpricon.jpg" width="19" height="19" /></td>
        <td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Compare &amp; Get offers from Insurance Champions.</td>
      </tr>
      <tr>
        <td width="40" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><img src="images/dealicn.jpg" width="22" height="15" /></td>
        <td bgcolor="#FFFFFF" style="Font-size:12px; font-family:Verdana, Arial, verdana, Helvetica, sans-serif; color:#1d609f; font-weight:bold; padding-left:8px;">Choose the Best Deal to suit your needs.</td>
      </tr>
    </table></td>
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
</form></td></tr>
<tr><td colspan="2" style='Font-size:12px; font-family: Arial , Helvetica, sans-serif;'><font color="#FF0000" >*</font>Amount calculated based on 5% yearly inflation rates.   
</td></tr>
</table>
		 </div>
      

  <?php 
  include '~Bottom-new.php';?>
</div>
<?

	 }
	
else
{
$filename = "Contents_Credit_Card_Mustread.php?product=$productname";
						header("Location: $filename");
						exit();
}
 }?>
 

</body>
</html>
