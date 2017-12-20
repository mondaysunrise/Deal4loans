<?php
session_start();

//echo "New Server";
//echo "gfdf".$_SERVER['REQUEST_URI'];
if((strlen(strpos($_SERVER['REQUEST_URI'], "apply-personal-loans-continue-test1")) > 0) ||  (strlen(strpos($_SERVER['REQUEST_URI'], "apply-home-loans-continue-test1")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-home-loan-thank"))) || (strlen(strpos($_SERVER['REQUEST_URI'], "bajaj_finserv_thanks.php"))) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-home-loans-continue1"))) || (strlen(strpos($_SERVER['REQUEST_URI'], "insert_personal_loan_value_step2"))) ||  (strlen(strpos($_SERVER['REQUEST_URI'], "get_cc_eligiblebank.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply_personal_loan_step2.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "insert_personal_loan_value_step3_first.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], " insert_personal_loan_value_step3.php")) > 0) )
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
<div id="tptext_sml"> <a href="http://www.deal4loans.com/agent.php" style="color:#FF0000;">Agents Login</a> | <a href="http://www.deal4loans.com/About_Us.php">About Us</a> | <a href="http://www.deal4loans.com/Contents_Blogs.php" >Blogs</a> |  <a href="http://www.deal4loans.com/mediarelease.php">Media Coverage</a> | <a href="http://www.deal4loans.com/Contact_Us.php">Contact Us</a> | <a href="http://www.bimadeals.com" rel="nofollow" target="_blank" style="color:#FF0000;">Insurance Deals</a></div>
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
<div id="tptext"> <a href="http://www.deal4loans.com/agent.php" style="color:#FF0000;">Agents Login</a> | <a href="http://www.deal4loans.com/About_Us.php">About Us</a> | <a href="http://www.deal4loans.com/Contents_Blogs.php" >Blogs</a> |  <a href="http://www.deal4loans.com/mediarelease.php">Media Coverage</a> | <a href="http://www.deal4loans.com/Contact_Us.php">Contact Us</a> | <a href="http://www.bimadeals.com" rel="nofollow" target="_blank" style="color:#FF0000;">Insurance Deals</a></div>
</div>
	
	<?php
}
else if(((strlen(strpos($_SERVER['SCRIPT_NAME'], "index1.php")) != 0)))
{
?>
<a name="pg_up"></a>
<div id="dvtpbg">
<div id="logo">
	<img src="/new-images/d4l-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>	 
	
 <div id="tpagent"><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><g:plusone></g:plusone>	<a href="http://www.deal4loans.com/index.php"><img src="/new-images/home_icons.gif" alt="Home" title="Home" width="23" height="25" border="0" /></a> <a href="http://www.deal4loans.com/Contact_Us.php"><img  src="/new-images/contact_us.gif" alt="Contact Us" title="Contact Us" width="23" height="26" border="0" /></a> <a href="http://www.deal4loans.com/SiteMap.php"><img  src="/new-images/site_map.gif" alt="Sitemap" title="Sitemap" width="23" height="25" border="0" /></a> 
</div>
<div id="tptext"> <a href="http://www.deal4loans.com/agent.php" style="color:#FF0000;">Agents Login</a> | <a href="http://www.deal4loans.com/About_Us.php">About Us</a> | <a href="http://www.deal4loans.com/Contents_Blogs.php" >Blogs</a> | <a href="http://www.deal4loans.com/loans-in-india.php" >Loans in India</a> | <a href="http://www.deal4loans.com/mediarelease.php">Media Coverage</a> | <a href="http://www.deal4loans.com/Contact_Us.php">Contact Us</a> | <a href="http://www.bimadeals.com" rel="nofollow" target="_blank" style="color:#FF0000;">Insurance Deals</a></div>
</div>
<?php
}
else  if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loans.php")) > 0))
	 { ?> 
<a name="pg_up"></a>
<div id="dvtpbg">
<div id="logo">
	<img src="/new-images/d4l-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>	 
	<div style="float:left; margin-left:40px;">
	<iframe id='aaa3ed3d' name='aaa3ed3d' src='http://n.admagnet.net/d/fr/?n=aaa3ed3d&amp;zoneid=6072&amp;target=_blank&amp;cb=898928996&amp;ct0=INSERT_CLICKURL_HERE&amp;z=MzYwOg%3D%3D;'framespacing='0' frameborder='no' scrolling='no' width='468' height='56'>
</iframe>

</div>
 <div id="tpagent">	<a href="http://www.deal4loans.com/index.php"><img src="/new-images/home_icons.gif" alt="Home" title="Home" width="23" height="25" border="0" /></a> <a href="http://www.deal4loans.com/Contact_Us.php"><img  src="/new-images/contact_us.gif" alt="Contact Us" title="Contact Us" width="23" height="26" border="0" /></a> <a href="http://www.deal4loans.com/SiteMap.php"><img  src="/new-images/site_map.gif" alt="Sitemap" title="Sitemap" width="23" height="25" border="0" /></a> 
</div>
<div id="tptext"> <a href="http://www.deal4loans.com/agent.php" style="color:#FF0000;">Agents Login</a> | <a href="http://www.deal4loans.com/About_Us.php">About Us</a> | <a href="http://www.deal4loans.com/Contents_Blogs.php" >Blogs</a> |  <a href="http://www.deal4loans.com/mediarelease.php">Media Coverage</a> | <a href="http://www.deal4loans.com/Contact_Us.php">Contact Us</a> | <a href="http://www.bimadeals.com" rel="nofollow" target="_blank" style="color:#FF0000;">Insurance Deals</a></div>
</div>
<? }
else
{
?>
	  
 <a name="pg_up"></a>
<div id="dvtpbg">
<div id="logo">
	<img src="/new-images/d4l-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
<div style="float:left; margin-left:150px; padding-top:13px;"><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><g:plusone></g:plusone></div>
 <div style="float:left; margin-top:3px; border:1px solid #e8e8e8; padding:4px;">
<form action="http://www.deal4loans.com/content-search.php" id="cse-search-box">
<div>
<input type="hidden" name="cx" value="partner-pub-6880092259094596:mwuqti-nrmk" />
<input type="hidden" name="cof" value="FORID:9" />
<input type="hidden" name="ie" value="ISO-8859-1" />
<input type="text" name="q" size="31" />
<input type="submit" name="sa" value="" class="srch" /><br />
<font style="color:#FF0000;">Search your Banks and Loans</font>
</div>
</form>
<script type="text/javascript" src="http://www.google.co.in/cse/brand?form=cse-search-box&amp;lang=en"></script>

</div>

  <div id="tpagent">
	<a href="http://www.deal4loans.com/index.php"><img src="/new-images/home_icons.gif" alt="Home" title="Home" width="23" height="25" border="0" /></a> <a href="http://www.deal4loans.com/Contact_Us.php"><img  src="/new-images/contact_us.gif" alt="Contact Us" title="Contact Us" width="23" height="26" border="0" /></a> <a href="http://www.deal4loans.com/SiteMap.php"><img  src="/new-images/site_map.gif" alt="Sitemap" title="Sitemap" width="23" height="25" border="0" /></a> 
</div>
<div id="tptext"> <a href="http://www.deal4loans.com/agent.php" style="color:#FF0000;">Agents Login</a> | <a href="http://www.deal4loans.com/About_Us.php">About Us</a> | <a href="http://www.deal4loans.com/Contents_Blogs.php" >Blogs</a> |  <a href="http://www.deal4loans.com/mediarelease.php">Media Coverage</a> | <a href="http://www.deal4loans.com/Contact_Us.php">Contact Us</a> | <a href="http://www.bimadeals.com" rel="nofollow" target="_blank" style="color:#FF0000;">Insurance Deals</a></div>
</div>

 <?php } ?>

 