/**************** Actual Display Numbers into Word Start ***************/
function getDigitToWords(field,formattednoId,wordId){
	
		var RS_PREFIX = "Rs.";
		var ONLY_SUFFIX =".";
		//alert(field);
		var MONTHLY_SUFFIX ="Monthly Income";
		var fieldvalue = document.getElementById(field).value;
		var fieldmonthlyvalue = Math.round((document.getElementById(field).value)/12);
		
		if(fieldvalue && fieldvalue!=0){
			var result = digitToWordConvertor(fieldvalue);
			var monthlyresult = monthlydigitToWordConvertor(fieldmonthlyvalue);
			if(result != 'undefined'){
				if(result!="" && field=="Net_Salary"){
					formattedMonthNumber = getFormattedNumber(fieldmonthlyvalue);
					result = RS_PREFIX + " " + result + " " + ONLY_SUFFIX + "<br/><br/>" + MONTHLY_SUFFIX + "<br/>" + formattedMonthNumber  + "<br>" + monthlyresult + ONLY_SUFFIX;
				
					formattedNumber = getFormattedNumber(fieldvalue);
					document.getElementById(formattednoId).style.display="block";
					document.getElementById(wordId).style.display="block";
					document.getElementById(formattednoId).innerHTML=formattedNumber;
					document.getElementById(wordId).innerHTML=result;
				}
				else if(result!="" && field=="IncomeAmount"){
					formattedMonthNumber = getFormattedNumber(fieldmonthlyvalue);
					//result = RS_PREFIX + " " + result + " " + ONLY_SUFFIX + "<br/><br/>" + MONTHLY_SUFFIX + "<br/>" + formattedMonthNumber + "<br>" + monthlyresult + ONLY_SUFFIX;
					result = RS_PREFIX + " " + result + " " + ONLY_SUFFIX + "<br/>";
					formattedNumber = getFormattedNumber(fieldvalue);
					document.getElementById(formattednoId).style.display="block";
					document.getElementById(wordId).style.display="block";
					document.getElementById(formattednoId).innerHTML=formattedNumber;
					document.getElementById(wordId).innerHTML=result;

				}
			else
				{
					result = RS_PREFIX + " " + result + " " + ONLY_SUFFIX;
					formattedNumber = getFormattedNumber(fieldvalue);
					document.getElementById(formattednoId).style.display="block";
					document.getElementById(wordId).style.display="block";
					document.getElementById(formattednoId).innerHTML=formattedNumber;
					document.getElementById(wordId).innerHTML=result;
				}
				
			}else{
					document.getElementById(formattednoId).style.display="none";
					document.getElementById(wordId).style.display="none";
					document.getElementById(formattednoId).innerHTML="";
					document.getElementById(wordId).innerHTML="";
			}
			
		}else{
				document.getElementById(formattednoId).style.display="none";
				document.getElementById(wordId).style.display="none";
				document.getElementById(formattednoId).innerHTML="";
				document.getElementById(wordId).innerHTML="";
		}
}
	
/**************** Actual Display Numbers into Word End ***************/	

function digitToWordConvertor(number)
{
	try
	{
		var number = getRoundedAmount(number);
		//alert (number);
		var result = convertCrores(number);
		
		return result;
	}
	catch (ex)
	{
		
	}
}
/***********************************************************/
function monthlydigitToWordConvertor(number)
{
	try
	{
		var number = getRoundedAmount(number);
		//alert (number);
		var result = convertCrores(number);
		
		return result;
	}
	catch (ex)
	{
		
	}
}
/**************** Converts numbers to word upto Crores Start ***************/
function convertCrores(number)
{
	try
	{
		var result;
		if (number < 1000000000)
		{
			if (number/10000000 >= 1)
			{
				result = convertTens(number/10000000) + " crores";
				if (number < 100000000)
				{
					var crores = String(number)+" ";
					crores = crores.slice(1,-1);
					
					result = result + convertLakhs(crores);
				}else{
					var crores = String(number)+" ";
					crores = crores.slice(2,-1);
					
					result = result + convertLakhs(crores);
				}
			}else{
				result = convertLakhs(number);
			}
		}else{
			
		}
		return String(result);
	}
	catch (ex)
	{
		
	}
}
/**************** Converts numbers to word upto Crores End ***************/

/**************** Converts numbers to word upto Lakhs start ***************/
function convertLakhs(number)
{
	
	try
	{
		var result;
		if (number < 10000000)
		{
			
			if (number/100000 >= 1)
			{
				
				result = convertTens(number/100000) + " lakh(s)";
				if (number < 1000000)
				{
					
					var lakhs = String(number)+" ";
					lakhs = lakhs.slice(1,-1);
					result = result + convertThousund(lakhs%100000);
				}else{
				
					var lakhs = String(number)+" ";
					lakhs = lakhs.slice(2,-1);
					result = result + convertThousund(lakhs%1000000);
				}
			}else{
				if (number < 100000)
				{
					result = convertThousund(number%100000);
				}else{
					result = convertThousund(number%1000000);
					
				}
				
			}
		}
		return String(result);
	}
	catch (ex)
	{
		
	}
}
/**************** Converts numbers to word upto Lakhs End ***************/

/**************** Converts numbers to word upto Thousands Start ***************/
function convertThousund(number)
{
	
	try
	{
		var result;
		
		if (number < 100000)
		{
			if (number/1000 >= 1)
			{
				result = convertTens(number/1000) + " thousand";
				if (number < 10000)
				{
					var thousunds = String(number)+" ";
					thousunds = thousunds.slice(1,-1);
					result = result + convertHundred(thousunds%1000);
				}else{
					var thousunds = String(number)+" ";
					thousunds = thousunds.slice(2,-1);
					result = result + convertHundred(thousunds%10000);
				}
			}else{
				if (number < 1000)
				{
					result = convertHundred(number%1000);
				}else{
					result = convertHundred(number%10000);
					
				}
			}
		}else{
		}
		return String(result);
	}
	catch (ex)
	{
	}
}
/**************** Converts numbers to word upto Thousands End ***************/

/**************** Converts numbers to word upto Hundred Start ***************/
function convertHundred(number)
{
	
	try
	{
		var result;
		if (number < 1000)
		{
			if (number/100 >= 1)
			{
				result = convertDigit(number/100) + " hundred";
				var tens = String(number)+" ";
				tens = tens.slice(1,-1);
				
				result = result + convertTwoDigits(tens);
			}else{
				
				result = convertTwoDigits(number);
			}
		}else{

		}
		return result;
	}
	catch (ex)
	{

	}
}
/**************** Converts numbers to word upto Hundred End ***************/

/**************** Converts numbers to word upto TwoDigits Start ***************/
function convertTwoDigits(number)
{
	
	try
	{
		var result;
		if (number < 100)
		{
			if (number >= 10)
			{
				result = convertTens(number) + " ";
				var tens1 = String(number)+" ";
				tens1 = tens1.slice(3,-1);
				result = result + convertDecimals(tens1);
			}else{
				result = convertTens(number) + " ";
				var tens2 = String(number)+" ";
				tens2 = tens2.slice(2,-1);
				result = result + convertDecimals(tens2);
			}
		}else{

		}
		return result;
	}
	catch (ex)
	{

	}
}
/**************** Converts numbers to word upto TwoDigits End ***************/

/**************** Converts numbers to word upto Tens Start ***************/
function convertTens(number)
{
	
	try
	{
		 var convertTensResult;
		 if (number < 100)
		 {
			 if (number >= 10)
			 {
				if (number >= 10 && number <= 19)
				{
					if (number >= 10 && number < 11)
					{
						convertTensResult = " ten";
					}
					else if (number >= 11 && number < 12)
					{
						convertTensResult = " eleven";
					}
					else if (number >= 12 && number < 13)
					{
						convertTensResult = " twelve";
					}
					else if (number >= 13 && number < 14)
					{
						convertTensResult = " thirteen";
					}
					else if (number >= 14 && number < 15)
					{
						convertTensResult = " fourteen";
					}
					else if (number >= 15 && number < 16)
					{
						convertTensResult = " fifteen";
					}
					else if (number >= 16 && number < 17)
					{
						convertTensResult = " sixteen";
					}
					else if (number >= 17 && number < 18)
					{
						convertTensResult = " seventeen";
					}
					else if (number >= 18 && number < 19)
					{
						convertTensResult = " eighteen";
					}
					else if (number >= 19 && number < 20)
					{
						convertTensResult = " nineteen";
					}
					
				}
				else
				{
					var digitAtTen;
					digitAtTen = number/10;

					if (digitAtTen >= 2 && digitAtTen < 3)
					{
						convertTensResult = " twenty";
					}
					else if (digitAtTen >= 3 && digitAtTen < 4)
					{
						convertTensResult = " thirty";
					}
					else if (digitAtTen >= 4 && digitAtTen < 5)
					{
						convertTensResult = " forty";
					}
					else if (digitAtTen >= 5 && digitAtTen < 6)
					{
						convertTensResult = " fifty";
					}
					else if (digitAtTen >= 6 && digitAtTen < 7)
					{
						convertTensResult = " sixty";
					}
					else if (digitAtTen >= 7 && digitAtTen < 8)
					{
						convertTensResult = " seventy";
					}
					else if (digitAtTen >= 8 && digitAtTen < 9)
					{
						convertTensResult = " eighty";
					}
					else if (digitAtTen >= 9)
					{
						convertTensResult = " ninety";
					}
					else if (digitAtTen >= 0)
					{
						convertTensResult = ""; 
					}
					convertTensResult = convertTensResult +""+ convertDigit(number % 10);
				}
			 }else{
				convertTensResult = convertDigit(number);
			 }
		 }else{

		 }
		 return convertTensResult;
	}
	catch (ex)
	{

	}
}
/**************** Converts numbers to word upto Tens End ***************/

/**************** Converts Digit Start ***************/
function convertDigit(number)
{
	try
	{
		var convertDigitResult
			if (number >= 0 && number < 1)
			{
				convertDigitResult = "";
			}
			else if (number >= 1 && number < 2)
			{
				convertDigitResult = " one";
			}
			else if (number >= 2 && number < 3)
			{
				convertDigitResult = " two";
			}
			else if (number >= 3 && number < 4)
			{
				convertDigitResult = " three";
			}
			else if (number >= 4 && number < 5)
			{
				convertDigitResult = " four";
			}
			else if (number >= 5 && number < 6)
			{
				convertDigitResult = " five";
			}
			else if (number >= 6 && number < 7)
			{
				convertDigitResult = " six";
			}
			else if (number >= 7 && number < 8)
			{
				convertDigitResult = " seven";
			}
			else if (number >= 8 && number < 9)
			{
				convertDigitResult = " eight";
			}
			else if (number >= 9 && number < 20)
			{
				convertDigitResult = " nine";
			}
		return convertDigitResult;
	}
	catch (ex)
	{

	}
}
/**************** Converts Digit End ***************/

/**************** Converts decimal Start ***************/
function convertDecimals(number)
{
	try
	{
		var result;
		if (number != '00')
		{
			result="";
		}else{
			result = "";

		}
		return result;
	}
	catch (ex)
	{

	}
}
/**************** Converts decimal End ***************/


/******************** Convert and round a number to two decimals Start****************/
function getRoundedAmount(original_number)
{
	var decimals = 2;
	var result1 = original_number * Math.pow(10, decimals)
    var result2 = Math.round(result1)
    var result3 = result2 / Math.pow(10, decimals)
    return result3.toString();
    
}
function pad_with_zeros(rounded_value, decimal_places) {

    // Convert the number to a string
    var value_string = rounded_value.toString()
    
    // Locate the decimal point
    var decimal_location = value_string.indexOf(".")

    // Is there a decimal point?
    if (decimal_location == -1) {
        
        // If no, then all decimal places will be padded with 0s
        decimal_part_length = 0
        
        // If decimal_places is greater than zero, tack on a decimal point
        value_string += decimal_places > 0 ? "." : ""
    }
    else {

        // If yes, then only the extra decimal places will be padded with 0s
        decimal_part_length = value_string.length - decimal_location - 1
    }
    
    // Calculate the number of decimal places that need to be padded with 0s
    var pad_total = decimal_places - decimal_part_length
    

    if (pad_total > 0) {
        
        // Pad the string with 0s
        for (var counter = 1; counter <= pad_total; counter++) 
            value_string += "0"
        }
    return value_string
}

function makeComma(inputNo){
		if(inputNo.length <=2){return inputNo;}
		length1 = inputNo.substr(0,(inputNo.length-2));
		formattedInput = makeComma(length1) + ',' + inputNo.substring(inputNo.length-2,inputNo.length);
		return formattedInput;
	}
	function getFormattedNumber(fieldvalue){
		//var fieldvalue = document.getElementById(field).value;
		fieldvalue = getRoundedAmount(fieldvalue);
		
		//number = fieldvalue.substr(0,fieldvalue.length-3);
		number = fieldvalue
		if(number.length >3 && number.length <= 12){
			var last3Digits = number.substring(number.length-3,number.length);
			var numExceptLastDigits =number.substring(0,number.length-3) 
			var formatted = makeComma(numExceptLastDigits);
			formatted = "Rs. " + formatted + "," + last3Digits ;
			return formatted;
		}
		return "Rs. " + number;
		
		
	}
/******************** Convert and round a number to two decimals End****************/

	

function getAnnualIncome(field,formattednoId,wordId,lableAnnaul)
{
	
		var RS_PREFIX = "Rs.";
		var ONLY_SUFFIX =".";
		var fieldvalue = document.getElementById(field).value;		
		if(fieldvalue && fieldvalue!=0){
			fieldvalue = fieldvalue * 12;
			var result = digitToWordConvertor(fieldvalue);
			if(result != 'undefined'){
				if(result!=""){
					result = RS_PREFIX + " " + result + " " + ONLY_SUFFIX;
					formattedNumber = getFormattedNumber(fieldvalue);
					document.getElementById(formattednoId).style.display="block";
					document.getElementById(wordId).style.display="block";
					document.getElementById(formattednoId).innerHTML=formattedNumber;
					document.getElementById(wordId).innerHTML=result;
					document.getElementById(lableAnnaul).style.display="block";					
				}
				
			}else{
					document.getElementById(formattednoId).style.display="none";
					document.getElementById(wordId).style.display="none";
					document.getElementById(formattednoId).innerHTML="";
					document.getElementById(wordId).innerHTML="";
			}
			
		}else{
				document.getElementById(formattednoId).style.display="none";
				document.getElementById(wordId).style.display="none";
				document.getElementById(formattednoId).innerHTML="";
				document.getElementById(wordId).innerHTML="";
		}
}