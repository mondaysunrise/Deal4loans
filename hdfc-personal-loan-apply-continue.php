<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
		require 'scripts/personal_loan_eligibility_function_form.php';
	session_start();

//echo "qhwl";

//print_r($_POST);
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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$finalurl=$_POST["PostURL"];
		$ProductValue = $_POST["reqtid"];
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Employment_Status = FixString($Employment_Status);
		$Email = FixString($Email);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$Other_City = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$Company_Type = $_REQUEST['Company_Type'];
		$Primary_Acc = $_REQUEST['Primary_Acc'];
		$getDOB = str_replace("-","", $DOB);
		$age = DetermineAgeGETDOB($getDOB);
		$monthsalary =$Net_Salary/12;
		$IP = $_SERVER['REMOTE_ADDR'];
//$ProductValue=608114;
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
if(($validMobile==1) && ($Name!="") && strlen($City)>0)
{
	if($ProductValue>1)
	{
		$Dated = ExactServerdate();	
		$dataUpdate = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Company_Type'=>$Company_Type, 'Primary_Acc'=>$Primary_Acc);
		//echo "hello>".$InsertProductSql."<br>";
		$wherecondition ="(RequestID='".$ProductValue."' and Allocated=0)";
		Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
	


	}
	else
	{
		$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		list($CheckNumRows,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
		$CheckQuerycontr=count($CheckQuery)-1;
		$Dated = ExactServerdate();		
		if($CheckNumRows>0)
		{
			$UserID = $CheckQuery[$CheckQuerycontr]['UserID'];
			$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Mobile_Number, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, ' source'=>$source, 'CC_Bank'=>$CC_Bank, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP);
			$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
			
			//	echo "<br>if".$InsertProductSql;
		}
		else
		{
			$dataUser = array('Email'=>$Email,'FName'=>$Name,'Phone'=>$Phone,'Join_Date'=>$Dated,'IsPublic'=>$IsPublic);
			$UserID1 = Maininsertfunc ('wUsers', $dataUser);

			$dataInsert = array('UserID'=>$UserID1, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Mobile_Number, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, ' source'=>$source, 'CC_Bank'=>$CC_Bank, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP);
			$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
		}
			//echo "hello>".$InsertProductSql."<br>";
			$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
			
	}

	if($City=="Others" && strlen($City_Other)>0)
		{
			$strcity=$City_Other;
		}
		else
		{
			$strcity=$City;
		}

	if($Net_Salary>=360000 && $age>=22 && $Employment_Status==1 && $ProductValue>=1)
		{
			$getbid="select BidderID from Bidders_List Where (City like '%".$strcity."%' and BidderID in (1887,1888,1889,1890,1891,1948,1949,1950,1951,1952,1953,1954,1955,1956,1957,1958,1959,1960,2609,2626,2627,2628,2629) and Restrict_Bidder=1 and Reply_Type=1)";
			list($bidrecordcount,$getbid)=MainselectfuncNew($getbid,$array = array());
			$bidnwcontr=count($bidnw)-1;
			if($bidrecordcount>=1)
			{
				$BidderID = $bidnw[$bidnwcontr]['BidderID'];
				if($BidderID>1)
				{
					$DataBiddersArray = array("Bidderid_Details"=>$BidderID, "Allocated"=>'2' );
					$wherecondition ="(RequestID='".$ProductValue."')";
					Mainupdatefunc ('Req_Loan_Personal', $DataBiddersArray, $wherecondition);
				}

			}
		}
}
else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
		

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>


</head>
<body>
<?php include '~Top-new.php';?>
<?php //include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:5px;">
  
<?php 
////$ProductValue=608114;
if(($Net_Salary>=360000) && ($age>=22) && ($Employment_Status==1) && ($ProductValue>=1))
 { ?>
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important;"> Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a call from HDFC Bank.</h1>
<br><br>
 <?

 $getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$Company_Name.'"';
 //echo $getcompany;
list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$growcontr=count($grow)-1;

$hdfccategory= $grow[$growcontr]["hdfc_bank"];
$fullertoncategory= $grow[$growcontr]["fullerton"];
$citicategory= $grow[$growcontr]["citibank"];
$barclayscategory= $grow[$growcontr]["barclays"];
$stanccategory = $grow[$growcontr]["standard_chartered"];

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
list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$Company_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

if(strlen($hdfcinterestrate)>0 && $hdfcgetloanamout>0 && $hdfcgetemicalc>0 && $hdfcterm>0)
	 { ?>

<table width="960"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #84D5E8;">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td height="35" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0" style="border:1px solid #84D5E8;">
           <tr align="center">
            <td width="142" height="35" class="fontbld10">Bank Name</td>
            <td width="129" class="fontbld10">Interest Rate</td>
            <td width="137" class="fontbld10">Maximum Loan Eligibility</td>
            <td width="105" class="fontbld10">EMI (Per month)</td>
            <td width="86" class="fontbld10">Tenure <br />
              (in Yrs)</td>
			
			
          </tr>
		  <tr align="center">

	<? $imagebank='<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" />'; ?>
	
   <td width="142" height="30" >&nbsp;&nbsp;<? echo  $imagebank; ?><br />
HDFC Bank</td>
 	
			<td width="129" class="fontbld10"><? echo $hdfcinterestrate; ?></td>
            <!--<td width="204"  ><? //echo $hdfcperlacemi; ?></td>-->
            <td width="137"  ><? echo $hdfcgetloanamout; ?></td>
            <td width="105" ><? echo $hdfcgetemicalc; ?></td>
            <td width="86" ><? echo $hdfcterm; ?></td>
		 
	
  </tr>
		  
        </table></td>
      </tr>
	  <tr>
 <td align="right" bgcolor="#dbf2ff"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a>&nbsp; </td>
    </tr>
	 </table></td></tr></table>
	 
	<? } 
	else 
	 {
		echo "We are sorry";
	 }
  
}
 	
	 else
	 { echo "We are sorry";?>
 
	 <? }?>
</div>

 
  <?php include '~Bottom-new.php';?>
</div>
   
</body>
</html>
