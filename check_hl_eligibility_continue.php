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
		//print_r($_POST);
		//Array ( [Name] => upendra [Phone] => 9971396361 [Email] => allproduct@ac.com [month] => 4 [day] => 4 [year] => 1973 [company_name] => gdgdfgddfffg [Employment_Status] => 1 [monthly_income] => 43433432 [obligations] => 3232 [loan_amount] => 2322121213 [co_appli] => 1 [co_name] => sddsasdasd [co_month] => 2 [co_day] => 18 [co_year] => 1970 [co_monthly_income] => 32332121 [co_obligations] => 23 [submit] => Submit ) 
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
	//echo	$obligations;
	//echo "<br>";
	$netAmount=($getnetAmount - $total_obligation);

		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		//echo  "dd".$DOB."<br>";
		
		//$details[]= $actualemi;
		
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm)=ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);

list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);

list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm)=IDBI_Homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);

list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm)=HDFC_Homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);

list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm)=Axis_Homeloan($getnetAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value);

//echo $idbiprint_term."<br>";
		
//echo "icicv: ".$print_term."<br>";
//echo "lic :".$licviewLoanAmt."<br>";
		
			
			
		//echo "<br>";
		$IP = getenv("REMOTE_ADDR");
		//echo "<br>";
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Phone'=>$Phone, 'Email'=>$Email, 'DOB'=>$dateofbirth, 'Company_Name'=>$company_name, 'Loan_Amt'=>$loan_amount, 'Employment_Status'=>$Employment_Status, 'Net_Salary'=>$monthly_income, 'Obligations'=>$obligations, 'Co_Name'=>$co_name, 'Co_DOB'=>$DOB_co, 'Co_Salary'=>$co_monthly_income, 'Co_Obligation'=>$co_obligations, 'emi'=>$emi, 'tenure'=>$print_term, 'roi'=>$inter, 'documents'=>'', 'Dated'=>$Dated, 'IP'=>$IP);
		$insertedID = Maininsertfunc ("home_loan_eligibility", $dataInsert);
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
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
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:5px solid #E9DCB4; background-color:#F4EFE0;">
  <tr>
    <td style="padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="150" height="55" align="center" valign="middle" ><img src="images/hl_logo.gif" width="140" height="45" /></td>
            <td width="420" align="left" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#3A0303; font-size:13px; text-decoration:none; font-weight:bold;	">Home Loans by choice not by chance!!</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="197" height="160" align="left" valign="top"><img src="images/headr_lft.jpg" width="197" height="160" /></td>
            <td width="175" align="left"><img src="images/header-mdl.jpg" width="175" height="160" /></td>
            <td width="208"><img src="images/hl_header_rgt.jpg" width="208" height="160" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td style="padding:5px 0px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            
                        <td width="303" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:5px 0px; background-color:#EFE6CB; border:3px solid #FFFFFF;">
				<form action="eligible-for-home-loan-thank.php" method="post" name="demoForm">

				<table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td height="40" align="center" valign="top" class="heading">Apply Home Loan </td>
                    </tr>
                  <!--   <tr>
                      <td class="text"><div style=" float:left; font-size:13px; font-weight:bold; color:#3A0303; font-family:Verdana, Arial, Helvetica, sans-serif;">Loan Amount</div><div style=" float:right; font-size:17px; font-weight:bold;   font-family:Arial, Helvetica, sans-serif;">
Rs.<input name="sliderValue1" id="sliderValue1h" type="text"  onChange="return showLoanAmt1(); A_SLIDERS[1].f_setValue(this.value); " style="border:none; font-size:17px; font-weight:bold; color:#3A0303; font-family:Arial, Helvetica, sans-serif; background-color:#efe6cb; width:82px; text-align:left;" onSelect="showLoanAmt();">
</div></td>
                    </tr>
                    <tr>
                      <td class="text"></td>
                    </tr>
                    <tr>
                      <td class="text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="25">&nbsp;</td>
                          <td><div style="float:left;">
<script language="JavaScript">
	var A_TPL1h = {
		'b_vertical' : false,
		'b_watch': true,
		'n_controlWidth': 234,
		'n_controlHeight': 19,
		'n_sliderWidth': 19,
		'n_sliderHeight': 19,
		'n_pathLeft' : -10,
		'n_pathTop' : 1,
		'n_pathLength' : 234,
		's_imgControl': 'images/sldr2h_bg.gif',
		's_imgSlider': 'images/sldr2h_sl.gif',
		'n_zIndex': 1
	}
	var A_INIT1h = {
	
		's_form' : 0,
		's_name': 'sliderValue1h',
		'n_minValue' : 500000,
		'n_maxValue' : <? echo $viewLoanAmt; ?>,
		'n_value' : 50,
		'n_step' : 100000
	}

	new slider(A_INIT1h, A_TPL1h);
</script>
</div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="text">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="text"><div style=" float:left; font-size:13px; font-weight:bold; color:#3A0303; font-family:Verdana, Arial, Helvetica, sans-serif;">Tenure</div><div style=" float:right; font-size:17px; font-weight:bold;   font-family:Arial, Helvetica, sans-serif;">
 <input name="sliderValue" id="sliderValue3h" type="Text"  onChange="A_SLIDERS[3].f_setValue(this.value)"  style="border:none; font-size:17px; font-weight:bold; color:#3A0303; font-family:Arial, Helvetica, sans-serif; background-color:#efe6cb; width:28px; text-align:left;" onSelect="showLoanAmt();">Years
</div></td>
                    </tr>
                    <tr>
                      <td class="text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="25">&nbsp;</td>
                          <td><div style="float:left;">
<script language="JavaScript">
	var A_TPL3h = {
		'b_vertical' : false,
		'b_watch': true,
		'n_controlWidth': 234,
		'n_controlHeight': 19,
		'n_sliderWidth': 19,
		'n_sliderHeight': 19,
		'n_pathLeft' : -10,
		'n_pathTop' : 1,
		'n_pathLength' : 234,
		's_imgControl': 'images/sldr2h_bg.gif',
		's_imgSlider': 'images/sldr2h_sl.gif',
		'n_zIndex': 1
	}
	var A_INIT3h = {
	
		's_form' : 0,
		's_name': 'sliderValue3h',
		'n_minValue' : 1,
		'n_maxValue' : <? echo $print_term; ?>,
		'n_value' : 50,
		'n_step' : 1
	}

	new slider(A_INIT3h, A_TPL3h);
</script>
</div></td>
                        </tr>
                        <tr>
                          <td colspan="2" height="5"></td>
                          </tr>
                      </table></td>
                    </tr> -->
                     <?php
					if($total_obligation>$netAmount)
					{
					?>
					 <tr>
                          <td  align="center" class="bldtxt" valign="top" height="200">Total Obligations is greater than Income.</td>
                        </tr>
					<?php
					}
					

					else
					{?>
					<tr>
                      <td class="text" width="100%" >
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="bldtxt">
                    <tr>
                          <td bgcolor="#FFFFFF">Bank Name</td>
						  <td bgcolor="#FFFFFF">Rate of Interest </td>
						  <td bgcolor="#FFFFFF">EMI(Per Month)</td>
						  <td bgcolor="#FFFFFF">Tenure</td>
						 <!-- <td bgcolor="#FFFFFF">Required Loan Amount</td>-->
						  <td bgcolor="#FFFFFF">Eligible Loan Amount</td>
						  <td bgcolor="#FFFFFF">EMI(Per Lac)</td>
						   <td bgcolor="#FFFFFF">Total Interest Amount</td>
</tr>
					<?
						if($iciciemi>0 && $iciciinter>0 && $iciciloan_amount>0)
						{
					?>
					
                    <tr>
                          <td >ICICI Bank</td>
						  <td><?php echo "8.25% (for first 2 yrs)".abs($iciciinter); ?> %</td>
                         <td >Rs. <?php echo $iciciemi; ?></td>
						 <td><?php echo abs($iciciprint_term); ?> yrs.</td>
						 <!--<td>Rs. <?php //echo abs($iciciloan_amount); ?></td>-->
						   <td>Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
						    <td>Rs. <?php echo $perlacemifortwo." (for first 2 yrs)".abs($iciciperlacemi); ?></td>
							 <td>Rs. <?php
							  // $iciciterm= $iciciterm*12;
						      $iciciinterestfortwoyr= (($perlacemifortwo * 24) );

							   $remingterm=$iciciterm - 24;
						     $icicigetinterestamt=(($iciciactualemi * $remingterm));

							  $icicitotalinterestamt= (($iciciinterestfortwoyr + $icicigetinterestamt) - $iciciviewLoanAmt);
							 echo abs($icicitotalinterestamt)."<br>";
							// echo ($iciciinterestfortwoyr + $icicigetinterestamt);?></td>
                        </tr>
                       
                       
                     
                     
                   <!--<tr><td>&nbsp;</td></tr>
				    <tr>
                      <td class="text"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="bldtxt">
                        <tr><td colspan="2">List of Required Documents</td></tr>
						<tr>
                          <td width="7%" height="25"><input type="checkbox" name="doc[]" value="salary slip"  style="border:none;"/></td>
                          <td width="93%" class="text" style="font-weight:normal;">Latest Salary slip</td>
                        </tr>
                        <tr>
                          <td height="25"><input type="checkbox" name="doc[]" value="form 16"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Form-16 of last financial year</td>
                        </tr>
                        <tr>
                          <td height="25" valign="top"><input type="checkbox" name="doc[]" value="bank statement"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Bank statement reflecting salary credits of six months </td>
                        </tr>
                        <tr>
                          <td height="25"><input type="checkbox" name="doc[]" value="appointment letter"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Appointment Letter</td>
                        </tr>
                        <tr>
                          <td height="25" valign="top"><input type="checkbox" name="doc[]" value="obligations"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Repayment track record of existing obligations</td>
                        </tr>
                        <tr>
                          <td height="25"><input type="checkbox" name="doc[]" value="ID Card"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Employee ID Card</td>
                        </tr>
						 <tr>
                          <td height="25" colspan="2" align="center">
						 
						  <input type="hidden" name="insertedID" value="<?php echo  $insertedID; ?>"  style="border:none;"/>
						  <input type="submit" name="final" value="Submit"  class="hlbtn" /></td>
                         </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>-->
					   <?php
						}
						  if($licemi>0 && $licinter>0 && $licloan_amount>0)
						{
							  ?>
							
                    <tr>
                          <td >LIC Bank</td>
						  <td><?php echo abs($licinter); ?> %</td>
                         <td >Rs. <?php echo $licemi; ?></td>
						 <td><?php echo abs($licprint_term); ?> yrs.</td>
						<!--<td>Rs. <?php //echo abs($licloan_amount); ?></td>-->
						   <td>Rs. <?php echo abs($licviewLoanAmt); ?></td>
						    <td>Rs. <?php echo abs($licperlacemi); ?></td>
							<td>Rs. <?php 
							//$licterm= $licterm;  
					
						   $licgetinterestamt=(($licemi * $licterm)); echo $licgetinterestamt; ?></td>
                        </tr>
                   
						<?
						  }
						  if($idbiemi>0 && $idbiinter>0 && $idbiloan_amount>0)
						{
							  ?>
							
                    <tr>
                          <td >IDBI Bank</td>
						  <td><?php echo "8%(Fixed for 2 yrs)".abs($idbiinter); ?> %</td>
                         <td >Rs. <?php echo $idbiemi; ?></td>
						 <td><?php echo abs($idbiprint_term); ?> yrs.</td>
						<!--<td>Rs. <?php //echo abs($idbiloan_amount); ?></td>-->
						   <td>Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
						   <td>Rs. <?php echo  $idbiperlacemifortwo."(Fixed For 2 yrs)".abs($idbiperlacemi); ?></td>
							<td>Rs. <?php 
							   //$idbiterm= $idbiterm;
							   $idbiinterestfortwoyr= ($idbiperlacemifortwo * 24);
							   $remingterm=$idbiterm - 24;
						   $idbigetinterestamt=($idbiactualemi * $remingterm); 
						   $idbitotalinterestamt= ( ($idbiinterestfortwoyr + $idbigetinterestamt) - $idbiviewLoanAmt);
						   echo abs($idbitotalinterestamt); ?></td>
                        </tr>
                   
						<?
						  }

						  if($hdfcemi>0 && $hdfcinter>0 && $hdfcloan_amount>0)
						{
							  ?>
							
                    <tr>
                          <td >HDFC Bank</td>
						  <td><?php echo "8.25%(Fixed for 2 yrs)".abs($hdfcinter); ?> %</td>
                         <td >Rs. <?php echo $hdfcemi; ?></td>
						 <td><?php echo abs($hdfcprint_term); ?> yrs.</td>
						<!--<td>Rs. <?php //echo abs($hdfcloan_amount); ?></td>-->
						   <td>Rs. <?php echo abs($hdfcviewLoanAmt); ?></td>
						   <td>Rs. <?php echo  $hdfcperlacemifortwo."(Fixed For 2 yrs)".abs($hdfcperlacemi); ?></td>
							<td>Rs. <?php 
							  // $hdfcterm = $hdfcterm *12;
							   $hdfcinterestfortwoyr= (($perlacemifortwo * 24));

							   $remingterm=$hdfcterm - 24;
						   $hdfcgetinterestamt=(($hdfcactualemi * $remingterm)); 
						   $hdfctotalinterestamt= (($hdfcinterestfortwoyr + $hdfcgetinterestamt) - $hdfcloan_amount);
						   echo abs($hdfctotalinterestamt); ?></td>
                        </tr>
                   
						<?
						  }

						 if($axisemi>0 && $axisinter>0 && $axisloan_amount>0)
						{
							  ?>
							
                    <tr>
                          <td >Axis Bank</td>
						  <td><?php echo "8%(Fixed for 1 yr)".abs($axisinter); ?> %</td>
                         <td >Rs. <?php echo $axisemi; ?></td>
						 <td><?php echo abs($axisprint_term); ?> yrs.</td>
						<!--<td>Rs. <?php //echo abs($axisloan_amount); ?></td>-->
						   <td>Rs. <?php echo abs($axisviewLoanAmt); ?></td>
						   <td>Rs. <?php echo  $axisperlacemifortwo."(Fixed For 1 yr)".abs($axisperlacemi); ?></td>
							<td>Rs. <?php 
							   ////$axisterm= $axisterm*12;
							   $axisinterestfortwoyr= ($axisperlacemifortwo * 12);

							   $axisremingterm=$axisterm - 12;
							   //echo $axisremingterm."<br>";
						   $axisgetinterestamt=(($axisactualemi * $axisremingterm)); 
						   $axistotalinterestamt= (($axisinterestfortwoyr + $axisgetinterestamt) - $axisloan_amount);
						   //echo ($axisinterestfortwoyr + $axisgetinterestamt)."<br>";
						   echo abs($axistotalinterestamt); ?></td>
                        </tr>
                   
						<?
						  }
						if($print_term=='' && $licloan_amount=='' && $idbiloan_amount=='' && $hdfcloan_amount=='' && $axisloan_amount=='')
						{ 
							?>
							<tr>
                          <td colspan="7" align="center">Not Eligible for Loan</td>
						 
                        </tr>
						<?}
						?>
						  <table>
</td>
                    </tr>
					<?}
						?>
                    <tr>
                      <td class="text">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="text">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="text">&nbsp;</td>
                    </tr>
                </table>
				</form></td>
              </tr>
            </table></td>
                </tr>
            </table></td>
          </tr>
        </table></td></tr>
      <tr>
        <td valign="top" style=" background-color:#EFE6CB; border:3px solid #FFFFFF; "><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="33" align="left" class="text"><b>Disclaimer:</b> Please note that the interest rates given here are based on the particulars you have given here. Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.</td>
            </tr>
        </table></td>
      </tr>
	  <tr>
	  <td height="5"></td>
	  </tr>
	  
    </table>
</td>
  </tr>

</body>
</html>
