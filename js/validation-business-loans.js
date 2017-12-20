$(document).ready(function(){
	$("#Loan_Amount").keyup(function(){
		$("#SelfEmployee").fadeIn("slow");
		$("#running-business-ar").fadeIn("slow");
		$("#get-quote-ar").fadeOut("slow");
		$("#get-quote-ar2").fadeIn("slow");
    });
	$("#running-business-ar").click(function(){
        $("#annual-ancome-ar").fadeIn("slow");
    });
	$("#annual-ancome-ar").click(function(){
	
		$("#annual-turnover-ar").fadeIn("slow");	
    });
	$("#annual-turnover-ar").click(function(){
        $("#existing-loan-ar").fadeIn("slow");
    });
	$("#Existing_Loan1").click(function(){
        $("#loan-type-ar").fadeIn("slow");
    });
	$("#Existing_Loan2").click(function(){
        $("#loan-type-ar").fadeOut("slow");
		$("#loan-emi-paid-ar").fadeOut("slow");
		$("#credit-card-ar").fadeIn("slow");
    });
	$("#loan-type-ar").click(function(){
        $("#loan-emi-paid-ar").fadeIn("slow");
    });
	$("#loan-emi-paid-ar").click(function(){
        $("#credit-card-ar").fadeIn("slow");
    });
	$("#CC_Holder1").click(function(){
        $("#holding-card-ar").fadeIn("slow");
    });
	$("#CC_Holder2").click(function(){
		$("#holding-card-ar").fadeOut("slow");
        //$("#personal-details").fadeIn("slow");
    });
	$("#holding-card-ar").click(function(){
       // $("#personal-details").fadeIn("slow");
    });
});

function formValidate()
{
	var i;
	if (document.personalloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.personalloan_form.Loan_Amount.focus();
		return false;
	}	
	
	var myOption2 = -1;
	for (i=document.personalloan_form.Total_Experience.length-1; i > -1; i--) {
		if(document.personalloan_form.Total_Experience[i].checked) {
		myOption2 = i;
		
		if(i>=0)
			{
				//Start Annual Income 
		var myOptionAnnualIn = -1;
		for (i=document.personalloan_form.IncomeAmount.length-1; i > -1; i--) {
		if(document.personalloan_form.IncomeAmount[i].checked) {
		myOptionAnnualIn = i;
		if(i>=0)
			{
			   // Start Annual TurnOver
			   
		 var myOptionAnnualTurnOv = -1;
		for (i=document.personalloan_form.Annual_Turnover.length-1; i > -1; i--) {
		if(document.personalloan_form.Annual_Turnover[i].checked) {
		myOptionAnnualTurnOv = i;
		if(i>=0)
			{
			   // Start Any Existing Loan
		var myOptionExistingLoan = -1;
		for (i=document.personalloan_form.Existing_Loan.length-1; i > -1; i--) {
		if(document.personalloan_form.Existing_Loan[i].checked) {
		myOptionExistingLoan = i;
		if(i==0)
			{
			   // Start Loan Type
			   var myOptionLoanAny = -1;
		for (i=document.personalloan_form.Loan_Any.length-1; i > -1; i--) {
		if(document.personalloan_form.Loan_Any[i].checked) {
		myOptionLoanAny = i;
		if(i>=0)
			{
			   // Start EMIs Paid
			   
		var myOptionEMIPaid = -1;
		for (i=document.personalloan_form.EMI_Paid.length-1; i > -1; i--) {
		if(document.personalloan_form.EMI_Paid[i].checked) {
		myOptionEMIPaid = i;
		if(i>=0)
			{
			   // Start Any Credit Card
			   
			   var myOptionCCHolder = -1;
		for (i=document.personalloan_form.CC_Holder.length-1; i > -1; i--) {
		if(document.personalloan_form.CC_Holder[i].checked) {
		myOptionCCHolder = i;
		if(i==0)
			{
			   // Start Holding This Credit Card Since
			   
			   
		var myOptionCardVintage = -1;
		for (i=document.personalloan_form.Card_Vintage.length-1; i > -1; i--) {
		if(document.personalloan_form.Card_Vintage[i].checked) {
		myOptionCardVintage = i;
		if(i==0)
			{
			   // Start Persoanal Details
			   
			   //End Persoanal Details
			}
		}
	}
	if (myOptionCardVintage == -1) 
	{
	document.getElementById('CardVintageVal').innerHTML = "<span  class='hintanchor'>Please Check Holding This Credit Card Since!</span>";	
	return false;
	}
			   //End  Holding This Credit Card Since
				
			}
		}
	}
	if (myOptionCCHolder == -1) 
	{
	document.getElementById('CCHolderVal').innerHTML = "<span  class='hintanchor'>Please Check Any Credit Card</span>";	
	return false;
	}
			   //End  Any Credit Card
			}
		}
	}
	if (myOptionEMIPaid == -1) 
	{
	document.getElementById('EMIPaidVal').innerHTML = "<span  class='hintanchor'>Please Check EMIs Paid</span>";	
	return false;
	}
			   //End  EMIs Paid 
			}
		}
	}
	if (myOptionLoanAny == -1) 
	{
	document.getElementById('LoanAnyVal').innerHTML = "<span  class='hintanchor'>Please Check Loan Type</span>";	
	return false;
	}
			   //End  Loan Type 
			}
			if(i==1)
			{
				
		var myOptionCCHolder = -1;
		for (i=document.personalloan_form.CC_Holder.length-1; i > -1; i--) {
		if(document.personalloan_form.CC_Holder[i].checked) {
		myOptionCCHolder = i;
		
		if(i==0)
			{
			   // Start Holding This Credit Card Since
        var myOptionCardVintage = -1;
		for (i=document.personalloan_form.Card_Vintage.length-1; i > -1; i--) {
		if(document.personalloan_form.Card_Vintage[i].checked) {
		myOptionCardVintage = i;
		if(i>=0)
			{
			   // Start Persoanal Details
		
			   //End Persoanal Details
			}
		}
	}
	if (myOptionCardVintage == -1) 
	{
	document.getElementById('CardVintageVal').innerHTML = "<span  class='hintanchor'>Please Check Holding This Credit Card Since!</span>";	
	return false;
	}
			   //End Holding This Credit Card Since
			}
			//Credit Card No
			if(i==1)
			{
				//Start Personal Details
				
				// End Personal Details
				}
		}
	}
	if (myOptionCCHolder == -1) 
	{
	document.getElementById('CCHolderVal').innerHTML = "<span  class='hintanchor'>Please Check Any Credit Card!</span>";	
	return false;
	}
			}
			
		}
	}
	if (myOptionExistingLoan == -1) 
	{
	document.getElementById('ExistingLoanVal').innerHTML = "<span  class='hintanchor'>Please Check Any Existing Loan!</span>";	
	return false;
	}
			   //End  Any Existing Loan 
			}
		}
	}
	if (myOptionAnnualTurnOv == -1) 
	{
	document.getElementById('AnnualTurnoverVal').innerHTML = "<span  class='hintanchor'>Please Check Annual Turnover!</span>";	
	return false;
	}
			   //End  Annual Turn Over 
			}
		}
	}
	if (myOptionAnnualIn == -1) 
	{
	document.getElementById('NetSalaryVal').innerHTML = "<span  class='hintanchor'>Please Check Annual Income/ ITR!</span>";	
	return false;
	}
				///End Annual Encome
			}
	
		}
	}
	if (myOption2 == -1) 
	{
	document.getElementById('TotalExperienceVal').innerHTML = "<span  class='hintanchor'>Please Check Running Business Since!</span>";	
	return false;
	}
	
		// Start Self Employee Personal Details 
		if (document.personalloan_form.Name.value=="")
			{
				document.getElementById('FullNameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name!</span>";
				document.personalloan_form.Name.focus();
				return false;
			}
		if (document.personalloan_form.Phone.value=="")
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
				document.personalloan_form.Phone.focus();
				return false;
			}
			
		if(isNaN(document.personalloan_form.Phone.value)|| document.personalloan_form.Phone.value.indexOf(" ")!=-1)
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
				document.personalloan_form.Phone.focus();
				return false;  
			}
		if (document.personalloan_form.Phone.value.length < 10 )
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
				document.personalloan_form.Phone.focus();
				return false;
			}
		if ((document.personalloan_form.Phone.value.charAt(0)!="9") && (document.personalloan_form.Phone.value.charAt(0)!="8") && (document.personalloan_form.Phone.value.charAt(0)!="7"))
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
				document.personalloan_form.Phone.focus();
				return false;
			}
								
		if ((document.personalloan_form.City.value=="") || (document.personalloan_form.City.value=="Please Select"))
			{
				document.getElementById('City2Val').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
				document.personalloan_form.City.focus();
				return false;
			}								
				
	var str=document.personalloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
		{
			document.getElementById('EmailIDVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
			document.personalloan_form.Email.focus();
			return false;
		}
	else if(bb==-1)
		{
			document.getElementById('EmailIDVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
			document.personalloan_form.Email.focus();
			return false;
		}
		if (document.personalloan_form.Age.value=="")
			{
				document.getElementById('AgeVal').innerHTML = "<span  class='hintanchor'>Please Select Age!</span>";
				document.personalloan_form.Age.focus();
				return false;
			}
}
function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}