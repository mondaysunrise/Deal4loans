<?php
	header("Location: https://www.deal4loans.com/apply-personal-loan-continue.php");
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	//get banks details
	$selectplbanks="Select * From personal_loan_banks_eligibility where pl_bank_flag=1";
	list($rowscount,$myrow)=Mainselectfunc($selectplbanks,$array = array());
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Compare Personal Loan and Apply Personal loan</title>
<meta name="keywords" content="Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 
<div id="container">  
  <span><a href="index.php">Home</a> > <a href="personal-loans.php">Personal loan </a> > Apply Personal Loan</span>
  
  <div id="txt"><h1  >Apply Personal Loan</h1>
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="115" valign="top">
          <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" >
            <tr><td height="30"bgcolor="#494949" class="txt-hd" style="color: #FFFFFF; text-align:center; font-weight:bold;  border-right:1px solid #d5cfb1;" valign="middle">Banks</td>
	        </tr>
            <tr>
              <td height="40" align="center"bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Rate of Interest </b></td>
            </tr>
            <tr><td height="50" align="center"  valign="middle" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Processing Fee</b></td>
	        </tr>
            <tr><td height="40" align="center"  valign="middle" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Loan Amount</b></td>
	        </tr>
            <tr><td height="40" align="center"  valign="middle" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Prepayment Charges</b></td>
	        </tr>
            <tr><td height="40" align="center"  valign="middle" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Disbursal Time</b></td>
	        </tr>
            <tr><td height="350" align="center" valign="top" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Documents</b></td>
            </tr>
              
      </table>	      </td>
<!--Database Driven -->
        <?
		 $cntr=0;
		 if($rowscount>0)
		 {
		 	
		while($cntr<count($myrow)-1)
		 {
		 ?>
          
        <td  valign="top">
          <table width="286" align="left" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td height="30" align="center" bgcolor="#494949" class="txt-hd"  style=" color:#FFFFFF; font-weight:bold; border-right:1px solid #d5cfb1;">
              <? echo $myrow[$cntr]["pl_bank_name"];?></td>
            </tr>
            <tr>
              <td height="40" align="center" class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$cntr]["pl_bank_roi"];?></b></td>
	        </tr>
            <tr>
              <td height="50" align="center"  class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$cntr]["pl_bank_processing_fee"];?></b></td>
	        </tr>
            <tr>
              <td height="40" align="center"  class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$cntr]["pl_bank_loan_amt"];?></b></td>
	        </tr>
            <tr>
              <td height="40" align="center"  class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$cntr]["pl_bank_prepayment"];?></b> </td>
	        </tr>
            <tr>
              <td height="40" align="center"  class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$cntr]["pl_bank_disbursal_time"];?></b> </td>
	        </tr>
            <tr>
              <td align="left" height="350" class="txt-hd" valign="top" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><? echo $myrow[$cntr]["pl_bank_documents"];?> </td></tr>
        </table></td>
           <? 
			   $cntr=$cntr+1;
			   }
			   }?>
<!--     			  <td>
			  	<table height="22" width="195" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#197ad6">
              		<tr><td colspan="2" align="left" bgcolor="#197ad6" class="txt-hd" style="text-align:center; color: #FFFFFF; font-weight:bold;">Citibank</td></tr>
			  	</table>
			  </td>
			  <td>
			  	<table height="22" width="195" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#197ad6">
              		<tr><td colspan="2" align="left" bgcolor="#197ad6" class="txt-hd" style="text-align:center; color: #FFFFFF; font-weight:bold;">Citifinancial</td></tr>
			  	</table>
			  </td>
			  <td>
			  	<table height="22" width="195" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#197ad6">
              		<tr><td colspan="2" align="left" bgcolor="#197ad6" class="txt-hd" style="text-align:center; color: #FFFFFF; font-weight:bold;">Fullerton</td></tr>
			  	</table>
			  </td> -->
			 
      </tr>
      <tr><td colspan="4" align="center"class="txt-hd" valign="top"><a href="apply-personal-loan-continue.php"><img src="images/blue-aply-btn.gif"></a></td></tr>
    </table>
  </div>
  
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?> <? } ?>
</div></body>
</html>

