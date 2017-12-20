<html>
<head>
<link href="css/slider_hdfccl.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
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

<div class="sldrpnl" >
	<div id="slider" >
		<ul>				
			        <li style="height:136px;	overflow:hidden;">
<div style="display:block; 	float:left;	">E- gift Voucher/cheque</div>
       </li>
            <li>
<div style="display:block; 	float:left;">Wrist Watch</div>
           </li>
		    <li>
<div style="display:block; 	float:left;">Sunglasses</div>
           </li>
		    <li>
<div style="display:block; 	float:left;	">Wallets</div>
           </li>
		   <li>
<div style="display:block; 	float:left;	">Car air purifier</div>
           </li>
		</ul>
	</div>
</div>
</body>
</html>