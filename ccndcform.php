<?php
require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$cardid=$_POST["creditcardid"];
		$dinning_offers=$_POST["dinning_offer"];
		$shopping_offers=$_POST["shopping_offer"];
		$entertainment_offers=$_POST["entertainment_offer"];
		$travel_offers=$_POST["travel_offer"];
		$petrol_offers=$_POST["petrol_offer"];
		$reward_points_offers=$_POST["reward_offer"];
		$other_offers=$_POST["other_offer"];
		$Published=$_POST["Published"];
		$card_name=$_POST["card_name"];
		$bank_name=$_POST["bank_name"];
		$card_type=$_POST["card_type"];
		$card_city = $_POST["card_city"];
		
		 $card_cy="";
			$nn = count($card_city);
						
	//print_r($card_city);
		$ii  = 0;
//update the query now
if(count($card_city)>1)
{	
	for($i=0;$i<count($card_city);$i++)
	{
/*			$updateccndc='INSERT INTO creditndebit_card_offer (bank_name, card_name, dinning_offers, shopping_offers,  	  entertainment_offers, travel_offers, petrol_offers, reward_points_offers, other_offers, ccndc_offer_type, ccndc_dated, ccndc_approval, city_list ) values ("'.$bank_name.'","'.$card_name.'","'.$dinning_offers.'","'.$shopping_offers.'","'.$entertainment_offers.'","'.$travel_offers.'","'.$petrol_offers.'","'.$reward_points_offers.'","'.$other_offers.'","'.$card_type.'",NOW(),"'.$Published.'","'.$card_city[$i].'")';
			$updateccndcresult=ExecQuery($updateccndc);*/

			$updateccndc="INSERT INTO creditndebit_card_offer (bank_name, card_name, dinning_offers, shopping_offers,  	  entertainment_offers, travel_offers, petrol_offers, reward_points_offers, other_offers, ccndc_offer_type, ccndc_dated, ccndc_approval, city_list ) values ('".$bank_name."','".$card_name."','".$dinning_offers."','".$shopping_offers."','".$entertainment_offers.'","'.$travel_offers.'","'.$petrol_offers.'","'.$reward_points_offers.'","'.$other_offers.'","'.$card_type."',NOW(),'".$Published."','".$card_city[$i]."')";
			$updateccndcresult=ExecQuery($updateccndc);
			//echo $updateccndc."<br><br>";
	}

}
else
{
	/*$updateccndc='INSERT INTO creditndebit_card_offer (bank_name, card_name, dinning_offers, shopping_offers,  	  entertainment_offers, travel_offers, petrol_offers, reward_points_offers, other_offers, ccndc_offer_type, ccndc_dated, ccndc_approval, city_list ) values ("'.$bank_name.'","'.$card_name.'","'.$dinning_offers.'","'.$shopping_offers.'","'.$entertainment_offers.'","'.$travel_offers.'","'.$petrol_offers.'","'.$reward_points_offers.'","'.$other_offers.'","'.$card_type.'",NOW(),"'.$Published.'","'.$card_city[0].'")';
	$updateccndcresult=ExecQuery($updateccndc);*/


	$updateccndc="INSERT INTO creditndebit_card_offer (bank_name, card_name, dinning_offers, shopping_offers,  	  entertainment_offers, travel_offers, petrol_offers, reward_points_offers, other_offers, ccndc_offer_type, ccndc_dated, ccndc_approval, city_list ) values ('".$bank_name."','".$card_name."','".$dinning_offers."','".$shopping_offers."','".$entertainment_offers."','".$travel_offers."','".$petrol_offers."','".$reward_points_offers."','".$other_offers."','".$card_type."',NOW(),'".$Published."','".$card_city[0]."')";
	$updateccndcresult=ExecQuery($updateccndc);
	
	//echo $updateccndc."<br><br>";
}


//echo $updateccndc."<br>";

}

	

?>
<html>
	<head>
	</head>
		<body>
		<form name="carddetails" action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST">
<input type="hidden" name="creditcardid" id="creditcardid" value="<? echo $cardid;?>">
			<table border="1">
			<tr>
				<td>Bank Name</td>
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
			<tr>
				<td>Card Type</td>
				<td><select name="card_type" id="card_type"><option value="1">Credit Card</option><option value="2">Debit Card</option></select></td>
			</tr>
			<tr>
				<td>Card Name</td>
				<td><input type="text" name="card_name" value="<?  echo $card["card_name"];?>"></td>
			</tr>
			<tr><td>City</td>
		<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
		<input type="checkbox" id="card_city" name="card_city[]" value="Ahmedabad">Ahmedabad
		<input type="checkbox" id="card_city" name="card_city[]" value="Bangalore">Bangalore
		<input type="checkbox" id="card_city" name="card_city[]" value="Chennai">Chennai<br>
		<input type="checkbox" id="card_city" name="card_city[]" value="Delhi">Delhi
		<input type="checkbox" id="card_city" name="card_city[]" value="Hyderabad">Hyderabad
		<input type="checkbox" id="card_city" name="card_city[]" value="Kolkata">Kolkata<br>
		<input type="checkbox" id="card_city" name="card_city[]" value="Mumbai">Mumbai
		<input type="checkbox" id="card_city" name="card_city[]" value="Pune">Pune
		<input type="checkbox" id="card_city" name="card_city[]" value="All">Common
		
		
<!--<select id="card_city" name="card_city"><option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chennai">Chennai</option><option value="Delhi">Delhi & NCR</option><option value="Hyderabad">Hyderabad</option><option value="Kolkata">Kolkata</option><option value="Mumbai">Mumbai</option><option value="Pune">Pune</option>
<option value="All">Common</option>
</select>-->
		</td>
	</tr>
			<tr>
				<td>Dinning Offer</td>
				<td><textarea rows="3" cols="40" name="dinning_offer"><? if(isset($dinning_offers)>0) {  echo $dinning_offers;}?></textarea></td>
			</tr>
			<tr>
				<td>Shopping Offer</td>
				<td><textarea rows="3" cols="40" name="shopping_offer"><? if(isset($shopping_offers)>0) {  echo $shopping_offers;} ?></textarea></td>
			</tr>
			<tr>
				<td>Entertainment Offer</td>
				<td><textarea rows="3" cols="40" name="entertainment_offer"><? if(isset($entertainment_offers)>0) {  echo $entertainment_offers;} ?></textarea></td>
			</tr>
			<tr>
				<td>Travel Offer</td>
				<td><textarea rows="3" cols="40" name="travel_offer"><? if(isset($travel_offers)>0) {  echo $travel_offers;} ?></textarea></td>
			</tr>
			<tr>
				<td>Petrol Offer</td>
				<td><textarea rows="3" cols="40" name="petrol_offer"><? if(isset($petrol_offers)>0) {  echo $petrol_offers;} ?></textarea></td>
			</tr>
			<tr>
				<td>Reward Points Offer</td>
				<td><textarea rows="3" cols="40" name="reward_offer"><? if(isset($reward_points_offers)>0) {  echo $reward_points_offers;} ?></textarea></td>
			</tr>
			<tr>
				<td>Other Offer</td>
				<td><textarea rows="3" cols="40" name="other_offer"><? if(isset($other_offers)>0) {  echo $other_offers;} ?></textarea></td>
			</tr>
			<tr>
				<td>Published</td>
				<td><input type="radio" name="Published" id="Published" value="1" <?php  if($_POST["Published"]==1 && isset($_POST["Published"])) { echo "checked";}?> >Yes &nbsp;<input type="radio" name="Published" value="0" id="Published" <? if($_POST["Published"]==0 && isset($_POST["Published"])) { echo "checked";}?>>No &nbsp;</td>
			</tr>
			
			
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td>
			</tr>
			</table>
			</form>

			<? //}?>
		</body>
</html>