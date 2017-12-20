<?php
require 'scripts/db_init.php';
//require 'scripts/functions.php';
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Description" content="Looking for hassle free loans at attractive interest rates and flexible repayment option; Deal4Loans provides you an online information services on flexible loan schemes available with best loan provider banks in India.">
<meta name="keywords" content="hassle free loans, loans india, best loan providers, loans interest rate, low interest loan, compare loans, online loan information">

<title>For information on loans and hassle free loans contact - Deal4Loans</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />
<div id="dvMainbanner">
    <div id="dvNavbg">
      <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
   <?php if(isset($_SESSION['UserType']))
	{?>
   <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>
	<table width="450"  border="0" cellspacing="0" cellpadding="0" valign="top">
	<tr><td>
	<?

$getrelation="select object_id from wp_term_relationships where term_taxonomy_id=3";
list($recordcount,$rerow)=MainselectfuncNew($getrelation,$array = array());
$cntr=0;

//$getrelationresult=ExecQuery($getrelation);

while($cntr<count($rerow))
        {
			$postid=$rerow[$cntr]["object_id"];
			
$posts="select post_content,post_date,post_title,guid from wp_posts where ID=".$postid;
//$postsresult=ExecQuery($posts);
list($recordcount,$porow)=MainselectfuncNew($posts,$array = array());
$cntr2=0;
while($cntr2<count($rerow))
        {
				$post_content=$porow[$cntr2]["post_content"];
				$post_date=$porow[$cntr2]["post_date"];
				$post_title=$porow[$cntr2]["post_title"];
				$url=$porow[$cntr2]["guid"];
echo $url;
				echo "<a href='".$url."'><b>".$post_title."</b></a> ".$post_date."<br>";
				echo $post_content."<br><br>";
		  $cntr2=$cntr2+1;
		  }

		  $cntr=$cntr+1;
		  }

 
?>
<tr></td></table>
</td></tr></table>
 
    </div>
   <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right1.php';
  }
  ?>
  </div>
<?php include '~NewBottom.php';?>
</div>
  </body>
