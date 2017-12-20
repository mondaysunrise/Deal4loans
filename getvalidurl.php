<?php
include("scripts/deal4loans_in_connection.php");


$current_date=date('Y-m-d');
$getcompletedate =$current_date." 23:59:59";
//echo $getcompletedate."<br>";
$maxdate= strtotime($getcompletedate);

$getmindate=$maxdate-"2764799";
$getmindate=date("Y-m-d", $getmindate);
$getmindate= $getmindate." 00:00:00";
$mindate=strtotime($getmindate);



//get node date and id
$gettimestamp="select src,dst from url_alias where (dst like '%home-loan%' or dst like '%home-loans%') ";
 list($recordcount,$row)=MainselectfuncNew($gettimestamp,$array = array());
		$cntr=0;

//echo $gettimestamp;
//$getresult=@ExecQuery($gettimestamp);
while($cntr<count($row))
        {
	$getsrc=$row[$cntr]["src"];
	list($node,$nodeid) = split('/', $getsrc);

	$URLSql = "select * from node where nid=".$nodeid." and created between '".$mindate."' and '".$maxdate."' ";
	//echo $URLSql;
		 list($recordcount,$getrow)=MainselectfuncNew($URLSql,$array = array());
		$cntr=0;
		
		//$URLQuery = @ExecQuery($URLSql);
		$recorcount = count($getrow);
		if($recorcount>0)
	{ 
			for($i=0;$i<=10;$i++)
		{
		$title = @mysql_result($URLQuery,$i,'title'); 
		$completeURL="http://www.deal4loans.in/".$row['dst'];
		//echo $title."<br>";
		echo "<a href='".$completeURL."'>".$title."</a><br>";
		}
	}
}
?>