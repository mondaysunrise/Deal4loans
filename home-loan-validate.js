function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}

function cityother()
{
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
	}
} 
function Trim(strValue) 
{	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function containsdigit(param)
{mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}

function chkform()
{		
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var j;
	var cnt=-1;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}	
	if (document.loan_form.Net_Salary.value=="" || document.loan_form.Net_Salary.value=="Annual Income")
		{ 
		
			document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";
			document.loan_form.Net_Salary.focus();
		return false;
		}	
	if (document.loan_form.City.selectedIndex==0)
	{		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Select City to Continue!</span>";			document.loan_form.City.focus();		return false;	}
	
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	if(document.loan_form.Name.value=="" || document.loan_form.Name.value=="Full Name")
	{
		document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
   }

	if(document.loan_form.Email.value=="" || document.loan_form.Email.value=="E-mail Id")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
	
	if(document.loan_form.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span class='hintanchor'>Select Age!</span>";
		document.loan_form.Age.focus();
		return false;
	}
	
	if(isNaN(document.loan_form.Phone.value) || document.loan_form.Phone.value=="Mobile No." ||  document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter Mobile No.!</span>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	
	if (document.loan_form.property_value.value=="" || document.loan_form.property_value.value=="Property Value")
	{ document.getElementById('propertyValueVal').innerHTML = "<span  class='hintanchor'>Enter Property Value!</span>"; document.loan_form.property_value.focus();		return false;	}

	for(i=0; i<document.loan_form.Property_Identified.length; i++) 
	{
        if(document.loan_form.Property_Identified[i].checked)
		{
   	 		cnt= i;
		}
	}
		if(cnt == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
		if(cnt==0)
		{ 
			if(document.loan_form.Property_loc.selectedIndex==0)
			{
				document.getElementById('PropLocationVal').innerHTML = "<span class='hintanchor'>Plese select city where property is located</span>";
				document.loan_form.Property_loc.focus();
				return false;
			}
		}
	
	if(!document.getElementById("checkboxG2").checked)
	{
		document.getElementById('TermConditionVal').innerHTML = "<span class='hintanchor'>Please Check Term and condition to proceed.</span>";
		document.loan_form.accept.focus();
		return false;
	}
	
}  


function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = '<div class="form-input-wrapper form-box-left-margin"><div>Property Location</div> <div><select name="Property_loc" id="Property_loc" class="form-select" onchange="validateDiv(\'PropLocationVal\');"><option value="">Select your City</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Others">Others</option></select></div><div id="PropLocationVal"></div></div>';
	  var cfdiv = document.getElementById('commonfloorlogo');
	//alert(cfdiv);
	cfdiv.innerHTML='';
		return true;		
}	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';				
		return true;
}	
function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{				eval(document.getElementById("divfaq"+j)).style.display=''			}
			else			{				eval(document.getElementById("divfaq"+j)).style.display='none'			}
		}
			
	}
}
function validateDiv(div) {	var ni1 = document.getElementById(div); 	ni1.innerHTML = ''; }

function addPersonalDetails()
	{
		if(document.loan_form.City.value!="")
			{
				row = document.getElementById('PersonalDetails').style.display='block';	
			}
			
		if(document.loan_form.City.value=="")
			{
				row = document.getElementById('PersonalDetails').style.display='none';	
			}
	
	}
	
	function othercity1()
	{
		if(document.loan_form.City.value=="Others")
			{
				row = document.getElementById('otherCityDisp').style.display='block';	
			}
			
		if(document.loan_form.City.value!="Others")
			{
				row = document.getElementById('otherCityDisp').style.display='none';	
			}
	
	}
	
	
	/*function commomfloor()
{

	var cfcount = document.getElementById('Cfcount').value;
	var cfdiv = document.getElementById('commonfloorlogo');
	if(cfcount<=500)
	{
		var cit = document.loan_form.City.value;
		var prpval = document.loan_form.property_value.value;
		
		if((cit=="Delhi" || cit=="Mumbai" || cit=="Gurgaon" || cit=="Noida" || cit=="Gaziabad" || cit=="Thane" || cit=="Navi Munmbai" || cit=="Faridabad") && prpval>=2000000)
		{
			cfdiv.innerHTML='<table width="100%">  <tr><td class="commonfloor">			 <input type="checkbox" name="cf_campaign" id="cf_campaign" class="css-checkbox" value="1" /><label for="cf_campaign" class="css-label-check"> I would like to get property options from commonfloor.com </label></td> <td align="left"><img src="/images/commonfloor-logo.jpg" width="72" height="32" border="0" /></td></tr></table><div style="clear:both;"></div>';
		}
		else
			cfdiv.innerHTML='';
	}
}*/
	
	$('input[type="range"]').rangeslider();
	
	$('input[type="range"]').rangeslider('destroy');
	
	$(function() {

	var $document = $(document),
		selector = '[data-rangeslider]',
		$element = $(selector);

	// Example functionality to demonstrate a value feedback
	function valueOutput(element) {
		var svalue = element.value,
		output = element.parentNode.getElementsByTagName('output')[0];
		document.getElementById('Loan_Amount').value=svalue;
	
	}
	for (var i = $element.length - 1; i >= 0; i--) {
		valueOutput($element[i]);
	};
	$document.on('change', 'input[type="range"]', function(e) {
		valueOutput(e.target);
	});

	
	$document.on('change', '#js-example-change-value input[type="number"]', function(e) {
			var $inputRange = $('input[type="range"]', e.target.parentNode),
			value = $('input[type="number"]', e.target.parentNode)[0].value;

		$inputRange.val(value).change();
	});

	// Basic rangeslider initialization
	$element.rangeslider({

		// Deactivate the feature detection
		polyfill: false,

		// Callback function
		onInit: function() {},

		// Callback function
		onSlide: function(position, value) {
			console.log('onSlide');
			console.log('position: ' + position, 'value: ' + value);
		},

		// Callback function
		onSlideEnd: function(position, value) {
			console.log('onSlideEnd');
			console.log('position: ' + position, 'value: ' + value);
		}
	});

});