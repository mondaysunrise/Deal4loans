<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
//	print_r($_SERVER);
session_start();
//$post=$_REQUEST['PostID'];


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;

	$Name = FixString($Name);
	$Email = FixString($Email);
	$content = FixString($content);
	$subject = FixString($subject);
$Dated = ExactServerdate();
$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Subject'=>$subject, 'Message'=>$content,  'Dated'=>$Dated);
$insert = Maininsertfunc ("Req_Message", $dataInsert);
echo "<script language=javascript>alert('Thanks for posting a message.Our team would review it and if accepted will be uploaded at this page within 24 hours.');"." location.href='Contents_Blogs.php'"."</script>";
}

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
///

$sql = "Select * From Req_Message where 1=1 and Is_Verified=1 order by Dated desc";
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


$sqlTitle = "Select * From Req_Message Where 1=1 and Is_Verified=1 order by Dated desc LIMIT $startrow, $pagesize ";
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
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>For information on loans and hassle free loans contact - Deal4Loans</title>
<meta name="keywords" content="hassle free loans, loans india, best loan providers, loans interest rate, low interest loan, compare loans, online loan information">
<meta name="Description" content="Looking for hassle free loans at attractive interest rates and flexible repayment option; Deal4Loans provides you an online information services on flexible loan schemes available with best loan provider banks in India.">
<link href="/source.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<script Language="JavaScript" Type="text/javascript" src="/scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="/scripts/contentpage.js"></script>
<link href="/css/personal-loan-sbi-styles121.css" type="text/css" rel="stylesheet" />
<link href="/css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; max-width:970px; height:11px; margin-top:70px; color:#4c4c4c;"><u><a href="/index.php" class="text12" style="color:#0080d6;">Home</a></u> > Blogs</div>
<div style="clear:both; height:15px;"></div>
<div class="intrl_txt">

<table>
	<tr>
    	<td width="72%">
		<h1 class="text3" style="width:100%; max-width:200px; height:33; margin-top:0px;font-size:28px; text-transform:none;"><strong>Blogs</strong></h1>
        </td>
        <td width="28%">
        </td>
   </tr>
</table>

 <div class="text11" style="width:100%; max-width:950px; margin-left:10px;">
 
  <form name="testi_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chktesti();">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0" >
   <tr><td valign="middle" height="32" bgcolor="#BEDAF5"><strong>MESSAGE BOARD</strong></td>

		</tr>
    <tr>
  <td align="left" ><!---New edition--><table width="100%"  >
                  <tr><td><a onClick="insRow()" onMouseOver="this.style.color='blue'" style="cursor:pointer;"><img src="/images/discuss_icon.gif"><u>Post a message</u></a></td></tr>
                  <tr><td><table width="100%"  id="myTable"><tr><td></td></tr></table></td>          </tr>
                </table></td>
      </tr>
			         
          
          <?php

		
$sql = "Select * From Req_Message Where 1=1 and Is_Verified=1 order by Dated desc LIMIT $startrow, $pagesize ";
list($NumRows,$row)=MainselectfuncNew($sql,$array = array());
	if($recordcount>0)
	{
	 for($ii=0;$ii<$NumRows;$ii++)
	 {
		 
				$lngRow = $lngRow + 1;
				
				if ($lngRow % 2)
					$strBGColor = "#FFFFFF";
				else
					$strBGColor = "#EEEEEE";
	?>
          
          <tr>
            <? $postid = $row[$ii]["PostID"];?>
          <td  align="left" valign="top"  style="background-color:#f7f7f7; padding-left:10px; padding-top:5px;" >
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="38" height="20" align="left" valign="bottom"><img src="/new-images/hand1.jpg" /></td>
    <td align="left" valign="top"><b><? echo $row[$ii]["Subject"]; ?></b></td>
  </tr>
</table>
</td></tr>
          <tr>
          <td   align="left" style="background-color:#f7f7f7; padding-left:10px; padding-top:5px;"> By <? echo $row[$ii]["Name"]; ?> on  <? echo date("F j, Y, g:i a",strtotime($row[$ii]["Dated"])); ?></td></tr>
          <tr>    
          <td  align="left"  style="background-color:#f7f7f7; padding-left:10px; padding-top:5px; padding-bottom:8px;" ><? echo $row[$ii]["Message"]; ?></td></tr>
          
          <tr>
            <td style="background-color:#f7f7f7; padding-left:10px; padding-top:5px; padding-bottom:5px;">
              <!--  <a  href="http://www.deal4loans.com/postreply.php?PostID=<? echo $postid;?>" target="_blank" class="lbOn" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:bold;color:#FFFFFF;float:left;margin-left:10px;line-height:20px;color:#0f3ca4; text-decoration:underline;">Reply</a> -->
              
              <a  href="/postreply.php?PostID=<?echo $postid;?>" target="_blank"><b>Reply</b></a></td>
          </tr> 
         
          <?php $sql1 = "Select * From req_reply_message Where PostID='$postid' and Is_Verified=1 order by Dated desc ";
list($NumRows1,$row1)=MainselectfuncNew($sql1,$array = array());

	 for($jj=0;$jj<$NumRows1;$jj++)
	 {
	?>
          
          <tr>
            
          <td  height="21" align="left" style="background-color:#ececec; padding-left:10px; "><b>Reply<? echo $row1[$jj]["Subject"]; ?></b></td></tr>
          <tr>
          <td align="left"  style="background-color:#f7f7f7; padding-left:10px; padding-top:5px;">By <? echo $row1[$jj]["Name"]; ?> on  <? echo date("F j, Y, g:i a",strtotime($row1["Dated"])); ?></td></tr>
          <tr>    
          <td align="left"  style="background-color:#f7f7f7; padding-left:10px; padding-top:5px;"><? echo $row1[$jj]["Message"]; ?></td></tr>
          <?  }?>
          
          
          <?php
	   }
	}
?>
    </table>
								      
                                  
                                    
                            
                          
</span></td>
    </tr>
    <table width="100%"  border="0" cellpadding="5" cellspacing="1">
      <? 
	if($recordcount>0)
	{
	?>
      <tr>
        <td align="center" class="bluelink">
		<? //echo $pager->show(); ?>
          <? 

		$c=1;
		for($c=1;$c<=$maxpage;$c++)
		{	
			if( $pageno==$c)
			{
				
				echo $c."&nbsp;";
			}
			else
			{
			?>
          
          
          <a href='<?php echo "http://www.deal4loans.com/Contents_Blogs/pageno/".$c; ?>'><?php echo $c; ?></a>
        <?
			}
		
		} 
		?>		</td>
      </tr>
      <? 
   } 
   ?>
    </table>
          </table></td>
      </tr>
    </table>
  </form>
  </div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>