<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";
	$Item_ID = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	if($_SESSION=="")
		{
		$Name= $_SERVER['Temp_Name'];
		$Mobile= $_SERVER['Temp_Phone'];
		$product = $_SERVER['Temp_Type'];
		$Email= $_SERVER['Temp_Email'];
		$Net_Salary= $_SERVER['Temp_Net_Salary'];
		$Company_Name= $_SERVER['Temp_Company_Name'];
		$City= $_SERVER['Temp_City'];
		$Other_City= $_SERVER['Temp_City_Other'];
		$Pincode= $_SERVER['Temp_Pincode'];
		$Contact_Time= $_SERVER['Temp_Contact_Time'];
		$Employment_Status= $_SERVER['Temp_Employment_Status'];
		}
else {
		$Name= $_SESSION['Temp_Name'];
		$Mobile= $_SESSION['Temp_Phone'];
		$product = $_SESSION['Temp_Type'];
		//echo $product;
		$Email= $_SESSION['Temp_Email'];
		$Net_Salary= $_SESSION['Temp_Net_Salary'];
		$Company_Name= $_SESSION['Temp_Company_Name'];
		$City= $_SESSION['Temp_City'];
		$Other_City= $_SESSION['Temp_City_Other'];
		$Pincode= $_SESSION['Temp_Pincode'];
		$Contact_Time= $_SESSION['Temp_Contact_Time'];
		$Employment_Status= $_SESSION['Temp_Employment_Status'];
}

	?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Apply online for credit cards in Delhi, Gurgaon & Noida | Credit cards Mumbai</title>
<meta name="description" content="Get online information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="apply online for credit cards, credit cards, credit card plans, online credit card, Noida, Mumbai, Delhi, Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<script language="javascript">

function valButton2() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.From_Product.length; i++) 
	{
        if(document.loan_form.From_Product[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}



function submitform2(Form)
	{

	var btn2;
	btn2=valButton2();
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}

	if(!btn2)
			{
				alert('Do you have any other credit card from which bank.');
				return false;
			}

return true;
}
	function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			     
               
       }

       return true;
}
</script>

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
<?php if((($_SESSION['flag'])!=1)) { ?>
   <?php include '~Upper.php';?><? } ?>
    <div id="dvbannerContainer"> <table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><?php include '~Image.php';?></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">A wedding in the family. Maybe your house needs renovation. Or your daughter has obtained admission to a medical college.. Gift your wife a beautiful gold pendant, pay for your children’s higher education, or send your parents on a much-needed holiday- we offer various kinds of personal loans to fulfill your dreams in India.</td></tr></table> </div>
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
<? if ((($_SESSION['flag'])==1))
	{ ?>
  <form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return submitform2(document.loan_form);">
  <? }
  else { ?>
   <form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform2(document.loan_form);">
  <? } ?>
	<table width="520"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center" class="head2">Please Tell more about yourself<td></tr>
<tr><td>&nbsp;</td></tr>
 <tr><td><input type="hidden" value="PersonalLoan" name="type"></td></tr>
		<tr>
		 <td>
 
<table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
 <tr>
       <td class="bodyarial11">Activation Code</td>
       <td class="bodyarial11"><input type="text" name="Reference_Code1" size="10" maxlength="4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:250;font-weight:none; " ></div></td>
     </tr>
 <tr>
     <td class="bodyarial11" width="30%">Primary Account in which bank?<font size="1" color="#FF0000">*</font> </td>
     <td class="bodyarial11" width="70%">
     <input type="text" name="Primary_Acc"  size="15" maxlength="30"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Any type of loan(s) running</td>
    <td  class="bodyarial11"><table border="0">
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td>
	 <td class="bodyarial11"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="cl">Car</td>
	 <td class="bodyarial11"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="lap">Property</td>
	 <td class="bodyarial11" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="other">Other</td>
	 </tr></table>
	 
 </td>
   </tr>
   <tr>
     <td class="bodyarial11">How many EMI paid?</td>
     <td class="bodyarial11">
	 <select name="EMI_Paid"  style="float: left" class="style4"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select> 
<!--      <input type="text" name="EMI_Paid" value="0" size="15" maxlength="30"> --></td>
   </tr>
   <tr>
     <td class="bodyarial11">Do you have an active credit card from?<font size="1" color="#FF0000">*</font> </td>
     <td  class="bodyarial11"><table border="0">
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td>
	 <td class="bodyarial11"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td>
	 <td class="bodyarial11"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product[]" value="Standard Chartered"  id="From_Product" class="noBrdr" >Standard Chartered</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td>
	  <td colspan="2" class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Others">Others</table></td>
	 </tr>
    
   <tr>
     <td colspan="2" align="center" class="bodyarial11"><br>
       <input type="submit" class="bluebutton" value="Submit" >
       &nbsp;
       <input type="reset" class="bluebutton" value="Reset" ></td>
   </tr>
   
  </table>
 </form>
 
 </td>
     </tr>
            </table>
			</td></tr></table>
 </div>
<?
  include '~Right2.php';
  ?>
  
  </div>
  <? if ((($_SESSION['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><?php } ?>
<!------------------- CODE----------------------------------->


  </body>
</html>