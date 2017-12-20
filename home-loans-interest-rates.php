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
	if($bank_name=="SBI - State Bank Of India")
	{
		$bank_name="SBI";
	}

	if(strlen($bank_name)>0)
	{
		$field="perlac_".$loan_amount;
		$field_nw="percentage_".$loan_amount;
		$selectresult="select  bank_name,".$loan_amount.",".$field.",".$field_nw.",prepayment_charges,processing_fee,bank_url,priority,rates_change,mclr_rates from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1 and bank_name like '".$bank_name."%') order by  priority ASC";
	}
	else
	{
		$field="perlac_".$loan_amount;
		$field_nw="percentage_".$loan_amount;
		$selectresult="select bank_name,".$loan_amount.",".$field.",".$field_nw.", prepayment_charges,processing_fee,bank_url,priority,rates_change,mclr_rates from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1) order by  priority ASC";
	}
	//echo $selectresult."<br>";
	$getbank_result=ExecQuery($selectresult);
	$recordcount = mysql_num_rows($getbank_result);
	$msg="valid";
}
else
{
	$selectgetresult="select  bank_name,upto_30lacs, perlac_upto_30lacs,prepayment_charges,processing_fee,bank_url,percentage_upto_30lacs, priority, rates_change,mclr_rates from `home_loan_interest_rate_chart` where ( tenure='4' and flag=1) order by  priority ASC";
	$newgetbank_result=ExecQuery($selectgetresult);
	$newrecordcount = mysql_num_rows($newgetbank_result);
	$getmsg="valid";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Language" content="en-us">
<title>Home Loan Interest Rates | Compare Home Loan Rates 2017</title>
<meta name="keywords" content="Home Loan Interest Rates, Home Loan Rates, Home loan rates in India, compare Home loan rates, Home loans lowest interest rate" >
<meta name="Description" content="Compare Home loan rates of all major banks of India. Check Interest Rates <?php echo DATE('F'); ?> 2017, Processing fee ✓ Per lakh EMI ✓ ROI Floating Rates ✓ lowest Fixed rates for salaried, women and self-employed/professionals from Nationalised / Government Banks / Private Banks through Deal4loans.">
<?php
if(strlen($_GET['source'])>0)
{
echo '<link rel="canonical" href="http://www.deal4loans.com/home-loans-interest-rates.php"/>';
}
?>
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<?php $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); $currentdate=date('d F Y',$tomorrow); ?>
<div  class="hl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="d4l_inner_wrapper">
    <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">     
      <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> <span>>Home Loan Interest Rates </span></div>
       <div style="float:right;"><a href="/home-loan-balance-transfer-calculator.php" style="text-decoration:none;"><img src="http://www.deal4loans.com/new-images/hl-baltrnfr.jpg" alt="home loan" /></a></div>
      <h1 class="hl-h1">Home Loan Interest Rates</h1>
      <span class="hli_title_text_a">(Last updated on <?php echo date('d F Y'); ?>)</span> </div>
    <div style="clear:both; height:10px;"></div>
  </div>
Compare Home loan rates of all major banks of India. Check Interest Rates 2017, Processing fee ✓ Per lakh EMI ✓ ROI floating Rates ✓ Lowest fixed rates for salaried, Women and Self-employed/Professionals from Nationalised / Government Banks / Private Banks through Deal4loans.<br /><br />
Are you looking forward to purchase your first place? Shopping for a home is exciting, exhausting and a little terrifying, especially in this market. In the end, your plan is to end up with a home you adore at a price you can manage to pay for. Arm yourself with the list mentioned below to compare and narrow down the choices to get the best for you. To lend a helping hand to our customers, deal4loans has consolidated all the necessary information regarding current rate of interest on home loans provided by all the major banks at one place. Please keep visiting this section to check latest rate of interest for home loans.<br /><br />
         <strong>Home loan trends <?php echo DATE('F'); ?> 2017:</strong> SBI cuts home loan rates by .05%. New Lowest interest rates for home loans starts from 8.30% for women & 8.35% for others.Axis Bank offers 12 EMI- waiver on <a href="http://www.deal4loans.com/home-loans.php">home loans</a> of up to Rs 30 lakh. Under this new offering, where the customer with regular repayment gets 12 EMIs waived — 4 EMIs each after the fourth year, eighth year and the twelfth year from the date of the first disbursement. The effect of EMI waiver shall be given in the form of reduction in tenure. You can also get home loans under <a href="http://www.deal4loans.com/loans/articles/pradhan-mantri-home-loan-interest-rates-emi-calculator-eligibility-apply/">Pradhan mantri awas yojana</a>.
         <div style="padding-top:10px;">
 <?php
$newsource="hl interest rate apply";
$subjectLine="Get instant quotes on Home Loan Interest Rates from top 17 banks online";
include "home-loans-widget.php";
?>
  </div>
  <div style="clear:both;"></div> 
  <h3 class="hl-h3">Check Home Loan Interest Rates of all major banks of India instantly</h3>
  <form name="hlinterest" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="hli_check_home">
      <div class="click_input_section">
        <table width="99%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <td width="49%"><b>Bank Name</b></td>
          </tr>
          <tr>
            <td align="center"><select name="sel_bank_name" class="d4l-select" id="sel_bank_name">
                <option value=""> ALL </option>
                <?php $selectbankresult="select bank_name from `home_loan_interest_rate_chart` where (flag=1) group by bank_name order by bank_name ASC";
	//echo "uihiyuiu".$selectbankresult."<br>";
		$getbankn_result_new=ExecQuery($selectbankresult);
		while($bnkn=mysql_fetch_array($getbankn_result_new))
		{ //echo "hello"; ?>
                <option value="<?php echo $bnkn['bank_name']; ?>" <?php if($sel_bank_name==$bnkn['bank_name'] ) { echo "selected";}?>><?php echo $bnkn['bank_name']; ?></option>
                <?php } ?>
              </select></td>
          </tr>
        </table>
      </div>
      <div class="click_input_section">
        <table width="99%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <td width="49%"><b>Loan Amount</b></td>
          </tr>
          <tr>
            <td align="center"><select name="loan_amount" class="d4l-select">
                <option value="PLease Select">PLease Select</option>
                <option value="upto_20lacs" <?php if($loan_amount=="upto_20lacs") { echo "selected";}?>>Upto 20lacs</option>
                <option value="upto_30lacs" <?php if($loan_amount=="upto_30lacs") { echo "selected";} elseif(!isset($msg)) {echo "selected";}?> >above 20lacs to 30lacs</option>
                <option value="above_30lacs" <?php if($loan_amount=="above_30lacs") { echo "selected";}?>>above 30lacs to 75lacs</option>
                <option value="above_75lacs" <?php if($loan_amount=="above_75lacs" ) { echo "selected";}?>>above 75lacs</option>
              </select></td>
          </tr>
        </table>
      </div>
      <div class="click_input_section">
        <table width="99%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <td width="49%"><b>Loan Tenure</b></td>
          </tr>
          <tr>
            <td align="center"><select name="loan_tenure" class="d4l-select">
                <option value="PLease Select">PLease Select</option>
                <option value="1" <?php if($loan_tenure=="1") { echo "selected";}?>>Upto 5yrs</option>
                <option value="2" <?php if($loan_tenure=="2") { echo "selected";}?>>From 5yrs to 10yrs</option>
                <option value="3" <?php if($loan_tenure=="3") { echo "selected";}?>>From 10yrs to 15yrs</option>
                <option value="4" <?php if($loan_tenure=="4") { echo "selected";} elseif(!isset($msg)) {echo "selected";}?>>From 15yrs to 20yrs</option>
                <option value="5" <?if($loan_tenure=="5") { echo "selected";}?>>From 20yrs to 25yrs</option>
              </select></td>
          </tr>
        </table>
      </div>
      <div class="click_input_btn">
        <input type="image" src="http://www.deal4loans.com/images/gt-intrate.gif"  style="border:0px;" value="submit" name="none" />
      </div>
    </div>
  </form>
  <div class="overflow-width">
    <div style="clear:both; height:10px"></div>
    <table width="100%"   border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
      <?php if($msg=="valid" && (!isset($getmsg)))
{?>
      <tr bgcolor="#A6F2DD">
        <td height="25" align="center"><strong>Bank Name</strong><br></td>
        <td height="25" align="center"><strong>Floating Interest rate</strong><br></td>
        <td width="93" height="25" align="center"><strong>Per lac EMI</strong><br></td>
        <td width="119" align="center"><strong>MCLR Rates</strong></td>
        <td height="25" align="center"><strong>Processing Fee</strong></td>
        <td height="25" align="center"><strong>Prepayment Charges</strong></td>
        <td height="25" align="center"><strong>% Change in last 6 mths</strong></td>
      </tr>
      <?php $i=0;
		if($recordcount>0)
		{	
			while($multiget=mysql_fetch_array($getbank_result)) 
			{
				if(strlen($multiget["bank_url"])>0)
				{
					$geturlinfo=$multiget["bank_url"];
					if($_SESSION['siten']=="ndtv")
					{
						$geturlinfo .= $geturlinfo."?site=ndtv";
					}
				}
				else
				{
					$geturlinfo="#";
				}
			
				if($i%2==0)
				{	
					$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
				}
				else
				{
					$atag = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0"  />';
				}
				?>
      <tr bgcolor="#9DE0CE">
        <td width="100" height="25" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php
			if($multiget["bank_name"]=="ICICI Bank" || $multiget["bank_name"]=="HDFC Ltd" || $multiget["bank_name"]=="HSBC Bank" || $multiget["bank_name"]=="AXIS Bank" || $multiget["bank_name"]=="ING Vysya" || $multiget["bank_name"]=="Kotak Bank")
			{			
		?>
          <a href="<?php echo $geturlinfo;?>"><b><?php echo $multiget["bank_name"];?></b></a>
          <?php
            }
			else if ($multiget["bank_name"]=="UCO Bank" || $multiget["bank_name"]=="Canara Bank" || $multiget["bank_name"]=="Syndicate Bank" || $multiget["bank_name"]=="Federal Bank" || $multiget["bank_name"]=="Development Credit Bank")
			{
			?>
          <strong> <?php echo $multiget["bank_name"];?></strong>
          <?php			
			}
            else
            {
?>
          <a href="<?php echo $geturlinfo;?>"><b><?php echo $multiget["bank_name"];?></b></a>
          <?php
            }
            ?></td>
        <td width="132" align="center" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px"><b><?php echo $multiget["".$loan_amount.""];?></b></td>
        <td align="center" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px"><b>
          <?php $field="perlac_".$loan_amount;
			echo $multiget["".$field.""];?>
          </b></td>
       <!-- <td align="center" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px">&nbsp;</td>-->
        <td width="147" align="center" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php echo $multiget["mclr_rates"];?></td>
        <td width="98" align="center" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php echo $multiget["prepayment_charges"];?></td>
        <td width="97" align="center" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php echo $multiget["processing_fee"];?></td>
        <td width="120" align="center" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php $field="percentage_".$loan_amount;
 if($multiget["".$field.""]==1)
			{
				echo "<b>No Change</b>";
			}
			elseif($multiget["".$field.""]=="0.00")
			{
				echo "<b>N.A</b>";
			}
			else
			{				
			echo "<table cellpadding='2' cellspacing='0' align='center'>
			<tr><td class='tbl_txt' style='text-align:center;'><b>".$multiget["".$field.""]."</b></td>";			
		
		if($multiget["rates_change"]==2)
	{			
			?>
        <td width="32"><img src="new-images/red-arrow.png" title="% Increase in Rate" border=0 /></td>
        <?php
	}
	else
	{
			?>
        <td width="35"><img src="new-images/green-arrow.png" title="% Decrease in Rate" border=0 /></td>
        <?php } echo "</tr></table>";} ?>
      
      </tr>
      <?php						$i=$i+1;
		}
		}
}	?>
      <?php if($getmsg=="valid" && (!isset($msg)))
{?>
      <tr bgcolor="#A6F2DD">
        <td height="25" align="center"><strong>Bank Name</strong><br></td>
        <td height="25" align="center"><strong>Floating Interest rate</strong><br></td>
        <td height="25" align="center"><strong>Per lac EMI</strong><br></td>
        <td height="25" align="center"><strong>MCLR Rates</strong></td>
        <td height="25" align="center"><strong>Processing Fee</strong></td>
        <td height="25" align="center"><strong>Prepayment Charges</strong></td>
        <td height="25" align="center"><strong>% Change in last 6 mths</strong></td>
      </tr>
      <?php $j=0;
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
      <tr bgcolor="#A6F2DD">
        <td height="25" bgcolor="#FFFFFF" valign="top" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php
			 if($j<13)
			{
?>
            <a href="<?php echo $urlinfo;?>"><b><?php echo $newmultiget[0];?></b></a>
          <?php			
			}
			else
			{
			?>
         <a href="<?php echo $urlinfo;?>"> <b><?php echo $newmultiget[0];?></b></a>
          <?php
			}
            ?></td>
        <td align="center" bgcolor="#FFFFFF" valign="top" style="padding:5px 0px 5px 0px !important; font-size:14px"><b><?php echo $newmultiget[1];?></b></td>
        <td align="center" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php echo $newmultiget[2];?></td>
        <td align="center" valign="top" bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php echo $newmultiget['mclr_rates'];?></td>
        <td align="center" bgcolor="#FFFFFF" valign="top" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php echo $newmultiget[3];?></td>
        <td align="center" bgcolor="#FFFFFF" valign="top" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php echo $newmultiget[4];?></td>
        <td align="center" bgcolor="#FFFFFF" valign="top" style="padding:5px 0px 5px 0px !important; font-size:14px"><?php if($newmultiget[6]==1)
			{
				echo "<b>No Change</b>";
			}
			elseif($newmultiget[6]=="0.00")
			{
				echo "<b>N.A</b>";
			}
			else
			{
				echo "<table cellpadding='2' cellspacing='0' align='center'>
			<tr><td class='tbl_txt' style='text-align:center;'><b>".$newmultiget[6]."</b></td>";			
		?>          
          <?php if($newmultiget["rates_change"]==2)
	{			
			?>
        <td><img src="new-images/red-arrow.png" title="% Increase in Rate" border=0 /></td>
        <?php
	}
	else
	{
		?>
        <td><img src="new-images/green-arrow.png" title="% Decrease in Rate" border=0 /></td>
        <?php }  echo "</tr></table>";} ?>
      </tr>
      <?php	$j=$j+1;
	}
}?>
    </table>
  </div>
  <div class="termtext" style="margin-top:10px"> <span>Before apply for home loan, Calculate your home loan emi with <a href="http://www.deal4loans.com/home-loan-emi-calculator1.php" target="_blank" title="Calculate Home Loan EMI Online">Home Loan EMI Calculator</a></span><br />
    <br />
    <span><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br />
    Banks/ Financial Institutions can contact us at <a href="mailto:customercare@deal4loans.com">customercare@deal4loans.com</a> for inclusions or updates. </span> </div>
</div>
<div style="clear:both;"></div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>