<?php
	require 'scripts/db_init.php';
	
	
	$sql_2 = "select Product from city_pages where Status=1 and State!='' group by Product";
	list($num_2,$query_2)=MainselectfuncNew($sql_2,$array = array());

	for($k=0;$k<$num_2;$k++)
	{	
		$Product = $query_2[$k]['Product'];
		$Product_lower = strtolower($Product);
		$Product_Url = str_replace(" ", "-", $Product_lower);
		echo "".ucwords(strtolower($Product));
		echo "<br>";
		$sql = "select State from city_pages where 	Status=1 and Product='".$Product."' and State!='' group by State";

		list($num,$query)=MainselectfuncNew($sql,$array = array());
		for($i=0;$i<$num;$i++)
		{
	
			$State  = $query[$i]['State'];
			echo "Personal Loan in ".ucwords(strtolower($State));
			$sql_1 = "select * from city_pages where Status=1 and Product='".$Product."' and State = '".$State."'";
			list($num_1,$query_1)=MainselectfuncNew($sql_1, $array = array());
			for($j=0;$j<$num_1;$j++)
			{
				$City = $query_1[$j]['City'];
				echo "<br>";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;";
				$url = "http://www.deal4loans.com/".strtolower($Product_Url)."/".$City;
				echo "<a href='".$url."'>".$Product." in ".ucwords(strtolower($City))."</a>";
				
			}
			echo "<br>";
			echo "-------------------------------";
			echo "<br>";
		}
			echo "<br>";
			echo "###################################################";
			echo "<br>";
	
	}
?>