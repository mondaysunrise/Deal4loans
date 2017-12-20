<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
		$SQL_CC = "select * from Articles where  1=1 order by  Art_DOE desc";
		//echo "hello".$SQL_CC;
		//$Query_CC = ExecQuery($SQL_CC);
	 list($recordcount,$getrow)=MainselectfuncNew($SQL_CC,$array = array());
		$cntr=0;	
		
		
		$NumRows_CC = count($getrow);
		$Title = $getrow[$cntr]['Art_Main_Title'];
		
		/*for($i=0;$i<$NumRows_CC;$i++)
		{
			$Art_Sub_Title = mysql_result($Query_CC,$i,'Art_Sub_Title');
			$Art_Url = mysql_result($Query_CC,$i,'Art_Url');
			$Art_Content = mysql_result($Query_CC,$i,'Art_Content');
			
			echo "<img src='images/dot.gif' height='6'/>&nbsp;<a href='".$Art_Url."'><font color='#0F74D4'>".$Art_Sub_Title."</font></a><br>";			
			
		}*/
	

if ($NumRows_CC != 0) {


//header('Content-Type: text/xml');
$check = "";
/*
$_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";

$_xml .="<rss version='2.0' xml:base='http://www.deal4loans.com' xmlns:dc='http://purl.org/dc/elements/1.1/'>\r\n";

$_xml .= "<channel>\r\n";

$_xml .= "<title>deal4loans.com - Loans by choice Not by chance</title>\r\n";
$_xml .= "<link>http://www.deal4loans.com</link>\r\n";
$_xml .= "<description>".$Title." Articles</description>";
*/
$check .="<table cellpadding=0>";
while($cntr<count($getrow))
        {
		$Art_Sub_Title = htmlentities(mysql_result($getrow[$cntr]['Art_Sub_Title']));
		$Art_Url = "http://www.deal4loans.com/".$getrow[$cntr]['Art_Url'];
		$ArtContent = $getrow[$cntr]['Art_Content'];
		$Art_DOE = $getrow[$cntr]['Art_DOE'];
		
		$expdat = explode(" ",$Art_DOE);
		$expdate = explode("-",$expdat[0]);
		$exptime = explode(":",$expdat[1]);	
			
		

		 
		$a = "<br><a href='$Art_Url'>read more</a>";
			
		$Art_Content = htmlentities($ArtContent." ".$a);

			
	//	$_xml .="<item>\r\n";
	//	$_xml .="<title>".$Art_Sub_Title."</title>\r\n";
	//	$_xml .= "<link>".$Art_Url."</link>\r\n";
	//	$_xml .= "<pubDate>".$Art_DOE."</pubDate>";
			
		$check .= "<tr><td>";
		$check .= "<a href='".$Art_Url."'>".$Art_Sub_Title."</a>";
		$check .= "</td></tr>";
		//$_xml .="\t\t<description>".$Art_Content."</description>\r\n";
		$_xml .="</item>";

$cntr=$cntr+1;
 }
 $check .="</table>";
echo $check;

//$_xml .= "</channel>";
//$_xml .= "</rss>";
//echo $_xml;

 } else {

 echo "No Records found";

 } 
?>