<?php
	header("Location: Contents_Articles.php");
	exit();
	
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	
	session_start();
	?>
<html>
<head>

<title>Deal4Loans | Personal Loan | Credits Cards | Home Loan | Car Loan  Compare Apply</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">

<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="tabcontentnew.css" />
<script type="text/javascript" src="tabcontentnew.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="compareloan.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>


<?php include '~Top.php';?>
<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /></div>
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
    <div align="center"><font class="head2">Articles</font></div><br>
	
	
	<p><table border="0" width="100%" >
	<tr><td bgcolor='#529BE4'><font style='font-size:13px;font-weight:bold;color:white'><a href="Contents_Articles.php">Credit Card</a></font> | <font style='font-size:13px;font-weight:bold;color:white'><a href="Contents_ArticlesHL.php">Home Loan</a></font> | <font style='font-size:13px;font-weight:bold;color:white'><a href="Contents_ArticlesOA.php">Other Articles</a></font>   </td></tr>
	<tr>
		<td valign="top" width="50%"  class="blueborder">
		
		<table width="100%" >
		<?php
		$SQL_CC = "select * from Articles where  Art_Main_Title like '%Other Articles%' order by  Art_ID desc";
		list($NumRows_CC,$getrow)=MainselectfuncNew($SQL_CC,$array = array());
		$i=0;
		
		//$Query_CC = ExecQuery($SQL_CC);
		//$NumRows_CC = mysql_num_rows($Query_CC);
		
		$Title = $getrow[$i]['Art_Main_Title'];
	
	?>
		<tr><td bgcolor='#529BE4'><table border="0" width="100%"><tr><td align="left"><font style='font-size:13px;font-weight:bold;color:white'><?php echo $Title; ?></font></td><td align="right"  id="flowertabs" class="modernbricksmenu2"><font style="float:right;"><div><ul><li><a href="#" rel="tcontentCC1" class="selected">Latest Articles</a></li><li><a href="#" rel="tcontentCC2">Show All</a></li></ul></div></font></td></tr></table></td></tr>

	<tr><td>

<div id="tcontentCC1" class="tabcontent">

<table>
		<?php
		for($i=0;$i<5;$i++)
		{
			$Art_Sub_Title = $getrow[$i]['Art_Sub_Title'];
			$Art_Url = $getrow[$i]['Art_Url'];
			$Art_Content = $getrow[$i]['Art_Content'];
			
				echo "<tr><td><img src='images/dot.gif' />&nbsp;<a href='".$Art_Url."'><font color='#0F74D4'>".$Art_Sub_Title."</font></a></td></tr>";
			echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<font color='#000000'>".$Art_Content."</font>&nbsp;<a href='".$Art_Url."'><font color='#0F74D4'>read ahead....</font></td></tr>";
		}
		?>
		</table>
		</div>
	
<div id="tcontentCC2" class="tabcontent">
<table>
		<?php
		for($i=0;$i<$NumRows_CC;$i++)
		{
			$Art_Sub_Title = $getrow[$i]['Art_Sub_Title'];
			$Art_Url = $getrow[$i]['Art_Url'];
			$Art_Content = $getrow[$i]['Art_Content'];
			
				echo "<tr><td><img src='images/dot.gif' />&nbsp;<a href='".$Art_Url."'><font color='#0F74D4'>".$Art_Sub_Title."</font></a></td></tr>";
			echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<font color='#000000'>".$Art_Content."</font>&nbsp;<a href='".$Art_Url."'><font color='#0F74D4'>read ahead....</font></td></tr>";
		}
		?></table>
		</div>
		

<br style="clear: left" />

<script type="text/javascript">

var myflowers=new ddtabcontent("flowertabs")
myflowers.setpersist(true)
myflowers.setselectedClassTarget("link") //"link" or "linkparent"
myflowers.init()

</script>
	<!-- </div> -->
		</td></tr>
		
		</table>


		</table>
		</td>
		</tr></p>
	<!-- <p>
	
	<br>
	<font color="0F74D4" size="3" ><b><a href="http://www.deal4loans.com/Contents_Credit_Card_Articles.php" > Credit card</a></font></b><br>
	
<br>
<a href="http://www.deal4loans.com/Contents_Credit_Card_Article1.php" style="text-decoration:none;"><font color="0F74D4"><b>Credit Cards - Revealed</b></font></a><br>
A credit card holder is entitled to a plethora of benefits like travel discounts, discount on retail loans, and free credit periods. To benefit from these,  <a href="http://www.deal4loans.com/Contents_Credit_Card_Article1.php" style="text-decoration:none;">read more..</a><br></p>


<p><a href="http://www.deal4loans.com/Contents_Credit_Card_Article2.php" style="text-decoration:none;"><font color="0F74D4"><b>Benefit from reward points</b></font></a><br>You think nothing comes for free in this little imperfect world?? Have a look at your credit card statement again. <a href="http://www.deal4loans.com/Contents_Credit_Card_Article2.php" style="text-decoration:none;">read more...</a> </p>
<p><a href="http://www.deal4loans.com/Contents_Credit_Card_Article3.php" style="text-decoration:none;"><font color="0F74D4"><b>How to protect your credit card</b></font></a><br>Credit card fraud is facilitated when you give your credit card number to unfamiliar individuals, when cards are lost or stolen, when mail is diverted from the intended recipients and taken by criminals, or<a href="http://www.deal4loans.com/Contents_Credit_Card_Article3.php" style="text-decoration:none;"> read more...</a>
</p>
<p><a href="http://www.deal4loans.com/Contents_Credit_Card_Article4.php" style="text-decoration:none;"><font color="0F74D4"><b>Lost your credit card? Inform call center</b></font></a><br>Has anyone stolen your card or have you lost it? The first thing you should do is call up the bank’s 24-hour call centre. You have to be prompt in your action otherwise, you may end up with a huge outstanding balance if someone else misuses your card.<a href="http://www.deal4loans.com/Contents_Credit_Card_Article4.php" style="text-decoration:none;"> read more...</a>
</p>
<p><a href="http://www.deal4loans.com/Contents_Credit_Card_Article5.php" style="text-decoration:none;"><font color="0F74D4"><b>Now, pay for debit card & ATM services</b></font></a><br>A free SMS alert from your bank today may cost you tomorrow. This is because banks have upped service charges on banking financial services and products.<a href="http://www.deal4loans.com/Contents_Credit_Card_Article5.php" style="text-decoration:none;"> read more...</a>
</p>
<p><a href="http://www.deal4loans.com/Contents_Credit_Card_Article6.php" style="text-decoration:none;"><font color="0F74D4"><b>Silent killer: Credit card rates spurt</b></font></a><br>Rising EMIs for housing loans have hogged the headlines because of the pain experienced by homeowners, who had borrowed in a benign interest rate regime.<a href="http://www.deal4loans.com/Contents_Credit_Card_Article6.php" style="text-decoration:none;"> read more...</a>
</p>
<p><a href="http://www.deal4loans.com/Contents_Credit_Card_Article7.php" style="text-decoration:none;"><font color="0F74D4"><b>Age, salary and loan history to decide credit rating soon</b></font></a><br>Starting November, banks will be able to check the creditworthiness of 100 million borrowers before extending fresh loan<a href="http://www.deal4loans.com/Contents_Credit_Card_Article7.php" style="text-decoration:none;"> read more...</a>
</p>
<p>
<br>
	<font color="0F74D4" size="3" ><a href="http://www.deal4loans.com/Contents_Home_Loan_Articles.php" ><b> Home Loan</font></b></a><br>
	

	<br>
<a href="http://www.deal4loans.com/Contents_Home_Loan_Article1.php" style="text-decoration:none;"><font color="0F74D4"><b>Check the factors which decide your home loan eligibility</b></font></a><br>
Basic Parameters that describe your Home loan entitlement & home loan endorsement<a href="http://www.deal4loans.com/Contents_Home_Loan_Article1.php" style="text-decoration:none;"> read more..</a><br><br>


<a href="http://www.deal4loans.com/Contents_Home_Loan_Article2.php" style="text-decoration:none;"><font color="0F74D4"><b>Warning: ignorance is not bliss in a home loan agreement</b></font></a><br>If you thought the loan documents were just a formality, think again. It is a contract skewed towards the lenders through various clauses buried in the fine print. We help you dig them out <a href="http://www.deal4loans.com/Contents_Credit_Card_Article2.php" style="text-decoration:none;">read more...</a> </p>
<p><a href="http://www.deal4loans.com/Contents_Home_Loan_Article3.php" style="text-decoration:none;"><font color="0F74D4"><b>5 ways to increase to your home loan eligibility </b></font></a><br>Home loan interest rates have inched up in the last few months. This in turn, has affected the loan eligibility for home loan borrowers.Loan eligibility is inversely related to rates.<a href="http://www.deal4loans.com/Contents_Home_Loan_Article3.php" style="text-decoration:none;"> read more...</a>
</p>
<p><a href="http://www.deal4loans.com/Contents_Home_Loan_Article4.php" style="text-decoration:none;"><font color="0F74D4"><b>End of the road for home loan</b></font></a><br>The paradigm of home loan marketing is set for a change. The practice of using ordinary direct selling agents (DSAs) by home loan financiers will soon be history<a href="http://www.deal4loans.com/Contents_Home_Loan_Article4.php" style="text-decoration:none;"> read more...</a><br><br>
</p>
<br><br>
	<font color="0F74D4" size="3" ><a href="http://www.deal4loans.com/Contents_Loan_Article.php" style=" float:left;"><b> Untangle your Loan-Trap</font></b></a><br>
	</br><br>
	<font color="0F74D4" size="3" ><a href="http://www.deal4loans.com/Contents_Loan_Article1.php" style=" float:left;"><b> All borrowers to get documents in loan agreement</font></b></a><br>
	</br><br>

	  </td></tr></table>
	  -->
    </div>
  <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right.php';
  }
  ?>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>