<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
$_SERVER['SCRIPT_NAME'] = '/Contents_Calculators.php';

 $queryCount = ExecQuery("SELECT * FROM `comments_pages` WHERE `parent` = '0' and Page_Name='".$_SERVER['SCRIPT_NAME']."' and Status=1");
$commentCount = mysql_num_rows($queryCount);

	$pagesize=20;
	$startrow=0;
	$arrPage = '';
	for($cC=0;$cC<$commentCount;$cC=$cC+$pagesize)
	{
		$arrPage[]= '"getComments.php?pg='.$cC.'&SCRIPTNAME='.$_SERVER['SCRIPT_NAME'].'"';
		
	}
	$strPage = implode(",", $arrPage);

?>
<link rel="stylesheet" type="text/css" href="css/ajaxpagination.css" />
<script src="css/ajaxpagination.js" type="text/javascript"></script>
<table border="0" style="width:650px;" ><tr><td valign="top" style="padding-top:15px; padding-bottom:5px;">
<div id="paginate-top"> </div>
<div id="bookcontent"> </div>
<div id="paginate-bottom"> </div>
<script type="text/javascript">
var bookonflowers={
pages: [<?php	echo $strPage;?> ],
selectedpage: 0 
}
var mybookinstance=new ajaxpageclass.createBook(bookonflowers, "bookcontent", ["paginate-top", "paginate-bottom"])
</script>
</td></tr>
<tr><td id="putComment"><div class="comment_form"><form id="form0" name="form0" method="post" action="com_submit0.php"  onSubmit="return validateMe0(this);"><input type="hidden" readonly name="uri0" id="uri0" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>" ><input type="hidden" readonly name="current_id0" id="current_id0" value="0" ><table ><tr><td valign="top" colspan="2"><p class="comment_text_c" style="font-size:17px;">Add Comment</p></td></tr><tr><td valign="top"><p class="comment_text_b">Name</p></td><td><input type="text" name="name0" id="name0" style="width:300px;" /></td></tr><tr><td valign="top"><p class="comment_text_b">Email</p></td><td><input type="text" name="email0" id="email0" style="width:300px;" /></td></tr><tr><td valign="top"><p class="comment_text_b">Comment</p></td><td><textarea name="comments0" rows="5" style="width:500px;" ></textarea></td></tr><tr><td valign="middle"><p><span class="comment_text_b">Enter the code above</span></p></td><td align="left" ><table width="100%" border="0" cellspacing="0" cellpadding="0">  <tr>    <td width="23%" valign="bottom"><input type="text" name="captcha0" id="captcha0"></td><td width="77%" valign="bottom"><img src="/captcha.php" alt=""></td>  </tr></table></td></tr><tr><td colspan="2" align="right"><button type="submit"><img src="http://www.bimadeals.com/images/add-comment.png" border=0 ></button><div class="spacer"></div></td></tr></table></form></div></td></tr>
</table>


</body>

</html>