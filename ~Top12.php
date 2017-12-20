<link REL="SHORTCUT ICON" href="http://www.deal4loans.com/D4L.ico" type="image/vnd.microsoft.icon">
<script type="text/javascript" src="/scripts/dropdowntabs.js"></script>
<link href="/includes/glowtabs.css" rel="stylesheet" type="text/css">
<link href="/style.css" rel="stylesheet" type="text/css" >
<link  href="/newstyle.css" rel="stylesheet" type="text/css" >

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
   <!-- Start Top Panel -->
 

  <div >
<div >
<div class="global">
<div class="globalcont"></div>
</div>
<!-- Global Navigation end -->
<!-- masthead start -->
<div class="tphead">
<div class="mastheadcont">

<!-- <div class="pl">Deal4loans</div> -->
<div class="d4llogo"><img src="images/d4llogo.gif" width="287" height="63" /></div>
</div>
</div>


 <div align="center">
<div id="dvContainer">
  <div id="dvTopPanel">
    <div id="dvLogoPanel">
      <div id="dvLogo"></div>
      <div id="dvTopRightPanel">  
	 <?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<font style='Font-size:12px;'>Welcome ".ucwords($_SESSION['UserType'])." <b>".$_SESSION['UName']." ( <a href=Logout12.php>Logout</a> )</b>";
	}
?>
	  </div>
    </div>
  </div>  