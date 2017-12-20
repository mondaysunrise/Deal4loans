<?php
//session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$rows=$_REQUEST['getrows'];
	$cols=$_REQUEST['getcols'];

	
}
$spancols=$cols-1;
//echo $spancols;
?>
<html>
<head>
</head>
<body>
<div align="center"> Crossword Details
</div>
<form name="createcrossword" method="post" action="getcrosswordvalues.php">

<table border="0" style="border:1px solid #000000" align="center" cellpadding="0" cellspacing="2">

<tr><td colspan="2" align="center">Define crossword words here</td></tr>
<tr><td colspan="2" align="center">
<?
//$max=count($multidem);
$k="";
$j="";
$getcontent="<table border='0' cellpadding='0' cellspacing='0'>";
for ($k=0;$k<$rows;$k++) {
		$getcontent.="<tr>";
	for ($j=0;$j<$cols;$j++) {
	$variable=$j."_".$k;

$getcontent.="<td ><input type='text' size='1'  name='getexactvalue_$variable' id='getexactvalue_$variable' maxlength='1'></td>";
   
}

$getcontent.="</tr>";

}
$getcontent.="</table>";
echo $getcontent;
?>
</td></tr>
<tr><td width="30%">crossword name</td><td ><input type="text" name="getname" id="getname"></td></tr>

<tr><td>Clues Across</td><td><textarea rows='5' cols='30' name="clues_across" id="clues_across"></textarea></td></tr>
<tr><td>Clues Down</td><td><textarea rows='5' cols='30' name="clues_down" id="clues_down"></textarea></td></tr>
<tr><td colspan="2"><input type="hidden" name="getrows" id="getrows" value="<? echo $rows; ?>"><input type="hidden" name="getcols" id="getcols" value="<? echo $cols;?>"></td></tr>
<tr><td colspan="2" align="center"> <input type="submit" name="submit" value="submit"></td></tr>
</table>
</body>
</html>