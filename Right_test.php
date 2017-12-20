<?php
ob_start();
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

function getforvsms($pKey){
    $titles = array(
        'Req_Loan_Personal' => '1',
        'Req_Loan_Home' => '2',
        'Req_Loan_Car' => '3',
        'Req_Credit_Card' => '4',
        'Req_Loan_Against_Property' => '5',
        'Req_Business_Loan' => '6',
		'Req_Loan_Gold' => '7',
		'Req_Loan_Education' => '8'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}

$Msg = "";
$Item_ID = "";
if($_SESSION['UserType']== "bidder")
{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
}
function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'car_loan_quickapply.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'loan_against_property_continue2.php',
		'Req_Business_Loan' => 'Req_Business_Loan_New.php',
		'Req_Loan_Gold' => 'thank-apply-gold-loans.php',
		'Req_Loan_Education' => 'thank-apply-education-loans.php'
	
	);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;
	return "";
}
	
function isValidEmail_1($email){ 
     $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"; 

     if (eregi($pattern, $email)){ 
        return true; 
     } 
     else { 
        return false; 
     }    
} 	
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

foreach($_POST as $a=>$b)
		$$a=$b;
	$Type_Loan = FixString($Type_Loan);
	$fullname = FixString($fullname);
	$mobile = FixString($mobile);
	$email_id = FixString($email_id);
	$source = FixString($source);
	$city = FixString($city);
	$net_salary = FixString($net_salary);
	$Referred_Page = FixString($Referred_Page);
	$accept = FixString($accept);
	$Dated = ExactServerdate();
	$IP = getenv("REMOTE_ADDR");
		$IP= $_SERVER['HTTP_X_REAL_IP'];

	if($source=="QuickApplyNew")
	{
	// code for check server side validation
	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$_SESSION['captcha_msg'] = "<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.
		echo '<script>window.history.go(-1);</script>';
	}
	}	

	$_SESSION['Temp_Name'] = $fullname;
	$_SESSION['Temp_mobile'] = $mobile;
	$_SESSION['Temp_email'] = $email_id;
	$_SESSION['Temp_loan_type'] = $Type_Loan;
	$_SESSION['Temp_city'] = $city;
	$_SESSION['Temp_net_salary'] = $net_salary;

	$validMobile = is_numeric($mobile);
	$validEmail = isValidEmail($email_id);
//	Array ( [Type_Loan] => Req_Credit_Card [source] => SEO_D4L_CC_Delhi [fullname] => upendra [mobile] => 9971396361 [email_id] => askupendra@gmail.como [city] => Delhi [net_salary] => 450000 [accept] => on )
	/*
	if((strlen($fullname)>0) && ($validMobile==1) && ($validEmail==1) && (strlen($Type_Loan)>0))
	{
	print_r($_POST);


}
else
{
	echo strlen($fullname)."---".$validMobile."---".$validEmail."----".strlen($Type_Loan);
}
die();*/	

	if((strlen($fullname)>0) && ($validMobile==1) && ($validEmail==1) && (strlen($Type_Loan)>0))
	{

		if($Referred_Page=="CampaignBanner")
		{
		
		$dataInsert = array("Name"=>$fullname, "Contact"=>$mobile, "Email"=>$email_id, "Product_Type"=>$Type_Loan, "Referred_Page"=>$Referred_Page, "Source"=>$source, "Dated"=>$Dated);
$table = 'Req_Apply_Here';
$insert = Maininsertfunc ($table, $dataInsert);	
		
		}
		if(($Type_Loan=="Req_Loan_Car") || ($Type_Loan=="Req_Loan_Personal")  || ($Type_Loan=="Req_Loan_Home") || ($Type_Loan=="Req_Loan_Against_Property") || $Type_Loan=="Req_Loan_Education" || $Type_Loan=="Req_Loan_Gold")
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number not in (9971396361,9811215138,9999570210,9555060388) and Mobile_Number='".$mobile."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	//echo $getdetails."<br>";
	//exit();	
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$cntr=0;
	if($alreadyExist>0)
	{
		$ProductValue=$myrow[$cntr]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;

		if($Type_Loan=="Req_Loan_Car")
		{
		echo "<script language=javascript>"." location.href='update-car-loan-lead.php'"."</script>";
		}
		else if($Type_Loan=="Req_Loan_Personal")
		{
			echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";
		}
		else if($Type_Loan=="Req_Loan_Home")
		{
			echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
		}
		
		else if($Type_Loan=="Req_Loan_Against_Property")
		{
			echo "<script language=javascript>"." location.href='update-property-loan-lead.php'"."</script>";
		}
		else if($Type_Loan=="Req_Loan_Education")
		{
			echo "<script language=javascript>"." location.href='update-education-loan-lead.php'"."</script>";
		}
		else if($Type_Loan=="Req_Loan_Gold")
		{
			echo "<script language=javascript>"." location.href='update-gold-loan-lead.php'"."</script>";
		}
	}
	else
	{
			$CheckSql = "select UserID from wUsers where Email = '".$email_id."'";
			list($CheckNumRows,$wUserrow)=MainselectfuncNew($CheckSql,$array = array());
			$w=0;
			if($CheckNumRows>0)
			{
				$UserID = $wUserrow[$w]['UserID'];
				if($Type_Loan=="Req_Loan_Education")
				{
					
			$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Mobile_Number"=>$mobile, "Residence_City"=>$city, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Net_Salary"=>$net_salary, "Privacy"=>$accept);
			$table = $Type_Loan;
				
				}
				else
				{			
				$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Mobile_Number"=>$mobile, "City"=>$city, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Net_Salary"=>$net_salary, "Employment_Status"=>'1', "IsPublic"=>$accept, "Privacy"=>$accept);
$table = $Type_Loan;				
				}
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$dataInsert1 = array("Email"=>$email_id, "FName"=>$fullname, "Phone"=>$mobile, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
			$table1 = 'wUsers';
			$UserID = Maininsertfunc ($table1, $dataInsert1);
			  
				if($Type_Loan=="Req_Loan_Education")
				{
					$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Mobile_Number"=>$mobile, "Residence_City"=>$city, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Net_Salary"=>$net_salary, "Privacy"=>$accept);
$table = $Type_Loan;
				}
				else
				{
				
				$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Mobile_Number"=>$mobile, "City"=>$city, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Net_Salary"=>$net_salary, "Employment_Status"=>'1', "IsPublic"=>$accept, "Privacy"=>$accept);
$table = $Type_Loan;
				
				}
				//echo "<br>else".$InsertProductSql;
			}
			
				 //Send SMS
			ProductSendSMStoRegis($mobile);
			
		//	echo "<br> ".$InsertProductSql;
			$last_inserted_id = Maininsertfunc ($table, $dataInsert);
			list($First,$Last) = split('[ ]', $fullname);
			//exit();
if($Type_Loan=="Req_Loan_Car")
		{
			$SMSprMessage = "Dear $First,Thanks for applying at Deal4loans for Car loan. ";
			
		}
		else if($Type_Loan=="Req_Loan_Personal")
		{
			$SMSprMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan. ";
		}
		else if($Type_Loan=="Req_Loan_Home")
		{
			$SMSprMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan. ";
		}
		$product_code=getforvsms($Type_Loan);

if((strlen(trim($mobile)) > 0) && strlen($SMSprMessage)>0)
	NewAir2webSendSMS($SMSprMessage, $mobile, $product_code , $last_inserted_id);
				//SendSMS($SMSprMessage, $mobile);
				$_SESSION['Temp_Last_Inserted'] = $last_inserted_id;

		if(strlen($Type_Loan)>0)
		{
		echo "<script language=javascript>location.href='".getTransferURL($Type_Loan)."?source=".$source."'"."</script>";
		}
		else
			{
			echo "<script language=javascript>location.href='index.php?source=".$source."'"."</script>";
		} 
	}//else
		}
		else
		{		
			/*************************************************************************************/
			$CheckSql = "select UserID from wUsers where Email = '".$email_id."'";
			 list($CheckNumRows,$getwUrow)=MainselectfuncNew($CheckSql,$array = array());
			$wu=0;
			
			
			if($CheckNumRows>0)
			{
				$UserID = $getwUrow[$wu]['UserID'];
				if($Type_Loan=="Req_Credit_Card")
				{
					$table="Req_Credit_Card";				
			
					$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Mobile_Number"=>$mobile, "City"=>$city, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Net_Salary"=>$net_salary, "Employment_Status"=>'1', "DOB"=>'1987-06-03', "Privacy"=>$accept);
$table = $Type_Loan;
				}
				else
				{
					$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Mobile_Number"=>$mobile, "Residence_City"=>$city, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Net_Salary"=>$net_salary, "Employment_Status"=>'1', "Privacy"=>$accept);
$table = $Type_Loan;
				}
				
			}
			else
			{
				$dataInsert2 = array("Email"=>$email_id, "FName"=>$fullname, "Phone"=>$mobile, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table2 = 'wUsers';
				$UserID = Maininsertfunc ($table2, $dataInsert2);
				if($Type_Loan=="Req_Credit_Card")
				{
					$table="Req_Credit_Card";
					$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Mobile_Number"=>$mobile, "City"=>$city, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Net_Salary"=>$net_salary, "Employment_Status"=>'1', "DOB"=>'1987-06-03', "Privacy"=>$accept);
$table = $Type_Loan;
				}
				else
				{
					$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Mobile_Number"=>$mobile, "Residence_City"=>$city, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Net_Salary"=>$net_salary, "Employment_Status"=>'1', "Privacy"=>$accept);
$table = $Type_Loan;
		
				}
				//echo "<br>else".$InsertProductSql;
			}
				echo "Line No. 295";
echo "Table - ".$table."<br>";
print_r($dataInsert);
			//	die();
				//echo "<br>242 -  ".$InsertProductSql;
			$last_inserted_id = Maininsertfunc ($table, $dataInsert);
			$_SESSION['Temp_LID'] = $last_inserted_id;
			list($First,$Last) = split('[ ]', $fullname);
			
				echo "Line No. 295";
			die();
			//exit();
			/***********************************************************************************/
		if($Type_Loan=="Req_Credit_Card")
		{
			$subject="Compare - Apply Credit Cards in 2 Minutes";
		
$message="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
<tr>
<td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td width='174' height='185'><img src='http://www.deal4loans.com/emailer/cc-mailer09/hdr-lft.gif' width='174' height='185' /></td>
<td width='187' height='185'><img src='http://www.deal4loans.com/emailer/cc-mailer09/hdr-mdl.gif' width='187' height='185' /></td>
<td width='199' height='185'><img src='http://www.deal4loans.com/emailer/cc-mailer09/hdr-rgt.gif' width='199' height='185' /></td>
</tr>
</table></td>
</tr>
<tr>
<td bgcolor='#3680b9'><table width='558' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>
<tr>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-align:justify; color:#032241;'><table width='546' border='0' align='center' cellpadding='0' cellspacing='0'>
<tr bgcolor='#FFFFFF'>
<td height='58' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; line-height:14px;'>Comparing and applying for Credit Cards is as easy as 1-2-3.Just compare features, rewards from 8 Credit cards listed below and choose your type of Credit Card. Apply directly at Banks and keep your information secure !!!</td>
</tr>
<tr bgcolor='#FFFFFF'>
<td style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:justify; color:#032241;'>At different stages of life our wishes differ, and with the  time our requirements as well. Requirements also differ from individual to  individuals. To get the most out from a credit cards, its best to start out on  the right foot. Before going for a Credit Card, we need to check that where we are  using our card the most; it&rsquo;s either on shopping, on traveling, on dinning, on  entertainment or on petrol.</td>
</tr>
<tr bgcolor='#FFFFFF'>
<td height='50' valign='middle' style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;    text-align:justify; color:#032241; font-weight:bold;'>To apply online for a Credit Card, you need to spend 2 minutes of yours and need to keep your Pan Card Number ready.So no more hassles of filling long Application forms or walking in the branch to get the Credit Card.</td>
</tr>
<tr bgcolor='#FFFFFF'>
<td height='38' bgcolor='#FFFFFF' style='font-family:Verdana, Arial, Helvetica, sans-serif;  font-size:11px; font-weight:bold; text-align:justify; color:#032241;'>At Deal4loans you can apply for a Credit Card according to  your need. Check the features and apply accordingly.</td>
</tr>
<tr bgcolor='#FFFFFF'>
<td  ><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
<tr>
<td>"; 
 if($last_inserted_id>0 && $net_salary>=300000)
  {
$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$city."%' and cc_bank_flag=1) order by cc_bank_fee ASC";
	
 list($rowscount,$row)=MainselectfuncNew($selectccbanks,$array = array());
		$cc=0;
if($rowscount >0)
{
  $message.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> <table  border='1' cellspacing='0' cellpadding='0'>
		<tr>
		<td width='47' height='40' bgcolor='#197ad6' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;' >Name</td>
		<td  width='45' height='40'bgcolor='#197ad6' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;' >Age</td>
		<td width='50' height='40'bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;'>Fee</td>
		<td width='230' height='40'bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;' >Features</td>
		<td  width='60' height='40' bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;' >Interest Rates</td>
		<td  width='85' height='40'bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;'  >&nbsp;</td>			  </tr>";
   
	while($cc<count($row))
        {
        $cc_bank_query  = $row[$cc]['cc_bank_query'];
		$cc_bankid  = $row[$cc]['cc_bankid'];
		$cc_bank_url  = $row[$cc]['cc_bank_url'];
		 $qry2 = $cc_bank_query.' and Req_Credit_Card.RequestID ='.$last_inserted_id;
		  list($recordcount,$getrow)=MainselectfuncNew($qry2,$array = array());
      
		if($recordcount>0)
		 {
		 	$i=0;
			while($i<count($getrow))
       		 {
			$get_Bank='Select * From credit_card_banks_eligibility Where cc_bankid='.$cc_bankid.' order by cc_bank_fee ASC';
			 list($recordcccount,$myrow)=MainselectfuncNew($get_Bank,$array = array());			    
			
				$ccb = 0;
		while($ccb<count($myrow))
       		 {
			  if($myrow[$ccb]['cc_bank_fee']==0)
			 {
				  $cardfee="free";
			 }
			 else
			 {
				$cardfee=$myrow[$ccb]['cc_bank_fee'];
			 }

if($cc_bankid==10 || $cc_bankid==16 || $cc_bankid==15)
			 {
	 $newcc_bank_url='http://www.deal4loans.com/apply-hdfc-credit-card.php?RequestID='.$last_inserted_id.'&cc_bankid='.$cc_bankid;
			 }
			 else
			 {
				 $newcc_bank_url=$cc_bank_url;
			 }
			 $message.=" <tr>
			  <td  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' ><a href='".$newcc_bank_url."' target='_blank'>".$myrow[$ccb]['cc_bank_name']."</a></td>
			  <td  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; padding-left:5px;' >".$myrow[$ccb]['cc_bank_age']."</td>
			  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; text-align:center;' >".$cardfee."</td>
			  <td valign='top' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$myrow[$ccb]['cc_bank_features']."</td>
			  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; padding-left:5px;' >". $myrow[$ccb]['cc_bank_rates']."</td>";
			  if($cc_bankid==13)
			 { 
				$message.="<td   align='center' style='font-size:11px; text-align:center;font-weight:bold; '> <form action='http://www.deal4loans.com/standard_chartered_cc_vemail.php' method='POST' >
				  <input type='hidden' value=".$last_inserted_id." name='Temp_ID' id='Temp_ID'>
				  <input type='image' value='' name='submit' src='http://www.deal4loans.com/new-images/apl-yelo.gif'  width='87' height='25' border='0' ></form></td>
			  </tr>";
			  			  
			  }
			  else if ($cc_bankid==10 || $cc_bankid==16 || $cc_bankid==15)
			 { 
				 $message.="<td   align='center' style='font-size:11px; text-align:center;font-weight:bold; '> <form action='http://www.deal4loans.com/apply-hdfc-credit-card.php' method='POST' target='_blank' >
				 <input type='hidden' name='cc_bankid' id='cc_bankid' value=".$cc_bankid.">
		    <input type='hidden' name='RequestID' id='RequestID' value=".$last_inserted_id.">
			 <input type='image' value='' name='submit' src='http://www.deal4loans.com/new-images/apl-yelo.gif'  width='87' height='25' border='0' >
					</form></td>
			  </tr>";
			}
			  else
			 {
			       $message.="<td   align='center' style='font-size:11px; text-align:center;font-weight:bold; '><a href='".$cc_bank_url."' target='_blank' ><img src='http://www.deal4loans.com/new-images/apl-yelo.gif' style='text-decoration:none; border:none; '></a></td>
			  </tr>";
 } 
			
			  $ccb = $ccb +1; }
			 $i = $i +1;  }    
	  }
	$cc = $cc +1;}
	 $message.="</table></td></tr>";
	 $message.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
			  If you havent applied them,Click on the above links to apply for your set of Credit Cards.It will Just take two minutes to apply for your Credit card.Just make sure you have your Pan card number handy with you.<br><br></td></tr>";
	  }
  } $message.="</td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td width='560' height='22'><img src='http://www.deal4loans.com/emailer/cc-mailer09/crd-btmline.gif' width='560' height='22' /></td>
</tr>
</table>";
 if($last_inserted_id>0 && $net_salary>=300000 && $rowscount>0)
			{
$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'Bcc: extra4testingnew@gmail.com' . "\r\n";
mail($email_id,$subject, $message, $headers);
			}

 			//$SMSMessage = "Thanks for ur application@ Credit Cards.Choose your type of Credit Card. Get your Pan number handy.Offers are in ur mail also.Apply now";
			$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the offers have been sent to your email.Keep your Pan Number handy when you apply.";
					if(strlen(trim($mobile)) > 0)
					{
						SendSMS($SMSMessage, $mobile);
					}
						$filename = "eligible-for-credit-card.php?id=".$last_inserted_id;
						header("Location: $filename");
						exit();   
		}
		elseif($Type_Loan=="Req_Loan_Personal")
		{
			
			$SMSprMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan.";
			
		}
		elseif($Type_Loan=="Req_Loan_Home")
		{			
			$SMSprMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan.";			
		}
		elseif($Type_Loan=="Req_Loan_Car")
		{
			$SMSprMessage = "Dear $First,Thanks for applying at Deal4loans for Car loan.";				
		}
		elseif($Type_Loan=="Req_Business_Loan")
		{
			$SMSprMessage = "Dear $First,Thanks for applying at Deal4loans for Business loan.";				
		}
		elseif($Type_Loan=="Req_Loan_Against_Property")
		{
			$SMSprMessage = "Dear $First,Thanks for applying at Deal4loans for LAP.";				
		}
$product_code=getforvsms($Type_Loan);

if((strlen(trim($mobile)) > 0) && strlen($SMSprMessage)>0)
		NewAir2webSendSMS($SMSprMessage, $mobile, $product_code , $last_inserted_id);
		
		$_SESSION['Temp_Last_Inserted'] = $last_inserted_id;

		if(strlen($Type_Loan)>0)
		{
		echo "<script language=javascript>location.href='".getTransferURL($Type_Loan)."?source=".$source."'"."</script>";
		}
		else
			{
			echo "<script language=javascript>location.href='index.php?source=".$source."'"."</script>";
		}
	}
	}
	else if(($validMobile!=1) || ($validEmail!=1))
	{
		header("Location: index.php");
	}
	else
			{
		//	echo "...";
		if(strlen($Type_Loan)>0)
				{
			echo "<script language=javascript>location.href='".getTransferURL($Type_Loan)."?source=".$source."'"."</script>";
				}
				else {
						echo "<script language=javascript>location.href='index.php?source=".$source."'"."</script>";
				}
		}	
		}
?>