<?php session_start(); ?>
<html>
<head>
<title>testPage</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php 
echo "Session Variables";
print_r ($_SESSION);
echo "<BR><BR>";
echo "Server Variables";


$_SERVER['Name']="Upendra";
$_SERVER['Org']="D4L";
print_r ($_SERVER);
//echo session.auto_start; ?>
<!-- <table width='100%' border='0' cellspacing='0' cellpadding='0'>  <tr>     <td><iframe src='http://www.deal4loans.com/Contents_Personal_Loan.php?flag=1' frameborder=0 height='1300' width='800' scrolling='no'></iframe></td>      </tr></table>
 --></body>
</html>
