<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	//get banks details
	$selectplbanks="Select * From personal_loan_banks_eligibility where pl_bank_flag=1";
	
	list($rowscount,$myrow)=MainselectfuncNew($selectplbanks,$array = array());
	
	//$plbankresult = ExecQuery($selectplbanks);
	//$rowscount = mysql_num_rows($plbankresult);
	
	
	

?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Apply Personal Loans | Compare Personal Loans</title>
<meta name="keywords" content="Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
<?php if ((($_REQUEST['flag'])!=1))
	{ ?>
   <?php include '~Upper.php';?><?php } ?>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
    
		<table width="777"  border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td width="100" valign="top">
			<table width="100%" border="0" align="left" cellpadding="1" cellspacing="1" >
				<tr><td height="40"bgcolor="#197ad6" class="txt-hd" style="color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF;" valign="top">Banks</td></tr>
				<tr><td height="40"bgcolor="#197ad6" class="txt-hd" style="color: #FFFFFF; text-align:center;font-weight:bold;">ROI</td></tr>
				<tr><td height="50" bgcolor="#197ad6" class="txt-hd" style="color: #FFFFFF; text-align:center;font-weight:bold;" valign="top">Processing Fee</td></tr>
				<tr><td height="40" bgcolor="#197ad6" class="txt-hd" style="color: #FFFFFF; text-align:center;font-weight:bold;" valign="top">Loan Amount</td></tr>
				<tr><td height="40" bgcolor="#197ad6" class="txt-hd" style="color: #FFFFFF; text-align:center;font-weight:bold;" valign="top">Prepayment Charges</td></tr>
				<tr><td height="40" bgcolor="#197ad6" class="txt-hd" style="color: #FFFFFF; text-align:center;font-weight:bold;" valign="top">Disbursal Time</td></tr>
				<tr><td height="600" bgcolor="#197ad6" class="txt-hd" style="color: #FFFFFF; text-align:center;font-weight:bold;"valign="top">Documents</td></tr>
				
				<tr><td height="22" bgcolor="#197ad6" align="center"class="txt-hd" style="color: #FFFFFF; text-align:center;font-weight:bold;">Apply</td></tr></table>
		</td>
		 <!-------Database Driven------------------------------------->
		 <?
		 if($rowscount>0)
		 {
		 	$i=0;
		 while($i<count($myrow))
        {?>
		 
		<td  valign="top">
		<table width="100%" align="left" cellpadding="1" cellspacing="1" border="1">
              <tr>
			 
                <td height="40"bgcolor="#197ad6" class="txt-hd" style="color: #FFFFFF; text-align:center;font-weight:bold;">
				<? echo $myrow[$i]["pl_bank_name"];?></td>
				
              </tr>
			  <tr><td height="40" align="left" class="txt-hd" valign="top"><? echo $myrow[$i]["pl_bank_roi"];?></td></tr>
			  <tr><td height="50" align="left"  class="txt-hd" valign="top"><? echo $myrow[$i]["pl_bank_processing_fee"];?></td></tr>
			 <tr><td height="40" align="left"  class="txt-hd" valign="top"><? echo $myrow[$i]["pl_bank_loan_amt"];?></td></tr>
			  <tr><td height="40" align="left"  class="txt-hd" valign="top"><? echo $myrow[$i]["pl_bank_prepayment"];?> </td></tr>
			  <tr><td height="40" align="left"  class="txt-hd" valign="top"><? echo $myrow[$i]["pl_bank_disbursal_time"];?> </td></tr>
			  <tr><td align="left" height="600" class="txt-hd" valign="top"><? echo $myrow[$i]["pl_bank_documents"];?> </td></tr>
			  <tr><td height="22" align="center"class="txt-hd" >Apply</td></tr>
               </table></td>
			   <? 
			   $i=$i+1;
			   }
			   }?>
			   <!-------------------------------------------->
<!--			  <td>
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
			  </td>
			  ----------->
			  </tr>
     </table>
	 </div>
<?
  //include '~Right2.php';

  ?>

  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~NewBottom.php';?><?php } ?>

  </body>
</html>