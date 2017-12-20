<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$State = $_REQUEST['in'];

if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	$pageName = "loans-in/".$State;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}
$maxage=date('Y')-62;
$minage=date('Y')-18;
$State = $_REQUEST['in'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords(strtolower($State)); ?> : Get Best Interest Rates on Loans</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="keywords" content="Loans in <?php echo ucwords(strtolower($State)); ?>">
<link href="http://www.deal4loans.com/css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<meta name="Description" content="Get instant quotes on lowest interest rates on home /housing loan, personal loan, car loan & lap from top banks in <?php echo ucwords(strtolower($State)); ?>. Apply for credit cards with major banks in <?php echo ucwords(strtolower($State)); ?>" />
 <link href="/css/slider.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="/js/sprinkle.js"></script>
<script type="text/javascript" src="/js/easySlider1.5.js"></script>
<script type="text/javascript">
	$(document).ready(function(){	
		$("#slider").easySlider({
			controlsBefore:	'<p id="controls">',
			controlsAfter:	'</p>',
			auto: false, 
			continuous: true
			
		});
		$("#slider2").easySlider({
			controlsBefore:	'<p id="controls2">',
			controlsAfter:	'</p>',		
			prevId: 'prevBtn2',
			nextId: 'nextBtn2',
			auto: true, 
			continuous: true	
		});		
	});	
</script>

<style>

.tbl_txt {
    font-size: 14px;
    padding: 2px;
}
#txt a {
    font-size: 14px;
    line-height: 15px;
    text-decoration: none;
}
#txt  a {
   text-decoration: none;
  color: #039;
}
#txt a:link {
  color: #03F;
}
#txt a:visited {
  color: #039;
}
#txt a:active {
  color: #666666;
}
#txt a:hover {
  color: #FF9900;
}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="/index.php" class="text12" style="color:#0080d6;">Home</a></u> <span class="text12" style="color:#4c4c4c;">> Loans in India</span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<h1 class="text3" style="width:100%; margin:1px; float:left; clear:right; font-size:28px; text-transform:none;">Loans in India <?php echo ucwords(strtolower($State)); ?></h1>
<div style="clear:both; height:5px;"></div>
<div id="txt"><div class="overflow-width">
<table cellpadding="0" cellspacing="1" border="0" width="100%" >
<tr>
<td width="100%">
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
 <tr >
<?php
$getPageSql = "select * from city_pages where State='".$State."' and Status=1 group by Product order by Product DESC";

list($num_2,$query_2)=MainselectfuncNew($getPageSql,$array = array());
	for($k=0;$k<$num_2;$k++)
	{	
		$Product = $query_2[$k]['Product'];
		$Product_lower = strtolower($Product);
		$Product_Url = str_replace(" ", "-", $Product_lower);
		if($Product=="CC")
		{
			$ProductD = "Credit Card";
			$ProductU = "credit-cards";
		}
		else if($Product=="LAP")
		{
			$ProductD = "Loan Against Property";
			$ProductU = "property-loan";
		}
		else if($Product=="Education")
		{
			$ProductD = "Education Loan";
			$ProductU = "education-loan";
		}
		else if($Product=="Gold")
		{
			$ProductD = "Gold Loan";
			$ProductU = "gold-loan";
		}
		else if($Product=="2Wheeler")
		{
			$ProductD = "2 Wheeler Loan";
			$ProductU = "twowheeler-loan";
		}		
		else
		{
			$ProductD = $Product;
			$ProductU = $Product_Url;
		}
		?>
		<td valign='top' bgcolor="#FFFFFF" width="25%">
        <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
        <tr bgcolor="#E8F0F6">
        <td  height="30"  align="left"><b>
		<?php
		echo "".ucwords(strtolower($ProductD));
		?></b>
        </td>
        </tr>
        <?php
			$sql_1 = "select * from city_pages where Status=1 and Product='".$Product."' and State = '".$State."'";
			list($num_1,$query_1)=MainselectfuncNew($sql_1,$array = array());
			for($j=0;$j<$num_1;$j++)
			{
				$City = $query_1[$j]['City'];
				?>
                 <tr bgcolor="#EFEEEE">
                 <td height="25" align="left" bgcolor="#FFFFFF">
                <?php
			
				//echo "&nbsp;&nbsp;&nbsp;&nbsp;";
				$url = "http://www.deal4loans.com/".strtolower($ProductU)."/".$City;
				echo "<a href='".$url."'>".$ProductD." in ".ucwords(strtolower($City))."</a>";
				?>
                </td></tr>
				<?php
			}
			?>
			</table>
            </td>	            
            <?php
			if($k==3) { echo "</tr>"; }
			}	
		?>
	  </tr>
	</table>
    
	</td>
  </tr>
</table>
</div>
<div style="clear:both; height:15px;"></div>
<!--partners--><div class="loans_Silder">
<div class="text"><strong>Loan Partners</strong></div>
<div style="margin:auto; width:100%; height:56px; margin-top:7px; margin-bottom:13px;">	<script type="text/javascript">
var sliderwidth="924px"
var sliderheight="56px"
var slidespeed=2
slidebgcolor="#ffffff"
var leftrightslide=new Array()
var finalslide=''
leftrightslide[0]='<img src="/new-images/thumb/hdfc.jpg" alt="HDFC Bank" width="146" height="56" style="border:none;"/>';
leftrightslide[1]='<img src="/new-images/thumb/icici_index.jpg" width="146" height="56" style="border:none;" alt="ICICI Bank"/>';
leftrightslide[2]='<img src="/new-images/thumb/fullrton.jpg" alt="Fullerton" width="146" height="56"  style="border:none;"/>';
leftrightslide[3]='<img src="/new-images/thumb/bajaj-finserv1.jpg" alt="Bajaj Finserv" width="146" height="56"  style="border:none;"/>';
leftrightslide[4]='<img src="/new-images/thumb/stanchart.jpg" alt="Standard Chartered" width="146" height="56"  style="border:none;"/>';
leftrightslide[5]='<img src="/new-images/thumb/hdfc-logo.jpg" alt="HDFC Bank" width="146" height="56"  style="border:none;"/>';
leftrightslide[6]='<img src="/new-images/thumb/axis.jpg" width="146" height="56" style="border:none;" alt="Axis Bank"/>';
leftrightslide[7]='<img src="/new-images/thumb/magma.jpg" width="146" height="56" style="border:none;" alt="Magma Fincorp"/>';
leftrightslide[8]='<img src="/new-images/thumb/hdb-logo.jpg" alt="HDB Financial Services" width="146" height="56" style="border:none;"/>';
leftrightslide[9]='<img src="/new-images/thumb/fedbank-logonw.jpg" alt="Fedbank" width="146" height="56" style="border:none;"/>';
leftrightslide[10]='<img src="/new-images/thumb/pnbhfl-logomain.jpg" alt="PNB housing Finance Limited" width="168" height="56" style="border:none;"/>';
leftrightslide[11]='<img src="/new-images/thumb/kotak-pl.jpg" alt="kotak Bank" width="146" height="56" style="border:none;"/>';
var imagegap=" "
var slideshowgap=5
var copyspeed=slidespeed
leftrightslide='<nobr>'+leftrightslide.join(imagegap)+'</nobr>'
var iedom=document.all||document.getElementById
if (iedom)
document.write('<span id="temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+leftrightslide+'</span>')
var actualwidth=''
var cross_slide, ns_slide

function fillup(){
if (iedom){
cross_slide=document.getElementById? document.getElementById("test2") : document.all.test2
cross_slide2=document.getElementById? document.getElementById("test3") : document.all.test3
cross_slide.innerHTML=cross_slide2.innerHTML=leftrightslide
actualwidth=document.all? cross_slide.offsetWidth : document.getElementById("temp").offsetWidth
cross_slide2.style.left=actualwidth+slideshowgap+"px"
}
else if (document.layers){
ns_slide=document.ns_slidemenu.document.ns_slidemenu2
ns_slide2=document.ns_slidemenu.document.ns_slidemenu3
ns_slide.document.write(leftrightslide)
ns_slide.document.close()
actualwidth=ns_slide.document.width
ns_slide2.left=actualwidth+slideshowgap
ns_slide2.document.write(leftrightslide)
ns_slide2.document.close()
}
lefttime=setInterval("slideleft()",30)
}
window.onload=fillup

function slideleft(){
if (iedom){
if (parseInt(cross_slide.style.left)>(actualwidth*(-1)+8))
cross_slide.style.left=parseInt(cross_slide.style.left)-copyspeed+"px"
else
cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth+slideshowgap+"px"

if (parseInt(cross_slide2.style.left)>(actualwidth*(-1)+8))
cross_slide2.style.left=parseInt(cross_slide2.style.left)-copyspeed+"px"
else
cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth+slideshowgap+"px"

}
else if (document.layers){
	if (ns_slide.left>(actualwidth*(-1)+8))
		ns_slide.left-=copyspeed
	else
		ns_slide.left=ns_slide2.left+actualwidth+slideshowgap

	if (ns_slide2.left>(actualwidth*(-1)+8))
		ns_slide2.left-=copyspeed
	else
		ns_slide2.left=ns_slide.left+actualwidth+slideshowgap
	}
}
if (iedom||document.layers){
	with (document){
		document.write('<table border="0" cellspacing="0" cellpadding="0"><td>')
		if (iedom){
			write('<div style="position:relative;width:'+sliderwidth+';height:'+sliderheight+';overflow:hidden">')
			write('<div style="position:absolute;width:'+sliderwidth+';height:'+sliderheight+';background-color:'+slidebgcolor+'" onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed">')
			write('<div id="test2" style="position:absolute;left:0px;top:0px"></div>')
			write('<div id="test3" style="position:absolute;left:-1000px;top:0px"></div>')
			write('</div></div>')
		}
		else if (document.layers){
			write('<ilayer width='+sliderwidth+' height='+sliderheight+' name="ns_slidemenu" bgColor='+slidebgcolor+'>')
			write('<layer name="ns_slidemenu2" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
			write('<layer name="ns_slidemenu3" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
			write('</ilayer>')
		}
		document.write('</td></table>')
	}
}
</script>
</div></div>
</div>
</div>
<!--partners-->
</div>
<div style="clear:both;"></div>
<?php include("footer-loansinindia.php"); ?>
</body>
</html>
