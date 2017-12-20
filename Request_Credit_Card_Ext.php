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
		$Email= $_SERVER['Temp_Email'];
		$Net_Salary= $_SERVER['Temp_Net_Salary'];
		$Company_Name= $_SERVER['Temp_Company_Name'];
		$City= $_SERVER['Temp_City'];
		$Other_City= $_SERVER['Temp_City_Other'];
		$Pincode= $_SERVER['Temp_Pincode'];
		$Contact_Time= $_SERVER['Temp_Contact_Time'];
		$Employment_Status= $_SERVER['Temp_Employment_Status'];
		$CC_Holder = $_SERVER['Temp_CC_Holder'] ;
		}
		else
		{
		$Name= $_SESSION['Temp_Name'];
		$product=$_SESSION['Temp_Type'] ;
		$Mobile= $_SESSION['Temp_Phone'];
		$Reference_Code2= $_SESSION['Temp_Reference_Code'];
		//echo $Reference_Code2;
		$Email= $_SESSION['Temp_Email'];
		$Net_Salary= $_SESSION['Temp_Net_Salary'];
		$Company_Name= $_SESSION['Temp_Company_Name'];
		$City= $_SESSION['Temp_City'];
		$Other_City= $_SESSION['Temp_City_Other'];
		$Pincode= $_SESSION['Temp_Pincode'];
		$Contact_Time= $_SESSION['Temp_Contact_Time'];
		$Employment_Status= $_SESSION['Temp_Employment_Status'];
		$CC_Holder = $_SESSION['Temp_CC_Holder'] ;
		}
	?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Credit Cards| Credit Cards India| Credit Cards Apply| Credit Cards Compare | Deal4Loans - Compare Apply</title>
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
function valButton5() {
		var cnt = -1;
		var i;
		for(i=0; i<document.loan_form.From_Product1.length; i++) 
		{
			if(document.loan_form.From_Product1[i].checked)
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
           
function submitform(Form)
{

var btn;
var btn2;
var btn5;
btn=valButton(Form.Pancard);
btn2=valButton2();
btn5=valButton5();
if(!btn)
{
	alert('please select you have a pancard or not.');
	
		return false;
}

<?php
if($CC_Holder=="1") 
{
?>	
if(!btn2)
{
	alert('do you have any other credit card from which bank.');
	return false;
}
else if(btn2)
	{
	if (Form.Card_Vintage.selectedIndex==0)
	{
		alert("Please select since how long you holding credit cards");
		Form.Card_Vintage.focus();
		return false;
	}
	}
	<?}?>
if(!btn5)
		{
			alert('Please select have you applied with any of these banks in last 6 months or not');
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

<div id="dvMainbanner"><?php if ((($_REQUEST['flag'])!=1))
	{ ?>
    <?php include '~Upper.php';?><?php } ?>
    <div id="dvbannerContainer"><table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><?php include '~Image.php';?></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">Have you ever stood behind 
                                someone in line at the store and watched him 
                                shuffle through a stack of what must be at least 
                                10 credit cards? Consumers with this many cards 
                                are still in the minority, but experts say that 
                                the majority of modern day inhabitants have at 
                                least one credit card and usually two or three.</td></tr></table>   </div>
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
  <form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return submitform(document.loan_form);">
  <? }
  else 
	  {?>
   <form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform(document.loan_form);">
  <? } ?>
	<table width="520"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center" class="head2">Please Tell more about yourself<td></tr>
<tr><td>&nbsp;</td></tr>
 		<tr>
		 <td>
  <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
<tr><td><input type="hidden" value="CreditCard" name="type"></td></tr>
	 <tr>
       <td class="bodyarial11">Activation Code</td>
       <td class="bodyarial11"><input type="text" name="Reference_Code1" size="10" maxlength="4" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:250;font-weight:none; " ></div></td>
     </tr>
   <tr>
     <td width="30%" class="bodyarial11">Do you have a pancard?<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="bodyarial11">
     <p dir="ltr"><input type="radio" name="Pancard" class="NoBrdr"  value="Yes">Yes
     <input type="radio" name="Pancard" class="NoBrdr" value="No">No</td>
   </tr>
   <tr>
     <td class="bodyarial11"> you have an active credit card from? </td>
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
	  <td class="bodyarial11" colspan="2"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Others">Others</td></table>
	 
	 </tr>
	 <tr>
     <td class="bodyarial11">Cards held since?</td>
	 <td class="bodyarial11"><select size="1" name="Card_Vintage">
	<option value="0">Please select</option>
	 <option value="1">Less than 6 months</option>
     <option value="2">6 to 9 months</option>
     <option value="3">9 to 12 months</option>
     <option value="4">more than 12 months</option>
	 </select>
	 </td>
   </tr>
	 <tr>
     <td class="bodyarial11">Have you applied with these Banks in last six months?<font size="1" color="#FF0000">*</font> </td>
     <td  class="bodyarial11"><table border="0">
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" id="From_Product1" name="From_Product1[]" value="Amex">Amex</td>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product1[]" id="From_Product1" class="noBrdr" value="Citi Bank" >Citi Bank</td>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product1[]" class="noBrdr" id="From_Product1" value="Deutsche bank">Deutsche Bank</td>
	 <td class="bodyarial11"><input type="checkbox"  id="From_Product1" name="From_Product1[]" value="HDFC" class="noBrdr">HDFC</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product1[]" id="From_Product1" >HSBC</td>
	 <td class="bodyarial11"> <input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="ICICI">ICICI</td>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product1[]" value="Standard Chartered"  id="From_Product1" class="noBrdr" >Standard Chartered</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product[]" class="noBrdr" value="SBi">SBI</td>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Others">Others</td>
	<td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="0">No</table></td>
	 </tr>
   
   <tr>
     <td valign="top" class="bodyarial11">Special benefit required for the card</td>
     <td class="bodyarial11"><textarea rows="5" name="Descr" cols="40"> </textarea></td>
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