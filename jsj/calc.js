

function calculateamortization(emiTenure,emiPrincipal,month_emi,emiRate,emi){
    //var dayValue = document.getElementById('installmentDay').value;
	
	var yearValue = emiTenure/12;
	var monthValue = yearValue * 12;
	var loanAmt = emiPrincipal;
	var tenure = emiTenure;
	var interestRate = emiRate * 12 *100;
	
	
	
	if(loanAmt!="" && tenure!="" && loanAmt!=0 && tenure!=0 && interestRate!="" && monthValue!="" && monthValue!=0 && yearValue!="" && yearValue!=0)
	{
	
	
	alert(interestRate);
	
		document.getElementById('paymentsDetails').style.display="block";
		//var loanAmt=formObj.loanAmt.value;
		var emi=calcEMI(loanAmt,interestRate,tenure);
		var interestRate=formObj.interestRate.value;
		var interestRateForMonth = interestRate/12; // (Monthly Rate of Interest in %)
		var interestRateForMonthFraction = interestRateForMonth/100; // (Monthly Interest Rate expressed as a fraction)
		
		var loanOustanding=loanAmt;
		var totalPayment=0;
		var totalInterestPortion=0;
		var totalPrincipal=0;
		var strData="<table border='0' cellspacing='1'  bgcolor='#d5cfb1' cellpadding='1'><tr><td width='14%' align='center' bgcolor='#88a943' class='tblwt_txt' height='22'>Installment No</td><td width='14%'  align='center' bgcolor='#88a943' class='tblwt_txt' height='22'>Installment Date</td><td width='14%'  align='center' bgcolor='#88a943' class='tblwt_txt' height='22'>Opening Balance</td><td width='14%'  align='center' bgcolor='#88a943' class='tblwt_txt' height='22'>EMI</td><td width='14%'  align='center' bgcolor='#88a943' class='tblwt_txt' height='22'><strong>Loan Outstanding</strong></td><td width='14%'  align='center' bgcolor='#88a943' class='tblwt_txt' height='22'>Interest</td><td width='14%'  align='center' bgcolor='#88a943' class='tblwt_txt' height='22'>Principal</td></tr>";
		for(i=1;i<=formObj.tenure.value;i++)
		{
			
		  if(monthValue!=0)
		       month = parseInt(monthValue) + parseInt(i) - 1;
		 else
		      month = parseInt(month) + 1;
		  if(month>12)
		  {
		      year = parseInt(yearValue) + 1;
		      yearValue = year;
		      monthValue = 0;
		      month = parseInt(monthValue) + 1;
		  }else{
              year = yearValue;
		  }
		  
		  if(month<10)
    	  {
    	       var installmentDate = '0'+month+'/'+year;
    	  }else
    	  {
    	       var installmentDate = month+'/'+year;
    	  }
		  
	  		   
				if(loanOustanding==loanAmt){
					loanOustanding=loanAmt;
					strData +='<tr><td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowInstallmentNo'+i+'" ><strong>'+i+'</strong></td>';
					strData +='<td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowInstallmentDate'+i+'"><strong>'+installmentDate+'</strong></td>';
					strData +='<td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowOpeningBalance'+i+'"><strong>'+getFormattedNumber(loanOustanding)+'</strong></td>';
					strData +='<td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowPayment'+i+'"><strong>'+getFormattedNumber(emi)+'</strong></td>';
					totalPayment = parseFloat(totalPayment) + parseFloat(emi);
					interestPortion = loanOustanding * interestRateForMonthFraction;
					interestPortion = roundDecimals(interestPortion,0);
					
				}else{
				    strData +='<tr><td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowInstallmentNo'+i+'">'+i+'</td>';
					strData +='<td class="tbl_txt" bgcolor="#FFFFFF" id="txtRowInstallmentDate'+i+'">'+installmentDate+'</td>';
					strData +='<td class="tbl_txt" bgcolor="#FFFFFF" id="txtRowOpeningBalance'+i+'">'+getFormattedNumber(loanOustanding)+'</td>';
					strData +='<td class="tbl_txt" bgcolor="#FFFFFF" id="txtRowPayment'+i+'">'+getFormattedNumber(emi)+'</td>';
					totalPayment = parseFloat(totalPayment) + parseFloat(emi);
					interestPortion = loanOustanding * interestRateForMonthFraction;
					interestPortion = roundDecimals(interestPortion,0);
					
				}
				
				loanOustanding = parseFloat(loanOustanding)+parseFloat(interestPortion)-parseFloat(emi);
				loanOustanding = roundDecimals(loanOustanding,0);
				if(i==1){
    				strData +='<td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowloanOustanding'+i+'"><strong>'+getFormattedNumber(loanOustanding)+'</strong></td>';
    				strData +='<td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowintrestPortion'+i+'"><strong>'+getFormattedNumber(interestPortion)+'</strong></td>';
				}else{
                    strData +='<td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowloanOustanding'+i+'"><strong>'+getFormattedNumber(loanOustanding)+'</strong></td>';
    				strData +='<td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowintrestPortion'+i+'">'+getFormattedNumber(interestPortion)+'</td>';				    
				}
				totalInterestPortion = parseFloat(totalInterestPortion) + parseFloat(interestPortion);
				principal = roundDecimals(emi-interestPortion,0);
				if(i==1){
    				strData +='<td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowprincipalPortion'+i+'"><strong>'+getFormattedNumber(principal)+'</strong></td></tr>';
				}else{
                    strData +='<td  class="tbl_txt" bgcolor="#FFFFFF" id="txtRowprincipalPortion'+i+'">'+getFormattedNumber(principal)+'</td></tr>';				    
				}
				totalPrincipal = parseFloat(totalPrincipal) + parseFloat(principal);
					
		}
		strData+="<tr><td  class='tbl_txt' bgcolor='#FFFFFF' >Total:</td><td bgcolor='#FFFFFF'></td><td  bgcolor='#FFFFFF' class='tbl_txt'></td><td bgcolor='#FFFFFF' class='tbl_txt'>"+getFormattedNumber(totalPayment)+"</td><td bgcolor='#FFFFFF' class='tbl_txt'></td><td bgcolor='#FFFFFF' class='tbl_txt'>"+getFormattedNumber(totalInterestPortion)+"</td><td bgcolor='#FFFFFF' class='tbl_txt'>"+getFormattedNumber(totalPrincipal)+"</td></tr></table>";
		if(parseInt(formObj.installment.value) > parseInt(formObj.tenure.value) || parseInt(formObj.installment.value)==0){
				document.getElementById('tblinstallmentDetails').style.display="none";	
				alert('The Installment must be less than or equal to the Tenure')		
		}
		document.getElementById('tblpaymentsDetails').innerHTML=strData;
		for(i=1;i<=formObj.tenure.value;i++)
		{
    		if(i==formObj.installment.value)
        	{
        	    document.getElementById('tblinstallmentDetails').style.display="block";
        		document.getElementById('openingBalance').innerHTML=document.getElementById('txtRowOpeningBalance'+i).innerHTML;
        		document.getElementById('payment').innerHTML=document.getElementById('txtRowPayment'+i).innerHTML;
        		document.getElementById('loanOustanding').innerHTML=document.getElementById('txtRowloanOustanding'+i).innerHTML;
        		document.getElementById('intrestPortion').innerHTML=document.getElementById('txtRowintrestPortion' + i).innerHTML;
        		document.getElementById('principalPortion').innerHTML=document.getElementById('txtRowprincipalPortion' + i).innerHTML;
        		document.getElementById('installmentNumber').innerHTML=document.getElementById('txtRowInstallmentNo' + i).innerHTML;
        		document.getElementById('installmentDate').innerHTML=document.getElementById('txtRowInstallmentDate' + i).innerHTML;
        	}
		}
	}
}


function calcEMI(loanAmt,interestRate,tenure){
	if(parseFloat(interestRate)!=0){
		var interestRateForMonth = interestRate/12; // (Monthly Rate of Interest in %)
		var interestRateForMonthFraction = interestRateForMonth/100; // (Monthly Interest Rate expressed as a fraction)
		var emi =1/Math.pow((1+interestRateForMonthFraction),tenure);
		var emiPerLakh = (loanAmt*interestRateForMonthFraction)/(1 - emi) // (EMI per lakh borrowed)
		emiPerLakh = roundDecimals(emiPerLakh, 0);
		return emiPerLakh;
	}else{
		var emi = loanAmt / tenure;
		var emiPerLakh = roundDecimals(emi, 0);
		return emiPerLakh;
	}
}