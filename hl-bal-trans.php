<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	if(isset($_POST['submit']))
	{
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Balance Transfer</title>
<meta name="description" content="Home Loan Balance Transfer Calculator. Calculate home loan interest rate difference with latest interest rate policy">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">
function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}

function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function check_form(Form)
{

var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
//var i;
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if((Form.Name.value=="") || (Trim(Form.Name.value))==false)
	{
		alert("Please fill your Full Name.");
		Form.Name.focus();
		return false;
	}
	  
    if (Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}
	
	 if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  Form.Phone.focus();
			  return false;  
		}
        if (Form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.Phone.focus();
				return false;
        }
        if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 Form.Phone.focus();
                return false;
        }
	
		if(Form.Email.value=="")
		{
			alert("Please fill your Email.");
			Form.Email.focus();
			return false;
		}
		if(Form.Email.value!="")
		{
			if (!validmail(Form.Email.value))
			{
				//alert("Please enter your valid email address!");
				Form.Email.focus();
				return false;
			}
			
		}
	
	if(Form.loan_amount.value=="")
	{
		alert('Please enter loan_amount');
		Form.loan_amount.focus();
		return false;
	}
if(Form.tenure.selectedIndex==0)
	{
		alert('plz select tenure');
		Form.tenure.focus();
		return false;
	}	
	if(Form.roi.value=="")
	{
		alert('Please enter Rate of Interest');
		Form.roi.focus();
		return false;
	}
	
	
	if(Form.pre_payment_charges.value=="")
	{
		alert('Please enter Pre-Payment Charges');
		Form.pre_payment_charges.focus();
		return false;
	}
	if(Form.emi_paid.value=="")
	{
		alert('Please enter Pre-Payment Charges');
		Form.emi_paid.focus();
		return false;
	}
	if (Form.Existing_Bank.value=="")
	{
		alert("Please enter Existing Bank.");
		Form.Existing_Bank.focus();
		return false;
	}	
		
	
}



</script>
  <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style>
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:149px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
</style>


</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > Home Loan Balance Transfer Calculator </span>
  <div id="lftbar" style="padding-top:15px; width:100%; ">
  
<!--<form name="loancalc" id="loancalc" method="post" action="hl-bal-trans-continue.php" onSubmit="return check_form(document.loancalc);" > -->
<form name="loancalc" id="loancalc" method="post" action="hl-bal-trans-continue.php" onSubmit="return check_form(document.loancalc);" >

 <input type="hidden" name="source" value="Balance Transfer Calc">
              <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
          <tr>
            <td colspan="4" align="center" ></td>
	    </tr>
          
          <tr>
            <td colspan="4" style="padding:12px;" ><table width="392" border="0" align="center" cellpadding="0" cellspacing="0">
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
                     <td width="19%" height="28" class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Full Name</b></span> :</td>
                     <td width="15%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text"  name="Name" id="Name" style="width:120px; font-weight:bold; font-size:11px; color:#373737;" maxlength="30" value="<?php echo $Name; ?>" /></td>
                     <td width="19%" height="28" class="frmbldtxt" style="padding-top:3px; "><b>City :</b></td>
                     <td width="16%" height="28" class="frmbldtxt"  style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; ">
                       <select name="City" id="City" style="width:120px;   font-size:11px; color:#373737;">
                        <?=getCityList($City)?>
                       </select>
                     </span></td>
                     <td width="16%" height="28" class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Mobile</b></span> :</td>
                     <td width="15%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);insertData();" style="width:120px; font-weight:bold; font-size:11px; color:#373737;" value="<?php echo $Phone; ?>" /></td>
                   </tr>
                <tr valign="middle">
                     <td height="28" class="frmbldtxt"><span class="formtext"><b>Email</b></span> :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="Email" id="Email" style="width:120px; font-weight:bold; font-size:11px; color:#373737;" value="<?php echo $Email; ?>" /></td>
                     <td height="28" align="left" class="frmbldtxt"><span class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Loan Amount Borrowed</b></span> :</span></td>
                     <td height="28" class="frmbldtxt"><span class="frmbldtxt" style="padding-top:3px; ">
                       <input type="text" name="loan_amount" id="loan_amount" style="width:120px; font-weight:bold; font-size:11px; color:#373737;" maxlength="30" value="<?php echo $loan_amount; ?>" />
                     </span></td>
                    <td width="16%" height="28" class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Tenure (in Years)</b></span> :</span></td>
                     <td width="15%" height="28" class="frmbldtxt"  style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; ">
                       <select name="tenure" id="tenure" style="width:120px;   font-size:11px; color:#373737;">
                         <option value="">Please Select</option>
                         <?php 
		   for($i=5;$i<=25;$i++)
		   {
		   		$selected = "";
				if($i==$Duration_of_Loan)
				{
					$selected = "selected";
				}	
		   		echo "<option value='".$i."' ".$selected." >".$i."</option>";
		   }
		   ?>
                       </select>
                     </span></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="28" class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><b>Present Rate Of Interest </b>:</span></span></td>
                     <td width="15%" height="28" class="frmbldtxt"  style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; ">
                       <input type="text" name="roi" id="roi" style="width:120px; font-weight:bold; font-size:11px; color:#373737;" value="<?php echo $Interest_Rate; ?>" />
                     </span></td>
                     <td width="19%" height="28" class="frmbldtxt" style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; "><span class="formtext"><b>Pre Payment Charges</b></span> :</span></td>
                     <td width="16%" height="28" class="frmbldtxt"  style="padding-top:3px; "><span class="frmbldtxt" style="padding-top:3px; ">
                       <input type="text" name="pre_payment_charges" id="pre_payment_charges" style="width:100px; font-weight:bold; font-size:11px; color:#373737;" value="<?php echo $pre_payment_charges; ?>" />
                     %</span></td>
                     <td width="16%" height="28" class="frmbldtxt" style="padding-top:3px; ">No. of EMI Paid :</td>
                     <td width="15%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="emi_paid" style="width:120px; font-weight:bold; font-size:11px; color:#373737;" maxlength="5" value="<?php echo $emi_paid ; ?>" /></td>
                   </tr>
                   
                     <tr valign="middle">
                     <td height="28" class="frmbldtxt">Name of Existing Bank :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="Existing_Bank"  id="Existing_Bank" style="width:120px; font-weight:bold; font-size:11px; color:#373737;" tabindex="13"  onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="getstatementlink();" onclick="getstatementlink();" /></td>
                     <td height="28" align="left" class="frmbldtxt">&nbsp;</td>
                     <td height="28" class="frmbldtxt">&nbsp;</td>
                     <td width="16%" height="28" class="frmbldtxt" style="padding-top:3px; ">&nbsp;</td>
                     <td width="15%" height="28" class="frmbldtxt"  style="padding-top:3px; "><span class="formtext" style="font-weight:normal;">
                       <input name="submit" type="submit" class="btnclr"  value="Calculate" />
                     </span></td>
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
</form>
	<br />
    
    <?php
   if(isset($_POST['submit']))
	{
	
		?>
	
	<?php
//	print_r($_POST);
//echo "<br>";	
		$loan_amount = $_POST['loan_amount'];
		$Interest_Rate = $_POST['roi'];
		$Duration_of_Loan = $_POST['tenure'];
		$emi_paid = $_POST['emi_paid'];
		$pre_payment_charges = $_POST['pre_payment_charges'];		
		$totalMonths = $Duration_of_Loan *12;

		$tenure_left = round((($totalMonths - $emi_paid)/12),1);

		 $emi_start_date = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")-$Duration_of_Loan));
		
		//$emi_start_date = date("Y F", mktime(0, 0, 0, $explode_start_date[1]+$i , date("d"), $explode_start_date[0]));
		
		
		$intr =  $Interest_Rate / 1200;
		$new_intr =  $new_emi / 1200;
		$month = $Duration_of_Loan * 12;
		$EMI = $loan_amount * ($intr / (1 - (pow(1/(1+$intr), $month))));
		$EMI_show = round($EMI,2);
		$explode_start_date = explode("-", $emi_start_date);		
	
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
		}
		
		$getRatesSql = "select * from home_loan_bal_trans where ((".$loan_amount_today." between min_amount and max_amount) and (".$tenure_left." between min_tenure and max_tenure) and status=1)";
		 list($getRates_NR,$getrow)=MainselectfuncNew($getRatesSql,$array = array());
		$cntr=0;
		
		//$getRatesQuery = ExecQuery($getRatesSql);
		//$getRates_NR = mysql_num_rows($getRatesQuery);
		
		?>
  <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#d5cfb1" class="txtbl">      
        <tr>
	    <td width="17%" align="center" bgcolor="#494949" class="txtbl"  style="color:#FFFFFF;"><b>EMI of Existing Loan </b></td>
	    <td width="31%" align="center" bgcolor="#494949" class="txtbl"  style="color:#FFFFFF;"><b>Total Amount to be Paid in <?php echo $Duration_of_Loan; ?> Years </b></td>
	    <td width="29%" align="center" bgcolor="#494949" class="txtbl"  style="color:#FFFFFF;"><b>Additional Amount to be Paid</b></td>
		  <td width="23%" align="center" bgcolor="#494949" class="txtbl"  style="color:#FFFFFF;"><b>Total Amount O/S</b></td>
	  </tr>
  <tr>
      <?php
      	echo " <td bgcolor='#FFFFFF' align='center' class='txtbl' style='font-weight:bold;'  height='30'>Rs.".$EMI_show."/-</td>";

	$totalAmtPaid = ($EMI * $Duration_of_Loan * 12);
	$totalAmtPaid_show = round($totalAmtPaid,2);
	echo "<td bgcolor='#FFFFFF' align='center' class='txtbl' style='font-weight:bold;'>Rs.".$totalAmtPaid_show."/-</td>";
	
	$excessAmount = $totalAmtPaid - $loan_amount;
	
	$excessAmount_show = round($excessAmount,2);
	echo "<td bgcolor='#FFFFFF' align='center' class='txtbl' style='font-weight:bold;'>Rs.".$excessAmount_show."/-</td>";		



	//$new_EMItoPay = $totalAmountRepaid * ($new_intr / (1 - (pow(1/(1+$new_intr), $newDuration))));
	//$processingFee = $totalAmountRepaid * ($processing_fee /100);
	echo "<td bgcolor='#FFFFFF' align='center' class='txtbl' style='font-weight:bold;'>Rs.".$loan_amount_today."/-</td>";	
    ?>
</tr>
</table>
        <?php
		if($getRates_NR>0)
		{
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
			
	$totalPaid = $EMI_show * $emiCount;
			$totaloutStanding = $totalAmtPaid_show - $totalPaid;	
		
			$PrePayment_Charges = round(($loan_amount_today * ($pre_payment_charges/100)),2);
			
			$totalAmount_Repaid = round(($loan_amount_today + $PrePayment_Charges),2);
		//	echo "<br>";
			//	echo $totalAmount_Repaid;
							
			$periodLeft = $totalMonths - $emiCount ; 
			$periodLeftYears = round(($periodLeft/12),2);
			$newDuration = $periodLeftYears * 12;
			$newDuration = $periodLeft;
//			echo "<br>Duration :";
	//			echo $newDuration;
			$totalAmountRepaid = '';	
			while($cntr<count($getrow))
        	{
	//
		//		echo "<br>-------------------------------<br>";
				$bal_id = $getrow[$cntr]['bal_id'];
				$bank = $getrow[$cntr]['bank'];
				$bank_id = $getrow[$cntr]['bank_id'];
				$roi = $getrow[$cntr]['roi'];
				$processing_fee = $getrow[$cntr]['processing_fee'];
				$fee_amount = $getrow[$cntr]['fee_amount'];
				$fee_percent = $getrow[$cntr]['fee_percent'];
				$bank_image = $getrow[$cntr]['bank_image'];
					
					$intr =  $roi / 1200;
												
				if($fee_amount>0)
				{
					if($fee_percent>0)
					{
						$PrePaymentCharges = round(($totalAmountRepaid * ($fee_percent/100)),2);
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
						$PrePaymentCharges = round(($totalAmountRepaid * ($fee_percent/100)),2);						
					}
					else
					{
						$PrePaymentCharges = $fee_amount;
					}
				}
				//echo "<br>PrePaymentCharges: ";
				//echo $PrePaymentCharges;
				$totalAmountRepaid = '';
				$totalAmountRepaid = round(($totalAmount_Repaid + $PrePaymentCharges),2);
				//echo "<br>";
			//	echo $totalAmountRepaid;
				//echo "<br>";
				//echo $roi;
				//echo "<br>";
			//	echo $newDuration;
				//echo "<br>";
				 $new_EMItoPay = round(($totalAmountRepaid * ($intr / (1 - (pow(1/(1+$intr), $newDuration))))),2);
				//$new_EMItoPay = $totalAmountRepaid * ($roi / (1 - (pow(1/(1+$roi), $newDuration))));
			//	echo "<br>";
			//	echo $new_EMItoPay;
								
				$new_Debt = round(($periodLeftYears * 12 * $new_EMItoPay),2);	
				$newDebt = $processingFee + $new_Debt; 
				$savedAmt = $totaloutStanding - $PrePaymentCharges - $newDebt;
				
				
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
                <td bgcolor="#FFFFFF" align="center" class="txtbl"><?php echo "<b>".$periodLeftYears." years</b> [ ".$newDuration." months ]";  ?></td>
                  <td align="center" bgcolor="#FFFFFF" class="txtbl"><b>Rs.<?php echo round($savedAmt);
                ?>&nbsp;&nbsp;&nbsp;</b></td>
               
			</tr>
  
                <?php
			 $cntr=$cntr+1;}
			?>
             </table>
            <?php
		}
		else
		{
		?>
        	<div align="center" style="font-weight:bold; padding:8px;">Balance Transfer will not be a good option for you</div>
            
         <?php   
		}
	}
	?>
   
    <br />
    </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?> </div> 
</body>
</html>
</html>