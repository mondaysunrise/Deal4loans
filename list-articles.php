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
.style1
{
	font-family: Arial,Helvetica,sans-serif;
	font-size: 12px;
	color: #0033cc;
	line-height:18px;
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
<!-- <form action="http://ndtvmoney.deal4loans.com/index.php" method="post" > -->
<?
//FOR Credit Card Articles
$getlistofCCarticles=("select post_title,guid from wp_posts LEFT OUTER JOIN wp_term_relationships ON wp_term_relationships.object_id=wp_posts.ID  where (post_status='publish' and wp_term_relationships.term_taxonomy_id=12 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
 list($CCrecordcount,$getrow)=MainselectfuncNew($getlistofCCarticles,$array = array());

//$CCrecordcount = mysql_num_rows($getlistofCCarticles);
if($CCrecordcount>0)
		{
			$cntr=0;

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
	<!-- <input type="text" name="p_c" id="p_c" value="<?php echo $final_p; ?>" />
	<img src="images/bullet_arrow.gif"> <input type="submit" name="submit" id="submit" class="sbtn" value="<?php echo $post_title; ?>"  /> -->
 <img src="images/bullet_arrow.gif"> <a class="style1" onclick="popup('<? echo $new_url; ?>')" style="cursor:pointer; color:#0000CC;"><? echo $post_title; ?></a><br>
<?  $cntr=$cntr+1;}
		}?>
<?
//FOR Personal Loan Articles
$getlistofPLarticles=("select post_title,guid from wp_posts LEFT OUTER JOIN wp_term_relationships ON wp_term_relationships.object_id=wp_posts.ID  where (wp_posts.post_status='publish' and wp_term_relationships.term_taxonomy_id=3 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
 list($PLrecordcount,$getPlrow)=MainselectfuncNew($getlistofPLarticles,$array = array());
$p=0;

//$PLrecordcount = mysql_num_rows($getlistofPLarticles);
if($PLrecordcount>0)
		{
		while($p<count($getPlrow))
        {
		$PLpost_title = $getPlrow[$p]['post_title'];
		$PLpost_title = ucfirst(strtolower($PLpost_title));
		$PLurl = $getPlrow[$p]['guid'];
		$PLj=$PL+1;
		$exp_url = explode("?",$PLurl);
		$new_val = $exp_url[1];
		$exp_new_val =  explode("=",$new_val);
		$final_p = $exp_new_val[1];
		$new_url = "http://ndtvmoney.deal4loans.com?".$new_val;
	?>
	<!-- <input type="text" name="p_p" id="p_p" value="<?php echo $final_p; ?>" />
	<img src="images/bullet_arrow.gif"> <input type="submit" name="submit" id="submit" class="sbtn" value="<?php echo $PLpost_title; ?>"  /> -->
 <img src="images/bullet_arrow.gif"> <a class="style1" onclick="popup('<? echo $new_url; ?>')" style="cursor:pointer; color:#0000CC;"><? echo $PLpost_title; ?></a> <br>
<?  $p = $p+1;}
		}?>
		<?
//FOR Home Loan Articles
$getlistofHLarticles=("select post_title,guid from wp_posts LEFT OUTER JOIN wp_term_relationships ON wp_term_relationships.object_id=wp_posts.ID  where (wp_posts.post_status='publish' and wp_term_relationships.term_taxonomy_id=4 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
//$HLrecordcount = mysql_num_rows($getlistofHLarticles);
 list($HLrecordcount,$getHlrow)=MainselectfuncNew($getlistofHLarticles,$array = array());
$h=0;
if($HLrecordcount>0)
		{
		while($h<count($getHlrow))
        {
		$HLpost_title = $getHlrow[$h]['post_title'];
		$HLpost_title = ucfirst(strtolower($HLpost_title));
		$HLurl = $getHlrow[$h]['guid'];
		$HLj=$HL+1;
		$exp_url = explode("?",$HLurl);
		$new_val = $exp_url[1];
		$exp_new_val =  explode("=",$new_val);
		$final_p = $exp_new_val[1];
		$new_url = "http://ndtvmoney.deal4loans.com?".$new_val;
	?>
	<!-- <input type="text" name="p_h" id="p_h" value="<?php echo $final_p; ?>" />
	<img src="images/bullet_arrow.gif"> <input type="submit" name="submit" id="submit" class="sbtn" value="<?php echo $HLpost_title; ?>"  /> -->
 <img src="images/bullet_arrow.gif"> <a class="style1" onclick="popup('<? echo $new_url; ?>')" style="cursor:pointer; color:#0000CC;"><? echo $HLpost_title; ?></a> <br>
<? $h = $h +1;}
		}?>

	<?
//FOR LAP Articles
$getlistofLAParticles=("select post_title,guid from wp_posts LEFT OUTER JOIN wp_term_relationships ON wp_term_relationships.object_id=wp_posts.ID  where (wp_posts.post_status='publish' and wp_term_relationships.term_taxonomy_id=6 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
$LAPrecordcount = mysql_num_rows($getlistofLAParticles);
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
	<!-- <input type="text" name="p_la" id="p_la" value="<?php echo $final_p; ?>" />
	<img src="images/bullet_arrow.gif"> <input type="submit" name="submit" id="submit" class="sbtn" value="<?php echo $LAPpost_title; ?>"  /> -->
 <img src="images/bullet_arrow.gif"> <a class="style1" onclick="popup('<? echo $new_url; ?>')" style="cursor:pointer; color:#0000CC;"><? echo $LAPpost_title; ?></a> <br>
<? $l = $l +1;}
		}?>

<?
//FOR Bank Info Articles
$getlistofBIarticles=("select post_title,guid from wp_posts LEFT OUTER JOIN wp_term_relationships ON wp_term_relationships.object_id=wp_posts.ID  where (wp_posts.post_status='publish' and wp_term_relationships.term_taxonomy_id=8 ) order by  post_modified_gmt DESC");
//echo "select post_title,guid where (post_status='publish') order by  post_modified_gmt DESC ";
 list($BIrecordcount,$getBIrow)=MainselectfuncNew($getlistofBIarticles,$array = array());
$b=0;

//$BIrecordcount = mysql_num_rows($getlistofBIarticles);
if($BIrecordcount>0)
		{
		while($b<count($getBIrow))
        {
		$BIpost_title = $getBIrow[$b]['post_title'];
		 $BIpost_title = ucfirst(strtolower($BIpost_title));
		$BIurl = $getBIrow[$b]['guid'];
		$BIj=$BI+1;
		$exp_url = explode("?",$BIurl);
		$new_val = $exp_url[1];
		$exp_new_val =  explode("=",$new_val);
		$final_p = $exp_new_val[1];
		$new_url = "http://ndtvmoney.deal4loans.com?".$new_val;
	?>
	<!-- <input type="text" name="p_b" id="p_b" value="<?php echo $final_p; ?>" />
	<img src="images/bullet_arrow.gif"> <input type="submit" name="submit" id="submit" class="sbtn" value="<?php echo $BIpost_title; ?>"  /> -->
<img src="images/bullet_arrow.gif"> <a class="style1" onclick="popup('<? echo $new_url; ?>')" style="cursor:pointer; color:#0000CC;"><? echo $BIpost_title; ?></a><br>
<? $b = $b+1; }
		}?>
		<!-- </form> -->
</body>
</html>
