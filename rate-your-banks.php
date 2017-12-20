<?php
	require 'scripts/functions.php';
	include 'scripts/db_init.php';
	session_start();

	$session_id=session_id();
	//echo $session_id."<br>";
	$newsess=$_REQUEST['sessid'];
	
	//echo $_SESSION['Email'];
	$titles = array(
		'personal-loan-sbi.php',
		'personal-loan-axis-bank.php',
		'personal-loan-icici-bank.php',
		'personal-loan-abn-bank.php' ,
		'personal-loan-deutsche-bank.php',
		'personal-loan-hdfc-bank.php',
		'personal-loan-hsbc-bank.php',
		'personal-loan-citibank.php'
		
	);
	$home_titles = array(
		'home-loan-sbi.php',
		'home-loan-citibank.php',
		'home-loan-gemoney.php',
		'home-loan-deutsche-bank.php' ,
		'home-loan-hdfc-bank.php',
		'home-loan-lic-housing.php',
		'home-loan-idbi-homefinance.php',
		'home-loan-idbi-bank.php',
		'home-loan-icici-bank.php'
		
	);
	
	?>
<html>
<head>



<title>Loans | Loans India | Personal Loans India | Credit Cards India | Home Loans India | Deal4loans | Personal Loans | Credit Cards | Home Loans</title>
<meta name="keywords" content="loans, personal loans, personal loan, loans, loan, emi calculator, compare personal loans, debt consolidation , education loans, loan providers, credit cards, loan gyan, loans India, online loan application, loan calculator, loan eligibility, banks India, easy loans, quick loans, Compare loan from ICICI  HDFC SBI and other major banks " /> 

<!--<meta http-equiv="refresh" content="500">-->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">

<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<div id="dvMainbanner">
 <? if(!isset($_SESSION['UserType'])) 
  {?>
    <?php include '~Upper.php';?>
	<?}?>
   <div id="dvMainbanner" align="center"><img src="images/main_banner1.gif" alt="Deal4Loans"/></div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent">
	<br/><br/>
    <div align="center"><font class="head2">RATE YOUR BANK</font></div>
	<br>
	   <p> Deal4loans has empowered its customers to express their opinions and experiences in the form of newly introduced feature <b>"RATE YOUR BANK"</b>. The Rating allows users to select the number of stars that represents their rating. Just by having a look on the bank you can make out which bank can carry out your requirement. Unbiased information about bank's services</p><p>

<b>Advantages to the customers:</b><br/>
<ul><li>Express opinions quickly and easily</li> 
<li>Intuitive, graphical view of community opinion</li>
<li>Ability to change one's personal rating at any time</li>
<li>Seeing how other people rate the services of the banks</li>
</ul><br/>
Click on any of the below given bank's name to know the rates, eligibility, and other charges for your requirement.<br/><br/>
 <table align="center" border="1"  cellspacing="0" cellpadding="2">
	<tr>
		<td  align="center" Height="200"><b><u> Personal Loan Banks</u></b>
		 <table border="0" Height="250" cellpadding="9">
			 <tr>
			 <td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="personal-loan-sbi.php#rating"> State Bank of India (SBI)</A> <br/>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="personal-loan-axis-bank.php#rating"> Axis Bank</A></td>
			</tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="personal-loan-icici-bank.php#rating"> ICICI Bank</a></td>
			</tr>
			
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="personal-loan-deutsche-bank.php#rating"> Deutsche Bank</a></td></tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="personal-loan-hdfc-bank.php#rating"> HDFC Bank</a></td>
			</tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font> <a href="personal-loan-hsbc-bank.php#rating"> HSBC Bank </a></td>
			</tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="personal-loan-citibank.php#rating"> Citibank</a></td>
			</tr>
		</table>
	</td><td align="center" Height="200"><b><u> Votes</u></b><table border="0" Height="200" cellpadding="9"><?  for($k=0;$k<count($titles);$k++)
		 {
	$ratingcount="Select Count(Rateval)as over from Rate_Experience where URL Like '%".$titles[$k]."%'";
	//echo "query".$ratingcount."<br>";
	list($recordcount,$line)=MainselectfuncNew($ratingcount,$array = array());
	$linecontr=count($line)-1;
	/*for ($i=0;$i>2;$i++)
			 {
				$sumvalue=mysql_result($result,$i,'over');
			 }*/
  if($recordcount>0)
  {
	$countvalue = $line[$linecontr]['over'];
	
  }
  //echo $countexp;
	
	echo "<tr><td>".$countvalue."</td></tr>";
		 }?></table></td><td valign="top" align="center"  ><b><u>Overall Experience:</u></b><table   border="0"><tr><td>
		 <?
		 
		  for ($j=0;$j<count($titles);$j++)
		 {
			 
$hm = "Rating";
$form_name="rate".+$j;
//$collectcount=$j;
			$hm2 = "Rating";
include "Rating/main_rating.php";

		 } 
		 //include "Rating/rating_code.php";?></td></tr></table></td>
</tr>
<tr>
		<td  align="center" Height="200"><b><u> Home Loan Banks</u></b>
		 <table border="0" Height="250" cellpadding="9">
			 <tr>
			 <td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="home-loan-sbi.php#rating"> State Bank of India (SBI)</A> <br/>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="home-loan-citibank.php#rating"> Citibank </A></td>
			</tr>
			<!--<tr>
				<td><font face="Verdana" size="1" color="0F74D4">•</font><a href="home-loan-icici-bank.php#rating"> ICICI Bank </A></td>
			</tr>-->
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="home-loan-gemoney.php#rating"> GE Money</a></td>
			</tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="home-loan-deutsche-bank.php#rating"> Deutsche Bank</a></td></tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="home-loan-hdfc-bank.php#rating"> HDFC Bank</a></td></tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="home-loan-lic-housing.php#rating"> LIC Housing </a></td>
			</tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font>  <a href="home-loan-idbi-homefinance.php#rating"> IDBI Housing Finance</a></td>
			</tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="home-loan-idbi-bank.php#rating"> IDBI Bank</a></td>
			</tr>
			<tr>
				<td><font face="Verdana" size="1" color="0F74D4">&bull;</font><a href="home-loan-icici-bank.php#rating"> ICICI Bank </A></td>
			</tr>
		</table>
	</td><td align="center" Height="200"><b><u> Votes</u></b><table border="0" Height="200" cellpadding="9"><?  for($r=0;$r<count($home_titles);$r++)
		 {
	$hlratingcount="Select Count(Rateval)as hlover from Rate_Experience where URL Like '%".$home_titles[$r]."%'";
	//echo "query".$ratingcount."<br>";
	list($hlrecordcount1,$hlline)=MainselectfuncNew($hlratingcount,$array = array());
	$line1contr=count($hlline)-1;
  if($hlrecordcount1>0)
  {
	$hlcountvalue = $hlline[$line1contr]['hlover'];
	
  }
  //echo $countexp;
	
	echo "<tr><td>".$hlcountvalue."</td></tr>";
		 }?></table></td><td valign="top" align="center"  valign="top"><b><u>Overall Experience:</u></b><table   border="0"><tr><td>
		 <?
		 
		  for ($p=0;$p<count($home_titles);$p++)
		 {
			 
$hm = "Rating";
$hlform_name="hlrate".+$p;
//$collectcount=$j;
			$hm2 = "Rating";
include "Rating/hl_main_rating.php";

		 } 
		 //include "Rating/rating_code.php";?></td></tr></table></td>
</tr>

 </table>  

   
    
      <a href="#top" ><strong>TOP</strong></a> </p>
    </td></tr></table>
	 
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