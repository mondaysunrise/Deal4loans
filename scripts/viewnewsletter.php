<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

$newsletter= $_REQUEST["newsletter"];

	if(strlen($newsletter)>0)
	{
	 $viewnewsletter="select * from Newsletter where  News_Id=$newsletter ";
		//echo "ffff".$viewnewsletter."<br>";
			  $viewnewsletter_result = ExecQuery($viewnewsletter);
		$newsletterrecordcount = mysql_num_rows($viewnewsletter_result);
			 for($j=0;$j<$newsletterrecordcount;$j++)
		 {		
			 $Content = mysql_result($viewnewsletter_result,$j,'News_Content');
			 $Subject = mysql_result($viewnewsletter_result,$j,'News_Subject');
			 $Date = mysql_result($viewnewsletter_result,$j,'News_Month');
			 $Id  = mysql_result($viewnewsletter_result,$j,'News_Id ');
		 }
	}
?>
<html>
<head>
<title>Loan Information Portal India : <?php echo $Subject; ?></title>
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link href="includes/style1.css" rel="stylesheet" type="text/css">
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
<?php include '~Top.php';?>
<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="/images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent">
	
	<div><table border="0" align="left"><tr><td><a href="/newsletter_archives.php">Newsletter Menu</a></td></tr> </table></div><br>
	<br>
  <!--<div align="left"><a href="newsletter_archives.php">Newsletter Menu</a></div>-->
	
	<div id="contentarea"><? include $Content;?></div>
	
    </div>
<?
  include '~Right.php';
 
  ?>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>