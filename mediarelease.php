<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Deal4Loans Media Coverage Press release</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta name="keywords" content="hassle free loans, loans india, best loan providers, loans interest rate, low interest loan, compare loans, online loan information"/>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#373737;
}
.red {
	color: #F00;
}
 -->
</style>
<link href="/mediarelease_styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/images/jquery-1.10.2.min.js"></script>    
<script type="text/javascript" src="/images/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="/images/jquery.wt-lightbox.js"></script>
<script type="text/javascript" src="/images/jquery.thumb-scroller.js"></script>
<style type="text/css">
.container{width:930px;min-width:260px;	-webkit-box-shadow:0 10px 6px -6px rgba(0,0,0,0.4);	-moz-box-shadow:0 10px 6px -6px rgba(0,0,0,0.4); box-shadow:0 10px 6px -6px rgba(0,0,0,0.4);}
</style>
<script type="text/javascript">
$(window).load(	
	function() {
		//initialize scroller
		$("#myScroller").thumbScroller({
			responsive:true,
			orientation:'horizontal',
			numDisplay:4,
			slideWidth:200,
			slideHeight:250,
			slideMargin:5,
			slideBorder:2,
			padding:7,
			autoPlay:true,
			delay:4000,
			speed:1000,
			easing:'swing',
			control:'index',
			navButtons:'hover',
			playButton:true,
			captionEffect:'slide',
			captionAlign:'bottom',
			captionPosition:'inside',
			captionButton:false,
			captionHeight:'auto',
			continuous:true,
			shuffle:false,
			mousewheel:true,
			imagePosition:'fill',
			pauseOnHover:false,
			pauseOnInteraction:true,
			title:''
		});				
		//initialize lightbox on scroller's links
		$("#myScroller a[data-lightbox-group='gallery1']").wtLightBox({
			responsive:true,
			autoPlay:false,
			delay:5000,
			speed:600,
			easing:'swing',
			navButtons:'mouseover',
			playButton:true,
			numberInfo:true,
			timer:true,
			captionPosition:'inside',
			captionButton:false,
			continuous:true,
			mousewheel:true,
			keyboard:true,
			swipe:true
	 });
});
</script>
<style type="text/css">
.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80)}
.white_content {
	display: none;
	position: absolute;
	top:15%;
	left:10%;
	width: 80%;
	height: 90%;
	padding: 16px;
	border:2px solid orange;
	background-color: white;
	z-index:1002;
	overflow: auto;
}
.close_window_btn{float:right; width:35px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#F00;}
.close_window_btn a{ float:right; width:35px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#F00;}


</style>
<link href="/source.css" rel="stylesheet" type="text/css" />
<link href="/personal-loan-banks-styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:1000px; max-width:100%; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span  class="text12" style="color:#4c4c4c;">Media Release</span></div>
<div style="clear:both;"></div>
<div class="wrapper_press_release">Media Coverage<br />
<div style="font-size:19px;">Latest NewsPaper Coverages of Deal4loans.com</div>
</div>

<?php    
	$page_size=6;
	$self = $_SERVER['PHP_SELF'];
	$start_row=0;
	//Set the page no
	if(empty($_GET['page_no']))
	{
		if($startrow == 0)
		{
			$page_no = $start_row + 1;
		}
	}
	else
	{
		$page_no = $_GET['page_no'];
		$start_row = ($page_no - 1) * $page_size;
	}
	
	//Set the counter start
	if($page_no/$page_size == 0)
	{
		$counter_start = $page_no - ($page_size - 1);
	}
	else
	{
		$counter_start = $page_no - ($page_no % $page_size) + 1;
	}
	//Counter End
	$counter_end = $counter_start + ($page_size - 1);
?>
      <?php
	  $sql_media_release_np = "select * from media_release_np  where ( publication_title!='') order by publication_date DESC, priority asc";
		list($record_count,$result_media_release_np)=MainselectfuncNew($sql_media_release_np,$array = array());
		?>
    
    <div class="wrapper_press_release2">
	<div class="wrapper_press_release2_inn">
	<?php
    //Set Maximum Page start
    $max_page = $record_count % $page_size;
    if($record_count % $page_size == 0)
    {
        $max_page = $record_count / $page_size;
    }
    else
    {
        $max_page = ceil($record_count / $page_size);
    }
    
    $sql_np = "select * from media_release_np  where (publication_title!='') order by priority asc, publication_date DESC LIMIT $start_row, $page_size";
 	list($numrows,$result_np)=MainselectfuncNew($sql_np,$array = array());
	if($record_count>0)
	{
	
		
	  for($i=0;$i<$numrows;$i++)
	  {
		  $mediaid = $result_np[$i]['id'];
	  	$publication_title = $result_np[$i]['publication_title'];	
		$publication_title_image = $result_np[$i]['publication_title_image'];	
	  	$publication_image = $result_np[$i]['publication_image'];	
		$publication_name = $result_np[$i]['publication_name'];
		$publication_city = $result_np[$i]['publication_city'];
		$publication_date = $result_np[$i]['publication_date'];
		$strDate = explode("-",$publication_date);
	?>

  <div class="left_white_box margin">
    <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <th colspan="2" scope="row" style="height:20px;"></th>
      </tr>
      <tr>
        <th colspan="2" align="center" class="font_size" scope="row" height="5"></th>
      </tr>
      <tr>
        <th colspan="2" align="center" class="font_size" scope="row"><? if($publication_title=="image") { ?> <img src="/coverageimages/thumbs/<? echo $publication_title_image; ?>" border="0" /><? } else { echo $publication_title;}?></th>
      </tr>
      <tr>
        <th colspan="2" scope="row" height="5"></th>
      </tr>
      <tr>
        <th class="font_publish" scope="row"></th>
        <th align="left" class="font_publish" scope="row">&nbsp;</th>
      </tr>
	   <tr>
        <th width="11%" height="51" class="font_publish" scope="row"></th>
        <th width="89%" align="left" class="font_publish" scope="row" ><span><?  echo $publication_name; ?></span><br />
          <?  echo $publication_city; ?><br />
          <?  echo $strDate[2]."-".$strDate[1]."-".$strDate[0]; ?> 
		  <? if($mediaid==58)
		  { ?>
		  <span style="color:#F00;">		   
		  <a href = "http://yourstory.com/2014/06/deals4loans/" style="color:#F00;" target="_blank">read more..</a></span>
		  <? }
		  else
		  { ?>
		  <span style="color:#F00;">		   
		  <a href="javascript:void(0)" onclick="document.getElementById('light6_<? echo $i; ?>').style.display='block';document.getElementById('fade').style.display='block'" style="color:#F00;">read more..</a></span>
		  <? } ?>  
      <tr>
        <th colspan="2" scope="row">&nbsp;</th>
      </tr>
      <tr>
        <th colspan="2" scope="row">&nbsp;</th>
      </tr>
      <tr>
        <th colspan="2" scope="row">&nbsp;</th>
      </tr>
    </table>
  </div>
	<?php if($i==2){ ?>
    <div class="clear-fix"></div>
    <?php 
		  }
    }
    ?>
    </div>

    <div class="clear-fix"></div>
</div> 
  <? for($j=0;$j<$numrows;$j++)
	  {  $showpublication_image = $result_np[$j]['publication_image'];
		$mediaid = $result_np[$j]['id'];
		if($mediaid==79)
		  {
		?>
<div id="light6_<?php echo $j; ?>" class="white_content"><div class="close_window_btn"><a href="javascript:void(0)" onclick="document.getElementById('light6_<?php echo $j; ?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div> <div style="text-align:center;"><img src="/coverageimages/<? echo $showpublication_image;?>"  /><br><img src="/coverageimages/continued-page-EstateWorld-Aug-2015-National1.jpg"  /></div></div>
  <?
		  }
		else
		  { ?>
<div id="light6_<?php echo $j; ?>" class="white_content"><div class="close_window_btn"><a href="javascript:void(0)" onclick="document.getElementById('light6_<?php echo $j; ?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div> <div style="text-align:center;"><img src="/coverageimages/<? echo $showpublication_image;?>"  /></div></div>
		  <? }
  } ?>
   <div id="fade2" class="black_overlay"></div>
 <div id="fade2" class="black_overlay"></div>
  <? }
	?>  
  <div class="numbring_box">
  
  <table width="100%"  border="0" cellpadding="5" cellspacing="1">
                  <? 
	if($numrows>0)
	{
	?>
                  <tr>
                    <td scope="row" ><div class="numbering_text">
                    <ul>

                      <? 
		$z=1;
		for($z=1;$z<=$max_page;$z++)
		{	
			if( $page_no==$z)
			{
				
				echo "<li><span class=\"PageActive\">".$z."</span></li>";
			}
			else
			{

			?>
                      <li><a href='<?php echo "http://www.deal4loans.com/mediarelease/page_no/".$z; ?>'><?php echo $z; ?></a></li>		
                        <?
			}
		
		} 
		?>		</ul></div></td>
     </tr>
                  <? 
   } 
   ?>
              </table>
              
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> <td scope="row" ><div class="numbering_text">
<ul>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">6</a></li>
</ul>
</div></td>
  </tr>
</table>-->
</div>
<!--media coverage online----------------------------------------->
 <?php
//Paging
	$pagesize=3;
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
    $sql = "select * from media_release_online where (publication_block=1) order by publication_date DESC";
	//$sql = "SELECT * FROM `media_release` WHERE publication_url != ''";
	list($recordcount,$result1)=MainselectfuncNew($sql,$array = array());
	
	 ?>
	<!----------------------------------------------------------------->
	<div class="online_coverage">
	<div class="pink_text"><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records</div>
	<?php

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
		
 $sql1 = "select * from media_release_online  where (publication_block=1) order by publication_date DESC LIMIT $startrow, $pagesize";
		list($num_rows,$result)=MainselectfuncNew($sql1,$array = array());
	if($recordcount>0)
	{
	
	
	  for($i=0;$i<$num_rows;$i++)
	  {
	  	$publication_heading = $result[$i]['publication_heading'];
		$publication_name = $result[$i]['publication_name'];
		$publication_city = $result[$i]['publication_city'];
		$publication_date = $result[$i]['publication_date'];
		$publication_url = $result[$i]['publication_url'];
		$publication_content = $result[$i]['publication_content'];
				
		$strDate = explode("-",$publication_date);
	?>

<div class="online_coverage-box online_coverage-text">
  <div style="font-size:16px;"><? echo $publication_name; ?> </div><br />
<? echo $strDate[2]."-".$strDate[1]."-".$strDate[0]; ?><br />
<br />
<strong><? echo $publication_heading; ?></strong><br />
<br />
<? echo $publication_content; ?>..<span style="color:#ff026d;"><a href="<? echo $publication_url;?>" target="_blank" style="color:#ff026d;">read more..</a></span></div>

<? } } ?>
</div>

<table width="100%"  border="0" cellpadding="5" cellspacing="1">
                  <? 
	if($recordcount>0)
	{
	?>
                  <tr>
                   <td scope="row" ><div class="numbering_text"><ul>
                      <? 
		$c=1;
		for($c=1;$c<=$maxpage;$c++)
		{	
			if( $pageno==$c)
			{
				
				echo "<li><span class=\"PageActive\">".$c."&nbsp;</span></li>";
			}
			else
			{
			?>
                      <li><a href='<?php echo "http://www.deal4loans.com/mediarelease/pageno/".$c; ?>'><?php echo $c; ?></a></li>
                      <?
			}
		
		} 
		?>		</ul>
</div></td>
     </tr>
                  <? 
   } 
   ?>
</table>
      
<!-- lightbox  start-->
<div id="light1" class="white_content">This is the lightbox contentss. prabhat
<div class="close_window_btn"><a href = "javascript:void(0)" onclick = "document.getElementById('light1').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div></div>
<div id="fade" class="black_overlay"></div>
<div id="light2" class="white_content">This is the lightbox contentss. <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
<div id="fade2" class="black_overlay"></div>
<div id="fade2" class="black_overlay"></div>
<!-- lightbox end-->
<?php include "footer_sub_menu.php"; ?>
</body>
</html>