<?php
session_start();
if(!isset($_SESSION['siten']))
{
	$_SESSION['siten'] = $_GET['site'];
}
?>
<link REL="SHORTCUT ICON" href="http://www.deal4loans.com/D4L.ico" type="image/vnd.microsoft.icon">
<script type="text/javascript" src="/scripts/dropdowntabs.js"></script>
<link href="/includes/glowtabs.css" rel="stylesheet" type="text/css">
<link href="/style.css" rel="stylesheet" type="text/css" >
<link  href="/newstyle.css" rel="stylesheet" type="text/css" >

<script language="JavaScript" type="text/JavaScript">

function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
   
	   myWindow = window.open(filename, "tinyWindow", 'resizable height=350, scrollbars' )
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}


function HandleOnSubmit(file_name) {

	   myWindow = window.open(file_name, "tinyWindow", 'resizable height=520,width=504')
	   myWindow.document.close() 

}

function HandleOnSubmitPLSal(file_name) {

	   myWindow = window.open(file_name, "tinyWindow", 'resizable height=520,width=504')
	   myWindow.document.close() 

}


/*
function HandleOnSubmit(file_name,getheight, getwidth) {
	var heigh = getheight;
	var widt = getwidth;
		//alert (getheight);
		alert (getwidth);
	   myWindow = window.open(file_name, "tinyWindow", 'resizable width=widt,height=heigh')
	   myWindow.document.close() 

}*/


//-->
</script>

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>

<?php

if($page_Name=="PersonalLoan")
	$filename = "closedby_pl.php";
else if($page_Name=="HomeLoan")
	$filename = "closedby_hl.php";
else if($page_Name=="CarLoan")
	$filename = "closedby_cl.php";
else if($page_Name=="CreditCard")
	$filename = "closedby_cc.php";
else if($page_Name=="LoanAgainstProperty")
	$filename = "closedby_lap.php";
	


if($page_Name=="PersonalLoan" || $page_Name=="CarLoan" || $page_Name=="HomeLoan" || $page_Name=="CreditCard" || $page_Name=="LoanAgainstProperty" || $page_Name=="BusinessLoan")

{ 
	?>
<!--<body onload="MM_preloadImages('images/Ft_menu_Personal_loan_Over.gif','images/Ft_menu_Home_Loan_Over.gif','images/Ft_menu_Car_loan_Over.gif','images/Ft_menu_Credit_cards_Over.gif','images/Ft_menu_Loan_against_Over.gif','images/Ft_menu_Life_Insurance_Over.gif','images/Ft_menu_Loan_Gyan_Over.gif','images/Ft_menu_Blogs_Over.gif','images/Ft_menu_Testimonials_Over.gif','images/Ft_menu_Contests_Over.gif')" >-->

<!--<body  onbeforeunload="HandleOnClose('<?php //echo $filename; ?>')"> -->
<body>
<?php
	
}
else if(isset($_GET['popup']))
{
?>

<body >

<?php 
}

else
	{
		$product = $_GET['product'];
	
		if(($product=="PersonalLoan") || ($product=="plsalaryclause"))
			$file_name = "popup_pl.php?product=$product";
		else if(($product=="HomeLoan") || ($product=="hlsalaryclause"))
			$file_name = "popup_hl.php?product=$product";
		else if($product=="CreditCard")
			$file_name = "popup_cc.php?product=CreditCard";
		else if(($product=="CarLoan") || ($product=="clsalaryclause"))
			$file_name = "popup_cl.php?product=$product";
		else if(($product=="PropertyLoan") || ($product=="lapsalaryclause"))
			$file_name = "popup_lap.php?product=$product";
			
		
		if($product=="PersonalLoan" || $product=="CarLoan" || $product=="HomeLoan" || $product=="CreditCard" || $product=="PropertyLoan" || $product=="plsalaryclause" || $product=="lapsalaryclause" || $product=="clsalaryclause" || $product=="hlsalaryclause")
		{
		

		if($product=="plsalaryclause" || $product=="lapsalaryclause" || $product=="clsalaryclause" || $product=="hlsalaryclause" ) 
			{
			?>
				<body onload=" HandleOnSubmitPLSal('<?php echo $file_name;?>');"  onbeforeunload="HandleOnClose('<?php echo $filename; ?>')">
			<?php
			}
			else
			{
			?>
				<body onload=" HandleOnSubmit('<?php echo $file_name;?>');"  onbeforeunload="HandleOnClose('<?php echo $filename; ?>')">
			<?php
			}
		
		
		}
		else {	
?>


<body  >

<?php 
		}
}
?>
 <?
 
$flag = $_REQUEST['flag'];
$_SESSION['flag'] = $flag;

$source = $_REQUEST['source'];
$_SESSION['source'] = $source;

?>


  <!-- Start Top Panel -->
  <?php
 if($_SESSION['siten']=="ndtv")
{
	if(isset($_SESSION['siten']))
	{
		 $inactive = 1200;
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

<link href="css/ndtvmoney.css" rel="stylesheet" type="text/css" />
 <a name="pg_up"></a>
  <div >
<div >
<div class="global">
<div class="globalcont"><img src="images/global_nav.gif" width="960" border="0" /></div>
</div>
<!-- Global Navigation end -->
<!-- masthead start -->
<div class="tphead">
<div class="mastheadcont">
<div class="moneylogo">
<img src="images/money_logo.gif" width="231" height="56" />    </div>
<!-- <div class="pl">Deal4loans</div> -->
<div class="d4llogo"><img src="images/d4llogo.gif" width="287" height="63" /></div>
</div>
</div>
<!-- masthead end -->
<!-- topnav start -->
<div class="blubg"></div>
<?php
}
else
{
?>
 <div align="center">
<div id="dvContainer">
  <div id="dvTopPanel">
    <div id="dvLogoPanel">
      <div id="dvLogo"><? if ($_SESSION['flag']==1)
{ ?><img src="images/logo.gif" alt="Deal4Loans" onClick="javascript:location.href='/index.php?flag=1'"><? } else { ?><img src="images/logo.gif" alt="Deal4Loans" onClick="javascript:location.href='/index.php'"> <? } ?></div>
      <div id="dvTopRightPanel">
	
	  <?php 
if(!isset($_SESSION['UserType']))
{
	  if ((($_REQUEST['flag'])!=1))
	{ ?>
        <p><a href="/">Home</a> | <a href="/mediarelease.php">Media Coverage</a> |  <a href="/agent.php"><font color="red">DSA/Bank Login</font></a> | <a href="/SiteMap.php">Site Map</a> | <a href="/About_Us.php">About Us</a> | <a href="/quiz.php"><font color="red">Loan Quiz</FONT></a> | <a href="http://www.bimadeals.com" target="_blank">Insurance Deals</a></p><?php }
}
		 ?>
  
	 <?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<font style='Font-size:12px;'>Welcome ".ucwords($_SESSION['UserType'])." <b>".$_SESSION['UName']." ( <a href=Logout.php>Logout</a> )</b>";
	}
?>
	  </div>
    </div>
  </div>
  <?php
  }
  ?>
  <!-- End  Top Panel -->
  <!-- Start Menu Panel -->
  
   <?php 
	 if(!isset($_SESSION['UserType']))
	{ 

if (($_REQUEST['flag'])==1)
	{ ?>
	
	<div id="dvMenuPanel">
<div id="glowmenu" class="glowingtabs" align="center">
<ul>
<li><a href="/Contents_Personal_Loan.php?flag=1" title="Personal Loan" rel="dropmenu1_PL"><img src="/images/menu_personal_loan.gif" name="image1"  alt="Personal Loan"></a></li>
<li><a href="/Contents_Home_Loan.php?flag=1" title="Home Loan" rel="dropmenu1_HL"><img src="/images/menu_home_loan.gif" name="image1"  alt="Home Loan"></a></li>
<li><a href="/Contents_Car_Loan.php?flag=1" title="Car Loan" rel="dropmenu1_CL"><img src="/images/menu_car_loan.gif" name="image1"  alt="Car Loan"></a></li>
<li><a href="/Contents_Credit_Card.php?flag=1" title="Credits Cards" rel="dropmenu1_CC"><img src="/images/menu_credit_cards.gif" name="image1"  alt="Credit Card"></a></li>
<li><a href="/Contents_Loan_Against_Property.php?flag=1" title="Loan Against Property" rel="dropmenu1_LAP"><img src="/images/menu_loan_against.gif" name="image1" alt="Loan Against Property"></a></li>
<li><a href="/Contents_Business_Loan_Mustread.php?flag=1" title="Business Loan" rel="dropmenu1_BL"><img src="/images/menu_business_loan.gif" name="image1" alt="Business Loan"></a></li>

</ul>
</div>
                                                
  <div id="dropmenu1_PL" class="dropmenudiv_d" style="width: 160px;"> 
    <a href="/Request_Loan_Personal_New.php?flag=1">&nbsp;&nbsp;Apply Personal Loan</a> 
  <a href="/personal-loan-banks.php?flag=1">&nbsp;&nbsp;Personal Loan Banks</a>
  <a href="/Contents_Personal_Loan_Mustread.php?flag=1">&nbsp;&nbsp;Personal Loan Must Read</a> 
  <a href="/Contents_Personal_Loan_Faqs.php?flag=1">&nbsp;&nbsp;Personal Loan FAQs</a> 
  </div>

  <div id="dropmenu1_HL" class="dropmenudiv_d" style="width: 140px;">
  <a href="/Request_Loan_Home_New.php?flag=1">&nbsp;&nbsp;Apply Home Loan</a> 
  <a href="/home-loan-banks.php?flag=1">&nbsp;&nbsp;Home Loan Banks</a>
  <a href="/Contents_Home_Loan_Mustread.php?flag=1">&nbsp;&nbsp;Home Loan Must Read</a>
  <a href="/Contents_Home_Loan_Faqs.php?flag=1">&nbsp; Home Loan FAQs</a> </div>

  <div id="dropmenu1_CL" class="dropmenudiv_d" style="width: 130px;"> <a href="/Request_Loan_Car_New.php?flag=1">&nbsp;&nbsp;Apply Car Loan</a>
   <a href="/Contents_Car_Loan_Eligibility.php?flag=1">&nbsp;&nbsp;Car Loan     Eligibility</a> 
    <a href="/Contents_Car_Loan_Mustread.php?flag=1">&nbsp;&nbsp;Car Loan Must Read</a> <a href="/Contents_Car_Loan_Faqs.php?flag=1">&nbsp; 
    Car Loan FAQs</a> </div>

  <div id="dropmenu1_CC" class="dropmenudiv_d" style="width: 180px;"> <a href="/Request_Credit_Card_New.php?flag=1">&nbsp;&nbsp;Apply Credit Card</a>  <a href="/Contents_Credit_Card_Eligibility.php?flag=1">&nbsp;&nbsp;Available Credit Card Products</a>
    <a href="/Contents_Credit_Card_Mustread.php?flag=1">&nbsp;&nbsp;Credit Cards Must Read</a> <a href="/Contents_Credit_Card_Faqs.php?flag=1">&nbsp; 
    Credit Cards FAQs</a> </div>

  <div id="dropmenu1_LAP" class="dropmenudiv_d" style="width: 190px;"> <a href="/Request_Loan_Against_Property_New.php?flag=1">&nbsp;&nbsp;Apply Loan Against Property</a>
	<a href="/Contents_Loan_Against_Property_Eligibility.php?flag=1">&nbsp;&nbsp;Loan Against Property 
    Eligibility</a>  <a href="/Contents_Loan_Against_Property_Mustread.php?flag=1">&nbsp;&nbsp;Loan Against Property Must 
    Read</a> </div>

  <div id="dropmenu1_BL" class="dropmenudiv_d" style="width: 135px;"> <a href="/Req_Business_Loan_New.php?flag=1">&nbsp;&nbsp;Apply Business Loan</a>
  <a href="/Contents_Business_Loan_Mustread.php?flag=1">&nbsp;&nbsp;Business Loan Must Read</a>
     </div>
	 <script type="text/javascript">
//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
tabdropdown.init("glowmenu", "auto")
</script>
</div>
<?php

}
else {
?>

<div id="dvMenuPanel">
<div id="glowmenu" class="glowingtabs" align="center">
<ul>
<li><a href="/personal-loans.php" title="Personal Loan" rel="dropmenu1_PL"><img src="/images/menu_personal_loan.gif" name="image1"  alt="Personal Loan"></a></li>
<li><a href="/home-loans.php" title="Home Loan" rel="dropmenu1_HL"><img src="/images/menu_home_loan.gif" name="image1"  alt="Home Loan"></a></li>
<li><a href="/car-loans.php" title="Car Loan" rel="dropmenu1_CL"><img src="/images/menu_car_loan.gif" name="image1"  alt="Car Loan"></a></li>
<li><a href="/credit-cards.php" title="Credits Cards" rel="dropmenu1_CC"><img src="/images/menu_credit_cards.gif" name="image1" alt="Credit Card"></a></li>
<li><a href="/loan-against-property.php" title="Loan Against Property" rel="dropmenu1_LAP"><img src="/images/menu_loan_against.gif" name="image1"  alt="Loan Against Property"></a></li>
<li><a href="/business-loans.php" title="Business Loan" rel="dropmenu1_BL"><img src="/images/menu_business_loan.gif" name="image1"  alt="Business Loan"></a></li>

</ul>
</div>
                                                
  <div id="dropmenu1_PL" class="dropmenudiv_d" style="width: 160px;"> 
  	<?php

if($_SESSION['siten']=="ndtv")
{
?>

  <a href="/ndtvmoney/personal-loan-comparision.php">&nbsp;&nbsp;Apply Personal Loan</a> 
  <?php
  }
  else
  {
?>
  <a href="/apply-personal-loan.php">&nbsp;&nbsp;Apply Personal Loan</a> 
<?php
}
?>
	
  <a href="/personal-loan-banks.php">&nbsp;&nbsp;Personal Loan Banks</a>
  <a href="/personal-loan-interest-rate.php">&nbsp;&nbsp;Personal Loan Interest Rate</a> 
  <a href="/Contents_Personal_Loan_Faqs.php">&nbsp;&nbsp;Personal Loan FAQs</a> 
  </div>

  <div id="dropmenu1_HL" class="dropmenudiv_d" style="width: 140px;">
 <?php

if($_SESSION['siten']=="ndtv")
{
?>

  <a href="/ndtvmoney/home-loan-comparision.php">&nbsp;&nbsp;Apply Home Loan</a> 
  <?php
  }
  else
  {
?>
  <a href="/apply-home-loans.php">&nbsp;&nbsp;Apply Home Loan</a> 
  <?php
  }?>
 
  <a href="/home-loan-banks.php">&nbsp;&nbsp;Home Loan Banks</a>
  <a href="/home-loans-interest-rates.php">&nbsp;&nbsp;Home Loan Interest Rate</a>
  <a href="/Contents_Home_Loan_Faqs.php">&nbsp; Home Loan FAQs</a> </div>

  <div id="dropmenu1_CL" class="dropmenudiv_d" style="width: 130px;">
  <?php

if($_SESSION['siten']=="ndtv")
{
?>
 <a href="/ndtvmoney/car-loan-comparision.php">Apply Car Loan</a> 
  <?php
  }
  else
  {
?>
 <a href="/apply-car-loans.php">Apply Car Loan</a>
 <?php
 }
 ?>
   
   <a href="/Contents_Car_Loan_Eligibility.php">&nbsp;&nbsp;Car Loan     Eligibility</a> 
    <a href="/Contents_Car_Loan_Mustread.php">&nbsp;&nbsp;Car Loan Must Read</a> <a href="/Contents_Car_Loan_Faqs.php">&nbsp; 
    Car Loan FAQs</a> </div>

  <div id="dropmenu1_CC" class="dropmenudiv_d" style="width: 180px;">
  <?php

if($_SESSION['siten']=="ndtv")
{
?>

  <a href="/ndtvmoney/credit-card-comparision.php">&nbsp;&nbsp;Apply Credit Card</a> 
  <?php
  }
  else
  {
?>
 <a href="/apply-credit-card.php">&nbsp;&nbsp;Apply Credit Card</a>
 <?php } ?>
  
    <a href="/Contents_Credit_Card_Eligibility.php">&nbsp;&nbsp;Available Credit Card Products</a>
    <a href="/Contents_Credit_Card_Mustread.php">&nbsp;&nbsp;Credit Cards Must Read</a> <a href="/Contents_Credit_Card_Faqs.php">&nbsp; 
    Credit Cards FAQs</a> </div>

  <div id="dropmenu1_LAP" class="dropmenudiv_d" style="width: 190px;"> 
  <?php
if($_SESSION['siten']=="ndtv")
{
?>

  <a href="/ndtvmoney/loan-against-property-comparision.php">&nbsp;&nbsp;Apply Loan Against Property</a> 
  <?php
  }
  else
  {
?>
 <a href="/apply-loan-against-property.php">&nbsp;&nbsp;Apply Loan Against Property</a>
 <?php
 }
 ?>
  	<a href="/Contents_Loan_Against_Property_Eligibility.php">&nbsp;&nbsp;Loan Against Property 
    Eligibility</a>  <a href="/Contents_Loan_Against_Property_Mustread.php">&nbsp;&nbsp;Loan Against Property Must 
    Read</a> </div>

  <div id="dropmenu1_BL" class="dropmenudiv_d" style="width: 135px;"> <a href="/apply-business-loans.php">&nbsp;&nbsp;Apply Business Loan</a>
  <a href="/Contents_Business_Loan_Mustread.php">&nbsp;&nbsp;Business Loan Must Read</a>
     </div>

<script type="text/javascript">
//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
tabdropdown.init("glowmenu", "auto")
</script>
</div>
<?php
}
} ?>
 