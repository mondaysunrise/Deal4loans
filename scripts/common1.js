function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function cityother(select)
{
	 var index;
	 
 
	 for(index=0; index<select.options.length; index++)
     if(select.options[index].selected)
     {
        if(select.options[index].value=="Others")
			document.loan_form.City_Other.disabled = false;
		else
			document.loan_form.City_Other.disabled = true;
        
      }
	
}
function initPage(strPlan)
{
       if (document.getElementById('plantype') != undefined)
       {
               document.getElementById('plantype').innerHTML = strPlan;
       }

       return true;
}
function chkform()
{
	<?
if($_SESSION['UserType']=="") 
{
?>	
	if(document.loan_form.Email.value!="Email Id")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}
		if((document.loan_form.PWD1.value=="") ||(document.loan_form.PWD1.value=="Password"))
		{
			alert("please fill password.");
			document.loan_form.PWD1.focus();
			return false;
		}
	}
	<?

}
?>
	if((document.loan_form.FName.value=="") || (document.loan_form.FName.value=="First Name"))
	{
		alert("Please fill your first name.");
		document.loan_form.FName.focus();
		return false;
	}
	if((document.loan_form.LName.value=="") || (document.loan_form.LName.value=="Last Name"))
	{
		alert("Please fill your Last name.");
		document.loan_form.LName.focus();
		return false;
	}
	if((document.loan_form.day.value=="")||(document.loan_form.day.value=="dd"))
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	if((document.loan_form.month.value=="")||(document.loan_form.month.value=="mm"))
	{
		alert("Please fill your month of birth.");
		document.loan_form.month.focus();
		return false;
	}
	if(!checkData(document.loan_form.month, 'Month', 2))
		return false;
	if((document.loan_form.year.value=="")||(document.loan_form.year.value=="yyyy"))
	{
		alert("Please fill your year of birth.");
		document.loan_form.year.focus();
		return false;
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	
		if(document.loan_form.Phone1.value!="")
	{
		if((document.loan_form.Std_Code.value=="")||(document.loan_form.Std_Code.value=="std"))
		{
			alert("Please fill your STD Code for Residence number.");
			document.loan_form.Std_Code.focus();
			return false;
		}
	}
	
	if(document.loan_form.Landline_O.value!="")
	{
		if((document.loan_form.Std_Code_O.value=="")||(document.loan_form.Std_Code_O.value=="std"))
		{
			alert("Please fill your STD Code for Office Landline number.");
			document.loan_form.Std_Code_O.focus();
			return false;
		}
	}
	
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}	
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;
	if (document.loan_form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && (document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		document.loan_form.City_Other.focus();
		return false;
	}
	
	if((document.loan_form.Company_Name.value=="") || (document.loan_form.Company_Name.value=="Company Name"))
	{
		alert("Please fill your Company name.");
		document.loan_form.Company_Name.focus();
		return false;
	}
	if(!checkData(document.loan_form.Company_Name, 'Company Name', 3))
		return false;

	if ((document.loan_form.Net_Salary.value=="")|| (document.loan_form.Net_Salary.value=="Annual Income(Rs.)"))
	{
		alert("Please enter Annual Income.");
		document.loan_form.Net_Salary.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;
	if((document.loan_form.Loan_Amount.value=="") || (document.loan_form.Loan_Amount.value=="Loan Amount"))
	{
		alert("Please fill your Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	if (document.loan_form.Type_Loan.selectedIndex==0)
	{
		alert("Please choose the product that you are looking for");
		document.loan_form.Type_Loan.focus();
		return false;
	}
	if(document.loan_form.Email.value=="Email Id")
	{
	document.loan_form.Email.value=" ";
	}

	if(document.loan_form.Std_Code.value=="std")
	{
	document.loan_form.Std_Code.value=" ";
	}

	if(document.loan_form.Std_Code_O.value=="std")
	{
	document.loan_form.Std_Code_O.value=" ";
	}


}