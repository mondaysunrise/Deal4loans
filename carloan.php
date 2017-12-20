<?php
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';
	session_start();
$id = $_REQUEST['id'];
$_SESSION['coupon_code'] = $id;
if((strlen(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 8.0")) > 0) || (strlen(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 7.0")) > 0))
{
	include "carloanhdfchttps.html";
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online HDFC Car Loan Application</title>
<meta name="description" content="Online HDFC Car Loan Application">     
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="images/car_hdfc/style.css"/>
<!--    		<script type="text/javascript" src="images/car_hdfc/jquery-1.6.1.min.js"></script>  -->
            	<script type="text/javascript" src="https://www.deal4loans.com/images/car_hdfc/jquery-1.8.3.min.js"></script> 
		<script type="text/javascript" src="https://www.deal4loans.com/images/car_hdfc/jquery.animation.easing.js"></script>
		<script type="text/javascript" src="https://www.deal4loans.com/images/car_hdfc/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="https://www.deal4loans.com/images/car_hdfc/source.js"></script>
		<script type="text/javascript" src="https://www.deal4loans.com/images/car_hdfc/scriptcar-https-hdfc.js"></script>
	    <script type="text/javascript" src="ajax.js"></script>
		<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.3"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.2" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
		
			$('.fancybox').fancybox({
         afterClose : function() {
        location.reload();
        return;
    },
		 'autoDimensions'    : false,
            'showCloseButton'   : true,
          width : 800,
            'height'            : 'auto',
            'transitionIn'      : 'elastic',
            'centerOnScroll'    : 'true',
            'transitionOut'     : 'elastic',
		    padding : 0,
            margin : 0,
            arrows: false,
            closeBtn: true,
            closeClick: true,
            openEffect : 'none',
            openSpeed : 100,
            closeEffect : 'none',
            closeSpeed : 100,
	
                helpers : {
                    title : null,
                    speedIn: 0,
                    speedOut: 0,
                    opacity: 0,
					
                }
				
            });
			
		});
	</script>

<script language="javascript">
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}
</script>
<script type="text/javascript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


<style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:588px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	display:inline;
/*
input[type=text]{ color:#CCCCCC;}
input[type=text]:focus{ color:#000;}
*/
</style>
	</head>
	<body onLoad="MM_preloadImages('images/newimages/mercedes.jpg')">
<div id="place">
<div style="width:969px; background:#999966; margin-left:2px; margin-bottom:40px; ">
<div style="float:left;"><img src="images/window-hdfc-logo.jpg"></div>
<div  style="float:right;   font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FFFFFF; font-weight:bold; width:360px; color:#FFFFFF; text-align:right;">HDFC Bank Car Loans<br><span style="font-weight:bold; font-size:12px;">Beta Version</span></div>
</div>
			<div id="name1"></div>
			<div id="wrapper1">
				<div id="div_a"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Tata" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image37','','images/newimages/tataint.jpg',1)"><img src="images/newimages/tata.jpg"  height="102" name="Image37" border="0" id="Image37" /></a></div>
				<div id="div_b"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Skoda" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image36','','images/newimages/skodaint.jpg',1)"><img src="images/newimages/skoda.jpg" height="102" name="Image36" border="0" id="Image36" /></a></div>
				<div id="div_c"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Chevrolet"><img src="images/newimages/chevrolet.jpg" width="140" height="65" border="0" /></a></div>
				<div id="div_d"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Hyundai"><img src="images/newimages/hyundai.jpg" width="140" height="65"  border="0" /></a></div>
				<div id="div_e" style="background-color:#260930;">
                                <a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Volkswagen" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image38','','images/newimages/volkswagenimg.jpg',1)"><img src="images/newimages/volkswagenover.jpg" width="290" height="139" name="Image38" border="0" id="Image38" /></a>
<!--<a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Volkswagen" ><img src="images/newimages/volks.gif" width="290" height="139" border="0" /></a> -->

</div>
				<div id="div_f">
       <a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Nissan" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image25','','images/newimages/nissan1.jpg',1)"><img src="images/newimages/nissan.jpg" name="Image25" border="0" id="Image25" /></a>   
                   </div>
				<div id="div_g">  <a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Renault" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image56','','images/newimages/renault1.png',1)"><img src="images/newimages/renault.jpg" name="Image56" border="0" id="Image56" /></a>   </div>
			  <div id="div_h"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Mahindra"><img src="images/newimages/mahindra.jpg" /></a></div>
				<div id="div_i"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Honda"><img src="images/newimages/honda.jpg" /></a></div>
				<div id="div_j">
                   <a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Maruti" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image35','','images/newimages/marutiint.jpg',1)"><img src="images/newimages/maruti.jpg" name="Image35" border="0" id="Image35" height="204" width="420" /></a> 
          </div>
				<div id="div_k"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Toyota"><img src="images/car_hdfc/toyota.jpg" width="195" height="98" /></a></div>
				<div id="div_l">
                  <a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Mercedes" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image24','','images/newimages/mercedesintover.jpg',1)"><img src="images/newimages/mercedesint.jpg" name="Image24" border="0" id="Image24" width="195" height="95" /></a>     
</div>
			
				<form action="" method="post">
					<input type="text" name="car_name" id="car_name" value="Input Make & Model of car (ex. Nissan Micra)" onFocus="if(this.value == this.defaultValue){ this.value = '';this.style.color ='#000'}" onBlur="if(this.value.length == 0){ this.value = this.defaultValue;this.style.color ='#aaa'}"  onkeyup="ajax_showOptions(this,'getCarNameByLetters',event, 'https://www.deal4loans.com/hdfcajax-carnlist-cl.php')" autocomplete="off" /><button type="submit"></button>
					<!--<div id="search-engine1"></div> -->
				</form>
                <div style="height:25px; text-align:right; margin-left:750px; margin-top:480px;	border:0px !important; width:250px;"><div><img src="images/hdfc-apps-powered-by-deal4loans.jpg"></div>
<div style="clear:both;"></div>
</div>

			</div><!-- end wrapper1 -->
			<div id="button1to2"></div>
			<div id="button2to1"></div>
			<div id="name2"></div>
			<div id="wrapper2">
				<div id="div_a1"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Ford"><img src="images/newimages/ford.jpg" /></a></div>
				<div id="div_b2"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Hindustan Motors"><img src="images/car_hdfc/Hindustan-Motors.jpg" /></a></div>
				<div id="div_c2"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Land Rover"><img src="images/newimages/land-rover.jpg" /></a></div>
				<div id="div_d2"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Mitsubishi"><img src="images/newimages/mitsubishi.jpg" /></a></div>
				<div id="div_e2"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Fiat"><img src="images/newimages/fiat.jpg" /></a></div>
				<div id="div_f2">
                   <a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Audi" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image29','','images/newimages/audi1.jpg',1)"><img src="images/newimages/audi.jpg" name="Image29" border="0" id="Image29" /></a> 
               
</div>
				<div id="div_g2">
                
                 <a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Renault" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image26','','images/newimages/renault1.png',1)"><img src="images/newimages/renault.jpg" name="Image26" border="0" id="Image26" /></a>                 
</div>
				<div id="div_h2"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Premier"><img src="images/newimages/premier.jpg" /></a></div>
				<div id="div_i2"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Porsche"><img src="images/newimages/porche.jpg" /></a></div>
				<div id="div_j2">
                <a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Jaguar" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image27','','images/newimages/jaguar1.jpg',1)"><img src="images/newimages/jaguar.jpg" name="Image27" border="0" id="Image27" /></a>  
               
                             </div>
				<div id="div_k2"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Volvo"><img src="images/newimages/volvo.jpg" /></a></div>
				<div id="div_l2"><a class="fancybox fancybox.iframe" href="car-hdfc-lightbox.php?model=Bmw"><img src="images/newimages/bmw.jpg" /></a></div>
			<form action="" method="post">
					<input type="text" name="car_name" id="car_name" value="Input Make & Model of car (ex. Nissan Micra)" onFocus="if(this.value == this.defaultValue){ this.value = '';this.style.color ='#000'}" onBlur="if(this.value.length == 0){ this.value = this.defaultValue;this.style.color ='#aaa'}" onKeyUp="ajax_showOptions(this,'getCarNameByLetters',event, 'https://www.deal4loans.com/hdfcajax-carnlist-cl.php')"  autocomplete="off" /><button type="submit"></button>
					<!--<div id="search-engine1"></div> -->
				</form>
                 <div style="height:25px;  text-align:right; margin-left:750px; margin-top:480px; width:250px;"><div><img src="images/hdfc-apps-powered-by-deal4loans.jpg"></div>
<div style="clear:both;"></div>
</div>
			</div><!-- end wrapper2 -->
			
		</div>
<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1312775-1']);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
	</body>
</html>
<?php
}
?>