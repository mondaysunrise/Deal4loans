<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Statewise Loans in India <?php echo ucwords(strtolower($State)); ?></title>
<meta name="keywords" content="Loans in India">
<link href="source.css" rel="stylesheet" type="text/css" />
  <link href="/css/common-d4l-styles.css" rel="stylesheet" type="text/css" />
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
</head>
<body>
<?php include "middle-menu.php"; ?>

<div style="clear:both;"></div>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto;height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="/index.php" class="text12" style="color:#0080d6;" >Home</a></u> <span class="text12" style="color:#4c4c4c;">> Loans in India</span></div>
<div style="clear:both;height:10px"></div>

<h1 class="text3" style="height:33; margin-top:0px;clear:right; font-size:28px; text-transform:none; color:#000;">Loans in India</h1>
<span style="float:left; margin:10px 10px 10px 0px; font-weight:bold">State Wise Loan Details, Here you can navigate or check State wise Loan and Credit Card Offers in India. </span>

<div style="clear:both; height:15px;"></div>

<table cellspacing="1" cellpadding="0" border="0" width="99%">
  <tbody>
    <tr>
      <td style="padding-left:0px;"><table width="100%" cellspacing="1" cellpadding="7" border="0" bgcolor="#d5cfb1" style="margin:">
          <tbody>
            <tr>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/andhra pradesh" style="text-decoration:none;"><strong>Loan in Andhra Pradesh</strong></a></td>
              <td  class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/assam"><strong>Loan in Assam</strong></a></td>
              <td  class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/bihar"><strong>Loan in Bihar</strong></a></td>
              <td  class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/chhattisgarh"><strong>Loan in Chhattisgarh</strong></a></td>
              <td  class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/delhi"><strong>Loan in Delhi</strong></a></td>
            </tr>
            <tr>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/goa"><strong>Loan in Goa</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/gujarat"><strong>Loan in Gujarat</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/haryana"><strong>Loan in Haryana</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/jammu and kashmir"><strong>Loan in Jammu And Kashmir</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/jharkhand"><strong>Loan in Jharkhand</strong></a></td>
            </tr>
            <tr>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/karnataka"><strong>Loan in Karnataka</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/kerala"><strong>Loan in Kerala</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/madhyapradesh"><strong>Loan in Madhyapradesh</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/maharashtra"><strong>Loan in Maharashtra</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/orissa"><strong>Loan in Orissa</strong></a></td>
            </tr>
            <tr>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/orissa"></a><a href="http://www.deal4loans.com/loans-in/punjab"><strong>Loan in Punjab</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/punjab"></a><a href="http://www.deal4loans.com/loans-in/rajasthan"><strong>Loan in Rajasthan</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/rajasthan"></a><a href="http://www.deal4loans.com/loans-in/telangana"><strong>Loan in Telangana</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/telangana"></a><a href="http://www.deal4loans.com/loans-in/tamilnadu"><strong>Loan in Tamilnadu</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/tamilnadu"></a><a href="http://www.deal4loans.com/loans-in/uttar pradesh"><strong>Loan in Uttar Pradesh</strong></a></td>
            </tr>
            <tr>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/uttar pradesh"></a><a href="http://www.deal4loans.com/loans-in/uttaranchal"><strong>Loan in Uttaranchal</strong></a></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans-in/uttaranchal"></a><a href="http://www.deal4loans.com/loans-in/west bengal"><strong>Loan in West Bengal</strong></a><strong> </strong></td>
              <td class="common-sub-body-text" width="20%" bgcolor="#FFFFFF">&nbsp;</td>
              <td  class="common-sub-body-text" width="20%" bgcolor="#FFFFFF">&nbsp;</td>
              <td  class="common-sub-body-text" width="20%" bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            </tbody>
        </table></td>
    </tr>
  </tbody>
</table>

<div style="clear:both; height:15px;"></div>
<!--partners-->
<div class="loans_Silder">
<div class="text" style="margin:auto; height:auto; padding-top:35px; color:#000;"><strong>Loan Partners</strong></div>
<div style="margin:auto;  height:56px;; margin-top:7px; margin-bottom:13px;">	<script type="text/javascript">
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
</div>
</div>
</div>

<!--partners-->

<?php include("footer-loansinindia.php"); ?>

</body>
</html>
