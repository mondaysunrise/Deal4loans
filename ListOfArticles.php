<?php
	require 'scripts/db_init.php';
	//require 'scripts/functions.php';
session_start();
if(!isset($_SESSION['siten']))
{
	$_SESSION['siten'] ="ndtv";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deal4loans</title>
<script><!--
function popup(id){
newwin = window.open(id,'');}
//--></script>
<style>
.blutxt 
{
	font-family: Arial,Helvetica,sans-serif;
	font-size: 12px;
	cursor:pointer;
	color:#0000CC;
	margin:0px;
	line-height:25px ;
	text-decoration:none;
}

.sbtn {
background-color:#FFFFFF;
color:#000099;
font-family:Arial, Helvetica, sans-serif;
font-size:12px;
font-weight:normal;
border:none;
cursor:pointer;

}

</style>
</head>

<body>
<table cellpadding="0" cellspacing="0" width="275"><tr><td >
<?
//FOR Credit Card Articles
$getlistofCCarticles=("select post_title,guid from nm_posts LEFT OUTER JOIN nm_term_relationships ON nm_term_relationships.object_id=nm_posts.ID  where (post_status='publish' and nm_term_relationships.term_taxonomy_id=12 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
//$CCrecordcount = mysql_num_rows($getlistofCCarticles);
 list($CCrecordcount,$getrow)=MainselectfuncNew($getlistofCCarticles,$array = array());
		$cntr=0;

if($CCrecordcount>0)
		{
		
while($cntr<count($getrow))
        {
		$post_title = $getrow[$cntr]['post_title'];
		$post_title = ucfirst(strtolower($post_title));
		$url = $getrow[$cntr]['guid'];
		$CCj=$CC+1;
		$exp_url = explode("?",$url);
		$new_val = $exp_url[1];
		$exp_new_val =  explode("=",$new_val);
		$final_p = $exp_new_val[1];
		$new_url = "http://ndtvmoney.deal4loans.com?".$new_val;
	?>
<div><img src="images/bullet_arrow.gif"> <a class="blutxt" href="<? echo $url; ?>" target="_parent"><? echo $post_title; ?></a></div>
<? $cntr=$cntr+1; }
		}?>
<?
//FOR Personal Loan Articles
$getlistofPLarticles=("select post_title,guid from nm_posts LEFT OUTER JOIN nm_term_relationships ON nm_term_relationships.object_id=nm_posts.ID  where (nm_posts.post_status='publish' and nm_term_relationships.term_taxonomy_id=3 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
//$PLrecordcount = mysql_num_rows($getlistofPLarticles);
 list($PLrecordcount,$getPLrow)=MainselectfuncNew($getlistofPLarticles,$array = array());
		$p=0;

if($PLrecordcount>0)
		{
		
while($p<count($getPLrow))
        {
		$PLpost_title = $getPLrow[$pl]['post_title'];
		$PLpost_title = ucfirst(strtolower($PLpost_title));
		 $PLurl = $getPLrow[$pl]['guid'];
		$PLj=$PL+1;
		$exp_url = explode("?",$PLurl);
		$new_val = $exp_url[1];
		$exp_new_val =  explode("=",$new_val);
		$final_p = $exp_new_val[1];
		$new_url = "http://ndtvmoney.deal4loans.com?".$new_val;
	?>
<div><img src="images/bullet_arrow.gif"> <a class="blutxt" href="<? echo $PLurl; ?>"  target="_parent"><? echo $PLpost_title; ?></a></div>
<? $p = $p +1; }
		}?>
		<?
//FOR Home Loan Articles
$getlistofHLarticles=("select post_title,guid from nm_posts LEFT OUTER JOIN nm_term_relationships ON nm_term_relationships.object_id=nm_posts.ID  where (nm_posts.post_status='publish' and nm_term_relationships.term_taxonomy_id=4 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
//$HLrecordcount = mysql_num_rows($getlistofHLarticles);
 list($HLrecordcount,$getHLrow)=MainselectfuncNew($getlistofHLarticles,$array = array());
		$h=0;

if($HLrecordcount>0)
		{
		while($h<count($getHLrow))
        {
		$HLpost_title = $getHLrow[$hl]['post_title'];
		$HLpost_title = ucfirst(strtolower($HLpost_title));
		$HLurl = $getHLrow[$hl]['guid'];
		$HLj=$HL+1;
		$exp_url = explode("?",$HLurl);
		$new_val = $exp_url[1];
		$exp_new_val =  explode("=",$new_val);
		$final_p = $exp_new_val[1];
		$new_url = "http://ndtvmoney.deal4loans.com?".$new_val;
	?>
<div><img src="images/bullet_arrow.gif"> <a class="blutxt" href="<? echo $HLurl; ?>" target="_parent"><? echo $HLpost_title; ?></a></div>
<? $h = $h +1;}
		}?>

	<?
//FOR LAP Articles
$getlistofLAParticles=("select post_title,guid from nm_posts LEFT OUTER JOIN nm_term_relationships ON nm_term_relationships.object_id=nm_posts.ID  where (nm_posts.post_status='publish' and nm_term_relationships.term_taxonomy_id=6 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
//$LAPrecordcount = mysql_num_rows($getlistofLAParticles);

list($LAPrecordcount,$getLAProw)=MainselectfuncNew($getlistofLAParticles,$array = array());
		$l=0;
if($LAPrecordcount>0)
		{
		while($l<count($getLAProw))
        {
		$LAPpost_title = $getLAProw[$l]['post_title'];
		$LAPpost_title = ucfirst(strtolower($LAPpost_title));
		$LAPurl = $getLAProw[$l]['guid'];
		$exp_url = explode("?",$LAPurl);
		$new_val = $exp_url[1];
		$exp_new_val =  explode("=",$new_val);
		$final_p = $exp_new_val[1];
		$new_url = "http://ndtvmoney.deal4loans.com?".$new_val;
		//$HLj=$HL+1;
	?>
<div><img src="images/bullet_arrow.gif"> <a class="blutxt" href="<? echo $LAPurl; ?>" target="_parent"><? echo $LAPpost_title; ?></a></div>
<? $l = $l + 1; }
		}?>

<?
//FOR Bank Info Articles
$getlistofBIarticles=("select post_title,guid from nm_posts LEFT OUTER JOIN nm_term_relationships ON nm_term_relationships.object_id=nm_posts.ID  where (nm_posts.post_status='publish' and nm_term_relationships.term_taxonomy_id=8 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
$BIrecordcount = mysql_num_rows($getlistofBIarticles);
list($BIrecordcount,$getBIProw)=MainselectfuncNew($getlistofBIarticles,$array = array());
		$b=0;

if($BIrecordcount>0)
		{
		while($b<count($getBIProw))
        {
		$BIpost_title = $getBIProw[$b]['post_title'];
		 $BIpost_title = ucfirst(strtolower($BIpost_title));
		$BIurl = $getBIProw[$b]['guid'];
		$BIj=$BI+1;
		$exp_url = explode("?",$BIurl);
		$new_val = $exp_url[1];
		$exp_new_val =  explode("=",$new_val);
		$final_p = $exp_new_val[1];
		$new_url = "http://ndtvmoney.deal4loans.com?".$new_val;
	?>

<div><img src="images/bullet_arrow.gif"> <a class="blutxt" href="<? echo $BIurl; ?>" target="_parent"><? echo $BIpost_title; ?></a></div>
<?  $b = $b +1;}
		}?>
</td></tr></table>
</body>
</html>