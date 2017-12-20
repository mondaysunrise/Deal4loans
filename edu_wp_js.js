function chkeducaionloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
 
if((document.eduloan_form.Name.value=="") || (Trim(document.eduloan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.eduloan_form.Name.focus();
		return false;
	}

	if(document.eduloan_form.Name.value!="")
	{
		if(containsdigit(document.eduloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.eduloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.eduloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.eduloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.eduloan_form.Name.focus();
			return false;
		}
  }

	if(document.eduloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.eduloan_form.Email.focus();
		return false;
	}
	
	var str=document.eduloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.eduloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.eduloan_form.Email.focus();
		return false;
	}
	if(document.eduloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.eduloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.eduloan_form.Phone.value)|| document.eduloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.eduloan_form.Phone.focus();
		return false;  
	}
	if (document.eduloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.eduloan_form.Phone.focus();
		return false;
	}
	if ((document.eduloan_form.Phone.value.charAt(0)!="9") && (document.eduloan_form.Phone.value.charAt(0)!="8") && (document.eduloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.eduloan_form.Phone.focus();
		return false;
	}
		

	if (document.eduloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.eduloan_form.City.focus();
		return false;
	}
	if((document.eduloan_form.City.value=="Others") && ((document.eduloan_form.City_Other.value=="" || document.eduloan_form.City_Other.value=="Other City"  ) || !isNaN(document.eduloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.eduloan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.eduloan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.eduloan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.eduloan_form.City_Other.focus();
  		return false;
  	}
  }
  
  
  
  if(Form.Course.selectedIndex==0)
{

	document.getElementById('courseVal').innerHTML = "<span  class='hintanchor'>Enter Course of Study!</span>";	
	//alert("Please enter Course of Study to Continue");
	Form.Course.focus();
	return false;
}
else if((Form.Course.value>1)  && ((Form.Course_Name.value=='')||!isNaN(Form.Course_Name.value) ||(Form.Course_Name.value=="Course Name")))
{
document.getElementById('courseNameVal').innerHTML = "<span  class='hintanchor'>Fill in Course Name!</span>";	
Form.Course_Name.focus();
return false;
}

  if (document.eduloan_form.Employment_Status.selectedIndex==0)
  {
	document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Enter Employment Status!</span>";	
	document.eduloan_form.Employment_Status.focus();
	return false;
  }


if (document.eduloan_form.Loan_Amount.value=="")
{
	document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
	document.eduloan_form.Loan_Amount.focus();
	return false;
}



	if(!document.eduloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	
		document.eduloan_form.accept.focus();
		return false;
	}
}  


function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}


function containsdigit(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
{
return true;
}
}
return false;
}
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
{
return true;
}
}
return false;
}
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function getcourse_nme()
{
if(document.eduloan_form.Course.value==2 || document.eduloan_form.Course.value==3 || document.eduloan_form.Course.value==4)
{
document.eduloan_form.Course_Name.disabled=false;
}
else
{document.eduloan_form.Course_Name.disabled=true;
}
}

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

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
	   }

       return true;
}

function addhdfclife(cit)
{
	var ni1 = document.getElementById('hdfclifeD');
	
		ni1.innerHTML = '';
	//var cit = document.eduloan_form.City.value;
if(cit=="Others")
{
	var cit = document.eduloan_form.City_Other.value;
}	
//alert(cit);
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" || cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
	//alert("Upendra");
		ni1.innerHTML = '';
	}
	return true;
}

function cityother()
{
	if(document. eduloan_form.City.value=="Others")
	{
		document.eduloan_form.City_Other.disabled = false;
	}
	else
	{
		document.eduloan_form.City_Other.disabled = true;
	}
} 