<?php
$url = $_REQUEST['url'];


if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Name= $_REQUEST['Name'];
		$URL=$_REQUEST['Geturl'];
		$send_to =$_REQUEST['send_to'];
		$message= $_REQUEST['content'];

		$explodeUrl = explode("/" , $URL);
			$URLPostion = count($explodeUrl)-1;
			$MidURL = $explodeUrl[$URLPostion];
			$explodeMidUrl = explode("?" , $MidURL);
			$FinalURL = $explodeMidUrl[0];
			$SendEmail = $_REQUEST['SendEmail'];
		//echo $FinalURL."<br>";
$handle = @fopen($FinalURL, "r");


if ($handle) {
$content="";
    while (!feof($handle)) {
        $buffer = fgets($handle, 4096);
		$content[]=$buffer;
   }
	//print_r($content);

	$getcontent = implode(" ",$content);
	//$getcontent .= $getcontent;
	list($First,$Last) = split('<div id="This_is_for_email">', $getcontent);
//echo $Last;
list($main,$extra) = split('<div id="This_IS_To_Remove"></div>',$Last);
	?>
<style>
.txt_hdbold{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	font-size:12px;
	color:#0F74D4;
}

.tblpdng_txt{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#000000;
	padding:3px 0px 3px 10px;
}
.txt-hd{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	font-size:11px;
	color:#0F74D4;
	padding-left:10px;

}
</style>
<?
	$getmaincontent ="<table align='center' style='border:1px solid #0E74D9;'> <tr><td class='tblpdng_txt'>".$message."</td></tr><tr><td align='right'><img src='http://www.deal4loans.com/images/cclogo.gif'></td></tr><tr><td align='center'>";
	$getmaincontent .=$main;
	$getmaincontent .="</td><tr><table>";
//echo $getmaincontent;

		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		if(strlen($send_to)>0)
	{
		$headers .= "Cc: ".$send_to.""."\n";
	}
//mail($SendEmail,'Deal4loans Article', $getmaincontent, $headers);
    fclose($handle);
}
//exit();

//fclose($handle);
echo '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<table width="425" align="left"><tr><td  style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#8e4c07; line-height:18px;">
Dear '.$Name.'<br />
We have Emailed this Article on '.$send_to.'.<br />
Thanks for choosing Deal4loans.com
</td></tr></table>
</body>
</html>
';
	echo "<script>window.close()"."</script>";
	}
	else
	{
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deal4loans.com </title>

<style>
.hdng{
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:13px; 
	font-weight:bold; 
	color:#FFFFFF; 
	padding-left:15px;
}
.pp_text{
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px; 
	line-height:18px; 
	color:#1F0C03; 
	padding-left:5px;
}
.pp_text b{
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px; 
	line-height:18px; 
	color:#1F0C03; 
	padding-left:5px;
}
.pp_hdng{
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:13px; 
	line-height:10px;
	font-weight:bold; 
	color:#C45A17;
	padding-top:8px; 
}

</style>
<table  width="400" border="0" align="left" cellpadding="0"  cellspacing="3"  >  
  <tr>
        <td height="28" bgcolor="#6B7173" class="hdng" >Email An Article</td>
  </tr>
  <tr>
    <td>
	
	<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ; ?>" >

	<table  width="90%" border="0" align="center" cellpadding="0"  cellspacing="3">
        
<tr>
<td width="157" height="26" align="left" class="pp_text"><b>Your Name</b></td>
    <td width="189" class="pp_text"><input type="hidden" value="<?php echo $url; ?>" name="Geturl">
<input type='text' name='Name' ></td>
</tr>
<tr>
    <td height="26" class="pp_text" ><b>Your Email</b></td>
    <td class="pp_text"><input type='text' name='SendEmail' ></td>
</tr>
<tr>
    <td class="pp_text"><b>Receiver E-mail Id</b></td>
    <td class="pp_text"><textarea rows='2' cols='22' name='send_to'></textarea><br>(Fill in comma separated email ids)</td>
</tr>

<!--<tr>
    <td colspan="2" class="pp_text"><b>You are going to email the following:</b><br>
    <?php //echo $url; ?></td>
</tr>-->
<tr>
    <td class="pp_text"><b >Write Message</b></td>
    <td class="pp_text"><textarea rows='2' cols='22' name='content'></textarea></td>
</tr>
<tr>
<td colspan="2" align="center" height="30"><input type='submit' value='submit' class='bluebutton'></td>
</tr>
</table>
</form>
</td>
  </tr>
</table>

<?php
}
?>
