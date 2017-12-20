<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$requestid = $_SESSION['Temp_LID'];

if($requestid >0)
{
	$getPersonal_Lead="select Name, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, DOB, Updated_Date,Email From Req_Loan_Gold where RequestID=".$requestid;

	list($alreadyExist,$myrow)=MainselectfuncNew($getPersonal_Lead,$array = array());
	$myrowcontr=count($myrow)-1;

	$Name = $myrow[$myrowcontr]['Name'];
	$City =$myrow[$myrowcontr]['City'];
	$City_Other =$myrow[$myrowcontr]['City_Other'];
	$Mobile_Number = $myrow[$myrowcontr]['Mobile_Number'];
	$Net_Salary = $myrow[$myrowcontr]['Net_Salary'];
	$Loan_Amount = $myrow[$myrowcontr]['Loan_Amount'];
	$DOB = $myrow[$myrowcontr]['DOB'];
	$Email = $myrow[$myrowcontr]['Email'];
	$Updated_Date = $myrow[$myrowcontr]['Updated_Date'];
	$explode_Dated = explode(" ", $Updated_Date);
	$explodeDated = explode("-", $explode_Dated[0]);
	$dt = mktime(0, 0, 0, date($explodeDated[1]), date($explodeDated[2]),   date($explodeDated[0]));
		$showDate = date("d M, Y",$dt);

	if($City=="Others")
	{
		$strCity= $City_Other;
	}
	else
	{
		$strCity= $City;
	}
}
else
{
	echo "<script language=javascript>"." location.href='index.php'"."</script>"; die;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title>Apply and Compare Education Loan India</title>
<meta name="description" content="Apply Business Loan: Apply for online business loans. Apply for Business Loan to get the offers from HDFC Bank, Citibank, Citibank, SBI etc.">
<meta name="keywords" content="Business Loans India, Apply Business Loans, Compare Business Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript" src="scripts/common.js"></script>

<link href="source.css" rel="stylesheet" type="text/css" />
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
.aplfrm{
background: none repeat scroll 0 0 #F6FCFF;
    border-left: 5px solid #A2D7F6;
    border-right: 5px solid #A2D7F6;
	}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> ><a href="#"  class="text12" style="color:#4c4c4c;">> Apply for Education Loan</a></div>
<div class="intrl_txt">
<div style="clear:both; height:15px;"></div>
<span class="text" style="color:#4c4c4c; font-size:16px; text-align:center; font-weight:bold;" >
You have already applied with us for Gold Loan
on <? echo $showDate; ?>. Your application is under process.
You will hear from our team to process your application.<br /> </span>
<div class="agent-form">
						<table width="458" border="0" cellspacing="0" align="center" cellpadding="0">
  <tr>
          <td valign="middle" colspan="2" >&nbsp;</td>
        </tr>
        <tr>
          <td height="55" valign="middle" colspan="2" align="center"><span class="text" style="color:#4c4c4c; font-size:18px; font-weight:bold;">Your Gold Loan Details</span></td>
      </tr>
  
            <tr>
              <td width="204" height="30" class="frmbldtxt"><b>Full Name</b></td>
              <td width="254" class="frmbldtxt"><?php echo $Name; ?></td>
            </tr>
            
                     
            <tr>
              <td height="30" class="frmbldtxt">DOB</td>
              <td class="frmbldtxt"><?php echo $DOB;?></td>
            </tr>
            
            <tr>
              <td height="30" class="frmbldtxt">City </td>
              <td class="frmbldtxt">
                  <?php echo $strCity; ?>
                            </td>
        </tr>
       
         
         
        <tr>
          <td width="204" height="26"></td>
      </tr>
      </table>
 
  </div>
</div>

</div>
<?php include("footer_sub_menu.php"); ?>

</body>
</html>
