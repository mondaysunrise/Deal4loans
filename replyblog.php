<?php
require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	$post=$_REQUEST['id'];
	$reply_id =$_REQUEST['replyid'];
//echo "ppp".$post;

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$reply_validate = FixString($reply_validate);
	//$sql1 = "Update req_reply_message set Is_Verified=$reply_validate where Reply_ID=$reply_id";
	//echo $sql1;	
	//$result = ExecQuery($sql1);
	$DataArray = array("Is_Verified"=>$reply_validate);
		$wherecondition ="Reply_ID=".$reply_id;
		Mainupdatefunc ('req_reply_message', $DataArray, $wherecondition);

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

<?php $qry="select * from Req_Message where PostID=$post"; 
 list($recordcount,$getrow)=MainselectfuncNew($qry,$array = array());
		$cntr=0;

//$result = ExecQuery($qry);
 $Name = $getrow[$cntr]['Name'];
  $Message = $getrow[$cntr]['Message'];
   $Subject = $getrow[$cntr]['Subject'];
      $Dated = $getrow[$cntr]['Dated'];
	     $Email = $getrow[$cntr]['Email']; ?>
<table bgcolor='DAEAF9' style='border:1px dotted #9C9A9C;' height="250"  align="center">
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&replyid=<?php echo $reply_id; ?>" ><tr>	<td ><b>Name</b>
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
</table>
<?php $reply_qry="select * from req_reply_message where PostID=$post and Reply_ID=$reply_id "; 
//echo $reply_qry;
 list($recordcount,$Myrow)=MainselectfuncNew($reply_qry,$array = array());
		$i=0;

//$reply_result = ExecQuery($reply_qry);
 $reply_name = $Myrow[$i]['Name'];
  $reply_message = $Myrow[$i]['Message'];
   $reply_subject = $Myrow[$i]['Subject'];
      $reply_dated = $Myrow[$i]['Dated'];
	     $reply_email = $Myrow[$i]['Email']; ?>
 <table bgcolor='DAEAF9' style='border:1px dotted #9C9A9C;' height="250"  align="center">
 <tr>
 <td><b>Reply Name</b></td><td><?echo $reply_name;?></td></tr>
 <tr><td><b>Reply Subject</b></td><td><?echo $reply_subject;?></td></tr>
 <tr><td><b>Reply Message</b></td><td><?echo $reply_message;?></td></tr>
 <tr><td><b>Reply Date</b></td><td><?echo $reply_dated;?></td></tr>
 <tr>
	<td><b>Valid </b></td>
	<td ><input type="checkbox" name="reply_validate" value="1"></td>
</tr>

<tr>
<td colspan='2' align='center'><input type='submit' value='submit' class='bluebutton'></td>
</tr>
</table>
</body>
</html>