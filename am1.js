function commitData(loanAmount,intRate,numPay) {
  // Declair and initialize the variables
  var eleId;
  var eleDat;
  var loopNum;
  var tagNum;
  var tagNam;
  var displayData;	
 
 // Render the display tables to echo the user input
 displayData ="<table>";
  displayData +="<tr>";
  // Render the amortization table, this table displays the number of
  // rows specified by the number of payments input by the user in the numPay field.
  displayData +="<td><table style=' clear: both;    background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; ' id='pmtTab'><tr style='background: #e7f2f9;'><td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:90px; font: 12px Arial, Helvetica, sans-serif;' id='numHead'>Year</td><td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif;' id='pt'>Principal</td><td id='newBal' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif;'>Interest</td><td id='oil' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; width:250px; font: 12px Arial, Helvetica, sans-serif;'>Balance Amount</td></tr>";
for(var i=1;i<=numPay;i++) {
    loopNum=i;
	 var counter = i%12;
	 if(counter==0)
	{
	  var count = i/12;
	  
	
	 displayData +="<tr ><td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id=tagNam>"+count+"</td>";
	 
//	tagNam="b"+loopNum.toString(10);
  //  displayData +="<td id="+tagNam+"></td>";
    
	tagNam="p"+loopNum.toString(10);
    displayData +="<td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id="+tagNam+"></td>"; 
    
	tagNam="oi"+loopNum.toString(10);
    displayData +="<td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id="+tagNam+"></td>";
    
	tagNam="nb"+loopNum.toString(10);
    displayData +="<td style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id="+tagNam+"></td>";
    
//	tagNam="ti"+loopNum.toString(10);
  //  displayData +="<td id="+tagNam+"></td></tr>";
	}
  }
  // This statement outside the loop completes the table
  displayData +="</table></td></tr></table>";
  // Echo the input in the display table using the displayTableField() function
  //Calculate and display the monthly payment amount
document.getElementById('tblpaymentsDetails').innerHTML=displayData;

var monPmt=calcMonthly(loanAmount,numPay,intRate);
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
  var dispInt;
  var  yearlyVal = new Array();
  var intRateVal = new Array(); 
  // The for loop performs the amortization
  for(var i=1;i<=numPay;i++) {
	  var counter = i%12;
    var loopNum=i;
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
	
	yearlyVal.push(monthly);
	intRateVal.push(dispInt);
	
	if(counter==0)
	{
		var finalMonthlySum = number_format(getSum(yearlyVal));
		var finalintRateSum = number_format(getSum(intRateVal));
		tagNam="p"+loopNum.toString(10);
		displayTableField(tagNam,finalMonthlySum);
		tagNam="oi"+loopNum.toString(10);
		displayTableField(tagNam,finalintRateSum);
		tagNam="nb"+loopNum.toString(10);
		displayTableField(tagNam,number_format(newBalance));
		yearlyVal = new Array();
		intRateVal = new Array();
		
	}
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
  var twoDec=chgVar.toFixed(0);
  return twoDec;
}


function getSum(ups){

var i;
var sum=0;
    for(i=0;i<ups.length; i++)
    {
		if(ups[i])
        {
			sum = parseInt(sum) + parseInt(ups[i]);
		}
	}
	
    return twoDecimal(sum);
}


function amortizePmtsCharts(loanAmount,intRate,numPay,monPmt) {
  var oldBalance=loanAmount;
  var newBalance=loanAmount;               
  intRate=(intRate/100)/12;            
  var monthly=monPmt;
  var owedInterest=0;
  var totalInterestPd=0;
  var tagNam;
  var dispInt;
  var  yearlyVal = new Array();
  var intRateVal = new Array(); 
  
  var principalPut = new Array(); 
  var emiPut = new Array();   
  var balancePut = new Array(); 
  var returnVal = new Array();
  var counterVal = new Array();
  
  // The for loop performs the amortization
  for(var i=1;i<=numPay;i++) {
	  var counter = i%12;
    var loopNum=i;
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
	
	yearlyVal.push(monthly);
	intRateVal.push(dispInt);
	if(counter==0)
	{
		var count = i/12;
		var countVal = "Year "+count;
		var finalMonthlySum = parseInt(getSum(yearlyVal));
		var finalintRateSum = parseInt(getSum(intRateVal));
  		yearlyVal = new Array();
		intRateVal = new Array();
		principalPut.push(finalMonthlySum);
		emiPut.push(finalintRateSum);   
		balancePut.push(newBalance);
		counterVal.push(countVal);
//		counterVal

	}
  }
  
  returnVal.push(principalPut);
  returnVal.push(emiPut);
  returnVal.push(counterVal);
  
  
  return returnVal;
}


function number_format (number, decimals, dec_point, thousands_sep) {
   number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return "Rs. "+s.join(dec);
}