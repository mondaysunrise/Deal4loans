<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

function getthecorrectvalue()
{
$checkkforanswer=$_REQUEST['select'];
		$getj=$_REQUEST['varj'];

		$getk=$_REQUEST['vark'];


$anscrossword="select * from Req_Crossword where CrosswordID='2'";
list($rowscount,$row_result)=MainselectfuncNew($anscrossword,$array = array());
$cntr=0;
		
		
$rows=$row_result[$cntr]['Crossword_Rows'];
$cols=$row_result[$cntr]['Crossword_Cols'];
$Crossword_Name=$row_result[$cntr]['Crossword_Name'];
$CrosswordID=$row_result[$cntr]['CrosswordID'];

$getanscrossword="select * from Crossword_Details where CrosswordID='".$CrosswordID."'";
	//echo $getanscrossword;
list($rowscount,$row)=MainselectfuncNew($getanscrossword,$array = array());
$i=0;

while($i<count($row))
	{
		$Crossword_Solution=$row[$i]['Crossword_Solution']; 
$i = $i +1;
	}

$Crossword_Solution = substr($Crossword_Solution, 0, strlen($Crossword_Solution)-1);
//echo $Crossword_Solution;

//this is for solution
$newarray=explode(',',$Crossword_Solution);
for ($k=0;$k<$rows;$k++) {
	for ($j=0;$j<$cols;$j++) {
		$FinalPosition = ($k*$cols)+($j);
		$getnew[$k][]=$newarray[$FinalPosition];
}

}

$checkanswer=$getj."_".$getk;
$r="";
$p="";
// print_r($getnew);

for ($r=0;$r<$rows;$r++) {
		$getcontent.="<tr>";
	for ($p=0;$p<$cols;$p++) {
	$variable=$p."_".$r;
	

if((($getnew[$r][$p])==$checkkforanswer) && ($r==$getk) && ($p==$getj))
		{
$val=$getnew[$r][$p];
		}
		else
		{

		}


		
	}
}

		if(($val==$checkkforanswer))
		{
		
			 echo "correct";
			}
			else
			{
				echo "wrong";
				//exit();
			}

}


getthecorrectvalue();

?>
