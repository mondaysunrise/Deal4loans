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
		$Name= $_SESSION['Temp_Name'];
		$Mobile= $_SESSION['Temp_Phone'];
		$Reference_Code2= $_SESSION['Temp_Reference_Code'];
		//echo $Reference_Code2;
		$Email= $_SESSION['Temp_Email'];
		$Net_Salary= $_SESSION['Temp_Net_Salary'];
		
		$City= $_SESSION['Temp_City'];
		$Other_City= $_SESSION['Temp_City_Other'];
		$Pincode= $_SESSION['Temp_Pincode'];
		$Employment_Status= $_SESSION['Temp_Employment_Status'];
		$CC_Holder = $_SESSION['Temp_CC_Holder'] ;
		//echo $CC_Holder;
	?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title> Business Loans in Delhi | Business Loan in Mumbai | Business Loans in Kolkata | Noida Business Loans</title>
<meta name="description" content="Get online information on business loans from all business loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="business loans in delhi, business loan in Mumbai, business loans in kolkata, noida business loans, Mumbai, Delhi, Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
 <script language="javascript">
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
 function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.validate.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr><td align="left" class="bodyarial11" width="200" height="20">Reconfirm Mobile No.</td>	<td colspan="3" align="left" width="300" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" name="RePhone" ></td></tr></table>';
			}
			
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		return true;
		}


function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.Loan_Any.length; i++) 
	{
        if(document.loan_form.Loan_Any[i].checked)
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


           
function submitform(Form)
{

var btn;
var btn2;
var myOption;
var myLoanOption;

if(Form.Reference_Code1.value=="")
		{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				Form.confirm.focus();
				return false;
		}
		else if(Form.confirm.checked)
			{
				if(Form.RePhone.value=="")
			{
				alert("Please Re confirm your mobile number again");
				Form.RePhone.focus();
				return false;
			}
			
		}
		}
		myOption = -1;
		for (i=Form.CCbusiness.length-1; i > -1; i--) {
			if(Form.CCbusiness[i].checked) {
				if(i==0)
				{
					if(Form.Card_Vintage.selectedIndex==0)
					{
						alert('Card Held since.');
						Form.Card_Vintage.focus();
						return false;
					}

					btn2=valButton2();
					if(!btn2)
					{
						alert('From which bank.');
						return false;
					}

				}
					myOption = i;

				
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select you are credit card holder or not");
			return false;
		}
myLoanOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if(Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}

				}
					myLoanOption = i;

				
			}
		}
	
		if (myLoanOption == -1) 
		{
			alert("Please select Any loan running or not");
			return false;
		}
		
}




function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr> <td align="left" class="bodyarial11" width="200" height="20" >Which type of loan(s) running? </td> <td colspan="3" class="bodyarial11" width="300" ><table border="0">	 <tr><td class="bodyarial11" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="bodyarial11"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="bodyarial11"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td class="bodyarial11" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="bodyarial11" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  width="200" height="20" class="bodyarial11">How many Installments paid?  </td>   <td colspan="3" align="left" width="300" height="18" ><select name="EMI_Paid"  style="float: left"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option </select>  </td>	</tr></table>';
			}
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.CCbusiness.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr>	 <td align="left"  class="bodyarial11" width="200" height="20">Cards held since?</td>		<td  align="left"  colspan="3" width="300" height="20"><select size="1" class="style4" name="Card_Vintage"><option value="0">Please select</option> <option value="1">Less than 6 months</option>	 <option value="2">6 to 9 months</option>	 <option value="3">9 to 12 months</option>	 <option value="4">more than 12 months</option>	 </select> </td></tr>	<tr> <td align="left"  valign="top" class="bodyarial11" width="200" height="20" >I have an active credit card from ? </td> <td colspan="3" class="bodyarial11" width="300"><table border="0"> <tr><td class="bodyarial11" width="60%"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="bodyarial11" width="60%"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="bodyarial11"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="bodyarial11"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="bodyarial11"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="bodyarial11"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="bodyarial11"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="bodyarial11" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="bodyarial11"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</table></table>';
				

			}
		}
		
		return true;

	}


function removeElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.CCbusiness.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
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
	<table width="520"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center" class="head2">Please Tell more about yourself<td></tr>
<tr><td>&nbsp;</td></tr>
 		<tr>
		 <td>
		   <form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform(document.loan_form);">

			  <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
				<tr><td><input type="hidden" value="BusinessLoan" name="type"></td></tr>
					<tr>
				    <td class="bodyarial11" width="40%">Activation Code? 
				   </td>
				   <td class="bodyarial11" width="60%">
				   <input size="10"  maxlength="10" name="Reference_Code1" class="bodyarial11" style="float: left" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>
				   </td>
				</tr>
				<tr>
				    <td colspan="2" align="left"  class="bodyarial11"  ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
						if you havent received activation code sms
				  </td>
				</tr>
				<tr><td colspan="2" id="myDiv" ></td></tr>
				 <tr>
			<td class="bodyarial11" >Are you a Credit card holder?</td> <td  class="bodyarial11" ><input type="radio"  name="CCbusiness"  class="NoBrdr"  value="1"  onclick="addElementCC();" >Yes
			
			<input type="radio" class="NoBrdr" name="CCbusiness" value="0" onClick="removeElementCC();">No</td></tr>
		 <tr><td colspan="2" id="myDivCC"></td></tr>
		
				
				</tr>
					<tr>
					<td  class="bodyarial11">Any Loan running?</td>
					<td  class="bodyarial11"  ><input type="radio"  class="NoBrdr"  value="1"  name="LoanAny" class="NoBrdr" onclick="addElementLoan();">Yes<input size="10" type="radio" class="NoBrdr"  name="LoanAny" class="NoBrdr" onclick="removeElementLoan();" value="0" >No</td><tr>
				<tr><td colspan="4" id="myDivLoan"></td></tr>
			 <tr>
				 <td colspan="2" align="center"><br><input type="submit" class="bluebutton" value="Submit"> 
				   &nbsp;
				   <input type="reset" class="bluebutton" value="Reset"></td>
			   </tr>
							
								
					</table> </form>
					</td>
					</tr>
					
					<tr><td width="400" colspan="3" height="2">&nbsp;</td></tr>		
					 <tr><td>&nbsp;</td></tr>
				
					
				
  </table>

 
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