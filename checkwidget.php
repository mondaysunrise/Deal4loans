<?php	
require 'scripts/session_check.php';
require 'scripts/functions.php';
require 'scripts/db_init.php';
?>

<link href="style/pl-hl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<div id="tabvanilla" class="widget">

           <ul class="tabnav" style="padding-bottom:5px;">
           <li><a href="#recent">Home Loan</a></li>
           <li><a href="#popular">Personal Loan</a></li>
           </ul>

            <div id="recent" class="tabdiv" >
	<div style="background:url(new-images/rgt-tpimg.jpg); background-repeat:no-repeat; width:250px; height:41px; text-align:center; line-height:35px;"><b>Home Loan Interest Rates </b></div>
			<div style=" background:url(new-images/rgt-bg.gif); background-repeat:repeat-y; width:250px;">

			      <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <? $gethlrates=ExecQuery("Select ndtv_rates,bank_name From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (203,5,8,3) and flag=1)");
	while($hlrow=mysql_fetch_array($gethlrates))
	{
	?>
  <tr>
    <td width="47%" height="22"><? echo $hlrow["bank_name"]; ?> </td>
     <td width="53%" style="font-size:11px;"><b><? echo $hlrow["ndtv_rates"]; ?></b></td>
    </tr>
	   <tr>
		  <td height="2" colspan="2" align="center"><img src="/new-images/bt-line.gif" width="209" height="2" alt="" /></td>
		</tr>
	<? }?>
                    <tr>
                      <td valign="bottom" align="left"><a href="Contents_Disclaimer.php" style="font-size:10px; color:#666666;">T and C APPLY*</a></td>
                      <td height="25" align="right" valign="bottom"><a href="home-loans-interest-rates.php">Know more...</a></td>
                    </tr>
                  </table>
			</div>
<div style="background:url(new-images/bg-bt.jpg); background-repeat:no-repeat; width:250px; height:19px;"></div>
            </div><!--/recent-->
			
			<div id="popular" class="tabdiv">
			<div style="background:url(new-images/rgt-tpimg.jpg); background-repeat:no-repeat; width:250px; height:41px; text-align:center; line-height:35px;"><b>Personal Loan Interest Rates </b></div>
			<div style=" background:url(new-images/rgt-bg.gif); background-repeat:repeat-y; width:250px;">
              <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
<? $getplrates=ExecQuery("Select cat_a,bank_name,others From personal_loan_interest_rate_chart where (flag=1 and rateid in (2,3,7,12))");
while($plrow=mysql_fetch_array($getplrates))
{
?>
<tr>
 <td width="56%" height="22"><? echo $plrow["bank_name"]; ?></td>
<td width="44%"  style="font-size:11px;"><b><? echo $plrow["cat_a"]."-".$plrow["others"]; ?></b></td>
</tr>

<? }?>
            
                <tr>
                  <td valign="bottom" align="left"><a href="Contents_Disclaimer.php" style="font-size:10px; color:#666666;">T and C APPLY*</a></td>
                  <td height="25"  align="right" valign="bottom"><a href="personal-loan-interest-rate.php">Know more...</a></td>
                </tr>
              </table>
			</div>
<div style="background:url(new-images/bg-bt.jpg); background-repeat:no-repeat; width:250px; height:19px;"></div>

            </div><!--/popular-->

         </div>