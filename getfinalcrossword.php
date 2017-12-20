<?php
//require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
//require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$clues_across=$_REQUEST['clues_across'];
	$clues_down=$_REQUEST['clues_down'];
	$rows=$_REQUEST['getrows'];
	$cols=$_REQUEST['getcols'];
	$last_id=$_REQUEST['last_id'];

for ($k=0;$k<$rows;$k++) {
	for ($j=0;$j<$cols;$j++) {
		$variable ="serial_";
		$variable.=$j."_".$k;
		$getoption= $_REQUEST[$variable];
		$getoptionarr[$k][$j]=$getoption;
		$getcompleteoption.=$getoption;
		$getcompleteoption.=",";
}

}

//echo $getoption."<br>";
//echo $clues_across." ".$clues_down."<br>";
//print_r($getoptionarr);
//echo "string::".$getcompleteoption."<br>";
//if($clues_across>0 || $clues_down>0)
	//{
		$insertcrossword_details="update Crossword_Details set Crossword_Option='$getcompleteoption',Crossword_Across='$clues_across',Crossword_Down='$clues_down'  where CrosswordID='".$last_id."' ";
		//echo $insertcrossword_details;
	$getinsertcrossword_details=ExecQuery($insertcrossword_details);


	//}

}?>
<html><head>
</head>
<body><?


$getthiscrossword="select * from Crossword_Details where CrosswordID='".$last_id."'";
$getthiscrossword_details=ExecQuery($getthiscrossword);
while($row=mysql_fetch_array($getthiscrossword_details))
{
	$Crossword_Solution=$row['Crossword_Solution']; 
	$Crossword_Option=$row['Crossword_Option']; 
	$Crossword_Across=$row['Crossword_Across'];
	$Crossword_Down=$row['Crossword_Down'];
}

$Crossword_Solution = substr($Crossword_Solution, 0, strlen($Crossword_Solution)-1);
//echo $Crossword_Solution;

//this is for solution
$newarray=explode(',',$Crossword_Solution);
for ($k=0;$k<$rows;$k++) {
//$getnew[];
	for ($j=0;$j<$cols;$j++) {
		
		$FinalPosition = ($k*$cols)+($j);
		//print_r($newarray[$FinalPosition]);
		$getnew[$k][]=$newarray[$FinalPosition];
}

}
//this is for serial number
$newserial=explode(',',$Crossword_Option);
for ($s=0;$s<$rows;$s++) {
//$getnew[];
	for ($t=0;$t<$cols;$t++) {
		
		$FinalPosition = ($s*$cols)+($t);
		//print_r($newserial[$FinalPosition]);
		$getnewseries[$s][]=$newserial[$FinalPosition];
}

}
/////print_r($newarray);
//echo "<br>";
//print_r($getnew);
$r="";
$p="";
$getcontent="<table border='1' cellpadding='2' cellspacing='0' align='center'>";
for ($r=0;$r<$rows;$r++) {
		$getcontent.="<tr>";
	for ($p=0;$p<$cols;$p++) {
	$variable=$p."_".$r;
if(strlen($getnew[$r][$p])>0)
		{
$getcontent.="<td style='border:1px solid #0000ff;' width='30'><sup style='font-size:7px;' valign='top'>".$getnewseries[$r][$p]."</sup>&nbsp;".$getnew[$r][$p]." </td>";
		}
		else
		{
$getcontent.="<td style='border:1px solid #FFFFFF;'>&nbsp;</td>";
		}
   
}

$getcontent.="</tr>";

}
$getcontent.="</table>";
echo $getcontent;
?>
<table width='400' align='center' cellpadding='0' cellspacing='0'>
<tr><td style='font-family:verdana;'><b>Across</b></td><td style='font-family:verdana;'><b>Down</b></td></tr>
<tr><td style='font-family:verdana;font-size:11px;'><? echo $Crossword_Across ;?></td><td style='font-family:verdana; font-size:11px;'><? echo $Crossword_Down;?></td></tr>



</body></html>