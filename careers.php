<?php 
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
define("SITE_URL","http://www.deal4loans.com/");
	
$selqry="select id,Dept_Name, priority_flag from careers WHERE flag=1 GROUP BY Dept_Name Order by priority_flag DESC";
list($Numrows,$Deptrow)=MainselectfuncNew($selqry,$array = array());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo SITE_URL;?>careers-css/career-styles.css" type="text/css" rel="stylesheet"  />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Career with Us</title>
</head>
<body>
<div class="header">
<?php include "middle-menu.php"; ?>
<div class="headerin">
<div class="logo">&nbsp;</div>
</div>
</div>
<div class="clearfix"></div>
<div class="banner">
<div class="headerin padding">
<h1>About Us</h1>
<div class="dicription">
<span class="discriptiontext">
<ul>
<li>Deal4loans is India's largest B2C financial marketplace, with 6 million customers </li>
<li>Deal4loans added ~1 million New customers last year </li>
<li>Deal4loans disbursed more than $350 million worth of loans last year </li>
<li>Deal4loans has disbursed more than $1 billion through its platform</li>
<li>Deal4loans is one of the largest facilitators of Credit Cards in India </li>
<li>Deal4loans works with India's largest banks and NBFCs with more than 40 partnerships</li>
<li>Deal4loans is backed by some of the legendary technology investors from Silicon Valley</li>
</ul>
</span>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="wrapper">
<div class="column1">
<div class="name-wrapper">
<a href="https://in.linkedin.com/in/rishi-mehra-60b93113" target="_blank">
<div class="name-wrapper-in">Rishi Mehra</div>
<img src="<?php echo SITE_URL;?>careers-images/career-linkind.jpg" width="49" height="53" alt="career linkedin" /></a></div>
<div class="clearfix"></div>
<p>Rishi is a technology ninja and a super successful serial entrepreneur. Rishi co-founded  Network Perception Ltd and sold it in 2008, Rishi co-founded scanning technology firm Evolve Technology and exited in 2011. Rishi has Masters In e-business and Internet Systems from Durham University USA. Rishi is a sports fanatic, runs marathons and loves to play tennis everyday.</p>
</div>
<div class="column2"><div class="name-wrapper">
<a href="https://www.linkedin.com/in/puru-vashishtha-7b7b86" target="_blank"><div class="name-wrapper-in">Puru Vashishtha </div>
<img src="<?php echo SITE_URL;?>careers-images/career-linkind.jpg" width="49" height="53" alt="career linkedin" /></a></div>
<div class="clearfix"></div>
<p>Puru is a business and finance whiz. He is on the board of Deal4loans. Puru was part of Soros Fund, where he ran George Soros’s India investments. He has worked at various other hedge funds on Wall Street such as GTC and Fir Tree. Puru went to Stanford University for his MBA degree and has just moved back from Silicon Valley to Delhi to spend more time with Deal4loans. Puru is passionate about cricket, politics, and is up for a challenge in double trap rifle shooting. He also happens to have a big collection of single malts and bourbon.      </p>
</div>
<div class="clearfix"></div>
<hr />
<h2>Open positions</h2>
<div>
<?php 

$cntr=0;
while($cntr<count($Deptrow))
	{
		$Dept_Name = $Deptrow[$cntr]["Dept_Name"];
		

	$selectQ="select id, job_title, access_url from careers WHERE Dept_Name='".$Dept_Name."' Order by id DESC";
	list($CareerNumrows,$CareerRow)=MainselectfuncNew($selectQ,$array = array());
if($cntr%3==0)
	{
	echo '</div><div style="float:left; width:50%;">';
	}
 ?>			
<div>
<h3>+<?php echo $Dept_Name;?></h3>
<span class="joblisting">
<ul>
<?php 
$Careercnt=0;
while($Careercnt<count($CareerRow))
	{
		$job_title = $CareerRow[$Careercnt]["job_title"];
		$id = $CareerRow[$Careercnt]["id"];
		$AccessURL = $CareerRow[$Careercnt]['access_url'];
?>
<li><a href="<?php echo SITE_URL;?>career/<?php echo $AccessURL;?>"><?php echo "-".$job_title;?></a> </li>
<?php $Careercnt = $Careercnt+1;}?>
</ul>
</span>
</div>
<?php 
 $cntr=$cntr+1;
        }

?>
</div>
</div>
<div style="clear:both; height:10px;"></div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>