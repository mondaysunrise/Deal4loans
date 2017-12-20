<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

	$property_value = $_SESSION['property_value']; 
	$loan_amount = $_SESSION['loan_amount'];
	$Net_Salary = $_SESSION['Net_Salary'];
	$day = $_SESSION['day'];
	$month = $_SESSION['month'];
	$year = $_SESSION['year'];
	$total_obligation = $_SESSION['total_obligation'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Housing Loan | Apply For Home Loans | Online Home Loan | Apply Housing Loan</title>
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India, apply Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Housing Loan: Apply for home loans Online and get quotes from all home loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>
 --><script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
<Script Language="JavaScript">
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
function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;

return true;
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
function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td height="20"  align="left" valign="middle" class="frmbldtxt"><b style="color:#373737;">Property Location</b></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;&nbsp;<select style="width:150px;" name="Property_Loc" id="Property_Loc" tabindex="16"><?=getCityList1($City)?></select></td></tr></table>';
			
		return true;
}	
	
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '<table border="0"><tr><td height="20" colspan="2" align="left" valign="center" class="subheading"><input type="checkbox" name="updateProperty" style="border:none;" ><span class="form-text">&nbsp;Can we tell you about some properties</font></td></tr></table>';
			
		return true;

}	

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function chkform()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
//var i;
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
<?	if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
	{?>
	if(document.loan_form.Email.value=="")
	{
		alert("Please fill your Email.");
		document.loan_form.Email.focus();
		return false;
	}
	<? } ?>
<?
if($_SESSION['UserType']=="") 
{
?>

	
	 if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}

	}
	
<?
}
?>
	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
		alert("Please fill your Full Name.");
		document.loan_form.Name.focus();
		return false;
	}
	if(document.loan_form.Name.value!="")
	{
	 if(containsdigit(document.loan_form.Name.value)==true)
	{
	alert("First Name contains numbers!");
	document.loan_form.Name.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.Name.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	document.loan_form.Name.focus();
 	return false;
  	}
  }
	if(document.loan_form.day.value=="" || document.loan_form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
	 if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.loan_form.day.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="MM")
	{
		alert("Please fill your month of birth.");
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
	if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.loan_form.month.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		document.loan_form.year.focus();
		return false;
	}
		if(document.loan_form.year.value!="")
	{
	  if((document.loan_form.year.value < "1945") || (document.loan_form.year.value >"1989"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		document.loan_form.year.focus();
		return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}
	 if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  document.loan_form.Phone.focus();
			  return false;  
		}
        if (document.loan_form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.Phone.focus();
				return false;
        }
        if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.loan_form.Phone.focus();
                return false;
        }
	/*if(document.loan_form.Phone.value!="")
	{
		if (!validmobile(document.loan_form.Phone.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Phone.focus();
			return false;
		}
	}
	*/
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		alert("Please select Employment Status to Continue");
		document.loan_form.Employment_Status.focus();
		return false;
	}
	
	/*if(document.loan_form.Residence_Address.value=="")
	{
		alert("Please fill your Residence Address.");
		document.loan_form.Residence_Address.focus();
		return false;
	}*/
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
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other city has special characters.\n Please remove them and try again.");
	document.loan_form.City_Other.focus();
  	return false;
  	}
  }
	if (document.loan_form.Pincode.value=="")
	{
		alert("Please enter Pincode.");
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
	{
		alert("Kindly fill in your Pincode(6 Digits)!");
		document.loan_form.Pincode.focus();
		return false;
	}
	}
		
	if (document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Annual Income.");
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;


for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
	//alert(document.loan_form.Property_Identified.length);
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
		if(cnt == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
		if(cnt ==0)
		{ 
			if(document.loan_form.Property_Loc.selectedIndex==0)
			{
				alert("Plese select city where property is located");
				document.loan_form.Property_Loc.focus();
				return false;
			}
		}
		
	if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;


		if(!document.loan_form.accept.checked)
	{
	alert("Accept the Terms and Condition");
	document.loan_form.accept.focus();
	return false;
	}
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

function edelweiss_comp()
{
	//alert("hello");
	var ni = document.getElementById('edelweiss_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.loan_form.City.value=="Bangalore" || document.loan_form.City.value=='Chandigarh' || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Coimbatore'  ||  document.loan_form.City.value=='Delhi'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Indore'  || document.loan_form.City.value=='Jaipur'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Lucknow'  ||  document.loan_form.City.value=='Ludhiana'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Nagpur'  ||  document.loan_form.City.value=='Nasik'  ||  document.loan_form.City.value=='Noida'  || document.loan_form.City.value=='Pune')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox" name="edelweiss" id="edelweiss" value="1" style="border:none;">&nbsp;Execute trades with a single click. Open an online trading account with Edelweiss.';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.loan_form.City.value=="Bangalore" || document.loan_form.City.value=='Chandigarh' || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Coimbatore'  ||  document.loan_form.City.value=='Delhi'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Indore'  || document.loan_form.City.value=='Jaipur'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Lucknow'  ||  document.loan_form.City.value=='Ludhiana'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Nagpur'  ||  document.loan_form.City.value=='Nasik'  ||  document.loan_form.City.value=='Noida'  || document.loan_form.City.value=='Pune')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox" name="edelweiss" value="1" style="border:none;">&nbsp;Execute trades with a single click. Open an online trading account with Edelweiss.';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}

function addtooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.Phone.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
				

			}
		}
		
		return true;

	}
function removetooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.Phone.value!="")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

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
										//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						
					}
			}
							//window.onload=showdetailsFaq

</script>
<Script Language="JavaScript">
var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function insertData()
		{
			var get_full_name = document.getElementById('Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="2";

				var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
				//alert(queryString); 
				ajaxRequestMain.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					if(ajaxRequestMain.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequestMain.responseText;
					}
				}

				ajaxRequestMain.send(null); 
			 
		}

	window.onload = ajaxFunctionMain;

/*function OnloadCalls()
	{
		ajaxFunction();
		
		
	}
	window.onload = OnloadCalls;*/
</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> > Apply Home Loan</span>
  <div id="lftbar" style="padding-top:15px; width:100%; ">
 	  <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>

 <form name="loan_form" method="post" action="apply-home-loans-calc-continue.php" onSubmit="return chkform();">
 <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="Home Loan Calc">
              <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
          <tr>
            <td colspan="5" align="center" ></td>
	    </tr>
          
          <tr>
            <td colspan="5" style="padding:12px;" ><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Apply Home Loan</h1></td>
  </tr>
</table></td>
            </tr>

          <tr>
            <td colspan="5" valign="top" class="frmbldtxt"></td>
            </tr>
           <tr>
             <td  colspan="5" align="left" class="frmbldtxt"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; ">Full Name :</td>
                     <td height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Name" id="Name" style="width:150px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                     <td width="17%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                     <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="City" id="City" style="width:154px;" onchange="cityother(); insertData();" tabindex="7">
                         <?=getCityList($City)?>
                     </select></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">DOB :</td>
                     <td height="28" class="frmbldtxt"><input name="day" type="text" id="day"  value="<? echo $day; ?>" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                         <input  name="month" type="text" id="month" style="width:35px; " value="<? echo $month; ?>" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                         <input name="year" type="text" id="year" style="width:63px; " value="<? echo $year; ?>" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
                     <td height="28" align="left" class="frmbldtxt">Other City :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="City_Other" disabled  value="Other City" onfocus="this.select();" style="width:148px;" tabindex="8" /></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">Mobile :</td>
                     <td height="28" class="frmbldtxt">+91
                         <input type="text" style="width:122px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);insertData();" onblur="return Decorate1(' ')" onfocus="addtooltip();" tabindex="5"/></td>
                     <td height="28" class="frmbldtxt">Pincode :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="Pincode" onfocus="this.select();" style="width:148px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"   tabindex="9" /></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="28" class="frmbldtxt">Email ID :</td>
                     <td width="33%" height="28" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:149px;" onchange="insertData();" tabindex="6" /></td>
                     <td width="17%" height="28" class="frmbldtxt">Occupation :</td>
                     <td width="31%" height="28" class="frmbldtxt"><select   name="Employment_Status"  id="Employment_Status" style="width:154px;" tabindex="10" >
                         <option value="-1">Employment Status</option>
                         <option value="1">Salaried</option>
                         <option value="0">Self Employment</option>
                     </select></td>
                   </tr>
	                   <tr valign="top">
                     <td height="28" colspan="3" style="color:#373737; padding-top:5px;">Total Monthly EMI for all running loans :</td>
                     <td height="28" style="padding-top:4px; "><input type="text" name="obligations" id="obligations" style="width:148px;"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="17" value="<? echo $total_obligation; ?>" /></td>
                   </tr>
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="28" class="frmbldtxt">Gross Annual Salary :</td>
                <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:148px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" value="<? echo $Net_Salary; ?>"/>
                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
			    <td height="28" class="frmbldtxt">Loan Amount :</td>
                <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="12" type="text" style="width:148px;" maxlength="10" value="<? echo $loan_amount; ?>" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
                </td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Property Value :</td>
                <td class="frmbldtxt"><input type="text" name="property_value"  id="property_value" style="width:148px;" maxlength="30"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="13" value="<? echo $property_value; ?>"/></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Property Identified :</td>
                <td class="frmbldtxt"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="addIdentified();" style="border:none;" tabindex="14" />
      Yes&nbsp;&nbsp;
      <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" tabindex="15" />
      No</td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt">
				<div id="myDiv1"></div>
                  </td>
              </tr>
            </table></td>
               </tr>
             </table></td>
           </tr>
           <tr>
             <td height="22"  colspan="5" align="left" class="frmbldtxt"><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" style="border:none;" tabindex="18">&nbsp; Co- Applicant</td>
           </tr>
          <tr>
             <td  colspan="5" align="left" class="frmbldtxt">
				<div style="display:none; " id="divfaq1">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td width="12%" class="frmbldtxt" height="30"><b> Name :</b></td>
          <td width="23%" align="left"><span class="frmbldtxt">
            <input type="text" name="co_name" id="co_name" style="width:149px;" tabindex="19" maxlength="30" value="<?php echo $co_name; ?>" >
            </span></td>
          <td width="11%" align="left"><b>DOB : </b></td>
          <td width="21%" align="left"><input onfocus="insertData();" name="co_day" type="text" id="co_day" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="DD" tabindex="20" />
            <input name="co_month" type="text" id="co_month" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="MM" tabindex="21" />
            <input name="co_year" type="text" id="co_year" style="width:53px;" maxlength="4" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="YYYY" tabindex="22" /></td>
          <td width="16%" height="30" class="frmbldtxt"><b> Net Monthly Income : </b></td>
          <td width="17%" align="left"><span class="frmbldtxt">
            <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:148px;" value="<?php echo $income; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="23" />
          </span></td>
                    </tr>
                    <tr>
                      <td height="30" colspan="3" class="frmbldtxt"><b> Total Monthly EMI for all running loans : </b></td>
          <td align="left"><span class="frmbldtxt">
            <input type="text" name="co_obligations" id="co_obligations" tabindex="24" style="width:148px;" value="<?php echo $obligations; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
          </span></td>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
                    </tr>
		</table>
       </div>
			 </td>
           </tr>
		    <!--<tr>
            <td class="frmbldtxt" colspan="2" align="left"> <div  id="edelweiss_compaign" ></div></td>
            </tr>-->
           <tr>
             <td height="22"  colspan="4" align="left" class="frmbldtxt" style="font-weight:normal; "><input type="checkbox" name="accept" style="border:none;" checked>
              I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.</td>
			  <td width="25%"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
           </tr>
          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form>
	<br />

	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#bdc5cf">
  
  <tr>
    <td width="12%" height="22" align="center" bgcolor="#3d60a4" class="wttext" style="color:#FFFFFF; "><b>Banks</b></td>
    <td width="23%" align="center" bgcolor="#3d60a4" class="wttext" style="color:#FFFFFF; "><b>ICICI Bank</b></td>
    <td width="22%" align="center" bgcolor="#3d60a4" class="wttext" style="color:#FFFFFF; "><b>HDFC Ltd. </b></td>
    <td width="22%" align="center" bgcolor="#3d60a4" class="wttext" style="color:#FFFFFF; "><b>IDBI Bank</b></td>
	    <td width="21%" align="center" bgcolor="#3d60a4" class="wttext" style="color:#FFFFFF; "><b>Axis Bank</b></td>
  </tr>

  <tr>
    <td height="22" align="center" bgcolor="#FFFFFF" class="text"><b>Rate of Interest</b></td>
    <td align="center" bgcolor="#FFFFFF" class="text" ><b>9.50% - 10.25%</b></td>
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>9.75% - 10.25%</b></td>
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>9.50% - 10%</b></td>
	 <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>9.50% - 10.25% </b></td>
  </tr>
  <tr>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF" class="text" ><b>Processing Fee</b></td>
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"  ><b>0.50%</b></td>
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>Rs. 10,000 - or 0.50%</b></td>
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>0.50%</b></td>
	    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>1%</b></td>
  </tr>
  <tr>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF" class="text" ><b>Loan Amount</b></td>
<td align="center" valign="middle" bgcolor="#FFFFFF" class="text"  ><b>Rs.8,00,000 - Maximum
 <br />85% of the Cost of the Property</b>
 <br />
(Subject to Income Eligibility)</td>
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>85% of the Cost of the Property</b><br />
(Subject to Income Eligibility)</td>
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>Rs.5,00,000 - Maximum
 <br />85% of the Cost of the Property</b>
 <br />
(Subject to Income Eligibility)</td>
	    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>Rs.1,00,000 - Rs.2,00,00,000</b></td>
  </tr>
   <tr>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF" class="text" ><b>Prepayment Charges</b></td>
<td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>Rs.10,000 - or 2%</b></td>
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>2%</b></td>
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>N.A.</b></td>
	    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text"><b>Nil</b></td>
  </tr>
</table></td>
  </tr>
 
</table>


<div class="sldrpnl" >
	<div id="slider">
		<ul>				
			        <li>
<div><img src="new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/idbi.jpg" alt="IDBI Home Finance" width="126" height="41"  style="border:none;"/></div>

            </li>
            <li>
<div><img src="new-images/slider/thumb/lichfl.gif" alt="LIC Housing Finance" width="142" height="38"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/indiabull.gif" alt="Indiabulls" width="142" height="37"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/idbi.jpg" alt="IDBI Home Finance" width="126" height="41"  style="border:none;"/></div>
<!--<div><img src="new-images/slider/thumb/stanc.gif" alt="Standard Chartered" width="142" height="42"  style="border:none;"/></div> -->
<div><img src="new-images/slider/thumb/detschpost.gif" alt="Deutsche Postbank" width="143" height="40"  style="border:none;"/></div>
            </li>
		</ul>
	</div>
</div>


<br />
</div>

  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>
</html>