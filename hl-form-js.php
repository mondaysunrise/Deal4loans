<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>

<script type="text/javascript" src="/scripts/common.js"></script>
<script language="javascript">
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
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
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

	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}

	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.loan_form.Name.focus();
			return false;
		}
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
		
	if(document.loan_form.day.value=="" || document.loan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
		if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.loan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
		if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.loan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.loan_form.year.focus();
		return false;
	}
	if(document.loan_form.year.value!="")
	{
		if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	if(document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.loan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
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
		
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }
		
	if(document.loan_form.Email.value=="")
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
	
	if (document.loan_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.loan_form.Pincode.focus();
			return false;
		}
	}

	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}

	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		alert("Select Property identified or not!");	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.loan_form.Property_Loc.selectedIndex==0)
		{
			document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property Location!</span>";	
			document.loan_form.Property_Loc.focus();
			return false;
		}
	}

	if(!document.loan_form.accept.checked)
	{
		alert("Kindly Accept Terms and Condition!");	

		document.loan_form.accept.focus();
		return false;
	}	
}  


function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{
				eval(document.getElementById("divfaq"+j)).style.display=''
			}
			else
			{
				eval(document.getElementById("divfaq"+j)).style.display='none'
			}
		}
			
	}
}

function addIdentified()
{
		var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = '<div style=" float:left; width:183px; height:47px;  margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Location</div>    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="Property_loc" id="Property_loc" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><?=getCityList1($City)?></select></div><div id="vintageVal"></div></div>';
		
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';
				
		return true;

}	

function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}


function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
//	var otrcit = document.loan_form.City_Other.value;
	//alert(cit);	
	if(cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
	ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " height="20"><u>Special service only for Deal4loans customers:</u></td></tr> <tr><td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " colspan="2"> You are now a step closer to selecting the right Loan Deal for yourself! All you need is a complete picture of all your finances from MyUniverse!. <br><b>90 days free trial of MyUniverse</b></td></tr> <tr><td width="21"><input type="radio" name="adty_brl" id="adty_brl" value="1" checked/></td><td style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " width="611">Yes, Please register me in MyUniverse</td></tr><tr><td width="21"><input type="radio" name="adty_brl" id="adty_brl" value="2"/></td><td style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " width="611">No, Thank you</td></tr>	 </table>';
	}
	return true;
}

  </script>