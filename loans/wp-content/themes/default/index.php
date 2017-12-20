<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
  
//get_header(); ?>

<? get_header(); ?>

	
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
<!--<div style=" margin-left:10px; float:left; width:640px; margin-top:20px; border:solid 2px #000000; "> -->
<div class="left_boxtablecms">
 <?php
if((strlen(strpos($_SERVER['SCRIPT_NAME'], "index.php")) > 0))
{
?>
    <!-- -->
<?php
function db_connect_wp(){
	$dbuser	= "root"; 
	$dbserver= "localhost"; 
	$dbpass	= "";
	$dbname	= "deal4loans_primary"; 
	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
	if($conn && mysql_select_db($dbname))
	    	return $conn;
	return (FALSE);
   }
   function ExecQuery_wp($sql){
	db_connect_wp();
	return (mysql_query($sql));
   }
   
$remove = array("|","'");
$appendPL = "http://www.deal4loans.com/loans/personal-loan/";
$appendHL = "http://www.deal4loans.com/loans/home-loan/";
$appendCL = "http://www.deal4loans.com/loans/car-loan/";
$appendCC = "http://www.deal4loans.com/loans/credit-card/";
$appendLAP = "http://www.deal4loans.com/loans/loan-against-property/";
$appendArt = "http://www.deal4loans.com/loans/articles/";
$mkTimeEarlier = mktime(0, 0, 0, date("m")  , date("d")-3, date("Y"));
?>

<style>
.tblwt_txt {
    color: #000;
    font-family: 'Droid Sans',sans-serif;
    font-size: 18px;
   /*font-weight: bold;*/
    padding: 2px;
}
.tbl_txt {
    color: #373737;
    font-family: 'Droid Sans',sans-serif;
    font-size: 16px;
    padding: 2px;
}
#txt a {
    color: #3671d5;
    font-family: 'Droid Sans',sans-serif;
    font-size: 16px;
    line-height: 15px;
    text-decoration: none;
}
#txt   a {
      text-decoration: none;
  }
 #txt  a:link {
     color: #1C50B0;
  }
#txt   a:visited {
      color: #1C50B0;
  }
#txt   a:active {
      color: #666666;
  }
#txt   a:hover {
      color: #1C50B0;
  }

/*..................................new styles added on 23-9-2014 Satarts ...........*/
.left_boxtablecms{float:left; width:600px; margin-top:10px;}
.left_boxtablecms_right{float:left; width:275px; margin-left:45px;}

@media screen and (max-width: 768px) {

.left_boxtablecms{width:100%; float:none!important; margin-top:10px;}
.left_boxtablecms_right{width:275px; margin: auto; clear:both;}

}  
/*...................................new styles added on 23-9-2014 Satarts ...........*/

</style>
<div class="left_boxtablecms">
<div id="txt">
<table cellpadding="0" cellspacing="2" border="0" width="100%">
<tr>
<td align="center" valign="top" style="padding-bottom:3px;">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#E8F0F6">
        <td width="104" height="30"  align="left"  class="tblwt_txt" style="padding-left:3px;" ><b>Latest Posts</b></td>
      </tr>

<?php
$sql_1 = "select object_id from wp_term_relationships where 1=1 group by object_id order by object_id DESC limit 0,7";
$query_1 = ExecQuery_wp($sql_1);
$numRows_1 = mysql_num_rows($query_1);
for($i=0;$i<$numRows_1;$i++)
{
	$post_date= '';
	$post_date2='';
	$displayImg = '';
	$object_id = mysql_result($query_1,$i,'object_id');
	$getValSql = "SELECT post_title,post_name,post_date FROM wp_posts where ID='".$object_id."'";
	$getValQuery = ExecQuery_wp($getValSql);
	$getValNums = mysql_num_rows($getValQuery);
	$post_name = mysql_result($getValQuery,0,'post_name');
	$post_title = mysql_result($getValQuery,0,'post_title');
	$post_date = mysql_result($getValQuery,0,'post_date');
	$post_date1 = explode(" ", $post_date);
	$post_date2 = explode("-", $post_date1[0]);
	
	//2012-03-05
	$mkTimetoday = mktime(0, 0, 0, $post_date2[1] , $post_date2[2], $post_date2[0]);
	$diff = abs($mkTimetoday - $mkTimeEarlier);

	if(259200>=$diff)
	{
	//	$displayImg = ' <img src="http://www.deal4loans.com/new-images/New.gif" border="0">';
	}
	$output  = str_replace($remove, "", $post_title);
	$output  = str_replace(" ", "-", $output);
	$output  = str_replace("--", "-", $output);
	if(strlen($post_title)>0)
	{
		echo '<tr bgcolor="#EFEEEE"><td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">';
		echo "<a href='".$appendArt.$post_name."'>".$post_title."</a>";
		echo '&nbsp;'.$displayImg.'</td><tr>';
	}
}
?>
</table>


</td>

</tr>
<tr>
<td align="center" valign="top" style="padding-bottom:3px;">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#E8F0F6">
        <td width="104" height="30"  align="left"  class="tblwt_txt" style="padding-left:3px;" ><b>Latest Personal Loan Articles</b></td>
       
      </tr>
<?php
 $sql_1 = "select object_id from wp_term_relationships where term_taxonomy_id=3 order by object_id DESC limit 0,5";
$query_1 = ExecQuery_wp($sql_1);
 $numRows_1 = mysql_num_rows($query_1);
for($i=0;$i<$numRows_1;$i++)
{
	$post_date= '';
	$displayImg = '';
	$object_id = mysql_result($query_1,$i,'object_id');
	 $getValSql = "SELECT post_title,post_name,post_date FROM wp_posts where ID='".$object_id."'";
	$getValQuery = ExecQuery_wp($getValSql);
	$post_name = mysql_result($getValQuery,0,'post_name');
	$post_title = mysql_result($getValQuery,0,'post_title');
	$post_date = mysql_result($getValQuery,0,'post_date');
	$post_date1 = explode(" ", $post_date);
	$post_date2 = explode("-", $post_date1[0]);
	$mkTimetoday = mktime(0, 0, 0, $post_date2[1] , $post_date2[2], $post_date2[0]);
	$diff = abs($mkTimetoday - $mkTimeEarlier);

	if(259200>=$diff)
	{
	//	$displayImg = ' <img src="http://www.deal4loans.com/new-images/New.gif" border="0">';
	}
	$output  = str_replace($remove, "", $post_title);
	$output  = str_replace(" ", "-", $output);
	$output  = str_replace("--", "-", $output);
		echo  '<tr bgcolor="#EFEEEE"><td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">';
	echo "<a href='".$appendPL.$post_name."'>".$post_title."</a>";
echo '&nbsp;'.$displayImg.'</td><tr>';
}

?>
</table>
</td></tr><tr>
<td align="center" valign="top" style="padding-bottom:3px;">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#E8F0F6">
        <td width="104" height="30"  align="left"  class="tblwt_txt" style="padding-left:3px;" ><b>Latest Home Loan Articles</b></td>
       
      </tr>
<?php
 $sql_1 = "select object_id from wp_term_relationships where term_taxonomy_id=4 order by object_id DESC limit 0,5";
$query_1 = ExecQuery_wp($sql_1);
 $numRows_1 = mysql_num_rows($query_1);
for($i=0;$i<$numRows_1;$i++)
{
	$post_date= '';
	$displayImg = '';
	$object_id = mysql_result($query_1,$i,'object_id');
	 $getValSql = "SELECT post_title,post_name,post_date FROM wp_posts where ID='".$object_id."'";
	$getValQuery = ExecQuery_wp($getValSql);
	$post_name = mysql_result($getValQuery,0,'post_name');
	$post_title = mysql_result($getValQuery,0,'post_title');
	$post_date = mysql_result($getValQuery,0,'post_date');
	$post_date1 = explode(" ", $post_date);
	$post_date2 = explode("-", $post_date1[0]);
	
	$mkTimetoday = mktime(0, 0, 0, $post_date2[1] , $post_date2[2], $post_date2[0]);
	$diff = abs($mkTimetoday - $mkTimeEarlier);

	if(259200>=$diff)
	{
	//	$displayImg = ' <img src="http://www.deal4loans.com/new-images/New.gif" border="0">';
	}
	$output  = str_replace($remove, "", $post_title);
	$output  = str_replace(" ", "-", $output);
	$output  = str_replace("--", "-", $output);
	echo  '<tr bgcolor="#EFEEEE"><td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">';
	echo "<a href='".$appendHL.$post_name."'>".$post_title."</a>";
	echo '&nbsp;'.$displayImg.'</td><tr>';
}

?>
</table>
</td>
</tr>

<tr><td align="center" valign="top" style="padding-bottom:3px;">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#E8F0F6">
        <td width="104" height="30"  align="left"  class="tblwt_txt" style="padding-left:3px;" ><b>Latest Car Loan Articles</b></td>
       
      </tr>
<?php
 $sql_1 = "select object_id from wp_term_relationships where term_taxonomy_id=5 order by object_id DESC limit 0,5";
$query_1 = ExecQuery_wp($sql_1);
 $numRows_1 = mysql_num_rows($query_1);
for($i=0;$i<$numRows_1;$i++)
{
	$post_date= '';
	$displayImg = '';
	$object_id = mysql_result($query_1,$i,'object_id');
	 $getValSql = "SELECT post_title,post_name,post_date FROM wp_posts where ID='".$object_id."'";
	$getValQuery = ExecQuery_wp($getValSql);
	$post_name = mysql_result($getValQuery,0,'post_name');
	$post_title = mysql_result($getValQuery,0,'post_title');
	$post_date = mysql_result($getValQuery,0,'post_date');
	$post_date1 = explode(" ", $post_date);
	$post_date2 = explode("-", $post_date1[0]);
	$mkTimetoday = mktime(0, 0, 0, $post_date2[1] , $post_date2[2], $post_date2[0]);
	$diff = abs($mkTimetoday - $mkTimeEarlier);

	if(259200>=$diff)
	{
		//$displayImg = ' <img src="http://www.deal4loans.com/new-images/New.gif" border="0">';
	}
	$output  = str_replace($remove, "", $post_title);
	$output  = str_replace(" ", "-", $output);
	$output  = str_replace("--", "-", $output);
	echo  '<tr bgcolor="#EFEEEE"><td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">';
	echo "<a href='".$appendCL.$post_name."'>".$post_title."</a>";
	echo '&nbsp;'.$displayImg.'</td><tr>';
}

?>
</table></td>
</tr><tr>
<td align="center" valign="top" style="padding-bottom:3px;">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#E8F0F6">
        <td  height="30"  align="left"  class="tblwt_txt" style="padding-left:3px;" ><b>Latest Credit Card Articles</b></td>
       
      </tr>
<?php
$sql_1 = "select object_id from wp_term_relationships where term_taxonomy_id=12 order by object_id DESC limit 0,5";
$query_1 = ExecQuery_wp($sql_1);
 $numRows_1 = mysql_num_rows($query_1);
for($i=0;$i<$numRows_1;$i++)
{
	$post_date= '';
	$displayImg = '';
	$object_id = mysql_result($query_1,$i,'object_id');
	 $getValSql = "SELECT post_title,post_name,post_date FROM wp_posts where ID='".$object_id."'";
	$getValQuery = ExecQuery_wp($getValSql);
	$post_name = mysql_result($getValQuery,0,'post_name');
	$post_title = mysql_result($getValQuery,0,'post_title');
	$post_date = mysql_result($getValQuery,0,'post_date');
	$post_date1 = explode(" ", $post_date);
	$post_date2 = explode("-", $post_date1[0]);
	$mkTimetoday = mktime(0, 0, 0, $post_date2[1] , $post_date2[2], $post_date2[0]);
	$diff = abs($mkTimetoday - $mkTimeEarlier);

	if(259200>=$diff)
	{
		//$displayImg = ' <img src="http://www.deal4loans.com/new-images/New.gif" border="0">';
	}
	$post_title = strtolower($post_title);
	
	$output  = str_replace($remove, "", $post_title);
	$output  = str_replace(" ", "-", $output);
	$output  = str_replace("--", "-", $output);
	echo  '<tr bgcolor="#EFEEEE"><td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">';
	echo "<a href='".$appendCC.$post_name."'>".$post_title."</a>";
echo '&nbsp;'.$displayImg.'</td><tr>';
	

}

?>
</table></td>
</tr>

<tr>
<td align="center" valign="top" style="padding-bottom:3px;">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#E8F0F6">
        <td  height="30"  align="left"  class="tblwt_txt" style="padding-left:3px;" ><b>Latest Loan Against Property Articles</b></td>
      </tr>
<?php
 $sql_1 = "select object_id from wp_term_relationships where term_taxonomy_id=6 order by object_id DESC limit 0,5";
$query_1 = ExecQuery_wp($sql_1);
 $numRows_1 = mysql_num_rows($query_1);
for($i=0;$i<$numRows_1;$i++)
{
	$post_date= '';
	$displayImg = '';
	$object_id = mysql_result($query_1,$i,'object_id');
	 $getValSql = "SELECT post_title,post_name,post_date FROM wp_posts where ID='".$object_id."'";
	$getValQuery = ExecQuery_wp($getValSql);
	$post_name = mysql_result($getValQuery,0,'post_name');
	$post_title = mysql_result($getValQuery,0,'post_title');
	$post_date = mysql_result($getValQuery,0,'post_date');
	$post_date1 = explode(" ", $post_date);
	$post_date2 = explode("-", $post_date1[0]);
	$mkTimetoday = mktime(0, 0, 0, $post_date2[1] , $post_date2[2], $post_date2[0]);
	$diff = abs($mkTimetoday - $mkTimeEarlier);

	if(259200>=$diff)
	{
		//$displayImg = ' <img src="http://www.deal4loans.com/new-images/New.gif" border="0">';
	}
	$output  = str_replace($remove, "", $post_title);
	$output  = str_replace(" ", "-", $output);
	$output  = str_replace("--", "-", $output);
		echo  '<tr bgcolor="#EFEEEE"><td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">';
	echo "<a href='".$appendLAP.$post_name."'>".$post_title."</a>";
echo '&nbsp;'.$displayImg.'</td><tr>';
}

?>
</table>
</td></tr>
<tr>
<td align="center" valign="top" style="padding-bottom:3px;">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#E8F0F6">
        <td height="30"  align="left"  class="tblwt_txt" style="padding-left:3px;" ><b>Latest Articles</b></td>
      </tr>

<?php
 $sql_1 = "select object_id from wp_term_relationships where term_taxonomy_id=66 order by object_id DESC limit 0,5";
$query_1 = ExecQuery_wp($sql_1);
 $numRows_1 = mysql_num_rows($query_1);
for($i=0;$i<$numRows_1;$i++)
{
	$post_date= '';
	$post_date2='';
	$displayImg = '';
	$object_id = mysql_result($query_1,$i,'object_id');
	 $getValSql = "SELECT post_title,post_name,post_date FROM wp_posts where ID='".$object_id."'";
	$getValQuery = ExecQuery_wp($getValSql);
	$post_name = mysql_result($getValQuery,0,'post_name');
	$post_title = mysql_result($getValQuery,0,'post_title');
	$post_date = mysql_result($getValQuery,0,'post_date');
	$post_date1 = explode(" ", $post_date);
	$post_date2 = explode("-", $post_date1[0]);
	
	//2012-03-05
	$mkTimetoday = mktime(0, 0, 0, $post_date2[1] , $post_date2[2], $post_date2[0]);
	$diff = abs($mkTimetoday - $mkTimeEarlier);

	if(259200>=$diff)
	{
		//$displayImg = ' <img src="http://www.deal4loans.com/new-images/New.gif" border="0">';
	}
	$output  = str_replace($remove, "", $post_title);
	$output  = str_replace(" ", "-", $output);
	$output  = str_replace("--", "-", $output);
	echo '<tr bgcolor="#EFEEEE"><td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">';
	echo "<a href='".$appendArt.$post_name."'>".$post_title."</a>";
	echo '&nbsp;'.$displayImg.'</td><tr>';
}

?>
</table>
</td>
</tr>
</table>  
</div> 
<?php
}
else
{
	?>
  <div id="txt">
  <?php //if (function_exists('HAG_Breadcrumbs')) { HAG_Breadcrumbs(); } ?>
<!--<table width="776"><tr><td width="556" valign="top">-->
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>

				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>
		<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>
	<!--</td><td width="220"  valign="top"> <div ></div></td></tr></table>-->
</div> 
<?php
}
?>
<?php $postida=get_the_ID();?>
</div>
</div>
<div class="left_boxtablecms_right">
<?php
if ($view_form==1 || $d4l_section=="Wordpress CMS")
{ ?>
</div>
<? }
else
{
?>
<?php get_sidebar(); ?>
<? } ?>
</div>
</div>
<?php get_footer(); ?>
</body>
</html>


