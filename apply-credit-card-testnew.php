<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
  <link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
 <style type="text/css">
<!--
.outer_container{margin:0px; width:500px; border-top:1px solid #e8e8e8; border-bottom:1px solid #e8e8e8;}
.customScrollBox{position:relative; height:100px; overflow:hidden;}
.customScrollBox .container{position:relative; width:480px; top:0; float:left;}
.customScrollBox .content{clear:both;}
.dragger_container{position:relative; width:0px; height:100px; float:left; margin:10px 0 0 10px; border-left:4px solid #eabab8; border-right:4px solid #eabab8;}
.dragger{position:absolute; width:8px; height:60px; background:#d86f6a; margin-left:-5px; text-align:center; line-height:20px; color:#d86f6a; overflow:hidden; border-left:1px solid #d86f6a; border-right:1px solid #d86f6a;}
-->
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
 <script type="text/javascript" src="redemption/jquery.mousewheel.min.js"></script>

<noscript>
	<style type='text/css'>#customScrollBox { overflow:auto; }</style>
	<style type='text/css'>#dragger_container { display:none; }</style>
</noscript>
<script>
$(window).load(function() {
	$customScrollBox=$(".customScrollBox");
	$customScrollBox_container=$(".customScrollBox .container");
	$customScrollBox_content=$(".customScrollBox .content");
	$dragger_container=$(".dragger_container");
	$dragger=$(".dragger");

	visibleHeight=$customScrollBox.height();
	if($customScrollBox_container.height()>visibleHeight){ //enable scrollbar if content is long
		totalContent=$customScrollBox_content.height();
		minDraggerHeight=$dragger.height();
		draggerContainerHeight=$dragger_container.height();
		adjDraggerHeight=totalContent-((totalContent-visibleHeight)*1.3); //adjust dragger height analogous to content
		 
		animSpeed=400; //animation speed
		easeType="easeOutCirc"; //easing type
		bottomSpace=1.05; //bottom scrolling space
		targY=0;
		draggerHeight=$dragger.height();
		$dragger.draggable({ 
			axis: "y", 
			containment: "parent", 
			drag: function(event, ui) {
				Scroll();
			}, 
			stop: function(event, ui) {
				DraggerOut();
			}
		});

		//scrollbar click
		$dragger_container.click(function(e) {
			$this=$(this);
			$this.css("background-color","#d86f6a");
			var mouseCoord=(e.pageY - $this.offset().top);
			var targetPos=mouseCoord+$dragger.height();
			if(targetPos<$dragger_container.height()){
				$dragger.css("top",mouseCoord);
				Scroll();
			} else {
				$dragger.css("top",$dragger_container.height()-$dragger.height());
				Scroll();
			}
		});

		//mousewheel
		$(function($) {
			$customScrollBox.bind("mousewheel", function(event, delta) {
				vel = Math.abs(delta*10);
				$dragger.css("top", $dragger.position().top-(delta*vel));
				Scroll();
				if($dragger.position().top<0){
					$dragger.css("top", 0);
					$customScrollBox_container.stop();
					Scroll();
				}
				if($dragger.position().top>$dragger_container.height()-$dragger.height()){
					$dragger.css("top", $dragger_container.height()-$dragger.height());
					$customScrollBox_container.stop();
					Scroll();
				}
				return false;
			});
		});

		//scroll
		function Scroll(){
			var scrollAmount=(totalContent-(visibleHeight/bottomSpace))/(draggerContainerHeight-draggerHeight);
			var draggerY=$dragger.position().top;
			targY=-draggerY*scrollAmount;
			var thePos=$customScrollBox_container.position().top-targY;
			$customScrollBox_container.stop().animate({top: "-="+thePos}, animSpeed, easeType); //with easing
			//$customScrollBox_container.css("top",$customScrollBox_container.position().top-thePos+"px"); //no easing
		}

		$dragger.mouseup(function(){
			DraggerOut();
		}).mousedown(function(){
			DraggerOver();
		});

		function DraggerOver(){
			$dragger.css("background-color", "#d86f6a").css("color", "#d86f6a").css("border-left-color", "#d86f6a").css("border-right-color", "#d86f6a");
		}

		function DraggerOut(){
			$dragger.css("background-color", "#d86f6a").css("color", "#d86f6a").css("border-left-color", "#d86f6a").css("border-right-color", "#d86f6a");
		}
	} else { //disable scrollbar if content is short
		$dragger.css("display","none");
		$dragger_container.css("display","none");
	}
});
</script>
<Script Language="JavaScript">
function othercity1()
{
	if(document.creditcard_form.City.value=='Others')
	{
		document.creditcard_form.City_Other.disabled=false;
	}
	else
	{
		document.creditcard_form.City_Other.disabled=true;
	}
}


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
	if(document.creditcard_form.City.value=="Others")
	{
		document.creditcard_form.City_Other.disabled = false;
	}
	else
	{
		document.creditcard_form.City_Other.disabled = true;
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
function retain(strPlan)
{
	if(document.loan_form.Email.value!="")
	{
	   if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }
	}
       return true;
	}
function Decoration(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function Decoration1(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function Decorate(strPlan,i)
{
       if (document.getElementById('plantype2_'+i) != undefined)  
       {
               document.getElementById('plantype2_'+i).innerHTML = strPlan;
			   document.getElementById('plantype2_'+i).style.background='#ddf3f9'; 
			   document.getElementById('plantype2_'+i).style.border=' 1px dashed #99bec9'; 
       }

       return true;
}
function Decorate1(strPlan,i)
{
       if (document.getElementById('plantype2_'+i) != undefined) 
       {
               document.getElementById('plantype2_'+i).innerHTML = strPlan;
			   document.getElementById('plantype2_'+i).style.background='';  
			    document.getElementById('plantype2_'+i).style.border=''; 
			     
               
       }

       return true;
}
	
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}
function ckhcreditcard(Form)
{	
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
var myOption;
/* if(document.loan_form.Email.value!="Email Id")
{
	if (!validmail(document.loan_form.Email.value))
	{
		document.loan_form.Email.focus();
		return false;
	}
}*/
if((Form.Full_Name.value=="") || (Form.Full_Name.value=="Full Name")|| (Trim(Form.Full_Name.value))==false)
{
alert("Kindly fill in your Name!");
Form.Full_Name.focus();
return false;
}
else if(containsdigit(Form.Full_Name.value)==true)
{
alert("Name contains numbers!");
Form.Full_Name.focus();
return false;
}
  for (var i = 0; i < Form.Full_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Full_Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Full_Name.focus();
  	return false;
  	}
  }
if((space.test(Form.day.value)) || (Form.day.value=="dd")  )
{
alert("Kindly enter your Date of Birth");
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
alert("Kindly enter your Date of Birth(numbers Only)");
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
alert("Kindly Enter your valid Date of Birth(Range 1-31)");
Form.day.select();
return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
alert("Kindly enter your Month of Birth(numbers Only)");
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
alert("Kindly Enter your valid Month of Birth(Range 1-12)");
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
alert("Month February cannot have more than 29 days");
Form.day.select();
return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
alert("Kindly enter your Year of Birth");
Form.year.select();
return false;
}

else if(!num.test(Form.year.value))
{
alert("Kindly enter your Year of Birth(numbers Only) !");
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
alert("February cannot have more than 28 days.");
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
Form.year.select();
return false;
}
else if((Form.year.value < "1945") || (Form.year.value >"1989"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
Form.year.select();
return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}


if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
else if(Form.Phone.value.length < 10)
{
alert("Kindly fill in your Correct Mobile Number!");
Form.Phone.focus();
return false;
}
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
				 Form.Phone.focus();
                return false;
        }
else if(containsalph(Form.Phone.value)==true)
{
alert("Kindly fill in your Correct Mobile Number(Numeric Only)!");
Form.Phone.focus();
return false;
}
 if(Form.Email.value!="Email Id")
{
	if (!validmail(Form.Email.value))
	{
		Form.Email.focus();
		return false;
	}
}
if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select employment status ");
	Form.Employment_Status.focus();
	return false;
}
if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name")|| (Trim(Form.Company_Name.value))==false)
{
alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}
else if(Form.Company_Name.value.length < 3)
{
alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}
for (var i = 0; i < Form.Company_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Company_Name.value.charAt(i)) != -1) {
  	alert ("Company Name has special characters.\n Please remove them and try again.");
	Form.Company_Name.focus();
  	return false;
  	}
  }
if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
alert("Kindly fill in your other City!");
Form.City_Other.focus();
return false;
}

if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income"))
{
	alert("Please enter Annual income to Continue");
	Form.Net_Salary.focus();
	return false;
}

/*var btn = valButton2();
   if (!btn)
   {
		alert('Please select you have pancard or not.');
				return false;
   }*/
   myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
					if(Form.Card_Vintage.selectedIndex==0)
					{
						alert('Card Held since.');
						Form.Card_Vintage.focus();
						return false;
					}

					
				}
					myOption = i;

				
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select you are credit card holder or not");
			return false;
		}
   	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
	
	
	if(Form.Email.value=="Email Id")
	{
		Form.Email.value=" ";
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

function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		 var newdivCC = document.createElement('div');
		
		//if(ni.innerHTML=="")
		//{
		
			
				ni.innerHTML = '<table border="0" width="100%"><tr>	 <td width="30%" class="formtext">Cards held since?</td><td width="70%" class="formtext" ><select size="1" name="Card_Vintage" id="Card_Vintage" style="width:120px;"><option value="0">Please select</option> <option value="1">Less than 6 months</option><option value="2">6 to 9 months</option>	 <option value="3">9 to 12 months</option>	 <option value="4">more than 12 months</option>	 </select> </td></tr></table>';
				

			
		//}
		ni.appendChild(newdivCC);
		//return true;

	}


function removeElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}

	 function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.creditcard_form.City.value=="Delhi" || document.creditcard_form.City.value=='Delhi' || document.creditcard_form.City.value=='Noida'  ||  document.creditcard_form.City.value=='Gurgaon'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Gaziabad'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Greater Noida'  || document.creditcard_form.City.value=='Chennai'  ||  document.creditcard_form.City.value=='Mumbai'  ||  document.creditcard_form.City.value=='Thane'  ||  document.creditcard_form.City.value=='Navi mumbai'  ||  document.creditcard_form.City.value=='Kolkata'  ||  document.creditcard_form.City.value=='Kolkota'  ||  document.creditcard_form.City.value=='Hyderabad'  ||  document.creditcard_form.City.value=='Pune'  || document.creditcard_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal; text-decoration:underline;" >Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.creditcard_form.City.value=="Delhi" || document.creditcard_form.City.value=='Delhi' || document.creditcard_form.City.value=='Noida'  ||  document.creditcard_form.City.value=='Gurgaon'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Gaziabad'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Greater Noida'  || document.creditcard_form.City.value=='Chennai'  ||  document.creditcard_form.City.value=='Mumbai'  ||  document.creditcard_form.City.value=='Thane'  ||  document.creditcard_form.City.value=='Navi mumbai'  ||  document.creditcard_form.City.value=='Kolkata'  ||  document.creditcard_form.City.value=='Kolkota'  ||  document.creditcard_form.City.value=='Hyderabad'  ||  document.creditcard_form.City.value=='Pune'  || document.creditcard_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox" style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal; text-decoration:underline;">Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}

function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}

</Script>
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
			var get_full_name = document.getElementById('Full_Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="4";

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


</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> > Apply Credit Card</span>
  <div id="txt" style="padding-top:15px;">
  
 
<div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>          <td  valign="middle" class="crdhorizonbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
                <td width="205" align="center"> HDFC Gold Card</td>
                <td width="755">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td class="yelobordr"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="184" align="center" valign="top"><img src="new-images/hdfc-crd.jpg" width="140" height="85" /></td>
                <td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
                <td width="505" valign="top"   class="crdtext"><b>Features :</b>
             <ul>
                              <li>Free for Life time.</li>
                              <li>Earn 1 reward point per Rs. 150 spent </li>
                              <li>5% cash back on Domestic Flights and Rail Tickets* </li>
                        </ul></td>
                <td width="215" align="center" valign="middle"  class="crdtext"><a href="#"><img src="new-images/cards-apply.gif" width="143" height="63" border="0" /></a></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="20" valign="top"><img src="new-images/crds-h-botbg.gif" width="960" height="20" /></td>
        </tr>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>          <td  valign="middle" class="crdhorizonbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
                <td width="205" align="center"> HDFC Gold Card</td>
                <td width="755">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td class="yelobordr"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="184" align="center" valign="top"><img src="new-images/hdfc-crd.jpg" width="140" height="85" /></td>
                <td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
                <td width="505" valign="top"   class="crdtext"><b>Features :</b>
             <ul>
                              <li>Free for Life time.</li>
                              <li>Earn 1 reward point per Rs. 150 spent </li>
                              <li>5% cash back on Domestic Flights and Rail Tickets* </li>
                        </ul></td>
                <td width="215" align="center" valign="middle"  class="crdtext"><a href="#"><img src="new-images/cards-apply.gif" width="143" height="63" border="0" /></a></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="20" valign="top"><img src="new-images/crds-h-botbg.gif" width="960" height="20" /></td>
        </tr>
      </table>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>          <td  valign="middle" class="crdhorizonbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
                <td width="205" align="center"> Kotak Trump Card</td>
                <td width="755">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td class="yelobordr"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="184" align="center" valign="top"><img src="new-images/kotak-crd.jpg" width="53" height="86" /></td>
                <td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
                <td width="505" valign="top"   class="crdtext"><b>Features :</b>
             <ul>
                              <li>Apply online and basic documents required.</li>
                              <li>No interest, no fee in first 3 months.</li>
                              <li>Free for Life time.</li>
                       </ul></td>
                <td width="215" align="center" valign="middle"  class="crdtext"><a href="#"><img src="new-images/cards-apply.gif" width="143" height="63" border="0" /></a></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="20" valign="top"><img src="new-images/crds-h-botbg.gif" width="960" height="20" /></td>
        </tr>
      </table>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" valign="middle"   class="crdhorizonbg">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="205" align="center"> HDFC Gold Card</td>
    <td width="755">&nbsp;</td>
  </tr>
</table>

		
		</td>
      </tr>
      <tr>
        <td class="yelobordr"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="184" align="center" valign="top"><img src="new-images/hdfc-crd.jpg" width="140" height="85" /></td>
              <td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
              <td width="505" valign="top"   class="crdtext">
			  <b>Features :</b>
			  	<div class="outer_container">
<div class="customScrollBox">
	<div class="container">
    	<div class="content">
		
			  
                  <ul>
                    <li>Free for Life time.</li>
                    <li>Earn 1 reward point per Rs. 150 spent </li>
                    <li>5% cash back on Domestic Flights and Rail Tickets* </li>
                    <li>Redeem points for rewards including air miles.</li>
                    <li>Revolving Credit Facility </li>
                    <li>Free Add-on Card </li>
					
                </ul>
				 </div>
	</div>
    <div class="dragger_container">
    	<div class="dragger">&#9618;</div>
    </div>
</div>
</div>
				
				</td>
            <td width="215" align="center" valign="middle"  class="crdtext"><a href="#"><img src="new-images/cards-apply.gif" width="143" height="63" border="0" /></a></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="20" valign="top"><img src="new-images/crds-h-botbg.gif" width="960" height="20" /></td>
      </tr>
    </table>
	  
	  </td>
  </tr>
</table>
</div>
 

  </div>
      <?
  //include '~Right2.php';

  ?>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>