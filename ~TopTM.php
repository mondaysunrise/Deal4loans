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
	 $_SERVER['REQUEST_URI'];
	 
	  if(isset($_SESSION['Name']))
	{
	
	
	 if($_SESSION['TMU_ID']<=3)
	   {
	?>
	 <a href="TMU_TeleCallerShow.php">TeleCallers</a> |  <a href="TMU_Report.php">Work Report</a>  |   <a href="TMUView.php">Download Report</a> <br> <a href="TMU_TeleCallerName.php">Enter TeleCaller Name</a> | <a href="TMUL_View.php">DailyReport Summary</a> <br> 
	  <?php
	  }
	?>
	  <a href="TMU_Entry.php">Entry Form</a> | <a href="TMU_Update.php">Update for Bank Unique ID</a> | <a href="TMU_View.php">View </a>  | <a href="TMU_Lms.php">Daily Report</a>
  
   <h1>
	<?php
	
echo "<font style='Font-size:12px;'>Welcome  <b>".$_SESSION['Name']." ( <a href=LogoutTM.php>Logout</a> )</b>";
	
	}
	
	?>
	 </p>  
</h1>
      </div>
    </div>
  </div>
  <!-- End  Top Panel -->
  <!-- Start Menu Panel -->

  