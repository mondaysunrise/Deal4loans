<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_POST);
	if(isset($_POST['submit']) || $_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Name = $_POST["Name"];
		$hlrequestid = $_POST["hlrequestid"];
		$Existing_Bank= $_POST['Existing_Bank'];
		$Existing_Loan= $_POST['loan_amount'];		
		$Existing_ROI= $_POST['roi'];
		$Duration_of_Loan = $_POST['tenure'];
		$emi_paid = $_POST['emi_paid'];
		$pre_payment_charges = $_POST['pre_payment_charges'];

	if(strlen($Existing_Bank)>0 && $Existing_ROI>0 && $emi_paid>1)
	{
		$dataUpdate	= array('Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);
		$wherecondition = "(RequestID=".$hlrequestid.")";
		Mainupdatefunc ('Req_Loan_Home', $dataUpdate, $wherecondition);
	}
		$loan_amount= $_POST['loan_amount'];
		$Interest_Rate= $_POST['roi'];
		
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Home Loan Balance Transfer</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Home Loan Balance Transfer Calculator. Calculate home loan interest rate difference with latest interest rate policy">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"> 

<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/hlb_cal_continue.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true		
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
</script>

<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
<style>
.tblwt_txt {
    color: #1c50b0;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 13px;
    font-weight: bold;
    padding: 2px;
}
.tbl_txt {
    color: #373737;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 11px;
    padding: 2px;
}
#txt a {
    color: #1C50B0;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 11px;
    line-height: 15px;
    text-decoration: none;
}
#txt  a {
      text-decoration: none;
  }
#txt   a:link {
     color: #666666;
  }
#txt   a:visited {
      color: #666666;
  }
#txt   a:active {
      color: #666666;
  }
#txt   a:hover {
      color: #FF9900;
  }
</style>
<?php include "cl-form-js.php"; ?>
</head>
<body>
<div class="hide_top_section">
<!--top-->
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?></div>
<!--logo navigation-->

<div class="main_wrapper">
<div class="logo"><img src="images/logo.gif" width="243" height="90" /></div>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span class="text12" style="color:#4c4c4c;">Home Loan Balance Transfer Calculator</span></u></div>

<div class="hlb_title_conti_box" >
<h1 id="heading_text_continue" class="text3">Home Loan Balance Transfer Calculator</h1>
</div>
<div style="clear:both; height:5px;"></div>
<div style=" float:left; width:100%; height:auto; margin-top:15px; margin-left:2px; text-align:justify; padding-bottom:5px;">
 <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
          <tr>
            <td colspan="4" align="center" ></td>
	    </tr>
          <tr>
            <td colspan="4" valign="top" class="frmbldtxt"></td>
          </tr>
           <tr>
             <td  colspan="4" align="left" class="frmbldtxt"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top">
               <table width="100%"  border="0" cellpadding="2" cellspacing="2">
  <tr valign="middle">
    <td height="28" class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Dear <?php echo $Name ; ?>, </b></span></td>
    <td width="0" height="28" class="frmbldtxt"  style="padding-top:3px; ">&nbsp;</td>
  </tr>
</table><div style="clear:both;"></div>
                 <div class="box_one"><span class="frmbldtxt" style="padding-top:3px; "><b>Loan Amount Borrowed</b>:</span></div><div class="box_two"><span class="frmbldtxt" style="padding-top:3px; ">
Rs.<?php echo $loan_amount; ?>                     </span></div>
<div class="box_one"><span class="frmbldtxt" style="padding-top:3px; ">Tenure (in Years):</span></div>
<div class="box_two"><span class="frmbldtxt" style="padding-top:3px; ">
                       <?php echo $Duration_of_Loan; ?>
                     </span></div>
                     <div class="box_one"><span class="frmbldtxt" style="padding-top:3px; ">Present Rate Of Interest</span> :</div><div class="box_two"><span class="frmbldtxt" style="padding-top:3px; "><?php echo $Interest_Rate; ?>%
                     </span></div>
                     <div style="clear:both;"></div>
                     <div class="box_one"><span class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Pre Payment Charges</b></span> :</span></div><div class=" box_two"><span class="frmbldtxt" style="padding-top:3px; ">
<?php echo $pre_payment_charges; ?> %                    </span></div>
<div class="box_one"><span class="frmbldtxt" style="padding-top:3px; ">No. of EMI Paid :</span></div>
<div class=" box_two"><span class="frmbldtxt" style="padding-top:3px; "><?php echo $emi_paid ; ?>
                     </span></div>
                     <div class="box_one"><span class="frmbldtxt" style="padding-top:3px; ">Existing Bank : </span></div>
                     <div class="box_two"><span class="frmbldtxt" style="padding-top:3px; "><?php echo $Existing_Bank ; ?></span></div>
                 
                 </td>
               </tr>
             </table></td>
           </tr>
         
		    
          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
</div>
	<br />
    
    <?php
   if(isset($_POST['submit']) || $_SERVER['REQUEST_METHOD'] == 'POST')
	{
	
		?>
	
	<?php
//	print_r($_POST);
//echo "<br>";	
	$getBankIDSql = "SELECT * FROM Bank_Master where Bank_Name='".$Existing_Bank."'";
	list($alreadyExist,$getBankIDQuery)=MainselectfuncNew($getBankIDSql,$array = array());
	$myrowcontr=count($getBankIDQuery)-1;
	$getBankID = $getBankIDQuery[$myrowcontr]['BankID'];
		
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
  <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#d5cfb1" class="font22">      
        <tr>
	    <td width="17%" align="center" bgcolor="#88a943" class="font22"  style="color:#FFFFFF;">EMI of Existing Loan</td>
	    <td width="31%" align="center" bgcolor="#88a943" class="font22"  style="color:#FFFFFF;">Total Amount to be Paid in <?php echo $Duration_of_Loan; ?> Years</td>
	    <td width="29%" align="center" bgcolor="#88a943" class="font22"  style="color:#FFFFFF;">Additional Amount to be Paid</td>
		  <td width="23%" align="center" bgcolor="#88a943" class="font22"  style="color:#FFFFFF;">Principal  OutStanding</td>
	  </tr>
  <tr>
      <?php
      	echo " <td bgcolor='#FFFFFF' align='center' class='font22' height='30'>Rs.".round($EMI_show)."/-</td>";

	$totalAmtPaid = ($EMI * $Duration_of_Loan * 12);
	$totalAmtPaid_show = round($totalAmtPaid);
	echo "<td bgcolor='#FFFFFF' align='center' class='font22' >Rs.".$totalAmtPaid_show."/-</td>";
	
	$excessAmount = $totalAmtPaid - $loan_amount;
	
	$excessAmount_show = round($excessAmount);
	echo "<td bgcolor='#FFFFFF' align='center' class='font22'>Rs.".$excessAmount_show."/-</td>";		



	//$new_EMItoPay = $totalAmountRepaid * ($new_intr / (1 - (pow(1/(1+$new_intr), $newDuration))));
	//$processingFee = $totalAmountRepaid * ($processing_fee /100);
	echo "<td bgcolor='#FFFFFF' align='center' class='font22' >Rs.".round($loan_amount_today)."/-</td>";	
    ?>
</tr>
</table>
        <?php
		//if($getRates_NR>0)
		//{
		?>
       <br />
         <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#d5cfb1" class="font22">
        <tr>
             <td height="20" align="center" bgcolor="#88a943"  style="color:#FFFFFF;" class="font22">Bank</td>
            <td align="center" bgcolor="#88a943"  style="color:#FFFFFF;"  class="font22">New Interest Rate Available</td>
            <td align="center" bgcolor="#88a943"  style="color:#FFFFFF;"  class="font22">Current Loan Amount</td>
            <td align="center" bgcolor="#88a943"  style="color:#FFFFFF;"  class="font22">New EMI</td>
            <td align="center" bgcolor="#88a943"  style="color:#FFFFFF;"  class="font22" >Duration</td>
            <td align="center" bgcolor="#88a943"  style="color:#FFFFFF;"  class="font22" >Amount Saved</td>            
        
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
                <td height="25" align="center" bgcolor="#FFFFFF" class="font22">
				<div class="hideImg"><img src="<?php echo $bank_image; ?>" border="0" /><br /></div>
				<?php echo $bank ;  ?></td>
                <td align="center" bgcolor="#FFFFFF" class="font22"><?php echo $roi; ?>%</td>
                <td align="center" bgcolor="#FFFFFF" class="font22">Rs.<?php echo $totalAmountRepaid;
                ?>&nbsp;&nbsp;&nbsp;</td>
                 <td align="center" bgcolor="#FFFFFF" class="font22">Rs.<?php echo round($new_EMItoPay,2);
                ?>&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#FFFFFF" align="center" class="font22"><?php echo "".$newDuration." months";  ?></td>
                  <td align="center" bgcolor="#FFFFFF" class="font22">
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
				  
                &nbsp;&nbsp;&nbsp;</td>
               
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


<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1" class="font22">
<tr><td>


  <div style=" float:left; width:100%; height:auto; margin-top:15px;  text-align:justify;">
  <span class="text11" style="color:#4c4c4c; ">      <b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.  </span>
</div></td></tr></table>
</div>

<div class="hide_top_section">
<?php include "footer1.php"; ?></div>

</body>
</html>