<?php
//require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
//require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$getname=$_REQUEST['getname'];
	$rows=$_REQUEST['getrows'];
	$cols=$_REQUEST['getcols'];
	$clues_across=$_REQUEST['clues_across'];
	$clues_down=$_REQUEST['clues_down'];

$getnewvalue="";
$getarrval="";
$getcompletearray="";
for ($k=0;$k<$rows;$k++) {
//$getnewvalue.="Array(";
		for ($j=0;$j<$cols;$j++) {
			//$getnewvalue.="[$j]=> ";
			
	$variable=$j."_".$k;
	$getvalue= $_REQUEST['getexactvalue_'.$variable];
	$getvaluearr[$k][$j]=$getvalue;
	//echo $getvalue;
	$getcompletearray.=$getvalue;
		$getcompletearray.=",";

	if($getvalue!='')
			{
$getnewvalue.="[$k][$j]";
$getnewvalue.=",";
$getarrval.=$getvalue;
$getarrval.=",";
			}
	//$getnewvalue.='"'.$getvalue.'",';
}
//$getnewvalue.="),";

}
//$getnewvalue.=");";
//echo $getcompletearray."<br>";
//echo "posi".$getnewvalue."<br>";
//echo "valu".$getarrval."<br>";
if($rows>0 || $cols>0)
	{
	$insertcrossword="insert into Req_Crossword (Crossword_Name,Crossword_Rows,Crossword_Cols,Crossword_Flag,Crossword_Date) values ('$getname','$rows','$cols','1',Now())";
	//echo $insertcrossword."<br>";
	$getresult=ExecQuery($insertcrossword);
	$last_inserted_id = mysql_insert_id();

	$insertcrossword_details="insert into Crossword_Details (CrosswordID,Crossword_Solution,Crossword_Across,Crossword_Down) values ('$last_inserted_id','$getcompletearray','$clues_across','$clues_down')";
	//echo $insertcrossword_details."<br>";
	$getinsertcrossword_details=ExecQuery($insertcrossword_details);


	}

}?>
<html><head>
</head>
<body>
<?
$k="";
$j="";?>

<table border='0' width='700' cellpadding='0' cellspacing='0'>
<tr><td colspan='2'>Here u can define serial number</td></tr><tr><td colspan='2' >
<form name="finalcrossword" action="getfinalcrossword.php"  method="POST">
<table border='1' width='100%' cellspacing='0' cellpadding='0'>
<?for ($k=0;$k<$rows;$k++) {
		?>
		<tr>
		<?
	for ($j=0;$j<$cols;$j++) {
	$variable=$j."_".$k;
//echo	"serial_".$variable;
if(($getvaluearr[$k][$j])=='')
		{
	?><td style='border:1px solid #0000ff;' width='10'><input type='hidden' size='1' maxlength='2' name='serial_<? echo $variable;?>' id='serial_<? echo $variable;?>'><? //echo"serial_".$variable;?></td>
	<?
		}
		else
		{?>
<!--//$getcontent.="<td ><input type='text' size='1'  maxlength='1' value=".$getvaluearr[$k][$j]."></td>";-->
<td style='border:1px solid #0000ff;'width='20'><input type='text' size='1' maxlength='2' name='serial_<? echo $variable;?>' id='serial_<? echo $variable;?>'><? echo $getvaluearr[$k][$j];?></td>
		<?}

   
}
?>
</tr>

<?}?>

</table></td></tr>
<tr><td >Clues Across</td><td><textarea rows='5' cols='30' name='clues_across' id='clues_across' ><? echo $clues_across;?></textarea></td></tr><tr><td>Clues Down</td><td><textarea rows='5' cols='30' name='clues_down' id='clues_down' ><? echo $clues_down;?></textarea></td></tr>
<tr><td colspan='2'><input type='hidden' name='getrows' id='getrows' value='<? echo $rows;?>'><input type='hidden' name='getcols' id='getcols' value='<? echo $cols; ?>'><input type='hidden' name='last_id' id='last_id' value='<? echo $last_inserted_id;?>'><input type='hidden' name='getcols' id='getcols' value='<? echo $cols; ?>'></td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="submit"></td></tr>
</table>
</form>

<?

/*$getcontent="<table border='1' width='700'>";
$getcontent.="<tr><td colspan='2'>Here u can define serial number</td></tr><tr><td colspan='2' >";
$getcontent.="<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
for ($k=0;$k<$rows;$k++) {
		$getcontent.="<tr>";
	for ($j=0;$j<$cols;$j++) {
	$variable=$j."_".$k;
if(($getvaluearr[$k][$j])=='')
		{
	$getcontent.="<td style='border:1px solid #0000ff;' width='10'>&nbsp;</td>";
		}
		else
		{
//$getcontent.="<td ><input type='text' size='1'  maxlength='1' value=".$getvaluearr[$k][$j]."></td>";
$getcontent.="<td style='border:1px solid #0000ff;'width='20'><input type='text' size='1' maxlength='2' name='serial_$variable' id='serial_$variable'>".$getvaluearr[$k][$j]."</td>";
		}

   
}

$getcontent.="</tr>";

}

$getcontent.="</table></td></tr>";
$getcontent.="<tr><td >Clues Across</td><td><textarea rows='5' cols='30' name='clues_across' id='clues_across' >$clues_across</textarea></td></tr><tr><td>Clues Down</td><td><textarea rows='5' cols='30' name='clues_down' id='clues_down' >$clues_down</textarea></td></tr>";
$getcontent.="<tr><td colspan='2'><input type='hidden' name='getrows' id='getrows' value='$rows'><input type='hidden' name='getcols' id='getcols' value=' $cols'></td></tr>";
$getcontent.="</table>";
//print_r($getvaluearr);
echo $getcontent;*/


?>
</body></html>