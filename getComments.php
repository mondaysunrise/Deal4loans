<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_REQUEST);
$pagesize=5;

function get_categories($parent = 0)
{
    $html = '<ul class="comment">';
 // echo "SELECT * FROM `comments_pages` WHERE `parent` = '$parent' and Page_Name='".$_SERVER['SCRIPT_NAME']."' and Status=1";
    $query = "SELECT * FROM `comments_pages` WHERE `parent` = '$parent' and Page_Name='".$_SERVER['SCRIPT_NAME']."' and Status=1";
	list($NumRows,$row)=MainselectfuncNew($query,$array = array());

    for($j=0;$j<$NumRows;$j++)
    {
        $current_id = $row[$j]['Rid'];
		$dt = $row[$j]['Dated'];
		$dt_arr = explode(" ", $dt);
		$dt_day = explode('-',$dt_arr[0]);
		$dt_time = explode(':',$dt_arr[1]);
		$dt_mktime = mktime($dt_time[0], $dt_time[1], $dt_time[2], $dt_day[1] , $dt_day[2], $dt_day[0]);
		$finalDisplayDate = date("F j, Y g:i a", $dt_mktime);  

        $html .= '<li><table><tr><td><span class="comment_text_c"><b>' . $row[$j]['Name'].'</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="comment_text_d">  '.$finalDisplayDate.'</span></td></tr>';
		$html .= '<tr><td class="comment_text_a">' . $row[$j]['Comment'].'</td></tr>';
		$html .= '<tr><td class="reply_text" ><a onClick="insRow('.$current_id.');" style="cursor:pointer;">Post Reply</a></td></tr>';
				$html .= '<tr><td id="myTable'.$current_id.'" ></td></tr></table>';
        $has_sub = NULL;
        $has_sub_sql = "SELECT COUNT(`parent`) FROM `comments_pages` WHERE `parent` = '$current_id'";
		list($has_sub,$has_sub_row)=MainselectfuncNew($has_sub_sql,$array = array());
		if($has_sub)
        {
            $html .= get_categories($current_id);
        }
        $html .= '</li>';
    }
       $html .= '</ul>';
    return $html;
}

?>
<style>
.comment_form{ width:650; float:left; background:#b6d7fe; border: #89BFE7 solid thin; padding:10px; }
.comment_text_a{font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;}
.comment_text_b{font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; }
.comment_text_c{font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333333; font-weight:bold;}
.comment_text_d{font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; }
.comment ul,li{ list-style:none; width:800px;}
.reply_text{font-family:Arial, Helvetica, sans-serif; font-size:12px; color: #32A0D6; font-weight:bold; }
</style>

<div id="displayResult">
<?php
$_SERVER['SCRIPT_NAME'] = $_REQUEST['SCRIPTNAME'];
$pg = $_REQUEST['pg'];

$query = "SELECT * FROM `comments_pages` WHERE `parent` = '0' and Page_Name='".$_SERVER['SCRIPT_NAME']."' and Status=1 order by Rid desc limit ".$pg.",".$pagesize." ";
list($commentCount,$queryCount)=MainselectfuncNew($query,$array = array());
for($cC=0;$cC<$commentCount;$cC++)
{
echo '<ul class="comment">';
	$current_id = $queryCount[$cC]['Rid'];
	$dt =  $queryCount[$cC]['Dated'];
	$dt_arr = explode(" ", $dt);
	$dt_day = explode('-',$dt_arr[0]);
	$dt_time = explode(':',$dt_arr[1]);
	$dt_mktime = mktime($dt_time[0], $dt_time[1], $dt_time[2], $dt_day[1] , $dt_day[2], $dt_day[0]);
	$finalDisplayDate = date("F j, Y g:i a", $dt_mktime);  
	$Name= $queryCount[$cC]['Name'];
	$Comment= $queryCount[$cC]['Comment'];
	echo '<li><table><tr><td><span class="comment_text_c"><b>' .$Name.'</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="comment_text_d">  '.$finalDisplayDate.'</span></td></tr>';
	echo '<tr><td class="comment_text_a">' .$Comment.'</td></tr>';
	echo '<tr><td class="reply_text" ><a onClick="insRow('.$current_id.');" style="cursor:pointer;">Post Reply</a></td></tr>';
	echo '<tr><td id="myTable'.$current_id.'" ></td></tr></table>';
	print get_categories($current_id);
    echo '</li>';
echo '</ul>';
}

?>
</div>