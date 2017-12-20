<?php
	ob_start( 'ob_gzhandler');
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$loan_amount=trim($_REQUEST["loan_amount"]);
		$loan_tenure = trim($_REQUEST["loan_tenure"]);
		$bank_name = trim($_REQUEST["sel_bank_name"]);
		$sel_bank_name= trim($_REQUEST["sel_bank_name"]);
		if(strlen($bank_name)>0)
		{
			$selectresult="select  bank_name,".$loan_amount.", prepayment_charges,processing_fee,bank_url,priority from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1 and bank_name='".$bank_name."') order by  priority ASC";
		}
		else
		{
			$selectresult="select  bank_name,".$loan_amount.", prepayment_charges,processing_fee,bank_url,priority from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1) order by  priority ASC";
		}
		$getbank_result=ExecQuery($selectresult);
		$recordcount = mysql_num_rows($getbank_result);
		$msg="valid";
	}
	else
	{
		$selectgetresult="select  bank_name,upto_30lacs, prepayment_charges,processing_fee,bank_url, priority from `home_loan_interest_rate_chart` where ( tenure='4' and flag=1) order by  priority ASC";
	$newgetbank_result=ExecQuery($selectgetresult);
	$newrecordcount = mysql_num_rows($newgetbank_result);
	$getmsg="valid";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Rates | Home Loan Interest Rates | Home Loan Comparison Rate | Deal4loans</title>
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="Home Loan Rates, Home Loan Interest Rates, Home loans, Home loan, Home loans India, Home loan in India, Home loan interest rates,  Home loan rates in India, Home finance loans, compare Home loan rates, Home loans at least interest rate">
<meta name="Description" content="Home loan rates comparison with various banks. Know processing fee, Special Interest rates for salaried and self employed personnel / professionals. Compare home loan interest rates from Allahabad Bank, AXIS Bank , Barclays Bank, Corporation Bank, Dena Bank, DHFL HFC, Deutsche Post, Federal Bank, HDFC, ICICI Home Finance, Bank of Baroda, IDBI Bank, ING VYSYA, Oriental Bank of Commerce, Kotak, LIC housing, Punjab National Bank, Standard Chartered, SBI, Union Bank of India, Vijaya Bank.">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
 <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<!-- Demo styling -->
	<link href="tblesort/css/jq.css" rel="stylesheet">

	<!-- jQuery: required (tablesorter works with jQuery 1.2.3+) -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

	<!-- Pick a theme, load the plugin & initialize plugin -->
	<link href="tblesort/theme.default.css" rel="stylesheet">
	<script src="tblesort/jquery.tablesorter.min.js"></script>
	<script src="tblesort/jquery.tablesorter.widgets.min.js"></script>
	<script>
	$(function(){
		$('#tble_forsort').tablesorter({
			widgets        : ['blue', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
	});
	</script>


</head>
<body>
<?php include "top-menu.php"; include "main-menu.php"; ?>
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); $currentdate=date('d F Y',$tomorrow); ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">>Home Loan Interest Rates </span></div>
<div style="clear:both; height:15px;"></div>
<div class="intrl_txt">

<div style=" margin-left:15px; float:left; width:970px; height:2px;; margin-top:1px; "><img src="images/point5.gif" width="970" height="2" /></div>
<div class="text11" style="color:#4c4c4c; width:950px; margin-left:20px; margin-top:10px;">
Buying your first home can seem intimidating, especially when faced with many different loan types. Don't worry. Use this list to compare and narrow down the choices to know which is the best.<br>
To help its customers get the best interest rates on <a href="home-loans.php">home loans</a> deal4loans has consolidated all the information regarding current rate of interest for all the banks at one place. Please keep visiting this section to check updated rate of interest for home loans.<br /><?php //echo 		$selectgetresult; ?>


<table id="tble_forsort" width="100%"   border="1" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1" style="border:1px solid #999933;" class="tablesorter">
<thead>
<tr><th height="25" align="center" class="tbletext" style="font-weight:bold; background-color:#88a943; color:#fffff;">Bank Name<br>
<img src="images/spacer.gif" width="150" height="1" border="0" ></th>
<th height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; background-color:#88a943; color:#fffff;">Floating Interest rate<br><img src="images/spacer.gif" width="120" height="1" border="0" ></th>
<th height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; background-color:#88a943; color:#fffff;">Processing Fee</th>
<th height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; background-color:#88a943; color:#fffff;">Prepayment Charges</th>

</tr>
</thead>
  <tbody> 
<?  $j=0;
 while($newmultiget=mysql_fetch_array($newgetbank_result)) 
		{
			if(strlen($newmultiget["bank_url"])>0)
			{
				$urlinfo=$newmultiget["bank_url"];
			}
			else
			{
				$urlinfo="#";
			}
			
			if($j%2==0)
			{	
				$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0" />';	
			}
			else
			{
				$atag = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0" />';
			}
	?>		
			<tr bgcolor="#F6F4ED"><td height="25" bgcolor="#FFFFFF" class="tbl_txt">
            <?php
			if($newmultiget["bank_name"]=="ICICI Bank" || $newmultiget["bank_name"]=="HDFC Ltd" || $newmultiget["bank_name"]=="HSBC Bank" || $newmultiget["bank_name"]=="AXIS Bank" || $newmultiget["bank_name"]=="ING Vysya" || $newmultiget["bank_name"]=="Kotak Bank")
			{
			?>
            <a href="<? echo $urlinfo;?>"><b><? echo $newmultiget[0];?></b></a>
            <?php
			}
			else if ($newmultiget["bank_name"]=="UCO Bank" || $newmultiget["bank_name"]=="Bank of Baroda" || $newmultiget["bank_name"]=="Canara Bank" || $newmultiget["bank_name"]=="Syndicate Bank" || $newmultiget["bank_name"]=="Federal Bank" || $newmultiget["bank_name"]=="Development Credit Bank")
			{
?>
<strong>			<? echo $newmultiget[0];?></strong>
<?php			
			}
			else
			{
			?>
                  <a href="<? echo $urlinfo;?>"><b><? echo $newmultiget[0];?></b></a>
<strong>			<? //echo $newmultiget[0];?></strong>
            <?php
			}
            ?>
            </td>
			<td align="center" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b><? echo $newmultiget[1];?></b></td>
			<td align="left" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $newmultiget[2];?></td>
			<td align="center" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $newmultiget[3];?></td>
			<!--<td height="35" align="center" valign="middle" bgcolor="#FFFFFF" > -->
			<?php
			if($newmultiget["bank_name"]=="ICICI Bank" || $newmultiget["bank_name"]=="HDFC Ltd" || $newmultiget["bank_name"]=="HSBC Bank" || $newmultiget["bank_name"]=="AXIS Bank" || $newmultiget["bank_name"]=="ING Vysya" || $newmultiget["bank_name"]=="Kotak Bank")
			{
				if($newmultiget[5]==3)
				{ ?>
			
				<? }
				else
				{
				?>
			
				<?php
				}
			}
			?>
			<!--</td> -->
			</tr>
	<?	$j=$j+1;
	}
?>
</tbody> 
</table>
	   <div style="height:30px; padding-top:10px;">Before apply for home loan, Calculate your home loan emi with <a href="/home-loan-emi-calculator1.php">Home Loan EMI Calculator</a></div>     <br /> 
    <b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.  
</div>
<div align="center" style="padding-top:10px;"><a href="http://www.americanexpressindia.co.in/platinumTravel.aspx?siteid=Deal4loanPlatinumTravelCard&adunit=PlatinumTravelCard_728x90SeptDec&banner=PlatinumTravelCard_SeptDec&campaign=PlatinumTravelCard&marketingagency=interactive" target="_blank" style="text-decoration:none;"><img src="new-images/cc/Amex_banner728x90oct12.jpg" width="728" height="90" border="0" /></a></div></div>
<?php include "home_loan_footer_form.php"; ?> 
<?php include "footer1.php"; ?>
</body>
</html>