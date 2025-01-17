<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>HDFC | Deal4loans</title>
		<meta name="Keywords" content="slider, kit, slideshow, gallery, carousel, jquery plugin" />
		<meta name="Description" content="Slider Kit jQuery slideshow plugin: content sliders examples" />
		<link rel="stylesheet" type="text/css" href="images/car_hdfc/style.css"/>
		<!-- jQuery library -->
		<script type="text/javascript" src="lib/js/external/_oldies/jquery-1.3.min.js"></script>
	<!--<script type="text/javascript" src="lib/js/external/jquery-1.6.2.min.js"></script>-->
		<!-- jQuery Plugin scripts -->
		<script type="text/javascript" src="lib/js/external/jquery.easing.1.3.min.js"></script>
		<script type="text/javascript" src="lib/js/external/jquery.mousewheel.min.js"></script>
		<!-- Slider Kit scripts -->
		<script type="text/javascript" src="lib/js/sliderkit/jquery.sliderkit.1.9.2.pack.js"></script>
		<!-- Slider Kit launch -->
		<!-- Slider Kit styles -->
		<link rel="stylesheet" type="text/css" href="lib/css/sliderkit-core.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="lib/css/sliderkit-demos.css" media="screen, projection" />
		<!-- Slider Kit compatibility -->
		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="lib/css/sliderkit-demos-ie6.css" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="lib/css/sliderkit-demos-ie7.css" /><![endif]-->
		<!--[if IE 8]><link rel="stylesheet" type="text/css" href="lib/css/sliderkit-demos-ie8.css" /><![endif]-->
		<!-- Site styles -->
		<link rel="stylesheet" type="text/css" href="lib/css/sliderkit-site.css" media="screen, projection" />
	    <script type="text/javascript" src="ajax.js"></script>
		<script type="text/javascript" src="ajax-dynamic-stages.js"></script>		 
        	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.3"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.2" media="screen" />
		<script type="text/javascript">
			$(window).load(function(){ //$(window).load() must be used instead of $(document).ready() because of Webkit compatibility		
				// Photo slider > Minimal
				$(".contentslider-std").sliderkit({
					auto:0,
					tabs:1,
					circular:1,
					panelfx:"sliding",
					panelfxfirst:"fading",
					panelfxeasing:"easeInOutExpo",
					fastchange:0,
					keyboard:1
				});
							
			});	
		</script>
       
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
	}
	
</style>
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
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>		
	</head>
	<body>
		<div id="page" class="inner layout-1col">
        	
			<div id="content">
				
				
				<!-- Start contentslider-std -->
				<div class="sliderkit contentslider-std">
					<div class="sliderkit-btn sliderkit-go-btn sliderkit-go-prev"><a href="#" title="Previous"><span>Previous</span></a></div>
					<div class="sliderkit-btn sliderkit-go-btn sliderkit-go-next"  style="float:right;"><a href="#" title="Next"><span>Next</span></a></div>
					<div class="sliderkit-panels">
                    <div  style="height:25px;   font-family: Arial,Helvetica,sans-serif;    font-size: 26px; font-weight: bold;    left: 5px;     color:#FFFFFF;  padding: 0px 0px 0px 2px; margin-left:15px; margin-bottom:15px; width:500px; ">Select Your Car Make	</div>
						<div class="sliderkit-panel">
	<div id="div_a"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Tata"><img src="images/newimages/tata.jpg" border="0" /></a></div>
				<div id="div_b"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Skoda"><img src="images/newimages/skoda.jpg" border="0" /></a></div>
				<div id="div_c"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Chevrolet"><img src="images/newimages/chevrolet.jpg" width="140" height="65" border="0" /></a></div>
				<div id="div_d"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Hyundai"><img src="images/newimages/hyundai.jpg" width="140" height="65"  border="0" /></a></div>
				<div id="div_e">
           <a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Volkswagen" ><img src="images/newimages/volks.gif" width="290" height="139" border="0" /></a>
</div>
			<div id="div_f">
         <a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Nissan" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image25','','images/newimages/nissan1.jpg',1)"><img src="images/newimages/nissan.jpg" name="Image25" border="0" id="Image25" /></a>
             </div>
				<div id="div_g">
              <a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Mercedes" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image24','','images/newimages/mercedes1.jpg',1)"><img src="images/newimages/mercedes.jpg" name="Image24" border="0" id="Image24" /></a> 
            </div>
				<div id="div_h"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Mahindra"><img src="images/newimages/mahindra.jpg" /></a></div>
				<div id="div_i"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Honda"><img src="images/newimages/honda.jpg" /></a></div>
				<div id="div_j">
                  <a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Maruti"><img src="images/newimages/maruti.jpg" name="Image4" border="0" id="Image4" /></a> 
               <!-- <a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Maruti"><img src="images/car_hdfc/maruti-kizashi1.jpg" /></a> --></div>
				<div id="div_k"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Toyota"><img src="images/car_hdfc/toyota.jpg" width="195" height="98" border="0" /></a></div>
				<div id="div_l"><a href="hdfc-gifts-rewards.php"><img src="images/newimages/rewards.gif" border="0" /></a></div>
                                          	<form action="hdfc-car-loan-app-offers_nw.php" method="post">
					<input type="text" name="car_name" id="car_name" value="Input Make & Model of car (ex. Nissan Micra)" onFocus="if(this.value == this.defaultValue){ this.value = '';this.style.color ='#000'}" onBlur="if(this.value.length == 0){ this.value = this.defaultValue;this.style.color ='#aaa'}" onKeyUp="ajax_showOptions(this,'getCarNameByLetters',event, 'http://www.deal4loans.com/hdfcajax-carnlist-cl.php')" /><button type="submit"></button>
					<!--<div id="search-engine1"></div> -->
				</form>

						</div>
						<div class="sliderkit-panel">
							<div style="background:#666666;" >
			<div id="div_a1"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Ford"><img src="images/newimages/ford.jpg" /></a></div>
				<div id="div_b2"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Hindustan Motors"><img src="images/car_hdfc/Hindustan-Motors.jpg" /></a></div>
				<div id="div_c2"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Land Rover"><img src="images/newimages/land-rover.jpg" /></a></div>
				<div id="div_d2"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Mitsubishi"><img src="images/newimages/mitsubishi.jpg" /></a></div>
				<div id="div_e2"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Fiat"><img src="images/newimages/fiat.jpg" /></a></div>
				<div id="div_f2">
                   <a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Audi" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image29','','images/newimages/audi1.jpg',1)"><img src="images/newimages/audi.jpg" name="Image29" border="0" id="Image29" /></a> 
               
</div>
				<div id="div_g2">
                
                 <a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Renault" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image26','','images/newimages/renault1.png',1)"><img src="images/newimages/renault.jpg" name="Image26" border="0" id="Image26" /></a>                 
</div>
				<div id="div_h2"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Premier"><img src="images/newimages/premier.jpg" /></a></div>
				<div id="div_i2"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Porsche"><img src="images/newimages/porche.jpg" /></a></div>
				<div id="div_j2">
                <a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Jaguar" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image27','','images/newimages/jaguar1.jpg',1)"><img src="images/newimages/jaguar.jpg" name="Image27" border="0" id="Image27" /></a>  
               
                             </div>
				<div id="div_k2"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Volvo"><img src="images/newimages/volvo.jpg" /></a></div>
				<div id="div_l2"><a class="fancybox fancybox.iframe" href="hdfc-car-loanappcontinue15.php?model=Bmw"><img src="images/newimages/bmw.jpg" /></a></div>
</div>
                	<form action="hdfc-car-loan-app-offers_nw.php" method="post">
					<input type="text" name="car_name" id="car_name" value="Input Make & Model of car (ex. Nissan Micra)" onFocus="if(this.value == this.defaultValue){ this.value = '';this.style.color ='#000'}" onBlur="if(this.value.length == 0){ this.value = this.defaultValue;this.style.color ='#aaa'}"  onkeyup="ajax_showOptions(this,'getCarNameByLetters',event, 'http://www.deal4loans.com/hdfcajax-carnlist-cl.php')" /><button type="submit"></button>
					<!--<div id="search-engine1"></div> -->
				</form>
						</div>
						
					</div>
				</div>
				<!-- // end of contentslider-std -->
				
				
			</div>
			<div class="spacer"></div>
		</div>
	</body>
</html>
