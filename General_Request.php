<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$Name = FixString($Name);
		$Email = FixString($Email);
		$Comment = FixString($Comment);

		//SQL Query
		///$sql = "INSERT INTO general_request( Name, Email, Comment)
					//VALUES ( '$Name', '$Email', '$Comment')"; 

$dataInsert = array("Name"=>$Name , "Email"=>$Email , "Comment"=>$Comment);
		$table = 'general_request';
		$insert = Maininsertfunc ($table, $dataInsert);

		//$result = ExecQuery($sql);
		//echo mysql_error();

		if ($insert) 
			$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "index.php");
		else
			$Msg = "** There is a problem in adding your request. **";
	}	
?>

<Script Language="JavaScript">
   function chk()
{
	var txt="";
	txt="Please enter all * marked fields to continue...";
	if(this.document.frm.Name.value==""){txt=txt+"\n"+"Name";}
	if(this.document.frm.Email.value==""){txt=txt+"\n"+"E-Mail";}

	if(this.document.frm.Name.value=="" || 
	this.document.frm.Email.value=="")
	{
		alert(txt);
		return false;
	}
	else
	{
		return chkmail();
	}
}
	function chkmail()
{
	var str=this.document.frm.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	
	if(aa==-1)
	{
		alert("Please enter the valid Email Address");
		return false;
	}
	else if(bb==-1)
	{
		alert("Please enter the valid Email Address");
		return false;
	}
	else
	{
		return true;
	}
}
    </Script>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>General Request</title>

<script Language="JavaScript" Type="text/javascript" src="scripts/menu.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="center">
 <center>
 <?php include '~Top.php'; ?>
<table border="0" cellspacing="1" width="712" cellpadding="0">
   <tr>
     <td width="202" align="center" valign="top">
<?php if(isset($_SESSION['UserType']))
	{
	include '~Left.php';
	}
	else
	{
	include '~Login.php';
	}
?>     </td>
     <td width="*" valign="top" align=center>
	<p>&nbsp;</p>
	
 <form method="post" name="frm" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chk()">
 <table width="450" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td colspan="2" class="head1">General Request</td>
   </tr>
   <tr><td colspan="2" id="Alert">&nbsp; <?=$Msg?></td></tr>
   <tr>
                <td class="bodyarial11"><font color="#E71D59">*</font>Your Name</td>
     <td><input type="text" name="Name" size="30"></td>
   </tr>
   <tr>
                <td class="bodyarial11"><font color="#E71D59">*</font>Your Email Address</td>
     <td>
     <input type="text" name="Email" size="30"></td>
   </tr>
   <tr>
     <td valign="top" class="bodyarial11">Any Special Comments</td>
     <td><textarea rows="5" name="Comment" cols="50"> </textarea></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><br><input type="submit" class="bluebutton" value="Submit">
     <input type="reset" class="bluebutton" value="Reset"></td>
   </tr>
  </table>
 </form>
	<p>&nbsp;</p>
     </td>
   </tr>
 </table>
<?php include '~Bottom.php';?>    

 </center>
</div>
</body>

</html>