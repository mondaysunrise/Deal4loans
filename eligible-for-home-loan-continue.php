<?php

	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';


	//require 'scripts/db_init.php';
	function DetermineAgeFromDOB ($YYYYMMDD_In)
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

	if(isset($_POST['submit']))
	{
		$City = $_POST['City'];
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$dob_arr[] = $_POST['year'];
		$dob_arr[] = $_POST['month'];
		$dob_arr[] = $_POST['day'];
		$dateofbirth = implode("-", $dob_arr);
		$company_name = $_POST['company_name'];
		$Employment_Status = $_POST['Employment_Status'];
		$monthly_income = $_POST['monthly_income'];
		$obligations = $_POST['obligations'];
		$getloan_amount = $_POST['loan_amount'];
		$co_appli = $_POST['co_appli'];
		$source="ndtv";
		$co_name = $_POST['co_name'];
		$dob_arr_co[] = $_POST['co_year'];
		$dob_arr_co[] = $_POST['co_month'];
		$dob_arr_co[] = $_POST['co_day'];
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = $_POST['co_monthly_income'];
		$co_obligations = $_POST['co_obligations'];
		$property_value = $_POST['property_value'];
		
		if($getloan_amount<800000)
		{
			$loan_amount=800000;
		}
		else
		{
			$loan_amount=$getloan_amount;
		}

		//echo $loan_amount."<br>";
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$netAmount=($getnetAmount - $total_obligation);
	//echo	$obligations;
	//echo "<br>";
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm)=ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);

		$IP = getenv("REMOTE_ADDR");
		//echo "<br>";
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Phone'=>$Phone, 'Email'=>$Email, 'DOB'=>$dateofbirth, 'Company_Name'=>$company_name, 'Loan_Amt'=>$loan_amount, 'Employment_Status'=>$Employment_Status, 'Net_Salary'=>$monthly_income, 'Obligations'=>$obligations, 'Co_Name'=>$co_name, 'Co_DOB'=>$DOB_co, 'Co_Salary'=>$co_monthly_income, 'Co_Obligation'=>$co_obligations, 'emi'=>$emi, 'tenure'=>$print_term, 'roi'=>$inter, 'documents'=>'', 'Dated'=>$Dated, 'IP'=>$IP);
		$insertedID = Maininsertfunc ("home_loan_eligibility", $dataInsert);
		$Net_Salary= $monthly_income *12;
//CODE FOR SITE
		$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
			
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP_Address, "Employment_Status"=>$Employment_Status, "Updated_Date"=>$Dated,"DOB"=>$dateofbirth);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP_Address, "Employment_Status"=>$Employment_Status, "Updated_Date"=>$Dated,"DOB"=>$dateofbirth);
			}
			
			//echo $InsertProductSql."<br>";
	$ProductValue = Maininsertfunc ("Req_Loan_Education", $dataArray);
//CODE END FOR SITE
		
	}
?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Loans India Apply Compare</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read and apply online for home loans & Get, Compare and Choose deals from all the leading loan providers / banks. Know the interest rates, EMIs, Loan amount etc choose the Best Deal.">
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/mootools-beta-1.2b2.js"></script> 
<!--[if IE]>
	<script type="text/javascript" src="scripts/moocanvas.js"></script>
<![endif]-->
<script type="text/javascript" src="scripts/piechart.js"></script> 	

<script language="JavaScript" src="scripts/slider.js"></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<link href="style/pl-hl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script language="JavaScript" type="text/javascript" src="images/rollovers.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>
 --><script type="text/javascript" src="js/easySlider1.5.js"></script>

<link rel="stylesheet" href="home_style.css" type="text/css" />
<style>
.bldtxt{
	float:left;
	font-size:13px;
	font-weight:bold;
	color:#3A0303;
	font-family:Verdana, Arial, Helvetica, sans-serif;
}
</style>

</head>

<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div align="center">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td style="padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td style="padding:5px 0px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            
                        <td   align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:5px 0px;"  >
				

				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" >
				
                    <tr>
                      <td height="40" align="center" valign="top" class="heading">Get Instant Quote </td>
                    </tr>
                     <?php
					if($total_obligation>$netAmount)
					{
					?>
					 <tr>
                          <td colspan="2" align="center" class="bldtxt" valign="top" height="200">Total Obligations is greater than Income.</td>
                        </tr>
					<?php
					}
					

					else
					{?>
					
					<tr>
					
                      <td class="text" colspan="2">
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#E9DCB4" class="bldtxt">
                   <tr>
                          <td height="30" bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Bank Name</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rate of Interest </td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">EMI(Per Month)</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Tenure</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Required Loan Amount</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Eligible Loan Amount</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">EMI(Per Lac)</td>
						   <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Total Interest Amount</td>
</tr>
					<?
						if($iciciemi>0 && $iciciinter>0 && $iciciloan_amount>0)
						{
					?>
					
                    <tr>
                          <td height="30" bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">ICICI Bank</td>
						  <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; "><?php echo "8.25% (for first 2 yrs)".abs($iciciinter); ?> %</td>
                         <td bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $iciciemi; ?></td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; "><?php echo abs($iciciprint_term); ?> yrs.</td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo abs($iciciloan_amount); ?></td>
						   <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
						    <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $perlacemifortwo." (for first 2 yrs)".abs($iciciperlacemi); ?></td>
							 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php
							   
						      $iciciinterestfortwoyr= (($perlacemifortwo * 2) - $iciciloan_amount);

							   $remingterm=$idbiterm - 2;
						     $icicigetinterestamt=(($iciciactualemi * $remingterm)- $iciciviewLoanAmt);

							  $totalinterestamt= ($iciciinterestfortwoyr + $icicigetinterestamt);
							 echo abs($totalinterestamt);?></td>
                        </tr>
                       
                       
                     
                     
               
					   <?php
						}
						  if($licemi>0 && $licinter>0 && $licloan_amount>0)
						{
							  ?>
							
                    <tr>
                          <td height="30" bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">LIC Bank</td>
						  <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; "><?php echo abs($licinter); ?> %</td>
                         <td bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $licemi; ?></td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; "><?php echo abs($licprint_term); ?> yrs.</td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo abs($licloan_amount); ?></td>
						   <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo abs($licviewLoanAmt); ?></td>
						    <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo abs($licperlacemi); ?></td>
						    <td bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                       
                       
                     
                   
						<?
						  }?>
						  </table></td>
                    </tr>
					<? }
						?>
                </table>			</td>
              </tr>
            </table></td>
            </tr>
            </table></td>
      </tr>
    </table></td></tr>
      
	  <tr>
	  <td height="5">&nbsp;</td>
	  </tr>
    </table>
</td>
  </tr>    </table><br />
<div align="left">Disclaimer: Please note that the interest rates given here are based on the particulars you have given here. Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.</div>
</div>	

<?php include '~Bottom-new.php';?>
</div>
</body>
</html>

