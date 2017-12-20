<?php
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-hdfc-pllist.js"></script>
<style type="text/css">
	
		/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:300px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>

<script Language="JavaScript" Type="text/javascript">

	function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.hdfc_calc.loan_runnung.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table  width="100%" cellpadding="3" cellspacing="5"><tr>	<td>Availed Loan Amount</td>	<td><input type="text" name="availed_loan_amt" id="availed_loan_amt"/></td></tr><tr>	<td>Amount of EMI Paying</td>	<td><input type="text" name="hdfc_emi_amt" id="hdfc_emi_amt"/>(Per month)</td></tr><tr>	<td>Tenure</td>	<td><select name="hdfc_loan_tenure" id="hdfc_loan_tenure"/>	<option value="12">12 months (1 yr)</option>	<option value="24">24 months (2 yrs)</option>	<option value="36">36 months (3 yrs)</option>	<option value="48">48 months (4 yrs)</option>	<option value="60">60 months (5 yrs)</option>	</select></td></tr><tr>	<td>No Of EMI Paid ?</td>	<td><select name="no_emi_paid"> <option value="0">Please select</option><option value="1">Less than 9 months</option> <option value="2">9 to 12 months</option> <option value="3">more than 12 months</option ></select></td></tr>		</table>';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.hdfc_calc.loan_runnung.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
	</script>
</head>

<body>
<form name="hdfc_calc" method="POST" action="hdfc_prsnl_ln_func.php">
<div align="center"><b>HDFC Form</b></div>
	<table  align="center" cellpadding="3" cellspacing="5" width="500" style="border: 1px solid #000000">
	
		<tr>			
			<td>Company Name</td>
			<td><input name="Company_Name" id="Company_Name" type="text" tabindex="10"   style=" width:148px;"  onblur="onBlurDefault(this,'Company Name');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" onfocus="onFocusBlank(this,'Company Name');" /></td>
		</tr>
		<tr>
			<td>City</td>
			<td> 
			<select name="City" id="City" style="width:154px;" >
                         <?=getCityList1($City)?>
                     </select></td>
		</tr>
		<tr>
			<td>Company Category</td>
			<td>	
			<select name="company_type" id="company_type">
				<option value="BPO">BPO</option>
				<option value="Insurance">Insurance</option>
				<option value="Others">Others</option>
			</select>
			</td>
		</tr>
		<tr>
          <td height="35" class="bldtxt">Company Type</td>
          <td class="frmtxt"><select name="company_cate_type" id="company_cate_type" style="width: 203px;">
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			</select></td>
        </tr> 
		<tr>
			<td>Net Salary</td>
			<td><input type="text" name="net_salary" id="net_salary"/>(Per month)</td>
		</tr>
		
		<tr>
			<td>Primary Account</td>
			<td><select name="primary_acc" id="primary_acc">
				<option value="HDFC Bank">HDFC Bank</option>
				<option value="Other">Other</option>
				</select></td>
		</tr>
		<tr>
			<td>Age</td>
			<td><input type="text" name="age" id="age" maxlength="2"/>(in yrs)</td>
		</tr>
		
		<tr>
			<td>No of loan Running</td>
			<td><select name="no_of_loans">
			<option value="">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">More than 3</option>

			</select></td>
		</tr>
		<tr>
			<td>Clubbed EMI</td>
			<td><input type="text" name="clubbed_emi" id="clubbed_emi"/></td>
		</tr>
		<tr>
			<td>Personal Loan Running with HDFC ?</td>
			<td><input type="radio" name="loan_runnung" id="loan_runnung" value="1" onClick="addElement();"/>Yes &nbsp; <input type="radio" name="loan_runnung" id="loan_runnung" value="2" onClick="removeElement();"/>No </td>
		</tr>
		 <tr>
                <td colspan="2"><div id="myDiv"></div> </td>
              </tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="Submit"/></td>
		</tr>
	</table>
</form>
</body>
</html>


