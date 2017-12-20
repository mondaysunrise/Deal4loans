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
			$field="perlac_".$loan_amount;
			$field_nw="percentage_".$loan_amount;
			$selectresult="select  bank_name,".$loan_amount.",".$field.",".$field_nw.",prepayment_charges,processing_fee,bank_url,priority,rates_change from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1 and bank_name='".$bank_name."') order by  priority ASC";
		}
		else
		{
			$field="perlac_".$loan_amount;
			$field_nw="percentage_".$loan_amount;
			$selectresult="select bank_name,".$loan_amount.",".$field.",".$field_nw.", prepayment_charges,processing_fee,bank_url,priority,rates_change from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1) order by  priority ASC";
		}
			list($recordcount,$multiget)=MainselectfuncNew($selectresult,$array = array());
		$msg="valid";
	}
	else
	{
		$selectgetresult="select  bank_name,upto_30lacs, perlac_upto_30lacs,prepayment_charges,processing_fee,bank_url,percentage_upto_30lacs, priority, rates_change from `home_loan_interest_rate_chart` where ( tenure='4' and flag=1) order by  priority ASC";
	list($newrecordcount,$newmultiget)=MainselectfuncNew($selectgetresult,$array = array());

	$getmsg="valid";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Language" content="en-us">
<title>Home Loan Interest Rates | Compare Home Loan Rates 2013</title>
<meta name="keywords" content="Home Loan Rates, Home Loan Interest Rates, Home loan rates in India, compare Home loan rates, Home loans at least interest rate">
<meta name="Description" content="Home loan rates comparison with various banks. Know processing fee, Interest rates for salaried and self employed personnel / professionals. Check latest interest rates of SBI, HDFC Ltd, ICICI, Axis Bank, Bank of India, Bank of Baroda, Allahabad Bank, PNB etc.">
<?php
if(strlen($_GET['source'])>0)
{
echo '<link rel="canonical" href="http://www.deal4loans.com/home-loans-interest-rates.php"/>';

}

?>

<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/hl-intrrates.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
</head>
<body>
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); $currentdate=date('d F Y',$tomorrow); ?>
<div class="hli_rates_header"><?php include "top-menu.php"; include "main-menu.php"; ?></div>

<div style="clear:both;"></div>
<div class="intrl_txt">	
<div class="hli_rates_logo"><img src="images/logo.gif" width="243" height="90" /></div>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">>Home Loan Interest Rates </span></div><div style="clear:both;"></div>
<div class="hli_title_wraper"><div class="hli_title_box"><span class="hli_title_text">Home Loan Interest Rates<br />
</span><span class="hli_title_text_a">(Last edited on : <? echo $currentdate; ?>)</span></div>
<div class="hli_ad"><a href="/home-loan-balance-transfer-calculator.php" style="text-decoration:none;"><img src="http://www.deal4loans.com/new-images/hl-baltrnfr.jpg" /></a></div></div>
<div style="clear:both;"></div>
<div class="hli_content_box">
  <p><span class="text11" style="color:#4c4c4c;">Buying your first home can seem intimidating, especially when faced with many different loan types. Don't worry. Use this list to compare and narrow down the choices to know which is the best.
    <br />
  </span><span class="text11" style="color:#4c4c4c;">    To help its customers get the best interest rates on home loans deal4loans has consolidated all the information regarding current rate of interest for all the banks at one place. Please keep visiting this section to check updated rate of interest for home loans.<br />
  </span></p>
  <span class="text11">
  <div style="font-size: 12px; text-align: center; font-style: italic; width:100%; color:#4c4c4c;">With RBI measures to control Rupee devaluation, 4 Banks have increased rates by .25 basis points. They are Axis Bank, HDFC Ltd, ICICI Bank, Yes Bank & Kotak Mahindra.</div>
  </span></div>
 <div style="clear:both;"></div>
<div style="padding-top:10px;">
<?php
$newsource="hl interest rate apply";
$subjectLine="Get Exact Quote on Home Loan Interest Rates From all Banks";
//include "RightHLS1.php";
include "RightHLS1short.php";
?></div>
<div style="clear:both;"></div>
  <p class="tbl_txt" align="center"><strong>Check Home Loan Interest Rates</strong></p>
<form name="hlinterest" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST">
  <div class="hli_check_home">
    <div class="click_input_section">
    <table width="99%" border="0" cellpadding="0" cellspacing="2">
      <tr>
        <td width="49%" class="tbl_txt"><b>Bank Name</b></td>
        </tr>
      <tr>
        <td align="center"><select name="sel_bank_name" class="hli_input_text" id="sel_bank_name"><option value="">ALL</option><? $selectbankresult="select bank_name from `home_loan_interest_rate_chart` where  (flag=1) group by bank_name order by bank_name ASC";
	echo "uihiyuiu".$selectbankresult."<br>";
		list($num,$bnkn)=MainselectfuncNew($selectbankresult,$array = array());


	for($i=0;$i<$num;$i++)
		{ echo "hello"; ?>
<option value="<? echo $bnkn['bank_name']; ?>" <? if($sel_bank_name==$bnkn[$i]['bank_name'] ) { echo "selected";}?>><? echo $bnkn[$i]['bank_name']; ?></option>

          <? }
	?>
        </select></td>
        </tr>
    </table>
  </div>
  <div class="click_input_section">
    <table width="99%" border="0" cellpadding="0" cellspacing="2">
      <tr>
        <td width="49%" class="tbl_txt"><b>Loan Amount</b></td>
        </tr>
      <tr>
        <td align="center"><select name="loan_amount" class="hli_input_text">
      <option value="PLease Select">PLease Select</option>
      <option value="upto_20lacs" <? if($loan_amount=="upto_20lacs" ) { echo "selected";}?>>Upto 20lacs</option>
      <option value="upto_30lacs" <? if($loan_amount=="upto_30lacs" ) { echo "selected";} elseif(!isset($msg)) {echo "selected";}?> >above 20lacs to 30lacs</option>
      <option value="above_30lacs" <? if($loan_amount=="above_30lacs") { echo "selected";}?>>above 30lacs to 75lacs</option>
      <option value="above_75lacs" <? if($loan_amount=="above_75lacs" ) { echo "selected";}?>>above 75lacs</option>
    </select></td>
        </tr>
    </table>
  </div>
  <div class="click_input_section">
    <table width="99%" border="0" cellpadding="0" cellspacing="2">
      <tr>
        <td width="49%" class="tbl_txt"><b>Loan Tenure</b></td>
      </tr>
      <tr>
        <td align="center"><select name="loan_tenure" class="hli_input_text"> 
	<option value="PLease Select">PLease Select</option>
	<option value="1" <? if($loan_tenure=="1") { echo "selected";}?>>Upto 5yrs</option>
	<option value="2" <? if($loan_tenure=="2") { echo "selected";}?>>From 5yrs to 10yrs</option>
	<option value="3" <? if($loan_tenure=="3") { echo "selected";}?>>From 10yrs to 15yrs</option>
	<option value="4" <? if($loan_tenure=="4") { echo "selected";} elseif(!isset($msg)) {echo "selected";}?>>From 15yrs to 20yrs</option>
	<option value="5" <?if($loan_tenure=="5") { echo "selected";}?>>From 20yrs to 25yrs</option>
	</select></td>
      </tr>
    </table>
  </div>
  <div class="click_input_btn"><input type="image" src="http://www.deal4loans.com/images/gt-intrate.gif"  style="border:0px;" value="submit" name="none" /></div>
  </div>
  </form>
 
  <div class="continer_boxes">

<div class="database_dtls_box">


<table width="98%"   border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">

<? if($msg=="valid" && (!isset($getmsg)))
{?>
<tr bgcolor="#E8F0F6"><td width="148" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Bank Name<br>
</td>
<td width="163" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Floating Interest rate<br></td>
<td width="164" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Per lac EMI<br></td>
<td width="175" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Processing Fee</td>
<td width="167" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Prepayment Charges</td>
<td width="127" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">% Change in last 6 mths</td>

</tr>
<? $i=0;
		if($recordcount>0)
		{	
			for($jj=0;$jj<$newrecordcount;$jj++)
			{
				if(strlen($multiget[$jj]["bank_url"])>0)
				{
					$geturlinfo=$multiget[$jj]["bank_url"];
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
			<tr bgcolor="#F6F4ED"><td height="25" bgcolor="#FFFFFF" class="text11">
        <?php
			if($multiget[$jj]["bank_name"]=="ICICI Bank" || $multiget[$jj]["bank_name"]=="HDFC Ltd" || $multiget[$jj]["bank_name"]=="HSBC Bank" || $multiget[$jj]["bank_name"]=="AXIS Bank" || $multiget[$jj]["bank_name"]=="ING Vysya" || $multiget[$jj]["bank_name"]=="Kotak Bank")
			{
			
		?>    
            <a href="<? echo $geturlinfo;?>"><b><? echo $multiget[$jj]["bank_name"];?></b></a>
            <?php
            }
			else if ($multiget[$jj]["bank_name"]=="UCO Bank" || $multiget[$jj]["bank_name"]=="Bank of Baroda" || $multiget[$jj]["bank_name"]=="Canara Bank" || $multiget[$jj]["bank_name"]=="Syndicate Bank" || $multiget[$jj]["bank_name"]=="Federal Bank" || $multiget[$jj]["bank_name"]=="Development Credit Bank")
			{
?>
<strong>			<? echo $multiget[$jj]["bank_name"];?></strong>
<?php			
			}

            else
            {
?>
            <a href="<? echo $geturlinfo;?>"><b><? echo $multiget[$jj]["bank_name"];?></b></a>
<strong>           <?php 	//echo $multiget[$jj]["bank_name"]; ?></strong>
  
  <?php
            }
            ?>
            </td>
			<td align="center" bgcolor="#FFFFFF" class="text11" style="text-align:center;"><b><? echo $multiget[$jj]["".$loan_amount.""];?></b></td>
			<td align="center" bgcolor="#FFFFFF" class="text11" style="text-align:center;"><? echo $multiget[$jj]["prepayment_charges"];?></td>
			<td align="center" bgcolor="#FFFFFF" class="text11" style="text-align:center;"><? echo $multiget[$jj]["processing_fee"];?></td>
			<!--<td height="35" align="center" valign="middle" bgcolor="#FFFFFF" > -->
			<?php
			if($multiget[$jj]["bank_name"]=="ICICI Bank" || $multiget[$jj]["bank_name"]=="HDFC Ltd" || $multiget[$jj]["bank_name"]=="HSBC Bank" || $multiget[$jj]["bank_name"]=="AXIS Bank" || $multiget[$jj]["bank_name"]=="ING Vysya" || $multiget[$jj]["bank_name"]=="Kotak Bank")
			{
			
				if($multiget[$jj]["priority"]==3)
				{ ?>
				<? }
				else
				{
				?>
				
				<?php
				}
				
			}
			?>
			
           <!-- </td> -->
			</tr>
	<?						$i=$i+1;
		}
		}
}	?>
<? if($getmsg=="valid" && (!isset($msg)))
{?>
<tr bgcolor="#E8F0F6"><td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Bank Name<br>
<img src="images/spacer.gif" width="150" height="1" border="0" ></td>
<td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Floating Interest rate<br><img src="images/spacer.gif" width="120" height="1" border="0" ></td>
<td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Processing Fee</td>
<td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Prepayment Charges</td>
<!--<td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Apply</td> -->
</tr>
<? $j=0;
for($jj=0;$jj<$newrecordcount;$jj++)
		{
			if(strlen($newmultiget[$jj]["bank_url"])>0)
			{
				$urlinfo=$newmultiget[$jj]["bank_url"];
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
			if($newmultiget[$jj]["bank_name"]=="ICICI Bank" || $newmultiget[$jj]["bank_name"]=="HDFC Ltd" || $newmultiget[$jj]["bank_name"]=="HSBC Bank" || $newmultiget[$jj]["bank_name"]=="AXIS Bank" || $newmultiget[$jj]["bank_name"]=="ING Vysya" || $newmultiget[$jj]["bank_name"]=="Kotak Bank")
			{
			?>
            <a href="<? echo $urlinfo;?>"><b><? echo $newmultiget[$jj][0];?></b></a>
            <?php
			}
			else if ($newmultiget[$jj]["bank_name"]=="UCO Bank" || $newmultiget[$jj]["bank_name"]=="Bank of Baroda" || $newmultiget[$jj]["bank_name"]=="Canara Bank" || $newmultiget[$jj]["bank_name"]=="Syndicate Bank" || $newmultiget[$jj]["bank_name"]=="Federal Bank" || $newmultiget[$jj]["bank_name"]=="Development Credit Bank")
			{
?>
<strong>			<? echo $newmultiget[$jj][0];?></strong>
<?php			
			}
			else
			{
			?>
                  <a href="<? echo $urlinfo;?>"><b><? echo $newmultiget[$jj][0];?></b></a>
<strong>			<? //echo $newmultiget[$jj][0];?></strong>
            <?php
			}
            ?>
            </td>
			<td align="center" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b><? echo $newmultiget[$jj][1];?></b></td>
			<td align="left" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $newmultiget[$jj][2];?></td>
			<td align="center" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $newmultiget[$jj][3];?></td>
			<!--<td height="35" align="center" valign="middle" bgcolor="#FFFFFF" > -->
			<?php
			if($newmultiget[$jj]["bank_name"]=="ICICI Bank" || $newmultiget[$jj]["bank_name"]=="HDFC Ltd" || $newmultiget[$jj]["bank_name"]=="HSBC Bank" || $newmultiget[$jj]["bank_name"]=="AXIS Bank" || $newmultiget[$jj]["bank_name"]=="ING Vysya" || $newmultiget[$jj]["bank_name"]=="Kotak Bank")
			{
				if($newmultiget[$jj][5]==3)
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
}?>



</table>
</div>
<div style="clear:both;"></div>
  </div></div>


</div>
<div style="clear:both;"></div>
  <div class="content_c_mobo"> <div  class="content_section_below" ><span class="text11" style="color:#4c4c4c; width:950px;  margin-top:10px;">Before apply for home loan, Calculate your home loan emi with <a href="home-loan-emi-calculator1.php">Home Loan EMI Calculator</a></span></div>
  <div style="margin-top:10px;" class="content_section_below"><span class="text11" style="color:#4c4c4c; width:950px;  margin-top:10px;"><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br />
Banks/ Financial Institutions can contact us at <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates. </span></div>
  
  </div>
  
<div style="text-align:center; width:100%;">
<?php
include "responsive_footer.php";
?></div>

</div>

<div class="hli_rates_footer"><?php //include "home_loan_footer_form.php"; ?> 
<?php include "footer1.php"; ?></div>
</body>
</html>