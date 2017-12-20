<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//error_reporting(E_ALL);
	
$sql = "Select * From Req_Message Where 1=1 and Is_Verified=1 order by Dated asc";
//$Query = ExecQuery($sql);
//$NumRows_1 = mysql_num_rows($Query);

list($NumRows_1,$getrow)=MainselectfuncNew($sql,$array = array());
$cntr=0;

if ($NumRows_1 != 0) {

 $file= fopen("results-testimonials.xml", "w");

$_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
$_xml .="<rss version='2.0' xml:base='http://www.deal4loans.com' xmlns:dc='http://purl.org/dc/elements/1.1/'>\r\n";
$_xml .= "<channel>\r\n";

$_xml .= "<title>Deal4loans.com - Loans by choice Not by chance</title>\r\n";
$_xml .= "<link>http://www.deal4loans.com</link>\r\n";
$_xml .= "<description>Testimonials</description>";
$_xml .= "<image><title>Deal4loans</title><url>http://deal4loans.com/images/logo.gif</url><link>http://deal4loans.com/</link></image>";


// $_xml .="<site>\r\n";
while($cntr<count($getrow))
        {
			$Name = $getrow[$cntr]['Name'];
			$Message = $getrow[$cntr]['Message'];
			$Subject = $getrow[$cntr]['Subject'];
		 	$PostID = $getrow[$cntr]['PostID'];
			
			$Dated = $getrow[$cntr]['Dated'];
		//	$link = ;
		$_xml .="<item>\r\n";
		$_xml .="<title>".$Subject."</title>\r\n";
		$_xml .= "<link>http://www.deal4loans.com</link>\r\n";
		$_xml .="\t\t<description>".$Message."</description>\r\n";
		$_xml .="<pubDate>".$Dated."</pubDate>";
		$_xml .="\t\t<dc:creator>".$Name."</dc:creator>\r\n";
		$_xml .="</item>";
 	
	
	$sql1 = "Select * From req_reply_message Where PostID='$PostID' and Is_Verified=1 order by Dated desc ";
	//echo "pppppppppp".$sql1."<br>";
	
	list($NumRows_2,$Myrow)=MainselectfuncNew($sql1,$array = array());
$i=0;
	//$Query2 = ExecQuery($sql1);
	//$NumRows_2 = mysql_num_rows($Query2);
	if($NumRows_2>0)
	{
		while($i<count($Myrow))
        {
			$ReplyName = $Myrow[$i]['Name'];
			$ReplyMessage = $Myrow[$i]['Message'];
			
			$_xml .="<item>\r\n";
			
			$_xml .="<title>Reply : ".$ReplyName."</title>\r\n";
			//$_xml .= "<link>".$Message."</link>\r\n";
			$_xml .="\t\t<description>Reply : ".$ReplyMessage."</description>\r\n";
			$_xml .="</item>";
		$i = $i+1;}
	
	}
 $cntr = $cntr+1;}
 
//$_xml .="</site>";

$_xml .= "</channel>";
$_xml .= "</rss>";
//echo $xml;
//exit();
fwrite($file, $_xml);

 fclose($file);

 echo "XML has been written.  <a href=\"results-testimonials.xml\">View the XML.</a>";

 } else {

 echo "No Records found";

 } 
 

 
 ?>