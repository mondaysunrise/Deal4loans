<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//error_reporting(E_ALL);
	$absolutepath = "http://www.deal4loans.com/";
$sql = "SELECT * FROM `hesk_show_transcript` WHERE 1=1 and TrackFlag=1";
 list($NumRows_1,$getrow)=MainselectfuncNew($sql,$array = array());
		$cntr=0;

//$Query = ExecQuery($sql);
//$NumRows_1 = mysql_num_rows($Query);
$file= fopen("results-debt-consolidation-new.xml", "w");
if ($NumRows_1 != 0) {

 //Mon, 17 Mar 2008 08:33:24 GMT

$_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
//$_xml .="<rss version='2.0' xml:base='http://www.deal4loans.com/results-debt-consolidation.php' xmlns:dc='http://purl.org/dc/elements/1.1/'>\r\n";
$_xml .="<rss version='2.0' xml:base='http://www.deal4loans.com'>\r\n";
$_xml .= "<channel>\r\n";

$_xml .= "<title>Deal4loans.com - Loans by choice Not by chance</title>\r\n";
$_xml .= "<link>http://www.deal4loans.com</link>\r\n";
$_xml .= "<description>Debt Consolidation Queries </description>";
$_xml .= "<image><title>Deal4loans</title><url>http://deal4loans.com/images/logo-xml.gif</url><link>http://deal4loans.com/</link></image>";


// $_xml .="<site>\r\n";
//for($i=0;$i<$NumRows_1;$i++)
while($cntr<count($getrow))
        {
		$TrackID = $getrow[$cntr]['TrackID'];
		 $HtID 	= $getrow[$cntr]['HtID'];
$sql_ticket = "SELECT * FROM `hesk_tickets` WHERE trackid='".$TrackID."'";
		list($RowCount,$Myrow)=MainselectfuncNew($sql_ticket,$array = array());
		$i=0;
			
			//$query_ticket = ExecQuery($sql_ticket);
			$message = $Myrow[$i]['view_message'];
			$name = $Myrow[$i]['name'];
			$dt = $Myrow[$i]['dt'];
			$name = ucfirst(strtolower($name));
//echo "<br>";
			$MessageContent = strstr($message, 'Query :');
			$FinalMessage = str_replace("Query :", " ", htmlentities($MessageContent));
			
			
		$FirstComponent = explode(" ", $dt);	
		$DateComponent = explode("-", $FirstComponent[0]);
		$TimeComponent = explode(":", $FirstComponent[1]);  
		$FinalDate = date("D, j M Y G:i:s T", mktime($TimeComponent[0], $TimeComponent[1], $TimeComponent[2], $DateComponent[1], 	$DateComponent[2], $DateComponent[0]));	
			
			
			
			
		$url = $absolutepath."debt-consolidation/loan-guru/".$TrackID."/ask-amitoj/".$HtID;
		//echo "<br>";
		//	$link = ;
		$countdata = $i+1;
		$_xml .="<item>\r\n";
		//$_xml .="<title>".$name."</title>\r\n";
		$_xml .="<title>Query Initiated by : ".$name."</title>\r\n";
		$_xml .= "<link>".$url."</link>\r\n";
		$_xml .="<pubDate>".$FinalDate."</pubDate>";
			$_xml .="\t\t<description>".$FinalMessage."</description>\r\n";
	
		
	//	$_xml .="\t\t<dc:creator>".$Name."</dc:creator>\r\n";
		$_xml .="</item>";
 	
	
	
 }
 
//$_xml .="</site>";

$_xml .= "</channel>";
$_xml .= "</rss>";
//echo $xml;
//exit();
fwrite($file, $_xml);



 echo "XML has been written.  <a href=\"results-debt-consolidation-new.xml\">View the XML.</a>";

 } else {

 echo "No Records found";

 } 
 
 fclose($file);
 
 ?>