<?php
require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	$post=$_REQUEST['PostID'];
//echo "ppp".$post;
//echo "<br>";
//print_r($_POST);
//echo "<br>";
//print_r($_SESSION);
//echo "<br>";

if($_SESSION['Msg'] == "Thank You for Replying to Blog")
{
	echo '<p align="center"><strong>Thank You for Replying to Blog</strong></p>';
	echo "<script>window.close()"."</script>";
	$_SESSION['Msg'] ='';
}
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$Name = FixString($Name);
		$Email = FixString($Email);
		$content = FixString($content);
		$subject = FixString($subject);

	
	if(strlen($Name)>2 && (strrpos($Email, "@"))>0 && (strrpos($content, "<a href="))=== false)
	{
		if(($_SESSION['captcha']==$_POST['captcha0']) && ($post>0))
		{
			$IP = $_SERVER['REMOTE_ADDR'];
			$Dated = ExactServerdate();
			$dataInsert = array('PostID'=>$post,'IP_Address'=>$IP,'Name'=>$Name, 'Email'=>$Email, 'Dated'=>$Dated, 'Message'=>$content);
			$insert = Maininsertfunc ('req_reply_message', $dataInsert);
		}
	}
echo '<p align="center"><strong>Thank You for Replying to Blog</strong></p>';
		
	echo "<script>window.close()"."</script>";
	
	
	
	}
else
{	
?>
<html>
<head>
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
<script>
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function chkform()
{  
		if(document.loan_form.Name.value=="")
	{
			alert("please enter your Name!");
			document.loan_form.Name.focus();
				return false;
	}
		if(document.loan_form.Email.value=="")
	{
			alert("please enter your email id!");
			document.loan_form.Email.focus();
				return false;
	}
	if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}

	}
	/*if(document.loan_form.subject.value=="")
	{   
		alert("Please enter Subject");
		document.loan_form.subject.focus();
		return false;
	}*/
	if(document.loan_form.content.value=="")
	{
		alert("Please enter message");
		document.loan_form.content.focus();
		return false;
	}
	
	if(document.loan_form.captcha.value=="")
	{
		alert("please enter captcha!");
		document.loan_form.captcha.focus();
		return false;
	}	
	
}
</script>
</head>
<body>

<?php 
$SubjectSql = "select * from Req_Message where PostID='".$post."'";
list($recordcount,$SubjectQuery)=MainselectfuncNew($SubjectSql,$array = array());
$Subject = $SubjectQuery[0]['Subject'];

?>
<p align="center"><strong>Reply to Blog Topic <?php echo $Subject; ?></strong></p>

<form name="loan_form" method="post" action="postreplysubmit.php?PostID=<? echo $post;?>" onSubmit="return chkform();">

<table bgcolor='DAEAF9' style='border:1px dotted #9C9A9C;' height="250"  align="center" width="450">
<tr>	<td colspan="2">

</td>
	
</tr>
<tr>	<td ><b>Name</b>
	</td>
	<td ><input type='text' name='Name' maxlength="50"></td>
	
</tr>
<tr>
	<td ><b>Email id</b></td>
	<td ><input type='text' name='Email' maxlength="100"></td>
</tr>

<tr>
	<td><b>Write Message</b></td>
	<td><textarea rows='5' cols='60' name='content' maxlength="250"></textarea></td>
</tr>

<tr><td valign="top"><b>Enter the code </b></td>
<td  valign="top"><input type="text" name="captcha" id="captcha" maxlength="6"> <img src="/captcha.php" alt=""></td>
<tr>
<td colspan='2' align='center'><input type='submit' value='submit' class='bluebutton'></td>
</tr>
</table>
</form>
</body>
</html>
<?php
}
?>