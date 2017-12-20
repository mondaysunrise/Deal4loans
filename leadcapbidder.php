<?php
session_start();
///require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$titles = array('811','810','808','807','807','805','804','803','799','798','801','796','795','796','806','786','782','783','789','779','775','771','809','771','788','735','731','713','701','699','774','770','683','675','640','719','691','714') 		
	;
?>
<html>
<body>
<table>
<tr><td>Bidder</td>
<td>Count</td><td>Captotal</td></tr>
<tr>
<? for ($i=0;$i<count($titles);$i++)
{
	$query="select BookProduct ,sum(BookLeadCount) as sum  from Bidders_Book_Keeping where BidderID='".$titles[$i]."' group by BidderID";
	//echo "hello".$query;
	$result=ExecQuery($query);
	while($row=mysql_fetch_array($result))
		{
	?><td><?echo $row['sum'];?></td>
<td><?echo $titles[$i];?></td>
<td><? echo $row['BookProduct'];?></td>
</tr>
<?
		$i=$i+1;}
}
?>

</table>
</body>
</html>