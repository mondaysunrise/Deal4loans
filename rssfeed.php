<?
  header("Content-Type: application/xml; charset=ISO-8859-1");
  include("scripts/RSS.class.php");
  $rss = new RSS();
  echo $rss->GetFeed();
?>
	