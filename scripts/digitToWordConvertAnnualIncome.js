function getDigitToWords(e,t,n){var r="Rs.";var i=".";var s="Annual Income";var o=document.getElementById(e).value;var u=Math.round(document.getElementById(e).value*12);if(o&&o!=0){var a=digitToWordConvertor(o);var f=monthlydigitToWordConvertor(u);if(a!="undefined"){if(a!=""&&e=="Net_Salary"){formattedMonthNumber=getFormattedNumber(u);a=r+" "+a+" "+i+"<br/><br/>"+s+"<br/>"+formattedMonthNumber+"<br>"+f+i;formattedNumber=getFormattedNumber(o);document.getElementById(t).style.display="block";document.getElementById(n).style.display="block";document.getElementById(t).innerHTML=formattedNumber;document.getElementById(n).innerHTML=a}else if(a!=""&&e=="IncomeAmount"){formattedMonthNumber=getFormattedNumber(u);a=r+" "+a+" "+i+"<br/><br/>"+s+"<br/>"+formattedMonthNumber+"<br>"+f+i;formattedNumber=getFormattedNumber(o);document.getElementById(t).style.display="block";document.getElementById(n).style.display="block";document.getElementById(t).innerHTML=formattedNumber;document.getElementById(n).innerHTML=a}else if(a!=""&&e=="hlnet_salary"){formattedMonthNumber=getFormattedNumber(u);a=r+" "+a+" "+i+"<br/><br/>"+s+"<br/>"+formattedMonthNumber+"<br>"+f+i;formattedNumber=getFormattedNumber(o);document.getElementById(t).style.display="block";document.getElementById(n).style.display="block";document.getElementById(t).innerHTML=formattedNumber;document.getElementById(n).innerHTML=a}else if(a!=""&&e=="plnet_salary"){formattedMonthNumber=getFormattedNumber(u);a=r+" "+a+" "+i+"<br/><br/>"+s+"<br/>"+formattedMonthNumber+"<br>"+f+i;formattedNumber=getFormattedNumber(o);document.getElementById(t).style.display="block";document.getElementById(n).style.display="block";document.getElementById(t).innerHTML=formattedNumber;document.getElementById(n).innerHTML=a}else{a=r+" "+a+" "+i;formattedNumber=getFormattedNumber(o);document.getElementById(t).style.display="block";document.getElementById(n).style.display="block";document.getElementById(t).innerHTML=formattedNumber;document.getElementById(n).innerHTML=a}}else{document.getElementById(t).style.display="none";document.getElementById(n).style.display="none";document.getElementById(t).innerHTML="";document.getElementById(n).innerHTML=""}}else{document.getElementById(t).style.display="none";document.getElementById(n).style.display="none";document.getElementById(t).innerHTML="";document.getElementById(n).innerHTML=""}}function digitToWordConvertor(e){try{var e=getRoundedAmount(e);var t=convertCrores(e);return t}catch(n){}}function monthlydigitToWordConvertor(e){try{var e=getRoundedAmount(e);var t=convertCrores(e);return t}catch(n){}}function convertCrores(e){try{var t;if(e<1e9){if(e/1e7>=1){t=convertTens(e/1e7)+" crores";if(e<1e8){var n=String(e)+" ";n=n.slice(1,-1);t=t+convertLakhs(n)}else{var n=String(e)+" ";n=n.slice(2,-1);t=t+convertLakhs(n)}}else{t=convertLakhs(e)}}else{}return String(t)}catch(r){}}function convertLakhs(e){try{var t;if(e<1e7){if(e/1e5>=1){t=convertTens(e/1e5)+" lakh(s)";if(e<1e6){var n=String(e)+" ";n=n.slice(1,-1);t=t+convertThousund(n%1e5)}else{var n=String(e)+" ";n=n.slice(2,-1);t=t+convertThousund(n%1e6)}}else{if(e<1e5){t=convertThousund(e%1e5)}else{t=convertThousund(e%1e6)}}}return String(t)}catch(r){}}function convertThousund(e){try{var t;if(e<1e5){if(e/1e3>=1){t=convertTens(e/1e3)+" thousand";if(e<1e4){var n=String(e)+" ";n=n.slice(1,-1);t=t+convertHundred(n%1e3)}else{var n=String(e)+" ";n=n.slice(2,-1);t=t+convertHundred(n%1e4)}}else{if(e<1e3){t=convertHundred(e%1e3)}else{t=convertHundred(e%1e4)}}}else{}return String(t)}catch(r){}}function convertHundred(e){try{var t;if(e<1e3){if(e/100>=1){t=convertDigit(e/100)+" hundred";var n=String(e)+" ";n=n.slice(1,-1);t=t+convertTwoDigits(n)}else{t=convertTwoDigits(e)}}else{}return t}catch(r){}}function convertTwoDigits(e){try{var t;if(e<100){if(e>=10){t=convertTens(e)+" ";var n=String(e)+" ";n=n.slice(3,-1);t=t+convertDecimals(n)}else{t=convertTens(e)+" ";var r=String(e)+" ";r=r.slice(2,-1);t=t+convertDecimals(r)}}else{}return t}catch(i){}}function convertTens(e){try{var t;if(e<100){if(e>=10){if(e>=10&&e<=19){if(e>=10&&e<11){t=" ten"}else if(e>=11&&e<12){t=" eleven"}else if(e>=12&&e<13){t=" twelve"}else if(e>=13&&e<14){t=" thirteen"}else if(e>=14&&e<15){t=" fourteen"}else if(e>=15&&e<16){t=" fifteen"}else if(e>=16&&e<17){t=" sixteen"}else if(e>=17&&e<18){t=" seventeen"}else if(e>=18&&e<19){t=" eighteen"}else if(e>=19&&e<20){t=" nineteen"}}else{var n;n=e/10;if(n>=2&&n<3){t=" twenty"}else if(n>=3&&n<4){t=" thirty"}else if(n>=4&&n<5){t=" forty"}else if(n>=5&&n<6){t=" fifty"}else if(n>=6&&n<7){t=" sixty"}else if(n>=7&&n<8){t=" seventy"}else if(n>=8&&n<9){t=" eighty"}else if(n>=9){t=" ninety"}else if(n>=0){t=""}t=t+""+convertDigit(e%10)}}else{t=convertDigit(e)}}else{}return t}catch(r){}}function convertDigit(e){try{var t;if(e>=0&&e<1){t=""}else if(e>=1&&e<2){t=" one"}else if(e>=2&&e<3){t=" two"}else if(e>=3&&e<4){t=" three"}else if(e>=4&&e<5){t=" four"}else if(e>=5&&e<6){t=" five"}else if(e>=6&&e<7){t=" six"}else if(e>=7&&e<8){t=" seven"}else if(e>=8&&e<9){t=" eight"}else if(e>=9&&e<20){t=" nine"}return t}catch(n){}}function convertDecimals(e){try{var t;if(e!="00"){t=""}else{t=""}return t}catch(n){}}function getRoundedAmount(e){var t=2;var n=e*Math.pow(10,t);var r=Math.round(n);var i=r/Math.pow(10,t);return i.toString()}function pad_with_zeros(e,t){var n=e.toString();var r=n.indexOf(".");if(r==-1){decimal_part_length=0;n+=t>0?".":""}else{decimal_part_length=n.length-r-1}var i=t-decimal_part_length;if(i>0){for(var s=1;s<=i;s++)n+="0"}return n}function makeComma(e){if(e.length<=2){return e}length1=e.substr(0,e.length-2);formattedInput=makeComma(length1)+","+e.substring(e.length-2,e.length);return formattedInput}function getFormattedNumber(e){e=getRoundedAmount(e);number=e;if(number.length>3&&number.length<=12){var t=number.substring(number.length-3,number.length);var n=number.substring(0,number.length-3);var r=makeComma(n);r="Rs. "+r+","+t;return r}return"Rs. "+number}function getAnnualIncome(e,t,n,r){var i="Rs.";var s=".";var o=document.getElementById(e).value;if(o&&o!=0){o=o*12;var u=digitToWordConvertor(o);if(u!="undefined"){if(u!=""){u=i+" "+u+" "+s;formattedNumber=getFormattedNumber(o);document.getElementById(t).style.display="block";document.getElementById(n).style.display="block";document.getElementById(t).innerHTML=formattedNumber;document.getElementById(n).innerHTML=u;document.getElementById(r).style.display="block"}}else{document.getElementById(t).style.display="none";document.getElementById(n).style.display="none";document.getElementById(t).innerHTML="";document.getElementById(n).innerHTML=""}}else{document.getElementById(t).style.display="none";document.getElementById(n).style.display="none";document.getElementById(t).innerHTML="";document.getElementById(n).innerHTML=""}}function getDiToWordsIncome(e,t,n){var r="Rs.";var i=".";var s="Annual Income";var o=document.getElementById(e).value;var u=Math.round(document.getElementById(e).value*12);if(o&&o!=0){var a=digitToWordConvertor(o);var f=monthlydigitToWordConvertor(u);if(a!="undefined"){a=r+" "+a+" "+i;formattedNumber=getFormattedNumber(o);document.getElementById(t).style.display="block";document.getElementById(n).style.display="block";document.getElementById(t).innerHTML=formattedNumber;document.getElementById(n).innerHTML=a}else{document.getElementById(t).style.display="none";document.getElementById(n).style.display="none";document.getElementById(t).innerHTML="";document.getElementById(n).innerHTML=""}}else{document.getElementById(t).style.display="none";document.getElementById(n).style.display="none";document.getElementById(t).innerHTML="";document.getElementById(n).innerHTML=""}}