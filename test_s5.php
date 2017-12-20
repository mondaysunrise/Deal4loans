<?php
/*
session_start();
 echo "<br><pre>";
print_r($_SERVER);

//if((strlen(strpos($_SERVER['HTTP_REFERER'], "test_s4")) > 0))
if(!isset($_SERVER['HTTP_REFERER']))
{ 
		echo "You Refreshed the Page";
		die();
}
else
{	//Your Code here
	echo "Page Refreshed<br>";
}
 echo "<br><pre>";
print_r($_SERVER);
header("Location: 404.html");
	exit();

*/


echo $_SERVER['SERVER_SIGNATURE'];

if((strlen(strpos($_SERVER['DOCUMENT_ROOT'], "paylends")) > 0) || (strlen(strpos($_SERVER['HTTP_REFERER'], "paylends")) > 0))
{
echo "Referred Stop this";
//	header("Location: 404.html");
//	exit();
}

//if(strlen(strpos($_SERVER['SERVER_NAME'], "deal4loans")) > 0)
//if($_SERVER['SERVER_NAME']=="www.deal4loans.com")
if(strlen(strpos($_SERVER['SERVER_SIGNATURE'], "paylends")) > 0)
{
	echo "Show Content";
}
else
{
	echo "Site Not Found";
}

echo "<br><pre>";
print_r($_SERVER);

?>