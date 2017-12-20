<?php
session_start();
if(!isset($_SESSION['siten']))
{
	$_SESSION['siten'] = $_GET['site'];
}


if($_SESSION['siten']=="ndtv")
{
	if(isset($_SESSION['siten']))
	{
		 $inactive = 12000;
		if(isset($_SESSION['timeout']) ) {
			$session_life = time() - $_SESSION['timeout'];
			//echo "<br>".$session_life;
			if($session_life > $inactive)
			{
				session_destroy(); 
				 header("Location: index.php");
			}
		}
		$_SESSION['timeout'] = time();
	
	}

?>

<link href="/css/ndtvmoney.css" rel="stylesheet" type="text/css" />
<link href="http://www.ndtv.com/ndtvmoney/css/mastheader.css" rel="stylesheet" type="text/css" />
<link href="/css/common.css" rel="stylesheet" type="text/css" />
 <a name="pg_up"></a>
<div class="global">
<div class="globalcont">
<div style="width:550px; float:left;">
<script type="text/javascript" src="http://www.ndtv.com/ndtvmoney/js/globe_nav.js"></script> 
</div>
<div style="width:410px; float:left; "><!-- <img src="images/right.jpg" width="410" height="53" /> --></div>
<!-- <img src="images/global_nav.gif" width="960" border="0" /> --> </div>

</div>
<!-- Global Navigation end -->
<!-- masthead start -->

<!-- <div class="mastheadcont" style="height:80px; padding-top:5px;">
    <div style="float:left; width:249px; "><img src="/images/ndtv_money_logo.gif" width="249" height="80" /></div>
       <div  style="float:right; width:201px; padding-right:10px; padding-top:15px; height:45px;"><img src="/images/d4llogo2.gif" alt="Deal4loans" width="201" height="45" /></div>
</div>

<div align="center" style="padding-bottom:8px;"> -->
<!--Iframe Tag  -->
<!-- begin ZEDO for channel: Partner - Money , publisher: default , Ad Dimension: Super Banner - 728 x 90 -->
<!-- <iframe src="http://d2.zedo.com/jsc/d2/ff2.html?n=767;c=148;d=14;w=728;h=90" frameborder=0 marginheight=0 marginwidth=0 scrolling="no" allowTransparency="true" width=728 height=90></iframe> -->
<!-- end ZEDO for channel: Partner - Money , publisher: default , Ad Dimension: Super Banner - 728 x 90 -->
<!-- </div> -->

<div class="mastheadcont" style="height:116px; padding-top:5px; padding-bottom:8px;">
    <div style="float:left; width:215px; "><img src="/images/money_logo2.gif" width="215" height="116" /></div>
<div class="ad728" align="center" style="padding-left:17px; padding-top:15px;">
<!--Iframe Tag  -->
<!-- begin ZEDO for channel: Partner - Money , publisher: default , Ad Dimension: Super Banner - 728 x 90 -->
<iframe src="http://d2.zedo.com/jsc/d2/ff2.html?n=767;c=148;d=14;w=728;h=90" frameborder=0 marginheight=0 marginwidth=0 scrolling="no" allowtransparency="true" width=728 height=90></iframe>
<!-- end ZEDO for channel: Partner - Money , publisher: default , Ad Dimension: Super Banner - 728 x 90 -->
</div>
</div>

<!-- masthead end -->
<!-- topnav start -->
<? if((strlen(strpos($_SERVER['REQUEST_URI'], "credit-cards.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Mustread.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Faqs.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/ndtvmoney/credit-card-comparision.php")) > 0))
{
?>

<div class="topnav marb15">
  <div class="topnavcont">
    <a class="topnavbut" href="http://money.ndtv.com/" target="_parent"><span>Home</span></a>
    <a class="topnavbut" href="http://ndtvmoney.policybazaar.com"  target="_parent"><span>Insurance</span></a>
    <a class="topnavbut" href="http://ndtvmoney.deal4loans.com"  target="_parent"><span>Loans</span></a>
    <b class="seltopnavbut"><span>Credit Cards</span></b>
    <!--<a class="topnavbut" href="#"><span>Utilities</span></a> -->
	<a class="topnavbut" href="http://money.ndtv.com/remit2india.html"  target="_parent"><span>Remit2India</span></a>
  </div>
</div>
<? }
else
	{
	?>
<div class="topnav marb15">
  <div class="topnavcont">
    <a class="topnavbut" href="http://money.ndtv.com/" target="_parent"><span>Home</span></a>
    <a class="topnavbut" href="http://ndtvmoney.policybazaar.com"  target="_parent"><span>Insurance</span></a>
    <b class="seltopnavbut"><span>Loans</span></b>
    <a class="topnavbut"  href="http://ndtvmoney.deal4loans.com/credit-cards.php"  target="_parent"><span>Credit Cards</span></a>
    <!--<a class="topnavbut" href="#"><span>Utilities</span></a> -->
	<a class="topnavbut" href="http://money.ndtv.com/remit2india.html"  target="_parent"><span>Remit2India</span></a>
  </div>
</div>
<? } ?>
<!--<div class="blubg"></div>-->
<?php
}
else
{
//echo "gfdf".$_SERVER['REQUEST_URI'];
if((strlen(strpos($_SERVER['REQUEST_URI'], "apply-personal-loans-continue-test1")) > 0) ||  (strlen(strpos($_SERVER['REQUEST_URI'], "apply-home-loans-continue-test1")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-home-loan-thank"))) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-home-loans-continue1"))) || (strlen(strpos($_SERVER['REQUEST_URI'], "insert_personal_loan_value_step2"))))
{

   
  
 // echo $_SERVER['REQUEST_URI']."H";
 ?>
	    
 <a name="pg_up"></a>
<div id="dvtpbg_sml">
<div id="logo_sml">
	<img src="/new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
  <div id="tpagent_sml">
	<a href="http://www.deal4loans.com/index.php"><img src="/new-images/home_icons.gif" alt="Home" title="Home" width="23" height="25" border="0" /></a> <a href="http://www.deal4loans.com/Contact_Us.php"><img  src="/new-images/contact_us.gif" alt="Contact Us" title="Contact Us" width="23" height="26" border="0" /></a> <a href="http://www.deal4loans.com/SiteMap.php"><img  src="/new-images/site_map.gif" alt="Sitemap" title="Sitemap" width="23" height="25" border="0" /></a> 
</div>
<div id="tptext_sml"> <a href="http://www.deal4loans.com/agent.php" style="color:#FF0000;">Agents Login</a> | <a href="http://www.deal4loans.com/About_Us.php">About Us</a> | <a href="http://www.deal4loans.com/Contents_Blogs.php" >Blogs</a> |  <a href="http://www.deal4loans.com/mediarelease.php">Media Coverage</a> | <a href="http://www.deal4loans.com/quiz.php">Loan Quiz</a> | <a href="http://www.bimadeals.com" rel="nofollow" target="_blank" style="color:#FF0000;">Insurance Deals</a></div>
</div>

<? }
else  if((strlen(strpos($_SERVER['REQUEST_URI'], "apply-personal-loan")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-home-loans")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-car-loans")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-credit-card")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-loan-against-property")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-business-loans")) > 0))
	 { ?>
 <a name="pg_up"></a>
<div id="dvtpbg">
<div id="logo">
	<img src="/new-images/d4l-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>	 
	
 <div id="tpagent">
	<a href="http://www.deal4loans.com/index.php"><img src="/new-images/home_icons.gif" alt="Home" title="Home" width="23" height="25" border="0" /></a> <a href="http://www.deal4loans.com/Contact_Us.php"><img  src="/new-images/contact_us.gif" alt="Contact Us" title="Contact Us" width="23" height="26" border="0" /></a> <a href="http://www.deal4loans.com/SiteMap.php"><img  src="/new-images/site_map.gif" alt="Sitemap" title="Sitemap" width="23" height="25" border="0" /></a> 
</div>
<div id="tptext"> <a href="http://www.deal4loans.com/agent.php" style="color:#FF0000;">Agents Login</a> | <a href="http://www.deal4loans.com/About_Us.php">About Us</a> | <a href="http://www.deal4loans.com/Contents_Blogs.php" >Blogs</a> |  <a href="http://www.deal4loans.com/mediarelease.php">Media Coverage</a> | <a href="http://www.deal4loans.com/quiz.php">Loan Quiz</a> | <a href="http://www.bimadeals.com" rel="nofollow" target="_blank" style="color:#FF0000;">Insurance Deals</a></div>
</div>
	
	<?php
}
else if(((strlen(strpos($_SERVER['SCRIPT_NAME'], "index11.php")) != 0)))
{
?>
<a name="pg_up"></a>
<div id="dvtpbg">
<div id="logo">
	<img src="/new-images/d4l-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>	 
	
     <div style="float:left; margin-left:10px;  margin-top:2px; border:0px solid #e8e8e8; width:454; background-color:#e0e0e0;">
     <img src="/new-images/mon.gif" border="0"  />
<!--<img src="/new-images/test.jpg" alt="Deal4loans" /> -->
<iframe id='a318555f' name='a318555f' src='http://n.admagnet.net/d/fr/?n=a318555f&amp;zoneid=5356&amp;target=_blank&amp;cb=994353084&amp;ct0=INSERT_CLICKURL_HERE' framespacing='0' frameborder='no' scrolling='no' width='450' height='60'>
<script type='text/javascript' src='http://j.admagnet.net/panda/if/Horizontal-450x60/Deal4loansCPL_450x60_1303882842.js?'></script>
<noscript>
<a href='http://n.admagnet.net/d/ck/?n=abbbf86d&amp;cb=994353084' target='_blank'><img src='http://n.admagnet.net/d/vi/?zoneid=5356&amp;cb=994353084&amp;n=abbbf86d&amp;ct0=INSERT_CLICKURL_HERE' border='0' alt='' /></a>
</noscript>
</iframe>
</div> 
 <div id="tpagent">
	<a href="http://www.deal4loans.com/index.php"><img src="/new-images/home_icons.gif" alt="Home" title="Home" width="23" height="25" border="0" /></a> <a href="http://www.deal4loans.com/Contact_Us.php"><img  src="/new-images/contact_us.gif" alt="Contact Us" title="Contact Us" width="23" height="26" border="0" /></a> <a href="http://www.deal4loans.com/SiteMap.php"><img  src="/new-images/site_map.gif" alt="Sitemap" title="Sitemap" width="23" height="25" border="0" /></a> 
</div>
<div id="tptext"> <a href="http://www.deal4loans.com/agent.php" style="color:#FF0000;">Agents Login</a> | <a href="http://www.deal4loans.com/About_Us.php">About Us</a> | <a href="http://www.deal4loans.com/Contents_Blogs.php" >Blogs</a> |  <a href="http://www.deal4loans.com/mediarelease.php">Media Coverage</a> | <a href="http://www.deal4loans.com/quiz.php">Loan Quiz</a> | <a href="http://www.bimadeals.com" rel="nofollow" target="_blank" style="color:#FF0000;">Insurance Deals</a></div>
</div>
<?php
}
else
{
?>
	  
 <a name="pg_up"></a>
<div id="dvtpbg">
<div id="logo">
	<img src="/new-images/d4l-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
  <div style="float:left; margin-left:100px;  margin-top:2px; border:0px solid #e8e8e8;">
<!--<img src="/new-images/test.jpg" alt="Deal4loans" /> -->
<iframe id='a318555f' name='a318555f' src='http://n.admagnet.net/d/fr/?n=a318555f&amp;zoneid=5356&amp;target=_blank&amp;cb=994353084&amp;ct0=INSERT_CLICKURL_HERE' framespacing='0' frameborder='no' scrolling='no' width='450' height='60'>
<script type='text/javascript' src='http://j.admagnet.net/panda/if/Horizontal-450x60/Deal4loansCPL_450x60_1303882842.js?'></script>
<noscript>
<a href='http://n.admagnet.net/d/ck/?n=abbbf86d&amp;cb=994353084' target='_blank'><img src='http://n.admagnet.net/d/vi/?zoneid=5356&amp;cb=994353084&amp;n=abbbf86d&amp;ct0=INSERT_CLICKURL_HERE' border='0' alt='' /></a>
</noscript>
</iframe>
</div> 
  <div id="tpagent">
	<a href="http://www.deal4loans.com/index.php"><img src="/new-images/home_icons.gif" alt="Home" title="Home" width="23" height="25" border="0" /></a> <a href="http://www.deal4loans.com/Contact_Us.php"><img  src="/new-images/contact_us.gif" alt="Contact Us" title="Contact Us" width="23" height="26" border="0" /></a> <a href="http://www.deal4loans.com/SiteMap.php"><img  src="/new-images/site_map.gif" alt="Sitemap" title="Sitemap" width="23" height="25" border="0" /></a> 
</div>
<div id="tptext"> <a href="http://www.deal4loans.com/agent.php" style="color:#FF0000;">Agents Login</a> | <a href="http://www.deal4loans.com/About_Us.php">About Us</a> | <a href="http://www.deal4loans.com/Contents_Blogs.php" >Blogs</a> |  <a href="http://www.deal4loans.com/mediarelease.php">Media Coverage</a> | <a href="http://www.deal4loans.com/quiz.php">Loan Quiz</a> | <a href="http://www.bimadeals.com" rel="nofollow" target="_blank" style="color:#FF0000;">Insurance Deals</a></div>
</div>

 <?php } ?>
 <?php } ?>
 