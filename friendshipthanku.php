<?php
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	session_start();

	$msg = "Thank You, Your mail had been sent Successfully to your FRIENDS!!!!";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

		$owner_name = $_REQUEST['owner_name'];
		$friend_name = $_REQUEST['friend_name'];
		$friend_name1 = $_REQUEST['friend_name1'];
		$friend_name2 = $_REQUEST['friend_name2'];
		$friend_email = $_REQUEST['friend_email'];
		$friend_email1 = $_REQUEST['friend_email1'];
		$friend_email2 = $_REQUEST['friend_email2'];
		
		
		$Message = "<table width='600' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#056DB6'>  <tr>    <td height='113' align='left' valign='top' colspan='2'><table width='100%' border='0' cellpadding='0' cellspacing='0'>      <tr>        <td align='left' valign='top'><img src='http://www.deal4loans.com/rnew/emailer/frndship-mailer/frnd-flowr.jpg' width='131' height='113' /></td>        <td align='right' valign='top'><img src='http://www.deal4loans.com/rnew/emailer/frndship-mailer/frnd-rgt-corn.jpg' width='23' height='21' /></td>      </tr>    </table></td>  </tr>  <tr>    <td align='left' valign='top' width='40' >&nbsp;</td>    <td width='560' align='left' valign='top' style='font-family:comic sans ms; font-size:16px; word-spacing:6px; letter-spacing:1px; font-weight:bold; text-decoration:none; color:#FFE473;'>Dear Friend</td>  </tr>  <tr>    <td height='55' colspan='2' align='left' valign='top' style='font-family:comic sans ms; font-size:13px; word-spacing:6px; letter-spacing:1px; font-weight:bold; text-decoration:none; color:#FFFFFF; text-align:center;'>'You are truly the blessed one'</td>   </tr>  <tr>   <td align='left' valign='top' style='font-family:comic sans ms; font-size:13px; word-spacing:6px; letter-spacing:1px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>     <td height='65' align='left' valign='middle' style='font-family:comic sans ms; font-size:13px; word-spacing:5px; letter-spacing:1px; font-weight:bold; text-decoration:none; color:#FFFFFF;'> Your  friend $owner_name , who would like you to  avail a wonderful offer on this friendship day.As a friendship gift. We present to you TATA AIG FREE Personal Accident Insurance worth Rs.50000!.so<a href='http://www.deal4loans.com/tataaig-insurance.php?source=fday_d4l08' target='_blank' style='color:#FFFFFF;'> Click here to avail this offer/gift</A>. and we have other offers also,you can choose from these:</td>   </tr>  <tr>    <td  colspan='2' align='left' valign='top'><table width='100%' border='0' align='left' cellpadding='0' cellspacing='0'>      <tr>        <td width='96' height='137' align='left' valign='top'><img src='http://www.deal4loans.com/rnew/emailer/frndship-mailer/frnd-fmly-pics.jpg' width='96' height='121' /></td>    <td valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>          <tr>            <td height='90' style='font-family:comic sans ms; font-size:13px; word-spacing:6px; letter-spacing:1px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>Your family is probably your best friend. Buy a <a href ='http://www.bimadeals.com/health-insurance-call.php?source=fday_d4l08' target='_blank' style='color:#FFFFFF;'>Health<br />              Insurance plan</a> for your family and make sure your medical<br /> expenses are suitably covered.</td>        </tr>          <tr>            <td width='504' height='32' align='left' valign='top'><img src='http://www.deal4loans.com/rnew/emailer/frndship-mailer/frnd-fmly-bot.gif' width='504' height='32' /></td>          </tr>        </table></td>      </tr>      <tr>        <td width='96' height='151' align='left' valign='top'><img src='http://www.deal4loans.com/rnew/emailer/frndship-mailer/frnd-pics.jpg' width='96' height='151' /></td>        <td height='151'><table width='100%' border='0' cellspacing='0' cellpadding='0'>          <tr>            <td height='106' style='font-family:comic sans ms; font-size:13px; word-spacing:6px; letter-spacing:1px; font-weight:bold; text-decoration:none; color:#FFFFFF;' target='_blank'>Is your friend caught in a debt trap? Is he unsure about how to manage his credit card dues and EMIs of other loans? If yes- he can now <a href='http://www.deal4loans.com/AskAmitoj.php?source=fday_d4l08' style='color:#FFFFFF;''> Ask Amitoj</a> for help               on a personalized                 debt consolidation plan- the first &amp; only                 service of its kind in India.</td>          </tr>          <tr>            <td width='504' height='45' align='left' valign='top'><img src='http://www.deal4loans.com/rnew/emailer/frndship-mailer/frnd-bot-panel.gif' width='504' height='45' /></td>          </tr>        </table></td>      </tr>    </table></td>  </tr></table><map name='Map' id='Map'>  <area shape='rect' coords='111,8,216,28' href='http://www.deal4loans.com/index.php?source=fday_d4l08' target='_blank' /></map>";



				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if(isset($friend_email))
					{
						mail($friend_email,$owner_name.'- has send you friendship day gift ', $Message, $headers);
					}
					if(isset($friend_email1))
					{
						mail($friend_email1,$owner_name.'- has send you friendship day gift ', $Message, $headers);
					}
					if(isset($friend_email2))
					{
						mail($friend_email2,$owner_name.'- has send you friendship day gift ', $Message, $headers);
					}
	}
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="Description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<meta name="keywords" content="loan offers, bank loans, home loans, car loans, personal loans, loans against property, credit cards, loan information, loans india, compare loans,">
<meta http-equiv="refresh" content="900">
<title>Loan Provider Banks India | Special Loan Offers | Bank Loans</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
   <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
    <?php if(isset($_SESSION['UserType']))
	{?>
   <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>
	<table width="520"  border="0" cellspacing="0" cellpadding="0" height="385">
<tr><td  align="center" class="head2">Wish a Very Happy Friendship Day<br/>
Thanks,we have send Your gift to Your Friend.<td></tr>
	
		<tr><td>&nbsp;</td></tr><tr>
		 <td align="center">
</td></tr>
  

  </table>
 </form>                                         
 </td>
     </tr>
			</table>
</td></tr></table>
 
    </div>
	 <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right1.php';
  }
  ?>
  </div>
   
<?php include '~Bottom.php';?>
</div>
  </body>
</html>