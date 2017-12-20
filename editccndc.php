<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();


$cardid=$_REQUEST["cardid"];
$getcard="select * from creditndebit_card_offer where ccndc_offerid=".$cardid;
	list($num_rows,$row)=MainselectfuncNew($getcard,$array = array());
$contr=count($row)-1;
$card = $row[$contr];


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$cardid=FixString($_POST["cardid"]);
		if(strlen($_POST["dinning_offer"])>2)
		{$dinning_offers= $_POST["dinning_offer"]; } else { $dinning_offers="";}
		if(strlen($_POST["shopping_offer"])>2)
		{$shopping_offers= $_POST["shopping_offer"]; } else { $shopping_offers="";}
		if(strlen($_POST["entertainment_offer"])>2)
		{$entertainment_offers= $_POST["entertainment_offer"]; } else { $entertainment_offers="";}
		if(strlen($_POST["travel_offer"])>2)
		{$travel_offers= $_POST["travel_offer"]; } else { $travel_offers="";}
		if(strlen($_POST["petrol_offer"])>2)
		{$petrol_offers= $_POST["petrol_offer"]; } else { $petrol_offers="";}
		if(strlen($_POST["reward_offer"])>2)
		{$reward_points_offers= $_POST["reward_offer"]; } else { $reward_points_offers="";}
		if(strlen($_POST["other_offer"])>2)
		{$other_offers= $_POST["other_offer"]; } else { $other_offers="";}
		$Published=FixString($_POST["Published"]);
		$card_name=FixString($_POST["card_name"]);
		$bank_name=FixString($_POST["bank_name"]);

$Dated = ExactServerdate();
$data = array('bank_name'=>$bank_name, 'card_name'=>$card_name, 'dinning_offers'=>$dinning_offers, 'shopping_offers'=>$shopping_offers, 'entertainment_offers'=>$entertainment_offers, 'travel_offers'=>$travel_offers, 'petrol_offers'=>$petrol_offers, 'reward_points_offers'=>$reward_points_offers, 'other_offers'=>$other_offers, 'ccndc_approval'=>$Published, 'ccndc_dated'=>$Dated);
$wherecondition ="(ccndc_offerid=".$cardid.")";

//print_r($data);
Mainupdatefunc ('creditndebit_card_offer', $data, $wherecondition);
}
//echo $card["ccndc_approval"]."<br>";
?>
<html>
	<head>
	</head>
		<body>
		<form name="carddetails" action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST">
<input type="hidden" name="cardid" id="cardid" value="<? echo $cardid;?>">
			<table border="1">
			<tr>
				<td>Bank Name</td>
				<td><input type="text" name="bank_name" value="<? if(isset($bank_name)>0) {  echo $bank_name;} else { echo $card["bank_name"];}?>"></td>
			</tr>
			<tr>
				<td>Card Name</td>
				<td><input type="text" name="card_name" value="<? if(isset($card_name)>0) {  echo $card_name;} else { echo $card["card_name"];}?>"></td>
			</tr>
			<tr>
				<td>Card City</td>
				<td><? echo $card["city_list"];?></td>
			</tr>
			<tr>
				<td>Dinning Offer</td>
				<td><textarea rows="4" cols="30" name="dinning_offer"><? if(isset($dinning_offers)>0) {  echo $dinning_offers;} else { echo $card["dinning_offers"]; }?></textarea></td>
			</tr>
			<tr>
				<td>Shopping Offer</td>
				<td><textarea rows="4" cols="30" name="shopping_offer"><? if(isset($shopping_offers)>0) {  echo $shopping_offers;} else{  echo $card["shopping_offers"];}?></textarea></td>
			</tr>
			<tr>
				<td>Entertainment Offer</td>
				<td><textarea rows="4" cols="30" name="entertainment_offer"><? if(isset($entertainment_offers)>0) {  echo $entertainment_offers;} else { echo $card["entertainment_offers"]; } ?></textarea></td>
			</tr>
			<tr>
				<td>Travel Offer</td>
				<td><textarea rows="4" cols="30" name="travel_offer"><? if(isset($travel_offers)>0) {  echo $travel_offers;} else { echo $card["travel_offers"];}?></textarea></td>
			</tr>
			<tr>
				<td>Petrol Offer</td>
				<td><textarea rows="4" cols="30" name="petrol_offer"><? if(isset($petrol_offers)>0) {  echo $petrol_offers;} else {  echo $card["petrol_offers"];}?></textarea></td>
			</tr>
			<tr>
				<td>Reward Points Offer</td>
				<td><textarea rows="4" cols="30" name="reward_offer"><? if(isset($reward_points_offers)>0) {  echo $reward_points_offers;} else {   echo $card["reward_points_offers"];}?></textarea></td>
			</tr>
			<tr>
				<td>Other Offer</td>
				<td><textarea rows="4" cols="30" name="other_offer"><? if(isset($other_offers)>0) {  echo $other_offers;} else {   echo $card["other_offers"];}?></textarea></td>
			</tr>
			<tr>
				<td>Published</td>
				<td><input type="radio" name="Published" id="Published" value="1" <?php  if(($card["ccndc_approval"]==1 && isset($card["ccndc_approval"])) || ($_POST["Published"]==1 && isset($_POST["Published"]))) { echo "checked";}?> >Yes &nbsp;<input type="radio" name="Published" value="0" id="Published" <? if(($card["ccndc_approval"]==0 && isset($card["ccndc_approval"])) || ($_POST["Published"]==0 && isset($_POST["Published"]))) { echo "checked";}?>>No &nbsp;</td>
			</tr>
			
			
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td>
			</tr>
			</table>
			</form>

			<? //}?>
		</body>
</html>