<?php
	
	/*function validateValues($Value)
	{
		$remove = "lalit, upendra";

		$explodeVal = explode(",", $remove);
		for($i=0;$i<count($explodeVal);$i++)
		{
			if (preg_match("/".$explodeVal[$i]."/i", strtolower($Value)))
				$trueVal = 0;
			else 
				$trueVal = 1;
			
			$trueValARR[] = $trueVal;
		}
		if(in_array(0,$trueValARR))
			return 0;
		else
			return 1;
	}
*/


function validateValues($ab)
{
	$remove = "zebra, sex, sexy, busty, boobs, boob, breast, nipple, nipples, ass, butt, penis, viagra, vagina, rape, pussy, erotic, ebony, babe, hottie, pee, fuck, asshole, Full Name, Select Your City, Other City";
	$explodeVal = explode(",", $remove);
	
	//echo $ab;

	$aw = "";
	for($k=0;$k<count($explodeVal);$k++)
	{
			
		if (preg_match("/$explodeVal[$k]/i", $ab)) {
		  $trueVal = "Remove";
		} else {
			$trueVal = "Putin";
		}

		$aw[] =$trueVal;
	}
	//print_r ($aw);
	if(in_array("Remove",$aw))
	{
		$val="Discard";
		return $val;
	}
	else
	{
		$val = "Put";
		return $val;
	}
}

/*	$crap = $Name." ".$Email." ".$Company_Name." ".$City_Other." ".$Residence_Address." ".$Descr;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		
		//exit();
		if($crapValue==1)
		{
			//SQL Query
		}//$crap Check
		else
		{
			header("Location: Redirect.php");
			exit();
		}
*/		

?>