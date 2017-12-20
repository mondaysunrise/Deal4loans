<?php
require 'scripts/db_init.php';
	require 'scripts/functions.php';
//error_reporting ( E_ALL );

	session_start();
//print_r($_POST);
	$name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$city = $_POST['city'];
	$process = $_POST['redeemProcess'];
	$source = "SBI-Redemption";
	$card_type_cc = $_POST['card_type_cc'];				
	$card_type_dc = $_POST['card_type_dc'];
	$Accidental_Insurance =$_POST['Accidental_Insurance'];
$IP = getenv("REMOTE_ADDR");


	if(strlen($name)>0 && strlen($email)>0 && strlen($mobile)>0 && strlen($city)>0)
	{
		
		$Dated = ExactServerdate();
		$dataInsert = array('name'=>$name, 'email'=>$email, 'mobile'=>$mobile, 'city'=>$city, 'ccholder_bank'=>'SBI', 'source'=>$source, 'accidental_insurance'=>$Accidental_Insurance, 'mailer_dated'=>$Dated, 'mailerip'=>$IP, 'url'=>$url);
		$last_id = Maininsertfunc ('store_records_redemption', $dataInsert);
  		
		if($process == "Redemption Process")
		{
			$message = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Dear $name</b>,<br />

			 Thank you for on Deal4loans.com for SBI Redemption.<br />

     <h2>SBI Card Redemption Process</h2>
                 	   <p>Every time when you shop with your card you get reward points. </p>
<p>Check your latest card statement if you have build up at least 1000 reward points, you can redeem the reward points against various gifts available in the catalogue.</p>

<p>You can call on SBI Card help line 39020202. BSNL/MTNL users can dial <br />
1860 180 1290 | 1800 180 1290.<br />
or<br />
You can write to SBI at <br />
P.O. Box No. 28,<br />
GPO, New Delhi 110001<br />
SBI will deliver your gifts at your doorstep!</p>
<br>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a></div></td>
          </tr>
		  <tr><td height='110' valign='middle'><a href='http://www.deal4loans.com/earn-credit-card.php?source=plAM' target='_blank'><img src='http://www.deal4loans.com/images/crdt-bann-mlr.gif' width='550' height='101' border='0'/></a></td>
		  </tr>
        </table></td>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
      </tr>
    </table></td>
  </tr>
  <tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>

  </tr>
</table>";
	
	
			
		}
		else if($process =="Redemption")
		{
			//show the redeem points chart
		}
		
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			$SubjectLine = "Learn to get Best Deal on Credit Card";
			$Email = "ranjana@deal4loans.com";
			mail($Email, $SubjectLine, $message, $headers);
				
	}
	else
	{
		//echo "<script language=javascript>"." location.href='earn-credit-card1.php'"."</script>";	
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SBI Cards</title>
<meta name="keywords" content="Credit Card, Card, offers, credit card schemes, credit card offers, reward points, discounts, Cash back offers, save money, ICICI credit card, SBI credit card, HDFC Credit card, Citibank credit card, HSBC credit card, Barclays credit card, compare cards, Deal4loans">
<meta name="Description" content="Check credit card offers of last months. Credit card offers Achieve at deal4loans.com.">
<META content="INDEX, FOLLOW" name=ROBOTS>
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 
<div id="container">

    <table width="725" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
        <td  >&nbsp;</td>
      </tr>
      <tr>
        <td width="100%" height="58" align="center" background="images/ccfrm-tp.gif" style="color:#07468c; font-family:verdana; font-weight:bold; font-size:13px;">Thanks for registering yourself with Deal4loans.com for SBI Card Redemption.</td>
    </tr>
      
      <tr>
        
        <td valign="top" align="center" bgcolor="#f6fcff" style="border:5px solid #a2d7f6; border-bottom:none; border-top:none;"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0"  >
          
          <tr>
            <td align="center" valign="middle" class="bldtxt"><table width="600" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#d3ecf8">
              <tr>
                <td width="273" height="22" bgcolor="#f6fcff" class="bldtxt">Name</td>
                    <td width="316" bgcolor="#f6fcff">
                    <input type="text" name="name" style="width:225px; border:none; font-size:11px; font-weight:bold; color:#07468C;" maxlength="30" value="<?php echo $name;?>" readonly /></td>
                  </tr>
              <tr>
                <td height="22" bgcolor="#f6fcff" class="bldtxt">Mobile</td>
                    <td valign="middle" bgcolor="#f6fcff" class="bldtxt" style="font-weight:bold; ">+ 91<input type="text" name="mobile" style="width:105px; border:none; font-size:11px; font-weight:bold; color:#07468C;" value="<?php echo $mobile;?>" maxlength="10" /></td>
                  </tr>
              <tr>
                <td height="22" bgcolor="#f6fcff" class="bldtxt">Email Id </td>
                    <td bgcolor="#f6fcff"><input type="text" name="email" style="width:225px; border:none; font-size:11px; font-weight:bold; color:#07468C;" maxlength="30" value="<?php echo $email;?>" readonly /></td>
                  </tr>
              <tr>
                <td height="22" bgcolor="#f6fcff" class="bldtxt">City</td>
                    <td bgcolor="#f6fcff"><input type="text" name="city" style="width:225px; border:none; font-size:11px; font-weight:bold; color:#07468C;" maxlength="30" value="<?php echo $city;?>" readonly /></td>
                  </tr>
              </table></td>
                    </tr>
					<tr><td>
				 <h2>&nbsp;</h2>
				 <h2>SBI Card Redemption Process</h2>
				 <p>Every time when you shop with your card you get reward points. </p>
<p>Check your latest card statement if you have build up at least 1000 reward points, you can redeem the reward points against various gifts available in the catalogue.</p>

<p>You can call on SBI Card help line 39020202. BSNL/MTNL users can dial <br />
1860 180 1290 | 1800 180 1290.<br />
or<br />
You can write to SBI at <br />
P.O. Box No. 28,<br />
GPO, New Delhi 110001<br />
SBI will deliver your gifts at your doorstep!</p>
				</td></tr>
        </table></td>
                </tr>
				
      <tr>
        <td height="22" align="center" valign="top" bgcolor="#f6fcff"><img src="images/ccfrm-bt.gif" width="725" height="22"></td>
                </tr>
      
      </table>
 <?php include '~Bottom-new1.php';?>
  </div>
  </body>
</html>

