<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
//print_r($_POST);
//echo "<br>/////////////--------------------///////////////////////<br>";
//print_r($_SERVER);
//print_r($_REQUEST);
//exit();


$R_URL='debt-consolidation-plans.php';
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 10 URL=".$R_URL);
	}


	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
			foreach($_POST as $a=>$b)
				$$a=$b;
				
			//$DataSubmited = FixString($DataSubmited);
			$custName = FixString($custName);
			$custEmail = FixString($custEmail);
			$custCity = FixString($custCity);
			$custEmployment_Status = FixString($custEmployment_Status);
			$dob = FixString($dob);
			$custPhone = FixString($custPhone);
			$custEarningMembers = FixString($custEarningMembers);
			$custDependants = FixString($custDependants);
			
			$HeskID = FixString($HeskID);
			$custNet_Salary = FixString($custNet_Salary);
			$Assets_Property = FixString($Assets_Property);
			$Assets_Vechile = FixString($Assets_Vechile);
			$Assets_Others = FixString($Assets_Others);
			
			$Type_Loan_1 = FixString($Type_Loan_1);
			$pl_loanamount_1 = FixString($pl_loanamount_1);
			$pl_tenure_1 = FixString($pl_tenure_1);			
			$pl_emi_1 = FixString($pl_emi_1);
			$pl_roi_1 = FixString($pl_roi_1);
			$pl_emipaid_1 = FixString($pl_emipaid_1);

			//Arrays
			$Type_Loan = $_POST['Type_Loan'];
			$pl_loanamount = $_POST['pl_loanamount'];
			$pl_tenure = $_POST['pl_tenure'];			
			$pl_emi = $_POST['pl_emi'];
			$pl_roi = $_POST['pl_roi'];
			$pl_emipaid = $_POST['pl_emipaid'];
						
			$card_due_payment_1 = FixString($card_due_payment_1);
			$card_name_1 = FixString($card_name_1);

			//Arrays
			$card_due_payment = $_POST['card_due_payment'];
			$card_name = $_POST['card_name'];
			if($custEmployment_Status==1){$employ_stat="Salaried";}else{$employ_stat="Self Employed";}
			$custQuery = FixString($custQuery);			
			$Content = "";
			
						 
			$Content .= "<br>City: ".$custCity;
			$Content .= "<br>Employement Status: ".$employ_stat;
			$Content .= "<br>Date of Birth: ".$dob;
			$Content .= "<br>Phone: ".$custPhone;
			$Content .= "<br>Earning Members: ".$custEarningMembers;
			$Content .= "<br>Dependants: ".$custDependants;
			
			$Content .= "<br>Net Salary: Rs. ".$custNet_Salary;
			$Content .= "<br><strong>Assets</strong>";
			$Content .= "<br>Property: ".$Assets_Property;
			$Content .= "<br>Vehicle: ".$Assets_Vechile;
			$Content .= "<br>Other Assets: ".$Assets_Others;
			
			if(strlen($pl_loanamount_1)>0)
			{
				$Content .= "<br><strong>Loan Details</strong>";
				$Content .= "<br>Loan Type: ".$Type_Loan_1;
				$Content .= "<br>Loan Amount: Rs. ".$pl_loanamount_1;
				$Content .= "<br>Tenure: ".$pl_tenure_1;
				$Content .= "<br>Emi: ".$pl_emi_1;
				$Content .= "<br>ROI: ".$pl_roi_1;
				$Content .= "<br>Emi Paid: ".$pl_emipaid_1."<br>";
			}
			
			//print_r($Type_Loan);
			
			if(count($pl_loanamount)>0)
			{
				for($i=0;$i<count($pl_loanamount);$i++)
				{
			
					$Content .= "<br>Loan Type: ".$Type_Loan[$i];
					$Content .= "<br>Loan Amount: Rs. ".$pl_loanamount[$i];
					$Content .= "<br>Tenure: ".$pl_tenure[$i];
					$Content .= "<br>Emi: ".$pl_emi[$i];
					$Content .= "<br>ROI: ".$pl_roi[$i];
					$Content .= "<br>Emi Paid: ".$pl_emipaid[$i]."<br>";
				}
			}
			
			if(strlen($card_name_1)>0)
			{
				$Content .= "<br><strong>Card Details</strong>";
				$Content .= "<br>Payment Due Status: ".$card_due_payment_1;
				$Content .= "<br>Outstanding on Card: ".$card_name_1."<br>";
			}						
/*echo "<br>/////////////--------------------///////////////////////<br>";		
					print_r($card_due_payment);
					print_r($card_name);
					
			echo "<br>/////////////--------------------///////////////////////<br>";		
	*/		
			if(count($card_name)>0)
			{
				for($z=0;$z<count($card_name);$z++)
				{
					//echo "<br>Payment Due Status: ".$card_due_payment[$z]."ghgfhgghgfg<br>";
					$Content .= "<br>Payment Due Status: ".$card_due_payment[$z];
					$Content .= "<br>Outstanding on Card: ".$card_name[$z]."<br>";
				}
			}
			
			$Content .= "<br>Query: ".$custQuery;
			
			//echo $Content;
			//echo "<br><br>";
			
		//	$updateSql = "update hesk_tickets set message = '".$Content."', view_message = '".$Content."' where id=".$HeskID;
			
			$DataArray = array("message" =>$Content, "view_message" =>$Content);
			$wherecondition ="id=".$HeskID;
			Mainupdatefunc ('hesk_tickets', $DataArray, $wherecondition);
			
			
			//$updateQuery = ExecQuery($updateSql);
			
				$headers = 'From: '.$custName.' <'.$custEmail.'>' . "\r\n";
				$headers .= "Return-Path: <".$From_Email.">\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'Bcc: mehra3@gmail.com' . "\r\n";
				$to = 'amitoj.sethi@gmail.com';
				//mail($to, "Debt Consolidation", $Content, $headers);
			
			/*echo "<script language=javascript>alert(' your request has been forwarded to our Loan Expert and you will recieve a personalized Debt Consolidation plan on your email id as per our records. ');"." location.href='debt-consolidation-plans.php'"."</script>";*/
	
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Ask Amitoj Loan Queries | Loan Guru | Debt Consolidation| Deal4loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
 <meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="Debt Consolidation Solutions, Ask Amitoj, Loan Guru, Deal4loans Guru, Loan Queries">
<meta name="description" content="Get loan advice, loan eligibility and EMI calculators and other tips for your car, personal loans & credit card from experts on Deal4loans.com." />
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
   <div id="txt">
  <br />
<br />
<br />
<br />

  <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; line-height:25px; color:#333333; text-align:center;">your request has been forwarded to our Loan Expert and you will recieve a personalized<br />
 Debt Consolidation plan on your email id as per our records.</div>
<br />
<br />
	

 </div>
 
<? if(!isset($_SESSION['UserType'])) 
  {
 // include '~Right-new1.php';
  }
  ?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>




