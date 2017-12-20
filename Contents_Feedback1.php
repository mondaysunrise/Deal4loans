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
		    $Dated = ExactServerdate();
		
//$sql = "INSERT INTO Testimonial( TestID, Name, Email, Subject, Message, Dated)
	//VALUES ( '', '$Name', '$Email', '$subject', '$content', Now() )";
	//$result = ExecQuery($sql);
	$dataInsert = array("TestID"=>'', "Name"=>$Name, "Email"=>$Email, "Subject"=>$subject, "Message"=>$content, "Dated"=>$Dated);
	$table = 'Testimonial';
	$insert = Maininsertfunc ($table, $dataInsert);
	
	
	//echo "pp".$sql;
	echo "<script language=javascript>alert('Thanks for posting a message');"." location.href='Contents_Feedback.php'"."</script>";
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
	///
	
	?>
	<?php
 $sql = "Select Name,Subject,Message,Dated From Testimonial where Is_Verified=1  order by Dated desc";
//$result = ExecQuery($sql);
//$recordcount = mysql_num_rows($result);
list($recordcount,$getrow)=MainselectfuncNew($sql,$array = array());
		$cntr=0;


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
 	
	list($TitleNumRows,$Arrrow)=MainselectfuncNew($sqlTitle,$array = array());
		$i=0;
	//$resultTitle = ExecQuery($sqlTitle);
	 //$TitleNumRows = mysql_num_rows($resultTitle);
	$Subject_title = "";
	while($i<count($Arrrow))
        {
		$SubjectTitle =  $Arrrow[$i]['Subject'];
		$Subject_title[] = $SubjectTitle;
	$i = $i +1;
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
<title>Deal4loans | <?php echo $PutTitles; ?></title>
<meta name="keywords" content="Home Loans Testimonials, Personal Loans Testimonials, Credit cards Testimonials, Loan against property Testimonials, Business Loans Testimonials, Car loan Testimonials, <?php echo $Keywords; ?>">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og="/>
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="/scripts/contentpage.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="/scripts/lightbox.css" media="screen,projection" type="text/css" />
<!-- JavaScript -->
<script type="text/javascript" src="/scripts/prototype.js"></script>
<script type="text/javascript" src="/scripts/lightbox-iframe.js"></script>

</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">  
<span  ><a href="index.php">Home</a> > Testimonials</span>
  <h1 >Testimonials</h1>
 
   <form name="testi_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chktesti();">	
  <table width="100%"  border="0" cellspacing="0" cellpadding="0" >
   <tr><td valign="middle" height="22" bgcolor="#494949"   class="tblwt_txt">MESSAGE BOARD</td>

		</tr>
    <tr>
  <td align="left" ><!---New edition--><table width="100%"  >
                  <tr><td><a onClick="insRow()" onMouseOver="this.style.color='blue'" style="cursor:pointer;"><img src="images/discuss_icon.gif"><u>Post a message</u></a></td></tr>
                  <tr><td><table width="100%"  id="myTable"><tr><td></td></tr></table></td>          </tr>
                </table></td>
      </tr>
			         
          
         <?php 									
$sql = "Select Name,Subject,Message,Dated From Testimonial where Is_Verified=1  order by Dated desc LIMIT $startrow, $pagesize";
 
	
	 list($recordcount,$row)=MainselectfuncNew($sql,$array = array());
		$j=0;
	
	//$result = ExecQuery($sql);
	
	if($recordcount>0)
	{
	while($j<count($row))
        {
	
	
	?>
          <tr>
            <? $postid = $row[$j]["PostID"];?>
          <td  align="left" valign="top"  style="background-color:#f7f7f7; padding-left:10px; padding-top:5px;" ><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="38" height="20" align="left" valign="bottom"><img src="new-images/hand1.jpg" /></td><td align="left" valign="top"><b><? echo $row[$j]["Subject"]; ?></b></td></tr></table></td></tr>
          <tr>
          <td   align="left" style="background-color:#f7f7f7; padding-left:10px; padding-top:5px; text-transform:lowercase;"> By <? echo $row[$j]["Name"]; ?> on  <? echo date("F j, Y, g:i a",strtotime($row[$j]["Dated"])); ?></td></tr>
          <tr>    
          <td  align="left"  style="background-color:#f7f7f7; padding-left:10px; padding-top:5px; padding-bottom:8px; text-transform:lowercase;" ><? echo $row[$j]["Message"]; ?></td></tr>
          
         <?php
	   $j = $j +1;}
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
				
				echo $c."&nbsp;";
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

  </table></td>
      </tr>
    </table>
  </form>  	<div align="right"><a href="#pg_up" style="text-decoration:none;" >Top<img src="new-images/top.gif" width="12" height="18" alt="Top" border="0"/></a></div>
</div></div>
    
	
 <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right-new1.php';
  }
  ?>
      <?php 
 if ((($_REQUEST['flag'])!=1))
	{ 

include '~Bottom-new.php'; 
}
?>
</div>
</body>
</html>
