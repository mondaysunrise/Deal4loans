<?php
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	session_start();
header("Location: index.php");
exit();	
	function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'applyhere_pl.php',
		'Req_Loan_Home' => 'applyhere_hl.php',
		'Req_Loan_Car' => 'applyhere.php',
		'Req_Credit_Card' => 'applyhere_cc.php',
		'Req_Loan_Against_Property' => 'applyhere.php',
		'Req_Business_Loan' => 'Req_Business_Loan_New.php',

	);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	$msg = "Thank You, You will be soon contacted by our Executive";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$From_Name = $_REQUEST['From_Name'];
		$From_Email = $_REQUEST['From_Email'];
		$From_City = $_REQUEST['city'];
		$From_City_Other = $_REQUEST['city_other'];
		
		$Mobile = $_REQUEST['Mobile'];
		$Products = $_REQUEST['Product'];
		$Company = $_REQUEST['Company'];
		$query_type = $_REQUEST['query_type'];
		$product_type =$_REQUEST['product_type'];
		$pwd = $_POST['pwd'];
		
		$n        = count($Products);
	   $i        = 0;
	   while ($i < $n)
	   {
		  $Product .= "$Products[$i], ";
		  $i++;
	   }

		if($query_type==2)	
		{
		$Dated = ExactServerdate();
		$data = array("A_Name"=>$From_Name , "A_Email"=>$From_Email , "A_City"=>$From_City , "A_City_Other"=>$From_City_Other, "A_Mobile"=>$Mobile, "A_Product"=>$Product, "A_Company"=>$Company, "Dated"=>$Dated, "A_Query_Type"=>$Product, "pwd"=>$pwd );
		$table = 'Req_Agent';
		$insert = Maininsertfunc ($table, $data);
$SMSMessage="";

if($From_City=='Others' || strlen($From_City_Other)>0)
		{
			$Message2 = "<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $From_Name,</b></font></td><td align='right' ><img src='http://www.deal4loans.com/images/logo.gif'/></td></tr><tr><td colspan='2'><p><font face='Verdana' size='2'>Thanks for registering with Deal4Loans.com; we have customers all over India who are willing to take loans.</font></p><p><font face='Verdana' size='2'>We would like to partner with you &amp; help you increase your business but currently we are not generating much leads from your city, as soon as we start getting leads from your city we will contact you immediately.</font></p><p><font face='Verdana' size='2'></p><tr><td><p><font face='Verdana' size='2'> <b>For further Query Email us at priyanka.sharma@deal4loans.com</font>  </p><p><font face='Verdana' size='2'><b>Regards</b><br>  Team <a href='www.deal4loans.com'>Deal4loans.com</a><br>Loans by Choice not by Chance! </font></p> <font face='Verdana' size='2'><b><a href='http://www.deal4loans.com/Contents_Blogs.php' target='_blank'> Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php' target='_blank'>Testimonials</a> | <a href='http://www.deal4loans.com/mediarelease.php' target='_blank'>Press Release</a></b></font></td><td width='40%'><p></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
		
		}
		else {


	$Message2= "<table border='0' cellspacing='0' width='100%' cellpadding='0' style='border-collapse: collapse' bordercolor='#529BE4' id='AutoNumber2'><tr><td colspan='3' align=center valign='top' bgcolor='#529BE4'>&nbsp;</td></tr><tr><td width='2' align=center valign='top' bgcolor='#529BE4'><img src='http://www.deal4loans.com/images/spacer.gif' width='2'/></td><td align=center valign='top' bgcolor='#FFFFFF'><table width='99%' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' id='frm'><tr><td width='77%' bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $From_Name,</b></font></td><td width='23%' align='right' ><img src='http://www.deal4loans.com/images/logo.gif'/></td></tr><tr><td align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;'><p>Thanks for showing your interest in tying up with <b> Deal4Loans.com.</b></p><p>Deal4Loans.com can help you increase your loans business by providing you leads of interested and eligible customers. Partnering with d4l would save you from the troubles of :</p><ul><li> Searching new loan seekers </li><li> Scrubbing the database to avoid calling existing DNC Customers.</li></ul><p>We follow a <b>Cost per Lead (CPL)</b> model with a Pre-paid billing agreement. Your very own Deal4loans account will be activated upon receipt of payment from your end. </p><p>You can choose to buy a specific package based on the size of your business. We currently have 2 packages:<ul><li> Normal pack: 50 Leads </li><li> Century pack: 100 leads</li></ul> </p></td><td rowspan='2' align='center' valign='top'><table width='220' border='0' align='right' cellpadding='0' cellspacing='0'><tr><td height='22'  bgcolor='#529BE4' align='center' class='quick'><font style='font-size:13px; font-weight:bold; color:#FFFFFF;'>DSA’s Speak Section </font></td>  </tr><tr><td height='22' align='left' valign='top'  bgcolor='#F4F9FD' style='font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000;line-height:18px;' ><table width='99' border='0' align='right' cellpadding='0' cellspacing='0'><tr bgcolor='#F4F9FD'><td height='120' align='center' valign='top'><img src='http://www.deal4loans.com/images/agent-pic-sml.jpg' width='99' height='120'></td></tr></table><p ><b >Mr.Anil Yadav,<br>DSA of the Month</b> <a href='http://www.deal4loans.com/dsa-speak-section.php' target='_blank'>has active association with Deal4Loans for sourcing Home Loan Leads since July’08.Mr Anil is currently tied up with Mumbai branch of Hdfc ltd. He has shared  his experience with Deal4Loans about the conversions, lead quality, for generating business.<br>He has sourced more than <b>500 leads from Deal4loans.com in the prepaid model</b>  and the association has been profitable for him .<br>Here is the snippet of the conversation we had with him on Dated<br> 13th Mar 09:</a></p></td></tr></table></td></tr><tr><td align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;'><p> <b>For further Query Email us at<br />priyanka.sharma@deal4loans.com</b></p><p><b>Regards</b><br>Team <a href='www.deal4loans.com'>Deal4loans.com</a><br>  Loans by Choice not by Chance!</p><b><a href='http://www.deal4loans.com/Contents_Blogs.php' target='_blank'> Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php' target='_blank'>Testimonials</a> | <a href='http://www.deal4loans.com/mediarelease.php' target='_blank'>Press Release</a></b></td></tr></table></td><td width='2' align=center valign='top' bgcolor='#529BE4'><img src='http://www.deal4loans.com/images/spacer.gif' width='2'/></td></tr><tr><td colspan='3' align=center valign='top' bgcolor='#529BE4'>&nbsp;</td></tr></table>";

}
		$headers  = 'From: Deal4loans<no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail($From_Email,'Welcome to Deal4loans - '.$From_Name, $Message2, $headers);
	
	echo "<script language=javascript>alert('".$msg."');"." location.href='index.php'"."</script>";


if($From_City=='Mumbai' || $From_City=='Navi Mumbai' || $From_City=='Thane' || $From_City=='Pune' || $From_City=='Ahmedabad' || $From_City=='Baroda' ||  $From_City=='Surat' ||  $From_City_Other=='Vapi' ||  $From_City=='Indore' ||  $From_City=='Ranchi' ||  $From_City=='Aurangabad' ||  $From_City=='From_City_Other' ||  $From_City=='Nagpur' ||  $From_City_Other=='Rajkot' ||  $From_City=='Bhopal' ||  $From_City_Other=='Gwalior' ||  $From_City=='Nasik' || $From_City=='Bhubneshwar')
{
	$strmobile_no="9899278555";
}

else if($From_City=='Delhi' || $From_City=='Noida' || $From_City=='Gaziabad' || $From_City=='Gurgaon' || $From_City=='Sahibabad' || $From_City=='Kolkata' ||  $From_City=='Chennai' || $From_City_Other=='Jalandhar' || $From_City=='Ludhiana' || $From_City=='Jaipur' || $From_City_Other=='Patiala' ||  $From_City_Other=='Udaipur' ||  $From_City_Other=='Agra' ||  $From_City=='Dehradun' ||  $From_City_Other=='Panipat' ||  $From_City=='Raipur' ) 
	{
		$strmobile_no="9899405626";
	}
else if($From_City=='Bangalore' || $From_City=='Hyderabad' || $From_City=='Salem' || $From_City=='Coimbatore' || $From_City_Other=='Trichy' || $From_City_Other=='Erode' || $From_City=='Madurai' || $From_City_Other=='Calicut' || $From_City=='Cochin' || $From_City=='Vijaywada' || $From_City=='Vishakapatnam' || $From_City=='Guwahati') 
	{
		$strmobile_no="9899278555";
	}
	else
			{
				$strmobile_no="9899278555";
			}

//echo "city".$From_City."<br>";
$SMSMessage=$SMSMessage."".$From_Name."(".$From_City.")-".$Mobile." ";
//echo "".$SMSMessage;
	if(strlen(trim($SMSMessage))>0)
	{
		if(strlen(trim($strmobile_no)) > 0)
		 SendSMS($SMSMessage, $strmobile_no);
		

	}
	//exit();
		}
	else
	{
			$_SESSION['Temp_Name'] = $From_Name  ;
			$_SESSION['Temp_mobile'] = $Mobile ;
			$_SESSION['Temp_email'] = $From_Email;
			$_SESSION['Temp_loan_type'] = $product_type ;
		if(strlen($product_type)>0)
		{
		echo "<script language=javascript>location.href='".getTransferURL($product_type)."?source=agentd4l'"."</script>";
		}
		else
			{
			echo "<script language=javascript>location.href='index.php?source=agentd4l'"."</script>";
		}


		}
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>For information on loans and hassle free loans contact - Deal4Loans</title>
<meta name="keywords" content="hassle free loans, loans india, best loan providers, loans interest rate, low interest loan, compare loans, online loan information">
<meta name="Description" content="Looking for hassle free loans at attractive interest rates and flexible repayment option; Deal4Loans provides you an online information services on flexible loan schemes available with best loan provider banks in India.">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<style>
.aplfrm{
background: none repeat scroll 0 0 #F6FCFF;
    border-left: 5px solid #A2D7F6;
    border-right: 5px solid #A2D7F6;
	}
</style>
<Script Language="JavaScript">
function addElement()
{
		var ni = document.getElementById('myDiv');
		var ni2 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
			ni.innerHTML = "<table bgcolor='#DAEAF9'  style='border:1px dotted #9C9A9C;' width=500><tr><td >&nbsp;<b>Name</b></td><td ><input type='text' name='Name'></td><td><a  onclick='removeElement();' style='cursor:pointer;'>close</a></td></tr><tr><td >&nbsp;<b>Email id</b></td><td ><input type='text' name='Email'></td></tr><tr><td >&nbsp;<b>Mobile No</b></td><td ><input type='text' name='mobile'></td></tr><tr><td colspan='2' align='center' height='40'> <input type='submit' value='submit' class='btnclr'></td></tr></table>";
				

		}

		if(ni2.innerHTML!="")
	{
			ni2.innerHTML = '';
	}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			ni.innerHTML = '';
			
		}
		
		return true;

	}

	function addElement1()
{
		var ni2 = document.getElementById('myDiv2');
		var ni = document.getElementById('myDiv');
		if(ni2.innerHTML=="")
		{
			ni2.innerHTML = "<table bgcolor='#DAEAF9'  style='border:1px dotted #9C9A9C;' width='60%'><tr><td ><b>Name</b></td><td ><input type='text' name='Name'></td><td><a  onclick='removeElement1();' style='cursor:pointer;'>close</a></td></tr><tr><td ><b>Email id</b></td><td ><input type='text' name='Email'></td></tr><tr><td ><b>Mobile No</b></td><td ><input type='text' name='mobile'></td></tr><tr><td ><b>Message</b></td><td ><textarea name='message' cols='35' rows='4'></textarea></td></tr><tr><td colspan='2' align='center' height='40'> <input type='submit' value='submit' class='btnclr'></td></tr></table></body>";
			
		}

		if(ni.innerHTML!="")
	{
			ni.innerHTML = '';
	}
	
		
		return true;

	}


function removeElement1()
{
		var ni2 = document.getElementById('myDiv2');
		
		if(ni2.innerHTML!="")
		{
		
			ni2.innerHTML = '';
			
		}
		
		return true;

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
function validateLogin(form)
{  
//	alert("dsfdf");
	if(form.L_email.value=="")
	{
			alert("please enter your email id!");
			form.L_email.focus();
				return false;
	}
	if(form.L_email.value!="")
	{
		if (!validmail(form.L_email.value))
		{
			//alert("Please enter your valid email address!");
			form.Email.focus();
			return false;
		}

	}
		if(form.L_pwd.value=="")
	{
			alert("please enter password!");
			form.L_pwd.focus();
				return false;
	}
		
	}

    </Script>
    
</head>

<body>
<?php include "top-menu.php"; ?>
<?php include "main-menu.php"; ?>

<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#4c4c4c;">Get the Deal4loans Advantage</a></div>

<div class="intrl_txt" style="margin:auto;">

<div style="width:663px; height:33; margin-top:0px; float:left; clear:right;">
<div style="width:663px; height:33; margin-top:15px; float:left; clear:right;">
<div style="clear:both; height:15px;"></div>
<h1 class="text3" style="width:500px; height:33px; margin-top:0px; float:left; clear:right; font-size:30px; text-transform:none; color:#88a943;"><strong>Get the Deal4loans Advantage</strong></h1>
<div style=" float:left; width:663px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="663" height="1" /></div>

<div style="clear:both; height:15px;"></div>
<!--class="lfttxtbar" -->
<div id="txt">
  
	        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                <td class="tbl_txt">If you are a DSA/Bank, Deal4Loans can help you by providing
				<ul>
				<li><b>Interested/Needy Customers :</b> Grow your business by reaching out to interested customers only. Deal4Loans will get you in touch with active and interested Loan Seekers only.</li>
				<li><b  > Leads from your location :</b> With Deal4Loans you enjoy the convenience of getting leads of customers from your location only.</li>
				<li><b > Eligible Customers :</b> You can choose the profile of customers matching your requirements.</li>
				<li><b  > Reliable pricing model :</b> As a Deal4Loans partner, you pay for only the valid leads.</li>
				</ul> 
           So Partner with us and see how your business grows!</td>
              </tr>
              <tr> 
      <td align="center"> <Script Language="JavaScript">
				
function cityother()
{
	if(agent_frm.city.value=="Others")
	{
		agent_frm.city_other.disabled = false;
	}
	else
	{
		agent_frm.city_other.disabled = true;
	}
}

function valButton3() {
    var cnt = -1;
	var i;
    for(i=0; i<document.agent_frm.Product.length; i++) 
	{
        if(document.agent_frm.Product[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}		



function validateMe(theFrm){

					var btn3;
					btn3=valButton3();
				if(theFrm.From_Name.value=="")
				{
					alert("Please enter Your Name");
					theFrm.From_Name.focus();
					return false;
				}
				
				
				if(theFrm.From_Email.value=="")
					{
						alert("Please enter  Email Address");
						theFrm.From_Email.focus();
						return false;
					}
				var str=theFrm.From_Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
					
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.From_Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.From_Email.focus();
					return false;
					}
				
				if (theFrm.query_type.selectedIndex==0)
					{
						alert("Please enter you are ");
						theFrm.query_type.focus();
						return false;
					}
					if (theFrm.city.selectedIndex==0)
					{
						alert("Please enter City Name to Continue");
						theFrm.city.focus();
						return false;
					}
					if((theFrm.city.value=="Others") && (theFrm.city_other.value=="" || theFrm.city_other.value=="Other City"  ) || !isNaN(theFrm.city_other.value))
					{
						alert("Kindly fill your Other City!");
						theFrm.city_other.focus();
						return false;
					}
					
					if(theFrm.Mobile.value=="")
					{
						alert("Please Enter Mobile Number");
						theFrm.Mobile.focus();
					return false;
					}
					  if(isNaN(theFrm.Mobile.value)|| theFrm.Mobile.value.indexOf(" ")!=-1)
					{
						  alert("Enter numeric value");
						  theFrm.Mobile.focus();
						  return false;  
					}
					if (theFrm.Mobile.value.length < 10 )
					{
							alert("Please Enter 10 Digits"); 
							 theFrm.Mobile.focus();
							return false;
					}
					if ((theFrm.Mobile.value.charAt(0)!="9") && (theFrm.Mobile.value.charAt(0)!="8")&& (theFrm.Mobile.value.charAt(0)!="7"))
					{
							alert("The number should start only with 9 or 8 or 7.");
							 theFrm.Mobile.focus();
							return false;
					}
					if (theFrm.query_type.selectedIndex==1)
					{
						if (theFrm.product_type.selectedIndex==0)
					{
						alert("Please enter Product Type to continue");
						theFrm.product_type.focus();
						return false;
					}
					}
					else
	{
					if(!btn3)
					{
						alert('Please Select Product you deal in.');
						return false;
					}
					
					if(theFrm.Company.value=="")
					{
						alert("Please Enter Bank Name");
						theFrm.Company.focus();
					return false;
					}
						
	}
									
		return true;
    }


	function hidefewthings()
{
	//alert(document.getElementById('Employment_Status').value);
	 if ((agent_frm.query_type.value=="1"))
       {
               document.getElementById('producttype').style.visibility = 'visible';
			    document.getElementById('producttype1').style.visibility = 'visible';
				document.getElementById('productdeal').style.visibility = 'hidden';
				document.getElementById('productdeal1').style.visibility = 'hidden';
				document.getElementById('associatedbank').style.visibility = 'hidden';
				document.getElementById('associatedbank1').style.visibility = 'hidden';
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }
	else {
		
                document.getElementById('productdeal').style.visibility = 'visible';
				document.getElementById('productdeal1').style.visibility = 'visible';
				document.getElementById('associatedbank').style.visibility = 'visible';
				document.getElementById('associatedbank1').style.visibility = 'visible';
			   document.getElementById('producttype').style.visibility = 'hidden';
			    document.getElementById('producttype1').style.visibility = 'hidden';
       }

       return true;
}   
function showDivs(prefix,chooser) {
        for(var i=0;i<chooser.options.length;i++) {
                var div = document.getElementById(prefix+chooser.options[i].value);
                div.style.display = 'none';
        }
        var div = document.getElementById(prefix+chooser.value);
        div.style.display = 'block';
}
window.onload=function() {
  document.getElementById('query_type').value='0';//set value to your default
}

function HandleAgent2()
{
 myWindow = window.open("PlayEditor/agent(may09).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 


}
function HandleAgent1()
{
 myWindow = window.open("PlayEditor/agent(march09).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 


}

function HandleAgent3()
{
 myWindow = window.open("PlayEditor/agent(june09).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 


}


function HandleAgent4()
{
 myWindow = window.open("PlayEditor/agent(oct10).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 


}


    </Script>
    
    </table> 
	<form name="agent_frm" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
                    
					<table width="458" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="74" valign="middle" background="images/apl-tp.gif" style="background-repeat:no-repeat; "><h2 style="color:#443133; font-size:17px;  margin:0 0 10px; padding:15px 0 3px; text-align:center; font-family:Arial, Helvetica, sans-serif;">DSA's/Banks Registration form</h2></td>
  </tr>
  
  <tr>
    <td class="aplfrm"><table width="400" border="0" align="right" cellpadding="0" cellspacing="0"   >
      <tr>
        <td width="37%" height="26" valign="middle" class="frmbldtxt">Your Name<font size="1" color="#FF0000">*</font></td>
        <td width="63%" align="left"><input name="From_Name" type="text" class="form" style="width:150px;" /></td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Your Email ID<font size="1" color="#FF0000">*</font></td>
        <td align="left"><input name="From_Email" type="text" class="form" style="width:150px;" /></td>
      </tr>
       <tr>
        <td height="26" valign="middle" class="frmbldtxt">Password<font size="1" color="#FF0000">*</font></td>
        <td align="left"><input name="pwd" type="password" class="form" style="width:150px;" /></td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">I am <font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmbldtxt"><select size="1" name="query_type" id="query_type" onchange="showDivs('div',this);"   style="width:155px;">
            <option value="0">Please Select</option>
            <option value="1">Looking for Loan</option>
            <option value="2">Running Loan Business</option>
          </select>        </td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">City <font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmbldtxt"><select size="1" name="city" id="city" onchange="cityother()"  style="width:155px;">
            <?=getCityList($city)?>
          </select>        </td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Other City<font size="1" color="#FF0000">*</font></td>
        <td width="63%" align="left" class="frmbldtxt"><input type="text" name="city_other" id="city_other" disabled="disabled" value="Other City" onfocus="this.select();" style="width:150px;" /></td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Mobile<font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmtxt">+91 
            <input name="Mobile" id="Mobile" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; type="text" class="form"  style="width:123px;" maxlength="10" /></td>
      </tr>
      <tr>
        <td valign="middle" class="frmbldtxt" colspan="2"><div id="div0" style="display:block;">
            <table width="430" border="0" align="right"  cellpadding="0" cellspacing="0">
              <tr>
                <td width="159" valign="middle" class="frmbldtxt">Product you deal in<font size="1" color="#FF0000">*</font></td>
                <td width="271" align="left" valign="middle" class="frmtxt"><input type="checkbox" value='Personal Loan'class="NoBrdr" id="Product" name="Product[]"  style="border:none;"/>
                  Personal Loan &nbsp;
                  <input type="checkbox" value='Home Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Home Loan <br />
                  <input type="checkbox" value='Car Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Car Loan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                  <input type="checkbox" value='Loan Against Property' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Loan Against Property<br />
                  <input type="checkbox" value='Business Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Business Loan &nbsp;&nbsp;<input type="checkbox" value='Credit Card' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                  Credit Card</td>
              </tr>
              <tr>
                <td class="frmbldtxt">Association with which Bank<font size="1" color="#FF0000">*</font></td>
                <td align="left"><input name="Company" type="text" class="form" style="width:150px;" /></td>
              </tr>
            </table>
        </div>
            <div id="div1" style="display:none;">
              <table border="0"  cellpadding="0" cellspacing="0" width="450"   >
                <tr>
                  <td valign="middle" class="frmbldtxt">Product Type <font size="1" color="#FF0000">*</font></td>
                  <td align="left" valign="middle" class="frmbldtxt" width="60%" ><select size="1" name="product_type" id="product_type" style="width:140px;" >
                      <option value="-1">Please Select</option>
                      <option value="Req_Loan_Personal">Personal Loan</option>
                      <option value="Req_Loan_Home">Home Loan</option>
                      <option value="Req_Loan_Car">Car Loan</option>
                      <option value="Req_Credit_Card">Credit Card</option>
                      <option value="Req_Loan_Against_Property">Loan Against Property</option>
                      <option value="Req_Business_Loan">Business Loan</option>
                    </select>                  </td>
                </tr>
              </table>
            </div>
          <div id="div2" style="display:none;">
              <table border="0"  cellpadding="0" cellspacing="0" width="450">
                <tr>
                  <td valign="middle" class="frmbldtxt">Product you deal in<font size="1" color="#FF0000">*</font></td>
                  <td align="left" valign="middle" class="frmbldtxt"><input type="checkbox" value='Personal Loan'class="NoBrdr" id="Product" name="Product[]" />
                    Personal Loan&nbsp;&nbsp; &nbsp;
                    <input type="checkbox" value='Home Loan' class="NoBrdr"  id="Product" name="Product[]" style="border:none;" />
                    Home Loan <br />
                    <input type="checkbox" value='Car Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                    Car Loan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                    <input type="checkbox" value='Loan Against Property' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                    Loan Against Property<br />
                    <input type="checkbox" value='Business Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                    Business Loan &nbsp;
                    <input type="checkbox" value='Credit Card' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;"/>
                    Credit Card</td>
                </tr>
                <tr>
                  <td class="frmbldtxt">Association with which Bank<font size="1" color="#FF0000">*</font></td>
                  <td align="left"><input name="Company" type="text" class="form"  style="width:140px;" /></td>
                </tr>
              </table>
          </div></td>
      </tr>
      <tr>
        <td class="frmbldtxt"></td>
        <td class="frmbldtxt"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><br />
            <input name="submit" type="submit" class="btnclr" value="Submit" /></td>
      </tr>
    </table></td>
  </tr>
   <tr>
          <td width="458" height="26"><img src="images/apl-bt.gif" width="458" height="26" /></td>
  </tr>
</table>
        </form></td>
              </tr>
	    <tr><td>&nbsp;</td></tr>

			  <tr><td class="tbl_txt">Payments should be made only addressed to <b>Wrs Info India Pvt Ltd</b> only.<br>
  
                    <b>Our address:</b> E-32, Sector-8 Noida -201301, Uttar Pradesh.<br>
			  </td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class="tbl_txt">We accept payments only via account in favour of Wrs Info India Pvt Ltd.<br>
We have our office in Noida only.<br>
Do not make any payments in any other name</td></tr>
                      <span class="tbl_txt">
                      </table>
                      </span></div>
<div style=" float:left; width:663px; height:auto; margin-top:3px; text-align:right;"><span class="text11" style="color:#4c4c4c; size:18px;"><img src="images/arrow.gif"  /> <a href="#"  style="color:#0f8eda;">Back to Top</a></span>
</div>
</div></div> 
<div style="float:right; clear:right; background-image:url(images/gray_bg.gif); width:275px; height:auto; margin-top:30px;">
<form action="agentloginpackages.php" method="post" name="login_page" onSubmit="return validateLogin(document.login_page);">
<table width="100%" border="0"  cellpadding="0" cellspacing="0" style="padding:3px; border:solid #00CCFF 6px;">
<tr>
	<td colspan="2" >
    <table width="256">
      <tr><td width="201">
    <h3 style="color:#443133; font-size:17px;  margin:0 0 10px; padding:5px 0 3px; text-align:left; font-family:Arial, Helvetica, sans-serif;">Login From Here</h3></td><td width="43" align="right"><img src="images/beta-t.jpg" border="0"></td>
</tr>
</table>
</td></tr>
<?php
if(strlen($_SESSION['Msg'])>0)
{
?>
<tr>
	<td colspan="2"  style="color:#FF0000; font-size:12px;  margin:0 0 10px; padding:5px 0 3px; text-align:left; font-family:Arial, Helvetica, sans-serif;">Wrong Details</td>
</tr>
<?php
}
?>
<tr>
	<td width="30%" height="30" valign="middle" class="frmbldtxt" >Email</td>
	<td width="70%"><input type="text" name="L_email" id="L_email" style="width:170px;"  /></td>
</tr>
<tr>
	<td height="30" valign="middle" class="frmbldtxt" >Password</td><td><input type="password" name="L_pwd" id="L_pwd" style="width:170px;" /></td>
</tr>
<tr>
	<td  height="30" >&nbsp;</td><td><input type="submit" name="submit" id="submit" value="Submit"  /></td>
</tr>

</table>
</form>
<table width="100%" border="0"  cellpadding="0" cellspacing="0" style="border:1px dashed #4a9fd1;">
        <tr>
  <td height="22"  bgcolor="#4a9fd1" align="center" class="quick"><font style="font-size:13px; font-weight:bold; color:#FFFFFF;">DSA's Speak Section </font></td>  </tr>
        <tr>
          <td height="22" align="left" valign="top"  bgcolor="#F4F9FD" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="99" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr bgcolor="#F4F9FD">
                <td height="120" align="center" valign="top" ><img src="images/rajesh-agent-sml.jpg" width="99" height="120" /></td>
              </tr>
            </table>
              <p ><a  href="/dsa-speak-section.php#oct" style="color:#04335F; text-decoration:none;   outline:none;"><b style="color:#04335F;">Mr.Rajesh,<br />
      DSA of the Month October 2010, </b> DSA of the Month has active association with Deal4Loans for sourcing Home Loan Leads since November'09 & disbursed 1 crore out of 150 leads. Mr. Rajesh is currently tied up with ICICI Bank Delhi. He has shared his experience with Deal4Loans about the conversions, lead quality, for generating business.<br />
   He has sourced leads from Deal4loans.com through the prepaid model and the association has been profitable for him.
Here is the snippet of the conversation we had with him on Dated 12th Oct 2010</a></p></td>
        </tr>
        <tr>
          <td height="22" align="left" valign="top"  bgcolor="#F4F9FD" style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="right" valign="middle" ><a onclick="HandleAgent4();" style="cursor:pointer; color:#e15002; font-weight:bold;">Listen Here</a></td>
                <td width="30" align="right" valign="middle" ><img src="images/trnsprnt-spkr.gif" width="23" height="19" style="cursor:pointer;" onclick="HandleAgent4();"/></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="22" align="left" valign="top"  bgcolor="#F4F9FD" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" >&nbsp;</td>
        </tr>
        <tr>
          <td height="22" align="left" valign="top"  bgcolor="#F4F9FD" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="99" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr bgcolor="#F4F9FD">
                <td height="120" align="center" valign="top" ><img src="images/mohit-agent-sml.jpg" width="100" height="120"></td>
              </tr>
            </table>
              <p ><a  href="/dsa-speak-section.php#aprl" style="color:#04335F; text-decoration:none;   outline:none;"><b style="color:#04335F;">Mr.Mohit Gokhale,<br>
                DSA of the Month April, </b> DSA of the Month has active association with Deal4Loans for sourcing Home Loan Leads since Mar&rsquo;09 & has converted maximum no. of leads in short span. Mr Mohit is currently tied up with LICHFL Mumbai. He has shared his experience with Deal4Loans about the conversions, lead quality, for generating business.<br>
                  He has sourced leads from Deal4loans.com through the prepaid model and the association has been profitable for him.<br>
                  Here is the snippet of the conversation we had with him on Dated 28th April 09:</a></p></td>
        </tr>
        <tr>
          <td height="22" align="left" valign="top"  bgcolor="#F4F9FD" style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="right" valign="middle" ><a onClick="HandleAgent2();" style="cursor:pointer; color:#e15002; font-weight:bold;">Listen Here</a></td>
              <td width="30" align="right" valign="middle" ><img src="images/trnsprnt-spkr.gif" width="23" height="19" style="cursor:pointer;" onClick="HandleAgent2();"/></td>
            </tr>
          </table></td>
        </tr>
       <tr>
          <td height="10" align="left" valign="middle"  bgcolor="#F4F9FD" style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><img src="images/rgt-sprt-line.jpg" width="207" height="1"></td>
       </tr>
       <tr>
          <td height="22" align="left" valign="top"  bgcolor="#F4F9FD" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="99" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr bgcolor="#F4F9FD">
              <td height="120" align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><img src="images/agent-pic-sml.jpg" width="99" height="120"></td>
            </tr>
          </table>
            <p ><a  href="/dsa-speak-section.php#mrch" style="color:#04335F; text-decoration:none; outline:none;"><b style="color:#04335F;">Mr.Anil Yadav,<br>
 DSA of the Month March, </b> has active association with Deal4Loans for sourcing Home Loan Leads since July'08.Mr Anil is currently tied up with Mumbai branch of Hdfc ltd. He has shared  his experience with Deal4Loans about the conversions, lead quality, for generating business.<br>
              He has sourced more than <b>500 leads from Deal4loans.com in the prepaid model</b>  and the association has been profitable for him .<br>
			  Here is the snippet of the conversation we had with him on Dated 13th Mar 09:</a> </p>          </td>
      </tr>
       <tr>
         <td height="10" align="left" valign="middle"  bgcolor="#F4F9FD" style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
           <tr>
             <td align="right" valign="middle" ><a onClick="HandleAgent1();" style="cursor:pointer; color:#e15002; font-weight:bold;">Listen Here</a></td>
             <td width="30" align="right" valign="middle" ><img src="images/trnsprnt-spkr.gif" width="23" height="19" style="cursor:pointer;" onClick="HandleAgent1();"/></td>
           </tr>
         </table></td>
       </tr>
    </table>
	</div>
</div> 



<?php include "footer1.php"; ?>
</body>
</html>
