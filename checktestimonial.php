<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
	$post=$_REQUEST['id'];
//echo "ppp".$post;

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$validate = FixString($validate);
	$sql1 = "Update Testimonial set Is_Verified=$validate where TestID=$post";

	
	$result = ExecQuery($sql1);

	echo "<script>window.close()"."</script>";
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<STYLE>
a
{
	cursor:pointer;

}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}</style>

</head>
<body >
<p align="center"><b> Reply</b></p>

<?php $qry="select * from Testimonial where TestID=$post"; 

$result = ExecQuery($qry);
 $Name = mysql_result($result,$i,'Name');
  $Message = mysql_result($result,$i,'Message');
   $Subject = mysql_result($result,$i,'Subject');
      $Dated = mysql_result($result,$i,'Dated');
	     $Email = mysql_result($result,$i,'Email'); ?>
<table bgcolor='DAEAF9' style='border:1px dotted #9C9A9C;' height="250"  align="center">
<form name="testi_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>" ><tr>	<td ><b>Name</b>
	</td>
	<td ><? echo $Name;?></td>
	
</tr>
<tr>
	<td ><b>Email id</b></td>
	<td ><?echo $Email;?></td>
</tr>
<tr>
	<td ><b>Subject</b></td>
	<td ><?echo $Subject;?></td>
</tr>

<tr>
	<td><b>Message</b></td>
	<td><?echo $Message;?></textarea></td>
</tr>
<tr>
	<td><b>Date of entry</b></td>
	<td ><?echo $Dated;?></td>
</tr>
<tr>
	<td><b>Valid </b></td>
	<td ><input type="checkbox" name="validate" value="1"></td>
</tr>
<tr>
<td colspan='2' align='center'><input type='submit' value='submit' class='bluebutton'></td>
</tr>
</table>
</body>
</html>