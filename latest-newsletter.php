<?php
ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//session_start();

	 $viewnewsletter="SELECT * FROM `Newsletter` WHERE 1 =1 ORDER BY `News_Id` DESC ";
		
		 list($recordcount,$getrow)=MainselectfuncNew($viewnewsletter,$array = array());
		$cntr=0;
		$newsletterrecordcount = 1;
		while($cntr<count($getrow))
        {	
			 $Content = $getrow[$cntr]['News_Content'];
			 $Subject = $getrow[$cntr]['News_Subject'];
			 $Date = $getrow[$cntr]['News_Month'];
			 $Id  = $getrow[$cntr]['News_Id'];
		  $cntr=$cntr+1;
		
		 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loan Information Portal India : <?php echo $Subject; ?></title>
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<link href="/style/new-bima.css" rel="stylesheet"  type="text/css" />
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
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">  
<div id="lftbar">
<div class="lfttxtbar">
  <span><a href="/index.php">Home</a> > <a href="/newsletter_archives.php">Newsletter Menu</a></span>
  <h1  >Newsletter</h1>
  <div id="txt">
    <div id="contentarea"><? include $Content;?></div>
	
	<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="/new-images/top.gif"/></a></div>
  </div></div></div>
      <? if(!isset($_SESSION['UserType'])) 
  {
 include '~Right-Newsletter.php';
  }
  ?>
  <?php include '~Bottom-new1.php';?>
</div></body>
</html>

