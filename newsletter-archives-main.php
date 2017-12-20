<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	




if(isset($_POST['submit']))
{
	$msg = "Thank you for subscribing for Deal4loans.com Newsletter";
	$Name = $_POST['cust_name'];
	$Email = $_POST['cust_email'];
	 $Dated = ExactServerdate();
	if(strlen($Name)>0)
	{
		
		$dataInsert = array("Name"=>$Name, "Email"=>$Email, "Flag"=>1, "Dated"=>$Dated);
$table = 'Subscribe_Newsletter';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
	}
	//echo 
	//header("Location: newsletter_archives.php");
		echo "<script language=javascript>alert('".$msg."');"." location.href='newsletter_archives.php'"."</script>";

}

	?>
	 	
<html>
<head>

<title>Loan Information Portal India : Home Loans, Personal Loans, Car Loans, Loan Against Property</title>
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link href="/includes/style1.css" rel="stylesheet" type="text/css">
<script type="text/javascript">

/***********************************************
* Dynamic Ajax Content- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function ajaxpage(url, containerid){
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}
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



function validateMe(theFrm) {

	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";	
	
	if(theFrm.cust_name.value=="")
	{
		alert("Please enter the Name");
		theFrm.cust_name.focus();
		return false;
	}
	if(theFrm.cust_name.value!="")
	{
		 if(containsdigit(theFrm.cust_name.value)==true)
		{
			alert("Name contains numbers!");
			theFrm.cust_name.focus();
			return false;
		}
	}
	for (var i = 0; i <theFrm.cust_name.value.length; i++) {
		if (iChars.indexOf(theFrm.cust_name.value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		theFrm.cust_name.focus();
		
		return false;
		}
	}

	if(theFrm.cust_email.value=="")
	{
		alert("Please enter the Email Address");
		theFrm.cust_email.focus();
		return false;
	}
	if(theFrm.cust_email.value!="")
	{
		if (!validmail(theFrm.cust_email.value))
		{
			//alert("Please enter your valid email address!");
			theFrm.cust_email.focus();
			return false;
		}
	}
	
}					
					
</script>					
<?php include '~Top.php';?>
<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="/images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent">
	<?

		 ?>
		<?// }?>
	<div><table border="0" align="left"><tr><td><a href="/newsletter_archives.php">Newsletter Menu</a></td></tr> </table></div><br>
	<br>
  <!--<div align="left"><a href="newsletter_archives.php">Newsletter Menu</a></div>-->
	
	<div id="contentarea">  <table width="485" align="left" cellpadding="0" cellspacing="0">
	  <tr><td width="242">
	 <img src="images/newsletter-image.jpg" width="230" height="320" border="1" style="border:1px solid">
	<br></td>
	<td width="4">&nbsp;</td>
	
	
	<td width="230" height="320"valign="top" style="border:Black solid 1px;">

	<div style="margin-left:10px; margin-right:10px;  text-align:justify"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Advantages of Deal4loans Newsletter</b></font><br><br>
	
	<font face="Verdana" size="1" color="0F74D4" >•</font><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Interesting and informative articles about Loans and Cards.<br>
<font face="Verdana" size="1" color="0F74D4">•</font> Monthly Credit card offers<br>
<font face="Verdana" size="1" color="0F74D4">•</font> Tip of the month to get the inside understanding of your cards and loans.<br>
<font face="Verdana" size="1" color="0F74D4">•</font> Stay updated by monthly market news of the financial sector.<br>
<font face="Verdana" size="1" color="0F74D4">•</font> Get Expert’s Advice on Debt Consolidation Absolutely Free!!.<br>
<font face="Verdana" size="1" color="0F74D4">•</font> Stay updated of latest upcomings on Deal4loans like Live Chats, Rate your Bank etc.</font></div></td></tr>
	  <tr>
	    <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>Stay updated; sign up for our free newsletter to receive useful tips.</font></td>
	    </tr>


<tr>
<td colspan="3">
<form action="newsletter-archives-main.php" name="form" method="post" onSubmit="return validateMe(this);"><br>
<font face="Verdana, Arial, Helvetica, sans-serif" size="2">Name : &nbsp;&nbsp;&nbsp;<input type="text" size="20" name="cust_name"><br><br>
Email ID : <input type="text" size="20" name="cust_email"><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="submit"></font>
</form></td></tr>
<tr>
<td colspan="3">&nbsp;</td></tr>
	  </table>
	</div>
	
     </div>
<?
  include '~Right.php';
 
  ?>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>