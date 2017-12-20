<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//error_reporting(E_ALL);
	
		$SQL_CC = "select * from Articles where  Art_Main_Title like '%Credit Cards%' order by  Art_DOE desc";
		 list($NumRows_CC,$getrow)=MainselectfuncNew($SQL_CC,$array = array());
		$cntr=0;
		
		//$Query_CC = ExecQuery($SQL_CC);
		//$NumRows_CC = mysql_num_rows($Query_CC);
		$Title = $getrow[$cntr]['Art_Main_Title'];
		
	while($cntr<count($getrow))
        {
			$Art_Sub_Title = $getrow[$cntr]['Art_Sub_Title'];
			$Art_Url = $getrow[$cntr]['Art_Url'];
			$Art_Content = $getrow[$cntr]['Art_Content'];
			
		//	echo "<img src='images/dot.gif' height='6'/>&nbsp;<a href='".$Art_Url."'><font color='#0F74D4'>".$Art_Sub_Title."</font></a><br>";			
			
		$cntr = $cntr+1;}
	

if ($NumRows_CC != 0) {

 $file= fopen("results-articles.xml", "w");


 $_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
$_xml .="<rss version='2.0' xml:base='http://www.deal4loans.com' xmlns:dc='http://purl.org/dc/elements/1.1/'>\r\n";
$_xml .= "<channel>\r\n";

$_xml .= "<title>Deal4loans.com - Loans by choice Not by chance</title>\r\n";
$_xml .= "<link>http://www.deal4loans.com</link>\r\n";
$_xml .= "<description>".$Title." Articles</description>";
$_xml .= "<image><title>Deal4loans</title><url>http://deal4loans.com/images/logo-xml.gif</url><link>http://deal4loans.com/</link></image>";


// $_xml .="<site>\r\n";

//$NumRows_CC
for($i=0;$i<$NumRows_CC;$i++)
{
			$Art_Sub_Title = htmlentities(mysql_result($Query_CC,$i,'Art_Sub_Title'));
			$Art_Url = "http://www.deal4loans.com/".mysql_result($Query_CC,$i,'Art_Url');
		$Art_Content = htmlentities(mysql_result($Query_CC,$i,'Art_Content'));
		
$_xml .="<item>\r\n";
$_xml .="<title>".$Art_Sub_Title."</title>\r\n";
$_xml .= "<link>".$Art_Url."</link>\r\n";
$_xml .="\t\t<description>".$Art_Content."</description>\r\n";
$_xml .="</item>";

//$_xml .= "<link>".$Art_Url."</link>\r\n";
 }
 
//$_xml .="</site>";

$_xml .= "</channel>";
$_xml .= "</rss>";
//echo $xml;
//exit();
fwrite($file, $_xml);

 fclose($file);

 echo "XML has been written.  <a href=\"results-articles.xml\">View the XMLz	.</a>";

 } else {

 echo "No Records found";

 } 
 

 
 ?>