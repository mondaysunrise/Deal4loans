<?php
header("Location: Contents_Articles.php");
	require 'scripts/functions.php';
	session_start();
	?>
<html>
<head>

<title>Loan Information Portal India : All borrowers to get documents in loan agreement</title>
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<?php include '~Top.php';?>
<div id="dvMainbanner">
    <?php include '~Upper.php';?>
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
    <div align="center"><font class="head2">All borrowers to get documents in loan agreement </font></div>
	<div style="padding:5px 0px;">
	<div style="float:left; width:250px;"><a href="http://www.deal4loans.com/Contents_Credit_Card_Articles.php" style="text-decoration:none;">List of Credit Card Articles</a></div>
	<div style="float:right; width:120px;"><a href="http://www.deal4loans.com/Contents_Articles.php" style="text-decoration:none;">Article Menu</a></div>
</div>
<p>


It is now mandatory for banks to provide a copy of the loan agreement including all enclosures to the borrower. In a notification issued to banks, the Reserve Bank of India said: “Banks and financial institutions are advised to invariably furnish a copy of the loan agreement along with a copy each of all enclosures quoted in the loan agreement to all the borrowers at the time of sanction / disbursement of loans.”</p>
<p>
The condition would apply for all loans across the board, said a senior RBI official. <br><br>
Banks usually furnish these documents only at the request of the borrowers. Though home loan borrowers usually get a copy of the documents, copies of loan papers for personal or auto loans are generally given only at the request of the customer, said a senior official at a public sector bank. </p>
<p>
Banks also provide a copy of all the documents to their corporate or big-ticket size customers. This step would, however, make it compulsory for banks to provide loan documents to all their borrowers. </p>
<p>
“Not furnishing a copy of the loan agreement or enclosures quoted in the loan agreement is an unfair practice and this could lead to disputes between the bank and the borrower with regard to the terms and conditions on which the loan is granted.”<br><br>
<b>Source:</b> Hindu Business line


 </p>
	  </td></tr></table>
	 
    </div>
	
  <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right1.php';
  }
  ?>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>




