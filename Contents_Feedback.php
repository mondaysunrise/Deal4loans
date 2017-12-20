<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;

	$Name = FixString($Name);
	$Email = FixString($Email);
	$content = FixString($content);
	$subject = FixString($subject);	

if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$_SESSION['captcha_msg'] = "<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.
		//echo '<script>window.history.go(-1);</script>';
	}

else
	{
	
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Subject'=>$subject, 'Message'=>$content, 'Dated'=>$Dated);
		$insert = Maininsertfunc ('Testimonial', $dataInsert);

	//echo "pp".$sql;
	echo "<script language=javascript>alert('Thanks for posting a message');"." location.href='Contents_Feedback.php'"."</script>";
		}
}
//Paging
$pagesize=20;
$self = $_SERVER['PHP_SELF'];
$startrow=0;

//Set the page no

if(empty($_GET['pageno']))
{
	if($startrow == 0)
	{
		$pageno = $startrow + 1;
	}
}
else
{
	$pageno = $_GET['pageno'];
	$startrow = ($pageno - 1) * $pagesize;
}

//Set the counter start
if($pageno/$pagesize == 0)
{
	$counterstart = $pageno - ($pagesize - 1);
}
else
{
	$counterstart = $pageno - ($pageno % $pagesize) + 1;
}
//Counter End
$counterend = $counterstart + ($pagesize - 1);
	
$sql = "Select Name,Subject,Message,Dated From Testimonial where Is_Verified=1  order by Dated desc";
list($recordcount,$result)=MainselectfuncNew($sql,$array = array());

//Set Maximum Page start
$maxpage = $recordcount % $pagesize;
if($recordcount % $pagesize == 0)
{
	$maxpage = $recordcount / $pagesize;
}
else
{
	$maxpage = ceil($recordcount / $pagesize);
}
$sqlTitle = "Select * From Testimonial Where 1=1 and Is_Verified=1 order by Dated desc LIMIT $startrow, $pagesize ";

list($TitleNumRows,$resultTitle)=MainselectfuncNew($sqlTitle,$array = array());
$Subject_title = "";
for($tm=0;$tm<$TitleNumRows;$tm++)
{
	$SubjectTitle = $resultTitle[$tm]['Subject'];
	$Subject_title[] = $SubjectTitle;
}
//print_r($Subject_title);
if(count($Subject_title)>4)
{
	$Titles = "";
	for($t=0;$t<4;$t++)
	{
		$Title = $Subject_title[$t];
		$Titles[] = $Title;
	}
	//print_r($Titles);
	$PutTitles = implode(" | ",$Titles);
}
else
{
	$PutTitles = implode(" | ",$Subject_title);
}
$Keywords = implode(",",$Subject_title);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
<link href="/css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />  
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Deal4loans | <?php echo $PutTitles; ?></title>
<meta name="keywords" content="Home Loans Testimonials, Personal Loans Testimonials, Credit cards Testimonials, Loan against property Testimonials, Business Loans Testimonials, Car loan Testimonials, <?php echo $Keywords; ?>" />
<link href="/source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/scripts/contentpage.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<Script Language="JavaScript">
function chktesti(theFrm){
				if(!checkData(theFrm.Name, 'Your Name', 5))
				return false;
				if(theFrm.Email.value=="")
					{
						alert("Please enter  Email Address");
						theFrm.Email.focus();
						return false;
					}
				var str=theFrm.Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
					return false;
					}
					if(theFrm.content.value=="")
					{
						alert("Please enter the Content !");
						theFrm.content.focus();
					return false;
					}
			return true;
    }
    </Script>
	
<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<style type="text/css">
.bluelink a { padding:0px 5px; border:1px solid; border-color:#0f8eda; color:#000; }
.bluelink span { padding:0px 5px; background:#0f8eda; color:#FFF; border: 1px solid;  border-color:#333;}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="lac-main-wrapper">
<!--<link href="http://www.deal4loans.com/captcha/css/style.css" rel="stylesheet">-->
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#4c4c4c;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > Testimonials</div>
<div style="clear:both; height:15px;"></div>
<div>
<table><tr><td width="72%" align="center">
<h1 class="text3" style="height:33; margin-left:20px; margin-top:0px;font-size:28px; text-transform:none; color:#000"><strong>Testimonials</strong></h1></td><td width="28%"></td>
   </tr></table>
 <div class="text11" style="margin-left:20px; margin-top:10px; border: 1px solid;  border-color: #CCC;">
 <form name="testi_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onsubmit="return chktesti(this);">	
    <table width="100%"  border="0" cellspacing="0" cellpadding="0" >
        <tr>
        	<td valign="middle" height="32" bgcolor="#BEDAF5"><strong>MESSAGE BOARD</strong></td>
        </tr>
        <tr>
            <td align="left">
               <table bgcolor='#DAEAF9' style='border:1px dotted #9C9A9C;' width='100%'>
            	<tr>
                	<td width="20%">Name</td>
                  <td width="80%"><input type='text' name='Name' class="emi_input" /></td>
                  <!--<td><a  onclick='deleteRow(this)' style='cursor:pointer;'>close</a></td>-->
                </tr>
                <tr>
                	<td width="20%">Email id</td>
                  <td width="80%"><input type='text' name='Email' class="emi_input" /></td>
                </tr>
                <tr>
                	<td width="20%">Subject</td>
                  <td><input type='text' name='subject' class="emi_input" /></td>
                </tr>
                <tr>
                	<td width="20%">Write Message</td>
                  <td><textarea rows='5' cols='50' name='content' class="textfield"></textarea></td>
                </tr>
				 
			  <?php if(isset($_SESSION['captcha_msg'])){?>
      <tr>
        <td colspan="2" align="center" valign="top" style="font-size:14px;"><?php echo $_SESSION['captcha_msg']; ?></td>
      </tr>
      <?php } unset($_SESSION['captcha_msg']); ?>
      <tr>
        <td width="20%" height="50" class="frmtxt"> Validation code:</td>
        <td ><img src="http://www.deal4loans.com/captcha/captcha1.php?rand=<?php echo rand();?>" id='captchaimg' /></td>
      </tr>
	  <tr>	  
	  <td colspan="2">
	  <table width="100%" border="0">	  
      <tr>
        <td width="22%" class="frmtxt"><label for='message'>Enter the above code here: </label></td>
        <td width="78%"><input id="captcha_code" name="captcha_code" type="text" /></td>
      </tr>
      <tr>
        <td colspan="2" class="frmtxt">Can't read the image? <a href='javascript: refreshCaptcha();'>click here</a> to refresh.</td>
      </tr>    	
    </table>
</td>	  </tr>
                <tr>
                	<td colspan='2' align='center'><input type='submit' value='submit' class='btnclr' /></td>
                </tr>
            </table>
            </td>
        </tr>
		<?php 									
		$sql = "Select Name,Subject,Message,Dated From Testimonial where Is_Verified=1  order by Dated desc LIMIT $startrow, $pagesize";
		//$result = ExecQuery($sql);
		list($recordcount1,$row)=MainselectfuncNew($sql,$array = array());
		if($recordcount>0)
		{
			for($j=0;$j<$recordcount1;$j++)
			{
		?>
        <tr>
        <? $postid = $row[$j]["PostID"];?>
            <td  align="left" valign="top"  style="background-color:#f7f7f7; padding-left:10px; padding-top:5px;">
            <table width="95%" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                	<td width="38" height="20" align="left" valign="bottom"><img src="/new-images/hand1.jpg" /></td>
                    <td align="left" valign="top"><b><? echo $row[$j]["Subject"]; ?></b></td>
                </tr>
            </table>
            </td>
        </tr>
        <tr>
            <td   align="left" style="background-color:#f7f7f7; padding-left:10px; padding-top:5px; text-transform:lowercase;"> By <? echo $row[$j]["Name"]; ?> on  <? echo date("F j, Y, g:i a",strtotime($row[$j]["Dated"])); ?></td></tr>
        <tr>    
            <td  align="left"  style="background-color:#f7f7f7; padding-left:10px; padding-top:5px; padding-bottom:8px; text-transform:lowercase;" ><? echo $row[$j]["Message"]; ?></td>
        </tr>
        <?php
		   }
		}
		?>
	 </table>
 <table width="100%"  border="0" cellpadding="5" cellspacing="1">
	<? 
	if($recordcount>0)
	{
	?>
   <tr>
     <td align="center" class="bluelink">
	 <? 
		$c=1;
		for($c=1;$c<=$maxpage;$c++)
		{	
			if( $pageno==$c)
			{
				
				echo "<span>".$c."</span>";
			}
			else
			{
			?>
				
				<a href='<?php echo "http://www.deal4loans.com/Contents_Feedback/pageno/".$c; ?>'><?php echo $c; ?></a>
			<?
			}
		
		} 
		?>		</td>
   </tr>
   <? 
   } 
   ?>
 </table>
  </form> 
  <div style=" float:right;  height:auto; margin-top:3px; text-align:right;"><span class="text11" style="color:#4c4c4c; size:18px;"><img src="/images/arrow.gif"  /> <a href="#"  style="color:#0f8eda;">Back to Top</a></span>
</div>
</div></div></div>
<?php include("footer_sub_menu.php"); ?>

<script language="javascript" type="text/javascript">
$(function() {
$( window ).load(function() {
 $.post("captchatest.php",
  {  },
  function(data,status){
 	 $('#place4Captcha').html(data);
	  	 $('#reference_captcha').val(data);
	 });
});
});

$(function() {
$("#clickhr").click(function(){
 $.post("captchatest.php",
  {  },
  function(data,status){
 	 $('#place4Captcha').html(data);
	  	 $('#reference_captcha').val(data);
  });
});
});
</script>
</body>
</html>