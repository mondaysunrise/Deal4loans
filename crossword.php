<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
//Example of multi- dimensional array


?>
<html>
<head>

<script Language="JavaScript" Type="text/javascript">
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
//this function store customer details and gives eligible bidder list


//This function will store appointment details
		function getrightanswer(id,k)
		{
			//alert('heelo');
			var getselect="getvalue_" +id + "_" + k ;
			var getid=id;
			var getnextid=k;
		
			var new_select = document.getElementById(getselect).value;
			
		
			
			if((new_select!=""))
			{
				var queryString = "?select=" + new_select + "&varj=" + getid + "&vark=" + getnextid;
				//alert(queryString); 
				ajaxRequest.open("GET", "compareanswer.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						//alert(ajaxRequest.responseText);
						if(ajaxRequest.responseText=="correct")
						{
							 document.getElementById(getselect).style.color='#000000';
							//alert('correct');
						}
						else
							{
							document.getElementById(getselect).style.color='red';
							//alert('wrong');
							}
						
						//var ajaxDisplay = document.getElementById('getcontent');
					   //ajaxDisplay.innerHTML = ajaxRequest.responseText;
					  
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}


	window.onload = ajaxFunction;

</script>

</head>
<body>
<div align='center' >CROSSWORD</div>
<?php
function crossword()
{
$crossword="select * from Req_Crossword where CrosswordID='2'";
 list($recordcount,$row_result)=MainselectfuncNew($crossword,$array = array());
		$cntr=0;


//$crossword_result=ExecQuery($crossword);
//$row_result=mysql_fetch_array($crossword_result);
$rows=$row_result[$cntr]['Crossword_Rows'];
$cols=$row_result[$cntr]['Crossword_Cols'];
$Crossword_Name=$row_result[$cntr]['Crossword_Name'];
$CrosswordID=$row_result[$cntr]['CrosswordID'];

	$getthiscrossword="select * from Crossword_Details where CrosswordID='".$CrosswordID."'";
	
	 list($recordcount,$row)=MainselectfuncNew($getthiscrossword,$array = array());
		$i=0;
	//echo $getthiscrossword;
//	$getthiscrossword_details=ExecQuery($getthiscrossword);

while($i<count($row))
{
	$Crossword_Solution=$row[$i]['Crossword_Solution']; 
	$Crossword_Option=$row[$i]['Crossword_Option']; 
	$Crossword_Across=$row[$i]['Crossword_Across'];
	$Crossword_Down=$row[$i]['Crossword_Down'];
$i= $i +1;
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

$r="";
$p="";
$getcontent="<table border='1' cellpadding='0' cellspacing='2' align='center'>";
for ($r=0;$r<$rows;$r++) {
		$getcontent.="<tr>";
	for ($p=0;$p<$cols;$p++) {
	$variable=$p."_".$r;
	//echo $getvar."h".$getarray."<br>";

	if(strlen($getnew[$r][$p])>0)
		{
$getcontent.="<td align='right' style='border:1px solid #0000ff;'><sup style='font-size:7px;' valign='top'>".$getnewseries[$r][$p]."</sup>&nbsp;<input type='text' size='1' style='border:1px solid #FFFFFF;' onChange='getrightanswer($p,$r)'  name='getvalue_$variable' id='getvalue_$variable' maxlength='1' ></td>";
//value=".$getnew[$r][$p]."
		}
		else
		{
			$getcontent.="<td style='border:1px solid #FFFFFF;'>&nbsp;</td>";
		}
	
	//echo $getvalesewe[$k][$j];

}

   
}

$getcontent.="</tr>";


//}
$getcontent.="</table>";
$getcontent.="<table align='center'>";
$getcontent.="<tr><td>Across</td><td>Down</td></tr>";
$getcontent.="<tr><td>".$Crossword_Across."&nbsp;</td><td>&nbsp;".$Crossword_Down."</td></tr></table>";

return $getcontent;
//echo 
}


$get=crossword();
 echo $get;
?>
</body>
</html>



