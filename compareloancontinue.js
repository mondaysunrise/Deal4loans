// JavaScript Document
function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.validate.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr><td align="left" class="style4" width="210" height="20"><font class="style4">Reconfirm Mobile No.</font></td>	<td colspan="3" align="left" width="196" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" name="RePhone" ></td></tr></table>';
			}
			
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		return true;
}

function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr> <td align="left" class="style4" width="250" height="20" ><font class="style4">Any type of loan(s) running? </font></td> <td colspan="3" class="bodyarial11" width="250" ><table border="0">	 <tr><td class="style4" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="style4"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="style4"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  class="style4" width="250" height="20" ><font class="style4">How many EMI paid? </font>  </td>   <td colspan="3" align="left" width="250" height="18"><select name="EMI_Paid"  style="float: left" class="style4"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option </select>  </td>	</tr></table>';
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



function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if((ni.innerHTML!="")|| (ni1.innerHTML==""))
		{
		
			if(document.loan_form.Property_Identified.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				ni1.innerHTML = '<table border="0"><tr><td align="left"  class="style4"  height="20">&nbsp;<input type="checkbox" name="update" class="noBrdr" ></td><td  align="left"  height="20"><font class="style4">Can we tell you about some properties	</td></tr>	</table>';
			}
		}
		
		return true;

	}	
	
function valButton3() {
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
	
function submitformPL2(Form)
{

	var btn2;
	var btn3;
	var myOption;
	var i;
	//btn2=valButton2();
		if(Form.Reference_Code1.value=="")
		{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				document.loan_form.confirm.focus();
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
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
	
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;

	}	
		if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn3=valButton3();
					if(!btn3)
					{
						alert('Do you have any other loan.');
						return false;
					}
	
				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
			return false;
		}
		
return true;
}

function addElement1()
{
		var ni = document.getElementById('myDiv9');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr> <td align="left"  class="style4" width="200" height="20" ><font class="style4">I have an active credit card from ? </font></td> <td colspan="3" class="bodyarial11" width="300"><table border="0"> <tr><td class="style4" width="60%"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="style4" width="60%"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="style4"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="style4"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="style4"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="style4" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="style4"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</table></table>		';
			}
		}
		
		return true;
}

function removeElement1()
{
		var ni = document.getElementById('myDiv9');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
		}
		
		return true;
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
	function valvalidate() {
		var cnt = -1;
		var i;
		for(i=0; i<document.loan_form.validate.length; i++) 
		{
			if(document.loan_form.validate[i].checked)
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
function submitformCC2(Form)
	{
		var btn2;
		var btn3;
		var myOption;
		var i;
		var btn;
		var btn5;
		//btn=valButton(Form.Pancard);
		//btn2=valButton2();

		if(Form.Reference_Code1.value=="")
		{
		if(!Form.confirm.checked)
		{
				alert("if you havnt received activation code click check box.");
				document.loan_form.confirm.focus();
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
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
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
	 if(btn2)
		{
		if (Form.Card_Vintage.selectedIndex==0)
		{
			alert("Please select since how long you holding credit cards");
			Form.Card_Vintage.focus();
			return false;
		}
		}
				btn5=valButton5();
	if(!btn5)
		{
			alert('Please select have you applied with any of these banks in last 6 months or not');
				return false;
		}

		return true;
	}	