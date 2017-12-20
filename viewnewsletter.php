<?php
ob_start();
$pageName = "/";
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//session_start();

$newsletter= $_REQUEST["newsletter"];

	if(strlen($newsletter)>0)
	{
	 $viewnewsletter="select * from Newsletter where  News_Id=$newsletter ";
	list($newsletterrecordcount,$viewnewsletter_result)=Mainselectfunc($viewnewsletter,$array = array());
		 for($j=0;$j<$newsletterrecordcount;$j++)
		 {		
			 $Content = $viewnewsletter_result[$j]['News_Content'];
			 $Subject = $viewnewsletter_result[$j]['News_Subject'];
			 $Date = $viewnewsletter_result[$j]['News_Month'];
			 $Id  = $viewnewsletter_result[$j]['News_Id'];
		 }
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Loan Information Portal India : <?php echo $Subject; ?></title>
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<link href="/source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/scripts/mainmenu.js"></script>
<link href="/style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="/js/dropdowntabs.js"></script>
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
</head>
<body>
<!--top-->

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->

<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;">
<u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="newsletter_archives.php"  class="text12" style="color:#4c4c4c;">Newsletter Menu</a></div>
<div class="intrl_txt">
<div style="margin:auto; width:970px; margin-top:1px;">
<div style="width:663px; height:33; margin-top:0px; float:left; clear:right;">

<div style="width:663px; height:33; margin-top:15px; float:left; clear:right;">
<h1 class="text3"  style="width:300px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;">Newsletter</h1>

<div class="text3" style="width:95px; height:33; margin-top:15px; float:right; clear:right;"><!--<a href="Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" name="Image3" width="95" height="20" border="0" id="Image3" /></a> -->&nbsp;</div>
</div>
<div style=" float:left; width:663px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="663" height="1" /></div>
<div style="clear:both; height:5px;"></div>
 <div id="contentarea"><? include $Content;?></div>
</div>
</div>

<?php include "~Right-Newsletter.php"; ?>
</div> 
<?php include "footer1.php"; ?>
</body>
</html>