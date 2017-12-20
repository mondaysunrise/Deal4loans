function commitData(loanAmount,intRate,numPay) {
  // Declair and initialize the variables
  var eleId;
  var eleDat;
  var loanName="Upendra";
  var loopNum;
  var tagNum;
  var tagNam;
 
 // Render the display tables to echo the user input
 displayData ="<table>";
  displayData +="<tr>";
  // Render the amortization table, this table displays the number of
  // rows specified by the number of payments input by the user in the numPay field.
  displayData +="<td><table id='pmtTab' style=' clear: both;    background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; '><tr style='background: #e7f2f9;'><td id='numHead' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif;'>Installment No</td><td id='oldBal' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif;'>Opening Balance</td><td id='pt' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif;'>Principal</td><td id='oil' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif;'>Interest </td><td id='newBal' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif;'>Loan Outstanding</td><td id='til' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif;'>Total Interest paid</td></tr>";
for(var i=1;i<=numPay;i++) {
    loopNum=i;
	 var counter = i%12;

    	tagNam="n"+loopNum.toString(10);
      var count = i/12;
	
	 displayData +="<tr ><td style='border: 1px solid #DBDAD7;background: #fffff; border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id=tagNam>"+i+"</td>";
	
    tagNam="b"+loopNum.toString(10);
    displayData +="<td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id="+tagNam+"></td>";
    tagNam="p"+loopNum.toString(10);
    displayData +="<td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id="+tagNam+"></td>"; 
    tagNam="oi"+loopNum.toString(10);
    displayData +="<td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id="+tagNam+"></td>";
    tagNam="nb"+loopNum.toString(10);
    displayData +="<td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id="+tagNam+"></td>";
    tagNam="ti"+loopNum.toString(10);
    displayData +="<td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id="+tagNam+"></td></tr>";
  }
  // This statement outside the loop completes the table
  displayData +="</table></td></tr></table>";
  // Echo the input in the display table using the displayTableField() function
  //Calculate and display the monthly payment amount
document.getElementById('tblpaymentsDetails').innerHTML=displayData;
  //Calculate and display the monthly payment amount
  var monPmt=calcMonthly(loanAmount,numPay,intRate);
  // Call the amortization routine
  amortizePmts(loanAmount,intRate,numPay,monPmt);
  return;
}
 
function amortizePmts(loanAmount,intRate,numPay,monPmt) {
  var oldBalance=loanAmount;
  var newBalance=loanAmount;               
  intRate=(intRate/100)/12;            
  var monthly=monPmt;
  var owedInterest=0;
  var totalInterestPd=0;
  var tagNam;
  var dispInt
  // The for loop performs the amortization
  for(var i=1;i<=numPay;i++) {
    var loopNum=i;
	 var counter = i%12;
    owedInterest=newBalance*intRate;
    dispInt=twoDecimal(owedInterest);
    totalInterestPd=totalInterestPd+owedInterest;
    // Test for the final payment
    if (i<numPay) {
      monthly=twoDecimal(monPmt-dispInt);
      oldBalance=newBalance;
      newBalance=twoDecimal(oldBalance-monthly);
    }
    else {
      monthly=(oldBalance-monthly)+owedInterest;
      oldBalance=newBalance;
      newBalance=0;
      monthly=twoDecimal(monthly);
    }

	
    tagNam="b"+loopNum.toString(10);
    displayTableField(tagNam,oldBalance);
    tagNam="p"+loopNum.toString(10);
    displayTableField(tagNam,monthly);
    tagNam="oi"+loopNum.toString(10);
    displayTableField(tagNam,dispInt);
    tagNam="nb"+loopNum.toString(10);
    displayTableField(tagNam,newBalance);
    tagNam="ti"+loopNum.toString(10);
    displayTableField(tagNam,twoDecimal(totalInterestPd));
	
  }
  return;
}
 
function displayTableField(eleId,eleDat) {
  document.getElementById(eleId).innerHTML=eleDat;
  return;
}
 
function calcMonthly(principal,numPay,intRate) {
  var monthly;
  var intRate=(intRate/100)/12;
  var principal;
  // The accounting formula to calculate the monthly payment is
  //    M = P * ((I + 1)^N) * I / (((I + 1)^N)-1)
  // The following code  transforms this accounting formula into JavaScript to calculate the monthly payment
  monthly=(principal*(Math.pow((1+intRate),numPay))*intRate/(Math.pow((1+intRate),numPay)-1));
  return twoDecimal(monthly);
}
 
function twoDecimal(chgVar) {
  var chgVar;
  var twoDec=chgVar.toFixed(1);
  return twoDec;
}