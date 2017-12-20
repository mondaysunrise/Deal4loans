<?php
require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$newbank_name= $_POST["bank_name"];
		$newcard_type=$_POST["card_type"];
		//$card_city = $_POST["card_city"];
		$card_stat =$_POST["card_stat"];


		$getselectcard=ExecQuery("select * from creditndebit_card_offer where (ccndc_offer_type=".$newcard_type." and bank_name='".$newbank_name."' and ccndc_approval=".$card_stat.") order by card_name ASC");

		$is_valid=1;


	}
	
?>
<html>
<head>
</head>
	<body>
<?php 

	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
		
		<div align="center">
		<table>
		<tr><td colspan="2">
<form name="ccndc" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
<table border="1">
	<tr>
	<td colspan="2">
	<div align="center" style="font-family:verdana; font-size:11px; "><b>fill details</b></div>
	</td></tr>
	<tr><td>
	Bank Name
	</td>
	<td>
	<select name="bank_name" id="bank_name">
	<option value="-1">Please select</option>
	<? $selectcard=ExecQuery("select bank_name From creditndebit_card_offer group by bank_name ");
	while ($row = mysql_fetch_array($selectcard))
	{
		?>
		<option value="<? echo $row["bank_name"];?>" <? if ($newbank_name==$row['bank_name']) { echo "selected";}?>><? echo $row["bank_name"];?></option>
		<?
	}
	?>
	</select></td>
	</tr>
	<tr><td>Card Type</td>
		<td>
			<select name="card_type" id="card_type">

				<option value="1" <? if($card_type==1) {echo "Selected";} ?>>Credit Card</option>
				<option value="2" <? if($card_type==2) {echo "Selected";} ?>>Debit Card</option>
			</select>
		</td>
	</tr>
	
	<tr><td>Status</td>
		<td>
			<select name="card_stat" id="card_stat">

				<option value="1" <? if($card_stat==1) {echo "Selected";} ?>>Active</option>
				<option value="0" <? if($card_stat==0) {echo "Selected";} ?>>Non Active</option>
			</select>
		</td>
	</tr>
	<!--<tr><td>City</td>
		<td>
		
<!--<select id="card_city" name="card_city"><option value="Please Select" <? //if($card_city=="Please Select") { echo "Selected";} ?>>Please Select</option>
<option value="Ahmedabad" <? //if($card_city=="Ahmedabad") { echo "Selected";} ?>>Ahmedabad</option>
<option value="Bangalore" <? //if($card_city=="Bangalore") { echo "Selected";} ?>>Bangalore</option>
<option value="Chennai" <? //if($card_city=="Chennai") { echo "Selected";} ?>>Chennai</option>
<option value="Delhi" <? //if($card_city=="Delhi") { echo "Selected";} ?>>Delhi & NCR</option>
<option value="Hyderabad" <? //if($card_city=="Hyderabad") { echo "Selected";} ?>>Hyderabad</option>
<option value="Kolkata" <? //if($card_city=="Kolkata") { echo "Selected";} ?>>Kolkata</option>
<option value="Mumbai" <? //if($card_city=="Mumbai") { echo "Selected";} ?>>Mumbai</option>
<option value="Pune" <? //if($card_city=="Pune") { echo "Selected";} ?>>Pune</option>
<option value="All">Common</option>
</select>
		</td>
	</tr>-->
	<tr>
	<td colspan="2" align="center"> <input type="submit" value="submit" name="submit">
	</td></tr>
		</table></form>
		</td></tr>
<?		if($is_valid==1)
		{
			?>
		<tr>
		<td colspan="2">List of Cards
		</td></tr>
		<tr>
		<td colspan="2">
		
			<? while ($getrow = mysql_fetch_array($getselectcard))
			{ //ccndc_offerid, card_name
				echo "<a href='http://www.deal4loans.com/editccndc.php?cardid=".$getrow["ccndc_offerid"]."' target='_blank'>".$getrow["bank_name"]." - ".$getrow["card_name"]."</a>-".$getrow["city_list"]." <br>";		
			}?>
		</td>
		</tr>
		<? } ?>

</table>
</div>
	</body>
</html>