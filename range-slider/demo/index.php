<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="range2slide-css.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="rangeslider.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://www.deal4loans.com/js/rangeslider.min.js"></script>

<link rel="stylesheet" href="jslider.css" type="text/css">
	<!-- bin/jquery.slider.min.js -->
	<script type="text/javascript" src="../js/tmpl.js"></script>
	<script type="text/javascript" src="../js/jquery.slider.js"></script>

<script>
$(function() {

	var $document   = $(document),
		selector    = '[data-rangeslider]',
		$element    = $(selector);

	// Example functionality to demonstrate a value feedback
	function valueOutput(element) {
		var value = element.value,
		output = element.parentNode.getElementsByTagName('output')[0];
		output.innerHTML = value;
		
		document.getElementById("tenure").value = tenureVal.value;
		document.getElementById("roi").value = interestRateVal.value;
	}
	for (var i = $element.length - 1; i >= 0; i--) {
		valueOutput($element[i]);
	};
	$document.on('change', 'input[type="range"]', function(e) {
		valueOutput(e.target);
	});

	// Example functionality to demonstrate disabled functionality
	$document .on('click', '#js-example-disabled button[data-behaviour="toggle"]', function(e) {
		var $inputRange = $('input[type="range"]', e.target.parentNode);

		if ($inputRange[0].disabled) {
			$inputRange.prop("disabled", false);
		}
		else {
			$inputRange.prop("disabled", true);
		}
		$inputRange.rangeslider('update');
	});

	// Example functionality to demonstrate programmatic value changes
	$document.on('click', '#js-example-change-value button', function(e) {
		var $inputRange = $('input[type="range"]', e.target.parentNode),
			value = $('input[type="number"]', e.target.parentNode)[0].value;

		$inputRange.val(value).change();
	});

	// Example functionality to demonstrate destroy functionality
	$document
		.on('click', '#js-example-destroy button[data-behaviour="destroy"]', function(e) {
			$('input[type="range"]', e.target.parentNode).rangeslider('destroy');
		})
		.on('click', '#js-example-destroy button[data-behaviour="initialize"]', function(e) {
			$('input[type="range"]', e.target.parentNode).rangeslider({ polyfill: false });
		});

	// Basic rangeslider initialization
	$element.rangeslider({

		// Deactivate the feature detection
		polyfill: false,

		// Callback function
		onInit: function() {},

		// Callback function
		onSlide: function(position, value) {
			console.log('onSlide');
			console.log('position: ' + position, 'value: ' + value);
		},

		// Callback function
		onSlideEnd: function(position, value) {}
	});
});
</script>


</head>
<body>
<form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);">
  <input type="hidden" name="source" value="Balance Transfer Calc">
  <div class="hlbtc_main_new_ui_left_warp">
  <div style="clear:both; height:10px;"></div>
  <div class="form-hlbtc-box2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td scope="row"><div id="js-example-destroy" style="float:left; width:100%;">
            <input type="range" id="tenureVal" min="1" max="25" step="1" value="1" data-rangeslider />
            <div style="float:right;margin-right: -30px;  margin-top: -20px;">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" align="right">
                <tr>
                  <td><output></output></td>
                  <td style="font-size:12px;">
                    <input type="hidden" id="tenure" name="tenure" value="" size="2" /></td>
                </tr>
              </table>
              
            </div> <br /> <input id="Slider1" type="slider" name="area" />
 
    <script type="text/javascript" charset="utf-8">
      
      jQuery("#Slider1").slider({scale: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''], limits: false, calculate: function( value ){
       
      }})

    </script>
          </div></td>
      </tr>
    </table>
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <hr /> <p>&nbsp;</p> <p>&nbsp;</p>
  <div style="clear:both; height:10px;"></div>
  <div class="form-hlbtc-box2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td scope="row"><div id="js-example-destroy" style="float:left; width:100%;">
            <input type="range" id="interestRateVal" min="1" max="10" step="0.5" value="5" data-rangeslider>
            <div style=" float:right;margin-right: -30px; margin-top: -20px;">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><output></output></td>
                  <td style="font-size:12px;">
                    <input type="hidden" id="roi" name="roi" value="" size="5" /></td>
                </tr>
              </table>
              
            </div>  <br /><input id="Slider2" type="slider" name="area" />
 
    <script type="text/javascript" charset="utf-8">
      
      jQuery("#Slider2").slider({scale: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''], limits: false, calculate: function( value ){
       
      }})

    </script>
          </div></td>
      </tr>
    </table>
  </div> <p>&nbsp;</p><p>&nbsp;</p>
   <div style="clear:both; height:10px;"></div>
 </div>
</form>
</body>
</html>