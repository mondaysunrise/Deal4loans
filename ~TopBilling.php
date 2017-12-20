<LINK REL="SHORTCUT ICON" HREF="http://www.deal4loans.com/D4L.ico" type="image/vnd.microsoft.icon">
<link href="style.css" rel="stylesheet" type="text/css" /><script language="JavaScript" type="text/JavaScript">
<!--

function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars' )
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}


function HandleOnSubmit(file_name) {

	   myWindow = window.open(file_name, "tinyWindow", 'resizable width=467,height=220')
	   myWindow.document.close() 

}

//-->
</script>

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>

<div align="center">
<div id="dvContainer">
  <!-- Start Top Panel -->
  <div id="dvTopPanel">
    <div id="dvLogoPanel">
      <div id="dvLogo"><img src="images/logo.gif" alt="Deal4Loans"/> </div>
      <div id="dvTopRightPanel">
	 <p> 
	 <?php 
	 $pageName = $_SERVER['REQUEST_URI'];
	 $explodePN = explode("/",$pageName);
	 $count = count($explodePN);
	 
	 //print_r($_SERVER);
	// print_r($_SESSION);
	  if(isset($_SESSION['Name']))
	{
	
	//echo "<font color='Blue'><a href='billing_index_prepaid.php'>Billing PrePaid</a></font> | ";
	
	
	
	if(($explodePN[$count-1]=='monthlybillingsummary.php') || ($explodePN[$count-1]=='monthlybillingsummary.php?search=y'))
	{
	echo "<font color='Blue'>Monthly Bill Summary</font>";
	}
	else {
	?>
	
	  <a href="monthlybillingsummary.php">Monthly Bill Summary</a><?php } ?> |
<?php
	if(($explodePN[$count-1]=='billing_index_prepaid.php') || ($explodePN[$count-1]=='billing_index_prepaid.php?search=y'))
	{
	echo "<font color='Blue'>Billing PrePaid</font>";
	}
	else {
	?>
	
	  <a href="billing_index_prepaid.php">Billing PrePaid</a><?php } ?> |
	   <?php
	if(($explodePN[$count-1]=='billing_index.php') || ($explodePN[$count-1]=='billing_index.php?search=y'))
	{
	echo "<font color='Blue'>Billing Index</font>";
	}
	else {
	?>
	
	  <a href="billing_index.php">Billing Index</a><?php } ?> |  <!--   <a href="TMU_download_Index.php">Download Report</a> |  -->
	 <?php
	 if(($explodePN[$count-1]=='billing_feedback.php') || ($explodePN[$count-1]=='billing_feedback.php?search=y'))
	{
	echo "<font color='Blue'>Payment Received</font>";
	}
	else {
	?>
	 
	 
	  <a href="billing_feedback.php">Payment Received</a> <?php } ?>| 
	  <?php
	 if(($explodePN[$count-1]=='billing_feedbackDisplay.php') || ($explodePN[$count-1]=='billing_feedbackDisplay.php?search=y'))
	{
	echo "<font color='Blue'>Payment Glance</font>";
	}
	else {
	?> 
	  
	  <a href="billing_feedbackDisplay.php">Payment Glance</a><?php } ?>
  
   <h1>
	<?php
	
echo "<font style='Font-size:12px;'>Welcome  <b>".$_SESSION['UName']." ( <a href=LogoutBilling.php>Logout</a> )</b>";
	
	}
	
	?>
	 </p>  
</h1>
      </div>
    </div>
  </div>
  <!-- End  Top Panel -->
  <!-- Start Menu Panel -->

  