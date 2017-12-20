<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	if(isset($_POST['submit']))
	{
	//print_r($_POST);
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$City = $_POST['City'];
		$Type_Loan = "Req_Loan_Home";
		$IP = getenv("REMOTE_ADDR");
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
			
		$Existing_Bank= $_POST['Existing_Bank'];
		$Existing_Loan= $_POST['loan_amount'];
		$Existing_ROI= $_POST['roi'];	
			
		$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		//	echo $getdetails."<br>";
			//exit();
				list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
		
			if($alreadyExist>0)
			{
				$ProductValue=$myrow[$myrowcontr]['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
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
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance,Property_Identified,Employment_Status,DOB,  	  Property_Loc,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income,Co_Applicant_Obligation,Property_Value, Total_Obligation, Edelweiss_Compaign, Pincode,Existing_ROI, Existing_Loan, Existing_Bank ) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$loan_amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(), '$Accidental_Insurance', '$Property_Identified', '$Employment_Status', '$dateofbirth', '$Property_Loc', '$co_name', '$DOB_co', '$co_monthly_income', '$co_obligations', '$property_value', '$obligations','".$edelweiss."' , '".$Pincode."', '".$Existing_ROI."', '".$Existing_Loan."', '".$Existing_Bank."' )"; 

				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>$Employment_Status, 'DOB'=>$DOB, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);

			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$dataUserInsert = array('Email'=>$Email,'FName'=>$Name,'Phone'=>$Phone,'Join_Date'=>$Dated,'IsPublic'=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $dataUserInsert);

				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>$Employment_Status, 'DOB'=>$DOB, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);
		//		echo "<br>else".$InsertProductSql;
			}
			
		//	echo $InsertProductSql."<br>";
			//exit();
		//	$InsertProductQuery = ExecQuery($InsertProductSql);
		//	$ProductValue = mysql_insert_id();
	/*
			if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}

			list($First,$Last) = split('[ ]', $Name);

			
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan";
			
			if(strlen(trim($Phone)) > 0)
			{
//				//SendSMS($SMSMessage, $Phone);
	//			NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			}
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$FName=$Name;
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				//mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			*/
			}
		
		
		$loan_amount = $_POST['loan_amount'];
		$Interest_Rate = $_POST['roi'];
		$Duration_of_Loan = $_POST['tenure'];
		$emi_paid = $_POST['emi_paid'];
		$pre_payment_charges = $_POST['pre_payment_charges'];		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Home Loan Balance Transfer</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Home Loan Balance Transfer Calculator. Calculate home loan interest rate difference with latest interest rate policy">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > Home Loan Balance Transfer Calculator </span>
  <div id="lftbar" style="padding-top:15px; width:100%; ">
              <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
          <tr>
            <td colspan="4" align="center" ></td>
	    </tr>
          
          <tr>
            <td colspan="4" style="padding:2px;" ><table width="392" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Home Loan Balance Transfer Calculator </h1></td>
  </tr>
</table></td>
</tr>

          <tr>
            <td colspan="4" valign="top" class="frmbldtxt"></td>
          </tr>
           <tr>
             <td  colspan="4" align="left" class="frmbldtxt"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="2">
                  <tr valign="middle">
                     <td height="28" colspan="2" class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Dear <?php echo $Name ; ?>, </b></span></td>
                     <td width="20%" height="28" class="frmbldtxt" style="padding-top:3px; ">&nbsp;</td>
                     <td width="12%" height="28" class="frmbldtxt"  style="padding-top:3px; ">&nbsp;</td>
                     <td width="21%" height="28" class="frmbldtxt" style="padding-top:3px; ">&nbsp;</td>
                     <td width="14%" height="28" class="frmbldtxt"  style="padding-top:3px; ">&nbsp;</td>
                  </tr>
                <tr valign="middle">
                     <td height="28" class="frmbldtxt"><span class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Loan Amount Borrowed</b></span> :</span></td>
                     <td height="28" class="frmbldtxt"><span class="frmbldtxt" style="padding-top:3px; ">
Rs.<?php echo $loan_amount; ?>                     </span></td>
                     <td height="28" align="left" class="frmbldtxt"><span class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Tenure (in Years)</b></span> :</span></span></td>
                     <td height="28" class="frmbldtxt"><span class="frmbldtxt" style="padding-top:3px; ">
                       <?php echo $Duration_of_Loan; ?>
                     </span></td>
                    <td width="21%" height="28" class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><b>Present Rate Of Interest </b>:</span></span></span></td>
                     <td width="14%" height="28" class="frmbldtxt"  style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><?php echo $Interest_Rate; ?>%
                     </span></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="28" class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Pre Payment Charges</b></span> :</span></span></td>
                     <td width="14%" height="28" class="frmbldtxt"  style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; ">
<?php echo $pre_payment_charges; ?> %                    </span></td>
                     <td width="20%" height="28" class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; ">No. of EMI Paid :</span></td>
                     <td width="12%" height="28" class="frmbldtxt"  style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><?php echo $emi_paid ; ?>
                     </span></td>
                     <td width="21%" height="28" class="frmbldtxt" style="padding-top:3px; ">Existing Bank : </td>
                     <td width="14%" height="28" class="frmbldtxt"  style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><?php echo $Existing_Bank ; ?></span></td>
                   </tr>
                 </table></td>
               </tr>
             </table></td>
           </tr>
         
		    
          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>

	<br />
    
    <?php
   if(isset($_POST['submit']))
	{
	
		?>
	
	<?php
//	print_r($_POST);
//echo "<br>";	
	$getBankIDSql = "SELECT * FROM Bank_Master where Bank_Name='".$Existing_Bank."'";
	list($alreadyExist,$getBankIDQuery)=MainselectfuncNew($getBankIDSql,$array = array());
	$getBankIDQuerycontr=count($getBankIDQuery)-1;
	$getBankID = $getBankIDQuery[$getBankIDQuerycontr]["BankID"];

		$loan_amount = $_POST['loan_amount'];
		$Interest_Rate = $_POST['roi'];
		$Duration_of_Loan = $_POST['tenure'];
		$emi_paid = $_POST['emi_paid'];
		$pre_payment_charges = $_POST['pre_payment_charges'];		
		$totalMonths = $Duration_of_Loan *12;

		$tenure_left = round((($totalMonths - $emi_paid)/12),1);

		  $emi_start_date = date("Y-m-d", mktime(0, 0, 0, date("m")-$emi_paid , date("d"), date("Y")));
		//echo "<br>";
		//$emi_start_date = date("Y F", mktime(0, 0, 0, $explode_start_date[1]+$i , date("d"), $explode_start_date[0]));
		
		
		$intr =  $Interest_Rate / 1200;
		$old_intr =  $Interest_Rate;
		$month = $Duration_of_Loan * 12;
		$EMI = $loan_amount * ($intr / (1 - (pow(1/(1+$intr), $month))));
		$EMI_show = round($EMI);
		$explode_start_date = explode("-", $emi_start_date);		
	    $emiCount = '';
		for($i=0;$i<=$emi_paid;$i++)
		{
			$bgcolor = "";
			$showDate = date("Y F", mktime(0, 0, 0, $explode_start_date[1]+$i , date("d"), $explode_start_date[0]));
			$today = date("Y F");
			$interest = $loan_amount * $intr; 
			$interest = round($interest,2);
			$principal = $EMI - $interest;
			$principal = round($principal,2);
			$loan_amount = $loan_amount - $principal;
			$loan_amount = round($loan_amount,2);
			$emiCount = $i + 1;
			$showDate_today = $showDate;
			$interest_today = $interest;
			$principal_today = $principal;
			$loan_amount_today = $loan_amount;
				//	echo "<b>".$showDate."</b>----".$emiCount."</b>----".$loan_amount_today."<br>";
		}
		
		$getRatesSql = "select * from home_loan_bal_trans where (('".$loan_amount_today."' between min_amount and max_amount) and ('".$tenure_left."' between min_tenure and max_tenure) and 	bank_id!='".$getBankID."' and status=1)";
				
		list($getRates_NR,$getRatesQuery)=MainselectfuncNew($getRatesSql,$array = array());
		
	
	//echo 	"<br>".$getRatesSql;	
		?>
  <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#d5cfb1" class="txtbl">      
        <tr>
	    <td width="17%" align="center" bgcolor="#494949" class="txtbl"  style="color:#FFFFFF;"><b>EMI of Existing Loan </b></td>
	    <td width="31%" align="center" bgcolor="#494949" class="txtbl"  style="color:#FFFFFF;"><b>Total Amount to be Paid in <?php echo $Duration_of_Loan; ?> Years </b></td>
	    <td width="29%" align="center" bgcolor="#494949" class="txtbl"  style="color:#FFFFFF;"><b>Additional Amount to be Paid</b></td>
		  <td width="23%" align="center" bgcolor="#494949" class="txtbl"  style="color:#FFFFFF;"><b>Principal  OutStanding</b></td>
	  </tr>
  <tr>
      <?php
      	echo " <td bgcolor='#FFFFFF' align='center' class='txtbl' style='font-weight:bold;'  height='30'>Rs.".round($EMI_show)."/-</td>";

	$totalAmtPaid = ($EMI * $Duration_of_Loan * 12);
	$totalAmtPaid_show = round($totalAmtPaid);
	echo "<td bgcolor='#FFFFFF' align='center' class='txtbl' style='font-weight:bold;'>Rs.".$totalAmtPaid_show."/-</td>";
	
	$excessAmount = $totalAmtPaid - $loan_amount;
	
	$excessAmount_show = round($excessAmount);
	echo "<td bgcolor='#FFFFFF' align='center' class='txtbl' style='font-weight:bold;'>Rs.".$excessAmount_show."/-</td>";		



	//$new_EMItoPay = $totalAmountRepaid * ($new_intr / (1 - (pow(1/(1+$new_intr), $newDuration))));
	//$processingFee = $totalAmountRepaid * ($processing_fee /100);
	echo "<td bgcolor='#FFFFFF' align='center' class='txtbl' style='font-weight:bold;'>Rs.".round($loan_amount_today)."/-</td>";	
    ?>
</tr>
</table>
        <?php
		//if($getRates_NR>0)
		//{
		?>
       <br />
         <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#d5cfb1" class="txtbl">
        <tr>
             <td height="20" align="center" bgcolor="#494949"  style="color:#FFFFFF;" class="txtbl"><b>Bank</b></td>
            <td align="center" bgcolor="#494949"  style="color:#FFFFFF;"  class="txtbl"><b>New Interest Rate Available </b></td>
            <td align="center" bgcolor="#494949"  style="color:#FFFFFF;"  class="txtbl"><b>Current Loan Amount</b></td>
            <td align="center" bgcolor="#494949"  style="color:#FFFFFF;"  class="txtbl"><b>New EMI</b></td>
            <td align="center" bgcolor="#494949"  style="color:#FFFFFF;"  class="txtbl" ><b>Duration</b></td>
            <td align="center" bgcolor="#494949"  style="color:#FFFFFF;"  class="txtbl" ><b>Amount Saved</b></td>            
        
        </tr>
        <?php
			

		
			$PrePayment_Charges = round(($loan_amount_today * ($pre_payment_charges/100)));
			
//			$totalAmount_Repaid = round(($loan_amount_today + $PrePayment_Charges));
			$totalAmount_Repaid = round(($loan_amount_today));
		//	echo "<br>";
			//	echo $totalAmount_Repaid;
							
			$periodLeft = $totalMonths - $emiCount ; 
		//	$periodLeftYears = round(($periodLeft/12),2);
			
			//$newDuration = $periodLeftYears * 12;
			
			$newDuration  = ($Duration_of_Loan * 12) - $emi_paid;
				//$newDuration = $periodLeft;
				$periodLeftYears = round(($newDuration/12),2);
				
				
			//$totalPaid = $EMI_show * $emiCount;
			$totalPaid = $EMI_show * $newDuration;
			//$totaloutStanding = $totalAmtPaid_show - $totalPaid;	
			$totaloutStanding = $totalPaid;
		//	echo "<br>totaloutStanding : ";
		//	echo $totaloutStanding;	
		//		
		//	echo "<br>Duration :";
			//	echo $newDuration;
				
			$processingFee = round(($totalAmount_Repaid * ($pre_payment_charges/100)));
			//	echo "<br>PrePaymentCharges : ";
			//	echo $processingFee;
			
			$totalAmountRepaid = '';	
			
			
			for($i=0;$i<$getRates_NR;$i++)
			{
				$intr = '';
			//	echo "<br>-------------------------------<br>";
				$bal_id = $getRatesQuery[$i]['bal_id'];
				$bank = $getRatesQuery[$i]['bank'];
				$bank_id = $getRatesQuery[$i]['bank_id'];
				$roi = $getRatesQuery[$i]['roi'];
				$processing_fee = $getRatesQuery[$i]['processing_fee'];
				$fee_amount = $getRatesQuery[$i]['fee_amount'];
				$fee_percent = $getRatesQuery[$i]['fee_percent'];
				$bank_image = $getRatesQuery[$i]['bank_image'];
		/*		echo "<br>---------------<br>";
				echo $bank;
				echo "----------";

				echo $fee_amount;
				echo "----------";
				echo $fee_percent;
				echo "<br>---------------<br>";	
			*/
					$intr =  $roi / 1200;
												
				if($fee_amount>0)
				{
					
					if($fee_percent>0)
					{
						$PrePaymentCharges = round(($totalAmountRepaid * ($fee_percent/100)));
						if($PrePaymentCharges<$fee_amount)
						{
							$PrePaymentCharges = $fee_amount;
						}
						
					}
					else
					{
						$PrePaymentCharges = $fee_amount;
					}
				}
				else
				{
					if($fee_percent>0)
					{
					//	echo "fd:".$fee_percent;	
						$PrePaymentCharges = round(($totalAmountRepaid * ($fee_percent/100)));						
					}
					else
					{
						$PrePaymentCharges = $fee_amount;
					}
				}
			//	echo "<br>Processing Fee: ";
			//	echo $PrePaymentCharges;
				$totalAmountRepaid = '';
				//$totalAmountRepaid = round(($totalAmount_Repaid + $PrePaymentCharges),2);
				$totalAmountRepaid = $totalAmount_Repaid;
				//echo "<br>";
				//echo $totalAmountRepaid;
				//echo "<br>";
				//echo $roi;
				//echo "<br>newDuration: ";
				//echo $newDuration;
				//echo "<br>";
				 $new_EMItoPay = round(($totalAmountRepaid * ($intr / (1 - (pow(1/(1+$intr), $newDuration))))));
				//$new_EMItoPay = $totalAmountRepaid * ($roi / (1 - (pow(1/(1+$roi), $newDuration))));
			//	echo "<br>";
			//	echo $new_EMItoPay;
								
				$new_Debt = round(($newDuration * $new_EMItoPay));	
				
				
				
				$newDebt = $new_Debt; 
				/*
				echo "<br>newDebt: ";
				echo $newDebt;
				
				echo "<br>Processing Fee: ";
				echo $PrePaymentCharges;
				echo "<br>PrePaymentCharges: ";
				echo $processingFee;
				echo "<br>totaloutStanding: ";
				echo $totaloutStanding;
					*/	
				
				$savedAmt = $totaloutStanding - $PrePaymentCharges - $processingFee - $newDebt;
				
				
							//	echo "<br>-------------------------------<br>";
				?>
             <tr >
                <td height="25" align="center" bgcolor="#FFFFFF" class="txtbl">
				<img src="<?php echo $bank_image; ?>" border="0" /><br />
				<strong><?php echo $bank ;  ?></strong> <?php //echo $bal_id; ?></td>
                <td align="center" bgcolor="#FFFFFF" class="txtbl"><b><?php echo $roi; ?>%</b></td>
                <td align="center" bgcolor="#FFFFFF" class="txtbl"><b>Rs.<?php echo $totalAmountRepaid;
                ?>&nbsp;&nbsp;&nbsp;</b></td>
                 <td align="center" bgcolor="#FFFFFF" class="txtbl"><b>Rs.<?php echo round($new_EMItoPay,2);
                ?>&nbsp;&nbsp;&nbsp;</b></td>
                <td bgcolor="#FFFFFF" align="center" class="txtbl"><?php echo "<b>".$newDuration." months </b>";  ?></td>
                  <td align="center" bgcolor="#FFFFFF" class="txtbl"><b>
                  <?php if($savedAmt>0)
				  {
				  	echo "Rs.".round($savedAmt);				  
				  }
                  else
				  {
				  ?>
				  	<span style="color:#CC0033;">
                    <?php echo " - Rs.".abs(round($savedAmt)); ?>
                    </span>
				  <?php
                  }
                  ?>
				  
                &nbsp;&nbsp;&nbsp;</b></td>
               
			</tr>
  
                <?php
			}
			?>
             </table>
            <?php
	//	}
		//else
		//{
		?>
        	<!--<div align="center" style="font-weight:bold; padding:8px;">Balance Transfer will not be a good option for you</div> -->
            
         <?php   
		//}
	}
	?>
   
    <br />
      <b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.  
<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="new-images/top.gif"/></a></div>
    </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?></div> 
</body>
</html>
</html>