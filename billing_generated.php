<?php
$MinDate =$_GET['Min_Date'];
$MaxDate =$_GET['Max_Date'];
$expMinDate = explode(" ", $MinDate);
$expMaxDate = explode(" ", $MaxDate);
$finalMinValue = $expMinDate[0];
$finalMaxValue = $expMaxDate[0];
?>
<html>
<head>
<title>Bill Generated</title>
<SCRIPT language=JavaScript>
<!--
function win(){
window.opener.location.href="billing_index.php?min_date=<?php echo $finalMinValue; ?>&max_date=<?php echo $finalMaxValue; ?>&search=y";
self.close();
//-->
}
</SCRIPT>


</head>


<body bgcolor="#ffffff" >
<table align="center"><tr><td align="center">
<?php $dupcheck =$_GET['dupcheck']; 
if($dupcheck=='Dup')
{
echo "<font face='Verdana' size='4' ><strong>Bill Already Generated.</strong></font>";
}
else
{
	echo "<font face='Verdana' size='4' ><strong>Thank You for Generating Bill.</strong></font>";
}
?>
</td></tr>
<tr><td align="center">&nbsp;</td></tr>
<tr><td align="center"><center><input type=button onClick="win();" value="Close this window"></center></td></tr>


</table>




</body>
</html>