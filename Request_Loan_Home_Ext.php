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
			$product=$_SERVER['Temp_Type'] ;
			$Mobile= $_SERVER['Temp_Phone'];
			$Reference_Code2= $_SERVER['Temp_Reference_Code'];
			//echo $Reference_Code2;
			$Email= $_SERVER['Temp_Email'];
			$Net_Salary= $_SERVER['Temp_Net_Salary'];
			$Company_Name= $_SERVER['Temp_Company_Name'];
			$City= $_SERVER['Temp_City'];
			$Other_City= $_SERVER['Temp_City_Other'];
			$Pincode= $_SERVER['Temp_Pincode'];
			$Contact_Time= $_SERVER['Temp_Contact_Time'];
			$Employment_Status= $_SERVER['Temp_Employment_Status'];
		}
		else
		{
			$Name= $_SESSION['Temp_Name'];
			$product=$_SESSION['Temp_Type'] ;
			$Mobile= $_SESSION['Temp_Phone'];
			$Reference_Code2= $_SESSION['Temp_Reference_Code'];
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

<title>Home Loans| Home Loans India| Home Loans Apply | Home Loans Compare| Home Loans EMI | Deal4Loans - Compare Apply</title>
<meta name="description" content="Get online information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="apply online for credit cards, credit cards, credit card plans, online credit card, Noida, Mumbai, Delhi, Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script language="javascript">
function valButton(btn) {
    var cnt = -1;
	var i;
    for(i=0; i<btn.length; i++) 
	{
        if(btn[i].checked)
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



function submitform3(Form)
	{

		var btn;
		btn=valButton(Form.Property_Identified);
		if(!btn)
			{
				alert('please select you have identified any property or not');
				return false;
			}
		if (Form.Budget.selectedIndex==0)
			{
				alert("Please estimated market value of the property");
				Form.Budget.focus();
				return false;
			}
		if (Form.Loan_Time.selectedIndex==0)
			{
				alert("Please enter when you are planning to take loan");
				Form.Loan_Time.focus();
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
<?php if ((($_REQUEST['flag'])!=1))
	{ ?>
    <?php include '~Upper.php';?><?php } ?>
    <div id="dvbannerContainer"> <table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><?php include '~Image.php';?></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">Home, sweet home, built out of your dreams. A place where you return after a hard day's work and relax, a place where you share precious moments with your family. A place that gives you a sense of belonging. We are here to help you realize your long cherished dream of owning your home through hassle free and customer friendly home loans.</td></tr></table> </div>
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
  <form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return submitform3(document.loan_form);">

  <? } else { ?>
  <form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform3(document.loan_form);">
  <? } ?>

	<table width="520"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center" class="head2">Please Tell more about yourself<td></tr>
<tr><td>&nbsp;</td></tr>
 		<tr>
		 <td>
 <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
<tr><td><input type="hidden" value="HomeLoan" name="type"></td></tr>
	 <tr>
       <td class="bodyarial11">Activation Code</td>
       <td class="bodyarial11"><input type="text" name="Reference_Code1" size="10" maxlength="4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:250;font-weight:none; " ></div></td>
     </tr>
   <tr>
     <td width="30%" class="bodyarial11">Property Identified<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="bodyarial11">
     <p dir="ltr"><input type="radio" name="Property_Identified" class="NoBrdr"  value="1">Yes
     <input type="radio" name="Property_Identified" class="NoBrdr" value="0">No</td>
   </tr>
	 <tr>
       <td class="bodyarial11">Property Location </td>
       <td class="bodyarial11"><input type="text" name="Property_Loc" size="20" maxlength="30"></td>
     </tr>
	
		<tr>
	 <td class="bodyarial11">Estimated market value of the property?<font size="1" color="#FF0000">*</font></td>
	<td class="bodyarial11"><select name="Budget" class="style4" >
	<option value="-1" selected>Please Select</option>
	<option value="Upto 7 Lakhs">Upto 7 Lakhs </option>
	<option value="7-15 Lakhs">7-15 Lakhs </option>
	<option value="15-20 Lakhs">15-20 Lakhs </option>
	<option value="20-25 Lakhs">20-25 Lakhs </option>
	<option value="Above 25 Lakhs">Above 25 Lakhs</option></select></td>
	</tr>
	<tr>
       <td class="bodyarial11">When you are planning to take loan?<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><select name="Loan_Time"  class="style4" >
           <OPTION value="-1" selected>Please select</OPTION>
			<OPTION value="15 days">15 days</OPTION>
			<OPTION value="1 month">1 months</OPTION>
			<OPTION value="2 months">2 months</OPTION>
			<OPTION value="3 months">3 months</OPTION>
			<OPTION value="3 months & above">more than 3 months</OPTION></SELECT>
		</td>
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
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><?php } ?>

  </body>
</html>